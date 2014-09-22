<?php
/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "

	<form action='".$MAIN_ROOT."login.php' method='post'>

		<b>Username:</b><br>
		<input type='text' name='user' class='textBox' style='width: 125px'><br>
		<b>Password:</b><br>
		<input type='password' name='pass' class='textBox' style='width: 125px'><br>
		Remember Me: <input type='checkbox' value='1' name='rememberme' class='checkBox'><br>
		<input type='submit' name='submit' class='submitButton' value='Log In'>

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

				 <b>Account Name:</b>
				  <a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']."</a><br>
				<hr style='width: 125px; margin: 6px 1px; padding: 0px; border: dotted gray 1px'>
				 <b>Rank:</b><br>
				  ".$arrLoginInfo['memberRank']."<br>
				<hr style='width: 125px; margin: 6px 1px; padding: 0px; border: dotted gray 1px'>
				&nbsp;<b>Member Options:</b><br>
				&nbsp;&nbsp;<b>&middot;</b> <a href='".$MAIN_ROOT."members'>My Account</a><br>
				&nbsp;&nbsp;<b>&middot;</b> <a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a><br>
				&nbsp;&nbsp;<b>&middot;</b> <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a><br>

	";



	return $dispLoggedinBox;
}

?>