



</td>
				<td class='navMenu' valign='top' style='border-top: 0px'>
					<?php $themeMenusObj->displayMenu(1); ?>
				</td>
			</tr>
			<tr>
				<td colspan='3' align='center' class='footerSection' style='border: 0px'>
				<div style='margin: 15px auto; position: relative; text-align: center'>
				
					<?php $themeMenusObj->displayMenu(2); ?>
				
				</div>
				<br>
					<?php $btThemeObj->displayCopyright(); ?>
				</td>
			</tr>
		</table>
		
		
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

		
		<?php include($prevFolder."themes/include_footer.php"); ?>
		
		
	</body>
</html>