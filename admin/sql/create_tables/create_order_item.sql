CREATE TABLE IF NOT EXISTS order_item
( order_id INT(11) UNSIGNED
, book_isbn CHAR(13)

, FOREIGN KEY (book_isbn) REFERENCES book (isbn)
, FOREIGN KEY (order_id) REFERENCES sales_order (id)
, PRIMARY KEY (order_id, book_isbn)
);
