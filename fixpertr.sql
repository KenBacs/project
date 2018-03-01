-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 01, 2018 at 03:18 AM
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
  `admin_image` varchar(256) DEFAULT NULL,
  `date_registered` date NOT NULL,
  `admin_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_first`, `admin_last`, `admin_uid`, `admin_pwd`, `admin_image`, `date_registered`, `admin_status`) VALUES
(14, 'Kenneth', 'Bacayo', 'ken', '123', NULL, '2018-02-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_orders`
--

DROP TABLE IF EXISTS `job_orders`;
CREATE TABLE IF NOT EXISTS `job_orders` (
  `job_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`job_order_id`),
  KEY `schedule_id` (`schedule_id`),
  KEY `job_orders_ibfk_2` (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_orders`
--

INSERT INTO `job_orders` (`job_order_id`, `schedule_id`, `service_id`, `quantity`) VALUES
(4, 3, 126, 1),
(7, 5, 126, 1),
(9, 6, 123, 2),
(14, 4, 125, 1);

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

DROP TABLE IF EXISTS `markers`;
CREATE TABLE IF NOT EXISTS `markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `name` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `markers_ibfk_1` (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `shop_id`, `name`, `address`, `lat`, `lng`, `type`) VALUES
(33, 42, 'Best Bar Ever', '123 Main St', -37.123451, 122.123451, 'bar'),
(34, 42, '', '', 37.453075, -122.152626, 'bar'),
(35, 42, '', '', 37.450485, -122.152458, 'bar');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_id` int(11) NOT NULL,
  `cash_given` decimal(13,2) NOT NULL,
  `amount_paid` decimal(13,2) NOT NULL,
  `amount_change` decimal(13,2) NOT NULL,
  `method` varchar(256) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_time` time NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `schedule_id` (`schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `schedule_id`, `cash_given`, `amount_paid`, `amount_change`, `method`, `payment_date`, `payment_time`) VALUES
(1, 3, '350.00', '350.00', '0.00', 'PayPal', '2018-02-28', '08:03:11');

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
  `schedule_time` time NOT NULL,
  `description` text,
  `claim_date` date DEFAULT NULL,
  `claim_time` time DEFAULT '00:00:00',
  `status` varchar(256) NOT NULL DEFAULT 'Pending',
  `payment_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`schedule_id`),
  KEY `service_id` (`service_id`),
  KEY `shop_id` (`shop_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `user_id`, `service_id`, `shop_id`, `schedule_date`, `schedule_time`, `description`, `claim_date`, `claim_time`, `status`, `payment_status`) VALUES
(3, 17, 128, 43, '2018-03-01', '13:00:00', '', NULL, '00:00:00', 'Ready to Claim', 1),
(4, 18, 124, 42, '2018-03-01', '16:00:00', '', NULL, '00:00:00', 'Done', 0),
(5, 17, 126, 43, '2018-03-02', '15:00:00', '', NULL, '00:00:00', 'Done', 0),
(6, 18, 123, 44, '2018-03-02', '12:00:00', '', NULL, '00:00:00', 'Done', 0),
(7, 17, 126, 43, '2018-02-07', '15:00:00', '', NULL, '00:00:00', 'Accepted', 0),
(8, 20, 124, 42, '2018-03-01', '13:59:00', '', NULL, '00:00:00', 'Accepted', 0),
(9, 18, 124, 42, '2018-03-02', '14:00:00', '', NULL, '00:00:00', 'Accepted', 0);

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
  `service_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`service_id`),
  KEY `services_ibfk_1` (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `shop_id`, `service_name`, `service_description`, `service_cost`, `service_status`) VALUES
(122, 44, 'Brake Repair', 'test', '3000.00', 0),
(123, 44, 'Oil Change', 'test', '1000.00', 1),
(124, 42, 'Alteration', 'test', '100.00', 1),
(125, 42, 'Restyling', 'test', '300.00', 1),
(126, 43, 'Alteration', 'test', '350.00', 1),
(127, 43, 'Alteration', 'test', '350.00', 0),
(128, 43, 'Restyling', 'test', '230.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
CREATE TABLE IF NOT EXISTS `shops` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_cat_id` int(11) NOT NULL,
  `shop_name` varchar(256) NOT NULL,
  `shop_description` varchar(256) NOT NULL,
  `shop_image` varchar(256) NOT NULL,
  `shop_contact` varchar(256) NOT NULL,
  `day_start` varchar(20) NOT NULL,
  `day_end` varchar(20) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `date_created` date NOT NULL,
  `shop_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`shop_id`),
  KEY `shops_ibfk_1` (`user_id`),
  KEY `shop_cat_id` (`shop_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `user_id`, `shop_cat_id`, `shop_name`, `shop_description`, `shop_image`, `shop_contact`, `day_start`, `day_end`, `time_start`, `time_end`, `date_created`, `shop_status`) VALUES
