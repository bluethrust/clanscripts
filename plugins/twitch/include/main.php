<?php

	if(!defined("MAIN_ROOT")) { exit(); }

	global $pluginObj;
	
	$twitchObj = new Twitch($mysqli);
	$pluginInfo = $pluginObj->get_info_filtered();
	

?>

<div class='streamPageContainer'>

<?php $twitchObj->displayAllMemberCards(); ?>

</div>