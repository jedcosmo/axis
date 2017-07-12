-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 15, 2016 at 06:32 AM
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
-- Table structure for table `client_forms_radio_checkbox_fields`
--

CREATE TABLE `client_forms_radio_checkbox_fields` (
  `field_id` int(10) UNSIGNED NOT NULL,
  `form_type` varchar(300) NOT NULL,
  `field_type` varchar(300) NOT NULL,
  `field_name` varchar(300) NOT NULL,
  `field_parent_label` varchar(300) DEFAULT NULL,
  `field_label` varchar(300) NOT NULL,
  `field_value` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_forms_radio_checkbox_fields`
--

INSERT INTO `client_forms_radio_checkbox_fields` (`field_id`, `form_type`, `field_type`, `field_name`, `field_parent_label`, `field_label`, `field_value`) VALUES
(1, 'assessment', 'radio', 'physician_order', NULL, 'Yes', 'yes'),
(2, 'assessment', 'radio', 'physician_order', NULL, 'No', 'no'),
(3, 'assessment', 'radio', 'assessment_reason', NULL, 'Initial', 'initial'),
(4, 'assessment', 'radio', 'assessment_reason', NULL, 'Follow up', 'follow_up'),
(5, 'assessment', 'radio', 'primary_diagnosis', NULL, 'SCI', 'sci'),
(6, 'assessment', 'radio', 'primary_diagnosis', NULL, 'MS', 'ms'),
(7, 'assessment', 'radio', 'primary_diagnosis', NULL, 'CP', 'cp'),
(8, 'assessment', 'radio', 'primary_diagnosis', NULL, 'Spina Bifida', 'spina_bifida'),
(9, 'assessment', 'radio', 'primary_diagnosis', NULL, 'MD', 'md'),
(10, 'assessment', 'radio', 'primary_diagnosis', NULL, 'Spinal Stenosis', 'spinal_stenosis'),
(11, 'assessment', 'radio', 'primary_diagnosis', NULL, 'Post-polio', 'post-polio'),
(12, 'assessment', 'radio', 'primary_diagnosis', NULL, 'CVA', 'cva'),
(13, 'assessment', 'radio', 'primary_diagnosis', NULL, 'Amputations', 'amputations'),
(14, 'assessment', 'checkbox', 'secondary_diagnosis', NULL, 'HTN', 'htn'),
(15, 'assessment', 'checkbox', 'secondary_diagnosis', NULL, 'Obesity', 'obesity'),
(16, 'assessment', 'checkbox', 'secondary_diagnosis', NULL, 'Decubitus Ulcers', 'decubitus_ulcers'),
(17, 'assessment', 'checkbox', 'secondary_diagnosis', NULL, 'H/O', 'ho'),
(18, 'assessment', 'checkbox', 'secondary_diagnosis', NULL, 'DM', 'dm'),
(19, 'assessment', 'checkbox', 'secondary_diagnosis', NULL, 'Incontinence Bowel', 'incontinence_bowel'),
(20, 'assessment', 'checkbox', 'secondary_diagnosis', NULL, 'Incontinence Bladder', 'incontinence_bladder'),
(21, 'assessment', 'checkbox', 'secondary_diagnosis', NULL, 'Constipation', 'constipation'),
(22, 'assessment', 'checkbox', 'secondary_diagnosis', NULL, 'SOB', 'sob'),
(23, 'assessment', 'checkbox', 'secondary_diagnosis', NULL, 'Fatigue', 'fatigue'),
(24, 'assessment', 'checkbox', 'physical_limitations', NULL, 'Limited ROM', 'limited_rom'),
(25, 'assessment', 'checkbox', 'physical_limitations', NULL, 'Decreased Strength', 'decreased_strength'),
(26, 'assessment', 'checkbox', 'physical_limitations', NULL, 'Abnormal Vision', 'abnormal_vision'),
(27, 'assessment', 'checkbox', 'physical_limitations', NULL, 'Pulmonary Limitations', 'pulmonary_limitations'),
(28, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Made negative statements', 'made_negative_statements'),
(29, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Persistent anger with self or with others', 'persistent_anger_with_self_or_with_others'),
(30, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Expressions including non-verbal of unrealistic fears', 'expressions_including_non-verbal_of_unrealistic_fears'),
(31, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Repetitive health and anxiety complaints', 'repetitive_health_and_anxiety_complaints'),
(32, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Sad', 'sad'),
(33, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Worried', 'worried'),
(34, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Painful expressions', 'painful_expressions'),
(35, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Crying', 'crying'),
(36, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Tearfulness', 'tearfulness'),
(37, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Withdrawal from activities', 'withdrawal_from_activities'),
(38, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Reduced socialization', 'reduced_socialization'),
(39, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Physical abuse', 'physical_abuse'),
(40, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Socially inappropriate', 'socially_inappropriate'),
(41, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Disruptive behaviors', 'disruptive_behaviors'),
(42, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Tearfulness', 'tearfulness'),
(43, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Inappropriate sexual behavior', 'inappropriate_sexual_behavior'),
(44, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Reduced self-care', 'reduced_self-care'),
(45, 'assessment', 'checkbox', 'mood_and_behavior', NULL, 'Self-reported mood changes', 'self-reported_mood_changes'),
(46, 'assessment', 'checkbox', 'functional_limitations', NULL, 'Limited bed mobility', 'limited_bed_mobility'),
(47, 'assessment', 'checkbox', 'functional_limitations', NULL, 'Poor transfers (including toilet)', 'poor_transfers_(including_toilet)'),
(48, 'assessment', 'checkbox', 'functional_limitations', NULL, 'Poor sitting balance', 'poor_sitting_balance'),
(49, 'assessment', 'checkbox', 'functional_limitations', NULL, 'Abnormal posture', 'abnormal_posture'),
(50, 'assessment', 'checkbox', 'functional_limitations', NULL, 'Poor standing balance', 'poor_standing_balance'),
(51, 'assessment', 'checkbox', 'functional_limitations', NULL, 'Poor standing tolerance', 'poor_standing_tolerance'),
(52, 'assessment', 'checkbox', 'functional_limitations', NULL, 'Poor balance', 'poor_balance'),
(53, 'assessment', 'checkbox', 'functional_limitations', NULL, 'History of Falls (freq)', 'history_of_falls_(freq)'),
(54, 'assessment', 'checkbox', 'functional_limitations', NULL, 'Limited ambulation', 'limited_ambulation'),
(55, 'assessment', 'checkbox', 'functional_limitations', NULL, 'Non-ambulatory', 'non-ambulatory'),
(56, 'assessment', 'checkbox', 'cognitive_skills', NULL, 'Impaired ADL Decision Making', 'impaired_adl_decision_making'),
(57, 'assessment', 'checkbox', 'cognitive_skills', NULL, 'Poor Memory', 'poor_memory'),
(58, 'assessment', 'checkbox', 'cognitive_skills', NULL, 'Poor Comprehension', 'poor_comprehension'),
(59, 'assessment', 'checkbox', 'cognitive_skills', NULL, 'Developmental Delay', 'developmental_delay'),
(60, 'assessment', 'checkbox', 'cognitive_skills', NULL, 'TBI', 'tbi'),
(61, 'assessment', 'checkbox', 'cognitive_skills', NULL, 'Poor Verbal Communication', 'poor_verbal_communication'),
(62, 'assessment', 'radio', 'adl_limitations', 'Meal Preparation', 'Can Prepare', 'can_prepare'),
(63, 'assessment', 'radio', 'adl_limitations', 'Meal Preparation', 'Needs Full Assisstance', 'needs_full_assisstance'),
(64, 'assessment', 'radio', 'adl_limitations', 'Meal Preparation', 'Self Direct', 'self_direct'),
(65, 'assessment', 'radio', 'adl_limitations', 'Chores', 'Able', 'able'),
(66, 'assessment', 'radio', 'adl_limitations', 'Chores', 'Unable', 'unable'),
(67, 'assessment', 'radio', 'adl_limitations', 'Managing Finances', 'Able', 'able'),
(68, 'assessment', 'radio', 'adl_limitations', 'Managing Finances', 'Unable', 'unable'),
(69, 'assessment', 'radio', 'adl_limitations', 'Managing Meds', 'Able', 'able'),
(70, 'assessment', 'radio', 'adl_limitations', 'Managing Meds', 'Unable', 'unable'),
(71, 'assessment', 'radio', 'adl_limitations', 'Phone Use', 'Able', 'able'),
(72, 'assessment', 'radio', 'adl_limitations', 'Phone Use', 'Unable', 'unable'),
(73, 'assessment', 'radio', 'adl_limitations', 'Computer Use', 'Able', 'able'),
(74, 'assessment', 'radio', 'adl_limitations', 'Computer Use', 'Unable', 'unable'),
(75, 'assessment', 'radio', 'adl_limitations', 'Shopping', 'Able', 'able'),
(76, 'assessment', 'radio', 'adl_limitations', 'Shopping', 'Unable', 'unable'),
(77, 'assessment', 'radio', 'adl_limitations', 'Entering and Exiting the Home', 'Able', 'able'),
(78, 'assessment', 'radio', 'adl_limitations', 'Entering and Exiting the Home', 'Unable', 'unable'),
(79, 'assessment', 'radio', 'adl_limitations', 'Managing with Transportation/Travel', 'Able', 'able'),
(80, 'assessment', 'radio', 'adl_limitations', 'Managing with Transportation/Travel', 'Unable', 'unable'),
(81, 'assessment', 'radio', 'adl_limitations', 'Managing with Transportation/Travel', 'Public', 'public'),
(82, 'assessment', 'radio', 'adl_limitations', 'Managing with Transportation/Travel', 'Drives', 'drives'),
(83, 'assessment', 'radio', 'adl_limitations', 'DME Equipment Management', 'Able', 'able'),
(84, 'assessment', 'radio', 'adl_limitations', 'DME Equipment Management', 'Unable', 'unable'),
(85, 'assessment', 'radio', 'adl_limitations', 'Bathing', 'Able', 'able'),
(86, 'assessment', 'radio', 'adl_limitations', 'Bathing', 'Unable', 'unable'),
(87, 'assessment', 'radio', 'adl_limitations', 'Grooming', 'Able', 'able'),
(88, 'assessment', 'radio', 'adl_limitations', 'Grooming', 'Unable', 'unable'),
(89, 'assessment', 'radio', 'adl_limitations', 'Dressing', 'Able', 'able'),
(90, 'assessment', 'radio', 'adl_limitations', 'Dressing', 'Unable', 'unable'),
(91, 'assessment', 'radio', 'vision', NULL, 'Able to see in adequate light', 'able_to_see_in_adequate_light'),
(92, 'assessment', 'radio', 'vision', NULL, 'Minimal', 'minimal'),
(93, 'assessment', 'radio', 'vision', NULL, 'Moderate', 'moderate'),
(94, 'assessment', 'radio', 'vision', NULL, 'Severe', 'severe'),
(95, 'assessment', 'radio', 'hearing', NULL, 'Clear Hearing', 'clear_hearing'),
(96, 'assessment', 'radio', 'hearing', NULL, 'Minimal', 'minimal'),
(97, 'assessment', 'radio', 'hearing', NULL, 'Moderate', 'moderate'),
(98, 'assessment', 'radio', 'hearing', NULL, 'Severe', 'severe'),
(99, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Poor relationships with family', 'poor_relationships_with_family'),
(100, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Poor social relationships with friends', 'poor_social_relationships_with_friends'),
(101, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Participation in social activities', 'participation_in_social_activities'),
(102, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Open', 'open'),
(103, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Fearful', 'fearful'),
(104, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Lonely', 'lonely'),
(105, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Reports abusive relationships', 'reports_abusive_relationships'),
(106, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Change in social activities', 'change_in_social_activities'),
(107, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Length of time alone', 'length_of_time_alone'),
(108, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Life stressor in the last 90 days', 'life_stressor_in_the_last_90_days'),
(109, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Life stressor within last 60 days', 'life_stressor_within_last_60_days'),
(110, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Life stressor within last 60 days', 'life_stressor_within_last_60_days'),
(111, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'No stress', 'no_stress'),
(112, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Tobacco user', 'tobacco_user'),
(113, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Alcohol abuse', 'alcohol_abuse'),
(114, 'assessment', 'checkbox', 'psycho_social_well_being', NULL, 'Narcotics abuse', 'narcotics_abuse'),
(115, 'assessment', 'radio', 'nutritional_issues', NULL, 'Weight loss of 5% 30 days', 'weight_loss_of_5%_30_days'),
(116, 'assessment', 'radio', 'nutritional_issues', NULL, '10% in the last 180 days', '10%_in_the_last_180_days'),
(117, 'assessment', 'radio', 'nutritional_issues', NULL, 'Dehydrated', 'dehydrated'),
(118, 'assessment', 'radio', 'allergies', NULL, 'Yes', 'yes'),
(119, 'assessment', 'radio', 'allergies', NULL, 'No', 'no'),
(120, 'assessment', 'checkbox', 'assistive_services', NULL, 'Home Care', 'home_care'),
(121, 'assessment', 'checkbox', 'assistive_services', NULL, 'Skilled Nursing', 'skilled_nursing'),
(122, 'assessment', 'checkbox', 'assistive_services', NULL, 'House-keeping', 'house-keeping'),
(123, 'assessment', 'checkbox', 'assistive_services', NULL, 'CDPAP', 'cdpap'),
(124, 'assessment', 'checkbox', 'assistive_devices', NULL, 'Manual Chair', 'manual_chair'),
(125, 'assessment', 'checkbox', 'assistive_devices', NULL, 'Powerchair', 'powerchair'),
(126, 'assessment', 'checkbox', 'assistive_devices', NULL, 'Cane', 'cane'),
(127, 'assessment', 'checkbox', 'assistive_devices', NULL, 'Walker', 'walker'),
(128, 'assessment', 'checkbox', 'assistive_devices', NULL, 'Crutches', 'crutches'),
(129, 'assessment', 'checkbox', 'assistive_devices', NULL, 'Hoyer Lift', 'hoyer_lift'),
(130, 'assessment', 'checkbox', 'assistive_devices', NULL, 'Commode', 'commode'),
(131, 'assessment', 'checkbox', 'assistive_devices', NULL, 'Shower Bench', 'shower_bench'),
(132, 'assessment', 'checkbox', 'assistive_devices', NULL, 'Assistive Technology', 'assistive_technology'),
(133, 'assessment', 'radio', 'recent_hospital_visits', NULL, '1 within the past 90 days', '1_within_the_past_90_days'),
(134, 'assessment', 'radio', 'recent_hospital_visits', NULL, '2 within the past 90 days', '2_within_the_past_90_days'),
(135, 'assessment', 'radio', 'recent_hospital_visits', NULL, '3 or more', '3_or_more'),
(136, 'assessment', 'radio', 'recent_er_visits', NULL, '1 within the past 90 days', '1_within_the_past_90_days'),
(137, 'assessment', 'radio', 'recent_er_visits', NULL, '2 within the past 90 days', '2_within_the_past_90_days'),
(138, 'assessment', 'radio', 'recent_er_visits', NULL, '3 or more', '3_or_more'),
(139, 'assessment', 'checkbox', 'hospital_visit_related_to', NULL, 'Urinary Related', 'urinary_related'),
(140, 'assessment', 'checkbox', 'hospital_visit_related_to', NULL, 'Skin/wound Related', 'skinwound_related'),
(141, 'assessment', 'checkbox', 'hospital_visit_related_to', NULL, 'Respiratory Related', 'respiratory_related'),
(142, 'assessment', 'checkbox', 'hospital_visit_related_to', NULL, 'Orthopedic Related', 'orthopedic_related'),
(143, 'assessment', 'checkbox', 'hospital_visit_related_to', NULL, 'Recent surgery', 'recent_surgery'),
(144, 'assessment', 'checkbox', 'supervision_and_assisstance', NULL, 'Transfers', 'transfers'),
(145, 'assessment', 'checkbox', 'supervision_and_assisstance', NULL, 'Eating', 'eating'),
(146, 'assessment', 'checkbox', 'supervision_and_assisstance', NULL, 'Toileting', 'toileting'),
(147, 'assessment', 'checkbox', 'supervision_and_assisstance', NULL, 'Transportation assistance', 'transportation_assistance'),
(148, 'authorization_request', 'checkbox', 'goals', NULL, 'Weight Loss', 'weight_loss'),
(149, 'authorization_request', 'checkbox', 'goals', NULL, 'Increased Strength', 'increased_strength'),
(150, 'authorization_request', 'checkbox', 'goals', NULL, 'Increased Socialization', 'increased_socialization'),
(151, 'authorization_request', 'checkbox', 'goals', NULL, 'Increased Aerobic', 'increased_aerobic'),
(152, 'authorization_request', 'checkbox', 'goals', NULL, 'Improve Transfer', 'improve_transfer'),
(153, 'authorization_request', 'checkbox', 'goals', NULL, 'Increase Wheelchair Mobilization', 'increase_wheelchair_mobilization'),
(154, 'authorization_request', 'checkbox', 'goals', NULL, 'Reduce Hospitalization', 'reduce_hospitalization'),
(155, 'authorization_request', 'checkbox', 'goals', NULL, 'Pursue Education', 'pursue_education'),
(156, 'authorization_request', 'checkbox', 'goals', NULL, 'Pursue Vocation', 'pursue_vocation'),
(157, 'authorization_request', 'checkbox', 'goals', NULL, 'Increased Self Sufficiency', 'increased_self_sufficiency'),
(158, 'authorization_request', 'checkbox', 'goals', NULL, 'Increased Self-Advocacy', 'increased_self-advocacy'),
(159, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Accupuncture', 'accupuncture'),
(160, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Advocacy', 'advocacy'),
(161, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Aerobic Fitness', 'aerobic_fitness'),
(162, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Art Therapy', 'art_therapy'),
(163, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Boxing Training', 'boxing_training'),
(164, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Cardio Training', 'cardio_training'),
(165, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Community Engagement', 'community_engagement'),
(166, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Community Services', 'community_services'),
(167, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Community Trips', 'community_trips'),
(168, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Computer Class', 'computer_class'),
(169, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Cooking Training', 'cooking_training'),
(170, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Counseling', 'counseling'),
(171, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Driving Lessons', 'driving_lessons'),
(172, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Fitness Bands', 'fitness_bands'),
(173, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'General Health & Preventive Care Class', 'general_health_&_preventive_care_class'),
(174, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'HHA Training', 'hha_training'),
(175, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Independent Living Skills Training', 'independent_living_skills_training'),
(176, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Indoor Spinning', 'indoor_spinning'),
(177, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Martial Arts', 'martial_arts'),
(178, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Massage', 'massage'),
(179, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Media Communications Training', 'media_communications_training'),
(180, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Motomed', 'motomed'),
(181, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Nutrition', 'nutrition'),
(182, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Outdoor Hand-cycling', 'outdoor_hand-cycling'),
(183, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Prepared Meals', 'prepared_meals'),
(184, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Rowing', 'rowing'),
(185, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Socialization with Activities', 'socialization_with_activities'),
(186, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Spinal Mobility', 'spinal_mobility'),
(187, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Standing Frame', 'standing_frame'),
(188, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Support Groups', 'support_groups'),
(189, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Vocalization/Educational Training', 'vocalizationeducational_training'),
(190, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Weight Training', 'weight_training'),
(191, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Wheelchair Care', 'wheelchair_care'),
(192, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Wheelchair Mobility', 'wheelchair_mobility'),
(193, 'authorization_request', 'checkbox', 'program_interventions', NULL, 'Yoga', 'yoga');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_forms_radio_checkbox_fields`
--
ALTER TABLE `client_forms_radio_checkbox_fields`
  ADD PRIMARY KEY (`field_id`),
  ADD KEY `form_type` (`form_type`),
  ADD KEY `field_key` (`field_type`),
  ADD KEY `field_name` (`field_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_forms_radio_checkbox_fields`
--
ALTER TABLE `client_forms_radio_checkbox_fields`
  MODIFY `field_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
