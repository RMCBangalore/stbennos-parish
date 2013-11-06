--
-- This file is part of St. Benno's Parish Software
--
-- St. Benno's Parish Software - software to manage tomorrow's parish
-- Copyright (C) 2013  Redemptorist Media Center
--
-- St. Benno's Parish Software is free software: you can redistribute it
-- and/or modify it under the terms of the GNU General Public License as
-- published by the Free Software Foundation, either version 3 of the
-- License, or (at your option) any later version.
--
-- St. Benno's Parish Software is distributed in the hope that it will
-- be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
-- of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see <http://www.gnu.org/licenses/>.
--
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: parish
-- ------------------------------------------------------
-- Server version	5.5.31-0+wheezy1


--
-- Table structure for table `AuthAssignment`
--

DROP TABLE IF EXISTS `AuthAssignment`;
CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `AuthItem`
--

DROP TABLE IF EXISTS `AuthItem`;
CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `AuthItemChild`
--

DROP TABLE IF EXISTS `AuthItemChild`;
CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `Rights`
--

DROP TABLE IF EXISTS `Rights`;
CREATE TABLE `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `Rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `awareness_data`
--

DROP TABLE IF EXISTS `awareness_data`;
CREATE TABLE `awareness_data` (
  `family_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `awareness_id` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `awareness_id` (`awareness_id`),
  KEY `family_id` (`family_id`),
  CONSTRAINT `awareness_data_ibfk_1` FOREIGN KEY (`awareness_id`) REFERENCES `awareness_items` (`id`),
  CONSTRAINT `awareness_data_ibfk_2` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Table structure for table `awareness_items`
--

DROP TABLE IF EXISTS `awareness_items`;
CREATE TABLE `awareness_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Table structure for table `banns`
--

DROP TABLE IF EXISTS `banns`;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Table structure for table `banns_requests`
--

DROP TABLE IF EXISTS `banns_requests`;
CREATE TABLE `banns_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banns_id` int(11) DEFAULT NULL,
  `req_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banns_id` (`banns_id`),
  CONSTRAINT `banns_requests_ibfk_1` FOREIGN KEY (`banns_id`) REFERENCES `banns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `banns_responses`
--

DROP TABLE IF EXISTS `banns_responses`;
CREATE TABLE `banns_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banns_id` int(11) DEFAULT NULL,
  `res_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banns_id` (`banns_id`),
  CONSTRAINT `banns_responses_ibfk_1` FOREIGN KEY (`banns_id`) REFERENCES `banns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `baptism_certs`
--

DROP TABLE IF EXISTS `baptism_certs`;
CREATE TABLE `baptism_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_dt` date DEFAULT NULL,
  `baptism_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `baptism_id` (`baptism_id`),
  CONSTRAINT `baptism_certs_ibfk_1` FOREIGN KEY (`baptism_id`) REFERENCES `baptisms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `baptisms`
--

DROP TABLE IF EXISTS `baptisms`;
CREATE TABLE `baptisms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dob` date NOT NULL,
  `baptism_dt` date NOT NULL,
  `name` varchar(50) NOT NULL,
  `sex` int(11) NOT NULL,
  `fathers_name` varchar(75) NOT NULL,
  `mothers_name` varchar(75) NOT NULL,
  `residence` varchar(75) DEFAULT NULL,
  `godfathers_name` varchar(75) DEFAULT NULL,
  `godmothers_name` varchar(75) DEFAULT NULL,
  `minister` varchar(75) DEFAULT NULL,
  `ref_no` varchar(10) DEFAULT NULL,
  `baptism_place` varchar(50) DEFAULT NULL,
  `mother_tongue` varchar(25) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `baptisms_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `people` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Table structure for table `confirmation_certs`
--

DROP TABLE IF EXISTS `confirmation_certs`;
CREATE TABLE `confirmation_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_dt` date DEFAULT NULL,
  `confirmation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `confirmation_id` (`confirmation_id`),
  CONSTRAINT `confirmation_certs_ibfk_1` FOREIGN KEY (`confirmation_id`) REFERENCES `confirmations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `confirmations`
--

DROP TABLE IF EXISTS `confirmations`;
CREATE TABLE `confirmations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(10) DEFAULT NULL,
  `name` varchar(75) DEFAULT NULL,
  `confirmation_dt` date DEFAULT NULL,
  `church` varchar(50) DEFAULT NULL,
  `dob` date NOT NULL,
  `baptism_dt` date NOT NULL,
  `baptism_place` varchar(50) DEFAULT NULL,
  `parents_name` varchar(75) NOT NULL,
  `residence` varchar(50) DEFAULT NULL,
  `godparent_name` varchar(75) DEFAULT NULL,
  `minister` varchar(50) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `confirmations_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `people` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Table structure for table `death_certs`
--

DROP TABLE IF EXISTS `death_certs`;
CREATE TABLE `death_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `death_id` int(11) NOT NULL,
  `cert_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `death_cert_death` (`death_id`),
  CONSTRAINT `death_cert_death` FOREIGN KEY (`death_id`) REFERENCES `deaths` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `deaths`
--

DROP TABLE IF EXISTS `deaths`;
CREATE TABLE `deaths` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `death_dt` date NOT NULL,
  `cause` varchar(100) DEFAULT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `age` float NOT NULL,
  `profession` varchar(25) DEFAULT NULL,
  `buried_dt` date NOT NULL,
  `minister` varchar(75) DEFAULT NULL,
  `burial_place` varchar(25) NOT NULL,
  `ref_no` varchar(10) DEFAULT NULL,
  `residence` varchar(75) DEFAULT NULL,
  `community` varchar(50) DEFAULT NULL,
  `parents_relatives` varchar(75) DEFAULT NULL,
  `sacrament` varchar(25) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `deaths_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `people` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `families`
--

DROP TABLE IF EXISTS `families`;
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
  `reg_date` date DEFAULT NULL,
  `disabled` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `fid` (`fid`),
  KEY `husband_id` (`husband_id`),
  KEY `wife_id` (`wife_id`),
  CONSTRAINT `families_ibfk_1` FOREIGN KEY (`husband_id`) REFERENCES `people` (`id`),
  CONSTRAINT `families_ibfk_2` FOREIGN KEY (`wife_id`) REFERENCES `people` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Table structure for table `field_names`
--

DROP TABLE IF EXISTS `field_names`;
CREATE TABLE `field_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Table structure for table `field_values`
--

DROP TABLE IF EXISTS `field_values`;
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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Table structure for table `first_communion_certs`
--

DROP TABLE IF EXISTS `first_communion_certs`;
CREATE TABLE `first_communion_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_dt` date DEFAULT NULL,
  `first_comm_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `first_comm_id` (`first_comm_id`),
  CONSTRAINT `first_communion_certs_ibfk_1` FOREIGN KEY (`first_comm_id`) REFERENCES `first_communions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `first_communions`
--

DROP TABLE IF EXISTS `first_communions`;
CREATE TABLE `first_communions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `church` varchar(50) DEFAULT NULL,
  `communion_dt` date DEFAULT NULL,
  `ref_no` varchar(10) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `first_communions_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `people` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Table structure for table `marriage_certs`
--

DROP TABLE IF EXISTS `marriage_certs`;
CREATE TABLE `marriage_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_dt` date DEFAULT NULL,
  `marriage_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `marriage_id` (`marriage_id`),
  CONSTRAINT `marriage_certs_ibfk_1` FOREIGN KEY (`marriage_id`) REFERENCES `marriages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `marriages`
--

DROP TABLE IF EXISTS `marriages`;
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
  `groom_baptism_dt` date DEFAULT NULL,
  `bride_baptism_dt` date DEFAULT NULL,
  `groom_id` int(11) DEFAULT NULL,
  `bride_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`),
  KEY `bride_id` (`bride_id`),
  KEY `groom_id` (`groom_id`),
  CONSTRAINT `marriages_ibfk_1` FOREIGN KEY (`bride_id`) REFERENCES `people` (`id`),
  CONSTRAINT `marriages_ibfk_2` FOREIGN KEY (`groom_id`) REFERENCES `people` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Table structure for table `mass_bookings`
--

DROP TABLE IF EXISTS `mass_bookings`;
CREATE TABLE `mass_bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mass_id` int(11) DEFAULT NULL,
  `booked_by` varchar(99) DEFAULT NULL,
  `intention` varchar(99) DEFAULT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `mass_dt` date DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mass_bookings_mass` (`mass_id`),
  KEY `mass_bookings_trans` (`trans_id`),
  CONSTRAINT `mass_bookings_mass` FOREIGN KEY (`mass_id`) REFERENCES `masses` (`id`),
  CONSTRAINT `mass_bookings_trans` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `masses`
--

DROP TABLE IF EXISTS `masses`;
CREATE TABLE `masses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` varchar(10) DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Table structure for table `membership_certs`
--

DROP TABLE IF EXISTS `membership_certs`;
CREATE TABLE `membership_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `cert_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `membership_certs_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `need_data`
--

DROP TABLE IF EXISTS `need_data`;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Table structure for table `need_items`
--

DROP TABLE IF EXISTS `need_items`;
CREATE TABLE `need_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Table structure for table `no_impediment_letters`
--

DROP TABLE IF EXISTS `no_impediment_letters`;
CREATE TABLE `no_impediment_letters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banns_id` int(11) DEFAULT NULL,
  `letter_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banns_id` (`banns_id`),
  CONSTRAINT `no_impediment_letters_ibfk_1` FOREIGN KEY (`banns_id`) REFERENCES `banns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `open_data`
--

DROP TABLE IF EXISTS `open_data`;
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Table structure for table `open_questions`
--

DROP TABLE IF EXISTS `open_questions`;
CREATE TABLE `open_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text,
  `type` varchar(10) DEFAULT NULL,
  `seq` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `parish`;
CREATE TABLE `parish` (
  `isset` tinyint(4) NOT NULL DEFAULT '1',
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(25) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `est_year` int(11) NOT NULL,
  `mass_book_basic` double NOT NULL,
  `mass_book_sun` double NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `website` varchar(20) DEFAULT NULL,
  `logo_src` varchar(50) DEFAULT NULL,
  `logo_width` int(11) DEFAULT NULL,
  `logo_height` int(11) DEFAULT NULL,
  PRIMARY KEY (`isset`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `pastors`;
CREATE TABLE `pastors` (
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`sal` varchar(10) DEFAULT NULL,
	`fname` varchar(75) NOT NULL,
	`lname` varchar(25) DEFAULT NULL,
	`mobile` varchar(15) DEFAULT NULL,
	`email`	varchar(30) DEFAULT NULL,
	`role`	integer NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
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
  `mid` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `people_family_id` (`family_id`),
  CONSTRAINT `people_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

CREATE TABLE prefs (
	name	varchar(25) not null,
	value varchar(100) default null,
	primary key(name)
) ENGINE=InnoDB;

--
-- Table structure for table `satisfaction_data`
--

DROP TABLE IF EXISTS `satisfaction_data`;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Table structure for table `satisfaction_items`
--

DROP TABLE IF EXISTS `satisfaction_items`;
CREATE TABLE `satisfaction_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `family_id` int(11) DEFAULT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `start_year` int(11) DEFAULT NULL,
  `start_month` int(11) DEFAULT NULL,
  `end_year` int(11) DEFAULT NULL,
  `end_month` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `paid_by` varchar(99) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sub_family` (`family_id`),
  KEY `fk_sub_trans` (`trans_id`),
  CONSTRAINT `fk_sub_family` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`),
  CONSTRAINT `fk_sub_trans` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) DEFAULT NULL,
  `descr` varchar(99) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) DEFAULT NULL,
  `password` char(64) DEFAULT NULL,
  `superuser` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

CREATE TABLE visits (
	id	INTEGER NOT NULL AUTO_INCREMENT,
	pastor_id	INTEGER,
	visit_dt	DATE,
	purpose		INTEGER,
	family_id	INTEGER,
	PRIMARY KEY (id),
	CONSTRAINT fk_visit_pastor FOREIGN KEY (pastor_id) REFERENCES pastors(id)
	CONSTRAINT fk_visit_family FOREIGN KEY (family_id) REFERENCES families(id)
) ENGINE=InnoDB;


-- Dump completed on 2013-09-23 17:03:48


--  END OF DATABASE TABLE DEFINITIONS ---

--  START OF TABLE DATA ---


-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: parish
-- ------------------------------------------------------
-- Server version	5.5.31-0+wheezy1


--
-- Dumping data for table `AuthItem`
--

LOCK TABLES `AuthItem` WRITE;
INSERT INTO `AuthItem` VALUES ('Admin',2,NULL,NULL,'N;'),('Authenticated',2,NULL,NULL,'N;'),('AwarenessData.*',1,NULL,NULL,'N;'),('AwarenessData.Admin',0,NULL,NULL,'N;'),('AwarenessData.Create',0,NULL,NULL,'N;'),('AwarenessData.Delete',0,NULL,NULL,'N;'),('AwarenessData.Index',0,NULL,NULL,'N;'),('AwarenessData.Update',0,NULL,NULL,'N;'),('AwarenessData.View',0,NULL,NULL,'N;'),('AwarenessItems.*',1,NULL,NULL,'N;'),('AwarenessItems.Admin',0,NULL,NULL,'N;'),('AwarenessItems.Create',0,NULL,NULL,'N;'),('AwarenessItems.Delete',0,NULL,NULL,'N;'),('AwarenessItems.Index',0,NULL,NULL,'N;'),('AwarenessItems.Update',0,NULL,NULL,'N;'),('AwarenessItems.View',0,NULL,NULL,'N;'),('BannsRecords.*',1,NULL,NULL,'N;'),('BannsRecords.Admin',0,NULL,NULL,'N;'),('BannsRecords.Create',0,NULL,NULL,'N;'),('BannsRecords.Delete',0,NULL,NULL,'N;'),('BannsRecords.Index',0,NULL,NULL,'N;'),('BannsRecords.Update',0,NULL,NULL,'N;'),('BannsRecords.View',0,NULL,NULL,'N;'),('BannsRequest.*',1,NULL,NULL,'N;'),('BannsRequest.Admin',0,NULL,NULL,'N;'),('BannsRequest.Create',0,NULL,NULL,'N;'),('BannsRequest.Delete',0,NULL,NULL,'N;'),('BannsRequest.Index',0,NULL,NULL,'N;'),('BannsRequest.Update',0,NULL,NULL,'N;'),('BannsRequest.View',0,NULL,NULL,'N;'),('BannsRequest.ViewCert',0,NULL,NULL,'N;'),('BannsResponse.*',1,NULL,NULL,'N;'),('BannsResponse.Admin',0,NULL,NULL,'N;'),('BannsResponse.Create',0,NULL,NULL,'N;'),('BannsResponse.Delete',0,NULL,NULL,'N;'),('BannsResponse.Index',0,NULL,NULL,'N;'),('BannsResponse.Update',0,NULL,NULL,'N;'),('BannsResponse.View',0,NULL,NULL,'N;'),('BannsResponse.ViewCert',0,NULL,NULL,'N;'),('BaptismCertificate.*',1,NULL,NULL,'N;'),('BaptismCertificate.Admin',0,NULL,NULL,'N;'),('BaptismCertificate.Create',0,NULL,NULL,'N;'),('BaptismCertificate.Delete',0,NULL,NULL,'N;'),('BaptismCertificate.Index',0,NULL,NULL,'N;'),('BaptismCertificate.Update',0,NULL,NULL,'N;'),('BaptismCertificate.View',0,NULL,NULL,'N;'),('BaptismCertificate.ViewCert',0,NULL,NULL,'N;'),('BaptismRecords.*',1,NULL,NULL,'N;'),('BaptismRecords.Admin',0,NULL,NULL,'N;'),('BaptismRecords.Create',0,NULL,NULL,'N;'),('BaptismRecords.Delete',0,NULL,NULL,'N;'),('BaptismRecords.Index',0,NULL,NULL,'N;'),('BaptismRecords.Update',0,NULL,NULL,'N;'),('BaptismRecords.View',0,NULL,NULL,'N;'),('ConfirmationCertificate.*',1,NULL,NULL,'N;'),('ConfirmationCertificate.Admin',0,NULL,NULL,'N;'),('ConfirmationCertificate.Create',0,NULL,NULL,'N;'),('ConfirmationCertificate.Delete',0,NULL,NULL,'N;'),('ConfirmationCertificate.Index',0,NULL,NULL,'N;'),('ConfirmationCertificate.Update',0,NULL,NULL,'N;'),('ConfirmationCertificate.View',0,NULL,NULL,'N;'),('ConfirmationCertificate.ViewCert',0,NULL,NULL,'N;'),('ConfirmationRecords.*',1,NULL,NULL,'N;'),('ConfirmationRecords.Admin',0,NULL,NULL,'N;'),('ConfirmationRecords.Create',0,NULL,NULL,'N;'),('ConfirmationRecords.Delete',0,NULL,NULL,'N;'),('ConfirmationRecords.Index',0,NULL,NULL,'N;'),('ConfirmationRecords.Update',0,NULL,NULL,'N;'),('ConfirmationRecords.View',0,NULL,NULL,'N;'),('DeathCertificate.*',1,NULL,NULL,'N;'),('DeathCertificate.Admin',0,NULL,NULL,'N;'),('DeathCertificate.Create',0,NULL,NULL,'N;'),('DeathCertificate.Delete',0,NULL,NULL,'N;'),('DeathCertificate.Index',0,NULL,NULL,'N;'),('DeathCertificate.Update',0,NULL,NULL,'N;'),('DeathCertificate.View',0,NULL,NULL,'N;'),('DeathCertificate.ViewCert',0,NULL,NULL,'N;'),('DeathRecords.*',1,NULL,NULL,'N;'),('DeathRecords.Admin',0,NULL,NULL,'N;'),('DeathRecords.Create',0,NULL,NULL,'N;'),('DeathRecords.Delete',0,NULL,NULL,'N;'),('DeathRecords.Index',0,NULL,NULL,'N;'),('DeathRecords.Update',0,NULL,NULL,'N;'),('DeathRecords.View',0,NULL,NULL,'N;'),('Family.*',1,NULL,NULL,'N;'),('Family.Admin',0,NULL,NULL,'N;'),('Family.Children',0,NULL,NULL,'N;'),('Family.Create',0,NULL,NULL,'N;'),('Family.Delete',0,NULL,NULL,'N;'),('Family.Dependents',0,NULL,NULL,'N;'),('Family.Index',0,NULL,NULL,'N;'),('Family.Locate',0,NULL,NULL,'N;'),('Family.Photo',0,NULL,NULL,'N;'),('Family.Subscriptions',0,NULL,NULL,'N;'),('Family.Survey',0,NULL,NULL,'N;'),('Family.Update',0,NULL,NULL,'N;'),('Family.View',0,NULL,NULL,'N;'),('FieldName.*',1,NULL,NULL,'N;'),('FieldName.Admin',0,NULL,NULL,'N;'),('FieldName.Create',0,NULL,NULL,'N;'),('FieldName.Delete',0,NULL,NULL,'N;'),('FieldName.Index',0,NULL,NULL,'N;'),('FieldName.Update',0,NULL,NULL,'N;'),('FieldName.View',0,NULL,NULL,'N;'),('FieldValue.*',1,NULL,NULL,'N;'),('FieldValue.Admin',0,NULL,NULL,'N;'),('FieldValue.Create',0,NULL,NULL,'N;'),('FieldValue.Delete',0,NULL,NULL,'N;'),('FieldValue.Index',0,NULL,NULL,'N;'),('FieldValue.Update',0,NULL,NULL,'N;'),('FieldValue.View',0,NULL,NULL,'N;'),('FirstCommunionCertificate.*',1,NULL,NULL,'N;'),('FirstCommunionCertificate.Admin',0,NULL,NULL,'N;'),('FirstCommunionCertificate.Create',0,NULL,NULL,'N;'),('FirstCommunionCertificate.Delete',0,NULL,NULL,'N;'),('FirstCommunionCertificate.Index',0,NULL,NULL,'N;'),('FirstCommunionCertificate.Update',0,NULL,NULL,'N;'),('FirstCommunionCertificate.View',0,NULL,NULL,'N;'),('FirstCommunionCertificate.ViewCert',0,NULL,NULL,'N;'),('FirstCommunionRecords.*',1,NULL,NULL,'N;'),('FirstCommunionRecords.Admin',0,NULL,NULL,'N;'),('FirstCommunionRecords.Create',0,NULL,NULL,'N;'),('FirstCommunionRecords.Delete',0,NULL,NULL,'N;'),('FirstCommunionRecords.Index',0,NULL,NULL,'N;'),('FirstCommunionRecords.Update',0,NULL,NULL,'N;'),('FirstCommunionRecords.View',0,NULL,NULL,'N;'),('Guest',2,NULL,NULL,'N;'),('MarriageCertificate.*',1,NULL,NULL,'N;'),('MarriageCertificate.Admin',0,NULL,NULL,'N;'),('MarriageCertificate.Create',0,NULL,NULL,'N;'),('MarriageCertificate.Delete',0,NULL,NULL,'N;'),('MarriageCertificate.Index',0,NULL,NULL,'N;'),('MarriageCertificate.Update',0,NULL,NULL,'N;'),('MarriageCertificate.View',0,NULL,NULL,'N;'),('MarriageCertificate.ViewCert',0,NULL,NULL,'N;'),('MarriageRecords.*',1,NULL,NULL,'N;'),('MarriageRecords.Admin',0,NULL,NULL,'N;'),('MarriageRecords.Create',0,NULL,NULL,'N;'),('MarriageRecords.Delete',0,NULL,NULL,'N;'),('MarriageRecords.Index',0,NULL,NULL,'N;'),('MarriageRecords.Update',0,NULL,NULL,'N;'),('MarriageRecords.View',0,NULL,NULL,'N;'),('MassBooking.*',1,NULL,NULL,'N;'),('MassBooking.Admin',0,NULL,NULL,'N;'),('MassBooking.Calendar',0,NULL,NULL,'N;'),('MassBooking.Create',0,NULL,NULL,'N;'),('MassBooking.Delete',0,NULL,NULL,'N;'),('MassBooking.Index',0,NULL,NULL,'N;'),('MassBooking.Masses',0,NULL,NULL,'N;'),('MassBooking.Update',0,NULL,NULL,'N;'),('MassBooking.View',0,NULL,NULL,'N;'),('MassBooking.ViewCert',0,NULL,NULL,'N;'),('MassSchedule.*',1,NULL,NULL,'N;'),('MassSchedule.Admin',0,NULL,NULL,'N;'),('MassSchedule.Create',0,NULL,NULL,'N;'),('MassSchedule.Delete',0,NULL,NULL,'N;'),('MassSchedule.Index',0,NULL,NULL,'N;'),('MassSchedule.Update',0,NULL,NULL,'N;'),('MassSchedule.View',0,NULL,NULL,'N;'),('MembershipCertificate.*',1,NULL,NULL,'N;'),('MembershipCertificate.Admin',0,NULL,NULL,'N;'),('MembershipCertificate.Create',0,NULL,NULL,'N;'),('MembershipCertificate.Delete',0,NULL,NULL,'N;'),('MembershipCertificate.Index',0,NULL,NULL,'N;'),('MembershipCertificate.Update',0,NULL,NULL,'N;'),('MembershipCertificate.View',0,NULL,NULL,'N;'),('MembershipCertificate.ViewCert',0,NULL,NULL,'N;'),('NeedData.*',1,NULL,NULL,'N;'),('NeedData.Admin',0,NULL,NULL,'N;'),('NeedData.Create',0,NULL,NULL,'N;'),('NeedData.Delete',0,NULL,NULL,'N;'),('NeedData.Index',0,NULL,NULL,'N;'),('NeedData.Update',0,NULL,NULL,'N;'),('NeedData.View',0,NULL,NULL,'N;'),('NeedItems.*',1,NULL,NULL,'N;'),('NeedItems.Admin',0,NULL,NULL,'N;'),('NeedItems.Create',0,NULL,NULL,'N;'),('NeedItems.Delete',0,NULL,NULL,'N;'),('NeedItems.Index',0,NULL,NULL,'N;'),('NeedItems.Update',0,NULL,NULL,'N;'),('NeedItems.View',0,NULL,NULL,'N;'),('NoImpedimentLetter.*',1,NULL,NULL,'N;'),('NoImpedimentLetter.Admin',0,NULL,NULL,'N;'),('NoImpedimentLetter.Create',0,NULL,NULL,'N;'),('NoImpedimentLetter.Delete',0,NULL,NULL,'N;'),('NoImpedimentLetter.Index',0,NULL,NULL,'N;'),('NoImpedimentLetter.Update',0,NULL,NULL,'N;'),('NoImpedimentLetter.View',0,NULL,NULL,'N;'),('NoImpedimentLetter.ViewCert',0,NULL,NULL,'N;'),('OpenData.*',1,NULL,NULL,'N;'),('OpenData.Admin',0,NULL,NULL,'N;'),('OpenData.Create',0,NULL,NULL,'N;'),('OpenData.Delete',0,NULL,NULL,'N;'),('OpenData.Index',0,NULL,NULL,'N;'),('OpenData.Update',0,NULL,NULL,'N;'),('OpenData.View',0,NULL,NULL,'N;'),('OpenQuestion.*',1,NULL,NULL,'N;'),('OpenQuestion.Admin',0,NULL,NULL,'N;'),('OpenQuestion.Create',0,NULL,NULL,'N;'),('OpenQuestion.Delete',0,NULL,NULL,'N;'),('OpenQuestion.Index',0,NULL,NULL,'N;'),('OpenQuestion.Update',0,NULL,NULL,'N;'),('OpenQuestion.View',0,NULL,NULL,'N;'),('OpenQuestions.*',1,NULL,NULL,'N;'),('OpenQuestions.Admin',0,NULL,NULL,'N;'),('OpenQuestions.Create',0,NULL,NULL,'N;'),('OpenQuestions.Delete',0,NULL,NULL,'N;'),('OpenQuestions.Index',0,NULL,NULL,'N;'),('OpenQuestions.Update',0,NULL,NULL,'N;'),('OpenQuestions.View',0,NULL,NULL,'N;'),('Pastor',2,'Pastor',NULL,'N;'),('Person.*',1,NULL,NULL,'N;'),('Person.Admin',0,NULL,NULL,'N;'),('Person.Baptised',0,NULL,NULL,'N;'),('Person.Confirmed',0,NULL,NULL,'N;'),('Person.Create',0,NULL,NULL,'N;'),('Person.Delete',0,NULL,NULL,'N;'),('Person.Index',0,NULL,NULL,'N;'),('Person.Married',0,NULL,NULL,'N;'),('Person.Photo',0,NULL,NULL,'N;'),('Person.Update',0,NULL,NULL,'N;'),('Person.View',0,NULL,NULL,'N;'),('SatisfactionData.*',1,NULL,NULL,'N;'),('SatisfactionData.Admin',0,NULL,NULL,'N;'),('SatisfactionData.Create',0,NULL,NULL,'N;'),('SatisfactionData.Delete',0,NULL,NULL,'N;'),('SatisfactionData.Index',0,NULL,NULL,'N;'),('SatisfactionData.Update',0,NULL,NULL,'N;'),('SatisfactionData.View',0,NULL,NULL,'N;'),('SatisfactionItem.*',1,NULL,NULL,'N;'),('SatisfactionItem.Admin',0,NULL,NULL,'N;'),('SatisfactionItem.Create',0,NULL,NULL,'N;'),('SatisfactionItem.Delete',0,NULL,NULL,'N;'),('SatisfactionItem.Index',0,NULL,NULL,'N;'),('SatisfactionItem.Update',0,NULL,NULL,'N;'),('SatisfactionItem.View',0,NULL,NULL,'N;'),('SatisfactionItems.*',1,NULL,NULL,'N;'),('SatisfactionItems.Admin',0,NULL,NULL,'N;'),('SatisfactionItems.Create',0,NULL,NULL,'N;'),('SatisfactionItems.Delete',0,NULL,NULL,'N;'),('SatisfactionItems.Index',0,NULL,NULL,'N;'),('SatisfactionItems.Update',0,NULL,NULL,'N;'),('SatisfactionItems.View',0,NULL,NULL,'N;'),('Site.*',1,NULL,NULL,'N;'),('Site.Contact',0,NULL,NULL,'N;'),('Site.Error',0,NULL,NULL,'N;'),('Site.Index',0,NULL,NULL,'N;'),('Site.Login',0,NULL,NULL,'N;'),('Site.Logout',0,NULL,NULL,'N;'),('Site.ParishProfile',0,NULL,NULL,'N;'),('Staff',2,'Staff',NULL,'N;'),('Subscription.*',1,NULL,NULL,'N;'),('Subscription.Admin',0,NULL,NULL,'N;'),('Subscription.Create',0,NULL,NULL,'N;'),('Subscription.Delete',0,NULL,NULL,'N;'),('Subscription.Index',0,NULL,NULL,'N;'),('Subscription.Update',0,NULL,NULL,'N;'),('Subscription.View',0,NULL,NULL,'N;'),('Subscription.ViewRect',0,NULL,NULL,'N;'),('SurveyReports.*',1,NULL,NULL,'N;'),('SurveyReports.Awareness',0,NULL,NULL,'N;'),('SurveyReports.Index',0,NULL,NULL,'N;'),('SurveyReports.Needs',0,NULL,NULL,'N;'),('SurveyReports.OpenQuestions',0,NULL,NULL,'N;'),('SurveyReports.Satisfaction',0,NULL,NULL,'N;'),('User.Activation.*',1,NULL,NULL,'N;'),('User.Activation.Activation',0,NULL,NULL,'N;'),('User.Admin.*',1,NULL,NULL,'N;'),('User.Admin.Admin',0,NULL,NULL,'N;'),('User.Admin.Create',0,NULL,NULL,'N;'),('User.Admin.Delete',0,NULL,NULL,'N;'),('User.Admin.Update',0,NULL,NULL,'N;'),('User.Admin.View',0,NULL,NULL,'N;'),('User.Default.*',1,NULL,NULL,'N;'),('User.Default.Index',0,NULL,NULL,'N;'),('User.Login.*',1,NULL,NULL,'N;'),('User.Login.Login',0,NULL,NULL,'N;'),('User.Logout.*',1,NULL,NULL,'N;'),('User.Logout.Logout',0,NULL,NULL,'N;'),('User.Profile.*',1,NULL,NULL,'N;'),('User.Profile.Changepassword',0,NULL,NULL,'N;'),('User.Profile.Edit',0,NULL,NULL,'N;'),('User.Profile.Profile',0,NULL,NULL,'N;'),('User.ProfileField.*',1,NULL,NULL,'N;'),('User.ProfileField.Admin',0,NULL,NULL,'N;'),('User.ProfileField.Create',0,NULL,NULL,'N;'),('User.ProfileField.Delete',0,NULL,NULL,'N;'),('User.ProfileField.Update',0,NULL,NULL,'N;'),('User.ProfileField.View',0,NULL,NULL,'N;'),('User.Recovery.*',1,NULL,NULL,'N;'),('User.Recovery.Recovery',0,NULL,NULL,'N;'),('User.Registration.*',1,NULL,NULL,'N;'),('User.Registration.Registration',0,NULL,NULL,'N;'),('User.User.*',1,NULL,NULL,'N;'),('User.User.Index',0,NULL,NULL,'N;'),('User.User.View',0,NULL,NULL,'N;'),('Users.*',1,NULL,NULL,'N;'),('Users.Admin',0,NULL,NULL,'N;'),('Users.Create',0,NULL,NULL,'N;'),('Users.Delete',0,NULL,NULL,'N;'),('Users.Index',0,NULL,NULL,'N;'),('Users.Update',0,NULL,NULL,'N;'),('Users.View',0,NULL,NULL,'N;'),('YesnoData.*',1,NULL,NULL,'N;'),('YesnoData.Admin',0,NULL,NULL,'N;'),('YesnoData.Create',0,NULL,NULL,'N;'),('YesnoData.Delete',0,NULL,NULL,'N;'),('YesnoData.Index',0,NULL,NULL,'N;'),('YesnoData.Update',0,NULL,NULL,'N;'),('YesnoData.View',0,NULL,NULL,'N;'),('YesnoQuestion.*',1,NULL,NULL,'N;'),('YesnoQuestion.Admin',0,NULL,NULL,'N;'),('YesnoQuestion.Create',0,NULL,NULL,'N;'),('YesnoQuestion.Delete',0,NULL,NULL,'N;'),('YesnoQuestion.Index',0,NULL,NULL,'N;'),('YesnoQuestion.Update',0,NULL,NULL,'N;'),('YesnoQuestion.View',0,NULL,NULL,'N;');
UNLOCK TABLES;

--
-- Dumping data for table `AuthItemChild`
--

LOCK TABLES `AuthItemChild` WRITE;
INSERT INTO `AuthItemChild` VALUES ('Staff','Authenticated'),('Admin','AwarenessData.*'),('Admin','AwarenessItems.*'),('Pastor','BannsRecords.Admin'),('Staff','BannsRecords.Create'),('Staff','BannsRecords.Index'),('Pastor','BannsRecords.Update'),('Staff','BannsRecords.View'),('Pastor','BannsRequest.Admin'),('Staff','BannsRequest.Create'),('Staff','BannsRequest.Index'),('Pastor','BannsRequest.Update'),('Staff','BannsRequest.View'),('Staff','BannsRequest.ViewCert'),('Pastor','BannsResponse.Admin'),('Staff','BannsResponse.Create'),('Staff','BannsResponse.Index'),('Pastor','BannsResponse.Update'),('Staff','BannsResponse.View'),('Staff','BannsResponse.ViewCert'),('Admin','BaptismCertificate.*'),('Pastor','BaptismCertificate.Admin'),('Staff','BaptismCertificate.Create'),('Staff','BaptismCertificate.Index'),('Pastor','BaptismCertificate.Update'),('Staff','BaptismCertificate.View'),('Staff','BaptismCertificate.ViewCert'),('Admin','BaptismRecords.*'),('Pastor','BaptismRecords.Admin'),('Staff','BaptismRecords.Create'),('Staff','BaptismRecords.Index'),('Pastor','BaptismRecords.Update'),('Staff','BaptismRecords.View'),('Admin','ConfirmationCertificate.*'),('Pastor','ConfirmationCertificate.Admin'),('Staff','ConfirmationCertificate.Create'),('Staff','ConfirmationCertificate.Index'),('Pastor','ConfirmationCertificate.Update'),('Staff','ConfirmationCertificate.View'),('Staff','ConfirmationCertificate.ViewCert'),('Admin','ConfirmationRecords.*'),('Pastor','ConfirmationRecords.Admin'),('Staff','ConfirmationRecords.Create'),('Staff','ConfirmationRecords.Index'),('Pastor','ConfirmationRecords.Update'),('Staff','ConfirmationRecords.View'),('Pastor','DeathCertificate.Admin'),('Staff','DeathCertificate.Create'),('Staff','DeathCertificate.Index'),('Pastor','DeathCertificate.Update'),('Staff','DeathCertificate.View'),('Staff','DeathCertificate.ViewCert'),('Pastor','DeathRecords.Admin'),('Staff','DeathRecords.Create'),('Staff','DeathRecords.Index'),('Pastor','DeathRecords.Update'),('Staff','DeathRecords.View'),('Admin','Family.*'),('Pastor','Family.Admin'),('Staff','Family.Children'),('Staff','Family.Create'),('Staff','Family.Dependents'),('Authenticated','Family.Index'),('Staff','Family.Locate'),('Staff','Family.Photo'),('Staff','Family.Subscriptions'),('Staff','Family.Survey'),('Staff','Family.Update'),('Authenticated','Family.View'),('Admin','FieldName.*'),('Pastor','FieldName.Admin'),('Staff','FieldName.Create'),('Staff','FieldName.Index'),('Pastor','FieldName.Update'),('Staff','FieldName.View'),('Admin','FieldValue.*'),('Pastor','FieldValue.Admin'),('Staff','FieldValue.Create'),('Staff','FieldValue.Index'),('Pastor','FieldValue.Update'),('Staff','FieldValue.View'),('Admin','FirstCommunionCertificate.*'),('Pastor','FirstCommunionCertificate.Admin'),('Staff','FirstCommunionCertificate.Create'),('Staff','FirstCommunionCertificate.Index'),('Pastor','FirstCommunionCertificate.Update'),('Staff','FirstCommunionCertificate.View'),('Staff','FirstCommunionCertificate.ViewCert'),('Admin','FirstCommunionRecords.*'),('Pastor','FirstCommunionRecords.Admin'),('Staff','FirstCommunionRecords.Create'),('Staff','FirstCommunionRecords.Index'),('Pastor','FirstCommunionRecords.Update'),('Staff','FirstCommunionRecords.View'),('Admin','MarriageCertificate.*'),('Pastor','MarriageCertificate.Admin'),('Staff','MarriageCertificate.Create'),('Staff','MarriageCertificate.Index'),('Pastor','MarriageCertificate.Update'),('Staff','MarriageCertificate.View'),('Staff','MarriageCertificate.ViewCert'),('Admin','MarriageRecords.*'),('Pastor','MarriageRecords.Admin'),('Staff','MarriageRecords.Create'),('Staff','MarriageRecords.Index'),('Pastor','MarriageRecords.Update'),('Staff','MarriageRecords.View'),('Pastor','MassBooking.Admin'),('Staff','MassBooking.Calendar'),('Staff','MassBooking.Create'),('Staff','MassBooking.Index'),('Staff','MassBooking.Masses'),('Pastor','MassBooking.Update'),('Staff','MassBooking.View'),('Staff','MassBooking.ViewCert'),('Pastor','MassSchedule.Admin'),('Staff','MassSchedule.Create'),('Staff','MassSchedule.Index'),('Pastor','MassSchedule.Update'),('Staff','MassSchedule.View'),('Pastor','MembershipCertificate.Admin'),('Staff','MembershipCertificate.Create'),('Staff','MembershipCertificate.Index'),('Pastor','MembershipCertificate.Update'),('Staff','MembershipCertificate.View'),('Staff','MembershipCertificate.ViewCert'),('Admin','NeedData.*'),('Pastor','NeedData.Admin'),('Staff','NeedData.Create'),('Staff','NeedData.Index'),('Pastor','NeedData.Update'),('Staff','NeedData.View'),('Admin','NeedItems.*'),('Pastor','NeedItems.Admin'),('Staff','NeedItems.Create'),('Staff','NeedItems.Index'),('Pastor','NeedItems.Update'),('Staff','NeedItems.View'),('Pastor','NoImpedimentLetter.Admin'),('Staff','NoImpedimentLetter.Create'),('Staff','NoImpedimentLetter.Index'),('Pastor','NoImpedimentLetter.Update'),('Staff','NoImpedimentLetter.View'),('Staff','NoImpedimentLetter.ViewCert'),('Admin','OpenData.*'),('Pastor','OpenData.Admin'),('Staff','OpenData.Create'),('Staff','OpenData.Index'),('Pastor','OpenData.Update'),('Staff','OpenData.View'),('Admin','OpenQuestion.*'),('Pastor','OpenQuestion.Admin'),('Staff','OpenQuestion.Create'),('Staff','OpenQuestion.Index'),('Pastor','OpenQuestion.Update'),('Staff','OpenQuestion.View'),('Admin','OpenQuestions.*'),('Pastor','OpenQuestions.Admin'),('Staff','OpenQuestions.Create'),('Staff','OpenQuestions.Index'),('Pastor','OpenQuestions.Update'),('Staff','OpenQuestions.View'),('Admin','Person.*'),('Pastor','Person.Admin'),('Staff','Person.Baptised'),('Staff','Person.Confirmed'),('Staff','Person.Create'),('Pastor','Person.Delete'),('Staff','Person.Index'),('Staff','Person.Married'),('Staff','Person.Update'),('Staff','Person.View'),('Admin','SatisfactionData.*'),('Pastor','SatisfactionData.Admin'),('Staff','SatisfactionData.Create'),('Staff','SatisfactionData.Index'),('Pastor','SatisfactionData.Update'),('Staff','SatisfactionData.View'),('Admin','SatisfactionItem.*'),('Pastor','SatisfactionItem.Admin'),('Pastor','SatisfactionItem.Create'),('Pastor','SatisfactionItem.Index'),('Pastor','SatisfactionItem.Update'),('Pastor','SatisfactionItem.View'),('Admin','SatisfactionItems.*'),('Pastor','SatisfactionItems.Admin'),('Pastor','SatisfactionItems.Create'),('Pastor','SatisfactionItems.Index'),('Pastor','SatisfactionItems.Update'),('Pastor','SatisfactionItems.View'),('Admin','Site.*'),('Authenticated','Site.Contact'),('Authenticated','Site.Error'),('Authenticated','Site.Index'),('Guest','Site.Index'),('Guest','Site.Login'),('Authenticated','Site.Logout'),('Authenticated','Site.ParishProfile'),('Pastor','Staff'),('Pastor','Subscription.Admin'),('Staff','Subscription.Create'),('Staff','Subscription.Index'),('Pastor','Subscription.Update'),('Staff','Subscription.View'),('Staff','Subscription.ViewRect'),('Admin','User.Activation.*'),('Admin','User.Admin.*'),('Admin','User.Default.*'),('Admin','User.Login.*'),('Admin','User.Logout.*'),('Admin','User.Profile.*'),('Admin','User.ProfileField.*'),('Admin','User.Recovery.*'),('Admin','User.Registration.*'),('Admin','User.User.*'),('Admin','Users.*'),('Pastor','Users.Index'),('Admin','YesnoData.*'),('Pastor','YesnoData.Admin'),('Staff','YesnoData.Create'),('Staff','YesnoData.Index'),('Pastor','YesnoData.Update'),('Admin','YesnoQuestion.*');
UNLOCK TABLES;

--
-- Dumping data for table `awareness_items`
--

LOCK TABLES `awareness_items` WRITE;
INSERT INTO `awareness_items` VALUES (1,'Employment bureau'),(2,'Counselling center'),(3,'Youth groups'),(4,'Society of Vincent de Paul'),(5,'Parish website'),(6,'Ladies of charity'),(7,'Marriage bureau'),(8,'Legion of Mary');
UNLOCK TABLES;

--
-- Dumping data for table `field_names`
--

LOCK TABLES `field_names` WRITE;
INSERT INTO `field_names` VALUES (14,'awareness_level'),(11,'domicile_status'),(3,'education'),(5,'languages'),(2,'marriage_status'),(1,'marriage_type'),(4,'monthly_household_income'),(8,'need_level'),(6,'rite'),(7,'satisfaction_level'),(13,'sex'),(15,'weekdays'),(10,'zones');
UNLOCK TABLES;

--
-- Dumping data for table `field_values`
--

LOCK TABLES `field_values` WRITE;
INSERT INTO `field_values` VALUES (1,1,'Regular',1,1),(1,2,'Irregular',2,2),(2,3,'Married',1,1),(2,4,'Separated',2,2),(2,5,'Divorced',3,3),(2,6,'Widowed',4,4),(1,7,'Disparity of cult',3,3),(3,8,'< High School',1,1),(3,9,'High School',2,2),(3,10,'Graduate',3,3),(3,11,'Post Graduate',4,4),(4,12,'< 10000',1,1),(4,13,'10k - 50k',2,2),(4,14,'50k - 1 lakh',3,3),(4,15,'above 1 lakh',4,4),(5,16,'English',1,1),(5,17,'Kannada',2,2),(5,18,'Tamil',3,3),(6,19,'Syro Malabar',2,5),(6,20,'Syro Malankara',3,10),(7,21,'Very Dissatisfied',1,1),(7,23,'Dissatisfied',2,2),(7,24,'Neutral',3,3),(7,25,'Satisfied',4,4),(7,26,'Very Satisfied',5,5),(8,27,'Not Important',1,1),(8,28,'Important',2,2),(8,29,'Very Important',3,3),(8,30,'Dissatisfied',4,4),(8,31,'Will join/attend',5,5),(10,32,'Zone A',1,1),(10,33,'Zone B',2,2),(10,34,'Zone C',3,3),(10,35,'Zone D',4,4),(11,36,'Home',1,1),(11,37,'Away',2,2),(13,38,'Male',1,1),(13,39,'Female',2,2),(14,40,'Accessed',3,3),(14,41,'Aware',2,2),(15,42,'Sunday',0,0),(15,43,'Monday',1,1),(15,44,'Tuesday',2,2),(15,45,'Wednesday',3,3),(15,46,'Thursday',4,4),(15,47,'Friday',5,5),(15,48,'Saturday',6,6),(6,49,'Latiin',1,3),(6,50,'Other',4,15),(14,51,'Not Aware',1,1);
UNLOCK TABLES;

--
-- Dumping data for table `need_items`
--

LOCK TABLES `need_items` WRITE;
INSERT INTO `need_items` VALUES (1,'Bible study'),(2,'Night vigil'),(3,'Legal aid'),(4,'Catholic enquiry center'),(5,'Intercession group (prayer warrior)'),(6,'Regular retreats'),(7,'Social media interaction'),(8,'Basic Christian Community'),(9,'Mission, etc'),(10,'Apologetics center'),(11,'Sacraments for inbound members (sick, elderly)');
UNLOCK TABLES;

--
-- Dumping data for table `open_questions`
--

LOCK TABLES `open_questions` WRITE;
INSERT INTO `open_questions` VALUES (1,'Are you attending a Bible study?','yesno',1),(2,'If yes, specify (catholic / other denomination)','string',2),(3,'Do you attend periodic retreats / prayer group meetings?','yesno',3),(4,'If yes, specify (catholic / other denomination)','string',4),(5,'Do your children attend Sunday school (catechism)?','yesno',5),(6,'Do you attend Novena services regularly?','yesno',6),(7,'Have you availed medical aid from the parish?','yesno',7),(8,'Have you availed education support from the parish?','yesno',8),(9,'Do you attend worship at any other non catholic church?','yesno',9),(10,'If yes, how many times a month?','integer',10),(11,'How often do you attend Mass per month?','integer',11),(12,'What is the ideal frequency for receiving the Sacrament of Reconciliation?','string',12);
UNLOCK TABLES;

--
-- Dumping data for table `satisfaction_items`
--

LOCK TABLES `satisfaction_items` WRITE;
INSERT INTO `satisfaction_items` VALUES (1,'Service'),(2,'Preaching & message'),(3,'Novena'),(4,'Choir'),(5,'Ushering'),(6,'Lectors'),(7,'Decorations arrangement'),(8,'Adoration'),(9,'Sunday school'),(10,'Preparation for Sacraments'),(11,'Adult Catechesis'),(12,'Bible study'),(13,'Retreats'),(14,'Parish website');
UNLOCK TABLES;

-- Dump completed on 2013-09-23 17:03:48
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

--   END OF DATABASE TABLE DATA   ---

--  START OF AUTO INCREMENT RESET ---


ALTER TABLE `awareness_data` AUTO_INCREMENT=1;
ALTER TABLE `banns` AUTO_INCREMENT=1;
ALTER TABLE `banns_requests` AUTO_INCREMENT=1;
ALTER TABLE `banns_responses` AUTO_INCREMENT=1;
ALTER TABLE `baptism_certs` AUTO_INCREMENT=1;
ALTER TABLE `baptisms` AUTO_INCREMENT=1;
ALTER TABLE `confirmation_certs` AUTO_INCREMENT=1;
ALTER TABLE `confirmations` AUTO_INCREMENT=1;
ALTER TABLE `death_certs` AUTO_INCREMENT=1;
ALTER TABLE `deaths` AUTO_INCREMENT=1;
ALTER TABLE `families` AUTO_INCREMENT=1;
ALTER TABLE `first_communion_certs` AUTO_INCREMENT=1;
ALTER TABLE `first_communions` AUTO_INCREMENT=1;
ALTER TABLE `marriage_certs` AUTO_INCREMENT=1;
ALTER TABLE `marriages` AUTO_INCREMENT=1;
ALTER TABLE `mass_bookings` AUTO_INCREMENT=1;
ALTER TABLE `masses` AUTO_INCREMENT=1;
ALTER TABLE `membership_certs` AUTO_INCREMENT=1;
ALTER TABLE `need_data` AUTO_INCREMENT=1;
ALTER TABLE `no_impediment_letters` AUTO_INCREMENT=1;
ALTER TABLE `open_data` AUTO_INCREMENT=1;
ALTER TABLE `people` AUTO_INCREMENT=1;
ALTER TABLE `satisfaction_data` AUTO_INCREMENT=1;
ALTER TABLE `subscriptions` AUTO_INCREMENT=1;
ALTER TABLE `transactions` AUTO_INCREMENT=1;
ALTER TABLE `users` AUTO_INCREMENT=1;


--   END OF AUTO INCREMENT RESET   ---
--  END OF FILE ---

