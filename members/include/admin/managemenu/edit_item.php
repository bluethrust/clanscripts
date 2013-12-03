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
	$memberInfo = $member->get_info();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}



$cID = $_GET['cID'];

include_once($prevFolder."classes/btupload.php");
include_once($prevFolder."classes/downloadcategory.php");

$dispError = "";
$countErrors = 0;
$menuCatInfo = $menuCatObj->get_info();

echo "

<script type='text/javascript'>
$(document).ready(function() {
$('#breadCrumb').html(\"<a href='".$MAIN_ROOT."'>Home</a> > <a href='".$MAIN_ROOT."members/index.php?select=".$consoleInfo['consolecategory_id']."'>My Account</a> > <a href='".$MAIN_ROOT."members/console.php?cID=".$cID."'>Manage Menu Items</a> > ".$menuItemInfo['name']."\");
});
</script>
";

$arrItemTypes = array("link"=>"Link", "image"=>"Image", "top-players"=>"Top Players", "login"=>"Default Login", "shoutbox"=>"Shoutbox", "forumurl"=>"Forum Link", "forumactivity"=>"Latest Forum Activity", "newestmembers"=>"Newest Members", "customcode"=>"Custom Block - Code Editor", "customformat"=>"Custom Block - WYSIWYG Editor", "custompage"=>"Custom Page", "customform"=>"Custom Form", "downloads"=>"Download Page");
$arrCheckAlign = array("left", "center", "right");

if($_POST['submit']) {
	
	$menuCode = "";
	$linkURL = "";
	$linkTarget = "";
	
	
	// Checks for Links
	if($menuItemInfo['itemtype'] == "link") {
	
		//Check Link URL
		if(trim($_POST['linkurl']) == "") {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You may not enter a blank link url.<br>";
		}
		else {
			$linkURL = $_POST['linkurl'];
		}
	
		// Check Link Target Window
		if($_POST['targetwindow'] != "" && $_POST['targetwindow'] != "_blank") {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid link target window.<br>";
		}
		else {
			$linkTarget = $_POST['targetwindow'];
		}
	
		// Check Align
	
		if(!in_array($_POST['linkalign'], $arrCheckAlign)) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid text align.<br>";
		}
	
	}
	
	// Checks for Images
	$blnUploadNewImage = false;
	if($menuItemInfo['itemtype'] == "image") {
	
		// Check Image
		if($_FILES['menuimagefile']['name'] != "") {
			$btUploadObj = new BTUpload($_FILES['menuimagefile'], "menuitem_", "../images/menu/", array(".jpg", ".png", ".bmp", ".gif"));
			$blnUploadNewImage = true;
		}
		elseif($_POST['menuimageurl'] != "") {
			$btUploadObj = new BTUpload($_POST['menuimageurl'], "menuitem_", "../images/menu/", array(".jpg", ".png", ".bmp", ".gif"), 4, true);
			$blnUploadNewImage = true;
		}
	
	
	
		$linkURL = $_POST['imagelinkurl'];
	
		// Check Link Target Window
		if($_POST['imagelinktargetwindow'] != "" && $_POST['imagelinktargetwindow'] != "_blank") {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid image link target window.<br>";
		}
		else {
			$linkTarget = $_POST['imagelinktargetwindow'];
		}
	
		// Check Align
	
		if(!in_array($_POST['imagealign'], $arrCheckAlign)) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid image align.<br>";
		}
	
		if(!is_numeric($_POST['imagewidth']) && trim($_POST['imagewidth']) != "") {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Image width must be a number.<br>";
		}
	
		if(!is_numeric($_POST['imageheight']) && trim($_POST['imageheight']) != "") {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Image height must be a number.<br>";
		}
	
		// Waiting for other checks before uploading image
	}
	
	// Check Shoutbox
	if($menuItemInfo['itemtype'] == "shoutbox") {
	
		// Check width
		if(!is_numeric($_POST['shoutboxwidth']) && trim($_POST['shoutboxwidth']) != "") {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Shoutbox width must be a number.<br>";
		}
	
		// Check height
		if(!is_numeric($_POST['shoutboxheight']) && trim($_POST['shoutboxheight']) != "") {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Shoutbox height must be a number.<br>";
		}
	
		// Check textbox
		if(!is_numeric($_POST['shoutboxtextbox']) && trim($_POST['shoutboxtextbox']) != "") {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Shoutbox textbox width must be a number.<br>";
		}
	
		if($_POST['shoutboxwidthpercent'] != "1") {
			$_POST['shoutboxwidthpercent'] = 0;
		}
	
		if($_POST['shoutboxheightpercent'] != "1") {
			$_POST['shoutboxheightpercent'] = 0;
		}
	
	}
	
	if($menuItemInfo['itemtype'] == "customform") {
		$customFormObj = new CustomForm($mysqli);
		if(!$customFormObj->select($_POST['customform'])) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid custom form page.<br>";
		}
	
		if($_POST['customformtargetwindow'] != "") {
			$linkTarget = "_blank";
		}
	
		// Check Align
	
		if(!in_array($_POST['customformalign'], $arrCheckAlign)) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid text align.<br>";
		}
	
	}
	
	
	
	if($menuItemInfo['itemtype'] == "custompage") {
		$customPageObj = new Basic($mysqli, "custompages", "custompage_id");
		if(!$customPageObj->select($_POST['custompage'])) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid custom page.<br>";
		}
	
		if($_POST['custompagetargetwindow'] != "") {
			$linkTarget = "_blank";
		}
	
		// Check Align
	
		if(!in_array($_POST['custompagealign'], $arrCheckAlign)) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid text align.<br>";
		}
	
	}
	
	if($menuItemInfo['itemtype'] == "customcode") {
		$menuCode = $_POST['custommenuinfo'];
	}
	
	if($menuItemInfo['itemtype'] == "customformat") {
		$menuCode = $_POST['wysiwygHTML'];
	}
	
	if($menuItemInfo['itemtype'] == "downloads") {
		$downloadCatObj = new DownloadCategory($mysqli);
		if(!$downloadCatObj->select($_POST['downloadpage'])) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid download page.<br>";
		}
	
		if($_POST['downloadpagetargetwindow'] != "") {
			$linkTarget = "_blank";
		}
	
		// Check Align
	
		if(!in_array($_POST['downloadpagealign'], $arrCheckAlign)) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid text align.<br>";
		}
	
	
	}
	
	
	// Standard Checks
	
	// Check Item Name
	if(trim($_POST['itemname']) == "") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You may not enter a blank item name.<br>";
	}
	
	// Check Menu Category
	if(!$menuCatObj->select($_POST['menucategory'])) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid menu category.<br>";
	}
	
	// Check Display Order
	
	$menuItemObj->setCategoryKeyValue($_POST['menucategory']);
	$intSortNum = $menuItemObj->validateOrder($_POST['displayorder'], $_POST['beforeafter'], true, $menuItemInfo['sortnum']);
	if($intSortNum === false) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid display order.<br>";
	}
	
	// Check Show when
	if($_POST['accesstype'] != "0" && $_POST['accesstype'] != "1" && $_POST['accesstype'] != "2") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid access type.<br>";
	}
	
	if($_POST['hideitem'] != "1") {
		$_POST['hideitem'] = 0;
	}
	
	
	

		
		if($blnUploadNewImage && $countErrors == 0 && $menuItemInfo['itemtype'] == "image" && $btUploadObj->uploadFile()) {
			$imageUploadURL = "images/menu/".$btUploadObj->getUploadedFileName();
			$menuItemObj->objImage->select($menuItemInfo['itemtype_id']);
			unlink($prevFolder.$menuItemObj->objImage->get_info("imageurl"));
		}
		elseif($blnUploadNewImage && $countErrors == 0 && $menuItemInfo['itemtype'] == "image") {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b>  Unable to upload selected image.  Make sure it's the correct file extension and not too big.<br>";
		}
		elseif(!$blnUploadNewImage) {
			$menuItemObj->objImage->select($menuItemInfo['itemtype_id']);
			$imageUploadURL = $menuItemObj->objImage->get_info("imageurl");
		}
	
	
	if($countErrors == 0) {
	
		$arrColumns = array("menucategory_id", "name", "accesstype", "hide", "sortnum");
		$arrValues = array($_POST['menucategory'], $_POST['itemname'], $_POST['accesstype'], $_POST['hideitem'], $intSortNum);
		
		$menuItemObj->select($menuItemInfo['menuitem_id']);
		
		if($menuItemObj->update($arrColumns, $arrValues)) {
	
			$menuItemInfo = $menuItemObj->get_info_filtered();
	
			switch($menuItemInfo['itemtype']) {
				case "link":
					$menuItemObj->objLink->select($menuItemInfo['itemtype_id']);
					$arrItemColumns = array("link", "linktarget", "prefix", "textalign");
					$arrItemValues = array($linkURL, $linkTarget, $_POST['linkprefix'], $_POST['linkalign']);
					$menuItemObj->objLink->update($arrItemColumns, $arrItemValues);
					break;
				case "image":
					$menuItemObj->objImage->select($menuItemInfo['itemtype_id']);
					$arrItemColumns = array("imageurl", "width", "height", "link", "linktarget", "imagealign");
					$arrItemValues = array($imageUploadURL, $_POST['imagewidth'], $_POST['imageheight'], $linkURL, $linkTarget, $_POST['imagealign']);
					$menuItemObj->objImage->update($arrItemColumns, $arrItemValues);
					break;
				case "shoutbox":
					$menuItemObj->objShoutbox->select($menuItemInfo['itemtype_id']);
					$arrItemColumns = array("width", "height", "percentwidth", "percentheight", "textboxwidth");
					$arrItemValues = arraY($_POST['shoutboxwidth'], $_POST['shoutboxheight'], $_POST['shoutboxwidthpercent'], $_POST['shoutboxheightpercent'], $_POST['shoutboxtextbox']);
					$menuItemObj->objShoutbox->update($arrItemColumns, $arrItemValues);
					break;
				case "customform":
					$menuItemObj->objCustomPage->select($menuItemInfo['itemtype_id']);
					$arrItemColumns = array("custompage_id", "prefix", "linktarget", "textalign");
					$arrItemValues = array($_POST['customform'], $_POST['customformprefix'], $linkTarget, $_POST['customformalign']);
					$menuItemObj->objCustomPage->update($arrItemColumns, $arrItemValues);
					break;
				case "custompage":
					$menuItemObj->objCustomPage->select($menuItemInfo['itemtype_id']);
					$arrItemColumns = array("custompage_id", "prefix", "linktarget", "textalign");
					$arrItemValues = array($_POST['custompage'], $_POST['custompageprefix'], $linkTarget, $_POST['custompagealign']);
					$menuItemObj->objCustomPage->update($arrItemColumns, $arrItemValues);
					break;
				case "customcode":
					$menuItemObj->objCustomBlock->select($menuItemInfo['itemtype_id']);
					$arrItemColumns = array("code");
					$arrItemValues = array($menuCode);
					$menuItemObj->objCustomBlock->update($arrItemColumns, $arrItemValues);
					break;
				case "customformat":
					$menuItemObj->objLink->select($menuItemInfo['itemtype_id']);
					$arrItemColumns = array("code");
					$arrItemValues = array($menuCode);
					$menuItemObj->objCustomBlock->update($arrItemColumns, $arrItemValues);
					break;
				case "downloads":
					$menuItemObj->objCustomPage->select($menuItemInfo['itemtype_id']);
					$arrItemColumns = array("custompage_id", "prefix", "linktarget", "textalign");
					$arrItemValues = array($_POST['downloadpage'], $_POST['downloadpageprefix'], $linkTarget, $_POST['downloadpagealign']);
					$menuItemObj->objCustomPage->update($arrItemColumns, $arrItemValues);
					break;
			}
	
	
			echo "
			<div style='display: none' id='successBox'>
			<p align='center'>
			Successfully Edited Menu Item: <b>".$menuItemInfo['name']."</b>!
			</p>
			</div>
	
			<script type='text/javascript'>
			popupDialog('Edit Menu Item', '".$MAIN_ROOT."members/console.php?cID=".$cID."', 'successBox');
			</script>
			";
	
		}
	
		$menuItemObj->resortOrder();
		
	}
	
	
	if($countErrors > 0) {
		$_POST = filterArray($_POST);
		$_POST['submit'] = false;
	}
	
	
}

