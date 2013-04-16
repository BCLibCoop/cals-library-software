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
$trans["adminSubmit"]              = "\$text = 'Submit';";
$trans["adminCancel"]              = "\$text = 'Cancel';";
$trans["adminDelete"]              = "\$text = 'Delete';";
$trans["adminUpdate"]              = "\$text = 'Update';";
$trans["adminYes"]                 = "\$text = 'Yes';";
$trans["adminNo"]                 = "\$text = 'No';";
$trans["adminAdd"]                 = "\$text = 'Add';";
$trans["adminEdit"]                 = "\$text = 'Edit Details';";
$trans["adminDel"]                 = "\$text = 'Delete';";
$trans["adminFootnote"]            = "\$text = 'Fields marked with %symbol% are required.';";
$trans["adminDescription"]                 = "\$text = 'Description';";
$trans["adminDefaultPrefix"]                 = "\$text = 'Use as default ';";
$trans["adminValidateDescriptionNotEmpty"]                 = "\$text = 'Description must not be empty.';";

#****************************************************************************
#*  Translation text for page noauth.tpl
#****************************************************************************
$trans["notAuthMsg"]                = "\$text = 'You are not authorized to use the Admin tab.';";

#****************************************************************************
#*  Translation text for page index.php
#****************************************************************************
$trans["adminSummaryHeader"]                 = "\$text = 'Admin';";
$trans["adminSummaryDesc"]                = "\$text = 'Use the functions located above to manage your library\'s staff and administrative records.';";

#****************************************************************************
#*  Translation text for page collection_del.php
#****************************************************************************
$trans["adminCollection_delSuccess"]                 = "\$text = ', has been deleted.';";
$trans["adminCollection_delConfirmText"]                 = "\$text = 'Are you sure you want to delete the collection, ';";

#****************************************************************************
#*  Translation text for page collection_edit.php
#****************************************************************************
$trans["adminCollection_editSuccess"]                 = "\$text = ', has been updated.';";
$trans["adminCollection_editHeader"]                 = "\$text = 'Edit Collection';";
$trans["adminCollection_editCollectionSuffix"]                 = "\$text = 'collection';";
$trans["adminCollection_editNote"]                 = "\$text = '*Note:';";
$trans["adminCollection_editNoteText"]                 = "\$text = 'Setting the days due back to zero makes the entire collection unavailable for checkout.';";

#****************************************************************************
#*  Translation text for page collections_list.php
#****************************************************************************
$trans["adminCollections_listAddNewCollection"]                 = "\$text = 'Add New Collection';";
$trans["adminCollections_listCollections"]                 = "\$text = 'Collections:';";
$trans["adminCollections_listFunction"]                 = "\$text = 'Function';";
$trans["adminCollections_listDescription"]                 = "\$text = 'Description';";
$trans["adminCollections_listDefault"]                 = "\$text = 'Default<br/>Choice';";
$trans["adminCollections_listBibliographycount"]                 = "\$text = 'Bibliography<br>Count';";
$trans["adminCollections_ListNote"]                 = "\$text = '*Note:';";
$trans["adminCollections_ListNoteText"]                 = "\$text = 'The delete function is only available on collections that have a bibliography count of zero.<br>If you wish to delete a collection with a bibliography count greater than zero you will first need to change the material type on those bibliographies to another material type.';";

#****************************************************************************
#*  Translation text for page collection_new.php
#****************************************************************************
$trans["adminCollection_newHeader"]                 = "\$text = 'Add New Collection:';";
$trans["adminCollection_newNote"]                 = "\$text = '*Note:';";
$trans["adminCollection_newNoteText"]                 = "\$text = 'Setting the days due back to zero makes the entire collection unavailable for checkout.';";
$trans["adminCollection_newSuccess"]                 = "\$text = ', has been added.';";

#****************************************************************************
#*  Translation text for page material_del.php
#****************************************************************************
$trans["adminMaterial_delConfirm"]                 = "\$text = 'Are you sure you want to delete material type, ';";
$trans["adminMaterial_delSuccess"]                 = "\$text = ' successfully removed';";

