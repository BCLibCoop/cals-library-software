<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  /****************************************************************************
   * Reading settings from database
   ****************************************************************************
   */
  include_once(__ROOT__."classes/Settings.php");
  include_once(__ROOT__."classes/SettingsQuery.php");
  include_once(__ROOT__."functions/errorFuncs.php");

  /****************************************************************************
   * Reading general settings
   ****************************************************************************
   */
  $setQ = new SettingsQuery();
  $setQ->connect();
  if ($setQ->errorOccurred()) {
    $setQ->close();
    displayErrorPage($setQ);
  }
  $setQ->execSelect();
  if ($setQ->errorOccurred()) {
    $setQ->close();
    displayErrorPage($setQ);
  }
  $set = $setQ->fetchRow();
  $setQ->close();

  /****************************************************************************
   * general settings constants
   ****************************************************************************
   */
  define("OBIB_LIBRARY_NAME",$set->getLibraryName());
  define("OBIB_LIBRARY_HOURS",$set->getLibraryHours());
  define("OBIB_LIBRARY_PHONE",$set->getLibraryPhone());
  define("OBIB_LIBRARY_URL",$set->getLibraryUrl());
  define("OBIB_LIBRARY_DESC",$set->getLibraryDesc());
  define("OBIB_OPAC_URL",$set->getOpacUrl());
  define("OBIB_ADMIN_SESSION_TIMEOUT",$set->getAdminSessionTimeout());
  define("OBIB_PUBLIC_SESSION_TIMEOUT",$set->getPublicSessionTimeout());
  define("OBIB_ITEMS_PER_PAGE",$set->getItemsPerPage());
  define("OBIB_DB_VERSION",$set->getVersion());
//  define("OBIB_THEMEID",$set->getThemeid());
  define("DLS_HASH_PREFIX","DLS_ABWA"); // !TODO -- Make this into a db field

	if($set->getLocale()=="")
		$set->setLocale('en');

  define("OBIB_LOCALE",$set->getLocale());

  if ($set->getLocale()=="en") {
    obib_setlocale(LC_MONETARY,'en_US.iso885915', 'en', 'en_US', 'eng');
    obib_setlocale(LC_NUMERIC,'en_US.iso885915', 'en', 'en_US', 'eng');
  }
  elseif ($set->getLocale()=="de") {
    obib_setlocale(LC_MONETARY, 'de_DE', 'de_DE@euro', 'de', 'ge', 'deu_deu', 'deu', 'Germany', 'de_DE.ISO8859-1');
    obib_setlocale(LC_NUMERIC, 'de_DE', 'de_DE@euro', 'de', 'ge', 'deu_deu', 'deu', 'Germany', 'de_DE.ISO8859-1');
  }
  else {
    obib_setlocale(LC_MONETARY,$set->getLocale());
    obib_setlocale(LC_NUMERIC,$set->getLocale());
  }

  define("OBIB_CHARSET",$set->getCharset());
  define("OBIB_HTML_LANG_ATTR",$set->getHtmlLangAttr());
  define("OBIB_LIBRARY_USE_IMAGE_ONLY",$set->getShowImageInFooter());
  define("OBIB_LIBRARY_IMAGE_URL",$set->getLibraryImageUrl());

