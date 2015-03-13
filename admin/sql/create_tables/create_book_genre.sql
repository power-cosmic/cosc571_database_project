CREATE TABLE book_genre
(
	isbn INT(20) UNSIGNED,
	genre_id INT(11) UNSIGNED,

	PRIMARY KEY (isbn, genre_id),
	FOREIGN KEY (isbn) REFERENCES book (isbn),
	FOREIGN KEY (genre_id) REFERENCES genre (id)
);
