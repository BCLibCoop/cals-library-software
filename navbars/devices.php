<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/Localize.php");
  $navloc = new Localize(OBIB_LOCALE,"navbars");
 
?>


<?php if ($nav == "viewConnected") { ?>
 &raquo; <?php echo $navloc->getText("connectedDevices"); ?><br>
 &nbsp;&nbsp;<a href="../devices/devices_view.php" class="alt1"><?php echo $navloc->getText("devicesView"); ?></a><br>


<?php } ?>

<?php if ($nav == "editDevice") { ?>
 <a href="../devices/device_edit_form.php?userid=<?php echo HURL($userid);?>" class="alt1"><?php echo $navloc->getText("connectedDevices"); ?></a><br>
 &nbsp; &raquo; <?php echo $navloc->getText("deviceEdit"); ?><br>

<?php } ?>

<?php if ($nav == "viewDevices") { ?>
  <a href="../devices/index.php" class="alt1"><?php echo $navloc->getText("connectedDevices"); ?></a<br>
  &nbsp; &raquo; <?php echo $navloc->getText("devicesView"); ?><br>

<?php } ?>
<br/>

<input type="button" onClick="self.location='../shared/logout.php'" value="<?php echo $navloc->getText("Logout"); ?>" class="navbutton"><br />
<br />


