-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 10:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', '1234567', '13-05-2024 04:43:12 PM');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctorSpecialization` varchar(255) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` varchar(255) DEFAULT NULL,
  `appointmentTime` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctorSpecialization`, `doctorId`, `userId`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`) VALUES
(10, 'Immunology', 14, 12, 10000, '2024-04-17', '11:30', '2024-04-16 18:27:49', 1, 1, NULL),
(11, 'Immunology', 14, 14, 10000, '2024-04-17', '11:30', '2024-04-16 18:34:35', 0, 1, '2024-05-07 03:24:57'),
(12, 'Clinical Chemistry', 13, 14, 3500, '2024-05-02', '16:30', '2024-05-01 00:55:28', 1, 0, '2024-05-01 00:56:59'),
(13, 'Clinical Chemistry', 13, 13, 3500, '2024-05-08', '16:00', '2024-05-01 00:57:45', 1, 1, NULL),
(14, 'Molecular biology (DNA , Gene Expression Analysis, Protein Analysis, Gene Editing)', 14, 15, 10000, '2024-05-09', '10:45', '2024-05-05 16:44:54', 1, 1, NULL),
(15, 'Clinical Chemistry', 13, 1, 3500, '2024-05-07', '12:00', '2024-05-05 18:20:32', 0, 1, '2024-05-05 18:20:40'),
(16, 'Immunology', 16, 14, 12000, '2024-05-08', '08:30', '2024-05-07 03:24:32', 1, 1, NULL),
(17, 'Clinical Chemistry', 13, 16, 3500, '2024-05-16', '07:20', '2024-05-11 15:13:35', 0, 1, '2024-05-11 15:24:10'),
(18, 'Molecular biology (DNA , Gene Expression Analysis, Protein Analysis, Gene Editing)', 14, 3, 10000, '2024-05-12', '08:00', '2024-05-11 15:27:06', 1, 1, NULL),
(19, 'Phlebotomy', 25, 1, 9500, '2024-05-14', '09:50', '2024-05-13 16:00:11', 1, 1, NULL),
(20, 'Cancer Test', 19, 16, 5000, '2024-05-15', '10:30', '2024-05-14 17:28:05', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `doctor_id` int(5) NOT NULL,
  `patient_id` int(5) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `consultancy_fees` decimal(10,2) NOT NULL,
  `appointment_date` date NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `appointment_time` time NOT NULL,
  `gender` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(5) UNSIGNED NOT NULL,
  `patient_id` int(5) NOT NULL,
  `amount` int(5) NOT NULL,
  `type_of_service` varchar(50) NOT NULL,
  `processed_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_records`
--

CREATE TABLE `bill_records` (
  `billrecord_id` int(5) UNSIGNED NOT NULL,
  `patient_id` int(5) NOT NULL,
  `amount` int(5) NOT NULL,
  `type_of_service` varchar(50) NOT NULL,
  `processed_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `doctorName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specilization`, `doctorName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `creationDate`, `updationDate`, `username`) VALUES
(14, 'Molecular biology (DNA , Gene Expression Analysis, Protein Analysis, Gene Editing)', 'James Wekesa', 'Bungoma', '10000', 723007834, 'jamesweks2019@gmail.com', '$2y$10$hm6G746Z4grArDK6N.ofKeL5jhSmHJ/zuDAhN3gmk0FIaqyFds/W.', '2024-04-16 18:25:11', '2024-04-17 01:47:54', NULL),
(15, 'Covid -19 Test', 'Sambuli Joash', 'Ohio', '4000', 768798098, 'joashsambuli@gmail.com', '$2y$10$OMUjQ4LdPOnMhlx5DGKsH.FqSeK9bAO3Poq2iXN.XaxUhegWK65XS', '2024-05-06 14:09:11', NULL, NULL),
(16, 'Immunology', 'Ian John', 'Kiambu', '12000', 723567876, 'ian@gmail.com', '$2y$10$dXoWDK678yKZ.kilkC1seOrZ02Jme/XfD60jAUva6HCf2n.PlVS1i', '2024-05-06 14:59:57', NULL, NULL),
(17, 'Microbiology', 'Elizabeth Kimani', 'Moi avenue', '7000', 734567897, 'elizabeth@gmail.com', '$2y$10$gC.oCdXFbtCcKggwbL1yau1h3nibKb8rQHB/u6SbX4d4r1PCwS7J.', '2024-05-11 15:36:49', NULL, NULL),
(18, 'Hematology', 'Rob Holding', 'MOI', '8000', 789765343, 'rob@gmail.com', '$2y$10$wXBgioP3eWBDxOIdLbodYOwMNidSLLlOY.9eVyTdNtNB7qUWI/o/q', '2024-05-11 15:58:55', NULL, NULL),
(19, 'Cancer Test', 'Cecilia Owino', 'Kenyatta', '5000', 710675435, 'cecilia@gmail.com', '$2y$10$Tlf0/4PknihVn9lu3TziXuh1xBwwpYcKNlT2XQnQ.4GkadC5UJOD2', '2024-05-11 16:00:17', NULL, NULL),
(20, 'Radiology', 'Gabriel zsee', 'St. Mary', '6000', 745678624, 'gabriel@gmail.com', '$2y$10$J8O.fOnDTMEpm8vnjRjt/.CylaeJxQ8B1bU8ZYW/c470VnJ.ROTvu', '2024-05-11 16:02:43', NULL, NULL),
(21, 'Oncology (Cancer Care) Services', 'Tiami Almaa', 'Sultan', '7500', 765473890, 'tiami@gmail.com', '$2y$10$el6aVlan85ZkmQGBd7dlU.3qA0ith0K5Mia4ttgQcT/tl.SWCCCCS', '2024-05-11 16:13:50', NULL, NULL),
(22, 'Neonatal Intensive Care Unit (NICU)', 'Mary Wekesa', 'Bungoma', '15000', 723456787, 'mary@gmail.com', '$2y$10$FylMYN1lxkjMirmQmX1DVedRo1jdh7GY0jz54bZaj/KcQOkt8cGU2', '2024-05-11 16:15:11', NULL, NULL),
(23, 'Renal Services', 'Kioni Jim', 'Meru', '10000', 756745233, 'jim@gmail.com', '$2y$10$TryRmJAdkqbW57vL66BaSO3ZH6oHfBpcgu68zohMuVW7s.G3b2oSa', '2024-05-11 16:17:50', NULL, NULL),
(25, 'Phlebotomy', 'Phibby Oslo', 'Busia', '9500', 789973673, 'phibby@gmail.com', '$2y$10$gIXnOnHnuViMKcgCXzCBC.QONrPetjrLDnRV8jWzKlNz2jqg4tJpG', '2024-05-11 16:20:03', NULL, NULL),
(26, 'Endocrinology', 'betty Zio', 'sio', '5000', 786765431, 'betty@gmail.com', '$2y$10$f0yFAWKlk2rQd7/OCNfmPOusE2Jzr2hBabnpRIojCFurFaLepEdRa', '2024-05-11 17:04:34', NULL, NULL),
(27, 'Microbiology', 'Sally Juma', 'Mumbai', '7500', 7800, 'sally@gmail.com', '$2y$10$ub6/EZ7E31xcxM61EHcYDOG3qrH1UE7ElS5io5vXon5HzVmSE/0ti', '2024-05-13 19:14:30', NULL, NULL),
(28, 'Covid -19 Test', 'Dorah Salih', 'bg', '5000', 767898543, 'dorah@gmail.com', '$2y$10$gTio//UOW6ksI2R/AFJEPe1wBvTtAKb8yT3Uepma6YD9LmPIfhbni', '2024-05-13 19:34:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(87, 14, 'jamesweks2019@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-16 18:29:10', '01-05-2024 03:55:55 AM', 1),
(88, NULL, 'admin', 0x3a3a3100000000000000000000000000, '2024-04-25 21:01:27', NULL, 0),
(89, NULL, 'admin', 0x3a3a3100000000000000000000000000, '2024-04-25 21:01:28', NULL, 0),
(90, 12, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-27 13:34:53', '27-04-2024 04:54:27 PM', 1),
(91, NULL, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-27 13:54:43', NULL, 0),
(92, 12, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-27 13:54:49', NULL, 1),
(93, NULL, 'susan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-01 00:03:47', NULL, 0),
(94, NULL, 'wen@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-01 00:03:55', NULL, 0),
(95, NULL, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-01 00:07:50', NULL, 0),
(96, NULL, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-01 00:07:50', NULL, 0),
(97, NULL, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-01 00:07:57', NULL, 0),
(98, NULL, 'jamesweks2019@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-01 00:08:21', NULL, 0),
(99, NULL, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-01 00:08:29', NULL, 0),
(100, NULL, 'wen@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-01 00:09:33', NULL, 0),
(101, 12, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-01 00:10:02', NULL, 1),
(102, NULL, 'Junemaasai@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-01 00:56:10', NULL, 0),
(103, NULL, 'Junemaasai@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-01 00:56:17', NULL, 0),
(104, 13, 'Junemaasai@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-01 00:56:22', '01-05-2024 04:55:40 AM', 1),
(105, NULL, 'wen@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-05 17:44:16', NULL, 0),
(106, NULL, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-05 17:44:23', NULL, 0),
(107, NULL, 'susan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-05 17:44:32', NULL, 0),
(108, NULL, 'johndoe12@test.com', 0x3a3a3100000000000000000000000000, '2024-05-05 17:45:48', NULL, 0),
(109, 12, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-05 17:45:54', '05-05-2024 08:46:39 PM', 1),
(110, NULL, 'susan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-06 13:59:44', NULL, 0),
(111, NULL, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-06 13:59:52', NULL, 0),
(112, NULL, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-06 14:00:02', NULL, 0),
(113, 12, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-06 14:00:27', '06-05-2024 05:09:36 PM', 1),
(114, 15, 'joashsambuli@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-06 14:10:02', '06-05-2024 06:00:11 PM', 1),
(115, 16, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-06 15:00:28', '14-05-2024 08:32:10 PM', 1),
(116, NULL, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-09 00:50:33', NULL, 0),
(117, NULL, 'wen@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-09 00:50:39', NULL, 0),
(118, NULL, 'susan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-09 00:50:46', NULL, 0),
(119, NULL, 'susan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-09 00:50:52', NULL, 0),
(120, NULL, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-09 00:51:01', NULL, 0),
(121, NULL, 'susan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-11 16:09:38', NULL, 0),
(122, NULL, 'franciswasike@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-11 16:09:45', NULL, 0),
(123, NULL, 'wen@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-11 16:09:55', NULL, 0),
(124, NULL, 'gabriel@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-11 16:10:05', NULL, 0),
(125, 20, 'gabriel@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-11 16:10:25', NULL, 1),
(126, 20, 'gabriel@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-12 11:49:34', NULL, 1),
(127, 19, 'cecilia@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-12 12:26:05', NULL, 1),
(128, 20, 'gabriel@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-12 12:31:46', NULL, 1),
(129, 19, 'cecilia@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-12 19:12:18', '12-05-2024 10:12:52 PM', 1),
(130, 19, 'cecilia@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-12 19:13:39', NULL, 1),
(131, 19, 'cecilia@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-12 23:39:57', NULL, 1),
(132, 19, 'cecilia@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-13 16:58:27', NULL, 1),
(133, NULL, 'susan@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-13 18:17:46', NULL, 0),
(134, 19, 'cecilia@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-13 18:17:54', '13-05-2024 10:36:04 PM', 1),
(135, 22, 'mary@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-13 18:55:56', NULL, 1),
(136, 27, 'sally@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-13 19:15:05', '13-05-2024 10:35:07 PM', 1),
(137, 28, 'dorah@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-13 19:35:14', NULL, 1),
(138, NULL, 'cecilia@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-14 14:53:44', NULL, 0),
(139, 19, 'cecilia@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-14 14:53:52', NULL, 1),
(140, 19, 'cecilia@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-14 15:01:32', NULL, 1),
(141, 19, 'cecilia@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-14 17:32:46', NULL, 1),
(142, 19, 'cecilia@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-14 17:42:59', '14-05-2024 10:36:17 PM', 1),
(143, 19, 'cecilia@gmail.com', 0x3a3a3100000000000000000000000000, '2024-05-15 08:59:32', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(19, 'Clinical Chemistry', '2024-04-05 12:20:59', NULL),
(20, 'Immunology', '2024-04-05 12:20:59', NULL),
(21, 'Microbiology', '2024-04-05 12:20:59', NULL),
(44, 'Covid -19 Test', '2024-04-10 22:01:25', '2024-04-10 22:01:25'),
(47, 'Hematology', '2024-04-10 22:18:47', '2024-04-10 22:18:47'),
(50, 'Cancer Test', '2024-04-13 21:06:01', '2024-04-13 21:06:01'),
(51, 'Radiology', '2024-04-16 18:09:47', '2024-04-16 18:09:47'),
(52, 'Oncology (Cancer Care) Services', '2024-04-16 18:10:42', '2024-04-16 18:10:42'),
(53, 'Neonatal Intensive Care Unit (NICU)', '2024-04-16 18:12:12', '2024-04-16 18:12:12'),
(54, 'Renal Services', '2024-04-16 18:14:16', '2024-04-16 18:14:16'),
(55, 'Phlebotomy', '2024-04-16 18:16:37', '2024-04-16 18:16:37'),
(56, 'Molecular biology (DNA , Gene Expression Analysis, Protein Analysis, Gene Editing)', '2024-04-16 18:19:40', '2024-04-16 18:19:40'),
(57, 'Endocrinology', '2024-04-16 18:20:26', '2024-04-16 18:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(12) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `LastupdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsRead` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicalhistory`
--

CREATE TABLE `tblmedicalhistory` (
  `ID` int(10) NOT NULL,
  `PatientID` int(10) DEFAULT NULL,
  `BloodPressure` varchar(200) DEFAULT NULL,
  `BloodSugar` varchar(200) NOT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `Temperature` varchar(200) DEFAULT NULL,
  `MedicalPres` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblmedicalhistory`
--

INSERT INTO `tblmedicalhistory` (`ID`, `PatientID`, `BloodPressure`, `BloodSugar`, `Weight`, `Temperature`, `MedicalPres`, `CreationDate`) VALUES
(4, 7, '120/180', 'Normal', '60', '37', 'Normalize drinking water', '2024-04-16 18:45:47'),
(5, 8, '130/180', 'Below normal', '50', '39', 'Need to BE stress free\r\nTake alot of water\r\nDo exercise/Gyming\r\nHave enough sleep', '2024-04-27 13:38:08'),
(6, 9, '121/180', 'Above normal', '67', '37', 'Reduce sugar consumption', '2024-05-01 00:13:00'),
(7, 10, '120/130', 'Above Normal', '50', '37', 'Reduce Sugars', '2024-05-12 19:14:52'),
(8, 8, '120/130', 'Above Normal', '50', '37', 'Get enough sleep', '2024-05-14 16:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT current_timestamp(),
  `OpenningTime` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `OpenningTime`) VALUES
(1, 'aboutus', 'About Us', '<ul style=\"padding: 0px; margin-right: 0px; margin-bottom: 1.313em; margin-left: 1.655em;\" times=\"\" new=\"\" roman\";=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" center;=\"\" background-color:=\"\" rgb(255,=\"\" 246,=\"\" 246);\"=\"\"><li style=\"text-align: left;\"><font color=\"#000000\">Uzima Hospital Lab is a leading healthcare facility dedicated to providing high-quality medical services to the community. With a focus on patient care and innovation, Uzima Hospital Lab strives to be a center of excellence in healthcare delivery. Our hospital lab is equipped with state-of-the-art technology and staffed by a team of highly skilled professionals, including doctors, nurses, and technicians. We offer a wide range of medical services, including phlebotomy, hematology, blood bank and transfusion, clinical chemistry, immunology, and microbiology.</font></li><li style=\"text-align: left;\"><font color=\"#000000\">At Uzima Hospital Lab, we prioritize patient satisfaction and safety above all else. We are committed to delivering personalized care tailored to each patient\'s unique needs. Our compassionate staff works tirelessly to ensure that every patient receives the attention and support they deserve. In addition to our medical services, we are also dedicated to promoting health and wellness within the community. Through outreach programs and health education initiatives, we strive to empower individuals to take control of their health and live healthier lives.</font></li></ul>', NULL, NULL, '2020-05-20 07:21:52', NULL),
(2, 'contactus', 'Contact Details', 'D-204, Hole Town South West, Delhi-110096,India', 'info@gmail.com', 1122334455, '2020-05-20 07:24:07', '9 am To 8 Pm');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL,
  `Docid` int(10) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `PatientContno` bigint(10) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientGender` varchar(50) DEFAULT NULL,
  `PatientAdd` mediumtext DEFAULT NULL,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientMedhis` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `Docid`, `PatientName`, `PatientContno`, `PatientEmail`, `PatientGender`, `PatientAdd`, `PatientAge`, `PatientMedhis`, `CreationDate`, `UpdationDate`) VALUES
(7, 14, 'Job kimmy', 756745635, '', 'Male', 'nairobi', 23, 'N/A', '2024-04-16 18:35:29', '2024-04-16 18:44:49'),
(8, 12, 'Sylvia Mbuya', 734567898, 'sylivia@gmail.com', 'Male', 'Busia', 25, 'HBP', '2024-04-27 13:36:27', '2024-04-27 13:39:36'),
(9, 12, 'Pascal Wasike', 789765345, '', 'Male', 'Nairobi', 30, 'HBP', '2024-05-01 00:11:59', '2024-05-01 00:14:30'),
(10, 19, 'Ann Njeri', 740987890, '', 'Male', 'moi', 36, 'Normal', '2024-05-12 13:36:59', '2024-05-14 16:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `address`, `city`, `gender`, `email`, `password`, `regDate`, `updationDate`) VALUES
(12, 'Wekesa james', 'nairobi', 'Washington', 'Male', 'jamesweks2019@gmail.com', '97169244062d8f62ab6bbc050ed558df', '2024-04-16 18:26:41', '0000-00-00 00:00:00'),
(16, 'Abdul Juma', 'Moi ', 'Nairobi', 'Male', 'abdul@gmail.com', '$2y$10$K79LiavuvXoEJlqHkOyIR.f2mwOmgfv8JlDrUrd34JHfBbGW.S1gK', '2024-05-09 22:59:10', '0000-00-00 00:00:00'),
(17, 'Junior Osoro', 'nairobi', 'Washington', 'Male', 'junior@gmail.com', '$2y$10$aGca8Xd8oVuFaAPTJAIJOOZCHJ6NcFMly4wc5Xj1t64Ox2rv9/oou', '2024-05-12 11:48:34', NULL),
(18, '4542', 'Kajiado', 'Nairobi', 'Male', '4542@gmail.com', '$2y$10$1sb3YZ/RIFu7yDgBAi7omeYZFaI9Q5qPxZwv48SswEdzggmlSsAjG', '2024-05-15 10:51:03', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
