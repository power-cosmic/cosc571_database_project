
define(['lib/jquery'], function(jquery) {

	var setSticky = function() {
		$('#header').addClass('sticky');
		$('#header-replacer').addClass('expanded');
	}
	
	var removeSticky = function() {
		$('#header').removeClass('sticky');
		$('#header-replacer').removeClass('expanded');
	}
	
	var toggleSticky = function() {
		
		if ($(window).scrollTop() > 76) {
			setSticky();
		} else {
			removeSticky();
		}
		
	}
	
	$(window).scroll(function() {
		toggleSticky();
	});
	
});