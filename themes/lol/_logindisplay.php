<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post' style='position: relative; padding: 0px; margin: 0px'>
	<p class='menuItem'>
		Username:
		<input type='text' name='user' class='loginTextbox'>
	</p>
	<p class='menuItem'>
		Password:
		<input type='password' name='pass' class='loginTextbox'>
	</p>
	<p class='menuItem'>Remember Me: <input type='checkbox' name='rememberme' value='1'></p>
	<p class='menuItem' style='padding-left: 3px; padding-top: 3px; font-size: 12px'><a href='".$MAIN_ROOT."signup.php'>Sign Up</a><br><a href='".$MAIN_ROOT."forgotpassword.php'>Forgot Password?</a></p>
	<p class='menuItem'>
		<input type='submit' name='submit' class='loginSubmitButton' value='Log In'>
	</p>
	<div style='clear: both'></div>
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
	global $MAIN_ROOT, $mysqli;

	$memberObj = new Member($mysqli);
	
	/*
	 $arrLoginInfo['memberID'] = $memberID;
	$arrLoginInfo['memberUsername'] = $memberUsername;
	$arrLoginInfo['memberRank'] = $memberRank;
	$arrLoginInfo['pmCID'] = $pmCID;
	$arrLoginInfo['pmCount'] = $dispPMCount;
	*/

	$memberInfo = $arrLoginInfo['memberInfo'];
	
	$memberObj->select($memberInfo['member_id']);
	$dispLoggedinBox = "
		<div class='loggedInSection'>
			<b>Account Name:</b><br>
			<p>".$memberObj->getMemberLink()."</p>
			<div class='dottedLine' style='margin: 5px 0px'></div>
			<b>Rank:</b>
			<p>".$arrLoginInfo['memberRank']."</p>
			<div class='dottedLine' style='margin: 5px 0px'></div>
			<b>Member Options:</b><br>
			<ul class='loggedInMenuList'>
				<li><a href='".$MAIN_ROOT."members'>My Account</a></li>
				<li><a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a></li>
				<li><a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a></li>
			</ul>
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