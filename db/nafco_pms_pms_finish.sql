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
-- Table structure for table `pms_finish`
--

DROP TABLE IF EXISTS `pms_finish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pms_finish` (
  `finish_id` int(11) NOT NULL AUTO_INCREMENT,
  `finish_name` text COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`finish_id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pms_finish`
--

LOCK TABLES `pms_finish` WRITE;
/*!40000 ALTER TABLE `pms_finish` DISABLE KEYS */;
INSERT INTO `pms_finish` VALUES (1,'NE5QQkhwWU9qNXZMNzI5dGZVNWRiZ2VPQTIvSWtSa1lLdHpldFArdnE5ST0='),(2,'bnFwTUV2eENXVXRNYzJHcldlWHo1QT09'),(3,'alEranlSdFBnWm9XUStQMFRXaTNLdz09'),(4,'dlJiQjdySVVrRktYUXNiZHlndW5YQT09'),(5,'NCswUW1qRURLV1cvckZQbFkyK3NpbHE0MkY2cnJQUmI2U2NScUJhWkVoM1JtNmZJTDJPU2QvS2NoNyt6Uk9uNQ=='),(6,'S2M1aUVLS1NUWW5BQ0JMZnpYcW5FZz09'),(7,'MU1MaUNIVHl4KzEyYkNhd2puRXNMM05WazMyTHcxdUJBWUdUQ2p3QWtOOXNYWGpyanNSZHlXS1FYQlZkRGQvbQ=='),(8,'ZzRiZm1XVHhZRVY3RVYyKzlweHRDbG1yOVdhWHQ4QUdoYmJlWHM1K1Fzbz0='),(9,'UFJqUnZOVllPN0gwajBFU2RXeW43TUhkZlQ5a0ZCelc2MmFCeWkxNk5Tdz0='),(10,'NmFpNE11UXVSNGdJbm05MEIweVhMUT09'),(11,'Q2paZkkwVElQVWxyN3dQbVd5NlM1aWQ4MVQrT2srekpLak4zd3E4bWlPaz0='),(12,'NXR1cUErclJJNDdWTkVYZ1R6eWFIQmJ5WmhITUVKQm5ua25lanh6cExXZjFrdjF2UmtSeWdQWlZxd1MydEpzK1J4Qk9BNVdETnhXUUhNTnR2bTZIR1k0Yi96d25CNlB3OWpDcVkxTFpJVFZxMzRRTjl1Q0RrNTVKNGcwZ3lGK2s='),(13,'UzM5N05RZXg3Y1RiQ0daM1BwNlF3SVdYZFBYb1F5SDNMRzVsTWpGcHgxbm55T0xvc05sczRlR0RPSkhXeCtCaVhSL2p0MndPNzlMSS9nZWp4T0VTcTU1MmtBY1ZaYWdjQnV4WWlBbHc3ODQ9'),(14,'d2dzNmM4ZU9ETCtOaXpOeFJWcGpTdnY4bkwwcHBBdThFRWtjVjhrR1NqTGdPUU9sNk1pT243WEZ5dTBsemlTNHdKVTBkOTRMdTdud05oOWd1eDh1cjRtZGhDT2thVWVZQVlUbGo5VGYzZzN0VVBSL3VwRXlMTzNNUmxPK1ZqSWdBQUZBSGw0cTVMSWtva3BRVDJqU0xlVzNIZlliMjJoZmQvU1ZGSTZJUjFBPQ=='),(15,'NXR1cUErclJJNDdWTkVYZ1R6eWFIQzRKQUZnZmQvaWpzajJaR2FIOTladz0='),(16,'UzM5N05RZXg3Y1RiQ0daM1BwNlF3R3dWV2M3Z0FNWlVaMHpPc1NJTldiWT0='),(17,'d3BOR1psMmJWUFAvOVBkWWpvWFhZZz09'),(18,'NDA0S0V1WU9ZSzlGdG0yU2w1enhpZVZzWnl5RXRzM2NPaHAyWWViLzB3ST0='),(19,'QWtzVEpMYkdWeGZqMlU2Y09NbW05Zz09'),(20,'Uk1JdldzeVMzLzZPRVl6VGVzYkFkVnNCczFsb2d4M1ZzZnBiZWNQTURCST0='),(21,'UzM5N05RZXg3Y1RiQ0daM1BwNlF3SVdYZFBYb1F5SDNMRzVsTWpGcHgxbXhIcU9GV05zN2g5Nmk1ZGd5Y2EwQTFHMkMraDl5WW0wQ010MWExK2lEUno2MjVyeWtJekxWdkpzdUlEdVU5L1k9'),(22,'UzZnOWN1SEoyeldHY3Y2YUkwWEdtdz09'),(23,'d1ZUOTQ4RzNkRm9OQ1ZkbUwwNWFTSU1pT2F2QTYxZ2FVRWYyTGFjcWpmST0='),(24,'QXhUd3J5ajg5QS9oN0hSM0wwQm9wQT09'),(25,'V2d4NERoaWg2N0ZvVmhwWlZ1UHZkQlVpa2ZlVmkrUEdwV25sSXg0dXFTdz0='),(26,'QXdRSWN1cithdFU3M3A1dzlaZWZnQWJLNGZCekFic20zbHE2bWxBSEx4MD0='),(27,'TVBSeTZhQU9YMmdpVldPTGdpcHNQc3hqRFd3UUROM2xDOGpUVmVueEN3ST0='),(28,'NFRiaE1maTZIeDN5aktYc3d3ZGlkdz09'),(29,'STlIL21KZmZRdnpZc2FFY3p6Qzc1K3BTTElQdzcrZEYxTFlPM1dFZldkM0lPYmVOL3F4NnFvL2hFdVZGdEEwQ0ZBUDZMZ1p1WFJOd3YwVis5NTJiM0E9PQ=='),(30,'YmZoQXQrY2RYR1dJeDBNL212L216QkFDbE1UWGpycmx6Q1NsWERnVzJqczluOStiL2l5ekQyM1pFeFRESDBZTg=='),(31,'d2dzNmM4ZU9ETCtOaXpOeFJWcGpTampleWZIU1ozQktaQzExbzdBRmMxbz0='),(32,'YmZoQXQrY2RYR1dJeDBNL212L216Q3kxeEFrT1N2dWJyZ2dBN0RTaUJabz0='),(33,'TUNuNnBTNTFoaEFwamJEUHRjYW15RWhJOWhGU1hsT1dsTWlNS1lpK0pPbz0='),(34,'YmZoQXQrY2RYR1dJeDBNL212L216QkFDbE1UWGpycmx6Q1NsWERnVzJqdjZLRGdHNlBRTXhEN1EwRHpCVXlmSg=='),(35,'NE5QQkhwWU9qNXZMNzI5dGZVNWRib3IxSGRjNkF2aGlvYVlNQndYVitGYmdSSXdEbHBKbUdKMWh2M3dRSUxBZQ=='),(36,'NXR1cUErclJJNDdWTkVYZ1R6eWFISFFaZkh4dHo0Vm5JQVVONW82Q2gvZ1pndEpCRHF6cVdscE1DTkwwd1FZRg=='),(37,'Rzg5TkdYY200ZlJwZkZyZHB5ODlsazZFMTNFTklBeXdsc3YzcjZFZ3Awa0M1NlNHOHIxdFNBZFllNTFTUVhtUmw0NEZ6SEthZFZBZyt6Z0ViaFAwdEltcHVlQzJpeWE3SUYyZVc4QUxwaDg4d096Vmh6TWdTNTBrWFFacE1pUSs5K3dHVEZEVmNoa0FLanRBdWpRTW5nPT0='),(38,'YmZoQXQrY2RYR1dJeDBNL212L216S2YrRjRDVU9XTEYvVWFRWTRKWU56YU5zbjFTQXAzcTlBOGNYTk1YS2Y2UQ=='),(39,'VnpWOFRCVkpueHJkaVVjenpjSzRIdkZFdDVUc1ppdU5XYTJyMjVUSGc2VT0='),(40,'ODJNV2VsV0J2TEU3RGsvMk1FckFGdz09'),(41,'MkloQlNkMzQ3d1htS1l3WTJGQmxEQjhBdktiY0EwaGw5eVExV1Y1VzFWND0='),(42,'d1ZUOTQ4RzNkRm9OQ1ZkbUwwNWFTTnNucDEwVWowNzlnUGhRVkxaN3RlQT0='),(43,'UmFSWVZWRkNYdGxHUk15OU9Tc3hJemp4MUQ2SEp3K2I0YUVKek8xcjVxcz0='),(44,'L3NjOFBLUzBFWTQvUnBETkFFYXN4c1BRSWRJUERscGRpQjAvc2xNWmxtdz0='),(45,'ZTJTa3krQXZhZjNoM1dMWGJQRllIV09TTW4yVTNoNVliQVF3bVZxcG5Ocz0='),(46,'c0VLU0pwSEFUOUNmT0wrYTVKVG1BVXFPS2RBYm5QOHhGTWZLbUpCK2dSekx4ZGFKZ3BMYUh2Q2U5SFRNbnZOMA=='),(47,'TUpoQnJXZWk1aU1DaUx5UWllR3ZsOU80bTEyV3BOUndiM0h4ckxZZ2NTSy9BMXpvQnJXVWE1dUF5MzNOOXVtMStkLzlOekwzczV2TU50QnU5VnBjSmc9PQ=='),(48,'UzJyaXpaR25vYmxuNVB6dGQxa3IxZz09'),(49,'U2dqUnBmMXlmZkVNRmRMcUNUeU5mUT09'),(50,'V3N1ZjJCWVlBM2EyRnVzd2JMSnBqdz09'),(51,'Rmtnb0pRZ3JzSE1RM042V0o0eURNS0tVdVA4MjFyYUlwU004VHRFSmpCVT0='),(52,'Ni9DbFFSZUN6Y29TbVVZZm1VeFE5VlRVZ3NxNXhneFVNVlZDSWtCTVBrRkV3RXVWT3lFMStFVjdQYzV4NkVPUw=='),(53,'ZThxVHdsc2lGQzhWS3FuUkNQaFVuYkN0UFFxcUFCUEl3QlBRU242ZGlPWT0='),(54,'eVBwYURxWUJvN1ZWbXhFdk8vVHVTeFpHZmhMcks0bGpDc3p4YmphUGd2TT0='),(55,'ODk3d3pkNjBtaVFSMEFPZWMwTmYvdnhiaFkvQjh2c21UZ1RlL2JLUDZGQT0='),(56,'YmZoQXQrY2RYR1dJeDBNL212L216RlFqUWdlckp4WnBCeVhNY1VZYlhHV2ZPbEFFWG03eitpQW9lYTZQTzVNMzFtY05lS29MT1h2cFd5cDRvSlBER3c9PQ=='),(57,'YmZoQXQrY2RYR1dJeDBNL212L216TE9hNVE5REFoZ0kvME5VWXVaK1ZsRjJ0U2d1UGlMd1lRcWNQS3l0MDErRjVZN3ZoV2R2TkoyMk9KcnpIOVpid1E9PQ=='),(58,'YmZoQXQrY2RYR1dJeDBNL212L216S2YrRjRDVU9XTEYvVWFRWTRKWU56WjFXM1Z4dE43YndSd2dwKzBCRWJWWCt1NExNbVdONVlCS3VIa1Y5ZnhPUEE9PQ=='),(59,'ODk3d3pkNjBtaVFSMEFPZWMwTmYvdGphODBGamdxRW1qU2Y4eXhOUnNHND0='),(60,'ODk3d3pkNjBtaVFSMEFPZWMwTmYvbU9Kd29mU0pjcVp5RDZDd1VyN2RnWXI4WWpENWhodHk5VHZTbzM5RUpvUA=='),(61,'YmZoQXQrY2RYR1dJeDBNL212L216S2YrRjRDVU9XTEYvVWFRWTRKWU56WXZ6QnZVZWoyajg5eXgxNkRpemtONlVocENuTXBleUI1TEpZYi9GWFNDT2EvWHc0cHRiN3dLVGdlODJlQmwvWjg9'),(62,'YmZoQXQrY2RYR1dJeDBNL212L216RUlXU3hCSGV5clh5dVZ2bTYrYkNiQldKcG93T0w3US80WklXVjBLQ1E3ZFAydzdoMjh3TDlQemFHV2JzVmxJWGc9PQ=='),(63,'ODk3d3pkNjBtaVFSMEFPZWMwTmYvbHUxSjJySThORGpWd1B2NzFKNnRIalMyYnoyQm5xRmhPQjZOQ0NadFR3Rw=='),(64,'YmZoQXQrY2RYR1dJeDBNL212L216UE9Xa2NhZU5kVER6V2ZER0lBeHhVcUpaQUlzcjlWekl5MUl4OWhLbXpZNA=='),(65,'a0NDMHFkSkw5dUJvSm0veU1DcG9Qdz09'),(66,'WnBiaG94aGpqajFQSWYvSWFYZ1N2cS9ZaHJodFF2UmxHWWUwTzBaMEgyOEx4TGM0Vld2SW1vMEtkc1hhTjJOcTVwKy9lOVorUE9kQmNycGY2TGpxOGZlWlZWbHZoVC9NKzJNWmNqUzROU2d3OVJsU2dJWW82dTAzRm5HOUVQL0FtZVlFMUtlQnNpZEFIZllrSklFTDNnPT0='),(67,'a25sM0hwM2MzMjdSSGJ2YVc5cW1FS0Rxa2I0bVdkTjlUQmFQTTRnaExrM2NPUUxOWmFFYlBrdmhpTG9pNU5VcQ=='),(68,'UlJtRWRqemVmeVl4d0JhazJxZVVhUT09'),(69,'K1l3K0UvazJESWZBYzJBbythVjdkdVdjWkc2Z2dBK29HcXZvWEdJa3VsRT0='),(70,'M1hXMHZNcTh6RDk3N01DTFFnbWhjQkhKUUZjNk44eGFKaU8yWDRDb0ZKVT0='),(71,'R1M2RjZDR0xSY3pZdXpJTTFTd3ZSZz09'),(72,'S2M1aUVLS1NUWW5BQ0JMZnpYcW5FZz09'),(73,'bDAyTzlxNW5VOEpyQjVQVEI1UmVUb0hyZXYrREEzTHYvNTVpZ3JOZ21oeVR5RklZWlFjK2RuQ2h2ckEzL3NvVQ=='),(74,'bUY5a3c3L2dtYk5GWndtaURGMDgyVERLbStVQWRyNmFURi9NU0NKTGprdjZ0SHIwb3kvL1Z0azhRbkNxRVNCUg=='),(75,'TlZXWEdIUDhqdWJ1aVJ5Z0laZWpXZTdYRFFCWjdCTlhzcFdCZHlKV2FKdHY4TFpOL1VIU0hDZzdZTmQ1NlJjMA=='),(76,'MmVHUTJBR2RFalEyNXJmVnM2eldidz09'),(77,'blVWdFlYdUMvQ1FpbVBPbFdWeDZlelE4bWI0bWVnYXYyN2YvSmluekVKUT0='),(78,'SExPTXQ1aGdIaCt0SlBjY3laZG5Pa2VNamlqZEY3VTV4SXZZaDJFVlNFRT0='),(79,'elJEL0d1UUEwb2Z3T0h6YlRhWmZPamlrNlpSMVYzTWlkSzZuTmhGREw2R2QrV1NUM1Z1b0xKN2MvbHVnaUROVA=='),(80,'d2huNE83dGNiWnJsNWM2SjJSMG02eHlVLyttUXg0R3Z1WU1wRGJEOWcwdz0='),(81,'K3NIY0w5bFVWanJBa3VTZlhUbS9DUUQwMjhibXplc3ZTaFlGR3A5RXphbDJwb2FQSHUvUlo5bkNITzBWMHc4TA=='),(82,'d3JJQ0JNSmNtSGRzbU43U1pQK09MYUhJZms3S3pNYUVpUGtjMncrei9Ydz0='),(83,'WUxzTFhiOEJQN2wrT1B0TFlQZ01rV0ZFbXVvYVYzLzNDYTFYaUVUVUR6SVRRWTA4YUlnNEZaTFNDbVVpN0hrcQ=='),(84,'d3JJQ0JNSmNtSGRzbU43U1pQK09MVEtlVDA2eFd1RHhueER1dTk5K2p0djNYVnBhR2lKcmxtQW5qMUhnQTVhZUh0MHhnVzZqSmgzeGtMNS93WFpHQlE9PQ=='),(85,'ODk3d3pkNjBtaVFSMEFPZWMwTmYvblVzU1FWbXVRK1pscEE3UWMrQVVsRT0='),(86,'ODk3d3pkNjBtaVFSMEFPZWMwTmYvbFd3MlZHOGhWQ3NkeFErVUFxZnNZZz0='),(87,'d3JJQ0JNSmNtSGRzbU43U1pQK09MWkcxdXkrSFFjcys4WHdsNDMxeFh2UjFiSXVXaEJrQXFQQ3RaYTF0MklTajNqdTdGOGxEVUM3d2t5MUJ4ajluNFRqS1cyWTJUQzZwWGxoSlVFWFBWd21hdjB0aERVODVJR2RnMmNVQXVUSE4='),(88,'dysyU0ZsS2Qvbjd2Sk9QbkorTTlYQT09'),(89,'a25sM0hwM2MzMjdSSGJ2YVc5cW1FREhJNUJzR0VZbjgzNjhUblZkanRHMEpnTVNkSXd1ZTlEY1R6WDkySk1oLzJqdjhSNFB3Mk42dldDYXUxYm9VWHc9PQ=='),(90,'UzM5N05RZXg3Y1RiQ0daM1BwNlF3TlFnSm9TUm5JZWhlcHd5OXkyNmFUVT0='),(91,'bFNpd0xsWUg2VDk3VkNidlkyNHlaUT09'),(92,'d3JJQ0JNSmNtSGRzbU43U1pQK09MVWZxNWlDbkFRNUU2MHlpbXpkR2tFZUtENVgwelVqd0t5T08zY3p5Y3E0TA=='),(93,'bnlCTTJZT2drVGErRWNST2p3Q3lFSWQ5eXY1cFpyM0M5N0dwM2tXRmdGalM0MnpGK3Z6Y1ZhK09NOCtya2JmMmZ4Mk05aVM2cjlMSXNFSmdYTE8wQWU3U1dnQUc0OCtOS0VrWFRNR2xrMWs9');
/*!40000 ALTER TABLE `pms_finish` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-26 15:28:52