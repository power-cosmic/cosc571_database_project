DROP TABLE IF EXISTS wishlist;

CREATE TABLE wishlist
(
  book_isbn INT(20) UNSIGNED,
  customer_username VARCHAR(64),
  
  FOREIGN KEY (customer_username) REFERENCES customer (username),
  FOREIGN KEY (book_isbn) REFERENCES book (isbn),
  PRIMARY KEY (book_isbn, customer_username)
);