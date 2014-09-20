<?php

	class MedievalBlueMenu extends btThemeMenu {
		
		
		public function __construct($sqlConnection) {
			
			parent::__construct("medieval", $sqlConnection);
			$this->defaultShoutboxWidth = 135;
			$this->defaultShoutboxHeight = 300;
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
			
				<form action='".MAIN_ROOT."login.php' method='post' id='medievalLoginForm' style='padding: 0px; margin: 0px'>
					<div class='loginSection'>
						<div class='loginUsernameImg'></div>
						<div class='loginTextBox'><input type='textbox' class='textBox' name='user' style='width: 150px; font-size: 14px'></div>
						<div class='loginPasswordImg'></div>
						<div class='loginTextBox'><input type='password' class='textBox' name='pass' style='width: 150px; font-size: 14px'></div>
						
						<div class='loginButtonSection'>
							<div class='loginRememberMeImg'></div>
							<div class='loginRememberMeBoxContainer'>
								<img src='".MAIN_ROOT."images/transparent.png' class='loginRememberBoxImg' id='rememberMeBoxImg'>
							</div>
							
							
							<div class='loginButtonContainer'>
								
								<img src='".MAIN_ROOT."images/transparent.png' class='loginButtonImg' id='btnLogin'>
							
							</div>
							
							
						</div>
						<div style='clear: both'></div>
					</div>
					<input type='hidden' name='rememberme' id='rememberme' value='0'>
					<input type='submit' name='submit' name='submit' id='btnRealSubmit' value='1' style='display: none'>
					</form>
					
					<script type='text/javascript'>
					
					$(document).ready(function() {
						$('#rememberMeBoxImg').click(function() {
							if($('#rememberme').val() == 0) {
								$('#rememberMeBoxImg').removeClass('loginRememberBoxImg').addClass('loginRememberBoxImg_checked');
								$('#rememberme').val('1');
							}
							else {
								$('#rememberMeBoxImg').removeClass('loginRememberBoxImg_checked').addClass('loginRememberBoxImg');
								$('#rememberme').val('0');
							}
						});
						
						$('#btnLogin').click(function() {
							$('#btnRealSubmit').click();
						});
						
						
					});
				
				</script>
			
			
			";
			
		}
		
		public function displayLoggedIn() {
			
			echo "
			
				<div class='loggedInSection'>
					<div class='loggedInImg'></div>
					<div class='loggedInInfo'>
						<div style='float: left'>
							<b>Account Name:</b> ".$this->memberObj->getMemberLink(array("color" => false))."<br>
							<b>Rank:</b> ".$this->data['memberRank']."
						</div>
						<div style='float: right; margin-left: 75px; text-align: center'>
						<b><u>Member Options:</u></b><br>
						<a href='".MAIN_ROOT."members'>My Account</a> - ".$this->data['pmLink']." - <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a>
						</div>
						
						
						<div style='clear: both'></div>
					</div>
				</div>
			
			";
			
		}
		
		
	}


?>