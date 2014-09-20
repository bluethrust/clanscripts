<?php


	class TF2BlueMenu extends btThemeMenu {
		
		protected $intMenu3Counter = 0;
		
		public function __construct($sqlConnection) {
			
			parent::__construct("tf2blue", $sqlConnection);	
			
		}	
		
		
		public function displayMenuCategory($loc="top") {
			$this->intMenu3Counter = 0;
			
			parent::displayMenuCategory($loc);
			
		}
		
		
		public function displayLink() {
			
			if($this->intMenuSection == 3) {

				$menuLinkInfo = $this->menuItemObj->objLink->get_info();
				$checkURL = parse_url($menuLinkInfo['link']);
				
				if(!isset($checkURL['scheme']) || $checkURL['scheme'] = "") {
					$menuLinkInfo['link'] = MAIN_ROOT.$menuLinkInfo['link'];
				}
				$menuItemInfo = $this->menuItemObj->get_info();
				
				if($this->intMenu3Counter > 0) {
					echo "<div class='menuSeparator'></div>";
				}
				
				echo "<div style='display: inline-block; vertical-align: middle; height: 50px'><a href='".$menuLinkInfo['link']."' target='".$menuLinkInfo['linktarget']."'>".$menuItemInfo['name']."</a></div>";
			}
			else {

				parent::displayLink();
				
			}
			
		}
		
		public function displayLoggedOut() {
			
			echo "
			
			<form action='".MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
				<div class='loginAreaUsername'></div>
				<div class='loginAreaPassword'></div>
				<div class='loginAreaRememberMe'></div>
				
				
				<div class='loginAreaUsernameText'>
					<input type='text' name='user' class='loginAreaTextbox'>
				</div>
				
				<div class='loginAreaPasswordText'>
					<input type='password' name='pass' class='loginAreaTextbox'>
				</div>
				
				<div class='loginAreaCheckbox' id='fakeRememberMe'></div>
				
				<div class='loginAreaButton' id='fakeSubmit'></div>
				
				<input type='checkbox' name='rememberme' value='1' id='rememberMe' style='display: none'>
				<input type='submit' name='submit' value='submit' id='btnSubmit' style='display: none'>
			</form>
			
			
			";
			
		}
		
		public function displayLoggedIn() {
			
			echo "
			
			<div style='top: 35px; left: 50%; margin-left: -80px; position: absolute'>
				<img src='".MAIN_ROOT."themes/tf2blue/images/layout/loggedin.png'>
			</div>
		
			<div style='font-size: 10px; position: relative; top: 68px; left: 35px'>		
				<div class='tf2BlueProfilePic'>
					".$this->memberObj->getProfilePic()."
				</div>
			
				<div style='float: left; width: 175px; overflow: hidden; text-overflow: ellipsis; height: 28px'>
				<b>Account Name:</b><br>
				".$this->memberObj->getMemberLink(array("color"=>false))."
				</div>
				<div style='float: left; width: 175px; overflow: hidden; text-overflow: ellipsis; height: 28px'>
				<b>Rank:</b><br>
				".$this->data['memberRank']."
				</div>
				
				<div style='clear: both'></div>
				<div style='position: absolute; top: 57px; left: 75px; text-align: center; width: 225px'>
					<p style='margin: 0px; padding: 0px'>
						<a href='".MAIN_ROOT."members'>My Account</a> - 
						<span id='pmLoggedInLink'>".$this->data['pmLink']."</span>
						<span style='font-size: 3px'><br></span><a href='".MAIN_ROOT."members/signout.php'>Sign Out</a>
					</p>
				</div>
			</div>
			
			";
			
		}
		
	}

?>