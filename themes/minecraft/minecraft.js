$(document).ready(function() {
	$('#txtRememberMe').val("0");
	$('#rememberMeSwitch').click(function() {
		
		if($('#txtRememberMe').val() == "0") {
			$('#txtRememberMe').val("1");
			
			$('#rememberMeDiv').removeClass("rememberMe_Off").addClass("rememberMe_On");
			
			
		}
		else {
			$('#txtRememberMe').val("0");
			
			$('#rememberMeDiv').removeClass("rememberMe_On").addClass("rememberMe_Off");
			
		}
		
		
	});
	
	
	$('#loginSign').click(function() {
		$('#btnSubmit').click();
	});
	
});