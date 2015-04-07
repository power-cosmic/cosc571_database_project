-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `street_address` varchar(128) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `zip` int(5) DEFAULT NULL,
  `state` char(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `address_ibfk_1` (`state`),
  CONSTRAINT `address_ibfk_1` FOREIGN KEY (`state`) REFERENCES `state` (`abbreviation`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,'1600 Pennsylvania Avenue','Washington DC',20006,'DC'),(2,'11 Wall Street','New York',10005,'NY'),(3,'350 Fifth Avenue','New York',10118,'NY'),(4,'4059 Mt Lee Dr.','Hollywood',90068,'CA'),(5,'900 Oakwood St.','Ypsilanti',48197,'MI'),(6,'1600 Amphitheatre Pkwy','Mountain View',94043,'CA'),(7,'1313 Disneyland Dr.','Anaheim',92802,'CA'),(8,'219 South Main Street','Ann Arbor',48104,'MI'),(9,'910 Pittman Hall','Ypsilanti',48197,'MI'),(10,'703 Pearl St','Ypsilanti',48197,'MI'),(11,'1122 Ferdon Rd','Ann Arbor',48104,'MI'),(12,'1601 Packard St','Ann Arbor',48104,'MI'),(13,'909 Elms Road','Killeen',76542,'TX'),(16,'432 Trowbridge','North Hampton',80108,'CO'),(17,'111 Santa Monica Blvd','Santa Monica',90401,'CA'),(18,'320 E Arctic Ave','Palmer',99645,'AK');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `username` varchar(64) NOT NULL,
  `password` char(41) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('admin','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19'),('egurnee','*59C70DA2F3E3A5BDF46B68F5C8B8F25762BCCEF0'),('root','*81F5E21E35407D884A6CD4A731AEBFB6AF209E1B'),('thoffman','*59C70DA2F3E3A5BDF46B68F5C8B8F25762BCCEF0');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon` (
  `entry_code` char(10) NOT NULL,
  `expiration_date` date NOT NULL,
  `value` decimal(6,2) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `customer_username` varchar(64) DEFAULT NULL,
  `order_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`entry_code`),
  KEY `coupon_ibfk_1` (`customer_username`),
  KEY `coupon_ibfk_2` (`order_id`),
  CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customer` (`username`),
  CONSTRAINT `coupon_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `sales_order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon`
--

