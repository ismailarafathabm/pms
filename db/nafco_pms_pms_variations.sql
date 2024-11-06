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
-- Table structure for table `pms_variations`
--

DROP TABLE IF EXISTS `pms_variations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_variations` (
  `variation_id` int(11) NOT NULL AUTO_INCREMENT,
  `variation_token` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_project_code` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_project_name` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_project_location` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_refno_p1` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_refno_p2` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_refno_p3` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_refno_p4` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_refno` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_date` date NOT NULL,
  `variation_to` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_subject` int(11) NOT NULL,
  `variation_description` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_amount` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_remarks` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_region` int(11) NOT NULL,
  `variation_salesman` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_status` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_createby` longtext COLLATE utf8mb4_bin NOT NULL,
  `variation_editby` longtext COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`variation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_variations`
--

LOCK TABLES `pms_variations` WRITE;
/*!40000 ALTER TABLE `pms_variations` DISABLE KEYS */;
INSERT INTO `pms_variations` VALUES (1,'N467kmy51L88n9GrZsNu7Y757','S2tjVFlUL3FGN2ZSb3o2SEc5WldZQT09','dXY0Y2c2RVRjRnVDMlp6c2ZaWm95OFV6WDVZV0dROTY4MG9zMUowQUtQcz0=','cGVnVGwwVE1scUVwUFladTFORDNFdz09','c3MzaFlxQXJKTW8yTlN1SGIxTWhtZz09','eHNSYUpRcDgrUmxqdnB2STFEbDQ5QT09','M0JXUU1iSkUvRlU1MTBXVXlxNjJ3QT09','Mno1VGxkdzFJYXNzVlJoV2NaSWhPdz09','SWtlYXJ6NzlqclNRQ3JXMWtiQVhNVVgwT2FhRE9vdU1CaS9pTERJVzlPMD0=','2020-08-18','UlcrV1JEWW9xd256QkRlRmw3WTVpZz09',1,'LytObWhhQUpvUndTcjdBQWszVUNoalRrYVI2eXpVT1BWVkJabTYrZSt0Zz0=','S2xZbHhKVzgzQ3ZQL1BpNHlKOG16QT09','dlJiQjdySVVrRktYUXNiZHlndW5YQT09',1,'TWZJb0VZK1NacWFpdUVaUUI0NjBudz09','RlJPSENyR2s5Y1lUa1FGQjhZc01rUT09','QU1VakNkTSt6Q3VvS1R1VXNUb3ZIZz09','QU1VakNkTSt6Q3VvS1R1VXNUb3ZIZz09'),(2,'ovKliO921ABNcqmPGWPNLRQbF','S2tjVFlUL3FGN2ZSb3o2SEc5WldZQT09','dXY0Y2c2RVRjRnVDMlp6c2ZaWm95OFV6WDVZV0dROTY4MG9zMUowQUtQcz0=','cGVnVGwwVE1scUVwUFladTFORDNFdz09','c3MzaFlxQXJKTW8yTlN1SGIxTWhtZz09','eHNSYUpRcDgrUmxqdnB2STFEbDQ5QT09','M0JXUU1iSkUvRlU1MTBXVXlxNjJ3QT09','UTNlckJob2hHU2xKdDJwVTVLbGU4Zz09','SWtlYXJ6NzlqclNRQ3JXMWtiQVhNVWZhQm4vVmxKQWpMcHM4cTVqejdIRT0=','2020-08-18','UlcrV1JEWW9xd256QkRlRmw3WTVpZz09',1,'LytObWhhQUpvUndTcjdBQWszVUNoalRrYVI2eXpVT1BWVkJabTYrZSt0Zz0=','czRaSlpsRzVKQ0loTnpnR1ZvdGdyQT09','dlJiQjdySVVrRktYUXNiZHlndW5YQT09',1,'TWZJb0VZK1NacWFpdUVaUUI0NjBudz09','d2lTbm0vc084eHhjOCtuNU5qdTlZZz09','SlZ4dFBWT3Y2N1pUVWx1aXh1Qit2UT09','SlZ4dFBWT3Y2N1pUVWx1aXh1Qit2UT09');
/*!40000 ALTER TABLE `pms_variations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:28:47
