--
-- This file is part of Alive Parish Software
--
-- Alive Parish - software to manage tomorrow's parish
-- Copyright (C) 2013  Redemptorist Media Center
--
-- Alive Parish Software is free software: you can redistribute it
-- and/or modify it under the terms of the GNU General Public License as
-- published by the Free Software Foundation, either version 3 of the
-- License, or (at your option) any later version.
--
-- Alive Parish Software is distributed in the hope that it will
-- be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
-- of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see <http://www.gnu.org/licenses/>.
--
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
-- MySQL dump 10.14  Distrib 10.0.4-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: parish
-- ------------------------------------------------------
-- Server version	10.0.4-MariaDB-log


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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `placeholder` tinyint(4) DEFAULT NULL,
  `reserved` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`parent`),
  KEY `account_parent` (`parent`),
  CONSTRAINT `account_parent` FOREIGN KEY (`parent`) REFERENCES `accounts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
  CONSTRAINT `awareness_data_ibfk_1` FOREIGN KEY (`awareness_id`) REFERENCES `awareness_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `awareness_data_ibfk_2` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
  `req_dt` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `banns_id` (`banns_id`),
  CONSTRAINT `banns_requests_ibfk_1` FOREIGN KEY (`banns_id`) REFERENCES `banns` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `banns_responses`
--

DROP TABLE IF EXISTS `banns_responses`;
CREATE TABLE `banns_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banns_id` int(11) DEFAULT NULL,
  `res_dt` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `banns_id` (`banns_id`),
  CONSTRAINT `banns_responses_ibfk_1` FOREIGN KEY (`banns_id`) REFERENCES `banns` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `baptism_certs`
--

DROP TABLE IF EXISTS `baptism_certs`;
CREATE TABLE `baptism_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_dt` date NOT NULL,
  `baptism_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `baptism_id` (`baptism_id`),
  CONSTRAINT `baptism_certs_ibfk_1` FOREIGN KEY (`baptism_id`) REFERENCES `baptisms` (`id`) ON UPDATE CASCADE
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
  `ref_no` varchar(10) NOT NULL,
  `baptism_place` varchar(50) DEFAULT NULL,
  `mother_tongue` varchar(25) DEFAULT NULL,
  `confirmation_dt` date DEFAULT NULL,
  `marriage_dt` date DEFAULT NULL,
  `spouse` varchar(75) DEFAULT NULL,
  `remarks` varchar(150) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `baptisms_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `people` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Table structure for table `confirmation_certs`
--

DROP TABLE IF EXISTS `confirmation_certs`;
CREATE TABLE `confirmation_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_dt` date NOT NULL,
  `confirmation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `confirmation_id` (`confirmation_id`),
  CONSTRAINT `confirmation_certs_ibfk_1` FOREIGN KEY (`confirmation_id`) REFERENCES `confirmations` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `confirmations`
--

DROP TABLE IF EXISTS `confirmations`;
CREATE TABLE `confirmations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(10) NOT NULL,
  `name` varchar(75) DEFAULT NULL,
  `confirmation_dt` date NOT NULL,
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
  CONSTRAINT `confirmations_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `people` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Table structure for table `death_certs`
--

DROP TABLE IF EXISTS `death_certs`;
CREATE TABLE `death_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `death_id` int(11) NOT NULL,
  `cert_dt` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `death_cert_death` (`death_id`),
  CONSTRAINT `death_cert_death` FOREIGN KEY (`death_id`) REFERENCES `deaths` (`id`) ON UPDATE CASCADE
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
  `ref_no` varchar(10) NOT NULL,
  `residence` varchar(75) DEFAULT NULL,
  `community` varchar(50) DEFAULT NULL,
  `parents_relatives` varchar(75) DEFAULT NULL,
  `sacrament` varchar(25) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `deaths_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `people` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `families`
--

DROP TABLE IF EXISTS `families`;
CREATE TABLE `families` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` varchar(11) NOT NULL,
  `addr_nm` varchar(50) DEFAULT NULL,
  `addr_stt` varchar(75) DEFAULT NULL,
  `addr_area` varchar(50) DEFAULT NULL,
  `addr_pin` varchar(7) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `zone` int(11) DEFAULT NULL,
  `bpl_card` tinyint(4) DEFAULT NULL,
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
  `leaving_date` date DEFAULT NULL,
  `house_status` int(11) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fid` (`fid`),
  KEY `husband_id` (`husband_id`),
  KEY `wife_id` (`wife_id`),
  CONSTRAINT `families_ibfk_1` FOREIGN KEY (`husband_id`) REFERENCES `people` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `families_ibfk_2` FOREIGN KEY (`wife_id`) REFERENCES `people` (`id`) ON UPDATE CASCADE
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
  `cert_dt` date NOT NULL,
  `first_comm_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `first_comm_id` (`first_comm_id`),
  CONSTRAINT `first_communion_certs_ibfk_1` FOREIGN KEY (`first_comm_id`) REFERENCES `first_communions` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `first_communions`
--

