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
$trans["catalogSubmit"]            = "\$text = 'Submit';";
$trans["catalogCancel"]            = "\$text = 'Cancel';";
$trans["catalogBack"]            = "\$text = 'Back';";
$trans["catalogUpdate"]            = "\$text = 'Update';";
$trans["catalogRefresh"]           = "\$text = 'Refresh';";
$trans["catalogDelete"]            = "\$text = 'Delete';";
$trans["catalogAdd"]            	= "\$text = 'Add';";
$trans["catalogFootnote"]          = "\$text = 'Fields marked with %symbol% are required.';";
$trans["AnswerYes"]                = "\$text = 'Yes';";
$trans["AnswerNo"]                 = "\$text = 'No';";

$trans["catalogValidate_notEmpty"]            = "\$text = 'Field must not be empty.';";
$trans["catalogValidate_isRequired"]            = "\$text = 'Field %tag% is required.';";
$trans["catalogValidate_notUnique"]            = "\$text = 'Field %tag% must be unique.';";

#****************************************************************************
#*  Translation text for page noauth.tpl
#****************************************************************************
$trans["notAuthMsg"]                = "\$text = 'You are not authorized to use the Catalog tab.';";

#****************************************************************************
#*  Translation text for page catalog_search.php
#****************************************************************************
$trans["catalogSearch_contentHeader"]                 	= "\$text = 'Search for a record';";
$trans["catalogSearch_barHeaderTitle"]               	= "\$text = 'Title';";
$trans["catalogSearch_barHeaderAuthor"]              	= "\$text = 'Author';";
$trans["catalogSearch_barHeaderSubject"]             	= "\$text = 'Subject';";
$trans["catalogSearch_barHeaderSysNumber"]   			= "\$text='System No.';";
$trans["catalogSearch_viewEntryDetails"]   			= "\$text='View Details';";
$trans["catalogEntry_viewRestrictedPublicWarning"] = "\$text='Distribution of this title is restricted to patrons who have a vision impairment, or a physical or learning disability. You will be required to provide a username and password to download. If you have questions, please email <a href=\"mailto:nnels@libraries.coop\">nnels@libraries.coop</a>';";
$trans["catalogEntry_viewRestrictedAdminWarning"]   			= "\$text='This title is restricted';";
$trans["catalogEntry_viewAddCopyLabel"]   			= "\$text='Add a new copy';";
$trans["catalogEntry_viewNoCopiesFound"]   			= "\$text='No copies on file';";
$trans["catalogEntry_viewEditCopyButtonLabel"]   			= "\$text='Edit this copy';";
$trans["catalogEntry_viewDeleteCopyButtonLabel"]   			= "\$text='Delete this copy';";
$trans["catalogEntry_viewCopyNotFoundError"]   			= "\$text='This file cannot be found. Please report this to the Library Administrator.';";
$trans["catalogEntry_viewDownloadButtonLabel"]   			= "\$text='Download this copy';";
$trans["catalogEntry_viewCopyType"]   			= "\$text='Format Type';";
$trans["catalogEntry_viewCopySize"]   			= "\$text='File Size';";
$trans["catalogEntry_viewCopyReadingTime"]   			= "\$text='Playback Time<br/>(approx)';";
$trans["catalogEntry_viewGeneralInfo"]   			= "\$text='General Information';";
$trans["catalogEntry_viewAdditionalInfo"]   			= "\$text='Additional Information';";
$trans["catalogEntry_viewMaterialType"]   			= "\$text='Material Type';";
$trans["catalogEntry_viewAudienceType"]   			= "\$text='Reading Level';";
$trans["catalogEntry_viewCollectionType"]   			= "\$text='Collection Type';";
$trans["catalogEntry_viewEditBasicButtonLabel"]   			= "\$text='Edit this entry';";
$trans["catalogEntry_viewViewMarcButtonLabel"]   			= "\$text='View Marc Fields';";
$trans["catalogEntry_viewNewLikeButtonLabel"]   			= "\$text='New entry like this';";
$trans["catalogEntry_viewDeleteButtonLabel"]   			= "\$text='Delete';";
$trans["catalogEntry_viewTagDescriptionNotFound"]   			= "\$text='No Description Available (Tag %tag%)';";
$trans["catalogEntry_viewCallNumber"]     = "\$text = 'Call Number';";
$trans["catalogEntry_viewShowInOpac"]      = "\$text = 'Show in OPAC?';";
$trans["catalogEntry_viewRestricted"]      = "\$text = 'Restricted Content';";
$trans["catalogEntry_viewSaleable"]      = "\$text = 'On Sell Allowed?';";
$trans["catalogEntry_viewEntryDeleteConfirm"]   	= "\$text='Yes I want to completely remove this entry.';";
$trans["catalogEntry_viewEntryDeleteCopyConfirm"]   	= "\$text='Yes I want to completely remove this copy.';";
$trans["catalogEntry_viewDeleteCopiesStillAvailable"]   	= "\$text='Entries cannot be deleted while they still have copies associated with them.';";

