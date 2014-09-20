<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<div id='username'>
<form action='".$MAIN_ROOT."login.php' method='post'>
<input type='text' name='user' id='userfield' placeholder='Username'>
</div>
<div id='password'>
<input type='password' name='pass' id='passfield' placeholder='Password'>
</div>
<div id='remember'>
<input type='checkbox' value='1' name='rememberme' id='rememberme'><label for='rememberme'></label>
</div>
<div id='gap'></div>
<div id='loginbutton'><input type='submit' name='submit' value='Log In'></form>
</div>
<div id='juiced'></div>
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
		$memberInfo['profilepic'] = $MAIN_ROOT."themes/synergy/images/defaultprofile.png";
	}
	else {
		$memberInfo['profilepic'] = $MAIN_ROOT.$memberInfo['profilepic'];
	}
	
	
	
	$dispLoggedinBox = "
<div id='loggedin'></div>

<div id='memberphoto'>
<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'><img src='".$memberInfo['profilepic']."' style='width: 53px; height: 70px; border: solid black 0px'></a>
</div>
<div id='accountoptions'>
<a href='".$MAIN_ROOT."members'>Options</a><br>
<a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a><br>
<a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a>
</div>
<div id='accountname'>
<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']." </a> &middot; ".$arrLoginInfo['memberRank']."
</div>
<div id='juiced'></div>
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