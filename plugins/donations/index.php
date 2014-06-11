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


// Config File
$prevFolder = "../../";

include_once($prevFolder."_setup.php");
include_once("classes/campaign.php");

$campaignObj = new DonationCampaign($mysqli);
$donationPlugin = new btPlugin($mysqli);

if(!$donationPlugin->selectByName("Donations") || !$campaignObj->select($_GET['campaign_id'])) {
	echo "<script type='text/javascript'>window.location = '".$MAIN_ROOT."';</script>";
	exit();
}
elseif($donationPlugin->selectByName("Donations") && $donationPlugin->getConfigInfo("email") == "") {
	echo "
		<script type='text/javascript'>
			alert('Please complete the plugin configuration before continuing!');
			window.location = '".$MAIN_ROOT."';
		</script>
	";
	exit();
}

$campaignInfo = $campaignObj->get_info_filtered();

// Start Page
$EXTERNAL_JAVASCRIPT .= "<link rel='stylesheet' type='text/css' href='".$MAIN_ROOT."plugins/donations/donations.css'>";
$PAGE_NAME = $campaignInfo['title']." - ";
include($prevFolder."themes/".$THEME."/_header.php");

$member = new Member($mysqli);

$breadcrumbObj->setTitle($campaignInfo['title']);
$breadcrumbObj->addCrumb("Home", $MAIN_ROOT);
$breadcrumbObj->addCrumb("Donation Campaign: ".$campaignInfo['title']);
include($prevFolder."include/breadcrumb.php");

define("DONATIONPAGE", true);

switch($_GET['p']) {
	case "history":

		break;
	default:
		include("include/main.php");
}


include($prevFolder."themes/".$THEME."/_footer.php"); 

?>