<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

	if((empty($_GET)) && (empty($_POST)))
		header("Location: user_search.php");

	if((empty($_POST)) && (!isset($_GET['uid'])))
		header("Location: user_search.php");

	$tab = "users";
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

  	$nav = "del";
  	$helpPage = "users";

  	require_once(__ROOT__."admin/header_admin.php");
	require_once(__ROOT__."classes/UserQuery.php");
	$msg = null;

	if(empty($_POST))
	{
		$userid = $_GET['uid'];
		$addrid = (isset($_GET['aid']))?$_GET['aid']:null;
		$profid = (isset($_GET['pid']))?$_GET['pid']:null;
		$reqid = (isset($_GET['rid']))?$_GET['rid']:null;
		$smarty->assign('uid',$userid);

		// check for subsection delete first
		if(isset($addrid))
		{
			$addrQ = new UserAddressQuery();
			// sanity check to make sure the address is actually for this user
			$thisAddress = $addrQ->getAddress($addrid);
			if ($thisAddress->getUserId() == $userid)
			{
				$submitButton = array('label'=>$loc->getText('userDelete'),
										'onclick'=>"this.form.action='user_del.php';this.form.method='POST';this.form.submit();");
				$cancelButton = array('label'=>$loc->getText('userCancel'));
				$passedVals = array('name'=>'aid','value'=>$addrid);
				$msg = $loc->getText('userAddr_deleteConfirm',array('address'=>$thisAddress->getAddress().', '.$thisAddress->getCity()));

				goto DISPLAY_CONFIRM;
			}
			$msg = "incorrect Address id for this user";
			goto CONT;
		}

		if(isset($profid))
		{
			require_once(__ROOT__."classes/UserProfile.php");
			$profQ = new UserProfileQuery();

			$someProfs = $profQ->getProfiles($userid);

			while (list(,$aProf) = each($someProfs))
			{	// sanity check to make sure the profile is actually for this user
				if (($aProf->getProfileId() == $profid))
				{
					$submitButton = array('label'=>$loc->getText('userDelete'),
										'onclick'=>"this.form.action='user_del.php';this.form.method='POST';this.form.submit();");
					$cancelButton = array('label'=>$loc->getText('userCancel'));
					$passedVals = array('name'=>'pid','value'=>$profid);
					$msg = $loc->getText('userProfile_deleteConfirm',array('profile'=>$aProf->getContent()));

					goto DISPLAY_CONFIRM;

				}

			}
			$msg = "incorrect Profile id for this user";
			goto CONT;
		}

		if(isset($reqid))
		{
			$reqQ = new UserRequestsQuery();

			$someReqs = $reqQ->getRequests($userid);
			while (list(,$aReq) = each($someReqs))
			{	// sanity check to make sure the profile is actually for this user
				if (($aReq->reqid == $reqid) )
				{
					$submitButton = array('label'=>$loc->getText('userDelete'),
										'onclick'=>"this.form.action='user_del.php';this.form.method='POST';this.form.submit();");
					$cancelButton = array('label'=>$loc->getText('userCancel'));
					$passedVals = array('name'=>'rid','value'=>$reqid);
					$msg = $loc->getText('userRequest_deleteConfirm',array('title'=>$aReq->title));

					goto DISPLAY_CONFIRM;

				}

			}
			$msg = "incorrect Request id for this user";
			goto CONT;
		}

		DISPLAY_CONFIRM:

		$smarty->assign('postedVal',$passedVals);
		$smarty->assign('submitButton',$submitButton);
		$smarty->assign('cancelButton',$cancelButton);
		$smarty->assign('deleteConfirmMsg',$msg);
		$smarty->display('users/user_del.tpl','users');
		exit;

 	}
	else
	{	// confirmed delete of some sort
		require_once(__ROOT__."classes/UserQuery.php");

		$userid = $_POST['uid'];
		$addrid = (isset($_POST['aid']))?$_POST['aid']:null;
		$profid = (isset($_POST['pid']))?$_POST['pid']:null;
		$reqid = (isset($_POST['rid']))?$_POST['rid']:null;

		// check for subsection delete first
		if(isset($addrid))
		{

			$addrQ = new UserAddressQuery();
			$thisAddress = $addrQ->getAddress($addrid);
			$res = $addrQ->deleteAddress($addrid);
			if ($res)
				$msg = $loc->getText('userAddr_deleteSuccess',array('address'=>$thisAddress->getAddress().', '.$thisAddress->getCity()));
		}

		if(isset($profid))
		{
			$profQ = new UserProfileQuery();
			$res = $profQ->deleteProfile($profid);
			if ($res)
				$msg = $loc->getText('userProfile_deleteSuccess');
			goto CONT;
		}

		if(isset($reqid))
		{
			$reqQ = new UserRequestsQuery();
			$res = $reqQ->deleteRequest($reqid);
			if ($res)
				$msg = $loc->getText('userRequest_deleteSuccess');
			goto CONT;
		}

		// no subsections found so assume full user delete
	}

CONT:
// check if we have an error to display
if ((isset($msg)) && ($userid!=0))
{
	header("Location: user_view.php?uid=".HURL($userid)."&msg=".H($msg));
	exit;
}

// silently fail and return to the user search page because there was something
// really wrong
header("Location: user_search.php");
exit;
