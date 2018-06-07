/*
SQLyog Community
MySQL - 10.1.30-MariaDB : Database - bel3s
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `username` varchar(16) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `admin` */

insert  into `admin`(`username`,`email`,`password`,`create_time`) values 
('admin','k.kosut@gmail.com','$2a$07$belesbel3ssaltsoosasd.F9U4lYWuNB96dJDEjaag/ltq2ISeioi','2018-02-02 21:11:01');

/*Table structure for table `fotka` */

DROP TABLE IF EXISTS `fotka`;

CREATE TABLE `fotka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL DEFAULT 'default.png',
  `path` varchar(255) COLLATE utf8_czech_ci NOT NULL DEFAULT 'img/',
  `jidlo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fotka_jidlo1_idx` (`jidlo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `fotka` */

insert  into `fotka`(`id`,`nazev`,`path`,`jidlo_id`) values 
(1,'602169433unnamed.gif','img/',1),
(2,'default.png','img/',2),
(3,'default.png','img/',3),
(4,'default.png','img/',4),
(5,'default.png','img/',5),
(6,'default.png','img/',6),
(7,'default.png','img/',7),
(8,'default.png','img/',8),
(9,'default.png','img/',9),
(10,'default.png','img/',10),
(11,'default.png','img/',11),
(12,'default.png','img/',12),
(13,'default.png','img/',13),
(14,'default.png','img/',14),
(15,'default.png','img/',15),
(16,'default.png','img/',16),
(17,'default.png','img/',17),
(18,'default.png','img/',18),
(19,'default.png','img/',19),
(20,'default.png','img/',20),
(21,'default.png','img/',21),
(22,'default.png','img/',22),
(23,'default.png','img/',23),
(24,'default.png','img/',24),
(25,'default.png','img/',25),
(26,'default.png','img/',26),
(27,'default.png','img/',27),
(28,'default.png','img/',28),
(29,'default.png','img/',29),
(30,'default.png','img/',30),
(31,'default.png','img/',31),
(32,'default.png','img/',32),
(33,'default.png','img/',33),
(34,'default.png','img/',35),
(37,'10173579283e031b2a47fe86b16260dcc2f39df690.jpg','img/',36),
(40,'3013658329249903_1846340865396872_738984273289150464_n.jpg','img/',39),
(41,'1685049571697061966nintchdbpict000000544662.jpg','img/',40),
(42,'2031190445cz_pim_72472001001_00.jpg','img/',41),
(43,'686373179MIN_176787_CSA.jpg','img/',42),
(47,'default.png','img/',167),
(48,'1088627031cz_pim_72472001001_00.jpg','img/',43),
(49,'default.png','img/',44),
(50,'default.png','img/',45),
(51,'default.png','img/',46),
(52,'default.png','img/',47),
(53,'default.png','img/',48),
(54,'default.png','img/',49),
(55,'default.png','img/',50),
(56,'default.png','img/',51),
(57,'default.png','img/',52),
(58,'default.png','img/',53),
(59,'default.png','img/',54),
(60,'default.png','img/',55),
(61,'default.png','img/',56),
(62,'default.png','img/',57),
(63,'default.png','img/',58),
(64,'default.png','img/',59),
(65,'default.png','img/',60),
(66,'default.png','img/',61),
(67,'default.png','img/',62),
(68,'default.png','img/',63),
(69,'default.png','img/',64),
(70,'default.png','img/',65),
(71,'default.png','img/',66),
(72,'default.png','img/',67),
(73,'default.png','img/',68),
(74,'default.png','img/',69),
(75,'default.png','img/',70),
(76,'default.png','img/',71),
(77,'default.png','img/',72),
(78,'default.png','img/',73),
(79,'default.png','img/',74),
(80,'default.png','img/',75),
(81,'default.png','img/',76),
(82,'default.png','img/',77),
(83,'default.png','img/',78),
(84,'default.png','img/',79),
(85,'default.png','img/',80),
(86,'default.png','img/',81),
(87,'default.png','img/',82),
(88,'default.png','img/',83),
(89,'default.png','img/',84),
(90,'default.png','img/',85),
(91,'default.png','img/',86),
(92,'default.png','img/',87),
(93,'default.png','img/',88),
(94,'default.png','img/',89),
(95,'default.png','img/',90),
(96,'default.png','img/',91),
(97,'default.png','img/',92),
(98,'default.png','img/',93),
(99,'default.png','img/',94),
(100,'default.png','img/',95);

