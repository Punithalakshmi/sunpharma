-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2022 at 09:40 AM
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
-- Table structure for table `awards_creation_category`
--

CREATE TABLE `awards_creation_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `awards_creation_category`
--

INSERT INTO `awards_creation_category` (`id`, `name`, `created_date`, `updated_date`, `created_id`, `updated_id`) VALUES
(1, 'Research Awards', '2022-12-02', '0000-00-00', 1, 0),
(2, 'Science Scholars Awards', '2022-12-02', '2022-12-02', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `type` enum('Research Awards','Science Scholar Awards') NOT NULL,
  `main_category_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `type`, `main_category_id`, `created_date`, `updated_date`, `created_id`, `updated_id`) VALUES
(6, 'Pharmaceutical Sciences', 'Active', 'Research Awards', 1, '2022-12-07 23:26:46', '0000-00-00 00:00:00', 1, 0),
(11, 'Medical Sciences-Basic Research', 'Active', 'Research Awards', 0, '2022-12-08 18:37:43', '0000-00-00 00:00:00', 1, 0),
(12, ' Medical Sciences-Clinical Research', 'Active', 'Research Awards', 0, '2022-12-08 18:37:55', '0000-00-00 00:00:00', 1, 0),
(13, 'Bio-Medical Sciences', 'Active', 'Science Scholar Awards', 0, '2022-12-08 18:38:08', '0000-00-00 00:00:00', 1, 0),
(14, 'Pharmaceutical Sciences - SS', 'Active', 'Science Scholar Awards', 0, '2022-12-08 18:38:41', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('iv3ajnijlose5q23vfhjuf6hkejjgd4n', '127.0.0.1', '2022-12-09 08:34:43', 0x5f5f63695f6c6173745f726567656e65726174657c693a313637303537343838333b75736572646174617c613a373a7b733a323a226964223b733a313a2231223b733a343a226e616d65223b733a373a2250756e69746861223b733a31303a226c6f67696e5f6e616d65223b733a373a2250756e69746861223b733a353a22656d61696c223b733a32313a2270756e697468613140697a616170746563682e696e223b733a31303a2269734c6f67676564496e223b623a313b733a343a22726f6c65223b733a313a2233223b733a383a226c6f67696e5f6964223b733a313a2231223b7d5f63695f70726576696f75735f75726c7c733a34313a22687474703a2f2f6c6f63616c2e73756e706861726d612e6d642f61646d696e2f64617368626f617264223b);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `title` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `document` varchar(255) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `thumb_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'event',
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `category`, `title`, `subject`, `description`, `start_date`, `end_date`, `document`, `banner_image`, `thumb_image`, `status`, `type`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 3, 'Epidemiological and Genomic Methods for the Study of Human Diseases', 'Workshop on “Epidemiological and Genomic Methods for the Study of Human Diseases” For Young Clinical Researchers and Basic Scientists', 'Workshop on “Epidemiological and Genomic Methods for the Study of Human Diseases” For Young Clinical Researchers and Basic Scientists', '2022-11-11', '2023-01-25', 'Winter_School_Announcement_2022.pdf', 'slide4.jpg', '', 1, 'event', 1, 1, '2022-11-11', '2022-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `event_registerations`
--

CREATE TABLE `event_registerations` (
  `id` int(11) NOT NULL,
  `event_type` int(11) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `registeration_no` varchar(255) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_registerations`
--

INSERT INTO `event_registerations` (`id`, `event_type`, `firstname`, `lastname`, `email`, `phone`, `address`, `registeration_no`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 0, 'Punithaa', 'Lakshmiii', 'punitha.izaap@gmail.com', 2147483647, 'Test', 'SPSFN-REG-1', 1, 1, '2022-11-24', '2022-11-24'),
(2, 0, 'Anitha', 'Test', 'punitha.izaap1@gmail.com', 2147483647, 'bgfggffggf', 'SPSFN-REG-2', 1, 0, '2022-11-30', '0000-00-00'),
(3, 0, 'Punithaa', 'Lakshmiii', 'punitha@izaaptech.in', 2147483647, 'dffdff', 'SPSFN-REG-3', 1, 1, '2022-11-30', '2022-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `id` int(11) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`id`, `event_type`, `created_date`, `updated_date`) VALUES
(1, 'National Seminar', '2022-11-11 05:02:24', '2022-11-11 06:01:43'),
(2, 'International Seminar', '2022-11-11 05:02:24', '2022-11-11 06:01:43'),
(3, 'Workshop', '2022-11-11 05:02:48', '2022-11-11 06:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `extend_nomination`
--

CREATE TABLE `extend_nomination` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `extend_date` date NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `jury_ratings`
--

CREATE TABLE `jury_ratings` (
  `id` int(11) NOT NULL,
  `nominee_id` int(11) NOT NULL,
  `jury_id` int(11) NOT NULL,
  `rating` varchar(100) NOT NULL,
  `comments` text NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nominations`
--

CREATE TABLE `nominations` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `main_category_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `subject` text NOT NULL,
  `description` longtext NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'nomination',
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_date` datetime NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `thumb_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `document` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nominations`
--

INSERT INTO `nominations` (`id`, `category_id`, `main_category_id`, `title`, `subject`, `description`, `start_date`, `end_date`, `type`, `created_id`, `updated_id`, `created_date`, `updated_date`, `banner_image`, `thumb_image`, `status`, `document`) VALUES
(1, 6, 1, 'Research Awards', 'Research Awards', 'Research Awards', '2022-12-02', '2022-12-15', 'nomination', 1, 1, '2022-12-08 19:00:22', '2022-12-08 12:02:41', 'iStock_63113235_LARGE.jpg', 'winner-SuvendraNathBhattacharyya-ImResizer.jpg', 1, 'output.pdf'),
(8, 11, 1, 'Medical Sciences Basic Research', 'Medical Sciences Basic Research', 'Medical Sciences Basic Research', '2022-12-09', '2022-12-09', 'nomination', 1, 0, '2022-12-08 18:43:39', '0000-00-00 00:00:00', '', '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `nominee_details`
--

CREATE TABLE `nominee_details` (
  `id` int(11) NOT NULL,
  `nominee_id` int(11) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `citizenship` varchar(255) NOT NULL,
  `nomination_type` varchar(100) NOT NULL,
  `ongoing_course` varchar(100) NOT NULL,
  `is_completed_a_research_project` varchar(150) NOT NULL,
  `designation` varchar(150) NOT NULL,
  `residence_address` text NOT NULL,
  `nominator_photo` varchar(155) NOT NULL,
  `nominator_name` varchar(200) NOT NULL,
  `nominator_email` varchar(150) NOT NULL,
  `nominator_phone` varchar(50) NOT NULL,
  `nominator_designation` varchar(100) NOT NULL,
  `nominator_address` text NOT NULL,
  `justification_letter_filename` varchar(100) NOT NULL,
  `passport_filename` varchar(150) NOT NULL,
  `complete_bio_data` text NOT NULL,
  `best_papers` text NOT NULL,
  `statement_of_research_achievements` text NOT NULL,
  `signed_details` text NOT NULL,
  `specific_publications` text NOT NULL,
  `signed_statement` text NOT NULL,
  `citation` text NOT NULL,
  `supervisor_certifying` text NOT NULL,
  `excellence_research_work` text NOT NULL,
  `lists_of_publications` text NOT NULL,
  `statement_of_applicant` text NOT NULL,
  `ethical_clearance` text NOT NULL,
  `statement_of_duly_signed_by_nominee` text NOT NULL,
  `aggregate_marks` text NOT NULL,
  `year_of_passing` int(11) NOT NULL,
  `number_of_attempts` int(11) NOT NULL,
  `age_proof` text NOT NULL,
  `declaration_candidate` text NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL,
  `is_accepted` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 0,
  `is_submitted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nominee_details`
--

INSERT INTO `nominee_details` (`id`, `nominee_id`, `category_id`, `citizenship`, `nomination_type`, `ongoing_course`, `is_completed_a_research_project`, `designation`, `residence_address`, `nominator_photo`, `nominator_name`, `nominator_email`, `nominator_phone`, `nominator_designation`, `nominator_address`, `justification_letter_filename`, `passport_filename`, `complete_bio_data`, `best_papers`, `statement_of_research_achievements`, `signed_details`, `specific_publications`, `signed_statement`, `citation`, `supervisor_certifying`, `excellence_research_work`, `lists_of_publications`, `statement_of_applicant`, `ethical_clearance`, `statement_of_duly_signed_by_nominee`, `aggregate_marks`, `year_of_passing`, `number_of_attempts`, `age_proof`, `declaration_candidate`, `created_id`, `updated_id`, `created_date`, `updated_date`, `is_accepted`, `is_active`, `is_submitted`) VALUES
(1, 11, '1', '1', 'ssan', '', '', '', 'Test', 'winner-SuvendraNathBhattacharyya-ImResizer.jpg', 'Nominator1', 'nominator2@gmail.com', '8976512345', '', 'Test', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', '', '', '', '', '', '', '', 0, 0, '', '', 0, 0, '2022-12-02 08:25:07', '0000-00-00 00:00:00', 0, 0, 1),
(2, 12, '4', '1', 'spsfn', 'MD', 'Yes', '', 'Test', 'winner-SuvendraNathBhattacharyya-ImResizer.jpg', 'Nominator1', 'nominator1@gmail.com', '7894112345', '', 'Test', 'output.pdf', '', 'output.pdf', '', '', '', '', '', 'output.pdf', 'output.pdf', 'sample-sm.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 2002, 2, 'output.pdf', 'output.pdf', 0, 0, '2022-12-02 08:31:19', '0000-00-00 00:00:00', 0, 0, 1),
(3, 13, '1', '1', 'ssan', '', '', '', 'Test', 'winner-SuvendraNathBhattacharyya-ImResizer.jpg', 'Nominator1', 'nominator2r@gmail.com', '7841234567', '', 'Test', 'output.pdf', 'output.pdf', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 0, 0, '2022-12-07 07:06:49', '0000-00-00 00:00:00', 0, 0, 0),
(4, 14, '2', '2', 'spsfn', 'MD', 'Yes', '', 'Test', 'winner-SuvendraNathBhattacharyya-ImResizer.jpg', 'eewee', 'nominator4@gmail.com', '8971234566', '', 'test', 'output.pdf', '', '', '', '', '', '', '', '', 'output.pdf', '', '', '', '', '', '', 0, 0, '', '', 0, 0, '2022-12-07 07:08:59', '0000-00-00 00:00:00', 0, 0, 0),
(5, 16, '6', '1', 'ssan', '', '', '', 'Test', 'winner-SuvendraNathBhattacharyya-ImResizer.jpg', 'Nominator1', 'nominator2@gmail.com', '8976543212', '', 'TEst', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', 'output.pdf', '', '', '', '', '', '', '', 0, 0, '', '', 0, 0, '2022-12-08 11:01:56', '0000-00-00 00:00:00', 0, 0, 1),
(6, 18, '6', '1', 'ssan', '', '', '', 'Test', 'winner-SuvendraNathBhattacharyya-ImResizer.jpg', 'Nominator1', 'punitha.izaap1@gmail.com', '9784512345', '', 'Test', 'output.pdf', 'output.pdf', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 0, 0, '2022-12-08 18:39:39', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `jury_id` int(11) NOT NULL,
  `nominee_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comments` text NOT NULL,
  `is_rate_submitted` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `jury_id`, `nominee_id`, `rating`, `comments`, `is_rate_submitted`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 2, 11, 20, 'Test', 0, 2, 0, '2022-12-01 21:05:04', '0000-00-00 00:00:00'),
(2, 2, 11, 20, 'Test', 0, 2, 0, '2022-12-01 21:10:24', '0000-00-00 00:00:00'),
(3, 2, 11, 80, 'Test', 1, 2, 0, '2022-12-01 21:15:17', '0000-00-00 00:00:00');

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
  `original_password` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `address` text NOT NULL,
  `status` enum('Approved','Disapproved') NOT NULL,
  `active` int(11) NOT NULL,
  `is_rejected` int(11) NOT NULL,
  `extend_date` date DEFAULT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `middlename`, `dob`, `password`, `original_password`, `email`, `phone`, `role`, `category`, `gender`, `address`, `status`, `active`, `is_rejected`, `extend_date`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'admin', 'Punitha', 'Lakshmi', 'A', '15/01/1987', '0192023a7bbd73250516f069df18b500', '', 'punitha1@izaaptech.in', '7708837773', 3, 0, 'F', '', 'Approved', 1, 0, NULL, 1, 1, '2022-08-08 14:44:15', '2022-11-26 00:51:43'),
(16, 'shubham', 'Shubham', '', '', '1991/02/21', 'd03ca88e5d806a29f006ae5f757345e0', 'nlkjkiyh', 'punitha@izaaptech.in', '9876543213', 2, 6, 'M', 'Test', 'Disapproved', 0, 1, '2022-12-06', 1, 1, '2022-12-07 23:31:56', '2022-12-08 11:02:57'),
(17, 'jury1', 'Jury1', 'Test', '', '7/2/1982', '143dc6bd8290c28b281cdc18c4b24ea2', '', 'punitha.izaap@gmail.com', '9940955501', 1, 6, 'M', '', 'Approved', 1, 0, NULL, 1, 0, '2022-12-07 23:49:44', '0000-00-00 00:00:00'),
(18, 'shubham', 'Shubham', '', '', '1991/02/21', 'fdc32fba1d76d3487270cbc0986db7f0', 'gvyexrfr', 'punitha@izaaptech.in', '9876541234', 2, 6, 'M', 'Test', 'Approved', 1, 0, NULL, 1, 1, '2022-12-08 07:09:39', '2022-12-08 12:39:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awards_creation_category`
--
ALTER TABLE `awards_creation_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`,`ip_address`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_registerations`
--
ALTER TABLE `event_registerations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extend_nomination`
--
ALTER TABLE `extend_nomination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jury_nominee`
--
ALTER TABLE `jury_nominee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nominations`
--
ALTER TABLE `nominations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nominee_details`
--
ALTER TABLE `nominee_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
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
-- AUTO_INCREMENT for table `awards_creation_category`
--
ALTER TABLE `awards_creation_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_registerations`
--
ALTER TABLE `event_registerations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `extend_nomination`
--
ALTER TABLE `extend_nomination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jury_nominee`
--
ALTER TABLE `jury_nominee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nominations`
--
ALTER TABLE `nominations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nominee_details`
--
ALTER TABLE `nominee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
