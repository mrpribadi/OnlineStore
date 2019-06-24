/*
Navicat MySQL Data Transfer

Source Server         : MySQL_Local
Source Server Version : 50560
Source Host           : localhost:3306
Source Database       : online_store

Target Server Type    : MYSQL
Target Server Version : 50560
File Encoding         : 65001

Date: 2019-06-22 14:04:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_status` varchar(10) DEFAULT 'active',
  `customer_password` varchar(50) DEFAULT NULL,
  `customer_nama` varchar(50) DEFAULT NULL,
  `customer_gender` varchar(6) DEFAULT NULL,
  `customer_phone` varchar(30) DEFAULT NULL,
  `customer_ip_address` varchar(20) DEFAULT NULL,
  `customer_registration_date` datetime DEFAULT NULL,
  PRIMARY KEY (`customer_id`,`customer_code`,`customer_email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
