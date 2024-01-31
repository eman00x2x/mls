-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 31, 2024 at 02:52 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

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
  `account_type` varchar(50) NOT NULL,
  `logo` text,
  `company_name` varchar(150) DEFAULT NULL,
  `real_estate_license_number` varchar(150) DEFAULT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `street` varchar(150) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `uploads` text COMMENT 'collection of filename uploaded json format',
  `preferences` text,
  `privileges` text COMMENT 'account privileges json format',
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `registration_date` int(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_accounts`
--

INSERT INTO `mls_accounts` (`account_id`, `account_type`, `logo`, `company_name`, `real_estate_license_number`, `firstname`, `lastname`, `address`, `street`, `city`, `province`, `mobile_number`, `email`, `tin`, `uploads`, `preferences`, `privileges`, `status`, `registration_date`) VALUES
(1, 'Administrator', 'http://cdn.mls/images/accounts/62242481312762779081451953250792944729165370785647_24b7913aeeb499a52d2098ee2e04d916.jpg', 'EmanPOÑ', '', 'Eman', 'Olivas', '  ', '55 Justice R jabson St Bambang', 'Pasig City', 'National Capital Region', '09175223499', 'eman00x2xx@gmail.com', '666-666-6663', '', '', '{\"max_post\":\"15\",\"max_users\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}', 'active', 1697967993),
(2, 'Customer Service', 'http://cdn.mls/images/accounts/86188504160272786667972870548559707088642623386385_633a5d29473ee3664a3c92bbb2de8a9c.png', 'MLS', '', 'Eman', 'Olivas', '  ', '', '', '', '', 'test@test.com', 'testt', '', '', '{\"max_post\":\"15\",\"max_users\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\"}', 'active', 1697967993);

-- --------------------------------------------------------

--
-- Table structure for table `mls_account_subscriptions`
--

DROP TABLE IF EXISTS `mls_account_subscriptions`;
CREATE TABLE IF NOT EXISTS `mls_account_subscriptions` (
  `account_subscription_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `premium_id` int(11) NOT NULL,
  `subscription_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `subscription_start_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `subscription_end_date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_subscription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_account_subscriptions`
--

INSERT INTO `mls_account_subscriptions` (`account_subscription_id`, `account_id`, `premium_id`, `subscription_date`, `subscription_start_date`, `subscription_end_date`) VALUES
(1, 1, 1, 1698072593, 1698072593, 1700751047),
(21, 1, 3, 1698674166, 1699181619, 1699354419),
(22, 2, 4, 1698675286, 1698675286, 0),
(23, 2, 5, 1698675960, 1698675960, 1701267960),
(24, 1, 4, 1698680074, 1698680074, 0),
(29, 1, 7, 1699200000, 2023, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mls_deleted_threads`
--

DROP TABLE IF EXISTS `mls_deleted_threads`;
CREATE TABLE IF NOT EXISTS `mls_deleted_threads` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `thread_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `account_id` bigint(20) NOT NULL,
  `deleted_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `handshake_status_date` int(12) NOT NULL,
  `requested_date` int(12) NOT NULL,
  PRIMARY KEY (`handshake_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mls_invoice`
--

DROP TABLE IF EXISTS `mls_invoice`;
CREATE TABLE IF NOT EXISTS `mls_invoice` (
  `invoice_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) NOT NULL,
  `details` text NOT NULL,
  `payment_gateway` varchar(50) DEFAULT NULL,
  `payment_gateway_fee` decimal(10,3) NOT NULL DEFAULT '0.000',
  `invoice_amount` decimal(10,3) NOT NULL DEFAULT '0.000',
  `invoice_date` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_invoice`
--

INSERT INTO `mls_invoice` (`invoice_id`, `account_id`, `details`, `payment_gateway`, `payment_gateway_fee`, `invoice_amount`, `invoice_date`) VALUES
(1, 1, 'Bronze Package - Maximum 30 Properties can be posted, 1 Display Ads, Properties Database, Prospect Client Database', 'GCash', '45.000', '1500.000', 1698074284),
(18, 1, 'Silver Package - Maximum 50 Properties can be posted, 1 Display Ads, 1 Featured Ads, Advance Properties Database for 30 days', 'Service', '0.000', '0.000', 1698674166),
(19, 2, 'Max User +1 - Permanently add a user to your account', 'Service', '0.000', '0.000', 1698675286),
(20, 2, 'Advance Property Database Application - A subscription to advance view of Property Database', 'Service', '0.000', '0.000', 1698675960),
(21, 1, 'Max User +1 - Permanently add 1 user to your account', 'Service', '0.000', '0.000', 1698680074),
(22, 1, 'Diamond Package - +4 Max User, +135 Listing Posting, +5 Display Ads, +4 Featured Ads, Listings Database Access, 30 days duration', 'Service', '0.000', '0.000', 1699200000),
(23, 1, 'Titanium Package - +5 Max User, +155 Listing Posting, +6 Display Ads, +5 Featured Ads, Listings Database Access, 30 days duration', 'Service', '0.000', '0.000', 1699200000),
(24, 1, 'Titanium Package - +5 Max User, +155 Listing Posting, +6 Display Ads, +5 Featured Ads, Listings Database Access, 30 days duration', 'Service', '0.000', '0.000', 1699200000),
(25, 1, 'Titanium Package - +5 Max User, +155 Listing Posting, +6 Display Ads, +5 Featured Ads, Listings Database Access, 30 days duration', 'Service', '0.000', '0.000', 1699200000),
(26, 1, 'Platinum Package - +3 Max User, +115 Listing Posting, +4 Display Ads, +3 Featured Ads, Listings Database Access, 30 days duration', 'Service', '0.000', '0.000', 1699200000);

-- --------------------------------------------------------

--
-- Table structure for table `mls_listings`
--

DROP TABLE IF EXISTS `mls_listings`;
CREATE TABLE IF NOT EXISTS `mls_listings` (
  `listing_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) NOT NULL,
  `offer` varchar(50) DEFAULT NULL COMMENT 'for sale, for rent',
  `type` varchar(100) NOT NULL COMMENT 'Residential, Commercial',
  `foreclosed` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tags` text COMMENT 'foreclosure, new, old, fully furnished, bare, semi-furnished',
  `long_desc` longtext,
  `category` varchar(150) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `suburb` varchar(150) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `reservation` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `monthly_downpayment` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `monthly_amortization` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `floor_area` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `lot_area` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `unit_area` int(11) UNSIGNED NOT NULL,
  `bedroom` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `bathroom` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `parking` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `thumb_img` text,
  `video` text,
  `amenities` text,
  `date_added` int(20) UNSIGNED NOT NULL DEFAULT '0',
  `last_modified` int(20) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = available, 2 = sold, 3 = removed',
  `display` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 = show, 2 = hidden',
  PRIMARY KEY (`listing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mls_listings`
--

INSERT INTO `mls_listings` (`listing_id`, `account_id`, `offer`, `type`, `foreclosed`, `name`, `title`, `tags`, `long_desc`, `category`, `address`, `suburb`, `city`, `price`, `reservation`, `monthly_downpayment`, `monthly_amortization`, `floor_area`, `lot_area`, `unit_area`, `bedroom`, `bathroom`, `parking`, `thumb_img`, `video`, `amenities`, `date_added`, `last_modified`, `status`, `display`) VALUES
(1, 1, 'for sale', 'Residential', 0, 'samplesss', 'samplesss', '[\"New\"]', '<p>sample esar&nbsp;</p>', 'Condominium', '{\"barangay\":\"\",\"municipality\":\"\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', 'Bambang', 'Bambang, Taguig City', 16000000, '100000.00', '600000.00', '80000.00', 233, 2589, 233, 4, 2, 2, 'http://cdn.mls//images/listings/18362362385124463689010255540495713831578558815919_0bd3dfef0e2e42824866367511e1ea81.webp', NULL, 'Lap Pool,Bowling Room,Basket Ball Court,Game rooms,Day care centers,Lobby,Club House,Function Halls,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', 1698849808, 1706418252, 1, 1),
(2, 1, 'for sale', 'Residential', 0, 'test', 'test', '[\"New\",\"Pre Owned\"]', '<p>test</p>', 'House and Lot', '{\"barangay\":\"Sipac-Almacen\",\"municipality\":\"Navotas City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', NULL, NULL, 1500000, '20000.00', '56000.00', '85000.00', 0, 0, 0, 0, 0, 0, 'http://cdn.mls//images/listings/20589086521943721573908927020568652944736005968973_0d2ddc51bced3a7da9c49208c52c1167.webp', NULL, 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', 1699018530, 1706408975, 1, 1),
(3, 1, 'for sale', 'Residential', 0, 'modern-2-storey-5-bedrooms-alabang-400-village-muntinlupa-city', 'Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City', '[\"New\",\"Pre Owned\"]', '<p>MODERN 2 STOREY HOUSE</p>\r\n<p>Lot area: 412 sq.m</p>\r\n<p>Floor area: 300 sq.m</p>\r\n<p>5 bedrooms with toilet and bath</p>\r\n<p>-walk in closet in bedrooms upstairs</p>\r\n<p>- ensuite in all bedrooms</p>\r\n<p>- bathtub in master&rsquo;s bedroom</p>\r\n<p>- airconditioning in 4 rooms and living area</p>\r\n<p>- hot and cold water system</p>\r\n<p>25m frontage</p>\r\n<p>Built 2010</p>\r\n<p>3 elevated under cover garage</p>\r\n<p>High ceiling</p>\r\n<p>Open plan concept</p>\r\n<p>Balcony at rear</p>\r\n<p>Pantry room</p>\r\n<p>Big garden</p>\r\n<p>SP: 35 M gross</p>\r\n<p>Clean title</p>\r\n<p>RFS: family migrating to Australia</p>', 'House and Lot', '{\"barangay\":\"New Alabang Village\",\"municipality\":\"Muntinlupa City\",\"province\":\"Metro Manila\",\"region\":\"NCR\"}', NULL, NULL, 1500000, '20000.00', '56000.00', '85000.00', 300, 412, 0, 5, 5, 2, 'http://cdn.mls//images/listings/34386680823233921755628498012360148501361322493813_7e12b9298c1869571ac20626b9bbb411.webp', NULL, 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', 1699019091, 1706407201, 1, 1),
(4, 1, 'for sale', 'Residential', 0, 'test', 'test', '[\"New\",\"Pre Owned\"]', '<p>test</p>', 'Subdivision Lot', '{\"barangay\":\"Lower Sulitan\",\"municipality\":\"Naga\",\"province\":\"Zamboanga Sibugay\",\"region\":\"Region IX\"}', NULL, NULL, 1500000, '20000.00', '56000.00', '85000.00', 0, 0, 0, 0, 0, 0, 'http://cdn.mls//images/listings/55141816083775074918346737185762835964551378384965_ae7a8e233176ecb7a64763d494530f5a.webp', NULL, 'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools', 1699019712, 1706409221, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mls_listings_view`
--

