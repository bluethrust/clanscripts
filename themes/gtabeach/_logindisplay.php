<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
	<div class='loginTitle'></div>
		
	<div class='usernameImgText'></div>
	<div class='loginUsernameTextbox'>
		<input type='text' name='user' class='loginTextbox'>
	</div>
	
	
	<div class='passwordImgText'></div>
	<div class='loginPasswordTextbox'>
		<input type='password' name='pass' class='loginTextbox'>
	</div>
	
	<div class='rememberMeCheckbox' id='fakeRememberMe'></div>
	<div class='rememberMeImgText'></div>
	
	<input type='hidden' name='rememberme' value='0' id='realRememberMe'>
	
	<div class='loginButton' id='btnFakeLoginSubmit'></div>
	<input type='submit' name='submit' id='btnLoginSubmit' style='display: none'>
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

	$memberInfo = $arrLoginInfo['memberInfo'];
	
	if($memberInfo['profilepic'] == "") {
		$memberInfo['profilepic'] = $MAIN_ROOT."themes/tf2blue/images/defaultprofile.png";
	}
	else {
		$memberInfo['profilepic'] = $MAIN_ROOT.$memberInfo['profilepic'];
	}
	
	$hideAlertImg = ($arrLoginInfo['pmAlert'] != 1) ? " style='display: none'" : "";

	
	$dispLoggedinBox = "
	
		<div class='loggedinTitle'></div>
		<div class='loggedInUsername'>
			".$arrLoginInfo['memberUsername']."
		</div>
		
		<a href='".$MAIN_ROOT."members'><div class='loggedin_myAccountButton'></div></a>
		<a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'><div class='loggedin_pmInboxButton'><div class='loggedin_pmAlert'".$hideAlertImg."></div></div></a>
		<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'><div class='loggedin_profileButton'></div></a>
		<a href='".$MAIN_ROOT."members/signout.php'><div class='loggedin_logOutButton'></div></a>
	
	";	
	
	/*
		<div class='loggedInIMG'></div>
		<div class='menuLinks' style='padding-left: 8px'>
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
	*/
	
	
	return $dispLoggedinBox;
}

?>