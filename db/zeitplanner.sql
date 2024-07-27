-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306:3306
-- Generation Time: Jul 27, 2024 at 07:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zeitplanner`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240706155748', '2024-07-06 15:58:00', 14),
('DoctrineMigrations\\Version20240708080649', '2024-07-08 08:06:59', 88),
('DoctrineMigrations\\Version20240709054427', '2024-07-09 05:44:38', 58),
('DoctrineMigrations\\Version20240713062828', '2024-07-13 06:28:39', 55),
('DoctrineMigrations\\Version20240714050100', '2024-07-14 05:01:40', 13);

-- --------------------------------------------------------

--
-- Table structure for table `event_details`
--

CREATE TABLE `event_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `email_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_details`
--

INSERT INTO `event_details` (`id`, `name`, `location`, `start_date`, `end_date`, `email_id`) VALUES
(36, 'testhukujb', 'Google Meet', '2024-11-14 21:42:00', '2024-12-27 18:40:00', 0),
(39, 'graphics scd fdc', 'Zoom', '2024-07-29 16:06:00', '2024-10-24 16:06:00', 0),
(43, 'xc', 'Google Meet', '2024-07-18 17:32:00', '2024-07-18 19:30:00', 0),
(48, 'test aj', 'Zoom', '2024-07-14 19:10:00', '2024-07-14 19:10:00', 0),
(49, 'test2', 'Zoom', '2024-07-13 04:32:00', '2024-07-13 04:32:00', 0),
(50, 'paper', 'Zoom', '2024-07-13 20:25:00', '2024-07-14 08:25:00', 0),
(52, 'test3', 'Google Meet', '2024-07-13 17:14:00', '2024-07-13 17:14:00', 0),
(53, 'java345', 'Zoom', '2024-07-14 18:15:00', '2024-07-14 17:15:00', 0),
(54, 'test java', 'Zoom', '2024-07-14 17:22:00', '2024-07-14 23:22:00', 0),
(55, 'paper hjghcgcgh', 'Zoom', '2024-07-14 17:31:00', '2024-07-14 17:31:00', 0),
(56, 'testtestetestetetsts', 'Google Meet', '2024-07-17 18:17:00', '2024-07-18 18:17:00', 0),
(57, 'vineetvineetvineet', 'Zoom', '2024-07-24 18:17:00', '2024-07-25 18:17:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_request`
--

CREATE TABLE `meeting_request` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `choose_date_time` datetime NOT NULL,
  `purpose` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_request`
--

INSERT INTO `meeting_request` (`id`, `fname`, `lname`, `email`, `choose_date_time`, `purpose`) VALUES
(1, 'vineet', 'kankerwal', 'vineetkankerwal@gmail.com', '2024-07-15 10:45:00', 'due to discussion of internship'),
(2, 'chirag', 'kankerwal', 'chiragkankerwal@gmail.com', '2024-07-16 17:46:00', 'Due to project'),
(3, 'boby', 'sain', 'bobySain@gmail.com', '2024-07-17 17:00:00', 'Due to project i want a question'),
(4, 'mehak', 'sja', 'mehak@gajs.com', '2024-07-05 17:07:00', 'asad'),
(5, 'mehak', 'sja', 'mehak@gajs.com', '2024-07-05 17:07:00', 'asad'),
(6, 'vineet', 'axscds', 'axsedSX@sd.xfvd', '2024-07-15 09:33:00', 'adesA'),
(7, 'vineet', 'kankerwal', 'vineetkankerwal@gmail.com', '2024-07-16 12:16:00', 'scd');

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_register`
--

CREATE TABLE `user_register` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `name` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_register`
--

INSERT INTO `user_register` (`id`, `email`, `roles`, `password`, `name`) VALUES
(42, 'chirag@example.com', '[]', '$2y$13$DJRdQfWBK5fpuFWzCCXIS.//BuVFL8gMNd1QoL6NtUZlo0fErJSmm', 'chirag'),
(44, 'kankerwalvineet2003@gmail.com', '[]', '$2y$13$b6rgs/mQkNH2jIdmtxbBI.e15WVPsSvRbe1l8qOo5ZNsExGK92D7m', 'vineet'),
(74, 'jkasdds@anshd.cd', '[]', '$2y$13$5a8MFfSTe70v2hM0fGEwwuUrLHejhMIVKu/AAQCz/KAMy9PuCfR8K', 'vineet'),
(75, 'kankerwa2003@gmail.com', '[]', '$2y$13$DN0iSIq/lnbfgx9WIyUw..49i3JEF.eKos1MCyroNz4iVlOYn1UfS', '_sdjjca');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `event_details`
--
ALTER TABLE `event_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_request`
--
ALTER TABLE `meeting_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_details`
--
ALTER TABLE `event_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `meeting_request`
--
ALTER TABLE `meeting_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_register`
--
ALTER TABLE `user_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
