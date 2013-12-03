<?php
ini_set('error_reporting', 'E_ALL & ~E_NOTICE & ~E_STRICT');

if(ini_get("register_globals") != 1) {
foreach($_POST AS $key => $value) { ${$key} = $value; }
foreach($_GET AS $key => $value) { ${$key} = $value; }
foreach($_COOKIE AS $key => $value) { ${$key} = $value; }
foreach($_SESSION AS $key => $value) { ${$key} = $value; }
foreach($_FILES AS $key => $value) { ${$key} = $value; }
}

/////////////////////////////// NEEDED INFORMATION \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

$dbhost = "localhost";  // DATABASE HOST
$dbuser = "root";
$dbpass = "root";			// DATABASE PASSWORD
$dbname = "cs3";		// DATABASE NAME
$dbprefix = "";			// DATABASE PREFIX (if needed, used for multiple sites and 1 database)


$adminuser = "admin";	// ADMIN SECTION USERNAME (can't be empty)
$adminpass = "admin";	// ADMIN SECTION PASSWORD (can't be empty)


/////////////////////////////// DO NOT EDIT BELOW \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

include("_functions.php");

$theme = getWSInfo("theme");
$clanname = getWSInfo("clanname");
$clantag = getWSInfo("tag");
$ip = $_SERVER['REMOTE_ADDR'];
$datesmall = date("m/d/y");
$forumurl = getWSInfo("forumurl");

if(substr_count($_SERVER['PHP_SELF'], "ipbanned.php") <= 0) { checkIPBan($ip); }

?>