-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2017 at 06:31 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_record`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_history`
--

CREATE TABLE `admission_history` (
  `id` int(11) NOT NULL,
  `card_id` varchar(200) NOT NULL,
  `staff_add_id` varchar(200) NOT NULL,
  `staff_add_name` varchar(250) NOT NULL,
  `staff_dis_id` varchar(250) DEFAULT NULL,
  `staff_dis_name` varchar(250) DEFAULT NULL,
  `date_admitted` datetime NOT NULL,
  `date_discharge` datetime DEFAULT NULL,
  `purpose_discharge` text,
  `admission_id` varchar(250) NOT NULL,
  `place_admitted` text NOT NULL,
  `admission_purpose` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admission_history`
--

INSERT INTO `admission_history` (`id`, `card_id`, `staff_add_id`, `staff_add_name`, `staff_dis_id`, `staff_dis_name`, `date_admitted`, `date_discharge`, `purpose_discharge`, `admission_id`, `place_admitted`, `admission_purpose`) VALUES
(1, 'FMCL17243162', '1111', 'Salami Ojo', '1111', 'Salami Ojo', '2017-10-10 16:45:36', '2017-10-10 17:27:36', 'Patient Iis fit and healthy to return Home. after several test and diagnosis', '4230592517ADM', 'wwewewew', 'dd');

-- --------------------------------------------------------

--
-- Table structure for table `patience_record`
--

CREATE TABLE `patience_record` (
  `id` int(11) NOT NULL,
  `card_id` varchar(200) NOT NULL,
  `card_name` varchar(250) DEFAULT NULL,
  `card_state` varchar(200) DEFAULT NULL,
  `card_lgov` varchar(200) DEFAULT NULL,
  `card_permadd` text,
  `card_tempadd` text,
  `card_gender` varchar(50) DEFAULT NULL,
  `card_date` datetime DEFAULT NULL,
  `card_phone` varchar(15) DEFAULT NULL,
  `card_email` varchar(200) DEFAULT NULL,
  `card_dob` date NOT NULL,
  `officer_Reg` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patience_record`
--

INSERT INTO `patience_record` (`id`, `card_id`, `card_name`, `card_state`, `card_lgov`, `card_permadd`, `card_tempadd`, `card_gender`, `card_date`, `card_phone`, `card_email`, `card_dob`, `officer_Reg`) VALUES
(1, 'FMCL17825910', 'Mrs. Eunice Ejiofor Jude', 'Akwa Ibom', 'Etim Ekpo', 'No.22 Efim Ekpo Street, Akwa Ibom State.', 'No.22 Efim Ekpo Street, Akwa Ibom State.', 'Female', '2017-10-10 10:06:54', '09034255564', 'belloe286@gmail.com', '2009-07-16', '1111'),
(4, 'FMCL17243162', 'Mr. Shadrak Kabiru Ezu', 'Kogi', 'Adavi', 'D41 Inkike Okene, Kogi State.', 'D41 Inkike Okene, Kogi State.', 'Male', '2017-10-10 22:02:43', '09032456618', 'belloe286@gmail.com', '1987-02-12', '1111'),
(3, 'FMCL17831292', 'Miss. Maimunat Abdulraheem', 'Cross River', 'Akamkpa', 'Akampa Road E40 , Ju Street.', 'Akampa Road E40 , Ju Street.', 'Female', '2017-10-10 13:12:37', '09032456618', 'maimus@gmail.com', '1979-05-21', '1111'),
(5, 'FMCL17197368', 'Mr. Ojo Salawu', 'Bayelsa', 'Ogbia', 'Dass Estate Bayelsa City Mall Opp. Reedemed Church.', 'Dass Estate Bayelsa City Mall Opp. Reedemed Church.', 'Male', '2017-10-11 12:22:27', '07034761741', 'maimus@gmail.com', '1984-06-12', '1111');

-- --------------------------------------------------------

--
-- Table structure for table `staff_record`
--

CREATE TABLE `staff_record` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(200) NOT NULL,
  `staff_name` varchar(250) DEFAULT NULL,
  `staff_gender` varchar(10) DEFAULT NULL,
  `staff_dept` varchar(250) DEFAULT NULL,
  `staff_phone` varchar(100) DEFAULT NULL,
  `staff_state` varchar(200) DEFAULT NULL,
  `staff_lgov` varchar(200) DEFAULT NULL,
  `staff_email` varchar(250) DEFAULT NULL,
  `staff_password` varchar(250) NOT NULL,
  `staff_ryt` varchar(10) NOT NULL,
  `date_reg` datetime DEFAULT CURRENT_TIMESTAMP,
  `officer_Reg` varchar(200) NOT NULL,
  `del_status` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_record`
--

INSERT INTO `staff_record` (`id`, `staff_id`, `staff_name`, `staff_gender`, `staff_dept`, `staff_phone`, `staff_state`, `staff_lgov`, `staff_email`, `staff_password`, `staff_ryt`, `date_reg`, `officer_Reg`, `del_status`) VALUES
(1, '1111', 'Doc. Salami Ojo', 'Male', 'Surgery', '09065444324', 'Kogi', 'Lokoja', 'anatomy@gmail.com', '1111', '1', '2017-10-17 00:00:00', '1111', '1'),
(3, '1122', 'Nurse. Adenike Bimbe Sunday', 'Female', 'Nurse', '07034761741', 'Kano', 'Tarauni', 'aabdul@gmail.com', '1122', '2', '2017-10-09 23:28:19', '1111', '0'),
(6, '2345', 'Mr. Tobe John Baratheon', 'Female', 'Labourer', '07034761741', 'Anambra', 'Orumba North', 'aabdul@gmail.com', '2345', '2', '2017-10-10 09:18:47', '1111', '0'),
(8, '1001', 'Nurse. Yahaya Adamu Jude', 'Male', 'Labourer', '09034255564', 'Bauchi', 'Dass', 'anatomy@gmail.com', '1111', '1', '2017-10-10 21:11:00', '1111', '0');

-- --------------------------------------------------------

--
-- Table structure for table `treatment_history`
--

CREATE TABLE `treatment_history` (
  `id` int(11) NOT NULL,
  `card_id` varchar(250) NOT NULL,
  `staff_id` varchar(200) NOT NULL,
  `date_record` datetime NOT NULL,
  `doctor_labresult` text NOT NULL,
  `doctor_labtest` text NOT NULL,
  `doctor_diagnosis` text NOT NULL,
  `card_complain` text NOT NULL,
  `treatment_id` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment_history`
--

INSERT INTO `treatment_history` (`id`, `card_id`, `staff_id`, `date_record`, `doctor_labresult`, `doctor_labtest`, `doctor_diagnosis`, `card_complain`, `treatment_id`) VALUES
(1, 'FMCL17243162', '1111', '2017-10-10 15:30:49', 'dasdsad																	', 'dadsa																	', 'dadd																	', '														sdasd			', '1773746444'),
(5, 'FMCL17243162', '1111', '2017-10-10 22:44:53', 'O+ Malaria Parasite', 'Malaria Test', 'Arthemether and Paracetamol.', 'Headache, Cough, Catargh, Cold.', '1715494553');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_history`
--
ALTER TABLE `admission_history`
  ADD PRIMARY KEY (`admission_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `patience_record`
--
ALTER TABLE `patience_record`
  ADD PRIMARY KEY (`card_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `staff_record`
--
ALTER TABLE `staff_record`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `treatment_history`
--
ALTER TABLE `treatment_history`
  ADD PRIMARY KEY (`treatment_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_history`
--
ALTER TABLE `admission_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `patience_record`
--
ALTER TABLE `patience_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `staff_record`
--
ALTER TABLE `staff_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `treatment_history`
--
ALTER TABLE `treatment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
