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


include_once($prevFolder."classes/btupload.php");
include_once($prevFolder."classes/medal.php");
$cID = $_GET['cID'];

$medalObj = new Medal($mysqli);


if(!$medalObj->select($_GET['mID'])) {
	die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."members';</script>");
}


$medalInfo = $medalObj->get_info_filtered();

echo "

<script type='text/javascript'>
$(document).ready(function() {
$('#breadCrumb').html(\"<a href='".$MAIN_ROOT."'>Home</a> > <a href='".$MAIN_ROOT."members'>My Account</a> > <a href='".$MAIN_ROOT."members/console.php?cID=".$cID."'>Manage Medals</a> > ".$medalInfo['name']."\");
});
</script>
";


if($_POST['submit']) {
	$resortOrder = false;
	$medalImgURL = "";
	$countErrors = 0;
	
	// Check Medal Name
	if(trim($_POST['medalname']) == "") {
		$countErrors++;
		$dispError .= "&nbsp&nbsp;&nbsp;<b>&middot;</b> You may not enter a blank medal name.<br>";
	}
	
	//Check Image Width
	
	if((is_numeric($_POST['medalimagewidth']) AND $_POST['medalimagewidth'] < 0) OR ((!is_numeric($_POST['medalimagewidth']) OR trim($_POST['medalimagewidth']) == "") AND $_FILES['medalimagefile']['name'] == "")) {
		$countErrors++;
		$dispError .= "&nbsp&nbsp;&nbsp;<b>&middot;</b> You must enter a valid number for the image width.<br>";
	}
	
	//Check Image Height
	
	if((is_numeric($_POST['medalimageheight']) AND $_POST['medalimageheight'] < 0) OR ((!is_numeric($_POST['medalimageheight']) OR trim($_POST['medalimageheight']) == "") AND $_FILES['medalimagefile']['name'] == "")) {
		$countErrors++;
		$dispError .= "&nbsp&nbsp;&nbsp;<b>&middot;</b> You must enter a valid number for the image height.<br>";
	}
	
	
	// Check Display Order
	
	if(!$medalObj->select($_POST['medalorder'])) {
		$countErrors++;
		$dispError .= "&nbsp&nbsp;&nbsp;<b>&middot;</b> You selected an invalid display order. (medal)<br>";
	}
	elseif($_POST['medalorder'] == "first") {
		
		// Check if its actually the first medal
		
		$result = $mysqli->query("SELECT * FROM ".$dbprefix."medals ORDER BY ordernum");
		$num_rows = $result->num_rows;
		
		if($num_rows > 1) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid medal order. (medal)<br>";
		}
		
	}
	else {
		$medalOrderInfo = $medalObj->get_info();

		// Check before/after
		
		if($_POST['beforeafter'] != "before" AND $_POST['beforeafter'] != "after") {
			$countErrors++;
			$dispError .= "&nbsp&nbsp;&nbsp;<b>&middot;</b> You selected an invalid display order. (before/after)<br>";
		}
		else {
			
			$addTo = -1;
			if($_POST['beforeafter'] == "before") {
				$addTo = 1;
			}
			
			$intCheckOrderNum = $medalOrderInfo['ordernum']+$addTo;
			if($intCheckOrderNum != $medalInfo['ordernum']) {
				$intNewOrderNum = $medalObj->makeRoom($_POST['beforeafter']);
				$resortOrder = true;
			}
			
		}
		
		
	}
	
	
	
	if($_POST['autodays'] != "" AND (!is_numeric($_POST['autodays']) OR (is_numeric($_POST['autodays']) AND $_POST['autodays'] < 0))) {
		$countErrors++;
		$dispError .= "&nbsp&nbsp;&nbsp;<b>&middot;</b> Auto-days must be a positive number.<br>";
	}
	
	
	
	// Check if there are any errors and whether or not we need to upload a new image
	if($countErrors == 0 AND $_FILES['medalimagefile']['name'] != "") {
		// No Errors, try uploading image
		
		$uploadFile = new BTUpload($_FILES['medalimagefile'], "medal_", "../images/medals/", array(".jpg",".png",".gif",".bmp"));
		
		if(!$uploadFile->uploadFile()) {
			$countErrors++;
			$dispError .= "<b>&middot;</b> Unable to upload medal image file.  Please make sure the file extension is either .jpg, .png, .gif or .bmp<br>";
		}
		else {
			$medalImgURL = "images/medals/".$uploadFile->getUploadedFileName();
		}
			
		
		
	}
	elseif($countErrors == 0 AND $_FILES['medalimagefle']['name'] == "" AND trim($_POST['medalimageurl']) != "") {
		$medalImgURL = $_POST['medalimageurl'];
	}
	
	
	
	
	// Stil no errors? ---------> Update
	if($countErrors == 0) {
		
		
		$medalObj->select($medalInfo['medal_id']);
		
		$updateColumns = array("name", "description", "imagewidth", "imageheight", "autodays", "autorecruits");
		$updateValues = array($_POST['medalname'], $_POST['medaldesc'], $_POST['medalimagewidth'], $_POST['medalimageheight'], $_POST['autodays'], $_POST['autorecruits']);
		
		if($resortOrder) {

			$updateColumns[] = "ordernum";
			$updateValues[] = $intNewOrderNum;
		}
		
		if($medalImgURL != "") {

			$updateColumns[] = "imageurl";
			$updateValues[] = $medalImgURL;
		}
		
		
		
		
		if($medalObj->update($updateColumns, $updateValues)) {
			
			$newMedalInfo = $medalObj->get_info_filtered();
			
			echo "
				<div style='display: none' id='successBox'>
					<p align='center'>
						Successfully Edited Medal: <b>".$newMedalInfo['name']."</b>!
					</p>
				</div>
				
				<script type='text/javascript'>
					popupDialog('Edit Medal', '".$MAIN_ROOT."members/console.php?cID=".$cID."', 'successBox');
				</script>
			";
			
		}
		else {
			$_POST = filterArray($_POST);
			$_POST['submit'] = false;	
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to edit medal.  Please try again.<br>";
		}
		
	}
	else {
		$_POST = filterArray($_POST);
		$_POST['submit'] = false;
	}
	
	if($resortOrder) {
		$medalObj->resortOrder();	
	}
	
}

