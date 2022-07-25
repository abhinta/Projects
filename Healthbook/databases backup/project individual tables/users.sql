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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` varchar(25) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `dos` date NOT NULL,
  `category` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `pwd`, `mobile`, `dos`, `category`) VALUES
('Doe', 'Doeop123*', '9876543210', '2020-08-02', 'doctor'),
('Foe', 'Foeop123*', '9876543210', '2020-08-02', 'doctor'),
('Joe', 'Joeop123*', '9876543210', '2020-08-02', 'doctor'),
('Koe', 'Koeop123*', '9876543210', '2020-08-02', 'doctor'),
('Moe', 'Moeop123*', '9876543210', '2020-07-03', 'doctor'),
('Testing', 'Test123*', '9465208070', '2020-08-01', 'patient'),
('Woe', 'Woeop123*', '9876543210', '2020-08-02', 'doctor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
