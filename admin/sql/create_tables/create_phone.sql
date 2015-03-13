CREATE TABLE phone
(
  area_code INT(3),
  number INT(7),
  carrier VARCHAR(20),
  
  PRIMARY KEY (area_code, number)
);