-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2019 at 10:01 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopping`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectall`()
begin
select * from login;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Clothing'),
(2, 'Mobile and Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invid` varchar(20) NOT NULL,
  `amount` float DEFAULT NULL,
  `invdate` date DEFAULT NULL,
  `username` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`invid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoicedetails`
--

CREATE TABLE IF NOT EXISTS `invoicedetails` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `invid` varchar(20) DEFAULT NULL,
  `amountpaid` float DEFAULT NULL,
  `depositdate` date DEFAULT NULL,
  `mode` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invid` (`invid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `isactive` tinyint(1) DEFAULT '1',
  `cdate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_id`, `password`, `isactive`, `cdate`) VALUES
(1, 'akshat', 'akshat', 1, '2019-05-03'),
(6, 'rakshit', 'rakshit', 1, '2019-05-03'),
(8, 'yash', 'yash', 1, '2019-05-05'),
(9, 'manoj', 'manoj', 1, '2019-05-05'),
(10, 'shashi', 'shashi', 1, '2019-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

CREATE TABLE IF NOT EXISTS `productdetails` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `head_id` varchar(40) DEFAULT NULL,
  `product_name` varchar(40) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `head_id` (`head_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`id`, `head_id`, `product_name`, `quantity`, `price`) VALUES
(1, 'PRDCTHDakshat0905191', 'Akshat123', 25, 2500),
(2, 'PRDCTHDakshat0905192', 'Akshat123', 25, 2500),
(3, 'PRDCTHDakshat0905193', 'Akshat', 25, 2500),
(4, 'PRDCTHDakshat0905193', 'Akshat', 12, 1500),
(5, 'PRDCTHDakshat1005191', 'Akshat', 25, 2500),
(6, 'PRDCTHDakshat1005191', 'Singhal', 25, 2500);

-- --------------------------------------------------------

--
-- Table structure for table `producthead`
--

CREATE TABLE IF NOT EXISTS `producthead` (
  `id` varchar(40) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producthead`
--

INSERT INTO `producthead` (`id`, `user_id`, `entry_date`) VALUES
('PRDCTHD3', 'akshat', '2019-05-10'),
('PRDCTHDakshat0905191', 'akshat', '2019-05-09'),
('PRDCTHDakshat0905192', 'akshat', '2019-05-09'),
('PRDCTHDakshat0905193', 'akshat', '2019-05-09'),
('PRDCTHDakshat1005191', 'akshat', '2019-05-10'),
('PRDCTHDakshat1005192', 'akshat', '2019-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `sampletable`
--

CREATE TABLE IF NOT EXISTS `sampletable` (
  `head_id` varchar(40) DEFAULT NULL,
  `product_name` varchar(40) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `maincategory` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maincategory` (`maincategory`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `maincategory`) VALUES
(1, 'Menswear', 1),
(2, 'Nightsuits', 1),
(3, 'Charger', 2),
(4, 'Womenswear', 1),
(5, 'Back Covers', 2),
(6, 'Screen Protectors', 2),
(7, 'Earphones/Headphones', 2),
(8, 'KidsWear', 1),
(9, 'Power Banks', 2),
(10, 'Data Cables', 2),
(11, 'Mobile Phones', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD CONSTRAINT `invoicedetails_ibfk_1` FOREIGN KEY (`invid`) REFERENCES `invoice` (`invid`);

--
-- Constraints for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD CONSTRAINT `productdetails_ibfk_1` FOREIGN KEY (`head_id`) REFERENCES `producthead` (`id`);

--
-- Constraints for table `producthead`
--
ALTER TABLE `producthead`
  ADD CONSTRAINT `producthead_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`user_id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`maincategory`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
