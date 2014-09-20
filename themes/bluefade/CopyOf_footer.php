<!-- CONTEN111T END -->
						</td>
						<td width='148' valign='top'>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='148'>
						
								<?php echo $dispLoginBox; ?>
								
								<!-- WHERE THE SEARCH BOX WILL GO -->
								
								<tr>
									<td align='center' style='padding-top: 8px'><img src='<?php echo $MAIN_ROOT; ?>themes/bluefade/images/transparent.png' class='menu_ChatBoard'></td>
								</tr>
								<tr>
									<td class='menuTop' align='center'><td>
								</tr>
								<tr>
									<td class='menuContent'>
									
									
										<?php echo $mainShoutboxObj->dispShoutbox(); ?>
										
									
									</td>
								</tr>
								<tr>
									<td class='menuBottom'></td>
								</tr>
								
							</table>

						</td>
					</tr>
				</table>
				
				
				
				
				
				
				
				
			</td>
			<td class='rightContentBox'></td>
		</tr>
		<tr>
			<td class='bottomLeftContentBox'></td>
			<td class='bottomContentBox'></td>
			<td class='bottomRightContentBox'></td>
		</tr>
	</table>

<div class='pageFooter'>
		<p align='center'><b>Powered By: <a href='http://www.bluethrust.com' target='_blank'>Bluethrust Clan Scripts v4</a></b></p>
		<p align='center'>© Copyright <?php echo date("Y"); ?> <?php echo $websiteInfo['clanname']; ?></p>
</div>
</div>


<div id='notificationDiv'></div>
<div id='notificationContainer'></div>



<script type='text/javascript'>

	$(document).ready(function() {

		$('#mainShoutbox').animate({
			scrollTop:$('#mainShoutbox')[0].scrollHeight
		}, 1000);
		
	});

	<?php
			
		if(constant('LOGGED_IN')) {
			echo "
				var intCountNotificationCheck = 0;
		
				function checkForNotification() {
		
					$(document).ready(function() {
		
						$.post('". $MAIN_ROOT."members/include/_notificationcheck.php', { }, function(data) {
		
							$('#notificationContainer').html(data);
							
						});
		
					});
		
					if(intCountNotificationCheck < 5) {
						setTimeout(\"checkForNotification()\", 120000);
					}
					
					intCountNotificationCheck++;
				}
				
				checkForNotification();
		
			";
		}
	?>

</script>

<script type='text/javascript'>


	function reloadShoutbox() {
		$(document).ready(function() {

			var strUpdateDiv = "#<?php echo $mainShoutboxObj->strDivID; ?>";

			
			$.post("<?php echo $MAIN_ROOT; ?>members/include/news/include/reloadshoutbox.php", { }, function(data) {

				$(strUpdateDiv).html(data);

			});

		});

		setTimeout("reloadShoutbox()", 20000);
	}


	setTimeout("reloadShoutbox()", 20000);
</script>

</body>
</html>