<?php


	class EmailNotification extends Basic {
		
		
		public $hoursBefore = 8;
		
		public function __construct($sqlConnection) {

			$this->MySQL = $sqlConnection;
			$this->strTableName = $this->MySQL->get_tablePrefix()."emailnotifications";
			$this->strTableKey = "emailnotification_id";

		}
		
		
		
		/*
		 * 
		 * $args - Array with info on which tables to check for notification.
		 * example:
		 * $args = array(
		 * 				"table" => "tournaments",
		 * 				"table_id" => "tournament_id",
		 * 				"members_table" => "tournamentplayers",
		 * 				"time_column" => "startdate",
		 * 				"name_column" => "name",
		 * 				"notification_type" => "tournament"
		 * 			);
		 * 
		 * 
		 */
		
		
		public function getNotificationItems($tableName, $tableID, $notificationName, $timeColumn) {
			$tempArr = array("name" => $notificationName);
			$this->selectByMulti($tempArr);
			
			$timeDiff = time()+(3600*$this->hoursBefore);
			$arrItems = array();
			
			$query = "SELECT ".$tableID." FROM ".$this->MySQL->get_tablePrefix().$tableName." WHERE ".$timeColumn." <= '".$timeDiff."' AND startdate > '".time()."'";
			$result = $this->MySQL->query($query);
			while($row = $result->fetch_assoc()) {
				$arrItems[$row[$tableID]] = $row[$tableID];				
			}
			
			$sqlItemIDs = "('".implode("','", $arrItems)."')";
			$query = "SELECT item_id FROM ".$this->MySQL->get_tablePrefix()."emailnotifications_sent WHERE emailnotification_id = '".$this->intTableKeyValue."' AND item_id IN ".$sqlItemIDs;
			$result = $this->MySQL->query($query);
			while($row = $result->fetch_assoc()) {
				unset($arrItems[$row['item_id']]);
			}
			
			return $arrItems;
		}
		
		
		public function sendTournamentNotification() {
			
			$arrTournaments = $this->getNotificationItems("tournaments", "tournament_id", "Tournaments", "startdate");
			$sqlTournaments = "('".implode("','", $arrTournaments)."')";
			$result = $this->MySQL->query("SELECT member_id FROM ".$this->MySQL->get_tablePrefix()."tournamentplayers WHERE tournament_id IN ".$sqlTournaments);
			
		}
		
		
	}


?>