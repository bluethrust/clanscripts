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

include_once("../classes/imageslider.php");
include_once("../classes/btupload.php");


$cID = $_GET['cID'];

$dispError = "";
$countErrors = 0;

$imageSliderObj = new ImageSlider($mysqli);

if($_POST['submit']) {
	
	// Check Name
	if(trim($_POST['imagename']) == "") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You must give the image a name.<br>";
	}
	
	
	// Check Display Order
	
	$intNewOrderNum = $imageSliderObj->validateOrder($_POST['displayorder'], $_POST['beforeafter']);
	if($intNewOrderNum === false) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invaild display order.<br>";
	}
	
	// Check Display Style
	$arrDisplayStyle = array("fill", "stretch");
	
	if(!in_array($_POST['displaytype'], $arrDisplayStyle)) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invaild display style.<br>";
	}
	
	
	// Check Image
	if($_FILES['uploadimage']['name'] != "") {
		$btUploadObj = new BTUpload($_FILES['uploadimage'], "hpimage_", "../images/homepage/", array(".jpg", ".png", ".bmp", ".gif"));
	}
	elseif($_POST['imageurl'] != "") {
		$btUploadObj = new BTUpload($_POST['imageurl'], "hpimage_", "../images/homepage/", array(".jpg", ".png", ".bmp", ".gif"), 4, true);
	}
	else {
		$countErrors++;
		$dispError = "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You must upload an image to display.<br>";	
	}
	
	// Check Show When
	$arrCheck = array(0, 1, 2);
	
	if(!in_array($_POST['membersonly'], $arrCheck)) {
		$countErrors++;
		$dispError = "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid Show When option.<br>";
	}
	
	
	// Make sure no errors before uploading image
	if($countErrors == 0 && $btUploadObj->uploadFile()) {
		$imageUploadURL = "images/homepage/".$btUploadObj->getUploadedFileName();		
	}
	elseif($countErrors == 0) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to upload image.  Please make sure the file extension is either .jpg, .png, .gif or .bmp<br>";
	}
	
	
	
	if($countErrors == 0) {
		
		$newWindow = ($_POST['linktarget'] == "") ? "" : "_blank";
		
		$arrColumns = array("name", "messagetitle", "message", "imageurl", "fillstretch", "ordernum", "link" , "linktarget", "membersonly");
		$arrValues = array($_POST['imagename'], $_POST['title'], $_POST['message'], $imageUploadURL, $_POST['displaytype'], $intNewOrderNum, $_POST['linkurl'], $newWindow, $_POST['membersonly']);
		
		if($imageSliderObj->addNew($arrColumns, $arrValues)) {
			
			$imageSliderInfo = $imageSliderObj->get_info_filtered();
			
			echo "
			
				<div style='display: none' id='successBox'>
					<p align='center'>
						Successfully Added New Home Page Image: <b>".$imageSliderInfo['name']."</b>!
					</p>
				</div>
				
				<script type='text/javascript'>
					popupDialog('Add Home Page Image', '".$MAIN_ROOT."members', 'successBox');
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
	
	
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."imageslider ORDER BY ordernum DESC");
	while($row = $result->fetch_assoc()) {
	
		$displayoptions .= "<option value='".$row['imageslider_id']."'>".$row['name']."</option>";
	
	}
	
	if($result->num_rows == 0) {
	
		$displayoptions = "<option value='first'>(first image)</option>";
	
	}
	
	echo "
		<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."' method='post' enctype='multipart/form-data'>
			<div class='formDiv'>
				Use the form below to add an image to the home page image slider.<br>
		";
	
	
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to add the image because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	
	echo "
				<table class='formTable'>
					<tr>
						<td class='dottedLine main' colspan='2'>
							<b>Image Information:</b>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Name: <a href='javascript:void(0)' onmouseover=\"showToolTip('This will only be used to identify the image when managing home page images.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'><input type='text' name='imagename' class='textBox' value='".$_POST['imagename']."'></td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Image:</td>
						<td class='main'>
							File:<br>
							<input type='file' name='uploadimage' class='textBox' style='width: 200px; border: 0px'><br>
							<span style='font-size: 10px'>File Types: .jpg, .gif, .png, .bmp | <a href='javascript:void(0)' onmouseover=\"showToolTip('The file size upload limit is controlled by your PHP settings in the php.ini file.')\" onmouseout='hideToolTip()'>File Size: ".ini_get("upload_max_filesize")."B or less</a></span>
							<br><br><span style='font-style: italic'>OR</span><br><br>
							URL:<br>
							<input type='text' name='imageurl' class='textBox' style='width: 200px'>
						</td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Display Order:</td>
						<td class='main'>
							<select name='beforeafter' class='textBox'><option value='before'>Before</option><option value='after'>After</option></select>
							<br>
							<select name='displayorder' class='textBox'>".$displayoptions."</select>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Display Style:</td>
						<td class='main'><select name='displaytype' class='textBox'><option value='fill'>Fill</option><option value='stretch'>Stretch</option></select></td>
					</tr>
					<tr>
						<td class='main' colspan='2'><br><br>
							<div class='dottedLine' style='padding-bottom: 2px'><b>Message Information:</b></div>
							Leave this section blank to just display the image.<br><br>
						</td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Auto-fill:</td>
						<td class='main'>
							<select id='autofill' class='textBox'>
								<option value=''>Select</option>
								<option value='news'>News Post</option>
								<option value='tournament'>Tournament</option>
								<option value='event'>Event</option>
								<option value=''>Custom</option>
							</select><br><br>
							<select id='autofillID' class='textBox' disabled='disabled'>
								<option value=''>Select</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Title:</td>
						<td class='main'><input type='text' id='imageTitle' value='".$_POST['title']."' name='title' class='textBox' style='width: 200px'></td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Message:</td>
						<td class='main'><textarea class='textBox' id='imageMessage' style='width: 200px; height: 45px' name='message'>".$_POST['message']."</textarea></td>
					</tr>
					<tr>
						<td class='formLabel'>Link:</td>
						<td class='main'><input type='text' id='linkURL' value='".$_POST['linkurl']."' name='linkurl' class='textBox' style='width: 200px'></td>
					</tr>
					<tr>
						<td class='formLabel'>Link Target:</td>
						<td class='main'><select name='linktarget' class='textBox'><option value=''>Same Window</option><option value='_blank'>New Window</option></select></td>
					</tr>
					<tr>
						<td class='formLabel'>Show When:</td>
						<td class='main'><select name='membersonly' class='textBox'><option value='0'>Always</option><option value='1'>Logged In</option><option value='2'>Logged Out</option></select></td>
					</tr>
					<tr>
						<td class='main' align='center' colspan='2'><br><input type='submit' name='submit' id='btnSubmit' value='Add Image' class='submitButton'></td>
					</tr>
				</table>
			</div>
		</form>
		<div id='autoFillInfo' style='display: none'></div>
		<script type='text/javascript'>
		
			$(document).ready(function() {
			
				$('#autofill').change(function() {
				
					if($('#autofill').val() != '') {
						$('#autofillID').removeAttr('disabled');
						
						$.post('".$MAIN_ROOT."members/include/news/include/imageslider_getattachtype.php', { attachtype: $('#autofill').val() }, function(data) {
							$('#autofillID').html(data);
						});
						
					}
					else {
						$('#autofillID').html(\"<option value=''>Select</option>\");
						$('#autofillID').attr('disabled', 'disabled');
					}
				
				});
				
				
				$('#autofillID').change(function() {
				
					if($('#autofill').val() != '' && $('#autofillID').val() != '') {
					
					
						$.post('".$MAIN_ROOT."members/include/news/include/imageslider_getattachinfo.php', { attachtype: $('#autofill').val(), attachID: $('#autofillID').val() }, function(data) {
						
							$('#autoFillInfo').html(data);
						
						});
					
					
					}
				
				});
			
			});
		
		</script>
				
	";
	
	
	
}