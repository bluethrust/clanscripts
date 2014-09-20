$(document).ready(function() {
	
	$('#chkRememberMe').click(function() {
		
		if($('#rememberMeHidden').val() == "0") {
			
			$(this).removeClass("loginRememberMeCheckbox").addClass("loginRememberMeCheckbox_checked");
			
			$('#rememberMeHidden').val("1");
		}
		else {
			
			$(this).addClass("loginRememberMeCheckbox").removeClass("loginRememberMeCheckbox_checked");
			$('#rememberMeHidden').val("0");
		}
		
		
	});
	
	$("#btnFakeLogin").click(function() {
		$("#btnRealSubmit").click();
	});
	
	
});