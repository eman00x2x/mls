-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: mls
-- ------------------------------------------------------
-- Server version 	8.3.0
-- Date: Mon, 15 Apr 2024 00:36:55 +0800

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `mls_account_subscriptions`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_account_subscriptions` (
  `account_subscription_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint unsigned NOT NULL,
  `transaction_id` bigint NOT NULL,
  `premium_id` int NOT NULL,
  `subscription_date` int unsigned NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  `subscription_start_at` int unsigned NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  `subscription_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = suspended, 1 = active, 2 = ended',
  `subscription_end_at` int unsigned NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  PRIMARY KEY (`account_subscription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_account_subscriptions`
--

LOCK TABLES `mls_account_subscriptions` WRITE;
/*!40000 ALTER TABLE `mls_account_subscriptions` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mls_account_subscriptions` VALUES (1,1116,1,2,1712846505,1712846505,1,1744382505),(2,1118,2,1,1712997927,1712997927,1,1744533927),(3,1,3,1,1713074500,1713074500,1,1744610500);
/*!40000 ALTER TABLE `mls_account_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_account_subscriptions` with 3 row(s)
--

--
-- Table structure for table `mls_accounts`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_accounts` (
  `account_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference_id` bigint NOT NULL DEFAULT '0',
  `account_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Possible value Administrator, Web Admin, Customer Service, Real Estate Practitioner',
  `logo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'A valid image url',
  `company_name` varchar(150) DEFAULT NULL,
  `profession` varchar(150) DEFAULT NULL,
  `real_estate_license_number` varchar(150) DEFAULT NULL,
  `board_region` varchar(150) DEFAULT NULL,
  `local_board_name` varchar(200) DEFAULT NULL,
  `account_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'Posible values\r\n{\r\n    "prefix": "",\r\n    "firstname": "",\r\n    "middlename": "",\r\n    "lastname": "",\r\n    "suffix": ""\r\n}',
  `birthdate` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'date formated as YYYY-mm-dd',
  `street` varchar(150) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `profile` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'Posible values\r\n{\r\n    "about_me": "",\r\n    "education": [\r\n        {\r\n            "school": "",\r\n            "degree": "",\r\n            "date": {\r\n                "from": "",\r\n                "to": ""\r\n            }\r\n        }\r\n    ],\r\n    "affiliation": [\r\n        {\r\n            "organization": "",\r\n            "title": "",\r\n            "description": "",\r\n            "date": {\r\n                "from": 0,\r\n                "to": 0\r\n            }\r\n        }\r\n    ],\r\n    "certification": [\r\n        ""\r\n    ],\r\n    "skills": [\r\n        ""\r\n    ]\r\n}',
  `uploads` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'An array of filenames uploaded JSON format',
  `preferences` text,
  `privileges` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'account privileges\r\n\r\n{\r\n    "max_post": 20,\r\n    "max_users": 1,\r\n    "mls_access": 0,\r\n    "chat_access": 1,\r\n    "featured_ads": 0,\r\n    "handshake_limit": 1,\r\n    "comparative_analysis_access": 0\r\n}\r\njson format',
  `message_keys` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'A Web Crypto API generated value by the system (public_key and private_key) JSON Format for encryption and decryption of private message',
  `api_key` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'A Web Crypto API generated value (random generated 33 characters)',
  `pin` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'A Web Crypto API generated value (random generated 6 characters)',
  `status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'active' COMMENT 'Posible values are active, banned, pending_activation',
  `registered_at` int NOT NULL COMMENT 'epoch of time',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1119 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_accounts`
--

LOCK TABLES `mls_accounts` WRITE;
/*!40000 ALTER TABLE `mls_accounts` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mls_accounts` VALUES (1,1,'Administrator','http://cdn.mls/images/accounts/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg','EmanPOÑ','Real Estate Broker','27431','{\"region\": \"NCR\", \"province\": \"Metro Manila\", \"municipality\": \"Pasig City\"}','PRB PASIG REAL ESTATE BOARD INC','{\"prefix\":\"\",\"firstname\":\"Eman\",\"middlename\":\"Panas\",\"lastname\":\"Olivas\",\"suffix\":\"\"}','1988-08-18','55 Justice R jabson St','Pasig City','National Capital Region',NULL,'09175223499','eman00x2xx@gmail.com','666-666-6663','{\"about_me\":\"Fusce cursus scelerisque leo, at fermentum ipsum blandit non. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse varius dui risus, sed venenatis metus gravida ac. In hac habitasse platea dictumst. Sed id tellus sed felis eleifend porta sit amet sit amet felis. Maecenas non diam ante. Praesent porttitor tortor sit amet lorem ultricies malesuada. Cras vitae blandit nisi, non tempor mauris. Nullam sit amet tristique mauris. Sed commodo enim massa, sagittis commodo metus tristique at. Mauris eget pretium libero\",\"education\":[{\"school\":\"Donec vel magna elementum eros porta laoreet id a arcu\",\"degree\":\"Sed vitae ex in diam volutpat viverra eget sit amet orci\",\"date\":{\"from\":\"2010-03-01\",\"to\":\"2010-03-01\"}}],\"affiliation\":[{\"organization\":\"Lorem ipsum dolor sit amet\",\"title\":\"Consectetur Adipiscing Elit\",\"date\":{\"from\":\"2007-09-07\",\"to\":\"\"},\"description\":\"Duis maximus ornare dolor at condimentum. Fusce cursus scelerisque leo, at fermentum ipsum blandit non. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse varius dui risus, sed venenatis metus gravida ac. In hac habitasse platea dictumst. Sed id tellus sed felis eleifend porta sit amet sit amet felis. Maecenas non diam ante. Praesent porttitor tortor sit amet lorem ultricies malesuada. Cras vitae blandit nisi, non tempor mauris. Nullam sit amet tristique mauris. Sed commodo enim massa, sagittis commodo metus tristique at. Mauris eget pretium libero.\"}],\"certification\":[\"Certified Real Estate Professional\"],\"skills\":[\"Full-Stack Developer\",\"System Engineer\",\"Search Engine Optimization\",\"User Experience Design\",\"RESTful API Architecture\"]}','\"\"','','{\"max_post\":\"15\",\"max_users\":\"10\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"featured_ads\":\"1\",\"handshake_limit\":\"1\",\"comparative_analysis_access\":\"1\",\"api_access\":\"1\"}','{\"publicKey\":{\"crv\":\"P-256\",\"ext\":true,\"key_ops\":[],\"kty\":\"EC\",\"x\":\"jBlAwEAvA3JYbe-3WiMG8_X2K-HY1frmilJuaQfTWes\",\"y\":\"dxhiRHwAn92ivl-6JB4TItk4pOaDTI0xkikAru7KasU\"},\"privateKey\":{\"crv\":\"P-256\",\"d\":\"SXWnspSGKgeTbJopHRMBgQT9pf2OYo_QZzWe5FBvpvY\",\"ext\":true,\"key_ops\":[\"deriveKey\",\"deriveBits\"],\"kty\":\"EC\",\"x\":\"jBlAwEAvA3JYbe-3WiMG8_X2K-HY1frmilJuaQfTWes\",\"y\":\"dxhiRHwAn92ivl-6JB4TItk4pOaDTI0xkikAru7KasU\"}}','495c0551-7fe3-4e94-a834-aea3183c8a29','3b4b80','active',2147483647),(13,0,'Web Admin','http://cdn.mls//images/accounts/62431056605513408591884938382327130853331412768908_25b068b08614baf21ff7948e212a68ec.png','1','Real Estate Consultant','1',NULL,NULL,'{\"prefix\":\"\",\"firstname\":\"Web\",\"lastname\":\"Admin\",\"suffix\":\"\"}','2024-02-26','1','1','1',NULL,'1','webadmin@email.com','1','','\"\"',NULL,'{\"max_post\":\"20\",\"max_users\":\"100\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}','{\"publicKey\":{\"crv\":\"P-256\",\"ext\":true,\"key_ops\":[],\"kty\":\"EC\",\"x\":\"FtJ8BrQcySMscdNY5aoTPbREuukKbsrYCV55IWizYg0\",\"y\":\"N3noFmcH8g5S8ihwsSd8iQnZGoD4G0-45S79X_1lwnk\"},\"privateKey\":{\"crv\":\"P-256\",\"d\":\"HT3cqkxFthmI0GQuuiL-UC8XPq7_0JGIq_VHOW-DXWk\",\"ext\":true,\"key_ops\":[\"deriveKey\",\"deriveBits\"],\"kty\":\"EC\",\"x\":\"FtJ8BrQcySMscdNY5aoTPbREuukKbsrYCV55IWizYg0\",\"y\":\"N3noFmcH8g5S8ihwsSd8iQnZGoD4G0-45S79X_1lwnk\"}}',NULL,NULL,'active',1708955333),(14,0,'Customer Service','http://cdn.mls//images/accounts/39458210912031056194403473478696932053484928515886_93bdc4f8d9d2671146f22a2827041f01.webp','1','1','1',NULL,NULL,'{\"prefix\":\"\",\"firstname\":\"Customer\",\"lastname\":\"Service\",\"suffix\":\"\"}','2024-02-26','1','1','1',NULL,'1','customer_service@email.com','1','','\"\"',NULL,'{\"max_post\":\"20\",\"max_users\":\"100\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"display_ads\":\"0\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\"}','{\"publicKey\":{\"crv\":\"P-256\",\"ext\":true,\"key_ops\":[],\"kty\":\"EC\",\"x\":\"u3RD_wnxQjp-yEDUCjgNPk0S_zEZR5PyAsoBj5PTHAU\",\"y\":\"tBGbTukoJZRhhqoJMf96PJB91xDd8709kKM-v_uwA6s\"},\"privateKey\":{\"crv\":\"P-256\",\"d\":\"Sfw5M-kZu4vbueezPGifWDA0veqAKUCDzz5-usGq1so\",\"ext\":true,\"key_ops\":[\"deriveKey\",\"deriveBits\"],\"kty\":\"EC\",\"x\":\"u3RD_wnxQjp-yEDUCjgNPk0S_zEZR5PyAsoBj5PTHAU\",\"y\":\"tBGbTukoJZRhhqoJMf96PJB91xDd8709kKM-v_uwA6s\"}}',NULL,NULL,'active',1708955333),(1116,1,'Real Estate Practitioner','http://localhost/mls/cdn//images/accounts/20762307759459331518404004928518478531494056929542_3102e1f908149aa680c5818e271a6b1d.jpg','Test Company','Real Estate Broker','74321','{\"region\":\"NCR\",\"province\":\"Metro Manila\",\"municipality\":\"Pasig City\"}','PRB PASIG REAL ESTATE BOARD INC','{\"prefix\":\"\",\"firstname\":\"Eman\",\"middlename\":\"Panas\",\"lastname\":\"Olivas\",\"suffix\":\"\"}','1988-08-18','55 Justice R jabson St Bambang','Pasig City','Metro Manila',NULL,'09175223499','eman.olivas@gmail.com','15674896','{\"about_me\":null,\"education\":[{\"school\":\"\",\"degree\":\"\",\"date\":{\"from\":\"\",\"to\":\"\"}}],\"affiliation\":[{\"organization\":\"\",\"title\":\"\",\"description\":\"\",\"date\":{\"from\":0,\"to\":0}}],\"certification\":[\"\"],\"skills\":[\"\"]}','\"\"',NULL,'{\"max_post\":\"20\",\"max_users\":\"1\",\"mls_access\":\"0\",\"chat_access\":\"1\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\",\"comparative_analysis_access\":\"0\"}','{\"publicKey\":{\"crv\":\"P-256\",\"ext\":true,\"key_ops\":[],\"kty\":\"EC\",\"x\":\"tJM9JrdQCWnV0A1EvTjRNCp1pbiDcv2FviR4AdBCqmk\",\"y\":\"yrv4JMDAhe_ezgcQvv05cEAAf7QGJuSdbe0m8Zb1OfI\"},\"privateKey\":{\"crv\":\"P-256\",\"d\":\"rBVrBajC86E29S26tKnYDH0F3Pv5bB6IS7OJR5u_fPI\",\"ext\":true,\"key_ops\":[\"deriveKey\",\"deriveBits\"],\"kty\":\"EC\",\"x\":\"tJM9JrdQCWnV0A1EvTjRNCp1pbiDcv2FviR4AdBCqmk\",\"y\":\"yrv4JMDAhe_ezgcQvv05cEAAf7QGJuSdbe0m8Zb1OfI\"}}','264d8b5e72e189f1-b0b4dca6f52e3622','3b4b80','active',1712844126),(1118,1,'Real Estate Practitioner',NULL,NULL,'Real Estate Broker','74321','{\"region\":\"NCR\",\"province\":\"Metro Manila\",\"municipality\":\"\"}','QCRB QUEZON CITY REAL ESTATE BOARD INC','{\"prefix\":\"\",\"firstname\":\"Emanex\",\"middlename\":\"\",\"lastname\":\"Olivas\",\"suffix\":\"\"}','1988-08-18','55 Justice R Jabson St Bambang','Pasig City','Metro Manila',NULL,'09175223499','eman@gmail.com',NULL,'{\"about_me\":null,\"education\":[{\"school\":\"\",\"degree\":\"\",\"date\":{\"from\":\"\",\"to\":\"\"}}],\"affiliation\":[{\"organization\":\"\",\"title\":\"\",\"description\":\"\",\"date\":{\"from\":0,\"to\":0}}],\"certification\":[\"\"],\"skills\":[\"\"]}','\"\"',NULL,'{\"max_post\":\"20\",\"max_users\":\"1\",\"mls_access\":\"0\",\"chat_access\":\"1\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\",\"comparative_analysis_access\":\"0\"}','{\"publicKey\":{\"crv\":\"P-256\",\"ext\":true,\"key_ops\":[],\"kty\":\"EC\",\"x\":\"n1yqTu2eCjWbGEbKi5NHI4fW48gMia6n23gSQ--wkKw\",\"y\":\"U08-KHqNCx1kPVEkq-l3m8LqiCPeZfn8CBok8zF7eos\"},\"privateKey\":{\"crv\":\"P-256\",\"d\":\"RAkETigRHp0IizwFDQs8HmNY1kztdddMlNKZCO6UfG0\",\"ext\":true,\"key_ops\":[\"deriveKey\",\"deriveBits\"],\"kty\":\"EC\",\"x\":\"n1yqTu2eCjWbGEbKi5NHI4fW48gMia6n23gSQ--wkKw\",\"y\":\"U08-KHqNCx1kPVEkq-l3m8LqiCPeZfn8CBok8zF7eos\"}}','aa87adeaf434379d-a4fa2fda22287fa7','9ce612','active',1712996070);
/*!40000 ALTER TABLE `mls_accounts` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_accounts` with 5 row(s)
--

--
-- Table structure for table `mls_articles`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_articles` (
  `article_id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(150) DEFAULT NULL,
  `title` text,
  `name` text,
  `banner` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'image url',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'HTML format value',
  `publish` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = published, 0 = unpublished',
  `created_by` text,
  `created_at` int NOT NULL COMMENT 'epoch of time',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_articles`
--

LOCK TABLES `mls_articles` WRITE;
/*!40000 ALTER TABLE `mls_articles` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `mls_articles` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_articles` with 0 row(s)
--

--
-- Table structure for table `mls_deleted_threads`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_deleted_threads` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `thread_id` bigint NOT NULL,
  `account_id` bigint NOT NULL,
  `deleted_by` varchar(50) NOT NULL,
  `deleted_at` int unsigned NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_deleted_threads`
--

LOCK TABLES `mls_deleted_threads` WRITE;
/*!40000 ALTER TABLE `mls_deleted_threads` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `mls_deleted_threads` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_deleted_threads` with 0 row(s)
--

--
-- Table structure for table `mls_handshakes`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_handshakes` (
  `handshake_id` bigint NOT NULL AUTO_INCREMENT,
  `requestor_account_id` bigint NOT NULL,
  `requestor_details` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'Posible Value\r\n{\r\n    "account_id": 1,\r\n    "logo": "http://cdn.mls/images/accounts/dde1e1eaa66d4e.jpg",\r\n    "company_name": "My Name;",\r\n    "profession": "Real Estate Broker",\r\n    "real_estate_license_number": 22554,\r\n    "firstname": "My Firstname",\r\n    "lastname": "My Lastname",\r\n    "birthdate": "1901-01-01",\r\n    "street": "My Street Address",\r\n    "city": "My City Address",\r\n    "province": "National Capital Region",\r\n    "mobile_number": "xxxxxxxxxxx",\r\n    "email": "myemail@email.com",\r\n    "tin": "xxx-xxx-xxxx",\r\n    "status": "active",\r\n    "registered_at": 2147483647\r\n}\r\nJSON format',
  `requestee_account_id` bigint NOT NULL,
  `listing_id` bigint NOT NULL,
  `handshake_status` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'pending' COMMENT 'Posible values accepted, pending, denied, cancelled',
  `handshake_status_at` int NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  `requested_at` int NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  PRIMARY KEY (`handshake_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_handshakes`
--

LOCK TABLES `mls_handshakes` WRITE;
/*!40000 ALTER TABLE `mls_handshakes` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `mls_handshakes` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_handshakes` with 0 row(s)
--

--
-- Table structure for table `mls_kyc`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_kyc` (
  `kyc_id` bigint NOT NULL AUTO_INCREMENT,
  `account_id` bigint NOT NULL,
  `documents` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Posible values\r\n\r\n{"kyc":{"selfie":"http://localhost/mls/cdn/public/kyc/1/0322b613cdb8e75d995.webp", "id":"http://localhost/mls/cdn/public/kyc/1/613cdb8e75d995.png"}}',
  `kyc_status` tinyint(1) NOT NULL COMMENT '0=pending, 1=verified, 2=denied, 3=expired',
  `id_expiration_date` date NOT NULL,
  `verification_details` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Posible values\r\n\r\nLow-resolution selfie picture, Blurred selfie picture, Invalid selfie picture, Invalid selfie picture and ID, Invalid ID, Blurred ID, Expired ID, ID expiration not indicated, ID details cannot be seen, ID too small, Low-resolution ID, Documents accepted',
  `verified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'KYC Officer name',
  `verified_at` int NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  `created_at` int NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  PRIMARY KEY (`kyc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_kyc`
--

LOCK TABLES `mls_kyc` WRITE;
/*!40000 ALTER TABLE `mls_kyc` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `mls_kyc` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_kyc` with 0 row(s)
--

--
-- Table structure for table `mls_leads`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_leads` (
  `lead_id` bigint NOT NULL AUTO_INCREMENT,
  `listing_id` bigint NOT NULL,
  `account_id` bigint NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'A Web Crypto API Encrypted value',
  `iv` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'initialization vector that can be used with secret key for data decryption',
  `preferences` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'Posible value\r\n\r\n{"type":"Residential","bedroom":"4","bathroom":"2","parking":"2","lot_area":"2589","category":"Condominium","address":{"barangay":"","municipality":"Pasig City","province":"Metro Manila","region":"NCR"}}\r\n\r\nin JSON Format',
  `inquire_at` int NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  PRIMARY KEY (`lead_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_leads`
--

LOCK TABLES `mls_leads` WRITE;
/*!40000 ALTER TABLE `mls_leads` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `mls_leads` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_leads` with 0 row(s)
--

--
-- Table structure for table `mls_license_reference`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_license_reference` (
  `reference_id` bigint NOT NULL AUTO_INCREMENT,
  `broker_prc_license_id` varchar(150) DEFAULT NULL,
  `created_at` int NOT NULL,
  PRIMARY KEY (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_license_reference`
--

LOCK TABLES `mls_license_reference` WRITE;
/*!40000 ALTER TABLE `mls_license_reference` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mls_license_reference` VALUES (1,'74321',1712843569);
/*!40000 ALTER TABLE `mls_license_reference` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_license_reference` with 1 row(s)
--

--
-- Table structure for table `mls_listing_images`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_listing_images` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `listing_id` int unsigned NOT NULL,
  `filename` text NOT NULL,
  `width` int NOT NULL,
  `height` int NOT NULL,
  `url` text CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'A valid image url',
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_listing_images`
--

LOCK TABLES `mls_listing_images` WRITE;
/*!40000 ALTER TABLE `mls_listing_images` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mls_listing_images` VALUES (1,1,'dc589782e5e5afd176f7f2adfbda076a.webp',1024,687,'http://localhost/mls/cdn/images/listings/dc589782e5e5afd176f7f2adfbda076a.webp'),(34,1,'4c93725538358ac916d64690ae51e780.webp',675,900,'http://localhost/mls/cdn/images/listings/4c93725538358ac916d64690ae51e780.webp'),(35,1,'fe45439ed24ce6731218d0d6ffe939bd.webp',1024,768,'http://localhost/mls/cdn/images/listings/fe45439ed24ce6731218d0d6ffe939bd.webp'),(36,1,'02880239de6679a6e9e4c67ecac7bff3.webp',675,900,'http://localhost/mls/cdn/images/listings/02880239de6679a6e9e4c67ecac7bff3.webp'),(37,1,'a08f1533b0f14d6ad9e46080688ed91f.webp',675,900,'http://localhost/mls/cdn/images/listings/a08f1533b0f14d6ad9e46080688ed91f.webp');
/*!40000 ALTER TABLE `mls_listing_images` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_listing_images` with 5 row(s)
--

--
-- Table structure for table `mls_listings`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_listings` (
  `listing_id` int NOT NULL AUTO_INCREMENT,
  `account_id` bigint NOT NULL,
  `is_mls` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'possible value 1 or 0',
  `is_mls_option` text CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'Possible value \r\n{"local_board":1,"local_region":1,"all":1}\r\n\r\nJSON Format',
  `is_website` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'possible value 1 or 0',
  `featured` tinyint NOT NULL DEFAULT '0' COMMENT 'possible value 1 or 0',
  `offer` varchar(50) DEFAULT NULL COMMENT 'for sale, for rent',
  `type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Possible value Residential, Commercial',
  `foreclosed` tinyint unsigned NOT NULL DEFAULT '0' COMMENT 'possible value 1 or 0',
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'a uri safe value',
  `title` varchar(255) NOT NULL,
  `tags` text CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'Possible value foreclosure, new, old, fully furnished, bare, semi-furnished',
  `long_desc` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'HTML format value',
  `category` varchar(150) NOT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'Possible values\r\n{"barangay":"New Alabang Village","municipality":"Muntinlupa City","province":"Metro Manila","region":"NCR"}\r\n\r\nJSON Format',
  `price` bigint NOT NULL,
  `reservation` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `payment_details` text CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'Possible value\r\n{"option_money_duration":"15","payment_mode":"Installment","tax_allocation":"Seller Agrees to Pay Capital Gains Tax and Buyer Pays Transfer Tax","bank_loan":0,"pagibig_loan":0,"assume_balance":0}\r\nJSON Format',
  `floor_area` int unsigned NOT NULL DEFAULT '0',
  `lot_area` int unsigned NOT NULL DEFAULT '0',
  `bedroom` int unsigned NOT NULL DEFAULT '0',
  `bathroom` int unsigned NOT NULL DEFAULT '0',
  `parking` int unsigned NOT NULL DEFAULT '0',
  `thumb_img` text CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'A valid image url',
  `video` text CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'a valid Youtube url',
  `amenities` text CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'A comma delimited value',
  `other_details` text CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'Possible value\r\n\r\n{"authority_type":"Non-Exclusive Authority To Sell","com_share":"2"}\r\n\r\nJSON Format',
  `created_at` int unsigned NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  `modified_at` int unsigned NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  `status` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '1 = available, 2 = sold, 3 = removed',
  `sold_price` int NOT NULL DEFAULT '0',
  `duration` int NOT NULL DEFAULT '0' COMMENT 'possible value is epoch of time - posting end date',
  `post_score` decimal(10,3) NOT NULL DEFAULT '0.000',
  `display` tinyint unsigned NOT NULL DEFAULT '1' COMMENT '1 = show, 2 = hidden',
  PRIMARY KEY (`listing_id`),
  FULLTEXT KEY `name` (`type`,`title`,`tags`,`long_desc`,`category`,`address`,`amenities`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_listings`
--

LOCK TABLES `mls_listings` WRITE;
/*!40000 ALTER TABLE `mls_listings` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mls_listings` VALUES (1,1116,1,'{\"local_board\":1,\"local_region\":1,\"all\":1}',1,0,'for sale','Residential',0,'single-attached-house-lily-improved-for-sale-in-the-hauslands-bataan','Single Attached House (Lily Improved) for Sale in The Hauslands Bataan','[\"New\",\"Ready for Occupancy\"]','<p>The trusted brand&ndash; Hauslands, has embarked on yet another milestone with the development of Hauslands Bataan. &nbsp;A commitment to providing &amp; uplifting lives of the modern Filipinos.</p>\r\n<p>Located in Barangay Capitangan, Abucay, Bataan&mdash; The Hauslands Bataan, offers greater access to mobility, urbanization and work-life balance. &nbsp;Vital to its design is its location and the PEOPLE&rsquo;s evolving needs and values&ndash; Hausland&rsquo;s response to the emerging residential trends.&nbsp;</p>\r\n<p>Conveniently located &nbsp;along the National Road and a few kilometers away from Roman Hi-way which has access to SCTEX and NLEX, clearly making it a central and important location with easy access to malls &amp; public market, hospitals, schools/universities &amp; cathedrals.&nbsp;</p>\r\n<p>DHSUD Prov. LS No. 2022-09-419 (27SEP2022)&nbsp;</p>\r\n<p>Project Completion Date: L.D. December 2030.&nbsp;</p>\r\n<p>DHSUD-R3-AA-2024/03-___ Developed by Hausland Development Corporation.</p>\r\n<p>Turnover Date: December 2025</p>','Condominium','{\"barangay\":\"Bambang\",\"municipality\":\"Pasig City\",\"province\":\"Metro Manila\",\"region\":\"NCR\",\"street\":\"\",\"village\":\"\"}',3810000,20000.00,'{\"option_money_duration\":\"30\",\"payment_mode\":\"Installment\",\"tax_allocation\":\"Seller Agrees to Pay Capital Gains Tax and Buyer Pays Transfer Tax\",\"bank_loan\":1,\"pagibig_loan\":1,\"assume_balance\":1}',70,88,3,2,1,'http://localhost/mls/cdn/images/listings/dc589782e5e5afd176f7f2adfbda076a.webp',NULL,'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools','{\"authority_type\":\"N\\/A\",\"authority_to_sell_expiration\":1723046400,\"com_share\":\"50\"}',1712848657,1712850999,1,3810000,1712825789,4.780,1),(2,1116,1,'{\"local_board\":1,\"local_region\":1,\"all\":1}',1,0,'for sale','Residential',0,'single-attached-house-lily-improved-for-sale-in-the-hauslands-bataan','Single Attached House (Lily Improved) for Sale in The Hauslands Bataan','[\"New\",\"Ready for Occupancy\"]','<p>The trusted brand&ndash; Hauslands, has embarked on yet another milestone with the development of Hauslands Bataan. &nbsp;A commitment to providing &amp; uplifting lives of the modern Filipinos.</p>\r\n<p>Located in Barangay Capitangan, Abucay, Bataan&mdash; The Hauslands Bataan, offers greater access to mobility, urbanization and work-life balance. &nbsp;Vital to its design is its location and the PEOPLE&rsquo;s evolving needs and values&ndash; Hausland&rsquo;s response to the emerging residential trends.&nbsp;</p>\r\n<p>Conveniently located &nbsp;along the National Road and a few kilometers away from Roman Hi-way which has access to SCTEX and NLEX, clearly making it a central and important location with easy access to malls &amp; public market, hospitals, schools/universities &amp; cathedrals.&nbsp;</p>\r\n<p>DHSUD Prov. LS No. 2022-09-419 (27SEP2022)&nbsp;</p>\r\n<p>Project Completion Date: L.D. December 2030.&nbsp;</p>\r\n<p>DHSUD-R3-AA-2024/03-___ Developed by Hausland Development Corporation.</p>\r\n<p>Turnover Date: December 2025</p>','House and Lot','{\"barangay\":\"Capitangan\",\"municipality\":\"Pasig City\",\"province\":\"Metro Manila\",\"region\":\"NCR\",\"street\":\"\",\"village\":\"\"}',6810000,20000.00,'{\"option_money_duration\":\"30\",\"payment_mode\":\"Installment\",\"tax_allocation\":\"Seller Agrees to Pay Capital Gains Tax and Buyer Pays Transfer Tax\",\"bank_loan\":1,\"pagibig_loan\":1,\"assume_balance\":1}',70,88,3,2,1,'http://localhost/mls/cdn/images/listings/dc589782e5e5afd176f7f2adfbda076a.webp',NULL,'Club House,24 Hours Security,Guard House,Gated Community,CCTV Cameras,Near Malls,Near Hospitals,Near Public Markets,Near in Churches,Near in Schools','{\"authority_type\":\"N\\/A\",\"authority_to_sell_expiration\":1723046400,\"com_share\":\"50\"}',1712848657,1712850999,1,3810000,1712825789,4.780,1);
/*!40000 ALTER TABLE `mls_listings` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_listings` with 2 row(s)
--

--
-- Table structure for table `mls_messages`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_messages` (
  `message_id` bigint NOT NULL AUTO_INCREMENT,
  `thread_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'A Web Crypto API Encrypted value',
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Possible value is 1 or 0',
  `iv` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'initialization vector that can be used with secret key for data decryption',
  `created_at` int unsigned NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_messages`
--

LOCK TABLES `mls_messages` WRITE;
/*!40000 ALTER TABLE `mls_messages` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `mls_messages` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_messages` with 0 row(s)
--

--
-- Table structure for table `mls_notifications`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_notifications` (
  `notification_id` bigint NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'Possible value\r\n{"title":"My Name requested a handshake","message":"Modern 2 storey 5 bedrooms Alabang 400 Village, Muntinlupa City","url":"http://manage.mls/mls/handshaked"}\r\n\r\nJSON Format',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Possible value 1 or 0',
  `created_at` int NOT NULL COMMENT 'epoch of time',
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_notifications`
--

LOCK TABLES `mls_notifications` WRITE;
/*!40000 ALTER TABLE `mls_notifications` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `mls_notifications` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_notifications` with 0 row(s)
--

--
-- Table structure for table `mls_page_ads`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_page_ads` (
  `page_ads_id` int NOT NULL AUTO_INCREMENT,
  `banner` text,
  `placement` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Possible value\r\nPROPERTY_LIST_TOP, PROPERTY_VIEW_SIDEBAR_TOP, PROPERTY_VIEW_SIDEBAR_BOTTOM, ARTICLE_LIST_SIDEBAR, ARTICLE_VIEW_SIDEBAR, PROFILE_TOP, PROFILE_SIDEBAR_TOP',
  `visibility` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'visible',
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'a valid url',
  `impresion` int NOT NULL DEFAULT '0',
  `clicked` int NOT NULL DEFAULT '0',
  `started_at` int DEFAULT '0' COMMENT 'epoch of time',
  `ended_at` int NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  `created_at` int NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  PRIMARY KEY (`page_ads_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_page_ads`
--

LOCK TABLES `mls_page_ads` WRITE;
/*!40000 ALTER TABLE `mls_page_ads` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `mls_page_ads` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_page_ads` with 0 row(s)
--

--
-- Table structure for table `mls_premiums`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_premiums` (
  `premium_id` bigint NOT NULL AUTO_INCREMENT,
  `category` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'Possible value package or individual',
  `type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'limited_time' COMMENT 'Possible value limited_time',
  `name` varchar(50) DEFAULT NULL,
  `details` text,
  `script` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'Possible value\r\n{"max_post":"120","max_users":"4","display_ads":"5","featured_ads":"4"}\r\nJSON Format',
  `duration` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'Possible value ["30","90","180","365"] JSON Format',
  `cost` decimal(15,2) NOT NULL DEFAULT '0.00',
  `visibility` tinyint unsigned NOT NULL DEFAULT '1' COMMENT 'Possible value 1 or 0',
  `created_at` int unsigned NOT NULL COMMENT 'epoch of time',
  `date_end` int unsigned NOT NULL COMMENT 'epoch of time',
  PRIMARY KEY (`premium_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_premiums`
--

LOCK TABLES `mls_premiums` WRITE;
/*!40000 ALTER TABLE `mls_premiums` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mls_premiums` VALUES (1,'package','limited_time','Bronze','+15 Listings, +1 Handshake Limit, MLS Access, Chat Access','{\"max_post\":\"15\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"handshake_limit\":\"1\"}','[\"30\",\"90\",\"180\",\"365\"]',999.00,1,1712844802,0),(2,'package','limited_time','Silver','Includes Bronze Package and +30 listings, +1 Featured ad, +1 Max User','{\"max_post\":\"45\",\"max_users\":\"1\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"featured_ads\":\"1\",\"handshake_limit\":\"1\"}','[30,90,180,365]',2000.00,1,1712844802,0);
/*!40000 ALTER TABLE `mls_premiums` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_premiums` with 2 row(s)
--

--
-- Table structure for table `mls_settings`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_name` varchar(50) DEFAULT NULL,
  `contact_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'Possible value\r\n{"mobile_number":"09199999999","email":"myorg@email.com","office_address":"55 sitio st brgy pinagkaisahan quezon city","contact_page_text":"Donec a lobortis diam. Sed eu accumsan lectus. Nunc viverra eros non dui euismod interdum viverra vitae libero. Vestibulum fringilla, eros id volutpat mattis, ipsum ipsum elementum elit, quis posuere erat nisl ac augue. Etiam nec vehicula massa. Donec eget eros non tellus suscipit lobortis. Pellentesque dapibus ante augue, sed luctus nunc laoreet vel."}\r\nJSON Format',
  `property_tags` text,
  `paypal_credentials` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'Possible value\r\n{"client_id":"AczoZMmV6Tkw24LL55FDfCaCMsp7aSo5bf75EFLy22u0nswrH15Cmrac2tsimtGCLaiU35vb605Pi3oF","client_secret":"EOxCjX0hgxSaffhW1QEFZcqto_LBL_qnAIl22TuYH1sVio-AljiMdb6ti95V8z0lb_RbKLexNcSSibE0"}\r\nJSON Format',
  `show_vat` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Posible value 1 or 0',
  `chat_is_websocket` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Posible value 1 or 0',
  `websocket` text,
  `email_address_responder` varchar(150) NOT NULL,
  `enable_kyc_verification` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Posible value 1 or 0',
  `enable_premium` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Posible value 1 or 0',
  `enable_pin_access` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Posible value 1 or 0',
  `privileges` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'Default system privileges\r\n{ "max_post": 20, "max_users": 1, "mls_access": 0, "chat_access": 1, "featured_ads": 0, "handshake_limit": 1, "comparative_analysis_access": 0 }\r\njson format',
  `analytics` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'javascript',
  `header_script` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'javascript',
  `data_privacy` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'HTML Format value',
  `terms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'HTML Format value',
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'HTML Format value',
  `refund_policy` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'HTML Format value',
  `modified_at` int NOT NULL COMMENT 'epoch of time',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_settings`
--

LOCK TABLES `mls_settings` WRITE;
/*!40000 ALTER TABLE `mls_settings` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mls_settings` VALUES (1,'MLS','{\"mobile_number\":\"09199999999\",\"email\":\"myorg@email.com\",\"office_address\":\"55 sitio st brgy pinagkaisahan quezon city\",\"contact_page_text\":\"Donec a lobortis diam. Sed eu accumsan lectus. Nunc viverra eros non dui euismod interdum viverra vitae libero. Vestibulum fringilla, eros id volutpat mattis, ipsum ipsum elementum elit, quis posuere erat nisl ac augue. Etiam nec vehicula massa. Donec eget eros non tellus suscipit lobortis. Pellentesque dapibus ante augue, sed luctus nunc laoreet vel.\"}','[\"New\",\"Pre-Owned\",\"Fully Furnished\",\"Bare Unit\",\"Pre-Sale\",\"Ready for Occupancy\"]','{\"client_id\":\"AczoZMmV6Tkw24LL55FDfCaCMsp7aSo5bf75EFLy22u0nswrH15Cmrac2tsimtGCLaiU35vb605Pi3oF\",\"client_secret\":\"EOxCjX0hgxSaffhW1QEFZcqto_LBL_qnAIl22TuYH1sVio-AljiMdb6ti95V8z0lb_RbKLexNcSSibE0\"}',1,0,'{\"ip_address\":\"localhost\",\"port\":\"8555\"}','noreply@email.com',1,1,0,'{\"max_post\":\"15\",\"max_users\":\"2\",\"mls_access\":\"1\",\"chat_access\":\"1\",\"featured_ads\":\"0\",\"handshake_limit\":\"1\",\"comparative_analysis_access\":\"0\"}',NULL,NULL,'<h3 style=\"text-align: justify;\">Privacy Statement</h3>\r\n<p style=\"text-align: justify;\">Your personal information is important to My Organization., its employees, agents or representatives (collectively referred to as \"Organization\", \"we\", \"us\" or \"our\"). We handle your personal information and data in accordance with Republic Act No. 10173, otherwise known as the Data Privacy Act of 2012, and its Implementing Rules and Regulations, other issuances of the National Privacy Commission and other relevant laws of the Philippines (collectively, the \"DPA\"). We recognize the importance of your rights as a Data Subject under the DPA, as follows:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Right to be informed</li>\r\n<li>Right to object</li>\r\n<li>Right to access</li>\r\n<li>Right to correct</li>\r\n<li>Right to rectification, erasure or blocking</li>\r\n<li>Right to damages</li>\r\n<li>Right to data portability</li>\r\n<li>Transmissibility of rights</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">This Privacy Policy aims to provide information on how we collect, use, manage, and secure your personal information. Any information you provide to us indicates your express consent to our Privacy Policy.</p>\r\n<h3 style=\"text-align: justify;\">Personal Information Collection</h3>\r\n<p style=\"text-align: justify;\">Personal Information under the DPA refers to any information, whether recorded in a material form or not, from which the identity of an individual is apparent or can be reasonably and directly ascertained by the entity holding such information, or such information, when put together with other information, would directly and certainly identify an individual.</p>\r\n<p style=\"text-align: justify;\">In the performance of our services, or as part of our transactions and dealings, we collect your personal information which may include, but not limited to, the following:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Your name, nationality, civil status, gender, age, birthdate, ID details, unique identifiers, email address, residence, office, and mailing address, phone numbers and other information, as part of our transactions and dealings with you.</li>\r\n<li>Your browsing and social media behavior, when you browse into our website, download mobile applications and tag or mention us on your social media accounts.</li>\r\n<li>Any information you submit when to our sales, account management, or customer relations agents for update of your records or information; in relation to your inquiries or requests; when you participate in our survey, discount, event information and prize promotion; when you refer a person to verify the information you provided to us; when you visit and connect to our websites and social media pages; or any other event or activity that may be similar or related to any of the foregoing.</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">When you provide information other than your own, you certify that you have obtained the consent and authority of the owner of such information (such as your parents, spouse, children, dependent, or any other person) to allow us to disclose and process such information.</p>\r\n<h3 style=\"text-align: justify;\">Use and Sharing of Personal Information</h3>\r\n<p style=\"text-align: justify;\">We use your personal information to:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Process the products and services that you have availed from us.</li>\r\n<li>Communicate our latest products, services, promos and events.</li>\r\n<li>Respond immediately to your needs, requests, queries and complaints.</li>\r\n<li>Comply with the law, rule or regulation and all legal orders and processes.</li>\r\n<li>Process your application and conduct due diligence for, and documentation of, our transaction.</li>\r\n<li>Any other purpose relating to any of the above.</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">We share your personal information, to the extent that is reasonable and necessary, to:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Our employees or other personnel handling your transactions, orders or requests.</li>\r\n<li>Banks, insurers or professional advisers in connection with due diligence and documentation of your transaction.</li>\r\n<li>Any third-party service provider performing financial, administrative, technical and other ancillary services.</li>\r\n<li>Government institution and other competent authorities which by law, rules or regulations require us to disclose your personal information.</li>\r\n<li>Any person or entity we contractually entered with and who ensures the confidentiality standard we implement and adheres to the DPA.</li>\r\n<li>Any person in order to carry out functions of public authority, and for collection and further processing pertaining to law enforcement, taxation or other regulatory function.</li>\r\n</ol>\r\n<h3 style=\"text-align: justify;\">Personal Information Retention and Protection</h3>\r\n<p style=\"text-align: justify;\">We retain your personal information:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>To the extent necessary in keeping track of your transaction and records.</li>\r\n<li>As may be agreed upon by the parties to a contract.</li>\r\n<li>For statistical, research and other purpose specifically authorized by law.</li>\r\n</ol>\r\n<p style=\"text-align: justify;\">Data collected will be retained in accordance with retention limit set by our standards, industry standards and laws and regulations, unless you request your data to be deleted in our database.</p>\r\n<p style=\"text-align: justify;\">To maintain the integrity and confidentiality of your personal information, we put in place organizational, physical and technical security measures to protect your personal information, such as:</p>\r\n<ol style=\"text-align: justify;\">\r\n<li>Use of secured servers, firewalls, encryptions and other latest security tools.</li>\r\n<li>Limited access to personal information to those duly authorized processors. All transfers are made after complying with the established confidentiality policy and practices in place.</li>\r\n<li>Maintain a secured server operating environment by performing regular security patch update and server hardening.</li>\r\n</ol>\r\n<h3 style=\"text-align: justify;\">Cookies and Related Technologies</h3>\r\n<p style=\"text-align: justify;\">A cookie is a small piece of file which originates from a website and is transferred to the user\'s hard drive to record the user\'s browsing activity. Cookies were designed to remember pieces of information that the user has entered in a certain website. Essentially, cookies help in making the browsing of our site easier by, among other things, saving your name, addresses, passwords and other preferences.</p>\r\n<p style=\"text-align: justify;\">Most web browsers are set to automatically accept cookies, but you have the option to refuse all cookies or indicate when a cookie is being sent. However, if you choose not to accept cookies, you may experience some delay in browsing our website or it will not function properly or may be considerably slower.</p>\r\n<h3>Google Analytics</h3>\r\n<p>We use Google Analytics, an analytics service provided by Google LLC. We use this service to help analyze how users use the Service, with a view to analyzing usage across devices and offering improvements for all users. To learn more about Google Analytics, please visit their <a href=\"https://support.google.com/analytics/answer/6004245#zippy=%2Cour-privacy-policy\">Privacy Policy</a>. To opt-out of this feature by installing the Google Analytics Opt-out Browser Add-on, please click <a href=\"https://tools.google.com/dlpage/gaoptout?hl=en\">here</a>.</p>\r\n<h3>Newsletters</h3>\r\n<p>You can opt out of receiving our marketing emails and/or newsletters by contacting us as described under &ldquo;Contact Us&rdquo; below. We may still send you transactional messages, which include Services-related communications and responses to your questions.</p>\r\n<h3 style=\"text-align: justify;\">Renewal of Policy</h3>\r\n<p style=\"text-align: justify;\">We may periodically update or amend our Privacy Policy in order to adhere to new and existing laws affecting the DPA, including any change or improvement we establish to secure your personal information. Any updates or changes shall not alter how we handle previously collected personal data without obtaining your consent, unless required by law.</p>','<h3>Introduction</h3>\r\n<p>This page states the terms and conditions under which you may use the website, [website name]. [website name] is operated by an Individual Trying to help Real Estate Brokers and Salespersons to increase their presence on the internet</p>\r\n<p><strong>Definitions</strong></p>\r\n<ul>\r\n<li>The terms \"you\" and \"user\" as used herein refer to all individuals and/or entities accessing [website name]</li>\r\n<li>The term \"Website\" as used herein refers to [domain name]</li>\r\n</ul>\r\n<p><strong>General</strong></p>\r\n<p>By using the Website, you are indicating your acceptance to be bound by these terms and conditions. The Website may revise these terms and conditions at any time by updating this page. You should visit this page periodically to review the terms and conditions, to which you are bound.</p>\r\n<p><strong>Terms of Use</strong></p>\r\n<ul>\r\n<li>Users may not use the Website in order to transmit, distribute, store or destroy material:\r\n<ul>\r\n<li>in violation of any applicable law or regulation;</li>\r\n<li>in a manner that will infringe the copyright, trademark, trade secret or other intellectual property rights of others or violate the privacy, publicity or other personal rights of others;</li>\r\n<li>that is defamatory, obscene, threatening, abusive or hateful.</li>\r\n</ul>\r\n</li>\r\n<li>The following is prohibited with respect to the Website:\r\n<ul>\r\n<li>Using any robot, spider, other automatic device or manual process to monitor or copy any part of the Website;</li>\r\n<li>Using any device, software or routine or the like to interfere or attempt to interfere with the proper working of the Website.</li>\r\n<li>Taking any action that imposes an unreasonable or disproportionately large load on the Website infrastructure;</li>\r\n<li>Copying, reproducing, altering, modifying, creating derivative works, or publicly displaying any content from the Website without the Website`s prior written permission;</li>\r\n<li>Reverse assembling or otherwise attempting to discover any source code relating to the Website or any tool therein, except to the extent that such activity is expressly permitted by applicable law notwithstanding this limitation; and</li>\r\n<li>Attempting to access any area of the Website to which access is not authorized.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p><strong>Copyright and Intellectual Property Rights</strong></p>\r\n<ul>\r\n<li>All content, trademarks and data on this Website, including but not limited to, software, databases, text, graphics, icons, hyperlinks, private information, and designs are the property of or licensed to the Website.</li>\r\n<li>Users of this Website are not granted a licence or any other right including without limitation under Copyright, Trade Mark, Patent or Intellectual Property Rights in/or to the content.</li>\r\n</ul>\r\n<p><strong>Security</strong></p>\r\n<ul>\r\n<li>Users are prohibited from violating or attempting to violate the security of the Website, including, but without limitation:\r\n<ul>\r\n<li>accessing data not intended for such user or logging into a server or account which the user is not authorized to access;</li>\r\n<li>attempting to probe, scan or test the vulnerability of a system or network or to breach security or authentication measures without proper authorization;</li>\r\n<li>attempting to interfere with service to any user, host or network, including, without limitation, via means of submitting a virus to the website, overloading, \"flooding\", \"spamming\", \"mail bombing\" or \"crashing\";</li>\r\n<li>sending unsolicited email, including promotions and/or advertising of products or services;</li>\r\n<li>forging any TCP/IP packet header or any part of the header information in any email or newsgroup posting;</li>\r\n<li>deleting or revising any material posted by any other person or entity;</li>\r\n<li>using any device, software or routine to interfere or attempt to interfere with the proper working of this website or any activity being conducted on this site.</li>\r\n</ul>\r\n</li>\r\n<li>Violations of system or network security may result in civil or criminal liability. The Website will investigate occurrences, which may involve such violations and may involve, and cooperate with, law enforcement authorities in prosecuting users who are involved in such violations.</li>\r\n</ul>\r\n<p><strong>Disclaimer</strong></p>\r\n<ul>\r\n<li>The Website carries property advertisements, news, reviews and other content independently published by third parties on the website. The Website is not involved in the buying, selling or development of the property process and must not be considered to be an agent, buyer and/or a developer with respect to the use of the Website.</li>\r\n<li>The Website shall not be responsible for any user entering into agreements or making decision whatever nature in connection with the posting of property ads, property information, personal owned property information, use of financial calculators and/or the contents thereof and/or any other information obtained on the Website.</li>\r\n<li>Whilst the Website has taken reasonable measures to ensure the integrity of the Website and its contents, no warranty, whether express or implied, is given that the Website will operate error-free or that any files, downloads or applications available via the Website are free of viruses, trojans, bombs, time-locks or any other data, code or harmful mechanisms which has the ability to corrupt or affect the operation of your system.</li>\r\n<li>In no event shall the Website, and/or any third party contributors of material to the Website be liable for any costs, expenses, losses and damages of any nature (whether direct, indirect, punitive, incidental, special or consequential) arising out of or in any way connected with your use of the Website, your inability to use the Website and/or the operational failure of the Website, and whether or not such costs, expenses, losses and damages are based on contract, delict, strict liability or otherwise.</li>\r\n<li>Insofar as the Website contains links to any other internet websites, you acknowledge and agree that the Website does not have control over any such website and the Website shall therefore not be liable in any way for the contents of any such linked website, nor for any costs, expenses, losses or damages of any nature whatsoever arising from your access and/or use of any such website.</li>\r\n</ul>\r\n<p><strong>Severability</strong></p>\r\n<ul>\r\n<li>These Terms &amp; Conditions constitute the entire agreement between the Website and you. Any failure by the Website to exercise or enforce any right or provision of these Terms &amp; Conditions shall in no way constitute a waiver of such right or provision.</li>\r\n<li>In the event that any term or condition is not fully enforceable or valid for any reason, such term(s) or condition(s) shall be severable from the remaining terms and conditions. The remaining terms and conditions shall not be affected by such unenforceability or invalidity and shall remain enforceable and applicable.</li>\r\n</ul>\r\n<p><strong>Applicable Law</strong></p>\r\n<p>This Website is hosted outside of Philippines and controlled, managed in the Philippines, and thus, Philippine law and jurisdiction govern the use or inability to use this Website, or any other matter related to this Website.</p>\r\n<p><strong>Disputes</strong></p>\r\n<p>All disputes in terms of this agreement or relating to the use or inability to use this Website shall be settled by arbitration conducted in English in terms of the rules of the Philippines Republican Act.</p>','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi efficitur condimentum diam, dictum dapibus felis scelerisque sed. Aliquam sed sem eros. Aenean eu dui leo. Vivamus vitae metus orci. Phasellus consequat eu tellus sed imperdiet. Nam eget massa quis enim lacinia porta vitae quis eros. Integer dictum ornare sem efficitur tristique. Quisque sit amet risus massa. In hac habitasse platea dictumst.</p>\r\n<p>Aliquam convallis, nisl vel tempus dictum, dui ex ultricies odio, id accumsan ligula ex at arcu. Aliquam feugiat volutpat orci quis ultricies. Sed faucibus odio diam, sed rhoncus dolor suscipit id. Donec ac odio euismod, porttitor lorem eget, aliquet libero. Donec ac mattis lorem. Fusce tempor est eros, eget consectetur nulla mattis nec. Fusce dignissim ex in tempor interdum. Nullam egestas ac mauris sed auctor. Donec fringilla consectetur interdum. Morbi lacinia sagittis neque. In in leo tincidunt, imperdiet enim facilisis, consectetur nunc. Curabitur tellus dui, blandit et velit maximus, congue sollicitudin augue.</p>','<p>refund policy</p>',1713014679);
/*!40000 ALTER TABLE `mls_settings` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_settings` with 1 row(s)
--

--
-- Table structure for table `mls_threads`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_threads` (
  `thread_id` bigint NOT NULL AUTO_INCREMENT,
  `participants` json DEFAULT NULL COMMENT 'participants account_id in JSON format',
  `created_by` bigint NOT NULL DEFAULT '0' COMMENT 'user_id started the thread',
  `created_at` int unsigned NOT NULL COMMENT 'epoch of time',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT 'Possible value 1 or 0',
  PRIMARY KEY (`thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_threads`
--

LOCK TABLES `mls_threads` WRITE;
/*!40000 ALTER TABLE `mls_threads` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `mls_threads` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_threads` with 0 row(s)
--

--
-- Table structure for table `mls_traffics`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_traffics` (
  `traffic_id` bigint NOT NULL AUTO_INCREMENT,
  `account_id` bigint NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `created_at` int unsigned NOT NULL DEFAULT '0',
  `traffic` text COMMENT 'Possible value\r\n{\r\n    "type": "listing",\r\n    "id": 2,\r\n    "url": ""\r\n}\r\n\r\nJSON Format',
  `user_agent` text COMMENT 'user agent info',
  PRIMARY KEY (`traffic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_traffics`
--

LOCK TABLES `mls_traffics` WRITE;
/*!40000 ALTER TABLE `mls_traffics` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mls_traffics` VALUES (1,0,'adq5fsvn8ci5rkh2rsc4jn7fo2',1712847453,'{\"type\":\"page\",\"name\":\"MLS\",\"id\":0,\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/MLSController@index\\/\",\"source\":\"mls\"}','{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 8.0.0; SM-G955U Build\\/R16NW) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/116.0.0.0 Mobile Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),(2,0,'sf32veos0t2s2hhp5h3qhk8s7h',1712849790,'{\"type\":\"page\",\"name\":\"MLS\",\"id\":0,\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/MLSController@index\\/\",\"source\":\"mls\"}','{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),(3,0,'pkp38n1fsq2lkkk66lrsf8mtr9',1712850603,'{\"type\":\"page\",\"name\":\"MLS\",\"id\":0,\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/MLSController@index\\/\",\"source\":\"mls\"}','{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),(4,0,'002nl14bpimpvvlq9hoaokjr5v',1712925814,'{\"type\":\"page\",\"name\":\"MLS\",\"id\":0,\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/MLSController@index\\/\",\"source\":\"mls\"}','{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),(5,0,'kuaukccaoutualirahjvsam0t5',1712931530,'{\"type\":\"page\",\"name\":\"Buy Property\",\"id\":0,\"url\":\"http:\\/\\/localhost\\/mls\\/website\\/mls\\/website\\/buy\\/\",\"source\":\"website\"}','{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),(6,0,'u6impmpegn7d1ksee09ct8rkcs',1712997180,'{\"type\":\"page\",\"name\":\"MLS\",\"id\":0,\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/MLSController@index\\/\",\"source\":\"mls\"}','{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 8.0.0; SM-G955U Build\\/R16NW) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/116.0.0.0 Mobile Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),(7,1116,'u6impmpegn7d1ksee09ct8rkcs',1712997249,'{\"type\":\"listing\",\"name\":\"Single Attached House (Lily Improved) for Sale in The Hauslands Bataan\",\"id\":\"2\",\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/MLSController@view\\/2\\/\",\"source\":\"mls\"}','{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 8.0.0; SM-G955U Build\\/R16NW) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/116.0.0.0 Mobile Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),(8,0,'0sn2f2ug613lgr22q8jl9abbu1',1712998704,'{\"type\":\"page\",\"name\":\"MLS\",\"id\":0,\"url\":\"http:\\/\\/localhost\\/mls\\/manage\\/MLSController@index\\/\",\"source\":\"mls\"}','{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),(9,0,'vocvj1lef3pl10ivvd3v3vi1mc',1713069487,'{\"type\":\"page\",\"name\":\"Homepage\",\"id\":0,\"url\":\"http:\\/\\/localhost\\/mls\\/Website\\/mls\\/Website\\/\",\"source\":\"Website\"}','{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}'),(10,0,'vocvj1lef3pl10ivvd3v3vi1mc',1713069515,'{\"type\":\"page\",\"name\":\"Buy Property\",\"id\":0,\"url\":\"http:\\/\\/localhost\\/mls\\/Website\\/mls\\/Website\\/buy\\/\",\"source\":\"website\"}','{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}');
/*!40000 ALTER TABLE `mls_traffics` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_traffics` with 10 row(s)
--

--
-- Table structure for table `mls_transactions`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_transactions` (
  `transaction_id` int NOT NULL AUTO_INCREMENT,
  `account_id` bigint NOT NULL,
  `premium_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `premium_description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `duration` int NOT NULL DEFAULT '0',
  `premium_price` float(10,2) DEFAULT NULL,
  `merchant_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `merchant_email` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payer` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci COMMENT 'Possible value\r\n{"name":{"given_name":"John","surname":"Doe"},"email_address":"sb-e4rkm29535071@personal.example.com","payer_id":"WEPB5H32C27UQ","address":{"country_code":"US"}}\r\nJSON Format',
  `payment_transaction_id` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payment_source` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `payment_status` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `transaction_details` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci COMMENT 'a value returned from PAYPAL or other payment gateway API\r\nJSON Format',
  `created_at` int DEFAULT '0' COMMENT 'epoch of time',
  `modified_at` int DEFAULT '0' COMMENT 'epoch of time',
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_transactions`
--

LOCK TABLES `mls_transactions` WRITE;
/*!40000 ALTER TABLE `mls_transactions` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mls_transactions` VALUES (1,1116,'2','[Silver] Includes Bronze Package and +30 listings, +1 Featured ad, +1 Max User',365,24000.00,'9EBSYSV5TA6J2','sb-c47faw29535156@business.example.com','{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}','2TU91134FE4929208','paypal','COMPLETED','{\"id\":\"2TU91134FE4929208\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"24000.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"24000.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"862.60\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"23137.40\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"431.15\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"},\"platform_fee\":{\"currency_code\":\"PHP\",\"value\":\"862.60\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/2TU91134FE4929208\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/2TU91134FE4929208\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/4PF79163BU695990Y\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-04-11T14:41:45Z\",\"update_time\":\"2024-04-11T14:41:45Z\"}',1712846505,0),(2,1118,'1','[Bronze] +15 Listings, +1 Handshake Limit, MLS Access, Chat Access',365,11988.00,'9EBSYSV5TA6J2','sb-c47faw29535156@business.example.com','{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}','7M1022237R626382N','paypal','COMPLETED','{\"id\":\"7M1022237R626382N\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"11988.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"11988.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"443.38\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"11544.62\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"215.13\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"},\"platform_fee\":{\"currency_code\":\"PHP\",\"value\":\"443.38\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/7M1022237R626382N\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/7M1022237R626382N\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/7GN55749R9812544W\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-04-13T08:45:27Z\",\"update_time\":\"2024-04-13T08:45:27Z\"}',1712997927,0),(3,1,'1','[Bronze] +15 Listings, +1 Handshake Limit, MLS Access, Chat Access',365,11988.00,'9EBSYSV5TA6J2','sb-c47faw29535156@business.example.com','{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-e4rkm29535071@personal.example.com\",\"payer_id\":\"WEPB5H32C27UQ\",\"address\":{\"country_code\":\"US\"}}','80668412M2302715C','paypal','COMPLETED','{\"id\":\"80668412M2302715C\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"PHP\",\"value\":\"11988.00\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"PHP\",\"value\":\"11988.00\"},\"paypal_fee\":{\"currency_code\":\"PHP\",\"value\":\"443.38\"},\"net_amount\":{\"currency_code\":\"PHP\",\"value\":\"11544.62\"},\"receivable_amount\":{\"currency_code\":\"USD\",\"value\":\"215.13\"},\"exchange_rate\":{\"source_currency\":\"PHP\",\"target_currency\":\"USD\",\"value\":\"0.018634252623129\"},\"platform_fee\":{\"currency_code\":\"PHP\",\"value\":\"443.38\"}},\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/80668412M2302715C\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/80668412M2302715C\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/checkout\\/orders\\/66213324VV3482415\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2024-04-14T06:01:40Z\",\"update_time\":\"2024-04-14T06:01:40Z\"}',1713074500,0);
/*!40000 ALTER TABLE `mls_transactions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_transactions` with 3 row(s)
--

--
-- Table structure for table `mls_user_login`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_user_login` (
  `user_login_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `session_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'a User session id',
  `status` tinyint NOT NULL DEFAULT '0' COMMENT 'Possible value 1 or 0',
  `login_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'Possible value \r\n{"ip_address":"158.62.33.138","user_agent":"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari\\/537.36 Edg/122.0.0.0","browser_name":"Edge","browser_version":"122.0.0.0","platform":"Windows 10","location":{"continent":"Asia","timezone":"Asia\\/Manila","country_name":"Philippines","country_code":"PH","region_name":"Metro Manila","city":"Quezon City","latitude":"14.6475","longitude":"121.0494","location_accuracy_radius":"10"}}\r\nJSON Format',
  `login_at` int NOT NULL DEFAULT '0' COMMENT 'epoch of time',
  PRIMARY KEY (`user_login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_user_login`
--

LOCK TABLES `mls_user_login` WRITE;
/*!40000 ALTER TABLE `mls_user_login` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mls_user_login` VALUES (1,1,'fdjipik4ajgp6jrd366gp01bh8',0,'{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}',1712842707),(2,19,'rf5tocacsmtnu8il7j9l08rn6a',1,'{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}',1712845148),(3,1,'vnsf8e2qmesc839kaf1qu1vukc',0,'{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}',1712925808),(4,1,'stu8kika8bnq9vlmfpl4nkla0j',0,'{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}',1712926139),(5,23,'bb3tu5ga4abc74np4l8r77nboi',0,'{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 8.0.0; SM-G955U Build\\/R16NW) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/116.0.0.0 Mobile Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Handheld Browser\",\"browser_version\":\"?\",\"platform\":\"Android\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}',1712996803),(6,1,'73req390r9ch1gj61fpo9h3ee0',0,'{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}',1713005901),(7,1,'0nqa4lbcehc3349t09fbv6e2h0',0,'{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}',1713074122),(8,1,'vocvj1lef3pl10ivvd3v3vi1mc',0,'{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}',1713074472),(9,1,'k6madmir2vo4sgu451977fhggh',0,'{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}',1713092423),(10,1,'puceaf4obon6kh4m9lpbltdebj',0,'{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}',1713092771),(11,1,'3utgrrde91kj4qp7jqntv1sk96',1,'{\"ip_address\":\"158.62.36.250\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36 Edg\\/123.0.0.0\",\"browser_name\":\"Edge\",\"browser_version\":\"123.0.0.0\",\"platform\":\"Windows 10\",\"location\":{\"continent\":\"Asia\",\"timezone\":\"Asia\\/Manila\",\"country_name\":\"Philippines\",\"country_code\":\"PH\",\"region_name\":\"Metro Manila\",\"city\":\"Quezon City\",\"latitude\":\"14.6475\",\"longitude\":\"121.0494\",\"location_accuracy_radius\":\"20\"}}',1713105405);
/*!40000 ALTER TABLE `mls_user_login` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_user_login` with 11 row(s)
--

--
-- Table structure for table `mls_users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mls_users` (
  `user_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint unsigned NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'A valid image url',
  `user_level` int unsigned NOT NULL DEFAULT '2' COMMENT 'Possible value 1 or 2, 2 for normal user, 1 for account holder',
  `user_status` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'active' COMMENT 'Possible value inactive or active',
  `permissions` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'Possible value\r\n{"accounts":{"access":true,"add":true,"edit":true,"delete":true},"users":{"access":true,"edit":true,"delete":true},"properties":{"access":true,"edit":true,"delete":true},"premiums":{"access":true,"edit":true,"delete":true,"process_subscription":true},"web_settings":{"access":true},"settings":{"access":true},"articles":{"access":true,"edit":true,"delete":true},"kyc":{"access":true},"page_ads":{"access":true},"leads":{"access":true,"delete":true},"transactions":{"access":true},"reports":{"access":true,"subscriber":true,"monthly_transaction":true}}\r\nJSON Format',
  `two_factor_authentication` tinyint(1) NOT NULL DEFAULT '0',
  `two_factor_authentication_aps` varchar(50) DEFAULT NULL,
  `created_at` int DEFAULT '0' COMMENT 'epoch of time',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mls_users`
--

LOCK TABLES `mls_users` WRITE;
/*!40000 ALTER TABLE `mls_users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mls_users` VALUES (1,1,'9aa126e302832b2c95e29b11263b5e9f','eman00x2xx@gmail.com','Eman Olivas','http://cdn.mls/images/accounts/51121767665307886810120324132780464665364144552692_4c8db409820f58a6bedde1e1eaa66d4e.jpg',1,'active','{\"accounts\":{\"access\":true,\"add\":true,\"edit\":true,\"delete\":true},\"users\":{\"access\":true,\"edit\":true,\"delete\":true},\"properties\":{\"access\":true,\"edit\":true,\"delete\":true},\"premiums\":{\"access\":true,\"edit\":true,\"delete\":true,\"process_subscription\":true},\"web_settings\":{\"access\":true},\"settings\":{\"access\":true},\"articles\":{\"access\":true,\"edit\":true,\"delete\":true},\"kyc\":{\"access\":true},\"page_ads\":{\"access\":true},\"leads\":{\"access\":true,\"delete\":true},\"transactions\":{\"access\":true},\"reports\":{\"access\":true,\"subscriber\":true,\"monthly_transaction\":true}}',0,'',1697967624),(2,1,'fb0fd131cffe9a9fa9f50d98860ed581','test@test.com','Mayette Olivas','http://cdn.mls/images/users/75878193501632083732711588635642117156061029220469_9cffc3eec6fd1514c2f4bd06dc87308a.jpg',2,'active','{\"accounts\":{\"access\":true,\"edit\":true,\"delete\":true},\"users\":{\"access\":true,\"edit\":true,\"delete\":true},\"properties\":{\"access\":true,\"edit\":true,\"delete\":true},\"premiums\":{\"access\":true,\"edit\":true,\"delete\":true},\"web_settings\":{\"access\":true,\"edit\":true},\"settings\":{\"access\":true,\"edit\":true}}',0,'',1698589128),(7,13,'25d55ad283aa400af464c76d713c07ad','webadmin@email.com','Web Admin','http://cdn.mls//images/accounts/62431056605513408591884938382327130853331412768908_25b068b08614baf21ff7948e212a68ec.png',1,'active','{\"web_settings\":{\"access\":true,\"edit\":true},\"articles\":{\"access\":true,\"edit\":true,\"delete\":true}}',0,NULL,1708955333),(8,14,'9aa126e302832b2c95e29b11263b5e9f','customer_service@email.com','Customer Service','http://cdn.mls//images/accounts/39458210912031056194403473478696932053484928515886_93bdc4f8d9d2671146f22a2827041f01.webp',1,'active','{\"accounts\":{\"access\":true},\"users\":{\"access\":true,\"delete\":true},\"properties\":{\"access\":true,\"delete\":true},\"premiums\":{\"process_subscription\":true},\"transactions\":{\"access\":true},\"kyc\":{\"access\":true}}',0,NULL,1708955333),(19,1116,'9aa126e302832b2c95e29b11263b5e9f','eman.olivas@gmail.com','Eman Olivas','http://localhost/mls/cdn//images/accounts/20762307759459331518404004928518478531494056929542_3102e1f908149aa680c5818e271a6b1d.jpg',1,'active','{\"accounts\":{\"access\":true},\"users\":{\"access\":true,\"delete\":true},\"leads\":{\"access\":true,\"delete\":true},\"properties\":{\"access\":true,\"delete\":true},\"premiums\":{\"process_subscription\":true},\"transactions\":{\"access\":true},\"kyc\":{\"access\":true}}',0,NULL,1712844126),(21,1116,'9aa126e302832b2c95e29b11263b5e9f','clyde@gmail.com','Clyde Olivas',NULL,2,'active','{\"accounts\":{\"access\":\"true\"},\"users\":{\"access\":\"true\",\"delete\":\"true\"},\"leads\":{\"access\":\"true\",\"delete\":\"true\"},\"properties\":{\"access\":\"true\",\"delete\":\"true\"},\"kyc\":{\"access\":\"true\"},\"premiums\":{\"process_subscription\":\"true\"},\"transactions\":{\"access\":\"true\"}}',0,NULL,1712847393),(23,1118,'9aa126e302832b2c95e29b11263b5e9f','eman@gmail.com','Emanex Olivas',NULL,1,'active','{\"accounts\":{\"access\":true},\"users\":{\"access\":true,\"delete\":true},\"leads\":{\"access\":true,\"delete\":true},\"properties\":{\"access\":true,\"delete\":true},\"kyc\":{\"access\":true},\"premiums\":{\"process_subscription\":true},\"transactions\":{\"access\":true}}',0,NULL,1712996070);
/*!40000 ALTER TABLE `mls_users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mls_users` with 7 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET AUTOCOMMIT=@OLD_AUTOCOMMIT */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Mon, 15 Apr 2024 00:36:55 +0800
