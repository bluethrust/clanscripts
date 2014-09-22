<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post'>
	
	<div class='loginTitle'></div>
	<div class='loginUsernameIMG'></div>
	<div class='loginUsernameTextboxDiv' >
		<input type='text' name='user' class='loginTextbox'>
	</div>
	
	<div class='loginPasswordIMG'></div>
	<div class='loginPasswordTextboxDiv' >
		<input type='password' name='pass' class='loginTextbox'>
	</div>
	
	<div class='rememberMeIMG'></div>
	<div class='rememberMeCheckbox' id='fakeRememberMe'></div>
	<div class='loginButton' id='btnFakeLoginSubmit'></div>
	<input type='hidden' value='0' id='realRememberMe' name='rememberme'>
	<input type='submit' name='submit' value='submit' id='btnRealLoginSubmit' style='display: none'>

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
	//<div class='loggedinTitle'></div>
	$dispLoggedinBox = "
		<div class='loggedinTitle'></div>
		<div class='loggedinUserInfo'>
			".$arrLoginInfo['memberRank']."<br>
			<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']."</a>
		</div>
		<div class='loggedinUserLinks'>
			<a href='".$MAIN_ROOT."members'>MY ACCOUNT</a> - <a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM INBOX ".$arrLoginInfo['pmCountDisp']."</a><span style='font-size: 5px'><br><br></span><a href='".$MAIN_ROOT."members/signout.php'>SIGN OUT</a>
		</div>

	";

	
	
	return $dispLoggedinBox;
}


?>