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


include_once("basic.php");


class ForumPost extends Basic {
	
	
	public function __construct($sqlConnection) {
		
		$this->MySQL = $sqlConnection;
		$this->strTableName = $this->MySQL->get_tablePrefix()."forum_post";
		$this->strTableKey = "forumpost_id";
			
		
	}
	
	
	public function addNew($arrColumns, $arrValues) {
		
		$returnVal = false;
		$addNew = parent::addNew($arrColumns, $arrValues);
		
		if($addNew) {
			$this->MySQL->query("DELETE FROM ".$this->MySQL->get_tablePrefix()."forum_topicseen WHERE forumtopic_id = '".$this->arrObjInfo['forumtopic_id']."'");
			$this->MySQL->query("OPTIMIZE TABLE `".$this->MySQL->get_tablePrefix()."forum_topicseen`");
			$returnVal = true;
		}
		
		
		return $returnVal;
		
	}
	
	public function getPostAttachments() {
	
		$returnArr = array();
		
		if($this->intTableKeyValue != "") {
		
			$result = $this->MySQL->query("SELECT download_id FROM ".$this->MySQL->get_tablePrefix()."forum_attachments WHERE forumpost_id = '".$this->intTableKeyValue."'");
			while($row = $result->fetch_assoc()) {
				$returnArr[] = $row['download_id'];				
			}
			
		}
		
		return $returnArr;
		
	}
	
	
}



?>