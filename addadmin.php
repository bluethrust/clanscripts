<?php

include("_setup.php");
include_once("classes/member.php");



$ADMIN_USERNAME = "NewAdmin";
$ADMIN_PASSWORD = "asdf";


$memberObj = new Member($mysqli);

if(!$memberObj->select($ADMIN_USERNAME)) {

	$memberObj->addNew(array("username", "datejoined", "lastlogin", "rank_id"), array($ADMIN_USERNAME, time(), time(), 1));

	$memberObj->set_password($ADMIN_PASSWORD);
	
	echo "
		Admin Account Added:<br><br>
		
		Username: ".$ADMIN_USERNAME."<br>
		Password: ".$ADMIN_PASSWORD;	
	
}
else {
	echo "There is already a member with the username ".$ADMIN_USERNAME;	
}


?>