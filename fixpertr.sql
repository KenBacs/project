-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 26, 2018 at 03:10 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `user_id`, `shop_name`, `shop_description`, `shop_image`, `shop_contact`, `shop_hours`, `shop_category`) VALUES
(14, 1, 'KG', 'any computer repair', '5a68f7751a74a2.04698666.jpg', '456-234-6547', 'Wed 10:30 am - 6:00 pm', 'Computer/Laptop repair');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL,
  `user_type` varchar(256) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_email`, `user_uid`, `user_pwd`, `user_type`) VALUES
(1, 'Kenneth', 'Bacayo', 'kennethbacayo@gmail.com', 'ken10', '$2y$10$R4QqdsWeW0Ty1gAPT2Sc0OWcT8zPK8X4fkfx5M6tcBd9wRP6iK4o.', 'Service Provider'),
(2, 'Giem', 'Noel', 'giem@gmail.com', 'giem10', '$2y$10$qn0N3laRa5qJZiIPzoBu4.Q0riXxd3Y8fhR7THIkBdTwKx9k1uff2', 'User');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
