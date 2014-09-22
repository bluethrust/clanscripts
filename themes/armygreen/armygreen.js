var intShowLogin = 0;
var intLoginSectionClicked = 0;


$(document).ready(function() {
	
	
	$('#loginArrow').click(function() {
		
		if(intShowLogin == 0) {
			
			$('#loginSection').animate({
				top: 0
			}, 500, function() {
				intShowLogin = 1;
			});
			
			$(this).removeClass("loginDownArrow").addClass("loginUpArrow");
			$(this).removeClass("loginDownArrowRed");
			
		}
		else {
			
			$('#loginSection').animate({
				top: -170
			}, 500);
			
			$(this).removeClass("loginUpArrow").addClass("loginDownArrow");
			
			intShowLogin = 0;
		}
		
	});
	
	
	$('#loginSection').click(function() {
		intLoginSectionClicked = 1;
	});
	
	$('#loginIMG').click(function() {
		$('#loginArrow').click();
	});
	
	$('#loggedInUsername').click(function() {
		$('#loginArrow').click();
	});
	
	
	$('body').click(function() {
		if(intShowLogin == 1 && intLoginSectionClicked == 0) {
			$('#loginArrow').click();
		}
		intLoginSectionClicked = 0;
	});
	
	
	
	
	
	
	
	
});


