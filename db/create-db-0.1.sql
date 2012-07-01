CREATE DATABASE  IF NOT EXISTS `virtualmenu` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `virtualmenu`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: virtualmenu
-- ------------------------------------------------------
-- Server version	5.5.20

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `group` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idu` (`id`),
  KEY `id_user` (`id`),
  CONSTRAINT `customers_id_user` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `managers`
--

DROP TABLE IF EXISTS `managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `managers` (
  `id` int(11) NOT NULL COMMENT 'Identificador del usuario',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password_code` varchar(50) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `products_by_menu`
--

DROP TABLE IF EXISTS `products_by_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_by_menu` (
  `id_menu` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `order` smallint(6) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT '0.00',
  `id_section` int(11) NOT NULL,
  PRIMARY KEY (`id_menu`,`id_product`),
  KEY `products_by_menu_id_menu` (`id_menu`),
  KEY `products_by_menu_id_product` (`id_product`),
  KEY `products_by_menu_id_section` (`id_section`),
  CONSTRAINT `products_by_menu_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_by_menu_id_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_by_menu_id_section` FOREIGN KEY (`id_section`) REFERENCES `sections` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `providers`
--

DROP TABLE IF EXISTS `providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  `name_uri` varchar(50) NOT NULL,
  `administrator` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `providers_administrator` (`administrator`),
  CONSTRAINT `providers_administrator` FOREIGN KEY (`administrator`) REFERENCES `managers` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `managers_by_provider`
--

DROP TABLE IF EXISTS `managers_by_provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `managers_by_provider` (
  `id_manager` int(11) NOT NULL,
  `id_provider` int(11) NOT NULL,
  PRIMARY KEY (`id_manager`,`id_provider`),
  KEY `managers_by_provider_id_manager` (`id_manager`),
  KEY `managers_by_provider_id_provider` (`id_provider`),
  CONSTRAINT `managers_by_provider_id_manager` FOREIGN KEY (`id_manager`) REFERENCES `managers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `managers_by_provider_id_provider` FOREIGN KEY (`id_provider`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_type` (`id_type`),
  CONSTRAINT `group_id_type` FOREIGN KEY (`id_type`) REFERENCES `group_types` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menu_types`
--

DROP TABLE IF EXISTS `menu_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_types` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comments` varchar(255) DEFAULT NULL,
  `ordered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delivered` timestamp NULL DEFAULT NULL,
  `id_menu` int(11) NOT NULL,
  `id_bill` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_id_menus_menus` (`id_menu`),
  KEY `orders_id_bill_bills` (`id_bill`),
  CONSTRAINT `orders_id_bill_bills` FOREIGN KEY (`id_bill`) REFERENCES `bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_id_menus_menus` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `section_types`
--

DROP TABLE IF EXISTS `section_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `section_types` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `products_by_order`
--

DROP TABLE IF EXISTS `products_by_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_by_order` (
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id_order`,`id_product`),
  KEY `order_id_by_products_by_order` (`id_order`),
  KEY `menu_and_product_id_by_products_by_order` (`id_product`),
  CONSTRAINT `product_id_by_products_by_order` FOREIGN KEY (`id_product`) REFERENCES `products_by_menu` (`id_product`) ON UPDATE CASCADE,
  CONSTRAINT `order_id_by_products_by_order` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menu_types_by_provider`
--

DROP TABLE IF EXISTS `menu_types_by_provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_types_by_provider` (
  `id_type` int(11) NOT NULL,
  `id_provider` int(11) NOT NULL,
  PRIMARY KEY (`id_type`),
  KEY `menu_types_by_provider_id_type` (`id_type`),
  KEY `menu_types_by_provider_id_provider` (`id_provider`),
  CONSTRAINT `menu_types_by_provider_id_provider` FOREIGN KEY (`id_provider`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_types_by_provider_id_type` FOREIGN KEY (`id_type`) REFERENCES `menu_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `group_types`
--

DROP TABLE IF EXISTS `group_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `customers_by_provider`
--

DROP TABLE IF EXISTS `customers_by_provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_by_provider` (
  `id_customer` int(11) NOT NULL,
  `id_provider` int(11) NOT NULL,
  `since` datetime DEFAULT NULL,
  PRIMARY KEY (`id_customer`,`id_provider`),
  KEY `customers_by_provider_id_customer` (`id_customer`),
  KEY `customers_by_provider_id_provider` (`id_provider`),
  CONSTRAINT `customers_by_provider_id_customer` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customers_by_provider_id_provider` FOREIGN KEY (`id_provider`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `base_price` decimal(5,2) NOT NULL DEFAULT '0.00',
  `id_provider` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_id_type` (`id_type`),
  KEY `menus_id_provider` (`id_provider`),
  CONSTRAINT `menus_id_provider` FOREIGN KEY (`id_provider`) REFERENCES `providers` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `menus_id_type` FOREIGN KEY (`id_type`) REFERENCES `menu_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `base_price` decimal(5,2) DEFAULT '0.00',
  `id_provider` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_id_provider` (`id_provider`),
  CONSTRAINT `products_id_provider` FOREIGN KEY (`id_provider`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `generated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid` timestamp NULL DEFAULT NULL,
  `amount` decimal(5,2) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `payment` tinyint(4) NOT NULL,
  `id_provider` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bills_id_user_users` (`id_user`),
  KEY `bills_id_provider_providers` (`id_provider`),
  CONSTRAINT `bills_id_provider_providers` FOREIGN KEY (`id_provider`) REFERENCES `providers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `bills_id_user_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `order` smallint(6) DEFAULT NULL,
  `id_section_type` int(11) NOT NULL,
  `id_menu_type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sections_id_section_type` (`id_section_type`),
  KEY `sections_is_menu_type` (`id_menu_type`),
  CONSTRAINT `sections_id_section_type` FOREIGN KEY (`id_section_type`) REFERENCES `section_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `sections_is_menu_type` FOREIGN KEY (`id_menu_type`) REFERENCES `menu_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-07-01 12:55:05