LOCK TABLES `coupon` WRITE;
/*!40000 ALTER TABLE `coupon` DISABLE KEYS */;
INSERT INTO `coupon` VALUES ('345-HX-35D','2018-02-25',10.00,0,'crusader_with_a_cape',NULL),('534-HA-F3A','2020-02-02',5.00,0,NULL,NULL),('983-HX-543','2015-01-18',5.00,1,'egurnee',2);
/*!40000 ALTER TABLE `coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credit_card`
--

DROP TABLE IF EXISTS `credit_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credit_card` (
  `number` char(16) NOT NULL,
  `ccv` varchar(4) DEFAULT NULL,
  `type` enum('credit','cebit') DEFAULT NULL,
  `expiration` date NOT NULL,
  `name_on_card` varchar(128) DEFAULT NULL,
  `issuer` varchar(16) DEFAULT NULL,
  `pin_number` int(4) DEFAULT NULL,
  `associated_zip` int(5) DEFAULT NULL,
  PRIMARY KEY (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credit_card`
--

LOCK TABLES `credit_card` WRITE;
/*!40000 ALTER TABLE `credit_card` DISABLE KEYS */;
INSERT INTO `credit_card` VALUES ('4024007166219237','843','credit','2017-08-01',NULL,'visa',NULL,10118),('4295917786396557','742','credit','2020-04-01',NULL,'mastercard',NULL,48335),('4485542706843825',NULL,NULL,'2019-10-23',NULL,'visa',NULL,NULL),('4532663130801651',NULL,NULL,'2015-02-02',NULL,'visa',NULL,NULL),('4532848537371669','580','credit','2018-07-01',NULL,'visa',NULL,20006),('4539968239906597','776','credit','2019-05-01',NULL,'visa',NULL,94043),('4929563856339756','669','credit','2020-12-01',NULL,'mastercard',NULL,48104),('5347021254537894',NULL,NULL,'2017-08-23',NULL,'mastercard',NULL,NULL),('5593546245774207',NULL,NULL,'2015-06-12',NULL,'mastercard',NULL,NULL);
/*!40000 ALTER TABLE `credit_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency` (
  `name` varchar(40) NOT NULL,
  `symbol` char(8) NOT NULL,
  `price_multiplier` decimal(13,4) NOT NULL,
  `symbol_location` enum('left','right') DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` VALUES ('bitcoin','&#x0243;',0.0038,'right'),('euro','&#x20AC;',0.9100,'left'),('indian_rupee','&#x20B9;',62.2000,'left'),('korean_won','&#x20A9;',1080.8500,'left'),('peso','&#x20B1;',14.8200,NULL),('pound','&#x00A3;',0.6700,'left'),('sheqel','&#x20AA;',3.9100,'right'),('thai_baht','&#x0E3F;',32.1800,'left'),('turkish_lira','&#x20BA;',3.5600,'left'),('us_cent','&#x00A2;',100.0000,'right'),('us_dollar','&#x0024;',1080.8500,'left'),('yen','&#x00A5;',119.0000,'left'),('zloty','z&#x142;',3.6900,'left');
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `username` varchar(64) NOT NULL,
  `password` char(41) NOT NULL,
  `email` varchar(64) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `middle_initial` varchar(1) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `loyalty_points` int(10) DEFAULT '0',
  `one_click_buying` tinyint(1) DEFAULT '0',
  `prime_member` tinyint(1) DEFAULT '0',
  `phone_area_code` int(3) DEFAULT NULL,
  `phone_number` int(7) DEFAULT NULL,
  `address_id` int(11) unsigned DEFAULT NULL,
  `card_number` char(16) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `phone_area_code` (`phone_area_code`,`phone_number`),
  KEY `address_id` (`address_id`),
  KEY `card_number` (`card_number`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`phone_area_code`, `phone_number`) REFERENCES `phone` (`area_code`, `number`),
  CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES ('crusader_with_a_cape','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19','not_bruce_wayne@WayneEnterprises.com','Bruce','Wayne',NULL,NULL,0,0,0,NULL,NULL,17,'4539968239906597'),('egurnee','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19','egurnee@emich.edu','Eddie','Gurnee','P','1990-10-27',0,0,1,NULL,NULL,9,'4929563856339756'),('LastSonOfKrypton','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19','ckent@dailyplanet.com','Kal','El',NULL,NULL,0,0,0,NULL,NULL,18,'4485542706843825'),('LordOfTheSith','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19','dark_lord@theforce.com','Anakin','Skywalker',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL),('macbook_man','*E3353DC671D3348CCF4698E672790B279E08FE60','kdrogo@dothrak.org','Khal','Drogo',NULL,NULL,0,0,0,NULL,NULL,16,'5593546245774207'),('OurOnlyHope','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19','last_knight@theforce.com','Obi-Wan','Kenobi',NULL,NULL,0,0,0,NULL,NULL,10,'4024007166219237'),('pegurnee','*E3353DC671D3348CCF4698E672790B279E08FE60','pegurnee@gmail.com','Another','Gurnee',NULL,NULL,0,0,0,NULL,NULL,18,'5593546245774207'),('polymorph','*E3353DC671D3348CCF4698E672790B279E08FE60','egurnee@emich.edu','Edward','Gurnee',NULL,NULL,0,0,0,NULL,NULL,13,'4485542706843825'),('thefastestmanalive','*E3353DC671D3348CCF4698E672790B279E08FE60','ballen@ccpd.gov','Barry','Allen',NULL,NULL,0,0,0,NULL,NULL,17,'5347021254537894');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `bbb_te`.`customer_BEFORE_INSERT` BEFORE INSERT ON `customer` FOR EACH ROW
BEGIN
	SET NEW.password = password(NEW.password);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `customer_address`
--

DROP TABLE IF EXISTS `customer_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_address` (
  `username` varchar(64) NOT NULL DEFAULT '',
  `address_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`,`address_id`),
  KEY `address_id` (`address_id`),
  CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer` (`username`),
  CONSTRAINT `customer_address_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_address`
--

LOCK TABLES `customer_address` WRITE;
/*!40000 ALTER TABLE `customer_address` DISABLE KEYS */;
INSERT INTO `customer_address` VALUES ('egurnee',5),('crusader_with_a_cape',7),('LastSonOfKrypton',7),('LordOfTheSith',8),('OurOnlyHope',8),('egurnee',9),('polymorph',13),('macbook_man',16),('crusader_with_a_cape',17),('thefastestmanalive',17),('pegurnee',18);
/*!40000 ALTER TABLE `customer_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_credit_card`
--

DROP TABLE IF EXISTS `customer_credit_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_credit_card` (
  `customer_username` varchar(64) NOT NULL,
  `credit_card_number` char(16) NOT NULL,
  PRIMARY KEY (`customer_username`,`credit_card_number`),
  KEY `customer_credit_card_ibfk_2_idx` (`credit_card_number`),
  CONSTRAINT `customer_credit_card_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customer` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `customer_credit_card_ibfk_2` FOREIGN KEY (`credit_card_number`) REFERENCES `credit_card` (`number`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_credit_card`
--

LOCK TABLES `customer_credit_card` WRITE;
/*!40000 ALTER TABLE `customer_credit_card` DISABLE KEYS */;
INSERT INTO `customer_credit_card` VALUES ('LordOfTheSith','4024007166219237'),('egurnee','4295917786396557'),('polymorph','4485542706843825'),('crusader_with_a_cape','4532663130801651'),('LastSonOfKrypton','4532848537371669'),('crusader_with_a_cape','4539968239906597'),('OurOnlyHope','4539968239906597'),('egurnee','4929563856339756'),('OurOnlyHope','4929563856339756'),('thefastestmanalive','5347021254537894'),('macbook_man','5593546245774207'),('pegurnee','5593546245774207');
/*!40000 ALTER TABLE `customer_credit_card` ENABLE KEYS */;
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
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item` (
  `order_id` int(11) unsigned NOT NULL DEFAULT '0',
  `book_isbn` char(13) NOT NULL DEFAULT '',
  `quantity` int(4) NOT NULL,
  PRIMARY KEY (`order_id`,`book_isbn`),
  KEY `book_isbn` (`book_isbn`),
  CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`book_isbn`) REFERENCES `book` (`isbn`),
  CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `sales_order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

