/**
 * 
 */
define(['lib/jquery'], function() {
	
	return {
		extractData: function(formId) {
			var data = {};
			$(formId + ' :input').each(function() {
				var $element = $(this);
				var key = $element.attr('name');
				if (key) {
					data[$element.attr('name')] = $element.val();
				}
			});
			return data;
		}
	};
});