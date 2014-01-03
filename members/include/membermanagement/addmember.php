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


$rankInfo = $memberRank->get_info_filtered();
$cID = $_GET['cID'];

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
$rankObj->select($rankInfo['promotepower']);
$maxRankInfo = $rankObj->get_info_filtered();

$arrRanks = array();
$result = $mysqli->query("SELECT * FROM ".$dbprefix."ranks WHERE ordernum <= '".$maxRankInfo['ordernum']."' AND rank_id != '1' ORDER BY ordernum DESC");
while($row = $result->fetch_assoc()) {
	$arrRanks[] = $row['rank_id'];
}


$countErrors = 0;
$dispError = "";
if($_POST['submit']) {
	
	$newMemberObj = new Member($mysqli);
	$newMemberRankObj = new Rank($mysqli);
	
	$countErrors = 0;
	
	
	// Check username
	if(trim($_POST['newmember']) == "") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You may not enter a blank username.<br>";	
	}
	
	// Check password
	
	if(strlen($_POST['newpassword']) < 4) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Your password must be 4 or more characters long.<br>";
	}
	
	if($_POST['newpassword'] != $_POST['newpassword1']) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Your passwords did not match.<br>";
	}
	
	
	$setRankCID = $consoleObj->findConsoleIDByName("Set Member's Rank");
	$consoleObj->select($setRankCID);
	
	if(!isset($_POST['newmemberrank'])) {
		$newMemberRankObj->selectByOrder(2);
		$_POST['newmemberrank'] = $newMemberRankObj->get_info("rank_id");	
	}
	elseif(isset($_POST['newmemberrank']) && (!in_array($_POST['newmemberrank'], $arrRanks) || !$member->hasAccess($consoleObj))) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You may not set a member's starting rank.<br>";
	}
	
	if(!$newMemberRankObj->select($_POST['newmemberrank']) || $_POST['newmemberrank'] == "1") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid starting rank.<br>";
	}
	
	
	if($countErrors == 0) {
		
		
		
		$arrColumns = array("username", "rank_id", "datejoined", "recruiter", "lastlogin", "postsperpage", "topicsperpage");
		$arrValues = array($_POST['newmember'], $_POST['newmemberrank'], time(), $memberInfo['member_id'], time(), $websiteInfo['forum_postsperpage'], $websiteInfo['forum_topicsperpage']);
		
		if($newMemberObj->addNew($arrColumns, $arrValues)) {
			$newMemberObj->set_password($_POST['newpassword']);
			
			$newMemberInfo = $newMemberObj->get_info_filtered();
			
			echo "
				<div style='display: none' id='successBox'>
					<p align='center'>
						Successfully Added New Member: <b>".$newMemberInfo['username']."</b>!
					</p>
				</div>
				
				<script type='text/javascript'>
					popupDialog('Add New Member', '".$MAIN_ROOT."members/console.php?cID=".$cID."', 'successBox');
				</script>
			
			";
			
		}
		else {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save information to the database.  Please contact the website administrator.<br>";
		}
		
		
	}
	
	
	if($countErrors > 0) {

		$_POST['submit'] = false;	
		
	}
	
}


if(!$_POST['submit']) {
	
	
	$setRankCID = $consoleObj->findConsoleIDByName("Set Member's Rank");
	
	$consoleObj->select($setRankCID);
	$dispSetRank = false;
	if($member->hasAccess($consoleObj)) {
		
		// Get Ranks
		$sqlRanks = "('".implode("','", $arrRanks)."')";
		
		
		$result = $mysqli->query("SELECT * FROM ".$dbprefix."ranks WHERE rank_id IN ".$sqlRanks." AND rank_id != '1' ORDER BY ordernum");
		while($row = $result->fetch_assoc()) {
			$rankoptions .= "<option value='".$row['rank_id']."'>".filterText($row['name'])."</option>";
		}
		
		$dispSetRank = true;
	}
	
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."members ORDER BY datejoined DESC LIMIT 1");
	$row = $result->fetch_assoc();
	
	$member->select($row['member_id']);
	$dispLastMember = $member->getMemberLink();
	
	$dispLastMemberTime = getPreciseTime($row['datejoined']);
	
	echo "	
	
	<div class='main' style='padding-left: 15px; padding-bottom: 0px; margin-bottom: 0px'><b>Last Member Added:</b> ".$dispLastMember." - ".$dispLastMemberTime."</div>
	
		<div class='formDiv'>
		
		";
	
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to add new member because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	echo "
		
			<form action='console.php?cID=".$cID."' method='post'>
			Fill out the form below to add a new member.<br><br>
			
			
				<table class='formTable'>
					<tr>
						<td class='formLabel'>New Member:</td>
						<td class='main'><input type='text' name='newmember' value='".$websiteInfo['clantag']."' class='textBox' style='width: 125px'></td>
					</tr>
					<tr>
						<td class='formLabel'>Password:</td>
						<td class='tinyFont'><input type='password' id='newpassword' name='newpassword' class='textBox' style='width: 125px'><br>(Minimum 4 characters)</td>
					</tr>
					<tr>
						<td class='formLabel'>Re-type Password:</td>
						<td class='main'><input type='password' id='newpassword1' name='newpassword1' class='textBox' style='width: 125px'><span id='checkPassword' style='padding-left: 5px'></span></td>
					</tr>
					";
				if($dispSetRank) {
					echo "
					<tr>
						<td class='formLabel'>Starting Rank:</td>
						<td class='main'><select name='newmemberrank' class='textBox'>".$rankoptions."</select></td>
					</tr>
					";
				}
					echo "
					<tr>
						<td class='main' align='center' colspan='2'><br><br>
							<input type='submit' name='submit' value='Add New Member' class='submitButton'>
						</td>
					</tr>
				</table>
				
				
			</form>
		</div>
		
		
		
		<script type='text/javascript'>
			
			$(document).ready(function() {
			
				$('#newpassword1').keyup(function() {
					
					if($('#newpassword').val() != \"\") {
					
						if($('#newpassword1').val() == $('#newpassword').val()) {
							$('#checkPassword').toggleClass('successFont', true);
							$('#checkPassword').toggleClass('failedFont', false);
							$('#checkPassword').html('ok!');
						}
						else {
							$('#checkPassword').toggleClass('successFont', false);
							$('#checkPassword').toggleClass('failedFont', true);
							$('#checkPassword').html('error!');
						}
					
					}
					else {
						$('#checkPassword').html('');
					}
				
				});
			
			});
		
		</script>
		
	";
	
}


?>