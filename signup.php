<?php

/*
 * Bluethrust Clan Scripts v4
 * Copyright 2014
 *
 * Author: Bluethrust Web Development
 * E-mail: support@bluethrust.com
 * Website: http://www.bluethrust.com
 *
 * License: http://www.bluethrust.com/license.php
 *
 */

// Config File
$prevFolder = "";

include($prevFolder."_setup.php");
include($prevFolder."classes/member.php");
include_once($prevFolder."classes/rank.php");
include_once($prevFolder."classes/basicorder.php");


// Start Page
$PAGE_NAME = "Sign Up - ";
$dispBreadCrumb = "";
include($prevFolder."themes/".$THEME."/_header.php");

$member = new Member($mysqli);
$rankObj = new Rank($mysqli);

$consoleObj = new ConsoleOption($mysqli);

$appComponentObj = new BasicOrder($mysqli, "app_components", "appcomponent_id");
$appComponentObj->set_assocTableName("app_selectvalues");
$appComponentObj->set_assocTableKey("appselectvalue_id");

$appSelectValueObj = new Basic($mysqli, "app_selectvalues", "appselectvalue_id");

if(($member->select($_SESSION['btUsername']) && $member->authorizeLogin($_SESSION['btPassword'])) || $websiteInfo['memberregistration'] == 1) {
	echo "
		<script type='text/javascript'>
			window.location = '".$MAIN_ROOT."'
		</script>
	";
	exit();
}


?>

<div class='breadCrumbTitle'>Sign Up</div>
<div class='breadCrumb' style='padding-top: 0px; margin-top: 0px'>
	<a href='<?php echo $MAIN_ROOT; ?>'>Home</a> > Sign Up
</div>


<?php


$countErrors = 0;
$dispError = "";

