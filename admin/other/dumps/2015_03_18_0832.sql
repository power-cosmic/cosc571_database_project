-- MySQL dump 10.13  Distrib 5.6.23, for osx10.8 (x86_64)
--
-- Host: localhost    Database: bbb_te
-- ------------------------------------------------------
-- Server version	5.6.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'H. P.','Lovecraft'),(2,'J. K.','Rowling'),(3,'Suzanne','Collins'),(4,'Dave','Wolverton'),(5,'Jude','Watson');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `isbn` char(13) NOT NULL DEFAULT '',
  `title` varchar(256) NOT NULL,
  `description` varchar(2048) DEFAULT NULL,
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `author_id` int(11) unsigned NOT NULL,
  `publisher_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`isbn`),
  KEY `author_id` (`author_id`),
  KEY `publisher_id` (`publisher_id`),
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`),
  CONSTRAINT `book_ibfk_3` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES ('9780439000017','Harry Potter and the Philosopher\'s Stone',NULL,18.29,2,2),('9780439000024','Harry Potter and the Chamber of Secrets',NULL,15.29,2,2),('9780439000031','Harry Potter and the Prisoner of Azkaban',NULL,17.56,2,2),('9780439000048','Harry Potter and the Goblet of Fire',NULL,5.93,2,2),('9780439000055','Harry Potter and the Order of the Phoenix',NULL,4.98,2,2),('9780439000062','Harry Potter and the Half-Blood Prince',NULL,19.10,2,2),('9780439000079','Harry Potter and the Deathly Hallows',NULL,12.55,2,2),('9780439000086','The Hunger Games',NULL,4.85,3,2),('9780439000093','Catching Fire',NULL,17.25,3,2),('9780439000109','Mockingjay',NULL,19.70,3,2),('9780439000116','The Dark Rival',NULL,10.74,5,2),('9780439000123','The Hidden Past',NULL,6.60,5,2),('9780439000130','The Mark of the Crown',NULL,12.79,5,2),('9780439000147','The Defenders of the Dead',NULL,8.14,5,2),('9780439000154','The Uncertain Path',NULL,14.35,5,2),('9780439000161','The Captive Temple',NULL,11.31,5,2),('9780439000178','The Day of Reckoning',NULL,9.51,5,2),('9780439000185','The Fight for Truth',NULL,9.63,5,2),('9780439000192','The Shattered Peace',NULL,15.63,5,2),('9780439000208','The Deadly Hunter',NULL,13.25,5,2),('9780439000215','The Evil Experiment',NULL,15.37,5,2),('9780439000222','The Dangerous Rescue',NULL,17.10,5,2),('9780439000239','The Ties That Bind',NULL,19.39,5,2),('9780439000246','The Death of Hope',NULL,9.63,5,2),('9780439000253','The Call to Vengeance',NULL,18.01,5,2),('9780439000260','The Only Witness',NULL,9.14,5,2),('9780439000277','The Threat Within',NULL,19.68,5,2),('9780439000284','Special Edition #1: Deceptions',NULL,18.99,5,2),('9780439000291','Special Edition #2: The Followers',NULL,15.92,5,2),('9780439000307','The Rising Force',NULL,18.60,4,2),('9780870450013','The Tomb',NULL,8.13,1,1),('9780870450020','Dagon',NULL,6.45,1,1),('9780870450037','A Reminiscence of Dr. Samuel Johnson',NULL,19.84,1,1),('9780870450044','Polaris',NULL,11.84,1,1),('9780870450051','Beyond the Wall of Sleep',NULL,11.68,1,1),('9780870450068','Memory',NULL,18.87,1,1),('9780870450075','Old Bugs',NULL,7.33,1,1),('9780870450082','The Transition of Juan Romero',NULL,8.02,1,1),('9780870450099','The White Ship',NULL,14.12,1,1),('9780870450105','The Doom that Came to Sarnath',NULL,10.55,1,1),('9780870450112','The Statement of Randolph Carter',NULL,6.38,1,1),('9780870450129','The Street',NULL,12.27,1,1),('9780870450136','The Terrible Old Man',NULL,6.20,1,1),('9780870450143','The Cats of Ulthar',NULL,6.21,1,1),('9780870450150','The Tree',NULL,8.42,1,1),('9780870450167','Celephaïs',NULL,19.49,1,1),('9780870450174','From Beyond',NULL,4.19,1,1),('9780870450181','The Temple',NULL,6.47,1,1),('9780870450198','Nyarlathotep',NULL,15.77,1,1),('9780870450204','The Picture in the House',NULL,7.43,1,1),('9780870450211','Facts Concerning the Late Arthur Jermyn and His Family',NULL,17.87,1,1),('9780870450228','The Nameless City',NULL,15.03,1,1),('9780870450235','The Quest of Iranon',NULL,17.55,1,1),('9780870450242','The Moon-Bog',NULL,6.67,1,1),('9780870450259','Ex Oblivione',NULL,8.70,1,1),('9780870450266','The Other Gods',NULL,19.48,1,1),('9780870450273','The Outsider',NULL,19.30,1,1),('9780870450280','The Music of Erich Zann',NULL,18.07,1,1),('9780870450297','Sweet Ermengarde',NULL,12.45,1,1),('9780870450303','Hypnos',NULL,4.02,1,1),('9780870450310','What the Moon Brings',NULL,10.75,1,1),('9780870450327','Azathoth',NULL,5.70,1,1),('9780870450334','Herbert West–Reanimator',NULL,8.27,1,1),('9780870450341','The Hound',NULL,4.23,1,1),('9780870450358','The Lurking Fear',NULL,8.34,1,1),('9780870450365','The Rats in the Walls',NULL,9.00,1,1),('9780870450372','The Unnamable',NULL,15.97,1,1),('9780870450389','The Festival',NULL,16.88,1,1),('9780870450396','The Shunned House',NULL,16.49,1,1),('9780870450402','The Horror at Red Hook',NULL,11.80,1,1),('9780870450419','He',NULL,5.54,1,1),('9780870450426','In the Vault',NULL,4.31,1,1),('9780870450433','Cool Air',NULL,16.91,1,1),('9780870450440','The Call of Cthulhu',NULL,19.61,1,1),('9780870450457','Pickman\'s Model',NULL,11.35,1,1),('9780870450464','The Strange High House in the Mist',NULL,9.91,1,1),('9780870450471','The Silver Key',NULL,11.51,1,1),('9780870450488','The Dream-Quest of Unknown Kadath',NULL,7.80,1,1),('9780870450495','The Case of Charles Dexter Ward',NULL,16.49,1,1),('9780870450501','The Colour Out of Space',NULL,7.03,1,1),('9780870450518','The Descendant',NULL,13.71,1,1),('9780870450525','The Very Old Folk',NULL,11.43,1,1),('9780870450532','History of the Necronomicon',NULL,12.01,1,1),('9780870450549','The Dunwich Horror',NULL,5.79,1,1),('9780870450556','Ibid',NULL,4.92,1,1),('9780870450563','The Whisperer in Darkness',NULL,19.23,1,1),('9780870450570','At the Mountains of Madness',NULL,13.37,1,1),('9780870450587','The Shadow Over Innsmouth',NULL,5.18,1,1),('9780870450594','The Dreams in the Witch House',NULL,13.77,1,1),('9780870450600','The Thing on the Doorstep',NULL,17.30,1,1),('9780870450617','The Book',NULL,9.20,1,1),('9780870450624','The Evil Clergyman',NULL,6.08,1,1),('9780870450631','The Shadow Out of Time',NULL,14.83,1,1),('9780870450648','The Haunter of the Dark',NULL,19.88,1,1);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER on_insert_book
	BEFORE INSERT
	ON book
	FOR EACH ROW
	BEGIN
		UPDATE publisher 
		SET num_books=num_books+1,
			NEW.isbn=isbn_with_check_digit(CONCAT('9780', code, LPAD(num_books, 8 - CHAR_LENGTH(code), '0')))
		WHERE publisher.id=NEW.publisher_id;
		
		IF (NEW.price = 0) THEN
			SET NEW.price=(RAND() * 16) + 4;
		END IF;
		
	END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `book_genre`
