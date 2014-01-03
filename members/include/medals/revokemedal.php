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
	$memberInfo = $member->get_info();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}

include_once("../classes/medal.php");

$rankInfo = $memberRank->get_info_filtered();
if($memberInfo['promotepower'] != 0) {
	$rankInfo['promotepower'] = $memberInfo['promotepower'];	
}
elseif($memberInfo['promotepower'] == -1) {
	$rankInfo['promotepower'] = 0;	
}

$cID = $_GET['cID'];

$dispError = "";
$countErrors = 0;
if($memberInfo['rank_id'] == 1) {

	$maxOrderNum = $mysqli->query("SELECT MAX(ordernum) FROM ".$dbprefix."ranks WHERE rank_id != '1'");
	$arrMaxOrderNum = $maxOrderNum->fetch_array(MYSQLI_NUM);

	if($maxOrderNum->num_rows > 0) {
		$result = $mysqli->query("SELECT rank_id FROM ".$dbprefix."ranks WHERE ordernum = '".$arrMaxOrderNum[0]."'");
		$row = $result->fetch_assoc();
		$rankInfo['promotepower'] = $row['rank_id'];
	}

}

$rankObj = new Rank($mysqli);
$medalObj = new Medal($mysqli);
$rankObj->select($rankInfo['promotepower']);
$maxRankInfo = $rankObj->get_info_filtered();

if($rankInfo['rank_id'] == 1) {
	$maxRankInfo['ordernum'] += 1;
}

$arrRanks = array();
$result = $mysqli->query("SELECT * FROM ".$dbprefix."ranks WHERE ordernum < '".$maxRankInfo['ordernum']."' AND rank_id != '1' ORDER BY ordernum DESC");
while($row = $result->fetch_assoc()) {
	$arrRanks[] = $row['rank_id'];
}


if($_POST['submit']) {
	
	// Check Member
	
	if(!$member->select($_POST['member']) || $_POST['member'] == $memberInfo['member_id']) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid member.<br>";		
	}
	elseif(!in_array($member->get_info("rank_id"), $arrRanks)) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You do not have permission to revoke medals from this member.<br>";
	}
	
	
	if(!in_array($_POST['medal'], $member->getMedalList())) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> This member does not have the selected medal.<br>";
	}
	
	
	// Check Medal
	
	if(!$medalObj->select($_POST['medal'])) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid medal.<br>";
	}
	
	// Check Freeze Time
	
	if(!is_numeric($_POST['freezetime']) && $_POST['freezetime'] <= 36500) {
		$countErrors++;
		$dispError = "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid freeze time.<br>";
	}
	
	
	if($countErrors == 0) {
		
		$revokeMedalObj = new Basic($mysqli, "medals_members", "medalmember_id");
		$arrMemberMedals = $member->getMedalList(true);
		$memberMedalID = array_search($_POST['medal'], $arrMemberMedals);

		if($revokeMedalObj->select($memberMedalID) && $revokeMedalObj->delete()) {
			
			// Check if medal is frozen for member already
			
			$arrFrozenMembers = $medalObj->getFrozenMembersList();
			
			if(in_array($_POST['member'], $arrFrozenMembers)) {
			
				$frozenMedalID = array_search($_POST['member'], $arrFrozenMembers);
				$medalObj->objFrozenMedal->select($frozenMedalID);
				$medalObj->objFrozenMedal->delete();
				
			}
			
			$frozenMessage = "";
			if($medalObj->get_info("autodays") != 0 || $medalObj->get_info("autorecruits") != 0) {
				$freezeTime = (86400*$_POST['freezetime'])+time();
				$medalObj->objFrozenMedal->addNew(array("medal_id", "member_id", "freezetime"), array($_POST['medal'], $_POST['member'], $freezeTime));
				$dispDays = ($_POST['freezetime'] == 1) ? "day" : "days";
				$frozenMessage = "  The medal will not be awarded again for ".$_POST['freezetime']." ".$dispDays.".";
			}
			
			
			$logMessage = $member->getMemberLink()." was stripped of the ".$medalObj->get_info_filtered("name")." medal.".$frozenMessage."<br><br><b>Reason:</b><br>".filterText($_POST['reason']);
			
			echo "
			
				<div style='display: none' id='successBox'>
					<p align='center'>
						Successfully revoked the <b>".$medalObj->get_info_filtered("name")."</b> medal from ".$member->getMemberLink()."!
					</p>
				</div>
				
				<script type='text/javascript'>
					popupDialog('Revoke Medal', '".$MAIN_ROOT."members', 'successBox');
				</script>
			
			";
			
			$member->postNotification("You were stripped of the medal: <b>".$medalObj->get_info_filtered("name")."</b>");
			
			$member->select($memberInfo['member_id']);
			$member->logAction($logMessage);
			
			
		}
		else {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save information to the database.  Please contact the website administrator.<br>";
		}
		
		
	}
	
	
	if($countErrors > 0) {
		$_POST = filterArray($_POST);
		$_POST['submit'] = false;
	}
	
	
	
}



