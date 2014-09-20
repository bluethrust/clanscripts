<?php

	class GuildWarsMenu extends btThemeMenu {
		
		public function __construct($sqlConnection) {
			
			parent::__construct("guildwars", $sqlConnection);	
			
		}

		public function displayLink() {
			
			if($this->intMenuSection == 3) {
				$menuLinkInfo = $this->menuItemObj->objLink->get_info();
				$checkURL = parse_url($menuLinkInfo['link']);
				
				if(!isset($checkURL['scheme']) || $checkURL['scheme'] = "") {
					$menuLinkInfo['link'] = MAIN_ROOT.$menuLinkInfo['link'];
				}
				echo "<div style='display: inline-block; vertical-align: middle; height: 50px; padding-right: 20px'><a href='".$menuLinkInfo['link']."' target='".$menuLinkInfo['linktarget']."'>".$menuItemInfo['name']."</a></div>";
			}
			else {
				parent::displayLink();	
			}
			
		}
		
		
		public function displayMenuCategory($loc="top") {
			
			$menuCatInfo = $this->menuCatObj->get_info();
			if($loc == "top") {
				echo $this->getHeaderCode($menuCatInfo);
			}
			else {
				echo "<br>";
			}
			
		}
		
		
		public function displayLoggedOut() {
			
			echo "
			
			<form action='".MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
				<div class='usernameIMG'></div>
				<div class='usernameTextDiv'>
					<input name='user' type='text' class='loginTextbox'>			
				</div>
				
				<div class='passwordIMG'></div>
				<div class='passwordTextDiv'>
					<input name='pass' type='password' class='loginTextbox'>
				</div>
				
				<div class='rememberMeCheckBox' id='fakeRememberMe'></div>
				<div class='rememberMeIMG'></div>
				<div id='fakeSubmit' class='loginButton'></div>
				<input type='checkbox' name='rememberme' value='1' id='realRememberMe' style='display: none'>
				<input type='submit' name='submit' id='realSubmit' style='display: none' value='Log In'>
			</form>
			
			";
			
		}
		
		public function displayLoggedIn() {
			echo "
			
				<div class='loggedInIMG'></div>
				<div class='loggedInProfilePic'>".$this->memberObj->getProfilePic("45px", "60px")."</div>
				<div class='loggedInMemberNameIMG'></div>
				<div class='loggedInMemberNameText'>
					".$this->memberObj->getMemberLink(array("color" => "false"))."
				</div>
				<div class='loggedInRankIMG'></div>
				<div class='loggedInRankText'>
					".$this->data['memberRank']."
				</div>
				
				<div class='loggedInMemberOptionsSection'>
					<div class='loggedInMemberOptionsIMG'></div>
					<div class='loggedInMemberOptions'>
					
						<a href='".MAIN_ROOT."members'>My Account</a> - ".$this->data['pmLink']." - <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a><br>	
					
					</div>
				</div>

			";
		}
		
		
		
	}


?>