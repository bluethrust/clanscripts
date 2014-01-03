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
	
	// Posted Message?
	
	include_once("../../_setup.php");
	include_once("../../classes/member.php");

	$consoleObj = new ConsoleOption($mysqli);
	$member = new Member($mysqli);
	$member->select($_SESSION['btUsername']);
	
	$cID = $consoleObj->findConsoleIDByName("Inactive Request");
	$consoleObj->select($cID);


	if(!$member->authorizeLogin($_SESSION['btPassword']) || !$member->hasAccess($consoleObj) || !$member->requestedIA()) {
		exit();
	}
	
	$memberInfo = $member->get_info_filtered();
	
	$iaRequestObj = new Basic($mysqli, "iarequest", "iarequest_id");
	$iaRequestObj->select($member->requestedIA(true));
	
	$requestInfo = $iaRequestObj->get_info_filtered();
	
	
	if(trim($_POST['message']) != "" && $requestInfo['requeststatus'] == 0) {
		$iaRequestMessageObj = new Basic($mysqli, "iarequest_messages", "iamessage_id");
		
		$arrColumns = array("iarequest_id", "member_id", "messagedate", "message");
		$arrValues = array($requestInfo['iarequest_id'], $memberInfo['member_id'], time(), $_POST['message']);
		
		$iaRequestMessageObj->addNew($arrColumns, $arrValues);
		
	}
	
	
	
	$iaMember = new Member($mysqli);
	$counter = 1;
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."iarequest_messages WHERE iarequest_id = '".$requestInfo['iarequest_id']."' ORDER BY messagedate DESC");
	while($row = $result->fetch_assoc()) {
		
		if($counter == 0) {
			$addCSS = "";
			$counter = 1;
		}
		else {
			$addCSS = " alternateBGColor";		
			$counter = 0;
		}
		
		$iaMember->select($row['member_id']);
		echo "
			<div class='dottedLine".$addCSS."' style='padding: 10px 5px; width: 80%; margin-left: auto; margin-right: auto;'>
				".$iaMember->getMemberLink()." - ".getPreciseTime($row['messagedate'])."<br><br>
				<div style='padding-left: 5px'>".nl2br(filterText($row['message']))."</div>
			</div>
		";
		
	}
	

	if($result->num_rows == 0) {

		echo "
			<div class='shadedBox' style='margin: 20px auto; width: 50%'>
				<p align='center'><i>No Messages</i></p>					
			</div>
		";
		
	}
	else {
		echo "<br><br>";	
	}
	
	exit();
}
else {
	$memberInfo = $member->get_info();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}



