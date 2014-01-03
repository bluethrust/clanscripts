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

include_once("../../_setup.php");
include_once("../../classes/member.php");
include_once("../../classes/rank.php");
include_once("../../classes/rankcategory.php");
include_once("../../classes/squad.php");
include_once("../../classes/tournament.php");


// Function to Retrieve Multiple Recipient Names


function getRecipients($pmID) {
	global $mysqli, $MAIN_ROOT, $dbprefix;

	$multiMemPMObj = new Basic($mysqli, "privatemessage_members", "pmmember_id");
	$member = new Member($mysqli);
	$rankCatObj = new RankCategory($mysqli);
	$squadObj = new Squad($mysqli);
	$tournamentObj = new Tournament($mysqli);

	
	
	$arrGroups['list'] = array();
	$arrGroups['rank'] = array();
	$arrGroups['squad'] = array();
	$arrGroups['tournament'] = array();
	$arrGroups['rankcategory'] = array();
	
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."privatemessage_members WHERE pm_id = '".$pmID."'");
	while($row = $result->fetch_assoc()) {
		if($row['grouptype'] != "" && !in_array($row['group_id'], $arrGroups[$row['grouptype']])) {
			$arrGroups[$row['grouptype']][] = $row['group_id'];

			switch($row['grouptype']) {
				case "rankcategory":
					$dispName = ($rankCatObj->select($row['group_id'])) ? $rankCatObj->get_info_filtered("name")." - Category" : "";
					break;
				case "rank":
					$dispName = ($member->objRank->select($row['group_id'])) ? $member->objRank->get_info_filtered("name")." - Rank" : "";
					break;
				case "squad":
					$dispName = ($squadObj->select($row['group_id'])) ? "<a href='".$MAIN_ROOT."squads/profile.php?sID=".$row['group_id']."'>".$squadObj->get_info_filtered("name")." Members</a>" : "";
					break;
				case "tournament":
					$dispName = ($tournamentObj->select($row['group_id'])) ? "<a href='".$MAIN_ROOT."tournaments/view.php?tID=".$row['group_id']."'>".$tournamentObj->get_info_filtered("name")." Players</a>" : "";
					break;
			}
	
	
			$arrGroups['list'][] = $dispName;
	
	
		}
		elseif($row['grouptype'] == "") {
			$member->select($row['member_id']);
			$arrGroups['list'][] = $member->getMemberLink();
		}
	}
	
	
	$dispToMember = implode(", ", $arrGroups['list']);
	
	return $dispToMember;

}

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
$consoleObj = new ConsoleOption($mysqli);

$cID = $consoleObj->findConsoleIDByName("Private Messages");
$consoleObj->select($cID);
$consoleInfo = $consoleObj->get_info_filtered();
$consoleTitle = $consoleInfo['pagetitle'];



$member = new Member($mysqli);
$member->select($_SESSION['btUsername']);

$prevFolder = "../../";
$PAGE_NAME = "Compose Message - ".$consoleTitle." - ";
$dispBreadCrumb = "<a href='".$MAIN_ROOT."'>Home</a> > <a href='".$MAIN_ROOT."members'>My Account</a> > <a href='".$MAIN_ROOT."members/console.php?cID=".$cID."'>".$consoleTitle."</a> > Compose Message";
$EXTERNAL_JAVASCRIPT .= "
<script type='text/javascript' src='".$MAIN_ROOT."members/js/console.js'></script>
<script type='text/javascript' src='".$MAIN_ROOT."members/js/main.js'></script>
";

include("../../themes/".$THEME."/_header.php");
echo "
<div class='breadCrumbTitle' id='breadCrumbTitle'>Compose Message</div>
<div class='breadCrumb' id='breadCrumb' style='padding-top: 0px; margin-top: 0px'>
$dispBreadCrumb
</div>
";

$pmObj = new BasicOrder($mysqli, "privatemessages", "pm_id");
$multiMemPMObj = new Basic($mysqli, "privatemessage_members", "pmmember_id");

$pmObj->set_assocTableName("privatemessage_members");
$pmObj->set_assocTableKey("pmmember_id");


