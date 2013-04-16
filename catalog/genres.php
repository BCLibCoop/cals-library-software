<?php
  $tab = "cataloging";
  $nav = "genres";
  
 	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
 	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/header-old.php");
	require_once('../classes/DmQuery.php');
	
	$dmQ = new DmQuery();
  	
  	unset($genresList);

?>

<script type="text/javascript">
<!--
	function setPostVars(el){
	  	document.getElementById("delGenre").value = el.value;
	}
-->
</script>


<?php
  	
  	if((isset($_POST['addGenre'])))
  	{
  		require_once('../classes/Dm.php');
  		$dm = new Dm();
  		$dm->setDescription($_POST['addGenre']);
      	
      	$dmQ->insert('genres',$dm);
  	}
  	else if ((isset($_POST['delGenre'])))
  	{
  	
  		$value = $_POST['delGenre'];
  		
  		$dmQ->delete('genres',$value,'genreid');
  	}
  
  	
  	$genresList = $dmQ->getAssoc('genres',NULL,'genreid'); 
  	
  	
 ?>
 
<div class='shadow'>
 <h3>Catalog Genres</h3>



<div class='shadowStats'>
	<form name="formAdd" method="POST"  action="<?php echo $_SERVER['PHP_SELF']; ?>">
  		<fieldset >
    		<legend><font class="primary">Add new genre</font></legend>
    		
    		&nbsp;<input name="addGenre" type="text" size="50" />
    		
    		<input  type="submit" value="Add" class="button"/>&nbsp;<br/>  
  		</fieldset>
	</form>
</div>

<div class="clearboth"></div>


<div class='shadowStats'>
	<form name="formDelete" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  		<fieldset>
    	<legend><font class="primary">Delete genre</font></legend>
 		<select style="width:100%" size="15">

<?php 
    foreach($genresList as $k=>$v)
	{
		echo "<OPTION onClick='setPostVars(this);' value='".$k."'>".$v."</option>";
	}
   
?>
    	</select>
 		<input type="hidden" name="delGenre" id="delGenre" value="">
  		<br/><br/>
  		<input  type="submit" value="Delete" class="button" />
  		<br/><br/>
  		</fieldset>
	</form>
</div>

</div>
<div class="clearboth"></div>


<?php
 require_once(str_replace('//','/',dirname(__FILE__).'/')."../admin/footer_admin.php");
 
?>