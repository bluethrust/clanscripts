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

$i=0;
foreach($arrTestTables as $value) {
	echo "$"."arrTableNames[".$i."] = \"".$value."\";<br>";
	$i++;
}

?>