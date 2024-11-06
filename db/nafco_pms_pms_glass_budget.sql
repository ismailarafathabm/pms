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
-- Table structure for table `pms_glass_budget`
--

DROP TABLE IF EXISTS `pms_glass_budget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_glass_budget` (
  `gbudgetid` int(11) NOT NULL AUTO_INCREMENT,
  `gbudgettype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gbudgetglasstype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gbudgetspc` varchar(450) COLLATE utf8mb4_bin NOT NULL,
  `gbudgtickness` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gbudgetarea` double NOT NULL,
  `gbudgetbprice` double NOT NULL,
  `gbudgetbtotal` double NOT NULL,
  `gbudgcustomval` double NOT NULL,
  `gbudgettotal` double NOT NULL,
  `pricediff` double NOT NULL,
  `finalamount` double NOT NULL,
  `cby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `eby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `cdate` datetime NOT NULL,
  `edate` datetime NOT NULL,
  `pupdate` date NOT NULL,
  `gbproject` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gbprojectname` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gbsupplier` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `sbsupplierlocation` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `estimationflag` varchar(1) COLLATE utf8mb4_bin NOT NULL,
  `procurementflag` varchar(1) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`gbudgetid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_glass_budget`
--

LOCK TABLES `pms_glass_budget` WRITE;
/*!40000 ALTER TABLE `pms_glass_budget` DISABLE KEYS */;
INSERT INTO `pms_glass_budget` VALUES (1,'contract','working','8mm hp n40 plus on clear tempered head soak tested / 18mm Air Spacer w/structuctural silicone / 13.52 mm clear laminated tempered Heat soak tested','6+6+6',3829.62,380,1455256,0,0,380,1455256,'demo','demo','2023-04-27 13:56:28','2023-04-27 13:56:28','2023-04-27','UlZsVm1kd3hRR2h4Y2FvQmFQMHRMQT09','Riyadh Metro Project Station 1B3/2B2','Gulf Glass Industries','Sharjah','O','0'),(2,'contract','laminated tempered heat soak','8mm HP N40 Plus on clear tempered Heat Soak Tested / 18mm Air Spacer w/structuctural Silicone / 17.52 mm Clear Laminate Tempered Heat Soak Tested','8+18+17.52',128.39,420,53924,0,0,420,53924,'demo','demo','2023-04-27 13:59:10','2023-04-27 13:59:10','2023-04-27','UlZsVm1kd3hRR2h4Y2FvQmFQMHRMQT09','Riyadh Metro Project Station 1B3/2B2','Gulf Glass Industries','Sharjah','O','0'),(3,'contract','laminated tempered heat soak','8mm HP N40 Plus on clear tempered Heat Soak Tested / 18mm Air Spacer w/structuctural Silicone / 17.52 mm Clear Laminate Tempered Heat Soak Tested','8+18+17.52',65885,401,26419885,0,0,401,26419885,'demo','demo','2023-04-27 16:38:09','2023-04-27 16:38:09','2023-04-14','UlZsVm1kd3hRR2h4Y2FvQmFQMHRMQT09','Riyadh Metro Project Station 1B3/2B2','American Glass','America','O','0');
/*!40000 ALTER TABLE `pms_glass_budget` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:29:09