DROP TABLE IF EXISTS `first_communions`;
CREATE TABLE `first_communions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `church` varchar(50) DEFAULT NULL,
  `communion_dt` date NOT NULL,
  `ref_no` varchar(10) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `first_communions_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `people` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Table structure for table `marriage_certs`
--

DROP TABLE IF EXISTS `marriage_certs`;
CREATE TABLE `marriage_certs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_dt` date NOT NULL,
  `marriage_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `marriage_id` (`marriage_id`),
  CONSTRAINT `marriage_certs_ibfk_1` FOREIGN KEY (`marriage_id`) REFERENCES `marriages` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Table structure for table `marriages`
--

DROP TABLE IF EXISTS `marriages`;
CREATE TABLE `marriages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marriage_dt` date NOT NULL,
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
  `ref_no` varchar(10) NOT NULL,
  `groom_baptism_dt` date DEFAULT NULL,
  `bride_baptism_dt` date DEFAULT NULL,
  `groom_id` int(11) DEFAULT NULL,
  `bride_id` int(11) DEFAULT NULL,
  `marriage_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_no` (`ref_no`),
  KEY `bride_id` (`bride_id`),
  KEY `groom_id` (`groom_id`),
  CONSTRAINT `marriages_ibfk_1` FOREIGN KEY (`bride_id`) REFERENCES `people` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `marriages_ibfk_2` FOREIGN KEY (`groom_id`) REFERENCES `people` (`id`) ON UPDATE CASCADE
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
  `mass_dt` date NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mass_bookings_mass` (`mass_id`),
  KEY `mass_bookings_trans` (`trans_id`),
  CONSTRAINT `mass_bookings_mass` FOREIGN KEY (`mass_id`) REFERENCES `masses` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `mass_bookings_trans` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`id`) ON UPDATE CASCADE
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
  `cert_dt` date NOT NULL,
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
  CONSTRAINT `need_data_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `need_data_ibfk_2` FOREIGN KEY (`need_id`) REFERENCES `need_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
  `letter_dt` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `banns_id` (`banns_id`),
  CONSTRAINT `no_impediment_letters_ibfk_1` FOREIGN KEY (`banns_id`) REFERENCES `banns` (`id`) ON UPDATE CASCADE
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
  CONSTRAINT `open_data_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `open_data_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `open_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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

--
-- Table structure for table `parish`
--

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
  `website` varchar(50) DEFAULT NULL,
  `logo_src` varchar(50) DEFAULT NULL,
  `logo_width` int(11) DEFAULT NULL,
  `logo_height` int(11) DEFAULT NULL,
  `currency` char(3) DEFAULT NULL,
  `cert_header` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`isset`)
) ENGINE=InnoDB;

--
-- Table structure for table `pastors`
--

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
  `remarks` varchar(50) DEFAULT NULL,
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
  `death_dt` date DEFAULT NULL,
  `cemetery_church` varchar(25) DEFAULT NULL,
  `family_id` int(11) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `special_skill` varchar(25) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `voter_id` varchar(25) DEFAULT NULL,
  `aadhar_no` varchar(25) DEFAULT NULL,
  `blood_group` int(11) DEFAULT NULL,
  `mid` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `people_family_id` (`family_id`),
  CONSTRAINT `people_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

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
  CONSTRAINT `satisfaction_data_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `satisfaction_data_ibfk_2` FOREIGN KEY (`satisfaction_item_id`) REFERENCES `satisfaction_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
  CONSTRAINT `fk_sub_family` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_sub_trans` FOREIGN KEY (`trans_id`) REFERENCES `transactions` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `descr` varchar(99) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_ibfk_1` (`creator`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON UPDATE CASCADE
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

DROP TABLE IF EXISTS `visits`;
CREATE TABLE `visits` (
	id	INTEGER NOT NULL AUTO_INCREMENT,
	pastor_id	INTEGER,
	visit_dt	DATE,
	purpose		INTEGER,
	family_id	INTEGER,
	PRIMARY KEY (id),
	CONSTRAINT fk_visit_pastor FOREIGN KEY (pastor_id) REFERENCES pastors(id) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT fk_visit_family FOREIGN KEY (family_id) REFERENCES families(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;


-- Dump completed on 2014-01-02 17:02:22


--  END OF DATABASE TABLE DEFINITIONS ---

--  START OF TABLE DATA ---

--
-- Dumping data for table `AuthItem`
--

LOCK TABLES `AuthItem` WRITE;
INSERT INTO `AuthItem` VALUES ('Profile.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Profile.ChangePassword',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Profile.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Admin',2,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Admin.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Admin.Config',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Admin.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Authenticated',2,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessData.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessData.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessData.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessData.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessData.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessData.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessData.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessItems.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessItems.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessItems.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessItems.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessItems.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessItems.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('AwarenessItems.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRecords.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRecords.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRecords.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRecords.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRecords.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRecords.Search',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRecords.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRecords.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRequest.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRequest.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRequest.ByRecord',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRequest.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRequest.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRequest.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRequest.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRequest.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsRequest.ViewCert',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsResponse.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsResponse.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsResponse.ByRecord',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsResponse.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsResponse.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsResponse.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsResponse.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsResponse.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BannsResponse.ViewCert',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismCertificate.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismCertificate.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismCertificate.ByRecord',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismCertificate.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismCertificate.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismCertificate.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismCertificate.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismCertificate.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismCertificate.ViewCert',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismRecords.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismRecords.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismRecords.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismRecords.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismRecords.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismRecords.Search',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismRecords.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('BaptismRecords.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationCertificate.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationCertificate.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationCertificate.ByRecord',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationCertificate.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationCertificate.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationCertificate.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationCertificate.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationCertificate.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationCertificate.ViewCert',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationRecords.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationRecords.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationRecords.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationRecords.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationRecords.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationRecords.Search',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationRecords.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('ConfirmationRecords.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathCertificate.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathCertificate.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathCertificate.ByRecord',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathCertificate.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathCertificate.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathCertificate.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathCertificate.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathCertificate.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathCertificate.ViewCert',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathRecords.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathRecords.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathRecords.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathRecords.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathRecords.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathRecords.Search',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathRecords.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('DeathRecords.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Children',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Dependents',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Disable',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Enable',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.FindMatch',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Locate',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Photo',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Search',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Subscriptions',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Survey',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Family.Visits',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldName.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldName.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldName.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldName.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldName.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldName.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldName.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldValue.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldValue.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldValue.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldValue.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldValue.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldValue.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FieldValue.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionCertificate.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionCertificate.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionCertificate.ByRecord',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionCertificate.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionCertificate.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionCertificate.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionCertificate.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionCertificate.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionCertificate.ViewCert',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionRecords.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionRecords.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionRecords.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionRecords.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionRecords.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionRecords.Search',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionRecords.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('FirstCommunionRecords.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Guest',2,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageCertificate.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageCertificate.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageCertificate.ByRecord',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageCertificate.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageCertificate.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageCertificate.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageCertificate.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageCertificate.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageCertificate.ViewCert',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageRecords.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageRecords.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageRecords.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageRecords.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageRecords.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageRecords.Search',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageRecords.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MarriageRecords.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassBooking.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassBooking.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassBooking.Calendar',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassBooking.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassBooking.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassBooking.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassBooking.MassAmt',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassBooking.Masses',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassBooking.Search',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassBooking.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassBooking.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassBooking.ViewCert',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassSchedule.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassSchedule.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassSchedule.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassSchedule.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassSchedule.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassSchedule.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MassSchedule.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MembershipCertificate.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MembershipCertificate.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MembershipCertificate.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MembershipCertificate.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MembershipCertificate.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MembershipCertificate.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MembershipCertificate.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('MembershipCertificate.ViewCert',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedData.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedData.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedData.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedData.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedData.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedData.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedData.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedItems.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedItems.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedItems.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedItems.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedItems.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedItems.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NeedItems.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NoImpedimentLetter.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NoImpedimentLetter.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NoImpedimentLetter.ByRecord',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NoImpedimentLetter.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NoImpedimentLetter.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NoImpedimentLetter.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NoImpedimentLetter.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NoImpedimentLetter.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('NoImpedimentLetter.ViewCert',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenData.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenData.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenData.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenData.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenData.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenData.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenData.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestion.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestion.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestion.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestion.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestion.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestion.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestion.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestions.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestions.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestions.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestions.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestions.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestions.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('OpenQuestions.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Parish.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Parish.Profile',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Parish.Search',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Pastor',2,'Pastor',NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Pastor.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Pastor.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Pastor.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Pastor.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Pastor.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Pastor.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Pastor.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.Baptised',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.Confirmed',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.FindMatch',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.Married',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.Photo',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.Search',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Person.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Reports.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Reports.Anniversaries',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Reports.Birthdays',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Reports.Families',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Reports.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Reports.MassBookings',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Reports.ParishProfile',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionData.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionData.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionData.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionData.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionData.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionData.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionData.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItem.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItem.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItem.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItem.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItem.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItem.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItem.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItems.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItems.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItems.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItems.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItems.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItems.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SatisfactionItems.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Site.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Site.Config',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Site.Contact',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Site.Error',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Site.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Site.Login',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Site.Logout',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Site.ParishProfile',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Staff',2,'Staff',NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Subscription.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Subscription.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Subscription.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Subscription.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Subscription.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Subscription.TillDate',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Subscription.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Subscription.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Subscription.ViewRect',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SurveyReports.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SurveyReports.Awareness',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SurveyReports.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SurveyReports.Needs',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SurveyReports.OpenQuestions',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('SurveyReports.Satisfaction',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Activation.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Activation.Activation',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Admin.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Admin.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Admin.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Admin.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Admin.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Admin.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Default.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Default.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Login.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Login.Login',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Logout.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Logout.Logout',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Profile.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Profile.Changepassword',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Profile.Edit',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Profile.Profile',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.ProfileField.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.ProfileField.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.ProfileField.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.ProfileField.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.ProfileField.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.ProfileField.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Recovery.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Recovery.Recovery',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Registration.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.Registration.Registration',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.User.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.User.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('User.User.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Users.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Users.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Users.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Users.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Users.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Users.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Users.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Visit.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Visit.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Visit.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Visit.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Visit.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Visit.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('Visit.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoData.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoData.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoData.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoData.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoData.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoData.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoData.View',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoQuestion.*',1,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoQuestion.Admin',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoQuestion.Create',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoQuestion.Delete',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoQuestion.Index',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoQuestion.Update',0,NULL,NULL,'N;');
INSERT INTO `AuthItem` VALUES ('YesnoQuestion.View',0,NULL,NULL,'N;');
UNLOCK TABLES;

--
-- Dumping data for table `AuthItemChild`
--

LOCK TABLES `AuthItemChild` WRITE;
INSERT INTO `AuthItemChild` VALUES ('Admin','AwarenessData.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','AwarenessItems.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','BaptismCertificate.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','BaptismRecords.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','ConfirmationCertificate.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','ConfirmationRecords.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','Family.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','FieldName.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','FieldValue.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','FirstCommunionCertificate.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','FirstCommunionRecords.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','MarriageCertificate.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','MarriageRecords.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','NeedData.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','NeedItems.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','OpenData.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','OpenQuestion.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','OpenQuestions.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','Person.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','SatisfactionData.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','SatisfactionItem.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','SatisfactionItems.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','Site.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','User.Activation.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','User.Admin.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','User.Default.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','User.Login.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','User.Logout.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','User.Profile.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','User.ProfileField.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','User.Recovery.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','User.Registration.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','User.User.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','Users.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','YesnoData.*');
INSERT INTO `AuthItemChild` VALUES ('Admin','YesnoQuestion.*');
INSERT INTO `AuthItemChild` VALUES ('Authenticated','Profile.ChangePassword');
INSERT INTO `AuthItemChild` VALUES ('Authenticated','Profile.Index');
INSERT INTO `AuthItemChild` VALUES ('Authenticated','Family.Index');
INSERT INTO `AuthItemChild` VALUES ('Authenticated','Family.View');
INSERT INTO `AuthItemChild` VALUES ('Authenticated','Site.Contact');
INSERT INTO `AuthItemChild` VALUES ('Authenticated','Site.Error');
INSERT INTO `AuthItemChild` VALUES ('Authenticated','Site.Index');
INSERT INTO `AuthItemChild` VALUES ('Authenticated','Site.Logout');
INSERT INTO `AuthItemChild` VALUES ('Authenticated','Site.ParishProfile');
INSERT INTO `AuthItemChild` VALUES ('Authenticated','User.Profile.Changepassword');
INSERT INTO `AuthItemChild` VALUES ('Guest','Site.Index');
INSERT INTO `AuthItemChild` VALUES ('Guest','Site.Login');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Admin.Config');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Admin.Index');
INSERT INTO `AuthItemChild` VALUES ('Pastor','AwarenessItems.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','AwarenessItems.Create');
INSERT INTO `AuthItemChild` VALUES ('Pastor','AwarenessItems.Delete');
INSERT INTO `AuthItemChild` VALUES ('Pastor','AwarenessItems.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','BannsRecords.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','BannsRecords.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','BannsRequest.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','BannsRequest.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','BannsResponse.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','BannsResponse.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','BaptismCertificate.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','BaptismCertificate.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','BaptismRecords.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','BaptismRecords.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','ConfirmationCertificate.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','ConfirmationCertificate.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','ConfirmationRecords.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','ConfirmationRecords.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','DeathCertificate.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','DeathCertificate.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','DeathRecords.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','DeathRecords.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Family.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','FieldName.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','FieldName.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','FieldValue.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','FieldValue.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','FirstCommunionCertificate.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','FirstCommunionCertificate.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','FirstCommunionRecords.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','FirstCommunionRecords.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','MarriageCertificate.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','MarriageCertificate.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','MarriageRecords.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','MarriageRecords.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','MassBooking.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','MassSchedule.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','MassSchedule.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','MembershipCertificate.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','MembershipCertificate.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','NeedData.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','NeedData.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','NeedItems.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','NeedItems.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','NoImpedimentLetter.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','NoImpedimentLetter.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','OpenData.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','OpenData.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','OpenQuestion.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','OpenQuestion.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','OpenQuestions.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','OpenQuestions.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Parish.Profile');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Pastor.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Pastor.Create');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Pastor.Delete');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Pastor.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Person.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Person.Delete');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SatisfactionData.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SatisfactionData.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SatisfactionItem.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SatisfactionItem.Create');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SatisfactionItem.Delete');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SatisfactionItem.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SatisfactionItem.View');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SatisfactionItems.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SatisfactionItems.Create');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SatisfactionItems.Index');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SatisfactionItems.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SatisfactionItems.View');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Staff');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Subscription.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SurveyReports.Awareness');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SurveyReports.Index');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SurveyReports.Needs');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SurveyReports.OpenQuestions');
INSERT INTO `AuthItemChild` VALUES ('Pastor','SurveyReports.Satisfaction');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Users.Index');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Users.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Users.Create');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Users.Delete');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Users.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Users.View');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Visit.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','Visit.Update');
INSERT INTO `AuthItemChild` VALUES ('Pastor','YesnoData.Admin');
INSERT INTO `AuthItemChild` VALUES ('Pastor','YesnoData.Update');
INSERT INTO `AuthItemChild` VALUES ('Staff','Authenticated');
INSERT INTO `AuthItemChild` VALUES ('Staff','AwarenessItems.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','AwarenessItems.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsRecords.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsRecords.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsRecords.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsRequest.ByRecord');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsRequest.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsRequest.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsRecords.Search');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsRequest.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsRequest.ViewCert');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsResponse.ByRecord');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsResponse.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsResponse.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsResponse.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','BannsResponse.ViewCert');
INSERT INTO `AuthItemChild` VALUES ('Staff','BaptismCertificate.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','BaptismCertificate.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','BaptismCertificate.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','BaptismCertificate.ViewCert');
INSERT INTO `AuthItemChild` VALUES ('Staff','BaptismCertificate.ByRecord');
INSERT INTO `AuthItemChild` VALUES ('Staff','BaptismRecords.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','BaptismRecords.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','BaptismRecords.Search');
INSERT INTO `AuthItemChild` VALUES ('Staff','BaptismRecords.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','ConfirmationCertificate.ByRecord');
INSERT INTO `AuthItemChild` VALUES ('Staff','ConfirmationCertificate.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','ConfirmationCertificate.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','ConfirmationCertificate.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','ConfirmationCertificate.ViewCert');
INSERT INTO `AuthItemChild` VALUES ('Staff','ConfirmationRecords.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','ConfirmationRecords.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','ConfirmationRecords.Search');
INSERT INTO `AuthItemChild` VALUES ('Staff','ConfirmationRecords.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','DeathCertificate.ByRecord');
INSERT INTO `AuthItemChild` VALUES ('Staff','DeathCertificate.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','DeathCertificate.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','DeathCertificate.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','DeathCertificate.ViewCert');
INSERT INTO `AuthItemChild` VALUES ('Staff','DeathRecords.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','DeathRecords.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','DeathRecords.Search');
INSERT INTO `AuthItemChild` VALUES ('Staff','DeathRecords.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','Family.Children');
INSERT INTO `AuthItemChild` VALUES ('Staff','Family.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','Family.Dependents');
INSERT INTO `AuthItemChild` VALUES ('Staff','Family.FindMatch');
INSERT INTO `AuthItemChild` VALUES ('Staff','Family.Locate');
INSERT INTO `AuthItemChild` VALUES ('Staff','Family.Photo');
INSERT INTO `AuthItemChild` VALUES ('Staff','Family.Subscriptions');
INSERT INTO `AuthItemChild` VALUES ('Staff','Family.Search');
INSERT INTO `AuthItemChild` VALUES ('Staff','Family.Survey');
INSERT INTO `AuthItemChild` VALUES ('Staff','Family.Update');
INSERT INTO `AuthItemChild` VALUES ('Staff','Family.Visits');
INSERT INTO `AuthItemChild` VALUES ('Staff','FieldName.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','FieldName.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','FieldName.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','FieldValue.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','FieldValue.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','FieldValue.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','FirstCommunionCertificate.ByRecord');
INSERT INTO `AuthItemChild` VALUES ('Staff','FirstCommunionCertificate.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','FirstCommunionCertificate.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','FirstCommunionCertificate.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','FirstCommunionCertificate.ViewCert');
INSERT INTO `AuthItemChild` VALUES ('Staff','FirstCommunionRecords.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','FirstCommunionRecords.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','FirstCommunionRecords.Search');
INSERT INTO `AuthItemChild` VALUES ('Staff','FirstCommunionRecords.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','MarriageCertificate.ByRecord');
INSERT INTO `AuthItemChild` VALUES ('Staff','MarriageCertificate.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','MarriageCertificate.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','MarriageCertificate.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','MarriageCertificate.ViewCert');
INSERT INTO `AuthItemChild` VALUES ('Staff','MarriageRecords.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','MarriageRecords.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','MarriageRecords.Search');
INSERT INTO `AuthItemChild` VALUES ('Staff','MarriageRecords.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassBooking.Admin');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassBooking.Calendar');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassBooking.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassBooking.Delete');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassBooking.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassBooking.MassAmt');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassBooking.Masses');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassBooking.Search');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassBooking.Update');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassBooking.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassBooking.ViewCert');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassSchedule.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassSchedule.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','MassSchedule.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','MembershipCertificate.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','MembershipCertificate.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','MembershipCertificate.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','MembershipCertificate.ViewCert');
INSERT INTO `AuthItemChild` VALUES ('Staff','NeedData.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','NeedData.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','NeedData.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','NeedItems.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','NeedItems.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','NeedItems.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','NoImpedimentLetter.ByRecord');
INSERT INTO `AuthItemChild` VALUES ('Staff','NoImpedimentLetter.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','NoImpedimentLetter.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','NoImpedimentLetter.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','NoImpedimentLetter.ViewCert');
INSERT INTO `AuthItemChild` VALUES ('Staff','OpenData.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','OpenData.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','OpenData.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','OpenQuestion.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','OpenQuestion.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','OpenQuestion.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','OpenQuestions.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','OpenQuestions.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','OpenQuestions.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','Parish.Profile');
INSERT INTO `AuthItemChild` VALUES ('Staff','Parish.Search');
INSERT INTO `AuthItemChild` VALUES ('Staff','Pastor.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','Pastor.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','Person.Baptised');
INSERT INTO `AuthItemChild` VALUES ('Staff','Person.Confirmed');
INSERT INTO `AuthItemChild` VALUES ('Staff','Person.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','Person.FindMatch');
INSERT INTO `AuthItemChild` VALUES ('Staff','Person.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','Person.Married');
INSERT INTO `AuthItemChild` VALUES ('Staff','Person.Search');
INSERT INTO `AuthItemChild` VALUES ('Staff','Person.Update');
INSERT INTO `AuthItemChild` VALUES ('Staff','Person.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','SatisfactionData.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','SatisfactionData.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','SatisfactionData.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','SatisfactionItems.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','SatisfactionItems.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','Subscription.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','Subscription.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','Subscription.TillDate');
INSERT INTO `AuthItemChild` VALUES ('Staff','Subscription.Update');
INSERT INTO `AuthItemChild` VALUES ('Staff','Subscription.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','Subscription.ViewRect');
INSERT INTO `AuthItemChild` VALUES ('Staff','Visit.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','Visit.Index');
INSERT INTO `AuthItemChild` VALUES ('Staff','Visit.View');
INSERT INTO `AuthItemChild` VALUES ('Staff','YesnoData.Create');
INSERT INTO `AuthItemChild` VALUES ('Staff','YesnoData.Index');
UNLOCK TABLES;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
INSERT INTO `accounts` VALUES (1,'Income',NULL,1,NULL,'credit');
INSERT INTO `accounts` VALUES (2,'Expenses',NULL,1,NULL,'debit');
INSERT INTO `accounts` VALUES (3,'Assets',NULL,1,NULL,'debit');
INSERT INTO `accounts` VALUES (4,'Liabilities',NULL,1,NULL,'credit');
INSERT INTO `accounts` VALUES (5,'Mass Bookings',1,NULL,1,'credit');
INSERT INTO `accounts` VALUES (6,'Family Subscriptions',1,NULL,1,'credit');
INSERT INTO `accounts` VALUES (7,'Collection',1,NULL,1,'credit');
INSERT INTO `accounts` VALUES (8,'Clergy Maintenance',2,1,1,'debit');
INSERT INTO `accounts` VALUES (9,'Food expenses',8,NULL,NULL,'debit');
INSERT INTO `accounts` VALUES (10,'Apostolic Work Expenses',2,NULL,NULL,'debit');
INSERT INTO `accounts` VALUES (11,'Allowance to Parish Priest',2,NULL,NULL,'debit');
INSERT INTO `accounts` VALUES (12,'Feast and other expenses',2,NULL,NULL,'debit');
INSERT INTO `accounts` VALUES (13,'Certificate Charges',1,NULL,NULL,'credit');
UNLOCK TABLES;

