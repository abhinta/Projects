-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2020 at 01:40 PM
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
-- Database: `genesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `rollno` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `branch` varchar(5) NOT NULL,
  `per` float DEFAULT 0,
  `mobile` varchar(12) NOT NULL,
  `doa` date NOT NULL,
  `dor` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`rollno`, `name`, `gender`, `branch`, `per`, `mobile`, `doa`, `dor`) VALUES
(101, 'Aman', 'Male', 'cse', 99, '9090909090', '2020-06-24', '2020-06-24'),
(102, 'Raman', NULL, '', 98, '', '2020-06-24', '2020-06-24'),
(103, 'chaman', 'male', 'cse', 100, '9090909090', '2020-06-27', '0000-00-00'),
(104, 'raman', 'male', 'cse', NULL, '9090909090', '2020-06-24', '2020-06-29'),
(105, 'tman', 'femal', 'cse', NULL, '', '2020-06-24', '2020-07-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`rollno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
