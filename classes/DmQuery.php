<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Dm.php");
require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/ezQuery.php");

class DmQuery extends ezQuery {

 	function __construct()
	{
		parent::__construct();
		$this->cache_timeout = (24*31); // set the cache timeout to approximately 1 month
	}

	private function _mkQry($table='', $code=null, $key='code', $orderBy='description')
	{
	  $sql = $this->mkSQL("SELECT %I.* FROM %I ", $table, $table);
	  if (isset($code)) {
	    $sql .= $this->mkSQL("WHERE ".$key."=%Q ", $code);
	  }
	  $sql .= $this->mkSQL("ORDER BY %I ",$orderBy);
	  return $sql;
	}

 	function get($table)
	{
		$sql = $this->_mkQry($table);
		if($this->get_cache($sql) !== false)
   		{
   		   $res = $this->get_results($sql);
   		}
   		else
   		{
   			$this->cache_queries = true;
    		$this->cache_timeout = 0.001;
    		$res = $this->get_results($sql);
    		$this->cache_queries = false;
    		$this->cache_timeout = (24*31); // set the cache timeout to approximately 1 month
   		}

		if(!isset($res))
		{
     		Fatal::internalError("Invalid domain table code");
    	}

		if(count($res) == 0)
			return false;

		return array_map(array($this, '_mkObj'), $res);
	}

  	function getAssoc($table, $column=NULL,$index=NULL, $updateCache=false)
	{

		$column = (!isset($column))?'description':$column;
		$index = (!isset($index))?'code':$index;
		$assoc = array();
		$sql = $this->_mkQry($table,null,$index,$column);

		if(($this->get_cache($sql) !== false) && (!$updateCache) )
	    {
	    	$res = $this->get_results($sql);
	    }
	    else
	    {
	    	$this->cache_queries = true;
    		$this->cache_timeout = 0.001; // set the cache timeout to 3.6 seconds so it will definitely be regenerated
    		$res = $this->get_results($sql);
    		$this->cache_queries = false;
    		$this->cache_timeout = (24*31); // set the cache timeout to approximately 1 month
	    }

		if(!isset($res)) return false;
		foreach ($res as $row)
		{
	 		$assoc[$row->$index] = $row->$column;
		}

		return $assoc;
	}

  	function getDefault($table)
  	{
  		$qry = $this->_mkQry($table, '1', 'default_flg');
    	$res = $this->get_results($qry);
    	return (($res !== false) && (count($res) >0))?$this->_mkObj($res[0]):false;

  	}

  	function getRowsForFlag($table,$col='default_flg',$val=1)
  	{
	  	$qry = $this->_mkQry($table, $val, $col);
    	$res = $this->get_results($qry);
    	return (($res !== false) && (count($res) >0))?$res:false;
  	}

	function get1($table, $code)
	{
    	$qry = $this->_mkQry($table, $code);
    	$results = $this->get_results($qry);

		if(!isset($results))
		{
     		Fatal::internalError("Invalid domain table code");
    	}

		if(count($results) != 1)
			return false;

		return $this->_mkObj($results[0]);
  	}

  function getWithStats($table)
  {
    $results = $this->_getStats($table);
    return ($results !== false)?array_map(array($this, '_mkObj'), $results):false;
  }

    private function _getStats($table) {

    if ($table == "collection_dm")
    {
    	$sql = "SELECT cd.*, count(b.bibid) row_count FROM collection_dm cd , biblio b ";
    	$sql .= "where cd.code = b.collection_cd GROUP BY 1,2,3 UNION ";
		$sql .= "SELECT cd.*, '0' row_count FROM collection_dm cd , biblio b ";
		$sql .= "WHERE NOT EXISTS (SELECT 1 FROM biblio b WHERE cd.`code`= b.collection_cd)GROUP BY 1,2,3 ";

    } elseif ($table == "material_type_dm")
    {
      $sql = "select mt.*, count(b.bibid) row_count ";
      $sql .= "from material_type_dm mt left join biblio b on mt.code = b.material_cd ";
      $sql .= "group by 1, 2, 3, 4, 5 ";

    } else {
      Fatal::internalError("Cannot retrieve stats for that dm table");
    }

    $sql .= "order by description ";
    $res = $this->get_results($sql);

    if(!isset($res)) return false;

    return $res;
  }


  private function _mkObj($array) {

  	//print_r($array);
    $dm = new Dm();
    $dm->setCode($array->code);
    $dm->setDescription($array->description);
    $dm->setDefaultFlg($array->default_flg);

    if (isset($array->image_file)) {
      $dm->setImageFile($array->image_file);
    }
    if (isset($array->recommend_flg)) {
      $dm->setShouldRecommend($array->recommend_flg);
    }
    if (isset($array->row_count)) {
      $dm->setCount($array->row_count);
    }
    return $dm;
  }

  function insert($table, $dm) {
    $sql = $this->mkSQL("insert into %I values ", $table);
    if ($table == "collection_dm"
        or $table == "material_type_dm"
        or $table == "genres") {
      $sql .= '(null, ';
    } else {
      $sql .= $this->mkSQL('(%Q, ', $dm->getCode());
    }

    if($table == "genres")
    	$sql .= $this->mkSQL("%Q ", $dm->getDescription());
    else
    	$sql .= $this->mkSQL("%Q, %N ", $dm->getDescription(),$dm->getDefaultFlg());

    if ($table == "material_type_dm")
      $sql .= $this->mkSQL(", %Q, %N)", $dm->getImageFile(), $dm->getShouldRecommend());
    else
      $sql .= ")";

    $affRows = $this->query($sql);
    if ($affRows === false) return false;
    if (($affRows) && ($dm->getDefaultFlg()))
    	$this->updateDefaults($table,$this->insert_id);

    $this->getAssoc($table,null,null,true);

    return isset($affRows);
  }

  function update($table, $dm) {
    $sql = $this->mkSQL("update %I set description=%Q, default_flg=%N ",
                         $table, $dm->getDescription(),$dm->getDefaultFlg());
    if ($table == "material_type_dm") {
      $sql .= $this->mkSQL(", image_file=%Q, recommend_flg=%N ", $dm->getImageFile(), $dm->getShouldRecommend());
    }

    $sql .= $this->mkSQL("where code=%N ", $dm->getCode());

    $affRows = $this->query($sql);
    if (($affRows) && ($dm->getDefaultFlg()))
    	$this->updateDefaults($table,$dm->getCode());
    $this->getAssoc($table,null,null,true);

    return $affRows;
  }

  function delete($table, $code, $col='code') {
  	$sql = $this->mkSQL("delete from %I where %I=%Q ", $table, $col, $code);

    $affRows = $this->query($sql);
    $this->getAssoc($table,null,$col,true);
    return $affRows;
  }

	private function updateDefaults($table,$code)
	{
		$sql = $this->mkSQL("UPDATE %I SET `default_flg`=0 WHERE `code`<>%N ",$table, $code);
		$this->query($sql);
	}

}
