$(document).ready(function() {
	
	$('#fakeRememberMe').click(function() {
		$('#realRememberMe').click();
		
		
		if($('#realRememberMe').is(":checked")) {
			$('#fakeRememberMe').removeClass('rememberMeCheckBox').addClass('rememberMeCheckBox_Checked');
		}
		else {
			$('#fakeRememberMe').addClass('rememberMeCheckBox').removeClass('rememberMeCheckBox_Checked');
		}
		
		
	});
	
	
	$('#fakeSubmit').click(function() {
		$('#realSubmit').click();
	});
	
});

