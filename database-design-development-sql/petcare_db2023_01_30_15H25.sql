-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2023 at 09:25 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petcare_db`
--
CREATE DATABASE IF NOT EXISTS `petcare_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `petcare_db`;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `booking_date` datetime NOT NULL,
  `client_id` tinyint(11) NOT NULL,
  `pet_id` tinyint(11) NOT NULL,
  `booking_description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `fk_booking_client` (`client_id`),
  KEY `fk_booking_pet` (`pet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_date`, `client_id`, `pet_id`, `booking_description`) VALUES
(1, '2022-10-03 14:00:33', 10, 1, NULL),
(2, '2022-10-03 14:00:33', 11, 2, NULL),
(3, '2022-11-23 13:00:33', 12, 3, NULL),
(4, '2022-11-23 08:00:33', 14, 4, NULL),
(5, '2022-11-11 10:00:33', 13, 5, NULL),
(6, '2022-11-12 13:30:33', 15, 6, NULL),
(7, '2022-12-27 15:00:33', 16, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

DROP TABLE IF EXISTS `booking_detail`;
CREATE TABLE IF NOT EXISTS `booking_detail` (
  `booking_detail_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `booking_id` tinyint(11) NOT NULL,
  `service_id` tinyint(11) NOT NULL,
  `exchange_status` tinyint(1) NOT NULL,
  `staff_id` tinyint(11) DEFAULT NULL,
  PRIMARY KEY (`booking_detail_id`),
  KEY `fk_bookdetail_booking` (`booking_id`),
  KEY `fk_bookdetail_service` (`service_id`),
  KEY `fk_bookdetail_staff` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_detail`
--

INSERT INTO `booking_detail` (`booking_detail_id`, `booking_id`, `service_id`, `exchange_status`, `staff_id`) VALUES
(15, 1, 1, 1, 1),
(16, 2, 2, 1, 2),
(17, 3, 2, 1, 3),
(18, 4, 3, 1, 4),
(19, 5, 3, 1, 5),
(20, 6, 3, 0, NULL),
(21, 7, 4, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(60) NOT NULL,
  `client_address` varchar(80) NOT NULL,
  `client_phone` varchar(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `client_address`, `client_phone`, `username`, `password`, `email`) VALUES
(10, 'Phong Tran', 'A99 area, Nam Trung Yen, Ha Noi', '0123456789', 'phongdz', 'fcea920f7412b5da7be0cf42b8c93759', 'tranphong2077@gmail.com'),
(11, 'Duy Pham', '123 Yen Hoa road, Ha Noi', '0987654321', 'duyp', 'e10adc3949ba59abbe56e057f20f883e', 'duy@gmail.com'),
(12, 'Kien Le', '88 Ho Chi Minh road, Hanoi', '0383736722', 'kiena', '06d10439ccbaf522a4ab259df044292b', 'kien@gmail.com'),
(13, 'Minh Nguyen', '123 Banh Chung road, Hanoi', '0573762644', 'minhn', '226ee086aa60b0d2611346cd7ded6dad', 'minhng@gmail.com'),
(14, 'Minh Vu', '99 Ta Hien street, Hanoi', '0374646536', 'minhvu', '4d1b1360997adfe21b9de68412d18288', 'minhvu@gmail.com'),
(15, 'Duc Tran', '803 Khuat Duy Tien road, Hanoi', '0938746644', 'ductran', '363970e0a24ff8050ea99c402401e83e', 'ductran@gmail.com'),
(16, 'Hoang Lam', '150 Banh Chung road, Hanoi', '0887564663', 'lam', '13521a6a4031c927a060d7230cd8b5f8', 'lam@gmail.com'),
(17, 'Huy Nguyen', '77 Quyet Thang street, Hanoi', '0283767736', 'huynl', '8b44b53ec7370c02f899c97c10198fc7', 'huyoppa@gmail.com'),
(18, 'Tung Tran', '823 Khuat Duy Tien road, Hanoi', '0374646536', 'tungt', '532c419769d9d3219dd8b7e59e8ea480', 'tungtran@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(60) NOT NULL,
  `department_description` varchar(250) DEFAULT NULL,
  `department_date_started` date NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `department_description`, `department_date_started`) VALUES
(1, 'manager', 'manage all things from department, man-made, and customers with pets', '2022-12-06'),
(3, 'caretaker', 'take care of client\'s pets', '2022-12-19'),
(4, 'cashier', 'Payment to customers', '2022-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `image_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(40) NOT NULL,
  `image_description` varchar(150) DEFAULT NULL,
  `image_src` varchar(100) NOT NULL,
  `pet_id` tinyint(11) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `fk_image_pet` (`pet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `image_name`, `image_description`, `image_src`, `pet_id`) VALUES
(1, 'mecat', 'cat beautiful', 'localhost:81/image/mecat.jpg', 5),
(2, 'dogge', 'small dog', 'localhost:81/image/dogge.jpg', 1),
(3, 'gau', 'big dog', 'localhost:81/image/gau.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

DROP TABLE IF EXISTS `pet`;
CREATE TABLE IF NOT EXISTS `pet` (
  `pet_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `pet_name` varchar(50) NOT NULL,
  `pet_born` int(11) NOT NULL,
  `species_id` tinyint(11) NOT NULL,
  `client_id` tinyint(11) NOT NULL,
  `pet_gender` tinyint(1) NOT NULL,
  PRIMARY KEY (`pet_id`),
  KEY `fk_pet_client` (`client_id`),
  KEY `fk_pet_species` (`species_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`pet_id`, `pet_name`, `pet_born`, `species_id`, `client_id`, `pet_gender`) VALUES
(1, 'cathy', 2018, 1, 10, 0),
(2, 'Shellie', 2019, 1, 11, 1),
(3, 'Alo', 2019, 3, 12, 1),
(4, 'Pip', 2020, 1, 14, 1),
(5, 'Tit', 2020, 2, 13, 1),
(6, 'Tut', 2021, 2, 15, 0),
(7, 'Tot', 2022, 1, 16, 0),
(8, 'Micro', 2020, 2, 17, 1),
(9, 'Tabu', 2020, 2, 18, 0),
(10, 'cathyyyy', 2018, 2, 15, 1),
(11, 'athy', 2020, 1, 16, 0);

--
-- Triggers `pet`
--
DROP TRIGGER IF EXISTS `check_pet_gender`;
DELIMITER $$
CREATE TRIGGER `check_pet_gender` BEFORE INSERT ON `pet` FOR EACH ROW BEGIN
    IF NEW.pet_gender  < 0 or NEW.pet_gender > 1 THEN 
          SIGNAL SQLSTATE '45000' SET
          MESSAGE_TEXT = 'Cant not set gender not eqal 0 or 1';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `check_pet_gender_update`;
DELIMITER $$
CREATE TRIGGER `check_pet_gender_update` BEFORE UPDATE ON `pet` FOR EACH ROW BEGIN
    IF NEW.pet_gender < 0 or NEW.pet_gender > 1 THEN 
          SIGNAL SQLSTATE '45000' SET
          MESSAGE_TEXT = 'Cant not set gender not eqal 0 or 1';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

DROP TABLE IF EXISTS `progress`;
CREATE TABLE IF NOT EXISTS `progress` (
  `progress_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `progress_name` varchar(60) NOT NULL,
  `progress_stage` tinyint(1) NOT NULL,
  `progress_end_date` datetime DEFAULT NULL,
  `booking_detail_id` tinyint(11) NOT NULL,
  `progress_start_date` datetime NOT NULL,
  PRIMARY KEY (`progress_id`),
  UNIQUE KEY `booking_detail_id` (`booking_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`progress_id`, `progress_name`, `progress_stage`, `progress_end_date`, `booking_detail_id`, `progress_start_date`) VALUES
(1, 'spa for pet', 1, '2022-10-03 14:17:28', 15, '2022-10-03 14:00:28'),
(2, 'manicure for pet', 1, NULL, 16, '2022-10-13 14:00:20'),
(3, 'manicure for pet', 2, NULL, 17, '2022-11-23 13:00:21'),
(4, 'vaccine for pet', 1, NULL, 18, '2022-10-11 08:00:21'),
(5, 'vaccine for pet', 1, NULL, 19, '2022-11-11 10:00:21');

--
-- Triggers `progress`
--
DROP TRIGGER IF EXISTS `check_progress_endstartdate_insert`;
DELIMITER $$
CREATE TRIGGER `check_progress_endstartdate_insert` BEFORE INSERT ON `progress` FOR EACH ROW BEGIN
    IF (NEW.progress_end_date IS NOT NULL && NEW.progress_end_date < NEW.progress_start_date) THEN 
          SIGNAL SQLSTATE '45000' SET
          MESSAGE_TEXT = 'Please make sure that start date is before end date';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `check_progress_endstartdate_update`;
DELIMITER $$
CREATE TRIGGER `check_progress_endstartdate_update` BEFORE UPDATE ON `progress` FOR EACH ROW BEGIN
    IF (NEW.progress_end_date IS NOT NULL && NEW.progress_end_date > NEW.progress_start_date) THEN 
          SIGNAL SQLSTATE '45000' SET
          MESSAGE_TEXT = 'Please make sure that start date is before end date';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `check_progress_insert`;
DELIMITER $$
CREATE TRIGGER `check_progress_insert` BEFORE INSERT ON `progress` FOR EACH ROW BEGIN
    IF NEW.progress_stage < 0 or NEW.progress_stage > 2 THEN 
          SIGNAL SQLSTATE '45000' SET
          MESSAGE_TEXT = 'Please set progress stage 0 or 1 or 2';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `check_progress_update`;
DELIMITER $$
CREATE TRIGGER `check_progress_update` BEFORE INSERT ON `progress` FOR EACH ROW BEGIN
    IF NEW.progress_stage < 0 or NEW.progress_stage > 2 THEN 
          SIGNAL SQLSTATE '45000' SET
          MESSAGE_TEXT = 'Please set progress stage 0 or 1 or 2';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

DROP TABLE IF EXISTS `receipt`;
CREATE TABLE IF NOT EXISTS `receipt` (
  `receipt_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `receipt_term` tinyint(1) NOT NULL,
  `status_payment` tinyint(1) NOT NULL,
  `client_id` tinyint(11) NOT NULL,
  `booking_detail_id` tinyint(11) NOT NULL,
  `receipt_description` varchar(200) DEFAULT NULL,
  `staff_id` tinyint(11) NOT NULL,
  `total_costs` bigint(20) NOT NULL,
  PRIMARY KEY (`receipt_id`),
  KEY `fk_receipt_staff` (`staff_id`),
  KEY `fk_receipt_client` (`client_id`),
  KEY `fk_receipt_booking_detail` (`booking_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `receipt_term`, `status_payment`, `client_id`, `booking_detail_id`, `receipt_description`, `staff_id`, `total_costs`) VALUES
(1, 1, 1, 11, 16, '???', 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
CREATE TABLE IF NOT EXISTS `request` (
  `request_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `request_start_date` datetime NOT NULL,
  `request_end_date` datetime DEFAULT NULL,
  `client_id_send` tinyint(11) NOT NULL,
  `client_id_request` tinyint(11) NOT NULL,
  `request_status` tinyint(1) NOT NULL,
  `pet_id_send` tinyint(11) NOT NULL,
  `request_description` varchar(200) DEFAULT NULL,
  `pet_id_request` tinyint(11) NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `fk_request_pet_send` (`pet_id_send`),
  KEY `fk_request_pet_request` (`pet_id_request`),
  KEY `fk_request_client_send` (`client_id_send`),
  KEY `fk_request_client_request` (`client_id_request`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `request_start_date`, `request_end_date`, `client_id_send`, `client_id_request`, `request_status`, `pet_id_send`, `request_description`, `pet_id_request`) VALUES
(3, '2022-10-30 12:00:06', '2022-10-30 14:00:06', 17, 18, 2, 8, NULL, 9);

--
-- Triggers `request`
--
DROP TRIGGER IF EXISTS `check_request_endstartdate_insert`;
DELIMITER $$
CREATE TRIGGER `check_request_endstartdate_insert` BEFORE INSERT ON `request` FOR EACH ROW BEGIN
    IF (NEW.request_end_date IS NOT NULL && NEW.request_end_date < NEW.request_start_date) THEN 
          SIGNAL SQLSTATE '45000' SET
          MESSAGE_TEXT = 'Please make sure that start date is before end date';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `check_request_endstartdate_update`;
DELIMITER $$
CREATE TRIGGER `check_request_endstartdate_update` BEFORE UPDATE ON `request` FOR EACH ROW BEGIN
    IF (NEW.request_end_date IS NOT NULL && NEW.request_end_date < NEW.request_start_date) THEN 
          SIGNAL SQLSTATE '45000' SET
          MESSAGE_TEXT = 'Please make sure that start date is before end date';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `status_request_insert`;
DELIMITER $$
CREATE TRIGGER `status_request_insert` BEFORE INSERT ON `request` FOR EACH ROW BEGIN
    IF NEW.request_status < 0 or NEW.request_status > 2 THEN 
          SIGNAL SQLSTATE '45000' SET
          MESSAGE_TEXT = 'Please set progress stage 0 or 1 or 2';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `status_request_update`;
DELIMITER $$
CREATE TRIGGER `status_request_update` BEFORE UPDATE ON `request` FOR EACH ROW BEGIN
    IF NEW.request_status < 0 or NEW.request_status > 2 THEN 
          SIGNAL SQLSTATE '45000' SET
          MESSAGE_TEXT = 'Please set progress stage 0 or 1 or 2';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `service_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(60) NOT NULL,
  `service_description` varchar(200) NOT NULL,
  `service_duration` float NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `service_description`, `service_duration`, `price`) VALUES
(1, 'Spa', 'wash feathers', 10, 3.35),
(2, 'manicure', 'cut nail', 15, 4.25),
(3, 'vaccinations', 'inject different vaccines', 35, 3),
(4, 'teeth cleaning', 'clean teeth', 10.5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `species`
--

DROP TABLE IF EXISTS `species`;
CREATE TABLE IF NOT EXISTS `species` (
  `species_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `species_name` varchar(50) NOT NULL,
  `species_description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`species_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `species`
--

INSERT INTO `species` (`species_id`, `species_name`, `species_description`) VALUES
(1, 'dog', NULL),
(2, 'cat', NULL),
(3, 'parrot', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(60) NOT NULL,
  `staff_type` tinyint(1) NOT NULL,
  `department_id` tinyint(11) NOT NULL,
  `staff_username` varchar(10) NOT NULL,
  `staff_email` varchar(60) NOT NULL,
  `staff_password` varchar(100) NOT NULL,
  PRIMARY KEY (`staff_id`),
  KEY `fk_staff_department` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_type`, `department_id`, `staff_username`, `staff_email`, `staff_password`) VALUES
(1, 'Huy Tran', 0, 1, 'duc', 'duc2077@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Duc Tran', 1, 3, 'duct', 'huy.n.2001@gmail.com', '8b44b53ec7370c02f899c97c10198fc7'),
(3, 'Minh Tran', 1, 3, 'minh', 'minh@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(4, 'Hoang Tran', 1, 3, 'hoangtran', 'hoangtran@gmail.com', 'a8698009bce6d1b8c2128eddefc25aad'),
(5, 'Anh Tran', 1, 3, 'anhtran', 'anhtran@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f'),
(6, 'Duc Tung', 1, 4, 'ductung', 'ductung@gmail.com', '9380d7b36b597fc08974b296b9954ad5');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`),
  ADD CONSTRAINT `fk_booking_pet` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`pet_id`);

--
-- Constraints for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD CONSTRAINT `fk_bookdetail_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`),
  ADD CONSTRAINT `fk_bookdetail_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`),
  ADD CONSTRAINT `fk_bookdetail_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_image_pet` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`pet_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `fk_pet_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pet_species` FOREIGN KEY (`species_id`) REFERENCES `species` (`species_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `fk_progress_booking` FOREIGN KEY (`booking_detail_id`) REFERENCES `booking_detail` (`booking_detail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `fk_receipt_booking_detail` FOREIGN KEY (`booking_detail_id`) REFERENCES `booking_detail` (`booking_detail_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_receipt_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_receipt_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `fk_request_client_request` FOREIGN KEY (`client_id_request`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_request_client_send` FOREIGN KEY (`client_id_send`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_request_pet_request` FOREIGN KEY (`pet_id_request`) REFERENCES `pet` (`pet_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_request_pet_send` FOREIGN KEY (`pet_id_send`) REFERENCES `pet` (`pet_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `fk_staff_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