/*Table structure for table `kategorie` */

DROP TABLE IF EXISTS `kategorie`;

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `background` varchar(255) COLLATE utf8_czech_ci NOT NULL DEFAULT 'default.jpg',
  `alt` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `topmenu` tinyint(4) NOT NULL DEFAULT '1',
  `hidden` tinyint(4) NOT NULL DEFAULT '0',
  `url` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `position` int(11) DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `kategorie` */

insert  into `kategorie`(`id`,`nazev`,`background`,`alt`,`topmenu`,`hidden`,`url`,`position`,`icon`,`visible`) values 
(62,'Bagety','default.jpg',NULL,1,0,'bagety',NULL,NULL,1),
(63,'Balená voda','default.jpg',NULL,0,0,'balenavoda',NULL,NULL,0),
(65,'Belgické koule','default.jpg',NULL,0,0,'belgickekoule',NULL,NULL,1),
(66,'Káva','default.jpg',NULL,0,0,'kava',NULL,NULL,1),
(67,'Nápoje','default.jpg',NULL,1,0,'napoje',NULL,NULL,1),
(68,'Nápoje k menu','default.jpg',NULL,0,0,'napojekmenu',NULL,NULL,0),
(69,'Omáčky','default.jpg',NULL,0,0,'omacky',NULL,NULL,0),
(70,'Ostatní','default.jpg',NULL,0,0,'ostatni',NULL,NULL,0),
(71,'Ovoce','default.jpg',NULL,0,0,'ovoce',NULL,NULL,0),
(72,'Polévka','default.jpg',NULL,1,0,'polevka',NULL,NULL,1),
(73,'Přílohy','default.jpg',NULL,0,0,'prilohy',NULL,NULL,1),
(74,'Stripsy','default.jpg',NULL,1,0,'stripsy',NULL,NULL,1),
(75,'Vafle','default.jpg',NULL,1,0,'vafle',NULL,NULL,1);

/*Table structure for table `kosik` */

DROP TABLE IF EXISTS `kosik`;

CREATE TABLE `kosik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cenaCelkem` varchar(45) COLLATE utf8_czech_ci NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transfered` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `kosik` */

/*Table structure for table `kosik_has_menuItem` */

DROP TABLE IF EXISTS `kosik_has_menuItem`;

CREATE TABLE `kosik_has_menuItem` (
  `kosik_id` int(11) NOT NULL,
  `menuItem_id` int(11) NOT NULL,
  `pocet` int(11) NOT NULL DEFAULT '1',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_kosik_has_menuItem_menuItem1_idx` (`menuItem_id`),
  KEY `fk_kosik_has_menuItem_kosik1_idx` (`kosik_id`),
  CONSTRAINT `fk_kosik_has_menuItem_kosik1` FOREIGN KEY (`kosik_id`) REFERENCES `kosik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kosik_has_menuItem_menuItem1` FOREIGN KEY (`menuItem_id`) REFERENCES `menuItem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `kosik_has_menuItem` */

/*Table structure for table `login_attempt` */

DROP TABLE IF EXISTS `login_attempt`;

CREATE TABLE `login_attempt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `time` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `login_attempt` */

/*Table structure for table `menuItem` */

DROP TABLE IF EXISTS `menuItem`;

