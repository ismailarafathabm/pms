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
-- Table structure for table `pms_glass_order_purchase`
--

DROP TABLE IF EXISTS `pms_glass_order_purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_glass_order_purchase` (
  `gopid` int(11) NOT NULL AUTO_INCREMENT,
  `gopno` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gopdate` date NOT NULL,
  `gopproject` int(11) NOT NULL,
  `gopsalesrep` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gopglassdesc` longtext COLLATE utf8mb4_bin NOT NULL,
  `gopglasstype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gopglasstotalarea` double NOT NULL,
  `gopglassqty` int(11) NOT NULL,
  `gopglasspricepersqm` double NOT NULL,
  `gopglasstotalamount` double NOT NULL,
  `gopcby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gopeby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gopcdate` datetime NOT NULL,
  `gopedate` datetime NOT NULL,
  `gopbudgetid` int(11) NOT NULL,
  PRIMARY KEY (`gopid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_glass_order_purchase`
--

LOCK TABLES `pms_glass_order_purchase` WRITE;
/*!40000 ALTER TABLE `pms_glass_order_purchase` DISABLE KEYS */;
INSERT INTO `pms_glass_order_purchase` VALUES (1,'0700/22','2023-04-03',437,'Management','6mm  thk.ke 742 on clear heat strengthened glass / 20mm A.S. / 13.52mm thk clear tempered glass','aluminum sheet',450,2,200,657745,'demo','demo','2023-04-30 00:00:00','2023-04-30 00:00:00',1),(2,'0423/22','2023-04-12',437,'Management','6mm thk. guardian ds steeel gery on clear heat strengthened glass / 20mm a.s/ 13.52mm clear tempered glass see attached drawing','overlap glass',50,1,2,400,'demo','demo','2023-04-30 00:00:00','2023-04-30 00:00:00',2),(3,'0567/22','2023-04-07',437,'Management','6mm thk. guardian ds steeel gery on clear heat strengthened glass / 20mm a.s/ 13.52mm clear tempered glass see attached drawing','overlap glass',55,5,2,2000,'demo','demo','2023-04-30 00:00:00','2023-04-30 00:00:00',2),(4,'452','2023-04-30',437,'Management','6mm HD','double glass',1250,30,156,5000,'sam','sam','2023-04-30 00:00:00','2023-04-30 00:00:00',1);
/*!40000 ALTER TABLE `pms_glass_order_purchase` ENABLE KEYS */;
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
