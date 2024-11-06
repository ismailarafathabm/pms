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
-- Table structure for table `pms_mat_items`
--

DROP TABLE IF EXISTS `pms_mat_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_mat_items` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT,
  `itemdescription` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `itemunit` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_mat_items`
--

LOCK TABLES `pms_mat_items` WRITE;
/*!40000 ALTER TABLE `pms_mat_items` DISABLE KEYS */;
INSERT INTO `pms_mat_items` VALUES (1,'Airfoil Louver','sqm'),(2,'Bottom Hinge Windows','pcs'),(4,'Brackets (B.Steel)','pcs'),(5,'Brackets (G.Steel)','pcs'),(6,'Bull Nose','bar'),(7,'Canopy Cladding','sqm'),(8,'Catwalk','sqm'),(9,'Cladding (Curved)','sqm'),(10,'Cladding (Flat)','sqm'),(11,'Curtain Wall (Arched)','sqm'),(12,'Curtain Wall (Flat)','sqm'),(13,'Curtain Wall (w/ Stiffener)','sqm'),(14,'Fixed Partition','sqm'),(15,'Fixed Windows','pcs'),(16,'Fixed Windows (Arched)','pcs'),(17,'Folding Doors','sqm'),(18,'Frameless Items','sqm'),(19,'Glass Balustrade','sqm'),(20,'Hinge Doors (D)','pcs'),(21,'Hinge Doors (S)','pcs'),(22,'Hinge Windows','pcs'),(23,'Louvers','sqm'),(24,'Mesh / Mashrabia','sqm'),(25,'Perforated Sheet','sqm'),(26,'Pivot Windows','pcs'),(27,'Revolving Door','pcs'),(28,'Rockwool','sqm'),(29,'Roll-up Doors','pcs'),(30,'Sandtrap Louver','sqm'),(31,'Sandwich Panel','sqm'),(32,'Shutters','sqm'),(33,'Skylight','sqm'),(34,'Sliding Doors','pcs'),(35,'Sliding Windows','pcs'),(36,'Spider System','sqm'),(37,'SST Angle','lm'),(38,'SST Handrail','lm'),(39,'SST Pipe','lm'),(40,'SST Sheet','sqm'),(41,'SST Tube','lm'),(42,'SST U-Channel','lm'),(43,'Stainless Steel','lm'),(44,'Steel Angle','lm'),(45,'Steel Beam','Nos.'),(46,'Steel Grating','sqm'),(47,'Steel Handrail','lm'),(48,'Steel Pipe','lm'),(49,'Steel Sheet','sqm'),(50,'Steel Tube','lm'),(51,'Steel Tube (Frame)','lm'),(52,'Steel U-Channel','lm'),(53,'Steel Works','sqm'),(54,'Sunshade Louver','lm'),(55,'Swing Doors (D)','pcs'),(56,'Swing Doors (S)','pcs'),(57,'Terracotta','sqm'),(58,'Tilt & Turn Windows','pcs'),(59,'Top Hung Windows','pcs'),(60,'Unitized Cladding Panel','Panel'),(61,'Unitized Glass Panel','Panel'),(62,'Unitized Stone Panel','Panel'),(63,'Z-Louver','sqm'),(64,'Bottom Hung Windows','pcs'),(65,'Cladding','sqm'),(66,'Flashing','pcs'),(67,'Glass','pcs');
/*!40000 ALTER TABLE `pms_mat_items` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:29:21