$trans["catalogEntry_deleteSuccess"]   			= "\$text='Successfully removed, %title%';";
$trans["catalogEntry_deleteError"]   			= "\$text='Error removing entry, (%bibid%) %title%';";

$trans["catalogEntry_copyEditHeader"]   			= "\$text='Edit copy info for, %title%';";
$trans["catalogEntry_copyEditFormLabel"]   			= "\$text='Copy Info:';";
$trans["catalogEntry_copyEditFilePathLabel"]   			= "\$text='File Path (relative to root folder)';";
$trans["catalogEntry_copyEditContentType"]  = "\$text = 'Content Type';";
$trans["catalogEntry_copyEditFormatType"] = "\$text = 'Storage Type';";
$trans["catalogEntry_copyUpdateSuccess"]  = "\$text = 'Successfully updated the copy.';";
$trans["catalogEntry_copyUpdateError"] = "\$text = 'There was an Error updating the copy.';";

$trans["catalogEntry_copyNewHeader"]   			= "\$text='Add a new copy for, %title%';";
$trans["catalogEntry_copyNewSuccess"]  = "\$text = 'Successfully added a new copy.';";
$trans["catalogEntry_copyNewError"] = "\$text = 'There was an Error adding the copy.';";

$trans["catalogEntry_newLikeHeader"]   			= "\$text='New Entry like %title%';";
$trans["catalogEntry_newLikeSuccess"]   			= "\$text='Successfully added new entry.';";
$trans["catalogEntry_newLikeError"]   			= "\$text='Error adding entry like %title%.';";

$trans["catalogEntry_newHeader"]   			= "\$text='New Entry';";
$trans["catalogEntry_newSuccess"]   			= "\$text='Successfully added new entry.';";
$trans["catalogEntry_newError"]   			= "\$text='Error adding entry %title%.';";

$trans["catalogEntry_editHeader"]   			= "\$text='Edit Details for %title%';";
$trans["catalogEntry_editMaterialFields"]   	= "\$text='Material Specific Fields';";
$trans["catalogEntry_editGetNextSysNum"]   		= "\$text='Get Next Available System No.';";
$trans["catalogEntry_editNoMaterials"]   		= "\$text='None';";
$trans["catalogEntry_editEditMarcTagHeader"]   		= "\$text='Edit Marc Tag';";
$trans["catalogEntry_editEditMarcDeleteConfirm"]   	= "\$text='Yes I want to remove this field.';";
$trans["catalogEntry_editEditMarcFieldInfo"]   		= "\$text='Field Details';";
$trans["catalogEntry_editEditMarcBlock"]   			= "\$text='Block';";
$trans["catalogEntry_editEditMarcTag"]   			= "\$text='Tag';";
$trans["catalogEntry_editEditMarcInd1"]   			= "\$text = 'Indicator 1';";
$trans["catalogEntry_editEditMarcInd2"]   			= "\$text = 'Indicator 2';";
$trans["catalogEntry_editEditMarcSubfield"]   		= "\$text='Subfield';";
$trans["catalogEntry_editEditMarcFieldData"]  		= "\$text = 'Field Data';";
$trans["catalogEntry_editEditMarcSelectField"] 			= "\$text = 'Choose';";
$trans["catalogEntry_editUpdateSuccess"] 			= "\$text = 'Successfully updated this entry.';";
$trans["catalogEntry_editUpdateError"] 			= "\$text = 'There was an error updating this entry.';";
$trans["catalogEntry_editNewFieldButtonLabel"] 			= "\$text = 'Add New Field';";
$trans["catalogEntry_editValidationError"] 			= "\$text = '1 or more fields have failed validation.';";

$trans["catalogMarcUpload_testUpload"] 			= "\$text = 'Test input data';";
$trans["catalogMarcUpload_defaults"] 			= "\$text = 'Defaults';";
$trans["catalogMarcUpload_uploadFile"] 			= "\$text = 'Upload Filename';";
$trans["catalogMarcUpload_startProcessing"] 			= "\$text = 'Start Processing';";
$trans["catalogMarcUpload_recordsUploaded"] = "\$text = 'Records Uploaded';";
$trans["catalogMarcUpload_marcRecord"]      = "\$text = 'MARC Record';";
$trans["catalogMarcUpload_testNote"]      = "\$text = 'NOTE: Up to 10 randomly selected records will be shown for examination.';";
$trans["catalogMarcUpload_testNote2"]      = "\$text = 'If you are satisfied with the test data please reselect the same file.';";
$trans["catalogMarcUpload_success"]      = "\$text = 'All records successfully imported.';";

