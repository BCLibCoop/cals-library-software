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
$trans["userCancel"]              = "\$text = 'Cancel';";
$trans["userBack"]              = "\$text = 'Back';";
$trans["userDelete"]              = "\$text = 'Delete';";
$trans["userLogout"]              = "\$text = 'Logout';";
$trans["userUpdate"]              = "\$text = 'Update';";
$trans["userAdd"]                 = "\$text = 'Add';";
$trans["userYes"]              = "\$text = 'Yes';";
$trans["userNo"]                 = "\$text = 'No';";
$trans["userDupUsername"]           = "\$text = 'Username \'%username%\' is not available.';";
$trans["userError_NotFound"]           = "\$text = 'Invalid User Id.';";
$trans["userSearch"]                 = "\$text = 'Search';";
$trans["userDate"]                 = "\$text = 'Date';";
#****************************************************************************
#*  Translation text for page noauth.tpl
#****************************************************************************
$trans["notAuthMsg"]                = "\$text = 'You are not authorized to use the Users tab.';";


#****************************************************************************
#*  Translation text for page user_request_search.php
#****************************************************************************
$trans["userRequest_searchContentHeader"]            = "\$text='Add a Request';";
$trans["userRequest_searchBarHeaderTitle"]            = "\$text='Title';";
$trans["userRequest_searchBarHeaderAuthor"]               = "\$text='Author';";
$trans["userRequest_searchBarHeaderSubject"]               = "\$text='Subject';";   
$trans["userRequest_searchBarHeaderSysNumber"]               = "\$text='System No.';";
$trans["userRequest_searchShowAllLabel"]               = "\$text='Include Previously Read Titles?';";
$trans["AddRequestButtonLabel"]             = "\$text='Add this title';";

#****************************************************************************
#*  Translation text for page index.php
#****************************************************************************
$trans["indexHeading"]            = "\$text='Users';";
$trans["indexNameHdr"]            = "\$text='Search for a user by';";
$trans["indexSearchName"]               = "\$text='Last name : ';";
$trans["indexSearchUserId"]               = "\$text='User Id : ';";   
$trans["indexSearchJadeId"]               = "\$text='JADE Id : ';";
$trans["indexSearchButton"]             = "\$text='Search';";

#****************************************************************************
#*  Translation text for page user_new_form.php, user_edit_form.php and user_fields.php
#****************************************************************************
$trans["userMailAddress"] = "\$text='Mailing Address :&nbsp';";
$trans["userNewForm"]              = "\$text='Add New';";
$trans["userEdit_contentHeader"]             = "\$text='Edit details for %name%';"; 
$trans["userRequestForm"]          = "\$text='Request Books';";
$trans["userEdit_title"]         = "\$text='Title :&nbsp;';";
$trans["userEdit_surname"]         = "\$text='Surame :&nbsp;';";
$trans["userEdit_firstname"]        = "\$text='First Name :&nbsp;';";
$trans["userEdit_birthDate"] 	= "\$text='Date of Birth (dd/mm/yyyy) :&nbsp;';";
$trans["userEdit_UpdateSuccess"] 	= "\$text='Successfully Updated User Details.';";

$trans["userNew_password"]         = "\$text='Password :&nbsp;';";
$trans["userNew_passwordValidate"] 	= "\$text='Re-enter Password :&nbsp;';";

$trans["userPassword_changeContentHeader"]         = "\$text='Change the Password for :&nbsp;%name%';";
$trans["userPassword_pwdResetSuccess"]         = "\$text='Successfully Updated the password for ';";

$trans["userValidate_passwordNotEmpty"]         = "\$text='The Password cannot be blank.';";
$trans["userValidate_passwordNotEqual"]         = "\$text='The Passwords do not match.';";
$trans["userValidate_dateInvalid"]         = "\$text='The Date is not valid. (DD/MM/YYYY)';";


$trans["userNew_noProfilesMsg"]         = "\$text='Profiles cannot be added until after the user is created.';";
$trans["userNew_noHistoryMsg"]         = "\$text='Reading history will not be aavailable until after the user has read a book.';";
$trans["userNew_noRequestsMsg"]         = "\$text='Requests cannot be added until after the user is created.';";
$trans["userNew_addUserContentMsg"]         = "\$text='Create a new user.';";
$trans["userNew_addUserButtonLabel"]         = "\$text='Add this user';";


