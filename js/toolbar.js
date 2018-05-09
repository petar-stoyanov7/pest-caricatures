function navbar_relocate() {
	var window_top = $(window).scrollTop();
	var div_top = $('#anchor').offset().top;
	if (window_top > div_top) {
		$('#navigation-bar').addClass('stick');
		$('#anchor').height($('#navigation-bar').outerHeight());		
	} else {
		$('#navigation-bar').removeClass('stick');
		$('#anchor').height(0);
	}
}

$(function() {
	$(window).scroll(navbar_relocate);
	navbar_relocate()
})