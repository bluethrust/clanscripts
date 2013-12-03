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
include_once("basicorder.php");

include_once("forumpost.php");

class ForumBoard extends BasicSort {
	
	public $objPost;
	public $objTopic;
	public $objMemberAccess;
	public $objRankAccess;
	public $objMod;
	
	public function __construct($sqlConnection) {
		$this->MySQL = $sqlConnection;
		$this->strTableName = $this->MySQL->get_tablePrefix()."forum_board";
		$this->strTableKey = "forumboard_id";
		$this->strCategoryKey = "forumcategory_id";
		
		$this->objPost = new ForumPost($sqlConnection);
		$this->objTopic = new BasicOrder($sqlConnection, "forum_topic", "forumtopic_id");
		
		$this->objTopic->set_assocTableName("forum_post");
		$this->objTopic->set_assocTableKey("forumpost_id");
		
		
		$this->objMemberAccess = new Basic($sqlConnection, "forum_memberaccess", "forummemberaccess_id");
		$this->objRankAccess = new Basic($sqlConnection, "forum_rankaccess", "forumrankaccess_id");
		
		$this->objMod = new Basic($sqlConnection, "forum_moderator", "forummoderator_id");
		
	}
		
	
	public function delete() {
		
		$returnVal = false;
		if($this->intTableKeyValue != "") {

			$result[] = $this->MySQL->query("DELETE FROM ".$this->MySQL->get_tablePrefix()."forum_post WHERE forumboard_id = '".$this->intTableKeyValue."'");	
			$result[] = $this->MySQL->query("DELETE FROM ".$this->MySQL->get_tablePrefix()."forum_topic WHERE forumboard_id = '".$this->intTableKeyValue."'");
			$result[] = $this->MySQL->query("DELETE FROM ".$this->MySQL->get_tablePrefix()."forum_rankaccess WHERE board_id = '".$this->intTableKeyValue."'");
			$result[] = $this->MySQL->query("DELETE FROM ".$this->MySQL->get_tablePrefix()."forum_memberaccess WHERE board_id = '".$this->intTableKeyValue."'");
			$result[] = parent::delete();
			
			
			if(!in_array(false, $result)) {
				$returnVal = true;	
			}
			
		}
		
		return $returnVal;
		
	}
	
	/*
	 * - secureBoard Method -
	 * 
	 * Used when adding or editing a board to the forum.  Adds the allowed ranks and members to the database.
	 * 
	 * Returns true on success and false on failure
	 */
	
	public function secureBoard($arrRanks, $arrMembers) {
		
		$returnVal = false;
		$countErrors = 0;
		if($this->intTableKeyValue != "") {
			
			$result = $this->MySQL->query("DELETE FROM ".$this->MySQL->get_tablePrefix()."forum_rankaccess WHERE board_id = '".$this->intTableKeyValue."'");
			$arrColumns = array("rank_id", "board_id");
			foreach($arrRanks as $rankID) {
				$arrValues = array($rankID, $this->intTableKeyValue);
				if(!$this->objRankAccess->addNew($arrColumns, $arrValues)) {
					$countErrors++;
					break;
				}
			}
			
			if($countErrors == 0) {
				
				$result = $this->MySQL->query("DELETE FROM ".$this->MySQL->get_tablePrefix()."forum_memberaccess WHERE board_id = '".$this->intTableKeyValue."'");
				
				$arrColumns = array("member_id", "board_id", "accessrule");
				foreach($arrMembers as $memberID => $accessRule) {
					$arrValues = array($memberID, $this->intTableKeyValue, $accessRule);
					if(!$this->objMemberAccess->addNew($arrColumns, $arrValues)) {
						$countErrors++;
						break;
					}
				}				
			}
			
			
			$this->MySQL->query("OPTIMIZE TABLE `".$this->MySQL->get_tablePrefix()."forum_rankaccess`");
			$this->MySQL->query("OPTIMIZE TABLE `".$this->MySQL->get_tablePrefix()."forum_memberaccess`");
			
			
			if($countErrors == 0) {
				$returnVal = true;	
			}
			
		}
		
		return $returnVal;
	}
	
	public function getMemberAccessRules() {
		
		$returnArr = array();
		if($this->intTableKeyValue != "") {
			
			$result = $this->MySQL->query("SELECT * FROM ".$dbprefix."forum_memberaccess WHERE board_id = '".$this->intTableKeyValue."'");
			while($row = $result->fetch_assoc()) {
				
				$returnArr[$row['member_id']] = $row['accessrule'];
				
			}

		}
		
		return $returnArr;
	}
	
	
	public function getRankAccessRules() {
	
		$returnArr = array();
		if($this->intTableKeyValue != "") {
	
			$result = $this->MySQL->query("SELECT * FROM ".$dbprefix."forum_rankaccess WHERE board_id = '".$this->intTableKeyValue."'");
			while($row = $result->fetch_assoc()) {
	
				$returnArr[] = $row['rank_id'];
	
			}
			
			
		}
	
		return $returnArr;
	}
	