--
-- Dumping data for table `awareness_items`
--

LOCK TABLES `awareness_items` WRITE;
INSERT INTO `awareness_items` VALUES (1,'Employment bureau');
INSERT INTO `awareness_items` VALUES (2,'Counselling center');
INSERT INTO `awareness_items` VALUES (3,'Youth groups');
INSERT INTO `awareness_items` VALUES (4,'Society of Vincent de Paul');
INSERT INTO `awareness_items` VALUES (5,'Parish website');
INSERT INTO `awareness_items` VALUES (6,'Ladies of charity');
INSERT INTO `awareness_items` VALUES (7,'Marriage bureau');
INSERT INTO `awareness_items` VALUES (8,'Legion of Mary');
UNLOCK TABLES;

--
-- Dumping data for table `field_names`
--

LOCK TABLES `field_names` WRITE;
INSERT INTO `field_names` VALUES (14,'awareness_level');
INSERT INTO `field_names` VALUES (11,'domicile_status');
INSERT INTO `field_names` VALUES (3,'education');
INSERT INTO `field_names` VALUES (5,'languages');
INSERT INTO `field_names` VALUES (18,'marital_status');
INSERT INTO `field_names` VALUES (2,'marriage_status');
INSERT INTO `field_names` VALUES (1,'marriage_type');
INSERT INTO `field_names` VALUES (4,'monthly_household_income');
INSERT INTO `field_names` VALUES (8,'need_level');
INSERT INTO `field_names` VALUES (16,'pastor_role');
INSERT INTO `field_names` VALUES (6,'rite');
INSERT INTO `field_names` VALUES (17,'salutation');
INSERT INTO `field_names` VALUES (7,'satisfaction_level');
INSERT INTO `field_names` VALUES (13,'sex');
INSERT INTO `field_names` VALUES (19,'visit_purpose');
INSERT INTO `field_names` VALUES (15,'weekdays');
INSERT INTO `field_names` VALUES (10,'zones');
INSERT INTO `field_names` VALUES (20,'blood_group');
INSERT INTO `field_names` VALUES (21,'house_status');
UNLOCK TABLES;

