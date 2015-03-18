CREATE TABLE IF NOT EXISTS state
( name VARCHAR(20)

, abbreviation CHAR(2)

, shipping_code CHAR(1)

, FOREIGN KEY (shipping_code) REFERENCES shipping_zone (code)
, PRIMARY KEY (name)
);