// Check Login
$LOGIN_FAIL = true;
if($member->authorizeLogin($_SESSION['btPassword']) && $member->hasAccess($consoleObj) && $pmObj->select($_GET['pmID'])) {

	$memberInfo = $member->get_info_filtered();
	
	$pmInfo = $pmObj->get_info_filtered();
	
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."privatemessage_members WHERE pm_id = '".$pmInfo['pm_id']."' AND member_id = '".$memberInfo['member_id']."'");
	
	$blnMultiPM = false;
	
	
	if($pmInfo['receiver_id'] == $memberInfo['member_id'] || $pmInfo['sender_id'] == $memberInfo['member_id'] || $result->num_rows > 0) {
	

		$member->select($pmInfo['sender_id']);
		$dispFromMember = $member->getMemberLink();
		
		if($memberInfo['member_id'] == $pmInfo['receiver_id']) {
			$member->select($pmInfo['receiver_id']);
			$dispToMember = $member->getMemberLink();
			$pmObj->update(array("status"), array(1));	
		}
		elseif($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$pmMemberID = $row['pmmember_id'];
			$multiMemPMObj->select($pmMemberID);
			$multiMemPMObj->update(array("seenstatus"), array(1));
			$blnMultiPM = true;
			$dispToMember = getRecipients($pmInfo['pm_id']);
			
		}
		
		$dispPreviousMessages = "";
		
		
		if($pmInfo['originalpm_id'] != 0) {
			$result = $mysqli->query("SELECT * FROM ".$dbprefix."privatemessages WHERE originalpm_id = '".$pmInfo['originalpm_id']."' AND pm_id != '".$pmInfo['pm_id']."' ORDER BY datesent DESC");
			
	
				
			$dispPreviousMessages .= "
				<tr>
					<td class='main' colspan='2'><br><br>
						<b>Previous Messages:</b>
						<div class='dottedLine' style='width: 90%; padding-top: 5px'></div><br>
					</td>
				</tr>
			";
			
			
			
			
			
			while($row = $result->fetch_assoc()) {
				
				
				if($row['receiver_id'] != 0) {
				
					$member->select($row['receiver_id']);
					$dispToPrevMember = $member->getMemberLink();
				}
				else {
					
					$dispToPrevMember = getRecipients($row['pm_id']);
					$pmObj->select($row['pm_id']);
					$arrReceivers = $pmObj->getAssociateIDs();
					
					
				}
				
				$member->select($row['sender_id']);
				$dispFromPrevMember = $member->getMemberLink();
				
				
				$dispPreviousMessages .= "
				
					<tr>
						<td class='formLabel'>To:</td>
						<td class='main'>
							".$dispToPrevMember."
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Date:</td>
						<td class='main'>
							".getPreciseTime($row['datesent'])."
						</td>
					</tr>
					<tr>
						<td class='formLabel'>From:</td>
						<td class='main'>
							".$dispFromPrevMember."
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Subject:</td>
						<td class='main'>".$row['subject']."</td>
					</tr>
					<tr>
						<td colspan='2'><br></td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Message:</td>
						<td class='main'>
							".nl2br(parseBBCode($row['message']))."
						</td>
					</tr>
					<tr>
						<td colspan='2' class='main'>
							<div class='dottedLine' style='width: 90%; margin-top: 30px; margin-bottom: 30px'></div>
						</td>
					</tr>
				";
				
			}
		
		}
		
		
		
		if($pmInfo['originalpm_id'] == 0) {
			$replyID = $pmInfo['pm_id'];
			$threadID = $pmInfo['pm_id'];
		}
		else {
			$replyID = $pmInfo['pm_id'];
			$threadID = $pmInfo['originalpm_id'];
			
			$pmObj->select($threadID);
			
			$originalPMInfo = $pmObj->get_info_filtered();
			$member->select($originalPMInfo['receiver_id']);
			$dispToPrevMember = ($originalPMInfo['receiver_id'] != 0) ? $member->getMemberLink() : getRecipients($originalPMInfo['pm_id']);
			
			$member->select($originalPMInfo['sender_id']);
			$dispFromPrevMember = $member->getMemberLink();
			
			$dispPreviousMessages .= "
			
			
				<tr>
					<td class='formLabel'>To:</td>
					<td class='main'>
						".$dispToPrevMember."
					</td>
				</tr>
				<tr>
					<td class='formLabel'>Date:</td>
					<td class='main'>
						".getPreciseTime($originalPMInfo['datesent'])."
					</td>
				</tr>
				<tr>
					<td class='formLabel'>From:</td>
					<td class='main'>
						".$dispFromPrevMember."
					</td>
				</tr>
				<tr>
					<td class='formLabel'>Subject:</td>
					<td class='main'>".$originalPMInfo['subject']."</td>
				</tr>
				<tr>
					<td colspan='2'><br></td>
				</tr>
				<tr>
					<td class='formLabel' valign='top'>Message:</td>
					<td class='main'>
						".nl2br(parseBBCode($originalPMInfo['message']))."
					</td>
				</tr>
				<tr>
					<td colspan='2' class='main'>
						<div class='dottedLine' style='width: 90%; margin-top: 30px; margin-bottom: 30px'></div>
					</td>
				</tr>
			
			
			";
			
			
			
			
		}
		
		
		echo "
		
			<div class='formDiv'>
				<p style='padding: 0px; margin: 0px; padding-right: 20px; padding-top: 10px' class='main' align='right'>
					<a href='".$MAIN_ROOT."members/console.php?cID=".$cID."'>Return to Inbox</a>
				</p>
			
				<table class='formTable' style='margin-top: 0px'>
					<tr>
						<td class='formLabel'>To:</td>
						<td class='main'>
							".$dispToMember."
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Date:</td>
						<td class='main'>
							".getPreciseTime($pmInfo['datesent'])."
						</td>
					</tr>
					<tr>
						<td class='formLabel'>From:</td>
						<td class='main'>
							".$dispFromMember."
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Subject:</td>
						<td class='main'>".$pmInfo['subject']."</td>
					</tr>
					<tr>
						<td colspan='2'><br></td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Message:</td>
						<td class='main'>
							".nl2br(parseBBCode($pmInfo['message']))."
						</td>
					</tr>
					<tr>
						<td class='main' colspan='2' align='center'><br>
							<div class='dottedLine' style='width: 75%'></div><br>
							<input type='button' id='replyButton' class='submitButton' value='Reply'>
							";
		
						if($blnMultiPM) {
							
							echo "<input type='button' id='replyAllButton' class='submitButton' style='margin-left: 20px' value='Reply All'>";
							
						}
		
		echo "
						</td>
					</tr>
					".$dispPreviousMessages."					
				</table>
				
			</div>
		
			";
		
		$member->select($memberInfo['member_id']);
		$totalPMs = $member->countPMs();
		$totalNewPMs = $member->countPMs(true);
		

		if($totalNewPMs > 0) {
			$dispPMCount = "PM Inbox <b>(".$totalNewPMs.")</b> <img src='".$MAIN_ROOT."themes/".$THEME."/images/pmalert.gif'>";
			$intPMCount = $totalNewPMs;
		}
		else {
			$dispPMCount = "PM Inbox (".$totalPMs.")";
			$intPMCount = $totalPMs;
		}
		
		echo "
			
			<script type='text/javascript'>
			
				$(document).ready(function() {
				
					$('#replyButton').click(function() {
						window.location = '".$MAIN_ROOT."members/privatemessages/compose.php?replyID=".$replyID."&threadID=".$threadID."';
					});
					
					
					$('#replyAllButton').click(function() {
						window.location = '".$MAIN_ROOT."members/privatemessages/compose.php?replyID=".$replyID."&threadID=".$threadID."&replyall=1';
					});
					
					
					$('#pmLoggedInLink').html(\"".$dispPMCount."\");
					
				});
			
			</script>
			
		";
		
	
	
	}
	else {
		die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."members';</script>");
	}
	
}
else {

	die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."login.php';</script>");

}



include("../../themes/".$THEME."/_footer.php");

?>