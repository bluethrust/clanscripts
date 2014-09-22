$(document).ready(function() {
	
	$("div[class='topMenuSection']").mouseover(function() {
		
		if($(this).attr('data-showmenu') != null) {
			$('#'+$(this).attr('data-showmenu')).show();
		}
		
		
		$('#'+$(this).attr('data-hoverimg')).removeClass($(this).attr('data-hoverimg')).addClass($(this).attr('data-hoverimg')+'_hover');
	});
	
	$("div[class='topMenuSection']").mouseout(function() {
		
		$('#'+$(this).attr('data-hoverimg')).removeClass($(this).attr('data-hoverimg')+'_hover').addClass($(this).attr('data-hoverimg'));
		
		if($(this).attr('data-showmenu') != null) {
			$('#'+$(this).attr('data-showmenu')).hide();
		}
		
	});
	
	$(window).scroll(function() {
		if($(window).scrollLeft() != 0) {
			
		}
	});
	
});