<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");
  $navloc = new Localize(OBIB_LOCALE,"navbars");
 
?>
<input type="button" onClick="self.location='../shared/logout.php'" value="<?php echo $navloc->getText("Logout"); ?>" class="navbutton"><br />
<br />

<?php if ($nav == "searchform") { ?>
 &raquo; <?php echo $navloc->getText("userSearch"); ?><br>
<?php } else { ?>
 &nbsp;<a href="../circ/index.php" class="alt1"><?php echo $navloc->getText("userSearch"); ?></a><br>
<?php } ?>

<?php if ($nav == "search") { ?>
 &nbsp; &raquo; <?php echo $navloc->getText("catalogResults"); ?><br>
<?php } ?>

<?php if ($nav == "view") { ?>
 &nbsp;&nbsp; &raquo; <?php echo $navloc->getText("userInfo"); ?><br>
 &nbsp; &nbsp;&nbsp;&nbsp;<a href="../circ/user_history.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("userHistory"); ?></a><br>
 &nbsp; &nbsp;&nbsp;&nbsp;<a href="../circ/user_edit_form.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("userEditInfo"); ?></a><br>
 &nbsp; &nbsp;&nbsp;&nbsp;<a href="../circ/user_del_confirm.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("userDelete"); ?></a><br>

<?php } ?>

<?php if ($nav == "editUser") { ?>
 &nbsp; &nbsp;<a href="../circ/user_view.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("userInfo"); ?></a><br>
 &nbsp; &nbsp; &nbsp;<a href="../circ/user_history.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("userHistory"); ?></a><br>
 &nbsp; &nbsp; &raquo; <?php echo $navloc->getText("userEditInfo"); ?><br>
 &nbsp; &nbsp; &nbsp;<a href="../circ/user_del_confirm.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("userDelete"); ?></a><br>

<?php } ?>

<?php if ($nav == "deleteUser") { ?>
 &nbsp; &nbsp;<a href="../circ/user_view.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("userInfo"); ?></a><br>
 &nbsp; &nbsp; &nbsp;<a href="../circ/user_edit_form.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("userEditInfo"); ?></a><br>
 &nbsp; &nbsp; &nbsp;<a href="../circ/user_history.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("userHistory"); ?></a><br>
 &nbsp; &nbsp; &raquo; <?php echo $navloc->getText("userDelete"); ?><br>
<?php } ?>

<?php if ($nav == "hist") { ?>
 &nbsp; &nbsp;<a href="../circ/user_view.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("userInfo"); ?></a><br>
 &nbsp; &nbsp; &raquo; <?php echo $navloc->getText("userHistory"); ?><br>
 &nbsp; &nbsp; &nbsp;<a href="../circ/user_edit_form.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("userEditInfo"); ?></a><br>
 &nbsp; &nbsp; &nbsp;<a href="../circ/user_del_confirm.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("userDelete"); ?></a><br>

<?php } ?>

<?php if ($nav == "newUser") { ?>
 <br/>&raquo; <?php echo $navloc->getText("userNew"); ?><br>
<?php } else { ?>
 <br/>&nbsp;<a href="../circ/user_new_form.php?reset=Y" class="alt1"><?php echo $navloc->getText("userNew"); ?></a><br>
<?php } ?>


<br />
<a href="javascript:popSecondary('../shared/help.php<?php if (isset($helpPage)) echo "?page=".H(addslashes(U($helpPage))); ?>')"><?php echo $navloc->getText("help"); ?></a>