--
-- Dumping data for table `field_values`
--

LOCK TABLES `field_values` WRITE;
INSERT INTO `field_values` VALUES (1,1,'Regular',1,1);
INSERT INTO `field_values` VALUES (1,2,'Irregular',2,2);
INSERT INTO `field_values` VALUES (2,3,'Married',2,2);
INSERT INTO `field_values` VALUES (2,4,'Separated',3,3);
INSERT INTO `field_values` VALUES (2,5,'Divorced',4,4);
INSERT INTO `field_values` VALUES (2,6,'Widowed',5,5);
INSERT INTO `field_values` VALUES (1,7,'Disparity of cult',4,4);
INSERT INTO `field_values` VALUES (3,8,'< High School',1,1);
INSERT INTO `field_values` VALUES (3,9,'High School',2,2);
INSERT INTO `field_values` VALUES (3,10,'Graduate',3,3);
INSERT INTO `field_values` VALUES (3,11,'Post Graduate',4,4);
INSERT INTO `field_values` VALUES (4,12,'< 10000',1,1);
INSERT INTO `field_values` VALUES (4,13,'10k - 50k',2,2);
INSERT INTO `field_values` VALUES (4,14,'50k - 1 lakh',3,3);
INSERT INTO `field_values` VALUES (4,15,'above 1 lakh',4,4);
INSERT INTO `field_values` VALUES (5,16,'English',1,1);
INSERT INTO `field_values` VALUES (5,17,'Kannada',2,2);
INSERT INTO `field_values` VALUES (5,18,'Tamil',3,3);
INSERT INTO `field_values` VALUES (6,19,'Syro Malabar',10,10);
INSERT INTO `field_values` VALUES (6,20,'Syro Malankara',5,5);
INSERT INTO `field_values` VALUES (7,21,'Very Dissatisfied',1,1);
INSERT INTO `field_values` VALUES (7,23,'Dissatisfied',2,2);
INSERT INTO `field_values` VALUES (7,24,'Neutral',3,3);
INSERT INTO `field_values` VALUES (7,25,'Satisfied',4,4);
INSERT INTO `field_values` VALUES (7,26,'Very Satisfied',5,5);
INSERT INTO `field_values` VALUES (8,27,'Not Important',1,1);
INSERT INTO `field_values` VALUES (8,28,'Important',2,2);
INSERT INTO `field_values` VALUES (8,29,'Very Important',3,3);
INSERT INTO `field_values` VALUES (8,30,'Dissatisfied',4,4);
INSERT INTO `field_values` VALUES (8,31,'Will join/attend',5,5);
INSERT INTO `field_values` VALUES (10,32,'Zone A',1,1);
INSERT INTO `field_values` VALUES (10,33,'Zone B',2,2);
INSERT INTO `field_values` VALUES (10,34,'Zone C',3,3);
INSERT INTO `field_values` VALUES (10,35,'Zone D',4,4);
INSERT INTO `field_values` VALUES (11,36,'Home',1,1);
INSERT INTO `field_values` VALUES (11,37,'Away',2,2);
INSERT INTO `field_values` VALUES (13,38,'Male',1,1);
INSERT INTO `field_values` VALUES (13,39,'Female',2,2);
INSERT INTO `field_values` VALUES (14,40,'Accessed',3,3);
INSERT INTO `field_values` VALUES (14,41,'Aware',2,2);
INSERT INTO `field_values` VALUES (6,42,'Latin',1,3);
INSERT INTO `field_values` VALUES (15,46,'Sunday',0,0);
INSERT INTO `field_values` VALUES (15,47,'Monday',1,1);
INSERT INTO `field_values` VALUES (15,48,'Tuesday',2,2);
INSERT INTO `field_values` VALUES (15,49,'Wednesday',3,3);
INSERT INTO `field_values` VALUES (15,50,'Thursday',4,4);
INSERT INTO `field_values` VALUES (15,51,'Friday',5,5);
INSERT INTO `field_values` VALUES (15,52,'Saturday',6,6);
INSERT INTO `field_values` VALUES (14,53,'Not Aware',1,1);
INSERT INTO `field_values` VALUES (16,56,'Parish Priest',1,1);
INSERT INTO `field_values` VALUES (16,57,'Assistant Parish Priest',2,2);
INSERT INTO `field_values` VALUES (17,58,'Fr.',1,1);
INSERT INTO `field_values` VALUES (17,59,'Msgr.',2,2);
INSERT INTO `field_values` VALUES (18,60,'Single',1,1);
INSERT INTO `field_values` VALUES (6,63,'Other',15,15);
INSERT INTO `field_values` VALUES (18,64,'Annulled',5,5);
INSERT INTO `field_values` VALUES (18,65,'Widowed',6,6);
INSERT INTO `field_values` VALUES (1,66,'Mixed',3,3);
INSERT INTO `field_values` VALUES (19,67,'Easter Blessing',1,1);
INSERT INTO `field_values` VALUES (19,68,'Anointing of the Sick',2,2);
INSERT INTO `field_values` VALUES (19,69,'Communion to the Sick',3,3);
INSERT INTO `field_values` VALUES (19,70,'Special Occasion',4,4);
INSERT INTO `field_values` VALUES (20,71,'A +ve',1,1);
INSERT INTO `field_values` VALUES (20,72,'A -ve',2,2);
INSERT INTO `field_values` VALUES (20,73,'B +ve',3,3);
INSERT INTO `field_values` VALUES (20,74,'B -ve',4,4);
INSERT INTO `field_values` VALUES (20,75,'O +ve',5,5);
INSERT INTO `field_values` VALUES (20,76,'O -ve',6,6);
INSERT INTO `field_values` VALUES (20,77,'AB +ve',7,7);
INSERT INTO `field_values` VALUES (20,78,'AB -ve',8,8);
INSERT INTO `field_values` VALUES (21,79,'Own',1,1);
INSERT INTO `field_values` VALUES (21,80,'Rented/Leased',2,2);
UNLOCK TABLES;

