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
	
	
	// Check If Blank
	
	if(trim($_POST['newusername']) == "") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Your username may not be blank.<br>";
	}
	
	// Check for duplicate
	$checkMemberObj = new Member($mysqli);
	if($checkMemberObj->select($_POST['newusername'])) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> There is already a member with that username.<br>";
	}
	
	
	if($countErrors == 0) {
		
		if($member->update(array("username"), array($_POST['newusername']))) {
			$memberInfo = $member->get_info_filtered();
			$_SESSION['btUsername'] = $memberInfo['username'];
			
			echo "
			
				<div style='display: none' id='successBox'>
					<p align='center'>
						Successfully changed username!
					</p>
				</div>
				
				<script type='text/javascript'>
					popupDialog('Change Username', '".$MAIN_ROOT."members', 'successBox');
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
		<strong>Unable to change username because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	echo "
				Use the form below to change your username.<br><br>
				
				<table class='formTable'>
					<tr>
						<td class='formLabel'>New Username:</td>
						<td class='main'><input type='username' class='textBox' name='newusername' style='width: 125px'></td>
					</tr>
					<tr>
						<td class='main' colspan='2' align='center'><br><br>
							<input type='submit' name='submit' value='Change Username' class='submitButton' style='width: 140px'>
						</td>
					</tr>
				</table>
				
			</div>
		</form>
	
	";
	
	
}