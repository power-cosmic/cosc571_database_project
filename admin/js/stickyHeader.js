
define(['lib/jquery'], function(jquery) {

	// start off with short-name hidden
	$('#short-name').hide();
	
	var setSticky = function() {
		$('#header').addClass('sticky');
		$('#header-replacer').addClass('expanded');
		$('#short-name').show(200);
	}
	
	var removeSticky = function() {
		$('#header').removeClass('sticky');
		$('#header-replacer').removeClass('expanded');
		$('#short-name').hide();
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