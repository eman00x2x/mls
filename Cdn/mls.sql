-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 19, 2024 at 02:43 PM
-- Server version: 8.3.0
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mls`
--

-- --------------------------------------------------------

--
-- Table structure for table `mls_accounts`
--

DROP TABLE IF EXISTS `mls_accounts`;
CREATE TABLE IF NOT EXISTS `mls_accounts` (
  `account_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference_id` bigint NOT NULL DEFAULT '0',
  `account_type` varchar(50) NOT NULL,
  `logo` text,
  `company_name` varchar(150) DEFAULT NULL,
  `profession` varchar(150) DEFAULT NULL,
  `real_estate_license_number` varchar(150) DEFAULT NULL,
  `board_region` varchar(150) DEFAULT NULL,
  `local_board_name` varchar(200) DEFAULT NULL,
  `account_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `birthdate` varchar(50) DEFAULT NULL,
  `street` varchar(150) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `profile` text NOT NULL,
  `uploads` text COMMENT 'collection of filename uploaded json format',
  `preferences` text,
  `privileges` text COMMENT 'account privileges json format',
  `message_keys` text,
  `kyc_verified` int NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `registration_date` int NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1099 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_accounts`
--

INSERT INTO `mls_accounts` (`account_id`, `reference_id`, `account_type`, `logo`, `company_name`, `profession`, `real_estate_license_number`, `board_region`, `local_board_name`, `account_name`, `birthdate`, `street`, `city`, `province`, `mobile_number`, `email`, `tin`, `profile`, `uploads`, `preferences`, `privileges`, `message_keys`, `kyc_verified`, `status`, `registration_date`) VALUES
(1, 1, 'Administrator', 'http://cdn.mls/images/accounts/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg', 'EmanPO&Ntilde;', 'Real Estate Broker', '27431', NULL, NULL, '{\"prefix\":\"\",\"firstname\":\"Eman\",\"middlename\":\"Panas\",\"lastname\":\"Olivas\",\"suffix\":\"\"}', '1988-08-18', '55 Justice R jabson St Bambang', 'Pasig City', 'National Capital Region', '09175223499', 'eman00x2xx@gmail.com', '666-666-6663', '<p>test test test test</p>', '\"\"', '', '{\"max_post\":\"15\",\"max_users\":\"10\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', '{\"publicKey\":{\"crv\":\"P-256\",\"ext\":true,\"key_ops\":[],\"kty\":\"EC\",\"x\":\"jBlAwEAvA3JYbe-3WiMG8_X2K-HY1frmilJuaQfTWes\",\"y\":\"dxhiRHwAn92ivl-6JB4TItk4pOaDTI0xkikAru7KasU\"},\"privateKey\":{\"crv\":\"P-256\",\"d\":\"SXWnspSGKgeTbJopHRMBgQT9pf2OYo_QZzWe5FBvpvY\",\"ext\":true,\"key_ops\":[\"deriveKey\",\"deriveBits\"],\"kty\":\"EC\",\"x\":\"jBlAwEAvA3JYbe-3WiMG8_X2K-HY1frmilJuaQfTWes\",\"y\":\"dxhiRHwAn92ivl-6JB4TItk4pOaDTI0xkikAru7KasU\"}}', 0, 'active', 2147483647),
(4, 4, 'Real Estate Practitioner', 'http://cdn.mls/images/accounts/63644612977582993355262220530895691927503826826109_1fa693e8267edb06373b6b016f5ee7b7.png', 'Olivas Tech', 'Real Estate Broker', '87431', 'NCR', '(PRB) PASIG REAL ESTATE BOARD, INC.', '{\"prefix\":\"\",\"firstname\":\"Emmanuel\",\"middlename\":\"Panas\",\"lastname\":\"Olivas\",\"suffix\":\"\"}', '1988-08-18', '55 Justice R Jabson St Bambang', 'Pasig City', 'Metro Manila', '09175223499', 'eman.olivas@gmail.com', NULL, '0', '\"\"', NULL, '{\"max_post\":\"30\",\"max_users\":\"1\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', '{\"publicKey\":{\"crv\":\"P-256\",\"ext\":true,\"key_ops\":[],\"kty\":\"EC\",\"x\":\"tIl_QyMcNSxIsn0yOFa-s_uHYYRe5IfJhkcuu0qrgR0\",\"y\":\"dNcBTcv4gwvggvuCZymiW3Gt2X96Y6s6nJTDndE-BW4\"},\"privateKey\":{\"crv\":\"P-256\",\"d\":\"EMoiPzm8dgaaEjIb1hcbJVugwgRD5pjlpFlx2F9eBIg\",\"ext\":true,\"key_ops\":[\"deriveKey\",\"deriveBits\"],\"kty\":\"EC\",\"x\":\"tIl_QyMcNSxIsn0yOFa-s_uHYYRe5IfJhkcuu0qrgR0\",\"y\":\"dNcBTcv4gwvggvuCZymiW3Gt2X96Y6s6nJTDndE-BW4\"}}', 0, 'active', 2147483647),
(13, 0, 'Web Admin', 'http://cdn.mls//images/accounts/62431056605513408591884938382327130853331412768908_25b068b08614baf21ff7948e212a68ec.png', '1', 'Real Estate Consultant', '1', NULL, NULL, '{\"prefix\":\"\",\"firstname\":\"Web\",\"lastname\":\"Admin\",\"suffix\":\"\"}', '2024-02-26', '1', '1', '1', '1', 'webadmin@email.com', '1', '', '\"\"', NULL, '{\"max_post\":\"20\",\"max_users\":\"100\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', '{\"publicKey\":{\"crv\":\"P-256\",\"ext\":true,\"key_ops\":[],\"kty\":\"EC\",\"x\":\"FtJ8BrQcySMscdNY5aoTPbREuukKbsrYCV55IWizYg0\",\"y\":\"N3noFmcH8g5S8ihwsSd8iQnZGoD4G0-45S79X_1lwnk\"},\"privateKey\":{\"crv\":\"P-256\",\"d\":\"HT3cqkxFthmI0GQuuiL-UC8XPq7_0JGIq_VHOW-DXWk\",\"ext\":true,\"key_ops\":[\"deriveKey\",\"deriveBits\"],\"kty\":\"EC\",\"x\":\"FtJ8BrQcySMscdNY5aoTPbREuukKbsrYCV55IWizYg0\",\"y\":\"N3noFmcH8g5S8ihwsSd8iQnZGoD4G0-45S79X_1lwnk\"}}', 0, 'active', 1708955333),
(14, 0, 'Customer Service', 'http://cdn.mls//images/accounts/39458210912031056194403473478696932053484928515886_93bdc4f8d9d2671146f22a2827041f01.webp', '1', '1', '1', NULL, NULL, '{\"prefix\":\"\",\"firstname\":\"Customer\",\"lastname\":\"Service\",\"suffix\":\"\"}', '2024-02-26', '1', '1', '1', '1', 'customer_service@email.com', '1', '', '\"\"', NULL, '{\"max_post\":\"20\",\"max_users\":\"100\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', '{\"publicKey\":{\"crv\":\"P-256\",\"ext\":true,\"key_ops\":[],\"kty\":\"EC\",\"x\":\"u3RD_wnxQjp-yEDUCjgNPk0S_zEZR5PyAsoBj5PTHAU\",\"y\":\"tBGbTukoJZRhhqoJMf96PJB91xDd8709kKM-v_uwA6s\"},\"privateKey\":{\"crv\":\"P-256\",\"d\":\"Sfw5M-kZu4vbueezPGifWDA0veqAKUCDzz5-usGq1so\",\"ext\":true,\"key_ops\":[\"deriveKey\",\"deriveBits\"],\"kty\":\"EC\",\"x\":\"u3RD_wnxQjp-yEDUCjgNPk0S_zEZR5PyAsoBj5PTHAU\",\"y\":\"tBGbTukoJZRhhqoJMf96PJB91xDd8709kKM-v_uwA6s\"}}', 0, 'active', 1708955333);

-- --------------------------------------------------------

--
-- Table structure for table `mls_account_subscriptions`
--

DROP TABLE IF EXISTS `mls_account_subscriptions`;
CREATE TABLE IF NOT EXISTS `mls_account_subscriptions` (
  `account_subscription_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint NOT NULL,
  `premium_id` int NOT NULL,
  `subscription_date` int UNSIGNED NOT NULL DEFAULT '0',
  `subscription_start_date` int UNSIGNED NOT NULL DEFAULT '0',
  `subscription_status` tinyint(1) NOT NULL DEFAULT '1',
  `subscription_end_date` int UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_subscription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_account_subscriptions`
--

INSERT INTO `mls_account_subscriptions` (`account_subscription_id`, `account_id`, `transaction_id`, `premium_id`, `subscription_date`, `subscription_start_date`, `subscription_status`, `subscription_end_date`) VALUES
(1, 1, 1, 3, 1707623200, 1707623200, 1, 1710215200),
(2, 1, 2, 1, 1707623601, 1707623601, 1, 1710215601),
(3, 1, 3, 8, 1707637596, 1707637596, 1, 1710229596),
(4, 1, 4, 8, 1707637883, 1707637883, 1, 1710229883),
(6, 4, 0, 1, 1707647173, 1707647173, 1, 1710239173),
(7, 1, 7, 7, 1708011425, 1708011425, 0, 1710603425),
(8, 1, 8, 5, 1708781010, 1708781010, 0, 1711373010);

-- --------------------------------------------------------

--
-- Table structure for table `mls_articles`
--

DROP TABLE IF EXISTS `mls_articles`;
CREATE TABLE IF NOT EXISTS `mls_articles` (
  `article_id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(150) DEFAULT NULL,
  `title` text,
  `name` text,
  `banner` text,
  `content` int NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int NOT NULL,
  `created_at` int NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mls_deleted_threads`
--

DROP TABLE IF EXISTS `mls_deleted_threads`;
CREATE TABLE IF NOT EXISTS `mls_deleted_threads` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `thread_id` bigint NOT NULL,
  `account_id` bigint NOT NULL,
  `deleted_by` bigint NOT NULL,
  `deleted_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_deleted_threads`
--

INSERT INTO `mls_deleted_threads` (`id`, `thread_id`, `account_id`, `deleted_by`, `deleted_at`) VALUES
(2, 4, 1, 0, 1708089387);

-- --------------------------------------------------------

--
-- Table structure for table `mls_handshakes`
--

DROP TABLE IF EXISTS `mls_handshakes`;
CREATE TABLE IF NOT EXISTS `mls_handshakes` (
  `handshake_id` bigint NOT NULL AUTO_INCREMENT,
  `requestor_account_id` bigint NOT NULL,
  `requestor_details` text,
  `requestee_account_id` bigint NOT NULL,
  `listing_id` bigint NOT NULL,
  `handshake_status` varchar(10) DEFAULT 'pending',
  `handshake_status_date` int NOT NULL,
  `requested_date` int NOT NULL,
  PRIMARY KEY (`handshake_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_handshakes`
--

INSERT INTO `mls_handshakes` (`handshake_id`, `requestor_account_id`, `requestor_details`, `requestee_account_id`, `listing_id`, `handshake_status`, `handshake_status_date`, `requested_date`) VALUES
(8, 1, '{\n    \"account_id\": 1,\n    \"reference_id\": 1,\n    \"logo\": \"http:\\/\\/cdn.mls\\/images\\/accounts\\/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg\",\n    \"company_name\": \"EmanPO&Ntilde;\",\n    \"profession\": \"Real Estate Broker\",\n    \"real_estate_license_number\": 27431,\n    \"firstname\": \"Eman\",\n    \"lastname\": \"Olivas\",\n    \"birthdate\": \"1988-08-18\",\n    \"street\": \"55 Justice R jabson St Bambang\",\n    \"city\": \"Pasig City\",\n    \"province\": \"National Capital Region\",\n    \"mobile_number\": \"09175223499\",\n    \"email\": \"eman00x2xx@gmail.com\",\n    \"tin\": \"666-666-6663\",\n    \"profile\": \"<p>test test test test<\\/p>\",\n    \"kyc_verified\": 0,\n    \"status\": \"active\",\n    \"registration_date\": 2147483647\n}', 1, 1, 'done', 1708088481, 1708088451),
(9, 1, '{\n    \"account_id\": 1,\n    \"reference_id\": 1,\n    \"logo\": \"http:\\/\\/cdn.mls\\/images\\/accounts\\/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg\",\n    \"company_name\": \"EmanPO&Ntilde;\",\n    \"profession\": \"Real Estate Broker\",\n    \"real_estate_license_number\": 27431,\n    \"firstname\": \"Eman\",\n    \"lastname\": \"Olivas\",\n    \"birthdate\": \"1988-08-18\",\n    \"street\": \"55 Justice R jabson St Bambang\",\n    \"city\": \"Pasig City\",\n    \"province\": \"National Capital Region\",\n    \"mobile_number\": \"09175223499\",\n    \"email\": \"eman00x2xx@gmail.com\",\n    \"tin\": \"666-666-6663\",\n    \"profile\": \"<p>test test test test<\\/p>\",\n    \"kyc_verified\": 0,\n    \"status\": \"active\",\n    \"registration_date\": 2147483647\n}', 1, 2, 'denied', 1708089103, 1708089094),
(10, 1, '{\n    \"account_id\": 1,\n    \"reference_id\": 1,\n    \"logo\": \"http:\\/\\/cdn.mls\\/images\\/accounts\\/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg\",\n    \"company_name\": \"EmanPO&Ntilde;\",\n    \"profession\": \"Real Estate Broker\",\n    \"real_estate_license_number\": 27431,\n    \"firstname\": \"Eman\",\n    \"lastname\": \"Olivas\",\n    \"birthdate\": \"1988-08-18\",\n    \"street\": \"55 Justice R jabson St Bambang\",\n    \"city\": \"Pasig City\",\n    \"province\": \"National Capital Region\",\n    \"mobile_number\": \"09175223499\",\n    \"email\": \"eman00x2xx@gmail.com\",\n    \"tin\": \"666-666-6663\",\n    \"profile\": \"<p>test test test test<\\/p>\",\n    \"kyc_verified\": 0,\n    \"status\": \"active\",\n    \"registration_date\": 2147483647\n}', 4, 4, 'done', 1710819918, 1708089141),
(11, 1, '{\n    \"account_id\": 1,\n    \"reference_id\": 1,\n    \"logo\": \"http:\\/\\/cdn.mls\\/images\\/accounts\\/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg\",\n    \"company_name\": \"EmanPO&Ntilde;\",\n    \"profession\": \"Real Estate Broker\",\n    \"real_estate_license_number\": 27431,\n    \"firstname\": \"Eman\",\n    \"lastname\": \"Olivas\",\n    \"birthdate\": \"1988-08-18\",\n    \"street\": \"55 Justice R jabson St Bambang\",\n    \"city\": \"Pasig City\",\n    \"province\": \"National Capital Region\",\n    \"mobile_number\": \"09175223499\",\n    \"email\": \"eman00x2xx@gmail.com\",\n    \"tin\": \"666-666-6663\",\n    \"profile\": \"<p>test test test test<\\/p>\",\n    \"message_keys\": {\n        \"publicKey\": {\n            \"crv\": \"P-256\",\n            \"ext\": true,\n            \"key_ops\": [],\n            \"kty\": \"EC\",\n            \"x\": \"jBlAwEAvA3JYbe-3WiMG8_X2K-HY1frmilJuaQfTWes\",\n            \"y\": \"dxhiRHwAn92ivl-6JB4TItk4pOaDTI0xkikAru7KasU\"\n        },\n        \"privateKey\": {\n            \"crv\": \"P-256\",\n            \"d\": \"SXWnspSGKgeTbJopHRMBgQT9pf2OYo_QZzWe5FBvpvY\",\n            \"ext\": true,\n            \"key_ops\": [\n                \"deriveKey\",\n                \"deriveBits\"\n            ],\n            \"kty\": \"EC\",\n            \"x\": \"jBlAwEAvA3JYbe-3WiMG8_X2K-HY1frmilJuaQfTWes\",\n            \"y\": \"dxhiRHwAn92ivl-6JB4TItk4pOaDTI0xkikAru7KasU\"\n        }\n    },\n    \"kyc_verified\": 0,\n    \"status\": \"active\",\n    \"registration_date\": 2147483647\n}', 1, 3, 'pending', 1710820066, 1710820066);

-- --------------------------------------------------------

--
-- Table structure for table `mls_kyc`
--

DROP TABLE IF EXISTS `mls_kyc`;
CREATE TABLE IF NOT EXISTS `mls_kyc` (
  `kyc_id` bigint NOT NULL AUTO_INCREMENT,
  `account_id` bigint NOT NULL,
  `documents` text NOT NULL,
  `kyc_status` tinyint(1) NOT NULL COMMENT '0=pending, 1=verified, 2=denied, 3=expired',
  `id_expiration_date` date NOT NULL,
  `verified_by` varchar(100) DEFAULT NULL,
  `verified_at` int NOT NULL,
  `created_at` int NOT NULL,
  PRIMARY KEY (`kyc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mls_kyc`
--

INSERT INTO `mls_kyc` (`kyc_id`, `account_id`, `documents`, `kyc_status`, `id_expiration_date`, `verified_by`, `verified_at`, `created_at`) VALUES
(1, 1, '{\"kyc\":{\"selfie\":\"http:\\/\\/cdn.mls\\/public\\/kyc\\/1\\/25204571608383740508772462222517154777626165555225_fce36dd9b98a05edbe77f5fba82cc81b.png\",\"id\":\"http:\\/\\/cdn.mls\\/public\\/kyc\\/1\\/39098600953502751457358001019252366465063925400983_fce36dd9b98a05edbe77f5fba82cc81b.jpg\"}}', 1, '2025-03-13', 'Eman Olivas', 1709432660, 1709345258),
(2, 1, '{\"kyc\":{\"selfie\":\"http:\\/\\/cdn.mls\\/public\\/kyc\\/1\\/91943892920714292838012030665682991963009301802175_20ca271fc8fa68c2d1d351cecdcfb5f0.png\",\"id\":\"http:\\/\\/cdn.mls\\/public\\/kyc\\/1\\/19207826462546779180081460836373912860189051914235_20ca271fc8fa68c2d1d351cecdcfb5f0.webp\"}}', 0, '0000-00-00', NULL, 0, 1709434479);

-- --------------------------------------------------------

--
-- Table structure for table `mls_leads`
--

DROP TABLE IF EXISTS `mls_leads`;
CREATE TABLE IF NOT EXISTS `mls_leads` (
  `lead_id` bigint NOT NULL AUTO_INCREMENT,
  `listing_id` bigint NOT NULL,
  `account_id` bigint NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `mobile_no` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `message` text,
  `preferences` text,
  `inquire_at` int NOT NULL,
  PRIMARY KEY (`lead_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mls_leads`
--

INSERT INTO `mls_leads` (`lead_id`, `listing_id`, `account_id`, `name`, `mobile_no`, `email`, `message`, `preferences`, `inquire_at`) VALUES
(1, 1, 1, 'eman olivas', '09175223499', 'eman.olivas@gmail.com', 'test inquiry', '{\"type\":\"Residential\",\"bedroom\":\"3\",\"bathroom\":\"2\",\"parking\":\"3\",\"lot_area\":\"200\",\"category\":\"House and Lot\",\"address\":{\"barangay\":\"\",\"municipality\":\"\",\"province\":\"\",\"region\":\"\"}}', 1706859656),
(2, 1, 1, 'eman olivas', '09175223499', 'eman.olivas@gmail.com', 'test inquiry', '{\"type\":\"Residential\",\"category\":\"House and Lot\",\"address \":{\"barangay\":\"\",\"municipality\":\"Pasig City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"},\"lot_area\":\"200\",\"bedroom\":\"3\",\"bathroom\":\"2\",\"parking\":\"3\"}', 1706859656);

-- --------------------------------------------------------

--
-- Table structure for table `mls_license_reference`
--

DROP TABLE IF EXISTS `mls_license_reference`;
CREATE TABLE IF NOT EXISTS `mls_license_reference` (
  `reference_id` bigint NOT NULL AUTO_INCREMENT,
  `broker_prc_license_id` varchar(150) DEFAULT NULL,
  `created_at` int NOT NULL,
  PRIMARY KEY (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_license_reference`
