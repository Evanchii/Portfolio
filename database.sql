-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2022 at 03:50 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `date` int(11) NOT NULL,
  `file` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `createdAt` int(11) NOT NULL,
  `members` longtext NOT NULL,
  `leader` varchar(30) NOT NULL,
  `preview` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `description` varchar(128) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `additional_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `description`, `value`, `additional_value`) VALUES
(1, 'email', 'admin@alevan.me', NULL),
(2, 'password', '891d7e29907d52cf36087e407cf9c2eb5f956c9c561e3517b8a62aa1e9187a784ec6ea6bc6fe3e638a3e029361d8b3df08d00b74df6d7fad2e1ef7d1353d17c9', NULL),
(3, 'overview', 'I\'m a System and Mobile Developer and currently a BS Information Technology Student at PHINMA - University of Pangasinan', NULL),
(4, 'description', NULL, 'Hi! I\'m <b>Al Evan Castillo</b>, a 4th year Bachelor of Science in Information Technology Student from PHINMA - University of Pangasinan. I mainly develop mobile applications but I\'ve also tried developing for desktop and web systems, and even games!\n\nWhen I was a kid, I found computers fascinating and even dreamt of developing my own Operating System. That\'s why I chose to pursue this degree. I\'ve learnt my first programming language (Java) during my Senior High School days and immediately fell in love with it and the rest is history.'),
(5, 'platforms', NULL, '[{\"title\":\"Facebook\",\"url\":\"https://www.facebook.com/castillo00187/\",\"fa\":\"fa-brands fa-facebook-f\"},{\"title\":\"Instagram\",\"url\":\"https://www.instagram.com/alevancastillo/\",\"fa\":\"fa-brands fa-instagram\"},{\"title\":\"LinkedIn\",\"url\":\"https://www.linkedin.com/in/al-evan-castillo-124b05201/\",\"fa\":\"fa-brands fa-linkedin-in\"},{\"title\":\"GitHub\",\"url\":\"https://github.com/Evanchii\",\"fa\":\"fa-brands fa-github\"},{\"title\":\"Email\",\"url\":\"mailto:castilloalevan143@gmail.com\",\"fa\":\"fa-regular fa-envelope\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_query`
--

CREATE TABLE `visitor_query` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0: Unread; 1: Read;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_query`
--
ALTER TABLE `visitor_query`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitor_query`
--
ALTER TABLE `visitor_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
