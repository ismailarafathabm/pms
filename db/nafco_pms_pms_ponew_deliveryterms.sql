-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: 172.0.0.1    Database: nafco_pms
-- ------------------------------------------------------
-- Server version	5.6.12-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pms_ponew_deliveryterms`
--

DROP TABLE IF EXISTS `pms_ponew_deliveryterms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_ponew_deliveryterms` (
  `ponewdtid` int(11) NOT NULL AUTO_INCREMENT,
  `ponewdtdescription` longtext COLLATE utf8mb4_bin NOT NULL,
  `ponewdtproject` int(11) NOT NULL,
  `ponewid` int(11) NOT NULL,
  `ponewrefno` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`ponewdtid`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_ponew_deliveryterms`
--

LOCK TABLES `pms_ponew_deliveryterms` WRITE;
/*!40000 ALTER TABLE `pms_ponew_deliveryterms` DISABLE KEYS */;
INSERT INTO `pms_ponew_deliveryterms` VALUES (1,'-',23,1,'0683/23'),(2,'-',425,2,'52914'),(3,'-',413,3,'52971'),(4,'-',10,4,'06-0652-23'),(5,'-',419,5,'11-925-22'),(6,'-',10,6,'06-0064-23'),(7,'-',148,7,'06-700-23'),(8,'-',148,8,'06-0686-23'),(9,'-',419,9,'03-0334-23'),(10,'-',75,10,'06-0683-23'),(11,'-',195,11,'01-0003-23'),(12,'-',195,12,'01-0004-23'),(13,'-',195,13,'01-0002-23'),(14,'-',195,14,'01-0005-23'),(15,'-',439,15,'03-0339-23'),(16,'-',439,16,'03-0289-23'),(17,'-',439,17,'03-0284-23'),(18,'-',439,18,'03-0338-23'),(19,'-',439,19,'03-0337-23'),(20,'-',439,20,'03-0291-23'),(21,'-',439,21,'03-0342-23'),(22,'-',439,22,'03-0294-23'),(23,'-',439,23,'04-0435-23'),(24,'-',439,24,'05-0535-23'),(25,'-',439,25,'05-0597-23'),(26,'-',439,26,'05-0599-23'),(27,'-',439,27,'05-0602-23'),(28,'-',439,28,'05-0598-23'),(29,'-',439,29,'05-0596-234'),(30,'-',439,30,'05-0533-23'),(31,'-',439,31,'05-0532-23'),(32,'-',439,32,'05-534-23'),(33,'-',439,33,'06-0641-23'),(34,'-',439,34,'05-0607-23'),(35,'-',439,35,'05-0536-23'),(36,'-',439,36,'05-0547-23'),(37,'-',439,37,'05-0603-23'),(38,'-',439,38,'05-0601-23'),(39,'-',439,39,'05-0600-23'),(40,'-',439,40,'05-0629-23'),(41,'-',439,41,'05-0608-23'),(42,'-',439,42,'05-0628-23'),(43,'-',439,43,'05-0626-23'),(44,'-',439,44,'05-0610-23'),(45,'-',439,45,'05-0609-23'),(46,'-',439,46,'05-0623-23'),(47,'-',439,47,'05-0627-23'),(48,'-',439,48,'06-0660-23'),(49,'-',439,49,'06-0659-23'),(50,'-',439,50,'05-625-23'),(51,'-',439,51,'06-0661-23'),(52,'-',439,52,'06-0662-23'),(53,'-',439,53,'06-0732-23'),(54,'-',439,54,'06-0665-23'),(55,'-',439,55,'06-0663-23'),(56,'-',439,56,'06-0664-23'),(57,'-',439,57,'05-0585-23'),(58,'-',439,58,'05-0584-23'),(59,'-',439,59,'05-0606-23'),(60,'-',439,60,'05-0564-23');
/*!40000 ALTER TABLE `pms_ponew_deliveryterms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:29:20
