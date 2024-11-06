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
-- Table structure for table `cuttinglist_qty_type`
--

DROP TABLE IF EXISTS `cuttinglist_qty_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cuttinglist_qty_type` (
  `qty_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `qty_type` longtext COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`qty_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuttinglist_qty_type`
--

LOCK TABLES `cuttinglist_qty_type` WRITE;
/*!40000 ALTER TABLE `cuttinglist_qty_type` DISABLE KEYS */;
INSERT INTO `cuttinglist_qty_type` VALUES (1,'SDc5Zis4KzV0ZENzd0Z1WG84aG9NUT09'),(2,'ZWE3UWh1SFVaWm5OV0RtelVPQVFuQT09'),(3,'N21oQTFjVytIQWtOSU5EY1FpbHFjQT09'),(4,'UmFKeE5sTkFPeTZPTkduVUtPWVE1dz09'),(5,'eGJRdXBZc1krbFJZZStMWnJJUUN1Zz09'),(6,'OTAySVlyS29ERis5dkV3U0w2Ry9wQT09'),(7,'bkxTaEpuRzNVeUJ1Smp1RDNHSGY2Vy9ldUZmalBUcEFrZ2dPTWEzVXFJQT0='),(8,'dWZvQm9zZGxWSFdhUUUyOEZEVk1Ldz09'),(9,'eDVyM0djR1ROblMybFhJWVQreDBhZz09'),(10,'NVlLMG1QdFVGckFlWDJQcm42QTUwUT09'),(11,'VW1ITjBCdEJmWlhaektSYnpsRGwvdz09'),(12,'QUFDc1dzaTZXeitkUXp1RS8ycHQ1UT09'),(13,'bHFLSG5EYkVySHp1Q25ISHBHdlJaZz09');
/*!40000 ALTER TABLE `cuttinglist_qty_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:29:16
