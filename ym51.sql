-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: rookiebug
-- ------------------------------------------------------
-- Server version	5.5.62-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `rookie_admin`
--

DROP TABLE IF EXISTS `rookie_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rookie_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `keys` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rookie_admin`
--

LOCK TABLES `rookie_admin` WRITE;
/*!40000 ALTER TABLE `rookie_admin` DISABLE KEYS */;
INSERT INTO `rookie_admin` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',NULL);
/*!40000 ALTER TABLE `rookie_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rookie_app`
--

DROP TABLE IF EXISTS `rookie_app`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rookie_app` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `tion` varchar(255) DEFAULT NULL COMMENT '版本',
  `logo` varchar(255) DEFAULT NULL COMMENT '图标',
  `time` varchar(255) DEFAULT NULL COMMENT '发布时间',
  `pack` varchar(255) DEFAULT NULL COMMENT '包名',
  `down` varchar(255) DEFAULT NULL COMMENT '下载地址',
  `userid` varchar(255) DEFAULT NULL COMMENT '属于哪个用户',
  `down_lz` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rookie_app`
--

LOCK TABLES `rookie_app` WRITE;
/*!40000 ALTER TABLE `rookie_app` DISABLE KEYS */;
INSERT INTO `rookie_app` VALUES (60,'菜鸟应用模板','1.0.0.5','./img/1659c2324f797d1f5d412c525ef96d19.png','1631198300','com.rookie.app.yppfmxz','/user_apk/rookie3cc4ddfbd1a851302b16177625a602eb.apk','1','https://wwx.lanzoui.com/ijF1Rttbc2d');
/*!40000 ALTER TABLE `rookie_app` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rookie_config`
--

DROP TABLE IF EXISTS `rookie_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rookie_config` (
  `cookie` varchar(255) DEFAULT NULL,
  `upcode` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rookie_config`
--

LOCK TABLES `rookie_config` WRITE;
/*!40000 ALTER TABLE `rookie_config` DISABLE KEYS */;
INSERT INTO `rookie_config` VALUES ('V2tVZ1E0AjtUYVU3DV5QO1M3UVpcNAdlVG9QOFdmCzFUYVJlAGMCO1RmA1oOY1szUzBQawFrXD0PO1dmBTECZVc1VWBRMQJrVDBVYw0zUDNTNlFkXDUHYlRuUGVXYgtsVGhSYQBlAjhUYgNjDl1bMFM2UGoBYFw8DzRXNgU2AjFXZlVn','true');
/*!40000 ALTER TABLE `rookie_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rookie_down`
--

DROP TABLE IF EXISTS `rookie_down`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rookie_down` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `gsd` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `down` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rookie_down`
--

LOCK TABLES `rookie_down` WRITE;
/*!40000 ALTER TABLE `rookie_down` DISABLE KEYS */;
/*!40000 ALTER TABLE `rookie_down` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rookie_png`
--

DROP TABLE IF EXISTS `rookie_png`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rookie_png` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rookie_png`
--

LOCK TABLES `rookie_png` WRITE;
/*!40000 ALTER TABLE `rookie_png` DISABLE KEYS */;
/*!40000 ALTER TABLE `rookie_png` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rookie_temp`
--

DROP TABLE IF EXISTS `rookie_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rookie_temp` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `tion` varchar(255) DEFAULT NULL,
  `pack` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `openpng` varchar(255) DEFAULT NULL,
  `opentime` varchar(255) DEFAULT NULL,
  `keys` varchar(255) DEFAULT NULL,
  `keysuser` varchar(255) DEFAULT NULL,
  `keyspass` varchar(255) DEFAULT NULL,
  `dq` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `state_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rookie_temp`
--

LOCK TABLES `rookie_temp` WRITE;
/*!40000 ALTER TABLE `rookie_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `rookie_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rookie_user`
--

DROP TABLE IF EXISTS `rookie_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rookie_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `keys` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rookie_user`
--

LOCK TABLES `rookie_user` WRITE;
/*!40000 ALTER TABLE `rookie_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `rookie_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-09 22:41:36