#****************************************************************************
#*  Translation text for page material_edit.php
#****************************************************************************
$trans["adminMaterial_editDescription"]                 = "\$text = 'Edit Material Type:';";
$trans["adminMaterial_editRecommend"]                 = "\$text = 'Select recommendations&nbsp;<br/>&nbsp;from this material? :';";
$trans["adminMaterial_materialSuffix"]                 = "\$text = 'material? :';";
$trans["adminMaterial_editUnlimited"]                 = "\$text = '(enter 0 for unlimited)';";
$trans["adminMaterial_editImagefile"]                 = "\$text = 'Image File :';";
$trans["adminMaterial_editDefault"]                 = "\$text = 'Use as Default? :';";
$trans["adminMaterial_editNote"]                 = "\$text = '*Note:';";
$trans["adminMaterial_editNoteText"]                 = "\$text = 'Image files must be located in the openbiblio/images directory.';";
$trans["adminMaterial_validateImageNameNotEmpty"]                 = "\$text = 'You must enter an image filename.';";
$trans["adminMaterial_editSuccess"]                 = "\$text = ', has been updated.';";

#****************************************************************************
#*  Translation text for page materials_list.php
#****************************************************************************
$trans["adminMaterials_listAddMaterialType"]                 = "\$text = 'Add New Material Type';";
$trans["adminMaterials_listMaterialTypes"]                 = "\$text = 'Material Types:';";
$trans["adminMaterials_listFunction"]                 = "\$text = 'Function';";
$trans["adminMaterials_listDefault"]                 = "\$text = 'Default<br/>Material';";
$trans["adminMaterials_listRecommend"]                 = "\$text = 'Recommend<br/>Material';";
$trans["adminMaterials_listImageFile"]                 = "\$text = 'Image<br>File';";
$trans["adminMaterials_listBibCount"]                 = "\$text = 'Bibliography<br>Count';";
$trans["adminMaterials_listMarcFields"]                 = "\$text = 'MARC Fields';";
$trans["adminMaterials_listNote"]                 = "\$text = '*Note:';";
$trans["adminMaterials_listNoteText"]                 = "\$text = 'The delete function is only available on material types that have a bibliography count of zero.  If you wish to delete a material type with a bibliography count greater than zero you will first need to change the material type on those bibliographies to another material type.';";

#****************************************************************************
#*  Translation text for page material_new.php
#****************************************************************************
$trans["adminMaterial_newHeader"]                 = "\$text = 'New Material Type';";
$trans["adminMaterial_new_formNoteText"]                 = "\$text = 'Image files must be located in the openbiblio/images directory.';";
$trans["adminMaterial_newSuccess"]                 = "\$text = ', has been added.';";

#****************************************************************************
#*  Translation text for page material_marc_list.php
#****************************************************************************
$trans["adminMaterial_marcDeleteConfirm"]                 = "\$text = 'Are you sure you want to delete tag ';";

#****************************************************************************
#*  Translation text for page material_marc_list.php
#****************************************************************************
$trans["adminMaterial_marcListHeader"]                 = "\$text = 'Custom fields for ';";
$trans["adminMaterial_marcListAddMarc"]                 = "\$text = 'Add Custom Marc Field';";
$trans["adminMaterial_marcListShowInOpac"]                 = "\$text = 'Show in<br/>Opac';";
$trans["adminMaterial_marcListTag"]                 = "\$text = 'Tag<br/>No.';";
$trans["adminMaterial_marcListSubfield"]                 = "\$text = 'Subfield<br/>Code';";
$trans["adminMaterial_marcListRequired"]                 = "\$text = 'Required';";
$trans["adminMaterial_marcListFieldValues"]                 = "\$text = 'Field<br/>Values';";
$trans["adminMaterial_marcListRequired"]                 = "\$text = 'Required?';";
$trans["adminMaterial_marcListFieldType"]                 = "\$text = 'Input<br/>Field Type';";

