$(document).ready(function() {
	
	var intRememberMe = 0;
	
	$("img[data-layouthover]").hover(function() {
		// Mouseover
		
		var imgPosition =  $(this).position();
		var imgWidth = $(this).width();
		
		var highlightLeft = imgPosition.left+(imgWidth/2)-($('#topMenuHighlight').width()/2);
		
		
		$('#topMenuHighlight').show();
		$('#topMenuHighlight').css('left', highlightLeft);
		
		
	},
	function() {
		// Mouseout
		$('#topMenuHighlight').hide();
	});
	
	
	
	$('#fakeRememberMe').click(function() {
		
		if(intRememberMe == 0) {
			$(this).addClass('rememberMeImg_Checked').removeClass('rememberMeImg');
			intRememberMe = 1;
		}
		else {
			$(this).removeClass('rememberMeImg_Checked').addClass('rememberMeImg');
			intRememberMe = 0;
		}
		
		
		$('#realRememberMe').val(intRememberMe);
		
	});
	
	$('.loginSectionLoggedInIMG').click(function() {

		$("html, body").animate({
			scrollTop:0
		}, 350);
		
	});
	
	$('#btnFakeLoginSubmit').click(function() {
		
		$('#btnLoginSubmit').click();
		
	});
	
});