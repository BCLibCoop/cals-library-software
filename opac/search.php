<?php
	/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
	 * See the file COPYRIGHT.html for more details.
	 */
	$tab='opac';
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(__ROOT__."functions/stringFuncs.php");
	require_once('loginCheck.php');

	session_cache_limiter(null);
	session_cache_limiter('private');

	#****************************************************************************
	#*  Checking for post vars.  Go back to form if none found.
	#****************************************************************************

	if ((count($_GET) == 0) || ($_GET["c"]==""))
	{
		header("Location: index.php");
		exit();
	}

	require_once(__ROOT__."classes/OpacSearchQuery.php");
    $helpPage = "biblioSearch";

    #****************************************************************************
    #*  Function declaration only used on this page.
    #****************************************************************************
/*
    function printResultPages(&$loc, $currPage, $pageCount, $sort) {
      if ($pageCount <= 1) {
        return false;
      }
      echo $loc->getText("biblioSearchResultPages").": ";
      $maxPg = OBIB_SEARCH_MAXPAGES + 1;
      if ($currPage > 1) {
        echo "<a href=\"javascript:changePage(".H(addslashes($currPage-1)).",'".H(addslashes($sort))."')\">&laquo;".$loc->getText("biblioSearchPrev")."</a> ";
      }
      for ($i = 1; $i <= $pageCount; $i++) {
        if ($i < $maxPg) {
          if ($i == $currPage) {
            echo "<b>".H($i)."</b> ";
          } else {
            echo "<a href=\"javascript:changePage(".H(addslashes($i)).",'".H(addslashes($sort))."')\">".H($i)."</a> ";
          }
        } elseif ($i == $maxPg) {
          echo "... ";
        }
      }
      if ($currPage < $pageCount) {
        echo "<a href=\"javascript:changePage(".($currPage+1).",'".$sort."')\">".$loc->getText("biblioSearchNext")."&raquo;</a> ";
      }
    }
*/

    $currentPageNmbr = (isset($_GET["page"]))?(int)$_GET["page"]:1;

    $searchType = $_GET["t"];
    $sortBy = $_GET["b"];
    $searchText = trim($_GET["c"]);
    $searchProd = (isset($_GET['p']));

    $words=array();
    if(in_array($searchType, array(3)))
        $words = explodeStr($searchText);
    else
        $words = explode(' ',$searchText);

    #****************************************************************************
    #*  Search database
    #****************************************************************************
    $searchQ = new OpacSearchQuery();

    $results = $searchQ->search($searchType,$words,$currentPageNmbr,$sortBy,true,$searchProd);

    $labels=array();
    $labels['searchCrit']=$loc->getText("opac_criteria",array("crit"=>$searchText));
    $labels['title']=$loc->getText("opac_title");
    $labels['author']=$loc->getText("opac_author");
    $labels['collection']=$loc->getText("opac_collection");
    $labels['restrictedMsg']=$loc->getText("opac_restrictedMsg");
    $labels['copyTypes']=$loc->getText("opac_copyTypes");
    $labels['systemNum']=$loc->getText("opac_systemNumber");
    $labels['requestProd']=$loc->getText("opac_requestProduction");
    $labels['back']=$loc->getText("opac_backToSearch");

    $smarty->assign('entries',$results);
    $smarty->assign('labels',$labels);
    $smarty->display('opac/search.tpl');

    exit;
