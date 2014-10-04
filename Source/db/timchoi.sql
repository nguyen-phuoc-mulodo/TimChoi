-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2014 at 04:17 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `timchoi`
--
CREATE DATABASE IF NOT EXISTS `timchoi` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `timchoi`;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `long` double NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `description`, `image`, `lat`, `long`, `user_id`) VALUES
(3, 'Nhà của Phước', 'Ngôi nhà có nhiều kỉ niệm', 'shin01.jpg', 10.7781091, 106.6486143, 1),
(4, 'Nhà trọ của Shin', 'Bên cạnh nhà nữ xinh xắn ^^', 'shin.jpg', 10.8513393, 106.75931800000001, 0),
(5, 'Cơ Đốc Nhân VIệt Nam', 'Người phục vụ', '', 10.813921, 106.770554, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fb_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `begin_date` date NOT NULL,
  `access_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fb_id` (`fb_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fb_id`, `name`, `firstname`, `lastname`, `email`, `birthday`, `begin_date`, `access_token`) VALUES
(1, '890446910969119', 'Phuoc Huu Nguyen', 'Phuoc', 'Nguyen', NULL, NULL, '0000-00-00', NULL),
(2, '733483330050824', 'Đỗ Minh Chí', 'Minh Chí', 'Đỗ', NULL, NULL, '0000-00-00', NULL),
(3, '734430269947205', 'Tất Thiện', 'Tất', 'Thiện', 'yawatakashi@gmail.com', '0000-00-00', '2014-09-08', 'CAAJ4LGdPR8MBALxKinetzQh9yxUr9flSyOXcLqmIWXZBcEOIuAdsLAbFj3hZBhL8LtUP7WxAXlxa9vShkEyZBnU2dopVaWY4ZAt');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
