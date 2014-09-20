<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post'>

	<span style='font-size: 12px'>Username:</span><br>
	<input type='text' name='user' class='textBox' style='width: 145px'><br>
	
	<span style='font-size: 12px'>Password:</span><br>
	<input type='password' name='pass' class='textBox' style='width: 145px'><br>
	<div style='margin-top: 2px; margin-bottom: 10px; font-size: 12px'>Remember Me: <input type='checkbox' name='rememberme' value='1'></div>
	<input type='submit' name='submit' value='Log In' class='submitButton'><br><br>
	<a href='".$MAIN_ROOT."forgotpassword.php'>Forgot Password?</a>

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
	<span style='font-size: 12px'>Account Name:</span><br>
	<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']."</a>
	<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: 0px; border-bottom: dotted #303233 1px'>
	<span style='font-size: 12px'>Rank:</span><br>
	".$arrLoginInfo['memberRank']."
	<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: 0px; border-bottom: dotted #303233 1px'>
	<span style='font-size: 12px'>Member Options:</span><br>
	<b>&middot;</b> <a href='".$MAIN_ROOT."members'>My Account</a><br>
	<b>&middot;</b> <a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a><br>
	<b>&middot;</b> <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a><br>
";

	
	
	return $dispLoggedinBox;
}


?>