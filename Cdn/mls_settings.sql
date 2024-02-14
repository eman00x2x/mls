-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 14, 2024 at 10:09 AM
-- Server version: 8.2.0
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
-- Table structure for table `mls_settings`
--

DROP TABLE IF EXISTS `mls_settings`;
CREATE TABLE IF NOT EXISTS `mls_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `property_tags` text,
  `paypal_credentials` text,
  `show_vat` tinyint(1) NOT NULL DEFAULT '1',
  `email_address_responder` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `enable_kyc_verification` tinyint(1) NOT NULL DEFAULT '0',
  `enable_premium` tinyint(1) NOT NULL DEFAULT '0',
  `enable_pin_access` tinyint(1) NOT NULL DEFAULT '0',
  `analytics` text,
  `header_script` text,
  `data_privacy` text CHARACTER SET utf8mb4,
  `terms` text,
  `refund_policy` text,
  `modified_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mls_settings`
--

INSERT INTO `mls_settings` (`id`, `property_tags`, `paypal_credentials`, `show_vat`, `email_address_responder`, `enable_kyc_verification`, `enable_premium`, `enable_pin_access`, `analytics`, `header_script`, `data_privacy`, `terms`, `refund_policy`, `modified_at`) VALUES
(1, NULL, NULL, 1, '', 0, 0, 0, NULL, NULL, NULL, NULL, '<p>refund policy</p>', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
