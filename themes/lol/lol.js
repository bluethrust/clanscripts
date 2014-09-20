$(document).ready(function() {
	var thisChild;
	
	$('.topMenuItemText').hover(function() {
		
		
		
		if($(this).children(".layoutDropDownMenu").length > 0) {
			thisChild = $(this).children(".layoutDropDownMenu");
			
			$('.layoutDropDownFillBG').css('height', thisChild.outerHeight()-52);
			
			
		}
		else {
			thisChild = $(this).children(".topMenuHighlight");
		}
		
		tempTitleWidth = $(this).width()*.5;
		tempMenuWidth = thisChild.outerWidth()*.5;
		
		if(tempTitleWidth > tempMenuWidth) {
			tempWidth = tempTitleWidth-tempMenuWidth;
		}
		else {
			tempWidth = tempMenuWidth-tempTitleWidth;
		}
		
		thisChild.css('left', -tempWidth);
		
		thisChild.show();
		
	},
	function() {
		
		thisChild.hide();
	});
	
});