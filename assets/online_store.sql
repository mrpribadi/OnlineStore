/*
Navicat MySQL Data Transfer

Source Server         : MySQL_Local
Source Server Version : 50560
Source Host           : localhost:3306
Source Database       : online_store

Target Server Type    : MYSQL
Target Server Version : 50560
File Encoding         : 65001

Date: 2019-06-22 14:20:32
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('1', 'CUST00001', 'aaa@aaa.com', 'active', 'e99a18c428cb38d5f260853678922e03', 'Anggun Pribadi', 'pria', '5693529406', '::1', '2019-06-21 09:56:28');
INSERT INTO `customer` VALUES ('2', 'CUST00002', 'aaa@aaa.comd', 'active', 'e99a18c428cb38d5f260853678922e03', 'Ari ferdian', 'pria', '1213132', '::1', '2019-06-21 21:54:16');
INSERT INTO `customer` VALUES ('3', 'CUST00003', 'dd@zsf.dfd', 'active', 'e99a18c428cb38d5f260853678922e03', 'Dedi', 'pria', '213213213', '::1', '2019-06-21 21:58:06');
INSERT INTO `customer` VALUES ('4', 'CUST00004', 'hjadhksa@asdklas.ck', 'active', 'e99a18c428cb38d5f260853678922e03', 'Amanda', 'wanita', '9798769', '::1', '2019-06-22 01:00:56');
INSERT INTO `customer` VALUES ('5', 'CUST00005', 'sindi@dsd.cac', 'active', 'e99a18c428cb38d5f260853678922e03', 'Sindi', 'wanita', '54545435', '::1', '2019-06-22 01:07:52');
INSERT INTO `customer` VALUES ('6', 'CUST00006', 'putri@gmail.com', 'active', 'e99a18c428cb38d5f260853678922e03', 'Putri', 'wanita', '321321412414', '::1', '2019-06-22 01:13:09');
INSERT INTO `customer` VALUES ('7', 'CUST00007', 'hhh@ggg.com', 'active', 'e99a18c428cb38d5f260853678922e03', 'ABC', 'wanita', '23456778', '::1', '2019-06-22 14:09:06');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_header
-- ----------------------------
INSERT INTO `order_header` VALUES ('1', 'BOOK00001', '2019-06-21 09:56:29', '1', '350000', '1', '1', '3', null, null, null, null, null, null, null, null, '0', null, null, '0', null, null, null, '2019-06-22', '10', '1');
INSERT INTO `order_header` VALUES ('2', 'BOOK00002', '2019-06-21 21:54:16', '0', '750000', '2', '1', '7', null, null, null, null, null, null, null, null, '0', null, null, '0', null, null, null, '2019-06-24', '11', '1');
INSERT INTO `order_header` VALUES ('3', 'BOOK00003', '2019-06-21 21:58:06', '0', '400000', '3', '1', '5', null, null, null, null, null, null, null, null, '0', null, null, '0', null, null, null, '2019-06-22', '10', '2');
INSERT INTO `order_header` VALUES ('4', 'BOOK00004', '2019-06-22 01:00:56', '0', '1000000', '4', '1', '4', null, null, null, null, null, null, null, null, '0', null, null, '0', null, null, null, '2019-06-26', '13', '1');
INSERT INTO `order_header` VALUES ('5', 'BOOK00005', '2019-06-22 01:07:52', '0', '1000000', '5', '1', '4', null, null, null, null, null, null, null, null, '0', null, null, '0', null, null, null, '2019-06-26', '12', '1');
INSERT INTO `order_header` VALUES ('6', 'BOOK00006', '2019-06-22 01:13:09', '0', '400000', '6', '1', '5', null, null, null, null, null, null, null, null, '0', null, null, '0', null, null, null, '2019-06-25', '15', '1');
INSERT INTO `order_header` VALUES ('7', 'BOOK00007', '2019-06-22 14:09:06', '0', '1000000', '7', '1', '4', null, null, null, null, null, null, null, null, '0', null, null, '0', null, null, null, '2019-06-26', '13', '2');

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
INSERT INTO `product` VALUES ('1', '1', 'active', 'PROD0001', 'Facial', 'facial', '300000', 'Membersihkan wajah', 'PROD0001_626152427-H.jpg', '0', null, '0', null, '0', null, '1', '2019-05-31 10:21:53', '1', '2019-06-21 13:41:19', '1', '2019-06-21 08:36:46');
INSERT INTO `product` VALUES ('3', '1', 'active', 'PROD0002', 'Waxing', 'waxing', '350000', 'Menghilangkan rambut', 'PROD0002_waxing.jpg', '0', null, '0', null, '0', null, '1', '2019-05-31 10:21:58', '1', '2019-06-21 13:50:46', '1', '2019-06-21 13:51:30');
INSERT INTO `product` VALUES ('4', '1', 'active', 'PROD0003', 'Active Acne Laser', 'active-acne-laser', '1000000', 'Jerawat laser', 'PROD0003_images-5.jpeg', '0', null, '0', null, '1', '2019-05-31 10:33:25', '1', '2019-05-31 10:22:06', '1', '2019-06-21 13:41:44', null, null);
INSERT INTO `product` VALUES ('5', '1', 'active', 'PROD0004', 'Lifting', 'lifting', '400000', 'Mengencangkan kulit wajah', 'PROD0004_images.jpg', '0', null, '0', null, '0', null, '1', '2019-05-31 10:22:10', '1', '2019-06-21 13:44:05', '1', '2019-06-21 13:53:04');
INSERT INTO `product` VALUES ('6', '1', 'active', 'PROD0005', 'Infus Glowing', 'infus-glowing', '800000', 'Memutihkan Kulit', 'PROD0005_xsxs.jpg', '0', null, '1', '2019-05-31 10:23:18', '1', '2019-05-31 10:33:28', '0', null, '1', '2019-06-21 13:48:55', '1', '2019-06-21 13:53:13');
INSERT INTO `product` VALUES ('7', '1', 'active', 'PROD0006', 'Tatto Removal', 'tatto-removal', '750000', 'Menghilangkan tatto', 'PROD0006_download.jpg', '0', null, '1', '2019-05-31 10:23:23', '0', null, '0', null, '1', '2019-06-21 13:47:51', '1', '2019-06-21 13:53:22');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_category
-- ----------------------------
INSERT INTO `product_category` VALUES ('1', '0', 'active', 'Treatment', 'treatment', '1', '2019-05-26 15:16:32', null, null);
INSERT INTO `product_category` VALUES ('3', '0', 'active', 'About', 'about', '1', '2019-05-29 14:13:55', null, null);
INSERT INTO `product_category` VALUES ('4', '0', 'active', 'Outlet', 'outlet', '1', '2019-05-29 14:24:21', null, null);
INSERT INTO `product_category` VALUES ('5', '0', 'deactive', 'Payment', 'payment', '1', '2019-06-21 14:44:28', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_admin
-- ----------------------------
INSERT INTO `user_admin` VALUES ('1', 'admin_super', 'active', 'didi@gmail.com', '202cb962ac59075b964b07152d234b70', 'Anggun Pribadi', '1', '2019-05-22 09:51:11', null, null);
