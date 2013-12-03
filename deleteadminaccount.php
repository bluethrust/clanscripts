<?php

include("_setup.php");
include_once("classes/member.php");

$member = new Member($mysqli);

if($_POST['submit']) {

	if($member->select($_POST['adminaccount']) && $member->delete()) {
	
		echo "Admin Account Deleted!<br><br>";
	
	}

}



$result = $mysqli->query("SELECT * FROM ".$dbprefix."members WHERE rank_id = '1'");
while($row = $result->fetch_assoc()) {

	$options .= "<option value='".$row['member_id']."'>".$row['username']."</option>";


}

echo "

	<form action='deleteadminaccount.php' method='post'>
	
		Admin Account: <select name='adminaccount'>".$options."</select><br>
		<input type='submit' name='submit' value='Delete Account'>
	
	</form>

	<br><br>
	<a href='resetadminpassword.php'>Reset Admin Account Password</a>

";


?>