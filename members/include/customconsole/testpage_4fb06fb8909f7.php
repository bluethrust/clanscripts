<?php include("config.php");

include("themes/$theme/header.php");
$membername = $_SESSION['membername'];
$memberpass = $_SESSION['memberpass'];


if(checkLogin($membername, $memberpass)) {
$time = time();
$query = "UPDATE {$dbprefix}members SET lastlogin = '$time', loggedin = '1', ipnum = '$ip' WHERE username = '$membername'";
$result = mysql_query($query)
	or die(mysql_error());

$memrank = getMemberInfo("rank", $membername);
$memid = getMemberInfo("id", $membername);
$memrankcat = getRankCatInfo("name", $memrank);
define("MEMBER_RANK", $memrank);
define("MEMBER_NAME", $membername);
define("MEMBER_PASS", $memberpass);

UpdateRecruits($memid);


if($pid == "") {

include("include/console/main.php");

}
else {
$url = getConsoleInfoById("url", $pid);
include($url);

}



}
else {
echo "
<br>
<center><blockquote>You must login to view this page.</blockquote></center>
";
}

echo "
<table align='center' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td class='smalltext'><br><br><b>Powered By: <a href='http://www.bluethrust.com' target='_blank'>BT Clan Scripts v3</a></b><br><br></td>
</tr>
</table>
";

include("themes/$theme/footer.php");


?> 