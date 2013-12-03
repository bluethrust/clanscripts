<?php

include("_setup.php");
include_once("classes/member.php");

$member = new Member($mysqli);

if($_POST['submit']) {

	if($member->select($_POST['adminaccount']) && $member->set_password($_POST['newpassword'])) {
	
		echo "New Admin Password Set!<br><br>";
	
	}

}



$result = $mysqli->query("SELECT * FROM ".$dbprefix."members WHERE rank_id = '1'");
while($row = $result->fetch_assoc()) {

	$options .= "<option value='".$row['member_id']."'>".$row['username']."</option>";


}

echo "

	<form action='resetadminpassword.php' method='post'>
	
		Admin Account: <select name='adminaccount'>".$options."</select><br>
		Set New Password: <input type='text' name='newpassword'><br>
		<input type='submit' name='submit' value='Change Password'>
	
	</form>

	<br><br>
	<a href='deleteadminaccount.php'>Delete an Admin Account</a>

";


?>