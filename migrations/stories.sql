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
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `ID` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `uri` varchar(300) DEFAULT NULL,
  `excerpt` varchar(250) DEFAULT NULL,
  `content` text,
  `video` varchar(255) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'published',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDefault` int(2) NOT NULL DEFAULT '0',
  `featured_img` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`ID`, `user_id`, `title`, `uri`, `excerpt`, `content`, `video`, `status`, `date_created`, `date_updated`, `isDefault`, `featured_img`) VALUES
(3, 1, 'Story 1', 'story-1', 'Story 1', '<p>Vestibulum dictum ipsum mi. Aliquam eu turpis nisl. Donec id magna ac nulla maximus sollicitudin nec eu libero. In volutpat justo dictum, semper sem eu, hendrerit dolor.</p>\r\n', 'https://vimeo.com/115548511', 'published', '2016-10-18 19:26:07', '2016-10-24 21:34:53', 1, '/upload/\\wof.png'),
(4, 1, 'Story 2', 'story-2', 'Story 2', '<p>Vestibulum dictum ipsum mi. Aliquam eu turpis nisl. Donec id magna ac nulla maximus sollicitudin nec eu libero. In volutpat justo dictum, semper sem eu, hendrerit dolor.</p>\r\n', 'https://vimeo.com/137515337', 'published', '2016-10-18 19:30:03', '2016-10-24 21:09:19', 0, NULL),
(5, 1, 'Story 3', 'story-3', 'Story 3', '<p>Vestibulum dictum ipsum mi. Aliquam eu turpis nisl. Donec id magna ac nulla maximus sollicitudin nec eu libero. In volutpat justo dictum, semper sem eu, hendrerit dolor.</p>\r\n', 'https://vimeo.com/137491519', 'published', '2016-10-18 19:30:32', '2016-10-24 21:09:28', 0, NULL),
(6, 1, 'Story 4', 'story-4', 'Story 4', '<p>Vestibulum dictum ipsum mi. Aliquam eu turpis nisl. Donec id magna ac nulla maximus sollicitudin nec eu libero. In volutpat justo dictum, semper sem eu, hendrerit dolor.</p>\r\n', 'https://vimeo.com/126601145', 'published', '2016-10-18 19:30:46', '2016-10-24 21:09:35', 0, NULL),
(7, 1, 'Story 5', 'story-5', 'Story 5', '<p>Vestibulum dictum ipsum mi. Aliquam eu turpis nisl. Donec id magna ac nulla maximus sollicitudin nec eu libero. In volutpat justo dictum, semper sem eu, hendrerit dolor.</p>\r\n', 'https://vimeo.com/121473688', 'published', '2016-10-18 19:30:55', '2016-10-24 21:09:43', 0, NULL),
(8, 1, 'Story 6', 'story-6', '', '', '', 'trashed', '2016-10-24 21:26:57', '2016-10-24 21:27:23', 0, '/upload/\\wof.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
