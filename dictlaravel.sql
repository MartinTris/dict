-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 10:31 AM
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
-- Database: `dictlaravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bplos`
--

CREATE TABLE IF NOT EXISTS `bplos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province` varchar(255) NOT NULL,
  `municipality_city` varchar(255) NOT NULL,
  `bpco_status` enum('ON GOING DATA BUILD UP','FOR PILOT TESTING','ETRACS/Others','OPERATIONAL','PENDING') NOT NULL,
  `remarks` text DEFAULT NULL,
  `congressional_district` enum('1ST DISTRICT','2ND DISTRICT','3RD DISTRICT','4TH DISTRICT','5TH DISTRICT','6TH DISTRICT','7TH DISTRICT','8TH DISTRICT') NOT NULL,
  `income_class` enum('CITY','1st Class','2nd Class','3rd Class','4th Class','5th Class') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bplos`
--

INSERT INTO `bplos` (`id`, `province`, `municipality_city`, `bpco_status`, `remarks`, `congressional_district`, `income_class`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Cavite', 'Alfonso', 'ON GOING DATA BUILD UP', 'Complete Documents', '8TH DISTRICT', '1st Class', '2025-05-16 01:18:17', '2025-05-16 01:18:17', 1),
(2, 'Cavite', 'Amadeo', 'FOR PILOT TESTING', 'follow up LGU', '7TH DISTRICT', '4th Class', '2025-05-16 01:18:52', '2025-05-16 01:23:15', 1),
(3, 'Cavite', 'Bacoor', 'ETRACS/Others', NULL, '2ND DISTRICT', 'CITY', '2025-05-16 01:19:18', '2025-05-16 01:19:18', 1),
(4, 'Cavite', 'Carmona', 'ETRACS/Others', NULL, '2ND DISTRICT', '1st Class', '2025-05-16 01:19:50', '2025-05-16 01:23:25', 1),
(5, 'Cavite', 'Cavite City', 'ETRACS/Others', NULL, '1ST DISTRICT', 'CITY', '2025-05-16 01:20:14', '2025-05-16 01:20:14', 1),
(6, 'Cavite', 'City of Tagaytay', 'PENDING', NULL, '8TH DISTRICT', 'CITY', '2025-05-16 01:21:16', '2025-05-16 01:21:16', 1),
(7, 'Cavite', 'Dasmariñas', 'PENDING', NULL, '4TH DISTRICT', 'CITY', '2025-05-16 01:21:36', '2025-05-16 01:21:36', 1),
(8, 'Cavite', 'Gen. Emilio Aguinaldo', 'PENDING', NULL, '8TH DISTRICT', '5th Class', '2025-05-16 01:22:55', '2025-05-16 01:32:00', 1),
(9, 'Cavite', 'Gen. Mariano Alvarez', 'ETRACS/Others', NULL, '6TH DISTRICT', 'CITY', '2025-05-16 01:24:21', '2025-05-16 01:24:21', 1),
(10, 'Cavite', 'General Trias', 'ETRACS/Others', NULL, '6TH DISTRICT', 'CITY', '2025-05-16 01:25:00', '2025-05-16 01:25:00', 1),
(11, 'Cavite', 'Imus', 'ETRACS/Others', NULL, '3RD DISTRICT', 'CITY', '2025-05-16 01:25:33', '2025-05-16 01:25:33', 1),
(12, 'Cavite', 'Indang', 'PENDING', NULL, '7TH DISTRICT', '1st Class', '2025-05-16 01:25:55', '2025-05-16 01:25:55', 1),
(13, 'Cavite', 'Kawit', 'ETRACS/Others', NULL, '1ST DISTRICT', '1st Class', '2025-05-16 01:26:39', '2025-05-16 01:26:39', 1),
(14, 'Cavite', 'Magallanes', 'OPERATIONAL', 'Launching April 11, 2023', '8TH DISTRICT', '4th Class', '2025-05-16 01:27:19', '2025-05-16 01:27:19', 1),
(15, 'Cavite', 'Maragondon', 'PENDING', NULL, '8TH DISTRICT', '3rd Class', '2025-05-16 01:27:48', '2025-05-16 01:27:48', 1),
(16, 'Cavite', 'Mendez', 'ETRACS/Others', NULL, '8TH DISTRICT', '4th Class', '2025-05-16 01:28:18', '2025-05-16 01:28:18', 1),
(17, 'Cavite', 'Naic', 'OPERATIONAL', NULL, '8TH DISTRICT', '1st Class', '2025-05-16 01:28:45', '2025-05-16 01:28:45', 1),
(18, 'Cavite', 'Noveleta', 'PENDING', NULL, '1ST DISTRICT', '3rd Class', '2025-05-16 01:29:12', '2025-05-16 01:29:12', 1),
(19, 'Cavite', 'Rosario', 'PENDING', NULL, '1ST DISTRICT', '1st Class', '2025-05-16 01:29:58', '2025-05-16 01:29:58', 1),
(20, 'Cavite', 'Silang', 'PENDING', NULL, '5TH DISTRICT', '1st Class', '2025-05-16 01:30:31', '2025-05-16 01:30:31', 1),
(21, 'Cavite', 'Tanza', 'PENDING', NULL, '7TH DISTRICT', '1st Class', '2025-05-16 01:30:51', '2025-05-16 01:30:51', 1),
(22, 'Cavite', 'Ternate', 'PENDING', NULL, '8TH DISTRICT', '4th Class', '2025-05-16 01:31:15', '2025-05-16 01:31:15', 1),
(23, 'Cavite', 'Trece Martires', 'ETRACS/Others', NULL, '7TH DISTRICT', 'CITY', '2025-05-16 01:32:27', '2025-05-16 01:32:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cybersecurities`
--

