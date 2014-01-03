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


include_once($prevFolder."classes/btupload.php");
include_once($prevFolder."classes/medal.php");
$cID = $_GET['cID'];


if($_POST['submit']) {
	$countErrors = 0;
	
	
	// Check Medal Name
	$checkMedalName = trim($_POST['medalname']);
	if($checkMedalName == "") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You may not enter a blank medal name.<br>";
	}
	
// Check Image Height
	
	if(!is_numeric($_POST['medalimageheight']) AND trim($_POST['medalimageheight']) != "") {
		$countErrors++;
		$dispError .="&nbsp;&nbsp;&nbsp;<b>&middot;</b> The Image Height must be a numeric value.<br>";
	}
	elseif($_POST['medalimageheight'] <= 0 AND is_numeric($_POST['medalimageheight'])) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> The Image Height must be a value greater than 0.<br>";
	}
	
	if($_FILES['medalimagefile']['name'] == "" AND (trim($_POST['medalimageheight']) == "" OR $_POST['medalimageheight'] <= 0)) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You must supply an image height for images that aren't uploaded.<br>";
	}
	
	// Check Image Width
	
	if(!is_numeric($_POST['medalimagewidth']) AND trim($_POST['medalimagewidth']) != "") {
		$countErrors++;
		$dispError .="&nbsp;&nbsp;&nbsp;<b>&middot;</b> The Image Width must be a numeric value.<br>";
	}
	elseif($_POST['medalimagewidth'] <= 0 AND is_numeric($_POST['medalimagewidth'])) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> The Image Width must be a value greater than 0.<br>";
	}
	
	if($_FILES['medalimagefile']['name'] == "" AND (trim($_POST['medalimagewidth']) == "" OR $_POST['medalimagewidth'] <= 0)) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You must supply an image width for images that aren't uploaded.<br>";
	}

	
	// Check Before/After and Medal
	
	$beforeAfterMedalOK = false;
	$medalObj = new Medal($mysqli);
	
	
	if($_POST['medalorder'] != "first") {
		if(!$medalObj->select($_POST['medalorder'])) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid medal order. (medal)<br>";
		}
		else {
			$beforeAfterMedalInfo = $medalObj->get_info();
			$beforeAfterMedalOK = true;
			
			// Check to see if we can get a new medal order number
			
			$intNewMedalOrderNum = $medalObj->makeRoom($_POST['beforeafter']);
			
			if(!is_numeric($intNewMedalOrderNum)) {
				$countErrors++;
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid medal order. (medal)<br>";
			}
			
		}
	}
	elseif($_POST['medalorder'] == "first") {
		
		// Check if its actually the first medal
		
		$result = $mysqli->query("SELECT * FROM ".$dbprefix."medals ORDER BY ordernum");
		$num_rows = $result->num_rows;
		
		if($num_rows > 0) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid medal order. (medal)<br>";
		}
		else {
			$intNewMedalOrderNum = 1;
		}
		
		
	}
	
	if($_POST['beforeafter'] != "after" AND $_POST['beforeafter'] != "before") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid medal order. (before/after)<br>";
	}
	
	
	// Check Auto Days
	
	if($_POST['autodays'] != "") {
		if(!is_numeric($_POST['autodays']) OR (is_numeric($_POST['autodays']) AND $_POST['autodays'] < 0)) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Auto days must either be blank or a positive numeric value.<br>";
		}
	}
	
	// If everything is ok, try uploading the image
	if($countErrors == 0) {
		// Check Medal Image File
		if($_FILES['medalimagefile']['name'] != "") {
			$uploadFile = new BTUpload($_FILES['medalimagefile'], "medal_", "../images/medals/", array(".jpg",".png",".gif",".bmp"));
			
			if(!$uploadFile->uploadFile()) {
				$countErrors++;
				$dispError .= "<b>&middot;</b> Unable to upload medal image file.  Please make sure the file extension is either .jpg, .png, .gif or .bmp<br>";
			}
			else {
				$medalImgURL = "images/medals/".$uploadFile->getUploadedFileName();
			}

		}
		else {
			
			if(trim($_POST['medalimageurl']) == "") {
				$countErrors++;
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You must include a medal image.<br>";
			}
			else {
				$medalImgURL = $_POST['medalimageurl'];
			}
		}
	}
	
	if($countErrors > 0) {
		
		$_POST = filterArray($_POST);
		
		$_POST['submit'] = false;
	}
	else {
		// EVERYTHING IS OK
		
		$newMedal = new Medal($mysqli);
		$arrColumns = array("name", "description", "imageurl", "ordernum", "autodays", "autorecruits", "imagewidth", "imageheight");
		$arrValues = array($_POST['medalname'], $_POST['medaldesc'], $medalImgURL, $intNewMedalOrderNum, $_POST['autodays'], $_POST['autorecruits'], $_POST['medalimagewidth'], $_POST['medalimageheight']);
		
		if($newMedal->addNew($arrColumns, $arrValues)) {
                    
                $newMedalInfo = $newMedal->get_info_filtered();
			
		echo "
			<div style='display: none' id='successBox'>
				<p align='center'>
					Successfully Added New Medal: <b>".$newMedalInfo['name']."</b>!
				</p>
			</div>
			
			<script type='text/javascript'>
				popupDialog('Add New Medal', '".$MAIN_ROOT."members', 'successBox');
			</script>
		";
		
		}
		else {
			$_POST['submit'] = false;
			$_POST = filterArray($_POST);
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to add new medal.  Please try again.<br>";
		}
		
	}
}



