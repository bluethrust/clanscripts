
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
							<?php $themeMenusObj->displayMenu(0); ?>
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
			<?php $themeMenusObj->displayMenu(1); ?>
		</div>
	
		<div class='logoDiv'>
			<a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'></a>
		</div>
	
	
	
	
	<div class='push'></div>
	</div>
	<div class='footerDiv'>
		<?php $btThemeObj->displayCopyright(); ?>
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