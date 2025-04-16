-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 01:26 AM
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
(1, 'Pharmaceutical Sciences', 'Active', 'Research Awards', 1, '2022-09-09 07:22:58', '0000-00-00 00:00:00', 1, 0),
(2, 'Medical Sciences-Basic Research', 'Active', 'Research Awards', 1, '2022-09-09 07:25:42', '0000-00-00 00:00:00', 1, 0),
(3, 'Medical Sciences-Clinical Research', 'Active', 'Research Awards', 1, '2022-09-09 07:26:00', '0000-00-00 00:00:00', 1, 0),
(4, 'Bio-Medical Sciences', 'Active', 'Science Scholar Awards', 2, '2022-09-09 07:26:37', '2022-09-29 11:23:59', 1, 1),
(5, 'Pharmaceutical Sciences - SS', 'Active', 'Science Scholar Awards', 2, '2022-09-09 07:27:44', '2022-09-09 00:38:57', 1, 1);

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
(1, 3, 'Epidemiological and Genomic Methods for the Study of Human Diseases', 'Workshop on “Epidemiological and Genomic Methods for the Study of Human Diseases” For Young Clinical Researchers and Basic Scientists', 'Workshop on “Epidemiological and Genomic Methods for the Study of Human Diseases” For Young Clinical Researchers and Basic Scientists', '2022-11-11', '2023-01-25', 'Winter_School_Announcement_2022.pdf', 'slide4.jpg', '', 1, 'event', 1, 1, '2022-11-11', '2022-11-30'),
(3, 2, 'test', 'test', 'test', '2022-11-30', '2022-11-30', '', '', '', 1, 'event', 1, 0, '2022-11-30', '0000-00-00');

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
  `main_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
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

INSERT INTO `nominations` (`id`, `main_category_id`, `category_id`, `title`, `subject`, `description`, `start_date`, `end_date`, `type`, `created_id`, `updated_id`, `created_date`, `updated_date`, `banner_image`, `thumb_image`, `status`, `document`) VALUES
(1, 1, 1, 'Research Awards', 'Research Awards', 'Research Awards', '2022-12-02', '2023-01-05', 'nomination', 1, 1, '2022-12-08 00:06:26', '2022-12-07 18:06:26', 'iStock_63113235_LARGE.jpg', 'winner-SuvendraNathBhattacharyya-ImResizer.jpg', 1, 'output.pdf'),
(2, 2, 4, 'Science Scholars Awards', 'Science Scholars Awards', 'Science Scholars Awards', '2022-12-02', '2022-12-30', 'nomination', 1, 1, '2022-12-08 00:06:36', '2022-12-07 18:06:36', 'iStock_63113235_LARGE.jpg', '', 1, 'output.pdf');

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
(4, 14, '2', '2', 'spsfn', 'MD', 'Yes', '', 'Test', 'winner-SuvendraNathBhattacharyya-ImResizer.jpg', 'eewee', 'nominator4@gmail.com', '8971234566', '', 'test', 'output.pdf', '', '', '', '', '', '', '', '', 'output.pdf', '', '', '', '', '', '', 0, 0, '', '', 0, 0, '2022-12-07 07:08:59', '0000-00-00 00:00:00', 0, 0, 0);

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
  `nomination_end_date` date DEFAULT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `middlename`, `dob`, `password`, `original_password`, `email`, `phone`, `role`, `category`, `gender`, `address`, `status`, `active`, `is_rejected`, `nomination_end_date`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'admin', 'Punitha', 'Lakshmi', 'A', '15/01/1987', '0192023a7bbd73250516f069df18b500', '', 'punitha1@izaaptech.in', '7708837773', 3, 0, 'F', '', 'Approved', 1, 0, NULL, 1, 1, '2022-08-08 14:44:15', '2022-11-26 00:51:43'),
(2, 'jury1', 'Jury', 'Test', 'A', '15/01/1987', '143dc6bd8290c28b281cdc18c4b24ea2', '', 'punitha.izaap@gmail.com', '6380062833', 1, 1, 'M', '', 'Approved', 1, 0, NULL, 1, 1, '2022-10-06 21:15:54', '2022-12-02 02:14:41'),
(3, 'jury2', 'Jury', 'Test 2', '', '15/01/1987', '143dc6bd8290c28b281cdc18c4b24ea2', '', 'punitha.lakshmi87@gmail.com', '9551144038', 1, 2, 'M', '', 'Approved', 1, 0, NULL, 1, 1, '2022-10-06 21:17:26', '2022-12-02 02:16:42'),
(4, 'jury3', 'Jury', 'Test 3', '', '15/01/1987', '143dc6bd8290c28b281cdc18c4b24ea2', '', 'jury@gmail.com', '9952956068', 1, 2, 'M', '', 'Approved', 1, 0, NULL, 1, 0, '2022-10-06 21:18:19', '0000-00-00 00:00:00'),
(5, 'jury4', 'Jury', 'Test 4', '', '15/01/1987', '143dc6bd8290c28b281cdc18c4b24ea2', '', 'jury4@gmail.com', '8148715336', 1, 2, 'M', '', 'Approved', 1, 0, NULL, 1, 0, '2022-10-06 21:18:55', '0000-00-00 00:00:00'),
(13, '', 'Shubham', '', '', '1991/06/06', '', '', 'test@gmail.com', '8823212356', 2, 0, 'M', 'test', 'Disapproved', 0, 0, NULL, 1, 0, '2022-12-06 19:36:49', '0000-00-00 00:00:00'),
(14, 'mathanika', 'Mathanika', '', '', '1991/05/06', '62000a2d8ab9060f5f487c044f304bdd', 'nkrbmfri', 'ffdfd@gmail.com', '8791234567', 2, 2, 'M', 'Test', 'Approved', 1, 0, NULL, 1, 1, '2022-12-06 19:38:59', '2022-12-07 01:14:35');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `main_category_id` (`main_category_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nominee_details`
--
ALTER TABLE `nominee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
