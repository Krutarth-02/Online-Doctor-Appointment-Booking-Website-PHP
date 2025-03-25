-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2025 at 03:56 AM
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
-- Database: `healthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(25) NOT NULL,
  `gender` enum('male','female','other','') NOT NULL,
  `age` int(10) NOT NULL,
  `doctor_fullname` text NOT NULL,
  `disease` text NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(10) NOT NULL,
  `remark` text NOT NULL,
  `status` enum('accepted','rejected','pending','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `user_id`, `fullname`, `gender`, `age`, `doctor_fullname`, `disease`, `appointment_date`, `appointment_time`, `address`, `contact_number`, `remark`, `status`) VALUES
(8, 1, 'Khadodiya Punitaben Rames', 'female', 49, 'Dr. Atit Kantawala', 'Body Pain', '2025-03-06', '09:41:00', 'vadodara', '6351030523', 'get well sonn!..', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `doctor_fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `experience` int(11) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `doctor_time` time NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `doctor_fullname`, `username`, `email`, `password`, `qualification`, `specialization`, `experience`, `gender`, `doctor_time`, `address`, `phone`, `status`, `profile`) VALUES
(1, 'Dr. Apurva Modi', 'Apurva1', 'apurvamodi1@gmail.com', 'Apurva1', 'M.B.B.S', 'Hert', 10, 'Male', '10:00:00', 'Anand', '6395896814', 'Active', 'ApurvaModi.jpg'),
(2, 'Dr. Sidharth Shah', 'Sidharth2', 'shidharthshah2@gmail.com', 'Sidharth2', 'M.D.', 'Mind', 10, 'Male', '10:00:00', 'Anand', '6847525945', 'Active', 'ShidharthShah.jpg'),
(3, 'Dr. Dipali Patel', 'Dipali3', 'dipalipatel3@gmail.com', 'Dipali3', 'M.D.S', 'Dentist', 10, 'Female', '10:00:00', 'Anand', '6578423415', 'Active', 'DipaliPatel.jpg'),
(4, 'Dr. Atit Kantawala', 'Atit4', 'atitkantawala4@gmail.com', 'Atit4', 'M.S.', 'Orthopedic', 17, 'Male', '10:00:00', 'Anand', '8745812497', 'Inactive', 'AtitKantawala.jpg'),
(5, 'Dr. Seetharam Sudha', 'Seetharam5', 'seetharamsudha5@gmail.com', 'Seetharam5', 'M.S.', 'Eyes and Hands', 9, 'Female', '10:00:00', 'Anand', '8415789213', 'Active', 'SeetharamSudha.jpg'),
(6, 'Dr. Sachin Arora', 'Sachin6', 'sachinarora6@gmail.com', 'Sachin6', 'M.B.B.S.', 'Child', 27, 'Male', '10:00:00', 'Anand', '8624157895', 'Active', 'SachinArora.jpg'),
(7, 'Dr. Sanehal Adiwala', 'Sanehal7', 'sanehaladiwala7@gmail.com', 'Sanehal7', 'M.B.B.S.', 'Gastrologist', 14, 'Male', '10:00:00', 'Anand', '6314789215', 'Active', 'SnehalAdiwala.jpg'),
(8, 'Dr. R.D. Joshi', 'Rdjoshi8', 'rdjoshi8@gmail.com', 'Rdjoshi8', 'M.D.', 'Skin', 39, 'Male', '10:00:00', 'Anand', '65147328955', 'Active', 'RdJoshi.jpg'),
(9, 'Dr. Himanshu Megnathi', 'Himanshu10', 'himanshumegnathi10@gmail.com', 'himanshi10', 'M.D.', 'Mind', 18, 'Male', '16:00:00', 'Anand', '8747512547', 'Active', 'himashu.jpg'),
(10, 'Dr. Siddharth Mistry ', 'Siddharth11', 'siddharthmistry11@gmail.com', 'Siddharth11', 'M.B.B.S', 'Mind', 7, 'Male', '16:00:00', 'Anand', '6985314527', 'Active', 'siddhath.jpg'),
(11, 'Dr. Gandhi Dental', 'Gandhi12', 'gandhidental12@gmail.com', 'Gandhi12', 'M.D.S', 'Dentist', 17, 'Female', '16:00:00', 'Anand', '8532476952', 'Active', 'gandhi.jpg'),
(12, 'Dr. Rahul Parmar', 'Rahul13', 'rahulparmar13@gmail.com', 'Rahul13', 'M.S.', 'Orthopedic', 11, 'Male', '16:00:00', 'Anand', '6845723146', 'Active', 'rahul.jpg'),
(13, 'Dr. Nilay Shah', 'Nilay14', 'nilayshah14@gmail.com', 'Nilay14', 'M.S.', 'Eyes & Hand', 19, 'Male', '16:00:00', 'Anand', '63490974', 'Active', 'nilay.jpg'),
(14, 'Dr. Pinky Solanki', 'Pinky15', 'pinkysolanki15@gmail.com', 'Pinky15', 'M.B.B.S.', 'Child', 10, '', '16:00:00', 'Anand', '6352845608', 'Active', 'pincky.jpg'),
(15, 'Dr. Hiren P. Patel ', 'Hiren16', 'hirenpatel16@gmail.com', 'Hiren16', 'M.D.', 'Orthopedic', 12, 'Male', '16:00:00', 'Anand', '8925413578', 'Active', 'hiren.jpg'),
(16, 'Dr. Gunvant R. Mayavanshi', 'Gunvant17', 'gunvantmayavanshi17@gmail.com', 'Gunvant17', 'M.B.B.S', 'Skin', 30, 'Male', '16:00:00', 'Anand', '8564237894', 'Active', 'gunvant.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `Name`, `username`, `email`, `password`) VALUES
(1, 'Krutarth Khadodiya', 'Punita23', 'punita23@gmail.com', 'Punita23'),
(2, 'Krutarth Khadodiya', 'Krutarth2114', 'krutarthkhadodiya2@gmail.', 'Krutarth2114');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id_key` (`user_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `user_id_key` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
