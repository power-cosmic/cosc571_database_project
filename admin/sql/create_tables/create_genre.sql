CREATE TABLE genre
(
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  
  most_popular_isbn CHAR(13),
  
	name varchar(64) NOT NULL,
  
  FOREIGN KEY (most_popular_isbn) REFERENCES book (isbn)
);