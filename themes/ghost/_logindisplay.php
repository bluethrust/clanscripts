<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
	<div class='loginText_Username'></div>
	<div class='loginTextbox_Username'>
		<input type='text' name='user' class='loginTextbox'>
	</div>
	
	<div class='loginText_Password'></div>
	<div class='loginTextbox_Password'>
		<input type='password' name='pass' class='loginTextbox'>
	</div>
	
	<div class='loginText_RememberMe' style='top: 83px'></div>
	<div class='loginRememberMeBox' style='top: 78px' id='fakeRememberMe'></div>
	<input type='submit' name='submit' value='Login' id='btnLogin' style='display: none'>
	<div class='loginButton' id='btnFakeLogin'></div>
	
	<div style='position: absolute; top: 102px; left: 29px'>Sign in with Facebook</div>
	
	<input type='hidden' value='0' id='rememberMe' name='rememberme'>
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
		$memberInfo['profilepic'] = $MAIN_ROOT."themes/ghost/images/defaultprofile.png";
	}
	else {
		$memberInfo['profilepic'] = $MAIN_ROOT.$memberInfo['profilepic'];
	}
	
	$dispLoggedinBox = "
	
		<div class='loggedInProfilePic'>
			<img src='".$memberInfo['profilepic']."' style='width: 75px; height: 100px; border: solid #4c555f 1px'>
		</div>
		
		<div class='loggedInInfo'>
			<div style='margin-bottom: 5px'>
				<b>Account Name:</b><br>
				<a href='".$MAIN_ROOT."profile.php?mID=".$memberInfo['member_id']."'>".$memberInfo['username']."</a>
			</div>
			<div style='margin-bottom: 8px'>
				<b>Rank:</b><br>
				".$arrLoginInfo['memberRank']."
			</div>
			<div style='text-align: center'>
				<b>Member Options:</b><br>
				<a href='".$MAIN_ROOT."members'>My Account</a> - <a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a> - <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a>
			</div>
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