CREATE TABLE IF NOT EXISTS `cybersecurities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_conducted` date NOT NULL,
  `time_conducted` varchar(255) NOT NULL,
  `organizer` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `activity_title` varchar(255) NOT NULL,
  `type_of_activity` enum('Cyber Advocacies','CERT Trainings') NOT NULL,
  `mode_of_implementation` varchar(255) NOT NULL,
  `zoom_link` varchar(255) DEFAULT NULL,
  `male_participants` int(11) NOT NULL,
  `female_participants` int(11) NOT NULL,
  `total_participants` int(11) GENERATED ALWAYS AS (`male_participants` + `female_participants`) VIRTUAL,
  `participant_details` text DEFAULT NULL,
  `resource_person` varchar(255) NOT NULL,
  `fb_posting` varchar(255) DEFAULT NULL,
  `number_of_engagement` int(11) DEFAULT NULL,
  `list_of_engaged_partners` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cybersecurities`
--

INSERT INTO IF NOT EXISTS `cybersecurities` (`id`, `date_conducted`, `time_conducted`, `organizer`, `province`, `activity_title`, `type_of_activity`, `mode_of_implementation`, `zoom_link`, `male_participants`, `female_participants`, `participant_details`, `resource_person`, `fb_posting`, `number_of_engagement`, `list_of_engaged_partners`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '2025-01-16', '10:00 AM - 12:00 PM', 'Cavite', 'Cavite', 'Cybersecurity Awareness for BJMP Trece Martires City Jail Personnel', 'Cyber Advocacies', 'Onsite: BJMP Trece Martires Tech4Ed Center/function hall', NULL, 35, 28, 'NGA - 35 (28M,7F)', 'John Vandrick Diaz', 'https://www.facebook.com/share/p/14e2zwjGY7/', 1, 'BJMP Trece Martires', '2025-05-16 00:52:49', '2025-05-16 00:59:00', 1),
(2, '2025-01-17', '1:00 PM - 4:00 PM', 'Cavite', 'Cavite', 'Cybersecurity Awareness at Eulogio \"Amang\" Rodriguez Institute of Science and Technology (EARIST) Cavite Campus', 'Cyber Advocacies', 'Onsite: EARIST Cavite Function Hall', NULL, 148, 54, '202 (148M, 54F)', 'John Vandrick Diaz', 'https://www.facebook.com/share/p/1DE1H66NBM/', 1, 'EARIST CAVITE', '2025-05-16 00:58:19', '2025-05-16 00:58:19', 1),
(3, '2025-02-13', '9:00 AM - 12:00 NN', 'Cavite', 'Cavite', 'Cyber-Safe Love: Protecting Yourself from Online Scams & Digital Threats', 'Cyber Advocacies', 'Onsite: AVR, Lyceum of Southern Luzon - Balayan, Balayan, Batangas', 'https://us06web.zoom.us/j/87806142732?pwd=Z58oJUewltEFwxOOhgteuaVa6ZDDxI.1', 52, 53, 'Others -105 (52M.53F)', 'John Vandrick Diaz and John Philip Tan', 'https://www.facebook.com/share/p/17EYcapeQS/', NULL, NULL, '2025-05-16 01:01:57', '2025-05-16 01:01:57', 1),
(4, '2025-02-28', '8:00 AM - 12:00 PM', 'Cavite', 'Cavite', 'Elevate your Cyber Defense: Take Control of Your Online Security, & Basic Network Security', 'Cyber Advocacies', 'Onsite: DICT Tech4ED Center Milagrosa, Milagrosa Homes Carmona City, Cavite', NULL, 4, 6, 'SUC - 10 (4M,6F)', 'John Vandrick Diaz', NULL, NULL, NULL, '2025-05-16 01:03:51', '2025-05-16 01:03:51', 1),
(5, '2025-03-03', '8:00 AM  -  10:00AM', 'Cavite', 'Cavite', 'Cybersecurity Awareness Seminar for BJMP Dasmariñas City Jail Male Dorm Personnel and Persons Deprived of Liberty', 'Cyber Advocacies', 'Onsite: BJMP Dasmariñas City Jail, Dasmariñas City, Cavite', NULL, 52, 12, 'NGA - 39 (27M,12F) Others - 25(25M)', 'John Vandrick Diaz', 'https://www.facebook.com/share/p/15sWo7FBoB/', 1, 'BJMP Dasmariñas City Jail', '2025-05-16 01:05:50', '2025-05-16 01:05:50', 1),
(6, '2025-03-18', '8:00 AM - 12:00 NN', 'Cavite', 'Cavite', 'Cybersecurity Awareness for Local Disaster Risk Reduction Management Offices of Cavite', 'Cyber Advocacies', 'Onsite: OPCDO, Old Provincial Capitol Building', NULL, 24, 17, 'NGA - 3(2M, 1F) LGU - 30 (17M, 13F) -  Others - 8 (5M, 3F)', 'John Vandrick Diaz', 'https://www.facebook.com/share/p/19apwxsEna/', 22, 'OCD CALABARZON, OPDRRMO, OPCDO, CDRRMO Tagaytay, MDRRMO Naic, CDRRMO Carmona, CDRRMO Bacoor, MDRRMO Mendez, MDRRMO Indang, CDRRMO Trece Martires, MDRRMO Amadeo, MDRRMO Indang, MDRRMO Ternate, CDRRMO Imus, MDRRMO Tanza, CDRRMO Kawit, MDRRMO Silang\r\nMDRRMO Tanza, CDRRMO Gen. Trias, MDRRMO Magallanes, MDRRMO, General Mariano Alvares, MDRRMO General Emillo Aguinaldo', '2025-05-16 01:08:55', '2025-05-16 01:08:55', 1),
(7, '2025-03-18', '8:00 AM - 12:00 NN', 'Cavite', 'Cavite', 'Empowering Women: Building Resilience in a Digital Age', 'Cyber Advocacies', 'Onsite: SB Session Hall, Municipal Bldg., Mendez-Nuñez, Cavite', NULL, 6, 56, 'LGU - 12 (6M, 6F) SUC -', 'John Philip Tan', NULL, 3, 'MSWDO-Mendez, Tagaytay-Mendez Academy, St. Agustin School Mendez', '2025-05-16 01:11:59', '2025-05-16 01:11:59', 1),
(8, '2025-03-27', '8:00 AM - 12:00 PM', 'Cavite', 'Cavite', 'Security in your Hands: Elevating your Digital Defense', 'Cyber Advocacies', 'Onsite: Philippine Christian University Dasmariñas, Dasmariñas City, Cavite', NULL, 20, 12, 'SUC - 32 (20M, 12F)', 'John Vandrick Diaz', 'https://www.facebook.com/share/p/1934qRxu2V/', 1, 'Philippine Christian University Dasmariñas COI Computer Society', '2025-05-16 01:14:02', '2025-05-16 01:14:02', 1),
(9, '2025-03-28', '9:00 AM - 12:00 NN', 'Cavite', 'Cavite', 'Empowering Caviteñas in the Digital Age: Strengthening Cyber Resilience for a Safer Future', 'Cyber Advocacies', 'Online: Zoom', 'https://us06web.zoom.us/meeting/register/N63JjAOMTwyekZ85_lY2ww', 27, 29, 'Others - 56 (27M, 29F)', 'John Vandrick Diaz', NULL, NULL, NULL, '2025-05-16 01:16:00', '2025-05-16 01:16:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fw4as`
--