DROP TABLE IF EXISTS `mls_listings_view`;
CREATE TABLE IF NOT EXISTS `mls_listings_view` (
  `listing_view_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `account_id` bigint(20) NOT NULL,
  `datetime` int(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_agent` text COMMENT 'user agent info',
  PRIMARY KEY (`listing_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mls_listing_images`
--

INSERT INTO `mls_listing_images` (`image_id`, `listing_id`, `filename`, `url`, `img_sort`) VALUES
(7, 3, '34386680823233921755628498012360148501361322493813_7e12b9298c1869571ac20626b9bbb411.webp', 'http://cdn.mls/images/listings/34386680823233921755628498012360148501361322493813_7e12b9298c1869571ac20626b9bbb411.webp', 0),
(8, 2, '20589086521943721573908927020568652944736005968973_0d2ddc51bced3a7da9c49208c52c1167.webp', 'http://cdn.mls/images/listings/20589086521943721573908927020568652944736005968973_0d2ddc51bced3a7da9c49208c52c1167.webp', 0),
(9, 4, '55141816083775074918346737185762835964551378384965_ae7a8e233176ecb7a64763d494530f5a.webp', 'http://cdn.mls/images/listings/55141816083775074918346737185762835964551378384965_ae7a8e233176ecb7a64763d494530f5a.webp', 0),
(10, 1, '18362362385124463689010255540495713831578558815919_0bd3dfef0e2e42824866367511e1ea81.webp', 'http://cdn.mls/images/listings/18362362385124463689010255540495713831578558815919_0bd3dfef0e2e42824866367511e1ea81.webp', 0);

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
  `attachments` text,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_messages`
--

INSERT INTO `mls_messages` (`message_id`, `thread_id`, `user_id`, `message`, `attachments`, `created_at`) VALUES
(1, 1, 1, 'test', NULL, 1706442338),
(7, 1, 1, 'test Message today', NULL, 1706706778),
(8, 1, 1, 'test again', NULL, 1706707118),
(9, 1, 1, 'test test', NULL, 1706707129),
(10, 1, 2, 'test test', NULL, 1706707129),
(11, 1, 1, 'test test again', NULL, 1706707239),
(12, 1, 1, '', NULL, 1706707330),
(13, 1, 1, '', NULL, 1706707387),
(14, 1, 1, 'test 1st', NULL, 1706707392),
(15, 1, 1, '', NULL, 1706707456),
(16, 1, 1, 'eaws', NULL, 1706707657),
(117, 1, 1, 'eaws', NULL, 1706707657),
(118, 1, 1, 'eawsasd', NULL, 1706707657),
(119, 1, 1, 'eaws', NULL, 1706707657),
(120, 1, 1, 'eaws', NULL, 1706707657),
(121, 1, 1, 'eawsasd', NULL, 1706707657);

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
  `cost` decimal(15,3) NOT NULL DEFAULT '0.000',
  `visibility` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `date_added` int(11) UNSIGNED NOT NULL,
  `date_end` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`premium_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_premiums`
--

INSERT INTO `mls_premiums` (`premium_id`, `category`, `type`, `name`, `details`, `script`, `duration`, `cost`, `visibility`, `date_added`, `date_end`) VALUES
(1, 'package', 'limited_time', 'Bronze Package', '+15 Listing Posting, +1 Display Ads, 30 days duration', '{\"max_post\":\"15\",\"display_ads\":\"1\"}', '30 days', '499.000', 1, 1698672886, 1698072325),
(3, 'package', 'limited_time', 'Silver Package', '+1 Max Users, +30 Listing Posting, +2 Display Ads, +1 Featured Ads, Listing Database, 30 days duration', '{\"max_post\":\"30\",\"max_users\":\"1\",\"display_ads\":\"1\",\"featured_ads\":\"1\",\"properties_DB\":\"1\"}', '30 days', '999.000', 1, 1698672845, 0),
(4, 'individual', 'limited_time', 'Max User +1', 'Add 1 user to your account for a month', '{\"max_users\":\"1\"}', '30 days', '250.000', 1, 1698675100, 0),
(5, 'individual', 'limited_time', 'Property Database', 'An advance view of Properties Database, 30 days duration', '{\"properties_DB\":\"1\"}', '30 days', '500.000', 1, 1698675869, 0),
(6, 'package', 'limited_time', 'Gold Package', '+2 Max User, +60 Listing Posting, +3 Display Ads, +2 Featured Ads, Listings Database Access, 30 days duration', '{\"max_post\":\"60\",\"max_users\":\"1\",\"display_ads\":\"3\",\"featured_ads\":\"2\",\"properties_DB\":\"1\"}', '30 days', '1499.000', 1, 1698926154, 0),
(7, 'package', 'limited_time', 'Platinum Package', '+3 Max User, +90 Listing Posting, +4 Display Ads, +3 Featured Ads, Listings Database Access, 30 days duration', '{\"max_post\":\"90\",\"max_users\":\"3\",\"display_ads\":\"4\",\"featured_ads\":\"3\",\"properties_DB\":\"1\"}', '30 days', '1999.000', 1, 1698927038, 0),
(8, 'package', 'limited_time', 'Diamond Package', '+4 Max User, +120 Listing Posting, +5 Display Ads, +4 Featured Ads, Listings Database Access, 30 days duration', '{\"max_post\":\"120\",\"max_users\":\"4\",\"display_ads\":\"5\",\"featured_ads\":\"4\",\"properties_DB\":\"1\"}', '30 days', '2499.000', 1, 1698927038, 0),
(9, 'package', 'limited_time', 'Titanium Package', '+5 Max User, +155 Listing Posting, +6 Display Ads, +5 Featured Ads, Listings Database Access, 30 days duration', '{\"max_post\":\"155\",\"max_users\":\"5\",\"display_ads\":\"6\",\"featured_ads\":\"5\",\"properties_DB\":\"1\"}', '30 days', '2999.000', 0, 1698927038, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mls_threads`
--

DROP TABLE IF EXISTS `mls_threads`;
CREATE TABLE IF NOT EXISTS `mls_threads` (
  `thread_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subject` text,
  `participants` text COMMENT 'participants user_id in JSON format',
  `accounts` text COMMENT 'collection of account_id of participants in JSON format',
  `created_by` bigint(20) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_threads`
--

INSERT INTO `mls_threads` (`thread_id`, `subject`, `participants`, `accounts`, `created_by`, `created_at`) VALUES
(1, 'Regarding Condominium in Muntinlupa City', '[1,2]', '[1,2]', 2, 1706442338);

-- --------------------------------------------------------

--
-- Table structure for table `mls_users`
--

DROP TABLE IF EXISTS `mls_users`;
CREATE TABLE IF NOT EXISTS `mls_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `user_level` int(10) UNSIGNED NOT NULL DEFAULT '2',
  `permissions` text,
  `two_factor_authentication` tinyint(1) NOT NULL DEFAULT '0',
  `two_factor_authentication_aps` varchar(50) DEFAULT NULL,
  `date_added` int(20) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mls_users`
--

INSERT INTO `mls_users` (`user_id`, `account_id`, `username`, `password`, `email`, `name`, `user_level`, `permissions`, `two_factor_authentication`, `two_factor_authentication_aps`, `date_added`) VALUES
(1, 1, 'eman', '9aa126e302832b2c95e29b11263b5e9f', 'eman00x2xx@gmail.com', 'Eman Olivas', 1, '{\"account\":{\"access\":\"true\"},\"users\":{\"access\":\"true\",\"delete\":\"true\"},\"leads\":{\"access\":\"true\",\"delete\":\"true\"},\"properties\":{\"access\":\"true\",\"delete\":\"true\"},\"subscriptions\":{\"purchased\":\"true\"}}', 0, '', 1697967624),
(2, 2, 'mayette', 'fb0fd131cffe9a9fa9f50d98860ed581', 'test@test.com', 'Mayette Olivas', 1, '{\"users\":{\"list\":\"true\",\"edit\":\"true\",\"delete\":\"true\"},\"leads\":{\"list\":\"true\",\"edit\":\"true\",\"delete\":\"true\"},\"properties\":{\"edit\":\"true\",\"delete\":\"true\"},\"subscriptions\":{\"purchased\":\"true\"}}', 0, '', 1698589128),
(4, 2, 'test233', 'testtesttest', 'testest@test.com', 'test2333', 2, '{\"users\":{\"list\":\"true\",\"edit\":\"true\",\"delete\":\"true\"},\"leads\":{\"list\":\"true\",\"edit\":\"true\",\"delete\":\"true\"},\"properties\":{\"edit\":\"true\",\"delete\":\"true\"}}', 0, NULL, 1698678896),
(5, 1, 'eman00x2x', '9aa126e302832b2c95e29b11263b5e9f', 'eman00x2xx@gmail.com', 'Eman Olivas', 2, '{\"users\":{\"access\":\"true\"},\"leads\":{\"access\":\"true\"},\"properties\":{\"access\":\"true\"}}', 0, NULL, 1698943915);

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
