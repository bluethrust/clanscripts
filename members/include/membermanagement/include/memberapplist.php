<?php

/*
 * Bluethrust Clan Scripts v4
 * Copyright 2012
 *
 * Author: Bluethrust Web Development
 * E-mail: support@bluethrust.com
 * Website: http://www.bluethrust.com
 *
 * License: http://www.bluethrust.com/license.php
 *
 */


if(!isset($member) || substr($_SERVER['PHP_SELF'], -11) != "console.php") {

	include_once("../../../../_setup.php");
	include_once("../../../../classes/member.php");
	include_once("../../../../classes/basicorder.php");



	$consoleObj = new ConsoleOption($mysqli);
	$member = new Member($mysqli);
	$member->select($_SESSION['btUsername']);

	$cID = $consoleObj->findConsoleIDByName("View Member Applications");
	$consoleObj->select($cID);


	if(!$member->authorizeLogin($_SESSION['btPassword']) || !$member->hasAccess($consoleObj)) {

		exit();

	}

}

$memberAppObj = new Basic($mysqli, "memberapps", "memberapp_id");
$appComponentObj = new BasicOrder($mysqli, "app_components", "appcomponent_id");
$appComponentObj->set_assocTableName("app_selectvalues");
$appComponentObj->set_assocTableKey("appselectvalue_id");

$result = $mysqli->query("SELECT memberapp_id FROM ".$dbprefix."memberapps ORDER BY applydate DESC");
while($row = $result->fetch_assoc()) {

	$memberAppObj->select($row['memberapp_id']);
	$memberAppInfo = $memberAppObj->get_info_filtered();
	
	$dispApplyDate = getPreciseTime($memberAppInfo['applydate']);
	
	echo "
		<div class='dottedBox' style='margin-top: 20px; width: 90%; margin-left: auto; margin-right: auto;'>
			<table class='formTable' style='width: 95%'>
				<tr>
					<td class='formLabel'>Date Applied:</td>
					<td class='main'>".$dispApplyDate."</td>
				</tr>
				<tr>
					<td class='formLabel'>Username:</td>
					<td class='main'>".$memberAppInfo['username']."</td>
				</tr>
				<tr>
					<td class='formLabel'>IP Address:</td>
					<td class='main'>".$memberAppInfo['ipaddress']."</td>
				</tr>
				<tr>
					<td class='formLabel'>E-mail:</td>
					<td class='main'><a href='mailto:".$memberAppInfo['email']."'>".$memberAppInfo['email']."</a></td>
				</tr>
				
			";
	
	
	$memAppCompQuery = $mysqli->query("SELECT appcomponent_id FROM ".$dbprefix."app_components ORDER BY ordernum DESC");
	while($row2 = $memAppCompQuery->fetch_assoc()) {
		
		$appComponentObj->select($row2['appcomponent_id']);
		$appCompInfo = $appComponentObj->get_info_filtered();
		
		if($appCompInfo['componenttype'] == "multiselect") {
			$counter = 1;	
		}
		
		$appResponseValue = "";
		$memAppRespQuery = $mysqli->query("SELECT appvalue FROM ".$dbprefix."app_values WHERE appcomponent_id = '".$appCompInfo['appcomponent_id']."' AND memberapp_id = '".$memberAppInfo['memberapp_id']."'");
		while($row3 = $memAppRespQuery->fetch_assoc()) {
			
			$filterAppValue = filterText($row3['appvalue']);
			
			if($appCompInfo['componenttype'] == "multiselect") {
				$filterAppValue = $counter.". ".$filterAppValue."<br>";
				$counter++;
				
				$appResponseValue .= $filterAppValue;
			}
			else {
				$appResponseValue = $filterAppValue;	
			}
		
		}
		
		
		
		echo "
			<tr>
				<td class='formLabel' valign='top'>".$appCompInfo['name'].":</td>
				<td class='main'>".nl2br($appResponseValue)."</td>
			</tr>
		";
		
	}
	
	
	
	echo "
				<tr>
					<td colspan='2' align='center' class='main'>
						<br><br>
						
						";
						
	if($memberAppInfo['memberadded'] == 0) {
		echo "
			<a href='javascript:void(0)' onclick=\"acceptApp('".$memberAppInfo['memberapp_id']."')\"><b>Accept</b></a> - <a href='javascript:void(0)' onclick=\"declineApp('".$memberAppInfo['memberapp_id']."')\"><b>Decline</b></a>
		";
	}
	else {
		echo "
			<span class='successFont' style='font-weight: bold'>Member Added!</span> - <a href='javascript:void(0)' onclick=\"removeApp('".$memberAppInfo['memberapp_id']."')\"><b>Remove</b></a>
		";
	}
					echo "
						
					</td>
				</tr>
			</table>
		</div>
	";
	
}

if($result->num_rows == 0) {

	echo "
		<div class='shadedBox' style='width: 400px; margin-top: 50px; margin-left: auto; margin-right: auto'>
			<p class='main' align='center'>
				<i>There are currently no member applications.</i>
			</p>
		</div>
	";
	
}
else {
	$mysqli->query("UPDATE ".$dbprefix."memberapps SET seenstatus = '1' WHERE seenstatus = '0'");	
}

	
?>
