<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post'>
	<div class='usernameIMG'></div><div class='loginTextbox'><input type='text' name='user' class='textBox'></div>
	<div style='clear: both'></div>
	<div class='passwordIMG'></div><div class='loginTextbox' style='margin-top: 15px'><input type='password' name='pass' class='textBox'></div>
	<div style='clear: both'></div>
	<div class='rememberMeIMG'></div><div class='rememberMeCheckbox' id='fakeRememberMe'><input type='hidden' name='rememberme' value='0' id='rememberMe'></div>
	<div class='loginButton' id='btnLogin'></div>


	<input type='submit' name='submit' value='Log In' id='btnSubmit' style='display: none'>
</form>
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

		<div class='loggedInIMG'></div>
		<div class='loggedInInfo'>
			<b>Account Name:</b> <a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']."</a><br>
			<b>Rank:</b> ".$arrLoginInfo['memberRank']."
			
			<div style='font-size: 10px; padding: 0px; position: relative; margin-left: -13px; margin-top: 8px; text-align: center; width: 254px'>	<span style='font-size: 11px'><b>Member Options</b></span><br><a href='".$MAIN_ROOT."members'>My Account</a> - <a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a><br><a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a></div>
		</div>
";

	
	
	return $dispLoggedinBox;
}


?>