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

include_once("../../../../_setup.php");
include_once("../../../../classes/member.php");
include_once("../../../../classes/basicorder.php");
include_once("../../../../classes/forumboard.php");


// Start Page

$consoleObj = new ConsoleOption($mysqli);

$cID = $consoleObj->findConsoleIDByName("Add Board");
$consoleObj->select($cID);
$consoleInfo = $consoleObj->get_info_filtered();


$member = new Member($mysqli);
$member->select($_SESSION['btUsername']);


$categoryObj = new BasicOrder($mysqli, "forum_category", "forumcategory_id");
$categoryObj->set_assocTableName("forum_board");
$categoryObj->set_assocTableKey("forumboard_id");

$boardObj = new ForumBoard($mysqli);

// Check Login
$LOGIN_FAIL = true;

$arrSelectBoard = "";
if(isset($_POST['bID']) && $boardObj->select($_POST['bID'])) {
	$arrSelectBoard = $boardObj->findBeforeAfter();	
}
else {
	$_POST['bID'] = "";	
}

if($member->authorizeLogin($_SESSION['btPassword']) && $member->hasAccess($consoleObj)) {
	

	if($categoryObj->select($_POST['catID'])) {

		$arrBoards = $categoryObj->getAssociateIDs("ORDER BY sortnum");
		foreach($arrBoards as $value) {

			if($_POST['bID'] != $value) {
			
				$boardObj->select($value);
				$boardInfo = $boardObj->get_info_filtered();
				
				$selectBoard = "";
				if($_POST['bID'] != "" && $arrSelectBoard[0] == $boardInfo['forumboard_id']) {
					$selectBoard = " selected";
				}
				
				echo "<option value='".$boardInfo['forumboard_id']."'".$selectBoard.">".$boardInfo['name']."</option>";
				
			}
			
		}
		
		if(count($arrBoards) == 0 || ($_POST['bID'] != "" && count($arrBoards) == 1)) {
			echo "<option value='first'>(first board)</option>";	
		}
	
	}
	
}


?>