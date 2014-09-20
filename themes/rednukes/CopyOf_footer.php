</td>
							<td width='145' valign='top' class='menulinks'>
	<?php // hello ?>

							<img src='<?php echo $MAIN_ROOT; ?>themes/rednukes/images/menu/chatboard.png'><br><span style='font-size: 3px'><br></span>
								<?php echo $mainShoutboxObj->dispShoutbox(); ?>
								
							</td>
						</tr>
					</table>
						
						
						
						
						<br>
						
						</td>
					</tr>
					<tr>
						<td class='contentBottomBG tinyFont'><br>
							<p align='center'><b>Powered By: <a href='http://www.bluethrust.com' target='_blank' style='color: pink'>Bluethrust Clan Scripts v4</a></b></p>
							<p align='center'>© Copyright <?php echo date("Y"); ?> <?php echo $websiteInfo['clanname']; ?></p>
						</td>
					</tr>
				</table>
				
				
				
				
			</div>
		
		
		
			<div class='logo'></div>
			<?php echo $dispLoginBox; ?>
	
			
	
	
	
		</div>
	
		<div class='logoBar'></div>
		<div class='gradientBG'></div>
		<div class='leftBG'></div>
		<div class='centerBG'></div>
		<div class='rightBG'></div>

		
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