LOCK TABLES `order_item` WRITE;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
INSERT INTO `order_item` VALUES (2,'9780439000017',2),(2,'9780870450020',1),(7,'9780870450099',1),(7,'9780870450211',1),(8,'9780439000017',2),(8,'9780439000024',2),(8,'9780439000031',2),(8,'9780439000048',1),(8,'9780870450013',1),(8,'9780870450099',3),(8,'9780870450440',1),(8,'9780870450464',2),(9,'9780870450020',1),(9,'9780870450037',1),(9,'9780870450044',1),(9,'9780870450051',1),(9,'9780870450075',1),(9,'9780870450105',1),(9,'9780870450112',1),(9,'9780870450174',1),(9,'9780870450181',1),(9,'9780870450198',1),(9,'9780870450211',1),(9,'9780870450266',1),(9,'9780870450273',1),(9,'9780870450280',1),(9,'9780870450303',1),(9,'9780870450327',1),(9,'9780870450334',1),(9,'9780870450402',1),(9,'9780870450426',1),(9,'9780870450440',1),(9,'9780870450464',1),(9,'9780870450471',1),(9,'9780870450518',1),(9,'9780870450532',1),(9,'9780870450549',1),(9,'9780870450563',1),(9,'9780870450570',1),(9,'9780870450587',1),(9,'9780870450594',1),(9,'9780870450631',1),(9,'9780870450648',1),(10,'9780439000116',1),(10,'9780439000123',1),(10,'9780439000130',1),(10,'9780439000147',1),(10,'9780439000154',1),(10,'9780439000161',1),(10,'9780439000178',1),(10,'9780439000185',1),(10,'9780439000192',1),(10,'9780439000208',1),(10,'9780439000215',1),(10,'9780439000222',1),(10,'9780439000239',1),(10,'9780439000246',1),(10,'9780439000253',1),(10,'9780439000260',1),(10,'9780439000277',1),(10,'9780439000284',1),(10,'9780439000291',1),(10,'9780439000307',1);
/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `bbb_te`.`order_item_BEFORE_INSERT` BEFORE INSERT ON `order_item` FOR EACH ROW
BEGIN
	UPDATE sales_order
    SET total_cost = total_cost + (NEW.quantity * (
									SELECT price 
                                    FROM book 
                                    WHERE book.isbn=NEW.book_isbn))
    WHERE sales_order.id=NEW.order_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `phone`
