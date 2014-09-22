</td>
						<td class='rightBG'></td>
					</tr>					
					<tr>
						<td class='bottomLeft'></td>
						<td class='bottomBG'></td>
						<td class='bottomRight'></td>
					</tr>
				
				</table>

			
			</div>
			
			<div class='menuContainer'>
			
				<table class='siteContentTable' style='width: 90%; margin-left: auto; margin-right: auto'>
					<tr>
						<td class='topLeft'></td>
						<td class='topBG'></td>
						<td class='topRight'></td>
					</tr>
					<tr>
						<td class='leftBG'></td>
						<td class='menuSection'>
							
							<?php $themeMenusObj->displayMenu(0); ?>
						
						</td>
						<td class='rightBG'></td>
					</tr>					
					<tr>
						<td class='bottomLeft'></td>
						<td class='bottomBG'></td>
						<td class='bottomRight'></td>
					</tr>
				
				</table>
				
			</div>
		
		</div>
		
		<div class='push'></div>
		
		
		<div class='footerDiv'>
			<?php $btThemeObj->displayCopyright(); ?>
		</div>
		
		</div>
	
	<div style='position: absolute; padding: 0px; top: 0px; left: 0px; width: 100%; min-width: 1000px'>
	
	
		<div id='loginSection'>
		
			<?php $themeMenusObj->displayMenu(1); ?>	
			
			
		
		</div>
	
		<div class='logoDiv'><img src='<?php echo $MAIN_ROOT; ?>themes/armygreen/images/logo.png'></div>
		<div class='layout-top-gradientbg'></div>
		<div class='layout-lensflare'></div>
		<div class='layout-topleft-characters'></div>
		<div class='layout-right-characterbg'></div>
		<div class='layout-topbar'></div>
	</div>
	
	<div class='layout-checkerbg'></div>
	<div style='clear: both'></div>
	
	
	
	<?php include($prevFolder."themes/include_footer.php"); ?>
	
	</body>
</html>