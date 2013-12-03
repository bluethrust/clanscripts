<?php

include("../_config.php");

include_once("../classes/btmysql.php");
include_once("../classes/basic.php");
include_once("../classes/consolecategory.php");

$mysqli = new btmysql($dbhost, $dbuser, $dbpass, $dbname);
$consoleCatObj = new ConsoleCategory($mysqli);


$counter = 0;
$result = $mysqli->query("SELECT * FROM consolecategory ORDER BY ordernum DESC");
while($row = $result->fetch_assoc()) {
	
	echo "$"."arrConsoleCategories[".$counter."] = \"".$row['name']."\";<br>";
	$arrConsoleCategories[$counter] = $row['name'];
	
	$counter++;
}
echo "<br>";

$counter = 0;
$blnAddSeparator = false;
$result = $mysqli->query("SELECT * FROM console ORDER BY consolecategory_id, sortnum");
while($row = $result->fetch_assoc()) {
	
	$consoleCatObj->select($row['consolecategory_id']);	
	$consoleCatInfo = $consoleCatObj->get_info();
	
	$consoleCatID = array_search($consoleCatInfo['name'], $arrConsoleCategories);
	
	if($row['sep'] != "1") {
		
		echo "$"."arrConsoleOptionNames[".$counter."] = \"".$row['pagetitle']."\";<br>";
		
		echo "$"."arrConsoleOptionInfo[".$counter."]['category'] = \"".$consoleCatID."\";<br>";
		echo "$"."arrConsoleOptionInfo[".$counter."]['filename'] = \"".$row['filename']."\";<br>";
		echo "$"."arrConsoleOptionInfo[".$counter."]['sortnum'] = \"".$row['sortnum']."\";<br>";
		echo "$"."arrConsoleOptionInfo[".$counter."]['hide'] = \"".$row['hide']."\";<br>";
		
		echo "$"."arrConsoleOptionInfo[".$counter."]['addsep'] = \""; echo ($blnAddSeparator) ? "1" : "0"; echo "\";<br>";
		
		$blnAddSeparator = false;
		$counter++;
	}
	else {
		$blnAddSeparator = true;	
	}
	
	
	echo "<br>";
}



?>