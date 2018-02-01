-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 30, 2018 at 08:50 AM
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
  KEY `shop_id` (`shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `shop_id`, `service_name`, `service_description`, `service_cost`) VALUES
(1, 21, 'test', 'this is a test', '120.00'),
(2, 21, 'test2', 'test2', '500.00');

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
  `shop_hours` varchar(256) NOT NULL,
  `shop_category` varchar(256) NOT NULL,
  PRIMARY KEY (`shop_id`),
  KEY `shops_ibfk_1` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `user_id`, `shop_name`, `shop_description`, `shop_image`, `shop_contact`, `shop_hours`, `shop_category`) VALUES
(21, 1, 'Gshock', 'shock the world', '5a6c381be49398.10416390.jpg', '999-999-9999', 'Wed 10:30 am - 6:00 pm', 'Watch repair'),
(22, 1, 'Samsung Repair', 'any kind of repair', '5a6c7e808e5c76.53381155.jpg', '432-142-4358', 'Mon - Fri 8 am to 4 pm', 'Computer/Laptop repair'),
(23, 1, 'test4', 'this is a test', '5a6ffad687f472.89986924.jpg', '999-999-9999', 'Wed 10:30 am - 6:00 pm', 'Computer/Laptop repair');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_gender` varchar(256) NOT NULL,
  `user_address` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_mobile` int(20) NOT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL,
  `user_type` varchar(256) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_gender`, `user_address`, `user_email`, `user_mobile`, `user_uid`, `user_pwd`, `user_type`) VALUES
(1, 'Kenneth', 'Bacayo', '0', '0', 'kennethbacayo@gmail.com', 0, 'ken10', '$2y$10$R4QqdsWeW0Ty1gAPT2Sc0OWcT8zPK8X4fkfx5M6tcBd9wRP6iK4o.', 'Service Provider'),
(2, 'Giem', 'Noel', '0', '0', 'giem@gmail.com', 0, 'giem10', '$2y$10$qn0N3laRa5qJZiIPzoBu4.Q0riXxd3Y8fhR7THIkBdTwKx9k1uff2', 'User');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `markers`
--
ALTER TABLE `markers`
  ADD CONSTRAINT `markers_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`shop_id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`shop_id`) ON UPDATE CASCADE;

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
