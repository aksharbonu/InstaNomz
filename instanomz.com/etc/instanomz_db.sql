-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Host: mysql.instanomz.com
-- Generation Time: Dec 07, 2013 at 11:44 PM
-- Server version: 5.1.53
-- PHP Version: 5.4.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `instanomz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `hash`, `username`) VALUES
(1, 'akTVIf4DMd46I', 'akshar');

-- --------------------------------------------------------

--
-- Table structure for table `completed_order`
--

CREATE TABLE IF NOT EXISTS `completed_order` (
  `foods` mediumtext NOT NULL,
  `cost` decimal(65,2) NOT NULL,
  `id_restaurant` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobilenumber` varchar(255) NOT NULL,
  `dorm` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id` int(10) NOT NULL,
  `name_restaurant` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `completed_order`
--

INSERT INTO `completed_order` (`foods`, `cost`, `id_restaurant`, `id_user`, `username`, `name`, `email`, `mobilenumber`, `dorm`, `datetime`, `id`, `name_restaurant`) VALUES
('a:3:{s:4:"food";a:2:{i:0;s:14:"Butter Popcorn";i:1;s:18:"Sour Cream Popcorn";}s:5:"price";a:2:{i:0;s:4:"4.00";i:1;s:4:"4.00";}s:8:"quantity";a:2:{i:0;s:1:"2";i:1;s:1:"3";}}', 20.00, 1, 1, 'akshar', 'Akshar Bonu', 'abonu@college.harvard.edu', '8572778590', 'Lionel A21', '2013-12-07 23:11:21', 118, 'Corn & Co');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) NOT NULL COMMENT 'id of restaurant',
  `food` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(65,2) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `uniqueid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`uniqueid`),
  UNIQUE KEY `food_per_restaurant` (`id`,`food`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `food`, `description`, `price`, `available`, `uniqueid`) VALUES
(1, 'Butter Popcorn', 'Butter Flavored', 4.00, 1, 6),
(2, 'Caramel Burrito', 'caramel', 5.00, 1, 15),
(2, 'Chocolate Burrito', 'Chocolate', 3.00, 0, 16),
(1, 'Caramel Popcorn', 'caramel', 5.00, 0, 9),
(2, 'Cheese Burrito', 'Very Cheesy!', 0.99, 1, 10),
(1, 'Sour Cream Popcorn', 'Oh so sour and oh so creamy!', 4.00, 1, 17),
(2, 'Fat Burrito', 'Fatty and tasty', 1.99, 1, 18),
(2, 'Chicken Burrito', 'Lots of chicken', 3.99, 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `pending_order`
--

CREATE TABLE IF NOT EXISTS `pending_order` (
  `foods` mediumtext NOT NULL,
  `cost` decimal(65,2) NOT NULL,
  `id_restaurant` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobilenumber` varchar(255) NOT NULL,
  `dorm` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `status` int(10) NOT NULL,
  `name_restaurant` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `pending_order`
--

INSERT INTO `pending_order` (`foods`, `cost`, `id_restaurant`, `id_user`, `username`, `name`, `email`, `mobilenumber`, `dorm`, `datetime`, `id`, `status`, `name_restaurant`) VALUES
('a:3:{s:4:"food";a:1:{i:0;s:15:"Chicken Burrito";}s:5:"price";a:1:{i:0;s:4:"3.99";}s:8:"quantity";a:1:{i:0;s:1:"4";}}', 15.96, 2, 1, 'akshar', 'Akshar Bonu', 'abonu@college.harvard.edu', '8572778590', 'Lionel A21', '2013-12-07 23:14:58', 120, 0, 'Boloco'),
('a:3:{s:4:"food";a:2:{i:0;s:14:"Butter Popcorn";i:1;s:18:"Sour Cream Popcorn";}s:5:"price";a:2:{i:0;s:4:"4.00";i:1;s:4:"4.00";}s:8:"quantity";a:2:{i:0;s:1:"3";i:1;s:1:"2";}}', 20.00, 1, 1, 'akshar', 'Akshar Bonu', 'abonu@college.harvard.edu', '8572778590', 'Lionel A21', '2013-12-07 23:26:24', 121, 0, 'Corn & Co'),
('a:3:{s:4:"food";a:4:{i:0;s:15:"Caramel Burrito";i:1;s:14:"Cheese Burrito";i:2;s:15:"Chicken Burrito";i:3;s:11:"Fat Burrito";}s:5:"price";a:4:{i:0;s:4:"5.00";i:1;s:4:"0.99";i:2;s:4:"3.99";i:3;s:4:"1.99";}s:8:"quantity";a:4:{i:0;s:1:"3";i:1;s:1:"2";i:2;s:1:', 28.93, 2, 0, 'guest', 'Akshar Bonu', 'abonu@college.harvard.edu', '8572778590', 'Lionel A21', '2013-12-07 23:31:42', 122, 0, 'Boloco'),
('a:3:{s:4:"food";a:4:{i:0;s:15:"Caramel Burrito";i:1;s:14:"Cheese Burrito";i:2;s:15:"Chicken Burrito";i:3;s:11:"Fat Burrito";}s:5:"price";a:4:{i:0;s:4:"5.00";i:1;s:4:"0.99";i:2;s:4:"3.99";i:3;s:4:"1.99";}s:8:"quantity";a:4:{i:0;s:1:"3";i:1;s:1:"2";i:2;s:1:"1";i:3;s:1:"5";}}', 30.92, 2, 1, 'akshar', 'Akshar Bonu', 'abonu@college.harvard.edu', '8572778590', 'Lionel A21', '2013-12-07 23:38:42', 123, 0, 'Boloco');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE IF NOT EXISTS `restaurants` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `username`, `hash`) VALUES
(1, 'cornandco', 'co2tVjb8vawZo'),
(2, 'boloco', 'boGLyPDCxfZ3o');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants_data`
--

CREATE TABLE IF NOT EXISTS `restaurants_data` (
  `id` int(10) NOT NULL,
  `opening_image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `opening_image` (`opening_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurants_data`
--

INSERT INTO `restaurants_data` (`id`, `opening_image`, `name`) VALUES
(1, 'cornandco.png', 'Corn & Co'),
(2, 'boloco.png', 'Boloco');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobilenumber` varchar(255) NOT NULL,
  `dorm` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `mobilenumber` (`mobilenumber`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hash`, `name`, `email`, `mobilenumber`, `dorm`) VALUES
(1, 'akshar', 'akTVIf4DMd46I', 'Akshar Bonu', 'abonu@college.harvard.edu', '8572778590', 'Lionel A21'),
(3, 'test', '$1$/E6wE4n/$kVK4uBn19agdqh7VRSXKj1', 'test', 'test@yahoo.com', '9292929292', '32'),
(4, 'manju', '$1$.I2qYx0G$55faOKChxzEmbgcFAJ/S//', 'Manju Rani', 'ranim@wpro.net', '1234567890', 'Lionel A21'),
(5, 'haighcg', '$1$mTJr8eQu$cZTMWv8YI978hK/xX//pR1', 'chris', 'chaigh@college.harvard.edu', '2462462466', 'G-12'),
(6, 'jsani', '$1$AwpYCsxc$40GmQbY5EbunPYZCtdF1x1', 'Jayant Sani', 'jayantsani@college.harvard.edu', '5162861474', 'Apley 32'),
(9, 'lance', '$1$8NZHepJG$76VXule7BhOWdNoKquH.y.', 'Lance Katigbak', 'lkatigbak@college.harvard.edu', '4435404437', 'Quincy S404');