CREATE TABLE `menuItem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `popis` text COLLATE utf8_czech_ci,
  `ingredience` text COLLATE utf8_czech_ci,
  `cena` int(11) NOT NULL,
  `id_sezona` int(10) unsigned DEFAULT '0',
  `kategorie` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `gramaz` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `prilohy` varchar(255) COLLATE utf8_czech_ci DEFAULT '0',
  `priloha` tinyint(4) DEFAULT '0',
  `priloha_modulo` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `menuItem` */

insert  into `menuItem`(`id`,`nazev`,`popis`,`ingredience`,`cena`,`id_sezona`,`kategorie`,`gramaz`,`prilohy`,`priloha`,`priloha_modulo`) values 
(49,'Plněná bageta s kuřecími stripsy',NULL,NULL,109,0,'bagety','','0',0,0),
(50,'Plněná bageta s vepřovými stripsy',NULL,NULL,109,0,'bagety','','0',0,0),
(51,'Perlivá',NULL,NULL,0,0,'balenavoda','500ml','0',1,0),
(52,'Jemně perlivá',NULL,NULL,0,0,'Balená voda','500ml','0',1,0),
(53,'Neperlivá',NULL,NULL,0,0,'Balená voda','500ml','0',1,0),
(54,'Belgické koule',NULL,NULL,85,0,'belgickekoule','','1',0,1),
(55,'Espresso',NULL,NULL,35,0,'kava','200ml','0',0,0),
(56,'Cappucino',NULL,NULL,35,0,'kava','200ml','0',0,0),
(57,'Americano',NULL,NULL,35,0,'kava','200ml','0',0,0),
(58,'Cappucino',NULL,NULL,45,0,'kava','400ml','0',0,0),
(59,'Latté machiato',NULL,NULL,45,0,'kava','400ml','0',0,0),
(60,'Latté',NULL,NULL,45,0,'kava','400ml','0',0,0),
(61,'Domácí limonáda grep',NULL,NULL,39,0,'napoje','500ml','0',0,0),
(62,'Domácí limonáda bez',NULL,NULL,39,0,'napoje','500ml','0',0,0),
(63,'Domácí limonáda zázvor ',NULL,NULL,39,0,'napoje','500ml','0',0,0),
(64,'Domácí limonáda malina',NULL,NULL,39,0,'napoje','500ml','0',0,0),
(65,'Soda',NULL,NULL,29,0,'napoje','500ml','0',0,0),
(66,'Čaj',NULL,NULL,35,0,'napoje','400ml','0',0,0),
(67,'Čokoláda shake',NULL,NULL,49,0,'napoje','500ml','0',0,0),
(68,'Jahoda shake',NULL,NULL,49,0,'napoje','500ml','0',0,0),
(69,'Nealkoholické pivo',NULL,NULL,39,0,'napoje','330ml','0',0,0),
(70,'Alkoholické pivo',NULL,NULL,39,0,'napoje','330ml','0',0,0),
(71,'Balená voda',NULL,NULL,29,0,'napoje','500ml','1',0,1),
(72,'Domácí limonáda grep',NULL,NULL,29,0,'napojekmenu','500ml','0',0,0),
(73,'Domácí limonáda bez',NULL,NULL,29,0,'napojekmenu','500ml','0',0,0),
(74,'Domácí limonáda zázvor ',NULL,NULL,29,0,'napojekmenu','500ml','0',0,0),
(75,'Domácí limonáda malina',NULL,NULL,29,0,'napojekmenu','500ml','0',0,0),
(76,'Omáčka z Lutychu',NULL,NULL,10,0,'omacky','','0',1,0),
(77,'Smetanová omáčka',NULL,NULL,10,0,'omacky','','0',1,0),
(78,'Omáčka',NULL,NULL,19,0,'omacky','','0',1,0),
(79,'Šlehačka',NULL,NULL,10,0,'ostatni','','0',1,0),
(80,'Nutela',NULL,NULL,15,0,'ostatni','','0',1,0),
(81,'Ořechy',NULL,NULL,15,0,'ostatni','','0',1,0),
(82,'Jahody',NULL,NULL,15,0,'ovoce','','0',1,0),
(83,'Banan',NULL,NULL,10,0,'ovoce','','0',1,0),
(84,'Polévka',NULL,NULL,49,0,'polevka','','0',0,0),
(85,'Hranolky',NULL,NULL,59,0,'prilohy','','1',1,1),
(86,'Bramborová kaše',NULL,NULL,45,0,'prilohy','','0',1,0),
(87,'Salát balený',NULL,NULL,109,0,'prilohy','','0',1,0),
(88,'Salát malý',NULL,NULL,39,0,'prilohy','','0',1,0),
(89,'Salát velký',NULL,NULL,65,0,'prilohy','','0',1,0),
(90,'Kuřecí stripsy',NULL,NULL,69,0,'stripsy','','1',0,1),
(91,'Vepřové stripsy',NULL,NULL,89,0,'stripsy','','1',0,1),
(92,'Žebra stripsy',NULL,NULL,79,0,'stripsy','','1',0,1),
(93,'Rybí stripsy',NULL,NULL,109,0,'stripsy','','1',0,1),
(94,'Sýrové stripsy',NULL,NULL,79,0,'stripsy','','1',0,1),
(95,'Belgická vafle',NULL,NULL,29,0,'vafle','','1',0,1);

/*Table structure for table `menuItem_has_kategorie` */

DROP TABLE IF EXISTS `menuItem_has_kategorie`;

CREATE TABLE `menuItem_has_kategorie` (
  `menuItem_id` int(11) NOT NULL,
  `kategorie_id` int(11) NOT NULL,
  PRIMARY KEY (`menuItem_id`,`kategorie_id`),
  KEY `fk_menuItem_has_kategorie_kategorie1_idx` (`kategorie_id`),
  KEY `fk_menuItem_has_kategorie_menuItem1_idx` (`menuItem_id`),
  CONSTRAINT `fk_menuItem_has_kategorie_kategorie1` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_menuItem_has_kategorie_menuItem1` FOREIGN KEY (`menuItem_id`) REFERENCES `menuItem` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `menuItem_has_kategorie` */

