-- MySQL Script generated by MySQL Workbench
-- Sun Jan 28 17:24:44 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Bel3s
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Bel3s` ;

-- -----------------------------------------------------
-- Schema Bel3s
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Bel3s` DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci ;
USE `Bel3s` ;

-- -----------------------------------------------------
-- Table `Bel3s`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bel3s`.`user` ;

CREATE TABLE IF NOT EXISTS `Bel3s`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(16) NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(32) NOT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `jmeno` VARCHAR(45) NOT NULL,
  `prijmeni` VARCHAR(45) NOT NULL,
  `body` INT NULL DEFAULT 0,
  `mobil` VARCHAR(45) NULL,
  `adresa` TEXT NULL,
  `registered` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `Bel3s`.`login_attempt`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bel3s`.`login_attempt` ;

CREATE TABLE IF NOT EXISTS `Bel3s`.`login_attempt` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `time` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `Bel3s`.`menuItem`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bel3s`.`menuItem` ;

CREATE TABLE IF NOT EXISTS `Bel3s`.`menuItem` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nazev` VARCHAR(255) NOT NULL,
  `popis` TEXT NULL,
  `ingredience` TEXT NULL,
  `cena` INT NOT NULL,
  `id_sezona` INT UNSIGNED NULL DEFAULT 0,
  `kategorie` VARCHAR(45) NULL,
  `gramaz` VARCHAR(45) NULL,
  `prilohy` VARCHAR(255) NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Bel3s`.`kategorie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bel3s`.`kategorie` ;

CREATE TABLE IF NOT EXISTS `Bel3s`.`kategorie` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nazev` VARCHAR(45) NULL,
  `foto` VARCHAR(255) NOT NULL DEFAULT 'pict/default.png',
  `alt` VARCHAR(45) NULL,
  `topmenu` TINYINT NOT NULL DEFAULT 1,
  `url` VARCHAR(45) NOT NULL,
  `position` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Bel3s`.`kosik`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bel3s`.`kosik` ;

CREATE TABLE IF NOT EXISTS `Bel3s`.`kosik` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cenaCelkem` VARCHAR(45) NOT NULL DEFAULT 0,
  `user_id` INT NOT NULL DEFAULT 0,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transfered` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Bel3s`.`objednavka`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bel3s`.`objednavka` ;

CREATE TABLE IF NOT EXISTS `Bel3s`.`objednavka` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL DEFAULT 0,
  `cenacelkem` FLOAT NULL,
  `zpusobdoruceni` VARCHAR(45) NULL,
  `adresadoruceni` TEXT NULL,
  `poznamka` TEXT NULL,
  `email` VARCHAR(45) NOT NULL,
  `mobil` VARCHAR(45) NOT NULL,
  `time_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kosik_id` INT NULL,
  `casdoruceni` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_objednavka_user1_idx` (`user_id` ASC),
  INDEX `fk_objednavka_kosik1_idx` (`kosik_id` ASC),
  CONSTRAINT `fk_objednavka_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `Bel3s`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_objednavka_kosik1`
    FOREIGN KEY (`kosik_id`)
    REFERENCES `Bel3s`.`kosik` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Bel3s`.`admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bel3s`.`admin` ;

CREATE TABLE IF NOT EXISTS `Bel3s`.`admin` (
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(255) NOT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP);


