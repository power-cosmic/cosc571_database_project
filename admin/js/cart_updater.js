/**
 * 
 */
define(['lib/jquery'], function() {
	
	var getIsbn = function(name) {
		return name.split(' ')[1];
	};
	
	var getBookRow = function(element) {
		var parent = element.closest('.book-row');
		return $(parent);
	};
	
	var updateCart = function(action, data, callback) {
		$.ajax({
			url: 'admin/php/handlers/cart_handler.php',
			dataType: 'json',
			method: 'POST',
			data: $.extend(data, {action: action}),
			success: function(response) {
				if (response.status == 'success') {
					if (callback) {
						callback();
					}
					console.log(response);
					$('#total').html('Subtotal: ' + response.subtotal);
				}
			}
		});
	}
	
	var alterItem = function(row, isbn) {
		$.ajax({
			url: 'admin/php/handlers/cart_handler.php',
			dataType: 'json',
			method: 'POST',
			data: {action: 'delete', isbn: isbn},
			success: function(response) {
				if (response.status == 'success') {
					row.remove();
					$('#total').html('Subtotal: ' + response.subtotal);
				}
			}
		});
	}
	
	// setup listeners
	$(function() {
		
		// delete listner
		$('.delete-button').click(function() {
			var row = getBookRow($(this));
			var isbn = getIsbn($(this).attr('name'));
			updateCart('delete', {'isbn': isbn}, function() {
				row.remove();
			});
		});
		
		// quantity listener
		$('.quantity-box').change(function() {
			
			// TODO: find a better way to enforce positive values
			var value = $(this).val();
			if (value < 1) {
				value = 1;
				$(this).val(value);
			}
			
			var row = getBookRow($(this));
			var isbn = getIsbn($(this).attr('name'));
			updateCart('alter', {
				'isbn': isbn, 
				'quantity': value
			});
		});
		
	});
});