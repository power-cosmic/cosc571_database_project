LOCK TABLES `address` WRITE;

/*!40000
ALTER TABLE `address`
DISABLE KEYS                                                                */;

INSERT INTO `address`
     VALUES (1, '1600 Pennsylvania Avenue', 'Washington DC', 20006, 'DC'),
            (2, '11 Wall Street', 'New York', 10005, 'NY'),
            (3, '350 Fifth Avenue', 'New York', 10118, 'NY'),
            (4, '4059 Mt Lee Dr.', 'Hollywood', 90068, 'CA'),
            (5, '900 Oakwood St.', 'Ypsilanti', 48197, 'MI'),
            (6, '1600 Amphitheatre Pkwy', 'Mountain View', 94043, 'CA'),
            (7, '1313 Disneyland Dr.', 'Anaheim', 92802, 'CA'),
            (8, '219 South Main Street', 'Ann Arbor', 48104, 'MI'),
            (9, '910 Pittman Hall', 'Ypsilanti', 48197, 'MI');

/*!40000
ALTER TABLE `address`
ENABLE KEYS                                                                 */;

UNLOCK TABLES;