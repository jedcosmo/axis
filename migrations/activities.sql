-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2016 at 11:45 AM
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
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `ID` int(255) NOT NULL,
  `user_id` int(200) NOT NULL,
  `title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`ID`, `user_id`, `title`) VALUES
(1, 1, 'Aerobics'),
(2, 1, 'Boxing'),
(3, 1, 'Fitness Bands'),
(4, 1, 'Weight Training'),
(5, 1, 'Yoga'),
(6, 1, 'Acupuncture'),
(7, 1, 'Martial Arts'),
(8, 1, 'Cardio Training'),
(9, 1, 'Spinning'),
(10, 1, 'Handcycling'),
(11, 1, 'Wheelchair Mobility'),
(12, 1, 'Meal Consumed'),
(13, 1, 'Spinal Mobility'),
(14, 1, 'Rowing'),
(15, 1, 'Motomed'),
(16, 1, 'Standing Frame'),
(17, 1, 'Computer Use'),
(18, 1, 'Support Group'),
(19, 1, 'Advocacy'),
(20, 1, 'Wheelchair Care'),
(21, 1, 'Wheelchair Loan'),
(22, 1, 'Socialization Engagement'),
(23, 1, 'Driving Lesson'),
(24, 1, 'Community Tri'),
(25, 1, 'Art Therapy'),
(26, 1, 'Vocational Consul'),
(27, 1, 'Community Services Consult'),
(28, 1, 'Custom');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
