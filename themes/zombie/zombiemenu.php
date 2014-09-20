<?php


	class ZombieMenu extends btThemeMenu {
		
		
		public function __construct($sqlConnection) {
			
			parent::__construct("zombie", $sqlConnection);	
			
		}	
		
		public function displayMenuCategory($loc="top") {

			$menuCatInfo = $this->menuCatObj->get_info();
			if($loc == "top") {
				echo $this->getHeaderCode($menuCatInfo);

				echo "<div class='menuSectionLinks'>";
			}
			else {
				echo "</div>";
			}
			
			
		}
		
		
		public function displayLoggedOut() {
			
			echo "
			
			<form action='".MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
			<div class='menuLinks' style='padding-left: 8px'>
				Username:<br>
				<input type='text' name='user' class='loginTextbox'><br>
				Password:<br>
				<input type='password' name='pass' class='loginTextbox'><br>
				Remember Me: <input type='checkbox' name='rememberme' value='1'><br>
				<input type='submit' name='submit' value='Log In' class='submitButton' style='width: 70px'>
			</div>
			</form>
			
			";
			
		}
		
		public function displayLoggedIn() {
			
			
			echo "
			
			<div class='menuLinks' style='padding-left: 8px'>
				<span style='font-size: 12px'>Account Name:</span><br>
				".$this->memberObj->getMemberLink(array("color"=>false))."
				<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
				<span style='font-size: 12px'>Rank:</span><br>
				".$this->data['memberRank']."
				<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
				<span style='font-size: 12px'>Member Options:</span><br>
				<b>&middot;</b> <a href='".MAIN_ROOT."members'>My Account</a><br>
				<b>&middot;</b> ".$this->data['pmLink']."<br>
				<b>&middot;</b> <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a><br>		
			</div>
			
			
			";
			
		}
		
		
	}


?>