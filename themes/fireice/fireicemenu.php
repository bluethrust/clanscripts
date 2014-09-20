<?php

	class FireIceMenu extends btThemeMenu {
		
		private $intMenu3Counter = 0;
		
		public function __construct($sqlConnection) {
			
			parent::__construct("bluegrid", $sqlConnection);	
			
		}
		
		
		public function displayLink() {
			
			if($this->intMenuSection == 3) {
				
				$menuLinkInfo = $this->menuItemObj->objLink->get_info();
				$checkURL = parse_url($menuLinkInfo['link']);
				
				if(!isset($checkURL['scheme']) || $checkURL['scheme'] = "") {
					$menuLinkInfo['link'] = MAIN_ROOT.$menuLinkInfo['link'];
				}
				
				
				if($this->intMenu3Counter > 0) {
					echo "<div class='menuSeparator'></div>";	
				}
				$this->intMenu3Counter++;
				echo "<div style='display: inline-block; vertical-align: middle; height: 50px'><a href='".$menuLinkInfo['link']."' target='".$menuLinkInfo['linktarget']."'>".$this->menuItemInfo['name']."</a></div>";
				
			}
			else {

				parent::displayLink();
				
			}
			
		}
		
		
		public function displayMenuCategory($loc="top") {
			
			$menuCatInfo = $this->menuCatObj->get_info();
			
			$this->intMenu3Counter = 0;
			if($loc == "top") {
				
				echo $this->getHeaderCode($menuCatInfo);
				
			}
			else {
				
				echo "<br>";
				
				
			}
			
			
		}
		
		
		public function displayLoggedOut() {
			echo "
				<form action='".$MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
					<div class='rememberMe_Off' id='rememberMeDiv'></div>
					<div style='position: relative; top: 8px; left: 10px'>
						<div class='loginUsernameImg'></div>
						<input type='text' name='user' class='loginTextbox'>
						<div class='loginPasswordImg'></div>
						<input type='password' name='pass' class='loginTextbox'>
					</div>
					
					<div class='loginRememberMeImg'></div>
					<div class='loginButton' id='btnFakeLogin'></div>
					<input type='submit' name='submit' value='submit' style='display: none' id='btnRealSubmit'>
					<div class='loginRememberMeCheckbox' id='chkRememberMe'></div>
					<input type='hidden' name='remember' value='0' id='rememberMeHidden'>
				</form>

			";
			
		}
		
		public function displayLoggedIn() {
			
			echo "
			
				<div style='position: relative; top: 8px; left: 15px'>
			
					<div class='fireIceMemberPic' style='float: left; width: 75px; height: 75px'>
						".$this->memberObj->getProfilePic("56px", "75px")."
					</div>
			
					<div style='float: left; width: 175px; overflow: hidden; text-overflow: ellipsis; height: 28px'>
						<b>Account Name:</b><br>
						<a href='".MAIN_ROOT."profile.php?mID=".$this->data['memberInfo']['member_id']."'>".$this->data['memberInfo']['username']."</a>
					</div>
					<div style='float: left; width: 175px; overflow: hidden; text-overflow: ellipsis; height: 28px'>
						<b>Rank:</b><br>
						".$this->data['memberRank']."
					</div>
					
					<div style='clear: both'></div>
					<div style='position: absolute; top: 40px; left: 75px; width: 400px'>
						<b>Member Options:</b>
						<p style='margin: 0px; padding: 0px'>
							<a href='".MAIN_ROOT."members'>My Account</a> - 
							<span id='pmLoggedInLink'>".$this->data['pmLink']."</span> - 
							<a href='".MAIN_ROOT."members/signout.php'>Sign Out</a>
						</p>
					</div>
				</div>
			
			
			";
			
		}
		
		
	}


?>