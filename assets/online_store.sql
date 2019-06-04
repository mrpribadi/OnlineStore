/*
Navicat MySQL Data Transfer

Source Server         : MySQL_Local
Source Server Version : 50560
Source Host           : localhost:3306
Source Database       : online_store

Target Server Type    : MYSQL
Target Server Version : 50560
File Encoding         : 65001

Date: 2019-06-04 11:07:36
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('1', 'CUST00001', 'amanda@gmail.com', 'active', '202cb962ac59075b964b07152d234b70', 'Amanda Putri', 'pria', '08123334455', '::1', '2019-05-28 15:00:09');
INSERT INTO `customer` VALUES ('2', 'CUST00002', 'dewi@gmail.com', 'active', '202cb962ac59075b964b07152d234b70', 'Dewi Puspita', 'wanita', '123456789', '::1', '2019-05-28 15:01:03');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_header
-- ----------------------------

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `payment_id` int(3) NOT NULL AUTO_INCREMENT,
  `payment_status` varchar(10) DEFAULT 'active',
  `payment_type_id` int(2) DEFAULT NULL,
  `payment_bank_name` varchar(50) DEFAULT NULL,
  `payment_bank_account_no` varchar(50) DEFAULT NULL,
  `payment_bank_account_name` varchar(50) DEFAULT NULL,
  `create_by` int(3) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` int(3) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payment
-- ----------------------------
INSERT INTO `payment` VALUES ('1', 'active', '1', 'BCA', '3245678900', 'ANGGUN PRIBADI', '1', '2019-05-26 14:57:33', null, null);
INSERT INTO `payment` VALUES ('2', 'active', '1', 'MUAMALAT', '3425364646', 'ANGGUN PRIBADI', '1', '2019-05-26 14:58:04', '1', '2019-05-26 15:14:31');
INSERT INTO `payment` VALUES ('3', 'active', '1', 'BNI', '2484293486', 'ANGGUN PRIBADI', '1', '2019-05-26 15:14:57', null, null);

-- ----------------------------
-- Table structure for payment_type
-- ----------------------------
DROP TABLE IF EXISTS `payment_type`;
CREATE TABLE `payment_type` (
  `payment_type_id` int(2) NOT NULL AUTO_INCREMENT,
  `payment_type_status` varchar(10) DEFAULT 'active',
  `payment_type_nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`payment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payment_type
-- ----------------------------
INSERT INTO `payment_type` VALUES ('1', 'active', 'Bank Transfer');
INSERT INTO `payment_type` VALUES ('2', 'inactive', 'Online Payment');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_category_id` int(3) DEFAULT NULL,
  `product_status` varchar(10) DEFAULT 'active',
  `product_reff_code` varchar(50) NOT NULL,
  `product_name` varchar(128) DEFAULT NULL,
  `product_url` varchar(255) NOT NULL,
  `product_harga` float DEFAULT NULL,
  `product_deskripsi` text,
  `product_image` varchar(100) DEFAULT NULL,
  `product_utama` int(1) DEFAULT '0',
  `product_utama_date` datetime DEFAULT NULL,
  `product_promo_list` int(1) DEFAULT '0',
  `product_promo_list_date` datetime DEFAULT NULL,
  `product_new_in` int(1) DEFAULT '0',
  `product_new_in_date` datetime DEFAULT NULL,
  `product_most_popular` int(1) DEFAULT '0',
  `product_most_popular_date` datetime DEFAULT NULL,
  `create_by` int(3) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` int(3) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`product_id`,`product_reff_code`,`product_url`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', '1', 'active', 'PROD0001', 'Facial', 'facial', '300000', 'Membersihkan wajah', 'PROD0001_Gambar5.png', '0', null, '0', null, '0', null, '1', '2019-05-31 10:21:53', '1', '2019-05-27 11:37:41', '1', '2019-05-27 16:50:43');
INSERT INTO `product` VALUES ('3', '1', 'active', 'PROD0002', 'Penghilang Bulu', 'penghilang-bulu', '350000', 'Menghilangkan bulu ketek dan kemaluan', 'PROD0002_Gambar2.png', '0', null, '0', null, '0', null, '1', '2019-05-31 10:21:58', '1', '2019-05-27 14:35:50', null, null);
INSERT INTO `product` VALUES ('4', '1', 'active', 'PROD0003', 'Active Acne Laser', 'active-acne-laser', '1000000', 'Jerawat laser', 'PROD0003_Biopori.png', '0', null, '0', null, '1', '2019-05-31 10:33:25', '1', '2019-05-31 10:22:06', '1', '2019-05-29 11:20:16', null, null);
INSERT INTO `product` VALUES ('5', '1', 'active', 'PROD0004', 'Lifting', 'lifting', '400000', 'Ga tau apaan ini', 'PROD0004_Gedung.png', '0', null, '0', null, '0', null, '1', '2019-05-31 10:22:10', '1', '2019-05-29 11:23:21', null, null);
INSERT INTO `product` VALUES ('6', '1', 'active', 'PROD0005', 'Infus Glowing', 'infus-glowing', '800000', 'Memutihkan Kulit', 'PROD0005_Singer.png', '0', null, '1', '2019-05-31 10:23:18', '1', '2019-05-31 10:33:28', '0', null, '1', '2019-05-29 11:30:14', null, null);
INSERT INTO `product` VALUES ('7', '1', 'active', 'PROD0006', 'Tatto Removal', 'tatto-removal', '750000', 'Menghilangkan tatto', 'PROD0006_Optoma.png', '0', null, '1', '2019-05-31 10:23:23', '0', null, '0', null, '1', '2019-05-29 13:42:52', null, null);

-- ----------------------------
-- Table structure for product_category
-- ----------------------------
DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `product_category_id` int(7) NOT NULL AUTO_INCREMENT,
  `product_category_parent` int(3) DEFAULT NULL,
  `product_category_status` varchar(8) DEFAULT 'active',
  `product_category_name` varchar(50) DEFAULT NULL,
  `product_category_url` varchar(255) DEFAULT NULL,
  `create_by` int(3) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` int(3) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`product_category_id`),
  UNIQUE KEY `product_category_nama` (`product_category_name`) USING BTREE,
  UNIQUE KEY `product_category_url` (`product_category_url`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_category
-- ----------------------------
INSERT INTO `product_category` VALUES ('1', '0', 'active', 'Treatment', 'treatment', '1', '2019-05-26 15:16:32', null, null);
INSERT INTO `product_category` VALUES ('3', '0', 'active', 'About', 'about', '1', '2019-05-29 14:13:55', null, null);
INSERT INTO `product_category` VALUES ('4', '0', 'active', 'Outlet', 'outlet', '1', '2019-05-29 14:24:21', null, null);

-- ----------------------------
-- Table structure for user_admin
-- ----------------------------
DROP TABLE IF EXISTS `user_admin`;
CREATE TABLE `user_admin` (
  `admin_id` int(3) NOT NULL AUTO_INCREMENT,
  `admin_level` varchar(20) DEFAULT NULL,
  `admin_status` varchar(8) DEFAULT 'active',
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(32) DEFAULT NULL,
  `admin_full_name` varchar(50) DEFAULT NULL,
  `create_by` int(3) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` int(3) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`admin_id`,`admin_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_admin
-- ----------------------------
INSERT INTO `user_admin` VALUES ('1', 'admin_super', 'active', 'didi@gmail.com', '202cb962ac59075b964b07152d234b70', 'Anggun Pribadi', '1', '2019-05-22 09:51:11', null, null);
