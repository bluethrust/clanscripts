<?php

/* This File Author information
 * Award System - Request Awards
 *
 * Author: Nuker_Viper
 * E-mail: nuker@swfclan.com
 * Website: http://www.swfclan.com
 *
 */


if(!isset($member) || substr($_SERVER['PHP_SELF'], -11) != "console.php") {
	exit();
}
else {
	$memberInfo = $member->get_info();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}

$rankInfo = $memberRank->get_info_filtered();
$cID = $_GET['cID'];

// Config File


// Classes needed for index.php
include_once("../../../classes/member.php");
include_once("../../../classes/medal.php");


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


// Start Page
$PAGE_NAME = "Awards - Request Awards";

$member = new Member($mysqli);
$medalObj = new Medal($mysqli);

?>

<table class='formTable' style='width: 75%; margin-left: auto; margin-right: auto'>
	<tr>
		<td class='formTitle' style='width: 40%'>Award:</td>
		<td class='formTitle' style='width: 60%'>Description:</td>
	</tr>
<?php

$result = $mysqli->query("SELECT medal_id FROM ".$dbprefix."medals WHERE autodays != '0' ORDER BY ordernum ASC");
while($row = $result->fetch_assoc()) {
	
	$medalObj->select($row['medal_id']);
	$medalObj->refreshImageSize();
	
	$medalInfo = $medalObj->get_info_filtered();
	$category = $medalInfo['category'];
	$canberequested = $medalInfo['canberequested'];
	$fileshare = $medalInfo['fileshare'];
	$autodays = $medalInfo['autodays'];
	
	// Autodays Info
		if($autodays != 0) { $disp_autodays = "<font color='silver'>Awarded after $autodays in the Clan</font>"; }
		else { $disp_autodays = ""; }
	
	/// Category Info
		if($category == 1) { $mc = " Clan Medal"; }
		if($category == 2) { $mc = " Clan Ops Award"; }
		if($category == 3) { $mc = " Clan Training Award"; }
		if($category == 4) { $mc = " MW3 Award"; }
		if($category == 5) { $mc = " MW3 Award"; }
		if($category == 6) { $mc = " Goldens"; }
		if($category == 7) { $mc = " Clan Ribbons"; }
		if($category == 8) { $mc = " Black Ops Medal"; }
		if($category == 9) { $mc = " Black Ops Ribbon"; }
		if($category == 10) { $mc = " Chief Awards"; }

	// Can it be request?
		if($canberequested == 1) { $can = "<font color='orange'>Requestable Award</font>"; }
		else { $can = "<font color='red'>Not A Requestable Award</font>"; }
	
	// Request Award Link and Info
		$requestAward = "Under Construction":
	
	echo "
		
		<tr>
			<td class='main' align='center' valign='top'>
				<img src='".$medalInfo['imageurl']."' width='".$medalInfo['imagewidth']."' height='".$medalInfo['imageheight']."'>
			</td>
			<td class='main' valign='top'>
				<font color='#00FF00'><b><u>".$medalInfo['name']."</u></b><br>
				<font color='#FFCC33'>Category:$mc</font><br><font color='#CCFFCC'>FileShare Required: $fileshare</font>
				<br><br>
				$can<br>
				<font color='steelblue'>".nl2br($medalInfo['description'])."</font><br>$disp_autodays<br>
				<br>
				<font color='steelblue'>$requestAward</font><br>
				<br>
				
			</td>
		</tr>
		<tr>
		<td colspan='2' class='main' align='center' valign='top'>-------------------------------------------------------------------------------------</td>
		</tr>
		<tr><td colspan='2'><br></td></tr>
	";
	
}


echo "</table>";



?>