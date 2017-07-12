-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: axis
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clients_initial_assessment`
--

DROP TABLE IF EXISTS `clients_initial_assessment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients_initial_assessment` (
  `post_initial_request_id` int(10) NOT NULL AUTO_INCREMENT,
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
  `increased_aerobic_function_expected_outcome` text,
  `four_days_a_week` int(1) DEFAULT '0',
  `five_days_a_week` int(1) DEFAULT '0',
  `increased_strength` int(1) DEFAULT '0',
  `increased_strength_current_level` text,
  `increased_strength_expected_outcome` text,
  `increased_self_sufficiency` int(1) DEFAULT '0',
  `increased_self_sufficiency_current_level` text,
  `increased_self_sufficiency_expected_outcome` text,
  `increased_socialization` int(1) DEFAULT '0',
  `increased_socialization_current_level` text,
  `increased_socialization_expected_outcome` text,
  `reduced_hospitalization` int(1) DEFAULT '0',
  `reduced_hospitalization_current_level` text,
  `reduced_hospitalization_expected_outcome` text,
  `pursue_vocation` int(1) DEFAULT '0',
  `pursue_vocation_current_level` text,
  `pursue_vocation_expected_outcome` text,
  `pursue_education` int(1) DEFAULT '0',
  `pursue_education_current_level` text,
  `pursue_education_expected_outcome` text,
  `increased_self_advocacy` int(1) DEFAULT '0',
  `increased_self_advocacy_current_level` text,
  `increased_self_advocacy_expected_outcome` text,
  `acupuncture` int(1) DEFAULT '0',
  `acupuncture_times` int(5) DEFAULT NULL,
  `advocacy` int(1) DEFAULT '0',
  `advocacy_times` int(5) DEFAULT NULL,
  `art_therapy` int(1) DEFAULT '0',
  `art_therapy_times` int(5) DEFAULT NULL,
  `communications` int(1) DEFAULT '0',
  `communications_times` int(5) DEFAULT NULL,
  `community_engagement` int(1) DEFAULT '0',
  `community_engagement_times` int(5) DEFAULT NULL,
  `community_services` int(1) DEFAULT '0',
  `community_services_times` int(5) DEFAULT NULL,
  `community_trips` int(1) DEFAULT '0',
  `community_trips_times` int(5) DEFAULT NULL,
  `computer_class` int(1) DEFAULT '0',
  `computer_class_times` int(5) DEFAULT NULL,
  `cooking_training` int(1) DEFAULT '0',
  `cooking_training_times` int(5) DEFAULT NULL,
  `counseling_media` int(1) DEFAULT '0',
  `counseling_media_times` int(5) DEFAULT NULL,
  `driving_lessons` int(1) DEFAULT '0',
  `driving_lessons_times` int(5) DEFAULT NULL,
  `general_health` int(1) DEFAULT '0',
  `general_health_times` int(5) DEFAULT NULL,
  `hha_training` int(1) DEFAULT '0',
  `hha_training_times` int(5) DEFAULT NULL,
  `independent_living_skills` int(1) DEFAULT '0',
  `independent_living_skills_times` int(5) DEFAULT NULL,
  `massage` int(1) DEFAULT '0',
  `massage_times` int(5) DEFAULT NULL,
  `motomed` int(1) DEFAULT '0',
  `motomed_times` int(5) DEFAULT NULL,
  `prepared_meals` int(1) DEFAULT '0',
  `prepared_meals_times` int(5) DEFAULT NULL,
  `socialization_with_activities` int(1) DEFAULT '0',
  `socialization_with_activities_times` int(5) DEFAULT NULL,
  `vocational_consultation` int(1) DEFAULT '0',
  `vocational_consultation_times` int(5) DEFAULT NULL,
  `educational_consultation` int(1) DEFAULT '0',
  `educational_consultation_times` int(5) DEFAULT NULL,
  `wheelchair_care` int(1) DEFAULT '0',
  `wheelchair_care_times` int(5) DEFAULT NULL,
  `wheelchair_loan` int(1) DEFAULT '0',
  `wheelchair_loan_times` int(5) DEFAULT NULL,
  `yoga` int(1) DEFAULT '0',
  `yoga_times` int(5) DEFAULT NULL,
  `number_of_days_per_week` int(1) DEFAULT '0',
  PRIMARY KEY (`post_initial_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients_initial_assessment`
--

LOCK TABLES `clients_initial_assessment` WRITE;
/*!40000 ALTER TABLE `clients_initial_assessment` DISABLE KEYS */;
INSERT INTO `clients_initial_assessment` VALUES (2,3,0,'2016-10-28','2016-10-28',0,'','',0,'','',0,'','',0,NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','',NULL,0,NULL,NULL,0,0,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0),(5,4,1,'2016-11-09','2016-11-18',1,'asdasd','asdasd',0,'asdasd','asdasd',0,'asdas','dasdasd',0,NULL,0,2,0,2,0,2,0,2,0,2,0,2,0,2,0,2,0,2,0,2,0,2,0,2,0,2,'asdasdasdasdasd','asdasdasd',NULL,0,NULL,NULL,0,0,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0),(7,10,1,'2016-11-02','2016-11-02',1,'asd','asd',0,'asd','asd',0,'asd','asd',0,NULL,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,0,3,'asd','asd',NULL,0,NULL,NULL,0,0,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0),(8,1,0,'0000-00-00','0000-00-00',0,'','',0,'','',1,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','','0000-00-00',0,'','',0,0,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0),(20,14,1,'2016-11-07','2016-11-10',1,'asd','asd',1,'asd','asd',1,'asd','asd',1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,'asd','asd','2016-11-15',1,'asd','asd',0,0,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0),(21,15,0,'0000-00-00','0000-00-00',0,'','',0,'','',0,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','','0000-00-00',0,'','',0,0,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0,NULL,0),(23,12,0,'2016-11-24','2016-12-01',1,'xxx','xxx',1,'xxx','xxx',1,'xxx','xxx',1,3,1,3,1,3,1,3,1,3,1,3,1,6,1,3,1,3,1,3,1,3,1,3,1,3,1,3,'asdasdasdasdasdas','sdfsdfsdf','2016-11-23',1,'xxx','xxx',0,0,1,'xxx','xxx',1,'xxx','xxx',1,'xxx','xxx',1,'xxx','xxx',1,'xxx','xxx',1,'xxx','xxx',1,'xxx','xxx',1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,1,3,4);
/*!40000 ALTER TABLE `clients_initial_assessment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-24 19:36:15
