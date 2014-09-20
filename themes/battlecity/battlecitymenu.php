<?php


	class BattleCityMenu extends btThemeMenu {
		
		
		public function __construct($sqlConnection) {
			
			parent::__construct("battlecity", $sqlConnection);	
			
		}
		
		
		public function displayMenuCategory($loc="top") {
			
			$menuCatInfo = $this->menuCatObj->get_info();
			
			if($loc == "top") {
				
				echo $this->getHeaderCode($menuCatInfo);
		
				if($this->intMenuSection == 0 || $this->intMenuSection == 1) {
					echo "<div class='menuContentDiv'>";
				}	
				
				
				
			}
			else {
				
				if($this->intMenuSection == 0 || $this->intMenuSection == 1) {
					echo "</div>";	
				}
				elseif($this->intMenuSection == 3) {
					echo "<img src='".MAIN_ROOT."themes/battlecity/images/layout/top-menu-arrow.png' class='topMenu_Arrow'>";	
				}	
						
				
			}
			
		}
		
		
		public function displayLoggedOut() {
			
			echo "
				<form action='".MAIN_ROOT."login.php' method='post'>
		
					<div class='loginTitle'></div>
					<div class='loginUsernameIMG'></div>
					<div class='loginUsernameTextboxDiv' >
						<input type='text' name='user' class='loginTextbox'>
					</div>
					
					<div class='loginPasswordIMG'></div>
					<div class='loginPasswordTextboxDiv' >
						<input type='password' name='pass' class='loginTextbox'>
					</div>
					
					<div class='rememberMeIMG'></div>
					<div class='rememberMeCheckbox' id='fakeRememberMe'></div>
					<div class='loginButton' id='btnFakeLoginSubmit'></div>
					<input type='hidden' value='0' id='realRememberMe' name='rememberme'>
					<input type='submit' name='submit' value='submit' id='btnRealLoginSubmit' style='display: none'>
				
				</form>
			";
			
		}
		
		public function displayLoggedIn() {
			echo "
				<div class='loggedinTitle'></div>
				<div class='loggedinUserInfo'>
					".$arrLoginInfo['memberRank']."<br>
					<a href='".MAIN_ROOT."profile.php?mID=".$this->data['memberInfo']['member_id']."'>".$this->data['memberInfo']['username']."</a>
				</div>
				<div class='loggedinUserLinks'>
					<a href='".MAIN_ROOT."members'>MY ACCOUNT</a> - <a href='".MAIN_ROOT."members/console.php?cID=".$this->data['pmCID']."'>PM INBOX ".$this->data['pmCountDisp']."</a><span style='font-size: 5px'><br><br></span><a href='".MAIN_ROOT."members/signout.php'>SIGN OUT</a>
				</div>
			";			
		}
		
		
		
		
	}


?>