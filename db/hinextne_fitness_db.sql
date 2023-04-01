-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 07, 2023 at 05:30 AM
-- Server version: 10.3.38-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hinextne_fitness_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `dept_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dept_name`) VALUES
(1, 'Secretary'),
(2, 'Chairman'),
(3, 'Administration'),
(4, 'Enforcement'),
(5, 'Engineering '),
(6, 'Operation'),
(7, 'Road Safety'),
(8, 'Training'),
(9, 'Accounts');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `designation_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `designation_name`) VALUES
(1, 'Chairman'),
(2, 'Director'),
(3, 'Secretary'),
(4, 'Deputy Director'),
(5, 'Magistrate'),
(6, 'Accident Data Annalist'),
(7, 'Maintenance Engg.'),
(8, 'Programmer'),
(9, 'Assistant Director (ADMIN)'),
(10, 'Assistant Director (PS)'),
(11, 'Assistant Director (GENERAL)'),
(12, 'Assistant Director (Engg.)'),
(13, 'Accounts Officer'),
(14, 'Revenue Officer'),
(15, 'Assistant Maintenance Engg.'),
(16, 'Assistant Programmer'),
(17, 'Senior Computer Operator'),
(18, 'Assistant Revenue Officer'),
(19, 'Motor Vehicle Inspector'),
(20, 'Head Assistant'),
(21, 'U.D.A'),
(22, 'U.D.A/Computer Operator'),
(23, 'Accountant'),
(24, 'Stenograper-cum-computer Operator'),
(25, 'Steno-Typist-cum-Computer Operator '),
(26, 'Auditor'),
(27, 'Bench Assistant'),
(28, 'Assistant Motor Vehicle Inspector'),
(29, 'Draftsman (Mechanical)'),
(30, 'Cashier'),
(31, 'Account Assistant'),
(32, 'Office Assistant cum-computer Typist'),
(33, 'Store Keeper'),
(34, 'Record Keeper'),
(35, 'Photocopy Operator'),
(36, 'Despatch rider'),
(37, 'Cash Sarker'),
(38, 'Office Shohaik'),
(39, 'Guard'),
(40, 'Cleaner (Poricchonnota kormi)');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(100) NOT NULL,
  `vehicleno` varchar(250) NOT NULL,
  `office` text NOT NULL,
  `images` varchar(500) NOT NULL,
  `status` int(1) NOT NULL COMMENT '2-Hold, 0-Pending, 1-Approved',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `vehicleno`, `office`, `images`, `status`, `created_at`, `user_id`) VALUES
(36, '565656-KA', '1', '1657661046_7d86d5c126a7c8c1accf.jpg||1657661046_3d23f3f6777d9fc35577.jpg', 1, '2022-07-13 03:24:06', 7),
(119, 'AAAA', '3', '1663624092.png', 1, '2022-09-19 17:48:12', 25),
(121, 'CCCC', '3', '1663624235.jpg', 1, '2022-09-19 17:50:34', 25),
(124, 'EEEE', '3', '1663624761.jpg', 0, '2022-09-19 17:59:21', 25),
(125, 'EEEE', '3', '1663624793.jpeg', 0, '2022-09-19 17:59:52', 25),
(127, 'Gha-02-1234', '2', '1663650659.jpg', 0, '2022-09-20 01:10:58', 30),
(128, 'Gha-02-4321', '2', '1663650681.jpg', 1, '2022-09-20 01:11:20', 30),
(129, 'DHAKA METRO GA3688', '1', '1663681370.jpg', 1, '2022-09-20 09:42:50', 1),
(133, 'GHA 4321', '1', '1668416258.jpg', 0, '2022-11-14 03:57:38', 1),
(135, '496812', '2', '1670352908.jpeg', 0, '2022-12-06 13:55:08', 30),
(136, '496812', '2', '1670352925.jpg', 1, '2022-12-06 13:55:25', 30),
(137, 'Dhaka METRO 496812', '2', '1670353008.jpg', 1, '2022-12-06 13:56:48', 30),
(138, 'Gha-654322', '1', '1672214860.jpg', 1, '2022-12-28 03:07:39', 33),
(140, 'GHA- 31214', '0', '1674449004.jpg', 0, '2023-01-22 23:43:24', 0),
(141, 'DHAKA METRO GHA 4321', '1', '1674452027.jpg', 1, '2023-01-23 00:33:47', 33),
(143, 'GHA-4321', '1', '1678019580.jpg', 0, '2023-03-05 07:32:59', 33);

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `id` int(11) NOT NULL,
  `office_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`id`, `office_name`) VALUES
(1, 'BRTA'),
(2, 'MIRPUR-BRTA'),
(3, 'UTTARA-BRTA'),
(4, 'EQURIA-BRTA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `designation` tinyint(1) NOT NULL,
  `department` tinyint(1) NOT NULL,
  `office` tinyint(1) NOT NULL,
  `contactnumber` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `role` int(1) NOT NULL COMMENT '1-admin, 2-user',
  `userid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `designation`, `department`, `office`, `contactnumber`, `email`, `username`, `password`, `active`, `role`, `userid`) VALUES
(1, 'Admin', 1, 1, 1, '01911291186', 'mnhmasum@gmail.com', 'superadmin', '654321', 1, 1, 0),
(33, 'Admin', 2, 6, 1, '01716709677', 'mm_rubel@rediffmail.com', 'admin', '9d83e8532a33345e495d8f213bf73055', 1, 2, 32),
(34, 'Mortoza Al Mosabber', 8, 8, 1, '01716709677', 'zmtradingbd@gmail.com', 'rubel', '743238963e143cd054d7122e08c72719', 1, 2, 33),
(35, 'Brta', 3, 7, 2, '01716709677', 'mm_rubel@rediffmail.com', 'brta', 'c33367701511b4f6020ec61ded352059', 1, 2, 33);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
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
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
