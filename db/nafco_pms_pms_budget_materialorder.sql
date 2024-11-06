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
-- Table structure for table `pms_budget_materialorder`
--

DROP TABLE IF EXISTS `pms_budget_materialorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_budget_materialorder` (
  `bmoid` int(11) NOT NULL AUTO_INCREMENT,
  `bmodate` date NOT NULL,
  `bmospplier` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bmotype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bmomtype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bmoqty` double NOT NULL,
  `bmounit` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bmoppunit` double NOT NULL,
  `bmoval` double NOT NULL,
  `bmopqty` double NOT NULL,
  `bmopval` double NOT NULL,
  `bmocby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bmoeby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bmocdate` datetime NOT NULL,
  `bmoedate` datetime NOT NULL,
  `bmorefno` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `bmoproject` int(11) NOT NULL,
  `bmoorefno` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`bmoid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_budget_materialorder`
--

LOCK TABLES `pms_budget_materialorder` WRITE;
/*!40000 ALTER TABLE `pms_budget_materialorder` DISABLE KEYS */;
INSERT INTO `pms_budget_materialorder` VALUES (1,'2023-05-04','Test New Supplier','international order','ALUMINUM',500,'KG',18,9000,0,0,'demo','demo','2023-05-04 10:50:58','2023-05-04 10:50:58','0112',320,'NAF/001'),(2,'2023-05-04','Test New Supplier','local order','ALUMINUM',780,'KG',18,14040,0,9000,'demo','demo','2023-05-04 10:53:32','2023-05-04 10:53:32','002',320,'NAF/002');
/*!40000 ALTER TABLE `pms_budget_materialorder` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:28:37
