$(document).ready(function() {
	
	
	$('#fakeRememberMe').click(function() {
		
		if($('#rememberMe').val() == 1) {
			$('#fakeRememberMe').removeClass();
			$('#fakeRememberMe').addClass('rememberMeCheckbox');
			$('#rememberMe').val('0');
		}
		else {
			$('#fakeRememberMe').removeClass();
			$('#fakeRememberMe').addClass('rememberMeCheckbox_clicked');
			$('#rememberMe').val('1');
		}

	});
	
	
	
	$('#btnLogin').click(function() {
		$('#btnSubmit').click();
	});
	
	
});