/*Table structure for table `objednavka` */

DROP TABLE IF EXISTS `objednavka`;

CREATE TABLE `objednavka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `cenacelkem` float DEFAULT NULL,
  `zpusobdoruceni` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `adresadoruceni` text COLLATE utf8_czech_ci,
  `poznamka` text COLLATE utf8_czech_ci,
  `email` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `mobil` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kosik_id` int(11) DEFAULT NULL,
  `casdoruceni` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_objednavka_user1_idx` (`user_id`),
  KEY `fk_objednavka_kosik1_idx` (`kosik_id`),
  CONSTRAINT `fk_objednavka_kosik1` FOREIGN KEY (`kosik_id`) REFERENCES `kosik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_objednavka_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `objednavka` */

/*Table structure for table `objednavka_prefilled` */

DROP TABLE IF EXISTS `objednavka_prefilled`;

CREATE TABLE `objednavka_prefilled` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `zpusobdoruceni` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `adresadoruceni` text COLLATE utf8_czech_ci,
  `zpusobplaceni` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_objednavka_prefilled_user1_idx` (`user_id`),
  CONSTRAINT `fk_objednavka_prefilled_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `objednavka_prefilled` */

/*Table structure for table `objednavka_status_info` */

DROP TABLE IF EXISTS `objednavka_status_info`;

CREATE TABLE `objednavka_status_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `nazev` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `objednavka_status_info` */

insert  into `objednavka_status_info`(`id`,`status`,`nazev`) values 
(1,'1','Přijatá'),
(2,'2','Vydaná'),
(3,'3','Stornovaná');

/*Table structure for table `priloha` */

DROP TABLE IF EXISTS `priloha`;

CREATE TABLE `priloha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menuItem_id` int(11) DEFAULT NULL,
  `kategorie_id` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `priloha_menuItem_id_fk` (`menuItem_id`),
  KEY `priloha_kategorie_id_fk` (`kategorie_id`),
  CONSTRAINT `priloha_kategorie_id_fk` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `priloha_menuItem_id_fk` FOREIGN KEY (`menuItem_id`) REFERENCES `menuItem` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='propojeni priloh s jidlem a kategoriemi';

/*Data for the table `priloha` */

insert  into `priloha`(`id`,`menuItem_id`,`kategorie_id`,`active`) values 
(1,51,67,1),
(2,52,67,1),
(3,53,67,1),
(4,76,65,1),
(5,77,65,1),
(6,79,75,1),
(7,80,75,1),
(8,81,75,1),
(9,82,75,1),
(10,83,75,1);

/*Table structure for table `project_info` */

DROP TABLE IF EXISTS `project_info`;

CREATE TABLE `project_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `implementation_name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `project_info` */

insert  into `project_info`(`id`,`name`,`implementation_name`,`value`) values 
(1,NULL,'disable_orders','1');

/*Table structure for table `sezona` */

DROP TABLE IF EXISTS `sezona`;

CREATE TABLE `sezona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `od` date DEFAULT NULL,
  `do` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `sezona` */

/*Table structure for table `stranka` */

DROP TABLE IF EXISTS `stranka`;

CREATE TABLE `stranka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `pouzito` tinyint(4) DEFAULT NULL,
  `content` text COLLATE utf8_czech_ci,
  `active` tinyint(3) NOT NULL DEFAULT '0',
  `nazev` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
  `parrent_menu` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `url` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `stranka` */

insert  into `stranka`(`id`,`key`,`role`,`datum`,`pouzito`,`content`,`active`,`nazev`,`parrent_menu`,`image`,`url`) values 
(1,NULL,'page',NULL,NULL,NULL,0,'O nás',NULL,NULL,'o-nas');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) COLLATE utf8_czech_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jmeno` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `body` int(11) DEFAULT '0',
  `mobil` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `adresa` text COLLATE utf8_czech_ci,
  `registered` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

/*Data for the table `user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
