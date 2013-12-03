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

if(!isset($member) || substr($_SERVER['PHP_SELF'], -11) != "console.php") {
	exit();
}
else {
	$memberInfo = $member->get_info_filtered();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}
include_once($prevFolder."classes/medal.php");
$cID = $_GET['cID'];

$medalObj = new Medal($mysqli);




if($_GET['mID'] == "") {
	
	
	echo "
		<div id='loadingSpiral' class='loadingSpiral'>
			<p align='center'>
				<img src='".$MAIN_ROOT."themes/".$THEME."/images/loading-spiral.gif'><br>Loading
			</p>
		</div>
		
		
		<div id='contentDiv'>
	";
	include("medals/main.php");
	
	echo "
		<div id='deleteMessage' style='display: none'></div>
	</div>
	
	<script type='text/javascript'>
	
		function moveMedal(strDir, intMedalID) {
			$(document).ready(function() {
				$('#loadingSpiral').show();
				$('#contentDiv').hide();
				$.post('".$MAIN_ROOT."members/include/admin/medals/move.php', {
					mDir: strDir, mID: intMedalID }, function(data) {
						$('#contentDiv').html(data);
						$('#loadingSpiral').hide();
						$('#contentDiv').fadeIn(400);
					});
		
			});
		}
		
		
		function deleteMedal(intMedalID) {
			$(document).ready(function() {				
			
				$.post('".$MAIN_ROOT."members/include/admin/medals/delete.php', { mID: intMedalID }, function(data) {
			
					
					$('#deleteMessage').dialog({
				
						title: 'Manage Medals - Delete',
						width: 400,
						modal: true,
						zIndex: 9999,
						resizable: false,
						show: 'scale',
						buttons: {
							'Yes': function() {
								
								$('#loadingSpiral').show();
								$('#contentDiv').hide();
								$(this).dialog('close');
								$.post('".$MAIN_ROOT."members/include/admin/medals/delete.php', { mID: intMedalID, confirm: 1 }, function(data1) {
									$('#contentDiv').html(data1);
									$('#loadingSpiral').hide();
									$('#contentDiv').fadeIn(400);	
								});
							
							},
							'Cancel': function() {
							
								$(this).dialog('close');
							
							}
						}
					});
					
					$('#deleteMessage').html(data);
				
				});

			});			
		}
	
	</script>
	
	";
	
	
}
elseif($_GET['mID'] != "" AND $_GET['action'] == "edit") {
	include("medals/edit.php");
}



?>