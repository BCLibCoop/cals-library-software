<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 	$tab = "catalog";
 	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");

 	$nav = "uploadMarc";
  	require_once(__ROOT__."admin/header_admin.php");
  	require_once(__ROOT__."classes/Biblio.php");
  	require_once(__ROOT__."classes/BiblioField.php");
  	require_once(__ROOT__."classes/BiblioQuery.php");
  	require_once(__ROOT__."classes/SearchIndex.php");
  	require_once(__ROOT__."classes/Dm.php");
  	require_once(__ROOT__."classes/DmQuery.php");
  	require_once(__ROOT__."functions/fileIOFuncs.php");


 	#****************************************************************************
  	#*  Loading a few domain tables into associative arrays
  	#****************************************************************************
  	$dmQ = new DmQuery();
	$cols = $dmQ->getAssoc("collection_dm");
	$mats = $dmQ->getAssoc("material_type_dm");

if (empty($_POST))
{
	$smarty->assign("opacChecked",false);
	$smarty->assign("testChecked",true);
	$row = $dmQ->getDefault("material_type_dm");
	$smarty->assign("selMatId",$row->getCode());
	$row = $dmQ->getDefault("collection_dm");
	$smarty->assign("selColId",$row->getCode());
}
else // submitted something
{

	$smarty->assign("opacChecked",isset($_POST["opac"]));
	$smarty->assign("testChecked",isset($_POST["test"]));
	$smarty->assign("selMatId",$_POST["matid"]);
	$smarty->assign("selColId",$_POST["colid"]);

	if(empty($_FILES)) goto DISPLAY;



	$excludes = array(); // tags not to import other than 9xx tags
	$excludes = array_flip($excludes); // flip the array so we can use isset for checking keys

	$fileContent = fileGetContents($_FILES["datafiles"]["tmp_name"]);

	require_once(__ROOT__."classes/MARC.php");
	$records = MARC::recordsFromRawData($fileContent);
	$entries = MARC::entriesFromMarcRecords($records,$excludes);

	$smarty->assign("testRecords",null);

	if(empty($entries)) goto DISPLAY;

	if (isset($_POST["test"])  )
	{

		if (count($entries) <11)
		{
			$smarty->assign("testRecords",$entries);
		}
		else
		{
			// select 10 random records from the entries
			$cnt = 1;
			$recs = array();
			//seed(time());
			$totalEnts = count($entries)-1;
			while ($cnt != 10)
			{
				$idx = rand(0,$totalEnts);
				if (!isset($recs[$idx]))
				{
					$recs[$idx] = $entries[$idx];
					$cnt += 1;
				}
			}
			$smarty->assign("testRecords",$recs);
		}
	}
	else
	{
		$bq = new BiblioQuery();
		$si = new SearchIndex();
		$failed = 0;
		// not testing so add entries to the catalog
		while (list(,$biblio) = each($entries))
		{
			$bid = $bq->insert($biblio);
    		if ($bid !== false)
    			$si->regenerateAllIndexes($bid);
    		else
    			$failed +=1;

  		}

  		if($failed == 0)
  		{

  			$smarty->assign("contentStatusMsg",$loc->getText("catalogMarcUpload_success"));
  		}
  		else
		{

			$smarty->assign("contentStatusMsg",$loc->getText("catalogMarcUpload_success"));
		}
	}

}

DISPLAY:

$labels = array("collection"=>$loc->getText("catalogEntry_viewCollectionType") ,
				"material"=>$loc->getText("catalogEntry_viewMaterialType") ,
				"showOpac"=>$loc->getText("catalogEntry_viewShowInOpac") ,
				"uploadFile"=>$loc->getText("catalogMarcUpload_uploadFile") ,
				"testUpload"=>$loc->getText("catalogMarcUpload_testUpload") ,
				"testNote"=>$loc->getText("catalogMarcUpload_testNote") ,
				"defaults"=>$loc->getText("catalogMarcUpload_defaults"),
				"submit"=>$loc->getText("catalogMarcUpload_startProcessing"),
				"marcRecord"=>$loc->getText("catalogMarcUpload_marcRecord") ,
				"tag"=>$loc->getText("catalogEntry_editEditMarcTag"),
				"subfld"=>$loc->getText("catalogEntry_editEditMarcSubfield"),
				"data"=>$loc->getText("catalogEntry_editEditMarcFieldData"),
				);
$smarty->assign("labels",$labels);
$smarty->assign("materials",$mats);
$smarty->assign("collections",$cols);

$smarty->display("catalog/upload_marc.tpl","catalog");
exit;



