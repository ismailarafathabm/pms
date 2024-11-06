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
-- Table structure for table `pms_budget_glassorder`
--

DROP TABLE IF EXISTS `pms_budget_glassorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_budget_glassorder` (
  `bgoid` int(11) NOT NULL AUTO_INCREMENT,
  `bgodate` date NOT NULL,
  `bgotype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bgoproject` int(11) NOT NULL,
  `bgogorefno` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bgogoqty` double NOT NULL,
  `bgoval` double NOT NULL,
  `bgocby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bgoeby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bgocdate` datetime NOT NULL,
  `bgoedate` datetime NOT NULL,
  `bgoppsqm` double NOT NULL,
  `suppliername` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bgopsqm` double NOT NULL,
  `bgobsqm` double NOT NULL,
  PRIMARY KEY (`bgoid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_budget_glassorder`
--

LOCK TABLES `pms_budget_glassorder` WRITE;
/*!40000 ALTER TABLE `pms_budget_glassorder` DISABLE KEYS */;
INSERT INTO `pms_budget_glassorder` VALUES (1,'2023-05-13','international order',320,'001',20,600,'demo','demo','2023-05-01 15:02:44','2023-05-01 15:02:44',30,'Gulf Glass Industries',0,0),(2,'2023-05-13','international order',320,'001',20,600,'demo','demo','2023-05-01 15:05:30','2023-05-01 15:05:30',30,'Gulf Glass Industries',0,0),(3,'2023-05-13','international order',320,'001',20,600,'demo','demo','2023-05-01 15:05:54','2023-05-01 15:05:54',30,'Gulf Glass Industries',0,0),(4,'2023-05-01','international order',320,'0012',300,75000,'demo','demo','2023-05-01 16:09:01','2023-05-01 16:09:01',250,'Gulf Glass Industries',60,4758.6709),(5,'2023-05-05','local purchase',320,'3655',600,210000,'demo','demo','2023-05-01 16:10:20','2023-05-01 16:10:20',350,'Gulf Glass Industries',360,4758.6709),(6,'2023-05-19','international order',320,'36550',450,135000,'demo','demo','2023-05-01 16:11:10','2023-05-01 16:11:10',300,'Gulf Glass Industries',960,4758.6709),(7,'2023-05-06','international order',320,'0122',250,5000,'demo','demo','2023-05-01 16:13:08','2023-05-01 16:13:08',20,'Gulf Glass Industries',1410,4758.6709);
/*!40000 ALTER TABLE `pms_budget_glassorder` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:29:19
