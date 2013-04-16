<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
require_once(__ROOT__."classes/ezQuery.php");

/******************************************************************************
 * BiblioCopyQuery data access component for library bibliography copies
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class BiblioCopyQuery extends ezQuery {

	function __construct()
	{
		parent::__construct();
		require_once(__ROOT__."classes/BiblioCopy.php");
	}

  /****************************************************************************
   * Executes a query to select ONLY ONE COPY
   * @param string $bibid bibid of bibliography copy to select
   * @param string $copyid copyid of bibliography copy to select
   * @return Copy returns copy or false, if error occurs
   * @access public
   ****************************************************************************
   */
  function getCopy($copyid) {
    $sql = $this->mkSQL("SELECT bc.* FROM `biblio_copy` bc WHERE bc.`copyid`=%N ",$copyid);

	$res = $this->get_results($sql);
    if (!isset($res)|| empty($res)) {
      return false;
    }
    return $this->_mkCopy($res[0]);
  }


  /****************************************************************************
   * Executes a query to select ALL COPIES belonging to a particular bibid
   * @param string $bibid bibid of bibliography copies to select
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function getAllCopies($bibid) {
    # setting query that will return all the data
    $sql = $this->mkSQL("SELECT bc.* FROM `biblio_copy` bc WHERE bc.`bibid`=%N ",$bibid);

	$res = $this->get_results($sql);
    if (!isset($res) || empty($res)) {
      return false;
    }
    
    $copies = array();
    while(list(,$aRow) = each($res))
    {
    	$copies[] = $this->_mkCopy($aRow);
    }
    return (!empty($copies))?$copies:false;

  }
  
  /****************************************************************************
   * makes a BiblioCopy object from a passed in row of data.
   * @return BiblioCopy returns bibliography copy or false if no more
   *                    bibliography copies to fetch
   * @access public
   ****************************************************************************
   */
  private function _mkCopy($aRow) {
    $copy = new BiblioCopy();
    $copy->setBiblioId($aRow->bibid);
    $copy->setCopyId($aRow->copyid);
    $copy->setCreateDt($aRow->create_dt);
    $copy->setDescription($aRow->copy_desc);
    $copy->setFilePath($aRow->file_path);
    $copy->setFormatId($aRow->formatid);
    $copy->setContentId($aRow->contentid);
    return $copy;
  }

 
  /****************************************************************************
   * Inserts a new bibliography copy into the biblio_copy table.
   * @param BiblioCopy $copy bibliography copy to insert
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function insert($copy) {
    # checking for duplicate barcode number
	
    $sql = $this->mkSQL("INSERT INTO `biblio_copy` (`bibid`,`formatid`,`contentid`,`copy_desc`,`file_path`) VALUES (%N, %N, %N, %Q, %Q) ", $copy->getBiblioId(), $copy->getFormatId(), $copy->getContentId(),
                        $copy->getDescription(), $copy->getFilePath());
    
    if ($this->query($sql)==0)
    	return false;
    	
    return $this->insert_id;
  }

  /****************************************************************************
   * Updates a bibliography in the biblio table.
   * @param Biblio $biblio bibliography to update
   * @param boolean $checkout is this a checkout operation? default FALSE
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
  function update($copy) {
    $sql = $this->mkSQL("update biblio_copy set copy_desc=%Q, file_path=%Q, "
                         . "formatid=%N, contentid=%N "
                         . "where bibid=%N and copyid=%N",
                         $copy->getDescription(), $copy->getFilePath(),
                         $copy->getFormatId(), $copy->getContentId(),
                         $copy->getBiblioId(), $copy->getCopyId());
    $this->query($sql);
    return ($this->rows_affected>0);
       
 }

  /****************************************************************************
   * Deletes a copy from the biblio_copy table.
   * @param string $copyid copy id of copy to delete. 
   * @return boolean returns false, if error occurs
   * @access public
   ****************************************************************************
   */
	function delete($copyid) {
   		$sql = $this->mkSQL("DELETE FROM `biblio_copy` WHERE `copyid`=%N", $copyid);
   		
   		return ($this->query($sql) !== false)?$this->rows_affected:false;
  	}
}

