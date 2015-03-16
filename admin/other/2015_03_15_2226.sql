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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'H. P.','Lovecraft');
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
  `genre_id` int(11) unsigned NOT NULL,
  `publisher_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`isbn`),
  KEY `author_id` (`author_id`),
  KEY `genre_id` (`genre_id`),
  KEY `publisher_id` (`publisher_id`),
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`),
  CONSTRAINT `book_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`),
  CONSTRAINT `book_ibfk_3` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES ('9780870450013','The Tomb',NULL,8.13,1,1,1),('9780870450020','Dagon',NULL,6.45,1,1,1),('9780870450037','A Reminiscence of Dr. Samuel Johnson',NULL,19.84,1,1,1),('9780870450044','Polaris',NULL,11.84,1,1,1),('9780870450051','Beyond the Wall of Sleep',NULL,11.68,1,1,1),('9780870450068','Memory',NULL,18.87,1,1,1),('9780870450075','Old Bugs',NULL,7.33,1,1,1),('9780870450082','The Transition of Juan Romero',NULL,8.02,1,1,1),('9780870450099','The White Ship',NULL,14.12,1,1,1),('9780870450105','The Doom that Came to Sarnath',NULL,10.55,1,1,1),('9780870450112','The Statement of Randolph Carter',NULL,6.38,1,1,1),('9780870450129','The Street',NULL,12.27,1,1,1),('9780870450136','The Terrible Old Man',NULL,6.20,1,1,1),('9780870450143','The Cats of Ulthar',NULL,6.21,1,1,1),('9780870450150','The Tree',NULL,8.42,1,1,1),('9780870450167','Celephaïs',NULL,19.49,1,1,1),('9780870450174','From Beyond',NULL,4.19,1,1,1),('9780870450181','The Temple',NULL,6.47,1,1,1),('9780870450198','Nyarlathotep',NULL,15.77,1,1,1),('9780870450204','The Picture in the House',NULL,7.43,1,1,1),('9780870450211','Facts Concerning the Late Arthur Jermyn and His Family',NULL,17.87,1,1,1),('9780870450228','The Nameless City',NULL,15.03,1,1,1),('9780870450235','The Quest of Iranon',NULL,17.55,1,1,1),('9780870450242','The Moon-Bog',NULL,6.67,1,1,1),('9780870450259','Ex Oblivione',NULL,8.70,1,1,1),('9780870450266','The Other Gods',NULL,19.48,1,1,1),('9780870450273','The Outsider',NULL,19.30,1,1,1),('9780870450280','The Music of Erich Zann',NULL,18.07,1,1,1),('9780870450297','Sweet Ermengarde',NULL,12.45,1,1,1),('9780870450303','Hypnos',NULL,4.02,1,1,1),('9780870450310','What the Moon Brings',NULL,10.75,1,1,1),('9780870450327','Azathoth',NULL,5.70,1,1,1),('9780870450334','Herbert West–Reanimator',NULL,8.27,1,1,1),('9780870450341','The Hound',NULL,4.23,1,1,1),('9780870450358','The Lurking Fear',NULL,8.34,1,1,1),('9780870450365','The Rats in the Walls',NULL,9.00,1,1,1),('9780870450372','The Unnamable',NULL,15.97,1,1,1),('9780870450389','The Festival',NULL,16.88,1,1,1),('9780870450396','The Shunned House',NULL,16.49,1,1,1),('9780870450402','The Horror at Red Hook',NULL,11.80,1,1,1),('9780870450419','He',NULL,5.54,1,1,1),('9780870450426','In the Vault',NULL,4.31,1,1,1),('9780870450433','Cool Air',NULL,16.91,1,1,1),('9780870450440','The Call of Cthulhu',NULL,19.61,1,1,1),('9780870450457','Pickman\'s Model',NULL,11.35,1,1,1),('9780870450464','The Strange High House in the Mist',NULL,9.91,1,1,1),('9780870450471','The Silver Key',NULL,11.51,1,1,1),('9780870450488','The Dream-Quest of Unknown Kadath',NULL,7.80,1,1,1),('9780870450495','The Case of Charles Dexter Ward',NULL,16.49,1,1,1),('9780870450501','The Colour Out of Space',NULL,7.03,1,1,1),('9780870450518','The Descendant',NULL,13.71,1,1,1),('9780870450525','The Very Old Folk',NULL,11.43,1,1,1),('9780870450532','History of the Necronomicon',NULL,12.01,1,1,1),('9780870450549','The Dunwich Horror',NULL,5.79,1,1,1),('9780870450556','Ibid',NULL,4.92,1,1,1),('9780870450563','The Whisperer in Darkness',NULL,19.23,1,1,1),('9780870450570','At the Mountains of Madness',NULL,13.37,1,1,1),('9780870450587','The Shadow Over Innsmouth',NULL,5.18,1,1,1),('9780870450594','The Dreams in the Witch House',NULL,13.77,1,1,1),('9780870450600','The Thing on the Doorstep',NULL,17.30,1,1,1),('9780870450617','The Book',NULL,9.20,1,1,1),('9780870450624','The Evil Clergyman',NULL,6.08,1,1,1),('9780870450631','The Shadow Out of Time',NULL,14.83,1,1,1),('9780870450648','The Haunter of the Dark',NULL,19.88,1,1,1);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (1,'Lovecraftian'),(2,'High Fantasy'),(3,'Low Fantasy');
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
  `num_books` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publisher`
--

LOCK TABLES `publisher` WRITE;
/*!40000 ALTER TABLE `publisher` DISABLE KEYS */;
INSERT INTO `publisher` VALUES (1,'Arkham House','87045',64);
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

-- Dump completed on 2015-03-15 22:25:12
