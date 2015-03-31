/**
 * 
 */
define(['js/formUtils', 'lib/jquery'], function(formUtils) {
	
	$('form').submit(function(e) {
		e.preventDefault();
		
		var data = formUtils.extractData('form');
		
		$.ajax({
			url: 'admin/php/handlers/login_handler.php',
			dataType: 'json',
			method: 'post',
			data: $.extend(data, {
				action: 'customer_login' 
			}),
			success: function(response) {
				console.log(response);
				console.log(response.status);
				if (response.status == 'success') {
					console.log('redirecting');
					window.location.href = 'index.php';
				} else {
					console.log('Failure: ', response);
				}
			}
		});
	});
	
});