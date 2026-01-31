-- GM Legacy School Database Setup
-- Create database
CREATE DATABASE IF NOT EXISTS `gm_legacy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the database
USE `gm_legacy`;

-- Create enquiry_form table
CREATE TABLE IF NOT EXISTS `enquiry_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `class_seeking` varchar(50) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `residential_address` text NOT NULL,
  `source_newspaper` tinyint(1) DEFAULT 0,
  `source_website` tinyint(1) DEFAULT 0,
  `source_friends_relatives` tinyint(1) DEFAULT 0,
  `source_social_media` tinyint(1) DEFAULT 0,
  `source_others` varchar(100) DEFAULT NULL,
  `remarks_queries` text DEFAULT NULL,
  `signature` varchar(100) NOT NULL,
  `signature_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email_id`),
  KEY `idx_contact` (`contact_number`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create admission_applications table
CREATE TABLE IF NOT EXISTS `admission_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_no` varchar(50) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `age_as_on_june` int(3) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `religion_community` varchar(100) DEFAULT NULL,
  `mother_tongue` varchar(100) NOT NULL,
  `aadhaar_number` varchar(12) DEFAULT NULL,
  `class_sought` varchar(50) NOT NULL,
  `previous_school` varchar(100) DEFAULT NULL,
  `medium_of_instruction` varchar(50) NOT NULL,
  `fathers_name` varchar(100) NOT NULL,
  `fathers_qualification` varchar(100) NOT NULL,
  `fathers_occupation` varchar(100) NOT NULL,
  `fathers_mobile` varchar(20) NOT NULL,
  `mothers_name` varchar(100) NOT NULL,
  `mothers_qualification` varchar(100) NOT NULL,
  `mothers_occupation` varchar(100) NOT NULL,
  `mothers_mobile` varchar(20) NOT NULL,
  `annual_family_income` varchar(50) DEFAULT NULL,
  `residential_address` text NOT NULL,
  `emergency_contact` varchar(20) NOT NULL,
  `parent_signature` varchar(100) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `declaration_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_application_no` (`application_no`),
  KEY `idx_academic_year` (`academic_year`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
