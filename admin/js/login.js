/**
 * 
 */
define([
        	'js/formUtils', 
        	'js/ErrorAdder', 
        	'lib/jquery'
        ], function(formUtils, ErrorAdder) {
	
	errorAdder = new ErrorAdder('#errors');
	
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
				if (response.status == 'success') {
					window.location.href = 'index.php';
				} else {
					errorAdder.showError(response.message);
					console.log(errorAdder);
					console.log('Failure: ', response);
				}
			}
		});
	});
	
});