--

INSERT INTO `mls_license_reference` (`reference_id`, `broker_prc_license_id`, `created_at`) VALUES
(1, '27431', 1697967993),
(3, '274312', 1707047783),
(4, '87431', 1707224266);

-- --------------------------------------------------------

--
-- Table structure for table `mls_listings`
--

DROP TABLE IF EXISTS `mls_listings`;
CREATE TABLE IF NOT EXISTS `mls_listings` (
  `listing_id` int NOT NULL AUTO_INCREMENT,
  `account_id` bigint NOT NULL,
  `is_mls` tinyint(1) NOT NULL DEFAULT '0',
  `is_mls_option` text,
  `is_website` tinyint(1) NOT NULL DEFAULT '0',
  `offer` varchar(50) DEFAULT NULL COMMENT 'for sale, for rent',
  `type` varchar(100) NOT NULL COMMENT 'Residential, Commercial',
  `foreclosed` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tags` text COMMENT 'foreclosure, new, old, fully furnished, bare, semi-furnished',
  `long_desc` longtext,
  `category` varchar(150) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `price` bigint NOT NULL,
  `reservation` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `monthly_downpayment` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `monthly_amortization` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `payment_details` text,
  `floor_area` int UNSIGNED NOT NULL DEFAULT '0',
  `lot_area` int UNSIGNED NOT NULL DEFAULT '0',
  `unit_area` int UNSIGNED NOT NULL,
  `bedroom` int UNSIGNED NOT NULL DEFAULT '0',
  `bathroom` int UNSIGNED NOT NULL DEFAULT '0',
  `parking` int UNSIGNED NOT NULL DEFAULT '0',
  `thumb_img` text,
  `video` text,
  `amenities` text,
  `other_details` text,
  `date_added` int UNSIGNED NOT NULL DEFAULT '0',
  `last_modified` int UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = available, 2 = sold, 3 = removed',
  `sold_price` int NOT NULL DEFAULT '0',
  `duration` int NOT NULL,
  `display` tinyint UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = show, 2 = hidden',
  PRIMARY KEY (`listing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1101 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mls_listings`
--

INSERT INTO `mls_listings` (`listing_id`, `account_id`, `is_mls`, `is_mls_option`, `is_website`, `offer`, `type`, `foreclosed`, `name`, `title`, `tags`, `long_desc`, `category`, `address`, `price`, `reservation`, `monthly_downpayment`, `monthly_amortization`, `payment_details`, `floor_area`, `lot_area`, `unit_area`, `bedroom`, `bathroom`, `parking`, `thumb_img`, `video`, `amenities`, `other_details`, `date_added`, `last_modified`, `status`, `sold_price`, `duration`, `display`) VALUES
(1, 1, 1, NULL, 1, 'for sale', 'Residential', 0, 'samplesss', 'samplesss', '[\"New\"]', '<p>sample esar&nbsp;</p>', 'Condominium', '{\"barangay\":\"\",\"municipality\":\"Pasig City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', 16000000, 100000.00, 600000.00, 80000.00, NULL, 233, 2589, 233, 4, 2, 2, 'http://cdn.mls/images/listings/18362362385124463689010255540495713831578558815919_0bd3dfef0e2e42824866367511e1ea81.webp', NULL, 'Lap Pool,Bowling Room,Basket Ball Court,Game rooms,Day care centers,Lobby,Club House,Function Halls,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"com_share\":\"2\"}', 1698849808, 1707745112, 1, 0, 0, 1),
(2, 1, 1, NULL, 0, 'for sale', 'Residential', 0, 'test', 'test', '[\"New\",\"Pre Owned\"]', '<p>test</p>', 'House and Lot', '{\"barangay\":\"Sipac-Almacen\",\"municipality\":\"Navotas City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', 1500000, 20000.00, 56000.00, 85000.00, NULL, 0, 0, 0, 0, 0, 0, 'http://cdn.mls//images/listings/20589086521943721573908927020568652944736005968973_0d2ddc51bced3a7da9c49208c52c1167.webp', NULL, 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"com_share\":\"2\"}', 1699018530, 1706408975, 1, 0, 0, 1),
(3, 1, 1, '{\"local_board\":0,\"local_region\":0,\"all\":1}', 1, 'for sale', 'Residential', 0, 'modern-2-storey-5-bedrooms-alabang-400-village-muntinlupa-city', 'Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City', '[\"New\"]', '<p>5 bedrooms with toilet and bath</p>\r\n<ul>\r\n<li>walk in closet in bedrooms upstairs</li>\r\n<li>ensuite in all bedrooms</li>\r\n<li>bathtub in master&rsquo;s bedroom</li>\r\n<li>airconditioning in 4 rooms and living area</li>\r\n<li>hot and cold water system</li>\r\n</ul>\r\n<p>25m frontage</p>\r\n<p>Built 2010</p>\r\n<p>3 elevated under cover garage</p>\r\n<p>High ceiling</p>\r\n<p>Open plan concept</p>\r\n<p>Balcony at rear</p>\r\n<p>Pantry room</p>\r\n<p>Big garden</p>\r\n<p>SP: 35 M gross</p>\r\n<p>Clean title</p>\r\n<p>RFS: family migrating to Australia</p>', 'House and Lot', '{\"barangay\":\"New Alabang Village\",\"municipality\":\"Muntinlupa City\",\"province\":\"Metro Manila\",\"region\":\"NCR\",\"street\":\"\",\"village\":\"\"}', 1500000, 20000.00, 56000.00, 85000.00, '{\"option_money_duration\":\"15\",\"payment_mode\":\"Installment\",\"tax_allocation\":\"Seller Agrees to Pay Capital Gains Tax and Buyer Pays Transfer Tax\",\"bank_loan\":0,\"pagibig_loan\":0,\"assume_balance\":0}', 300, 412, 0, 5, 5, 2, 'http://cdn.mls/images/listings/34386680823233921755628498012360148501361322493813_7e12b9298c1869571ac20626b9bbb411.webp', 'https://www.youtube.com/watch?v=jwyBh01Pwrw', 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"authority_to_sell_expiration\":\"2024-03-19\",\"com_share\":\"1.5\"}', 1699019091, 1710850025, 1, 1500000, 1710824821, 1),
(4, 4, 1, '{\"local_board\":0,\"local_region\":0,\"all\":0}', 0, 'for sale', 'Residential', 0, 'testing', 'testing', '[\"New\"]', '<p>test</p>', 'House and Lot', '{\"barangay\":\"Lower Sulitan\",\"municipality\":\"Naga\",\"province\":\"Zamboanga Sibugay\",\"region\":\"Region IX\",\"street\":\"\",\"village\":\"\"}', 1500000, 20000.00, 56000.00, 85000.00, '{\"option_money_duration\":\"15\",\"payment_mode\":\"Installment\",\"tax_allocation\":\"Seller Agrees to Pay Capital Gains Tax and Buyer Pays Transfer Tax\",\"bank_loan\":0,\"pagibig_loan\":0,\"assume_balance\":0}', 0, 0, 0, 0, 0, 0, 'http://cdn.mls/images/listings/55141816083775074918346737185762835964551378384965_ae7a8e233176ecb7a64763d494530f5a.webp', NULL, 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"authority_to_sell_expiration\":1710864000,\"com_share\":\"2\"}', 1699019712, 1710857404, 1, 1500000, 1710832197, 1),
(1099, 1, 1, NULL, 1, 'for sale', 'Residential', 0, 'modern-2-storey-5-bedrooms-alabang-400-village-muntinlupa-city', 'Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City', '[\"New\"]', '<p>5 bedrooms with toilet and bath</p>\r\n<ul>\r\n<li>walk in closet in bedrooms upstairs</li>\r\n<li>ensuite in all bedrooms</li>\r\n<li>bathtub in master&rsquo;s bedroom</li>\r\n<li>airconditioning in 4 rooms and living area</li>\r\n<li>hot and cold water system</li>\r\n</ul>\r\n<p>25m frontage</p>\r\n<p>Built 2010</p>\r\n<p>3 elevated under cover garage</p>\r\n<p>High ceiling</p>\r\n<p>Open plan concept</p>\r\n<p>Balcony at rear</p>\r\n<p>Pantry room</p>\r\n<p>Big garden</p>\r\n<p>SP: 35 M gross</p>\r\n<p>Clean title</p>\r\n<p>RFS: family migrating to Australia</p>', 'House and Lot', '{\"barangay\":\"New Alabang Village\",\"municipality\":\"Muntinlupa City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', 1500000, 20000.00, 56000.00, 85000.00, '{\"option_money_duration\":\"15\",\"payment_mode\":\"Installment\",\"tax_allocation\":\"Seller Agrees to Pay Capital Gains Tax and Buyer Pays Transfer Tax\",\"bank_loan\":\"0\",\"pagibig_loan\":\"0\",\"assume_balance\":\"0\"}', 300, 412, 0, 5, 5, 2, 'http://localhost/mls/cdn/images/listings/34386680823233921755628498012360148501361322493813_7e12b9298c1869571ac20626b9bbb411.webp', 'https://www.youtube.com/watch?v=jwyBh01Pwrw', 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"com_share\":\"\"}', 1699019091, 1710575599, 1, 0, 0, 1),
(1100, 1, 1, NULL, 1, 'for sale', 'Residential', 0, 'modern-2-storey-5-bedrooms-alabang-400-village-muntinlupa-city', 'Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City', '[\"New\"]', '<p>5 bedrooms with toilet and bath</p>\r\n<ul>\r\n<li>walk in closet in bedrooms upstairs</li>\r\n<li>ensuite in all bedrooms</li>\r\n<li>bathtub in master&rsquo;s bedroom</li>\r\n<li>airconditioning in 4 rooms and living area</li>\r\n<li>hot and cold water system</li>\r\n</ul>\r\n<p>25m frontage</p>\r\n<p>Built 2010</p>\r\n<p>3 elevated under cover garage</p>\r\n<p>High ceiling</p>\r\n<p>Open plan concept</p>\r\n<p>Balcony at rear</p>\r\n<p>Pantry room</p>\r\n<p>Big garden</p>\r\n<p>SP: 35 M gross</p>\r\n<p>Clean title</p>\r\n<p>RFS: family migrating to Australia</p>', 'House and Lot', '{\"barangay\":\"New Alabang Village\",\"municipality\":\"Muntinlupa City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', 1500000, 20000.00, 56000.00, 85000.00, '{\"option_money_duration\":\"15\",\"payment_mode\":\"Installment\",\"tax_allocation\":\"Seller Agrees to Pay Capital Gains Tax and Buyer Pays Transfer Tax\",\"bank_loan\":\"0\",\"pagibig_loan\":\"0\",\"assume_balance\":\"0\"}', 300, 412, 0, 5, 5, 2, 'http://localhost/mls/cdn/images/listings/34386680823233921755628498012360148501361322493813_7e12b9298c1869571ac20626b9bbb411.webp', 'https://www.youtube.com/watch?v=jwyBh01Pwrw', 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"com_share\":\"\"}', 1699019091, 1710575599, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mls_listings_view`
--

DROP TABLE IF EXISTS `mls_listings_view`;
CREATE TABLE IF NOT EXISTS `mls_listings_view` (
  `listing_view_id` bigint NOT NULL AUTO_INCREMENT,
  `listing_id` bigint UNSIGNED NOT NULL,
  `account_id` bigint NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `created_at` int UNSIGNED NOT NULL DEFAULT '0',
  `user_agent` text COMMENT 'user agent info',
  PRIMARY KEY (`listing_view_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_listings_view`
--

INSERT INTO `mls_listings_view` (`listing_view_id`, `listing_id`, `account_id`, `session_id`, `created_at`, `user_agent`) VALUES
(3, 4, 4, 'd0vr9m3aero1dh048k7n1ql7sm', 1709563036, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}'),
(4, 4, 4, 'ev0th8k0vq68nv03kn2n1q2lm9', 1709563090, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}'),
(5, 4, 4, '4mfn0taeuviutt91iv86389ir9', 1709563422, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}'),
(6, 4, 4, 'i8omvee7tq1vnmshrus0ifhdau', 1709563603, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}'),
(7, 4, 4, 'u45n927gu886fbr3o58hslrfgm', 1709563630, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}'),
(8, 4, 4, 'bk2q0emg25qhrb8a9h1nep6qed', 1709566992, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}'),
(9, 4, 4, 'jrk92c0pmbnt0ba9nhluhu6uhc', 1709643237, '{\"ip_address\":\"180.190.40.23\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}'),
(10, 3, 1, 'jrk92c0pmbnt0ba9nhluhu6uhc', 1709643237, '{\"ip_address\":\"180.190.40.23\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}'),
(11, 3, 1, 'jrk92c0pmbnt0ba9nhluhu6uhc', 1709643237, '{\"ip_address\":\"180.190.40.23\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}'),
(12, 3, 1, 'jrk92c0pmbnt0ba9nhluhu6uhc', 1709643237, '{\"ip_address\":\"180.190.40.23\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}'),
(13, 1, 1, 'jrk92c0pmbnt0ba9nhluhu6uhc', 1709643237, '{\"ip_address\":\"180.190.40.23\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}'),
(14, 3, 1, '6f7h4843e6ci1cbcteff1voojj', 1709975461, '{\"ip_address\":\"180.190.33.61\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}'),
(15, 3, 1, '8r8ps8c11k6gc7vqapalq637ti', 1710422088, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(16, 3, 1, 'pou120n1toqha7ptcrgv4jojp5', 1710422607, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(17, 3, 1, 'fo2081trj54t9k1mmok1nsie9c', 1710424411, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 6.0; Nexus 5 Build\\/MRA58N) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Mobile Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(18, 3, 1, 'uvg752cmt0vi8e9pljimq50mlb', 1710426227, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(19, 3, 1, 'm9h2itfbho41jgb1hbt25dstu0', 1710503585, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(20, 3, 1, 'i366ep422uhsc63n7ci0r4abqo', 1710505459, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(21, 3, 1, '9j7cr4im7cv4d8ijumu05tgvtd', 1710507265, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(22, 3, 1, 'sfevmuk79e49j0ii9fuvb66d8o', 1710510550, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(23, 3, 1, 'glhcek3072gl6lcto3h2uchk4k', 1710511192, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(24, 3, 1, 'q7oo2qr6nbrlmili7f37b88ncm', 1710513000, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 8.0.0; SM-G955U Build\\/R16NW) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/116.0.0.0 Mobile Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(25, 3, 1, 'mnol2d94r0cj7ju0t8vb0kfpm6', 1710514806, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(26, 3, 1, 'emdssrm2hnk4imh729t21nesim', 1710516657, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(27, 3, 1, 'knirms33cf5df23v356jcnhb6f', 1710516658, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(28, 3, 1, 'lkd2r2abkovm5c1r3ssn1l898i', 1710518460, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(29, 3, 1, '1396eo0e5svqfoa97n4uob04le', 1710520280, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(30, 3, 1, 'p70sicijbmucpj7osli3e0ms72', 1710520281, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(31, 3, 1, '2kg1gdl0j3fe3nm66hpkmfe8it', 1710520281, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(32, 3, 1, 'i9c2q8dgrvuguc8eg9tpg26e8l', 1710522133, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 8.0.0; SM-G955U Build\\/R16NW) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/116.0.0.0 Mobile Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(33, 3, 1, 'm85k91dib32247tjrc2v284f1r', 1710522135, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 8.0.0; SM-G955U Build\\/R16NW) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/116.0.0.0 Mobile Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(34, 3, 1, 'ljnukm5ldqqeh60b4f50nm71be', 1710522134, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 8.0.0; SM-G955U Build\\/R16NW) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/116.0.0.0 Mobile Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(35, 3, 1, 'e49e3pugvaahmnod7r4t16g2a6', 1710522135, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 8.0.0; SM-G955U Build\\/R16NW) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/116.0.0.0 Mobile Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(36, 3, 1, '9seh059r1l444qpcnn85ofd3ko', 1710522135, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 8.0.0; SM-G955U Build\\/R16NW) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/116.0.0.0 Mobile Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(37, 3, 1, 'bl9r68818hfmf5ip9d9ushoqpl', 1710522122, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(38, 3, 1, '0m9v8ei6n0gte0vbqril0s6vjc', 1710573860, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(39, 3, 1, '2shel0vstfnjbi9cdg2kqoo535', 1710575607, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 8.0.0; SM-G955U Build\\/R16NW) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/116.0.0.0 Mobile Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(40, 3, 1, '9qmtiltsa942cet43qse9ihpur', 1710579035, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(41, 3, 1, 'vk8f3fe7idvusu9g2jqg3d0d52', 1710581346, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(42, 3, 1, 'gr8hsog7h5kk4cd12jem18epoo', 1710583433, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(43, 1, 1, 'il0utsl9k4n3rlv44o37s08af5', 1710588648, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(44, 3, 1, 'miiaiuiqr99k5u7e24c3lu7bcg', 1710590549, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(45, 3, 1, '9brmg5vokq8si4stgr022n4rrm', 1710652479, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 12; SM-G973F) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/104.0.5112.81 Mobile Safari\\/537.36 EdgA\\/104.0.1293.47\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(46, 3, 1, 'c4fe6urajkiqna9pdjaf28c8k4', 1710655574, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 12; SM-G973F) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/104.0.5112.81 Mobile Safari\\/537.36 EdgA\\/104.0.1293.47\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(47, 3, 1, 'k6bjacqps2drgfa4ust1dv52h7', 1710767299, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(48, 1, 1, 'pv2jorasghiqa5k854056o6k80', 1710773576, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 6.0; Nexus 5 Build\\/MRA58N) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Mobile Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(49, 3, 1, 'd8q06tbb3d8rupu7droe51k4v8', 1710774251, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 6.0; Nexus 5 Build\\/MRA58N) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Mobile Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(50, 3, 1, 'bs288mbku05cvi07rr5rpnupo0', 1710776236, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(51, 3, 1, '568iobe1ivhr8mfd1g2vkf4ogi', 1710780375, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 6.0; Nexus 5 Build\\/MRA58N) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Mobile Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(52, 4, 4, 'hn9ad58e4mnrtvu2lusumovh7l', 1710818981, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(53, 3, 1, 'iht0q6k95el3017uu2qds79p2k', 1710819036, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(54, 4, 4, 'o6k61m9m8fp4nsu4p5e821rkuv', 1710820055, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(55, 3, 1, 'sc7mp9p0qqiutninuoleaem6pa', 1710842945, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `mls_listing_images`
--

DROP TABLE IF EXISTS `mls_listing_images`;
CREATE TABLE IF NOT EXISTS `mls_listing_images` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `listing_id` int UNSIGNED NOT NULL,
  `filename` text NOT NULL,
  `url` text,
  `img_sort` int UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mls_listing_images`
--

INSERT INTO `mls_listing_images` (`image_id`, `listing_id`, `filename`, `url`, `img_sort`) VALUES
(7, 3, '34386680823233921755628498012360148501361322493813_7e12b9298c1869571ac20626b9bbb411.webp', 'http://cdn.mls/images/listings/34386680823233921755628498012360148501361322493813_7e12b9298c1869571ac20626b9bbb411.webp', 0),
(8, 2, '20589086521943721573908927020568652944736005968973_0d2ddc51bced3a7da9c49208c52c1167.webp', 'http://cdn.mls/images/listings/20589086521943721573908927020568652944736005968973_0d2ddc51bced3a7da9c49208c52c1167.webp', 0),
(9, 4, '55141816083775074918346737185762835964551378384965_ae7a8e233176ecb7a64763d494530f5a.webp', 'http://cdn.mls/images/listings/55141816083775074918346737185762835964551378384965_ae7a8e233176ecb7a64763d494530f5a.webp', 0),
(10, 1, '18362362385124463689010255540495713831578558815919_0bd3dfef0e2e42824866367511e1ea81.webp', 'http://cdn.mls/images/listings/18362362385124463689010255540495713831578558815919_0bd3dfef0e2e42824866367511e1ea81.webp', 0),
(11, 1, '08727719958453902996578431294579241074755850732285_72855679eaadf95e996830ee8ae33ad9.jpg', 'http://cdn.mls/images/listings/08727719958453902996578431294579241074755850732285_72855679eaadf95e996830ee8ae33ad9.jpg', 0),
(12, 1, '33526072625587133180001152096533560143993095703647_72855679eaadf95e996830ee8ae33ad9.jpg', 'http://cdn.mls/images/listings/33526072625587133180001152096533560143993095703647_72855679eaadf95e996830ee8ae33ad9.jpg', 0),
(13, 1, '91763630261513643208121732099193049217297872034275_72855679eaadf95e996830ee8ae33ad9.jpg', 'http://cdn.mls/images/listings/91763630261513643208121732099193049217297872034275_72855679eaadf95e996830ee8ae33ad9.jpg', 0),
(14, 3, '16354219839881729431334547657720509045179457828729_386c4583ff913e2cd063039c0a6cb08c.jpg', 'http://cdn.mls/images/listings/16354219839881729431334547657720509045179457828729_386c4583ff913e2cd063039c0a6cb08c.jpg', 0),
(15, 3, '40036738316500432847953731045559235400007905818371_386c4583ff913e2cd063039c0a6cb08c.jpg', 'http://cdn.mls/images/listings/40036738316500432847953731045559235400007905818371_386c4583ff913e2cd063039c0a6cb08c.jpg', 0),
(16, 3, '75921306028233973889479449000303587914537788378067_386c4583ff913e2cd063039c0a6cb08c.jpg', 'http://cdn.mls/images/listings/75921306028233973889479449000303587914537788378067_386c4583ff913e2cd063039c0a6cb08c.jpg', 0),
(18, 3, '75880370339576424995116784677342901921213450313865_b22e1a32d31d1c1a0673fe8a977312a3.jpg', 'http://cdn.mls/images/listings/75880370339576424995116784677342901921213450313865_b22e1a32d31d1c1a0673fe8a977312a3.jpg', 0),
(19, 3, '62714655116714197158520374833502503669544566697559_e0b3a2c2d43c837fb9cd72612bd43671.png', 'http://localhost/mls/cdn/images/listings/62714655116714197158520374833502503669544566697559_e0b3a2c2d43c837fb9cd72612bd43671.png', 0),
(20, 3, '24270519438801861524387497398398014828545887521052_e0b3a2c2d43c837fb9cd72612bd43671.png', 'http://localhost/mls/cdn/images/listings/24270519438801861524387497398398014828545887521052_e0b3a2c2d43c837fb9cd72612bd43671.png', 0),
(21, 3, '65324395353060273378684030499529474601556376711693_e0b3a2c2d43c837fb9cd72612bd43671.png', 'http://localhost/mls/cdn/images/listings/65324395353060273378684030499529474601556376711693_e0b3a2c2d43c837fb9cd72612bd43671.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mls_messages`
--

DROP TABLE IF EXISTS `mls_messages`;
CREATE TABLE IF NOT EXISTS `mls_messages` (
  `message_id` bigint NOT NULL AUTO_INCREMENT,
  `thread_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `iv` text,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_messages`
--

INSERT INTO `mls_messages` (`message_id`, `thread_id`, `user_id`, `content`, `is_read`, `iv`, `created_at`) VALUES
(1, 3, 1, 'WXl1lLEUDGLS8cMYCAWfGqUo64TivgJl6tyPOsXmQPyGRPg/OA/KHwTIFdFsNKDBOkbZ0NKaLSE3bUX+QGlgN1Xr3E4o9VguWC0hql4uHNkbJklj4NeueHGD2CAg+ogAjhFbVqlSiGZHSeDEYJ7esxDwsf7pj2RnPW8z2Y2pvUZXb168bg12RKzfIem5qamYUKNIVP8tXbyMpo7DqW2aDTeXJ/8wf/NM0AM=', 1, 'MTcxMDA2MzczOTM1Nw==', 1710063739),
(2, 3, 1, 'pTSzHyDNsU4zT2xYuRuslXiq0hwy2VLO6K/IWobvmMQt/19ohgyMjKmGBCx2Kc6sOiZzlbk7tM4tZiFQl9T/jHhAqs2BQKlwNou7Vp0NSdJXdbedDX07Sp5t99w1tHX7AHV5xG8DNxVGTfek8QLAprOt9W1mZrxGHt89kWF3D5hVyz3tgP4oCd1RncywS1EGIc9DPhfggJlRxBARdLscyIhFUahwbv42MpmMHnj2G0w6GTXU96zLEg==', 1, 'MTcxMDA2MzgyOTcwOA==', 1710063829),
(4, 3, 1, 'kZB/pZ2TIbZpIqt78lxUHnpuyCmu4FgUnCQCHGUN0gwSWSf5uV4QPPmlbQoLz01tleLeA7Wr+UJnDaaz865OJgjEcaaNT0o922V9AQEqN2MQK7K3C9etjuJ+5vom0k38LzP2SbnhQEWd3nQXwb88velmpk+N32L3Wf5UAXDCt+AqLLgCe+EJzZGURW7ISg==', 1, 'MTcxMDA2NDg3NjAzNw==', 1710064876),
(5, 3, 1, '9Pn4gg3dqbLYRxCgLgT8gNuKdzVLRoShQXQLqxOJcTyRVwSzwgxYJB/hAeqfLRdI/WAhJEJ747PLd9K8Jto77bZZQt+id/78SKRzl/FVBFAhGjOKmnw8nsO/O7FhNc/aUvCgk/DbQbswMmBCwwnBOxIT8Tafeum+RUM1y7czvm6tRQxnc6uahas5gH/EgJTqx85t06hCPiv8+PcBlgYgOaqc7co09l+6S3c6hKJ2sSLdLN7ntFSNAO2ppDAC3eAvg0c=', 1, 'MTcxMDA2Njc0NTIwOQ==', 1710066745),
(6, 3, 1, 'xIEH/Wbogt1cW3bnHvtzPTxPiMLQESaCZBJcMkKP2t038EDs/vJ7GCR5F7xjoPkQEyc2mmBs1pPqJ3UfhWkVoGANpEVwVNm57sRBnxbQXXH9gB0b2qj1ummqZvgJJOcBFDnVh6Afl6aiwIzu7xg4LWZtDR5PyUZ/HHQYafp9dtOnGwwBdniL87NKhgrlLlW2XZyalNuKoLLprOrXk7NYDHPy4DyKWqlTpxUxZXJmx2P01ZYgdDQxRjSL/qIBb3fYKil9t9uwsDh8P8VxAzP6hXgV2NIgOBUZt5XESpuUmQdWFKMPSnFl7B4W9d+SXQqCtEDKEHw65w9eeBeZe4pn+/1RFVUVE5dWOoQcakvhJgeketnpY1dKX6Zds5IvunNCWi6Dn7x1FqMueru9m3a44he/qF05rZu+UNYk23W/GCTf1NGbwAhAPmkVlWpjlp8FXMwRXsOqMZwm0cIFA3MXCIp6gwWDmd0WgOrma+8rggxBBskl/hgfb8qPJMcGbqsDt1nv0gqNOiRt5O/W+Z+Xbl69glzhFzkFT6SFLpfaEgvQfyQTbQfjhklBAS+NPnJ5aCXSubHpVhldjnFUuONvtU/g4yHUOZsTIb6aml6MHK1J5ubYdC+A899dR53eV2ZlSPvS/eGuSsSH4YGsQi9pGRqfNlMFNW+Zgp3gml2MB6itdMiRZEXFGv/tyXxtVbfqnRgPENAIClfs1fxNdRZZYVYr8WuZmWjNvnZOZwbrcnwtLgaU+ZEJNrQy5cOpq7cf8i3pRId3oao9W3BkwF5KkMg3n3JBMt/FdtuIInVYijD0cC0spYJv8JiYKsus+x1X3mRlXbFxDSnF6ORUQRu42HymRxbRp67PfZwlBtsBIcgGOFmJnNKpnQBzXThmmgqjHFBAVHf1tEwiprHmk8GiJO1Xijm5v0qYYIL6OSK1QmI=', 1, 'MTcxMDA2Njc2MDc2OA==', 1710066760),
(10, 3, 1, 'WbMmMzur2QaB/nOy3CBvFcv9jEYplK00/Csa/ydbFwn2uzZ1uOxWf3OkF7kYqejOPzcO+uPOtpQIrcvVH2FfHCvsnziRUcgb64VGNayfWj/PZeNEcdcwhDq/6Ld/wG529VsWvepqFfcXSL94aErY5LYRu9vHXrzq26d6bNGnOjiU3FmhJVY46L+5LEI225ms2gzXxEaJ9/vukdNQKU/HCT+dpLcCRHc0ShZOD36tb1YBQYNxap9gXQn8GrXfHBYLX3mpH2WrigNWtTioJk9Av7aQPwWxroiaNMZlqV8cVYf7sY4JxduAo3YlaqpxPCVQrflNuZdNkRVaH5M24AsvrVfFdF2eN2/IeQ+HP6CE', 1, 'MTcxMDA2Nzg3MDI5Mw==', 1710067870),
(11, 3, 1, 'NUg3mQPfPdt/nMslADtS1RxJ5oQKnRawubd1t/00SZzq9QzoEH8HVWI1k/x7l9l95FL1a72nwYNEJRfO32yTcfAUw90MnEdYDdZ6SMx0JRdsvWHy4Gepw2kou1WeDZSe6ycrQcyBDCfGVQ==', 1, 'MTcxMDA2Nzk1NzgxMg==', 1710067957),
(12, 3, 1, '0surApsFkCL6K8STIPh+OOHNjl/zQiAKBlz65s7UbC7QXvySy9ZgoVnV8bRH7S7xAuz8iesDA0Av4eOMts3VB8l5rJX0JQMDee7BH8z+qRxK6+FqrN4ry5eDzTWvLXXWEhuf9NA8sPrYSb2vdS2ylKwv7pzPJCLZv78j+hBTmToCfTZk', 1, 'MTcxMDA2ODE3MDgwOA==', 1710068170),
(13, 3, 1, 'exWnosavES5Dqzem9WRTQOSyD2vGw1WS1jUnbria3IcLP9a42DRiEPvE8OgBO9sFufTwZyCYHOZQd0bdQK/MhfL5YwkiH/MEjh7M64NCR9vSsz9W7kB9t9oUiivC0km2IjWZF8mrLrGefDd0JGdRWRUjSB39iv7plz1fEisIQTt0LtjQCAkU5JXtbbu1FrsPTaKfmtrwkxvYAnYvmeQwS4FA', 1, 'MTcxMDA2ODI0NTQ0OQ==', 1710068245),
(14, 3, 1, 'SEBtN8piYgmPrXOW2alsPCcmMqUvvWblxkZBHLhTTAIePgsVhgSUpXD36WZ1+ZUxtkHMX/djrJ0jtLz1UlaBrAzQQHiwEC0IxtQ5/PpUdeiwgOaYKXBkcsDSMLy6muek2ZFaztjkPSz5KA==', 1, 'MTcxMDA2ODk2MDU5MA==', 1710068960),
(17, 3, 1, 'JzuqVIwvhj0KqWOMXc7VVZvYuHYWgE9v0NBB1xK6V03i5Cr/676+SME6om3v9GKvfeCUsK2ESCe/0moFEn0=', 1, 'MTcxMDA2OTE1OTUzNw==', 1710069159),
(20, 3, 6, 'G6u1UXtLfMpcsDvVL+5GNwOJepn7tKW85drPU5AsCL3KkDxQPOVwjH3fy11UR4oX5i5QajrnsvgUBav1cZDaxlClVnE/boBAFqnzZbEiKkhY4CncFjscD0Zy2V9MhCcChkfpOMTPogNK7wki1wrMcBeES2U9LD++zExO82GtKYCtNgAAjy5ALdywcmyurWrCy4rSmbZMPU986ajvYq4ZX+kMtrC0JAq5MP8+4w/V+JQd+N4C+LpUaY7Csnj4ZJW+yi/aW7gToECV4s3mUXzjpcrXvzkypj+sFk/K5VNP0Xg4POA167iL30Xrur7gx3D7', 1, 'MTcxMDA4NjE3ODE1OQ==', 1710086178),
(21, 3, 1, '54fuFtFsDtWVnt13GnS0csz+ux2nDelq2XjWh39SNPay+hJrA+veIXNWzuyJKkDba5AQIPTb+f72SopWXBmXQ5BrkBLWT9RYDX4GMbOKI+Ky1RMa7ApD2IeaAuPI3X0hDGTVsctCtZ56ac5WM7XLvMaeQmz985bKUBB/cMastFV2kXByeYS67fp1goivYA==', 1, 'MTcxMDA4NjI0MTM2Ng==', 1710086241),
(25, 3, 1, 'K7VAF5tzZYKcKQJdrvxuYn45DNAga4AAAw5EO3gzv+blrzEl9NzbtLhfVSJfs4lAsmd7BfVgId277Bvt0NJBYQ==', 1, 'MTcxMDA4NjgyMzY1MQ==', 1710086823),
(26, 3, 6, 'eBYpRyukD929FpbWHBIP03sfFu/TwMTMt0X5YSv21IwmgQsL2qNie+1XO+i7FYt4U1TPbt4uYMgYJQ==', 1, 'MTcxMDA4NjkyOTY1OQ==', 1710086929),
(27, 3, 1, 'B8rKqEUASMv+IOkjFHOsaMBHQxTIpGASgtJgyFY6pUmz90w/TE/iIFVm+BtoA8vG9CVbyazr8YevRrzdZ6K9YtkM8XQUU/6pZkkN5/Zhrfl5PUVSJds3swIl3mzHeAIrXljqAVTTJdMW/DFyB9y2q1RAjRCZX0Rez4pJQt4tQ/MvQLBnkTmUrg3sJZvUS8avfGbEzQNi9TXwy6FFiMl/ER885/OdGq3TziI8vsa0yLGHulyM/rHG4bmy4mKpj6i4x1o=', 0, 'MTcxMDE2MzE3ODQ4OQ==', 1710163178),
(28, 3, 1, 'vW0veMrBGwgnoUSfkUhqrRsD6lmlZaRLcduburKniy//oqek64kEGek92409ugScxXaQtzCTDFLRIYq/4sNp2+qky4BI9Cg+5I+SJj8msdCgNhpWSoKXaGcr/tbwlTzZ5pq8uulrxoVaNXcnVKNnlseUDulBu6ad4j85jWzX0w3Fl6ijL04b87pd/sAxwNsCDI3hPcQNUOH5/nU4WNlQjohn67vIGvK44YPj2T14S3iPO2qEPzWWr//vylyWf+8u2uc=', 0, 'MTcxMDE2MzYyODk4Nw==', 1710163628),
(29, 3, 1, 'yus8l8uNDIQCZI8sacnqOec7UHobswQqzXDPb3oPoEqPXyiCeNRM8e7qbgfQpHCuVD9Wr4mk2ZKmvOPE6wa7/9l3J5kmpD+PwgRTt0c+i79hm340Yx7KDx1hryxcQJbzgnBOwoliEzStN6en4eiMILObKaP86p00YnAm7L0/Sios0AVyCVE4ADKim3eLIxNe1JpfPtOImQp4mj2kaPQX+GqcTqZketljS6ZflUizJWgLFAwWesGSov9aC2tWWi9LeaE=', 0, 'MTcxMDE2Mzc0NDMzNA==', 1710163744),
(30, 3, 1, 'cUJ0ShnvarmAwuIZ7XkQQSqRBlP6Qkp/7MRfz6Uz2rfPkz3x7r/gwmggOsHB0iA+JWovI4duVidjCaihbomNi43CXa86AwAQx/OMUdTTst4BKpiBEkGnuSQMAF7ba/e7jnT6mDv4AYAYZ2ijIDtkWwTVbDYtojbASIjW51rB7Mn2fgBrzDPzSZacykhrRU5YBd4gaTpvq3jKlQ4J6OvQehi0q+SlKeE5s0ggpPtFQsDXO3JZqv84H4J8jfAdneZaMzw=', 0, 'MTcxMDE2Mzc2NTU4NQ==', 1710163765),
(31, 3, 1, 'gsSBolPZp1EI23v/Tajjf1Pvb7JDsVT0oY/hEI6mLek1/kJfhJiY5888qd4Z2m0E6I98zhsusJfhcrsQrR9JWJfnuH8zBGM/F6sU63JQIwSFzYdRwZqmvw1nVOGhAArZGldQDc07qTtIs3CK4pX3s34GUmBdUKtJWGAZQWvHbLFXNPEk72IAv1r8rK4I512ZtdWtWMq+PHDG0IBHn9oWdqhsPBR6qrJxgW7kWawB9YLTDU8MJtP+tLszYjKQpOG6ijQ=', 0, 'MTcxMDE2Mzc4MjQwMQ==', 1710163782),
(32, 3, 1, 'zyz+YMcWOZuVlUZHFXa0u/x5AvtyYgHYs68ySDDGUD34GGzgcMoQa7o06v3suV3sUNClgnTd3KMEMUkkjH7KgCBnK57wgdESEpPCJjpTcIf2d44aFoVORhTMJ/E5xb2yYIhs8yn4PeHghx07fWVLVnU+CkT5Vdu41m5wN2pC1Ja8JMYJYaqtpalyNFcBMiUy3Yo1suNeefIR3dS6GzkXlYng2+QhascNVVQp0kjHADJHxvFUVtbFytDYyhm9awKEGRo=', 0, 'MTcxMDE2NDk5NjQ3OA==', 1710164996),
(33, 3, 1, 'qb+YdTpxhERXUkJVvqzROJOjfymorHBtr3U/yuBw/DuysUhpQiKNMrJGn8kDwRuo8CNiVFoPWw==', 0, 'MTcxMDE2NTQ5MDY3MQ==', 1710165490),
(34, 3, 1, '11C1ILq9gFVk4nPHFKsWb2tRpo+UgSibmI8TqmKEV69+bnQQXxSZq/hBbw2G6cHGJPsKeQ5YYw==', 0, 'MTcxMDE2NTQ5MTIwMg==', 1710165491),
(35, 3, 1, '3uVu1oZGXEMW4urylHGqB0ztxPyhHn/bdtq6ZAtu090jPbio+TTM1TYnFMocuSuEOXJwnxFAQA==', 0, 'MTcxMDE2NTQ5MTM3NA==', 1710165491),
(36, 3, 1, 'R5bCnpGtiu9kWsAqjnf7H2rekK/Ql2k/xuCIDEIKKtqx2AjlYMuqRrcoS1XHOF5u+ckAcqP+2g==', 0, 'MTcxMDE2NTQ5MTU0NQ==', 1710165491),
(37, 3, 1, 'SlnTNf6Smr5l96+0VW/NUHZQKJ/eosOhDCV6P8HnqVb48fkOH80kiK7SadRsp1z5xyzQWWLqHg==', 0, 'MTcxMDE2NTYwNjQ4MQ==', 1710165606),
(38, 3, 1, 'poedYXiyrlV9EMe7idR3qcqs8R2JOyvXh1PJuf5ixO/7WGBvQsgOl9Uqt1dPtudvYSKqEX+RNg==', 0, 'MTcxMDE2NTYxMTM1Nw==', 1710165611),
(39, 3, 1, '69GYgh8A+ov47qTcpaWuVWyRUX8NKRZpPQU59OJdinwF1fv7h9S9sHvLW0fkYy/VTSlVo7+VrHOqx82N7OnwF9Grm6t/saAVlRNE3Ev75k25n+hM7VIBiwCfC7xbgF9gyVRTgAULwE9eBjsvmbDnJRGnVmw3qxgZXzqfEqykSbuaH9oci0BWE6J04JXNSh9aKYCb328t6CwFUX5cfo0QZ+Ok+1MyVS2jO8NFUlqXmwLjshE4ZDrlH19fkCr5eIl0Dn8=', 0, 'MTcxMDE2NjMwODA1Mg==', 1710166308),
(40, 3, 1, 'lBbmJ7rHzfjUTQ6DNUaPd00SRHKJ9kpwEG5GXp/APMlsIdLTbWpFSZUsGh3Eiqn6Qv/8KjioFlCdx8leuuhcycQ2RCHwjEgE89m7xcIsMO/S62V4am/5cxGvAY4/INNjrd680ElGh/swkdaxNaAZxxCoC0a2rvID59cgZIZTiqsJsA==', 0, 'MTcxMDE2NjUwMDEwNg==', 1710166500),
(41, 3, 1, 'G+I9XqjU8fNEzF6kgloLGcXvBx/PAAtnacREjU1bMxbpETfS5X0MecAvgMLLyqNyEmU+mNFs2NehD7ve6OO10IumOgaQUWoi3LGqAcr1+MTg02wgbpfCd/SU0ZRmsQwtGbSJU29UIeXMrW4QuEy+nEQV+PDyQyNQkx0Llet3QaT01xo2yAGC8/QYvz0heioFowopwmXoyF3/OpD3tyBl0OIkMf7rI0ZBDSD3G0LULK7U548RQYoPKMPkOyV7BpHRGjs=', 0, 'MTcxMDE2NjUzODQxMQ==', 1710166538),
(42, 3, 1, 'c8cofxGDixgsTFWR8Vi9N4vd2bbN/5O9ipsWmGwQ3hTf19DWcqu0AcgYmB9ut9qveIApewNRgvEwIDqpHPH6HviR5QkooxW8tNcfdc/M5dHI6761L5DXB2ksV0wQELAX3mOnZi0uI6wxCcKHF7eDZh0P3cryU1zGXrI38ePCwjDnWQRvvf6XDuFdvXS4pbffoL433kozroPcoGro33PLZNtIcGi/xMCaZvQQvaYxhC5b6WE8c9mR5AuYxdsJ2f1+bmA=', 0, 'MTcxMDE2Njk2MzQyMQ==', 1710166963),
(43, 3, 1, 'p2RqKT3b/snZVmH8TKjUVVQy4Mw2KepPesAPSFjrMHCiaqghW2EBM5PMS25fw+ElULZ+M2P9Xes9d2tS9StdfpM5+Db5/fAQzbuVIu3tfIiksjBHfQKrHNqwi7f6Z6WJZIWUZRgg48vzkbn4fsDoEcYU5Fd9uwkWRagXiOzXIhehDMq6MHHuR4/aOEAoSoDpPTx8z0iuByqUgbr9O5oeMa+9z2vZIxiuIhJ417eJIg==', 0, 'MTcxMDE2Njk2NzczMw==', 1710166967),
(44, 3, 1, 'CTX45uvHc9tEQAwUAe+HQapNvbiOG3zLu5K7CKL0rOHH+90OwbE6RGrpCdkbXstfY2naoA81xt2iSbBGtG17aO4hKGGx+3hmJnRfYxB8gIkdvB1Bw/7hpVwuHygYHWyMqayXKSMfpcoDBDwbpjfCF4TqXsySjwupDNwXI1tIOyuRx6YcLGSD9bSctDQ43ekpftu47eGz4Np5HM8KML49fF50N6c9EW/5MOwqnQI2oHqj7NjgTrTc369tlQkKIQVewH0=', 0, 'MTcxMDE2Njk5OTExOQ==', 1710166999),
(45, 3, 1, 'N1U2nCQT6KGgLWWTJy+260grovXq0zI7VFgbgn18Oisl2ZUPJ2lIpuFS1QhR42oNH4IwnjhHP1FpStO9/dJygaWENNU0UMd5VR8MQsRWhjA8N80jnb0piEyikpXjOy4XQMGIG2TOulcAjxnZNhOmbj6+menYvPvpF9I9MNF/+fApmiS0oyyj2Zu8eE5nzBAz+NSTvtF4HhDPmozPdPNJS5MiyHn4Kx9JGRQk2gsmyyY75ElSFS2othD/ZU1G4Q0y7Lw=', 0, 'MTcxMDE2NzAxMzEyOQ==', 1710167013),
(46, 3, 1, 'Gx++jcX7Xn2lguAvCA2GDr4eeB5GIaJ3vh7qW7+Id8r1tMuyidg2D1dmj0d8GC6pFtwHiXKrhtlCFnT9FE5PifGpp0QdGCBBXjscDMRws5XZj6CjNCSonhNU8tZ/YzV9HgHJkJpVEvFV3GzsgbOOoDwsB9xTzvHaGrjz016blX6Et9VhdZTPGtBQ0Q+CYl0oJc6PBeahajyQ7sPpK173gYL5gBAM26FdxXGMwMYwe6wYzWnzvYry3xXipQLnE6ih5Tc=', 0, 'MTcxMDE2NzAzNjc5Nw==', 1710167036),
(47, 3, 1, 'LyhfqTYlrmV0stDN6SsPxJP+lN9Nr5uK4W4SakFRyC+uy0LYtekOQ1skCJoLqtg5ChAFpReogjzF1ki7WigXu2SLSuugsk8HmWJnGBrv1XocogTCbBugae/8XyLtvkCNIlFt/MecUIeJBdbuf57uglxeKpj28VPaljbbm4kReCCgpFMflSX+n7RF0HEAOTRPeQqGLs1ulsotVCjo3dfvpkbkkvwm/JmfLXaYq7rezDPLceR7AVqPWMphMni46cd4QuM=', 0, 'MTcxMDE2NzA2MjAzMg==', 1710167062),
(48, 3, 1, 'EtH9K92LMy5tfT8kfD1Xe1KweXv/x9aEN+emDluGVf2l1ZvRrwBZnb5OFJX8suO0e8lUgA7bWOHrxUWs+xD1eVRANa0gFTCQql+f1hl1xQdg8QkjQSubH5dH8LSk2Z4yqvQ8hyl+zPyRhPsJmV0fPKE9tGaRf5CTC8szb6CpQrSBBgdFcEfFe5sYypR5YRFRgDs16Hyk9OXpnazP/AubDN7Buth6D7LbC89/YcBJxAbsMBJDXAyRT3h6CV3joxfFT14=', 0, 'MTcxMDE2NzEwOTUxOA==', 1710167109),
(49, 3, 1, 'yGaaj6tXwpRGBIqG6JoDqcMeVW0G0Ijl9Bep4u/LJXSXHU43bb8gFEoPzzYY3xUFd/L0GzmIztx07IVOe8KpcuJdd0h6rpa6YxTCAiGwn6mnUnlGHU3wvNHWMhtuRHcZPmwCXCZ7+aSFtPfLLBXyoNW4w+f0qJPQyQbYWjm+u+nOXgJx4mnnGaOjp+nCmXKiz8Aon6zmsUlVQzWTRf89wA823zAhvhi/d/Vba9onq5Gg8G6bnWRp8n9zzWlsdirm0t4=', 0, 'MTcxMDE2NzE2NjcwNQ==', 1710167166),
(50, 3, 1, 'LqUtITmxs1vcbcsbIBOQBGyoS9rI0bj4yU7aBXs0483akR9nIaPCs6VokzxkQsLdBVcIASzjLANwKFRZmHVP7a7Mo4yE4Gnlc5JcpnMLpsSHyUT4IVAyr4Nxz3iW51zTKn16hnaHHQSyuwcWm3RFulKFPJC5qzHDRvxPe+TVxFLqBVSO+UFtCgDwy3cQp/Ltd8j6h3P8vnxHkCtCVWZgRVlJ/oCLJ2FNlPjpnyX8XQ==', 0, 'MTcxMDE2NzUzMTU1OA==', 1710167531),
(51, 3, 1, 'b7D76bNahAZ0xu1drsoSB9go9b1TaRCn8dL6v7foF5s2Q8fSYWsglUVu4h16AFF01NSO/4j8d4wgDIhqMx+m2Hg+Dgf4xYN1RUVSxEtwW36+cSFabYaAsDdxs8Mfvyq5+SBOhGaZWCmNOktDXmpctg1D4YT3TInrLcZXNkoO3nEUzjC/8pZTnRnouKIaIYN552T2KlUGXdYIGYCo+0z7/uhEyAOZ2msUs9xWd8O7VImRCFOCc3S/HcGphpEcj8Av8YM=', 0, 'MTcxMDE2NzU0MTM0Mg==', 1710167541),
(52, 3, 1, 'LFe0/5RJ50CDoHPYqSIbMFujNTUdqEC2vJSfqiW5eEIYAtjUKwuDTGxm6805PaNIamInHiyxU3qgb5wGyZeDcUi8ynoNtmcC7F/dq9Y1OCmhc2ZWr9Sbg+RLkSpeod7ty5qhDjXXjfBWlpr5uwx8uj2Bxhdt6TK+MvPi54XzgK/DVKnF3A5Rf6AvSYOARDEA3fSa5iNcfCkyAr1uFqI0ZCK0O4MBpvMMRZ4w7dnOFLK+RixT9/gB78/nGhH3b2yCkx4=', 0, 'MTcxMDE2OTA5MzE3Nw==', 1710169093),
(53, 3, 1, 'vqvsff0wlrx2j0elPhu6IY28F8UfZ/UOnh/chs5m3SjMsFaKwnBisIK5tLfGxbtsP3SOVAd883XIPIoz+3D1c/W8LeYmJRglDEyZL7LQDmK26M5Pm+PcPhS0t1kygbfhlCAKIB0T+m2Z1JkJYRyL3364BVcmagAC75BxvjqUv3Ut4GJlTHF0Drpoy/gqwbCgHSaa3dRTRxY+0QLy+UuD/GUNyebEumk+gWjrwyRHfuY/tg5naQfeFAK+1eFYBx/HOgo=', 0, 'MTcxMDE3MTU1NTM5Mg==', 1710171555),
(54, 3, 1, '2u5gYU6Q2ckCSsPIQMfhFQQ7/gCEJUQfOgcYyEkgdyVsWyL4ddixuKkFMy7PLaLAN4OuYmxs9kJK7qzQs4awvnNzNYsaexCr9+LyJ4L5X19WHV8kMRnevQV2Ke06QZHfAN/t3z9vcNaDPbfq0wHOGVpNojorhmMo6UY+xHUeZUgTxwQOiviDZZQZq6Tndox85mOhF0NHHk8rFssi9zIVRfGcZEOzz1TkZU6EJoIDki7khGVobLs14DLMLlAZ+RnLnWE=', 0, 'MTcxMDE3MTgyNDk3Mw==', 1710171824),
(55, 3, 1, 'b3lHq8XT6006zg9TGAqIRmpN0KSLzqPVsi0Zpr0y3Gr/Q+gbM/RK8DhJHHDE5oUusfZsbvSKvHzOrgH/UWZYasVXdGfBkNTKFIzN1gy24oZX/Km9uMkqfKdWrFEIW3eWXQbvYWdQHCdhHP+eHI+QZgjNrqvnMGyfILV5anfdcb3R8U3tMg7yI5neyPmT6JFUM1gPBRqc+M0xltCsbfcXFmf2n5axBVrDoyLBazOFEqjDko5RZDInm4FCCArLg3Yh+ps=', 0, 'MTcxMDE3MjEwMjA4NA==', 1710172102),
(56, 3, 1, 'WKs4TSjwseTeNywubqIUXxFXUSP7cZ88sZtcay9QfKbnK1Np3R0uwToHxZ2m/W374ZnQwKHXbMyyjAkImT/v1fkQAiKWYS5r+VHvCTmecVTlVY0SN5X79RMytkYngDlWPIY2hH9p6eSPAM8NNnnrvOHhJ4W35fKuzrn+iyeiiBW9wH4OuTeqJfV/tKLZkKiqVWhm+LMuMJdk1jB0ErAFltnNzTPmuSTo8LIoRGWtFDhxEVX6fO5BWwoLwbuZOp1ndlM=', 0, 'MTcxMDE3Mjk1MzM4MA==', 1710172953),
(57, 3, 1, 'YbjOkjbnLCJFKD1oqk4hWty9p7wzv2+b6gwLLVCSCxJQ5lCw69MoacbsIHmO9YzM1y8ccQMSp4HaXUZfTYMm6Bnc5TY5ZU8ST7YtXvkz6J5i7b1LmZeOlawwlRvykxUyYfAYgubHfcV+66ah2/UwjDWKpp87uuktatncKYyxNJ+6RC6Pk1kljQw1CCp9/jU1FqYN7IG5aairCQutStc/RJ6EmcvVE8g/iEp9j2HtFg==', 0, 'MTcxMDE3Mjk1NjgyNg==', 1710172956);

-- --------------------------------------------------------

--
-- Table structure for table `mls_notifications`
--

DROP TABLE IF EXISTS `mls_notifications`;
CREATE TABLE IF NOT EXISTS `mls_notifications` (
  `notification_id` bigint NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `content` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` int NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=360 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mls_notifications`
--

INSERT INTO `mls_notifications` (`notification_id`, `account_id`, `content`, `status`, `created_at`) VALUES
(1, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 0, 1708071577),
(2, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 0, 1708071577),
(3, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 0, 1708071577),
(4, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 0, 1708071577),
(5, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"samplesss\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshake\"}', 0, 1708086164),
(6, 1, '{\"title\":\"Eman Olivas accepted your handshake request\",\"message\":null,\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshake\"}', 0, 1708086179),
(7, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"samplesss\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshake\"}', 0, 1708086308),
(8, 1, '{\"title\":\"Eman Olivas canceled a handshake\",\"message\":\"samplesss\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/1\"}', 0, 1708086612),
(9, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"samplesss\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshake\"}', 0, 1708086630),
(10, 1, '{\"title\":\"Eman Olivas canceled a handshake\",\"message\":\"samplesss\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/1\"}', 0, 1708088362),
(11, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"samplesss\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 0, 1708088451),
(12, 1, '{\"title\":\"Eman Olivas accepted your handshake request\",\"message\":\"samplesss\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 0, 1708088470),
(13, 1, '{\"title\":\"Eman Olivas mark done a handshake\",\"message\":\"samplesss\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/1\"}', 0, 1708088481),
(14, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"test\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 0, 1708089094),
(15, 1, '{\"title\":\"Eman Olivas denied your handshake request\",\"message\":\"test\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/2\"}', 0, 1708089103),
(16, 4, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"testing\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 1, 1708089141),
(17, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708100762),
(18, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708100851),
(19, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708100920),
(20, 1, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 0, 1708100940),
(21, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708157659),
(22, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708157671),
(23, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708158435),
(24, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708168530),
(25, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708168749),
(26, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169294),
(27, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169307),
(28, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169380),
(29, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169488),
(30, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169525),
(31, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169589),
(32, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169625),
(33, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169651),
(34, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169654),
(35, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169687),
(36, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169741),
(37, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169755),
(38, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169759),
(39, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169849),
(40, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169884),
(41, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169944),
(42, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708169948),
(43, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708170606),
(44, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708170611),
(45, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708170620),
(46, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708176346),
(47, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708176351),
(48, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708176353),
(49, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708176454),
(50, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708176620),
(51, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708176779),
(52, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708176792),
(53, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708177053),
(54, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708177148),
(55, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708177194),
(56, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708177341),
(57, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708177364),
(58, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708177366),
(59, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708177370),
(60, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708177389),
(61, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708177566),
(62, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708181961),
(63, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708182128),
(64, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708182183),
(65, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708182290),
(66, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708182579),
(67, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708182675),
(68, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708182767),
(69, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708182927),
(70, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708182991),
(71, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708183223),
(72, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708183887),
(73, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708183897),
(74, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708183980),
(75, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708184032),
(76, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708184135),
(77, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708184250),
(78, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708184268),
(79, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708184298),
(80, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708184464),
(81, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708184504),
(82, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708184594),
(83, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708184642),
(84, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708184895),
(85, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708185131),
(86, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708186801),
(87, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708186806),
(88, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708186922),
(89, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708186924),
(90, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708226285),
(91, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708227222),
(92, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709895163),
(93, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709895210),
(94, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709895890),
(95, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709896637),
(96, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709896785),
(97, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709904480),
(98, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709904484),
(99, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709904627),
(100, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709904644),
(101, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709904821),
(102, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709904828),
(103, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709904837),
(104, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709906871),
(105, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709906912),
(106, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709906940),
(107, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709907089),
(108, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709907100),
(109, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709907264),
(110, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709907770),
(111, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709908080),
(112, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709908101),
(113, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709908177),
(114, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709908251),
(115, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709908816),
(116, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709909078),
(117, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709909682),
(118, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709909717),
(119, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709909758),
(120, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709909914),
(121, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709910057),
(122, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709910093),
(123, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709910153),
(124, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709910297),
(125, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709910509),
(126, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709911267),
(127, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709911321),
(128, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709911344),
(129, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709911421),
(130, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709912578),
(131, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709912624),
(132, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709912636),
(133, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709912689),
(134, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709912757),
(135, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709912950),
(136, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709912968),
(137, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709913253),
(138, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709913450),
(139, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709914213),
(140, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709914424),
(141, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709914599),
(142, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709915345),
(143, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709915368),
(144, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709915435),
(145, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709915506),
(146, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709915519),
(147, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709915560),
(148, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709915584),
(149, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709915622),
(150, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709915651),
(151, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709915669),
(152, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709915760),
(153, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709915771),
(154, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709916101),
(155, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709976512),
(156, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709976800),
(157, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709976886),
(158, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709977016),
(159, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709977259),
(160, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709977302),
(161, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709977568),
(162, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709977639),
(163, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709977659),
(164, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709977748),
(165, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709977765),
(166, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709977855),
(167, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709977895),
(168, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709977992),
(169, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709978062),
(170, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709979114),
(171, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709979473),
(172, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709979514),
(173, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709979556),
(174, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709979652),
(175, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709979698),
(176, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709979843),
(177, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709979979),
(178, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709980302),
(179, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709980309),
(180, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709980329),
(181, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709980365),
(182, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709980421),
(183, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709980485),
(184, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709980690),
(185, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709980737),
(186, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709980850),
(187, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709980898),
(188, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709980967),
(189, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709981060),
(190, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709981153),
(191, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709981239),
(192, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709981291),
(193, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709981319),
(194, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709981470),
(195, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709981781),
(196, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709981824),
(197, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709981860),
(198, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709981869),
(199, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709982005),
(200, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709982029),
(201, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709982378),
(202, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709982414),
(203, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709982461),
(204, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709982650),
(205, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709982796),
(206, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709982821),
(207, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709982866),
(208, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709982901),
(209, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709982926),
(210, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709983062),
(211, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709983122),
(212, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709983894),
(213, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709984094),
(214, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709984135),
(215, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709984482),
(216, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709984546),
(217, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709984897),
(218, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 0, 1709984922),
(219, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709985010),
(220, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709985063),
(221, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709985109),
(222, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709985117),
(223, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709988729),
(224, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709988777),
(225, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709989872),
(226, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709989883),
(227, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709989888),
(228, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709989891),
(229, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709989894),
(230, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709989897),
(231, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990247),
(232, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990335),
(233, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990344),
(234, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990398),
(235, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990404),
(236, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990422),
(237, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990430),
(238, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990472),
(239, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990513),
(240, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990583),
(241, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990594),
(242, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990652),
(243, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990668),
(244, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990705),
(245, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990750),
(246, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990759),
(247, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990916),
(248, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990952),
(249, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709990983),
(250, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709991010),
(251, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709991039),
(252, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709991133),
(253, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709991187),
(254, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709991225),
(255, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709993967),
(256, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1709995752),
(257, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710001257),
(258, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710002133),
(259, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710002157),
(260, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710035835),
(261, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710038014),
(262, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710038028),
(263, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710038155),
(264, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710038230),
(265, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710038263),
(266, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710038340),
(267, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710038374),
(268, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710038535),
(269, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710038586),
(270, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710038689),
(271, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710041478),
(272, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710041520),
(273, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710041526),
(274, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710041588),
(275, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710041592),
(276, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710041601),
(277, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710041606),
(278, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710041663),
(279, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710041683),
(280, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710041767),
(281, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710041778),
(282, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710041793),
(283, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710045758),
(284, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710045810),
(285, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710046072),
(286, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710046693),
(287, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710046697),
(288, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710047397),
(289, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710047483),
(290, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710047767),
(291, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710047891),
(292, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710048419),
(293, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710048458),
(294, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710058480),
(295, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710061261),
(296, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710061297),
(297, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710061405),
(298, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710061566),
(299, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710061671),
(300, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710061733),
(301, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710063739),
(302, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710063829),
(303, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710064102),
(304, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710064876),
(305, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710066745),
(306, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710066760),
(307, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710067648),
(308, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710067689),
(309, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710067750),
(310, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710067870),
(311, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710067957),
(312, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710068170),
(313, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710068245),
(314, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710068960),
(315, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710068975),
(316, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710069009),
(317, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710069159),
(318, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710085681),
(319, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710085861),
(320, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710086178);
INSERT INTO `mls_notifications` (`notification_id`, `account_id`, `content`, `status`, `created_at`) VALUES
(321, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710086241),
(322, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710086273),
(323, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710086354),
(324, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710086552),
(325, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710086823),
(326, 1, '{\"title\":\"Emmanuel Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710086929),
(327, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710163178),
(328, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710163628),
(329, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710163744),
(330, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710163765),
(331, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710163782),
(332, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710164996),
(333, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710165490),
(334, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710165491),
(335, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710165491),
(336, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710165491),
(337, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710165606),
(338, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710165611),
(339, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710166308),
(340, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710166500),
(341, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710166538),
(342, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710166963),
(343, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710166967),
(344, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710166999),
(345, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710167013),
(346, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710167036),
(347, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710167062),
(348, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710167109),
(349, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710167166),
(350, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710167531),
(351, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710167541),
(352, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710169093),
(353, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710171555),
(354, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710171824),
(355, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710172102),
(356, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710172953),
(357, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/threads\\/WzEsNF0=\"}', 1, 1710172956),
(358, 1, '{\"title\":\"Eman Olivas mark done a handshake\",\"message\":\"testing\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/4\"}', 1, 1710819918),
(359, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 1, 1710820066);

-- --------------------------------------------------------

--
-- Table structure for table `mls_premiums`
--

DROP TABLE IF EXISTS `mls_premiums`;
CREATE TABLE IF NOT EXISTS `mls_premiums` (
  `premium_id` bigint NOT NULL AUTO_INCREMENT,
  `category` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT 'limited_time' COMMENT 'permanent, limited_time',
  `name` varchar(50) DEFAULT NULL,
  `details` text,
  `script` text COMMENT 'json value',
  `duration` varchar(10) NOT NULL DEFAULT '30 days' COMMENT 'days duration',
  `cost` decimal(15,2) NOT NULL DEFAULT '0.00',
  `visibility` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `date_added` int UNSIGNED NOT NULL,
  `date_end` int UNSIGNED NOT NULL,
  PRIMARY KEY (`premium_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_premiums`
--

INSERT INTO `mls_premiums` (`premium_id`, `category`, `type`, `name`, `details`, `script`, `duration`, `cost`, `visibility`, `date_added`, `date_end`) VALUES
(1, 'package', 'limited_time', 'Bronze Package', '+15 Listing Posting, +1 Display Ads, 30 days duration', '{\"max_post\":\"15\",\"display_ads\":\"1\"}', '30 days', 499.00, 1, 1698672886, 1698072325),
(3, 'package', 'limited_time', 'Silver Package', '+1 Max Users, +30 Listing Posting, +2 Display Ads, +1 Featured Ads, Listing Database, 30 days duration', '{\"max_post\":\"30\",\"max_users\":\"1\",\"display_ads\":\"1\",\"featured_ads\":\"1\",\"properties_DB\":\"1\"}', '30 days', 999.00, 1, 1698672845, 0),
(4, 'individual', 'limited_time', 'Max User +1', 'Add 1 user to your account for a month', '{\"max_users\":\"1\"}', '30 days', 250.00, 1, 1698675100, 0),
(5, 'individual', 'limited_time', 'MLS Access 30 days', 'Multi-Listing Service Access, 30 days duration', '{\"mls_access\":\"1\"}', '30 days', 500.00, 1, 1698675869, 0),
(6, 'package', 'limited_time', 'Gold Package', '+2 Max User, +60 Listing Posting, +3 Display Ads, +2 Featured Ads, Listings Database Access, 30 days duration', '{\"max_post\":\"60\",\"max_users\":\"1\",\"display_ads\":\"3\",\"featured_ads\":\"2\"}', '30 days', 1499.00, 1, 1698926154, 0),
(7, 'package', 'limited_time', 'Platinum Package', '+3 Max User, +90 Listing Posting, +4 Display Ads, +3 Featured Ads, Listings Database Access, 30 days duration', '{\"max_post\":\"90\",\"max_users\":\"3\",\"display_ads\":\"4\",\"featured_ads\":\"3\"}', '30 days', 1999.00, 1, 1698927038, 0),
(8, 'package', 'limited_time', 'Diamond Package', '+4 Max User, +120 Listing Posting, +5 Display Ads, +4 Featured Ads, Listings Database Access, 30 days duration', '{\"max_post\":\"120\",\"max_users\":\"4\",\"display_ads\":\"5\",\"featured_ads\":\"4\"}', '30 days', 2499.00, 1, 1698927038, 0),
(9, 'package', 'limited_time', 'Titanium Package', '+5 Max User, +155 Listing Posting, +6 Display Ads, +5 Featured Ads, Listings Database Access, 30 days duration', '{\"max_post\":\"155\",\"max_users\":\"5\",\"display_ads\":\"6\",\"featured_ads\":\"5\"}', '30 days', 2999.00, 1, 1698927038, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mls_settings`
--

DROP TABLE IF EXISTS `mls_settings`;
CREATE TABLE IF NOT EXISTS `mls_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_name` varchar(50) DEFAULT NULL,
  `contact_info` text,
  `property_tags` text,
  `paypal_credentials` text,
  `show_vat` tinyint(1) NOT NULL DEFAULT '1',
  `chat_is_websocket` tinyint(1) NOT NULL DEFAULT '0',
  `email_address_responder` varchar(150) NOT NULL,
  `enable_kyc_verification` tinyint(1) NOT NULL DEFAULT '0',
  `enable_premium` tinyint(1) NOT NULL DEFAULT '0',
  `enable_pin_access` tinyint(1) NOT NULL DEFAULT '0',
  `privileges` text,
  `analytics` text,
  `header_script` text,
  `data_privacy` text,
  `terms` text,
  `refund_policy` text,
  `modified_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mls_settings`
--

INSERT INTO `mls_settings` (`id`, `site_name`, `contact_info`, `property_tags`, `paypal_credentials`, `show_vat`, `chat_is_websocket`, `email_address_responder`, `enable_kyc_verification`, `enable_premium`, `enable_pin_access`, `privileges`, `analytics`, `header_script`, `data_privacy`, `terms`, `refund_policy`, `modified_at`) VALUES
(1, NULL, '{\"mobile_number\":\"09199999999\",\"email\":\"myorg@email.com\",\"office_address\":\"55 sitio st brgy pinagkaisahan quezon city\"}', '[\"New\",\"Pre-Owned\",\"Fully Furnished\",\"Bare Unit\",\"Pre-Sale\",\"Ready for Occupancy\"]', '{\"client_id\":\"AczoZMmV6Tkw24LL55FDfCaCMsp7aSo5bf75EFLy22u0nswrH15Cmrac2tsimtGCLaiU35vb605Pi3oF\",\"client_secret\":\"EOxCjX0hgxSaffhW1QEFZcqto_LBL_qnAIl22TuYH1sVio-AljiMdb6ti95V8z0lb_RbKLexNcSSibE0\"}', 0, 0, 'noreply@email.com', 0, 1, 0, '{\"max_post\":\"15\",\"max_users\":\"2\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', NULL, NULL, '<h3 style=\"text-align: justify;\">Privacy Statement</h3>\r\n<p style=\"text-align: justify;\">Your personal information is important to My Organization., its employees, agents or representatives (collectively referred to as \"Organization\", \"we\", \"us\" or \"our\"). We handle your personal information and data in accordance with Republic Act No. 10173, otherwise known as the Data Privacy Act of 2012, and its Implementing Rules and Regulations, other issuances of the National Privacy Commission and other relevant laws of the Philippines (collectively, the \"DPA\"). We recognize the importance of your rights as a Data Subject under the DPA, as follows:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Right to be informed</li>\r\n<li>Right to object</li>\r\n<li>Right to access</li>\r\n<li>Right to correct</li>\r\n<li>Right to rectification, erasure or blocking</li>\r\n<li>Right to damages</li>\r\n<li>Right to data portability</li>\r\n<li>Transmissibility of rights</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">This Privacy Policy aims to provide information on how we collect, use, manage, and secure your personal information. Any information you provide to us indicates your express consent to our Privacy Policy.</p>\r\n<h3 style=\"text-align: justify;\">Personal Information Collection</h3>\r\n<p style=\"text-align: justify;\">Personal Information under the DPA refers to any information, whether recorded in a material form or not, from which the identity of an individual is apparent or can be reasonably and directly ascertained by the entity holding such information, or such information, when put together with other information, would directly and certainly identify an individual.</p>\r\n<p style=\"text-align: justify;\">In the performance of our services, or as part of our transactions and dealings, we collect your personal information which may include, but not limited to, the following:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Your name, nationality, civil status, gender, age, birthdate, ID details, unique identifiers, email address, residence, office, and mailing address, phone numbers and other information, as part of our transactions and dealings with you.</li>\r\n<li>Your browsing and social media behavior, when you browse into our website, download mobile applications and tag or mention us on your social media accounts.</li>\r\n<li>Any information you submit when to our sales, account management, or customer relations agents for update of your records or information; in relation to your inquiries or requests; when you participate in our survey, discount, event information and prize promotion; when you refer a person to verify the information you provided to us; when you visit and connect to our websites and social media pages; or any other event or activity that may be similar or related to any of the foregoing.</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">When you provide information other than your own, you certify that you have obtained the consent and authority of the owner of such information (such as your parents, spouse, children, dependent, or any other person) to allow us to disclose and process such information.</p>\r\n<h3 style=\"text-align: justify;\">Use and Sharing of Personal Information</h3>\r\n<p style=\"text-align: justify;\">We use your personal information to:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Process the products and services that you have availed from us.</li>\r\n<li>Communicate our latest products, services, promos and events.</li>\r\n<li>Respond immediately to your needs, requests, queries and complaints.</li>\r\n<li>Comply with the law, rule or regulation and all legal orders and processes.</li>\r\n<li>Process your application and conduct due diligence for, and documentation of, our transaction.</li>\r\n<li>Any other purpose relating to any of the above.</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">We share your personal information, to the extent that is reasonable and necessary, to:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Our employees or other personnel handling your transactions, orders or requests.</li>\r\n<li>Banks, insurers or professional advisers in connection with due diligence and documentation of your transaction.</li>\r\n<li>Any third-party service provider performing financial, administrative, technical and other ancillary services.</li>\r\n<li>Government institution and other competent authorities which by law, rules or regulations require us to disclose your personal information.</li>\r\n<li>Any person or entity we contractually entered with and who ensures the confidentiality standard we implement and adheres to the DPA.</li>\r\n<li>Any person in order to carry out functions of public authority, and for collection and further processing pertaining to law enforcement, taxation or other regulatory function.</li>\r\n</ol>\r\n<h3 style=\"text-align: justify;\">Personal Information Retention and Protection</h3>\r\n<p style=\"text-align: justify;\">We retain your personal information:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>To the extent necessary in keeping track of your transaction and records.</li>\r\n<li>As may be agreed upon by the parties to a contract.</li>\r\n<li>For statistical, research and other purpose specifically authorized by law.</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">Data collected will be retained in accordance with retention limit set by our standards, industry standards and laws and regulations, unless you request your data to be deleted in our database.</p>\r\n<p style=\"text-align: justify;\">To maintain the integrity and confidentiality of your personal information, we put in place organizational, physical and technical security measures to protect your personal information, such as:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Use of secured servers, firewalls, encryptions and other latest security tools.</li>\r\n<li>Limited access to personal information to those duly authorized processors. All transfers are made after complying with the established confidentiality policy and practices in place.</li>\r\n<li>Maintain a secured server operating environment by performing regular security patch update and server hardening.</li>\r\n</ol>\r\n<h3 style=\"text-align: justify;\">Cookies and Related Technologies</h3>\r\n<p style=\"text-align: justify;\">A cookie is a small piece of file which originates from a website and is transferred to the user\'s hard drive to record the user\'s browsing activity. Cookies were designed to remember pieces of information that the user has entered in a certain website. Essentially, cookies help in making the browsing of our site easier by, among other things, saving your name, addresses, passwords and other preferences.</p>\r\n<p style=\"text-align: justify;\">Most web browsers are set to automatically accept cookies, but you have the option to refuse all cookies or indicate when a cookie is being sent. However, if you choose not to accept cookies, you may experience some delay in browsing our website or it will not function properly or may be considerably slower.</p>\r\n<h3>Google Analytics</h3>\r\n<p>We use Google Analytics, an analytics service provided by Google LLC. We use this service to help analyze how users use the Service, with a view to analyzing usage across devices and offering improvements for all users. To learn more about Google Analytics, please visit their <a href=\"https://support.google.com/analytics/answer/6004245#zippy=%2Cour-privacy-policy\">Privacy Policy</a>. To opt-out of this feature by installing the Google Analytics Opt-out Browser Add-on, please click <a href=\"https://tools.google.com/dlpage/gaoptout?hl=en\">here</a>.</p>\r\n<h3>Newsletters</h3>\r\n<p>You can opt out of receiving our marketing emails and/or newsletters by contacting us as described under &ldquo;Contact Us&rdquo; below. We may still send you transactional messages, which include Services-related communications and responses to your questions.</p>\r\n<h3 style=\"text-align: justify;\">Renewal of Policy</h3>\r\n<p style=\"text-align: justify;\">We may periodically update or amend our Privacy Policy in order to adhere to new and existing laws affecting the DPA, including any change or improvement we establish to secure your personal information. Any updates or changes shall not alter how we handle previously collected personal data without obtaining your consent, unless required by law.</p>', '<h3>Introduction</h3>\r\n<p>This page states the terms and conditions under which you may use the website, [website name]. [website name] is operated by an Individual Trying to help Real Estate Brokers and Salespersons to increase their presence on the internet</p>\r\n<p><strong>Definitions</strong></p>\r\n<ul>\r\n<li>The terms \"you\" and \"user\" as used herein refer to all individuals and/or entities accessing [website name]</li>\r\n<li>The term \"Website\" as used herein refers to [domain name]</li>\r\n</ul>\r\n<p><strong>General</strong></p>\r\n<p>By using the Website, you are indicating your acceptance to be bound by these terms and conditions. The Website may revise these terms and conditions at any time by updating this page. You should visit this page periodically to review the terms and conditions, to which you are bound.</p>\r\n<p><strong>Terms of Use</strong></p>\r\n<ul>\r\n<li>Users may not use the Website in order to transmit, distribute, store or destroy material:\r\n<ul>\r\n<li>in violation of any applicable law or regulation;</li>\r\n<li>in a manner that will infringe the copyright, trademark, trade secret or other intellectual property rights of others or violate the privacy, publicity or other personal rights of others;</li>\r\n<li>that is defamatory, obscene, threatening, abusive or hateful.</li>\r\n</ul>\r\n</li>\r\n<li>The following is prohibited with respect to the Website:\r\n<ul>\r\n<li>Using any robot, spider, other automatic device or manual process to monitor or copy any part of the Website;</li>\r\n<li>Using any device, software or routine or the like to interfere or attempt to interfere with the proper working of the Website.</li>\r\n<li>Taking any action that imposes an unreasonable or disproportionately large load on the Website infrastructure;</li>\r\n<li>Copying, reproducing, altering, modifying, creating derivative works, or publicly displaying any content from the Website without the Website`s prior written permission;</li>\r\n<li>Reverse assembling or otherwise attempting to discover any source code relating to the Website or any tool therein, except to the extent that such activity is expressly permitted by applicable law notwithstanding this limitation; and</li>\r\n<li>Attempting to access any area of the Website to which access is not authorized.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p><strong>Copyright and Intellectual Property Rights</strong></p>\r\n<ul>\r\n<li>All content, trademarks and data on this Website, including but not limited to, software, databases, text, graphics, icons, hyperlinks, private information, and designs are the property of or licensed to the Website.</li>\r\n<li>Users of this Website are not granted a licence or any other right including without limitation under Copyright, Trade Mark, Patent or Intellectual Property Rights in/or to the content.</li>\r\n</ul>\r\n<p><strong>Security</strong></p>\r\n<ul>\r\n<li>Users are prohibited from violating or attempting to violate the security of the Website, including, but without limitation:\r\n<ul>\r\n<li>accessing data not intended for such user or logging into a server or account which the user is not authorized to access;</li>\r\n<li>attempting to probe, scan or test the vulnerability of a system or network or to breach security or authentication measures without proper authorization;</li>\r\n<li>attempting to interfere with service to any user, host or network, including, without limitation, via means of submitting a virus to the website, overloading, \"flooding\", \"spamming\", \"mail bombing\" or \"crashing\";</li>\r\n<li>sending unsolicited email, including promotions and/or advertising of products or services;</li>\r\n<li>forging any TCP/IP packet header or any part of the header information in any email or newsgroup posting;</li>\r\n<li>deleting or revising any material posted by any other person or entity;</li>\r\n<li>using any device, software or routine to interfere or attempt to interfere with the proper working of this website or any activity being conducted on this site.</li>\r\n</ul>\r\n</li>\r\n<li>Violations of system or network security may result in civil or criminal liability. The Website will investigate occurrences, which may involve such violations and may involve, and cooperate with, law enforcement authorities in prosecuting users who are involved in such violations.</li>\r\n</ul>\r\n<p><strong>Disclaimer</strong></p>\r\n<ul>\r\n<li>The Website carries property advertisements, news, reviews and other content independently published by third parties on the website. The Website is not involved in the buying, selling or development of the property process and must not be considered to be an agent, buyer and/or a developer with respect to the use of the Website.</li>\r\n<li>The Website shall not be responsible for any user entering into agreements or making decision whatever nature in connection with the posting of property ads, property information, personal owned property information, use of financial calculators and/or the contents thereof and/or any other information obtained on the Website.</li>\r\n<li>Whilst the Website has taken reasonable measures to ensure the integrity of the Website and its contents, no warranty, whether express or implied, is given that the Website will operate error-free or that any files, downloads or applications available via the Website are free of viruses, trojans, bombs, time-locks or any other data, code or harmful mechanisms which has the ability to corrupt or affect the operation of your system.</li>\r\n<li>In no event shall the Website, and/or any third party contributors of material to the Website be liable for any costs, expenses, losses and damages of any nature (whether direct, indirect, punitive, incidental, special or consequential) arising out of or in any way connected with your use of the Website, your inability to use the Website and/or the operational failure of the Website, and whether or not such costs, expenses, losses and damages are based on contract, delict, strict liability or otherwise.</li>\r\n<li>Insofar as the Website contains links to any other internet websites, you acknowledge and agree that the Website does not have control over any such website and the Website shall therefore not be liable in any way for the contents of any such linked website, nor for any costs, expenses, losses or damages of any nature whatsoever arising from your access and/or use of any such website.</li>\r\n</ul>\r\n<p><strong>Severability</strong></p>\r\n<ul>\r\n<li>These Terms &amp; Conditions constitute the entire agreement between the Website and you. Any failure by the Website to exercise or enforce any right or provision of these Terms &amp; Conditions shall in no way constitute a waiver of such right or provision.</li>\r\n<li>In the event that any term or condition is not fully enforceable or valid for any reason, such term(s) or condition(s) shall be severable from the remaining terms and conditions. The remaining terms and conditions shall not be affected by such unenforceability or invalidity and shall remain enforceable and applicable.</li>\r\n</ul>\r\n<p><strong>Applicable Law</strong></p>\r\n<p>This Website is hosted outside of Philippines and controlled, managed in the Philippines, and thus, Philippine law and jurisdiction govern the use or inability to use this Website, or any other matter related to this Website.</p>\r\n<p><strong>Disputes</strong></p>\r\n<p>All disputes in terms of this agreement or relating to the use or inability to use this Website shall be settled by arbitration conducted in English in terms of the rules of the Philippines Republican Act.</p>', '<p>refund policy</p>', 1710583219);

-- --------------------------------------------------------

--
-- Table structure for table `mls_threads`
--

DROP TABLE IF EXISTS `mls_threads`;
CREATE TABLE IF NOT EXISTS `mls_threads` (
  `thread_id` bigint NOT NULL AUTO_INCREMENT,
  `participants` json DEFAULT NULL COMMENT 'participants account_id in JSON format',
  `created_by` bigint NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_threads`
--

INSERT INTO `mls_threads` (`thread_id`, `participants`, `created_by`, `created_at`, `status`) VALUES
(3, '[1, 4]', 6, 1709979514, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mls_transactions`
--

DROP TABLE IF EXISTS `mls_transactions`;
CREATE TABLE IF NOT EXISTS `mls_transactions` (
  `transaction_id` int NOT NULL AUTO_INCREMENT,
  `account_id` bigint NOT NULL,
  `premium_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `premium_description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `premium_price` float(10,2) DEFAULT NULL,
  `merchant_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `merchant_email` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payer` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `payment_transaction_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payment_source` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payment_status` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `transaction_details` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` int DEFAULT '0',
  `modified_at` int DEFAULT '0',
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `mls_transactions`
--

INSERT INTO `mls_transactions` (`transaction_id`, `account_id`, `premium_id`, `premium_description`, `premium_price`, `merchant_id`, `merchant_email`, `payer`, `payment_transaction_id`, `payment_source`, `payment_status`, `transaction_details`, `created_at`, `modified_at`) VALUES
(1, 1, '3', 'Silver Package [+1 Max Users, +30 Listing Posting, +2 Display Ads, +1 Featured Ads, Listing Database, 30 days duration]', 999.00, '9EBSYSV5TA6J2', 'sb-c47faw29535156@business.example.com', '{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}', '2X997490M86896847', 'paypal', 'COMPLETED', '{\"id\":\"2X997490M86896847\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"999.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"999.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"59.87\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"939.13\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"17.50\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/2X997490M86896847\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/2X997490M86896847\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/7PF783118S383792Y\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-02-11T03:46:40Z\",\"update_time\":\"2024-02-11T03:46:40Z\"}', 1676009678, 1707545678),
(2, 1, '1', 'Bronze Package [+15 Listing Posting, +1 Display Ads, 30 days duration]', 499.00, '9EBSYSV5TA6J2', 'sb-c47faw29535156@business.example.com', '{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}', '2A370115AY903591D', 'paypal', 'COMPLETED', '{\"id\":\"2A370115AY903591D\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"499.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"499.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"42.42\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"456.58\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"8.51\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/2A370115AY903591D\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/2A370115AY903591D\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/4UB01564HU360012K\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-02-11T03:53:21Z\",\"update_time\":\"2024-02-11T03:53:21Z\"}', 1707623601, 1707623602),
(3, 1, '8', 'Diamond Package [+4 Max User, +120 Listing Post...]', 2499.00, '9EBSYSV5TA6J2', 'sb-c47faw29535156@business.example.com', '{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}', '8JM60218V4169604F', 'paypal', 'COMPLETED', '{\"id\":\"8JM60218V4169604F\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"2499.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"2499.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"112.22\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"2386.78\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"44.48\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/8JM60218V4169604F\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/8JM60218V4169604F\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/7BD35395VM234601N\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-02-11T07:46:36Z\",\"update_time\":\"2024-02-11T07:46:36Z\"}', 1707637596, 1707637597),
(4, 1, '8', '[Diamond Package] +4 Max User, +120 Listing Posting, +5 Display Ads, +4 Featured Ads, Listings Dat...', 2499.00, '9EBSYSV5TA6J2', 'sb-c47faw29535156@business.example.com', '{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}', '6RM84372YU4133014', 'paypal', 'COMPLETED', '{\"id\":\"6RM84372YU4133014\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"2499.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"2499.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"112.22\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"2386.78\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"44.48\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/6RM84372YU4133014\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/6RM84372YU4133014\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/23G14771GJ529562C\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-02-11T07:51:23Z\",\"update_time\":\"2024-02-11T07:51:23Z\"}', 1707637883, 1707637884),
(6, 4, '1', '[Bronze Package] +15 Listing Posting, +1 Display Ads, 30 days duration', 499.00, NULL, NULL, '{\"name\":{\"given_name\":\"Emmanuel\",\"surname\":\"Olivas\"},\"email_address\":\"eman.olivas@gmail.com\"}', '1707647174', 'post-dated check', 'COMPLETED', '{\"status\":\"COMPLETED\",\"transaction\":{\"account_id\":1,\"account_type\":\"Administrator\",\"account_permissions\":{\"account\":{\"access\":\"true\"},\"users\":{\"access\":\"true\",\"delete\":\"true\"},\"leads\":{\"access\":\"true\",\"delete\":\"true\"},\"properties\":{\"access\":\"true\",\"delete\":\"true\"},\"subscriptions\":{\"purchased\":\"true\"}},\"name\":\"Eman Olivas\",\"created_at\":1707647174},\"create_time\":1707647174}', 1707647174, 0),
(7, 1, '7', '[Platinum Package] +3 Max User, +90 Listing Posting, +4 Display Ads, +3 Featured Ads, Listings Database Access, 30 days duration', 1999.00, '9EBSYSV5TA6J2', 'sb-c47faw29535156@business.example.com', '{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}', '39206155E8475541E', 'paypal', 'COMPLETED', '{\"id\":\"39206155E8475541E\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"1999.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"1999.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"94.77\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"1904.23\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"35.48\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/39206155E8475541E\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/39206155E8475541E\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/62P17035LT005904U\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-02-15T15:37:05Z\",\"update_time\":\"2024-02-15T15:37:05Z\"}', 1708011425, 0),
(8, 1, '5', '[MLS Access 30 days] Multi-Listing Service Access, 30 days duration', 500.00, '9EBSYSV5TA6J2', 'sb-c47faw29535156@business.example.com', '{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}', '63C836580V0415500', 'paypal', 'COMPLETED', '{\"id\":\"63C836580V0415500\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"500.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"500.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"42.45\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"457.55\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"8.53\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/63C836580V0415500\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/63C836580V0415500\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/68B227849B819302Y\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-02-24T13:23:30Z\",\"update_time\":\"2024-02-24T13:23:30Z\"}', 1708781010, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mls_users`
--

DROP TABLE IF EXISTS `mls_users`;
CREATE TABLE IF NOT EXISTS `mls_users` (
  `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_id` bigint UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `photo` text,
  `user_level` int UNSIGNED NOT NULL DEFAULT '2',
  `user_status` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'active' COMMENT 'inactive, active',
  `permissions` text,
  `two_factor_authentication` tinyint(1) NOT NULL DEFAULT '0',
  `two_factor_authentication_aps` varchar(50) DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_users`
--

INSERT INTO `mls_users` (`user_id`, `account_id`, `password`, `email`, `name`, `photo`, `user_level`, `user_status`, `permissions`, `two_factor_authentication`, `two_factor_authentication_aps`, `date_added`) VALUES
(1, 1, '9aa126e302832b2c95e29b11263b5e9f', 'eman00x2xx@gmail.com', 'Eman Olivas', 'http://cdn.mls/images/accounts/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg', 1, '1', '{\"accounts\":{\"access\":true,\"edit\":true,\"delete\":true},\"users\":{\"access\":true,\"edit\":true,\"delete\":true},\"properties\":{\"access\":true,\"edit\":true,\"delete\":true},\"premiums\":{\"access\":true,\"edit\":true,\"delete\":true,\"process_subscription\":true},\"web_settings\":{\"access\":true,\"edit\":true},\"settings\":{\"access\":true,\"edit\":true},\"articles\":{\"access\":true,\"edit\":true,\"delete\":true},\"kyc\":{\"access\":true},\"transactions\":{\"access\":true},\"leads\":{\"access\":true,\"delete\":true}}', 0, '', 1697967624),
(2, 1, 'fb0fd131cffe9a9fa9f50d98860ed581', 'test@test.com', 'Mayette Olivas', 'http://cdn.mls/images/users/75878193501632083732711588635642117156061029220469_9cffc3eec6fd1514c2f4bd06dc87308a.jpg', 2, 'active', '{\"accounts\":{\"access\":true,\"edit\":true,\"delete\":true},\"users\":{\"access\":true,\"edit\":true,\"delete\":true},\"properties\":{\"access\":true,\"edit\":true,\"delete\":true},\"premiums\":{\"access\":true,\"edit\":true,\"delete\":true},\"web_settings\":{\"access\":true,\"edit\":true},\"settings\":{\"access\":true,\"edit\":true}}', 0, '', 1698589128),
(4, 4, '9aa126e302832b2c95e29b11263b5e9f', 'testtest@test.com', 'Tester', 'http://cdn.mls/images/users/03617413890977432093513486861793381434706645845303_e84317e5884cf95cdcedaf42e0ef9213.png', 2, '1', '{\"users\":{\"delete\":\"true\"},\"leads\":{\"delete\":\"true\"},\"properties\":{\"delete\":\"true\"}}', 0, NULL, 1698678896),
(6, 4, '9aa126e302832b2c95e29b11263b5e9f', 'eman.olivas@gmail.com', 'Emmanuel Olivas', NULL, 1, '1', '{\"account\":{\"access\":true},\"users\":{\"access\":true,\"delete\":true},\"leads\":{\"access\":true,\"delete\":true},\"properties\":{\"access\":true,\"delete\":true},\"premiums\":{\"process_subscription\":true},\"transactions\":{\"access\":true}}', 0, NULL, 1707224266),
(7, 13, '25d55ad283aa400af464c76d713c07ad', 'webadmin@email.com', 'Web Admin', 'http://cdn.mls//images/accounts/62431056605513408591884938382327130853331412768908_25b068b08614baf21ff7948e212a68ec.png', 1, 'active', '{\"web_settings\":{\"access\":true,\"edit\":true},\"articles\":{\"access\":true,\"edit\":true,\"delete\":true}}', 0, NULL, 1708955333),
(8, 14, '25d55ad283aa400af464c76d713c07ad', 'customer_service@email.com', 'Customer Service', 'http://cdn.mls//images/accounts/39458210912031056194403473478696932053484928515886_93bdc4f8d9d2671146f22a2827041f01.webp', 1, '1', '{\"accounts\":{\"access\":true,\"edit\":true},\"users\":{\"access\":true,\"edit\":true},\"properties\":{\"access\":true,\"edit\":true},\"premiums\":{\"process_subscription\":true}}', 0, NULL, 1708955333);

-- --------------------------------------------------------

--
-- Table structure for table `mls_user_login`
--

DROP TABLE IF EXISTS `mls_user_login`;
CREATE TABLE IF NOT EXISTS `mls_user_login` (
  `user_login_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `session_id` text,
  `status` tinyint NOT NULL DEFAULT '0',
  `login_details` text,
  `login_at` int NOT NULL,
  PRIMARY KEY (`user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mls_user_login`
--

INSERT INTO `mls_user_login` (`user_login_id`, `user_id`, `session_id`, `status`, `login_details`, `login_at`) VALUES
(2, 1, 'nklaojrt42l1g0q6tfp84u3sp3', 0, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709561325),
(3, 1, 'mt7mle003kprddjpj9qgi3hjar', 0, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709562156),
(4, 1, 'd0vr9m3aero1dh048k7n1ql7sm', 0, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709562315),
(5, 1, 'ev0th8k0vq68nv03kn2n1q2lm9', 0, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709563084),
(6, 1, '4mfn0taeuviutt91iv86389ir9', 0, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709563412),
(7, 1, 'i8omvee7tq1vnmshrus0ifhdau', 0, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709563597),
(8, 1, 'greblj6efa4ej3j2c5m244pop5', 0, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709564385),
(9, 1, 'bk2q0emg25qhrb8a9h1nep6qed', 0, '{\"ip_address\":\"158.62.33.138\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709566739),
(10, 1, 'c04levms566q10pp4k925uo1v6', 0, '{\"ip_address\":\"180.190.40.23\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1709642076),
(11, 1, 'jardj58i7og5g8r6j62arsq0t7', 0, '{\"ip_address\":\"180.190.40.23\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1709642781),
(12, 1, '1kjn558vo18o82q1lrkd7ak5ev', 0, '{\"ip_address\":\"180.190.40.23\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1709643186),
(13, 1, 'jrk92c0pmbnt0ba9nhluhu6uhc', 0, '{\"ip_address\":\"180.190.40.23\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1709643209),
(14, 1, '36ai2qcq618h81ims8o8iu37cl', 0, '{\"ip_address\":\"180.190.40.23\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1709645235),
(15, 1, 'ue2a2dfe83hocrc4b3o4n1m96g', 0, '{\"ip_address\":\"180.190.40.23\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1709647147),
(16, 1, 'gkevkhqm3vq0h9vk3sf7b17nag', 0, '{\"ip_address\":\"180.190.40.23\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1709649221),
(17, 1, 'q1jv9cargvb9h09b4hob3btje3', 0, '{\"ip_address\":\"158.62.38.46\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709729098),
(18, 1, '9u1uqljf3o3ekgch2km6rilir9', 0, '{\"ip_address\":\"158.62.33.34\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709815800),
(19, 1, '4teee0o48hab3i98p7dvdjolb0', 0, '{\"ip_address\":\"158.62.33.34\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709815849),
(20, 1, '1b4qqb3f7ick9g9110kohp4n6i', 0, '{\"ip_address\":\"158.62.33.34\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709816141),
(21, 1, '7tjki2qc9o26femtm6q74qsdjs', 0, '{\"ip_address\":\"158.62.41.64\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1709895025),
(22, 1, '33va1dihvlj3l8jd33kd3kq41q', 0, '{\"ip_address\":\"180.190.33.61\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1709975383),
(23, 6, 'bfl6pcmg300tioq4ejeqcq0vc4', 0, '{\"ip_address\":\"180.190.33.61\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1709975434),
(24, 1, '6tbuq2fhd1l0ddatigfviak1te', 0, '{\"ip_address\":\"180.190.33.61\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1709979642),
(25, 1, '7u9abcencsm05ftrufcp7rim58', 0, '{\"ip_address\":\"180.190.33.61\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1709989546),
(26, 1, 'u4hmhvlqq8lqtjpliae5rds2b6', 0, '{\"ip_address\":\"180.190.33.61\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1710035469),
(27, 6, 'i5rjs1747cv7udldt33ehj68jt', 1, '{\"ip_address\":\"180.190.33.61\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"San Juan\",\"latitude\":\"14.6077\",\"longitude\":\"121.0465\",\"location_accuracy_radius\":\"20\"}}', 1710085632),
(28, 1, 'ju0df4aanlcnibl7cni0cpd8ej', 0, '{\"ip_address\":\"158.62.42.31\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"10\"}}', 1710162413),
(29, 1, '58gngffpdg3if8lpgp40u06208', 0, '{\"ip_address\":\"158.62.36.153\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710250084),
(30, 1, 'cdhlicbh4maje9iv4jsolq1g5c', 0, '{\"ip_address\":\"158.62.36.153\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710250560),
(31, 1, 'rgmvrric6bdqb39a2njvf3vmqh', 0, '{\"ip_address\":\"158.62.36.153\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710251431),
(32, 1, 'vnqikhn6qbtferal3etat5s4un', 0, '{\"ip_address\":\"158.62.36.153\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 6.0; Nexus 5 Build\\/MRA58N) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Mobile Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710252713),
(33, 1, 'iuvamie20j2l06pb2odq3ot7ek', 0, '{\"ip_address\":\"158.62.36.153\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710253373),
(34, 1, 'v4j8i1uvo48kcqovjmbdb025f6', 0, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710508155),
(35, 1, 'b62nm7mtkpletrpubtm4mtho8c', 0, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710573895),
(36, 1, '0k66cnc2igjfns9d9kp3if6osm', 0, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710583196),
(37, 1, 'r3vhdh0s1kbjaujteb4lsd7vid', 0, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710818750),
(38, 1, 'g0mniotfti6ihtgmkaeaph3hm1', 0, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710819381),
(39, 1, 'u9uuhmk4l47jcltolr5bmfuvcg', 0, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710819905),
(40, 1, '9jiuco00fcgfssi3t6dbp3dqi8', 0, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710843229),
(41, 1, 'qdjda1qk3mnb2ash68eo8c8tvd', 0, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710853372),
(42, 1, 't4h5raidund7m5t062ngk01qu3', 1, '{\"ip_address\":\"158.62.43.59\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1710853738);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mls_listings`
--
ALTER TABLE `mls_listings` ADD FULLTEXT KEY `name` (`type`,`title`,`tags`,`long_desc`,`category`,`address`,`amenities`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
