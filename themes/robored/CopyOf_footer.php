</td>
								<td class='menuColumn' valign='top'>
									<?php dispMenu(1); ?>
								</td>
							</tr>				
						</table>						
												
					</td>
					<td class='right'></td>
				</tr>
				<tr>
					<td class='bottomLeft'></td>
					<td class='bottom'></td>
					<td class='bottomRight'></td>
				</tr>

			</table>
		
		
			<div class='push'></div>
		</div>
		
		<div class='footerDiv'>
			Powered By: <a href='http://www.bluethrust.com' target='_blank'>Bluethrust Clan Scripts v4</a><br>
			&copy; Copyright <?php echo date("Y")." ".$websiteInfo['clanname']; ?>
		</div>
		
		<div class='menuBarDiv'>
		
			<div class='menuBarInnerDiv'>
				<a href='<?php echo $MAIN_ROOT; ?>news'><div class='menuBarItem'><img src='<?php echo $MAIN_ROOT; ?>images/transparent.png' class='menuNewsIMG'></div></a>
				<a href='<?php echo $MAIN_ROOT; ?>members.php'><div class='menuBarItem'><img src='<?php echo $MAIN_ROOT; ?>images/transparent.png' class='menuMembersIMG'></div></a>
				<a href='<?php echo $MAIN_ROOT; ?>tournaments'><div class='menuBarItem'><img src='<?php echo $MAIN_ROOT; ?>images/transparent.png' class='menuTournamentsIMG'></div></a>
				<a href='<?php echo $MAIN_ROOT; ?>squads'><div class='menuBarItem'><img src='<?php echo $MAIN_ROOT; ?>images/transparent.png' class='menuSquadsIMG'></div></a>
				<a href='<?php echo $MAIN_ROOT; ?>events'><div class='menuBarItem'><img src='<?php echo $MAIN_ROOT; ?>images/transparent.png' class='menuEventsIMG'></div></a>
				<a href='<?php echo $MAIN_ROOT; ?>forum'><div class='menuBarItem'><img src='<?php echo $MAIN_ROOT; ?>images/transparent.png' class='menuForumIMG'></div></a>
				<div style='clear: both'></div>
			</div>

		</div>
		
		<?php include($prevFolder."themes/include_footer.php"); ?>
	</body>
</html>