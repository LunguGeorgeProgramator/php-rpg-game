-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 06, 2019 at 03:45 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hero_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes_max_min`
--

DROP TABLE IF EXISTS `attributes_max_min`;
CREATE TABLE IF NOT EXISTS `attributes_max_min` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `subject_type` varchar(25) NOT NULL,
  `subject_attribute` varchar(25) NOT NULL,
  `max` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributes_max_min`
--

INSERT INTO `attributes_max_min` (`id`, `subject_id`, `subject_type`, `subject_attribute`, `max`, `min`) VALUES
(1, 1, 'hero', 'health', 70, 100),
(2, 1, 'hero', 'strength', 70, 80),
(6, 1, 'hero', 'defence', 45, 50),
(16, 2, 'monster', 'strength', 60, 90),
(7, 1, 'hero', 'speed', 40, 50),
(8, 1, 'hero', 'luck', 10, 30),
(9, 1, 'monster', 'health', 60, 90),
(10, 1, 'monster', 'strength', 60, 90),
(11, 1, 'monster', 'defence', 40, 60),
(15, 2, 'monster', 'health', 60, 90),
(13, 1, 'monster', 'speed', 40, 60),
(14, 1, 'monster', 'luck', 25, 40),
(17, 2, 'monster', 'defence', 40, 60),
(18, 2, 'monster', 'speed', 40, 60),
(19, 2, 'monster', 'luck', 25, 40);

-- --------------------------------------------------------

--
-- Table structure for table `hero`
--

DROP TABLE IF EXISTS `hero`;
CREATE TABLE IF NOT EXISTS `hero` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `experience` float NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hero`
--

INSERT INTO `hero` (`id`, `level`, `experience`, `name`) VALUES
(1, 5, 1100.4, 'Orderus');

-- --------------------------------------------------------

--
-- Table structure for table `monster`
--

DROP TABLE IF EXISTS `monster`;
CREATE TABLE IF NOT EXISTS `monster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `experience` float NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monster`
--

INSERT INTO `monster` (`id`, `level`, `experience`, `name`) VALUES
(1, 7, 200.4, 'Wild dog'),
(2, 8, 500.1, 'Wild boar\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `subject_type` enum('hero','monster') NOT NULL,
  `skill_type` enum('attack','defence') NOT NULL,
  `name` varchar(100) NOT NULL,
  `skill_chance` float NOT NULL,
  `number_strikes` float NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `subject_id`, `subject_type`, `skill_type`, `name`, `skill_chance`, `number_strikes`, `active`) VALUES
(1, 1, 'hero', 'attack', 'Rapid strike', 10, 2, 1),
(2, 1, 'hero', 'defence', 'Magic shield', 20, 0.5, 1),
(3, 1, 'monster', 'attack', 'Rapid strike', 10, 2, 0),
(4, 1, 'monster', 'defence', 'Magic shield', 20, 0.5, 0),
(5, 1, 'hero', 'attack', 'Rapid strike X3', 5, 3, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
