-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 12, 2022 at 02:35 PM
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
-- Database: `users_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(55) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','client') DEFAULT 'client',
  `last_login` timestamp NULL DEFAULT NULL,
  `password2` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `first_name`, `last_name`, `email`, `mobile`, `status`, `created_on`, `password`, `role`, `last_login`, `password2`) VALUES
(5, 'Saad Miari', NULL, 'saad.miari@gmail.com', '76776417', 1, '2022-01-10 23:49:44', NULL, 'client', NULL, NULL),
(6, 'Rami', 'S Miari', 'ramimiari1985@gmail.com', '767764171', 1, '2022-01-10 23:50:03', '$2a$10$hcGnyUt0EvZgV6/ESJbx9OIk.TP2ZwDAqg8IizFl/RSBtchDBUR4C', 'admin', '2022-01-11 13:00:06', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'Aya Awad', NULL, 'aya@gmail.com', '78722884', 1, '2022-01-10 23:51:09', NULL, 'client', NULL, 'e10adc3949ba59abbe56e057f20f883e'),
(11, 'mazen', 'Issa', 'mazen@gmail.com', '76776417', 1, NULL, '$2a$10$MNW1EpKvlNuKl/0i3sJHl.zoWv9eSJTObYdI8Ff4znMZkRSMh62n.', 'client', NULL, NULL),
(10, 'Abed', 'Mady', 'abed@gmail.com', '01767764', 1, NULL, '$2a$10$A6YvsbaKlaMiHap7km4WMeISiS0UXaAPR7ywm39uvJ/g5TcsAZTGi', 'client', NULL, NULL),
(12, 'Hassan', 'F', 'hassan@gmail.com', '76776417', 1, NULL, '$2a$10$PF3e0SZPDf89x6jqyuqkHuwrQJyOGmjiDCL52/aygHIZhWHBa7tn6', 'client', '2022-01-11 22:18:17', NULL),
(13, 'jack', 'master', 'jack@gmail.com', '76776417', 1, '2022-01-11 13:33:44', NULL, 'client', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
