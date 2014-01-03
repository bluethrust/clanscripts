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

include_once("../../../_setup.php");
include_once("../../../classes/member.php");
include_once("../../../classes/rank.php");


// Start Page
$consoleObj = new ConsoleOption($mysqli);

$cID = $consoleObj->findConsoleIDByName("Private Messages");
$consoleObj->select($cID);
$consoleInfo = $consoleObj->get_info_filtered();


$member = new Member($mysqli);
$member->select($_SESSION['btUsername']);

$pmObj = new Basic($mysqli, "privatemessages", "pm_id");
$multiMemPMObj = new Basic($mysqli, "privatemessage_members", "pmmember_id");

// Check Login
$LOGIN_FAIL = true;
if($member->authorizeLogin($_SESSION['btPassword']) && $member->hasAccess($consoleObj)) {

$memberInfo = $member->get_info_filtered();
$arrPM = array();
$arrPMMID = array();

$result = $mysqli->query("SELECT pm_id, datesent FROM ".$dbprefix."privatemessages WHERE receiver_id = '".$memberInfo['member_id']."' AND deletereceiver = '0' ORDER BY datesent DESC");
while($row = $result->fetch_assoc()) {
	$arrPM[$row['pm_id']] = $row['datesent'];
}

$result = $mysqli->query("SELECT ".$dbprefix."privatemessage_members.*, ".$dbprefix."privatemessages.datesent FROM ".$dbprefix."privatemessage_members, ".$dbprefix."privatemessages WHERE ".$dbprefix."privatemessage_members.pm_id = ".$dbprefix."privatemessages.pm_id AND ".$dbprefix."privatemessage_members.member_id = '".$memberInfo['member_id']."' AND ".$dbprefix."privatemessage_members.deletestatus = '0' ORDER BY ".$dbprefix."privatemessages.datesent DESC");
while($row = $result->fetch_assoc()) {
	$arrPM[$row['pm_id']] = $row['datesent'];
	$arrPMMID[$row['pm_id']] = $row['pmmember_id'];
}

arsort($arrPM);
echo "<table class='formTable' style='border-spacing: 0px'>";
foreach($arrPM as $key => $value) {

	$pmObj->select($key);
	$pmInfo = $pmObj->get_info_filtered();

	$useAltBG = " alternateBGColor";
	
	if(isset($arrPMMID[$key]) && $multiMemPMObj->select($arrPMMID[$key]) && $multiMemPMObj->get_info("seenstatus") == 1) {
		$useAltBG = "";	
	}
	elseif(!isset($arrPMMID[$key]) && $pmInfo['status'] == 1) {
		$useAltBG = "";
	}
	
	$addToPMValue = "";
	if(isset($arrPMMID[$key])) {
		$addToPMValue = "_".$arrPMMID[$key];	
	}
	
	$member->select($pmInfo['sender_id']);
	$dispSender = $member->getMemberLink();

	echo "
	<tr>
		<td class='pmInbox main solidLine".$useAltBG."' style='padding-left: 0px' width=\"5%\"><input type='checkbox' value='".$pmInfo['pm_id'].$addToPMValue."' class='textBox'></td>
		<td class='pmInbox main solidLine".$useAltBG."' width=\"30%\">".$dispSender."</td>
		<td class='pmInbox main solidLine".$useAltBG."' width=\"35%\"><a href='".$MAIN_ROOT."members/privatemessages/view.php?pmID=".$pmInfo['pm_id']."'>".filterText($pmInfo['subject'])."</a></td>
		<td class='pmInbox main solidLine".$useAltBG."' width=\"30%\">".getPreciseTime($pmInfo['datesent'])."</td>
	</tr>
	";

}

if(count($arrPM) == 0) {

	echo "
	<tr>
		<td class='main' colspan='4'>
			<p align='center' style='font-style: italic'>
				Your private message inbox is empty!
			</p>
		</td>
	</tr>

	";

}

echo "</table>";

}

?>