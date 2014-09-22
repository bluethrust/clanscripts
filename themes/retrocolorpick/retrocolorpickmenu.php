<?php

	class RetroColorPickMenu extends btThemeMenu {
		
		public function __construct($sqlConnection) {
			
			parent::__construct("retrocolorpick", $sqlConnection);	
			
		}	
		
		public function displayMenuCategory($loc="top") {
			// Placeholder function - This likely needs to be overwritten
			
			// top = top portion of menu
			// bottom = bottom portion of menu
			
			$menuCatInfo = $this->menuCatObj->get_info();
			if($loc == "top") {
				echo $this->getHeaderCode($menuCatInfo);
				echo "<div class='navMenuLinks'>";				
			}
			else {
				echo "</div>";
			}
			
			
		}

		
		
		public function displayLoggedOut() {
			
			echo "
			<form action='".MAIN_ROOT."login.php' method='post' style='margin: 0px; padding: 0px'>
				<div class='navMenuLinks'>
					<b>Username:</b><br>
					<input type='text' class='textBox' name='user' style='width: 125px'><br>
					<b>Password:</b><br>
					<input type='password' class='textBox' name='pass' style='width: 125px'><br>
					<b>Remember Me:</b> <input type='checkbox' name='rememberme' value='1'><br>
					<input type='submit' class='submitButton' name='submit' value='Log In' style='margin-top: 5px; width: 80px'>
				</div>
			</form>
			";
			
		}
		
		public function displayLoggedIn() {
			
			echo "
			<div class='navMenuLinks'>
				<b>Account Name:</b><br>
				".$this->memberObj->getMemberLink(array("color"=>false))."
				<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
				<b>Rank:</b><br>
				".$this->data['memberRank']."
				<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
				<b>Member Options:</b><br>
				<b>&middot;</b> <a href='".MAIN_ROOT."members'>My Account</a><br>
				<b>&middot;</b> ".$this->data['pmLink']."<br>
				<b>&middot;</b> <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a><br>	
			</div>
			";
			
		}
		
	}

?>