if(!$_POST['submit']) {
	
	$menucatoptions = "";
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."menu_category ORDER BY sortnum");
	while($row = $result->fetch_assoc()) {
		
		$dispSelected = "";
		if($menuItemInfo['menucategory_id'] == $row['menucategory_id']) {
			$dispSelected = " selected";	
		}
		
		$menucatoptions .= "<option value='".$row['menucategory_id']."'".$dispSelected.">".$row['name']."</option>";
	}
	
	$afterSelected = "";
	$arrBeforeAfter = $menuItemObj->findBeforeAfter();
	if($arrBeforeAfter[1] == "after") {
		$afterSelected = " selected";	
	}
	
	$orderoptions = "";
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."menu_item WHERE menuitem_id != '".$menuItemInfo['menuitem_id']."' AND menucategory_id = '".$menuItemInfo['menucategory_id']."' ORDER BY sortnum");
	while($row = $result->fetch_assoc()) {
		$dispSelected = "";
		if($row['menuitem_id'] == $arrBeforeAfter[0]) {
			$dispSelected = " selected";
		}
		
		$orderoptions .= "<option value='".$row['menuitem_id']."'".$dispSelected.">".$row['name']."</option>";
	}
	
	if($orderoptions == "") {
		$orderoptions = "<option value='first'>(first item)</option>";	
	}
	
	$selectLoggedInOnly = "";
	$selectLoggedOutOnly = "";
	
	if($menuItemInfo['accesstype'] == 1) {
		$selectLoggedInOnly = " selected";	
	}
	elseif($menuItemInfo['accesstype'] == 2) {
		$selectLoggedOutOnly = " selected";
	}
	
	$dispHideChecked = "";
	if($menuItemInfo['hide'] == 1) {
		$dispHideChecked = " checked";	
	}
	
	$dispNote = "";
	if($menuItemInfo['itemtype'] == "image") {
		$dispNote = "<p class='main'><b><u>NOTE:</u></b> If you want to keep the same image, leave the image fields blank.  Uploading a new image will cause the previous image to be deleted.</p>";	
	}
	
	echo "
	<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."&menuID=".$_GET['menuID']."&action=edit' method='post' enctype='multipart/form-data'>
		<div class='formDiv'>
		";
	
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to edit menu item because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	
	echo "
			Use the form below to edit the selected menu item.".$dispNote."
			<table class='formTable'>
				<tr>
					<td class='main' colspan='2'>
						<b>General Information:</b>
						<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
					</td>
				</tr>
				<tr>
					<td class='formLabel'>Item Name:</td>
					<td class='main'><input type='text' name='itemname' value='".$menuItemInfo['name']."' class='textBox' style='width: 200px'></td>
				</tr>
				<tr>
					<td class='formLabel'>Menu Category:</td>
					<td class='main'><select name='menucategory' class='textBox' id='menuCats'>".$menucatoptions."</select></td>
				</tr>
				<tr>
					<td class='formLabel' valign='top'>Display Order:</td>
					<td class='main'>
						<select name='beforeafter' class='textBox'><option value='before'>Before</option><option value='after'".$afterSelected.">After</option></select><br>
						<select name='displayorder' id='displayOrder' class='textBox'>".$orderoptions."</select>
					</td>
				</tr>
				<tr>
					<td class='formLabel'>Item Type:</td>
					<td class='main'><b>".$arrItemTypes[$menuItemInfo['itemtype']]."</b></td>
				</tr>
				<tr>
					<td class='formLabel'>Show when:</td>
					<td class='main'><select name='accesstype' class='textBox'><option value='0'>Always</option><option value='1'".$selectLoggedInOnly.">Logged In</option><option value='2'".$selectLoggedOutOnly.">Logged Out</option></select></td>
				</tr>
				<tr>
					<td class='formLabel'>Hide:</td>
					<td class='main'><input type='checkbox' name='hideitem' value='1'".$dispHideChecked."></td>
				</tr>
				";
			
			$menuItemJS = "";
			switch($menuItemInfo['itemtype']) {
				case "link":
					$menuItemObj->objLink->select($menuItemInfo['itemtype_id']);
					$linkInfo = $menuItemObj->objLink->get_info();
					$selectTextAlign['left'] = "";
					$selectTextAlign['right'] = "";
					$selectTextAlign['center'] = "";
					$selectNewWindow = "";
					if($linkInfo['linktarget'] == "_blank") {
						$selectNewWindow = " selected";	
					}
					
					$selectTextAlign[$linkInfo['textalign']] = " selected";
					
					echo "
						<tr>
							<td class='main' colspan='2'><br>
								<b>Link Information:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
							</td>
						</tr>
						<tr>
							<td class='formLabel'>Link URL:</td>
							<td class='main'><input type='text' name='linkurl' value='".$linkInfo['link']."' class='textBox' style='width: 200px'></td>
						</tr>
						<tr>
							<td class='formLabel'>Target Window:</td>
							<td class='main'><select name='targetwindow' class='textBox'><option value=''>Same Window</option><option value='_blank'".$selectNewWindow.">New Window</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Text-align:</td>
							<td class='main'><select name='linkalign' class='textBox'><option value='left'>Left</option><option value='center'".$selectTextAlign['center'].">Center</option><option value='right'".$selectTextAlign['right'].">Right</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Prefix: <a href='javascript:void(0)' onmouseover=\"showToolTip('Text to display before the link, i.e. a bullet point or dash.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='linkprefix' value='".filterText($linkInfo['prefix'])."' class='textBox'></td>
						</tr>
					";
					break;
				case "image":
					
					$menuItemObj->objImage->select($menuItemInfo['itemtype_id']);
					$imageInfo = $menuItemObj->objImage->get_info();
					
					$dispNewWindowSelected = "";
					if($imageInfo['linktarget'] != "") {
						$dispNewWindowSelected = " selected";	
					}
					
					$arrSelectAlign['left'] = "";
					$arrSelectAlign['center'] = "";
					$arrSelectAlign['right'] = "";
					
					$arrSelectAlign[$imageInfo['imagealign']] = " selected";
					
					$checkURL = parse_url($imageInfo['imageurl']);
					$dispImgWidth = 400;
					$dispImgHeight = 200;
					if($checkURL['scheme'] == "") {
						$imageSize = getimagesize($prevFolder.$imageInfo['imageurl']);
						$imageInfo['imageurl'] = $MAIN_ROOT.$imageInfo['imageurl'];
						$dispImgWidth = $imageSize[0]+25;
						$dispImgHeight = $imageSize[1]+25;
					}
					
					if($imageInfo['width'] != 0) {
						$dispImgWidth = $imageInfo['width'];	
					}
					else {
						$imageInfo['width'] = "";	
					}
					
					if($imageInfo['height'] != 0) {
						$dispImgHeight = $imageInfo['height'];	
					}
					else {
						$imageInfo['height'] = "";	
					}
					
					echo "
						<div id='previewImageDiv' style='display: none'>
							<div style='margin-left: auto; margin-right: auto; width: ".$dispImgWidth."px; height: ".$dispImgHeight."px'>
								<p align='center'><img src='".$imageInfo['imageurl']."' style='max-width: 100%; max-height: 100%'></p>
							</div>
						</div>
					";
					
					echo "
					
						<tr>
							<td class='main' colspan='2'><br>
								<b>Image Information:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
							</td>
						</tr>
						<tr>
							<td class='formLabel' valign='top'>Image:</td>
							<td class='main'>
								File:<br><input type='file' name='menuimagefile' class='textBox' style='width: 250px; border: 0px'><br>
								<span style='font-size: 10px'>File Types: .jpg, .gif, .png, .bmp | <a href='javascript:void(0)' onmouseover=\"showToolTip('The file size upload limit is controlled by your PHP settings in the php.ini file.')\" onmouseout='hideToolTip()'>File Size: ".ini_get("upload_max_filesize")."B or less</a></span>
								<br>
								<i>Current Image: <a href='javascript:void()' id='previewImageLink'>View Image</a></i>
								<p><b><i>OR</i></b></p>
								URL:<br><input type='text' name='menuimageurl' class='textBox' style='width: 250px'>
							</td>
						</tr>
						<tr>
							<td class='formLabel'>Width: <a href='javascript:void(0)' onmouseover=\"showToolTip('Leave blank if you want to use the default image width.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='imagewidth' value='".$imageInfo['width']."' class='textBox' style='width: 40px'></td>
						</tr>
						<tr>
							<td class='formLabel'>Height: <a href='javascript:void(0)' onmouseover=\"showToolTip('Leave blank if you want to use the default image height.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='imageheight' value='".$imageInfo['height']."' class='textBox' style='width: 40px'></td>
						</tr>
						<tr>
							<td class='formLabel'>Link URL: <a href='javascript:void(0)' onmouseover=\"showToolTip('Leave blank if you don\'t want your image linking to anything.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='imagelinkurl' value='".$imageInfo['link']."' class='textBox' style='width: 200px'></td>
						</tr>
						<tr>
							<td class='formLabel'>Target Window:</td>
							<td class='main'><select name='imagelinktargetwindow' class='textBox'><option value=''>Same Window</option><option value='_blank'".$dispNewWindowSelected.">New Window</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Image Align:</td>
							<td class='main'><select name='imagealign' class='textBox'><option value='left'".$arrSelectAlign['left'].">Left</option><option value='center'".$arrSelectAlign['center'].">Center</option><option value='right'".$arrSelectAlign['right'].">Right</option></select></td>
						</tr>
					
					";
					
					$menuItemJS = "
					$('#previewImageLink').click(function() {
						$('#previewImageDiv').dialog({
							title: 'Edit Menu Item - Preview Image',
							modal: true,
							zIndex: 99999,
							show: 'scale',
							resizable: false,
							width: 400,
							buttons: {
								'OK': function() {
									$(this).dialog('close');
								}
							}					
						});
					});

					";
					
					break;
				case "custompage":
					$menuItemObj->objCustomPage->select($menuItemInfo['itemtype_id']);
					$customPageInfo = $menuItemObj->objCustomPage->get_info();
					
					$custompageoptions = "";
					$result = $mysqli->query("SELECT * FROM ".$dbprefix."custompages ORDER BY pagename");
					while($row = $result->fetch_assoc()) {
						$dispSelected = "";
						if($row['custompage_id'] == $customPageInfo['custompage_id']) {
							$dispSelected = " selected";
						}
						
						$custompageoptions .= "<option value='".$row['custompage_id']."'".$dispSelected.">".filterText($row['pagename'])."</option>";
					}
					
					if($result->num_rows == 0) {
						$custompageoptions = "<option value=''>None</option>";
					}
					
					$selectNewWindow = "";
					if($customPageInfo['linktarget'] != "") {
						$selectNewWindow = " selected";	
					}
					
					$arrSelectAlign['left'] = "";
					$arrSelectAlign['center'] = "";
					$arrSelectAlign['right'] = "";
					
					$arrSelectAlign[$customPageInfo['textalign']] = " selected";
					
					echo "
						<tr>
							<td class='main' colspan='2'>
								<b>Custom Page Options:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
							</td>
						</tr>
						<tr>
							<td class='formLabel'>Custom Page:</td>
							<td class='main'><select name='custompage' class='textBox'>".$custompageoptions."</select></td>
						</tr>
						<tr>
							<td class='formLabel'>Target Window:</td>
							<td class='main'><select name='custompagetargetwindow' class='textBox'><option value=''>Same Window</option><option value='_blank'".$selectNewWindow.">New Window</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Text-align:</td>
							<td class='main'><select name='custompagealign' class='textBox'><option value='left'>Left</option><option value='center'".$arrSelectAlign['center'].">Center</option><option value='right'".$arrSelectAlign['right'].">Right</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Prefix: <a href='javascript:void(0)' onmouseover=\"showToolTip('Text to display before the link, i.e. a bullet point or dash.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='custompageprefix' value='".filterText($customPageInfo['prefix'])."' class='textBox'></td>
						</tr>
					
					";
					
					break;
				case "downloads":
					$menuItemObj->objCustomPage->select($menuItemInfo['itemtype_id']);
					$customPageInfo = $menuItemObj->objCustomPage->get_info();
					
					$downloadpageoptions = "";
					$result = $mysqli->query("SELECT * FROM ".$dbprefix."downloadcategory ORDER BY ordernum DESC");
					while($row = $result->fetch_assoc()) {
						$dispSelected = "";
						if($row['downloadcategory_id'] == $customPageInfo['custompage_id']) {
							$dispSelected = " selected";
						}
					
						$downloadpageoptions .= "<option value='".$row['downloadcategory_id']."'".$dispSelected.">".filterText($row['name'])."</option>";
					}
					
					if($result->num_rows == 0) {
						$downloadpageoptions = "<option value=''>None</option>";
					}
					
					$selectNewWindow = "";
					if($customPageInfo['linktarget'] != "") {
						$selectNewWindow = " selected";
					}
					
					$arrSelectAlign['left'] = "";
					$arrSelectAlign['center'] = "";
					$arrSelectAlign['right'] = "";
					
					$arrSelectAlign[$customPageInfo['textalign']] = " selected";
					
					echo "
						<tr>
							<td class='main' colspan='2'>
								<b>Download Page Options:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
							</td>
						</tr>
						<tr>
							<td class='formLabel'>Download Page:</td>
							<td class='main'><select name='downloadpage' class='textBox'>".$downloadpageoptions."</select></td>
						</tr>
						<tr>
							<td class='formLabel'>Target Window:</td>
							<td class='main'><select name='downloadpagetargetwindow' class='textBox'><option value=''>Same Window</option><option value='_blank'".$selectNewWindow.">New Window</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Text-align:</td>
							<td class='main'><select name='downloadpagealign' class='textBox'><option value='left'>Left</option><option value='center'".$arrSelectAlign['center'].">Center</option><option value='right'".$arrSelectAlign['right'].">Right</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Prefix: <a href='javascript:void(0)' onmouseover=\"showToolTip('Text to display before the link, i.e. a bullet point or dash.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='downloadpageprefix' value='".filterText($customPageInfo['prefix'])."' class='textBox'></td>
						</tr>
					";
					
					break;
				case "customform":
					$menuItemObj->objCustomPage->select($menuItemInfo['itemtype_id']);
					$customPageInfo = $menuItemObj->objCustomPage->get_info();
					
					$custompageoptions = "";
					$result = $mysqli->query("SELECT * FROM ".$dbprefix."customform ORDER BY name");
					while($row = $result->fetch_assoc()) {
						$dispSelected = "";
						if($row['customform_id'] == $customPageInfo['custompage_id']) {
							$dispSelected = " selected";
						}
					
						$custompageoptions .= "<option value='".$row['customform_id']."'".$dispSelected.">".filterText($row['name'])."</option>";
					}
					
					if($result->num_rows == 0) {
						$custompageoptions = "<option value=''>None</option>";
					}
					
					$selectNewWindow = ($customPageInfo['linktarget'] != "") ? " selected" : "";

					
					$arrSelectAlign['left'] = "";
					$arrSelectAlign['center'] = "";
					$arrSelectAlign['right'] = "";
					
					$arrSelectAlign[$customPageInfo['textalign']] = " selected";
					echo "
					
						<tr>
							<td class='main' colspan='2'>
								<b>Custom Form Options:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
							</td>
						</tr>
						<tr>
							<td class='formLabel'>Custom Form:</td>
							<td class='main'><select name='customform' class='textBox'>".$custompageoptions."</select></td>
						</tr>
						<tr>
							<td class='formLabel'>Target Window:</td>
							<td class='main'><select name='customformtargetwindow' class='textBox'><option value=''>Same Window</option><option value='_blank'".$selectNewWindow.">New Window</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Text-align:</td>
							<td class='main'><select name='customformalign' class='textBox'><option value='left'>Left</option><option value='center'".$arrSelectAlign['center'].">Center</option><option value='right'".$arrSelectAlign['right'].">Right</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Prefix: <a href='javascript:void(0)' onmouseover=\"showToolTip('Text to display before the link, i.e. a bullet point or dash.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='customformprefix' value='".filterText($customPageInfo['prefix'])."' class='textBox'></td>
						</tr>
					
					";
					
					break;
				case "shoutbox":
					
					$menuItemObj->objShoutbox->select($menuItemInfo['itemtype_id']);
					$menuShoutboxInfo = $menuItemObj->objShoutbox->get_info();
					
					$menuShoutboxInfo['width'] = ($menuShoutboxInfo['width'] == 0) ? "" : $menuShoutboxInfo['width'];
					$menuShoutboxInfo['height'] = ($menuShoutboxInfo['height'] == 0) ? "" : $menuShoutboxInfo['height'];
					$menuShoutboxInfo['textboxwidth'] = ($menuShoutboxInfo['textboxwidth'] == 0) ? "" : $menuShoutboxInfo['textboxwidth'];
					
					$dispPixels = ($menuShoutboxInfo['percentwidth'] == 0) ? "pixels" : "percent";
					$selectPercentWidth = ($menuShoutboxInfo['percentwidth'] == 0) ? "" : " selected";
					$selectPercentHeight = ($menuShoutboxInfo['percentheight'] == 0) ? "" : " selected";
					
					echo "
					
						<tr>
							<td class='main' colspan='2'>
								<b>Shoutbox Information:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
								<div style='padding-left: 3px; margin-bottom: 10px'><b>NOTE:</b> Leave all fields blank to keep the theme's default settings.</div>
							</td>
						</tr>
						<tr>
							<td class='formLabel'>Width:</td>
							<td class='main'><input type='text' name='shoutboxwidth' value='".$menuShoutboxInfo['width']."' class='textBox' style='width: 40px'>&nbsp;&nbsp;&nbsp;<select name='shoutboxwidthpercent' class='textBox' id='shoutBoxWidthPercent'><option value='0'>pixels</option><option value='1'".$selectPercentWidth.">percent</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Height:</td>
							<td class='main'><input type='text' name='shoutboxheight' value='".$menuShoutboxInfo['height']."' class='textBox' style='width: 40px'>&nbsp;&nbsp;&nbsp;<select name='shoutboxheightpercent' class='textBox'><option value='0'>pixels</option><option value='1'".$selectPercentHeight.">percent</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Textbox Width:</td>
							<td class='main'><input type='text' name='textboxwidth' value='".$menuShoutboxInfo['textboxwidth']."' class='textBox' style='width: 40px'> <span id='shoutBoxTextBoxWidth'>pixels</span></td>
						</tr>
					
					
					";
					
					$menuItemJS = "
						$('#shoutBoxWidthPercent').change(function() {
						
							if($(this).val() == '0') {
								$('#shoutBoxTextBoxWidth').html('pixels');
							}
							else {
								$('#shoutBoxTextBoxWidth').html('percent');
							}
					
						});
					";
					
					break;
				case "customcode":
					$menuItemObj->objCustomBlock->select($menuItemInfo['itemtype_id']);
					$customBlockInfo = $menuItemObj->objCustomBlock->get_info_filtered();
					
					echo "
					
						<tr>
							<td class='main' colspan='2'>
								<b>Menu Item Code:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
							</td>
						</tr>
						<tr>
							<td class='main' colspan='2'>
								<div style='background-color: white; position: relative'><div id='customMenuEditor' class='codeEditor'>".$customBlockInfo['code']."</div></div>
								<textarea id='customMenuInfo' name='custommenuinfo' style='display: none'></textarea>
							</td>
						</tr>
					
					
					";
					
					
					$menuItemJS = "
					
					var customMenuEditor = ace.edit('customMenuEditor');
					customMenuEditor.getSession().setMode('ace/mode/php');
					customMenuEditor.setTheme('ace/theme/eclipse');
					customMenuEditor.setHighlightActiveLine(false);
					customMenuEditor.setShowPrintMargin(false);
					
					";
					
					
					break;
				case "customformat":
					$menuItemObj->objCustomBlock->select($menuItemInfo['itemtype_id']);
					$customBlockInfo = $menuItemObj->objCustomBlock->get_info();
					
					echo "
					
						<tr>
							<td class='main' colspan='2'>
								<b>Menu Item Information:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
							</td>
						</tr>
						<tr>
							<td class='main' align='center' colspan='2'>
								<textarea id='tinymceTextArea' name='wysiwygHTML' style='width: 80%' rows='15'>".$customBlockInfo['code']."</textarea>
							</td>
						</tr>
					
					";
					
					$menuItemJS = "
					
					$('#tinymceTextArea').tinymce({
			
						script_url: '".$MAIN_ROOT."js/tiny_mce/tiny_mce.js',
						theme: 'advanced',
						theme_advanced_buttons1: 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,|,bullist,numlist,|,link,unlink,image,code,|,forecolorpicker,fontselect,fontsizeselect',
						theme_advanced_resizing: true
				
					});
					
					";
					
					break;
				
			}
			
			
				echo "
				<tr>
					<td class='main' align='center' colspan='2'><br>
						<input type='button' id='btnFakeSubmit' class='submitButton' value='Save'>
						<input type='submit' name='submit' id='btnSubmit' style='display: none' value='submit'>
					</td>
				</tr>
			</table>
		</div>
		</form>
		
		<script type='text/javascript'>
			
			$(document).ready(function() {
			
				$('#menuCats').change(function() {
					$('#displayOrder').html(\"<option value''>Loading...</option>\");
					$.post('".$MAIN_ROOT."members/include/admin/managemenu/include/menuitemlist.php', { menuCatID: $('#menuCats').val(), itemID: '".$menuItemInfo['menuitem_id']."' }, function(data) {
						$('#displayOrder').html(data);
					});
				});
				
				
				$('#btnFakeSubmit').click(function() {
					";
				if($menuItemInfo['itemtype'] == "customcode") { echo "$('#customMenuInfo').val(customMenuEditor.getValue());"; }
				
					
				echo "
					$('#btnSubmit').click();				
				});
				
				
				".$menuItemJS."
				
			
			});
		
		</script>
	";
	
	
}

?>