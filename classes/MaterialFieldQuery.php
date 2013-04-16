<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 

require_once(__ROOT__."classes/ezQuery.php");
require_once(__ROOT__."functions/marcFuncs.php");

class MaterialFieldQuery extends ezQuery {
  function getMaterialWithCode($materialCd) {
    $sql = $this->mkSQL('SELECT * FROM `material_usmarc_xref` WHERE `materialCd`=%N ORDER BY `tag`, `subfieldCd` ', $materialCd);
    
    $res = $this->get_results($sql);
    if(isset($res) && count($res))
    {
    	foreach ($res as $k=>$row)
    	{
    		$idx = makeCompositeTag($row->tag,$row->subfieldCd);
    		$res[$idx] = $row;
    		unset($res[$k]);
    	}
    }
    
    return (isset($res))?$res:false;
  }
 
  function getMaterialWithId($id) {
    $sql = $this->mkSQL('SELECT * FROM `material_usmarc_xref` WHERE `xrefid`=%N ', $id);
    
    $res = $this->get_results($sql);
    return (isset($res))?$res[0]:false;
  }

  function insert($record) 
  {
  	$sql = 'INSERT INTO `material_usmarc_xref` '
           . '(`materialCd`, `tag`, `subfieldCd`, `descr`, `required`, `ctrltype`, `ctrlvalues`, `show_in_opac`) '
           . $this->mkSQL('VALUES (%N, %N, %Q, %Q, %N, %N, %Q, %N) ',
                          $record['material'],
                          $record['tag'],
                          $record['subfield'],
                          $record['descr'],
                          $record['required'],
                          $record['ctrltype'],
                          $record['ctrlvalues'],
                          $record['inopac']);
    $res = $this->query($sql);
  	return (isset($res))?$this->insert_id:false;
  }
  
  	function update($record) {
  	$sql = $this->mkSQL('UPDATE `material_usmarc_xref` SET '
                        . '`materialCd`=%N, `tag`=%N, `subfieldCd`=%Q, '
                        . '`descr`=%Q, `required`=%N, `ctrltype`=%N, '
                        . '`ctrlvalues`=%Q, `show_in_opac`=%N '
                        . 'WHERE `xrefid`=%N ',
                        $record['material'],
                        $record['tag'],
                        $record['subfield'],
                        $record['descr'],
                        $record['required'],
                        $record['ctrltype'],
                        $record['ctrlvalues'],
                        $record['inopac'],
                        $record['xrefid']);
                        
    
    return ($this->query($sql) > 0);
    
  }
  function delete($id) {
    $sql = $this->mkSQL('DELETE FROM `material_usmarc_xref` WHERE `xrefid`=%N ', $id);
    return ($this->query($sql)>0);
  }
}

?>
