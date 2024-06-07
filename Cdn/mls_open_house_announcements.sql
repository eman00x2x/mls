-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 07, 2024 at 04:20 PM
-- Server version: 8.0.21
-- PHP Version: 8.2.18

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
-- Table structure for table `mls_open_house_announcements`
--

DROP TABLE IF EXISTS `mls_open_house_announcements`;
CREATE TABLE IF NOT EXISTS `mls_open_house_announcements` (
  `announcement_id` bigint NOT NULL AUTO_INCREMENT,
  `account_id` bigint UNSIGNED NOT NULL,
  `listing_id` bigint NOT NULL,
  `listing_title` text,
  `subject` varchar(150) NOT NULL,
  `content` text,
  `started_at` int NOT NULL DEFAULT '0',
  `ended_at` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `created_at` int NOT NULL DEFAULT '0',
  `attachment` text,
  PRIMARY KEY (`announcement_id`),
  KEY `account_openhouse` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mls_open_house_announcements`
--

INSERT INTO `mls_open_house_announcements` (`announcement_id`, `account_id`, `listing_id`, `listing_title`, `subject`, `content`, `started_at`, `ended_at`, `status`, `created_at`, `attachment`) VALUES
(5, 1, 0, 'Solar-equipped House and Lot for Sale in SJDM City near Altaraza MRT7', 'Open House at SJDM City', '{\"address\":\"Altaraza MRT 7\",\"date\":\"2024-06-14T09:00\",\"details\":\"\"}', 1717689600, 1718380800, 1, 1717774726, 'https://mls.rosimulator.website/Cdn/images/listings/33b1965d5b5766009c273cfdedc33691.jpeg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mls_open_house_announcements`
--
ALTER TABLE `mls_open_house_announcements`
  ADD CONSTRAINT `account_openhouse` FOREIGN KEY (`account_id`) REFERENCES `mls_accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
