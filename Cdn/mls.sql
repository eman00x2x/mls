-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 28, 2024 at 02:10 PM
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
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) DEFAULT NULL,
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
  `kyc_verified` int NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `registration_date` int NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_accounts`
--

INSERT INTO `mls_accounts` (`account_id`, `reference_id`, `account_type`, `logo`, `company_name`, `profession`, `real_estate_license_number`, `firstname`, `lastname`, `birthdate`, `street`, `city`, `province`, `mobile_number`, `email`, `tin`, `profile`, `uploads`, `preferences`, `privileges`, `kyc_verified`, `status`, `registration_date`) VALUES
(1, 1, 'Administrator', 'http://cdn.mls/images/accounts/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg', 'EmanPO&Ntilde;', 'Real Estate Broker', '27431', 'Eman', 'Olivas', '1988-08-18', '55 Justice R jabson St Bambang', 'Pasig City', 'National Capital Region', '09175223499', 'eman00x2xx@gmail.com', '666-666-6663', '<p>test test test test</p>', '', '', '{\"max_post\":\"15\",\"max_users\":\"10\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', 0, 'active', 2147483647),
(4, 4, 'Real Estate Practitioner', 'http://cdn.mls/images/accounts/63644612977582993355262220530895691927503826826109_1fa693e8267edb06373b6b016f5ee7b7.png', 'Olivas Tech', 'Real Estate Broker', '87431', 'Emmanuel', 'Olivas', '1988-08-18', '55 Justice R Jabson St Bambang', 'Pasig City', 'Metro Manila', '09175223499', 'eman.olivas@gmail.com', NULL, '0', NULL, NULL, '{\"max_post\":\"30\",\"max_users\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', 0, 'active', 2147483647),
(13, 0, 'Web Admin', NULL, '1', 'Real Estate Consultant', '1', 'Web', 'Admin', '2024-02-26', '1', '1', '1', '1', 'webadmin@email.com', '1', '', NULL, NULL, '{\"max_post\":\"20\",\"max_users\":\"100\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', 0, 'active', 1708955333),
(14, 0, 'Customer Service', NULL, '1', '1', '1', 'Customer', 'Service', '2024-02-26', '1', '1', '1', '1', 'customer_service@email.com', '1', '', NULL, NULL, '{\"max_post\":\"20\",\"max_users\":\"100\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', 0, 'active', 1708955333);

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
(1, 1, 1, 3, 1707623200, 1707623200, 0, 1710215200),
(2, 1, 2, 1, 1707623601, 1707623601, 0, 1710215601),
(3, 1, 3, 8, 1707637596, 1707637596, 1, 1710229596),
(4, 1, 4, 8, 1707637883, 1707637883, 0, 1710229883),
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_handshakes`
--

