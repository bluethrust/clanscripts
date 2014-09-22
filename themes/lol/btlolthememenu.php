<?php
	
	class btLoLThemeMenu extends btThemeMenu {
		
		public function __construct($sqlConnection) {
			
			parent::__construct("lol", $sqlConnection);	
			
		}
		
		
		public function displayMenuCategory($loc="top") {
		
			$menuCatInfo = $this->menuCatObj->get_info();
		
		
			if($loc == "top") {
				$addMenuTitleClass = "";
				if($this->intMenuSection == 1) {
		
					echo "
					<div class='topMenuItem'><div class='topMenuItemText'>
					";
		
		
					if(count($this->arrMenuItems) == 0) {
						echo "<div class='topMenuHighlight'></div>";
					}
		
				}
				else {
					$addMenuTitleClass = " class='menuTitle'";
					echo "<div class='menuGradientLineTop'></div>";
				}
		
		
				if($menuCatInfo['headertype'] == "image") {
					echo "<p".$addMenuTitleClass."><img src='".MAIN_ROOT.$menuCatInfo['headercode']."'></p>";
				}
				else {
					$menuCatInfo['headercode'] = $this->replaceKeywords($menuCatInfo['headercode']);			
					echo "<p".$addMenuTitleClass.">".$menuCatInfo['headercode']."</p>";
				}
		
		
		
				if($this->intMenuSection == 1) {
		
					if(count($this->arrMenuItems) > 0) {
						echo "<div class='layoutDropDownMenu'>";
					}
		
				}
				else {
					echo "<div class='menuGradientLineBottom'></div>";
				}
		
		
		
		
			}
			else {
				// Bottom Portion of Menu Category (After menu items are displayed)
		
				if($this->intMenuSection == 1) {
		
					if(count($this->arrMenuItems) > 0) {
						echo "
		
						<div class='layoutDropDownCover'></div>
						<div class='layoutDropDownFillBG'></div>
						</div>
		
						";
					}
		
					echo "</div></div>";
		
				}
				else {
					echo "<br>";
				}
		
		
		
			}
		
		
		}
		
		
		public function displayLoggedOut() {
		
			echo "
		
				<form action='".MAIN_ROOT."login.php' method='post' style='position: relative; padding: 0px; margin: 0px'>
					<p class='menuItem'>
						Username:
						<input type='text' name='user' class='loginTextbox'>
					</p>
					<p class='menuItem'>
						Password:
						<input type='password' name='pass' class='loginTextbox'>
					</p>
					<p class='menuItem'>Remember Me: <input type='checkbox' name='rememberme' value='1'></p>
					<p class='menuItem' style='padding-left: 3px; padding-top: 3px; font-size: 12px'><a href='".MAIN_ROOT."signup.php'>Sign Up</a><br><a href='".MAIN_ROOT."forgotpassword.php'>Forgot Password?</a></p>
					<p class='menuItem'>
						<input type='submit' name='submit' class='loginSubmitButton' value='Log In'>
					</p>
					<div style='clear: both'></div>
				</form>
		
			";
		
		}
		
		
		public function displayLoggedIn() {
		
			echo "
		
				<div class='loggedInSection'>
					<b>Account Name:</b><br>
					<p>".$this->memberObj->getMemberLink()."</p>
					<div class='dottedLine' style='margin: 5px 0px'></div>
					<b>Rank:</b>
					<p>".$this->data['memberRank']."</p>
					<div class='dottedLine' style='margin: 5px 0px'></div>
					<b>Member Options:</b><br>
					<ul class='loggedInMenuList'>
						<li><a href='".MAIN_ROOT."members'>My Account</a></li>
						<li>".$this->data['pmLink']."</li>
						<li><a href='".MAIN_ROOT."members/signout.php'>Sign Out</a></li>
					</ul>
				</div>
		
			";
		
		}
		
		
	}


?>