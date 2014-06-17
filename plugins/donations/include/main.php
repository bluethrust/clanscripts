<?php 
	
	if(!defined("MAIN_ROOT")) { exit(); } 
	global $donationPlugin, $campaignInfo, $campaignObj;
	
	
	$member = new Member($mysqli);
	$donationForm = new Form();
	
	include("include/currency_codes.php");
	include("include/donate_form.php");

	if($donationPlugin->getConfigInfo("mode") != "live") {

		echo "
			<div class='errorDiv'><p><strong>NOTE:</strong> This plugin is currently set to sandbox mode!  In order to properly receive donations it must be set to Live mode.</p></div>
		";
		
	}
	
	
	$donationsInfo = $campaignObj->getDonationInfo();
	$totalDonations = count($donationsInfo);


	$blnSymbolLeft = $arrPaypalCurrencyInfo[$campaignInfo['currency']]['position'] == "left";
	$blnSymbolRight = $arrPaypalCurrencyInfo[$campaignInfo['currency']]['position'] == "right";
	$symbolLeft = ($blnSymbolLeft) ? $arrPaypalCurrencyInfo[$campaignInfo['currency']]['symbol'] : "";
	$symbolRight = ($blnSymbolRight) ? $arrPaypalCurrencyInfo[$campaignInfo['currency']]['symbol'] : "";
	
	$donationsFormatted = $symbolLeft.number_format($campaignObj->getTotalDonationAmount(), 2).$symbolRight;
	
	$dispGoal = "";
	if($campaignInfo['goalamount'] > 0) {
		$dispGoal = " of ".$symbolLeft.number_format($campaignInfo['goalamount'], 2).$symbolRight." goal";
	
		// Graph
		$goalCompletePercent = round(($campaignObj->getTotalDonationAmount()/$campaignInfo['goalamount'])*100);
		$goalCompletePercent = ($goalCompletePercent > 100) ? "100%" : $goalCompletePercent."%";
		
	}
	
	$daysLeft = "";
	if($campaignInfo['dateend'] != 0) {

		$periodRange = $campaignObj->getCurrentPeriodRange(true);
		$currentEndDate = ($periodRange['next'] > $campaignInfo['dateend']) ? $campaignInfo['dateend'] : $periodRange['next'];
		
		$secondsLeft = $currentEndDate-time();
		$daysLeft = ($secondsLeft > 0) ? round($secondsLeft/(60*60*24)) : 0;
		
	}
	elseif($campaignInfo['dateend'] == 0 && $campaignInfo['currentperiod'] != 0) {
		$periodRange = $campaignObj->getCurrentPeriodRange(true);
		$secondsLeft = $periodRange['next']-time();
		$daysLeft = ($secondsLeft > 0) ? round($secondsLeft/(60*60*24)) : 0;
	}
	
	
	
?>

<div class='donationsLeft'>

	<?php $donationForm->show(); ?>

</div>

<div class='donationsRight'>

	<div class='dottedLine' class='main' style='margin-top: 15px'><b>Donation Statistics:</b></div>
	<p class='numberCounts'><?php echo $totalDonations; ?></p>
	<p class='main'>donations</p>
	<br>
	<p class='numberCounts'><?php echo $donationsFormatted ?></p>
	<p class='main'>raised<?php echo $dispGoal; ?></p>
	<?php 
		if($dispGoal != "") {
			
			$dispDaysLeft = ($daysLeft != "") ? "<div class='donationsDaysLeft'>".$daysLeft." ".pluralize("day", $daysLeft)." left</div>" : "";
			
			
			echo "
				<br>
				<div class='donationProgressContainer'><div style='background-color: ".$donationPlugin->getConfigInfo("goalprogresscolor")."; width: ".$goalCompletePercent."'></div></div>
				<div class='main donationGoalText'>".$goalCompletePercent.$dispDaysLeft."</div>
			";
			
		}
		elseif($daysLeft != "") {
			echo "
				<br>		
				<p class='numberCounts'>".$daysLeft."</p>		
				<p class='main'>".pluralize("day", $daysLeft)." left</p>		
			";
		}

		
		if($campaignInfo['description'] != "") {
			echo "
				<br>
				<div class='dottedLine' class='main' style='margin-top: 15px'><b>Campaign Description:</b></div>
				<div class='main' style='padding-top: 3px'>".$campaignInfo['description']."</div>
			";
		}
	
		$medalObj = new Medal($mysqli);
		if($campaignInfo['awardmedal'] != 0 && $medalObj->select($campaignInfo['awardmedal'])) {
			$medalInfo = $medalObj->get_info_filtered();			
			
			$dispStyle = $medalInfo['imagewidth'] != 0 ? "width: ".$medalInfo['imagewidth']."px;" : "";
			$dispStyle .= $medalInfo['imageheight'] != 0 ? "height: ".$medalInfo['imageheight']."px;" : "";
			
			$dispStyle = ($dispStyle != "") ? " style='".$dispStyle."'" : "";
			
			
			echo "
				<br>
				<div class='dottedLine' class='main' style='margin-top: 15px'><b>Member Reward:</b></div>
				<div class='main' style='padding-top: 3px'>Members who donate to this campaign will receive:</div>
				<br>
				<p class='main' align='center'><img src='".$medalInfo['imageurl']."'".$dispStyle."><br>".$medalInfo['name']."</p>
			";
		}
		
	?>
	<br>
	<div class='dottedLine' class='main' style='margin-top: 15px'><b>Donators:</b></div>
</div>

<div style='clear: both'></div>