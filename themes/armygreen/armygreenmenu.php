<?php

	class ArmyGreenMenu extends btThemeMenu {
		
		
		public function __construct($sqlConnection) {
			
			parent::__construct("armygreen", $sqlConnection);	
			
		}
		
		public function displayMenuCategory($loc="top") {
			
			$menuCatInfo = $this->menuCatObj->get_info();
			if($loc == "top") {
				
				if($menuCatInfo['headertype'] == "image") {
					echo "<img src='".$MAIN_ROOT.$menuCatInfo['headercode']."' class='menuHeaderImg'>";
				}
				else {
					
					$menuCatInfo['headercode'] = $this->replaceKeywords($menuCatInfo['headercode']);
					echo $menuCatInfo['headercode'];
				}
				
			}
			else {
				echo "<br>";	
			}
			
		}
		
		
		public function displayLoggedOut() {
			echo "
			<form action='".MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
				<div class='loginForm'>
					
					<b>USERNAME:</b><br>
					<input type='text' class='textBox' name='user'><br>
					<b>PASSWORD:</b><br>
					<input type='password' class='textBox' name='pass'><br>
					<b>REMEMBER ME:</b> <input type='checkbox' value='1' name='rememberme'><br>
					<input type='submit' name='submit' value='Log In' class='submitButton'>
					
				</div>
			</form>
			<div class='loginIMG' id='loginIMG'></div>
			
			<div id='loginArrow' class='loginDownArrow'></div>
			";
			
		}
		
		public function displayLoggedIn() {
			
			echo "
				<div class='loggedInIMG'></div>
				<div class='loggedInBar'></div>
			
				<div class='loggedInInfo'>
				
					<b>Rank:</b><br>
					".$this->data['memberRank']."
					<hr style='width: 170px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
					<b>Member Options:</b><br>
					<b>&middot;</b> <a href='".MAIN_ROOT."members'>My Account</a><br>
					<b>&middot;</b> <a href='".MAIN_ROOT."profile.php?mID=".$this->data['memberInfo']['member_id']."'>View Profile</a><br>
					<b>&middot;</b> ".$this->data['pmLink']."<br>
					<b>&middot;</b> <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a><br>
				
				
				</div>	
			
				<div class='loggedInUsername' id='loggedInUsername'>
					<p align='center' style='margin: 0px; padding: 0px' title='Logged in as ".$this->data['memberInfo']['username']."'>".$this->data['memberInfo']['username']."</p>
				</div>
				
				<script type='text/javascript'>
					
					var intArmyGreenCounter = 0;
					var intCheckLoggedInUser = self.setInterval(function() { checkLoggedInUser(); }, 100);
					var strArmyGreenUsername = $('#loggedInUsername p').text();
					
					function checkLoggedInUser() {
						$(document).ready(function() {
						
							
							if($('#loggedInUsername')[0].scrollWidth > $('#loggedInUsername').width()) {
								$('#loggedInUsername p').text($('#loggedInUsername p').text().substring(0, ($('#loggedInUsername p').text().length-intArmyGreenCounter)));
								intArmyGreenCounter++;
							}
							else if(intArmyGreenCounter > 0) {
							
								$('#loggedInUsername p').text($('#loggedInUsername p').text().substring(0, ($('#loggedInUsername p').text().length-3))+\"...\");
								
								tempVal = $('#loggedInUsername p').text();
								
								intCheckLoggedInUser = window.clearInterval(intCheckLoggedInUser);
								
							}
							else {
								intCheckLoggedInUser = window.clearInterval(intCheckLoggedInUser);
							}
							
						});
					}
					
					
				
				</script>
				
			";
			
			if($this->data['pmCount'] > 1) {
				$addS = "s";
				$addA = " ";	
			}
			else {
				$addS = "";
				$addA = " a ";
			}
			
			if($this->data['pmAlert'] == 1) {
				echo "<div id='loginArrow' class='loginDownArrowRed' title='You have".$addA."new private message".$addS."!'></div>";
			}
			else {
				echo "<div id='loginArrow' class='loginDownArrow'></div>";	
			}
				
				
			
			
		}
		
		
		
		
		
	}


?>