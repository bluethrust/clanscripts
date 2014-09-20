$(document).ready(function() {
	
	var blnPhoneOpen = false;
	var blnClickedPhone = false;
	$('#realRememberMe').val("0");
	
	$('#phoneDiv').click(function() {
		blnClickedPhone = true;
		if(!blnPhoneOpen) {
			$(this).animate({ top: "15px" }, 500, function() {
				blnPhoneOpen = true;
				$(this).css("cursor", "default");
			});
		}
		
	});
	
	$('#phoneCloseDiv').click(function() {
		
		if(blnPhoneOpen) {
		$('#phoneDiv').animate({ top: "-242px" }, 500, function() {
			blnPhoneOpen = false;
			$(this).css("cursor", "pointer");
		});
		}
	});
	
	$('#btnFakeLoginSubmit').click(function() {
		
		$('#btnLoginSubmit').click();
		
	});
	
	$('#fakeRememberMe').click(function() {
		
		if($('#realRememberMe').val() == "0") {
			$('#fakeRememberMe').removeClass("rememberMeCheckbox").addClass("rememberMeCheckbox_Checked");
			$('#realRememberMe').val("1");
		}
		else {
			$('#fakeRememberMe').removeClass("rememberMeCheckbox_Checked").addClass("rememberMeCheckbox");
			$('#realRememberMe').val("0");
		}
		
	});
	
	
	$('.topMenuItem').click(function() {
		
		if($(this).children("a").children("img").attr("data-link") != undefined) {
			
			window.location = $(this).children("a").children("img").attr("data-link");
			
		}
		
	});
	
	$('.topMenuItem').hover(
		function() {
			
			if($(this).children(".topMenuItemContent").length > 0) {
				$(this).addClass("topMenuItemExtra");
				$(this).children(".topMenuItemContent").show();
				
				if($(this).height() >= 150) {
				
					//$(this).addClass("topMenuItemGradientBG");
					
				}
			}
			
			
			if($(this).children("a").children("img").attr("data-link") != undefined) {
			
				$(this).css("cursor", "pointer");
				
			}

		
		},
		function() {
			if($(this).children(".topMenuItemContent").length > 0) {
				
				if($(this).height() >= 150) {
					
					//$(this).removeClass("topMenuItemGradientBG");
					
				}
				
				$(this).removeClass("topMenuItemExtra");
				$(this).children(".topMenuItemContent").hide();			
			}
		
		}
	);
	
	
	$('body').click(function() {
		
		if(blnPhoneOpen && !blnClickedPhone) {
			$('#phoneCloseDiv').click();
		}
		
		blnClickedPhone = false;
	});
	
	
	// Background Character Animations
	
	
	if(Math.random() > .5) {
		$('#leftCharacterBG-1').show();
		//$('#leftCharacterBG-1').css("left", "0px").css("bottom", "0px").animate({ left: "50px", bottom: "-10px" }, 5000, "easeOutQuint");
	}
	else {
		$('#leftCharacterBG-2').show();
		//$('#leftCharacterBG-2').css("left", "0px").css("bottom", "0px").animate({ left: "-100px", bottom: "-100px" }, 5000, "easeOutQuint");
	}
	
	
	if(Math.random() > .5) {
		$('#rightCharacterBG-1').show();
		//$('#rightCharacterBG-1').animate({ right: "50px", bottom: "-50px" }, 5000, "easeOutQuint");
	}
	else {
		$('#rightCharacterBG-2').show();
		//$('#rightCharacterBG-2').animate({ right: "-20px", bottom: "-50px" }, 5000, "easeOutQuint");
	}
	
	
});