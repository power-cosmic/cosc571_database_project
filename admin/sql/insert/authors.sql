LOCK TABLES `author` WRITE;

/*!40000
ALTER TABLE `author`
DISABLE KEYS                                                                */;

INSERT INTO `author`
     VALUES (1, 'H. P.', 'Lovecraft'),
            (2, 'J. K.', 'Rowling'),
            (3, 'Suzanne', 'Collins'),
            (4, 'Dave', 'Wolverton'),
            (5, 'Jude', 'Watson');

/*!40000
ALTER TABLE `author`
ENABLE KEYS                                                                 */;

UNLOCK TABLES;