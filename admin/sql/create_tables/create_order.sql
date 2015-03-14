DROP TABLE IF EXISTS sales_order;

CREATE TABLE sales_order
(
  id INT(11) UNSIGNED PRIMARY KEY,
  
  customer_username VARCHAR(64),
  address_id INT(11) UNSIGNED,
  credit_card_number INT(16) UNSIGNED,
  contact_phone_area_code INT(3),
  contact_phone_number INT(7),
  
  total_cost NUMERIC(6, 2),
  submit_date DATETIME,
  shipping_cost NUMERIC(6, 2),
  delivery_date DATE,
  delivery_status ENUM('pending', 'shipped', 'delivered'),
  
  FOREIGN KEY (contact_phone_area_code, contact_phone_number) REFERENCES phone (area_code, number),
  FOREIGN KEY (customer_username) REFERENCES customer (username),
  FOREIGN KEY (address_id) REFERENCES address (id),
  FOREIGN KEY (credit_card_number) REFERENCES credit_card (number)
);