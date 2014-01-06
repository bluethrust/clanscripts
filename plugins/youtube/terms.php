
	<div id='termsDialog' style='display: none'>
		
		Test lol

	</div>
	
	<script type='text/javascript'>
		
		$('#termsDialog').dialog({
						
			title: 'Youtube Plugin',
			zIndex: 9999,
			show: 'scale',
			modal: true,
			width: 450,
			resizable: false,
			buttons: {
				'Ok': function() {
					// Check if everything is good
					
					installPlugin('youtube');
					$(this).dialog('close');
				
				},
				'Cancel': function() {
					// Selected No
					reloadPluginLists();
					$(this).dialog('close');

				}
			
			}
		
		});
						
	
	</script>
