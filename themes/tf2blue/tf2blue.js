$(document).ready(function() {
	
	var blnChecked = 0;
	
	$('#fakeRememberMe').click(function() {
		
		$('#rememberMe').click();
		
	});
	
	
	$('#rememberMe').click(function() {
		if(blnChecked == 0) {
			$('#fakeRememberMe').removeClass("loginAreaCheckbox").addClass("loginAreaCheckbox_checked");
			blnChecked = 1;
		}
		else {
			$('#fakeRememberMe').removeClass("loginAreaCheckbox_checked").addClass("loginAreaCheckbox");
			blnChecked = 0;
		}
	});
	
	$('#fakeSubmit').click(function() {
		$('#btnSubmit').click();
	});
	
});