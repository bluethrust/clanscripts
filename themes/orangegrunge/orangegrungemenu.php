<?php

	class OrangeGrungeMenu extends btThemeMenu {
		
		
		public function __construct($sqlConnection) {
			
			parent::__construct("orangegrunge", $sqlConnection);	
			
		}
		
		
		public function displayLoggedOut() {
			echo "
			
				<form action='".MAIN_ROOT."login.php' method='post' style='margin: 0px; padding: 0px'>
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
			// Placeholder function
			
			echo "
			
			
			&nbsp;&nbsp;<b>Account Name:</b><br>
			&nbsp;&nbsp;".$this->memberObj->getMemberLink(array("color"=>false))."
			&nbsp;&nbsp;<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
			&nbsp;&nbsp;<b>Rank:</b><br>
			&nbsp;&nbsp;".$this->data['memberRank']."
			&nbsp;&nbsp;<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
			&nbsp;&nbsp;<b>Member Options:</b><br>
			&nbsp;&nbsp;<b>&middot;</b> <a href='".MAIN_ROOT."members'>My Account</a><br>
			&nbsp;&nbsp;<b>&middot;</b> ".$this->data['pmLink']."<br>
			&nbsp;&nbsp;<b>&middot;</b> <a href='".MAIN_ROOT."members/signout.php'>Sign Out</a><br>		
			
			
			";
		}
		
	}


?>