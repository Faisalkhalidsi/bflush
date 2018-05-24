-- MySQL dump 10.13  Distrib 5.6.39, for Linux (x86_64)
--
-- Host: localhost    Database: db_collection
-- ------------------------------------------------------
-- Server version	5.6.39

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
-- Table structure for table `nossa_session_db_total`
--

DROP TABLE IF EXISTS `nossa_session_db_total`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nossa_session_db_total` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_total` int(11) DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nossa_session_db_total`
--

LOCK TABLES `nossa_session_db_total` WRITE;
/*!40000 ALTER TABLE `nossa_session_db_total` DISABLE KEYS */;
/*!40000 ALTER TABLE `nossa_session_db_total` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nossa_session_user_total`
--

DROP TABLE IF EXISTS `nossa_session_user_total`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nossa_session_user_total` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_total` int(11) DEFAULT '0',
  `user_total` int(11) DEFAULT '0',
  `waktu` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nossa_session_user_total`
--

LOCK TABLES `nossa_session_user_total` WRITE;
/*!40000 ALTER TABLE `nossa_session_user_total` DISABLE KEYS */;
/*!40000 ALTER TABLE `nossa_session_user_total` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nossa_status_integrasi`
--

DROP TABLE IF EXISTS `nossa_status_integrasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nossa_status_integrasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `integration_type` varchar(100) DEFAULT NULL,
  `queue` int(11) DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nossa_status_integrasi`
--

LOCK TABLES `nossa_status_integrasi` WRITE;
/*!40000 ALTER TABLE `nossa_status_integrasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `nossa_status_integrasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nossa_top_ten_table`
--

DROP TABLE IF EXISTS `nossa_top_ten_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nossa_top_ten_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(50) DEFAULT NULL,
  `rows_total` bigint(20) DEFAULT NULL,
  `last_analyzed` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nossa_top_ten_table`
--

LOCK TABLES `nossa_top_ten_table` WRITE;
/*!40000 ALTER TABLE `nossa_top_ten_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `nossa_top_ten_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nossa_workorder_total`
--

DROP TABLE IF EXISTS `nossa_workorder_total`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nossa_workorder_total` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `workorder_total` int(11) DEFAULT '0',
  `waktu` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nossa_workorder_total`
--

LOCK TABLES `nossa_workorder_total` WRITE;
/*!40000 ALTER TABLE `nossa_workorder_total` DISABLE KEYS */;
/*!40000 ALTER TABLE `nossa_workorder_total` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-09 13:07:52
