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
-- Table structure for table `pms_po`
--

DROP TABLE IF EXISTS `pms_po`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_po` (
  `poid` int(11) NOT NULL AUTO_INCREMENT,
  `podate` date NOT NULL,
  `porefno` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `itemtype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `posupplier` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `posupplieraddress` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `poattenby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `podescription` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `poqty` double NOT NULL,
  `povalue` double NOT NULL,
  `pounitprice` double NOT NULL,
  `ponotes` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `popaymentterms` longtext COLLATE utf8mb4_bin NOT NULL,
  `podeliveryterms` longtext COLLATE utf8mb4_bin NOT NULL,
  `poproject` int(11) NOT NULL,
  `pocby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `poeby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pocdate` datetime NOT NULL,
  `poedate` datetime NOT NULL,
  `poiscurrent` int(11) NOT NULL,
  `poarea` double NOT NULL,
  `poweight` double NOT NULL,
  PRIMARY KEY (`poid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_po`
--

LOCK TABLES `pms_po` WRITE;
/*!40000 ALTER TABLE `pms_po` DISABLE KEYS */;
INSERT INTO `pms_po` VALUES (1,'2023-05-08','001','Aluminum','Form Sub Menu','Working Sub Menu','Manager','Need Aluminum',50,641000,250,'-','-','-',320,'demo','demo','2023-05-08 09:09:33','2023-05-08 09:09:33',1,2564,0),(2,'2023-05-08','002','Aluminum','Test2 Supplier','Test2 Country','test','description',5,163200,120,'-','-','-',320,'sam','sam','2023-05-08 09:35:20','2023-05-08 09:35:20',1,1360,0),(3,'2023-05-09','0056','Accessories','Test New Supplier','Supplier Location','To Sales manager','Kindlay Arranage Items',1,812346,812346,'-','-','-',320,'demo','demo','2023-05-09 09:53:58','2023-05-09 09:53:58',1,1,0),(4,'2023-05-10','001005','Aluminum','Test New Supplier','Supplier Location','ABC','XYZ',45,600,20,'-','-','-',320,'demo','demo','2023-05-10 11:52:28','2023-05-10 11:52:28',1,3000,450);
/*!40000 ALTER TABLE `pms_po` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:28:59
