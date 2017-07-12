-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 07, 2016 at 06:30 AM
-- Server version: 5.7.12-0ubuntu1.1
-- PHP Version: 7.0.8-2+deb.sury.org~xenial+1

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
-- Table structure for table `clients_status_information`
--

CREATE TABLE `clients_status_information` (
  `status_ID` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `medicare_eligibility` tinyint(1) DEFAULT NULL,
  `medicare_eligibility_active` tinyint(1) DEFAULT NULL,
  `medicaid_eligibility` tinyint(1) DEFAULT NULL,
  `medicaid_number` varchar(250) DEFAULT NULL,
  `community_status` varchar(250) DEFAULT NULL,
  `marital_status` varchar(200) DEFAULT NULL,
  `highest_completed_education` varchar(200) DEFAULT NULL,
  `employment_status` tinyint(10) DEFAULT NULL,
  `internet_access` tinyint(10) DEFAULT NULL,
  `type_of_income` varchar(200) DEFAULT NULL,
  `other_income` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients_status_information`
--
ALTER TABLE `clients_status_information`
  ADD PRIMARY KEY (`status_ID`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients_status_information`
--
ALTER TABLE `clients_status_information`
  MODIFY `status_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients_status_information`
--
ALTER TABLE `clients_status_information`
  ADD CONSTRAINT `clients_status_information_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
