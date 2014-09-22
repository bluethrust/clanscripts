<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<div class='loginSectionLeft'>
			
	<a href='".$MAIN_ROOT."signup.php'><img src='".$MAIN_ROOT."images/transparent.png' class='signUpButton'></a>

</div>

<form action='".$MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
<div class='loginSectionRight'>

	<div class='loginInnerDiv'>
		<input type='text' name='user' placeholder='Username''>	
		<input type='password' name='pass' placeholder='Password'>	
	</div>

	<div class='loginInnerDiv'>
		<img src='".$MAIN_ROOT."images/transparent.png' class='rememberMeImg' id='fakeRememberMe'><br>
		<img src='".$MAIN_ROOT."images/transparent.png' class='loginButton' id='btnFakeLoginSubmit'>
		<input type='hidden' name='rememberme' id='realRememberMe'>
		<input type='submit' name='submit' value='submit' style='display: none' id='btnLoginSubmit'>
	</div>
	
	
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
	global $MAIN_ROOT, $mysqli;

	$memberObj = new Member($mysqli);

	$memberInfo = $arrLoginInfo['memberInfo'];
	
	if($memberInfo['avatar'] == "") {
		$memberInfo['avatar'] = $MAIN_ROOT."themes/rockyice/images/defaultavatar.png";
	}
	else {
		$memberInfo['avatar'] = $MAIN_ROOT.$memberInfo['avatar'];
	}
	
	
	$memberObj->select($memberInfo['member_id']);
	$dispLoggedinBox = "
	
		<div class='loginSectionLeft'>
			<div class='loginSectionAvatar'>
				<img src='".$memberInfo['avatar']."'>
			</div>
			<div class='loginInnerDiv loginSectionLoggedInUser'>
				".$arrLoginInfo['memberRank']." ".$this->memberObj->getMemberLink()."
			</div>
		</div>
		

		<div class='loginSectionRight'>
		
			<div class='loginSectionLoggedInOptions'><p align='center'><b>Member Options:</b></p>
				<a href='".$MAIN_ROOT."members'>My Account</a> - <a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a> - <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a>
			</div>
			
		</div>
		
	";
	

	return $dispLoggedinBox;
}

?>