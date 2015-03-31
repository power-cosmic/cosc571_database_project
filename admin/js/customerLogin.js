define(['js/login'], function(Login) {
	return new Login('customer_login', function() {
		window.location.href = 'index.php';
	});
});