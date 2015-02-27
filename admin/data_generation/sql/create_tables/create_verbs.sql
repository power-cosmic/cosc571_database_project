CREATE TABLE verbs
(
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	verb VARCHAR(64) NOT NULL,
	tense ENUM('present', 'past', 'future') NOT NULL,
	is_transitive TINYINT(1) NOT NULL
);
