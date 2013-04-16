<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../shared/common.php");
	require_once(str_replace('//','/',dirname(__FILE__).'/')."../classes/BiblioQuery.php");

	$bq = new BiblioQuery();
	$next = $bq->getNextSysNumber();
	echo ($next != '')?$next:'';
	exit;

