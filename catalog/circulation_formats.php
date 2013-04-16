<?php
  	$tab = "cataloging";
   	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
 	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/header-old.php");
	require_once('../classes/DmQuery.php');
	$nav = "genres";
	$dmQ = new DmQuery();
  	$genresList = $dmQ->getAssoc('genres',NULL,'genreid');


?>

<h3>Bibliography Genres</h3>

<?php

  $value = (isset($_POST['addGenre'])) ? $_POST['addGenre'] : '';
  if($value != '')
  {
    mysql_query("INSERT INTO genres(description) VALUES ('$value')") or die(mysql_error());
  }

  $value = (isset($_POST['deleteGenre'])) ? $_POST['deleteGenre'] : '';
  if($value != '')
  {
    mysql_query("Delete from genres where genreid = $value") or die(mysql_error());
  }
 ?>

<?php



	echo "<div class='shadow'>";
	echo "<h3>List of genres in database</h3>";
	echo "<SELECT NAME=subjectlist SIZE=10 style='width: 330px'>";
	foreach($genresList as $k=>$v)
	{
		echo "<OPTION>".$v."</option>";
	}
	//while($row = mysql_fetch_array( $result )) {
	//	echo "<OPTION>" . ucwords($row['description']) . "</option>";
	//}
	echo "</SELECT>";
	echo "</div>";
?>
<div class="clearboth"></div>
<div class="hseperator"></div>

<div class='shadow'>
	<form name="formAdd" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <fieldset>
    <legend><font class="primary">Add new genre</font></legend>
    <br/>
    &nbsp;<input name="addGenre" type="text" size="30" />
    <input  type="submit" value="Submit" class="button"/>&nbsp;<br/><br/>
  </fieldset>
</form>
</div>

<div class="clearboth"></div>
<div class="hseperator"></div>

<div class='shadow'>
	<form name="formDelete" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <fieldset>
    <legend><font class="primary">Delete genre</font></legend>
    <br/>
    &nbsp;

 <select name="deleteGenre" style="width: 230px">

<?php
    $sql = "Select * from genres order by description";
    $result = mysql_query( $sql ) or die (mysql_error( ));

    while ($result_row = mysql_fetch_array( $result ))
    {
      $genreid = $result_row['genreid'];
      $description  = $result_row['description'];
      echo "<option value='". $genreid ."'>" . ucwords($description) . "</option>";
    }
?>
    </select>

  <input  type="submit" value="Submit" class="button" />&nbsp;<br/><br/>
  </fieldset>
</form>
</div>

<div class="clearboth"></div>
<div class="hseperator"></div>
<?php
 include(str_replace('//','/',dirname(__FILE__).'/')."../admin/footer_admin.php");

?>