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
-- Table structure for table `pms_glass_suppliers`
--

DROP TABLE IF EXISTS `pms_glass_suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_glass_suppliers` (
  `glasssupplierid` int(11) NOT NULL AUTO_INCREMENT,
  `glasssuppliername` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `glasssuppliercountry` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `suppliercontact` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `supplieraddress` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `supplieremail` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `supplierphone` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `supplierfax` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`glasssupplierid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_glass_suppliers`
--

LOCK TABLES `pms_glass_suppliers` WRITE;
/*!40000 ALTER TABLE `pms_glass_suppliers` DISABLE KEYS */;
INSERT INTO `pms_glass_suppliers` VALUES (1,'gulf glass industries','sharjah','','','','',''),(2,'american glass','america','A','-','glass@l.com','123','125554'),(3,'test3','test','','','','',''),(4,'form sub menu','working sub menu','','','','',''),(5,'test new supplier','supplier location','','','','',''),(6,'test2 supplier','test2 country','','','','',''),(7,'testw','test2w','-','-','-','-','-'),(8,'new po test','riyadh','-','-','-','-','-'),(9,'mitwalli steel products co.','saudi','mr. husain manssar','-','-','-','2428480'),(10,'uni glass','-','-','-','-','-','-'),(11,'saudi american glass','riyadh ','SALES MANGER','-','-','-','-'),(12,'al andalus glass','riyadh','SALES','-','-','-','-');
/*!40000 ALTER TABLE `pms_glass_suppliers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:29:08