-- -----------------------------------------------------
-- Table `Bel3s`.`stranka`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bel3s`.`stranka` ;

CREATE TABLE IF NOT EXISTS `Bel3s`.`stranka` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `key` VARCHAR(255) NULL,
  `role` VARCHAR(255) NULL,
  `datum` DATE NULL,
  `pouzito` TINYINT NULL,
  `content` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Bel3s`.`fotka`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bel3s`.`fotka` ;

CREATE TABLE IF NOT EXISTS `Bel3s`.`fotka` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nazev` VARCHAR(45) NOT NULL DEFAULT 'default.png',
  `path` VARCHAR(255) NOT NULL DEFAULT 'img/',
  `jidlo_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_fotka_jidlo1_idx` (`jidlo_id` ASC),
  CONSTRAINT `fk_fotka_jidlo1`
    FOREIGN KEY (`jidlo_id`)
    REFERENCES `Bel3s`.`menuItem` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Bel3s`.`sezona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bel3s`.`sezona` ;

CREATE TABLE IF NOT EXISTS `Bel3s`.`sezona` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nazev` VARCHAR(45) NOT NULL,
  `od` DATE NULL,
  `do` DATE NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Bel3s`.`menuItem_has_kategorie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bel3s`.`menuItem_has_kategorie` ;

CREATE TABLE IF NOT EXISTS `Bel3s`.`menuItem_has_kategorie` (
  `menuItem_id` INT NOT NULL,
  `kategorie_id` INT NOT NULL,
  PRIMARY KEY (`menuItem_id`, `kategorie_id`),
  INDEX `fk_menuItem_has_kategorie_kategorie1_idx` (`kategorie_id` ASC),
  INDEX `fk_menuItem_has_kategorie_menuItem1_idx` (`menuItem_id` ASC),
  CONSTRAINT `fk_menuItem_has_kategorie_menuItem1`
    FOREIGN KEY (`menuItem_id`)
    REFERENCES `Bel3s`.`menuItem` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_menuItem_has_kategorie_kategorie1`
    FOREIGN KEY (`kategorie_id`)
    REFERENCES `Bel3s`.`kategorie` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Bel3s`.`kosik_has_menuItem`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bel3s`.`kosik_has_menuItem` ;

