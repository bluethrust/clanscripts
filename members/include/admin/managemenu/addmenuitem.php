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
include_once($prevFolder."classes/customform.php");

$menuCatObj = new MenuCategory($mysqli);
$menuItemObj = new MenuItem($mysqli);


$dispError = "";
$countErrors = 0;

if($_POST['submit']) {
	
	$arrItemTypes = array("link", "image", "top-players", "login", "shoutbox", "forumurl", "forumactivity", "newestmembers", "customcode", "customformat", "custompage", "customform");
	$arrCheckAlign = array("left", "center", "right");
	
	$menuCode = "";
	$linkURL = "";
	$linkTarget = "";
	

	// Checks for Links
	if($_POST['itemtype'] == "link") {
		
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
	if($_POST['itemtype'] == "image") {
		
		// Check Image
		if($_FILES['menuimagefile']['name'] != "") {
			$btUploadObj = new BTUpload($_FILES['menuimagefile'], "menuitem_", "../images/menu/", array(".jpg", ".png", ".bmp", ".gif"));
		}
		else {
			$btUploadObj = new BTUpload($_POST['menuimageurl'], "menuitem_", "../images/menu/", array(".jpg", ".png", ".bmp", ".gif"), 4, true);
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
	if($_POST['itemtype'] == "shoutbox") {

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
	
	if($_POST['itemtype'] == "customform") {
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
	
	
	
	if($_POST['itemtype'] == "custompage") {
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
	
	if($_POST['itemtype'] == "customcode") {
		$menuCode = $_POST['custommenuinfo'];	
	}
	
	if($_POST['itemtype'] == "customformat") {
		$menuCode = $_POST['wysiwygHTML'];	
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
	$intSortNum = $menuItemObj->validateOrder($_POST['displayorder'], $_POST['beforeafter']);
	if($intSortNum === false) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid display order.<br>";
	}
	
	// Check Item Type
	if(!in_array($_POST['itemtype'], $arrItemTypes)) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid item type.<br>";
	}
	
	// Check Show when
	if($_POST['accesstype'] != "0" && $_POST['accesstype'] != "1" && $_POST['accesstype'] != "2") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid access type.<br>";
	}
	
	if($_POST['hideitem'] != "1") {
		$_POST['hideitem'] = 0;	
	}

	if($countErrors == 0 && $_POST['itemtype'] == "image" && $btUploadObj->uploadFile()) {
		$imageUploadURL = "images/menu/".$btUploadObj->getUploadedFileName();
	}
	elseif($countErrors == 0 && $_POST['itemtype'] == "image") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b>  Unable to upload selected image.  Make sure it's the correct file extension and not too big.<br>";
	}
	
	
	if($countErrors == 0) {

		$arrColumns = array("menucategory_id", "name", "itemtype", "accesstype", "hide", "sortnum");
		$arrValues = array($_POST['menucategory'], $_POST['itemname'], $_POST['itemtype'], $_POST['accesstype'], $_POST['hideitem'], $intSortNum);
		
		if($menuItemObj->addNew($arrColumns, $arrValues)) {
						
			$menuItemInfo = $menuItemObj->get_info_filtered();
			
			switch($_POST['itemtype']) {
				case "link":
					$arrItemColumns = array("menuitem_id", "link", "linktarget", "prefix", "textalign");
					$arrItemValues = array($menuItemInfo['menuitem_id'], $linkURL, $linkTarget, $_POST['linkprefix'], $_POST['linkalign']);
					$menuItemObj->objLink->addNew($arrItemColumns, $arrItemValues);
					$menuItemObj->update(array("itemtype_id"), array($menuItemObj->objLink->get_info("menulink_id")));
					break;
				case "image":
					$arrItemColumns = array("menuitem_id", "imageurl", "width", "height", "link", "linktarget", "imagealign");
					$arrItemValues = array($menuItemInfo['menuitem_id'], $imageUploadURL, $_POST['imagewidth'], $_POST['imageheight'], $linkURL, $linkTarget, $_POST['imagealign']);
					$menuItemObj->objImage->addNew($arrItemColumns, $arrItemValues);
					$menuItemObj->update(array("itemtype_id"), array($menuItemObj->objImage->get_info("menuimage_id")));
					break;
				case "shoutbox":
					$arrItemColumns = array("menuitem_id", "width", "height", "percentwidth", "percentheight", "textboxwidth");
					$arrItemValues = arraY($menuItemInfo['menuitem_id'], $_POST['shoutboxwidth'], $_POST['shoutboxheight'], $_POST['shoutboxwidthpercent'], $_POST['shoutboxheightpercent'], $_POST['shoutboxtextbox']);
					$menuItemObj->objShoutbox->addNew($arrItemColumns, $arrItemValues);
					$menuItemObj->update(array("itemtype_id"), array($menuItemObj->objShoutbox->get_info("menushoutbox_id")));
					break;
				case "customform":
					$arrItemColumns = array("menuitem_id", "custompage_id", "prefix", "linktarget", "textalign");
					$arrItemValues = array($menuItemInfo['menuitem_id'], $_POST['customform'], $_POST['customformprefix'], $linkTarget, $_POST['customformalign']);
					$menuItemObj->objCustomPage->addNew($arrItemColumns, $arrItemValues);
					$menuItemObj->update(array("itemtype_id"), array($menuItemObj->objCustomPage->get_info("menucustompage_id")));
					break;
				case "custompage":
					$arrItemColumns = array("menuitem_id", "custompage_id", "prefix", "linktarget", "textalign");
					$arrItemValues = array($menuItemInfo['menuitem_id'], $_POST['custompage'], $_POST['custompageprefix'], $linkTarget, $_POST['custompagealign']);
					$menuItemObj->objCustomPage->addNew($arrItemColumns, $arrItemValues);
					$menuItemObj->update(array("itemtype_id"), array($menuItemObj->objCustomPage->get_info("menucustompage_id")));
					break;
				case "customcode":
					$arrItemColumns = array("menuitem_id", "blocktype", "code");
					$arrItemValues = array($menuItemInfo['menuitem_id'], "code", $menuCode);
					$menuItemObj->objCustomBlock->addNew($arrItemColumns, $arrItemValues);
					$menuItemObj->update(array("itemtype_id"), array($menuItemObj->objCustomBlock->get_info("menucustomblock_id")));
					break;
				case "customformat":
					$arrItemColumns = array("menuitem_id", "blocktype", "code");
					$arrItemValues = array($menuItemInfo['menuitem_id'], "format", $menuCode);
					$menuItemObj->objCustomBlock->addNew($arrItemColumns, $arrItemValues);
					$menuItemObj->update(array("itemtype_id"), array($menuItemObj->objCustomBlock->get_info("menucustomblock_id")));
					break;
			}
			
			
			echo "
				<div style='display: none' id='successBox'>
					<p align='center'>
						Successfully Added New Menu Item: <b>".$menuItemInfo['name']."</b>!
					</p>
				</div>
				
				<script type='text/javascript'>
					popupDialog('Add New Menu Item', '".$MAIN_ROOT."members', 'successBox');
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
	
	$menucatoptions = "";
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."menu_category ORDER BY sortnum");
	while($row = $result->fetch_assoc()) {
		
		$dispSelected = "";
		if(isset($_GET['mcID']) && $_GET['mcID'] == $row['menucategory_id']) {
			$dispSelected = " selected";	
		}
		
		$menucatoptions .= "<option value='".$row['menucategory_id']."'".$dispSelected.">".$row['name']."</option>";	
	}	
	
	if($result->num_rows == 0) {
		echo "
		<div style='display: none' id='errorBox'>
			<p align='center'>
				You must add a menu category before adding any items!
			</p>
		</div>
		
		<script type='text/javascript'>
			popupDialog('Add New Menu Item', '".$MAIN_ROOT."members', 'errorBox');
		</script>
		";
		
		exit();
	}
	
	
	$customformoptions = "";
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."customform ORDER BY name");
	while($row = $result->fetch_assoc()) {
		$customformoptions .= "<option value='".$row['customform_id']."'>".filterText($row['name'])."</option>";	
	}
	
	if($result->num_rows == 0) {
		$customformoptions = "<option value=''>None</option>";	
	}
	
	$custompageoptions = "";
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."custompages ORDER BY pagename");
	while($row = $result->fetch_assoc()) {
		$custompageoptions .= "<option value='".$row['custompage_id']."'>".filterText($row['pagename'])."</option>";
	}
	
	if($result->num_rows == 0) {
		$custompageoptions = "<option value=''>None</option>";
	}
	
	
	echo "
		<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."' method='post' enctype='multipart/form-data'>
			<div class='formDiv'>

			";
	
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to add new menu item because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	echo "
				Use the form below to add a menu item.
				<table class='formTable'>
					<tr>
						<td class='main' colspan='2'>
							<b>General Information:</b>
							<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Item Name:</td>
						<td class='main'><input type='text' name='itemname' class='textBox' value='".$_POST['itemname']."' style='width: 200px'></td>
					</tr>
					<tr>
						<td class='formLabel'>Menu Category:</td>
						<td class='main'>
							<select name='menucategory' id='menuCats' class='textBox'>".$menucatoptions."</select>
						</td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Display Order:</td>
						<td class='main'>
							<select name='beforeafter' class='textBox'><option value='before'>Before</option><option value='after'>After</option></select><br>
							<select name='displayorder' id='displayOrder' class='textBox'></select>					
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Item Type:</td>
						<td class='main'>
							<select name='itemtype' id='itemType' class='textBox'>
								<option value='link'>Link</option>
								<option value='image'>Image</option>
								<option value='custompage'>Custom Page</option>
								<option value='customform'>Custom Form Page</option>
								<option value='top-players'>Top Players</option>
								<option value='shoutbox'>Shoutbox</option>
								<option value='forumactivity'>Latest Forum Activity</option>
								<option value='newestmembers'>Newest Members</option>
								<option value='login'>Default Login</option>
								<option value='customcode'>Custom Block - Code Editor</option>
								<option value='customformat'>Custom Block - WYSIWYG Editor</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Show when:</td>
						<td class='main'>
							<select name='accesstype' class='textBox'><option value='0'>Always</option><option value='1'>Logged In</option><option value='2'>Logged Out</option></select>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Hide:</td>
						<td class='main'><input type='checkbox' name='hideitem' value='1'></td>
					</tr>
				</table>
				
				<div id='linkOptions'>
					<table class='formTable'>
						<tr>
							<td class='main' colspan='2'>
								<b>Link Information:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
							</td>
						</tr>
						<tr>
							<td class='formLabel'>Link URL:</td>
							<td class='main'><input type='text' name='linkurl' value='".$_POST['linkurl']."' class='textBox' style='width: 200px'></td>
						</tr>
						<tr>
							<td class='formLabel'>Target Window:</td>
							<td class='main'><select name='targetwindow' class='textBox'><option value=''>Same Window</option><option value='_blank'>New Window</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Text-align:</td>
							<td class='main'><select name='linkalign' class='textBox'><option value='left'>Left</option><option value='center'>Center</option><option value='right'>Right</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Prefix: <a href='javascript:void(0)' onmouseover=\"showToolTip('Text to display before the link, i.e. a bullet point or dash.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='linkprefix' value='".$_POST['linkprefix']."' class='textBox'></td>
						</tr>
					</table>
				</div>
				
				
				<div id='customFormOptions' style='display: none'>
					<table class='formTable'>
						<tr>
							<td class='main' colspan='2'>
								<b>Custom Form Options:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
							</td>
						</tr>
						<tr>
							<td class='formLabel'>Custom Form:</td>
							<td class='main'><select name='customform' class='textBox'>".$customformoptions."</select></td>
						</tr>
						<tr>
							<td class='formLabel'>Target Window:</td>
							<td class='main'><select name='customformtargetwindow' class='textBox'><option value=''>Same Window</option><option value='_blank'>New Window</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Text-align:</td>
							<td class='main'><select name='customformalign' class='textBox'><option value='left'>Left</option><option value='center'>Center</option><option value='right'>Right</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Prefix: <a href='javascript:void(0)' onmouseover=\"showToolTip('Text to display before the link, i.e. a bullet point or dash.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='customformprefix' value='".$_POST['customformprefix']."' class='textBox'></td>
						</tr>
					</table>
				</div>
				
				
				
				
				<div id='customPageOptions' style='display: none'>
					<table class='formTable'>
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
							<td class='main'><select name='custompagetargetwindow' class='textBox'><option value=''>Same Window</option><option value='_blank'>New Window</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Text-align:</td>
							<td class='main'><select name='custompagealign' class='textBox'><option value='left'>Left</option><option value='center'>Center</option><option value='right'>Right</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Prefix: <a href='javascript:void(0)' onmouseover=\"showToolTip('Text to display before the link, i.e. a bullet point or dash.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='custompageprefix' value='".$_POST['custompageprefix']."' class='textBox'></td>
						</tr>
					</table>
				</div>
				
				<div id='shoutBoxOptions' style='display: none'>
					<table class='formTable'>
						<tr>
							<td class='main' colspan='2'>
								<b>Shoutbox Information:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
								<div style='padding-left: 3px; margin-bottom: 10px'><b>NOTE:</b> Leave all fields blank to keep the theme's default settings.</div>
							</td>
						</tr>
						<tr>
							<td class='formLabel'>Width:</td>
							<td class='main'><input type='text' name='shoutboxwidth' value='".$_POST['shoutboxwidth']."' class='textBox' style='width: 40px'>&nbsp;&nbsp;&nbsp;<select name='shoutboxwidthpercent' class='textBox' id='shoutBoxWidthPercent'><option value='0'>pixels</option><option value='1'>percent</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Height:</td>
							<td class='main'><input type='text' name='shoutboxheight' value='".$_POST['shoutboxheight']."' class='textBox' style='width: 40px'>&nbsp;&nbsp;&nbsp;<select name='shoutboxheightpercent' class='textBox'><option value='0'>pixels</option><option value='1'>percent</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Textbox Width:</td>
							<td class='main'><input type='text' name='textboxwidth' value='".$_POST['textboxwidth']."' class='textBox' style='width: 40px'> <span id='shoutBoxTextBoxWidth'>pixels</span></td>
						</tr>
					</table>
				</div>
				
				<div id='imageOptions' style='display: none'>
					<table class='formTable'>
						<tr>
							<td class='main' colspan='2'>
								<b>Image Information:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
							</td>
						</tr>
						<tr>
							<td class='formLabel' valign='top'>Image:</td>
							<td class='main'>
								File:<br><input type='file' name='menuimagefile' class='textBox' style='width: 250px; border: 0px'><br>
								<span style='font-size: 10px'>File Types: .jpg, .gif, .png, .bmp | <a href='javascript:void(0)' onmouseover=\"showToolTip('The file size upload limit is controlled by your PHP settings in the php.ini file.')\" onmouseout='hideToolTip()'>File Size: ".ini_get("upload_max_filesize")."B or less</a></span>
								<p><b><i>OR</i></b></p>
								URL:<br><input type='text' name='menuimageurl' value='".$_POST['menuimageurl']."' class='textBox' style='width: 250px'>
							</td>
						</tr>
						<tr>
							<td class='formLabel'>Width: <a href='javascript:void(0)' onmouseover=\"showToolTip('Leave blank if you want to use the default image width.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='imagewidth' value='".$_POST['imagewidth']."' class='textBox' style='width: 40px'></td>
						</tr>
						<tr>
							<td class='formLabel'>Height: <a href='javascript:void(0)' onmouseover=\"showToolTip('Leave blank if you want to use the default image height.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='imageheight' value='".$_POST['imageheight']."' class='textBox' style='width: 40px'></td>
						</tr>
						<tr>
							<td class='formLabel'>Link URL: <a href='javascript:void(0)' onmouseover=\"showToolTip('Leave blank if you don\'t want your image linking to anything.')\" onmouseout='hideToolTip()'>(?)</a></td>
							<td class='main'><input type='text' name='imagelinkurl' value='".$_POST['imagelinkurl']."' class='textBox' style='width: 200px'></td>
						</tr>
						<tr>
							<td class='formLabel'>Target Window:</td>
							<td class='main'><select name='imagelinktargetwindow' class='textBox'><option value=''>Same Window</option><option value='_blank'>New Window</option></select></td>
						</tr>
						<tr>
							<td class='formLabel'>Image Align:</td>
							<td class='main'><select name='imagealign' class='textBox'><option value='left'>Left</option><option value='center'>Center</option><option value='right'>Right</option></select></td>
						</tr>
					</table>
				</div>
				
				<div id='customCodeOptions' style='display: none'>
					<table class='formTable'>
						<tr>
							<td class='main'>
								<b>Menu Item Code:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
							</td>
						</tr>
						<tr>
							<td class='main'>
								<div style='background-color: white; position: relative'><div id='customMenuEditor' class='codeEditor'>".$_POST['custommenuinfo']."</div></div>
								<textarea id='customMenuInfo' name='custommenuinfo' style='display: none'></textarea>
							</td>
						</tr>
					</table>
				</div>
				
				
				<div id='customFormatOptions' style='display: none'>
					<table class='formTable'>
						<tr>
							<td class='main'>
								<b>Menu Item Information:</b>
								<div class='dottedLine' style='width: 100%; margin-bottom: 5px'></div>
							</td>
						</tr>
						<tr>
							<td class='main' align='center'>
								<textarea id='tinymceTextArea' name='wysiwygHTML' style='width: 80%' rows='15'>".$_POST['wysiwygHTML']."</textarea>
							</td>
						</tr>
					</table>
				</div>
				
				<p align='center' style='margin-top: 50px'>
					<input type='button' id='btnFakeSubmit' value='Add Menu Item' class='submitButton'>
					<input type='submit' name='submit' value='submit' id='btnSubmit' style='display: none'>
				</p>
				
			</div>
		</form>
		
		<script type='text/javascript'>
		
			var customMenuEditor = ace.edit('customMenuEditor');
			customMenuEditor.getSession().setMode('ace/mode/php');
			customMenuEditor.setTheme('ace/theme/eclipse');
			customMenuEditor.setHighlightActiveLine(false);
			customMenuEditor.setShowPrintMargin(false);
		
			$(document).ready(function() {
					
				$('#menuCats').change(function() {
					$('#displayOrder').html(\"<option value''>Loading...</option>\");
					$.post('".$MAIN_ROOT."members/include/admin/managemenu/include/menuitemlist.php', { menuCatID: $('#menuCats').val() }, function(data) {
						$('#displayOrder').html(data);
					});
				});
				
				
				$('#itemType').change(function() {
					
					$('#linkOptions').hide();
					$('#imageOptions').hide();
					$('#shoutBoxOptions').hide();
					$('#customPageOptions').hide();
					$('#customFormOptions').hide();
					$('#customCodeOptions').hide();
					$('#customFormatOptions').hide();
					
				
					if($(this).val() == 'link') {
						$('#linkOptions').show();
					}
					else if($(this).val() == 'image') {
						$('#imageOptions').show();
					}
					else if($(this).val() == 'customcode') {
						$('#customCodeOptions').show();
					}
					else if($(this).val() == 'shoutbox') {
						$('#shoutBoxOptions').show();
					}
					else if($(this).val() == 'customform') {
						$('#customFormOptions').show();
					}
					else if($(this).val() == 'custompage') {
						$('#customPageOptions').show();
					}
					else if($(this).val() == 'customformat') {
						$('#customFormatOptions').show();
					}
					
				});
				
				$('#btnFakeSubmit').click(function() {
					$('#customMenuInfo').val(customMenuEditor.getValue());
					$('#btnSubmit').click();				
				});
				
				
				$('#shoutBoxWidthPercent').change(function() {
					
					if($(this).val() == '0') {
						$('#shoutBoxTextBoxWidth').html('pixels');
					}
					else {
						$('#shoutBoxTextBoxWidth').html('percent');
					}
				
				});
				
				
				
	
				$('#tinymceTextArea').tinymce({
			
					script_url: '".$MAIN_ROOT."js/tiny_mce/tiny_mce.js',
					theme: 'advanced',
					theme_advanced_buttons1: 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,|,bullist,numlist,|,link,unlink,image,code,|,forecolorpicker,fontselect,fontsizeselect',
					theme_advanced_resizing: true
				
				});
			

				
				$('#menuCats').change();
			
			});

		
		</script>
		
	";
	
	
}


?>