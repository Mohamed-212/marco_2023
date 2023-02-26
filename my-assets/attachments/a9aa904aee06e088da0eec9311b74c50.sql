/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50733
Source Host           : localhost:3306
Source Database       : marco-latest

Target Server Type    : MYSQL
Target Server Version : 50733
File Encoding         : 65001

Date: 2022-09-11 15:10:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `order_details`
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `order_details_id` varchar(100) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `variant_id` varchar(100) NOT NULL,
  `variant_color` varchar(30) DEFAULT NULL,
  `store_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` float NOT NULL,
  `supplier_rate` float DEFAULT NULL,
  `total_price` float NOT NULL,
  `discount` float DEFAULT NULL COMMENT 'discount_total_per_product',
  `product_discount` float DEFAULT NULL,
  `status` int(11) NOT NULL,
  `pricing_id` int(11) DEFAULT NULL,
  `return_quantity` int(11) DEFAULT '0',
  `batch_no` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`order_details_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
