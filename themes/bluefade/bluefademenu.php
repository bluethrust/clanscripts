<?php


	class BlueFadeMenu extends btThemeMenu {
		
		public function __construct($sqlConnection) {
			
			parent::__construct("bluefade", $sqlConnection);	
			
			$this->defaultShoutboxWidth = 124;
			$this->defaultShoutboxHeight = 300;
			
		}
		
		public function displayMenuCategory($loc="top") {
			
			$menuCatInfo = $this->menuCatObj->get_info();
			
			if($loc == "top") {

					echo "
						<tr>
							<td align='center' style='padding-top: 8px'>
					".$this->getHeaderCode($menuCatInfo)."
							</td>
						</tr>
						<tr>
							<td class='menuTop' align='center'><td>
						</tr>
						<tr>
							<td class='menuContent'>
					";
				
			}
			else {
				
				echo "
					</td>
						</tr>
						<tr>
							<td class='menuBottom'></td>
						</tr>
				";
				
			}
			
		}
		
		
		public function displayLoggedOut() {
			
			echo "
				<form action='".MAIN_ROOT."login.php' method='post'>
	
					<b>Username:</b><br>
					<input type='text' name='user' class='textBox' style='width: 125px'><br>
					<b>Password:</b><br>
					<input type='password' name='pass' class='textBox' style='width: 125px'><br>
					Remember Me: <input type='checkbox' value='1' name='rememberme' class='checkBox'><br>
					<input type='submit' name='submit' class='submitButton' value='Log In'>
			
				</form>
			";
			
		}
		
		public function displayLoggedIn() {
			echo "

				<b>Account Name:</b><br>
				  <a href='".MAIN_ROOT."profile.php?mID=".$this->data['memberInfo']['member_id']."'>".$this->data['memberInfo']['username']."</a><br>
				<hr style='width: 125px; margin: 6px 1px; padding: 0px; border: dotted gray 1px'>
				 <b>Rank:</b><br>
				  ".$this->data['memberRank']."<br>
				<hr style='width: 125px; margin: 6px 1px; padding: 0px; border: dotted gray 1px'>
				&nbsp;<b>Member Options:</b><br>
				&nbsp;&nbsp;<b>&middot;</b> <a href='".MAIN_ROOT."members'>My Account</a><br>
				&nbsp;&nbsp;<b>&middot;</b> ".$this->data['pmLink']."<br>
				&nbsp;&nbsp;<b>&middot;</b> <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a><br>
			
			";
		}	
		
		
		
	}


?>