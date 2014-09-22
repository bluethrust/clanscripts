<?php
/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
	<form action='".$MAIN_ROOT."login.php' method='post' id='medievalLoginForm' style='padding: 0px; margin: 0px'>
		<div class='loginSection'>
			<div class='loginUsernameImg'></div>
			<div class='loginTextBox'><input type='textbox' class='textBox' name='user' style='width: 150px; font-size: 14px'></div>
			<div class='loginPasswordImg'></div>
			<div class='loginTextBox'><input type='password' class='textBox' name='pass' style='width: 150px; font-size: 14px'></div>
			
			<div class='loginButtonSection'>
				<div class='loginRememberMeImg'></div>
				<div class='loginRememberMeBoxContainer'>
					<img src='".$MAIN_ROOT."images/transparent.png' class='loginRememberBoxImg' id='rememberMeBoxImg'>
				</div>
				
				
				<div class='loginButtonContainer'>
					
					<img src='".$MAIN_ROOT."images/transparent.png' class='loginButtonImg' id='btnLogin'>
				
				</div>
				
				
			</div>
			<div style='clear: both'></div>
		</div>
		<input type='hidden' name='rememberme' id='rememberme' value='0'>
		<input type='submit' name='submit' name='submit' id='btnRealSubmit' value='1' style='display: none'>
		</form>
		
		<script type='text/javascript'>
		
		$(document).ready(function() {
			$('#rememberMeBoxImg').click(function() {
				if($('#rememberme').val() == 0) {
					$('#rememberMeBoxImg').removeClass('loginRememberBoxImg').addClass('loginRememberBoxImg_checked');
					$('#rememberme').val('1');
				}
				else {
					$('#rememberMeBoxImg').removeClass('loginRememberBoxImg_checked').addClass('loginRememberBoxImg');
					$('#rememberme').val('0');
				}
			});
			
			$('#btnLogin').click(function() {
				$('#btnRealSubmit').click();
			});
			
			
		});
	
	</script>
";


/*
 * - dispLoggedIn Function -
*
* Set the $dispLoggedinBox variable inside the function to the code that you want to be used
* for the logged in portion of the layout.  Use the array $arrLoginInfo inside the function
* to display a logged in member information.
*
* Will return the variable $dispLoggedinBox
*
*/

function dispLoggedIn($arrLoginInfo) {
	global $MAIN_ROOT;

	/*
	 $arrLoginInfo['memberID'] = $memberID;
	$arrLoginInfo['memberUsername'] = $memberUsername;
	$arrLoginInfo['memberRank'] = $memberRank;
	$arrLoginInfo['pmCID'] = $pmCID;
	$arrLoginInfo['pmCount'] = $dispPMCount;
	*/

	$dispLoggedinBox = "

		<div class='loggedInSection'>
			<div class='loggedInImg'></div>
			<div class='loggedInInfo'>
				<div style='float: left'>
					<b>Account Name:</b> <a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']."</a><br>
					<b>Rank:</b> ".$arrLoginInfo['memberRank']."
				</div>
				<div style='float: right; margin-left: 75px; text-align: center'>
				<b><u>Member Options:</u></b><br>
				<a href='".$MAIN_ROOT."members'>My Account</a> - <a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a> - <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a>
				</div>
				
				
				<div style='clear: both'></div>
			</div>
		</div>
	";



	return $dispLoggedinBox;
}

?>