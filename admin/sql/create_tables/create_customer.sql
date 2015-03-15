CREATE TABLE IF NOT EXISTS customer
(
	username VARCHAR(64) PRIMARY KEY,
	password CHAR(41),  
	first_name VARCHAR(64),
	last_name VARCHAR(64) NOT NULL,
	middle_initial VARCHAR(1),
	date_of_birth DATE,
	phone_area_code INT(3),
	phone_number INT(7),
	address_id INT(11) UNSIGNED,
	card_number INT(16) UNSIGNED,	
	loyalty_points INT(10),
	one_click_buying BOOLEAN,
	prime_member BOOLEAN,

	FOREIGN KEY (phone_area_code, phone_number) REFERENCES phone (area_code, number),
	FOREIGN KEY (address_id) REFERENCES address (id),
	FOREIGN KEY (card_number) REFERENCES credit_card (number)
);
