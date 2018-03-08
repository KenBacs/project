-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2018 at 10:05 AM
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
  `date_registered` date DEFAULT NULL,
  `time_registered` time DEFAULT NULL,
  `admin_status` tinyint(4) NOT NULL DEFAULT '1',
  `seen` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_first`, `admin_last`, `admin_uid`, `admin_pwd`, `admin_image`, `date_registered`, `time_registered`, `admin_status`, `seen`) VALUES
(14, 'Kenneth', 'Bacayo', 'ken', '123', NULL, '2018-02-14', '09:22:09', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `initial_job_orders`
--

DROP TABLE IF EXISTS `initial_job_orders`;
CREATE TABLE IF NOT EXISTS `initial_job_orders` (
  `init_job_order` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `init_quantity` int(11) NOT NULL,
  PRIMARY KEY (`init_job_order`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `initial_job_orders`
--

INSERT INTO `initial_job_orders` (`init_job_order`, `schedule_id`, `service_id`, `init_quantity`) VALUES
(1, 21, 124, 1),
(3, 26, 123, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_orders`
--

INSERT INTO `job_orders` (`job_order_id`, `schedule_id`, `service_id`, `quantity`) VALUES
(4, 3, 126, 1),
(7, 5, 126, 1),
(9, 6, 123, 2),
(14, 4, 125, 1),
(16, 10, 124, 1),
(17, 12, 124, 1),
(19, 18, 124, 1),
(20, 12, 124, 10),
(23, 17, 124, 1),
(26, 20, 124, 1),
(116, 26, 123, 2);

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
  `marker_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `markers_ibfk_1` (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `shop_id`, `name`, `address`, `lat`, `lng`, `marker_status`) VALUES
(46, 42, 'Red Crow - Mactan', 'M.L.Quezon Ave Lapu-Lapu City, Cebu', 10.312668, 123.955818, 1),
(47, 42, 'Red Crow- Cebu City', 'Gorordo Avenue', 10.312013, 123.903481, 1),
(48, 45, 'Repair Shop -Tabunok', 'Cebu S Rd', 10.259558, 123.831001, 1),
(49, 42, 'Red Crow 2- Cebu City ', 'C. Rosal St.', 10.320198, 123.899918, 1),
(50, 47, 'Smart Repair -Moalboal', 'Santander - Barili - Toledo Rd', 9.960424, 123.401390, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `schedule_id`, `cash_given`, `amount_paid`, `amount_change`, `method`, `payment_date`, `payment_time`) VALUES
(1, 3, '350.00', '350.00', '0.00', 'PayPal', '2018-02-28', '08:03:11'),
(2, 4, '300.00', '300.00', '0.00', 'PayPal', '2018-03-01', '21:26:19'),
(3, 10, '100.00', '100.00', '0.00', 'Cash', '2018-03-05', '19:44:53'),
(4, 6, '2000.00', '2000.00', '0.00', 'PayPal', '2018-03-06', '02:17:35'),
(5, 20, '100.00', '100.00', '0.00', 'Cash', '2018-03-05', '04:35:30'),
(6, 5, '350.00', '350.00', '0.00', 'PayPal', '2018-03-07', '13:25:11'),
(7, 26, '2000.00', '2000.00', '0.00', 'Cash', '2018-03-07', '13:28:25');

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
  `description` varchar(256) DEFAULT 'None',
  `claim_date` date DEFAULT NULL,
  `claim_time` time DEFAULT NULL,
  `status` varchar(256) NOT NULL DEFAULT 'Pending',
  `payment_status` tinyint(4) NOT NULL DEFAULT '0',
  `user_notify` tinyint(4) DEFAULT '0',
  `notify_status` tinyint(4) NOT NULL DEFAULT '0',
  `date_sched_created` date DEFAULT NULL,
  `time_sched_created` time DEFAULT NULL,
  `accept_date` date DEFAULT NULL,
  `accept_time` time DEFAULT NULL,
  `decline_date` date DEFAULT NULL,
  `decline_time` time DEFAULT NULL,
  `decline_message` varchar(256) DEFAULT 'None',
  `done_date` date DEFAULT NULL,
  `done_time` time DEFAULT NULL,
  `rtc_date` date DEFAULT NULL,
  `rtc_time` time DEFAULT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `service_id` (`service_id`),
  KEY `shop_id` (`shop_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `user_id`, `service_id`, `shop_id`, `schedule_date`, `schedule_time`, `description`, `claim_date`, `claim_time`, `status`, `payment_status`, `user_notify`, `notify_status`, `date_sched_created`, `time_sched_created`, `accept_date`, `accept_time`, `decline_date`, `decline_time`, `decline_message`, `done_date`, `done_time`, `rtc_date`, `rtc_time`) VALUES
