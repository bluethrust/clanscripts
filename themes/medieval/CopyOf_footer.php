
							</td>
							<td class='right-table'></td>
						</tr>
						<tr>
							<td class='bottom-left-table'></td>
							<td class='bottom-table'></td>
							<td class='bottom-right-table'></td>
						</tr>
					</table>
				</td>
				<td class='mainSiteRight' valign='top'>
					<div class='navMenuContainer'>
		
						<div class='navMenuTop'></div>
						<div class='navMenuCenter'>
							<div class='navMenuTitle'>
								<img src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/images/layout/menu/menu.png'>
							</div>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>'>Home</a><br>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>news'>News</a><br>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>members.php'>Members</a><br>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>ranks.php'>Ranks</a><br>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>squads'>Squads</a><br>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>tournaments'>Tournaments</a><br>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>events'>Events</a><br>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>medals.php'>Medals</a><br>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>diplomacy'>Diplomacy</a><br>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>diplomacy/request.php'>Diplomacy Request</a><br>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>custompage.php?pID=11'>History</a><br>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>custompage.php?pID=12'>Rules</a><br>
								
								<?php
									if($websiteInfo['memberregistration'] == 0 && constant('LOGGED_IN') != true) {
										echo "<b>&middot;</b> <a href='".$MAIN_ROOT."signup.php'>Sign Up</a><br>";
									}
								?>
							<br>
							<div class='navMenuTitle'>
								<img src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/images/layout/menu/topplayers.png'>
							</div>
							<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>top-players/recruiters.php'>Recruiters</a><br>
							<?php
								$hpGameObj = new Game($mysqli);
								$arrGames = $hpGameObj->getGameList();
								foreach($arrGames as $gameID) {
									$hpGameObj->select($gameID);
									echo "<b>&middot;</b> <a href='".$MAIN_ROOT."top-players/game.php?gID=".$gameID."'>".$hpGameObj->get_info_filtered("name")."</a><br>";
								}
							?>						
							<br>
							<div class='navMenuTitle'>
								<img src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/images/layout/menu/shoutbox.png'>
							</div>			
							<?php echo $mainShoutboxObj->dispShoutbox(); ?>
						</div>
						<div class='navMenuBottom'></div>
					</div>
				
				</td>
			</tr>
		</table>
		
	
		
		
	

	
	
	
	
		<div style='position: absolute; top: 0px; left: 0px; width: 100%; min-width: 990px'>
			<div id='centerKnightBG'></div>
			<div id='leftKnightBG'></div>
			<div id='acBG'></div>
			<div class='layoutLine'></div>
			<div class='bloodLeftBG'></div>
			<div class='shieldBG'></div>
			<div class='rightBarBG'></div>
		</div>
		
		<div class='loginBar'>
			<?php echo $dispLoginBox; ?>
		</div>
	
		<div class='logoDiv'>
			<a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/images/logo.png'></a>
		</div>
	
	
	
	
	<div class='push'></div>
	</div>
	<div class='footerDiv'>
		Powered By: <a href='http://www.bluethrust.com' target='_blank'>Bluethrust Clan Scripts v4</a><br>
		&copy; Copyright <?php echo date("Y"); ?> <?php echo $websiteInfo['clanname']; ?>
	</div>
	

	<script type='text/javascript'>

		var intScrollTop;
		var intNewTopValue = 0;
		var strNewTopValue = "";
		$(window).scroll(function() {
			intScrollTop = $(document).scrollTop();
			intNewTopValue = 50-intScrollTop;
			if(intNewTopValue < 0) {
				intNewTopValue = 0;
			}
	
			strNewTopValue = intNewTopValue+"px";
			
			$('#centerKnightBG').css('top', strNewTopValue);
			$('#leftKnightBG').css('top', strNewTopValue);
			$('#acBG').css('top', strNewTopValue);
		});
	
	
		$(window).scroll();


	</script>
	
	
	
	<?php include($prevFolder."themes/include_footer.php"); ?>
		

</body>
</html>