if(!$member->requestedIA()) {

	if($_POST['submit']) {

		$requestIAObj = new Basic($mysqli, "iarequest", "iarequest_id");
		
		if($requestIAObj->addNew(array("reason", "requestdate", "member_id"), array($_POST['reason'], time(), $memberInfo['member_id']))) {
			
			echo "
			
				<div style='display: none' id='successBox'>
					<p align='center'>
						Inactive Request Sent!
					</p>
				</div>
				
				<script type='text/javascript'>
					popupDialog('Inactive Request', '".$MAIN_ROOT."members', 'successBox');
				</script>
			
			";
			
		}
		else {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save information to the database.  Please contact the website administrator.<br>";
		}
		
	}
	
	if(!$_POST['submit']) {
		
		echo "	
			<div class='formDiv'>
				Use the form below to request to be inactive.  When inactive, you will be able to log in, however you will not have access to any console options.  A higher ranking member will have to approve your request before your status is set to inactive.
				<br><br>
				<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."' method='post'>
					<table class='formTable'>
						<tr>
							<td class='formLabel' valign='top'>Reason: <a href='javascript:void(0)' onmouseover=\"showToolTip('Leave a reason and for how long you will be inactive for a better chance of being approved.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><textarea name='reason' style='width: 50%; height: 90px' class='textBox'>".$_POST['reason']."</textarea></td>
						</tr>
						<tr>
							<td class='main' align='center' colspan='2'><br>
								<input type='submit' name='submit' value='Send Request' class='submitButton'>
							</td>
						</tr>
					</table>
				</form>
			</div>
		";
		
	}
	
}
else {
	// Already requested to be inactive
	$iaRequestObj = new Basic($mysqli, "iarequest", "iarequest_id");
	$iaRequestObj->select($member->requestedIA(true));
	
	$requestInfo = $iaRequestObj->get_info_filtered();	
	
	
	$dispRequestStatus = "<span class='pendingFont'>Pending</span>";
	$dispSendMessages = " You may send additional messages using the form below.";
	if($requestInfo['requeststatus'] == 1) {
		$member->select($requestInfo['reviewer_id']);
		$dispRequestStatus = "<span class='allowText'>Approved</span> by ".$member->getMemberLink()." - ".getPreciseTime($requestInfo['reviewdate']);
		$member->select($memberInfo['member_id']);
		$dispSendMessages = "  A higher ranking member must delete the request before you can issue another request.";
	}
	elseif($requestInfo['requeststatus'] == 2) {
		$member->select($requestInfo['reviewer_id']);
		$dispRequestStatus = "<span class='denyText'>Denied</span> by ".$member->getMemberLink()." - ".getPreciseTime($requestInfo['reviewdate']);
		$member->select($memberInfo['member_id']);
		$dispSendMessages = "  A higher ranking member must delete the request before you can issue another one.";
	}
	
	echo "
		
		<div class='formDiv'>
			You currently have an open inactive request.".$dispSendMessages."<br><br>
			
			<table class='formTable'>
				<tr>
					<td class='main' colspan='2'>
						<div class='dottedLine' style='padding-bottom: 3px'><b>Request Information:</b></div>
					</td>
				</tr>
				<tr>
					<td class='formLabel'>Request Date:</td>
					<td class='main'>".getPreciseTime($requestInfo['requestdate'])."</td>
				</tr>
				<tr>
					<td class='formLabel'>Status:</td>
					<td class='main'>".$dispRequestStatus."</td>
				</tr>
				<tr>
					<td class='formLabel' valign='top'>Reason:</td>
					<td class='main' valign='top'>".$requestInfo['reason']."</td>
				</tr>
				<tr>
					<td class='main' colspan='2'><br>
						<div class='dottedLine' style='padding-bottom: 3px'><b>Messages:</b></div>
					</td>
				</tr>
				<tr>
					<td class='main' colspan='2'>
						<div id='loadingSpiral' style='display: none'>
							<p align='center' class='main'>
								<img src='".$MAIN_ROOT."themes/".$THEME."/images/loading-spiral2.gif'><br>Loading
							</p>
						</div>
						<div id='iaMessages'></div>
					</td>
				</tr>
				
				";
				
				if($requestInfo['requeststatus'] == 0) {
					echo "
						<tr>
							<td class='formLabel' valign='top'>Leave Message:</td>
							<td class='main' valign='top'><textarea class='textBox' style='width: 50%; height: 90px' id='txtMessage'></textarea></td>
						</tr>
						<tr>
							<td class='main' align='center' colspan='2'><br>
								<input type='button' id='btnSend' value='Send Message' class='submitButton'>
							</td>
						</tr>
				
					";
				}
				else {
					echo "<input type='hidden' id='btnSend'>";	
				}
				
				echo "
				
			</table>
		</div>
		
		<script type='text/javascript'>
			
			$(document).ready(function() {
			
				$('#btnSend').click(function() {
					
					$('#iaMessages').fadeOut(250);
					$('#loadingSpiral').show();
					
					$.post('".$MAIN_ROOT."members/include/requestinactive.php', { message: $('#txtMessage').val() }, function(data) {
					
						$('#iaMessages').html(data);
						$('#iaMessages').fadeIn(250);
						$('#loadingSpiral').hide();
											
					});
					
					$('#txtMessage').val('');
				});
				
				$('#btnSend').click();
							
			});
		
		</script>
		
	";
	
}
	
	



?>