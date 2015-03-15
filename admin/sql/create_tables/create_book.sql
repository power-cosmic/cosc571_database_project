CREATE TABLE IF NOT EXISTS book
(
	isbn INT(20) UNSIGNED PRIMARY KEY,
	title VARCHAR(256) NOT NULL,
	description VARCHAR(2048),
	price NUMERIC(6, 2) NOT NULL,
	author_id INT(11) UNSIGNED NOT NULL,
	genre_id INT(11) UNSIGNED NOT NULL,
	publisher_id INT(11) UNSIGNED NOT NULL,
	
	FOREIGN KEY (author_id) REFERENCES author (id),
	FOREIGN KEY (genre_id) REFERENCES genre (id),
	FOREIGN KEY (publisher_id) REFERENCES publisher (id)
);
