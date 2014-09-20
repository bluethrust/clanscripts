<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<div style='display: none; padding: 10px' id='simpleTechLoginForm' class='main'>
<form action='".$MAIN_ROOT."login.php' method='post'>
	Username:<br>
	<input type='text' name='user' class='loginTextbox'><br>
	Password:<br>
	<input type='password' name='pass' class='loginTextbox'><br>
	Remember Me: <input type='checkbox' name='rememberme' value='1'><br>
	<input type='submit' name='submit' id='btnSubmit' value='Log In' class='submitButton' style='display: none'><br><br>
	<a href='".$MAIN_ROOT."signup.php'>Sign Up</a> - <a href='".$MAIN_ROOT."forgotpassword.php'>Forgot Password</a>
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
	
	<div class='loggedInDiv'>
		<b>Logged in as:</b>
		<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'><div class='menuLink' style='overflow: hidden; white-space:nowrap; text-overflow: ellipsis; margin: 3px 0px'>".$arrLoginInfo['memberUsername']."</div></a>
		<b>Rank:</b><br>
		<span style='overflow: hidden; white-space:nowrap; text-overflow: ellipsis'>".$arrLoginInfo['memberRank']."</span>
		<a href='".$MAIN_ROOT."members'><div class='menuLink' style='font-size: 10px; overflow: hidden; white-space:nowrap; text-overflow: ellipsis; text-align: center; margin-top: 10px'><b>MY ACCOUNT</b></div></a>
		<a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'><div class='menuLink' style='font-size: 10px; overflow: hidden; white-space:nowrap; text-overflow: ellipsis; text-align: center'><b>INBOX ".$arrLoginInfo['pmCountDisp']."</b></div></a>
		<a href='".$MAIN_ROOT."members/signout.php'><div class='menuLink' style='font-size: 10px; overflow: hidden; white-space:nowrap; text-overflow: ellipsis; text-align: center'><b>SIGN OUT</b></div></a>
	</div>
	
	";

	if($arrLoginInfo['pmAlert'] == 1) {
		$dispLoggedinBox .= "
			<script type='text/javascript'>
				$(document).ready(function() {
					$('#loggedInAlert').show();
				});
			</script>
		";
		
	}
	
	
	return $dispLoggedinBox;
}


?>