$trans["userView_contentHeader"]   = "\$text='View details for %name%';"; 
$trans["userView_HeaderPrefix"]           = "\$text='User';";
$trans["userView_HeaderSuffixDetails"] = "\$text='&nbsp;Details';";
$trans["userView_HeaderSuffixPrefs"] = "\$text='&nbsp;Preferences';";
$trans["userView_username"]			= "\$text='Username :&nbsp;';";
$trans["userView_jadeId"]			= "\$text='JADE Id :&nbsp;';";
$trans["userView_mobilePhone"] = "\$text='Mobile Phone :&nbsp;';";
$trans["userView_email"]            = "\$text='Email Address :&nbsp;';";
$trans["userView_class"]         = "\$text='Classification :&nbsp;';";
$trans["userView_fullname"]         = "\$text='Name :&nbsp;';";
$trans["userView_comments"]         = "\$text='Comments :&nbsp;';";
$trans["userView_status"]         = "\$text='Status :&nbsp;';";
$trans["userView_birthDate"] 	= "\$text='Date of Birth :&nbsp;';";
$trans["userView_wantsRecommend"] 	= "\$text='Wants Recommendations :&nbsp;';";
$trans["userView_readingLevel"] 	= "\$text='Reading Level :&nbsp;';";
$trans["userView_backToSearchLabel"] 	= "\$text='Back to Search';";
$trans["userView_editUserLabel"] 	= "\$text='Edit Details';";
$trans["userView_changePasswordButtonLabel"] 	= "\$text='Change Password';";
$trans["userView_addRequestButtonLabel"] 	= "\$text='Add a Request';";
$trans["userView_requestDeleteButtonLabel"] 	= "\$text='Delete this Request';";

$trans["userProfile_deleteConfirm"] 	= "\$text='Are you sure you want to delete the profile containing %profile%?';";
$trans["userProfile_deleteSuccess"] 	= "\$text='Successfully removed the Profile';";

$trans["userRequest_deleteConfirm"] 	= "\$text='Are you sure you want to delete the request, %title%?';";
$trans["userRequest_deleteSuccess"] 	= "\$text='Successfully removed the Request';";



$trans["userView_profile"]          = "\$text='Profile :&nbsp;';";

$trans["userAddrAddress"]            = "\$text='Address :&nbsp;';";
$trans["userAddrCity"]             = "\$text='City :&nbsp;';";
$trans["userAddrPostCode"]         = "\$text='Zip/Postcode :&nbsp;';";
$trans["userAddrState"]				= "\$text='State :&nbsp;';";
$trans["userAddrCountry"]             = "\$text='Country :&nbsp;';";
$trans["userAddrPhone"]        = "\$text='Phone :&nbsp;';";
$trans["userAddrContactName"]      = "\$text='Contact Name :&nbsp;';";
$trans["userAddrContactPhone"]      = "\$text='Contact Alt Phone :&nbsp;';";
$trans["userAddrComments"]      = "\$text='Comments :&nbsp;';";
$trans["userChangePasswordForm"] 	= "\$text='Change Password';";
$trans["userUpdatePassword"] 	= "\$text='Update Password';";
$trans["userChangePwdSuccess"] 	= "\$text='Successfully Changed Password';";
$trans["userAddr_addAddress"] 	= "\$text='Add This Address';";
$trans["userAddr_newAddressSuccess"] 	= "\$text='Successfully Added New Address';";
$trans["userAddr_deleteSuccess"] 	= "\$text='Successfully removed address, %address%.';";
$trans["userAddr_deleteConfirm"] 	= "\$text='Are you sure you want to delete the address, %address%?';";

$trans["userView_Submit"]           = "\$text=' Submit ';";
$trans["userView_SubmitAddUser"]   	= "\$text=' Add this User ';";
$trans["userView_SubmitUpdateUser"]   	= "\$text=' Update User ';";
$trans["userView_Cancel"]           = "\$text=' Cancel ';";


$trans["usersearchResult"]         = "\$text='Result Pages: ';";
$trans["usersearchUserId"]         = "\$text='User Id: ';";
$trans["usersearchprev"]           = "\$text='prev page';";
$trans["usersearchnext"]           = "\$text='next page';";
$trans["usersearchNoResults"]      = "\$text='No results found.';";
$trans["usersearchFoundResults"]   = "\$text=' results found.';";
$trans["usersearchSearchResults"]  = "\$text='Search Results:';";

