LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'H. P.','Lovecraft');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;