-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2023 at 09:56 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `purrfect_care`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_record`
--

DROP TABLE IF EXISTS `appointment_record`;
CREATE TABLE IF NOT EXISTS `appointment_record` (
  `appointmentID` int(11) NOT NULL AUTO_INCREMENT,
  `serviceID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `appointmentDate` date NOT NULL,
  `appointmentTime` varchar(20) NOT NULL,
  `customerAddress` varchar(255) NOT NULL,
  `petName` varchar(255) NOT NULL,
  `petSpecies` varchar(50) NOT NULL,
  `petGender` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `bookingDate` date NOT NULL,
  PRIMARY KEY (`appointmentID`),
  KEY `serviceID` (`serviceID`),
  KEY `customerID` (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment_record`
--

INSERT INTO `appointment_record` (`appointmentID`, `serviceID`, `customerID`, `appointmentDate`, `appointmentTime`, `customerAddress`, `petName`, `petSpecies`, `petGender`, `status`, `notes`, `bookingDate`) VALUES
(1, 1, 2, '2023-04-29', '1300-1500', 'cheras', 'sf', 'Dog', 'Male', 'Accepted', '-', '2023-04-26'),
(2, 2, 1, '2023-04-29', '1300-1530', 'Bukit Jalil', 'Olaf', 'Dog', 'Male', 'Completed', '', '2023-04-26'),
(16, 22, 2, '2023-05-10', '1000-1200', 'Segambut', 'Wei jian', 'Dog', 'Male', 'Cancelled', '', '2023-04-29'),
(20, 13, 2, '2023-05-10', '1000-1200', 'Puchong', 'Bincheong', 'Cat', 'Male', 'Completed', 'my pet is noisy', '2023-04-28'),
(21, 21, 2, '2023-05-05', '1000-1200', 'Hang Jebat', 'Ivan', 'Fury Pets', 'Female', 'Completed', '', '2023-04-28'),
(25, 4, 1, '2023-05-02', '0800-1000', 'Hang Jebat', 'Paikia', 'Dog', 'Female', 'Completed', '', '2023-04-30'),
(27, 1, 1, '2023-05-18', '0800-1000', 'Puchong', 'olaf', 'Dog', 'Male', 'Completed', '', '2023-05-05'),
(32, 5, 1, '2023-05-09', '1000-1200', 'Hang Jebat', 'Aiden', 'Cat', 'Male', 'Pending', '', '2023-05-07'),
(33, 21, 1, '2023-05-10', '1000-1200', 'Hang Jebat', 'efef', 'Dog', 'Male', 'Accepted', '', '2023-05-07'),
(34, 20, 1, '2023-05-11', '1000-1200', 'Segambut', 'Bincheong', 'Cat', 'Male', 'Cancelled', '', '2023-05-09'),
(35, 1, 7, '2023-05-23', '1000-1200', 'Segambut', 'Olaf', 'Dog', 'Male', 'Cancelled', '', '2023-05-18'),
(36, 1, 7, '2023-05-24', '1000-1200', 'Segambut', 'Kopi', 'Fury Pets', 'Male', 'Completed', '', '2023-05-18'),
(37, 1, 7, '2023-05-20', '1500-1700', 'Hang Jebat', 'Cheong', 'Cat', 'Male', 'Pending', '', '2023-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `customer_record`
--

DROP TABLE IF EXISTS `customer_record`;
CREATE TABLE IF NOT EXISTS `customer_record` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `customerEmail` varchar(255) NOT NULL,
  `customerPass` varchar(255) NOT NULL,
  `customerFullname` varchar(255) NOT NULL,
  `customerIC` varchar(255) NOT NULL,
  `customerPhoneNumber` varchar(50) NOT NULL,
  `customerAddress` varchar(255) NOT NULL,
  `customerGender` varchar(20) NOT NULL,
  `customer_status` varchar(50) NOT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_record`
--

INSERT INTO `customer_record` (`customerID`, `customerEmail`, `customerPass`, `customerFullname`, `customerIC`, `customerPhoneNumber`, `customerAddress`, `customerGender`, `customer_status`) VALUES
(1, 'johnpaulose1990@gmail.com', '123456789', 'John Paulose', '031023011128', '0122334272', 'C-10-10, Amadesa Resort, Jalan 5/125, 57100 Desa Petaling', 'Male', 'Active'),
(2, 'ivanwong1223@gmail.com', 'ivanwong123', 'Ivan Wong', '0210031422783', '0123455280', 'Block C, Prima Duta, Level 3, Unit 9, Jalan 2/345, Segambut, KL', 'Male', 'Active'),
(7, 'ho@gmail.com', '123', 'Ho Rong Wei', '021223140493', '01110822898', 'Bandar puteri puchong', 'Male', 'Active'),
(8, 'james123@gmail.com', '1223', 'James', '024443134333', '0193815775', 'Jalan Dutamas', 'Female', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_record`
--

DROP TABLE IF EXISTS `feedback_record`;
CREATE TABLE IF NOT EXISTS `feedback_record` (
  `feedbackID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) NOT NULL,
  `appointmentID` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `feedbackDate` date NOT NULL,
  PRIMARY KEY (`feedbackID`),
  KEY `customerID` (`customerID`),
  KEY `appointmentID` (`appointmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback_record`
--

INSERT INTO `feedback_record` (`feedbackID`, `customerID`, `appointmentID`, `rating`, `comment`, `feedbackDate`) VALUES
(14, 2, 21, 3, 'I will come and visit again!', '2023-05-01'),
(15, 1, 25, 5, 'excellent but could do way more better \n', '2023-05-05'),
(16, 1, 2, 3, 'Outstanding appointment system features', '2023-05-07'),
(17, 7, 36, 4, 'The service is good!', '2023-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `main_services`
--

DROP TABLE IF EXISTS `main_services`;
CREATE TABLE IF NOT EXISTS `main_services` (
  `mainServiceID` int(11) NOT NULL AUTO_INCREMENT,
  `serviceName` varchar(50) NOT NULL,
  `serviceLocation` varchar(255) NOT NULL,
  `serviceStartTime` varchar(5) NOT NULL,
  `serviceEndTime` varchar(5) NOT NULL,
  PRIMARY KEY (`mainServiceID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `main_services`
--

INSERT INTO `main_services` (`mainServiceID`, `serviceName`, `serviceLocation`, `serviceStartTime`, `serviceEndTime`) VALUES
(1, 'Grooming', 'No.7 & 9, Jalan Kuchai Maju 11, Off, Jalan Kuchai Lama, Kuchai Entrepreneurs Park, 58200 Kuala Lumpur', '07:00', '15:00'),
(2, 'Veterinary', 'Jalan Hang Tuah 3, Salak South Garden, 57100 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur', '07:00', '15:00'),
(3, 'Boarding', 'No.7 & 9, Jalan Kuchai Maju 11, Off, Jalan Kuchai Lama, Kuchai Entrepreneurs Park, 58200 Kuala Lumpur', '07:00', '16:00'),
(6, 'Admin/Manager', 'Perdana Exclusive Condominium, B-102, Jalan PJU 8/1, Damansara Perdana, 47820 Petaling Jaya, Selangor', '07:00', '17:00'),
(7, 'Relocation', 'Bukit Jalil', '07:00', '16:00'),
(8, 'Spa', 'Cheras', '07:00', '17:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_record`
--

DROP TABLE IF EXISTS `payment_record`;
CREATE TABLE IF NOT EXISTS `payment_record` (
  `paymentID` int(11) NOT NULL AUTO_INCREMENT,
  `appointmentID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `paymentAmount` int(11) NOT NULL,
  `paymentDate` date NOT NULL,
  `paymentType` varchar(50) NOT NULL,
  PRIMARY KEY (`paymentID`),
  KEY `appointmentID` (`appointmentID`),
  KEY `customerID` (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_record`
--

INSERT INTO `payment_record` (`paymentID`, `appointmentID`, `customerID`, `paymentAmount`, `paymentDate`, `paymentType`) VALUES
(1, 32, 1, 100, '2023-05-07', 'Online Banking'),
(2, 33, 1, 60, '2023-05-07', 'PayPal'),
(3, 34, 1, 100, '2023-05-09', 'Online Banking'),
(5, 35, 7, 51, '2023-05-18', 'Online Banking'),
(7, 36, 7, 51, '2023-05-18', 'Credit/Debit card'),
(9, 37, 7, 51, '2023-05-18', 'PayPal');

-- --------------------------------------------------------

--
-- Table structure for table `service_record`
--

DROP TABLE IF EXISTS `service_record`;
CREATE TABLE IF NOT EXISTS `service_record` (
  `serviceID` int(11) NOT NULL AUTO_INCREMENT,
  `mainServiceID` int(11) NOT NULL,
  `serviceImage` varchar(255) NOT NULL,
  `serviceType` varchar(50) NOT NULL,
  `serviceDescription` varchar(255) NOT NULL,
  `serviceDuration` varchar(50) NOT NULL,
  `servicePrice` decimal(10,2) NOT NULL,
  `petType` varchar(50) NOT NULL,
  `serviceAverageRating` decimal(3,2) NOT NULL,
  `service_status` varchar(50) NOT NULL,
  PRIMARY KEY (`serviceID`),
  KEY `mainServiceID` (`mainServiceID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_record`
--

INSERT INTO `service_record` (`serviceID`, `mainServiceID`, `serviceImage`, `serviceType`, `serviceDescription`, `serviceDuration`, `servicePrice`, `petType`, `serviceAverageRating`, `service_status`) VALUES
(1, 1, 'Dermatologist', 'Basic Service', '', '2 hour', '51.00', 'All', '3.50', 'Active'),
(2, 1, 'f', 'Full Service', '', '2 hour', '60.00', 'All', '4.00', 'Active'),
(3, 2, 'fff', 'Endoscopy', '', '2 hour', '100.00', 'All', '3.50', 'Active'),
(4, 2, 'pet_daycare.jpg', 'Ophthalmologist', '', '2 hour', '120.00', 'Furry Pets', '4.00', 'Active'),
(5, 2, 'pet_daycare.jpg', 'Dermatology', '', '2 hour', '100.00', 'Furry Pets', '4.00', 'Active'),
(7, 2, 'pet_daycare.jpg', 'Dentistry', '', '2 hour', '98.00', 'Furry Pets', '4.00', 'Active'),
(8, 2, 'pet_grooming.webp', 'Physiotherapy', '', '2 hour', '78.00', 'Furry Pets', '4.00', 'Active'),
(13, 2, 'pet_daycare.jpg', 'Vaccination', '', '2 hour', '22.22', 'Dog/Cat', '3.50', 'Active'),
(20, 3, 'pet_daycare.jpg', 'Standard Suite', '', '2 hour', '50.00', 'Furry Pets', '4.00', 'Active'),
(21, 3, 'MicrosoftTeams-image (1).png', 'Luxury Suite', '', '2 hour', '60.00', 'Dog/Cat', '4.50', 'Active'),
(22, 3, 'pet_daycare.jpg', 'Royal Suite', '', '2 hour', '100.00', 'Furry Pets', '5.00', 'Active'),
(23, 3, 'pet_daycare.jpg', 'Cats & Pocket Pets Rooms', '', '2 hour', '40.00', 'Furry Pets', '5.00', 'Active'),
(24, 6, 'admin.png', 'Administrative', '', '', '0.00', '-', '0.00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `staff_record`
--

DROP TABLE IF EXISTS `staff_record`;
CREATE TABLE IF NOT EXISTS `staff_record` (
  `staffID` int(11) NOT NULL AUTO_INCREMENT,
  `mainServiceID` int(11) NOT NULL,
  `staffFullName` varchar(255) NOT NULL,
  `staffEmail` varchar(255) NOT NULL,
  `staffPass` varchar(255) NOT NULL,
  `staffPhoneNumber` varchar(50) NOT NULL,
  `staffAvailability` varchar(50) NOT NULL,
  `staffGender` varchar(20) NOT NULL,
  `staffType` int(11) NOT NULL,
  `staff_status` varchar(50) NOT NULL,
  PRIMARY KEY (`staffID`),
  KEY `serviceID` (`mainServiceID`)
) ENGINE=InnoDB AUTO_INCREMENT=1012 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_record`
--

INSERT INTO `staff_record` (`staffID`, `mainServiceID`, `staffFullName`, `staffEmail`, `staffPass`, `staffPhoneNumber`, `staffAvailability`, `staffGender`, `staffType`, `staff_status`) VALUES
(1003, 1, 'Brian Tan Spr', 'brianna00@gmail.com', '1234566789', '0122104875', 'Available', 'Male', 1, 'Active'),
(1005, 1, 'Brian Wee', 'brianna@student.imu.edu.my', '1234567789', '0122977405', 'Available', 'Male', 1, 'Active'),
(1006, 2, 'xiao', 'xiao@gmail.com', '123', '01110922299', 'Available', 'Male', 1, 'Active'),
(1007, 2, 'john', 'john@yahoo.com', '123', '01110922432', 'Available', 'Male', 1, 'Active'),
(1008, 6, 'Firdaus', 'firdaus@gmail.com', '123', '01110333299', 'Available', 'Female', 2, 'Active'),
(1009, 3, 'Rongwayy', 'rongwei@gmail.com', '123', '045510922432', 'Available', 'Male', 1, 'Active'),
(1010, 3, 'Aiden', 'aiden@gmail.com', '123', '01110922432', 'Available', 'Female', 1, 'Active'),
(1011, 6, 'paikia', 'paikia@yahoo.com', '123456', '01110002020', 'Available', 'Male', 3, 'Active');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_record`
--
ALTER TABLE `appointment_record`
  ADD CONSTRAINT `appointment_record_ibfk_1` FOREIGN KEY (`serviceID`) REFERENCES `service_record` (`serviceID`),
  ADD CONSTRAINT `appointment_record_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer_record` (`customerID`);

--
-- Constraints for table `feedback_record`
--
ALTER TABLE `feedback_record`
  ADD CONSTRAINT `feedback_record_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer_record` (`customerID`),
  ADD CONSTRAINT `feedback_record_ibfk_2` FOREIGN KEY (`appointmentID`) REFERENCES `appointment_record` (`appointmentID`);

--
-- Constraints for table `payment_record`
--
ALTER TABLE `payment_record`
  ADD CONSTRAINT `payment_record_ibfk_1` FOREIGN KEY (`appointmentID`) REFERENCES `appointment_record` (`appointmentID`),
  ADD CONSTRAINT `payment_record_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer_record` (`customerID`);

--
-- Constraints for table `service_record`
--
ALTER TABLE `service_record`
  ADD CONSTRAINT `service_record_ibfk_1` FOREIGN KEY (`mainServiceID`) REFERENCES `main_services` (`mainServiceID`);

--
-- Constraints for table `staff_record`
--
ALTER TABLE `staff_record`
  ADD CONSTRAINT `staff_record_ibfk_1` FOREIGN KEY (`mainServiceID`) REFERENCES `service_record` (`mainServiceID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
