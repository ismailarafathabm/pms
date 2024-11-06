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
-- Table structure for table `bom_systems`
--

DROP TABLE IF EXISTS `bom_systems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bom_systems` (
  `systemid` int(11) NOT NULL AUTO_INCREMENT,
  `systemname` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`systemid`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bom_systems`
--

LOCK TABLES `bom_systems` WRITE;
/*!40000 ALTER TABLE `bom_systems` DISABLE KEYS */;
INSERT INTO `bom_systems` VALUES (1,'-'),(2,'100mm Thermal Break Hinge Sys.'),(3,'3mm Hinge Door Sys.'),(4,'44mm Series Hinge Door Sys.'),(5,'44mm Series Swing Door Sys.'),(6,'Accessories - Balustrade'),(7,'Accessories - Blade Sys.'),(8,'Accessories - Clading Sys.'),(9,'Accessories - Curtain wall Sys.'),(10,'Accessories - Cutting Sys.'),(11,'Accessories - Door Window Sys.'),(12,'Accessories - Drill Bit'),(13,'Accessories - Eft Euro Facade Sys.'),(14,'Accessories - Frameless Sys.'),(15,'Accessories - Hinge Door Sys.'),(16,'Accessories - Hinge Window Sys.'),(17,'Accessories - Logo Plastic'),(18,'Accessories - Misc.'),(19,'Accessories - Rockwool'),(20,'Accessories - Schuco'),(21,'Accessories - Schuco ADS 65 HD'),(22,'Accessories - Schuco ASS 50'),(23,'Accessories - Schuco AWS 102'),(24,'Accessories - Schuco AWS 114'),(25,'Accessories - Schuco AWS 65'),(26,'Accessories - Schuco Curtain Wall'),(27,'Accessories - Schuco Curtain wall'),(28,'Accessories - Schuco UCC65 SG'),(29,'Accessories - Screen Sys.'),(30,'Accessories - Screw Driver'),(31,'Accessories - Screws Sys.'),(32,'Accessories - Shutter Sys.'),(33,'Accessories - Silicon Sys.'),(34,'Accessories - Skylight Sys.'),(35,'Accessories - Sliding Sys.'),(36,'Accessories - Spiders System'),(37,'Accessories - Structural C. W. Sys.'),(38,'Accessories - Swing Door Sys.'),(39,'Accessories - Tape Sys.'),(40,'Accessories - Tools'),(41,'Accessories - Welding Sys.'),(42,'Accessories -Balustrade'),(43,'Al Taiseer Sys.'),(44,'Aluminum Bracket'),(45,'Aluminum Sheets'),(46,'Angle Sys.'),(47,'As-200 Curtain Wall'),(48,'Chemicals'),(49,'Cladding Profiles Sys.'),(50,'Clading Sys.'),(51,'Crimping Angle Sys.'),(52,'Door Sys.'),(53,'Double Color T-Break Sliding Sys.'),(54,'EFP - Openable'),(55,'EFP 55 SSG TB Window Frame'),(56,'EFP 55mm Hinge Door System T.B'),(57,'EFP Door & window System'),(58,'EFP Reglazable C.Wall In'),(59,'EFP-KKIA System'),(60,'EFT Euro Facade System'),(61,'EFT. Unitized System'),(62,'Equipe Sys.'),(63,'Flat Bar Sys.'),(64,'GUTMAN SYSTEM'),(65,'Galvanized Sheet'),(66,'Glass Connector'),(67,'Gutman Auto Sliding Door'),(68,'Gutmann Side Hung Window System'),(69,'Gutmann Unitize C.W. System'),(70,'Gutmann-Hinge Door System'),(71,'Gutmann-Stick CW System'),(72,'HF 40/L-43 Hinge & Fix Window Sys.'),(73,'HF 40/L-44 Hinge & Fix Window Sys.'),(74,'HF I-55 Thermal Break Sys.'),(75,'HF IC - 65 Concealed Hinge Sys.'),(76,'HF ID-100 Thermal Break Sys.'),(77,'HF ID-55 Thermal Break Sys.'),(78,'HF-100/L-55 Hinge & Fix Window Sys.'),(79,'HF-50/L-55 Hinge Door Sys.'),(80,'HF-55/L-55 Hinge & Fix Window Sys.'),(81,'HF-55/L-55 Hinge & Fix Window sys.'),(82,'Hand tools'),(83,'Handrail Sys.'),(84,'Hilton Skylight Sys.'),(85,'Hinge Sys.'),(86,'Hinge Window Sys.'),(87,'Kholood Project Sys.'),(88,'Louver Sys.'),(89,'Marriot Hinge & fix System.'),(90,'Misc. sys.'),(91,'Munajem Curtain Wall Sys.'),(92,'Paint'),(93,'Pipe'),(94,'Rockwool'),(95,'Rubbers Sliding'),(96,'S2-100 Sliding Sys. (Yanpet)'),(97,'SCHUCO ASE 70 PD.ME'),(98,'SCHUCO FWS50'),(99,'SG-0 Structural Glazing C.W Sys.'),(100,'SG-02 Struuctural Glazing C.W Sys.'),(101,'SI-100 Thermal Break Sliding System'),(102,'SI-107 Thermal Break Sliding System'),(103,'SI-120 Thermal Break Sliding Sys'),(104,'SK-60 Profile For Skylight'),(105,'SMART CW SYSTEM'),(106,'SWD F 100 Swing Door Sys.'),(107,'Safety'),(108,'Sandwich Panel'),(109,'Saraya Sliding (Alupco Sys.)'),(110,'Sceco Ghazian Sys.'),(111,'Schuco ADS 50 NI'),(112,'Schuco ADS 65 HD'),(113,'Schuco ASS 48 NI'),(114,'Schuco ASS 50'),(115,'Schuco ASS32 SC'),(116,'Schuco AWS 114'),(117,'Schuco AWS 50'),(118,'Schuco AWS 50 NI'),(119,'Schuco AWS 65'),(120,'Schuco FW 60+SG'),(121,'Schuco System AWS 102'),(122,'Schuco System FW50+'),(123,'Schuco UCC65 SG (Modified)'),(124,'Schuco Unitized Sys.'),(125,'Shutter'),(126,'Shutter Sys.'),(127,'Sl-100 Thermak Break Sliding System'),(128,'Sliding System.'),(129,'Stainless Steel'),(130,'Stainless Steel Sheet'),(131,'Standard Curtain Wall Sys.'),(132,'Steel'),(133,'Steel Pipe'),(134,'Steel Plate'),(135,'Structural - Old'),(136,'Structural Galazing C.W Sys.'),(137,'Suhaily STC SG-0 Structurl C.W Sys.'),(138,'Swing Door Sys.'),(139,'Tarakota System'),(140,'Technal Sys.'),(141,'Tools'),(142,'Tube Sys.'),(143,'UnKnown'),(144,'Vistawall Curtain Wall System'),(145,'Vistawall System Elegance Tower'),(146,'Vistawall-Hinges System'),(147,'Vistawall-Sliding Door & window sys'),(148,'Without Sys.'),(149,'accessories - balustrade');
/*!40000 ALTER TABLE `bom_systems` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:28:49
