$(document).ready(function() {
	var blnRememberMe = 0;
	
	$('#rememberMe').val("0");
	
	$('#fakeRememberMe').click(function() {
		if(blnRememberMe == 0) {
			$(this).removeClass("loginRememberMeBox").addClass("loginRememberMeBox_Checked");
			
			$('#rememberMe').val("1");
			blnRememberMe = 1;
		}
		else {
			$(this).removeClass("loginRememberMeBox_Checked").addClass("loginRememberMeBox");
			
			$('#rememberMe').val("0");
			blnRememberMe = 0;
		}
	});
	
	$('#btnFakeLogin').click(function() {
		$('#btnLogin').click();		
	});
	
	
});