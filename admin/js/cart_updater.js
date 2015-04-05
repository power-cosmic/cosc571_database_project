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
						callback(response);
					}
					console.log(response);
					$('#total').html('Subtotal: $' + response.subtotal.toFixed(2));
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
		
		// add listener
		$('.add-button').click(function() {
			var row = getBookRow($(this));
			var isbn = getIsbn($(this).attr('name'));
			updateCart('add', {'isbn': isbn});
			$(this).prop('disabled', true);
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
			var cost = row.find('.book-cost');
			var isbn = getIsbn($(this).attr('name'));
			updateCart('alter', {
					'isbn': isbn, 
					'quantity': value
				}, function(response) {
					$(cost).html('$' + response.lineCost.toFixed(2));
				}
			);
		});
		
	});
});