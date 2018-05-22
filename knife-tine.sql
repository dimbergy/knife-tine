-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2018 at 09:50 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knife-tine`
--
CREATE DATABASE IF NOT EXISTS `knife-tine` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `knife-tine`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_reservations`
--

DROP TABLE IF EXISTS `admin_reservations`;
CREATE TABLE IF NOT EXISTS `admin_reservations` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` tinyint(11) NOT NULL,
  `customer_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_mobile` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `reservation_id` (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_reservations`
--

INSERT INTO `admin_reservations` (`id`, `reservation_id`, `customer_name`, `customer_email`, `customer_mobile`, `comments`) VALUES
(1, 55, 'Λαμπρινή Μανιούδη', 'manioudi@hotmail.com', '6944789123', 'Κράτηση από Δημήτρη Βέργαδο'),
(2, 56, 'Αλίνα Υδραίου', 'aydraiou@gmail.com', '6945741369', 'Η κράτηση έγινε από τον Δημήτρη Βέργαδο');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

DROP TABLE IF EXISTS `days`;
CREATE TABLE IF NOT EXISTS `days` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `day_name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `day_name`) VALUES
(1, 'Δευτέρα'),
(2, 'Τρίτη'),
(3, 'Τετάρτη'),
(4, 'Πέμπτη'),
(5, 'Παρασκευή'),
(6, 'Σάββατο'),
(7, 'Κυριακή');

-- --------------------------------------------------------

--
-- Table structure for table `hours`
--

DROP TABLE IF EXISTS `hours`;
CREATE TABLE IF NOT EXISTS `hours` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `opened_at` time NOT NULL,
  `closed_at` time NOT NULL,
  `day_id` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `day_id` (`day_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hours`
--

INSERT INTO `hours` (`id`, `opened_at`, `closed_at`, `day_id`) VALUES
(2, '20:00:00', '01:00:00', 3),
(3, '20:00:00', '01:00:00', 4),
(4, '20:00:00', '02:00:00', 5),
(5, '12:00:00', '03:00:00', 6),
(6, '12:00:00', '01:00:00', 7),
(8, '20:00:00', '01:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `table_id` tinyint(1) NOT NULL,
  `reserved_by` tinyint(11) NOT NULL,
  `reserved_for` date NOT NULL,
  `reserved_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `table_id` (`table_id`),
  KEY `reserved_by` (`reserved_by`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `table_id`, `reserved_by`, `reserved_for`, `reserved_at`) VALUES
