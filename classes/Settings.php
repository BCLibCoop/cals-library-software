<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

/******************************************************************************
 * Settings represents the library settings.
 *
 * @author David Stevens <dave@stevens.name>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */
class Settings {
  	protected $_libraryName;
  	protected $_libraryDesc;
  	protected $_libraryImageUrl;
  	protected $_useImageInFooter;
  	protected $_libraryHours;
  	protected $_libraryPhone;
  	protected $_libraryUrl;
  	protected $_opacUrl;
  	protected $_adminSessionTimeout;
  	protected $_adminSessionTimeoutError;
  	protected $_publicSessionTimeout;
  	protected $_publicSessionTimeoutError;
  	protected $_itemsPerPage;
  	protected $_itemsPerPageError;
  	protected $_version;
  	protected $_themeid;
  	protected $_purgeHistoryAfterMonths;
  	protected $_purgeHistoryAfterMonthsError;
  	protected $_locale;
  	protected $_charset;
  	protected $_htmlLangAttr;

	function __construct()
	{
		$this->_libraryName = '';
		$this->_libraryDesc ='';
  		$this->_libraryImageUrl = '';
  		$this->_useImageInFooter = false;
  		$this->_libraryHours = '';
  		$this->_libraryPhone = '';
  		$this->_libraryUrl = '';
  		$this->_opacUrl = '';
  		$this->_adminSessionTimeout = 720; // default timeout of 12 hours
  		$this->_adminSessionTimeoutError = '';
  		$this->_publicSessionTimeout = 120; // default timeout of 2 hours
  		$this->_publicSessionTimeoutError = '';
  		$this->_itemsPerPage = 10;
  		$this->_itemsPerPageError = '';
  		$this->_version = '';
  		$this->_themeid = 0;
  		$this->_purgeHistoryAfterMonths = 0;
  		$this->_purgeHistoryAfterMonthsError = '';
  		$this->_locale = 'en'; // default English Locale
  		$this->_charset = '';
  		$this->_htmlLangAttr = '';
	}

  /****************************************************************************
  * @return array with code and description of installed locales
  * @access public
  ****************************************************************************
  */
  function getLocales () {
    $dir_handle = opendir(OBIB_LOCALE_ROOT);
    $arr_locale = array();

    while (false!==($file=readdir($dir_handle))) {
      if ($file != '.' && $file != '..') {
        if (is_dir (OBIB_LOCALE_ROOT."/".$file)) {
          if (file_exists(OBIB_LOCALE_ROOT.'/'.$file.'/metadata.php')) {
            include(OBIB_LOCALE_ROOT.'/'.$file.'/metadata.php');
	    $arr_temp = array($file => $lang_metadata['locale_description']);
	    $arr_locale = array_merge($arr_locale, $arr_temp);
          }
        }
      }
    }
    closedir($dir_handle);
    return $arr_locale;
  }

  /****************************************************************************
   * @return boolean true if data is valid, otherwise false.
   * @access public
   ****************************************************************************
   */
  function validateData() {
    $valid = true;
    if (!is_numeric($this->_adminSessionTimeout)) {
      $valid = false;
      $this->_adminSessionTimeoutError = "Admin session timeout must be numeric.";
    } elseif ($this->_adminSessionTimeout <= 0) {
      $valid = false;
      $this->_adminSessionTimeoutError = "Admin session timeout must be greater than 0.";
    }
     if (!is_numeric($this->_publicSessionTimeout)) {
      $valid = false;
      $this->_publicSessionTimeoutError = "Public session timeout must be numeric.";
    } elseif ($this->_publicSessionTimeout <= 0) {
      $valid = false;
      $this->_publicSessionTimeoutError = "Public session timeout must be greater than 0.";
    }

    if (!is_numeric($this->_itemsPerPage)) {
      $valid = false;
      $this->_itemsPerPageError = "Items per page must be numeric.";
    } elseif ($this->_itemsPerPage <= 0) {
      $valid = false;
      $this->_itemsPerPageError = "Items per page must be greater than 0.";
    }
    if (!is_numeric($this->_purgeHistoryAfterMonths)) {
      $valid = FALSE;
      $this->_purgeHistoryAfterMonthsError = "Months must be numeric.";
    }
    return $valid;
  }

  /****************************************************************************
   * getter methods for all fields
   * @return string
   * @access public
   ****************************************************************************
   */
  function getLibraryName() {
    return $this->_libraryName;
  }
  function getLibraryDesc() {
    return $this->_libraryDesc;
  }
  function getLibraryImageUrl() {
    return $this->_libraryImageUrl;
  }
  function getShowImageInFooter() {
    return (bool)$this->_useImageInFooter;
  }
  function getLibraryHours() {
    return $this->_libraryHours;
  }
  function getLibraryPhone() {
    return $this->_libraryPhone;
  }
  function getLibraryUrl() {
    return $this->_libraryUrl;
  }
  function getOpacUrl() {
    return $this->_opacUrl;
  }
  function getAdminSessionTimeout() {
    return $this->_adminSessionTimeout;
  }
  function getAdminSessionTimeoutError() {
    return $this->_adminSessionTimeoutError;
  }
  function getPublicSessionTimeout() {
    return $this->_publicSessionTimeout;
  }
  function getPublicSessionTimeoutError() {
    return $this->_publicSessionTimeoutError;
  }
	function getItemsPerPage() {
    return $this->_itemsPerPage;
  }
  function getItemsPerPageError() {
    return $this->_itemsPerPageError;
  }
  function getVersion() {
    return $this->_version;
  }
/*
  function getThemeid() {
    return $this->_themeid;
  }
*/
  function getPurgeHistoryAfterMonths() {
    return $this->_purgeHistoryAfterMonths;
  }
  function getPurgeHistoryAfterMonthsError() {
    return $this->_purgeHistoryAfterMonthsError;
  }
  function getLocale() {
    return $this->_locale;
  }
  function getCharset() {
    return $this->_charset;
  }
  function getHtmlLangAttr() {
    return $this->_htmlLangAttr;
  }

