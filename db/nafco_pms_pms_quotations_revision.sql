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
-- Table structure for table `pms_quotations_revision`
--

DROP TABLE IF EXISTS `pms_quotations_revision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_quotations_revision` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `rdate` date NOT NULL,
  `rduration` longtext COLLATE utf8mb4_bin NOT NULL,
  `ramount` longtext COLLATE utf8mb4_bin NOT NULL,
  `rsystemtype` longtext COLLATE utf8mb4_bin NOT NULL,
  `rcosingeng` longtext COLLATE utf8mb4_bin NOT NULL,
  `rremarks` longtext COLLATE utf8mb4_bin NOT NULL,
  `rdrawingno` longtext COLLATE utf8mb4_bin NOT NULL,
  `rcurrent` longtext COLLATE utf8mb4_bin NOT NULL,
  `rqno` int(11) NOT NULL,
  `cby` longtext COLLATE utf8mb4_bin NOT NULL,
  `eby` longtext COLLATE utf8mb4_bin NOT NULL,
  `cdate` datetime NOT NULL,
  `edate` datetime NOT NULL,
  `del` longtext COLLATE utf8mb4_bin NOT NULL,
  `revision_no` longtext COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_quotations_revision`
--

LOCK TABLES `pms_quotations_revision` WRITE;
/*!40000 ALTER TABLE `pms_quotations_revision` DISABLE KEYS */;
INSERT INTO `pms_quotations_revision` VALUES (1,'2021-08-17','ZlVYalFsd1BvUnhEWmpsRmVma01wUT09','dEhhOWRvWko3aC9KUU11YzhsdFBtUT09','QWlWQ1R4TmlKNHVZc0pSSHNybWlWZz09','QWlWQ1R4TmlKNHVZc0pSSHNybWlWZz09','Z0kwN2t5c0Y4SVUrVDQ2YlRaMU9wQT09','aHcwNS9VMml3UmoxcFNJR0N2NFhyZz09','d2lTbm0vc084eHhjOCtuNU5qdTlZZz09',5,'SlZ4dFBWT3Y2N1pUVWx1aXh1Qit2UT09','SlZ4dFBWT3Y2N1pUVWx1aXh1Qit2UT09','2021-08-17 11:43:58','2021-08-17 11:43:58','RlJPSENyR2s5Y1lUa1FGQjhZc01rUT09','djdHQUJyZ3ZGR1lRaHJ0WXJiVmNiZz09'),(2,'2021-08-17','ZlVYalFsd1BvUnhEWmpsRmVma01wUT09','dEhhOWRvWko3aC9KUU11YzhsdFBtUT09','QWlWQ1R4TmlKNHVZc0pSSHNybWlWZz09','QWlWQ1R4TmlKNHVZc0pSSHNybWlWZz09','Z0kwN2t5c0Y4SVUrVDQ2YlRaMU9wQT09','aHcwNS9VMml3UmoxcFNJR0N2NFhyZz09','RlJPSENyR2s5Y1lUa1FGQjhZc01rUT09',5,'SlZ4dFBWT3Y2N1pUVWx1aXh1Qit2UT09','SlZ4dFBWT3Y2N1pUVWx1aXh1Qit2UT09','2021-08-17 11:44:01','2021-08-17 11:44:01','RlJPSENyR2s5Y1lUa1FGQjhZc01rUT09','djdHQUJyZ3ZGR1lRaHJ0WXJiVmNiZz09'),(3,'2021-08-17','ZlVYalFsd1BvUnhEWmpsRmVma01wUT09','VG1YMmZRbG9ndVdtcVJQVllpb2ZwZz09','YjJ2dWhzeXJFNlIwTW1iNVM4ajBFdz09','TlYrYXA3WkZvd1hINXBmTHkySXJyZz09','TlYrYXA3WkZvd1hINXBmTHkySXJyZz09','TlYrYXA3WkZvd1hINXBmTHkySXJyZz09','d2lTbm0vc084eHhjOCtuNU5qdTlZZz09',1,'SlZ4dFBWT3Y2N1pUVWx1aXh1Qit2UT09','SlZ4dFBWT3Y2N1pUVWx1aXh1Qit2UT09','2021-08-17 11:46:22','2021-08-17 11:46:22','RlJPSENyR2s5Y1lUa1FGQjhZc01rUT09','UTNlckJob2hHU2xKdDJwVTVLbGU4Zz09'),(4,'2021-08-17','aFAwN2dnRno5aU9UR1R0Y3FXMUR4dz09','RzQ0aURoaU9HTENISGdkQWRyYkN5dz09','Y0IycUpJQm1PVktydzdNVUIvR1djUT09','TmVEY1VHbTRlSW1DUEgwVHA1QmNjZz09','eDRZWi83emxRWkZnRVlqNlc0RUwrdz09','RHo1N2l3aFRrTmFDc2FmVHlWdmNYQT09','RlJPSENyR2s5Y1lUa1FGQjhZc01rUT09',2,'SlZ4dFBWT3Y2N1pUVWx1aXh1Qit2UT09','SlZ4dFBWT3Y2N1pUVWx1aXh1Qit2UT09','2021-08-17 01:09:34','2021-08-17 01:09:34','RlJPSENyR2s5Y1lUa1FGQjhZc01rUT09','azh0bWg3d0w0MVZQKzN5NWhnSHdmZz09'),(5,'2021-08-20','bDJac04yK2ZLVmQ5V2RyeTFVSTFHZz09','anZIZ0JLL0hkekk0L1NFcDBHNkZhdz09','VHlUbHNuY3U4VFhXNXNxaVhGN0VKUT09','V3Q1RFlDSFN6dWZjUmd2ZEcvZU1KUT09','b0hpYlh3aC9iTmk1ajJtMUNtRUJzQT09','eS9QSTlna0hqQURuTE5IMi9WVFBaUT09','RlJPSENyR2s5Y1lUa1FGQjhZc01rUT09',1,'SlZ4dFBWT3Y2N1pUVWx1aXh1Qit2UT09','SlZ4dFBWT3Y2N1pUVWx1aXh1Qit2UT09','2021-08-17 02:57:12','2021-08-17 02:57:12','RlJPSENyR2s5Y1lUa1FGQjhZc01rUT09','emthV1JnVFhINm5LRDRHcFVDNDRrUT09');
/*!40000 ALTER TABLE `pms_quotations_revision` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:28:33