(41, 1, 2, '2018-05-24', '2018-05-12 20:13:49'),
(42, 11, 5, '2018-05-18', '2018-05-12 20:16:39'),
(43, 11, 2, '2018-05-19', '2018-05-13 17:26:31'),
(44, 12, 2, '2018-05-27', '2018-05-13 17:28:04'),
(47, 13, 2, '2018-06-01', '2018-05-14 17:20:30'),
(49, 1, 2, '2018-05-26', '2018-05-14 17:23:05'),
(50, 3, 2, '2018-06-02', '2018-05-14 17:59:53'),
(51, 9, 2, '2018-06-02', '2018-05-14 17:59:53'),
(52, 8, 5, '2018-05-15', '2018-05-15 04:34:29'),
(53, 9, 5, '2018-05-15', '2018-05-15 04:34:29'),
(54, 3, 2, '2018-05-15', '2018-05-15 04:37:25'),
(55, 15, 1, '2018-05-27', '2018-05-15 11:42:05'),
(56, 1, 1, '2018-06-02', '2018-05-15 11:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `people` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `people`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `mobile`, `admin`, `created_at`) VALUES
(1, 'Dimitrios', 'Vergados', 'dimbergy@gmail.com', '2dea550bc0a5b435dad1ecc9ed0176f4', '6945370529', 1, '2018-05-06 09:15:22'),
(2, 'Katerina', 'Chalkou', 'aechalkou@hotmail.com', '1cec8f10b26583448ea46b36cd26c742', '', 0, '2018-05-06 09:20:07'),
(3, 'Vana', 'Stergiou', 'vana.stergiou@gmail.com', '93ef81a1cdd8f0833c9190edab3d11fa', '', 0, '2018-05-06 09:24:25'),
(4, 'Filippos', 'Karamanlis', 'fkaramanlis@militos.org', 'a2135c6a14c8ffbe3166a6f551905e45', '', 1, '2018-05-06 10:16:32'),
(5, 'Stratos', 'Sopilis', 'stratos.sopilis@gmail.com', '1e8c5ca63dd2f107ea33f1fe58aa7c1b', '', 0, '2018-05-06 10:21:21'),
(6, 'Haris', 'Koboholis', 'haris.koboholis@yahoo.com', '4bd2cef91742be0c9bb4419ff69a6ea2', '', 0, '2018-05-06 10:45:21'),
(7, 'Sofia', 'Pissia', 'spissia@knowl.gr', '1bb4df22313e2078d5567c6fc8e0a0d1', '', 0, '2018-05-06 10:55:00'),
(8, 'Eleni', 'Michalopoulou', 'elmiha@gmail.com', '065a38ad6bd6fce130bb26b11c5a0a46', '6937670623', 1, '2018-05-06 17:16:15'),
(9, 'Αλίνα', 'Υδραίου', 'alina@knowl.gr', '914a23f72f590809d3fe431573ecb71f', '6945781245', 1, '2018-05-06 20:05:28'),
(10, 'Olga', 'Stavropoulou', 'stavropoulou@militos.gr', '0835a53f04993bc80ad7f657b806a876', '6978123456', 1, '2018-05-06 20:07:30'),
(11, 'Elisabeth', 'Aggelakopoulou', 'aggelakopoulou@militos.org', 'd962f507535d9f005b430174176b1afb', '', 0, '2018-05-06 20:14:25'),
(12, 'Yioula', 'Papatsori', 'papatsori@knowl.gr', '5d9baf3c7faa3e60be8c3dfa31cec5f8', '', 1, '2018-05-06 20:16:09'),
(13, 'Κώστας', 'Αδάμος', 'adamos@diplareios.gr', '998469d20fa61bcfcc4d388445df20b4', '', 1, '2018-05-06 20:21:15'),
(14, 'Antigoni', 'Kourakou', 'akourakou@gmail.com', 'd0ef9e2b4796971d16289a0dd103c9ea', '', 0, '2018-05-07 04:12:32'),
(15, 'Petroula', 'Staikou', 'theater@totrenostorouf.gr', 'a23b6bf8504023f0ed1a84138faf5067', '', 1, '2018-05-07 04:21:06'),
(16, 'Maria', 'Skania', 'mskania@ymail.com', '8b08e8e2608c067b121741f949eb441d', '', 1, '2018-05-07 04:24:13'),
(17, 'Tatiana', 'Ligari', 'tligari@icloud.com', 'a45d336d83537b2b30ec3a8ee0451462', '', 1, '2018-05-07 04:27:58'),
(18, 'Kiriakos', 'Ligkas', 'kligas@militos.org', '10f3d291c822a908a266d721f31e6ff7', '', 1, '2018-05-07 04:32:56'),
(19, 'Nick', 'Dimou', 'ndimou@gmail.com', '358a5fcb524cddac15b12a724c2727c9', '', 1, '2018-05-07 04:45:57'),
(20, 'Katia', 'Gerou', 'kgerou@gmail.com', 'caab48a39cd9ee1c315afa6677153797', '', 1, '2018-05-07 04:49:44'),
(21, 'Giannis', 'Salamouris', 'salamouris@knowl.gr', 'aa6caf2a9b52999a82fabc5c9a7ab51d', '', 0, '2018-05-07 04:57:28'),
(22, 'Thomas', 'Georgiou', 'georgiou@yahoo.gr', 'a9877cc3635921a7ecc1179402464dbc', '6972147258', 1, '2018-05-07 05:00:30'),
(23, 'Labrini', 'Manioudi', 'l.manioudi@knowl.gr', '6dda894c08baf5e17f14b643b7a078e5', '6944789123', 1, '2018-05-08 07:28:59'),
(24, 'Christina', 'Frentzou', 'frentzou@militos.org', '5b4493083e6ffbc9ed1c8ebab045c0df', '', 0, '2018-05-08 07:57:45'),
(25, 'Katerina', 'Frentzos', 'kfrentzos@ymail.com', 'bb16ea1d30974df2d731a6314f3d7e24', '', 1, '2018-05-08 08:02:21');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_reservations`
--
ALTER TABLE `admin_reservations`
  ADD CONSTRAINT `admin_reservations_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hours`
--
ALTER TABLE `hours`
  ADD CONSTRAINT `hours_ibfk_1` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`reserved_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
