-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2020 at 08:49 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `sugarrecord`
--

CREATE TABLE `sugarrecord` (
  `uid` varchar(25) NOT NULL,
  `dateofrecord` date NOT NULL,
  `timerecord` time NOT NULL,
  `sugartime` varchar(15) NOT NULL,
  `sugarresult` float NOT NULL DEFAULT 0,
  `medintake` varchar(40) NOT NULL,
  `urineresult` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sugarrecord`
--

INSERT INTO `sugarrecord` (`uid`, `dateofrecord`, `timerecord`, `sugartime`, `sugarresult`, `medintake`, `urineresult`) VALUES
('Testing', '2020-08-02', '13:30:45', 'fasting', 0, '', 0),
('Testing', '2020-08-03', '13:30:50', 'fasting', 90, '', 0),
('Testing', '2020-08-04', '13:31:00', 'before meal', 91, '', 0),
('Testing', '2020-08-04', '13:31:15', 'after meal', 99, 'nil nope', 0.7);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
