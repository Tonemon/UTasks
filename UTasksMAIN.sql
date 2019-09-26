-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2019 at 09:58 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `UTasksMAIN`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) NOT NULL,
  `name` varchar(32) NOT NULL,
  `email` varchar(60) NOT NULL,
  `question` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `readby` varchar(32) NOT NULL,
  `askedby` varchar(32) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `name`, `email`, `question`, `message`, `status`, `readby`, `askedby`, `time`) VALUES
(1, 'John Doe', 'johndoe@gmail.com', 'Services', 'Hi, I would like to know more about the two account types and which one will suit me the best. I am thinking about premium for work. Greets, John', 'TO REVIEW', '', 'User', '2019-01-20 08:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `account` varchar(7) NOT NULL,
  `address` varchar(40) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(80) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `accstatus` varchar(8) NOT NULL,
  `username` varchar(20) NOT NULL,
  `status` varchar(7) NOT NULL,
  `waspremium` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `dob`, `account`, `address`, `mobile`, `email`, `password`, `lastlogin`, `accstatus`, `username`, `status`, `waspremium`) VALUES
(1, 'Admin User', 'M', '2001-01-01', 'admin', 'street 5', '000113', 'admin@utasks.me', 'df0b5ab474b0dce72f1ff715260887b7d39b5c72', '2019-09-26 09:58:30', 'ACTIVE', 'admin', 'offline', 1),
(2, 'Normal User', 'M', '2001-01-01', 'normal', 'street 5', '000113', 'normal@utasks.me', 'df0b5ab474b0dce72f1ff715260887b7d39b5c72', '2019-09-26 09:58:15', 'ACTIVE', 'normal', 'offline', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usersclosed`
--

CREATE TABLE IF NOT EXISTS `usersclosed` (
  `id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `username` varchar(20) NOT NULL,
  `acc_type` varchar(7) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `deleted` varchar(10) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersclosed`
--

INSERT INTO `usersclosed` (`id`, `name`, `username`, `acc_type`, `mobile`, `email`, `deleted`, `reason`) VALUES
(31, 'Deleted User', 'deleted', 'normal', '4534346356', 'deleted@deleted.com', 'deleted', '## other ##');

-- --------------------------------------------------------

--
-- Table structure for table `usersnew`
--

CREATE TABLE IF NOT EXISTS `usersnew` (
  `id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `account` varchar(7) NOT NULL,
  `address` varchar(40) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersnew`
--

INSERT INTO `usersnew` (`id`, `name`, `username`, `email`, `gender`, `dob`, `account`, `address`, `mobile`, `password`) VALUES
(1, 'Steven Hall', 'stevenhall', 'stevenhall@mail.com', 'M', '1964-11-04', 'normal', 'Street 5', '312-443-829', 'steven123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `usersclosed`
--
ALTER TABLE `usersclosed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersnew`
--
ALTER TABLE `usersnew`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usersnew`
--
ALTER TABLE `usersnew`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
