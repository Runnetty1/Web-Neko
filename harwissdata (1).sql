-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 22, 2019 at 01:00 PM
-- Server version: 10.3.12-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harwissdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountdata`
--

DROP TABLE IF EXISTS `accountdata`;
CREATE TABLE IF NOT EXISTS `accountdata` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) DEFAULT NULL,
  `firstname` varchar(64) DEFAULT NULL,
  `middlename` varchar(64) DEFAULT NULL,
  `surname` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password_hash` varchar(512) DEFAULT NULL,
  `salt` varchar(512) DEFAULT NULL,
  `permission_strength` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accountdata`
--

INSERT INTO `accountdata` (`id`, `username`, `firstname`, `middlename`, `surname`, `email`, `password_hash`, `salt`, `permission_strength`) VALUES
(1, 'Runnetty', 'Mats', '', 'Harwiss', 'mats@harwiss.no', 'a7b773fd72beedca0fcbdad32f9a02ccf9fc097da0556ef4f187d0a492dfd909612583037fafc161813136adf57bc46e8c1607cd9b62a9c3f8bd0cb50cd683c0', '51d971c2bb462eed4f852fd4ff60', 99);

-- --------------------------------------------------------

--
-- Table structure for table `invitecodes`
--

DROP TABLE IF EXISTS `invitecodes`;
CREATE TABLE IF NOT EXISTS `invitecodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ownerid` int(11) DEFAULT NULL,
  `invitecode` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invitecode` (`invitecode`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invitecodes`
--

INSERT INTO `invitecodes` (`id`, `ownerid`, `invitecode`) VALUES
(1, NULL, 'invitecode');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