INSERT INTO `mls_handshakes` (`handshake_id`, `requestor_account_id`, `requestor_details`, `requestee_account_id`, `listing_id`, `handshake_status`, `handshake_status_date`, `requested_date`) VALUES
(8, 1, '{\n    \"account_id\": 1,\n    \"reference_id\": 1,\n    \"logo\": \"http:\\/\\/cdn.mls\\/images\\/accounts\\/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg\",\n    \"company_name\": \"EmanPO&Ntilde;\",\n    \"profession\": \"Real Estate Broker\",\n    \"real_estate_license_number\": 27431,\n    \"firstname\": \"Eman\",\n    \"lastname\": \"Olivas\",\n    \"birthdate\": \"1988-08-18\",\n    \"street\": \"55 Justice R jabson St Bambang\",\n    \"city\": \"Pasig City\",\n    \"province\": \"National Capital Region\",\n    \"mobile_number\": \"09175223499\",\n    \"email\": \"eman00x2xx@gmail.com\",\n    \"tin\": \"666-666-6663\",\n    \"profile\": \"<p>test test test test<\\/p>\",\n    \"kyc_verified\": 0,\n    \"status\": \"active\",\n    \"registration_date\": 2147483647\n}', 1, 1, 'done', 1708088481, 1708088451),
(9, 1, '{\n    \"account_id\": 1,\n    \"reference_id\": 1,\n    \"logo\": \"http:\\/\\/cdn.mls\\/images\\/accounts\\/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg\",\n    \"company_name\": \"EmanPO&Ntilde;\",\n    \"profession\": \"Real Estate Broker\",\n    \"real_estate_license_number\": 27431,\n    \"firstname\": \"Eman\",\n    \"lastname\": \"Olivas\",\n    \"birthdate\": \"1988-08-18\",\n    \"street\": \"55 Justice R jabson St Bambang\",\n    \"city\": \"Pasig City\",\n    \"province\": \"National Capital Region\",\n    \"mobile_number\": \"09175223499\",\n    \"email\": \"eman00x2xx@gmail.com\",\n    \"tin\": \"666-666-6663\",\n    \"profile\": \"<p>test test test test<\\/p>\",\n    \"kyc_verified\": 0,\n    \"status\": \"active\",\n    \"registration_date\": 2147483647\n}', 1, 2, 'denied', 1708089103, 1708089094),
(10, 1, '{\n    \"account_id\": 1,\n    \"reference_id\": 1,\n    \"logo\": \"http:\\/\\/cdn.mls\\/images\\/accounts\\/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg\",\n    \"company_name\": \"EmanPO&Ntilde;\",\n    \"profession\": \"Real Estate Broker\",\n    \"real_estate_license_number\": 27431,\n    \"firstname\": \"Eman\",\n    \"lastname\": \"Olivas\",\n    \"birthdate\": \"1988-08-18\",\n    \"street\": \"55 Justice R jabson St Bambang\",\n    \"city\": \"Pasig City\",\n    \"province\": \"National Capital Region\",\n    \"mobile_number\": \"09175223499\",\n    \"email\": \"eman00x2xx@gmail.com\",\n    \"tin\": \"666-666-6663\",\n    \"profile\": \"<p>test test test test<\\/p>\",\n    \"kyc_verified\": 0,\n    \"status\": \"active\",\n    \"registration_date\": 2147483647\n}', 4, 4, 'active', 1708089141, 1708089141);

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
(1, 1, 1, 'eman olivas', '09175223499', 'eman.olivas@gmail.com', 'test inquiry', '{\"type\":\"Residential\",\"bedroom\":\"3\",\"bathroom\":\"2\",\"parking\":\"3\",\"lot_area\":\"200\",\"category\":\"House and Lot\",\"address\":{\"barangay\":\"\",\"municipality\":\"Pasig City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}}', 1706859656),
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
  `display` tinyint UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = show, 2 = hidden',
  PRIMARY KEY (`listing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mls_listings`
--

INSERT INTO `mls_listings` (`listing_id`, `account_id`, `is_mls`, `is_website`, `offer`, `type`, `foreclosed`, `name`, `title`, `tags`, `long_desc`, `category`, `address`, `price`, `reservation`, `monthly_downpayment`, `monthly_amortization`, `floor_area`, `lot_area`, `unit_area`, `bedroom`, `bathroom`, `parking`, `thumb_img`, `video`, `amenities`, `other_details`, `date_added`, `last_modified`, `status`, `display`) VALUES
(1, 1, 1, 1, 'for sale', 'Residential', 0, 'samplesss', 'samplesss', '[\"New\"]', '<p>sample esar&nbsp;</p>', 'Condominium', '{\"barangay\":\"\",\"municipality\":\"Pasig City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', 16000000, 100000.00, 600000.00, 80000.00, 233, 2589, 233, 4, 2, 2, 'http://cdn.mls/images/listings/18362362385124463689010255540495713831578558815919_0bd3dfef0e2e42824866367511e1ea81.webp', NULL, 'Lap Pool,Bowling Room,Basket Ball Court,Game rooms,Day care centers,Lobby,Club House,Function Halls,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"com_share\":\"2\"}', 1698849808, 1707745112, 1, 1),
(2, 1, 1, 0, 'for sale', 'Residential', 0, 'test', 'test', '[\"New\",\"Pre Owned\"]', '<p>test</p>', 'House and Lot', '{\"barangay\":\"Sipac-Almacen\",\"municipality\":\"Navotas City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', 1500000, 20000.00, 56000.00, 85000.00, 0, 0, 0, 0, 0, 0, 'http://cdn.mls//images/listings/20589086521943721573908927020568652944736005968973_0d2ddc51bced3a7da9c49208c52c1167.webp', NULL, 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"com_share\":\"2\"}', 1699018530, 1706408975, 1, 1),
(3, 1, 1, 1, 'for sale', 'Residential', 0, 'modern-2-storey-5-bedrooms-alabang-400-village-muntinlupa-city', 'Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City', '[\"New\"]', '<p>5 bedrooms with toilet and bath</p>\r\n<ul>\r\n<li>walk in closet in bedrooms upstairs</li>\r\n<li>ensuite in all bedrooms</li>\r\n<li>bathtub in master&rsquo;s bedroom</li>\r\n<li>airconditioning in 4 rooms and living area</li>\r\n<li>hot and cold water system</li>\r\n</ul>\r\n<p>25m frontage</p>\r\n<p>Built 2010</p>\r\n<p>3 elevated under cover garage</p>\r\n<p>High ceiling</p>\r\n<p>Open plan concept</p>\r\n<p>Balcony at rear</p>\r\n<p>Pantry room</p>\r\n<p>Big garden</p>\r\n<p>SP: 35 M gross</p>\r\n<p>Clean title</p>\r\n<p>RFS: family migrating to Australia</p>', 'House and Lot', '{\"barangay\":\"New Alabang Village\",\"municipality\":\"Muntinlupa City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', 1500000, 20000.00, 56000.00, 85000.00, 300, 412, 0, 5, 5, 2, 'http://cdn.mls/images/listings/34386680823233921755628498012360148501361322493813_7e12b9298c1869571ac20626b9bbb411.webp', NULL, 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"com_share\":\"\"}', 1699019091, 1708229211, 1, 1),
(4, 4, 1, 0, 'for sale', 'Residential', 0, 'testing', 'testing', '[\"New\",\"Pre Owned\"]', '<p>test</p>', 'Subdivision Lot', '{\"barangay\":\"Lower Sulitan\",\"municipality\":\"Naga\",\"province\":\"Zamboanga Sibugay\",\"region\":\"Region IX\"}', 1500000, 20000.00, 56000.00, 85000.00, 0, 0, 0, 0, 0, 0, 'http://cdn.mls//images/listings/55141816083775074918346737185762835964551378384965_ae7a8e233176ecb7a64763d494530f5a.webp', NULL, 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"com_share\":\"2\"}', 1699019712, 1706409221, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mls_listings_view`
--

DROP TABLE IF EXISTS `mls_listings_view`;
CREATE TABLE IF NOT EXISTS `mls_listings_view` (
  `listing_view_id` bigint NOT NULL AUTO_INCREMENT,
  `listing_id` bigint UNSIGNED NOT NULL,
  `account_id` bigint NOT NULL,
  `session_id` int NOT NULL,
  `created_at` int UNSIGNED NOT NULL DEFAULT '0',
  `user_agent` text COMMENT 'user agent info',
  PRIMARY KEY (`listing_view_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_listings_view`
--

INSERT INTO `mls_listings_view` (`listing_view_id`, `listing_id`, `account_id`, `session_id`, `created_at`, `user_agent`) VALUES
(7, 1, 1, 0, 1707361316, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(8, 1, 1, 0, 1707362832, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(9, 1, 1, 0, 1707362840, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(10, 1, 1, 0, 1707362842, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(11, 1, 1, 0, 1707362944, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(12, 1, 1, 0, 1707366967, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(13, 1, 1, 0, 1707378692, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(14, 1, 1, 0, 1707378761, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(15, 1, 1, 0, 1707378875, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(16, 1, 1, 0, 1707378876, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(17, 1, 1, 0, 1707378950, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(18, 1, 1, 0, 1707379054, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(19, 1, 1, 0, 1707379089, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(20, 1, 1, 0, 1707379101, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(21, 1, 1, 0, 1707379107, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(22, 1, 1, 0, 1707392155, '{\"ip\":\"158.62.33.146\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(23, 1, 1, 0, 1707742908, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(24, 1, 1, 0, 1707743150, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(25, 3, 1, 0, 1707743329, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(26, 3, 1, 0, 1707743409, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(27, 3, 1, 0, 1707744725, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(28, 3, 1, 0, 1707744783, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(29, 3, 1, 0, 1707744917, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(30, 1, 1, 0, 1707744921, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(31, 1, 1, 0, 1707745097, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(32, 3, 1, 0, 1707745099, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(33, 1, 1, 0, 1707745116, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(34, 1, 1, 0, 1707746212, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(35, 3, 1, 0, 1707746217, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(36, 3, 1, 0, 1707746299, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(37, 3, 1, 0, 1707746323, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(38, 3, 1, 0, 1707746348, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(39, 3, 1, 0, 1707746358, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(40, 3, 1, 0, 1707746365, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(41, 3, 1, 0, 1707746419, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(42, 3, 1, 0, 1707746495, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(43, 3, 1, 0, 1707746503, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(44, 3, 1, 0, 1707746529, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(45, 3, 1, 0, 1707746553, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(46, 3, 1, 0, 1707747087, '{\"ip\":\"158.62.42.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(47, 4, 4, 0, 1707830526, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(48, 4, 4, 0, 1707830537, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(49, 4, 4, 0, 1707830718, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(50, 4, 4, 0, 1707830752, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(51, 4, 4, 0, 1707830807, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(52, 4, 4, 0, 1707830826, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(53, 4, 4, 0, 1707830845, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(54, 4, 4, 0, 1707830926, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(55, 4, 4, 0, 1707830942, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(56, 4, 4, 0, 1707831042, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(57, 4, 4, 0, 1707831068, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(58, 4, 4, 0, 1707831074, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(59, 4, 4, 0, 1707831127, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(60, 4, 4, 0, 1707831170, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(61, 4, 4, 0, 1707831311, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(62, 4, 4, 0, 1707831330, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(63, 4, 4, 0, 1707831434, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(64, 4, 4, 0, 1707831516, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(65, 4, 4, 0, 1707831640, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(66, 4, 4, 0, 1707831654, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(67, 4, 4, 0, 1707831667, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(68, 4, 4, 0, 1707831685, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(69, 4, 4, 0, 1707831695, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(70, 4, 4, 0, 1707831702, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(71, 4, 4, 0, 1707831942, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(72, 4, 4, 0, 1707831954, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(73, 4, 4, 0, 1707831971, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(74, 4, 4, 0, 1707832537, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(75, 4, 4, 0, 1707832548, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(76, 4, 4, 0, 1707832687, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 6.0; Nexus 5 Build\\/MRA58N) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Mobile Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(77, 4, 4, 0, 1707832703, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 6.0; Nexus 5 Build\\/MRA58N) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Mobile Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(78, 4, 4, 0, 1707832750, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(79, 4, 4, 0, 1707832767, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(80, 4, 4, 0, 1707832777, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(81, 4, 4, 0, 1707832790, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(82, 4, 4, 0, 1707832798, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(83, 4, 4, 0, 1707832807, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Chrome\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),
(84, 4, 4, 0, 1707832841, '{\"ip\":\"{\\\"ip\\\":\\\"158.62.42.114\\\"}\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 6.0; Nexus 5 Build\\/MRA58N) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Mobile Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

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
(17, 3, '74102549873087023300905606801695618772178220146852_b22e1a32d31d1c1a0673fe8a977312a3.jpg', 'http://cdn.mls/images/listings/74102549873087023300905606801695618772178220146852_b22e1a32d31d1c1a0673fe8a977312a3.jpg', 0),
(18, 3, '75880370339576424995116784677342901921213450313865_b22e1a32d31d1c1a0673fe8a977312a3.jpg', 'http://cdn.mls/images/listings/75880370339576424995116784677342901921213450313865_b22e1a32d31d1c1a0673fe8a977312a3.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mls_messages`
--

DROP TABLE IF EXISTS `mls_messages`;
CREATE TABLE IF NOT EXISTS `mls_messages` (
  `message_id` bigint NOT NULL AUTO_INCREMENT,
  `thread_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_messages`
--

INSERT INTO `mls_messages` (`message_id`, `thread_id`, `user_id`, `content`, `is_read`, `created_at`) VALUES
(102, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwP92hQXhpM717zds3xbMMeP0=', 0, 1708177364),
(103, 3, 1, 'FW7n8hBxowkclSWr6M7Z+t5FJLqdzTaj5nPmeIL3CjotNfEn2dthwqgLZ6LVwl+JjN8Xp47S9G+q2gJ6AZuDgfjLDVOL6GBjyfD/kZ6WwEml878m4WdphGJP67LGhRObc51k92LaEPmggeQN+Pxpk6PFpigcaMTYlR7txSBGUF2Sr19CHvLcdOP6R5VoQTDWT2LOc8wnlSfbHzpBO6Xbkv08yl2QLIfoGAo=', 0, 1708177366),
(104, 3, 1, 'FW7n8hBxowkclSWr6M7Z+t5FJLqdzTaj5nPmeIL3CjotNfEn2dthwqgLZ6LVwl+JjN8Xp47S9G+q2gJ6AZuDgfjLDVOL6GBjyfD/kZ6WwEmi+7ol5WFihm1C6rPCixKdd5ht9GfYEPusgeYP+PJtlaHOpyMZYs7fkBzqySdHWliWr1gWGPWMfrD5EJFrHDCFG2POI88kxCjUTmkQOqDZwKk8ykeOLIfoGAo=', 0, 1708177370),
(105, 3, 1, 'FW7n8hBxowkclSWr6M7Z+t5FJLqdzTaj5nPmeIL3CjotNfEn2dthwqgLZ6LVwl+JjN8Xp47S9G+q2gJ6AZuDgfjLDVOL6GBjyfD/kZ6WwEum8b0h5W5ihW1I7rzAixKbcpNm9WPYFvmuhOsK+fptmaTBpi8dZsvRkB7oyy5BX1+dr1hDH6SJceGvQpY7T2DQTzGeJsB7kH3QHT1AO/OOx/9nyl2QLIeZRx+1U0tCvWGUfZw7xl0hd4ZMxDJeZNdv49NiJmcOVga/6nt3nXzCBSf5hdci8X3Yqt1ZewRhE3TSStGXLDSpQyxxuFcmSGOFQDYU4aAKwbr3dcqfaZ7ko8VMfyL+bAkFfDJXYIJFm1SVEg6UCKU4al4syaMt9Bosy6OS+Q==', 0, 1708177389),
(106, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwP92hQzkueP8/y5drxORaevWD9QA=', 0, 1708177566),
(121, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwP92hQXhpM717zds3xbMMeP0=', 0, 1708184135),
(122, 3, 1, 'FW7n8hBxowkclSWr6M7Z+t5FJLqdzTaj5nPmeIL3CjotNfEn2dthwqgLZ6LVwl+JjN8Xp47S9G+q2gJ6AZuDgfjLDVOL6GBjyfD/kZ6WwEOu9bws4GRohGtI7rvDiR6ecpxk9GbfGvSrhuoO8/prmKnPoCkaYcXZkB/vySNFUVeUr15ATfSJc+L4QJBuSmLVTjLIeJp6xi6ASW0RNPPZx6o4ykeOLIfoGAo=', 0, 1708184250),
(123, 3, 1, 'FW7n8hBxowkclSWr6M7Z+t5FJLqdzTaj5nPmeIL3CjotNfEn2dthwqgLZ6LVwl+JjN8Xp47S9G+q2gJ6AZuDgfjLDVOL6GBjyfD/kZ6WwEKj8L4j72Nngm5K67/OihOfdp9k8WbbFPWrgeYP+fJsl6XApCgZaMnRlxvtyy5PXl2Wr1oeT/eOf+L+FsA1SDGLSjaZdcAmmyjWHzoVYafWyP46ykeOLIfoGAo=', 0, 1708184268),
(124, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwP92hQXhpM717zds3xbMMeP0=', 0, 1708184298),
(125, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/mu9KMqsQXhpM717zds3xbMMeP0=', 0, 1708184464),
(126, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwP92hBidpdvF0zJ9iifwOYeyD5A==', 0, 1708184504),
(127, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwP92hQXhpM717zds3xbMMeP0=', 0, 1708184594),
(128, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwP92hQXhpM717zds3xbMMeP0=', 0, 1708184642),
(129, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwP92mBzBpdvF0zJ9iifwOYeyD5A==', 0, 1708184895),
(130, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwP92hQXhpM717zds3xbMMeP0=', 0, 1708185039),
(131, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwKcqzQXhpM717zds3xbMMeP0=', 0, 1708185131),
(132, 3, 1, 'FW7n8hBxowkclSWr6M7Z+t5FJLqdzTaj5nPmeIL3CjotNfEn2dthwqgLZ6LVwl+JjN8Xp47S9G+q2gJ6AZuDgfjLDVOL6GBjyfD/kZ6WwEKi970j429pgG9J7r/FjBScdJ9s8GTeFvythuAN9vxumKjOoC0facnakhLtzyBCWVqXr11CEPWIJ+miRMduSTWFSmaaeZxxmiuATj1HMqLbxK4/ykeOLIfoGAo=', 0, 1708186801),
(133, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwP92hQXhpM717zds3xbMMeP0=', 0, 1708186806),
(134, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwP92hUHZneLpzxJYvkagVeOyS', 0, 1708186922),
(135, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/mvxaZ+mAjBpdvF0zJ9iifwOYeyD5A==', 0, 1708186924),
(136, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/mu9P933T3YiNLVygMNj3qoMaQ==', 0, 1708226285),
(137, 3, 1, 'FW7n8hBxowkciC2y+4nX9JFNMrqPyzTk/muwP92hQXhpM717zds3xbMMeP0=', 0, 1708227222);

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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(15, 1, '{\"title\":\"Eman Olivas denied your handshake request\",\"message\":\"test\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/2\"}', 1, 1708089103),
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
(91, 4, '{\"title\":\"Eman Olivas\",\"message\":\"Sent you a message\",\"url\":\"http:\\/\\/manage.mls\\/threads\\/WzEsNF0=\"}', 1, 1708227222);

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

INSERT INTO `mls_settings` (`id`, `contact_info`, `property_tags`, `paypal_credentials`, `show_vat`, `chat_is_websocket`, `email_address_responder`, `enable_kyc_verification`, `enable_premium`, `enable_pin_access`, `privileges`, `analytics`, `header_script`, `data_privacy`, `terms`, `refund_policy`, `modified_at`) VALUES
(1, '{\"mobile_number\":\"09199999999\",\"email\":\"myorg@email.com\",\"office_address\":\"55 sitio st brgy pinagkaisahan quezon city\"}', '[\"New\",\"Pre-Owned\",\"Fully Furnished\",\"Bare Unit\"]', '{\"client_id\":\"AczoZMmV6Tkw24LL55FDfCaCMsp7aSo5bf75EFLy22u0nswrH15Cmrac2tsimtGCLaiU35vb605Pi3oF\",\"client_secret\":\"EOxCjX0hgxSaffhW1QEFZcqto_LBL_qnAIl22TuYH1sVio-AljiMdb6ti95V8z0lb_RbKLexNcSSibE0\"}', 0, 1, 'noreply@email.com', 0, 1, 0, '{\"max_post\":\"15\",\"max_users\":\"2\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', NULL, NULL, '<h3 style=\"text-align: justify;\">Privacy Statement</h3>\r\n<p style=\"text-align: justify;\">Your personal information is important to My Organization., its employees, agents or representatives (collectively referred to as \"Organization\", \"we\", \"us\" or \"our\"). We handle your personal information and data in accordance with Republic Act No. 10173, otherwise known as the Data Privacy Act of 2012, and its Implementing Rules and Regulations, other issuances of the National Privacy Commission and other relevant laws of the Philippines (collectively, the \"DPA\"). We recognize the importance of your rights as a Data Subject under the DPA, as follows:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Right to be informed</li>\r\n<li>Right to object</li>\r\n<li>Right to access</li>\r\n<li>Right to correct</li>\r\n<li>Right to rectification, erasure or blocking</li>\r\n<li>Right to damages</li>\r\n<li>Right to data portability</li>\r\n<li>Transmissibility of rights</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">This Privacy Policy aims to provide information on how we collect, use, manage, and secure your personal information. Any information you provide to us indicates your express consent to our Privacy Policy.</p>\r\n<h3 style=\"text-align: justify;\">Personal Information Collection</h3>\r\n<p style=\"text-align: justify;\">Personal Information under the DPA refers to any information, whether recorded in a material form or not, from which the identity of an individual is apparent or can be reasonably and directly ascertained by the entity holding such information, or such information, when put together with other information, would directly and certainly identify an individual.</p>\r\n<p style=\"text-align: justify;\">In the performance of our services, or as part of our transactions and dealings, we collect your personal information which may include, but not limited to, the following:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Your name, nationality, civil status, gender, age, birthdate, ID details, unique identifiers, email address, residence, office, and mailing address, phone numbers and other information, as part of our transactions and dealings with you.</li>\r\n<li>Your browsing and social media behavior, when you browse into our website, download mobile applications and tag or mention us on your social media accounts.</li>\r\n<li>Any information you submit when to our sales, account management, or customer relations agents for update of your records or information; in relation to your inquiries or requests; when you participate in our survey, discount, event information and prize promotion; when you refer a person to verify the information you provided to us; when you visit and connect to our websites and social media pages; or any other event or activity that may be similar or related to any of the foregoing.</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">When you provide information other than your own, you certify that you have obtained the consent and authority of the owner of such information (such as your parents, spouse, children, dependent, or any other person) to allow us to disclose and process such information.</p>\r\n<h3 style=\"text-align: justify;\">Use and Sharing of Personal Information</h3>\r\n<p style=\"text-align: justify;\">We use your personal information to:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Process the products and services that you have availed from us.</li>\r\n<li>Communicate our latest products, services, promos and events.</li>\r\n<li>Respond immediately to your needs, requests, queries and complaints.</li>\r\n<li>Comply with the law, rule or regulation and all legal orders and processes.</li>\r\n<li>Process your application and conduct due diligence for, and documentation of, our transaction.</li>\r\n<li>Any other purpose relating to any of the above.</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">We share your personal information, to the extent that is reasonable and necessary, to:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Our employees or other personnel handling your transactions, orders or requests.</li>\r\n<li>Banks, insurers or professional advisers in connection with due diligence and documentation of your transaction.</li>\r\n<li>Any third-party service provider performing financial, administrative, technical and other ancillary services.</li>\r\n<li>Government institution and other competent authorities which by law, rules or regulations require us to disclose your personal information.</li>\r\n<li>Any person or entity we contractually entered with and who ensures the confidentiality standard we implement and adheres to the DPA.</li>\r\n<li>Any person in order to carry out functions of public authority, and for collection and further processing pertaining to law enforcement, taxation or other regulatory function.</li>\r\n</ol>\r\n<h3 style=\"text-align: justify;\">Personal Information Retention and Protection</h3>\r\n<p style=\"text-align: justify;\">We retain your personal information:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>To the extent necessary in keeping track of your transaction and records.</li>\r\n<li>As may be agreed upon by the parties to a contract.</li>\r\n<li>For statistical, research and other purpose specifically authorized by law.</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">Data collected will be retained in accordance with retention limit set by our standards, industry standards and laws and regulations, unless you request your data to be deleted in our database.</p>\r\n<p style=\"text-align: justify;\">To maintain the integrity and confidentiality of your personal information, we put in place organizational, physical and technical security measures to protect your personal information, such as:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Use of secured servers, firewalls, encryptions and other latest security tools.</li>\r\n<li>Limited access to personal information to those duly authorized processors. All transfers are made after complying with the established confidentiality policy and practices in place.</li>\r\n<li>Maintain a secured server operating environment by performing regular security patch update and server hardening.</li>\r\n</ol>\r\n<h3 style=\"text-align: justify;\">Cookies and Related Technologies</h3>\r\n<p style=\"text-align: justify;\">A cookie is a small piece of file which originates from a website and is transferred to the user\'s hard drive to record the user\'s browsing activity. Cookies were designed to remember pieces of information that the user has entered in a certain website. Essentially, cookies help in making the browsing of our site easier by, among other things, saving your name, addresses, passwords and other preferences.</p>\r\n<p style=\"text-align: justify;\">Most web browsers are set to automatically accept cookies, but you have the option to refuse all cookies or indicate when a cookie is being sent. However, if you choose not to accept cookies, you may experience some delay in browsing our website or it will not function properly or may be considerably slower.</p>\r\n<h3>Google Analytics</h3>\r\n<p>We use Google Analytics, an analytics service provided by Google LLC. We use this service to help analyze how users use the Service, with a view to analyzing usage across devices and offering improvements for all users. To learn more about Google Analytics, please visit their <a href=\"https://support.google.com/analytics/answer/6004245#zippy=%2Cour-privacy-policy\">Privacy Policy</a>. To opt-out of this feature by installing the Google Analytics Opt-out Browser Add-on, please click <a href=\"https://tools.google.com/dlpage/gaoptout?hl=en\">here</a>.</p>\r\n<h3>Newsletters</h3>\r\n<p>You can opt out of receiving our marketing emails and/or newsletters by contacting us as described under &ldquo;Contact Us&rdquo; below. We may still send you transactional messages, which include Services-related communications and responses to your questions.</p>\r\n<h3 style=\"text-align: justify;\">Renewal of Policy</h3>\r\n<p style=\"text-align: justify;\">We may periodically update or amend our Privacy Policy in order to adhere to new and existing laws affecting the DPA, including any change or improvement we establish to secure your personal information. Any updates or changes shall not alter how we handle previously collected personal data without obtaining your consent, unless required by law.</p>\r\n<h3 style=\"text-align: justify;\">Contact Us</h3>\r\n<p style=\"text-align: justify;\">For any comment, question or complaint regarding this Privacy Policy, you may contact our Data Protection Officer at:</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>Postal Address:</td>\r\n<td>Sample Address</td>\r\n</tr>\r\n<tr>\r\n<td>Telephone Number:</td>\r\n<td>0919999999</td>\r\n</tr>\r\n<tr>\r\n<td>Email Address:</td>\r\n<td>myorg@email.com</td>\r\n</tr>\r\n</tbody>\r\n</table>', '<h3>Introduction</h3>\r\n<p>This page states the terms and conditions under which you may use the website, [website name]. [website name] is operated by an Individual Trying to help Real Estate Brokers and Salespersons to increase their presence on the internet</p>\r\n<p><strong>Definitions</strong></p>\r\n<ul>\r\n<li>The terms \"you\" and \"user\" as used herein refer to all individuals and/or entities accessing [website name]</li>\r\n<li>The term \"Website\" as used herein refers to [domain name]</li>\r\n</ul>\r\n<p><strong>General</strong></p>\r\n<p>By using the Website, you are indicating your acceptance to be bound by these terms and conditions. The Website may revise these terms and conditions at any time by updating this page. You should visit this page periodically to review the terms and conditions, to which you are bound.</p>\r\n<p><strong>Terms of Use</strong></p>\r\n<ul>\r\n<li>Users may not use the Website in order to transmit, distribute, store or destroy material:\r\n<ul>\r\n<li>in violation of any applicable law or regulation;</li>\r\n<li>in a manner that will infringe the copyright, trademark, trade secret or other intellectual property rights of others or violate the privacy, publicity or other personal rights of others;</li>\r\n<li>that is defamatory, obscene, threatening, abusive or hateful.</li>\r\n</ul>\r\n</li>\r\n<li>The following is prohibited with respect to the Website:\r\n<ul>\r\n<li>Using any robot, spider, other automatic device or manual process to monitor or copy any part of the Website;</li>\r\n<li>Using any device, software or routine or the like to interfere or attempt to interfere with the proper working of the Website.</li>\r\n<li>Taking any action that imposes an unreasonable or disproportionately large load on the Website infrastructure;</li>\r\n<li>Copying, reproducing, altering, modifying, creating derivative works, or publicly displaying any content from the Website without the Website`s prior written permission;</li>\r\n<li>Reverse assembling or otherwise attempting to discover any source code relating to the Website or any tool therein, except to the extent that such activity is expressly permitted by applicable law notwithstanding this limitation; and</li>\r\n<li>Attempting to access any area of the Website to which access is not authorized.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p><strong>Copyright and Intellectual Property Rights</strong></p>\r\n<ul>\r\n<li>All content, trademarks and data on this Website, including but not limited to, software, databases, text, graphics, icons, hyperlinks, private information, and designs are the property of or licensed to the Website.</li>\r\n<li>Users of this Website are not granted a licence or any other right including without limitation under Copyright, Trade Mark, Patent or Intellectual Property Rights in/or to the content.</li>\r\n</ul>\r\n<p><strong>Security</strong></p>\r\n<ul>\r\n<li>Users are prohibited from violating or attempting to violate the security of the Website, including, but without limitation:\r\n<ul>\r\n<li>accessing data not intended for such user or logging into a server or account which the user is not authorized to access;</li>\r\n<li>attempting to probe, scan or test the vulnerability of a system or network or to breach security or authentication measures without proper authorization;</li>\r\n<li>attempting to interfere with service to any user, host or network, including, without limitation, via means of submitting a virus to the website, overloading, \"flooding\", \"spamming\", \"mail bombing\" or \"crashing\";</li>\r\n<li>sending unsolicited email, including promotions and/or advertising of products or services;</li>\r\n<li>forging any TCP/IP packet header or any part of the header information in any email or newsgroup posting;</li>\r\n<li>deleting or revising any material posted by any other person or entity;</li>\r\n<li>using any device, software or routine to interfere or attempt to interfere with the proper working of this website or any activity being conducted on this site.</li>\r\n</ul>\r\n</li>\r\n<li>Violations of system or network security may result in civil or criminal liability. The Website will investigate occurrences, which may involve such violations and may involve, and cooperate with, law enforcement authorities in prosecuting users who are involved in such violations.</li>\r\n</ul>\r\n<p><strong>Disclaimer</strong></p>\r\n<ul>\r\n<li>The Website carries property advertisements, news, reviews and other content independently published by third parties on the website. The Website is not involved in the buying, selling or development of the property process and must not be considered to be an agent, buyer and/or a developer with respect to the use of the Website.</li>\r\n<li>The Website shall not be responsible for any user entering into agreements or making decision whatever nature in connection with the posting of property ads, property information, personal owned property information, use of financial calculators and/or the contents thereof and/or any other information obtained on the Website.</li>\r\n<li>Whilst the Website has taken reasonable measures to ensure the integrity of the Website and its contents, no warranty, whether express or implied, is given that the Website will operate error-free or that any files, downloads or applications available via the Website are free of viruses, trojans, bombs, time-locks or any other data, code or harmful mechanisms which has the ability to corrupt or affect the operation of your system.</li>\r\n<li>In no event shall the Website, and/or any third party contributors of material to the Website be liable for any costs, expenses, losses and damages of any nature (whether direct, indirect, punitive, incidental, special or consequential) arising out of or in any way connected with your use of the Website, your inability to use the Website and/or the operational failure of the Website, and whether or not such costs, expenses, losses and damages are based on contract, delict, strict liability or otherwise.</li>\r\n<li>Insofar as the Website contains links to any other internet websites, you acknowledge and agree that the Website does not have control over any such website and the Website shall therefore not be liable in any way for the contents of any such linked website, nor for any costs, expenses, losses or damages of any nature whatsoever arising from your access and/or use of any such website.</li>\r\n</ul>\r\n<p><strong>Severability</strong></p>\r\n<ul>\r\n<li>These Terms &amp; Conditions constitute the entire agreement between the Website and you. Any failure by the Website to exercise or enforce any right or provision of these Terms &amp; Conditions shall in no way constitute a waiver of such right or provision.</li>\r\n<li>In the event that any term or condition is not fully enforceable or valid for any reason, such term(s) or condition(s) shall be severable from the remaining terms and conditions. The remaining terms and conditions shall not be affected by such unenforceability or invalidity and shall remain enforceable and applicable.</li>\r\n</ul>\r\n<p><strong>Applicable Law</strong></p>\r\n<p>This Website is hosted outside of Philippines and controlled, managed in the Philippines, and thus, Philippine law and jurisdiction govern the use or inability to use this Website, or any other matter related to this Website.</p>\r\n<p><strong>Disputes</strong></p>\r\n<p>All disputes in terms of this agreement or relating to the use or inability to use this Website shall be settled by arbitration conducted in English in terms of the rules of the Philippines Republican Act.</p>', '<p>refund policy</p>', 1709126752);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_threads`
--

INSERT INTO `mls_threads` (`thread_id`, `participants`, `created_by`, `created_at`, `status`) VALUES
(3, '[1, 4]', 4, 1707228232, 1),
(6, '[3, 4]', 4, 1707228232, 1),
(7, '[5, 7]', 4, 1707228232, 1);

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
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active, 2,blocked',
  `permissions` text,
  `two_factor_authentication` tinyint(1) NOT NULL DEFAULT '0',
  `two_factor_authentication_aps` varchar(50) DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mls_users`
--

INSERT INTO `mls_users` (`user_id`, `account_id`, `password`, `email`, `name`, `photo`, `user_level`, `status`, `permissions`, `two_factor_authentication`, `two_factor_authentication_aps`, `date_added`) VALUES
(1, 1, '9aa126e302832b2c95e29b11263b5e9f', 'eman00x2xx@gmail.com', 'Eman Olivas', 'http://cdn.mls/images/accounts/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg', 1, 1, '{\"accounts\":{\"access\":true,\"edit\":true,\"delete\":true},\"users\":{\"access\":true,\"edit\":true,\"delete\":true},\"properties\":{\"access\":true,\"edit\":true,\"delete\":true},\"premiums\":{\"access\":true,\"edit\":true,\"delete\":true,\"process_subscription\":false},\"web_settings\":{\"access\":true,\"edit\":true},\"settings\":{\"access\":true,\"edit\":true},\"articles\":{\"access\":true,\"edit\":true,\"delete\":true}}', 0, '', 1697967624),
(2, 1, 'fb0fd131cffe9a9fa9f50d98860ed581', 'test@test.com', 'Mayette Olivas', NULL, 2, 1, '{\"accounts\":{\"access\":true,\"edit\":true,\"delete\":true},\"users\":{\"access\":true,\"edit\":true,\"delete\":true},\"properties\":{\"access\":true,\"edit\":true,\"delete\":true},\"premiums\":{\"access\":true,\"edit\":true,\"delete\":true},\"web_settings\":{\"access\":true,\"edit\":true},\"settings\":{\"access\":true,\"edit\":true}}', 0, '', 1698589128),
(4, 4, '9aa126e302832b2c95e29b11263b5e9f', 'testtest@test.com', 'Tester', 'http://cdn.mls/images/users/03617413890977432093513486861793381434706645845303_e84317e5884cf95cdcedaf42e0ef9213.png', 2, 1, '{\"users\":{\"delete\":\"true\"},\"leads\":{\"delete\":\"true\"},\"properties\":{\"delete\":\"true\"}}', 0, NULL, 1698678896),
(6, 4, '9aa126e302832b2c95e29b11263b5e9f', 'eman.olivas@gmail.com', 'Emmanuel Olivas', NULL, 1, 1, '{\"account\":{\"access\":true},\"users\":{\"access\":true,\"delete\":true},\"leads\":{\"access\":true,\"delete\":true},\"properties\":{\"access\":true,\"delete\":true},\"premiums\":{\"process_subscription\":true},\"transactions\":{\"access\":true}}', 0, NULL, 1707224266),
(7, 13, '25d55ad283aa400af464c76d713c07ad', 'webadmin@email.com', 'Web Admin', NULL, 1, 1, '{\"web_settings\":{\"access\":true,\"edit\":true},\"articles\":{\"access\":true,\"edit\":true,\"delete\":true}}', 0, NULL, 1708955333),
(8, 14, '25d55ad283aa400af464c76d713c07ad', 'customer_service@email.com', 'Customer Service Admin', NULL, 1, 1, '{\"accounts\":{\"access\":true,\"edit\":true},\"users\":{\"access\":true,\"edit\":true},\"properties\":{\"access\":true,\"edit\":true},\"premiums\":{\"process_subscription\":true}}', 0, NULL, 1708955333);

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
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mls_user_login`
--

INSERT INTO `mls_user_login` (`user_login_id`, `user_id`, `session_id`, `status`, `login_details`, `login_at`) VALUES
(94, 1, 'baflpvp4d20oemorhhm4vb5tv0', 0, '{\"ip_address\":\"158.62.35.148\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708767666),
(95, 1, 'k54n4mhhe6v1nd42atrvhsk8mf', 0, '{\"ip_address\":\"158.62.35.148\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708767960),
(96, 1, '0mum32kkhlifdaq48o73oc8sd2', 0, '{\"ip_address\":\"158.62.35.148\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708768530),
(97, 1, 'o7b7l699mpmhs4ih64lqso1vdc', 0, '{\"ip_address\":\"158.62.35.148\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708768870),
(98, 1, 'o7b7l699mpmhs4ih64lqso1vdc', 0, '{\"ip_address\":\"158.62.35.148\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708769175),
(99, 1, 'o7b7l699mpmhs4ih64lqso1vdc', 0, '{\"ip_address\":\"158.62.35.148\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708769223),
(100, 1, 'ipkeerdkckf7ej88jo0ef3dq2k', 0, '{\"ip_address\":\"158.62.35.148\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708778634),
(101, 1, 'e4u2nt4kgba2p3olqo9t8qudfa', 0, '{\"ip_address\":\"158.62.35.148\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708778906),
(102, 1, '2mmi7ppr9heargkak19tipeh90', 0, '{\"ip_address\":\"158.62.35.148\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708778922),
(103, 1, '4fholv9r7e7qdjoot01snlvorv', 0, '{\"ip_address\":\"158.62.35.148\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708787492),
(104, 1, 'fr0446hdmoiq96a2u8mpc9m1ek', 0, '{\"ip_address\":\"158.62.35.148\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708787507),
(105, 1, 'mnnn3vrhqqole38keqrs98tqrn', 0, '{\"ip_address\":\"158.62.43.181\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36 Edg\\/121.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"121.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708864604),
(106, 1, 'o5u2l1qus9olq5dqi3dt1s86j2', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708952592),
(107, 1, 'aj8mp00c08um663umvd8saeamv', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708953565),
(108, 1, '7ks6mk0mnd7hoeivqadc4t2spt', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708958586),
(109, 1, '75v2u7mc7nkl9hlhv2pgbcfjup', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708958876),
(110, 1, '2samhsr3ak3hc2dg6bpe7unbg0', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708958985),
(111, 1, 'ef22jsrhdjcoufebbjev0ctrjd', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708959018),
(112, 1, 'kgdgaj99cn3poobukg9morqi3b', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1708959100),
(113, 1, 'jk1heftj08mvr9rm3rj11ovhmn', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709038701),
(114, 1, '5785dr05musdtmmb2jjera4d1s', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709038737),
(115, 1, 'l6l70hutv3ur4nueeu5lmlg275', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709039969),
(116, 1, '88364fl4tg0thil0lrvmangv70', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709046626),
(117, 1, 'li0vo8d9vf3vqbonvqfspqd2mo', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709046663),
(118, 1, '9qbjk968epkibv1tp7vftaaoet', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709047053),
(119, 1, 'kcj04fv5fvddc15rgib41qaoc5', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709047204),
(120, 1, 'vo2bmtbr7c2kfucov6a0efm9tj', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709048142),
(121, 1, 'devmjm3k4pabn2audrp7s64080', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709048207),
(122, 1, '9dqa96pmbr2pmunhgc5tmv07a0', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709049019),
(123, 1, 'j3o1daai7h2ejc5g05i7uaf0pk', 0, '{\"ip_address\":\"158.62.35.125\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709049487),
(124, 1, 'c5g4cei93adoh3221nj9hepbq1', 0, '{\"ip_address\":\"158.62.34.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709126050),
(125, 1, 'apiumf2udolvgog7hrp1avv9l6', 1, '{\"ip_address\":\"158.62.34.114\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36 Edg\\/122.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"122.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}', 1709126127);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mls_listings`
--
ALTER TABLE `mls_listings` ADD FULLTEXT KEY `name` (`name`,`title`,`tags`,`long_desc`,`address`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
