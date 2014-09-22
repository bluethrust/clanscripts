<?php


	class BlueNovaMenu extends btThemeMenu {
		
		
		public function __construct($sqlConnection) {
			
			parent::__construct("bluenova", $sqlConnection);	
			
		}
		
		
		public function displayLoggedOut() {
			echo "
			<form action='".MAIN_ROOT."login.php' method='post'>
				<div class='usernameIMG'></div><div class='loginTextbox'><input type='text' name='user' class='textBox'></div>
				<div style='clear: both'></div>
				<div class='passwordIMG'></div><div class='loginTextbox' style='margin-top: 15px'><input type='password' name='pass' class='textBox'></div>
				<div style='clear: both'></div>
				<div class='rememberMeIMG'></div><div class='rememberMeCheckbox' id='fakeRememberMe'><input type='hidden' name='rememberme' value='0' id='rememberMe'></div>
				<div class='loginButton' id='btnLogin'></div>
			
			
				<input type='submit' name='submit' value='Log In' id='btnSubmit' style='display: none'>
			</form>
			";
		}
		
		public function displayLoggedIn() {
			echo "
			<div class='loggedInIMG'></div>
			<div class='loggedInInfo'>
				<b>Account Name:</b> <a href='".MAIN_ROOT."profile.php?mID=".$this->data['memberInfo']['member_id']."'>".$this->data['memberInfo']['username']."</a><br>
				<b>Rank:</b> ".$this->data['memberRank']."
				
				<div style='font-size: 10px; padding: 0px; position: relative; margin-left: -13px; margin-top: 8px; text-align: center; width: 254px'>	<span style='font-size: 11px'><b>Member Options</b></span><br><a href='".MAIN_ROOT."members'>My Account</a> - ".$this->data['pmLink']."<br><a href='".MAIN_ROOT."members/signout.php'>Sign Out</a></div>
			</div>
			";		
		}	
		
		
	}


?>