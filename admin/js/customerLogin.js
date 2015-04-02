define(['js/login'], function(Login) {
	return new Login('customer_login', function(response) {
		window.location.href = response.previousPage;
	});
});