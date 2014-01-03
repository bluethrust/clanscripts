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


$cID = $_GET['cID'];

$dispError = "";
$countErrors = 0;


if($_POST['submit']) {
	
	// Check News Type
	//	1 - Public
	// 	2 - Private
	
	if($_POST['newstype'] != 1 && $_POST['newstype'] != 2) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid news type.<br>";
	}
	
	
	// Check Subject
	
	if(trim($_POST['subject']) == "") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You must enter a news subject.<br>";
	}
	
	// Check Message
	
	if(trim($_POST['message']) == "") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You may not make a blank news post.<br>";
	}
	
	// Check HP Pin
	if($_POST['hpsticky'] != 1) {
		$_POST['hpsticky'] = 0;	
	}
	
	if($countErrors == 0) {
		$time = time();
		$arrColumns = array("member_id", "newstype", "dateposted", "postsubject", "newspost", "hpsticky");
		$arrValues = array($memberInfo['member_id'], $_POST['newstype'], $time, $_POST['subject'], $_POST['message'], $_POST['hpsticky']);
	
		$newsPost = new Basic($mysqli, "news", "news_id");
		if($newsPost->addNew($arrColumns, $arrValues)) {
	
			echo "
			<div style='display: none' id='successBox'>
			<p align='center'>
			Successfully Posted News!
			</p>
			</div>
	
			<script type='text/javascript'>
			popupDialog('Post News', '".$MAIN_ROOT."members', 'successBox');
			</script>
	
			";
	
		}
		else {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save information to database! Please contact the website administrator.<br>";
		}
	
	
	}
	
	if($countErrors > 0) {
		$_POST = filterArray($_POST);
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
		<strong>Unable to post news because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	echo "
			Use the form below to post news.<br><br>
				
				<table class='formTable'>
					<tr>
						<td class='formLabel'>News Type:</td>
						<td class='main'><select name='newstype' class='textBox' id='newsType' onchange='updateTypeDesc()'><option value='1'>Public</option><option value='2'>Private</option></select><span class='tinyFont' style='padding-left: 10px' id='typeDesc'></span></td>
					</tr>
					<tr>
						<td class='formLabel'>Pin to Homepage: <a href='javascript:void(0)' onmouseover=\"showToolTip('Pinning a news post to the homepage will force the news post to remain on the homepage even when new posts are made.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'><input type='checkbox' name='hpsticky' value='1'></td>
					</tr>
					<tr>
						<td class='formLabel'>Subject:</td>
						<td class='main'><input type='text' name='subject' value='".$_POST['subject']."' class='textBox' style='width: 250px'></td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Message:</td>
						<td class='main'>
							<textarea rows='10' cols='50' class='textBox' name='message'>".$_POST['message']."</textarea>
						</td>
					</tr>
					<tr>
						<td class='main' align='center' colspan='2'><br><br>
							<input type='submit' name='submit' value='Post News' class='submitButton' style='width: 125px'>
						</td>
					</tr>
				</table>
				
			</div>
		</form>
		
		<script type='text/javascript'>
			function updateTypeDesc() {
				$(document).ready(function() {
					$('#typeDesc').hide();
					if($('#newsType').val() == \"1\") {
						$('#typeDesc').html('<i>Share this news for the world to see!</i>');
					}
					else {
						$('#typeDesc').html('<i>Only show this post to members!</i>');
					}
					$('#typeDesc').fadeIn(250);
				
				});
			}
			
			updateTypeDesc();
		</script>
	
	
	
	";
	
}