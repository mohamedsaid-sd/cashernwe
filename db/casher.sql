-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2024 at 02:45 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `casher`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `user`, `pass`) VALUES
(1, 'Super Admin', 'admin', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `qount` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`) VALUES
(1, 'Ù…Ø´Ø±ÙˆØ¨Ø§Øª Ø¨Ø§Ø±Ø¯Ø©'),
(2, 'Ù…Ø´Ø±ÙˆØ¨Ø§Øª Ø³Ø§Ø®Ù†Ø©'),
(3, 'Ù…Ø£ÙƒÙˆÙ„Ø§Øª');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `product` varchar(100) NOT NULL,
  `qount` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `sumation` varchar(50) NOT NULL,
  `total` varchar(10) NOT NULL DEFAULT '0',
  `user_id` varchar(100) NOT NULL,
  `waiter_id` varchar(100) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `present`
--

CREATE TABLE `present` (
  `id` int(11) NOT NULL,
  `present` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `present`
--

INSERT INTO `present` (`id`, `present`) VALUES
(1, '10');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `barcode` varchar(10) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `barcode`, `name`, `price`, `cat`) VALUES
(3, '', 'Ù‚Ù‡ÙˆØ© Ø¹Ø§Ø¯ÙŠØ©', '100', '2'),
(4, '', 'Ù‚Ù‡ÙˆØ© ÙƒØ¨ÙŠØ±Ø©', '200', '2'),
(5, '', 'Ù‚Ù‡ÙˆØ© Ù…ØªÙˆØ³Ø·Ø©', '150', '2'),
(6, '', 'Ù‚Ù‡ÙˆØ© Ø­Ø¨Ø´ÙŠØ©', '200', '2'),
(7, '', 'Ø´Ø§ÙŠ', '120', '2'),
(8, '', 'Ù†Ø¹Ù†Ø§Ø¹', '100', '2'),
(9, '', 'Ø´ÙŠØ±ÙŠØ§', '140', '2'),
(10, '', 'Ø´Ø§ÙŠ Ù„Ø¨Ù†', '250', '2'),
(11, '', 'Ù†Ø³ÙƒØ§ÙÙŠÙ‡', '300', '2'),
(12, '', 'Ø§ÙˆÙÙ„ØªÙŠÙ†', '160', '2'),
(13, '', 'ÙØ±Ø§ÙˆÙ„Ø© Ø¨Ø§Ù„Ø­Ù„ÙŠØ¨', '200', '1'),
(14, '', 'Ù…Ø§Ù†Ø¬Ùˆ Ø¨Ø§Ù„Ø­Ù„ÙŠØ¨', '200', '1'),
(15, '', 'Ø¨Ø±ØªÙ‚Ø§Ù„', '250', '1'),
(16, '', 'Ù„ÙŠÙ…ÙˆÙ† Ù†Ø¹Ù†Ø§Ø¹', '140', '1'),
(17, '', 'Ù…Ø´ÙƒÙ„', '200', '1'),
(18, '', 'Ù†Øµ Ø¶Ø±Ø¨Ø©', '250', '1'),
(19, '', 'Ø§Ù†Ø¯ÙˆÙ…ÙŠ Ø¹Ø§Ø¯ÙŠ', '100', '3'),
(20, '', 'Ø§Ù†Ø¯ÙˆÙ…ÙŠ Ø¨Ø§Ù„Ø¬Ø¨Ù†Ø©', '230', '3'),
(21, '', 'Ø§Ù†Ø¯ÙˆÙ…ÙŠ Ø¨Ø§Ù„Ø°Ø±Ø©', '240', '3'),
(22, '', 'Ø²Ù„Ø§Ø¨ÙŠØ© ØµØºÙŠØ±', '100', '3'),
(23, '', 'Ø²Ù„Ø§Ø¨ÙŠØ© ÙˆØ³Ø·', '150', '3'),
(24, '', 'Ø²Ù„Ø§Ø¨ÙŠØ§ ÙƒØ¨ÙŠØ±', '200', '3'),
(25, '', 'Ø²Ù„Ø§Ø¨ÙŠØ§ Ø¨Ø§Ù„Ù†ÙˆØªÙŠÙ„Ø§', '250', '3'),
(26, '', 'Ø´ÙŠØ´Ø© ', '100', '4'),
(27, '', 'Ø§ÙŠØ³ ÙƒØ±ÙŠÙ…', '100', '1'),
(28, '', 'Ø³Ù†Ø¯ÙˆØªØ´ Ø´ÙŠØ©', '200', '3'),
(31, '', 'Ø³Ù†Ø¯ÙˆØªØ´ Ø¨Ø·Ø§Ø·Ø³', '140', '3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `pass`) VALUES
(1, 'ÙƒØ§Ø´ÙŠØ±', 'user', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `waiter`
--

CREATE TABLE `waiter` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `waiter`
--

INSERT INTO `waiter` (`id`, `name`, `phone`) VALUES
(1, 'Ø§Ù„Ù†Ø§Ø¯Ù„ Ø§Ù„Ø§ÙˆÙ„', '092345678'),
(2, 'Ø§Ù„Ù†Ø§Ø¯Ù„ Ø§Ù„Ø«Ø§Ù†ÙŠ', '093638837');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `present`
--
ALTER TABLE `present`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waiter`
--
ALTER TABLE `waiter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `present`
--
ALTER TABLE `present`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `waiter`
--
ALTER TABLE `waiter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
