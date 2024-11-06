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
-- Table structure for table `pms_glass_order`
--

DROP TABLE IF EXISTS `pms_glass_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_glass_order` (
  `goid` int(11) NOT NULL AUTO_INCREMENT,
  `gono` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `godoneby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `goreldate` date NOT NULL,
  `gorcdate` date NOT NULL,
  `gosupplier` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `goglasstype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `goglassspc` longtext COLLATE utf8mb4_bin NOT NULL,
  `goglassthickness` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gomarkinglocation` longtext COLLATE utf8mb4_bin NOT NULL,
  `goglassqty` int(11) NOT NULL,
  `goremark` longtext COLLATE utf8mb4_bin NOT NULL,
  `goby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `goedit` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gocdate` datetime NOT NULL,
  `goeditdate` datetime NOT NULL,
  `godate` date NOT NULL,
  `gotype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `goproject` int(11) NOT NULL,
  `gostatus` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`goid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_glass_order`
--

LOCK TABLES `pms_glass_order` WRITE;
/*!40000 ALTER TABLE `pms_glass_order` DISABLE KEYS */;
INSERT INTO `pms_glass_order` VALUES (1,'23232','demo','2023-01-01','2023-04-18','Gulf Glass Industries','aluminum sheet','Test','8+3+1','aa',10,'for Test','demo','demo','2023-04-29 09:54:29','2023-04-29 11:19:39','2023-04-29','go',241,'ordered');
/*!40000 ALTER TABLE `pms_glass_order` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:29:05
