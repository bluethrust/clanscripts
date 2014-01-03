<?php

/*
 * Bluethrust Clan Scripts v4
 * Copyright 2014
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
	$memberInfo = $member->get_info();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}


$cID = $_GET['cID'];


?>




<div class='formDiv' style='border-width: 0px; background-color: transparent; padding-bottom: 20px'>

	<div style='float: left'>
		<b>&raquo;</b> <a href='javascript:void(0)' id='deleteButton'>Delete Selected</a> <b>&laquo;</b> 
	</div>

	<div style='float: right'>
		<b>&raquo;</b> <a href='<?php echo $MAIN_ROOT; ?>members/privatemessages/compose.php'>Compose Message</a> <b>&laquo;</b><!-- &nbsp; &raquo; <a href='<?php echo $MAIN_ROOT; ?>members/privatemessages/viewsent.php'>View Sent Messages</a> &laquo; -->
	</div>
	
</div>


<table class='formTable' style='border-spacing: 0px'>
	<tr>
		<td class='main' width="5%"><img src='<?php echo $MAIN_ROOT."themes/".$THEME."/images/buttons/delete.png"; ?>' width='18' height='18' id='checkAllX' style='cursor: pointer'></td>
		<td class='formTitle' width="30%">From:</td>
		<td class='formTitle' width="35%" style='border-left-width: 0px'>Subject:</td>
		<td class='formTitle' width="30%" style='border-left-width: 0px'>Date Sent</td>
	</tr>	
</table>
<div id='inboxDiv'>



</div>
<div class='loadingSpiral' id='loadingSpiral'>
	<p align='center'>
		<img src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/images/loading-spiral.gif'><br>Loading
	</p>
</div>

<script type='text/javascript'>

	$(document).ready(function() {

		var intCheckAll = 0;
		
		
		$('#inboxDiv').hide();
		$('#loadingSpiral').show();
		$.post('<?php echo $MAIN_ROOT; ?>members/privatemessages/include/inbox.php', { }, function(data) {

			$('#inboxDiv').html(data);
			$('#loadingSpiral').hide();
			$('#inboxDiv').fadeIn(250);

		});



		$('#checkAllX').click(function() {


			if(intCheckAll == 0) {
				$('input:checkbox').attr('checked', true);
				intCheckAll = 1;
			}
			else {
				$('input:checkbox').attr('checked', false);
				intCheckAll = 1;
			}
			


		});

		$('#deleteButton').click(function() {


			var arrDeletePMID = [];
			
			$('input:checked').each(function() {
				arrDeletePMID.push(this.value);
			});


			arrDeletePMID = JSON.stringify(arrDeletePMID);

			$.post("<?php echo $MAIN_ROOT; ?>members/privatemessages/include/delete.php", { 'deletePMs': arrDeletePMID }, function() {


				$('#inboxDiv').hide();
				$('#loadingSpiral').show();
				
				$.post('<?php echo $MAIN_ROOT; ?>members/privatemessages/include/inbox.php', { }, function(data) {

					$('#inboxDiv').html(data);
					$('#loadingSpiral').hide();
					$('#inboxDiv').fadeIn(250);

				});
				
			});

		});


	});


</script>