if(!$_POST['submit']) {
	
	
	
	$localImageURL = $medalObj->getLocalImageURL();
					
	if($medalInfo['imagewidth'] == 0 AND $localImageURL !== false) {
		$medalImageSize = getimagesize($prevFolder.$localImageURL);
	
		$medalInfo['imagewidth'] = $medalImageSize[0];
	}
	
	if($medalInfo['imageheight'] == 0 AND $localImageURL !== false) {
		$medalImageSize = getimagesize($prevFolder.$localImageURL);
	
		$medalInfo['imageheight'] = $medalImageSize[1];
	}
	
	
	
	$popupWidth = $medalInfo['imagewidth']+50;
	echo "
	<script type='text/javascript'>
	
		function showMedalImage() {
			
			$(document).ready(function() {
				$('#popupMedalImage').dialog({
					title: 'View Medal Image',
					modal: true,
					zIndex: 99999,
					width: ".$popupWidth.",
					resizable: false,
					show: \"fade\",
					buttons: {
						\"Ok\": function() {
							$(this).dialog(\"close\");
						}
					}
				});
			});
			$('.ui-dialog :button').blur();
		}
	
	</script>
	";
	
	$getMedals = $mysqli->query("SELECT * FROM ".$dbprefix."medals ORDER BY ordernum DESC");
	$medalOptions = "";
	$arrBeforeAfter = $medalObj->findBeforeAfter();
	
	$strAfterSelected = "";
	
	if($arrBeforeAfter[1] == "after") {
		$strAfterSelected = "selected";	
	}
	
	while($arrMedals = $getMedals->fetch_assoc()) {
		$strSelected = "";
		if($arrBeforeAfter[0] == $arrMedals['medal_id']) {
			$strSelected = "selected";	
		}
		
		
		$medalName = filterText($arrMedals['name']);
		$medalOptions .= "<option value='".$arrMedals['medal_id']."' ".$strSelected.">".$medalName."</option>";
		
	}
        
	$firstMedalOption = "";
	if($medalOptions == "") {
		$firstMedalOption = "<option value='first'>(first medal)</option>";
	}
	
	
	echo "
	<div style='display: none' id='popupMedalImage'><p align='center'><img src='".$MAIN_ROOT.$medalInfo['imageurl']."' width='".$medalInfo['imagewidth']."' height='".$medalInfo['imageheight']."'></div>
	<form action='console.php?cID=$cID&mID=".$medalInfo['medal_id']."&action=edit' method='post' enctype='multipart/form-data'>
		<div class='formDiv'>
		
	";
		
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to edit medal because the following errors occurred:</strong><br><br>
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
				<td class='main'><input type='text' name='medalname' value='".$medalInfo['name']."' class='textBox' style='width: 250px'></td>
			</tr>
			<tr>
				<td class='formLabel' valign='top'>Medal Image:</td>
				<td class='main'>
					<i>Current Image: <a href='javascript:void(0)' onclick='showMedalImage()'>View Medal Image</a></i><br>
					File:<br><input type='file' name='medalimagefile' class='textBox' style='width: 250px; border: 0px'><br>
					<span style='font-size: 10px'>File Types: .jpg, .gif, .png, .bmp | <a href='javascript:void(0)' onmouseover=\"showToolTip('The file size upload limit is controlled by your PHP settings in the php.ini file.')\" onmouseout='hideToolTip()'>File Size: ".ini_get("upload_max_filesize")."B or less</a></span>
					<p><b><i>OR</i></b></p>
					URL:<br><input type='text' name='medalimageurl' value='".$_POST['medalimageurl']."' class='textBox' style='width: 250px'>
				</td>
			</tr>
			<tr>
				<td class='formLabel'>Image Width: <a href='javascript:void(0)' onmouseover=\"showToolTip('Set the Image Width to the width that you would like the Medal Image to be displayed on your website.')\" onmouseout='hideToolTip()'>(?)</a></td>
				<td class='main'>
					<input type='text' name='medalimagewidth' value='".$medalInfo['imagewidth']."' class='textBox' style='width: 40px'> <i>px</i>
				</td>
			</tr>
			<tr>
				<td class='formLabel'>Image Height: <a href='javascript:void(0)' onmouseover=\"showToolTip('Set the Image Height to the height that you would like the Medal Image to be displayed on your website.')\" onmouseout='hideToolTip()'>(?)</a></td>
				<td class='main'>
					<input type='text' name='medalimageheight' value='".$medalInfo['imageheight']."' class='textBox' style='width: 40px'> <i>px</i>
				</td>
			</tr>
			<tr>
				<td class='formLabel' valign='top'>Description:</td>
				<td class='main'><textarea class='textBox' name='medaldesc' rows='5' cols='40'>".$medalInfo['description']."</textarea></td>
			</tr>
			<tr>
				<td class='formLabel' valign='top'>Display Order:</td>
				<td class='main'><select name='beforeafter' class='textBox'><option value='before'>Before</option><option value='after' ".$strAfterSelected.">After</option></select><br><select name='medalorder' class='textBox'>$firstMedalOption.$medalOptions</select></td>
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
				<td class='main'><input type='text' class='textBox' name='autodays' value='".$medalInfo['autodays']."' style='width: 40px'></td>
			</tr>
			<tr>
				<td class='formLabel'><div style='padding-left: 3px'>Auto-Recruits:</div></td>
				<td class='main'><input type='text' class='textBox' name='autodays' value='".$medalInfo['autorecruits']."' style='width: 40px'></td>
			</tr>
			<tr>
				<td colspan='2' align='center'><br>
					<input type='submit' name='submit' value='Edit Medal' class='submitButton' style='width: 100px'>
				</td>
			</tr>
			
		</table>
		</div>
	
	</form>

	
	";
	
	
}
?>