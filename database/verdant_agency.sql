-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 20, 2022 at 03:38 PM
-- Server version: 8.0.27
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verdant_agency`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

DROP TABLE IF EXISTS `access`;
CREATE TABLE IF NOT EXISTS `access` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_type` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `permitted_access` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `user_type`, `permitted_access`, `created_at`, `updated_at`) VALUES
(1, 'agent', 'dashboard,agents,terminals,tansactions,profile,transactions,performance,profile,wallet-withdraw,wallet-history', '2022-01-18 20:46:21', '2022-01-18 21:51:58'),
(2, 'sub_agent', 'dashboard,buy-airtime,buy-data,pay-bills, tansactions,profile,customers,debit-card,terminals,wallet-transfer,wallet-withdraw,wallet-history', '2022-01-18 20:46:21', '2022-01-18 21:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

DROP TABLE IF EXISTS `bank_accounts`;
CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `account_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `account_number` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bank_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bvn` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `user_id`, `account_name`, `account_number`, `bank_name`, `bank_code`, `bvn`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Samuel Odejinmi', '3076302098', '9', 'Odejinmi', '22454670613', 1, '2021-12-04 06:14:44', '2021-12-04 06:14:44'),
(2, 2, 'Samuel Odejinmi', '3076302098', '9', 'Samuel', '22454670613', 1, '2021-12-04 06:33:05', '2021-12-04 06:33:05'),
(3, 1, 'Samuel Odejinmi', '3076302098', '9', 'Odejinmi', '22454670613', 1, '2021-12-04 21:20:01', '2021-12-04 21:20:01'),
(4, 1, 'Samuel Odejinmi', '3076302098', '9', 'Odejinmi', '22454670613', 1, '2021-12-05 13:29:42', '2021-12-05 13:29:42'),
(5, 4, 'Bola Salimonu', '002316767', ' ', '044', '22166406790', 1, '2021-12-06 20:40:51', '2021-12-06 20:40:51'),
(6, 20, 'khaytechdigitalz', '123232353534', '2', '', '5656565656', 1, '2022-02-22 16:58:19', '2022-02-22 16:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `bills_airtime_providers`
--

DROP TABLE IF EXISTS `bills_airtime_providers`;
CREATE TABLE IF NOT EXISTS `bills_airtime_providers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `provider` varchar(191) NOT NULL,
  `providerLogoUrl` text NOT NULL,
  `minAmount` varchar(191) NOT NULL,
  `maxAmount` varchar(191) NOT NULL,
  `c_cent` varchar(191) NOT NULL DEFAULT '0',
  `api_cent` varchar(191) NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` varchar(191) NOT NULL,
  `updated_at` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bills_airtime_providers`
--

INSERT INTO `bills_airtime_providers` (`id`, `provider`, `providerLogoUrl`, `minAmount`, `maxAmount`, `c_cent`, `api_cent`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AIRTEL', 'assets/images/bills/Airtel-Airtime.jpg', '5', '', '2', '2.5', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(2, 'MTN', 'assets/images/bills/MTN-Airtime.jpg', '5', '', '1.5', '2', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(3, 'GLO', 'assets/images/bills/GLO-Airtime.jpg', '5', '', '2', '2.5', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(4, '9MOBILE', 'assets/images/bills/9mobile-Airtime.jpg', '5', '', '2', '2.5', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `bills_cabletvplans`
--

DROP TABLE IF EXISTS `bills_cabletvplans`;
CREATE TABLE IF NOT EXISTS `bills_cabletvplans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tvp_id` int NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bills_cabletvplans`
--

INSERT INTO `bills_cabletvplans` (`id`, `tvp_id`, `type`, `name`, `code`, `amount`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'dstv', 'DStv Padi N1,850', 'dstv-padi', '1850', '1850', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(2, 1, 'dstv', 'DStv Yanga N2,565', 'dstv-yanga', '2565', '2565', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(3, 1, 'dstv', 'Dstv Confam N4,615', 'dstv-confam', '4615', '4615', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(4, 1, 'dstv', 'DStv  Compact N7900', 'dstv79', '7900', '7900', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(5, 1, 'dstv', 'DStv Premium N18,400', 'dstv3', '18400', '18400', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(6, 1, 'dstv', 'DStv Asia N6,200', 'dstv6', '6200', '6200', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(7, 1, 'dstv', 'DStv Compact Plus N12,400', 'dstv7', '12400', '12400', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(8, 1, 'dstv', 'DStv Premium-French N25,550', 'dstv9', '25550', '25550', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(9, 1, 'dstv', 'DStv Premium-Asia N20,500', 'dstv10', '20500', '20500', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(10, 1, 'dstv', 'DStv Confam + ExtraView N7,115', 'confam-extra', '7115', '7115', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(11, 1, 'dstv', 'DStv Yanga + ExtraView N5,065', 'yanga-extra', '5065', '5065', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(12, 1, 'dstv', 'DStv Padi + ExtraView N4,350', 'padi-extra', '4350', '4350', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(13, 1, 'dstv', 'DStv Compact + Asia N14,100', 'com-asia', '14100', '14100', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(14, 1, 'dstv', 'DStv Compact + Extra View N10,400', 'dstv30', '10400', '10400', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(15, 1, 'dstv', 'DStv Compact + French Touch N10,200', 'com-frenchtouch', '10200', '10200', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(16, 1, 'dstv', 'DStv Premium - Extra View N20,900', 'dstv33', '20900', '20900', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(17, 1, 'dstv', 'DStv Compact Plus - Asia N18,600', 'dstv40', '18600', '18600', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(18, 1, 'dstv', 'DStv Compact + French Touch + ExtraView N12,700', 'com-frenchtouch-extra', '12700', '12700', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(19, 1, 'dstv', 'DStv Compact + Asia + ExtraView N16,600', 'com-asia-extra', '16600', '16600', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(20, 1, 'dstv', 'DStv Compact Plus + French Plus N20,500', 'dstv43', '20500', '20500', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(21, 1, 'dstv', 'DStv Compact Plus + French Touch N14,700', 'complus-frenchtouch', '14700', '14700', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(22, 1, 'dstv', 'DStv Compact Plus - Extra View N14,900', 'dstv45', '14900', '14900', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(23, 1, 'dstv', 'DStv Compact Plus + FrenchPlus + Extra View N23,000', 'complus-french-extraview', '23000', '23000', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(24, 1, 'dstv', 'DStv Compact + French Plus N16,000', 'dstv47', '16000', '16000', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(25, 1, 'dstv', 'DStv Compact Plus + Asia + ExtraView N21,100', 'dstv48', '21100', '21100', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(26, 1, 'dstv', 'DStv Premium + Asia + Extra View N23,000', 'dstv61', '23000', '23000', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(27, 1, 'dstv', 'DStv Premium + French + Extra View N28,000', 'dstv62', '28050', '28050', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(28, 1, 'dstv', 'DStv HDPVR Access Service N2,500', 'hdpvr-access-service', '2500', '2500', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(29, 1, 'dstv', 'DStv French Plus Add-on N8,100', 'frenchplus-addon', '8100', '8100', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(30, 1, 'dstv', 'DStv Asian Add-on N6,200', 'asia-addon', '6200', '6200', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(31, 1, 'dstv', 'DStv French Touch Add-on N2,300', 'frenchtouch-addon', '2300', '2300', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(32, 1, 'dstv', 'ExtraView Access N2,500', 'extraview-access', '2500', '2500', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(33, 1, 'dstv', 'DStv French 11 N3,260', 'french11', '3260', '3260', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:14'),
(34, 2, 'gotv', 'GOtv Max N3,600', 'gotv-max', '3600', '3600', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:50'),
(35, 2, 'gotv', 'GOtv Jolli N2,460', 'gotv-jolli', '2460', '2460', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:50'),
(36, 2, 'gotv', 'GOtv Jinja N1,640', 'gotv-jinja', '1640', '1640', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:50'),
(37, 2, 'gotv', 'GOtv Smallie - monthly N800', 'gotv-smallie', '800', '800', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:50'),
(38, 2, 'gotv', 'GOtv Smallie - quarterly N2,100', 'gotv-smallie-3months', '2100', '2100', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:50'),
(39, 2, 'gotv', 'GOtv Smallie - yearly N6,200', 'gotv-smallie-1year', '6200', '6200', 1, '0000-00-00 00:00:00', '2021-10-31 00:01:50'),
(40, 3, 'startimes', 'Nova - 900 Naira - 1 Month', 'nova', '900', '900', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(41, 3, 'startimes', 'Basic (Antenna) - 1,700 Naira - 1 Month', 'basic', '1700', '1700', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(42, 3, 'startimes', 'Smart (Dish) - 2,200 Naira - 1 Month', 'smart', '2200', '2200', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(43, 3, 'startimes', 'Classic (Antenna) - 2,500 Naira - 1 Month', 'classic', '2500', '2500', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(44, 3, 'startimes', 'Super (Dish) - 4,200 Naira - 1 Month', 'super', '4200', '4200', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(45, 3, 'startimes', 'Nova - 300 Naira - 1 Week', 'nova-weekly', '300', '300', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(46, 3, 'startimes', 'Basic (Antenna) - 600 Naira - 1 Week', 'basic-weekly', '600', '600', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(47, 3, 'startimes', 'Smart (Dish) - 700 Naira - 1 Week', 'smart-weekly', '700', '700', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(48, 3, 'startimes', 'Classic (Antenna) - 1200 Naira - 1 Week ', 'classic-weekly', '1200', '1200', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(49, 3, 'startimes', 'Super (Dish) - 1,500 Naira - 1 Week', 'super-weekly', '1500', '1500', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(50, 3, 'startimes', 'Nova - 90 Naira - 1 Day', 'nova-daily', '90', '90', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(51, 3, 'startimes', 'Basic (Antenna) - 160 Naira - 1 Day', 'basic-daily', '160', '160', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(52, 3, 'startimes', 'Smart (Dish) - 200 Naira - 1 Day', 'smart-daily', '200', '200', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(53, 3, 'startimes', 'Classic (Antenna) - 320 Naira - 1 Day ', 'classic-daily', '320', '320', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(54, 3, 'startimes', 'Super (Dish) - 400 Naira - 1 Day', 'super-daily', '400', '400', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(55, 3, 'startimes', 'ewallet Amount', 'ewallet', '0', '0', 1, '0000-00-00 00:00:00', '2021-10-31 00:02:10'),
(56, 2, 'gotv', 'GOtv Supa - monthly N5,500', 'gotv-supa', '5500.00', '5500.00', 1, '2021-11-10 03:23:24', '2021-11-26 03:30:00'),
(59, 4, 'showmax', 'Full - N2,900', 'full', '2900.00', '2900.00', 1, '2021-11-26 03:34:06', '2021-11-26 03:34:06'),
(60, 4, 'showmax', 'Mobile Only - N1,450', 'mobile_only', '1450.00', '1450.00', 1, '2021-11-26 03:35:12', '2021-11-26 03:35:12'),
(61, 4, 'showmax', 'Sports Full - N6,300', 'sports_full', '6300.00', '6300.00', 1, '2021-11-26 03:36:11', '2021-11-26 03:36:11'),
(62, 4, 'showmax', 'Sports Mobile Only - N3,200', 'sports_mobile_only', '3200.00', '3200.00', 1, '2021-11-26 03:37:44', '2021-11-26 03:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `bills_electricity_providers`
--

DROP TABLE IF EXISTS `bills_electricity_providers`;
CREATE TABLE IF NOT EXISTS `bills_electricity_providers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `provider` varchar(191) NOT NULL,
  `code` varchar(30) NOT NULL,
  `providerLogoUrl` text NOT NULL,
  `minAmount` varchar(191) NOT NULL,
  `c_cent` varchar(191) NOT NULL DEFAULT '0',
  `api_cent` varchar(191) NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` varchar(191) NOT NULL,
  `updated_at` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bills_electricity_providers`
--

INSERT INTO `bills_electricity_providers` (`id`, `provider`, `code`, `providerLogoUrl`, `minAmount`, `c_cent`, `api_cent`, `status`, `created_at`, `updated_at`) VALUES
(1, 'IKEDC', 'ikeja-electric', 'assets/images/bills/Ikeja-Electric-Payment-PHCN.jpg', '500', '0.5', '1', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(2, 'EKEDC', 'eko-electric', 'assets/images/bills/Eko-Electric-Payment-PHCN.jpg', '500', '0.3', '0.5', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(3, 'KEDCO', 'kano-electric', 'assets/images/bills/Kano-Electric.jpg', '500', '0.3', '0.5', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(4, 'PHED', 'portharcourt-electric', 'assets/images/bills/Port-Harcourt-Electric.jpg', '500', '0.5', '1', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(5, 'JED', 'jos-electric', 'assets/images/bills/Jos-Electric-JED.jpg', '500', '0.3', '0.5', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(6, 'IBEDC', 'ibadan-electric', 'assets/images/bills/IBEDC-Ibadan-Electricity-Distribution-Company.jpg', '500', '0.3', '0.5', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(7, 'KAEDCO', 'kaduna-electric', 'assets/images/bills/Kaduna-Electric-KAEDCO.jpg', '500', '0.5', '1', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(8, 'AEDC', 'abuja-electric', 'assets/images/bills/Abuja-Electric.jpg', '500', '0.3', '0.5', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `bills_history`
--

DROP TABLE IF EXISTS `bills_history`;
CREATE TABLE IF NOT EXISTS `bills_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `business_id` int NOT NULL,
  `user_id` int NOT NULL,
  `service_type` varchar(191) NOT NULL,
  `provider` varchar(191) NOT NULL,
  `recipient` varchar(191) NOT NULL,
  `amount` varchar(191) NOT NULL,
  `discount` varchar(191) NOT NULL DEFAULT '0',
  `fee` varchar(191) NOT NULL DEFAULT '0',
  `voucher` varchar(191) NOT NULL DEFAULT '0',
  `paid` varchar(191) NOT NULL,
  `init_bal` varchar(191) NOT NULL,
  `new_bal` varchar(191) NOT NULL,
  `currency` varchar(50) NOT NULL DEFAULT 'balance',
  `trx` varchar(191) NOT NULL,
  `ref` varchar(191) NOT NULL,
  `api_req_id` varchar(191) DEFAULT NULL,
  `channel` varchar(191) NOT NULL COMMENT 'WEBSITE,API',
  `domain` varchar(50) NOT NULL,
  `purchased_code` varchar(255) DEFAULT NULL,
  `units` varchar(191) DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `errorMsg` varchar(191) DEFAULT NULL,
  `refunded` int NOT NULL DEFAULT '0',
  `created_at` varchar(191) NOT NULL,
  `updated_at` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bills_history`
--

INSERT INTO `bills_history` (`id`, `business_id`, `user_id`, `service_type`, `provider`, `recipient`, `amount`, `discount`, `fee`, `voucher`, `paid`, `init_bal`, `new_bal`, `currency`, `trx`, `ref`, `api_req_id`, `channel`, `domain`, `purchased_code`, `units`, `status`, `errorMsg`, `refunded`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'airtime', 'MTN', '08166939205', '100', '2', '0', '0', '98', '5000', '4902', 'NGN', '2022072511171841656037', '16587467846558859747618899', 'ref32734267899813d', 'API', 'live', NULL, NULL, 'delivered', 'TRANSACTION SUCCESSFUL', 0, '2022-07-25 11:17:33', '2022-07-25 11:17:33'),
(2, 1, 3, 'internet', 'MTN', '08064002132', '100', '2', '0', '0', '98', '4804', '4706', 'NGN', '2022072511261932709791', '16587478685562605376441262', 'ref32734245687935', 'API', 'test', NULL, NULL, 'delivered', 'TRANSACTION SUCCESSFUL', 0, '2022-07-25 11:26:09', '2022-07-25 11:26:09'),
(3, 1, 3, 'tv', 'GOTV', '8057724136', '800', '6.4', '0', '0', '793.6', '4706', '3912.4', 'NGN', '2022072512342035719112', '1563857332996', 'myref875235983535', 'API', 'test', NULL, NULL, 'initiated', 'TRANSACTION SUCCESSFUL', 0, '2022-07-25 12:34:15', '2022-07-25 12:34:15'),
(4, 1, 3, 'tv', 'GOTV', '8057724136', '800', '6.4', '0', '0', '793.6', '3912.4', '3118.8', 'NGN', '20220725123794995001', '1563857332996', 'myref8752359835359', 'API', 'test', NULL, NULL, 'initiated', 'TRANSACTION SUCCESSFUL', 0, '2022-07-25 12:37:32', '2022-07-25 12:37:32'),
(5, 1, 3, 'electricity', 'IKEDC', '45067225834', '100', '1', '0', '0', '99', '2920.8', '2821.8', 'NGN', '202207251301265063960', '16586989121818581054913460', 'myref343275464245345', 'API', 'test', 'Token: 0495  3120  0029  9958  2637  ', '0', 'delivered', 'TRANSACTION SUCCESSFUL', 0, '2022-07-25 13:01:53', '2022-07-25 13:01:53');

-- --------------------------------------------------------

--
-- Table structure for table `bills_internet_data_plans`
--

DROP TABLE IF EXISTS `bills_internet_data_plans`;
CREATE TABLE IF NOT EXISTS `bills_internet_data_plans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip_id` int NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `c_cent` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `api_cent` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bills_internet_data_plans`
--

INSERT INTO `bills_internet_data_plans` (`id`, `ip_id`, `type`, `name`, `code`, `amount`, `price`, `c_cent`, `api_cent`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'mtn-data', 'MTN N100 100MB - (24 Hours)', 'mtn-10mb-100', '100', '100', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(2, 2, 'mtn-data', 'MTN N25 20MB - (24 Hours)', 'mtn-20mb-25', '25', '25', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(3, 2, 'mtn-data', 'MTN N200 200MB - 2 days', 'mtn-50mb-200', '200', '200', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(4, 2, 'mtn-data', 'MTN N50 50MB - (24 Hours)', 'mtn-50mb-50', '50', '50', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(5, 2, 'mtn-data', 'MTN N150 160MB - 30 days', 'mtn-160mb-150', '150', '150', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(6, 2, 'mtn-data', 'MTN N500 750MB - 14 days', 'mtn-750mb-500', '500', '500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(7, 2, 'mtn-data', 'MTN N1,000 1.5GB  - 30 days', 'mtn-100mb-1000', '1000', '1000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(8, 2, 'mtn-data', 'MTN N2,000 4.5GB  - 30 days', 'mtn-500mb-2000', '2000', '2000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(9, 2, 'mtn-data', 'MTN N300 350MB - 7 days', 'mtn-350mb-300', '300', '300', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(10, 2, 'mtn-data', 'MTN N1,500 6GB  - 7 days', 'mtn-20hrs-1500', '1500', '1500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(11, 2, 'mtn-data', 'MTN N2,500 6GB  - 30 days', 'mtn-3gb-2500', '2500', '2500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(12, 2, 'mtn-data', 'MTN N3,000 10GB  - 30 days', 'mtn-data-3000', '3000', '3000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(13, 2, 'mtn-data', 'MTN N3,500 12GB  - 30 days', 'mtn-1gb-3500', '3500', '3500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(14, 2, 'mtn-data', 'MTN N5,000 20GB  - 30 days', 'mtn-100hr-5000', '5000', '5000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(15, 2, 'mtn-data', 'MTN N6,000 25GB  - 30 days', 'mtn-3gb-6000', '6000', '6000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(16, 2, 'mtn-data', 'MTN N10,000 40GB  - 30 days', 'mtn-40gb-10000', '10000', '10000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(17, 2, 'mtn-data', 'MTN N15,000 75GB  - 30 days', 'mtn-75gb-15000', '15000', '15000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(18, 2, 'mtn-data', 'MTN N20,000 110GB  - 30 days', 'mtn-110gb-20000', '20000', '20000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(19, 2, 'mtn-data', 'MTN N1500 3GB  - 30 days', 'mtn-3gb-1500', '1500', '1500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(20, 2, 'mtn-data', 'MTN N1,200 2GB  - 30 days', 'mtn-2gb-1200', '1200', '1200', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(21, 2, 'mtn-data', 'MTN N30,000 120GB  - 60days', 'mtn-120gb-30000', '30000', '30000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(22, 2, 'mtn-data', 'MTN N50,000 150GB  - 90days', 'mtn-150gb-50000', '50000', '50000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(23, 2, 'mtn-data', 'MTN N75,000 250GB  - 90days', 'mtn-250gb-75000', '75000', '75000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(24, 2, 'mtn-data', 'MTN N100,000 325GB  - 6 Months', 'mtn-1tb-100000', '100000', '100000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(25, 2, 'mtn-data', 'MTN N120,000 400GB  - 365 days', 'mtn-400gb-120000', '120000', '120000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(26, 2, 'mtn-data', 'MTN N250,000 1000GB  - 365 days', 'mtn-1000gb-250000', '250000', '250000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(27, 2, 'mtn-data', 'MTN N450,000 2000GB - 365 days', 'mtn-2000gb-450000', '450000', '450000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(28, 2, 'mtn-data', 'MTN N300 1GB - 1 day', 'mtn-1gb-300', '300', '300', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(29, 2, 'mtn-data', 'MTN N300 Xtradata', 'mtn-xtra-300', '300', '300', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(30, 2, 'mtn-data', 'MTN N500 1GB  - 7 days', 'mtn-1gb-500', '500', '500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(31, 2, 'mtn-data', 'MTN N500 2.5GB  - 2 days', 'mtn-2-5gb-500', '500', '500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(32, 2, 'mtn-data', 'MTN N500 Xtradata', 'mtn-xtra-500', '500', '500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(33, 2, 'mtn-data', 'MTN 750MB 50% Deal Zone Offer (500MB+250MB) (14 days)', 'mtn-dealzone-500', '500', '500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(34, 2, 'mtn-data', 'MTN N1,000 Xtradata', 'mtn-xtra-1000', '1000', '1000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(35, 2, 'mtn-data', 'MTN N2,000 Xtradata', 'mtn-xtra-2000', '2000', '2000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(36, 2, 'mtn-data', 'MTN N5,000 Xtradata', 'mtn-xtra-5000', '5000', '5000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(37, 2, 'mtn-data', 'MTN N20,000 110GB  - 30 days', 'mtn-110gb-20000', '20000', '20000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(38, 2, 'mtn-data', 'MTN N10,000 Xtradata', 'mtn-xtra-10000', '10000', '10000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(39, 2, 'mtn-data', 'SME Data Share N13,500 - 30GB', 'mtn-sme30gb-13500', '13500', '13500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(40, 2, 'mtn-data', 'MTN N15,000 Xtradata', 'mtn-xtra-15000', '15000', '15000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(41, 2, 'mtn-data', 'MTN N20,000 Xtradata', 'mtn-xtra-20000', '20000', '20000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(42, 2, 'mtn-data', 'SME Data Share N40,000 - 90GB ', 'mtn-90gb-40000', '40000', '40000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(43, 2, 'mtn-data', 'SME Data Share N50,000 150GB', 'mtn-150gb-50000', '50000', '50000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(44, 1, 'airtel-data', 'Airtel Data - 50 Naira - 40MB  - 1Day', 'airt-50', '49.99', '49.99', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(45, 1, 'airtel-data', 'Airtel Data - 100 Naira - 100MB - 1Day', 'airt-100', '99', '99', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(46, 1, 'airtel-data', 'Airtel Data - 200 Naira - 200MB - 3Days', 'airt-200', '199.03', '199.03', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(47, 1, 'airtel-data', 'Airtel Data - 300 Naira - 350MB - 7 Days', 'airt-300', '299.02', '299.02', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(48, 1, 'airtel-data', 'Airtel Data - 500 Naira - 750MB - 14 Days', 'airt-500', '499', '499', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(49, 1, 'airtel-data', 'Airtel Data - 1,000 Naira - 1.5GB - 30 Days', 'airt-1000', '999', '999', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(50, 1, 'airtel-data', 'Airtel Data - 1,500 Naira - 3GB - 30 Days', 'airt-1500', '1499.01', '1499.01', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(51, 1, 'airtel-data', 'Airtel Data - 2,000 Naira - 4.5GB - 30 Days', 'airt-2000', '1999', '1999', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(52, 1, 'airtel-data', 'Airtel Data - 3,000 Naira - 10GB - 30 Days', 'airt-3000', '2999.02', '2999.02', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(53, 1, 'airtel-data', 'Airtel Data - 4,000 Naira - 11GB - 30 Days', 'airt-4000', '3999.01', '3999.01', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(54, 1, 'airtel-data', 'Airtel Data - 5,000 Naira - 20GB - 30 Days', 'airt-5000', '4999', '4999', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(55, 1, 'airtel-data', 'Airtel Binge - 1,500 Naira (7 Days) - 6GB', 'airt-1500-2', '1499.03', '1499.03', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(56, 1, 'airtel-data', 'Airtel Data - 10,000 Naira - 40GB - 30 Days', 'airt-10000', '9999', '9999', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(57, 1, 'airtel-data', 'Airtel Data - 15,000 Naira - 75GB - 30 Days', 'airt-15000', '14999', '14999', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(58, 1, 'airtel-data', 'Airtel Data - 20,000 Naira - 120GB - 30 Days', 'airt-20000', '19999.02', '19999.02', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(59, 1, 'airtel-data', 'Airtel Data - 300 Naira - 1GB - 1 day', 'airt-300x', '299.03', '299.03', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(60, 1, 'airtel-data', 'Airtel Data - 500 Naira - 2GB - 1 days', 'airt-500x', '499.03', '499.03', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(61, 1, 'airtel-data', 'Airtel Data - 1,200 Naira - 2GB - 30 Days', 'airt-1200', '1199', '1199', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(62, 1, 'airtel-data', 'Airtel Data - 2,500 Naira - 6GB - 30 Days', 'airt-2500', '2499.01', '2499.01', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(63, 1, 'airtel-data', 'Airtel Data - 30,000 Naira - 200GB - 30 Days', 'airt-30000', '29999.02', '29999.02', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(64, 3, 'glo-data', 'Glo Data N100 -  150MB - 1 day', 'glo100', '100', '100', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(65, 3, 'glo-data', 'Glo Data N200 -  350MB - 2 days', 'glo200', '200', '200', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(66, 3, 'glo-data', 'Glo Data N500 -  1.35GB - 14 days', 'glo500', '500', '500', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(67, 3, 'glo-data', 'Glo Data N1000 -  2.9GB - 30 days', 'glo1000', '1000', '1000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(68, 3, 'glo-data', 'Glo Data N2000 -  5.8GB - 30 days', 'glo2000', '2000', '2000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(69, 3, 'glo-data', 'Glo Data N2500 -  7.7GB - 30 days', 'glo2500', '2500', '2500', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(70, 3, 'glo-data', 'Glo Data N3000 -  10GB - 30 days', 'glo3000', '3000', '3000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(71, 3, 'glo-data', 'Glo Data N4000 -  13.25GB - 30 days', 'glo4000', '4000', '4000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(72, 3, 'glo-data', 'Glo Data N5000 -  18.25GB - 30 days', 'glo5000', '5000', '5000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(73, 3, 'glo-data', 'Glo Data N8000 -  29.5GB - 30 days', 'glo8000', '8000', '8000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(74, 3, 'glo-data', 'Glo Data N10000 -  50GB - 30 days', 'glo10000', '10000', '10000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(75, 3, 'glo-data', 'Glo Data N15000 -  93GB - 30 days', 'glo15000', '15000', '15000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(76, 3, 'glo-data', 'Glo Data N18000 -  119GB - 30 days', 'glo18000', '18000', '18000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(77, 3, 'glo-data', 'Glo Data N1500 -  4.1GB - 30 days', 'glo1500', '1500', '1500', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(78, 3, 'glo-data', 'Glo Data N20000 -  138GB - 30 days', 'glo20000', '20000', '20000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(79, 3, 'glo-data', 'Glo Data N50 -  500MB - (Night-1 day)', 'glo50', '50', '50', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(80, 3, 'glo-data', 'Glo Data N50 -  50MB - 1 day', 'glo50x', '50', '50', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(81, 3, 'glo-data', 'Glo Data N100 -  1GB - (Night- 5 days)', 'glo100x', '100', '100', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(82, 3, 'glo-data', 'Glo Data N200 - 1.25GB - (Sunday - 1 day)', 'glo200x', '200', '200', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(83, 3, 'glo-data', 'Glo Data N1500 -  7GB - 7 day', 'glo1500x', '1500', '1500', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(84, 4, 'etisalat-data', '9mobile 100MB - 100 Naira - 1 day', 'eti-100', '100', '100', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(85, 4, 'etisalat-data', '9mobile 650MB - 200 Naira - 1 day', 'eti-200', '200', '200', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(86, 4, 'etisalat-data', '9mobile 500MB - 500 Naira - 30 Days', 'eti-500', '500', '500', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(87, 4, 'etisalat-data', '9mobile 1.5GB - 1,000 Naira - 30 days', 'eti-1000', '1000', '1000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(88, 4, 'etisalat-data', '9mobile 11GB - 4,000 Naira - 30 days', 'eti-4000', '4000', '4000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(89, 4, 'etisalat-data', '9mobile 4.5GB - 2000 Naira - 30 Days', 'eti-2000', '2000', '2000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(90, 4, 'etisalat-data', '9mobile 15GB - 5,000 Naira - 30 Days', 'eti-5000', '5000', '5000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(91, 4, 'etisalat-data', '9mobile 40GB - 10,000 Naira - 30 days', 'eti-10000', '10000', '10000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(92, 4, 'etisalat-data', '9mobile 75GB - 15,000 Naira - 30 Days', 'eti-15000', '15000', '15000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(93, 4, 'etisalat-data', '9mobile 2GB - 1,200 Naira - 30 Days', 'eti-1200', '1200', '1200', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(94, 4, 'etisalat-data', '9mobile 25MB - 50 Naira - 1 day', 'eti-50', '50', '50', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(95, 4, 'etisalat-data', '9mobile 100GB - 84,992 Naira - 100 days', 'eti-84992', '84992', '84992', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(96, 4, 'etisalat-data', '9mobile 7GB - 1,500 Naira - 7 days', 'eti-1500', '1500', '1500', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(97, 4, 'etisalat-data', '9mobile 75GB - 25,000 Naira - 90 days', 'eti-25000', '25000', '25000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(98, 4, 'etisalat-data', '9mobile 165GB - 50,000 Naira - 180 days', 'eti-50000', '50000', '50000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(99, 4, 'etisalat-data', '9mobile 365GB - 100,000 Naira - 365 days', 'eti-100000', '100000', '100000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(100, 5, 'smile-direct', 'SmileVoice ONLY 65 for 30days - 510 Naira', '516', '510', '510', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(101, 5, 'smile-direct', '2GB MidNite for 7days - 1,020 Naira', '413', '1020', '1020', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(102, 5, 'smile-direct', 'SmileVoice ONLY 135 for 30days - 1,020 Naira', '517', '1020', '1020', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(103, 5, 'smile-direct', '3GB MidNite for 7days - 1,530 Naira', '414', '1530', '1530', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(104, 5, 'smile-direct', '3GB Weekend ONLY for 3days - 1,530 Naira', '415', '1530', '1530', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(105, 5, 'smile-direct', 'SmileVoice ONLY 430 for 30days - 3,070 Naira', '518', '3070', '3070', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(106, 5, 'smile-direct', 'Buy Airtime', 'airtime', '0', '0', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(107, 5, 'smile-direct', ' 1GB FlexiDaily for 1days - 300 Naira', '624', '300', '300', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(108, 5, 'smile-direct', ' 2.5GB FlexiDaily for 2days - 500 Naira', '625', '500', '500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(109, 5, 'smile-direct', '1GB FlexiWeekly for 7days - 500 Naira', '626', '500', '500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(110, 5, 'smile-direct', '1.5GB Bigga for 30days - 1,000 Naira', '606', '1000', '1000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(111, 5, 'smile-direct', ' 2GB FlexiWeekly  for 7days - 1,000 Naira', '627', '1000', '1000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(112, 5, 'smile-direct', '2GB Bigga for 30days - 1,200 Naira', '607', '1200', '1200', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(113, 5, 'smile-direct', '3GB Bigga for 30days - 1,500 Naira', '608', '1500', '1500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(114, 5, 'smile-direct', ' 6GB FlexiWeekly  for 7days - 1,500 Naira', '628', '1500', '1500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(115, 5, 'smile-direct', '5GB Bigga for 30days - 2,000 Naira', '620', '2000', '2000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(116, 5, 'smile-direct', '6.5GB Bigga for 30days - 2,500 Naira', '609', '2500', '2500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(117, 5, 'smile-direct', '8GB Bigga for 30days - 3,000 Naira', '610', '3000', '3000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(118, 5, 'smile-direct', '10GB Bigga for 30days - 3,500 Naira', '611', '3500', '3500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(119, 5, 'smile-direct', '12GB Bigga for 30days - 4,000 Naira', '612', '4000', '4000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(120, 5, 'smile-direct', '15GB Bigga for 30days - 5,000 Naira', '613', '5000', '5000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(121, 5, 'smile-direct', '20GB Bigga for 30days - 6,000 Naira', '614', '6000', '6000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(122, 5, 'smile-direct', '30GB Bigga for 30days - 8,000 Naira', '615', '8000', '8000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(123, 5, 'smile-direct', '40GB Bigga for 30days - 10,000 Naira', '616', '10000', '10000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(124, 5, 'smile-direct', 'UnlimitedLite for 30days - 10,000 Naira', '629', '10000', '10000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(125, 5, 'smile-direct', '60GB Bigga for 30days - 13,500 Naira', '617', '13500', '13500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(126, 5, 'smile-direct', '75GB Bigga for 30days - 15,000 Naira', '618', '15000', '15000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(127, 5, 'smile-direct', 'UnlimitedEssential for 30days - 15,000 Naira', '630', '15000', '15000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(128, 5, 'smile-direct', '100GB Bigga for 30days - 18,000 Naira', '619', '18000', '18000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(129, 5, 'smile-direct', '200GB 365 for 365days - 70,000 Naira', '604', '70000', '70000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(130, 5, 'smile-direct', '90GB Jumbo for 60days - 20,000 Naira', '665', '20000', '20000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(131, 5, 'smile-direct', '160GB Jumbo for 90days - 34,000 Naira', '666', '34000', '34000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(132, 5, 'smile-direct', 'BestEffort Freedom for 30days - 36,000 Naira', '671', '36000', '36000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(133, 5, 'smile-direct', '200GB Jumbo for 120days - 40,000 Naira', '667', '40000', '40000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(134, 5, 'smile-direct', '125GB 365 for 365days - 50,000 Naira', '664', '50000', '50000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(135, 5, 'smile-direct', '500GB 365 for 365days - 100,000 Naira', '673', '100000', '100000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(136, 5, 'smile-direct', '1TB 365 for 365days - 120,000 Naira', '674', '120000', '120000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(137, 5, 'smile-direct', 'SmileVoice ONLY 150 for 60days - 1,500 Naira', '698', '1500', '1500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(138, 5, 'smile-direct', 'SmileVoice ONLY 175 for 90days - 2,000 Naira', '700', '2000', '2000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(139, 5, 'smile-direct', 'SmileVoice ONLY 450 for 60days - 4,000 Naira', '699', '4000', '4000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(140, 5, 'smile-direct', 'Smile Voice ONLY 500 for 90days - 5,000 Naira', '701', '5000', '5000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(141, 5, 'smile-direct', '15GB 365 for 365days - 9,000 Naira', '687', '9000', '9000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(142, 5, 'smile-direct', '35GB 365 for 365days - 19,000 Naira', '688', '19000', '19000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(143, 5, 'smile-direct', '130GB Bigga for 30days - 19,800 Naira', '668', '19800', '19800', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(144, 5, 'smile-direct', 'Promo - Freedom 3Mbps (No FUP) for 30days - 20,000 Naira', '696', '20000', '20000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(145, 5, 'smile-direct', 'Promo - Freedom 6Mbps (No FUP) for 30days - 24,000 Naira', '697', '24000', '24000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(146, 5, 'smile-direct', '70GB 365 for 365days - 32,000 Naira', '689', '32000', '32000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `bills_internet_data_plans_agent`
--

DROP TABLE IF EXISTS `bills_internet_data_plans_agent`;
CREATE TABLE IF NOT EXISTS `bills_internet_data_plans_agent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bills_id` int NOT NULL,
  `business_id` int NOT NULL,
  `price` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `c_cent` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `api_cent` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bills_internet_data_plans_agent`
--

INSERT INTO `bills_internet_data_plans_agent` (`id`, `bills_id`, `business_id`, `price`, `c_cent`, `api_cent`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '100', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-08-20 15:36:41'),
(2, 2, 0, '25', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(3, 2, 0, '200', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(4, 2, 0, '50', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(5, 2, 0, '150', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(6, 2, 0, '500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(7, 2, 0, '1000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(8, 2, 0, '2000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(9, 2, 0, '300', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(10, 2, 0, '1500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(11, 2, 0, '2500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(12, 2, 0, '3000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(13, 2, 0, '3500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(14, 2, 0, '5000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(15, 2, 0, '6000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(16, 2, 0, '10000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(17, 2, 0, '15000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(18, 2, 0, '20000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(19, 2, 0, '1500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(20, 2, 0, '1200', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(21, 2, 0, '30000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(22, 2, 0, '50000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(23, 2, 0, '75000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(24, 2, 0, '100000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(25, 2, 0, '120000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(26, 2, 0, '250000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(27, 2, 0, '450000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(28, 2, 0, '300', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(29, 2, 0, '300', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(30, 2, 0, '500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(31, 2, 0, '500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(32, 2, 0, '500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(33, 2, 0, '500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(34, 2, 0, '1000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(35, 2, 0, '2000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(36, 2, 0, '5000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(37, 2, 0, '20000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(38, 2, 0, '10000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(39, 2, 0, '13500', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(40, 2, 0, '15000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(41, 2, 0, '20000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(42, 2, 0, '40000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(43, 2, 0, '50000', '1.5', '2', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(44, 1, 0, '49.99', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(45, 1, 0, '99', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(46, 1, 0, '199.03', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(47, 1, 0, '299.02', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(48, 1, 0, '499', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(49, 1, 0, '999', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(50, 1, 0, '1499.01', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(51, 1, 0, '1999', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(52, 1, 0, '2999.02', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(53, 1, 0, '3999.01', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(54, 1, 0, '4999', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(55, 1, 0, '1499.03', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(56, 1, 0, '9999', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(57, 1, 0, '14999', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(58, 1, 0, '19999.02', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(59, 1, 0, '299.03', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(60, 1, 0, '499.03', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(61, 1, 0, '1199', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(62, 1, 0, '2499.01', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(63, 1, 0, '29999.02', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(64, 3, 0, '100', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(65, 3, 0, '200', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(66, 3, 0, '500', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(67, 3, 0, '1000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(68, 3, 0, '2000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(69, 3, 0, '2500', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(70, 3, 0, '3000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(71, 3, 0, '4000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(72, 3, 0, '5000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(73, 3, 0, '8000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(74, 3, 0, '10000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(75, 3, 0, '15000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(76, 3, 0, '18000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(77, 3, 0, '1500', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(78, 3, 0, '20000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(79, 3, 0, '50', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(80, 3, 0, '50', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(81, 3, 0, '100', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(82, 3, 0, '200', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(83, 3, 0, '1500', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(84, 4, 0, '100', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(85, 4, 0, '200', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(86, 4, 0, '500', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(87, 4, 0, '1000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(88, 4, 0, '4000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(89, 4, 0, '2000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(90, 4, 0, '5000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(91, 4, 0, '10000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(92, 4, 0, '15000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(93, 4, 0, '1200', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(94, 4, 0, '50', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(95, 4, 0, '84992', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(96, 4, 0, '1500', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(97, 4, 0, '25000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(98, 4, 0, '50000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(99, 4, 0, '100000', '2', '2.5', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(100, 5, 0, '510', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(101, 5, 0, '1020', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(102, 5, 0, '1020', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(103, 5, 0, '1530', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(104, 5, 0, '1530', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(105, 5, 0, '3070', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(106, 5, 0, '0', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(107, 5, 0, '300', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(108, 5, 0, '500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(109, 5, 0, '500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(110, 5, 0, '1000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(111, 5, 0, '1000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(112, 5, 0, '1200', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(113, 5, 0, '1500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(114, 5, 0, '1500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(115, 5, 0, '2000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(116, 5, 0, '2500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(117, 5, 0, '3000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(118, 5, 0, '3500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(119, 5, 0, '4000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(120, 5, 0, '5000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(121, 5, 0, '6000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(122, 5, 0, '8000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(123, 5, 0, '10000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(124, 5, 0, '10000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(125, 5, 0, '13500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(126, 5, 0, '15000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(127, 5, 0, '15000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(128, 5, 0, '18000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(129, 5, 0, '70000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(130, 5, 0, '20000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(131, 5, 0, '34000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(132, 5, 0, '36000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(133, 5, 0, '40000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(134, 5, 0, '50000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(135, 5, 0, '100000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(136, 5, 0, '120000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(137, 5, 0, '1500', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(138, 5, 0, '2000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(139, 5, 0, '4000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(140, 5, 0, '5000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(141, 5, 0, '9000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(142, 5, 0, '19000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(143, 5, 0, '19800', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(144, 5, 0, '20000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(145, 5, 0, '24000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57'),
(146, 5, 0, '32000', '2.5', '3', 1, '0000-00-00 00:00:00', '2022-01-31 10:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `bills_internet_providers`
--

DROP TABLE IF EXISTS `bills_internet_providers`;
CREATE TABLE IF NOT EXISTS `bills_internet_providers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `provider` varchar(191) NOT NULL,
  `providerLogoUrl` text NOT NULL,
  `c_cent` varchar(191) NOT NULL DEFAULT '0',
  `api_cent` varchar(191) NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` varchar(191) NOT NULL,
  `updated_at` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bills_internet_providers`
--

INSERT INTO `bills_internet_providers` (`id`, `provider`, `providerLogoUrl`, `c_cent`, `api_cent`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AIRTEL', 'assets/images/bills/Airtel-Data.jpg', '2', '2.5', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(2, 'MTN', 'assets/images/bills/MTN-Data.jpg', '1.5', '2', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(3, 'GLO', 'assets/images/bills/GLO-Data.jpg', '2', '2.5', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(4, '9MOBILE', 'assets/images/bills/9mobile-Data.jpg', '2', '2.5', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(5, 'SMILE4G', 'assets/images/bills/Smile-Payment.jpg', '2.5', '3', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `bills_tv_providers`
--

DROP TABLE IF EXISTS `bills_tv_providers`;
CREATE TABLE IF NOT EXISTS `bills_tv_providers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `provider` varchar(191) NOT NULL,
  `providerLogoUrl` text NOT NULL,
  `c_cent` varchar(191) NOT NULL DEFAULT '0',
  `api_cent` varchar(191) NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` varchar(191) NOT NULL,
  `updated_at` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bills_tv_providers`
--

INSERT INTO `bills_tv_providers` (`id`, `provider`, `providerLogoUrl`, `c_cent`, `api_cent`, `status`, `created_at`, `updated_at`) VALUES
(1, 'DSTV', 'assets/images/bills/Pay-DSTV-Subscription.jpg', '0.5', '0.8', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(2, 'GOTV', 'assets/images/bills/Gotv-Payment.jpg', '0.5', '0.8', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(3, 'STARTIMES', 'assets/images/bills/Startimes-Subscription.jpg', '1', '1.5', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29'),
(4, 'SHOWMAX', 'assets/images/bills/ShowMax.jpg', '0', '0', 1, '2021-10-22 02:10:29', '2021-10-22 02:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `bill_payments`
--

DROP TABLE IF EXISTS `bill_payments`;
CREATE TABLE IF NOT EXISTS `bill_payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(200) NOT NULL,
  `services` varchar(200) NOT NULL,
  `network` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `number` varchar(200) NOT NULL,
  `server_res` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ref` varchar(200) NOT NULL,
  `token` varchar(200) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bill_payments`
--

INSERT INTO `bill_payments` (`id`, `user_id`, `services`, `network`, `amount`, `number`, `server_res`, `ref`, `token`, `date`, `created_at`, `updated_at`) VALUES
(1, '2', 'airtime', 'mtn', '100', '08146328645', 'null', '1060174978', NULL, '2022-04-01 18:50:20', '2022-04-01 18:50:20.000000', '2022-04-01 18:50:20.000000'),
(2, '2', 'airtime', 'mtn', '100', '08146328645', 'null', '883462693', NULL, '2022-04-01 18:51:50', '2022-04-01 18:51:50.000000', '2022-04-01 18:51:50.000000'),
(3, '2', 'airtime', 'MTN', '100', '08166939205', 'null', '1195003728', NULL, '2022-04-01 18:54:11', '2022-04-01 18:54:10.000000', '2022-04-01 18:54:10.000000'),
(4, '2', 'airtime', 'mtn', '100', '08166939205', 'null', '2100562932', NULL, '2022-04-01 18:55:42', '2022-04-01 18:55:42.000000', '2022-04-01 18:55:42.000000'),
(5, '2', 'airtime', 'mtn', '100', '08166939205', 'null', '2025488706', NULL, '2022-04-01 18:56:18', '2022-04-01 18:56:18.000000', '2022-04-01 18:56:18.000000'),
(6, '2', 'airtime', 'glo', '100', '08166939205', 'null', '713171313', NULL, '2022-04-01 18:59:37', '2022-04-01 18:59:37.000000', '2022-04-01 18:59:37.000000'),
(7, '2', 'airtime', 'mtn', '100', '08146328645', 'null', '443910921', NULL, '2022-04-01 19:00:25', '2022-04-01 19:00:25.000000', '2022-04-01 19:00:25.000000'),
(8, '2', 'airtime', 'mtn', '100', '08166939205', 'null', '1262921116', NULL, '2022-04-01 19:12:50', '2022-04-01 19:12:50.000000', '2022-04-01 19:12:50.000000'),
(9, '2', 'airtime', 'mtn', '100', '08166939205', 'null', '948720119', NULL, '2022-04-01 19:13:53', '2022-04-01 19:13:53.000000', '2022-04-01 19:13:53.000000'),
(10, '2', 'airtime', 'mtn', '100', '08146328645', 'null', '1367244309', NULL, '2022-04-01 19:15:40', '2022-04-01 19:15:40.000000', '2022-04-01 19:15:40.000000'),
(11, '2', 'airtime', 'mtn', '100', '08166939205', 'null', '1286176092', NULL, '2022-04-01 19:24:26', '2022-04-01 19:24:26.000000', '2022-04-01 19:24:26.000000'),
(12, '2', 'airtime', 'mtn', '100', '08166939205', 'null', '511183541', NULL, '2022-04-01 19:26:30', '2022-04-01 19:26:30.000000', '2022-04-01 19:26:30.000000'),
(13, '2', 'airtime', 'mtn', '100', '08146328645', 'null', '184115346', NULL, '2022-04-01 19:30:39', '2022-04-01 19:30:39.000000', '2022-04-01 19:30:39.000000'),
(14, '2', 'airtime', 'mtn', '100', '08166939205', 'null', '2093939879', NULL, '2022-04-01 22:13:13', '2022-04-01 22:13:13.000000', '2022-04-01 22:13:13.000000'),
(15, '2', 'mtnData', '200MB 2-Day Plan for Daily--₦200', '200', '08146328645', 'null', '801477878', NULL, '2022-04-02 09:01:16', '2022-04-02 09:01:16.000000', '2022-04-02 09:01:16.000000'),
(16, '2', 'mtnData', '200MB 2-Day Plan for Daily--₦200', '200', '08146328645', 'null', '1898217011', NULL, '2022-04-02 09:04:22', '2022-04-02 09:04:22.000000', '2022-04-02 09:04:22.000000'),
(17, '2', 'mtnData', '75MB Daily for Daily--₦100 100', '100', '08166939205', 'null', '1297058457', NULL, '2022-04-02 09:34:12', '2022-04-02 09:34:12.000000', '2022-04-02 09:34:12.000000'),
(18, '2', 'mtnData', '75MB Daily for Daily--₦100 100', '100', '08166939205', 'null', '611995800', NULL, '2022-04-02 09:35:29', '2022-04-02 09:35:29.000000', '2022-04-02 09:35:29.000000'),
(19, '2', 'airtime', 'mtn', '200', '08146328645', 'null', '1739528417', NULL, '2022-04-02 19:38:13', '2022-04-02 19:38:13.000000', '2022-04-02 19:38:13.000000'),
(20, '2', 'mtnData', '350MB for Weekly--₦300 300', '300', '08166939205', 'null', '722709158', NULL, '2022-04-02 19:41:58', '2022-04-02 19:41:58.000000', '2022-04-02 19:41:58.000000'),
(21, '2', 'airtime', 'mtn', '100', '08166939205', 'null', '1533327437', NULL, '2022-04-02 20:31:25', '2022-04-02 20:31:25.000000', '2022-04-02 20:31:25.000000'),
(22, '2', 'airtime', 'mtn', '100', '08166939205', 'null', '1821496200', NULL, '2022-04-02 20:32:06', '2022-04-02 20:32:06.000000', '2022-04-02 20:32:06.000000'),
(23, '2', 'airtime', 'mtn', '100', '08166939205', 'null', '121162003', NULL, '2022-04-02 20:32:31', '2022-04-02 20:32:31.000000', '2022-04-02 20:32:31.000000'),
(24, '2', 'ikeja_electric_prepaid', 'ikeja_electric_prepaid', '400', '08166939205', 'null', '2057786002', '75402228626982896765', '2022-04-05 05:29:44', '2022-04-05 05:29:44.000000', '2022-04-05 05:29:44.000000'),
(25, '2', 'airtime', 'mtn', '300', '08146328645', 'null', '344285061', NULL, '2022-04-05 07:03:09', '2022-04-05 07:03:09.000000', '2022-04-05 07:03:09.000000'),
(26, '2', 'airtime', 'mtn', '100', '08166939205', 'null', '281731604', NULL, '2022-04-15 07:40:45', '2022-04-15 06:40:45.000000', '2022-04-15 06:40:45.000000'),
(27, '2', 'airtime', 'mtn', '100', '08166939205', '{\"status\":\"success\",\"message\":\"Successful\",\"code\":200,\"data\":{\"statusCode\":\"0\",\"transactionStatus\":\"success\",\"transactionReference\":28364801,\"transactionMessage\":\"Airtime Topup successful on 08166939205\",\"baxiReference\":1496842,\"provider_message\":\"SendOk\"}}', '1490097904', NULL, '2022-04-15 10:19:18', '2022-04-15 09:19:18.000000', '2022-04-15 09:19:18.000000'),
(28, '2', 'data', 'mtn', '100', '08166939205', '{\"status\":\"success\",\"message\":\"Successful\",\"code\":200,\"data\":{\"statusCode\":\"0\",\"transactionStatus\":\"success\",\"transactionReference\":28375178,\"transactionMessage\":\"Data bundle successful on 08166939205\",\"baxiReference\":1496848,\"provider_message\":\"SendOk\",\"extraData\":{\"balance\":\"100\",\"exchangeReference\":\"440985567\",\"responseMessage\":\"SendOk\",\"status\":\"ACCEPTED\",\"statusCode\":\"0\",\"responseCode\":\"0\"}}}', '262595d4e4e9a1', NULL, '2022-04-15 11:55:59', '2022-04-15 10:55:59.000000', '2022-04-15 10:55:59.000000'),
(29, '2', 'data', 'mtn', '100', '08166939205', '{\"status\":\"success\",\"message\":\"Successful\",\"code\":200,\"data\":{\"statusCode\":\"0\",\"transactionStatus\":\"success\",\"transactionReference\":28375354,\"transactionMessage\":\"Data bundle successful on 08166939205\",\"baxiReference\":1496849,\"provider_message\":\"SendOk\",\"extraData\":{\"balance\":\"100\",\"exchangeReference\":\"996804022\",\"responseMessage\":\"SendOk\",\"status\":\"ACCEPTED\",\"statusCode\":\"0\",\"responseCode\":\"0\"}}}', '262595db5c27b7', NULL, '2022-04-15 11:57:42', '2022-04-15 10:57:42.000000', '2022-04-15 10:57:42.000000'),
(30, '2', 'data', 'mtn', '100', '08166939205', '{\"status\":\"success\",\"message\":\"Successful\",\"code\":200,\"data\":{\"statusCode\":\"0\",\"transactionStatus\":\"success\",\"transactionReference\":28377114,\"transactionMessage\":\"Data bundle successful on 08166939205\",\"baxiReference\":1496850,\"provider_message\":\"SendOk\",\"extraData\":{\"balance\":\"100\",\"exchangeReference\":\"709755358\",\"responseMessage\":\"SendOk\",\"status\":\"ACCEPTED\",\"statusCode\":\"0\",\"responseCode\":\"0\"}}}', '2625961b3de189', NULL, '2022-04-15 12:14:44', '2022-04-15 11:14:44.000000', '2022-04-15 11:14:44.000000'),
(31, '2', 'data', 'airtel', '200', '08166939205', '{\"status\":\"success\",\"message\":\"Successful\",\"code\":200,\"data\":{\"statusCode\":\"0\",\"transactionStatus\":\"success\",\"transactionReference\":28377352,\"transactionMessage\":\"Data bundle successful on 08166939205\",\"baxiReference\":1496851,\"provider_message\":\"Transaction Successful\",\"extraData\":{\"exchangeReference\":\"R9465386787258755\",\"responseMessage\":\"Transaction Successful\",\"status\":\"ACCEPTED\",\"statusCode\":\"200\"}}}', '26259623c25250', NULL, '2022-04-15 12:17:01', '2022-04-15 11:17:01.000000', '2022-04-15 11:17:01.000000'),
(32, '2', 'ikeja_electric_prepaid', 'ikeja_electric_prepaid', '100', '08166939205', 'null', '970898051', '09397083035497182560', '2022-04-15 12:59:30', '2022-04-15 11:59:30.000000', '2022-04-15 11:59:30.000000'),
(33, '2', 'electricity', 'ikeja_electric_prepaid', '100', '08166939205', '{\"status\":\"success\",\"message\":\"Successful\",\"code\":200,\"data\":{\"transactionStatus\":\"success\",\"transactionReference\":28382833,\"statusCode\":\"0\",\"transactionMessage\":\"Payment Successful\",\"tokenCode\":\"46856845880846958232\",\"tokenAmount\":84.75,\"amountOfPower\":\"84.8 kWh\",\"creditToken\":\"46856845880846958232\",\"resetToken\":null,\"configureToken\":null,\"rawOutput\":{\"tariffBaseRate\":24.95,\"tokenAmount\":84.75,\"costOfUnit\":84.75,\"creditToken\":\"46856845880846958232\",\"fixChargeAmount\":240,\"exchangeReference\":\"691825271191\",\"tariff\":\"NEW TARIFF 10\",\"resetToken\":null,\"taxAmount\":15.25,\"configureToken\":null,\"debtAmount\":null,\"status\":\"ACCEPTED\",\"amountOfPower\":\"84.8 kWh\"},\"provider_message\":\"\",\"baxiReference\":1496854}}', '767010102', NULL, '2022-04-15 13:15:49', '2022-04-15 12:15:49.000000', '2022-04-15 12:15:49.000000'),
(34, '2', 'electricity', 'ikeja_electric_prepaid', '100', '08166939205', '{\"status\":\"success\",\"message\":\"Successful\",\"code\":200,\"data\":{\"transactionStatus\":\"success\",\"transactionReference\":28382873,\"statusCode\":\"0\",\"transactionMessage\":\"Payment Successful\",\"tokenCode\":\"84885467802767240748\",\"tokenAmount\":84.75,\"amountOfPower\":\"84.8 kWh\",\"creditToken\":\"84885467802767240748\",\"resetToken\":null,\"configureToken\":null,\"rawOutput\":{\"tariffBaseRate\":24.95,\"tokenAmount\":84.75,\"costOfUnit\":84.75,\"creditToken\":\"84885467802767240748\",\"fixChargeAmount\":240,\"exchangeReference\":\"587714822792\",\"tariff\":\"NEW TARIFF 10\",\"resetToken\":null,\"taxAmount\":15.25,\"configureToken\":null,\"debtAmount\":null,\"status\":\"ACCEPTED\",\"amountOfPower\":\"84.8 kWh\"},\"provider_message\":\"\",\"baxiReference\":1496855}}', '2036827416', NULL, '2022-04-15 13:16:22', '2022-04-15 12:16:22.000000', '2022-04-15 12:16:22.000000');

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

DROP TABLE IF EXISTS `business`;
CREATE TABLE IF NOT EXISTS `business` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phoneno` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lga` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `wallet` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `user_id`, `name`, `address`, `phoneno`, `lga`, `state`, `type`, `wallet`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Amali', 'Akute, Ifo LGA, Ogun State', '08166939205', 'Irewole', '25', 'Sole Proprietorship', '0', 0, '2021-12-04 06:14:44', '2022-02-09 06:38:12'),
(2, 2, 'Amali CARD\r\n', 'Akute, Ifo LGA, Ogun State', '08166939205', 'Irewole', '10', 'Partnership', '0', 0, '2021-12-04 06:33:05', '2022-02-09 06:38:31'),
(3, 1, 'Amali TERMINAL', 'Akute, Ifo LGA, Ogun State', '08166939205', 'Irewole', '20', 'Sole Proprietorship', '0', 0, '2021-12-04 21:20:01', '2022-02-09 06:38:27'),
(4, 1, 'Amali POS', 'Akute, Ifo LGA, Ogun State', '08166939205', 'Irewole', '16', 'Sole Proprietorship', '0', 0, '2021-12-05 13:29:42', '2022-02-09 06:38:21'),
(5, 4, 'BollyBee POS Services', 'Ifo Market', '08095480534', ' ', ' ', 'Sole Proprietorship', '0', 0, '2021-12-06 20:40:51', '2021-12-06 20:40:51'),
(6, 20, 'Adekunle Cart', 'Ikeja', '08098999898', 'Ifo', '28', 'Sole Proprietorship', '0', 0, '2022-02-22 16:58:19', '2022-02-22 16:58:19'),
(7, 28, '09021212275', ' ', '09021212275', ' ', ' ', ' ', '0', 0, '2022-06-24 11:31:40', '2022-06-24 11:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `card_requests`
--

DROP TABLE IF EXISTS `card_requests`;
CREATE TABLE IF NOT EXISTS `card_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `account_number` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `account_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_by` int NOT NULL,
  `creator_uuid` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cashout_fees`
--

DROP TABLE IF EXISTS `cashout_fees`;
CREATE TABLE IF NOT EXISTS `cashout_fees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `range_set` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '2000',
  `status` int NOT NULL DEFAULT '1',
  `agent_uuid` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cashout_fees`
--

INSERT INTO `cashout_fees` (`id`, `description`, `fee`, `range_set`, `status`, `agent_uuid`, `created_at`, `updated_at`) VALUES
(7, '500,000 per transaction max', '1177', '500000', 1, 4, '2022-03-27 13:23:25', '2022-03-27 14:48:07'),
(6, '500,000 per transaction max', '25', '500000', 1, 0, '2022-03-27 13:19:36', '2022-03-27 14:48:17'),
(8, 'N1 to N,3,000', '400', '3000', 1, 0, '2022-03-27 14:51:42', '2022-03-27 14:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `business_id` int NOT NULL,
  `bvn` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `referralCode` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `avatar` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `accountNo` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `accountName` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creator_uuid` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `business_id`, `bvn`, `phone`, `email`, `referralCode`, `signature`, `avatar`, `accountNo`, `accountName`, `creator_uuid`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, '22434338544', '08168192858', 'samjidiamond@gmail.com', NULL, NULL, NULL, '1001554571', 'EMMANUEL PROMISE ODEJINMI', '1', '1', 1, '2022-02-09 12:21:11', '2021-12-31 18:52:49'),
(2, 0, '22224564452', '08145464999', 'soldourn@yahoo.com', NULL, NULL, NULL, '1001554753', 'Ramat Oluwasola Oyedokun', '439889096158233444', '18', 1, '2022-02-25 09:46:08', '2022-02-25 09:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `data_providers`
--

DROP TABLE IF EXISTS `data_providers`;
CREATE TABLE IF NOT EXISTS `data_providers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_type` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `data_providers`
--

INSERT INTO `data_providers` (`id`, `service_type`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'glo', 'Glo', 1, '2022-03-29 13:33:44', '2022-03-29 13:33:44'),
(2, 'airtel', 'Airtel', 1, '2022-03-29 13:33:44', '2022-03-29 13:33:44'),
(3, 'mtn', 'Mtn', 1, '2022-03-29 13:33:44', '2022-03-29 13:33:44'),
(4, 'smile', 'Smile', 1, '2022-03-29 13:33:44', '2022-03-29 13:33:44'),
(5, 'dstvshowmax', 'Multichoice', 1, '2022-03-29 13:33:44', '2022-03-29 13:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incentive_flats`
--

DROP TABLE IF EXISTS `incentive_flats`;
CREATE TABLE IF NOT EXISTS `incentive_flats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `threshold` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `range_set` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '2000',
  `status` int NOT NULL DEFAULT '1',
  `agent_uuid` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incentive_percents`
--

DROP TABLE IF EXISTS `incentive_percents`;
CREATE TABLE IF NOT EXISTS `incentive_percents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `threshold` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `range_set` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '2000',
  `status` int NOT NULL DEFAULT '1',
  `agent_uuid` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `incentive_percents`
--

INSERT INTO `incentive_percents` (`id`, `description`, `threshold`, `range_set`, `status`, `agent_uuid`, `created_at`, `updated_at`) VALUES
(1, 'N1 to N1,000', '370', '1000', 1, 0, '2022-03-27 15:10:04', '2022-03-27 15:10:04'),
(2, 'N1,001 – N2,000', '450', '2000', 1, 0, '2022-03-27 15:10:40', '2022-03-27 15:10:40'),
(3, 'N2,001 – N3,000', '550', '3000', 1, 0, '2022-03-27 15:11:16', '2022-03-27 15:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `kyc`
--

DROP TABLE IF EXISTS `kyc`;
CREATE TABLE IF NOT EXISTS `kyc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `utility` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idcard` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `guarantorform` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `passport` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kyc`
--

INSERT INTO `kyc` (`id`, `user_id`, `utility`, `idcard`, `guarantorform`, `passport`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'kyc/taIwSSQUCuwjPL7d3o58rj3iVqw8t0SKeVuTM0MH.jpg', 'kyc/hh9lxoKrVWGr3psKTP0opdIKxljwqOqcTiVt8pBx.jpg', 'kyc/XWKWejDK6Un3PvjYfYaud093ufCkEmQWIFHljfxB.pdf', 'kyc/1hgvevUtfOQqrI0Qs38v2Phdp8r1EXj8gcEFRJ79.jpg', 1, '2021-12-04 06:14:44', '2022-01-27 07:22:08'),
(2, 2, 'kyc/zCZOCB3NyqORQDgCbKBV1HBRZbHcFTjxuotnZw0o.jpg', 'kyc/e8ZEmOlAPlIXanXMEj3SYJxDfNzccdSQC8Vt1WRk.jpg', 'kyc/0hrLYgIIpQSBTbwAQzrmTBkvr0IG795CT8p8mxBN.pdf', 'kyc/OYlCQ2mPxCBEkONZflWPFyqTnPnXzdcBZRzxV7D4.jpg', 2, '2021-12-04 06:33:05', '2022-02-03 19:07:42'),
(3, 1, 'kyc/DoG1rghx9PdqffXJTgeic4UrYGDRUDYb8C852A8m.jpg', 'kyc/cEF3F65t9jjnqsCOxhpBvcKBMcCXIgl3eBeE34Iv.jpg', 'kyc/w7GydPCgXznKocxWLgCgY3MKbfuJOoSkJLy1TDPh.pdf', 'kyc/0KbugubINB5mUbHGlbx8xhxN9AMyTNlGS8L3TtSx.jpg', 1, '2021-12-04 21:20:01', '2022-02-03 19:10:16'),
(4, 1, 'kyc/euysLTZ9gn877Q24fznMivcJm0lh6GobFzMLVkSw.jpg', 'kyc/OlMJQxBEHmN61QawprvTzOM2I78MYgR8GkvlLCiY.jpg', 'kyc/6zJ8Xmta9fr9i0lUBbLjzoM4EKoI0IF5pyGFWlbc.pdf', 'kyc/chMwCeYqVBuARLEKok5v6d3ndWU24tUnX3sGnrfG.jpg', 1, '2021-12-05 13:29:43', '2022-02-14 11:23:16'),
(5, 20, 'kyc/B8znKTfXjbt4h5tHotJp0jsaGzgz3khJ1JGPnzHp.webp', 'kyc/APsg5Il70BEXCldoNABwwYszfDuCqL9m8XzGYA4E.png', 'kyc/KM7ppigqOrCjP09MK0b8SUDvia5L3fePPoPjWLqB.webp', 'kyc/tr3CaPjPfxZBSj1cs8No9TdzLJeAz3QVpVERMo5Q.png', 0, '2022-02-22 16:58:19', '2022-02-22 16:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
CREATE TABLE IF NOT EXISTS `loans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `agent` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `amount` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `interest` varchar(44) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` varchar(44) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `penalty` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `next_penalty` datetime DEFAULT NULL,
  `paid` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int NOT NULL,
  `reference` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` varchar(77) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  `duration` varchar(77) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `agent`, `amount`, `interest`, `total`, `penalty`, `next_penalty`, `paid`, `status`, `reference`, `created_at`, `updated_at`, `expire`, `duration`) VALUES
(8, 6, '439889096158233444', '59', '0.236', '59.236', NULL, NULL, NULL, 1, '1990178431', '2022-02-24 15:19:55', '2022-02-24 15:19:55', '2022-02-27 15:16:52', '3');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_12_01_123620_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(155) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('odejinmisamuel@gmail.com', '$2y$10$Jt0EjD3jliYFG.Yxm0MqRu3iFDhJVGaIoD9eZbqnQQlcJ6P6L6Qw2', '2022-01-28 12:58:11'),
('samjidiamond@gmail.com', '$2y$10$pyS6dAjTqUUjIWD90XF8KO/nURnlIiv60Oky33wfTUMPTLY/pwLmS', '2022-07-24 15:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(4, 'App\\Models\\User', 3, 'PostmanRuntime/7.29.2', 'b399360ce3e70345ed9fd64c13f66d9b590c32671456dbdfba4628dd35a3ea4a', '[\"*\"]', NULL, '2022-07-26 10:13:09', '2022-07-26 10:13:09'),
(6, 'App\\Models\\User', 5, 'PostmanRuntime/7.29.2', 'a87c862b996bc2f9aa30080c8a258b1e9a8c8bf8877554318834bffe10e8fd95', '[\"*\"]', '2022-07-26 12:54:48', '2022-07-26 10:22:35', '2022-07-26 12:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `poswithdrawal_fees`
--

DROP TABLE IF EXISTS `poswithdrawal_fees`;
CREATE TABLE IF NOT EXISTS `poswithdrawal_fees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fee_percent` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `range_set` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '2000',
  `minimum_fee` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `capped_fee` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `agent_uuid` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poswithdrawal_fees`
--

INSERT INTO `poswithdrawal_fees` (`id`, `description`, `fee`, `fee_percent`, `range_set`, `minimum_fee`, `capped_fee`, `status`, `agent_uuid`, `created_at`, `updated_at`) VALUES
(5, 'pos withdrawal67', '25', '100', '500000', '125', '50000', 1, 0, '2022-03-26 18:33:18', '2022-03-27 13:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `revenues`
--

DROP TABLE IF EXISTS `revenues`;
CREATE TABLE IF NOT EXISTS `revenues` (
  `id` int NOT NULL AUTO_INCREMENT,
  `business_id` int NOT NULL,
  `reference` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `balance` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'system',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `payload` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3vEvtRCvYovYvEpHEEwxeRaxfdsgqp2wnqaF7P7A', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiWFpkbTd0V0hDb2JyWGhpdHhpYk5yUDdWUGFFczVQNUVmWUxvV3NURCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi90cmFuc2FjdGlvbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkZTZWSkdtNUpCaEZ4YVpEcXd0Y0t5LjlQR2VTT1FqZG42RnluSXhFakVHNy9KMGFrWkpsSXEiO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJGU2VkpHbTVKQmhGeGFaRHF3dGNLeS45UEdlU09RamRuNkZ5bkl4RWpFRzcvSjBha1pKbElxIjt9', 1661009651);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sitename` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_template` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `sms_api` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail_config` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'email configuration',
  `sms_config` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `float_min_trx` int DEFAULT NULL,
  `float_min_amount` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `float_max_amount` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `float_min_count` int DEFAULT NULL,
  `float_min_month` int DEFAULT NULL,
  `float_min_tenure` int DEFAULT NULL,
  `float_max_tenure` int DEFAULT NULL,
  `float_int_flat` int DEFAULT NULL,
  `float_int_percent` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `float_fee` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sitename`, `cur_text`, `cur_sym`, `email_from`, `email_template`, `sms_api`, `mail_config`, `sms_config`, `created_at`, `updated_at`, `float_min_trx`, `float_min_amount`, `float_max_amount`, `float_min_count`, `float_min_month`, `float_min_tenure`, `float_max_tenure`, `float_int_flat`, `float_int_percent`, `float_fee`) VALUES
(1, 'Amali', 'NGN', '₦', 'do-not-reply@amali.com', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.imgur.com/Z1qtvtV.png\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2021 <a href=\"#\">Website Name</a> . All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'ssk__SZtcyamIi4cfFWg5sXrgfhm8iESHLbpB6uddA4WttvoCZY53Th0Sspm11r5jQxTzonHkWjE9pEgdq4JpZWTN2', '{\"name\":\"php\"}', '{\"clickatell_api_key\":\"----------------------------\",\"infobip_username\":\"--------------\",\"infobip_password\":\"----------------------\",\"message_bird_api_key\":\"-------------------\",\"account_sid\":\"AC67afdacf2dacff5f163134883db92c24\",\"auth_token\":\"77726b242830fb28f52fb08c648dd7a6\",\"from\":\"+17739011523\",\"apiv2_key\":\"dfsfgdfgh\",\"name\":\"clickatell\"}', NULL, '2022-03-09 10:09:14', 50000, '10000', '100000', 15, 3, 1, 3, 0, '0.5', '0');

-- --------------------------------------------------------

--
-- Table structure for table `terminals`
--

DROP TABLE IF EXISTS `terminals`;
CREATE TABLE IF NOT EXISTS `terminals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `business_id` int NOT NULL,
  `terminal_id` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agent_id` varchar(350) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_agent_id` varchar(350) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial_number` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `terminals`
--

INSERT INTO `terminals` (`id`, `business_id`, `terminal_id`, `agent_id`, `sub_agent_id`, `serial_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'ASDERS', '5', NULL, 'ADSFHYUUYJHGSDG', 1, '2022-02-04 05:56:35', '2022-07-27 21:58:15'),
(4, 0, 'dsadssad', '1', '2', 'HGHYUHJVJVBLJOUW', 1, '2022-02-04 06:14:20', '2022-02-25 13:30:32'),
(5, 1, 'hfcjrdjtyju', NULL, NULL, '2344334ih9766', 1, '2022-02-14 11:16:50', '2022-07-27 21:58:08'),
(6, 1, '439889096158233444', '5', NULL, '439889096158233444', 0, '2022-02-14 11:19:10', '2022-07-27 21:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `business_id` int NOT NULL,
  `user_id` int NOT NULL,
  `uuid` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `previous` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `balance` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1 for success, 0 for pending, 2 for reversed, 4 for failed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `business_id`, `user_id`, `uuid`, `reference`, `type`, `remark`, `amount`, `previous`, `balance`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '439889096158233444', '2022072511171841656037', 'debit', 'NGN 100 MTN Airtime Purchase Was Successful To 08166939205', '100', '5000', '4902', 1, '2022-07-25 10:17:33', '2022-07-25 10:17:33'),
(2, 1, 3, '439889096158233444', '2022072511261932709791', 'debit', 'MTN N100 100MB - (24 Hours) Purchase Was Successful To 08064002132', '98', '4804', '4706', 1, '2022-07-25 10:26:09', '2022-07-25 10:26:09'),
(3, 1, 3, '439889096158233444', '2022072512342035719112', 'debit', 'GOtv Smallie - monthly N800 Purchase Was Successful To 8057724136', '793.6', '4706', '3912.4', 1, '2022-07-25 11:34:15', '2022-07-25 11:34:15'),
(4, 1, 3, '439889096158233444', '20220725123794995001', 'debit', 'GOtv Smallie - monthly N800 Purchase Was Successful To 8057724136', '793.6', '3912.4', '3118.8', 1, '2022-07-25 11:37:32', '2022-07-25 11:37:32'),
(5, 1, 3, '439889096158233444', '202207251301265063960', 'debit', 'NGN 100 IKEDC Electricity Purchase Was Successful To 45067225834. Token: 0495  3120  0029  9958  2637   ', '100', '2920.8', '2821.8', 1, '2022-07-25 12:01:53', '2022-07-25 12:01:53');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
CREATE TABLE IF NOT EXISTS `transfers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` varchar(200) NOT NULL,
  `refid` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `bankcode` varchar(200) NOT NULL,
  `account_no` varchar(200) NOT NULL,
  `narration` text,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `userid`, `refid`, `amount`, `bankcode`, `account_no`, `narration`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', '432385431', '500', '999044', '09061123233', 'Transfer from samson', 0, '2022-04-25 19:34:10.000000', '2022-04-25 19:34:10.000000'),
(2, '2', '585639485', '100', '999015', '2373624090', 'Transfer from samson', 1, '2022-04-25 20:12:14.000000', '2022-05-10 10:15:35.000000'),
(3, '2', '856956904', '400', '999023', '3097383607', 'TRANS', 0, '2022-04-25 20:34:56.000000', '2022-04-25 20:34:56.000000'),
(4, '2', '299762002', '200', '999023', '3097383607', 'TRANS222', 0, '2022-04-25 20:40:05.000000', '2022-04-25 20:40:05.000000'),
(5, '2', 'AMALI INCLUSION PARTNER LIMITED-628b7a6578184', '150', '000013', '0248215384', 'transfer to samuel', 0, '2022-05-23 11:13:28.000000', '2022-05-23 11:13:28.000000'),
(6, '2', 'amali-inclusion-628b7ce9d43c6', '125', '000013', '0248215384', 'transfer for amali test', 0, '2022-05-23 11:24:11.000000', '2022-05-23 11:24:11.000000'),
(7, '2', 'amali-inclusion-628fbc1ab230c', '100', '999999', '1000063012', 'transfer by odejinmi', 0, '2022-05-26 16:42:51.000000', '2022-05-26 16:42:51.000000'),
(8, '2', 'amali-inclusion-628fbc3c6ff2a', '100', '999999', '1000063012', 'transfer by odejinmi', 0, '2022-05-26 16:43:25.000000', '2022-05-26 16:43:25.000000'),
(9, '2', 'amali-inclusion-628fbcd15936c', '145', '999999', '1000063012', 'transfer by odejinmi', 0, '2022-05-26 16:45:54.000000', '2022-05-26 16:45:54.000000'),
(10, '2', 'amali-inclusion-628fbd2e317f7', '500', '999044', '0001744830', 'transfer by odejinmi', 0, '2022-05-26 16:47:27.000000', '2022-05-26 16:47:27.000000'),
(11, '2', 'amali-inclusion-6294d1a21e533', '100', '999999', '1001573671', 'intra transfer test', 0, '2022-05-30 13:16:04.000000', '2022-05-30 13:16:04.000000');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_fees`
--

DROP TABLE IF EXISTS `transfer_fees`;
CREATE TABLE IF NOT EXISTS `transfer_fees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fee` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `range_set` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '2000',
  `status` int NOT NULL DEFAULT '1',
  `agent_uuid` varchar(180) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transfer_fees`
--

INSERT INTO `transfer_fees` (`id`, `fee`, `range_set`, `status`, `agent_uuid`, `created_at`, `updated_at`) VALUES
(9, '111', '500000', 1, '5', '2022-03-27 12:55:25', '2022-03-27 13:15:01'),
(10, '50', '500000', 1, '0', '2022-03-27 14:49:29', '2022-03-27 14:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `business_id` int NOT NULL,
  `admin` int NOT NULL DEFAULT '0',
  `firstname` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(155) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `superadmin` int NOT NULL DEFAULT '0',
  `phone` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agent` int NOT NULL DEFAULT '1',
  `uuid` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sub_agent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `transaction_limit` int NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_timer` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `two_factor_secret` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `business_id`, `admin`, `firstname`, `lastname`, `email`, `superadmin`, `phone`, `dob`, `gender`, `agent`, `uuid`, `sub_agent`, `status`, `transaction_limit`, `email_verified_at`, `password`, `code`, `code_timer`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'Master', 'Agent', 'amalimaster@gmail.com', 1, '08052992280', '2021-12-05', 'Male', 0, '439889096158233444', NULL, 1, 0, NULL, '$2y$10$e6VJGm5JBhFxaZDqwtcKy.9PGeSOQjdn6FynIxEjEG7/J0akZJlIq', NULL, NULL, NULL, NULL, '9rsHBmLP1uFAKJCHb5XS6PSCAXZceZbnFrd6FW0wvC1Tr3I68k91TvWQPvrh', NULL, NULL, '2021-12-05 13:29:42', '2021-12-18 16:35:22'),
(2, 1, 0, 'samji', 'dada', 'samjidada@gmail.com', 1, '08166939205', '2021-07-09', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$e6VJGm5JBhFxaZDqwtcKy.9PGeSOQjdn6FynIxEjEG7/J0akZJlIq', NULL, NULL, NULL, NULL, 'XJmY7IRRlwgiv3RxbIIa49CONHionyQYFqOQvhvYMSwQkrBBy19gmmVMbYLh', NULL, NULL, '2021-12-06 18:38:02', '2021-12-06 18:38:02'),
(3, 1, 0, 'Samuel', 'Adekunle', 'samjidiamondi@gmail.com', 0, '07011223377', '2021-12-06', 'Female', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$VjKiy0rrEuEmDFHuQykPaudtzZpHCrM/FBR8PwSiqhlDegCY0yq/G', NULL, NULL, NULL, NULL, 'rJKazouh6arShAtAsGwsTygIC5OIXmplRLhTftQe0RiID71CH0XTWvvANIuH', NULL, NULL, '2021-12-06 18:40:39', '2022-07-25 12:44:31'),
(4, 0, 0, 'Bola', 'Salimonu', 'bola.salimonu@gmail.com', 0, '08095480534', '1991-02-28', ' ', 1, '439919233212732816', NULL, 1, 0, NULL, '$2y$10$iB592TIM4HYE0VP2Tx1IVu8JWOuvfk/2H6i18V2DvHAX7ARrJILY.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-06 20:40:51', '2021-12-06 20:40:51'),
(5, 1, 0, 'Master', 'Agent', 'testagent@test.com', 0, '08012345678', '2021-12-05', 'Male', 1, '43988', NULL, 1, 0, NULL, '$2y$10$e6VJGm5JBhFxaZDqwtcKy.9PGeSOQjdn6FynIxEjEG7/J0akZJlIq', NULL, NULL, NULL, NULL, 'ceCBiIXQWSfOmBiW5vyCRqE2RlBMyo7N16Sv4QRpQkHScnGaYIxDXolIWMM4', NULL, NULL, '2021-12-05 13:29:42', '2021-12-18 16:35:22'),
(6, 0, 0, 'Admin', 'Admin', 'admin@admin.com', 1, '08011111111', '2021-12-05', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$EeLr1s6MSxjeJS8d9K1HyOdsqDO3UwenDr00o8rqnpOv0n0Fv/Mki', '82574', '2022-03-04 09:15:44', NULL, NULL, '3dRVa3yDVca1MZjQAbzW1UX6IEFW8mcvpXOz7p5ddHJW7zwnQWQskbzMf42i', NULL, NULL, '2021-06-08 13:29:42', '2022-03-04 09:12:44'),
(14, 0, 0, 'Samuel', 'Odejinmi', 'samjidiamonda@gmail.com', 0, '08166939100', '2021-12-20', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$9MXAKr2Dz.SkQzIJhGoaZ.eugk7puXMKkhgQm5s1TJV5pB92HGD9W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-20 05:16:23', '2021-12-20 05:16:23'),
(15, 0, 0, 'Samuel', 'Odejinmi', 'samjidiamondo@gmail.com', 0, '08166939100', '2021-12-20', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$UmRJSshC145m3NAlvXiSZe3hDyFGzYBAFt8h/L3oVMes6Ml.BKMSW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-20 05:16:56', '2021-12-20 05:16:56'),
(16, 0, 0, 'Samuel', 'Arigbabuwo', 'samjidiamond@gmail.com', 0, '08166939200', '2022-01-19', 'Male', 1, '439889096158233444', '1', 1, 5000, NULL, '$2y$10$dhEwNNdCpVpk18UYBLBKG.NCYxAi2OxBhrUdDrUJiQ/OWDw8Dz1R2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-01-19 03:40:39', '2022-01-19 03:40:39'),
(17, 0, 1, 'Johnson', 'Best', 'inclusivevillage@yahoo.comm', 1, '08012321234', '1960-12-03', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$EeLr1s6MSxjeJS8d9K1HyOdsqDO3UwenDr00o8rqnpOv0n0Fv/Mki', NULL, NULL, NULL, NULL, 'Iu05Ol6HeapUKjVmQ5QnCAakBuImS7RJNt5yJVRO16iZnGkTb3qbXya0rEHw', NULL, NULL, '2022-01-19 10:40:34', '2022-01-19 10:40:34'),
(18, 0, 1, 'Demola', 'Eleja', 'amaliprojects1@gmail.com', 0, '08062229200', '1990-07-06', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$EeLr1s6MSxjeJS8d9K1HyOdsqDO3UwenDr00o8rqnpOv0n0Fv/Mki', NULL, NULL, NULL, NULL, 'jpmlZ8OMq6nhU2Q88lPzHHKWMMpRhcPTeKqol6kakjYJOV0PoWF1HOVVYDl5', NULL, NULL, '2022-02-09 08:00:41', '2022-02-09 08:00:41'),
(19, 0, 0, 'Oye', 'Oye', 'ramat.oyedokun@amali.africaa', 0, '08145464999', '2000-01-14', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$mt3166zJA1wa.wL.LVbj.O1S2YW2Sf4zcB9iunCalSZBscdOAxszK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-14 10:54:14', '2022-02-14 10:54:14'),
(20, 0, 0, 'Oluwakayode', 'Adetunji', 'talk2kaystone@yahoo.com', 0, '08098999898', '2022-02-17', 'Male', 1, '27607732673566132', NULL, 1, 0, NULL, '$2y$10$zCeA1i0di9.8/c5EQEHfpOi7MyriiImk7IetUZcADlSAxjJpCNMMS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-22 16:58:19', '2022-02-22 16:58:19'),
(21, 0, 0, 'Oladejo', 'Omowunmi', 'sam@bud.africaa', 0, '07000000000', '2022-02-11', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$FQu5grKCxQ2/iXmKa7fIoer719hM7NW3sj2.unT3H3DYQCBI46VYK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-22 21:14:48', '2022-02-22 21:14:48'),
(22, 0, 0, 'Akinrinade', 'Samuel', 'Africlique@gmail.com', 0, '08161112404', '1988-01-24', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$5Y64hxYG3RC/37CzMvZknuJL9dPfugWa4se1I9t8q304odxGRq3Vy', '19708', '2022-02-24 16:35:52', NULL, NULL, 'v22bE2dsQdNWDlNcOUpLvhseYGFdtUfon1VukKNyNroIIyKt7mvnU0zSHXHB', NULL, NULL, '2021-09-01 09:36:59', '2022-02-24 16:32:52'),
(23, 0, 0, 'Sola', 'Oye', 'ramat.oyedokun@amali.africa', 0, '08145464999', '1996-02-06', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$OoeDg2APR5Yk58bnzV07.eHoI56yb8FPGvAWurPXdxkVv.bzNBJJa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-25 09:38:11', '2022-02-25 09:38:11'),
(24, 0, 0, 'Inclusive', 'Village', 'Inclusivevillage@Hotmail.com', 0, '08052992280', '1980-12-03', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$mHXwHYBEV7kQmI1GB3CJSeM4E6sdMq3..h5b/IAmSKkWxvGMyDZB6', NULL, NULL, NULL, NULL, 'zYo4nmBwHfDMJQU3GzKKNsY77ktu4HZHQBKWDD5Q2o0P5subw4cWt7cAOsvf', NULL, NULL, '2022-03-03 19:27:17', '2022-03-03 19:30:50'),
(25, 0, 0, 'Olakunle', 'Adetunji', 'lp@i-villagetech.com', 0, '08038913108', '1980-09-02', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$wJ5ACUUNM1diPdz2WoZ.AO/c3hFng5meDDxPTaKCZNzzelfwHM4Uy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-06 08:53:25', '2022-03-06 08:53:25'),
(26, 0, 0, 'Sola', 'Odesola', 'soldourn@yahoo.com', 0, '08145464999', '1970-01-01', 'Male', 1, '439889096158233444', '1', 1, 0, NULL, '$2y$10$0sjOjX5Jf4kCzLoWykwSue1GaxpMpzcPjq6YFwJgR3glE5itulHEy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-09 10:11:22', '2022-03-09 10:11:22'),
(28, 0, 0, '', '', '', 0, '09021212275', '', '', 1, '444548952594840920', NULL, 1, 0, NULL, '$2y$10$6tXsYqI52wOMlZsONiyf.ODgkuthHwFt4211JT0GWTiukTJO.0g9O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-24 11:31:40', '2022-06-24 11:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
CREATE TABLE IF NOT EXISTS `wallets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `balance` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `name`, `balance`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'deposit', '200', 0, '2021-12-04 06:14:44', '2022-02-09 10:12:27'),
(2, 2, 'deposit', '1640', 0, '2021-12-04 06:33:05', '2022-05-30 13:16:02'),
(3, 1, 'deposit', '0', 0, '2021-12-04 21:20:01', '2021-12-04 21:20:01'),
(4, 1, 'deposit', '0', 0, '2021-12-05 13:29:43', '2021-12-05 13:29:43'),
(5, 2, 'deposit', '0', 0, '2021-12-06 18:38:02', '2021-12-06 18:38:02'),
(6, 3, 'deposit', '2821.8', 0, '2021-12-06 18:40:39', '2022-07-25 12:01:53'),
(7, 4, 'deposit', '8.22', 0, '2021-12-06 20:40:51', '2021-12-06 20:40:51'),
(8, 5, 'deposit', '0', 0, '2021-12-18 23:01:16', '2021-12-18 23:01:16'),
(9, 6, 'deposit', '0', 0, '2021-12-18 23:06:48', '2021-12-18 23:06:48'),
(10, 7, 'deposit', '0', 0, '2021-12-18 23:10:56', '2021-12-18 23:10:56'),
(11, 8, 'deposit', '0', 0, '2021-12-18 23:11:28', '2021-12-18 23:11:28'),
(12, 9, 'deposit', '0', 0, '2021-12-18 23:12:04', '2021-12-18 23:12:04'),
(13, 10, 'deposit', '0', 0, '2021-12-18 23:12:54', '2021-12-18 23:12:54'),
(14, 11, 'deposit', '0', 0, '2021-12-18 23:13:54', '2021-12-18 23:13:54'),
(15, 12, 'deposit', '0', 0, '2021-12-18 23:15:33', '2021-12-18 23:15:33'),
(16, 13, 'deposit', '0', 0, '2021-12-18 23:17:39', '2021-12-18 23:17:39'),
(17, 14, 'deposit', '0', 0, '2021-12-20 05:16:23', '2021-12-20 05:16:23'),
(18, 15, 'deposit', '0', 0, '2021-12-20 05:16:56', '2021-12-20 05:16:56'),
(19, 16, 'deposit', '0', 0, '2022-01-19 03:40:39', '2022-01-19 03:40:39'),
(20, 17, 'deposit', '0', 0, '2022-01-19 10:40:34', '2022-01-19 10:40:34'),
(21, 18, 'deposit', '0', 0, '2022-02-09 08:00:41', '2022-02-09 08:00:41'),
(22, 19, 'deposit', '0', 0, '2022-02-14 10:54:14', '2022-02-14 10:54:14'),
(23, 20, 'deposit', '0', 0, '2022-02-22 16:58:19', '2022-02-22 16:58:19'),
(24, 21, 'deposit', '0', 0, '2022-02-22 21:14:48', '2022-02-22 21:14:48'),
(25, 22, 'deposit', '0', 0, '2022-02-24 09:36:59', '2022-02-24 09:36:59'),
(26, 6, 'float', '59', 0, '2022-02-24 15:12:27', '2022-02-24 15:19:55'),
(27, 23, 'deposit', '0', 0, '2022-02-25 09:38:11', '2022-02-25 09:38:11'),
(28, 24, 'deposit', '0', 0, '2022-03-03 19:27:17', '2022-03-03 19:27:17'),
(29, 25, 'deposit', '0', 0, '2022-03-06 08:53:25', '2022-03-06 08:53:25'),
(30, 26, 'deposit', '0', 0, '2022-03-09 10:11:22', '2022-03-09 10:11:22'),
(31, 28, 'deposit', '0', 0, '2022-06-24 11:31:40', '2022-06-24 11:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

DROP TABLE IF EXISTS `wallet_transactions`;
CREATE TABLE IF NOT EXISTS `wallet_transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `uuid` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prev_bal` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cur_bal` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
