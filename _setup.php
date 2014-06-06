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
ini_set('session.use_only_cookies', 1);
ini_set('session.gc_maxlifetime', 60*60*24*3);

date_default_timezone_set("UTC");

if(get_magic_quotes_gpc() == 1) {
	foreach($_GET as $key=>$value) { $_GET[$key] = stripslashes($value); }
	foreach($_POST as $key=>$value) { $_POST[$key] = stripslashes($value); }
}


if(isset($_COOKIE['btUsername']) && isset($_COOKIE['btPassword'])) {
	session_start();
	$_SESSION['btUsername'] = $_COOKIE['btUsername'];
	$_SESSION['btPassword'] = $_COOKIE['btPassword'];
}
else {
	session_start();
}

if(!isset($_SESSION['csrfKey'])) {
	$_SESSION['csrfKey'] = md5(uniqid());
}

include($prevFolder."_config.php");
define("BASE_DIRECTORY", $_SERVER['DOCUMENT_ROOT'].$MAIN_ROOT);
define("MAIN_ROOT", $MAIN_ROOT);
define("THEME", $THEME);

$PAGE_NAME = "";
include_once($prevFolder."_functions.php");

$mysqli = new btmysql($dbhost, $dbuser, $dbpass, $dbname);


$mysqli->set_tablePrefix($dbprefix);
$mysqli->set_testingMode(true);

$logObj = new Basic($mysqli, "logs", "log_id");

// Get Clan Info
$webInfoObj = new WebsiteInfo($mysqli);

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
	//ini_set('error_reporting', E_ALL);
	ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT);
	ini_set('display_errors', 1);
}


// Check for Ban

$ipbanObj = new IPBan($mysqli);
if($ipbanObj->isBanned($IP_ADDRESS)) {
	die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."banned.php';</script>");
}

$hooksObj = new btHooks();
?>