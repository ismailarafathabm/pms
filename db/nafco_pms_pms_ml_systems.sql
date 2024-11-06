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
-- Table structure for table `pms_ml_systems`
--

DROP TABLE IF EXISTS `pms_ml_systems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_ml_systems` (
  `systemid` int(11) NOT NULL AUTO_INCREMENT,
  `systemname` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `systemprocurement` double NOT NULL,
  `systemesimation` double NOT NULL,
  `totaldays` double NOT NULL,
  `systemnamedisplay` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`systemid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_ml_systems`
--

LOCK TABLES `pms_ml_systems` WRITE;
/*!40000 ALTER TABLE `pms_ml_systems` DISABLE KEYS */;
INSERT INTO `pms_ml_systems` VALUES (1,'new systems',20,50,70,'new systems'),(2,'new system 2',30,50,80,'new system 2'),(3,'new system new',20,50,70,'new system new'),(4,'test 1',20,20,40,'test 1'),(5,'test new workin',12,10,22,'Test New workin'),(6,'test3',12,33,45,'test3'),(7,'test new work',50,20,70,'Test New Work'),(8,'for test',30,20,50,'for test'),(9,'test for loading',30,50,80,'Test for Loading'),(10,'new test',20,90,110,'New Test');
/*!40000 ALTER TABLE `pms_ml_systems` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:28:46