--

DROP TABLE IF EXISTS `book_genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_genre` (
  `isbn` char(13) NOT NULL DEFAULT '',
  `genre_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`isbn`,`genre_id`),
  KEY `genre_id` (`genre_id`),
  CONSTRAINT `book_genre_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`),
  CONSTRAINT `book_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_genre`
--

LOCK TABLES `book_genre` WRITE;
/*!40000 ALTER TABLE `book_genre` DISABLE KEYS */;
INSERT INTO `book_genre` VALUES ('9780870450013',1),('9780870450020',1),('9780870450037',1),('9780870450044',1),('9780870450051',1),('9780870450068',1),('9780870450075',1),('9780870450082',1),('9780870450099',1),('9780870450105',1),('9780870450112',1),('9780870450129',1),('9780870450136',1),('9780870450143',1),('9780870450150',1),('9780870450167',1),('9780870450174',1),('9780870450181',1),('9780870450198',1),('9780870450204',1),('9780870450211',1),('9780870450228',1),('9780870450235',1),('9780870450242',1),('9780870450259',1),('9780870450266',1),('9780870450273',1),('9780870450280',1),('9780870450297',1),('9780870450303',1),('9780870450310',1),('9780870450327',1),('9780870450334',1),('9780870450341',1),('9780870450358',1),('9780870450365',1),('9780870450372',1),('9780870450389',1),('9780870450396',1),('9780870450402',1),('9780870450419',1),('9780870450426',1),('9780870450433',1),('9780870450440',1),('9780870450457',1),('9780870450464',1),('9780870450471',1),('9780870450488',1),('9780870450495',1),('9780870450501',1),('9780870450518',1),('9780870450525',1),('9780870450532',1),('9780870450549',1),('9780870450556',1),('9780870450563',1),('9780870450570',1),('9780870450587',1),('9780870450594',1),('9780870450600',1),('9780870450617',1),('9780870450624',1),('9780870450631',1),('9780870450648',1),('9780870450013',4),('9780870450020',4),('9780870450037',4),('9780870450044',4),('9780870450051',4),('9780870450068',4),('9780870450075',4),('9780870450082',4),('9780870450099',4),('9780870450105',4),('9780870450112',4),('9780870450129',4),('9780870450136',4),('9780870450143',4),('9780870450150',4),('9780870450167',4),('9780870450174',4),('9780870450181',4),('9780870450198',4),('9780870450204',4),('9780870450211',4),('9780870450228',4),('9780870450235',4),('9780870450242',4),('9780870450259',4),('9780870450266',4),('9780870450273',4),('9780870450280',4),('9780870450297',4),('9780870450303',4),('9780870450310',4),('9780870450327',4),('9780870450334',4),('9780870450341',4),('9780870450358',4),('9780870450365',4),('9780870450372',4),('9780870450389',4),('9780870450396',4),('9780870450402',4),('9780870450419',4),('9780870450426',4),('9780870450433',4),('9780870450440',4),('9780870450457',4),('9780870450464',4),('9780870450471',4),('9780870450488',4),('9780870450495',4),('9780870450501',4),('9780870450518',4),('9780870450525',4),('9780870450532',4),('9780870450549',4),('9780870450556',4),('9780870450563',4),('9780870450570',4),('9780870450587',4),('9780870450594',4),('9780870450600',4),('9780870450617',4),('9780870450624',4),('9780870450631',4),('9780870450648',4),('9780439000017',5),('9780439000024',5),('9780439000031',5),('9780439000048',5),('9780439000055',5),('9780439000062',5),('9780439000079',5),('9780439000086',6),('9780439000093',6),('9780439000109',6),('9780439000116',6),('9780439000123',6),('9780439000130',6),('9780439000147',6),('9780439000154',6),('9780439000161',6),('9780439000178',6),('9780439000185',6),('9780439000192',6),('9780439000208',6),('9780439000215',6),('9780439000222',6),('9780439000239',6),('9780439000246',6),('9780439000253',6),('9780439000260',6),('9780439000277',6),('9780439000284',6),('9780439000291',6),('9780439000307',6),('9780439000017',7),('9780439000024',7),('9780439000031',7),('9780439000048',7),('9780439000055',7),('9780439000062',7),('9780439000079',7),('9780439000017',8),('9780439000024',8),('9780439000031',8),('9780439000048',8),('9780439000055',8),('9780439000062',8),('9780439000079',8),('9780439000086',8),('9780439000093',8),('9780439000109',8),('9780439000116',8),('9780439000123',8),('9780439000130',8),('9780439000147',8),('9780439000154',8),('9780439000161',8),('9780439000178',8),('9780439000185',8),('9780439000192',8),('9780439000208',8),('9780439000215',8),('9780439000222',8),('9780439000239',8),('9780439000246',8),('9780439000253',8),('9780439000260',8),('9780439000277',8),('9780439000284',8),('9780439000291',8),('9780439000307',8),('9780439000086',9),('9780439000093',9),('9780439000109',9);
/*!40000 ALTER TABLE `book_genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (1,'Lovecraftian'),(2,'High Fantasy'),(3,'Low Fantasy'),(4,'Horror'),(5,'Magical Realism'),(6,'Science Fiction'),(7,'Bildungsroman'),(8,'Young Adult'),(9,'Dystopian');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publisher`
--

DROP TABLE IF EXISTS `publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publisher` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `code` varchar(7) NOT NULL,
  `num_books` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publisher`
--

LOCK TABLES `publisher` WRITE;
/*!40000 ALTER TABLE `publisher` DISABLE KEYS */;
INSERT INTO `publisher` VALUES (1,'Arkham House','87045',64),(2,'Scholastic','439',30),(3,'Prentice Hall','13',0),(4,'McGraw Hill','7',0),(5,'Addison-Wesley','321',0),(6,'MIT Press','262',0),(7,'Random House','307',0);
/*!40000 ALTER TABLE `publisher` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-18  8:32:31
