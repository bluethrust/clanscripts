<?php

	class AllianceBattleMenu extends btThemeMenu {

		public function __construct($sqlConnection) {
			
			parent::__construct("alliancebattle", $sqlConnection);	
			
		}
		
		public function displayMenuCategory($loc="top") {

			$menuCatInfo = $this->menuCatObj->get_info();
			
			if($loc == "top") {
				
				if($menuCatInfo['headertype'] == "image") {
					echo "<img src='".$MAIN_ROOT.$menuCatInfo['headercode']."' class='menuHeaderImg'>";
				}
				else {
					
					$menuCatInfo['headercode'] = $this->replaceKeywords($menuCatInfo['headercode']);
					
					if($this->intMenuSection != 2) {
						echo "<div class='menuWrapper'><div class='menuTopTitle'>".$menuCatInfo['headercode']."</div><div class='menuContent'>";
					}
					else {
						echo $menuCatInfo['headercode'];
					}
					
				}
				
				
				
			}
			elseif($this->intMenuSection != 2) {
			
				echo "</div><div class='menuBottomBG'></div></div>";

			}
			
		}
		
		
		public function displayLoggedOut() {
			
			echo "
				<form action='".MAIN_ROOT."login.php' method='post'>
		
					<span style='font-size: 12px'>Username:</span><br>
					<input type='text' name='user' class='textBox' style='width: 145px'><br>
					
					<span style='font-size: 12px'>Password:</span><br>
					<input type='password' name='pass' class='textBox' style='width: 145px'><br>
					<div style='margin-top: 2px; margin-bottom: 10px; font-size: 12px'>Remember Me: <input type='checkbox' name='rememberme' value='1'></div>
					<input type='submit' name='submit' value='Log In' class='submitButton'><br><br>
					<a href='".MAIN_ROOT."forgotpassword.php'>Forgot Password?</a>
				
				</form>
			";
		}
		
		public function displayLoggedIn() {
			
			echo "
				<span style='font-size: 12px'>Account Name:</span><br>
				<a href='".MAIN_ROOT."profile.php?mID=".$this->data['memberInfo']['member_id']."'>".$this->data['memberInfo']['username']."</a>
				<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: 0px; border-bottom: dotted #303233 1px'>
				<span style='font-size: 12px'>Rank:</span><br>
				".$this->data['memberRank']."
				<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: 0px; border-bottom: dotted #303233 1px'>
				<span style='font-size: 12px'>Member Options:</span><br>
				<b>&middot;</b> <a href='".MAIN_ROOT."members'>My Account</a><br>
				<b>&middot;</b> ".$this->data['pmLink']."<br>
				<b>&middot;</b> <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a><br>
			";
			
		}
		
		
		
		
		
	}


?>
