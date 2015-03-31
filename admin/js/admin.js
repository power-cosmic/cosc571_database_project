/**
 * 
 */
define(['lib/jquery'], function() {

	var currentIndex = 0;
	var numToDisplay = 10;
	
	var clearTable = function() {
		$('#books').find('tr:gt(0)').remove();
	}
	
	var makeRow = function(book) {
		return '<tr><td>' + book.title + '</td>'
			+ '<td>' + book.reviews + '</td></tr>';
	};
	
	var load = function(index, numToDisplay) {
		clearTable();
		$.ajax({
			url: 'api/book_info.php',
			dataType: 'json',
			method: 'get',
			data: {
				index: index,
				count: numToDisplay
			},
			success: function(response) {
				$.each(response, function(index, value) {
					$('#books tr:last').after(makeRow(value));
				});
			}
		});
	};
	
	$(function() {
		
		load(currentIndex, numToDisplay);
		
		$('#next').click(function(e) {
			e.preventDefault();
			currentIndex += numToDisplay;
			load(currentIndex, numToDisplay);
		});
		
		$('#previous').click(function(e) {
			e.preventDefault();
			currentIndex -= numToDisplay;
			currentIndex = Math.max(0, currentIndex);
			load(currentIndex, numToDisplay);
		});
		
	});
	
});