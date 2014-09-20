<?php

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
 * they are not logged in (i.e. a login form!)1
 */

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
	<div class='loginForm'>
		
		<b>USERNAME:</b><br>
		<input type='text' class='textBox' name='user'><br>
		<b>PASSWORD:</b><br>
		<input type='password' class='textBox' name='pass'><br>
		<b>REMEMBER ME:</b> <input type='checkbox' value='1' name='rememberme'><br>
		<input type='submit' name='submit' value='Log In' class='submitButton'>
		
	</div>
</form>
<div class='loginIMG' id='loginIMG'></div>

<div id='loginArrow' class='loginDownArrow'></div>
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
		
		<div class='loggedInIMG'></div>
		<div class='loggedInBar'></div>
	
		<div class='loggedInInfo'>
		
			<b>Rank:</b><br>
			".$arrLoginInfo['memberRank']."
			<hr style='width: 170px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
			<b>Member Options:</b><br>
			<b>&middot;</b> <a href='".$MAIN_ROOT."members'>My Account</a><br>
			<b>&middot;</b> <a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>View Profile</a><br>
			<b>&middot;</b> <a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a><br>
			<b>&middot;</b> <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a><br>
		
		
		</div>	
	
		<div class='loggedInUsername' id='loggedInUsername'>
			<p align='center' style='margin: 0px; padding: 0px' title='Logged in as ".$arrLoginInfo['memberUsername']."'>".$arrLoginInfo['memberUsername']."</p>
		</div>
		
		<script type='text/javascript'>
			
			var intArmyGreenCounter = 0;
			var intCheckLoggedInUser = self.setInterval(function() { checkLoggedInUser(); }, 100);
			var strArmyGreenUsername = $('#loggedInUsername p').text();
			
			function checkLoggedInUser() {
				$(document).ready(function() {
				
					
					if($('#loggedInUsername')[0].scrollWidth > $('#loggedInUsername').width()) {
						$('#loggedInUsername p').text($('#loggedInUsername p').text().substring(0, ($('#loggedInUsername p').text().length-intArmyGreenCounter)));
						intArmyGreenCounter++;
					}
					else if(intArmyGreenCounter > 0) {
					
						$('#loggedInUsername p').text($('#loggedInUsername p').text().substring(0, ($('#loggedInUsername p').text().length-3))+\"...\");
						
						tempVal = $('#loggedInUsername p').text();
						
						//$('#loggedInUsername p').html(\"<span title='\"+strArmyGreenUsername+\"'>\"+tempVal+\"</span>\");
						
						intCheckLoggedInUser = window.clearInterval(intCheckLoggedInUser);
						
					}
					else {
						intCheckLoggedInUser = window.clearInterval(intCheckLoggedInUser);
					}
					
				});
			}
			
			
		
		</script>
		
	";
	
	if($arrLoginInfo['pmCount'] > 1) {
		$addS = "s";
		$addA = " ";	
	}
	else {
		$addS = "";
		$addA = " a ";
	}
	
	if($arrLoginInfo['pmAlert'] == 1) {
		$dispLoggedinBox .= "<div id='loginArrow' class='loginDownArrowRed' title='You have".$addA."new private message".$addS."!'></div>";
	}
	else {
		$dispLoggedinBox .= "<div id='loginArrow' class='loginDownArrow'></div>";	
	}
	
	
	return $dispLoggedinBox;
	
}


?>