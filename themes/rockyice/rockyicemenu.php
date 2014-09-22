<?php

	class RockyIceMenu extends btThemeMenu {

		private $intMenu3Counter = 0;
		
		public function __construct($sqlConnection) {
			
			parent::__construct("rockyice", $sqlConnection);	
			
		}
		
		public function displayMenuItem() {
			
			$menuItemInfo = $this->menuItemObj->get_info();
			
			if($this->intMenuSection == 3 && $menuItemInfo['itemtype'] == "link") {

				if($this->intMenu3Counter > 0) {
					echo "<div class='menuSeparator'></div>";	
				}
				
				echo "<div style='display: inline-block; vertical-align: middle; height: 50px'><a href='".$menuLinkInfo['link']."' target='".$menuLinkInfo['linktarget']."'>".$menuItemInfo['name']."</a></div>";

			}
			else {
				
				parent::displayMenuItem();	
				
			}
			
			
			if($this->intMenuSection == 3 && (count($this->arrMenuItems)-1) != $this->intMenu3Counter) {
				$this->intMenu3Counter++;	
				echo "<img src='".MAIN_ROOT."images/transparent.png' class='topMenuItemSep'>";	
			}
			
		}
		
		
		public function displayMenuCategory($loc="top") {
			// Placeholder function
			
			$menuCatInfo = $this->menuCatObj->get_info();
			
			if($loc == "top") {
				
				if($menuCatInfo['headertype'] == "image") {
					
					echo "<div class='menuTitleWrapper'><div class='menuTitleDiv'>";
					echo "<img src='".MAIN_ROOT.$menuCatInfo['headercode']."'>";
					echo "</div></div>";
					
				}
				else {
					
					$menuCatInfo['headercode'] = $this->replaceKeywords($menuCatInfo['headercode']);
					echo $menuCatInfo['headercode'];
				}
			
				
				
				if($this->intMenuSection == 0 || $this->intMenuSection == 1) {
					echo "<div class='menuContent'>";
				}
				
				
			}
			elseif($this->intMenuSection == 0 || $this->intMenuSection == 1) {
				
				echo "</div>";	
				
			}
			
			
		}
		
		
		public function displayLoggedOut() {

			echo "
			<div class='loginSectionLeft'>
			
				<a href='".MAIN_ROOT."signup.php'><img src='".MAIN_ROOT."images/transparent.png' class='signUpButton'></a>
			
			</div>
			
			<form action='".MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
			<div class='loginSectionRight'>
			
				<div class='loginInnerDiv'>
					<input type='text' name='user' placeholder='Username''>	
					<input type='password' name='pass' placeholder='Password'>	
				</div>
			
				<div class='loginInnerDiv'>
					<img src='".MAIN_ROOT."images/transparent.png' class='rememberMeImg' id='fakeRememberMe'><br>
					<img src='".MAIN_ROOT."images/transparent.png' class='loginButton' id='btnFakeLoginSubmit'>
					<input type='hidden' name='rememberme' id='realRememberMe'>
					<input type='submit' name='submit' value='submit' style='display: none' id='btnLoginSubmit'>
				</div>
				
				
			</div>
			</form>
			";
			
		}
		
		public function displayLoggedIn() {
			// Placeholder function
			
			echo "

				<div class='loginSectionLeft'>
					<div class='loginSectionAvatar'>
						".$this->memberObj->getAvatar()."
					</div>
					<div class='loginInnerDiv loginSectionLoggedInUser'>
						".$this->data['memberRank']." ".$this->memberObj->getMemberLink()."
					</div>
				</div>
				
		
				<div class='loginSectionRight'>
				
					<div class='loginSectionLoggedInOptions'><p align='center'><b>Member Options:</b></p>
						<a href='".MAIN_ROOT."members'>My Account</a> - ".$this->data['pmLink']." - <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a>
					</div>
					
				</div>
		

			";
		}
		
		
		
	}

?>