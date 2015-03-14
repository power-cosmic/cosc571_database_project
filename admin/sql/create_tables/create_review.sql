DROP TABLE IF EXISTS review;

CREATE TABLE reveiw
(
  book_isbn INT(20) UNSIGNED,
  customer_username VARCHAR(64),
  submit_time DATETIME,
  rating INT(1),
  content VARCHAR(255),
  
  FOREIGN KEY (customer_username) REFERENCES customer (username),
  FOREIGN KEY (book_isbn) REFERENCES book (isbn),
  PRIMARY KEY (book_isbn, customer_username)
);