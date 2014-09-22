<?php

	class GTABeachMenu extends btThemeMenu {
		
		
		public function __construct($sqlConnection) {
			
			parent::__construct("gtabeach", $sqlConnection);	
			
		}
		
		public function displayMenuCategory($loc="top") {
			
			$menuCatInfo = $this->menuCatObj->get_info();
			
			if($loc == "top") {
				
				if($this->intMenuSection == 0) {
					echo "
						<div class='topMenuItemWrapper'><div class='topMenuItem'>
					";
				}
				elseif($this->intMenuSection == 1) {
		
					echo "<div class='menuTitleDiv'>";
					
				}
					
				echo $this->getHeaderCode($menuCatInfo);
				
				
					
				if($this->intMenuSection == 0 && count($this->arrMenuItems) > 0) {
					echo "
						<div class='topMenuItemContent' style='display: none'>
					";
				}
				elseif($this->intMenuSection == 1) {
		
					echo "
						</div>
						<div class='menuContentDiv'>
					";
					
				}
				
				
				
			}
			else {
				
				if($this->intMenuSection == 0 && count($this->arrMenuItems) > 0) {			
					echo "</div>";
				}
				
				
				if($this->intMenuSection == 0) {
		
					echo "</div></div>";
					
				}
				elseif($this->intMenuSection == 1) {
					echo "</div>";	
				}

			}
			
		}
		
		
		public function displayLoggedOut() {
			echo "
			<form action='".MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
				<div class='loginTitle'></div>
					
				<div class='usernameImgText'></div>
				<div class='loginUsernameTextbox'>
					<input type='text' name='user' class='loginTextbox'>
				</div>
				
				
				<div class='passwordImgText'></div>
				<div class='loginPasswordTextbox'>
					<input type='password' name='pass' class='loginTextbox'>
				</div>
				
				<div class='rememberMeCheckbox' id='fakeRememberMe'></div>
				<div class='rememberMeImgText'></div>
				
				<input type='hidden' name='rememberme' value='0' id='realRememberMe'>
				
				<div class='loginButton' id='btnFakeLoginSubmit'></div>
				<input type='submit' name='submit' id='btnLoginSubmit' style='display: none'>
			</form>
			";	
		}
		
		public function displayLoggedIn() {
			
			$hideAlertImg = ($this->data['pmAlert'] != 1) ? " style='display: none'" : "";
			echo "
			
				<div class='loggedinTitle'></div>
				<div class='loggedInUsername'>
					".$this->data['memberInfo']['username']."
				</div>
				
				<a href='".MAIN_ROOT."members'><div class='loggedin_myAccountButton'></div></a>
				<a href='".MAIN_ROOT."members/console.php?cID=".$this->data['pmCID']."'><div class='loggedin_pmInboxButton'><div class='loggedin_pmAlert'".$hideAlertImg."></div></div></a>
				<a href='".$this->memberObj->getMemberLink(array("wrapper" => false))."'><div class='loggedin_profileButton'></div></a>
				<a href='".MAIN_ROOT."members/signout.php'><div class='loggedin_logOutButton'></div></a>
			
			";
			
		}
		
		
	}

?>