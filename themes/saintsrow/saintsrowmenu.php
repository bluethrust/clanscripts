<?php


	class SaintsRowMenu extends btThemeMenu {
		
		public function __construct($sqlConnection) {
		
			parent::__construct("saintsrow", $sqlConnection);
		
		}
		
		
		public function displayLoggedOut() {
			
			echo "
			
			<form action='".MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
				<div class='loginUsernameText'></div>
				<div class='loginPasswordText'></div>
				<div class='loginUsernameTextBoxDiv'><input type='text' name='user' class='loginTextbox'></div>
				<div class='loginPasswordTextBoxDiv'><input type='password' name='pass' class='loginTextbox'></div>
				
				<div class='loginButton' id='btnFakeLogInSubmit'></div>
				
				<div class='loginRememberMeText'></div>
				<div class='rememberMeCheckbox'><input type='checkbox' value='1' name='rememberme'></div>
				<div class='loginSectionTitle'>
					<img src='".MAIN_ROOT."themes/saintsrow/images/layout/memberlogin-notloggedin.png'>
				</div>
				
				<input type='submit' name='submit' style='display: none' id='btnLogInSubmit'>
			</form>
			
			";
			
		}
		
		public function displayLoggedIn() {
			
			echo "
			
			<div class='loginSectionTitle'>
				<img src='".MAIN_ROOT."themes/saintsrow/images/layout/memberlogin-loggedin.png'>
			</div>
		
			<div class='loggedInProfilePic'>".$this->memberObj->getProfilePic("35px", "47px")."</div>
			<div class='loggedInMemberOptions'>
			<b>Account Name:</b><br>
			".$this->memberObj->getMemberLink(array("color"=>false))."<br>
			<b>Rank:</b> ".$this->data['memberRank']."<br><span style='font-size: 3px'><br></span>
			<b>Member Options:</b><br>
			<a href='".MAIN_ROOT."members'>My Account</a> - ".$this->data['pmLink']." - <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a>
			</div>
			
			";
		
		}
		
		
	}

?>