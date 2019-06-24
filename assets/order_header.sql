/*
Navicat MySQL Data Transfer

Source Server         : MySQL_Local
Source Server Version : 50560
Source Host           : localhost:3306
Source Database       : online_store

Target Server Type    : MYSQL
Target Server Version : 50560
File Encoding         : 65001

Date: 2019-06-22 14:05:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for order_header
-- ----------------------------
DROP TABLE IF EXISTS `order_header`;
CREATE TABLE `order_header` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(50) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_status` int(2) DEFAULT '1',
  `order_total` float DEFAULT NULL,
  `customer_id` int(5) DEFAULT NULL,
  `payment_type_id` int(3) DEFAULT NULL,
  `product_id` int(3) DEFAULT NULL,
  `confirmation_status` int(1) DEFAULT NULL,
  `confirmation_date` datetime DEFAULT NULL,
  `confirmation_notes` text,
  `confirmation_bank_from` varchar(50) DEFAULT NULL,
  `confirmation_bank_from_account_no` varchar(50) DEFAULT NULL,
  `confirmation_bank_from_account_name` varchar(50) DEFAULT NULL,
  `confirmation_bank_from_amount` float DEFAULT NULL,
  `confirmation_bank_from_image` varchar(50) DEFAULT NULL,
  `order_cancel` int(1) DEFAULT '0',
  `order_cancel_date` datetime DEFAULT NULL,
  `order_cancel_reason` varchar(128) DEFAULT NULL,
  `order_reject` int(1) DEFAULT '0',
  `order_reject_by` int(3) DEFAULT NULL,
  `order_reject_date` datetime DEFAULT NULL,
  `order_reject_reason` varchar(128) DEFAULT NULL,
  `order_working_date` date DEFAULT NULL,
  `order_working_time` int(5) DEFAULT NULL,
  `order_working_time_line` int(1) DEFAULT NULL,
  PRIMARY KEY (`order_id`,`order_no`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
