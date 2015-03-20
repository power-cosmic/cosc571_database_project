CREATE TABLE IF NOT EXISTS credit_card
( number INT(16) UNSIGNED PRIMARY KEY

, type ENUM('Credit', 'Debit')
, ccv VARCHAR(4)
, expiration DATE
, issuer VARCHAR(16)
, name_on_card VARCHAR(128)
, associated_zip INT(5)
, pin_number INT(4)

, username VARCHAR(64)

, FOREIGN KEY (username) REFERENCES customer (username)
);
