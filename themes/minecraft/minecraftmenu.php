<?php

	class MinecraftMenu extends btThemeMenu {
		
		
		public function __construct($sqlConnection) {
			
			parent::__construct("minecraft", $sqlConnection);	
			
		}
		
		public function displayLoggedOut() {
			echo "
				<form action='".MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
				<div class='rememberMe_Off' id='rememberMeDiv'></div>
						
					<div id='rememberMeSwitch'></div>
					
					<div class='loginBox'>
					
						<div class='loginUsernameDiv'>
							<input type='text' name='user' class='loginTextBox'>
						</div>
						<div class='loginPasswordDiv'>
							<input type='password' name='pass' class='loginTextBox'>
						</div>
						
					</div>
					
					<div id='loginSign'></div>
					
					<input type='hidden' id='txtRememberMe' value='0' name='rememberme'>
					<input type='submit' name='submit' id='btnSubmit' style='display: none'>
				</form>			
			";
			
		}
		
		public function displayLoggedIn() {
			echo "
				<div class='loggedInBox'>
			
					<div style='float: left; width: 48%; overflow: hidden; text-overflow: ellipsis; height: 28px'>
					<b>Account Name:</b><br>
					".$this->memberObj->getMemberLink(array("color" => false))."
					</div>
					<div style='float: right; width: 48%; overflow: hidden; text-overflow: ellipsis; height: 28px'>
					<b>Rank:</b><br>
					".$this->data['memberRank']."
					</div>
					<div style='clear: both'></div>
					<div style='margin-top: 3px'>
						<b>Member Options:</b>
						<p align='center' style='margin: 0px; padding: 0px'>
							<a href='".MAIN_ROOT."members'>My Account</a> - 
							".$this->data['pmLink']." - 
							<a href='".MAIN_ROOT."members/signout.php'>Sign Out</a>
						</p>
					</div>
				</div>
			";
		}	
		
		
	}


?>