(3, 17, 128, 43, '2018-03-01', '13:00:00', 'None', NULL, '00:00:00', 'Ready to Claim', 0, 1, 1, '2018-03-26', '15:24:15', NULL, NULL, NULL, NULL, 'None', NULL, NULL, NULL, NULL),
(4, 18, 124, 42, '2018-03-01', '16:00:00', 'None', NULL, '00:00:00', 'Ready to Claim', 1, 1, 1, '2018-02-26', '11:18:39', NULL, NULL, NULL, NULL, 'None', NULL, NULL, NULL, NULL),
(5, 17, 126, 43, '2018-03-02', '15:00:00', 'None', NULL, '00:00:00', 'Ready to Claim', 1, 1, 1, '2018-02-27', '11:44:25', NULL, NULL, NULL, NULL, 'None', NULL, NULL, NULL, NULL),
(6, 18, 123, 44, '2018-03-02', '12:00:00', 'None', NULL, '00:00:00', 'Paid', 1, 1, 1, '2018-02-27', '12:02:52', NULL, NULL, NULL, NULL, 'None', NULL, NULL, NULL, NULL),
(7, 17, 126, 43, '2018-02-07', '15:00:00', 'None', NULL, '00:00:00', 'Accepted', 0, 1, 1, '2018-03-28', '04:28:42', NULL, NULL, NULL, NULL, 'None', NULL, NULL, NULL, NULL),
(8, 20, 124, 42, '2018-03-01', '13:59:00', 'None', NULL, '00:00:00', 'Pending', 0, 1, 1, '2018-02-28', '16:14:07', NULL, NULL, NULL, NULL, 'None', NULL, NULL, NULL, NULL),
(9, 18, 124, 42, '2018-03-02', '14:00:00', 'None', NULL, '00:00:00', 'Declined', 0, 1, 1, '2018-03-01', '09:00:00', NULL, NULL, '2018-03-04', '23:42:40', 'because of the holiday', NULL, NULL, NULL, NULL),
(10, 21, 124, 42, '2018-03-02', '14:01:00', 'None', NULL, '00:00:00', 'Ready to Claim', 1, 1, 1, '2018-03-01', '10:00:00', NULL, NULL, NULL, NULL, 'None', NULL, NULL, NULL, NULL),
(11, 18, 125, 42, '2018-03-04', '12:59:00', 'None', NULL, '00:00:00', 'Declined', 0, 1, 1, '2018-03-01', '10:30:00', NULL, NULL, NULL, NULL, 'None', NULL, NULL, NULL, NULL),
(12, 20, 125, 42, '2018-03-04', '15:00:00', 'None', NULL, '00:00:00', 'Done', 0, 1, 1, '2018-03-03', '00:00:00', '2018-03-03', '19:07:33', '2018-03-03', '19:04:07', 'None', '2018-03-03', '19:08:11', NULL, NULL),
(17, 18, 124, 42, '2018-03-12', '13:00:00', 'None', NULL, '00:00:00', 'Accepted', 0, 1, 1, '2018-03-03', '14:22:02', '2018-03-03', '19:03:36', NULL, NULL, 'None', NULL, NULL, NULL, NULL),
(18, 20, 124, 42, '2018-03-04', '13:00:00', 'None', NULL, NULL, 'Declined', 0, 1, 1, '2018-03-03', '19:25:10', '2018-03-03', '19:39:22', '2018-03-05', '19:22:29', 'because we are fully booked', NULL, NULL, NULL, NULL),
(19, 17, 125, 42, '2018-03-07', '10:59:00', 'Blazer', NULL, NULL, 'Cancelled', 0, 1, 1, '2018-03-05', '09:00:14', NULL, NULL, NULL, NULL, 'None', NULL, NULL, NULL, NULL),
(20, 20, 125, 42, '2018-03-05', '21:00:00', 'Gusto nako usbon ang zipper sakong bag please lang tarong', NULL, NULL, 'Ready to Claim', 1, 1, 1, '2018-03-05', '19:59:33', '2018-03-05', '20:00:37', NULL, NULL, 'None', '2018-03-06', '03:48:33', NULL, NULL),
(21, 23, 124, 42, '2018-03-06', '10:01:00', '', NULL, NULL, 'Accepted', 0, 1, 1, '2018-03-05', '20:02:07', '2018-03-05', '20:02:34', NULL, NULL, 'None', NULL, NULL, NULL, NULL),
(22, 17, 129, 43, '2018-03-06', '12:00:00', '', NULL, NULL, 'Declined', 0, 1, 1, '2018-03-05', '22:09:08', '2018-03-05', '22:10:20', '2018-03-05', '22:15:56', 'it\'s my birthday', NULL, NULL, NULL, NULL),
(23, 21, 130, 47, '2018-03-12', '13:00:00', '', NULL, NULL, 'Accepted', 0, 1, 1, '2018-03-05', '23:09:51', '2018-03-05', '23:11:16', NULL, NULL, 'None', NULL, NULL, NULL, NULL),
(26, 21, 123, 44, '2018-03-19', '12:59:00', '', '2018-03-07', '14:34:49', 'Claimed', 1, 1, 1, '2018-03-07', '11:58:53', '2018-03-07', '11:59:26', NULL, NULL, 'None', '2018-03-07', '12:19:47', '2018-03-07', '13:54:29');

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
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `shop_id`, `service_name`, `service_description`, `service_cost`, `service_status`) VALUES
(122, 44, 'Brake Repair', 'test', '3000.00', 0),
(123, 44, 'Oil Change', 'test', '1000.00', 1),
(124, 42, 'Alteration', 'test', '100.00', 1),
(125, 42, 'Restyling', 'test', '300.00', 1),
(126, 43, 'Alteration', 'test', '350.00', 0),
(127, 43, 'Alteration', 'test', '350.00', 0),
(128, 43, 'Restyling', 'test', '230.00', 0),
(129, 43, 'Oil Change', 'teste', '1000.00', 1),
(130, 47, 'Battery Replacement and Quartz Movements', 'test', '2500.00', 1),
(131, 47, 'Automatic and manually Wound Watches', 'test2', '4000.00', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `user_id`, `shop_cat_id`, `shop_name`, `shop_description`, `shop_image`, `shop_contact`, `day_start`, `day_end`, `time_start`, `time_end`, `date_created`, `shop_status`) VALUES
(42, 17, 4, 'Red Crow', 'test', '5a952becd2e141.61971710.png', '123-454-2398', 'Monday', 'Wednesday', '08:00:00', '17:00:00', '2018-02-27', 1),
(43, 18, 4, 'Fast Repair', 'test', '5a952c6ba574e3.28568026.jpg', '324-459-4542', 'Wednesday', 'Sunday', '08:30:00', '19:00:00', '2018-02-27', 1),
(44, 17, 6, 'Garage Repair', 'test', '5a9534960a8546.77518566.jpg', '777-777-3456', 'Monday', 'Saturday', '08:00:00', '20:00:00', '2018-02-27', 1),
(45, 17, 7, 'Repair Shop', 'test', '5a9654cf3ab391.71461464.jpg', '345-678-5674', 'Monday', 'Wednesday', '13:00:00', '18:00:00', '2018-02-28', 1),
(46, 21, 7, 'Tech Repair', 'test', '5a97fdbf8b5d84.03111443.png', '452-264-2346', 'Monday', 'Sunday', '12:00:00', '20:00:00', '2018-03-01', 1),
(47, 17, 9, 'Smart Repair ', 'test', '5a9d4c1ce7b5d6.92188235.png', '032-236-7351', 'Monday', 'Friday', '08:00:00', '17:00:00', '2018-03-05', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

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
(11, 'Cellphone and Smartphones', 'test', 1),
(12, 'Others', 'test', 1);

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
  `seen_subscribe` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`subscription_id`),
  KEY `user_id` (`user_id`),
  KEY `sub_type_id` (`sub_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`subscription_id`, `user_id`, `sub_type_id`, `method`, `subscribe_date`, `subscribe_time`, `subscription_status`, `seen_subscribe`) VALUES
(18, 18, 6, 'Trial', '2018-02-27', '17:49:33', 1, 1),
(19, 21, 6, 'Trial', '2018-03-01', '21:17:42', 1, 1),
(63, 17, 6, 'Trial', '2018-03-06', '01:50:08', 1, 1),
(64, 17, 5, 'None', '2018-03-06', '01:52:16', 1, 1),
(65, 17, 5, 'None', '2018-03-06', '01:54:05', 1, 1),
(66, 17, 1, 'PayPal', '2018-03-06', '01:55:16', 1, 1),
(67, 17, 5, 'None', '2018-03-06', '08:00:58', 1, 1),
(68, 18, 1, 'PayPal', '2018-03-06', '08:05:53', 1, 1),
(69, 17, 2, 'PayPal', '2018-03-06', '08:08:38', 1, 1);

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
(5, 'Deactivate', '0.00', -1),
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
  `time_registered` time NOT NULL DEFAULT '00:00:00',
  `user_seen` tinyint(4) DEFAULT '0',
  `user_timestamp` timestamp NULL DEFAULT NULL,
  `sub_status` tinyint(4) NOT NULL DEFAULT '0',
  `user_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_image`, `user_gender`, `user_address`, `user_email`, `user_mobile`, `user_uid`, `user_pwd`, `user_type`, `date_registered`, `time_registered`, `user_seen`, `user_timestamp`, `sub_status`, `user_status`) VALUES
(17, 'Natalie', 'Portman', '5a952cc7c489b3.84716282.jpg', 'Female', 'Jerusalem', 'natalie@gmail.com', '+639277445743', 'natalie1', '123', 'Service Provider', '2018-02-27', '00:00:00', 0, '2018-03-06 00:08:38', 1, 1),
(18, 'Victoria', 'Justice', '5a952cb2dead87.94267001.jpg', 'Female', 'test', 'victoria@gmail.com', '+639277445743', 'victoria2', '123', 'Service Provider', '2018-02-27', '00:00:00', 0, '2018-03-06 00:05:53', 1, 1),
(20, 'Vivien', 'Torrizo', '5a9d304ec35837.56388673.jpg', 'Female', 'Cebu City', 'vien@gmail.com', '+639231503525', 'vien', '123', 'User', '2018-02-28', '00:00:00', 0, NULL, 0, 1),
(21, 'Kenneth', 'Bacayo', '5a97fe1d649910.80718961.jpg', 'Male', 'Cebu City', 'ken@gmail.com', '+639325982965', 'ken2017', '123', 'Service Provider', '2018-03-01', '00:00:00', 0, '2018-03-01 13:17:42', 1, 1),
(23, 'Normie', 'Cagandahan', '5a9d30605508a1.99633986.jpg', 'Female', 'Happy Valley Cebu', 'normie113@gmail.com', '+639438174923', 'normie', '123', 'User', '2018-03-02', '00:00:00', 0, NULL, 0, 1),
(24, 'Klimjun', 'Bacayo', NULL, 'Male', 'Cebu City', 'klim@gmail.com', '+639277445743', 'klim', '123', 'User', '2018-03-05', '00:00:00', 0, NULL, 0, 1);

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
