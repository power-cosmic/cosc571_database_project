define(['lib/jquery'], function() {
	
	return function ErrorAdder(elementId) {
		
		this.showError = function(message) {
			$(elementId).html(message);
		};
		
		this.hideError = function() {
			$(elementId).html('');
		}
		
	};
	
});