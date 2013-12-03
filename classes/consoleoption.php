<?php

/*
 * Bluethrust Clan Scripts v4
 * Copyright 2012
 *
 * Author: Bluethrust Web Development
 * E-mail: support@bluethrust.com
 * Website: http://www.bluethrust.com
 *
 * License: http://www.bluethrust.com/license.php
 *
 */



include_once("basicsort.php");

class ConsoleOption extends BasicSort {

	function __construct($sqlConnection) {
		$this->MySQL = $sqlConnection;
		$this->strTableName = $this->MySQL->get_tablePrefix()."console";
		$this->strTableKey = "console_id";
		$this->strCategoryKey = "consolecategory_id";
	}


	/*
	-Console Access Checker-
	
	intRankID: Database ID for the rank that you want to check
	
	This will check if a certain ranking has the privilege to use the selected console option.  
	You must first select a console option before using this method.
	
	
	*/
	
	function hasAccess($intRankID) {
		$returnVal = false;
		if(is_numeric($intRankID) && is_numeric($this->intTableKeyValue)) {
			
			$result = $this->MySQL->query("SELECT * FROM ".$this->MySQL->get_tablePrefix()."rank_privileges WHERE rank_id = '$intRankID' AND console_id = '".$this->intTableKeyValue."'");
			$countRows = $result->num_rows;
			
			if($countRows > 0) {
				$returnVal = true;
			}
			elseif($intRankID == 1) {
				$returnVal = true;	
			}
			
		}
	
		return $returnVal;
	}
	
	function findConsoleIDByName($strConsolePageTitle) {
		
		$returnVal = false;
		$strConsoleName = $this->MySQL->real_escape_string($strConsolePageTitle);
		$result = $this->MySQL->query("SELECT * FROM ".$this->strTableName." WHERE pagetitle = '".$strConsoleName."'");
		if($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			if($this->select($row[$this->strTableKey])) {
				$returnVal = $row[$this->strTableKey];
			}
		}
		
		return $returnVal;
	}

	/*
	
	-Delete Method-
	
	Will delete the selected row from the database.  You must first "select" a table row using the select method in order to delete.
	
	*/
	
	public function delete() {
		$returnVal = false;
		if($this->intTableKeyValue != "") {
			$result = $this->MySQL->query("DELETE FROM ".$this->strTableName." WHERE ".$this->strTableKey." = '".$this->intTableKeyValue."'");
	
			
			$result = $this->MySQL->query("DELETE FROM ".$this->MySQL->get_tablePrefix()."console_members WHERE console_id = '".$this->intTableKeyValue."'");
			$result = $this->MySQL->query("DELETE FROM ".$this->MySQL->get_tablePrefix()."rank_privileges WHERE console_id = '".$this->intTableKeyValue."'");
			
			
			if(!$this->MySQL->error) {
				$returnVal = true;
			}
			else {
				$this->MySQL->displayError("basic.php");
			}
	
		}
	
		return $returnVal;
	
	}
	
	
	
}




?>