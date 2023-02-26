/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50733
Source Host           : localhost:3306
Source Database       : marco-latest

Target Server Type    : MYSQL
Target Server Version : 50733
File Encoding         : 65001

Date: 2022-09-11 15:10:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `store_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `total_amount` float NOT NULL,
  `order` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `total_discount` float DEFAULT NULL,
  `order_discount` float DEFAULT NULL COMMENT 'total_discount + order_discount',
  `service_charge` float DEFAULT NULL,
  `paid_amount` float NOT NULL,
  `due_amount` float NOT NULL,
  `file_path` text NOT NULL,
  `coupon` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quotation_id` varchar(255) DEFAULT NULL,
  `order_no` varchar(255) DEFAULT NULL,
  `total_vat` float DEFAULT NULL,
  `shipping_charge` tinyint(4) DEFAULT NULL,
  `shipping_method` varchar(255) DEFAULT NULL,
  `is_quotation` tinyint(1) NOT NULL DEFAULT '0',
  `is_installment` tinyint(1) NOT NULL DEFAULT '0',
  `month_no` int(11) DEFAULT NULL,
  `due_day` int(11) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `percentage_discount` int(11) DEFAULT '0',
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
