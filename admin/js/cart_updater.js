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
	
	var removeItem = function(row, isbn) {
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
		
		$('.delete-button').click(function() {
			var row = getBookRow($(this));
			var isbn = getIsbn($(this).attr('name'));
			removeItem(row, isbn);
		});
		
	});
});