CREATE TABLE IF NOT EXISTS `fw4as` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ibpls`
--

CREATE TABLE IF NOT EXISTS `ibpls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) NOT NULL,
  `operation` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ibpls`
--

INSERT INTO IF NOT EXISTS `ibpls` (`id`, `location`, `operation`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Alfonso', 'Operational', 'Integrated', '2025-04-25 05:41:26', '2025-04-25 05:41:26', 1),
(2, 'Amadeo', 'Operational', 'Integrated', '2025-04-25 05:45:26', '2025-04-25 05:45:26', 1),
(3, 'Bacoor', 'ETRACS/Others', 'Pending', '2025-04-25 05:45:52', '2025-04-25 05:45:52', 1),
(4, 'Carmona', 'ETRACS/Others', 'Pending', '2025-04-25 05:46:11', '2025-04-25 05:46:11', 1),
(5, 'Cavite City', 'ETRACS/Others', 'Pending', '2025-04-25 05:46:48', '2025-04-25 05:46:48', 1),
(7, 'City of Dasmariñas', 'ETRACS/Others', 'Pending', '2025-04-25 05:50:55', '2025-04-25 05:50:55', 1),
(8, 'City of Tagaytay', 'Ongoing eLGU V2', 'Pending', '2025-04-25 06:02:22', '2025-04-25 06:02:22', 1),
(9, 'Gen. Emilio Aguinaldo', 'Operational', 'Integrated', '2025-04-25 06:05:03', '2025-04-25 06:05:03', 1),
(10, 'General Mariano Alvarez', 'ETRACS/Others', 'Pending', '2025-04-25 06:10:41', '2025-04-25 06:10:57', 1),
(11, 'General Trias', 'ETRACS/Others', 'Pending', '2025-04-25 06:11:12', '2025-04-25 06:11:12', 1),
(12, 'Imus', 'ETRACS/Others', 'Pending', '2025-04-25 06:11:43', '2025-04-25 06:11:43', 1),
(13, 'Indang', 'Operational', 'Pending', '2025-04-25 06:12:25', '2025-04-25 06:12:25', 1),
(14, 'Kawit', 'ETRACS/Others', 'Pending', '2025-04-25 06:12:50', '2025-04-25 06:12:50', 1),
(15, 'Magallanes', 'Operational', 'Pending', '2025-04-25 06:13:05', '2025-04-25 06:13:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ilcdbs`
--