if(!$_POST['submit']) {

	
	$getMedals = $mysqli->query("SELECT * FROM ".$dbprefix."medals ORDER BY ordernum DESC");
	$medalOptions = "";
	while($arrMedals = $getMedals->fetch_assoc()) {
		$medalName = filterText($arrMedals['name']);
		$medalOptions .= "<option value='".$arrMedals['medal_id']."'>".$medalName."</option>";
	
	}
        
	$firstMedalOption = "";
	if($medalOptions == "") {
		$firstMedalOption = "<option value='first'>(first medal)</option>";
	}
	
	
	echo "
	
	<form action='console.php?cID=".$cID."' method='post' enctype='multipart/form-data'>
		<div class='formDiv'>
		
	";
		
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to add new medal because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	echo "
	
	<script type='text/javascript'>
		$(document).ready(function() {
			$('#medalcolor').miniColors({
				change: function(hex, rgb) { }
			});
		});
	</script>
		Fill out the form below to add a new medal.<br><br>
		<b><u>NOTE:</u></b> When adding a Medal Image, if both the File and URL are filled out, the File will be used.
		
		
		<table class='formTable'>
			<tr>
				<td colspan='2' class='main'>
					<b>General Information</b>
					<div class='dottedLine' style='width: 90%; padding-top: 3px'></div>
				</td>
			</tr>
			<tr>
				<td class='formLabel'>Medal Name:</td>
				<td class='main'><input type='text' name='medalname' value='".$_POST['medalname']."' class='textBox' style='width: 250px'></td>
			</tr>
			<tr>
				<td class='formLabel' valign='top'>Medal Image:</td>
				<td class='main'>
					File:<br><input type='file' name='medalimagefile' class='textBox' style='width: 250px; border: 0px'><br>
					<span class='tinyFont'>File Types: .jpg, .gif, .png, .bmp | <a href='javascript:void(0)' onmouseover=\"showToolTip('The file size upload limit is controlled by your PHP settings in the php.ini file.')\" onmouseout='hideToolTip()'>File Size: ".ini_get("upload_max_filesize")."B or less</a></span>
					<p><b><i>OR</i></b></p>
					URL:<br><input type='text' name='medalimageurl' value='".$_POST['medalimageurl']."' class='textBox' style='width: 250px'>
				</td>
			</tr>
			<tr>
				<td class='formLabel'>Image Width: <a href='javascript:void(0)' onmouseover=\"showToolTip('Set the Image Width to the width that you would like the Medal Image to be displayed on your website.')\" onmouseout='hideToolTip()'>(?)</a></td>
				<td class='main'>
					<input type='text' name='medalimagewidth' value='".$_POST['medalimagewidth']."' class='textBox' style='width: 40px'> <i>px</i>
				</td>
			</tr>
			<tr>
				<td class='formLabel'>Image Height: <a href='javascript:void(0)' onmouseover=\"showToolTip('Set the Image Height to the height that you would like the Medal Image to be displayed on your website.')\" onmouseout='hideToolTip()'>(?)</a></td>
				<td class='main'>
					<input type='text' name='medalimageheight' value='".$_POST['medalimageheight']."' class='textBox' style='width: 40px'> <i>px</i>
				</td>
			</tr>
			<tr>
				<td class='formLabel' valign='top'>Description:</td>
				<td class='main'><textarea class='textBox' name='medaldesc' rows='5' cols='40'>".$_POST['medaldesc']."</textarea></td>
			</tr>
			<tr>
				<td class='formLabel' valign='top'>Display Order:</td>
				<td class='main'><select name='beforeafter' class='textBox'><option value='before'>Before</option><option value='after'>After</option></select><br><select name='medalorder' class='textBox'>$firstMedalOption.$medalOptions</select></td>
			</tr>
			<tr>
				<td colspan='2' class='main'><br>
					<b>Auto-Award Information</b>
					<div class='dottedLine' style='width: 90%; padding-top: 3px; margin-bottom: 5px'></div>
					<div style='padding-left: 3px; padding-right: 35px; padding-bottom: 15px'>Set these options if you want a member to be automatically awarded for being in the clan a certain number of days or recruiting a certain amount of members.  Leave blank or 0 to disable this option.</div>
				</td>
			</tr>
			<tr>
				<td class='formLabel'><div style='padding-left: 3px'>Auto-Days:</div></td>
				<td class='main'><input type='text' class='textBox' name='autodays' value='".$_POST['autodays']."' style='width: 40px'></td>
			</tr>
			<tr>
				<td class='formLabel'><div style='padding-left: 3px'>Auto-Recruits:</div></td>
				<td class='main'><input type='text' class='textBox' name='autorecruits' value='".$_POST['autorecruits']."' style='width: 40px'></td>
			</tr>
			<tr>
				<td colspan='2' align='center'><br>
					<input type='submit' name='submit' value='Add Medal' class='submitButton'>
				</td>
			</tr>
			
		</table>
		</div>
	
	</form>
	
	
	
	";

}

?>