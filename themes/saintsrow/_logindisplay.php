<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
	<div class='loginUsernameText'></div>
	<div class='loginPasswordText'></div>
	<div class='loginUsernameTextBoxDiv'><input type='text' name='user' class='loginTextbox'></div>
	<div class='loginPasswordTextBoxDiv'><input type='password' name='pass' class='loginTextbox'></div>
	
	<div class='loginButton' id='btnFakeLogInSubmit'></div>
	
	<div class='loginRememberMeText'></div>
	<div class='rememberMeCheckbox'><input type='checkbox' value='1' name='rememberme'></div>
	<div class='loginSectionTitle'>
		<img src='".$MAIN_ROOT."themes/saintsrow/images/layout/memberlogin-notloggedin.png'>
	</div>
	
	<input type='submit' name='submit' style='display: none' id='btnLogInSubmit'>
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
		$memberInfo['profilepic'] = $MAIN_ROOT."themes/saintsrow/images/defaultprofile.png";
	}
	else {
		$memberInfo['profilepic'] = $MAIN_ROOT.$memberInfo['profilepic'];
	}
	
	
	
	$dispLoggedinBox = "
		<div class='loginSectionTitle'>
			<img src='".$MAIN_ROOT."themes/saintsrow/images/layout/memberlogin-loggedin.png'>
		</div>
	
		<div class='loggedInProfilePic'><img src='".$memberInfo['profilepic']."' style='width: 35px; height: 47px'></div>
		<div class='loggedInMemberOptions'>
		<b>Account Name:</b><br>
		<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']."</a><br>
		<b>Rank:</b> ".$arrLoginInfo['memberRank']."<br><span style='font-size: 3px'><br></span>
		<b>Member Options:</b><br>
		<a href='".$MAIN_ROOT."members'>My Account</a> - <a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a> - <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a>
		</div>
		
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