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
$prevFolder = "../";

include($prevFolder."_setup.php");

include_once($prevFolder."classes/member.php");
include_once($prevFolder."classes/event.php");

$consoleObj = new ConsoleOption($mysqli);
$eventObj = new Event($mysqli);
$member = new Member($mysqli);

$ipbanObj = new Basic($mysqli, "ipban", "ipaddress");

if($ipbanObj->select($IP_ADDRESS, false)) {
	$ipbanInfo = $ipbanObj->get_info();

	if(time() < $ipbanInfo['exptime'] OR $ipbanInfo['exptime'] == 0) {
		die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."banned.php';</script>");
	}
	else {
		$ipbanObj->delete();
	}

}


// Start Page
$PAGE_NAME = "Events - ";
$dispBreadCrumb = "";
include($prevFolder."themes/".$THEME."/_header.php");


$memberInfo = array();




$LOGGED_IN = false;
if($member->select($_SESSION['btUsername']) && $member->authorizeLogin($_SESSION['btPassword'])) {
	$memberInfo = $member->get_info_filtered();
	$LOGGED_IN = true;

}



echo "
	<div class='breadCrumbTitle'>Events</div>
	<div class='breadCrumb' style='padding-top: 0px; margin-top: 0px'>
		<a href='".$MAIN_ROOT."'>Home</a> > Events
	</div>
";
?>


<div style='margin: 0px auto; '>
	<table class='formTable' style='margin-left: auto; margin-right: auto'>
	
		<tr>
			<td class='formTitle' width="45%">Event Title:</td>
			<td class='formTitle' width="30%">Creator:</td>
			<td class='formTitle' width="25%">Start Date:</td>
		</tr>
		
		<?php
		
			$eventObj = new Event($mysqli);
			$objMember = new Member($mysqli);
			$counter = 0;
			$countEvents = 0;
			$result = $mysqli->query("SELECT event_id FROM ".$dbprefix."events ORDER BY startdate");
			while($row = $result->fetch_assoc()) {
				
				$eventObj->select($row['event_id']);
				$eventInfo = $eventObj->get_info_filtered();

				$showEvent = false;
				if($eventInfo['visibility'] == 2 && (in_array($memberInfo['member_id'], $eventObj->getInvitedMembers(true)) || $memberInfo['member_id'] == $eventInfo['member_id'] || $memberInfo['rank_id'] == 1)) {
					$showEvent == true;
				}
				elseif($eventInfo['visibility'] == 1 && $LOGGED_IN) {
			
					$showEvent = true;					
				}
				elseif($eventInfo['visibility'] == 0) {
					$showEvent = true;					
				}
				
				
				
				if($showEvent) {
					
					$countEvents++;
					$addCSS = "";
					if($counter%2 == 0) {
						$addCSS = " alternateBGColor";
					}
					$counter++;
					
					$objMember->select($eventInfo['member_id']);
					
					$dateTimeObj = new DateTime();
					$dateTimeObj->setTimestamp($eventInfo['startdate']);
					$includeTimezone = "";
					
					if($eventInfo['timezone'] != "") { 
						$dateTimeObj->setTimezone(new DateTimeZone($eventInfo['timezone']));
						$includeTimezone = " T"; 
					}
					
					$dispStartDate = $dateTimeObj->format("M j, Y g:i A".$includeTimezone);
					
					echo "
					<tr>
						<td class='main".$addCSS."' style='height: 30px; padding: 3px'><a href='info.php?eID=".$eventInfo['event_id']."'>".$eventInfo['title']."</a></td>
						<td class='main".$addCSS."' style='height: 30px; padding: 3px' align='center'>".$objMember->getMemberLink()."</td>
						<td class='main".$addCSS."' style='height: 30px; padding: 3px' align='center'>".$dispStartDate."</td>
					</tr>
					
					";
					
					
				}
				
			}
			
		?>
		
	</table>
	
	<?php
	
		if($countEvents == 0) {
			

			echo "
			
				<div class='shadedBox' style='width: 30%; margin-top: 20px; margin-left: auto; margin-right: auto'>
					<p class='main' align='center'>
						<i>No visible events have been created!</i>
					</p>
				</div>
			
			";
			
		}
	
	?>
	
</div>

<?php
include($prevFolder."themes/".$THEME."/_footer.php");
?>