if($_POST['submit']) {
	
	
	// Check Username
	
	if(trim($_POST['newusername']) == "") {
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You may not have a blank username.<br>";
		$countErrors++;
	}
	
	if($member->select($_POST['newusername'])) {
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> There is already a member with that username.<br>";
		$countErrors++;
	}
	
	
	// Check Password
	
	if(trim($_POST['newuserpass']) == "") {
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You may not have a blank password.<br>";
		$countErrors++;
	}
	
	if($_POST['newuserpass'] != $_POST['newuserpass1']) {
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Your password did not match when re-entered.<br>";
		$countErrors++;
	}
	
	// Check E-mail
	
	if(trim(str_replace("@", "", $_POST['newuseremail'])) == "" || strpos($_POST['newuseremail'], "@") === false) {
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You entered an invalid e-mail address.<br>";
		$countErrors++;
	}
	
	$filterEmail = $mysqli->real_escape_string($_POST['newuseremail']);
	$result = $mysqli->query("SELECT email FROM ".$dbprefix."members WHERE email = '".$filterEmail."'");
	if($result->num_rows > 0) {
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> There is already a member registered with that e-mail address.<br>";
		$countErrors++;
	}
	
	$result = $mysqli->query("SELECT email FROM ".$dbprefix."memberapps WHERE email = '".$filterEmail."'");
	if($result->num_rows > 0) {
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> There is already a member application with that e-mail address.<br>";
		$countErrors++;
	}
	
	
	// Check IP Address
	
	$checkIP = $mysqli->query("SELECT ipaddress FROM ".$dbprefix."memberapps WHERE ipaddress = '".$IP_ADDRESS."'");
	if($checkIP->num_rows > 0) {
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You have already applied to join.<br>";
		$countErrors++;
	}
	
	
	// Check Required Custom Fields
	
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."app_components WHERE required = '1' AND (componenttype != 'captcha' OR componenttype != 'captchaextra')");
	while($row = $result->fetch_assoc()) {
		
		$arrOneInputs = array("input", "largeinput");
		
		if(in_array($row['componenttype'], $arrOneInputs)) {
			$postName = "appcomponent_".$row['appcomponent_id'];
			
			if(trim($_POST[$postName]) == "") {
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You may not leave ".filterText($row['name'])." blank.<br>";
				$countErrors++;
			}
			
		}
		elseif($row['componenttype'] == "select") {
			$postName = "appcomponent_".$row['appcomponent_id'];
			$appComponentObj->select($row['appcomponent_id']);
			$arrSelectValueIDs = $appComponentObj->getAssociateIDs();
			
			foreach($arrSelectValueIDs as $selectValueID) {
				$appSelectValueObj->select($selectValueID);
				
				$arrSelectValues[] = $appSelectValueObj->get_info_filtered("componentvalue");
			}
			
			if(!in_array($_POST[$postName], $arrSelectValues)) {
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid value for ".filterText($row['name']).".<br>";
				$countErrors++;
			}
			
		}
		else {
			$appComponentObj->select($row['appcomponent_id']);
			$arrSelectValueIDs = $appComponentObj->getAssociateIDs();
			$countSelectedOptions = 0;
			foreach($arrSelectValueIDs as $selectValueID) {
				$postName = "appcomponent_".$row['appcomponent_id']."_".$selectValueID;

				if($_POST[$postName] == 1) {
					$countSelectedOptions++;	
				}
				
			}
			
			if($countSelectedOptions == 0) {
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You must select at least one option for ".filterText($row['name']).".<br>";
				$countErrors++;
			}
			
		}			
	}
	
	// Check for captchas
	$filterIP = $mysqli->real_escape_string($IP_ADDRESS);
	$result = $mysqli->query("SELECT * FROM ".$dbprefix."app_components WHERE componenttype = 'captcha' OR componenttype = 'captchaextra'");
	while($row = $result->fetch_assoc()) {

		$result2 = $mysqli->query("SELECT * FROM ".$dbprefix."app_captcha WHERE ipaddress = '".$filterIP."' AND appcomponent_id = '".$row['appcomponent_id']."'");
		if($result2->num_rows > 0) {
			$checkArr = $result2->fetch_assoc();
			$postName = "appcomponent_".$row['appcomponent_id'];
			if($checkArr['captchatext'] != strtolower($_POST[$postName])) {
				$countErrors++;
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You entered an incorrect value for ".filterText($row['name']).".<br>";
			}
		}
		
	}
	
	
	if($countErrors == 0) {
		
		$memberAppObj = new Basic($mysqli, "memberapps", "memberapp_id");
		$memberAppValueObj = new Basic($mysqli, "app_values", "appvalue_id");
		
		$arrColumns = array("username", "password", "password2", "email", "applydate", "ipaddress");
		
		// Encrypt Password
		
		// Generate New Salt
		$randomString = substr(md5(uniqid("", true)),0,22);
		$randomNum = rand(4,10);
		if($randomNum < 10) {
			$randomNum = "0".$randomNum;
		}
		
		$strSalt = "$2a$".$randomNum."$".$randomString;
		$encryptPassword = crypt($_POST['newuserpass'], $strSalt);
		
		$arrValues = array($_POST['newusername'], $encryptPassword, $strSalt, $_POST['newuseremail'], time(), $IP_ADDRESS);
		
		if($memberAppObj->addNew($arrColumns, $arrValues)) {
			$memberAppID = $memberAppObj->get_info("memberapp_id");
			
			$arrValueColumns = array("appcomponent_id", "memberapp_id", "appvalue");
			
			$result = $mysqli->query("SELECT * FROM ".$dbprefix."app_components");
			while($row = $result->fetch_assoc()) {
				
				$arrOneInputs = array("input", "largeinput", "select");
		
				if(in_array($row['componenttype'], $arrOneInputs)) {
					$postName = "appcomponent_".$row['appcomponent_id'];
					
					$arrValueValues = array($row['appcomponent_id'], $memberAppID, $_POST[$postName]);
					if(!$memberAppValueObj->addNew($arrValueColumns, $arrValueValues)) {
						$countErrors++;	
					}
					
				}
				elseif($row['componenttype'] != "captcha" || $row['componenttype'] != "captchaextra") {
					$appComponentObj->select($row['appcomponent_id']);
					$arrSelectValueIDs = $appComponentObj->getAssociateIDs();
					$countSelectedOptions = 0;
					foreach($arrSelectValueIDs as $selectValueID) {
						$postName = "appcomponent_".$row['appcomponent_id']."_".$selectValueID;
						$appSelectValueObj->select($selectValueID);
						$selectValue = $appSelectValueObj->get_info_filtered("componentvalue");
						if($_POST[$postName] == 1) {
							
							$arrValueValues = array($row['appcomponent_id'], $memberAppID, $selectValue);
							if(!$memberAppValueObj->addNew($arrValueColumns, $arrValueValues)) {
								$countErrors++;
							}
						}
						
					}
					
				}
				
			}

			
			if($websiteInfo['memberapproval'] == 0) {
				
				$rankObj->selectByOrder(2);
				$newMemRank = $rankObj->get_info("rank_id");
				
				$arrColumns = array("username", "password", "password2", "rank_id", "email", "datejoined", "lastlogin", "lastseen");
				$arrValues = array($_POST['newusername'], $encryptPassword, $strSalt, $newMemRank, $_POST['newuseremail'], time(), time(), time());
				if(!$member->addNew($arrColumns, $arrValues)) {
					$countErrors++;
				}
				else {
					$memberAppObj->update(array("memberadded"), array(1));	
				}

			}
			
			
			if($countErrors == 0) {
				
				$additionalInfo = "<br><br>You may now log in to your account.";
				if($websiteInfo['memberapproval'] == 1) {
					$additionalInfo = "<br><br>You must wait to be approved by a member to become a full member on the website.";	
				}
				
				echo "
				
				<div style='display: none' id='successBox'>
					<p align='center' class='main'>
						You have successfully signed up to join ".$websiteInfo['clanname']."!".$additionalInfo."
					</p>
				</div>
				
				<script type='text/javascript'>
					popupDialog('Sign Up', '".$MAIN_ROOT."', 'successBox');
				</script>
				
				";
				
				
				$memberInfo = $member->get_info();
				$member->selectAdmin();
				if($member->get_info("email") != "") {
				
					$siteDomain = $_SERVER['SERVER_NAME'];
					
					$toEmail = $member->get_info("email");
					$subjectEmail = $websiteInfo['clanname'].": Member Application Accepted";
					
					$messageEmail = "A new member, ".$_POST['newusername'].", has signed up at your website: <a href='http://".$siteDomain.$MAIN_ROOT."'>".$websiteInfo['clanname']."</a>!";
					
					$fromEmail = "admin@".$siteDomain;
					$headersEmail = "MIME-Version: 1.0\r\n";
					$headersEmail .= "Content-type: text/html; charset=iso-8859-1\r\n";
					$headersEmail .= "To: Website Admin <".$toEmail.">\r\n";
					$headersEmail .= "From: ".$websiteInfo['clanname']." <".$fromEmail.">\r\n";
					
					mail($toEmail, $subjectEmail, $messageEmail, $headersEmail);
					
				}

				$intViewMemberAppCID = $consoleObj->findConsoleIDByName("View Member Applications");
				$member->postNotification("A new member has signed up!  Go to the <a href='".$MAIN_ROOT."members/console.php?cID=".$intViewMemberAppCID."'>View Member Applications</a> page to review the application.");
				$member->select($memberInfo['member_id']);
				
				
			}
			else {
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save information to the database.  Please contact the website administrator.<br>";
			}
			
		}
		
		
	}
	
	
	
	
	if($countErrors > 0) {
		$_POST = filterArray($_POST);
		$_POST['submit'] = false;
		
	}
	
	
	
}

