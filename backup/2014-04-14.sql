SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `questionmark` ;
CREATE SCHEMA IF NOT EXISTS `questionmark` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
SHOW WARNINGS;
USE `questionmark` ;

-- -----------------------------------------------------
-- Table `Question_Types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Question_Types` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `Question_Types` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `type` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Users` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `Users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `password` VARCHAR(255) NULL ,
  `email` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Enquetes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Enquetes` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `Enquetes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `creation_date` DATE NULL ,
  `end_date` DATE NULL ,
  `start_date` DATE NULL ,
  `Users_id` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Questions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Questions` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `Questions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `question` VARCHAR(255) NULL ,
  `Question_Types_id` INT NOT NULL ,
  `Enquetes_id` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Sessions` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `Sessions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `email` VARCHAR(255) NULL ,
  `date` DATE NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Answers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Answers` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `Answers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Questions_id` INT NOT NULL ,
  `Sessions_id` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Question_Attribute_Types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Question_Attribute_Types` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `Question_Attribute_Types` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `attribute_type` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Question_Attributes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Question_Attributes` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `Question_Attributes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `attribute` VARCHAR(255) NULL ,
  `Questions_id` INT NOT NULL ,
  `Question_Attribute_Types_id` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

SHOW WARNINGS;
USE `questionmark` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
