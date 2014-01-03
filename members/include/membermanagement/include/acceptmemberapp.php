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

include_once("../../../../_setup.php");
include_once("../../../../classes/member.php");
include_once("../../../../classes/basic.php");
include_once("../../../../classes/rank.php");


$consoleObj = new ConsoleOption($mysqli);
$member = new Member($mysqli);
$member->select($_SESSION['btUsername']);
$memberInfo = $member->get_info_filtered();
$newMemberObj = new Member($mysqli);

$cID = $consoleObj->findConsoleIDByName("View Member Applications");
$consoleObj->select($cID);

$memberAppObj = new Basic($mysqli, "memberapps", "memberapp_id");


if($member->authorizeLogin($_SESSION['btPassword']) && $member->hasAccess($consoleObj) && $memberAppObj->select($_POST['mAppID'])) {
	
	$arrMemAppInfo = $memberAppObj->get_info_filtered();
	$rankObj = new Rank($mysqli);
	$rankObj->selectByOrder(2);
	$newMemRank = $rankObj->get_info("rank_id");
	
	$arrColumns = array("username", "rank_id", "password", "password2", "email", "datejoined", "lastseen", "lastlogin", "recruiter");
	$arrValues = array($arrMemAppInfo['username'], $newMemRank, $arrMemAppInfo['password'], $arrMemAppInfo['password2'], $arrMemAppInfo['email'], time(), time(), time(), $memberInfo['member_id']);
			
	if($newMemberObj->addNew($arrColumns, $arrValues) && $memberAppObj->update(array("memberadded"), array(1))) {
		
		$dispNewMember = $newMemberObj->getMemberLink();
		
		$member->logAction("Accepted ".$dispNewMember."'s member application.");
		
		
		echo "
			<div id='memAppMessage'>
				<p class='main' align='center'>
					".$dispNewMember." was successfully added to the website!
				</p>
			</div>
		";
		
		
		$siteDomain = $_SERVER['SERVER_NAME'];
		
		$toEmail = $arrMemAppInfo['email'];
		$subjectEmail = $websiteInfo['clanname'].": Member Application Accepted";
		
		$messageEmail = "You have been accepted to become a full member of ".$websiteInfo['clanname']."!  Go to <a href='http://".$siteDomain.$MAIN_ROOT."'>http://".$siteDomain.$MAIN_ROOT."</a> to log in to your account.";
		
		$fromEmail = "admin@".$siteDomain;
		$headersEmail = "MIME-Version: 1.0\r\n";
		$headersEmail .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headersEmail .= "To: ".$arrMemAppInfo['username']." <".$arrMemAppInfo['email'].">\r\n";
		$headersEmail .= "From: ".$websiteInfo['clanname']." <".$fromEmail.">\r\n";
		
		mail($toEmail, $subjectEmail, $messageEmail, $headersEmail);
		
	}
	else {
		echo "
			<div id='memAppMessage'>
				<p class='main' align='center'>
					Unable to accept ".$dispNewMember."'s application!  Please contact the website administrator.
				</p>
			</div>
		";
	}
	
	
	echo "
		
		<script type='text/javascript'>
			$(document).ready(function() {
			
				$('#memAppMessage').dialog({
				
					title: 'Accept Member Application',
					modal: true,
					zIndex: 99999,
					show: 'scale',
					width: 400,
					resizable: false,
					buttons: {
						'OK': function() {
							$(this).dialog('close');
						}
						
					}
				
				});
			
			});		
		</script>
	";
	
	
}

include("memberapplist.php");

?>