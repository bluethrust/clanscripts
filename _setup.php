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


// This setup page should not be changed.  Edit _config.php to configure your website.

ini_set('display_errors', 0);

if(get_magic_quotes_gpc() == 1) {
	foreach($_GET as $key=>$value) { $_GET[$key] = stripslashes($value); }
	foreach($_POST as $key=>$value) { $_POST[$key] = stripslashes($value); }
}


if(isset($_COOKIE['btSessionID']) && $_COOKIE['btSessionID'] != "") {
	session_id($_COOKIE['btSessionID']);
	session_start();
	ini_set('session.use_only_cookies', 1);
}
else {
	session_start();
	ini_set('session.use_only_cookies', 1);
	if(isset($_SESSION['btRememberMe']) && $_SESSION['btRememberMe'] == 1 && (!isset($_COOKIE['btSessionID']) || $_COOKIE['btSessionID'] == "")) {
		$cookieExpTime = time()+((60*60*24)*3);
		setcookie("btSessionID", session_id(), $cookieExpTime);
	}
}

include($prevFolder."_config.php");
$PAGE_NAME = "";

include_once($prevFolder."classes/btmysql.php");
include_once($prevFolder."classes/basic.php");
include_once($prevFolder."_functions.php");

$mysqli = new btmysql($dbhost, $dbuser, $dbpass, $dbname);

$mysqli->set_tablePrefix($dbprefix);
$mysqli->set_testingMode(true);

$logObj = new Basic($mysqli, "logs", "log_id");

// Get Clan Info
$webInfoObj = new Basic($mysqli, "websiteinfo", "websiteinfo_id");

$webInfoObj->select(1);

$websiteInfo = $webInfoObj->get_info_filtered();
$CLAN_NAME = $websiteInfo['clanname'];
$THEME = $websiteInfo['theme'];


$arrWebsiteLogoURL = parse_url($websiteInfo['logourl']);


if(!isset($arrWebsiteLogoURL['scheme']) || $arrWebsiteLogoURL['scheme'] == "") {
	$websiteInfo['logourl'] = $MAIN_ROOT."themes/".$THEME."/".$websiteInfo['logourl'];
}


$IP_ADDRESS = $_SERVER['REMOTE_ADDR'];

// Check Debug Mode

if($websiteInfo['debugmode'] == 1) {
	ini_set('display_errors', 1);
	ini_set('error_reporting', E_ALL);
}
else {
	ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING);
	ini_set('display_errors', 1);
}


// Check for Ban

$ipbanObj = new Basic($mysqli, "ipban", "ipaddress");

if($ipbanObj->select($IP_ADDRESS, false)) {
	$ipbanInfo = $ipbanObj->get_info();

	if(time() < $ipbanInfo['exptime'] OR $ipbanInfo['exptime'] == 0) {
		die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."banned.php';</script>");
	}
	else {
		$ipbanObj->delete();
	}

}

?>