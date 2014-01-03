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


class News extends Basic {
	
	
	protected $strCommentTableName;
	protected $strCommentTableKey;
	public $objComment;
	
	
	public function __construct($sqlConnection, $newsTableName="news", $newsTableKey="news_id", $commentTableName="comments", $commentTableKey="comment_id") {
		
		$this->MySQL = $sqlConnection;
		$this->strTableName = $this->MySQL->get_tablePrefix().$newsTableName;
		$this->strTableKey = $newsTableKey;
		
		$this->strCommentTableName = $this->MySQL->get_tablePrefix().$commentTableName;
		$this->strCommentTableKey = $commentTableKey;
		
		$this->objComment = new Basic($sqlConnection, $commentTableName, $this->strCommentTableKey);

	}
	
	
	
	
	public function getComments($orderBY="") {
	
		$returnArr = array();
		
		if($orderBY == "") {
			$orderBY = " ORDER BY dateposted DESC";	
		}
		
		if($this->intTableKeyValue != "") {
			
			
			$result = $this->MySQL->query("SELECT * FROM ".$this->strCommentTableName." WHERE ".$this->strTableKey." = '".$this->intTableKeyValue."'".$orderBY);
			while($row = $result->fetch_assoc()) {
				$returnArr[] = $row[$this->strCommentTableKey];
			}
			
		}
		
		return $returnArr;
		
	}
	
	
	public function countComments() {
		
		$returnVal = 0;
		
		if($this->intTableKeyValue != "") {
			
			$result = $this->MySQL->query("SELECT * FROM ".$this->strCommentTableName." WHERE ".$this->strTableKey." = '".$this->intTableKeyValue."'");
			
			$returnVal = $result->num_rows;
			
			
		}
		
		return $returnVal;
		
	}
	
	
	
	public function postComment($intMemberID, $strMessage) {
		
		$returnVal = false;

		if(is_numeric($intMemberID) && $this->intTableKeyValue != "" && trim($strMessage) != "") {
			
			if($this->objComment->addNew(array($this->strTableKey, "member_id", "message", "dateposted"), array($this->intTableKeyValue, $intMemberID, $strMessage, time()))) {
				$returnVal = true;
			}
			
		}
		
		return $returnVal;
		
	}
	

	public function delete() {
		
		$returnVal = false;
		if($this->intTableKeyValue != "") {
			
			
			$result1 = $this->MySQL->query("DELETE FROM ".$this->strTableName." WHERE ".$this->strTableKey." = '".$this->intTableKeyValue."'");
			$result2 = $this->MySQL->query("DELETE FROM ".$this->strCommentTableName." WHERE ".$this->strTableKey." = '".$this->intTableKeyValue."'");
			
			
			if($result1 && $result2) {
				$returnVal = true;	
			}
			
		}
		
		
		return $returnVal;
		
		
	}
	
	
}