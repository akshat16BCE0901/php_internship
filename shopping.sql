-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2019 at 08:30 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `admin`(IN id1 int, OUT ad varchar(40))
begin
declare adminnum int;
select isadmin into adminnum from login where id=id1;
IF (adminnum=1) THEN 
SET ad = "ADMIN";
ELSE 
SET ad = "NOT ADMIN";
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dd`()
begin
declare total int(2) DEFAULT 0;
select count(*) into total from login;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dd1`()
begin
declare total int(2) DEFAULT 0;
select count(*) into total from login;
select total;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getall`()
begin
select * from login;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getbyname`(IN name varchar(40))
begin
select * from login where user_id=name;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertintologin`(IN name varchar(20), IN password varchar(20), IN cdate date)
begin
insert into login(`user_id`,`password`,`cdate`) values(name,password,cdate);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `looping`()
begin
declare i int;
set i=1;
while(i<=5) do
select i;
set i=i+1;
end while;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `repeatloop`()
begin
declare i int;
declare str varchar(20);
set i=1;
set str="";
REPEAT
set str= CONCAT(str,i,', ');
set i=i+1;
UNTIL i>=5
end repeat;
select str;
end$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `ddd`() RETURNS date
    DETERMINISTIC
begin
declare dt date;
set dt = curdate();
return dt;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `adminmenus`
--

CREATE TABLE IF NOT EXISTS `adminmenus` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `user` int(10) DEFAULT NULL,
  `menu` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `menu` (`menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `adminmenus`
--

INSERT INTO `adminmenus` (`id`, `user`, `menu`) VALUES
(1, 10, 1),
(2, 10, 2),
(3, 12, 2),
(4, 10, 5),
(5, 10, 4),
(6, 12, 6),
(7, 13, 1),
(8, 13, 2),
(9, 13, 4),
(10, 13, 5),
(11, 13, 6);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Clothing'),
(4, 'hhe'),
(3, 'Laptops and accessories'),
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

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invid`, `amount`, `invdate`, `username`) VALUES
('INVIDakshat1305191', 7500, '2019-05-13', 'akshat'),
('INVIDakshat1305192', 5000, '2019-05-13', 'akshat'),
('INVIDakshat1605191', 5600, '2019-05-16', 'akshat');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `invoicedetails`
--

INSERT INTO `invoicedetails` (`id`, `invid`, `amountpaid`, `depositdate`, `mode`) VALUES
(2, 'INVIDakshat1305191', 2500, '2019-05-13', 'Cash'),
(3, 'INVIDakshat1305191', 2500, '2019-05-13', 'Cash'),
(4, 'INVIDakshat1305192', 500, '2019-05-13', 'Cash'),
(5, 'INVIDakshat1305191', 20, '2019-05-15', 'Cash'),
(6, 'INVIDakshat1605191', 10, '2019-05-18', 'Cash');

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
  `isadmin` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_id`, `password`, `isactive`, `cdate`, `isadmin`) VALUES
