/*
Navicat MySQL Data Transfer

Source Server         : MySQL_Local
Source Server Version : 50560
Source Host           : localhost:3306
Source Database       : online_store

Target Server Type    : MYSQL
Target Server Version : 50560
File Encoding         : 65001

Date: 2019-06-22 14:06:24
*/

SET FOREIGN_KEY_CHECKS=0;

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
