		</div>
		<div class='push'></div>
	</div>
	
	<div class='footerDiv'>
		<?php $btThemeObj->displayCopyright(); ?>
	</div>
	
	<script type='text/javascript'>
		$(document).ready(function() {

			var intScrollAmount;
			var intLeftContainerHeight = $("div[class='leftSiteContainer']").height();
			var intFixedTop = ((intLeftContainerHeight-$(window).height())*-1);
			var intAbsoluteTop = $("div[class='leftSiteContainer']").css("top");
			

			$(window).scroll(function() {
				intScrollAmount = $(this).scrollTop();

				if((intLeftContainerHeight-intScrollAmount) > $(this).height()) {
					$("div[class='leftSiteContainer']").css("position", "absolute");
					$("div[class='leftSiteContainer']").css("top", intAbsoluteTop);
				}
				else if($("div[class='mainSiteContentDiv']").height() > intLeftContainerHeight) {
					$("div[class='leftSiteContainer']").css("position", "fixed");

					if(intFixedTop < 0) {
						$("div[class='leftSiteContainer']").css("top", intFixedTop+"px");
					}
				}


				
			});

		});
	</script>
	<?php include($prevFolder."themes/include_footer.php"); ?>
</body>
</html>