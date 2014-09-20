<?php
/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
	<form action='".$MAIN_ROOT."login.php' method='post' style='margin: 0px; padding: 0px'>
		<div class='navMenuLinks'>
			<b>Username:</b><br>
			<input type='text' class='textBox' name='user' style='width: 125px'><br>
			<b>Password:</b><br>
			<input type='password' class='textBox' name='pass' style='width: 125px'><br>
			<b>Remember Me:</b> <input type='checkbox' name='rememberme' value='1'><br>
			<input type='submit' class='submitButton' name='submit' value='Log In' style='margin-top: 5px; width: 80px'>
		</div>
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

		<div class='navMenuLinks'>
			<b>Account Name:</b><br>
			<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']."</a>
			<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
			<b>Rank:</b><br>
			".$arrLoginInfo['memberRank']."
			<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
			<b>Member Options:</b><br>
			<b>&middot;</b> <a href='".$MAIN_ROOT."members'>My Account</a><br>
			<b>&middot;</b> <a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a><br>
			<b>&middot;</b> <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a><br>	
		</div>
		
	";



	return $dispLoggedinBox;
}

?>