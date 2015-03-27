define(['lib/jquery'], function(jquery) {
	
	$('#username').focusout(function() {
		var username = $('#username').val();
		
		$.ajax({
			url: 'api/user.php?username=' + username,
			success: function(data) {
				if (data != 'null') {
					alert('That username is taken');
				}
			}
		})
		
	});
	
});