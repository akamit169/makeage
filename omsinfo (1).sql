-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2019 at 07:15 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omsinfo`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(110) NOT NULL,
  `parent_id` tinyint(3) NOT NULL COMMENT '0 for category otherwise id represent subcategory of categroy ',
  `image` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `phone` varchar(110) NOT NULL,
  `fax` varchar(110) NOT NULL,
  `website` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `latitude` int(110) NOT NULL,
  `longitude` int(110) NOT NULL,
  `registration_number` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `phone`, `fax`, `website`, `address`, `latitude`, `longitude`, `registration_number`, `created_at`, `updated_at`) VALUES
(3, 'abcl', '', '878787878787', '', 'u 11/31-32 dlf phase 3', 0, 0, '9090909090', '2018-09-01 10:38:12', '2018-09-01 10:38:12'),
(4, 'Mr', '', '323', '', '23', 0, 0, '23', '2018-09-01 10:59:39', '2018-09-01 10:59:39'),
(7, 'Shimla', '', '323232', '', 'u 11/31-32 dlf phase 3', 0, 0, '33333', '2018-09-01 11:35:45', '2018-09-01 11:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `inventry`
--

CREATE TABLE `inventry` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `price` int(110) NOT NULL,
  `quantity` int(110) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invertry_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `inventry_approval_status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_name` varchar(250) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_status` int(11) NOT NULL,
  `order_created_by` int(11) NOT NULL,
  `production_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_image` varchar(250) NOT NULL,
  `product_created_by` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `gender` tinyint(1) UNSIGNED DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `aadhar_number` varchar(250) NOT NULL,
  `pan_number` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `country_name` varchar(80) DEFAULT NULL,
  `state_name` varchar(100) DEFAULT NULL,
  `average_ratting` float(2,1) DEFAULT NULL,
  `role` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 for admin  2 sales Man and 3 for production',
  `status` tinyint(1) UNSIGNED NOT NULL COMMENT '1 for active 0 deactive',
  `is_verified` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '1 for verified 0 not verified',
  `total_like_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `remember_token` varchar(120) DEFAULT NULL,
  `latitude` varchar(110) NOT NULL,
  `longitude` varchar(110) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `mobile_number`, `email`, `name`, `password`, `gender`, `company_id`, `image`, `date_of_birth`, `aadhar_number`, `pan_number`, `address`, `country_name`, `state_name`, `average_ratting`, `role`, `status`, `is_verified`, `total_like_count`, `remember_token`, `latitude`, `longitude`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, '08010152565', 'sudhanshu.barola@gmail.com', 'Amit Kumar', '$2y$10$cNsgxNyOEoHZ5nxeBIJEU.PGXeTJl/L9cb3Vh4oW2tSTTuSMLBD16', NULL, 3, '', NULL, '123456', '', 'Sector 62', NULL, NULL, NULL, 1, 2, 1, 0, NULL, '', '', NULL, '2018-09-01 10:38:12', '2019-01-17 16:04:56'),
(5, '0801 015 2525', 'sudhanshu.barol1a@gmail.com', 'Amit Kumar', '$2y$10$N8r.9Uzgg.DvUGzxqcEao.TTQQUjivDqcsKN2FOhOfn49U93Nbg5G', NULL, 4, '', NULL, '43434343', '', 'Sector 62', NULL, NULL, NULL, 1, 2, 1, 0, NULL, '', '', NULL, '2018-09-01 10:59:39', '2018-09-01 10:59:39'),
(8, '08800780778', 'nave@yy.com', 'Navee', '$2y$10$cNsgxNyOEoHZ5nxeBIJEU.PGXeTJl/L9cb3Vh4oW2tSTTuSMLBD16', NULL, 7, '', NULL, '123', '', 'u 11/31-32 dlf phase 3', NULL, NULL, NULL, 2, 2, 1, 0, 'vI4ZuS3omJbvNmnN4tHGpQS44dwunZZtwePCiDUNIgOThPH5KDNOF6lS9HHB', '', '', NULL, '2018-09-01 11:35:45', '2019-01-17 12:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(10) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `user_token` varchar(45) DEFAULT NULL,
  `device_type` tinyint(1) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `device_token`, `user_token`, `device_type`, `created_at`, `updated_at`) VALUES
(3, 4, '111', '92c175b9a0896ea5130a92045532421b1547747100', 1, '2018-09-01 10:38:12', '2019-01-17 12:15:00'),
(4, 5, '23', '97e78d6a584efeb88a430a1503f7463d1535819379', 23, '2018-09-01 10:59:39', '2018-09-01 10:59:39'),
(6, 8, '1', 'ccb23ca438e91960099ff361067d47e01535821545', 1, '2018-09-01 11:35:45', '2018-09-01 11:35:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventry`
--
ALTER TABLE `inventry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `name` (`name`),
  ADD KEY `status` (`status`),
  ADD KEY `user_type` (`role`),
  ADD KEY `mobile` (`mobile_number`) USING BTREE,
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inventry`
--
ALTER TABLE `inventry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
