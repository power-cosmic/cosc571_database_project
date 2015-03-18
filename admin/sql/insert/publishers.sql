LOCK TABLES `publisher` WRITE;

/*!40000
ALTER TABLE `publisher`
DISABLE KEYS                                                                */;

INSERT INTO `publisher`
     VALUES (1, 'Arkham House', '87045', 64),
            (2, 'Scholastic', '439', 30),
            (3, 'Prentice Hall', '13', 0),
            (4, 'McGraw Hill', '7', 0),
            (5, 'Addison-Wesley', '321', 0),
            (6, 'MIT Press', '262', 0),
            (7, 'Random House', '307', 0);

/*!40000
ALTER TABLE `publisher`
ENABLE KEYS                                                                 */;

UNLOCK TABLES;