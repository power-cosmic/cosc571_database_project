CREATE TABLE series_entry
(
	book_id INT(20) UNSIGNED,
	series_id INT(11) UNSIGNED,
	position INT(5),

	FOREIGN KEY (book_id) REFERENCES book (isbn),
	FOREIGN KEY (series_id) REFERENCES series (id),
	PRIMARY KEY (book_id, series_id)
);
