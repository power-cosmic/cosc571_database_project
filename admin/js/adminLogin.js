define(['js/login'], function(Login) {
	return new Login('admin_login', function() {
		location.reload();
	});
});