$trans["catalogExternalSearch_useThisEntry"]      = "\$text = 'Use this entry';";
$trans["catalogExternalSearch_isbn"]      = "\$text = 'ISBN';";
$trans["catalogExternalSearch_publishedDate"]      = "\$text = 'Publication date';";
$trans["catalogExternalSearch_publisherLocation"]      = "\$text = 'Publishers location';";
$trans["catalogExternalSearch_publisher"]      = "\$text = 'Published by';";
$trans["catalogExternalSearch_results"]      = "\$text = 'Search Results - By Server';";

#****************************************************************************
#*  Translation text for page usmarc_select.php
#****************************************************************************
$trans["usmarc_selectHeader"]          = "\$text = 'MARC Field Selector';";
$trans["usmarc_selectInst"]         = "\$text = 'Select a field type';";
$trans["usmarc_selectNoTags"]       = "\$text = 'No tags found.';";
$trans["usmarc_selectUse"]          = "\$text = 'Use';";
$trans["usmarc_selectCloseWindow"]        = "\$text = 'Close Window';";

#****************************************************************************
#*  Translation text for page biblio_fields.php
#****************************************************************************
$trans["biblioFieldsLabel"]        = "\$text = 'Bibliography';";
$trans["biblioFieldsMaterialTyp"]  = "\$text = 'Type of Material';";
$trans["biblioFieldsCollection"]   = "\$text = 'Collection';";



$trans["biblioFieldsUsmarcFields"] = "\$text = 'USMarc Fields';";


#****************************************************************************
#*  Translation text for page biblio_new.php
#****************************************************************************
$trans["biblioNewFormLabel"]       = "\$text = 'Add New';";
$trans["biblioNewSuccess"]         = "\$text = 'The following new bibliography has been created.  To add a copy, select \"New Copy\" from the left hand navigation or \"Add New Copy\" from the copy information below.';";

#****************************************************************************
#*  Translation text for page biblio_edit.php
#****************************************************************************
$trans["biblioEditSuccess"]        = "\$text = 'Bibliography successfully updated.';";

#****************************************************************************
#*  Translation text for page biblio_copy_new_form.php and biblio_copy_edit_form.php
#****************************************************************************
$trans["biblioCopyNewFormLabel"]   = "\$text = 'Add New Copy';";
$trans["biblioCopyNewBarcode"]     = "\$text = 'Barcode Number';";
$trans["biblioCopyNewDesc"]        = "\$text = 'Description';";
$trans["biblioCopyNewAuto"]        = "\$text = 'Autogenerate';";
$trans["biblioCopyEditFormLabel"]  = "\$text = 'Edit Copy';";
$trans["biblioCopyEditFormStatus"] = "\$text = 'Status';";
$trans["biblioCopyNewContent"]  = "\$text = 'Content Type';";
$trans["biblioCopyNewFormat"] = "\$text = 'Storage Type';";



#****************************************************************************
#*  Translation text for page biblio_marc_list.php
#****************************************************************************
$trans["biblioMarcListMarcSelect"] = "\$text = 'Add New MARC Field';";
$trans["biblioMarcListHdr"]        = "\$text = 'MARC Field Information';";
$trans["biblioMarcListTbleCol1"]   = "\$text = 'Function';";
$trans["biblioMarcListTbleCol2"]   = "\$text = 'Tag';";

$trans["biblioMarcListNoRows"]     = "\$text = 'No MARC fields found.';";
$trans["biblioMarcListEdit"]       = "\$text = 'edit';";
$trans["biblioMarcListDel"]        = "\$text = 'del';";


#****************************************************************************
#*  Translation text for page biblio_marc_new.php
#****************************************************************************
$trans["biblioMarcNewSuccess"]     = "\$text = 'Marc field successfully added.';";

#****************************************************************************
#*  Translation text for page biblio_marc_edit_form.php
#****************************************************************************
$trans["biblioMarcEditFormHdr"]    = "\$text = 'Edit Marc Field';";

#****************************************************************************
#*  Translation text for page biblio_marc_edit.php
#****************************************************************************
$trans["biblioMarcEditSuccess"]    = "\$text = 'Marc field successfully updated.';";

#****************************************************************************
#*  Translation text for page biblio_marc_del_confirm.php
#****************************************************************************
$trans["biblioMarcDelConfirmMsg"]  = "\$text = 'Are you sure you want to delete the field with tag %tag% and subfield %subfieldCd%?';";

#****************************************************************************
#*  Translation text for page biblio_marc_del.php
#****************************************************************************
$trans["biblioMarcDelSuccess"]     = "\$text = 'Marc field successfully deleted.';";

