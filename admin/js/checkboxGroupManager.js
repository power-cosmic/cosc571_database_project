

define(['lib/jquery'], function(jquery) {
	
	/**
	 * Constructor for CheckboxToggler
	 * @param {String} checkboxName Corresponds to the name attribute
	 * 		of all checkboxes to be turned on/off 
	 */
	return function(checkboxName) {
		
		var output = {
				
			toggle: function() {
				var checkAll = true;
				if (this.allOn()) {
					checkAll = false;
				}
				
				$('input[name*="' + checkboxName + '"]').each(function() {
					this.checked = checkAll;
				});
				
			},
			
			allOn: function() {
				var allAreOn = true;
				$('input[name*="' + checkboxName + '"]').each(function() {
					if (!this.checked) {
						allAreOn = false;
					}
				});
				return allAreOn;
			},
			
			allOff: function() {
				var allAreOff = true;
				$('input[name*="' + checkboxName + '"]').each(function() {
					if (this.checked) {
						allAreOff = false;
					}
				});
				return allAreOff;
			}
		};
		
		return output;
		
	};
	
});