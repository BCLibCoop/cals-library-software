<?php
 
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");
  $navLoc = new Localize(OBIB_LOCALE,"navbars");

?>
<ul class="nav_main">


<?php






 	if($nav == "home")
 	 	echo '<li>&raquo;Home</li>';
 	else
		echo '<li> <a href="../recommend/index.php">Home</a></li>';

/*
  if($nav == "member_search_results")
  {
  	echo '<li> <a href="../recommend/mbr_search.php">Member</a></li>';
  	echo '<li>&raquo;Search results</li>';
  }
  elseif ( $nav == "member_view")
  {
  	echo '<li> <a href="../recommend/mbr_search.php">Member</a></li>';
  	echo '<li>&raquo;View</li>';
  	echo '<li>&nbsp;<a href="../recommend/mbr_deleteratings.php?mbrid='. $mbrid . '">Delete Ratings</a></li>';
  }
  elseif ( $nav == "member_deleteratings")
  {
  	echo '<li> <a href="../recommend/mbr_search.php">Member</a></li>';
  	echo '<li> <a href="../recommend/mbr_view.php?mbrid='. $mbrid . '&cf=1">View</a></li>';
  	echo '<li>&raquo;Delete Ratings</li>';
  }
  elseif($nav == "member_search")
 	 	echo '<li>&raquo;Member</li>';
 	else
	  echo '<li> <a href="../recommend/mbr_search.php">Member</a></li>';

 	if($nav == "product_search_results")
 	{
 		echo '<li> <a href="../recommend/biblio_search.php">Bibliography</a></li>';
 	 	echo '<li>&raquo;Search results</li>';
 	}
  elseif ($nav == "product_search")
    echo '<li>&raquo;Bibliography</li>';
 	elseif ($nav =="product_view")
 	{
 		echo '<li> <a href="../recommend/biblio_search.php">Bibliography</a></li>';
 	 	echo '<li>&raquo;View</li>'; 		
 	}
 	else 	
		echo '<li> <a href="../recommend/biblio_search.php">Bibliography</a></li>';
*/

 /*
	if($nav == "genres")
 	 	echo '<li>&raquo;Genres</li>';
 	else
		echo '<li> <a href="../recommend/genres.php">Genres</a></li>';
*/

/*
  if($nav == "userprefs_search_results")	 
	{
		echo '<li> <a href="../recommend/mbr_search.php?cat=1">User Preferences</a></li>';
		echo '<li>&raquo;Search results</li>';
	}
	elseif($nav == "userprefs_view")	 
	{
		echo '<li> <a href="../recommend/mbr_search.php?cat=1">User Preferences</a></li>';
		echo '<li>&raquo;View</li>';
	}
	elseif($nav == "userprefs")
 	  echo '<li>&raquo;User Preferences</li>';
 	else
	 	echo '<li> <a href="../recommend/mbr_search.php?cat=1">User Preferences</a></li>'; 	
*/
/*





*/

?>
</ul>
<input type="button" onClick="self.location='../shared/logout.php'" value="<?php echo $navLoc->getText("logout"); ?>" class="navbutton">
<br />
<br />

