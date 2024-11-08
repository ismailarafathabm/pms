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
-- Table structure for table `pms_glasstypes`
--

DROP TABLE IF EXISTS `pms_glasstypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_glasstypes` (
  `glasstype_id` int(11) NOT NULL AUTO_INCREMENT,
  `glasstype_name` text COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`glasstype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_glasstypes`
--

LOCK TABLES `pms_glasstypes` WRITE;
/*!40000 ALTER TABLE `pms_glasstypes` DISABLE KEYS */;
INSERT INTO `pms_glasstypes` VALUES (7,'dWhxdnlYWE1RcmFXV2JGTGJVaXJUdz09'),(8,'QjBxTHFuYVY1Y094S3dEb1V6eFFndz09'),(9,'MnFWWUJ0VnM4REdTUVNlZFlYNTRRQT09'),(10,'QW1ZcWk1bmdVYTFrODE5WStSbnZXazdpd1dFUjVXZmZvb2pIRW05R3lkZz0='),(11,'ODJ6a3VlOUY1SEpXaUhFSDRjR2hiMkkxdXVXQmpHTWwrY0xyT3V5M3cxTT0='),(12,'bzZhdDJZdWphOW5iUUpab1hDQ0lwZz09'),(13,'a3BkcithdWR1NkFlMWExR3NoV2VNUT09'),(14,'bjRxMlR4Q1JLY3NrbXVoejF1L005UitESlhMTEZiSGs4QW12bzczMTlXRT0='),(15,'cUlvdnhzYWNxbGpndmI2b1JkSmhaVmU2YlFPSE5iZkZvaHVndnYzUGdBbz0='),(16,'WUZqKzNORVg3VFNOTDYwaVBaR2d2Zz09'),(17,'OTNIc1orZHZlL2J0UjBPOUFUSjV5ZG9hYnRSanMySmgvVHV3WXdZTmtaZz0='),(18,'Nm5MRys0Zk1GZWY1ajlEWDFPak1YMEtkSXF4WEU4M0oxU1orMzg4STk5UjYydlMwVkNZL2hJVWNmSml2cndYdA=='),(19,'eHRnd3BYQldGc1J5dURtM3htTWFROUluUXpvTDFuSTBkU01INTd2ZzFKUT0='),(20,'QkJCOGZtNnRWNXhJYWFBems2eFdCQT09'),(21,'R2srb0JqNkZPSGdGL0x3YmxMekMydz09'),(22,'bE5sNWVKQk40ZlRCb0FoM0lRTHZwUT09'),(23,'UVBia0xLdkRpMW95SEI1STdVOW1EZz09'),(24,'VHk5RlpZUXRjSzlsa3JNWm9pT2ZxQT09'),(25,'VHk5RlpZUXRjSzlsa3JNWm9pT2ZxQT09'),(26,'VHk5RlpZUXRjSzlsa3JNWm9pT2ZxQT09'),(27,'VExCL1A5bksrM0JJVzJBcWYwc0pZZz09'),(28,'T3pwazRHREZOK3VGZXF0TEdRUWhxQT09'),(29,'OVl2K0JieVJGYjZLaSsraVZsVjJsdz09'),(30,'VGlXeTBUWE9XRVlmY1p1R3pxY05hUT09'),(31,'bUtZRGJsTnR6dElZdWRmSEtLNVFXQT09'),(32,'dkt3MDN2VkM0cENnbkZQVXE1eElkZz09'),(33,'RnJsOUl4K20wS2N1MmcwVURVOXlGUT09'),(34,'UWF3VitTOFRxOUFuWU43QUp5RmVQdz09'),(35,'S1J0S0xHaDl1eVlwMnpSN1A2SHlMQT09'),(36,'bEphdVJsQ014UFo3SGUyVFdkZml3YzRVdnhRR1dYQ1JiemVYeVhBekJYTT0=');
/*!40000 ALTER TABLE `pms_glasstypes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:29:03
