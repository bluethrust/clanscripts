<?php

	class RedNukesMenu extends btThemeMenu {
		
		
		public function __construct($sqlConnection) {
		
			parent::__construct("rednukes", $sqlConnection);
		
		}
		
		
		public function displayLoggedOut() {
			echo "
			
			<form action='".MAIN_ROOT."login.php' method='post' id='loginForm' style='padding: 0px; margin: 0px'>
			<div class='memberLogin'>
				<div class='loginBoxContent'>
					<div style='margin-bottom: 10px'><img src='".MAIN_ROOT."themes/rednukes/images/username.png' style='margin-right: 12px;'> <input type='text' name='user' id='loginUserTextBox' class='textBox' style='width: 140px; height: 20px; '></div>
					<img src='".MAIN_ROOT."themes/rednukes/images/password.png' style='margin-right: 10px'> <input type='password' name='pass' id='loginPasswordTextBox' class='textBox' style='width: 140px; height: 20px'><br>
				</div>
				
				<div class='loginBoxButton'>
					<a href='javascript:void(0)' onclick='clickLogin()'><img src='".MAIN_ROOT."themes/rednukes/images/login-button.png' onmouseover=\"src='".MAIN_ROOT."themes/rednukes/images/login-button_hover.png'\" onmouseout=\"src='".MAIN_ROOT."themes/rednukes/images/login-button.png'\"></a>
				</div>
			</div>
			</form>
						
						
			<script type='text/javascript'>
				function clickLogin() {
					$(document).ready(function() {
						$.post('".MAIN_ROOT."login.php', { submit: 1, user: $('#loginUserTextBox').val(), pass: $('#loginPasswordTextBox').val() }, function(data) {
							window.location = '".MAIN_ROOT."login.php';
						});
					});
				}
			</script>
			
			";
		
		}
		
		public function displayLoggedIn() {
			
			echo "
			
			<div class='loggedIn'>
				<div class='loggedInBoxContent'>
				<p align='center' style='padding-bottom: 2px; margin-bottom: 0px'><b>You are logged in</b></p>
					<table align='center' border='0' cellspacing='0' cellpadding='0' width='282'>
						<tr>
							<td class='tinyFont' valign='top'>
							<b>Rank:</b> ".$this->data['memberRank']."<br><span style='font-size: 1px'><br></span>
							<b>User:</b> ".$this->memberObj->getMemberLink(array("color"=>false))."<br><br>
							</td>
							<td class='tinyFont' valign='top'>
							<b>·</b> <a href='".MAIN_ROOT."members'>My Account</a><br><span style='font-size: 1px'><br></span>
							<b>·</b> ".$this->data['pmLink']."<br><span style='font-size: 1px'><br></span>
							<b>·</b> <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a><br>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			";
		
		}
		
		
		
	}


?>