<?php

	class SynergyMenu extends btThemeMenu {
		
		public function __construct($sqlConnection) {
			
			parent::__construct("synergy", $sqlConnection);	
			
		}
		
		public function displayLoggedOut() {
			
			echo "
			
			<div id='username'>
			<form action='".MAIN_ROOT."login.php' method='post'>
			<input type='text' name='user' id='userfield' placeholder='Username'>
			</div>
			<div id='password'>
			<input type='password' name='pass' id='passfield' placeholder='Password'>
			</div>
			<div id='remember'>
			<input type='checkbox' value='1' name='rememberme' id='rememberme'><label for='rememberme'></label>
			</div>
			<div id='gap'></div>
			<div id='loginbutton'><input type='submit' name='submit' value='Log In'></form>
			</div>
			<div id='juiced'></div>
			
			
			";
			
		}
		
		public function displayLoggedIn() {
			
			echo "
			
			<div id='loggedin'></div>

			<div id='memberphoto'>
			<a href='".MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$this->memberObj->getProfilePic("53px", "70px")."</a>
			</div>
			<div id='accountoptions'>
			<a href='".MAIN_ROOT."members'>Options</a><br>
			".$this->data['pmLink']."<br>
			<a href='".MAIN_ROOT."members/signout.php'>Sign Out</a>
			</div>
			<div id='accountname'>
			".$this->memberObj->getMemberLink(array("color" => false))." &middot; ".$this->data['memberRank']."
			</div>
			<div id='juiced'></div>
			
			";
			
		}
		
	}


?>