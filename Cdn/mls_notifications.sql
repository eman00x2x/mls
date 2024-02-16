-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 16, 2024 at 09:52 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mls_notifications`
--

INSERT INTO `mls_notifications` (`notification_id`, `account_id`, `content`, `status`, `created_at`) VALUES
(1, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 0, 1708071577),
(2, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 0, 1708071577),
(3, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 1, 1708071577),
(4, 1, '{\"title\":\"Eman Olivas requested a handshake\",\"message\":\"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City\",\"url\":\"http:\\/\\/manage.mls\\/mls\\/handshaked\"}', 1, 1708071577);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