#****************************************************************************
#*  Translation text for page material_marc_edit.php
#****************************************************************************
$trans["adminMaterial_marcEditHeader"]					="\$text = 'Edit Custom Field Info';";
$trans["adminMaterial_marcEditShowInOpac"]                 = "\$text = 'Show field in Opac? :';";
$trans["adminMaterial_marcEditTag"]                 = "\$text = 'Tag';";
$trans["adminMaterial_marcEditSubfield"]                 = "\$text = 'Subfield';";
$trans["adminMaterial_marcEditFieldType"]                 = "\$text = 'Field<br/>Type';";
$trans["adminMaterial_marcEditFieldValues"]                 = "\$text = 'Field<br/>Values';";
$trans["adminMaterial_marcEditRequired"]                 = "\$text = 'Is required? :';";
$trans["adminMaterial_marcEditFieldType"]                 = "\$text = 'Input Field Type :';";
$trans["adminMaterial_marcEditTextField"]                 = "\$text = 'Text Field';";
$trans["adminMaterial_marcEditTextArea"]                 = "\$text = 'Text Area';";
$trans["adminMaterial_marcEditCheckbox"]                 = "\$text = 'Checkbox';";
$trans["adminMaterial_marcEditSelectList"]                 = "\$text = 'Select List';";
$trans["adminMaterial_marcEditSuccess"]                 = "\$text = 'Successfully Updated (%tag%%subfield%) %desc%';";
$trans["adminMaterial_marcEditError"]                 = "\$text = 'Error Updating Field %tag%%subfield%';";
$trans["adminMaterial_validateMarcSubfieldIsAlphaNum"]                 = "\$text = 'Must be an Alphanumeric character';";
$trans["adminMaterial_validateMarcTagIsInteger"]                 = "\$text = 'Must be an integer';";
$trans["adminMaterial_validateMarcTagRange"]                 = "\$text = 'Tags are 0-9999';";
$trans["adminMaterial_validateMarcNotEmptySuffix"]                 = "\$text = ' must not be empty';";

#****************************************************************************
#*  Translation text for page material_marc_new.php
#****************************************************************************
$trans["adminMaterial_marcNewHeader"]					="\$text = 'New Custom Field';";

#****************************************************************************
#*  Translation text for page settings_edit.php
#****************************************************************************
$trans["adminSettings_updated"]                 = "\$text = 'Setting updated.';";
$trans["adminSettings_editHeader"]                 = "\$text = 'Library Settings';";
$trans["adminSettings_libName"]                 = "\$text = 'Library Name:';";
$trans["adminSettings_libDesc"]                 = "\$text = 'Library Description:';";
$trans["adminSettings_libImageUrl"]                 = "\$text = 'Library Image URL:';";
$trans["adminSettings_showImageInFooter"]                 = "\$text = 'Show Image in Footer:';";
$trans["adminSettings_libHours"]                 = "\$text = 'Library Hours:';";
$trans["adminSettings_libPhone"]                 = "\$text = 'Library Phone:';";
$trans["adminSettings_libUrl"]                 = "\$text = 'Library URL:';";
$trans["adminSettings_opacUrl"]                 = "\$text = 'OPAC URL:';";
$trans["adminSettings_adminSessionTimeout"]                 = "\$text = 'Admin Session Timeout:';";
$trans["adminSettings_publicSessionTimeout"]                 = "\$text = 'Public Session Timeout:';";
$trans["adminSettings_minutes"]                 = "\$text = 'minutes';";
$trans["adminSettings_searchResults"]                 = "\$text = 'Search Results:';";
$trans["adminSettings_itemsPerPage"]                 = "\$text = 'Items per page';";
$trans["adminSettings_purgeBibHistory"]                 = "\$text = 'Purge Bibliography History After:';";
$trans["adminSettings_months"]                 = "\$text = 'months';";
$trans["adminSettings_blockCheckouts"]                 = "\$text = 'Block Checkouts When Fines Due:';";
$trans["adminSettings_locale"]                 = "\$text = 'Locale:';";
$trans["adminSettings_htmlChar"]                 = "\$text = 'HTML Charset:';";
$trans["adminSettings_htmlTagLangAttr"]                 = "\$text = 'HTML Tag Lang Attribute:';";
$trans["adminSettings_validateNotEmpty"]                 = "\$text = 'Must not be empty';";
$trans["adminSettings_validateAdminSessionRange"]                 = "\$text = 'Minimum of 10. Recommended 720';";
$trans["adminSettings_validatePublicSessionRange"]                 = "\$text = 'Minimum of 10. Recommended 120';";
$trans["adminSettings_validateItemsPerPageRange"]                 = "\$text = 'Minimum of 1. Recommended 10';";

#****************************************************************************
#*  Translation text for page staff_del.php
#****************************************************************************
$trans["adminStaff_delDeleted"]                 = "\$text = ', has been removed.';";
$trans["adminStaff_delConfirmText"]                 = "\$text = 'Are you sure you want to remove staff member, ';";

