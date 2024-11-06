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
-- Table structure for table `pms_ponew`
--

DROP TABLE IF EXISTS `pms_ponew`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_ponew` (
  `ponewid` int(11) NOT NULL AUTO_INCREMENT,
  `ponewrefno` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ponewsupplier` int(11) NOT NULL,
  `ponewfrom` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ponewsubject` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ponewvat` double NOT NULL,
  `ponewtotval` double NOT NULL,
  `ponewtype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ponewproject` int(11) NOT NULL,
  `ponewcby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `poneweby` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ponewcdate` datetime NOT NULL,
  `ponewedate` datetime NOT NULL,
  `ponewpostflag` varchar(1) COLLATE utf8mb4_bin NOT NULL,
  `ponewdate` date NOT NULL,
  PRIMARY KEY (`ponewid`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_ponew`
--

LOCK TABLES `pms_ponew` WRITE;
/*!40000 ALTER TABLE `pms_ponew` DISABLE KEYS */;
INSERT INTO `pms_ponew` VALUES (1,'0683/23',11,'PROCUREMENT','-',15,5412.9235,'Glass',23,'procurement','procurement','2023-06-18 09:09:24','2023-06-18 09:09:24','o','2023-06-15'),(2,'52914',12,'PROCUREMENT','-',15,11757.1745,'Glass',425,'procurement','procurement','2023-06-18 10:51:07','2023-06-18 10:51:07','o','2023-06-12'),(3,'52971',12,'PROCUREMENT','-',15,2045.0795,'Glass',413,'procurement','procurement','2023-06-18 11:04:49','2023-06-18 11:04:49','o','2023-06-15'),(4,'06-0652-23',10,'PROCUREMENT','-',15,521.41,'Glass',10,'procurement','procurement','2023-06-18 11:19:45','2023-06-18 11:19:45','o','2023-06-17'),(5,'11-925-22',10,'PROCUREMENT','-',15,177407.05,'Glass',419,'procurement','procurement','2023-06-18 11:22:51','2023-06-18 11:22:51','o','2023-06-14'),(6,'06-0064-23',10,'PROCUREMENT','-',15,1118.145,'Glass',10,'procurement','procurement','2023-06-18 11:49:58','2023-06-18 11:49:58','o','2023-06-15'),(7,'06-700-23',10,'PROCUREMENT','-',15,1041.9,'Glass',148,'procurement','procurement','2023-06-18 11:53:20','2023-06-18 11:53:20','o','2023-06-15'),(8,'06-0686-23',10,'PROCUREMENT','-',15,22318.28,'Glass',148,'procurement','procurement','2023-06-18 11:57:09','2023-06-18 11:57:09','o','2023-06-15'),(9,'03-0334-23',10,'PROCUREMENT','-',15,32728.54,'Glass',419,'procurement','procurement','2023-06-18 12:55:30','2023-06-18 12:55:30','o','2023-06-14'),(10,'06-0683-23',11,'PROCUREMENT','-',15,3903.8705,'Glass',75,'procurement','procurement','2023-06-18 13:07:35','2023-06-18 13:07:35','o','2023-06-15'),(11,'01-0003-23',10,'PROCUREMENT','-',15,100834.185,'Glass',195,'procurement','procurement','2023-06-19 10:52:34','2023-06-19 10:52:34','o','2023-02-14'),(12,'01-0004-23',10,'PROCUREMENT','-',15,92569.135,'Glass',195,'procurement','procurement','2023-06-19 10:56:55','2023-06-19 10:56:55','o','2023-02-16'),(13,'01-0002-23',10,'PROCUREMENT','-',15,119017.41,'Glass',195,'procurement','procurement','2023-06-19 10:59:33','2023-06-19 10:59:33','o','2023-02-16'),(14,'01-0005-23',10,'PROCUREMENT','-',15,102487.195,'Glass',195,'procurement','procurement','2023-06-19 11:02:02','2023-06-19 11:02:02','o','2023-02-16'),(15,'03-0339-23',10,'PROCUREMENT','-',15,13188.2,'Glass',439,'procurement','procurement','2023-06-19 14:18:46','2023-06-19 14:18:46','o','2023-04-10'),(16,'03-0289-23',10,'PROCUREMENT','-',15,13188.2,'Glass',439,'procurement','procurement','2023-06-19 14:23:07','2023-06-19 14:23:07','o','2023-04-10'),(17,'03-0284-23',10,'PROCUREMENT','-',15,21026.14,'Glass',439,'procurement','procurement','2023-06-19 14:25:58','2023-06-19 14:25:58','o','2023-04-09'),(18,'03-0338-23',10,'PROCUREMENT','-',15,21026.14,'Glass',439,'procurement','procurement','2023-06-19 14:28:57','2023-06-19 14:28:57','o','2023-04-09'),(19,'03-0337-23',10,'PROCUREMENT','-',15,6214.485,'Glass',439,'procurement','procurement','2023-06-19 14:32:23','2023-06-19 14:32:23','o','2023-04-08'),(20,'03-0291-23',10,'PROCUREMENT','-',15,6214.485,'Glass',439,'procurement','procurement','2023-06-19 14:35:26','2023-06-19 14:35:26','o','2023-04-08'),(21,'03-0342-23',10,'PROCUREMENT','-',15,6513.37,'Glass',439,'procurement','procurement','2023-06-19 14:37:53','2023-06-19 14:37:53','o','2023-04-09'),(22,'03-0294-23',10,'PROCUREMENT','-',15,6513.37,'Glass',439,'procurement','procurement','2023-06-19 14:40:18','2023-06-19 14:40:18','o','2023-04-09'),(23,'04-0435-23',10,'PROCUREMENT','-',15,36230.635,'Glass',439,'procurement','procurement','2023-06-19 14:43:12','2023-06-19 14:43:12','o','2023-05-03'),(24,'05-0535-23',10,'PROCUREMENT','-',15,6771.085,'Glass',439,'procurement','procurement','2023-06-20 13:51:27','2023-06-20 13:51:27','o','2023-05-24'),(25,'05-0597-23',10,'PROCUREMENT','-',15,100708.605,'Glass',439,'procurement','procurement','2023-06-20 13:56:19','2023-06-20 13:56:19','o','2023-05-21'),(26,'05-0599-23',10,'PROCUREMENT','-',15,105604.385,'Glass',439,'procurement','procurement','2023-06-20 13:59:17','2023-06-20 13:59:17','o','2023-05-21'),(27,'05-0602-23',10,'PROCUREMENT','-',15,36589.55,'Glass',439,'procurement','procurement','2023-06-20 14:06:07','2023-06-20 14:06:07','o','2023-05-21'),(28,'05-0598-23',10,'PROCUREMENT','-',15,75147.44,'Glass',439,'procurement','procurement','2023-06-20 14:10:12','2023-06-20 14:10:12','o','2023-05-21'),(29,'05-0596-234',10,'PROCUREMENT','-',15,71935.03,'Glass',439,'procurement','procurement','2023-06-20 14:15:15','2023-06-20 14:15:15','o','2023-05-21'),(30,'05-0533-23',10,'PROCUREMENT','-',15,37053.23,'Glass',439,'procurement','procurement','2023-06-20 14:21:43','2023-06-20 14:21:43','o','2023-05-20'),(31,'05-0532-23',10,'PROCUREMENT','-',15,36230.635,'Glass',439,'procurement','procurement','2023-06-20 14:28:09','2023-06-20 14:28:09','o','2023-05-20'),(32,'05-534-23',10,'PROCUREMEMT','-',15,41405.52,'Glass',439,'procurement','procurement','2023-06-20 14:42:50','2023-06-20 14:42:50','o','2020-05-23'),(33,'06-0641-23',10,'PROCUREMENT','-',15,679.65,'Glass',439,'procurement','procurement','2023-06-21 11:47:14','2023-06-21 11:47:14','o','2023-06-19'),(34,'05-0607-23',10,'PROCUREMENT','-',15,75147.44,'Glass',439,'procurement','procurement','2023-06-21 11:50:25','2023-06-21 11:50:25','o','2023-06-08'),(35,'05-0536-23',10,'PROCUREMENT','-',15,31618.905,'Glass',439,'procurement','procurement','2023-06-21 11:54:14','2023-06-21 11:54:14','o','2023-05-22'),(36,'05-0547-23',10,'PROCUREMENT','-',15,4518.58,'Glass',439,'procurement','procurement','2023-06-21 11:57:14','2023-06-21 11:57:14','o','2023-05-23'),(37,'05-0603-23',10,'PROCUREMENT','-',15,54884.325,'Glass',439,'procurement','procurement','2023-06-21 11:59:48','2023-06-21 11:59:48','o','2023-05-21'),(38,'05-0601-23',10,'PROCUREMENT','-',15,61331.11,'Glass',439,'procurement','procurement','2023-06-21 12:02:44','2023-06-21 12:02:44','o','2023-05-21'),(39,'05-0600-23',10,'PROCUREMENT','-',15,40887.445,'Glass',439,'procurement','procurement','2023-06-21 12:48:27','2023-06-21 12:48:27','o','2023-05-21'),(40,'05-0629-23',10,'PROCUREMENT','-',15,20443.78,'Glass',439,'procurement','procurement','2023-06-21 12:51:01','2023-06-21 12:51:01','o','2023-06-08'),(41,'05-0608-23',10,'PROCUREMENT','-',15,75147.44,'Glass',439,'procurement','procurement','2023-06-21 12:53:48','2023-06-21 12:53:48','o','2023-06-08'),(42,'05-0628-23',10,'PROCUREMENT','-',15,18294.775,'Glass',439,'procurement','procurement','2023-06-21 12:55:55','2023-06-21 12:55:55','o','2023-06-08'),(43,'05-0626-23',10,'PROCUREMENT','-',15,37287.255,'Glass',439,'procurement','procurement','2023-06-21 12:57:57','2023-06-21 12:57:57','o','2023-06-08'),(44,'05-0610-23',10,'PROCUREMENT','-',15,40887.445,'Glass',439,'procurement','procurement','2023-06-21 13:00:24','2023-06-21 13:00:24','o','2023-06-08'),(45,'05-0609-23',10,'PROCUREMENT','-',15,36589.55,'Glass',439,'procurement','procurement','2023-06-21 13:08:46','2023-06-21 13:08:46','o','2023-06-08'),(46,'05-0623-23',10,'PROCUREMENT','-',15,18115.375,'Glass',439,'procurement','procurement','2023-06-21 13:14:37','2023-06-21 13:14:37','o','2023-06-08'),(47,'05-0627-23',10,'PROCUREMENT','-',15,37287.255,'Glass',439,'procurement','procurement','2023-06-21 13:22:36','2023-06-21 13:22:36','o','2023-06-08'),(48,'06-0660-23',10,'PROCUREMENT','-',15,29747.51,'Glass',439,'procurement','procurement','2023-06-21 13:24:51','2023-06-21 13:24:51','o','2023-06-21'),(49,'06-0659-23',10,'PROCUREMENT','-',15,39302.975,'Glass',439,'procurement','procurement','2023-06-21 13:35:02','2023-06-21 13:35:02','o','2023-06-19'),(50,'05-625-23',10,'PROCUREMENT','-',15,9057.745,'Glass',439,'procurement','procurement','2023-06-21 13:40:45','2023-06-21 13:40:45','o','2023-06-08'),(51,'06-0661-23',10,'PROCUREMENT','-',15,29747.51,'Glass',439,'procurement','procurement','2023-06-21 13:42:53','2023-06-21 13:42:53','o','2023-06-19'),(52,'06-0662-23',10,'PROCUREMENT','-',15,24864.725,'Glass',439,'procurement','procurement','2023-06-21 13:46:31','2023-06-21 13:46:31','o','2023-06-19'),(53,'06-0732-23',10,'PROCUREMENT','-',15,22251.12,'Glass',439,'procurement','procurement','2023-06-21 13:48:52','2023-06-21 13:48:52','o','2023-06-20'),(54,'06-0665-23',10,'PROCUREMENT','-',15,26620.66,'Glass',439,'procurement','procurement','2023-06-21 13:57:00','2023-06-21 13:57:00','o','2023-06-20'),(55,'06-0663-23',10,'PROCUREMENT','-',15,35171.715,'Glass',439,'procurement','procurement','2023-06-21 14:04:01','2023-06-21 14:04:01','o','2023-06-20'),(56,'06-0664-23',10,'PROCUREMENT','-',15,26620.66,'Glass',439,'procurement','procurement','2023-06-21 14:06:21','2023-06-21 14:06:21','o','2023-06-20'),(57,'05-0585-23',10,'PROCUREMENT','-',15,18681.06,'Glass',439,'procurement','procurement','2023-06-26 10:27:42','2023-06-26 10:27:42','o','2023-05-24'),(58,'05-0584-23',10,'PROCUREMENT','-',15,297207.15,'Glass',439,'procurement','procurement','2023-06-26 10:35:20','2023-06-26 10:35:20','o','2023-05-23'),(59,'05-0606-23',10,'PROCUREMENT','-',15,47552.73,'Glass',439,'procurement','procurement','2023-06-26 10:37:35','2023-06-26 10:37:35','o','2023-05-21'),(60,'05-0564-23',10,'PROCUREMENT','-',15,792.58,'Glass',439,'procurement','procurement','2023-06-26 10:45:50','2023-06-26 10:45:50','o','2023-05-27');
/*!40000 ALTER TABLE `pms_ponew` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:28:44
