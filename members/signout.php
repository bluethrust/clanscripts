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

include("../_setup.php");
include_once("../classes/member.php");
$memberObj = new Member($mysqli);

if($memberObj->select($_SESSION['btUsername']) && $memberObj->authorizeLogin($_SESSION['btPassword'])) {
	$memberObj->update(array("loggedin"), array(0));
}

setcookie("btSessionID", "", time()-3600);
$_SESSION['btPassword'] = "";
$_SESSION['btUsername'] = "";
$_SESSION['btRememberMe'] = "";

echo "
<script type='text/javascript'>
window.location = '".$MAIN_ROOT."';
</script>
";


?>