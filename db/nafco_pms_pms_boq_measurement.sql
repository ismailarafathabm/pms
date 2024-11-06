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
-- Table structure for table `pms_boq_measurement`
--

DROP TABLE IF EXISTS `pms_boq_measurement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_boq_measurement` (
  `meas_id` int(11) NOT NULL AUTO_INCREMENT,
  `meas_boq` text COLLATE utf8mb4_bin NOT NULL,
  `meas_width` text COLLATE utf8mb4_bin NOT NULL,
  `meas_height` text COLLATE utf8mb4_bin NOT NULL,
  `meas_remark` text COLLATE utf8mb4_bin NOT NULL,
  `meas_project` text COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`meas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_boq_measurement`
--

LOCK TABLES `pms_boq_measurement` WRITE;
/*!40000 ALTER TABLE `pms_boq_measurement` DISABLE KEYS */;
INSERT INTO `pms_boq_measurement` VALUES (1,'NW9FWDdjbk4ySzJud0pFY3RQb1lRUT09','L0ZIZVA1SmlBUVR3RnJtOENpd3RrZz09','SzBlWHlpMEZhK0czZzNaUTVhVXZidz09','dlJiQjdySVVrRktYUXNiZHlndW5YQT09','azh0bWg3d0w0MVZQKzN5NWhnSHdmZz09'),(2,'NW9FWDdjbk4ySzJud0pFY3RQb1lRUT09','L0ZIZVA1SmlBUVR3RnJtOENpd3RrZz09','SzBlWHlpMEZhK0czZzNaUTVhVXZidz09','dlJiQjdySVVrRktYUXNiZHlndW5YQT09','S2tjVFlUL3FGN2ZSb3o2SEc5WldZQT09'),(3,'TmJiRHRiWGRUZkF3aDJNWlFYVGpvQT09','UWVxRnV3djR6SmVWODRwdHdzZnFJZz09','NysrbXRYdG91QVdncXVjeVFNV0J1Zz09','dlJiQjdySVVrRktYUXNiZHlndW5YQT09','S2tjVFlUL3FGN2ZSb3o2SEc5WldZQT09'),(4,'dGkwQnJGY0VEc0Z4SEl3SGEreFpPZz09','czh2Q0xiQjM5QTd5clhaaFdlRitRZz09','c2tqTkhwNjNXV09uYnNzb2lXakFpUT09','dlJiQjdySVVrRktYUXNiZHlndW5YQT09','S2tjVFlUL3FGN2ZSb3o2SEc5WldZQT09'),(5,'MVk2MmR1c01SdWJOTlBpaWo1ZGdiUT09','bDJac04yK2ZLVmQ5V2RyeTFVSTFHZz09','NmhmcW1pV05EbkxYaFBsblJmVVI0dz09','dlJiQjdySVVrRktYUXNiZHlndW5YQT09','S2tjVFlUL3FGN2ZSb3o2SEc5WldZQT09');
/*!40000 ALTER TABLE `pms_boq_measurement` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:28:46
