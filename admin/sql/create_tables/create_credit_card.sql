CREATE TABLE credit_card
(
	number INT(16) UNSIGNED PRIMARY KEY,
	ccv VARCHAR(4),
	type ENUM('Credit', 'Debit'),
	expiration DATE,
	name_on_card VARCHAR(128),
	issuer VARCHAR(16),
	pin_number INT(4),
	associated_zip INT(5),
	username VARCHAR(64),

	FOREIGN KEY (username) REFERENCES customer (username)
);
