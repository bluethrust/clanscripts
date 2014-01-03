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

class btMySQL extends MySQLi {

	protected $bt_TablePrefix;
	protected $bt_TestingMode;
	
	public function set_tablePrefix($tablePrefix) {
		$this->bt_TablePrefix = $tablePrefix;
	}
	
	public function get_tablePrefix() {
		return $this->bt_TablePrefix;
	}
	
	public function set_testingMode($testModeValue) {
		$this->bt_TestingMode = $testModeValue;
	}
	
	public function displayError($pageName="") {
		if($this->bt_TestingMode) {
			die($pageName." - ".$this->error);
		}
	}
	
	public function getParamTypes($arrValues) {
		$strParamTypes = "";
		if(is_array($arrValues)) {
			foreach($arrValues as $value) {
				$valuetype = gettype($value);
				switch($valuetype) {
					case "integer":
						$strParamTypes .= "i";
						break;
					case "double":
						$strParamTypes .= "d";
						break;
					default:
						$strParamTypes .= "s";
				}
				
			}
		}
		return $strParamTypes;
	}
	
	public function bindParams($objMySQLiStmt, $arrValues) {
		$returnVal = false;
		$strParamTypes = $this->getParamTypes($arrValues);
		
		$tmpParams = array_merge(array($strParamTypes), $arrValues);
		$arrParams = array();
		foreach($tmpParams as $key=>$value) {
			$arrParams[$key] = &$tmpParams[$key];
		}
		
		
		if(!call_user_func_array(array($objMySQLiStmt, "bind_param"), $arrParams)) {
			$returnVal = false;
			echo $objMySQLiStmt->error;
			echo "<br><br>";
			$this->displayError("btmysql.php - bindParams");
		}
		else {
			$returnVal = $objMySQLiStmt;
		}
	
		
		return $returnVal;
		
	}

}


?>