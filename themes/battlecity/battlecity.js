$(document).ready(function() {
	
	var intRememberMe = 0;
	
	$('#fakeRememberMe').click(function() {
		
		if(intRememberMe == 0) {
			$(this).addClass("rememberMeCheckbox_Checked").removeClass("rememberMeCheckbox");
			intRememberMe = 1;
			$('#realRememberMe').val("1");
		}
		else {
			$(this).addClass("rememberMeCheckbox").removeClass("rememberMeCheckbox_Checked");
			intRememberMe = 0;
			$('#realRememberMe').val("0");
		}
		
	});
	
	$('#btnFakeLoginSubmit').click(function() {
		
		$('#btnRealLoginSubmit').click();
		
	});
	
});