CREATE TABLE IF NOT EXISTS `ilcdbs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO IF NOT EXISTS `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_03_05_060058_create_users_list_table', 1),
(6, '2025_04_25_120643_create_ibpls_table', 2),
(8, '2025_05_05_101548_create_tech4eds_table', 3),
(12, '2025_05_12_114052_create_pnpkis_table', 4),
(18, '2025_05_15_063520_create_cybersecurities_table', 5),
(19, '2025_05_16_075640_create_bplos_table', 5),
(20, '2025_05_20_054749_create_fw4as_table', 6),
(21, '2025_05_20_054854_create_ilcdbs_table', 6),
(22, '2025_05_20_054923_create_sparks_table', 6),
(23, '2025_05_20_054955_add_user_id_to_all_tables', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pnpkis`
--

CREATE TABLE IF NOT EXISTS `pnpkis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_conducted` date NOT NULL,
  `time_conducted` varchar(255) NOT NULL,
  `organizer` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `activity_title` varchar(255) NOT NULL,
  `type_of_activity` varchar(255) NOT NULL,
  `mode_of_implementation` varchar(255) NOT NULL,
  `zoom_link` varchar(255) DEFAULT NULL,
  `male_participants` int(11) NOT NULL,
  `female_participants` int(11) NOT NULL,
  `total_participants` int(11) NOT NULL,
  `participant_details` text NOT NULL,
  `resource_person` varchar(255) NOT NULL,
  `fb_posting` varchar(255) DEFAULT NULL,
  `number_of_engagement` int(11) DEFAULT NULL,
  `list_of_engaged_partners` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ;

--
-- Dumping data for table `pnpkis`
--

INSERT INTO IF NOT EXISTS `pnpkis` (`id`, `date_conducted`, `time_conducted`, `organizer`, `province`, `activity_title`, `type_of_activity`, `mode_of_implementation`, `zoom_link`, `male_participants`, `female_participants`, `total_participants`, `participant_details`, `resource_person`, `fb_posting`, `number_of_engagement`, `list_of_engaged_partners`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '2024-01-15', '10:00 am - 1:00 pm', 'Cavite', 'Cavite', 'PNPKI Orientation for Eulogio \"Amang\" Rodriguez Institute of Science and Technology (EARIST) General Mariano Alvarez, Cavite', 'PNPKI Orientation', 'Onsite: EARIST, GMA Cavite', 'N/A', 148, 54, 202, '202(148M, 54F)', 'John Vandrick Diaz', 'https://www.facebook.com/share/p/1DE1H66NBM/', 1, 'EARIST Cavite, General Mariano ALvarez, Cavite', '2025-05-12 06:22:39', '2025-05-12 06:22:39', 1),
(2, '2025-02-10', '1:00 pm - 4:00 pm', 'Cavite', 'Cavite', 'PNPKI Orientation for BJMP Dasmariñas City Jail Female Dorm Personnel', 'PNPKI Orientation', 'Onsite: DICT Tech4ED Center Dasmariñas City Jail', 'N/A', 4, 10, 14, '14 (4M, 10F)', 'John Vandrick Diaz', 'https://www.facebook.com/share/p/15e7qVjtbn/', 1, 'BJMP Dasmariñas City Jail, Female Dorm', '2025-05-12 06:26:19', '2025-05-12 06:26:19', 1),
(3, '2025-03-03', '10:00 AM - 12:00 NN', 'Cavite', 'Cavite', 'PNPKI Orientation for BJMP Dasmariñas City Jail Male Dorm Personnel', 'PNPKI Orientation', 'Onsite: BJMP Dasmariñas City', 'N/A', 39, 12, 51, '51(39M, 12F)', 'John Vandrick Diaz', 'https://www.facebook.com/share/p/15w5MFwBV2/', 1, 'BJMP Dasmariñas City Jail, Male Dorm', '2025-05-12 06:30:15', '2025-05-12 06:30:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sparks`
--

CREATE TABLE IF NOT EXISTS `sparks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tech4eds`
--

CREATE TABLE IF NOT EXISTS `tech4eds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `congressional_district` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `specific_center_location` varchar(255) NOT NULL,
  `center_name` varchar(255) NOT NULL,
  `center_model` enum('FITS','LGU','LIBRARY','Negosyo Center','NGA','Private','Provincial Training Center','RIS','School','Mobile','BJMP') NOT NULL,
  `cm_name` varchar(255) NOT NULL,
  `cm_email` varchar(255) NOT NULL,
  `cm_mobile` varchar(255) NOT NULL,
  `cm_sex` enum('Male','Female','N/A') NOT NULL,
  `date_of_launching` date NOT NULL,
  `operational` enum('Yes','No','Unverified') NOT NULL,
  `with_donation` enum('Yes','No','Unverified') NOT NULL,
  `type_of_donation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tech4eds`
--

INSERT INTO `tech4eds` (`id`, `congressional_district`, `municipality`, `specific_center_location`, `center_name`, `center_model`, `cm_name`, `cm_email`, `cm_mobile`, `cm_sex`, `date_of_launching`, `operational`, `with_donation`, `type_of_donation`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '8th', 'Alfonso', 'Municipal Bldg.', 'Municipality of Alfonso Tech4ED Center', 'LGU', 'Mylene V. Quilala', 'lgualfonso.alfonso@gmail.com', '0909-248-7428', 'Female', '2017-01-23', 'No', 'No', 'Unverified', NULL, NULL, 1),
(2, '5th', 'Carmona', 'Brgy. Mabuhay, Carmona, Cavite', 'Mabuhay Tech4ED Center (Carmona)', 'LGU', 'Emanuel Loyola', 'noliemauel.mabuhaycarmona@gmail.com', '0916-228-8688', 'Male', '2015-07-09', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(3, '5th', 'Carmona', 'Abandoned Rd., Brgy Bancal, Carmona, Cavite', 'Brgy. Bancal Tech4ED Center', 'LGU', 'Grace Mercado', 'gracemercado.bancalcarmona@gmail.com', '0927-460-1821', 'Female', '2015-07-09', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(4, '5th', 'Carmona', 'Brgy. Lantic Baranggay Hall, Carmona, Cavite', 'Brgy. Lantic Tech4ED Center', 'LGU', 'James Louie M. Lejos', 'jameslouielejos@gmail.com', '0906-252-1324', 'Male', '2015-07-09', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(5, '5th', 'Carmona', 'Ground Floor, Brgy Hall, Milagrosa, Carmona, Cavite', 'Brgy. Milagrosa Tech4ED Center', 'LGU', 'Unverified', 'yatzu_2thuy@yahoo.com', '0936-510-2657', 'Male', '2015-07-09', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(6, '5th', 'Carmona', 'Unverified', 'Carmona eLibrary Tech4ED Center', 'LIBRARY', 'Vergel Lot', 'vergellot.elibrary8carmona@gmail.com', '0926-919-7978', 'Male', '2015-07-10', 'No', 'No', 'Unverified', NULL, NULL, 1),
(7, '5th', 'Carmona', 'Carmona Elementary School, PDAO', 'Carmona PDAO Tech4ED Center', 'LGU', 'Eric Tolentino', 'tech4ed.pdaocarmona@gmail.com', '0995-419-9708', 'Male', '2015-07-11', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(8, '5th', 'Carmona', 'BML Bldg II Mun Hall', 'Katsumi Onda Tech4ED Center', 'LGU', 'Gringo Maquinay', 'gringomaquinay@carmona.gov.ph', '0926-929-3131', 'Male', '2015-07-12', 'Yes', 'Yes', 'Unverified', NULL, NULL, 1),
(9, '5th', 'Carmona', 'Brgy. Hall', 'Brgy. Cabilang Baybay Tech4Ed Center', 'LGU', 'Arnold G. Legacion', 'legacion314@gmail.com', '0935-931-8354', 'Male', '2016-08-08', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(10, '5th', 'Carmona', 'Pob 8', 'Carmona ALS Tech4Ed', 'School', 'Janneth D. Ledesma', 'tech4edals.carmona@gmail.com', '0998-466-4019', 'Female', '2016-08-08', 'No', 'No', 'Unverified', NULL, NULL, 1),
(11, '5th', 'Carmona', 'Brgy. Mabuhay, RIS bldg., Carmona, Cavite', 'BML Carmona Tech4ED RIS Center', 'RIS', 'vergel cruz lot', 'vergellot.elibrary8carmona@gmail.com', '0', 'Male', '2017-03-03', 'Yes', 'Yes', 'RIS', NULL, NULL, 1),
(12, '4th', 'Dasmariñas City', 'Unverified', 'Dasma II Central School Tech4Ed', 'School', 'Ma. Francesca C. Fadri', 'francescafadri.depeddasma@gmail.com', '0995-351-8447', 'Female', '2016-11-29', 'No', 'No', 'Unverified', NULL, NULL, 1),
(13, '4th', 'Dasmariñas City', 'Unverified', 'Francisco E Barzaga Memorial School Tech4ED Center', 'School', 'Karen PatriciaV. Villaruel', 'karenvillaruel.depedpasma@gmail.com', '0949-693-6482', 'Female', '2017-03-03', 'No', 'No', 'Unverified', NULL, NULL, 1),
(14, '4th', 'Dasmariñas City', 'Unverified', 'San Nicolas Elem Sch Tech4Ed', 'School', 'Virginia C. Cerrado', 'virginiacerrado.depeddasma@gmail.com', '0906-319-5395', 'Female', '2016-11-29', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(15, '4th', 'Dasmariñas City', 'Unverified', 'Sta Cristina Elem Sch Tech4Ed', 'School', 'Chonalyn H. Chavez', 'chonalynchavez.depeddasma@gmail.com', '0918-229-9266', 'Female', '2016-11-29', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(16, '4th', 'Dasmariñas City', 'Unverified', 'Salawag Elem Sch Tech4Ed', 'School', 'Consolacion P. Tag', 'consolaciontag.depeddasma@gmail.com', '0927-844-2393', 'Female', '2016-12-02', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(17, '4th', 'Dasmariñas City', 'Unverified', 'Dasma West Nat\'l High School Tech4Ed', 'School', 'Zenaida Dordas', 'zenaidadordas.depeddasma@gmail.com', '0932-727-9292', 'Female', '2016-12-02', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(18, '4th', 'Dasmariñas City', 'Unverified', 'San Gabriel Elem Sch Tech4Ed', 'School', 'Melanie B. Cantoria', 'melanie.cantoria@deped.gov.ph', '0947-314-3893', 'Female', '2016-11-29', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(19, '4th', 'Dasmariñas City', 'Unverified', 'City Schools Division of Dasmariñas Tech4ED Center', 'School', 'Serma Hernandez', 'serma.hernandez@deped.gov.ph', '9057358210', 'Female', '2016-11-29', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(20, '4th', 'Dasmariñas City', 'Unverified', 'Dasmariñas National High School Tech4ED Center', 'School', 'Richie Salubre', 'richie.salubre@deped.gov.ph', '9213880309', 'Male', '2016-11-29', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(21, '6th', 'General Trias City', '2nd Floor', 'City Library General Trias Tech4ED Center', 'LIBRARY', 'Unverified', 'Unverified', '0', '', '2017-04-19', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(22, '5th', 'Gma', 'Unverified', 'Brgy Pob. 5 Tech4Ed Center', 'LGU', 'Ma .Cristina S. Causing', 'causingpob5tech4ed@gmail.com', '0947-883-5007', 'Female', '2016-11-11', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(23, '5th', 'Gma', 'Computer Laboratory', 'San Jose Community High School (GMA) Tech4ED Center', 'School', 'lilia reyes potente', 'library.generaltrias@gmail.com', '0', 'Female', '2016-08-09', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(24, '5th', 'Gma', 'Unverified', 'Brgy N. Virata Tech4Ed Center', 'LGU', 'Daisy C. Tajon', 'victoralexiz22@gmail.com', '0933-934-2456', 'Female', '2016-11-11', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(25, '5th', 'Gma', 'Unverified', 'San Gabriel Tech4Ed Center', 'LGU', 'Rowena B. Vega', 'khen.vega.19@gmail.com', '0939-785-5624', 'Female', '2016-11-11', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(26, '3rd', 'Imus City', 'City Library Office', 'City Government Hall of Imus Tech4ED Center', 'LGU', 'Cristina S. Escarilla', 'inaescarilla.imus@gmail.com', '0917-544-9550', 'Female', '2016-11-29', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(27, '3rd', 'Imus City', 'Cluster 3 bldg.', 'Imus Cluster 3 Bldg Tech4ED Center', 'LGU', 'Ronabelle Silla', 'rbellesilla.imus@gmail.com', '0917-530-7208', 'Female', '2016-11-29', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(28, '3rd', 'Imus City', 'Unverified', 'Imus Cluster 5 Bldg Tech4ED Center', 'LGU', 'John Benedict Tinawin', 'jbtinawin.imus@gmail.com', '0905-332-3478', 'Male', '2016-11-29', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(29, '3rd', 'Imus City', 'Unverified', 'Imus Cluster 9 Bldg Tech4ED Center', 'LGU', 'Rosemarie Dayrit', 'debbiepakingan.imus@gmail.com', '0905-559-4958', 'Male', '2017-09-20', 'No', 'Unverified', '2017 3-Desktop Package', NULL, NULL, 1),
(30, '3rd', 'Imus City', 'Unverified', 'Gen. Juan Castañeda Senior High School Tech4ED Center', 'School', 'Michael Bartolome Barias', 'michael.barias@deped.gov.ph', '9088852520', 'Male', '2017-03-17', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(31, '3rd', 'Imus City', 'Unverified', 'Bukandala Elementary School Tech4ED Center', 'School', 'JEE ANN PEREZ RAFAEL', 'jeeann.rafael001@deped.gov.ph', '9065060157', 'Female', '2017-03-17', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(32, '3rd', 'Imus City', 'Unverified', 'Imus National High School Tech4ED Center', 'School', 'Mary Grace F. Fabello', 'geshmy_m12@yahoo.com', '9258063625', 'Female', '2017-03-17', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(33, '3rd', 'Imus City', 'Unverified', 'Gen. Pantaleon Garcia Senior High School Tech4ED Center', 'School', 'Lorenzo F. Moreno Jr.', 'lorenzo.moreno@deped.gov.ph', '9977334844', 'Male', '2017-03-17', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(34, '3rd', 'Imus City', 'Unverified', 'Imus National High Shool - Greengate Annex Tech4ED Center', 'School', 'MARICLAIRE F. SARTE', 'erialcmari2010@gmail.com', '9199104169', 'Female', '2017-03-17', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(35, '3rd', 'Imus City', 'Unverified', 'Gov. D. M. Camerino Elementary School Tech4ED Center', 'School', 'Lucila M. Toledo', 'lucymadlangbayantoledo@yahoo.com', '9397783976', 'Female', '2017-03-17', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(36, '3rd', 'Imus City', 'Unverified', 'General Emilio Aguinaldo National High School Tech4ED Center', 'School', 'Judith G. Indonela', 'judith_indonela@yahoo.com', '9055524748', 'Female', '2017-03-17', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(37, '3rd', 'Imus City', 'Unverified', 'Gen. Flaviano Yengko Senior High School Tech4ED Center', 'School', 'Jereen D. Rebanal', 'jereen.rebanal@gmail.com', '9062422301', 'Female', '2017-03-17', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(38, '3rd', 'Imus City', 'Unverified', 'General Licerio Topacio National High School Tech4ED Center', 'School', 'Darian Princess B. Jamin', 'darianprincessbughaojamin@gmail.com', '9357894094', 'Female', '2017-03-17', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(39, '3rd', 'Imus City', 'Unverified', 'Imus Pilot Elementary School Tech4ED Center', 'School', 'MERCEDI A. CABARAL', 'mercedi.cabaral@deped.gov.ph', '9228147632', 'Female', '2017-03-17', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(40, '3rd', 'Imus City', 'Unverified', 'Gov. Juanito Reyes Remulla Senior High School Tech4ED Center', 'School', 'Joseverino B. Laxamana', 'joseverinolaxamana@gmail.com', '9327792169', 'Male', '2017-03-17', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(41, '8th', 'Maragondon', 'Unverified', 'Maragondon Tech4ED Center', 'LGU', 'OROSA, RIA KRIS H.', 'lgu.maragondon@gmail.com', '9154809553', 'Female', '2017-04-21', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(42, '7th', 'Tanza', 'Unverified', 'Tanza Municipal Annex Tech4ED Center', 'LGU', 'Harry T. Borrega', 'lgumunicipalannex@gmail', '9359649188', 'Male', '2017-04-25', 'Yes', 'Unverified', '2017 3-Desktop Package', NULL, NULL, 1),
(43, '7th', 'Tanza', 'Unverified', 'Tanza Municipal Library Tech4ED Center', 'LIBRARY', 'RENZ LUNGCAY', 'tanza.municipallibrary@gmail.com', '9267232092', 'Male', '2017-04-25', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(44, '7th', 'Trece Martires City', 'Unverified', 'Cavite Prov\'l Jail Tech4Ed', 'LGU', 'Conception Villanueva', 'provincialictoffice.cavite@gmail.com', '0', 'Female', '2016-11-29', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(45, '7th', 'Trece Martires City', 'Unverified', 'OPA Cavite FITS Tech4ED Center', 'FITS', 'VILMA E. CONSTANTE', 'fits.opacavite@gmail.com', '9175117497', 'Female', '2017-12-04', 'Yes', 'Unverified', '2017 3-Desktop Package', NULL, NULL, 1),
(46, '5th', 'Silang', 'Unverified', 'Silang Municipal Library Tech4ED Center', 'LIBRARY', 'Gina Velasco', 'ginajvelasco@yahoo.com', '0', 'Female', '2017-09-20', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(47, '8th', 'Tagaytay City', '2nd Floor', 'City College of Tagaytay Tech4ED Center', 'School', 'Janice De Guaman Causaren', 'janicedcausaren18@gmail.com', '0', 'Female', '2017-10-25', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(48, '8th', 'Tagaytay City', '3rd Flr', 'Tagaytay City Library and Museum Tech4ED Center', 'LIBRARY', 'MARIA SHELLY DOGELIO JABINES', 'sunshinebookeeping@yahoo.com', '0', 'Female', '2017-10-25', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(49, '8th', 'Tagaytay City', '2nd Floor', 'Tagaytay City Science National High School Tech4ED Center', 'School', 'Loradel Palma Chavez', 'dhelchavez1024@gmail.com', '0', 'Female', '2017-10-25', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(50, '2nd', 'Bacoor City', 'Bacoor Computer Center Gen. Evangelista St. Bacoor City', 'Bacoor Computer & Tech4ED Center', 'LGU', 'Unverified', 'revillacenter@gmail.com', '0', '', '2017-11-06', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(51, '2nd', 'Bacoor City', '1stFlr', 'Bacoor Livelihood Training & Tech4ED Center', 'LGU', 'Andrei Salcedo Sumongsong', 'mis.bacoor@gmail.com', '0', 'Male', '2017-11-06', 'Yes', 'Unverified', '2017 3-Desktop Package', NULL, NULL, 1),
(52, '4th', 'Dasmariñas City', 'Unverified', 'TUP Cavite Tech4ED Center', 'School', 'Emmie Necesito Opalalic', 'emmie_opalalic@tup.edu.ph', '0', 'Female', '2017-11-14', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(53, '2nd', 'Bacoor City', 'Unverified', 'Bacoor City Bayanan ES ALS Tech4Ed Center', 'School', 'Annielyn Mercado Pedemonte', 'annielyn.bayananesbacoorcity@gmail.com', '0', 'Female', '2018-01-18', 'Yes', 'Unverified', '2017 3-Desktop Package', NULL, NULL, 1),
(54, '2nd', 'Bacoor City', 'Unverified', 'Bacoor City Queens Row ES ALS Tech4Ed Center', 'School', 'Josue Olanka Alindogan', 'josuequeensrowbacoorcity@gmail.com', '0', 'Male', '2018-01-18', 'Yes', 'Unverified', '2017 3-Desktop Package', NULL, NULL, 1),
(55, '3rd', 'Imus City', 'Unverified', 'Cavite Computer Tech4ED Center', 'RIS', 'MARIA ISIDRA LACUROM BERGUNDER', 'ebergunder@yahoo.com', '0', 'Female', '2018-12-04', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(56, '7th', 'Trece Martires City', 'Unverified', 'Cavite Provincial Library Tech4ED Center', 'LIBRARY', 'CONCEPCION PUGAY VILLANUEVA', 'villanuevaconcepcion8@gmail.com', '0', 'Female', '2018-12-04', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(57, '1st', 'Noveleta', 'Unverified', 'Noveleta Municipal Tech4ED Center', 'LGU', 'Harvee Ortega Fermin', 'noveletamunicipal.harvee@gmail.com', '0', 'Male', '2018-03-23', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(58, '1st', 'Noveleta', 'Unverified', 'Municipality of Noveleta Barangay San Rafel III Tech4ED Center', 'LGU', 'Al tonn DE LOS SANTOS de guzman', 'noveletamunicipalaltonn21@gmail.com', '0', 'Male', '2018-03-23', 'No', 'Unverified', '2017 3-Desktop Package', NULL, NULL, 1),
(59, '2nd', 'Bacoor City', 'Unverified', 'Habay Elementary School Tech4ED Center', 'School', 'Michelle Anne R. Diaz', 'michelleanne.diaz.mad@gmail.com', '9208058966', 'Female', '2018-12-10', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(60, '2nd', 'Bacoor City', 'Unverified', 'Bacoor Salinas Elementary School Tech4ED Center', 'School', 'Hermogenes O. Barila', 'hermogenes.barila@deped.gov.ph', '9235154347', 'Male', '2018-12-10', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(61, '2nd', 'Bacoor City', 'Evangelista Street, Alima, Bacoor City', 'Bacoor Elementary School Tech4ED Center', 'School', 'Federico M. Salvador Jr', 'Unverified', '0', 'Male', '2018-12-10', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(62, '8th', 'Alfonso', 'Unverified', 'Buck Estate Barangay Hall', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2018-11-26', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(63, '5th', 'Carmona', 'Unverified', 'Milagrosa BML Tech4ED Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2018-12-05', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(64, '5th', 'Carmona', 'Unverified', 'Mabuhay BML Tech4ED Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2018-12-05', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(65, '1st', 'Cavite City', 'Unverified', 'Ladislao Elementary School Tech4ED Center', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(66, '1st', 'Cavite City', 'Unverified', 'San Lorenzo Ruiz Elem. School', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(67, '1st', 'Cavite City', 'Unverified', 'Dalahican Elem. School', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(68, '1st', 'Cavite City', 'Unverified', 'Sta. Cruz Elem. School', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(69, '1st', 'Cavite City', 'J. Miranda St., Sta. Cruz Cavite City', 'Estansuela Elem. School', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(70, '1st', 'Cavite City', 'Unverified', 'Ovidio dela Rosa Elem. School', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(71, '1st', 'Cavite City', 'Unverified', 'Manuel S. Rojas Elem. School', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(72, '1st', 'Cavite City', 'LOPEZ JAENA STRRET, SAN ROQUE CAVITE CITY', 'Garita Elem. School', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(73, '1st', 'Cavite City', 'Unverified', 'Bagumbuhay Elem. School', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(74, '1st', 'Cavite City', 'J. Ibanez street, PN Cavite City', 'Porta Vaga Elem. School', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(75, '1st', 'Cavite City', 'Unverified', 'Julian R. Felipe Elem. School', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(76, '1st', 'Cavite City', 'Unverified', 'Sangley Elem. School', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(77, '1st', 'Cavite City', 'CHIEF E. MARTIN ST. CARIDAD', 'Cavite National High School- Junior High', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(78, '1st', 'Cavite City', 'Unverified', 'Sangley Point National High School- Junior', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(79, '1st', 'Cavite City', 'Chief Martin St., Caridad, Cavite City', 'Cavite National High School- Senior High', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(80, '1st', 'Cavite City', 'Unverified', 'Sangley Point National High School-Senior High', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2019-07-05', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(81, '8th', 'Magallanes', 'Unverified', 'Magallanes Tech4ED Center (Magallanes, Cavite)', 'LGU', 'JIM GARY O. VILLENA', 'jimgary.villena@deped.gov.ph', '9569379792', 'N/A', '2020-06-29', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(82, '8th', 'Magallanes', 'Unverified', 'Magallanes Elementary School Tech4ED Center (Magallanes, Cavite)', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2020-05-04', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(83, '8th', 'Magallanes', 'Unverified', 'Baliwag Elementary School Tech4ED Center (Magallanes, Cavite)', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2020-05-04', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(84, '8th', 'Magallanes', 'Unverified', 'Bendita Elementary School Tech4ED Center (Magallanes, Cavite)', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2020-05-04', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(85, '8th', 'Magallanes', 'Unverified', 'Cabulusan Elementary School Tech4ED Center (Magallanes, Cavite)', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2020-05-04', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(86, '8th', 'Magallanes', 'Unverified', 'Caluangan Elementary School Tech4ED Center (Magallanes, Cavite)', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2020-05-04', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(87, '8th', 'Magallanes', 'Unverified', 'Medina Elementary School Tech4ED Center (Magallanes, Cavite)', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2020-05-04', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(88, '8th', 'Magallanes', 'Unverified', 'Pacheco Elementary School Tech4ED Center (Magallanes, Cavite)', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2020-05-04', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(89, '8th', 'Magallanes', 'Unverified', 'Ramirez Elementary School Tech4ED Center (Magallanes, Cavite)', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2020-05-04', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(90, '8th', 'Magallanes', 'Unverified', 'Tua Elementary School Tech4ED Center (Magallanes, Cavite)', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2020-05-04', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(91, '8th', 'Magallanes', 'Unverified', 'Urdaneta Elementary School Tech4ED Center (Magallanes, Cavite)', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2020-05-04', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(92, '8th', 'Magallanes', 'Unverified', 'Calanguan National Highchool Tech4ED Center (Magallanes, Cavite)', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2020-05-04', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(93, '8th', 'Magallanes', 'Unverified', 'Bendita National Highschool Tech4ED Center (Magalllanes, Cavite)', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2020-05-04', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(94, '8th', 'Mendez-Nuñez', 'Unverified', 'Tech4ED Center LGU Mendez-Nuñez', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2020-07-31', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(95, '8th', 'Naic', 'Unverified', 'Naic Municipal Library Tech4ED Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2020-08-07', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(96, '8th', 'Ternate', 'Unverified', 'Ternate Tech4ED Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2020-11-23', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(97, '1st', 'Rosario', 'Unverified', 'Rosario Tech4ED Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2020-11-23', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(98, '8th', 'Gen. Emilio Aguinaldo', 'Unverified', 'G.E.A. Tech4ED Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2020-11-23', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(99, '1st', 'Cavite City', 'Unverified', 'LGU Cavite City Tech4ED Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2021-05-28', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(100, '1st', 'Kawit', 'Unverified', 'Barangay Wakas II Tech4ED Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2021-05-28', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(101, '7th', 'Amadeo', 'Unverified', 'Amadeo Tech4ED Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2020-12-15', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(102, '1st', 'Kawit', 'Unverified', 'Kawit Tech4ED Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2021-06-11', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(103, '7th', 'Indang', 'Unverified', 'Indang Tech4ED Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2020-02-26', 'No', 'Unverified', 'Unverified', NULL, NULL, 1),
(104, '5th', 'GMA', 'Unverified', 'GMA Municipal Jail Tech4ED Center', 'NGA', 'Unverified', 'Unverified', '0', 'N/A', '2022-03-01', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(105, '5th', 'Carmona', 'New Building, Ground Flr.', 'BJMP Carmona Municipal Jail Tech4ED Center', 'NGA', 'Jsupt Noel T. Corpuz', 'leonsoftrock@gmail.com', '09171907386', 'Male', '2022-05-20', 'Yes', 'Yes', '2021 Package Donation', NULL, NULL, 1),
(106, '3rd', 'Imus', 'Unverified', 'BJMP Imus City Jail Male Dorm', 'NGA', 'JSupt Reynaldo Paguiringan Jr.', 'Unverified', '0', 'N/A', '2022-07-20', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(107, '4th', 'Dasmariñas', 'Unverified', 'BJMP Dasmariñas City Jail Female Dorm Tech4ED Center', 'NGA', 'Unverified', 'Unverified', '0', 'N/A', '2022-08-30', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(108, '5th', 'SIlang', 'Unverified', 'BJMP Silang Municipal Jail', 'NGA', 'Unverified', 'Unverified', '0', 'N/A', '2023-01-01', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(109, '5th', 'GMA', 'Unverified', 'SANGGUNIANG KABATAAN BARANGAY Bernardo Pulido Tech4Ed Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2023-03-03', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(110, '5th', 'GMA', 'Unverified', 'SANGGUNIANG KABATAAN BARANGAY Francisco De Castro Tech4Ed Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2023-03-03', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(111, '5th', 'GMA', 'Unverified', 'SANGGUNIANG KABATAAN BARANGAY Francisco Reyes Tech4Ed Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2023-03-03', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(112, '5th', 'GMA', 'Unverified', 'SANGGUNIANG KABATAAN BARANGAY Gregoria De Jesus Tech4Ed Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2023-03-03', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(113, '5th', 'GMA', 'Unverified', 'SANGGUNIANG KABATAAN BARANGAY Poblacion 4 Tech4Ed Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2023-03-03', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(114, '5th', 'GMA', 'Unverified', 'SANGGUNIANG KABATAAN BARANGAY Ramon Cruz, Sr. Tech4Ed Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2023-03-03', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(115, '5th', 'GMA', 'Unverified', 'SANGGUNIANG KABATAAN BARANGAY Teniente Tiago Tech4Ed Center', 'LGU', 'Unverified', 'Unverified', '0', 'N/A', '2023-03-03', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(116, '7th', 'Trece Martires City', 'Department of Agriculture Trece Martires City', 'Department of Agriculture Trece Martires City', 'NGA', 'Madell Jaurigue', 'rtc_calabarzon@ati.da.gov.ph', '0', 'Female', '2023-10-25', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(117, '3rd', 'Imus City', 'Imus city Jail Female Dormitory', 'BJMP Imus City Jail Female Dormitory Tech4Ed Center', 'NGA', 'Annaliza A. Arabani', 'r4a.imuscjfd@bjmp.gov.ph', '0', 'Female', '2024-02-15', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(118, '5th', 'General Mariano Alvarez', 'GMA ICT Building', 'LGU GMA ICT Tech4Ed Center', 'LGU', 'Ms. Anne Arceo', 'icts@genmarianoalvarez.gov.ph', '0', 'Female', '2024-03-15', 'Yes', 'No', 'Unverified', NULL, NULL, 1),
(119, '5th', 'General Mariano Alvarez', 'San Gabriel Elementary School', 'LGU GMA ALS Tech4Ed Center', 'School', 'Unverified', 'Unverified', '0', 'N/A', '2024-03-15', 'Yes', 'Yes', 'Unverified', NULL, NULL, 1),
(120, '2nd', 'Bacoor', 'BJMP Male Dormitory Bacoor City Jail', 'BJMP Bacoor City Jail Tech4Ed Center', 'NGA', 'Michelle Laresma', 'laresma.michelle@gmail.com', '0', 'Female', '2024-11-25', 'Yes', 'Yes', '3 Laptops', NULL, NULL, 1),
(121, '4th', 'Dasmariñas', 'BJMP Male Dormitory Dasma City Jail', 'BJMP Dasma City Jail Male Dorm Tech4Ed Center', 'NGA', 'Amiel T Balahadia', 'r4a.dasmarinascjmd@bjmp.gov.ph', '0', 'Male', '2024-11-25', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(122, '7th', 'Trece Martires City', 'Brgy Gregorio, Trece Martires City, Cavite', 'BJMP Trece Martires City Jail Tech4Ed Center', 'NGA', 'Danica Cenita', 'wdtrecemcj@gmail.com', '0', 'Female', '2024-11-26', 'Yes', 'Unverified', 'Unverified', NULL, NULL, 1),
(123, '8th', 'Tagaytay', 'Brgy. Guinhawa North, Tagaytay City Cavite', 'BJMP Tagaytay City Jail Tech4Ed Center', 'NGA', 'Ellie Jean Lim', 'r4a.tagaytaycjmd@bjmp.gov.ph', '0', 'Female', '2024-11-26', 'Yes', 'Yes', '3 Laptops', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dict Cavite', 'dict@gmail.com', NULL, '$2y$10$qiA/x38a0laNWWEZKIo1G.kQryyGIiTj8IKq5eLw3tcANxUZIfALa', 'Uv3YKPfLbhCDetuiaGjGnil8GYL6GN1RPD2CW86Kn1x0KsRVvBiPq2KYKZs0', '2025-04-23 09:15:18', '2025-05-19 23:16:13'),
(5, 'John Romy', 'romy@gmail.com', NULL, '$2y$10$xx1BU0TeW8N0DWuyOzdsguJ3miYkUIZlUrk7DSd2p4c7xs.imet2e', NULL, '2025-05-19 22:22:58', '2025-05-19 22:22:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bplos`
--
ALTER TABLE `bplos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bplos_user_id_foreign` (`user_id`);

--
-- Indexes for table `cybersecurities`
--
ALTER TABLE `cybersecurities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cybersecurities_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fw4as`
--
ALTER TABLE `fw4as`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fw4as_user_id_foreign` (`user_id`);

--
-- Indexes for table `ibpls`
--
ALTER TABLE `ibpls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ibpls_user_id_foreign` (`user_id`);

--
-- Indexes for table `ilcdbs`
--
ALTER TABLE `ilcdbs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ilcdbs_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pnpkis`
--
ALTER TABLE `pnpkis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pnpkis_user_id_foreign` (`user_id`);

--
-- Indexes for table `sparks`
--
ALTER TABLE `sparks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sparks_user_id_foreign` (`user_id`);

--
-- Indexes for table `tech4eds`
--
ALTER TABLE `tech4eds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bplos`
--
ALTER TABLE `bplos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `cybersecurities`
--
ALTER TABLE `cybersecurities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fw4as`
--
ALTER TABLE `fw4as`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ibpls`
--
ALTER TABLE `ibpls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ilcdbs`
--
ALTER TABLE `ilcdbs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pnpkis`
--
ALTER TABLE `pnpkis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparks`
--
ALTER TABLE `sparks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tech4eds`
--
ALTER TABLE `tech4eds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bplos`
--
ALTER TABLE `bplos`
  ADD CONSTRAINT `bplos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cybersecurities`
--
ALTER TABLE `cybersecurities`
  ADD CONSTRAINT `cybersecurities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `fw4as`
--
ALTER TABLE `fw4as`
  ADD CONSTRAINT `fw4as_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ibpls`
--
ALTER TABLE `ibpls`
  ADD CONSTRAINT `ibpls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ilcdbs`
--
ALTER TABLE `ilcdbs`
  ADD CONSTRAINT `ilcdbs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pnpkis`
--
ALTER TABLE `pnpkis`
  ADD CONSTRAINT `pnpkis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sparks`
--
ALTER TABLE `sparks`
  ADD CONSTRAINT `sparks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
