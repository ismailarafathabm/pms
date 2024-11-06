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
-- Table structure for table `pms_ogpwmp`
--

DROP TABLE IF EXISTS `pms_ogpwmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_ogpwmp` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pno` longtext COLLATE utf8mb4_bin NOT NULL,
  `pname` longtext COLLATE utf8mb4_bin NOT NULL,
  `plocation` longtext COLLATE utf8mb4_bin NOT NULL,
  `pregion` longtext COLLATE utf8mb4_bin NOT NULL,
  `psigndate` date NOT NULL,
  `pduratioin` longtext COLLATE utf8mb4_bin NOT NULL,
  `expirydate` date NOT NULL,
  `exteneddate` date NOT NULL,
  `reson` longtext COLLATE utf8mb4_bin NOT NULL,
  `cdate` datetime NOT NULL,
  `edate` datetime NOT NULL,
  `cby` longtext COLLATE utf8mb4_bin NOT NULL,
  `eby` longtext COLLATE utf8mb4_bin NOT NULL,
  `mdate` date NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_ogpwmp`
--

LOCK TABLES `pms_ogpwmp` WRITE;
/*!40000 ALTER TABLE `pms_ogpwmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `pms_ogpwmp` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:28:51
