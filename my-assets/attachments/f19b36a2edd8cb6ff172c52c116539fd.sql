-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2022 at 10:47 AM
-- Server version: 5.7.39-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `morocco_marco`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `content_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `language_id` varchar(255) NOT NULL,
  `headline` text NOT NULL,
  `icon` text NOT NULL,
  `details` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` varchar(220) NOT NULL,
  `account_table_name` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_card_payments`
--

CREATE TABLE `acc_card_payments` (
  `cardpayment_id` varchar(100) NOT NULL,
  `card_type` varchar(255) DEFAULT NULL,
  `card_no` varchar(100) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `VNo` varchar(50) DEFAULT NULL,
  `Vtype` varchar(50) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_coa`
--

CREATE TABLE `acc_coa` (
  `HeadCode` varchar(50) NOT NULL,
  `HeadName` varchar(100) NOT NULL,
  `PHeadName` varchar(50) NOT NULL,
  `PHeadCode` varchar(50) DEFAULT NULL,
  `HeadLevel` int(11) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsTransaction` tinyint(1) NOT NULL,
  `IsGL` tinyint(1) NOT NULL,
  `HeadType` char(1) NOT NULL,
  `IsBudget` tinyint(1) NOT NULL,
  `IsDepreciation` tinyint(1) NOT NULL,
  `customer_id` varchar(50) DEFAULT NULL,
  `supplier_id` varchar(50) DEFAULT NULL,
  `store_id` varchar(50) DEFAULT NULL,
  `bank_id` varchar(100) DEFAULT NULL,
  `service_id` varchar(50) DEFAULT NULL,
  `DepreciationRate` decimal(18,2) NOT NULL,
  `CreateBy` varchar(50) NOT NULL,
  `CreateDate` datetime NOT NULL,
  `UpdateBy` varchar(50) NOT NULL,
  `UpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acc_coa`
--

INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `PHeadCode`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `customer_id`, `supplier_id`, `store_id`, `bank_id`, `service_id`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES
('1', 'Assets', 'COA', '0', 0, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-17 09:50:20', '', '0000-00-00 00:00:00'),
('11', 'Current Assets', 'Assets', '1', 1, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-17 08:27:49', '', '0000-00-00 00:00:00'),
('111', 'Cash In Boxes', 'Current Assets', '11', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:30:14', '', '0000-00-00 00:00:00'),
('1110001', 'Cash in box New Store 1', 'Cash In Boxes', '111', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, 'UWCFONUU992LN2Q', NULL, NULL, '0.00', 'super admin', '2022-02-07 11:42:40', '', '0000-00-00 00:00:00'),
('1110002', 'Cash in box Ntest', 'Cash In Boxes', '111', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, 'ZAACM94HLFHE74R', NULL, NULL, '0.00', 'Super Admin', '2022-08-09 17:53:18', '', '0000-00-00 00:00:00'),
('1110003', 'Cash in box Oulfa', 'Cash In Boxes', '111', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, '6L9DWE4ZTWZBD7T', NULL, NULL, '0.00', 'test admin', '2022-09-05 12:08:56', '', '0000-00-00 00:00:00'),
('1110004', 'Cash in box Oulfa 01', 'Cash In Boxes', '111', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, 'B15V5VEWHP7QSWD', NULL, NULL, '0.00', 'test admin', '2022-09-05 12:11:21', '', '0000-00-00 00:00:00'),
('1111', 'Cash in box general administration', 'Cash In Boxes', '111', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 12:38:53', '', '0000-00-00 00:00:00'),
('1112', 'Cash in box Amanuh branch 1', 'Cash In Boxes', '111', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 12:39:12', '', '0000-00-00 00:00:00'),
('1113', 'Cash in box Narges branch 2', 'Cash In Boxes', '111', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 12:39:15', '', '0000-00-00 00:00:00'),
('1114', 'Cash in box Al-Sahafa branch', 'Cash In Boxes', '111', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 12:39:17', '', '0000-00-00 00:00:00'),
('1115', 'Cash in box Al-Sahafa branch 4', 'Cash In Boxes', '111', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 12:39:20', '', '0000-00-00 00:00:00'),
('1116', 'Cash in box gameleven store', 'Cash In Boxes', '111', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, 'UBEVXKARBN86OUQ', NULL, NULL, '0.00', 'super admin', '2021-12-01 08:49:45', '', '0000-00-00 00:00:00'),
('1117', 'Cash in box New Store 1', 'Cash In Boxes', '111', 4, 1, 1, 0, 'A', 0, 0, NULL, NULL, 'J7UR5HPUQ59H689', NULL, NULL, '0.00', 'super admin', '2021-12-01 08:50:27', '', '0000-00-00 00:00:00'),
('112', 'Cash in Banks', 'Current Assets', '11', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:30:19', '', '0000-00-00 00:00:00'),
('1120001', 'FG2ICBE9EZ - Cash à la livraison', 'Cash in Banks', '112', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, NULL, 'FG2ICBE9EZ', NULL, '0.00', 'test admin', '2022-09-05 11:52:24', '', '0000-00-00 00:00:00'),
('1121', 'Alrajhi Bank', 'Cash in Banks', '112', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 10:35:01', '', '0000-00-00 00:00:00'),
('1121001', 'Alrajhi Bank Account Number 1 ', 'Alrajhi Bank ', '1121', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-12-02 06:21:04', '', '0000-00-00 00:00:00'),
('1121002', 'Al Rajhi Bank points of sale ', 'Alrajhi Bank ', '1121', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-12-02 06:22:03', '', '0000-00-00 00:00:00'),
('1122', 'Bank Aljazira', 'Cash in Banks', '112', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 10:34:58', '', '0000-00-00 00:00:00'),
('1122001', 'Bank Aljazira Account Number 1 ', 'Bank Aljazira', '1122', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-12-02 06:23:07', '', '0000-00-00 00:00:00'),
('1123', 'SNB', 'Cash in Banks', '112', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 10:35:05', '', '0000-00-00 00:00:00'),
('1123001', 'SNB Account Number 1 ', 'SNB', '1123', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-12-02 06:24:06', '', '0000-00-00 00:00:00'),
('1124', 'Al Rajhi Bank points of sale', 'Cash in Banks', '112', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 10:35:07', '', '0000-00-00 00:00:00'),
('1126', '1 - Duch bangla bank', 'Cash in Banks', '112', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, NULL, '1', NULL, '0.00', 'super admin', '2021-11-22 10:19:55', '', '0000-00-00 00:00:00'),
('1128', 'QZMQ63W97B - New Bank', 'Cash in Banks', '112', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, NULL, 'QZMQ63W97B', NULL, '0.00', 'super admin', '2021-11-22 10:20:01', '', '0000-00-00 00:00:00'),
('113', 'Debit Accounts', 'Current Assets', '11', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:30:26', '', '0000-00-00 00:00:00'),
('1130', 'VX1WNENHS7 - City Bank', 'Cash in Banks', '112', 3, 1, 1, 0, 'A', 0, 0, NULL, NULL, NULL, 'VX1WNENHS7', NULL, '0.00', 'super admin', '2021-11-22 10:20:07', '', '0000-00-00 00:00:00'),
('1131', 'Customers', 'Debit Accounts', '113', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:27:45', '', '0000-00-00 00:00:00'),
('11310001', 'Mr.Customer - Q2F8JTKZLICO4LE', 'Customers', '1131', 4, 1, 1, 0, 'A', 0, 0, 'Q2F8JTKZLICO4LE', NULL, NULL, NULL, NULL, '0.00', 'Super Admin', '2022-06-08 13:43:36', '', '0000-00-00 00:00:00'),
('11310002', 'محمد عمر  - H19R56HXWF2XIQ5', 'Customers', '1131', 4, 1, 1, 0, 'A', 0, 0, 'H19R56HXWF2XIQ5', NULL, NULL, NULL, NULL, '0.00', 'Super Admin', '2022-08-01 20:20:18', '', '0000-00-00 00:00:00'),
('11310003', 'Ntest - DBYXUKJSWP8N48M', 'Customers', '1131', 4, 1, 1, 0, 'A', 0, 0, 'DBYXUKJSWP8N48M', NULL, NULL, NULL, NULL, '0.00', 'Super Admin', '2022-08-09 17:47:36', '', '0000-00-00 00:00:00'),
('11310004', 'Salah - GJ4GCFMBY9N5EYM', 'Customers', '1131', 4, 1, 1, 0, 'A', 0, 0, 'GJ4GCFMBY9N5EYM', NULL, NULL, NULL, NULL, '0.00', 'test admin', '2022-09-05 12:10:33', '', '0000-00-00 00:00:00'),
('1132', 'Prepaid Expenses', 'Debit Accounts', '113', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:27:48', '', '0000-00-00 00:00:00'),
('11321', 'Prepaid Rents', 'Prepaid Expenses', '1132', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:09', '', '0000-00-00 00:00:00'),
('11322', 'Prepaid Key-money for Exhibition', 'Prepaid Expenses', '1132', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:12', '', '0000-00-00 00:00:00'),
('11323', 'Prepaid Renewal of residence and work permit', 'Prepaid Expenses', '1132', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:15', '', '0000-00-00 00:00:00'),
('11324', 'Prepaid Government fees and expenses', 'Prepaid Expenses', '1132', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:17', '', '0000-00-00 00:00:00'),
('1133', 'Related parties', 'Debit Accounts', '113', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:27:52', '', '0000-00-00 00:00:00'),
('11331', 'Mohammed Ahmed Al-Maadi', 'Related parties', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:20', '', '0000-00-00 00:00:00'),
('11332', 'Saad Abdullah Al-Qahtani', 'Related parties', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:24', '', '0000-00-00 00:00:00'),
('11333', 'Mohammed Saeed Alfar', 'Related parties', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:27', '', '0000-00-00 00:00:00'),
('11334', 'Saeed Ali Al-Qahtani', 'Related parties', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:30', '', '0000-00-00 00:00:00'),
('11335', 'General Manager Saleh Al-Qahtani', 'Related parties', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:34', '', '0000-00-00 00:00:00'),
('11336', 'Al-Dirah House Saleh Al-Qahtani', 'Related parties', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:43', '', '0000-00-00 00:00:00'),
('11337', 'Al Jar Allah', 'Related parties', '1133', 4, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:47', '', '0000-00-00 00:00:00'),
('114', 'Inventory accounts', 'Current Assets', '11', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:30:29', '', '0000-00-00 00:00:00'),
('1141', 'Inventory', 'Inventory accounts', '114', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:28:56', '', '0000-00-00 00:00:00'),
('115', 'employees advances and deposits', 'Current Assets', '11', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:32:07', '', '0000-00-00 00:00:00'),
('1151', 'employee advances', 'employees advances and deposits', '115', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:43', '', '0000-00-00 00:00:00'),
('1152', 'employee custody', 'employees advances and deposits', '115', 3, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:46', '', '0000-00-00 00:00:00'),
('116', 'VAT on inputs', 'Current Assets', '11', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:48', '', '0000-00-00 00:00:00'),
('12', 'Non-current assets', 'Assets', '1', 1, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:32:23', '', '0000-00-00 00:00:00'),
('121', 'investments ', 'Non-current assets', '12', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:29:53', '', '0000-00-00 00:00:00'),
('13', 'Fixed assets', 'Assets', '1', 1, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:33:05', '', '0000-00-00 00:00:00'),
('131', 'The historical value of the buildings', 'Fixed assets', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:25', '', '0000-00-00 00:00:00'),
('132', 'Historical value of cars', 'Fixed assets', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:28', '', '0000-00-00 00:00:00'),
('133', 'Historical value of equipment and machinery', 'Fixed assets', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:30', '', '0000-00-00 00:00:00'),
('134', 'Historical value of electronic devices and computers', 'Fixed assets', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:34', '', '0000-00-00 00:00:00'),
('135', 'Historical value of electrical appliances', 'Fixed assets', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:38', '', '0000-00-00 00:00:00'),
('136', 'Historical value of furniture and furnishings', 'Fixed assets', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:41', '', '0000-00-00 00:00:00'),
('137', 'Historical value of improvements and decoration', 'Fixed assets', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:44', '', '0000-00-00 00:00:00'),
('138', 'Historical value of accounting software', 'Fixed assets', '13', 2, 1, 1, 1, 'A', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 09:30:49', '', '0000-00-00 00:00:00'),
('2', 'Liabilities', 'COA', '0', 0, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-17 09:50:55', '', '0000-00-00 00:00:00'),
('21', 'Current Liabilities', 'Liabilities', '2', 1, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2022-01-24 07:09:38', '', '0000-00-00 00:00:00'),
('211', 'Accounts payable', 'Current Liabilities', '21', 2, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-17 09:47:06', '', '0000-00-00 00:00:00'),
('2111', 'Suppliers', 'Accounts payable', '211', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-17 09:47:03', '', '0000-00-00 00:00:00'),
('21110001', 'Supplier_2', 'Suppliers', '2111', 4, 1, 1, 0, 'L', 0, 0, NULL, 'NW6TORW5C9WWHAM4AB9P', NULL, NULL, NULL, '0.00', 'Super Admin', '2022-06-29 05:43:38', '', '0000-00-00 00:00:00'),
('21110002', 'Ntest', 'Suppliers', '2111', 4, 1, 1, 0, 'L', 0, 0, NULL, '2KC5UJS472BA6JKYMCZG', NULL, NULL, NULL, '0.00', 'Super Admin', '2022-08-09 17:43:01', '', '0000-00-00 00:00:00'),
('21110004', 'Salah', 'Suppliers', '2111', 4, 1, 1, 0, 'L', 0, 0, NULL, 'JULIS4O2ZYISG49EHHH3', NULL, NULL, NULL, '0.00', 'shady test', '2022-10-13 13:34:04', '', '0000-00-00 00:00:00'),
('21111', 'SWITCH', 'Suppliers', '2111', 4, 1, 1, 0, 'L', 0, 0, NULL, '2NGBRB5X82Y6STCAKLWY', NULL, NULL, NULL, '0.00', 'super admin', '2021-11-02 07:37:24', '', '0000-00-00 00:00:00'),
('21112', 'Supplier_1', 'Suppliers', '2111', 4, 1, 1, 0, 'L', 0, 0, NULL, 'I3JRQQJSJ67GG2ZTEEU1', NULL, NULL, NULL, '0.00', '1', '2022-05-29 12:30:21', '', '0000-00-00 00:00:00'),
('2112', 'Accrued Expenses', 'Accounts payable', '211', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:08:51', '', '0000-00-00 00:00:00'),
('21121', 'Accured Wages', 'Accrued Expenses', '2112', 4, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:09:15', '', '0000-00-00 00:00:00'),
('21122', 'Accured Rents', 'Accrued Expenses', '2112', 4, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:09:17', '', '0000-00-00 00:00:00'),
('21123', 'Commissions due to employees', 'Accrued Expenses', '2112', 4, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:09:20', '', '0000-00-00 00:00:00'),
('2113', 'bank loans', 'Accounts payable', '211', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:08:53', '', '0000-00-00 00:00:00'),
('21131', 'Al Rajhi Bank short term loan', 'bank loans', '2113', 4, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:09:26', '', '0000-00-00 00:00:00'),
('2114', 'Value added tax on sales', 'Accounts payable', '211', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:08:56', '', '0000-00-00 00:00:00'),
('2115', 'Current Inventory', 'Accounts payable', '211', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:08:59', '', '0000-00-00 00:00:00'),
('21151', 'Inventory received unbilled', 'Current Inventory', '2115', 4, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:09:36', '', '0000-00-00 00:00:00'),
('22', 'Non-current liabilities', 'Liabilities', '2', 1, 1, 0, 0, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('221', 'long term loans', 'Non-current liabilities', '22', 2, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:09:55', '', '0000-00-00 00:00:00'),
('2211', 'Al Rajhi Bank loan', 'long term loans', '221', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:07', '', '0000-00-00 00:00:00'),
('222', 'Long-term Allowances ', 'Non-current liabilities', '22', 2, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:34:02', '', '0000-00-00 00:00:00'),
('2221', 'Provision for end of severance pay', 'Long-term Allowances ', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:16', '', '0000-00-00 00:00:00'),
('2222', 'Fixed Asset Depreciation Complex', 'Long-term Allowances ', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:19', '', '0000-00-00 00:00:00'),
('2223', 'Building depreciation complex', 'Long-term Allowances ', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:23', '', '0000-00-00 00:00:00'),
('2224', 'Cars depreciation complex', 'Long-term Allowances ', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:25', '', '0000-00-00 00:00:00'),
('2225', 'Equipment and machinery depreciation complex', 'Long-term Allowances ', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:29', '', '0000-00-00 00:00:00'),
('2226', 'Electronic and computer depreciation complex', 'Long-term Allowances ', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:33', '', '0000-00-00 00:00:00'),
('2227', 'Electrical appliances depreciation complex', 'Long-term Allowances ', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:35', '', '0000-00-00 00:00:00'),
('2228', 'Furniture and furnishings depreciation complex', 'Long-term Allowances ', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:40', '', '0000-00-00 00:00:00'),
('2229', 'Complex depreciation improvements and decoration', 'Long-term Allowances ', '222', 3, 1, 1, 1, 'L', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-08 10:10:42', '', '0000-00-00 00:00:00'),
('3', 'Owners Equity And Capital', 'COA', '0', 0, 1, 0, 0, 'O', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('31', 'Capital', 'Owners Equity And Capital', '3', 1, 1, 0, 0, 'O', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('32', 'Profits and losses of previous years', 'Owners Equity And Capital', '3', 1, 1, 0, 0, 'O', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('33', 'Owner`s Current', 'Owners Equity And Capital', '3', 1, 1, 0, 0, 'O', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4', 'Expenses', 'COA', '0', 0, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('41', 'Direct Expenses', 'Expenses', '4', 1, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('411', 'Net Cost Of Goods Sold', 'Direct Expenses', '41', 2, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:34:17', '', '0000-00-00 00:00:00'),
('4111', 'Cost of goods sold', 'Net Cost Of Goods Sold', '411', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:01:57', '', '0000-00-00 00:00:00'),
('4112', 'Adjustment of inventory with deficit or excess', 'Net Cost Of Goods Sold', '411', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:02:00', '', '0000-00-00 00:00:00'),
('4113', 'Damaged items', 'Net Cost Of Goods Sold', '411', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:02:03', '', '0000-00-00 00:00:00'),
('4114', 'Allowed discount', 'Net Cost Of Goods Sold', '411', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:02:06', '', '0000-00-00 00:00:00'),
('4115', 'Expenses included in the price evaluation', 'Net Cost Of Goods Sold', '411', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:02:09', '', '0000-00-00 00:00:00'),
('42', 'Indirect Expenses', 'Expenses', '4', 1, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('421', 'General and administrative expenses', 'Indirect Expenses', '42', 2, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-16 10:34:37', '', '0000-00-00 00:00:00'),
('4211', 'Payroll', 'General and administrative expenses', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42111', 'Basic Salary', 'Payroll', '4211', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42112', 'Overtime', 'Payroll', '4211', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42113', 'Housing Allowance', 'Payroll', '4211', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42114', 'Transportation Allowance', 'Payroll', '4211', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42115', 'Other Allowances', 'Payroll', '4211', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4212', 'Government expenses for employees', 'General and administrative expenses', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42121', 'Iqama renewal fees for employees', 'Government expenses for employees', '4212', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42122', 'Work card renewal fees for employees', 'Government expenses for employees', '4212', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42123', 'Employee sponsorship transfer fee', 'Government expenses for employees', '4212', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42124', 'Labor recruitment visa fees', 'Government expenses for employees', '4212', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4213', 'Annual allowances', 'General and administrative expenses', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42131', 'Annual leave allowance', 'Annual allowances', '4213', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42132', 'Annual travel ticket allowance', 'Annual allowances', '4213', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42133', 'End of work allowance', 'Annual allowances', '4213', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4214', 'Rentals', 'General and administrative expenses', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42141', 'Rent branchs', 'Rentals', '4214', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42142', 'warehouse rent', 'Rentals', '4214', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42143', 'Showroom rental', 'Rentals', '4214', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42144', 'house rent', 'Rentals', '4214', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4215', 'Expenses of public utilities and services', 'General and administrative expenses', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42151', 'Electricity expenses', 'Expenses of public utilities and services', '4215', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42152', 'water expenses', 'Expenses of public utilities and services', '4215', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42153', 'Telephone and Internet expenses', 'Expenses of public utilities and services', '4215', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4216', 'insurance expenses', 'General and administrative expenses(', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42161', 'Medical insurance expenses for employees', 'insurance expenses', '4216', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42162', 'Car insurance expenses', 'insurance expenses', '4216', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4217', 'Government Expenses', 'General and administrative expenses(', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42171', 'Government Endorsements', 'Government Expenses', '4217', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42172', 'Social Security', 'Government Expenses', '4217', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42173', 'Traffic violations', 'Government Expenses', '4217', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4218', 'Prints and stationery', 'General and administrative expenses(', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42181', 'stationary', 'Prints and stationery', '4218', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42182', 'Publications', 'Prints and stationery', '4218', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4219', 'General maintenance and repair expenses', 'General and administrative expenses(', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42191', 'Building maintenance expenses', 'General maintenance and repair expenses', '4219', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42192', 'Car maintenance expenses', 'General maintenance and repair expenses', '4219', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42193', 'Petrol and fuel expenses for cars', 'General maintenance and repair expenses', '4219', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42194', 'Shipping and transportation expenses', 'General maintenance and repair expenses', '4219', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4220', 'Hospitality and cleaning expenses', 'General and administrative expenses', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42201', 'Hospitality and buffet expenses', 'Hospitality and cleaning expenses ', '4220', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42202', 'Branch cleaning expenses', 'Hospitality and cleaning expenses ', '4220', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4221', 'Commissions and bank expenses', 'General and administrative expenses', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42211', 'Bank fees and expenses', 'Commissions and bank expenses', '4220', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4222', 'Key-money for Exhibition', 'General and administrative expenses', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42221', 'Key-money for Exhibition', 'Key-money for Exhibition', '4222', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4223', 'Depreciation expense', 'General and administrative expenses', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42231', 'Building depreciation expense', 'Depreciation expense', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42232', 'Car depreciation expense', 'Depreciation expense', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42233', 'Equipment and machinery depreciation expense', 'Depreciation expense', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42234', 'Depreciation expense for electronic and computer equipment', 'Depreciation expense', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42235', 'Expense for depreciation of electrical appliances', 'Depreciation expense', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42236', 'Furniture and furnishing depreciation expense', 'Depreciation expense', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42237', 'Depreciation expense for improvements and decoration', 'Depreciation expense', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('42238', 'Depreciation expense of accounting software', 'Depreciation expense', '4223', 4, 1, 0, 0, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('4224', 'Zakat expenses and income', 'General and administrative expenses(', '421', 3, 1, 1, 1, 'E', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('5', 'Revenues', 'COA', '0', 0, 1, 0, 0, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('51', 'Sales revenue', 'Revenues', '5', 1, 1, 0, 0, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('511', 'Electricity sales', 'Sales revenue', '51', 2, 1, 0, 0, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('5111', 'Showroom sales for Electricity sales', 'Electricity sales', '511', 3, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:02:53', '', '0000-00-00 00:00:00'),
('5112', 'Wholesale sector sales for Electricity sales', 'Electricity sales', '511', 3, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:02:56', '', '0000-00-00 00:00:00'),
('5113', 'Service sales and maintenance for Electricity sales', 'Electricity sales', '511', 3, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:03:00', '', '0000-00-00 00:00:00'),
('512', 'Sales returns', 'Sales revenue', '51', 2, 1, 0, 0, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('5121', 'Sales return for Showroom sales ', 'Sales returns', '512', 3, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:03:05', '', '0000-00-00 00:00:00'),
('5122', 'Sales return Wholesale sector sales for Electricity sales ', 'Sales returns', '512', 3, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:03:09', '', '0000-00-00 00:00:00'),
('5123', 'Sales return Service sales and maintenance for Electricity sales ', 'Sales returns', '512', 3, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-07 11:03:12', '', '0000-00-00 00:00:00'),
('52', 'Other revenue', 'Revenues', '5', 1, 1, 0, 0, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('521', 'Discount Received', 'Other revenue', '52', 2, 1, 1, 1, 'I', 0, 0, NULL, NULL, NULL, NULL, NULL, '0.00', '1', '2021-11-15 05:42:02', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `acc_fiscal_year`
--

CREATE TABLE `acc_fiscal_year` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active,2=closed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acc_fiscal_year`
--

INSERT INTO `acc_fiscal_year` (`id`, `title`, `start_date`, `end_date`, `status`) VALUES
(2, '2022-2023', '2022-07-01', '2023-06-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acc_opening_balances`
--

CREATE TABLE `acc_opening_balances` (
  `id` int(11) NOT NULL,
  `fy_id` int(11) NOT NULL,
  `headcode` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `current_balance` decimal(10,2) DEFAULT NULL,
  `adjustment_date` date DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acc_opening_balances`
--

INSERT INTO `acc_opening_balances` (`id`, `fy_id`, `headcode`, `amount`, `current_balance`, `adjustment_date`, `created_by`, `created_at`) VALUES
(1, 2, 21110002, 6536, NULL, '2022-08-09', '1', '2022-08-09 15:43:01'),
(2, 2, 11310003, 5345, NULL, '2022-08-09', '1', '2022-08-09 15:47:36'),
(3, 2, 21110003, 1000, NULL, '2022-08-09', '1', '2022-08-09 15:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `acc_rv_details`
--

CREATE TABLE `acc_rv_details` (
  `acc_rv_id` int(11) NOT NULL,
  `VNo` varchar(100) DEFAULT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `variant_id` varchar(100) DEFAULT NULL,
  `color_variant` varchar(100) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_rate` float DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `discount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_transaction`
--

CREATE TABLE `acc_transaction` (
  `ID` int(11) NOT NULL,
  `fy_id` int(11) NOT NULL,
  `VNo` varchar(50) DEFAULT NULL,
  `Vtype` varchar(50) DEFAULT NULL,
  `VDate` date DEFAULT NULL,
  `COAID` varchar(50) NOT NULL,
  `Narration` text,
  `Debit` decimal(18,2) DEFAULT NULL,
  `Credit` decimal(18,2) DEFAULT NULL,
  `IsPosted` char(10) DEFAULT NULL,
  `is_opening` int(11) NOT NULL DEFAULT '0',
  `store_id` varchar(50) DEFAULT NULL,
  `CreateBy` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `IsAppove` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acc_transaction`
--

INSERT INTO `acc_transaction` (`ID`, `fy_id`, `VNo`, `Vtype`, `VDate`, `COAID`, `Narration`, `Debit`, `Credit`, `IsPosted`, `is_opening`, `store_id`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`, `IsAppove`) VALUES
(4, 2, 'OP-21110002', 'Sales', '2022-08-09', '3', 'Opening balance credired from \"Owners Equity And Capital\" from: ', '0.00', '6536.00', '1', 1, NULL, NULL, '2022-08-09 17:43:01', NULL, NULL, '1'),
(5, 2, 'OP-11310003', 'Sales', '2022-08-09', '3', 'Opening balance credired from \"Owners Equity And Capital\" from: ', '0.00', '5345.00', '1', 1, NULL, NULL, '2022-08-09 17:47:36', NULL, NULL, '1'),
(6, 2, 'OP-21110003', 'Sales', '2022-08-09', '3', 'Opening balance credired from \"Owners Equity And Capital\" from: ', '0.00', '1000.00', '1', 1, NULL, NULL, '2022-08-09 17:55:12', NULL, NULL, '1'),
(7, 2, 'StockOP-3288634', 'Inventory-Openning', '2022-08-09', '1141', 'Inventory-Openning total price debited at Main warehouse', '0.00', '0.00', '1', 0, 'ZAACM94HLFHE74R', '1', '2022-08-09 17:59:56', NULL, NULL, '1'),
(8, 2, 'StockOP-3288634', 'Inventory-Openning', '2022-08-09', '4111', 'Inventory-Openning total price credited at COGS', '0.00', '0.00', '1', 0, 'ZAACM94HLFHE74R', '1', '2022-08-09 17:59:56', NULL, NULL, '1'),
(9, 2, 'StockOP-7171129', 'Inventory-Openning', '2022-08-09', '1141', 'Inventory-Openning total price debited at Main warehouse', '0.00', '0.00', '1', 0, 'ZAACM94HLFHE74R', '1', '2022-08-09 18:30:04', NULL, NULL, '1'),
(10, 2, 'StockOP-7171129', 'Inventory-Openning', '2022-08-09', '4111', 'Inventory-Openning total price credited at COGS', '0.00', '0.00', '1', 0, 'ZAACM94HLFHE74R', '1', '2022-08-09 18:30:04', NULL, NULL, '1'),
(11, 2, 'Inv-Y7CEPK9RJGLPXJH', 'Sales', '2022-08-09', '11310001', 'Sales \"total with vat\" debited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:30:53', NULL, NULL, '1'),
(12, 2, 'Inv-Y7CEPK9RJGLPXJH', 'Sales', '2022-08-09', '4114', 'Sales \"total discount\" debited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:30:53', NULL, NULL, '1'),
(13, 2, 'Inv-Y7CEPK9RJGLPXJH', 'Sales', '2022-08-09', '5111', 'Sales \"total price before discount\" store_credit credited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:30:53', NULL, NULL, '1'),
(14, 2, 'Inv-Y7CEPK9RJGLPXJH', 'Sales', '2022-08-09', '2114', 'Sales \"total vat\" credited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:30:53', NULL, NULL, '1'),
(15, 2, 'Inv-Y7CEPK9RJGLPXJH', 'Sales', '2022-08-09', '4111', 'Sales \"cost of goods sold\" debited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:30:53', NULL, NULL, '1'),
(16, 2, 'Inv-Y7CEPK9RJGLPXJH', 'Sales', '2022-08-09', '1141', '\"cost of goods sold\" Main warehouse credited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:30:53', NULL, NULL, '1'),
(17, 2, 'Inv-6I2FVA6V5433BJI', 'Sales', '2022-08-09', '11310001', 'Sales \"total with vat\" debited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:38:29', NULL, NULL, '1'),
(18, 2, 'Inv-6I2FVA6V5433BJI', 'Sales', '2022-08-09', '4114', 'Sales \"total discount\" debited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:38:29', NULL, NULL, '1'),
(19, 2, 'Inv-6I2FVA6V5433BJI', 'Sales', '2022-08-09', '5111', 'Sales \"total price before discount\" store_credit credited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:38:29', NULL, NULL, '1'),
(20, 2, 'Inv-6I2FVA6V5433BJI', 'Sales', '2022-08-09', '2114', 'Sales \"total vat\" credited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:38:29', NULL, NULL, '1'),
(21, 2, 'Inv-6I2FVA6V5433BJI', 'Sales', '2022-08-09', '4111', 'Sales \"cost of goods sold\" debited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:38:29', NULL, NULL, '1'),
(22, 2, 'Inv-6I2FVA6V5433BJI', 'Sales', '2022-08-09', '1141', '\"cost of goods sold\" Main warehouse credited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:38:29', NULL, NULL, '1'),
(23, 2, 'Inv-GW1UE3PFAD9S12O', 'Sales', '2022-08-09', '11310001', 'Sales \"total with vat\" debited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:40:46', NULL, NULL, '1'),
(24, 2, 'Inv-GW1UE3PFAD9S12O', 'Sales', '2022-08-09', '4114', 'Sales \"total discount\" debited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:40:46', NULL, NULL, '1'),
(25, 2, 'Inv-GW1UE3PFAD9S12O', 'Sales', '2022-08-09', '5111', 'Sales \"total price before discount\" store_credit credited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:40:46', NULL, NULL, '1'),
(26, 2, 'Inv-GW1UE3PFAD9S12O', 'Sales', '2022-08-09', '2114', 'Sales \"total vat\" credited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:40:46', NULL, NULL, '1'),
(27, 2, 'Inv-GW1UE3PFAD9S12O', 'Sales', '2022-08-09', '4111', 'Sales \"cost of goods sold\" debited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:40:46', NULL, NULL, '1'),
(28, 2, 'Inv-GW1UE3PFAD9S12O', 'Sales', '2022-08-09', '1141', '\"cost of goods sold\" Main warehouse credited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-09 18:40:46', NULL, NULL, '1'),
(29, 2, 'p-8IBKVRXFISUNE6W', 'Purchase', '2022-08-09', '1111', 'Purchase expence proof (Cash in box general administration) credit by supplier id: Ntest(2KC5UJS472BA6JKYMCZG)', '0.00', '303.00', '1', 0, 'ZAACM94HLFHE74R', '1', '2022-08-09 18:42:47', NULL, NULL, '1'),
(30, 2, 'p-8IBKVRXFISUNE6W', 'Purchase', '2022-08-09', '1111', 'Purchase sunglasses VAT (Cash in box general administration) credit by supplier id: Ntest(2KC5UJS472BA6JKYMCZG)', '0.00', '0.00', '1', 0, 'ZAACM94HLFHE74R', '1', '2022-08-09 18:42:47', NULL, NULL, '1'),
(31, 2, 'p-8IBKVRXFISUNE6W', 'Purchase', '2022-08-09', '1141', 'Purchase total price before discount debit by Main warehouse', '0.00', '0.00', '1', 0, 'ZAACM94HLFHE74R', '1', '2022-08-09 18:42:47', NULL, NULL, '1'),
(32, 2, 'p-8IBKVRXFISUNE6W', 'Purchase', '2022-08-09', '21110002', 'Purchase \"total_price_with_vat\" credited by supplier: Ntest(2KC5UJS472BA6JKYMCZG)', '0.00', '0.00', '1', 0, 'ZAACM94HLFHE74R', '1', '2022-08-09 18:42:47', NULL, NULL, '1'),
(33, 2, 'p-8IBKVRXFISUNE6W', 'Purchase', '2022-08-09', '116', 'Purchase vat/tax total debit by supplier id: Ntest(2KC5UJS472BA6JKYMCZG)', '0.00', '0.00', '1', 0, 'ZAACM94HLFHE74R', '1', '2022-08-09 18:42:47', NULL, NULL, '1'),
(34, 2, 'p-8IBKVRXFISUNE6W', 'Purchase', '2022-08-09', '521', 'Purchase total discount credit by supplier id: Ntest(2KC5UJS472BA6JKYMCZG)', '0.00', '0.00', '1', 0, 'ZAACM94HLFHE74R', '1', '2022-08-09 18:42:47', NULL, NULL, '1'),
(35, 2, 'p-8IBKVRXFISUNE6W', 'Purchase', '2022-08-09', '1141', 'Purchase expence proof (Main warehouse) debit by supplier id: Ntest(2KC5UJS472BA6JKYMCZG)', '303.00', '0.00', '1', 0, 'ZAACM94HLFHE74R', '1', '2022-08-09 18:42:47', NULL, NULL, '1'),
(36, 2, 'Inv-2AJIH1Q3IPBFYC5', 'Sales', '2022-08-10', '11310001', 'Sales \"total with vat\" debited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-10 08:25:56', NULL, NULL, '1'),
(37, 2, 'Inv-2AJIH1Q3IPBFYC5', 'Sales', '2022-08-10', '4114', 'Sales \"total discount\" debited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-10 08:25:56', NULL, NULL, '1'),
(38, 2, 'Inv-2AJIH1Q3IPBFYC5', 'Sales', '2022-08-10', '5111', 'Sales \"total price before discount\" store_credit credited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-10 08:25:56', NULL, NULL, '1'),
(39, 2, 'Inv-2AJIH1Q3IPBFYC5', 'Sales', '2022-08-10', '2114', 'Sales \"total vat\" credited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-10 08:25:56', NULL, NULL, '1'),
(40, 2, 'Inv-2AJIH1Q3IPBFYC5', 'Sales', '2022-08-10', '4111', 'Sales \"cost of goods sold\" debited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-10 08:25:56', NULL, NULL, '1'),
(41, 2, 'Inv-2AJIH1Q3IPBFYC5', 'Sales', '2022-08-10', '1141', '\"cost of goods sold\" Main warehouse credited by customer id: Mr.Customer - Q2F8JTKZLICO4LE(Q2F8JTKZLICO4LE)', '0.00', '0.00', '1', 0, NULL, '1', '2022-08-10 08:25:56', NULL, NULL, '1'),
(42, 0, '20220822042613', 'Expense', '2022-08-22', '111000001', 'internet bill Expense20220822042613', '0.00', '900.00', '1', 0, NULL, '1', '2022-08-22 16:26:13', NULL, NULL, '1'),
(43, 2, 'StockOP-7934221', 'Inventory-Openning', '2022-10-13', '1141', 'Inventory-Openning total price debited at Main warehouse', '0.00', '0.00', '1', 0, 'ZAACM94HLFHE74R', 'WNT31FLN1WO62KP', '2022-10-13 16:44:13', NULL, NULL, '1'),
(44, 2, 'StockOP-7934221', 'Inventory-Openning', '2022-10-13', '4111', 'Inventory-Openning total price credited at COGS', '0.00', '0.00', '1', 0, 'ZAACM94HLFHE74R', 'WNT31FLN1WO62KP', '2022-10-13 16:44:13', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `adv_id` varchar(100) NOT NULL,
  `add_page` varchar(100) DEFAULT NULL,
  `adv_position` int(11) NOT NULL,
  `adv_code` text NOT NULL,
  `adv_code2` text,
  `adv_code3` text,
  `adv_url` varchar(200) DEFAULT NULL,
  `adv_url2` varchar(200) DEFAULT NULL,
  `adv_url3` varchar(200) DEFAULT NULL,
  `adv_type` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assembly_products`
--

CREATE TABLE `assembly_products` (
  `id` int(11) NOT NULL,
  `parent_product_id` varchar(100) NOT NULL,
  `child_product_id` varchar(100) NOT NULL,
  `child_product_price` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assembly_products_translation`
--

CREATE TABLE `assembly_products_translation` (
  `trans_id` int(11) NOT NULL,
  `language` varchar(30) DEFAULT NULL,
  `assembly_product_id` varchar(30) DEFAULT NULL,
  `trans_name` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `att_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `sign_in` varchar(30) NOT NULL,
  `sign_out` varchar(30) NOT NULL,
  `staytime` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bank_list`
--

CREATE TABLE `bank_list` (
  `bank_id` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `ac_name` varchar(250) DEFAULT NULL,
  `ac_number` varchar(250) DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  `signature_pic` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `default_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_list`
--

INSERT INTO `bank_list` (`bank_id`, `bank_name`, `ac_name`, `ac_number`, `branch`, `signature_pic`, `status`, `default_status`) VALUES
('FG2ICBE9EZ', 'Cash à la livraison', 'Cash à la livraison', '24145454545', 'Cash à la livraison', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bank_payment`
--

CREATE TABLE `bank_payment` (
  `bank_payment_id` varchar(100) NOT NULL,
  `bank_id` varchar(100) NOT NULL,
  `account_no` varchar(100) DEFAULT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `terminal_id` varchar(100) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `block_id` varchar(100) NOT NULL,
  `block_cat_id` varchar(100) DEFAULT NULL,
  `block_css` text,
  `block_position` int(11) DEFAULT NULL,
  `block_image` varchar(255) DEFAULT NULL,
  `block_style` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`block_id`, `block_cat_id`, `block_css`, `block_position`, `block_image`, `block_style`, `status`) VALUES
('4BPKWJEQJWAGRTR', 'F9GNCBBPCOIEN67', 'null', 2, 'my-assets/image/block_image/bb95e0376e40400f50107286a57e623e.png', 1, 1),
('UL5F8OSSOSELGG1', 'F9GNCBBPCOIEN67', 'null', 1, 'my-assets/image/block_image/7d31765044e31646ded665f257f47b71.png', 2, 1),
('ZQI16IFS5SCPFNY', 'F9GNCBBPCOIEN67', 'null', 1, 'my-assets/image/block_image/72e00c2158cc93baebd10046c08274ba.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_image` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_image`, `website`, `status`) VALUES
('3ETOBYNA7CR764W', 'EYEPLAYER', 'my-assets/image/brand_image/418d2c09d79902250737b01887665f2d.jpg', '', 1),
('3HV2CSP96FB32KV', 'MIX', 'my-assets/image/brand_image/5b2b9d8585e316e07c08a8df0f26df1e.jpg', '', 1),
('5UE4KNOONB3IPNH', 'ROSE KAZAN', 'my-assets/image/brand_image/5f078cb8325a45d875f945b6b061a95b.jpg', '', 1),
('CPUZUPJ4DM3MTD8', 'MARCO PHILIP', 'my-assets/image/brand_image/91be3e9f509d83964ab45487e211c9bc.jpg', '', 1),
('D2NMJUXQHWT2XHR', 'ROLL UP - EYEWEAR', 'my-assets/image/brand_image/ca62797388f5b765502d0ef7f49ad4c5.jpg', '', 1),
('EZERMV9PGMOJ97Q', 'LOUIS MOREL', 'my-assets/image/brand_image/f9c853d18fd4a0e4427008f2e4c82150.jpg', '', 1),
('N39O5VD36PQIZL3', 'DEXTER`S', 'my-assets/image/brand_image/93545e31de0ec8033e5cfbc11b3f83f3.jpg', '', 1),
('QKDUL6I9ZN13WXM', 'AIRLITE', 'my-assets/image/brand_image/3034b64e63d0eed3bee94ed4a925704b.jpg', '', 1),
('R2Y972MLQMFO35G', 'MY COLOR', 'my-assets/image/brand_image/6a87e6d40f4f9183b628041a7fc078b4.jpg', '', 1),
('TVKT77U78569Y6G', 'ROLL UP - SUNGLASSES', 'my-assets/image/brand_image/b160d7d990f4681ab4009afd210bb76b.jpg', '', 1),
('U37HII5KM35U6K1', 'MARCO MALDINI', 'my-assets/image/brand_image/a9a1cc442dc6b1345bad28d765196cc5.jpg', '', 1),
('ZPTCQY9NWWUJ8PI', 'INSIST', 'my-assets/image/brand_image/dbf2059fa659aff9b0f8935c14f1aeff.jpg', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand_translation`
--

CREATE TABLE `brand_translation` (
  `trans_id` int(11) NOT NULL,
  `language` varchar(30) NOT NULL,
  `brand_id` varchar(50) NOT NULL,
  `trans_name` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand_translation`
--

INSERT INTO `brand_translation` (`trans_id`, `language`, `brand_id`, `trans_name`) VALUES
(1, '', 'QKDUL6I9ZN13WXM', ''),
(2, '', 'N39O5VD36PQIZL3', ''),
(3, '', '3ETOBYNA7CR764W', ''),
(4, '', 'ZPTCQY9NWWUJ8PI', ''),
(5, '', 'EZERMV9PGMOJ97Q', ''),
(6, '', 'U37HII5KM35U6K1', ''),
(7, '', 'CPUZUPJ4DM3MTD8', ''),
(8, '', '3HV2CSP96FB32KV', ''),
(9, '', 'R2Y972MLQMFO35G', ''),
(10, '', 'D2NMJUXQHWT2XHR', ''),
(11, '', 'TVKT77U78569Y6G', ''),
(12, '', '5UE4KNOONB3IPNH', '');

-- --------------------------------------------------------

--
-- Table structure for table `captcha_print_setting`
--

CREATE TABLE `captcha_print_setting` (
  `id` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `captcha_print_setting`
--

INSERT INTO `captcha_print_setting` (`id`, `isActive`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cardpayment`
--

CREATE TABLE `cardpayment` (
  `cardpayment_id` varchar(100) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `terminal_id` varchar(100) NOT NULL,
  `card_type` varchar(255) NOT NULL,
  `card_no` varchar(100) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category_translation`
--

CREATE TABLE `category_translation` (
  `trans_id` int(11) NOT NULL,
  `language` varchar(30) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `trans_name` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_translation`
--

INSERT INTO `category_translation` (`trans_id`, `language`, `category_id`, `trans_name`) VALUES
(6, 'Arabic', 'XJIMM9X3ZAWUYXQ', 'نظارات شمسية'),
(7, '', 'NZUN74MS3GP8QAV', ''),
(8, 'Arabic', '8R2IU8QPOMXHP6P', 'نظارات نظر'),
(9, '', 'TMUAZSTV94N429V', ''),
(10, '', '58B9925CNZVP3IV', ''),
(11, '', 'OPIYH2SKJGL3TQL', ''),
(12, '', 'CVZAD4DOPN8PQB8', '');

-- --------------------------------------------------------

--
-- Table structure for table `category_variant`
--

CREATE TABLE `category_variant` (
  `id` int(11) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `variant_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_variant`
--

INSERT INTO `category_variant` (`id`, `category_id`, `variant_id`, `created_at`, `updated_at`) VALUES
(9, '8R2IU8QPOMXHP6P', '9MOOCENUA78IR8J', '2022-07-27 12:15:29', '2022-07-27 12:15:29'),
(10, 'NZUN74MS3GP8QAV', 'D18C9O71P6ZNJH8', '2022-07-27 19:32:10', '2022-07-27 19:32:10'),
(11, 'TMUAZSTV94N429V', 'D18C9O71P6ZNJH8', '2022-07-27 19:32:10', '2022-07-27 19:32:10'),
(12, '58B9925CNZVP3IV', 'D18C9O71P6ZNJH8', '2022-07-27 19:32:10', '2022-07-27 19:32:10'),
(13, '8R2IU8QPOMXHP6P', 'D18C9O71P6ZNJH8', '2022-07-27 19:32:10', '2022-07-27 19:32:10'),
(14, 'OPIYH2SKJGL3TQL', 'D18C9O71P6ZNJH8', '2022-07-27 19:32:10', '2022-07-27 19:32:10'),
(15, 'XJIMM9X3ZAWUYXQ', 'D18C9O71P6ZNJH8', '2022-07-27 19:32:10', '2022-07-27 19:32:10'),
(16, 'NZUN74MS3GP8QAV', '6Y2VQIGS7ULFM41', '2022-07-27 19:33:03', '2022-07-27 19:33:03'),
(17, 'TMUAZSTV94N429V', '6Y2VQIGS7ULFM41', '2022-07-27 19:33:03', '2022-07-27 19:33:03'),
(18, '58B9925CNZVP3IV', '6Y2VQIGS7ULFM41', '2022-07-27 19:33:03', '2022-07-27 19:33:03'),
(19, '8R2IU8QPOMXHP6P', '6Y2VQIGS7ULFM41', '2022-07-27 19:33:03', '2022-07-27 19:33:03'),
(20, 'OPIYH2SKJGL3TQL', '6Y2VQIGS7ULFM41', '2022-07-27 19:33:03', '2022-07-27 19:33:03'),
(21, 'XJIMM9X3ZAWUYXQ', '6Y2VQIGS7ULFM41', '2022-07-27 19:33:03', '2022-07-27 19:33:03'),
(22, 'NZUN74MS3GP8QAV', 'HI8FGNO6UCC3SAS', '2022-07-27 19:33:45', '2022-07-27 19:33:45'),
(23, 'TMUAZSTV94N429V', 'HI8FGNO6UCC3SAS', '2022-07-27 19:33:45', '2022-07-27 19:33:45'),
(24, '58B9925CNZVP3IV', 'HI8FGNO6UCC3SAS', '2022-07-27 19:33:45', '2022-07-27 19:33:45'),
(25, '8R2IU8QPOMXHP6P', 'HI8FGNO6UCC3SAS', '2022-07-27 19:33:45', '2022-07-27 19:33:45'),
(26, 'OPIYH2SKJGL3TQL', 'HI8FGNO6UCC3SAS', '2022-07-27 19:33:45', '2022-07-27 19:33:45'),
(27, 'XJIMM9X3ZAWUYXQ', 'HI8FGNO6UCC3SAS', '2022-07-27 19:33:45', '2022-07-27 19:33:45'),
(28, 'NZUN74MS3GP8QAV', '68IMTA2HTFS7F4R', '2022-07-27 19:34:20', '2022-07-27 19:34:20'),
(29, 'TMUAZSTV94N429V', '68IMTA2HTFS7F4R', '2022-07-27 19:34:20', '2022-07-27 19:34:20'),
(30, '58B9925CNZVP3IV', '68IMTA2HTFS7F4R', '2022-07-27 19:34:20', '2022-07-27 19:34:20'),
(31, '8R2IU8QPOMXHP6P', '68IMTA2HTFS7F4R', '2022-07-27 19:34:20', '2022-07-27 19:34:20'),
(32, 'OPIYH2SKJGL3TQL', '68IMTA2HTFS7F4R', '2022-07-27 19:34:20', '2022-07-27 19:34:20'),
(33, 'XJIMM9X3ZAWUYXQ', '68IMTA2HTFS7F4R', '2022-07-27 19:34:20', '2022-07-27 19:34:20'),
(34, 'NZUN74MS3GP8QAV', 'NGECVGAIPNMAO6T', '2022-07-27 19:36:21', '2022-07-27 19:36:21'),
(35, 'TMUAZSTV94N429V', 'NGECVGAIPNMAO6T', '2022-07-27 19:36:21', '2022-07-27 19:36:21'),
(36, '58B9925CNZVP3IV', 'NGECVGAIPNMAO6T', '2022-07-27 19:36:21', '2022-07-27 19:36:21'),
(37, '8R2IU8QPOMXHP6P', 'NGECVGAIPNMAO6T', '2022-07-27 19:36:21', '2022-07-27 19:36:21'),
(38, 'OPIYH2SKJGL3TQL', 'NGECVGAIPNMAO6T', '2022-07-27 19:36:21', '2022-07-27 19:36:21'),
(39, 'XJIMM9X3ZAWUYXQ', 'NGECVGAIPNMAO6T', '2022-07-27 19:36:21', '2022-07-27 19:36:21'),
(40, 'NZUN74MS3GP8QAV', 'VD56N643ZV7ZFUR', '2022-07-27 19:36:41', '2022-07-27 19:36:41'),
(41, 'TMUAZSTV94N429V', 'VD56N643ZV7ZFUR', '2022-07-27 19:36:41', '2022-07-27 19:36:41'),
(42, '58B9925CNZVP3IV', 'VD56N643ZV7ZFUR', '2022-07-27 19:36:41', '2022-07-27 19:36:41'),
(43, '8R2IU8QPOMXHP6P', 'VD56N643ZV7ZFUR', '2022-07-27 19:36:41', '2022-07-27 19:36:41'),
(44, 'OPIYH2SKJGL3TQL', 'VD56N643ZV7ZFUR', '2022-07-27 19:36:41', '2022-07-27 19:36:41'),
(45, 'XJIMM9X3ZAWUYXQ', 'VD56N643ZV7ZFUR', '2022-07-27 19:36:41', '2022-07-27 19:36:41'),
(46, 'NZUN74MS3GP8QAV', '9OKNPAS6Y8AA64J', '2022-07-27 19:37:08', '2022-07-27 19:37:08'),
(47, 'TMUAZSTV94N429V', '9OKNPAS6Y8AA64J', '2022-07-27 19:37:08', '2022-07-27 19:37:08'),
(48, '58B9925CNZVP3IV', '9OKNPAS6Y8AA64J', '2022-07-27 19:37:08', '2022-07-27 19:37:08'),
(49, '8R2IU8QPOMXHP6P', '9OKNPAS6Y8AA64J', '2022-07-27 19:37:08', '2022-07-27 19:37:08'),
(50, 'OPIYH2SKJGL3TQL', '9OKNPAS6Y8AA64J', '2022-07-27 19:37:08', '2022-07-27 19:37:08'),
(51, 'XJIMM9X3ZAWUYXQ', '9OKNPAS6Y8AA64J', '2022-07-27 19:37:08', '2022-07-27 19:37:08'),
(52, 'NZUN74MS3GP8QAV', 'WGN39DRE2MEILUA', '2022-07-27 19:37:25', '2022-07-27 19:37:25'),
(53, 'TMUAZSTV94N429V', 'WGN39DRE2MEILUA', '2022-07-27 19:37:25', '2022-07-27 19:37:25'),
(54, '58B9925CNZVP3IV', 'WGN39DRE2MEILUA', '2022-07-27 19:37:25', '2022-07-27 19:37:25'),
(55, '8R2IU8QPOMXHP6P', 'WGN39DRE2MEILUA', '2022-07-27 19:37:25', '2022-07-27 19:37:25'),
(56, 'OPIYH2SKJGL3TQL', 'WGN39DRE2MEILUA', '2022-07-27 19:37:25', '2022-07-27 19:37:25'),
(57, 'XJIMM9X3ZAWUYXQ', 'WGN39DRE2MEILUA', '2022-07-27 19:37:25', '2022-07-27 19:37:25'),
(58, 'NZUN74MS3GP8QAV', 'KA4FTIILIN6IQA2', '2022-07-27 19:37:46', '2022-07-27 19:37:46'),
(59, 'TMUAZSTV94N429V', 'KA4FTIILIN6IQA2', '2022-07-27 19:37:46', '2022-07-27 19:37:46'),
(60, '58B9925CNZVP3IV', 'KA4FTIILIN6IQA2', '2022-07-27 19:37:46', '2022-07-27 19:37:46'),
(61, '8R2IU8QPOMXHP6P', 'KA4FTIILIN6IQA2', '2022-07-27 19:37:46', '2022-07-27 19:37:46'),
(62, 'OPIYH2SKJGL3TQL', 'KA4FTIILIN6IQA2', '2022-07-27 19:37:46', '2022-07-27 19:37:46'),
(63, 'XJIMM9X3ZAWUYXQ', 'KA4FTIILIN6IQA2', '2022-07-27 19:37:46', '2022-07-27 19:37:46'),
(64, 'NZUN74MS3GP8QAV', '7KD5QQFH534LGE9', '2022-07-27 19:38:01', '2022-07-27 19:38:01'),
(65, 'TMUAZSTV94N429V', '7KD5QQFH534LGE9', '2022-07-27 19:38:01', '2022-07-27 19:38:01'),
(66, '58B9925CNZVP3IV', '7KD5QQFH534LGE9', '2022-07-27 19:38:01', '2022-07-27 19:38:01'),
(67, '8R2IU8QPOMXHP6P', '7KD5QQFH534LGE9', '2022-07-27 19:38:01', '2022-07-27 19:38:01'),
(68, 'OPIYH2SKJGL3TQL', '7KD5QQFH534LGE9', '2022-07-27 19:38:01', '2022-07-27 19:38:01'),
(69, 'XJIMM9X3ZAWUYXQ', '7KD5QQFH534LGE9', '2022-07-27 19:38:01', '2022-07-27 19:38:01'),
(70, 'NZUN74MS3GP8QAV', 'SGBUWP4FUHVYFH8', '2022-07-27 19:38:29', '2022-07-27 19:38:29'),
(71, 'TMUAZSTV94N429V', 'SGBUWP4FUHVYFH8', '2022-07-27 19:38:29', '2022-07-27 19:38:29'),
(72, '58B9925CNZVP3IV', 'SGBUWP4FUHVYFH8', '2022-07-27 19:38:29', '2022-07-27 19:38:29'),
(73, '8R2IU8QPOMXHP6P', 'SGBUWP4FUHVYFH8', '2022-07-27 19:38:29', '2022-07-27 19:38:29'),
(74, 'OPIYH2SKJGL3TQL', 'SGBUWP4FUHVYFH8', '2022-07-27 19:38:29', '2022-07-27 19:38:29'),
(75, 'XJIMM9X3ZAWUYXQ', 'SGBUWP4FUHVYFH8', '2022-07-27 19:38:29', '2022-07-27 19:38:29'),
(76, 'NZUN74MS3GP8QAV', 'N6FKR1QWNFJ58U1', '2022-07-27 19:40:27', '2022-07-27 19:40:27'),
(77, 'TMUAZSTV94N429V', 'N6FKR1QWNFJ58U1', '2022-07-27 19:40:27', '2022-07-27 19:40:27'),
(78, '58B9925CNZVP3IV', 'N6FKR1QWNFJ58U1', '2022-07-27 19:40:27', '2022-07-27 19:40:27'),
(79, '8R2IU8QPOMXHP6P', 'N6FKR1QWNFJ58U1', '2022-07-27 19:40:27', '2022-07-27 19:40:27'),
(80, 'OPIYH2SKJGL3TQL', 'N6FKR1QWNFJ58U1', '2022-07-27 19:40:27', '2022-07-27 19:40:27'),
(81, 'XJIMM9X3ZAWUYXQ', 'N6FKR1QWNFJ58U1', '2022-07-27 19:40:27', '2022-07-27 19:40:27'),
(82, 'NZUN74MS3GP8QAV', 'W2469T5KFFDJ88J', '2022-07-27 19:40:51', '2022-07-27 19:40:51'),
(83, 'TMUAZSTV94N429V', 'W2469T5KFFDJ88J', '2022-07-27 19:40:51', '2022-07-27 19:40:51'),
(84, '58B9925CNZVP3IV', 'W2469T5KFFDJ88J', '2022-07-27 19:40:51', '2022-07-27 19:40:51'),
(85, '8R2IU8QPOMXHP6P', 'W2469T5KFFDJ88J', '2022-07-27 19:40:51', '2022-07-27 19:40:51'),
(86, 'OPIYH2SKJGL3TQL', 'W2469T5KFFDJ88J', '2022-07-27 19:40:51', '2022-07-27 19:40:51'),
(87, 'XJIMM9X3ZAWUYXQ', 'W2469T5KFFDJ88J', '2022-07-27 19:40:51', '2022-07-27 19:40:51'),
(88, 'NZUN74MS3GP8QAV', '172214O4NXIEXFC', '2022-07-27 19:43:57', '2022-07-27 19:43:57'),
(89, 'TMUAZSTV94N429V', '172214O4NXIEXFC', '2022-07-27 19:43:57', '2022-07-27 19:43:57'),
(90, '58B9925CNZVP3IV', '172214O4NXIEXFC', '2022-07-27 19:43:57', '2022-07-27 19:43:57'),
(91, '8R2IU8QPOMXHP6P', '172214O4NXIEXFC', '2022-07-27 19:43:57', '2022-07-27 19:43:57'),
(92, 'OPIYH2SKJGL3TQL', '172214O4NXIEXFC', '2022-07-27 19:43:57', '2022-07-27 19:43:57'),
(93, 'XJIMM9X3ZAWUYXQ', '172214O4NXIEXFC', '2022-07-27 19:43:57', '2022-07-27 19:43:57'),
(94, 'NZUN74MS3GP8QAV', 'EIIW78GRZAGXRM2', '2022-07-27 19:44:39', '2022-07-27 19:44:39'),
(95, 'TMUAZSTV94N429V', 'EIIW78GRZAGXRM2', '2022-07-27 19:44:39', '2022-07-27 19:44:39'),
(96, '58B9925CNZVP3IV', 'EIIW78GRZAGXRM2', '2022-07-27 19:44:39', '2022-07-27 19:44:39'),
(97, '8R2IU8QPOMXHP6P', 'EIIW78GRZAGXRM2', '2022-07-27 19:44:39', '2022-07-27 19:44:39'),
(98, 'OPIYH2SKJGL3TQL', 'EIIW78GRZAGXRM2', '2022-07-27 19:44:39', '2022-07-27 19:44:39'),
(99, 'XJIMM9X3ZAWUYXQ', 'EIIW78GRZAGXRM2', '2022-07-27 19:44:39', '2022-07-27 19:44:39'),
(107, 'NZUN74MS3GP8QAV', 'O67PSLMQFX5UJWW', '2022-07-27 19:46:02', '2022-07-27 19:46:02'),
(108, 'TMUAZSTV94N429V', 'O67PSLMQFX5UJWW', '2022-07-27 19:46:02', '2022-07-27 19:46:02'),
(109, '58B9925CNZVP3IV', 'O67PSLMQFX5UJWW', '2022-07-27 19:46:02', '2022-07-27 19:46:02'),
(110, '8R2IU8QPOMXHP6P', 'O67PSLMQFX5UJWW', '2022-07-27 19:46:02', '2022-07-27 19:46:02'),
(111, 'OPIYH2SKJGL3TQL', 'O67PSLMQFX5UJWW', '2022-07-27 19:46:02', '2022-07-27 19:46:02'),
(112, 'XJIMM9X3ZAWUYXQ', 'O67PSLMQFX5UJWW', '2022-07-27 19:46:02', '2022-07-27 19:46:02'),
(113, 'NZUN74MS3GP8QAV', '7BUVR657E85OZLK', '2022-07-27 19:46:21', '2022-07-27 19:46:21'),
(114, 'TMUAZSTV94N429V', '7BUVR657E85OZLK', '2022-07-27 19:46:21', '2022-07-27 19:46:21'),
(115, '58B9925CNZVP3IV', '7BUVR657E85OZLK', '2022-07-27 19:46:21', '2022-07-27 19:46:21'),
(116, '8R2IU8QPOMXHP6P', '7BUVR657E85OZLK', '2022-07-27 19:46:21', '2022-07-27 19:46:21'),
(117, 'OPIYH2SKJGL3TQL', '7BUVR657E85OZLK', '2022-07-27 19:46:21', '2022-07-27 19:46:21'),
(118, 'XJIMM9X3ZAWUYXQ', '7BUVR657E85OZLK', '2022-07-27 19:46:21', '2022-07-27 19:46:21'),
(119, 'NZUN74MS3GP8QAV', '2QI692SAQ2FB7T1', '2022-07-27 19:46:43', '2022-07-27 19:46:43'),
(120, 'TMUAZSTV94N429V', '2QI692SAQ2FB7T1', '2022-07-27 19:46:43', '2022-07-27 19:46:43'),
(121, '58B9925CNZVP3IV', '2QI692SAQ2FB7T1', '2022-07-27 19:46:43', '2022-07-27 19:46:43'),
(122, '8R2IU8QPOMXHP6P', '2QI692SAQ2FB7T1', '2022-07-27 19:46:43', '2022-07-27 19:46:43'),
(123, 'OPIYH2SKJGL3TQL', '2QI692SAQ2FB7T1', '2022-07-27 19:46:43', '2022-07-27 19:46:43'),
(124, 'XJIMM9X3ZAWUYXQ', '2QI692SAQ2FB7T1', '2022-07-27 19:46:43', '2022-07-27 19:46:43'),
(125, 'NZUN74MS3GP8QAV', 'THX6CET9AT1Y3SM', '2022-07-27 19:47:00', '2022-07-27 19:47:00'),
(126, 'TMUAZSTV94N429V', 'THX6CET9AT1Y3SM', '2022-07-27 19:47:00', '2022-07-27 19:47:00'),
(127, '58B9925CNZVP3IV', 'THX6CET9AT1Y3SM', '2022-07-27 19:47:00', '2022-07-27 19:47:00'),
(128, '8R2IU8QPOMXHP6P', 'THX6CET9AT1Y3SM', '2022-07-27 19:47:00', '2022-07-27 19:47:00'),
(129, 'OPIYH2SKJGL3TQL', 'THX6CET9AT1Y3SM', '2022-07-27 19:47:00', '2022-07-27 19:47:00'),
(130, 'XJIMM9X3ZAWUYXQ', 'THX6CET9AT1Y3SM', '2022-07-27 19:47:00', '2022-07-27 19:47:00'),
(131, 'NZUN74MS3GP8QAV', 'W1NY5JI8Q5C8EDG', '2022-07-27 19:47:15', '2022-07-27 19:47:15'),
(132, 'TMUAZSTV94N429V', 'W1NY5JI8Q5C8EDG', '2022-07-27 19:47:15', '2022-07-27 19:47:15'),
(133, '58B9925CNZVP3IV', 'W1NY5JI8Q5C8EDG', '2022-07-27 19:47:15', '2022-07-27 19:47:15'),
(134, '8R2IU8QPOMXHP6P', 'W1NY5JI8Q5C8EDG', '2022-07-27 19:47:15', '2022-07-27 19:47:15'),
(135, 'OPIYH2SKJGL3TQL', 'W1NY5JI8Q5C8EDG', '2022-07-27 19:47:15', '2022-07-27 19:47:15'),
(136, 'XJIMM9X3ZAWUYXQ', 'W1NY5JI8Q5C8EDG', '2022-07-27 19:47:15', '2022-07-27 19:47:15'),
(137, 'NZUN74MS3GP8QAV', 'VW2K44QD3RG77OK', '2022-07-27 19:47:43', '2022-07-27 19:47:43'),
(138, 'TMUAZSTV94N429V', 'VW2K44QD3RG77OK', '2022-07-27 19:47:43', '2022-07-27 19:47:43'),
(139, '58B9925CNZVP3IV', 'VW2K44QD3RG77OK', '2022-07-27 19:47:43', '2022-07-27 19:47:43'),
(140, '8R2IU8QPOMXHP6P', 'VW2K44QD3RG77OK', '2022-07-27 19:47:43', '2022-07-27 19:47:43'),
(141, 'OPIYH2SKJGL3TQL', 'VW2K44QD3RG77OK', '2022-07-27 19:47:43', '2022-07-27 19:47:43'),
(142, 'XJIMM9X3ZAWUYXQ', 'VW2K44QD3RG77OK', '2022-07-27 19:47:43', '2022-07-27 19:47:43'),
(143, 'NZUN74MS3GP8QAV', 'UJM6YWFVD7WQRXG', '2022-07-27 19:47:55', '2022-07-27 19:47:55'),
(144, 'TMUAZSTV94N429V', 'UJM6YWFVD7WQRXG', '2022-07-27 19:47:55', '2022-07-27 19:47:55'),
(145, '58B9925CNZVP3IV', 'UJM6YWFVD7WQRXG', '2022-07-27 19:47:55', '2022-07-27 19:47:55'),
(146, '8R2IU8QPOMXHP6P', 'UJM6YWFVD7WQRXG', '2022-07-27 19:47:55', '2022-07-27 19:47:55'),
(147, 'OPIYH2SKJGL3TQL', 'UJM6YWFVD7WQRXG', '2022-07-27 19:47:55', '2022-07-27 19:47:55'),
(148, 'XJIMM9X3ZAWUYXQ', 'UJM6YWFVD7WQRXG', '2022-07-27 19:47:55', '2022-07-27 19:47:55'),
(149, 'NZUN74MS3GP8QAV', 'LG9O5XCAES3QIIR', '2022-07-27 19:48:13', '2022-07-27 19:48:13'),
(150, 'TMUAZSTV94N429V', 'LG9O5XCAES3QIIR', '2022-07-27 19:48:13', '2022-07-27 19:48:13'),
(151, '58B9925CNZVP3IV', 'LG9O5XCAES3QIIR', '2022-07-27 19:48:13', '2022-07-27 19:48:13'),
(152, '8R2IU8QPOMXHP6P', 'LG9O5XCAES3QIIR', '2022-07-27 19:48:13', '2022-07-27 19:48:13'),
(153, 'OPIYH2SKJGL3TQL', 'LG9O5XCAES3QIIR', '2022-07-27 19:48:13', '2022-07-27 19:48:13'),
(154, 'XJIMM9X3ZAWUYXQ', 'LG9O5XCAES3QIIR', '2022-07-27 19:48:13', '2022-07-27 19:48:13'),
(155, 'NZUN74MS3GP8QAV', 'R19AW9SU4PO79AC', '2022-07-27 19:48:28', '2022-07-27 19:48:28'),
(156, 'TMUAZSTV94N429V', 'R19AW9SU4PO79AC', '2022-07-27 19:48:28', '2022-07-27 19:48:28'),
(157, '58B9925CNZVP3IV', 'R19AW9SU4PO79AC', '2022-07-27 19:48:28', '2022-07-27 19:48:28'),
(158, '8R2IU8QPOMXHP6P', 'R19AW9SU4PO79AC', '2022-07-27 19:48:28', '2022-07-27 19:48:28'),
(159, 'OPIYH2SKJGL3TQL', 'R19AW9SU4PO79AC', '2022-07-27 19:48:28', '2022-07-27 19:48:28'),
(160, 'XJIMM9X3ZAWUYXQ', 'R19AW9SU4PO79AC', '2022-07-27 19:48:28', '2022-07-27 19:48:28'),
(161, 'NZUN74MS3GP8QAV', 'CO3C3R11SQKQK1E', '2022-07-27 19:48:43', '2022-07-27 19:48:43'),
(162, 'TMUAZSTV94N429V', 'CO3C3R11SQKQK1E', '2022-07-27 19:48:43', '2022-07-27 19:48:43'),
(163, '58B9925CNZVP3IV', 'CO3C3R11SQKQK1E', '2022-07-27 19:48:43', '2022-07-27 19:48:43'),
(164, '8R2IU8QPOMXHP6P', 'CO3C3R11SQKQK1E', '2022-07-27 19:48:43', '2022-07-27 19:48:43'),
(165, 'OPIYH2SKJGL3TQL', 'CO3C3R11SQKQK1E', '2022-07-27 19:48:43', '2022-07-27 19:48:43'),
(166, 'XJIMM9X3ZAWUYXQ', 'CO3C3R11SQKQK1E', '2022-07-27 19:48:43', '2022-07-27 19:48:43'),
(167, 'NZUN74MS3GP8QAV', '7A1B4D7BX3H1E1A', '2022-07-27 19:48:57', '2022-07-27 19:48:57'),
(168, 'TMUAZSTV94N429V', '7A1B4D7BX3H1E1A', '2022-07-27 19:48:57', '2022-07-27 19:48:57'),
(169, '58B9925CNZVP3IV', '7A1B4D7BX3H1E1A', '2022-07-27 19:48:57', '2022-07-27 19:48:57'),
(170, '8R2IU8QPOMXHP6P', '7A1B4D7BX3H1E1A', '2022-07-27 19:48:57', '2022-07-27 19:48:57'),
(171, 'OPIYH2SKJGL3TQL', '7A1B4D7BX3H1E1A', '2022-07-27 19:48:57', '2022-07-27 19:48:57'),
(172, 'XJIMM9X3ZAWUYXQ', '7A1B4D7BX3H1E1A', '2022-07-27 19:48:57', '2022-07-27 19:48:57'),
(173, 'NZUN74MS3GP8QAV', 'ZWV6D2FL46A9UXW', '2022-07-27 19:49:13', '2022-07-27 19:49:13'),
(174, 'TMUAZSTV94N429V', 'ZWV6D2FL46A9UXW', '2022-07-27 19:49:13', '2022-07-27 19:49:13'),
(175, '58B9925CNZVP3IV', 'ZWV6D2FL46A9UXW', '2022-07-27 19:49:13', '2022-07-27 19:49:13'),
(176, '8R2IU8QPOMXHP6P', 'ZWV6D2FL46A9UXW', '2022-07-27 19:49:13', '2022-07-27 19:49:13'),
(177, 'OPIYH2SKJGL3TQL', 'ZWV6D2FL46A9UXW', '2022-07-27 19:49:13', '2022-07-27 19:49:13'),
(178, 'XJIMM9X3ZAWUYXQ', 'ZWV6D2FL46A9UXW', '2022-07-27 19:49:13', '2022-07-27 19:49:13'),
(179, 'NZUN74MS3GP8QAV', 'LKWZAIP53SGOCRS', '2022-07-27 19:49:29', '2022-07-27 19:49:29'),
(180, 'TMUAZSTV94N429V', 'LKWZAIP53SGOCRS', '2022-07-27 19:49:29', '2022-07-27 19:49:29'),
(181, '58B9925CNZVP3IV', 'LKWZAIP53SGOCRS', '2022-07-27 19:49:29', '2022-07-27 19:49:29'),
(182, '8R2IU8QPOMXHP6P', 'LKWZAIP53SGOCRS', '2022-07-27 19:49:29', '2022-07-27 19:49:29'),
(183, 'OPIYH2SKJGL3TQL', 'LKWZAIP53SGOCRS', '2022-07-27 19:49:29', '2022-07-27 19:49:29'),
(184, 'XJIMM9X3ZAWUYXQ', 'LKWZAIP53SGOCRS', '2022-07-27 19:49:29', '2022-07-27 19:49:29'),
(185, 'NZUN74MS3GP8QAV', 'R5PKW1O3F137BVL', '2022-07-27 19:49:45', '2022-07-27 19:49:45'),
(186, 'TMUAZSTV94N429V', 'R5PKW1O3F137BVL', '2022-07-27 19:49:45', '2022-07-27 19:49:45'),
(187, '58B9925CNZVP3IV', 'R5PKW1O3F137BVL', '2022-07-27 19:49:45', '2022-07-27 19:49:45'),
(188, '8R2IU8QPOMXHP6P', 'R5PKW1O3F137BVL', '2022-07-27 19:49:45', '2022-07-27 19:49:45'),
(189, 'OPIYH2SKJGL3TQL', 'R5PKW1O3F137BVL', '2022-07-27 19:49:45', '2022-07-27 19:49:45'),
(190, 'XJIMM9X3ZAWUYXQ', 'R5PKW1O3F137BVL', '2022-07-27 19:49:45', '2022-07-27 19:49:45'),
(191, 'NZUN74MS3GP8QAV', 'BMBSCUH9N1JT59U', '2022-07-27 19:50:12', '2022-07-27 19:50:12'),
(192, 'TMUAZSTV94N429V', 'BMBSCUH9N1JT59U', '2022-07-27 19:50:12', '2022-07-27 19:50:12'),
(193, '58B9925CNZVP3IV', 'BMBSCUH9N1JT59U', '2022-07-27 19:50:12', '2022-07-27 19:50:12'),
(194, '8R2IU8QPOMXHP6P', 'BMBSCUH9N1JT59U', '2022-07-27 19:50:12', '2022-07-27 19:50:12'),
(195, 'OPIYH2SKJGL3TQL', 'BMBSCUH9N1JT59U', '2022-07-27 19:50:12', '2022-07-27 19:50:12'),
(196, 'XJIMM9X3ZAWUYXQ', 'BMBSCUH9N1JT59U', '2022-07-27 19:50:12', '2022-07-27 19:50:12'),
(197, 'NZUN74MS3GP8QAV', 'DXA6K7Y88WY5K66', '2022-07-27 19:50:40', '2022-07-27 19:50:40'),
(198, 'TMUAZSTV94N429V', 'DXA6K7Y88WY5K66', '2022-07-27 19:50:40', '2022-07-27 19:50:40'),
(199, '58B9925CNZVP3IV', 'DXA6K7Y88WY5K66', '2022-07-27 19:50:40', '2022-07-27 19:50:40'),
(200, '8R2IU8QPOMXHP6P', 'DXA6K7Y88WY5K66', '2022-07-27 19:50:40', '2022-07-27 19:50:40'),
(201, 'OPIYH2SKJGL3TQL', 'DXA6K7Y88WY5K66', '2022-07-27 19:50:40', '2022-07-27 19:50:40'),
(202, 'XJIMM9X3ZAWUYXQ', 'DXA6K7Y88WY5K66', '2022-07-27 19:50:40', '2022-07-27 19:50:40'),
(203, 'NZUN74MS3GP8QAV', '7FLZ9LR35LS72G2', '2022-07-27 19:50:58', '2022-07-27 19:50:58'),
(204, 'TMUAZSTV94N429V', '7FLZ9LR35LS72G2', '2022-07-27 19:50:58', '2022-07-27 19:50:58'),
(205, '58B9925CNZVP3IV', '7FLZ9LR35LS72G2', '2022-07-27 19:50:58', '2022-07-27 19:50:58'),
(206, '8R2IU8QPOMXHP6P', '7FLZ9LR35LS72G2', '2022-07-27 19:50:58', '2022-07-27 19:50:58'),
(207, 'OPIYH2SKJGL3TQL', '7FLZ9LR35LS72G2', '2022-07-27 19:50:58', '2022-07-27 19:50:58'),
(208, 'XJIMM9X3ZAWUYXQ', '7FLZ9LR35LS72G2', '2022-07-27 19:50:58', '2022-07-27 19:50:58'),
(209, 'NZUN74MS3GP8QAV', 'Y3IJKOQ3VNDJR4A', '2022-07-27 19:51:19', '2022-07-27 19:51:19'),
(210, 'TMUAZSTV94N429V', 'Y3IJKOQ3VNDJR4A', '2022-07-27 19:51:19', '2022-07-27 19:51:19'),
(211, '58B9925CNZVP3IV', 'Y3IJKOQ3VNDJR4A', '2022-07-27 19:51:19', '2022-07-27 19:51:19'),
(212, '8R2IU8QPOMXHP6P', 'Y3IJKOQ3VNDJR4A', '2022-07-27 19:51:19', '2022-07-27 19:51:19'),
(213, 'OPIYH2SKJGL3TQL', 'Y3IJKOQ3VNDJR4A', '2022-07-27 19:51:19', '2022-07-27 19:51:19'),
(214, 'XJIMM9X3ZAWUYXQ', 'Y3IJKOQ3VNDJR4A', '2022-07-27 19:51:19', '2022-07-27 19:51:19'),
(215, 'NZUN74MS3GP8QAV', '71ILJFPHGBDECZ6', '2022-07-27 19:51:35', '2022-07-27 19:51:35'),
(216, 'TMUAZSTV94N429V', '71ILJFPHGBDECZ6', '2022-07-27 19:51:35', '2022-07-27 19:51:35'),
(217, '58B9925CNZVP3IV', '71ILJFPHGBDECZ6', '2022-07-27 19:51:35', '2022-07-27 19:51:35'),
(218, '8R2IU8QPOMXHP6P', '71ILJFPHGBDECZ6', '2022-07-27 19:51:35', '2022-07-27 19:51:35'),
(219, 'OPIYH2SKJGL3TQL', '71ILJFPHGBDECZ6', '2022-07-27 19:51:35', '2022-07-27 19:51:35'),
(220, 'XJIMM9X3ZAWUYXQ', '71ILJFPHGBDECZ6', '2022-07-27 19:51:35', '2022-07-27 19:51:35'),
(221, 'NZUN74MS3GP8QAV', 'NQVZDA2LN4IQYPG', '2022-07-27 19:51:55', '2022-07-27 19:51:55'),
(222, 'TMUAZSTV94N429V', 'NQVZDA2LN4IQYPG', '2022-07-27 19:51:55', '2022-07-27 19:51:55'),
(223, '58B9925CNZVP3IV', 'NQVZDA2LN4IQYPG', '2022-07-27 19:51:55', '2022-07-27 19:51:55'),
(224, '8R2IU8QPOMXHP6P', 'NQVZDA2LN4IQYPG', '2022-07-27 19:51:55', '2022-07-27 19:51:55'),
(225, 'OPIYH2SKJGL3TQL', 'NQVZDA2LN4IQYPG', '2022-07-27 19:51:55', '2022-07-27 19:51:55'),
(226, 'XJIMM9X3ZAWUYXQ', 'NQVZDA2LN4IQYPG', '2022-07-27 19:51:55', '2022-07-27 19:51:55'),
(227, 'NZUN74MS3GP8QAV', '5ZCKPS6HKUI1UC3', '2022-07-27 19:52:11', '2022-07-27 19:52:11'),
(228, 'TMUAZSTV94N429V', '5ZCKPS6HKUI1UC3', '2022-07-27 19:52:11', '2022-07-27 19:52:11'),
(229, '58B9925CNZVP3IV', '5ZCKPS6HKUI1UC3', '2022-07-27 19:52:11', '2022-07-27 19:52:11'),
(230, '8R2IU8QPOMXHP6P', '5ZCKPS6HKUI1UC3', '2022-07-27 19:52:11', '2022-07-27 19:52:11'),
(231, 'OPIYH2SKJGL3TQL', '5ZCKPS6HKUI1UC3', '2022-07-27 19:52:11', '2022-07-27 19:52:11'),
(232, 'XJIMM9X3ZAWUYXQ', '5ZCKPS6HKUI1UC3', '2022-07-27 19:52:11', '2022-07-27 19:52:11'),
(233, 'NZUN74MS3GP8QAV', 'YC9C11VJZYJ5SD9', '2022-07-27 19:52:28', '2022-07-27 19:52:28'),
(234, 'TMUAZSTV94N429V', 'YC9C11VJZYJ5SD9', '2022-07-27 19:52:28', '2022-07-27 19:52:28'),
(235, '58B9925CNZVP3IV', 'YC9C11VJZYJ5SD9', '2022-07-27 19:52:28', '2022-07-27 19:52:28'),
(236, '8R2IU8QPOMXHP6P', 'YC9C11VJZYJ5SD9', '2022-07-27 19:52:28', '2022-07-27 19:52:28'),
(237, 'OPIYH2SKJGL3TQL', 'YC9C11VJZYJ5SD9', '2022-07-27 19:52:28', '2022-07-27 19:52:28'),
(238, 'XJIMM9X3ZAWUYXQ', 'YC9C11VJZYJ5SD9', '2022-07-27 19:52:28', '2022-07-27 19:52:28'),
(239, 'NZUN74MS3GP8QAV', '2T1JKX1V3927AN6', '2022-07-27 19:52:45', '2022-07-27 19:52:45'),
(240, 'TMUAZSTV94N429V', '2T1JKX1V3927AN6', '2022-07-27 19:52:45', '2022-07-27 19:52:45'),
(241, '58B9925CNZVP3IV', '2T1JKX1V3927AN6', '2022-07-27 19:52:45', '2022-07-27 19:52:45'),
(242, '8R2IU8QPOMXHP6P', '2T1JKX1V3927AN6', '2022-07-27 19:52:45', '2022-07-27 19:52:45'),
(243, 'OPIYH2SKJGL3TQL', '2T1JKX1V3927AN6', '2022-07-27 19:52:45', '2022-07-27 19:52:45'),
(244, 'XJIMM9X3ZAWUYXQ', '2T1JKX1V3927AN6', '2022-07-27 19:52:45', '2022-07-27 19:52:45'),
(245, 'NZUN74MS3GP8QAV', '8MHMUW7KXAI5L5N', '2022-07-27 19:53:00', '2022-07-27 19:53:00'),
(246, 'TMUAZSTV94N429V', '8MHMUW7KXAI5L5N', '2022-07-27 19:53:00', '2022-07-27 19:53:00'),
(247, '58B9925CNZVP3IV', '8MHMUW7KXAI5L5N', '2022-07-27 19:53:00', '2022-07-27 19:53:00'),
(248, '8R2IU8QPOMXHP6P', '8MHMUW7KXAI5L5N', '2022-07-27 19:53:00', '2022-07-27 19:53:00'),
(249, 'OPIYH2SKJGL3TQL', '8MHMUW7KXAI5L5N', '2022-07-27 19:53:00', '2022-07-27 19:53:00'),
(250, 'XJIMM9X3ZAWUYXQ', '8MHMUW7KXAI5L5N', '2022-07-27 19:53:00', '2022-07-27 19:53:00'),
(251, 'NZUN74MS3GP8QAV', '3FL592L554HHDFE', '2022-07-27 19:53:13', '2022-07-27 19:53:13'),
(252, 'TMUAZSTV94N429V', '3FL592L554HHDFE', '2022-07-27 19:53:13', '2022-07-27 19:53:13'),
(253, '58B9925CNZVP3IV', '3FL592L554HHDFE', '2022-07-27 19:53:13', '2022-07-27 19:53:13'),
(254, '8R2IU8QPOMXHP6P', '3FL592L554HHDFE', '2022-07-27 19:53:13', '2022-07-27 19:53:13'),
(255, 'OPIYH2SKJGL3TQL', '3FL592L554HHDFE', '2022-07-27 19:53:13', '2022-07-27 19:53:13'),
(256, 'XJIMM9X3ZAWUYXQ', '3FL592L554HHDFE', '2022-07-27 19:53:13', '2022-07-27 19:53:13'),
(257, 'NZUN74MS3GP8QAV', 'K4IV6Y1C5EN1M6B', '2022-07-27 19:53:27', '2022-07-27 19:53:27'),
(258, 'TMUAZSTV94N429V', 'K4IV6Y1C5EN1M6B', '2022-07-27 19:53:27', '2022-07-27 19:53:27'),
(259, '58B9925CNZVP3IV', 'K4IV6Y1C5EN1M6B', '2022-07-27 19:53:27', '2022-07-27 19:53:27'),
(260, '8R2IU8QPOMXHP6P', 'K4IV6Y1C5EN1M6B', '2022-07-27 19:53:27', '2022-07-27 19:53:27'),
(261, 'OPIYH2SKJGL3TQL', 'K4IV6Y1C5EN1M6B', '2022-07-27 19:53:27', '2022-07-27 19:53:27'),
(262, 'XJIMM9X3ZAWUYXQ', 'K4IV6Y1C5EN1M6B', '2022-07-27 19:53:27', '2022-07-27 19:53:27'),
(263, 'NZUN74MS3GP8QAV', 'M1WG1QFPD2PABHT', '2022-07-27 19:53:41', '2022-07-27 19:53:41'),
(264, 'TMUAZSTV94N429V', 'M1WG1QFPD2PABHT', '2022-07-27 19:53:41', '2022-07-27 19:53:41'),
(265, '58B9925CNZVP3IV', 'M1WG1QFPD2PABHT', '2022-07-27 19:53:41', '2022-07-27 19:53:41'),
(266, '8R2IU8QPOMXHP6P', 'M1WG1QFPD2PABHT', '2022-07-27 19:53:41', '2022-07-27 19:53:41'),
(267, 'OPIYH2SKJGL3TQL', 'M1WG1QFPD2PABHT', '2022-07-27 19:53:41', '2022-07-27 19:53:41'),
(268, 'XJIMM9X3ZAWUYXQ', 'M1WG1QFPD2PABHT', '2022-07-27 19:53:41', '2022-07-27 19:53:41'),
(269, 'NZUN74MS3GP8QAV', 'ORPP6GMTEMI15O9', '2022-07-27 19:53:57', '2022-07-27 19:53:57'),
(270, 'TMUAZSTV94N429V', 'ORPP6GMTEMI15O9', '2022-07-27 19:53:57', '2022-07-27 19:53:57'),
(271, '58B9925CNZVP3IV', 'ORPP6GMTEMI15O9', '2022-07-27 19:53:57', '2022-07-27 19:53:57'),
(272, '8R2IU8QPOMXHP6P', 'ORPP6GMTEMI15O9', '2022-07-27 19:53:57', '2022-07-27 19:53:57'),
(273, 'OPIYH2SKJGL3TQL', 'ORPP6GMTEMI15O9', '2022-07-27 19:53:57', '2022-07-27 19:53:57'),
(274, 'XJIMM9X3ZAWUYXQ', 'ORPP6GMTEMI15O9', '2022-07-27 19:53:57', '2022-07-27 19:53:57'),
(275, 'NZUN74MS3GP8QAV', '6MMJQNYZDVUTC47', '2022-07-27 19:56:34', '2022-07-27 19:56:34'),
(276, 'TMUAZSTV94N429V', '6MMJQNYZDVUTC47', '2022-07-27 19:56:34', '2022-07-27 19:56:34'),
(277, '58B9925CNZVP3IV', '6MMJQNYZDVUTC47', '2022-07-27 19:56:34', '2022-07-27 19:56:34'),
(278, '8R2IU8QPOMXHP6P', '6MMJQNYZDVUTC47', '2022-07-27 19:56:34', '2022-07-27 19:56:34'),
(279, 'OPIYH2SKJGL3TQL', '6MMJQNYZDVUTC47', '2022-07-27 19:56:34', '2022-07-27 19:56:34'),
(280, 'XJIMM9X3ZAWUYXQ', '6MMJQNYZDVUTC47', '2022-07-27 19:56:34', '2022-07-27 19:56:34'),
(281, 'NZUN74MS3GP8QAV', 'GVG2XQ1DUWWWK9H', '2022-07-27 19:56:51', '2022-07-27 19:56:51'),
(282, 'TMUAZSTV94N429V', 'GVG2XQ1DUWWWK9H', '2022-07-27 19:56:51', '2022-07-27 19:56:51'),
(283, '58B9925CNZVP3IV', 'GVG2XQ1DUWWWK9H', '2022-07-27 19:56:51', '2022-07-27 19:56:51'),
(284, '8R2IU8QPOMXHP6P', 'GVG2XQ1DUWWWK9H', '2022-07-27 19:56:51', '2022-07-27 19:56:51'),
(285, 'OPIYH2SKJGL3TQL', 'GVG2XQ1DUWWWK9H', '2022-07-27 19:56:51', '2022-07-27 19:56:51'),
(286, 'XJIMM9X3ZAWUYXQ', 'GVG2XQ1DUWWWK9H', '2022-07-27 19:56:51', '2022-07-27 19:56:51'),
(287, 'NZUN74MS3GP8QAV', '1MUU3U9HAMEKK7O', '2022-07-27 19:57:10', '2022-07-27 19:57:10'),
(288, 'TMUAZSTV94N429V', '1MUU3U9HAMEKK7O', '2022-07-27 19:57:10', '2022-07-27 19:57:10'),
(289, '58B9925CNZVP3IV', '1MUU3U9HAMEKK7O', '2022-07-27 19:57:10', '2022-07-27 19:57:10'),
(290, '8R2IU8QPOMXHP6P', '1MUU3U9HAMEKK7O', '2022-07-27 19:57:10', '2022-07-27 19:57:10'),
(291, 'OPIYH2SKJGL3TQL', '1MUU3U9HAMEKK7O', '2022-07-27 19:57:10', '2022-07-27 19:57:10'),
(292, 'XJIMM9X3ZAWUYXQ', '1MUU3U9HAMEKK7O', '2022-07-27 19:57:10', '2022-07-27 19:57:10'),
(293, 'NZUN74MS3GP8QAV', 'KGQVW81G4CA2ZQO', '2022-07-27 19:57:27', '2022-07-27 19:57:27'),
(294, 'TMUAZSTV94N429V', 'KGQVW81G4CA2ZQO', '2022-07-27 19:57:27', '2022-07-27 19:57:27'),
(295, '58B9925CNZVP3IV', 'KGQVW81G4CA2ZQO', '2022-07-27 19:57:27', '2022-07-27 19:57:27'),
(296, '8R2IU8QPOMXHP6P', 'KGQVW81G4CA2ZQO', '2022-07-27 19:57:27', '2022-07-27 19:57:27'),
(297, 'OPIYH2SKJGL3TQL', 'KGQVW81G4CA2ZQO', '2022-07-27 19:57:27', '2022-07-27 19:57:27'),
(298, 'XJIMM9X3ZAWUYXQ', 'KGQVW81G4CA2ZQO', '2022-07-27 19:57:27', '2022-07-27 19:57:27'),
(299, 'NZUN74MS3GP8QAV', 'L3JMAQMU63XKQZE', '2022-07-27 19:57:49', '2022-07-27 19:57:49'),
(300, 'TMUAZSTV94N429V', 'L3JMAQMU63XKQZE', '2022-07-27 19:57:49', '2022-07-27 19:57:49'),
(301, '58B9925CNZVP3IV', 'L3JMAQMU63XKQZE', '2022-07-27 19:57:49', '2022-07-27 19:57:49'),
(302, '8R2IU8QPOMXHP6P', 'L3JMAQMU63XKQZE', '2022-07-27 19:57:49', '2022-07-27 19:57:49'),
(303, 'OPIYH2SKJGL3TQL', 'L3JMAQMU63XKQZE', '2022-07-27 19:57:49', '2022-07-27 19:57:49'),
(304, 'XJIMM9X3ZAWUYXQ', 'L3JMAQMU63XKQZE', '2022-07-27 19:57:49', '2022-07-27 19:57:49'),
(305, 'NZUN74MS3GP8QAV', 'RZBZRWTGIGAF834', '2022-07-27 19:58:08', '2022-07-27 19:58:08'),
(306, 'TMUAZSTV94N429V', 'RZBZRWTGIGAF834', '2022-07-27 19:58:08', '2022-07-27 19:58:08'),
(307, '58B9925CNZVP3IV', 'RZBZRWTGIGAF834', '2022-07-27 19:58:08', '2022-07-27 19:58:08'),
(308, '8R2IU8QPOMXHP6P', 'RZBZRWTGIGAF834', '2022-07-27 19:58:08', '2022-07-27 19:58:08'),
(309, 'OPIYH2SKJGL3TQL', 'RZBZRWTGIGAF834', '2022-07-27 19:58:08', '2022-07-27 19:58:08'),
(310, 'XJIMM9X3ZAWUYXQ', 'RZBZRWTGIGAF834', '2022-07-27 19:58:08', '2022-07-27 19:58:08'),
(311, 'NZUN74MS3GP8QAV', 'QMZOCFQDCWULM7G', '2022-07-27 19:58:24', '2022-07-27 19:58:24'),
(312, 'TMUAZSTV94N429V', 'QMZOCFQDCWULM7G', '2022-07-27 19:58:24', '2022-07-27 19:58:24'),
(313, '58B9925CNZVP3IV', 'QMZOCFQDCWULM7G', '2022-07-27 19:58:24', '2022-07-27 19:58:24'),
(314, '8R2IU8QPOMXHP6P', 'QMZOCFQDCWULM7G', '2022-07-27 19:58:24', '2022-07-27 19:58:24'),
(315, 'OPIYH2SKJGL3TQL', 'QMZOCFQDCWULM7G', '2022-07-27 19:58:24', '2022-07-27 19:58:24'),
(316, 'XJIMM9X3ZAWUYXQ', 'QMZOCFQDCWULM7G', '2022-07-27 19:58:24', '2022-07-27 19:58:24'),
(317, 'NZUN74MS3GP8QAV', 'YP6HFUWW7GWXA2V', '2022-07-27 19:58:37', '2022-07-27 19:58:37'),
(318, 'TMUAZSTV94N429V', 'YP6HFUWW7GWXA2V', '2022-07-27 19:58:37', '2022-07-27 19:58:37'),
(319, '58B9925CNZVP3IV', 'YP6HFUWW7GWXA2V', '2022-07-27 19:58:37', '2022-07-27 19:58:37'),
(320, '8R2IU8QPOMXHP6P', 'YP6HFUWW7GWXA2V', '2022-07-27 19:58:37', '2022-07-27 19:58:37'),
(321, 'OPIYH2SKJGL3TQL', 'YP6HFUWW7GWXA2V', '2022-07-27 19:58:37', '2022-07-27 19:58:37'),
(322, 'XJIMM9X3ZAWUYXQ', 'YP6HFUWW7GWXA2V', '2022-07-27 19:58:37', '2022-07-27 19:58:37'),
(323, 'NZUN74MS3GP8QAV', 'YE2QD18I7LZACQV', '2022-07-27 19:58:51', '2022-07-27 19:58:51'),
(324, 'TMUAZSTV94N429V', 'YE2QD18I7LZACQV', '2022-07-27 19:58:51', '2022-07-27 19:58:51'),
(325, '58B9925CNZVP3IV', 'YE2QD18I7LZACQV', '2022-07-27 19:58:51', '2022-07-27 19:58:51'),
(326, '8R2IU8QPOMXHP6P', 'YE2QD18I7LZACQV', '2022-07-27 19:58:51', '2022-07-27 19:58:51'),
(327, 'OPIYH2SKJGL3TQL', 'YE2QD18I7LZACQV', '2022-07-27 19:58:51', '2022-07-27 19:58:51'),
(328, 'XJIMM9X3ZAWUYXQ', 'YE2QD18I7LZACQV', '2022-07-27 19:58:51', '2022-07-27 19:58:51'),
(329, 'NZUN74MS3GP8QAV', 'GDB3WGFW82AJIK9', '2022-07-27 19:59:15', '2022-07-27 19:59:15'),
(330, 'TMUAZSTV94N429V', 'GDB3WGFW82AJIK9', '2022-07-27 19:59:15', '2022-07-27 19:59:15'),
(331, '58B9925CNZVP3IV', 'GDB3WGFW82AJIK9', '2022-07-27 19:59:15', '2022-07-27 19:59:15'),
(332, '8R2IU8QPOMXHP6P', 'GDB3WGFW82AJIK9', '2022-07-27 19:59:15', '2022-07-27 19:59:15'),
(333, 'OPIYH2SKJGL3TQL', 'GDB3WGFW82AJIK9', '2022-07-27 19:59:15', '2022-07-27 19:59:15'),
(334, 'XJIMM9X3ZAWUYXQ', 'GDB3WGFW82AJIK9', '2022-07-27 19:59:15', '2022-07-27 19:59:15'),
(335, 'NZUN74MS3GP8QAV', 'XLDHG89VE1U4XRU', '2022-07-27 19:59:34', '2022-07-27 19:59:34'),
(336, 'TMUAZSTV94N429V', 'XLDHG89VE1U4XRU', '2022-07-27 19:59:34', '2022-07-27 19:59:34'),
(337, '58B9925CNZVP3IV', 'XLDHG89VE1U4XRU', '2022-07-27 19:59:34', '2022-07-27 19:59:34'),
(338, '8R2IU8QPOMXHP6P', 'XLDHG89VE1U4XRU', '2022-07-27 19:59:34', '2022-07-27 19:59:34'),
(339, 'OPIYH2SKJGL3TQL', 'XLDHG89VE1U4XRU', '2022-07-27 19:59:34', '2022-07-27 19:59:34'),
(340, 'XJIMM9X3ZAWUYXQ', 'XLDHG89VE1U4XRU', '2022-07-27 19:59:34', '2022-07-27 19:59:34'),
(341, 'NZUN74MS3GP8QAV', '14H88UQ36U6QQGA', '2022-07-27 19:59:47', '2022-07-27 19:59:47'),
(342, 'TMUAZSTV94N429V', '14H88UQ36U6QQGA', '2022-07-27 19:59:47', '2022-07-27 19:59:47'),
(343, '58B9925CNZVP3IV', '14H88UQ36U6QQGA', '2022-07-27 19:59:47', '2022-07-27 19:59:47'),
(344, '8R2IU8QPOMXHP6P', '14H88UQ36U6QQGA', '2022-07-27 19:59:47', '2022-07-27 19:59:47'),
(345, 'OPIYH2SKJGL3TQL', '14H88UQ36U6QQGA', '2022-07-27 19:59:47', '2022-07-27 19:59:47'),
(346, 'XJIMM9X3ZAWUYXQ', '14H88UQ36U6QQGA', '2022-07-27 19:59:47', '2022-07-27 19:59:47'),
(347, 'NZUN74MS3GP8QAV', 'R9UN97L3EOU39C3', '2022-07-27 20:00:05', '2022-07-27 20:00:05'),
(348, 'TMUAZSTV94N429V', 'R9UN97L3EOU39C3', '2022-07-27 20:00:05', '2022-07-27 20:00:05'),
(349, '58B9925CNZVP3IV', 'R9UN97L3EOU39C3', '2022-07-27 20:00:05', '2022-07-27 20:00:05'),
(350, '8R2IU8QPOMXHP6P', 'R9UN97L3EOU39C3', '2022-07-27 20:00:05', '2022-07-27 20:00:05'),
(351, 'OPIYH2SKJGL3TQL', 'R9UN97L3EOU39C3', '2022-07-27 20:00:05', '2022-07-27 20:00:05'),
(352, 'XJIMM9X3ZAWUYXQ', 'R9UN97L3EOU39C3', '2022-07-27 20:00:05', '2022-07-27 20:00:05'),
(353, 'NZUN74MS3GP8QAV', '5B8P8OGQMXOV4JJ', '2022-07-27 20:00:20', '2022-07-27 20:00:20'),
(354, 'TMUAZSTV94N429V', '5B8P8OGQMXOV4JJ', '2022-07-27 20:00:20', '2022-07-27 20:00:20'),
(355, '58B9925CNZVP3IV', '5B8P8OGQMXOV4JJ', '2022-07-27 20:00:20', '2022-07-27 20:00:20'),
(356, '8R2IU8QPOMXHP6P', '5B8P8OGQMXOV4JJ', '2022-07-27 20:00:20', '2022-07-27 20:00:20'),
(357, 'OPIYH2SKJGL3TQL', '5B8P8OGQMXOV4JJ', '2022-07-27 20:00:20', '2022-07-27 20:00:20'),
(358, 'XJIMM9X3ZAWUYXQ', '5B8P8OGQMXOV4JJ', '2022-07-27 20:00:20', '2022-07-27 20:00:20'),
(359, 'NZUN74MS3GP8QAV', '6TE3IT1MKFQCMFC', '2022-07-27 20:00:38', '2022-07-27 20:00:38'),
(360, 'TMUAZSTV94N429V', '6TE3IT1MKFQCMFC', '2022-07-27 20:00:38', '2022-07-27 20:00:38'),
(361, '58B9925CNZVP3IV', '6TE3IT1MKFQCMFC', '2022-07-27 20:00:38', '2022-07-27 20:00:38'),
(362, '8R2IU8QPOMXHP6P', '6TE3IT1MKFQCMFC', '2022-07-27 20:00:38', '2022-07-27 20:00:38'),
(363, 'OPIYH2SKJGL3TQL', '6TE3IT1MKFQCMFC', '2022-07-27 20:00:38', '2022-07-27 20:00:38'),
(364, 'XJIMM9X3ZAWUYXQ', '6TE3IT1MKFQCMFC', '2022-07-27 20:00:38', '2022-07-27 20:00:38'),
(365, 'NZUN74MS3GP8QAV', '8HFWBCFC1P5BC35', '2022-07-27 20:00:51', '2022-07-27 20:00:51'),
(366, 'TMUAZSTV94N429V', '8HFWBCFC1P5BC35', '2022-07-27 20:00:51', '2022-07-27 20:00:51'),
(367, '58B9925CNZVP3IV', '8HFWBCFC1P5BC35', '2022-07-27 20:00:51', '2022-07-27 20:00:51'),
(368, '8R2IU8QPOMXHP6P', '8HFWBCFC1P5BC35', '2022-07-27 20:00:51', '2022-07-27 20:00:51'),
(369, 'OPIYH2SKJGL3TQL', '8HFWBCFC1P5BC35', '2022-07-27 20:00:51', '2022-07-27 20:00:51'),
(370, 'XJIMM9X3ZAWUYXQ', '8HFWBCFC1P5BC35', '2022-07-27 20:00:51', '2022-07-27 20:00:51'),
(371, 'NZUN74MS3GP8QAV', 'MYTL3M9C2VCK2K5', '2022-07-27 20:02:36', '2022-07-27 20:02:36'),
(372, 'TMUAZSTV94N429V', 'MYTL3M9C2VCK2K5', '2022-07-27 20:02:36', '2022-07-27 20:02:36'),
(373, '58B9925CNZVP3IV', 'MYTL3M9C2VCK2K5', '2022-07-27 20:02:36', '2022-07-27 20:02:36'),
(374, '8R2IU8QPOMXHP6P', 'MYTL3M9C2VCK2K5', '2022-07-27 20:02:36', '2022-07-27 20:02:36'),
(375, 'OPIYH2SKJGL3TQL', 'MYTL3M9C2VCK2K5', '2022-07-27 20:02:36', '2022-07-27 20:02:36'),
(376, 'XJIMM9X3ZAWUYXQ', 'MYTL3M9C2VCK2K5', '2022-07-27 20:02:36', '2022-07-27 20:02:36'),
(377, 'NZUN74MS3GP8QAV', 'U2QU8TW9JL41IXC', '2022-07-27 20:02:51', '2022-07-27 20:02:51'),
(378, 'TMUAZSTV94N429V', 'U2QU8TW9JL41IXC', '2022-07-27 20:02:51', '2022-07-27 20:02:51'),
(379, '58B9925CNZVP3IV', 'U2QU8TW9JL41IXC', '2022-07-27 20:02:51', '2022-07-27 20:02:51'),
(380, '8R2IU8QPOMXHP6P', 'U2QU8TW9JL41IXC', '2022-07-27 20:02:51', '2022-07-27 20:02:51'),
(381, 'OPIYH2SKJGL3TQL', 'U2QU8TW9JL41IXC', '2022-07-27 20:02:51', '2022-07-27 20:02:51'),
(382, 'XJIMM9X3ZAWUYXQ', 'U2QU8TW9JL41IXC', '2022-07-27 20:02:51', '2022-07-27 20:02:51'),
(383, 'NZUN74MS3GP8QAV', '3XFGFG45G7V9H6R', '2022-07-27 20:03:06', '2022-07-27 20:03:06'),
(384, 'TMUAZSTV94N429V', '3XFGFG45G7V9H6R', '2022-07-27 20:03:06', '2022-07-27 20:03:06'),
(385, '58B9925CNZVP3IV', '3XFGFG45G7V9H6R', '2022-07-27 20:03:06', '2022-07-27 20:03:06'),
(386, '8R2IU8QPOMXHP6P', '3XFGFG45G7V9H6R', '2022-07-27 20:03:06', '2022-07-27 20:03:06'),
(387, 'OPIYH2SKJGL3TQL', '3XFGFG45G7V9H6R', '2022-07-27 20:03:06', '2022-07-27 20:03:06'),
(388, 'XJIMM9X3ZAWUYXQ', '3XFGFG45G7V9H6R', '2022-07-27 20:03:06', '2022-07-27 20:03:06'),
(389, 'NZUN74MS3GP8QAV', '9EIEMR545U4Y18J', '2022-07-27 20:03:19', '2022-07-27 20:03:19'),
(390, 'TMUAZSTV94N429V', '9EIEMR545U4Y18J', '2022-07-27 20:03:19', '2022-07-27 20:03:19'),
(391, '58B9925CNZVP3IV', '9EIEMR545U4Y18J', '2022-07-27 20:03:19', '2022-07-27 20:03:19'),
(392, '8R2IU8QPOMXHP6P', '9EIEMR545U4Y18J', '2022-07-27 20:03:19', '2022-07-27 20:03:19'),
(393, 'OPIYH2SKJGL3TQL', '9EIEMR545U4Y18J', '2022-07-27 20:03:19', '2022-07-27 20:03:19'),
(394, 'XJIMM9X3ZAWUYXQ', '9EIEMR545U4Y18J', '2022-07-27 20:03:19', '2022-07-27 20:03:19'),
(395, 'NZUN74MS3GP8QAV', 'X2ML66HIH95VCIR', '2022-07-27 20:03:35', '2022-07-27 20:03:35'),
(396, 'TMUAZSTV94N429V', 'X2ML66HIH95VCIR', '2022-07-27 20:03:35', '2022-07-27 20:03:35'),
(397, '58B9925CNZVP3IV', 'X2ML66HIH95VCIR', '2022-07-27 20:03:35', '2022-07-27 20:03:35'),
(398, '8R2IU8QPOMXHP6P', 'X2ML66HIH95VCIR', '2022-07-27 20:03:35', '2022-07-27 20:03:35'),
(399, 'OPIYH2SKJGL3TQL', 'X2ML66HIH95VCIR', '2022-07-27 20:03:35', '2022-07-27 20:03:35'),
(400, 'XJIMM9X3ZAWUYXQ', 'X2ML66HIH95VCIR', '2022-07-27 20:03:35', '2022-07-27 20:03:35'),
(401, 'NZUN74MS3GP8QAV', '2JTSO7QE1UKM53L', '2022-07-27 20:05:29', '2022-07-27 20:05:29'),
(402, 'TMUAZSTV94N429V', '2JTSO7QE1UKM53L', '2022-07-27 20:05:29', '2022-07-27 20:05:29'),
(403, '58B9925CNZVP3IV', '2JTSO7QE1UKM53L', '2022-07-27 20:05:29', '2022-07-27 20:05:29'),
(404, '8R2IU8QPOMXHP6P', '2JTSO7QE1UKM53L', '2022-07-27 20:05:29', '2022-07-27 20:05:29'),
(405, 'OPIYH2SKJGL3TQL', '2JTSO7QE1UKM53L', '2022-07-27 20:05:29', '2022-07-27 20:05:29'),
(406, 'XJIMM9X3ZAWUYXQ', '2JTSO7QE1UKM53L', '2022-07-27 20:05:29', '2022-07-27 20:05:29'),
(407, 'NZUN74MS3GP8QAV', 'BLVV2OZN8DVUEHF', '2022-07-27 20:05:49', '2022-07-27 20:05:49'),
(408, 'TMUAZSTV94N429V', 'BLVV2OZN8DVUEHF', '2022-07-27 20:05:49', '2022-07-27 20:05:49'),
(409, '58B9925CNZVP3IV', 'BLVV2OZN8DVUEHF', '2022-07-27 20:05:49', '2022-07-27 20:05:49'),
(410, '8R2IU8QPOMXHP6P', 'BLVV2OZN8DVUEHF', '2022-07-27 20:05:49', '2022-07-27 20:05:49'),
(411, 'OPIYH2SKJGL3TQL', 'BLVV2OZN8DVUEHF', '2022-07-27 20:05:49', '2022-07-27 20:05:49'),
(412, 'XJIMM9X3ZAWUYXQ', 'BLVV2OZN8DVUEHF', '2022-07-27 20:05:49', '2022-07-27 20:05:49'),
(413, 'NZUN74MS3GP8QAV', 'W2VJ2BFS13IQBR2', '2022-07-27 20:06:06', '2022-07-27 20:06:06'),
(414, 'TMUAZSTV94N429V', 'W2VJ2BFS13IQBR2', '2022-07-27 20:06:06', '2022-07-27 20:06:06'),
(415, '58B9925CNZVP3IV', 'W2VJ2BFS13IQBR2', '2022-07-27 20:06:06', '2022-07-27 20:06:06'),
(416, '8R2IU8QPOMXHP6P', 'W2VJ2BFS13IQBR2', '2022-07-27 20:06:06', '2022-07-27 20:06:06'),
(417, 'OPIYH2SKJGL3TQL', 'W2VJ2BFS13IQBR2', '2022-07-27 20:06:06', '2022-07-27 20:06:06'),
(418, 'XJIMM9X3ZAWUYXQ', 'W2VJ2BFS13IQBR2', '2022-07-27 20:06:06', '2022-07-27 20:06:06'),
(419, 'NZUN74MS3GP8QAV', 'GC6IANKCP5DQGFI', '2022-07-27 20:06:55', '2022-07-27 20:06:55'),
(420, 'TMUAZSTV94N429V', 'GC6IANKCP5DQGFI', '2022-07-27 20:06:55', '2022-07-27 20:06:55'),
(421, '58B9925CNZVP3IV', 'GC6IANKCP5DQGFI', '2022-07-27 20:06:55', '2022-07-27 20:06:55'),
(422, '8R2IU8QPOMXHP6P', 'GC6IANKCP5DQGFI', '2022-07-27 20:06:55', '2022-07-27 20:06:55'),
(423, 'OPIYH2SKJGL3TQL', 'GC6IANKCP5DQGFI', '2022-07-27 20:06:55', '2022-07-27 20:06:55'),
(424, 'XJIMM9X3ZAWUYXQ', 'GC6IANKCP5DQGFI', '2022-07-27 20:06:55', '2022-07-27 20:06:55'),
(425, 'NZUN74MS3GP8QAV', '2IGPXDEVLIYN5IG', '2022-07-27 20:07:09', '2022-07-27 20:07:09'),
(426, 'TMUAZSTV94N429V', '2IGPXDEVLIYN5IG', '2022-07-27 20:07:09', '2022-07-27 20:07:09'),
(427, '58B9925CNZVP3IV', '2IGPXDEVLIYN5IG', '2022-07-27 20:07:09', '2022-07-27 20:07:09'),
(428, '8R2IU8QPOMXHP6P', '2IGPXDEVLIYN5IG', '2022-07-27 20:07:09', '2022-07-27 20:07:09'),
(429, 'OPIYH2SKJGL3TQL', '2IGPXDEVLIYN5IG', '2022-07-27 20:07:09', '2022-07-27 20:07:09'),
(430, 'XJIMM9X3ZAWUYXQ', '2IGPXDEVLIYN5IG', '2022-07-27 20:07:09', '2022-07-27 20:07:09'),
(431, 'NZUN74MS3GP8QAV', '262CUVGQWKHYTCS', '2022-07-27 20:07:21', '2022-07-27 20:07:21'),
(432, 'TMUAZSTV94N429V', '262CUVGQWKHYTCS', '2022-07-27 20:07:21', '2022-07-27 20:07:21'),
(433, '58B9925CNZVP3IV', '262CUVGQWKHYTCS', '2022-07-27 20:07:21', '2022-07-27 20:07:21'),
(434, '8R2IU8QPOMXHP6P', '262CUVGQWKHYTCS', '2022-07-27 20:07:21', '2022-07-27 20:07:21'),
(435, 'OPIYH2SKJGL3TQL', '262CUVGQWKHYTCS', '2022-07-27 20:07:21', '2022-07-27 20:07:21'),
(436, 'XJIMM9X3ZAWUYXQ', '262CUVGQWKHYTCS', '2022-07-27 20:07:21', '2022-07-27 20:07:21'),
(439, 'NZUN74MS3GP8QAV', 'MWFFG5H3NNCZ47F', '2022-07-27 20:07:50', '2022-07-27 20:07:50'),
(440, 'TMUAZSTV94N429V', 'MWFFG5H3NNCZ47F', '2022-07-27 20:07:50', '2022-07-27 20:07:50'),
(441, '58B9925CNZVP3IV', 'MWFFG5H3NNCZ47F', '2022-07-27 20:07:50', '2022-07-27 20:07:50'),
(442, '8R2IU8QPOMXHP6P', 'MWFFG5H3NNCZ47F', '2022-07-27 20:07:50', '2022-07-27 20:07:50'),
(443, 'OPIYH2SKJGL3TQL', 'MWFFG5H3NNCZ47F', '2022-07-27 20:07:50', '2022-07-27 20:07:50'),
(444, 'XJIMM9X3ZAWUYXQ', 'MWFFG5H3NNCZ47F', '2022-07-27 20:07:50', '2022-07-27 20:07:50'),
(445, 'NZUN74MS3GP8QAV', 'WP5PYQRECQ2X86Y', '2022-07-27 20:08:09', '2022-07-27 20:08:09'),
(446, 'TMUAZSTV94N429V', 'WP5PYQRECQ2X86Y', '2022-07-27 20:08:09', '2022-07-27 20:08:09'),
(447, '58B9925CNZVP3IV', 'WP5PYQRECQ2X86Y', '2022-07-27 20:08:09', '2022-07-27 20:08:09'),
(448, '8R2IU8QPOMXHP6P', 'WP5PYQRECQ2X86Y', '2022-07-27 20:08:09', '2022-07-27 20:08:09'),
(449, 'OPIYH2SKJGL3TQL', 'WP5PYQRECQ2X86Y', '2022-07-27 20:08:09', '2022-07-27 20:08:09'),
(450, 'XJIMM9X3ZAWUYXQ', 'WP5PYQRECQ2X86Y', '2022-07-27 20:08:09', '2022-07-27 20:08:09'),
(451, 'NZUN74MS3GP8QAV', '8DC53PZ9CUAMKGI', '2022-07-27 20:08:24', '2022-07-27 20:08:24'),
(452, 'TMUAZSTV94N429V', '8DC53PZ9CUAMKGI', '2022-07-27 20:08:24', '2022-07-27 20:08:24'),
(453, '58B9925CNZVP3IV', '8DC53PZ9CUAMKGI', '2022-07-27 20:08:24', '2022-07-27 20:08:24'),
(454, '8R2IU8QPOMXHP6P', '8DC53PZ9CUAMKGI', '2022-07-27 20:08:24', '2022-07-27 20:08:24'),
(455, 'OPIYH2SKJGL3TQL', '8DC53PZ9CUAMKGI', '2022-07-27 20:08:24', '2022-07-27 20:08:24'),
(456, 'XJIMM9X3ZAWUYXQ', '8DC53PZ9CUAMKGI', '2022-07-27 20:08:24', '2022-07-27 20:08:24'),
(457, 'NZUN74MS3GP8QAV', 'TQ6NP8H25WF9U6E', '2022-07-27 20:08:37', '2022-07-27 20:08:37'),
(458, 'TMUAZSTV94N429V', 'TQ6NP8H25WF9U6E', '2022-07-27 20:08:37', '2022-07-27 20:08:37'),
(459, '58B9925CNZVP3IV', 'TQ6NP8H25WF9U6E', '2022-07-27 20:08:37', '2022-07-27 20:08:37'),
(460, '8R2IU8QPOMXHP6P', 'TQ6NP8H25WF9U6E', '2022-07-27 20:08:37', '2022-07-27 20:08:37'),
(461, 'OPIYH2SKJGL3TQL', 'TQ6NP8H25WF9U6E', '2022-07-27 20:08:37', '2022-07-27 20:08:37'),
(462, 'XJIMM9X3ZAWUYXQ', 'TQ6NP8H25WF9U6E', '2022-07-27 20:08:37', '2022-07-27 20:08:37'),
(463, 'NZUN74MS3GP8QAV', 'FUJK4K9JNM48YNA', '2022-07-27 20:09:55', '2022-07-27 20:09:55'),
(464, 'TMUAZSTV94N429V', 'FUJK4K9JNM48YNA', '2022-07-27 20:09:55', '2022-07-27 20:09:55'),
(465, '58B9925CNZVP3IV', 'FUJK4K9JNM48YNA', '2022-07-27 20:09:55', '2022-07-27 20:09:55'),
(466, '8R2IU8QPOMXHP6P', 'FUJK4K9JNM48YNA', '2022-07-27 20:09:55', '2022-07-27 20:09:55'),
(467, 'OPIYH2SKJGL3TQL', 'FUJK4K9JNM48YNA', '2022-07-27 20:09:55', '2022-07-27 20:09:55'),
(468, 'XJIMM9X3ZAWUYXQ', 'FUJK4K9JNM48YNA', '2022-07-27 20:09:55', '2022-07-27 20:09:55'),
(469, 'NZUN74MS3GP8QAV', 'ZJG4JY49PVZER4L', '2022-07-27 20:10:07', '2022-07-27 20:10:07'),
(470, 'TMUAZSTV94N429V', 'ZJG4JY49PVZER4L', '2022-07-27 20:10:07', '2022-07-27 20:10:07'),
(471, '58B9925CNZVP3IV', 'ZJG4JY49PVZER4L', '2022-07-27 20:10:07', '2022-07-27 20:10:07'),
(472, '8R2IU8QPOMXHP6P', 'ZJG4JY49PVZER4L', '2022-07-27 20:10:07', '2022-07-27 20:10:07'),
(473, 'OPIYH2SKJGL3TQL', 'ZJG4JY49PVZER4L', '2022-07-27 20:10:07', '2022-07-27 20:10:07'),
(474, 'XJIMM9X3ZAWUYXQ', 'ZJG4JY49PVZER4L', '2022-07-27 20:10:07', '2022-07-27 20:10:07'),
(475, 'NZUN74MS3GP8QAV', 'NXS6JJ5R85I6VNJ', '2022-07-27 20:10:20', '2022-07-27 20:10:20'),
(476, 'TMUAZSTV94N429V', 'NXS6JJ5R85I6VNJ', '2022-07-27 20:10:20', '2022-07-27 20:10:20'),
(477, '58B9925CNZVP3IV', 'NXS6JJ5R85I6VNJ', '2022-07-27 20:10:20', '2022-07-27 20:10:20'),
(478, '8R2IU8QPOMXHP6P', 'NXS6JJ5R85I6VNJ', '2022-07-27 20:10:20', '2022-07-27 20:10:20'),
(479, 'OPIYH2SKJGL3TQL', 'NXS6JJ5R85I6VNJ', '2022-07-27 20:10:20', '2022-07-27 20:10:20'),
(480, 'XJIMM9X3ZAWUYXQ', 'NXS6JJ5R85I6VNJ', '2022-07-27 20:10:20', '2022-07-27 20:10:20'),
(481, 'NZUN74MS3GP8QAV', 'T64XCKLYB7HDOLN', '2022-07-27 20:10:33', '2022-07-27 20:10:33'),
(482, 'TMUAZSTV94N429V', 'T64XCKLYB7HDOLN', '2022-07-27 20:10:33', '2022-07-27 20:10:33'),
(483, '58B9925CNZVP3IV', 'T64XCKLYB7HDOLN', '2022-07-27 20:10:33', '2022-07-27 20:10:33'),
(484, '8R2IU8QPOMXHP6P', 'T64XCKLYB7HDOLN', '2022-07-27 20:10:33', '2022-07-27 20:10:33'),
(485, 'OPIYH2SKJGL3TQL', 'T64XCKLYB7HDOLN', '2022-07-27 20:10:33', '2022-07-27 20:10:33'),
(486, 'XJIMM9X3ZAWUYXQ', 'T64XCKLYB7HDOLN', '2022-07-27 20:10:33', '2022-07-27 20:10:33'),
(487, 'NZUN74MS3GP8QAV', '3VDC9SHF3I3LWEM', '2022-07-27 20:10:46', '2022-07-27 20:10:46'),
(488, 'TMUAZSTV94N429V', '3VDC9SHF3I3LWEM', '2022-07-27 20:10:46', '2022-07-27 20:10:46'),
(489, '58B9925CNZVP3IV', '3VDC9SHF3I3LWEM', '2022-07-27 20:10:46', '2022-07-27 20:10:46'),
(490, '8R2IU8QPOMXHP6P', '3VDC9SHF3I3LWEM', '2022-07-27 20:10:46', '2022-07-27 20:10:46'),
(491, 'OPIYH2SKJGL3TQL', '3VDC9SHF3I3LWEM', '2022-07-27 20:10:46', '2022-07-27 20:10:46'),
(492, 'XJIMM9X3ZAWUYXQ', '3VDC9SHF3I3LWEM', '2022-07-27 20:10:46', '2022-07-27 20:10:46'),
(493, 'NZUN74MS3GP8QAV', 'AXO8SW4CQYA4MLD', '2022-07-27 20:12:55', '2022-07-27 20:12:55'),
(494, 'TMUAZSTV94N429V', 'AXO8SW4CQYA4MLD', '2022-07-27 20:12:55', '2022-07-27 20:12:55'),
(495, '58B9925CNZVP3IV', 'AXO8SW4CQYA4MLD', '2022-07-27 20:12:55', '2022-07-27 20:12:55'),
(496, '8R2IU8QPOMXHP6P', 'AXO8SW4CQYA4MLD', '2022-07-27 20:12:55', '2022-07-27 20:12:55'),
(497, 'OPIYH2SKJGL3TQL', 'AXO8SW4CQYA4MLD', '2022-07-27 20:12:55', '2022-07-27 20:12:55'),
(498, 'XJIMM9X3ZAWUYXQ', 'AXO8SW4CQYA4MLD', '2022-07-27 20:12:55', '2022-07-27 20:12:55'),
(499, 'NZUN74MS3GP8QAV', 'XJY3P1O1CP41PVZ', '2022-07-27 20:13:09', '2022-07-27 20:13:09'),
(500, 'TMUAZSTV94N429V', 'XJY3P1O1CP41PVZ', '2022-07-27 20:13:09', '2022-07-27 20:13:09'),
(501, '58B9925CNZVP3IV', 'XJY3P1O1CP41PVZ', '2022-07-27 20:13:09', '2022-07-27 20:13:09'),
(502, '8R2IU8QPOMXHP6P', 'XJY3P1O1CP41PVZ', '2022-07-27 20:13:09', '2022-07-27 20:13:09'),
(503, 'OPIYH2SKJGL3TQL', 'XJY3P1O1CP41PVZ', '2022-07-27 20:13:09', '2022-07-27 20:13:09'),
(504, 'XJIMM9X3ZAWUYXQ', 'XJY3P1O1CP41PVZ', '2022-07-27 20:13:09', '2022-07-27 20:13:09'),
(505, 'NZUN74MS3GP8QAV', 'GWRAHOJCJY3FSFW', '2022-07-27 20:13:28', '2022-07-27 20:13:28'),
(506, 'TMUAZSTV94N429V', 'GWRAHOJCJY3FSFW', '2022-07-27 20:13:28', '2022-07-27 20:13:28'),
(507, '58B9925CNZVP3IV', 'GWRAHOJCJY3FSFW', '2022-07-27 20:13:28', '2022-07-27 20:13:28'),
(508, '8R2IU8QPOMXHP6P', 'GWRAHOJCJY3FSFW', '2022-07-27 20:13:28', '2022-07-27 20:13:28'),
(509, 'OPIYH2SKJGL3TQL', 'GWRAHOJCJY3FSFW', '2022-07-27 20:13:28', '2022-07-27 20:13:28'),
(510, 'XJIMM9X3ZAWUYXQ', 'GWRAHOJCJY3FSFW', '2022-07-27 20:13:28', '2022-07-27 20:13:28'),
(511, 'NZUN74MS3GP8QAV', '4QCJIMDBK73FX87', '2022-07-27 20:13:46', '2022-07-27 20:13:46'),
(512, 'TMUAZSTV94N429V', '4QCJIMDBK73FX87', '2022-07-27 20:13:46', '2022-07-27 20:13:46'),
(513, '58B9925CNZVP3IV', '4QCJIMDBK73FX87', '2022-07-27 20:13:46', '2022-07-27 20:13:46'),
(514, '8R2IU8QPOMXHP6P', '4QCJIMDBK73FX87', '2022-07-27 20:13:46', '2022-07-27 20:13:46'),
(515, 'OPIYH2SKJGL3TQL', '4QCJIMDBK73FX87', '2022-07-27 20:13:46', '2022-07-27 20:13:46'),
(516, 'XJIMM9X3ZAWUYXQ', '4QCJIMDBK73FX87', '2022-07-27 20:13:46', '2022-07-27 20:13:46'),
(517, 'NZUN74MS3GP8QAV', 'RK6PT1CS2I53CP7', '2022-07-27 20:13:59', '2022-07-27 20:13:59'),
(518, 'TMUAZSTV94N429V', 'RK6PT1CS2I53CP7', '2022-07-27 20:13:59', '2022-07-27 20:13:59'),
(519, '58B9925CNZVP3IV', 'RK6PT1CS2I53CP7', '2022-07-27 20:13:59', '2022-07-27 20:13:59'),
(520, '8R2IU8QPOMXHP6P', 'RK6PT1CS2I53CP7', '2022-07-27 20:13:59', '2022-07-27 20:13:59'),
(521, 'OPIYH2SKJGL3TQL', 'RK6PT1CS2I53CP7', '2022-07-27 20:13:59', '2022-07-27 20:13:59'),
(522, 'XJIMM9X3ZAWUYXQ', 'RK6PT1CS2I53CP7', '2022-07-27 20:13:59', '2022-07-27 20:13:59'),
(523, 'NZUN74MS3GP8QAV', 'GYPM5EVZQO4ZOBA', '2022-07-27 20:14:15', '2022-07-27 20:14:15'),
(524, 'TMUAZSTV94N429V', 'GYPM5EVZQO4ZOBA', '2022-07-27 20:14:15', '2022-07-27 20:14:15'),
(525, '58B9925CNZVP3IV', 'GYPM5EVZQO4ZOBA', '2022-07-27 20:14:15', '2022-07-27 20:14:15'),
(526, '8R2IU8QPOMXHP6P', 'GYPM5EVZQO4ZOBA', '2022-07-27 20:14:15', '2022-07-27 20:14:15'),
(527, 'OPIYH2SKJGL3TQL', 'GYPM5EVZQO4ZOBA', '2022-07-27 20:14:15', '2022-07-27 20:14:15'),
(528, 'XJIMM9X3ZAWUYXQ', 'GYPM5EVZQO4ZOBA', '2022-07-27 20:14:15', '2022-07-27 20:14:15'),
(529, 'NZUN74MS3GP8QAV', 'LFBGQCEVENFZ7GB', '2022-07-27 20:14:35', '2022-07-27 20:14:35'),
(530, 'TMUAZSTV94N429V', 'LFBGQCEVENFZ7GB', '2022-07-27 20:14:35', '2022-07-27 20:14:35'),
(531, '58B9925CNZVP3IV', 'LFBGQCEVENFZ7GB', '2022-07-27 20:14:35', '2022-07-27 20:14:35'),
(532, '8R2IU8QPOMXHP6P', 'LFBGQCEVENFZ7GB', '2022-07-27 20:14:35', '2022-07-27 20:14:35'),
(533, 'OPIYH2SKJGL3TQL', 'LFBGQCEVENFZ7GB', '2022-07-27 20:14:35', '2022-07-27 20:14:35'),
(534, 'XJIMM9X3ZAWUYXQ', 'LFBGQCEVENFZ7GB', '2022-07-27 20:14:35', '2022-07-27 20:14:35'),
(535, 'NZUN74MS3GP8QAV', 'DYGUTF9NC2W1DND', '2022-07-27 20:15:22', '2022-07-27 20:15:22'),
(536, 'TMUAZSTV94N429V', 'DYGUTF9NC2W1DND', '2022-07-27 20:15:22', '2022-07-27 20:15:22'),
(537, '58B9925CNZVP3IV', 'DYGUTF9NC2W1DND', '2022-07-27 20:15:22', '2022-07-27 20:15:22'),
(538, '8R2IU8QPOMXHP6P', 'DYGUTF9NC2W1DND', '2022-07-27 20:15:22', '2022-07-27 20:15:22'),
(539, 'OPIYH2SKJGL3TQL', 'DYGUTF9NC2W1DND', '2022-07-27 20:15:22', '2022-07-27 20:15:22'),
(540, 'XJIMM9X3ZAWUYXQ', 'DYGUTF9NC2W1DND', '2022-07-27 20:15:22', '2022-07-27 20:15:22'),
(541, 'NZUN74MS3GP8QAV', '8UO8FCFTC35BI7O', '2022-07-27 20:15:35', '2022-07-27 20:15:35'),
(542, 'TMUAZSTV94N429V', '8UO8FCFTC35BI7O', '2022-07-27 20:15:35', '2022-07-27 20:15:35'),
(543, '58B9925CNZVP3IV', '8UO8FCFTC35BI7O', '2022-07-27 20:15:35', '2022-07-27 20:15:35'),
(544, '8R2IU8QPOMXHP6P', '8UO8FCFTC35BI7O', '2022-07-27 20:15:35', '2022-07-27 20:15:35'),
(545, 'OPIYH2SKJGL3TQL', '8UO8FCFTC35BI7O', '2022-07-27 20:15:35', '2022-07-27 20:15:35'),
(546, 'XJIMM9X3ZAWUYXQ', '8UO8FCFTC35BI7O', '2022-07-27 20:15:35', '2022-07-27 20:15:35'),
(547, 'NZUN74MS3GP8QAV', 'ZPUU2EKQC4ED61V', '2022-07-27 20:15:56', '2022-07-27 20:15:56'),
(548, 'TMUAZSTV94N429V', 'ZPUU2EKQC4ED61V', '2022-07-27 20:15:56', '2022-07-27 20:15:56'),
(549, '58B9925CNZVP3IV', 'ZPUU2EKQC4ED61V', '2022-07-27 20:15:56', '2022-07-27 20:15:56'),
(550, '8R2IU8QPOMXHP6P', 'ZPUU2EKQC4ED61V', '2022-07-27 20:15:56', '2022-07-27 20:15:56'),
(551, 'OPIYH2SKJGL3TQL', 'ZPUU2EKQC4ED61V', '2022-07-27 20:15:56', '2022-07-27 20:15:56'),
(552, 'XJIMM9X3ZAWUYXQ', 'ZPUU2EKQC4ED61V', '2022-07-27 20:15:56', '2022-07-27 20:15:56'),
(553, 'NZUN74MS3GP8QAV', '9ZZRXSTYXRGAV59', '2022-07-27 20:16:12', '2022-07-27 20:16:12'),
(554, 'TMUAZSTV94N429V', '9ZZRXSTYXRGAV59', '2022-07-27 20:16:12', '2022-07-27 20:16:12'),
(555, '58B9925CNZVP3IV', '9ZZRXSTYXRGAV59', '2022-07-27 20:16:12', '2022-07-27 20:16:12'),
(556, '8R2IU8QPOMXHP6P', '9ZZRXSTYXRGAV59', '2022-07-27 20:16:12', '2022-07-27 20:16:12'),
(557, 'OPIYH2SKJGL3TQL', '9ZZRXSTYXRGAV59', '2022-07-27 20:16:12', '2022-07-27 20:16:12'),
(558, 'XJIMM9X3ZAWUYXQ', '9ZZRXSTYXRGAV59', '2022-07-27 20:16:12', '2022-07-27 20:16:12'),
(559, 'NZUN74MS3GP8QAV', 'S7JW4TRW8QLJ6LX', '2022-07-27 20:16:24', '2022-07-27 20:16:24'),
(560, 'TMUAZSTV94N429V', 'S7JW4TRW8QLJ6LX', '2022-07-27 20:16:24', '2022-07-27 20:16:24'),
(561, '58B9925CNZVP3IV', 'S7JW4TRW8QLJ6LX', '2022-07-27 20:16:24', '2022-07-27 20:16:24'),
(562, '8R2IU8QPOMXHP6P', 'S7JW4TRW8QLJ6LX', '2022-07-27 20:16:24', '2022-07-27 20:16:24'),
(563, 'OPIYH2SKJGL3TQL', 'S7JW4TRW8QLJ6LX', '2022-07-27 20:16:24', '2022-07-27 20:16:24'),
(564, 'XJIMM9X3ZAWUYXQ', 'S7JW4TRW8QLJ6LX', '2022-07-27 20:16:24', '2022-07-27 20:16:24'),
(565, 'NZUN74MS3GP8QAV', '5EMJSKVW5HWVKVV', '2022-07-27 20:16:39', '2022-07-27 20:16:39'),
(566, 'TMUAZSTV94N429V', '5EMJSKVW5HWVKVV', '2022-07-27 20:16:39', '2022-07-27 20:16:39'),
(567, '58B9925CNZVP3IV', '5EMJSKVW5HWVKVV', '2022-07-27 20:16:39', '2022-07-27 20:16:39'),
(568, '8R2IU8QPOMXHP6P', '5EMJSKVW5HWVKVV', '2022-07-27 20:16:39', '2022-07-27 20:16:39'),
(569, 'OPIYH2SKJGL3TQL', '5EMJSKVW5HWVKVV', '2022-07-27 20:16:39', '2022-07-27 20:16:39'),
(570, 'XJIMM9X3ZAWUYXQ', '5EMJSKVW5HWVKVV', '2022-07-27 20:16:39', '2022-07-27 20:16:39'),
(571, 'NZUN74MS3GP8QAV', 'TGRMQSVCNVWBQ5Z', '2022-07-27 20:16:53', '2022-07-27 20:16:53'),
(572, 'TMUAZSTV94N429V', 'TGRMQSVCNVWBQ5Z', '2022-07-27 20:16:53', '2022-07-27 20:16:53'),
(573, '58B9925CNZVP3IV', 'TGRMQSVCNVWBQ5Z', '2022-07-27 20:16:53', '2022-07-27 20:16:53'),
(574, '8R2IU8QPOMXHP6P', 'TGRMQSVCNVWBQ5Z', '2022-07-27 20:16:53', '2022-07-27 20:16:53'),
(575, 'OPIYH2SKJGL3TQL', 'TGRMQSVCNVWBQ5Z', '2022-07-27 20:16:53', '2022-07-27 20:16:53'),
(576, 'XJIMM9X3ZAWUYXQ', 'TGRMQSVCNVWBQ5Z', '2022-07-27 20:16:53', '2022-07-27 20:16:53'),
(577, 'NZUN74MS3GP8QAV', 'IXIKPV6WI26PG3O', '2022-07-27 20:17:06', '2022-07-27 20:17:06'),
(578, 'TMUAZSTV94N429V', 'IXIKPV6WI26PG3O', '2022-07-27 20:17:06', '2022-07-27 20:17:06');
INSERT INTO `category_variant` (`id`, `category_id`, `variant_id`, `created_at`, `updated_at`) VALUES
(579, '58B9925CNZVP3IV', 'IXIKPV6WI26PG3O', '2022-07-27 20:17:06', '2022-07-27 20:17:06'),
(580, '8R2IU8QPOMXHP6P', 'IXIKPV6WI26PG3O', '2022-07-27 20:17:06', '2022-07-27 20:17:06'),
(581, 'OPIYH2SKJGL3TQL', 'IXIKPV6WI26PG3O', '2022-07-27 20:17:06', '2022-07-27 20:17:06'),
(582, 'XJIMM9X3ZAWUYXQ', 'IXIKPV6WI26PG3O', '2022-07-27 20:17:06', '2022-07-27 20:17:06'),
(583, 'NZUN74MS3GP8QAV', 'TRUVWU8TE4WA6D9', '2022-07-27 20:17:20', '2022-07-27 20:17:20'),
(584, 'TMUAZSTV94N429V', 'TRUVWU8TE4WA6D9', '2022-07-27 20:17:20', '2022-07-27 20:17:20'),
(585, '58B9925CNZVP3IV', 'TRUVWU8TE4WA6D9', '2022-07-27 20:17:20', '2022-07-27 20:17:20'),
(586, '8R2IU8QPOMXHP6P', 'TRUVWU8TE4WA6D9', '2022-07-27 20:17:20', '2022-07-27 20:17:20'),
(587, 'OPIYH2SKJGL3TQL', 'TRUVWU8TE4WA6D9', '2022-07-27 20:17:20', '2022-07-27 20:17:20'),
(588, 'XJIMM9X3ZAWUYXQ', 'TRUVWU8TE4WA6D9', '2022-07-27 20:17:20', '2022-07-27 20:17:20'),
(589, 'NZUN74MS3GP8QAV', 'S1BLG7W7PZ1QIK6', '2022-07-27 20:17:37', '2022-07-27 20:17:37'),
(590, 'TMUAZSTV94N429V', 'S1BLG7W7PZ1QIK6', '2022-07-27 20:17:37', '2022-07-27 20:17:37'),
(591, '58B9925CNZVP3IV', 'S1BLG7W7PZ1QIK6', '2022-07-27 20:17:37', '2022-07-27 20:17:37'),
(592, '8R2IU8QPOMXHP6P', 'S1BLG7W7PZ1QIK6', '2022-07-27 20:17:37', '2022-07-27 20:17:37'),
(593, 'OPIYH2SKJGL3TQL', 'S1BLG7W7PZ1QIK6', '2022-07-27 20:17:37', '2022-07-27 20:17:37'),
(594, 'XJIMM9X3ZAWUYXQ', 'S1BLG7W7PZ1QIK6', '2022-07-27 20:17:37', '2022-07-27 20:17:37'),
(595, 'NZUN74MS3GP8QAV', 'ZYQG7IKOOEI57AF', '2022-07-27 20:17:49', '2022-07-27 20:17:49'),
(596, 'TMUAZSTV94N429V', 'ZYQG7IKOOEI57AF', '2022-07-27 20:17:49', '2022-07-27 20:17:49'),
(597, '58B9925CNZVP3IV', 'ZYQG7IKOOEI57AF', '2022-07-27 20:17:49', '2022-07-27 20:17:49'),
(598, '8R2IU8QPOMXHP6P', 'ZYQG7IKOOEI57AF', '2022-07-27 20:17:49', '2022-07-27 20:17:49'),
(599, 'OPIYH2SKJGL3TQL', 'ZYQG7IKOOEI57AF', '2022-07-27 20:17:49', '2022-07-27 20:17:49'),
(600, 'XJIMM9X3ZAWUYXQ', 'ZYQG7IKOOEI57AF', '2022-07-27 20:17:49', '2022-07-27 20:17:49'),
(601, 'NZUN74MS3GP8QAV', '2PMBD3QGU6XBHSO', '2022-07-27 20:18:03', '2022-07-27 20:18:03'),
(602, 'TMUAZSTV94N429V', '2PMBD3QGU6XBHSO', '2022-07-27 20:18:03', '2022-07-27 20:18:03'),
(603, '58B9925CNZVP3IV', '2PMBD3QGU6XBHSO', '2022-07-27 20:18:03', '2022-07-27 20:18:03'),
(604, '8R2IU8QPOMXHP6P', '2PMBD3QGU6XBHSO', '2022-07-27 20:18:03', '2022-07-27 20:18:03'),
(605, 'OPIYH2SKJGL3TQL', '2PMBD3QGU6XBHSO', '2022-07-27 20:18:03', '2022-07-27 20:18:03'),
(606, 'XJIMM9X3ZAWUYXQ', '2PMBD3QGU6XBHSO', '2022-07-27 20:18:03', '2022-07-27 20:18:03'),
(607, 'NZUN74MS3GP8QAV', 'EDFKGVPIGB9VAR8', '2022-07-27 20:18:18', '2022-07-27 20:18:18'),
(608, 'TMUAZSTV94N429V', 'EDFKGVPIGB9VAR8', '2022-07-27 20:18:18', '2022-07-27 20:18:18'),
(609, '58B9925CNZVP3IV', 'EDFKGVPIGB9VAR8', '2022-07-27 20:18:18', '2022-07-27 20:18:18'),
(610, '8R2IU8QPOMXHP6P', 'EDFKGVPIGB9VAR8', '2022-07-27 20:18:18', '2022-07-27 20:18:18'),
(611, 'OPIYH2SKJGL3TQL', 'EDFKGVPIGB9VAR8', '2022-07-27 20:18:18', '2022-07-27 20:18:18'),
(612, 'XJIMM9X3ZAWUYXQ', 'EDFKGVPIGB9VAR8', '2022-07-27 20:18:18', '2022-07-27 20:18:18'),
(613, 'NZUN74MS3GP8QAV', 'LYHTWXK2LA6YHLR', '2022-07-27 20:18:32', '2022-07-27 20:18:32'),
(614, 'TMUAZSTV94N429V', 'LYHTWXK2LA6YHLR', '2022-07-27 20:18:32', '2022-07-27 20:18:32'),
(615, '58B9925CNZVP3IV', 'LYHTWXK2LA6YHLR', '2022-07-27 20:18:32', '2022-07-27 20:18:32'),
(616, '8R2IU8QPOMXHP6P', 'LYHTWXK2LA6YHLR', '2022-07-27 20:18:32', '2022-07-27 20:18:32'),
(617, 'OPIYH2SKJGL3TQL', 'LYHTWXK2LA6YHLR', '2022-07-27 20:18:32', '2022-07-27 20:18:32'),
(618, 'XJIMM9X3ZAWUYXQ', 'LYHTWXK2LA6YHLR', '2022-07-27 20:18:32', '2022-07-27 20:18:32'),
(619, 'NZUN74MS3GP8QAV', 'VASJYZ9QF7AYTM2', '2022-07-27 20:18:49', '2022-07-27 20:18:49'),
(620, 'TMUAZSTV94N429V', 'VASJYZ9QF7AYTM2', '2022-07-27 20:18:49', '2022-07-27 20:18:49'),
(621, '58B9925CNZVP3IV', 'VASJYZ9QF7AYTM2', '2022-07-27 20:18:49', '2022-07-27 20:18:49'),
(622, '8R2IU8QPOMXHP6P', 'VASJYZ9QF7AYTM2', '2022-07-27 20:18:49', '2022-07-27 20:18:49'),
(623, 'OPIYH2SKJGL3TQL', 'VASJYZ9QF7AYTM2', '2022-07-27 20:18:49', '2022-07-27 20:18:49'),
(624, 'XJIMM9X3ZAWUYXQ', 'VASJYZ9QF7AYTM2', '2022-07-27 20:18:49', '2022-07-27 20:18:49'),
(625, 'NZUN74MS3GP8QAV', 'V7P25HFKKTNFVS3', '2022-07-27 20:19:03', '2022-07-27 20:19:03'),
(626, 'TMUAZSTV94N429V', 'V7P25HFKKTNFVS3', '2022-07-27 20:19:03', '2022-07-27 20:19:03'),
(627, '58B9925CNZVP3IV', 'V7P25HFKKTNFVS3', '2022-07-27 20:19:03', '2022-07-27 20:19:03'),
(628, '8R2IU8QPOMXHP6P', 'V7P25HFKKTNFVS3', '2022-07-27 20:19:03', '2022-07-27 20:19:03'),
(629, 'OPIYH2SKJGL3TQL', 'V7P25HFKKTNFVS3', '2022-07-27 20:19:03', '2022-07-27 20:19:03'),
(630, 'XJIMM9X3ZAWUYXQ', 'V7P25HFKKTNFVS3', '2022-07-27 20:19:03', '2022-07-27 20:19:03'),
(631, 'NZUN74MS3GP8QAV', 'O8I3FW8S2A4MDQY', '2022-07-27 20:19:16', '2022-07-27 20:19:16'),
(632, 'TMUAZSTV94N429V', 'O8I3FW8S2A4MDQY', '2022-07-27 20:19:16', '2022-07-27 20:19:16'),
(633, '58B9925CNZVP3IV', 'O8I3FW8S2A4MDQY', '2022-07-27 20:19:16', '2022-07-27 20:19:16'),
(634, '8R2IU8QPOMXHP6P', 'O8I3FW8S2A4MDQY', '2022-07-27 20:19:16', '2022-07-27 20:19:16'),
(635, 'OPIYH2SKJGL3TQL', 'O8I3FW8S2A4MDQY', '2022-07-27 20:19:16', '2022-07-27 20:19:16'),
(636, 'XJIMM9X3ZAWUYXQ', 'O8I3FW8S2A4MDQY', '2022-07-27 20:19:16', '2022-07-27 20:19:16'),
(637, 'NZUN74MS3GP8QAV', 'LHZKSCE54AKPQ75', '2022-07-27 20:19:30', '2022-07-27 20:19:30'),
(638, 'TMUAZSTV94N429V', 'LHZKSCE54AKPQ75', '2022-07-27 20:19:30', '2022-07-27 20:19:30'),
(639, '58B9925CNZVP3IV', 'LHZKSCE54AKPQ75', '2022-07-27 20:19:30', '2022-07-27 20:19:30'),
(640, '8R2IU8QPOMXHP6P', 'LHZKSCE54AKPQ75', '2022-07-27 20:19:30', '2022-07-27 20:19:30'),
(641, 'OPIYH2SKJGL3TQL', 'LHZKSCE54AKPQ75', '2022-07-27 20:19:30', '2022-07-27 20:19:30'),
(642, 'XJIMM9X3ZAWUYXQ', 'LHZKSCE54AKPQ75', '2022-07-27 20:19:30', '2022-07-27 20:19:30'),
(643, 'NZUN74MS3GP8QAV', '2MFYMXBSEI1NRWR', '2022-07-27 20:19:42', '2022-07-27 20:19:42'),
(644, 'TMUAZSTV94N429V', '2MFYMXBSEI1NRWR', '2022-07-27 20:19:42', '2022-07-27 20:19:42'),
(645, '58B9925CNZVP3IV', '2MFYMXBSEI1NRWR', '2022-07-27 20:19:42', '2022-07-27 20:19:42'),
(646, '8R2IU8QPOMXHP6P', '2MFYMXBSEI1NRWR', '2022-07-27 20:19:42', '2022-07-27 20:19:42'),
(647, 'OPIYH2SKJGL3TQL', '2MFYMXBSEI1NRWR', '2022-07-27 20:19:42', '2022-07-27 20:19:42'),
(648, 'XJIMM9X3ZAWUYXQ', '2MFYMXBSEI1NRWR', '2022-07-27 20:19:42', '2022-07-27 20:19:42'),
(649, 'NZUN74MS3GP8QAV', 'W527FLH2ENLM26R', '2022-07-27 20:20:10', '2022-07-27 20:20:10'),
(650, 'TMUAZSTV94N429V', 'W527FLH2ENLM26R', '2022-07-27 20:20:10', '2022-07-27 20:20:10'),
(651, '58B9925CNZVP3IV', 'W527FLH2ENLM26R', '2022-07-27 20:20:10', '2022-07-27 20:20:10'),
(652, '8R2IU8QPOMXHP6P', 'W527FLH2ENLM26R', '2022-07-27 20:20:10', '2022-07-27 20:20:10'),
(653, 'OPIYH2SKJGL3TQL', 'W527FLH2ENLM26R', '2022-07-27 20:20:10', '2022-07-27 20:20:10'),
(654, 'XJIMM9X3ZAWUYXQ', 'W527FLH2ENLM26R', '2022-07-27 20:20:10', '2022-07-27 20:20:10'),
(661, 'NZUN74MS3GP8QAV', 'ED39B4R95SG81VD', '2022-07-27 20:20:51', '2022-07-27 20:20:51'),
(662, 'TMUAZSTV94N429V', 'ED39B4R95SG81VD', '2022-07-27 20:20:51', '2022-07-27 20:20:51'),
(663, '58B9925CNZVP3IV', 'ED39B4R95SG81VD', '2022-07-27 20:20:51', '2022-07-27 20:20:51'),
(664, '8R2IU8QPOMXHP6P', 'ED39B4R95SG81VD', '2022-07-27 20:20:51', '2022-07-27 20:20:51'),
(665, 'OPIYH2SKJGL3TQL', 'ED39B4R95SG81VD', '2022-07-27 20:20:51', '2022-07-27 20:20:51'),
(666, 'XJIMM9X3ZAWUYXQ', 'ED39B4R95SG81VD', '2022-07-27 20:20:51', '2022-07-27 20:20:51'),
(667, 'NZUN74MS3GP8QAV', 'LLRO3NXHIQLBTY8', '2022-07-27 20:21:07', '2022-07-27 20:21:07'),
(668, 'TMUAZSTV94N429V', 'LLRO3NXHIQLBTY8', '2022-07-27 20:21:07', '2022-07-27 20:21:07'),
(669, '58B9925CNZVP3IV', 'LLRO3NXHIQLBTY8', '2022-07-27 20:21:07', '2022-07-27 20:21:07'),
(670, '8R2IU8QPOMXHP6P', 'LLRO3NXHIQLBTY8', '2022-07-27 20:21:07', '2022-07-27 20:21:07'),
(671, 'OPIYH2SKJGL3TQL', 'LLRO3NXHIQLBTY8', '2022-07-27 20:21:07', '2022-07-27 20:21:07'),
(672, 'XJIMM9X3ZAWUYXQ', 'LLRO3NXHIQLBTY8', '2022-07-27 20:21:07', '2022-07-27 20:21:07'),
(673, 'NZUN74MS3GP8QAV', 'FTAYLBM235MKOOR', '2022-07-27 20:21:20', '2022-07-27 20:21:20'),
(674, 'TMUAZSTV94N429V', 'FTAYLBM235MKOOR', '2022-07-27 20:21:20', '2022-07-27 20:21:20'),
(675, '58B9925CNZVP3IV', 'FTAYLBM235MKOOR', '2022-07-27 20:21:20', '2022-07-27 20:21:20'),
(676, '8R2IU8QPOMXHP6P', 'FTAYLBM235MKOOR', '2022-07-27 20:21:20', '2022-07-27 20:21:20'),
(677, 'OPIYH2SKJGL3TQL', 'FTAYLBM235MKOOR', '2022-07-27 20:21:20', '2022-07-27 20:21:20'),
(678, 'XJIMM9X3ZAWUYXQ', 'FTAYLBM235MKOOR', '2022-07-27 20:21:20', '2022-07-27 20:21:20'),
(679, 'NZUN74MS3GP8QAV', '68DYWZNPEMM2QKO', '2022-07-27 20:21:34', '2022-07-27 20:21:34'),
(680, 'TMUAZSTV94N429V', '68DYWZNPEMM2QKO', '2022-07-27 20:21:34', '2022-07-27 20:21:34'),
(681, '58B9925CNZVP3IV', '68DYWZNPEMM2QKO', '2022-07-27 20:21:34', '2022-07-27 20:21:34'),
(682, '8R2IU8QPOMXHP6P', '68DYWZNPEMM2QKO', '2022-07-27 20:21:34', '2022-07-27 20:21:34'),
(683, 'OPIYH2SKJGL3TQL', '68DYWZNPEMM2QKO', '2022-07-27 20:21:34', '2022-07-27 20:21:34'),
(684, 'XJIMM9X3ZAWUYXQ', '68DYWZNPEMM2QKO', '2022-07-27 20:21:34', '2022-07-27 20:21:34'),
(685, 'NZUN74MS3GP8QAV', 'MRU6Q6RC9T8VOLI', '2022-07-27 20:21:49', '2022-07-27 20:21:49'),
(686, 'TMUAZSTV94N429V', 'MRU6Q6RC9T8VOLI', '2022-07-27 20:21:49', '2022-07-27 20:21:49'),
(687, '58B9925CNZVP3IV', 'MRU6Q6RC9T8VOLI', '2022-07-27 20:21:49', '2022-07-27 20:21:49'),
(688, '8R2IU8QPOMXHP6P', 'MRU6Q6RC9T8VOLI', '2022-07-27 20:21:49', '2022-07-27 20:21:49'),
(689, 'OPIYH2SKJGL3TQL', 'MRU6Q6RC9T8VOLI', '2022-07-27 20:21:49', '2022-07-27 20:21:49'),
(690, 'XJIMM9X3ZAWUYXQ', 'MRU6Q6RC9T8VOLI', '2022-07-27 20:21:49', '2022-07-27 20:21:49'),
(691, 'NZUN74MS3GP8QAV', '8IR1H3ZJBRTGVTW', '2022-07-27 20:22:10', '2022-07-27 20:22:10'),
(692, 'TMUAZSTV94N429V', '8IR1H3ZJBRTGVTW', '2022-07-27 20:22:10', '2022-07-27 20:22:10'),
(693, '58B9925CNZVP3IV', '8IR1H3ZJBRTGVTW', '2022-07-27 20:22:10', '2022-07-27 20:22:10'),
(694, '8R2IU8QPOMXHP6P', '8IR1H3ZJBRTGVTW', '2022-07-27 20:22:10', '2022-07-27 20:22:10'),
(695, 'OPIYH2SKJGL3TQL', '8IR1H3ZJBRTGVTW', '2022-07-27 20:22:10', '2022-07-27 20:22:10'),
(696, 'XJIMM9X3ZAWUYXQ', '8IR1H3ZJBRTGVTW', '2022-07-27 20:22:10', '2022-07-27 20:22:10'),
(697, 'NZUN74MS3GP8QAV', 'QHC2AOW9P87PCAV', '2022-07-27 20:22:27', '2022-07-27 20:22:27'),
(698, 'TMUAZSTV94N429V', 'QHC2AOW9P87PCAV', '2022-07-27 20:22:27', '2022-07-27 20:22:27'),
(699, '58B9925CNZVP3IV', 'QHC2AOW9P87PCAV', '2022-07-27 20:22:27', '2022-07-27 20:22:27'),
(700, '8R2IU8QPOMXHP6P', 'QHC2AOW9P87PCAV', '2022-07-27 20:22:27', '2022-07-27 20:22:27'),
(701, 'OPIYH2SKJGL3TQL', 'QHC2AOW9P87PCAV', '2022-07-27 20:22:27', '2022-07-27 20:22:27'),
(702, 'XJIMM9X3ZAWUYXQ', 'QHC2AOW9P87PCAV', '2022-07-27 20:22:27', '2022-07-27 20:22:27'),
(703, 'NZUN74MS3GP8QAV', 'O1WIH7U9DUNYOAA', '2022-07-27 20:22:43', '2022-07-27 20:22:43'),
(704, 'TMUAZSTV94N429V', 'O1WIH7U9DUNYOAA', '2022-07-27 20:22:43', '2022-07-27 20:22:43'),
(705, '58B9925CNZVP3IV', 'O1WIH7U9DUNYOAA', '2022-07-27 20:22:43', '2022-07-27 20:22:43'),
(706, '8R2IU8QPOMXHP6P', 'O1WIH7U9DUNYOAA', '2022-07-27 20:22:43', '2022-07-27 20:22:43'),
(707, 'OPIYH2SKJGL3TQL', 'O1WIH7U9DUNYOAA', '2022-07-27 20:22:43', '2022-07-27 20:22:43'),
(708, 'XJIMM9X3ZAWUYXQ', 'O1WIH7U9DUNYOAA', '2022-07-27 20:22:43', '2022-07-27 20:22:43'),
(709, 'NZUN74MS3GP8QAV', 'T23VRS3IWP2BOZL', '2022-07-27 20:23:07', '2022-07-27 20:23:07'),
(710, 'TMUAZSTV94N429V', 'T23VRS3IWP2BOZL', '2022-07-27 20:23:07', '2022-07-27 20:23:07'),
(711, '58B9925CNZVP3IV', 'T23VRS3IWP2BOZL', '2022-07-27 20:23:07', '2022-07-27 20:23:07'),
(712, '8R2IU8QPOMXHP6P', 'T23VRS3IWP2BOZL', '2022-07-27 20:23:07', '2022-07-27 20:23:07'),
(713, 'OPIYH2SKJGL3TQL', 'T23VRS3IWP2BOZL', '2022-07-27 20:23:07', '2022-07-27 20:23:07'),
(714, 'XJIMM9X3ZAWUYXQ', 'T23VRS3IWP2BOZL', '2022-07-27 20:23:07', '2022-07-27 20:23:07'),
(715, 'NZUN74MS3GP8QAV', 'VNQD18FI9HQU2YD', '2022-07-27 20:23:22', '2022-07-27 20:23:22'),
(716, 'TMUAZSTV94N429V', 'VNQD18FI9HQU2YD', '2022-07-27 20:23:22', '2022-07-27 20:23:22'),
(717, '58B9925CNZVP3IV', 'VNQD18FI9HQU2YD', '2022-07-27 20:23:22', '2022-07-27 20:23:22'),
(718, '8R2IU8QPOMXHP6P', 'VNQD18FI9HQU2YD', '2022-07-27 20:23:22', '2022-07-27 20:23:22'),
(719, 'OPIYH2SKJGL3TQL', 'VNQD18FI9HQU2YD', '2022-07-27 20:23:22', '2022-07-27 20:23:22'),
(720, 'XJIMM9X3ZAWUYXQ', 'VNQD18FI9HQU2YD', '2022-07-27 20:23:22', '2022-07-27 20:23:22'),
(721, 'NZUN74MS3GP8QAV', 'Q4K73DP3LH1K8NB', '2022-07-27 20:23:36', '2022-07-27 20:23:36'),
(722, 'TMUAZSTV94N429V', 'Q4K73DP3LH1K8NB', '2022-07-27 20:23:36', '2022-07-27 20:23:36'),
(723, '58B9925CNZVP3IV', 'Q4K73DP3LH1K8NB', '2022-07-27 20:23:36', '2022-07-27 20:23:36'),
(724, '8R2IU8QPOMXHP6P', 'Q4K73DP3LH1K8NB', '2022-07-27 20:23:36', '2022-07-27 20:23:36'),
(725, 'OPIYH2SKJGL3TQL', 'Q4K73DP3LH1K8NB', '2022-07-27 20:23:36', '2022-07-27 20:23:36'),
(726, 'XJIMM9X3ZAWUYXQ', 'Q4K73DP3LH1K8NB', '2022-07-27 20:23:36', '2022-07-27 20:23:36'),
(727, 'NZUN74MS3GP8QAV', '1IBSUHSJ9NCTEHG', '2022-07-27 20:23:53', '2022-07-27 20:23:53'),
(728, 'TMUAZSTV94N429V', '1IBSUHSJ9NCTEHG', '2022-07-27 20:23:53', '2022-07-27 20:23:53'),
(729, '58B9925CNZVP3IV', '1IBSUHSJ9NCTEHG', '2022-07-27 20:23:53', '2022-07-27 20:23:53'),
(730, '8R2IU8QPOMXHP6P', '1IBSUHSJ9NCTEHG', '2022-07-27 20:23:53', '2022-07-27 20:23:53'),
(731, 'OPIYH2SKJGL3TQL', '1IBSUHSJ9NCTEHG', '2022-07-27 20:23:53', '2022-07-27 20:23:53'),
(732, 'XJIMM9X3ZAWUYXQ', '1IBSUHSJ9NCTEHG', '2022-07-27 20:23:53', '2022-07-27 20:23:53'),
(733, 'NZUN74MS3GP8QAV', 'GSIJYKYSK4TGVRV', '2022-07-27 20:24:08', '2022-07-27 20:24:08'),
(734, 'TMUAZSTV94N429V', 'GSIJYKYSK4TGVRV', '2022-07-27 20:24:08', '2022-07-27 20:24:08'),
(735, '58B9925CNZVP3IV', 'GSIJYKYSK4TGVRV', '2022-07-27 20:24:08', '2022-07-27 20:24:08'),
(736, '8R2IU8QPOMXHP6P', 'GSIJYKYSK4TGVRV', '2022-07-27 20:24:08', '2022-07-27 20:24:08'),
(737, 'OPIYH2SKJGL3TQL', 'GSIJYKYSK4TGVRV', '2022-07-27 20:24:08', '2022-07-27 20:24:08'),
(738, 'XJIMM9X3ZAWUYXQ', 'GSIJYKYSK4TGVRV', '2022-07-27 20:24:08', '2022-07-27 20:24:08'),
(739, 'NZUN74MS3GP8QAV', 'KWYG38YQY18QTEQ', '2022-07-27 20:24:21', '2022-07-27 20:24:21'),
(740, 'TMUAZSTV94N429V', 'KWYG38YQY18QTEQ', '2022-07-27 20:24:21', '2022-07-27 20:24:21'),
(741, '58B9925CNZVP3IV', 'KWYG38YQY18QTEQ', '2022-07-27 20:24:21', '2022-07-27 20:24:21'),
(742, '8R2IU8QPOMXHP6P', 'KWYG38YQY18QTEQ', '2022-07-27 20:24:21', '2022-07-27 20:24:21'),
(743, 'OPIYH2SKJGL3TQL', 'KWYG38YQY18QTEQ', '2022-07-27 20:24:21', '2022-07-27 20:24:21'),
(744, 'XJIMM9X3ZAWUYXQ', 'KWYG38YQY18QTEQ', '2022-07-27 20:24:21', '2022-07-27 20:24:21'),
(745, 'NZUN74MS3GP8QAV', 'FW9X8JWMM1XUA67', '2022-07-27 20:24:35', '2022-07-27 20:24:35'),
(746, 'TMUAZSTV94N429V', 'FW9X8JWMM1XUA67', '2022-07-27 20:24:35', '2022-07-27 20:24:35'),
(747, '58B9925CNZVP3IV', 'FW9X8JWMM1XUA67', '2022-07-27 20:24:35', '2022-07-27 20:24:35'),
(748, '8R2IU8QPOMXHP6P', 'FW9X8JWMM1XUA67', '2022-07-27 20:24:35', '2022-07-27 20:24:35'),
(749, 'OPIYH2SKJGL3TQL', 'FW9X8JWMM1XUA67', '2022-07-27 20:24:35', '2022-07-27 20:24:35'),
(750, 'XJIMM9X3ZAWUYXQ', 'FW9X8JWMM1XUA67', '2022-07-27 20:24:35', '2022-07-27 20:24:35'),
(751, 'NZUN74MS3GP8QAV', 'GEAFYCEZ52XL672', '2022-07-27 20:24:47', '2022-07-27 20:24:47'),
(752, 'TMUAZSTV94N429V', 'GEAFYCEZ52XL672', '2022-07-27 20:24:47', '2022-07-27 20:24:47'),
(753, '58B9925CNZVP3IV', 'GEAFYCEZ52XL672', '2022-07-27 20:24:47', '2022-07-27 20:24:47'),
(754, '8R2IU8QPOMXHP6P', 'GEAFYCEZ52XL672', '2022-07-27 20:24:47', '2022-07-27 20:24:47'),
(755, 'OPIYH2SKJGL3TQL', 'GEAFYCEZ52XL672', '2022-07-27 20:24:47', '2022-07-27 20:24:47'),
(756, 'XJIMM9X3ZAWUYXQ', 'GEAFYCEZ52XL672', '2022-07-27 20:24:47', '2022-07-27 20:24:47'),
(757, 'NZUN74MS3GP8QAV', 'LBH8QEKMLQP83SP', '2022-07-27 20:24:59', '2022-07-27 20:24:59'),
(758, 'TMUAZSTV94N429V', 'LBH8QEKMLQP83SP', '2022-07-27 20:24:59', '2022-07-27 20:24:59'),
(759, '58B9925CNZVP3IV', 'LBH8QEKMLQP83SP', '2022-07-27 20:24:59', '2022-07-27 20:24:59'),
(760, '8R2IU8QPOMXHP6P', 'LBH8QEKMLQP83SP', '2022-07-27 20:24:59', '2022-07-27 20:24:59'),
(761, 'OPIYH2SKJGL3TQL', 'LBH8QEKMLQP83SP', '2022-07-27 20:24:59', '2022-07-27 20:24:59'),
(762, 'XJIMM9X3ZAWUYXQ', 'LBH8QEKMLQP83SP', '2022-07-27 20:24:59', '2022-07-27 20:24:59'),
(763, 'NZUN74MS3GP8QAV', 'XIWF74VPC4LVQD5', '2022-07-27 20:25:13', '2022-07-27 20:25:13'),
(764, 'TMUAZSTV94N429V', 'XIWF74VPC4LVQD5', '2022-07-27 20:25:13', '2022-07-27 20:25:13'),
(765, '58B9925CNZVP3IV', 'XIWF74VPC4LVQD5', '2022-07-27 20:25:13', '2022-07-27 20:25:13'),
(766, '8R2IU8QPOMXHP6P', 'XIWF74VPC4LVQD5', '2022-07-27 20:25:13', '2022-07-27 20:25:13'),
(767, 'OPIYH2SKJGL3TQL', 'XIWF74VPC4LVQD5', '2022-07-27 20:25:13', '2022-07-27 20:25:13'),
(768, 'XJIMM9X3ZAWUYXQ', 'XIWF74VPC4LVQD5', '2022-07-27 20:25:13', '2022-07-27 20:25:13'),
(769, 'NZUN74MS3GP8QAV', 'IUE8VOKNUBMC8X9', '2022-07-27 20:25:32', '2022-07-27 20:25:32'),
(770, 'TMUAZSTV94N429V', 'IUE8VOKNUBMC8X9', '2022-07-27 20:25:32', '2022-07-27 20:25:32'),
(771, '58B9925CNZVP3IV', 'IUE8VOKNUBMC8X9', '2022-07-27 20:25:32', '2022-07-27 20:25:32'),
(772, '8R2IU8QPOMXHP6P', 'IUE8VOKNUBMC8X9', '2022-07-27 20:25:32', '2022-07-27 20:25:32'),
(773, 'OPIYH2SKJGL3TQL', 'IUE8VOKNUBMC8X9', '2022-07-27 20:25:32', '2022-07-27 20:25:32'),
(774, 'XJIMM9X3ZAWUYXQ', 'IUE8VOKNUBMC8X9', '2022-07-27 20:25:32', '2022-07-27 20:25:32'),
(775, 'NZUN74MS3GP8QAV', 'X7BJF29TS6T9ZN3', '2022-07-27 20:25:44', '2022-07-27 20:25:44'),
(776, 'TMUAZSTV94N429V', 'X7BJF29TS6T9ZN3', '2022-07-27 20:25:44', '2022-07-27 20:25:44'),
(777, '58B9925CNZVP3IV', 'X7BJF29TS6T9ZN3', '2022-07-27 20:25:44', '2022-07-27 20:25:44'),
(778, '8R2IU8QPOMXHP6P', 'X7BJF29TS6T9ZN3', '2022-07-27 20:25:44', '2022-07-27 20:25:44'),
(779, 'OPIYH2SKJGL3TQL', 'X7BJF29TS6T9ZN3', '2022-07-27 20:25:44', '2022-07-27 20:25:44'),
(780, 'XJIMM9X3ZAWUYXQ', 'X7BJF29TS6T9ZN3', '2022-07-27 20:25:44', '2022-07-27 20:25:44'),
(781, 'NZUN74MS3GP8QAV', '2QO51PLMXPYZL6H', '2022-07-27 20:25:57', '2022-07-27 20:25:57'),
(782, 'TMUAZSTV94N429V', '2QO51PLMXPYZL6H', '2022-07-27 20:25:57', '2022-07-27 20:25:57'),
(783, '58B9925CNZVP3IV', '2QO51PLMXPYZL6H', '2022-07-27 20:25:57', '2022-07-27 20:25:57'),
(784, '8R2IU8QPOMXHP6P', '2QO51PLMXPYZL6H', '2022-07-27 20:25:57', '2022-07-27 20:25:57'),
(785, 'OPIYH2SKJGL3TQL', '2QO51PLMXPYZL6H', '2022-07-27 20:25:57', '2022-07-27 20:25:57'),
(786, 'XJIMM9X3ZAWUYXQ', '2QO51PLMXPYZL6H', '2022-07-27 20:25:57', '2022-07-27 20:25:57'),
(787, 'NZUN74MS3GP8QAV', 'CNSICJK6ER7J3AE', '2022-07-27 20:27:29', '2022-07-27 20:27:29'),
(788, 'TMUAZSTV94N429V', 'CNSICJK6ER7J3AE', '2022-07-27 20:27:29', '2022-07-27 20:27:29'),
(789, '58B9925CNZVP3IV', 'CNSICJK6ER7J3AE', '2022-07-27 20:27:29', '2022-07-27 20:27:29'),
(790, '8R2IU8QPOMXHP6P', 'CNSICJK6ER7J3AE', '2022-07-27 20:27:29', '2022-07-27 20:27:29'),
(791, 'OPIYH2SKJGL3TQL', 'CNSICJK6ER7J3AE', '2022-07-27 20:27:29', '2022-07-27 20:27:29'),
(792, 'XJIMM9X3ZAWUYXQ', 'CNSICJK6ER7J3AE', '2022-07-27 20:27:29', '2022-07-27 20:27:29'),
(793, 'NZUN74MS3GP8QAV', 'VMVXKPII8G4NN1B', '2022-07-27 20:27:46', '2022-07-27 20:27:46'),
(794, 'TMUAZSTV94N429V', 'VMVXKPII8G4NN1B', '2022-07-27 20:27:46', '2022-07-27 20:27:46'),
(795, '58B9925CNZVP3IV', 'VMVXKPII8G4NN1B', '2022-07-27 20:27:46', '2022-07-27 20:27:46'),
(796, '8R2IU8QPOMXHP6P', 'VMVXKPII8G4NN1B', '2022-07-27 20:27:46', '2022-07-27 20:27:46'),
(797, 'OPIYH2SKJGL3TQL', 'VMVXKPII8G4NN1B', '2022-07-27 20:27:46', '2022-07-27 20:27:46'),
(798, 'XJIMM9X3ZAWUYXQ', 'VMVXKPII8G4NN1B', '2022-07-27 20:27:46', '2022-07-27 20:27:46'),
(799, 'NZUN74MS3GP8QAV', 'UESQRV1ZI2N89AC', '2022-07-27 20:28:04', '2022-07-27 20:28:04'),
(800, 'TMUAZSTV94N429V', 'UESQRV1ZI2N89AC', '2022-07-27 20:28:04', '2022-07-27 20:28:04'),
(801, '58B9925CNZVP3IV', 'UESQRV1ZI2N89AC', '2022-07-27 20:28:04', '2022-07-27 20:28:04'),
(802, '8R2IU8QPOMXHP6P', 'UESQRV1ZI2N89AC', '2022-07-27 20:28:04', '2022-07-27 20:28:04'),
(803, 'OPIYH2SKJGL3TQL', 'UESQRV1ZI2N89AC', '2022-07-27 20:28:04', '2022-07-27 20:28:04'),
(804, 'XJIMM9X3ZAWUYXQ', 'UESQRV1ZI2N89AC', '2022-07-27 20:28:04', '2022-07-27 20:28:04'),
(805, 'NZUN74MS3GP8QAV', 'FK4ESZQ1YLLSILS', '2022-07-27 20:28:55', '2022-07-27 20:28:55'),
(806, 'TMUAZSTV94N429V', 'FK4ESZQ1YLLSILS', '2022-07-27 20:28:55', '2022-07-27 20:28:55'),
(807, '58B9925CNZVP3IV', 'FK4ESZQ1YLLSILS', '2022-07-27 20:28:55', '2022-07-27 20:28:55'),
(808, '8R2IU8QPOMXHP6P', 'FK4ESZQ1YLLSILS', '2022-07-27 20:28:55', '2022-07-27 20:28:55'),
(809, 'OPIYH2SKJGL3TQL', 'FK4ESZQ1YLLSILS', '2022-07-27 20:28:55', '2022-07-27 20:28:55'),
(810, 'XJIMM9X3ZAWUYXQ', 'FK4ESZQ1YLLSILS', '2022-07-27 20:28:55', '2022-07-27 20:28:55'),
(811, 'NZUN74MS3GP8QAV', 'A5KOAHW1NRZ9NEX', '2022-07-27 20:29:09', '2022-07-27 20:29:09'),
(812, 'TMUAZSTV94N429V', 'A5KOAHW1NRZ9NEX', '2022-07-27 20:29:09', '2022-07-27 20:29:09'),
(813, '58B9925CNZVP3IV', 'A5KOAHW1NRZ9NEX', '2022-07-27 20:29:09', '2022-07-27 20:29:09'),
(814, '8R2IU8QPOMXHP6P', 'A5KOAHW1NRZ9NEX', '2022-07-27 20:29:09', '2022-07-27 20:29:09'),
(815, 'OPIYH2SKJGL3TQL', 'A5KOAHW1NRZ9NEX', '2022-07-27 20:29:09', '2022-07-27 20:29:09'),
(816, 'XJIMM9X3ZAWUYXQ', 'A5KOAHW1NRZ9NEX', '2022-07-27 20:29:09', '2022-07-27 20:29:09'),
(817, 'NZUN74MS3GP8QAV', 'O49FKPAT9HDQE3Z', '2022-07-27 20:29:23', '2022-07-27 20:29:23'),
(818, 'TMUAZSTV94N429V', 'O49FKPAT9HDQE3Z', '2022-07-27 20:29:23', '2022-07-27 20:29:23'),
(819, '58B9925CNZVP3IV', 'O49FKPAT9HDQE3Z', '2022-07-27 20:29:23', '2022-07-27 20:29:23'),
(820, '8R2IU8QPOMXHP6P', 'O49FKPAT9HDQE3Z', '2022-07-27 20:29:23', '2022-07-27 20:29:23'),
(821, 'OPIYH2SKJGL3TQL', 'O49FKPAT9HDQE3Z', '2022-07-27 20:29:23', '2022-07-27 20:29:23'),
(822, 'XJIMM9X3ZAWUYXQ', 'O49FKPAT9HDQE3Z', '2022-07-27 20:29:23', '2022-07-27 20:29:23'),
(823, 'NZUN74MS3GP8QAV', '1CAJB9MU44I8X9I', '2022-07-27 20:29:35', '2022-07-27 20:29:35'),
(824, 'TMUAZSTV94N429V', '1CAJB9MU44I8X9I', '2022-07-27 20:29:35', '2022-07-27 20:29:35'),
(825, '58B9925CNZVP3IV', '1CAJB9MU44I8X9I', '2022-07-27 20:29:35', '2022-07-27 20:29:35'),
(826, '8R2IU8QPOMXHP6P', '1CAJB9MU44I8X9I', '2022-07-27 20:29:35', '2022-07-27 20:29:35'),
(827, 'OPIYH2SKJGL3TQL', '1CAJB9MU44I8X9I', '2022-07-27 20:29:35', '2022-07-27 20:29:35'),
(828, 'XJIMM9X3ZAWUYXQ', '1CAJB9MU44I8X9I', '2022-07-27 20:29:35', '2022-07-27 20:29:35'),
(829, 'NZUN74MS3GP8QAV', '3J6T4EUPSUARMH2', '2022-07-27 20:29:50', '2022-07-27 20:29:50'),
(830, 'TMUAZSTV94N429V', '3J6T4EUPSUARMH2', '2022-07-27 20:29:50', '2022-07-27 20:29:50'),
(831, '58B9925CNZVP3IV', '3J6T4EUPSUARMH2', '2022-07-27 20:29:50', '2022-07-27 20:29:50'),
(832, '8R2IU8QPOMXHP6P', '3J6T4EUPSUARMH2', '2022-07-27 20:29:50', '2022-07-27 20:29:50'),
(833, 'OPIYH2SKJGL3TQL', '3J6T4EUPSUARMH2', '2022-07-27 20:29:50', '2022-07-27 20:29:50'),
(834, 'XJIMM9X3ZAWUYXQ', '3J6T4EUPSUARMH2', '2022-07-27 20:29:50', '2022-07-27 20:29:50'),
(835, 'NZUN74MS3GP8QAV', 'DK85WYQM81GNSK4', '2022-07-27 20:30:09', '2022-07-27 20:30:09'),
(836, 'TMUAZSTV94N429V', 'DK85WYQM81GNSK4', '2022-07-27 20:30:09', '2022-07-27 20:30:09'),
(837, '58B9925CNZVP3IV', 'DK85WYQM81GNSK4', '2022-07-27 20:30:09', '2022-07-27 20:30:09'),
(838, '8R2IU8QPOMXHP6P', 'DK85WYQM81GNSK4', '2022-07-27 20:30:09', '2022-07-27 20:30:09'),
(839, 'OPIYH2SKJGL3TQL', 'DK85WYQM81GNSK4', '2022-07-27 20:30:09', '2022-07-27 20:30:09'),
(840, 'XJIMM9X3ZAWUYXQ', 'DK85WYQM81GNSK4', '2022-07-27 20:30:09', '2022-07-27 20:30:09'),
(841, 'NZUN74MS3GP8QAV', 'E71A4RY961J76CH', '2022-07-27 20:30:23', '2022-07-27 20:30:23'),
(842, 'TMUAZSTV94N429V', 'E71A4RY961J76CH', '2022-07-27 20:30:23', '2022-07-27 20:30:23'),
(843, '58B9925CNZVP3IV', 'E71A4RY961J76CH', '2022-07-27 20:30:23', '2022-07-27 20:30:23'),
(844, '8R2IU8QPOMXHP6P', 'E71A4RY961J76CH', '2022-07-27 20:30:23', '2022-07-27 20:30:23'),
(845, 'OPIYH2SKJGL3TQL', 'E71A4RY961J76CH', '2022-07-27 20:30:23', '2022-07-27 20:30:23'),
(846, 'XJIMM9X3ZAWUYXQ', 'E71A4RY961J76CH', '2022-07-27 20:30:23', '2022-07-27 20:30:23'),
(847, 'NZUN74MS3GP8QAV', 'UVNP15CPWP9E3WH', '2022-07-27 20:30:39', '2022-07-27 20:30:39'),
(848, 'TMUAZSTV94N429V', 'UVNP15CPWP9E3WH', '2022-07-27 20:30:39', '2022-07-27 20:30:39'),
(849, '58B9925CNZVP3IV', 'UVNP15CPWP9E3WH', '2022-07-27 20:30:39', '2022-07-27 20:30:39'),
(850, '8R2IU8QPOMXHP6P', 'UVNP15CPWP9E3WH', '2022-07-27 20:30:39', '2022-07-27 20:30:39'),
(851, 'OPIYH2SKJGL3TQL', 'UVNP15CPWP9E3WH', '2022-07-27 20:30:39', '2022-07-27 20:30:39'),
(852, 'XJIMM9X3ZAWUYXQ', 'UVNP15CPWP9E3WH', '2022-07-27 20:30:39', '2022-07-27 20:30:39'),
(853, 'NZUN74MS3GP8QAV', 'B8YKAESSGA5JUM4', '2022-07-27 20:30:54', '2022-07-27 20:30:54'),
(854, 'TMUAZSTV94N429V', 'B8YKAESSGA5JUM4', '2022-07-27 20:30:54', '2022-07-27 20:30:54'),
(855, '58B9925CNZVP3IV', 'B8YKAESSGA5JUM4', '2022-07-27 20:30:54', '2022-07-27 20:30:54'),
(856, '8R2IU8QPOMXHP6P', 'B8YKAESSGA5JUM4', '2022-07-27 20:30:54', '2022-07-27 20:30:54'),
(857, 'OPIYH2SKJGL3TQL', 'B8YKAESSGA5JUM4', '2022-07-27 20:30:54', '2022-07-27 20:30:54'),
(858, 'XJIMM9X3ZAWUYXQ', 'B8YKAESSGA5JUM4', '2022-07-27 20:30:54', '2022-07-27 20:30:54'),
(859, 'NZUN74MS3GP8QAV', 'G6DZ9U7VA4Y8T3X', '2022-07-27 20:31:05', '2022-07-27 20:31:05'),
(860, 'TMUAZSTV94N429V', 'G6DZ9U7VA4Y8T3X', '2022-07-27 20:31:05', '2022-07-27 20:31:05'),
(861, '58B9925CNZVP3IV', 'G6DZ9U7VA4Y8T3X', '2022-07-27 20:31:05', '2022-07-27 20:31:05'),
(862, '8R2IU8QPOMXHP6P', 'G6DZ9U7VA4Y8T3X', '2022-07-27 20:31:05', '2022-07-27 20:31:05'),
(863, 'OPIYH2SKJGL3TQL', 'G6DZ9U7VA4Y8T3X', '2022-07-27 20:31:05', '2022-07-27 20:31:05'),
(864, 'XJIMM9X3ZAWUYXQ', 'G6DZ9U7VA4Y8T3X', '2022-07-27 20:31:05', '2022-07-27 20:31:05'),
(865, 'NZUN74MS3GP8QAV', 'OY58RHVXGYZZMMP', '2022-07-27 20:31:22', '2022-07-27 20:31:22'),
(866, 'TMUAZSTV94N429V', 'OY58RHVXGYZZMMP', '2022-07-27 20:31:22', '2022-07-27 20:31:22'),
(867, '58B9925CNZVP3IV', 'OY58RHVXGYZZMMP', '2022-07-27 20:31:22', '2022-07-27 20:31:22'),
(868, '8R2IU8QPOMXHP6P', 'OY58RHVXGYZZMMP', '2022-07-27 20:31:22', '2022-07-27 20:31:22'),
(869, 'OPIYH2SKJGL3TQL', 'OY58RHVXGYZZMMP', '2022-07-27 20:31:22', '2022-07-27 20:31:22'),
(870, 'XJIMM9X3ZAWUYXQ', 'OY58RHVXGYZZMMP', '2022-07-27 20:31:22', '2022-07-27 20:31:22'),
(871, 'NZUN74MS3GP8QAV', 'TB65YJWEK95Y4P2', '2022-07-27 20:31:34', '2022-07-27 20:31:34'),
(872, 'TMUAZSTV94N429V', 'TB65YJWEK95Y4P2', '2022-07-27 20:31:34', '2022-07-27 20:31:34'),
(873, '58B9925CNZVP3IV', 'TB65YJWEK95Y4P2', '2022-07-27 20:31:34', '2022-07-27 20:31:34'),
(874, '8R2IU8QPOMXHP6P', 'TB65YJWEK95Y4P2', '2022-07-27 20:31:34', '2022-07-27 20:31:34'),
(875, 'OPIYH2SKJGL3TQL', 'TB65YJWEK95Y4P2', '2022-07-27 20:31:34', '2022-07-27 20:31:34'),
(876, 'XJIMM9X3ZAWUYXQ', 'TB65YJWEK95Y4P2', '2022-07-27 20:31:34', '2022-07-27 20:31:34'),
(877, 'NZUN74MS3GP8QAV', 'N9YCOVF3KT9FZGD', '2022-07-27 20:31:47', '2022-07-27 20:31:47'),
(878, 'TMUAZSTV94N429V', 'N9YCOVF3KT9FZGD', '2022-07-27 20:31:47', '2022-07-27 20:31:47'),
(879, '58B9925CNZVP3IV', 'N9YCOVF3KT9FZGD', '2022-07-27 20:31:47', '2022-07-27 20:31:47'),
(880, '8R2IU8QPOMXHP6P', 'N9YCOVF3KT9FZGD', '2022-07-27 20:31:47', '2022-07-27 20:31:47'),
(881, 'OPIYH2SKJGL3TQL', 'N9YCOVF3KT9FZGD', '2022-07-27 20:31:47', '2022-07-27 20:31:47'),
(882, 'XJIMM9X3ZAWUYXQ', 'N9YCOVF3KT9FZGD', '2022-07-27 20:31:47', '2022-07-27 20:31:47'),
(883, 'NZUN74MS3GP8QAV', 'KH7HNYZAOFVWQQK', '2022-07-27 20:32:03', '2022-07-27 20:32:03'),
(884, 'TMUAZSTV94N429V', 'KH7HNYZAOFVWQQK', '2022-07-27 20:32:03', '2022-07-27 20:32:03'),
(885, '58B9925CNZVP3IV', 'KH7HNYZAOFVWQQK', '2022-07-27 20:32:03', '2022-07-27 20:32:03'),
(886, '8R2IU8QPOMXHP6P', 'KH7HNYZAOFVWQQK', '2022-07-27 20:32:03', '2022-07-27 20:32:03'),
(887, 'OPIYH2SKJGL3TQL', 'KH7HNYZAOFVWQQK', '2022-07-27 20:32:03', '2022-07-27 20:32:03'),
(888, 'XJIMM9X3ZAWUYXQ', 'KH7HNYZAOFVWQQK', '2022-07-27 20:32:03', '2022-07-27 20:32:03'),
(889, 'NZUN74MS3GP8QAV', 'JYBYUBWL14AYYGR', '2022-07-27 20:32:16', '2022-07-27 20:32:16'),
(890, 'TMUAZSTV94N429V', 'JYBYUBWL14AYYGR', '2022-07-27 20:32:16', '2022-07-27 20:32:16'),
(891, '58B9925CNZVP3IV', 'JYBYUBWL14AYYGR', '2022-07-27 20:32:16', '2022-07-27 20:32:16'),
(892, '8R2IU8QPOMXHP6P', 'JYBYUBWL14AYYGR', '2022-07-27 20:32:16', '2022-07-27 20:32:16'),
(893, 'OPIYH2SKJGL3TQL', 'JYBYUBWL14AYYGR', '2022-07-27 20:32:16', '2022-07-27 20:32:16'),
(894, 'XJIMM9X3ZAWUYXQ', 'JYBYUBWL14AYYGR', '2022-07-27 20:32:16', '2022-07-27 20:32:16'),
(895, 'NZUN74MS3GP8QAV', 'ZS84EU7DHLOD1J7', '2022-07-27 20:32:36', '2022-07-27 20:32:36'),
(896, 'TMUAZSTV94N429V', 'ZS84EU7DHLOD1J7', '2022-07-27 20:32:36', '2022-07-27 20:32:36'),
(897, '58B9925CNZVP3IV', 'ZS84EU7DHLOD1J7', '2022-07-27 20:32:36', '2022-07-27 20:32:36'),
(898, '8R2IU8QPOMXHP6P', 'ZS84EU7DHLOD1J7', '2022-07-27 20:32:36', '2022-07-27 20:32:36'),
(899, 'OPIYH2SKJGL3TQL', 'ZS84EU7DHLOD1J7', '2022-07-27 20:32:36', '2022-07-27 20:32:36'),
(900, 'XJIMM9X3ZAWUYXQ', 'ZS84EU7DHLOD1J7', '2022-07-27 20:32:36', '2022-07-27 20:32:36'),
(901, 'NZUN74MS3GP8QAV', '9EGU2MLETCR1MZO', '2022-07-27 20:32:50', '2022-07-27 20:32:50'),
(902, 'TMUAZSTV94N429V', '9EGU2MLETCR1MZO', '2022-07-27 20:32:50', '2022-07-27 20:32:50'),
(903, '58B9925CNZVP3IV', '9EGU2MLETCR1MZO', '2022-07-27 20:32:50', '2022-07-27 20:32:50'),
(904, '8R2IU8QPOMXHP6P', '9EGU2MLETCR1MZO', '2022-07-27 20:32:50', '2022-07-27 20:32:50'),
(905, 'OPIYH2SKJGL3TQL', '9EGU2MLETCR1MZO', '2022-07-27 20:32:50', '2022-07-27 20:32:50'),
(906, 'XJIMM9X3ZAWUYXQ', '9EGU2MLETCR1MZO', '2022-07-27 20:32:50', '2022-07-27 20:32:50'),
(907, 'NZUN74MS3GP8QAV', 'JC5XG9FCWU9A2IS', '2022-07-27 20:33:04', '2022-07-27 20:33:04'),
(908, 'TMUAZSTV94N429V', 'JC5XG9FCWU9A2IS', '2022-07-27 20:33:04', '2022-07-27 20:33:04'),
(909, '58B9925CNZVP3IV', 'JC5XG9FCWU9A2IS', '2022-07-27 20:33:04', '2022-07-27 20:33:04'),
(910, '8R2IU8QPOMXHP6P', 'JC5XG9FCWU9A2IS', '2022-07-27 20:33:04', '2022-07-27 20:33:04'),
(911, 'OPIYH2SKJGL3TQL', 'JC5XG9FCWU9A2IS', '2022-07-27 20:33:04', '2022-07-27 20:33:04'),
(912, 'XJIMM9X3ZAWUYXQ', 'JC5XG9FCWU9A2IS', '2022-07-27 20:33:04', '2022-07-27 20:33:04'),
(913, 'NZUN74MS3GP8QAV', 'P9PSRUEX8N3GFQH', '2022-07-27 20:33:16', '2022-07-27 20:33:16'),
(914, 'TMUAZSTV94N429V', 'P9PSRUEX8N3GFQH', '2022-07-27 20:33:16', '2022-07-27 20:33:16'),
(915, '58B9925CNZVP3IV', 'P9PSRUEX8N3GFQH', '2022-07-27 20:33:16', '2022-07-27 20:33:16'),
(916, '8R2IU8QPOMXHP6P', 'P9PSRUEX8N3GFQH', '2022-07-27 20:33:16', '2022-07-27 20:33:16'),
(917, 'OPIYH2SKJGL3TQL', 'P9PSRUEX8N3GFQH', '2022-07-27 20:33:16', '2022-07-27 20:33:16'),
(918, 'XJIMM9X3ZAWUYXQ', 'P9PSRUEX8N3GFQH', '2022-07-27 20:33:16', '2022-07-27 20:33:16'),
(919, 'NZUN74MS3GP8QAV', 'WO7JVB5B9PT888K', '2022-07-27 20:33:34', '2022-07-27 20:33:34'),
(920, 'TMUAZSTV94N429V', 'WO7JVB5B9PT888K', '2022-07-27 20:33:34', '2022-07-27 20:33:34'),
(921, '58B9925CNZVP3IV', 'WO7JVB5B9PT888K', '2022-07-27 20:33:34', '2022-07-27 20:33:34'),
(922, '8R2IU8QPOMXHP6P', 'WO7JVB5B9PT888K', '2022-07-27 20:33:34', '2022-07-27 20:33:34'),
(923, 'OPIYH2SKJGL3TQL', 'WO7JVB5B9PT888K', '2022-07-27 20:33:34', '2022-07-27 20:33:34'),
(924, 'XJIMM9X3ZAWUYXQ', 'WO7JVB5B9PT888K', '2022-07-27 20:33:34', '2022-07-27 20:33:34'),
(925, 'NZUN74MS3GP8QAV', 'F9OHX8U8USFPV6G', '2022-07-27 20:41:15', '2022-07-27 20:41:15'),
(926, 'TMUAZSTV94N429V', 'F9OHX8U8USFPV6G', '2022-07-27 20:41:15', '2022-07-27 20:41:15'),
(927, '58B9925CNZVP3IV', 'F9OHX8U8USFPV6G', '2022-07-27 20:41:15', '2022-07-27 20:41:15'),
(928, '8R2IU8QPOMXHP6P', 'F9OHX8U8USFPV6G', '2022-07-27 20:41:15', '2022-07-27 20:41:15'),
(929, 'OPIYH2SKJGL3TQL', 'F9OHX8U8USFPV6G', '2022-07-27 20:41:15', '2022-07-27 20:41:15'),
(930, 'XJIMM9X3ZAWUYXQ', 'F9OHX8U8USFPV6G', '2022-07-27 20:41:15', '2022-07-27 20:41:15'),
(931, 'NZUN74MS3GP8QAV', 'PEGW1KRY6ZF3PQF', '2022-07-27 20:41:59', '2022-07-27 20:41:59'),
(932, 'TMUAZSTV94N429V', 'PEGW1KRY6ZF3PQF', '2022-07-27 20:41:59', '2022-07-27 20:41:59'),
(933, '58B9925CNZVP3IV', 'PEGW1KRY6ZF3PQF', '2022-07-27 20:41:59', '2022-07-27 20:41:59'),
(934, '8R2IU8QPOMXHP6P', 'PEGW1KRY6ZF3PQF', '2022-07-27 20:41:59', '2022-07-27 20:41:59'),
(935, 'OPIYH2SKJGL3TQL', 'PEGW1KRY6ZF3PQF', '2022-07-27 20:41:59', '2022-07-27 20:41:59'),
(936, 'XJIMM9X3ZAWUYXQ', 'PEGW1KRY6ZF3PQF', '2022-07-27 20:41:59', '2022-07-27 20:41:59'),
(937, 'NZUN74MS3GP8QAV', 'GKZCPR9TYWWT3XT', '2022-07-27 20:44:17', '2022-07-27 20:44:17'),
(938, 'TMUAZSTV94N429V', 'GKZCPR9TYWWT3XT', '2022-07-27 20:44:17', '2022-07-27 20:44:17'),
(939, '58B9925CNZVP3IV', 'GKZCPR9TYWWT3XT', '2022-07-27 20:44:17', '2022-07-27 20:44:17'),
(940, '8R2IU8QPOMXHP6P', 'GKZCPR9TYWWT3XT', '2022-07-27 20:44:17', '2022-07-27 20:44:17'),
(941, 'OPIYH2SKJGL3TQL', 'GKZCPR9TYWWT3XT', '2022-07-27 20:44:17', '2022-07-27 20:44:17'),
(942, 'XJIMM9X3ZAWUYXQ', 'GKZCPR9TYWWT3XT', '2022-07-27 20:44:17', '2022-07-27 20:44:17'),
(943, 'NZUN74MS3GP8QAV', 'Q581EQLOBN3YD36', '2022-08-09 16:28:38', '2022-08-09 16:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `check_out`
--

CREATE TABLE `check_out` (
  `check_out_id` varchar(100) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `variant_id` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `total_price` float NOT NULL,
  `ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cheque_manger`
--

CREATE TABLE `cheque_manger` (
  `cheque_id` varchar(100) NOT NULL,
  `transection_id` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `bank_id` varchar(100) NOT NULL,
  `store_id` varchar(100) DEFAULT NULL,
  `user_id` varchar(100) NOT NULL,
  `cheque_no` varchar(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `transection_type` varchar(100) NOT NULL,
  `cheque_status` int(11) NOT NULL,
  `amount` float NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `color_backends`
--

CREATE TABLE `color_backends` (
  `id` int(11) NOT NULL,
  `color1` varchar(20) NOT NULL,
  `color2` varchar(20) NOT NULL,
  `color3` varchar(20) NOT NULL,
  `color4` varchar(20) NOT NULL,
  `color5` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `color_backends`
--

INSERT INTO `color_backends` (`id`, `color1`, `color2`, `color3`, `color4`, `color5`) VALUES
(1, '#000000', '#ffffff', '#efefef', '#004880', '#ffffff');

-- --------------------------------------------------------

--
-- Table structure for table `color_frontends`
--

CREATE TABLE `color_frontends` (
  `id` int(11) NOT NULL,
  `theme` varchar(50) NOT NULL DEFAULT 'default',
  `color1` varchar(20) NOT NULL,
  `color2` varchar(20) NOT NULL,
  `color3` varchar(20) NOT NULL,
  `color4` varchar(20) NOT NULL,
  `color5` varchar(20) DEFAULT NULL,
  `color1_font` varchar(30) DEFAULT NULL,
  `color2_font` varchar(30) DEFAULT NULL,
  `color3_font` varchar(30) DEFAULT NULL,
  `color4_font` varchar(30) DEFAULT NULL,
  `color5_font` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `color_frontends`
--

INSERT INTO `color_frontends` (`id`, `theme`, `color1`, `color2`, `color3`, `color4`, `color5`, `color1_font`, `color2_font`, `color3_font`, `color4_font`, `color5_font`) VALUES
(1, 'default', '#8450af', '#a82e9e', '#842d8f', '#b92db4', '#9d1ab7', NULL, NULL, NULL, NULL, NULL),
(2, 'isshue_classic', '#262626 ', '#273d54', '#f03636', '#ef3636', '#f03636', NULL, NULL, NULL, NULL, NULL),
(3, 'shatu', '#ffffff', '#121521', '#0c3150', '#03870c', '#ffffff', NULL, NULL, NULL, NULL, NULL),
(4, 'martbd', '#4baebe', '#273d54', '#0054d1', '#0066ff', '#ffffff', NULL, NULL, NULL, NULL, NULL),
(5, 'zaima', '#ffffff', '#ffffff', '#ffffff', '#004880', '#004880', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_information`
--

CREATE TABLE `company_information` (
  `company_id` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `website` text NOT NULL,
  `vat_no` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_information`
--

INSERT INTO `company_information` (`company_id`, `company_name`, `email`, `address`, `mobile`, `website`, `vat_no`, `status`) VALUES
('NOILG8EGCRXXBWUEUQBM', '212', '212@gmail.com', 'Cairo', '+00-000-00000', 'https://21.com', '333', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` varchar(100) NOT NULL,
  `coupon_name` varchar(100) NOT NULL,
  `coupon_discount_code` varchar(100) NOT NULL,
  `discount_amount` float DEFAULT NULL,
  `discount_percentage` varchar(20) DEFAULT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `discount_type` int(11) DEFAULT NULL COMMENT '1=Taka,2=Percentage',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_invoice`
--

CREATE TABLE `coupon_invoice` (
  `coupon_invoice_id` varchar(100) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `coupon_code` varchar(100) NOT NULL,
  `date_of_apply` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `crypto_payments`
--

CREATE TABLE `crypto_payments` (
  `paymentID` int(10) UNSIGNED NOT NULL,
  `boxID` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `boxType` enum('paymentbox','captchabox') NOT NULL,
  `orderID` varchar(50) NOT NULL DEFAULT '',
  `userID` varchar(50) NOT NULL DEFAULT '',
  `countryID` varchar(3) NOT NULL DEFAULT '',
  `coinLabel` varchar(6) NOT NULL DEFAULT '',
  `amount` double(20,8) NOT NULL DEFAULT '0.00000000',
  `amountUSD` double(20,8) NOT NULL DEFAULT '0.00000000',
  `unrecognised` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `addr` varchar(34) NOT NULL DEFAULT '',
  `txID` char(64) NOT NULL DEFAULT '',
  `txDate` datetime DEFAULT NULL,
  `txConfirmed` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `txCheckDate` datetime DEFAULT NULL,
  `processed` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `processedDate` datetime DEFAULT NULL,
  `recordCreated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `currency_info`
--

CREATE TABLE `currency_info` (
  `currency_id` varchar(255) NOT NULL,
  `currency_name` varchar(255) NOT NULL,
  `currency_icon` text NOT NULL,
  `currency_position` int(11) NOT NULL DEFAULT '0',
  `convertion_rate` float NOT NULL,
  `default_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency_info`
--

INSERT INTO `currency_info` (`currency_id`, `currency_name`, `currency_icon`, `currency_position`, `convertion_rate`, `default_status`) VALUES
('5O2VW2IFRBF1ULM', 'YUAN', 'RMB', 1, 3.03, '0'),
('8FBRO66QE3BJKIK', 'EGP', 'EGP', 1, 1, '0'),
('I3ENJZL5NUU4EHR', 'Saudi Riyal', 'SAR', 1, 5.04, '0'),
('JFQT84SU2R9BTCM', 'ORUO', 'EUR', 0, 19.32, '0'),
('S3P1CCYC6JUP7PZ', 'DH', 'DH', 1, 1, '1'),
('ZFUXHWW83EM6QGP', 'USD', '$', 0, 18.95, '0');

-- --------------------------------------------------------

--
-- Table structure for table `customer_activities`
--

CREATE TABLE `customer_activities` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(50) DEFAULT NULL,
  `login_count` int(11) DEFAULT NULL,
  `last_login` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_information`
--

CREATE TABLE `customer_information` (
  `customer_id` varchar(250) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_day` varchar(100) DEFAULT NULL,
  `customer_short_address` text NOT NULL,
  `customer_address_1` text NOT NULL,
  `customer_address_2` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `customer_mobile` varchar(100) DEFAULT NULL,
  `customer_email` varchar(255) NOT NULL,
  `vat_no` varchar(100) DEFAULT NULL,
  `cr_no` varchar(100) DEFAULT NULL,
  `previous_balance` float DEFAULT NULL,
  `image` text,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=paid,2=credit',
  `gid` varchar(100) DEFAULT NULL,
  `guid` varchar(100) DEFAULT NULL,
  `fid` varchar(100) DEFAULT NULL,
  `fuid` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_information`
--

INSERT INTO `customer_information` (`customer_id`, `customer_name`, `first_name`, `last_name`, `birth_day`, `customer_short_address`, `customer_address_1`, `customer_address_2`, `city`, `state`, `country`, `zip`, `customer_mobile`, `customer_email`, `vat_no`, `cr_no`, `previous_balance`, `image`, `password`, `token`, `company`, `status`, `gid`, `guid`, `fid`, `fuid`, `created_at`) VALUES
('DBYXUKJSWP8N48M', 'Ntest', NULL, '', NULL, '4534hgjmgh', 'fghnncfh', 'dxgdrxyghdr', 'rdyh', 'Benguela', '6', 'trfuyh', '1452543453', 'n@n.gmail.com', '45', '45', 5345, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, '2022-08-09 08:47:36'),
('GJ4GCFMBY9N5EYM', 'Salah', NULL, '', NULL, '', '', '', '', '', '', '', '0600000000', 'Salah@Salah.com', '', '', 0, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, '2022-09-05 03:10:33'),
('H19R56HXWF2XIQ5', 'محمد عمر ', NULL, '', NULL, 'جده', '', '', 'JEDDAH', 'Western Province', '191', '', '0505685645', 'shady@yahoo.com', '', '', 0, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, '2022-08-01 11:20:18'),
('Q2F8JTKZLICO4LE', 'Mr.Customer', NULL, '', NULL, '', '', '', 'Mumbai', 'Maharashtra', '101', '', '1234567890', 'customer@customer.com', NULL, NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, '2021-04-15 16:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `customer_ledger`
--

CREATE TABLE `customer_ledger` (
  `transaction_id` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `quotation_no` varchar(100) DEFAULT NULL,
  `order_no` varchar(100) NOT NULL,
  `receipt_no` varchar(100) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `description` text NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_ledger`
--

INSERT INTO `customer_ledger` (`transaction_id`, `customer_id`, `invoice_no`, `quotation_no`, `order_no`, `receipt_no`, `amount`, `description`, `payment_type`, `cheque_no`, `date`, `status`) VALUES
('O8GAOKWH6VP394X', 'Q2F8JTKZLICO4LE', 'Y7CEPK9RJGLPXJH', NULL, '', NULL, 0, '', '', '', '08-09-2022', 1),
('72HDM5OCUIBAFOB', 'Q2F8JTKZLICO4LE', '6I2FVA6V5433BJI', NULL, '', NULL, 0, '', '', '', '08-09-2022', 1),
('SD22G8ZQJOF7YUY', 'Q2F8JTKZLICO4LE', 'GW1UE3PFAD9S12O', NULL, '', NULL, 0, '', '', '', '08-09-2022', 1),
('ACLWYNML6ZTQ7KQ', 'Q2F8JTKZLICO4LE', '2AJIH1Q3IPBFYC5', NULL, '', NULL, 0, '', '', '', '08-10-2022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `customer_order_id` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `shiping_id` varchar(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment_method` varchar(100) NOT NULL,
  `total_bill` float NOT NULL,
  `order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_order_details`
--

CREATE TABLE `customer_order_details` (
  `c_o_d_id` varchar(100) NOT NULL,
  `customer_order_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `variant_id` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` float NOT NULL,
  `tax` float NOT NULL,
  `vat` float NOT NULL,
  `sell_price` float NOT NULL,
  `supplier_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `daily_closing`
--

CREATE TABLE `daily_closing` (
  `closing_id` varchar(255) NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `last_day_closing` float NOT NULL,
  `cash_in` float NOT NULL,
  `cash_out` float NOT NULL,
  `date` varchar(250) NOT NULL,
  `amount` float NOT NULL,
  `adjustment` float NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_assign`
--

CREATE TABLE `delivery_assign` (
  `delivery_id` int(11) NOT NULL,
  `delivery_boy_id` int(11) DEFAULT NULL,
  `time_slot_id` int(11) DEFAULT NULL,
  `delivery_zone_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `completed_at` varchar(50) DEFAULT NULL,
  `note` text,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `address` text,
  `bonus` int(11) DEFAULT NULL,
  `driving_license` varchar(255) DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_no` varchar(100) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_orders`
--

CREATE TABLE `delivery_orders` (
  `delivery_id` int(11) DEFAULT NULL,
  `order_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_time_slot`
--

CREATE TABLE `delivery_time_slot` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `last_order_time` time DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_zone`
--

CREATE TABLE `delivery_zone` (
  `id` int(11) NOT NULL,
  `delivery_zone` varchar(30) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `designation` varchar(150) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `designation`, `details`) VALUES
(2, 'Ntest', 'dfrwaeefewa');

-- --------------------------------------------------------

--
-- Table structure for table `email_configuration`
--

CREATE TABLE `email_configuration` (
  `email_id` varchar(100) NOT NULL,
  `protocol` varchar(100) DEFAULT NULL,
  `mailtype` varchar(100) NOT NULL,
  `smtp_host` varchar(100) DEFAULT NULL,
  `smtp_port` int(11) NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_configuration`
--

INSERT INTO `email_configuration` (`email_id`, `protocol`, `mailtype`, `smtp_host`, `smtp_port`, `sender_email`, `password`) VALUES
('1', 'smtp', 'html', 'ssl://smtp.googlemail.com', 465, 'bdinfoo.biz@gmail.com', 'bdinfo710785');

-- --------------------------------------------------------

--
-- Table structure for table `employee_history`
--

CREATE TABLE `employee_history` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `rate_type` int(11) NOT NULL,
  `hrate` float NOT NULL,
  `email` varchar(50) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `address_line_1` text NOT NULL,
  `address_line_2` text NOT NULL,
  `image` text,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_history`
--

INSERT INTO `employee_history` (`id`, `first_name`, `last_name`, `designation`, `phone`, `rate_type`, `hrate`, `email`, `blood_group`, `address_line_1`, `address_line_2`, `image`, `country`, `city`, `zip`) VALUES
(2, 'Ntest', 'oo', '2', '01234567892', 1, 100, 'n@n.gmail.com', 'a', 'rtysrtyhry', 'rtyrtyrty', '', 'Angola', 'tthrtthrtt', 'rtthrtt');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_payment`
--

CREATE TABLE `employee_salary_payment` (
  `emp_sal_pay_id` int(11) NOT NULL,
  `generate_id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `total_salary` decimal(18,2) NOT NULL DEFAULT '0.00',
  `total_working_minutes` varchar(50) NOT NULL,
  `working_period` varchar(50) NOT NULL,
  `payment_due` varchar(50) NOT NULL,
  `payment_date` varchar(50) NOT NULL,
  `paid_by` varchar(50) NOT NULL,
  `salary_month` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_setup`
--

CREATE TABLE `employee_salary_setup` (
  `e_s_s_id` int(10) UNSIGNED NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  `sal_type` varchar(30) NOT NULL,
  `salary_type_id` varchar(30) NOT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `create_date` date DEFAULT NULL,
  `update_date` datetime(6) DEFAULT NULL,
  `update_id` varchar(30) NOT NULL,
  `gross_salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(100) NOT NULL,
  `voucher_no` varchar(50) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `date`, `type`, `voucher_no`, `amount`) VALUES
(1, '2022-08-22', 'internet bill', '20220822042613', 900);

-- --------------------------------------------------------

--
-- Table structure for table `expense_item`
--

CREATE TABLE `expense_item` (
  `id` int(11) NOT NULL,
  `expense_item_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense_item`
--

INSERT INTO `expense_item` (`id`, `expense_item_name`) VALUES
(1, 'internet bill');

-- --------------------------------------------------------

--
-- Table structure for table `filter_items`
--

CREATE TABLE `filter_items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filter_items`
--

INSERT INTO `filter_items` (`item_id`, `item_name`, `type_id`) VALUES
(1, 'TR', 2),
(2, 'BLASTIC', 2),
(3, 'METAL', 2),
(4, 'BABY', 1),
(5, 'MEN', 1);

-- --------------------------------------------------------

--
-- Table structure for table `filter_product`
--

CREATE TABLE `filter_product` (
  `id` int(11) NOT NULL,
  `category_id` varchar(50) DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `filter_type_id` int(11) DEFAULT NULL,
  `filter_item_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filter_product`
--

INSERT INTO `filter_product` (`id`, `category_id`, `product_id`, `filter_type_id`, `filter_item_id`) VALUES
(64, 'XJIMM9X3ZAWUYXQ', '58223221', 2, '2'),
(65, 'XJIMM9X3ZAWUYXQ', '58223221', 2, '2');

-- --------------------------------------------------------

--
-- Table structure for table `filter_types`
--

CREATE TABLE `filter_types` (
  `fil_type_id` int(11) NOT NULL,
  `fil_type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filter_types`
--

INSERT INTO `filter_types` (`fil_type_id`, `fil_type_name`) VALUES
(1, 'GENDER'),
(2, 'MATERIAL');

-- --------------------------------------------------------

--
-- Table structure for table `filter_type_category`
--

CREATE TABLE `filter_type_category` (
  `type_id` int(11) NOT NULL,
  `category_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filter_type_category`
--

INSERT INTO `filter_type_category` (`type_id`, `category_id`) VALUES
(2, '8R2IU8QPOMXHP6P'),
(2, '8R2IU8QPOMXHP6P'),
(2, 'NZUN74MS3GP8QAV');

-- --------------------------------------------------------

--
-- Table structure for table `image_gallery`
--

CREATE TABLE `image_gallery` (
  `image_gallery_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `img_thumb` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_gallery`
--

INSERT INTO `image_gallery` (`image_gallery_id`, `product_id`, `image_url`, `img_thumb`) VALUES
('3SZLVAP4DJ9KXSH', '22161617', 'my-assets/image/gallery/', 'null'),
('4PO1OV4YMJFF5PD', '62572489', 'my-assets/image/gallery/', 'null'),
('511CG4V1GKGVQJX', '69428333', 'my-assets/image/gallery/', 'null'),
('5WAY7A6JBMXDKZQ', '46339612', 'my-assets/image/gallery/', 'null'),
('8UVRUWZYXSYZDNU', '25869255', 'my-assets/image/gallery/', 'null'),
('AHT22AG54P2JROQ', '55833959', 'my-assets/image/gallery/', 'null'),
('BPKBVG1447XD323', '21473628', 'my-assets/image/gallery/', 'null'),
('CXC19E86YVHB2BB', '58223221', 'my-assets/image/gallery/af5587d9317a6fa294e55a516ae5ee30.png', 'null'),
('D95ZHKB22MFX1NL', '36993614', 'my-assets/image/gallery/', 'null'),
('LNVBRKNWA3MFDYK', '98366399', 'my-assets/image/gallery/', 'null'),
('M4J6JPSNXVR9V98', '63552563', 'my-assets/image/gallery/', 'null'),
('ODRGQNA9HEVT4A5', '77144835', 'my-assets/image/gallery/', 'null'),
('QLO1KCC5RP4IC44', '31152612', 'my-assets/image/gallery/cdc38b57b42f7c5643e817dc4ccc18ed.png', 'null'),
('SECC8E4EZZJ84Y6', '39931699', 'my-assets/image/gallery/', 'null'),
('SO8UJHYUKWBRYH2', '95876719', 'my-assets/image/gallery/', 'null'),
('XIL8Z6F48FJ7I3R', '11389311', 'my-assets/image/gallery/', 'null'),
('Y9R3CLPSYC3DAD7', '64148874', 'my-assets/image/gallery/', 'null'),
('ZP5NLCWRF6LCA6F', '16789548', 'my-assets/image/gallery/', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` varchar(100) NOT NULL,
  `quotation_id` varchar(100) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `customer_id` varchar(100) NOT NULL,
  `store_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `total_amount` float NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `total_discount` float DEFAULT NULL,
  `total_vat` float DEFAULT NULL,
  `invoice_discount` float DEFAULT NULL COMMENT 'total_discount + invoice_discount',
  `service_charge` float DEFAULT NULL,
  `shipping_charge` tinyint(4) NOT NULL DEFAULT '0',
  `shipping_method` varchar(255) DEFAULT NULL,
  `paid_amount` float NOT NULL,
  `due_amount` float NOT NULL,
  `invoice_details` text,
  `status` int(11) NOT NULL,
  `invoice_status` int(11) NOT NULL COMMENT '1=shipped,2=cancel,3=pending,4=complete,5=processing,6=return',
  `is_quotation` tinyint(1) NOT NULL DEFAULT '0',
  `is_installment` tinyint(1) NOT NULL DEFAULT '0',
  `month_no` int(11) DEFAULT NULL,
  `due_day` int(11) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `quotation_id`, `order_id`, `customer_id`, `store_id`, `user_id`, `date`, `total_amount`, `invoice`, `total_discount`, `total_vat`, `invoice_discount`, `service_charge`, `shipping_charge`, `shipping_method`, `paid_amount`, `due_amount`, `invoice_details`, `status`, `invoice_status`, `is_quotation`, `is_installment`, `month_no`, `due_day`, `employee_id`, `created_at`) VALUES
('2AJIH1Q3IPBFYC5', NULL, NULL, 'Q2F8JTKZLICO4LE', 'ZAACM94HLFHE74R', '1', '08-10-2022', 0, 'Inv-1003', 0, 0, 0, 0, 0, '', 0, 0, '', 1, 0, 0, 0, 0, 0, 2, '2022-08-10 08:25:56'),
('6I2FVA6V5433BJI', NULL, NULL, 'Q2F8JTKZLICO4LE', 'ZAACM94HLFHE74R', '1', '08-09-2022', 0, 'Inv-1001', 0, 0, 0, 0, 0, '', 0, 0, '', 1, 0, 0, 1, 3, 10, 2, '2022-08-09 18:38:29'),
('GW1UE3PFAD9S12O', NULL, NULL, 'Q2F8JTKZLICO4LE', 'ZAACM94HLFHE74R', '1', '08-09-2022', 0, 'Inv-1002', 0, 0, 0, 0, 0, '', 0, 0, '', 1, 0, 0, 1, 4, 25, 2, '2022-08-09 18:40:46'),
('Y7CEPK9RJGLPXJH', NULL, NULL, 'Q2F8JTKZLICO4LE', 'ZAACM94HLFHE74R', '1', '08-09-2022', 0, 'Inv-1000', 0, 0, 0, 0, 0, '', 0, 0, '', 1, 0, 0, 0, 0, 0, 2, '2022-08-09 18:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `invoice_details_id` varchar(100) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `pricing_id` int(11) DEFAULT NULL,
  `variant_id` varchar(100) NOT NULL,
  `variant_color` varchar(30) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `store_id` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` float NOT NULL,
  `supplier_rate` float DEFAULT NULL,
  `total_price` float NOT NULL,
  `discount` float DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`invoice_details_id`, `invoice_id`, `product_id`, `pricing_id`, `variant_id`, `variant_color`, `batch_no`, `store_id`, `quantity`, `rate`, `supplier_rate`, `total_price`, `discount`, `status`) VALUES
('3F5Z5A1M4BBX2DJ', 'GW1UE3PFAD9S12O', '69419565', NULL, 'KH7HNYZAOFVWQQK', '', '', 'ZAACM94HLFHE74R', 0, 100, 0, 0, 0, 1),
('MUF3UB59VUD6SEZ', 'Y7CEPK9RJGLPXJH', '69419565', NULL, 'KH7HNYZAOFVWQQK', '', '', 'ZAACM94HLFHE74R', 0, 100, 0, 0, 0, 1),
('SXX8P4USOTK95OU', '2AJIH1Q3IPBFYC5', '69419565', NULL, 'KH7HNYZAOFVWQQK', '', NULL, 'ZAACM94HLFHE74R', 0, 100, 0, 0, 0, 1),
('UTL8RA1TOFRINBS', '6I2FVA6V5433BJI', '69419565', NULL, 'KH7HNYZAOFVWQQK', '', '', 'ZAACM94HLFHE74R', 0, 100, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_installment`
--

CREATE TABLE `invoice_installment` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `due_date` date NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_amount` decimal(18,2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '1=pending, 2=collected',
  `payment_type` tinyint(4) NOT NULL COMMENT '1=cash, 2=wire transfer, 3=pos, 4=check',
  `account` varchar(255) DEFAULT NULL,
  `check_no` varchar(255) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_stock_tbl`
--

CREATE TABLE `invoice_stock_tbl` (
  `stock_id` int(11) NOT NULL,
  `store_id` varchar(20) DEFAULT NULL,
  `product_id` varchar(20) DEFAULT NULL,
  `variant_id` varchar(20) DEFAULT NULL,
  `variant_color` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `warehouse_id` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_stock_tbl`
--

INSERT INTO `invoice_stock_tbl` (`stock_id`, `store_id`, `product_id`, `variant_id`, `variant_color`, `quantity`, `warehouse_id`, `created_at`, `updated_at`) VALUES
(1, 'ZAACM94HLFHE74R', '69419565', 'KH7HNYZAOFVWQQK', NULL, 0, '', '2022-08-09 16:30:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_text_table`
--

CREATE TABLE `invoice_text_table` (
  `id` int(11) NOT NULL,
  `invoice_text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_text_table`
--

INSERT INTO `invoice_text_table` (`id`, `invoice_text`) VALUES
(2, '\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `phrase` text NOT NULL,
  `english` text,
  `arabic` text,
  `franais` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `phrase`, `english`, `arabic`, `franais`) VALUES
(1, 'user_profile', 'User Profile', 'ملف تعريفي للمستخدم', 'profil de l\'utilisateur'),
(2, 'setting', 'Setting', 'الإعدادات', 'paramètre'),
(3, 'language', 'Language', 'اللغة', 'Langue'),
(4, 'manage_users', 'Manage Users', 'ادارة المستخدمين', 'gérer les utilisateurs'),
(5, 'add_user', 'Add User', 'إضافة مستخدم', 'ajouter un utilisateur'),
(6, 'manage_company', 'Manage Company', 'إدارة الشركة', 'gérer l\'entreprise'),
(7, 'web_settings', 'Web Settings', 'إعدادات الويب', 'paramètres Web'),
(8, 'manage_accounts', 'Manage Accounts', 'إدارة الحسابات', 'gérer les comptes'),
(9, 'create_accounts', 'Create Accounts', 'إنشاء حسابات', 'créer des comptes'),
(10, 'manage_bank', 'Manage Bank', 'إدارة البنك', 'gérer la banque'),
(11, 'add_new_bank', 'Add New Bank', 'إضافة بنك جديد', 'ajouter une nouvelle banque'),
(12, 'settings', 'Settings', 'الإعدادات', 'réglages'),
(13, 'closing_report', 'Closing Report', 'التقرير الختامي', 'rapport de clôture'),
(14, 'closing', 'Closing', 'إغلاق', 'fermeture'),
(15, 'cheque_manager', 'Cheque Manager', 'شيك مصدق', 'gestionnaire de chèques'),
(16, 'accounts_summary', 'Accounts Summary', 'ملخص الحسابات', 'résumé des comptes'),
(17, 'payment', 'Payment', 'الدفع', 'Paiement'),
(18, 'received', 'Received', 'تم الاستلام', 'reçu'),
(19, 'accounts', 'Accounts', 'الحسابات', 'comptes'),
(20, 'stock_report', 'Stock Report', 'تقرير المخزون', 'rapport de stock'),
(21, 'stock', 'Stock', 'المخزون', 'Stock'),
(22, 'pos_invoice', 'POS Invoice', 'فاتورة نقاط البيع', 'facture pos'),
(23, 'manage_invoice', 'Manage Invoice ', 'إدارة الفاتورة', 'gérer la facture'),
(24, 'new_invoice', 'New Invoice', 'فاتورة جديدة', 'nouvelle facture'),
(25, 'invoice', 'Invoice', 'فاتورة', 'facture d\'achat'),
(26, 'manage_purchase', 'Manage Purchase', 'إدارة الشراء', 'gérer l\'achat'),
(27, 'add_purchase', 'Add Purchase', 'أضف شراء', 'ajouter un achat'),
(28, 'purchase', 'Purchase', 'شراء', 'achat'),
(29, 'paid_customer', 'Paid Customer', 'العميل المسدد', 'client payé'),
(30, 'manage_customer', 'Manage Customer', 'إدارة العميل', 'gérer le client'),
(31, 'add_customer', 'Add Customer', 'أضف زبون', 'ajouter un client'),
(32, 'customer', 'Customer', 'عميل', 'client'),
(33, 'supplier_ledger', 'Supplier Ledger', 'دفتر الأستاذ للمورد ', 'registre des fournisseurs'),
(34, 'manage_supplier', 'Manage Supplier', 'إدارة المورد', 'gérer le fournisseur'),
(35, 'add_supplier', 'Add Supplier', 'إضافة مورد', 'ajouter un fournisseur'),
(36, 'supplier', 'Supplier', 'المورد', 'le fournisseur'),
(37, 'manage_product', 'Manage Product', 'إدارة المنتج', 'gérer le produit'),
(38, 'add_product', 'Add Product', 'أضف منتج', 'ajouter un produit'),
(39, 'product', 'Product', 'المنتج', 'produit'),
(40, 'manage_category', 'Manage Category', 'إدارة الفئة', 'gérer la catégorie'),
(41, 'add_category', 'Add Category', 'إضافة فئة', 'ajouter une catégorie'),
(42, 'category', 'Category', 'فئة', 'Catégorie'),
(43, 'sales_report_product_wise', 'Sales Report (Product Wise)', 'تقرير المبيعات (فلترة حسب المنتج)', 'rapport de vente par produit'),
(44, 'purchase_report', 'Purchase Report', 'تقرير الشراء', 'rapport d\'achat'),
(45, 'sales_report', 'Sales Report', 'تقرير المبيعات', 'rapport des ventes'),
(46, 'todays_report', 'Todays Report', 'تقرير اليوم', 'rapport d\'aujourd\'hui'),
(47, 'report', 'Report', 'تقرير', 'rapport'),
(48, 'dashboard', 'Dashboard', 'لوحة التحكم', 'tableau de bord'),
(49, 'online', 'Online', 'متصل', 'en ligne'),
(50, 'logout', 'Logout', 'تسجيل خروج', 'Se déconnecter'),
(51, 'change_password', 'Change Password', 'تغيير كلمة المرور', 'changer le mot de passe'),
(52, 'total_purchase', 'Total Purchase', 'إجمالي الشراء', 'achat total'),
(53, 'total_amount', 'Total Amount', 'المبلغ الإجمالي', 'montant total'),
(54, 'supplier_name', 'Supplier Name', 'اسم المورد', 'Nom du fournisseur'),
(55, 'invoice_no', 'Invoice No', 'رقم الفاتورة', 'facture non'),
(56, 'purchase_date', 'Purchase Date', 'تاريخ الشراء', 'date d\'achat'),
(57, 'todays_purchase_report', 'Todays Purchase Report', 'تقرير شراء اليوم', 'rapport d\'achat du jour'),
(58, 'total_sales', 'Total Sales', 'إجمالي المبيعات', 'ventes totales'),
(59, 'customer_name', 'Customer Name', 'اسم الزبون', 'nom du client'),
(60, 'sales_date', 'Sales Date', 'تاريخ المبيعات', 'date de vente'),
(61, 'todays_sales_report', 'Todays Sales Report', 'تقرير مبيعات اليوم', 'rapport des ventes du jour'),
(62, 'home', 'Home', 'الصفحة الرئيسية', 'domicile'),
(63, 'todays_sales_and_purchase_report', 'Todays sales and purchase report', 'تقرير مبيعات وشراء اليوم', 'rapport des ventes et des achats du jour'),
(64, 'total_ammount', 'Total Amount', 'المبلغ الإجمالي', 'montant total'),
(65, 'rate', 'Rate', 'معدل', 'évaluer'),
(66, 'product_model', 'Product Model', 'نموذج المنتج', 'modèle du produit'),
(67, 'search', 'Search', 'بحث', 'chercher'),
(68, 'end_date', 'End Date', 'تاريخ الانتهاء', 'date de fin'),
(69, 'start_date', 'Start Date', 'تاريخ البدء', 'date de début'),
(70, 'total_purchase_report', 'Total Purchase Report', 'تقرير إجمالي الشراء', 'rapport d\'achat total'),
(71, 'total_sales_report', 'Total Sales Report', 'تقرير إجمالي المبيعات', 'rapport des ventes totales'),
(72, 'total_seles', 'Total Sales', 'إجمالي المبيعات', 'total des ventes'),
(73, 'all_stock_report', 'All Stock Report', 'تقرير كل المخزون', 'tout rapport de stock'),
(74, 'search_by_product', 'Search By Product', 'البحث بالمنتج', 'rechercher par produit'),
(75, 'date', 'Date', 'تاريخ', 'Date'),
(76, 'print', 'Print', 'مطبعة', 'imprimer'),
(77, 'stock_date', 'Stock Date', 'تاريخ المخزون', 'date de stock'),
(78, 'print_date', 'Print Date', 'تاريخ الطباعة', 'date d\'impression'),
(79, 'sales', 'Sales', 'مبيعات', 'Ventes'),
(80, 'price', 'Price', 'سعر', 'le prix'),
(81, 'sl', 'SL.', 'التسلسل', 'sl'),
(82, 'add_new_category', 'Add new category', 'إضافة فئة جديدة', 'Ajouter une nouvelle catégorie'),
(83, 'category_name', 'Category Name', 'اسم التصنيف', 'Nom de catégorie'),
(84, 'save', 'Save', 'يحفظ', 'enregistrer'),
(85, 'delete', 'Delete', 'حذف', 'effacer'),
(86, 'update', 'Update', 'تحديث', 'mettre à jour'),
(87, 'action', 'Action', 'عمل', 'action'),
(88, 'manage_your_category', 'Manage your category ', 'إدارة فئتك', 'gérer votre catégorie'),
(89, 'category_edit', 'Category Edit', 'تحرير الفئة', 'modification de catégorie'),
(90, 'status', 'Status', 'حالة', 'statut'),
(91, 'active', 'Active', 'نشيط', 'actif'),
(92, 'inactive', 'Inactive', 'غير نشط', 'inactif'),
(93, 'save_changes', 'Save Changes', 'حفظ التغييرات', 'Sauvegarder les modifications'),
(94, 'save_and_add_another', 'Save And Add Another', 'احفظ وأضف آخر', 'enregistrer et ajouter un autre'),
(95, 'model', 'Model', 'نموذج', 'maquette'),
(96, 'supplier_price', 'Supplier Price', 'سعر المورد', 'prix fournisseur'),
(97, 'sell_price', 'Sell Price', 'سعر البيع', 'prix de vente'),
(98, 'image', 'Image', 'صورة', 'image'),
(99, 'select_one', 'Select One', 'حدد واحد', 'sélectionnez-en un'),
(100, 'details', 'Details', 'تفاصيل', 'détails'),
(101, 'new_product', 'New Product', 'منتج جديد', 'nouveau produit'),
(102, 'add_new_product', 'Add new product', 'أضف منتج جديد', 'ajouter un nouveau produit'),
(103, 'barcode', 'Barcode', 'الرمز الشريطي', 'code à barre'),
(104, 'qr_code', 'Qr-Code', 'رمز الاستجابة السريعة', 'QR Code'),
(105, 'product_details', 'Product Details', 'تفاصيل المنتج', 'détails du produit'),
(106, 'manage_your_product', 'Manage your product', 'إدارة منتجك', 'gérer votre produit'),
(107, 'product_edit', 'Product Edit', 'تحرير المنتج', 'modification du produit'),
(108, 'edit_your_product', 'Edit your product', 'قم بتحرير منتجك', 'modifier votre produit'),
(109, 'cancel', 'Cancel', 'إلغاء', 'annuler'),
(110, 'excl_vat', 'Excl. Vat', 'غير شامل. ضريبة القيمة المضافة', 'hors TVA'),
(111, 'money', 'TK', 'المعارف التقليدية', 'argent'),
(112, 'grand_total', 'Grand Total', 'المبلغ الإجمالي', 'total'),
(113, 'quantity', 'Qnty', 'الكمية', 'quantité'),
(114, 'product_report', 'Product Report', 'تقرير المنتج', 'rapport de produit'),
(115, 'product_sales_and_purchase_report', 'Product sales and purchase report', 'تقرير مبيعات وشراء المنتج', 'rapport sur les ventes et les achats de produits'),
(116, 'previous_stock', 'Previous Stock', 'المخزون السابق', 'stock précédent'),
(117, 'out', 'Out', 'خارج', 'dehors'),
(118, 'in', 'In', 'في', 'dans'),
(119, 'to', 'To', 'إلى', 'à'),
(120, 'previous_balance', 'Previous Balance', 'الرصيد السابق', 'solde précédent'),
(121, 'customer_address', 'Customer Address', 'عنوان العميل', 'adresse du client'),
(122, 'customer_mobile', 'Customer Mobile', 'جوال العميل', 'mobile du client'),
(123, 'customer_email', 'Customer Email', 'البريد الإلكتروني للعميل', 'email client'),
(124, 'add_new_customer', 'Add new customer', 'إضافة عميل جديد', 'ajouter un nouveau client'),
(125, 'balance', 'Balance', 'الرصيد', 'solde'),
(126, 'mobile', 'Mobile', 'متحرك', 'portable'),
(127, 'address', 'Address', 'عنوان', 'adresse'),
(128, 'manage_your_customer', 'Manage your customer', 'إدارة عميلك', 'gérer votre client'),
(129, 'customer_edit', 'Customer Edit', 'تحرير العميل', 'client modifier'),
(130, 'paid_customer_list', 'Manage your paid customer', 'إدارة عميلك المدفوع', 'liste de clients payés'),
(131, 'ammount', 'Amount', 'كمية', 'quantité'),
(132, 'customer_ledger', 'Customer Ledger', 'دفتر استاذ العميل', 'registre des clients'),
(133, 'manage_customer_ledger', 'Manage Customer Ledger', 'إدارة دفتر حسابات العملاء', 'gérer le registre des clients'),
(134, 'customer_information', 'Customer Information', 'معلومات العميل', 'Informations client'),
(135, 'debit_ammount', 'Debit Amount', 'مقدار الخصم', 'montant du débit'),
(136, 'credit_ammount', 'Credit Amount', 'مبلغ الائتمان', 'montant du crédit'),
(137, 'balance_ammount', 'Balance Amount', 'مقدار وسطي', 'montant du solde'),
(138, 'receipt_no', 'Receipt NO', 'رقم الإيصال', 'reçu non'),
(139, 'description', 'Description', 'وصف', 'la description'),
(140, 'debit', 'Debit', 'مدين', 'débit'),
(141, 'credit', 'Credit', 'تنسب إليه', 'le crédit'),
(142, 'item_information', 'Item Information', 'معلومات البند', 'Informations sur l\'élément'),
(143, 'total', 'Total', 'المجموع', 'total'),
(144, 'please_select_supplier', 'Please Select Supplier', 'الرجاء تحديد المورد', 'veuillez sélectionner le fournisseur'),
(145, 'submit', 'Submit', 'يقدم', 'nous faire parvenir'),
(146, 'submit_and_add_another', 'Submit And Add Another One', 'أرسل وأضف واحدًا آخر', 'soumettre et ajouter un autre'),
(147, 'add_new_item', 'Add New Item', 'أضف أداة جديدة', 'Ajoute un nouvel objet'),
(148, 'manage_your_purchase', 'Manage your purchase', 'إدارة عملية الشراء الخاصة بك', 'gérer votre achat'),
(149, 'purchase_edit', 'Purchase Edit', 'تحرير الشراء', 'acheter modifier'),
(150, 'purchase_ledger', 'Purchase Ledger', 'مشتريات دفتر الأستاذ', 'registre des achats'),
(151, 'invoice_information', 'Invoice Information', 'معلومات الفاتورة', 'informations sur la facture'),
(152, 'paid_ammount', 'Paid', 'مدفوع', 'montant payé'),
(153, 'discount', 'Dis/ Pcs', 'خصم / قطع', 'remise'),
(154, 'save_and_paid', 'Save And Paid', 'حفظ ودفع', 'économisez et payez'),
(155, 'payee_name', 'Payee Name', 'اسم المستفيد', 'le nom du bénéficiaire'),
(156, 'manage_your_invoice', 'Manage your invoice', 'إدارة فاتورتك', 'gérer votre facture'),
(157, 'invoice_edit', 'Invoice Edit', 'تحرير الفاتورة', 'édition de facture'),
(158, 'new_pos_invoice', 'New POS invoice', 'فاتورة جديدة لنقاط البيع', 'nouvelle facture pos'),
(159, 'add_new_pos_invoice', 'Add new pos invoice', 'إضافة فاتورة جديدة لنقاط البيع', 'ajouter une nouvelle facture pos'),
(160, 'product_id', 'Product ID', 'معرف المنتج', 'identifiant du produit'),
(161, 'paid_amount', 'Paid', 'مدفوع', 'montant payé'),
(162, 'authorised_by', 'Authorised By', 'مرخص بها من', 'autorisé par'),
(163, 'checked_by', 'Checked By', 'فحص بواسطة', 'vérifié par'),
(164, 'received_by', 'Received By', 'استلمت من قبل', 'reçu par'),
(165, 'prepared_by', 'Prepared By', 'أعدت بواسطة', 'preparé par'),
(166, 'memo_no', 'Memo No', 'رقم المذكرة', 'mémo pas'),
(167, 'website', 'Website', 'موقع الكتروني', 'site Internet'),
(168, 'email', 'Email', 'بريد الالكتروني', 'e-mail'),
(169, 'invoice_details', 'Invoice Details', 'تفاصيل الفاتورة', 'Détails de la facture'),
(170, 'reset', 'Reset', 'إعادة ضبط', 'réinitialiser'),
(171, 'payment_account', 'Payment Account', 'حساب الدفع', 'Compte de paiement'),
(172, 'bank_name', 'Bank Name', 'اسم البنك', 'Nom de banque'),
(173, 'cheque_or_pay_order_no', 'Cheque/Pay Order No', 'رقم الشيك / الدفع', 'chèque ou ordre de paiement non'),
(174, 'payment_type', 'Payment Type', 'نوع الدفع', 'type de paiement'),
(175, 'payment_from', 'Payment From', 'الدفع من', 'Paiement de'),
(176, 'payment_date', 'Payment Date', 'يوم الدفع او الاستحقاق', 'date de paiement'),
(177, 'add_received', 'Add Received', 'استلام الاضافة', 'ajouter reçu'),
(178, 'cash', 'Cash', 'السيولة النقدية', 'en espèces'),
(179, 'cheque', 'Cheque', 'التحقق من', 'Chèque'),
(180, 'pay_order', 'Pay Order', 'ترتيب الأجور', 'payer la commande'),
(181, 'payment_to', 'Payment To', 'دفع ل', 'Paiement à'),
(182, 'total_payment_ammount', 'Total Payment Report ', 'تقرير الدفع الإجمالي', 'montant total du paiement'),
(183, 'transections', 'Transections', 'المقاطع', 'transections'),
(184, 'accounts_name', 'Accounts Name', 'اسم الحسابات', 'nom du compte'),
(185, 'payment_report', 'Payment Report', 'تقرير الدفع', 'rapport de paiement'),
(186, 'received_report', 'Income Report', 'تقرير الدخل', 'rapport reçu'),
(187, 'all', 'All', 'الجميع', 'tout'),
(188, 'account', 'Account', 'حساب', 'Compte'),
(189, 'from', 'From', 'من', 'de'),
(190, 'account_summary_report', 'Account Summary Report', 'تقرير ملخص الحساب', 'rapport récapitulatif du compte'),
(191, 'search_by_date', 'Search By Date', 'البحث بالتاريخ', 'rechercher par date'),
(192, 'cheque_no', 'Cheque No', 'رقم الشيك', 'vérifier non'),
(193, 'name', 'Name', 'اسم', 'Nom'),
(194, 'closing_account', 'Closing Account', 'الحساب الختامي', 'clôture de compte'),
(195, 'close_your_account', 'Close your account', 'أغلق حسابك', 'fermer votre compte'),
(196, 'last_day_closing', 'Last Day Closing', 'إغلاق اليوم الماضي', 'dernier jour de fermeture'),
(197, 'cash_in', 'Cash In', 'التدفقات النقدية الداخلة', 'encaisser'),
(198, 'cash_out', 'Cash Out', 'المصروفات', 'encaisser'),
(199, 'cash_in_hand', 'Cash In Hand', 'نقد في اليد', 'Du liquide en main'),
(200, 'add_new_bank', 'Add New Bank', 'إضافة بنك جديد', 'ajouter une nouvelle banque'),
(202, 'account_closing_report', 'Account Closing Report', 'تقرير إغلاق الحساب', 'rapport de clôture de compte'),
(203, 'last_day_ammount', 'Last Day Amount', 'مبلغ اليوم الأخير', 'montant du dernier jour'),
(204, 'adjustment', 'Adjustment', 'تعديل', 'ajustement'),
(205, 'pay_type', 'Pay Type', 'نوع الدفع', 'type de paiement'),
(206, 'customer_or_supplier', 'Customer , Supplier Or Others', 'العميل أو المورد أو غيره', 'client ou fournisseur'),
(207, 'transection_id', 'Transections ID', 'معرف القطع', 'identifiant de transaction'),
(208, 'accounts_summary_report', 'Accounts Summary Report', 'تقرير ملخص الحسابات', 'rapport récapitulatif des comptes'),
(209, 'bank_list', 'Bank List', 'قائمة البنك', 'liste de banque'),
(210, 'bank_edit', 'Bank Edit', 'تحرير البنك', 'banque modifier'),
(211, 'debit_plus', 'Debit (+)', 'مدين (+)', 'débit majoré'),
(212, 'credit_minus', 'Credit (-)', 'دائن (-)', 'crédit moins'),
(213, 'account_name', 'Account Name', 'إسم الحساب', 'nom du compte'),
(214, 'account_type', 'Account Type', 'نوع الحساب', 'Type de compte'),
(215, 'account_real_name', 'Account Real Name', 'الاسم الحقيقي للحساب', 'nom réel du compte'),
(216, 'manage_account', 'Manage Account', 'إدارة الحساب', 'gérer son compte'),
(217, 'company_name', 'Company Name', 'اسم الشركة', 'Nom de l\'entreprise'),
(218, 'edit_your_company_information', 'Edit your company information', 'قم بتحرير معلومات شركتك', 'modifier les informations de votre entreprise'),
(219, 'company_edit', 'Company Edit', 'شركة تحرير', 'modification de l\'entreprise'),
(220, 'admin', 'Admin', 'مشرف', 'administrateur'),
(221, 'user', 'User', 'مستخدم', 'utilisateur'),
(222, 'password', 'Password', 'كلمه السر', 'le mot de passe'),
(223, 'last_name', 'Last Name', 'الكنية', 'nom de famille'),
(224, 'first_name', 'First Name', 'الاسم الأول', 'prénom'),
(225, 'add_new_user_information', 'Add new user information', 'أضف معلومات مستخدم جديدة', 'ajouter de nouvelles informations utilisateur'),
(226, 'user_type', 'User Type', 'نوع المستخدم', 'type d\'utilisateur'),
(227, 'user_edit', 'User Edit', 'تحرير المستخدم', 'modification de l\'utilisateur'),
(228, 'rtr', 'Right To Left -RTL', 'من اليمين إلى اليسار', 'Rtr'),
(229, 'ltr', 'Left To Right -LTR', 'من اليسار إلى اليمين', 'litre'),
(230, 'ltr_or_rtr', 'LTR/RTL', 'اليمين إلى اليسار/اليسار إلى اليمين', 'ltr ou rtr'),
(231, 'footer_text', 'Footer Text', 'نص التذييل', 'texte de pied de page'),
(232, 'favicon', 'Favicon', 'ايقونة المفضلات', 'favicon'),
(233, 'logo', 'Logo', 'شعار', 'logo'),
(234, 'update_setting', 'Update Setting', 'إعداد التحديث', 'réglage de la mise à jour'),
(235, 'update_your_web_setting', 'Update your web setting', 'قم بتحديث إعدادات الويب الخاصة بك', 'mettre à jour vos paramètres Web'),
(236, 'login', 'Login', 'تسجيل الدخول', 'connexion'),
(237, 'your_strong_password', 'Your strong password', 'كلمة مرورك القوية', 'votre mot de passe fort'),
(238, 'your_unique_email', 'Your unique email', 'بريدك الإلكتروني الفريد', 'votre e-mail unique'),
(239, 'please_enter_your_login_information', 'Please enter your login information.', 'يرجى إدخال معلومات تسجيل الدخول الخاصة بك.', 'S\'il vous plaît entrer vos informations de connexion'),
(240, 'update_profile', 'Update Profile', 'تحديث الملف', 'mettre à jour le profil'),
(241, 'your_profile', 'Your Profile', 'ملفك الشخصي', 'votre profil'),
(242, 're_type_password', 'Re-Type Password', 'إعادة ادخال كلمة المرور', 'retaper le mot de passe'),
(243, 'new_password', 'New Password', 'كلمة مرور جديدة', 'nouveau mot de passe'),
(244, 'old_password', 'Old Password', 'كلمة سر قديمة', 'ancien mot de passe'),
(245, 'new_information', 'New Information', 'معلومات جديدة', 'nouvelle information'),
(246, 'old_information', 'Old Information', 'معلومات قديمة', 'anciennes informations'),
(247, 'change_your_information', 'Change your information', 'غيّر معلوماتك', 'modifier vos informations'),
(248, 'change_your_profile', 'Change your profile', 'تغيير ملف التعريف الخاص بك', 'changer de profil'),
(249, 'profile', 'Profile', 'الملف الشخصي', 'profil'),
(250, 'wrong_username_or_password', 'Wrong User Name Or Password !', 'اسم المستخدم أو كلمة المرور خاطئة !', 'mauvais nom d\'utilisateur ou mot de passe'),
(251, 'successfully_updated', 'Successfully Updated.', 'تم التحديث بنجاح.', 'mise à jour réussie'),
(252, 'blank_field_does_not_accept', 'Blank Field Does Not Accept !', 'حقل فارغ غير مقبول!', 'le champ vide n\'accepte pas'),
(253, 'successfully_changed_password', 'Successfully changed password.', 'تم تغيير كلمة المرور بنجاح.', 'mot de passe changé avec succès'),
(254, 'you_are_not_authorised_person', 'You are not authorised person !', 'أنت لست شخص مخول!', 'vous n\'êtes pas une personne autorisée'),
(255, 'password_and_repassword_does_not_match', 'Passwor and re-password does not match !', 'كلمة المرور وإعادة كلمة المرور غير متطابقتين!', 'le mot de passe et le mot de passe ne correspondent pas'),
(256, 'new_password_at_least_six_character', 'New Password At Least 6 Character.', 'كلمة مرور جديدة لا تقل عن 6 أحرف.', 'nouveau mot de passe au moins six caractères'),
(257, 'you_put_wrong_email_address', 'You put wrong email address !', 'لقد وضعت عنوان بريد إلكتروني خاطئ!', 'vous avez mis une mauvaise adresse e-mail'),
(258, 'cheque_ammount_asjusted', 'Cheque amount adjusted. ', 'تعديل مبلغ الشيك.', 'montant du chèque ajusté'),
(259, 'successfully_payment_paid', 'Successfully Payment Paid.', 'تم الدفع بنجاح.', 'paiement payé avec succès'),
(260, 'successfully_added', 'Successfully Added.', 'أضيف بنجاح.', 'ajouté avec succès'),
(261, 'successfully_updated_2_closing_ammount_not_changeale', 'Successfully Updated -2. Note: Closing Amount Not Changeable.', 'تم التحديث بنجاح -2. ملاحظة: مبلغ الإغلاق غير قابل للتغيير.', 'mis à jour avec succès 2 montant de clôture non modifiable'),
(262, 'successfully_payment_received', 'Successfully Payment Received.', 'تم استلام الدفعة بنجاح.', 'paiement reçu avec succès'),
(263, 'already_inserted', 'Already Inserted !', 'تم إدراجها بالفعل!', 'déjà inséré'),
(264, 'successfully_delete', 'Successfully Delete.', 'تم الحذف بنجاح.', 'supprimer avec succès'),
(265, 'successfully_created', 'Successfully Created.', 'تم إنشاؤه بنجاح.', 'créé avec succès'),
(266, 'logo_not_uploaded', 'Logo not uploaded !', 'لم يتم تحميل الشعار!', 'logo non téléchargé'),
(267, 'favicon_not_uploaded', 'Favicon not uploaded !', 'لم يتم تحميل الأيقونة المفضلة!', 'favicon non téléchargé'),
(268, 'supplier_mobile', 'Supplier Mobile', 'جوال المورد', 'fournisseur mobile'),
(269, 'supplier_address', 'Supplier Address', 'عنوان المورد', 'adresse du fournisseur'),
(270, 'supplier_details', 'Supplier Details', 'تفاصيل المورد', 'détails du fournisseur'),
(271, 'add_new_supplier', 'Add New Supplier', 'إضافة مورد جديد', 'ajouter un nouveau fournisseur'),
(272, 'manage_suppiler', 'Manage Supplier', 'إدارة المورد', 'gérer le fournisseur'),
(273, 'manage_your_supplier', 'Manage your supplier', 'إدارة المورد الخاص بك', 'gérer votre fournisseur'),
(274, 'manage_supplier_ledger', 'Manage supplier ledger', 'إدارة دفتر الأستاذ لللمورد', 'gérer le registre des fournisseurs'),
(275, 'invoice_id', 'Invoice ID', 'هوية صوتية', 'identifiant de facture'),
(276, 'deposit_id', 'Deposite ID', 'معرف المودع', 'identifiant de dépôt'),
(277, 'supplier_actual_ledger', 'Supplier Actual Ledger', 'دفتر الاستاذ الفعلي للمورد', 'grand livre réel du fournisseur'),
(278, 'supplier_information', 'Supplier Information', 'معلومات المورد', 'informations fournisseur'),
(279, 'event', 'Event', 'الجدث', 'un événement'),
(280, 'add_new_received', 'Add New Income', 'أضف دخل جديد', 'ajouter nouveau reçu'),
(281, 'add_payment', 'Add Payment', 'إضافة الدفع', 'ajouter un paiement'),
(282, 'add_new_payment', 'Add New Payment', 'إضافة دفعة جديدة', 'ajouter un nouveau paiement'),
(283, 'total_received_ammount', 'Total Received Amount', 'إجمالي المبلغ المستلم', 'montant total reçu'),
(284, 'create_new_invoice', 'Create New Invoice', 'إنشاء فاتورة جديدة', 'créer une nouvelle facture'),
(285, 'create_pos_invoice', 'Create POS Invoice', 'إنشاء فاتورة نقاط البيع', 'créer une facture pos'),
(286, 'total_profit', 'Total Profit', 'اجمالي الربح', 'bénéfice total'),
(287, 'monthly_progress_report', 'Monthly Progress Report', 'تقرير الإنجاز الشهري', 'rapport d\'avancement mensuel'),
(288, 'total_invoice', 'Total Invoice', 'إجمالي الفاتورة', 'facture totale'),
(289, 'account_summary', 'Account Summary', 'ملخص الحساب', 'relevé de compte'),
(290, 'total_supplier', 'Total Supplier', 'إجمالي المورد', 'fournisseur total'),
(291, 'total_product', 'Total Product', 'إجمالي المنتج', 'produit total'),
(292, 'total_customer', 'Total Customer', 'إجمالي العميل', 'client total'),
(293, 'supplier_edit', 'Supplier Edit', 'تحرير المورد', 'fournisseur modifier'),
(294, 'add_new_invoice', 'Add New Invoice', 'إضافة فاتورة جديدة', 'ajouter une nouvelle facture'),
(295, 'add_new_purchase', 'Add new purchase', 'إضافة شراء جديد', 'ajouter un nouvel achat'),
(296, 'currency', 'Currency', 'عملة', 'devise'),
(297, 'currency_position', 'Currency Position', 'وضع العملة', 'Position de la devise'),
(298, 'left', 'Left', 'اليسار', 'la gauche'),
(299, 'right', 'Right', 'اليمين', 'droit'),
(300, 'add_tax', 'Add Tax', 'أضف ضريبة', 'ajouter une taxe'),
(301, 'manage_tax', 'Manage Tax', 'إدارة الضرائب', 'gérer les impôts'),
(302, 'add_new_tax', 'Add new tax', 'أضف ضريبة جديدة', 'ajouter une nouvelle taxe'),
(303, 'enter_tax', 'Enter Tax', 'أدخل الضريبة', 'saisir la taxe'),
(304, 'already_exists', 'Already Exists !', 'موجود أصلا !', 'existe déjà'),
(305, 'successfully_inserted', 'Successfully Inserted.', 'تم الإدراج بنجاح.', 'inséré avec succès'),
(306, 'tax', 'Tax', 'ضريبة', 'impôt'),
(307, 'tax_edit', 'Tax Edit', 'تحرير الضرائب', 'taxe modifier'),
(308, 'product_not_added', 'Product not added !', 'المنتج غير مضاف!', 'produit non ajouté'),
(309, 'total_tax', 'Total Tax', 'مجموع الضريبة', 'taxe total'),
(310, 'manage_your_supplier_details', 'Manage your supplier details.', 'إدارة تفاصيل المورد الخاص بك.', 'gérer les coordonnées de vos fournisseurs'),
(311, 'invoice_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s                                       standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان Lorem Ipsum هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة.', 'description de la facture'),
(312, 'thank_you_for_choosing_us', 'Thank you very much for choosing us.', 'شكرا جزيلا لاختيارك لنا.', 'Merci de nous avoir choisi'),
(313, 'billing_date', 'Billing Date', 'تاريخ الفواتير', 'date de facturation'),
(314, 'billing_to', 'Billing To', 'إعداد الفواتير ل', 'facturer à'),
(315, 'billing_from', 'Billing From', 'الفواتير من', 'facturation à partir de'),
(316, 'you_cant_delete_this_product', 'Sorry !!  You can\'t delete this product.This product already used in calculation system!', 'آسف !! لا يمكنك حذف هذا المنتج. !', 'vous ne pouvez pas supprimer ce produit'),
(317, 'old_customer', 'Old Customer', 'عميل قديم', 'ancien client'),
(318, 'new_customer', 'New Customer', 'عميل جديد', 'nouveau client'),
(319, 'new_supplier', 'New Supplier', 'مزود جديد', 'nouveau fournisseur'),
(320, 'old_supplier', 'Old Supplier', 'المورد القديم', 'ancien fournisseur'),
(321, 'credit_customer', 'Credit Customer', 'عميل الائتمان', 'crédit client'),
(322, 'account_already_exists', 'This Account Already Exists !', 'هذا الحساب موجود بالفعل !', 'Le compte existe déjà'),
(323, 'edit_received', 'Edit Received', 'تم استلام التحرير', 'modification reçue'),
(324, 'you_are_not_access_this_part', 'You can not access this part !', 'لا يمكنك الوصول إلى هذا الجزء', 'vous n\'accédez pas à cette partie'),
(325, 'account_edit', 'Account Edit', 'تحرير الحساب', 'modifier le compte'),
(326, 'due', 'Due', 'بسبب', 'exigible'),
(327, 'payment_edit', 'Payment Edit', 'تحرير الدفع', 'paiement modifier'),
(328, 'please_select_customer', 'Please select customer !', 'الرجاء تحديد العميل!', 'veuillez sélectionner le client'),
(329, 'profit_report', 'Profit Report (Invoice Wise)', 'تقرير الربح (فلترة حسب الفاتورة)', 'rapport de profit'),
(330, 'total_profit_report', 'Total profit report', 'تقرير إجمالي الربح', 'rapport sur le bénéfice total'),
(331, 'please_enter_valid_captcha', 'Please enter valid captcha.', 'الرجاء إدخال كلمة التحقق الصالحة.', 'veuillez saisir un captcha valide'),
(332, 'category_not_selected', 'Category not selected.', 'لم يتم تحديد الفئة.', 'catégorie non sélectionnée'),
(333, 'supplier_not_selected', 'Supplier not selected.', 'المورد غير محدد.', 'fournisseur non sélectionné'),
(334, 'please_select_product', 'Please select product.', 'الرجاء تحديد المنتج.', 'veuillez sélectionner le produit'),
(335, 'product_model_already_exist', 'Product model already exist or file format is not correct !', 'نموذج المنتج موجود بالفعل أو تنسيق الملف غير صحيح!', 'le modèle de produit existe déjà'),
(336, 'invoice_logo', 'Invoice Logo', 'شعار الفاتورة', 'logo de la facture'),
(337, 'available_quantity', 'Ava. Qnty', 'متوسط الكمية', 'quantité disponible'),
(338, 'customer_details', 'Customer details', 'تفاصيل العميل', 'Détails du client'),
(339, 'manage_customer_details', 'Manage customer details.', 'إدارة تفاصيل العميل.', 'gérer les détails des clients'),
(340, 'site_key', 'Captcha Site Key', 'مفتاح موقع كلمة التحقق', 'clé du site'),
(341, 'secret_key', 'Secret Key', 'المفتاح السري', 'clef secrète'),
(342, 'captcha', 'Captcha', 'كلمة التحقق', 'captcha'),
(343, 'manage_your_credit_customer', 'Manage your credit  customer', 'إدارة عميل الائتمان الخاص بك', 'gérer votre crédit client'),
(344, 'barcode_qrcode', 'Barcode/Qrcode', 'رمز باركود / رمر الاستجابة السريعة', 'code à barres qrcode'),
(345, 'barcode_qrcode_scan_here', 'Barcode OR QR code scan here ', 'مسح الباركود أو رمز الاستجابة السريعة هنا', 'scannez le code-barres qrcode ici'),
(346, 'please_add_walking_customer_for_default_customer', 'You are delete walking customer.Please add walking customer for default customer.', 'أنت تحذف عميل مغادر الرجاء إضافة عميل مغادر للعميل الافتراضي.', 'veuillez ajouter un client ambulant pour le client par défaut'),
(347, 'stock_report_supplier_wise', 'Stock Report (Supplier Wise)', 'تقرير المخزون (فلترة حسب المورد)', 'fournisseur de rapport de stock avisé'),
(348, 'stock_report_product_wise', 'Stock Report (Product Wise)', 'تقرير المخزون (فلترة حسب المنتج)', 'rapport de stock par produit'),
(349, 'in_ctn', 'In Ctn.', 'داخل Ctn', 'en ctn'),
(350, 'out_ctn', 'Out Ctn.', 'خارج Ctn', 'sur ctn'),
(351, 'select_supplier', 'Select Supplier', 'حدد المورد', 'sélectionner le fournisseur'),
(352, 'in_quantity', 'In Qnty', 'في الكمية', 'en quantité'),
(353, 'out_quantity', 'Out Qnty', 'خارج الكمية', 'quantité'),
(354, 'in_taka', 'In Taka', 'في تاكا', 'en taka'),
(355, 'out_taka', 'Out Taka', 'خارج تاكا', 'hors taka'),
(356, 'select_product', 'Select Product', 'حدد المنتج', 'sélectionner un produit'),
(357, 'data_synchronizer', 'Data Synchronizer', 'مزامنة البيانات', 'synchroniseur de données'),
(358, 'synchronize', 'Synchronizer', 'المزامن', 'synchroniser'),
(359, 'backup_restore', 'Backup Restore', 'اسنرجاع البيانات', 'restauration de sauvegarde'),
(360, 'synchronizer_setting', 'Synchronizer Setting', 'إعداد المزامن', 'réglage du synchroniseur'),
(361, 'hostname', 'Hostname', 'اسم المضيف', 'nom d\'hôte'),
(362, 'user_name', 'User Name', 'اسم االمستخدم', 'Nom d\'utilisateur'),
(363, 'ftp_port', 'FTP Port', 'منفذ بروتوكول نقل الملفات', 'port ftp'),
(364, 'ftp_debug', 'FTP Debug', 'تصحيح أخطاء بروتوكول نقل الملفات', 'débogage ftp'),
(365, 'project_root', 'Project Root', 'جذر المشروع', 'racine du projet'),
(366, 'internet_connection', 'Internet connection', 'اتصال بالإنترنت', 'connexion Internet'),
(367, 'outgoing_file', 'Outgoing file', 'ملف صادر', 'fichier sortant'),
(368, 'incoming_file', 'Incoming file', 'ملف وارد', 'fichier entrant'),
(369, 'available', 'Available', 'متوفرة', 'disponible'),
(370, 'not_available', 'Not Available', 'غير متوفر', 'indisponible'),
(371, 'data_upload_to_server', 'Data upload to server', 'تحميل البيانات إلى الخادم', 'téléchargement de données sur le serveur'),
(372, 'download_data_from_server', 'Download data from server', 'تنزيل البيانات من الخادم', 'télécharger les données du serveur'),
(373, 'data_import_to_database', 'Data import to database', 'استيراد البيانات إلى قاعدة البيانات', 'importation de données dans la base de données'),
(374, 'please_wait', 'Please wait', 'ارجوك انتظر', 'S\'il vous plaît, attendez'),
(375, 'ooops_something_went_wrong', 'Ooops something went wrong.', 'عفوًا ، حدث خطأ ما.', 'oups quelque chose s\'est mal passé'),
(376, 'ftp_setting', 'FTP setting', 'إعداد بروتوكول نقل الملفات', 'réglage ftp'),
(377, 'please_try_again', 'Please try again', 'حاول مرة اخرى', 'Veuillez réessayer'),
(378, 'save_successfully', 'Save successfully', 'حفظ بنجاح', 'sauvegarde réussie'),
(379, 'upload_successfully', 'Upload successfully', 'تحميل بنجاح', 'télécharger avec succès'),
(380, 'unable_to_upload_file_please_check_configuration', 'Unable to upload file.Please check configuration.', 'تعذر تحميل الملف. يرجى التحقق من التكوين.', 'impossible de télécharger le fichier, veuillez vérifier la configuration'),
(381, 'please_configure_synchronizer_settings', 'Please configure synchronizer settings', 'يرجى تكوين إعدادات المزامنة', 'veuillez configurer les paramètres du synchroniseur'),
(382, 'download_successfully', 'Download successfully', 'تم التنزيل بنجاح', 'télécharger avec succès'),
(383, 'unable_to_download_file_please_check_configuration', 'Unable to download file.Please check configuration.', 'تعذر تنزيل الملف. يرجى التحقق من التكوين.', 'impossible de télécharger le fichier, veuillez vérifier la configuration'),
(384, 'data_import_first', 'Data import first.', 'استيراد البيانات أولاً.', 'importer les données en premier'),
(385, 'data_import_successfully', 'Data import successfully', 'تم استيراد البيانات بنجاح', 'importation des données réussie'),
(386, 'unable_to_import_data_please_check_config_or_sql_file', 'Unable to import data.Please check config or sql file.', 'تعذر استيراد البيانات. يُرجى التحقق من ملف التكوين أو ملف SQL.', 'impossible d\'importer des données, veuillez vérifier le fichier de configuration ou sql'),
(387, 'database_backup', 'Database backup', 'النسخه الاحتياطيه لقاعدة البيانات', 'sauvegarde de la base de données'),
(388, 'file_information', 'File information', 'معلومات الملف', 'informations sur le fichier'),
(389, 'filename', 'Filename', 'اسم الملف', 'nom de fichier'),
(390, 'size', 'Size', 'مقاس', 'Taille'),
(391, 'backup_date', 'Backup date', 'تاريخ النسخ الاحتياطي', 'date de sauvegarde'),
(392, 'backup_now', 'Backup now', 'إعمل نسخة احتياطية الان', 'sauvegarder maintenant'),
(393, 'restore_now', 'Restore now', 'استعادة الآن', 'restaurer maintenant'),
(394, 'are_you_sure', 'Are you sure ?', 'هل أنت متأكد ؟', 'êtes-vous sûr'),
(395, 'download', 'Download', 'تحميل', 'Télécharger'),
(396, 'backup_successfully', 'Backup successfully', 'النسخ الاحتياطي بنجاح', 'sauvegarde réussie'),
(397, 'restore_successfully', 'Restore successfully', 'تمت الاستعادة بنجاح', 'restaurer avec succès'),
(398, 'delete_successfully', 'Delete successfully', 'تم الحذف بنجاح', 'supprimer avec succès'),
(399, 'backup_and_restore', 'Backup and Restore', 'النسخ الاحتياطي واستعادة', 'sauvegarde et restauration'),
(400, 'close', 'Close', 'قريب', 'proche'),
(401, 'import_product_csv', 'Import Product (CSV)', 'استيراد المنتج (CSV)', 'importer le produit csv'),
(402, 'upload_csv_file', 'Upload CSV File', 'تحميل ملف CSV', 'télécharger le fichier csv'),
(403, 'supplier_id', 'Supplier ID', 'معرف المورد', 'ID du fournisseur'),
(404, 'category_id', 'Category ID', 'معرف الفئة', 'identifiant de catégorie'),
(405, 'file_data_format_is_not_correct', 'File format or data is not correct ! Please flollow the instruction.', 'تنسيق الملف أو البيانات غير صحيحة! يرجى اتباع التعليمات.', 'le format des données du fichier n\'est pas correct'),
(406, 'add_unit', 'Add Unit', 'أضف وحدة', 'ajouter une unité'),
(407, 'manage_unit', 'Manage Unit', 'إدارة الوحدة', 'gérer l\'unité'),
(408, 'unit', 'Unit', 'وحدة', 'unité'),
(409, 'meter_m', 'Meter (M)', 'متر (م)', 'mètre m'),
(410, 'piece_pc', 'Piece (Pc)', 'قطعة ', 'pièce pc'),
(411, 'kilogram_kg', 'Kilogram (Kg)', 'كيلوغرام (كغ)', 'kilogramme kg'),
(412, 'select_unit', 'Select Unit', 'حدد الوحدة', 'sélectionner l\'unité'),
(413, 'no_tax', 'No Tax', 'لا ضرائب', 'pas de taxes'),
(414, 'suppler_email', 'Supplier Email', 'البريد الإلكتروني للمورد', 'e-mail du fournisseur'),
(415, 'csv_file_informaion', 'CSV File Information', 'معلومات ملف CSV', 'informations sur le fichier csv'),
(416, 'stock_quantity', 'Stock', 'الأوراق المالية', 'quantité en stock'),
(417, 'out_of_stock', 'Out Of Stock', 'إنتهى من المخزن', 'En rupture de stock'),
(418, 'phone', 'Phone', 'هاتف', 'téléphoner'),
(419, 'you_can_not_buy_greater_than_available_cartoon', 'You can not sell greater than available quantity.', 'لا يمكنك بيع أكثر من الكمية المتاحة.', 'vous ne pouvez pas acheter plus que le dessin animé disponible'),
(420, 'total_discount', 'Total Discount', 'إجمالي الخصم', 'Remise totale'),
(421, 'if_you_update_purchase_first_select_supplier_then_product_and_then_quantity', 'If you update purchase.First select supplier then product and quantity.', 'إذا قمت بتحديث الشراء ، حدد المورد أولاً ثم المنتج والكمية.', 'si vous mettez à jour l\'achat, sélectionnez d\'abord le fournisseur, puis le produit, puis la quantité'),
(422, 'others', 'Others', 'آخرون', 'les autres'),
(423, 'accounts_details_data', 'Accounts Details Data', 'بيانات تفاصيل الحسابات', 'données détaillées des comptes'),
(424, 'add_brand', 'Add Brand', 'أضف العلامة التجارية', 'ajouter une marque'),
(425, 'add_new_brand', 'Add new brand', 'أضف علامة تجارية جديدة', 'ajouter une nouvelle marque'),
(426, 'brand', 'Brand', 'ماركة', 'marque'),
(427, 'brand_image', 'Brand Image', 'صورة العلامة التجارية', 'image de marque'),
(428, 'brand_name', 'Brand Name', 'اسم العلامة التجارية', 'marque'),
(429, 'manage_brand', 'Manage Brand', 'إدارة العلامة التجارية', 'gérer la marque'),
(430, 'brand_edit', 'Brand Edit', 'تحرير العلامة التجارية', 'modifier la marque'),
(431, 'manage_your_brand', 'Manage your brand', 'إدارة علامتك التجارية', 'gérer votre marque'),
(432, 'are_you_sure_want_to_delete', 'Are you sure want to delete ?', 'هل أنت متأكد من أنك تريد الحذف؟', 'êtes-vous sûr de vouloir supprimer'),
(433, 'variant', 'Variant', 'متغير', 'une variante'),
(434, 'add_variant', 'Add Variant', 'أضف المتغير', 'ajouter une variante'),
(435, 'manage_variant', 'Manage Variant', 'إدارة المتغير', 'gérer la variante'),
(436, 'add_new_variant', 'Add New Variant', 'أضف متغير جديد', 'ajouter une nouvelle variante'),
(437, 'variant_name', 'Variant Name', 'اسم المتغير', 'nom de la variante'),
(438, 'variant_edit', 'Variant Edit', 'تحرير المتغير', 'variante modifier'),
(439, 'type', 'Type', 'نوع', 'taper'),
(440, 'image_large', 'Image Large', 'الصورة كبيرة', 'grande image'),
(441, 'onsale', 'Offer', 'يعرض', 'en soldes'),
(442, 'yes', 'Yes', 'نعم', 'oui'),
(443, 'no', 'No', 'الرقم', 'non'),
(444, 'featured', 'Featured', 'متميز', 'En vedette'),
(445, 'store_set', 'Store Set', 'مجموعة المتجر', 'ensemble de magasin'),
(446, 'store_add', 'Store Add', 'أضف المتجر', 'magasin ajouter'),
(447, 'store_product', 'Store Product', 'منتج المتجر', 'produit du magasin'),
(448, 'manage_store', 'Manage Store', 'إدارة المتجر', 'gérer le magasin'),
(449, 'add_store', 'Add Store', 'أضف المتجر', 'ajouter un magasin'),
(450, 'add_new_store', 'Add New Store', 'إضافة متجر جديد', 'ajouter un nouveau magasin'),
(451, 'store_name', 'Store Name', 'اسم المتجر', 'nom du magasin'),
(452, 'store_address', 'Store Address', 'عنوان المتجر', 'adresse du magasin'),
(453, 'manage_your_store', 'Manage your store', 'إدارة متجرك', 'gérer votre magasin'),
(454, 'store_edit', 'Store Edit', 'تحرير المتجر', 'magasin modifier'),
(455, 'store_product_transfer', 'Store Product Transfer', 'نقل المنتج من المتجر', 'transfert de produits en magasin'),
(456, 'manage_store_product', 'Manage Store Product', 'إدارة منتج المتجر', 'gérer le produit du magasin'),
(457, 'manage_your_store_product', 'Manage your store product', 'إدارة منتج متجرك', 'gérer le produit de votre magasin'),
(458, 'store_product_edit', 'Store Product Edit', 'تحرير المنتج المخزن', 'modifier le produit du magasin'),
(459, 'wearhouse_add', 'Warehouse Add', 'إضافة مستودع', 'entrepôt ajouter'),
(460, 'wearhouse_transfer', 'Warehouse Transfer', 'نقل المستودع', 'transfert d\'entrepôt'),
(461, 'manage_wearhouse', 'Manage Warehouse', 'إدارة المستودع', 'gérer l\'atelier'),
(462, 'wearhouse_set', 'Warehouse Set', 'اعدادات المستودع', 'ensemble d\'entrepôt'),
(463, 'add_wearhouse', 'Add Warehouse', 'إضافة مستودع', 'ajouter un atelier'),
(464, 'add_new_wearhouse', 'Add New Warehouse', 'إضافة مستودع جديد', 'ajouter un nouvel atelier'),
(465, 'wearhouse_name', 'Warehouse Name', 'اسم المستودع', 'nom de l\'entrepôt'),
(466, 'wearhouse_address', 'Warehouse Address', 'عنوان المستودع', 'adresse de l\'entrepôt'),
(467, 'manage_your_wearhouse', 'Manage your warehouse', 'إدارة المستودع الخاص بك', 'gérer votre entrepôt'),
(468, 'wearhouse_edit', 'Warehouse Edit', 'تحرير المستودع', 'modifier'),
(469, 'transfer_wearhouse_product', 'Transfer warehouse product', 'نقل منتج المستودعات', 'produit d\'usure de transfert'),
(470, 'transfer_to', 'Transfer To', 'حول إلى', 'Transférer à'),
(471, 'wearhouse', 'Warehouse', 'مستودع', 'atelier d\'habillement'),
(472, 'store', 'Store', 'متجر', 'boutique'),
(473, 'purchase_to', 'Purchase To', 'شراء ل', 'acheter à'),
(474, 'product_and_supplier_did_not_match', 'Product and supplier did not match.', 'المنتج والمورد غير متطابقين.', 'le produit et le fournisseur ne correspondaient pas'),
(475, 'please_select_wearhouse', 'Please select warehouse !', 'الرجاء تحديد المستودع!', 'veuillez sélectionner la maison de vêtements'),
(476, 'product_is_not_available_please_purchase_product', 'Product not available.Please purchase product.', 'المنتج غير متوفر الرجاء شراء المنتج', 'le produit n\'est pas disponible veuillez acheter le produit'),
(477, 'please_select_store', 'Please select store', 'الرجاء تحديد المتجر', 'veuillez sélectionner le magasin'),
(478, 'store_transfer', 'Store Transfer', 'تحويل المتجر', 'transfert de magasin'),
(479, 'add_new_unit', 'Add new unit', 'أضف وحدة جديدة', 'ajouter une nouvelle unité'),
(480, 'unit_name', 'Unit Name', 'إسم الوحدة', 'nom de l\'unité'),
(481, 'unit_short_name', 'Unit Short Name', 'اسم الوحدة المختصر', 'nom abrégé de l\'unité'),
(482, 'manage_your_unit', 'Manage your unit', 'إدارة وحدتك', 'gérer votre unité'),
(483, 'unit_edit', 'Unit Edit', 'تحرير الوحدة', 'modifier l\'unité'),
(484, 'gallery', 'Gallery', 'صالة عرض', 'Galerie'),
(485, 'add_image', 'Add Image', 'إضافة صورة', 'ajouter une image'),
(486, 'manage_image', 'Manage Image', 'إدارة الصورة', 'gérer l\'image'),
(487, 'add_new_image', 'Add new image', 'أضف صورة جديدة', 'ajouter une nouvelle image'),
(488, 'manage_gallery_image', 'Manage gallery image', 'إدارة صورة المعرض', 'gérer l\'image de la galerie'),
(489, 'image_edit', 'Image Edit', 'تحرير الصورة', 'retouche d\'image'),
(490, 'tax_name', 'Tax Name', 'الاسم الضريبي', 'nom fiscal'),
(491, 'manage_your_tax', 'Manage your tax', 'إدارة الضرائب الخاصة بك', 'gérer votre fiscalité'),
(492, 'tax_product_service', 'Tax Product Service', 'ضريبة خدمات المنتج', 'service produit fiscal'),
(493, 'add_tax_product_service', 'Add tax product service', 'إضافة خدمة المنتج الضريبي', 'ajouter un service de produit fiscal'),
(494, 'tax_percentage', 'Tax Percentage', 'نسبة الضريبة', 'pourcentage de taxe'),
(495, 'total_cgst', 'CGST', 'CGST', 'TCS total'),
(496, 'total_sgst', 'SGST', 'SGST', 'total sgst'),
(497, 'total_igst', 'IGST', 'IGST', 'consommation totale'),
(498, 'cat_image', 'Category Image', 'صورة الفئة', 'image de chat'),
(499, 'parent_category', 'Parent category', 'القسم الرئيسي', 'Catégorie Parentale'),
(500, 'top_menu', 'Top Menu', 'القائمة العلوية', 'menu principal'),
(501, 'menu_position', 'Menu Position', 'موقف القائمة', 'position du menu'),
(502, 'add_pos_invoice', 'Add POS Invoice', 'إضافة فاتورة نقاط البيع', 'ajouter une facture pos'),
(503, 'customer_address_1', 'Address 1', 'العنوان 1', 'adresse client 1'),
(504, 'customer_address_2', 'Address 2', 'العنوان 2', 'adresse client 2'),
(505, 'city', 'City', 'مدينة', 'ville'),
(506, 'state', 'State', 'ولاية', 'Etat'),
(507, 'country', 'Country', 'دولة', 'pays'),
(508, 'zip', 'Zip', 'ملف مضغوط', 'Zip *: français'),
(509, 'transection_type', 'Transection Type', 'نوع المقطع', 'Type de transaction'),
(510, 'product_ledger', 'Product Ledger', 'حساب المنتج', 'registre des produits'),
(511, 'transfer_report', 'Transfer Report', 'تقرير النقل', 'rapport de transfert'),
(512, 'store_to_store_transfer', 'Store To Store Transfer', 'تخزين لتخزين النقل', 'transfert de magasin à magasin'),
(513, 'to_store', 'To Store', 'للتخزين', 'ranger'),
(514, 'store_to_warehouse_transfer', 'Store To Warehouse Transfer', 'نقل من المخزن إلى المستودع', 'transfert de magasin à entrepôt'),
(515, 'warehouse_to_store_transfer', 'Warehouse To Store Transfer', 'مستودع لتخزين النقل', 'transfert d\'entrepôt à magasin'),
(516, 't_wearhouse', 'To Wearhouse', 'إلى المستودع', 't usure'),
(517, 'warehouse_to_warehouse_transfer', 'Warehouse To Warehouse Transfer', 'نقل من مستودع إلى المستودع', 'transfert d\'entrepôt à entrepôt'),
(518, 'shop_manager', 'Shop Manager', 'مدير متجر', 'gérant d\'un magasin'),
(519, 'sales_man', 'Sales Man', 'مندوب مبيعات', 'vendeur'),
(520, 'store_keeper', 'Store Keeper', 'امين المخزن', 'magasinier'),
(521, 'item', 'Item', 'غرض', 'Objet'),
(522, 'qnty', 'Qnty', 'الكمية', 'quantité'),
(523, 'first', 'First', 'أولا', 'première'),
(524, 'last', 'Last', 'الاخير', 'dernière'),
(525, 'next', 'Next', 'التالي', 'Suivant'),
(526, 'prev', 'Previous', 'سابق', 'précédent'),
(527, '1', '1', '1', '1'),
(528, '2', '2', '2', '2'),
(529, '3', '3', '3', '3'),
(530, 'web_store', 'Web Store', 'متجر على شبكة الإنترنت', 'magasin en ligne'),
(531, 'brand_id', 'Brand ID', 'معرف العلامة التجارية', 'identifiant de la marque'),
(532, 'variant_id', 'Variant ID', 'معرف المتغير', 'ID de variante'),
(533, 'items', 'Items', 'العناصر', 'éléments'),
(534, 'print_order', 'Print Order', 'طلب طباعة', 'ordre d\'impression'),
(535, 'print_bill', 'Print Bill', 'طباعة الفاتورة', 'facture d\'impression'),
(536, 'unpaid', 'Unpaid', 'غير مدفوعة', 'non payé'),
(537, 'paid', 'Paid', 'مدفوع', 'payé'),
(538, 'product_discount', 'Product Discount', 'خصم المنتج', 'Remise sur le produit'),
(539, 'invoice_discount', 'Invoice Discount', 'خصم الفاتورة', 'escompte sur facture'),
(540, 'terminal', 'Terminal', 'صالة', 'Terminal'),
(541, 'manage_terminal', 'Manage Terminal', 'إدارة المحطة', 'gérer la borne'),
(542, 'add_terminal', 'Add Terminal', 'أضف المحطة الطرفية', 'ajouter un terminal'),
(543, 'add_new_terminal', 'Add new terminal', 'إضافة محطة جديدة', 'ajouter un nouveau terminal'),
(544, 'customer_care_phone_no', 'Customer Care Phone No', 'رقم هاتف خدمة العملاء', 'numéro de téléphone du service client'),
(545, 'terminal_bank_account', 'Terminal Bank Account', 'حساب بنكي لمحطة الدفع', 'compte bancaire terminal'),
(546, 'terminal_company', 'Terminal Company', 'شركة محطة الدفع', 'compagnie terminale'),
(547, 'terminal_name', 'Terminal Name', 'اسم محطة الدفع', 'nom de la borne'),
(548, 'manage_your_terminal', 'Manage your terminal', 'إدارة محطة الدفع الخاصة بك', 'gérer votre borne'),
(549, 'terminal_edit', 'Terminal Edit', 'تحرير محطة الدفع', 'édition terminale'),
(550, 'full_paid', 'Full Paid', 'مدفوعة بالكامل', 'entièrement payé'),
(551, 'card_no', 'Card NO', 'لا بطاقة', 'numéro de carte'),
(552, 'card_type', 'Card Type', 'نوع البطاقة', 'type de carte'),
(553, 'tax_report_product_wise', 'Tax Report (Product Wise)', 'التقرير الضريبي (فلترة حسب المنتج)', 'déclaration de revenus par produit'),
(554, 'tax_report_invoice_wise', 'Tax Report (Invoice Wise)', 'التقرير الضريبي (فلترة حسب الفاتورة)', 'rapport fiscal sage facture'),
(555, 'software_settings', 'Software Settings', 'إعدادات البرنامج', 'paramètres du logiciel'),
(556, 'social_link', 'Social Link', 'الرابط الاجتماعي', 'lien social'),
(557, 'advertisement', 'Advertisement', 'الإعلانات', 'publicité'),
(558, 'contact_form', 'Contact Form', 'نموذج الاتصال', 'formulaire de contact'),
(559, 'update_your_social_link', 'Update your social link', 'قم بتحديث الرابط الاجتماعي الخاص بك', 'mettre à jour votre lien social'),
(560, 'facebook', 'Facebook', 'موقع التواصل الاجتماعي الفيسبوك', 'Facebook'),
(561, 'instagram', 'Instagram', 'انستغرام', 'Instagram'),
(562, 'linkedin', 'Linkedin', 'لينكد إن', 'LinkedIn'),
(563, 'twitter', 'Twitter', 'تويتر', 'Twitter'),
(564, 'youtube', 'Youtube', 'يوتيوب', 'Youtube'),
(565, 'message', 'Message', 'رسالة', 'message'),
(566, 'manage_contact', 'Manage contact', 'إدارة الاتصال', 'gérer les contacts'),
(567, 'manage_your_contact', 'Manage your contact', 'إدارة جهة الاتصال الخاصة بك', 'gérer vos contacts'),
(568, 'update_contact_form', 'Update contact form', 'تحديث نموذج الاتصال', 'mettre à jour le formulaire de contact'),
(569, 'update_your_contact_form', 'Update your contact form', 'قم بتحديث نموذج الاتصال الخاص بك', 'mettre à jour votre formulaire de contact'),
(570, 'update_your_web_settings', 'Update your web setting', 'قم بتحديث إعدادات الويب الخاصة بك', 'mettre à jour vos paramètres Web'),
(571, 'google_map', 'Google Map', 'خرائط جوجل', 'Google Map'),
(572, 'about_us', 'About Us', 'معلومات عنا', 'à propos de nous'),
(573, 'privacy_policy', 'Privacy Policy', 'سياسة الخصوصية', 'politique de confidentialité'),
(574, 'terms_condition', 'Terms and condition', 'أحكام وشروط', 'termes et conditions'),
(575, 'cat_icon', 'Category Icon', 'رمز الفئة', 'icône de chat'),
(576, 'add_slider', 'Add Slider', 'أضف شريط التمرير', 'ajouter un curseur'),
(577, 'manage_slider', 'Manage Slider', 'إدارة شريط التمرير', 'gérer le curseur'),
(578, 'update_your_slider', 'Update your slider', 'قم بتحديث شريط التمرير الخاص بك', 'mettre à jour votre curseur'),
(579, 'slider_link', 'Slider Link', 'رابط شريط التمرير', 'lien curseur'),
(580, 'slider_image', 'Slider Image', 'صورة شريط التمرير', 'image de curseur'),
(581, 'slider_position', 'Slider Position', 'موقع شريط التمرير', 'position du curseur'),
(582, 'update_slider', 'Update Slider', 'تحديث شريط التمرير', 'curseur de mise à jour'),
(583, 'manage_your_slider', 'Manage your slider', 'إدارة شريط التمرير الخاص بك', 'gérer votre curseur'),
(584, 'successfully_inactive', 'Successfully Inactive', 'غير نشط بنجاح', 'inactif avec succès'),
(585, 'successfully_active', 'Successfully active', 'نشط بنجاح', 'actif avec succès'),
(586, 'embed_code', 'Embed Code', 'كود التضمين', 'code intégré'),
(587, 'image_ads', 'Image Ads', 'الإعلانات المصورة', 'annonces illustrées'),
(588, 'url', 'URL', 'الراببط', 'URL'),
(589, 'add_advertise', 'Add Advertisement', 'أضف إعلان', 'ajouter de la publicité'),
(590, 'add_new_advertise', 'Add new advertisement', 'أضف إعلان جديد', 'ajouter une nouvelle annonce'),
(591, 'add_type', 'Ads Type', 'نوع الاعلانات', 'ajouter un type'),
(592, 'ads_position', 'Ads Position', 'موقف الإعلانات', 'position des annonces'),
(593, 'add_page', 'Add Page', 'إضافة صفحة', 'ajouter une page'),
(594, 'ads_position_already_exists', 'Ads position already exists!', 'موضع الإعلانات موجود بالفعل!', 'la position des annonces existe déjà'),
(595, 'manage_advertise', 'Manage Advertise', 'إدارة الإعلان', 'gérer la publicité'),
(596, 'manage_advertise_information', 'Manage advertise information', 'إدارة معلومات الإعلان', 'gérer les informations publicitaires'),
(597, 'update_advertise', 'Update Advertise', 'تحديث الاعلان', 'mettre à jour la publicité'),
(598, 'add_block', 'Add Block', 'اضافة خانة', 'bloc publicitaire'),
(599, 'manage_block', 'Manage Block', 'إدارة خانة', 'gérer le bloc'),
(600, 'block_position', 'Block Position', 'موقف الخانة', 'poste de bloc'),
(601, 'block_style', 'Block Style', 'نمط الخانة', 'style de bloc'),
(602, 'block_css', 'Block Css', 'خانة Css', 'bloc css'),
(603, 'add_new_block', 'Add new block', 'إضافة خانة جديدة', 'ajouter un nouveau bloc'),
(604, 'block', 'Block', 'خانة', 'bloquer'),
(605, 'manage_your_block', 'Manage your block', 'إدارة الخانة الخاصة بك', 'gérer votre bloc'),
(606, 'block_edit', 'Block Edit', 'تحرير الخانة', 'bloquer la modification');
INSERT INTO `language` (`id`, `phrase`, `english`, `arabic`, `franais`) VALUES
(607, 'add_product_review', 'Add Product Review', 'إضافة مراجعة المنتج', 'ajouter un avis sur le produit'),
(608, 'manage_product_review', 'Manage Product Review', 'إدارة مراجعة المنتج', 'gérer l\'examen des produits'),
(609, 'product_review', 'Product Review', 'تقييم المنتج', 'évaluation du produit'),
(610, 'comments', 'Comments', 'تعليقات', 'commentaires'),
(611, 'reviewer_name', 'Reviewer Name', 'اسم المراجع', 'nom de l\'examinateur'),
(612, 'product_review_edit', 'Product Review Edit', 'تحرير مراجعة المنتج', 'revue de produit modifier'),
(613, 'add_subscriber', 'Add Subscriber', 'إضافة مشترك', 'ajouter un abonné'),
(614, 'add_new_subscriber', 'Add new subscriber', 'إضافة مشترك جديد', 'ajouter un nouvel abonné'),
(615, 'subscriber', 'Subscriber', 'مشترك', 'abonné'),
(616, 'manage_subscriber', 'Manage Subscriber', 'إدارة المشترك', 'gérer l\'abonné'),
(617, 'manage_your_subscriber', 'Manage your subscriber', 'إدارة المشترك الخاص بك', 'gérer votre abonné'),
(618, 'subscriber_update', 'Subscriber Update', 'تحديث المشترك', 'mise à jour de l\'abonné'),
(619, 'apply_ip', 'Apply IP', 'تطبيق IP', 'appliquer l\'ip'),
(620, 'add_wishlist', 'Add Wishlist', 'أضف قائمة الرغبات', 'ajouter une liste de souhaits'),
(621, 'add_new_wishlist', 'Add new wishlist', 'أضف قائمة أمنيات جديدة', 'ajouter une nouvelle liste de souhaits'),
(622, 'wishlist', 'Wishlist', 'قائمة الرغبات', 'liste de souhaits'),
(623, 'manage_wishlist', 'Manage Wishlist', 'إدارة قائمة الرغبات', 'gérer la liste de souhaits'),
(624, 'manage_your_wishlist', 'Manage your wishlist', 'إدارة قائمة الرغبات الخاصة بك', 'gérer votre liste de souhaits'),
(625, 'add_web_footer', 'Add Web Footer', 'إضافة تذييل الويب', 'ajouter un pied de page Web'),
(626, 'manage_web_footer', 'Manage Web Footer', 'إدارة تذييل الويب', 'gérer le pied de page Web'),
(627, 'headlines', 'Headlines', 'العناوين', 'titres'),
(628, 'position', 'Position', 'موقع', 'position'),
(629, 'add_new_web_footer', 'Add new footer', 'إضافة تذييل جديد', 'ajouter un nouveau pied de page Web'),
(630, 'web_footer', 'Web Footer', 'تذييل الويب', 'pied de page web'),
(631, 'web_footer_update', 'Web Footer Update', 'تحديث تذييل الويب', 'mise à jour du pied de page Web'),
(632, 'manage_your_web_footer', 'Manage your web footer.', 'إدارة تذييل الويب الخاص بك.', 'gérer votre pied de page Web'),
(633, 'add_link_page', 'Add Link Page', 'أضف صفحة الارتباط', 'ajouter une page de lien'),
(634, 'manage_link_page', 'Manage Link Page', 'إدارة صفحة الارتباط', 'gérer la page de liens'),
(635, 'add_new_link_page', 'Add new link page', 'إضافة صفحة ارتباط جديدة', 'ajouter une nouvelle page de lien'),
(636, 'link_page_update', 'Link Page Update', 'تحديث صفحة الارتباط', 'mise à jour de la page de liens'),
(637, 'manage_your_link_page', 'Manage your link page', 'إدارة صفحة الارتباط الخاصة بك', 'gérer votre page de liens'),
(638, 'link_page', 'Link Page', 'صفحة الارتباط', 'page de lien'),
(639, 'add_coupon', 'Add Coupon', 'أضف عرض', 'ajouter un coupon'),
(640, 'manage_coupon', 'Manage Coupon', 'إدارة القسيمة', 'gérer le coupon'),
(641, 'coupon_name', 'Coupon Name', 'اسم القسيمة', 'nom du coupon'),
(642, 'coupon_discount_code', 'Coupon Discount Code', 'كود خصم القسيمة', 'code de réduction'),
(643, 'discount_amount', 'Discount Amount', 'مقدار الخصم', 'montant de la remise'),
(644, 'discount_percentage', 'Discount Percentage', 'نسبة الخصم', 'pourcentage de remise'),
(645, 'coupon', 'Coupon', 'قسيمة', 'coupon'),
(646, 'add_new_coupon', 'Add new coupon', 'أضف قسيمة جديدة', 'ajouter un nouveau coupon'),
(647, 'discount_type', 'Discount Type', 'نوع الخصم', 'type de remise'),
(648, 'coupon_update', 'Coupon Update', 'تحديث القسيمة', 'mise à jour du coupon'),
(649, 'manage_your_coupon', 'Manage your coupon', 'إدارة القسيمة الخاصة بك', 'gérer votre coupon'),
(650, 'onsale_price', 'Offer Price', 'سعر العرض', 'prix de vente'),
(651, 'download_sample_file', 'Download sample file', 'تنزيل نموذج للملف', 'télécharger un exemple de fichier'),
(652, 'quotation', 'Quotation', 'عرض سعر', 'devis'),
(653, 'new_quotation', 'New Quotation', 'اقتباس جديد', 'nouveau devis'),
(654, 'manage_quotation', 'Manage Quotation', 'إدارة الاقتباس', 'gérer le devis'),
(655, 'add_new_quotation', 'Add new quotation', 'أضف اقتباس جديد', 'ajouter un nouveau devis'),
(656, 'quotation_no', 'Quotation No', 'عرض سعر رقم', 'devis non'),
(657, 'manage_your_quotation', 'Manage your quotation', 'إدارة الاقتباس الخاص بك', 'gérer votre devis'),
(658, 'quotation_update', 'Quotation Update', 'تحديث عرض السعر', 'mise à jour du devis'),
(659, 'quotation_details', 'Quotation Details', 'تفاصيل عرض السعر', 'détails du devis'),
(660, 'quotation_from', 'Quotation Form', 'شكل عرض السعر', 'citation de'),
(661, 'quotation_date', 'Quotation Date', 'تاريخ عرض السعر', 'date de cotation'),
(662, 'quotation_to', 'Quotation To', 'عرض سعر لـِ', 'citation à'),
(663, 'invoiced', 'Invoiced', 'مفوترة', 'facturé'),
(664, 'order', 'Order', 'الطلبات', 'ordre'),
(665, 'new_order', 'New Order', 'طلب جديد', 'nouvelle commande'),
(666, 'manage_order', 'Manage Order', 'إدارة الطلب', 'gérer la commande'),
(667, 'order_no', 'Order No', 'رقم الطلب', 'n ° de commande'),
(668, 'order_date', 'Order Date', 'تاريخ الطلب', 'date de commande'),
(669, 'order_to', 'Order To', 'ترتيب ل', 'commander à'),
(670, 'order_from', 'Order From', 'طلب من', 'ordre de'),
(671, 'order_details', 'Order Details', 'تفاصيل الطلب', 'détails de la commande'),
(672, 'order_update', 'Order Update', 'تحديث الطلب', 'mise à jour de la commande'),
(673, 'best_sale', 'Best Sale', 'الافضل مبيعا', 'meilleure vente'),
(674, 'call_us', 'CALL US', 'اتصل بنا', 'appelez-nous'),
(675, 'sign_up', 'Sign Up', 'اشتراك', 'S\'inscrire'),
(676, 'contact_us', 'Contact Us', 'اتصل بنا', 'Nous contacter'),
(677, 'category_product_not_found', 'Opps !!!  product not found !', 'عفوا !!! الصنف غير موجود !', 'produit de catégorie introuvable'),
(678, 'sign_up_for_news_and', 'Sign up for news and ', 'اشترك للحصول على الأخبار و', 'inscrivez-vous pour recevoir des nouvelles et'),
(679, 'offers', 'Offers', 'عروض', 'des offres'),
(680, 'you_may_unsubscribe_at_any_time', 'You may unsubscribe at any time', 'يمكنك إلغاء الاشتراك في أي وقت', 'Vous pouvez vous désinscrire à n\'importe quel moment'),
(681, 'enter_your_email', 'Enter your email.', 'أدخل بريدك الإلكتروني.', 'entrer votre Email'),
(682, 'product_size', 'Product Size', 'حجم المنتج', 'taille du produit'),
(683, 'product_type', 'Product Type', 'نوع المنتج', 'type de produit'),
(684, 'availability', 'Availability', 'التوفر', 'disponibilité'),
(685, 'price_of_product', 'Price Of Product', 'سعر المنتج', 'prix du produit'),
(686, 'in_stock', 'In Stock', 'في الأوراق المالية', 'en stock'),
(687, 'related_products', 'Related Products', 'منتجات ذات صله', 'Produits connexes'),
(688, 'review', 'Review', 'إعادة النظر', 'examen'),
(689, 'tag', 'Tag', 'الكلمات الدالة', 'étiquette'),
(690, 'specification', 'Specifications', 'مواصفات', 'spécification'),
(691, 'search_product_name_here', 'Search product name here...', 'ابحث عن اسم المنتج هنا ...', 'rechercher le nom du produit ici'),
(692, 'all_categories', 'All Categories', 'جميع الفئات', 'toutes catégories'),
(693, 'best_sales', 'Best Sales', 'أفضل المبيعات', 'Meilleures ventes'),
(694, 'price_range', 'Price Range', 'نطاق السعر', 'échelle des prix'),
(695, 'see_more', 'See More', 'شاهد المزيد', 'voir plus'),
(696, 'add_to_cart', 'Add To Cart', 'أضف إلى السلة', 'Ajouter au panier'),
(697, 'create_your_account', 'Create Your Account', 'أنشئ حسابك', 'Créez votre compte'),
(698, 'create_account', 'Create Account', 'إنشاء حساب', 'créer un compte'),
(699, 'you_have_successfully_signup', 'You have successfully sign up.', 'لقد قمت بالتسجيل بنجاح.', 'vous avez réussi à vous inscrire'),
(700, 'you_have_not_sign_up', 'You have not sign up.', 'لم تقم بالتسجيل.', 'tu ne t\'es pas inscrit'),
(701, 'i_have_forgotten_my_password', 'I Have Forgotten My Password', 'لقد نسيت كلمة السر', 'J\'ai oublié mon mot de passe'),
(702, 'login_successfully', 'Login Successfully', 'تم تسجيل الدخول بنجاح', 'connectez-vous avec succès'),
(703, 'you_are_not_authorised', 'You are not authorised Person !', 'أنت لست مخول!', 'tu n\'es pas autorisé'),
(704, 'customer_profile', 'Customer Profile', 'ملف الزائر', 'Profil client'),
(705, 'total_order', 'Total Order', 'كامل الطلب', 'commande totale'),
(706, 'add_currency', 'Add Currency', 'أضف العملة', 'ajouter une devise'),
(707, 'manage_currency', 'Manage Currency', 'إدارة العملة', 'gérer la monnaie'),
(708, 'add_new_currency', 'Add new currency', 'أضف عملة جديدة', 'ajouter une nouvelle devise'),
(709, 'currency_name', 'Currency Name', 'اسم العملة', 'nom de la devise'),
(710, 'currency_icon', 'Currency Icon', 'رمز العملة', 'icône de devise'),
(711, 'conversion_rate', 'Conversion Rate', 'معدل التحويل', 'taux de conversion'),
(712, 'default_status', 'Default Status', 'الوضع الافتراضي', 'statut par défaut'),
(713, 'default_store_already_exists', 'Default store already exists !', 'المخزن الافتراضي موجود بالفعل!', 'le magasin par défaut existe déjà'),
(714, 'currency_edit', 'Currency Edit', 'تحرير العملة', 'devise modifier'),
(715, 'manage_your_currency', 'Manage your currency', 'إدارة عملتك', 'gérer votre devise'),
(716, 'review_this_product', 'Review This Product', 'مراجعة هذا المنتج', 'évaluer ce produit'),
(717, 'page', 'Page', 'صفحة', 'page'),
(718, 'delivery_info', 'Delivery Info', 'معلومات التوصيل', 'informations de livraison'),
(719, 'terms_and_condition', 'Terms And Condition', 'أحكام وشروط', 'termes et conditions'),
(720, 'help', 'Help', 'مساعدة', 'aider'),
(721, 'get_in_touch', 'Get In Touch', 'ابقى على تواصل', 'entrer en contact'),
(722, 'write_your_msg_here', 'Write your msg here', 'اكتب رسالتك هنا', 'Ecrivez votre message ici'),
(723, 'add_about_us', 'Add About Us', 'أضف معلومات عنا', 'ajouter à propos de nous'),
(724, 'add_new_about_us', 'Add new about us', 'أضف جديد عنا', 'ajouter nouveau à propos de nous'),
(725, 'manage_about_us', 'Manage About Us', 'إدارة معلومات عنا', 'gérer à propos de nous'),
(726, 'manage_your_about_us', 'Manage your about us', 'إدارة معلوماتك عنا ', 'gérer votre à propos de nous'),
(727, 'about_us_update', 'About Us Update', 'تحديث من نحن ', 'à propos de nous'),
(728, 'position_already_exists', 'Position Already Exists !', 'الحالة موجودة بالفعل!', 'le poste existe déjà'),
(729, 'why_choose_us', 'Why Choose US', 'لماذا أخترتنا', 'Pourquoi nous choisir'),
(730, 'our_location', 'Our Location', 'موقعنا', 'Notre emplacement'),
(731, 'add_our_location', 'Add Our Location', 'أضف موقعنا', 'ajouter notre emplacement'),
(732, 'add_new_our_location', 'Add new our location', 'أضف موقعنا الجديد', 'ajouter nouveau notre emplacement'),
(733, 'manage_our_location', 'Manage Our Location', 'إدارة موقعنا', 'gérer notre emplacement'),
(734, 'our_location_update', 'Our Location Update', 'تحديث موقعنا', 'notre mise à jour de localisation'),
(735, 'map_api_key', 'Map API Key', 'مفتاح API للخريطة', 'carte api clé'),
(736, 'map_latitude', 'Map Latitude', 'خريطة النطاق', 'latitude de la carte'),
(737, 'map_longitude', 'Map Longitude', 'خريطة خط الطول', 'longitude de la carte'),
(738, 'checkout_options', 'Checkout Options', 'خيارات الخروج', 'options de paiement'),
(739, 'register_account', 'Register Account', 'تسجيل حساب', 'Créer un compte'),
(740, 'guest_checkout', 'Guest Checkout', 'ضيف المحاسبة', 'caisse des invités'),
(741, 'returning_customer', 'Returning Customer', 'الزبون العائد', 'Déjà client'),
(742, 'personal_details', 'Personal Details', 'تفاصيل شخصية', 'détails personnels'),
(743, 'billing_details', 'Billing Details', 'تفاصيل الفاتورة', 'Détails de la facturation'),
(744, 'delivery_details', 'Delivery Details', 'تفاصيل التسليم', 'détails de livraison'),
(745, 'delivery_method', 'Delivery Method', 'طريقة التوصيل', 'méthode de livraison'),
(746, 'payment_method', 'Payment Method', 'طريقة الدفع او السداد', 'mode de paiement'),
(747, 'confirm_order', 'Confirm Order', 'أكد الطلب', 'confirmer la commande'),
(748, 'company', 'Company', 'شركة', 'compagnie'),
(749, 'region_state', 'Region / State', 'المنطقة / الولاية', 'état de la région'),
(750, 'post_code', 'Post Code', 'الرمز البريدي', 'code postal'),
(751, 'slider', 'Slider', 'شريط التمرير', 'glissière'),
(752, 'subscriver', 'Subscriver', 'فرعي', 'abonné'),
(753, 'shipping_method', 'Shipping Method', 'طريقة الشحن', 'Mode de livraison'),
(754, 'add_shipping_method', 'Add Shipping Method', 'أضف طريقة الشحن', 'ajouter une méthode d\'expédition'),
(755, 'manage_shipping_method', 'Manage Shipping Method', 'إدارة طريقة الشحن', 'gérer la méthode d\'expédition'),
(756, 'shipping_method_edit', 'Shipping Method Edit', 'تحرير طريقة الشحن', 'méthode d\'expédition modifier'),
(757, 'bank_transfer', 'Bank Transfer', 'حوالة بنكية', 'virement'),
(758, 'cash_on_delivery', 'Cash On Delivery', 'الدفع عند الاستلام', 'paiement à la livraison'),
(759, 'sub_total', 'Sub Total', 'المجموع الفرعي', 'sous-total'),
(760, 'product_successfully_order', 'Product Successfully Ordered', 'تم طلب المنتج بنجاح', 'produit commandé avec succès'),
(761, 'checkout', 'Checkout', 'الدفع', 'vérifier'),
(762, 'share', 'Share', 'يشارك', 'partager'),
(763, 'are_you_sure_want_to_order', 'Are you sure want to order ?', 'هل أنت متأكد من أنك تريد الطلب؟', 'êtes-vous sûr de vouloir commander'),
(764, 'optional', 'This is optional', 'هذا اختياري', 'optionnel'),
(765, 'manage_wearhouse_product', 'Manage Wearhouse Product', 'إدارة منتج المستودع', 'gérer le produit d\'usure'),
(766, 'you_cant_delete_this_is_in_calculate_system', 'You can\'t delete. This is in calculate system.', 'لا يمكنك الحذف. هذا في حساب النظام.', 'vous ne pouvez pas supprimer ceci est dans le système de calcul'),
(767, 'you_can_add_only_one_product_at_a_time', 'You can add only one product at at a time !', 'يمكنك إضافة منتج واحد فقط في كل مرة!', 'vous ne pouvez ajouter qu\'un seul produit à la fois'),
(768, 'stock_report_store_wise', 'Stock Report (Store Wise)', 'تقرير المخزون (فلترة حسب المخزون)', 'rapport de stock sage en magasin'),
(769, 'invoice_search_item', 'Invoice search item', 'عنصر بحث الفاتورة', 'élément de recherche de facture'),
(770, 'default_store', 'Default Store', 'المتجر الافتراضي', 'magasin par défaut'),
(771, 'total_price', 'Total Price', 'السعر الكلي', 'prix total'),
(772, 'use_coupon_code', 'Use coupon code', 'استخدم رمز القسيمة', 'utiliser le code promo'),
(773, 'enter_your_coupon_here', 'Enter your coupon here', 'أدخل قسيمتك هنا', 'entrez votre coupon ici'),
(774, 'apply_coupon', 'Apply Coupon', 'تطبيق القسيمة', 'Appliquer Coupon'),
(775, 'coupon_code', 'Coupon Code', 'رمز الكوبون', 'code promo'),
(776, 'cart', 'Cart', 'عربة التسوق', 'Chariot'),
(777, 'your_coupon_is_used', 'Your coupon is used !', 'قسيمتك مستخدمة!', 'votre coupon est utilisé'),
(778, 'coupon_is_expired', 'Your coupon is expired !', 'قسيمتك منتهية الصلاحية!', 'le coupon est expiré'),
(779, 'coupon_discount', 'Coupon Discount', 'خصم القسيمة', 'bon de réduction'),
(780, 'oops_your_cart_is_empty', 'OOPS !!! Your Cart is Empty', 'عذرا!!! عربة التسوق فارغة', 'oups votre panier est vide'),
(781, 'got_to_shop_now', 'Go to shop Now', 'اذهب للتسوق الآن', 'faut faire du shopping maintenant'),
(782, 'by_creating_an_account_you_will_able_to_shop_faster', 'By creating an account you will be able to shop faster, be up to date on an order\'s status, and keep track of the orders you have previously made.', 'من خلال إنشاء حساب ، ستتمكن من التسوق بشكل أسرع ، والبقاء على اطلاع دائم بحالة الطلب ، وتتبع الطلبات التي قدمتها سابقًا.', 'en créant un compte vous pourrez faire vos achats plus rapidement'),
(783, 'select_category', 'Select Category', 'اختر الفئة', 'Choisir une catégorie'),
(784, 'select_state', 'Select State', 'اختر ولايه', 'sélectionnez l\'état'),
(785, 'my_delivery_and_billing_addresses_are_the_same', 'My delivery and billing addresses are the same.', 'عناوين الفواتير والتسليم الخاصة بي هي نفسها.', 'mes adresses de livraison et de facturation sont les mêmes'),
(786, 'i_have_read_and_agree_to_the_privacy_policy', 'I have read and agree to the', 'لقد قرات ووافقت على ال', 'j\'ai lu et j\'accepte la politique de confidentialité'),
(788, 'kindly_select_the_preferred_shipping_method_to_use_on_this_order', 'Kindly Select the preferred shipping method to use on this order.', 'يرجى تحديد طريقة الشحن المفضلة لاستخدامها في هذا الطلب.', 'veuillez sélectionner la méthode d\'expédition préférée à utiliser sur cette commande'),
(789, 'view_cart', 'View Cart', 'عرض عربة التسوق', 'voir le panier'),
(790, 'category_wise_product', 'Category Wise Product.', 'فلترة حسب فئة المنتج', 'produit par catégorie'),
(791, 'stock_not_available', 'Stock not available !', 'المخزون غير متوفر!', 'stock non disponible'),
(792, 'print_barcode', 'Print Barcode', 'طباعة الباركود', 'imprimer le code-barres'),
(793, 'print_qrcode', 'Print QR Code', 'طباعة رمز الاستجابة السريعة', 'imprimer le code qr'),
(794, 'product_is_not_available_in_this_store', 'Product is not available in this store !', 'المنتج غير متوفر في هذا المتجر!', 'le produit n\'est pas disponible dans ce magasin'),
(795, 'category_product_search', 'Category Product Search.', 'فئة المنتج البحث.', 'recherche de produit par catégorie'),
(796, 'partial_paid', 'Partial Paid', 'مدفوعة جزئيا', 'partiel payé'),
(797, 'manage_product_tax', 'Manage Product Tax', 'إدارة ضريبة المنتج', 'gérer la taxe sur les produits'),
(798, 'tax_setting', 'Tax Setting', 'إعداد الضرائب', 'fiscalité'),
(799, 'tax_name_1', 'Tax 1 Name ', 'اسم الضريبة 1', 'nom fiscal 1'),
(800, 'tax_name_2', 'Tax 2 Name', 'اسم الضريبة 2', 'nom fiscal 2'),
(801, 'tax_name_3', 'Tax 3 Name', 'اسم الضريبة 3', 'nom fiscal 3'),
(802, 'quotation_discount', 'Quotation Discount', 'خصم عرض السعر', 'remise de devis'),
(803, 'select_variant', 'Select Variant', 'حدد متغير', 'sélectionner la variante'),
(804, 'already_a_member', 'Already a member ?', 'هل انت عضو مسجل؟', 'Déjà membre'),
(805, 'not_a_member_yet', 'No a member yet ?', 'لا يوجد عضو حتى الآن؟', 'Pas encore membre'),
(806, 'store_or_wearhouse', 'Store or Wearhouse', 'متجر أو مخزن', 'magasin ou entrepôt'),
(807, 'import_category_csv', 'Import Category (CSV)', 'فئة الاستيراد (CSV)', 'importer la catégorie csv'),
(808, 'import_store_csv', 'Import Store (CSV)', 'تحميل المخزون', 'importer le fichier csv du magasin'),
(809, 'import_wearhouse_csv', 'Import Wearhouse (CSV)', 'استيراد المستودع (CSV)', 'importer le fichier csv de la maison d\'usure'),
(810, 'image_field_is_required', 'Image field is required !', 'حقل الصورة مطلوب!', 'le champ image est obligatoire'),
(811, 'email_configuration', 'Email Configuration', 'اعدادات البريد الإلكتروني', 'configuration de la messagerie'),
(812, 'protocol', 'Protocol', 'بروتوكول', 'protocole'),
(813, 'mailtype', 'Mail Type', 'نوع البريد', 'type de courrier'),
(814, 'smtp_host', 'SMTP Host', 'مضيف بروتوكول نقل البريد البسيط', 'hôte smtp'),
(815, 'smtp_port', 'SMTP Port', 'منفذ بروتوكول نقل البريد البسيط', 'port smtp'),
(816, 'sender_email', 'Sender Email', 'البريد الإلكتروني المرسل', 'e-mail de l\'expéditeur'),
(817, 'html', 'Html', 'لغة البرمجة', 'html'),
(818, 'text', 'Text', 'نص', 'texte'),
(819, 'add_note', 'Add Note', 'اضف ملاحظة', 'ajouter une note'),
(820, 'shipped', 'Shipped', 'تم شحنها', 'Expédié'),
(821, 'return', 'Return', 'يعود', 'revenir'),
(822, 'processing', 'Processing', 'يعالج', 'En traitement'),
(823, 'complete', 'Complete', 'مكتمل', 'Achevée'),
(824, 'pending', 'Pending', 'قيد الانتظار', 'en attendant'),
(825, 'please_add_note', 'Please add note !', 'الرجاء إضافة ملاحظة!', 's\'il vous plaît ajouter une note'),
(826, 'email_send_to_customer', 'Email send to customer', 'إرسال بريد إلكتروني إلى العميل', 'e-mail envoyé au client'),
(827, 'items_in_your_cart', 'Items In Your Cart.', 'الوحدات الموجودة فى سلة التسوق الخاصة بك.', 'Articles dans votre panier'),
(828, 'you_have', 'You Have', 'لديك', 'vous avez'),
(829, 'add_coment_about_your_order', 'Add Comment About Your Order.', 'أضف تعليق حول طلبك.', 'ajouter un commentaire sur votre commande'),
(830, 'add_coment_about_your_payment', 'Add Comment About Your Order.', 'أضف تعليق حول طلبك.', 'ajouter un commentaire sur votre paiement'),
(831, 'you_have_receive_a_email_please_check_your_email', 'You have received a email.Please check your email.', 'لقد تلقيت بريدًا إلكترونيًا ، يرجى التحقق من بريدك الإلكتروني.', 'vous avez reçu un e-mail veuillez vérifier votre e-mail'),
(832, 'invoice_status', 'Invoice Status', 'حالة الفاتورة', 'état de la facture'),
(833, 'order_information', 'Order Information', 'معلومات الطلب', 'Informations sur la commande'),
(834, 'order_info_details', 'Attached below is order. If you have any questions or there are any issues please let us know. Have a great day. ', 'مرفق أدناه هو الطلب. إذا كانت لديك أي أسئلة أو كانت هناك أية مشكلات ، فيرجى إخبارنا بذلك. أتمنى لك يوما عظيما.', 'détails de la commande'),
(835, 'bank_transfer_instruction', 'Bank Transfer Instruction', 'تعليمات التحويل المصرفي', 'instruction de virement bancaire'),
(836, 'pleasse_transfer_the_total_amount_to_the_following_bank_account', 'Please Transfer The Total Amount To The Following Bank Account.', 'يرجى تحويل المبلغ الإجمالي إلى الحساب المصرفي التالي.', 'veuillez virer le montant total sur le compte bancaire suivant'),
(837, 'account_no', 'Account No', 'رقم الحساب', 'n ° de compte'),
(838, 'branch', 'Branch', 'فرع', 'bifurquer'),
(839, 'add_to_wishlist', 'Add To Wishlist', 'أضف إلى قائمة الامنيات', 'ajouter à la liste de souhaits'),
(840, 'quick_view', 'Quick View.', 'نظرة سريعة.', 'aperçu rapide'),
(841, 'service_charge', 'Service Charge', 'تكلفة الخدمة', 'frais de service'),
(842, 'credit_card', 'Credit Card', 'بطاقة ائتمان', 'carte de crédit'),
(843, 'debit_card', 'Debit Card', 'بطاقة ائتمان مؤجل', 'carte de débit'),
(844, 'master_card', 'Master Card', 'بطاقة ماستر ', 'carte maîtresse'),
(845, 'amex', 'Amex', 'أميكس', 'amex'),
(846, 'visa', 'Visa', 'فيزا', 'visa'),
(847, 'paypal', 'Paypal', 'باي بال', 'Pay Pal'),
(848, 'you_cant_delete_this_customer', 'You can\'t delete this customer ! This is in calculating system.', 'لا يمكنك حذف هذا العميل! هذا في حساب النظام.', 'vous ne pouvez pas supprimer ce client'),
(849, 'you_cant_delete_this_supplier', 'You can\'t delete this supplier ! This is in calculating system.', 'لا يمكنك حذف هذا المورد.', 'vous ne pouvez pas supprimer ce fournisseur'),
(850, 'quotation_information', 'Quotation Information', 'معلومات عرض السعر', 'informations sur le devis'),
(851, 'quotation_info_details', 'Attached below is quotation. If you have any questions or there are any issues please let us know. Have a great day. ', 'مرفق أدناه الاقتباس. إذا كانت لديك أي أسئلة أو كانت هناك أية مشكلات ، فيرجى إخبارنا بذلك. نتمنى لك يوما سعيدا.', 'détails des informations sur le devis'),
(852, 'variant_is_required', 'Variant is required !', 'البديل مطلوب', 'une variante est requise'),
(853, 'bitcoin', 'Bitcoin', 'بيتكوين', 'bitcoins'),
(854, 'order_cancel', 'Order cancel', 'طلب إلغاء', 'annuler la commande'),
(855, 'payeer_payment', 'Payeer Payment', 'الدفع بايير', 'paiement du payeur'),
(856, 'bitcoin_payment', 'Bitcoin Payment', 'دفع البيتكوين', 'paiement en bitcoins'),
(857, 'customer_id', 'Customer ID', 'هوية الزبون', 'N ° de client'),
(858, 'payeer', 'Payeer', 'بايير', 'payeur'),
(859, 'payment_gateway_setting', 'Payment Gateway Setting', 'إعداد بوابة الدفع', 'réglage de la passerelle de paiement'),
(860, 'public_key', 'Public Key', 'المفتاح العمومي', 'Clé publique'),
(861, 'private_key', 'Private Key', 'مفتاح سري', 'Clé privée'),
(862, 'shop_id', 'Shop ID', 'معرف المتجر', 'identifiant de la boutique'),
(863, 'paypal_email', 'Paypal Email', 'بريد باي بال', 'Email Paypal'),
(864, 'transaction_faild', 'Transaction Failed !', 'فشل الاجراء !', 'La transaction a échoué'),
(865, 'footer_logo', 'Footer Logo', 'تذييل الشعار', 'logo de pied de page'),
(866, 'footer_details', 'Footer Details', 'تفاصيل التذييل', 'détails du pied de page'),
(867, 'default_status_already_exists', 'Default status already exists !', 'الوضع الافتراضي موجود بالفعل!', 'le statut par défaut existe déjà'),
(868, 'store_name_already_exists', 'Store name already exists !', 'اسم المتجر موجود بالفعل!', 'le nom du magasin existe déjà'),
(869, 'please_set_default_store', 'Please set default store !', 'يرجى تعيين المتجر الافتراضي!', 'veuillez définir le magasin par défaut'),
(870, 'do_you_want_make_it_default_store', 'Do you want make it default store ?', 'هل تريد جعله المتجر الافتراضي؟', 'voulez-vous en faire le magasin par défaut'),
(871, 'do_you_want_make_it_default_currency', 'Do you want it default currency ?', 'هل تريدها العملة الافتراضية؟', 'voulez-vous en faire la devise par défaut'),
(872, 'you_must_have_a_default_currency', 'You must have a default currency', 'يجب أن يكون لديك عملة افتراضية', 'vous devez avoir une devise par défaut'),
(873, 'you_cant_delete_this_is_default_currency', 'You cant delete ! This is default currency. ', 'لا يمكنك الحذف! هذه هي العملة الافتراضية.', 'vous ne pouvez pas supprimer ceci est la devise par défaut'),
(874, 'you_must_have_a_default_store', 'You must have a default sote', 'يجب أن يكون لديك متجر افتراضي', 'vous devez avoir un magasin par défaut'),
(875, 'email_not_send', 'Email not send !', 'البريد الإلكتروني لا يرسل!', 'mail non envoyé'),
(876, 'client_id', 'Client ID', 'معرف العميل', 'identité du client'),
(877, 'app_qr_code', 'App QR Code', 'رمز الاستجابة السريعة للتطبيق', 'code qr de l\'application'),
(878, 'sms_configuration', 'Sms Configuration', 'تكوين الرسائل القصيرة', 'configuration SMS'),
(879, 'charset', 'Charset', 'محارف', 'jeu de caractères'),
(880, 'port', 'Port', 'ميناء', 'Port'),
(881, 'host', 'Host', 'مضيف', 'héberger'),
(882, 'title', 'Title', 'عنوان', 'Titre'),
(883, 'gateway', 'Gateway', 'بوابة', 'passerelle'),
(884, 'smsrank', 'SMS Rank', 'ترتيب الرسائل القصيرة', 'smsrank'),
(885, 'sms_pre_text', 'Your Order No ', 'النص السابق للرسائل القصيرة', 'pré texte sms'),
(886, 'sms_text', 'has been confirmed ', 'نص الرسائل القصيرة', 'SMS'),
(887, 'sms_settings', 'SMS Settings ', 'إعدادات الرسائل القصيرة', 'paramètres SMS'),
(888, 'sms_template', 'SMS Template', 'قالب الرسائل القصيرة', 'modèle de SMS'),
(889, 'template_name', 'Template Name', 'اسم القالب', 'nom du modèle'),
(890, 'sms_template_warning', 'please use \"{id}\" format without quotation to set dynamic value inside template. ', 'نموذج تحذير الرسائل القصيرة', 'avertissement de modèle de SMS'),
(891, 'qr_status', 'QR Code Status', 'حالة رمز الاستجابة السريعة', 'statut qr'),
(892, 'pay_with', 'Pay With', 'ادفع عن طريق', 'payer avec'),
(893, 'manage_pay_with', 'Manage Pay With', 'إدارة الدفع باستخدام', 'gérer la paie avec'),
(894, 'add_pay_with', 'Add Pay With', 'أضف الدفع باستخدام', 'ajouter payer avec'),
(895, 'pay_with_edit', 'Pay With Edit', 'الدفع مع التحرير', 'payer avec modifier'),
(896, 'color_setting_frontend', 'Color Setting Front End', 'الواجهة الأمامية لإعداد اللون', 'interface de réglage des couleurs'),
(897, 'color1', 'Color 1', 'اللون 1', 'couleur1'),
(898, 'color2', 'Color 2', 'اللون 2', 'couleur2'),
(899, 'color3', 'Color 3', 'اللون 3', 'couleur3'),
(900, 'color_setting_backend', 'Color Setting Backend', 'خلفية إعداد اللون', 'backend de réglage des couleurs'),
(901, 'color4', 'Color 4', 'اللون 4', 'couleur4'),
(902, 'forget_password', 'Forgot Password', 'هل نسيت كلمة السر', 'mot de passe oublié'),
(903, 'send', 'Send', 'يرسل', 'envoyer'),
(904, 'password_recovery', 'Password Recovery', 'استعادة كلمة السر', 'récupération de mot de passe'),
(905, 'color5', 'Color 5', 'اللون 5', 'couleur5'),
(906, 'please_select_product_size', 'Please Select Product Size', 'يرجى تحديد حجم المنتج', 'veuillez sélectionner la taille du produit'),
(907, 'please_keep_quantity_up_to_zero', 'Please Keep Quantity Up To Zero', 'يرجى الاحتفاظ بالكمية حتى الصفر', 'veuillez garder la quantité à zéro'),
(908, 'product_added_to_cart', 'Product Added To Cart', 'تمت إضافة المنتج إلى عربة التسوق', 'produit ajouté au panier'),
(909, 'not_enough_product_in_stock', 'Not Enough Product In Stock. Please Reduce The Product Quantity.', 'المنتج غير كافٍ في المخزن. يرجى تقليل كمية المنتج.', 'pas assez de produit en stock'),
(910, 'please_fill_up_all_required_field', 'Please Fill Up All Required Field', 'يرجى ملء جميع الحقول المطلوبة', 'merci de remplir tous les champs obligatoires'),
(911, 'fe_color1', 'Color1 = header section', 'اللون 1 = قسم الرأس', 'fe couleur1'),
(912, 'fe_color2', 'Color2 = Dropdown and Footer Section', 'اللون 2 = قسم القائمة المنسدلة والتذييل', 'fe color2'),
(913, 'fe_color3', 'Color3 = Menu Bar', 'اللون 3 = شريط القوائم', 'fe couleur3'),
(914, 'be_color1', 'Color1 = Left Bar', 'اللون 1 = الشريط الأيسر', 'être de couleur1'),
(915, 'be_color2', 'Color2 = Top And Bottom Bar', 'اللون 2 = الشريط العلوي والسفلي', 'être de couleur2'),
(916, 'be_color3', 'Color3 = Body Background', 'اللون 3 = خلفية الجسم', 'être de couleur3'),
(917, 'be_color4', 'Color4 = For All Button Except Edit & Delete Button', 'اللون 4 = لجميع الأزرار باستثناء زر التحرير والحذف', 'être de couleur4'),
(918, 'be_color5', 'Color5 =  Button Font Color Except edit & Delete Button', 'اللون 5 = لون خط الزر باستثناء زر التحرير والحذف', 'être de couleur5'),
(919, 'sales_report_store_wise', 'Sales Report (Store Wise)', 'تقرير المبيعات (فلترة حسب المتجر)', 'rapport de vente en magasin'),
(920, 'fe_color4', 'Color4 = Notification, Sign-up button, Rating, Footer text border, Go to top button  ', 'اللون 4 = إعلام ، زر تسجيل ، تصنيف ، حد نص التذييل ، زر الانتقال إلى الأعلى', 'fe color4'),
(921, 'link', 'Link', 'وصلة', 'lien'),
(922, 'userid', 'UserId', 'معرف المستخدم', 'identifiant d\'utilisateur'),
(923, 'this_email_not_exits', 'This Email Not Exits', 'هذا البريد الإلكتروني لا يخرج', 'ce mail n\'existe pas'),
(924, 'sell', 'Sell', 'يبيع', 'vendre'),
(925, 'transfer_quantity', 'Transfer Quantity', 'كمية التحويل', 'quantité de transfert'),
(926, 'order_completed', 'Your Order Is Completed. ', 'طلبك مكتمل.', 'commande terminée'),
(927, 'this_coupon_is_already_used', 'This Coupon Is Already Used', 'هذه القسيمة مستخدمة بالفعل', 'ce coupon est déjà utilisé'),
(928, 'please_login_first', 'Please Login First', 'الرجاء تسجيل الدخول أولا', 's\'il vous plait Connectez-vous d\'abord'),
(929, 'product_added_to_wishlist', 'Product Added To Wishlist', 'تمت إضافة المنتج إلى قائمة الرغبات', 'produit ajouté à la liste de souhaits'),
(930, 'product_already_exists_in_wishlist', 'Product Already Exists In Wishlist', 'المنتج موجود بالفعل في قائمة الرغبات', 'le produit existe déjà dans la liste de souhaits'),
(931, 'support', 'Support', 'الدعم', 'Support'),
(932, 'add_country_code', 'Please Add Country Code To Use SMS Services ', 'الرجاء إضافة رمز الدولة لاستخدام خدمات الرسائل القصيرة', 'ajouter le code pays'),
(933, 'search_items', 'Items Found For ', 'العناصر التي تم العثور عليها', 'éléments de recherche'),
(934, 'variant_not_available', 'This variant is not available', 'هذا البديل غير متوفر', 'variante non disponible'),
(935, 'request_failed', 'Request Failed, Please check and try again!', 'فشل الطلب ، يرجى التحقق والمحاولة مرة أخرى!', 'demande échoué'),
(936, 'write_your_comment', 'Please write your comment.', 'من فضلك اكتب تعليقك.', 'écrivez votre commentaire'),
(937, 'your_review_added', 'Your review added.', 'تمت إضافة رأيك.', 'votre avis ajouté'),
(938, 'already_reviewed', 'Thanks. You already reviewed.', 'شكرا. لقد راجعت بالفعل.', 'déjà revu'),
(939, 'please_type_email_and_password', 'Please type email and password.', 'الرجاء كتابة البريد الإلكتروني وكلمة المرور.', 's\'il vous plaît tapez email et mot de passe'),
(940, 'ordered', 'Ordered ', 'أمر', 'commandé'),
(941, 'your_order_has_been_confirm', 'Your order has been confirm.', 'تم تأكيد طلبك.', 'votre commande a été confirmée'),
(942, 'receive_quantity', 'Receive Quantity', 'تلقي الكمية', 'recevoir la quantité'),
(943, 'receive_from', 'Receive From', 'استلمه من', 'recevoir de'),
(944, 'stock_report_order_wise', 'Stock Report Order Wise', 'تقرير المخزون (فلترة حسب الترتيب)', 'rapport de stock ordre sage'),
(945, 'theme_activation', 'Theme Activation', 'تفعيل الموضوع', 'activation du thème'),
(946, 'manage_themes', 'Manage Themes', 'إدارة السمات', 'gérer les thèmes'),
(947, 'upload_new_theme', 'Upload New Theme', 'تحميل موضوع جديد', 'télécharger un nouveau thème'),
(948, 'theme_name', 'Theme Name', 'اسم الموضوع', 'nom du thème'),
(949, 'upload', 'Upload', 'تحميل', 'télécharger'),
(950, 'themes', 'Themes', 'ثيمات', 'thèmes'),
(951, 'theme_active_successfully', 'Theme Active successfully.', 'تم تفعيل الثيم  بنجاح.', 'thème actif avec succès'),
(952, 'theme_uploaded_successfully', 'Theme uploaded successfully.', 'تم تحميل الثيم  بنجاح.', 'thème téléchargé avec succès'),
(953, 'there_was_a_problem_with_the_upload', 'There was a problem with the upload. Please try again.', 'كانت هناك مشكلة في التحميل. حاول مرة اخرى.', 'il y a eu un problème avec le téléchargement'),
(954, 'the_theme_has_not_uploaded', 'The Theme has not uploaded!', 'لم يتم تحميل الثيم!', 'le thème n\'a pas été téléchargé'),
(955, 'have_a_question', 'Have a question?', 'لدي سؤال؟', 'avoir une question'),
(956, 'buy_now_promotion', 'Buy Now Promotions', 'عروض الشراء الآن', 'acheter maintenant'),
(957, 'all_departments', 'All Departments', 'جميع الإدارات', 'tous les départements'),
(958, 'best_sale_product', 'Best sale Product', 'أفضل المنتجات مبيعاً', 'meilleur produit de vente'),
(959, 'most_popular_product', 'Most Popular Product', 'المنتجات الاكثر طلباً', 'produit le plus populaire'),
(960, 'view_all', 'View All', 'مشاهدة الكل', 'Voir tout'),
(961, 'view_all', 'View All', 'مشاهدة الكل', 'Voir tout'),
(962, 'brand_of_the_week', 'Brands of the Week', 'العلامات التجارية لهذا الأسبوع', 'marque de la semaine'),
(963, 'download_the_app', 'Download The App', 'قم بتنزيل التطبيق', 'télécharger l\'application'),
(964, 'get_access_to_all_exclusive_offers', 'Get access to all exclusive offers, discounts and deals by download our App !', 'احصل على الوصول إلى جميع العروض والخصومات والصفقات الحصرية عن طريق تنزيل تطبيقنا!', 'accédez à toutes les offres exclusives'),
(965, 'select', 'Select', 'يختار', 'sélectionner'),
(966, 'you_may_alo_be_interested_in', 'You May Also Be Interested In', 'قد تكون أيضا مهتما ب', 'vous pouvez également être intéressé par'),
(967, 'rate_it', 'Rate It', 'قيمه', 'évaluez-le'),
(968, 'similar_products', 'Similar Products', 'منتجات مماثلة', 'produits similaires'),
(969, 'subscribe_successfully', 'Subscribe Successfully', 'اشترك بنجاح', 'abonnez-vous avec succès'),
(970, 'please_enter_email', 'Please Enter Valid Email. ', 'الرجاء إدخال بريد إلكتروني صحيح.', 'veuillez saisir un e-mail'),
(971, 'username_or_email', 'Username or Email', 'اسم المستخدم أو البريد الالكتروني', 'nom d\'utilisateur ou email'),
(972, 'dont_have_an_account', 'Don\'t have an account? ', 'ليس لديك حساب؟', 'ne pas avoir de compte'),
(973, 'already_member', 'Already Member ?', 'عضو بالفعل؟', 'déjà membre'),
(974, 'success', 'Success', 'النجاح', 'Succès'),
(975, 'lost_your_password', 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'فقدت كلمة المرور الخاصة بك؟ الرجاء إدخال اسم المستخدم أو عنوان البريد الإلكتروني. سوف تتلقى رابطًا لإنشاء كلمة مرور جديدة عبر البريد الإلكتروني.', 'Mot de passe perdu'),
(976, 'reset_password', 'Reset Password', 'إعادة تعيين كلمة المرور', 'réinitialiser le mot de passe'),
(977, 'ago', 'ago', 'منذ', 'depuis'),
(978, 'signin', 'Sign In', 'تسجيل الدخول', 's\'identifier'),
(979, 'your', 'Your', 'لك', 'ton'),
(980, 'product_remove_from_wishlist', 'Product Remove From Wish list', 'إزالة المنتج من قائمة الرغبات', 'produit supprimer de la liste de souhaits'),
(981, 'product_not_remove_from_wishlist', 'Product not remove from wish list', 'لم يتم إزالة المنتج من قائمة الرغبات', 'produit non supprimé de la liste de souhaits'),
(982, 'enter_your_coupon_code_if_you_have_one', 'Enter your coupon code if you have one.', 'أدخل رمز القسيمة الخاص بك إذا كان لديك واحد.', 'entrez votre code promo si vous en avez un'),
(983, 'cart_total', 'Cart Totals', 'إجماليات سلة التسوق', 'total du panier'),
(984, 'remember_me', 'Remember Me', 'تذكرنى', 'souviens-toi de moi'),
(985, 'click_here_to_login', 'Click here to login', 'انقر هنا لتسجيل الدخول', 'Cliquez ici pour vous identifier'),
(986, 'if_you_have_shopped_with_us', 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing & Shipping section.', 'إذا كنت قد قمت بالتسوق معنا من قبل ، فيرجى إدخال التفاصيل الخاصة بك في المربعات أدناه. إذا كنت عميلاً جديدًا ، فيرجى المتابعة إلى قسم الفواتير والشحن.', 'si vous avez magasiné avec nous'),
(987, 'billing_address', 'Billing Address', 'عنوان وصول الفواتير', 'Adresse de facturation'),
(988, 'create_an_account', 'Create An Account ?', 'انشئ حساب ؟', 'créer un compte'),
(989, 'create_account_password', 'Create Account Password', 'إنشاء كلمة مرور الحساب', 'créer un mot de passe de compte'),
(990, 'notes_about_your_order', 'Notes about your order, e.g. special notes for delivery.', 'ملاحظات حول طلبك ، على سبيل المثال ملاحظات خاصة للتسليم.', 'remarques sur votre commande'),
(991, 'ship_to_a_different_address', 'Ship to a different address?', 'الشحن إلى عنوان مختلف؟', 'Livrer à une adresse différente'),
(992, 'by_variant', 'By Variant  ', 'حسب البديل', 'par variante'),
(993, 'by_brand', 'By Brand', 'حسب الماركة', 'par marque'),
(994, 'rating', 'Rating', 'تقييم', 'évaluation'),
(995, 'filter', 'Filter', 'تصنيف', 'filtre'),
(996, 'by_price', 'By Price', 'حسب السعر', 'par prix'),
(997, '5', '5', '5', '5'),
(998, '4', '4', '4', '4'),
(999, 'your_email_address_will_not_be_published', 'Your email address will not be published. Required fields are marked *', 'لن يتم نشر عنوان بريدك الإلكتروني. الحقول المطلوبة محددة *', 'Votre adresse email ne sera pas publiée'),
(1000, 'shop_of_the_week', 'Shop Of The Week', 'متجر الأسبوع', 'boutique de la semaine'),
(1001, 'copyright', 'Copyright Â© 2018 Bdtask. All Rights Reserved', 'حقوق النشر Â © 2018 Bdtask. كل الحقوق محفوظة', 'droits d\'auteur'),
(1002, 'app_link_status', 'App Link Status', 'حالة ارتباط التطبيق', 'état du lien de l\'application'),
(1003, 'update_your_software_setting', 'Update Your Software Setting', 'قم بتحديث إعدادات البرامج الخاصة بك', 'mettre à jour les paramètres de votre logiciel'),
(1004, 'update_color_setting', 'Update Color Setting', 'تحديث إعداد اللون', 'mettre à jour le paramètre de couleur'),
(1005, 'update_web_color', 'Update Web Color', 'تحديث لون الويب', 'mettre à jour la couleur du site'),
(1006, 'update_dashboard_color', 'Update Dashboard Color', 'تحديث لون لوحة المعلومات', 'mettre à jour la couleur du tableau de bord'),
(1007, 'update_color', 'Update Color', 'تحديث اللون', 'mettre à jour la couleur'),
(1008, 'sslcommerz_email', 'SSLCOMMERZ Email', 'البريد الإلكتروني SSLCOMMERZ', 'e-mail sslcommerz'),
(1009, 'store_id', 'Store ID', 'معرف المتجر', 'identifiant de magasin'),
(1010, 'import_database', 'Import Database', 'استيراد قاعدة البيانات', 'importer la base de données'),
(1011, 'check_for_update', 'Check For Update', 'فحص التحديثات', 'vérifier la mise à jour'),
(1012, 'software_update', 'Software Update', 'تحديث النظام', 'mise à jour logicielle'),
(1013, 'activated', 'Activated', 'مفعل', 'activé'),
(1014, 'back_to_home', 'Back to home', 'العودة إلى الصفحة الرئيسية', 'de retour à la maison'),
(1015, 'in_active', 'In Active', 'غير نشط', 'inactif'),
(1016, 'january', 'January', 'كانون الثاني', 'janvier'),
(1017, 'february', 'February', 'شهر فبراير', 'février'),
(1018, 'march', 'March', 'مارس', 'Mars'),
(1019, 'january', 'January', 'كانون الثاني', 'janvier'),
(1020, 'february', 'February', 'شباط', 'février'),
(1021, 'april', 'April', 'نيسان', 'avril'),
(1022, 'may', 'May', 'ايار', 'peut'),
(1023, 'june', 'June', 'حزيران', 'juin'),
(1024, 'july', 'July', 'تموز', 'juillet'),
(1025, 'august', 'August', 'آب', 'août'),
(1026, 'september', 'September', 'ايلول', 'septembre'),
(1027, 'october', 'October', 'تشرين الاول', 'octobre'),
(1028, 'november', 'November', 'تشرين الثاني', 'novembre'),
(1029, 'december', 'December', 'كانون الاول', 'décembre'),
(1030, 'product_image_gallery', 'Product Image Gallery', 'معرض صور المنتج', 'galerie d\'images de produits'),
(1031, 'add_product_image', 'Add product image', 'أضف صورة المنتج', 'ajouter l\'image du produit'),
(1032, 'manage_product_image', 'Manage product image', 'إدارة صورة المنتج', 'gérer l\'image du produit'),
(1033, 'sms_service', 'SMS Service ', 'خدمة الرسائل القصيرة', 'service SMS'),
(1034, 'google_analytics', 'Google Analytics', 'تحليلات غوغل', 'Google Analytics'),
(1035, 'facebook_messenger', 'Facebook Messenger', 'فيسبوك مسنجر', 'Facebook Messenger'),
(1036, 'welcome_back_to_login', 'Welcome Back to Login.', 'مرحبًا بك مرة أخرى في تسجيل الدخول.', 'bienvenue à nouveau pour vous connecter'),
(1037, 'application_protocol', 'Application Protocol', 'بروتوكول التطبيق', 'protocole d\'application'),
(1038, 'http', 'HTTP', 'HTTP', 'http'),
(1039, 'https', 'HTTPS', 'HTTPS', 'https'),
(1040, 'login_with_facebook', 'Login with facebook', 'تسجيل الدخول باستخدام الفيسبوك', 'Se connecter avec Facebook'),
(1041, 'social_authentication', 'Social Authentication', 'المصادقة الاجتماعية', 'authentification sociale'),
(1042, 'manage_social_media', 'Manage social media', 'إدارة وسائل التواصل الاجتماعي', 'gérer les réseaux sociaux'),
(1043, 'social', 'Social', 'اجتماعي', 'social'),
(1044, 'app_id', 'App ID', 'معرف التطبيق', 'identifiant de l\'application'),
(1045, 'app_secret', 'App Secret', 'سر التطبيق', 'secret de l\'application'),
(1046, 'api_key', 'Api key', 'مفتاح API', 'clé API'),
(1047, 'shipping_charge', 'Shipping Charge', 'رسوم الشحن', 'frais de port'),
(1048, 'stock_report_variant_wise', 'Stock report variant wise', 'تقرير المخزون (فلترة حسب المتغير)', 'rapport de stock variante sage'),
(1049, 'purchase', 'Purchase', 'شراء', 'achat'),
(1050, 'rating_and_reviews', 'Ratings and Reviews', 'التقييمات والمراجعات', 'note et commentaires'),
(1051, 'average_user_rating', 'Average user rating', 'متوسط تقييم المستخدم', 'note moyenne des utilisateurs'),
(1052, 'rating_breakdown', 'Rating breakdown', 'تصنيف التعطل', 'répartition des notes'),
(1053, '100_percent_complete', '100% Complete (success)', '100٪ إكتمل بنجاح نسبة', '100 pour cent complet'),
(1054, '80_percent_complete', '80% Complete (primary)', ' مكتمل بنسبة 80٪ (أساسي)', '80 pour cent terminé'),
(1055, '60_percent_complete', '60% Complete (info)', ' مكتمل بنسبة 60٪ (معلومات)', '60 pour cent terminé'),
(1056, '40_percent_complete', '40% Complete (warning)', 'اكتمل بنسبة 40٪ (تحذير)', '40 pour cent terminé'),
(1057, '20_percent_complete', '20% Complete (danger)', '20٪ إكتمل بنجاح بنسبة', '20 pour cent terminé'),
(1058, 'default_variant', 'Default variant', 'المتغير الافتراضي', 'variante par défaut'),
(1059, 'video_link', 'Video Link', 'رابط الفيديو', 'lien vidéo'),
(1060, 'send_your_review', 'Send Your Review', 'أرسل رأيك', 'envoyez votre avis'),
(1061, 'if_you_have_shopped_with_us_before', 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing & Shipping section.', 'إذا كنت قد قمت بالتسوق معنا من قبل ، فيرجى إدخال التفاصيل الخاصة بك في المربعات أدناه. إذا كنت عميلاً جديدًا ، فيرجى المتابعة إلى قسم الفواتير والشحن.', 'si vous avez déjà acheté chez nous'),
(1062, 'your_order', 'Your order', 'طلبك', 'votre commande'),
(1063, 'free_shipping', 'Free Shipping', 'الشحن مجانا', 'livraison gratuite'),
(1064, 'from_newyork', 'From 345/E NewYork', 'من 345 / شرق نيويورك', 'de New York'),
(1065, 'the_internet_tend_to_repeat', 'The internet Tend To Repeat', 'يميل الإنترنت إلى التكرار', 'Internet a tendance à répéter'),
(1066, '45_days_return', '45 Days Return', ' 45 يوم للإرجاع', '45 jours de retour'),
(1067, 'making_it_look_like_readable', 'Making it Look Like Readable', 'جعلها تبدو وكأنها مقروءة', 'le rendre lisible'),
(1068, 'opening_all_week', 'Opening All Week', 'مفتوح طوال الأسبوع', 'ouvert toute la semaine'),
(1069, '8am_9pm', '08AM - 09PM', '08 صباحًا - 09 مساءً', '8h 21h'),
(1070, 'ad_style', 'Ads Style', 'نمط الإعلانات', 'style d\'annonce'),
(1071, 'style_one', 'Style One', 'نمط واحد', 'style un'),
(1072, 'style_two', 'Style Two', 'النمط الثاني', 'style deux'),
(1073, 'style_three', 'Style Three', 'النمط الثالث', 'style trois'),
(1074, 'embed_code2', 'Embed Code2', 'كود الإلصاق 2', 'intégrer le code2'),
(1075, 'embed_code3', 'Embed Code3', 'كود التضمين 3', 'code d\'intégration3'),
(1076, 'url2', 'URL2', 'الرابط 2', 'URL2'),
(1077, 'url3', 'URL3', 'الرابط 3', 'URL3'),
(1078, 'image2', 'Image 2', 'الصورة 2', 'image2'),
(1079, 'image3', 'Image 3', 'صورة 3', 'image3'),
(1080, 'order_now', 'Order Now', 'اطلب الان', 'Commandez maintenant'),
(1081, 'default_variant_must_have_to_be_one_of_the_variants', 'Default variant must have to be one of the variants', 'يجب أن يكون المتغير الافتراضي أحد المتغيرات', 'la variante par défaut doit être l\'une des variantes'),
(1082, 'default_image', 'Default image', 'الصورة الافتراضية', 'image par défaut'),
(1083, 'meta_keyword', 'Meta keyword', 'كلمات ميتا الرئيسية ', 'méta-mot clé'),
(1084, 'meta_description', 'Meta description', 'وصف ميتا', 'Meta Description'),
(1085, 'this_email_already_exists', 'This email already exists', 'هذا البريد الإلكتروني موجود بالفعل', 'ce courriel existe déjà'),
(1086, 'you_cant_delete_this_is_default_store', 'You can\'t delete it. This is a default store. ', 'لا يمكنك حذفه. هذا هو المتجر الافتراضي.', 'vous ne pouvez pas supprimer ceci est le magasin par défaut'),
(1087, 'already_exists_please_login', 'This Email already exists please login or use another email. ', 'هذا البريد الإلكتروني موجود بالفعل يرجى تسجيل الدخول أو استخدام بريد إلكتروني آخر.', 'existe déjà merci de vous connecter'),
(1088, '4-5', '4-5', '4-5', '4-5'),
(1089, 'sign_office', 'Sign Office', 'مكتب التوقيع', 'enseigne'),
(1090, 'customer_sign', 'Customer Sign', 'تسجيل العميل', 'signe client'),
(1091, 'thank_you_for_shopping_with_us', 'Thank you for shopping with us.', 'شكرا للتسوق معنا.', 'merci d\'avoir magasiné avec nous'),
(1092, 'new_sale', 'New sale', 'بيع جديد', 'nouvelle vente'),
(1093, 'manage_sale', 'Manage sale', 'إدارة البيع', 'gérer la vente'),
(1094, 'pos_sale', 'Pos sale', 'بيع نقاط البيع', 'vente au point de vente'),
(1095, 'android_apps', 'Android apps', 'تطبيقات الأندرويد', 'Applications Android'),
(1096, 'update_your_android_apps_link', 'Update your android apps link', 'تحديث رابط تطبيقات الاندرويد الخاص بك', 'mettre à jour votre lien d\'applications Android'),
(1097, 'put_your_apps_link', 'Put your apps link', 'ضع رابط تطبيقاتك', 'mettez le lien de vos applications'),
(1098, 'go_to_website', 'Go to website', 'اذهب إلى الموقع', 'aller sur un site Internet'),
(1099, 'our_demo', 'Our demo', 'عرضنا', 'notre démo'),
(1100, 'note', 'Note', 'ملحوظة', 'Remarque'),
(1101, 'login', 'Login', 'تسجيل الدخول', 'connexion'),
(1102, 'email', 'Email Address', 'عنوان البريد الإلكتروني', 'e-mail'),
(1103, 'password', 'Password', 'كلمه السر', 'le mot de passe'),
(1104, 'reset', 'Reset', 'إعادة ضبط', 'réinitialiser'),
(1105, 'dashboard', 'Dashboard', 'لوحة التحكم', 'tableau de bord'),
(1106, 'home', 'Home', 'الصفحة الرئيسية', 'domicile'),
(1107, 'profile', 'Profile', 'الملف الشخصي', 'profil'),
(1108, 'profile_setting', 'Profile Setting', 'إعداد الملف الشخصي', 'paramètre de profil'),
(1109, 'firstname', 'First Name', 'الاسم الأول', 'prénom'),
(1110, 'lastname', 'Last Name', 'الكنية', 'nom de famille'),
(1111, 'about', 'About', 'عن', 'sur'),
(1112, 'preview', 'Preview', 'معاينة', 'Aperçu'),
(1113, 'image', 'Image', 'صورة', 'image'),
(1114, 'save', 'Save', 'يحفظ', 'enregistrer'),
(1115, 'upload_successfully', 'Upload Successfully!', 'تم الرفع بنجاح!', 'télécharger avec succès'),
(1116, 'user_added_successfully', 'User Added Successfully!', 'تمت إضافة المستخدم بنجاح', 'utilisateur ajouté avec succès'),
(1117, 'please_try_again', 'Please Try Again...', 'حاول مرة اخرى...', 'Veuillez réessayer'),
(1118, 'inbox_message', 'Inbox Messages', 'رسائل البريد الوارد', 'message de la boîte de réception'),
(1119, 'sent_message', 'Sent Message', 'الرسالة المرسلة', 'Message envoyé'),
(1120, 'message_details', 'Message Details', 'تفاصيل الرسالة', 'Détails du message'),
(1121, 'new_message', 'New Message', 'رسالة جديدة', 'nouveau message'),
(1122, 'receiver_name', 'Receiver Name', 'اسم المتلقي', 'nom du destinataire'),
(1123, 'sender_name', 'Sender Name', 'اسم المرسل', 'nom de l\'expéditeur'),
(1124, 'subject', 'Subject', 'موضوعات', 'matière'),
(1125, 'message', 'Message', 'رسالة', 'message'),
(1126, 'message_sent', 'Message Sent!', 'تم الارسال!', 'message envoyé'),
(1127, 'ip_address', 'IP Address', 'عنوان IP', 'adresse IP'),
(1128, 'last_login', 'Last Login', 'آخر تسجيل دخول', 'Dernière connexion'),
(1129, 'last_logout', 'Last Logout', 'آخر خروج', 'dernière déconnexion'),
(1130, 'status', 'Status', 'حالة', 'statut'),
(1131, 'deleted_successfully', 'Deleted Successfully!', 'حذف بنجاح!', 'Supprimé avec succès'),
(1132, 'send', 'Send', 'يرسل', 'envoyer'),
(1133, 'date', 'Date', 'تاريخ', 'Date'),
(1134, 'action', 'Action', 'عمل', 'action'),
(1135, 'sl_no', 'SL No.', 'الرقم التسلسلي', 'sl non'),
(1136, 'are_you_sure', 'Are You Sure ? ', 'هل أنت متأكد ؟', 'êtes-vous sûr'),
(1137, 'application_setting', 'Application Setting', 'اعدادات التطبيق', 'paramètre d\'application'),
(1138, 'application_title', 'Application Title', 'عنوان التطبيق', 'Titre de l\'application'),
(1139, 'address', 'Address', 'عنوان', 'adresse'),
(1140, 'phone', 'Phone', 'هاتف', 'téléphoner'),
(1141, 'favicon', 'Favicon', 'ايقونة التفضيلات', 'favicon'),
(1142, 'logo', 'Logo', 'شعار', 'logo'),
(1143, 'language', 'Language', 'لغة', 'Langue'),
(1144, 'left_to_right', 'Left To Right', 'من اليسار إلى اليمين', 'de gauche à droite'),
(1145, 'right_to_left', 'Right To Left', 'من اليمين الى اليسار', 'de droite à gauche'),
(1146, 'footer_text', 'Footer Text', 'نص التذييل', 'texte de pied de page'),
(1147, 'site_align', 'Application Alignment', 'محاذاة التطبيق', 'aligner le site'),
(1148, 'welcome_back', 'Welcome Back!', 'مرحبا بعودتك!', 'content de te revoir'),
(1149, 'please_contact_with_admin', 'Please Contact With Admin', 'يرجى التواصل مع المسؤول', 'veuillez contacter l\'administrateur'),
(1150, 'incorrect_email_or_password', 'Incorrect Email/Password', 'البريد الإلكتروني / كلمة المرور غير صحيحة', 'email ou mot de passe incorrect'),
(1151, 'select_option', 'Select Option', 'حدد خيار', 'sélectionner l\'option'),
(1152, 'ftp_setting', 'Data Synchronize [FTP Setting]', 'مزامنة البيانات [إعداد FTP]', 'réglage ftp'),
(1153, 'hostname', 'Host Name', 'اسم المضيف', 'nom d\'hôte'),
(1154, 'username', 'Username', 'اسم المستخدم', 'Nom d\'utilisateur'),
(1155, 'ftp_port', 'FTP Port', 'منفذ FTP', 'port ftp'),
(1156, 'ftp_debug', 'FTP Debug', 'تصحيح أخطاء FTP', 'débogage ftp'),
(1157, 'project_root', 'Project Root', 'جذر المشروع', 'racine du projet');
INSERT INTO `language` (`id`, `phrase`, `english`, `arabic`, `franais`) VALUES
(1158, 'update_successfully', 'Update Successfully', 'تم التحديث بنجاح', 'mise à jour réussie'),
(1159, 'save_successfully', 'Save Successfully!', 'حفظ بنجاح!', 'sauvegarde réussie'),
(1160, 'delete_successfully', 'Delete Successfully!', 'تم الحذف بنجاح!', 'supprimer avec succès'),
(1161, 'internet_connection', 'Internet Connection', 'اتصال الإنترنت', 'connexion Internet'),
(1162, 'ok', 'Ok', 'نعم', 'd\'accord'),
(1163, 'not_available', 'Not Available', 'غير متوفر', 'indisponible'),
(1164, 'available', 'Available', 'متوفرة', 'disponible'),
(1165, 'outgoing_file', 'Outgoing File', 'ملف صادر', 'fichier sortant'),
(1166, 'incoming_file', 'Incoming File', 'ملف وارد', 'fichier entrant'),
(1167, 'data_synchronize', 'Data Synchronize', 'مزامنة البيانات', 'synchronisation des données'),
(1168, 'unable_to_upload_file_please_check_configuration', 'Unable to upload file! please check configuration', 'لا يمكن تحميل الملف! يرجى التحقق من الاعدادات', 'impossible de télécharger le fichier, veuillez vérifier la configuration'),
(1169, 'please_configure_synchronizer_settings', 'Please configure synchronizer settings', 'يرجى تهيئة إعدادات المزامنة', 'veuillez configurer les paramètres du synchroniseur'),
(1170, 'download_successfully', 'Download Successfully', 'تم التنزيل بنجاح', 'télécharger avec succès'),
(1171, 'unable_to_download_file_please_check_configuration', 'Unable to download file! please check configuration', 'غير قادر على تحميل الملف! يرجى التحقق من الاعدادات', 'impossible de télécharger le fichier, veuillez vérifier la configuration'),
(1172, 'data_import_first', 'Data Import First', 'استيراد البيانات أولاً', 'importer les données en premier'),
(1173, 'data_import_successfully', 'Data Import Successfully!', 'تم استيراد البيانات بنجاح!', 'importation des données réussie'),
(1174, 'unable_to_import_data_please_check_config_or_sql_file', 'Unable to import data! please check configuration / SQL file.', 'تعذر استيراد البيانات! يرجى التحقق من ملف الاعدادات / SQL.', 'impossible d\'importer des données, veuillez vérifier le fichier de configuration ou sql'),
(1175, 'download_data_from_server', 'Download Data from Server', 'تنزيل البيانات من الخادم', 'télécharger les données du serveur'),
(1176, 'data_import_to_database', 'Data Import To Database', 'استيراد البيانات إلى قاعدة البيانات', 'importation de données dans la base de données'),
(1177, 'data_upload_to_server', 'Data Upload to Server', 'تحميل البيانات إلى الخادم', 'téléchargement de données sur le serveur'),
(1178, 'please_wait', 'Please Wait...', 'الرجاء الانتظار...', 'S\'il vous plaît, attendez'),
(1179, 'ooops_something_went_wrong', ' Ooops something went wrong...', '  عفوًا ، حدث خطأ ما ...', 'oups quelque chose s\'est mal passé'),
(1180, 'module_permission_list', 'Module Permission List', 'قائمة أذونات الوحدة النمطية', 'liste des autorisations des modules'),
(1181, 'user_permission', 'User Permission', 'إذن المستخدم', 'autorisation de l\'utilisateur'),
(1182, 'add_module_permission', 'Add Module Permission', 'إضافة إذن الوحدة النمطية', 'ajouter une autorisation de module'),
(1183, 'module_permission_added_successfully', 'Module Permission Added Successfully!', 'تمت إضافة إذن الوحدة النمطية بنجاح!', 'autorisation de module ajoutée avec succès'),
(1184, 'update_module_permission', 'Update Module Permission', 'تحديث إذن الوحدة النمطية', 'mettre à jour l\'autorisation du module'),
(1185, 'download', 'Download', 'تحميل', 'Télécharger'),
(1186, 'module_name', 'Module Name', 'اسم وحدة', 'nom du module'),
(1187, 'create', 'Create', 'إنشاء', 'créer'),
(1188, 'read', 'Read', 'يقرأ', 'lis'),
(1189, 'update', 'Update', 'تحديث', 'mettre à jour'),
(1190, 'delete', 'Delete', 'حذف', 'effacer'),
(1191, 'module_list', 'Module List', 'قائمة الوحدة', 'liste des modules'),
(1192, 'add_module', 'Add Module', 'إضافة وحدة', 'ajouter un module'),
(1193, 'directory', 'Module Direcotory', 'دليل الوحدة', 'annuaire'),
(1194, 'description', 'Description', 'وصف', 'la description'),
(1195, 'image_upload_successfully', 'Image Upload Successfully!', 'تم تحميل الصورة بنجاح!', 'téléchargement d\'image avec succès'),
(1196, 'module_added_successfully', 'Module Added Successfully', 'تمت إضافة الوحدة بنجاح', 'module ajouté avec succès'),
(1197, 'inactive', 'Inactive', 'غير نشط', 'inactif'),
(1198, 'active', 'Active', 'نشيط', 'actif'),
(1199, 'user_list', 'User List', 'قائمة المستخدم', 'liste d\'utilisateur'),
(1200, 'see_all_message', 'See All Messages', 'مشاهدة كل الرسائل', 'voir tous les messages'),
(1201, 'setting', 'Setting', 'ضبط', 'paramètre'),
(1202, 'logout', 'Logout', 'تسجيل خروج', 'Se déconnecter'),
(1203, 'admin', 'Admin', 'مشرف', 'administrateur'),
(1204, 'add_user', 'Add User', 'إضافة مستخدم', 'ajouter un utilisateur'),
(1205, 'user', 'User', 'مستخدم', 'utilisateur'),
(1206, 'module', 'Module', 'وحدة', 'module'),
(1207, 'new', 'New', 'جديد', 'Nouveau'),
(1208, 'inbox', 'Inbox', 'صندوق الوارد', 'boîte de réception'),
(1209, 'sent', 'Sent', 'أرسلت', 'expédié'),
(1210, 'synchronize', 'Synchronize', 'تزامن', 'synchroniser'),
(1211, 'data_synchronizer', 'Data Synchronizer', 'مزامنة البيانات', 'synchroniseur de données'),
(1212, 'module_permission', 'Module Permission', 'إذن الوحدة النمطية', 'autorisation des modules'),
(1213, 'backup_now', 'Backup Now!', 'إعمل نسخة احتياطية الان', 'sauvegarder maintenant'),
(1214, 'restore_now', 'Restore Now!', 'استعادة الآن!', 'restaurer maintenant'),
(1215, 'backup_and_restore', 'Backup and Restore', 'النسخ الاحتياطي واستعادة', 'sauvegarde et restauration'),
(1216, 'captcha', 'Captcha Word', 'كلمة التحقق', 'captcha'),
(1217, 'database_backup', 'Database Backup', 'النسخه الاحتياطيه لقاعدة البيانات', 'sauvegarde de la base de données'),
(1218, 'restore_successfully', 'Restore Successfully', 'تمت الاستعادة بنجاح', 'restaurer avec succès'),
(1219, 'backup_successfully', 'Backup Successfully', 'تم النسخ الاحتياطي بنجاح', 'sauvegarde réussie'),
(1220, 'filename', 'File Name', 'اسم الملف', 'nom de fichier'),
(1221, 'file_information', 'File Information', 'معلومات الملف', 'informations sur le fichier'),
(1222, 'size', 'size', 'الحجم', 'Taille'),
(1223, 'backup_date', 'Backup Date', 'تاريخ النسخ الاحتياطي', 'date de sauvegarde'),
(1224, 'overwrite', 'Overwrite', 'الكتابة فوق', 'écraser'),
(1225, 'invalid_file', 'Invalid File!', 'ملف غير صالح!', 'Fichier non valide'),
(1226, 'invalid_module', 'Invalid Module', 'وحدة غير صالحة', 'module invalide'),
(1227, 'remove_successfully', 'Remove Successfully!', 'تمت الإزالة بنجاح!', 'supprimer avec succès'),
(1228, 'install', 'Install', 'تثبيت', 'installer'),
(1229, 'uninstall', 'Uninstall', 'الغاء التثبيت', 'désinstaller'),
(1230, 'tables_are_not_available_in_database', 'Tables are not available in database.sql', 'الجداول غير متوفرة في database.sql', 'les tables ne sont pas disponibles dans la base de données'),
(1231, 'no_tables_are_registered_in_config', 'No tables are registerd in config.php', 'لا توجد جداول مسجلة في config.php', 'aucune table n\'est enregistrée dans la configuration'),
(1232, 'enquiry', 'Enquiry', 'سؤال', 'demande'),
(1233, 'read_unread', 'Read/Unread', 'قراءة / غير مقروءة', 'lu non lu'),
(1234, 'enquiry_information', 'Enquiry Information', 'معلومات الاستفسار', 'informations d\'enquête'),
(1235, 'user_agent', 'User Agent', 'وكيل المستخدم', 'agent utilisateur'),
(1236, 'checked_by', 'Checked By', 'فحص بواسطة', 'vérifié par'),
(1237, 'new_enquiry', 'New Enquiry', 'تحقيق جديد', 'nouvelle enquête'),
(1238, 'first_name_is_required', 'First name is required', 'الإسم الأول مطلوب', 'Le prénom est requis'),
(1239, 'last_name_is_required', 'Last name is required', 'إسم العائلة مطلوب', 'le nom de famille est requis'),
(1240, 'mobile_is_required', 'Mobile is required', 'الجوال مطلوب', 'mobile est requis'),
(1241, 'country_is_required', 'Country is required', 'الدولة مطلوبة', 'le pays est obligatoire'),
(1242, 'address_is_required', 'Address is required', 'العنوان مطلوب', 'l\'adresse est obligatoire'),
(1243, 'state_is_required', 'State is required', 'الدولة مطلوبة', 'l\'état est obligatoire'),
(1244, 'failed_try_again', 'Failed! Please try again.', 'باءت بالفشل! حاول مرة اخرى.', 'échec réessayer'),
(1245, 'failed', 'Failed', 'باءت بالفشل', 'manqué'),
(1246, 'subscribe_for_news_and', 'Subscribe for news and', 'اشترك للحصول على الأخبار و', 'abonnez-vous aux nouvelles et'),
(1247, 'subscribe', 'Subscribe', 'الإشتراك', 's\'abonner'),
(1248, 'reviews', 'Reviews', 'المراجعات', 'Commentaires'),
(1249, 'feedback', 'Feedback', 'استجابة', 'retour d\'information'),
(1250, 'unit_id', 'Unit ID', 'معرف الوحدة', 'identifiant de l\'unité'),
(1251, 'set_default', 'Set default', 'الوضع الإفتراضي', 'définir par defaut'),
(1252, 'add', 'Add', 'يضيف', 'ajouter'),
(1253, 'list', 'List', 'قائمة', 'liste'),
(1254, 'invalid_coupon', 'Invalid Coupon', 'قسيمة غير صالحة', 'coupon invalide'),
(1255, 'login_to_apply_coupon', 'Login to apply coupon', 'تسجيل الدخول لتطبيق القسيمة', 'connectez-vous pour appliquer le coupon'),
(1256, 'great_your_coupon_is_applied', 'Great! Your coupon is applied', 'رائعة! تم تطبيق قسيمتك', 'super votre coupon est appliqué'),
(1257, 'fe_color5', 'color5=Header Top Bar', 'اللون 5 = رأس الشريط العلوي', 'fe color5'),
(1258, 'receiver_email', 'Receiver email', 'البريد الإلكتروني المتلقي', 'e-mail du destinataire'),
(1259, 'modules', 'Modules', 'الوحدات', 'modules'),
(1260, 'modules_management', 'Modules Management', 'إدارة الوحدات', 'gestion des modules'),
(1261, 'buy_now', 'Buy now', 'اشتري الآن', 'Acheter maintenant'),
(1262, 'no_theme_available', 'No Theme Available!', 'لا يوجد موضوع متاح!', 'aucun thème disponible'),
(1263, 'purchase_key', 'Purchase Key', 'مفتاح الشراء', 'clé d\'achat'),
(1264, 'invalid_purchase_key', 'Invalid Purchase Key', 'مفتاح شراء غير صالح', 'clé d\'achat invalide'),
(1265, 'theme_deleted_successfully', 'Theme Deleted Successfully', 'تم حذف الموضوع بنجاح', 'thème supprimé avec succès'),
(1266, 'downloaded_successfully', 'Downloaded Successfully', 'تم التنزيل بنجاح', 'téléchargé avec succès'),
(1267, 'slider_category', 'Slider Category', 'فئة شريط التمرير', 'catégorie de curseur'),
(1268, 'clear_cart', 'Clear Cart', 'مسح السلة', 'vider le panier'),
(1269, 'continue_shopping', 'Continue Shopping', 'مواصلة التسوق', 'Continuer vos achats'),
(1270, 'my_cart', 'My Cart', 'عربة التسوق الخاصة بي', 'mon panier'),
(1271, 'favorites', 'Favorites', 'المفضلة', 'favoris'),
(1272, 'states', 'States', 'الدولة', 'États'),
(1273, 'manage_states', 'Manage States', 'إدارة الدول', 'gérer les états'),
(1274, 'add_state', 'Add State', 'أضف دولة', 'ajouter un état'),
(1275, 'edit_state', 'Edit State', 'تحرير الدولة', 'modifier l\'état'),
(1276, 'connect_with_us', 'Connect With Us', 'اتصل بنا', 'Connecte-toi avec nous'),
(1277, 'footer_block_1', 'Footer Block 1', 'خانة التذييل 1', 'bloc de pied de page 1'),
(1278, 'footer_block_2', 'Footer Block 2', 'خانة التذييل 2', 'bloc de pied de page 2'),
(1279, 'footer_block_3', 'Footer Block 3', 'خانة التذييل 3', 'pied de page bloc 3'),
(1280, 'footer_block_4', 'Footer Block 4', 'خانة التذييل 4', 'bloc de pied de page 4'),
(1281, 'show', 'Show', 'إظهار', 'Afficher'),
(1282, 'hide', 'Hide', 'إخفاء', 'cacher'),
(1283, 'mobile_settings', 'Mobile Settings (For website Footer)', 'إعدادات الهاتف المحمول (لتذييل موقع الويب)', 'paramètres mobiles'),
(1284, 'social_share', 'Social Share', 'حصة الاجتماعي', 'Partage Social'),
(1285, 'bank', 'Bank', 'البنك', 'banque'),
(1286, 'order_placed', 'Your order has been successfully placed', 'تم وضع طلبك بنجاح', 'commande passée'),
(1287, 'update_woocommerce_stock', 'Update Woocommerce Stock', 'تحديث مخزون Woocommerce', 'mettre à jour le stock de woocommerce'),
(1288, 'track_my_order', 'Track My Order', 'تابع طلبي', 'suivre ma commande'),
(1289, 'no_data_found', 'No data found', 'لاتوجد بيانات', 'Aucune donnée disponible'),
(1290, 'payment_status', 'Payment Status', 'حالة السداد', 'statut de paiement'),
(1291, 'order_status', 'Order Status', 'حالة الطلب', 'statut de la commande'),
(1292, 'latest_search_keywords', 'Latest Search Keywords', 'أحدث كلمات البحث', 'derniers mots-clés de recherche'),
(1293, 'keywords', 'Keywords', 'الكلمات الدالة', 'mots clés'),
(1294, 'results', 'Results', 'نتائج', 'résultats'),
(1295, 'hits', 'Hits', 'الزيارات', 'les coups'),
(1296, 'latest_product_reviews', 'Latest Product Reviews', 'أحدث مراجعات المنتجات', 'dernières critiques de produits'),
(1297, 'products', 'Products', 'منتجات', 'des produits'),
(1298, 'category_products', 'Category Products', 'فئة المنتجات', 'produits de la catégorie'),
(1299, 'categories', 'Categories', 'فئات', 'catégories'),
(1300, 'products_count', 'Products Count', 'عدد المنتجات', 'les produits comptent'),
(1301, 'bank', 'Bank', 'البنك', 'banque'),
(1302, 'orders_count', 'orders Count', 'عدد الطلبات', 'les commandes comptent'),
(1303, 'all_best_sale_product', 'All Best Sale Product', 'أفضل بيع المنتج', 'tous les meilleurs produits de vente'),
(1304, 'monthly_best_sale_product', 'Monthly Best Sale Product', 'أفضل منتج مبيع شهريًا', 'meilleur produit de vente mensuel'),
(1305, 'role', 'Role', 'دور', 'rôle'),
(1306, 'add_role', 'Add Role', 'أضف دورًا', 'ajouter un rôle'),
(1307, 'manage_roles', 'Manage Roles', 'إدارة الأدوار', 'gérer les rôles'),
(1308, 'manage_user_roles', 'Manage User Roles', 'إدارة أدوار المستخدم', 'gérer les rôles des utilisateurs'),
(1309, 'role_name', 'Role Name', 'اسم الدور', 'nom de rôle'),
(1310, 'role_description', 'Role Description', 'وصف الدور', 'Description du rôle'),
(1311, 'menu_title', 'Menu Title', 'عنوان القائمة', 'titre du menu'),
(1312, 'role_edit', 'Role Edit', 'تحرير الدور', 'rôle modifier'),
(1313, 'user_access_role', 'User Access Role', 'دور وصول المستخدم', 'rôle d\'accès utilisateur'),
(1314, 'role_add_to_user', 'Role Add To User', 'الدور إضافة إلى المستخدم', 'rôle ajouter à l\'utilisateur'),
(1315, 'variant_type', 'Variant Type', 'نوع المتغير', 'type de variante'),
(1316, 'color', 'Color', 'اللون', 'Couleur'),
(1317, 'color_code', 'Color Code', 'رمز اللون', 'code couleur'),
(1318, 'set_variant_wise_price', 'Set Variant Wise Price', 'حدد المتغير (فلترة حسب السعر)', 'définir le prix de la variante'),
(1319, 'all_category_products', 'All Category Products', 'جميع منتجات الفئات', 'tous les produits de la catégorie'),
(1320, 'all_latest_search_keywords', 'All Latest Search Keywords', 'جميع أحدث كلمات البحث', 'tous les derniers mots-clés de recherche'),
(1321, 'positive_review', 'Positive Review', 'مراجعة إيجابية', 'avis positif'),
(1322, 'all_category_products', 'All Category Products', 'جميع منتجات الفئات', 'tous les produits de la catégorie'),
(1323, 'all_latest_search_keywords', 'All Latest Search Keywords', 'جميع أحدث كلمات البحث', 'tous les derniers mots-clés de recherche'),
(1324, 'positive_review', 'Positive Review', 'مراجعة إيجابية', 'avis positif'),
(1325, 'customer_activities', 'Customer Activities', 'أنشطة العملاء', 'activités clients'),
(1326, 'new_customers', 'New Customers', 'زبائن الجدد', 'nouveaux clients'),
(1327, 'returning_customers', 'Returning Customers', 'العملاء الذين يقومون بإرجاع', 'clients fidèles'),
(1328, 'average_spending_per_visit', 'Average Spending Per Visit', 'متوسط الإنفاق لكل زيارة', 'dépense moyenne par visite'),
(1329, 'average_visits_per_customer', 'Average Visits Per Customer', 'متوسط عدد الزيارات لكل عميل', 'visites moyennes par client'),
(1330, 'seo_tools', 'SEO Tools', 'أدوات تحسين محركات البحث', 'outils de référencement'),
(1331, 'popular_products', 'Popular Products', 'المنتجات الشعبية', 'Produits populaires'),
(1332, 'website_meta_keywords', 'Website Meta Keywords', 'الكلمات المفتاحية للموقع', 'méta-mots-clés du site Web'),
(1333, 'meta_keywords', 'Meta Keywords', 'كلمات دلالية', 'méta-mots-clés'),
(1334, 'clicks', 'Clicks', 'نقرات', 'clics'),
(1335, 'created_by', 'Created by', 'انشأ من قبل', 'créé par'),
(1336, 'product_added_to_compare', 'Product Added to Compare', 'تمت إضافة المنتج للمقارنة', 'produit ajouté pour comparer'),
(1337, 'compare', 'Compare', 'قارن', 'comparer'),
(1338, 'bonus', 'Bonus', 'علاوة', 'prime'),
(1339, 'edit_delivery_boy', 'Edit Delivery Boy', 'تحرير التوصيل', 'modifier livreur'),
(1340, 'national_id_card', 'National Id Card', 'بطاقة الهوية الوطنية', 'carte d\'identité nationale'),
(1341, 'driving_license', 'Driving License', 'رخصة قيادة', 'permis de conduire'),
(1342, 'other_payment_info', 'Other Payment Info.', 'معلومات الدفع الأخرى.', 'autres informations de paiement'),
(1343, 'add_time_slot', 'Add Time Slot', 'أضف فترة زمنية', 'ajouter un créneau horaire'),
(1344, 'from_time', 'From Time', 'من وقت', 'de temps'),
(1345, 'to_time', 'To Time', 'الى وقت', 'au temps'),
(1346, 'last_order_time', 'Last Order Time', 'وقت الطلب الأخير', 'heure de la dernière commande'),
(1347, 'edit_delivery_time_slot', 'Edit Delivery Time Slot', 'تحرير وقت التسليم', 'modifier le créneau horaire de livraison'),
(1348, 'paid_by', 'Paid By', 'دفع بواسطة', 'payé par'),
(1349, 'transferred_at', 'Transferred At', 'تم النقل في', 'transféré à'),
(1350, 'assign_time_slot', 'Assign Time Slot', 'تخصيص فترة زمنية', 'attribuer un créneau horaire'),
(1351, 'delivery_zone', 'Delivery Zone', 'منطقة التسليم', 'zone de livraison'),
(1352, 'manage_delivery_zone', 'Manage Delivery Zone', 'إدارة منطقة التسليم', 'gérer la zone de livraison'),
(1353, 'edit_delivery_zone', 'Edit Delivery Zone', 'تحرير منطقة التسليم', 'modifier la zone de livraison'),
(1354, 'assign_delivery', 'Assign Delivery', 'تعيين التسليم', 'attribuer la livraison'),
(1355, 'select_delivery_zone', 'Select Delivery Zone', 'حدد منطقة التسليم', 'sélectionner la zone de livraison'),
(1356, 'select_delivery_boy', 'Select Delivery Boy', 'حدد التوصيل', 'sélectionner le livreur'),
(1357, 'manage_assign_delivery', 'Manage Assign Delivery', 'إدارة تعيين التسليم', 'gérer assigner la livraison'),
(1358, 'orders', 'Orders', 'الطلبات', 'ordres'),
(1359, 'select_order', 'Select Order', 'اختر طلبا', 'sélectionner la commande'),
(1360, 'successfully_assigned', 'Successfully Assigned', 'تم التعيين بنجاح', 'attribué avec succès'),
(1361, 'assigns', 'Assigns', 'يعيّن', 'assigne'),
(1362, 'manage_assigned_delivery', 'Manage Assigned Delivery', 'إدارة التسليم المعين', 'gérer la livraison assignée'),
(1363, 'time_slot', 'Time Slot', 'فسحة زمنية', 'créneau horaire'),
(1364, 'select_time_slot', 'Select Time Slot', 'حدد فترة زمنية', 'sélectionner un créneau horaire'),
(1365, 'select_orders', 'Select Orders', 'حدد الطلبات', 'sélectionner les commandes'),
(1366, 'delivery_id', 'Delivery Id', 'معرّف التسليم', 'identifiant de livraison'),
(1367, 'assigned_delivery_orders', 'Assigned Delivery Orders', 'أوامر التسليم المعينة', 'ordres de livraison attribués'),
(1368, 'edit_assigned_delivery', 'Edit Assigned Delivery', 'تحرير التسليم المعين', 'modifier la livraison attribuée'),
(1369, 'completed_at', 'Completed At', 'اكتمل في', 'terminé à'),
(1370, 'delivery_assigns', 'Delivery Assigns', 'تعيينات التسليم', 'livraison assigne'),
(1371, 'delivery_system', 'Delivery System', 'نظام التوصيل', 'système de livraison'),
(1372, 'delivery_boy', 'Delivery Boy', 'التوصيل', 'livreur'),
(1373, 'add_delivery_boy', 'Add Delivery Boy', 'إضافة  التوصيل', 'ajouter un livreur'),
(1374, 'manage_delivery_boy', 'Manage Delivery Boy', 'إدارة التوصيل', 'gérer le livreur'),
(1375, 'delivery_slot', 'Delivery Slot', 'فتحة التوصيل', 'créneau de livraison'),
(1376, 'manage_time_slot', 'Manage Time Slot', 'إدارة الفترة الزمنية', 'gérer le créneau horaire'),
(1377, 'birth_certificate', 'Birth Certificate', 'شهادة الميلاد', 'certificat de naissance'),
(1378, 'date_of_birth', 'Date of Birth', 'تاريخ الولادة', 'date de naissance'),
(1379, 'bank_account_name', 'Bank Account Name', 'اسم الحساب المصرفي', 'nom du compte bancaire'),
(1380, 'delivery_balance_transfer', 'Delivery Balance Transfer', 'تحويل رصيد التسليم', 'transfert de solde de livraison'),
(1381, 'transfer_amount', 'Transfer Amount', 'مبلغ التحويل', 'montant du transfert'),
(1382, 'amount', 'Amount', 'كمية', 'montant'),
(1383, 'successfully_transferred', 'Successfully Transferred', 'تم التحويل بنجاح', 'transféré avec succès'),
(1384, 'balance_transfer', 'Balance Transfer', 'تحويل الرصيد', 'transfert de solde'),
(1385, 'balance_transfer_history', 'Balance Transfer History', 'تاريخ تحويل الرصيد', 'historique des transferts de solde'),
(1386, 'out_of_balance', 'Out of Balance', 'غير متوازن', 'hors de l\'équilibre'),
(1387, 'delivery_area', 'Delivery Area', 'منطقة التسليم', 'zone de livraison'),
(1388, 'add_delivery_zone', 'Add Delivery Zone', 'أضف منطقة التوصيل', 'ajouter une zone de livraison'),
(1389, 'created_at', 'Created at', 'أنشئت في', 'créé à'),
(1390, 'role_user', 'Role User', 'مستخدم الدور', 'utilisateur de rôle'),
(1391, 'newsletters', 'Newsletters', 'النشرات الإخبارية', 'bulletins d\'information'),
(1392, 'compare_product', 'Compare Product', 'قارن المنتج', 'comparer le produit'),
(1393, 'models', 'Models', 'عارضات ازياء', 'des modèles'),
(1394, 'order_title', 'Order Title', 'عنوان الطلب', 'titre de la commande'),
(1395, 'in_amount', 'In Amount', 'في المبلغ', 'en amont'),
(1396, 'out_amount', 'Out Amount', 'المبلغ الناتج', 'montant'),
(1398, 'net_total', 'Net Total', 'صافي الإجمالي', 'total net'),
(1399, 'purchase_order', 'Purchase Order', 'أمر شراء', 'bon de commande'),
(1400, 'add_purchase_order', 'Add Purchase Order', 'إضافة طلب شراء', 'ajouter un bon de commande'),
(1401, 'manage_purchase_order', 'Manage Purchase Order', 'إدارة طلب الشراء', 'gérer le bon de commande'),
(1402, 'create_purchase_order', 'Create Purchase Order', 'إنشاء أمر شراء', 'créer un bon de commande'),
(1403, 'receive_item', 'Receive Item', 'استلام السلعة', 'recevoir l\'article'),
(1404, 'approved', 'Approved', 'وافق', 'approuvé'),
(1405, 'received', 'Received', 'تم الاستلام', 'reçu'),
(1406, 'not_received', 'Not Received', 'لم يتم الاستلام', 'non reçu'),
(1408, 'view_details', 'View Details', 'عرض التفاصيل', 'voir les détails'),
(1409, 'return_item', 'Return Item', 'إرجاع البند', 'retourner l\'objet'),
(1410, 'vat_no', 'VAT No', 'ضريبة القيمة المضافة لا', 'numéro de TVA'),
(1411, 'cr_no', 'CR No', 'رقم CR', 'cr non'),
(1412, 'pay_amount', 'Pay Amount', 'مقدار الأجر', 'payer le montant'),
(1437, 'chart_of_account', 'Chart of Account', 'الرسم البياني للحساب', 'Charte d\'utilisation'),
(1438, 'opening_balance', 'Opening Balance', 'الرصيد الافتتاحي', 'solde d\'ouverture'),
(1439, 'supplier_payment', 'Supplier Payment', 'دفع المورد', 'paiement fournisseur'),
(1440, 'customer_receive', 'Customer Receive', 'تلقي العميل', 'le client reçoit'),
(1441, 'cash_adjustment', 'Cash Adjustment', 'تسوية نقدية', 'ajustement en espèces'),
(1442, 'debit_voucher', 'Debit Voucher', 'قسيمة الخصم', 'bon de débit'),
(1443, 'credit_voucher', 'Credit Voucher', 'قسيمة الائتمان', 'bon de crédit'),
(1444, 'contra_voucher', 'Contra Voucher', 'قسيمة كونترا', 'contre bon'),
(1445, 'journal_voucher', 'Journal Voucher', 'قسيمة دفتر اليومية', 'bon de journal'),
(1446, 'voucher_approval', 'Voucher Approval', 'الموافقة على القسيمة', 'approbation du bon'),
(1447, 'voucher_no', 'Voucher No', 'رقم القسيمة', 'bon non'),
(1448, 'account_head', 'Account Head', 'اسم الحساب', 'chef de compte'),
(1449, 'remark', 'Remark', 'ملاحظة', 'remarque'),
(1450, 'receipt_voucher', 'Receipt Voucher', 'سند القبض', 'bon de réception'),
(1451, 'receipt_voucher_form', 'Receipt Voucher Form', 'نموذج إيصال استلام', 'formulaire de bon de réception'),
(1452, 'manage_receipt_voucher', 'Manage Receipt Voucher', 'إدارة إيصال الإيصال', 'gérer le bon de réception'),
(1453, 'voucher_no', 'Voucher No', 'رقم القسيمة', 'bon non'),
(1454, 'payment_voucher', 'Payment Voucher', 'قسيمة دفع', 'bon de paiement'),
(1455, 'payment_voucher_form', 'Payment Voucher Form', 'نموذج قسيمة الدفع', 'formulaire de bon de paiement'),
(1456, 'customer_balance', 'Customer Balance', 'رصيد العميل', 'solde client'),
(1457, 'vat', 'Vat', 'ضريبة القيمة المضافة', 'T.V.A'),
(1458, 'total_balance', 'Total Balance', 'إجمالي الرصيد', 'solde total'),
(1459, 'remaining_balance', 'Remaining Balance', 'الرصيد المتبقي', 'solde restant'),
(1460, 'pay_vat', 'Pay Vat', 'دفع ضريبة القيمة المضافة', 'payer la TVA'),
(1461, 'pay_amount', 'Pay Amount', 'مقدار الأجر', 'payer le montant'),
(1462, 'whatsapp_info', 'Whatsapp Info', 'معلومات واتس اب', 'infos WhatsApp'),
(1463, 'add_whatsapp_info', 'Add Whatsapp Info', 'أضف معلومات واتساب', 'ajouter des informations WhatsApp'),
(1464, 'whatsapp_number', 'Whatsapp Number', 'رقم الواتس اب', 'numéro WhatsApp'),
(1465, 'add_invoice_text', 'Add Invoice Text', 'أضف نص الفاتورة', 'ajouter le texte de la facture'),
(1466, 'invoice_text', 'Invoice Text', 'نص الفاتورة', 'texte de la facture'),
(1467, 'cash_payment', 'Cash Payment', 'دفع نقدا', 'paiement en espèces'),
(1468, 'bank_payment', 'Bank Payment', 'دفعة بنكية', 'paiement bancaire'),
(1469, 'adjustment_type', 'Adjustment Type', 'نوع التعديل', 'type de réglage'),
(1470, 'code', 'Code', 'الشفرة', 'code'),
(1471, 'paytype', 'Paytype', 'نوع الدفع', 'type de paiement'),
(1472, 'txtCode', 'TxtCode', 'الرمز النصي', 'txtCode'),
(1473, 'credit_account_head', 'Credit Account Head', 'اسم حساب الائتمان', 'responsable de compte de crédit'),
(1474, 'code', 'Code', 'الرمز', 'code'),
(1475, 'successfully_approved', 'Successfully Approved', 'تمت الموافقة بنجاح', 'approuvé avec succès'),
(1476, 'debit_account_head', 'Debit Account Head', 'رئيس حساب الخصم', 'chef de compte débiteur'),
(1477, 'add_more', 'Add More', 'أضف المزيد', 'ajouter plus'),
(1478, 'update_debit_voucher', 'Update Debit Voucher', 'تحديث قسيمة الخصم', 'mettre à jour le bon de débit'),
(1479, 'update_credit_voucher', 'Update Credit Voucher', 'تحديث قسيمة الائتمان', 'mettre à jour le bon de crédit'),
(1480, 'update_journal_voucher', 'Update Journal Voucher', 'تحديث قسيمة دفتر اليومية', 'mettre à jour le bon de journal'),
(1481, 'update_contra_voucher', 'Update Contra Voucher', 'تحديث قسيمة كونترا', 'mettre à jour le bon de contre-vérification'),
(1482, 'order_csv_export', 'Order CSV Export', 'طلب تصدير CSV', 'commander l\'exportation csv'),
(1483, 'export_csv', 'Export CSV', 'تصدير CSV', 'exporter csv'),
(1484, 'credit_account_head', 'Credit Account Head', 'رئيس حساب الائتمان', 'responsable de compte de crédit'),
(1485, 'code', 'Code', 'الشفرة', 'code'),
(1486, 'successfully_approved', 'Successfully Approved', 'تمت الموافقة بنجاح', 'approuvé avec succès'),
(1487, 'customer_head_code', 'Customer Head Code', 'رمز رئيس العميل', 'code client principal'),
(1488, 'current_balance', 'Current Balance', 'الرصيد الحالي', 'Solde actuel'),
(1489, 'total_vat', 'Total Vat', 'إجمالي ضريبة القيمة المضافة', 'TVA totale'),
(1490, 'ooops_order_list_is_empty', 'Ooops Order List is Empty', 'قائمة أوامر خطأ فارغة', 'oups la liste de commande est vide'),
(1491, 'filtration', 'Filtration', 'الترشيح', 'filtration'),
(1492, 'add_filter', 'Add Filter', 'أضف عامل تصفية', 'ajouter un filtre'),
(1493, 'manage_filters', 'Manage Filters', 'إدارة المرشحات', 'gérer les filtres'),
(1494, 'filter_names', 'Filter Names', 'أسماء المرشح', 'noms de filtres'),
(1495, 'filter_type', 'Filter Type', 'نوع التصنيف', 'type de filtre'),
(1496, 'edit_filter', 'Edit Filter', 'تحرير عامل التصفية', 'modifier le filtre'),
(1497, 'account_reports', 'Account Reports', 'تقارير الحساب', 'rapports de compte'),
(1498, 'general_ledger', 'General Ledger', 'دفتر الأستاذ العام', 'grand livre général'),
(1499, 'profit_loss', 'Profit Loss', 'خسارة الأرباح', 'perte de profit'),
(1500, 'balance_sheet', 'Balance Sheet', 'ورقة الرصيد', 'bilan'),
(1501, 'cash_flow_statement', 'Cash Flow Statement', 'بيان التدفقات النقدية', 'état des flux de trésorerie'),
(1502, 'trial_balance', 'Trial Balance', 'ميزان المراجعة', 'balance de vérification'),
(1503, 'reports_by_voucher', 'Reports By Voucher', 'التقارير عن طريق القسيمة', 'rapports par bon'),
(1504, 'select_voucher_no', 'Select Voucher No', 'حدد رقم القسيمة', 'sélectionner le coupon non'),
(1505, 'voucher_reports', 'Voucher Reports', 'تقارير القسائم', 'rapports sur les bons'),
(1506, 'account_code', 'Account Code', 'رمز الحساب', 'code de compte'),
(1507, 'created_date', 'Created Date', 'تاريخ الإنشاء', 'date de création'),
(1508, 'general_ledger_form', 'General Ledger Form', 'نموذج الحسابات العام', 'formulaire de grand livre'),
(1509, 'general_ledger_report', 'General Ledger Report', 'تقرير الحسابات العام', 'rapport de grand livre'),
(1510, 'transection_date', 'Transection Date', 'تاريخ القطع', 'date de la section'),
(1511, 'head_code', 'Head Code', 'الرمز الرئيسي', 'code de tête'),
(1512, 'particulars', 'Particulars', 'تفاصيل', 'détails'),
(1513, 'profit_loss_report', 'Profit Loss Report', 'تقرير الربح والخسارة', 'déclaration de perte de profit'),
(1514, 'authorized_signature', 'Authorized Signature', 'توقيع معتمد', 'signature autorisée'),
(1515, 'chairman', 'Chairman', 'رئيس', 'président'),
(1516, 'trial_balance_with_opening_as_on', 'Trial balance with opening as on', 'ميزان المراجعة مع الفتح في', 'balance de vérification avec ouverture comme le'),
(1517, 'opening_cash_and_equivalent', 'Opening Cash and Equivalent', 'فتح النقدية وما يقابلها', 'trésorerie d\'ouverture et équivalent'),
(1518, 'trial_balance_without_opening', 'Trial Balance Without Opening', 'ميزان المراجعة بدون فتح', 'balance de vérification sans ouverture'),
(1519, 'trial_balance_with_opening', 'Trial Balance With Opening', 'ميزان المراجعة مع الافتتاح', 'balance de vérification avec ouverture'),
(1520, 'general_ledger_reports', 'General Ledger Reports', 'تقارير دفتر الاستاذ العام', 'rapports de grand livre'),
(1521, 'brand_translation', 'Brand Translation', 'ترجمة العلامات التجارية', 'traduction de marque'),
(1522, 'brand_information', 'Brand Information', 'معلومات العلامة التجارية', 'informations sur la marque'),
(1523, 'category_information', 'Category Information', 'معلومات الفئة', 'informations sur la catégorie'),
(1524, 'category_translation', 'Category Translation', 'ترجمة الفئات', 'traduction de catégorie'),
(1525, 'product_translation', 'Product Translation', 'ترجمة المنتج', 'traduction de produit'),
(1528, 'add_assembly_product', 'Add Assembly Product', 'أضف منتج التجميع', 'ajouter un produit d\'assemblage'),
(1539, 'manage_assembly_product', 'Manage Assembly Product', 'إدارة منتج التجميع', 'gérer le produit d\'assemblage'),
(1540, 'product_information', 'Product Information', 'معلومات المنتج', 'Information produit'),
(1541, 'product_information', 'Product Information', 'معلومات المنتج', 'Information produit'),
(1542, 'import_product_excel', 'Import Product (EXCEL)', 'استيراد المنتج (EXCEL)', 'importer un produit excel'),
(1543, 'excel_file_informaion', 'EXCEL File Informaion', 'معلومات ملف EXCEL', 'informations sur le fichier excel'),
(1544, 'upload_excel_file', 'Upload Excel File', 'تحميل ملف اكسل', 'télécharger un fichier excel'),
(1627, 'order_title', 'Order Title', 'عنوان الطلب', 'titre de la commande'),
(1641, 'successfully_returned', 'Successfully Returned', 'عاد بنجاح', 'retourné avec succès'),
(1649, 'order_title', 'Order Title', 'عنوان الطلب', 'titre de la commande'),
(1663, 'successfully_returned', 'Successfully Returned', 'عاد بنجاح', 'retourné avec succès'),
(1671, 'order_title', 'Order Title', 'عنوان الطلب', 'titre de la commande'),
(1685, 'successfully_returned', 'Successfully Returned', 'عاد بنجاح', 'retourné avec succès'),
(1693, 'order_title', 'Order Title', 'عنوان الطلب', 'titre de la commande'),
(1707, 'successfully_returned', 'Successfully Returned', 'عاد بنجاح', 'retourné avec succès'),
(1715, 'order_title', 'Order Title', 'عنوان الطلب', 'titre de la commande'),
(1729, 'successfully_returned', 'Successfully Returned', 'عاد بنجاح', 'retourné avec succès'),
(1737, 'order_title', 'Order Title', 'عنوان الطلب', 'titre de la commande'),
(1751, 'successfully_returned', 'Successfully Returned', 'عاد بنجاح', 'retourné avec succès'),
(1759, 'order_title', 'Order Title', 'عنوان الطلب', 'titre de la commande'),
(1773, 'successfully_returned', 'Successfully Returned', 'عاد بنجاح', 'retourné avec succès'),
(1781, 'order_title', 'Order Title', 'عنوان الطلب', 'titre de la commande'),
(1795, 'successfully_returned', 'Successfully Returned', 'عاد بنجاح', 'retourné avec succès'),
(1803, 'order_title', 'Order Title', 'عنوان الطلب', 'titre de la commande'),
(1817, 'successfully_returned', 'Successfully Returned', 'عاد بنجاح', 'retourné avec succès'),
(1825, 'order_title', 'Order Title', 'عنوان الطلب', 'titre de la commande'),
(1839, 'successfully_returned', 'Successfully Returned', 'عاد بنجاح', 'retourné avec succès'),
(1901, 'enter_expire_date', 'Enter Expire Date', 'أدخل تاريخ انتهاء الصلاحية', 'entrez la date d\'expiration'),
(1902, 'warrantee', 'Warrantee', 'الضمان', 'garantie'),
(1903, 'please_enter_number_of_months', 'Please enter number of months', 'الرجاء إدخال عدد الأشهر', 'veuillez entrer le nombre de mois'),
(1904, 'invoice_wise_warrantee', 'Invoice wise warrantee', 'فلترة الفواتير حسب الضمان', 'garantie sur facture'),
(1905, 'enter_invoice_number', 'Enter invoice number', 'أدخل رقم الفاتورة', 'entrer le numéro de facture'),
(1906, 'warrantee_period_month', 'Warrantee Period(month)', 'فترة الضمان (شهر)', 'période de garantie mois'),
(1907, 'warrantee_expiry_date', 'Warrantee Expiry Date', 'تاريخ انتهاء الضمان', 'date d\'expiration de la garantie'),
(1908, 'expriy_report', 'Expriy Report', 'تقرير انتهاء الصلاحية', 'rapport d\'expiration'),
(1909, 'expire_duration', 'Expire Duration', 'مدة الصلاحية', 'durée d\'expiration'),
(1910, 'from_date', 'From Date', 'من التاريخ', 'partir de la date'),
(1911, 'to_date', 'To Date', 'حتى الآن', 'à ce jour'),
(1912, 'expire_date_from', 'Expire date from', 'تاريخ انتهاء الصلاحية من', 'date d\'expiration du'),
(1913, 'expire_date_till', 'Expire date till', 'تاريخ انتهاء الصلاحية حتى', 'date d\'expiration jusqu\'au'),
(1914, 'batch_wise_expire_report', 'Batch Wise Expire Report', 'تقرير انتهاء صلاحية دفعة هادامار', 'rapport d\'expiration par lot'),
(1915, 'batch_no', 'Batch No.', 'رقم الحزمة.', 'n ° de lot'),
(1916, 'expire_date', 'Expire Date', 'تاريخ انتهاء الصلاحية', 'date d\'expiration'),
(1917, 'accounting', 'Accounting', 'محاسبة', 'comptabilité'),
(1918, 'chart_of_account', 'Chart of Account', 'الرسم البياني للحساب', 'Charte d\'utilisation'),
(1919, 'opening_balance', 'Opening Balance', 'الرصيد الافتتاحي', 'solde d\'ouverture'),
(1920, 'supplier_payment', 'Supplier Payment', 'دفع المورد', 'paiement fournisseur'),
(1921, 'customer_receive', 'Customer Receive', 'تلقي العميل', 'le client reçoit'),
(1922, 'cash_adjustment', 'Cash Adjustment', 'تسوية نقدية', 'ajustement en espèces'),
(1923, 'debit_voucher', 'Debit Voucher', 'قسيمة الخصم', 'bon de débit'),
(1924, 'credit_voucher', 'Credit Voucher', 'قسيمة الائتمان', 'bon de crédit'),
(1925, 'contra_voucher', 'Contra Voucher', 'قسيمة كونترا', 'contre bon'),
(1926, 'journal_voucher', 'Journal Voucher', 'قسيمة دفتر اليومية', 'bon de journal'),
(1927, 'voucher_approval', 'Voucher Approval', 'الموافقة على القسيمة', 'approbation du bon'),
(1928, 'voucher_no', 'Voucher No', 'رقم القسيمة', 'bon non'),
(1929, 'account_head', 'Account Head', 'رئيس الحساب', 'chef de compte'),
(1930, 'remark', 'Remark', 'ملاحظة', 'remarque'),
(1931, 'receipt_voucher', 'Receipt Voucher', 'سند القبض', 'bon de réception'),
(1932, 'receipt_voucher_form', 'Receipt Voucher Form', 'نموذج إيصال استلام', 'formulaire de bon de réception'),
(1933, 'manage_receipt_voucher', 'Manage Receipt Voucher', 'إدارة إيصال الإيصال', 'gérer le bon de réception'),
(1934, 'payment_voucher', 'Payment Voucher', 'قسيمة دفع', 'bon de paiement'),
(1935, 'payment_voucher_form', 'Payment Voucher Form', 'نموذج قسيمة الدفع', 'formulaire de bon de paiement'),
(1936, 'customer_balance', 'Customer Balance', 'رصيد العميل', 'solde client'),
(1937, 'vat', 'Vat', 'ضريبة القيمة المضافة', 'T.V.A'),
(1938, 'total_balance', 'Total Balance', 'إجمالي الرصيد', 'solde total'),
(1939, 'remaining_balance', 'Remaining Balance', 'الرصيد المتبقي', 'solde restant'),
(1940, 'pay_vat', 'Pay Vat', 'دفع ضريبة القيمة المضافة', 'payer la TVA'),
(1941, 'pay_amount', 'Pay Amount', 'مقدار الأجر', 'payer le montant'),
(1942, 'cash_payment', 'Cash Payment', 'دفع نقدا', 'paiement en espèces'),
(1943, 'bank_payment', 'Bank Payment', 'دفعة بنكية', 'paiement bancaire'),
(1944, 'adjustment_type', 'Adjustment Type', 'نوع التعديل', 'type de réglage'),
(1945, 'code', 'Code', 'الشفرة', 'code'),
(1946, 'paytype', 'Paytype', 'نوع Payty', 'type de paiement'),
(1947, 'txtCode', 'TxtCode', 'الرمز النصي', 'txtCode'),
(1948, 'approved', 'Approved', 'تمت الموافقة', 'approuvé'),
(1949, 'approve', 'Approve', 'موافق', 'approuver'),
(1950, 'credit_account_head', 'Credit Account Head', 'اسم حساب الائتمان', 'responsable de compte de crédit'),
(1951, 'successfully_approved', 'Successfully Approved', 'تمت الموافقة بنجاح', 'approuvé avec succès'),
(1952, 'debit_account_head', 'Debit Account Head', 'رئيس حساب الخصم', 'chef de compte débiteur'),
(1953, 'add_more', 'Add More', 'أضف المزيد', 'ajouter plus'),
(1954, 'update_debit_voucher', 'Update Debit Voucher', 'تحديث قسيمة الخصم', 'mettre à jour le bon de débit'),
(1955, 'update_credit_voucher', 'Update Credit Voucher', 'تحديث قسيمة الائتمان', 'mettre à jour le bon de crédit'),
(1956, 'update_journal_voucher', 'Update Journal Voucher', 'تحديث قسيمة دفتر اليومية', 'mettre à jour le bon de journal'),
(1957, 'update_contra_voucher', 'Update Contra Voucher', 'تحديث قسيمة كونترا', 'mettre à jour le bon de contre-vérification'),
(1958, 'customer_head_code', 'Customer Head Code', 'رمز رئيس العميل', 'code client principal'),
(1959, 'current_balance', 'Current Balance', 'الرصيد الحالي', 'Solde actuel'),
(1960, 'total_vat', 'Total Vat', 'إجمالي ضريبة القيمة المضافة', 'TVA totale'),
(1961, 'account_reports', 'Account Reports', 'تقارير الحساب', 'rapports de compte'),
(1962, 'general_ledger', 'General Ledger', 'دفتر الأستاذ العام', 'grand livre général'),
(1963, 'profit_loss', 'Profit Loss', 'خسارة الأرباح', 'perte de profit'),
(1964, 'balance_sheet', 'Balance Sheet', 'ورقة الرصيد', 'bilan'),
(1965, 'cash_flow_statement', 'Cash Flow Statement', 'بيان التدفقات النقدية', 'état des flux de trésorerie'),
(1966, 'trial_balance', 'Trial Balance', 'ميزان المراجعة', 'balance de vérification'),
(1967, 'reports_by_voucher', 'Reports By Voucher', 'التقارير عن طريق القسيمة', 'rapports par bon'),
(1968, 'select_voucher_no', 'Select Voucher No', 'حدد رقم القسيمة', 'sélectionner le coupon non'),
(1969, 'voucher_reports', 'Voucher Reports', 'تقارير القسائم', 'rapports sur les bons'),
(1970, 'account_code', 'Account Code', 'رمز الحساب', 'code de compte'),
(1971, 'created_date', 'Created Date', 'تاريخ الإنشاء', 'date de création'),
(1972, 'general_ledger_form', 'General Ledger Form', 'نموذج دفتر الأستاذ العام', 'formulaire de grand livre'),
(1973, 'general_ledger_report', 'General Ledger Report', 'تقرير دفتر الأستاذ العام', 'rapport de grand livre'),
(1974, 'transection_date', 'Transection Date', 'تاريخ القطع', 'date de la section'),
(1975, 'head_code', 'Head Code', 'الرمز الرئيسي', 'code de tête'),
(1976, 'particulars', 'Particulars', 'تفاصيل', 'détails'),
(1977, 'profit_loss_report', 'Profit Loss Report', 'تقرير الربح والخسارة', 'déclaration de perte de profit'),
(1978, 'authorized_signature', 'Authorized Signature', 'توقيع معتمد', 'signature autorisée'),
(1979, 'trial_balance_with_opening_as_on', 'Trial balance with opening as on', 'ميزان المراجعة مع الفتح في', 'balance de vérification avec ouverture comme le'),
(1980, 'opening_cash_and_equivalent', 'Opening Cash and Equivalent', 'فتح النقدية وما في حكمها', 'trésorerie d\'ouverture et équivalent'),
(1981, 'trial_balance_without_opening', 'Trial Balance Without Opening', 'ميزان المراجعة بدون فتح', 'balance de vérification sans ouverture'),
(1982, 'trial_balance_with_opening', 'Trial Balance With Opening', 'ميزان المراجعة مع الافتتاح', 'balance de vérification avec ouverture'),
(1983, 'general_ledger_reports', 'General Ledger Reports', 'تقارير دفتر الأستاذ العام', 'rapports de grand livre'),
(1984, 'another_fiscal_year_exist_in_given_range', 'Another Fiscal Year Exist in Given Date Range!', 'سنة مالية أخرى موجودة في النطاق الزمني المحدد!', 'un autre exercice existe dans une plage donnée'),
(1985, 'invalid_date_selection', 'Invalid date selection! Please select a date from active fiscal year', 'اختيار التاريخ غير صحيح! الرجاء تحديد تاريخ من السنة المالية النشطة', 'sélection de date invalide'),
(1986, 'fields_must_not_be_empty', 'Fields must not be empty!', 'يجب ألا تكون الحقول فارغة!', 'les champs ne doivent pas être vides'),
(1987, 'fiscal_year', 'Fiscal Year', 'السنة المالية', 'exercice fiscal'),
(1988, 'stock_adjustment_details', 'Stock adjustment details', 'تفاصيل تعديل المخزون', 'détails de l\'ajustement des stocks'),
(1989, 'adjustment_id', 'Adjustment Id', 'معرف التعديل', 'ID d\'ajustement'),
(1990, 'color_variant', 'Color Variant', 'متغير اللون', 'variante de couleur'),
(1991, 'adjustment_quantity', 'Adjustment Quantity', 'كمية التعديل', 'quantité d\'ajustement'),
(1992, 'batch_wise_stock', 'Batch Wise Stock', 'فلترة حسب دفعات المخزون', 'stock par lots'),
(1993, 'stock_report_batch_wise', 'Stock Report (Batch Wise)', 'تقرير المخزون (فلترة حسب الدفعة)', 'rapport de stock par lots'),
(1994, 'enter_batch_no', 'Enter Batch No', 'أدخل رقم الدفعة', 'entrez le numéro de lot'),
(1995, 'expiry', 'Expiry', 'انقضاء', 'expiration'),
(1996, 'total_qnty', 'Total Qnty', 'إجمالي الكمية', 'quantité totale'),
(1997, 'sold_qnty', 'Sold Qnty', 'الكمية المباعة', 'quantité vendue'),
(1998, 'current_qnty', 'Current Qnty', 'الكمية الحالية', 'quantité actuelle'),
(1999, 'seller_price', 'Seller Price', 'سعر البائع', 'prix vendeur'),
(2000, 'accounting', 'Accounting', 'محاسبة', 'comptabilité'),
(2001, 'chart_of_account', 'Chart of Account', 'الرسم البياني للحساب', 'Charte d\'utilisation'),
(2002, 'opening_balance', 'Opening Balance', 'الرصيد الافتتاحي', 'solde d\'ouverture'),
(2003, 'supplier_payment', 'Supplier Payment', 'دفع المورد', 'paiement fournisseur'),
(2004, 'customer_receive', 'Customer Receive', 'تلقي العميل', 'le client reçoit'),
(2005, 'cash_adjustment', 'Cash Adjustment', 'تسوية نقدية', 'ajustement en espèces'),
(2006, 'debit_voucher', 'Debit Voucher', 'قسيمة الخصم', 'bon de débit'),
(2007, 'credit_voucher', 'Credit Voucher', 'قسيمة الائتمان', 'bon de crédit'),
(2008, 'contra_voucher', 'Contra Voucher', 'قسيمة كونترا', 'contre bon'),
(2009, 'journal_voucher', 'Journal Voucher', 'قسيمة دفتر اليومية', 'bon de journal'),
(2010, 'voucher_approval', 'Voucher Approval', 'الموافقة على القسيمة', 'approbation du bon'),
(2011, 'voucher_no', 'Voucher No', 'رقم القسيمة', 'bon non'),
(2012, 'account_head', 'Account Head', 'رئيس الحساب', 'chef de compte'),
(2013, 'remark', 'Remark', 'ملاحظة', 'remarque'),
(2014, 'receipt_voucher', 'Receipt Voucher', 'سند القبض', 'bon de réception'),
(2015, 'receipt_voucher_form', 'Receipt Voucher Form', 'نموذج إيصال استلام', 'formulaire de bon de réception'),
(2016, 'manage_receipt_voucher', 'Manage Receipt Voucher', 'إدارة إيصال الإيصال', 'gérer le bon de réception'),
(2017, 'payment_voucher', 'Payment Voucher', 'قسيمة دفع', 'bon de paiement'),
(2018, 'payment_voucher_form', 'Payment Voucher Form', 'نموذج قسيمة الدفع', 'formulaire de bon de paiement'),
(2019, 'customer_balance', 'Customer Balance', 'رصيد العميل', 'solde client'),
(2020, 'vat', 'Vat', 'ضريبة القيمة المضافة', 'T.V.A'),
(2021, 'total_balance', 'Total Balance', 'إجمالي الرصيد', 'solde total'),
(2022, 'remaining_balance', 'Remaining Balance', 'الرصيد المتبقي', 'solde restant'),
(2023, 'pay_vat', 'Pay Vat', 'دفع ضريبة القيمة المضافة', 'payer la TVA'),
(2024, 'pay_amount', 'Pay Amount', 'مقدار الأجر', 'payer le montant'),
(2025, 'cash_payment', 'Cash Payment', 'دفع نقدا', 'paiement en espèces'),
(2026, 'bank_payment', 'Bank Payment', 'دفعة بنكية', 'paiement bancaire'),
(2027, 'adjustment_type', 'Adjustment Type', 'نوع التعديل', 'type de réglage'),
(2028, 'code', 'Code', 'الشفرة', 'code'),
(2029, 'paytype', 'Paytype', 'نوع Payty', 'type de paiement'),
(2030, 'txtCode', 'TxtCode', 'الرمز النصي', 'txtCode'),
(2031, 'approved', 'Approved', 'تمت الموافقة', 'approuvé'),
(2032, 'approve', 'Approve', 'موافق', 'approuver'),
(2033, 'credit_account_head', 'Credit Account Head', 'اسم حساب الائتمان', 'responsable de compte de crédit'),
(2034, 'successfully_approved', 'Successfully Approved', 'تمت الموافقة بنجاح', 'approuvé avec succès'),
(2035, 'debit_account_head', 'Debit Account Head', 'اسم حساب الخصم', 'chef de compte débiteur'),
(2036, 'add_more', 'Add More', 'أضف المزيد', 'ajouter plus'),
(2037, 'update_debit_voucher', 'Update Debit Voucher', 'تحديث قسيمة الخصم', 'mettre à jour le bon de débit'),
(2038, 'update_credit_voucher', 'Update Credit Voucher', 'تحديث قسيمة الائتمان', 'mettre à jour le bon de crédit'),
(2039, 'update_journal_voucher', 'Update Journal Voucher', 'تحديث قسيمة دفتر اليومية', 'mettre à jour le bon de journal'),
(2040, 'update_contra_voucher', 'Update Contra Voucher', 'تحديث قسيمة كونترا', 'mettre à jour le bon de contre-vérification'),
(2041, 'customer_head_code', 'Customer Head Code', 'رمز رئيس العميل', 'code client principal'),
(2042, 'current_balance', 'Current Balance', 'الرصيد الحالي', 'Solde actuel'),
(2043, 'total_vat', 'Total Vat', 'إجمالي ضريبة القيمة المضافة', 'TVA totale'),
(2044, 'account_reports', 'Account Reports', 'تقارير الحساب', 'rapports de compte'),
(2045, 'general_ledger', 'General Ledger', 'دفتر الأستاذ العام', 'grand livre général'),
(2046, 'profit_loss', 'Profit Loss', 'خسارة الأرباح', 'perte de profit'),
(2047, 'balance_sheet', 'Balance Sheet', 'ورقة الرصيد', 'bilan'),
(2048, 'cash_flow_statement', 'Cash Flow Statement', 'بيان التدفقات النقدية', 'état des flux de trésorerie'),
(2049, 'trial_balance', 'Trial Balance', 'ميزان المراجعة', 'balance de vérification'),
(2050, 'reports_by_voucher', 'Reports By Voucher', 'التقارير عن طريق القسيمة', 'rapports par bon'),
(2051, 'select_voucher_no', 'Select Voucher No', 'حدد رقم القسيمة', 'sélectionner le coupon non'),
(2052, 'voucher_reports', 'Voucher Reports', 'تقارير القسائم', 'rapports sur les bons'),
(2053, 'account_code', 'Account Code', 'رمز الحساب', 'code de compte'),
(2054, 'created_date', 'Created Date', 'تاريخ الإنشاء', 'date de création'),
(2055, 'general_ledger_form', 'General Ledger Form', 'نموذج دفتر الأستاذ العام', 'formulaire de grand livre'),
(2056, 'general_ledger_report', 'General Ledger Report', 'تقرير دفتر الأستاذ العام', 'rapport de grand livre'),
(2057, 'transection_date', 'Transection Date', 'تاريخ القطع', 'date de la section'),
(2058, 'head_code', 'Head Code', 'كود الرأس', 'code de tête'),
(2059, 'particulars', 'Particulars', 'تفاصيل', 'détails'),
(2060, 'profit_loss_report', 'Profit Loss Report', 'تقرير الربح والخسارة', 'déclaration de perte de profit'),
(2061, 'authorized_signature', 'Authorized Signature', 'توقيع معتمد', 'signature autorisée'),
(2062, 'trial_balance_with_opening_as_on', 'Trial balance with opening as on', 'ميزان المراجعة مع الفتح في', 'balance de vérification avec ouverture comme le'),
(2063, 'opening_cash_and_equivalent', 'Opening Cash and Equivalent', 'فتح النقدية وما في حكمها', 'trésorerie d\'ouverture et équivalent'),
(2064, 'trial_balance_without_opening', 'Trial Balance Without Opening', 'ميزان المراجعة بدون فتح', 'balance de vérification sans ouverture'),
(2065, 'trial_balance_with_opening', 'Trial Balance With Opening', 'ميزان المراجعة مع الافتتاح', 'balance de vérification avec ouverture'),
(2066, 'general_ledger_reports', 'General Ledger Reports', 'تقارير دفتر الأستاذ العام', 'rapports de grand livre'),
(2068, 'invalid_date_selection', 'Invalid date selection! Please select a date from active fiscal year', 'اختيار التاريخ غير صحيح! الرجاء تحديد تاريخ من السنة المالية النشطة', 'sélection de date invalide'),
(2069, 'fields_must_not_be_empty', 'Fields must not be empty!', 'يجب ألا تكون الحقول فارغة!', 'les champs ne doivent pas être vides'),
(2071, 'purchase_return', 'Purchase Return', 'عودة شراء', 'retour d\'achat'),
(2072, 'manage_purchase_return', 'Manage Purchase Return', 'إدارة إرجاع الشراء', 'gérer le retour d\'achat'),
(2073, 'purchase_return_form', 'Purchase Return Form', 'نموذج إرجاع الشراء', 'formulaire de retour d\'achat'),
(2074, 'return_information', 'Return Information', 'عودة المعلومات', 'informations de retour'),
(2075, 'return_ledger', 'Return Ledger', 'عودة دفتر الأستاذ', 'registre des retours'),
(2076, 'return_quantity', 'Return Quantity', 'كمية الإرجاع', 'quantité de retour'),
(2077, 'purchase_return_details', 'Purchase Return Details', 'تفاصيل إرجاع الشراء', 'détails du retour d\'achat'),
(2078, 'return_date', 'Return Date', 'تاريخ العودة', 'date de retour'),
(2079, 'purchase_quantity', 'Purchase Quantity', 'كمية الشراء', 'Quantité d\'achat'),
(2080, 'return_purchase', 'Return Purchase', 'إعادة الشراء', 'retour d\'achat'),
(2081, 'edit_purchase_return', 'Edit Purchase Return', 'تحرير عائد الشراء', 'modifier le retour d\'achat'),
(2082, 'edit_purchase_return_form', 'Edit purchase return form', 'تحرير نموذج إرجاع الشراء', 'modifier le formulaire de retour d\'achat'),
(2083, 'purchase_return_edit', 'Purchase return edit', 'تحرير عائد الشراء', 'retour d\'achat modifier'),
(2084, 'return_details', 'Return Details', 'تفاصيل الإرجاع', 'détails du retour'),
(2085, 'invoice_date', 'Invoice date', 'تاريخ الفاتورة', 'date de facturation'),
(2086, 'stock_adjustment_form', 'Stock Adjustment Form', 'نموذج تسوية المخزون', 'formulaire d\'ajustement des stocks'),
(2087, 'adjusted_quantity', 'Adjusted Quantity', 'الكمية المعدلة', 'quantité ajustée'),
(2088, 'please_select_store_first', 'Please select store first', 'الرجاء تحديد المتجر أولاً', 'Veuillez d\'abord sélectionner le magasin'),
(2089, 'increase', 'Increase', 'زيادة', 'augmenter'),
(2090, 'decrease', 'Decrease', 'نقصان', 'diminuer'),
(2091, 'manage_stock_adjustment', 'Manage Stock Adjustment', 'إدارة تعديل المخزون', 'gérer l\'ajustement des stocks'),
(2092, 'create_invoice', 'Create Invoice', 'إنشاء فاتورة', 'créer une facture'),
(2093, 'create_invoice_form', 'Create Invoice Form', 'إنشاء نموذج الفاتورة', 'créer un formulaire de facture'),
(2095, 'purchase_return', 'Purchase Return', 'عودة شراء', 'retour d\'achat'),
(2096, 'manage_purchase_return', 'Manage Purchase Return', 'إدارة إرجاع الشراء', 'gérer le retour d\'achat'),
(2097, 'purchase_return_form', 'Purchase Return Form', 'نموذج إرجاع الشراء', 'formulaire de retour d\'achat'),
(2098, 'transfer_product', 'Transfer Product', 'نقل المنتج', 'produit de transfert'),
(2099, 'transfer_list', 'Transfer List', 'قائمة التحويل', 'liste de transfert'),
(2100, 'transfer_from', 'Transfer From', 'تحويل من', 'transfert à partir de'),
(2101, 'transfer', 'Transfer', 'تحويل', 'transférer'),
(2102, 'new_request', 'New Request', 'طلب جديد', 'nouvelle requête'),
(2103, 'manage_transfer_request', 'Manage Transfer Request', 'إدارة طلب التحويل', 'gérer la demande de transfert'),
(2104, 'received_transfer_request', 'Received Transfer Request', 'تم استلام طلب التحويل', 'demande de transfert reçue'),
(2105, 'transfer_id', 'Transfer ID', 'معرف نقل', 'ID de transfert'),
(2106, 'not_approved', 'Not Approved', 'غير مقبول', 'non approuvé');
INSERT INTO `language` (`id`, `phrase`, `english`, `arabic`, `franais`) VALUES
(2107, 'collected', 'Collected', 'تم جمعها', 'collecté'),
(2108, 'import_product_api', 'Import Product (API)', 'استيراد المنتج (API)', 'importer l\'API du produit'),
(2109, 'import_product', 'Import Product', 'منتج استيراد', 'produit d\'importation'),
(2110, 'import_category', 'Import Category', 'فئة الاستيراد', 'catégorie d\'importation'),
(2111, 'import_brand', 'Import Brand', 'علامة تجارية للاستيراد', 'marque d\'importation'),
(2112, 'import_variant', 'Import Variant', 'متغير الاستيراد', 'importer une variante'),
(2113, 'customer_name_or_phone', 'Customer Name/Phone', 'اسم العميل / الهاتف', 'nom ou téléphone du client'),
(2123, 'order_title', 'Order Title', 'عنوان الطلب', 'titre de la commande'),
(2137, 'successfully_returned', 'Successfully Returned', 'عاد بنجاح', 'retourné avec succès'),
(2182, 'unit_price_before_VAT', 'Unit price before VAT', NULL, 'prix unitaire hors TVA'),
(2183, 'total_vat', 'Total vat', NULL, 'TVA totale'),
(2184, 'proof_of_purchase_expences', 'Proof of purchase expences', NULL, 'frais de preuve d\'achat'),
(2187, 'no_product_found', 'No product found', NULL, 'aucun produit trouvé'),
(2188, 'no_categories_found', 'No categories found', NULL, 'aucune catégorie trouvée'),
(2189, 'your_cart_is_empty', 'Your cart is empty', NULL, 'Votre panier est vide'),
(2190, 'category', 'Category', NULL, 'Catégorie'),
(2191, 'checkout_information', 'Checkout information', NULL, 'informations de paiement'),
(2192, 'billing_address', 'Billing address', NULL, 'Adresse de facturation'),
(2193, 'name', 'Name', NULL, 'Nom'),
(2194, 'address', 'Address', NULL, 'adresse'),
(2195, 'contact_number', 'Contact number', NULL, 'numéro de contact'),
(2196, 'order_summary', 'Order summary', NULL, 'Récapitulatif de la commande'),
(2197, 'subtotal', 'Subtotal', NULL, 'total'),
(2198, 'vat', 'Vat', NULL, 'T.V.A'),
(2199, 'total', 'Total', NULL, 'total'),
(2200, 'sar', 'SAR', NULL, 'Sar'),
(2201, 'items', 'Items', NULL, 'éléments'),
(2202, 'place_order', 'Place order', NULL, 'Passer la commande'),
(2203, 'bestsell_product', 'Bestsell Products', NULL, 'produit le plus vendu'),
(2204, 'view_all', 'View all', NULL, 'Voir tout'),
(2205, 'brands', 'Brands', NULL, 'marques'),
(2206, 'no_category_added', 'No category added', NULL, 'aucune catégorie ajoutée'),
(2207, 'daily_features', 'Daily Features', NULL, 'fonctionnalités quotidiennes'),
(2208, 'hot_sells', 'Hot sells', NULL, 'ventes chaudes'),
(2209, 'off', 'OFF', NULL, 'à l\'arrêt'),
(2210, 'coupons', 'Coupons', NULL, 'coupons'),
(2211, 'gift_card', 'Gift card', NULL, 'carte cadeau'),
(2212, 'slash', 'Slash', NULL, 'sabrer'),
(2213, 'pc_assembler', 'Pc assembler', NULL, 'assembleur de pc'),
(2214, 'no_slider_added', 'No slider added', NULL, 'aucun curseur ajouté'),
(2215, 'add_to_cart', 'Add to cart', NULL, 'Ajouter au panier'),
(2216, 'checkout', 'Checkout', NULL, 'vérifier'),
(2217, 'forgot_password', 'Forgot password', NULL, 'mot de passe oublié'),
(2218, 'submit', 'Submit', NULL, 'nous faire parvenir'),
(2219, 'dont_have_an_account', 'Don’t have and account', NULL, 'ne pas avoir de compte'),
(2220, 'sign_up', 'Sign Up', NULL, 'S\'inscrire'),
(2221, 'sign_in', 'Sign In', NULL, 's\'identifier'),
(2222, 'or', 'OR', NULL, 'ou'),
(2223, 'already_have_an_account', 'Already have an account', NULL, 'Vous avez déjà un compte'),
(2224, 'category', 'Category', NULL, 'Catégorie'),
(2225, 'wishlist', 'Wishlist', NULL, 'liste de souhaits'),
(2226, 'cart', 'Cart', NULL, 'Chariot'),
(2227, 'account', 'Account', NULL, 'Compte'),
(2228, 'your_cart_is_empty', 'Your cart is empty', NULL, 'Votre panier est vide'),
(2229, 'my_cart', 'My cart', NULL, 'mon panier'),
(2230, 'all', 'All', NULL, 'tout'),
(2231, 'checkout', 'Checkout', NULL, 'vérifier'),
(2232, 'loading', 'Loading...', NULL, 'Chargement en cours'),
(2233, 'no_order_found', 'No order found', NULL, 'aucune commande trouvée'),
(2235, 'details', 'Details', NULL, 'détails'),
(2236, 'payment', 'Payment', NULL, 'Paiement'),
(2237, 'amount_to_pay', 'Amount to pay', NULL, 'montant à payer'),
(2238, 'select_payment_method', 'Select payment method', NULL, 'Sélectionnez le mode de paiement'),
(2240, 'pay_from_mastercard_using_mastercard_payment_getway', 'Pay from mastercard using mastercard payment getway', NULL, 'payer depuis mastercard en utilisant la passerelle de paiement mastercard'),
(2241, 'make_payment', 'Make payment', NULL, 'effectuer le paiement'),
(2242, 'pc_assembler', 'Pc assembler', NULL, 'assembleur de pc'),
(2243, 'description', 'Description', NULL, 'la description'),
(2244, 'specifications', 'Specifications', NULL, 'Caractéristiques'),
(2245, 'review', 'Review', NULL, 'examen'),
(2246, 'n/a', 'N/A', NULL, 'n / A'),
(2247, 'write_a_review', 'Write a review', NULL, 'écrire une critique'),
(2248, 'rate_it', 'Rete it', NULL, 'évaluez-le'),
(2249, 'review', 'Review', NULL, 'examen'),
(2250, 'reviews_and_ratings', 'Reviews and ratings', NULL, 'avis et notes'),
(2251, 'related_products', 'Related Products', NULL, 'Produits connexes'),
(2252, 'view_all', 'View all', NULL, 'Voir tout'),
(2253, 'product_details', 'Product details', NULL, 'détails du produit'),
(2254, 'pc_assemble', 'Pc assemble', NULL, 'ordinateur assembler'),
(2255, 'products', 'Products ', NULL, 'des produits'),
(2256, 'filter', 'Filter ', NULL, 'filtre'),
(2257, 'sort', 'Sort', NULL, 'trier'),
(2258, 'search_result', 'Search result', NULL, 'résultat de la recherche'),
(2259, 'first_name', 'First name', NULL, 'prénom'),
(2260, 'last_name', 'Last name', NULL, 'nom de famille'),
(2261, 'email', 'Email', NULL, 'e-mail'),
(2262, 'contact_number', 'Contact number', NULL, 'numéro de contact'),
(2263, 'address', 'Address', NULL, 'adresse'),
(2264, 'country', 'Country', NULL, 'pays'),
(2265, 'state', 'State', NULL, 'Etat'),
(2266, 'city', 'City', NULL, 'ville'),
(2267, 'zip_code', 'Zip Code', NULL, 'code postal'),
(2268, 'company', 'Company', NULL, 'compagnie'),
(2269, 'save', 'Save', NULL, 'enregistrer'),
(2270, 'take_photo', 'Take photo', NULL, 'prendre une photo'),
(2271, 'select_from_gallery', 'Select from gallery', NULL, 'sélectionner dans la galerie'),
(2273, 'order_details', 'Order details', NULL, 'détails de la commande'),
(2274, 'edit_profile', 'Edit profile', NULL, 'Editer le profil'),
(2275, 'change_language', 'Change language', NULL, 'changer de langue'),
(2276, 'login', 'Login', NULL, 'connexion'),
(2277, 'logout', 'logout', NULL, 'Se déconnecter'),
(2278, 'zak_can_be_customized_and_used_for_any_niche_the_vast_possibilities_of_this_template_makes_it_multi_purpose', 'Zak can be customized and used for any niche. The vast possibilities of this template makes it multi purpose', NULL, 'zak peut être personnalisé et utilisé pour n\'importe quel créneau les vastes possibilités de ce modèle le rendent polyvalent'),
(2279, 'skip', 'Skip', NULL, 'sauter'),
(2280, 'done', 'Done', NULL, 'Fini'),
(2281, 'successfully_order_placed', 'Successfully order placed', NULL, 'commande passée avec succès'),
(2282, 'we_will_process_your_order_as_soon_as_possible', 'We will process your order as soon as possible', NULL, 'nous traiterons votre commande dans les plus brefs délais'),
(2283, 'continue_shopping', 'Continue shopping', NULL, 'Continuer vos achats'),
(2284, 'order_placed_failed', 'Order placed failed', NULL, 'la commande passée a échoué'),
(2285, 'we_are_very_much_sorry_for_this', 'We are very much sorry for this', NULL, 'nous sommes vraiment désolés pour cela'),
(2286, 'no_wishlist_found', 'No wishlist found', NULL, 'aucune liste de souhaits trouvée'),
(2287, 'wishlist', 'Wishlist', NULL, 'liste de souhaits'),
(2288, 'please_fill_up_all_information', 'Please fill up all information', NULL, 'veuillez remplir toutes les informations'),
(2289, 'feature_will_add_soon', 'Feature will add soon', NULL, 'fonctionnalité sera bientôt ajoutée'),
(2290, 'minimum_3_character_for_search', 'Minimum 3 character for search', NULL, 'minimum 3 caractères pour la recherche'),
(2291, 'please_login_to_checkout', 'Please login to checkout', NULL, 'veuillez vous connecter pour payer'),
(2292, 'network_connection_failed', 'Network connection failed', NULL, 'la connexion réseau a échoué'),
(2293, 'email_doesnt_exist', 'Email does not exist', NULL, 'le mail n\'existe pas'),
(2294, 'all_field_are_required', 'All field are required', NULL, 'tous les champs sont obligatoires'),
(2295, 'successfully_login', 'Successfully login', NULL, 'connexion réussie'),
(2296, 'phone_number_or_password_didnt_match', 'Phone number or password did not match', NULL, 'le numéro de téléphone ou le mot de passe ne correspondent pas'),
(2297, 'invalid_email_address', 'Invalid email address', NULL, 'Adresse e-mail invalide'),
(2298, 'registration_successful', 'Registration successful', NULL, 'inscription réussi'),
(2299, 'email_already_exist', 'Email already exist', NULL, 'l\'e-mail existe déjà'),
(2300, 'you_must_login_for_checkout', 'You must login for checkout', NULL, 'vous devez vous connecter pour payer'),
(2301, 'please_select_a_payment_method', 'Please select a payment method', NULL, 'Veuillez choisir un moyen de paiement'),
(2302, 'added_to_your_wishlist_item', 'Added to your wishlist item', NULL, 'ajouté à votre article de liste de souhaits'),
(2303, 'remove_to_your_wishlist_item', 'Remove to your wishlist item', NULL, 'supprimer de votre liste de souhaits'),
(2304, 'please_login_to_checkout', 'Please login to checkout', NULL, 'veuillez vous connecter pour payer'),
(2305, 'successfully_profile_updated', 'Successfully profile updated', NULL, 'profil mis à jour avec succès'),
(2306, 'successfully_logout', 'Successfully logout', NULL, 'déconnexion réussie'),
(2307, 'work_in_progress', 'Work in progress', NULL, 'travaux en cours'),
(2308, 'cart_added_successful', 'Cart added successful', NULL, 'panier ajouté avec succès'),
(2309, 'cart_replace_successful', 'Cart replace successful', NULL, 'remplacement du panier réussi'),
(2310, 'review_or_rating_cant_be_empty', 'Review or Rating can’t be empty', NULL, 'l\'avis ou la note ne peut pas être vide'),
(2311, 'you_have_reviewed_successfully', 'You have reviewed successfully', NULL, 'vous avez revu avec succès'),
(2312, 'you_are_already_reviewed', 'You are already reviewed', NULL, 'vous êtes déjà évalué'),
(2313, 'What_would_you_like_to_buy', 'What would you like to buy ?', NULL, 'Qu\'aimerais-tu acheter'),
(2314, 'flash_deals', 'Flash Deals', NULL, 'offres flash'),
(2315, 'select_language', 'Select language', NULL, 'Choisir la langue'),
(2316, 'no_language_found', 'No language found', NULL, 'aucune langue trouvée'),
(2318, 'no_countries_found', 'No countries found', NULL, 'aucun pays trouvé'),
(2319, 'review_and_ratings', 'Review & Ratings', NULL, 'avis et notes'),
(2320, 'rate_it', 'Rate it', NULL, 'évaluez-le'),
(2321, 'pay_from_mastercard_account_using_mastercard_payment_getway', 'Pay from Mastercard account using Mastercard payment getway', NULL, 'payer depuis le compte mastercard en utilisant la passerelle de paiement mastercard'),
(2322, 'pay_with_cashOnDelivery_using_cashOnDelivery_payment_method', 'Pay with cashOnDelivery using cashOnDelivery payment method', NULL, 'payer avec cashOnDelivery en utilisant le mode de paiement cashOnDelivery'),
(2323, 'thank_you_for_placing_order_at_gameleven_we_will_start_processing_your_order_after_payment_is_complete', 'Thank you for placing order at Gameleven. We will start processing your order after payment is complete.', NULL, 'merci d\'avoir passé commande chez gameleven nous commencerons à traiter votre commande une fois le paiement effectué'),
(2324, 'order_list', 'Order List', NULL, 'liste de commandes'),
(2325, 'check_out', 'Check Out', NULL, 'vérifier'),
(2326, 'or', 'OR', NULL, 'ou'),
(2327, 'phone_number', 'Phone number', NULL, 'numéro de téléphone'),
(2328, 'forgot_your_password', 'Forgot your password', NULL, 'Mot de passe oublié'),
(2329, 'dont_have_and_account', 'Don’t have and account', NULL, 'pas de compte'),
(2330, 'hot_categories', 'Hot Categories', NULL, 'catégories chaudes'),
(2331, 'gameleven', 'Gameleven', NULL, 'gameleven'),
(2332, 'vat_for_customer', 'VAT FOR Customer', NULL, 'TVA pour le client'),
(2333, 'payment_status_paid_or_not_paid', 'Payment status: paid or not paid', NULL, 'statut de paiement payé ou non payé'),
(2334, 'our_vat_no', 'Our VAT NO', NULL, 'notre cuve non'),
(2335, 'item_code', 'Model No', 'رقم الموديل', 'code de l\'article'),
(2336, 'vat_rate', 'Vat Rate', NULL, 'taux de TVA'),
(2337, 'vat_value', 'Vat Value', NULL, 'valeur de la TVA'),
(2338, 'total_value', 'Total Value', NULL, 'Valeur totale'),
(2339, 'item_picture', 'Item Picture', NULL, 'photo de l\'article'),
(2340, 'stock_opening', 'Stock Opening', NULL, 'ouverture des stocks'),
(2341, 'add_stock_opening', 'Add Stock Opening', NULL, 'ajouter une ouverture de stock'),
(2342, 'manage_stock_opening', 'Manage Stock Opening', NULL, 'gérer l\'ouverture des stocks'),
(2343, 'stock_opening_voucher', 'Stock Opening Voucher', NULL, 'bon d\'ouverture de stock'),
(2344, 'voucher_date', 'Voucher Date', NULL, 'date du bon'),
(2345, 'enter_to', 'Enter to', NULL, 'entrer dans'),
(2346, 'product_name_or_item_code', 'Product name or item code', NULL, 'nom du produit ou code article'),
(2347, 'no_active_fiscal_year_found', 'No active fiscal year found', NULL, 'aucun exercice financier actif trouvé'),
(2348, 'please_add_new_fiscal_year_first', 'Please add new fiscal year first', NULL, 'veuillez d\'abord ajouter un nouvel exercice'),
(2349, 'fiscal_year_ending', 'Fiscal Year Ending', NULL, 'exercice se terminant'),
(2350, 'supplier_invoice_no', 'Supplier invoice NO', NULL, 'facture fournisseur n°'),
(2351, 'supplier_invoice_date', 'Supplier invoice date', NULL, 'date de facture fournisseur'),
(2352, 'vat_for_supplier', 'VAT FOR Supplier', NULL, 'TVA pour le fournisseur'),
(2353, 'invoice_creation_date', 'Invoice creation date', NULL, 'date de création de la facture'),
(2354, 'invoice_time', 'Invoice Time', NULL, 'temps de facturation'),
(2355, 'purchase_details', 'Purchase Details', NULL, 'Détails d\'achat'),
(2356, 'adjustment_status_is_pending', 'Adjustment status is pending', NULL, 'l\'état de l\'ajustement est en attente'),
(2357, 'stock_updated_successfully', 'Stock updated successfully', NULL, 'stock mis à jour avec succès'),
(2358, 'stock_adjustment_cancelled', 'Stock adjustment cancelled', NULL, 'ajustement des stocks annulé'),
(2359, 'status_already_changed', 'Status already changed', NULL, 'statut déjà changé'),
(2360, 'inventory_voucher_no', 'Inventory voucher No.', NULL, 'bon d\'inventaire non'),
(2361, 'inventory_voucher_date', 'Inventory voucher date', NULL, 'date du bon d\'inventaire'),
(2362, 'inventory_supervisor', 'Inventory supervisor', NULL, 'superviseur de l\'inventaire'),
(2363, 'inventory_difference', 'Inventory difference', NULL, 'différence d\'inventaire'),
(2364, 'unit_sale_price', 'Unit sale price', NULL, 'prix de vente unitaire'),
(2365, 'total_unit_cost_price', 'Total unit cost price', NULL, 'prix de revient unitaire total'),
(2366, 'total_unit_selling_price', 'Total unit selling price', NULL, 'prix de vente unitaire total'),
(2367, 'unit_cost_price', 'Unit cost price', NULL, 'prix de revient unitaire'),
(2368, 'previous_quantity', 'Previous Quantity', NULL, 'quantité précédente'),
(2369, 'quotation_expiry_date', 'Quotation Expiry Date', NULL, 'date d\'expiration du devis'),
(2370, 'quotation_start_date', 'Quotation Start Date', NULL, 'date de début du devis'),
(2371, 'total_value_per_unit', 'Total value per unit', NULL, 'valeur totale par unité'),
(2372, 'sales_return_no', 'Sales Return NO', NULL, 'retour de vente non'),
(2373, 'customer_mobile_number', 'Customer mobile number', NULL, 'numéro de portable du client'),
(2374, 'sales_order_no', 'Sales Order NO', NULL, 'bon de commande non'),
(2375, 'Sales Order date', 'sales_order_date', NULL, 'Date de la commande client'),
(2376, 'total_number_of_items', 'Total number of items', NULL, 'nombre total d\'articles'),
(2377, 'vat_for_customer', 'VAT FOR Customer', NULL, 'TVA pour le client'),
(2378, 'payment_status_paid_or_not_paid', 'Payment status: paid or not paid', NULL, 'statut de paiement payé ou non payé'),
(2379, 'our_vat_no', 'Our VAT NO', NULL, 'notre cuve non'),
(2380, 'item_code', 'Model No', 'رقم الموديل', 'code de l\'article'),
(2381, 'vat_rate', 'Vat Rate', NULL, 'taux de TVA'),
(2382, 'vat_value', 'Vat Value', NULL, 'valeur de la TVA'),
(2383, 'total_value', 'Total Value', NULL, 'Valeur totale'),
(2384, 'item_picture', 'Item Picture', NULL, 'photo de l\'article'),
(2385, 'vat_for_customer', 'VAT FOR Customer', NULL, 'TVA pour le client'),
(2386, 'payment_status_paid_or_not_paid', 'Payment status: paid or not paid', NULL, 'statut de paiement payé ou non payé'),
(2387, 'our_vat_no', 'Our VAT NO', NULL, 'notre cuve non'),
(2388, 'item_code', 'Model No', 'رقم الموديل', 'code de l\'article'),
(2389, 'vat_rate', 'Vat Rate', NULL, 'taux de TVA'),
(2390, 'vat_value', 'Vat Value', NULL, 'valeur de la TVA'),
(2391, 'total_value', 'Total Value', NULL, 'Valeur totale'),
(2392, 'item_picture', 'Item Picture', NULL, 'photo de l\'article'),
(2393, 'total_vat', 'Total vat', NULL, 'TVA totale'),
(2394, 'proof_of_purchase_expences', 'Proof of purchase expences', NULL, 'frais de preuve d\'achat'),
(2395, 'total_vat', 'Total vat', NULL, 'TVA totale'),
(2396, 'proof_of_purchase_expences', 'Proof of purchase expences', NULL, 'frais de preuve d\'achat'),
(2397, 'total_vat', 'Total vat', NULL, 'TVA totale'),
(2398, 'proof_of_purchase_expences', 'Proof of purchase expences', NULL, 'frais de preuve d\'achat'),
(2399, 'total_vat', 'Total vat', NULL, 'TVA totale'),
(2400, 'proof_of_purchase_expences', 'Proof of purchase expences', NULL, 'frais de preuve d\'achat'),
(2401, 'total_vat', 'Total vat', NULL, 'TVA totale'),
(2402, 'proof_of_purchase_expences', 'Proof of purchase expences', NULL, 'frais de preuve d\'achat'),
(2403, 'total_vat', 'Total vat', NULL, 'TVA totale'),
(2404, 'proof_of_purchase_expences', 'Proof of purchase expences', NULL, 'frais de preuve d\'achat'),
(2405, 'expense_name', 'Expense name', NULL, 'nom de la dépense'),
(2406, 'expense_value', 'Expense value', NULL, 'valeur de dépense'),
(2407, 'method_of_Payment', 'Method of Payment', NULL, 'moyen de paiement'),
(2408, 'please_Provide_expense_name', 'Please Provide expense name', NULL, 'Veuillez indiquer le nom de la dépense'),
(2409, 'edit_purchase_order', 'Edit purchase order', NULL, 'modifier le bon de commande'),
(2410, 'manage_purchase_order_receive_list', 'Manage purchase order receive list', NULL, 'gérer la liste de réception des bons de commande'),
(2411, 'manage_purchase_order_receive', 'Manage purchase order receive', NULL, 'gérer la réception des bons de commande'),
(2412, 'manage_your_purchase_orderr_receive', 'Manage your purchase order receive', NULL, 'gérer votre bon de commande recevoir'),
(2413, 'manage_your_purchase_orders', 'Manage your purchase orders', NULL, 'gérer vos bons de commande'),
(2414, 'purchase_order_return', 'Purchase order return', NULL, 'retour de bon de commande'),
(2421, 'order_title', 'Order Title', NULL, 'titre de la commande'),
(2435, 'successfully_returned', 'Successfully Returned', NULL, 'retourné avec succès'),
(2452, 'start_cash_register', 'Start Cash Register', NULL, 'démarrer la caisse enregistreuse'),
(2465, 'start_cash_register', 'Start Cash Register', NULL, 'démarrer la caisse enregistreuse'),
(2473, 'coa_print', 'COA Print', NULL, 'impression de coa'),
(2474, 'pad_print_setting', 'Pad print setting', NULL, 'réglage de la tampographie'),
(2475, 'add_pad_print_setting', 'Add pad print setting', NULL, 'ajouter un paramètre de tampographie'),
(2476, 'pad_invoice', 'Pad invoice', NULL, 'facture tampon'),
(2477, 'pad_print', 'Pad print', NULL, 'tampographie'),
(2478, 'supplier_balance_report', 'Supplier Balance Report', NULL, 'rapport de solde fournisseur'),
(2479, 'customer_balance_report', 'Customer Balance Report', NULL, 'rapport sur le solde client'),
(2480, 'stock_adjustment', 'Stock Adjustment', NULL, 'Ajustement des stocks'),
(2481, 'stock_adjustment_form', 'Stock Adjustment Form', NULL, 'formulaire d\'ajustement des stocks'),
(2482, 'adjusted_quantity', 'Adjusted Quantity', NULL, 'quantité ajustée'),
(2483, 'please_select_store_first', 'Please select store first', NULL, 'Veuillez d\'abord sélectionner le magasin'),
(2484, 'increase', 'Increase', NULL, 'augmenter'),
(2485, 'decrease', 'Decrease', NULL, 'diminuer'),
(2486, 'manage_stock_adjustment', 'Manage Stock Adjustment', NULL, 'gérer l\'ajustement des stocks'),
(2489, 'add_assembly_product', 'Add Assembly Product', NULL, 'ajouter un produit d\'assemblage'),
(2500, 'manage_assembly_product', 'Manage Assembly Product', NULL, 'gérer le produit d\'assemblage'),
(2503, 'add_assembly_product', 'Add Assembly Product', NULL, 'ajouter un produit d\'assemblage'),
(2514, 'manage_assembly_product', 'Manage Assembly Product', NULL, 'gérer le produit d\'assemblage'),
(2517, 'add_assembly_product', 'Add Assembly Product', NULL, 'ajouter un produit d\'assemblage'),
(2528, 'manage_assembly_product', 'Manage Assembly Product', NULL, 'gérer le produit d\'assemblage'),
(2531, 'add_assembly_product', 'Add Assembly Product', NULL, 'ajouter un produit d\'assemblage'),
(2542, 'manage_assembly_product', 'Manage Assembly Product', NULL, 'gérer le produit d\'assemblage'),
(2545, 'add_assembly_product', 'Add Assembly Product', NULL, 'ajouter un produit d\'assemblage'),
(2556, 'manage_assembly_product', 'Manage Assembly Product', NULL, 'gérer le produit d\'assemblage'),
(2559, 'add_assembly_product', 'Add Assembly Product', NULL, 'ajouter un produit d\'assemblage'),
(2570, 'manage_assembly_product', 'Manage Assembly Product', NULL, 'gérer le produit d\'assemblage'),
(2577, 'start_cash_register', 'Start Cash Register', NULL, 'démarrer la caisse enregistreuse'),
(2587, 'add_assembly_product', 'Add Assembly Product', NULL, 'ajouter un produit d\'assemblage'),
(2598, 'manage_assembly_product', 'Manage Assembly Product', NULL, 'gérer le produit d\'assemblage'),
(2668, 'order_title', 'Order Title', NULL, 'titre de la commande'),
(2682, 'successfully_returned', 'Successfully Returned', NULL, 'retourné avec succès'),
(2921, 'accounting', 'Accounting', NULL, 'comptabilité'),
(2922, 'chart_of_account', 'Chart of Account', NULL, 'Charte d\'utilisation'),
(2923, 'opening_balance', 'Opening Balance', NULL, 'solde d\'ouverture'),
(2924, 'supplier_payment', 'Supplier Payment', NULL, 'paiement fournisseur'),
(2925, 'customer_receive', 'Customer Receive', NULL, 'le client reçoit'),
(2926, 'cash_adjustment', 'Cash Adjustment', NULL, 'ajustement en espèces'),
(2927, 'debit_voucher', 'Debit Voucher', NULL, 'bon de débit'),
(2928, 'credit_voucher', 'Credit Voucher', NULL, 'bon de crédit'),
(2929, 'contra_voucher', 'Contra Voucher', NULL, 'contre bon'),
(2930, 'journal_voucher', 'Journal Voucher', NULL, 'bon de journal'),
(2931, 'voucher_approval', 'Voucher Approval', NULL, 'approbation du bon'),
(2932, 'voucher_no', 'Voucher No', NULL, 'bon non'),
(2933, 'account_head', 'Account Head', NULL, 'chef de compte'),
(2934, 'remark', 'Remark', NULL, 'remarque'),
(2935, 'receipt_voucher', 'Receipt Voucher', NULL, 'bon de réception'),
(2936, 'receipt_voucher_form', 'Receipt Voucher Form', NULL, 'formulaire de bon de réception'),
(2937, 'manage_receipt_voucher', 'Manage Receipt Voucher', NULL, 'gérer le bon de réception'),
(2938, 'payment_voucher', 'Payment Voucher', NULL, 'bon de paiement'),
(2939, 'payment_voucher_form', 'Payment Voucher Form', NULL, 'formulaire de bon de paiement'),
(2940, 'customer_balance', 'Customer Balance', NULL, 'solde client'),
(2941, 'vat', 'Vat', NULL, 'T.V.A'),
(2942, 'total_balance', 'Total Balance', NULL, 'solde total'),
(2943, 'remaining_balance', 'Remaining Balance', NULL, 'solde restant'),
(2944, 'pay_vat', 'Pay Vat', NULL, 'payer la TVA'),
(2945, 'pay_amount', 'Pay Amount', NULL, 'payer le montant'),
(2946, 'cash_payment', 'Cash Payment', NULL, 'paiement en espèces'),
(2947, 'bank_payment', 'Bank Payment', NULL, 'paiement bancaire'),
(2948, 'adjustment_type', 'Adjustment Type', NULL, 'type de réglage'),
(2949, 'code', 'Code', NULL, 'code'),
(2950, 'paytype', 'Paytype', NULL, 'type de paiement'),
(2951, 'txtCode', 'TxtCode', NULL, 'txtCode'),
(2952, 'approved', 'Approved', NULL, 'approuvé'),
(2953, 'approve', 'Approve', NULL, 'approuver'),
(2954, 'credit_account_head', 'Credit Account Head', NULL, 'responsable de compte de crédit'),
(2955, 'successfully_approved', 'Successfully Approved', NULL, 'approuvé avec succès'),
(2956, 'debit_account_head', 'Debit Account Head', NULL, 'chef de compte débiteur'),
(2957, 'add_more', 'Add More', NULL, 'ajouter plus'),
(2958, 'update_debit_voucher', 'Update Debit Voucher', NULL, 'mettre à jour le bon de débit'),
(2959, 'update_credit_voucher', 'Update Credit Voucher', NULL, 'mettre à jour le bon de crédit'),
(2960, 'update_journal_voucher', 'Update Journal Voucher', NULL, 'mettre à jour le bon de journal'),
(2961, 'update_contra_voucher', 'Update Contra Voucher', NULL, 'mettre à jour le bon de contre-vérification'),
(2962, 'customer_head_code', 'Customer Head Code', NULL, 'code client principal'),
(2963, 'current_balance', 'Current Balance', NULL, 'Solde actuel'),
(2964, 'total_vat', 'Total Vat', NULL, 'TVA totale'),
(2965, 'account_reports', 'Account Reports', NULL, 'rapports de compte'),
(2966, 'general_ledger', 'General Ledger', NULL, 'grand livre général'),
(2967, 'profit_loss', 'Profit Loss', NULL, 'perte de profit'),
(2968, 'balance_sheet', 'Balance Sheet', NULL, 'bilan'),
(2969, 'cash_flow_statement', 'Cash Flow Statement', NULL, 'état des flux de trésorerie'),
(2970, 'trial_balance', 'Trial Balance', NULL, 'balance de vérification'),
(2971, 'reports_by_voucher', 'Reports By Voucher', NULL, 'rapports par bon'),
(2972, 'select_voucher_no', 'Select Voucher No', NULL, 'sélectionner le coupon non'),
(2973, 'voucher_reports', 'Voucher Reports', NULL, 'rapports sur les bons'),
(2974, 'account_code', 'Account Code', NULL, 'code de compte'),
(2975, 'created_date', 'Created Date', NULL, 'date de création'),
(2976, 'general_ledger_form', 'General Ledger Form', NULL, 'formulaire de grand livre'),
(2977, 'general_ledger_report', 'General Ledger Report', NULL, 'rapport de grand livre'),
(2978, 'transection_date', 'Transection Date', NULL, 'date de la section'),
(2979, 'head_code', 'Head Code', NULL, 'code de tête'),
(2980, 'particulars', 'Particulars', NULL, 'détails'),
(2981, 'profit_loss_report', 'Profit Loss Report', NULL, 'déclaration de perte de profit'),
(2982, 'authorized_signature', 'Authorized Signature', NULL, 'signature autorisée'),
(2983, 'trial_balance_with_opening_as_on', 'Trial balance with opening as on', NULL, 'balance de vérification avec ouverture comme le'),
(2984, 'opening_cash_and_equivalent', 'Opening Cash and Equivalent', NULL, 'trésorerie d\'ouverture et équivalent'),
(2985, 'trial_balance_without_opening', 'Trial Balance Without Opening', NULL, 'balance de vérification sans ouverture'),
(2986, 'trial_balance_with_opening', 'Trial Balance With Opening', NULL, 'balance de vérification avec ouverture'),
(2987, 'general_ledger_reports', 'General Ledger Reports', NULL, 'rapports de grand livre'),
(2988, 'another_fiscal_year_exist_in_given_range', 'Another Fiscal Year Exist in Given Date Range!', NULL, 'un autre exercice existe dans une plage donnée'),
(2989, 'invalid_date_selection', 'Invalid date selection! Please select a date from active fiscal year', NULL, 'sélection de date invalide'),
(2990, 'fields_must_not_be_empty', 'Fields must not be empty!', NULL, 'les champs ne doivent pas être vides'),
(2991, 'fiscal_year', 'Fiscal Year', NULL, 'exercice fiscal'),
(2992, 'cash_control_account', 'Cash Control Account', NULL, 'compte de contrôle de trésorerie'),
(2993, 'fiscal_year_ending', 'Fiscal Year Ending', NULL, 'exercice se terminant'),
(2994, 'fiscal_year_closed_successfully', 'Fiscal Year Closed Successfully', NULL, 'exercice clôturé avec succès'),
(2995, 'an_active_fiscal_year_exists', 'An active fiscal year exists', NULL, 'un exercice fiscal actif existe'),
(2996, 'please_add_new_fiscal_year_first', 'Please add new fiscal year first', NULL, 'veuillez d\'abord ajouter un nouvel exercice'),
(2999, 'add_assembly_product', 'Add Assembly Product', NULL, 'ajouter un produit d\'assemblage'),
(3010, 'manage_assembly_product', 'Manage Assembly Product', NULL, 'gérer le produit d\'assemblage'),
(3012, 'bar_code', 'Bar Code', NULL, 'code à barre'),
(3013, 'please_enter_bar_code', 'Please Enter Bar Code', NULL, 'veuillez saisir le code barre'),
(3014, 'product_vat', 'Product vat', NULL, 'cuve produit'),
(3015, 'store_or_warehouse', 'Store or Warehouse', NULL, 'magasin ou entrepôt'),
(3016, 'cost_price_per_unit', 'Cost price per unit', NULL, 'prix de revient unitaire'),
(3017, 'time_zone', 'Time Zone', NULL, 'fuseau horaire'),
(3019, 'supply_date', 'Supply Date', NULL, 'date de livraison'),
(3020, 'purchase_order_no', 'Purchase order no', NULL, 'bon de commande non'),
(3021, 'purchase_order_date\r\n', 'Purchase order date\r\n', NULL, 'date du bon de commande'),
(3022, 'purchase_order_expiration_date', 'Purchase order expiration date', NULL, 'date d\'expiration du bon de commande'),
(3023, 'date_of_supply', 'Date of supply', NULL, 'date de fourniture'),
(3024, 'purchase_order_date', 'Purchase order date', NULL, 'date du bon de commande'),
(3026, 'back', 'Back', NULL, 'retour'),
(3027, 'credit_headcode', 'Credit Headcode', NULL, 'code de crédit'),
(3028, 'loss', 'Profit', NULL, 'perte'),
(3029, 'loss', 'Loss', NULL, 'perte'),
(3030, 'profit', 'Profit', NULL, 'profit'),
(3031, 'loss', 'Loss', NULL, 'perte'),
(3032, 'profit', 'Profit', NULL, 'profit'),
(3033, 'loss', 'Loss', NULL, 'perte'),
(3034, 'header', 'Header', NULL, 'entête'),
(3035, 'footer', 'Footer', NULL, 'bas de page'),
(3036, 'send_to_invoice', 'Send to Invoice', NULL, 'envoyer à la facture'),
(3037, 'captcha_print_setting', 'Captcha Print Setting', NULL, 'paramètre d\'impression captcha'),
(3058, 'order_title', 'Order Title', NULL, 'titre de la commande'),
(3072, 'successfully_returned', 'Successfully Returned', NULL, 'retourné avec succès'),
(3128, 'start_cash_register', 'Start Cash Register', NULL, 'démarrer la caisse enregistreuse'),
(3137, 'add_assembly_product', 'Add Assembly Product', NULL, 'ajouter un produit d\'assemblage'),
(3148, 'manage_assembly_product', 'Manage Assembly Product', NULL, 'gérer le produit d\'assemblage'),
(3239, 'captcha_print_setting', 'Captcha Print Setting', NULL, 'paramètre d\'impression captcha'),
(3240, 'product_name', 'Product Name', NULL, 'nom du produit'),
(3241, 'pricing', 'Pricing Type', 'التسعير', 'tarification'),
(3242, 'user_profile', 'User Profile', NULL, 'profil de l\'utilisateur'),
(3243, 'setting', 'Setting', NULL, 'paramètre'),
(3244, 'language', 'Language', NULL, 'Langue'),
(3245, 'manage_users', 'Manage Users', NULL, 'gérer les utilisateurs'),
(3246, 'add_user', 'Add User', NULL, 'ajouter un utilisateur'),
(3247, 'manage_company', 'Manage Company', NULL, 'gérer l\'entreprise'),
(3248, 'web_settings', 'Software Settings', NULL, 'paramètres Web'),
(3249, 'manage_accounts', 'Manage Accounts', NULL, 'gérer les comptes'),
(3250, 'create_accounts', 'Create Account', NULL, 'créer des comptes'),
(3251, 'manage_bank', 'Manage Bank', NULL, 'gérer la banque'),
(3252, 'add_new_bank', 'Add New Bank', NULL, 'ajouter une nouvelle banque'),
(3253, 'settings', 'Settings', NULL, 'réglages'),
(3254, 'closing_report', 'Closing Report', NULL, 'rapport de clôture'),
(3255, 'closing', 'Closing', NULL, 'fermeture'),
(3256, 'cheque_manager', 'Cheque Manager', NULL, 'gestionnaire de chèques'),
(3257, 'accounts_summary', 'Accounts Summary', NULL, 'résumé des comptes'),
(3258, 'expense', 'Expense', NULL, 'frais'),
(3259, 'income', 'Income', NULL, 'le revenu'),
(3260, 'accounts', 'Accounts', NULL, 'comptes'),
(3261, 'stock_report', 'Stock Report', NULL, 'rapport de stock'),
(3262, 'stock', 'Stock', NULL, 'Stock'),
(3263, 'pos_invoice', 'POS Sale', NULL, 'facture pos'),
(3264, 'manage_invoice', 'Manage Sale', NULL, 'gérer la facture'),
(3265, 'new_invoice', 'New Sale', NULL, 'nouvelle facture'),
(3266, 'invoice', 'Sale', NULL, 'facture d\'achat'),
(3267, 'manage_purchase', 'Manage Purchase', NULL, 'gérer l\'achat'),
(3268, 'add_purchase', 'Add Purchase', NULL, 'ajouter un achat'),
(3269, 'purchase', 'Purchase', NULL, 'achat'),
(3270, 'paid_customer', 'Paid Customer', NULL, 'client payé'),
(3271, 'manage_customer', 'Manage Customer', NULL, 'gérer le client'),
(3272, 'add_customer', 'Add Customer', NULL, 'ajouter un client'),
(3273, 'customer', 'Customer', NULL, 'client'),
(3274, 'supplier_payment_actual', 'Supplier Payment Ledger', NULL, 'paiement fournisseur réel'),
(3275, 'supplier_sales_summary', 'Supplier Sales Summary', NULL, 'résumé des ventes des fournisseurs'),
(3276, 'supplier_sales_details', 'Supplier Sales Details', NULL, 'détails de vente du fournisseur'),
(3277, 'supplier_ledger', 'Supplier Ledger', NULL, 'registre des fournisseurs'),
(3278, 'manage_supplier', 'Manage Supplier', NULL, 'gérer le fournisseur'),
(3279, 'add_supplier', 'Add Supplier', NULL, 'ajouter un fournisseur'),
(3280, 'supplier', 'Supplier', NULL, 'le fournisseur'),
(3281, 'product_statement', 'Product Statement', NULL, 'déclaration de produit'),
(3282, 'manage_product', 'Manage Product', NULL, 'gérer le produit'),
(3283, 'add_product', 'Add Product', NULL, 'ajouter un produit'),
(3284, 'product', 'Product', NULL, 'produit'),
(3285, 'manage_category', 'Manage Category', NULL, 'gérer la catégorie'),
(3286, 'add_category', 'Add Category', NULL, 'ajouter une catégorie'),
(3287, 'category', 'Category', NULL, 'Catégorie'),
(3288, 'sales_report_product_wise', 'Sales Report (Product Wise)', NULL, 'rapport de vente par produit'),
(3289, 'purchase_report', 'Purchase Report', NULL, 'rapport d\'achat'),
(3290, 'sales_report', 'Sales Report', NULL, 'rapport des ventes'),
(3291, 'todays_report', 'Todays Report', NULL, 'rapport d\'aujourd\'hui'),
(3292, 'report', 'Report', NULL, 'rapport'),
(3293, 'dashboard', 'Dashboard', NULL, 'tableau de bord'),
(3294, 'online', 'Online', NULL, 'en ligne'),
(3295, 'logout', 'Logout', NULL, 'Se déconnecter'),
(3296, 'change_password', 'Change Password', NULL, 'changer le mot de passe'),
(3297, 'total_purchase', 'Total Purchase', NULL, 'achat total'),
(3298, 'total_amount', 'Total Amount', NULL, 'montant total'),
(3299, 'supplier_name', 'Supplier Name', NULL, 'Nom du fournisseur'),
(3300, 'invoice_no', 'Invoice No', NULL, 'facture non'),
(3301, 'purchase_date', 'Purchase Date', NULL, 'date d\'achat'),
(3302, 'todays_purchase_report', 'Todays Purchase Report', NULL, 'rapport d\'achat du jour'),
(3303, 'total_sales', 'Total Sales', NULL, 'ventes totales'),
(3304, 'customer_name', 'Customer Name', NULL, 'nom du client'),
(3305, 'sales_date', 'Sales Date', NULL, 'date de vente'),
(3306, 'todays_sales_report', 'Todays Sales Report', NULL, 'rapport des ventes du jour'),
(3307, 'home', 'Home', NULL, 'domicile'),
(3308, 'todays_sales_and_purchase_report', 'Todays sales and purchase report', NULL, 'rapport des ventes et des achats du jour'),
(3309, 'total_ammount', 'Total Amount', NULL, 'montant total'),
(3310, 'rate', 'Rate', NULL, 'évaluer'),
(3311, 'product_model', 'Product Model', NULL, 'modèle du produit'),
(3312, 'product_name', 'Product Name', NULL, 'nom du produit'),
(3313, 'search', 'Search', NULL, 'chercher'),
(3314, 'end_date', 'End Date', NULL, 'date de fin'),
(3315, 'start_date', 'Start Date', NULL, 'date de début'),
(3316, 'total_purchase_report', 'Total Purchase Report', NULL, 'rapport d\'achat total'),
(3317, 'total_sales_report', 'Total Sales Report', NULL, 'rapport des ventes totales'),
(3318, 'total_seles', 'Total Sales', NULL, 'total des ventes'),
(3319, 'all_stock_report', 'All Stock Report', NULL, 'tout rapport de stock'),
(3320, 'search_by_product', 'Search By Product', NULL, 'rechercher par produit'),
(3321, 'date', 'Date', NULL, 'Date'),
(3322, 'print', 'Print', NULL, 'imprimer'),
(3323, 'stock_date', 'Stock Date', NULL, 'date de stock'),
(3324, 'print_date', 'Print Date', NULL, 'date d\'impression'),
(3325, 'sales', 'Sales', NULL, 'Ventes'),
(3326, 'price', 'Price', NULL, 'le prix'),
(3327, 'sl', 'SL.', NULL, 'sl'),
(3328, 'add_new_category', 'Add new category', NULL, 'Ajouter une nouvelle catégorie'),
(3329, 'category_name', 'Category Name', NULL, 'Nom de catégorie'),
(3330, 'save', 'Save', NULL, 'enregistrer'),
(3331, 'delete', 'Delete', NULL, 'effacer'),
(3332, 'update', 'Update', NULL, 'mettre à jour'),
(3333, 'action', 'Action', NULL, 'action'),
(3334, 'manage_your_category', 'Manage your category ', NULL, 'gérer votre catégorie'),
(3335, 'category_edit', 'Category Edit', NULL, 'modification de catégorie'),
(3336, 'status', 'Status', NULL, 'statut'),
(3337, 'active', 'Active', NULL, 'actif'),
(3338, 'inactive', 'Inactive', NULL, 'inactif'),
(3339, 'save_changes', 'Save Changes', NULL, 'Sauvegarder les modifications'),
(3340, 'save_and_add_another', 'Save And Add Another', NULL, 'enregistrer et ajouter un autre'),
(3341, 'model', 'Model', NULL, 'maquette'),
(3342, 'supplier_price', 'Supplier Price', NULL, 'prix fournisseur'),
(3343, 'sell_price', 'Sale Price', NULL, 'prix de vente'),
(3344, 'image', 'Image', NULL, 'image'),
(3345, 'select_one', 'Select One', NULL, 'sélectionnez-en un'),
(3346, 'details', 'Details', NULL, 'détails'),
(3347, 'new_product', 'New Product', NULL, 'nouveau produit'),
(3348, 'add_new_product', 'Add new product', NULL, 'ajouter un nouveau produit'),
(3349, 'barcode', 'Barcode', NULL, 'code à barre'),
(3350, 'qr_code', 'Qr-Code', NULL, 'QR Code'),
(3351, 'product_details', 'Product Details', NULL, 'détails du produit'),
(3352, 'manage_your_product', 'Manage your product', NULL, 'gérer votre produit'),
(3353, 'product_edit', 'Product Edit', NULL, 'modification du produit'),
(3354, 'edit_your_product', 'Edit your product', NULL, 'modifier votre produit'),
(3355, 'cancel', 'Cancel', NULL, 'annuler'),
(3356, 'incl_vat', 'Incl. Vat', NULL, 'TVA incluse'),
(3357, 'money', 'TK', NULL, 'argent'),
(3358, 'grand_total', 'Grand Total', NULL, 'total'),
(3359, 'quantity', 'Qnty', NULL, 'quantité'),
(3360, 'product_report', 'Product Report', NULL, 'rapport de produit'),
(3361, 'product_sales_and_purchase_report', 'Product sales and purchase report', NULL, 'rapport sur les ventes et les achats de produits'),
(3362, 'previous_stock', 'Previous Stock', NULL, 'stock précédent'),
(3363, 'out', 'Out', NULL, 'dehors'),
(3364, 'in', 'In', NULL, 'dans'),
(3365, 'to', 'To', NULL, 'à'),
(3366, 'previous_balance', 'Previous Balance', NULL, 'solde précédent'),
(3367, 'customer_address', 'Customer Address', NULL, 'adresse du client'),
(3368, 'customer_mobile', 'Customer Mobile', NULL, 'mobile du client'),
(3369, 'customer_email', 'Customer Email', NULL, 'email client'),
(3370, 'add_new_customer', 'Add new customer', NULL, 'ajouter un nouveau client'),
(3371, 'balance', 'Balance', NULL, 'solde'),
(3372, 'mobile', 'Mobile', NULL, 'portable'),
(3373, 'address', 'Address', NULL, 'adresse'),
(3374, 'manage_your_customer', 'Manage your customer', NULL, 'gérer votre client'),
(3375, 'customer_edit', 'Customer Edit', NULL, 'client modifier'),
(3376, 'paid_customer_list', 'Paid Customer List', NULL, 'liste de clients payés'),
(3377, 'ammount', 'Amount', NULL, 'quantité'),
(3378, 'customer_ledger', 'Customer Ledger', NULL, 'registre des clients'),
(3379, 'manage_customer_ledger', 'Manage Customer Ledger', NULL, 'gérer le registre des clients'),
(3380, 'customer_information', 'Customer Information', NULL, 'Informations client'),
(3381, 'debit_ammount', 'Debit Amount', NULL, 'montant du débit'),
(3382, 'credit_ammount', 'Credit Amount', NULL, 'montant du crédit'),
(3383, 'balance_ammount', 'Balance Amount', NULL, 'montant du solde'),
(3384, 'receipt_no', 'Receipt NO', NULL, 'reçu non'),
(3385, 'description', 'Description', NULL, 'la description'),
(3386, 'debit', 'Debit', NULL, 'débit'),
(3387, 'credit', 'Credit', NULL, 'le crédit'),
(3388, 'item_information', 'Item Information', NULL, 'Informations sur l\'élément'),
(3389, 'total', 'Total', NULL, 'total'),
(3390, 'please_select_supplier', 'Please Select Supplier', NULL, 'veuillez sélectionner le fournisseur'),
(3391, 'submit', 'Submit', NULL, 'nous faire parvenir'),
(3392, 'submit_and_add_another', 'Submit And Add Another One', NULL, 'soumettre et ajouter un autre'),
(3393, 'add_new_item', 'Add New Item', NULL, 'Ajoute un nouvel objet'),
(3394, 'manage_your_purchase', 'Manage your purchase', NULL, 'gérer votre achat'),
(3395, 'purchase_edit', 'Purchase Edit', NULL, 'acheter modifier'),
(3396, 'purchase_ledger', 'Purchase Ledger', NULL, 'registre des achats'),
(3397, 'invoice_information', 'Sale Information', NULL, 'informations sur la facture'),
(3398, 'paid_ammount', 'Paid Amount', NULL, 'montant payé'),
(3399, 'discount', 'Dis./Pcs.', NULL, 'remise'),
(3400, 'save_and_paid', 'Save And Paid', NULL, 'économisez et payez'),
(3401, 'payee_name', 'Payee Name', NULL, 'le nom du bénéficiaire'),
(3402, 'manage_your_invoice', 'Manage your Sale', NULL, 'gérer votre facture'),
(3403, 'invoice_edit', 'Sale Edit', NULL, 'édition de facture'),
(3404, 'new_pos_invoice', 'New POS Sale', NULL, 'nouvelle facture pos'),
(3405, 'add_new_pos_invoice', 'Add new pos Sale', NULL, 'ajouter une nouvelle facture pos'),
(3406, 'product_id', 'Product ID', NULL, 'identifiant du produit'),
(3407, 'paid_amount', 'Paid Amount', NULL, 'montant payé'),
(3408, 'authorised_by', 'Authorised By', NULL, 'autorisé par'),
(3409, 'checked_by', 'Checked By', NULL, 'vérifié par'),
(3410, 'received_by', 'Received By', NULL, 'reçu par'),
(3411, 'prepared_by', 'Prepared By', NULL, 'preparé par'),
(3412, 'memo_no', 'Memo No', NULL, 'mémo pas'),
(3413, 'website', 'Website', NULL, 'site Internet'),
(3414, 'email', 'Email', NULL, 'e-mail'),
(3415, 'invoice_details', 'Sale Details', NULL, 'Détails de la facture'),
(3416, 'reset', 'Reset', NULL, 'réinitialiser'),
(3417, 'payment_account', 'Payment Account', NULL, 'Compte de paiement'),
(3418, 'bank_name', 'Bank Name', NULL, 'Nom de banque'),
(3419, 'cheque_or_pay_order_no', 'Cheque/Pay Order No', NULL, 'chèque ou ordre de paiement non'),
(3420, 'payment_type', 'Payment Type', NULL, 'type de paiement'),
(3421, 'payment_from', 'Payment From', NULL, 'Paiement de'),
(3422, 'payment_date', 'Payment Date', NULL, 'date de paiement'),
(3423, 'add_income', 'Add Income', NULL, 'ajouter un revenu'),
(3424, 'cash', 'Cash', NULL, 'en espèces'),
(3425, 'cheque', 'Cheque', NULL, 'Chèque'),
(3426, 'pay_order', 'Pay Order', NULL, 'payer la commande'),
(3427, 'payment_to', 'Payment To', NULL, 'Paiement à'),
(3428, 'total_outflow_ammount', 'Total Expense Amount', NULL, 'montant total des sorties'),
(3429, 'transections', 'Transections', NULL, 'transections'),
(3430, 'accounts_name', 'Accounts Name', NULL, 'nom du compte'),
(3431, 'outflow_report', 'Expense Report', NULL, 'rapport de sortie'),
(3432, 'inflow_report', 'Income Report', NULL, 'rapport d\'afflux'),
(3433, 'all', 'All', NULL, 'tout'),
(3434, 'account', 'Account', NULL, 'Compte'),
(3435, 'from', 'From', NULL, 'de'),
(3436, 'account_summary_report', 'Account Summary Report', NULL, 'rapport récapitulatif du compte'),
(3437, 'search_by_date', 'Search By Date', NULL, 'rechercher par date'),
(3438, 'cheque_no', 'Cheque No', NULL, 'vérifier non'),
(3439, 'name', 'Name', NULL, 'Nom'),
(3440, 'closing_account', 'Closing Account', NULL, 'clôture de compte'),
(3441, 'close_your_account', 'Close your account', NULL, 'fermer votre compte'),
(3442, 'last_day_closing', 'Last Day Closing', NULL, 'dernier jour de fermeture'),
(3443, 'cash_in', 'Cash In', NULL, 'encaisser'),
(3444, 'cash_out', 'Cash Out', NULL, 'encaisser'),
(3445, 'cash_in_hand', 'Cash In Hand', NULL, 'Du liquide en main'),
(3446, 'add_new_bank', 'Add New Bank', NULL, 'ajouter une nouvelle banque'),
(3447, 'day_closing', 'Day Closing', NULL, 'jour de fermeture'),
(3448, 'account_closing_report', 'Account Closing Report', NULL, 'rapport de clôture de compte'),
(3449, 'last_day_ammount', 'Last Day Amount', NULL, 'montant du dernier jour'),
(3450, 'adjustment', 'Adjustment', NULL, 'ajustement'),
(3451, 'pay_type', 'Pay Type', NULL, 'type de paiement'),
(3452, 'customer_or_supplier', 'Customer,Supplier Or Others', NULL, 'client ou fournisseur'),
(3453, 'transection_id', 'Transections ID', NULL, 'identifiant de transaction'),
(3454, 'accounts_summary_report', 'Accounts Summary Report', NULL, 'rapport récapitulatif des comptes'),
(3455, 'bank_list', 'Bank List', NULL, 'liste de banque'),
(3456, 'bank_edit', 'Bank Edit', NULL, 'banque modifier'),
(3457, 'debit_plus', 'Debit (+)', NULL, 'débit majoré'),
(3458, 'credit_minus', 'Credit (-)', NULL, 'crédit moins'),
(3459, 'account_name', 'Account Name', NULL, 'nom du compte'),
(3460, 'account_type', 'Account Type', NULL, 'Type de compte'),
(3461, 'account_real_name', 'Account Real Name', NULL, 'nom réel du compte'),
(3462, 'manage_account', 'Manage Account', NULL, 'gérer son compte'),
(3463, 'company_name', 'Niha International', NULL, 'Nom de l\'entreprise'),
(3464, 'edit_your_company_information', 'Edit your company information', NULL, 'modifier les informations de votre entreprise'),
(3465, 'company_edit', 'Company Edit', NULL, 'modification de l\'entreprise'),
(3466, 'admin', 'Admin', NULL, 'administrateur'),
(3467, 'user', 'User', NULL, 'utilisateur'),
(3468, 'password', 'Password', NULL, 'le mot de passe'),
(3469, 'last_name', 'Last Name', NULL, 'nom de famille'),
(3470, 'first_name', 'First Name', NULL, 'prénom'),
(3471, 'add_new_user_information', 'Add new user information', NULL, 'ajouter de nouvelles informations utilisateur'),
(3472, 'user_type', 'User Type', NULL, 'type d\'utilisateur'),
(3473, 'user_edit', 'User Edit', NULL, 'modification de l\'utilisateur'),
(3474, 'rtr', 'RTR', NULL, 'Rtr'),
(3475, 'ltr', 'LTR', NULL, 'litre'),
(3476, 'ltr_or_rtr', 'LTR/RTR', NULL, 'ltr ou rtr'),
(3477, 'footer_text', 'Footer Text', NULL, 'texte de pied de page'),
(3478, 'favicon', 'Favicon', NULL, 'favicon'),
(3479, 'logo', 'Logo', NULL, 'logo'),
(3480, 'update_setting', 'Update Setting', NULL, 'réglage de la mise à jour'),
(3481, 'update_your_web_setting', 'Update your web setting', NULL, 'mettre à jour vos paramètres Web'),
(3482, 'login', 'Login', NULL, 'connexion'),
(3483, 'your_strong_password', 'Your strong password', NULL, 'votre mot de passe fort'),
(3484, 'your_unique_email', 'Your unique email', NULL, 'votre e-mail unique'),
(3485, 'please_enter_your_login_information', 'Please enter your login information.', NULL, 'S\'il vous plaît entrer vos informations de connexion'),
(3486, 'update_profile', 'Update Profile', NULL, 'mettre à jour le profil'),
(3487, 'your_profile', 'Your Profile', NULL, 'votre profil'),
(3488, 're_type_password', 'Re-Type Password', NULL, 'retaper le mot de passe'),
(3489, 'new_password', 'New Password', NULL, 'nouveau mot de passe'),
(3490, 'old_password', 'Old Password', NULL, 'ancien mot de passe'),
(3491, 'new_information', 'New Information', NULL, 'nouvelle information'),
(3492, 'old_information', 'Old Information', NULL, 'anciennes informations'),
(3493, 'change_your_information', 'Change your information', NULL, 'modifier vos informations'),
(3494, 'change_your_profile', 'Change your profile', NULL, 'changer de profil'),
(3495, 'profile', 'Profile', NULL, 'profil'),
(3496, 'wrong_username_or_password', 'Wrong User Name Or Password !', NULL, 'mauvais nom d\'utilisateur ou mot de passe'),
(3497, 'successfully_updated', 'Successfully Updated.', NULL, 'mise à jour réussie'),
(3498, 'blank_field_does_not_accept', 'Blank Field Does Not Accept !', NULL, 'le champ vide n\'accepte pas'),
(3499, 'successfully_changed_password', 'Successfully changed password.', NULL, 'mot de passe changé avec succès'),
(3500, 'you_are_not_authorised_person', 'You are not authorised person !', NULL, 'vous n\'êtes pas une personne autorisée'),
(3501, 'password_and_repassword_does_not_match', 'Passwor and re-password does not match !', NULL, 'le mot de passe et le mot de passe ne correspondent pas'),
(3502, 'new_password_at_least_six_character', 'New Password At Least  Character.', NULL, 'nouveau mot de passe au moins six caractères'),
(3503, 'you_put_wrong_email_address', 'You put wrong email address !', NULL, 'vous avez mis une mauvaise adresse e-mail'),
(3504, 'cheque_ammount_asjusted', 'Cheque amount adjusted.', NULL, 'montant du chèque ajusté'),
(3505, 'successfully_payment_paid', 'Successfully Payment Paid.', NULL, 'paiement payé avec succès'),
(3506, 'successfully_added', 'Successfully Added.', NULL, 'ajouté avec succès'),
(3507, 'successfully_updated__closing_ammount_not_changeale', 'Successfully Updated -. Note: Closing Amount Not Changeable.', NULL, 'montant de clôture mis à jour avec succès non modifiable'),
(3508, 'successfully_payment_received', 'Successfully Payment Received.', NULL, 'paiement reçu avec succès'),
(3509, 'already_inserted', 'Already Inserted !', NULL, 'déjà inséré'),
(3510, 'successfully_delete', 'Successfully Delete.', NULL, 'supprimer avec succès'),
(3511, 'successfully_created', 'Successfully Created.', NULL, 'créé avec succès'),
(3512, 'logo_not_uploaded', 'Logo not uploaded !', NULL, 'logo non téléchargé'),
(3513, 'favicon_not_uploaded', 'Favicon not uploaded !', NULL, 'favicon non téléchargé'),
(3514, 'supplier_mobile', 'Supplier Mobile', NULL, 'fournisseur mobile'),
(3515, 'supplier_address', 'Supplier Address', NULL, 'adresse du fournisseur'),
(3516, 'supplier_details', 'Supplier Details', NULL, 'détails du fournisseur'),
(3517, 'add_new_supplier', 'Add New Supplier', NULL, 'ajouter un nouveau fournisseur'),
(3518, 'manage_suppiler', 'Manage Supplier', NULL, 'gérer le fournisseur'),
(3519, 'manage_your_supplier', 'Manage your supplier', NULL, 'gérer votre fournisseur'),
(3520, 'manage_supplier_ledger', 'Manage supplier ledger', NULL, 'gérer le registre des fournisseurs'),
(3521, 'invoice_id', 'Invoice ID', NULL, 'identifiant de facture'),
(3522, 'deposite_id', 'Deposite ID', NULL, 'identifiant de dépôt'),
(3523, 'supplier_actual_ledger', 'Supplier Payment Ledger', NULL, 'grand livre réel du fournisseur'),
(3524, 'supplier_information', 'Supplier Information', NULL, 'informations fournisseur'),
(3525, 'event', 'Event', NULL, 'un événement'),
(3526, 'add_new_income', 'Add New Income', NULL, 'ajouter de nouveaux revenus'),
(3527, 'add_expese', 'Add Expense', NULL, 'ajouter une dépense'),
(3528, 'add_new_expense', 'Add New Expense', NULL, 'ajouter une nouvelle dépense'),
(3529, 'total_inflow_ammount', 'Total Income Amount', NULL, 'montant total des rentrées'),
(3530, 'create_new_invoice', 'Create New Sale', NULL, 'créer une nouvelle facture'),
(3531, 'create_pos_invoice', 'Create POS Sale', NULL, 'créer une facture pos'),
(3532, 'total_profit', 'Total Profit', NULL, 'bénéfice total'),
(3533, 'monthly_progress_report', 'Monthly Progress Report', NULL, 'rapport d\'avancement mensuel'),
(3534, 'total_invoice', 'Total Sale', NULL, 'facture totale'),
(3535, 'account_summary', 'Account Summary', NULL, 'relevé de compte');
INSERT INTO `language` (`id`, `phrase`, `english`, `arabic`, `franais`) VALUES
(3536, 'total_supplier', 'Total Supplier', NULL, 'fournisseur total'),
(3537, 'total_product', 'Total Product', NULL, 'produit total'),
(3538, 'total_customer', 'Total Customer', NULL, 'client total'),
(3539, 'supplier_edit', 'Supplier Edit', NULL, 'fournisseur modifier'),
(3540, 'add_new_invoice', 'Add New Sale', NULL, 'ajouter une nouvelle facture'),
(3541, 'add_new_purchase', 'Add new purchase', NULL, 'ajouter un nouvel achat'),
(3542, 'currency', 'Currency', NULL, 'devise'),
(3543, 'currency_position', 'Currency Position', NULL, 'Position de la devise'),
(3544, 'left', 'Left', NULL, 'la gauche'),
(3545, 'right', 'Right', NULL, 'droit'),
(3546, 'add_tax', 'Add TAX', NULL, 'ajouter une taxe'),
(3547, 'manage_tax', 'Manage TAX', NULL, 'gérer les impôts'),
(3548, 'add_new_tax', 'Add new TAX', NULL, 'ajouter une nouvelle taxe'),
(3549, 'enter_tax', 'Enter TAX', NULL, 'saisir la taxe'),
(3550, 'already_exists', 'Already Exists !', NULL, 'existe déjà'),
(3551, 'successfully_inserted', 'Successfully Inserted.', NULL, 'inséré avec succès'),
(3552, 'tax', 'TAX', NULL, 'impôt'),
(3553, 'tax_edit', 'TAX Edit', NULL, 'taxe modifier'),
(3554, 'product_not_added', 'Product not added !', NULL, 'produit non ajouté'),
(3555, 'total_tax', 'Total TAX', NULL, 'taxe total'),
(3556, 'manage_your_supplier_details', 'Manage your supplier details.', NULL, 'gérer les coordonnées de vos fournisseurs'),
(3557, 'invoice_description', 'Lorem Ipsum is sim ply dummy Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy Lorem Ipsum is sim ply dummy Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy', NULL, 'description de la facture'),
(3558, 'thank_you_for_choosing_us', 'Thank you very much for choosing us.', NULL, 'Merci de nous avoir choisi'),
(3559, 'billing_date', 'Billing Date', NULL, 'date de facturation'),
(3560, 'billing_to', 'Billing To', NULL, 'facturer à'),
(3561, 'billing_from', 'Billing From', NULL, 'facturation à partir de'),
(3562, 'you_cant_delete_this_product', 'Sorry !!  You can\'t delete this product.This product already used in calculation system!', NULL, 'vous ne pouvez pas supprimer ce produit'),
(3563, 'old_customer', 'Old Customer', NULL, 'ancien client'),
(3564, 'new_customer', 'New Customer', NULL, 'nouveau client'),
(3565, 'new_supplier', 'New Supplier', NULL, 'nouveau fournisseur'),
(3566, 'old_supplier', 'Old Supplier', NULL, 'ancien fournisseur'),
(3567, 'credit_customer', 'Credit Customer', NULL, 'crédit client'),
(3568, 'account_already_exists', 'This Account Already Exists !', NULL, 'Le compte existe déjà'),
(3569, 'edit_income', 'Edit Income', NULL, 'modifier le revenu'),
(3570, 'you_are_not_access_this_part', 'You are not authorised person !', NULL, 'vous n\'accédez pas à cette partie'),
(3571, 'account_edit', 'Account Edit', NULL, 'modifier le compte'),
(3572, 'due', 'Due', NULL, 'exigible'),
(3573, 'expense_edit', 'Expense Edit', NULL, 'modification des dépenses'),
(3574, 'please_select_customer', 'Please select customer !', NULL, 'veuillez sélectionner le client'),
(3575, 'profit_report', 'Profit Report (Sale Wise)', NULL, 'rapport de profit'),
(3576, 'total_profit_report', 'Total profit report', NULL, 'rapport sur le bénéfice total'),
(3577, 'please_enter_valid_captcha', 'Please enter valid captcha.', NULL, 'veuillez saisir un captcha valide'),
(3578, 'category_not_selected', 'Category not selected.', NULL, 'catégorie non sélectionnée'),
(3579, 'supplier_not_selected', 'Supplier not selected.', NULL, 'fournisseur non sélectionné'),
(3580, 'please_select_product', 'Please select product.', NULL, 'veuillez sélectionner le produit'),
(3581, 'product_model_already_exist', 'Product model already exist !', NULL, 'le modèle de produit existe déjà'),
(3582, 'invoice_logo', 'Sale Logo', NULL, 'logo de la facture'),
(3583, 'available_qnty', 'Av. Qnty.', NULL, 'quantité disponible'),
(3584, 'you_can_not_buy_greater_than_available_cartoon', 'You can not select grater than available cartoon !', NULL, 'vous ne pouvez pas acheter plus que le dessin animé disponible'),
(3585, 'customer_details', 'Customer details', NULL, 'Détails du client'),
(3586, 'manage_customer_details', 'Manage customer details.', NULL, 'gérer les détails des clients'),
(3587, 'site_key', 'Captcha Site Key', NULL, 'clé du site'),
(3588, 'secret_key', 'Captcha Secret Key', NULL, 'clef secrète'),
(3589, 'captcha', 'Captcha', NULL, 'captcha'),
(3590, 'cartoon_quantity', 'Cartoon Quantity', NULL, 'quantité de bande dessinée'),
(3591, 'total_cartoon', 'Total Cartoon', NULL, 'dessin animé total'),
(3592, 'cartoon', 'Cartoon', NULL, 'dessin animé'),
(3593, 'item_cartoon', 'Item/Cartoon', NULL, 'dessin animé'),
(3594, 'product_and_supplier_did_not_match', 'Product and supplier did not match !', NULL, 'le produit et le fournisseur ne correspondaient pas'),
(3595, 'if_you_update_purchase_first_select_supplier_then_product_and_then_quantity', 'If you update purchase,first select supplier then product and then update qnty.', NULL, 'si vous mettez à jour l\'achat, sélectionnez d\'abord le fournisseur, puis le produit, puis la quantité'),
(3596, 'item', 'Item', NULL, 'Objet'),
(3597, 'manage_your_credit_customer', 'Manage your credit customer', NULL, 'gérer votre crédit client'),
(3598, 'total_quantity', 'Total Quantity', NULL, 'quantité totale'),
(3599, 'quantity_per_cartoon', 'Quantity per cartoon', NULL, 'quantité par dessin animé'),
(3600, 'barcode_qrcode_scan_here', 'Barcode or QR-code scan here', NULL, 'scannez le code-barres qrcode ici'),
(3601, 'synchronizer_setting', 'Synchronizer Setting', NULL, 'réglage du synchroniseur'),
(3602, 'data_synchronizer', 'Data Synchronizer', NULL, 'synchroniseur de données'),
(3603, 'hostname', 'Host name', NULL, 'nom d\'hôte'),
(3604, 'username', 'User Name', NULL, 'Nom d\'utilisateur'),
(3605, 'ftp_port', 'FTP Port', NULL, 'port ftp'),
(3606, 'ftp_debug', 'FTP Debug', NULL, 'débogage ftp'),
(3607, 'project_root', 'Project Root', NULL, 'racine du projet'),
(3608, 'please_try_again', 'Please try again', NULL, 'Veuillez réessayer'),
(3609, 'save_successfully', 'Save successfully', NULL, 'sauvegarde réussie'),
(3610, 'synchronize', 'Synchronize', NULL, 'synchroniser'),
(3611, 'internet_connection', 'Internet Connection', NULL, 'connexion Internet'),
(3612, 'outgoing_file', 'Outgoing File', NULL, 'fichier sortant'),
(3613, 'incoming_file', 'Incoming File', NULL, 'fichier entrant'),
(3614, 'ok', 'Ok', NULL, 'd\'accord'),
(3615, 'not_available', 'Not Available', NULL, 'indisponible'),
(3616, 'available', 'Available', NULL, 'disponible'),
(3617, 'download_data_from_server', 'Download data from server', NULL, 'télécharger les données du serveur'),
(3618, 'data_import_to_database', 'Data import to database', NULL, 'importation de données dans la base de données'),
(3619, 'data_upload_to_server', 'Data uplod to server', NULL, 'téléchargement de données sur le serveur'),
(3620, 'please_wait', 'Please Wait', NULL, 'S\'il vous plaît, attendez'),
(3621, 'ooops_something_went_wrong', 'Oooops Something went wrong !', NULL, 'oups quelque chose s\'est mal passé'),
(3622, 'upload_successfully', 'Upload successfully', NULL, 'télécharger avec succès'),
(3623, 'unable_to_upload_file_please_check_configuration', 'Unable to upload file please check configuration', NULL, 'impossible de télécharger le fichier, veuillez vérifier la configuration'),
(3624, 'please_configure_synchronizer_settings', 'Please configure synchronizer settings', NULL, 'veuillez configurer les paramètres du synchroniseur'),
(3625, 'download_successfully', 'Download successfully', NULL, 'télécharger avec succès'),
(3626, 'unable_to_download_file_please_check_configuration', 'Unable to download file please check configuration', NULL, 'impossible de télécharger le fichier, veuillez vérifier la configuration'),
(3627, 'data_import_first', 'Data import past', NULL, 'importer les données en premier'),
(3628, 'data_import_successfully', 'Data import successfully', NULL, 'importation des données réussie'),
(3629, 'unable_to_import_data_please_check_config_or_sql_file', 'Unable to import data please check config or sql file', NULL, 'impossible d\'importer des données, veuillez vérifier le fichier de configuration ou sql'),
(3630, 'total_sale_ctn', 'Total Sale Ctn', NULL, 'vente totale ctn'),
(3631, 'in_qnty', 'In Qnty.', NULL, 'en quantité'),
(3632, 'out_qnty', 'Out Qnty.', NULL, 'quantité'),
(3633, 'stock_report_supplier_wise', 'Stock Report (Supplier Wise)', NULL, 'fournisseur de rapport de stock avisé'),
(3634, 'all_stock_report_supplier_wise', 'Stock Report (Suppler Wise)', NULL, 'tous les rapports de stock fournisseur sage'),
(3635, 'select_supplier', 'Select Supplier', NULL, 'sélectionner le fournisseur'),
(3636, 'stock_report_product_wise', 'Stock Report (Product Wise)', NULL, 'rapport de stock par produit'),
(3637, 'phone', 'Phone', NULL, 'téléphoner'),
(3638, 'select_product', 'Select Product', NULL, 'sélectionner un produit'),
(3639, 'in_quantity', 'In Qnty.', NULL, 'en quantité'),
(3640, 'out_quantity', 'Out Qnty.', NULL, 'quantité'),
(3641, 'in_taka', 'In TK.', NULL, 'en taka'),
(3642, 'out_taka', 'Out TK.', NULL, 'hors taka'),
(3643, 'commission', 'Commission', NULL, 'commission'),
(3644, 'generate_commission', 'Generate Commssion', NULL, 'générer des commissions'),
(3645, 'commission_rate', 'Commission Rate', NULL, 'taux de commission'),
(3646, 'total_ctn', 'Total Ctn.', NULL, 'RCT total'),
(3647, 'per_pcs_commission', 'Per PCS Commission', NULL, 'par commission de pièces'),
(3648, 'total_commission', 'Total Commission', NULL, 'commission totale'),
(3649, 'enter', 'Enter', NULL, 'Entrer'),
(3650, 'please_add_walking_customer_for_default_customer', 'Please add \'Walking Customer\' for default customer.', NULL, 'veuillez ajouter un client ambulant pour le client par défaut'),
(3651, 'supplier_ammount', 'Supplier Amount', NULL, 'montant du fournisseur'),
(3652, 'my_sale_ammount', 'My Sale Amount', NULL, 'mon montant de vente'),
(3653, 'signature_pic', 'Signature Picture', NULL, 'photo de signature'),
(3654, 'branch', 'Branch', NULL, 'bifurquer'),
(3655, 'ac_no', 'A/C Number', NULL, 'ca non'),
(3656, 'ac_name', 'A/C Name', NULL, 'nom ca'),
(3657, 'bank_transaction', 'Bank Transaction', NULL, 'transaction bancaire'),
(3658, 'bank', 'Bank', NULL, 'banque'),
(3659, 'withdraw_deposite_id', 'Withdraw / Deposite ID', NULL, 'retirer l\'identifiant de dépôt'),
(3660, 'bank_ledger', 'Bank Ledger', NULL, 'registre bancaire'),
(3661, 'note_name', 'Note Name', NULL, 'nom de la note'),
(3662, 'pcs', 'Pcs.', NULL, 'pièces'),
(3663, '', '', NULL, NULL),
(3664, '', '', NULL, NULL),
(3665, '', '', NULL, NULL),
(3666, '', '', NULL, NULL),
(3667, '', '', NULL, NULL),
(3668, '', '', NULL, NULL),
(3669, '', '', NULL, NULL),
(3670, '', '', NULL, NULL),
(3671, '', '', NULL, NULL),
(3672, 'total_discount', 'Total Discount', NULL, 'Remise totale'),
(3673, 'product_not_found', 'Product not found !', NULL, 'Produit non trouvé'),
(3674, 'this_is_not_credit_customer', 'This is not credit customer !', NULL, 'ce n\'est pas un crédit client'),
(3675, 'personal_loan', 'Personal Loan', NULL, 'prêt personnel'),
(3676, 'add_person', 'Add Person', NULL, 'ajouter une personne'),
(3677, 'add_loan', 'Add Loan', NULL, 'ajouter un prêt'),
(3678, 'add_payment', 'Add Payment', NULL, 'ajouter un paiement'),
(3679, 'manage_person', 'Manage Person', NULL, 'gérer la personne'),
(3680, 'personal_edit', 'Person Edit', NULL, 'édition personnelle'),
(3681, 'person_ledger', 'Person Ledger', NULL, 'registre des personnes'),
(3682, 'backup_restore', 'Backup ', NULL, 'restauration de sauvegarde'),
(3683, 'database_backup', 'Database backup', NULL, 'sauvegarde de la base de données'),
(3684, 'file_information', 'File information', NULL, 'informations sur le fichier'),
(3685, 'filename', 'Filename', NULL, 'nom de fichier'),
(3686, 'size', 'Size', NULL, 'Taille'),
(3687, 'backup_date', 'Backup date', NULL, 'date de sauvegarde'),
(3688, 'backup_now', 'Backup now', NULL, 'sauvegarder maintenant'),
(3689, 'restore_now', 'Restore now', NULL, 'restaurer maintenant'),
(3690, 'are_you_sure', 'Are you sure ?', NULL, 'êtes-vous sûr'),
(3691, 'download', 'Download', NULL, 'Télécharger'),
(3692, 'backup_and_restore', 'Backup', NULL, 'sauvegarde et restauration'),
(3693, 'backup_successfully', 'Backup successfully', NULL, 'sauvegarde réussie'),
(3694, 'delete_successfully', 'successfully Deleted', NULL, 'supprimer avec succès'),
(3695, 'stock_ctn', 'Stock/Qnt', NULL, 'stock ctn'),
(3696, 'unit', 'Unit', NULL, 'unité'),
(3697, 'meter_m', 'Meter (M)', NULL, 'mètre m'),
(3698, 'piece_pc', 'Piece (Pc)', NULL, 'pièce pc'),
(3699, 'kilogram_kg', 'Kilogram (Kg)', NULL, 'kilogramme kg'),
(3700, 'stock_cartoon', 'Stock Cartoon', NULL, 'dessin animé'),
(3701, 'add_product_csv', 'Add Product (CSV)', NULL, 'ajouter le csv du produit'),
(3702, 'import_product_csv', 'Import product (CSV)', NULL, 'importer le produit csv'),
(3703, 'close', 'Close', NULL, 'proche'),
(3704, 'download_example_file', 'Download example file.', NULL, 'télécharger le fichier d\'exemple'),
(3705, 'upload_csv_file', 'Upload CSV File', NULL, 'télécharger le fichier csv'),
(3706, 'csv_file_informaion', 'CSV File Information', NULL, 'informations sur le fichier csv'),
(3707, 'out_of_stock', 'Out Of Stock', NULL, 'En rupture de stock'),
(3708, 'others', 'Others', NULL, 'les autres'),
(3709, 'full_paid', 'Full Paid', NULL, 'entièrement payé'),
(3710, 'successfully_saved', 'Your Data Successfully Saved', NULL, 'enregistré avec succès'),
(3711, 'manage_loan', 'Manage Loan', NULL, 'gérer le prêt'),
(3712, 'receipt', 'Receipt', NULL, 'reçu'),
(3713, 'payment', 'Payment', NULL, 'Paiement'),
(3714, 'cashflow', 'Daily Cash Flow', NULL, 'des flux de trésorerie'),
(3715, 'signature', 'Signature', NULL, 'Signature'),
(3716, 'supplier_reports', 'Supplier Reports', NULL, 'rapports des fournisseurs'),
(3717, 'generate', 'Generate', NULL, 'produire'),
(3718, 'todays_overview', 'Todays Overview', NULL, 'aperçu d\'aujourd\'hui'),
(3719, 'last_sales', 'Last Sales', NULL, 'dernières ventes'),
(3720, 'manage_transaction', 'Manage Transaction', NULL, 'gérer les transactions'),
(3721, 'daily_summary', 'Daily Summary', NULL, 'résumé quotidien'),
(3722, 'daily_cash_flow', 'Daily Cash Flow', NULL, 'trésorerie quotidienne'),
(3723, 'custom_report', 'Custom Report', NULL, 'rapport personnalisé'),
(3724, 'transaction', 'Transaction', NULL, 'transaction'),
(3725, 'receipt_amount', 'Receipt Amount', NULL, 'montant du reçu'),
(3726, 'transaction_details_datewise', 'Transaction Details Datewise', NULL, 'détails de la transaction par date'),
(3727, 'cash_closing', 'Cash Closing', NULL, 'clôture de trésorerie'),
(3728, 'you_can_not_buy_greater_than_available_qnty', 'You can not buy greater than available qnty.', NULL, 'vous ne pouvez pas acheter plus que la quantité disponible'),
(3729, 'supplier_id', 'Supplier ID', NULL, 'ID du fournisseur'),
(3730, 'category_id', 'Category ID', NULL, 'identifiant de catégorie'),
(3731, 'select_report', 'Select Report', NULL, 'sélectionner le rapport'),
(3732, 'supplier_summary', 'Supplier summary', NULL, 'récapitulatif fournisseur'),
(3733, 'sales_payment_actual', 'Sales payment actual', NULL, 'paiement des ventes réel'),
(3734, 'today_already_closed', 'Today already closed.', NULL, 'aujourd\'hui déjà fermé'),
(3735, 'root_account', 'Root Account', NULL, 'compte racine'),
(3736, 'office', 'Office', NULL, 'Bureau'),
(3737, 'loan', 'Loan', NULL, 'prêt'),
(3738, 'transaction_mood', 'Transaction Mood', NULL, 'humeur de transaction'),
(3739, 'select_account', 'Select Account', NULL, 'sélectionner un compte'),
(3740, 'add_receipt', 'Add Receipt', NULL, 'ajouter un reçu'),
(3741, 'update_transaction', 'Update Transaction', NULL, 'mettre à jour l\'opération'),
(3742, 'no_stock_found', 'No Stock Found !', NULL, 'pas de stock trouvé'),
(3743, 'admin_login_area', 'Admin Login Area', NULL, 'zone de connexion administrateur'),
(3744, 'print_qr_code', 'Print QR Code', NULL, 'imprimer le code qr'),
(3745, 'discount_type', 'Discount Type', NULL, 'type de remise'),
(3746, 'discount_percentage', 'Discount', NULL, 'pourcentage de remise'),
(3747, 'fixed_dis', 'Fixed Dis.', NULL, 'disque fixe'),
(3748, 'return', 'Return', NULL, 'revenir'),
(3749, 'stock_return_list', 'Stock Return List', NULL, 'liste de retour des stocks'),
(3750, 'wastage_return_list', 'Wastage Return List', NULL, 'liste de retour des déchets'),
(3751, 'return_invoice', 'Sale Return', NULL, 'facture de retour'),
(3752, 'sold_qty', 'Sold Qty', NULL, 'quantité vendue'),
(3753, 'ret_quantity', 'Return Qty', NULL, 'quantité de ret'),
(3754, 'deduction', 'Deduction', NULL, 'déduction'),
(3755, 'check_return', 'Check Return', NULL, 'retour de chèque'),
(3756, 'reason', 'Reason', NULL, 'raison'),
(3757, 'usablilties', 'Usability', NULL, 'utilisabilités'),
(3758, 'adjs_with_stck', 'Adjust With Stock', NULL, 'adj avec bâton'),
(3759, 'return_to_supplier', 'Return To Supplier', NULL, 'retour au fournisseur'),
(3760, 'wastage', 'Wastage', NULL, 'gaspillage'),
(3761, 'to_deduction', 'Total Deduction ', NULL, 'à la déduction'),
(3762, 'nt_return', 'Net Return Amount', NULL, 'pas de retour'),
(3763, 'return_list', 'Return List', NULL, 'liste de retour'),
(3764, 'add_return', 'Add Return', NULL, 'ajouter un retour'),
(3765, 'per_qty', 'Purchase Qty', NULL, 'par quantité'),
(3766, 'return_supplier', 'Supplier Return', NULL, 'fournisseur de retour'),
(3767, 'stock_purchase', 'Stock Purchase Price', NULL, 'achat d\'actions'),
(3768, 'stock_sale', 'Stock Sale Price', NULL, 'vente d\'actions'),
(3769, 'supplier_return', 'Supplier Return', NULL, 'retour fournisseur'),
(3770, 'purchase_id', 'Purchase ID', NULL, 'identifiant d\'achat'),
(3771, 'return_id', 'Return ID', NULL, 'ID de retour'),
(3772, 'supplier_return_list', 'Supplier Return List', NULL, 'liste de retour fournisseur'),
(3773, 'c_r_slist', 'Stock Return Stock', NULL, 'craigslist'),
(3774, 'wastage_list', 'Wastage List', NULL, 'liste de gaspillage'),
(3775, 'please_input_correct_invoice_id', 'Please Input a Correct Sale ID', NULL, 'veuillez entrer l\'identifiant de facture correct'),
(3776, 'please_input_correct_purchase_id', 'Please Input Your Correct  Purchase ID', NULL, 'veuillez entrer le bon identifiant d\'achat'),
(3777, 'add_more', 'Add More', NULL, 'ajouter plus'),
(3778, 'prouct_details', 'Product Details', NULL, 'détails du produit'),
(3779, 'prouct_detail', 'Product Details', NULL, 'détail du produit'),
(3780, 'stock_return', 'Stock Return', NULL, 'retour des actions'),
(3781, 'choose_transaction', 'Select Transaction', NULL, 'choisir l\'opération'),
(3782, 'transection_category', 'Select  Category', NULL, 'catégorie de section'),
(3783, 'transaction_categry', 'Select Category', NULL, 'catégorie d\'opérations'),
(3784, 'search_supplier', 'Search Supplier', NULL, 'rechercher un fournisseur'),
(3785, 'customer_id', 'Customer ID', NULL, 'N ° de client'),
(3786, 'search_customer', 'Search Customer Invoice', NULL, 'rechercher un client'),
(3787, 'serial_no', 'SN', NULL, 'numéro de série'),
(3788, 'item_discount', 'Item Discount', NULL, 'Remise sur l\'article'),
(3789, 'invoice_discount', 'Sale Discount', NULL, 'escompte sur facture'),
(3790, 'add_unit', 'Add Unit', NULL, 'ajouter une unité'),
(3791, 'manage_unit', 'Manage Unit', NULL, 'gérer l\'unité'),
(3792, 'add_new_unit', 'Add New Unit', NULL, 'ajouter une nouvelle unité'),
(3793, 'unit_name', 'Unit Name', NULL, 'nom de l\'unité'),
(3794, 'payment_amount', 'Payment Amount', NULL, 'montant du paiement'),
(3795, 'manage_your_unit', 'Manage Your Unit', NULL, 'gérer votre unité'),
(3796, 'unit_id', 'Unit ID', NULL, 'identifiant de l\'unité'),
(3797, 'unit_edit', 'Unit Edit', NULL, 'modifier l\'unité'),
(3798, 'vat', 'Vat', NULL, 'T.V.A'),
(3799, 'sales_report_category_wise', 'Sales Report (Category wise)', NULL, 'rapport de vente par catégorie'),
(3800, 'purchase_report_category_wise', 'Purchase Report (Category wise)', NULL, 'catégorie de rapport d\'achat sage'),
(3801, 'category_wise_purchase_report', 'Category wise purchase report', NULL, 'rapport d\'achat par catégorie'),
(3802, 'category_wise_sales_report', 'Category wise sales report', NULL, 'rapport de vente par catégorie'),
(3803, 'best_sale_product', 'Best Sale Product', NULL, 'meilleur produit de vente'),
(3804, 'all_best_sales_product', 'All Best Sales Products', NULL, 'tous les meilleurs produits de vente'),
(3805, 'todays_customer_receipt', 'Todays Customer Receipt', NULL, 'reçu client d\'aujourd\'hui'),
(3806, 'not_found', 'Record not found', NULL, 'pas trouvé'),
(3807, 'collection', 'Collection', NULL, 'le recueil'),
(3808, 'increment', 'Increment', NULL, 'incrément'),
(3809, 'accounts_tree_view', 'Accounts Tree View', NULL, 'arborescence des comptes'),
(3810, 'debit_voucher', 'Debit Voucher', NULL, 'bon de débit'),
(3811, 'voucher_no', 'Voucher No', NULL, 'bon non'),
(3812, 'credit_account_head', 'Credit Account Head', NULL, 'responsable de compte de crédit'),
(3813, 'remark', 'Remark', NULL, 'remarque'),
(3814, 'code', 'Code', NULL, 'code'),
(3815, 'amount', 'Amount', NULL, 'montant'),
(3816, 'approved', 'Approved', NULL, 'approuvé'),
(3817, 'debit_account_head', 'Debit Account Head', NULL, 'chef de compte débiteur'),
(3818, 'credit_voucher', 'Credit Voucher', NULL, 'bon de crédit'),
(3819, 'find', 'Find', NULL, 'trouver'),
(3820, 'transaction_date', 'Transaction Date', NULL, 'Date de la transaction'),
(3821, 'voucher_type', 'Voucher Type', NULL, 'type de bon'),
(3822, 'particulars', 'Particulars', NULL, 'détails'),
(3823, 'with_details', 'With Details', NULL, 'avec des détails'),
(3824, 'general_ledger', 'General Ledger', NULL, 'grand livre général'),
(3825, 'general_ledger_of', 'General ledger of', NULL, 'grand livre de'),
(3826, 'pre_balance', 'Pre Balance', NULL, 'pré balance'),
(3827, 'current_balance', 'Current Balance', NULL, 'Solde actuel'),
(3828, 'to_date', 'To Date', NULL, 'à ce jour'),
(3829, 'from_date', 'From Date', NULL, 'partir de la date'),
(3830, 'trial_balance', 'Trial Balance', NULL, 'balance de vérification'),
(3831, 'authorized_signature', 'Authorized Signature', NULL, 'signature autorisée'),
(3832, 'chairman', 'Chairman', NULL, 'président'),
(3833, 'total_income', 'Total Income', NULL, 'revenu total'),
(3834, 'statement_of_comprehensive_income', 'Statement of Comprehensive Income', NULL, 'état du résultat global'),
(3835, 'profit_loss', 'Profit Loss', NULL, 'perte de profit'),
(3836, 'cash_flow_report', 'Cash Flow Report', NULL, 'rapport de trésorerie'),
(3837, 'cash_flow_statement', 'Cash Flow Statement', NULL, 'état des flux de trésorerie'),
(3838, 'amount_in_dollar', 'Amount In Dollar', NULL, 'montant en dollars'),
(3839, 'opening_cash_and_equivalent', 'Opening Cash and Equivalent', NULL, 'trésorerie d\'ouverture et équivalent'),
(3840, 'coa_print', 'Coa Print', NULL, 'impression de coa'),
(3841, 'cash_flow', 'Cash Flow', NULL, 'des flux de trésorerie'),
(3842, 'cash_book', 'Cash Book', NULL, 'livre de caisse'),
(3843, 'bank_book', 'Bank Book', NULL, 'livret de banque'),
(3844, 'c_o_a', 'Chart of Account', NULL, 'c o un'),
(3845, 'journal_voucher', 'Journal Voucher', NULL, 'bon de journal'),
(3846, 'contra_voucher', 'Contra Voucher', NULL, 'contre bon'),
(3847, 'voucher_approval', 'Vouchar Approval', NULL, 'approbation du bon'),
(3848, 'supplier_payment', 'Supplier Payment', NULL, 'paiement fournisseur'),
(3849, 'customer_receive', 'Customer Receive', NULL, 'le client reçoit'),
(3850, 'gl_head', 'General Head', NULL, 'tête de gl'),
(3851, 'account_code', 'Account Head', NULL, 'code de compte'),
(3852, 'opening_balance', 'Opening Balance', NULL, 'solde d\'ouverture'),
(3853, 'head_of_account', 'Head of Account', NULL, 'chef de compte'),
(3854, 'inventory_ledger', 'Inventory Ledger', NULL, 'grand livre d\'inventaire'),
(3855, 'newpassword', 'New Password', NULL, 'nouveau mot de passe'),
(3856, 'password_recovery', 'Password Recovery', NULL, 'récupération de mot de passe'),
(3857, 'forgot_password', 'Forgot Password ??', NULL, 'mot de passe oublié'),
(3858, 'send', 'Send', NULL, 'envoyer'),
(3859, 'due_report', 'Due Report', NULL, 'rapport dû'),
(3860, 'due_amount', 'Due Amount', NULL, 'montant dû'),
(3861, 'download_sample_file', 'Download Sample File', NULL, 'télécharger un exemple de fichier'),
(3862, 'customer_csv_upload', 'Customer Csv Upload', NULL, 'téléchargement csv client'),
(3863, 'csv_supplier', 'Csv Upload Supplier', NULL, 'fournisseur csv'),
(3864, 'csv_upload_supplier', 'Csv Upload Supplier', NULL, 'fournisseur de téléchargement csv'),
(3865, 'previous', 'Previous', NULL, 'précédent'),
(3866, 'net_total', 'Net Total', NULL, 'total net'),
(3867, 'currency_list', 'Currency List', NULL, 'liste des devises'),
(3868, 'currency_name', 'Currency Name', NULL, 'nom de la devise'),
(3869, 'currency_icon', 'Currency Symbol', NULL, 'icône de devise'),
(3870, 'add_currency', 'Add Currency', NULL, 'ajouter une devise'),
(3871, 'role_permission', 'Role Permission', NULL, 'autorisation de rôle'),
(3872, 'role_list', 'Role List', NULL, 'liste de rôles'),
(3873, 'user_assign_role', 'User Assign Role', NULL, 'l\'utilisateur attribue un rôle'),
(3874, 'permission', 'Permission', NULL, 'autorisation'),
(3875, 'add_role', 'Add Role', NULL, 'ajouter un rôle'),
(3876, 'add_module', 'Add Module', NULL, 'ajouter un module'),
(3877, 'module_name', 'Module Name', NULL, 'nom du module'),
(3878, 'office_loan', 'Office Loan', NULL, 'prêt de bureau'),
(3879, 'add_menu', 'Add Menu', NULL, 'ajouter un menu'),
(3880, 'menu_name', 'Menu Name', NULL, 'nom du menu'),
(3881, 'sl_no', 'Sl No', NULL, 'sl non'),
(3882, 'create', 'Create', NULL, 'créer'),
(3883, 'read', 'Read', NULL, 'lis'),
(3884, 'role_name', 'Role Name', NULL, 'nom de rôle'),
(3885, 'qty', 'Quantity', NULL, 'quantité'),
(3886, 'max_rate', 'Max Rate', NULL, 'taux maximum'),
(3887, 'min_rate', 'Min Rate', NULL, 'taux minimum'),
(3888, 'avg_rate', 'Average Rate', NULL, 'taux moyen'),
(3889, 'role_permission_added_successfully', 'Role Permission Successfully Added', NULL, 'autorisation de rôle ajoutée avec succès'),
(3890, 'update_successfully', 'Successfully Updated', NULL, 'mise à jour réussie'),
(3891, 'role_permission_updated_successfully', 'Role Permission Successfully Updated ', NULL, 'autorisation de rôle mise à jour avec succès'),
(3892, 'shipping_cost', 'Shipping Cost', NULL, 'frais de port'),
(3893, 'in_word', 'In Word ', NULL, 'en mot'),
(3894, 'shipping_cost_report', 'Shipping Cost Report', NULL, 'rapport sur les frais de port'),
(3895, 'cash_book_report', 'Cash Book Report', NULL, 'rapport de caisse'),
(3896, 'inventory_ledger_report', 'Inventory Ledger Report', NULL, 'rapport de grand livre d\'inventaire'),
(3897, 'trial_balance_with_opening_as_on', 'Trial Balance With Opening As On', NULL, 'balance de vérification avec ouverture comme le'),
(3898, 'type', 'Type', NULL, 'taper'),
(3899, 'taka_only', 'Taka Only', NULL, 'taka seulement'),
(3900, 'item_description', 'Desc', NULL, 'descriptif de l\'article'),
(3901, 'sold_by', 'Sold By', NULL, 'vendu par'),
(3902, 'user_wise_sales_report', 'User Wise Sales Report', NULL, 'rapport de vente utilisateur sage'),
(3903, 'user_name', 'User Name', NULL, 'Nom d\'utilisateur'),
(3904, 'total_sold', 'Total Sold', NULL, 'total vendu'),
(3905, 'user_wise_sale_report', 'User Wise Sales Report', NULL, 'rapport de vente avisé par l\'utilisateur'),
(3906, 'barcode_or_qrcode', 'Barcode/QR-code', NULL, 'code barre ou qrcode'),
(3907, 'category_csv_upload', 'Category Csv  Upload', NULL, 'téléchargement csv de catégorie'),
(3908, 'unit_csv_upload', 'Unit Csv Upload', NULL, 'téléchargement csv de l\'unité'),
(3909, 'invoice_return_list', 'Sales Return list', NULL, 'liste de retour de facture'),
(3910, 'invoice_return', 'Sales Return', NULL, 'retour de facture'),
(3911, 'tax_report', 'TAX Report', NULL, 'rapport d\'impôt'),
(3912, 'select_tax', 'Select TAX', NULL, 'sélectionner la taxe'),
(3913, 'hrm', 'HRM', NULL, 'hrm'),
(3914, 'employee', 'Employee', NULL, 'employé'),
(3915, 'add_employee', 'Add Employee', NULL, 'ajouter un employé'),
(3916, 'manage_employee', 'Manage Employee', NULL, 'gérer un employé'),
(3917, 'attendance', 'Attendance', NULL, 'présence'),
(3918, 'add_attendance', 'Attendance', NULL, 'ajouter la présence'),
(3919, 'manage_attendance', 'Manage Attendance', NULL, 'gérer les présences'),
(3920, 'payroll', 'Payroll', NULL, 'paie'),
(3921, 'add_payroll', 'Payroll', NULL, 'ajouter la paie'),
(3922, 'manage_payroll', 'Manage Payroll', NULL, 'gérer la paie'),
(3923, 'employee_type', 'Employee Type', NULL, 'Type d\'employé'),
(3924, 'employee_designation', 'Employee Designation', NULL, 'désignation de l\'employé'),
(3925, 'designation', 'Designation', NULL, 'la désignation'),
(3926, 'add_designation', 'Add Designation', NULL, 'ajouter une désignation'),
(3927, 'manage_designation', 'Manage Designation', NULL, 'gérer la désignation'),
(3928, 'designation_update_form', 'Designation Update form', NULL, 'formulaire de mise à jour de la désignation'),
(3929, 'picture', 'Picture', NULL, 'image'),
(3930, 'country', 'Country', NULL, 'pays'),
(3931, 'blood_group', 'Blood Group', NULL, 'groupe sanguin'),
(3932, 'address_line_', 'Address Line ', NULL, 'ligne d\'adresse'),
(3933, 'address_line_', 'Address Line ', NULL, 'ligne d\'adresse'),
(3934, 'zip', 'Zip code', NULL, 'Zip *: français'),
(3935, 'city', 'City', NULL, 'ville'),
(3936, 'hour_rate_or_salary', 'Houre Rate/Salary', NULL, 'taux horaire ou salaire'),
(3937, 'rate_type', 'Rate Type', NULL, 'Type de taux'),
(3938, 'hourly', 'Hourly', NULL, 'toutes les heures'),
(3939, 'salary', 'Salary', NULL, 'un salaire'),
(3940, 'employee_update', 'Employee Update', NULL, 'mise à jour des employés'),
(3941, 'checkin', 'Check In', NULL, 'enregistrement'),
(3942, 'employee_name', 'Employee Name', NULL, 'Nom de l\'employé'),
(3943, 'checkout', 'Check Out', NULL, 'vérifier'),
(3944, 'confirm_clock', 'Confirm Clock', NULL, 'confirmer l\'horloge'),
(3945, 'stay', 'Stay Time', NULL, 'rester'),
(3946, 'sign_in', 'Sign In', NULL, 's\'identifier'),
(3947, 'check_in', 'Check In', NULL, 'enregistrement'),
(3948, 'single_checkin', 'Single Check In', NULL, 'enregistrement unique'),
(3949, 'bulk_checkin', 'Bulk Check In', NULL, 'enregistrement groupé'),
(3950, 'successfully_checkout', 'Successfully Checkout', NULL, 'paiement réussi'),
(3951, 'attendance_report', 'Attendance Report', NULL, 'rapport de présence'),
(3952, 'datewise_report', 'Date Wise Report', NULL, 'rapport par date'),
(3953, 'employee_wise_report', 'Employee Wise Report', NULL, 'rapport avisé des employés'),
(3954, 'date_in_time_report', 'Date In Time Report', NULL, 'rapport de date dans le temps'),
(3955, 'request', 'Request', NULL, 'demande'),
(3956, 'sign_out', 'Sign Out', NULL, 'se déconnecter'),
(3957, 'work_hour', 'Work Hours', NULL, 'heure de travail'),
(3958, 's_time', 'Start Time', NULL, 'le temps'),
(3959, 'e_time', 'In Time', NULL, 'le temps'),
(3960, 'salary_benefits_type', 'Benefits Type', NULL, 'type d\'avantages salariaux'),
(3961, 'salary_benefits', 'Salary Benefits', NULL, 'avantages salariaux'),
(3962, 'beneficial_list', 'Benefit List', NULL, 'liste avantageuse'),
(3963, 'add_beneficial', 'Add Benefits', NULL, 'ajouter bénéfique'),
(3964, 'add_benefits', 'Add Benefits', NULL, 'ajouter des avantages'),
(3965, 'benefits_list', 'Benefit List', NULL, 'liste des avantages'),
(3966, 'benefit_type', 'Benefit Type', NULL, 'type d\'avantage'),
(3967, 'benefits', 'Benefit', NULL, 'avantages'),
(3968, 'manage_benefits', 'Manage Benefits', NULL, 'gérer les avantages'),
(3969, 'deduct', 'Deduct', NULL, 'déduire'),
(3970, 'add', 'Add', NULL, 'ajouter'),
(3971, 'add_salary_setup', 'Add Salary Setup', NULL, 'ajouter la configuration du salaire'),
(3972, 'manage_salary_setup', 'Manage Salary Setup', NULL, 'gérer la configuration des salaires'),
(3973, 'basic', 'Basic', NULL, 'de base'),
(3974, 'salary_type', 'Salary Type', NULL, 'type de salaire'),
(3975, 'addition', 'Addition', NULL, 'ajout'),
(3976, 'gross_salary', 'Gross Salary', NULL, 'salaire brut'),
(3977, 'set', 'Set', NULL, 'Positionner'),
(3978, 'salary_generate', 'Salary Generate', NULL, 'salaire générer'),
(3979, 'manage_salary_generate', 'Manage Salary Generate', NULL, 'gérer le salaire générer'),
(3980, 'sal_name', 'Salary Name', NULL, 'nom sal'),
(3981, 'gdate', 'Generated Date', NULL, 'gdate'),
(3982, 'generate_by', 'Generated By', NULL, 'générer par'),
(3983, 'the_salary_of', 'The Salary of ', NULL, 'le salaire de'),
(3984, 'already_generated', ' Already Generated', NULL, 'déjà généré'),
(3985, 'salary_month', 'Salary Month', NULL, 'mois de salaire'),
(3986, 'successfully_generated', 'Successfully Generated', NULL, 'généré avec succès'),
(3987, 'salary_payment', 'Salary Payment', NULL, 'paiement du salaire'),
(3988, 'employee_salary_payment', 'Employee Salary Payment', NULL, 'paiement du salaire des employés'),
(3989, 'total_salary', 'Total Salary', NULL, 'salaire total'),
(3990, 'total_working_minutes', 'Total Working Hours', NULL, 'minutes de travail totales'),
(3991, 'working_period', 'Working Period', NULL, 'Période de travail'),
(3992, 'paid_by', 'Paid By', NULL, 'payé par'),
(3993, 'pay_now', 'Pay Now ', NULL, 'payez maintenant'),
(3994, 'confirm', 'Confirm', NULL, 'confirmer'),
(3995, 'successfully_paid', 'Successfully Paid', NULL, 'payé avec succès'),
(3996, 'add_incometax', 'Add Income TAX', NULL, 'ajouter l\'impôt sur le revenu'),
(3997, 'setup_tax', 'Setup TAX', NULL, 'taxe d\'installation'),
(3998, 'start_amount', 'Start Amount', NULL, 'montant de départ'),
(3999, 'end_amount', 'End Amount', NULL, 'montant final'),
(4000, 'tax_rate', 'TAX Rate', NULL, 'taux d\'imposition'),
(4001, 'setup', 'Setup', NULL, 'mettre en place'),
(4002, 'manage_income_tax', 'Manage Income TAX', NULL, 'gérer l\'impôt sur le revenu'),
(4003, 'income_tax_updateform', 'Income TAX Update form', NULL, 'formulaire de mise à jour de l\'impôt sur le revenu'),
(4004, 'positional_information', 'Positional Information', NULL, 'informations de position'),
(4005, 'personal_information', 'Personal Information', NULL, 'renseignements personnels'),
(4006, 'timezone', 'Time Zone', NULL, 'fuseau horaire'),
(4007, 'sms', 'SMS', NULL, 'SMS'),
(4008, 'sms_configure', 'SMS Configure', NULL, 'configurer les sms'),
(4009, 'url', 'URL', NULL, 'URL'),
(4010, 'sender_id', 'Sender ID', NULL, 'identifiant de l\'expéditeur'),
(4011, 'api_key', 'Api Key', NULL, 'clé API'),
(4012, 'gui_pos', 'GUI POS', NULL, 'gui pos'),
(4013, 'manage_service', 'Manage Service', NULL, 'gérer le service'),
(4014, 'service', 'Service', NULL, 'service'),
(4015, 'add_service', 'Add Service', NULL, 'ajouter un service'),
(4016, 'service_edit', 'Service Edit', NULL, 'service modifier'),
(4017, 'service_csv_upload', 'Service CSV Upload', NULL, 'service de téléchargement csv'),
(4018, 'service_name', 'Service Name', NULL, 'Nom du service'),
(4019, 'charge', 'Charge', NULL, 'charge'),
(4020, 'service_invoice', 'Service Invoice', NULL, 'facture d\'entretien'),
(4021, 'service_discount', 'Service Discount', NULL, 'remise sur les services'),
(4022, 'hanging_over', 'ETD', NULL, 'suspendue au-dessus'),
(4023, 'service_details', 'Service Details', NULL, 'détails des services'),
(4024, 'tax_settings', 'TAX Settings', NULL, 'paramètres de taxe'),
(4025, 'default_value', 'Default Value', NULL, 'valeur par défaut'),
(4026, 'number_of_tax', 'Number of TAX', NULL, 'numéro de taxe'),
(4027, 'please_select_employee', 'Please Select Employee', NULL, 'veuillez sélectionner un employé'),
(4028, 'manage_service_invoice', 'Manage Service Invoice', NULL, 'gérer la facture de service'),
(4029, 'update_service_invoice', 'Update Service Invoice', NULL, 'mettre à jour la facture de service'),
(4030, 'customer_wise_tax_report', 'Customer Wise TAX Report', NULL, 'rapport fiscal avisé client'),
(4031, 'service_id', 'Service Id', NULL, 'identifiant de service'),
(4032, 'invoice_wise_tax_report', 'Invoice Wise TAX Report', NULL, 'rapport d\'impôt sur la facture'),
(4033, 'reg_no', 'Reg No', NULL, 'non enregistré'),
(4034, 'update_now', 'Update Now', NULL, 'Mettez à jour maintenant'),
(4035, 'import', 'Import', NULL, 'importer'),
(4036, 'add_expense_item', 'Add Expense Item', NULL, 'ajouter une dépense'),
(4037, 'manage_expense_item', 'Manage Expense Item', NULL, 'gérer les dépenses'),
(4038, 'add_expense', 'Add Expense', NULL, 'ajouter une dépense'),
(4039, 'manage_expense', 'Manage Expense', NULL, 'gérer les dépenses'),
(4040, 'expense_statement', 'Expense Statement', NULL, 'relevé de dépenses'),
(4041, 'expense_type', 'Expense Type', NULL, 'Type de dépense'),
(4042, 'expense_item_name', 'Expense Item Name', NULL, 'nom de la dépense'),
(4043, 'stock_purchase_price', 'Stock Purchase Price', NULL, 'prix d\'achat des actions'),
(4044, 'purchase_price', 'Purchase Price', NULL, 'prix d\'achat'),
(4045, 'customer_advance', 'Customer Advance', NULL, 'avance client'),
(4046, 'advance_type', 'Advance Type', NULL, 'type d\'avance'),
(4047, 'restore', 'Restore', NULL, 'restaurer'),
(4048, 'supplier_advance', 'Supplier Advance', NULL, 'avance fournisseur'),
(4049, 'please_input_correct_invoice_no', 'Please Input Correct Invoice NO', NULL, 'veuillez saisir le numéro de facture correct'),
(4050, 'backup', 'Back Up', NULL, 'sauvegarde'),
(4051, 'app_setting', 'App Settings', NULL, 'réglage de l\'application'),
(4052, 'local_server_url', 'Local Server Url', NULL, 'URL du serveur local'),
(4053, 'online_server_url', 'Online Server Url', NULL, 'URL du serveur en ligne'),
(4054, 'connet_url', 'Connected Hotspot Ip/url', NULL, 'URL de connexion'),
(4055, 'update_your_app_setting', 'Update Your App Setting', NULL, 'mettre à jour les paramètres de votre application'),
(4056, 'select_category', 'Select Category', NULL, 'Choisir une catégorie'),
(4057, 'mini_invoice', 'Mini Invoice', NULL, 'mini-facture'),
(4058, 'purchase_details', 'Purchase Details', NULL, 'Détails d\'achat'),
(4059, 'disc', 'Dis %', NULL, 'disque'),
(4060, 'serial', 'Serial', NULL, 'en série'),
(4061, 'transaction_head', 'Transaction Head', NULL, 'chef de transaction'),
(4062, 'transaction_type', 'Transaction Type', NULL, 'Type de transaction'),
(4063, 'return_details', 'Return Details', NULL, 'détails du retour'),
(4064, 'return_to_customer', 'Return To Customer', NULL, 'retour au client'),
(4065, 'sales_and_purchase_report_summary', 'Sales And Purchase Report Summary', NULL, 'résumé des rapports de ventes et d\'achats'),
(4066, 'add_person_officeloan', 'Add Person (Office Loan)', NULL, 'ajouter un prêt au bureau d\'une personne'),
(4067, 'add_loan_officeloan', 'Add Loan (Office Loan)', NULL, 'ajouter un bureau de prêtprêt'),
(4068, 'add_payment_officeloan', 'Add Payment (Office Loan)', NULL, 'ajouter un bureau de paiementprêt'),
(4069, 'manage_loan_officeloan', 'Manage Loan (Office Loan)', NULL, 'gérer le bureau de prêtprêt'),
(4070, 'add_person_personalloan', 'Add Person (Personal Loan)', NULL, 'ajouter prêt personnel personne'),
(4071, 'add_loan_personalloan', 'Add Loan (Personal Loan)', NULL, 'ajouter prêt prêt personnel'),
(4072, 'add_payment_personalloan', 'Add Payment (Personal Loan)', NULL, 'ajouter paiement prêt personnel'),
(4073, 'manage_loan_personalloan', 'Manage Loan (Personal)', NULL, 'gérer prêt prêt personnel'),
(4074, 'hrm_management', 'Human Resource', NULL, 'gestion rh'),
(4075, 'cash_adjustment', 'Cash Adjustment', NULL, 'ajustement en espèces'),
(4076, 'adjustment_type', 'Adjustment Type', NULL, 'type de réglage'),
(4077, 'change', 'Change', NULL, 'monnaie'),
(4078, 'sale_by', 'Sale By', NULL, 'vente par'),
(4079, 'salary_date', 'Salary Date', NULL, 'date de salaire'),
(4080, 'earnings', 'Earnings', NULL, 'gains'),
(4081, 'total_addition', 'Total Addition', NULL, 'addition totale'),
(4082, 'total_deduction', 'Total Deduction', NULL, 'déduction totale'),
(4083, 'net_salary', 'Net Salary', NULL, 'salaire net'),
(4084, 'ref_number', 'Reference Number', NULL, 'numéro de ref'),
(4085, 'name_of_bank', 'Name Of Bank', NULL, 'nom de la banque'),
(4086, 'salary_slip', 'Salary Slip', NULL, 'fiche de salaire'),
(4087, 'basic_salary', 'Basic Salary', NULL, 'salaire de base'),
(4088, 'return_from_customer', 'Return From Customer', NULL, 'retour du client'),
(4089, 'quotation', 'Quotation', NULL, 'devis'),
(4090, 'add_quotation', 'Add Quotation', NULL, 'ajouter un devis'),
(4091, 'manage_quotation', 'Manage Quotation', NULL, 'gérer le devis'),
(4092, 'terms', 'Terms', NULL, 'termes'),
(4093, 'send_to_customer', 'Sent To Customer', NULL, 'envoyer au client'),
(4094, 'quotation_no', 'Quotation No', NULL, 'devis non'),
(4095, 'quotation_date', 'Quotation Date', NULL, 'date de cotation'),
(4096, 'total_service_tax', 'Total Service TAX', NULL, 'taxe de service totale'),
(4097, 'totalservicedicount', 'Total Service Discount', NULL, 'totalservicedecount'),
(4098, 'item_total', 'Item Total', NULL, 'Objet total'),
(4099, 'service_total', 'Service Total', NULL, 'somme des services'),
(4100, 'quot_description', 'Quotation Description', NULL, 'description de la citation'),
(4101, 'sub_total', 'Sub Total', NULL, 'sous-total'),
(4102, 'mail_setting', 'Mail Setting', NULL, 'paramètre de messagerie'),
(4103, 'mail_configuration', 'Mail Configuration', NULL, 'configuration de la messagerie'),
(4104, 'mail', 'Mail', NULL, 'courrier'),
(4105, 'protocol', 'Protocol', NULL, 'protocole'),
(4106, 'smtp_host', 'SMTP Host', NULL, 'hôte smtp'),
(4107, 'smtp_port', 'SMTP Port', NULL, 'port smtp'),
(4108, 'sender_mail', 'Sender Mail', NULL, 'courrier de l\'expéditeur'),
(4109, 'mail_type', 'Mail Type', NULL, 'type de courrier'),
(4110, 'html', 'HTML', NULL, 'html'),
(4111, 'text', 'TEXT', NULL, 'texte'),
(4112, 'expiry_date', 'Expiry Date', NULL, 'date d\'expiration'),
(4113, 'api_secret', 'Api Secret', NULL, 'secret de l\'API'),
(4114, 'please_config_your_mail_setting', NULL, NULL, 'veuillez configurer vos paramètres de messagerie'),
(4115, 'quotation_successfully_added', 'Quotation Successfully Added', NULL, 'devis ajouté avec succès'),
(4116, 'add_to_invoice', 'Add To Invoice', NULL, 'ajouter à la facture'),
(4117, 'added_to_invoice', 'Added To Invoice', NULL, 'ajouté à la facture'),
(4118, 'closing_balance', 'Closing Balance', NULL, 'solde de clôture'),
(4119, 'contact', 'Contact', NULL, 'Contactez'),
(4120, 'fax', 'Fax', NULL, 'fax'),
(4121, 'state', 'State', NULL, 'Etat'),
(4122, 'discounts', 'Discount', NULL, 'remises'),
(4123, 'address', 'Address', NULL, 'adresse'),
(4124, 'address', 'Address', NULL, 'adresse'),
(4125, 'receive', 'Receive', NULL, 'recevoir'),
(4126, 'purchase_history', 'Purchase History', NULL, 'historique d\'achat'),
(4127, 'cash_payment', 'Cash Payment', NULL, 'paiement en espèces'),
(4128, 'bank_payment', 'Bank Payment', NULL, 'paiement bancaire'),
(4129, 'do_you_want_to_print', 'Do You Want to Print', NULL, 'voulez-vous imprimer'),
(4130, 'yes', 'Yes', NULL, 'oui'),
(4131, 'no', 'No', NULL, 'non'),
(4132, 'todays_sale', 'Today\'s Sales', NULL, 'vente d\'aujourd\'hui'),
(4133, 'or', 'OR', NULL, 'ou'),
(4134, 'no_result_found', 'No Result Found', NULL, 'Aucun résultat trouvé'),
(4135, 'add_service_quotation', 'Add Service Quotation', NULL, 'ajouter un devis de service'),
(4136, 'add_to_invoice', 'Add To Invoice', NULL, 'ajouter à la facture'),
(4137, 'item_quotation', 'Item Quotation', NULL, 'devis d\'article'),
(4138, 'service_quotation', 'Service Quotation', NULL, 'devis de service'),
(4139, 'return_from', 'Return Form', NULL, 'revenir de'),
(4140, 'customer_return_list', 'Customer Return List', NULL, 'liste de retour client'),
(4141, 'pdf', 'Pdf', NULL, 'pdf'),
(4142, 'note', 'Note', NULL, 'Remarque'),
(4143, 'update_debit_voucher', 'Update Debit Voucher', NULL, 'mettre à jour le bon de débit'),
(4144, 'update_credit_voucher', 'Update Credit voucher', NULL, 'mettre à jour le bon de crédit'),
(4145, 'on', 'On', NULL, 'sur'),
(4146, '', '', NULL, NULL),
(4147, 'total_expenses', 'Total Expense', NULL, 'dépenses totales'),
(4148, 'already_exist', 'Already Exist', NULL, 'existe déjà'),
(4149, 'checked_out', 'Checked Out', NULL, 'vérifié'),
(4150, 'update_salary_setup', 'Update Salary Setup', NULL, 'mettre à jour la configuration du salaire'),
(4151, 'employee_signature', 'Employee Signature', NULL, 'Signature de l\'employé'),
(4152, 'payslip', 'Payslip', NULL, 'fiche de paie'),
(4153, 'exsisting_role', 'Existing Role', NULL, 'rôle existant'),
(4154, 'filter', 'Filter', NULL, 'filtre'),
(4155, 'testinput', NULL, NULL, 'entrée de test'),
(4156, 'update_quotation', 'Update Quotation', NULL, 'mettre à jour le devis'),
(4157, 'quotation_successfully_updated', 'Quotation Successfully Updated', NULL, 'devis mis à jour avec succès'),
(4158, 'successfully_approved', 'Successfully Approved', NULL, 'approuvé avec succès'),
(4159, 'expiry', 'Expiry', NULL, 'expiration'),
(4160, 'user_list', 'User List', NULL, 'liste d\'utilisateur'),
(4161, 'assign_roleto_user', 'Assign Role To User', NULL, 'attribuer un rôle à l\'utilisateur'),
(4162, 'assign_role_list', 'Assigned Role List', NULL, 'assigner la liste des rôles'),
(4163, 'application_settings', 'Application Settings', NULL, 'paramètres de l\'application'),
(4164, 'company_list', 'Company List', NULL, 'liste d\'entreprises'),
(4165, 'edit_company', 'Edit Company', NULL, 'modifier l\'entreprise'),
(4166, 'edit_user', 'Edit User', NULL, 'Modifier l\'utilisateur'),
(4167, 'edit_currency', 'Edit Currency', NULL, 'modifier la devise'),
(4168, 'mobile_no', 'Mobile No', NULL, 'mobile non'),
(4169, 'email_address', 'Email Address', NULL, 'adresse e-mail'),
(4170, 'customer_list', 'Customer List', NULL, 'liste de clients'),
(4171, 'advance_receipt', 'Advance Receipt', NULL, 'reçu d\'avance'),
(4172, 'supplier_list', 'Supplier List', NULL, 'liste des fournisseurs'),
(4173, 'category_list', 'Category List', NULL, 'liste des catégories'),
(4174, 'no_record_found', 'No Record Found', NULL, 'Aucun Enregistrement Trouvé'),
(4175, 'unit_list', 'Unit List', NULL, 'liste des unités'),
(4176, 'edit_product', 'Edit Product', NULL, 'modifier le produit'),
(4177, 'payable_summary', 'Payable Summary', NULL, 'récapitulatif payable'),
(4178, 'pad_print', 'Pad Print', NULL, 'tampographie'),
(4179, 'pos_print', 'POS Print', NULL, 'impression pos'),
(4180, 'pos_invoice', 'POS Invoice', NULL, 'facture pos'),
(4181, 'employee_profile', 'Employee Profile', NULL, 'profil de l\'employé'),
(4182, 'edit_beneficials', 'Edit Beneficials', NULL, 'modifier les avantages'),
(4183, 'edit_setup_update', 'Edit Salary Setup', NULL, 'modifier la mise à jour de la configuration'),
(4184, 'add_office_loan', 'Add Office Loan', NULL, 'ajouter prêt bureau'),
(4185, 'income_tax', 'Income TAX', NULL, 'impôt sur le revenu'),
(4186, 'quotation_to_sale', 'Quotation To Sale', NULL, 'devis à la vente'),
(4187, 'quotation_edit', 'Edit Quotation', NULL, 'devis modifier'),
(4188, 'edit_profile', 'Edit Profile', NULL, 'Editer le profil'),
(4189, 'edit_supplier', 'Edit Supplier', NULL, 'modifier le fournisseur'),
(4190, 'edit_bank', 'Edit Bank', NULL, 'modifier la banque'),
(4191, 'balance_sheet', 'Balance Sheet', NULL, 'bilan'),
(4192, 'salary_setup', 'Salary Setup', NULL, 'configuration du salaire'),
(4193, 'account_head', 'Account Head', NULL, 'chef de compte'),
(4194, 'add_invoice', 'Add Invoice', NULL, 'ajouter une facture'),
(4195, 'general_ledger_report', 'General Ledger Report', NULL, 'rapport de grand livre'),
(4196, 'print_setting', 'Print Setting', NULL, 'paramètre d\'impression'),
(4197, 'header', 'Header', NULL, 'entête'),
(4198, 'footer', 'Footer', NULL, 'bas de page'),
(4199, 'supplier_payment_receipt', 'Payment Receipt', NULL, 'reçu de paiement fournisseur'),
(4200, 'welcome_back', 'Welcome Back', NULL, 'content de te revoir'),
(4201, 'overwrite', 'Over Write', NULL, 'écraser'),
(4202, 'module', 'Module', NULL, 'module'),
(4203, 'purchase_key', 'Purchase Key', NULL, 'clé d\'achat'),
(4204, 'buy_now', 'Buy Now', NULL, 'Acheter maintenant'),
(4205, 'module_list', 'Module List', NULL, 'liste des modules'),
(4206, 'modules', 'Modules', NULL, 'modules'),
(4207, 'install', 'Install', NULL, 'installer'),
(4208, 'uninstall', 'Uninstall', NULL, 'désinstaller'),
(4209, 'module_added_successfully', 'Module Added Successfully', NULL, 'module ajouté avec succès'),
(4210, 'no_tables_are_registered_in_config', 'No table registered in config', NULL, 'aucune table n\'est enregistrée dans la configuration'),
(4211, 'tables_are_not_available_in_database', 'Table Are not Available in Database', NULL, 'les tables ne sont pas disponibles dans la base de données'),
(4212, 'addon', 'Add-ons', NULL, 'Ajouter'),
(4213, 'generate_qr', 'Generate QR', NULL, 'générer qr'),
(4214, 'latestv', 'Latest Version', NULL, 'dernièrev'),
(4215, 'Current Version', NULL, NULL, 'Version actuelle'),
(4216, 'notesupdate', 'Note: If you want to update software,you Must have immediate previous version', NULL, 'mise à jour des notes'),
(4217, 'arabic', NULL, NULL, 'arabe'),
(4218, 'vat_no', 'VAT NO', NULL, 'numéro de TVA'),
(4219, 'new_p_method', 'Add New Payment Method', NULL, 'nouvelle méthode p'),
(4220, 'dis_val', 'Dis. Value', NULL, 'dis val'),
(4221, 'vat_val', 'VAT Value', NULL, 'valeur de la TVA'),
(4222, 'ttl_val', 'Total VAT', NULL, 'val ttl'),
(4223, 'purchase_discount', 'Purchase Discount', NULL, 'rabais d\'achat'),
(4224, 'order_time', 'Order Time', NULL, 'temps de commande'),
(4225, 'order_by', 'Order By', NULL, 'commandé par'),
(4226, 'terms_list', 'Sales Terms List', NULL, 'liste des termes'),
(4227, 'terms_add', 'Add Sales Terms', NULL, 'les termes s\'ajoutent'),
(4228, 'term_condi', 'Terms & Condition', NULL, 'conditions de terme'),
(4229, 'terms_update', 'Update Seles Terms', NULL, 'mise à jour des termes'),
(4230, 'add_payment_method', 'Add Payment Method', NULL, 'ajouter un moyen de paiement'),
(4231, 'payment_method_list', 'Payment Method List', NULL, 'liste des moyens de paiement'),
(4232, 'payment_method_name', 'Payment Method Name', NULL, 'nom du moyen de paiement'),
(4233, 'batch_no', 'Batch No', NULL, 'n ° de lot'),
(4234, 'total_with_vat', 'Total With VAT', NULL, 'total avec TVA'),
(4235, 'invoice_time', 'Invoice Time', NULL, 'temps de facturation'),
(4236, 'product_vat', 'Product VAT', NULL, 'cuve produit'),
(4237, 'service_vat', 'Service VAT', NULL, 'cuve de service'),
(4238, 'cr_no', 'CR NO', NULL, 'cr non'),
(4239, 'service_payment', 'Service Payment', NULL, 'paiement des services'),
(4240, 'vat_tax_setting', 'VAT & TAX Setting', NULL, 'fixation de la TVA'),
(4241, 'qty', 'Qty', NULL, 'quantité'),
(4242, 'batch', 'Batch', NULL, 'lot'),
(4243, 'disc', 'Disc', NULL, 'disque'),
(4244, 'tot_price', 'Tot Price', NULL, 'prix total'),
(4245, 'tot_before_dis', 'Total Before Discount', NULL, 'tot avant dis'),
(4246, 'tot_with_dis', 'Total with Discount', NULL, 'tot avec dis'),
(4247, 'tax_vat', 'TAX Value', NULL, 'TVA fiscale'),
(4248, 'return_receipt_text', 'Please keep the receipt and bring it in case of return', NULL, 'texte du reçu de retour'),
(4249, 'invoice_qr_code', 'Invoice Qr-Code', NULL, 'facture qr code'),
(4250, 'sales_due', 'Today Sales Due', NULL, 'ventes dues');
INSERT INTO `language` (`id`, `phrase`, `english`, `arabic`, `franais`) VALUES
(4251, 'purchase_due', 'Today Purchase Due', NULL, 'achat dû'),
(4252, 'employee_profile', 'Employee Profile', NULL, 'profil de l\'employé'),
(4253, 'hrm', 'Human Resource', NULL, 'hrm'),
(4254, 'address_line_1', 'Address Line 1', NULL, 'Adresse 1'),
(4255, 'address_line_2', 'Address Line 2', NULL, 'Adresse Ligne 2'),
(4256, 'installment', 'Installment', 'الأقساط', 'Versement'),
(4257, 'choose_installment_if_invoice_not_full_paid', 'Choose installment if invoice not full paid', NULL, 'choisir l\'acompte si la facture n\'est pas entièrement payée'),
(4258, 'number_of_month', 'Number Of Month', NULL, 'nombre de mois'),
(4259, 'payment_day', 'Payment Day', NULL, 'jour de paiement'),
(4260, 'tax_invoice', 'Tax Invoice', NULL, 'facture fiscale'),
(4261, 'assembly', 'Assembly', 'تجميع', 'Assemblée'),
(4262, '6', '6', '6', '6'),
(4263, 'returned', 'Returned', 'مرتجع', 'revenu'),
(4264, 'total_dis', 'Purchase Discount', 'خصم', 'dis total'),
(4265, 'please_select_currency', 'Please Select Currency', 'برجاء اختيار العملة', 'veuillez sélectionner la devise'),
(4266, 'due_date', 'Due Date', NULL, 'date d\'échéance'),
(4267, 'manage_installment', 'Manage Installment', 'إدارة الأقساط', 'gérer le versement'),
(4268, 'manage_your_installment', 'Manage Your Installment', NULL, 'gérer votre versement'),
(4269, 'edit_installment', 'Edit Installment', NULL, 'modifier le versement'),
(4270, 'paid_amountt', 'Paid Amount', NULL, 'montant payé'),
(4271, 'payment_date', 'Payment Date', NULL, 'date de paiement'),
(4272, 'pending', 'Pending', NULL, 'en attendant'),
(4273, 'collected', 'Collected', NULL, 'collecté'),
(4274, 'cash', 'Cash', NULL, 'en espèces'),
(4275, 'wire transfer', 'Wire Transfer', NULL, 'virement bancaire'),
(4276, 'pos', 'POS', NULL, 'position'),
(4277, 'check', 'Check', NULL, 'Chèque'),
(4278, 'check_no', 'Check Number', NULL, 'vérifier non'),
(4279, 'expiry_date', 'Expiry Date', NULL, 'date d\'expiration'),
(4280, 'enter_check_number_if_payment_type_is_check_or_wire_transfer', 'Enter check number if payment type is check or wire transfer', NULL, 'entrez le numéro de chèque si le type de paiement est un chèque ou un virement bancaire'),
(4281, 'you_must_complete_the_information', 'You must complete the information', NULL, 'vous devez compléter les informations');

-- --------------------------------------------------------

--
-- Table structure for table `language_backup`
--

CREATE TABLE `language_backup` (
  `id` int(11) NOT NULL,
  `phrase` text NOT NULL,
  `english` text,
  `arabic` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language_backup`
--

INSERT INTO `language_backup` (`id`, `phrase`, `english`, `arabic`) VALUES
(1, 'user_profile', 'User Profile', 'شكرا للتسوق معنا'),
(2, 'setting', 'Setting', NULL),
(3, 'language', 'Language', NULL),
(4, 'manage_users', 'Manage Users', NULL),
(5, 'add_user', 'Add User', NULL),
(6, 'manage_company', 'Manage Company', NULL),
(7, 'web_settings', 'Web Settings', NULL),
(8, 'manage_accounts', 'Manage Accounts', NULL),
(9, 'create_accounts', 'Create Accounts', NULL),
(10, 'manage_bank', 'Manage Bank', NULL),
(11, 'add_new_bank', 'Add New Bank', 'إضافة بنك جديد'),
(12, 'settings', 'Settings', NULL),
(13, 'closing_report', 'Closing Report', NULL),
(14, 'closing', 'Closing', NULL),
(15, 'cheque_manager', 'Cheque Manager', NULL),
(16, 'accounts_summary', 'Accounts Summary', 'ملخص الحسابات'),
(17, 'payment', 'Payment', NULL),
(18, 'received', 'Received', NULL),
(19, 'accounts', 'Accounts', 'الحسابات'),
(20, 'stock_report', 'Stock Report', NULL),
(21, 'stock', 'Stock', NULL),
(22, 'pos_invoice', 'POS Invoice', NULL),
(23, 'manage_invoice', 'Manage Invoice ', NULL),
(24, 'new_invoice', 'New Invoice', NULL),
(25, 'invoice', 'Invoice', NULL),
(26, 'manage_purchase', 'Manage Purchase', NULL),
(27, 'add_purchase', 'Add Purchase', 'إضافة شراء'),
(28, 'purchase', 'Purchase', NULL),
(29, 'paid_customer', 'Paid Customer', NULL),
(30, 'manage_customer', 'Manage Customer', NULL),
(31, 'add_customer', 'Add Customer', 'اضافة عميل'),
(32, 'customer', 'Customer', NULL),
(33, 'supplier_ledger', 'Supplier Ledger', 'كشف حساب المورد '),
(34, 'manage_supplier', 'Manage Supplier', NULL),
(35, 'add_supplier', 'Add Supplier', NULL),
(36, 'supplier', 'Supplier', NULL),
(37, 'manage_product', 'Manage Product', NULL),
(38, 'add_product', 'Add Product', 'أضف منتج'),
(39, 'product', 'Product', NULL),
(40, 'manage_category', 'Manage Category', NULL),
(41, 'add_category', 'Add Category', 'اضافة قسم'),
(42, 'category', 'Category', 'الفئة'),
(43, 'sales_report_product_wise', 'Sales Report (Product Wise)', NULL),
(44, 'purchase_report', 'Purchase Report', NULL),
(45, 'sales_report', 'Sales Report', NULL),
(46, 'todays_report', 'Todays Report', NULL),
(47, 'report', 'Report', 'تقرير'),
(48, 'dashboard', 'Dashboard', NULL),
(49, 'online', 'Online', NULL),
(50, 'logout', 'Logout', NULL),
(51, 'change_password', 'Change Password', NULL),
(52, 'total_purchase', 'Total Purchase', NULL),
(53, 'total_amount', 'Total Amount', NULL),
(54, 'supplier_name', 'Supplier Name', 'إسم المورد'),
(55, 'invoice_no', 'Invoice No', NULL),
(56, 'purchase_date', 'Purchase Date', NULL),
(57, 'todays_purchase_report', 'Todays Purchase Report', NULL),
(58, 'total_sales', 'Total Sales', NULL),
(59, 'customer_name', 'Customer Name', NULL),
(60, 'sales_date', 'Sales Date', NULL),
(61, 'todays_sales_report', 'Todays Sales Report', NULL),
(62, 'home', 'Home', NULL),
(63, 'todays_sales_and_purchase_report', 'Todays sales and purchase report', NULL),
(64, 'total_ammount', 'Total Amount', NULL),
(65, 'rate', 'Rate', NULL),
(66, 'product_model', 'Product Model', NULL),
(67, 'search', 'Search', NULL),
(68, 'end_date', 'End Date', 'تاريخ الانتهاء'),
(69, 'start_date', 'Start Date', NULL),
(70, 'total_purchase_report', 'Total Purchase Report', NULL),
(71, 'total_sales_report', 'Total Sales Report', NULL),
(72, 'total_seles', 'Total Sales', NULL),
(73, 'all_stock_report', 'All Stock Report', NULL),
(74, 'search_by_product', 'Search By Product', NULL),
(75, 'date', 'Date', 'تاريخ'),
(76, 'print', 'Print', NULL),
(77, 'stock_date', 'Stock Date', NULL),
(78, 'print_date', 'Print Date', NULL),
(79, 'sales', 'Sales', NULL),
(80, 'price', 'Price', NULL),
(81, 'sl', 'SL.', NULL),
(82, 'add_new_category', 'Add new category', 'إضافة فئة جديدة'),
(83, 'category_name', 'Category Name', 'اسم التصنيف'),
(84, 'save', 'Save', NULL),
(85, 'delete', 'Delete', NULL),
(86, 'update', 'Update', NULL),
(87, 'action', 'Action', 'اجراء'),
(88, 'manage_your_category', 'Manage your category ', NULL),
(89, 'category_edit', 'Category Edit', 'تعديل الفئة'),
(90, 'status', 'Status', NULL),
(91, 'active', 'Active', 'فعال'),
(92, 'inactive', 'Inactive', NULL),
(93, 'save_changes', 'Save Changes', NULL),
(94, 'save_and_add_another', 'Save And Add Another', NULL),
(95, 'model', 'Model', NULL),
(96, 'supplier_price', 'Supplier Price', 'إسعار المورد'),
(97, 'sell_price', 'Sell Price', NULL),
(98, 'image', 'Image', NULL),
(99, 'select_one', 'Select One', NULL),
(100, 'details', 'Details', NULL),
(101, 'new_product', 'New Product', NULL),
(102, 'add_new_product', 'Add new product', 'إضافة منتج جديد'),
(103, 'barcode', 'Barcode', 'باركود'),
(104, 'qr_code', 'Qr-Code', NULL),
(105, 'product_details', 'Product Details', NULL),
(106, 'manage_your_product', 'Manage your product', NULL),
(107, 'product_edit', 'Product Edit', NULL),
(108, 'edit_your_product', 'Edit your product', 'تعديل المنتجات '),
(109, 'cancel', 'Cancel', 'إلغاء'),
(110, 'excl_vat', 'Excl. Vat', 'غير شامل ضريبة'),
(111, 'money', 'TK', NULL),
(112, 'grand_total', 'Grand Total', NULL),
(113, 'quantity', 'Qnty', NULL),
(114, 'product_report', 'Product Report', NULL),
(115, 'product_sales_and_purchase_report', 'Product sales and purchase report', NULL),
(116, 'previous_stock', 'Previous Stock', NULL),
(117, 'out', 'Out', NULL),
(118, 'in', 'In', NULL),
(119, 'to', 'To', NULL),
(120, 'previous_balance', 'Previous Balance', NULL),
(121, 'customer_address', 'Customer Address', NULL),
(122, 'customer_mobile', 'Customer Mobile', NULL),
(123, 'customer_email', 'Customer Email', NULL),
(124, 'add_new_customer', 'Add new customer', 'إضافة عميل جديد'),
(125, 'balance', 'Balance', 'الرصيد'),
(126, 'mobile', 'Mobile', NULL),
(127, 'address', 'Address', 'العنوان'),
(128, 'manage_your_customer', 'Manage your customer', NULL),
(129, 'customer_edit', 'Customer Edit', NULL),
(130, 'paid_customer_list', 'Manage your paid customer', NULL),
(131, 'ammount', 'Amount', ''),
(132, 'customer_ledger', 'Customer Ledger', NULL),
(133, 'manage_customer_ledger', 'Manage Customer Ledger', NULL),
(134, 'customer_information', 'Customer Information', NULL),
(135, 'debit_ammount', 'Debit Amount', 'المبلغ المدين'),
(136, 'credit_ammount', 'Credit Amount', NULL),
(137, 'balance_ammount', 'Balance Amount', 'قيمة الرصيد'),
(138, 'receipt_no', 'Receipt NO', NULL),
(139, 'description', 'Description', NULL),
(140, 'debit', 'Debit', 'مدين'),
(141, 'credit', 'Credit', 'دائن'),
(142, 'item_information', 'Item Information', NULL),
(143, 'total', 'Total', NULL),
(144, 'please_select_supplier', 'Please Select Supplier', NULL),
(145, 'submit', 'Submit', NULL),
(146, 'submit_and_add_another', 'Submit And Add Another One', NULL),
(147, 'add_new_item', 'Add New Item', 'أضف عنصر جديدة'),
(148, 'manage_your_purchase', 'Manage your purchase', NULL),
(149, 'purchase_edit', 'Purchase Edit', NULL),
(150, 'purchase_ledger', 'Purchase Ledger', NULL),
(151, 'invoice_information', 'Invoice Information', NULL),
(152, 'paid_ammount', 'Paid', NULL),
(153, 'discount', 'Dis/ Pcs', NULL),
(154, 'save_and_paid', 'Save And Paid', NULL),
(155, 'payee_name', 'Payee Name', NULL),
(156, 'manage_your_invoice', 'Manage your invoice', NULL),
(157, 'invoice_edit', 'Invoice Edit', NULL),
(158, 'new_pos_invoice', 'New POS invoice', NULL),
(159, 'add_new_pos_invoice', 'Add new pos invoice', 'إضافة فاتورة جديدة لنقاط البيع'),
(160, 'product_id', 'Product ID', NULL),
(161, 'paid_amount', 'Paid', NULL),
(162, 'authorised_by', 'Authorised By', 'مرخص بها من'),
(163, 'checked_by', 'Checked By', NULL),
(164, 'received_by', 'Received By', NULL),
(165, 'prepared_by', 'Prepared By', NULL),
(166, 'memo_no', 'Memo No', NULL),
(167, 'website', 'Website', NULL),
(168, 'email', 'Email', 'البريد الإلكتروني'),
(169, 'invoice_details', 'Invoice Details', NULL),
(170, 'reset', 'Reset', 'إعادة تعيين'),
(171, 'payment_account', 'Payment Account', NULL),
(172, 'bank_name', 'Bank Name', 'إسم البنك '),
(173, 'cheque_or_pay_order_no', 'Cheque/Pay Order No', NULL),
(174, 'payment_type', 'Payment Type', NULL),
(175, 'payment_from', 'Payment From', NULL),
(176, 'payment_date', 'Payment Date', NULL),
(177, 'add_received', 'Add Received', NULL),
(178, 'cash', 'Cash', 'نقد'),
(179, 'cheque', 'Cheque', NULL),
(180, 'pay_order', 'Pay Order', NULL),
(181, 'payment_to', 'Payment To', NULL),
(182, 'total_payment_ammount', 'Total Payment Report ', NULL),
(183, 'transections', 'Transections', NULL),
(184, 'accounts_name', 'Accounts Name', 'اسم الحسابات'),
(185, 'payment_report', 'Payment Report', NULL),
(186, 'received_report', 'Income Report', NULL),
(187, 'all', 'All', NULL),
(188, 'account', 'Account', 'الحساب'),
(189, 'from', 'From', 'من'),
(190, 'account_summary_report', 'Account Summary Report', 'تقرير ملخص الحساب'),
(191, 'search_by_date', 'Search By Date', NULL),
(192, 'cheque_no', 'Cheque No', NULL),
(193, 'name', 'Name', NULL),
(194, 'closing_account', 'Closing Account', NULL),
(195, 'close_your_account', 'Close your account', NULL),
(196, 'last_day_closing', 'Last Day Closing', NULL),
(197, 'cash_in', 'Cash In', ''),
(198, 'cash_out', 'Cash Out', NULL),
(199, 'cash_in_hand', 'Cash In Hand', ''),
(200, 'add_new_bank', 'Add New Bank', 'إضافة بنك جديد'),
(201, 'day_closing', 'Day Closing', 'إغلاق اليوم'),
(202, 'account_closing_report', 'Account Closing Report', 'تقارير حسابات الاغلاق'),
(203, 'last_day_ammount', 'Last Day Amount', NULL),
(204, 'adjustment', 'Adjustment', NULL),
(205, 'pay_type', 'Pay Type', NULL),
(206, 'customer_or_supplier', 'Customer , Supplier Or Others', NULL),
(207, 'transection_id', 'Transections ID', NULL),
(208, 'accounts_summary_report', 'Accounts Summary Report', 'تقرير ملخص الحسابات'),
(209, 'bank_list', 'Bank List', 'قائمة البنك'),
(210, 'bank_edit', 'Bank Edit', 'تعديل البنك '),
(211, 'debit_plus', 'Debit (+)', 'زائد الخصم'),
(212, 'credit_minus', 'Credit (-)', NULL),
(213, 'account_name', 'Account Name', 'اسم الحساب'),
(214, 'account_type', 'Account Type', 'نوع الحساب'),
(215, 'account_real_name', 'Account Real Name', 'اسم الحساب الحقيقي'),
(216, 'manage_account', 'Manage Account', NULL),
(217, 'company_name', 'Company Name', NULL),
(218, 'edit_your_company_information', 'Edit your company information', 'تعديل معلومات شركتك'),
(219, 'company_edit', 'Company Edit', NULL),
(220, 'admin', 'Admin', NULL),
(221, 'user', 'User', NULL),
(222, 'password', 'Password', NULL),
(223, 'last_name', 'Last Name', NULL),
(224, 'first_name', 'First Name', 'الاسم الاول'),
(225, 'add_new_user_information', 'Add new user information', 'اضافة معلومات مستخدم جديد'),
(226, 'user_type', 'User Type', NULL),
(227, 'user_edit', 'User Edit', NULL),
(228, 'rtr', 'Right To Left -RTL', NULL),
(229, 'ltr', 'Left To Right -LTR', NULL),
(230, 'ltr_or_rtr', 'LTR/RTL', NULL),
(231, 'footer_text', 'Footer Text', 'نص التذييل'),
(232, 'favicon', 'Favicon', 'الأيقونة المفضلة'),
(233, 'logo', 'Logo', NULL),
(234, 'update_setting', 'Update Setting', NULL),
(235, 'update_your_web_setting', 'Update your web setting', NULL),
(236, 'login', 'Login', NULL),
(237, 'your_strong_password', 'Your strong password', 'كلمة مرورك قوية'),
(238, 'your_unique_email', 'Your unique email', 'البريد الإلكتروني الخاص بك'),
(239, 'please_enter_your_login_information', 'Please enter your login information.', NULL),
(240, 'update_profile', 'Update Profile', NULL),
(241, 'your_profile', 'Your Profile', 'ملفك الشخصي'),
(242, 're_type_password', 'Re-Type Password', NULL),
(243, 'new_password', 'New Password', NULL),
(244, 'old_password', 'Old Password', NULL),
(245, 'new_information', 'New Information', NULL),
(246, 'old_information', 'Old Information', NULL),
(247, 'change_your_information', 'Change your information', NULL),
(248, 'change_your_profile', 'Change your profile', NULL),
(249, 'profile', 'Profile', NULL),
(250, 'wrong_username_or_password', 'Wrong User Name Or Password !', NULL),
(251, 'successfully_updated', 'Successfully Updated.', 'تم التحديث بنجاح'),
(252, 'blank_field_does_not_accept', 'Blank Field Does Not Accept !', NULL),
(253, 'successfully_changed_password', 'Successfully changed password.', NULL),
(254, 'you_are_not_authorised_person', 'You are not authorised person !', 'أنت لست شخصًا مخولًا'),
(255, 'password_and_repassword_does_not_match', 'Passwor and re-password does not match !', NULL),
(256, 'new_password_at_least_six_character', 'New Password At Least 6 Character.', NULL),
(257, 'you_put_wrong_email_address', 'You put wrong email address !', 'قمت بوضع عنوان بريد إلكتروني خاطئ'),
(258, 'cheque_ammount_asjusted', 'Cheque amount adjusted. ', NULL),
(259, 'successfully_payment_paid', 'Successfully Payment Paid.', NULL),
(260, 'successfully_added', 'Successfully Added.', NULL),
(261, 'successfully_updated_2_closing_ammount_not_changeale', 'Successfully Updated -2. Note: Closing Amount Not Changeable.', NULL),
(262, 'successfully_payment_received', 'Successfully Payment Received.', NULL),
(263, 'already_inserted', 'Already Inserted !', NULL),
(264, 'successfully_delete', 'Successfully Delete.', NULL),
(265, 'successfully_created', 'Successfully Created.', NULL),
(266, 'logo_not_uploaded', 'Logo not uploaded !', NULL),
(267, 'favicon_not_uploaded', 'Favicon not uploaded !', 'لم يتم تحميل الرمز المفضل'),
(268, 'supplier_mobile', 'Supplier Mobile', 'رقم جوال المورد'),
(269, 'supplier_address', 'Supplier Address', 'عنوان المورد'),
(270, 'supplier_details', 'Supplier Details', 'تفاصيل المورد'),
(271, 'add_new_supplier', 'Add New Supplier', 'إضافة مورد جديد'),
(272, 'manage_suppiler', 'Manage Supplier', NULL),
(273, 'manage_your_supplier', 'Manage your supplier', NULL),
(274, 'manage_supplier_ledger', 'Manage supplier ledger', NULL),
(275, 'invoice_id', 'Invoice ID', NULL),
(276, 'deposit_id', 'Deposite ID', NULL),
(277, 'supplier_actual_ledger', 'Supplier Actual Ledger', NULL),
(278, 'supplier_information', 'Supplier Information', 'معلومات المورد'),
(279, 'event', 'Event', 'حدث'),
(280, 'add_new_received', 'Add New Income', 'اضافة استلام مخزون جديد'),
(281, 'add_payment', 'Add Payment', 'إضافة الدفع'),
(282, 'add_new_payment', 'Add New Payment', 'إضافة دفعة جديدة'),
(283, 'total_received_ammount', 'Total Received Amount', NULL),
(284, 'create_new_invoice', 'Create New Invoice', 'إنشاء فاتورة جديدة'),
(285, 'create_pos_invoice', 'Create POS Invoice', 'إنشاء فاتورة نقاط البيع'),
(286, 'total_profit', 'Total Profit', NULL),
(287, 'monthly_progress_report', 'Monthly Progress Report', NULL),
(288, 'total_invoice', 'Total Invoice', NULL),
(289, 'account_summary', 'Account Summary', 'ملخص الحساب'),
(290, 'total_supplier', 'Total Supplier', NULL),
(291, 'total_product', 'Total Product', NULL),
(292, 'total_customer', 'Total Customer', NULL),
(293, 'supplier_edit', 'Supplier Edit', 'تعديل المورد'),
(294, 'add_new_invoice', 'Add New Invoice', 'إضافة فاتورة جديدة'),
(295, 'add_new_purchase', 'Add new purchase', 'إضافة شراء جديد'),
(296, 'currency', 'Currency', NULL),
(297, 'currency_position', 'Currency Position', NULL),
(298, 'left', 'Left', NULL),
(299, 'right', 'Right', NULL),
(300, 'add_tax', 'Add Tax', NULL),
(301, 'manage_tax', 'Manage Tax', NULL),
(302, 'add_new_tax', 'Add new tax', 'أضف ضريبة جديدة'),
(303, 'enter_tax', 'Enter Tax', 'أدخل الضريبة'),
(304, 'already_exists', 'Already Exists !', NULL),
(305, 'successfully_inserted', 'Successfully Inserted.', NULL),
(306, 'tax', 'Tax', 'ضريبة'),
(307, 'tax_edit', 'Tax Edit', 'تعديل الضريبة '),
(308, 'product_not_added', 'Product not added !', NULL),
(309, 'total_tax', 'Total Tax', NULL),
(310, 'manage_your_supplier_details', 'Manage your supplier details.', NULL),
(311, 'invoice_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s                                       standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL),
(312, 'thank_you_for_choosing_us', 'Thank you very much for choosing us.', NULL),
(313, 'billing_date', 'Billing Date', 'تاريخ الفاتورة '),
(314, 'billing_to', 'Billing To', 'فاتورة إلي'),
(315, 'billing_from', 'Billing From', 'فاتورة من  '),
(316, 'you_cant_delete_this_product', 'Sorry !!  You can\'t delete this product.This product already used in calculation system!', 'لا يمكنك حذف هذا المنتج'),
(317, 'old_customer', 'Old Customer', NULL),
(318, 'new_customer', 'New Customer', NULL),
(319, 'new_supplier', 'New Supplier', NULL),
(320, 'old_supplier', 'Old Supplier', NULL),
(321, 'credit_customer', 'Credit Customer', 'عميل الائتمان'),
(322, 'account_already_exists', 'This Account Already Exists !', 'الحساب موجود'),
(323, 'edit_received', 'Edit Received', 'تم استلام التعديل'),
(324, 'you_are_not_access_this_part', 'You can not access this part !', 'لا يمكنك الوصول إلى هذا الجزء'),
(325, 'account_edit', 'Account Edit', 'تحرير الحساب'),
(326, 'due', 'Due', 'مستحق'),
(327, 'payment_edit', 'Payment Edit', NULL),
(328, 'please_select_customer', 'Please select customer !', NULL),
(329, 'profit_report', 'Profit Report (Invoice Wise)', NULL),
(330, 'total_profit_report', 'Total profit report', NULL),
(331, 'please_enter_valid_captcha', 'Please enter valid captcha.', NULL),
(332, 'category_not_selected', 'Category not selected.', 'الفئة غير محددة'),
(333, 'supplier_not_selected', 'Supplier not selected.', 'المورد غير محدد'),
(334, 'please_select_product', 'Please select product.', NULL),
(335, 'product_model_already_exist', 'Product model already exist or file format is not correct !', NULL),
(336, 'invoice_logo', 'Invoice Logo', NULL),
(337, 'available_quantity', 'Ava. Qnty', 'الكمية المتوفرة'),
(338, 'customer_details', 'Customer details', NULL),
(339, 'manage_customer_details', 'Manage customer details.', NULL),
(340, 'site_key', 'Captcha Site Key', 'مفتاح الموقع'),
(341, 'secret_key', 'Secret Key', NULL),
(342, 'captcha', 'Captcha', 'كلمة التحقق'),
(343, 'manage_your_credit_customer', 'Manage your credit  customer', NULL),
(344, 'barcode_qrcode', 'Barcode/Qrcode', 'الباركود  - QR'),
(345, 'barcode_qrcode_scan_here', 'Barcode OR QR code scan here ', 'هنا   QR +  نسخ الباركود'),
(346, 'please_add_walking_customer_for_default_customer', 'You are delete walking customer.Please add walking customer for default customer.', NULL),
(347, 'stock_report_supplier_wise', 'Stock Report (Supplier Wise)', NULL),
(348, 'stock_report_product_wise', 'Stock Report (Product Wise)', NULL),
(349, 'in_ctn', 'In Ctn.', NULL),
(350, 'out_ctn', 'Out Ctn.', NULL),
(351, 'select_supplier', 'Select Supplier', NULL),
(352, 'in_quantity', 'In Qnty', NULL),
(353, 'out_quantity', 'Out Qnty', NULL),
(354, 'in_taka', 'In Taka', NULL),
(355, 'out_taka', 'Out Taka', NULL),
(356, 'select_product', 'Select Product', NULL),
(357, 'data_synchronizer', 'Data Synchronizer', NULL),
(358, 'synchronize', 'Synchronizer', 'تزامن'),
(359, 'backup_restore', 'Backup Restore', 'استعادة النسخة الاحتياطية'),
(360, 'synchronizer_setting', 'Synchronizer Setting', 'مزامنه الاعدادات '),
(361, 'hostname', 'Hostname', NULL),
(362, 'user_name', 'User Name', NULL),
(363, 'ftp_port', 'FTP Port', NULL),
(364, 'ftp_debug', 'FTP Debug', NULL),
(365, 'project_root', 'Project Root', NULL),
(366, 'internet_connection', 'Internet connection', NULL),
(367, 'outgoing_file', 'Outgoing file', NULL),
(368, 'incoming_file', 'Incoming file', NULL),
(369, 'available', 'Available', 'متوفرة'),
(370, 'not_available', 'Not Available', NULL),
(371, 'data_upload_to_server', 'Data upload to server', 'تحميل البيانات إلى الخادم'),
(372, 'download_data_from_server', 'Download data from server', NULL),
(373, 'data_import_to_database', 'Data import to database', NULL),
(374, 'please_wait', 'Please wait', NULL),
(375, 'ooops_something_went_wrong', 'Ooops something went wrong.', NULL),
(376, 'ftp_setting', 'FTP setting', NULL),
(377, 'please_try_again', 'Please try again', NULL),
(378, 'save_successfully', 'Save successfully', NULL),
(379, 'upload_successfully', 'Upload successfully', NULL),
(380, 'unable_to_upload_file_please_check_configuration', 'Unable to upload file.Please check configuration.', NULL),
(381, 'please_configure_synchronizer_settings', 'Please configure synchronizer settings', NULL),
(382, 'download_successfully', 'Download successfully', 'تم التنزيل بنجاح'),
(383, 'unable_to_download_file_please_check_configuration', 'Unable to download file.Please check configuration.', NULL),
(384, 'data_import_first', 'Data import first.', NULL),
(385, 'data_import_successfully', 'Data import successfully', NULL),
(386, 'unable_to_import_data_please_check_config_or_sql_file', 'Unable to import data.Please check config or sql file.', NULL),
(387, 'database_backup', 'Database backup', NULL),
(388, 'file_information', 'File information', 'معلومات الملف'),
(389, 'filename', 'Filename', 'اسم الملف'),
(390, 'size', 'Size', NULL),
(391, 'backup_date', 'Backup date', 'تاريخ النسخ الاحتياطي'),
(392, 'backup_now', 'Backup now', ' نسخة احتياطية الان'),
(393, 'restore_now', 'Restore now', 'استعادة الآن'),
(394, 'are_you_sure', 'Are you sure ?', 'هل أنت متأكد'),
(395, 'download', 'Download', NULL),
(396, 'backup_successfully', 'Backup successfully', 'تم النسخ الاحتياطي بنجاح'),
(397, 'restore_successfully', 'Restore successfully', 'استعادة بنجاح'),
(398, 'delete_successfully', 'Delete successfully', NULL),
(399, 'backup_and_restore', 'Backup and Restore', 'النسخ الاحتياطي والاستعادة'),
(400, 'close', 'Close', NULL),
(401, 'import_product_csv', 'Import Product (CSV)', NULL),
(402, 'upload_csv_file', 'Upload CSV File', NULL),
(403, 'supplier_id', 'Supplier ID', 'معرف المورد '),
(404, 'category_id', 'Category ID', 'معرف الفئة'),
(405, 'file_data_format_is_not_correct', 'File format or data is not correct ! Please flollow the instruction.', 'تنسيق بيانات الملف غير صحيح'),
(406, 'add_unit', 'Add Unit', NULL),
(407, 'manage_unit', 'Manage Unit', NULL),
(408, 'unit', 'Unit', NULL),
(409, 'meter_m', 'Meter (M)', NULL),
(410, 'piece_pc', 'Piece (Pc)', NULL),
(411, 'kilogram_kg', 'Kilogram (Kg)', NULL),
(412, 'select_unit', 'Select Unit', NULL),
(413, 'no_tax', 'No Tax', NULL),
(414, 'suppler_email', 'Supplier Email', NULL),
(415, 'csv_file_informaion', 'CSV File Information', NULL),
(416, 'stock_quantity', 'Stock', NULL),
(417, 'out_of_stock', 'Out Of Stock', NULL),
(418, 'phone', 'Phone', NULL),
(419, 'you_can_not_buy_greater_than_available_cartoon', 'You can not sell greater than available quantity.', 'لا يمكنك شراء أكثر من الكمية المتاحه '),
(420, 'total_discount', 'Total Discount', NULL),
(421, 'if_you_update_purchase_first_select_supplier_then_product_and_then_quantity', 'If you update purchase.First select supplier then product and quantity.', NULL),
(422, 'others', 'Others', NULL),
(423, 'accounts_details_data', 'Accounts Details Data', 'معلومات تفاصيل الحسابات'),
(424, 'add_brand', 'Add Brand', 'اضافة علامة تجارية'),
(425, 'add_new_brand', 'Add new brand', 'إضافة علامة تجارية جديدة'),
(426, 'brand', 'Brand', 'علامة تجارية'),
(427, 'brand_image', 'Brand Image', 'صورة العلامة التجارية'),
(428, 'brand_name', 'Brand Name', 'اسم العلامة التجارية'),
(429, 'manage_brand', 'Manage Brand', NULL),
(430, 'brand_edit', 'Brand Edit', 'وضع العلامة التجارية'),
(431, 'manage_your_brand', 'Manage your brand', NULL),
(432, 'are_you_sure_want_to_delete', 'Are you sure want to delete ?', 'هل أنت متأكد من أنك تريد أن تحذف'),
(433, 'variant', 'Variant', NULL),
(434, 'add_variant', 'Add Variant', NULL),
(435, 'manage_variant', 'Manage Variant', NULL),
(436, 'add_new_variant', 'Add New Variant', 'اضافة تصنيف جديد'),
(437, 'variant_name', 'Variant Name', NULL),
(438, 'variant_edit', 'Variant Edit', NULL),
(439, 'type', 'Type', NULL),
(440, 'image_large', 'Image Large', NULL),
(441, 'onsale', 'Offer', NULL),
(442, 'yes', 'Yes', 'نعم '),
(443, 'no', 'No', NULL),
(444, 'featured', 'Featured', 'متميز'),
(445, 'store_set', 'Store Set', NULL),
(446, 'store_add', 'Store Add', NULL),
(447, 'store_product', 'Store Product', NULL),
(448, 'manage_store', 'Manage Store', NULL),
(449, 'add_store', 'Add Store', NULL),
(450, 'add_new_store', 'Add New Store', 'إضافة متجر جديد'),
(451, 'store_name', 'Store Name', NULL),
(452, 'store_address', 'Store Address', NULL),
(453, 'manage_your_store', 'Manage your store', NULL),
(454, 'store_edit', 'Store Edit', NULL),
(455, 'store_product_transfer', 'Store Product Transfer', NULL),
(456, 'manage_store_product', 'Manage Store Product', NULL),
(457, 'manage_your_store_product', 'Manage your store product', NULL),
(458, 'store_product_edit', 'Store Product Edit', NULL),
(459, 'wearhouse_add', 'Warehouse Add', NULL),
(460, 'wearhouse_transfer', 'Warehouse Transfer', NULL),
(461, 'manage_wearhouse', 'Manage Warehouse', NULL),
(462, 'wearhouse_set', 'Warehouse Set', NULL),
(463, 'add_wearhouse', 'Add Warehouse', NULL),
(464, 'add_new_wearhouse', 'Add New Warehouse', 'اضافة مخزن جديد'),
(465, 'wearhouse_name', 'Warehouse Name', NULL),
(466, 'wearhouse_address', 'Warehouse Address', NULL),
(467, 'manage_your_wearhouse', 'Manage your warehouse', NULL),
(468, 'wearhouse_edit', 'Warehouse Edit', NULL),
(469, 'transfer_wearhouse_product', 'Transfer warehouse product', NULL),
(470, 'transfer_to', 'Transfer To', NULL),
(471, 'wearhouse', 'Warehouse', NULL),
(472, 'store', 'Store', NULL),
(473, 'purchase_to', 'Purchase To', NULL),
(474, 'product_and_supplier_did_not_match', 'Product and supplier did not match.', NULL),
(475, 'please_select_wearhouse', 'Please select warehouse !', NULL),
(476, 'product_is_not_available_please_purchase_product', 'Product not available.Please purchase product.', NULL),
(477, 'please_select_store', 'Please select store', NULL),
(478, 'store_transfer', 'Store Transfer', NULL),
(479, 'add_new_unit', 'Add new unit', 'أضف وحدة جديدة'),
(480, 'unit_name', 'Unit Name', NULL),
(481, 'unit_short_name', 'Unit Short Name', NULL),
(482, 'manage_your_unit', 'Manage your unit', NULL),
(483, 'unit_edit', 'Unit Edit', NULL),
(484, 'gallery', 'Gallery', NULL),
(485, 'add_image', 'Add Image', 'اضافة صورة'),
(486, 'manage_image', 'Manage Image', NULL),
(487, 'add_new_image', 'Add new image', 'إضافة صورة جديدة'),
(488, 'manage_gallery_image', 'Manage gallery image', NULL),
(489, 'image_edit', 'Image Edit', NULL),
(490, 'tax_name', 'Tax Name', 'إسم الضريبة '),
(491, 'manage_your_tax', 'Manage your tax', NULL),
(492, 'tax_product_service', 'Tax Product Service', 'ضريبة المنتجات والخدمات '),
(493, 'add_tax_product_service', 'Add tax product service', NULL),
(494, 'tax_percentage', 'Tax Percentage', 'نسبة الضريبة'),
(495, 'total_cgst', 'CGST', NULL),
(496, 'total_sgst', 'SGST', NULL),
(497, 'total_igst', 'IGST', NULL),
(498, 'cat_image', 'Category Image', NULL),
(499, 'parent_category', 'Parent category', NULL),
(500, 'top_menu', 'Top Menu', NULL),
(501, 'menu_position', 'Menu Position', NULL),
(502, 'add_pos_invoice', 'Add POS Invoice', 'إضافة فاتورة نقاط البيع'),
(503, 'customer_address_1', 'Address 1', NULL),
(504, 'customer_address_2', 'Address 2', NULL),
(505, 'city', 'City', NULL),
(506, 'state', 'State', NULL),
(507, 'country', 'Country', 'بلد'),
(508, 'zip', 'Zip', 'zip'),
(509, 'transection_type', 'Transection Type', NULL),
(510, 'product_ledger', 'Product Ledger', NULL),
(511, 'transfer_report', 'Transfer Report', NULL),
(512, 'store_to_store_transfer', 'Store To Store Transfer', NULL),
(513, 'to_store', 'To Store', NULL),
(514, 'store_to_warehouse_transfer', 'Store To Warehouse Transfer', NULL),
(515, 'warehouse_to_store_transfer', 'Warehouse To Store Transfer', NULL),
(516, 't_wearhouse', 'To Wearhouse', NULL),
(517, 'warehouse_to_warehouse_transfer', 'Warehouse To Warehouse Transfer', NULL),
(518, 'shop_manager', 'Shop Manager', NULL),
(519, 'sales_man', 'Sales Man', NULL),
(520, 'store_keeper', 'Store Keeper', NULL),
(521, 'item', 'Item', NULL),
(522, 'qnty', 'Qnty', NULL),
(523, 'first', 'First', 'أول'),
(524, 'last', 'Last', NULL),
(525, 'next', 'Next', NULL),
(526, 'prev', 'Previous', NULL),
(527, '1', '1', '1'),
(528, '2', '2', '2'),
(529, '3', '3', '3'),
(530, 'web_store', 'Web Store', NULL),
(531, 'brand_id', 'Brand ID', 'معرف العلامة التجارية'),
(532, 'variant_id', 'Variant ID', NULL),
(533, 'items', 'Items', NULL),
(534, 'print_order', 'Print Order', NULL),
(535, 'print_bill', 'Print Bill', NULL),
(536, 'unpaid', 'Unpaid', NULL),
(537, 'paid', 'Paid', NULL),
(538, 'product_discount', 'Product Discount', NULL),
(539, 'invoice_discount', 'Invoice Discount', NULL),
(540, 'terminal', 'Terminal', NULL),
(541, 'manage_terminal', 'Manage Terminal', NULL),
(542, 'add_terminal', 'Add Terminal', NULL),
(543, 'add_new_terminal', 'Add new terminal', 'اضافة نقظة بيع جديدة'),
(544, 'customer_care_phone_no', 'Customer Care Phone No', NULL),
(545, 'terminal_bank_account', 'Terminal Bank Account', NULL),
(546, 'terminal_company', 'Terminal Company', NULL),
(547, 'terminal_name', 'Terminal Name', NULL),
(548, 'manage_your_terminal', 'Manage your terminal', NULL),
(549, 'terminal_edit', 'Terminal Edit', NULL),
(550, 'full_paid', 'Full Paid', NULL),
(551, 'card_no', 'Card NO', 'لا بطاقة'),
(552, 'card_type', 'Card Type', 'نوع البطاقة'),
(553, 'tax_report_product_wise', 'Tax Report (Product Wise)', NULL),
(554, 'tax_report_invoice_wise', 'Tax Report (Invoice Wise)', NULL),
(555, 'software_settings', 'Software Settings', NULL),
(556, 'social_link', 'Social Link', NULL),
(557, 'advertisement', 'Advertisement', NULL),
(558, 'contact_form', 'Contact Form', NULL),
(559, 'update_your_social_link', 'Update your social link', NULL),
(560, 'facebook', 'Facebook', 'فيسبوك'),
(561, 'instagram', 'Instagram', NULL),
(562, 'linkedin', 'Linkedin', NULL),
(563, 'twitter', 'Twitter', NULL),
(564, 'youtube', 'Youtube', 'يوتيوب'),
(565, 'message', 'Message', NULL),
(566, 'manage_contact', 'Manage contact', NULL),
(567, 'manage_your_contact', 'Manage your contact', NULL),
(568, 'update_contact_form', 'Update contact form', NULL),
(569, 'update_your_contact_form', 'Update your contact form', NULL),
(570, 'update_your_web_settings', 'Update your web setting', NULL),
(571, 'google_map', 'Google Map', NULL),
(572, 'about_us', 'About Us', 'معلومات عنا'),
(573, 'privacy_policy', 'Privacy Policy', NULL),
(574, 'terms_condition', 'Terms and condition', NULL),
(575, 'cat_icon', 'Category Icon', NULL),
(576, 'add_slider', 'Add Slider', NULL),
(577, 'manage_slider', 'Manage Slider', NULL),
(578, 'update_your_slider', 'Update your slider', NULL),
(579, 'slider_link', 'Slider Link', NULL),
(580, 'slider_image', 'Slider Image', NULL),
(581, 'slider_position', 'Slider Position', NULL),
(582, 'update_slider', 'Update Slider', NULL),
(583, 'manage_your_slider', 'Manage your slider', NULL),
(584, 'successfully_inactive', 'Successfully Inactive', NULL),
(585, 'successfully_active', 'Successfully active', NULL),
(586, 'embed_code', 'Embed Code', 'كود التضمين'),
(587, 'image_ads', 'Image Ads', NULL),
(588, 'url', 'URL', NULL),
(589, 'add_advertise', 'Add Advertisement', 'اضافة اعلان'),
(590, 'add_new_advertise', 'Add new advertisement', 'إضافة إعلان جديد'),
(591, 'add_type', 'Ads Type', NULL),
(592, 'ads_position', 'Ads Position', NULL),
(593, 'add_page', 'Add Page', 'اضافة صفحة'),
(594, 'ads_position_already_exists', 'Ads position already exists!', NULL),
(595, 'manage_advertise', 'Manage Advertise', NULL),
(596, 'manage_advertise_information', 'Manage advertise information', NULL),
(597, 'update_advertise', 'Update Advertise', NULL),
(598, 'add_block', 'Add Block', 'اضافة مساحة'),
(599, 'manage_block', 'Manage Block', NULL),
(600, 'block_position', 'Block Position', 'وضع المنع'),
(601, 'block_style', 'Block Style', 'نمط المنع'),
(602, 'block_css', 'Block Css', NULL),
(603, 'add_new_block', 'Add new block', 'إضافة حظر جديد'),
(604, 'block', 'Block', 'منع'),
(605, 'manage_your_block', 'Manage your block', NULL),
(606, 'block_edit', 'Block Edit', 'تفاصيل المنع'),
(607, 'add_product_review', 'Add Product Review', 'إضافة مراجعة المنتج'),
(608, 'manage_product_review', 'Manage Product Review', NULL),
(609, 'product_review', 'Product Review', NULL),
(610, 'comments', 'Comments', NULL),
(611, 'reviewer_name', 'Reviewer Name', NULL),
(612, 'product_review_edit', 'Product Review Edit', NULL),
(613, 'add_subscriber', 'Add Subscriber', NULL),
(614, 'add_new_subscriber', 'Add new subscriber', 'اضافة مسجل جديد'),
(615, 'subscriber', 'Subscriber', NULL),
(616, 'manage_subscriber', 'Manage Subscriber', NULL),
(617, 'manage_your_subscriber', 'Manage your subscriber', NULL),
(618, 'subscriber_update', 'Subscriber Update', NULL),
(619, 'apply_ip', 'Apply IP', 'تطبيق الملكية الفكرية'),
(620, 'add_wishlist', 'Add Wishlist', NULL),
(621, 'add_new_wishlist', 'Add new wishlist', 'اضافة قائمة امنيات جديدة'),
(622, 'wishlist', 'Wishlist', NULL),
(623, 'manage_wishlist', 'Manage Wishlist', NULL),
(624, 'manage_your_wishlist', 'Manage your wishlist', NULL),
(625, 'add_web_footer', 'Add Web Footer', NULL),
(626, 'manage_web_footer', 'Manage Web Footer', NULL),
(627, 'headlines', 'Headlines', NULL),
(628, 'position', 'Position', NULL),
(629, 'add_new_web_footer', 'Add new footer', 'اضافة تبويب جديد'),
(630, 'web_footer', 'Web Footer', NULL),
(631, 'web_footer_update', 'Web Footer Update', NULL),
(632, 'manage_your_web_footer', 'Manage your web footer.', NULL),
(633, 'add_link_page', 'Add Link Page', 'اضافة رابط الصفحة'),
(634, 'manage_link_page', 'Manage Link Page', NULL),
(635, 'add_new_link_page', 'Add new link page', 'اضافة رابط صفحة جديد'),
(636, 'link_page_update', 'Link Page Update', NULL),
(637, 'manage_your_link_page', 'Manage your link page', NULL),
(638, 'link_page', 'Link Page', NULL),
(639, 'add_coupon', 'Add Coupon', 'اضافة كوبون'),
(640, 'manage_coupon', 'Manage Coupon', NULL),
(641, 'coupon_name', 'Coupon Name', 'اسم القسيمة'),
(642, 'coupon_discount_code', 'Coupon Discount Code', 'كود خصم القسيمة'),
(643, 'discount_amount', 'Discount Amount', NULL),
(644, 'discount_percentage', 'Discount Percentage', NULL),
(645, 'coupon', 'Coupon', 'قسيمة'),
(646, 'add_new_coupon', 'Add new coupon', 'إضافة قسيمة خصم  جديدة'),
(647, 'discount_type', 'Discount Type', NULL),
(648, 'coupon_update', 'Coupon Update', 'تحديث القسيمة'),
(649, 'manage_your_coupon', 'Manage your coupon', NULL),
(650, 'onsale_price', 'Offer Price', NULL),
(651, 'download_sample_file', 'Download sample file', 'تنزيل عينة ملف '),
(652, 'quotation', 'Quotation', NULL),
(653, 'new_quotation', 'New Quotation', NULL),
(654, 'manage_quotation', 'Manage Quotation', NULL),
(655, 'add_new_quotation', 'Add new quotation', 'إضافة عرض سعر جديد'),
(656, 'quotation_no', 'Quotation No', NULL),
(657, 'manage_your_quotation', 'Manage your quotation', NULL),
(658, 'quotation_update', 'Quotation Update', NULL),
(659, 'quotation_details', 'Quotation Details', NULL),
(660, 'quotation_from', 'Quotation Form', NULL),
(661, 'quotation_date', 'Quotation Date', NULL),
(662, 'quotation_to', 'Quotation To', NULL),
(663, 'invoiced', 'Invoiced', NULL),
(664, 'order', 'Order', NULL),
(665, 'new_order', 'New Order', NULL),
(666, 'manage_order', 'Manage Order', NULL),
(667, 'order_no', 'Order No', NULL),
(668, 'order_date', 'Order Date', NULL),
(669, 'order_to', 'Order To', NULL),
(670, 'order_from', 'Order From', NULL),
(671, 'order_details', 'Order Details', NULL),
(672, 'order_update', 'Order Update', NULL),
(673, 'best_sale', 'Best Sale', 'أفضل بيع'),
(674, 'call_us', 'CALL US', 'اتصل بنا'),
(675, 'sign_up', 'Sign Up', 'اشتراك'),
(676, 'contact_us', 'Contact Us', 'اتصل بنا'),
(677, 'category_product_not_found', 'Opps !!!  product not found !', 'فئة المنتج غير موجود'),
(678, 'sign_up_for_news_and', 'Sign up for news and ', 'اشترك لتصل علي أخبارنا '),
(679, 'offers', 'Offers', NULL),
(680, 'you_may_unsubscribe_at_any_time', 'You may unsubscribe at any time', 'يمكنك إلغاء الاشتراك في أي وقت'),
(681, 'enter_your_email', 'Enter your email.', 'أدخل بريدك الإلكتروني'),
(682, 'product_size', 'Product Size', NULL),
(683, 'product_type', 'Product Type', NULL),
(684, 'availability', 'Availability', 'التوفر'),
(685, 'price_of_product', 'Price Of Product', NULL),
(686, 'in_stock', 'In Stock', NULL),
(687, 'related_products', 'Related Products', NULL),
(688, 'review', 'Review', NULL),
(689, 'tag', 'Tag', 'بطاقة شعار'),
(690, 'specification', 'Specifications', NULL),
(691, 'search_product_name_here', 'Search product name here...', NULL),
(692, 'all_categories', 'All Categories', 'جميع الفئات'),
(693, 'best_sales', 'Best Sales', 'أفضل المبيعات'),
(694, 'price_range', 'Price Range', NULL),
(695, 'see_more', 'See More', NULL),
(696, 'add_to_cart', 'Add To Cart', NULL),
(697, 'create_your_account', 'Create Your Account', 'أنشئ حسابك'),
(698, 'create_account', 'Create Account', NULL),
(699, 'you_have_successfully_signup', 'You have successfully sign up.', 'لقد قمت بالتسجيل بنجاح'),
(700, 'you_have_not_sign_up', 'You have not sign up.', 'لم تسجل الدخول '),
(701, 'i_have_forgotten_my_password', 'I Have Forgotten My Password', NULL),
(702, 'login_successfully', 'Login Successfully', NULL),
(703, 'you_are_not_authorised', 'You are not authorised Person !', 'أنت غير مصرح لك'),
(704, 'customer_profile', 'Customer Profile', NULL),
(705, 'total_order', 'Total Order', NULL),
(706, 'add_currency', 'Add Currency', 'اضافة عملة'),
(707, 'manage_currency', 'Manage Currency', NULL),
(708, 'add_new_currency', 'Add new currency', 'إضافة عملة جديدة'),
(709, 'currency_name', 'Currency Name', NULL),
(710, 'currency_icon', 'Currency Icon', NULL),
(711, 'conversion_rate', 'Conversion Rate', 'معدل التحويل'),
(712, 'default_status', 'Default Status', NULL),
(713, 'default_store_already_exists', 'Default store already exists !', NULL),
(714, 'currency_edit', 'Currency Edit', NULL),
(715, 'manage_your_currency', 'Manage your currency', NULL),
(716, 'review_this_product', 'Review This Product', NULL),
(717, 'page', 'Page', NULL),
(718, 'delivery_info', 'Delivery Info', NULL),
(719, 'terms_and_condition', 'Terms And Condition', NULL),
(720, 'help', 'Help', NULL),
(721, 'get_in_touch', 'Get In Touch', NULL),
(722, 'write_your_msg_here', 'Write your msg here', NULL),
(723, 'add_about_us', 'Add About Us', 'اضافة نبذة عن الشركة'),
(724, 'add_new_about_us', 'Add new about us', 'اضافة نبذة جديدة عن الشركة'),
(725, 'manage_about_us', 'Manage About Us', NULL),
(726, 'manage_your_about_us', 'Manage your about us', NULL),
(727, 'about_us_update', 'About Us Update', 'تحديث النبذة'),
(728, 'position_already_exists', 'Position Already Exists !', NULL),
(729, 'why_choose_us', 'Why Choose US', NULL),
(730, 'our_location', 'Our Location', NULL),
(731, 'add_our_location', 'Add Our Location', 'اضافة موقعنا'),
(732, 'add_new_our_location', 'Add new our location', 'موقعنا الجديد'),
(733, 'manage_our_location', 'Manage Our Location', NULL),
(734, 'our_location_update', 'Our Location Update', NULL),
(735, 'map_api_key', 'Map API Key', NULL),
(736, 'map_latitude', 'Map Latitude', NULL),
(737, 'map_longitude', 'Map Longitude', NULL),
(738, 'checkout_options', 'Checkout Options', NULL),
(739, 'register_account', 'Register Account', NULL),
(740, 'guest_checkout', 'Guest Checkout', NULL),
(741, 'returning_customer', 'Returning Customer', ''),
(742, 'personal_details', 'Personal Details', NULL),
(743, 'billing_details', 'Billing Details', 'تفاصيل الفاتورة '),
(744, 'delivery_details', 'Delivery Details', NULL),
(745, 'delivery_method', 'Delivery Method', NULL),
(746, 'payment_method', 'Payment Method', NULL),
(747, 'confirm_order', 'Confirm Order', NULL),
(748, 'company', 'Company', NULL),
(749, 'region_state', 'Region / State', NULL),
(750, 'post_code', 'Post Code', NULL),
(751, 'slider', 'Slider', NULL),
(752, 'subscriver', 'Subscriver', NULL),
(753, 'shipping_method', 'Shipping Method', NULL),
(754, 'add_shipping_method', 'Add Shipping Method', NULL),
(755, 'manage_shipping_method', 'Manage Shipping Method', NULL),
(756, 'shipping_method_edit', 'Shipping Method Edit', NULL),
(757, 'bank_transfer', 'Bank Transfer', 'تحويل البنك '),
(758, 'cash_on_delivery', 'Cash On Delivery', 'الدفع عند الاستلام'),
(759, 'sub_total', 'Sub Total', NULL),
(760, 'product_successfully_order', 'Product Successfully Ordered', NULL),
(761, 'checkout', 'Checkout', NULL),
(762, 'share', 'Share', NULL),
(763, 'are_you_sure_want_to_order', 'Are you sure want to order ?', 'هل أنت متأكد من أنك تريد الطلب '),
(764, 'optional', 'This is optional', NULL),
(765, 'manage_wearhouse_product', 'Manage Wearhouse Product', NULL),
(766, 'you_cant_delete_this_is_in_calculate_system', 'You can\'t delete. This is in calculate system.', 'لا يمكنك حذف هذا في نظام الحساب'),
(767, 'you_can_add_only_one_product_at_a_time', 'You can add only one product at at a time !', 'يمكنك إضافة منتج واحد فقط في كل مرة'),
(768, 'stock_report_store_wise', 'Stock Report (Store Wise)', NULL),
(769, 'invoice_search_item', 'Invoice search item', NULL),
(770, 'default_store', 'Default Store', NULL),
(771, 'total_price', 'Total Price', NULL),
(772, 'use_coupon_code', 'Use coupon code', NULL),
(773, 'enter_your_coupon_here', 'Enter your coupon here', 'أدخل قسيمتك هنا'),
(774, 'apply_coupon', 'Apply Coupon', 'تطبيق قسيمة الخصم'),
(775, 'coupon_code', 'Coupon Code', 'رمز القسيمة'),
(776, 'cart', 'Cart', 'عربة التسوق'),
(777, 'your_coupon_is_used', 'Your coupon is used !', 'قسيمتك مستخدمة'),
(778, 'coupon_is_expired', 'Your coupon is expired !', 'قسيمة منتهية الصلاحية'),
(779, 'coupon_discount', 'Coupon Discount', 'خصم القسيمة'),
(780, 'oops_your_cart_is_empty', 'OOPS !!! Your Cart is Empty', NULL),
(781, 'got_to_shop_now', 'Go to shop Now', NULL),
(782, 'by_creating_an_account_you_will_able_to_shop_faster', 'By creating an account you will be able to shop faster, be up to date on an order\'s status, and keep track of the orders you have previously made.', NULL),
(783, 'select_category', 'Select Category', NULL),
(784, 'select_state', 'Select State', NULL),
(785, 'my_delivery_and_billing_addresses_are_the_same', 'My delivery and billing addresses are the same.', NULL),
(786, 'i_have_read_and_agree_to_the_privacy_policy', 'I have read and agree to the', NULL),
(787, 'select_country', 'Select Country', NULL),
(788, 'kindly_select_the_preferred_shipping_method_to_use_on_this_order', 'Kindly Select the preferred shipping method to use on this order.', NULL),
(789, 'view_cart', 'View Cart', NULL),
(790, 'category_wise_product', 'Category Wise Product.', NULL),
(791, 'stock_not_available', 'Stock not available !', NULL),
(792, 'print_barcode', 'Print Barcode', NULL),
(793, 'print_qrcode', 'Print QR Code', NULL),
(794, 'product_is_not_available_in_this_store', 'Product is not available in this store !', NULL),
(795, 'category_product_search', 'Category Product Search.', 'البحث بفئة المنتج'),
(796, 'partial_paid', 'Partial Paid', NULL),
(797, 'manage_product_tax', 'Manage Product Tax', NULL),
(798, 'tax_setting', 'Tax Setting', 'تحديد الضرائب'),
(799, 'tax_name_1', 'Tax 1 Name ', 'إسم الضريبة 1'),
(800, 'tax_name_2', 'Tax 2 Name', 'إسم الضريبة 2'),
(801, 'tax_name_3', 'Tax 3 Name', 'إسم الضريبة 3'),
(802, 'quotation_discount', 'Quotation Discount', NULL),
(803, 'select_variant', 'Select Variant', NULL),
(804, 'already_a_member', 'Already a member ?', NULL),
(805, 'not_a_member_yet', 'No a member yet ?', NULL),
(806, 'store_or_wearhouse', 'Store or Wearhouse', NULL),
(807, 'import_category_csv', 'Import Category (CSV)', NULL),
(808, 'import_store_csv', 'Import Store (CSV)', NULL),
(809, 'import_wearhouse_csv', 'Import Wearhouse (CSV)', NULL),
(810, 'image_field_is_required', 'Image field is required !', NULL),
(811, 'email_configuration', 'Email Configuration', 'تكوين البريد الإلكتروني'),
(812, 'protocol', 'Protocol', NULL),
(813, 'mailtype', 'Mail Type', NULL),
(814, 'smtp_host', 'SMTP Host', NULL),
(815, 'smtp_port', 'SMTP Port', NULL),
(816, 'sender_email', 'Sender Email', NULL),
(817, 'html', 'Html', NULL),
(818, 'text', 'Text', NULL),
(819, 'add_note', 'Add Note', 'اضافة ملاحظات'),
(820, 'shipped', 'Shipped', NULL),
(821, 'return', 'Return', 'إرجاع'),
(822, 'processing', 'Processing', NULL),
(823, 'complete', 'Complete', NULL),
(824, 'pending', 'Pending', NULL),
(825, 'please_add_note', 'Please add note !', NULL),
(826, 'email_send_to_customer', 'Email send to customer', 'إرسال بريد إلكتروني إلى العميل'),
(827, 'items_in_your_cart', 'Items In Your Cart.', NULL),
(828, 'you_have', 'You Have', 'عندك'),
(829, 'add_coment_about_your_order', 'Add Comment About Your Order.', 'اضافة تعليق عن الطلب'),
(830, 'add_coment_about_your_payment', 'Add Comment About Your Order.', 'اضافة ملاحظة عن الدفعة'),
(831, 'you_have_receive_a_email_please_check_your_email', 'You have received a email.Please check your email.', 'تم إرسال بريد إلكتروني لك الرجاء التحقق من ذلك '),
(832, 'invoice_status', 'Invoice Status', NULL),
(833, 'order_information', 'Order Information', NULL),
(834, 'order_info_details', 'Attached below is order. If you have any questions or there are any issues please let us know. Have a great day. ', NULL),
(835, 'bank_transfer_instruction', 'Bank Transfer Instruction', 'تعليمات التحويل البنكي'),
(836, 'pleasse_transfer_the_total_amount_to_the_following_bank_account', 'Please Transfer The Total Amount To The Following Bank Account.', NULL),
(837, 'account_no', 'Account No', 'رقم الحساب'),
(838, 'branch', 'Branch', 'فرع'),
(839, 'add_to_wishlist', 'Add To Wishlist', NULL),
(840, 'quick_view', 'Quick View.', NULL),
(841, 'service_charge', 'Service Charge', NULL),
(842, 'credit_card', 'Credit Card', 'بطاقة الائتمان'),
(843, 'debit_card', 'Debit Card', 'بطاقة ائتمان'),
(844, 'master_card', 'Master Card', NULL),
(845, 'amex', 'Amex', NULL),
(846, 'visa', 'Visa', NULL),
(847, 'paypal', 'Paypal', NULL),
(848, 'you_cant_delete_this_customer', 'You can\'t delete this customer ! This is in calculating system.', 'لا يمكنك حذف هذا العميل'),
(849, 'you_cant_delete_this_supplier', 'You can\'t delete this supplier ! This is in calculating system.', 'لا يمكنك حذف هذا المورد'),
(850, 'quotation_information', 'Quotation Information', NULL),
(851, 'quotation_info_details', 'Attached below is quotation. If you have any questions or there are any issues please let us know. Have a great day. ', NULL),
(852, 'variant_is_required', 'Variant is required !', NULL),
(853, 'bitcoin', 'Bitcoin', 'بيتكوين'),
(854, 'order_cancel', 'Order cancel', NULL),
(855, 'payeer_payment', 'Payeer Payment', NULL),
(856, 'bitcoin_payment', 'Bitcoin Payment', 'دفع البيتكوين'),
(857, 'customer_id', 'Customer ID', NULL),
(858, 'payeer', 'Payeer', NULL),
(859, 'payment_gateway_setting', 'Payment Gateway Setting', NULL),
(860, 'public_key', 'Public Key', NULL),
(861, 'private_key', 'Private Key', NULL),
(862, 'shop_id', 'Shop ID', NULL),
(863, 'paypal_email', 'Paypal Email', NULL),
(864, 'transaction_faild', 'Transaction Failed !', NULL),
(865, 'footer_logo', 'Footer Logo', 'شعار التذييل'),
(866, 'footer_details', 'Footer Details', 'تفاصيل التذييل'),
(867, 'default_status_already_exists', 'Default status already exists !', NULL),
(868, 'store_name_already_exists', 'Store name already exists !', NULL),
(869, 'please_set_default_store', 'Please set default store !', NULL),
(870, 'do_you_want_make_it_default_store', 'Do you want make it default store ?', 'هل تريد جعله المتجر الافتراضي'),
(871, 'do_you_want_make_it_default_currency', 'Do you want it default currency ?', 'هل تريد جعلها العملة الافتراضية'),
(872, 'you_must_have_a_default_currency', 'You must have a default currency', 'يجب أن تحافظ على العملة الافتراضية'),
(873, 'you_cant_delete_this_is_default_currency', 'You cant delete ! This is default currency. ', 'لا يمكنك حذف هذه هي العملة الافتراضية'),
(874, 'you_must_have_a_default_store', 'You must have a default sote', 'يجب أن يكون لديك متجر افتراضي'),
(875, 'email_not_send', 'Email not send !', 'البريد الإلكتروني لا يرسل'),
(876, 'client_id', 'Client ID', NULL),
(877, 'app_qr_code', 'App QR Code', 'للتطبيق   QR  رمز  '),
(878, 'sms_configuration', 'Sms Configuration', NULL),
(879, 'charset', 'Charset', NULL),
(880, 'port', 'Port', NULL),
(881, 'host', 'Host', NULL),
(882, 'title', 'Title', NULL),
(883, 'gateway', 'Gateway', NULL),
(884, 'smsrank', 'SMS Rank', NULL),
(885, 'sms_pre_text', 'Your Order No ', NULL),
(886, 'sms_text', 'has been confirmed ', NULL),
(887, 'sms_settings', 'SMS Settings ', NULL),
(888, 'sms_template', 'SMS Template', NULL),
(889, 'template_name', 'Template Name', 'اسم القالب'),
(890, 'sms_template_warning', 'please use \"{id}\" format without quotation to set dynamic value inside template. ', NULL),
(891, 'qr_status', 'QR Code Status', NULL),
(892, 'pay_with', 'Pay With', NULL),
(893, 'manage_pay_with', 'Manage Pay With', NULL),
(894, 'add_pay_with', 'Add Pay With', 'إضافة الدفع من خلال'),
(895, 'pay_with_edit', 'Pay With Edit', NULL),
(896, 'color_setting_frontend', 'Color Setting Front End', NULL),
(897, 'color1', 'Color 1', NULL),
(898, 'color2', 'Color 2', NULL),
(899, 'color3', 'Color 3', NULL),
(900, 'color_setting_backend', 'Color Setting Backend', NULL),
(901, 'color4', 'Color 4', NULL),
(902, 'forget_password', 'Forgot Password', 'نسيت كلمة المرور'),
(903, 'send', 'Send', NULL),
(904, 'password_recovery', 'Password Recovery', NULL),
(905, 'color5', 'Color 5', NULL),
(906, 'please_select_product_size', 'Please Select Product Size', NULL),
(907, 'please_keep_quantity_up_to_zero', 'Please Keep Quantity Up To Zero', NULL),
(908, 'product_added_to_cart', 'Product Added To Cart', NULL),
(909, 'not_enough_product_in_stock', 'Not Enough Product In Stock. Please Reduce The Product Quantity.', NULL),
(910, 'please_fill_up_all_required_field', 'Please Fill Up All Required Field', NULL),
(911, 'fe_color1', 'Color1 = header section', 'لون الحقل الاول '),
(912, 'fe_color2', 'Color2 = Dropdown and Footer Section', 'لون الحقل الثاني '),
(913, 'fe_color3', 'Color3 = Menu Bar', 'لون الحقل الثالث '),
(914, 'be_color1', 'Color1 = Left Bar', 'يكون اللون 1'),
(915, 'be_color2', 'Color2 = Top And Bottom Bar', 'يكون اللون 2'),
(916, 'be_color3', 'Color3 = Body Background', 'يكون اللون 3'),
(917, 'be_color4', 'Color4 = For All Button Except Edit & Delete Button', 'يكون اللون 4'),
(918, 'be_color5', 'Color5 =  Button Font Color Except edit & Delete Button', 'يكون اللون 5'),
(919, 'sales_report_store_wise', 'Sales Report (Store Wise)', NULL),
(920, 'fe_color4', 'Color4 = Notification, Sign-up button, Rating, Footer text border, Go to top button  ', 'لون الحقل الرابع '),
(921, 'link', 'Link', NULL),
(922, 'userid', 'UserId', NULL),
(923, 'this_email_not_exits', 'This Email Not Exits', NULL),
(924, 'sell', 'Sell', NULL),
(925, 'transfer_quantity', 'Transfer Quantity', NULL),
(926, 'order_completed', 'Your Order Is Completed. ', NULL),
(927, 'this_coupon_is_already_used', 'This Coupon Is Already Used', NULL),
(928, 'please_login_first', 'Please Login First', NULL),
(929, 'product_added_to_wishlist', 'Product Added To Wishlist', NULL),
(930, 'product_already_exists_in_wishlist', 'Product Already Exists In Wishlist', NULL),
(931, 'support', 'Support', 'الدعم'),
(932, 'add_country_code', 'Please Add Country Code To Use SMS Services ', 'اضافة رمز الدولة'),
(933, 'search_items', 'Items Found For ', NULL),
(934, 'variant_not_available', 'This variant is not available', NULL),
(935, 'request_failed', 'Request Failed, Please check and try again!', 'الطلب فشل'),
(936, 'write_your_comment', 'Please write your comment.', NULL),
(937, 'your_review_added', 'Your review added.', 'تم إضافك رأيك '),
(938, 'already_reviewed', 'Thanks. You already reviewed.', NULL),
(939, 'please_type_email_and_password', 'Please type email and password.', NULL),
(940, 'ordered', 'Ordered ', NULL),
(941, 'your_order_has_been_confirm', 'Your order has been confirm.', 'تم تأكيد طلبك'),
(942, 'receive_quantity', 'Receive Quantity', NULL),
(943, 'receive_from', 'Receive From', NULL),
(944, 'stock_report_order_wise', 'Stock Report Order Wise', NULL),
(945, 'theme_activation', 'Theme Activation', NULL),
(946, 'manage_themes', 'Manage Themes', NULL),
(947, 'upload_new_theme', 'Upload New Theme', NULL);
INSERT INTO `language_backup` (`id`, `phrase`, `english`, `arabic`) VALUES
(948, 'theme_name', 'Theme Name', NULL),
(949, 'upload', 'Upload', NULL),
(950, 'themes', 'Themes', NULL),
(951, 'theme_active_successfully', 'Theme Active successfully.', NULL),
(952, 'theme_uploaded_successfully', 'Theme uploaded successfully.', NULL),
(953, 'there_was_a_problem_with_the_upload', 'There was a problem with the upload. Please try again.', NULL),
(954, 'the_theme_has_not_uploaded', 'The Theme has not uploaded!', NULL),
(955, 'have_a_question', 'Have a question?', NULL),
(956, 'buy_now_promotion', 'Buy Now Promotions', 'شراء الآن عرض '),
(957, 'all_departments', 'All Departments', 'جميع الأقسام '),
(958, 'best_sale_product', 'Best sale Product', 'أفضل منتج مبيعاً'),
(959, 'most_popular_product', 'Most Popular Product', NULL),
(960, 'view_all', 'View All', NULL),
(961, 'view_all', 'View All', NULL),
(962, 'brand_of_the_week', 'Brands of the Week', 'ماركة الأسبوع'),
(963, 'download_the_app', 'Download The App', 'قم بتنزيل التطبيق'),
(964, 'get_access_to_all_exclusive_offers', 'Get access to all exclusive offers, discounts and deals by download our App !', NULL),
(965, 'select', 'Select', NULL),
(966, 'you_may_alo_be_interested_in', 'You May Also Be Interested In', 'يمكن الاتصال في حال ما كنت مهتم '),
(967, 'rate_it', 'Rate It', NULL),
(968, 'similar_products', 'Similar Products', 'منتجات مماثلة'),
(969, 'subscribe_successfully', 'Subscribe Successfully', NULL),
(970, 'please_enter_email', 'Please Enter Valid Email. ', NULL),
(971, 'username_or_email', 'Username or Email', NULL),
(972, 'dont_have_an_account', 'Don\'t have an account? ', NULL),
(973, 'already_member', 'Already Member ?', NULL),
(974, 'success', 'Success', NULL),
(975, 'lost_your_password', 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', NULL),
(976, 'reset_password', 'Reset Password', 'إعادة تعيين كلمة المرور'),
(977, 'ago', 'ago', NULL),
(978, 'signin', 'Sign In', NULL),
(979, 'your', 'Your', 'لك'),
(980, 'product_remove_from_wishlist', 'Product Remove From Wish list', NULL),
(981, 'product_not_remove_from_wishlist', 'Product not remove from wish list', NULL),
(982, 'enter_your_coupon_code_if_you_have_one', 'Enter your coupon code if you have one.', 'أدخل رمز القسيمة الخاص بك إذا كان لديك واحد'),
(983, 'cart_total', 'Cart Totals', 'إجمالي سلة التسوق'),
(984, 'remember_me', 'Remember Me', NULL),
(985, 'click_here_to_login', 'Click here to login', NULL),
(986, 'if_you_have_shopped_with_us', 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing & Shipping section.', NULL),
(987, 'billing_address', 'Billing Address', 'عنوان الفاتورة '),
(988, 'create_an_account', 'Create An Account ?', NULL),
(989, 'create_account_password', 'Create Account Password', NULL),
(990, 'notes_about_your_order', 'Notes about your order, e.g. special notes for delivery.', NULL),
(991, 'ship_to_a_different_address', 'Ship to a different address?', NULL),
(992, 'by_variant', 'By Variant  ', NULL),
(993, 'by_brand', 'By Brand', 'عن طريق العلامة التجارية'),
(994, 'rating', 'Rating', NULL),
(995, 'filter', 'Filter', 'أداة البحث '),
(996, 'by_price', 'By Price', 'حسب السعر'),
(997, '5', '5', '5'),
(998, '4', '4', '4'),
(999, 'your_email_address_will_not_be_published', 'Your email address will not be published. Required fields are marked *', 'لن يتم نشر عنوان بريدك الإلكتروني'),
(1000, 'shop_of_the_week', 'Shop Of The Week', NULL),
(1001, 'copyright', 'Copyright Â© 2018 Bdtask. All Rights Reserved', 'حقوق النشر'),
(1002, 'app_link_status', 'App Link Status', 'حالة رابط التطبيق'),
(1003, 'update_your_software_setting', 'Update Your Software Setting', NULL),
(1004, 'update_color_setting', 'Update Color Setting', NULL),
(1005, 'update_web_color', 'Update Web Color', NULL),
(1006, 'update_dashboard_color', 'Update Dashboard Color', 'تحديث لون واجهة المستخدم'),
(1007, 'update_color', 'Update Color', NULL),
(1008, 'sslcommerz_email', 'SSLCOMMERZ Email', NULL),
(1009, 'store_id', 'Store ID', NULL),
(1010, 'import_database', 'Import Database', NULL),
(1011, 'check_for_update', 'Check For Update', NULL),
(1012, 'software_update', 'Software Update', NULL),
(1013, 'activated', 'Activated', 'مفعل'),
(1014, 'back_to_home', 'Back to home', 'العودة إلى الصفحة الرئيسية'),
(1015, 'in_active', 'In Active', NULL),
(1016, 'january', 'January', NULL),
(1017, 'february', 'February', 'فبراير'),
(1018, 'march', 'March', NULL),
(1019, 'january', 'January', NULL),
(1020, 'february', 'February', 'فبراير'),
(1021, 'april', 'April', 'أبريل'),
(1022, 'may', 'May', NULL),
(1023, 'june', 'June', NULL),
(1024, 'july', 'July', NULL),
(1025, 'august', 'August', 'أغسطس'),
(1026, 'september', 'September', NULL),
(1027, 'october', 'October', NULL),
(1028, 'november', 'November', NULL),
(1029, 'december', 'December', ''),
(1030, 'product_image_gallery', 'Product Image Gallery', NULL),
(1031, 'add_product_image', 'Add product image', 'إضافة صورة المنتج'),
(1032, 'manage_product_image', 'Manage product image', NULL),
(1033, 'sms_service', 'SMS Service ', NULL),
(1034, 'google_analytics', 'Google Analytics', NULL),
(1035, 'facebook_messenger', 'Facebook Messenger', 'فيسبوك ماسنجر'),
(1036, 'welcome_back_to_login', 'Welcome Back to Login.', NULL),
(1037, 'application_protocol', 'Application Protocol', 'بروتوكول التطبيق'),
(1038, 'http', 'HTTP', NULL),
(1039, 'https', 'HTTPS', NULL),
(1040, 'login_with_facebook', 'Login with facebook', NULL),
(1041, 'social_authentication', 'Social Authentication', NULL),
(1042, 'manage_social_media', 'Manage social media', NULL),
(1043, 'social', 'Social', NULL),
(1044, 'app_id', 'App ID', 'معرف التطبيق'),
(1045, 'app_secret', 'App Secret', ''),
(1046, 'api_key', 'Api key', 'مفتاح API'),
(1047, 'shipping_charge', 'Shipping Charge', NULL),
(1048, 'stock_report_variant_wise', 'Stock report variant wise', NULL),
(1049, 'purchase', 'Purchase', NULL),
(1050, 'rating_and_reviews', 'Ratings and Reviews', NULL),
(1051, 'average_user_rating', 'Average user rating', 'متوسط تقييم المستخدم'),
(1052, 'rating_breakdown', 'Rating breakdown', NULL),
(1053, '100_percent_complete', '100% Complete (success)', '100% مكتمل'),
(1054, '80_percent_complete', '80% Complete (primary)', '80% مكتمل'),
(1055, '60_percent_complete', '60% Complete (info)', '60% مكتمل'),
(1056, '40_percent_complete', '40% Complete (warning)', '40% مكتمل'),
(1057, '20_percent_complete', '20% Complete (danger)', '20% مكتمل'),
(1058, 'default_variant', 'Default variant', NULL),
(1059, 'video_link', 'Video Link', NULL),
(1060, 'send_your_review', 'Send Your Review', NULL),
(1061, 'if_you_have_shopped_with_us_before', 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing & Shipping section.', NULL),
(1062, 'your_order', 'Your order', 'طلبك'),
(1063, 'free_shipping', 'Free Shipping', 'الشحن مجانا'),
(1064, 'from_newyork', 'From 345/E NewYork', 'من نيويورك'),
(1065, 'the_internet_tend_to_repeat', 'The internet Tend To Repeat', NULL),
(1066, '45_days_return', '45 Days Return', 'ارجاع خلال 45 يوم'),
(1067, 'making_it_look_like_readable', 'Making it Look Like Readable', NULL),
(1068, 'opening_all_week', 'Opening All Week', NULL),
(1069, '8am_9pm', '08AM - 09PM', 'من الثامنة صباحا حتى ال 9 مساءا'),
(1070, 'ad_style', 'Ads Style', NULL),
(1071, 'style_one', 'Style One', NULL),
(1072, 'style_two', 'Style Two', NULL),
(1073, 'style_three', 'Style Three', NULL),
(1074, 'embed_code2', 'Embed Code2', 'كود التضمين 2'),
(1075, 'embed_code3', 'Embed Code3', 'كود التضمين 3'),
(1076, 'url2', 'URL2', NULL),
(1077, 'url3', 'URL3', NULL),
(1078, 'image2', 'Image 2', NULL),
(1079, 'image3', 'Image 3', NULL),
(1080, 'order_now', 'Order Now', NULL),
(1081, 'default_variant_must_have_to_be_one_of_the_variants', 'Default variant must have to be one of the variants', NULL),
(1082, 'default_image', 'Default image', NULL),
(1083, 'meta_keyword', 'Meta keyword', NULL),
(1084, 'meta_description', 'Meta description', NULL),
(1085, 'this_email_already_exists', 'This email already exists', NULL),
(1086, 'you_cant_delete_this_is_default_store', 'You can\'t delete it. This is a default store. ', 'لا يمكنك الحذف هذا هو المتجر الافتراضي'),
(1087, 'already_exists_please_login', 'This Email already exists please login or use another email. ', NULL),
(1088, '4-5', '4-5', '4-5'),
(1089, 'sign_office', 'Sign Office', NULL),
(1090, 'customer_sign', 'Customer Sign', NULL),
(1091, 'thank_you_for_shopping_with_us', 'Thank you for shopping with us.', NULL),
(1092, 'new_sale', 'New sale', NULL),
(1093, 'manage_sale', 'Manage sale', NULL),
(1094, 'pos_sale', 'Pos sale', NULL),
(1095, 'android_apps', 'Android apps', 'تطبيقات الأندرويد'),
(1096, 'update_your_android_apps_link', 'Update your android apps link', NULL),
(1097, 'put_your_apps_link', 'Put your apps link', NULL),
(1098, 'go_to_website', 'Go to website', NULL),
(1099, 'our_demo', 'Our demo', NULL),
(1100, 'note', 'Note', NULL),
(1101, 'login', 'Login', NULL),
(1102, 'email', 'Email Address', 'البريد الإلكتروني'),
(1103, 'password', 'Password', NULL),
(1104, 'reset', 'Reset', 'إعادة تعيين'),
(1105, 'dashboard', 'Dashboard', NULL),
(1106, 'home', 'Home', NULL),
(1107, 'profile', 'Profile', NULL),
(1108, 'profile_setting', 'Profile Setting', NULL),
(1109, 'firstname', 'First Name', 'الاسم الاول'),
(1110, 'lastname', 'Last Name', NULL),
(1111, 'about', 'About', 'عنا'),
(1112, 'preview', 'Preview', NULL),
(1113, 'image', 'Image', NULL),
(1114, 'save', 'Save', NULL),
(1115, 'upload_successfully', 'Upload Successfully!', NULL),
(1116, 'user_added_successfully', 'User Added Successfully!', NULL),
(1117, 'please_try_again', 'Please Try Again...', NULL),
(1118, 'inbox_message', 'Inbox Messages', NULL),
(1119, 'sent_message', 'Sent Message', NULL),
(1120, 'message_details', 'Message Details', NULL),
(1121, 'new_message', 'New Message', NULL),
(1122, 'receiver_name', 'Receiver Name', NULL),
(1123, 'sender_name', 'Sender Name', NULL),
(1124, 'subject', 'Subject', NULL),
(1125, 'message', 'Message', NULL),
(1126, 'message_sent', 'Message Sent!', NULL),
(1127, 'ip_address', 'IP Address', NULL),
(1128, 'last_login', 'Last Login', NULL),
(1129, 'last_logout', 'Last Logout', NULL),
(1130, 'status', 'Status', NULL),
(1131, 'deleted_successfully', 'Deleted Successfully!', NULL),
(1132, 'send', 'Send', NULL),
(1133, 'date', 'Date', 'تاريخ'),
(1134, 'action', 'Action', 'اجراء'),
(1135, 'sl_no', 'SL No.', NULL),
(1136, 'are_you_sure', 'Are You Sure ? ', 'هل أنت متأكد'),
(1137, 'application_setting', 'Application Setting', 'اعدادات التطبيق'),
(1138, 'application_title', 'Application Title', 'عنوان التطبيق'),
(1139, 'address', 'Address', 'العنوان'),
(1140, 'phone', 'Phone', NULL),
(1141, 'favicon', 'Favicon', 'الأيقونة المفضلة'),
(1142, 'logo', 'Logo', NULL),
(1143, 'language', 'Language', NULL),
(1144, 'left_to_right', 'Left To Right', NULL),
(1145, 'right_to_left', 'Right To Left', NULL),
(1146, 'footer_text', 'Footer Text', 'نص التذييل'),
(1147, 'site_align', 'Application Alignment', NULL),
(1148, 'welcome_back', 'Welcome Back!', NULL),
(1149, 'please_contact_with_admin', 'Please Contact With Admin', NULL),
(1150, 'incorrect_email_or_password', 'Incorrect Email/Password', NULL),
(1151, 'select_option', 'Select Option', NULL),
(1152, 'ftp_setting', 'Data Synchronize [FTP Setting]', NULL),
(1153, 'hostname', 'Host Name', NULL),
(1154, 'username', 'Username', NULL),
(1155, 'ftp_port', 'FTP Port', NULL),
(1156, 'ftp_debug', 'FTP Debug', NULL),
(1157, 'project_root', 'Project Root', NULL),
(1158, 'update_successfully', 'Update Successfully', NULL),
(1159, 'save_successfully', 'Save Successfully!', NULL),
(1160, 'delete_successfully', 'Delete Successfully!', NULL),
(1161, 'internet_connection', 'Internet Connection', NULL),
(1162, 'ok', 'Ok', NULL),
(1163, 'not_available', 'Not Available', NULL),
(1164, 'available', 'Available', 'متوفرة'),
(1165, 'outgoing_file', 'Outgoing File', NULL),
(1166, 'incoming_file', 'Incoming File', NULL),
(1167, 'data_synchronize', 'Data Synchronize', 'مزامنة البيانات'),
(1168, 'unable_to_upload_file_please_check_configuration', 'Unable to upload file! please check configuration', NULL),
(1169, 'please_configure_synchronizer_settings', 'Please configure synchronizer settings', NULL),
(1170, 'download_successfully', 'Download Successfully', 'تم التنزيل بنجاح'),
(1171, 'unable_to_download_file_please_check_configuration', 'Unable to download file! please check configuration', NULL),
(1172, 'data_import_first', 'Data Import First', NULL),
(1173, 'data_import_successfully', 'Data Import Successfully!', NULL),
(1174, 'unable_to_import_data_please_check_config_or_sql_file', 'Unable to import data! please check configuration / SQL file.', NULL),
(1175, 'download_data_from_server', 'Download Data from Server', NULL),
(1176, 'data_import_to_database', 'Data Import To Database', NULL),
(1177, 'data_upload_to_server', 'Data Upload to Server', 'تحميل البيانات إلى الخادم'),
(1178, 'please_wait', 'Please Wait...', NULL),
(1179, 'ooops_something_went_wrong', ' Ooops something went wrong...', NULL),
(1180, 'module_permission_list', 'Module Permission List', NULL),
(1181, 'user_permission', 'User Permission', NULL),
(1182, 'add_module_permission', 'Add Module Permission', 'اضافة صلاحية لوحدة النظام'),
(1183, 'module_permission_added_successfully', 'Module Permission Added Successfully!', NULL),
(1184, 'update_module_permission', 'Update Module Permission', NULL),
(1185, 'download', 'Download', NULL),
(1186, 'module_name', 'Module Name', NULL),
(1187, 'create', 'Create', NULL),
(1188, 'read', 'Read', NULL),
(1189, 'update', 'Update', NULL),
(1190, 'delete', 'Delete', NULL),
(1191, 'module_list', 'Module List', NULL),
(1192, 'add_module', 'Add Module', 'اضافة وحدة نظام'),
(1193, 'directory', 'Module Direcotory', NULL),
(1194, 'description', 'Description', NULL),
(1195, 'image_upload_successfully', 'Image Upload Successfully!', NULL),
(1196, 'module_added_successfully', 'Module Added Successfully', NULL),
(1197, 'inactive', 'Inactive', NULL),
(1198, 'active', 'Active', 'فعال'),
(1199, 'user_list', 'User List', NULL),
(1200, 'see_all_message', 'See All Messages', NULL),
(1201, 'setting', 'Setting', NULL),
(1202, 'logout', 'Logout', NULL),
(1203, 'admin', 'Admin', NULL),
(1204, 'add_user', 'Add User', NULL),
(1205, 'user', 'User', NULL),
(1206, 'module', 'Module', NULL),
(1207, 'new', 'New', NULL),
(1208, 'inbox', 'Inbox', NULL),
(1209, 'sent', 'Sent', NULL),
(1210, 'synchronize', 'Synchronize', 'تزامن'),
(1211, 'data_synchronizer', 'Data Synchronizer', ''),
(1212, 'module_permission', 'Module Permission', NULL),
(1213, 'backup_now', 'Backup Now!', ' نسخة احتياطية الان'),
(1214, 'restore_now', 'Restore Now!', 'استعادة الآن'),
(1215, 'backup_and_restore', 'Backup and Restore', 'النسخ الاحتياطي والاستعادة'),
(1216, 'captcha', 'Captcha Word', 'كلمة التحقق'),
(1217, 'database_backup', 'Database Backup', NULL),
(1218, 'restore_successfully', 'Restore Successfully', 'استعادة بنجاح'),
(1219, 'backup_successfully', 'Backup Successfully', 'تم النسخ الاحتياطي بنجاح'),
(1220, 'filename', 'File Name', 'اسم الملف'),
(1221, 'file_information', 'File Information', 'معلومات الملف'),
(1222, 'size', 'size', NULL),
(1223, 'backup_date', 'Backup Date', 'تاريخ النسخ الاحتياطي'),
(1224, 'overwrite', 'Overwrite', NULL),
(1225, 'invalid_file', 'Invalid File!', NULL),
(1226, 'invalid_module', 'Invalid Module', NULL),
(1227, 'remove_successfully', 'Remove Successfully!', 'تم الحذف بنجاح'),
(1228, 'install', 'Install', NULL),
(1229, 'uninstall', 'Uninstall', NULL),
(1230, 'tables_are_not_available_in_database', 'Tables are not available in database.sql', 'الجداول غير متوفرة في قاعدة البيانات'),
(1231, 'no_tables_are_registered_in_config', 'No tables are registerd in config.php', NULL),
(1232, 'enquiry', 'Enquiry', 'استفسار'),
(1233, 'read_unread', 'Read/Unread', NULL),
(1234, 'enquiry_information', 'Enquiry Information', 'معلومات الاستفسار'),
(1235, 'user_agent', 'User Agent', NULL),
(1236, 'checked_by', 'Checked By', NULL),
(1237, 'new_enquiry', 'New Enquiry', NULL),
(1238, 'first_name_is_required', 'First name is required', 'الإسم الأول مطلوب'),
(1239, 'last_name_is_required', 'Last name is required', NULL),
(1240, 'mobile_is_required', 'Mobile is required', NULL),
(1241, 'country_is_required', 'Country is required', 'الدولة مطلوبة'),
(1242, 'address_is_required', 'Address is required', 'العنوان متطلب اجباري'),
(1243, 'state_is_required', 'State is required', NULL),
(1244, 'failed_try_again', 'Failed! Please try again.', 'فشل  الرجاء المحاولة مرة أخرى'),
(1245, 'failed', 'Failed', 'فشلت '),
(1246, 'subscribe_for_news_and', 'Subscribe for news and', NULL),
(1247, 'subscribe', 'Subscribe', NULL),
(1248, 'reviews', 'Reviews', NULL),
(1249, 'feedback', 'Feedback', 'ردود الفعل'),
(1250, 'unit_id', 'Unit ID', NULL),
(1251, 'set_default', 'Set default', NULL),
(1252, 'add', 'Add', 'اضافة'),
(1253, 'list', 'List', NULL),
(1254, 'invalid_coupon', 'Invalid Coupon', NULL),
(1255, 'login_to_apply_coupon', 'Login to apply coupon', NULL),
(1256, 'great_your_coupon_is_applied', 'Great! Your coupon is applied', NULL),
(1257, 'fe_color5', 'color5=Header Top Bar', 'لون الحقل الخامس '),
(1258, 'receiver_email', 'Receiver email', NULL),
(1259, 'modules', 'Modules', NULL),
(1260, 'modules_management', 'Modules Management', NULL),
(1261, 'buy_now', 'Buy now', 'اشتري الآن'),
(1262, 'no_theme_available', 'No Theme Available!', NULL),
(1263, 'purchase_key', 'Purchase Key', NULL),
(1264, 'invalid_purchase_key', 'Invalid Purchase Key', NULL),
(1265, 'theme_deleted_successfully', 'Theme Deleted Successfully', NULL),
(1266, 'downloaded_successfully', 'Downloaded Successfully', NULL),
(1267, 'slider_category', 'Slider Category', NULL),
(1268, 'clear_cart', 'Clear Cart', NULL),
(1269, 'continue_shopping', 'Continue Shopping', 'مواصلة التسوق'),
(1270, 'my_cart', 'My Cart', NULL),
(1271, 'favorites', 'Favorites', 'المفضلة'),
(1272, 'states', 'States', NULL),
(1273, 'manage_states', 'Manage States', NULL),
(1274, 'add_state', 'Add State', NULL),
(1275, 'edit_state', 'Edit State', 'تعديل الحاله'),
(1276, 'connect_with_us', 'Connect With Us', NULL),
(1277, 'footer_block_1', 'Footer Block 1', 'مربع التذييل 1 '),
(1278, 'footer_block_2', 'Footer Block 2', 'مربع التذييل 2 '),
(1279, 'footer_block_3', 'Footer Block 3', 'مربع التذييل 3 '),
(1280, 'footer_block_4', 'Footer Block 4', 'مربع التذييل 4 '),
(1281, 'show', 'Show', NULL),
(1282, 'hide', 'Hide', NULL),
(1283, 'mobile_settings', 'Mobile Settings (For website Footer)', NULL),
(1284, 'social_share', 'Social Share', NULL),
(1285, 'bank', 'Bank', 'البنك '),
(1286, 'order_placed', 'Your order has been successfully placed', NULL),
(1287, 'update_woocommerce_stock', 'Update Woocommerce Stock', NULL),
(1288, 'track_my_order', 'Track My Order', NULL),
(1289, 'no_data_found', 'No data found', NULL),
(1290, 'payment_status', 'Payment Status', NULL),
(1291, 'order_status', 'Order Status', NULL),
(1292, 'latest_search_keywords', 'Latest Search Keywords', NULL),
(1293, 'keywords', 'Keywords', NULL),
(1294, 'results', 'Results', 'النتائج'),
(1295, 'hits', 'Hits', NULL),
(1296, 'latest_product_reviews', 'Latest Product Reviews', NULL),
(1297, 'products', 'Products', NULL),
(1298, 'category_products', 'Category Products', 'فئة المنتجات'),
(1299, 'categories', 'Categories', 'التصنيفات'),
(1300, 'products_count', 'Products Count', NULL),
(1301, 'bank', 'Bank', 'البنك '),
(1302, 'orders_count', 'orders Count', NULL),
(1303, 'all_best_sale_product', 'All Best Sale Product', ''),
(1304, 'monthly_best_sale_product', 'Monthly Best Sale Product', NULL),
(1305, 'role', 'Role', NULL),
(1306, 'add_role', 'Add Role', NULL),
(1307, 'manage_roles', 'Manage Roles', NULL),
(1308, 'manage_user_roles', 'Manage User Roles', NULL),
(1309, 'role_name', 'Role Name', NULL),
(1310, 'role_description', 'Role Description', NULL),
(1311, 'menu_title', 'Menu Title', NULL),
(1312, 'role_edit', 'Role Edit', NULL),
(1313, 'user_access_role', 'User Access Role', NULL),
(1314, 'role_add_to_user', 'Role Add To User', NULL),
(1315, 'variant_type', 'Variant Type', NULL),
(1316, 'color', 'Color', NULL),
(1317, 'color_code', 'Color Code', NULL),
(1318, 'set_variant_wise_price', 'Set Variant Wise Price', NULL),
(1319, 'all_category_products', 'All Category Products', 'جميع فئات المنتجات '),
(1320, 'all_latest_search_keywords', 'All Latest Search Keywords', NULL),
(1321, 'positive_review', 'Positive Review', NULL),
(1322, 'all_category_products', 'All Category Products', 'جميع فئات المنتجات '),
(1323, 'all_latest_search_keywords', 'All Latest Search Keywords', NULL),
(1324, 'positive_review', 'Positive Review', NULL),
(1325, 'customer_activities', 'Customer Activities', NULL),
(1326, 'new_customers', 'New Customers', NULL),
(1327, 'returning_customers', 'Returning Customers', 'العملاء الذين يقومون بإرجاع'),
(1328, 'average_spending_per_visit', 'Average Spending Per Visit', 'متوسط الإنفاق لكل زيارة'),
(1329, 'average_visits_per_customer', 'Average Visits Per Customer', 'متوسط الزيارات لكل عميل'),
(1330, 'seo_tools', 'SEO Tools', NULL),
(1331, 'popular_products', 'Popular Products', NULL),
(1332, 'website_meta_keywords', 'Website Meta Keywords', NULL),
(1333, 'meta_keywords', 'Meta Keywords', NULL),
(1334, 'clicks', 'Clicks', NULL),
(1335, 'created_by', 'Created by', NULL),
(1336, 'product_added_to_compare', 'Product Added to Compare', NULL),
(1337, 'compare', 'Compare', NULL),
(1338, 'bonus', 'Bonus', 'علاوة'),
(1339, 'edit_delivery_boy', 'Edit Delivery Boy', 'تعديل مسئول التسليم '),
(1340, 'national_id_card', 'National Id Card', NULL),
(1341, 'driving_license', 'Driving License', 'رخصة قيادة'),
(1342, 'other_payment_info', 'Other Payment Info.', NULL),
(1343, 'add_time_slot', 'Add Time Slot', NULL),
(1344, 'from_time', 'From Time', NULL),
(1345, 'to_time', 'To Time', NULL),
(1346, 'last_order_time', 'Last Order Time', NULL),
(1347, 'edit_delivery_time_slot', 'Edit Delivery Time Slot', NULL),
(1348, 'paid_by', 'Paid By', NULL),
(1349, 'transferred_at', 'Transferred At', NULL),
(1350, 'assign_time_slot', 'Assign Time Slot', ''),
(1351, 'delivery_zone', 'Delivery Zone', NULL),
(1352, 'manage_delivery_zone', 'Manage Delivery Zone', NULL),
(1353, 'edit_delivery_zone', 'Edit Delivery Zone', NULL),
(1354, 'assign_delivery', 'Assign Delivery', 'تعيين التسليم'),
(1355, 'select_delivery_zone', 'Select Delivery Zone', NULL),
(1356, 'select_delivery_boy', 'Select Delivery Boy', NULL),
(1357, 'manage_assign_delivery', 'Manage Assign Delivery', NULL),
(1358, 'orders', 'Orders', NULL),
(1359, 'select_order', 'Select Order', NULL),
(1360, 'successfully_assigned', 'Successfully Assigned', NULL),
(1361, 'assigns', 'Assigns', NULL),
(1362, 'manage_assigned_delivery', 'Manage Assigned Delivery', NULL),
(1363, 'time_slot', 'Time Slot', NULL),
(1364, 'select_time_slot', 'Select Time Slot', NULL),
(1365, 'select_orders', 'Select Orders', NULL),
(1366, 'delivery_id', 'Delivery Id', NULL),
(1367, 'assigned_delivery_orders', 'Assigned Delivery Orders', 'أوامر التسليم المخصصة'),
(1368, 'edit_assigned_delivery', 'Edit Assigned Delivery', 'تعديل التسليم المعلن'),
(1369, 'completed_at', 'Completed At', NULL),
(1370, 'delivery_assigns', 'Delivery Assigns', NULL),
(1371, 'delivery_system', 'Delivery System', NULL),
(1372, 'delivery_boy', 'Delivery Boy', NULL),
(1373, 'add_delivery_boy', 'Add Delivery Boy', 'اضافة موظف توصيل'),
(1374, 'manage_delivery_boy', 'Manage Delivery Boy', NULL),
(1375, 'delivery_slot', 'Delivery Slot', NULL),
(1376, 'manage_time_slot', 'Manage Time Slot', NULL),
(1377, 'birth_certificate', 'Birth Certificate', NULL),
(1378, 'date_of_birth', 'Date of Birth', 'تاريخ الميلاد'),
(1379, 'bank_account_name', 'Bank Account Name', 'إسم حساب البنك '),
(1380, 'delivery_balance_transfer', 'Delivery Balance Transfer', NULL),
(1381, 'transfer_amount', 'Transfer Amount', NULL),
(1382, 'amount', 'Amount', 'الكمية'),
(1383, 'successfully_transferred', 'Successfully Transferred', 'تم نقلها بنجاح'),
(1384, 'balance_transfer', 'Balance Transfer', 'رصيد مرحل '),
(1385, 'balance_transfer_history', 'Balance Transfer History', ''),
(1386, 'out_of_balance', 'Out of Balance', NULL),
(1387, 'delivery_area', 'Delivery Area', NULL),
(1388, 'add_delivery_zone', 'Add Delivery Zone', 'اضافة منطقة توصيل'),
(1389, 'created_at', 'Created at', NULL),
(1390, 'role_user', 'Role User', NULL),
(1391, 'newsletters', 'Newsletters', NULL),
(1392, 'compare_product', 'Compare Product', NULL),
(1393, 'models', 'Models', NULL),
(1394, 'order_title', 'Order Title', NULL),
(1395, 'in_amount', 'In Amount', NULL),
(1396, 'out_amount', 'Out Amount', NULL),
(1398, 'net_total', 'Net Total', NULL),
(1399, 'purchase_order', 'Purchase Order', NULL),
(1400, 'add_purchase_order', 'Add Purchase Order', 'إضافة أمر شراء'),
(1401, 'manage_purchase_order', 'Manage Purchase Order', NULL),
(1402, 'create_purchase_order', 'Create Purchase Order', 'إنشاء أمر شراء'),
(1403, 'receive_item', 'Receive Item', NULL),
(1404, 'approved', 'Approved', 'موافق'),
(1405, 'received', 'Received', NULL),
(1406, 'not_received', 'Not Received', NULL),
(1408, 'view_details', 'View Details', NULL),
(1409, 'return_item', 'Return Item', 'إعادة صنف '),
(1410, 'vat_no', 'Vat no', NULL),
(1411, 'cr_no', 'CR no', NULL),
(1412, 'pay_amount', 'Pay Amount', NULL),
(1437, 'chart_of_account', 'Chart of Account', NULL),
(1438, 'opening_balance', 'Opening Balance', NULL),
(1439, 'supplier_payment', 'Supplier Payment', 'سداد المورد'),
(1440, 'customer_receive', 'Customer Receive', NULL),
(1441, 'cash_adjustment', 'Cash Adjustment', 'تسوية نقدية'),
(1442, 'debit_voucher', 'Debit Voucher', 'قسيمة الخصم'),
(1443, 'credit_voucher', 'Credit Voucher', NULL),
(1444, 'contra_voucher', 'Contra Voucher', NULL),
(1445, 'journal_voucher', 'Journal Voucher', NULL),
(1446, 'voucher_approval', 'Voucher Approval', NULL),
(1447, 'voucher_no', 'Voucher No', NULL),
(1448, 'account_head', 'Account Head', 'الحساب الرئيسي'),
(1449, 'remark', 'Remark', 'ملاحظة'),
(1450, 'receipt_voucher', 'Receipt Voucher', NULL),
(1451, 'receipt_voucher_form', 'Receipt Voucher Form', NULL),
(1452, 'manage_receipt_voucher', 'Manage Receipt Voucher', NULL),
(1453, 'voucher_no', 'Voucher No', NULL),
(1454, 'payment_voucher', 'Payment Voucher', NULL),
(1455, 'payment_voucher_form', 'Payment Voucher Form', NULL),
(1456, 'customer_balance', 'Customer Balance', NULL),
(1457, 'vat', 'Vat', NULL),
(1458, 'total_balance', 'Total Balance', NULL),
(1459, 'remaining_balance', 'Remaining Balance', NULL),
(1460, 'pay_vat', 'Pay Vat', NULL),
(1461, 'pay_amount', 'Pay Amount', NULL),
(1462, 'whatsapp_info', 'Whatsapp Info', NULL),
(1463, 'add_whatsapp_info', 'Add Whatsapp Info', NULL),
(1464, 'whatsapp_number', 'Whatsapp Number', NULL),
(1465, 'add_invoice_text', 'Add Invoice Text', 'اضافة نص الفاتورة'),
(1466, 'invoice_text', 'Invoice Text', NULL),
(1467, 'cash_payment', 'Cash Payment', 'دفع نقدا'),
(1468, 'bank_payment', 'Bank Payment', 'سداد البنك '),
(1469, 'adjustment_type', 'Adjustment Type', NULL),
(1470, 'code', 'Code', NULL),
(1471, 'paytype', 'Paytype', NULL),
(1472, 'txtCode', 'TxtCode', NULL),
(1473, 'credit_account_head', 'Credit Account Head', ''),
(1474, 'code', 'Code', NULL),
(1475, 'successfully_approved', 'Successfully Approved', NULL),
(1476, 'debit_account_head', 'Debit Account Head', NULL),
(1477, 'add_more', 'Add More', 'اضافات اكثر'),
(1478, 'update_debit_voucher', 'Update Debit Voucher', ''),
(1479, 'update_credit_voucher', 'Update Credit Voucher', NULL),
(1480, 'update_journal_voucher', 'Update Journal Voucher', NULL),
(1481, 'update_contra_voucher', 'Update Contra Voucher', NULL),
(1482, 'order_csv_export', 'Order CSV Export', NULL),
(1483, 'export_csv', 'Export CSV', 'تصدير  لصيغة CSV'),
(1484, 'credit_account_head', 'Credit Account Head', NULL),
(1485, 'code', 'Code', NULL),
(1486, 'successfully_approved', 'Successfully Approved', NULL),
(1487, 'customer_head_code', 'Customer Head Code', NULL),
(1488, 'current_balance', 'Current Balance', NULL),
(1489, 'total_vat', 'Total Vat', NULL),
(1490, 'ooops_order_list_is_empty', 'Ooops Order List is Empty', NULL),
(1491, 'filtration', 'Filtration', 'الترشيح'),
(1492, 'add_filter', 'Add Filter', 'اضافة فلتر بحث'),
(1493, 'manage_filters', 'Manage Filters', NULL),
(1494, 'filter_names', 'Filter Names', 'البحث بالاسماء'),
(1495, 'filter_type', 'Filter Type', 'نوع البحث '),
(1496, 'edit_filter', 'Edit Filter', 'تعديل أداة البحث'),
(1497, 'account_reports', 'Account Reports', 'تقارير الحساب'),
(1498, 'general_ledger', 'General Ledger', NULL),
(1499, 'profit_loss', 'Profit Loss', NULL),
(1500, 'balance_sheet', 'Balance Sheet', 'الميزانية العمومية'),
(1501, 'cash_flow_statement', 'Cash Flow Statement', 'قائمة  التدفقات النقدية'),
(1502, 'trial_balance', 'Trial Balance', NULL),
(1503, 'reports_by_voucher', 'Reports By Voucher', 'تقارير بواسطة السندات '),
(1504, 'select_voucher_no', 'Select Voucher No', NULL),
(1505, 'voucher_reports', 'Voucher Reports', NULL),
(1506, 'account_code', 'Account Code', 'ترميز الحساب'),
(1507, 'created_date', 'Created Date', NULL),
(1508, 'general_ledger_form', 'General Ledger Form', NULL),
(1509, 'general_ledger_report', 'General Ledger Report', NULL),
(1510, 'transection_date', 'Transection Date', NULL),
(1511, 'head_code', 'Head Code', NULL),
(1512, 'particulars', 'Particulars', NULL),
(1513, 'profit_loss_report', 'Profit Loss Report', NULL),
(1514, 'authorized_signature', 'Authorized Signature', 'توقيع معتمد'),
(1515, 'chairman', 'Chairman', NULL),
(1516, 'trial_balance_with_opening_as_on', 'Trial balance with opening as on', NULL),
(1517, 'opening_cash_and_equivalent', 'Opening Cash and Equivalent', NULL),
(1518, 'trial_balance_without_opening', 'Trial Balance Without Opening', NULL),
(1519, 'trial_balance_with_opening', 'Trial Balance With Opening', NULL),
(1520, 'general_ledger_reports', 'General Ledger Reports', NULL),
(1521, 'brand_translation', 'Brand Translation', ''),
(1522, 'brand_information', 'Brand Information', 'معلومات العلامة التجارية'),
(1523, 'category_information', 'Category Information', 'معلومات الفئة'),
(1524, 'category_translation', 'Category Translation', 'ترجمة الفئة'),
(1525, 'product_translation', 'Product Translation', NULL),
(1526, 'assembly_products', 'Assembly Products', 'المنتجات المجمعة'),
(1527, 'new_assembly_product', 'New Assembly Product', NULL),
(1528, 'add_assembly_product', 'Add Assembly Product', 'اضافة منتج تجميع'),
(1529, 'add_new_assembly_product', 'Add New Assembly Product', 'اضافة منتج تجميعي'),
(1530, 'manage_assembly_products', 'Manage Assembly Products', NULL),
(1531, 'sub_title', 'Sub Title', NULL),
(1532, 'change_quantity', 'Change Quantity', NULL),
(1533, 'required', 'Required', 'مطلوب'),
(1534, 'product_selection', 'Product Selection', NULL),
(1535, 'product_already_exist', 'Product Already Exist', NULL),
(1536, 'assembly_cart', 'assembly_cart', 'عربة التجميع'),
(1537, 'is_default', 'Is Default', NULL),
(1538, 'update_assembly_product', 'Update Assembly Product', NULL),
(1539, 'manage_assembly_product', 'Manage Assembly Product', NULL),
(1540, 'product_information', 'Product Information', NULL),
(1541, 'product_information', 'Product Information', NULL),
(1542, 'import_product_excel', 'Import Product (EXCEL)', NULL),
(1543, 'excel_file_informaion', 'EXCEL File Informaion', 'معلومات ملف اكسل'),
(1544, 'upload_excel_file', 'Upload Excel File', NULL),
(1545, 'whatsapp', 'Whatsapp', NULL),
(1546, 'whatsapp_business', 'Whatsapp Business', NULL),
(1547, 'contact_list', 'Contact List', NULL),
(1548, 'template_list', 'Template List', 'قائمة القوالب'),
(1549, 'api_access_settings', 'API Access Settings', 'إعدادات الوصول إلى واجهة برمجة التطبيقات'),
(1550, 'whatsapp_no', 'Whatsapp No', NULL),
(1551, 'access_token', 'Access Token', 'رمز الدخول'),
(1552, 'default_page_size', 'Default Page Size', NULL),
(1553, 'whatsapp_settings', 'Whatsapp Settings', NULL),
(1554, 'updated_successfully', 'Updated Successfully', NULL),
(1555, 'something_went_wrong', 'Something Went Wrong', NULL),
(1556, 'manage_contact_list', 'Manage Contact List', NULL),
(1557, 'add_new_contact', 'Add New Contact', 'إضافة جهة اتصال جديدة'),
(1558, 'full_name', 'Full Name', NULL),
(1559, 'phone_no', 'Phone No', NULL),
(1560, 'create_date', 'Create Date', 'تاريخ الإنشاء'),
(1561, 'customer_list_of_phone', 'Customer List of Phone', NULL),
(1562, 'sent_successfully_to', 'Sent successfully to', NULL),
(1563, 'empty_response', 'Empty response', 'إجابة فارغة'),
(1564, 'add_contact', 'Add Contact', 'اضافة رقم تواصل'),
(1565, 'contact_name_english', 'Contact Name English', 'اسم الاتصال باللغة الإنجليزية'),
(1566, 'contact_name_arabic', 'Contact Name Arabic', 'اسم جهة الاتصال عربي'),
(1567, 'enter_whatsapp_number', 'Enter WhatsApp Number', 'أدخل رقم الواتس اب'),
(1568, 'mobile_number', 'Mobile Number', NULL),
(1569, 'invited_by', 'Invited by', NULL),
(1570, 'name_in_arabic', 'Name in Arabic', NULL),
(1571, 'name_in_english', 'Name in English', NULL),
(1572, 'select_country', 'Select Country', NULL),
(1573, 'phone_country_code', 'Phone Country Code', NULL),
(1574, 'field_must_not_be_empty', 'Field Must Not Be Empty', 'يجب أن لا يكون الحقل فارغًا'),
(1575, 'contact_inserted_successfully', 'Contact Inserted Successfully', NULL),
(1576, 'something_went_wrong', 'Something Went Wrong', NULL),
(1577, 'contact_already_exist', 'contact already exist !', NULL),
(1578, 'enter_customer_email', 'Enter Customer Email', 'أدخل البريد الإلكتروني للعميل'),
(1579, 'email_not_sent', 'Email Not Sent', 'لم يتم إرسال البريد الإلكتروني'),
(1580, 'Whatsapp_templates', 'WhatsApp Templates', NULL),
(1581, 'manage_whatsapp_templates', 'Manage WhatsApp Templates', NULL),
(1582, 'update_templates', 'Update Templates', NULL),
(1627, 'order_title', 'Order Title', NULL),
(1641, 'successfully_returned', 'Successfully Returned', NULL),
(1649, 'order_title', 'Order Title', NULL),
(1663, 'successfully_returned', 'Successfully Returned', NULL),
(1671, 'order_title', 'Order Title', NULL),
(1685, 'successfully_returned', 'Successfully Returned', NULL),
(1693, 'order_title', 'Order Title', NULL),
(1707, 'successfully_returned', 'Successfully Returned', NULL),
(1715, 'order_title', 'Order Title', NULL),
(1729, 'successfully_returned', 'Successfully Returned', NULL),
(1737, 'order_title', 'Order Title', NULL),
(1751, 'successfully_returned', 'Successfully Returned', NULL),
(1759, 'order_title', 'Order Title', NULL),
(1773, 'successfully_returned', 'Successfully Returned', NULL),
(1781, 'order_title', 'Order Title', NULL),
(1795, 'successfully_returned', 'Successfully Returned', NULL),
(1803, 'order_title', 'Order Title', NULL),
(1817, 'successfully_returned', 'Successfully Returned', NULL),
(1825, 'order_title', 'Order Title', NULL),
(1839, 'successfully_returned', 'Successfully Returned', NULL),
(1887, 'loyalty_points', 'Loyalty Points', NULL),
(1888, 'point_settings', 'Point Settings', NULL),
(1889, 'amount_per_point', 'Amount Per Point', 'المبلغ لكل نقطة'),
(1890, 'amount_for_a_point', 'Amount for a point', 'مقدار النقاط'),
(1891, 'points_for_one_money', 'Points for One Money', NULL),
(1892, 'use_loyalty_points', 'Use Loyalty Points', NULL),
(1893, 'current_points', 'Current Points', NULL),
(1894, 'use_points', 'Use Points', NULL),
(1895, 'earn_point_value', 'Earn Point Value', 'كسب قيمة النقطة'),
(1896, 'point_redeem_value', 'Point Redeem Value', NULL),
(1897, 'manage_points', 'Manage Points', NULL),
(1898, 'customers_point_list', 'Customers Point List', NULL),
(1899, 'total_points', 'Total Points', NULL),
(1900, 'available_points', 'Available Points', 'النقاط المتاحة'),
(1901, 'enter_expire_date', 'Enter Expire Date', 'أدخل تاريخ انتهاء الصلاحية'),
(1902, 'warrantee', 'Warrantee', NULL),
(1903, 'please_enter_number_of_months', 'Please enter number of months', NULL),
(1904, 'invoice_wise_warrantee', 'Invoice wise warrantee', NULL),
(1905, 'enter_invoice_number', 'Enter invoice number', 'أدخل رقم الفاتورة'),
(1906, 'warrantee_period_month', 'Warrantee Period(month)', NULL),
(1907, 'warrantee_expiry_date', 'Warrantee Expiry Date', NULL),
(1908, 'expriy_report', 'Expriy Report', NULL),
(1909, 'expire_duration', 'Expire Duration', NULL),
(1910, 'from_date', 'From Date', NULL),
(1911, 'to_date', 'To Date', NULL),
(1912, 'expire_date_from', 'Expire date from', NULL),
(1913, 'expire_date_till', 'Expire date till', NULL),
(1914, 'batch_wise_expire_report', 'Batch Wise Expire Report', NULL),
(1915, 'batch_no', 'Batch No.', NULL),
(1916, 'expire_date', 'Expire Date', NULL),
(1917, 'accounting', 'Accounting', 'المحاسبة'),
(1918, 'chart_of_account', 'Chart of Account', NULL),
(1919, 'opening_balance', 'Opening Balance', NULL),
(1920, 'supplier_payment', 'Supplier Payment', NULL),
(1921, 'customer_receive', 'Customer Receive', NULL),
(1922, 'cash_adjustment', 'Cash Adjustment', NULL),
(1923, 'debit_voucher', 'Debit Voucher', NULL),
(1924, 'credit_voucher', 'Credit Voucher', NULL),
(1925, 'contra_voucher', 'Contra Voucher', NULL),
(1926, 'journal_voucher', 'Journal Voucher', NULL),
(1927, 'voucher_approval', 'Voucher Approval', NULL),
(1928, 'voucher_no', 'Voucher No', NULL),
(1929, 'account_head', 'Account Head', ''),
(1930, 'remark', 'Remark', NULL),
(1931, 'receipt_voucher', 'Receipt Voucher', NULL),
(1932, 'receipt_voucher_form', 'Receipt Voucher Form', NULL),
(1933, 'manage_receipt_voucher', 'Manage Receipt Voucher', NULL),
(1934, 'payment_voucher', 'Payment Voucher', NULL),
(1935, 'payment_voucher_form', 'Payment Voucher Form', NULL),
(1936, 'customer_balance', 'Customer Balance', NULL),
(1937, 'vat', 'Vat', NULL),
(1938, 'total_balance', 'Total Balance', NULL),
(1939, 'remaining_balance', 'Remaining Balance', NULL),
(1940, 'pay_vat', 'Pay Vat', NULL),
(1941, 'pay_amount', 'Pay Amount', NULL),
(1942, 'cash_payment', 'Cash Payment', NULL),
(1943, 'bank_payment', 'Bank Payment', NULL),
(1944, 'adjustment_type', 'Adjustment Type', NULL),
(1945, 'code', 'Code', NULL),
(1946, 'paytype', 'Paytype', NULL),
(1947, 'txtCode', 'TxtCode', NULL),
(1948, 'approved', 'Approved', NULL),
(1949, 'approve', 'Approve', NULL),
(1950, 'credit_account_head', 'Credit Account Head', NULL),
(1951, 'successfully_approved', 'Successfully Approved', NULL),
(1952, 'debit_account_head', 'Debit Account Head', NULL),
(1953, 'add_more', 'Add More', 'اضافة'),
(1954, 'update_debit_voucher', 'Update Debit Voucher', NULL),
(1955, 'update_credit_voucher', 'Update Credit Voucher', NULL),
(1956, 'update_journal_voucher', 'Update Journal Voucher', NULL),
(1957, 'update_contra_voucher', 'Update Contra Voucher', NULL),
(1958, 'customer_head_code', 'Customer Head Code', NULL),
(1959, 'current_balance', 'Current Balance', NULL),
(1960, 'total_vat', 'Total Vat', NULL),
(1961, 'account_reports', 'Account Reports', 'تقارير محاسبية'),
(1962, 'general_ledger', 'General Ledger', NULL),
(1963, 'profit_loss', 'Profit Loss', NULL),
(1964, 'balance_sheet', 'Balance Sheet', NULL),
(1965, 'cash_flow_statement', 'Cash Flow Statement', NULL),
(1966, 'trial_balance', 'Trial Balance', NULL),
(1967, 'reports_by_voucher', 'Reports By Voucher', NULL),
(1968, 'select_voucher_no', 'Select Voucher No', NULL),
(1969, 'voucher_reports', 'Voucher Reports', NULL),
(1970, 'account_code', 'Account Code', 'ترميز الحساب'),
(1971, 'created_date', 'Created Date', NULL),
(1972, 'general_ledger_form', 'General Ledger Form', NULL),
(1973, 'general_ledger_report', 'General Ledger Report', NULL),
(1974, 'transection_date', 'Transection Date', NULL),
(1975, 'head_code', 'Head Code', NULL),
(1976, 'particulars', 'Particulars', NULL),
(1977, 'profit_loss_report', 'Profit Loss Report', NULL),
(1978, 'authorized_signature', 'Authorized Signature', NULL),
(1979, 'trial_balance_with_opening_as_on', 'Trial balance with opening as on', NULL),
(1980, 'opening_cash_and_equivalent', 'Opening Cash and Equivalent', NULL),
(1981, 'trial_balance_without_opening', 'Trial Balance Without Opening', NULL),
(1982, 'trial_balance_with_opening', 'Trial Balance With Opening', NULL),
(1983, 'general_ledger_reports', 'General Ledger Reports', NULL),
(1984, 'another_fiscal_year_exist_in_given_range', 'Another Fiscal Year Exist in Given Date Range!', NULL),
(1985, 'invalid_date_selection', 'Invalid date selection! Please select a date from active fiscal year', NULL),
(1986, 'fields_must_not_be_empty', 'Fields must not be empty!', NULL),
(1987, 'fiscal_year', 'Fiscal Year', NULL),
(1988, 'stock_adjustment_details', 'Stock adjustment details', NULL),
(1989, 'adjustment_id', 'Adjustment Id', NULL),
(1990, 'color_variant', 'Color Variant', NULL),
(1991, 'adjustment_quantity', 'Adjustment Quantity', NULL),
(1992, 'batch_wise_stock', 'Batch Wise Stock', NULL),
(1993, 'stock_report_batch_wise', 'Stock Report (Batch Wise)', NULL),
(1994, 'enter_batch_no', 'Enter Batch No', NULL),
(1995, 'expiry', 'Expiry', NULL),
(1996, 'total_qnty', 'Total Qnty', NULL),
(1997, 'sold_qnty', 'Sold Qnty', NULL),
(1998, 'current_qnty', 'Current Qnty', NULL),
(1999, 'seller_price', 'Seller Price', NULL),
(2000, 'accounting', 'Accounting', 'المحاسبة'),
(2001, 'chart_of_account', 'Chart of Account', NULL),
(2002, 'opening_balance', 'Opening Balance', NULL),
(2003, 'supplier_payment', 'Supplier Payment', NULL),
(2004, 'customer_receive', 'Customer Receive', NULL),
(2005, 'cash_adjustment', 'Cash Adjustment', NULL),
(2006, 'debit_voucher', 'Debit Voucher', NULL),
(2007, 'credit_voucher', 'Credit Voucher', NULL),
(2008, 'contra_voucher', 'Contra Voucher', NULL),
(2009, 'journal_voucher', 'Journal Voucher', NULL),
(2010, 'voucher_approval', 'Voucher Approval', NULL),
(2011, 'voucher_no', 'Voucher No', NULL),
(2012, 'account_head', 'Account Head', NULL),
(2013, 'remark', 'Remark', NULL),
(2014, 'receipt_voucher', 'Receipt Voucher', NULL),
(2015, 'receipt_voucher_form', 'Receipt Voucher Form', NULL),
(2016, 'manage_receipt_voucher', 'Manage Receipt Voucher', NULL),
(2017, 'payment_voucher', 'Payment Voucher', NULL),
(2018, 'payment_voucher_form', 'Payment Voucher Form', NULL),
(2019, 'customer_balance', 'Customer Balance', NULL),
(2020, 'vat', 'Vat', NULL),
(2021, 'total_balance', 'Total Balance', NULL),
(2022, 'remaining_balance', 'Remaining Balance', NULL),
(2023, 'pay_vat', 'Pay Vat', NULL),
(2024, 'pay_amount', 'Pay Amount', NULL),
(2025, 'cash_payment', 'Cash Payment', NULL),
(2026, 'bank_payment', 'Bank Payment', NULL),
(2027, 'adjustment_type', 'Adjustment Type', NULL),
(2028, 'code', 'Code', NULL),
(2029, 'paytype', 'Paytype', NULL),
(2030, 'txtCode', 'TxtCode', NULL),
(2031, 'approved', 'Approved', NULL),
(2032, 'approve', 'Approve', NULL),
(2033, 'credit_account_head', 'Credit Account Head', NULL),
(2034, 'successfully_approved', 'Successfully Approved', NULL),
(2035, 'debit_account_head', 'Debit Account Head', NULL),
(2036, 'add_more', 'Add More', 'اضافة'),
(2037, 'update_debit_voucher', 'Update Debit Voucher', NULL),
(2038, 'update_credit_voucher', 'Update Credit Voucher', NULL),
(2039, 'update_journal_voucher', 'Update Journal Voucher', NULL),
(2040, 'update_contra_voucher', 'Update Contra Voucher', NULL),
(2041, 'customer_head_code', 'Customer Head Code', NULL),
(2042, 'current_balance', 'Current Balance', NULL),
(2043, 'total_vat', 'Total Vat', NULL),
(2044, 'account_reports', 'Account Reports', 'تقارير محاسبية'),
(2045, 'general_ledger', 'General Ledger', NULL),
(2046, 'profit_loss', 'Profit Loss', NULL),
(2047, 'balance_sheet', 'Balance Sheet', NULL),
(2048, 'cash_flow_statement', 'Cash Flow Statement', NULL),
(2049, 'trial_balance', 'Trial Balance', NULL),
(2050, 'reports_by_voucher', 'Reports By Voucher', NULL),
(2051, 'select_voucher_no', 'Select Voucher No', NULL),
(2052, 'voucher_reports', 'Voucher Reports', NULL),
(2053, 'account_code', 'Account Code', 'ترميز الحساب'),
(2054, 'created_date', 'Created Date', NULL),
(2055, 'general_ledger_form', 'General Ledger Form', NULL),
(2056, 'general_ledger_report', 'General Ledger Report', NULL),
(2057, 'transection_date', 'Transection Date', NULL),
(2058, 'head_code', 'Head Code', NULL),
(2059, 'particulars', 'Particulars', NULL),
(2060, 'profit_loss_report', 'Profit Loss Report', NULL),
(2061, 'authorized_signature', 'Authorized Signature', NULL),
(2062, 'trial_balance_with_opening_as_on', 'Trial balance with opening as on', NULL),
(2063, 'opening_cash_and_equivalent', 'Opening Cash and Equivalent', NULL),
(2064, 'trial_balance_without_opening', 'Trial Balance Without Opening', NULL),
(2065, 'trial_balance_with_opening', 'Trial Balance With Opening', NULL),
(2066, 'general_ledger_reports', 'General Ledger Reports', NULL),
(2068, 'invalid_date_selection', 'Invalid date selection! Please select a date from active fiscal year', NULL),
(2069, 'fields_must_not_be_empty', 'Fields must not be empty!', NULL),
(2071, 'purchase_return', 'Purchase Return', NULL),
(2072, 'manage_purchase_return', 'Manage Purchase Return', NULL),
(2073, 'purchase_return_form', 'Purchase Return Form', NULL),
(2074, 'return_information', 'Return Information', NULL),
(2075, 'return_ledger', 'Return Ledger', NULL),
(2076, 'return_quantity', 'Return Quantity', NULL),
(2077, 'purchase_return_details', 'Purchase Return Details', NULL),
(2078, 'return_date', 'Return Date', NULL),
(2079, 'purchase_quantity', 'Purchase Quantity', NULL),
(2080, 'return_purchase', 'Return Purchase', NULL),
(2081, 'edit_purchase_return', 'Edit Purchase Return', NULL),
(2082, 'edit_purchase_return_form', 'Edit purchase return form', NULL),
(2083, 'purchase_return_edit', 'Purchase return edit', NULL),
(2084, 'return_details', 'Return Details', NULL),
(2085, 'invoice_date', 'Invoice date', NULL),
(2086, 'stock_adjustment_form', 'Stock Adjustment Form', NULL),
(2087, 'adjusted_quantity', 'Adjusted Quantity', NULL),
(2088, 'please_select_store_first', 'Please select store first', NULL),
(2089, 'increase', 'Increase', NULL),
(2090, 'decrease', 'Decrease', NULL),
(2091, 'manage_stock_adjustment', 'Manage Stock Adjustment', NULL),
(2092, 'create_invoice', 'Create Invoice', NULL),
(2093, 'create_invoice_form', 'Create Invoice Form', NULL),
(2095, 'purchase_return', 'Purchase Return', NULL),
(2096, 'manage_purchase_return', 'Manage Purchase Return', NULL),
(2097, 'purchase_return_form', 'Purchase Return Form', NULL),
(2098, 'transfer_product', 'Transfer Product', NULL),
(2099, 'transfer_list', 'Transfer List', NULL),
(2100, 'transfer_from', 'Transfer From', NULL),
(2101, 'transfer', 'Transfer', NULL),
(2102, 'new_request', 'New Request', NULL),
(2103, 'manage_transfer_request', 'Manage Transfer Request', NULL),
(2104, 'received_transfer_request', 'Received Transfer Request', NULL),
(2105, 'transfer_id', 'Transfer ID', NULL),
(2106, 'not_approved', 'Not Approved', NULL),
(2107, 'collected', 'Collected', NULL),
(2108, 'import_product_api', 'Import Product (API)', NULL),
(2109, 'import_product', 'Import Product', NULL),
(2110, 'import_category', 'Import Category', NULL),
(2111, 'import_brand', 'Import Brand', NULL),
(2112, 'import_variant', 'Import Variant', NULL),
(2113, 'customer_name_or_phone', 'Customer Name/Phone', NULL),
(2117, 'return_order', 'Return Order', NULL),
(2118, 'manage_return_order', 'Manage Return Order', NULL),
(2119, 'return_refund', 'Return & Refund', NULL),
(2120, 'manage_return_refund', 'Manage Return & Refund', NULL),
(2121, 'request_return', 'Request Return', NULL),
(2122, 'request', 'Request', NULL),
(2123, 'order_title', 'Order Title', NULL),
(2124, 'select_all', 'Select All', NULL),
(2125, 'product_name', 'Product Name', NULL),
(2126, 'notes', 'Notes', NULL),
(2127, 'manage_return_request', 'Manage Return Request', NULL),
(2128, 'order_id', 'Order Id', NULL),
(2129, 'variants', 'Variants', NULL),
(2130, 'variant_colors', 'Variant Colors', NULL),
(2131, 'successfully_deleted', 'Successfully Deleted', NULL),
(2132, 'manager_return_request', 'Manager Return Request', NULL),
(2133, 'completed', 'Completed', NULL),
(2134, 'cancelled', 'Cancelled', NULL),
(2135, 'return_refund', 'Return & Refund', NULL),
(2136, 'manage_return_refund', 'Manage Return Refund', NULL),
(2137, 'successfully_returned', 'Successfully Returned', NULL),
(2138, 'return_request', 'Return Request', NULL),
(2139, 'invoice_return', 'Invoice Return', NULL),
(2140, 'manage_invoice_return', 'Manage invoice return', NULL),
(2141, 'already_requested', 'Already Requested', NULL),
(2142, 'returned', 'Returned', NULL),
(2143, 'wastage', 'Wastage', NULL),
(2144, 'wastage_request', 'Wastage Request', NULL),
(2145, 'manage_wastage_request', 'Manage Wastage Request', NULL),
(2174, 'mastercard_settings', 'Mastercard Settings', NULL),
(2175, 'mastercard', 'Mastercard', NULL),
(2176, 'mastercard_settings_form', 'Mastercard settings form', NULL),
(2177, 'merchant_id', 'Merchant Id', NULL),
(2178, 'operatior_id', 'Operatior Id', NULL),
(2179, 'operator_password', 'Operator password', NULL),
(2180, 'token_password', 'Token Password', NULL),
(2181, 'getway_status', 'Get-way Status', NULL),
(2182, 'pricing', 'pricing', 'التسعير'),
(2183, 'please_select_currency', 'Please Select Currency', 'برجاء تحديد العملة');

-- --------------------------------------------------------

--
-- Table structure for table `language_config`
--

CREATE TABLE `language_config` (
  `id` int(11) NOT NULL,
  `language` varchar(100) NOT NULL,
  `direction` enum('ltr','rtl') DEFAULT 'ltr'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language_config`
--

INSERT INTO `language_config` (`id`, `language`, `direction`) VALUES
(1, 'english', 'ltr'),
(4, 'arabic', 'rtl'),
(5, 'urdo', 'rtl'),
(6, 'franais', 'ltr'),
(7, 'french', 'ltr');

-- --------------------------------------------------------

--
-- Table structure for table `link_page`
--

CREATE TABLE `link_page` (
  `link_page_id` varchar(100) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `language_id` varchar(255) NOT NULL,
  `headlines` text,
  `image` text,
  `details` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link_page`
--

INSERT INTO `link_page` (`link_page_id`, `page_id`, `language_id`, `headlines`, `image`, `details`, `status`) VALUES
('1O7RLB4BQ1HR94K', '3', 'bangla', '', 'my-assets/image/link_page/8f5013440d835b56c55867a9125f0e4c.jpg', '', 1),
('E3XOZ4N7DM8IG4P', '1', 'english', '<p>ABOUT US<br></p>', 'my-assets/image/link_page/2eaa2ed9eee24c9c08feb568d26f54e7.jpg', '<p><span xss=removed>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span><br></p>', 1),
('PQA7JY6HKXTHW81', '1', 'bangla', '<p><br></p>', 'my-assets/image/link_page/2eaa2ed9eee24c9c08feb568d26f54e7.jpg', '<p><br></p>', 1),
('SCHKM9YIFLEJ7OV', '3', 'english', '<p>Delivery Infomation<br></p>', 'my-assets/image/link_page/8f5013440d835b56c55867a9125f0e4c.jpg', '<p>we are trying to deliver our product  very short time<br></p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL,
  `sender_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=seen, 2=delete',
  `receiver_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=seen, 2=delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `directory` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES
(49, 'Accounting', 'Isshue system accounting', 'application/modules/accounting/assets/images/thumbnail.jpg', 'accounting', 1),
(51, 'Human Resource', 'Isshue system hrm', 'application/modules/hrm/assets/images/thumbnail.jpg', 'hrm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_permission`
--

CREATE TABLE `module_permission` (
  `id` int(11) NOT NULL,
  `fk_module_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `create` tinyint(1) DEFAULT NULL,
  `read` tinyint(1) DEFAULT NULL,
  `update` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_delivery`
--

CREATE TABLE `order_delivery` (
  `order_delivery_id` varchar(255) NOT NULL,
  `delivery_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `details` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

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
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_payment`
--

CREATE TABLE `order_payment` (
  `order_payment_id` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `details` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_tax_col_details`
--

CREATE TABLE `order_tax_col_details` (
  `order_tax_col_de_id` varchar(100) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `variant_id` varchar(100) NOT NULL,
  `tax_id` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_tax_col_summary`
--

CREATE TABLE `order_tax_col_summary` (
  `order_tax_col_id` varchar(100) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `tax_id` varchar(100) NOT NULL,
  `tax_amount` float NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `our_location`
--

CREATE TABLE `our_location` (
  `location_id` int(11) NOT NULL,
  `language_id` varchar(255) NOT NULL,
  `headline` text NOT NULL,
  `details` text NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `our_location`
--

INSERT INTO `our_location` (`location_id`, `language_id`, `headline`, `details`, `position`, `status`) VALUES
(1, 'english', 'Head Office Location <br>', '<p>We sell our product all over the world . <br></p>', 1, 1),
(2, 'bangla', '', '', 1, 1),
(3, 'english', '<p>Africa </p>', '<p>our second location at Cameroon in Africa.<br></p>', 2, 1),
(4, 'bangla', '', '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pad_print_setting`
--

CREATE TABLE `pad_print_setting` (
  `id` int(11) NOT NULL,
  `header` int(11) NOT NULL,
  `footer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payeer_payments`
--

CREATE TABLE `payeer_payments` (
  `id` int(11) NOT NULL,
  `m_operation_id` int(11) NOT NULL,
  `m_operation_ps` int(11) NOT NULL,
  `m_operation_date` varchar(100) NOT NULL,
  `m_operation_pay_date` varchar(100) NOT NULL,
  `m_shop` int(11) NOT NULL,
  `m_orderid` varchar(300) NOT NULL,
  `m_amount` varchar(100) NOT NULL,
  `m_curr` varchar(100) NOT NULL,
  `m_desc` varchar(300) NOT NULL,
  `m_status` varchar(100) NOT NULL,
  `m_sign` mediumtext NOT NULL,
  `lang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `transection_id` varchar(200) NOT NULL,
  `tracing_id` varchar(200) NOT NULL,
  `account_id` varchar(200) NOT NULL,
  `store_id` varchar(200) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  `date` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway`
--

CREATE TABLE `payment_gateway` (
  `id` int(11) NOT NULL,
  `used_id` int(11) NOT NULL,
  `module_id` varchar(100) DEFAULT NULL,
  `agent` varchar(100) NOT NULL,
  `public_key` varchar(100) NOT NULL,
  `private_key` varchar(100) NOT NULL,
  `shop_id` varchar(100) NOT NULL,
  `secret_key` varchar(100) NOT NULL,
  `paypal_email` varchar(250) DEFAULT NULL,
  `paypal_client_id` text,
  `r_pay_marchantid` varchar(100) DEFAULT NULL,
  `r_pay_password` varchar(100) DEFAULT NULL,
  `r_pay_email` varchar(100) DEFAULT NULL,
  `currency` text,
  `is_live` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=live,0=sandbox',
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_gateway`
--

INSERT INTO `payment_gateway` (`id`, `used_id`, `module_id`, `agent`, `public_key`, `private_key`, `shop_id`, `secret_key`, `paypal_email`, `paypal_client_id`, `r_pay_marchantid`, `r_pay_password`, `r_pay_email`, `currency`, `is_live`, `image`, `status`) VALUES
(1, 3, NULL, 'Bitcoin', '22592AAtNOwwBitcoin77BTCPUBzo4PVkUmYCa2dR770wNNstd', '22592AAtNOwwBitcoin77BTCPRVk7hmp8s3ew6pwgOMgxMq81F', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'my-assets/image/bitcoin.png', 2),
(2, 4, NULL, 'Payeer', '', '', '514435930', 'JH8LZUHCNrtHhlRW', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'my-assets/image/payeer.png', 2),
(3, 5, NULL, 'Paypal', '', '', '', '', 'business@gmail.com', '', NULL, NULL, NULL, 'USD', 0, 'my-assets/image/paypal.png', 2),
(4, 6, NULL, 'sslcommerz\r\n', '', '', 'style5c246d140fefc', 'style5c246d140fefc@ssl', 'shemul.rabbani@gmail.com', NULL, NULL, NULL, NULL, 'BDT', 0, 'my-assets/image/sslcommerz.png', 2),
(5, 2, NULL, 'razorpay', '', '', '', '', NULL, NULL, 'rzp_test_2hEj93EL0gFSAp', 'EpfQnpGGOd71Ub44IUcXaVgv', '', 'INR', 0, 'application/modules/rozarpay/assets/images/razorpay_logo_black.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `pay_method` varchar(20) DEFAULT NULL,
  `used_id` varchar(20) DEFAULT NULL,
  `customer_id` varchar(100) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `order_no` varchar(30) NOT NULL,
  `trans_id` varchar(100) DEFAULT NULL,
  `amount` float(10,2) NOT NULL DEFAULT '0.00',
  `store_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(20) DEFAULT NULL,
  `trans_date` varchar(100) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pay_withs`
--

CREATE TABLE `pay_withs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pay_withs`
--

INSERT INTO `pay_withs` (`id`, `title`, `image`, `link`, `status`, `created_at`, `updated_at`) VALUES
(2, 'mastercard', '54e64b679aeba35bb2888d303342b75b.png', 'http://bdtask.com', 1, '2018-12-31 17:39:14', '2022-07-14 14:09:05'),
(5, 'visa', 'ab52aa6b0653710cdd75ce58d2faf7ab.png', 'https://visa.com', 1, '2019-01-01 08:14:38', '2022-07-14 14:09:05'),
(6, 'paypal', '56e595d709a8a4d500b7e893a51acc0c.png', 'https://paypal.com', 1, '2019-01-01 08:24:35', '2022-07-14 14:09:05'),
(7, 'bkash', '15d320188b47f3f8f00866a26dd88403.jpg', 'https://bkash.com', 1, '2018-12-10 10:22:39', '2022-07-14 14:09:05'),
(8, 'rocket', 'dd6425bd07943dcc90698b3d0e81187f.jpeg', 'http://rocket.com', 1, '2019-03-08 11:04:19', '2022-07-14 14:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `personal_loan`
--

CREATE TABLE `personal_loan` (
  `per_loan_id` int(11) NOT NULL,
  `transaction_id` varchar(30) NOT NULL,
  `person_id` varchar(30) NOT NULL,
  `debit` decimal(12,2) DEFAULT '0.00',
  `credit` decimal(12,2) NOT NULL DEFAULT '0.00',
  `date` varchar(30) NOT NULL,
  `details` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=no paid,2=paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `person_information`
--

CREATE TABLE `person_information` (
  `id` int(11) NOT NULL,
  `person_id` varchar(50) NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `person_phone` varchar(50) NOT NULL,
  `person_address` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `person_ledger`
--

CREATE TABLE `person_ledger` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `person_id` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `debit` decimal(12,2) NOT NULL DEFAULT '0.00',
  `credit` decimal(12,2) NOT NULL DEFAULT '0.00',
  `details` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=no paid,2=paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pesonal_loan_information`
--

CREATE TABLE `pesonal_loan_information` (
  `id` int(11) NOT NULL,
  `person_id` varchar(50) NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `person_phone` varchar(30) NOT NULL,
  `person_address` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pricing_types`
--

CREATE TABLE `pricing_types` (
  `pri_type_id` int(11) NOT NULL,
  `pri_type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pricing_types`
--

INSERT INTO `pricing_types` (`pri_type_id`, `pri_type_name`) VALUES
(1, 'Wholesale price'),
(2, 'Customer price');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_types_product`
--

CREATE TABLE `pricing_types_product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `pri_type_id` int(11) NOT NULL,
  `product_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pricing_types_product`
--

INSERT INTO `pricing_types_product` (`id`, `product_id`, `pri_type_id`, `product_price`) VALUES
(30, '58223221', 2, 600),
(31, '58223221', 1, 550),
(32, '31152612', 2, 500),
(33, '31152612', 1, 450);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` varchar(255) NOT NULL,
  `parent_category_id` varchar(255) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `top_menu` int(11) DEFAULT NULL,
  `menu_pos` int(11) DEFAULT NULL,
  `cat_image` text,
  `cat_favicon` text,
  `cat_type` int(11) DEFAULT NULL COMMENT '1=parent,2=sub caregory',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `parent_category_id`, `category_name`, `top_menu`, `menu_pos`, `cat_image`, `cat_favicon`, `cat_type`, `status`) VALUES
('58B9925CNZVP3IV', '', 'CLIP ON - BOX', 1, 1, 'my-assets/image/category/9e7e0275788095ebcf78f36bd6e63ebb.png', 'my-assets/image/category/24b75eea7336a09ba6b955b360b68cbc.png', 1, 1),
('8R2IU8QPOMXHP6P', '', 'EYEWEAR', 1, 1, 'my-assets/image/category.png', 'my-assets/image/category.png', 1, 1),
('CVZAD4DOPN8PQB8', 'NZUN74MS3GP8QAV', 'Ntest', 1, 0, 'my-assets/image/category/aec0009627c1a1c222bb3a86d5597816.jpg', 'my-assets/image/category/19d7534e07621fdf3dfbb524ca31ca64.jpg', 2, 1),
('NZUN74MS3GP8QAV', '', 'ACCESSORIES', 1, 1, 'my-assets/image/category/c5ba26c3c026407c7c8aaa98bf43a3b2.png', 'my-assets/image/category/0516faac10d9608d4b63d9f398b65107.png', 1, 1),
('OPIYH2SKJGL3TQL', '', 'READING', 1, 1, 'my-assets/image/category/cfc1414334969d39afe655058c24f2dc.png', 'my-assets/image/category/d884770ff4030b33e5498b397c0840ed.png', 1, 1),
('TMUAZSTV94N429V', '', 'CLIP ON ', 1, 1, 'my-assets/image/category/ff6521b385461219dc7eb8909bacd0a7.png', 'my-assets/image/category/89ba5364aadd2e393eeebe67cfeda366.png', 1, 1),
('XJIMM9X3ZAWUYXQ', '', 'SUNGLASSES', 1, 1, 'my-assets/image/category.png', 'my-assets/image/category.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_information`
--

CREATE TABLE `product_information` (
  `id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `bar_code` varchar(100) DEFAULT NULL,
  `code` varchar(200) DEFAULT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `warrantee` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `supplier_price` float DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `product_model` varchar(100) DEFAULT NULL,
  `product_details` longtext,
  `image_thumb` text,
  `brand_id` varchar(255) DEFAULT NULL,
  `pricing` tinyint(1) NOT NULL DEFAULT '0',
  `assembly` tinyint(1) NOT NULL DEFAULT '0',
  `variants` text,
  `default_variant` varchar(255) DEFAULT NULL,
  `variant_price` tinyint(1) DEFAULT '0',
  `type` text,
  `best_sale` int(11) DEFAULT '0',
  `onsale` int(11) DEFAULT '0',
  `onsale_price` float DEFAULT NULL,
  `invoice_details` text,
  `image_large_details` text,
  `review` text,
  `description` text,
  `tag` text,
  `specification` text,
  `video` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `open_quantity` int(11) NOT NULL DEFAULT '0',
  `open_rate` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_information`
--

INSERT INTO `product_information` (`id`, `product_id`, `bar_code`, `code`, `supplier_id`, `category_id`, `warrantee`, `product_name`, `price`, `supplier_price`, `unit`, `product_model`, `product_details`, `image_thumb`, `brand_id`, `pricing`, `assembly`, `variants`, `default_variant`, `variant_price`, `type`, `best_sale`, `onsale`, `onsale_price`, `invoice_details`, `image_large_details`, `review`, `description`, `tag`, `specification`, `video`, `created_at`, `status`, `open_quantity`, `open_rate`) VALUES
(19, '31152612', '', NULL, 'JULIS4O2ZYISG49EHHH3', 'XJIMM9X3ZAWUYXQ', 0, 'LOUIS MOREL CR0006', 500, 400, 'PQM2NHKOT9XZXF3', 'CR0006', '', 'my-assets/image/product/thumb/9e989412d0e40e5cbd4fc4ef52663f3c.png', '', 1, 0, 'TB65YJWEK95Y4P2,', 'TB65YJWEK95Y4P2', 0, '', 0, 0, NULL, '', 'my-assets/image/product/9e989412d0e40e5cbd4fc4ef52663f3c.png', '', '', '', '', '', NULL, 1, 0, 400),
(20, '58223221', '', NULL, 'JULIS4O2ZYISG49EHHH3', 'XJIMM9X3ZAWUYXQ', 0, 'LOUIS MOREL CR0008', 600, 400, 'PQM2NHKOT9XZXF3', 'CR0008', '', 'my-assets/image/product/thumb/7d6c09e2cea7454db023eee330c15ef7.png', 'EZERMV9PGMOJ97Q', 1, 0, 'TB65YJWEK95Y4P2,', 'TB65YJWEK95Y4P2', 0, '', 0, 0, NULL, '', 'my-assets/image/product/7d6c09e2cea7454db023eee330c15ef7.png', '', '', '', '', '', NULL, 1, 0, 400);

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase`
--

CREATE TABLE `product_purchase` (
  `purchase_id` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `pur_order_no` varchar(100) DEFAULT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `def_currency_id` varchar(255) NOT NULL,
  `currency_id` varchar(255) NOT NULL,
  `conversion_rate` float NOT NULL,
  `wearhouse_id` varchar(255) DEFAULT NULL,
  `sub_total_price` float DEFAULT NULL,
  `total_items` int(11) DEFAULT NULL,
  `purchase_vat` float DEFAULT NULL,
  `total_purchase_vat` float DEFAULT NULL,
  `total_purchase_dis` float DEFAULT NULL,
  `grand_total_amount` float NOT NULL,
  `purchase_date` varchar(50) NOT NULL,
  `purchase_details` text NOT NULL,
  `purchase_expences` float NOT NULL DEFAULT '0',
  `user_id` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_purchase`
--

INSERT INTO `product_purchase` (`purchase_id`, `invoice_no`, `pur_order_no`, `supplier_id`, `store_id`, `def_currency_id`, `currency_id`, `conversion_rate`, `wearhouse_id`, `sub_total_price`, `total_items`, `purchase_vat`, `total_purchase_vat`, `total_purchase_dis`, `grand_total_amount`, `purchase_date`, `purchase_details`, `purchase_expences`, `user_id`, `status`, `invoice`, `created_at`) VALUES
('8IBKVRXFISUNE6W', 'hukyfuiukyu8', NULL, '2KC5UJS472BA6JKYMCZG', 'ZAACM94HLFHE74R', 'I3ENJZL5NUU4EHR', '5O2VW2IFRBF1ULM', 3.03, '', 0, 1, NULL, 0, 0, 0, '08-09-2022', 'huijlkn', 303, '1', 1, 'Inv-1000', '2022-08-09 06:42:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase_details`
--

CREATE TABLE `product_purchase_details` (
  `purchase_detail_id` varchar(100) NOT NULL,
  `purchase_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `variant_id` varchar(100) NOT NULL,
  `variant_color` varchar(30) DEFAULT NULL,
  `batch_no` varchar(30) DEFAULT NULL,
  `expiry_date` varchar(30) DEFAULT NULL,
  `store_id` varchar(100) DEFAULT NULL,
  `wearhouse_id` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `rate` float NOT NULL,
  `discount` float DEFAULT '0',
  `rate_after_discount` float DEFAULT NULL,
  `rate_after_exp` float DEFAULT NULL,
  `rate_after_sunvat` float DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `vat_rate` float DEFAULT NULL,
  `vat` float DEFAULT NULL,
  `total_amount` float NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase_return`
--

CREATE TABLE `product_purchase_return` (
  `purchase_return_id` int(11) NOT NULL,
  `purchase_id` varchar(50) DEFAULT NULL,
  `supplier_id` varchar(50) DEFAULT NULL,
  `store_id` varchar(50) DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `details` text,
  `returned_by` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase_return_details`
--

CREATE TABLE `product_purchase_return_details` (
  `id` int(11) NOT NULL,
  `return_id` varchar(50) DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `variant_id` varchar(50) DEFAULT NULL,
  `variant_color` varchar(50) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `purchase_quantity` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `total_return_amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `product_review_id` varchar(100) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `reviewer_id` varchar(255) DEFAULT NULL,
  `comments` text,
  `rate` varchar(100) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_translation`
--

CREATE TABLE `product_translation` (
  `trans_id` int(11) NOT NULL,
  `language` varchar(50) DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `trans_name` varchar(255) DEFAULT NULL,
  `trans_details` text,
  `trans_description` text,
  `trans_specification` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_translation`
--

INSERT INTO `product_translation` (`trans_id`, `language`, `product_id`, `trans_name`, `trans_details`, `trans_description`, `trans_specification`) VALUES
(82, '', '58223221', '', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        '),
(83, '', '31152612', '', '                                                                                                                                                                                                                                                                                                                                                                                                                                          ', '                                                                                                                                                                                                                                                                                                                                                                                                                                          ', '                                                                                                                                                                                                                                                                                                                                                                                                                                          ');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `product_id` varchar(100) DEFAULT NULL,
  `var_size_id` varchar(30) DEFAULT NULL,
  `var_color_id` varchar(30) DEFAULT NULL,
  `price` double(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `proof_of_purchase_expese`
--

CREATE TABLE `proof_of_purchase_expese` (
  `id` int(11) NOT NULL,
  `purchase_id` varchar(100) NOT NULL,
  `expense_title` varchar(255) DEFAULT NULL,
  `purchase_expense` float DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proof_of_purchase_expese`
--

INSERT INTO `proof_of_purchase_expese` (`id`, `purchase_id`, `expense_title`, `purchase_expense`, `payment_method`) VALUES
(5, '8IBKVRXFISUNE6W', 'knmkj', 303, 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `pur_order_id` int(11) NOT NULL,
  `pur_order_no` varchar(100) NOT NULL,
  `invoice_no` varchar(30) DEFAULT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `store_id` varchar(255) DEFAULT NULL,
  `def_currency_id` varchar(255) NOT NULL,
  `currency_id` varchar(255) NOT NULL,
  `conversion_rate` float NOT NULL,
  `purchase_vat` float DEFAULT '0',
  `total_purchase_vat` float DEFAULT NULL,
  `total_purchase_dis` float DEFAULT NULL,
  `total_purchase_dis_rc` float DEFAULT '0',
  `sub_total_price` float DEFAULT NULL,
  `total_items` int(11) DEFAULT NULL,
  `grand_total_amount` float NOT NULL,
  `purchase_date` date NOT NULL,
  `supply_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `purchase_details` text NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `approve_status` tinyint(1) NOT NULL,
  `receive_status` tinyint(1) NOT NULL,
  `return_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_details`
--

CREATE TABLE `purchase_order_details` (
  `pur_order_detail_id` varchar(100) NOT NULL,
  `pur_order_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `variant_id` varchar(100) NOT NULL,
  `variant_color` varchar(30) DEFAULT NULL,
  `batch_no` varchar(30) DEFAULT NULL,
  `expiry_date` varchar(40) DEFAULT NULL,
  `store_id` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `rate` float NOT NULL,
  `rate_after_discount` float NOT NULL,
  `discount` float DEFAULT '0',
  `vat_rate` float DEFAULT NULL,
  `vat` float DEFAULT NULL,
  `total_amount` float NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_receive`
--

CREATE TABLE `purchase_order_receive` (
  `id` int(11) NOT NULL,
  `pur_order_detail_id` varchar(30) NOT NULL,
  `pur_order_id` varchar(100) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `rc_quantity` int(11) NOT NULL,
  `rc_rate` float NOT NULL,
  `rc_rate_after_discount` float NOT NULL,
  `rc_total_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_return`
--

CREATE TABLE `purchase_order_return` (
  `pur_order_detail_id` varchar(30) NOT NULL,
  `pur_order_id` varchar(100) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `rt_quantity` int(11) NOT NULL,
  `rt_rate` float NOT NULL,
  `rt_total_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_stock_tbl`
--

CREATE TABLE `purchase_stock_tbl` (
  `stock_id` int(11) NOT NULL,
  `store_id` varchar(20) DEFAULT NULL,
  `product_id` varchar(20) DEFAULT NULL,
  `variant_id` varchar(20) DEFAULT NULL,
  `variant_color` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `warehouse_id` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_stock_tbl`
--

INSERT INTO `purchase_stock_tbl` (`stock_id`, `store_id`, `product_id`, `variant_id`, `variant_color`, `quantity`, `warehouse_id`, `created_at`, `updated_at`) VALUES
(7, 'ZAACM94HLFHE74R', '32429942', 'KH7HNYZAOFVWQQK', NULL, 108, '', '2022-08-09 15:59:56', '2022-08-09 16:30:04'),
(8, 'ZAACM94HLFHE74R', '69419565', 'KH7HNYZAOFVWQQK', '', 1, '', '2022-08-09 16:42:47', NULL),
(9, 'ZAACM94HLFHE74R', '', 'JYBYUBWL14AYYGR', NULL, 0, '', '2022-10-13 14:44:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `quotation_id` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `store_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `expire_date` varchar(100) DEFAULT NULL,
  `total_amount` float NOT NULL,
  `quotation` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `total_discount` float DEFAULT NULL,
  `quotation_discount` float NOT NULL COMMENT 'total_discount + quotation_discount',
  `service_charge` float DEFAULT NULL,
  `paid_amount` float NOT NULL,
  `due_amount` float NOT NULL,
  `file_path` text,
  `status` int(11) NOT NULL COMMENT '1=not_invoice,2=invoiced',
  `is_quotation` tinyint(1) DEFAULT '0',
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_details`
--

CREATE TABLE `quotation_details` (
  `quotation_details_id` varchar(100) NOT NULL,
  `quotation_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `variant_id` varchar(100) NOT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `variant_color` varchar(50) DEFAULT NULL,
  `store_id` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` float NOT NULL,
  `supplier_rate` float DEFAULT NULL,
  `total_price` float NOT NULL,
  `discount` float DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_installment`
--

CREATE TABLE `quotation_installment` (
  `id` int(11) NOT NULL,
  `quotation_id` varchar(100) NOT NULL,
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_tax_col_details`
--

CREATE TABLE `quotation_tax_col_details` (
  `quot_tax_col_de_id` varchar(100) NOT NULL,
  `quotation_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `variant_id` varchar(100) NOT NULL,
  `tax_id` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_tax_col_summary`
--

CREATE TABLE `quotation_tax_col_summary` (
  `quot_tax_col_id` varchar(100) NOT NULL,
  `quotation_id` varchar(100) NOT NULL,
  `tax_id` varchar(100) NOT NULL,
  `tax_amount` float NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `received`
--

CREATE TABLE `received` (
  `transection_id` varchar(200) NOT NULL,
  `customer_id` varchar(200) NOT NULL,
  `account_id` varchar(200) NOT NULL,
  `store_id` varchar(200) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salary_sheet_generate`
--

CREATE TABLE `salary_sheet_generate` (
  `ssg_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `gdate` varchar(30) DEFAULT NULL,
  `start_date` varchar(30) NOT NULL,
  `end_date` varchar(30) NOT NULL,
  `generate_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salary_type`
--

CREATE TABLE `salary_type` (
  `salary_type_id` int(11) NOT NULL,
  `sal_name` varchar(100) NOT NULL,
  `salary_type` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `search_history`
--

CREATE TABLE `search_history` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `results` int(11) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sec_menu_item`
--

CREATE TABLE `sec_menu_item` (
  `menu_id` int(11) NOT NULL,
  `menu_title` varchar(200) DEFAULT NULL,
  `page_url` varchar(250) DEFAULT NULL,
  `module` varchar(200) DEFAULT NULL,
  `parent_menu` int(11) DEFAULT NULL,
  `actions` varchar(10) DEFAULT '1111' COMMENT 'Create,Read,Update,Delete',
  `is_report` tinyint(1) DEFAULT '0',
  `createby` int(11) DEFAULT '1',
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sec_menu_item`
--

INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `parent_menu`, `actions`, `is_report`, `createby`, `createdate`) VALUES
(1, 'dashboard', NULL, 'dashboard', NULL, '1111', 0, 1, '2021-02-18 14:36:57'),
(2, 'sales', NULL, 'sales', NULL, '0100', 0, 1, '2021-02-18 14:40:13'),
(3, 'new_sale', NULL, 'sales', 2, '1000', 0, 1, '2021-02-18 14:43:30'),
(4, 'manage_sale', NULL, 'sales', 2, '0111', 0, 1, '2021-02-18 14:43:30'),
(5, 'pos_sale', NULL, 'sales', 2, '1111', 0, 1, '2021-02-18 14:43:30'),
(6, 'order', NULL, 'order', NULL, '0100', 0, 1, '2021-02-18 14:52:22'),
(7, 'new_order', NULL, 'order', 6, '1000', 0, 1, '2021-02-18 14:56:45'),
(8, 'manage_order', NULL, 'order', 6, '0111', 0, 1, '2021-02-18 14:56:45'),
(9, 'product', NULL, 'product', NULL, '0100', 0, 1, '2021-02-18 14:59:17'),
(10, 'add_product', NULL, 'product', 9, '1000', 0, 1, '2021-02-18 14:59:17'),
(11, 'import_product_csv', NULL, 'product', 9, '1100', 0, 1, '2021-02-18 14:59:17'),
(12, 'manage_product', NULL, 'product', 0, '0111', 0, 1, '2021-02-18 14:59:17'),
(13, 'product_ledger', NULL, 'product', 9, '0100', 0, 1, '2021-02-18 14:59:17'),
(14, 'customer', NULL, 'customer', NULL, '0100', 0, 1, '2021-02-18 15:09:08'),
(15, 'add_customer', NULL, 'customer', 14, '1000', 0, 1, '2021-02-18 15:37:22'),
(16, 'manage_customer', NULL, 'customer', 14, '0111', 0, 1, '2021-02-18 15:37:22'),
(17, 'customer_ledger', NULL, 'customer', 14, '0100', 0, 1, '2021-02-18 15:37:22'),
(18, 'supplier', NULL, 'supplier', NULL, '0100', 0, 1, '2021-02-18 15:41:08'),
(19, 'add_supplier', NULL, 'supplier', 18, '1000', 0, 1, '2021-02-18 15:41:08'),
(20, 'manage_supplier', NULL, 'supplier', 18, '0111', 0, 1, '2021-02-18 15:41:08'),
(21, 'supplier_ledger', NULL, 'supplier', 18, '0100', 0, 1, '2021-02-18 15:41:08'),
(22, 'purchase', NULL, 'purchase', NULL, '0100', 0, 1, '2021-02-18 15:47:11'),
(23, 'add_purchase', NULL, 'purchase', 22, '1000', 0, 1, '2021-02-18 15:47:50'),
(24, 'manage_purchase', NULL, 'purchase', 22, '0111', 0, 1, '2021-02-18 15:47:50'),
(25, 'category', NULL, 'category', NULL, '0100', 0, 1, '2021-02-18 15:49:37'),
(26, 'add_category', NULL, 'category', 25, '1000', 0, 1, '2021-02-18 15:49:37'),
(27, 'import_category_csv', NULL, 'category', 25, '1100', 0, 1, '2021-02-18 15:49:37'),
(28, 'manage_category', NULL, 'category', 25, '0111', 0, 1, '2021-02-18 15:49:37'),
(29, 'brand', NULL, 'brand', NULL, '0100', 0, 1, '2021-02-18 16:03:02'),
(30, 'add_brand', NULL, 'brand', 29, '0111', 0, 1, '2021-02-18 16:03:02'),
(31, 'manage_brand', NULL, 'brand', 29, '0111', 0, 1, '2021-02-18 16:03:02'),
(32, 'variant', NULL, 'variant', NULL, '0100', 0, 1, '2021-02-18 16:08:57'),
(33, 'add_variant', NULL, 'variant', 32, '1000', 0, 1, '2021-02-18 16:08:57'),
(34, 'manage_variant', NULL, 'variant', 32, '0111', 0, 1, '2021-02-18 16:08:57'),
(35, 'Unit', NULL, 'Unit', NULL, '0100', 0, 1, '2021-02-18 16:08:57'),
(36, 'add_unit', NULL, 'unit', 35, '1000', 0, 1, '2021-02-18 16:17:39'),
(37, 'manage_unit', NULL, 'unit', 35, '0111', 0, 1, '2021-02-18 16:17:39'),
(38, 'product_image_gallery', NULL, 'product_image_gallery', NULL, '0100', 0, 1, '2021-02-18 16:22:06'),
(39, 'add_product_image', NULL, 'product_image_gallery', 38, '1000', 0, 1, '2021-02-18 16:22:06'),
(40, 'manage_product_image', NULL, 'product_image_gallery', 38, '0111', 0, 1, '2021-02-18 16:22:06'),
(41, 'tax', NULL, 'tax', NULL, '0100', 0, 1, '2021-02-18 16:23:51'),
(42, 'tax_product_service', NULL, 'tax', 41, '1100', 0, 1, '2021-02-18 16:26:09'),
(43, 'manage_product_tax', NULL, 'tax', 41, '1111', 0, 1, '2021-02-18 16:26:09'),
(44, 'tax_setting', NULL, 'tax', 41, '0010', 0, 1, '2021-02-18 16:26:50'),
(45, 'currency', NULL, 'currency', NULL, '0100', 0, 1, '2021-02-18 16:34:12'),
(46, 'add_currency', NULL, 'currency', 45, '1000', 0, 1, '2021-02-18 16:34:12'),
(47, 'manage_currency', NULL, 'currency', 45, '0111', 0, 1, '2021-02-18 16:34:12'),
(48, 'store', NULL, 'store', NULL, '0100', 0, 1, '2021-02-18 16:37:59'),
(49, 'store_add', NULL, 'store', 48, '1000', 0, 1, '2021-02-18 16:39:51'),
(50, 'import_store_csv', NULL, 'store', 48, '1111', 0, 1, '2021-02-18 16:39:51'),
(51, 'manage_store', NULL, 'store', 48, '0111', 0, 1, '2021-02-18 16:39:51'),
(52, 'store_transfer', NULL, 'store', 48, '0010', 0, 1, '2021-02-18 16:41:43'),
(53, 'manage_store_product', NULL, 'store', 48, '0011', 0, 1, '2021-02-18 16:41:43'),
(54, 'stock', NULL, 'stock', NULL, '0100', 0, 1, '2021-02-18 16:44:25'),
(55, 'stock_report', NULL, 'stock', 54, '0100', 0, 1, '2021-02-18 16:44:25'),
(56, 'stock_report_supplier_wise', NULL, 'stock', 54, '1111', 0, 1, '2021-02-18 16:44:25'),
(57, 'stock_report_product_wise', NULL, 'stock', 54, '0100', 0, 1, '2021-02-18 17:24:19'),
(58, 'stock_report_store_wise', NULL, 'stock', 54, '0100', 0, 1, '2021-02-18 17:24:19'),
(59, 'bank', NULL, 'bank', NULL, '0100', 0, 1, '2021-02-18 17:37:27'),
(60, 'add_new_bank', NULL, 'bank', 59, '1000', 0, 1, '2021-02-18 17:37:27'),
(61, 'manage_bank', NULL, 'bank', 59, '0111', 0, 1, '2021-02-18 17:37:27'),
(71, 'report', NULL, 'report', NULL, '0100', 0, 1, '2021-02-23 11:38:42'),
(72, 'sales_report', NULL, 'report', 71, '1100', 0, 1, '2021-02-23 11:38:42'),
(73, 'sales_report_store_wise', NULL, 'report', 71, '1100', 0, 1, '2021-02-23 11:40:20'),
(74, 'purchase_report', NULL, 'report', 71, '1100', 0, 1, '2021-02-23 11:43:21'),
(75, 'transfer_report', NULL, 'report', 71, '0100', 0, 1, '2021-02-23 11:45:24'),
(76, 'store_to_store_transfer', NULL, 'report', 75, '1100', 0, 1, '2021-02-23 11:47:39'),
(77, 'tax_report_product_wise', NULL, 'report', 71, '1100', 0, 1, '2021-02-23 11:50:31'),
(78, 'tax_report_invoice_wise', NULL, 'report', 71, '1100', 0, 1, '2021-02-23 11:52:10'),
(79, 'pay_with', NULL, 'pay_with', NULL, '0100', 0, 1, '2021-02-23 11:54:50'),
(80, 'manage_pay_with', NULL, 'pay_with', 79, '1111', 0, 1, '2021-02-23 11:56:38'),
(81, 'states', NULL, 'states', NULL, '0100', 0, 1, '2021-02-23 11:58:40'),
(82, 'add_state', NULL, 'states', 81, '1000', 0, 1, '2021-02-23 12:03:07'),
(83, 'manage_states', NULL, 'states', 81, '0111', 0, 1, '2021-02-23 12:07:03'),
(84, 'modules', NULL, 'modules', NULL, '1111', 0, 1, '2021-02-23 12:13:06'),
(85, 'themes', NULL, 'themes', NULL, '1111', 0, 1, '2021-02-23 12:19:59'),
(86, 'sms_settings', NULL, 'sms_settings', NULL, '0100', 0, 1, '2021-02-23 12:21:19'),
(87, 'sms_configuration', NULL, 'sms_settings', 86, '0010', 0, 1, '2021-02-23 12:24:57'),
(88, 'sms_template', NULL, 'sms_settings', 86, '1111', 0, 1, '2021-02-23 12:26:52'),
(89, 'web_settings', NULL, 'web_settings', NULL, '0100', 0, 1, '2021-02-23 12:41:43'),
(90, 'slider', NULL, 'web_settings', 89, '1111', 0, 1, '2021-02-23 12:44:44'),
(91, 'block', NULL, 'web_settings', 89, '1111', 0, 1, '2021-02-23 12:45:51'),
(92, 'advertisement', NULL, 'web_settings', 89, '1111', 0, 1, '2021-02-23 12:48:18'),
(93, 'product_review', NULL, 'web_settings', 89, '0111', 0, 1, '2021-02-23 12:50:13'),
(94, 'subscriber', NULL, 'web_settings', 89, '1111', 0, 1, '2021-02-23 13:09:44'),
(95, 'wishlist', NULL, 'web_settings', 89, '1111', 0, 1, '2021-02-23 13:12:22'),
(96, 'web_footer', NULL, 'web_settings', 89, '1111', 0, 1, '2021-02-23 13:26:56'),
(97, 'link_page', NULL, 'web_settings', 89, '1111', 0, 1, '2021-02-23 13:26:56'),
(98, 'coupon', NULL, 'web_settings', 89, '1111', 0, 1, '2021-02-23 13:28:18'),
(99, 'contact_form', NULL, 'web_settings', 89, '1111', 0, 1, '2021-02-23 13:29:08'),
(100, 'why_choose_us', NULL, 'web_settings', 89, '1111', 0, 1, '2021-02-23 13:31:01'),
(101, 'our_location', NULL, 'web_settings', 89, '1111', 0, 1, '2021-02-23 14:06:51'),
(102, 'shipping_method', NULL, 'web_settings', 89, '1111', 0, 1, '2021-02-23 14:07:52'),
(103, 'setting', NULL, 'web_settings', 89, '0110', 0, 1, '2021-02-23 14:09:03'),
(104, 'software_settings', NULL, 'software_settings', NULL, '0110', 0, 1, '2021-02-23 14:10:08'),
(105, 'manage_company', NULL, 'software_settings', 104, '0110', 0, 1, '2021-02-23 14:11:35'),
(106, 'add_user', NULL, 'software_settings', 104, '1000', 0, 1, '2021-02-23 14:13:05'),
(107, 'manage_users', NULL, 'software_settings', 104, '1111', 0, 1, '2021-02-23 14:14:25'),
(108, 'language', NULL, 'software_settings', 104, '1111', 0, 1, '2021-02-23 14:16:20'),
(109, 'color_setting_frontend', NULL, 'software_settings', 104, '0110', 0, 1, '2021-02-23 14:17:33'),
(110, 'color_setting_backend', NULL, 'software_settings', 104, '0110', 0, 1, '2021-02-23 14:19:00'),
(111, 'email_configuration', NULL, 'software_settings', 104, '0110', 0, 1, '2021-02-23 14:20:05'),
(112, 'payment_gateway_setting', NULL, 'software_settings', 104, '1110', 0, 1, '2021-02-23 14:21:31'),
(113, 'software_settings', NULL, 'software_settings', 104, '0110', 0, 1, '2021-02-23 14:22:40'),
(114, 'update', NULL, 'update', NULL, '0110', 0, 1, '2021-02-23 14:23:40'),
(115, 'backup_and_restore', NULL, 'backup_and_restore', NULL, '1111', 0, 1, '2021-02-23 14:24:41'),
(116, 'android_apps', NULL, 'android_apps', NULL, '0110', 0, 1, '2021-02-23 14:25:53'),
(117, 'support', NULL, 'support', NULL, '0100', 0, 1, '2021-02-23 14:26:54'),
(118, 'role', NULL, 'software_settings', 104, '1111', 0, 1, '2021-02-25 12:43:43'),
(119, 'seo_tools', NULL, 'web_settings', 89, '0100', 0, 1, '2021-02-28 17:42:28'),
(120, 'popular_products', NULL, 'web_settings', 89, '0100', 0, 1, '2021-02-28 17:42:28'),
(121, 'website_meta_keywords', NULL, 'web_settings', 89, '0110', 0, 1, '2021-02-28 17:42:28'),
(122, 'google_analytics', NULL, 'web_settings', 89, '0110', 0, 1, '2021-02-28 17:42:28'),
(123, 'delivery_system', NULL, 'delivery_system', NULL, '0100', 0, 1, '2021-03-20 15:32:02'),
(124, 'delivery_boy', NULL, 'delivery_system', 127, '0100', 0, 1, '2021-03-20 15:32:02'),
(125, 'add_delivery_boy', NULL, 'delivery_system', 127, '1000', 0, 1, '2021-03-20 15:32:02'),
(126, 'manage_delivery_boy', NULL, 'delivery_system', 127, '0111', 0, 1, '2021-03-20 15:32:02'),
(127, 'delivery_slot', NULL, 'delivery_system', 127, '0100', 0, 1, '2021-03-20 15:32:02'),
(128, 'add_time_slot', NULL, 'delivery_system', 127, '1000', 0, 1, '2021-03-20 15:32:02'),
(129, 'manage_time_slot', NULL, 'delivery_system', 127, '0111', 0, 1, '2021-03-20 15:32:02'),
(130, 'delivery_zone', NULL, 'delivery_system', 127, '0100', 0, 1, '2021-03-20 15:32:02'),
(131, 'add_delivery_zone', NULL, 'delivery_system', 127, '1000', 0, 1, '2021-03-20 15:32:02'),
(132, 'manage_delivery_zone', NULL, 'delivery_system', 127, '0111', 0, 1, '2021-03-20 15:32:02'),
(133, 'delivery_assigns', NULL, 'delivery_system', 127, '0100', 0, 1, '2021-03-20 15:32:02'),
(134, 'assign_delivery', NULL, 'delivery_system', 127, '1000', 0, 1, '2021-03-20 15:32:02'),
(135, 'manage_assigned_delivery', NULL, 'delivery_system', 127, '0111', 0, 1, '2021-03-20 15:32:02'),
(143, 'invoice_text', NULL, 'sales', 2, '1111', 0, 1, '2021-05-24 09:50:09'),
(147, 'import_product_excel', NULL, 'product', 9, '1111', 0, 1, '2021-09-04 12:07:15'),
(155, 'order_csv_export', NULL, 'sales', 2, '0110', 0, 1, '2022-01-25 12:14:48'),
(156, 'pad_print_setting', NULL, 'sales', 2, '1110', 0, 1, '2022-01-25 12:14:48'),
(157, 'filtration', NULL, 'product', 0, '0100', 0, 1, '2022-01-25 12:45:16'),
(158, 'add_filter', NULL, 'product', 157, '1100', 0, 1, '2022-01-25 12:53:05'),
(159, 'manage_filters', NULL, 'product', 157, '0111', 0, 1, '2022-01-25 12:53:05'),
(160, 'supplier_balance_report', NULL, 'supplier', 18, '0100', 0, 1, '2022-01-25 13:04:47'),
(161, 'customer_balance_report', NULL, 'customer', NULL, '0100', 0, 14, '2022-01-25 13:18:07'),
(162, 'purchase_order', NULL, 'purchase', 0, '0100', 0, 1, '2022-01-25 13:36:55'),
(163, 'create_purchase_order', NULL, 'purchase', 162, '1100', 0, 1, '2022-01-25 13:46:10'),
(164, 'receive_item', NULL, 'purchase', 162, '0111', 0, 1, '2022-01-25 13:46:10'),
(165, 'manage_purchase_return', NULL, 'purchase', 22, '0111', 0, 1, '2022-01-25 13:49:01'),
(167, 'Warrantee', NULL, 'Warrantee', 0, '0100', 0, 1, '2022-01-25 14:32:35'),
(168, 'quotation', NULL, 'quotation', 0, '0100', 0, 1, '2022-01-25 14:44:18'),
(169, 'new_quotation', NULL, 'quotation', 168, '1100', 0, 1, '2022-01-25 14:49:02'),
(170, 'manage_quotation', NULL, 'quotation', 168, '0111', 0, 1, '2022-01-25 14:49:02'),
(171, 'stock_adjustment', NULL, 'stock', 54, '1100', 0, 1, '2022-01-25 15:58:20'),
(172, 'manage_stock_adjustment', NULL, 'stock', 54, '0111', 0, 1, '2022-01-25 15:58:20'),
(173, 'batch_wise_stock', NULL, 'stock', 54, '0100', 0, 1, '2022-01-25 15:58:20'),
(204, 'expriy_report', NULL, 'report', 71, '0100', 0, 1, '2022-01-25 17:34:50'),
(205, 'whatsapp_info', NULL, 'web_settings', 89, '1111', 0, 1, '2022-01-25 17:51:49'),
(215, 'accounting', NULL, 'accounting', 0, '0100', 0, 1, '2022-01-25 19:11:19'),
(216, 'fiscal_year', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(217, 'fiscal_year_ending', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(218, 'chart_of_account', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(219, 'opening_balance', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(220, 'add_stock_opening', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(221, 'supplier_payment', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(222, 'cash_adjustment', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(223, 'debit_voucher', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(224, 'credit_voucher', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(225, 'contra_voucher', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(226, 'journal_voucher', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(227, 'voucher_approval', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(228, 'receipt_voucher', NULL, 'accounting', 215, '1111', 0, 1, '2022-01-25 19:11:19'),
(229, 'account_reports', NULL, 'accounting', 215, '0100', 0, 1, '2022-01-25 19:11:19'),
(230, 'reports_by_voucher', NULL, 'accounting', 229, '0100', 0, 1, '2022-01-25 19:11:19'),
(231, 'general_ledger', NULL, 'accounting', 229, '0100', 0, 1, '2022-01-25 19:11:19'),
(232, 'profit_loss', NULL, 'accounting', 229, '0100', 0, 1, '2022-01-25 19:11:19'),
(233, 'balance_sheet', NULL, 'accounting', 229, '0100', 0, 1, '2022-01-25 19:11:19'),
(234, 'trial_balance', NULL, 'accounting', 229, '0100', 0, 1, '2022-01-25 19:11:19'),
(235, 'coa_print', NULL, 'accounting', 229, '0100', 0, 1, '2022-01-25 19:11:19'),
(243, 'assembly_products', NULL, 'assembly_products', NULL, '0100', 0, 1, '2022-03-02 15:07:18'),
(244, 'add_assembly_product', NULL, 'assembly_products', 136, '1100', 0, 1, '2022-03-02 15:07:18'),
(245, 'manage_assembly_product', NULL, 'assembly_products', 136, '0111', 0, 1, '2022-03-02 15:07:18'),
(258, 'captcha_print_setting', NULL, 'sales', 2, '1110', 0, 1, '2022-03-02 17:25:06'),
(259, 'hrm', NULL, 'hrm', NULL, '0100', 0, 1, '2022-05-31 14:36:57'),
(260, 'add_designation', NULL, 'hrm', NULL, '1000', 0, 1, '2022-05-31 14:36:57'),
(261, 'manage_designation', NULL, 'hrm', NULL, '0111', 0, 1, '2022-05-31 14:36:57'),
(262, 'add_employee', NULL, 'hrm', NULL, '1000', 0, 1, '2022-05-31 14:36:57'),
(263, 'manage_employee', NULL, 'hrm', NULL, '0111', 0, 1, '2022-05-31 14:36:57'),
(264, 'attendance', NULL, 'attendance', NULL, '0100', 0, 1, '2022-05-31 14:36:57'),
(265, 'add_attendance', NULL, 'attendance', NULL, '1000', 0, 1, '2022-05-31 14:36:57'),
(266, 'manage_attendance', NULL, 'attendance', NULL, '0111', 0, 1, '2022-05-31 14:36:57'),
(267, 'attendance_report', NULL, 'attendance', NULL, '0100', 0, 1, '2022-05-31 14:36:57'),
(268, 'payroll', NULL, 'payroll', NULL, '0100', 0, 1, '2022-05-31 14:36:57'),
(269, 'add_benefits', NULL, 'payroll', NULL, '1000', 0, 1, '2022-05-31 14:36:57'),
(270, 'manage_benefits', NULL, 'payroll', NULL, '0111', 0, 1, '2022-05-31 14:36:57'),
(271, 'add_salary_setup', NULL, 'payroll', NULL, '1000', 0, 1, '2022-05-31 14:36:57'),
(272, 'manage_salary_setup', NULL, 'payroll', NULL, '0111', 0, 1, '2022-05-31 14:36:57'),
(273, 'salary_generate', NULL, 'payroll', NULL, '1000', 0, 1, '2022-05-31 14:36:57'),
(274, 'manage_salary_generate', NULL, 'payroll', NULL, '0111', 0, 1, '2022-05-31 14:36:57'),
(275, 'salary_payment', NULL, 'payroll', NULL, '0100', 0, 1, '2022-05-31 14:36:57'),
(276, 'expense', NULL, 'expense', NULL, '0100', 0, 1, '2022-05-31 14:36:57'),
(277, 'add_expense_item', NULL, 'expense', NULL, '1000', 0, 1, '2022-05-31 14:36:57'),
(278, 'manage_expense_item', NULL, 'expense', NULL, '0111', 0, 1, '2022-05-31 14:36:57'),
(279, 'add_expense', NULL, 'expense', NULL, '1000', 0, 1, '2022-05-31 14:36:57'),
(280, 'manage_expense', NULL, 'expense', NULL, '0111', 0, 1, '2022-05-31 14:36:57'),
(281, 'expense_statement', NULL, 'expense', NULL, '0100', 0, 1, '2022-05-31 14:36:57'),
(282, 'personal_loan', NULL, 'personal_loan', NULL, '0100', 0, 1, '2022-05-31 14:36:57'),
(283, 'add_person', NULL, 'personal_loan', NULL, '1000', 0, 1, '2022-05-31 14:36:57'),
(284, 'add_loan', NULL, 'personal_loan', NULL, '1000', 0, 1, '2022-05-31 14:36:57'),
(285, 'add_payment', NULL, 'personal_loan', NULL, '1000', 0, 1, '2022-05-31 14:36:57'),
(286, 'manage_person', NULL, 'personal_loan', NULL, '0111', 0, 1, '2022-05-31 14:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `sec_role_permission`
--

CREATE TABLE `sec_role_permission` (
  `id` bigint(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `can_access` tinyint(1) NOT NULL,
  `can_create` tinyint(1) NOT NULL,
  `can_edit` tinyint(1) NOT NULL,
  `can_delete` tinyint(1) NOT NULL,
  `createby` int(11) NOT NULL,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sec_role_permission`
--

INSERT INTO `sec_role_permission` (`id`, `role_id`, `menu_id`, `can_access`, `can_create`, `can_edit`, `can_delete`, `createby`, `createdate`) VALUES
(698, 2, 1, 1, 1, 1, 1, 0, '2022-05-28 11:02:39'),
(699, 2, 2, 1, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(700, 2, 3, 0, 1, 0, 0, 0, '2022-05-28 11:02:39'),
(701, 2, 4, 1, 0, 1, 1, 0, '2022-05-28 11:02:39'),
(702, 2, 5, 1, 1, 1, 1, 0, '2022-05-28 11:02:39'),
(703, 2, 143, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(704, 2, 155, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(705, 2, 156, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(706, 2, 258, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(707, 2, 6, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(708, 2, 7, 0, 1, 0, 0, 0, '2022-05-28 11:02:39'),
(709, 2, 8, 1, 0, 1, 1, 0, '2022-05-28 11:02:39'),
(710, 2, 9, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(711, 2, 10, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(712, 2, 11, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(713, 2, 12, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(714, 2, 13, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(715, 2, 147, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(716, 2, 157, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(717, 2, 158, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(718, 2, 159, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(719, 2, 14, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(720, 2, 15, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(721, 2, 16, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(722, 2, 17, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(723, 2, 161, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(724, 2, 18, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(725, 2, 19, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(726, 2, 20, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(727, 2, 21, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(728, 2, 160, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(729, 2, 22, 1, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(730, 2, 23, 0, 1, 0, 0, 0, '2022-05-28 11:02:39'),
(731, 2, 24, 1, 0, 1, 1, 0, '2022-05-28 11:02:39'),
(732, 2, 162, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(733, 2, 163, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(734, 2, 164, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(735, 2, 165, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(736, 2, 25, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(737, 2, 26, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(738, 2, 27, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(739, 2, 28, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(740, 2, 29, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(741, 2, 30, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(742, 2, 31, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(743, 2, 32, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(744, 2, 33, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(745, 2, 34, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(746, 2, 35, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(747, 2, 36, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(748, 2, 37, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(749, 2, 38, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(750, 2, 39, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(751, 2, 40, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(752, 2, 41, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(753, 2, 42, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(754, 2, 43, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(755, 2, 44, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(756, 2, 45, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(757, 2, 46, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(758, 2, 47, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(759, 2, 48, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(760, 2, 49, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(761, 2, 50, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(762, 2, 51, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(763, 2, 52, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(764, 2, 53, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(765, 2, 54, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(766, 2, 55, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(767, 2, 56, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(768, 2, 57, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(769, 2, 58, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(770, 2, 171, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(771, 2, 172, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(772, 2, 173, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(773, 2, 59, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(774, 2, 60, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(775, 2, 61, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(776, 2, 71, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(777, 2, 72, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(778, 2, 73, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(779, 2, 74, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(780, 2, 75, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(781, 2, 76, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(782, 2, 77, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(783, 2, 78, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(784, 2, 204, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(785, 2, 79, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(786, 2, 80, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(787, 2, 81, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(788, 2, 82, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(789, 2, 83, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(790, 2, 84, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(791, 2, 85, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(792, 2, 86, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(793, 2, 87, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(794, 2, 88, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(795, 2, 89, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(796, 2, 90, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(797, 2, 91, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(798, 2, 92, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(799, 2, 93, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(800, 2, 94, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(801, 2, 95, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(802, 2, 96, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(803, 2, 97, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(804, 2, 98, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(805, 2, 99, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(806, 2, 100, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(807, 2, 101, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(808, 2, 102, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(809, 2, 103, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(810, 2, 119, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(811, 2, 120, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(812, 2, 121, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(813, 2, 122, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(814, 2, 205, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(815, 2, 104, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(816, 2, 105, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(817, 2, 106, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(818, 2, 107, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(819, 2, 108, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(820, 2, 109, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(821, 2, 110, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(822, 2, 111, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(823, 2, 112, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(824, 2, 113, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(825, 2, 118, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(826, 2, 114, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(827, 2, 115, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(828, 2, 116, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(829, 2, 117, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(830, 2, 123, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(831, 2, 124, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(832, 2, 125, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(833, 2, 126, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(834, 2, 127, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(835, 2, 128, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(836, 2, 129, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(837, 2, 130, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(838, 2, 131, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(839, 2, 132, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(840, 2, 133, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(841, 2, 134, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(842, 2, 135, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(843, 2, 167, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(844, 2, 168, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(845, 2, 169, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(846, 2, 170, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(847, 2, 215, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(848, 2, 216, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(849, 2, 217, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(850, 2, 218, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(851, 2, 219, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(852, 2, 220, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(853, 2, 221, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(854, 2, 222, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(855, 2, 223, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(856, 2, 224, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(857, 2, 225, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(858, 2, 226, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(859, 2, 227, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(860, 2, 228, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(861, 2, 229, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(862, 2, 230, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(863, 2, 231, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(864, 2, 232, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(865, 2, 233, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(866, 2, 234, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(867, 2, 235, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(868, 2, 243, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(869, 2, 244, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(870, 2, 245, 0, 0, 0, 0, 0, '2022-05-28 11:02:39'),
(1473, 4, 1, 0, 1, 1, 0, 0, '2022-09-27 06:24:52'),
(1474, 4, 2, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1475, 4, 3, 0, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1476, 4, 4, 0, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1477, 4, 5, 0, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1478, 4, 143, 1, 1, 1, 1, 0, '2022-09-27 06:24:52'),
(1479, 4, 155, 1, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1480, 4, 156, 0, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1481, 4, 258, 0, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1482, 4, 6, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1483, 4, 7, 0, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1484, 4, 8, 0, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1485, 4, 9, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1486, 4, 10, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1487, 4, 11, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1488, 4, 12, 1, 0, 1, 1, 0, '2022-09-27 06:24:52'),
(1489, 4, 13, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1490, 4, 147, 1, 1, 1, 1, 0, '2022-09-27 06:24:52'),
(1491, 4, 157, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1492, 4, 158, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1493, 4, 159, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1494, 4, 14, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1495, 4, 15, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1496, 4, 16, 0, 0, 1, 1, 0, '2022-09-27 06:24:52'),
(1497, 4, 17, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1498, 4, 161, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1499, 4, 18, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1500, 4, 19, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1501, 4, 20, 0, 0, 1, 1, 0, '2022-09-27 06:24:52'),
(1502, 4, 21, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1503, 4, 160, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1504, 4, 22, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1505, 4, 23, 0, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1506, 4, 24, 1, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1507, 4, 162, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1508, 4, 163, 1, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1509, 4, 164, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1510, 4, 165, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1511, 4, 25, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1512, 4, 26, 0, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1513, 4, 27, 1, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1514, 4, 28, 1, 0, 1, 1, 0, '2022-09-27 06:24:52'),
(1515, 4, 29, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1516, 4, 30, 1, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1517, 4, 31, 0, 0, 1, 1, 0, '2022-09-27 06:24:52'),
(1518, 4, 32, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1519, 4, 33, 0, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1520, 4, 34, 1, 0, 1, 1, 0, '2022-09-27 06:24:52'),
(1521, 4, 35, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1522, 4, 36, 0, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1523, 4, 37, 1, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1524, 4, 38, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1525, 4, 39, 0, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1526, 4, 40, 1, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1527, 4, 41, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1528, 4, 42, 1, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1529, 4, 43, 1, 1, 1, 0, 0, '2022-09-27 06:24:52'),
(1530, 4, 44, 0, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1531, 4, 45, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1532, 4, 46, 0, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1533, 4, 47, 1, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1534, 4, 48, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1535, 4, 49, 0, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1536, 4, 50, 1, 1, 1, 0, 0, '2022-09-27 06:24:52'),
(1537, 4, 51, 0, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1538, 4, 52, 0, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1539, 4, 53, 0, 0, 0, 1, 0, '2022-09-27 06:24:52'),
(1540, 4, 54, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1541, 4, 55, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1542, 4, 56, 1, 0, 1, 1, 0, '2022-09-27 06:24:52'),
(1543, 4, 57, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1544, 4, 58, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1545, 4, 171, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1546, 4, 172, 0, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1547, 4, 173, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1548, 4, 59, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1549, 4, 60, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1550, 4, 61, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1551, 4, 71, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1552, 4, 72, 1, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1553, 4, 73, 0, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1554, 4, 74, 1, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1555, 4, 75, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1556, 4, 76, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1557, 4, 77, 1, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1558, 4, 78, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1559, 4, 204, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1560, 4, 79, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1561, 4, 80, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1562, 4, 81, 1, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1563, 4, 82, 0, 1, 0, 0, 0, '2022-09-27 06:24:52'),
(1564, 4, 83, 0, 0, 1, 0, 0, '2022-09-27 06:24:52'),
(1565, 4, 84, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1566, 4, 85, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1567, 4, 86, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1568, 4, 87, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1569, 4, 88, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1570, 4, 89, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1571, 4, 90, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1572, 4, 91, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1573, 4, 92, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1574, 4, 93, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1575, 4, 94, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1576, 4, 95, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1577, 4, 96, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1578, 4, 97, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1579, 4, 98, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1580, 4, 99, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1581, 4, 100, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1582, 4, 101, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1583, 4, 102, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1584, 4, 103, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1585, 4, 119, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1586, 4, 120, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1587, 4, 121, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1588, 4, 122, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1589, 4, 205, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1590, 4, 104, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1591, 4, 105, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1592, 4, 106, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1593, 4, 107, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1594, 4, 108, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1595, 4, 109, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1596, 4, 110, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1597, 4, 111, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1598, 4, 112, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1599, 4, 113, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1600, 4, 118, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1601, 4, 114, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1602, 4, 115, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1603, 4, 116, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1604, 4, 117, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1605, 4, 123, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1606, 4, 124, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1607, 4, 125, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1608, 4, 126, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1609, 4, 127, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1610, 4, 128, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1611, 4, 129, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1612, 4, 130, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1613, 4, 131, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1614, 4, 132, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1615, 4, 133, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1616, 4, 134, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1617, 4, 135, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1618, 4, 167, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1619, 4, 168, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1620, 4, 169, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1621, 4, 170, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1622, 4, 215, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1623, 4, 216, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1624, 4, 217, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1625, 4, 218, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1626, 4, 219, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1627, 4, 220, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1628, 4, 221, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1629, 4, 222, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1630, 4, 223, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1631, 4, 224, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1632, 4, 225, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1633, 4, 226, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1634, 4, 227, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1635, 4, 228, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1636, 4, 229, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1637, 4, 230, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1638, 4, 231, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1639, 4, 232, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1640, 4, 233, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1641, 4, 234, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1642, 4, 235, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1643, 4, 243, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1644, 4, 244, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1645, 4, 245, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1646, 4, 259, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1647, 4, 260, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1648, 4, 261, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1649, 4, 262, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1650, 4, 263, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1651, 4, 264, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1652, 4, 265, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1653, 4, 266, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1654, 4, 267, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1655, 4, 268, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1656, 4, 269, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1657, 4, 270, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1658, 4, 271, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1659, 4, 272, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1660, 4, 273, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1661, 4, 274, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1662, 4, 275, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1663, 4, 276, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1664, 4, 277, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1665, 4, 278, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1666, 4, 279, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1667, 4, 280, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1668, 4, 281, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1669, 4, 282, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1670, 4, 283, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1671, 4, 284, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1672, 4, 285, 0, 0, 0, 0, 0, '2022-09-27 06:24:52'),
(1673, 3, 1, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1674, 3, 2, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1675, 3, 3, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1676, 3, 4, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1677, 3, 5, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1678, 3, 143, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1679, 3, 155, 1, 0, 1, 0, 0, '2022-10-11 06:20:32'),
(1680, 3, 156, 1, 1, 1, 0, 0, '2022-10-11 06:20:32'),
(1681, 3, 258, 1, 1, 1, 0, 0, '2022-10-11 06:20:32'),
(1682, 3, 6, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1683, 3, 7, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1684, 3, 8, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1685, 3, 9, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1686, 3, 10, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1687, 3, 11, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1688, 3, 12, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1689, 3, 13, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1690, 3, 147, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1691, 3, 157, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1692, 3, 158, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1693, 3, 159, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1694, 3, 14, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1695, 3, 15, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1696, 3, 16, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1697, 3, 17, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1698, 3, 161, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1699, 3, 18, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1700, 3, 19, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1701, 3, 20, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1702, 3, 21, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1703, 3, 160, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1704, 3, 22, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1705, 3, 23, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1706, 3, 24, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1707, 3, 162, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1708, 3, 163, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1709, 3, 164, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1710, 3, 165, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1711, 3, 25, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1712, 3, 26, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1713, 3, 27, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1714, 3, 28, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1715, 3, 29, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1716, 3, 30, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1717, 3, 31, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1718, 3, 32, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1719, 3, 33, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1720, 3, 34, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1721, 3, 35, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1722, 3, 36, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1723, 3, 37, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1724, 3, 38, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1725, 3, 39, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1726, 3, 40, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1727, 3, 41, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1728, 3, 42, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1729, 3, 43, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1730, 3, 44, 0, 0, 1, 0, 0, '2022-10-11 06:20:32'),
(1731, 3, 45, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1732, 3, 46, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1733, 3, 47, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1734, 3, 48, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1735, 3, 49, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1736, 3, 50, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1737, 3, 51, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1738, 3, 52, 0, 0, 1, 0, 0, '2022-10-11 06:20:32'),
(1739, 3, 53, 0, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1740, 3, 54, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1741, 3, 55, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1742, 3, 56, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1743, 3, 57, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1744, 3, 58, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1745, 3, 171, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1746, 3, 172, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1747, 3, 173, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1748, 3, 59, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1749, 3, 60, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1750, 3, 61, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1751, 3, 71, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1752, 3, 72, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1753, 3, 73, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1754, 3, 74, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1755, 3, 75, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1756, 3, 76, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1757, 3, 77, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1758, 3, 78, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1759, 3, 204, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1760, 3, 79, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1761, 3, 80, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1762, 3, 81, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1763, 3, 82, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1764, 3, 83, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1765, 3, 84, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1766, 3, 85, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1767, 3, 86, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1768, 3, 87, 0, 0, 1, 0, 0, '2022-10-11 06:20:32'),
(1769, 3, 88, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1770, 3, 89, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1771, 3, 90, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1772, 3, 91, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1773, 3, 92, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1774, 3, 93, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1775, 3, 94, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1776, 3, 95, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1777, 3, 96, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1778, 3, 97, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1779, 3, 98, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1780, 3, 99, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1781, 3, 100, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1782, 3, 101, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1783, 3, 102, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1784, 3, 103, 1, 0, 1, 0, 0, '2022-10-11 06:20:32'),
(1785, 3, 119, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1786, 3, 120, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1787, 3, 121, 1, 0, 1, 0, 0, '2022-10-11 06:20:32'),
(1788, 3, 122, 1, 0, 1, 0, 0, '2022-10-11 06:20:32'),
(1789, 3, 205, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1790, 3, 104, 1, 0, 1, 0, 0, '2022-10-11 06:20:32'),
(1791, 3, 105, 1, 0, 1, 0, 0, '2022-10-11 06:20:32'),
(1792, 3, 106, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1793, 3, 107, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1794, 3, 108, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1795, 3, 109, 1, 0, 1, 0, 0, '2022-10-11 06:20:32'),
(1796, 3, 110, 1, 0, 1, 0, 0, '2022-10-11 06:20:32'),
(1797, 3, 111, 1, 0, 1, 0, 0, '2022-10-11 06:20:32'),
(1798, 3, 112, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1799, 3, 113, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1800, 3, 118, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1801, 3, 114, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1802, 3, 115, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1803, 3, 116, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1804, 3, 117, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1805, 3, 123, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1806, 3, 124, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1807, 3, 125, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1808, 3, 126, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1809, 3, 127, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1810, 3, 128, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1811, 3, 129, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1812, 3, 130, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1813, 3, 131, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1814, 3, 132, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1815, 3, 133, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1816, 3, 134, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1817, 3, 135, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1818, 3, 167, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1819, 3, 168, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1820, 3, 169, 1, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1821, 3, 170, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1822, 3, 215, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1823, 3, 216, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1824, 3, 217, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1825, 3, 218, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1826, 3, 219, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1827, 3, 220, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1828, 3, 221, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1829, 3, 222, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1830, 3, 223, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1831, 3, 224, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1832, 3, 225, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1833, 3, 226, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1834, 3, 227, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1835, 3, 228, 1, 1, 1, 1, 0, '2022-10-11 06:20:32'),
(1836, 3, 229, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1837, 3, 230, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1838, 3, 231, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1839, 3, 232, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1840, 3, 233, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1841, 3, 234, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1842, 3, 235, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1843, 3, 243, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1844, 3, 244, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1845, 3, 245, 0, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1846, 3, 259, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1847, 3, 260, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1848, 3, 261, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1849, 3, 262, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1850, 3, 263, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1851, 3, 264, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1852, 3, 265, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1853, 3, 266, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1854, 3, 267, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1855, 3, 268, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1856, 3, 269, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1857, 3, 270, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1858, 3, 271, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1859, 3, 272, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1860, 3, 273, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1861, 3, 274, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1862, 3, 275, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1863, 3, 276, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1864, 3, 277, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1865, 3, 278, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1866, 3, 279, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1867, 3, 280, 1, 0, 1, 1, 0, '2022-10-11 06:20:32'),
(1868, 3, 281, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1869, 3, 282, 1, 0, 0, 0, 0, '2022-10-11 06:20:32'),
(1870, 3, 283, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1871, 3, 284, 0, 1, 0, 0, 0, '2022-10-11 06:20:32'),
(1872, 3, 285, 0, 1, 0, 0, 0, '2022-10-11 06:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `sec_role_tbl`
--

CREATE TABLE `sec_role_tbl` (
  `role_id` int(11) NOT NULL,
  `role_name` text NOT NULL,
  `role_description` text NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `role_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sec_role_tbl`
--

INSERT INTO `sec_role_tbl` (`role_id`, `role_name`, `role_description`, `create_by`, `date_time`, `role_status`) VALUES
(2, 'sales executive', 'sales executive', 1, '2021-02-24 07:50:58', 1),
(3, 'manager', 'manager', 1, '2022-08-23 10:30:27', 1),
(4, 'role', 'description of role', 1, '2022-09-27 06:24:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sec_user_access_tbl`
--

CREATE TABLE `sec_user_access_tbl` (
  `role_acc_id` int(11) NOT NULL,
  `fk_role_id` int(11) NOT NULL,
  `fk_user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sec_user_access_tbl`
--

INSERT INTO `sec_user_access_tbl` (`role_acc_id`, `fk_role_id`, `fk_user_id`) VALUES
(1, 3, 'QY9PGWENDBVG855'),
(2, 3, 'WNT31FLN1WO62KP');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `address` text,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `site_align` varchar(50) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `title`, `address`, `email`, `phone`, `logo`, `favicon`, `language`, `site_align`, `footer_text`) VALUES
(2, 'Dynamic Admin Panel', '98 Green Road, Farmgate, Dhaka-1215.', 'bdtask@gmail.com', '0123456789', 'assets/img/icons/logo.png', 'assets/img/icons/m.png', 'english', 'LTR', '2017©Copyright');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_info`
--

CREATE TABLE `shipping_info` (
  `shiping_info_id` int(11) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `customer_short_address` text NOT NULL,
  `customer_address_1` text NOT NULL,
  `customer_address_2` text NOT NULL,
  `customer_mobile` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `company` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `method_id` int(11) NOT NULL,
  `method_name` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `charge_amount` float NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`method_id`, `method_name`, `details`, `charge_amount`, `position`) VALUES
(1, 'Inside the city', '', 0, 1),
(2, 'Outside the city', '', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_orders`
--

CREATE TABLE `shipping_orders` (
  `invoice_id` varchar(50) DEFAULT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `awb_no` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_orders_status`
--

CREATE TABLE `shipping_orders_status` (
  `awb_no` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `response` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_order_errors`
--

CREATE TABLE `shipping_order_errors` (
  `order_id` varchar(50) NOT NULL,
  `messsage` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `site_analytics`
--

CREATE TABLE `site_analytics` (
  `id` int(11) NOT NULL,
  `product_id` varchar(30) NOT NULL,
  `clicks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_analytics`
--

INSERT INTO `site_analytics` (`id`, `product_id`, `clicks`) VALUES
(1, '98366399', 2),
(3, '95876719', 1),
(4, '39931699', 2),
(5, '55833959', 1),
(6, '63552563', 1),
(8, '12498511', 2),
(9, '79733182', 3),
(10, '32429942', 1),
(12, '69419565', 4),
(13, '54319578', 1),
(14, '49263587', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` varchar(100) NOT NULL,
  `slider_link` varchar(255) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `slider_category` varchar(255) DEFAULT NULL,
  `slider_position` int(11) NOT NULL,
  `language` varchar(50) NOT NULL DEFAULT 'english',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_link`, `slider_image`, `slider_category`, `slider_position`, `language`, `status`) VALUES
('DLHEPY7IUPOJKAD', '#', 'my-assets/image/slider/ca47da198e25a27b6c7c0d37eb9fba82.jpg', '', 1, 'english', 1),
('T17X8HSQ8W8MYG1', '#', 'my-assets/image/slider/4d4a2f55be2c0f046cb281aefb68f629.jpg', '', 2, 'english', 1),
('ZFTN9GODSNWAN7Q', '#', 'my-assets/image/slider/aaf9b565ecadcb2a20cadd736baaa4a3.jpg', '', 3, 'english', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_configuration`
--

CREATE TABLE `sms_configuration` (
  `id` int(11) NOT NULL,
  `gateway` varchar(255) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `link` varchar(255) NOT NULL,
  `sms_from` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_configuration`
--

INSERT INTO `sms_configuration` (`id`, `gateway`, `user_name`, `userid`, `password`, `status`, `link`, `sms_from`, `created_at`, `updated_at`) VALUES
(1, 'SMS BDtask', 'sms', 'C20030055c583f4dc67332.06183368', '', 0, 'http://sms.bdtask.com/', 'Styledunea', '2020-08-22 22:46:28', '2022-07-14 14:09:06'),
(2, 'nexmo', 'd7a32ebc', '', 'SYCgDWZGgF8IDzx5', 0, 'https://www.nexmo.com/', 'isshue', '2020-08-22 22:46:20', '2022-07-14 14:09:06'),
(3, 'budgetsms', 'user1', '21547', '1e753da74', 0, 'https://www.budgetsms.net/', 'budgetsms', '2020-08-22 22:46:28', '2022-07-14 14:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `sms_template`
--

CREATE TABLE `sms_template` (
  `id` int(11) NOT NULL,
  `template_name` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `default_status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_template`
--

INSERT INTO `sms_template` (`id`, `template_name`, `message`, `type`, `status`, `default_status`, `created_at`, `updated_at`) VALUES
(1, 'one', 'your registration is complete', 'Registration', 1, 0, '2020-08-22 22:58:41', '2022-07-14 14:09:06'),
(2, 'two', 'your order {id} is completed', 'Order', 1, 1, '2020-08-22 22:58:45', '2022-07-14 14:09:06'),
(3, 'three', 'your order {id} is processing', 'Processing', 1, 1, '2020-08-22 22:58:48', '2022-07-14 14:09:06'),
(5, 'four', 'your order {id} is shipped', 'Shipped', 1, 1, '2020-08-22 22:58:53', '2022-07-14 14:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `social_auth`
--

CREATE TABLE `social_auth` (
  `id` int(11) NOT NULL,
  `name` text,
  `app_id` text,
  `app_secret` text,
  `api_key` text,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_auth`
--

INSERT INTO `social_auth` (`id`, `name`, `app_id`, `app_secret`, `api_key`, `status`) VALUES
(1, 'facebook', '366570867552411', '9a3711183172cb35cb8fc7d3ee05acad', '', 1),
(2, 'googleplus', '39648987978-9pj8230slkn3qf50est5a2nsd0eictpj.apps.googleusercontent.com', 'M9J__-v3kbAZK6-UUw8oq8', 'AIzaSyCOUwQA-jnpUYAaQZFBbm2BpbqyUQPmEf0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `soft_setting`
--

CREATE TABLE `soft_setting` (
  `setting_id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `invoice_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `language` varchar(255) DEFAULT NULL,
  `time_zone` varchar(200) DEFAULT NULL,
  `rtr` varchar(255) DEFAULT NULL,
  `captcha` int(11) DEFAULT '1' COMMENT '0=active,1=inactive',
  `site_key` varchar(250) DEFAULT NULL,
  `secret_key` varchar(250) DEFAULT NULL,
  `sms_service` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `soft_setting`
--

INSERT INTO `soft_setting` (`setting_id`, `logo`, `invoice_logo`, `favicon`, `footer_text`, `country_id`, `language`, `time_zone`, `rtr`, `captcha`, `site_key`, `secret_key`, `sms_service`) VALUES
(1, 'my-assets/image/logo/8f73e23069c0b14795f0a856c8fa03e2.png', 'my-assets/image/logo/8ba743c19c66630c33335e8c10e1ab62.png', 'my-assets/image/logo/8409b9e21c1a226954929cf091a09f68.png', 'Developed by 212', 191, 'english', 'Africa/Cairo', '0', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `splash_images`
--

CREATE TABLE `splash_images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(1, 'Andaman and Nicobar Islands', 101),
(2, 'Andhra Pradesh', 101),
(3, 'Arunachal Pradesh', 101),
(4, 'Assam', 101),
(5, 'Bihar', 101),
(6, 'Chandigarh', 101),
(7, 'Chhattisgarh', 101),
(8, 'Dadra and Nagar Haveli', 101),
(9, 'Daman and Diu', 101),
(10, 'Delhi', 101),
(11, 'Goa', 101),
(12, 'Gujarat', 101),
(13, 'Haryana', 101),
(14, 'Himachal Pradesh', 101),
(15, 'Jammu and Kashmir', 101),
(16, 'Jharkhand', 101),
(17, 'Karnataka', 101),
(18, 'Kenmore', 101),
(19, 'Kerala', 101),
(20, 'Lakshadweep', 101),
(21, 'Madhya Pradesh', 101),
(22, 'Maharashtra', 101),
(23, 'Manipur', 101),
(24, 'Meghalaya', 101),
(25, 'Mizoram', 101),
(26, 'Nagaland', 101),
(27, 'Narora', 101),
(28, 'Natwar', 101),
(29, 'Odisha', 101),
(30, 'Paschim Medinipur', 101),
(31, 'Pondicherry', 101),
(32, 'Punjab', 101),
(33, 'Rajasthan', 101),
(34, 'Sikkim', 101),
(35, 'Tamil Nadu', 101),
(36, 'Telangana', 101),
(37, 'Tripura', 101),
(38, 'Uttar Pradesh', 101),
(39, 'Uttarakhand', 101),
(40, 'Vaishali', 101),
(41, 'West Bengal', 101),
(42, 'Badakhshan', 1),
(43, 'Badgis', 1),
(44, 'Baglan', 1),
(45, 'Balkh', 1),
(46, 'Bamiyan', 1),
(47, 'Farah', 1),
(48, 'Faryab', 1),
(49, 'Gawr', 1),
(50, 'Gazni', 1),
(51, 'Herat', 1),
(52, 'Hilmand', 1),
(53, 'Jawzjan', 1),
(54, 'Kabul', 1),
(55, 'Kapisa', 1),
(56, 'Khawst', 1),
(57, 'Kunar', 1),
(58, 'Lagman', 1),
(59, 'Lawghar', 1),
(60, 'Nangarhar', 1),
(61, 'Nimruz', 1),
(62, 'Nuristan', 1),
(63, 'Paktika', 1),
(64, 'Paktiya', 1),
(65, 'Parwan', 1),
(66, 'Qandahar', 1),
(67, 'Qunduz', 1),
(68, 'Samangan', 1),
(69, 'Sar-e Pul', 1),
(70, 'Takhar', 1),
(71, 'Uruzgan', 1),
(72, 'Wardag', 1),
(73, 'Zabul', 1),
(74, 'Berat', 2),
(75, 'Bulqize', 2),
(76, 'Delvine', 2),
(77, 'Devoll', 2),
(78, 'Dibre', 2),
(79, 'Durres', 2),
(80, 'Elbasan', 2),
(81, 'Fier', 2),
(82, 'Gjirokaster', 2),
(83, 'Gramsh', 2),
(84, 'Has', 2),
(85, 'Kavaje', 2),
(86, 'Kolonje', 2),
(87, 'Korce', 2),
(88, 'Kruje', 2),
(89, 'Kucove', 2),
(90, 'Kukes', 2),
(91, 'Kurbin', 2),
(92, 'Lezhe', 2),
(93, 'Librazhd', 2),
(94, 'Lushnje', 2),
(95, 'Mallakaster', 2),
(96, 'Malsi e Madhe', 2),
(97, 'Mat', 2),
(98, 'Mirdite', 2),
(99, 'Peqin', 2),
(100, 'Permet', 2),
(101, 'Pogradec', 2),
(102, 'Puke', 2),
(103, 'Sarande', 2),
(104, 'Shkoder', 2),
(105, 'Skrapar', 2),
(106, 'Tepelene', 2),
(107, 'Tirane', 2),
(108, 'Tropoje', 2),
(109, 'Vlore', 2),
(110, 'Ayn Daflah', 3),
(111, 'Ayn Tamushanat', 3),
(112, 'Adrar', 3),
(113, 'Algiers', 3),
(114, 'Annabah', 3),
(115, 'Bashshar', 3),
(116, 'Batnah', 3),
(117, 'Bijayah', 3),
(118, 'Biskrah', 3),
(119, 'Blidah', 3),
(120, 'Buirah', 3),
(121, 'Bumardas', 3),
(122, 'Burj Bu Arririj', 3),
(123, 'Ghalizan', 3),
(124, 'Ghardayah', 3),
(125, 'Ilizi', 3),
(126, 'Jijili', 3),
(127, 'Jilfah', 3),
(128, 'Khanshalah', 3),
(129, 'Masilah', 3),
(130, 'Midyah', 3),
(131, 'Milah', 3),
(132, 'Muaskar', 3),
(133, 'Mustaghanam', 3),
(134, 'Naama', 3),
(135, 'Oran', 3),
(136, 'Ouargla', 3),
(137, 'Qalmah', 3),
(138, 'Qustantinah', 3),
(139, 'Sakikdah', 3),
(140, 'Satif', 3),
(141, 'Sayda\'', 3),
(142, 'Sidi ban-al-\'Abbas', 3),
(143, 'Suq Ahras', 3),
(144, 'Tamanghasat', 3),
(145, 'Tibazah', 3),
(146, 'Tibissah', 3),
(147, 'Tilimsan', 3),
(148, 'Tinduf', 3),
(149, 'Tisamsilt', 3),
(150, 'Tiyarat', 3),
(151, 'Tizi Wazu', 3),
(152, 'Umm-al-Bawaghi', 3),
(153, 'Wahran', 3),
(154, 'Warqla', 3),
(155, 'Wilaya d Alger', 3),
(156, 'Wilaya de Bejaia', 3),
(157, 'Wilaya de Constantine', 3),
(158, 'al-Aghwat', 3),
(159, 'al-Bayadh', 3),
(160, 'al-Jaza\'ir', 3),
(161, 'al-Wad', 3),
(162, 'ash-Shalif', 3),
(163, 'at-Tarif', 3),
(164, 'Eastern', 4),
(165, 'Manu\'a', 4),
(166, 'Swains Island', 4),
(167, 'Western', 4),
(168, 'Andorra la Vella', 5),
(169, 'Canillo', 5),
(170, 'Encamp', 5),
(171, 'La Massana', 5),
(172, 'Les Escaldes', 5),
(173, 'Ordino', 5),
(174, 'Sant Julia de Loria', 5),
(175, 'Bengo', 6),
(176, 'Benguela', 6),
(177, 'Bie', 6),
(178, 'Cabinda', 6),
(179, 'Cunene', 6),
(180, 'Huambo', 6),
(181, 'Huila', 6),
(182, 'Kuando-Kubango', 6),
(183, 'Kwanza Norte', 6),
(184, 'Kwanza Sul', 6),
(185, 'Luanda', 6),
(186, 'Lunda Norte', 6),
(187, 'Lunda Sul', 6),
(188, 'Malanje', 6),
(189, 'Moxico', 6),
(190, 'Namibe', 6),
(191, 'Uige', 6),
(192, 'Zaire', 6),
(193, 'Other Provinces', 7),
(194, 'Sector claimed by Argentina/Ch', 8),
(195, 'Sector claimed by Argentina/UK', 8),
(196, 'Sector claimed by Australia', 8),
(197, 'Sector claimed by France', 8),
(198, 'Sector claimed by New Zealand', 8),
(199, 'Sector claimed by Norway', 8),
(200, 'Unclaimed Sector', 8),
(201, 'Barbuda', 9),
(202, 'Saint George', 9),
(203, 'Saint John', 9),
(204, 'Saint Mary', 9),
(205, 'Saint Paul', 9),
(206, 'Saint Peter', 9),
(207, 'Saint Philip', 9),
(208, 'Buenos Aires', 10),
(209, 'Catamarca', 10),
(210, 'Chaco', 10),
(211, 'Chubut', 10),
(212, 'Cordoba', 10),
(213, 'Corrientes', 10),
(214, 'Distrito Federal', 10),
(215, 'Entre Rios', 10),
(216, 'Formosa', 10),
(217, 'Jujuy', 10),
(218, 'La Pampa', 10),
(219, 'La Rioja', 10),
(220, 'Mendoza', 10),
(221, 'Misiones', 10),
(222, 'Neuquen', 10),
(223, 'Rio Negro', 10),
(224, 'Salta', 10),
(225, 'San Juan', 10),
(226, 'San Luis', 10),
(227, 'Santa Cruz', 10),
(228, 'Santa Fe', 10),
(229, 'Santiago del Estero', 10),
(230, 'Tierra del Fuego', 10),
(231, 'Tucuman', 10),
(232, 'Aragatsotn', 11),
(233, 'Ararat', 11),
(234, 'Armavir', 11),
(235, 'Gegharkunik', 11),
(236, 'Kotaik', 11),
(237, 'Lori', 11),
(238, 'Shirak', 11),
(239, 'Stepanakert', 11),
(240, 'Syunik', 11),
(241, 'Tavush', 11),
(242, 'Vayots Dzor', 11),
(243, 'Yerevan', 11),
(244, 'Aruba', 12),
(245, 'Auckland', 13),
(246, 'Australian Capital Territory', 13),
(247, 'Balgowlah', 13),
(248, 'Balmain', 13),
(249, 'Bankstown', 13),
(250, 'Baulkham Hills', 13),
(251, 'Bonnet Bay', 13),
(252, 'Camberwell', 13),
(253, 'Carole Park', 13),
(254, 'Castle Hill', 13),
(255, 'Caulfield', 13),
(256, 'Chatswood', 13),
(257, 'Cheltenham', 13),
(258, 'Cherrybrook', 13),
(259, 'Clayton', 13),
(260, 'Collingwood', 13),
(261, 'Frenchs Forest', 13),
(262, 'Hawthorn', 13),
(263, 'Jannnali', 13),
(264, 'Knoxfield', 13),
(265, 'Melbourne', 13),
(266, 'New South Wales', 13),
(267, 'Northern Territory', 13),
(268, 'Perth', 13),
(269, 'Queensland', 13),
(270, 'South Australia', 13),
(271, 'Tasmania', 13),
(272, 'Templestowe', 13),
(273, 'Victoria', 13),
(274, 'Werribee south', 13),
(275, 'Western Australia', 13),
(276, 'Wheeler', 13),
(277, 'Bundesland Salzburg', 14),
(278, 'Bundesland Steiermark', 14),
(279, 'Bundesland Tirol', 14),
(280, 'Burgenland', 14),
(281, 'Carinthia', 14),
(282, 'Karnten', 14),
(283, 'Liezen', 14),
(284, 'Lower Austria', 14),
(285, 'Niederosterreich', 14),
(286, 'Oberosterreich', 14),
(287, 'Salzburg', 14),
(288, 'Schleswig-Holstein', 14),
(289, 'Steiermark', 14),
(290, 'Styria', 14),
(291, 'Tirol', 14),
(292, 'Upper Austria', 14),
(293, 'Vorarlberg', 14),
(294, 'Wien', 14),
(295, 'Abseron', 15),
(296, 'Baki Sahari', 15),
(297, 'Ganca', 15),
(298, 'Ganja', 15),
(299, 'Kalbacar', 15),
(300, 'Lankaran', 15),
(301, 'Mil-Qarabax', 15),
(302, 'Mugan-Salyan', 15),
(303, 'Nagorni-Qarabax', 15),
(304, 'Naxcivan', 15),
(305, 'Priaraks', 15),
(306, 'Qazax', 15),
(307, 'Saki', 15),
(308, 'Sirvan', 15),
(309, 'Xacmaz', 15),
(310, 'Abaco', 16),
(311, 'Acklins Island', 16),
(312, 'Andros', 16),
(313, 'Berry Islands', 16),
(314, 'Biminis', 16),
(315, 'Cat Island', 16),
(316, 'Crooked Island', 16),
(317, 'Eleuthera', 16),
(318, 'Exuma and Cays', 16),
(319, 'Grand Bahama', 16),
(320, 'Inagua Islands', 16),
(321, 'Long Island', 16),
(322, 'Mayaguana', 16),
(323, 'New Providence', 16),
(324, 'Ragged Island', 16),
(325, 'Rum Cay', 16),
(326, 'San Salvador', 16),
(327, '\'Isa', 17),
(328, 'Badiyah', 17),
(329, 'Hidd', 17),
(330, 'Jidd Hafs', 17),
(331, 'Mahama', 17),
(332, 'Manama', 17),
(333, 'Sitrah', 17),
(334, 'al-Manamah', 17),
(335, 'al-Muharraq', 17),
(336, 'ar-Rifa\'a', 17),
(337, 'Bagar Hat', 18),
(338, 'Bandarban', 18),
(339, 'Barguna', 18),
(340, 'Barisal', 18),
(341, 'Bhola', 18),
(342, 'Bogora', 18),
(343, 'Brahman Bariya', 18),
(344, 'Chandpur', 18),
(345, 'Chattagam', 18),
(346, 'Chittagong Division', 18),
(347, 'Chuadanga', 18),
(348, 'Dhaka', 18),
(349, 'Dinajpur', 18),
(350, 'Faridpur', 18),
(351, 'Feni', 18),
(352, 'Gaybanda', 18),
(353, 'Gazipur', 18),
(354, 'Gopalganj', 18),
(355, 'Habiganj', 18),
(356, 'Jaipur Hat', 18),
(357, 'Jamalpur', 18),
(358, 'Jessor', 18),
(359, 'Jhalakati', 18),
(360, 'Jhanaydah', 18),
(361, 'Khagrachhari', 18),
(362, 'Khulna', 18),
(363, 'Kishorganj', 18),
(364, 'Koks Bazar', 18),
(365, 'Komilla', 18),
(366, 'Kurigram', 18),
(367, 'Kushtiya', 18),
(368, 'Lakshmipur', 18),
(369, 'Lalmanir Hat', 18),
(370, 'Madaripur', 18),
(371, 'Magura', 18),
(372, 'Maimansingh', 18),
(373, 'Manikganj', 18),
(374, 'Maulvi Bazar', 18),
(375, 'Meherpur', 18),
(376, 'Munshiganj', 18),
(377, 'Naral', 18),
(378, 'Narayanganj', 18),
(379, 'Narsingdi', 18),
(380, 'Nator', 18),
(381, 'Naugaon', 18),
(382, 'Nawabganj', 18),
(383, 'Netrakona', 18),
(384, 'Nilphamari', 18),
(385, 'Noakhali', 18),
(386, 'Pabna', 18),
(387, 'Panchagarh', 18),
(388, 'Patuakhali', 18),
(389, 'Pirojpur', 18),
(390, 'Rajbari', 18),
(391, 'Rajshahi', 18),
(392, 'Rangamati', 18),
(393, 'Rangpur', 18),
(394, 'Satkhira', 18),
(395, 'Shariatpur', 18),
(396, 'Sherpur', 18),
(397, 'Silhat', 18),
(398, 'Sirajganj', 18),
(399, 'Sunamganj', 18),
(400, 'Tangayal', 18),
(401, 'Thakurgaon', 18),
(402, 'Christ Church', 19),
(403, 'Saint Andrew', 19),
(404, 'Saint George', 19),
(405, 'Saint James', 19),
(406, 'Saint John', 19),
(407, 'Saint Joseph', 19),
(408, 'Saint Lucy', 19),
(409, 'Saint Michael', 19),
(410, 'Saint Peter', 19),
(411, 'Saint Philip', 19),
(412, 'Saint Thomas', 19),
(413, 'Brest', 20),
(414, 'Homjel\'', 20),
(415, 'Hrodna', 20),
(416, 'Mahiljow', 20),
(417, 'Mahilyowskaya Voblasts', 20),
(418, 'Minsk', 20),
(419, 'Minskaja Voblasts\'', 20),
(420, 'Petrik', 20),
(421, 'Vicebsk', 20),
(422, 'Antwerpen', 21),
(423, 'Berchem', 21),
(424, 'Brabant', 21),
(425, 'Brabant Wallon', 21),
(426, 'Brussel', 21),
(427, 'East Flanders', 21),
(428, 'Hainaut', 21),
(429, 'Liege', 21),
(430, 'Limburg', 21),
(431, 'Luxembourg', 21),
(432, 'Namur', 21),
(433, 'Ontario', 21),
(434, 'Oost-Vlaanderen', 21),
(435, 'Provincie Brabant', 21),
(436, 'Vlaams-Brabant', 21),
(437, 'Wallonne', 21),
(438, 'West-Vlaanderen', 21),
(439, 'Belize', 22),
(440, 'Cayo', 22),
(441, 'Corozal', 22),
(442, 'Orange Walk', 22),
(443, 'Stann Creek', 22),
(444, 'Toledo', 22),
(445, 'Alibori', 23),
(446, 'Atacora', 23),
(447, 'Atlantique', 23),
(448, 'Borgou', 23),
(449, 'Collines', 23),
(450, 'Couffo', 23),
(451, 'Donga', 23),
(452, 'Littoral', 23),
(453, 'Mono', 23),
(454, 'Oueme', 23),
(455, 'Plateau', 23),
(456, 'Zou', 23),
(457, 'Hamilton', 24),
(458, 'Saint George', 24),
(459, 'Bumthang', 25),
(460, 'Chhukha', 25),
(461, 'Chirang', 25),
(462, 'Daga', 25),
(463, 'Geylegphug', 25),
(464, 'Ha', 25),
(465, 'Lhuntshi', 25),
(466, 'Mongar', 25),
(467, 'Pemagatsel', 25),
(468, 'Punakha', 25),
(469, 'Rinpung', 25),
(470, 'Samchi', 25),
(471, 'Samdrup Jongkhar', 25),
(472, 'Shemgang', 25),
(473, 'Tashigang', 25),
(474, 'Timphu', 25),
(475, 'Tongsa', 25),
(476, 'Wangdiphodrang', 25),
(477, 'Beni', 26),
(478, 'Chuquisaca', 26),
(479, 'Cochabamba', 26),
(480, 'La Paz', 26),
(481, 'Oruro', 26),
(482, 'Pando', 26),
(483, 'Potosi', 26),
(484, 'Santa Cruz', 26),
(485, 'Tarija', 26),
(486, 'Federacija Bosna i Hercegovina', 27),
(487, 'Republika Srpska', 27),
(488, 'Central Bobonong', 28),
(489, 'Central Boteti', 28),
(490, 'Central Mahalapye', 28),
(491, 'Central Serowe-Palapye', 28),
(492, 'Central Tutume', 28),
(493, 'Chobe', 28),
(494, 'Francistown', 28),
(495, 'Gaborone', 28),
(496, 'Ghanzi', 28),
(497, 'Jwaneng', 28),
(498, 'Kgalagadi North', 28),
(499, 'Kgalagadi South', 28),
(500, 'Kgatleng', 28),
(501, 'Kweneng', 28),
(502, 'Lobatse', 28),
(503, 'Ngamiland', 28),
(504, 'Ngwaketse', 28),
(505, 'North East', 28),
(506, 'Okavango', 28),
(507, 'Orapa', 28),
(508, 'Selibe Phikwe', 28),
(509, 'South East', 28),
(510, 'Sowa', 28),
(511, 'Bouvet Island', 29),
(512, 'Acre', 30),
(513, 'Alagoas', 30),
(514, 'Amapa', 30),
(515, 'Amazonas', 30),
(516, 'Bahia', 30),
(517, 'Ceara', 30),
(518, 'Distrito Federal', 30),
(519, 'Espirito Santo', 30),
(520, 'Estado de Sao Paulo', 30),
(521, 'Goias', 30),
(522, 'Maranhao', 30),
(523, 'Mato Grosso', 30),
(524, 'Mato Grosso do Sul', 30),
(525, 'Minas Gerais', 30),
(526, 'Para', 30),
(527, 'Paraiba', 30),
(528, 'Parana', 30),
(529, 'Pernambuco', 30),
(530, 'Piaui', 30),
(531, 'Rio Grande do Norte', 30),
(532, 'Rio Grande do Sul', 30),
(533, 'Rio de Janeiro', 30),
(534, 'Rondonia', 30),
(535, 'Roraima', 30),
(536, 'Santa Catarina', 30),
(537, 'Sao Paulo', 30),
(538, 'Sergipe', 30),
(539, 'Tocantins', 30),
(540, 'British Indian Ocean Territory', 31),
(541, 'Belait', 32),
(542, 'Brunei-Muara', 32),
(543, 'Temburong', 32),
(544, 'Tutong', 32),
(545, 'Blagoevgrad', 33),
(546, 'Burgas', 33),
(547, 'Dobrich', 33),
(548, 'Gabrovo', 33),
(549, 'Haskovo', 33),
(550, 'Jambol', 33),
(551, 'Kardzhali', 33),
(552, 'Kjustendil', 33),
(553, 'Lovech', 33),
(554, 'Montana', 33),
(555, 'Oblast Sofiya-Grad', 33),
(556, 'Pazardzhik', 33),
(557, 'Pernik', 33),
(558, 'Pleven', 33),
(559, 'Plovdiv', 33),
(560, 'Razgrad', 33),
(561, 'Ruse', 33),
(562, 'Shumen', 33),
(563, 'Silistra', 33),
(564, 'Sliven', 33),
(565, 'Smoljan', 33),
(566, 'Sofija grad', 33),
(567, 'Sofijska oblast', 33),
(568, 'Stara Zagora', 33),
(569, 'Targovishte', 33),
(570, 'Varna', 33),
(571, 'Veliko Tarnovo', 33),
(572, 'Vidin', 33),
(573, 'Vraca', 33),
(574, 'Yablaniza', 33),
(575, 'Bale', 34),
(576, 'Bam', 34),
(577, 'Bazega', 34),
(578, 'Bougouriba', 34),
(579, 'Boulgou', 34),
(580, 'Boulkiemde', 34),
(581, 'Comoe', 34),
(582, 'Ganzourgou', 34),
(583, 'Gnagna', 34),
(584, 'Gourma', 34),
(585, 'Houet', 34),
(586, 'Ioba', 34),
(587, 'Kadiogo', 34),
(588, 'Kenedougou', 34),
(589, 'Komandjari', 34),
(590, 'Kompienga', 34),
(591, 'Kossi', 34),
(592, 'Kouritenga', 34),
(593, 'Kourweogo', 34),
(594, 'Leraba', 34),
(595, 'Mouhoun', 34),
(596, 'Nahouri', 34),
(597, 'Namentenga', 34),
(598, 'Noumbiel', 34),
(599, 'Oubritenga', 34),
(600, 'Oudalan', 34),
(601, 'Passore', 34),
(602, 'Poni', 34),
(603, 'Sanguie', 34),
(604, 'Sanmatenga', 34),
(605, 'Seno', 34),
(606, 'Sissili', 34),
(607, 'Soum', 34),
(608, 'Sourou', 34),
(609, 'Tapoa', 34),
(610, 'Tuy', 34),
(611, 'Yatenga', 34),
(612, 'Zondoma', 34),
(613, 'Zoundweogo', 34),
(614, 'Bubanza', 35),
(615, 'Bujumbura', 35),
(616, 'Bururi', 35),
(617, 'Cankuzo', 35),
(618, 'Cibitoke', 35),
(619, 'Gitega', 35),
(620, 'Karuzi', 35),
(621, 'Kayanza', 35),
(622, 'Kirundo', 35),
(623, 'Makamba', 35),
(624, 'Muramvya', 35),
(625, 'Muyinga', 35),
(626, 'Ngozi', 35),
(627, 'Rutana', 35),
(628, 'Ruyigi', 35),
(629, 'Banteay Mean Chey', 36),
(630, 'Bat Dambang', 36),
(631, 'Kampong Cham', 36),
(632, 'Kampong Chhnang', 36),
(633, 'Kampong Spoeu', 36),
(634, 'Kampong Thum', 36),
(635, 'Kampot', 36),
(636, 'Kandal', 36),
(637, 'Kaoh Kong', 36),
(638, 'Kracheh', 36),
(639, 'Krong Kaeb', 36),
(640, 'Krong Pailin', 36),
(641, 'Krong Preah Sihanouk', 36),
(642, 'Mondol Kiri', 36),
(643, 'Otdar Mean Chey', 36),
(644, 'Phnum Penh', 36),
(645, 'Pousat', 36),
(646, 'Preah Vihear', 36),
(647, 'Prey Veaeng', 36),
(648, 'Rotanak Kiri', 36),
(649, 'Siem Reab', 36),
(650, 'Stueng Traeng', 36),
(651, 'Svay Rieng', 36),
(652, 'Takaev', 36),
(653, 'Adamaoua', 37),
(654, 'Centre', 37),
(655, 'Est', 37),
(656, 'Littoral', 37),
(657, 'Nord', 37),
(658, 'Nord Extreme', 37),
(659, 'Nordouest', 37),
(660, 'Ouest', 37),
(661, 'Sud', 37),
(662, 'Sudouest', 37),
(663, 'Alberta', 38),
(664, 'British Columbia', 38),
(665, 'Manitoba', 38),
(666, 'New Brunswick', 38),
(667, 'Newfoundland and Labrador', 38),
(668, 'Northwest Territories', 38),
(669, 'Nova Scotia', 38),
(670, 'Nunavut', 38),
(671, 'Ontario', 38),
(672, 'Prince Edward Island', 38),
(673, 'Quebec', 38),
(674, 'Saskatchewan', 38),
(675, 'Yukon', 38),
(676, 'Boavista', 39),
(677, 'Brava', 39),
(678, 'Fogo', 39),
(679, 'Maio', 39),
(680, 'Sal', 39),
(681, 'Santo Antao', 39),
(682, 'Sao Nicolau', 39),
(683, 'Sao Tiago', 39),
(684, 'Sao Vicente', 39),
(685, 'Grand Cayman', 40),
(686, 'Bamingui-Bangoran', 41),
(687, 'Bangui', 41),
(688, 'Basse-Kotto', 41),
(689, 'Haut-Mbomou', 41),
(690, 'Haute-Kotto', 41),
(691, 'Kemo', 41),
(692, 'Lobaye', 41),
(693, 'Mambere-Kadei', 41),
(694, 'Mbomou', 41),
(695, 'Nana-Gribizi', 41),
(696, 'Nana-Mambere', 41),
(697, 'Ombella Mpoko', 41),
(698, 'Ouaka', 41),
(699, 'Ouham', 41),
(700, 'Ouham-Pende', 41),
(701, 'Sangha-Mbaere', 41),
(702, 'Vakaga', 41),
(703, 'Batha', 42),
(704, 'Biltine', 42),
(705, 'Bourkou-Ennedi-Tibesti', 42),
(706, 'Chari-Baguirmi', 42),
(707, 'Guera', 42),
(708, 'Kanem', 42),
(709, 'Lac', 42),
(710, 'Logone Occidental', 42),
(711, 'Logone Oriental', 42),
(712, 'Mayo-Kebbi', 42),
(713, 'Moyen-Chari', 42),
(714, 'Ouaddai', 42),
(715, 'Salamat', 42),
(716, 'Tandjile', 42),
(717, 'Aisen', 43),
(718, 'Antofagasta', 43),
(719, 'Araucania', 43),
(720, 'Atacama', 43),
(721, 'Bio Bio', 43),
(722, 'Coquimbo', 43),
(723, 'Libertador General Bernardo O\'', 43),
(724, 'Los Lagos', 43),
(725, 'Magellanes', 43),
(726, 'Maule', 43),
(727, 'Metropolitana', 43),
(728, 'Metropolitana de Santiago', 43),
(729, 'Tarapaca', 43),
(730, 'Valparaiso', 43),
(731, 'Anhui', 44),
(732, 'Anhui Province', 44),
(733, 'Anhui Sheng', 44),
(734, 'Aomen', 44),
(735, 'Beijing', 44),
(736, 'Beijing Shi', 44),
(737, 'Chongqing', 44),
(738, 'Fujian', 44),
(739, 'Fujian Sheng', 44),
(740, 'Gansu', 44),
(741, 'Guangdong', 44),
(742, 'Guangdong Sheng', 44),
(743, 'Guangxi', 44),
(744, 'Guizhou', 44),
(745, 'Hainan', 44),
(746, 'Hebei', 44),
(747, 'Heilongjiang', 44),
(748, 'Henan', 44),
(749, 'Hubei', 44),
(750, 'Hunan', 44),
(751, 'Jiangsu', 44),
(752, 'Jiangsu Sheng', 44),
(753, 'Jiangxi', 44),
(754, 'Jilin', 44),
(755, 'Liaoning', 44),
(756, 'Liaoning Sheng', 44),
(757, 'Nei Monggol', 44),
(758, 'Ningxia Hui', 44),
(759, 'Qinghai', 44),
(760, 'Shaanxi', 44),
(761, 'Shandong', 44),
(762, 'Shandong Sheng', 44),
(763, 'Shanghai', 44),
(764, 'Shanxi', 44),
(765, 'Sichuan', 44),
(766, 'Tianjin', 44),
(767, 'Xianggang', 44),
(768, 'Xinjiang', 44),
(769, 'Xizang', 44),
(770, 'Yunnan', 44),
(771, 'Zhejiang', 44),
(772, 'Zhejiang Sheng', 44),
(773, 'Christmas Island', 45),
(774, 'Cocos (Keeling) Islands', 46),
(775, 'Amazonas', 47),
(776, 'Antioquia', 47),
(777, 'Arauca', 47),
(778, 'Atlantico', 47),
(779, 'Bogota', 47),
(780, 'Bolivar', 47),
(781, 'Boyaca', 47),
(782, 'Caldas', 47),
(783, 'Caqueta', 47),
(784, 'Casanare', 47),
(785, 'Cauca', 47),
(786, 'Cesar', 47),
(787, 'Choco', 47),
(788, 'Cordoba', 47),
(789, 'Cundinamarca', 47),
(790, 'Guainia', 47),
(791, 'Guaviare', 47),
(792, 'Huila', 47),
(793, 'La Guajira', 47),
(794, 'Magdalena', 47),
(795, 'Meta', 47),
(796, 'Narino', 47),
(797, 'Norte de Santander', 47),
(798, 'Putumayo', 47),
(799, 'Quindio', 47),
(800, 'Risaralda', 47),
(801, 'San Andres y Providencia', 47),
(802, 'Santander', 47),
(803, 'Sucre', 47),
(804, 'Tolima', 47),
(805, 'Valle del Cauca', 47),
(806, 'Vaupes', 47),
(807, 'Vichada', 47),
(808, 'Mwali', 48),
(809, 'Njazidja', 48),
(810, 'Nzwani', 48),
(811, 'Bouenza', 49),
(812, 'Brazzaville', 49),
(813, 'Cuvette', 49),
(814, 'Kouilou', 49),
(815, 'Lekoumou', 49),
(816, 'Likouala', 49),
(817, 'Niari', 49),
(818, 'Plateaux', 49),
(819, 'Pool', 49),
(820, 'Sangha', 49),
(821, 'Bandundu', 50),
(822, 'Bas-Congo', 50),
(823, 'Equateur', 50),
(824, 'Haut-Congo', 50),
(825, 'Kasai-Occidental', 50),
(826, 'Kasai-Oriental', 50),
(827, 'Katanga', 50),
(828, 'Kinshasa', 50),
(829, 'Maniema', 50),
(830, 'Nord-Kivu', 50),
(831, 'Sud-Kivu', 50),
(832, 'Aitutaki', 51),
(833, 'Atiu', 51),
(834, 'Mangaia', 51),
(835, 'Manihiki', 51),
(836, 'Mauke', 51),
(837, 'Mitiaro', 51),
(838, 'Nassau', 51),
(839, 'Pukapuka', 51),
(840, 'Rakahanga', 51),
(841, 'Rarotonga', 51),
(842, 'Tongareva', 51),
(843, 'Alajuela', 52),
(844, 'Cartago', 52),
(845, 'Guanacaste', 52),
(846, 'Heredia', 52),
(847, 'Limon', 52),
(848, 'Puntarenas', 52),
(849, 'San Jose', 52),
(850, 'Abidjan', 53),
(851, 'Agneby', 53),
(852, 'Bafing', 53),
(853, 'Denguele', 53),
(854, 'Dix-huit Montagnes', 53),
(855, 'Fromager', 53),
(856, 'Haut-Sassandra', 53),
(857, 'Lacs', 53),
(858, 'Lagunes', 53),
(859, 'Marahoue', 53),
(860, 'Moyen-Cavally', 53),
(861, 'Moyen-Comoe', 53),
(862, 'N\'zi-Comoe', 53),
(863, 'Sassandra', 53),
(864, 'Savanes', 53),
(865, 'Sud-Bandama', 53),
(866, 'Sud-Comoe', 53),
(867, 'Vallee du Bandama', 53),
(868, 'Worodougou', 53),
(869, 'Zanzan', 53),
(870, 'Bjelovar-Bilogora', 54),
(871, 'Dubrovnik-Neretva', 54),
(872, 'Grad Zagreb', 54),
(873, 'Istra', 54),
(874, 'Karlovac', 54),
(875, 'Koprivnica-Krizhevci', 54),
(876, 'Krapina-Zagorje', 54),
(877, 'Lika-Senj', 54),
(878, 'Medhimurje', 54),
(879, 'Medimurska Zupanija', 54),
(880, 'Osijek-Baranja', 54),
(881, 'Osjecko-Baranjska Zupanija', 54),
(882, 'Pozhega-Slavonija', 54),
(883, 'Primorje-Gorski Kotar', 54),
(884, 'Shibenik-Knin', 54),
(885, 'Sisak-Moslavina', 54),
(886, 'Slavonski Brod-Posavina', 54),
(887, 'Split-Dalmacija', 54),
(888, 'Varazhdin', 54),
(889, 'Virovitica-Podravina', 54),
(890, 'Vukovar-Srijem', 54),
(891, 'Zadar', 54),
(892, 'Zagreb', 54),
(893, 'Camaguey', 55),
(894, 'Ciego de Avila', 55),
(895, 'Cienfuegos', 55),
(896, 'Ciudad de la Habana', 55),
(897, 'Granma', 55),
(898, 'Guantanamo', 55),
(899, 'Habana', 55),
(900, 'Holguin', 55),
(901, 'Isla de la Juventud', 55),
(902, 'La Habana', 55),
(903, 'Las Tunas', 55),
(904, 'Matanzas', 55),
(905, 'Pinar del Rio', 55),
(906, 'Sancti Spiritus', 55),
(907, 'Santiago de Cuba', 55),
(908, 'Villa Clara', 55),
(909, 'Government controlled area', 56),
(910, 'Limassol', 56),
(911, 'Nicosia District', 56),
(912, 'Paphos', 56),
(913, 'Turkish controlled area', 56),
(914, 'Central Bohemian', 57),
(915, 'Frycovice', 57),
(916, 'Jihocesky Kraj', 57),
(917, 'Jihochesky', 57),
(918, 'Jihomoravsky', 57),
(919, 'Karlovarsky', 57),
(920, 'Klecany', 57),
(921, 'Kralovehradecky', 57),
(922, 'Liberecky', 57),
(923, 'Lipov', 57),
(924, 'Moravskoslezsky', 57),
(925, 'Olomoucky', 57),
(926, 'Olomoucky Kraj', 57),
(927, 'Pardubicky', 57),
(928, 'Plzensky', 57),
(929, 'Praha', 57),
(930, 'Rajhrad', 57),
(931, 'Smirice', 57),
(932, 'South Moravian', 57),
(933, 'Straz nad Nisou', 57),
(934, 'Stredochesky', 57),
(935, 'Unicov', 57),
(936, 'Ustecky', 57),
(937, 'Valletta', 57),
(938, 'Velesin', 57),
(939, 'Vysochina', 57),
(940, 'Zlinsky', 57),
(941, 'Arhus', 58),
(942, 'Bornholm', 58),
(943, 'Frederiksborg', 58),
(944, 'Fyn', 58),
(945, 'Hovedstaden', 58),
(946, 'Kobenhavn', 58),
(947, 'Kobenhavns Amt', 58),
(948, 'Kobenhavns Kommune', 58),
(949, 'Nordjylland', 58),
(950, 'Ribe', 58),
(951, 'Ringkobing', 58),
(952, 'Roervig', 58),
(953, 'Roskilde', 58),
(954, 'Roslev', 58),
(955, 'Sjaelland', 58),
(956, 'Soeborg', 58),
(957, 'Sonderjylland', 58),
(958, 'Storstrom', 58),
(959, 'Syddanmark', 58),
(960, 'Toelloese', 58),
(961, 'Vejle', 58),
(962, 'Vestsjalland', 58),
(963, 'Viborg', 58),
(964, '\'Ali Sabih', 59),
(965, 'Dikhil', 59),
(966, 'Jibuti', 59),
(967, 'Tajurah', 59),
(968, 'Ubuk', 59),
(969, 'Saint Andrew', 60),
(970, 'Saint David', 60),
(971, 'Saint George', 60),
(972, 'Saint John', 60),
(973, 'Saint Joseph', 60),
(974, 'Saint Luke', 60),
(975, 'Saint Mark', 60),
(976, 'Saint Patrick', 60),
(977, 'Saint Paul', 60),
(978, 'Saint Peter', 60),
(979, 'Azua', 61),
(980, 'Bahoruco', 61),
(981, 'Barahona', 61),
(982, 'Dajabon', 61),
(983, 'Distrito Nacional', 61),
(984, 'Duarte', 61),
(985, 'El Seybo', 61),
(986, 'Elias Pina', 61),
(987, 'Espaillat', 61),
(988, 'Hato Mayor', 61),
(989, 'Independencia', 61),
(990, 'La Altagracia', 61),
(991, 'La Romana', 61),
(992, 'La Vega', 61),
(993, 'Maria Trinidad Sanchez', 61),
(994, 'Monsenor Nouel', 61),
(995, 'Monte Cristi', 61),
(996, 'Monte Plata', 61),
(997, 'Pedernales', 61),
(998, 'Peravia', 61),
(999, 'Puerto Plata', 61),
(1000, 'Salcedo', 61),
(1001, 'Samana', 61),
(1002, 'San Cristobal', 61),
(1003, 'San Juan', 61),
(1004, 'San Pedro de Macoris', 61),
(1005, 'Sanchez Ramirez', 61),
(1006, 'Santiago', 61),
(1007, 'Santiago Rodriguez', 61),
(1008, 'Valverde', 61),
(1009, 'Aileu', 62),
(1010, 'Ainaro', 62),
(1011, 'Ambeno', 62),
(1012, 'Baucau', 62),
(1013, 'Bobonaro', 62),
(1014, 'Cova Lima', 62),
(1015, 'Dili', 62),
(1016, 'Ermera', 62),
(1017, 'Lautem', 62),
(1018, 'Liquica', 62),
(1019, 'Manatuto', 62),
(1020, 'Manufahi', 62),
(1021, 'Viqueque', 62),
(1022, 'Azuay', 63),
(1023, 'Bolivar', 63),
(1024, 'Canar', 63),
(1025, 'Carchi', 63),
(1026, 'Chimborazo', 63),
(1027, 'Cotopaxi', 63),
(1028, 'El Oro', 63),
(1029, 'Esmeraldas', 63),
(1030, 'Galapagos', 63),
(1031, 'Guayas', 63),
(1032, 'Imbabura', 63),
(1033, 'Loja', 63),
(1034, 'Los Rios', 63),
(1035, 'Manabi', 63),
(1036, 'Morona Santiago', 63),
(1037, 'Napo', 63),
(1038, 'Orellana', 63),
(1039, 'Pastaza', 63),
(1040, 'Pichincha', 63),
(1041, 'Sucumbios', 63),
(1042, 'Tungurahua', 63),
(1043, 'Zamora Chinchipe', 63),
(1044, 'Aswan', 64),
(1045, 'Asyut', 64),
(1046, 'Bani Suwayf', 64),
(1047, 'Bur Sa\'id', 64),
(1048, 'Cairo', 64),
(1049, 'Dumyat', 64),
(1050, 'Kafr-ash-Shaykh', 64),
(1051, 'Matruh', 64),
(1052, 'Muhafazat ad Daqahliyah', 64),
(1053, 'Muhafazat al Fayyum', 64),
(1054, 'Muhafazat al Gharbiyah', 64),
(1055, 'Muhafazat al Iskandariyah', 64),
(1056, 'Muhafazat al Qahirah', 64),
(1057, 'Qina', 64),
(1058, 'Sawhaj', 64),
(1059, 'Sina al-Janubiyah', 64),
(1060, 'Sina ash-Shamaliyah', 64),
(1061, 'ad-Daqahliyah', 64),
(1062, 'al-Bahr-al-Ahmar', 64),
(1063, 'al-Buhayrah', 64),
(1064, 'al-Fayyum', 64),
(1065, 'al-Gharbiyah', 64),
(1066, 'al-Iskandariyah', 64),
(1067, 'al-Ismailiyah', 64),
(1068, 'al-Jizah', 64),
(1069, 'al-Minufiyah', 64),
(1070, 'al-Minya', 64),
(1071, 'al-Qahira', 64),
(1072, 'al-Qalyubiyah', 64),
(1073, 'al-Uqsur', 64),
(1074, 'al-Wadi al-Jadid', 64),
(1075, 'as-Suways', 64),
(1076, 'ash-Sharqiyah', 64),
(1077, 'Ahuachapan', 65),
(1078, 'Cabanas', 65),
(1079, 'Chalatenango', 65),
(1080, 'Cuscatlan', 65),
(1081, 'La Libertad', 65),
(1082, 'La Paz', 65),
(1083, 'La Union', 65),
(1084, 'Morazan', 65),
(1085, 'San Miguel', 65),
(1086, 'San Salvador', 65),
(1087, 'San Vicente', 65),
(1088, 'Santa Ana', 65),
(1089, 'Sonsonate', 65),
(1090, 'Usulutan', 65),
(1091, 'Annobon', 66),
(1092, 'Bioko Norte', 66),
(1093, 'Bioko Sur', 66),
(1094, 'Centro Sur', 66),
(1095, 'Kie-Ntem', 66),
(1096, 'Litoral', 66),
(1097, 'Wele-Nzas', 66),
(1098, 'Anseba', 67),
(1099, 'Debub', 67),
(1100, 'Debub-Keih-Bahri', 67),
(1101, 'Gash-Barka', 67),
(1102, 'Maekel', 67),
(1103, 'Semien-Keih-Bahri', 67),
(1104, 'Harju', 68),
(1105, 'Hiiu', 68),
(1106, 'Ida-Viru', 68),
(1107, 'Jarva', 68),
(1108, 'Jogeva', 68),
(1109, 'Laane', 68),
(1110, 'Laane-Viru', 68),
(1111, 'Parnu', 68),
(1112, 'Polva', 68),
(1113, 'Rapla', 68),
(1114, 'Saare', 68),
(1115, 'Tartu', 68),
(1116, 'Valga', 68),
(1117, 'Viljandi', 68),
(1118, 'Voru', 68),
(1119, 'Addis Abeba', 69),
(1120, 'Afar', 69),
(1121, 'Amhara', 69),
(1122, 'Benishangul', 69),
(1123, 'Diredawa', 69),
(1124, 'Gambella', 69),
(1125, 'Harar', 69),
(1126, 'Jigjiga', 69),
(1127, 'Mekele', 69),
(1128, 'Oromia', 69),
(1129, 'Somali', 69),
(1130, 'Southern', 69),
(1131, 'Tigray', 69),
(1132, 'Christmas Island', 70),
(1133, 'Cocos Islands', 70),
(1134, 'Coral Sea Islands', 70),
(1135, 'Falkland Islands', 71),
(1136, 'South Georgia', 71),
(1137, 'Klaksvik', 72),
(1138, 'Nor ara Eysturoy', 72),
(1139, 'Nor oy', 72),
(1140, 'Sandoy', 72),
(1141, 'Streymoy', 72),
(1142, 'Su uroy', 72),
(1143, 'Sy ra Eysturoy', 72),
(1144, 'Torshavn', 72),
(1145, 'Vaga', 72),
(1146, 'Central', 73),
(1147, 'Eastern', 73),
(1148, 'Northern', 73),
(1149, 'South Pacific', 73),
(1150, 'Western', 73),
(1151, 'Ahvenanmaa', 74),
(1152, 'Etela-Karjala', 74),
(1153, 'Etela-Pohjanmaa', 74),
(1154, 'Etela-Savo', 74),
(1155, 'Etela-Suomen Laani', 74),
(1156, 'Ita-Suomen Laani', 74),
(1157, 'Ita-Uusimaa', 74),
(1158, 'Kainuu', 74),
(1159, 'Kanta-Hame', 74),
(1160, 'Keski-Pohjanmaa', 74),
(1161, 'Keski-Suomi', 74),
(1162, 'Kymenlaakso', 74),
(1163, 'Lansi-Suomen Laani', 74),
(1164, 'Lappi', 74),
(1165, 'Northern Savonia', 74),
(1166, 'Ostrobothnia', 74),
(1167, 'Oulun Laani', 74),
(1168, 'Paijat-Hame', 74),
(1169, 'Pirkanmaa', 74),
(1170, 'Pohjanmaa', 74),
(1171, 'Pohjois-Karjala', 74),
(1172, 'Pohjois-Pohjanmaa', 74),
(1173, 'Pohjois-Savo', 74),
(1174, 'Saarijarvi', 74),
(1175, 'Satakunta', 74),
(1176, 'Southern Savonia', 74),
(1177, 'Tavastia Proper', 74),
(1178, 'Uleaborgs Lan', 74),
(1179, 'Uusimaa', 74),
(1180, 'Varsinais-Suomi', 74),
(1181, 'Ain', 75),
(1182, 'Aisne', 75),
(1183, 'Albi Le Sequestre', 75),
(1184, 'Allier', 75),
(1185, 'Alpes-Cote dAzur', 75),
(1186, 'Alpes-Maritimes', 75),
(1187, 'Alpes-de-Haute-Provence', 75),
(1188, 'Alsace', 75),
(1189, 'Aquitaine', 75),
(1190, 'Ardeche', 75),
(1191, 'Ardennes', 75),
(1192, 'Ariege', 75),
(1193, 'Aube', 75),
(1194, 'Aude', 75),
(1195, 'Auvergne', 75),
(1196, 'Aveyron', 75),
(1197, 'Bas-Rhin', 75),
(1198, 'Basse-Normandie', 75),
(1199, 'Bouches-du-Rhone', 75),
(1200, 'Bourgogne', 75),
(1201, 'Bretagne', 75),
(1202, 'Brittany', 75),
(1203, 'Burgundy', 75),
(1204, 'Calvados', 75),
(1205, 'Cantal', 75),
(1206, 'Cedex', 75),
(1207, 'Centre', 75),
(1208, 'Charente', 75),
(1209, 'Charente-Maritime', 75),
(1210, 'Cher', 75),
(1211, 'Correze', 75),
(1212, 'Corse-du-Sud', 75),
(1213, 'Cote-d\'Or', 75),
(1214, 'Cotes-d\'Armor', 75),
(1215, 'Creuse', 75),
(1216, 'Crolles', 75),
(1217, 'Deux-Sevres', 75),
(1218, 'Dordogne', 75),
(1219, 'Doubs', 75),
(1220, 'Drome', 75),
(1221, 'Essonne', 75),
(1222, 'Eure', 75),
(1223, 'Eure-et-Loir', 75),
(1224, 'Feucherolles', 75),
(1225, 'Finistere', 75),
(1226, 'Franche-Comte', 75),
(1227, 'Gard', 75),
(1228, 'Gers', 75),
(1229, 'Gironde', 75),
(1230, 'Haut-Rhin', 75),
(1231, 'Haute-Corse', 75),
(1232, 'Haute-Garonne', 75),
(1233, 'Haute-Loire', 75),
(1234, 'Haute-Marne', 75),
(1235, 'Haute-Saone', 75),
(1236, 'Haute-Savoie', 75),
(1237, 'Haute-Vienne', 75),
(1238, 'Hautes-Alpes', 75),
(1239, 'Hautes-Pyrenees', 75),
(1240, 'Hauts-de-Seine', 75),
(1241, 'Herault', 75),
(1242, 'Ile-de-France', 75),
(1243, 'Ille-et-Vilaine', 75),
(1244, 'Indre', 75),
(1245, 'Indre-et-Loire', 75),
(1246, 'Isere', 75),
(1247, 'Jura', 75),
(1248, 'Klagenfurt', 75),
(1249, 'Landes', 75),
(1250, 'Languedoc-Roussillon', 75),
(1251, 'Larcay', 75),
(1252, 'Le Castellet', 75),
(1253, 'Le Creusot', 75),
(1254, 'Limousin', 75),
(1255, 'Loir-et-Cher', 75),
(1256, 'Loire', 75),
(1257, 'Loire-Atlantique', 75),
(1258, 'Loiret', 75),
(1259, 'Lorraine', 75),
(1260, 'Lot', 75),
(1261, 'Lot-et-Garonne', 75),
(1262, 'Lower Normandy', 75),
(1263, 'Lozere', 75),
(1264, 'Maine-et-Loire', 75),
(1265, 'Manche', 75),
(1266, 'Marne', 75),
(1267, 'Mayenne', 75),
(1268, 'Meurthe-et-Moselle', 75),
(1269, 'Meuse', 75),
(1270, 'Midi-Pyrenees', 75),
(1271, 'Morbihan', 75),
(1272, 'Moselle', 75),
(1273, 'Nievre', 75),
(1274, 'Nord', 75),
(1275, 'Nord-Pas-de-Calais', 75),
(1276, 'Oise', 75),
(1277, 'Orne', 75),
(1278, 'Paris', 75),
(1279, 'Pas-de-Calais', 75),
(1280, 'Pays de la Loire', 75),
(1281, 'Pays-de-la-Loire', 75),
(1282, 'Picardy', 75),
(1283, 'Puy-de-Dome', 75),
(1284, 'Pyrenees-Atlantiques', 75),
(1285, 'Pyrenees-Orientales', 75),
(1286, 'Quelmes', 75),
(1287, 'Rhone', 75),
(1288, 'Rhone-Alpes', 75),
(1289, 'Saint Ouen', 75),
(1290, 'Saint Viatre', 75),
(1291, 'Saone-et-Loire', 75),
(1292, 'Sarthe', 75),
(1293, 'Savoie', 75),
(1294, 'Seine-Maritime', 75),
(1295, 'Seine-Saint-Denis', 75),
(1296, 'Seine-et-Marne', 75),
(1297, 'Somme', 75),
(1298, 'Sophia Antipolis', 75),
(1299, 'Souvans', 75),
(1300, 'Tarn', 75),
(1301, 'Tarn-et-Garonne', 75),
(1302, 'Territoire de Belfort', 75),
(1303, 'Treignac', 75),
(1304, 'Upper Normandy', 75),
(1305, 'Val-d\'Oise', 75),
(1306, 'Val-de-Marne', 75),
(1307, 'Var', 75),
(1308, 'Vaucluse', 75),
(1309, 'Vellise', 75),
(1310, 'Vendee', 75),
(1311, 'Vienne', 75),
(1312, 'Vosges', 75),
(1313, 'Yonne', 75),
(1314, 'Yvelines', 75),
(1315, 'Cayenne', 76),
(1316, 'Saint-Laurent-du-Maroni', 76),
(1317, 'Iles du Vent', 77),
(1318, 'Iles sous le Vent', 77),
(1319, 'Marquesas', 77),
(1320, 'Tuamotu', 77),
(1321, 'Tubuai', 77),
(1322, 'Amsterdam', 78),
(1323, 'Crozet Islands', 78),
(1324, 'Kerguelen', 78),
(1325, 'Estuaire', 79),
(1326, 'Haut-Ogooue', 79),
(1327, 'Moyen-Ogooue', 79),
(1328, 'Ngounie', 79),
(1329, 'Nyanga', 79),
(1330, 'Ogooue-Ivindo', 79),
(1331, 'Ogooue-Lolo', 79),
(1332, 'Ogooue-Maritime', 79),
(1333, 'Woleu-Ntem', 79),
(1334, 'Banjul', 80),
(1335, 'Basse', 80),
(1336, 'Brikama', 80),
(1337, 'Janjanbureh', 80),
(1338, 'Kanifing', 80),
(1339, 'Kerewan', 80),
(1340, 'Kuntaur', 80),
(1341, 'Mansakonko', 80),
(1342, 'Abhasia', 81),
(1343, 'Ajaria', 81),
(1344, 'Guria', 81),
(1345, 'Imereti', 81),
(1346, 'Kaheti', 81),
(1347, 'Kvemo Kartli', 81),
(1348, 'Mcheta-Mtianeti', 81),
(1349, 'Racha', 81),
(1350, 'Samagrelo-Zemo Svaneti', 81),
(1351, 'Samche-Zhavaheti', 81),
(1352, 'Shida Kartli', 81),
(1353, 'Tbilisi', 81),
(1354, 'Auvergne', 82),
(1355, 'Baden-Wurttemberg', 82),
(1356, 'Bavaria', 82),
(1357, 'Bayern', 82),
(1358, 'Beilstein Wurtt', 82),
(1359, 'Berlin', 82),
(1360, 'Brandenburg', 82),
(1361, 'Bremen', 82),
(1362, 'Dreisbach', 82),
(1363, 'Freistaat Bayern', 82),
(1364, 'Hamburg', 82),
(1365, 'Hannover', 82),
(1366, 'Heroldstatt', 82),
(1367, 'Hessen', 82),
(1368, 'Kortenberg', 82),
(1369, 'Laasdorf', 82),
(1370, 'Land Baden-Wurttemberg', 82),
(1371, 'Land Bayern', 82),
(1372, 'Land Brandenburg', 82),
(1373, 'Land Hessen', 82),
(1374, 'Land Mecklenburg-Vorpommern', 82),
(1375, 'Land Nordrhein-Westfalen', 82),
(1376, 'Land Rheinland-Pfalz', 82),
(1377, 'Land Sachsen', 82),
(1378, 'Land Sachsen-Anhalt', 82),
(1379, 'Land Thuringen', 82),
(1380, 'Lower Saxony', 82),
(1381, 'Mecklenburg-Vorpommern', 82),
(1382, 'Mulfingen', 82),
(1383, 'Munich', 82),
(1384, 'Neubeuern', 82),
(1385, 'Niedersachsen', 82),
(1386, 'Noord-Holland', 82),
(1387, 'Nordrhein-Westfalen', 82),
(1388, 'North Rhine-Westphalia', 82),
(1389, 'Osterode', 82),
(1390, 'Rheinland-Pfalz', 82),
(1391, 'Rhineland-Palatinate', 82),
(1392, 'Saarland', 82),
(1393, 'Sachsen', 82),
(1394, 'Sachsen-Anhalt', 82),
(1395, 'Saxony', 82),
(1396, 'Schleswig-Holstein', 82),
(1397, 'Thuringia', 82),
(1398, 'Webling', 82),
(1399, 'Weinstrabe', 82),
(1400, 'schlobborn', 82),
(1401, 'Ashanti', 83),
(1402, 'Brong-Ahafo', 83),
(1403, 'Central', 83),
(1404, 'Eastern', 83),
(1405, 'Greater Accra', 83),
(1406, 'Northern', 83),
(1407, 'Upper East', 83),
(1408, 'Upper West', 83),
(1409, 'Volta', 83),
(1410, 'Western', 83),
(1411, 'Gibraltar', 84),
(1412, 'Acharnes', 85),
(1413, 'Ahaia', 85),
(1414, 'Aitolia kai Akarnania', 85),
(1415, 'Argolis', 85),
(1416, 'Arkadia', 85),
(1417, 'Arta', 85),
(1418, 'Attica', 85),
(1419, 'Attiki', 85),
(1420, 'Ayion Oros', 85),
(1421, 'Crete', 85),
(1422, 'Dodekanisos', 85),
(1423, 'Drama', 85),
(1424, 'Evia', 85),
(1425, 'Evritania', 85),
(1426, 'Evros', 85),
(1427, 'Evvoia', 85),
(1428, 'Florina', 85),
(1429, 'Fokis', 85),
(1430, 'Fthiotis', 85),
(1431, 'Grevena', 85),
(1432, 'Halandri', 85),
(1433, 'Halkidiki', 85),
(1434, 'Hania', 85),
(1435, 'Heraklion', 85),
(1436, 'Hios', 85),
(1437, 'Ilia', 85),
(1438, 'Imathia', 85),
(1439, 'Ioannina', 85),
(1440, 'Iraklion', 85),
(1441, 'Karditsa', 85),
(1442, 'Kastoria', 85),
(1443, 'Kavala', 85),
(1444, 'Kefallinia', 85),
(1445, 'Kerkira', 85),
(1446, 'Kiklades', 85),
(1447, 'Kilkis', 85),
(1448, 'Korinthia', 85),
(1449, 'Kozani', 85),
(1450, 'Lakonia', 85),
(1451, 'Larisa', 85),
(1452, 'Lasithi', 85),
(1453, 'Lesvos', 85),
(1454, 'Levkas', 85),
(1455, 'Magnisia', 85),
(1456, 'Messinia', 85),
(1457, 'Nomos Attikis', 85),
(1458, 'Nomos Zakynthou', 85),
(1459, 'Pella', 85),
(1460, 'Pieria', 85),
(1461, 'Piraios', 85),
(1462, 'Preveza', 85),
(1463, 'Rethimni', 85),
(1464, 'Rodopi', 85),
(1465, 'Samos', 85),
(1466, 'Serrai', 85),
(1467, 'Thesprotia', 85),
(1468, 'Thessaloniki', 85),
(1469, 'Trikala', 85),
(1470, 'Voiotia', 85),
(1471, 'West Greece', 85),
(1472, 'Xanthi', 85),
(1473, 'Zakinthos', 85),
(1474, 'Aasiaat', 86),
(1475, 'Ammassalik', 86),
(1476, 'Illoqqortoormiut', 86),
(1477, 'Ilulissat', 86),
(1478, 'Ivittuut', 86),
(1479, 'Kangaatsiaq', 86),
(1480, 'Maniitsoq', 86),
(1481, 'Nanortalik', 86),
(1482, 'Narsaq', 86),
(1483, 'Nuuk', 86),
(1484, 'Paamiut', 86),
(1485, 'Qaanaaq', 86),
(1486, 'Qaqortoq', 86),
(1487, 'Qasigiannguit', 86),
(1488, 'Qeqertarsuaq', 86),
(1489, 'Sisimiut', 86),
(1490, 'Udenfor kommunal inddeling', 86),
(1491, 'Upernavik', 86),
(1492, 'Uummannaq', 86),
(1493, 'Carriacou-Petite Martinique', 87),
(1494, 'Saint Andrew', 87),
(1495, 'Saint Davids', 87),
(1496, 'Saint George\'s', 87),
(1497, 'Saint John', 87),
(1498, 'Saint Mark', 87),
(1499, 'Saint Patrick', 87),
(1500, 'Basse-Terre', 88),
(1501, 'Grande-Terre', 88),
(1502, 'Iles des Saintes', 88),
(1503, 'La Desirade', 88),
(1504, 'Marie-Galante', 88),
(1505, 'Saint Barthelemy', 88),
(1506, 'Saint Martin', 88),
(1507, 'Agana Heights', 89),
(1508, 'Agat', 89),
(1509, 'Barrigada', 89),
(1510, 'Chalan-Pago-Ordot', 89),
(1511, 'Dededo', 89),
(1512, 'Hagatna', 89),
(1513, 'Inarajan', 89),
(1514, 'Mangilao', 89),
(1515, 'Merizo', 89),
(1516, 'Mongmong-Toto-Maite', 89),
(1517, 'Santa Rita', 89),
(1518, 'Sinajana', 89),
(1519, 'Talofofo', 89),
(1520, 'Tamuning', 89),
(1521, 'Yigo', 89),
(1522, 'Yona', 89),
(1523, 'Alta Verapaz', 90),
(1524, 'Baja Verapaz', 90),
(1525, 'Chimaltenango', 90),
(1526, 'Chiquimula', 90),
(1527, 'El Progreso', 90),
(1528, 'Escuintla', 90),
(1529, 'Guatemala', 90),
(1530, 'Huehuetenango', 90),
(1531, 'Izabal', 90),
(1532, 'Jalapa', 90),
(1533, 'Jutiapa', 90),
(1534, 'Peten', 90),
(1535, 'Quezaltenango', 90),
(1536, 'Quiche', 90),
(1537, 'Retalhuleu', 90),
(1538, 'Sacatepequez', 90),
(1539, 'San Marcos', 90),
(1540, 'Santa Rosa', 90),
(1541, 'Solola', 90),
(1542, 'Suchitepequez', 90),
(1543, 'Totonicapan', 90),
(1544, 'Zacapa', 90),
(1545, 'Alderney', 91),
(1546, 'Castel', 91),
(1547, 'Forest', 91),
(1548, 'Saint Andrew', 91),
(1549, 'Saint Martin', 91),
(1550, 'Saint Peter Port', 91),
(1551, 'Saint Pierre du Bois', 91),
(1552, 'Saint Sampson', 91),
(1553, 'Saint Saviour', 91),
(1554, 'Sark', 91),
(1555, 'Torteval', 91),
(1556, 'Vale', 91),
(1557, 'Beyla', 92),
(1558, 'Boffa', 92),
(1559, 'Boke', 92),
(1560, 'Conakry', 92),
(1561, 'Coyah', 92),
(1562, 'Dabola', 92),
(1563, 'Dalaba', 92),
(1564, 'Dinguiraye', 92),
(1565, 'Faranah', 92),
(1566, 'Forecariah', 92),
(1567, 'Fria', 92),
(1568, 'Gaoual', 92),
(1569, 'Gueckedou', 92),
(1570, 'Kankan', 92),
(1571, 'Kerouane', 92),
(1572, 'Kindia', 92),
(1573, 'Kissidougou', 92),
(1574, 'Koubia', 92),
(1575, 'Koundara', 92),
(1576, 'Kouroussa', 92),
(1577, 'Labe', 92),
(1578, 'Lola', 92),
(1579, 'Macenta', 92),
(1580, 'Mali', 92),
(1581, 'Mamou', 92),
(1582, 'Mandiana', 92),
(1583, 'Nzerekore', 92),
(1584, 'Pita', 92),
(1585, 'Siguiri', 92),
(1586, 'Telimele', 92),
(1587, 'Tougue', 92),
(1588, 'Yomou', 92),
(1589, 'Bafata', 93),
(1590, 'Bissau', 93),
(1591, 'Bolama', 93),
(1592, 'Cacheu', 93),
(1593, 'Gabu', 93),
(1594, 'Oio', 93),
(1595, 'Quinara', 93),
(1596, 'Tombali', 93),
(1597, 'Barima-Waini', 94),
(1598, 'Cuyuni-Mazaruni', 94),
(1599, 'Demerara-Mahaica', 94),
(1600, 'East Berbice-Corentyne', 94),
(1601, 'Essequibo Islands-West Demerar', 94),
(1602, 'Mahaica-Berbice', 94),
(1603, 'Pomeroon-Supenaam', 94),
(1604, 'Potaro-Siparuni', 94),
(1605, 'Upper Demerara-Berbice', 94),
(1606, 'Upper Takutu-Upper Essequibo', 94),
(1607, 'Artibonite', 95),
(1608, 'Centre', 95),
(1609, 'Grand\'Anse', 95),
(1610, 'Nord', 95),
(1611, 'Nord-Est', 95),
(1612, 'Nord-Ouest', 95),
(1613, 'Ouest', 95),
(1614, 'Sud', 95),
(1615, 'Sud-Est', 95),
(1616, 'Heard and McDonald Islands', 96),
(1617, 'Atlantida', 97),
(1618, 'Choluteca', 97),
(1619, 'Colon', 97),
(1620, 'Comayagua', 97),
(1621, 'Copan', 97),
(1622, 'Cortes', 97),
(1623, 'Distrito Central', 97),
(1624, 'El Paraiso', 97),
(1625, 'Francisco Morazan', 97),
(1626, 'Gracias a Dios', 97),
(1627, 'Intibuca', 97),
(1628, 'Islas de la Bahia', 97),
(1629, 'La Paz', 97),
(1630, 'Lempira', 97),
(1631, 'Ocotepeque', 97),
(1632, 'Olancho', 97),
(1633, 'Santa Barbara', 97),
(1634, 'Valle', 97),
(1635, 'Yoro', 97),
(1636, 'Hong Kong', 98),
(1637, 'Bacs-Kiskun', 99),
(1638, 'Baranya', 99),
(1639, 'Bekes', 99),
(1640, 'Borsod-Abauj-Zemplen', 99),
(1641, 'Budapest', 99),
(1642, 'Csongrad', 99),
(1643, 'Fejer', 99),
(1644, 'Gyor-Moson-Sopron', 99),
(1645, 'Hajdu-Bihar', 99),
(1646, 'Heves', 99),
(1647, 'Jasz-Nagykun-Szolnok', 99),
(1648, 'Komarom-Esztergom', 99),
(1649, 'Nograd', 99),
(1650, 'Pest', 99),
(1651, 'Somogy', 99),
(1652, 'Szabolcs-Szatmar-Bereg', 99),
(1653, 'Tolna', 99),
(1654, 'Vas', 99),
(1655, 'Veszprem', 99),
(1656, 'Zala', 99),
(1657, 'Austurland', 100),
(1658, 'Gullbringusysla', 100),
(1659, 'Hofu borgarsva i', 100),
(1660, 'Nor urland eystra', 100),
(1661, 'Nor urland vestra', 100),
(1662, 'Su urland', 100),
(1663, 'Su urnes', 100),
(1664, 'Vestfir ir', 100),
(1665, 'Vesturland', 100),
(1666, 'Aceh', 102),
(1667, 'Bali', 102),
(1668, 'Bangka-Belitung', 102),
(1669, 'Banten', 102),
(1670, 'Bengkulu', 102),
(1671, 'Gandaria', 102),
(1672, 'Gorontalo', 102),
(1673, 'Jakarta', 102),
(1674, 'Jambi', 102),
(1675, 'Jawa Barat', 102),
(1676, 'Jawa Tengah', 102),
(1677, 'Jawa Timur', 102),
(1678, 'Kalimantan Barat', 102),
(1679, 'Kalimantan Selatan', 102),
(1680, 'Kalimantan Tengah', 102),
(1681, 'Kalimantan Timur', 102),
(1682, 'Kendal', 102),
(1683, 'Lampung', 102),
(1684, 'Maluku', 102),
(1685, 'Maluku Utara', 102),
(1686, 'Nusa Tenggara Barat', 102),
(1687, 'Nusa Tenggara Timur', 102),
(1688, 'Papua', 102),
(1689, 'Riau', 102),
(1690, 'Riau Kepulauan', 102),
(1691, 'Solo', 102),
(1692, 'Sulawesi Selatan', 102),
(1693, 'Sulawesi Tengah', 102),
(1694, 'Sulawesi Tenggara', 102),
(1695, 'Sulawesi Utara', 102),
(1696, 'Sumatera Barat', 102),
(1697, 'Sumatera Selatan', 102),
(1698, 'Sumatera Utara', 102),
(1699, 'Yogyakarta', 102),
(1700, 'Ardabil', 103),
(1701, 'Azarbayjan-e Bakhtari', 103),
(1702, 'Azarbayjan-e Khavari', 103),
(1703, 'Bushehr', 103),
(1704, 'Chahar Mahal-e Bakhtiari', 103),
(1705, 'Esfahan', 103),
(1706, 'Fars', 103),
(1707, 'Gilan', 103),
(1708, 'Golestan', 103),
(1709, 'Hamadan', 103),
(1710, 'Hormozgan', 103),
(1711, 'Ilam', 103),
(1712, 'Kerman', 103),
(1713, 'Kermanshah', 103),
(1714, 'Khorasan', 103),
(1715, 'Khuzestan', 103),
(1716, 'Kohgiluyeh-e Boyerahmad', 103),
(1717, 'Kordestan', 103),
(1718, 'Lorestan', 103),
(1719, 'Markazi', 103),
(1720, 'Mazandaran', 103),
(1721, 'Ostan-e Esfahan', 103),
(1722, 'Qazvin', 103),
(1723, 'Qom', 103),
(1724, 'Semnan', 103),
(1725, 'Sistan-e Baluchestan', 103),
(1726, 'Tehran', 103),
(1727, 'Yazd', 103),
(1728, 'Zanjan', 103),
(1729, 'Babil', 104),
(1730, 'Baghdad', 104),
(1731, 'Dahuk', 104),
(1732, 'Dhi Qar', 104),
(1733, 'Diyala', 104),
(1734, 'Erbil', 104),
(1735, 'Irbil', 104),
(1736, 'Karbala', 104),
(1737, 'Kurdistan', 104),
(1738, 'Maysan', 104),
(1739, 'Ninawa', 104),
(1740, 'Salah-ad-Din', 104),
(1741, 'Wasit', 104),
(1742, 'al-Anbar', 104),
(1743, 'al-Basrah', 104),
(1744, 'al-Muthanna', 104),
(1745, 'al-Qadisiyah', 104),
(1746, 'an-Najaf', 104),
(1747, 'as-Sulaymaniyah', 104),
(1748, 'at-Ta\'mim', 104),
(1749, 'Armagh', 105),
(1750, 'Carlow', 105),
(1751, 'Cavan', 105),
(1752, 'Clare', 105),
(1753, 'Cork', 105),
(1754, 'Donegal', 105),
(1755, 'Dublin', 105),
(1756, 'Galway', 105),
(1757, 'Kerry', 105),
(1758, 'Kildare', 105),
(1759, 'Kilkenny', 105),
(1760, 'Laois', 105),
(1761, 'Leinster', 105),
(1762, 'Leitrim', 105),
(1763, 'Limerick', 105),
(1764, 'Loch Garman', 105),
(1765, 'Longford', 105),
(1766, 'Louth', 105),
(1767, 'Mayo', 105),
(1768, 'Meath', 105),
(1769, 'Monaghan', 105),
(1770, 'Offaly', 105),
(1771, 'Roscommon', 105),
(1772, 'Sligo', 105),
(1773, 'Tipperary North Riding', 105),
(1774, 'Tipperary South Riding', 105),
(1775, 'Ulster', 105),
(1776, 'Waterford', 105),
(1777, 'Westmeath', 105),
(1778, 'Wexford', 105),
(1779, 'Wicklow', 105),
(1780, 'Beit Hanania', 106),
(1781, 'Ben Gurion Airport', 106),
(1782, 'Bethlehem', 106),
(1783, 'Caesarea', 106),
(1784, 'Centre', 106),
(1785, 'Gaza', 106),
(1786, 'Hadaron', 106),
(1787, 'Haifa District', 106),
(1788, 'Hamerkaz', 106),
(1789, 'Hazafon', 106),
(1790, 'Hebron', 106),
(1791, 'Jaffa', 106),
(1792, 'Jerusalem', 106),
(1793, 'Khefa', 106),
(1794, 'Kiryat Yam', 106),
(1795, 'Lower Galilee', 106),
(1796, 'Qalqilya', 106),
(1797, 'Talme Elazar', 106),
(1798, 'Tel Aviv', 106),
(1799, 'Tsafon', 106),
(1800, 'Umm El Fahem', 106),
(1801, 'Yerushalayim', 106),
(1802, 'Abruzzi', 107),
(1803, 'Abruzzo', 107),
(1804, 'Agrigento', 107),
(1805, 'Alessandria', 107),
(1806, 'Ancona', 107),
(1807, 'Arezzo', 107),
(1808, 'Ascoli Piceno', 107),
(1809, 'Asti', 107),
(1810, 'Avellino', 107),
(1811, 'Bari', 107),
(1812, 'Basilicata', 107),
(1813, 'Belluno', 107),
(1814, 'Benevento', 107),
(1815, 'Bergamo', 107),
(1816, 'Biella', 107),
(1817, 'Bologna', 107),
(1818, 'Bolzano', 107),
(1819, 'Brescia', 107),
(1820, 'Brindisi', 107),
(1821, 'Calabria', 107),
(1822, 'Campania', 107),
(1823, 'Cartoceto', 107),
(1824, 'Caserta', 107),
(1825, 'Catania', 107),
(1826, 'Chieti', 107),
(1827, 'Como', 107),
(1828, 'Cosenza', 107),
(1829, 'Cremona', 107),
(1830, 'Cuneo', 107),
(1831, 'Emilia-Romagna', 107),
(1832, 'Ferrara', 107),
(1833, 'Firenze', 107),
(1834, 'Florence', 107),
(1835, 'Forli-Cesena ', 107),
(1836, 'Friuli-Venezia Giulia', 107),
(1837, 'Frosinone', 107),
(1838, 'Genoa', 107),
(1839, 'Gorizia', 107),
(1840, 'L\'Aquila', 107),
(1841, 'Lazio', 107),
(1842, 'Lecce', 107),
(1843, 'Lecco', 107),
(1844, 'Lecco Province', 107),
(1845, 'Liguria', 107),
(1846, 'Lodi', 107),
(1847, 'Lombardia', 107),
(1848, 'Lombardy', 107),
(1849, 'Macerata', 107),
(1850, 'Mantova', 107),
(1851, 'Marche', 107),
(1852, 'Messina', 107),
(1853, 'Milan', 107),
(1854, 'Modena', 107),
(1855, 'Molise', 107),
(1856, 'Molteno', 107),
(1857, 'Montenegro', 107),
(1858, 'Monza and Brianza', 107),
(1859, 'Naples', 107),
(1860, 'Novara', 107),
(1861, 'Padova', 107),
(1862, 'Parma', 107),
(1863, 'Pavia', 107),
(1864, 'Perugia', 107),
(1865, 'Pesaro-Urbino', 107),
(1866, 'Piacenza', 107),
(1867, 'Piedmont', 107),
(1868, 'Piemonte', 107),
(1869, 'Pisa', 107),
(1870, 'Pordenone', 107),
(1871, 'Potenza', 107),
(1872, 'Puglia', 107),
(1873, 'Reggio Emilia', 107),
(1874, 'Rimini', 107),
(1875, 'Roma', 107),
(1876, 'Salerno', 107),
(1877, 'Sardegna', 107),
(1878, 'Sassari', 107),
(1879, 'Savona', 107),
(1880, 'Sicilia', 107),
(1881, 'Siena', 107),
(1882, 'Sondrio', 107),
(1883, 'South Tyrol', 107),
(1884, 'Taranto', 107),
(1885, 'Teramo', 107),
(1886, 'Torino', 107),
(1887, 'Toscana', 107),
(1888, 'Trapani', 107),
(1889, 'Trentino-Alto Adige', 107),
(1890, 'Trento', 107),
(1891, 'Treviso', 107),
(1892, 'Udine', 107),
(1893, 'Umbria', 107),
(1894, 'Valle d\'Aosta', 107),
(1895, 'Varese', 107),
(1896, 'Veneto', 107),
(1897, 'Venezia', 107),
(1898, 'Verbano-Cusio-Ossola', 107),
(1899, 'Vercelli', 107),
(1900, 'Verona', 107),
(1901, 'Vicenza', 107),
(1902, 'Viterbo', 107),
(1903, 'Buxoro Viloyati', 108),
(1904, 'Clarendon', 108),
(1905, 'Hanover', 108),
(1906, 'Kingston', 108),
(1907, 'Manchester', 108),
(1908, 'Portland', 108),
(1909, 'Saint Andrews', 108),
(1910, 'Saint Ann', 108),
(1911, 'Saint Catherine', 108),
(1912, 'Saint Elizabeth', 108),
(1913, 'Saint James', 108),
(1914, 'Saint Mary', 108),
(1915, 'Saint Thomas', 108),
(1916, 'Trelawney', 108),
(1917, 'Westmoreland', 108),
(1918, 'Aichi', 109),
(1919, 'Akita', 109),
(1920, 'Aomori', 109),
(1921, 'Chiba', 109),
(1922, 'Ehime', 109),
(1923, 'Fukui', 109),
(1924, 'Fukuoka', 109),
(1925, 'Fukushima', 109),
(1926, 'Gifu', 109),
(1927, 'Gumma', 109),
(1928, 'Hiroshima', 109),
(1929, 'Hokkaido', 109),
(1930, 'Hyogo', 109),
(1931, 'Ibaraki', 109),
(1932, 'Ishikawa', 109),
(1933, 'Iwate', 109),
(1934, 'Kagawa', 109),
(1935, 'Kagoshima', 109),
(1936, 'Kanagawa', 109),
(1937, 'Kanto', 109),
(1938, 'Kochi', 109),
(1939, 'Kumamoto', 109),
(1940, 'Kyoto', 109),
(1941, 'Mie', 109),
(1942, 'Miyagi', 109),
(1943, 'Miyazaki', 109),
(1944, 'Nagano', 109),
(1945, 'Nagasaki', 109),
(1946, 'Nara', 109),
(1947, 'Niigata', 109),
(1948, 'Oita', 109),
(1949, 'Okayama', 109),
(1950, 'Okinawa', 109),
(1951, 'Osaka', 109),
(1952, 'Saga', 109),
(1953, 'Saitama', 109),
(1954, 'Shiga', 109),
(1955, 'Shimane', 109),
(1956, 'Shizuoka', 109),
(1957, 'Tochigi', 109),
(1958, 'Tokushima', 109),
(1959, 'Tokyo', 109),
(1960, 'Tottori', 109),
(1961, 'Toyama', 109),
(1962, 'Wakayama', 109),
(1963, 'Yamagata', 109),
(1964, 'Yamaguchi', 109),
(1965, 'Yamanashi', 109),
(1966, 'Grouville', 110),
(1967, 'Saint Brelade', 110),
(1968, 'Saint Clement', 110),
(1969, 'Saint Helier', 110),
(1970, 'Saint John', 110),
(1971, 'Saint Lawrence', 110),
(1972, 'Saint Martin', 110),
(1973, 'Saint Mary', 110),
(1974, 'Saint Peter', 110),
(1975, 'Saint Saviour', 110),
(1976, 'Trinity', 110),
(1977, '\'Ajlun', 111),
(1978, 'Amman', 111),
(1979, 'Irbid', 111),
(1980, 'Jarash', 111),
(1981, 'Ma\'an', 111),
(1982, 'Madaba', 111),
(1983, 'al-\'Aqabah', 111),
(1984, 'al-Balqa\'', 111),
(1985, 'al-Karak', 111),
(1986, 'al-Mafraq', 111),
(1987, 'at-Tafilah', 111),
(1988, 'az-Zarqa\'', 111),
(1989, 'Akmecet', 112),
(1990, 'Akmola', 112),
(1991, 'Aktobe', 112),
(1992, 'Almati', 112),
(1993, 'Atirau', 112),
(1994, 'Batis Kazakstan', 112),
(1995, 'Burlinsky Region', 112),
(1996, 'Karagandi', 112),
(1997, 'Kostanay', 112),
(1998, 'Mankistau', 112),
(1999, 'Ontustik Kazakstan', 112),
(2000, 'Pavlodar', 112),
(2001, 'Sigis Kazakstan', 112),
(2002, 'Soltustik Kazakstan', 112),
(2003, 'Taraz', 112),
(2004, 'Central', 113),
(2005, 'Coast', 113),
(2006, 'Eastern', 113),
(2007, 'Nairobi', 113),
(2008, 'North Eastern', 113),
(2009, 'Nyanza', 113),
(2010, 'Rift Valley', 113),
(2011, 'Western', 113),
(2012, 'Abaiang', 114),
(2013, 'Abemana', 114),
(2014, 'Aranuka', 114),
(2015, 'Arorae', 114),
(2016, 'Banaba', 114),
(2017, 'Beru', 114),
(2018, 'Butaritari', 114),
(2019, 'Kiritimati', 114),
(2020, 'Kuria', 114),
(2021, 'Maiana', 114),
(2022, 'Makin', 114),
(2023, 'Marakei', 114),
(2024, 'Nikunau', 114),
(2025, 'Nonouti', 114),
(2026, 'Onotoa', 114),
(2027, 'Phoenix Islands', 114),
(2028, 'Tabiteuea North', 114),
(2029, 'Tabiteuea South', 114),
(2030, 'Tabuaeran', 114),
(2031, 'Tamana', 114),
(2032, 'Tarawa North', 114),
(2033, 'Tarawa South', 114),
(2034, 'Teraina', 114),
(2035, 'Chagangdo', 115),
(2036, 'Hamgyeongbukto', 115),
(2037, 'Hamgyeongnamdo', 115),
(2038, 'Hwanghaebukto', 115),
(2039, 'Hwanghaenamdo', 115),
(2040, 'Kaeseong', 115),
(2041, 'Kangweon', 115),
(2042, 'Nampo', 115),
(2043, 'Pyeonganbukto', 115),
(2044, 'Pyeongannamdo', 115),
(2045, 'Pyeongyang', 115),
(2046, 'Yanggang', 115),
(2047, 'Busan', 116),
(2048, 'Cheju', 116),
(2049, 'Chollabuk', 116),
(2050, 'Chollanam', 116),
(2051, 'Chungbuk', 116),
(2052, 'Chungcheongbuk', 116),
(2053, 'Chungcheongnam', 116),
(2054, 'Chungnam', 116),
(2055, 'Daegu', 116),
(2056, 'Gangwon-do', 116),
(2057, 'Goyang-si', 116),
(2058, 'Gyeonggi-do', 116),
(2059, 'Gyeongsang ', 116),
(2060, 'Gyeongsangnam-do', 116),
(2061, 'Incheon', 116),
(2062, 'Jeju-Si', 116),
(2063, 'Jeonbuk', 116),
(2064, 'Kangweon', 116),
(2065, 'Kwangju', 116),
(2066, 'Kyeonggi', 116),
(2067, 'Kyeongsangbuk', 116),
(2068, 'Kyeongsangnam', 116),
(2069, 'Kyonggi-do', 116),
(2070, 'Kyungbuk-Do', 116),
(2071, 'Kyunggi-Do', 116),
(2072, 'Kyunggi-do', 116),
(2073, 'Pusan', 116),
(2074, 'Seoul', 116),
(2075, 'Sudogwon', 116),
(2076, 'Taegu', 116),
(2077, 'Taejeon', 116),
(2078, 'Taejon-gwangyoksi', 116),
(2079, 'Ulsan', 116),
(2080, 'Wonju', 116),
(2081, 'gwangyoksi', 116),
(2082, 'Al Asimah', 117),
(2083, 'Hawalli', 117),
(2084, 'Mishref', 117),
(2085, 'Qadesiya', 117),
(2086, 'Safat', 117),
(2087, 'Salmiya', 117),
(2088, 'al-Ahmadi', 117),
(2089, 'al-Farwaniyah', 117),
(2090, 'al-Jahra', 117),
(2091, 'al-Kuwayt', 117),
(2092, 'Batken', 118),
(2093, 'Bishkek', 118),
(2094, 'Chui', 118),
(2095, 'Issyk-Kul', 118),
(2096, 'Jalal-Abad', 118),
(2097, 'Naryn', 118),
(2098, 'Osh', 118),
(2099, 'Talas', 118),
(2100, 'Attopu', 119),
(2101, 'Bokeo', 119),
(2102, 'Bolikhamsay', 119),
(2103, 'Champasak', 119),
(2104, 'Houaphanh', 119),
(2105, 'Khammouane', 119),
(2106, 'Luang Nam Tha', 119),
(2107, 'Luang Prabang', 119),
(2108, 'Oudomxay', 119),
(2109, 'Phongsaly', 119),
(2110, 'Saravan', 119),
(2111, 'Savannakhet', 119),
(2112, 'Sekong', 119),
(2113, 'Viangchan Prefecture', 119),
(2114, 'Viangchan Province', 119),
(2115, 'Xaignabury', 119),
(2116, 'Xiang Khuang', 119),
(2117, 'Aizkraukles', 120),
(2118, 'Aluksnes', 120),
(2119, 'Balvu', 120),
(2120, 'Bauskas', 120),
(2121, 'Cesu', 120),
(2122, 'Daugavpils', 120),
(2123, 'Daugavpils City', 120),
(2124, 'Dobeles', 120),
(2125, 'Gulbenes', 120),
(2126, 'Jekabspils', 120),
(2127, 'Jelgava', 120),
(2128, 'Jelgavas', 120),
(2129, 'Jurmala City', 120),
(2130, 'Kraslavas', 120),
(2131, 'Kuldigas', 120),
(2132, 'Liepaja', 120),
(2133, 'Liepajas', 120),
(2134, 'Limbazhu', 120),
(2135, 'Ludzas', 120),
(2136, 'Madonas', 120),
(2137, 'Ogres', 120),
(2138, 'Preilu', 120),
(2139, 'Rezekne', 120),
(2140, 'Rezeknes', 120),
(2141, 'Riga', 120),
(2142, 'Rigas', 120),
(2143, 'Saldus', 120),
(2144, 'Talsu', 120),
(2145, 'Tukuma', 120),
(2146, 'Valkas', 120),
(2147, 'Valmieras', 120),
(2148, 'Ventspils', 120),
(2149, 'Ventspils City', 120),
(2150, 'Beirut', 121),
(2151, 'Jabal Lubnan', 121),
(2152, 'Mohafazat Liban-Nord', 121),
(2153, 'Mohafazat Mont-Liban', 121),
(2154, 'Sidon', 121),
(2155, 'al-Biqa', 121),
(2156, 'al-Janub', 121),
(2157, 'an-Nabatiyah', 121),
(2158, 'ash-Shamal', 121),
(2159, 'Berea', 122),
(2160, 'Butha-Buthe', 122),
(2161, 'Leribe', 122),
(2162, 'Mafeteng', 122),
(2163, 'Maseru', 122),
(2164, 'Mohale\'s Hoek', 122),
(2165, 'Mokhotlong', 122),
(2166, 'Qacha\'s Nek', 122),
(2167, 'Quthing', 122),
(2168, 'Thaba-Tseka', 122),
(2169, 'Bomi', 123),
(2170, 'Bong', 123),
(2171, 'Grand Bassa', 123),
(2172, 'Grand Cape Mount', 123),
(2173, 'Grand Gedeh', 123),
(2174, 'Loffa', 123),
(2175, 'Margibi', 123),
(2176, 'Maryland and Grand Kru', 123),
(2177, 'Montserrado', 123),
(2178, 'Nimba', 123),
(2179, 'Rivercess', 123),
(2180, 'Sinoe', 123),
(2181, 'Ajdabiya', 124);
INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(2182, 'Fezzan', 124),
(2183, 'Banghazi', 124),
(2184, 'Darnah', 124),
(2185, 'Ghadamis', 124),
(2186, 'Gharyan', 124),
(2187, 'Misratah', 124),
(2188, 'Murzuq', 124),
(2189, 'Sabha', 124),
(2190, 'Sawfajjin', 124),
(2191, 'Surt', 124),
(2192, 'Tarabulus', 124),
(2193, 'Tarhunah', 124),
(2194, 'Tripolitania', 124),
(2195, 'Tubruq', 124),
(2196, 'Yafran', 124),
(2197, 'Zlitan', 124),
(2198, 'al-\'Aziziyah', 124),
(2199, 'al-Fatih', 124),
(2200, 'al-Jabal al Akhdar', 124),
(2201, 'al-Jufrah', 124),
(2202, 'al-Khums', 124),
(2203, 'al-Kufrah', 124),
(2204, 'an-Nuqat al-Khams', 124),
(2205, 'ash-Shati\'', 124),
(2206, 'az-Zawiyah', 124),
(2207, 'Balzers', 125),
(2208, 'Eschen', 125),
(2209, 'Gamprin', 125),
(2210, 'Mauren', 125),
(2211, 'Planken', 125),
(2212, 'Ruggell', 125),
(2213, 'Schaan', 125),
(2214, 'Schellenberg', 125),
(2215, 'Triesen', 125),
(2216, 'Triesenberg', 125),
(2217, 'Vaduz', 125),
(2218, 'Alytaus', 126),
(2219, 'Anyksciai', 126),
(2220, 'Kauno', 126),
(2221, 'Klaipedos', 126),
(2222, 'Marijampoles', 126),
(2223, 'Panevezhio', 126),
(2224, 'Panevezys', 126),
(2225, 'Shiauliu', 126),
(2226, 'Taurages', 126),
(2227, 'Telshiu', 126),
(2228, 'Telsiai', 126),
(2229, 'Utenos', 126),
(2230, 'Vilniaus', 126),
(2231, 'Capellen', 127),
(2232, 'Clervaux', 127),
(2233, 'Diekirch', 127),
(2234, 'Echternach', 127),
(2235, 'Esch-sur-Alzette', 127),
(2236, 'Grevenmacher', 127),
(2237, 'Luxembourg', 127),
(2238, 'Mersch', 127),
(2239, 'Redange', 127),
(2240, 'Remich', 127),
(2241, 'Vianden', 127),
(2242, 'Wiltz', 127),
(2243, 'Macau', 128),
(2244, 'Berovo', 129),
(2245, 'Bitola', 129),
(2246, 'Brod', 129),
(2247, 'Debar', 129),
(2248, 'Delchevo', 129),
(2249, 'Demir Hisar', 129),
(2250, 'Gevgelija', 129),
(2251, 'Gostivar', 129),
(2252, 'Kavadarci', 129),
(2253, 'Kichevo', 129),
(2254, 'Kochani', 129),
(2255, 'Kratovo', 129),
(2256, 'Kriva Palanka', 129),
(2257, 'Krushevo', 129),
(2258, 'Kumanovo', 129),
(2259, 'Negotino', 129),
(2260, 'Ohrid', 129),
(2261, 'Prilep', 129),
(2262, 'Probishtip', 129),
(2263, 'Radovish', 129),
(2264, 'Resen', 129),
(2265, 'Shtip', 129),
(2266, 'Skopje', 129),
(2267, 'Struga', 129),
(2268, 'Strumica', 129),
(2269, 'Sveti Nikole', 129),
(2270, 'Tetovo', 129),
(2271, 'Valandovo', 129),
(2272, 'Veles', 129),
(2273, 'Vinica', 129),
(2274, 'Antananarivo', 130),
(2275, 'Antsiranana', 130),
(2276, 'Fianarantsoa', 130),
(2277, 'Mahajanga', 130),
(2278, 'Toamasina', 130),
(2279, 'Toliary', 130),
(2280, 'Balaka', 131),
(2281, 'Blantyre City', 131),
(2282, 'Chikwawa', 131),
(2283, 'Chiradzulu', 131),
(2284, 'Chitipa', 131),
(2285, 'Dedza', 131),
(2286, 'Dowa', 131),
(2287, 'Karonga', 131),
(2288, 'Kasungu', 131),
(2289, 'Lilongwe City', 131),
(2290, 'Machinga', 131),
(2291, 'Mangochi', 131),
(2292, 'Mchinji', 131),
(2293, 'Mulanje', 131),
(2294, 'Mwanza', 131),
(2295, 'Mzimba', 131),
(2296, 'Mzuzu City', 131),
(2297, 'Nkhata Bay', 131),
(2298, 'Nkhotakota', 131),
(2299, 'Nsanje', 131),
(2300, 'Ntcheu', 131),
(2301, 'Ntchisi', 131),
(2302, 'Phalombe', 131),
(2303, 'Rumphi', 131),
(2304, 'Salima', 131),
(2305, 'Thyolo', 131),
(2306, 'Zomba Municipality', 131),
(2307, 'Johor', 132),
(2308, 'Kedah', 132),
(2309, 'Kelantan', 132),
(2310, 'Kuala Lumpur', 132),
(2311, 'Labuan', 132),
(2312, 'Melaka', 132),
(2313, 'Negeri Johor', 132),
(2314, 'Negeri Sembilan', 132),
(2315, 'Pahang', 132),
(2316, 'Penang', 132),
(2317, 'Perak', 132),
(2318, 'Perlis', 132),
(2319, 'Pulau Pinang', 132),
(2320, 'Sabah', 132),
(2321, 'Sarawak', 132),
(2322, 'Selangor', 132),
(2323, 'Sembilan', 132),
(2324, 'Terengganu', 132),
(2325, 'Alif Alif', 133),
(2326, 'Alif Dhaal', 133),
(2327, 'Baa', 133),
(2328, 'Dhaal', 133),
(2329, 'Faaf', 133),
(2330, 'Gaaf Alif', 133),
(2331, 'Gaaf Dhaal', 133),
(2332, 'Ghaviyani', 133),
(2333, 'Haa Alif', 133),
(2334, 'Haa Dhaal', 133),
(2335, 'Kaaf', 133),
(2336, 'Laam', 133),
(2337, 'Lhaviyani', 133),
(2338, 'Male', 133),
(2339, 'Miim', 133),
(2340, 'Nuun', 133),
(2341, 'Raa', 133),
(2342, 'Shaviyani', 133),
(2343, 'Siin', 133),
(2344, 'Thaa', 133),
(2345, 'Vaav', 133),
(2346, 'Bamako', 134),
(2347, 'Gao', 134),
(2348, 'Kayes', 134),
(2349, 'Kidal', 134),
(2350, 'Koulikoro', 134),
(2351, 'Mopti', 134),
(2352, 'Segou', 134),
(2353, 'Sikasso', 134),
(2354, 'Tombouctou', 134),
(2355, 'Gozo and Comino', 135),
(2356, 'Inner Harbour', 135),
(2357, 'Northern', 135),
(2358, 'Outer Harbour', 135),
(2359, 'South Eastern', 135),
(2360, 'Valletta', 135),
(2361, 'Western', 135),
(2362, 'Castletown', 136),
(2363, 'Douglas', 136),
(2364, 'Laxey', 136),
(2365, 'Onchan', 136),
(2366, 'Peel', 136),
(2367, 'Port Erin', 136),
(2368, 'Port Saint Mary', 136),
(2369, 'Ramsey', 136),
(2370, 'Ailinlaplap', 137),
(2371, 'Ailuk', 137),
(2372, 'Arno', 137),
(2373, 'Aur', 137),
(2374, 'Bikini', 137),
(2375, 'Ebon', 137),
(2376, 'Enewetak', 137),
(2377, 'Jabat', 137),
(2378, 'Jaluit', 137),
(2379, 'Kili', 137),
(2380, 'Kwajalein', 137),
(2381, 'Lae', 137),
(2382, 'Lib', 137),
(2383, 'Likiep', 137),
(2384, 'Majuro', 137),
(2385, 'Maloelap', 137),
(2386, 'Mejit', 137),
(2387, 'Mili', 137),
(2388, 'Namorik', 137),
(2389, 'Namu', 137),
(2390, 'Rongelap', 137),
(2391, 'Ujae', 137),
(2392, 'Utrik', 137),
(2393, 'Wotho', 137),
(2394, 'Wotje', 137),
(2395, 'Fort-de-France', 138),
(2396, 'La Trinite', 138),
(2397, 'Le Marin', 138),
(2398, 'Saint-Pierre', 138),
(2399, 'Adrar', 139),
(2400, 'Assaba', 139),
(2401, 'Brakna', 139),
(2402, 'Dhakhlat Nawadibu', 139),
(2403, 'Hudh-al-Gharbi', 139),
(2404, 'Hudh-ash-Sharqi', 139),
(2405, 'Inshiri', 139),
(2406, 'Nawakshut', 139),
(2407, 'Qidimagha', 139),
(2408, 'Qurqul', 139),
(2409, 'Taqant', 139),
(2410, 'Tiris Zammur', 139),
(2411, 'Trarza', 139),
(2412, 'Black River', 140),
(2413, 'Eau Coulee', 140),
(2414, 'Flacq', 140),
(2415, 'Floreal', 140),
(2416, 'Grand Port', 140),
(2417, 'Moka', 140),
(2418, 'Pamplempousses', 140),
(2419, 'Plaines Wilhelm', 140),
(2420, 'Port Louis', 140),
(2421, 'Riviere du Rempart', 140),
(2422, 'Rodrigues', 140),
(2423, 'Rose Hill', 140),
(2424, 'Savanne', 140),
(2425, 'Mayotte', 141),
(2426, 'Pamanzi', 141),
(2427, 'Aguascalientes', 142),
(2428, 'Baja California', 142),
(2429, 'Baja California Sur', 142),
(2430, 'Campeche', 142),
(2431, 'Chiapas', 142),
(2432, 'Chihuahua', 142),
(2433, 'Coahuila', 142),
(2434, 'Colima', 142),
(2435, 'Distrito Federal', 142),
(2436, 'Durango', 142),
(2437, 'Estado de Mexico', 142),
(2438, 'Guanajuato', 142),
(2439, 'Guerrero', 142),
(2440, 'Hidalgo', 142),
(2441, 'Jalisco', 142),
(2442, 'Mexico', 142),
(2443, 'Michoacan', 142),
(2444, 'Morelos', 142),
(2445, 'Nayarit', 142),
(2446, 'Nuevo Leon', 142),
(2447, 'Oaxaca', 142),
(2448, 'Puebla', 142),
(2449, 'Queretaro', 142),
(2450, 'Quintana Roo', 142),
(2451, 'San Luis Potosi', 142),
(2452, 'Sinaloa', 142),
(2453, 'Sonora', 142),
(2454, 'Tabasco', 142),
(2455, 'Tamaulipas', 142),
(2456, 'Tlaxcala', 142),
(2457, 'Veracruz', 142),
(2458, 'Yucatan', 142),
(2459, 'Zacatecas', 142),
(2460, 'Chuuk', 143),
(2461, 'Kusaie', 143),
(2462, 'Pohnpei', 143),
(2463, 'Yap', 143),
(2464, 'Balti', 144),
(2465, 'Cahul', 144),
(2466, 'Chisinau', 144),
(2467, 'Chisinau Oras', 144),
(2468, 'Edinet', 144),
(2469, 'Gagauzia', 144),
(2470, 'Lapusna', 144),
(2471, 'Orhei', 144),
(2472, 'Soroca', 144),
(2473, 'Taraclia', 144),
(2474, 'Tighina', 144),
(2475, 'Transnistria', 144),
(2476, 'Ungheni', 144),
(2477, 'Fontvieille', 145),
(2478, 'La Condamine', 145),
(2479, 'Monaco-Ville', 145),
(2480, 'Monte Carlo', 145),
(2481, 'Arhangaj', 146),
(2482, 'Bajan-Olgij', 146),
(2483, 'Bajanhongor', 146),
(2484, 'Bulgan', 146),
(2485, 'Darhan-Uul', 146),
(2486, 'Dornod', 146),
(2487, 'Dornogovi', 146),
(2488, 'Dundgovi', 146),
(2489, 'Govi-Altaj', 146),
(2490, 'Govisumber', 146),
(2491, 'Hentij', 146),
(2492, 'Hovd', 146),
(2493, 'Hovsgol', 146),
(2494, 'Omnogovi', 146),
(2495, 'Orhon', 146),
(2496, 'Ovorhangaj', 146),
(2497, 'Selenge', 146),
(2498, 'Suhbaatar', 146),
(2499, 'Tov', 146),
(2500, 'Ulaanbaatar', 146),
(2501, 'Uvs', 146),
(2502, 'Zavhan', 146),
(2503, 'Montserrat', 147),
(2504, 'Agadir', 148),
(2505, 'Casablanca', 148),
(2506, 'Chaouia-Ouardigha', 148),
(2507, 'Doukkala-Abda', 148),
(2508, 'Fes-Boulemane', 148),
(2509, 'Gharb-Chrarda-Beni Hssen', 148),
(2510, 'Guelmim', 148),
(2511, 'Kenitra', 148),
(2512, 'Marrakech-Tensift-Al Haouz', 148),
(2513, 'Meknes-Tafilalet', 148),
(2514, 'Oriental', 148),
(2515, 'Oujda', 148),
(2516, 'Province de Tanger', 148),
(2517, 'Rabat-Sale-Zammour-Zaer', 148),
(2518, 'Sala Al Jadida', 148),
(2519, 'Settat', 148),
(2520, 'Souss Massa-Draa', 148),
(2521, 'Tadla-Azilal', 148),
(2522, 'Tangier-Tetouan', 148),
(2523, 'Taza-Al Hoceima-Taounate', 148),
(2524, 'Wilaya de Casablanca', 148),
(2525, 'Wilaya de Rabat-Sale', 148),
(2526, 'Cabo Delgado', 149),
(2527, 'Gaza', 149),
(2528, 'Inhambane', 149),
(2529, 'Manica', 149),
(2530, 'Maputo', 149),
(2531, 'Maputo Provincia', 149),
(2532, 'Nampula', 149),
(2533, 'Niassa', 149),
(2534, 'Sofala', 149),
(2535, 'Tete', 149),
(2536, 'Zambezia', 149),
(2537, 'Ayeyarwady', 150),
(2538, 'Bago', 150),
(2539, 'Chin', 150),
(2540, 'Kachin', 150),
(2541, 'Kayah', 150),
(2542, 'Kayin', 150),
(2543, 'Magway', 150),
(2544, 'Mandalay', 150),
(2545, 'Mon', 150),
(2546, 'Nay Pyi Taw', 150),
(2547, 'Rakhine', 150),
(2548, 'Sagaing', 150),
(2549, 'Shan', 150),
(2550, 'Tanintharyi', 150),
(2551, 'Yangon', 150),
(2552, 'Caprivi', 151),
(2553, 'Erongo', 151),
(2554, 'Hardap', 151),
(2555, 'Karas', 151),
(2556, 'Kavango', 151),
(2557, 'Khomas', 151),
(2558, 'Kunene', 151),
(2559, 'Ohangwena', 151),
(2560, 'Omaheke', 151),
(2561, 'Omusati', 151),
(2562, 'Oshana', 151),
(2563, 'Oshikoto', 151),
(2564, 'Otjozondjupa', 151),
(2565, 'Yaren', 152),
(2566, 'Bagmati', 153),
(2567, 'Bheri', 153),
(2568, 'Dhawalagiri', 153),
(2569, 'Gandaki', 153),
(2570, 'Janakpur', 153),
(2571, 'Karnali', 153),
(2572, 'Koshi', 153),
(2573, 'Lumbini', 153),
(2574, 'Mahakali', 153),
(2575, 'Mechi', 153),
(2576, 'Narayani', 153),
(2577, 'Rapti', 153),
(2578, 'Sagarmatha', 153),
(2579, 'Seti', 153),
(2580, 'Bonaire', 154),
(2581, 'Curacao', 154),
(2582, 'Saba', 154),
(2583, 'Sint Eustatius', 154),
(2584, 'Sint Maarten', 154),
(2585, 'Amsterdam', 155),
(2586, 'Benelux', 155),
(2587, 'Drenthe', 155),
(2588, 'Flevoland', 155),
(2589, 'Friesland', 155),
(2590, 'Gelderland', 155),
(2591, 'Groningen', 155),
(2592, 'Limburg', 155),
(2593, 'Noord-Brabant', 155),
(2594, 'Noord-Holland', 155),
(2595, 'Overijssel', 155),
(2596, 'South Holland', 155),
(2597, 'Utrecht', 155),
(2598, 'Zeeland', 155),
(2599, 'Zuid-Holland', 155),
(2600, 'Iles', 156),
(2601, 'Nord', 156),
(2602, 'Sud', 156),
(2603, 'Area Outside Region', 157),
(2604, 'Auckland', 157),
(2605, 'Bay of Plenty', 157),
(2606, 'Canterbury', 157),
(2607, 'Christchurch', 157),
(2608, 'Gisborne', 157),
(2609, 'Hawke\'s Bay', 157),
(2610, 'Manawatu-Wanganui', 157),
(2611, 'Marlborough', 157),
(2612, 'Nelson', 157),
(2613, 'Northland', 157),
(2614, 'Otago', 157),
(2615, 'Rodney', 157),
(2616, 'Southland', 157),
(2617, 'Taranaki', 157),
(2618, 'Tasman', 157),
(2619, 'Waikato', 157),
(2620, 'Wellington', 157),
(2621, 'West Coast', 157),
(2622, 'Atlantico Norte', 158),
(2623, 'Atlantico Sur', 158),
(2624, 'Boaco', 158),
(2625, 'Carazo', 158),
(2626, 'Chinandega', 158),
(2627, 'Chontales', 158),
(2628, 'Esteli', 158),
(2629, 'Granada', 158),
(2630, 'Jinotega', 158),
(2631, 'Leon', 158),
(2632, 'Madriz', 158),
(2633, 'Managua', 158),
(2634, 'Masaya', 158),
(2635, 'Matagalpa', 158),
(2636, 'Nueva Segovia', 158),
(2637, 'Rio San Juan', 158),
(2638, 'Rivas', 158),
(2639, 'Agadez', 159),
(2640, 'Diffa', 159),
(2641, 'Dosso', 159),
(2642, 'Maradi', 159),
(2643, 'Niamey', 159),
(2644, 'Tahoua', 159),
(2645, 'Tillabery', 159),
(2646, 'Zinder', 159),
(2647, 'Abia', 160),
(2648, 'Abuja Federal Capital Territor', 160),
(2649, 'Adamawa', 160),
(2650, 'Akwa Ibom', 160),
(2651, 'Anambra', 160),
(2652, 'Bauchi', 160),
(2653, 'Bayelsa', 160),
(2654, 'Benue', 160),
(2655, 'Borno', 160),
(2656, 'Cross River', 160),
(2657, 'Delta', 160),
(2658, 'Ebonyi', 160),
(2659, 'Edo', 160),
(2660, 'Ekiti', 160),
(2661, 'Enugu', 160),
(2662, 'Gombe', 160),
(2663, 'Imo', 160),
(2664, 'Jigawa', 160),
(2665, 'Kaduna', 160),
(2666, 'Kano', 160),
(2667, 'Katsina', 160),
(2668, 'Kebbi', 160),
(2669, 'Kogi', 160),
(2670, 'Kwara', 160),
(2671, 'Lagos', 160),
(2672, 'Nassarawa', 160),
(2673, 'Niger', 160),
(2674, 'Ogun', 160),
(2675, 'Ondo', 160),
(2676, 'Osun', 160),
(2677, 'Oyo', 160),
(2678, 'Plateau', 160),
(2679, 'Rivers', 160),
(2680, 'Sokoto', 160),
(2681, 'Taraba', 160),
(2682, 'Yobe', 160),
(2683, 'Zamfara', 160),
(2684, 'Niue', 161),
(2685, 'Norfolk Island', 162),
(2686, 'Northern Islands', 163),
(2687, 'Rota', 163),
(2688, 'Saipan', 163),
(2689, 'Tinian', 163),
(2690, 'Akershus', 164),
(2691, 'Aust Agder', 164),
(2692, 'Bergen', 164),
(2693, 'Buskerud', 164),
(2694, 'Finnmark', 164),
(2695, 'Hedmark', 164),
(2696, 'Hordaland', 164),
(2697, 'Moere og Romsdal', 164),
(2698, 'Nord Trondelag', 164),
(2699, 'Nordland', 164),
(2700, 'Oestfold', 164),
(2701, 'Oppland', 164),
(2702, 'Oslo', 164),
(2703, 'Rogaland', 164),
(2704, 'Soer Troendelag', 164),
(2705, 'Sogn og Fjordane', 164),
(2706, 'Stavern', 164),
(2707, 'Sykkylven', 164),
(2708, 'Telemark', 164),
(2709, 'Troms', 164),
(2710, 'Vest Agder', 164),
(2711, 'Vestfold', 164),
(2712, 'ÃƒÂ˜stfold', 164),
(2713, 'Al Buraimi', 165),
(2714, 'Dhufar', 165),
(2715, 'Masqat', 165),
(2716, 'Musandam', 165),
(2717, 'Rusayl', 165),
(2718, 'Wadi Kabir', 165),
(2719, 'ad-Dakhiliyah', 165),
(2720, 'adh-Dhahirah', 165),
(2721, 'al-Batinah', 165),
(2722, 'ash-Sharqiyah', 165),
(2723, 'Baluchistan', 166),
(2724, 'Federal Capital Area', 166),
(2725, 'Federally administered Tribal ', 166),
(2726, 'North-West Frontier', 166),
(2727, 'Northern Areas', 166),
(2728, 'Punjab', 166),
(2729, 'Sind', 166),
(2730, 'Aimeliik', 167),
(2731, 'Airai', 167),
(2732, 'Angaur', 167),
(2733, 'Hatobohei', 167),
(2734, 'Kayangel', 167),
(2735, 'Koror', 167),
(2736, 'Melekeok', 167),
(2737, 'Ngaraard', 167),
(2738, 'Ngardmau', 167),
(2739, 'Ngaremlengui', 167),
(2740, 'Ngatpang', 167),
(2741, 'Ngchesar', 167),
(2742, 'Ngerchelong', 167),
(2743, 'Ngiwal', 167),
(2744, 'Peleliu', 167),
(2745, 'Sonsorol', 167),
(2746, 'Ariha', 168),
(2747, 'Bayt Lahm', 168),
(2748, 'Bethlehem', 168),
(2749, 'Dayr-al-Balah', 168),
(2750, 'Ghazzah', 168),
(2751, 'Ghazzah ash-Shamaliyah', 168),
(2752, 'Janin', 168),
(2753, 'Khan Yunis', 168),
(2754, 'Nabulus', 168),
(2755, 'Qalqilyah', 168),
(2756, 'Rafah', 168),
(2757, 'Ram Allah wal-Birah', 168),
(2758, 'Salfit', 168),
(2759, 'Tubas', 168),
(2760, 'Tulkarm', 168),
(2761, 'al-Khalil', 168),
(2762, 'al-Quds', 168),
(2763, 'Bocas del Toro', 169),
(2764, 'Chiriqui', 169),
(2765, 'Cocle', 169),
(2766, 'Colon', 169),
(2767, 'Darien', 169),
(2768, 'Embera', 169),
(2769, 'Herrera', 169),
(2770, 'Kuna Yala', 169),
(2771, 'Los Santos', 169),
(2772, 'Ngobe Bugle', 169),
(2773, 'Panama', 169),
(2774, 'Veraguas', 169),
(2775, 'East New Britain', 170),
(2776, 'East Sepik', 170),
(2777, 'Eastern Highlands', 170),
(2778, 'Enga', 170),
(2779, 'Fly River', 170),
(2780, 'Gulf', 170),
(2781, 'Madang', 170),
(2782, 'Manus', 170),
(2783, 'Milne Bay', 170),
(2784, 'Morobe', 170),
(2785, 'National Capital District', 170),
(2786, 'New Ireland', 170),
(2787, 'North Solomons', 170),
(2788, 'Oro', 170),
(2789, 'Sandaun', 170),
(2790, 'Simbu', 170),
(2791, 'Southern Highlands', 170),
(2792, 'West New Britain', 170),
(2793, 'Western Highlands', 170),
(2794, 'Alto Paraguay', 171),
(2795, 'Alto Parana', 171),
(2796, 'Amambay', 171),
(2797, 'Asuncion', 171),
(2798, 'Boqueron', 171),
(2799, 'Caaguazu', 171),
(2800, 'Caazapa', 171),
(2801, 'Canendiyu', 171),
(2802, 'Central', 171),
(2803, 'Concepcion', 171),
(2804, 'Cordillera', 171),
(2805, 'Guaira', 171),
(2806, 'Itapua', 171),
(2807, 'Misiones', 171),
(2808, 'Neembucu', 171),
(2809, 'Paraguari', 171),
(2810, 'Presidente Hayes', 171),
(2811, 'San Pedro', 171),
(2812, 'Amazonas', 172),
(2813, 'Ancash', 172),
(2814, 'Apurimac', 172),
(2815, 'Arequipa', 172),
(2816, 'Ayacucho', 172),
(2817, 'Cajamarca', 172),
(2818, 'Cusco', 172),
(2819, 'Huancavelica', 172),
(2820, 'Huanuco', 172),
(2821, 'Ica', 172),
(2822, 'Junin', 172),
(2823, 'La Libertad', 172),
(2824, 'Lambayeque', 172),
(2825, 'Lima y Callao', 172),
(2826, 'Loreto', 172),
(2827, 'Madre de Dios', 172),
(2828, 'Moquegua', 172),
(2829, 'Pasco', 172),
(2830, 'Piura', 172),
(2831, 'Puno', 172),
(2832, 'San Martin', 172),
(2833, 'Tacna', 172),
(2834, 'Tumbes', 172),
(2835, 'Ucayali', 172),
(2836, 'Batangas', 173),
(2837, 'Bicol', 173),
(2838, 'Bulacan', 173),
(2839, 'Cagayan', 173),
(2840, 'Caraga', 173),
(2841, 'Central Luzon', 173),
(2842, 'Central Mindanao', 173),
(2843, 'Central Visayas', 173),
(2844, 'Cordillera', 173),
(2845, 'Davao', 173),
(2846, 'Eastern Visayas', 173),
(2847, 'Greater Metropolitan Area', 173),
(2848, 'Ilocos', 173),
(2849, 'Laguna', 173),
(2850, 'Luzon', 173),
(2851, 'Mactan', 173),
(2852, 'Metropolitan Manila Area', 173),
(2853, 'Muslim Mindanao', 173),
(2854, 'Northern Mindanao', 173),
(2855, 'Southern Mindanao', 173),
(2856, 'Southern Tagalog', 173),
(2857, 'Western Mindanao', 173),
(2858, 'Western Visayas', 173),
(2859, 'Pitcairn Island', 174),
(2860, 'Biale Blota', 175),
(2861, 'Dobroszyce', 175),
(2862, 'Dolnoslaskie', 175),
(2863, 'Dziekanow Lesny', 175),
(2864, 'Hopowo', 175),
(2865, 'Kartuzy', 175),
(2866, 'Koscian', 175),
(2867, 'Krakow', 175),
(2868, 'Kujawsko-Pomorskie', 175),
(2869, 'Lodzkie', 175),
(2870, 'Lubelskie', 175),
(2871, 'Lubuskie', 175),
(2872, 'Malomice', 175),
(2873, 'Malopolskie', 175),
(2874, 'Mazowieckie', 175),
(2875, 'Mirkow', 175),
(2876, 'Opolskie', 175),
(2877, 'Ostrowiec', 175),
(2878, 'Podkarpackie', 175),
(2879, 'Podlaskie', 175),
(2880, 'Polska', 175),
(2881, 'Pomorskie', 175),
(2882, 'Poznan', 175),
(2883, 'Pruszkow', 175),
(2884, 'Rymanowska', 175),
(2885, 'Rzeszow', 175),
(2886, 'Slaskie', 175),
(2887, 'Stare Pole', 175),
(2888, 'Swietokrzyskie', 175),
(2889, 'Warminsko-Mazurskie', 175),
(2890, 'Warsaw', 175),
(2891, 'Wejherowo', 175),
(2892, 'Wielkopolskie', 175),
(2893, 'Wroclaw', 175),
(2894, 'Zachodnio-Pomorskie', 175),
(2895, 'Zukowo', 175),
(2896, 'Abrantes', 176),
(2897, 'Acores', 176),
(2898, 'Alentejo', 176),
(2899, 'Algarve', 176),
(2900, 'Braga', 176),
(2901, 'Centro', 176),
(2902, 'Distrito de Leiria', 176),
(2903, 'Distrito de Viana do Castelo', 176),
(2904, 'Distrito de Vila Real', 176),
(2905, 'Distrito do Porto', 176),
(2906, 'Lisboa e Vale do Tejo', 176),
(2907, 'Madeira', 176),
(2908, 'Norte', 176),
(2909, 'Paivas', 176),
(2910, 'Arecibo', 177),
(2911, 'Bayamon', 177),
(2912, 'Carolina', 177),
(2913, 'Florida', 177),
(2914, 'Guayama', 177),
(2915, 'Humacao', 177),
(2916, 'Mayaguez-Aguadilla', 177),
(2917, 'Ponce', 177),
(2918, 'Salinas', 177),
(2919, 'San Juan', 177),
(2920, 'Doha', 178),
(2921, 'Jarian-al-Batnah', 178),
(2922, 'Umm Salal', 178),
(2923, 'ad-Dawhah', 178),
(2924, 'al-Ghuwayriyah', 178),
(2925, 'al-Jumayliyah', 178),
(2926, 'al-Khawr', 178),
(2927, 'al-Wakrah', 178),
(2928, 'ar-Rayyan', 178),
(2929, 'ash-Shamal', 178),
(2930, 'Saint-Benoit', 179),
(2931, 'Saint-Denis', 179),
(2932, 'Saint-Paul', 179),
(2933, 'Saint-Pierre', 179),
(2934, 'Alba', 180),
(2935, 'Arad', 180),
(2936, 'Arges', 180),
(2937, 'Bacau', 180),
(2938, 'Bihor', 180),
(2939, 'Bistrita-Nasaud', 180),
(2940, 'Botosani', 180),
(2941, 'Braila', 180),
(2942, 'Brasov', 180),
(2943, 'Bucuresti', 180),
(2944, 'Buzau', 180),
(2945, 'Calarasi', 180),
(2946, 'Caras-Severin', 180),
(2947, 'Cluj', 180),
(2948, 'Constanta', 180),
(2949, 'Covasna', 180),
(2950, 'Dambovita', 180),
(2951, 'Dolj', 180),
(2952, 'Galati', 180),
(2953, 'Giurgiu', 180),
(2954, 'Gorj', 180),
(2955, 'Harghita', 180),
(2956, 'Hunedoara', 180),
(2957, 'Ialomita', 180),
(2958, 'Iasi', 180),
(2959, 'Ilfov', 180),
(2960, 'Maramures', 180),
(2961, 'Mehedinti', 180),
(2962, 'Mures', 180),
(2963, 'Neamt', 180),
(2964, 'Olt', 180),
(2965, 'Prahova', 180),
(2966, 'Salaj', 180),
(2967, 'Satu Mare', 180),
(2968, 'Sibiu', 180),
(2969, 'Sondelor', 180),
(2970, 'Suceava', 180),
(2971, 'Teleorman', 180),
(2972, 'Timis', 180),
(2973, 'Tulcea', 180),
(2974, 'Valcea', 180),
(2975, 'Vaslui', 180),
(2976, 'Vrancea', 180),
(2977, 'Adygeja', 181),
(2978, 'Aga', 181),
(2979, 'Alanija', 181),
(2980, 'Altaj', 181),
(2981, 'Amur', 181),
(2982, 'Arhangelsk', 181),
(2983, 'Astrahan', 181),
(2984, 'Bashkortostan', 181),
(2985, 'Belgorod', 181),
(2986, 'Brjansk', 181),
(2987, 'Burjatija', 181),
(2988, 'Chechenija', 181),
(2989, 'Cheljabinsk', 181),
(2990, 'Chita', 181),
(2991, 'Chukotka', 181),
(2992, 'Chuvashija', 181),
(2993, 'Dagestan', 181),
(2994, 'Evenkija', 181),
(2995, 'Gorno-Altaj', 181),
(2996, 'Habarovsk', 181),
(2997, 'Hakasija', 181),
(2998, 'Hanty-Mansija', 181),
(2999, 'Ingusetija', 181),
(3000, 'Irkutsk', 181),
(3001, 'Ivanovo', 181),
(3002, 'Jamalo-Nenets', 181),
(3003, 'Jaroslavl', 181),
(3004, 'Jevrej', 181),
(3005, 'Kabardino-Balkarija', 181),
(3006, 'Kaliningrad', 181),
(3007, 'Kalmykija', 181),
(3008, 'Kaluga', 181),
(3009, 'Kamchatka', 181),
(3010, 'Karachaj-Cherkessija', 181),
(3011, 'Karelija', 181),
(3012, 'Kemerovo', 181),
(3013, 'Khabarovskiy Kray', 181),
(3014, 'Kirov', 181),
(3015, 'Komi', 181),
(3016, 'Komi-Permjakija', 181),
(3017, 'Korjakija', 181),
(3018, 'Kostroma', 181),
(3019, 'Krasnodar', 181),
(3020, 'Krasnojarsk', 181),
(3021, 'Krasnoyarskiy Kray', 181),
(3022, 'Kurgan', 181),
(3023, 'Kursk', 181),
(3024, 'Leningrad', 181),
(3025, 'Lipeck', 181),
(3026, 'Magadan', 181),
(3027, 'Marij El', 181),
(3028, 'Mordovija', 181),
(3029, 'Moscow', 181),
(3030, 'Moskovskaja Oblast', 181),
(3031, 'Moskovskaya Oblast', 181),
(3032, 'Moskva', 181),
(3033, 'Murmansk', 181),
(3034, 'Nenets', 181),
(3035, 'Nizhnij Novgorod', 181),
(3036, 'Novgorod', 181),
(3037, 'Novokusnezk', 181),
(3038, 'Novosibirsk', 181),
(3039, 'Omsk', 181),
(3040, 'Orenburg', 181),
(3041, 'Orjol', 181),
(3042, 'Penza', 181),
(3043, 'Perm', 181),
(3044, 'Primorje', 181),
(3045, 'Pskov', 181),
(3046, 'Pskovskaya Oblast', 181),
(3047, 'Rjazan', 181),
(3048, 'Rostov', 181),
(3049, 'Saha', 181),
(3050, 'Sahalin', 181),
(3051, 'Samara', 181),
(3052, 'Samarskaya', 181),
(3053, 'Sankt-Peterburg', 181),
(3054, 'Saratov', 181),
(3055, 'Smolensk', 181),
(3056, 'Stavropol', 181),
(3057, 'Sverdlovsk', 181),
(3058, 'Tajmyrija', 181),
(3059, 'Tambov', 181),
(3060, 'Tatarstan', 181),
(3061, 'Tjumen', 181),
(3062, 'Tomsk', 181),
(3063, 'Tula', 181),
(3064, 'Tver', 181),
(3065, 'Tyva', 181),
(3066, 'Udmurtija', 181),
(3067, 'Uljanovsk', 181),
(3068, 'Ulyanovskaya Oblast', 181),
(3069, 'Ust-Orda', 181),
(3070, 'Vladimir', 181),
(3071, 'Volgograd', 181),
(3072, 'Vologda', 181),
(3073, 'Voronezh', 181),
(3074, 'Butare', 182),
(3075, 'Byumba', 182),
(3076, 'Cyangugu', 182),
(3077, 'Gikongoro', 182),
(3078, 'Gisenyi', 182),
(3079, 'Gitarama', 182),
(3080, 'Kibungo', 182),
(3081, 'Kibuye', 182),
(3082, 'Kigali-ngali', 182),
(3083, 'Ruhengeri', 182),
(3084, 'Ascension', 183),
(3085, 'Gough Island', 183),
(3086, 'Saint Helena', 183),
(3087, 'Tristan da Cunha', 183),
(3088, 'Christ Church Nichola Town', 184),
(3089, 'Saint Anne Sandy Point', 184),
(3090, 'Saint George Basseterre', 184),
(3091, 'Saint George Gingerland', 184),
(3092, 'Saint James Windward', 184),
(3093, 'Saint John Capesterre', 184),
(3094, 'Saint John Figtree', 184),
(3095, 'Saint Mary Cayon', 184),
(3096, 'Saint Paul Capesterre', 184),
(3097, 'Saint Paul Charlestown', 184),
(3098, 'Saint Peter Basseterre', 184),
(3099, 'Saint Thomas Lowland', 184),
(3100, 'Saint Thomas Middle Island', 184),
(3101, 'Trinity Palmetto Point', 184),
(3102, 'Anse-la-Raye', 185),
(3103, 'Canaries', 185),
(3104, 'Castries', 185),
(3105, 'Choiseul', 185),
(3106, 'Dennery', 185),
(3107, 'Gros Inlet', 185),
(3108, 'Laborie', 185),
(3109, 'Micoud', 185),
(3110, 'Soufriere', 185),
(3111, 'Vieux Fort', 185),
(3112, 'Miquelon-Langlade', 186),
(3113, 'Saint-Pierre', 186),
(3114, 'Charlotte', 187),
(3115, 'Grenadines', 187),
(3116, 'Saint Andrew', 187),
(3117, 'Saint David', 187),
(3118, 'Saint George', 187),
(3119, 'Saint Patrick', 187),
(3120, 'A\'ana', 188),
(3121, 'Aiga-i-le-Tai', 188),
(3122, 'Atua', 188),
(3123, 'Fa\'asaleleaga', 188),
(3124, 'Gaga\'emauga', 188),
(3125, 'Gagaifomauga', 188),
(3126, 'Palauli', 188),
(3127, 'Satupa\'itea', 188),
(3128, 'Tuamasaga', 188),
(3129, 'Va\'a-o-Fonoti', 188),
(3130, 'Vaisigano', 188),
(3131, 'Acquaviva', 189),
(3132, 'Borgo Maggiore', 189),
(3133, 'Chiesanuova', 189),
(3134, 'Domagnano', 189),
(3135, 'Faetano', 189),
(3136, 'Fiorentino', 189),
(3137, 'Montegiardino', 189),
(3138, 'San Marino', 189),
(3139, 'Serravalle', 189),
(3140, 'Agua Grande', 190),
(3141, 'Cantagalo', 190),
(3142, 'Lemba', 190),
(3143, 'Lobata', 190),
(3144, 'Me-Zochi', 190),
(3145, 'Pague', 190),
(3146, 'Al Khobar', 191),
(3147, 'Aseer', 191),
(3148, 'Ash Sharqiyah', 191),
(3149, 'Asir', 191),
(3150, 'Central Province', 191),
(3151, 'Eastern Province', 191),
(3152, 'Ha\'il', 191),
(3153, 'Jawf', 191),
(3154, 'Jizan', 191),
(3155, 'Makkah', 191),
(3156, 'Najran', 191),
(3157, 'Qasim', 191),
(3158, 'Tabuk', 191),
(3159, 'Western Province', 191),
(3160, 'al-Bahah', 191),
(3161, 'al-Hudud-ash-Shamaliyah', 191),
(3162, 'al-Madinah', 191),
(3163, 'ar-Riyad', 191),
(3164, 'Dakar', 192),
(3165, 'Diourbel', 192),
(3166, 'Fatick', 192),
(3167, 'Kaolack', 192),
(3168, 'Kolda', 192),
(3169, 'Louga', 192),
(3170, 'Saint-Louis', 192),
(3171, 'Tambacounda', 192),
(3172, 'Thies', 192),
(3173, 'Ziguinchor', 192),
(3174, 'Central Serbia', 193),
(3175, 'Kosovo and Metohija', 193),
(3176, 'Vojvodina', 193),
(3177, 'Anse Boileau', 194),
(3178, 'Anse Royale', 194),
(3179, 'Cascade', 194),
(3180, 'Takamaka', 194),
(3181, 'Victoria', 194),
(3182, 'Eastern', 195),
(3183, 'Northern', 195),
(3184, 'Southern', 195),
(3185, 'Western', 195),
(3186, 'Singapore', 196),
(3187, 'Banskobystricky', 197),
(3188, 'Bratislavsky', 197),
(3189, 'Kosicky', 197),
(3190, 'Nitriansky', 197),
(3191, 'Presovsky', 197),
(3192, 'Trenciansky', 197),
(3193, 'Trnavsky', 197),
(3194, 'Zilinsky', 197),
(3195, 'Benedikt', 198),
(3196, 'Gorenjska', 198),
(3197, 'Gorishka', 198),
(3198, 'Jugovzhodna Slovenija', 198),
(3199, 'Koroshka', 198),
(3200, 'Notranjsko-krashka', 198),
(3201, 'Obalno-krashka', 198),
(3202, 'Obcina Domzale', 198),
(3203, 'Obcina Vitanje', 198),
(3204, 'Osrednjeslovenska', 198),
(3205, 'Podravska', 198),
(3206, 'Pomurska', 198),
(3207, 'Savinjska', 198),
(3208, 'Slovenian Littoral', 198),
(3209, 'Spodnjeposavska', 198),
(3210, 'Zasavska', 198),
(3211, 'Pitcairn', 199),
(3212, 'Central', 200),
(3213, 'Choiseul', 200),
(3214, 'Guadalcanal', 200),
(3215, 'Isabel', 200),
(3216, 'Makira and Ulawa', 200),
(3217, 'Malaita', 200),
(3218, 'Rennell and Bellona', 200),
(3219, 'Temotu', 200),
(3220, 'Western', 200),
(3221, 'Awdal', 201),
(3222, 'Bakol', 201),
(3223, 'Banadir', 201),
(3224, 'Bari', 201),
(3225, 'Bay', 201),
(3226, 'Galgudug', 201),
(3227, 'Gedo', 201),
(3228, 'Hiran', 201),
(3229, 'Jubbada Hose', 201),
(3230, 'Jubbadha Dexe', 201),
(3231, 'Mudug', 201),
(3232, 'Nugal', 201),
(3233, 'Sanag', 201),
(3234, 'Shabellaha Dhexe', 201),
(3235, 'Shabellaha Hose', 201),
(3236, 'Togdher', 201),
(3237, 'Woqoyi Galbed', 201),
(3238, 'Eastern Cape', 202),
(3239, 'Free State', 202),
(3240, 'Gauteng', 202),
(3241, 'Kempton Park', 202),
(3242, 'Kramerville', 202),
(3243, 'KwaZulu Natal', 202),
(3244, 'Limpopo', 202),
(3245, 'Mpumalanga', 202),
(3246, 'North West', 202),
(3247, 'Northern Cape', 202),
(3248, 'Parow', 202),
(3249, 'Table View', 202),
(3250, 'Umtentweni', 202),
(3251, 'Western Cape', 202),
(3252, 'South Georgia', 203),
(3253, 'Central Equatoria', 204),
(3254, 'A Coruna', 205),
(3255, 'Alacant', 205),
(3256, 'Alava', 205),
(3257, 'Albacete', 205),
(3258, 'Almeria', 205),
(3259, 'Andalucia', 205),
(3260, 'Asturias', 205),
(3261, 'Avila', 205),
(3262, 'Badajoz', 205),
(3263, 'Balears', 205),
(3264, 'Barcelona', 205),
(3265, 'Bertamirans', 205),
(3266, 'Biscay', 205),
(3267, 'Burgos', 205),
(3268, 'Caceres', 205),
(3269, 'Cadiz', 205),
(3270, 'Cantabria', 205),
(3271, 'Castello', 205),
(3272, 'Catalunya', 205),
(3273, 'Ceuta', 205),
(3274, 'Ciudad Real', 205),
(3275, 'Comunidad Autonoma de Canarias', 205),
(3276, 'Comunidad Autonoma de Cataluna', 205),
(3277, 'Comunidad Autonoma de Galicia', 205),
(3278, 'Comunidad Autonoma de las Isla', 205),
(3279, 'Comunidad Autonoma del Princip', 205),
(3280, 'Comunidad Valenciana', 205),
(3281, 'Cordoba', 205),
(3282, 'Cuenca', 205),
(3283, 'Gipuzkoa', 205),
(3284, 'Girona', 205),
(3285, 'Granada', 205),
(3286, 'Guadalajara', 205),
(3287, 'Guipuzcoa', 205),
(3288, 'Huelva', 205),
(3289, 'Huesca', 205),
(3290, 'Jaen', 205),
(3291, 'La Rioja', 205),
(3292, 'Las Palmas', 205),
(3293, 'Leon', 205),
(3294, 'Lerida', 205),
(3295, 'Lleida', 205),
(3296, 'Lugo', 205),
(3297, 'Madrid', 205),
(3298, 'Malaga', 205),
(3299, 'Melilla', 205),
(3300, 'Murcia', 205),
(3301, 'Navarra', 205),
(3302, 'Ourense', 205),
(3303, 'Pais Vasco', 205),
(3304, 'Palencia', 205),
(3305, 'Pontevedra', 205),
(3306, 'Salamanca', 205),
(3307, 'Santa Cruz de Tenerife', 205),
(3308, 'Segovia', 205),
(3309, 'Sevilla', 205),
(3310, 'Soria', 205),
(3311, 'Tarragona', 205),
(3312, 'Tenerife', 205),
(3313, 'Teruel', 205),
(3314, 'Toledo', 205),
(3315, 'Valencia', 205),
(3316, 'Valladolid', 205),
(3317, 'Vizcaya', 205),
(3318, 'Zamora', 205),
(3319, 'Zaragoza', 205),
(3320, 'Amparai', 206),
(3321, 'Anuradhapuraya', 206),
(3322, 'Badulla', 206),
(3323, 'Boralesgamuwa', 206),
(3324, 'Colombo', 206),
(3325, 'Galla', 206),
(3326, 'Gampaha', 206),
(3327, 'Hambantota', 206),
(3328, 'Kalatura', 206),
(3329, 'Kegalla', 206),
(3330, 'Kilinochchi', 206),
(3331, 'Kurunegala', 206),
(3332, 'Madakalpuwa', 206),
(3333, 'Maha Nuwara', 206),
(3334, 'Malwana', 206),
(3335, 'Mannarama', 206),
(3336, 'Matale', 206),
(3337, 'Matara', 206),
(3338, 'Monaragala', 206),
(3339, 'Mullaitivu', 206),
(3340, 'North Eastern Province', 206),
(3341, 'North Western Province', 206),
(3342, 'Nuwara Eliya', 206),
(3343, 'Polonnaruwa', 206),
(3344, 'Puttalama', 206),
(3345, 'Ratnapuraya', 206),
(3346, 'Southern Province', 206),
(3347, 'Tirikunamalaya', 206),
(3348, 'Tuscany', 206),
(3349, 'Vavuniyawa', 206),
(3350, 'Western Province', 206),
(3351, 'Yapanaya', 206),
(3352, 'kadawatha', 206),
(3353, 'A\'ali-an-Nil', 207),
(3354, 'Bahr-al-Jabal', 207),
(3355, 'Central Equatoria', 207),
(3356, 'Gharb Bahr-al-Ghazal', 207),
(3357, 'Gharb Darfur', 207),
(3358, 'Gharb Kurdufan', 207),
(3359, 'Gharb-al-Istiwa\'iyah', 207),
(3360, 'Janub Darfur', 207),
(3361, 'Janub Kurdufan', 207),
(3362, 'Junqali', 207),
(3363, 'Kassala', 207),
(3364, 'Nahr-an-Nil', 207),
(3365, 'Shamal Bahr-al-Ghazal', 207),
(3366, 'Shamal Darfur', 207),
(3367, 'Shamal Kurdufan', 207),
(3368, 'Sharq-al-Istiwa\'iyah', 207),
(3369, 'Sinnar', 207),
(3370, 'Warab', 207),
(3371, 'Wilayat al Khartum', 207),
(3372, 'al-Bahr-al-Ahmar', 207),
(3373, 'al-Buhayrat', 207),
(3374, 'al-Jazirah', 207),
(3375, 'al-Khartum', 207),
(3376, 'al-Qadarif', 207),
(3377, 'al-Wahdah', 207),
(3378, 'an-Nil-al-Abyad', 207),
(3379, 'an-Nil-al-Azraq', 207),
(3380, 'ash-Shamaliyah', 207),
(3381, 'Brokopondo', 208),
(3382, 'Commewijne', 208),
(3383, 'Coronie', 208),
(3384, 'Marowijne', 208),
(3385, 'Nickerie', 208),
(3386, 'Para', 208),
(3387, 'Paramaribo', 208),
(3388, 'Saramacca', 208),
(3389, 'Wanica', 208),
(3390, 'Svalbard', 209),
(3391, 'Hhohho', 210),
(3392, 'Lubombo', 210),
(3393, 'Manzini', 210),
(3394, 'Shiselweni', 210),
(3395, 'Alvsborgs Lan', 211),
(3396, 'Angermanland', 211),
(3397, 'Blekinge', 211),
(3398, 'Bohuslan', 211),
(3399, 'Dalarna', 211),
(3400, 'Gavleborg', 211),
(3401, 'Gaza', 211),
(3402, 'Gotland', 211),
(3403, 'Halland', 211),
(3404, 'Jamtland', 211),
(3405, 'Jonkoping', 211),
(3406, 'Kalmar', 211),
(3407, 'Kristianstads', 211),
(3408, 'Kronoberg', 211),
(3409, 'Norrbotten', 211),
(3410, 'Orebro', 211),
(3411, 'Ostergotland', 211),
(3412, 'Saltsjo-Boo', 211),
(3413, 'Skane', 211),
(3414, 'Smaland', 211),
(3415, 'Sodermanland', 211),
(3416, 'Stockholm', 211),
(3417, 'Uppsala', 211),
(3418, 'Varmland', 211),
(3419, 'Vasterbotten', 211),
(3420, 'Vastergotland', 211),
(3421, 'Vasternorrland', 211),
(3422, 'Vastmanland', 211),
(3423, 'Vastra Gotaland', 211),
(3424, 'Aargau', 212),
(3425, 'Appenzell Inner-Rhoden', 212),
(3426, 'Appenzell-Ausser Rhoden', 212),
(3427, 'Basel-Landschaft', 212),
(3428, 'Basel-Stadt', 212),
(3429, 'Bern', 212),
(3430, 'Canton Ticino', 212),
(3431, 'Fribourg', 212),
(3432, 'Geneve', 212),
(3433, 'Glarus', 212),
(3434, 'Graubunden', 212),
(3435, 'Heerbrugg', 212),
(3436, 'Jura', 212),
(3437, 'Kanton Aargau', 212),
(3438, 'Luzern', 212),
(3439, 'Morbio Inferiore', 212),
(3440, 'Muhen', 212),
(3441, 'Neuchatel', 212),
(3442, 'Nidwalden', 212),
(3443, 'Obwalden', 212),
(3444, 'Sankt Gallen', 212),
(3445, 'Schaffhausen', 212),
(3446, 'Schwyz', 212),
(3447, 'Solothurn', 212),
(3448, 'Thurgau', 212),
(3449, 'Ticino', 212),
(3450, 'Uri', 212),
(3451, 'Valais', 212),
(3452, 'Vaud', 212),
(3453, 'Vauffelin', 212),
(3454, 'Zug', 212),
(3455, 'Zurich', 212),
(3456, 'Aleppo', 213),
(3457, 'Dar\'a', 213),
(3458, 'Dayr-az-Zawr', 213),
(3459, 'Dimashq', 213),
(3460, 'Halab', 213),
(3461, 'Hamah', 213),
(3462, 'Hims', 213),
(3463, 'Idlib', 213),
(3464, 'Madinat Dimashq', 213),
(3465, 'Tartus', 213),
(3466, 'al-Hasakah', 213),
(3467, 'al-Ladhiqiyah', 213),
(3468, 'al-Qunaytirah', 213),
(3469, 'ar-Raqqah', 213),
(3470, 'as-Suwayda', 213),
(3471, 'Changhwa', 214),
(3472, 'Chiayi Hsien', 214),
(3473, 'Chiayi Shih', 214),
(3474, 'Eastern Taipei', 214),
(3475, 'Hsinchu Hsien', 214),
(3476, 'Hsinchu Shih', 214),
(3477, 'Hualien', 214),
(3478, 'Ilan', 214),
(3479, 'Kaohsiung Hsien', 214),
(3480, 'Kaohsiung Shih', 214),
(3481, 'Keelung Shih', 214),
(3482, 'Kinmen', 214),
(3483, 'Miaoli', 214),
(3484, 'Nantou', 214),
(3485, 'Northern Taiwan', 214),
(3486, 'Penghu', 214),
(3487, 'Pingtung', 214),
(3488, 'Taichung', 214),
(3489, 'Taichung Hsien', 214),
(3490, 'Taichung Shih', 214),
(3491, 'Tainan Hsien', 214),
(3492, 'Tainan Shih', 214),
(3493, 'Taipei Hsien', 214),
(3494, 'Taipei Shih / Taipei Hsien', 214),
(3495, 'Taitung', 214),
(3496, 'Taoyuan', 214),
(3497, 'Yilan', 214),
(3498, 'Yun-Lin Hsien', 214),
(3499, 'Yunlin', 214),
(3500, 'Dushanbe', 215),
(3501, 'Gorno-Badakhshan', 215),
(3502, 'Karotegin', 215),
(3503, 'Khatlon', 215),
(3504, 'Sughd', 215),
(3505, 'Arusha', 216),
(3506, 'Dar es Salaam', 216),
(3507, 'Dodoma', 216),
(3508, 'Iringa', 216),
(3509, 'Kagera', 216),
(3510, 'Kigoma', 216),
(3511, 'Kilimanjaro', 216),
(3512, 'Lindi', 216),
(3513, 'Mara', 216),
(3514, 'Mbeya', 216),
(3515, 'Morogoro', 216),
(3516, 'Mtwara', 216),
(3517, 'Mwanza', 216),
(3518, 'Pwani', 216),
(3519, 'Rukwa', 216),
(3520, 'Ruvuma', 216),
(3521, 'Shinyanga', 216),
(3522, 'Singida', 216),
(3523, 'Tabora', 216),
(3524, 'Tanga', 216),
(3525, 'Zanzibar and Pemba', 216),
(3526, 'Amnat Charoen', 217),
(3527, 'Ang Thong', 217),
(3528, 'Bangkok', 217),
(3529, 'Buri Ram', 217),
(3530, 'Chachoengsao', 217),
(3531, 'Chai Nat', 217),
(3532, 'Chaiyaphum', 217),
(3533, 'Changwat Chaiyaphum', 217),
(3534, 'Chanthaburi', 217),
(3535, 'Chiang Mai', 217),
(3536, 'Chiang Rai', 217),
(3537, 'Chon Buri', 217),
(3538, 'Chumphon', 217),
(3539, 'Kalasin', 217),
(3540, 'Kamphaeng Phet', 217),
(3541, 'Kanchanaburi', 217),
(3542, 'Khon Kaen', 217),
(3543, 'Krabi', 217),
(3544, 'Krung Thep', 217),
(3545, 'Lampang', 217),
(3546, 'Lamphun', 217),
(3547, 'Loei', 217),
(3548, 'Lop Buri', 217),
(3549, 'Mae Hong Son', 217),
(3550, 'Maha Sarakham', 217),
(3551, 'Mukdahan', 217),
(3552, 'Nakhon Nayok', 217),
(3553, 'Nakhon Pathom', 217),
(3554, 'Nakhon Phanom', 217),
(3555, 'Nakhon Ratchasima', 217),
(3556, 'Nakhon Sawan', 217),
(3557, 'Nakhon Si Thammarat', 217),
(3558, 'Nan', 217),
(3559, 'Narathiwat', 217),
(3560, 'Nong Bua Lam Phu', 217),
(3561, 'Nong Khai', 217),
(3562, 'Nonthaburi', 217),
(3563, 'Pathum Thani', 217),
(3564, 'Pattani', 217),
(3565, 'Phangnga', 217),
(3566, 'Phatthalung', 217),
(3567, 'Phayao', 217),
(3568, 'Phetchabun', 217),
(3569, 'Phetchaburi', 217),
(3570, 'Phichit', 217),
(3571, 'Phitsanulok', 217),
(3572, 'Phra Nakhon Si Ayutthaya', 217),
(3573, 'Phrae', 217),
(3574, 'Phuket', 217),
(3575, 'Prachin Buri', 217),
(3576, 'Prachuap Khiri Khan', 217),
(3577, 'Ranong', 217),
(3578, 'Ratchaburi', 217),
(3579, 'Rayong', 217),
(3580, 'Roi Et', 217),
(3581, 'Sa Kaeo', 217),
(3582, 'Sakon Nakhon', 217),
(3583, 'Samut Prakan', 217),
(3584, 'Samut Sakhon', 217),
(3585, 'Samut Songkhran', 217),
(3586, 'Saraburi', 217),
(3587, 'Satun', 217),
(3588, 'Si Sa Ket', 217),
(3589, 'Sing Buri', 217),
(3590, 'Songkhla', 217),
(3591, 'Sukhothai', 217),
(3592, 'Suphan Buri', 217),
(3593, 'Surat Thani', 217),
(3594, 'Surin', 217),
(3595, 'Tak', 217),
(3596, 'Trang', 217),
(3597, 'Trat', 217),
(3598, 'Ubon Ratchathani', 217),
(3599, 'Udon Thani', 217),
(3600, 'Uthai Thani', 217),
(3601, 'Uttaradit', 217),
(3602, 'Yala', 217),
(3603, 'Yasothon', 217),
(3604, 'Centre', 218),
(3605, 'Kara', 218),
(3606, 'Maritime', 218),
(3607, 'Plateaux', 218),
(3608, 'Savanes', 218),
(3609, 'Atafu', 219),
(3610, 'Fakaofo', 219),
(3611, 'Nukunonu', 219),
(3612, 'Eua', 220),
(3613, 'Ha\'apai', 220),
(3614, 'Niuas', 220),
(3615, 'Tongatapu', 220),
(3616, 'Vava\'u', 220),
(3617, 'Arima-Tunapuna-Piarco', 221),
(3618, 'Caroni', 221),
(3619, 'Chaguanas', 221),
(3620, 'Couva-Tabaquite-Talparo', 221),
(3621, 'Diego Martin', 221),
(3622, 'Glencoe', 221),
(3623, 'Penal Debe', 221),
(3624, 'Point Fortin', 221),
(3625, 'Port of Spain', 221),
(3626, 'Princes Town', 221),
(3627, 'Saint George', 221),
(3628, 'San Fernando', 221),
(3629, 'San Juan', 221),
(3630, 'Sangre Grande', 221),
(3631, 'Siparia', 221),
(3632, 'Tobago', 221),
(3633, 'Aryanah', 222),
(3634, 'Bajah', 222),
(3635, 'Bin \'Arus', 222),
(3636, 'Binzart', 222),
(3637, 'Gouvernorat de Ariana', 222),
(3638, 'Gouvernorat de Nabeul', 222),
(3639, 'Gouvernorat de Sousse', 222),
(3640, 'Hammamet Yasmine', 222),
(3641, 'Jundubah', 222),
(3642, 'Madaniyin', 222),
(3643, 'Manubah', 222),
(3644, 'Monastir', 222),
(3645, 'Nabul', 222),
(3646, 'Qabis', 222),
(3647, 'Qafsah', 222),
(3648, 'Qibili', 222),
(3649, 'Safaqis', 222),
(3650, 'Sfax', 222),
(3651, 'Sidi Bu Zayd', 222),
(3652, 'Silyanah', 222),
(3653, 'Susah', 222),
(3654, 'Tatawin', 222),
(3655, 'Tawzar', 222),
(3656, 'Tunis', 222),
(3657, 'Zaghwan', 222),
(3658, 'al-Kaf', 222),
(3659, 'al-Mahdiyah', 222),
(3660, 'al-Munastir', 222),
(3661, 'al-Qasrayn', 222),
(3662, 'al-Qayrawan', 222),
(3663, 'Adana', 223),
(3664, 'Adiyaman', 223),
(3665, 'Afyon', 223),
(3666, 'Agri', 223),
(3667, 'Aksaray', 223),
(3668, 'Amasya', 223),
(3669, 'Ankara', 223),
(3670, 'Antalya', 223),
(3671, 'Ardahan', 223),
(3672, 'Artvin', 223),
(3673, 'Aydin', 223),
(3674, 'Balikesir', 223),
(3675, 'Bartin', 223),
(3676, 'Batman', 223),
(3677, 'Bayburt', 223),
(3678, 'Bilecik', 223),
(3679, 'Bingol', 223),
(3680, 'Bitlis', 223),
(3681, 'Bolu', 223),
(3682, 'Burdur', 223),
(3683, 'Bursa', 223),
(3684, 'Canakkale', 223),
(3685, 'Cankiri', 223),
(3686, 'Corum', 223),
(3687, 'Denizli', 223),
(3688, 'Diyarbakir', 223),
(3689, 'Duzce', 223),
(3690, 'Edirne', 223),
(3691, 'Elazig', 223),
(3692, 'Erzincan', 223),
(3693, 'Erzurum', 223),
(3694, 'Eskisehir', 223),
(3695, 'Gaziantep', 223),
(3696, 'Giresun', 223),
(3697, 'Gumushane', 223),
(3698, 'Hakkari', 223),
(3699, 'Hatay', 223),
(3700, 'Icel', 223),
(3701, 'Igdir', 223),
(3702, 'Isparta', 223),
(3703, 'Istanbul', 223),
(3704, 'Izmir', 223),
(3705, 'Kahramanmaras', 223),
(3706, 'Karabuk', 223),
(3707, 'Karaman', 223),
(3708, 'Kars', 223),
(3709, 'Karsiyaka', 223),
(3710, 'Kastamonu', 223),
(3711, 'Kayseri', 223),
(3712, 'Kilis', 223),
(3713, 'Kirikkale', 223),
(3714, 'Kirklareli', 223),
(3715, 'Kirsehir', 223),
(3716, 'Kocaeli', 223),
(3717, 'Konya', 223),
(3718, 'Kutahya', 223),
(3719, 'Lefkosa', 223),
(3720, 'Malatya', 223),
(3721, 'Manisa', 223),
(3722, 'Mardin', 223),
(3723, 'Mugla', 223),
(3724, 'Mus', 223),
(3725, 'Nevsehir', 223),
(3726, 'Nigde', 223),
(3727, 'Ordu', 223),
(3728, 'Osmaniye', 223),
(3729, 'Rize', 223),
(3730, 'Sakarya', 223),
(3731, 'Samsun', 223),
(3732, 'Sanliurfa', 223),
(3733, 'Siirt', 223),
(3734, 'Sinop', 223),
(3735, 'Sirnak', 223),
(3736, 'Sivas', 223),
(3737, 'Tekirdag', 223),
(3738, 'Tokat', 223),
(3739, 'Trabzon', 223),
(3740, 'Tunceli', 223),
(3741, 'Usak', 223),
(3742, 'Van', 223),
(3743, 'Yalova', 223),
(3744, 'Yozgat', 223),
(3745, 'Zonguldak', 223),
(3746, 'Ahal', 224),
(3747, 'Asgabat', 224),
(3748, 'Balkan', 224),
(3749, 'Dasoguz', 224),
(3750, 'Lebap', 224),
(3751, 'Mari', 224),
(3752, 'Grand Turk', 225),
(3753, 'South Caicos and East Caicos', 225),
(3754, 'Funafuti', 226),
(3755, 'Nanumanga', 226),
(3756, 'Nanumea', 226),
(3757, 'Niutao', 226),
(3758, 'Nui', 226),
(3759, 'Nukufetau', 226),
(3760, 'Nukulaelae', 226),
(3761, 'Vaitupu', 226),
(3762, 'Central', 227),
(3763, 'Eastern', 227),
(3764, 'Northern', 227),
(3765, 'Western', 227),
(3766, 'Cherkas\'ka', 228),
(3767, 'Chernihivs\'ka', 228),
(3768, 'Chernivets\'ka', 228),
(3769, 'Crimea', 228),
(3770, 'Dnipropetrovska', 228),
(3771, 'Donets\'ka', 228),
(3772, 'Ivano-Frankivs\'ka', 228),
(3773, 'Kharkiv', 228),
(3774, 'Kharkov', 228),
(3775, 'Khersonska', 228),
(3776, 'Khmel\'nyts\'ka', 228),
(3777, 'Kirovohrad', 228),
(3778, 'Krym', 228),
(3779, 'Kyyiv', 228),
(3780, 'Kyyivs\'ka', 228),
(3781, 'L\'vivs\'ka', 228),
(3782, 'Luhans\'ka', 228),
(3783, 'Mykolayivs\'ka', 228),
(3784, 'Odes\'ka', 228),
(3785, 'Odessa', 228),
(3786, 'Poltavs\'ka', 228),
(3787, 'Rivnens\'ka', 228),
(3788, 'Sevastopol\'', 228),
(3789, 'Sums\'ka', 228),
(3790, 'Ternopil\'s\'ka', 228),
(3791, 'Volyns\'ka', 228),
(3792, 'Vynnyts\'ka', 228),
(3793, 'Zakarpats\'ka', 228),
(3794, 'Zaporizhia', 228),
(3795, 'Zhytomyrs\'ka', 228),
(3796, 'Abu Zabi', 229),
(3797, 'Ajman', 229),
(3798, 'Dubai', 229),
(3799, 'Ras al-Khaymah', 229),
(3800, 'Sharjah', 229),
(3801, 'Sharjha', 229),
(3802, 'Umm al Qaywayn', 229),
(3803, 'al-Fujayrah', 229),
(3804, 'ash-Shariqah', 229),
(3805, 'Aberdeen', 230),
(3806, 'Aberdeenshire', 230),
(3807, 'Argyll', 230),
(3808, 'Armagh', 230),
(3809, 'Bedfordshire', 230),
(3810, 'Belfast', 230),
(3811, 'Berkshire', 230),
(3812, 'Birmingham', 230),
(3813, 'Brechin', 230),
(3814, 'Bridgnorth', 230),
(3815, 'Bristol', 230),
(3816, 'Buckinghamshire', 230),
(3817, 'Cambridge', 230),
(3818, 'Cambridgeshire', 230),
(3819, 'Channel Islands', 230),
(3820, 'Cheshire', 230),
(3821, 'Cleveland', 230),
(3822, 'Co Fermanagh', 230),
(3823, 'Conwy', 230),
(3824, 'Cornwall', 230),
(3825, 'Coventry', 230),
(3826, 'Craven Arms', 230),
(3827, 'Cumbria', 230),
(3828, 'Denbighshire', 230),
(3829, 'Derby', 230),
(3830, 'Derbyshire', 230),
(3831, 'Devon', 230),
(3832, 'Dial Code Dungannon', 230),
(3833, 'Didcot', 230),
(3834, 'Dorset', 230),
(3835, 'Dunbartonshire', 230),
(3836, 'Durham', 230),
(3837, 'East Dunbartonshire', 230),
(3838, 'East Lothian', 230),
(3839, 'East Midlands', 230),
(3840, 'East Sussex', 230),
(3841, 'East Yorkshire', 230),
(3842, 'England', 230),
(3843, 'Essex', 230),
(3844, 'Fermanagh', 230),
(3845, 'Fife', 230),
(3846, 'Flintshire', 230),
(3847, 'Fulham', 230),
(3848, 'Gainsborough', 230),
(3849, 'Glocestershire', 230),
(3850, 'Gwent', 230),
(3851, 'Hampshire', 230),
(3852, 'Hants', 230),
(3853, 'Herefordshire', 230),
(3854, 'Hertfordshire', 230),
(3855, 'Ireland', 230),
(3856, 'Isle Of Man', 230),
(3857, 'Isle of Wight', 230),
(3858, 'Kenford', 230),
(3859, 'Kent', 230),
(3860, 'Kilmarnock', 230),
(3861, 'Lanarkshire', 230),
(3862, 'Lancashire', 230),
(3863, 'Leicestershire', 230),
(3864, 'Lincolnshire', 230),
(3865, 'Llanymynech', 230),
(3866, 'London', 230),
(3867, 'Ludlow', 230),
(3868, 'Manchester', 230),
(3869, 'Mayfair', 230),
(3870, 'Merseyside', 230),
(3871, 'Mid Glamorgan', 230),
(3872, 'Middlesex', 230),
(3873, 'Mildenhall', 230),
(3874, 'Monmouthshire', 230),
(3875, 'Newton Stewart', 230),
(3876, 'Norfolk', 230),
(3877, 'North Humberside', 230),
(3878, 'North Yorkshire', 230),
(3879, 'Northamptonshire', 230),
(3880, 'Northants', 230),
(3881, 'Northern Ireland', 230),
(3882, 'Northumberland', 230),
(3883, 'Nottinghamshire', 230),
(3884, 'Oxford', 230),
(3885, 'Powys', 230),
(3886, 'Roos-shire', 230),
(3887, 'SUSSEX', 230),
(3888, 'Sark', 230),
(3889, 'Scotland', 230),
(3890, 'Scottish Borders', 230),
(3891, 'Shropshire', 230),
(3892, 'Somerset', 230),
(3893, 'South Glamorgan', 230),
(3894, 'South Wales', 230),
(3895, 'South Yorkshire', 230),
(3896, 'Southwell', 230),
(3897, 'Staffordshire', 230),
(3898, 'Strabane', 230),
(3899, 'Suffolk', 230),
(3900, 'Surrey', 230),
(3901, 'Sussex', 230),
(3902, 'Twickenham', 230),
(3903, 'Tyne and Wear', 230),
(3904, 'Tyrone', 230),
(3905, 'Utah', 230),
(3906, 'Wales', 230),
(3907, 'Warwickshire', 230),
(3908, 'West Lothian', 230),
(3909, 'West Midlands', 230),
(3910, 'West Sussex', 230),
(3911, 'West Yorkshire', 230),
(3912, 'Whissendine', 230),
(3913, 'Wiltshire', 230),
(3914, 'Wokingham', 230),
(3915, 'Worcestershire', 230),
(3916, 'Wrexham', 230),
(3917, 'Wurttemberg', 230),
(3918, 'Yorkshire', 230),
(3919, 'Alabama', 231),
(3920, 'Alaska', 231),
(3921, 'Arizona', 231),
(3922, 'Arkansas', 231),
(3923, 'Byram', 231),
(3924, 'California', 231),
(3925, 'Cokato', 231),
(3926, 'Colorado', 231),
(3927, 'Connecticut', 231),
(3928, 'Delaware', 231),
(3929, 'District of Columbia', 231),
(3930, 'Florida', 231),
(3931, 'Georgia', 231),
(3932, 'Hawaii', 231),
(3933, 'Idaho', 231),
(3934, 'Illinois', 231),
(3935, 'Indiana', 231),
(3936, 'Iowa', 231),
(3937, 'Kansas', 231),
(3938, 'Kentucky', 231),
(3939, 'Louisiana', 231),
(3940, 'Lowa', 231),
(3941, 'Maine', 231),
(3942, 'Maryland', 231),
(3943, 'Massachusetts', 231),
(3944, 'Medfield', 231),
(3945, 'Michigan', 231),
(3946, 'Minnesota', 231),
(3947, 'Mississippi', 231),
(3948, 'Missouri', 231),
(3949, 'Montana', 231),
(3950, 'Nebraska', 231),
(3951, 'Nevada', 231),
(3952, 'New Hampshire', 231),
(3953, 'New Jersey', 231),
(3954, 'New Jersy', 231),
(3955, 'New Mexico', 231),
(3956, 'New York', 231),
(3957, 'North Carolina', 231),
(3958, 'North Dakota', 231),
(3959, 'Ohio', 231),
(3960, 'Oklahoma', 231),
(3961, 'Ontario', 231),
(3962, 'Oregon', 231),
(3963, 'Pennsylvania', 231),
(3964, 'Ramey', 231),
(3965, 'Rhode Island', 231),
(3966, 'South Carolina', 231),
(3967, 'South Dakota', 231),
(3968, 'Sublimity', 231),
(3969, 'Tennessee', 231),
(3970, 'Texas', 231),
(3971, 'Trimble', 231),
(3972, 'Utah', 231),
(3973, 'Vermont', 231),
(3974, 'Virginia', 231),
(3975, 'Washington', 231),
(3976, 'West Virginia', 231),
(3977, 'Wisconsin', 231),
(3978, 'Wyoming', 231),
(3979, 'United States Minor Outlying I', 232),
(3980, 'Artigas', 233),
(3981, 'Canelones', 233),
(3982, 'Cerro Largo', 233),
(3983, 'Colonia', 233),
(3984, 'Durazno', 233),
(3985, 'FLorida', 233),
(3986, 'Flores', 233),
(3987, 'Lavalleja', 233),
(3988, 'Maldonado', 233),
(3989, 'Montevideo', 233),
(3990, 'Paysandu', 233),
(3991, 'Rio Negro', 233),
(3992, 'Rivera', 233),
(3993, 'Rocha', 233),
(3994, 'Salto', 233),
(3995, 'San Jose', 233),
(3996, 'Soriano', 233),
(3997, 'Tacuarembo', 233),
(3998, 'Treinta y Tres', 233),
(3999, 'Andijon', 234),
(4000, 'Buhoro', 234),
(4001, 'Buxoro Viloyati', 234),
(4002, 'Cizah', 234),
(4003, 'Fargona', 234),
(4004, 'Horazm', 234),
(4005, 'Kaskadar', 234),
(4006, 'Korakalpogiston', 234),
(4007, 'Namangan', 234),
(4008, 'Navoi', 234),
(4009, 'Samarkand', 234),
(4010, 'Sirdare', 234),
(4011, 'Surhondar', 234),
(4012, 'Toskent', 234),
(4013, 'Malampa', 235),
(4014, 'Penama', 235),
(4015, 'Sanma', 235),
(4016, 'Shefa', 235),
(4017, 'Tafea', 235),
(4018, 'Torba', 235),
(4019, 'Vatican City State (Holy See)', 236),
(4020, 'Amazonas', 237),
(4021, 'Anzoategui', 237),
(4022, 'Apure', 237),
(4023, 'Aragua', 237),
(4024, 'Barinas', 237),
(4025, 'Bolivar', 237),
(4026, 'Carabobo', 237),
(4027, 'Cojedes', 237),
(4028, 'Delta Amacuro', 237),
(4029, 'Distrito Federal', 237),
(4030, 'Falcon', 237),
(4031, 'Guarico', 237),
(4032, 'Lara', 237),
(4033, 'Merida', 237),
(4034, 'Miranda', 237),
(4035, 'Monagas', 237),
(4036, 'Nueva Esparta', 237),
(4037, 'Portuguesa', 237),
(4038, 'Sucre', 237),
(4039, 'Tachira', 237),
(4040, 'Trujillo', 237),
(4041, 'Vargas', 237),
(4042, 'Yaracuy', 237),
(4043, 'Zulia', 237),
(4044, 'Bac Giang', 238),
(4045, 'Binh Dinh', 238),
(4046, 'Binh Duong', 238),
(4047, 'Da Nang', 238),
(4048, 'Dong Bang Song Cuu Long', 238),
(4049, 'Dong Bang Song Hong', 238),
(4050, 'Dong Nai', 238),
(4051, 'Dong Nam Bo', 238),
(4052, 'Duyen Hai Mien Trung', 238),
(4053, 'Hanoi', 238),
(4054, 'Hung Yen', 238),
(4055, 'Khu Bon Cu', 238),
(4056, 'Long An', 238),
(4057, 'Mien Nui Va Trung Du', 238),
(4058, 'Thai Nguyen', 238),
(4059, 'Thanh Pho Ho Chi Minh', 238),
(4060, 'Thu Do Ha Noi', 238),
(4061, 'Tinh Can Tho', 238),
(4062, 'Tinh Da Nang', 238),
(4063, 'Tinh Gia Lai', 238),
(4064, 'Anegada', 239),
(4065, 'Jost van Dyke', 239),
(4066, 'Tortola', 239),
(4067, 'Saint Croix', 240),
(4068, 'Saint John', 240),
(4069, 'Saint Thomas', 240),
(4070, 'Alo', 241),
(4071, 'Singave', 241),
(4072, 'Wallis', 241),
(4073, 'Bu Jaydur', 242),
(4074, 'Wad-adh-Dhahab', 242),
(4075, 'al-\'Ayun', 242),
(4076, 'as-Samarah', 242),
(4077, '\'Adan', 243),
(4078, 'Abyan', 243),
(4079, 'Dhamar', 243),
(4080, 'Hadramaut', 243),
(4081, 'Hajjah', 243),
(4082, 'Hudaydah', 243),
(4083, 'Ibb', 243),
(4084, 'Lahij', 243),
(4085, 'Ma\'rib', 243),
(4086, 'Madinat San\'a', 243),
(4087, 'Sa\'dah', 243),
(4088, 'Sana', 243),
(4089, 'Shabwah', 243),
(4090, 'Ta\'izz', 243),
(4091, 'al-Bayda', 243),
(4092, 'al-Hudaydah', 243),
(4093, 'al-Jawf', 243),
(4094, 'al-Mahrah', 243),
(4095, 'al-Mahwit', 243),
(4096, 'Central Serbia', 244),
(4097, 'Kosovo and Metohija', 244),
(4098, 'Montenegro', 244),
(4099, 'Republic of Serbia', 244),
(4100, 'Serbia', 244),
(4101, 'Vojvodina', 244),
(4102, 'Central', 245),
(4103, 'Copperbelt', 245),
(4104, 'Eastern', 245),
(4105, 'Luapala', 245),
(4106, 'Lusaka', 245),
(4107, 'North-Western', 245),
(4108, 'Northern', 245),
(4109, 'Southern', 245),
(4110, 'Western', 245),
(4111, 'Bulawayo', 246),
(4112, 'Harare', 246),
(4113, 'Manicaland', 246),
(4114, 'Mashonaland Central', 246),
(4115, 'Mashonaland East', 246),
(4116, 'Mashonaland West', 246),
(4117, 'Masvingo', 246),
(4118, 'Matabeleland North', 246),
(4119, 'Matabeleland South', 246),
(4120, 'Midlands', 246);

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment_details`
--

CREATE TABLE `stock_adjustment_details` (
  `id` int(11) NOT NULL,
  `adjustment_id` varchar(20) DEFAULT NULL,
  `product_id` varchar(20) DEFAULT NULL,
  `variant_id` varchar(20) DEFAULT NULL,
  `color_variant` varchar(20) DEFAULT NULL,
  `adjustment_quantity` int(11) DEFAULT NULL,
  `previous_quantity` int(11) DEFAULT NULL,
  `adjustment_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment_table`
--

CREATE TABLE `stock_adjustment_table` (
  `adjustment_id` int(11) NOT NULL,
  `store_id` varchar(20) NOT NULL,
  `date` date DEFAULT NULL,
  `details` text,
  `adjustment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=pending,1=approved,2=cancelled',
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_product`
--

CREATE TABLE `store_product` (
  `store_product_id` varchar(100) NOT NULL,
  `store_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `variant_id` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store_set`
--

CREATE TABLE `store_set` (
  `store_id` varchar(100) NOT NULL,
  `store_name` varchar(100) NOT NULL,
  `store_address` text NOT NULL,
  `default_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_set`
--

INSERT INTO `store_set` (`store_id`, `store_name`, `store_address`, `default_status`) VALUES
('6L9DWE4ZTWZBD7T', 'Oulfa', 'Oulfa', 0),
('B15V5VEWHP7QSWD', 'Oulfa 01', 'Oulfa 01', 0),
('ZAACM94HLFHE74R', 'Ntest', 'fgjfj', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `subscriber_id` varchar(100) NOT NULL,
  `apply_ip` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_information`
--

CREATE TABLE `supplier_information` (
  `supplier_id` varchar(100) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `vat_no` varchar(100) DEFAULT NULL,
  `cr_no` varchar(100) DEFAULT NULL,
  `previous_balance` float DEFAULT NULL,
  `details` text NOT NULL,
  `website` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_information`
--

INSERT INTO `supplier_information` (`supplier_id`, `supplier_name`, `address`, `mobile`, `email`, `vat_no`, `cr_no`, `previous_balance`, `details`, `website`, `status`) VALUES
('2KC5UJS472BA6JKYMCZG', 'Ntest', '563', '5287646353643', 'n@n.gmail.com', '56', '563', 6536, '56', '', 1),
('JULIS4O2ZYISG49EHHH3', 'Salah', 'Casablanca, maroc', '2', 'salah@salah.com', '', '', 0, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_ledger`
--

CREATE TABLE `supplier_ledger` (
  `transaction_id` varchar(100) NOT NULL,
  `purchase_id` varchar(100) DEFAULT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `deposit_no` varchar(50) DEFAULT NULL,
  `amount` float NOT NULL,
  `description` text NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_ledger`
--

INSERT INTO `supplier_ledger` (`transaction_id`, `purchase_id`, `supplier_id`, `invoice_no`, `deposit_no`, `amount`, `description`, `payment_type`, `cheque_no`, `date`, `status`) VALUES
('CWSGCFTK2EXZYXI', '8IBKVRXFISUNE6W', '2KC5UJS472BA6JKYMCZG', 'hukyfuiukyu8', NULL, 0, 'huijlkn', '', '', '08-09-2022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `synchronizer_setting`
--

CREATE TABLE `synchronizer_setting` (
  `id` int(11) NOT NULL,
  `hostname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `port` varchar(10) NOT NULL,
  `debug` varchar(10) NOT NULL,
  `project_root` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `synchronizer_setting`
--

INSERT INTO `synchronizer_setting` (`id`, `hostname`, `username`, `password`, `port`, `debug`, `project_root`) VALUES
(8, '', '', '', '21', 'true', '');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `tax_id` varchar(100) NOT NULL,
  `tax_name` varchar(100) NOT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`tax_id`, `tax_name`, `status`) VALUES
('52C2SKCKGQY6Q9J', 'CGST', 1),
('5SN9PRWPN131T4V', 'IGST', 0),
('H5MQN4NXJBSDX4L', 'SGST', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tax_collection_details`
--

CREATE TABLE `tax_collection_details` (
  `tax_col_de_id` varchar(100) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `tax_id` varchar(100) NOT NULL,
  `variant_id` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tax_collection_summary`
--

CREATE TABLE `tax_collection_summary` (
  `tax_collection_id` varchar(100) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `tax_id` varchar(100) NOT NULL,
  `tax_amount` float NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tax_product_service`
--

CREATE TABLE `tax_product_service` (
  `t_p_s_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `tax_id` varchar(100) NOT NULL,
  `tax_percentage` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax_product_service`
--

INSERT INTO `tax_product_service` (`t_p_s_id`, `product_id`, `tax_id`, `tax_percentage`) VALUES
('22P95F5JWNWQZAG', '31152612', '52C2SKCKGQY6Q9J', '14'),
('OPGYHOARGOK22D6', '58223221', '52C2SKCKGQY6Q9J', '14');

-- --------------------------------------------------------

--
-- Table structure for table `terminal_payment`
--

CREATE TABLE `terminal_payment` (
  `pay_terminal_id` varchar(100) NOT NULL,
  `terminal_name` varchar(100) NOT NULL,
  `terminal_provider_company` varchar(250) NOT NULL,
  `linked_bank_account_no` varchar(100) NOT NULL,
  `customer_care_phone_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(4, 'zaima', 1, '2020-11-15 03:19:29', '2022-07-14 14:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int(11) NOT NULL,
  `transfer_id` varchar(100) NOT NULL,
  `store_id` varchar(100) DEFAULT NULL,
  `voucher_no` varchar(100) DEFAULT NULL,
  `warehouse_id` varchar(100) DEFAULT NULL,
  `product_id` varchar(100) NOT NULL,
  `variant_id` varchar(100) NOT NULL,
  `variant_color` varchar(30) DEFAULT NULL,
  `quantity` float NOT NULL,
  `t_store_id` varchar(100) DEFAULT NULL,
  `t_warehouse_id` varchar(100) DEFAULT NULL,
  `purchase_id` varchar(100) DEFAULT NULL,
  `stock_adjustment_id` varchar(20) DEFAULT NULL,
  `return_detail_id` int(11) DEFAULT NULL,
  `date_time` varchar(100) NOT NULL,
  `transfer_by` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=store to store,2=store to warehouse,3=warehouse to store,4=warehouse to warehouse,5=purchase'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`id`, `transfer_id`, `store_id`, `voucher_no`, `warehouse_id`, `product_id`, `variant_id`, `variant_color`, `quantity`, `t_store_id`, `t_warehouse_id`, `purchase_id`, `stock_adjustment_id`, `return_detail_id`, `date_time`, `transfer_by`, `status`) VALUES
(1, 'B7O5FIQ1815WBTG', 'ZAACM94HLFHE74R', 'StockOP-3288634', NULL, '32429942', 'KH7HNYZAOFVWQQK', NULL, 1, NULL, NULL, NULL, NULL, NULL, '08-09-2022', NULL, 3),
(2, 'BWOFKMEHNYHB2BE', 'ZAACM94HLFHE74R', 'StockOP-3288634', NULL, '', '', NULL, 0, NULL, NULL, NULL, NULL, NULL, '08-09-2022', NULL, 3),
(3, 'N31WVWID7WGDHWX', 'ZAACM94HLFHE74R', 'StockOP-7171129', NULL, '32429942', 'KH7HNYZAOFVWQQK', NULL, 107, NULL, NULL, NULL, NULL, NULL, '08-09-2022', NULL, 3),
(4, 'V9PZHSW4X4F4N78', 'ZAACM94HLFHE74R', NULL, NULL, '69419565', 'KH7HNYZAOFVWQQK', '', 1, NULL, NULL, '8IBKVRXFISUNE6W', NULL, NULL, '08-09-2022', NULL, 3),
(5, 'D3ZEO8FI6LV69AS', 'ZAACM94HLFHE74R', 'StockOP-7934221', NULL, '', 'JYBYUBWL14AYYGR', NULL, 0, NULL, NULL, NULL, NULL, NULL, '10-13-2022', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_details`
--

CREATE TABLE `transfer_details` (
  `id` int(11) NOT NULL,
  `transfer_id` varchar(100) NOT NULL,
  `t_store_id` varchar(100) DEFAULT NULL,
  `store_id` varchar(100) DEFAULT NULL,
  `warehouse_id` varchar(100) DEFAULT NULL,
  `product_id` varchar(100) NOT NULL,
  `variant_id` varchar(100) NOT NULL,
  `variant_color` varchar(30) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `quantity` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transfer_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_request`
--

CREATE TABLE `transfer_request` (
  `row_id` int(11) NOT NULL,
  `transfer_id` varchar(100) NOT NULL,
  `transfer_from` varchar(100) DEFAULT NULL,
  `transfer_to` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transfer_by` varchar(100) DEFAULT NULL,
  `transfer_status` enum('0','1','2','3','4') DEFAULT '0' COMMENT '0=pending,1=approved,2=notapproved,3=collected, 4=cancal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_request_details`
--

CREATE TABLE `transfer_request_details` (
  `transfer_id` varchar(100) NOT NULL,
  `store_id` varchar(100) DEFAULT NULL,
  `warehouse_id` varchar(100) DEFAULT NULL,
  `product_id` varchar(100) NOT NULL,
  `variant_id` varchar(100) NOT NULL,
  `variant_color` varchar(30) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `quantity` float NOT NULL,
  `t_store_id` varchar(100) DEFAULT NULL,
  `t_warehouse_id` varchar(100) DEFAULT NULL,
  `purchase_id` varchar(100) DEFAULT NULL,
  `stock_adjustment_id` varchar(20) DEFAULT NULL,
  `date_time` varchar(100) NOT NULL,
  `transfer_by` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=store to store,2=store to warehouse,3=warehouse to store,4=warehouse to warehouse,5=purchase',
  `transfer_status` enum('0','1','2','3','4') DEFAULT '0' COMMENT '0=pending,1=approved,2=notapproved,3=collected, 4=cancal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` varchar(100) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_short_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`, `unit_short_name`) VALUES
('PQM2NHKOT9XZXF3', 'piece', 'piece');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `about` text,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `password_reset_token` varchar(20) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `ip_address` varchar(14) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `user_type` tinyint(4) NOT NULL COMMENT '1=admin,2=shop-manager,3=sales man,4=store keeper,5=customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(100) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `gender`, `date_of_birth`, `logo`, `status`) VALUES
('1', 'Admin', 'Super', 1, NULL, NULL, 1),
('FZMLB8YKZGF3MQF', 'Kh', 'ahmed', 0, NULL, 'assets/dist/img/profile_picture/31447374cac8a31f4e40781d3dbc415d.png', 1),
('IARUC2E9QO3DNJW', 'test', 'usertest', 0, NULL, 'https://itrplanet.com/Morocco/Marco/assets/website/image/login.png', 1),
('IH1X7PRMWA5KB9F', 'test', 'user', 0, NULL, 'https://itrplanet.com/Morocco/Marco/assets/website/image/login.png', 1),
('R95LOW3A1DGBVDI', 'Ntest', 'Ntest', 0, NULL, 'https://itrplanet.com/Morocco/Marco/assets/website/image/login.png', 1),
('VDUYENT1Q3EVYB5', 'السيد', 'محمد عمر', 0, NULL, 'https://itrplanet.com/Marco/assets/website/image/login.png', 1),
('WNT31FLN1WO62KP', 'Admin', 'Salah', 0, NULL, 'https://itrplanet.com/Morocco/Marco/assets/website/image/login.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_id` varchar(100) NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `user_type` int(11) NOT NULL COMMENT '1=admin,2=shop-manager,3=sales man,4=store keeper,5=customer',
  `security_code` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_id`, `store_id`, `username`, `password`, `token`, `user_type`, `security_code`, `status`) VALUES
('1', '', 'super_admin@yahoo.com', '5b45c4692c447903079308c9c12cb42c', NULL, 1, '1', 1),
('FZMLB8YKZGF3MQF', '', 'ahmed.labtrading@gmail.com', 'f42d294ff9d2e2e41a3042bfac362af9', NULL, 1, '', 1),
('IARUC2E9QO3DNJW', '', 'usertest@gmail.com', '91b114e4bf8c896a803a6d7e16fa779e', NULL, 0, '', 1),
('IH1X7PRMWA5KB9F', '', 'user_test@yahoo.com', '91b114e4bf8c896a803a6d7e16fa779e', NULL, 1, '', 1),
('R95LOW3A1DGBVDI', '', 'Ntest@yahoo.com', '91b114e4bf8c896a803a6d7e16fa779e', NULL, 2, '', 1),
('VDUYENT1Q3EVYB5', '', 'amoudi60@hotmail.com', 'd8029863cf3fa962544b8e15c488aac9', NULL, 1, '', 1),
('WNT31FLN1WO62KP', '', 'shady@yahoo.com', '41aa97fe1de7b60a83a39c0f89592146', NULL, 2, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE `variant` (
  `variant_id` varchar(100) NOT NULL,
  `variant_type` enum('size','color','newtype') NOT NULL DEFAULT 'size',
  `color_code` varchar(30) DEFAULT NULL,
  `variant_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`variant_id`, `variant_type`, `color_code`, `variant_name`, `status`) VALUES
('14H88UQ36U6QQGA', 'size', '#000000', '44-21-142', 1),
('172214O4NXIEXFC', 'size', '#000000', '56-16-145', 1),
('1CAJB9MU44I8X9I', 'size', '#000000', '45-19-133', 1),
('1IBSUHSJ9NCTEHG', 'size', '#000000', '67-18-145', 1),
('1MUU3U9HAMEKK7O', 'size', '#000000', '54-20-140', 1),
('262CUVGQWKHYTCS', 'size', '#000000', '51-18-148', 1),
('2IGPXDEVLIYN5IG', 'size', '#000000', '49-19-145', 1),
('2JTSO7QE1UKM53L', 'size', '#000000', '55-15-142', 1),
('2MFYMXBSEI1NRWR', 'size', '#000000', '62-17-140', 1),
('2PMBD3QGU6XBHSO', 'size', '#000000', '51-22-142', 1),
('2QI692SAQ2FB7T1', 'size', '#000000', '53-17-138', 1),
('2QO51PLMXPYZL6H', 'size', '#000000', '53-15-140', 1),
('2T1JKX1V3927AN6', 'size', '#000000', '48-21-140', 1),
('3FL592L554HHDFE', 'size', '#000000', '54-19-142', 1),
('3J6T4EUPSUARMH2', 'size', '#000000', '48-16-133', 1),
('3VDC9SHF3I3LWEM', 'size', '#000000', '50-21-138', 1),
('3XFGFG45G7V9H6R', 'size', '#000000', '53-18-140', 1),
('4QCJIMDBK73FX87', 'size', '#000000', '56-19-145', 1),
('5B8P8OGQMXOV4JJ', 'size', '#000000', '52-16-142', 1),
('5EMJSKVW5HWVKVV', 'size', '#000000', '55-17-140', 1),
('5ZCKPS6HKUI1UC3', 'size', '#000000', '54-18-142', 1),
('68DYWZNPEMM2QKO', 'size', '#000000', '60-15-147', 1),
('68IMTA2HTFS7F4R', 'size', '#000000', '52-19-142', 1),
('6TE3IT1MKFQCMFC', 'size', '#000000', '52-20-142', 1),
('6Y2VQIGS7ULFM41', 'size', '#000000', '52-17-142', 1),
('71ILJFPHGBDECZ6', 'size', '#000000', '52-18-140', 1),
('7A1B4D7BX3H1E1A', 'size', '#000000', '51-17-145', 1),
('7BUVR657E85OZLK', 'size', '#000000', '54-17-140', 1),
('7FLZ9LR35LS72G2', 'size', '#000000', '56-17-140', 1),
('7KD5QQFH534LGE9', 'size', '#000000', '51-18-135', 1),
('8DC53PZ9CUAMKGI', 'size', '#000000', '52-16-145', 1),
('8HFWBCFC1P5BC35', 'size', '#000000', '54-20-142', 1),
('8IR1H3ZJBRTGVTW', 'size', '#000000', '48-20-139', 1),
('8MHMUW7KXAI5L5N', 'size', '#000000', '52-19-140', 1),
('8UO8FCFTC35BI7O', 'size', '#000000', '56-21-145', 1),
('9EGU2MLETCR1MZO', 'size', '#000000', '44-17-133', 1),
('9EIEMR545U4Y18J', 'size', '#000000', '49-20-142', 1),
('9MOOCENUA78IR8J', 'size', '#000000', '55-17-142', 1),
('9OKNPAS6Y8AA64J', 'size', '#000000', '52-18-142', 1),
('9ZZRXSTYXRGAV59', 'size', '#000000', '59-17-140', 1),
('A5KOAHW1NRZ9NEX', 'size', '#000000', '43-18-130', 1),
('B8YKAESSGA5JUM4', 'size', '#000000', '48-16-130', 1),
('BLVV2OZN8DVUEHF', 'size', '#000000', '53-19-140', 1),
('BMBSCUH9N1JT59U', 'size', '#000000', '53-20-140', 1),
('CNSICJK6ER7J3AE', 'size', '#000000', '52-16-140', 1),
('CO3C3R11SQKQK1E', 'size', '#000000', '43-26-145', 1),
('D18C9O71P6ZNJH8', 'size', '#000000', '55-18-142', 1),
('DK85WYQM81GNSK4', 'size', '#000000', '48-17-133', 1),
('DXA6K7Y88WY5K66', 'size', '#000000', '55-16-138', 1),
('DYGUTF9NC2W1DND', 'size', '#000000', '55-19-142', 1),
('E71A4RY961J76CH', 'size', '#000000', '45-18-133', 1),
('ED39B4R95SG81VD', 'size', '#000000', '60-17-145', 1),
('EDFKGVPIGB9VAR8', 'size', '#000000', '52-17-140', 1),
('EIIW78GRZAGXRM2', 'size', '#000000', '53-19-142', 1),
('F9OHX8U8USFPV6G', 'size', '#000000', '45-15-130', 1),
('FK4ESZQ1YLLSILS', 'size', '#000000', '45-16-130', 1),
('FTAYLBM235MKOOR', 'size', '#000000', '60-16-145', 1),
('FUJK4K9JNM48YNA', 'size', '#000000', '49-19-140', 1),
('FW9X8JWMM1XUA67', 'size', '#000000', '49-18-142', 1),
('G6DZ9U7VA4Y8T3X', 'size', '#000000', '47-16-125', 1),
('GC6IANKCP5DQGFI', 'size', '#000000', '50-19-145', 1),
('GDB3WGFW82AJIK9', 'size', '#000000', '54-17-142', 1),
('GEAFYCEZ52XL672', 'size', '#000000', '50-18-135', 1),
('GSIJYKYSK4TGVRV', 'size', '#000000', '68-18-148', 1),
('GVG2XQ1DUWWWK9H', 'size', '#000000', '53-17-142', 1),
('GWRAHOJCJY3FSFW', 'size', '#000000', '55-17-143', 1),
('GYPM5EVZQO4ZOBA', 'size', '#000000', '55-14-142', 1),
('HI8FGNO6UCC3SAS', 'size', '#000000', '53-16-142', 1),
('IUE8VOKNUBMC8X9', 'size', '#000000', '53-15-145', 1),
('IXIKPV6WI26PG3O', 'size', '#000000', '54-15-140', 1),
('JC5XG9FCWU9A2IS', 'size', '#000000', '42-17-130', 1),
('JYBYUBWL14AYYGR', 'size', '#000000', '47-16-133', 1),
('K4IV6Y1C5EN1M6B', 'size', '#000000', '50-19-140', 1),
('KA4FTIILIN6IQA2', 'size', '#000000', '52-17-135', 1),
('KGQVW81G4CA2ZQO', 'size', '#000000', '53-19-145', 1),
('KH7HNYZAOFVWQQK', 'size', '#000000', '42-15-125', 1),
('KWYG38YQY18QTEQ', 'size', '#000000', '66-18-145', 1),
('L3JMAQMU63XKQZE', 'size', '#000000', '54-16-140', 1),
('LBH8QEKMLQP83SP', 'size', '#000000', '54-14-145', 1),
('LFBGQCEVENFZ7GB', 'size', '#000000', '53-15-142', 1),
('LG9O5XCAES3QIIR', 'size', '#000000', '47-20-140', 1),
('LHZKSCE54AKPQ75', 'size', '#000000', '54-14-140', 1),
('LKWZAIP53SGOCRS', 'size', '#000000', '55-17-145', 1),
('LLRO3NXHIQLBTY8', 'size', '#000000', '62-15-145', 1),
('LYHTWXK2LA6YHLR', 'size', '#000000', '51-17-142', 1),
('M1WG1QFPD2PABHT', 'size', '#000000', '51-20-142', 1),
('MRU6Q6RC9T8VOLI', 'size', '#000000', '50-20-140', 1),
('MWFFG5H3NNCZ47F', 'size', '#000000', '52-18-148', 1),
('MYTL3M9C2VCK2K5', 'size', '#000000', '50-18-140', 1),
('N6FKR1QWNFJ58U1', 'size', '#000000', '51-20-140', 1),
('N9YCOVF3KT9FZGD', 'size', '#000000', '48-14-130', 1),
('NGECVGAIPNMAO6T', 'size', '#000000', '51-18-142', 1),
('NQVZDA2LN4IQYPG', 'size', '#000000', '50-19-142', 1),
('NXS6JJ5R85I6VNJ', 'size', '#000000', '55-21-148', 1),
('O1WIH7U9DUNYOAA', 'size', '#000000', '61-16-142', 1),
('O49FKPAT9HDQE3Z', 'size', '#000000', '46-17-133', 1),
('O67PSLMQFX5UJWW', 'size', '#000000', '54-18-140', 1),
('O8I3FW8S2A4MDQY', 'size', '#000000', '57-17-135', 1),
('ORPP6GMTEMI15O9', 'size', '#000000', '57-17-145', 1),
('OY58RHVXGYZZMMP', 'size', '#000000', '46-17-125', 1),
('P9PSRUEX8N3GFQH', 'size', '#000000', '45-18-130', 1),
('PEGW1KRY6ZF3PQF', 'size', '#000000', '44-17-130', 1),
('Q4K73DP3LH1K8NB', 'size', '#000000', '56-19-142', 1),
('Q581EQLOBN3YD36', 'size', '#000000', 'Ntest', 1),
('QHC2AOW9P87PCAV', 'size', '#000000', '64-20-149', 1),
('QMZOCFQDCWULM7G', 'size', '#000000', '55-19-145', 1),
('R19AW9SU4PO79AC', 'size', '#000000', '54-16-142', 1),
('R5PKW1O3F137BVL', 'size', '#000000', '54-18-138', 1),
('R9UN97L3EOU39C3', 'size', '#000000', '50-20-142', 1),
('RK6PT1CS2I53CP7', 'size', '#000000', '48-21-145', 1),
('RZBZRWTGIGAF834', 'size', '#000000', '54-19-145', 1),
('S1BLG7W7PZ1QIK6', 'size', '#000000', '51-16-142', 1),
('S7JW4TRW8QLJ6LX', 'size', '#000000', '55-16-145', 1),
('SGBUWP4FUHVYFH8', 'size', '#000000', '51-17-135', 1),
('T23VRS3IWP2BOZL', 'size', '#000000', '56-17-141', 1),
('T64XCKLYB7HDOLN', 'size', '#000000', '49-20-140', 1),
('TB65YJWEK95Y4P2', 'size', '#000000', '42-17-123', 1),
('TGRMQSVCNVWBQ5Z', 'size', '#000000', '56-15-146', 1),
('THX6CET9AT1Y3SM', 'size', '#000000', '53-17-140', 1),
('TQ6NP8H25WF9U6E', 'size', '#000000', '51-19-145', 1),
('TRUVWU8TE4WA6D9', 'size', '#000000', '51-16-140', 1),
('U2QU8TW9JL41IXC', 'size', '#000000', '52-18-145', 1),
('UESQRV1ZI2N89AC', 'size', '#000000', '47-16-130', 1),
('UJM6YWFVD7WQRXG', 'size', '#000000', '51-17-140', 1),
('UVNP15CPWP9E3WH', 'size', '#000000', '47-17-133', 1),
('V7P25HFKKTNFVS3', 'size', '#000000', '59-17-137', 1),
('VASJYZ9QF7AYTM2', 'size', '#000000', '55-19-140', 1),
('VD56N643ZV7ZFUR', 'size', '#000000', '56-17-143', 1),
('VMVXKPII8G4NN1B', 'size', '#000000', '46-16-130', 1),
('VNQD18FI9HQU2YD', 'size', '#000000', '52-17-144', 1),
('VW2K44QD3RG77OK', 'size', '#000000', '49-19-142', 1),
('W1NY5JI8Q5C8EDG', 'size', '#000000', '51-18-140', 1),
('W2469T5KFFDJ88J', 'size', '#000000', 'Default', 1),
('W2VJ2BFS13IQBR2', 'size', '#000000', '54-17-145', 1),
('W527FLH2ENLM26R', 'size', '#000000', '60-18-145', 1),
('WGN39DRE2MEILUA', 'size', '#000000', '53-18-142', 1),
('WO7JVB5B9PT888K', 'size', '#000000', '46-18-130', 1),
('WP5PYQRECQ2X86Y', 'size', '#000000', '55-18-145', 1),
('X2ML66HIH95VCIR', 'size', '#000000', '51-21-145', 1),
('X7BJF29TS6T9ZN3', 'size', '#000000', '53-17-143', 1),
('XIWF74VPC4LVQD5', 'size', '#000000', '53-17-145', 1),
('XJY3P1O1CP41PVZ', 'size', '#000000', '52-17-145', 1),
('XLDHG89VE1U4XRU', 'size', '#000000', '51-19-142', 1),
('Y3IJKOQ3VNDJR4A', 'size', '#000000', '51-19-140', 1),
('YC9C11VJZYJ5SD9', 'size', '#000000', '48-19-140', 1),
('YE2QD18I7LZACQV', 'size', '#000000', '55-16-140', 1),
('YP6HFUWW7GWXA2V', 'size', '#000000', '52-18-138', 1),
('ZJG4JY49PVZER4L', 'size', '#000000', '49-20-145', 1),
('ZPUU2EKQC4ED61V', 'size', '#000000', '55-19-135', 1),
('ZS84EU7DHLOD1J7', 'size', '#000000', '46-16-133', 1),
('ZWV6D2FL46A9UXW', 'size', '#000000', '51-18-144', 1),
('ZYQG7IKOOEI57AF', 'size', '#000000', '57-20-145', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wearhouse_set`
--

CREATE TABLE `wearhouse_set` (
  `wearhouse_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `wearhouse_name` varchar(100) NOT NULL,
  `wearhouse_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `website_content`
--

CREATE TABLE `website_content` (
  `web_content_id` int(11) NOT NULL,
  `content_id` varchar(255) NOT NULL,
  `language_id` varchar(255) NOT NULL,
  `content_headline` text NOT NULL,
  `content_image` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `web_footer`
--

CREATE TABLE `web_footer` (
  `footer_section_id` varchar(100) NOT NULL,
  `headlines` text NOT NULL,
  `details` text NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_footer`
--

INSERT INTO `web_footer` (`footer_section_id`, `headlines`, `details`, `position`, `status`) VALUES
('4UXP4OHYVGUBDSQ', 'First Block', '<h4 class=\"link-title fs-16 mb-3 font-weight-600 position-relative footer-app-link\">Our Communities</h4>\r\n<ul class=\"list-unstyled social-icon\">\r\n\r\n<li><a href=\"#\"><div class=\"icon-wrap fs-19 d-inline-block bg-primary text-white text-center inst\"><i class=\"fab fa-facebook\"></i></div></a><a href=\"https://www.facebook.com/gamelevensaudi\">Facebook</a></li>\r\n\r\n<li><a href=\"#\"><div class=\"icon-wrap fs-19 d-inline-block bg-primary text-white text-center inst\"><i class=\"fab fa-instagram\"></i></div></a><a href=\"https://instagram.com/gameleven.sa?utm_medium=copy_link\">Instagram</a></li>\r\n\r\n<li><a href=\"#\"><div class=\"icon-wrap fs-19 d-inline-block bg-primary text-white text-center lin\"><i class=\"fab fa-linkedin\"></i></div></a><a href=\"https://sa.linkedin.com/company/gameleven?trk=public_profile_topcard-current-company\">Linkedin</a></li>\r\n\r\n<li><a href=\"#\"><div class=\"icon-wrap fs-19 d-inline-block bg-primary text-white text-center yt\"><i class=\"fab fa-youtube-square\"></i></div></a><a href=\"https://www.youtube.com/channel/UCJL-nYRfES-wV2r8pyrbysA\">Youtube</a></li>\r\n                            \r\n</ul>', 1, 1),
('R65OGYDCBUWYYI3', 'Second Block', '<h4 class=\"link-title fs-16 mb-3 font-weight-600 position-relative footer-app-link\">Information</h4>\r\n                        <ul class=\"footer-link list-unstyled menu mb-0\">\r\n                            <li class=\"mb-2\"><a href=\"about_us\" class=\"link d-block\">About Us</a></li>\r\n                            <li class=\"mb-2\"><a href=\"contact_us\" class=\"link d-block\">Contact us</a></li>\r\n                            <li class=\"mb-2\"><a href=\"delivery_info\" class=\"link d-block\">Delivery Information</a></li>\r\n                            <li class=\"mb-2\"><a href=\"http://privacy_policy\" class=\"link d-block\">Privacy Policy</a></li>\r\n                            <li class=\"mb-2\"><a href=\"terms_condition\" class=\"link d-block\">Terms & Conditions</a></li>\r\n                            <li class=\"mb-2\"><a href=\"#\" class=\"link d-block\">Track My Order</a></li>\r\n                        </ul>', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_setting`
--

CREATE TABLE `web_setting` (
  `setting_id` int(11) NOT NULL,
  `logo` text,
  `invoice_logo` text,
  `favicon` text,
  `footer_logo` text,
  `footer_text` text,
  `footer_details` text,
  `google_analytics` text,
  `facebook_messenger` text,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `application_protocol` varchar(30) NOT NULL DEFAULT 'http',
  `app_link_status` tinyint(4) NOT NULL,
  `pay_with_status` tinyint(4) NOT NULL COMMENT '1=active , 0=inactive',
  `map_api_key` text,
  `map_latitude` text,
  `map_langitude` text,
  `apps_url` varchar(255) DEFAULT NULL,
  `mob_footer_block` varchar(100) DEFAULT NULL,
  `social_share` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_setting`
--

INSERT INTO `web_setting` (`setting_id`, `logo`, `invoice_logo`, `favicon`, `footer_logo`, `footer_text`, `footer_details`, `google_analytics`, `facebook_messenger`, `meta_keyword`, `meta_description`, `application_protocol`, `app_link_status`, `pay_with_status`, `map_api_key`, `map_latitude`, `map_langitude`, `apps_url`, `mob_footer_block`, `social_share`) VALUES
(1, 'my-assets/image/logo/a918ade3f12a1f8acee82a3f321ce4f7.png', NULL, 'my-assets/image/logo/ce1697c92622e92f91e2b341eb89419c.png', 'my-assets/image/logo/9332f8251572b9ea062cda25ac317a06.png', 'Developed by <a href=\"#/\" target=\"_blank\">212</a>', '(212) E-Commerce system.', '', '', 'meta keyword, aaa, bbb, ccc', 'multistore ecommerce software bb, bbb, ccc, ddd', '', 1, 1, 'AIzaSyBGwh3ShY_W1hMms1wmwlHK3hpInhExn3o', '8.901922', '66.325790', '', '[\"1\",\"0\",\"0\",\"1\"]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_info_table`
--

CREATE TABLE `whatsapp_info_table` (
  `id` int(11) NOT NULL,
  `whatsapp_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `acc_card_payments`
--
ALTER TABLE `acc_card_payments`
  ADD PRIMARY KEY (`cardpayment_id`);

--
-- Indexes for table `acc_coa`
--
ALTER TABLE `acc_coa`
  ADD PRIMARY KEY (`HeadCode`),
  ADD KEY `HeadName` (`HeadName`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `acc_fiscal_year`
--
ALTER TABLE `acc_fiscal_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_opening_balances`
--
ALTER TABLE `acc_opening_balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_transaction`
--
ALTER TABLE `acc_transaction`
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `COAID` (`COAID`);

--
-- Indexes for table `assembly_products`
--
ALTER TABLE `assembly_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assembly_products_translation`
--
ALTER TABLE `assembly_products_translation`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`att_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `bank_list`
--
ALTER TABLE `bank_list`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`block_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `brand_translation`
--
ALTER TABLE `brand_translation`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `captcha_print_setting`
--
ALTER TABLE `captcha_print_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_translation`
--
ALTER TABLE `category_translation`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `category_variant`
--
ALTER TABLE `category_variant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_out`
--
ALTER TABLE `check_out`
  ADD PRIMARY KEY (`check_out_id`);

--
-- Indexes for table `cheque_manger`
--
ALTER TABLE `cheque_manger`
  ADD PRIMARY KEY (`cheque_id`);

--
-- Indexes for table `color_backends`
--
ALTER TABLE `color_backends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color_frontends`
--
ALTER TABLE `color_frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_information`
--
ALTER TABLE `company_information`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `coupon_invoice`
--
ALTER TABLE `coupon_invoice`
  ADD PRIMARY KEY (`coupon_invoice_id`);

--
-- Indexes for table `crypto_payments`
--
ALTER TABLE `crypto_payments`
  ADD PRIMARY KEY (`paymentID`),
  ADD UNIQUE KEY `key3` (`boxID`,`orderID`,`userID`,`txID`,`amount`,`addr`),
  ADD KEY `boxID` (`boxID`),
  ADD KEY `boxType` (`boxType`),
  ADD KEY `userID` (`userID`),
  ADD KEY `countryID` (`countryID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `amount` (`amount`),
  ADD KEY `amountUSD` (`amountUSD`),
  ADD KEY `coinLabel` (`coinLabel`),
  ADD KEY `unrecognised` (`unrecognised`),
  ADD KEY `addr` (`addr`),
  ADD KEY `txID` (`txID`),
  ADD KEY `txDate` (`txDate`),
  ADD KEY `txConfirmed` (`txConfirmed`),
  ADD KEY `txCheckDate` (`txCheckDate`),
  ADD KEY `processed` (`processed`),
  ADD KEY `processedDate` (`processedDate`),
  ADD KEY `recordCreated` (`recordCreated`),
  ADD KEY `key1` (`boxID`,`orderID`),
  ADD KEY `key2` (`boxID`,`orderID`,`userID`);

--
-- Indexes for table `currency_info`
--
ALTER TABLE `currency_info`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `customer_activities`
--
ALTER TABLE `customer_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_information`
--
ALTER TABLE `customer_information`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_ledger`
--
ALTER TABLE `customer_ledger`
  ADD KEY `receipt_no` (`receipt_no`),
  ADD KEY `receipt_no_2` (`receipt_no`),
  ADD KEY `receipt_no_3` (`receipt_no`),
  ADD KEY `receipt_no_4` (`receipt_no`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`customer_order_id`);

--
-- Indexes for table `daily_closing`
--
ALTER TABLE `daily_closing`
  ADD PRIMARY KEY (`date`);

--
-- Indexes for table `delivery_assign`
--
ALTER TABLE `delivery_assign`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_time_slot`
--
ALTER TABLE `delivery_time_slot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_zone`
--
ALTER TABLE `delivery_zone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_configuration`
--
ALTER TABLE `email_configuration`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `employee_history`
--
ALTER TABLE `employee_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_salary_payment`
--
ALTER TABLE `employee_salary_payment`
  ADD PRIMARY KEY (`emp_sal_pay_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `generate_id` (`generate_id`);

--
-- Indexes for table `employee_salary_setup`
--
ALTER TABLE `employee_salary_setup`
  ADD PRIMARY KEY (`e_s_s_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_item`
--
ALTER TABLE `expense_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filter_items`
--
ALTER TABLE `filter_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `filter_product`
--
ALTER TABLE `filter_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filter_types`
--
ALTER TABLE `filter_types`
  ADD PRIMARY KEY (`fil_type_id`);

--
-- Indexes for table `image_gallery`
--
ALTER TABLE `image_gallery`
  ADD PRIMARY KEY (`image_gallery_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`invoice_details_id`);

--
-- Indexes for table `invoice_installment`
--
ALTER TABLE `invoice_installment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_stock_tbl`
--
ALTER TABLE `invoice_stock_tbl`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `invoice_text_table`
--
ALTER TABLE `invoice_text_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language_backup`
--
ALTER TABLE `language_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language_config`
--
ALTER TABLE `language_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link_page`
--
ALTER TABLE `link_page`
  ADD PRIMARY KEY (`link_page_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_permission`
--
ALTER TABLE `module_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_module_id` (`fk_module_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`);

--
-- Indexes for table `order_tax_col_details`
--
ALTER TABLE `order_tax_col_details`
  ADD PRIMARY KEY (`order_tax_col_de_id`);

--
-- Indexes for table `order_tax_col_summary`
--
ALTER TABLE `order_tax_col_summary`
  ADD PRIMARY KEY (`order_tax_col_id`);

--
-- Indexes for table `our_location`
--
ALTER TABLE `our_location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `pad_print_setting`
--
ALTER TABLE `pad_print_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payeer_payments`
--
ALTER TABLE `payeer_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateway`
--
ALTER TABLE `payment_gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_withs`
--
ALTER TABLE `pay_withs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_loan`
--
ALTER TABLE `personal_loan`
  ADD PRIMARY KEY (`per_loan_id`);

--
-- Indexes for table `person_information`
--
ALTER TABLE `person_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person_ledger`
--
ALTER TABLE `person_ledger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `pesonal_loan_information`
--
ALTER TABLE `pesonal_loan_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `pricing_types`
--
ALTER TABLE `pricing_types`
  ADD PRIMARY KEY (`pri_type_id`);

--
-- Indexes for table `pricing_types_product`
--
ALTER TABLE `pricing_types_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product_information`
--
ALTER TABLE `product_information`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `product_purchase`
--
ALTER TABLE `product_purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `product_purchase_details`
--
ALTER TABLE `product_purchase_details`
  ADD PRIMARY KEY (`purchase_detail_id`);

--
-- Indexes for table `product_purchase_return`
--
ALTER TABLE `product_purchase_return`
  ADD PRIMARY KEY (`purchase_return_id`);

--
-- Indexes for table `product_purchase_return_details`
--
ALTER TABLE `product_purchase_return_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`product_review_id`);

--
-- Indexes for table `product_translation`
--
ALTER TABLE `product_translation`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `proof_of_purchase_expese`
--
ALTER TABLE `proof_of_purchase_expese`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`pur_order_id`);

--
-- Indexes for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  ADD PRIMARY KEY (`pur_order_detail_id`);

--
-- Indexes for table `purchase_order_receive`
--
ALTER TABLE `purchase_order_receive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_stock_tbl`
--
ALTER TABLE `purchase_stock_tbl`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`quotation_id`);

--
-- Indexes for table `quotation_details`
--
ALTER TABLE `quotation_details`
  ADD PRIMARY KEY (`quotation_details_id`);

--
-- Indexes for table `quotation_installment`
--
ALTER TABLE `quotation_installment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_tax_col_details`
--
ALTER TABLE `quotation_tax_col_details`
  ADD PRIMARY KEY (`quot_tax_col_de_id`);

--
-- Indexes for table `quotation_tax_col_summary`
--
ALTER TABLE `quotation_tax_col_summary`
  ADD PRIMARY KEY (`quot_tax_col_id`);

--
-- Indexes for table `salary_sheet_generate`
--
ALTER TABLE `salary_sheet_generate`
  ADD PRIMARY KEY (`ssg_id`);

--
-- Indexes for table `salary_type`
--
ALTER TABLE `salary_type`
  ADD PRIMARY KEY (`salary_type_id`);

--
-- Indexes for table `search_history`
--
ALTER TABLE `search_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sec_menu_item`
--
ALTER TABLE `sec_menu_item`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `sec_role_permission`
--
ALTER TABLE `sec_role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sec_role_tbl`
--
ALTER TABLE `sec_role_tbl`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sec_user_access_tbl`
--
ALTER TABLE `sec_user_access_tbl`
  ADD PRIMARY KEY (`role_acc_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_info`
--
ALTER TABLE `shipping_info`
  ADD PRIMARY KEY (`shiping_info_id`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`method_id`);

--
-- Indexes for table `site_analytics`
--
ALTER TABLE `site_analytics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `sms_configuration`
--
ALTER TABLE `sms_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_template`
--
ALTER TABLE `sms_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_auth`
--
ALTER TABLE `social_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soft_setting`
--
ALTER TABLE `soft_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `splash_images`
--
ALTER TABLE `splash_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_adjustment_details`
--
ALTER TABLE `stock_adjustment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_adjustment_table`
--
ALTER TABLE `stock_adjustment_table`
  ADD PRIMARY KEY (`adjustment_id`);

--
-- Indexes for table `store_product`
--
ALTER TABLE `store_product`
  ADD PRIMARY KEY (`store_product_id`);

--
-- Indexes for table `store_set`
--
ALTER TABLE `store_set`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`subscriber_id`);

--
-- Indexes for table `supplier_information`
--
ALTER TABLE `supplier_information`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `supplier_ledger`
--
ALTER TABLE `supplier_ledger`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `receipt_no` (`deposit_no`),
  ADD KEY `receipt_no_2` (`deposit_no`),
  ADD KEY `receipt_no_3` (`deposit_no`),
  ADD KEY `receipt_no_4` (`deposit_no`);

--
-- Indexes for table `synchronizer_setting`
--
ALTER TABLE `synchronizer_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `tax_collection_details`
--
ALTER TABLE `tax_collection_details`
  ADD PRIMARY KEY (`tax_col_de_id`);

--
-- Indexes for table `tax_collection_summary`
--
ALTER TABLE `tax_collection_summary`
  ADD PRIMARY KEY (`tax_collection_id`);

--
-- Indexes for table `tax_product_service`
--
ALTER TABLE `tax_product_service`
  ADD PRIMARY KEY (`t_p_s_id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_details`
--
ALTER TABLE `transfer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_request`
--
ALTER TABLE `transfer_request`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`variant_id`);

--
-- Indexes for table `wearhouse_set`
--
ALTER TABLE `wearhouse_set`
  ADD PRIMARY KEY (`wearhouse_id`);

--
-- Indexes for table `website_content`
--
ALTER TABLE `website_content`
  ADD PRIMARY KEY (`web_content_id`);

--
-- Indexes for table `web_footer`
--
ALTER TABLE `web_footer`
  ADD PRIMARY KEY (`footer_section_id`);

--
-- Indexes for table `web_setting`
--
ALTER TABLE `web_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `whatsapp_info_table`
--
ALTER TABLE `whatsapp_info_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `acc_fiscal_year`
--
ALTER TABLE `acc_fiscal_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `acc_opening_balances`
--
ALTER TABLE `acc_opening_balances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `acc_transaction`
--
ALTER TABLE `acc_transaction`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `assembly_products`
--
ALTER TABLE `assembly_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assembly_products_translation`
--
ALTER TABLE `assembly_products_translation`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_translation`
--
ALTER TABLE `brand_translation`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `captcha_print_setting`
--
ALTER TABLE `captcha_print_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category_translation`
--
ALTER TABLE `category_translation`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category_variant`
--
ALTER TABLE `category_variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=944;

--
-- AUTO_INCREMENT for table `color_backends`
--
ALTER TABLE `color_backends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `color_frontends`
--
ALTER TABLE `color_frontends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `crypto_payments`
--
ALTER TABLE `crypto_payments`
  MODIFY `paymentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_activities`
--
ALTER TABLE `customer_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_assign`
--
ALTER TABLE `delivery_assign`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_time_slot`
--
ALTER TABLE `delivery_time_slot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_zone`
--
ALTER TABLE `delivery_zone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_history`
--
ALTER TABLE `employee_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_salary_payment`
--
ALTER TABLE `employee_salary_payment`
  MODIFY `emp_sal_pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_salary_setup`
--
ALTER TABLE `employee_salary_setup`
  MODIFY `e_s_s_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_item`
--
ALTER TABLE `expense_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `filter_items`
--
ALTER TABLE `filter_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `filter_product`
--
ALTER TABLE `filter_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `filter_types`
--
ALTER TABLE `filter_types`
  MODIFY `fil_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_installment`
--
ALTER TABLE `invoice_installment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_stock_tbl`
--
ALTER TABLE `invoice_stock_tbl`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice_text_table`
--
ALTER TABLE `invoice_text_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4282;

--
-- AUTO_INCREMENT for table `language_backup`
--
ALTER TABLE `language_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2184;

--
-- AUTO_INCREMENT for table `language_config`
--
ALTER TABLE `language_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `module_permission`
--
ALTER TABLE `module_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `our_location`
--
ALTER TABLE `our_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pad_print_setting`
--
ALTER TABLE `pad_print_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payeer_payments`
--
ALTER TABLE `payeer_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_gateway`
--
ALTER TABLE `payment_gateway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pay_withs`
--
ALTER TABLE `pay_withs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_loan`
--
ALTER TABLE `personal_loan`
  MODIFY `per_loan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `person_information`
--
ALTER TABLE `person_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `person_ledger`
--
ALTER TABLE `person_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesonal_loan_information`
--
ALTER TABLE `pesonal_loan_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricing_types`
--
ALTER TABLE `pricing_types`
  MODIFY `pri_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pricing_types_product`
--
ALTER TABLE `pricing_types_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_information`
--
ALTER TABLE `product_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_purchase_return`
--
ALTER TABLE `product_purchase_return`
  MODIFY `purchase_return_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_purchase_return_details`
--
ALTER TABLE `product_purchase_return_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_translation`
--
ALTER TABLE `product_translation`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `proof_of_purchase_expese`
--
ALTER TABLE `proof_of_purchase_expese`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `pur_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_order_receive`
--
ALTER TABLE `purchase_order_receive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_stock_tbl`
--
ALTER TABLE `purchase_stock_tbl`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quotation_installment`
--
ALTER TABLE `quotation_installment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_sheet_generate`
--
ALTER TABLE `salary_sheet_generate`
  MODIFY `ssg_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_type`
--
ALTER TABLE `salary_type`
  MODIFY `salary_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `search_history`
--
ALTER TABLE `search_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sec_menu_item`
--
ALTER TABLE `sec_menu_item`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `sec_role_permission`
--
ALTER TABLE `sec_role_permission`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1873;

--
-- AUTO_INCREMENT for table `sec_role_tbl`
--
ALTER TABLE `sec_role_tbl`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sec_user_access_tbl`
--
ALTER TABLE `sec_user_access_tbl`
  MODIFY `role_acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_info`
--
ALTER TABLE `shipping_info`
  MODIFY `shiping_info_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site_analytics`
--
ALTER TABLE `site_analytics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sms_configuration`
--
ALTER TABLE `sms_configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sms_template`
--
ALTER TABLE `sms_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `social_auth`
--
ALTER TABLE `social_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `soft_setting`
--
ALTER TABLE `soft_setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `splash_images`
--
ALTER TABLE `splash_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4121;

--
-- AUTO_INCREMENT for table `stock_adjustment_details`
--
ALTER TABLE `stock_adjustment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_adjustment_table`
--
ALTER TABLE `stock_adjustment_table`
  MODIFY `adjustment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `synchronizer_setting`
--
ALTER TABLE `synchronizer_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transfer_details`
--
ALTER TABLE `transfer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer_request`
--
ALTER TABLE `transfer_request`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `website_content`
--
ALTER TABLE `website_content`
  MODIFY `web_content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_setting`
--
ALTER TABLE `web_setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `whatsapp_info_table`
--
ALTER TABLE `whatsapp_info_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
