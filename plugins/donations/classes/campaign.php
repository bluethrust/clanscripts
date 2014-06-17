<?php

	include_once("donation.php");

	class DonationCampaign extends Basic {
		
		
		public $donationObj;
		
		// Recurring Period Date Codes
		const DAY = "Ymd";
		const WEEK = "YW";
		const MONTH = "Ym";
		const YEAR = "Y";
		
		protected $arrPeriodDateCodes;
		private $blnUpdateCurrentPeriod = false;
		public $donationInfo;
		public $donationAmounts;
		
		
		public function __construct($sqlConnection) {

			$this->MySQL = $sqlConnection;
			$this->strTableName = $this->MySQL->get_tablePrefix()."donations_campaign";
			$this->strTableKey = "donationcampaign_id";

			$this->donationObj = new Donation($sqlConnection);
			$this->arrPeriodDateCodes = array("days" => self::DAY, "weeks" => self::WEEK, "months" => self::MONTH, "years" => self::YEAR);

		}
		
		
		public function select($intIDNum, $numericIDOnly=true) {
			
			$returnVal = parent::select($intIDNum, $numericIDOnly);
			
			$this->populateDonationInfo();
			
			return $returnVal;
		}
		
		public function getLink() {
			
			return MAIN_ROOT."plugins/donations/?campaign_id=".$this->intTableKeyValue;	
			
		}
		
		public function getCurrentPeriodRange($returnTimestamps=false) {
			
			$returnVal = array();
			if($this->intTableKeyValue != "" && $this->arrObjInfo['currentperiod'] != 0) {	

				$recurAmount = $this->arrObjInfo['recurringamount'];
				$currentPeriod = $this->arrObjInfo['currentperiod'];
				
				$year = substr($currentPeriod, 0, 4);
				$month = substr($currentPeriod, 4, 2);
				$day = substr($currentPeriod, 6, 2);
				
				switch($this->arrObjInfo['recurringunit']) {
					case "days":
						$currentPeriodDate = mktime(0,0,0,$month,$day,$year);
						$nextPeriodDate = mktime(0,0,0,$month,$day+$recurAmount,$year);
						$nextPeriod = date(self::DAY, $nextPeriodDate);
						break;
					case "weeks":
						$currentPeriodDate = strtotime($year."W".$month);
						$nextPeriodDate = strtotime($year."W".($month+$recurAmount));
						$nextPeriod = date(self::WEEK, $nextPeriodDate);
						break;
					case "months":
						$currentPeriodDate = mktime(0,0,0,$month,01,$year);
						$nextPeriodDate = mktime(0,0,0,$month+$recurAmount,01,$year);
						$nextPeriod = date(self::MONTH, $nextPeriodDate);
						break;
					case "years":
						$currentPeriodDate = mktime(0,0,0,01,$day,$year);
						$nextPeriodDate = mktime(0,0,0,01,01,$year+$recurAmount);
						$nextPeriod = date(self::YEAR, $nextPeriodDate);
						break;
				}

				
				$returnVal = (!$returnTimestamps) ? array("current" => $currentPeriod, "next" => $nextPeriod) : array("current" => $currentPeriodDate, "next" => $nextPeriodDate);
				
			}
			
			
			return $returnVal;
		}
		
		
		public function updateCurrentPeriod() {
			
			if($this->intTableKeyValue != "" && $this->arrObjInfo['currentperiod'] != 0) {	
				
				$recurUnit = $this->arrObjInfo['recurringunit'];
				$todayPeriod = date($this->arrPeriodDateCodes[$recurUnit]);

				$currentPeriodRange = $this->getCurrentPeriodRange();
				if($todayPeriod >= $currentPeriodRange['next']) {
					$this->arrObjInfo['currentperiod'] = $currentPeriodRange['next'];
					$this->blnUpdateCurrentPeriod = true;
					$this->updateCurrentPeriod();
				}
				elseif($this->blnUpdateCurrentPeriod) {
					$this->update(array("currentperiod"), array($this->arrObjInfo['currentperiod']));
					$this->blnUpdateCurrentPeriod = false;
				}
		
			}
	
		}
		
		
		public function calcPeriodsSinceStart() {
		
			$returnVal = 0;
			if($this->intTableKeyValue != "" && $this->arrObjInfo['currentperiod'] != 0) {	
			
				$startDate = $this->arrObjInfo['datestarted'];
				$recurAmount = $this->arrObjInfo['recurringamount'];
				$recurUnit = $this->arrObjInfo['recurringunit'];
				
				$startPeriod = date($this->arrPeriodDateCodes[$recurUnit], $startDate);
				
				$todayPeriod = date($this->arrPeriodDateCodes[$recurUnit]);
				
				$returnVal = floor(($todayPeriod-$startPeriod)/$recurAmount);
				
			}
			
			return $returnVal;
		}
		
		
		public function populateDonationInfo($total=false) {
		
			$donationInfo = array();
			if($this->intTableKeyValue != "") {
					
				$arrPeriod = $this->getCurrentPeriodRange(true);
				
				$addSQL = (count($arrPeriod) == 0 || $total) ? "" : " WHERE datesent >= '".$arrPeriod['current']."' AND datesent < '".$arrPeriod['next']."'";
				
				$result = $this->MySQL->query("SELECT * FROM ".$this->MySQL->get_tablePrefix()."donations ".$addSQL."ORDER BY datesent DESC");
				while($row = $result->fetch_assoc()) {
					$donationInfo[] = filterArray($row);
					$totalDonationAmount += $row['amount'];	
				}
				
				$this->donationAmounts = $totalDonationAmount;
			}
			
			$this->donationInfo = $donationInfo;
		}
		
		
		public function getTotalDonationAmount() {
			return $this->donationAmounts;
		}

		public function getDonationInfo() {
			return $this->donationInfo;
		}
		
	}

?>