#****************************************************************************
#*  Translation text for page staff_edit.php
#****************************************************************************
$trans["adminStaff_editSuccess"]                 = "\$text = ', has been updated.';";
$trans["adminStaff_editError"]                 = "\$text = 'Error updating staff member, ';";
$trans["adminStaff_editHeader"]                 = "\$text = 'Edit Staff Member';";
$trans["adminStaff_editFormHeader"]                 = "\$text = 'Member Details:';";
$trans["adminStaff_editSurname"]                 = "\$text = 'Surname';";
$trans["adminStaff_editFirstname"]                 = "\$text = 'First Name';";
$trans["adminStaff_editUsername"]                 = "\$text = 'Username';";
$trans["adminStaff_editAuths"]                 = "\$text = 'Tab Authorizations';";
$trans["adminStaff_editAuthUsers"]                 = "\$text = 'Users';";
$trans["adminStaff_editAuthDevices"]                 = "\$text = 'Devices';";
$trans["adminStaff_editAuthCatalog"]                 = "\$text = 'Catalog';";
$trans["adminStaff_editAuthAdmin"]                 = "\$text = 'Admin';";
$trans["adminStaff_editAuthReports"]                 = "\$text = 'Reports';";
$trans["adminStaff_editSuspended"]                 = "\$text = 'Suspended';";
$trans["adminStaff_editUpdateUser"]                 = "\$text = 'Update User';";

#****************************************************************************
#*  Translation text for page staff_list.php
#****************************************************************************
$trans["adminStaff_listHeader"]                 = "\$text = 'Staff Members';";
$trans["adminStaff_listAddNewLabel"]                 = "\$text = 'Add New Staff Member';";
$trans["adminStaff_listFunctionLabel"]                 = "\$text = 'Functions';";
$trans["adminStaff_listPwdLabel"]                 = "\$text = 'Change Password';";


#****************************************************************************
#*  Translation text for page staff_new.php
#****************************************************************************
$trans["adminStaff_newAdded"]                 = "\$text = ', has been added.';";
$trans["adminStaff_newHeader"]          	= "\$text = 'Add New Staff Member:';";
$trans["adminStaff_newPassword"]          = "\$text = 'Password';";
$trans["adminStaff_newReenterPassword"]   = "\$text = 'Re-enter Password';";

#****************************************************************************
#*  Translation text for page staff_pwd.php
#****************************************************************************
$trans["adminStaff_passwordSuccess"]   = "\$text = 'Successfully changed the password for ';";
$trans["adminStaff_passwordNotEmpty"]   = "\$text = 'Password can not be empty.';";
$trans["adminStaff_passwordNotEqual"]   = "\$text = 'Passwords are not the same.';";
$trans["adminStaff_passwordHeader"] = "\$text = 'Change the password for, ';";

#****************************************************************************
#*  Translation text for theme pages
#****************************************************************************
$trans["adminTheme_Return"]                 = "\$text = 'return to theme list';";
$trans["adminTheme_Theme"]                 = "\$text = 'Theme, ';";

#****************************************************************************
#*  Translation text for page theme_del.php
#****************************************************************************
$trans["adminTheme_Deleted"]                 = "\$text = ', has been deleted.';";
#****************************************************************************
#*  Translation text for page theme_del_confirm.php
#****************************************************************************
$trans["adminTheme_Deleteconfirm"]                 = "\$text = 'Are you sure you want to delete theme, ';";
#****************************************************************************
#*  Translation text for page theme_edit.php
#****************************************************************************
$trans["adminTheme_Updated"]                 = "\$text = ', has been updated.';";

#****************************************************************************
#*  Translation text for page theme_edit_form.php
#****************************************************************************
$trans["adminTheme_Preview"]                 = "\$text = 'Preview Theme Changes';";

#****************************************************************************
#*  Translation text for page theme_list.php
#****************************************************************************
$trans["adminTheme_Changetheme"]                 = "\$text = 'Change Theme In Use:';";
$trans["adminTheme_Choosetheme"]                 = "\$text = 'Choose a New Theme:';";
$trans["adminTheme_Addnew"]                 = "\$text = 'Add New Theme';";
$trans["adminTheme_themes"]                 = "\$text = 'Themes:';";
$trans["adminTheme_function"]                 = "\$text = 'Function';";
$trans["adminTheme_Themename"]                 = "\$text = 'Theme Name';";
$trans["adminTheme_Usage"]                 = "\$text = 'Usage';";
$trans["adminTheme_Copy"]                 = "\$text = 'copy';";
$trans["adminTheme_Inuse"]                 = "\$text = 'in use';";
$trans["adminTheme_Note"]                 = "\$text = '*Note:';";
$trans["adminTheme_Notetext"]                 = "\$text = 'The delete function is not available on the theme that is currently in use.';";

