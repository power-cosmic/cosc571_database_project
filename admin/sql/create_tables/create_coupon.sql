DROP TABLE IF EXISTS coupon;

CREATE TABLE coupon
(
  entry_code CHAR(10) PRIMARY KEY,
  customer_username VARCHAR(64),
  order_id INT(11) UNSIGNED,
  expiration_date DATE,
  value NUMERIC(6, 2),
  used BOOLEAN,
  
  FOREIGN KEY (customer_username) REFERENCES customer (username),
  FOREIGN KEY (order_id) REFERENCES sales_order (id)
);