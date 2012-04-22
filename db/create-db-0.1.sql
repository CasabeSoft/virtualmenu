SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `virtualmenu` DEFAULT CHARACTER SET utf8 ;
USE `virtualmenu` ;

-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(100) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(32) NOT NULL ,
  `phone` VARCHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `customers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `customers` (
  `id` INT(11) NOT NULL ,
  `address` VARCHAR(255) NOT NULL ,
  `group` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `idu` (`id` ASC) ,
  INDEX `id_user` (`id` ASC) ,
  CONSTRAINT `customers_id_user`
    FOREIGN KEY (`id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `managers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `managers` (
  `id` INT(11) NOT NULL COMMENT 'Identificador del usuario' ,
  PRIMARY KEY (`id`) ,
  INDEX `id_user` (`id` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `providers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `providers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `email` VARCHAR(100) NULL DEFAULT NULL ,
  `address` VARCHAR(255) NULL DEFAULT NULL ,
  `phone` VARCHAR(20) NULL DEFAULT NULL ,
  `web` VARCHAR(100) NULL DEFAULT NULL ,
  `administrator` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `providers_administrator` (`administrator` ASC) ,
  CONSTRAINT `providers_administrator`
    FOREIGN KEY (`administrator` )
    REFERENCES `managers` (`id` )
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `customers_by_provider`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `customers_by_provider` (
  `id_customer` INT(11) NOT NULL ,
  `id_provider` INT(11) NOT NULL ,
  `since` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id_customer`, `id_provider`) ,
  INDEX `customers_by_provider_id_customer` (`id_customer` ASC) ,
  INDEX `customers_by_provider_id_provider` (`id_provider` ASC) ,
  CONSTRAINT `customers_by_provider_id_customer`
    FOREIGN KEY (`id_customer` )
    REFERENCES `customers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `customers_by_provider_id_provider`
    FOREIGN KEY (`id_provider` )
    REFERENCES `providers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `group_types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `group_types` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `groups` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `address` VARCHAR(45) NULL DEFAULT NULL ,
  `id_type` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `group_type` (`id_type` ASC) ,
  CONSTRAINT `group_id_type`
    FOREIGN KEY (`id_type` )
    REFERENCES `group_types` (`id` )
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `managers_by_provider`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `managers_by_provider` (
  `id_manager` INT(11) NOT NULL ,
  `id_provider` INT(11) NOT NULL ,
  PRIMARY KEY (`id_manager`, `id_provider`) ,
  INDEX `managers_by_provider_id_manager` (`id_manager` ASC) ,
  INDEX `managers_by_provider_id_provider` (`id_provider` ASC) ,
  CONSTRAINT `managers_by_provider_id_manager`
    FOREIGN KEY (`id_manager` )
    REFERENCES `managers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `managers_by_provider_id_provider`
    FOREIGN KEY (`id_provider` )
    REFERENCES `providers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `menu_types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `menu_types` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `menu_types_by_provider`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `menu_types_by_provider` (
  `id_type` INT(11) NOT NULL ,
  `id_provider` INT(11) NOT NULL ,
  PRIMARY KEY (`id_type`) ,
  INDEX `menu_types_by_provider_id_type` (`id_type` ASC) ,
  INDEX `menu_types_by_provider_id_provider` (`id_provider` ASC) ,
  CONSTRAINT `menu_types_by_provider_id_provider`
    FOREIGN KEY (`id_provider` )
    REFERENCES `providers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `menu_types_by_provider_id_type`
    FOREIGN KEY (`id_type` )
    REFERENCES `menu_types` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `menus`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `menus` (
  `id` INT(11) NOT NULL ,
  `id_type` INT(11) NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `start_date` DATE NULL DEFAULT NULL ,
  `end_date` DATE NULL DEFAULT NULL ,
  `base_price` DECIMAL(5,2) NOT NULL DEFAULT '0.00' ,
  `id_provider` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `menus_id_type` (`id_type` ASC) ,
  INDEX `menus_id_provider` (`id_provider` ASC) ,
  CONSTRAINT `menus_id_type`
    FOREIGN KEY (`id_type` )
    REFERENCES `menu_types` (`id` )
    ON UPDATE CASCADE,
  CONSTRAINT `menus_id_provider`
    FOREIGN KEY (`id_provider` )
    REFERENCES `providers` (`id` )
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `products`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `base_price` DECIMAL(5,2) NULL DEFAULT '0.00' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `section_types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `section_types` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `sections`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sections` (
  `id` INT(11) NOT NULL ,
  `name` VARCHAR(45) NULL DEFAULT NULL ,
  `order` SMALLINT(6) NULL DEFAULT NULL ,
  `id_section_type` INT(11) NOT NULL ,
  `id_menu_type` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `sections_id_section_type` (`id_section_type` ASC) ,
  INDEX `sections_is_menu_type` (`id_menu_type` ASC) ,
  CONSTRAINT `sections_id_section_type`
    FOREIGN KEY (`id_section_type` )
    REFERENCES `section_types` (`id` )
    ON UPDATE CASCADE,
  CONSTRAINT `sections_is_menu_type`
    FOREIGN KEY (`id_menu_type` )
    REFERENCES `menu_types` (`id` )
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `products_by_menu`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `products_by_menu` (
  `id_menu` INT(11) NOT NULL ,
  `id_product` INT(11) NOT NULL ,
  `order` SMALLINT(6) NULL DEFAULT NULL ,
  `price` DECIMAL(5,2) NULL DEFAULT '0.00' ,
  `id_section` INT(11) NOT NULL ,
  PRIMARY KEY (`id_menu`, `id_product`) ,
  INDEX `products_by_menu_id_menu` (`id_menu` ASC) ,
  INDEX `products_by_menu_id_product` (`id_product` ASC) ,
  INDEX `products_by_menu_id_section` (`id_section` ASC) ,
  CONSTRAINT `products_by_menu_id_menu`
    FOREIGN KEY (`id_menu` )
    REFERENCES `menus` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `products_by_menu_id_product`
    FOREIGN KEY (`id_product` )
    REFERENCES `products` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `products_by_menu_id_section`
    FOREIGN KEY (`id_section` )
    REFERENCES `sections` (`id` )
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
