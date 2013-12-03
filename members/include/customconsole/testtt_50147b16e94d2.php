<?php
date_default_timezone_set("America/New_York");
include("../_functions.php");


$setBillboards = autoSetAllMajorBillboards();

if($setBillboards == 1) {
$time = time(); //mktime(14,35,12,3,26,2011);

/*
$currentDayOfWeek = date("w", $time);

$endOfFriday = 0;
if($currentDayOfWeek == 0) { // Sunday
$lastFriday = $time - 172800; // Time - 2 Days
}
elseif($currentDayOfWeek == 6) { // Saturday
$lastFriday = $time - 86400;
}

if($currentDayOfWeek == 0 OR $currentDayOfWeek == 6) {
$fridayDay = date("j", $lastFriday);
$fridayMonth = date("n", $lastFriday);
$fridayYear = date("Y", $lastFriday);

$endOfFriday = mktime(23,59,59,$fridayMonth, $fridayDay, $fridayYear);
}


$expDay = $endOfFriday+777600;
*/
$expDay = getBillboardExpiration();
$expDay = $expDay+604800;
echo "Billboards Expiring: ".date("n/j/Y", $expDay)."<br><br>";
$query = "SELECT * FROM billboard_winners WHERE expday = '$expDay'";
$result = mysql_query($query)
     or die(mysql_error());
while($row = mysql_fetch_array($result))
{
extract($row);
$memberName = getMemberInfoByID("username", $memberid);
$contentTitle = getContentInfo("title", $contentid);
echo "
Spot: $pageid<br>
Winner: $memberName<br>
Content: $contentTitle - $contentid<br>
<br>
";

}

}

?>