<?php

	class RoboRedMenu extends btThemeMenu {
		
		
		public function __construct($sqlConnection) {
		
			parent::__construct("robored", $sqlConnection);
		
		}
		
		
		public function displayLink() {
			$menuLinkInfo = $this->menuItemObj->objLink->get_info();
			$checkURL = parse_url($menuLinkInfo['link']);
		
			if(!isset($checkURL['scheme']) || $checkURL['scheme'] = "") {
				$menuLinkInfo['link'] = MAIN_ROOT.$menuLinkInfo['link'];
			}
		
		
			echo "
			<div style='text-align: ".$menuLinkInfo['textalign']."'>
			".$menuLinkInfo['prefix']."<a href='".$menuLinkInfo['link']."' target='".$menuLinkInfo['linktarget']."'>".$this->menuItemInfo['name']."</a>
			</div>
			";
		}
		
		public function displayCustomFormLink() {
			$customFormObj = new CustomForm($this->MySQL);
			$menuCustomFormInfo = $this->menuItemObj->objCustomPage->get_info();
			$customFormObj->select($menuCustomFormInfo['custompage_id']);
			echo "
			<div style='text-align: ".$menuCustomFormInfo['textalign']."'>
			".$menuCustomFormInfo['prefix']."<a href='".MAIN_ROOT."customform.php?pID=".$menuCustomFormInfo['custompage_id']."' target='".$menuCustomFormInfo['linktarget']."'>".$customFormObj->get_info_filtered("name")."</a>
			</div>
			";
		
		}
		
		
		public function displayCustomPageLink() {
			$customPageObj = new Basic($this->MySQL, "custompages", "custompage_id");
			$menuCustomPageInfo = $this->menuItemObj->objCustomPage->get_info();
			$customPageObj->select($menuCustomPageInfo['custompage_id']);
			echo "
			<div style='text-align: ".$menuCustomPageInfo['textalign']."'>
			".$menuCustomPageInfo['prefix']."<a href='".MAIN_ROOT."custompage.php?pID=".$menuCustomPageInfo['custompage_id']."' target='".$menuCustomPageInfo['linktarget']."'>".$customPageObj->get_info_filtered("pagename")."</a>
			</div>
			";
		
		}
		
		
		public function displayDownloadPageLink() {
		
			$downloadCatObj = new DownloadCategory($this->MySQL);
			$menuDownloadLinkInfo = $this->menuItemObj->objCustomPage->get_info();
			$downloadCatObj->select($menuDownloadLinkInfo['custompage_id']);
			echo "
			<div style='text-align: ".$menuDownloadLinkInfo['textalign']."'>
			".$menuDownloadLinkInfo['prefix']."<a href='".MAIN_ROOT."downloads/index.php?catID=".$menuDownloadLinkInfo['custompage_id']."' target='".$menuDownloadLinkInfo['linktarget']."'>".$downloadCatObj->get_info_filtered("name")."</a>
			</div>
			";
		
		}
		
		public function displayTopPlayers() {
		
			echo "
			<span>
			<b>&middot;</b> <a href='".MAIN_ROOT."top-players/recruiters.php'>Recruiters</a>
			</span><br>
			";
			$hpGameObj = new Game($this->MySQL);
			$arrGames = $hpGameObj->getGameList();
			foreach($arrGames as $gameID) {
				$hpGameObj->select($gameID);
				echo "
				<span>
				<b>&middot;</b> <a href='".MAIN_ROOT."top-players/game.php?gID=".$gameID."'>".$hpGameObj->get_info_filtered("name")."</a>
				</span><br>
				";
			}
		
		
		}
		
		public function displayMenuCategory($loc="top") {
			
			$menuCatInfo = $this->menuCatObj->get_info();
			
			if($loc == "top") {
				
				echo $this->getHeaderCode($menuCatInfo);
				echo "<div class='menuLinks'>";
				
			}
			else {
				echo "</div>";
			}
		
		}
		
		
		public function displayLoggedIn() {
			
			echo "
			
			<div class='menuLinks' style='padding-left: 8px'>
				<b>Account Name:</b><br>
				".$this->memberObj->getMemberLink(array("color"=>false))."
				<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
				<b>Rank:</b><br>
				".$this->data['memberRank']."
				<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
				<b>Member Options:</b><br>
				<b>&middot;</b> <a href='".MAIN_ROOT."members'>My Account</a><br>
				<b>&middot;</b> ".$this->data['pmLink']."<br>
				<b>&middot;</b> <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a><br>		
			</div>
			
			";
		
		}
		
		public function displayLoggedOut() {
			
			echo "
			
			<form action='".MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
			<div class='menuLinks' style='padding-left: 8px'>
				Username:<br>
				<input type='text' name='user' class='textBox'><br>
				Password:<br>
				<input type='password' name='pass' class='textBox'><br>
				Remember Me: <input type='checkbox' name='rememberme' value='1'><br>
				<input type='submit' name='submit' value='Log In' class='submitButton' style='width: 70px'>
			</div>
			</form>
			
			";
		
		}
		
		
	}


?>