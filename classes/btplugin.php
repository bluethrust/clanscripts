<?php

	include_once("basic.php");
	include_once("basicsort.php");

	class btPlugin extends Basic {
		
		
		public $pluginPage;
		
		public function __construct($sqlConnection) {
			$this->MySQL = $sqlConnection;
			
			$this->strTableName = $this->MySQL->get_tablePrefix()."plugins";
			$this->strTableKey = "plugin_id";

			$this->pluginPage = new BasicSort($sqlConnection, "plugin_pages", "pluginpage_id", "plugin_id");
			
			
		}
		
		
		public function getPlugins($return = "") {
			
			$arrReturn = array();
			if($return != "") {
				$return = $this->MySQL->real_escape_string($return);	
			}
			else {
				$return = "plugin_id";	
			}
			

			$result = $this->MySQL->query("SELECT ".$return." FROM ".$this->strTableName);
			while($row = $result->fetch_assoc()) {
				$arrReturn[] = $row[$return];	
			}
			
			return $arrReturn;
			
		}
		
		public function getPluginPage($page) {
			
			$arrReturn = array();
			
			$page = $this->MySQL->real_escape_string($page);
			
			$result = $this->MySQL->query("SELECT * FROM ".$this->MySQL->get_tablePrefix()."plugin_pages WHERE page = '".$page."' ORDER BY sortnum");
			while($row = $result->fetch_assoc()) {
			
				$this->pluginPage->select($row['pluginpage_id']);
				$arrReturn[] = $this->pluginPage->get_info();
									
			}
				
						
			return $arrReturn;
			
		}
		
		
	}


?>