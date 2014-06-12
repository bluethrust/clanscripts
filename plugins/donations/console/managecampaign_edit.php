<?php


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


$consoleCatID = $consoleObj->get_info("consolecategory_id");
$socialInfo = $socialObj->get_info_filtered();

$breadcrumbObj->popCrumb();
$breadcrumbObj->addCrumb($consoleObj->get_info_filtered("pagetitle"), $MAIN_ROOT."members/console.php?cID=".$cID);
$breadcrumbObj->addCrumb($socialInfo['name']);

$breadcrumbObj->updateBreadcrumb();

define("CAMPAIGN_FORM", true);

include(BASE_DIRECTORY."plugins/donations/console/campaign_form.php");

?>