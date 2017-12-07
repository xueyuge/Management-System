/*
DATABASE INFO RECORD

Source Server         : Alan's-MBP
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : demo

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-12-01 01:49:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(100) NOT NULL,
  `street_num` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip_code` int(11) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('1', 'Forsyth St', '15', 'Boston', 'MA', '02115');
INSERT INTO `address` VALUES ('2', 'Tremont st', '1155', 'Roxbury Crossing', 'MA', '02120');
INSERT INTO `address` VALUES ('3', 'Huntington Ave', '360', 'Boston', 'MA', '02115');
-- ----------------------------
-- Table structure for creditcards
-- ----------------------------
DROP TABLE IF EXISTS `creditcards`;
CREATE TABLE `creditcards` (
  `credit_card_id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_num` int(16) NOT NULL,
  `bank_name` varchar(30) NOT NULL,
  `billing_address_id` int(11) NOT NULL,
  `credit_card_user_id` int(11) NOT NULL,
  PRIMARY KEY (`credit_card_id`),
  KEY `par_ind` (`billing_address_id`),
  KEY `par_ind_2` (`credit_card_user_id`),
  CONSTRAINT `fk_billing` FOREIGN KEY (`billing_address_id`) REFERENCES `address` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cc` FOREIGN KEY (`credit_card_user_id`) REFERENCES `customers` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of creditcards
-- ----------------------------
INSERT INTO `creditcards` VALUES ('1', '2147483647', 'BofA', '1', '1');
INSERT INTO `creditcards` VALUES ('2', '1234556000', 'CHASE', '2', '2');

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) NOT NULL,
  `registration_date` varchar(255) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `favorite_plant` int(11) DEFAULT NULL,
  `shipping_address` int(11) NOT NULL,
  PRIMARY KEY (`client_id`),
  KEY `par_ind_1` (`favorite_plant`),
  KEY `par_int_2` (`shipping_address`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', 'Alan', '2017-11-30 15:33:17', 'M', '1', '1');
INSERT INTO `customers` VALUES ('2', 'John', '2017-11-30 15:34:27', 'M', '2', '2');
INSERT INTO `customers` VALUES ('3', 'Tracy', '2017-11-30 15:36:10', 'F', '3', '3');

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `ssn` int(11) NOT NULL,
  `wage` int(11) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES ('1', 'Maria', 'Manager', '1001', '50');
INSERT INTO `employees` VALUES ('2', 'Alan', 'Tresurer', '1002', '35');
INSERT INTO `employees` VALUES ('3', 'Owen', 'Janitor', '1003', '80');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `product_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `approved_status` tinyint(1) NOT NULL,
  `person_in_charge` int(11) DEFAULT NULL,
  `shipment_id` int(11) DEFAULT NULL,
  KEY `par_ind` (`product_id`),
  KEY `par_ind_2` (`client_id`),
  KEY `par_ind_3` (`person_in_charge`),
  KEY `par_ind_4` (`shipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('3', '3', '2017-11-30 18:19:00', '1', '2', '3');
INSERT INTO `orders` VALUES ('3', '3', '2017-11-30 18:28:55', '1', '1', '3');
INSERT INTO `orders` VALUES ('3', '3', '2017-11-30 18:46:41', '1', '2', '2');
INSERT INTO `orders` VALUES ('3', '3', '2017-11-30 18:48:19', '0', '1', '2');

-- ----------------------------
-- Table structure for plants
-- ----------------------------
DROP TABLE IF EXISTS `plants`;
CREATE TABLE `plants` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `plants_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `min_ph` int(11) DEFAULT NULL,
  `max_ph` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of plants
-- ----------------------------
INSERT INTO `plants` VALUES ('1', 'Peppermint', '5', 'Herbs', 'Green', '0', '5', '7', '20');
INSERT INTO `plants` VALUES ('2', 'Rose', '15', 'Flower', 'red', '0', '6', '7', '1');
INSERT INTO `plants` VALUES ('3', 'Tulips', '13', 'Flower', 'yellow', '0', '6', '7', '10');

-- ----------------------------
-- Table structure for shipments
-- ----------------------------
DROP TABLE IF EXISTS `shipments`;
CREATE TABLE `shipments` (
  `shipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(100) DEFAULT NULL,
  `tracking` int(11) DEFAULT NULL,
  `shipping_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`shipment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shipments
-- ----------------------------
INSERT INTO `shipments` VALUES ('1', '10 Forsyth St', '2', '0');
INSERT INTO `shipments` VALUES ('2', '1155 Tremont St', '3', '0');
INSERT INTO `shipments` VALUES ('3', '360 Huntington Ave', '0', '0');
INSERT INTO `shipments` VALUES ('4', '150 Brookline Ave', '34', '0');
