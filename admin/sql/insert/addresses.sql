LOCK TABLES `address` WRITE;

/*!40000
ALTER TABLE `address`
DISABLE KEYS                                                                */;

INSERT INTO `address`
		VALUES	(1, '703 Pearl St', 'Ypsilanti', 'MI', 48197),
						(2, '1122 Ferdon Rd', 'Ann Arbor', 'MI', 48104),
						(3, '1601 Packard St', 'Ann Arbor', 'MI', 48104);

/*!40000
ALTER TABLE `genre`
ENABLE KEYS                                                                 */;

UNLOCK TABLES;
