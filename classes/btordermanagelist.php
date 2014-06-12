<?php


	class btOrderManageList {
		
		
		protected $objManage;
		protected $objConsole;
		protected $intSelectedID;
		public $strMainListLink;
		public $intAddCID;
		public $strItemTitle;
		public $strEditItemLink;		
		public $strDeleteLink;
		public $arrActionList;
		public $blnConfirmDelete = true;
		public $strDeletePostVarID;
		public $strDeleteName;
		public $strListDiv = "manageListDiv";
		public $orderBy = "ordernum DESC";
		
		
		public function __construct($obj) {

			$this->objManage = $obj;
			
			$this->objConsole = new ConsoleOption($obj->get_MySQL());
		
		}
		
		public function select($id) {
			$returnVal = false;
			if($this->objManage->select($id)) {
				$this->intSelectedID = $id;
				$returnVal = true;
			}
			return $returnVal;
		}
		
		public function move($direction) {
			return $this->objManage->move($direction);
		}
		
		
		public function delete() {
			return $this->objManage->delete();	
		}
		
		
		public function getListArray() {
		
			$arrItems = array();
			$arrInfo = $this->objManage->get_entries(array(), $this->orderBy);
			$x = 0;
			foreach($arrInfo as $info) {
						
				$actionsInfo = array();
				if($x != 0) {
					$actionsInfo[] = "moveup";
				}
				
				if($x != (count($arrInfo)-1)) {
					$actionsInfo[] = "movedown";	
				}
				
				$actionsInfo[] = "edit";
				$actionsInfo[] = "delete";
				
				$x++;
				
				
				$arrItems[] = array(
					"display_name" => $info['name'],
					"item_id" => $info[$this->objManage->get_tableKey()],
					"type" => "listitem",
					"edit_link" => $this->strEditItemLink.$info[$this->objManage->get_tableKey()]."&action=edit",
					"actions" => $actionsInfo
				);
				
				
			}
			
			$this->objConsole->select($this->intAddCID);
			$setupManageListArgs = array(
				"item_title" => $this->strItemTitle,
				"add_new_link" => array("url" => MAIN_ROOT."members/console.php?cID=".$this->intAddCID, "name" => $this->objConsole->get_info_filtered("pagetitle")),
				"actions" => $this->arrActionList,
				"delete_link" => $this->strDeleteLink,
				"items" => $arrItems,
				"confirm_delete" => $this->blnConfirmDelete
			);
			
			
			return $setupManageListArgs;
		}
	
		public function getID() {
			return $this->intSelectedID;
		}
	}


?>