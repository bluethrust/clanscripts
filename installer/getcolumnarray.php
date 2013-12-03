<?php

include("../_config.php");

include_once("../classes/btmysql.php");
include_once("../classes/basic.php");

$mysqli = new btmysql($dbhost, $dbuser, $dbpass, $dbname);


$result = $mysqli->query("SHOW TABLES");
$arrTestTables = array();

while($row = $result->fetch_array()) {
	if($row[0] != "tournament_connect") {
		$arrTestTables[] = $row[0];
	}
}



$counter = 0;
$arrTables = array();
foreach($arrTestTables as $tableName) {
	
	$counter2 = 0;
	$result = $mysqli->query("DESCRIBE ".$tableName);
	while($row = $result->fetch_assoc()) {
	
		$arrTables[$tableName][] = $row;
		echo "$"."arrTableColumns['".$tableName."'][".$counter2."] = \"".$row['Field']."\";<br>";
		
		$counter2++;
	}
	echo "<br>";
	$counter++;
}


?>