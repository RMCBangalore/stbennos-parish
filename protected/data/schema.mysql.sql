-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: parish
-- ------------------------------------------------------
-- Server version	5.5.28-1

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
-- Table structure for table `AuthAssignment`
--

DROP TABLE IF EXISTS `AuthAssignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `AuthItem`
--

DROP TABLE IF EXISTS `AuthItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `AuthItemChild`
--

DROP TABLE IF EXISTS `AuthItemChild`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Rights`
--

DROP TABLE IF EXISTS `Rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `Rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awareness_data`
--

DROP TABLE IF EXISTS `awareness_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awareness_data` (
  `family_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aware` tinyint(4) DEFAULT NULL,
  `accessed` tinyint(4) DEFAULT NULL,
  `awareness_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `awareness_id` (`awareness_id`),
  CONSTRAINT `awareness_data_ibfk_1` FOREIGN KEY (`awareness_id`) REFERENCES `awareness_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `awareness_items`
--

DROP TABLE IF EXISTS `awareness_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awareness_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `banns`
--

DROP TABLE IF EXISTS `banns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groom_name` varchar(100) NOT NULL,
  `groom_parent` varchar(100) DEFAULT NULL,
  `groom_parish` varchar(50) DEFAULT NULL,
  `bride_name` varchar(100) NOT NULL,
  `bride_parent` varchar(100) DEFAULT NULL,
  `bride_parish` varchar(50) DEFAULT NULL,
  `banns_dt1` date DEFAULT NULL,
  `banns_dt2` date DEFAULT NULL,
  `banns_dt3` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `banns_requests`
--

DROP TABLE IF EXISTS `banns_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banns_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banns_id` int(11) DEFAULT NULL,
  `req_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banns_id` (`banns_id`),
  CONSTRAINT `banns_requests_ibfk_1` FOREIGN KEY (`banns_id`) REFERENCES `banns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `banns_responses`
--

DROP TABLE IF EXISTS `banns_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banns_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banns_id` int(11) DEFAULT NULL,
  `res_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banns_id` (`banns_id`),
  CONSTRAINT `banns_responses_ibfk_1` FOREIGN KEY (`banns_id`) REFERENCES `banns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `baptism_certs`
--

DROP TABLE IF EXISTS `baptism_certs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baptism_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_dt` date DEFAULT NULL,
  `baptism_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `baptism_id` (`baptism_id`),
  CONSTRAINT `baptism_certs_ibfk_1` FOREIGN KEY (`baptism_id`) REFERENCES `baptisms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `baptisms`
--

DROP TABLE IF EXISTS `baptisms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baptisms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dob` date DEFAULT NULL,
  `baptism_dt` date DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `fathers_name` varchar(75) DEFAULT NULL,
  `mothers_name` varchar(75) DEFAULT NULL,
  `residence` varchar(25) DEFAULT NULL,
  `godfathers_name` varchar(75) DEFAULT NULL,
  `godmothers_name` varchar(75) DEFAULT NULL,
  `minister` varchar(75) DEFAULT NULL,
  `ref_no` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `confirmation_certs`
--

DROP TABLE IF EXISTS `confirmation_certs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `confirmation_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_dt` date DEFAULT NULL,
  `confirmation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `confirmation_id` (`confirmation_id`),
  CONSTRAINT `confirmation_certs_ibfk_1` FOREIGN KEY (`confirmation_id`) REFERENCES `confirmations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `confirmations`
--

DROP TABLE IF EXISTS `confirmations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `confirmations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `confirmation_dt` date DEFAULT NULL,
  `church` varchar(50) DEFAULT NULL,
  `ref_no` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `death_certs`
--

DROP TABLE IF EXISTS `death_certs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `death_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `death_id` int(11) NOT NULL,
  `cert_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `death_cert_death` (`death_id`),
  CONSTRAINT `death_cert_death` FOREIGN KEY (`death_id`) REFERENCES `deaths` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `deaths`
--

DROP TABLE IF EXISTS `deaths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deaths` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `death_dt` date NOT NULL,
  `cause` varchar(100) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `age` float DEFAULT NULL,
  `profession` varchar(25) DEFAULT NULL,
  `buried_dt` date DEFAULT NULL,
  `minister` varchar(75) DEFAULT NULL,
  `burial_place` varchar(25) DEFAULT NULL,
  `ref_no` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `families`
--

DROP TABLE IF EXISTS `families`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `families` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` varchar(11) DEFAULT NULL,
  `addr_nm` varchar(50) DEFAULT NULL,
  `addr_stt` varchar(50) DEFAULT NULL,
  `addr_area` varchar(25) DEFAULT NULL,
  `addr_pin` varchar(7) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `zone` int(11) DEFAULT NULL,
  `yr_reg` int(11) DEFAULT NULL,
  `bpl_card` bit(1) DEFAULT NULL,
  `marriage_church` varchar(50) DEFAULT NULL,
  `marriage_date` date DEFAULT NULL,
  `marriage_type` varchar(25) DEFAULT NULL,
  `marriage_status` varchar(25) DEFAULT NULL,
  `monthly_income` varchar(15) DEFAULT NULL,
  `husband_id` int(11) DEFAULT NULL,
  `wife_id` int(11) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `gmap_url` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fid` (`fid`),
  KEY `husband_id` (`husband_id`),
  KEY `wife_id` (`wife_id`),
  CONSTRAINT `families_ibfk_1` FOREIGN KEY (`husband_id`) REFERENCES `people` (`id`),
  CONSTRAINT `families_ibfk_2` FOREIGN KEY (`wife_id`) REFERENCES `people` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `field_names`
--

DROP TABLE IF EXISTS `field_names`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `field_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `field_values`
--

DROP TABLE IF EXISTS `field_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `field_values` (
  `field_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `field_id` (`field_id`,`code`),
  UNIQUE KEY `field_id_2` (`field_id`,`name`),
  UNIQUE KEY `field_id_3` (`field_id`,`pos`),
  CONSTRAINT `field_values_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `field_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `first_communion_certs`
--

DROP TABLE IF EXISTS `first_communion_certs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `first_communion_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_dt` date DEFAULT NULL,
  `first_comm_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `first_comm_id` (`first_comm_id`),
  CONSTRAINT `first_communion_certs_ibfk_1` FOREIGN KEY (`first_comm_id`) REFERENCES `first_communions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `first_communions`
--

DROP TABLE IF EXISTS `first_communions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `first_communions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `church` varchar(50) DEFAULT NULL,
  `communion_dt` date DEFAULT NULL,
  `ref_no` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `marriage_certs`
--

DROP TABLE IF EXISTS `marriage_certs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marriage_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_dt` date DEFAULT NULL,
  `marriage_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `marriage_id` (`marriage_id`),
  CONSTRAINT `marriage_certs_ibfk_1` FOREIGN KEY (`marriage_id`) REFERENCES `marriages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `marriages`
--

DROP TABLE IF EXISTS `marriages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marriages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marriage_dt` date DEFAULT NULL,
  `groom_name` varchar(100) DEFAULT NULL,
  `groom_dob` date DEFAULT NULL,
  `groom_status` varchar(10) DEFAULT NULL,
  `groom_rank_prof` varchar(25) DEFAULT NULL,
  `groom_fathers_name` varchar(100) DEFAULT NULL,
  `groom_mothers_name` varchar(100) DEFAULT NULL,
  `groom_residence` varchar(25) DEFAULT NULL,
  `bride_name` varchar(100) DEFAULT NULL,
  `bride_dob` date DEFAULT NULL,
  `bride_status` varchar(10) DEFAULT NULL,
  `bride_rank_prof` varchar(25) DEFAULT NULL,
  `bride_fathers_name` varchar(100) DEFAULT NULL,
  `bride_mothers_name` varchar(100) DEFAULT NULL,
  `bride_residence` varchar(25) DEFAULT NULL,
  `banns_licence` varchar(10) DEFAULT NULL,
  `minister` varchar(100) DEFAULT NULL,
  `witness1` varchar(75) DEFAULT NULL,
  `witness2` varchar(75) DEFAULT NULL,
  `remarks` varchar(75) DEFAULT NULL,
  `ref_no` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `membership_certs`
--

DROP TABLE IF EXISTS `membership_certs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `cert_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `membership_certs_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `need_data`
--

DROP TABLE IF EXISTS `need_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `need_data` (
  `family_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `need_id` int(11) DEFAULT NULL,
  `need_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  KEY `need_id` (`need_id`),
  CONSTRAINT `need_data_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`),
  CONSTRAINT `need_data_ibfk_2` FOREIGN KEY (`need_id`) REFERENCES `need_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `need_items`
--

DROP TABLE IF EXISTS `need_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `need_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `no_impediment_letters`
--

DROP TABLE IF EXISTS `no_impediment_letters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `no_impediment_letters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banns_id` int(11) DEFAULT NULL,
  `letter_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banns_id` (`banns_id`),
  CONSTRAINT `no_impediment_letters_ibfk_1` FOREIGN KEY (`banns_id`) REFERENCES `banns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `open_data`
--

DROP TABLE IF EXISTS `open_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `open_data` (
  `family_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `family_id` (`family_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `open_data_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`),
  CONSTRAINT `open_data_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `open_questions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `open_questions`
--

DROP TABLE IF EXISTS `open_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `open_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text,
  `type` varchar(10) DEFAULT NULL,
  `seq` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `domicile_status` varchar(4) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `education` varchar(15) DEFAULT NULL,
  `profession` varchar(25) DEFAULT NULL,
  `occupation` varchar(25) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `lang_pri` varchar(25) DEFAULT NULL,
  `lang_lit` varchar(25) DEFAULT NULL,
  `lang_edu` varchar(25) DEFAULT NULL,
  `rite` varchar(25) DEFAULT NULL,
  `baptism_dt` date DEFAULT NULL,
  `baptism_church` varchar(50) DEFAULT NULL,
  `baptism_place` varchar(15) DEFAULT NULL,
  `god_parents` varchar(50) DEFAULT NULL,
  `first_comm_dt` date DEFAULT NULL,
  `confirmation_dt` date DEFAULT NULL,
  `marriage_dt` date DEFAULT NULL,
  `cemetery_church` varchar(25) DEFAULT NULL,
  `family_id` int(11) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `special_skill` varchar(25) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `people_family_id` (`family_id`),
  CONSTRAINT `people_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `satisfaction_data`
--

DROP TABLE IF EXISTS `satisfaction_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `satisfaction_data` (
  `family_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `satisfaction_item_id` int(11) DEFAULT NULL,
  `satisfaction_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `satisfation_data_family` (`family_id`),
  KEY `satisfaction_data_item` (`satisfaction_item_id`),
  CONSTRAINT `satisfaction_data_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`),
  CONSTRAINT `satisfaction_data_ibfk_2` FOREIGN KEY (`satisfaction_item_id`) REFERENCES `satisfaction_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `satisfaction_items`
--

DROP TABLE IF EXISTS `satisfaction_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `satisfaction_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) DEFAULT NULL,
  `password` char(64) DEFAULT NULL,
  `superuser` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthAssignment`
--

LOCK TABLES `AuthAssignment` WRITE;
/*!40000 ALTER TABLE `AuthAssignment` DISABLE KEYS */;
INSERT INTO `AuthAssignment` VALUES ('Admin','1',NULL,'N;');
/*!40000 ALTER TABLE `AuthAssignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `AuthItem`
--

LOCK TABLES `AuthItem` WRITE;
/*!40000 ALTER TABLE `AuthItem` DISABLE KEYS */;
INSERT INTO `AuthItem` VALUES ('Admin',2,NULL,NULL,'N;'),('Authenticated',2,NULL,NULL,'N;'),('AwarenessData.*',1,NULL,NULL,'N;'),('AwarenessData.Admin',0,NULL,NULL,'N;'),('AwarenessData.Create',0,NULL,NULL,'N;'),('AwarenessData.Delete',0,NULL,NULL,'N;'),('AwarenessData.Index',0,NULL,NULL,'N;'),('AwarenessData.Update',0,NULL,NULL,'N;'),('AwarenessData.View',0,NULL,NULL,'N;'),('AwarenessItems.*',1,NULL,NULL,'N;'),('AwarenessItems.Admin',0,NULL,NULL,'N;'),('AwarenessItems.Create',0,NULL,NULL,'N;'),('AwarenessItems.Delete',0,NULL,NULL,'N;'),('AwarenessItems.Index',0,NULL,NULL,'N;'),('AwarenessItems.Update',0,NULL,NULL,'N;'),('AwarenessItems.View',0,NULL,NULL,'N;'),('BaptismCertificate.*',1,NULL,NULL,'N;'),('BaptismCertificate.Admin',0,NULL,NULL,'N;'),('BaptismCertificate.Create',0,NULL,NULL,'N;'),('BaptismCertificate.Delete',0,NULL,NULL,'N;'),('BaptismCertificate.Index',0,NULL,NULL,'N;'),('BaptismCertificate.Update',0,NULL,NULL,'N;'),('BaptismCertificate.View',0,NULL,NULL,'N;'),('BaptismCertificate.ViewCert',0,NULL,NULL,'N;'),('BaptismRecords.*',1,NULL,NULL,'N;'),('BaptismRecords.Admin',0,NULL,NULL,'N;'),('BaptismRecords.Create',0,NULL,NULL,'N;'),('BaptismRecords.Delete',0,NULL,NULL,'N;'),('BaptismRecords.Index',0,NULL,NULL,'N;'),('BaptismRecords.Update',0,NULL,NULL,'N;'),('BaptismRecords.View',0,NULL,NULL,'N;'),('ConfirmationCertificate.*',1,NULL,NULL,'N;'),('ConfirmationCertificate.Admin',0,NULL,NULL,'N;'),('ConfirmationCertificate.Create',0,NULL,NULL,'N;'),('ConfirmationCertificate.Delete',0,NULL,NULL,'N;'),('ConfirmationCertificate.Index',0,NULL,NULL,'N;'),('ConfirmationCertificate.Update',0,NULL,NULL,'N;'),('ConfirmationCertificate.View',0,NULL,NULL,'N;'),('ConfirmationCertificate.ViewCert',0,NULL,NULL,'N;'),('ConfirmationRecords.*',1,NULL,NULL,'N;'),('ConfirmationRecords.Admin',0,NULL,NULL,'N;'),('ConfirmationRecords.Create',0,NULL,NULL,'N;'),('ConfirmationRecords.Delete',0,NULL,NULL,'N;'),('ConfirmationRecords.Index',0,NULL,NULL,'N;'),('ConfirmationRecords.Update',0,NULL,NULL,'N;'),('ConfirmationRecords.View',0,NULL,NULL,'N;'),('DeathCertificate.*',1,NULL,NULL,'N;'),('DeathCertificate.Admin',0,NULL,NULL,'N;'),('DeathCertificate.Create',0,NULL,NULL,'N;'),('DeathCertificate.Delete',0,NULL,NULL,'N;'),('DeathCertificate.Index',0,NULL,NULL,'N;'),('DeathCertificate.Update',0,NULL,NULL,'N;'),('DeathCertificate.View',0,NULL,NULL,'N;'),('DeathCertificate.ViewCert',0,NULL,NULL,'N;'),('DeathRecords.*',1,NULL,NULL,'N;'),('DeathRecords.Admin',0,NULL,NULL,'N;'),('DeathRecords.Create',0,NULL,NULL,'N;'),('DeathRecords.Delete',0,NULL,NULL,'N;'),('DeathRecords.Index',0,NULL,NULL,'N;'),('DeathRecords.Update',0,NULL,NULL,'N;'),('DeathRecords.View',0,NULL,NULL,'N;'),('Family.*',1,NULL,NULL,'N;'),('Family.Admin',0,NULL,NULL,'N;'),('Family.Children',0,NULL,NULL,'N;'),('Family.Create',0,NULL,NULL,'N;'),('Family.Delete',0,NULL,NULL,'N;'),('Family.Index',0,NULL,NULL,'N;'),('Family.Survey',0,NULL,NULL,'N;'),('Family.Update',0,NULL,NULL,'N;'),('Family.View',0,NULL,NULL,'N;'),('FieldName.*',1,NULL,NULL,'N;'),('FieldName.Admin',0,NULL,NULL,'N;'),('FieldName.Create',0,NULL,NULL,'N;'),('FieldName.Delete',0,NULL,NULL,'N;'),('FieldName.Index',0,NULL,NULL,'N;'),('FieldName.Update',0,NULL,NULL,'N;'),('FieldName.View',0,NULL,NULL,'N;'),('FieldValue.*',1,NULL,NULL,'N;'),('FieldValue.Admin',0,NULL,NULL,'N;'),('FieldValue.Create',0,NULL,NULL,'N;'),('FieldValue.Delete',0,NULL,NULL,'N;'),('FieldValue.Index',0,NULL,NULL,'N;'),('FieldValue.Update',0,NULL,NULL,'N;'),('FieldValue.View',0,NULL,NULL,'N;'),('FirstCommunionCertificate.*',1,NULL,NULL,'N;'),('FirstCommunionCertificate.Admin',0,NULL,NULL,'N;'),('FirstCommunionCertificate.Create',0,NULL,NULL,'N;'),('FirstCommunionCertificate.Delete',0,NULL,NULL,'N;'),('FirstCommunionCertificate.Index',0,NULL,NULL,'N;'),('FirstCommunionCertificate.Update',0,NULL,NULL,'N;'),('FirstCommunionCertificate.View',0,NULL,NULL,'N;'),('FirstCommunionCertificate.ViewCert',0,NULL,NULL,'N;'),('FirstCommunionRecords.*',1,NULL,NULL,'N;'),('FirstCommunionRecords.Admin',0,NULL,NULL,'N;'),('FirstCommunionRecords.Create',0,NULL,NULL,'N;'),('FirstCommunionRecords.Delete',0,NULL,NULL,'N;'),('FirstCommunionRecords.Index',0,NULL,NULL,'N;'),('FirstCommunionRecords.Update',0,NULL,NULL,'N;'),('FirstCommunionRecords.View',0,NULL,NULL,'N;'),('Guest',2,NULL,NULL,'N;'),('MarriageCertificate.*',1,NULL,NULL,'N;'),('MarriageCertificate.Admin',0,NULL,NULL,'N;'),('MarriageCertificate.Create',0,NULL,NULL,'N;'),('MarriageCertificate.Delete',0,NULL,NULL,'N;'),('MarriageCertificate.Index',0,NULL,NULL,'N;'),('MarriageCertificate.Update',0,NULL,NULL,'N;'),('MarriageCertificate.View',0,NULL,NULL,'N;'),('MarriageCertificate.ViewCert',0,NULL,NULL,'N;'),('MarriageRecords.*',1,NULL,NULL,'N;'),('MarriageRecords.Admin',0,NULL,NULL,'N;'),('MarriageRecords.Create',0,NULL,NULL,'N;'),('MarriageRecords.Delete',0,NULL,NULL,'N;'),('MarriageRecords.Index',0,NULL,NULL,'N;'),('MarriageRecords.Update',0,NULL,NULL,'N;'),('MarriageRecords.View',0,NULL,NULL,'N;'),('NeedData.*',1,NULL,NULL,'N;'),('NeedData.Admin',0,NULL,NULL,'N;'),('NeedData.Create',0,NULL,NULL,'N;'),('NeedData.Delete',0,NULL,NULL,'N;'),('NeedData.Index',0,NULL,NULL,'N;'),('NeedData.Update',0,NULL,NULL,'N;'),('NeedData.View',0,NULL,NULL,'N;'),('NeedItems.*',1,NULL,NULL,'N;'),('NeedItems.Admin',0,NULL,NULL,'N;'),('NeedItems.Create',0,NULL,NULL,'N;'),('NeedItems.Delete',0,NULL,NULL,'N;'),('NeedItems.Index',0,NULL,NULL,'N;'),('NeedItems.Update',0,NULL,NULL,'N;'),('NeedItems.View',0,NULL,NULL,'N;'),('OpenData.*',1,NULL,NULL,'N;'),('OpenData.Admin',0,NULL,NULL,'N;'),('OpenData.Create',0,NULL,NULL,'N;'),('OpenData.Delete',0,NULL,NULL,'N;'),('OpenData.Index',0,NULL,NULL,'N;'),('OpenData.Update',0,NULL,NULL,'N;'),('OpenData.View',0,NULL,NULL,'N;'),('OpenQuestion.*',1,NULL,NULL,'N;'),('OpenQuestion.Admin',0,NULL,NULL,'N;'),('OpenQuestion.Create',0,NULL,NULL,'N;'),('OpenQuestion.Delete',0,NULL,NULL,'N;'),('OpenQuestion.Index',0,NULL,NULL,'N;'),('OpenQuestion.Update',0,NULL,NULL,'N;'),('OpenQuestion.View',0,NULL,NULL,'N;'),('OpenQuestions.*',1,NULL,NULL,'N;'),('OpenQuestions.Admin',0,NULL,NULL,'N;'),('OpenQuestions.Create',0,NULL,NULL,'N;'),('OpenQuestions.Delete',0,NULL,NULL,'N;'),('OpenQuestions.Index',0,NULL,NULL,'N;'),('OpenQuestions.Update',0,NULL,NULL,'N;'),('OpenQuestions.View',0,NULL,NULL,'N;'),('Pastor',2,'Pastor',NULL,'N;'),('Person.*',1,NULL,NULL,'N;'),('Person.Admin',0,NULL,NULL,'N;'),('Person.Baptised',0,NULL,NULL,'N;'),('Person.Confirmed',0,NULL,NULL,'N;'),('Person.Create',0,NULL,NULL,'N;'),('Person.Delete',0,NULL,NULL,'N;'),('Person.Index',0,NULL,NULL,'N;'),('Person.Married',0,NULL,NULL,'N;'),('Person.Update',0,NULL,NULL,'N;'),('Person.View',0,NULL,NULL,'N;'),('SatisfactionData.*',1,NULL,NULL,'N;'),('SatisfactionData.Admin',0,NULL,NULL,'N;'),('SatisfactionData.Create',0,NULL,NULL,'N;'),('SatisfactionData.Delete',0,NULL,NULL,'N;'),('SatisfactionData.Index',0,NULL,NULL,'N;'),('SatisfactionData.Update',0,NULL,NULL,'N;'),('SatisfactionData.View',0,NULL,NULL,'N;'),('SatisfactionItem.*',1,NULL,NULL,'N;'),('SatisfactionItem.Admin',0,NULL,NULL,'N;'),('SatisfactionItem.Create',0,NULL,NULL,'N;'),('SatisfactionItem.Delete',0,NULL,NULL,'N;'),('SatisfactionItem.Index',0,NULL,NULL,'N;'),('SatisfactionItem.Update',0,NULL,NULL,'N;'),('SatisfactionItem.View',0,NULL,NULL,'N;'),('SatisfactionItems.*',1,NULL,NULL,'N;'),('SatisfactionItems.Admin',0,NULL,NULL,'N;'),('SatisfactionItems.Create',0,NULL,NULL,'N;'),('SatisfactionItems.Delete',0,NULL,NULL,'N;'),('SatisfactionItems.Index',0,NULL,NULL,'N;'),('SatisfactionItems.Update',0,NULL,NULL,'N;'),('SatisfactionItems.View',0,NULL,NULL,'N;'),('Site.*',1,NULL,NULL,'N;'),('Site.Contact',0,NULL,NULL,'N;'),('Site.Error',0,NULL,NULL,'N;'),('Site.Index',0,NULL,NULL,'N;'),('Site.Login',0,NULL,NULL,'N;'),('Site.Logout',0,NULL,NULL,'N;'),('Staff',2,'Staff',NULL,'N;'),('User.Activation.*',1,NULL,NULL,'N;'),('User.Activation.Activation',0,NULL,NULL,'N;'),('User.Admin.*',1,NULL,NULL,'N;'),('User.Admin.Admin',0,NULL,NULL,'N;'),('User.Admin.Create',0,NULL,NULL,'N;'),('User.Admin.Delete',0,NULL,NULL,'N;'),('User.Admin.Update',0,NULL,NULL,'N;'),('User.Admin.View',0,NULL,NULL,'N;'),('User.Default.*',1,NULL,NULL,'N;'),('User.Default.Index',0,NULL,NULL,'N;'),('User.Login.*',1,NULL,NULL,'N;'),('User.Login.Login',0,NULL,NULL,'N;'),('User.Logout.*',1,NULL,NULL,'N;'),('User.Logout.Logout',0,NULL,NULL,'N;'),('User.Profile.*',1,NULL,NULL,'N;'),('User.Profile.Changepassword',0,NULL,NULL,'N;'),('User.Profile.Edit',0,NULL,NULL,'N;'),('User.Profile.Profile',0,NULL,NULL,'N;'),('User.ProfileField.*',1,NULL,NULL,'N;'),('User.ProfileField.Admin',0,NULL,NULL,'N;'),('User.ProfileField.Create',0,NULL,NULL,'N;'),('User.ProfileField.Delete',0,NULL,NULL,'N;'),('User.ProfileField.Update',0,NULL,NULL,'N;'),('User.ProfileField.View',0,NULL,NULL,'N;'),('User.Recovery.*',1,NULL,NULL,'N;'),('User.Recovery.Recovery',0,NULL,NULL,'N;'),('User.Registration.*',1,NULL,NULL,'N;'),('User.Registration.Registration',0,NULL,NULL,'N;'),('User.User.*',1,NULL,NULL,'N;'),('User.User.Index',0,NULL,NULL,'N;'),('User.User.View',0,NULL,NULL,'N;'),('Users.*',1,NULL,NULL,'N;'),('Users.Admin',0,NULL,NULL,'N;'),('Users.Create',0,NULL,NULL,'N;'),('Users.Delete',0,NULL,NULL,'N;'),('Users.Index',0,NULL,NULL,'N;'),('Users.Update',0,NULL,NULL,'N;'),('Users.View',0,NULL,NULL,'N;'),('YesnoData.*',1,NULL,NULL,'N;'),('YesnoData.Admin',0,NULL,NULL,'N;'),('YesnoData.Create',0,NULL,NULL,'N;'),('YesnoData.Delete',0,NULL,NULL,'N;'),('YesnoData.Index',0,NULL,NULL,'N;'),('YesnoData.Update',0,NULL,NULL,'N;'),('YesnoData.View',0,NULL,NULL,'N;'),('YesnoQuestion.*',1,NULL,NULL,'N;'),('YesnoQuestion.Admin',0,NULL,NULL,'N;'),('YesnoQuestion.Create',0,NULL,NULL,'N;'),('YesnoQuestion.Delete',0,NULL,NULL,'N;'),('YesnoQuestion.Index',0,NULL,NULL,'N;'),('YesnoQuestion.Update',0,NULL,NULL,'N;'),('YesnoQuestion.View',0,NULL,NULL,'N;');
/*!40000 ALTER TABLE `AuthItem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `AuthItemChild`
--

LOCK TABLES `AuthItemChild` WRITE;
/*!40000 ALTER TABLE `AuthItemChild` DISABLE KEYS */;
INSERT INTO `AuthItemChild` VALUES ('Staff','Authenticated'),('Admin','AwarenessData.*'),('Admin','AwarenessItems.*'),('Admin','BaptismCertificate.*'),('Admin','BaptismRecords.*'),('Admin','ConfirmationCertificate.*'),('Admin','ConfirmationRecords.*'),('Admin','Family.*'),('Staff','Family.Children'),('Staff','Family.Create'),('Authenticated','Family.Index'),('Staff','Family.Survey'),('Staff','Family.Update'),('Authenticated','Family.View'),('Admin','FieldName.*'),('Admin','FieldValue.*'),('Admin','FirstCommunionCertificate.*'),('Admin','FirstCommunionRecords.*'),('Admin','MarriageCertificate.*'),('Admin','MarriageRecords.*'),('Admin','NeedData.*'),('Admin','NeedItems.*'),('Admin','OpenData.*'),('Admin','OpenQuestion.*'),('Admin','OpenQuestions.*'),('Admin','Person.*'),('Pastor','Person.Admin'),('Staff','Person.Baptised'),('Staff','Person.Confirmed'),('Staff','Person.Create'),('Pastor','Person.Delete'),('Staff','Person.Index'),('Staff','Person.Married'),('Staff','Person.Update'),('Staff','Person.View'),('Admin','SatisfactionData.*'),('Admin','SatisfactionItem.*'),('Admin','SatisfactionItems.*'),('Admin','Site.*'),('Authenticated','Site.Contact'),('Authenticated','Site.Error'),('Authenticated','Site.Index'),('Guest','Site.Index'),('Guest','Site.Login'),('Authenticated','Site.Logout'),('Pastor','Staff'),('Admin','User.Activation.*'),('Admin','User.Admin.*'),('Admin','User.Default.*'),('Admin','User.Login.*'),('Admin','User.Logout.*'),('Admin','User.Profile.*'),('Admin','User.ProfileField.*'),('Admin','User.Recovery.*'),('Admin','User.Registration.*'),('Admin','User.User.*'),('Admin','Users.*'),('Admin','YesnoData.*'),('Admin','YesnoQuestion.*');
/*!40000 ALTER TABLE `AuthItemChild` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `awareness_items`
--

LOCK TABLES `awareness_items` WRITE;
/*!40000 ALTER TABLE `awareness_items` DISABLE KEYS */;
INSERT INTO `awareness_items` VALUES (1,'Employment bureau'),(2,'Counselling center'),(3,'Youth groups'),(4,'Society of Vincent de Paul'),(5,'Parish website'),(6,'Ladies of charity'),(7,'Marriage bureau'),(8,'Legion of Mary');
/*!40000 ALTER TABLE `awareness_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `field_names`
--

LOCK TABLES `field_names` WRITE;
/*!40000 ALTER TABLE `field_names` DISABLE KEYS */;
INSERT INTO `field_names` VALUES (14,'awareness_level'),(11,'domicile_status'),(3,'education'),(5,'languages'),(2,'marriage_status'),(1,'marriage_type'),(4,'monthly_household_income'),(8,'need_level'),(6,'rite'),(7,'satisfaction_level'),(13,'sex'),(10,'zones');
/*!40000 ALTER TABLE `field_names` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `field_values`
--

LOCK TABLES `field_values` WRITE;
/*!40000 ALTER TABLE `field_values` DISABLE KEYS */;
INSERT INTO `field_values` VALUES (1,1,'Regular',1,1),(1,2,'Irregular',2,2),(2,3,'Married',1,1),(2,4,'Separated',2,2),(2,5,'Divorced',3,3),(2,6,'Widowed',4,4),(1,7,'Disparity of cult',3,3),(3,8,'< High School',1,1),(3,9,'High School',2,2),(3,10,'Graduate',3,3),(3,11,'Post Graduate',4,4),(4,12,'< 10000',1,1),(4,13,'10k - 50k',2,2),(4,14,'50k - 1 lakh',3,3),(4,15,'above 1 lakh',4,4),(5,16,'English',1,1),(5,17,'Kannada',2,2),(5,18,'Tamil',3,3),(6,19,'Syro Malabar',1,1),(6,20,'Syro Malankara',2,2),(7,21,'Very Dissatisfied',1,1),(7,23,'Dissatisfied',2,2),(7,24,'Neutral',3,3),(7,25,'Satisfied',4,4),(7,26,'Very Satisfied',5,5),(8,27,'Not Important',1,1),(8,28,'Important',2,2),(8,29,'Very Important',3,3),(8,30,'Dissatisfied',4,4),(8,31,'Will join/attend',5,5),(10,32,'Zone A',1,1),(10,33,'Zone B',2,2),(10,34,'Zone C',3,3),(10,35,'Zone D',4,4),(11,36,'Home',1,1),(11,37,'Away',2,2),(13,38,'Male',1,1),(13,39,'Female',2,2),(14,40,'Accessed',1,1),(14,41,'Aware',2,2);
/*!40000 ALTER TABLE `field_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `need_items`
--

LOCK TABLES `need_items` WRITE;
/*!40000 ALTER TABLE `need_items` DISABLE KEYS */;
INSERT INTO `need_items` VALUES (1,'Bible study'),(2,'Night vigil'),(3,'Legal aid'),(4,'Catholic enquiry center'),(5,'Intercession group (prayer warrior)'),(6,'Regular retreats'),(7,'Social media interaction'),(8,'Basic Christian Community'),(9,'Mission, etc'),(10,'Apologetics center'),(11,'Sacraments for inbound members (sick, elderly)');
/*!40000 ALTER TABLE `need_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `open_questions`
--

LOCK TABLES `open_questions` WRITE;
/*!40000 ALTER TABLE `open_questions` DISABLE KEYS */;
INSERT INTO `open_questions` VALUES (1,'Are you attending a Bible study?','yesno',1),(2,'If yes, specify (catholic / other denomination)','string',2),(3,'Do you attend periodic retreats / prayer group meetings?','yesno',3),(4,'If yes, specify (catholic / other denomination)','string',4),(5,'Do your children attend Sunday school (catechism)?','yesno',5),(6,'Do you attend Novena services regularly?','yesno',6),(7,'Have you availed medical aid from the parish?','yesno',7),(8,'Have you availed education support from the parish?','yesno',8),(9,'Do you attend worship at any other non catholic church?','yesno',9),(10,'If yes, how many times a month?','integer',10),(11,'How often do you attend Mass per month?','integer',11),(12,'What is the ideal frequency for receiving the Sacrament of Reconciliation?','string',12);
/*!40000 ALTER TABLE `open_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `satisfaction_items`
--

LOCK TABLES `satisfaction_items` WRITE;
/*!40000 ALTER TABLE `satisfaction_items` DISABLE KEYS */;
INSERT INTO `satisfaction_items` VALUES (1,'Service'),(2,'Preaching & message'),(3,'Novena'),(4,'Choir'),(5,'Ushering'),(6,'Lectors'),(7,'Decorations arrangement'),(8,'Adoration'),(9,'Sunday school'),(10,'Preparation for Sacraments'),(11,'Adult Catechesis'),(12,'Bible study'),(13,'Retreats'),(14,'Parish website');
/*!40000 ALTER TABLE `satisfaction_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2a$13$mK/NQ8zDctQS.8UxwEdcqOnPK3Hq7QGoLXaqnwlEtLGYL9nXUZ0X.',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-05 16:18:29
