define(['lib/jquery'], function() {
	
	// get data from form
	var extractData = function() {
		var data = {};
		$('#register :input').each(function() {
			var $element = $(this);
			var type = $element.attr('type');
			var checked = $element.prop('checked');
			var key = $element.attr('name');
			
			if ((type != 'radio' || checked) && key) {
				data[$element.attr('name')] = $element.val();
			}
		});
		return data;
	}
	
	// validate input
	var validate = function (data) {
		var passwordLength = /.{8}.*/;
		var passwordSpecial = /[\.!@#$%^&*()?<>/\\{}]/;
		var email = /.*@.*\..*/;
		var zip = /\d{5}/;
		var cardNumber = /\d{16}/;
		var errors = [];
		
		if (data.password != data['confirm-password']) {
			errors.push('Passwords must match');
		}
		if (!passwordLength.test(data.password)) {
			errors.push('Password must be at least 8 characters');
		}
		if (!passwordSpecial.test(data.password)) {
			errors.push('Password must contain a special character');
		}
		if (!email.test(data.email)) {
			errors.push('Invalid email address');
		}
		if (!zip.test(data.zip)) {
			errors.push('Invalid zip code');
		}
		if (!cardNumber.test(data['card-number'])) {
			errors.push('Invalid card number');
		}
		
		// check for empty stuff
		$.each(data, function(key, value) {
			if (!value) {
				errors.push(key + ' cannot be empty');
			}
		});
		return errors;
	}
	
	$(function() {
		
		// address listeners
		$('.address-radio').change(function() {
			console.log(this);
			$('.address-box').addClass('profile-hidden');
		});
		$('#current-address-radio').change(function() {
			$('#current-address').removeClass('profile-hidden');
		});
		$('#other-address-radio').change(function() {
			$('#other-address').removeClass('profile-hidden');
		});
		$('#new-address-radio').change(function() {
			$('#new-address').removeClass('profile-hidden');
		});

		$("#current-address-radio").prop("checked", true);
		$('#current-address').removeClass('profile-hidden');
		
		// card listeners
		$('.card-radio').change(function() {
			console.log(this);
			$('.card-box').addClass('profile-hidden');
		});
		$('#current-card-radio').change(function() {
			$('#current-card').removeClass('profile-hidden');
		});
		$('#other-card-radio').change(function() {
			$('#other-card').removeClass('profile-hidden');
		});
		$('#new-card-radio').change(function() {
			$('#new-card').removeClass('profile-hidden');
		});

		$("#current-card-radio").prop("checked", true);
		$('#current-card').removeClass('profile-hidden');
		
		
		// username check
		$('#username').focusout(function() {
			var username = $('#username').val();
			$.ajax({
				url: 'api/user.php?username=' + username,
				success: function(data) {
					if (data != 'null') {
						alert('That username is taken');
					}
				}
			});
		});
		
		// attempt submission
		$('#register').submit(function(e) {
			e.preventDefault();
			
			var data = extractData();
			var errors = validate(data);
			if (errors.length) {
				console.log(errors);
			}
			
			$.ajax({
				url: 'api/register.php',
				dataType: 'json',
				method: 'POST',
				data: $.extend(data, {'update': 'true'}),
				success: function(response) {
					if (response.status == 'success') {
						console.log(response);
						window.location = response.previousPage;
						data.action = 'customer_login';
						$.ajax({
							url: 'admin/php/handlers/login_handler.php',
							dataType: 'json',
							method: 'post',
							data: data,
							success: function(response) {
								if (response.status == 'success') {
									window.location = response.previousPage;
								} else {
									console.log('Failure: ', response);
								}
							}
						});
					} else {
						console.log('Failure: ', response);
					}
				}
			});
		});
		
	});
	
});