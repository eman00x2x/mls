-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 16, 2024 at 11:26 AM
-- Server version: 5.7.31
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
  `account_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference_id` bigint(20) NOT NULL DEFAULT '0',
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
  `kyc_verified` int(11) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `registration_date` int(11) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_accounts`
--

INSERT INTO `mls_accounts` (`account_id`, `reference_id`, `account_type`, `logo`, `company_name`, `profession`, `real_estate_license_number`, `firstname`, `lastname`, `birthdate`, `street`, `city`, `province`, `mobile_number`, `email`, `tin`, `profile`, `uploads`, `preferences`, `privileges`, `kyc_verified`, `status`, `registration_date`) VALUES
(1, 1, 'Administrator', 'http://cdn.mls/images/accounts/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg', 'EmanPO&Ntilde;', 'Real Estate Broker', '27431', 'Eman', 'Olivas', '1988-08-18', '55 Justice R jabson St Bambang', 'Pasig City', 'National Capital Region', '09175223499', 'eman00x2xx@gmail.com', '666-666-6663', '<p>test test test test</p>', '', '', '{\"max_post\":\"15\",\"max_users\":\"10\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', 0, 'active', 2147483647),
(4, 4, 'Real Estate Practitioner', 'http://cdn.mls/images/accounts/63644612977582993355262220530895691927503826826109_1fa693e8267edb06373b6b016f5ee7b7.png', 'Olivas Tech', 'Real Estate Broker', '87431', 'Emmanuel', 'Olivas', '1988-08-18', '55 Justice R Jabson St Bambang', 'Pasig City', 'Metro Manila', '09175223499', 'eman.olivas@gmail.com', NULL, '0', NULL, NULL, '{\"max_post\":\"30\",\"max_users\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', 0, 'active', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `mls_account_subscriptions`
--

DROP TABLE IF EXISTS `mls_account_subscriptions`;
CREATE TABLE IF NOT EXISTS `mls_account_subscriptions` (
  `account_subscription_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) NOT NULL,
  `premium_id` int(11) NOT NULL,
  `subscription_date` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `subscription_start_date` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `subscription_end_date` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_subscription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_account_subscriptions`
--

INSERT INTO `mls_account_subscriptions` (`account_subscription_id`, `account_id`, `transaction_id`, `premium_id`, `subscription_date`, `subscription_start_date`, `subscription_end_date`) VALUES
(1, 1, 1, 3, 1707623200, 1707623200, 1710215200),
(2, 1, 2, 1, 1707623601, 1707623601, 1710215601),
(3, 1, 3, 8, 1707637596, 1707637596, 1710229596),
(4, 1, 4, 8, 1707637883, 1707637883, 1710229883),
(6, 4, 0, 1, 1707647173, 1707647173, 1710239173),
(7, 1, 7, 7, 1708011425, 1708011425, 1710603425);

-- --------------------------------------------------------

--
-- Table structure for table `mls_deleted_threads`
--

DROP TABLE IF EXISTS `mls_deleted_threads`;
CREATE TABLE IF NOT EXISTS `mls_deleted_threads` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `thread_id` bigint(20) NOT NULL,
  `account_id` bigint(20) NOT NULL,
  `deleted_by` bigint(20) NOT NULL,
  `deleted_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mls_handshakes`
--

DROP TABLE IF EXISTS `mls_handshakes`;
CREATE TABLE IF NOT EXISTS `mls_handshakes` (
  `handshake_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `requestor_account_id` bigint(20) NOT NULL,
  `requestor_details` text,
  `requestee_account_id` bigint(20) NOT NULL,
  `listing_id` bigint(20) NOT NULL,
  `handshake_status` varchar(10) DEFAULT 'pending',
  `handshake_status_date` int(11) NOT NULL,
  `requested_date` int(11) NOT NULL,
  PRIMARY KEY (`handshake_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mls_leads`
--

DROP TABLE IF EXISTS `mls_leads`;
CREATE TABLE IF NOT EXISTS `mls_leads` (
  `lead_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `listing_id` bigint(20) NOT NULL,
  `account_id` bigint(20) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `mobile_no` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `message` text,
  `preferences` text,
  `inquire_at` int(11) NOT NULL,
  PRIMARY KEY (`lead_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

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
  `reference_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `broker_prc_license_id` varchar(150) DEFAULT NULL,
  `created_at` int(10) NOT NULL,
  PRIMARY KEY (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
  `listing_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) NOT NULL,
  `is_mls` tinyint(1) NOT NULL DEFAULT '0',
  `is_website` tinyint(1) NOT NULL DEFAULT '0',
  `offer` varchar(50) DEFAULT NULL COMMENT 'for sale, for rent',
  `type` varchar(100) NOT NULL COMMENT 'Residential, Commercial',
  `foreclosed` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tags` text COMMENT 'foreclosure, new, old, fully furnished, bare, semi-furnished',
  `long_desc` longtext,
  `category` varchar(150) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `reservation` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `monthly_downpayment` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `monthly_amortization` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `floor_area` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `lot_area` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `unit_area` int(10) UNSIGNED NOT NULL,
  `bedroom` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `bathroom` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parking` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `thumb_img` text,
  `video` text,
  `amenities` text,
  `other_details` text,
  `date_added` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last_modified` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = available, 2 = sold, 3 = removed',
  `display` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = show, 2 = hidden',
  PRIMARY KEY (`listing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mls_listings`
--

INSERT INTO `mls_listings` (`listing_id`, `account_id`, `is_mls`, `is_website`, `offer`, `type`, `foreclosed`, `name`, `title`, `tags`, `long_desc`, `category`, `address`, `price`, `reservation`, `monthly_downpayment`, `monthly_amortization`, `floor_area`, `lot_area`, `unit_area`, `bedroom`, `bathroom`, `parking`, `thumb_img`, `video`, `amenities`, `other_details`, `date_added`, `last_modified`, `status`, `display`) VALUES
(1, 1, 1, 1, 'for sale', 'Residential', 0, 'samplesss', 'samplesss', '[\"New\"]', '<p>sample esar&nbsp;</p>', 'Condominium', '{\"barangay\":\"\",\"municipality\":\"Pasig City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', 16000000, 100000.00, 600000.00, 80000.00, 233, 2589, 233, 4, 2, 2, 'http://cdn.mls/images/listings/18362362385124463689010255540495713831578558815919_0bd3dfef0e2e42824866367511e1ea81.webp', NULL, 'Lap Pool,Bowling Room,Basket Ball Court,Game rooms,Day care centers,Lobby,Club House,Function Halls,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"com_share\":\"2\"}', 1698849808, 1707745112, 1, 1),
(2, 1, 1, 0, 'for sale', 'Residential', 0, 'test', 'test', '[\"New\",\"Pre Owned\"]', '<p>test</p>', 'House and Lot', '{\"barangay\":\"Sipac-Almacen\",\"municipality\":\"Navotas City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', 1500000, 20000.00, 56000.00, 85000.00, 0, 0, 0, 0, 0, 0, 'http://cdn.mls//images/listings/20589086521943721573908927020568652944736005968973_0d2ddc51bced3a7da9c49208c52c1167.webp', NULL, 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"com_share\":\"2\"}', 1699018530, 1706408975, 1, 1),
(3, 1, 1, 1, 'for sale', 'Residential', 0, 'modern-2-storey-5-bedrooms-alabang-400-village-muntinlupa-city', 'Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City', '[\"New\",\"Pre Owned\"]', '<p>5 bedrooms with toilet and bath</p>\r\n<ul>\r\n<li>walk in closet in bedrooms upstairs</li>\r\n<li>ensuite in all bedrooms</li>\r\n<li>bathtub in master&rsquo;s bedroom</li>\r\n<li>airconditioning in 4 rooms and living area</li>\r\n<li>hot and cold water system</li>\r\n</ul>\r\n<p>25m frontage</p>\r\n<p>Built 2010</p>\r\n<p>3 elevated under cover garage</p>\r\n<p>High ceiling</p>\r\n<p>Open plan concept</p>\r\n<p>Balcony at rear</p>\r\n<p>Pantry room</p>\r\n<p>Big garden</p>\r\n<p>SP: 35 M gross</p>\r\n<p>Clean title</p>\r\n<p>RFS: family migrating to Australia</p>', 'House and Lot', '{\"barangay\":\"New Alabang Village\",\"municipality\":\"Muntinlupa City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', 1500000, 20000.00, 56000.00, 85000.00, 300, 412, 0, 5, 5, 2, 'http://cdn.mls/images/listings/34386680823233921755628498012360148501361322493813_7e12b9298c1869571ac20626b9bbb411.webp', NULL, 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"com_share\":\"\"}', 1699019091, 1707743402, 1, 1),
(4, 4, 1, 0, 'for sale', 'Residential', 0, 'test', 'test', '[\"New\",\"Pre Owned\"]', '<p>test</p>', 'Subdivision Lot', '{\"barangay\":\"Lower Sulitan\",\"municipality\":\"Naga\",\"province\":\"Zamboanga Sibugay\",\"region\":\"Region IX\"}', 1500000, 20000.00, 56000.00, 85000.00, 0, 0, 0, 0, 0, 0, 'http://cdn.mls//images/listings/55141816083775074918346737185762835964551378384965_ae7a8e233176ecb7a64763d494530f5a.webp', NULL, 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', '{\"authority_type\":\"Non-Exclusive Authority To Sell\",\"com_share\":\"2\"}', 1699019712, 1706409221, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mls_listings_view`
--

DROP TABLE IF EXISTS `mls_listings_view`;
CREATE TABLE IF NOT EXISTS `mls_listings_view` (
  `listing_view_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) NOT NULL,
  `session_id` int(11) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_agent` text COMMENT 'user agent info',
  PRIMARY KEY (`listing_view_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

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
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `listing_id` int(10) UNSIGNED NOT NULL,
  `filename` text NOT NULL,
  `url` text,
  `img_sort` int(10) UNSIGNED NOT NULL DEFAULT '0',
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
  `message_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `thread_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `attachment` text,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_messages`
--

INSERT INTO `mls_messages` (`message_id`, `thread_id`, `user_id`, `message`, `attachment`, `created_at`) VALUES
(2, 3, 4, 'However, to actually answer your question, you could create an array of the keys you want to remove and loop through, explicitly unsetting them', NULL, 1707310015),
(3, 3, 4, 'There are a couple of ways to redirect to another webpage with JavaScript. The most popular ones are location.href and location.replace:', NULL, 1707310645),
(4, 3, 4, 'It looks like the function extract() would be a better tool for what you\'re trying to do (assuming it\'s extract all key/values from an array and assign them to variables with the same names as the keys in the local scope). After you\'ve extracted the contents, you could then unset the entire $post, assuming it didn\'t contain anything else you wanted.', NULL, 1707313730),
(5, 3, 4, 'Be careful: if the value of the field you want to remove is equal to the index of the (flipped) element you want to remove the key will not be removed. It can lead to security problems by exposing data. Can see the results here: replit.com/@xbeat/unset-array-of-key#index.php', NULL, 1707313895),
(6, 3, 1, 'smart but slow for large input arrays. foreach unset seems much faster with big input arrays and (at least) relatively small number of keys to unset.', NULL, 1707314025),
(7, 3, 4, 'You could use array_intersect_key if you wanted to supply an array of keys to keep.', NULL, 1707314060),
(8, 3, 1, 'This is almost certainly an XY Problem. There probably isn\'t any beneficial reason to unset these elements. And if you have concerns regarding variable scope, there may be better ways to address them than explicitly unsetting, but we cannot advise without more/better context.', NULL, 1707314141),
(9, 3, 1, 'Hey im here using my phone', NULL, 1707318090),
(10, 3, 1, 'Oh', NULL, 1707318557),
(11, 4, 1, 'hey', NULL, 1707746547);

-- --------------------------------------------------------

--
-- Table structure for table `mls_notifications`
--

DROP TABLE IF EXISTS `mls_notifications`;
CREATE TABLE IF NOT EXISTS `mls_notifications` (
  `notification_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `content` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mls_notifications`
--

INSERT INTO `mls_notifications` (`notification_id`, `account_id`, `content`, `status`, `created_at`) VALUES
(1, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 0, 1708071577),
(2, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 0, 1708071577),
(3, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 1, 1708071577),
(4, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 1, 1708071577);

-- --------------------------------------------------------

--
-- Table structure for table `mls_premiums`
--

DROP TABLE IF EXISTS `mls_premiums`;
CREATE TABLE IF NOT EXISTS `mls_premiums` (
  `premium_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT 'limited_time' COMMENT 'permanent, limited_time',
  `name` varchar(50) DEFAULT NULL,
  `details` text,
  `script` text COMMENT 'json value',
  `duration` varchar(10) NOT NULL DEFAULT '30 days' COMMENT 'days duration',
  `cost` decimal(15,2) NOT NULL DEFAULT '0.00',
  `visibility` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `date_added` int(10) UNSIGNED NOT NULL,
  `date_end` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`premium_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_premiums`
--

INSERT INTO `mls_premiums` (`premium_id`, `category`, `type`, `name`, `details`, `script`, `duration`, `cost`, `visibility`, `date_added`, `date_end`) VALUES
(1, 'package', 'limited_time', 'Bronze Package', '+15 Listing Posting, +1 Display Ads, 30 days duration', '{\"max_post\":\"15\",\"display_ads\":\"1\"}', '30 days', 499.00, 1, 1698672886, 1698072325),
(3, 'package', 'limited_time', 'Silver Package', '+1 Max Users, +30 Listing Posting, +2 Display Ads, +1 Featured Ads, Listing Database, 30 days duration', '{\"max_post\":\"30\",\"max_users\":\"1\",\"display_ads\":\"1\",\"featured_ads\":\"1\",\"properties_DB\":\"1\"}', '30 days', 999.00, 1, 1698672845, 0),
(4, 'individual', 'limited_time', 'Max User +1', 'Add 1 user to your account for a month', '{\"max_users\":\"1\"}', '30 days', 250.00, 1, 1698675100, 0),
(5, 'individual', 'limited_time', 'Property Database', 'An advance view of Properties Database, 30 days duration', '{\"properties_DB\":\"1\"}', '30 days', 500.00, 1, 1698675869, 0),
(6, 'package', 'limited_time', 'Gold Package', '+2 Max User, +60 Listing Posting, +3 Display Ads, +2 Featured Ads, Listings Database Access, 30 days duration', '{\"max_post\":\"60\",\"max_users\":\"1\",\"display_ads\":\"3\",\"featured_ads\":\"2\",\"properties_DB\":\"1\"}', '30 days', 1499.00, 1, 1698926154, 0),
(7, 'package', 'limited_time', 'Platinum Package', '+3 Max User, +90 Listing Posting, +4 Display Ads, +3 Featured Ads, Listings Database Access, 30 days duration', '{\"max_post\":\"90\",\"max_users\":\"3\",\"display_ads\":\"4\",\"featured_ads\":\"3\",\"properties_DB\":\"1\"}', '30 days', 1999.00, 1, 1698927038, 0),
(8, 'package', 'limited_time', 'Diamond Package', '+4 Max User, +120 Listing Posting, +5 Display Ads, +4 Featured Ads, Listings Database Access, 30 days duration', '{\"max_post\":\"120\",\"max_users\":\"4\",\"display_ads\":\"5\",\"featured_ads\":\"4\",\"properties_DB\":\"1\"}', '30 days', 2499.00, 1, 1698927038, 0),
(9, 'package', 'limited_time', 'Titanium Package', '+5 Max User, +155 Listing Posting, +6 Display Ads, +5 Featured Ads, Listings Database Access, 30 days duration', '{\"max_post\":\"155\",\"max_users\":\"5\",\"display_ads\":\"6\",\"featured_ads\":\"5\"}', '30 days', 2999.00, 1, 1698927038, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mls_settings`
--

DROP TABLE IF EXISTS `mls_settings`;
CREATE TABLE IF NOT EXISTS `mls_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_info` text,
  `property_tags` text,
  `paypal_credentials` text,
  `show_vat` tinyint(1) NOT NULL DEFAULT '1',
  `chat_is_websocket` tinyint(1) NOT NULL DEFAULT '0',
  `email_address_responder` varchar(150) NOT NULL,
  `enable_kyc_verification` tinyint(1) NOT NULL DEFAULT '0',
  `enable_premium` tinyint(1) NOT NULL DEFAULT '0',
  `enable_pin_access` tinyint(1) NOT NULL DEFAULT '0',
  `analytics` text,
  `header_script` text,
  `data_privacy` text,
  `terms` text,
  `refund_policy` text,
  `modified_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mls_settings`
--

INSERT INTO `mls_settings` (`id`, `contact_info`, `property_tags`, `paypal_credentials`, `show_vat`, `chat_is_websocket`, `email_address_responder`, `enable_kyc_verification`, `enable_premium`, `enable_pin_access`, `analytics`, `header_script`, `data_privacy`, `terms`, `refund_policy`, `modified_at`) VALUES
(1, '{\"mobile_number\":\"09199999999\",\"email\":\"myorg@email.com\",\"office_address\":\"55 sitio st brgy pinagkaisahan quezon city\"}', '[\"New\",\"Pre-Owned\",\"Fully Furnished\",\"Bare Unit\"]', '{\"client_id\":\"AczoZMmV6Tkw24LL55FDfCaCMsp7aSo5bf75EFLy22u0nswrH15Cmrac2tsimtGCLaiU35vb605Pi3oF\",\"client_secret\":\"EOxCjX0hgxSaffhW1QEFZcqto_LBL_qnAIl22TuYH1sVio-AljiMdb6ti95V8z0lb_RbKLexNcSSibE0\"}', 0, 0, 'noreply@email.com', 0, 1, 0, NULL, NULL, '<h3 style=\"text-align: justify;\">Privacy Statement</h3>\r\n<p style=\"text-align: justify;\">Your personal information is important to My Organization., its employees, agents or representatives (collectively referred to as \"Organization\", \"we\", \"us\" or \"our\"). We handle your personal information and data in accordance with Republic Act No. 10173, otherwise known as the Data Privacy Act of 2012, and its Implementing Rules and Regulations, other issuances of the National Privacy Commission and other relevant laws of the Philippines (collectively, the \"DPA\"). We recognize the importance of your rights as a Data Subject under the DPA, as follows:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Right to be informed</li>\r\n<li>Right to object</li>\r\n<li>Right to access</li>\r\n<li>Right to correct</li>\r\n<li>Right to rectification, erasure or blocking</li>\r\n<li>Right to damages</li>\r\n<li>Right to data portability</li>\r\n<li>Transmissibility of rights</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">This Privacy Policy aims to provide information on how we collect, use, manage, and secure your personal information. Any information you provide to us indicates your express consent to our Privacy Policy.</p>\r\n<h3 style=\"text-align: justify;\">Personal Information Collection</h3>\r\n<p style=\"text-align: justify;\">Personal Information under the DPA refers to any information, whether recorded in a material form or not, from which the identity of an individual is apparent or can be reasonably and directly ascertained by the entity holding such information, or such information, when put together with other information, would directly and certainly identify an individual.</p>\r\n<p style=\"text-align: justify;\">In the performance of our services, or as part of our transactions and dealings, we collect your personal information which may include, but not limited to, the following:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Your name, nationality, civil status, gender, age, birthdate, ID details, unique identifiers, email address, residence, office, and mailing address, phone numbers and other information, as part of our transactions and dealings with you.</li>\r\n<li>Your browsing and social media behavior, when you browse into our website, download mobile applications and tag or mention us on your social media accounts.</li>\r\n<li>Any information you submit when to our sales, account management, or customer relations agents for update of your records or information; in relation to your inquiries or requests; when you participate in our survey, discount, event information and prize promotion; when you refer a person to verify the information you provided to us; when you visit and connect to our websites and social media pages; or any other event or activity that may be similar or related to any of the foregoing.</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">When you provide information other than your own, you certify that you have obtained the consent and authority of the owner of such information (such as your parents, spouse, children, dependent, or any other person) to allow us to disclose and process such information.</p>\r\n<h3 style=\"text-align: justify;\">Use and Sharing of Personal Information</h3>\r\n<p style=\"text-align: justify;\">We use your personal information to:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Process the products and services that you have availed from us.</li>\r\n<li>Communicate our latest products, services, promos and events.</li>\r\n<li>Respond immediately to your needs, requests, queries and complaints.</li>\r\n<li>Comply with the law, rule or regulation and all legal orders and processes.</li>\r\n<li>Process your application and conduct due diligence for, and documentation of, our transaction.</li>\r\n<li>Any other purpose relating to any of the above.</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">We share your personal information, to the extent that is reasonable and necessary, to:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Our employees or other personnel handling your transactions, orders or requests.</li>\r\n<li>Banks, insurers or professional advisers in connection with due diligence and documentation of your transaction.</li>\r\n<li>Any third-party service provider performing financial, administrative, technical and other ancillary services.</li>\r\n<li>Government institution and other competent authorities which by law, rules or regulations require us to disclose your personal information.</li>\r\n<li>Any person or entity we contractually entered with and who ensures the confidentiality standard we implement and adheres to the DPA.</li>\r\n<li>Any person in order to carry out functions of public authority, and for collection and further processing pertaining to law enforcement, taxation or other regulatory function.</li>\r\n</ol>\r\n<h3 style=\"text-align: justify;\">Personal Information Retention and Protection</h3>\r\n<p style=\"text-align: justify;\">We retain your personal information:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>To the extent necessary in keeping track of your transaction and records.</li>\r\n<li>As may be agreed upon by the parties to a contract.</li>\r\n<li>For statistical, research and other purpose specifically authorized by law.</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">Data collected will be retained in accordance with retention limit set by our standards, industry standards and laws and regulations, unless you request your data to be deleted in our database.</p>\r\n<p style=\"text-align: justify;\">To maintain the integrity and confidentiality of your personal information, we put in place organizational, physical and technical security measures to protect your personal information, such as:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Use of secured servers, firewalls, encryptions and other latest security tools.</li>\r\n<li>Limited access to personal information to those duly authorized processors. All transfers are made after complying with the established confidentiality policy and practices in place.</li>\r\n<li>Maintain a secured server operating environment by performing regular security patch update and server hardening.</li>\r\n</ol>\r\n<h3 style=\"text-align: justify;\">Cookies and Related Technologies</h3>\r\n<p style=\"text-align: justify;\">A cookie is a small piece of file which originates from a website and is transferred to the user\'s hard drive to record the user\'s browsing activity. Cookies were designed to remember pieces of information that the user has entered in a certain website. Essentially, cookies help in making the browsing of our site easier by, among other things, saving your name, addresses, passwords and other preferences.</p>\r\n<p style=\"text-align: justify;\">Most web browsers are set to automatically accept cookies, but you have the option to refuse all cookies or indicate when a cookie is being sent. However, if you choose not to accept cookies, you may experience some delay in browsing our website or it will not function properly or may be considerably slower.</p>\r\n<h3>Google Analytics</h3>\r\n<p>We use Google Analytics, an analytics service provided by Google LLC. We use this service to help analyze how users use the Service, with a view to analyzing usage across devices and offering improvements for all users. To learn more about Google Analytics, please visit their <a href=\"https://support.google.com/analytics/answer/6004245#zippy=%2Cour-privacy-policy\">Privacy Policy</a>. To opt-out of this feature by installing the Google Analytics Opt-out Browser Add-on, please click <a href=\"https://tools.google.com/dlpage/gaoptout?hl=en\">here</a>.</p>\r\n<h3>Newsletters</h3>\r\n<p>You can opt out of receiving our marketing emails and/or newsletters by contacting us as described under &ldquo;Contact Us&rdquo; below. We may still send you transactional messages, which include Services-related communications and responses to your questions.</p>\r\n<h3 style=\"text-align: justify;\">Renewal of Policy</h3>\r\n<p style=\"text-align: justify;\">We may periodically update or amend our Privacy Policy in order to adhere to new and existing laws affecting the DPA, including any change or improvement we establish to secure your personal information. Any updates or changes shall not alter how we handle previously collected personal data without obtaining your consent, unless required by law.</p>\r\n<h3 style=\"text-align: justify;\">Contact Us</h3>\r\n<p style=\"text-align: justify;\">For any comment, question or complaint regarding this Privacy Policy, you may contact our Data Protection Officer at:</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>Postal Address:</td>\r\n<td>Sample Address</td>\r\n</tr>\r\n<tr>\r\n<td>Telephone Number:</td>\r\n<td>0919999999</td>\r\n</tr>\r\n<tr>\r\n<td>Email Address:</td>\r\n<td>myorg@email.com</td>\r\n</tr>\r\n</tbody>\r\n</table>', '<div>\r\n<h3>Privacy Policy</h3>\r\n<p>Last Updated: Feb 15 2024</p>\r\n<p>Thank you for visiting the Privacy Policy of Organization. This Privacy Policy explains how Organization (collectively, &ldquo;Organization&rdquo;, &ldquo;we&rdquo;, &ldquo;us&rdquo;, or &ldquo;our&rdquo;) collects, uses, and shares information about you (&ldquo;you&rdquo;, &ldquo;yours&rdquo; or &ldquo;user&rdquo;) when you access or use our websites (&ldquo;Services&rdquo;).</p>\r\n<p>Users are responsible for any third-party data they provide or share through the Services and confirm that they have the third-party\'s consent to provide such data to us.</p>\r\n<br />\r\n<h3>Information We Collect</h3>\r\n<p>We may collect and combine information about you when you access or use the Services, including:</p>\r\n<p><strong>Contact Information</strong>: such as:</p>\r\n<ul>\r\n<li>First Name</li>\r\n<li>Last Name</li>\r\n<li>Email Address</li>\r\n<li>Address (street address, city, state, zip code)</li>\r\n</ul>\r\n<p><strong>Account Information: </strong>if you create an account on the Services, we collect the information you provide to us related to the account, such as first and last name, username, password, and email address.</p>\r\n<p><strong>Transactional Information: </strong>such as items placed in your cart, products purchased, product details, shipping information, purchase price, purchased date and payment information.</p>\r\n<br />\r\n<h3>How We Use Your Information</h3>\r\n<p>We use information we collect about you to provide, maintain, and improve our Services and other interactions we have with you. For example, we use the information collected to:</p>\r\n<ul>\r\n<li>\r\n<p>Facilitate and improve our online experience;</p>\r\n</li>\r\n<li>\r\n<p>Provide and deliver products and services, perform authentication, process transactions and returns, and send you related information, including confirmations, receipts, invoices, customer experience surveys, and product or Services-related notices;</p>\r\n</li>\r\n<li>\r\n<p>Process and deliver promotions;</p>\r\n</li>\r\n<li>\r\n<p>Respond to your comments and questions and provide customer service;</p>\r\n</li>\r\n<li>\r\n<p>If you have indicated to us that you wish to receive notifications or promotional messages;</p>\r\n</li>\r\n<li>\r\n<p>Detect, investigate and prevent fraudulent transactions and other illegal activities and protect our rights and property and others;</p>\r\n</li>\r\n<li>\r\n<p>Comply with our legal and financial obligations;</p>\r\n</li>\r\n<li>\r\n<p>Monitor and analyze trends, usage, and activities;</p>\r\n</li>\r\n<li>\r\n<p>Provide and allow our partners to provide advertising and marketing targeted toward your interests.</p>\r\n</li>\r\n</ul>\r\n<br />\r\n<h3>How We May Share Information</h3>\r\n<p>We may share your Personal Information in the following situations:</p>\r\n<ul>\r\n<li>\r\n<p><strong>Third Party Services Providers. </strong>We may share data with service providers, vendors, contractors, or agents who complete transactions or perform services on our behalf, such as those that assist us with our business and internal operations like shipping and delivery, payment processing, fraud prevention, customer service, gift cards, experiences, personalization, marketing, and advertising;</p>\r\n</li>\r\n<li>\r\n<p><strong>Change in Business. </strong>We may share data in connection with a corporate business transaction, such as a merger or acquisition of all or a portion of our business to another company, joint venture, corporate reorganization, insolvency or bankruptcy, financing or sale of company assets;</p>\r\n</li>\r\n<li>\r\n<p><strong>To Comply with Law. </strong>We may share data to facilitate legal process from lawful requests by public authorities, including to meet national security or law enforcement demands as permitted by law.</p>\r\n</li>\r\n<li>\r\n<p><strong>With Your Consent. </strong>We may share data with third parties when we have your consent.</p>\r\n</li>\r\n<li>\r\n<p><strong>With Advertising and Analytics Partners. </strong>See the section entitled &ldquo;Advertising and Analytics&rdquo; below.</p>\r\n</li>\r\n</ul>\r\n<br />\r\n<h3>Google Analytics</h3>\r\n<p>We use Google Analytics, an analytics service provided by Google LLC. We use this service to help analyze how users use the Service, with a view to analyzing usage across devices and offering improvements for all users. To learn more about Google Analytics, please visit their <a href=\"https://support.google.com/analytics/answer/6004245#zippy=%2Cour-privacy-policy\">Privacy Policy</a>. To opt-out of this feature by installing the Google Analytics Opt-out Browser Add-on, please click <a href=\"https://tools.google.com/dlpage/gaoptout?hl=en\">here</a>.</p>\r\n<br />\r\n<h3>Ads on the Service</h3>\r\n<p>We may use third-party advertising companies to serve content and advertisements when you visit our website. To opt-out of interest-based advertising, please see the section entitled &ldquo;Advertising and Analytics&rdquo; above.</p>\r\n<br />\r\n<h3>Data Security</h3>\r\n<p>We implement commercially reasonable security measures designed to protect your information. Despite our best efforts, however, no security measures are completely impenetrable.</p>\r\n<br />\r\n<h3>Data Retention</h3>\r\n<p>We store the information we collect about you for as long as necessary for the purpose(s) for which we collected it or for other legitimate business purposes, including to meet our legal, regulatory, or other compliance obligations.</p>\r\n<br />\r\n<h3>Age Limitations</h3>\r\n<p>Our Service is intended for adults ages 18 years and above. We do not knowingly collect personally identifiable information from children. If you are a parent or legal guardian and think your child under 13 has given us information, please email or write to us at the address listed at the end of this Privacy Policy. Please mark your inquiries &ldquo;COPPA Information Request.&rdquo;</p>\r\n<br />\r\n<h3>Changes to this Privacy Policy</h3>\r\n<p>Organization may change this Privacy Policy from time to time. We encourage you to visit this page to stay informed. If the changes are material, we may provide you additional notice to your email address or through our Services. Your continued use of the Services indicates your acceptance of the modified Privacy Policy.</p>\r\n<br />\r\n<h3>Newsletters</h3>\r\n<p>You can opt out of receiving our marketing emails and/or newsletters by contacting us as described under &ldquo;Contact Us&rdquo; below. We may still send you transactional messages, which include Services-related communications and responses to your questions.</p>\r\n<br />\r\n<h3>Storage of Information in the United States</h3>\r\n<p>Information we maintain may be stored both within and outside of the United States. If you live outside of the United States, you understand and agree that we may transfer your information to the United States, and that U.S. laws may not afford the same level of protection as those in your country.</p>\r\n<br />\r\n<h3>Contact Us</h3>\r\n<p>If you have questions, comments, or concerns about this Privacy Policy, you may contact us at:</p>\r\n<ul>\r\n<li>\r\n<p>sample@email.com</p>\r\n</li>\r\n<li>\r\n<p>0917999999</p>\r\n</li>\r\n</ul>\r\n</div>', '<p>refund policy</p>', 1708005816);

-- --------------------------------------------------------

--
-- Table structure for table `mls_threads`
--

DROP TABLE IF EXISTS `mls_threads`;
CREATE TABLE IF NOT EXISTS `mls_threads` (
  `thread_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `participants` text COMMENT 'participants account_id in JSON format',
  `created_by` bigint(20) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_threads`
--

INSERT INTO `mls_threads` (`thread_id`, `participants`, `created_by`, `created_at`, `status`) VALUES
(3, '[1,4]', 4, 1707228232, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mls_transactions`
--

DROP TABLE IF EXISTS `mls_transactions`;
CREATE TABLE IF NOT EXISTS `mls_transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) NOT NULL,
  `premium_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `premium_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `premium_price` float(10,2) DEFAULT NULL,
  `merchant_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `merchant_email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payer` text COLLATE utf8_unicode_ci,
  `payment_transaction_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_source` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_details` text COLLATE utf8_unicode_ci,
  `created_at` int(10) DEFAULT '0',
  `modified_at` int(10) DEFAULT '0',
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mls_transactions`
--

INSERT INTO `mls_transactions` (`transaction_id`, `account_id`, `premium_id`, `premium_description`, `premium_price`, `merchant_id`, `merchant_email`, `payer`, `payment_transaction_id`, `payment_source`, `payment_status`, `transaction_details`, `created_at`, `modified_at`) VALUES
(1, 1, '3', 'Silver Package [+1 Max Users, +30 Listing Posting, +2 Display Ads, +1 Featured Ads, Listing Database, 30 days duration]', 999.00, '9EBSYSV5TA6J2', 'sb-c47faw29535156@business.example.com', '{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}', '2X997490M86896847', 'paypal', 'COMPLETED', '{\"id\":\"2X997490M86896847\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"999.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"999.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"59.87\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"939.13\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"17.50\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/2X997490M86896847\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/2X997490M86896847\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/7PF783118S383792Y\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-02-11T03:46:40Z\",\"update_time\":\"2024-02-11T03:46:40Z\"}', 1676009678, 1707545678),
(2, 1, '1', 'Bronze Package [+15 Listing Posting, +1 Display Ads, 30 days duration]', 499.00, '9EBSYSV5TA6J2', 'sb-c47faw29535156@business.example.com', '{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}', '2A370115AY903591D', 'paypal', 'COMPLETED', '{\"id\":\"2A370115AY903591D\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"499.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"499.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"42.42\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"456.58\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"8.51\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/2A370115AY903591D\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/2A370115AY903591D\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/4UB01564HU360012K\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-02-11T03:53:21Z\",\"update_time\":\"2024-02-11T03:53:21Z\"}', 1707623601, 1707623602),
(3, 1, '8', 'Diamond Package [+4 Max User, +120 Listing Post...]', 2499.00, '9EBSYSV5TA6J2', 'sb-c47faw29535156@business.example.com', '{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}', '8JM60218V4169604F', 'paypal', 'COMPLETED', '{\"id\":\"8JM60218V4169604F\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"2499.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"2499.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"112.22\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"2386.78\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"44.48\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/8JM60218V4169604F\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/8JM60218V4169604F\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/7BD35395VM234601N\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-02-11T07:46:36Z\",\"update_time\":\"2024-02-11T07:46:36Z\"}', 1707637596, 1707637597),
(4, 1, '8', '[Diamond Package] +4 Max User, +120 Listing Posting, +5 Display Ads, +4 Featured Ads, Listings Dat...', 2499.00, '9EBSYSV5TA6J2', 'sb-c47faw29535156@business.example.com', '{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}', '6RM84372YU4133014', 'paypal', 'COMPLETED', '{\"id\":\"6RM84372YU4133014\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"2499.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"2499.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"112.22\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"2386.78\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"44.48\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/6RM84372YU4133014\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/6RM84372YU4133014\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/23G14771GJ529562C\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-02-11T07:51:23Z\",\"update_time\":\"2024-02-11T07:51:23Z\"}', 1707637883, 1707637884),
(6, 4, '1', '[Bronze Package] +15 Listing Posting, +1 Display Ads, 30 days duration', 499.00, NULL, NULL, '{\"name\":{\"given_name\":\"Emmanuel\",\"surname\":\"Olivas\"},\"email_address\":\"eman.olivas@gmail.com\"}', '1707647174', 'post-dated check', 'COMPLETED', '{\"status\":\"COMPLETED\",\"transaction\":{\"account_id\":1,\"account_type\":\"Administrator\",\"account_permissions\":{\"account\":{\"access\":\"true\"},\"users\":{\"access\":\"true\",\"delete\":\"true\"},\"leads\":{\"access\":\"true\",\"delete\":\"true\"},\"properties\":{\"access\":\"true\",\"delete\":\"true\"},\"subscriptions\":{\"purchased\":\"true\"}},\"name\":\"Eman Olivas\",\"created_at\":1707647174},\"create_time\":1707647174}', 1707647174, 0),
(7, 1, '7', '[Platinum Package] +3 Max User, +90 Listing Posting, +4 Display Ads, +3 Featured Ads, Listings Database Access, 30 days duration', 1999.00, '9EBSYSV5TA6J2', 'sb-c47faw29535156@business.example.com', '{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}', '39206155E8475541E', 'paypal', 'COMPLETED', '{\"id\":\"39206155E8475541E\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"1999.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"1999.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"94.77\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"1904.23\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"35.48\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/39206155E8475541E\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/39206155E8475541E\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/62P17035LT005904U\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-02-15T15:37:05Z\",\"update_time\":\"2024-02-15T15:37:05Z\"}', 1708011425, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mls_users`
--

DROP TABLE IF EXISTS `mls_users`;
CREATE TABLE IF NOT EXISTS `mls_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `photo` text,
  `user_level` int(10) UNSIGNED NOT NULL DEFAULT '2',
  `permissions` text,
  `two_factor_authentication` tinyint(1) NOT NULL DEFAULT '0',
  `two_factor_authentication_aps` varchar(50) DEFAULT NULL,
  `date_added` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_users`
--

INSERT INTO `mls_users` (`user_id`, `account_id`, `password`, `email`, `name`, `photo`, `user_level`, `permissions`, `two_factor_authentication`, `two_factor_authentication_aps`, `date_added`) VALUES
(1, 1, '9aa126e302832b2c95e29b11263b5e9f', 'eman00x2xx@gmail.com', 'Eman Olivas', 'http://cdn.mls/images/accounts/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg', 1, '{\"account\":{\"access\":\"true\"},\"users\":{\"access\":\"true\",\"delete\":\"true\"},\"leads\":{\"access\":\"true\",\"delete\":\"true\"},\"properties\":{\"access\":\"true\",\"delete\":\"true\"},\"subscriptions\":{\"purchased\":\"true\"}}', 0, '', 1697967624),
(2, 1, 'fb0fd131cffe9a9fa9f50d98860ed581', 'test@test.com', 'Mayette Olivas', NULL, 2, '{\"users\":{\"delete\":\"true\"},\"leads\":{\"delete\":\"true\"},\"properties\":{\"delete\":\"true\"},\"subscriptions\":{\"purchased\":\"true\"}}', 0, '', 1698589128),
(4, 4, '9aa126e302832b2c95e29b11263b5e9f', 'testtest@test.com', 'Tester', 'http://cdn.mls/images/users/03617413890977432093513486861793381434706645845303_e84317e5884cf95cdcedaf42e0ef9213.png', 2, '{\"users\":{\"delete\":\"true\"},\"leads\":{\"delete\":\"true\"},\"properties\":{\"delete\":\"true\"}}', 0, NULL, 1698678896),
(6, 4, '9aa126e302832b2c95e29b11263b5e9f', 'eman.olivas@gmail.com', 'Emmanuel Olivas', NULL, 1, '{\"account\":{\"access\":true},\"users\":{\"access\":true,\"delete\":true},\"leads\":{\"access\":true,\"delete\":true},\"properties\":{\"access\":true,\"delete\":true},\"subscriptions\":{\"purchased\":true}}', 0, NULL, 1707224266);

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
