-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 13, 2018 at 09:54 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fixpertr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_first` varchar(256) NOT NULL,
  `admin_last` varchar(256) NOT NULL,
  `admin_uid` varchar(256) NOT NULL,
  `admin_pwd` varchar(256) NOT NULL,
  `admin_image` varchar(256) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_first`, `admin_last`, `admin_uid`, `admin_pwd`, `admin_image`) VALUES
(12, 'Alicia', 'Vikander', 'admin2', '123', '5a7b2cb1ec8e20.39374619.jpg'),
(11, 'Lily', 'Collins', 'admin', '123', '5a7b1bc4a11eb6.64770208.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

DROP TABLE IF EXISTS `markers`;
CREATE TABLE IF NOT EXISTS `markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `address` varchar(256) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_id` (`shop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  `description` text,
  `status` varchar(256) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`schedule_id`),
  KEY `service_id` (`service_id`),
  KEY `shop_id` (`shop_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `user_id`, `service_id`, `shop_id`, `schedule_date`, `description`, `status`) VALUES
(13, 11, 104, 28, '2018-02-16', 'this is a test', 'Cancelled'),
(14, 11, 104, 28, '2018-02-16', 'this is a test', 'Accepted'),
(15, 11, 104, 28, '2018-02-16', 'this is a test', 'Declined'),
(16, 11, 105, 28, '2018-02-15', 'test', 'Pending'),
(17, 11, 44, 32, '2018-02-15', '', 'Pending'),
(18, 10, 107, 28, '2018-02-22', '', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `service_name` varchar(256) NOT NULL,
  `service_description` varchar(256) NOT NULL,
  `service_cost` decimal(13,2) NOT NULL,
  PRIMARY KEY (`service_id`),
  KEY `services_ibfk_1` (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `shop_id`, `service_name`, `service_description`, `service_cost`) VALUES
(44, 32, 'Repair motherboard', 'this is a test', '5000.00'),
(103, 34, 'test', 'test', '100.00'),
(104, 28, 'test 2', 'test 2', '5000.00'),
(105, 28, 'test 3', 'test 3', '7300.00'),
(106, 28, 'test 4', 'test 4', '750.00'),
(107, 28, 'Overhaul', 'this is a test', '30000.00');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
CREATE TABLE IF NOT EXISTS `shops` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_name` varchar(256) NOT NULL,
  `shop_description` varchar(256) NOT NULL,
  `shop_image` varchar(256) NOT NULL,
  `shop_contact` varchar(256) NOT NULL,
  `day_start` varchar(20) NOT NULL,
  `day_end` varchar(20) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `shop_category` varchar(256) NOT NULL,
  PRIMARY KEY (`shop_id`),
  KEY `shops_ibfk_1` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `user_id`, `shop_name`, `shop_description`, `shop_image`, `shop_contact`, `day_start`, `day_end`, `time_start`, `time_end`, `shop_category`) VALUES
(28, 11, 'test shop 3', 'this is for test 3', '5a7bd3d9b96256.62032905.jpg', '999-999-9999', 'Tuesday', 'Thursday', '11:00:00', '19:00:00', 'Auto repair'),
(32, 11, 'Fast Repair', 'you want fast repair? schedule here now!', '5a7bf374dd0232.70360591.jpg', '546-542-3456', 'Wednesday', 'Friday', '22:00:00', '16:01:00', 'Computer/Laptop repair'),
(33, 11, 'Fix Store', 'this is a test', '5a7d39290c6740.89220557.jpg', '567-454-6837', 'Tuesday', 'Thursday', '08:30:00', '17:00:00', 'Computer/Laptop repair'),
(34, 12, 'Red Crow', 'this is a test', '5a7d3b155c3584.27710888.png', '777-777-3456', 'Monday', 'Friday', '10:00:00', '19:00:00', 'Tailoring'),
(35, 12, 'Tailor House', 'this is a test', '5a7d3ba2590e21.11761777.jpg', '123-454-2398', 'Monday', 'Friday', '08:00:00', '18:00:00', 'Tailoring');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_image` varchar(256) DEFAULT NULL,
  `user_gender` varchar(256) DEFAULT NULL,
  `user_address` varchar(256) DEFAULT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_mobile` varchar(20) DEFAULT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL,
  `user_type` varchar(256) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_image`, `user_gender`, `user_address`, `user_email`, `user_mobile`, `user_uid`, `user_pwd`, `user_type`) VALUES
(10, 'Natalie', 'Portman', '5a7b249bb6a609.03093193.jpg\r\n                        ', 'Female', 'Jerusalem, Israel', 'natalie@gmail.com', '7777-777-7777', 'natalie2', '123', 'User'),
(11, 'Nina', 'Dobrev', '5a7b374b44eb19.67480624.jpg', 'Female', 'Sofia, Bulgaria', 'nina@gmail.com', '9999-999-9999', 'nina1', '123', 'Service Provider'),
(12, 'Victoria', 'Justice', '5a7bd1a2c3b7a9.10668302.jpg\r\n                        ', 'Female', 'Hollywood, Florida, United States\\r\\n', 'victoria@gmail.com', '8972-325-2386', 'victoria3', '123', 'Service Provider');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `markers`
--
ALTER TABLE `markers`
  ADD CONSTRAINT `markers_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`shop_id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