	public function memberHasAccess($memberInfo) {
		
		$returnVal = false;
		if($this->intTableKeyValue != "") {
			
			if($this->arrObjInfo['accesstype'] == 1) {
				$checkCount = 0;
				
				if(in_array($memberInfo['rank_id'], $this->getRankAccessRules()) || $memberInfo['rank_id'] == 1) {
					$checkCount++;
				}
				
				$arrMembers = $this->getMemberAccessRules();
				if(isset($arrMembers[$memberInfo['member_id']]) && $arrMembers[$memberInfo['member_id']] !== 0) {
					$checkCount++;
				}
				
				if($checkCount > 0) {
					$returnVal = true;	
				}
				
			}
			else {
				$returnVal = true;	
			}
			
			
		}
		
		return $returnVal;
		
	}
	
	
	/*
	 * - memberIsMod Function -
	 * 
	 * Checks if a member is a mod of the selected board.
	 * Returns true if yes, false if no
	 */
	
	public function memberIsMod($memberID, $returnForumModeratorID=false) {

		$returnVal = false;
		if($this->intTableKeyValue != "" && is_numeric($memberID)) {
			
			$result = $this->MySQL->query("SELECT forummoderator_id FROM ".$this->MySQL->get_tablePrefix()."forum_moderator WHERE member_id = '".$memberID."' AND forumboard_id = '".$this->intTableKeyValue."'");
			if($result->num_rows > 0 && !$returnForumModeratorID) {
				$returnVal = true;	
			}
			elseif($result->num_rows > 0 && $returnForumModeratorID) {
				$row = $result->fetch_assoc();
				$returnVal = $row['forummoderator_id'];
			}
			
		}
		
		return $returnVal;
		
	}
	
	/*
	 * - getForumTopics Function -
	 * 
	 * Returns an array of forum topics sorted by the last post's date
	 */
	
	public function getForumTopics($sqlORDERBY = "", $sqlLIMIT = "") {
		
		$returnArr = array();
		
		if($sqlORDERBY == "") {
			$sqlORDERBY = " fp.dateposted DESC";	
		}

		
		if($this->intTableKeyValue != "") {
		
			$result = $this->MySQL->query("SELECT ft.forumpost_id, ft.lastpost_id, fp.dateposted FROM ".$this->MySQL->get_tablePrefix()."forum_topic ft,  ".$this->MySQL->get_tablePrefix()."forum_post fp WHERE forumboard_id = '".$this->intTableKeyValue."' AND fp.forumpost_id = ft.lastpost_id ORDER BY ".$sqlORDERBY.$sqlLIMIT);
			while($row = $result->fetch_assoc()) {
				
				//$this->objPost->select($row['lastpost_id']);
				//$datePosted = $this->objPost->get_info("dateposted");
				
				$returnArr[] = $row['forumpost_id'];
				
			}
			
			
			//arsort($returnArr);
			
		}
		
		return $returnArr;
	}

	
	public function hasNewTopics($memberID) {
		
		$returnVal = false;
		if($this->intTableKeyValue != "" && is_numeric($memberID)) {
			
			$checkTime = time()-(60*60*24*7); // Checking topics with last posts dated within the last week
			$arrNewTopics = array();
			$result = $this->MySQL->query("SELECT ft.forumtopic_id FROM ".$this->MySQL->get_tablePrefix()."forum_topic ft, ".$this->MySQL->get_tablePrefix()."forum_post fp WHERE forumboard_id = '".$this->intTableKeyValue."' AND fp.forumpost_id = ft.lastpost_id AND fp.dateposted > '".$checkTime."'");
			while($row = $result->fetch_assoc()) {
				$arrNewTopics[] = $row['forumtopic_id'];	
			}
			
			if(count($arrNewTopics) > 0) {
				$sqlTopicIDs = "('".implode("','", $arrNewTopics)."')";
				$result = $this->MySQL->query("SELECT forumtopic_id FROM ".$this->MySQL->get_tablePrefix()."forum_topicseen WHERE member_id = '".$memberID."' AND forumtopic_id IN ".$sqlTopicIDs);
			
				if($result->num_rows != count($arrNewTopics)) {
					$returnVal = true;	
				}
			}
			
		}
		
		return $returnVal;
	}
	
	public function countTopics() {
		
		$returnVal = 0;
		if($this->intTableKeyValue != "") {
		
			$result = $this->MySQL->query("SELECT forumtopic_id FROM ".$this->MySQL->get_tablePrefix()."forum_topic WHERE forumboard_id = '".$this->intTableKeyValue."'");
			
			$returnVal = $result->num_rows;
		}
		
		return $returnVal;
	}
	
	public function countPosts() {
		
		$returnVal = 0;
		if($this->intTableKeyValue != "") {
		
			$result = $this->MySQL->query("SELECT fp.forumpost_id FROM ".$this->MySQL->get_tablePrefix()."forum_post fp, ".$this->MySQL->get_tablePrefix()."forum_topic ft WHERE forumboard_id = '".$this->intTableKeyValue."' AND fp.forumtopic_id = ft.forumtopic_id");
		
			$returnVal = $result->num_rows;
		}
		
		return $returnVal;

	}
	
	public function addMod($memberID) {
		
		$returnVal = false;
		if($this->intTableKeyValue != "" && is_numeric($memberID) && !$this->memberIsMod($memberID)) {
			$returnVal = $this->objMod->addNew(array("member_id", "forumboard_id", "dateadded"), array($memberID, $this->intTableKeyValue, time()));
		}
		
		return $returnVal;
		
	}
	
	public function removeMod($memberID) {
		
		$returnVal = false;
		$checkMod = $this->memberIsMod($memberID, true);
		
		if($this->intTableKeyValue != "" && $checkMod !== false) {

			$this->objMod->select($checkMod);
			$returnVal = $this->objMod->delete();

		}
		
		return $returnVal;

	}

	
}