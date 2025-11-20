-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2025 at 05:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adventurecall`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_section`
--

CREATE TABLE `about_section` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_section`
--

INSERT INTO `about_section` (`id`, `content`) VALUES
(1, 'Adventure Call EST is a premier summer colony located in Lebanon offering outdoor fun, team-building activities, and educational experiences for kids and teens.\r\nlet your kid have a special summer this year. \r\nActivities we offer : Hiking ,swimming, martial arts, painting, football, basketball and many more activities.. .');

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(7, 'admin', '$2y$10$tVL/DVyffahBgOn1NBHfyuF7SgsB8BQH15yaAdM7rNFibrVZQ7lAS');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--
-- Error reading structure for table adventurecall.contacts: #1932 - Table &#039;adventurecall.contacts&#039; doesn&#039;t exist in engine
-- Error reading data for table adventurecall.contacts: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `adventurecall`.`contacts`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `email`, `phone`) VALUES
(1, 'adventure.call.est@gmail.com', '+961 03 747 796');

-- --------------------------------------------------------

--
-- Table structure for table `homepage_photos`
--

CREATE TABLE `homepage_photos` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homepage_photos`
--

INSERT INTO `homepage_photos` (`id`, `image_path`, `caption`, `uploaded_at`) VALUES
(1, 'assets/images/hero4.jpeg', NULL, '2025-06-29 14:34:53'),
(4, 'assets/images/photo32.jpeg', NULL, '2025-06-29 19:18:42'),
(5, 'assets/images/photo31.jpeg', NULL, '2025-06-29 19:18:46'),
(6, 'assets/images/photo30.jpeg', NULL, '2025-06-29 19:18:59'),
(7, 'assets/images/photo29.jpeg', NULL, '2025-06-29 19:19:23'),
(8, 'assets/images/photo28.jpeg', NULL, '2025-06-29 19:20:01'),
(9, 'assets/images/photo27.jpeg', NULL, '2025-06-29 19:20:17'),
(10, 'assets/images/photo26.jpeg', NULL, '2025-06-29 19:20:25'),
(11, 'assets/images/photo25.jpeg', NULL, '2025-06-29 19:20:31'),
(12, 'assets/images/photo24.jpeg', NULL, '2025-06-29 19:21:00'),
(13, 'assets/images/photo21.jpeg', NULL, '2025-06-29 19:21:37'),
(14, 'assets/images/photo20.jpeg', NULL, '2025-06-29 19:21:52'),
(15, 'assets/images/photo19.jpeg', NULL, '2025-06-29 19:22:04'),
(16, 'assets/images/photo18.jpeg', NULL, '2025-06-29 19:22:13'),
(17, 'assets/images/photo17.jpeg', NULL, '2025-06-29 19:22:18'),
(18, 'assets/images/photo16.jpeg', NULL, '2025-06-29 19:22:25'),
(21, 'assets/images/photo15.jpeg', NULL, '2025-06-29 19:23:19'),
(22, 'assets/images/photo14.jpeg', NULL, '2025-06-29 19:23:28'),
(23, 'assets/images/photo13.jpeg', NULL, '2025-06-29 19:23:35'),
(24, 'assets/images/photo12.jpeg', NULL, '2025-06-29 19:24:22'),
(25, 'assets/images/photo11.jpeg', NULL, '2025-06-29 19:24:27'),
(26, 'assets/images/photo10.jpeg', NULL, '2025-06-29 19:24:33'),
(27, 'assets/images/photo9.jpeg', NULL, '2025-06-29 19:24:42'),
(28, 'assets/images/photo8.jpeg', NULL, '2025-06-29 19:25:11'),
(29, 'assets/images/photo7.jpeg', NULL, '2025-06-29 19:25:26'),
(30, 'assets/images/photo6.jpeg', NULL, '2025-06-29 19:25:37'),
(31, 'assets/images/photo5.jpeg', NULL, '2025-06-29 19:25:42'),
(32, 'assets/images/photo4.jpeg', NULL, '2025-06-29 19:25:47'),
(33, 'assets/images/photo3.jpeg', NULL, '2025-06-29 19:25:55'),
(34, 'assets/images/photo2.jpeg', NULL, '2025-06-29 19:26:07'),
(39, 'assets/images/photo22.jpeg', NULL, '2025-06-29 19:32:41'),
(50, 'assets/images/photo33.jpeg', NULL, '2025-10-10 11:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `media_type` varchar(20) NOT NULL DEFAULT 'video'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `filename`, `uploaded_at`, `media_type`) VALUES
(4, 'vid_68e8ec2e237e5.mp4', '2025-10-10 11:21:18', 'video'),
(5, 'vid_68e8ec4002cad.mp4', '2025-10-10 11:21:36', 'video'),
(9, 'vid_68e8ed94878b9.mp4', '2025-10-10 11:27:16', 'video');

-- --------------------------------------------------------

--
-- Table structure for table `monitor_applications`
--

CREATE TABLE `monitor_applications` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `expected_salary` varchar(100) DEFAULT NULL,
  `resume_path` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monitor_applications`
--

INSERT INTO `monitor_applications` (`id`, `full_name`, `position`, `email`, `phone`, `expected_salary`, `resume_path`, `submitted_at`) VALUES
(10, 'Rawadsd', 'football training', '', '76593136', '444', NULL, '2025-06-30 10:42:10'),
(11, 'ali abbas', 'optics', '', '76599999999', '5000', NULL, '2025-10-10 10:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `guardian_name` varchar(100) NOT NULL,
  `guardian_phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `preferred_activities` text NOT NULL,
  `medical_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `full_name`, `age`, `guardian_name`, `guardian_phone`, `email`, `preferred_activities`, `medical_notes`, `created_at`) VALUES
(1, 'mohamad', 7, 'ahmad', '03189070', 'rawadswied1@gmail.com', 'football swimming', 'flu', '2025-06-30 09:45:58'),
(2, 'Rawadsd', 12, 'ahmad', '32423423423', 'toulaymoudy41@gmail.com', 'szfzdxf', '', '2025-06-30 10:02:34'),
(3, 'Rawad', 22, 'sfzsdfvdx', '03189070', 'sweidmoniafg@gmail.com', 'jrdjg', 'uktiyt', '2025-06-30 10:41:07'),
(4, 'ali moussa', 40, 'asdfsdfsdfafasdfdsafd', '0318907000', 'alimoussa@gmail.com', 'MMA', 'nothing', '2025-10-10 10:47:26');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `platform`, `url`) VALUES
(1, 'facebook', 'https://www.facebook.com/share/1ArubXRJma/'),
(2, 'instagram', 'https://www.instagram.com/adventurecallest?igsh=YmV2bHkyMDl1cWlr'),
(3, 'tiktok', 'https://www.tiktok.com/@adventurecallest?_t=ZS-8xOrsb16IER&_r=1');

-- --------------------------------------------------------

--
-- Table structure for table `trip_offers`
--

CREATE TABLE `trip_offers` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_offers`
--

INSERT INTO `trip_offers` (`id`, `image_path`, `uploaded_at`) VALUES
(1, 'uploads/photo101.jpg', '2025-10-13 10:35:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_section`
--
ALTER TABLE `about_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_photos`
--
ALTER TABLE `homepage_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor_applications`
--
ALTER TABLE `monitor_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_offers`
--
ALTER TABLE `trip_offers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_section`
--
ALTER TABLE `about_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `homepage_photos`
--
ALTER TABLE `homepage_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `monitor_applications`
--
ALTER TABLE `monitor_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trip_offers`
--
ALTER TABLE `trip_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
