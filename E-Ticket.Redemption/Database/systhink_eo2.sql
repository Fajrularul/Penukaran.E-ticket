-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 06:51 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `systhink_eo2`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_code` varchar(10) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `event_year` varchar(4) NOT NULL,
  `event_month` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_code`, `event_name`, `event_year`, `event_month`) VALUES
(1, 'BIO2016', 'BCA INDONESIA OPEN 2016', '2016', '5');

-- --------------------------------------------------------

--
-- Table structure for table `gateareas`
--

CREATE TABLE `gateareas` (
  `id` int(11) NOT NULL,
  `gate_area` varchar(15) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gateareas`
--

INSERT INTO `gateareas` (`id`, `gate_area`, `description`) VALUES
(1, 'GA Class 1', 'GA Class 1'),
(2, 'GA Class 2', 'GA Class 2'),
(3, 'GA VIP', 'GA VIP'),
(6, 'On Court Seat', 'On Court Seat');

-- --------------------------------------------------------

--
-- Table structure for table `gates`
--

CREATE TABLE `gates` (
  `id` int(11) NOT NULL,
  `gate_number` varchar(15) NOT NULL,
  `description` text,
  `max_capacity` int(11) NOT NULL,
  `gate_area_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gates`
--

INSERT INTO `gates` (`id`, `gate_number`, `description`, `max_capacity`, `gate_area_id`) VALUES
(1, 'Gate A1', 'Gate A1', 896, 1),
(2, 'Gate B4', 'Gate B4', 1060, 3),
(3, 'Gate A3', 'Gate A3', 556, 1),
(4, 'Gate A4', 'Gate A4', 557, 1),
(5, 'Gate A2', 'Gate A2', 1025, 2),
(6, 'Gate A7', 'Gate A7', 556, 1),
(7, 'Gate A8', 'Gate A8', 557, 1),
(99999999, '-', '-', 0, 0),
(100000000, 'Gate A5', 'Gate A5', 927, 2),
(100000001, 'Gate A6', 'Gate A6', 927, 2),
(100000002, 'Gate A9', 'Gate A9', 1025, 2),
(100000003, 'Gate B5', 'Gate B5', 162, 6);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'operator'),
(3, 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `keyed` varchar(255) NOT NULL,
  `valued` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `keyed`, `valued`) VALUES
(1, 'report_calc', '30');

-- --------------------------------------------------------

--
-- Table structure for table `ticketlogs`
--

CREATE TABLE `ticketlogs` (
  `id` int(11) NOT NULL,
  `ticket_number` varchar(20) NOT NULL,
  `event_code` varchar(10) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `event_year` varchar(4) NOT NULL,
  `event_month` varchar(2) NOT NULL,
  `ticket_type` varchar(15) NOT NULL,
  `gate_area` varchar(15) NOT NULL,
  `gate_number` varchar(15) DEFAULT NULL,
  `registered_buyer` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `event_start` datetime NOT NULL,
  `event_end` datetime NOT NULL,
  `status` varchar(15) NOT NULL,
  `scanned_date_time` datetime NOT NULL,
  `last_scanned` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticketlogs`
--

INSERT INTO `ticketlogs` (`id`, `ticket_number`, `event_code`, `event_name`, `event_year`, `event_month`, `ticket_type`, `gate_area`, `gate_number`, `registered_buyer`, `last_name`, `qty`, `event_start`, `event_end`, `status`, `scanned_date_time`, `last_scanned`) VALUES
(1, '123456', 'BIO2016', 'BCA INDONESIA OPEN 2016', '2016', '5', 'VIP', 'GA Class 1', '1', 'Prakoso', '', 4, '2019-01-19 00:00:00', '2019-01-19 00:00:00', 'in', '2019-01-19 00:25:37', '2019-01-19 00:25:37'),
(2, '20061998', 'BIO2016', 'BCA INDONESIA OPEN 2016', '2016', '5', 'Class 1', 'GA Class 1', '1', 'Alit', '', 2, '2019-01-19 00:00:00', '2019-01-19 00:00:00', 'in', '2019-01-19 01:05:27', '2019-01-19 01:05:27'),
(3, '123465', 'BIO2016', 'BCA INDONESIA OPEN 2016', '2016', '5', 'NOT Found', 'GA Class 1', '1', 'NOT FOUND', '', 0, '2019-01-19 01:43:22', '2019-01-19 01:43:22', 'rejected', '2019-01-19 01:43:22', '2019-01-19 01:43:22'),
(4, '1', 'BIO2016', 'BCA INDONESIA OPEN 2016', '2016', '5', 'NOT Found', 'GA Class 1', '1', 'NOT FOUND', '', 0, '2019-01-19 02:59:41', '2019-01-19 02:59:41', 'rejected', '2019-01-19 02:59:41', '2019-01-19 02:59:41'),
(5, '1231', 'BIO2016', 'BCA INDONESIA OPEN 2016', '2016', '5', 'NOT Found', 'GA Class 1', '1', 'NOT FOUND', '', 0, '2019-01-29 23:37:03', '2019-01-29 23:37:03', 'rejected', '2019-01-29 23:37:03', '2019-01-29 23:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `ticket_number` varchar(20) NOT NULL,
  `ticket_type_id` int(11) NOT NULL,
  `gate_area_id` int(11) NOT NULL,
  `registered_buyer` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'open',
  `scanned_date_time` datetime DEFAULT NULL,
  `event_id` int(11) NOT NULL,
  `event_start` datetime NOT NULL,
  `event_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_number`, `ticket_type_id`, `gate_area_id`, `registered_buyer`, `last_name`, `qty`, `status`, `scanned_date_time`, `event_id`, `event_start`, `event_end`) VALUES
(1, '20061998', 1, 1, 'Alit', 'Yunianto', 2, 'in', '2019-01-19 01:05:27', 1, '2019-01-19 00:00:00', '2019-01-19 00:00:00'),
(2, '123456', 2, 1, 'Prakoso', 'Yunianto', 4, 'in', '2019-01-19 00:25:37', 1, '2019-01-19 00:00:00', '2019-01-19 00:00:00'),
(3, '123123', 2, 1, 'a', 'b', 2, 'open', NULL, 1, '2019-01-19 00:00:00', '2019-01-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tickettypes`
--

CREATE TABLE `tickettypes` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickettypes`
--

INSERT INTO `tickettypes` (`id`, `type`, `description`) VALUES
(1, 'Class 1', 'Class 1'),
(2, 'VIP', 'VIP'),
(3, 'VIP - A', 'VIP - A'),
(4, 'Class 1', 'Class 1'),
(5, 'Class 1 - A', 'Class 1 - A'),
(6, 'Class 2', 'Class 2'),
(7, 'CLASS 2-A', 'CLASS 2-A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `gate_id` int(11) NOT NULL DEFAULT '0',
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `gate_id`, `role`, `created`, `modified`) VALUES
(1, 'root', '$2y$10$hfAxd93zJBBYoDpzN5CL9upIjJxWZIPTP2Zkd4qQ2wi36GxAcwJlq', 99999999, 'god', NULL, NULL),
(2, 'admin', '$2y$10$irfvctW7mcr5/wpYYocWXe3jhCSnaY4OrVEZCplDn7SQArRlwrVgq', 99999999, 'admin', NULL, NULL),
(4, 'owner', '$2y$10$JdO3TiN5JlU5Qj6z3fk6nOfOaoix7kIQKBATemvNgpGX3MpKX1f.i', 99999999, 'owner', NULL, NULL),
(11, 'opt_1', '$2y$10$bkBycR.0GkqggPz1QMDBF.bXa60RqQZ4xlf8ztrgVaBY4K/i8WiP6', 1, 'operator', NULL, NULL),
(12, 'opt_2', '$2y$10$KfOdmpHYQvoVfE6ae65jG.tCzmoKEntwq4YwsxOGk3jp/3qV4vWZ.', 100000000, 'operator', NULL, NULL),
(13, 'opt_3', '$2y$10$7/c1cOc3NHabULwreiaGNOQybSuD9LOXv3zxtFO0YQt1xswyUuNky', 100000001, 'operator', NULL, NULL),
(14, 'opt_4', '$2y$10$Jcttkd9mnmYiKFdKty17lOUgqXf2OJqVFFHb14nhVSSw65ymzlSIW', 100000002, 'operator', NULL, NULL),
(15, 'opt_5', '$2y$10$h0/vE7zCf4bw/RBn.Qh7XOVJolZtQG0HKmSrTUTjMax2nUHaCXP06', 4, 'operator', NULL, NULL),
(16, 'opt_6', '$2y$10$ItnPdxkQUq4U3RLNDVZii.tKwnzMFnDrY1J8gIq4xFER4jinVaDvC', 6, 'operator', NULL, NULL),
(17, 'opt_7', '$2y$10$TsHS.7wjZRh7UEE9BvOUY.5oLi6OMELEhGj4HDkdD7IVrxZTV1tjm', 1, 'operator', NULL, NULL),
(18, 'opt_8', '$2y$10$RxqWTLAoiICpMXLvuM5XU.3VLH0EX0MtOJPH0s7SkGJBube/fLHi2', 1, 'operator', NULL, NULL),
(19, 'opt_9', '$2y$10$5qs3LfSKc3As0px90pnKBeUhDUVoMPBwsNxRd7QGZEOpQMp0p.C2m', 2, 'operator', NULL, NULL),
(20, 'opt_10', '$2y$10$41uFianrMGT1KR8nijlre.ct59TIP5aCrle8BMwzScpEqsLpTnpp.', 100000003, 'operator', NULL, NULL),
(21, 'opt_11', '$2y$10$7SaqX6fyMvFTKTXs8930t.Fpo4VAWc4hMZSUz8EuGZwJH/2PhBYsu', 7, 'operator', NULL, NULL),
(22, 'opt_12', '$2y$10$4Vta9WIzLQS0niqVqJJB0OzNvJJEpoN7vHaxVN84wD/L..8jdmPR.', 4, 'operator', NULL, NULL),
(23, 'opt_13', '$2y$10$Rkh3gGUglLXqhrMhMXeYQuNQf6avHKB9XnP9qxvuYgbhV3DpC0Xxi', 3, 'operator', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateareas`
--
ALTER TABLE `gateareas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gates`
--
ALTER TABLE `gates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketlogs`
--
ALTER TABLE `ticketlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickettypes`
--
ALTER TABLE `tickettypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gateareas`
--
ALTER TABLE `gateareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gates`
--
ALTER TABLE `gates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000004;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticketlogs`
--
ALTER TABLE `ticketlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickettypes`
--
ALTER TABLE `tickettypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
