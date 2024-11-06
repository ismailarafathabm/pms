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
-- Table structure for table `ppreports`
--

DROP TABLE IF EXISTS `ppreports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ppreports` (
  `pprid` int(11) NOT NULL AUTO_INCREMENT,
  `ppdate` date NOT NULL,
  `pp_project` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_projectname` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_mtype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_mdescription` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_color` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_qty` double NOT NULL,
  `pp_units` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_delno` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_dta` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_location` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_remarks` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_type` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_cdate` datetime NOT NULL,
  `pp_edate` datetime NOT NULL,
  `pp_cby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_eby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pp_extra` longtext COLLATE utf8mb4_bin NOT NULL,
  `pp_dieweight` double NOT NULL DEFAULT '0',
  `ppbalancedie` double NOT NULL DEFAULT '0',
  `pppartno` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pplenght` double NOT NULL,
  `ppalloy` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ppitemtype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`pprid`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ppreports`
--

LOCK TABLES `ppreports` WRITE;
/*!40000 ALTER TABLE `ppreports` DISABLE KEYS */;
INSERT INTO `ppreports` VALUES (1,'2022-04-30','P07/21','Olaya Lifestyle Mall','Door Sys.','55cm Hinge Door Frame','Ral 7011 smo 1226428',13,'Bar','590','31-May-2022','New Factory','Additional Door','pptowh','2022-05-26 09:00:35','2022-05-26 09:00:35','barakth','barakth','-',1.33,107.198,'23529',6.2,'T6','Aluminum'),(2,'2022-04-30','P07/21','Olaya Lifestyle Mall','Door Sys.','Door Leaf - Outside Opening','Ral 7011 smo 1226428',13,'Bar','590','31-May-2022','New Factory','Additional Door','pptowh','2022-05-26 09:00:25','2022-05-26 09:00:25','barakth','barakth','-',1.73,139.438,'23530',6.2,'T6','Aluminum'),(3,'2022-04-30','P07/21','Olaya Lifestyle Mall','Door Sys.','Door Bottom Rail','Ral 7011 smo 1226428',2,'Bar','590','31-May-2022','New Factory','Additional Door','pptowh','2022-05-26 09:00:20','2022-05-26 09:00:20','barakth','barakth','-',1.933,23.9692,'23505',6.2,'T6','Aluminum'),(4,'2022-04-30','P07/21','Olaya Lifestyle Mall','Door Sys.','Door Mid - Rail','Ral 7011 smo 1226428',2,'Bar','590','31-May-2022','New Factory','Additional Door','pptowh','2022-05-26 09:00:01','2022-05-26 09:00:01','barakth','barakth','-',1.62,20.088,'23506',6.2,'T6','Aluminum'),(5,'2022-04-30','P07/21','Olaya Lifestyle Mall','Door Sys.','Bead Double Galss','Ral 7011 smo 1226428',20,'Bar','590','31-May-2022','New Factory','Additional Door','pptowh','2022-05-26 09:00:43','2022-05-26 09:00:43','barakth','barakth','-',0.259,32.116,'13784',6.2,'T6','Aluminum'),(6,'2022-04-19','P17/21','Trio Plaza','Schuco C.W System','300mm Mullion','PE-SDF 2003R GREY SPM 1201659                ',135,'Bar','537','ETA 09-Jun-2022','Paint plant Ware House','G.F Elevation','pptowh','2022-05-26 10:00:49','2022-05-26 10:00:32','barakth','barakth','-',8.79,7713.225,'9037712',6.5,'T6','Aluminum'),(8,'2022-05-17','P09/22','Spark - Office & Industrial Building','EFT Euro Facade System','105mm Mullion (EFT 10720)','Durasol4003Grey 7016 S-1231808',1,'Bar','667','30-May-2022','New Factory','Powder Waiting','pptowh','2022-05-26 10:00:41','2022-05-26 10:00:41','barakth','barakth','-',2.51,15.562,'21488',6.2,'T6','Aluminum'),(9,'2022-05-17','P09/22','Spark - Office & Industrial Building','EFT Euro Facade System','105mm. Hrizontal Mullion','Durasol4003Grey 7016 S-1231808',1,'Bar','667','30-May-2022','New Factory','Powder Waiting','pptowh','2022-05-26 10:00:10','2022-05-26 10:00:10','barakth','barakth','-',2.14,13.268,'22017',6.2,'T6','Aluminum'),(10,'2022-04-19','P17/21','Trio Plaza','Schuco C.W System','300mm Mullion','PE-SDF 2003R GREY SPM 1201659',14,'Bar','537','09-06-2022','Paint plant Ware House','G.F Elevation','pptowh','2022-05-26 10:00:40','2022-05-26 10:00:40','barakth','barakth','-',8.79,664.524,'9037712',5.4,'T6','Aluminum'),(11,'2022-04-23','P17/21','Trio Plaza','Schuco System FW50+','300mm Mullion','PE-SDF 2003R GREY SPM 1201659',113,'Bar','554','09-06-2022','Paint plant Ware House','G.F Elevation','pptowh','2022-05-26 11:00:31','2022-05-26 11:00:31','barakth','barakth','-',8.79,6456.255,'9037712',6.5,'T6','Aluminum'),(13,'2022-04-23','P17/21','Trio Plaza','SCHUCO FWS50','300mm Mullion','PE-SDF 2003R GREY SPM 1201659',28,'Bar','554','09-06-2022','New Factory','G.F Elevation','pptowh','2022-05-26 16:00:51','2022-05-26 16:00:51','barakth','barakth','-',8.79,1329.048,'9037712',5.4,'T6','Aluminum'),(14,'2022-05-17','P24/21','Nauss Training Building','Galvanized Sheet','1220X3000X1mm Galvanized Sheet','PE-F1308 RAL-9007 Smo-1006843',300,'Pcs','669','28-05-2022','New Factory','Additional ','pptowh','2022-05-28 08:00:49','2022-05-28 08:00:49','barakth','barakth','-',0,0,'1220.3000.1mm-G     ',0,'-','Galvanized Sheet'),(15,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','Glazing Bead 22','SD2003 Grey PRLD-1237548',15,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 08:00:03','2022-05-28 08:00:03','barakth','barakth','-',0.28,25.2,'184050',6,'T6','Aluminum'),(32,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','Glaszing Bead 32','SD2003 Grey PRLD-1237548',16,'BAR','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 10:00:04','2022-05-28 10:00:04','demo','demo','-',0.36,34.56,'184070',6,'T6','Aluminum'),(33,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','Outer Frame (3639320)','SD2003 Grey PRLD-1237548',26,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 10:00:55','2022-05-28 10:00:55','demo','demo','-',0.677,105.612,'345160',6,'T6','Aluminum'),(34,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','Outer Frame (363920)','SD2003 Grey PRLD-1237548',26,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 10:00:38','2022-05-28 10:00:38','demo','demo','-',0.683,106.548,'345060',6,'T6','Aluminum'),(35,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','Transom/Mullion','SD2003 Grey PRLD-1237548',3,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 10:00:17','2022-05-28 10:00:17','demo','demo','-',0.783,14.094,'345230',6,'T6','Aluminum'),(36,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','Vent Frame (364710) (I)','SD2003 Grey PRLD-1237548',18,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 10:00:08','2022-05-28 10:00:08','demo','demo','-',1.06,114.48,'346280',6,'T6','Aluminum'),(37,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','Vent Frame (364710) (o)','SD2003 Grey PRLD-1237548',18,'bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 10:00:44','2022-05-28 10:00:44','demo','demo','-',0.613,66.204,'345340',6,'T6','Aluminum'),(38,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','Transom/Mullion','SD2003 Grey PRLD-1237548',7,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 10:00:41','2022-05-28 10:00:41','demo','demo','-',0.678,28.476,'345120',6,'T6','Aluminum'),(39,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','Glazing Bead 7','SD2003 Grey PRLD-1237548',29,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 10:00:59','2022-05-28 10:00:59','demo','demo','-',0.226,39.324,'184020',6,'T6','Aluminum'),(40,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','Inner Profile (148320)','SD2003 Grey PRLD-1237548',16,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 10:00:20','2022-05-28 10:00:20','demo','demo','-',1.415,135.84,'332620',6,'T6','Aluminum'),(41,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','Outer Profile (148320)','SD2003 Grey PRLD-1237548',9,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 10:00:40','2022-05-28 10:00:40','demo','demo','-',0.767,41.418,'332700',6,'T6','Aluminum'),(42,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','15 mm Cover For Mullion ( T Cleat )','SD2003 Grey PRLD-1237548',22,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 11:00:30','2022-05-28 11:00:30','demo','demo','-',0.3,39.6,'112720',6,'T6','Aluminum'),(43,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','12 mm Cover For Transom','SD2003 Grey PRLD-1237548',13,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 11:00:45','2022-05-28 11:00:45','demo','demo','-',0.25,19.5,'160620',6,'T6','Aluminum'),(44,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','180 mm Transom','SD2003 Grey PRLD-1237548',13,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 11:00:14','2022-05-28 11:00:14','demo','demo','-',3.125,243.75,'322450',6,'T6','Aluminum'),(45,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','175 mm Mullion','SD2003 Grey PRLD-1237548',22,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 11:00:04','2022-05-28 11:00:04','demo','demo','-',4.762,460.9616,'326250',4.4,'T6','Aluminum'),(46,'2022-05-18','P02/20','Lamina Tower','SCHUCO FWS50','200 mm corner Mullion','SD2003 Grey PRLD-1237548',1,'Bar','685','Waiting Powder','New Factory','Waiting Powder','pptowh','2022-05-28 11:00:35','2022-05-28 11:00:35','demo','demo','-',4.934,29.604,'328660',6,'T6','Aluminum');
/*!40000 ALTER TABLE `ppreports` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:28:39
