/**
 * 
 */
define(['js/checkboxGroupManager', 'js/cart_updater', 'lib/jquery'], 
        function(CheckboxGroupManager) {

	/*
	 * Handle toggling of checkbox groups
	 */
	var criteriaManager = CheckboxGroupManager('criteria');
	var categoryManager = CheckboxGroupManager('category');
	
	$('#toggle-category-button').click(function() {
		categoryManager.toggle();
	});
	
	/*
	 * enable/disable button based on selected boxes 
	 */
	$('input[name*="criteria"], input[name*="category"], #toggle-category-button').click(function() {
		if (criteriaManager.allOff() || categoryManager.allOff()) {
			$('input[type="submit"]').attr('disabled', 'disabled');
		} else {
			$('input[type="submit"]').removeAttr('disabled');
		}
	});
	
	
});