if(!$_POST['submit']) {
	$sqlRanks = "('".implode("','", $arrRanks)."')";
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."members INNER JOIN ".$dbprefix."ranks ON ".$dbprefix."members.rank_id = ".$dbprefix."ranks.rank_id WHERE ".$dbprefix."members.rank_id IN ".$sqlRanks." AND ".$dbprefix."members.disabled = '0' AND ".$dbprefix."members.member_id != '".$memberInfo['member_id']."' ORDER BY ".$dbprefix."ranks.ordernum DESC, ".$dbprefix."members.username");
	while($row = $result->fetch_assoc()) {
	
		$rankObj->select($row['rank_id']);
		$memberoptions .= "<option value='".$row['member_id']."'>".$rankObj->get_info_filtered("name")." ".filterText($row['username'])."</option>";
	
	}
	
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."medals ORDER BY ordernum DESC");
	while($row = $result->fetch_assoc()) {
		$medaloptions .= "<option value='".$row['medal_id']."'>".filterText($row['name'])."</option>";	
	}
	
	echo "
	
	<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."' method='post'>
	<div class='formDiv' id='formDiv' style='position: relative'>
	";
	
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to revoke medal because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	echo "
	
			Use the form below to revoke a medal. <br><br>
			<b><u>NOTE:</u></b> If you revoke a medal that is awarded automatically after a certain number of days in the clan, it will be re-awarded to the member.
				<br><br>
				<table class='formTable'>
					<tr>
						<td class='formLabel'>Member:</td>
						<td class='main'><select name='member' id='memberselect' class='textBox'>".$memberoptions."</select></td>
					</tr>
					<tr>
						<td class='formLabel'>Medal:</td>
						<td class='main'><select name='medal' id='medalselect' class='textBox'>".$medaloptions."</option></select>
							<div class='main' style='display: none' id='reshowDiv'>
								<a href='javascript:void(0)' id='setShowTrue'>Show Medal Info</a>
							</div>
						</td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Reason:</td>
						<td class='main' valign='top'><textarea name='reason' cols='40' rows='3' class='textBox'>".$_POST['reason']."</textarea></td>
					</tr>
					<tr>
						<td class='formLabel'>Freeze Medal: <a href='javascript:void(0)' onmouseover=\"showToolTip('When revoking a medal that is auto-awarded based on number of days in the clan or number of recruits, the medal will be automatically re-awarded after being revoked.  Set this option to prevent the medal from being auto-awarded.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'>
							<select name='freezetime' class='textBox'>
								<option value='0'>Don't Freeze</option>
								<option value='1'>1 day</option>
								<option value='3'>3 days</option>
								<option value='7'>7 days</option>
								<option value='10'>10 days</option>
								<option value='14'>14 days</option>
								<option value='21'>21 days</option>
								<option value='30'>30 days</option>
								<option value='45'>45 days</option>
								<option value='60'>60 days</option>
								<option value='75'>75 days</option>
								<option value='90'>90 days</option>
								<option value='36500'>Forever</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='main' align='center' colspan='2'><br>		
							<input type='submit' name='submit' value='Revoke Medal' class='submitButton' style='width: 135px'>
						</td>
					</tr>
					
				</table>
				
				<div class='main' id='medalPopUp' style='display: none; position: relative'>
					<div class='loadingSpiral' id='loadingSpiral' style='position: relative'><p align='center'><img src='".$MAIN_ROOT."themes/".$THEME."/images/loading-spiral2.gif'><br><br><i>Loading...</i></p></div>
					<div id='medalInfoDiv' style='position: relative'></div>
					
				</div>
				
				
			</div>
		</form>
	
		
		
		<script type='text/javascript'>
			$(document).ready(function() {
				var blnHidePreview = 0;
				var intFirst = 0;
				
				
				$('#setShowTrue').click(function() {
					blnHidePreview = 0;
					intFirst = 0;
					$('#medalselect').change();
					$('#reshowDiv').hide();	
				});
				
				
				
				$('#memberselect').change(function() {
				
					var intMemberID = $('#memberselect').val();
					
					$('#medalselect').html('');
					
					
					$.post('".$MAIN_ROOT."members/include/medals/membermedals.php', { mID: intMemberID }, function(data) {
					
						$('#medalselect').html(data);
					
					});
				
				
				});
				
				
				$('#medalselect').change(function() {
					
					var intX = $('#formDiv').position().left+150+$('#formDiv').width();
					var intY = $('#formDiv').position().top+($('#formDiv').height()/2);
					
				
					$('#loadingSpiral').show();
					$('#medalInfoDiv').hide();
					$.post('".$MAIN_ROOT."members/include/medals/medalinfo.php', { medalID: $('#medalselect').val() }, function(data) {
						$('#medalInfoDiv').html(data);
						$('#medalInfoDiv').show();
						$('#loadingSpiral').hide();
						if(blnHidePreview == 0) {
							$('#medalPopUp').dialog({
								title: 'Medal Information',
								show: 'fade',
								zIndex: 99999,
								resizable: false,
								modal: false,
								width: 150,
								beforeClose: function(event, ui) {
									blnHidePreview = 1;
									$('#reshowDiv').show();
								}
							
							});
						}
						
					});
				
					if(intFirst == 0) { $('#medalPopUp').dialog({position: [intX,intY]}); intFirst = 1; }
					
				});
			
				
				$('#memberselect').change();
				
			});
		</script>
		
		
	";
	
	
	
}