-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 22, 2018 at 02:02 PM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CBE5A3315E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `author`, `pages`, `dateCreated`, `price`) VALUES
(1, 'Harry Potter and Chamber of secrets', 'J.K.Rowling', 255, '2018-07-01 22:54:26', '10.99'),
(2, 'Harry Potter and Philosophers stone', 'J.K.Rowling', 330, '2018-09-01 21:54:26', '1.00'),
(3, 'Harry Potter and Goblet of fire', 'J. K. Rowling', 562, '2018-07-28 12:22:26', '1.00'),
(4, 'Harry Potter and Halfblood- prince', 'J.K. Rowling', 380, '2018-06-02 10:13:21', '1.00'),
(5, 'Harry Potter and Deathly Hallows', 'J.K.Rowling', 566, '2017-09-02 12:13:21', '1.00'),
(6, 'Harry Potter and prisoner of Azkaban', 'J.K. Rowling', 350, '2018-09-02 00:13:21', '1.00'),
(7, 'Harry Potter and orden of Phoenix', 'J.K. Rowling', 458, '2018-08-02 06:13:21', '1.00'),
(8, 'Shantaram', 'Gregory D. Roberts', 658, '2018-09-02 00:20:42', '1.00'),
(9, 'The Clean Code', 'Robert Martin', 657, '2018-09-02 00:20:42', '7.69'),
(10, 'Green Mile', 'Stephen King', 689, '2018-09-02 00:20:42', '10.00'),
(11, 'IT', 'Stephen King', 158, '2018-09-02 00:20:42', '1.00'),
(12, 'Three Friends', 'Erich Maria Remarque', 444, '2018-09-02 00:20:42', '8.39'),
(13, 'The Martian', 'Andy Weir', 74, '2018-09-02 00:20:42', '8.36'),
(15, 'Minds of Billy Milligan', 'Daniel Keyes', 300, '2018-09-02 10:14:01', '17.22'),
(16, 'Alice in Wonderland', 'Lewiss Carrol', NULL, '2018-09-02 13:05:33', '25.00'),
(17, 'Agile Software Development', 'Robert. C. Martin', 155, '2018-09-02 13:05:33', '60.00'),
(18, 'qwerty', 'qwerty', 12, '2018-09-22 08:47:10', '25.00');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20180901162237', '2018-09-01 16:23:06'),
('20180901163335', '2018-09-01 16:33:56'),
('20180901195122', '2018-09-01 19:51:47'),
('20180902081803', '2018-09-02 08:21:37'),
('20180902113901', '2018-09-02 11:39:56'),
('20180902130450', '2018-09-02 13:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D34A04AD5E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `dateCreated`) VALUES
(1, 'Minds of Billy Milligan', '17.22', '2018-09-02 11:41:43'),
(2, 'Alice in Wonderland', '25.00', '2018-09-02 11:42:54'),
(3, 'Agile Software Development', '60.00', '2018-09-02 11:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(3, 'jpotalujeva', '$2y$13$1PxEVsrWxOBfp.lNU7X2ZeeEnF8HKjKNeMv0DnMe6iHVg2hWJJjTC', '', '', '', 0, NULL, NULL, NULL, NULL, ''),
(4, 'test', '$2y$13$.Tt5O00Ws.9SsH.IXju5IOe0xvwBS56rv.wylp4giLYRPFzLt47MO', 'test', 'test@test.com', 'test@test.com', 1, NULL, '2018-09-22 10:55:19', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