(1, 'akshat', 'akshat', 1, '2019-05-18', 0),
(6, 'rakshit', 'rakshit', 1, '2019-05-03', 0),
(8, 'yash', 'yash', 1, '2019-05-05', 0),
(9, 'manoj', 'manoj', 1, '2019-05-17', 1),
(10, 'shashi', 'shashi', 1, '2019-05-06', 1),
(12, 'admin', 'admin', 1, '2019-05-13', 1),
(13, 'master', 'master', 1, '2019-05-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menulist`
--

CREATE TABLE IF NOT EXISTS `menulist` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `href` varchar(500) DEFAULT NULL,
  `parentmenuid` int(2) DEFAULT NULL,
  `isactive` int(11) DEFAULT '1',
  `cdate` date DEFAULT NULL,
  `iconclass` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `menulist`
--

INSERT INTO `menulist` (`id`, `name`, `href`, `parentmenuid`, `isactive`, `cdate`, `iconclass`) VALUES
(1, 'Invoice Details', 'adminallrecords.php', 5, 1, '2019-05-15', ''),
(2, 'Admin Panel', 'adminadminpanel.php?page=1&subpage=1', NULL, 1, '2019-05-15', ''),
(4, 'Individual Invoices', 'adminadmin_details.php', 5, 1, '2019-05-15', ''),
(5, 'Invoices', NULL, NULL, 1, '2019-05-16', ''),
(6, 'Master', 'tables.php?page=1', NULL, 1, '2019-05-16', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`id`, `head_id`, `product_name`, `quantity`, `price`) VALUES
(1, 'PRDCTHDakshat1305191', 'Akshat', 25, 2500),
(2, 'PRDCTHDakshat1305191', 'Akshat', 40, 2500),
(3, 'PRDCTHDakshat1305192', 'Akki123', 25, 2500),
(4, 'PRDCTHDakshat1305199', 'Akk', 25, 2500),
(5, 'PRDCTHDakshat13051910', 'Akk', 85, 3000),
(6, 'PRDCTHDakshat1605193', 'kjbkj', 25, 2500),
(7, 'PRDCTHDakshat1605194', 'akshat', 25, 2500),
(8, 'PRDCTHDakshat1605199', 'Akki', 10, 100);

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
('PRDCTHDakshat1305191', 'akshat', '2019-05-13'),
('PRDCTHDakshat13051910', 'akshat', '2019-05-13'),
('PRDCTHDakshat13051911', 'akshat', '2019-05-13'),
('PRDCTHDakshat13051912', 'akshat', '2019-05-13'),
('PRDCTHDakshat13051913', 'akshat', '2019-05-13'),
('PRDCTHDakshat1305192', 'akshat', '2019-05-13'),
('PRDCTHDakshat1305193', 'akshat', '2019-05-13'),
('PRDCTHDakshat1305194', 'akshat', '2019-05-13'),
('PRDCTHDakshat1305195', 'akshat', '2019-05-13'),
('PRDCTHDakshat1305196', 'akshat', '2019-05-13'),
('PRDCTHDakshat1305197', 'akshat', '2019-05-13'),
('PRDCTHDakshat1305198', 'akshat', '2019-05-13'),
('PRDCTHDakshat1305199', 'akshat', '2019-05-13'),
('PRDCTHDakshat1505191', 'akshat', '2019-05-15'),
('PRDCTHDakshat1505192', 'akshat', '2019-05-15'),
('PRDCTHDakshat1505193', 'akshat', '2019-05-15'),
('PRDCTHDakshat1505194', 'akshat', '2019-05-15'),
('PRDCTHDakshat1505195', 'akshat', '2019-05-15'),
('PRDCTHDakshat1605191', 'akshat', '2019-05-16'),
('PRDCTHDakshat16051910', 'akshat', '2019-05-16'),
('PRDCTHDakshat1605192', 'akshat', '2019-05-16'),
('PRDCTHDakshat1605193', 'akshat', '2019-05-16'),
('PRDCTHDakshat1605194', 'akshat', '2019-05-16'),
('PRDCTHDakshat1605195', 'akshat', '2019-05-16'),
('PRDCTHDakshat1605196', 'akshat', '2019-05-16'),
('PRDCTHDakshat1605197', 'akshat', '2019-05-16'),
('PRDCTHDakshat1605198', 'akshat', '2019-05-16'),
('PRDCTHDakshat1605199', 'akshat', '2019-05-16'),
('PRDCTHDakshat1705191', 'akshat', '2019-05-17'),
('PRDCTHDakshat1805191', 'akshat', '2019-05-18'),
('PRDCTHDmaster1705191', 'master', '2019-05-17');

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
-- Constraints for table `adminmenus`
--
ALTER TABLE `adminmenus`
  ADD CONSTRAINT `adminmenus_ibfk_1` FOREIGN KEY (`user`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `adminmenus_ibfk_2` FOREIGN KEY (`menu`) REFERENCES `menulist` (`id`);

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
