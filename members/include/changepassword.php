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
	exit();
}
else {
	$memberInfo = $member->get_info_filtered();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}



$cID = $_GET['cID'];

$dispError = "";
$countErrors = 0;


if($_POST['submit']) {
	
	// Check length
	
	if(strlen($_POST['newpassword']) < 4) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Your password must be at least 4 characters long.<br>";
	}
	
	
	if($_POST['newpassword'] != $_POST['newpassword1']) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Your passwords did not match.<br>";
	}
	
	if(!$member->authorizeLogin($_POST['currentpassword'], 1)) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You entered an incorrect current password.<br>";
	}
	
	
	if($countErrors == 0) {
		
		if($member->set_password($_POST['newpassword'])) {
			$memberInfo = $member->get_info_filtered();
			$_SESSION['btPassword'] = $memberInfo['password'];
			
			echo "
			
				<div style='display: none' id='successBox'>
					<p align='center'>
						Successfully changed password!
					</p>
				</div>
				
				<script type='text/javascript'>
					popupDialog('Change Password', '".$MAIN_ROOT."members', 'successBox');
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

	echo "
		<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."' method='post'>
			<div class='formDiv'>
			
	";
	
	
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to change password because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	echo "
				Use the form below to change your password.<br><br>
				
				<table class='formTable'>
					<tr>
						<td class='formLabel'>Current Password:</td>
						<td class='main'><input type='password' class='textBox' name='currentpassword' style='width: 125px'></td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>New Password:</td>
						<td class='tinyFont'><input type='password' id='newpassword' name='newpassword' class='textBox' style='width: 125px'><br>(Minimum 4 characters)</td>
					</tr>
					<tr>
						<td class='formLabel'>Re-type New Password:</td>
						<td class='main'><input type='password' id='newpassword1' name='newpassword1' class='textBox' style='width: 125px'><span id='checkPassword' style='padding-left: 5px'></span></td>
					</tr>
					<tr>
						<td class='main' colspan='2' align='center'><br><br>
							<input type='submit' name='submit' value='Change Password' class='submitButton' style='width: 140px'>
						</td>
					</tr>
				</table>
				
			</div>
		</form>
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