--
-- Dumping data for table `need_items`
--

LOCK TABLES `need_items` WRITE;
INSERT INTO `need_items` VALUES (1,'Bible study');
INSERT INTO `need_items` VALUES (2,'Night vigil');
INSERT INTO `need_items` VALUES (3,'Legal aid');
INSERT INTO `need_items` VALUES (4,'Catholic enquiry center');
INSERT INTO `need_items` VALUES (5,'Intercession group (prayer warrior)');
INSERT INTO `need_items` VALUES (6,'Regular retreats');
INSERT INTO `need_items` VALUES (7,'Social media interaction');
INSERT INTO `need_items` VALUES (8,'Basic Christian Community');
INSERT INTO `need_items` VALUES (9,'Mission, etc');
INSERT INTO `need_items` VALUES (10,'Apologetics center');
INSERT INTO `need_items` VALUES (11,'Sacraments for inbound members (sick, elderly)');
UNLOCK TABLES;

--
-- Dumping data for table `open_questions`
--

LOCK TABLES `open_questions` WRITE;
INSERT INTO `open_questions` VALUES (1,'Are you attending a Bible study?','yesno',1);
INSERT INTO `open_questions` VALUES (2,'If yes, specify (catholic / other denomination)','string',2);
INSERT INTO `open_questions` VALUES (3,'Do you attend periodic retreats / prayer group meetings?','yesno',3);
INSERT INTO `open_questions` VALUES (4,'If yes, specify (catholic / other denomination)','string',4);
INSERT INTO `open_questions` VALUES (5,'Do your children attend Sunday school (catechism)?','yesno',5);
INSERT INTO `open_questions` VALUES (6,'Do you attend Novena services regularly?','yesno',6);
INSERT INTO `open_questions` VALUES (7,'Have you availed medical aid from the parish?','yesno',7);
INSERT INTO `open_questions` VALUES (8,'Have you availed education support from the parish?','yesno',8);
INSERT INTO `open_questions` VALUES (9,'Do you attend worship at any other non catholic church?','yesno',9);
INSERT INTO `open_questions` VALUES (10,'If yes, how many times a month?','integer',10);
INSERT INTO `open_questions` VALUES (11,'How often do you attend Mass per month?','integer',11);
INSERT INTO `open_questions` VALUES (12,'What is the ideal frequency for receiving the Sacrament of Reconciliation?','string',12);
UNLOCK TABLES;

