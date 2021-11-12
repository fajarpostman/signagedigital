-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2019 at 09:15 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uw_ibk_signage_client`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(190) NOT NULL,
  `value` varchar(190) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'server_url', ''),
(2, 'client_url', ''),
(3, 'device', ''),
(4, 'monitor', ''),
(5, 'timezone', '');

-- --------------------------------------------------------

--
-- Table structure for table `signage_banners`
--

CREATE TABLE `signage_banners` (
  `id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `server_signage_id` int(11) NOT NULL,
  `file` text NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `always_showing` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signage_depositos`
--

CREATE TABLE `signage_depositos` (
  `id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `server_signage_id` int(11) NOT NULL,
  `tenor` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest` varchar(191) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `always_showing` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signage_exchange_rates`
--

CREATE TABLE `signage_exchange_rates` (
  `id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `server_signage_id` int(11) NOT NULL,
  `country` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL DEFAULT 'TT',
  `bank_buy` double(8,2) NOT NULL,
  `bank_sell` double(8,2) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `always_showing` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signage_running_texts`
--

CREATE TABLE `signage_running_texts` (
  `id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `server_signage_id` int(11) NOT NULL,
  `text` varchar(191) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `always_showing` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signage_videos`
--

CREATE TABLE `signage_videos` (
  `id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `server_signage_id` int(11) NOT NULL,
  `file` text NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `always_showing` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signage_banners`
--
ALTER TABLE `signage_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signage_depositos`
--
ALTER TABLE `signage_depositos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signage_exchange_rates`
--
ALTER TABLE `signage_exchange_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signage_running_texts`
--
ALTER TABLE `signage_running_texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signage_videos`
--
ALTER TABLE `signage_videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `signage_banners`
--
ALTER TABLE `signage_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signage_depositos`
--
ALTER TABLE `signage_depositos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signage_exchange_rates`
--
ALTER TABLE `signage_exchange_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signage_running_texts`
--
ALTER TABLE `signage_running_texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signage_videos`
--
ALTER TABLE `signage_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