(42, 17, 4, 'Red Crow', 'test', '5a952becd2e141.61971710.png', '123-454-2398', 'Monday', 'Wednesday', '08:00:00', '17:00:00', '2018-02-27', 1),
(43, 18, 4, 'Fast Repair', 'test', '5a952c6ba574e3.28568026.jpg', '324-459-4542', 'Wednesday', 'Sunday', '08:30:00', '19:00:00', '2018-02-27', 1),
(44, 17, 6, 'Garage Repair', 'test', '5a9534960a8546.77518566.jpg', '777-777-3456', 'Monday', 'Saturday', '08:00:00', '20:00:00', '2018-02-27', 0),
(45, 17, 7, 'Repair Shop', 'test', '5a9654cf3ab391.71461464.jpg', '345-678-5674', 'Monday', 'Wednesday', '13:00:00', '18:00:00', '2018-02-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

DROP TABLE IF EXISTS `shop_categories`;
CREATE TABLE IF NOT EXISTS `shop_categories` (
  `shop_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_category` varchar(256) NOT NULL,
  `category_desc` text NOT NULL,
  `category_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`shop_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_categories`
--

INSERT INTO `shop_categories` (`shop_cat_id`, `shop_category`, `category_desc`, `category_status`) VALUES
(4, 'Tailoring', 'test', 1),
(6, 'Automobile ', 'test', 1),
(7, 'Computer and Laptop ', 'test', 1),
(8, 'Appliances and Electronics', 'test', 0),
(9, 'Watch', 'test', 1),
(10, 'Shoes', 'test', 1),
(11, 'Cellphone and Smartphones', 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sub_type_id` int(11) NOT NULL,
  `method` varchar(256) NOT NULL,
  `subscribe_date` date NOT NULL,
  `subscribe_time` time NOT NULL,
  `subscription_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`subscription_id`),
  KEY `user_id` (`user_id`),
  KEY `sub_type_id` (`sub_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`subscription_id`, `user_id`, `sub_type_id`, `method`, `subscribe_date`, `subscribe_time`, `subscription_status`) VALUES
(17, 17, 6, 'Trial', '2018-02-27', '17:48:10', 1),
(18, 18, 6, 'Trial', '2018-02-27', '17:49:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_types`
--

DROP TABLE IF EXISTS `subscription_types`;
CREATE TABLE IF NOT EXISTS `subscription_types` (
  `sub_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_type` varchar(256) NOT NULL,
  `sub_cost` decimal(13,2) NOT NULL,
  `sub_duration` int(11) NOT NULL,
  PRIMARY KEY (`sub_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_types`
--

INSERT INTO `subscription_types` (`sub_type_id`, `sub_type`, `sub_cost`, `sub_duration`) VALUES
(1, '1 month subscription', '250.00', 30),
(2, '3 months subscription', '500.00', 90),
(3, '6 months subscription', '800.00', 183),
(4, '1 year subscription', '1600.00', 365),
(5, 'Deactivate', '0.00', 0),
(6, '7 days FREE trial', '0.00', 7);

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
  `date_registered` date NOT NULL,
  `user_timestamp` timestamp NULL DEFAULT NULL,
  `sub_status` tinyint(4) NOT NULL DEFAULT '0',
  `user_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_image`, `user_gender`, `user_address`, `user_email`, `user_mobile`, `user_uid`, `user_pwd`, `user_type`, `date_registered`, `user_timestamp`, `sub_status`, `user_status`) VALUES
(17, 'Natalie', 'Portman', '5a952cc7c489b3.84716282.jpg', 'Female', 'Jerusalem', 'natalie@gmail.com', '9999-999-9999', 'natalie1', '123', 'Service Provider', '2018-02-27', '2018-02-27 09:48:10', 1, 1),
(18, 'Victoria', 'Justice', '5a952cb2dead87.94267001.jpg', 'Female', 'test', 'victoria@gmail.com', '+639277445743', 'victoria2', '123', 'Service Provider', '2018-02-27', '2018-02-27 09:49:33', 1, 1),
(20, 'Vivien', 'Torrizo', NULL, 'Female', 'Cebu City', 'vien@gmail.com', '7777-777-7777', 'vien', '123', 'User', '2018-02-28', NULL, 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_orders`
--
ALTER TABLE `job_orders`
  ADD CONSTRAINT `job_orders_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_orders_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `markers`
--
ALTER TABLE `markers`
  ADD CONSTRAINT `markers_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shops_ibfk_2` FOREIGN KEY (`shop_cat_id`) REFERENCES `shop_categories` (`shop_cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`sub_type_id`) REFERENCES `subscription_types` (`sub_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
