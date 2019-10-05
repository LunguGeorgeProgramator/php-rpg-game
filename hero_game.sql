-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 05, 2019 at 07:24 AM
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
-- Table structure for table `hero`
--

DROP TABLE IF EXISTS `hero`;
CREATE TABLE IF NOT EXISTS `hero` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `experience` float NOT NULL,
  `name` varchar(255) NOT NULL,
  `health` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `defence` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `luck` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hero`
--

INSERT INTO `hero` (`id`, `level`, `experience`, `name`, `health`, `strength`, `defence`, `speed`, `luck`) VALUES
(1, 5, 1100.4, 'Orderus', 70, 70, 45, 40, 10);

-- --------------------------------------------------------

--
-- Table structure for table `monsters`
--

DROP TABLE IF EXISTS `monsters`;
CREATE TABLE IF NOT EXISTS `monsters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `experience` float NOT NULL,
  `name` varchar(255) NOT NULL,
  `health` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `defence` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `luck` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monsters`
--

INSERT INTO `monsters` (`id`, `level`, `experience`, `name`, `health`, `strength`, `defence`, `speed`, `luck`) VALUES
(1, 7, 200.4, 'Wild dog', 60, 60, 40, 40, 25),
(2, 8, 500.1, 'Wild boar\r\n', 65, 60, 45, 40, 25);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
