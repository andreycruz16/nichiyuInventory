-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2017 at 12:22 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_nichiyu_june2017`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_logs`
--

CREATE TABLE `tbl_activity_logs` (
  `activityLog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acitivityType_id` int(11) NOT NULL,
  `activityDetails` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_type`
--

CREATE TABLE `tbl_activity_type` (
  `activityType_id` int(11) NOT NULL,
  `activityType` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_activity_type`
--

INSERT INTO `tbl_activity_type` (`activityType_id`, `activityType`) VALUES
(1, 'SYSTEM ACCESS'),
(2, 'ADD'),
(3, 'UPDATE'),
(4, 'DELETE'),
(5, 'MAINTENANCE'),
(6, 'PAGE ACCESS'),
(7, 'ACCOUNT SETTINGS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `dept_id` int(11) NOT NULL,
  `departmentName` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Nichiyu Asialift Departments';

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`dept_id`, `departmentName`) VALUES
(1, 'Warehouse'),
(2, 'Service'),
(3, 'Accounting');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `partNumber` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `boxNumber` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `minStockCount` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '1 = delete',
  `dept_id` int(11) NOT NULL COMMENT 'item department'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_history`
--

CREATE TABLE `tbl_item_history` (
  `history_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date` datetime NOT NULL,
  `reference_id` int(11) NOT NULL DEFAULT '0',
  `referenceNumber` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `receivingReport` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `transferType` enum('IN','OUT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitCost` decimal(11,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `customerName` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `details` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  `user_id` int(11) NOT NULL,
  `comment` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reference`
--

CREATE TABLE `tbl_reference` (
  `reference_id` int(11) NOT NULL,
  `referenceType` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inOrOut` int(11) NOT NULL COMMENT '1 = IN; 0 = OUT; -1 = BOTH'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_reference`
--

INSERT INTO `tbl_reference` (`reference_id`, `referenceType`, `inOrOut`) VALUES
(0, 'N/A', 9999),
(1, 'Purchase Order', 1),
(2, 'Transfer Ticket', 0),
(3, 'Pick-up Order', 1),
(4, 'Invoice', 0),
(5, 'Delivery Receipt', 0),
(7, 'Physical Count', 1),
(9, 'Other', -1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `userType_id` int(11) NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstName` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactNumber` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `displayPicture` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `userType_id`, `username`, `password`, `firstName`, `lastName`, `contactNumber`, `displayPicture`) VALUES
(1, 1, 'ADMIN', '81dc9bdb52d04dc20036dbd8313ed055', 'N/A', 'N/A', 'N/A', 'default.png'),
(2, 3, 'SERVICE', '81dc9bdb52d04dc20036dbd8313ed055', 'JAJA', 'REYES', 'N/A', 'default.png'),
(4, 4, 'ACCOUNTING', '81dc9bdb52d04dc20036dbd8313ed055', 'N/A', 'N/A', 'N/A', 'default.png'),
(5, 5, 'GUEST', '81dc9bdb52d04dc20036dbd8313ed055', 'N/A', 'N/A', 'N/A', 'default.png'),
(6, 2, 'WAREHOUSE', '81dc9bdb52d04dc20036dbd8313ed055', 'N/A', 'N/A', 'N/A', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE `tbl_user_type` (
  `userType_id` int(11) NOT NULL,
  `userType` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`userType_id`, `userType`) VALUES
(1, 'ADMINISTRATOR'),
(2, 'WAREHOUSE USER'),
(3, 'SERVICE USER'),
(4, 'ACCOUNTING USER'),
(5, 'GUEST');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_activity_logs`
--
ALTER TABLE `tbl_activity_logs`
  ADD PRIMARY KEY (`activityLog_id`);

--
-- Indexes for table `tbl_activity_type`
--
ALTER TABLE `tbl_activity_type`
  ADD PRIMARY KEY (`activityType_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_item_history`
--
ALTER TABLE `tbl_item_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `tbl_reference`
--
ALTER TABLE `tbl_reference`
  ADD PRIMARY KEY (`reference_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `userType_id` (`userType_id`);

--
-- Indexes for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  ADD PRIMARY KEY (`userType_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_activity_logs`
--
ALTER TABLE `tbl_activity_logs`
  MODIFY `activityLog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
--
-- AUTO_INCREMENT for table `tbl_activity_type`
--
ALTER TABLE `tbl_activity_type`
  MODIFY `activityType_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;
--
-- AUTO_INCREMENT for table `tbl_item_history`
--
ALTER TABLE `tbl_item_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=649;
--
-- AUTO_INCREMENT for table `tbl_reference`
--
ALTER TABLE `tbl_reference`
  MODIFY `reference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  MODIFY `userType_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
