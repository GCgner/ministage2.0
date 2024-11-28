-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 08, 2024 at 08:01 PM
-- Server version: 5.7.24
-- PHP Version: 8.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ministage`
--
CREATE DATABASE IF NOT EXISTS `ministage` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ministage`;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `request_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `class` varchar(32) NOT NULL,
  `birthday` date NOT NULL,
  `parent_firstname` varchar(32) NOT NULL,
  `parent_lastname` varchar(32) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `main_teacher` varchar(50) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `slot_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `slot_id` (`slot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `firstname`, `lastname`, `class`, `birthday`, `parent_firstname`, `parent_lastname`, `address`, `phone`, `email`, `main_teacher`, `accepted`, `slot_id`) VALUES
(1, 'test', 'test', 'test', '2000-01-01', 'test', 'test', 'test', '0123456789', 'test@gmail.com', 'test', 0, 2),
(2, 'test', 'test', 'test', '2000-01-01', 'test', 'test', 'test2', '0123456789', 'test@gmail.com', 'test', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

DROP TABLE IF EXISTS `slots`;
CREATE TABLE IF NOT EXISTS `slots` (
  `slot_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `sector` varchar(32) NOT NULL,
  `max_places` tinyint(3) UNSIGNED NOT NULL,
  `count_places` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`slot_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`slot_id`, `date_start`, `date_end`, `sector`, `max_places`, `count_places`, `user_id`) VALUES
(2, '2024-02-15 10:00:00', '2024-02-15 10:30:00', 'Technologie', 5, 0, 4),
(3, '2024-02-23 10:00:00', '2024-02-23 10:30:00', 'test', 5, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `speciality` varchar(32) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `speciality`, `password`, `is_admin`) VALUES
(1, 'default', 'default', 'default@default.com', 'default', 'default', 0),
(2, 'admin', 'admin', 'olivier.doll@stemarie-stvincent.fr', 'admin', '$2y$10$WlRx5IABsiiLz8PHHIl/C.wvT9LzjTmmlTNxW52xL/L2jo853LdsW', 1),
(4, 'Didier', 'Martin', 'm.ferreira@lprs.fr', 'Technologie', '$2y$10$3lbD5uZv1oY2aJDTRYIUqOaAnRn/hyID3E.VWTFOsX2IXwMPGqoZK', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`slot_id`);

--
-- Constraints for table `slots`
--
ALTER TABLE `slots`
  ADD CONSTRAINT `slots_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