--
-- Dumping data for table `satisfaction_items`
--

LOCK TABLES `satisfaction_items` WRITE;
INSERT INTO `satisfaction_items` VALUES (1,'Service');
INSERT INTO `satisfaction_items` VALUES (2,'Preaching & message');
INSERT INTO `satisfaction_items` VALUES (3,'Novena');
INSERT INTO `satisfaction_items` VALUES (4,'Choir');
INSERT INTO `satisfaction_items` VALUES (5,'Ushering');
INSERT INTO `satisfaction_items` VALUES (6,'Lectors');
INSERT INTO `satisfaction_items` VALUES (7,'Decorations arrangement');
INSERT INTO `satisfaction_items` VALUES (8,'Adoration');
INSERT INTO `satisfaction_items` VALUES (9,'Sunday school');
INSERT INTO `satisfaction_items` VALUES (10,'Preparation for Sacraments');
INSERT INTO `satisfaction_items` VALUES (11,'Adult Catechesis');
INSERT INTO `satisfaction_items` VALUES (12,'Bible study');
INSERT INTO `satisfaction_items` VALUES (13,'Retreats');
INSERT INTO `satisfaction_items` VALUES (14,'Parish website');
UNLOCK TABLES;

-- Dump completed on 2014-01-02 17:02:22
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
ALTER TABLE `pastors` AUTO_INCREMENT=1;
ALTER TABLE `people` AUTO_INCREMENT=1;
ALTER TABLE `satisfaction_data` AUTO_INCREMENT=1;
ALTER TABLE `subscriptions` AUTO_INCREMENT=1;
ALTER TABLE `transactions` AUTO_INCREMENT=1;
ALTER TABLE `users` AUTO_INCREMENT=1;
ALTER TABLE `visits` AUTO_INCREMENT=1;


--   END OF AUTO INCREMENT RESET   ---
--  END OF FILE ---

