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


class ForumPost extends Basic {
	
	public $objTopic;
	public $blnManageable = false;
	
	public function __construct($sqlConnection) {
		
		$this->MySQL = $sqlConnection;
		$this->strTableName = $this->MySQL->get_tablePrefix()."forum_post";
		$this->strTableKey = "forumpost_id";
		
		$this->objTopic = new BasicOrder($sqlConnection, "forum_topic", "forumtopic_id");
		
		$this->objTopic->set_assocTableName("forum_post");
		$this->objTopic->set_assocTableKey("forumpost_id");
				
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
	
	public function select($intIDNum, $numericIDOnly = true) {

		$this->blnManageable = false;
		
		return parent::select($intIDNum, $numericIDOnly);
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
	
	public function show($template="") {
		global $websiteInfo, $MAIN_ROOT, $dbprefix, $mysqli, $member;
		if($template == "") {
			
			include("templates/post.php");
			
		}
		else {
			include("templates/".$template);
		}
		
	}

	public function getTopicInfo($filtered=false) {
		$returnArr = array();
		if($this->intTableKeyValue != "") {
		
			$temp = $this->intTableKeyValue;
			$tempManage = $this->blnManageable;
			$this->objTopic->select($this->arrObjInfo['forumtopic_id']);
			$this->select($this->objTopic->get_info("forumpost_id"));
			
			$returnArr = $filtered ? $this->get_info_filtered() : $this->get_info();
			
			$this->select($temp);
			$this->blnManageable = $tempManage;
		}
		
		return $returnArr;
	}
	
}



?>