CREATE TABLE IF NOT EXISTS `Bel3s`.`kosik_has_menuItem` (
  `kosik_id` INT NOT NULL,
  `menuItem_id` INT NOT NULL,
  `pocet` INT NOT NULL DEFAULT 1,
  `id` INT NOT NULL AUTO_INCREMENT,
  INDEX `fk_kosik_has_menuItem_menuItem1_idx` (`menuItem_id` ASC),
  INDEX `fk_kosik_has_menuItem_kosik1_idx` (`kosik_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_kosik_has_menuItem_kosik1`
    FOREIGN KEY (`kosik_id`)
    REFERENCES `Bel3s`.`kosik` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kosik_has_menuItem_menuItem1`
    FOREIGN KEY (`menuItem_id`)
    REFERENCES `Bel3s`.`menuItem` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `Bel3s`.`menuItem`
-- -----------------------------------------------------
START TRANSACTION;
USE `Bel3s`;
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Belfrites', 'ručně dělané smažené belgické hranolky osmažené v hovězím tuku a podávané v kornoutu', NULL, 49, 0, 'hranolky', '200g', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Chicken strips', 'kousky kuřecího masa obalené v crispy směsi vyráběné ve stánku, osmažené a podávané v kornoutu', NULL, 69, 0, 'stripsy', '170g', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Mr. Pork strips', 'kousky masa z vepřové panenky obalené v crispy směsi vyráběné ve stánku, osmažené a podávané v kornoutu', NULL, 79, 0, 'stripsy', '170g', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Cheese BelBrie', 'smažené sýrové kousky z camembertu obalené v crispy směsi vyráběné ve stánku, osmažené a podávané v kornoutu', NULL, 69, 0, 'stripsy', '170g', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Belgické masové koule', 'mletá masová směs s bylinkami ve tvaru koule dle belgické receptury připravené v páře a podávané v kornoutu', NULL, 69, 0, 'masovekoule', '150g', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Grande chicken baguette', 'plněná bageta s kuřecími stripsy, hranolkami, zeleninou a omáčkou', 'Chicken strips, Belfrites, Dip ', 79, 0, 'bagety', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Grande pork baguette', 'plněná bageta s vepřovými stripsy, hranolkami, zeleninou a omáčkou', 'Mr. Pork strips, Belfrites, Dip ', 89, 0, 'bagety', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Grande cheese baguette', 'plněná bageta se sýrovými kousky BelBrie, hranolkami, zeleninou a omáčkou', 'Cheese BelBrie, Belfrites, Dip ', 79, 0, 'bagety', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Petite ham baquette', 'plněná zapečená snídaňová bageta se šunkou, sýrem, vejcem, zeleninou a dresinkem', NULL, 59, 0, 'bagety', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Petite bacon baguette', 'plněná zapečená snídaňová bageta se slaninou, sýrem, vejcem, zeleninou a dresinkem', NULL, 59, 0, 'bagety', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Petite cheese baguette', 'plněná zapečená snídaňová bageta se sýrem, zeleninou a dresinkem', NULL, 59, 0, 'bagety', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Chicken tornade', 'tortilla plněná kuřecím masem připravovaným v páře, zeleninou a omáčkou', NULL, 79, 0, 'tortilla', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Mr. Pork tornade', 'tortilla plněná vepřovou panenkou připravovanou v páře, zeleninou a omáčkou', '', 79, 0, 'tortilla', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Belgická vafle', 'belgické vafle bez náplně', NULL, 29, 0, 'wafle', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Belgická vafle plněná čokoládou', 'belgické vafle plněné čokoládou', NULL, 39, 0, 'wafle', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Belgická vafle plněná čokoládou, šlehačkou a toppingem', 'belgické vafle plněné čokoládou, šlehačkou a toppingem', NULL, 49, 0, 'wafle', '1ks ', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Dip 1', NULL, NULL, 10, 0, 'omacka', '33ml', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Dip 2', NULL, NULL, 10, 0, 'omacka', '33ml', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Dip 3', NULL, NULL, 10, 0, 'omacka', '33ml', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Dip 4', NULL, NULL, 10, 0, 'omacka', '33ml', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Dip 5', NULL, NULL, 10, 0, 'omacka', '33ml', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Dip 6', NULL, NULL, 10, 0, 'omacka', '33ml', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Dip 7', NULL, NULL, 10, 0, 'omacka', '33ml', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Dip 8', NULL, NULL, 10, 0, 'omacka', '33ml', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Dip 9', NULL, NULL, 10, 0, 'omacka', '33ml', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Dip 10', NULL, NULL, 10, 0, 'omacka', '33ml', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Salát 1', NULL, NULL, 49, 0, 'salat', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Salát 2', NULL, NULL, 49, 0, 'salat', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Salát 3', NULL, NULL, 49, 0, 'salat', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Salát 4', NULL, NULL, 49, 0, 'salat', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Salát 5', NULL, NULL, 49, 0, 'salat', '1ks', NULL);
INSERT INTO `Bel3s`.`menuItem` (`id`, `nazev`, `popis`, `ingredience`, `cena`, `id_sezona`, `kategorie`, `gramaz`, `prilohy`) VALUES (DEFAULT, 'Salát 6', NULL, NULL, 49, 0, 'salat', '1ks', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Bel3s`.`kategorie`
-- -----------------------------------------------------
START TRANSACTION;
USE `Bel3s`;
INSERT INTO `Bel3s`.`kategorie` (`id`, `nazev`, `foto`, `alt`, `topmenu`, `url`, `position`) VALUES (DEFAULT, 'Hranolky', 'pict/hranolky.png', NULL, 1, 'hranolky', NULL);
INSERT INTO `Bel3s`.`kategorie` (`id`, `nazev`, `foto`, `alt`, `topmenu`, `url`, `position`) VALUES (DEFAULT, 'Kuře', 'pict/kure.png', NULL, 1, 'kure', NULL);
INSERT INTO `Bel3s`.`kategorie` (`id`, `nazev`, `foto`, `alt`, `topmenu`, `url`, `position`) VALUES (DEFAULT, 'Bagety', 'pict/bagety.png', NULL, 1, 'bagety', NULL);
INSERT INTO `Bel3s`.`kategorie` (`id`, `nazev`, `foto`, `alt`, `topmenu`, `url`, `position`) VALUES (DEFAULT, 'Snídaně', 'pict/snidane.png', NULL, 1, 'snidane', NULL);
INSERT INTO `Bel3s`.`kategorie` (`id`, `nazev`, `foto`, `alt`, `topmenu`, `url`, `position`) VALUES (DEFAULT, 'Nápoje', 'pict/napoje.png', NULL, 1, 'napoje', NULL);
INSERT INTO `Bel3s`.`kategorie` (`id`, `nazev`, `foto`, `alt`, `topmenu`, `url`, `position`) VALUES (DEFAULT, 'Omáčky', 'pict/omacky.png', NULL, 1, 'omacky', NULL);
INSERT INTO `Bel3s`.`kategorie` (`id`, `nazev`, `foto`, `alt`, `topmenu`, `url`, `position`) VALUES (DEFAULT, 'Saláty', DEFAULT, NULL, 0, 'salaty', NULL);
INSERT INTO `Bel3s`.`kategorie` (`id`, `nazev`, `foto`, `alt`, `topmenu`, `url`, `position`) VALUES (DEFAULT, 'Stripsy', DEFAULT, NULL, 0, 'stripsy', NULL);
INSERT INTO `Bel3s`.`kategorie` (`id`, `nazev`, `foto`, `alt`, `topmenu`, `url`, `position`) VALUES (DEFAULT, 'Masové koule', DEFAULT, NULL, 0, 'masovekoule', NULL);
INSERT INTO `Bel3s`.`kategorie` (`id`, `nazev`, `foto`, `alt`, `topmenu`, `url`, `position`) VALUES (DEFAULT, 'Wafle', DEFAULT, NULL, 0, 'wafle', NULL);
INSERT INTO `Bel3s`.`kategorie` (`id`, `nazev`, `foto`, `alt`, `topmenu`, `url`, `position`) VALUES (DEFAULT, 'Tortilla', DEFAULT, NULL, 0, 'tortilla', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Bel3s`.`fotka`
-- -----------------------------------------------------
START TRANSACTION;
USE `Bel3s`;
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (1, DEFAULT, DEFAULT, 1);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (2, DEFAULT, DEFAULT, 2);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (3, DEFAULT, DEFAULT, 3);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (4, DEFAULT, DEFAULT, 4);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (5, DEFAULT, DEFAULT, 5);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (6, DEFAULT, DEFAULT, 6);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (7, DEFAULT, DEFAULT, 7);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (8, DEFAULT, DEFAULT, 8);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (9, DEFAULT, DEFAULT, 9);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (10, DEFAULT, DEFAULT, 10);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (11, DEFAULT, DEFAULT, 11);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (12, DEFAULT, DEFAULT, 12);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (13, DEFAULT, DEFAULT, 13);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (14, DEFAULT, DEFAULT, 14);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (15, DEFAULT, DEFAULT, 15);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (16, DEFAULT, DEFAULT, 16);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (17, DEFAULT, DEFAULT, 17);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (18, DEFAULT, DEFAULT, 18);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (19, DEFAULT, DEFAULT, 19);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (20, DEFAULT, DEFAULT, 20);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (21, DEFAULT, DEFAULT, 21);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (22, DEFAULT, DEFAULT, 22);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (23, DEFAULT, DEFAULT, 23);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (24, DEFAULT, DEFAULT, 24);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (25, DEFAULT, DEFAULT, 25);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (26, DEFAULT, DEFAULT, 26);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (27, DEFAULT, DEFAULT, 27);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (28, DEFAULT, DEFAULT, 28);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (29, DEFAULT, DEFAULT, 29);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (30, DEFAULT, DEFAULT, 30);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (31, DEFAULT, DEFAULT, 31);
INSERT INTO `Bel3s`.`fotka` (`id`, `nazev`, `path`, `jidlo_id`) VALUES (32, DEFAULT, DEFAULT, 32);

COMMIT;

