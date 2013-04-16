<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
/**********************************************************************************
 *   Instructions for translators:
 *
 *   All gettext key/value pairs are specified as follows:
 *     $trans["key"] = "<php translation code to set the $text variable>";
 *   Allowing translators the ability to execute php code withint the transFunc string
 *   provides the maximum amount of flexibility to format the languange syntax.
 *
 *   Formatting rules:
 *   - Resulting translation string must be stored in a variable called $text.
 *   - Input arguments must be surrounded by % characters (i.e. %pageCount%).
 *   - A backslash ('\') needs to be placed before any special php characters 
 *     (such as $, ", etc.) within the php translation code.
 *
 *   Simple Example:
 *     $trans["homeWelcome"]       = "\$text='Welcome to OpenBiblio';";
 *
 *   Example Containing Argument Substitution:
 *     $trans["searchResult"]      = "\$text='page %page% of %pages%';";
 *
 *   Example Containing a PHP If Statment and Argument Substitution:
 *     $trans["searchResult"]      = 
 *       "if (%items% == 1) {
 *         \$text = '%items% result';
 *       } else {
 *         \$text = '%items% results';
 *       }";
 *
 **********************************************************************************
 */

#****************************************************************************
#*  Translation text shared by various php files under the navbars dir
#****************************************************************************
$trans["login"]                    = "\$text = 'Login';";
$trans["logout"]                   = "\$text = 'Logout';";
$trans["help"]                     = "\$text = 'Help';";

#****************************************************************************
#*  Translation text for page home.php
#****************************************************************************
$trans["homeSummary"]             = "\$text = 'Summary';";
$trans["homeLicense"]          = "\$text = 'License';";

#****************************************************************************
#*  Translation text for page admin.php
#****************************************************************************
$trans["adminSummary"]             = "\$text = 'Summary';";
$trans["adminStaff"]               = "\$text = 'Staff';";
$trans["adminSettings"]            = "\$text = 'Library Settings';";
$trans["adminMaterialTypes"]       = "\$text = 'Material Types';";
$trans["adminCollections"]         = "\$text = 'Collections';";
$trans["adminThemes"]              = "\$text = 'Themes';";
$trans["adminTranslation"]         = "\$text = 'Translation';";
$trans["adminDevices"]				= "\$text = 'Devices';";
$trans["adminTasks"]				= "\$text = 'Tasks';";

#****************************************************************************
#*  Translation text for page cataloging.php
#****************************************************************************
$trans["catalogSummary"]           = "\$text = 'Summary';";
$trans["catalogSearch"]           = "\$text = 'Search';";
$trans["catalogNew"]            = "\$text = 'New Bibliography';";
$trans["catalogUploadMarc"]            = "\$text = 'Upload MARC Records';";
$trans["catalogExternalSearch"]            = "\$text = 'Search Z39.50 Servers';";


$trans["catalogSearch2"]           = "\$text = 'Bibliography Search';";
$trans["catalogResults"]           = "\$text = 'Search Results';";
$trans["catalogBibInfo"]           = "\$text = 'Biblio Info';";
$trans["catalogBibEdit"]           = "\$text = 'Edit-Basic';";
$trans["catalogBibEditMarc"]       = "\$text = 'Edit-MARC';";
$trans["catalogBibMarcNewFld"]     = "\$text = 'New MARC Field';";
$trans["catalogBibMarcNewFldShrt"] = "\$text = 'New MARC';";
$trans["catalogBibMarcEditFld"]    = "\$text = 'Edit MARC Fld';";
$trans["catalogCopyNew"]           = "\$text = 'New Copy';";
$trans["catalogCopyEdit"]          = "\$text = 'Edit Copy';";
$trans["catalogHolds"]             = "\$text = 'Hold Requests';";
$trans["catalogDelete"]            = "\$text = 'Delete';";
$trans["catalogBibNewLike"]        = "\$text = 'New Like';";

$trans["catalogRecommendations"]              = "\$text = 'Recommendations';";
$trans["Upload Marc Data"]         = "\$text = 'Upload Marc Data';";

#****************************************************************************
#*  Translation text for page reports.php
#****************************************************************************
$trans["reportsSummary"]           = "\$text = 'Available Reports';";
$trans["reportsReportListLink"]    = "\$text = 'Report List';";
$trans["reportsLabelsLink"]        = "\$text = 'Print Labels';";
$trans["reportsLettersLink"]        = "\$text = 'Print Letters';";


#****************************************************************************
#*  Translation text for page opac.php
#****************************************************************************
$trans["catalogSearch1"]           = "\$text = 'Search';";
$trans["catalogSearch2"]           = "\$text = 'Books Search';";
$trans["catalogResults"]           = "\$text = 'Search Results';";
$trans["catalogBibInfo"]           = "\$text = 'Book Info';";

#****************************************************************************
#*  Translation text for page users.php
#****************************************************************************
$trans["userDelete"]            = "\$text = 'Delete User';";
$trans["userInfo"]="\$text = 'User Info';";
$trans["userEditInfo"]="\$text = 'Edit User Info';";
$trans["userHistory"]= "\$text = 'User History';";
$trans["usersSearch"]= "\$text = 'Search Users';";
$trans["usersNew"]= "\$text = 'Add New User';";


#****************************************************************************
#*  Translation text for page devices.php
#****************************************************************************
$trans["deviceEdit"]            = "\$text = 'Edit Devices';";
$trans["deviceAdd"]				="\$text = 'Add Devices';";
$trans["devicesConnected"]		="\$text = 'Connected Devices';";
$trans["deviceAddThis"]			= "\$text = 'Add This Device';";
$trans["deviceAssign"]			= "\$text = 'Assign this device to a user';";
$trans["devicesSearch"]             = "\$text='Devices Search';"; 


#****************************************************************************
#* Translation text for Library of Congress SRU module
#****************************************************************************
  $trans["LOCsearch"]                 = "\$text = 'Library of Congress';";


#****************************************************************************
#* Translation text for Amazon mod
#****************************************************************************
$trans["amazon_Search"]             = "\$text = 'Amazon Search';";


  
?>