$trans["userPrefContentSex"]  = "\$text='&nbsp;Sexual content&nbsp';";
$trans["userPrefContentViolence"]  = "\$text='&nbsp;Violent content&nbsp';";
$trans["userPrefContentLanguage"]  = "\$text='&nbsp;Strong language&nbsp';";
$trans["userPrefNarratorMale"]  = "\$text='&nbsp;Male narrator&nbsp';";
$trans["userPrefNarratorFemale"]  = "\$text='&nbsp;Female narrator&nbsp';";
$trans["userPrefNarratorSynth"]  = "\$text='&nbsp;Synthesized narrator&nbsp';";
$trans["userPrefBooksLong"]  = "\$text='&nbsp;Long books&nbsp';";
$trans["userPrefBooksShort"]  = "\$text='&nbsp;Short books&nbsp';";
$trans["userPrefAuthorMale"]  = "\$text='&nbsp;Male Authors&nbsp';";
$trans["userPrefAuthorFemale"]  = "\$text='&nbsp;Female Authors&nbsp';";
$trans["userPrefBraille"]  = "\$text='&nbsp;Braille&nbsp';";
$trans["userPrefBooksPerDevice"]  = "\$text='&nbsp;Max books per cart&nbsp';";
$trans["userPrefMaxQueuedRequests"]  = "\$text='&nbsp;Max Queued Requests&nbsp';";

$trans["usersearchClassification"] = "\$text='Classification:';";

#****************************************************************************
#*  Translation text for page user_new.php
#****************************************************************************
$trans["userNewSuccess"]           = "\$text='User has been successfully added.';";

#****************************************************************************
#*  Translation text for page user_edit.php
#****************************************************************************
$trans["userEditSuccess"]          = "\$text='User has been successfully updated.';";

#****************************************************************************
#*  Translation text for page user_view.php
#****************************************************************************
$trans["userViewHead1"]            = "\$text='User Information:';";
$trans["userViewName"]             = "\$text='Name:';";
$trans["userViewAddr"]             = "\$text='Address:';";
$trans["userViewCardNmbr"]         = "\$text='Card Number:';";
$trans["userViewClassify"]         = "\$text='Classification:';";
$trans["userViewPhone"]            = "\$text='Phone:';";
$trans["userViewPhoneHome"]        = "\$text='H:';";
$trans["userViewPhoneWork"]        = "\$text='W:';";
$trans["userViewPhoneMobile"]      = "\$text='M:';";
$trans["userViewEmail"]            = "\$text='Email Address:';";
$trans["viewRequestsHeader"]          = "\$text='View requests';";
$trans["remRequestButton"]            = "\$text='Remove Request';";

// #****************************************************************************
// #*  Translation text for page user_request.php
// #****************************************************************************
$trans["addRequestHeader"]          = "\$text='Add a request';";
$trans["userDetailHeader"]            = "\$text='User Details';";
$trans["userDetailName"]            = "\$text='Name';";
$trans["userDetailUsername"]            = "\$text='Username';";
$trans["addRequestButton"]            = "\$text='Add to requests list';";
$trans["userRequestedBookMsg"]            = "\$text='Req Status';";

#****************************************************************************
#*  Translation text for page user_del_confirm.php
#****************************************************************************
// $trans["userDelConfirmWarn"]       = "\$text = 'Member, %name%, has %checkoutCount% checkout(s) and %holdCount% hold request(s).';";
$trans["userDelConfirmReturn"]     = "\$text = 'return to user information';";
$trans["userDelConfirmMsg"]        = "\$text = 'Are you sure you want to delete the user, %name%?  This will also delete all content history for this user.';";
$trans["userDelAddressConfirmMsg"]        = "\$text = 'Are you sure you want to delete this %type% address for %name%?';";

#****************************************************************************
#*  Translation text for page user_del.php
#****************************************************************************
$trans["userDelSuccess"]           = "\$text='User, %name%, has been deleted.';";
$trans["userDelAddressSuccess"]           = "\$text='The %type% address for %name%, has been deleted.';";
$trans["userDelReturn"]            = "\$text='return to user Search';";
$trans["userDelAddressReturn"]            = "\$text='return to user details';";

#****************************************************************************
#*  Translation text for page user_history.php
#****************************************************************************
$trans["userHistoryHead1"]         = "\$text='User Book usage History:';";
$trans["userHistoryNoHist"]        = "\$text='No history was found.';";
$trans["userHistoryHdr2"]          = "\$text='Title';";
$trans["userHistoryHdr3"]          = "\$text='Author';";

#****************************************************************************
#*  Translation text for page user_search.php
#****************************************************************************
$trans["usersSearch_contentHeader"]          = "\$text='User Search';";
$trans["usersSearch_barHeaderClientName"]         = "\$text='Client Name';";
$trans["usersSearch_barHeaderPhone"]        = "\$text='Phone No.';";
$trans["usersSearch_barHeaderJade"]          = "\$text='Jade No.';";
$trans["usersSearch_barHeaderUsername"]          = "\$text='Username';";
$trans["usersSearch_barHeaderAddress"]          = "\$text='Address';";