if(!$_POST['submit']) {
	
	echo "<div class='formDiv'>";
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to sign up because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	
echo "
	Use the form below to sign up to join ".$websiteInfo['clanname'].".";
if($websiteInfo['memberapproval'] == 1) {
	echo "  After signing up, you must be approved by a member before becoming a full member on the website.";
}

echo "
	<form action='".$MAIN_ROOT."signup.php' method='post'>
	<table class='formTable'>
		<tr>
			<td colspan='2' class='main'>
				<b>General Information</b>
				<div class='dottedLine' style='width: 90%; padding-top: 3px; margin-bottom: 5px'></div>
			</td>
		</tr>
		<tr>
			<td class='formLabel'>Username:</td>
			<td class='main'><input type='text' class='textBox' name='newusername' value='".$_POST['newusername']."' style='width: 200px'></td>
		</tr>
		<tr>
			<td class='formLabel'>Password:</td>
			<td class='main'><input type='password' class='textBox' name='newuserpass' style='width: 200px'></td>
		</tr>
		<tr>
			<td class='formLabel'>Re-enter Password:</td>
			<td class='main'><input type='password' class='textBox' name='newuserpass1' style='width: 200px'></td>
		</tr>
		<tr>
			<td class='formLabel'>E-mail:</td>
			<td class='main'><input type='text' class='textBox' name='newuseremail' value='".$_POST['newuseremail']."' style='width: 200px'></td>
		</tr>
";
		
		$result = $mysqli->query("SELECT appcomponent_id FROM ".$dbprefix."app_components");
		if($result->num_rows > 0) {	
			
			echo "
				<tr>
					<td colspan='2' class='main'><br>
						<b>Application Questions</b>
						<div class='dottedLine' style='width: 90%; padding-top: 3px; margin-bottom: 5px'></div>
					</td>
				</tr>
			";
		
			$result = $mysqli->query("SELECT appcomponent_id FROM ".$dbprefix."app_components ORDER BY ordernum DESC");
			while($row = $result->fetch_assoc()) {
				
				$appComponentObj->select($row['appcomponent_id']);
				$arrAppCompInfo = $appComponentObj->get_info_filtered();
				
				$formInputName = "appcomponent_".$arrAppCompInfo['appcomponent_id'];
				$dispInput = "";
				switch($arrAppCompInfo['componenttype']) {
					
					case "largeinput":
						$dispInput = "<textarea rows='5' cols='45' name='".$formInputName."' class='textBox'>".$_POST[$formInputName]."</textarea>";
						break;
					case "select":
					
						$dispOptions = "";
						$arrSelectValueIDs = $appComponentObj->getAssociateIDs("ORDER BY componentvalue");
						
						foreach($arrSelectValueIDs as $selectValueID) {
							
							$appSelectValueObj->select($selectValueID);
							$optionValue = $appSelectValueObj->get_info_filtered("componentvalue");
							$dispOptions .= "<option value='".$optionValue."'>".$optionValue."</option>";
							
						}
						
						
						$dispInput = "<select name='".$formInputName."' class='textBox'>".$dispOptions."</select>";
						break;
					case "multiselect":
						
						$arrSelectValueIDs = $appComponentObj->getAssociateIDs("ORDER BY componentvalue");
			
						foreach($arrSelectValueIDs as $selectValueID) {
						
							$appSelectValueObj->select($selectValueID);
							$optionValue = $appSelectValueObj->get_info_filtered("componentvalue");
							$dispInput .= "<input type='checkbox' name='".$formInputName."_".$selectValueID."' value='1'> ".$optionValue."<br>";
						
						}
						
						break;
					case "captcha":
						$dispInput .= "<input type='text' name='".$formInputName."' class='textBox'>&nbsp;&nbsp;&nbsp<a href='javascript:void(0)' data-refresh='1' data-image='".$formInputName."_image' data-appid='".$arrAppCompInfo['appcomponent_id']."'>Refresh Image</a><br><br><div id='".$formInputName."_image' style='margin-bottom: 25px'><img src='".$MAIN_ROOT."images/captcha.php?appCompID=".$arrAppCompInfo['appcomponent_id']."' width='440' height='90'></div>";
						break;
					case "captchaextra":
						$dispInput .= "<input type='text' name='".$formInputName."' class='textBox'>&nbsp;&nbsp;&nbsp<a href='javascript:void(0)' data-refresh='1' data-image='".$formInputName."_image' data-appid='".$arrAppCompInfo['appcomponent_id']."'>Refresh Image</a><br><br><div id='".$formInputName."_image' style='margin-bottom: 25px'><img src='".$MAIN_ROOT."images/captcha.php?appCompID=".$arrAppCompInfo['appcomponent_id']."' width='440' height='90'></div>";
						break;
					default:
						$dispInput = "<input type='text' name='".$formInputName."' value='".$_POST[$formInputName]."' class='textBox' style='width: 150px'>";				
					
				}
				
				
				$dispToolTip = "";
				if($arrAppCompInfo['tooltip'] != "") {
					$dispToolTip = "<div style='display: none' id='tooltip_".$row['appcomponent_id']."'>".nl2br($arrAppCompInfo['tooltip'])."</div> <a href='javascript:void(0)' onmouseover=\"showToolTip($('#tooltip_".$row['appcomponent_id']."').html())\" onmouseout='hideToolTip()'><b>(?)</b></a>";				
				}
				echo "
				<tr>
					<td class='formLabel' valign='top'>".$arrAppCompInfo['name'].":".$dispToolTip."</td>
					<td class='main' valign='top'>".$dispInput."</td>
				</tr>
				
				";
				
			}
			
		}
		echo "
		<tr>
			<td colspan='2' class='main' align='center'>
				<br>
				<input type='submit' name='submit' value='Sign Up' class='submitButton' style='width: 125px'><br>
			</td>
		</tr>
	</table>
	</form>
	
	<script type='text/javascript'>
	
		$(document).ready(function() {
		
			$(\"a[data-refresh='1']\").click(function() {
						
				var imgDivID = '#'+$(this).attr('data-image');
				
				$(imgDivID).fadeOut(250);
				
				
				$.post('".$MAIN_ROOT."images/captcha.php?display=1&appCompID='+$(this).attr('data-appid'), { }, function(data) {
					$(imgDivID).html(data);
					$(imgDivID).fadeIn(250);
				});
				
			});
		
		});
	
	</script>
	
	";

} ?>
</div>
<?php include($prevFolder."themes/".$THEME."/_footer.php"); ?>