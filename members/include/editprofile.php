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


include_once("../classes/profilecategory.php");
include_once("../classes/profileoption.php");
include_once("../classes/btupload.php");
include_once("../classes/game.php");

$cID = $_GET['cID'];

$dispError = "";
$countErrors = 0;

$profileCategoryObj = new ProfileCategory($mysqli);
$profileOptionObj = new ProfileOption($mysqli);
$gameObj = new Game($mysqli);
$arrGames = $gameObj->getGameList();
$consoleCatSettingObj = new Basic($mysqli, "consolecategory", "consolecategory_id");
if($_POST['submit']) {
	
	
	// Check Profile Picture Upload
	
	if($_FILES['uploadprofilepic']['name'] != "") {
		$uploadProfile = new BTUpload($_FILES['uploadprofilepic'], "profile_", "../images/profile/", array(".jpg", ".png", ".gif", ".bmp"));
		
		if(!$uploadProfile->uploadFile()) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to upload your profile picture. Please make sure the file extension is either .jpg, .png, .gif or .bmp and that the file size is not too big.<br>";
		}
		else {
			$profilePicURL = "images/profile/".$uploadProfile->getUploadedFileName();
		}

	}
	else {
		
		$profilePicURL = $_POST['profilepicurl'];
		
	}
	
	// Check Avatar Picture Upload
	
	if($_FILES['uploadavatarpic']['name'] != "") {
		$uploadAvatar = new BTUpload($_FILES['uploadavatarpic'], "avatar_", "../images/avatar/", array(".jpg", ".png", ".gif", ".bmp"));
		
		if(!$uploadAvatar->uploadFile()) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to upload your avatar picture. Please make sure the file extension is either .jpg, .png, .gif or .bmp and that the file size is not too big.<br>";
		}
		else {
			$avatarPicURL = "images/avatar/".$uploadAvatar->getUploadedFileName();
		}
	}
	else {
		$avatarPicURL = $_POST['avatarpicurl'];	
	}
	
	// Check Default Console
	
	if(!$consoleCatSettingObj->select($_POST['defaultconsole'])) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid default console.<br>";
	}
	
	
	// Check Notification Options
	
	if(!in_array($_POST['notificationoptions'], array(0,1,2))) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid notification option.<br>";
	}
	
	if(is_numeric($_POST['birthday'])) {
		$_POST['birthday'] = $_POST['birthday']/1000;
	}
	else {
		$_POST['birthday'] = 0;	
	}
	
	// Check Posts/Topics Per Page
	
	if(!is_numeric($_POST['topicsperpage'])) {
		$_POST['topicsperpage'] = 10;	
	}
	
	if(!is_numeric($_POST['postsperpage'])) {
		$_POST['postsperpage'] = 10;
	}
	
	if($countErrors == 0) {
		
		$_POST['wysiwygHTML'] = str_replace("<?", "&lt;?", $_POST['wysiwygHTML']);
		$_POST['wysiwygHTML'] = str_replace("?>", "?&gt;", $_POST['wysiwygHTML']);
		$_POST['wysiwygHTML'] = str_replace("<script", "&lt;script", $_POST['wysiwygHTML']);
		$_POST['wysiwygHTML'] = str_replace("</script>", "&lt;/script&gt;", $_POST['wysiwygHTML']);
		
		if($member->update(array("profilepic", "avatar", "email", "facebook", "twitter", "youtube", "googleplus", "birthday", "maingame_id", "defaultconsole", "notifications", "twitch", "topicsperpage", "postsperpage", "forumsignature"), array($profilePicURL, $avatarPicURL, $_POST['email'], $_POST['facebook'], $_POST['twitter'], $_POST['youtube'], $_POST['googleplus'], $_POST['birthday'], $_POST['maingame'], $_POST['defaultconsole'], $_POST['notificationoptions'], $_POST['twitch'], $_POST['topicsperpage'], $_POST['postsperpage'], $_POST['wysiwygHTML']))) {
			// Updated Non-custom options, now update custom options
			
			$result = $mysqli->query("SELECT * FROM ".$dbprefix."profileoptions ORDER BY sortnum");
			while($row = $result->fetch_assoc()) {
				
				$postVal = "custom_".$row['profileoption_id'];
				if(!$member->setProfileValue($row['profileoption_id'], $_POST[$postVal])) {
					$countErrors++;
					$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save ".filterText($row['name']).".<br>";
				}
				
			}
			
			$mysqli->query("DELETE FROM ".$dbprefix."gamesplayed_members WHERE member_id = '".$memberInfo['member_id']."'");
			$gameMemberObj = new Basic($mysqli, "gamesplayed_members", "gamemember_id");
			foreach($arrGames as $gameID) {
				
				$postVal = "game_".$gameID;
				if($_POST[$postVal] == 1) {
					$gameMemberObj->addNew(array("member_id", "gamesplayed_id"), array($memberInfo['member_id'], $gameID));
				}
							
			}
			
			if(!$member->playsGame($_POST['maingame'])) {
				$gameMemberObj->addNew(array("member_id", "gamesplayed_id"), array($memberInfo['member_id'], $_POST['maingame']));
			}
			
			
			if($countErrors == 0) {
				
				echo "
				<div style='display: none' id='successBox'>
					<p align='center'>
						Successfully Saved Profile Information!
					</p>
				</div>
				
				<script type='text/javascript'>
					popupDialog('Edit Profile', '".$MAIN_ROOT."members', 'successBox');
				</script>
				";
				
			}

			
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
	
	// Figure out which Console Categories to show
	
	$arrPrivileges = $memberRank->get_privileges();
	$arrConsoleCats = array();
	$consoleSettingObj = new ConsoleOption($mysqli);
	
	foreach($arrPrivileges as $consoleOptionID) {
		$consoleSettingObj->select($consoleOptionID);
		$consoleCatID = $consoleSettingObj->get_info("consolecategory_id");
		if(!in_array($consoleCatID, $arrConsoleCats)) {
			$arrConsoleCats[] = $consoleCatID;
			$dispSelected = "";
			if($memberInfo['defaultconsole'] == $consoleCatID) {
				$dispSelected = " selected";	
			}
			$consoleCatSettingObj->select($consoleCatID);
			$consoleCatInfo = $consoleCatSettingObj->get_info_filtered();
			$arrConsoleCats[] = $consoleCatID;
			$arrDispConsoleCats[$consoleCatInfo['ordernum']] = "<option value='".$consoleCatID."'".$dispSelected.">".$consoleCatInfo['name']."</option>";
			
		}
	}
	

	krsort($arrDispConsoleCats);

	foreach($arrDispConsoleCats as $value) {
		$defaultconsoleoptions .= $value;
	}
	
	
	
	
	
	$dispBirthdayDate = "";
	$dispSetBirthday = "";
	if($memberInfo['birthday'] != 0) {
		$dispBirthdayDate = date("M j, Y", $memberInfo['birthday']);
		$dispSetBirthday = "defaultDate: '".$dispBirthdayDate."',";
	}
	
	
	
	$dispGamesPlayed = "";
	if(count($arrGames) > 0) {
		$dispGamesPlayed = "
			<tr>
				<td colspan='2' class='main'><br>
					<b>Games Played</b>
					<div class='dottedLine' style='width: 90%; padding-top: 3px'></div>
				</td>
			</tr>
		";
	}
	
	foreach($arrGames as $gameID) {
		
		$gameObj->select($gameID);
		
		$checkedGame = "";
		if($member->playsGame($gameID)) {
			$checkedGame = " checked";	
		}
		
		$dispSelected = "";
		if($memberInfo['maingame_id'] == $gameID) {
			$dispSelected = " selected";
		}
		
		$maingameoptions .= "<option value='".$gameID."'".$dispSelected.">".$gameObj->get_info_filtered("name")."</option>";
		
		$dispGamesPlayed .= "
			<tr>
				<td class='formLabel'>".$gameObj->get_info_filtered("name").":</td>
				<td class='main'><input type='checkbox' name='game_".$gameID."' class='textBox' style='border: 0px' value='1'".$checkedGame."></td>
			</tr>
		
		";
		
	}
	
	$dispGamesPlayed .= "
		<tr>
			<td class='formLabel'>Main Game:</td>
			<td class='main'><select name='maingame' class='textBox'>".$maingameoptions."</select></td>
		</tr>
	";
	
	
	$arrNotificationOptions[0] = "Show notification with sound";
	$arrNotificationOptions[1] = "Show notification without sound";
	$arrNotificationOptions[2] = "Don't show notifications";
	
	foreach($arrNotificationOptions as $key => $value) {
		$dispSelected = "";
		if($key == $memberInfo['notifications']) {
			$dispSelected = " selected";
		}
		$notificationoptions .= "<option value='".$key."'".$dispSelected.">".$value."</option>";	
	}
	
	
	$forumPostsPerPage = array(10, 25, 50, 75, 100);
	$topicsperpageoptions = "";
	$postsperpageoptions = "";
	foreach($forumPostsPerPage as $forumPosts) {
		
		$selectPosts = "";
		$selectTopics = "";
		if($memberInfo['postsperpage'] == $forumPosts) {
			$selectPosts = " selected";	
		}
		
		if($memberInfo['topicsperpage'] == $forumPosts) {
			$selectTopics = " selected";
		}
		
		
		$topicsperpageoptions .= "<option value='".$forumPosts."'".$selectTopics.">".$forumPosts."</option>";
		$postsperpageoptions .= "<option value='".$forumPosts."'".$selectPosts.">".$forumPosts."</option>";	
	}
	
	
	echo "
		<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."' method='post' enctype='multipart/form-data'>
			<div class='formDiv'>
			";
	
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to edit profile because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	echo "
				Use the form below to edit your profile.
				<table class='formTable'>
					<tr>
						<td colspan='2' class='main'>
							<b>Image Information</b>
							<div class='dottedLine' style='width: 90%; padding-top: 3px'></div>
						</td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Profile Picture: <a href='javascript:void(0)' onmouseover=\"showToolTip('Appears in your profile and squad profile.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'>
							File:<br>
							<input type='file' class='textBox' name='uploadprofilepic' style='width: 250px; border: 0px'><br>
							<span style='font-size: 10px'>&nbsp;&nbsp;&nbsp;<b>&middot;</b> Dimensions: 150x200 pixels<br>&nbsp;&nbsp;&nbsp;<b>&middot;</b> File Types: .jpg, .gif, .png, .bmp<br>&nbsp;&nbsp;&nbsp;<b>&middot;</b> <a href='javascript:void(0)' onmouseover=\"showToolTip('The file size upload limit is controlled by your PHP settings in the php.ini file.')\" onmouseout='hideToolTip()'>File Size: ".ini_get("upload_max_filesize")."B or less</a></span>
							<p><br><b><i>OR</i></b><br></p>
							URL:<br>
							<input type='text' class='textBox' name='profilepicurl' value='".$memberInfo['profilepic']."' style='width: 250px'><br><br>
						</td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Avatar: <a href='javascript:void(0)' onmouseover=\"showToolTip('Appears in your news and forum posts.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'>
							File:<br>
							<input type='file' class='textBox' name='uploadavatarpic' style='width: 250px; border: 0px'><br>
							<span style='font-size: 10px'>&nbsp;&nbsp;&nbsp;<b>&middot;</b> Dimensions: 50x50 pixels<br>&nbsp;&nbsp;&nbsp;<b>&middot;</b> File Types: .jpg, .gif, .png, .bmp<br>&nbsp;&nbsp;&nbsp;<b>&middot;</b> <a href='javascript:void(0)' onmouseover=\"showToolTip('The file size upload limit is controlled by your PHP settings in the php.ini file.')\" onmouseout='hideToolTip()'>File Size: ".ini_get("upload_max_filesize")."B or less</a></span>
							<p><br><b><i>OR</i></b><br></p>
							URL:<br>
							<input type='text' class='textBox' name='avatarpicurl' value='".$memberInfo['avatar']."' style='width: 250px'>
						</td>
					</tr>
					<tr>
						<td colspan='2' class='main'><br>
							<b>Console Settings</b>
							<div class='dottedLine' style='width: 90%; padding-top: 3px'></div>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Default Console: <a href='javascript:void(0)' onmouseover=\"showToolTip('Pick the console category that you want automatically selected when viewing the My Account page.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'><select name='defaultconsole' class='textBox'>".$defaultconsoleoptions."</select></td>
					</tr>
					<tr>
						<td colspan='2' class='main'><br>
							<b>Notification Settings</b>
							<div class='dottedLine' style='width: 90%; padding-top: 3px'></div>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Select: <a href='javascript:void(0)' onmouseover=\"showToolTip('Notifcations will show when you are promoted or awarded a medal etc.  Choose how you want to see them here.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'><select name='notificationoptions' class='textBox'>".$notificationoptions."</select></td>
					</tr>
					<tr>
						<td colspan='2' class='main'><br>
							<b>Forum Settings</b>
							<div class='dottedLine' style='width: 90%; padding-top: 3px'></div>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Topics Per Page:</td>
						<td class='main'><select name='topicsperpage' class='textBox'>".$topicsperpageoptions."</select></td>
					</tr>
					<tr>
						<td class='formLabel'>Posts Per Page:</td>
						<td class='main'><select name='postsperpage' class='textBox'>".$postsperpageoptions."</select></td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Signature:</td>
						<td class='main'><textarea id='tinymceTextArea' name='wysiwygHTML' style='width: 80%' rows='10'>".$memberInfo['forumsignature']."</textarea></td>
					</tr>
					</tr>
					<tr>
						<td colspan='2' class='main'><br>
							<b>Contact/Social Media Information</b>
							<div class='dottedLine' style='width: 90%; padding-top: 3px'></div>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>E-mail:</td>
						<td class='main'><input type='text' name='email' class='textBox' style='width: 250px' value='".$memberInfo['email']."'></td>
					</tr>
					<tr>
						<td class='formLabel'>Facebook: <a href='javascript:void(0)' onmouseover=\"showToolTip('Enter entire Facebook URL.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'><input type='text' name='facebook' class='textBox' style='width: 250px' value='".$memberInfo['facebook']."'></td>
					</tr>
					<tr>
						<td class='formLabel'>Twitter: <a href='javascript:void(0)' onmouseover=\"showToolTip('Enter your Twitter username.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'><input type='text' name='twitter' class='textBox' style='width: 250px' value='".$memberInfo['twitter']."'></td>
					</tr>
					<tr>
						<td class='formLabel'>Youtube: <a href='javascript:void(0)' onmouseover=\"showToolTip('Enter your Youtube username.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'><input type='text' name='youtube' class='textBox' style='width: 250px' value='".$memberInfo['youtube']."'></td>
					</tr>
					<tr>
						<td class='formLabel'>Google Plus: <a href='javascript:void(0)' onmouseover=\"showToolTip('Enter entire Google Plus URL.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'><input type='text' name='googleplus' class='textBox' style='width: 250px' value='".$memberInfo['googleplus']."'></td>
					</tr>
					<tr>
						<td class='formLabel'>Twitch: <a href='javascript:void(0)' onmouseover=\"showToolTip('Enter your Twitch ID.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'><input type='text' name='twitch' class='textBox' style='width: 250px' value='".$memberInfo['twitch']."'></td>
					</tr>
					<tr>
						<td colspan='2' class='main'><br>
							<b>Birthday</b>
							<div class='dottedLine' style='width: 90%; padding-top: 3px'></div>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Select Date:</td>
						<td class='main'><input type='text' id='jqbirthday' class='textBox' style='width: 150px; cursor: pointer' value='".$dispBirthdayDate."' readonly='readonly'></td>
					</tr>
					".$dispGamesPlayed;
					
					$result = $mysqli->query("SELECT * FROM ".$dbprefix."profilecategory ORDER BY ordernum DESC");
					while($row = $result->fetch_assoc()) {
						
						$profileCategoryObj->select($row['profilecategory_id']);
						$arrProfileOptions = $profileCategoryObj->getAssociateIDs("ORDER BY sortnum");
						
						echo "
						<tr>
							<td colspan='2' class='main'><br>
								<b>".$profileCategoryObj->get_info_filtered("name")."</b>
								<div class='dottedLine' style='width: 90%; padding-top: 3px'></div>
							</td>
						</tr>
						";
						
						foreach($arrProfileOptions as $profileOptionID) {
							
							$profileOptionObj->select($profileOptionID);
							
							$profileOptionValue = $member->getProfileValue($profileOptionID, true);
							
							if($profileOptionObj->isSelectOption()) {
								$arrSelectOptions = $profileOptionObj->getSelectValues();
								$dispInput = "<select name='custom_".$profileOptionID."' class='textBox'>";
								foreach($arrSelectOptions as $key=>$value) {
									
									$selectedOption = "";
									if($key == $profileOptionValue) {
										$selectedOption = " selected";	
									}
									$dispInput .= "<option value='".$key."'".$selectedOption.">".$value."</option>";

								}
								
								$dispInput .= "</select>";
								
								
							}
							else {
								$dispInput = "<input type='text' name='custom_".$profileOptionID."' value='".$profileOptionValue."' class='textBox' style='width: 200px'>";						
							}
							
							echo "
							<tr>
								<td class='formLabel' valign='top'>".$profileOptionObj->get_info_filtered("name").":</td>
								<td class='main' valign='top'>".$dispInput."</td>
							</tr>
							";
							
						}
						
					}
	
					echo "
					<tr>
						<td class='main' align='center' colspan='2'><br>
							<input type='submit' name='submit' value='Save' class='submitButton' style='width: 100px'>
						</td>
					</tr>
				</table>
			</div>
			<input type='hidden' id='realbirthday' value='".($memberInfo['birthday']*1000)."' name='birthday'>
		</form>
		
		
		<script type='text/javascript'>
		
			$(document).ready(function() {
			
				$('#jqbirthday').datepicker({
				
				";

	
					$maxYear = date("Y")-8;
					$maxDate = mktime(0,0,0,12,31,$maxYear);
					$maxJSDate = "new Date(".date("Y", $maxDate).",12,31),";
					echo "
					changeMonth: true,
					changeYear: true,
					dateFormat: 'M d, yy',
					minDate: new Date(50, 1, 1),
					maxDate: ".$maxJSDate."
					yearRange: '1950:".$maxYear."',
					".$dispSetBirthday."
					altField: '#realbirthday',
					altFormat: '@'
					
				
				});
			
				
				$('#tinymceTextArea').tinymce({
			
					script_url: '".$MAIN_ROOT."js/tiny_mce/tiny_mce.js',
					theme: 'advanced',
					plugins: 'autolink,emotions,advimagescale',
					cleanup_on_startup: true,
					advimagescale_max_width: 550,
					advimagescale_max_height: 150,
					advimagescale_loading_callback: function(imgNode) {
				        alert('resized to ' + imgNode.width + 'x' + imgNode.height);
				    },
					theme_advanced_buttons1: 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,|,bullist,numlist,|,link,unlink,image,emotions,|,quotebbcode,codebbcode,',
					theme_advanced_buttons2: 'forecolorpicker,fontselect,fontsizeselect',
					theme_advanced_resizing: true,
					content_css: '".$MAIN_ROOT."themes/".$THEME."/btcs4.css',
					theme_advanced_statusbar_location: 'none',
					style_formats: [
						{title: 'Quote', inline : 'div', classes: 'forumQuote'}
					
					],
					setup: function(ed) {
						ed.addButton('quotebbcode', {
							
							title: 'Insert Quote',
							image: '".$MAIN_ROOT."js/tiny_mce/quote.png',
							onclick: function() {
								ed.focus();
								innerText = ed.selection.getContent();
								
								ed.selection.setContent('[quote]'+innerText+'[/quote]');
							}
						});
						
						ed.addButton('codebbcode', {
							
							title: 'Insert Code',
							image: '".$MAIN_ROOT."js/tiny_mce/code.png',
							onclick: function() {
								ed.focus();
								innerText = ed.selection.getContent();
								
								ed.selection.setContent('[code]'+innerText+'[/code]');
							}
						
						});
					}
					
					
				
				});
			
			});
			
		</script>
	";
	
}