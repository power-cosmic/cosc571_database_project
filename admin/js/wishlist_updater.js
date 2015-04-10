/**
 * 
 */
define(['js/cart_updater', 'lib/jquery'], function() {
	
	var getIsbn = function(name) {
		return name.split(' ')[1];
	};
	
	var updateWishlist = function(action, data, callback) {
		$.ajax({
			url: 'admin/php/handlers/list_handler.php',
			dataType: 'json',
			method: 'POST',
			data: $.extend(data, {action: action}),
			success: function(response) {
				if (response.status == 'success') {
					if (callback) {
						callback(response);
					}
					console.log(response);
				}
			}
		});
	}
	
	// setup listeners
	$(function() {
		
		// add listener
		$('.wishlist-button').click(function() {
			var isbn = getIsbn($(this).attr('name'));
			updateWishlist('add', {'isbn': isbn});
			
			$(this).prop('disabled', true);
		});
		
		// add listener
//		$('.add-button').click(function() {
//			var row = getBookRow($(this));
//			var isbn = getIsbn($(this).attr('name'));
//		});
	});
});
