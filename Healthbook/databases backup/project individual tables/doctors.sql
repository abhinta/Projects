-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2020 at 08:48 PM
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
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `uid` varchar(25) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `dname` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `ppic` varchar(66) NOT NULL,
  `qual` varchar(10) NOT NULL,
  `spl` varchar(50) NOT NULL,
  `studied` varchar(30) NOT NULL,
  `hospital` varchar(40) NOT NULL,
  `exp` varchar(3) NOT NULL,
  `address` varchar(60) NOT NULL,
  `state` varchar(25) NOT NULL,
  `city` varchar(30) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `website` varchar(60) NOT NULL,
  `cpic` varchar(66) NOT NULL,
  `info` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`uid`, `contact`, `dname`, `email`, `ppic`, `qual`, `spl`, `studied`, `hospital`, `exp`, `address`, `state`, `city`, `pincode`, `website`, `cpic`, `info`) VALUES
('Doe', '9876543210', 'Doe', '', 'face (2).jfif', 'mch', 'Dermatology', 'sample', 'sample', '12', 'sample', 'Chandigarh', 'Chandigarh', '160011', '', 'certi (3).jpg', ''),
('Foe', '9876543210', 'Foe', '', 'face (1).jfif', 'ms', 'Cardiology - Non Interventional', 'sample name', 'sample name', '12', 'Sample address', 'Chandigarh', 'Chandigarh', '160010', '', 'certi (2).jpg', ''),
('Joe', '9876543210', 'Joe', '', 'face (4).jfif', 'bds', 'Anaesthesia', 'sample name', 'sample name', '2', 'sample address', 'Delhi', 'Delhi', '110002', '', 'certi (1).jpg', ''),
('Koe', '9876543210', 'Koe', 'Koemoe@gmail.com', 'face (3).jfif', 'mds', 'Centre For Spinal Diseases', 'sample', 'sample', '11', 'smaple', 'Punjab', 'Bathinda', '151002', '', 'certi (6).jpg', ''),
('Moe', '9876543210', 'Moe', '', 'face (5).jpeg', 'mbbs', 'Centre For Spinal Diseases', 'sample', 'sample', '2', 'sample', 'Punjab', 'Bathinda', '151001', '', 'certi (5).jpg', ''),
('Woe', '9876543210', 'Woe', '', 'face (6).png', 'dnb', 'Clinical Haematology And BMT', 'sample', 'sample', '12', 'sample', 'Delhi', 'Delhi', '110001', '', 'certi (4).jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
