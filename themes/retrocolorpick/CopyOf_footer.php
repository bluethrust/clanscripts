</td>
				<td class='navMenu' valign='top' style='border-top: 0px'>
					<?php echo $dispLoginBox; ?>
					<div class='navMenuTitle'>Shoutbox</div>
					<div class='navMenuLinks'>
						<?php echo $mainShoutboxObj->dispShoutbox(); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan='3' align='center' class='footerSection' style='border: 0px'>
					<b>Powered By: <a href='http://www.bluethrust.com' target='_blank'>Bluethrust Clan Scripts v4</a></b><br>
					&copy; Copyright <?php echo date("Y"); ?> <?php echo $websiteInfo['clanname']; ?>
				</td>
			</tr>
		</table>
		
		
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

			function rcpThemeChangeColor(strColor) {

				$(document).ready(function() {
					
					$("body").css("cursor", "progress");
					
					strButtonClicked = "#colorButton_"+strColor;
					$(strButtonClicked).css("cursor", "progress");
					
					$.post('<?php echo $MAIN_ROOT; ?>themes/retrocolorpick/setcolor.php', { themeColor: strColor }, function(data) {
						$('#rcpThemeDump').html(data);
					});

				});

			}

		</script>
		
		<div id='rcpThemeDump'></div>
		
		
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