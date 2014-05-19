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

	if(!defined("LOGGED_IN") || !LOGGED_IN) { die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."'</script>"); }
	
	$arrItems = array();
	$arrMedals = $medalObj->get_entries(array(), "ordernum DESC");
	$x = 0;
	foreach($arrMedals as $medalInfo) {
				
		$actionsInfo = array();
		if($x != 0) {
			$actionsInfo[] = "moveup";
		}
		
		if($x != (count($arrMedals)-1)) {
			$actionsInfo[] = "movedown";	
		}
		
		$actionsInfo[] = "edit";
		$actionsInfo[] = "delete";
		
		$x++;
		
		
		$arrItems[] = array(
			"display_name" => $medalInfo['name'],
			"item_id" => $medalInfo['medal_id'],
			"type" => "listitem",
			"edit_link" => $MAIN_ROOT."members/console.php?cID=".$cID."&mID=".$medalInfo['medal_id']."&action=edit",
			"actions" => $actionsInfo
		);
		
		
	}
	
	$addMedalCID = $consoleObj->findConsoleIDByName("Add New Medal");
	$setupManageListArgs = array(
		"item_title" => "Medal Name:",
		"add_new_link" => array("url" => $MAIN_ROOT."members/console.php?cID=".$addMedalCID, "name" => "Add New Medal"),
		"actions" => array("moveup", "movedown", "edit", "delete"),
		"move_link" => $MAIN_ROOT."members/include/admin/medals/move.php",
		"delete_link" => $MAIN_ROOT."members/include/admin/medals/delete.php",
		"items" => $arrItems,
		"confirm_delete" => true
	);
	
	
	
?>