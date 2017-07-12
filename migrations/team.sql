-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2016 at 11:53 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `axis`
--

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `ID` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `featured_img` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'published'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`ID`, `first_name`, `last_name`, `position`, `date_created`, `featured_img`, `user_id`, `status`) VALUES
(1, 'John', 'Doe', '0', '2016-10-21 00:25:39', '/upload/\\team1.jpg', 1, 'trashed'),
(2, 'John', 'Doe', '0', '2016-10-21 00:26:13', '/upload/\\team1.jpg', 1, 'trashed'),
(3, 'John', 'Doe', 'Position', '2016-10-21 00:27:08', '/upload/\\team1.jpg', 1, 'published'),
(4, 'Jane', 'Doe', 'position', '2016-10-21 00:31:53', '/upload/\\team2.jpg', 1, 'published'),
(5, 'John', 'Doe', 'position', '2016-10-21 00:37:31', '/upload/\\team3.jpg', 1, 'published'),
(6, 'Jane', 'Doe', 'position', '2016-10-21 00:37:50', '/upload/\\team4.jpg', 1, 'published'),
(7, 'John', 'Doe', '', '2016-10-21 00:38:00', '/upload/\\team5.jpg', 1, 'published'),
(8, 'John', 'Doe', '', '2016-10-21 00:38:17', '/upload/\\team6.jpg', 1, 'published'),
(9, 'Jane', 'Doe', '', '2016-10-21 00:38:29', '/upload/\\team7.jpg', 1, 'published'),
(10, 'Jane', 'Doe', '', '2016-10-21 00:38:40', '/upload/\\team8.jpg', 1, 'published');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
