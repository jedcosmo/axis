-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: axis
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

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
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `reason` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'2016-10-19 01:50:11','asdasd','asdasd','asdasd','asdasd','asdasd','0'),(2,'2016-10-19 01:51:04','Calvin','Guevarra','calvin@domandtom.com','098234789','Test Message','0'),(3,'2016-10-19 02:28:00','John','Doe','johndoe@mail.com','098278439087',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis aliquet turpis. Proin lobortis dolor eu purus posuere mollis. Etiam eget justo nulla. Aliquam erat volutpat. In posuere fermentum mauris, ac placerat nulla dignissim in. Morbi venenatis lobortis justo in pulvinar. Nulla augue lectus, luctus nec mollis sed, venenatis non metus. Donec vestibulum odio ut leo finibus tincidunt nec sit amet nisl.\r\n\r\nVivamus gravida egestas arcu. Phasellus volutpat a ipsum vitae tempor. Morbi est nisi, scelerisque in turpis non, mollis euismod nisi. Nulla vulputate ac magna a dignissim. Proin blandit sit amet nunc vel dignissim. Vivamus vulputate, nibh quis cursus tristique, mauris magna hendrerit mauris, feugiat congue justo est a tellus. Integer lobortis ut mauris vel semper. Etiam mollis ex vitae dolor venenatis gravida viverra eget nunc. Proin sed interdum mauris. Integer sed lobortis diam. Phasellus sodales urna quis ligula congue venenatis. Suspendisse finibus bibendum orci, at ullamcorper augue pretium eget. Nulla ultrices maximus magna id vestibulum. Nulla viverra arcu a dui lacinia, congue tristique quam tincidunt. Nunc at venenatis libero, vel vehicula nisl.\r\n\r\nPraesent vitae blandit orci. Nullam gravida luctus odio sed semper. Integer sagittis, dui eget convallis feugiat, lectus orci ullamcorper mauris, interdum scelerisque eros ligula at odio. Donec sed ante mattis, luctus neque vel, ultrices diam. Cras ultricies quis felis at interdum. Integer imperdiet quam at tortor semper elementum. Proin ultrices ornare nisi et commodo. Nunc odio massa, pretium quis placerat in, accumsan quis lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed pretium lobortis magna non fermentum. Vestibulum lacinia pharetra libero sed eleifend. Nulla eleifend dapibus mollis. Curabitur eu elit risus. ','0'),(4,'2016-10-24 22:04:10','Calvin','Guevarra','calvin@mail.com','23487687','This is a test message','0'),(5,'2016-10-24 22:04:54','Jessica','Ahn','jessica@mail.com','234234234','This is another test','0'),(6,'2016-10-24 22:05:31','John','Doe','jd@mail.com','234234','asdasdasdasd','0'),(7,'2016-10-24 22:07:26','Jay','Contreras','kay@mail.com','234986','sdfsdfsdf','0'),(8,'2016-10-24 22:08:33','Last','Doe','last@mail.com','23424234','asdazdasdasda\r\nasdasd\r\nas\r\nasd\r\nasdasd','0'),(9,'2016-10-24 22:12:15','asdasdasd','asdasd','asdad@asd.com','232323','asdasdsad','0'),(10,'2016-10-24 22:17:35','New','Client','new@mail.com','243234234','','0'),(11,'2016-10-24 22:20:15','Calvin','Guevarra','calvin@mail.com','1232323','xxxxxxxxxxxxxxxxxxxxxxxx','0'),(12,'2016-10-24 22:25:15','asdasd','asdasd','asdasd@asd.com','23423423','','0'),(13,'2016-10-26 19:28:03','asdasd','asdasd','asdad@mail.com','234234234','asdasdasdasdasdasdasdasda','0'),(14,'2016-10-26 19:28:44','asdasd','asdasd','asd@asd.co','234234','qsdasdasdSADasdasd','0'),(15,'2016-11-24 19:27:19','asdasd','asdasd','calvin@mail.com','234234234','asdasdasdasd','Problem with wheelchair'),(16,'2016-11-24 19:29:28','Jack','Daniels','jd@mail.com','234234234','sdfsdfsdfsf\r\nsdfsvcsdfsv\r\nxcvxcvxc\r\nvxcvxsvsdfsd','Need Help');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-24 19:34:58
