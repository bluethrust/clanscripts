<?php


	class GhostMenu extends btThemeMenu {
		
		public function __construct($sqlConnection) {
			
			parent::__construct("ghost", $sqlConnection);	
			
		}
		
		public function displayMenuCategory($loc="top") {
			
			$menuCatInfo = $this->menuCatObj->get_info();
			if($loc == "top") {
				
				echo $this->getHeaderCode($menuCatInfo);
				if($this->intMenuSection == 0 || $this->intMenuSection == 1) {
					echo "
						<div class='menuContentDiv'>
					";
				}
				
				
			}
			elseif($this->intMenuSection == 0 || $this->intMenuSection == 1) {
				echo "
					</div>
				";
			}
			
		}
		
		
		public function displayLoggedOut() {
			
			echo "
			
			<form action='".MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
				<div class='loginText_Username'></div>
				<div class='loginTextbox_Username'>
					<input type='text' name='user' class='loginTextbox'>
				</div>
				
				<div class='loginText_Password'></div>
				<div class='loginTextbox_Password'>
					<input type='password' name='pass' class='loginTextbox'>
				</div>
				
				<div class='loginText_RememberMe' style='top: 83px'></div>
				<div class='loginRememberMeBox' style='top: 78px' id='fakeRememberMe'></div>
				<input type='submit' name='submit' value='Login' id='btnLogin' style='display: none'>
				<div class='loginButton' id='btnFakeLogin'></div>
				
				<div style='position: absolute; top: 102px; left: 29px'>Sign in with Facebook</div>
				
				<input type='hidden' value='0' id='rememberMe' name='rememberme'>
			</form>
			
			
			";
			
		}
		
		public function displayLoggedIn() {
			
			echo "
			
			<div class='loggedInProfilePic'>
				".$this->memberObj->getProfilePic("75px", "100px")."
			</div>
			
			<div class='loggedInInfo'>
				<div style='margin-bottom: 5px'>
					<b>Account Name:</b><br>
					".$this->memberObj->getMemberLink(array("color" => false))."
				</div>
				<div style='margin-bottom: 8px'>
					<b>Rank:</b><br>
					".$this->data['memberRank']."
				</div>
				<div style='text-align: center'>
					<b>Member Options:</b><br>
					<a href='".MAIN_ROOT."members'>My Account</a> - ".$this->data['pmLink']." - <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a>
				</div>
			</div>
			
			
			";
			
		}	
		
		
		
		
	}


?>