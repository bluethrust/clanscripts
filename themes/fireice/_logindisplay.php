<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
	<div class='rememberMe_Off' id='rememberMeDiv'></div>
	<div style='position: relative; top: 8px; left: 10px'>
		<div class='loginUsernameImg'></div>
		<input type='text' name='user' class='loginTextbox'>
		<div class='loginPasswordImg'></div>
		<input type='password' name='pass' class='loginTextbox'>
	</div>
	
	<div class='loginRememberMeImg'></div>
	<div class='loginButton' id='btnFakeLogin'></div>
	<input type='submit' name='submit' value='submit' style='display: none' id='btnRealSubmit'>
	<div class='loginRememberMeCheckbox' id='chkRememberMe'></div>
	<input type='hidden' name='remember' value='0' id='rememberMeHidden'>
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
		$memberInfo['profilepic'] = $MAIN_ROOT."themes/fireice/images/defaultprofile.png";
	}
	else {
		$memberInfo['profilepic'] = $MAIN_ROOT.$memberInfo['profilepic'];
	}
	
	
	
	$dispLoggedinBox = "
	
		<div style='position: relative; top: 8px; left: 15px'>
		
			<div style='float: left; width: 75px; height: 75px'>
				<img src='".$memberInfo['profilepic']."' style='width: 56px; height: 75px; border: solid black 1px'>
			</div>
		
			<div style='float: left; width: 175px; overflow: hidden; text-overflow: ellipsis; height: 28px'>
			<b>Account Name:</b><br>
			<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']."</a>
			</div>
			<div style='float: left; width: 175px; overflow: hidden; text-overflow: ellipsis; height: 28px'>
			<b>Rank:</b><br>
			".$arrLoginInfo['memberRank']."
			</div>
			
			<div style='clear: both'></div>
			<div style='position: absolute; top: 40px; left: 75px; width: 400px'>
				<b>Member Options:</b>
				<p style='margin: 0px; padding: 0px'>
					<a href='".$MAIN_ROOT."members'>My Account</a> - 
					<span id='pmLoggedInLink'><a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a></span> - 
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