  /****************************************************************************
   * Setter methods for all fields
   * @param string $value new value to set
   * @return void
   * @access public
   ****************************************************************************
   */
  function setLibraryName($value) {
    $this->_libraryName = trim($value);
  }
  function setLibraryDesc($value) {
    $this->_libraryDesc = trim($value);
  }
  function setLibraryImageUrl($value) {
    $this->_libraryImageUrl = trim($value);
  }
  function setShowImageInFooter($value) {
    $this->_useImageInFooter = (bool)$value;
  }
  function setLibraryHours($value) {
    $this->_libraryHours = trim($value);
  }
  function setLibraryPhone($value) {
    $this->_libraryPhone = trim($value);
  }
  function setLibraryUrl($value) {
    $this->_libraryUrl = trim($value);
  }
  function setOpacUrl($value) {
    $this->_opacUrl = trim($value);
  }

  function setAdminSessionTimeout($value) {
    $temp = trim($value);
    if ($temp == '') {
      $this->_adminSessionTimeout = 0;
    } else {
      $this->_adminSessionTimeout = $temp;
    }
  }
  function setAdminSessionTimeoutError($value) {
    $this->_adminSessionTimeoutError = trim($value);
  }
  function setPublicSessionTimeout($value) {
    $temp = trim($value);
    if ($temp == '') {
      $this->_publicSessionTimeout = 0;
    } else {
      $this->_publicSessionTimeout = $temp;
    }
  }
  function setPublicSessionTimeoutError($value) {
    $this->_publicSessionTimeoutError = trim($value);
  }
  function setItemsPerPage($value) {
    $temp = trim($value);
    if ($temp == '') {
      $this->_itemsPerPage = 0;
    } else {
      $this->_itemsPerPage = $temp;
    }
  }
  function setItemsPerPageError($value) {
    $this->_itemsPerPageError = trim($value);
  }
  function setVersion($value) {
    $this->_version = trim($value);
  }
/*
  function setThemeid($value) {
    $temp = trim($value);
    if ($temp == '') {
      $this->_themeid = 0;
    } else {
      $this->_themeid = $temp;
    }
  }
*/
  function setPurgeHistoryAfterMonths($value) {
    $this->_purgeHistoryAfterMonths = trim($value);
  }
  function setLocale($value) {
    $this->_locale = trim($value);
  }
  function setCharset($value) {
    $this->_charset = trim($value);
  }
  function setHtmlLangAttr($value) {
    $this->_htmlLangAttr = trim($value);
  }

	function updateSmartyConfig(&$smarty)
	{
		$fhandle = null;
		$extraSettings = null;

		$configsDir = $smarty->getConfigDir();
		$configsDir = (is_array($configsDir))?$configsDir[0]:$configsDir;

		if(file_exists($configsDir.'DLS.cfg'))
		{
			$fhandle = fopen($configsDir.'DLS.cfg','rb');
			if(!isset($fhandle)) goto WRITE_SETTINGS;
			$isGlobal = true;
			// scan the config for any user entered groups or
			while (($buffer = fgets($fhandle)) !== false)
			{
				if ($isGlobal === true)
				{
					$matches = null;
					// look for square brackets indicating an end to the
					preg_match('/.?(\[.+?\]).*/',$buffer, $matches);
					if ((isset($matches)) && (isset($matches[1])) && ($matches[1] != '[Library]'))
					{
						$extraSettings[] = $buffer;
						$isGlobal = false;
					}
				}
				else // found non global settings so cache them
				{
					$extraSettings[] = $buffer;
				}
			}
			fclose($fhandle);
		}

		WRITE_SETTINGS:
		$confSettings=array();
		$confSettings['global'] = array('itemsPerPage'=>$this->getItemsPerPage(),
										'locale'=>$this->getLocale(),
										'charset'=>$this->getCharset(),
										'htmlLangAttr'=>$this->getHtmlLangAttr());

  		$confSettings['library'] = array('libraryName'=>$this->getLibraryName(),
  										'libraryDescription'=>$this->getLibraryDesc(),
  										'libraryImageUrl'=>$this->getLibraryImageUrl(),
  										'libraryShowImageInFooter'=>$this->getShowImageInFooter(),
 										'libraryHours'=>$this->getLibraryHours(),
										'libraryPhone'=>$this->getLibraryPhone(),
										'libraryUrl'=>$this->getLibraryUrl(),
										'libraryOpacUrl'=>$this->getOpacUrl());

		$fhandle = null;
		$fhandle = fopen($configsDir.'DLS.cfg','wb');

		if(!$fhandle) return;
		fwrite($fhandle,"#global config\n\n");
		while (list($key,$value) = each($confSettings['global']))
		{
			fwrite($fhandle,"$key = '$value'\n");
		}
		fwrite($fhandle,"\n[Library]\n");
		while (list($key,$value) = each($confSettings['library']))
		{
			fwrite($fhandle,"$key = '$value'\n");
		}

		if (isset($extraSettings))
		{
			fwrite($fhandle,"\n#custom config\n\n");
			while (list(,$value) = each($extraSettings))
			{
				fwrite($fhandle,$value);
			}
		}
		fclose($fhandle);

	}


}
