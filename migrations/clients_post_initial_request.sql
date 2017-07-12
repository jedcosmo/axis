-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2016 at 07:16 PM
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
-- Table structure for table `clients_post_initial_request`
--

CREATE TABLE `clients_post_initial_request` (
  `post_initial_request_id` int(10) NOT NULL,
  `client_id` int(11) NOT NULL,
  `three_days_a_week` int(1) DEFAULT '0',
  `proposed_start_date` date DEFAULT NULL,
  `proposed_end_date` date DEFAULT NULL,
  `weight_loss` int(1) DEFAULT '0',
  `weight_loss_current_level` text,
  `weight_loss_expected_outcome` text,
  `increased_wheelchair_mobilization` int(1) DEFAULT '0',
  `increased_wheelchair_mobilization_current_level` text,
  `increased_wheelchair_mobilization_expected_outcome` text,
  `improve_transfer` int(1) DEFAULT '0',
  `improve_transfer_current_level` text,
  `improve_transfer_expected_outcome` text,
  `aerobics` int(1) DEFAULT '0',
  `aerobic_times` int(5) DEFAULT NULL,
  `boxing_fitness` int(1) DEFAULT '0',
  `boxing_fitness_times` int(5) DEFAULT NULL,
  `cardio_training` int(1) DEFAULT '0',
  `cardio_training_times` int(5) DEFAULT NULL,
  `fitness_bands` int(1) DEFAULT '0',
  `fitness_bands_times` int(5) DEFAULT NULL,
  `indoor_spinning` int(1) DEFAULT '0',
  `indoor_spinning_times` int(5) DEFAULT NULL,
  `martial_arts` int(1) DEFAULT '0',
  `martial_arts_times` int(5) DEFAULT NULL,
  `nutrition` int(1) DEFAULT '0',
  `nutrition_times` int(5) DEFAULT NULL,
  `outdoor_hand_cycling` int(1) DEFAULT '0',
  `outdoor_hand_cycling_times` int(5) DEFAULT NULL,
  `rowing` int(1) DEFAULT '0',
  `rowing_times` int(5) DEFAULT NULL,
  `spinal_mobility` int(1) DEFAULT '0',
  `spinal_mobility_times` int(5) DEFAULT NULL,
  `standing_frame` int(1) DEFAULT '0',
  `standing_frame_times` int(5) DEFAULT NULL,
  `weight_training` int(1) DEFAULT '0',
  `weight_training_times` int(5) DEFAULT NULL,
  `wheelchair_mobility` int(1) DEFAULT '0',
  `wheelchair_mobility_times` int(5) DEFAULT NULL,
  `one_on_one_instruction` int(1) DEFAULT '0',
  `one_on_one_instruction_times` int(5) DEFAULT NULL,
  `notes` text,
  `completed_by` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `increased_aerobic_function` int(1) DEFAULT '0',
  `increased_aerobic_function_current_level` text,
  `increased_aerobic_function_expected_outcome` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients_post_initial_request`
--

INSERT INTO `clients_post_initial_request` (`post_initial_request_id`, `client_id`, `three_days_a_week`, `proposed_start_date`, `proposed_end_date`, `weight_loss`, `weight_loss_current_level`, `weight_loss_expected_outcome`, `increased_wheelchair_mobilization`, `increased_wheelchair_mobilization_current_level`, `increased_wheelchair_mobilization_expected_outcome`, `improve_transfer`, `improve_transfer_current_level`, `improve_transfer_expected_outcome`, `aerobics`, `aerobic_times`, `boxing_fitness`, `boxing_fitness_times`, `cardio_training`, `cardio_training_times`, `fitness_bands`, `fitness_bands_times`, `indoor_spinning`, `indoor_spinning_times`, `martial_arts`, `martial_arts_times`, `nutrition`, `nutrition_times`, `outdoor_hand_cycling`, `outdoor_hand_cycling_times`, `rowing`, `rowing_times`, `spinal_mobility`, `spinal_mobility_times`, `standing_frame`, `standing_frame_times`, `weight_training`, `weight_training_times`, `wheelchair_mobility`, `wheelchair_mobility_times`, `one_on_one_instruction`, `one_on_one_instruction_times`, `notes`, `completed_by`, `date`, `increased_aerobic_function`, `increased_aerobic_function_current_level`, `increased_aerobic_function_expected_outcome`) VALUES
(2, 3, NULL, '2016-10-28', '2016-10-28', NULL, '', '', NULL, '', '', NULL, '', '', NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, '', '', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients_post_initial_request`
--
ALTER TABLE `clients_post_initial_request`
  ADD PRIMARY KEY (`post_initial_request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients_post_initial_request`
--
ALTER TABLE `clients_post_initial_request`
  MODIFY `post_initial_request_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
