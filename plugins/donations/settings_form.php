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


if(!isset($pluginObj)) { exit(); }


$configInfo = $pluginObj->getConfigInfo();


$i=0;
$arrComponents = array(
	"email" => array(
		"type" => "text",
		"attributes" => array("class" => "textBox formInput"),
		"display_name" => "Paypal E-mail",
		"sortorder" => $i++,
		"value" => $configInfo['email'],
		"validate" => array("NOT_BLANK")
	),
	"mode" => array(
		"type" => "select",
		"attributes" => array("class" => "textBox formInput"),
		"display_name" => "Mode",
		"options" => array("" => "Sandbox", "live" => "Live"),	
		"sortorder" => $i++,
		"value" => $configInfo['mode'],
		"validate" => array("RESTRICT_TO_OPTIONS"),
		"tooltip" => "You can use sandbox mode to test donations without real money.  You will have to set up test accounts with Paypal in order to use Sandbox mode"
	),
	"submit" => array(
		"type" => "submit",
		"value" => "Save",
		"sortorder" => $i++,
		"attributes" => array("class" => "submitButton formSubmitButton")			
	)
		
);


$setupFormArgs = array(
	"name" => "pluginsettings-".$_GET['plugin'],
	"components" => $arrComponents,
	"description" => "Use the form below to configure the donation plugin.",
	"attributes" => array("action" => $MAIN_ROOT."plugins/settings.php?plugin=".$_GET['plugin'], "method" => "post"),
	"afterSave" => array("saveDonationSettings"),
	"saveMessage" => "Donation Settings Saved!",
	"saveLink" => $MAIN_ROOT."members/console.php?cID=".$cID
);

function saveDonationSettings() {
	global $pluginObj;
	
	$pluginObj->addConfigValue("email", $_POST['email']);
	$pluginObj->addConfigValue("mode", $_POST['mode']);
	
}

?>