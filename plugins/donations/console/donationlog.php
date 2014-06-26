<?php

	if(!defined("MAIN_ROOT")) { exit(); }
	

	$campaignInfo = $campaignObj->get_info_filtered();
	
	$breadcrumbObj->popCrumb();
	$breadcrumbObj->addCrumb($consoleTitle, MAIN_ROOT."members/console.php?cID=".$cID);
	$breadcrumbObj->addCrumb("Donation Log: ".$campaignInfo['title']);
	$breadcrumbObj->setTitle("Donation Log: ".$campaignInfo['title']);
	
	$breadcrumbObj->updateBreadcrumb();

	
	$addToPageSelectorLink = "";
	if(!isset($_GET['start']) || !isset($_GET['end']) || !is_numeric($_GET['start']) || !is_numeric($_GET['end'])) {
		$period = $campaignObj->getCurrentPeriodRange(true);
		$_GET['start'] = $period['current'];
		$_GET['end'] = $period['next']-(60*60*24);
	}
	elseif($_GET['start'] > $_GET['end']) {
		$temp = $_GET['start'];
		$_GET['start'] = $_GET['end'];
		$_GET['end'] = $temp;
	}
	else {
		$addToPageSelectorLink = "&start=".$_GET['start']."&end=".$_GET['end'];	
	}
	
	$donationsPerPage = 25;
	
	$campaignObj->populateDonationInfo(false, $_GET['start'], $_GET['end']);
	$totalDonated = $campaignObj->getTotalDonationAmount();
	
	$donationInfo = $campaignObj->getDonationInfo();
	$totalDonations = count($donationInfo);
	
	include_once(BASE_DIRECTORY."plugins/donations/console/datefilter_form.php");
	
	$numOfPages = ceil($totalDonations/$donationsPerPage);

	$pageSelector = new PageSelector();
	$pageSelector->setPages($numOfPages);
	
	$_GET['pageNum'] = $pageSelector->validatePageNumber($_GET['pageNum']);
	
	$pageSelector->setCurrentPage($_GET['pageNum']);
	$pageSelector->setLink(MAIN_ROOT."members/console.php?cID=".$_GET['cID']."&campaignID=".$_GET['campaignID']."&p=log".$addToPageSelectorLink."&pageNum=");
	
	
	$pageSelector->show();
	
?>


<table class='formTable' style='border-spacing: 0px; margin-top: 0px'>
	<tr>
		<td class='formTitle' style='width: 20%'>Date:</td>
		<td class='formTitle' style='width: 50%; border-left: 0px'>From:</td>
		<td class='formTitle' style='width: 10%; border-left: 0px'>Details:</td>
		<td class='formTitle' style='width: 20%; border-left: 0px'>Amount:</td>
	</tr>

<?php 

	$donateMember = new Member($mysqli);

	$counter = 0;
	$i = ($_GET['pageNum']-1)*$donationsPerPage;
	while($counter < $donationsPerPage && $i < $totalDonations) {
		$info = $donationInfo[$i];
		
		$dispDate = getPreciseTime($info['datesent'], "", true);
		
		$dispFrom = ($info['name'] == "") ? "Anonymous" : $info['name'];
		if($donateMember->select($info['member_id'])) {
			$dispFrom = $donateMember->getMemberLink();	
		}
		
		$addCSS = ($counter%2 == 1) ? " alternateBGColor" : "";
		
		echo "
			<tr>
				<td class='main manageList".$addCSS."'>".$dispDate."</td>
				<td class='main manageList".$addCSS."'>".$dispFrom."</td>
				<td class='main manageList".$addCSS."' align='center'><a href='".MAIN_ROOT."members/console.php?cID=206&donationID=".$info['donation_id']."'>Details</a></td>
				<td class='main manageList".$addCSS."' align='center'>".$campaignObj->formatAmount($info['amount'])."</td>
			</tr>		
		";
		
		$counter++;
		$i++;	
	}
	
?>

</table>

<script type='text/javascript'>
	$(document).ready(function() {
		$('#consoleBottomBackButton').attr("href", "<?php echo MAIN_ROOT."members/console.php?cID=".$_GET['cID']; ?>");
		$('#consoleTopBackButton').attr("href", "<?php echo MAIN_ROOT."members/console.php?cID=".$_GET['cID']; ?>");
	});
</script>