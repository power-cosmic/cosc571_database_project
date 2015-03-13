CREATE TABLE customer_address
(
	username VARCHAR(64),
	address_id INT(11) UNSIGNED,

	PRIMARY KEY (username, address_id),
	FOREIGN KEY (username) REFERENCES customer (username),
	FOREIGN KEY (address_id) REFERENCES address (id)
);
