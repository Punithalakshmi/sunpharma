-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2022 at 09:36 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sunpharma`
--

-- --------------------------------------------------------

--
-- Table structure for table `jury_nominee`
--

CREATE TABLE `jury_nominee` (
  `id` int(11) NOT NULL,
  `jury_id` int(11) NOT NULL,
  `nominee_id` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jury_nominee`
--

INSERT INTO `jury_nominee` (`id`, `jury_id`, `nominee_id`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 3, 4, 1, 0, '2022-08-16 19:22:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `nominee_details`
--

CREATE TABLE `nominee_details` (
  `id` int(11) NOT NULL,
  `nominee_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `nomination_type` varchar(100) NOT NULL,
  `ongoing_course` varchar(100) NOT NULL,
  `is_completed_a_research_project` varchar(150) NOT NULL,
  `designation` varchar(150) NOT NULL,
  `residence_address` text NOT NULL,
  `nominator_name` varchar(200) NOT NULL,
  `nominator_email` varchar(150) NOT NULL,
  `nominator_phone` varchar(50) NOT NULL,
  `nominator_designation` varchar(100) NOT NULL,
  `nominator_address` text NOT NULL,
  `justification_letter_filename` varchar(100) NOT NULL,
  `passport_filename` varchar(150) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'Jury', 1, 1, '2022-08-11 03:10:04', '2022-08-11 05:09:48'),
(2, 'Nominee', 1, 1, '2022-08-11 03:11:48', '2022-08-11 05:11:40'),
(3, 'Admin', 1, 1, '2022-08-11 14:57:12', '2022-08-11 16:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(150) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `password` longtext NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `address` text NOT NULL,
  `status` enum('Approved','Disapproved') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `middlename`, `dob`, `password`, `email`, `phone`, `role`, `gender`, `address`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'admin', 'Punithafdddsd', 'Lakshmieee', 'A', '15/01/1987', '0192023a7bbd73250516f069df18b500', 'punitha@izaaptech.in', '7708837773', 3, 'F', '', 'Approved', 1, 1, '2022-08-08 14:44:15', '2022-08-18 08:53:31'),
(2, 'jury', 'Anitha', 'Lakshmiii', '', '15/01/1987', '6ad14ba9986e3615423dfca256d04e3f', 'ffdfdsd@gmail.com', '9952956068', 1, 'M', '', 'Approved', 1, 1, '2022-08-12 05:14:47', '2022-08-12 03:45:02'),
(3, '', 'Punithaa', 'Lakshmi', 'dsdsd', '15/01/1987', '', 'punitha.izaap@izaaptech.in', '8976434521', 1, 'M', '', 'Approved', 1, 0, '2022-08-12 10:44:56', '0000-00-00 00:00:00'),
(4, '', 'Test', 'User', 'A', '15/01/1987', '', 'test@gmail.com', '6789056473', 2, 'M', '', 'Approved', 1, 1, '2022-08-13 09:46:56', '2022-08-18 08:53:48'),
(5, '', 'Test 1', 'User1', 'A', '15/01/1987', '', 'testuser@gmail.com', '6380062833', 1, 'M', '', 'Approved', 1, 1, '2022-08-18 08:29:53', '2022-08-18 08:52:55'),
(6, '', 'Test 2', 'User 2', '', '15/01/1987', '', 'testuser2@gmail.com', '7865423476', 1, 'M', '', 'Approved', 1, 1, '2022-08-18 08:31:50', '2022-08-18 08:54:51'),
(7, '', 'Nominee 1', 'User 1', '', '15/01/1987', '', 'nomineeuser1@gmail.com', '8567945621', 2, 'M', '', 'Approved', 1, 0, '2022-08-18 08:33:21', '0000-00-00 00:00:00'),
(8, '', 'Nominee 2', 'User 2', '', '15/01/1987', '', 'nomineeuser2@gmail.com', '7892345791', 2, 'M', '', 'Approved', 1, 1, '2022-08-18 08:34:32', '2022-08-18 08:53:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jury_nominee`
--
ALTER TABLE `jury_nominee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nominee_details`
--
ALTER TABLE `nominee_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `jury_nominee`
--
ALTER TABLE `jury_nominee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nominee_details`
--
ALTER TABLE `nominee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
