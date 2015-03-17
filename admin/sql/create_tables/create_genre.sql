CREATE TABLE IF NOT EXISTS genre
( id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY

, name varchar(64) NOT NULL

, most_popular_isbn CHAR(13)

, FOREIGN KEY (most_popular_isbn) REFERENCES book (isbn)
);