#****************************************************************************
#*  Translation text for page biblio_del_confirm.php
#****************************************************************************
$trans["biblioDelConfirmWarn"]     = "\$text = 'This bibliography has %copyCount% copy(ies) and %holdCount% hold request(s).  Please delete these copies and/or hold requests before deleting this bibliography.';";
$trans["biblioDelConfirmReturn"]   = "\$text = 'return to bibliography information';";
$trans["biblioDelConfirmMsg"]      = "\$text = 'Are you sure you want to delete the bibliography with title %title%?';";

#****************************************************************************
#*  Translation text for page biblio_del_confirm.php
#****************************************************************************
$trans["biblioDelMsg"]             = "\$text = 'Bibliography, %title%, has been deleted.';";
$trans["biblioDelReturn"]          = "\$text = 'return to bibliography search';";

#****************************************************************************
#*  Translation text for page biblio_hold_list.php
#****************************************************************************
$trans["biblioHoldListHead"]       = "\$text = 'Bibliography Hold Requests:';";
$trans["biblioHoldListNoHolds"]    = "\$text = 'No bibliography copies are currently on hold.';";
$trans["biblioHoldListHdr1"]       = "\$text = 'Function';";
$trans["biblioHoldListHdr2"]       = "\$text = 'Copy';";
$trans["biblioHoldListHdr3"]       = "\$text = 'Placed On Hold';";
$trans["biblioHoldListHdr4"]       = "\$text = 'Member';";
$trans["biblioHoldListHdr5"]       = "\$text = 'Status';";
$trans["biblioHoldListHdr6"]       = "\$text = 'Due Back';";
$trans["biblioHoldListdel"]        = "\$text = 'Del';";

#****************************************************************************
#*  Translation text for page upload_usmarc.php and upload_usmarc_form.php
#****************************************************************************
$trans["MarcUploadTest"]            = "\$text = 'Test Load';";
$trans["MarcUploadTestTrue"]        = "\$text = 'True';";
$trans["MarcUploadTestFalse"]       = "\$text = 'False';";
$trans["MarcUploadTestFileUpload"]  = "\$text = 'USMarc Input File';";
$trans["MarcUploadRecordsUploaded"] = "\$text = 'Records Uploaded';";
$trans["MarcUploadMarcRecord"]      = "\$text = 'MARC Record';";
$trans["MarcUploadTag"]             = "\$text = 'Tag';";
$trans["MarcUploadSubfield"]        = "\$text = 'Sub';";
$trans["MarcUploadData"]            = "\$text = 'Data';";
$trans["MarcUploadRawData"]         = "\$text = 'Raw Data:';";
$trans["UploadFile"]                = "\$text = 'Upload File';";

#****************************************************************************
#*  Translation text for page usmarc_select.php
#****************************************************************************
$trans["PoweredByOB"]                 = "\$text = 'Powered by OpenBiblio';";
$trans["Copyright"]                   = "\$text = 'Copyright &copy; 2002-2005';";
$trans["underthe"]                    = "\$text = 'under the';";
$trans["GNU"]                 = "\$text = 'GNU General Public License';";

$trans["catalogResults"]                 = "\$text = 'Search Results';";

#****************************************************************************
#* Translation text for Library of Congress SRU module
#****************************************************************************
$trans['locsru_Instructions']               = "\$text = 'Enter Title, Author, or ISBN';";
$trans['locsru_Search']                     = "\$text = 'Library of Congress Search';";
$trans['locsru_Title']                      = "\$text = 'Title';";
$trans['locsru_Author']                     = "\$text = 'Author';";
$trans['locsru_ISBN']                       = "\$text = 'ISBN';";
$trans['locsru_Publication']                = "\$text = 'Publication';";
$trans['locsru_Publisher']                  = "\$text = 'Publisher';";
$trans['locsru_PublicationDate']            = "\$text = 'Publication Date';";
$trans['locsru_UseThis']                    = "\$text = 'Use This';";

$trans['Search']                            = "\$text = 'Search';";


#****************************************************************************
#*  Translation text for Amazon module
#****************************************************************************
$trans['amazon_Instructions']               = "\$text = 'Enter Title, Author, or ISBN and an Amazon Collection';";
$trans['amazon_Search']                     = "\$text = 'Amazon.com Search';";
$trans['amazon_Title']                      = "\$text = 'Title';";
$trans['amazon_Author']                     = "\$text = 'Author';";
$trans['amazon_ISBN']                       = "\$text = 'ISBN';";
$trans['amazon_Publication']                = "\$text = 'Publication';";
$trans['amazon_Publisher']                  = "\$text = 'Publisher';";
$trans['amazon_PublicationDate']            = "\$text = 'Publication Date';";
$trans['amazon_UseThis']                    = "\$text = 'Use This';";

$trans['Search']                            = "\$text = 'Search';";



?>