#****************************************************************************
#*  Translation text for page theme_list.php
#****************************************************************************
$trans["adminTheme_Theme2"]                 = "\$text = 'Theme:';";
$trans["adminTheme_Tablebordercolor"]                 = "\$text = 'Table Border Color:';";
$trans["adminTheme_Errorcolor"]                 = "\$text = 'Error Color:';";
$trans["adminTheme_Tableborderwidth"]                 = "\$text = 'Table Border Width:';";
$trans["adminTheme_Tablecellpadding"]                 = "\$text = 'Table Cell Padding:';";
$trans["adminTheme_Title"]                 = "\$text = 'Title';";
$trans["adminTheme_Mainbody"]                 = "\$text = 'Main Body';";
$trans["adminTheme_Navigation"]                 = "\$text = 'Navigation';";
$trans["adminTheme_Tabs"]                 = "\$text = 'Tabs';";
$trans["adminTheme_Backgroundcolor"]                 = "\$text = 'Background Color:';";
$trans["adminTheme_Fontface"]                 = "\$text = 'Font Face:';";
$trans["adminTheme_Fontsize"]                 = "\$text = 'Font Size:';";
$trans["adminTheme_Bold"]                 = "\$text = 'bold';";
$trans["adminTheme_Fontcolor"]                 = "\$text = 'Font Color:';";
$trans["adminTheme_Linkcolor"]                 = "\$text = 'Link Color:';";
$trans["adminTheme_Align"]                 = "\$text = 'Align:';";
$trans["adminTheme_Right"]                 = "\$text = 'Right';";
$trans["adminTheme_Left"]                 = "\$text = 'Left';";
$trans["adminTheme_Center"]                 = "\$text = 'Center';";

$trans["adminTheme_HeaderWording"]                 = "\$text = 'Edit';";


#****************************************************************************
#*  Translation text for page theme_new.php
#****************************************************************************
$trans["adminTheme_new_Added"]                 = "\$text = ', has been added.';";

#****************************************************************************
#*  Translation text for page theme_new_form.php
#****************************************************************************

#****************************************************************************
#*  Translation text for page theme_preview.php
#****************************************************************************
$trans["adminTheme_preview_Themepreview"]                 = "\$text = 'Theme Preview';";
$trans["adminTheme_preview_Librarytitle"]                 = "\$text = 'Library Title';";
$trans["adminTheme_preview_CloseWindow"]                 = "\$text = 'Close Window';";
$trans["adminTheme_preview_Home"]                 = "\$text = 'Home';";
$trans["adminTheme_preview_Circulation"]   = "\$text = 'Circulation';";
$trans["adminTheme_preview_Cataloging"]    = "\$text = 'Cataloging';";
$trans["adminTheme_preview_Admin"]         = "\$text = 'Admin';";
$trans["adminTheme_preview_Samplelink"]    = "\$text = 'Sample Link';";
$trans["adminTheme_preview_Thisstart"]     = "\$text = 'This is a preview of the ';";
$trans["adminTheme_preview_Thisend"]       = "\$text = 'theme.';";
$trans["adminTheme_preview_Samplelist"]    = "\$text = 'Sample List:';";
$trans["adminTheme_preview_Tableheading"]  = "\$text = 'Table Heading';";
$trans["adminTheme_preview_Sampledatarow1"]= "\$text = 'Sample data row 1';";
$trans["adminTheme_preview_Sampledatarow2"]= "\$text = 'Sample data row 2';";
$trans["adminTheme_preview_Sampledatarow3"]= "\$text = 'Sample data row 3';";
$trans["adminTheme_preview_Samplelink"]    = "\$text = 'sample link';";
$trans["adminTheme_preview_Sampleerror"]   = "\$text = 'sample error';";
$trans["adminTheme_preview_Sampleinput"]   = "\$text = 'Sample Input';";
$trans["adminTheme_preview_Samplebutton"]  = "\$text = 'Sample Button';";
$trans["adminTheme_preview_Poweredby"]     = "\$text = 'Powered by OpenBiblio';";
$trans["adminTheme_preview_Copyright"]     = "\$text = 'Copyright &copy; 2002-2005 Dave Stevens';";
$trans["adminTheme_preview_underthe"]      = "\$text = 'under the';";
$trans["adminTheme_preview_GNU"]           = "\$text = 'GNU General Public License';";

#****************************************************************************
#*  Translation text for page theme_use.php
#****************************************************************************

$trans["deviceSearch"]="\$text = 'Device Search';";
$trans["deviceNew"]="\$text = 'New Device';";


?>
