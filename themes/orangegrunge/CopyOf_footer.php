							</td>
							<td class='menuColumn' valign='top'>
								<?php echo $dispLoginBox; ?>
								
								<br><br><br>
								
								<img src='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/images/menu/shoutbox.png' style='margin-bottom: 3px'><br>
								
								<?php echo $mainShoutboxObj->dispShoutbox(); ?>
								
							</td>
						</tr>				
					</table>
	
	
				</td>
				<td class='right-side'></td>
			</tr>
			<tr>
				<td class='bottom-left-corner'>&nbsp;</td>
				<td class='bottom-side'></td>
				<td class='bottom-right-corner'>&nbsp;</td>
			</tr>
		</table>
		<div class='push'></div>
	</div>
	<div class='horizontalBG'></div>
	<div class='bottom-left-layout-image'></div>
	<div class='top-left-layout-image'></div>
	<div class='top-right-layout-image'></div>


	
	<div class='footerDiv'>
		<p align='center' style='padding-top: 20px; margin-bottom: 0px; padding-bottom: 0px'><b>Powered By: <a href='http://www.bluethrust.com' target='_blank'>Bluethrust Clan Scripts v4</a></b></p>
		<p align='center' style='margin: 0px; padding: 0px'>© Copyright <?php echo date("Y"); ?> <?php echo $websiteInfo['clanname']; ?></p>
	</div>
	
	<div id='notificationDiv'></div>
	<div id='notificationContainer'></div>
	
	<script type='text/javascript'>

		
	
		$(document).ready(function() {
	
			$('#mainShoutbox').animate({
				scrollTop:$('#mainShoutbox')[0].scrollHeight
			}, 1000);
			
		});

	</script>
		<?php
		
			if(constant('LOGGED_IN')) {
				
				$memberObj = new Member($mysqli);
				$memberObj->select($_SESSION['btUsername']);
				$memberInfo = $memberObj->get_info();
				
				echo "
					<audio id='notificationSound'>
				";
				if($memberInfo['notifications'] == 0) {
					echo "
						<source src='".$MAIN_ROOT."themes/".$THEME."/notification.mp3'></source>
						<source src='".$MAIN_ROOT."themes/".$THEME."/notification.ogg'></source>
					";
				}
				
				echo "
					</audio>
					";
				
				if($memberInfo['notifications'] == 0 || $memberInfo['notifications'] == 1) {
					echo "
			
					<script type='text/javascript'>
						var intCountNotificationCheck = 0;
				
						function checkForNotification() {
				
							$(document).ready(function() {
				
								$.post('".$MAIN_ROOT."members/include/_notificationcheck.php', { }, function(data) {
				
									$('#notificationContainer').html(data);
									
								});
				
							});
				
							if(intCountNotificationCheck < 5) {
								setTimeout(\"checkForNotification()\", 120000);
							}
							
							intCountNotificationCheck++;
						}
						
						checkForNotification();
					</script>
				";
					
				}
			}
		?>
		
		
		
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