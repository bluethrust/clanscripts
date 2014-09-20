<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
	<div class='usernameIMG'></div>
	<div class='usernameTextDiv'>
		<input name='user' type='text' class='loginTextbox'>			
	</div>
	
	<div class='passwordIMG'></div>
	<div class='passwordTextDiv'>
		<input name='pass' type='password' class='loginTextbox'>
	</div>
	
	<div class='rememberMeCheckBox' id='fakeRememberMe'></div>
	<div class='rememberMeIMG'></div>
	<div id='fakeSubmit' class='loginButton'></div>
	<input type='checkbox' name='rememberme' value='1' id='realRememberMe' style='display: none'>
	<input type='submit' name='submit' id='realSubmit' style='display: none' value='Log In'>
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
	global $MAIN_ROOT, $zombieEyes;

	/*
	 $arrLoginInfo['memberID'] = $memberID;
	$arrLoginInfo['memberUsername'] = $memberUsername;
	$arrLoginInfo['memberRank'] = $memberRank;
	$arrLoginInfo['pmCID'] = $pmCID;
	$arrLoginInfo['pmCount'] = $dispPMCount;
	*/

	if($arrLoginInfo['pmAlert'] == 1) {
		$zombieEyes = true;
	}
	
	$memberInfo = $arrLoginInfo['memberInfo'];
	
	if($memberInfo['profilepic'] == "") {
		$memberInfo['profilepic'] = $MAIN_ROOT."themes/guildwars/images/defaultprofile.png";
	}
	else {
		$memberInfo['profilepic'] = $MAIN_ROOT.$memberInfo['profilepic'];
	}
	
	
	
	$dispLoggedinBox = "
		<div class='loggedInIMG'></div>
		<div class='loggedInProfilePic'><img src='".$memberInfo['profilepic']."' style='width: 45px; height: 60px'></div>
		<div class='loggedInMemberNameIMG'></div>
		<div class='loggedInMemberNameText'>
			<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']."</a>
		</div>
		<div class='loggedInRankIMG'></div>
		<div class='loggedInRankText'>
			".$arrLoginInfo['memberRank']."
		</div>
		
		<div class='loggedInMemberOptionsSection'>
			<div class='loggedInMemberOptionsIMG'></div>
			<div class='loggedInMemberOptions'>
			
				<a href='".$MAIN_ROOT."members'>My Account</a> - <a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a> - <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a><br>	
			
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