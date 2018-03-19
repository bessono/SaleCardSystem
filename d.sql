-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: cardsystem
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `card_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `percent` int(11) DEFAULT '0',
  `bonuses` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (10,'Ð‘ÐµÑÑÐ¾Ð½Ð¾Ð² ÐÐ»ÐµÐºÑÐ°Ð½Ð´Ñ€','123','bessono@mail.ru','+74773838',NULL,0,0),(11,'ÐÐ¾Ð²Ð¾ÑÑ‘Ð»Ð¾Ð² ÐÐ•','1234','','9883773383',NULL,0,12);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_report`
--

DROP TABLE IF EXISTS `log_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `summ` float DEFAULT NULL,
  `operation` varchar(255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `date_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_report`
--

LOCK TABLES `log_report` WRITE;
/*!40000 ALTER TABLE `log_report` DISABLE KEYS */;
INSERT INTO `log_report` VALUES (1,0,'ÐŸÐ¾ÐºÑƒÐ¿ÐºÐ° Ñ ÑƒÐ²ÐµÐ»Ð¸Ñ‡ÐµÐ½Ð¸ÐµÐ¼ Ð±Ð¾Ð½ÑƒÑÐ°',10,1521363929),(2,1000,'ÐŸÐ¾ÐºÑƒÐ¿ÐºÐ° Ñ ÑƒÐ²ÐµÐ»Ð¸Ñ‡ÐµÐ½Ð¸ÐµÐ¼ Ð±Ð¾Ð½ÑƒÑÐ°',10,1521363948),(3,1000,'ÐŸÐ¾ÐºÑƒÐ¿ÐºÐ° Ñ ÑƒÐ²ÐµÐ»Ð¸Ñ‡ÐµÐ½Ð¸ÐµÐ¼ Ð±Ð¾Ð½ÑƒÑÐ°',10,1521364250),(4,600,'ÐŸÐ¾ÐºÑƒÐ¿ÐºÐ° Ñ ÑƒÐ²ÐµÐ»Ð¸Ñ‡ÐµÐ½Ð¸ÐµÐ¼ Ð±Ð¾Ð½ÑƒÑÐ°',10,1521442022),(5,0,'ÐÐºÑ‚Ð¸Ð²Ð¸Ð·Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð½Ð° ÐºÐ°Ñ€Ñ‚Ð° 1234',NULL,1521446885),(6,600,'ÐŸÐ¾ÐºÑƒÐ¿ÐºÐ° Ñ ÑƒÐ²ÐµÐ»Ð¸Ñ‡ÐµÐ½Ð¸ÐµÐ¼ Ð±Ð¾Ð½ÑƒÑÐ°',11,1521446908),(7,1,'ÐŸÐ¾ÐºÑƒÐ¿ÐºÐ° Ñ Ð¸ÑÐ¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ð½Ð¸ÐµÐ¼ 191.14 Ð±Ð¾Ð½ÑƒÑÐ¾Ð²: 191.14-1=0',NULL,1521449067),(8,90,'ÐŸÐ¾ÐºÑƒÐ¿ÐºÐ° Ñ Ð¸ÑÐ¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ð½Ð¸ÐµÐ¼ 190.14 Ð±Ð¾Ð½ÑƒÑÐ¾Ð²: 190.14-90=0',10,1521449180),(9,50,'ÐŸÐ¾ÐºÑƒÐ¿ÐºÐ° Ñ Ð¸ÑÐ¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ð½Ð¸ÐµÐ¼ 100.14 Ð±Ð¾Ð½ÑƒÑÐ¾Ð²: 100.14-50=0(Ðº Ð¾Ð¿Ð»Ð°Ñ‚Ðµ)',10,1521449241),(10,1000,'ÐŸÐ¾ÐºÑƒÐ¿ÐºÐ° Ñ Ð¸ÑÐ¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ð½Ð¸ÐµÐ¼ 50.14 Ð±Ð¾Ð½ÑƒÑÐ¾Ð²: 50.14-1000=949.86',10,1521449265),(11,0,'ÐŸÐ¾ÐºÑƒÐ¿ÐºÐ° Ñ Ð¸ÑÐ¿Ð¾Ð»ÑŒÐ·Ð¾Ð²Ð°Ð½Ð¸ÐµÐ¼ 0 Ð±Ð¾Ð½ÑƒÑÐ¾Ð²: 0-0=0(Ðº Ð¾Ð¿Ð»Ð°Ñ‚Ðµ)',0,1521449351);
/*!40000 ALTER TABLE `log_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pins`
--

DROP TABLE IF EXISTS `pins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pins` (
  `pin` varchar(4) DEFAULT NULL,
  `level` enum('admin','manager') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pins`
--

LOCK TABLES `pins` WRITE;
/*!40000 ALTER TABLE `pins` DISABLE KEYS */;
INSERT INTO `pins` VALUES ('0000','admin'),('1111','manager');
/*!40000 ALTER TABLE `pins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `bonus_percent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (2);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-19 11:57:30
