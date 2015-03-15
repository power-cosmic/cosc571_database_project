CREATE TABLE IF NOT EXISTS author
(
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	first_name varchar(64),
	last_name varchar(64) NOT NULL
);
