<?php

/*
 * Bluethrust Clan Scripts v4
 * Copyright 2014
 *
 * Author: Bluethrust Web Development
 * E-mail: support@bluethrust.com
 * Website: http://www.bluethrust.com
 *
 * License: http://www.bluethrust.com/license.php
 *
 */

if(!isset($member) || substr($_SERVER['PHP_SELF'], -11) != "console.php") {
	exit();
}
else {
	$memberInfo = $member->get_info_filtered();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}
include_once($prevFolder."classes/medal.php");
$cID = $_GET['cID'];

$medalObj = new Medal($mysqli);


if($_GET['mID'] != "" && $medalObj->select($_GET['mID']) && $_GET['action'] == "edit") {
	include("medals/edit.php");
}
else {
	include("medals/main.php");
}

?>