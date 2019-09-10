-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2019 at 09:13 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `UTasksDAT`
--

-- --------------------------------------------------------

--
-- Table structure for table `label1`
--

CREATE TABLE IF NOT EXISTS `label1` (
  `label_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `color` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `label1`
--

INSERT INTO `label1` (`label_id`, `name`, `color`) VALUES
(1, 'Inbox ðŸ“š', 'GREEN'),
(2, 'Todo ðŸ’»', 'RED');

-- --------------------------------------------------------

--
-- Table structure for table `tasks1`
--

CREATE TABLE IF NOT EXISTS `tasks1` (
  `id` int(5) NOT NULL,
  `user` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `dateon` datetime NOT NULL,
  `lastdate` datetime NOT NULL,
  `label` int(10) NOT NULL,
  `location` varchar(32) NOT NULL,
  `people` text NOT NULL,
  `notification` int(1) NOT NULL,
  `favorite` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks1`
--

INSERT INTO `tasks1` (`id`, `user`, `title`, `description`, `dateon`, `lastdate`, `label`, `location`, `people`, `notification`, `favorite`) VALUES
(1, 'Test Gebruiker', 'Informatica Eindproject', 'Bij dit project wil ik een soort van planner software maken (zoals Trello, maar dan met tags in plaats van lijsten), waarbij je in je eigen account kan inloggen en nieuwe items kan toevoegen. Deze items zijn activiteiten, waar je allerlei tags aan kan zetten. Deze bestaan bijvoorbeeld uit:\r\nDatum en tijd (start en eind), zodat je weet wanneer je de activiteit moet doen.\r\n- Label, zodat je dezelfde activiteiten onder 1 categorie kan zetten.\r\n- Beschrijving, zodat je meer informatie aan een activiteit kan toevoegen.\r\n- Locatie, zodat je erbij kan zetten waar je de activiteit gaat doen.\r\n- Personen, die bij je activiteit aanwezig zijn.\r\n- Notificatie, bepaal of je wilt dat je activiteit bij het tabblad ‘notificaties’ aanwezig is.\r\n\r\nOp de homepagina zie je alle actieve activiteiten (die nog niet afgerond zijn) en alle gearchiveerde activiteiten (alle activiteiten, die al zijn afgerond, maar niet verwijderd). Daarnaast heb je overal de optie om vanuit het zijmenu een nieuwe activiteit aan te maken en kan je de activiteit aanpassen. In de instellingen kan je je wachtwoord aanpassen en je accountinformatie zien.\r\n', '2019-09-10 12:48:51', '2020-03-21 23:02:39', 2, 'School (KKC)', 'Ik, Ik en nog eens ik', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `label1`
--
ALTER TABLE `label1`
  ADD PRIMARY KEY (`label_id`);

--
-- Indexes for table `tasks1`
--
ALTER TABLE `tasks1`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
