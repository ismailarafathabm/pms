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
-- Table structure for table `pms_po_budget`
--

DROP TABLE IF EXISTS `pms_po_budget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_po_budget` (
  `pobno` int(11) NOT NULL AUTO_INCREMENT,
  `pobdate` date NOT NULL,
  `pobprefno` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pobporefno` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pobtype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pobtotbudget` double NOT NULL,
  `pobbmprice` double NOT NULL,
  `pobprvalue` double NOT NULL,
  `pobcvalue` double NOT NULL,
  `pobavailablebudget` double NOT NULL,
  `pobcby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pobeby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pobcdate` datetime NOT NULL,
  `pobedate` datetime NOT NULL,
  `pobstatus` int(11) NOT NULL,
  `pobqty` double NOT NULL,
  `pobproject` int(11) NOT NULL,
  PRIMARY KEY (`pobno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_po_budget`
--

LOCK TABLES `pms_po_budget` WRITE;
/*!40000 ALTER TABLE `pms_po_budget` DISABLE KEYS */;
/*!40000 ALTER TABLE `pms_po_budget` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:29:11