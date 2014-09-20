<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
<div class='rememberMe_Off' id='rememberMeDiv'></div>
		
	<div id='rememberMeSwitch'></div>
	
	<div class='loginBox'>
	
		<div class='loginUsernameDiv'>
			<input type='text' name='user' class='loginTextBox'>
		</div>
		<div class='loginPasswordDiv'>
			<input type='password' name='pass' class='loginTextBox'>
		</div>
		
	</div>
	
	<div id='loginSign'></div>
	
	<input type='hidden' id='txtRememberMe' value='0' name='rememberme'>
	<input type='submit' name='submit' id='btnSubmit' style='display: none'>
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
	
		<div class='loggedInBox'>
		
			<div style='float: left; width: 48%; overflow: hidden; text-overflow: ellipsis; height: 28px'>
			<b>Account Name:</b><br>
			<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']."</a>
			</div>
			<div style='float: right; width: 48%; overflow: hidden; text-overflow: ellipsis; height: 28px'>
			<b>Rank:</b><br>
			".$arrLoginInfo['memberRank']."
			</div>
			<div style='clear: both'></div>
			<div style='margin-top: 3px'>
				<b>Member Options:</b>
				<p align='center' style='margin: 0px; padding: 0px'>
					<a href='".$MAIN_ROOT."members'>My Account</a> - 
					<a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a> - 
					<a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a>
				</p>
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