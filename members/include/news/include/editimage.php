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
$consoleCatID = $consoleObj->get_info("consolecategory_id");
$imageSliderInfo = $imageSliderObj->get_info_filtered();

echo "

<script type='text/javascript'>
$(document).ready(function() {
$('#breadCrumb').html(\"<a href='".$MAIN_ROOT."'>Home</a> > <a href='".$MAIN_ROOT."members?select=".$consoleCatID."'>My Account</a> > <a href='".$MAIN_ROOT."members/console.php?cID=".$cID."'>Manage Home Page Images</a> > ".parseBBCode($imageSliderInfo['name'])."\");
});
</script>
";


if($_POST['submit']) {
	
	// Check Name
	if(trim($_POST['imagename']) == "") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You must give the image a name.<br>";
	}
	
	
	// Check Display Order
	
	$intNewOrderNum = $imageSliderObj->validateOrder($_POST['displayorder'], $_POST['beforeafter'], true, $imageSliderInfo['ordernum']);
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
	
	$blnNewImage = false;
	// Check Image
	if($_FILES['uploadimage']['name'] != "") {
		$btUploadObj = new BTUpload($_FILES['uploadimage'], "hpimage_", "../images/homepage/", array(".jpg", ".png", ".bmp", ".gif"));
	}
	elseif($_POST['imageurl'] != "") {
		$btUploadObj = new BTUpload($_POST['imageurl'], "hpimage_", "../images/homepage/", array(".jpg", ".png", ".bmp", ".gif"), 4, true);
	}
	
	// Check Show When
	$arrCheck = array(0, 1, 2);
	
	if(!in_array($_POST['membersonly'], $arrCheck)) {
		$countErrors++;
		$dispError = "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid Show When option.<br>";
	}
	
	// Make sure no errors before uploading image
	if($countErrors == 0 && ($_FILES['uploadimage']['name'] != "" || $_POST['imageurl'] != "") && $btUploadObj->uploadFile()) {
		$imageUploadURL = "images/homepage/".$btUploadObj->getUploadedFileName();
		$blnNewImage = true;
	}
	elseif($countErrors == 0 && ($_FILES['uploadimage']['name'] != "" || $_POST['imageurl'] != "")) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to upload image.  Please make sure the file extension is either .jpg, .png, .gif or .bmp<br>";
	}
	else {
		$imageUploadURL = $imageSliderInfo['imageurl'];	
	}
	
	if($countErrors == 0) {
		$imageSliderObj->select($imageSliderInfo['imageslider_id']);
		if($blnNewImage) {
			unlink($prevFolder.$imageSliderInfo['imageurl']);
		}
		
		$newWindow = ($_POST['linktarget'] == "") ? "" : "_blank";
		
	
		$arrColumns = array("name", "messagetitle", "message", "imageurl", "fillstretch", "ordernum", "link" , "linktarget", "membersonly");
		$arrValues = array($_POST['imagename'], $_POST['title'], $_POST['message'], $imageUploadURL, $_POST['displaytype'], $intNewOrderNum, $_POST['linkurl'], $newWindow, $_POST['membersonly']);
	
		if($imageSliderObj->update($arrColumns, $arrValues)) {

			$imageSliderInfo = $imageSliderObj->get_info_filtered();
	
			echo "
	
			<div style='display: none' id='successBox'>
			<p align='center'>
			Successfully Edited Home Page Image: <b>".$imageSliderInfo['name']."</b>!
			</p>
			</div>
	
			<script type='text/javascript'>
			popupDialog('Edit Home Page Image', '".$MAIN_ROOT."members', 'successBox');
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
	
	$imageSliderObj->resortOrder();
	
}


if(!$_POST['submit']) {
	
	$arrBeforeAfter = $imageSliderObj->findBeforeAfter();
	
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."imageslider WHERE imageslider_id != '".$imageSliderInfo['imageslider_id']."' ORDER BY ordernum DESC");
	while($row = $result->fetch_assoc()) {
	
		$dispSelected = ($arrBeforeAfter[0] == $row['imageslider_id']) ? " selected" : "";
		
		$displayoptions .= "<option value='".$row['imageslider_id']."'".$dispSelected.">".$row['name']."</option>";
	
	}
	
	$afterSelected = ($arrBeforeAfter[1] == "after") ? " selected" : "";
	
	if($result->num_rows == 0) {
	
		$displayoptions = "<option value='first'>(first image)</option>";
	
	}	
	
	$stretchSelected = ($imageSliderInfo['fillstretch'] == "stretch") ? " selected" : "";
	$newWindowSelected = ($imageSliderInfo['linktarget'] == "_blank") ? " selected" : "";
	
	$membersOnlySelected = "";
	$loggedOutSelected = "";
	if($imageSliderInfo['membersonly'] == 1) {
		$membersOnlySelected = " selected";	
	}
	elseif($imageSliderInfo['membersonly'] == 2) {
		$loggedOutSelected = " selected";	
	}
	
	$imageSize = getimagesize($prevFolder.$imageSliderInfo['imageurl']);
	$imageWidth = $imageSize[0];
	$imageHeight = $imageSize[1];
	
	if($imageWidth > 900 && ($imageWidth*.75) > 900) {
		$imageWidth = 900;
	}
	elseif($imageWidth > 900 && ($imageWidth*.75) <= 900) {
		$imageWidth = $imageWidth*.75;
	}
	$popupWidth = $imageWidth+50;
	echo "
	<script type='text/javascript'>
	
		function showPreviewImage() {
			
			$(document).ready(function() {
				$('#popupPreviewImage').dialog({
					title: 'View Image',
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
	<div style='display: none' id='popupPreviewImage'><p align='center'><img src='".$MAIN_ROOT.$imageSliderInfo['imageurl']."' width='".$imageWidth."' height='".$imageHeight."'></div>
	";
	
	echo "
	<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."&imgID=".$_GET['imgID']."&action=edit' method='post' enctype='multipart/form-data'>
		<div class='formDiv'>
			Use the form below to edit the selected image.
	";
	
	
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to edit the image because the following errors occurred:</strong><br><br>
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
					<td class='main'><input type='text' name='imagename' class='textBox' value='".$imageSliderInfo['name']."'></td>
				</tr>
				<tr>
					<td class='formLabel' valign='top'>Image:</td>
					<td class='main'>
						<i>Current Image: <a href='javascript:void(0)' onclick='showPreviewImage()'>View Image</a></i><br>
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
						<select name='beforeafter' class='textBox'><option value='before'>Before</option><option value='after'".$afterSelected.">After</option></select>
						<br>
						<select name='displayorder' class='textBox'>".$displayoptions."</select>
					</td>
				</tr>
				<tr>
					<td class='formLabel'>Display Style:</td>
					<td class='main'><select name='displaytype' class='textBox'><option value='fill'>Fill</option><option value='stretch'".$stretchSelected.">Stretch</option></select></td>
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
					<td class='main'><input type='text' id='imageTitle' value='".$imageSliderInfo['messagetitle']."' name='title' class='textBox' style='width: 200px'></td>
				</tr>
				<tr>
					<td class='formLabel' valign='top'>Message:</td>
					<td class='main'><textarea class='textBox' id='imageMessage' style='width: 200px; height: 45px' name='message'>".$imageSliderInfo['message']."</textarea></td>
				</tr>
				<tr>
					<td class='formLabel'>Link:</td>
					<td class='main'><input type='text' id='linkURL' value='".$imageSliderInfo['link']."' name='linkurl' class='textBox' style='width: 200px'></td>
				</tr>
				<tr>
					<td class='formLabel'>Link Target:</td>
					<td class='main'><select name='linktarget' class='textBox'><option value=''>Same Window</option><option value='_blank'".$newWindowSelected.">New Window</option></select></td>
				</tr>
				<tr>
					<td class='formLabel'>Show When:</td>
					<td class='main'><select name='membersonly' class='textBox'><option value='0'>Always</option><option value='1'".$membersOnlySelected.">Logged In</option><option value='2'".$loggedOutSelected.">Logged Out</option></select></td>
				</tr>
				<tr>
					<td class='main' align='center' colspan='2'><br><input type='submit' name='submit' id='btnSubmit' value='Save' class='submitButton'></td>
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


?>