-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 22, 2018 at 07:55 PM
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
(12, 'Alicia', 'Vikander', 'admin2', '123', '5a871c2c5e5678.90159688.jpg'),
(11, 'Lily', 'Collins', 'admin', '123', '5a7b1bc4a11eb6.64770208.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

DROP TABLE IF EXISTS `days`;
CREATE TABLE IF NOT EXISTS `days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `day`) VALUES
(1, 'Sunday'),
(2, 'Monday'),
(3, 'Tuesday'),
(4, 'Wednesday'),
(5, 'Thursday'),
(6, 'Friday'),
(7, 'Saturday');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_orders`
--

INSERT INTO `job_orders` (`job_order_id`, `schedule_id`, `service_id`, `quantity`) VALUES
(19, 33, 109, 1),
(20, 31, 108, 1),
(21, 34, 110, 1),
(22, 35, 108, 2),
(23, 35, 109, 1),
(24, 36, 108, 1),
(25, 37, 110, 1),
(26, 38, 109, 1),
(27, 39, 108, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `shop_id`, `address`, `lat`, `lng`) VALUES
(1, 36, 'test', 10.312936, 123.897301),
(2, 36, 'test 2', 10.311504, 123.892426);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `schedule_id`, `cash_given`, `amount_paid`, `amount_change`, `method`, `payment_date`, `payment_time`) VALUES
(2, 36, '150.00', '150.00', '0.00', 'PayPal', '2018-02-22', '12:45:28'),
(3, 31, '150.00', '150.00', '0.00', 'PayPal', '2018-02-22', '14:09:05'),
(4, 34, '20000.00', '20000.00', '0.00', 'PayPal', '2018-02-22', '15:18:06'),
(5, 35, '600.00', '500.00', '100.00', 'Cash', '2018-02-22', '15:41:46'),
(9, 33, '342.00', '200.00', '142.00', 'Cash', '2018-02-22', '15:54:56');

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
  `claim_date` date DEFAULT '2017-01-01',
  `claim_time` time DEFAULT '00:00:00',
  `status` varchar(256) NOT NULL DEFAULT 'Pending',
  `payment_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`schedule_id`),
  KEY `service_id` (`service_id`),
  KEY `shop_id` (`shop_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `user_id`, `service_id`, `shop_id`, `schedule_date`, `schedule_time`, `description`, `claim_date`, `claim_time`, `status`, `payment_status`) VALUES
(31, 11, 108, 36, '2018-02-22', '14:45:00', '', '2017-01-01', '00:00:00', 'Ready to Claim', 1),
(33, 13, 108, 36, '2018-02-24', '12:00:00', '', '2017-01-01', '00:00:00', 'Ready to Claim', 1),
(34, 11, 110, 37, '2018-02-22', '23:00:00', '', '2017-01-01', '00:00:00', 'Ready to Claim', 1),
(35, 11, 108, 36, '2018-02-28', '14:00:00', '', '2017-01-01', '00:00:00', 'Ready to Claim', 1),
(36, 10, 108, 36, '2018-02-27', '22:25:00', '', '2018-02-22', '21:07:25', 'Claimed', 1),
(37, 10, 110, 37, '2018-02-24', '14:00:00', '', '2017-01-01', '00:00:00', 'Done', 0),
(38, 11, 109, 36, '2018-02-23', '13:31:00', '', '2017-01-01', '00:00:00', 'Done', 0),
(39, 11, 108, 36, '2018-02-23', '12:59:00', '', '2017-01-01', '00:00:00', 'Done', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `shop_id`, `service_name`, `service_description`, `service_cost`) VALUES
(108, 36, 'Alteration', 'test', '150.00'),
(109, 36, 'Restyling', 'test', '200.00'),
(110, 37, 'Overhaul', 'test', '20000.00');

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
  PRIMARY KEY (`shop_id`),
  KEY `shops_ibfk_1` (`user_id`),
  KEY `shop_cat_id` (`shop_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `user_id`, `shop_cat_id`, `shop_name`, `shop_description`, `shop_image`, `shop_contact`, `day_start`, `day_end`, `time_start`, `time_end`) VALUES
(36, 11, 4, 'Red Crow', 'test 1', '5a8729f86c2ee4.38860826.png', '123-454-2398', 'Tuesday', 'Sunday', '07:00:00', '19:00:00'),
(37, 11, 4, 'Garage Repair', 'test 2', '5a873497688618.96936202.jpg', '234-234-7653', 'Monday', 'Friday', '10:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

DROP TABLE IF EXISTS `shop_categories`;
CREATE TABLE IF NOT EXISTS `shop_categories` (
  `shop_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_category` varchar(256) NOT NULL,
  `category_desc` text NOT NULL,
  PRIMARY KEY (`shop_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_categories`
--

INSERT INTO `shop_categories` (`shop_cat_id`, `shop_category`, `category_desc`) VALUES
(4, 'Tailoring', 'test'),
(6, 'Automobile ', 'test'),
(7, 'Computer and Laptop ', 'test'),
(8, 'Appliances and Electronics', 'test'),
(9, 'Watch', 'test'),
(10, 'Shoes', 'test'),
(11, 'Cellphone and Smartphones', 'test');

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
  PRIMARY KEY (`subscription_id`),
  KEY `user_id` (`user_id`),
  KEY `sub_type_id` (`sub_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`subscription_id`, `user_id`, `sub_type_id`, `method`, `subscribe_date`, `subscribe_time`) VALUES
(7, 11, 1, 'PayPal', '2018-02-23', '03:48:59');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_types`
--

INSERT INTO `subscription_types` (`sub_type_id`, `sub_type`, `sub_cost`, `sub_duration`) VALUES
(1, '1 month subscription', '250.00', 30),
(2, '3 months subscription', '500.00', 90),
(3, '6 months subscription', '800.00', 183),
(4, '1 year subscription', '1600.00', 365);

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
  `user_timestamp` timestamp NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_image`, `user_gender`, `user_address`, `user_email`, `user_mobile`, `user_uid`, `user_pwd`, `user_type`, `user_timestamp`) VALUES
(10, 'Natalie', 'Portman', '5a7b249bb6a609.03093193.jpg\r\n                        ', 'Female', 'Jerusalem, Israel', 'natalie@gmail.com', '7777-777-7777', 'natalie2', '123', 'User', '0000-00-00 00:00:00'),
(11, 'Nina', 'Dobrev', '5a7b374b44eb19.67480624.jpg', 'Female', 'Sofia, Bulgaria', 'nina@gmail.com', '9999-999-9999', 'nina1', '123', 'Service Provider', '2018-02-22 19:48:59'),
(12, 'Victoria', 'Justice', '5a7bd1a2c3b7a9.10668302.jpg\r\n                        ', 'Female', 'Hollywood, Florida, United States\\r\\n', 'victoria@gmail.com', '8972-325-2386', 'victoria3', '123', 'Service Provider', '2018-02-21 18:31:26'),
(13, 'Normie', 'Cagandahan', '5a8cef48146704.07072507.png', 'Female', 'V Rama Cebu City', 'normie113@gmail.com', '0935-119-9382', 'normie113', 'normie', 'User', '0000-00-00 00:00:00'),
(14, 'Nor', 'Mie', '5a8cf09f0c6c35.34355533.png', 'Female', 'Cebu City', 'normie@gmail.com', '0943-817-4923', 'Normie', 'normie113', 'Service Provider', '0000-00-00 00:00:00');

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
  ADD CONSTRAINT `markers_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`shop_id`);

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
