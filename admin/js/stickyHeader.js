
define(['lib/jquery'], function(jquery) {

	var setSticky = function() {
		$('#header').addClass('sticky');
		$('#header-replacer').addClass('expanded');
		$('#short-name').addClass('display');
		$('#simple-cart').addClass('display');
	}
	
	var removeSticky = function() {
		$('#header').removeClass('sticky');
		$('#header-replacer').removeClass('expanded');
		$('#short-name').removeClass('display');
		$('#simple-cart').removeClass('display');
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