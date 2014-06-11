<?php

	include("../../_setup.php");
	include("classes/donate-paypalclass.php");
	include("classes/donation.php");
	
	$donationPlugin = new btPlugin($mysqli);
	if($donationPlugin->selectByName("Donations")) {
		
		$donationObj = new Donation($mysqli);
		
		$p = new paypal_class();
		
		
		$arrColumns = array("donationcampaign_id", "member_id", "name", "message", "datesent", "amount", "paypalemail", "transaction_id", "response");
		
		$p->setMode($donationPlugin->getConfigInfo("mode"));
		if($p->validate_ipn() && $p->ipn_data['payment_status'] == "Completed") {
			$arrData = $p->ipn_data;
			$data = json_encode($arrData);
			
			$customVars = json_decode($arrData['custom'], true);
			
			$arrValues = array($customVars['campaign_id'], $customVars['member_id'], $customVars['name'], $customVars['message'], time(), $arrData['mc_gross'], $arrData['payer_email'], $arrData['txn_id'], $data);
			
			$donationObj->addNew($arrColumns, $arrValues);
			
			
		}
		else {
			$data = json_encode($p->ipn_data);
			$data = "ERROR: - ".$p->last_error." - ".$data;
			
			$donationObj->logError($data);	
		}
		
	}
?>