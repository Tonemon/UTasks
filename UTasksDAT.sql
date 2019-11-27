-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2019 at 02:17 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `label1`
--

INSERT INTO `label1` (`label_id`, `name`, `color`) VALUES
(1, 'Inbox ðŸ“š', 'GREEN'),
(2, 'LOL ðŸ’»', 'RED'),
(3, 'Archive', 'BLACK'),
(4, 'Betatesting', 'YELLOW');

-- --------------------------------------------------------

--
-- Table structure for table `label2`
--

CREATE TABLE IF NOT EXISTS `label2` (
  `label_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `color` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `label2`
--

INSERT INTO `label2` (`label_id`, `name`, `color`) VALUES
(1, 'Archive ðŸ“š', 'GREEN'),
(2, 'Todo ðŸ’»', 'RED'),
(3, 'Website ðŸ’»', 'BLUE');

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
  `favorite` int(1) NOT NULL,
  `priority` int(1) NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks1`
--

INSERT INTO `tasks1` (`id`, `user`, `title`, `description`, `dateon`, `lastdate`, `label`, `location`, `people`, `notification`, `favorite`, `priority`, `status`) VALUES
(1, 'Admin User', 'Normal Task', 'Normal task with high priority', '2019-11-25 18:08:07', '2019-10-30 05:06:23', 2, 'Home', 'Me', 0, 1, 3, 'ACTIVE'),
(2, 'Admin User', 'Send presentation', 'This is just a test task to check if the last date variables work.', '2019-11-05 11:00:48', '2019-10-02 11:22:10', 3, '', '', 0, 0, 0, 'ARCHIVED');

-- --------------------------------------------------------

--
-- Table structure for table `tasks2`
--

CREATE TABLE IF NOT EXISTS `tasks2` (
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
  `favorite` int(1) NOT NULL,
  `priority` int(1) NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks2`
--

INSERT INTO `tasks2` (`id`, `user`, `title`, `description`, `dateon`, `lastdate`, `label`, `location`, `people`, `notification`, `favorite`, `priority`, `status`) VALUES
(1, 'Normal User', 'Informatica Eindproject', 'Bij dit project wil ik een soort van planner software maken (zoals Trello, maar dan met tags in plaats van lijsten), waarbij je in je eigen account kan inloggen en nieuwe items kan toevoegen. Deze items zijn activiteiten, waar je allerlei tags aan kan zetten. Deze bestaan bijvoorbeeld uit:\r\nDatum en tijd (start en eind), zodat je weet wanneer je de activiteit moet doen.\r\n- Label, zodat je dezelfde activiteiten onder 1 categorie kan zetten.\r\n- Beschrijving, zodat je meer informatie aan een activiteit kan toevoegen.\r\n- Locatie, zodat je erbij kan zetten waar je de activiteit gaat doen.\r\n- Personen, die bij je activiteit aanwezig zijn.\r\n- Notificatie, bepaal of je wilt dat je activiteit bij het tabblad ï¿½notificatiesï¿½ aanwezig is.\r\n\r\nOp de homepagina zie je alle actieve activiteiten (die nog niet afgerond zijn) en alle gearchiveerde activiteiten (alle activiteiten, die al zijn afgerond, maar niet verwijderd). Daarnaast heb je overal de optie om vanuit het zijmenu een nieuwe activiteit aan te maken en kan je de activiteit aanpassen. In de instellingen kan je je wachtwoord aanpassen en je accountinformatie zien.\r\n', '2019-11-27 14:15:01', '2019-10-16 17:53:05', 2, 'School (KKC)', 'Ik, Ik en nog eens ik', 0, 0, 1, 'ARCHIVED'),
(2, 'Normal User', 'Website inlogsysteem laten werken!', '(Voorbeeld tekst) Op dit moment werkt het inlogsysteem maar half en moet er nog veel aan gedaan worden om het volledig te laten werken.', '2019-11-26 14:58:31', '2019-11-26 15:38:10', 2, 'School (KKC)', 'Ik, Ik en nog eens ik', 0, 0, 2, 'ACTIVE'),
(3, 'Normal User', 'Homepagina bericht als ingelogd', '(Voorbeeld tekst) Zorgen dat als je ingelogd bent en je de homepagina bezoekt, hij je een berichtje laat zien van ''yo je bent al ingelogd, gebruik de inlogpagina niet, maar klik hier om meteen naar je userpaneel te gaan''.', '2019-11-26 14:57:24', '2019-12-02 15:31:00', 1, 'School (KKC)', 'Ik, Ik en nog eens ik', 0, 1, 2, 'ACTIVE'),
(4, 'Normal User', 'Deadline in 3 days', '(Voorbeeld) Dit is een task om de deadline kaarten in de header te testen. Als het goed is telt het systeem bij ''deadlines nearing'' deze task ook, omdat het op de datum van testen binnen de 3 dagen radius zit.', '2019-09-24 09:52:51', '2019-09-26 09:55:39', 3, 'School (KKC)', 'Ik, Ik en nog eens ik', 0, 0, 2, 'ACTIVE'),
(5, 'Normal User', 'Deadline passed', '(Voorbeeld) Deze task heeft een datum in het verleden en het systeem telt deze task bij de ''deadlines passed'' kaart.', '2019-09-21 09:52:51', '2019-09-22 09:55:39', 3, 'School (KKC)', 'Ik, Ik en nog eens ik', 0, 0, 2, 'ACTIVE'),
(6, 'Normal User', 'Archived task', '(Voorbeeld) Deze task is gearchiveerd en hoort onder het kopje ''Archived Tasks'' te komen. Daarnaast staat hij ook bij de archived tasks kaart.', '2019-09-21 09:52:51', '2019-09-22 09:55:39', 3, 'School (KKC)', 'Ik, Ik en nog eens ik', 0, 0, 2, 'ARCHIVED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `label1`
--
ALTER TABLE `label1`
  ADD PRIMARY KEY (`label_id`);

--
-- Indexes for table `label2`
--
ALTER TABLE `label2`
  ADD PRIMARY KEY (`label_id`);

--
-- Indexes for table `tasks1`
--
ALTER TABLE `tasks1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks2`
--
ALTER TABLE `tasks2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `label1`
--
ALTER TABLE `label1`
  MODIFY `label_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `label2`
--
ALTER TABLE `label2`
  MODIFY `label_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tasks1`
--
ALTER TABLE `tasks1`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tasks2`
--
ALTER TABLE `tasks2`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
