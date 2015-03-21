CREATE TABLE IF NOT EXISTS address
( id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT

, street_address VARCHAR(128)
, city VARCHAR(64)
, zip INT(5)

, state CHAR(2) NOT NULL

, FOREIGN KEY (state) REFERENCES state (abbreviation)
, PRIMARY KEY (id)
);
