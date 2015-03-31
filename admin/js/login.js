/**
 * 
 */
define([
        	'js/formUtils', 
        	'js/ErrorAdder', 
        	'lib/jquery'
        ], function(formUtils, ErrorAdder) {
	
	return function Login(action, callback) {
		errorAdder = new ErrorAdder('#errors');
		
		$('form').submit(function(e) {
			e.preventDefault();
			
			var data = formUtils.extractData('form');
			
			$.ajax({
				url: 'admin/php/handlers/login_handler.php',
				dataType: 'json',
				method: 'post',
				data: $.extend(data, {
					action: action 
				}),
				success: function(response) {
					if (response.status == 'success') {
						callback();
					} else {
						errorAdder.showError(response.message);
						console.log(errorAdder);
						console.log('Failure: ', response);
					}
				}
			});
		});
	};
});