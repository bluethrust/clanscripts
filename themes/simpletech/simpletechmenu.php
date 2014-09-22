<?php


	class SimpleTechMenu extends btThemeMenu {
		
		protected $topMenuCounter = 0;
		
		public function __construct($sqlConnection) {
			
			parent::__construct("simpletech", $sqlConnection);	
			
			$this->defaultShoutboxWidth = "155px";
			$this->defaultShoutboxHeight = "350px";
			
		}	
		
		
		public function formatLink($menuItemInfo, $menuLinkInfo) {
			
			if($this->intMenuSection == 2) {
				echo "<a href='".$menuLinkInfo['link']."' target='".$menuLinkInfo['linktarget']."'><div class='menuLink' style='text-align: ".$menuLinkInfo['textalign']."'>".$menuLinkInfo['prefix'].$menuItemInfo['name']."</div></a>";
			}
			else {
				echo "<a href='".$menuLinkInfo['link']."' target='".$menuLinkInfo['linktarget']."'>".$menuLinkInfo['prefix'].$menuItemInfo['name']."</a><br>";		
			}
			
		}
		
		public function displayLink() {
			
			$menuItemInfo = $this->menuItemObj->get_info();
			$menuLinkInfo = $this->menuItemObj->objLink->get_info();
			$checkURL = parse_url($menuLinkInfo['link']);
			
			if(!isset($checkURL['scheme']) || $checkURL['scheme'] = "") {
				$menuLinkInfo['link'] = MAIN_ROOT.$menuLinkInfo['link'];
			}	
			
			if($this->intMenuSection == 2) {
				echo "<a href='".$menuLinkInfo['link']."' target='".$menuLinkInfo['linktarget']."'><div class='menuLink' style='text-align: ".$menuLinkInfo['textalign']."'>".$menuLinkInfo['prefix'].$menuItemInfo['name']."</div></a>";
			}
			else {
				echo "<a href='".$menuLinkInfo['link']."' target='".$menuLinkInfo['linktarget']."'>".$menuLinkInfo['prefix'].$menuItemInfo['name']."</a><br>";		
			}
			
		}
		
		
		public function displayCustomFormLink() {
			
			$customFormObj = new CustomForm($this->MySQL);
			$menuCustomFormInfo = $this->menuItemObj->objCustomPage->get_info();
			$customFormObj->select($menuCustomFormInfo['custompage_id']);
			$menuItemInfo = $customFormObj->get_info_filtered();
			$menuCustomFormInfo['link'] = MAIN_ROOT."customform.php?pID=".$menuItemInfo['customform_id'];
			
			
			$this->formatLink($menuItemInfo, $menuCustomFormInfo);
			
		}
		
		public function displayCustomPageLink() {
			$customPageObj = new Basic($this->MySQL, "custompages", "custompage_id");
			$menuCustomPageInfo = $this->menuItemObj->objCustomPage->get_info();
			$customPageObj->select($menuCustomPageInfo['custompage_id']);
			$menuItemInfo = $customPageObj->get_info_filtered();
			$menuItemInfo['name'] = $menuItemInfo['pagename'];
			$menuCustomPageInfo['link'] = MAIN_ROOT."custompage.php?pID=".$menuItemInfo['custompage_id'];
			
			$this->formatLink($menuItemInfo, $menuCustomPageInfo);
			
		}
		
		public function displayDownloadPageLink() {
			
			$downloadCatObj = new DownloadCategory($this->MySQL);
			$menuDownloadLinkInfo = $this->menuItemObj->objCustomPage->get_info();
			$downloadCatObj->select($menuDownloadLinkInfo['custompage_id']);
			$menuItemInfo = $downloadCatObj->get_info_filtered();
			$menuDownloadLinkInfo['link'] = MAIN_ROOT."downloads/?catID=".$menuItemInfo['downloadcategory_id'];
			
			$this->formatLink($menuItemInfo, $menuDownloadLinkInfo);
			
		}
		
		
		public function displayTopPlayers() {

			$menuItemInfo['name'] = "Recruiters";
			$menuLinkInfo['link'] = MAIN_ROOT."top-players/recruiters.php";
			$menuLinkInfo['prefix'] = "";
			$menuLinkInfo['linktarget'] = "";
			$menuLinkInfo['textalign'] = "left";
			
			$this->formatLink($menuItemInfo, $menuLinkInfo);
			$hpGameObj = new Game($this->MySQL);
			$arrGames = $hpGameObj->getGameList();
			foreach($arrGames as $gameID) {
				$hpGameObj->select($gameID);
				$menuItemInfo['name'] = $hpGameObj->get_info_filtered("name");
				$menuLinkInfo['link'] = MAIN_ROOT."top-players/game.php?gID=".$gameID;
				$this->formatLink($menuItemInfo, $menuLinkInfo);
			}
			
			
		}
		
		
		public function displayMenuCategory($loc="top") {

			$menuCatInfo = $this->menuCatObj->get_info();
			$addDropdownMenu = (count($this->arrMenuItems) > 0) ? " data-showmenu='topMenu_".$this->topMenuCounter."' " : "";
			
			if($loc == "top") {
				
				if($this->intMenuSection == 0 || $this->intMenuSection == 1) {
					echo "<div class='sideMenuInnerDiv'>";	
				}
				elseif($this->intMenuSection == 2) {
					echo "<div class='topMenuSection' ".$addDropdownMenu." data-hoverimg='".str_replace(" ","-",$menuCatInfo['name'])."'>";	
				}
				
				
				echo $this->getHeaderCode($menuCatInfo);

				if($this->intMenuSection == 2 && $addDropdownMenu != "") {
					echo "<div class='topMenuLinksDiv' id='topMenu_".$this->topMenuCounter."'>";
					$this->topMenuCounter++;
				}
				
			}
			else {
				
				
				if($this->intMenuSection == 2 && $addDropdownMenu != "") {
					echo "</div>";	
				}
				
				if($this->intMenuSection == 0 || $this->intMenuSection == 1 || $this->intMenuSection == 2) {
					echo "</div>";
				}
				
			}
			
			
		}
		
		
		public function displayLoggedOut() {
			echo "
			
			<div style='display: none; padding: 10px' id='simpleTechLoginForm' class='main'>
			<form action='".MAIN_ROOT."login.php' method='post'>
				Username:<br>
				<input type='text' name='user' class='loginTextbox'><br>
				Password:<br>
				<input type='password' name='pass' class='loginTextbox'><br>
				Remember Me: <input type='checkbox' name='rememberme' value='1'><br>
				<input type='submit' name='submit' id='btnSubmit' value='Log In' class='submitButton' style='display: none'><br><br>
				<a href='".MAIN_ROOT."signup.php'>Sign Up</a> - <a href='".MAIN_ROOT."forgotpassword.php'>Forgot Password</a>
			</form>
			</div>
			
			<script type='text/javascript'>
				$(document).ready(function() {
				
					$('#logInMenuIMG').click(function() {
			
					
						$('#simpleTechLoginForm').dialog({
						
							title: 'Log In',
							modal: true,
							width: 250,
							resizable: false,
							show: 'scale',
							zIndex: 99999,
							buttons: {
						
								'Log In': function() {
									$('#btnSubmit').click();					
								},
								'Cancel': function() {
									$(this).dialog('close');
								}
							
							}
						
						
						});
					
					});
					
				});
			</script>
			
			
			";
			
		}
		
		public function displayLoggedIn() {
		
			echo "
			<div class='loggedInDiv'>
				<b>Logged in as:</b>
				<a href='".MAIN_ROOT."profile.php?mID=".$this->data['memberInfo']['member_id']."'><div class='menuLink' style='overflow: hidden; white-space:nowrap; text-overflow: ellipsis; margin: 3px 0px'>".$this->data['memberInfo']['username']."</div></a>
				<b>Rank:</b><br>
				<span style='overflow: hidden; white-space:nowrap; text-overflow: ellipsis'>".$arrLoginInfo['memberRank']."</span>
				<a href='".MAIN_ROOT."members'><div class='menuLink' style='font-size: 10px; overflow: hidden; white-space:nowrap; text-overflow: ellipsis; text-align: center; margin-top: 10px'><b>MY ACCOUNT</b></div></a>
				<a href='".MAIN_ROOT."members/console.php?cID=".$this->data['pmCID']."'><div class='menuLink' style='font-size: 10px; overflow: hidden; white-space:nowrap; text-overflow: ellipsis; text-align: center'><b>INBOX ".$this->data['pmCountDisp']."</b></div></a>
				<a href='".MAIN_ROOT."members/signout.php'><div class='menuLink' style='font-size: 10px; overflow: hidden; white-space:nowrap; text-overflow: ellipsis; text-align: center'><b>SIGN OUT</b></div></a>
			</div>
			
			";
		
			if($this->data['pmAlert'] == 1) {
				echo "
					<script type='text/javascript'>
						$(document).ready(function() {
							$('#loggedInAlert').show();
						});
					</script>
				";
				
			}
			
		}
		
		
		
	}


?>