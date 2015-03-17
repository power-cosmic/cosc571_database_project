CREATE TABLE IF NOT EXISTS series_entry
( book_id CHAR(13)
, series_id INT(11) UNSIGNED

, position INT(5)

, FOREIGN KEY (book_id) REFERENCES book (isbn)
, FOREIGN KEY (series_id) REFERENCES series (id)
, PRIMARY KEY (book_id, series_id)
);
