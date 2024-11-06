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
-- Table structure for table `bom_partfunction`
--

DROP TABLE IF EXISTS `bom_partfunction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bom_partfunction` (
  `partfunction_id` int(11) NOT NULL AUTO_INCREMENT,
  `partfunction_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`partfunction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=347 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bom_partfunction`
--

LOCK TABLES `bom_partfunction` WRITE;
/*!40000 ALTER TABLE `bom_partfunction` DISABLE KEYS */;
INSERT INTO `bom_partfunction` VALUES (1,'-'),(2,'2.503'),(3,'ARM'),(4,'Actuator'),(5,'Adaption'),(6,'Adaptor'),(7,'Allenkey'),(8,'Anchor'),(9,'Angle'),(10,'Anti Device'),(11,'Architrave'),(12,'Auto. Sliding Door'),(13,'Auto. revolving Door'),(14,'Automatic Door'),(15,'BLOWER'),(16,'Backing Rod'),(17,'Barrier Block'),(18,'Base'),(19,'Battery Charger'),(20,'Battery Drill'),(21,'Battery Pack'),(22,'Bead'),(23,'Beam'),(24,'Bearing'),(25,'Bit'),(26,'Blade'),(27,'Bolt'),(28,'Bonding Edge'),(29,'Bonding Profile'),(30,'Bottom Frame'),(31,'Bottom Plug'),(32,'Bottom Rail'),(33,'Bracket'),(34,'Brush Holder'),(35,'Brush Seal'),(36,'C-Carrier Channel'),(37,'C-Channel'),(38,'C-Frame'),(39,'C-Handle'),(40,'CW Attachment'),(41,'Cable Drum'),(42,'Cap'),(43,'Carpenter Angle'),(44,'Catch'),(45,'Central Guide'),(46,'Chemical'),(47,'Chevron'),(48,'Circular Profile'),(49,'Cladding'),(50,'Clamp'),(51,'Cleaner'),(52,'Cleat'),(53,'Clip'),(54,'Cloth'),(55,'Connection Piece'),(56,'Connector'),(57,'Coring Tool'),(58,'Corner'),(59,'Corner Cap'),(60,'Corner Cleat'),(61,'Corner Molding'),(62,'Corner Profile'),(63,'Counter Plate'),(64,'Counter Weight'),(65,'Cover'),(66,'Cremone Profile'),(67,'Crimping Angle'),(68,'Cutting Disc'),(69,'Cylinder'),(70,'D - Handle'),(71,'DRAIN CAP'),(72,'Deflector'),(73,'Disc'),(74,'Door Adaption'),(75,'Door Brush'),(76,'Door Closer'),(77,'Door Frame'),(78,'Door Latch'),(79,'Door Leaf Rest'),(80,'Door Leaf-Open In'),(81,'Dorma Accessories'),(82,'Double Vent'),(83,'Drain Pain'),(84,'Drainage Divertor M.'),(85,'Drill'),(86,'Drill Bit'),(87,'Dummy Leaf'),(88,'Dust Plug'),(89,'Edge'),(90,'Elbow'),(91,'End Cup'),(92,'End Plate'),(93,'End Slat'),(94,'Expansion Joint'),(95,'Expansion Profile'),(96,'Facing Profile'),(97,'Fanlight Opener'),(98,'Finger Catch'),(99,'Firestop'),(100,'Fischer'),(101,'Fixing Kit'),(102,'Fixing Plate'),(103,'Flashing'),(104,'Flat Bar'),(105,'Flush Bolt'),(106,'Flyscreen Plug'),(107,'Foam'),(108,'Frame'),(109,'Frame & Leaf'),(110,'Frame Jamb'),(111,'Frame Sill'),(112,'Frame-In'),(113,'Frame-Out'),(114,'Friction Hinges'),(115,'Gap Profile'),(116,'Gasket'),(117,'Glass Connector'),(118,'Glass Support'),(119,'Glass Trim'),(120,'Glazing Block'),(121,'Glazing Clip'),(122,'Glazing Insert'),(123,'Glazing Support'),(124,'Glazing Wedge'),(125,'Grinder'),(126,'Grip Bar'),(127,'Hacksaw Blade'),(128,'Hacksaw Frame'),(129,'Half Frame'),(130,'Hammer'),(131,'Hand Gloves'),(132,'Handle'),(133,'Handle Cover'),(134,'Handle Fixing Acces.'),(135,'Handrail'),(136,'Head'),(137,'Helmet'),(138,'Hexagonal Blot'),(139,'Hinge'),(140,'Hinge Jamb'),(141,'Hinges Kit'),(142,'Hook IT Holder'),(143,'I Beam'),(144,'Inner Profile'),(145,'Insert Profile'),(146,'Insert for Door Rail'),(147,'Insulation'),(148,'Insulation Plug'),(149,'Insulator'),(150,'Interlock'),(151,'Isolator'),(152,'Jigsaw'),(153,'Joint Connector'),(154,'Joint Cover'),(155,'Joint Seal'),(156,'Keeper'),(157,'Kinlong Accessories'),(158,'Kit'),(159,'Laser Meter'),(160,'Leaf'),(161,'Leaf Head & Sill'),(162,'Lever Sys.'),(163,'Limiter'),(164,'Load Cut-Off'),(165,'Lock'),(166,'Lock Accessories'),(167,'Locking Bar'),(168,'Locking Piece'),(169,'Logo Plastic'),(170,'Louver'),(171,'Lower PVC Sheild'),(172,'Mask'),(173,'Maska'),(174,'Mechanism T & T'),(175,'Meeting Rail'),(176,'Meeting Rail Clip'),(177,'Meter Tape'),(178,'Mid Rail'),(179,'Mitre Cutter'),(180,'Motor'),(181,'Moulded'),(182,'Mullion'),(183,'Mullion drainage'),(184,'Mullion/Transom'),(185,'Nail'),(186,'Nose Profile'),(187,'Openable Leaf'),(188,'Outer Frame'),(189,'Outer Profile'),(190,'PVC PROFILE'),(191,'Paint'),(192,'Panic device'),(193,'Pile'),(194,'Pin'),(195,'Pipe'),(196,'Pivot'),(197,'Pivot Hinges'),(198,'Pivot Machine'),(199,'Plastic End Plate'),(200,'Plate'),(201,'Plier'),(202,'Plinth'),(203,'Plug'),(204,'Pneumatic Screw Dril'),(205,'Post'),(206,'President Hinge'),(207,'Pressing Plate'),(208,'Pressure Plate'),(209,'Primer'),(210,'Profile'),(211,'Push Lock'),(212,'Rail'),(213,'Rebate'),(214,'Reducer'),(215,'Reinforcment Mullion'),(216,'Remote'),(217,'Retain Ctch Side'),(218,'Riveter'),(219,'Rockwool'),(220,'Rod Driver'),(221,'Rod Support'),(222,'Roller'),(223,'Roller Rail'),(224,'Rotation Buttom'),(225,'Round Bar'),(226,'Routel'),(227,'Rubber Gasket'),(228,'STOPPER'),(229,'Safety'),(230,'Sanding Pad'),(231,'Sash Bar'),(232,'Saw'),(233,'Schuco Accessories'),(234,'Screen'),(235,'Screw'),(236,'Screw Bit'),(237,'Screw Driver'),(238,'Seal'),(239,'Setting Block'),(240,'Sheet'),(241,'Shim pad'),(242,'Shoes'),(243,'Shoot Bolt'),(244,'Shutter Handle'),(245,'Shutter Motor'),(246,'Shutter Motor Tube'),(247,'Silicon'),(248,'Silicon Gun'),(249,'Sill'),(250,'Sinar'),(251,'Single Glass Leaf'),(252,'Single Leaf'),(253,'Skirting'),(254,'Skirting Profile'),(255,'Slat'),(256,'Sleeve'),(257,'Slider Kit'),(258,'Sliding Laef'),(259,'Sliding Mullion'),(260,'Sliding Support'),(261,'Socket'),(262,'Solid Bar'),(263,'Spacer'),(264,'Spandrel'),(265,'Spanner'),(266,'Spiders Legs'),(267,'Spigot'),(268,'Spindle'),(269,'Splice Bar'),(270,'Spring Pin'),(271,'Stand'),(272,'Steel Track'),(273,'Stile'),(274,'Striking Plates'),(275,'Structural Profile'),(276,'Sub - Cover'),(277,'Sun Shade'),(278,'Support Block'),(279,'Swing Door Machine'),(280,'Switch'),(281,'T Bar Guide'),(282,'T Lock'),(283,'T-Cleat'),(284,'T-Verbinder'),(285,'T.Break Insulator'),(286,'Tape'),(287,'Tarakota System'),(288,'Terminal Rod'),(289,'Thermal Break'),(290,'Thread'),(291,'Threaded Rod'),(292,'Threshold'),(293,'Thumb Pull'),(294,'Tilt & Turn Handle'),(295,'Tilt & Turn Hinges'),(296,'Tilt & Turn Set'),(297,'Tool Box'),(298,'Tools Spareparts'),(299,'Top & Bottom Strap'),(300,'Top Hung Hinge'),(301,'Track'),(302,'Transom'),(303,'Tube'),(304,'U-Guide'),(305,'U-Guide Chanel'),(306,'Upper PVC Sheild'),(307,'Vent'),(308,'Wall Panel'),(309,'Washer'),(310,'Water Plug'),(311,'Weather Bar'),(312,'Weatherseal'),(313,'Weatherstrip'),(314,'Wedge'),(315,'Welding Glass'),(316,'Welding Rod'),(317,'Wheel'),(318,'Wing'),(319,'Wiper'),(320,'Wipes'),(321,'Wrench'),(322,'base'),(323,'block'),(324,'cartriage'),(325,'central Stile'),(326,'coring tools'),(327,'corner angle'),(328,'coupling profile'),(329,'cover'),(330,'filling'),(331,'keeper'),(332,'mesh'),(333,'nut'),(334,'nuts'),(335,'nuts & washer'),(336,'omega'),(337,'screw'),(338,'sheet'),(339,'shoes'),(340,'strip'),(341,'thermal break'),(342,'top Set'),(343,'upright section'),(344,'wall Cladding'),(345,'water divertor'),(346,'wing');
/*!40000 ALTER TABLE `bom_partfunction` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:29:16
