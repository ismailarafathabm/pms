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
-- Table structure for table `bom_finish`
--

DROP TABLE IF EXISTS `bom_finish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bom_finish` (
  `finishid` int(11) NOT NULL AUTO_INCREMENT,
  `finishcolor` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`finishid`)
) ENGINE=InnoDB AUTO_INCREMENT=288 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bom_finish`
--

LOCK TABLES `bom_finish` WRITE;
/*!40000 ALTER TABLE `bom_finish` DISABLE KEYS */;
INSERT INTO `bom_finish` VALUES (1,'-'),(2,'1006824 (Jotun)'),(3,'1016341 Light Grey Mettalic'),(4,'1019435 S.D'),(5,'1019435 S.D.Jotun'),(6,'1303G78906G - Jotun'),(7,'2B Finish'),(8,'3165 Light Bronze Anodized'),(9,'327/18 FEVE (AS PER SAMPLE)'),(10,'584 Brass'),(11,'782 Brown Grey'),(12,'782-Champagne'),(13,'9005'),(14,'9010'),(15,'A 500 Grade B'),(16,'A-36'),(17,'ALC 016 Pure White'),(18,'ALCO 2000 G-10 SILVER MATT'),(19,'ALCO 2000 G.O-SILVER MATT'),(20,'ALCO 2000 G10 SIL.MATT18-22Mic'),(21,'ALCO 2000 G10 SIL.MATT18-25MIC'),(22,'ALCO 3000 G-0 CHAM BRONZE15-18'),(23,'ALCO 9000 G-025(G-150)'),(24,'ALCO2000G10SILVERMATT15-18MIC.'),(25,'APL M08 Metalic Bronze Batch'),(26,'Alco 7000-G-0 BLACK 18-22 Mic'),(27,'Alco 7000-G-0 BLK'),(28,'Alco 7000-G-0 BLK-15 TO 18 Mic'),(29,'Alco-2000-25 Microns'),(30,'Alco-2000-G.O.Silver Matt'),(31,'Alco2000 G-O Silver Matt'),(32,'Anodic Silver E9106 F.R.'),(33,'Anodic Silver E9106S F.R.'),(34,'Anodized G3 Matt Light Gold'),(35,'Apollo Stone D11195 DG5000'),(36,'As Per Sample'),(37,'BF 9813-KKIA OFF WHITE TC G30'),(38,'BF-6608 Ral 1014 Ivory 3C G30%'),(39,'BF4755 RAL 1014 IVORY G30%'),(40,'BRONZE METALLIC'),(41,'BU RAL 9005'),(42,'BURNT UMBER LIME'),(43,'Black'),(44,'Black Anodized'),(45,'Black Anodized (20-22 Mic.)'),(46,'Blue'),(47,'Bright Silver'),(48,'Brillant Mettelic 602'),(49,'Bronze'),(50,'Bronze 3145'),(51,'Bronze Anodized'),(52,'Brushed Nat. Alum. H9103S'),(53,'Champ.Anod.45.M.10'),(54,'Champ.Anodized Gt-45'),(55,'Champagne Metallic E1101S'),(56,'Champagne anodized-45'),(57,'Champiange'),(58,'Clear'),(59,'DIN 934'),(60,'Dark Bronze Anodized'),(61,'Dark Bronzed Anodized 3178'),(62,'Dark Grey Metallic 505'),(63,'Dark Grey Metallic E7103S'),(64,'E 7108S - Grey Metallic'),(65,'E1104 S GOLD MATALLIC'),(66,'Facade1307RAL 7022 SMO-1007123'),(67,'Facade1307RAL 7043 SMO-1006924'),(68,'Finish No.1'),(69,'Frisco White A9101 S Washcoat'),(70,'Galvanized'),(71,'Gold Yellow'),(72,'Grade 355'),(73,'Grade A572 G-50'),(74,'Grade S275 JR'),(75,'Grade-500'),(76,'Green'),(77,'Grey'),(78,'Grey Metallic 502'),(79,'Grey S1'),(80,'HDG'),(81,'HDG GR 8.8'),(82,'IB-02-Silver Gray'),(83,'Ivory'),(84,'J 9111B-Silver Gold'),(85,'Light Bronze A.Alco 4000G-0'),(86,'Light Champagne 452'),(87,'Light Green Met. 4519S'),(88,'Light Ivory Ral 1015 DG5000'),(89,'M. Bronze Anodized'),(90,'M.F'),(91,'M.F. ALLOY 5005'),(92,'M7796 Silver White Metal G30%'),(93,'M7817 Light Bronze Mettallic G30%'),(94,'M9010 White G80%'),(95,'M9010-White 3C'),(96,'MA239 Beige Grey-7006'),(97,'MB106 Dark Grey Metallic G 30%'),(98,'MB542 Light Brown Metallic G30'),(99,'MD046 Sparkling White G80%'),(100,'MD048 Sparkling Gold G80%'),(101,'MG386 Serpe Ggiante G15%'),(102,'Mirror Finish'),(103,'N1 CT+N2-DIE#4'),(104,'NCS 1515Y20R S.Durable'),(105,'NCS1005Y50R SMO-1027542 JOTUN'),(106,'Natural Brushed'),(107,'PE-F 1307 RAL 1013 Smooth'),(108,'PE-F 1307 RAL 9007 SMOOTH'),(109,'PE-F1303GreyBonded SPM-1208750'),(110,'PE-F1303RAL9007Smooth(1008402)'),(111,'PE-F1307 RAL 7005 Smo-1006836'),(112,'PE-F1307 RAL 7006 Smo -1006827'),(113,'PE-F1307 RAL 7024 SMOOTH'),(114,'PE-F1307 RAL-7030 Smo-1007009'),(115,'PE-F1307 RAL-7032 Smo-1007038'),(116,'PE-F1307 RAL-9003 Smo-1006875'),(117,'PE-F1307 RAL-9007 Smo-1006820'),(118,'PE-F1307 RAL1035Smooth1006877'),(119,'PE-F1307 Ral 7006 Smooth'),(120,'PE-F1307RAL 7038Smooth-1006901'),(121,'PE-F1307RAL-7010Smooth-1016560'),(122,'PE-F1307RAL7035 Smooth-1007024'),(123,'PE-F1307RAL9002Smooth(1006997)'),(124,'PE-F1308 RAL-1036 Smo-1006844'),(125,'PE-F1308 RAL-9007 Smo-1006843'),(126,'PE-F1308RAL7048 Smooth-1006842'),(127,'PE-F1407 RAL-1015 Smo-1007082'),(128,'PE-F1407 RAL9010'),(129,'PE-F1407 RAL9010 Smooth1006926'),(130,'PE-F1407 Ral 9016 Smo-1006918'),(131,'PE-SDF 2003 Grey SPM 1202604'),(132,'PE-SDF 2003F72983GW BONDED'),(133,'PE-SDF2003R Grey SPM-1201659 J'),(134,'PE-SDF2003R OffWhiteSMO1203972'),(135,'PE-SDF2003R RAL 8017 SMO-JOTUN'),(136,'PE-SDF2003R RAL 9002 Smooth'),(137,'PE-SDF2003R RAL9006 SPM1202152'),(138,'PE40/P 733 MFS-A'),(139,'PE40/P 733 MFS-ALWAN'),(140,'PE60/RAL 7024 MFS-JED.S.D.'),(141,'PR29/770 HR ALWAN'),(142,'PR40 / B 980 MFS Silver Mettel'),(143,'PR40/G 708 MFS Mett.Grey Alwan'),(144,'Plus - Ral 1015'),(145,'Pure White 10-1000'),(146,'Pure White A9110S'),(147,'RAL 1001'),(148,'RAL 1011'),(149,'RAL 1013'),(150,'RAL 1013 -Jotun'),(151,'RAL 1013-Jotun (1006830)'),(152,'RAL 1014-Alwan'),(153,'RAL 1015'),(154,'RAL 1015 -JOTUN'),(155,'RAL 1015 Smooth Matt'),(156,'RAL 1019'),(157,'RAL 1035'),(158,'RAL 1035 - Jotun'),(159,'RAL 1035 - Jotun (1006877)'),(160,'RAL 1036-Jotun'),(161,'RAL 3004'),(162,'RAL 3005'),(163,'RAL 3007'),(164,'RAL 5010'),(165,'RAL 5011-Jotun'),(166,'RAL 6011'),(167,'RAL 6026'),(168,'RAL 7005'),(169,'RAL 7006 JOTUN'),(170,'RAL 7006-Jotun'),(171,'RAL 7011 Matt'),(172,'RAL 7015 - Jotun'),(173,'RAL 7016 Smooth (1006903)'),(174,'RAL 7021 Alwan'),(175,'RAL 7021 Smooth 1006897'),(176,'RAL 7021-Jotun'),(177,'RAL 7022'),(178,'RAL 7022 - Jotun Smooth'),(179,'RAL 7022 -Smooth 1007123'),(180,'RAL 7023-Jotun'),(181,'RAL 7024'),(182,'RAL 7024 -Jotun'),(183,'RAL 7030 - Jotun'),(184,'RAL 7034 - Jotun'),(185,'RAL 7035'),(186,'RAL 7035 Super Durable'),(187,'RAL 7035-Jotun'),(188,'RAL 7037'),(189,'RAL 7037 - Jotun'),(190,'RAL 7038 - Jotun'),(191,'RAL 7042-Jotun'),(192,'RAL 7043 - Jotun'),(193,'RAL 7044 - JOTUN'),(194,'RAL 7045'),(195,'RAL 7046 - ALWAN'),(196,'RAL 7046 - MATT'),(197,'RAL 7047 - Alwan'),(198,'RAL 7048 - MATT'),(199,'RAL 8017-Jotun'),(200,'RAL 8019 - Alwan'),(201,'RAL 8022 Alwan'),(202,'RAL 9001'),(203,'RAL 9001 Super Durable -Jotun'),(204,'RAL 9002'),(205,'RAL 9002 Smooth (1006997)'),(206,'RAL 9002-Jotun'),(207,'RAL 9003'),(208,'RAL 9003 SMO'),(209,'RAL 9003 Smooth'),(210,'RAL 9003-Jotun'),(211,'RAL 9005'),(212,'RAL 9005 MATT'),(213,'RAL 9006'),(214,'RAL 9006 Smooth 1006824'),(215,'RAL 9006 Smooth-1006938'),(216,'RAL 9006-JOTUN'),(217,'RAL 9007 (Bonded)SPM - 1218621'),(218,'RAL 9010'),(219,'RAL 9010 JOTUN'),(220,'RAL 9010 SUPER DURABLE'),(221,'RAL 9010 Smooth Jotun'),(222,'RAL 9010 Smooth Jotun(1006926)'),(223,'RAL 9010-Jotun'),(224,'RAL 9016'),(225,'RAL 9016 - Jotun'),(226,'RAL 9018 SMOOTH 1006825-JOTUN'),(227,'RAL 9018-JOTUN'),(228,'RAL 9023'),(229,'RAR - 40 - Anodized'),(230,'RAR 150 - Anodized'),(231,'Ral 1019 Jotun'),(232,'Ral 9010-Jotun'),(233,'Red'),(234,'Rejected Silver Metro'),(235,'Riyadh Stone Beige'),(236,'S235'),(237,'SD 07 Grand Brillant'),(238,'SD2003 Beige PRLS - 1226939'),(239,'SD2003 Beige Smooth -1225591'),(240,'SD2003 Cielo SPMS-1215850'),(241,'SD2003 Cielo SPMS1215850-Brown'),(242,'SD2003 RAL 7006 Smooth-1008250'),(243,'SD2003 RAL 7034 Smooth-1222459'),(244,'SD2003 RAL 9003 Smooth-1008210'),(245,'SD2003 Ral 7021 Smooth-1022982'),(246,'SD2003Grey Bonded SPM-1220160'),(247,'SD2003RAL 7016 Smo1223348 Grey'),(248,'SDF2003R DXB RAL9003Smo1218857'),(249,'SS-A2-70'),(250,'Sand A7110 S DG 500 Washcoat'),(251,'Satin Finish'),(252,'Silver'),(253,'Silver 15-18 Mic'),(254,'Silver 18-20 Mic'),(255,'Silver 20 - 22 Mic'),(256,'Silver Anodized'),(257,'Silver Anodized 20-22 Mic.'),(258,'Silver Anodized Matt'),(259,'Silver Anodized-20-22-Mic.'),(260,'Silver Anodized-22 TO 25-MIC'),(261,'Silver Mettalic 500'),(262,'Sparkling Grey F7111B'),(263,'Sparkling White 1472/10'),(264,'Stainless Steel'),(265,'Stainless Steel 304'),(266,'Stainless Steel 304-Mirror'),(267,'Stainless Steel 304-Satin'),(268,'Stainless Steel 316'),(269,'Stainless Steel 316 - Mirror'),(270,'Stainless Steel 316-Satin'),(271,'Stainless Steel Satin'),(272,'Stainless Steel-Mirror'),(273,'Stripping'),(274,'TB Sparkling 18272'),(275,'TB-130'),(276,'TB-182'),(277,'TB120'),(278,'Ultramarine Blue 203'),(279,'V RAL'),(280,'VRD27'),(281,'WF A2 CT M N2 DIE # 2'),(282,'WF I 1 CT+ I 2 Die # 8'),(283,'WF P1+P2  DIE 1'),(284,'WF P1CT M+P2 DIE # 2'),(285,'WF P2 Base Coat'),(286,'WHITE'),(287,'White');
/*!40000 ALTER TABLE `bom_finish` ENABLE KEYS */;
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
