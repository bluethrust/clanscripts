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


	include_once("basic.php");
	include_once("basicsort.php");

	class btPlugin extends Basic {
		
		
		public $pluginPage;
		protected $configInfo;
		protected $configInfoIDs;
		protected $objPluginConfig;
		
		public function __construct($sqlConnection) {
			$this->MySQL = $sqlConnection;
			
			$this->strTableName = $this->MySQL->get_tablePrefix()."plugins";
			$this->strTableKey = "plugin_id";

			$this->pluginPage = new BasicSort($sqlConnection, "plugin_pages", "pluginpage_id", "plugin_id");
			
			$this->objPluginConfig = new Basic($sqlConnection, "plugin_config", "pluginconfig_id");
		}
		
		public function select($intIDNum, $numericIDOnly = true) {
			
			$returnVal = parent::select($intIDNum, $numericIDOnly);
			if($returnVal) {
				$this->populateConfig();	
			}
			
			return $returnVal;
		}
		
		
		public function selectByName($pluginName) {
			$returnVal = false;
			if($pluginName != "") {
				$filterPluginName = $this->MySQL->real_escape_string($pluginName);
				
				$result = $this->MySQL->query("SELECT plugin_id FROM ".$this->strTableName." WHERE name = '".$filterPluginName."'");
				if($result->num_rows == 1) {
					$row = $result->fetch_assoc();
					$returnVal = $this->select($row['plugin_id']);
				}
			}
			
			return $returnVal;
		}
				
		
		public function getPlugins($return = "") {
			
			$arrReturn = array();
			if($return != "") {
				$return = $this->MySQL->real_escape_string($return);	
			}
			else {
				$return = "plugin_id";	
			}
			

			$result = $this->MySQL->query("SELECT * FROM ".$this->strTableName);
			while($row = $result->fetch_assoc()) {

				$arrReturn[$row['plugin_id']] = $row[$return];
			
			}
			
			return $arrReturn;
			
		}
		
		public function getAPIKeys() {
			$returnArr = array();
			if($this->intTableKeyValue != "") {
				
				$returnArr = json_decode($this->arrObjInfo['apikey'], true);
				
			}
			
			return $returnArr;
		}
		
		public function getPluginPage($page, $limitToPlugin="") {
			
			$sqlFilter = "";
			if($limitToPlugin != "" && is_numeric($limitToPlugin)) {
				$sqlFilter = " AND plugin_id = '".$limitToPlugin."'";
			}
			
			$arrReturn = array();
			
			$page = $this->MySQL->real_escape_string($page);
			
			$result = $this->MySQL->query("SELECT * FROM ".$this->MySQL->get_tablePrefix()."plugin_pages WHERE page = '".$page."'".$sqlFilter." ORDER BY sortnum");
			while($row = $result->fetch_assoc()) {
			
				$this->pluginPage->select($row['pluginpage_id']);
				$arrReturn[] = $this->pluginPage->get_info();
									
			}
				
						
			return $arrReturn;
			
		}
		
		
		protected function populateConfig() {
			
			$this->configInfo = array();
			if($this->intTableKeyValue != "") {
				$result = $this->MySQL->query("SELECT * FROM ".$this->MySQL->get_tablePrefix()."plugin_config WHERE plugin_id = '".$this->intTableKeyValue."'");
				while($row = $result->fetch_assoc()) {
					
					$this->configInfo[$row['name']] = $row['value'];
					$this->configInfoIDs[$row['name']] = $row['pluginconfig_id'];
					
				}
				
			}
			
		}
		
		
		public function addConfigValue($name, $value) {

			if($this->intTableKeyValue != "" && !isset($this->configInfo[$name])) {
				$this->objPluginConfig->addNew(array("plugin_id", "name", "value"), array($this->intTableKeyValue, $name, $value));
			}
			else {
				$this->updateConfigValue($name, $value);
			}
			
		}
		
		
		public function updateConfigValue($name, $value) {
			
			$returnVal = false;
			if($this->intTableKeyValue != "" && $this->objPluginConfig->select($this->configInfoIDs[$name])) {
				
				$returnVal = $this->objPluginConfig->update(array("value"), array($value));
				
			}
			
			return $returnVal;
		}
		
		public function deleteConfigValue($name) {

			if($this->intTableKeyValue != "" && $this->objPluginConfig->select($this->configInfoIDs[$name])) {
				
				$this->objPluginConfig->delete();	
				
			}
			
		}
		
		
		public function getConfigInfo($returnSingleValue="") {
			
			$returnVal = "";
			if($this->intTableKeyValue != "") {
				
				if($returnSingleValue != "") {
					$returnVal = $this->configInfo[$returnSingleValue];	
				}
				else {
					$returnVal = $this->configInfo;	
				}
				
			}
			
			return $returnVal;
			
		}
		
		
		public function delete() {
			$returnVal = false;
			if($this->intTableKeyValue != "") {
				$blnDeletePlugin = parent::delete();
				
				if($this->MySQL->query("DELETE FROM ".$this->MySQL->get_tablePrefix()."plugin_pages WHERE plugin_id = '".$this->intTableKeyValue."'") && $blnDeletePlugin) {
					$returnVal = true;
				}
				
				$this->MySQL->query("OPTIMIZE TABLE `".$this->MySQL->get_tablePrefix()."plugin_pages`");
			
			}
			
			return $returnVal;
		}
		
		
	}


?>