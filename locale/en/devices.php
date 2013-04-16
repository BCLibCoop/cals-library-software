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
#*  Common translation text shared among multiple pages
#****************************************************************************
$trans["deviceCancel"]              = "\$text = 'Cancel';";
$trans["deviceDelete"]              = "\$text = 'Delete';";
$trans["deviceAdd"]                 = "\$text = 'Add New Device';";
$trans["deviceAddThis"]                 = "\$text = 'Add This Device';";
$trans["deviceEdit"]			= "\$text='Edit Device Info';";
$trans["deviceUpdate"]            = "\$text='Update Device';";
$trans["deviceAssign"]            = "\$text='Assign Device';";
$trans["deviceValidate_barcodeNotEmpty"]            = "\$text='Barcode must not be empty';";
$trans["deviceValidate_barcodeOnFile"]            = "\$text='Barcode already in use';";

#****************************************************************************
#*  Translation text for page noauth.tpl
#****************************************************************************
$trans["notAuthMsg"]                = "\$text = 'You are not authorised to use the Devices tab.';";

#****************************************************************************
#*  Translation text for page device_list.php 
#****************************************************************************
$trans["devicesList_contentHeader"]            = "\$text='Search for a device';";
$trans["devicesList_contentDesc"]            = "\$text='';";
$trans["devicesList_searchClientName"]			= "\$text='Search Client Names';";
$trans["devicesList_searchBarcode"]			= "\$text='Search Barcodes';";
$trans["devicesList_notAssigned"]			= "\$text='Not Assigned';";


#****************************************************************************
#*  Translation text for page devices_connected.php 
#****************************************************************************
$trans["deviceEditUserName"]          = "\$text='User Name';";
$trans["devicesConnected_contentHeader"] = "\$text='Connected Devices';";
$trans["devicesConnected_assignedTo"] = "\$text='Assigned To';";
$trans["devicesConnected_notFound"] = "\$text='Device Not On File';";
$trans["devicesConnected_assignable"] = "\$text='Available For Assignment';";

#****************************************************************************
#*  Translation text for page device_edit.php 
#****************************************************************************
$trans["deviceEditUserName"]          = "\$text='User Name';";
$trans["deviceEdit_contentHeader"]         = "\$text='Edit Cartridge Details';";
$trans["deviceEdit_usersFullName"]			= "\$text='Assigned to :';";
$trans["deviceEdit_username"]			= "\$text='Username :';";
$trans["deviceEdit_enclosureBarcode"]			= "\$text='Cartridge Barcode :';";
$trans["deviceEdit_editSuccess"]			= "\$text='Cartridge with barcode %barcode% successfully updated';";

#****************************************************************************
#*  Translation text for page device_add.php 
#****************************************************************************
$trans["deviceAdd_contentHeader"]         = "\$text='Add Cartridge Details';";
$trans["deviceAdd_addSuccess"]         = "\$text='Cartridge with barcode %barcode% successfully added';";