CREATE TABLE IF NOT EXISTS book_genre
( isbn CHAR(13)
, genre_id INT(11) UNSIGNED

, FOREIGN KEY (isbn) REFERENCES book (isbn)
, FOREIGN KEY (genre_id) REFERENCES genre (id)
, PRIMARY KEY (isbn, genre_id)
);
