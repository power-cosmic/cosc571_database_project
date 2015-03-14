DROP TABLE IF EXISTS admin;

CREATE TABLE admin
(
  username VARCHAR(64) PRIMARY KEY,
  password CHAR(41)
);