--

DROP TABLE IF EXISTS `phone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone` (
  `area_code` int(3) NOT NULL DEFAULT '0',
  `number` int(7) NOT NULL DEFAULT '0',
  `carrier` enum('txt.att.net','message.alltel.com','myboostmobile.com','mymetropcs.com','messaging.nextel.com','messaging.sprintpcs.com','tmomail.net','email.uscc.net','vtext.com','vmobl.com') NOT NULL,
  PRIMARY KEY (`area_code`,`number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone`
--

LOCK TABLES `phone` WRITE;
/*!40000 ALTER TABLE `phone` DISABLE KEYS */;
/*!40000 ALTER TABLE `phone` ENABLE KEYS */;
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

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review` (
  `book_isbn` char(13) NOT NULL DEFAULT '',
  `customer_username` varchar(64) NOT NULL DEFAULT '',
  `submit_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` int(1) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`book_isbn`,`customer_username`),
  KEY `customer_username` (`customer_username`),
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customer` (`username`),
  CONSTRAINT `review_ibfk_2` FOREIGN KEY (`book_isbn`) REFERENCES `book` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES ('9780439000307','OurOnlyHope','2015-04-02 00:02:14',5,'This book is simply splendid; a must read!'),('9780870450440','egurnee','2015-04-02 00:15:06',5,'Seriously one of the most glorious books ever written.');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_order`
--

DROP TABLE IF EXISTS `sales_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `total_cost` decimal(6,2) NOT NULL DEFAULT '0.00',
  `submit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shipping_cost` decimal(6,2) NOT NULL DEFAULT '0.00',
  `delivery_date` date DEFAULT NULL,
  `delivery_status` enum('pending','shipped','delivered') NOT NULL DEFAULT 'pending',
  `contact_phone_area_code` int(3) DEFAULT NULL,
  `contact_phone_number` int(7) DEFAULT NULL,
  `customer_username` varchar(64) NOT NULL,
  `address_id` int(11) unsigned NOT NULL,
  `credit_card_number` char(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_phone_area_code` (`contact_phone_area_code`,`contact_phone_number`),
  KEY `credit_card_number` (`credit_card_number`),
  KEY `sales_order_ibfk_2` (`customer_username`),
  KEY `sales_order_ibfk_3` (`address_id`),
  CONSTRAINT `sales_order_ibfk_1` FOREIGN KEY (`contact_phone_area_code`, `contact_phone_number`) REFERENCES `phone` (`area_code`, `number`),
  CONSTRAINT `sales_order_ibfk_2` FOREIGN KEY (`customer_username`) REFERENCES `customer` (`username`),
  CONSTRAINT `sales_order_ibfk_3` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_order`
--

LOCK TABLES `sales_order` WRITE;
/*!40000 ALTER TABLE `sales_order` DISABLE KEYS */;
INSERT INTO `sales_order` VALUES (2,43.03,'2015-03-19 00:57:41',0.00,'2015-03-19','pending',NULL,NULL,'egurnee',9,'4295917786396557'),(7,31.99,'2015-04-02 06:11:23',0.00,'2015-04-03','pending',NULL,NULL,'egurnee',9,'4929563856339756'),(8,198.13,'2015-04-05 03:30:41',0.00,'2015-04-05','pending',NULL,NULL,'egurnee',9,'4929563856339756'),(9,368.12,'2015-01-07 01:32:40',10.00,'2015-04-12','pending',NULL,NULL,'crusader_with_a_cape',17,'4539968239906597'),(10,273.78,'2015-02-07 02:09:19',2.00,'2015-02-07','pending',NULL,NULL,'OurOnlyHope',10,'4024007166219237');
/*!40000 ALTER TABLE `sales_order` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `bbb_te`.`sales_order_BEFORE_INSERT` BEFORE INSERT ON `sales_order` FOR EACH ROW
BEGIN
	SET NEW.delivery_date = (
							SELECT CURDATE() + (
									SELECT deliver_time 
                                    FROM state as s, shipping_zone as z, address as a 
                                    WHERE s.shipping_code=z.code 
										AND NEW.address_id=a.id 
                                        AND s.abbreviation=a.state));
                                        
	IF NOT (SELECT prime_member FROM customer as c WHERE c.username=NEW.customer_username) THEN
		SET NEW.shipping_cost = (SELECT price 
							FROM state as s, shipping_zone as z, address as a 
							WHERE s.shipping_code=z.code 
								AND NEW.address_id=a.id 
								AND s.abbreviation=a.state);
	END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `series`
--

DROP TABLE IF EXISTS `series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `series` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series`
--

LOCK TABLES `series` WRITE;
/*!40000 ALTER TABLE `series` DISABLE KEYS */;
INSERT INTO `series` VALUES (1,'Harry Potter'),(2,'Hunger Games'),(3,'Lord of the Rings'),(4,'Jedi Apprentice'),(5,'His Dark Materials'),(6,'The Sword of Shannara Trilogy'),(7,'The Heritage of Shannara'),(8,'A Song of Ice and Fire');
/*!40000 ALTER TABLE `series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `series_entry`
--

DROP TABLE IF EXISTS `series_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `series_entry` (
  `book_isbn` char(13) NOT NULL DEFAULT '',
  `series_id` int(11) unsigned NOT NULL DEFAULT '0',
  `position` int(5) DEFAULT NULL,
  PRIMARY KEY (`book_isbn`,`series_id`),
  KEY `series_id` (`series_id`),
  CONSTRAINT `series_entry_ibfk_1` FOREIGN KEY (`book_isbn`) REFERENCES `book` (`isbn`),
  CONSTRAINT `series_entry_ibfk_2` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series_entry`
--

LOCK TABLES `series_entry` WRITE;
/*!40000 ALTER TABLE `series_entry` DISABLE KEYS */;
INSERT INTO `series_entry` VALUES ('9780439000017',1,1),('9780439000024',1,2),('9780439000031',1,3),('9780439000048',1,4),('9780439000055',1,5),('9780439000062',1,6),('9780439000079',1,7),('9780439000086',2,1),('9780439000093',2,2),('9780439000109',2,3),('9780439000116',4,2),('9780439000123',4,3),('9780439000130',4,4),('9780439000147',4,5),('9780439000154',4,6),('9780439000161',4,7),('9780439000178',4,8),('9780439000185',4,9),('9780439000192',4,10),('9780439000208',4,11),('9780439000215',4,12),('9780439000222',4,13),('9780439000239',4,14),('9780439000246',4,15),('9780439000253',4,16),('9780439000260',4,17),('9780439000277',4,18),('9780439000307',4,1);
/*!40000 ALTER TABLE `series_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_zone`
--

DROP TABLE IF EXISTS `shipping_zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping_zone` (
  `code` char(1) NOT NULL DEFAULT '',
  `price` decimal(6,2) NOT NULL,
  `deliver_time` int(2) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_zone`
--

LOCK TABLES `shipping_zone` WRITE;
/*!40000 ALTER TABLE `shipping_zone` DISABLE KEYS */;
INSERT INTO `shipping_zone` VALUES ('A',2.00,1),('B',3.00,3),('C',5.25,4),('D',8.50,6),('E',10.00,6),('F',15.00,8);
/*!40000 ALTER TABLE `shipping_zone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `abbreviation` char(2) NOT NULL,
  `name` varchar(20) NOT NULL DEFAULT '',
  `shipping_code` char(1) NOT NULL,
  PRIMARY KEY (`abbreviation`),
  KEY `state_ibfk_1` (`shipping_code`),
  CONSTRAINT `state_ibfk_1` FOREIGN KEY (`shipping_code`) REFERENCES `shipping_zone` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES ('AK','Alaska','F'),('AL','Alabama','C'),('AR','Arkansas','C'),('AZ','Arizona','D'),('CA','California','E'),('CO','Colorado','D'),('CT','Connecticut','C'),('DC','District of Columbia','B'),('DE','Delaware','B'),('FL','Florida','D'),('GA','Georgia','C'),('HI','Hawaii','F'),('IA','Iowa','B'),('ID','Idaho','E'),('IL','Illinois','A'),('IN','Indiana','A'),('KS','Kansas','C'),('KY','Kentucky','B'),('LA','Louisiana','C'),('MA','Massachusetts','C'),('MD','Maryland','B'),('ME','Maine','D'),('MI','Michigan','A'),('MN','Minnesota','A'),('MO','Missouri','B'),('MS','Mississippi','C'),('MT','Montana','D'),('NC','North Carolina','B'),('ND','North Dakota','C'),('NE','Nebraska','C'),('NH','New Hampshire','C'),('NJ','New Jersey','B'),('NM','New Mexico','D'),('NV','Nevada','E'),('NY','New York','B'),('OH','Ohio','A'),('OK','Oklahoma','C'),('OR','Oregon','E'),('PA','Pennsylvania','B'),('RI','Rhode Island','C'),('SC','South Carolina','C'),('SD','South Dakota','C'),('TN','Tennessee','B'),('TX','Texas','C'),('UT','Utah','D'),('VA','Virginia','B'),('VT','Vermont','C'),('WA','Washington','E'),('WI','Wisconsin','A'),('WV','West Virginia','B'),('WY','Wyoming','D');
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlist` (
  `book_isbn` char(13) NOT NULL DEFAULT '',
  `customer_username` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`book_isbn`,`customer_username`),
  KEY `customer_username` (`customer_username`),
  CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customer` (`username`),
  CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`book_isbn`) REFERENCES `book` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
INSERT INTO `wishlist` VALUES ('9780439000079','egurnee'),('9780870450440','egurnee'),('9780439000307','OurOnlyHope');
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bbb_te'
--

--
-- Dumping routines for database 'bbb_te'
--
/*!50003 DROP FUNCTION IF EXISTS `isbn_check_digit` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `isbn_check_digit`(isbn_check CHAR(12)) RETURNS char(1) CHARSET latin1
BEGIN
        DECLARE check_digit, temp_num, loop_index INT;
        SET check_digit = 0;
        SET loop_index = 0;
        
		count_loop: LOOP
			SET loop_index = loop_index + 1;
			IF (loop_index % 2) = 1 THEN
				SET temp_num = CAST(SUBSTRING(isbn_check, loop_index, 1) AS UNSIGNED) * 1;
			ELSE 
				SET temp_num = CAST(SUBSTRING(isbn_check, loop_index, 1) AS UNSIGNED) * 3;
			END IF;
			SET check_digit = check_digit + temp_num;
			IF loop_index = CHAR_LENGTH(isbn_check) THEN
				LEAVE count_loop;
			END IF;
		END LOOP;
		SET check_digit = 10 - check_digit % 10;
        RETURN CAST(check_digit AS CHAR(1));
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `isbn_with_check_digit` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `isbn_with_check_digit`(isbn_check CHAR(12)) RETURNS char(13) CHARSET latin1
BEGIN
        DECLARE check_digit, temp_num, loop_index INT;
        SET check_digit = 0;
        SET loop_index = 0;
        
		count_loop: LOOP
			SET loop_index = loop_index + 1;
			IF (loop_index % 2) = 1 THEN
				SET temp_num = CAST(SUBSTRING(isbn_check, loop_index, 1) AS UNSIGNED) * 1;
			ELSE 
				SET temp_num = CAST(SUBSTRING(isbn_check, loop_index, 1) AS UNSIGNED) * 3;
			END IF;
			SET check_digit = check_digit + temp_num;
			IF loop_index = CHAR_LENGTH(isbn_check) THEN
				LEAVE count_loop;
			END IF;
		END LOOP;
		SET check_digit = 10 - check_digit % 10;
		IF (check_digit = 10) THEN
			SET check_digit = 0;
		END IF;
        RETURN CONCAT(isbn_check, CAST(check_digit AS CHAR(1)));
    END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-06 21:42:16
