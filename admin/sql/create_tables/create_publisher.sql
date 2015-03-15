CREATE TABLE IF NOT EXISTS publisher
(
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name varchar(64) NOT NULL,
  code INT(7),
  num_books INT(10) UNSIGNED NOT NULL DEFAULT 0
);
