<?php

/*
 * Bluethrust Clan Scripts v4
 * Copyright 2012
 *
 * Author: Bluethrust Web Development
 * E-mail: support@bluethrust.com
 * Website: http://www.bluethrust.com
 *
 * License: http://www.bluethrust.com/license.php
 *
 */

if(!isset($member) || substr($_SERVER['PHP_SELF'], -11) != "console.php") {
	exit();
}
else {
	$memberInfo = $member->get_info();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}


include_once($prevFolder."classes/tournament.php");

$cID = $_GET['cID'];
$dispError = "";
$countErrors = 0;

$tournamentObj = new Tournament($mysqli);



echo "


	<div class='formDiv'>
		Use the form below to connect to an outside tournament.  Once connected, a new tournament will be set up on your website based off of the connected tournament.  You will become the tournament manager on your website.  Any changes to the tournament will be reflected across each clan's website that is connected to the tournament.
	
		<table class='formTable'>
			<tr>
				<td class='formLabel'>Connect URL: <a href='javascript:void(0)' onmouseover=\"showToolTip('Enter the connect url that appears on the tournament\'s profile page.')\" onmouseout='hideToolTip()'><b>(?)</b></a></td>
				<td class='main'><input type='textbox' class='textBox' name='connecturl' style='width: 200px'></td>
			</tr>
			<tr>
				<td class='formLabel'>Connect Password: <a href='javascript:void(0)' onmouseover=\"showToolTip('Ask the tournament manager of the tournament you want to connect to for the connect password.')\" onmouseout='hideToolTip()'><b>(?)</b></a></td>
				<td class='main'><input type='password' class='textBox' name='connecturl' style='width: 200px'></td>
			</tr>
			<tr>
				<td class='main' colspan='2' align='center'><br>
					<input type='submit' name='submit' value='Connect' class='submitButton'>
				</td>
			</tr>
		</table>
		
	</div>


";


echo $tournamentObj->connect("http://localhost/cs4git/tournaments/connect.php?tID=1", 1);

?>