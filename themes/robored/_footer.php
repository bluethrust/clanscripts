</td>
								<td class='menuColumn' valign='top'>
									<?php $themeMenusObj->displayMenu(1); ?>
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
			<?php $btThemeObj->displayCopyright(); ?>
		</div>
		
		<div class='menuBarDiv'>
		
			<div class='menuBarInnerDiv'>
				
				<?php $themeMenusObj->displayMenu(2); ?>
				
				<div style='clear: both'></div>
			</div>

		</div>
		
		<?php include($prevFolder."themes/include_footer.php"); ?>
	</body>
</html>