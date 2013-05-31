CREATE TABLE banns(
	id integer primary key auto_increment,
	groom_name varchar(100) not null,
	groom_parent varchar(100),
	groom_parish varchar(50),
	bride_name varchar(100) not null,
	bride_parent varchar(100),
	bride_parish varchar(50),
	banns_dt1 date,
	banns_dt2 date,
	banns_dt3 date
);

CREATE TABLE `banns_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banns_id` int(11) DEFAULT NULL,
  `req_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banns_id` (`banns_id`),
  CONSTRAINT `banns_requests_ibfk_1` FOREIGN KEY (`banns_id`) REFERENCES `banns` (`id`)
);

CREATE TABLE `banns_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banns_id` int(11) DEFAULT NULL,
  `res_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banns_id` (`banns_id`),
  CONSTRAINT `banns_responses_ibfk_1` FOREIGN KEY (`banns_id`) REFERENCES `banns` (`id`)
);

CREATE TABLE `no_impediment_letters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banns_id` int(11) DEFAULT NULL,
  `letter_dt` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banns_id` (`banns_id`),
  CONSTRAINT `no_impediment_letters_ibfk_1` FOREIGN KEY (`banns_id`) REFERENCES `banns` (`id`)
);
