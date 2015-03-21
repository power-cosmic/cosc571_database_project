CREATE TABLE IF NOT EXISTS state
( abbreviation CHAR(2)

, name VARCHAR(20)

, shipping_code CHAR(1)

, FOREIGN KEY (shipping_code) REFERENCES shipping_zone (code)
, PRIMARY KEY (abbreviation)
);
