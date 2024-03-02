-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 02, 2024 at 06:17 AM
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
-- Table structure for table `mls_kyc`
--

DROP TABLE IF EXISTS `mls_kyc`;
CREATE TABLE IF NOT EXISTS `mls_kyc` (
  `kyc_id` bigint NOT NULL AUTO_INCREMENT,
  `account_id` bigint NOT NULL,
  `documents` text NOT NULL,
  `kyc_status` tinyint(1) NOT NULL,
  `id_expiration_date` date NOT NULL,
  `verified_by` varchar(100) DEFAULT NULL,
  `verified_at` int NOT NULL,
  `created_at` int NOT NULL,
  PRIMARY KEY (`kyc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mls_kyc`
--

INSERT INTO `mls_kyc` (`kyc_id`, `account_id`, `documents`, `kyc_status`, `id_expiration_date`, `verified_by`, `verified_at`, `created_at`) VALUES
(1, 1, '{\"kyc\":{\"selfie\":\"http:\\/\\/cdn.mls\\/public\\/kyc\\/1\\/25204571608383740508772462222517154777626165555225_fce36dd9b98a05edbe77f5fba82cc81b.png\",\"id\":\"http:\\/\\/cdn.mls\\/public\\/kyc\\/1\\/39098600953502751457358001019252366465063925400983_fce36dd9b98a05edbe77f5fba82cc81b.jpg\"}}', 1, '0000-00-00', 'Eman Olivas', 1709357056, 1709345258);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
