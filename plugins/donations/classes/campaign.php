<?php

	include_once("donation.php");

	class DonationCampaign extends Basic {
		
		
		public $donationObj;

		public function __construct($sqlConnection) {

			$this->MySQL = $sqlConnection;
			$this->strTableName = $this->MySQL->get_tablePrefix()."donations_campaign";
			$this->strTableKey = "donationcampaign_id";

			$this->donationObj = new Donation($sqlConnection);
			
		}
		
		
		
	}

?>