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
-- Table structure for table `slips`
--

CREATE TABLE `slips` (
  `rid` int(11) NOT NULL,
  `patientid` varchar(25) NOT NULL,
  `doctorname` varchar(40) NOT NULL,
  `dovisit` date NOT NULL,
  `city` varchar(30) NOT NULL,
  `hospital` varchar(40) NOT NULL,
  `problem` varchar(60) NOT NULL,
  `nextdov` date NOT NULL,
  `discussion` varchar(70) NOT NULL,
  `slippic` varchar(66) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slips`
--

INSERT INTO `slips` (`rid`, `patientid`, `doctorname`, `dovisit`, `city`, `hospital`, `problem`, `nextdov`, `discussion`, `slippic`) VALUES
(11, 'Testing', 'Doe', '2020-08-02', 'Chandigarh', 'sample', 'sample', '0000-00-00', '', 'receipt (1).jpg'),
(12, 'Testing', 'Foe', '2020-08-03', 'Delhi', 'sample hosp', 'sample prob', '0000-00-00', 'sample discussion', 'receipt (2).jpg'),
(13, 'Testing', 'Moe', '2020-08-11', 'Bathinda', 'sample hos', 'sample prob', '2020-08-13', 'nil nothing', 'receipt (3).jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `slips`
--
ALTER TABLE `slips`
  ADD PRIMARY KEY (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `slips`
--
ALTER TABLE `slips`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
