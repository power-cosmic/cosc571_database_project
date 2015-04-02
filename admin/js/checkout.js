/**
 * 
 */
define(['lib/jquery'], function() {
	
	var disableNewCard = function() {
		$('#new-card').children().attr('disabled', 'disabled');
	};
	
	var enableNewCard = function() {
		$('#new-card').children().removeAttr('disabled');
	};
	
	$(function() {
		$('#current-card-radio').change(disableNewCard);
		$('#new-card-radio').change(enableNewCard);
		$("#current-card-radio").prop("checked", true)
		disableNewCard();
	});
	
});