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
	$memberInfo = $member->get_info_filtered();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}


$emailNotification = new EmailNotification($mysqli);

print_r($emailNotification->getNotificationItems("tournaments", "tournament_id", "Tournaments", "startdate"));


$cID = $_GET['cID'];

$i = 0;
$arrComponents = array(
	"emailnotification" => array(
		"type" => "section",
		"options" => array("section_title" => "E-mail me when:"),
		"sortorder" => $i++
	),
	"pm" => array(
		"type" => "select",
		"display_name" => "I receive a PM",
		"options" => array(1 => "Yes", "0" => "No"),
		"sortorder" => $i++,
		"attributes" => array("class" => "formInput textBox"),
		"value" => 1
	),
	"tournament" => array(
		"type" => "select",
		"display_name" => "A tournament is starting",
		"options" => array(1 => "Yes", "0" => "No"),
		"sortorder" => $i++,
		"attributes" => array("class" => "formInput textBox"),
		"value" => 1
	),
	"event" => array(
		"type" => "select",
		"display_name" => "An event is starting",
		"options" => array(1 => "Yes", "0" => "No"),
		"sortorder" => $i++,
		"attributes" => array("class" => "formInput textBox"),
		"value" => 1
	),
	"submit" => array(
		"type" => "submit",
		"value" => "Save",
		"sortorder" => $i++,
		"attributes" => array("class" => "submitButton formSubmitButton")
	)
);


$setupFormArgs = array(
	"name" => "console-".$cID,
	"components" => $arrComponents,
	"saveObject" => $member,
	"saveType" => "update",
	"saveMessage" => "Successfully changed username!",
	"attributes" => array("action" => $MAIN_ROOT."members/console.php?cID=".$cID, "method" => "post"),
	"description" => "Use the form below to set your e-mail notification settings."
);

?>