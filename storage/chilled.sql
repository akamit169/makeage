-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2017 at 05:36 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chilled`
--

-- --------------------------------------------------------

--
-- Table structure for table `accept_public_question`
--

CREATE TABLE `accept_public_question` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `asked_for_user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 for acceted 0 for pending and if declined record deleted form db',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accept_public_question`
--

INSERT INTO `accept_public_question` (`id`, `user_id`, `asked_for_user_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 72, 76, 0, '2017-11-02 03:11:00', '2017-11-02 03:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `answer` text NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `answer_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>publicly ,2=>pricate',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `user_id`, `answer_type`, `created_at`, `updated_at`) VALUES
(6, 11, 'i dont know', 71, 1, '2017-10-04 00:25:15', '2017-10-04 00:25:15'),
(16, 1, 'bhhghh', 72, 1, '2017-10-30 00:13:50', '2017-10-30 00:13:50'),
(17, 1, 'bhhghh', 72, 1, '2017-10-30 00:20:20', '2017-10-30 00:20:20'),
(18, 1, 'reply on question', 72, 1, '2017-10-30 00:37:32', '2017-10-30 00:37:32'),
(21, 12, 'reply on question', 72, 1, '2017-10-30 00:55:03', '2017-10-30 00:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `answer_liked`
--

CREATE TABLE `answer_liked` (
  `id` int(10) UNSIGNED NOT NULL,
  `answer_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer_liked`
--

INSERT INTO `answer_liked` (`id`, `answer_id`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 6, 72, '2017-10-23 04:31:38', '2017-10-23 04:31:38'),
(33, 16, 74, '2017-10-31 06:37:46', '2017-10-31 06:37:46'),
(39, 17, 72, '2017-10-31 23:29:59', '2017-10-31 23:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `asset_image` varchar(250) NOT NULL,
  `asset_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 for unpaid 1 for paid',
  `itune_asset_id` varchar(250) NOT NULL,
  `asset_category_id` int(10) UNSIGNED DEFAULT NULL,
  `asset_subcategory_id` int(10) NOT NULL,
  `sub_categroy_index` int(10) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for active and 2 for deactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `name`, `asset_image`, `asset_type`, `itune_asset_id`, `asset_category_id`, `asset_subcategory_id`, `sub_categroy_index`, `status`, `created_at`, `update_at`) VALUES
(1, 'shape0', '', 0, 'com.oms.maleshape1', 1, 3, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:32:24'),
(2, 'shape1', '', 0, 'com.oms.maleshape2', 1, 3, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:36:46'),
(3, 'shape2', '', 0, 'com.oms.maleshape3', 1, 3, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:36:52'),
(4, 'shape3', '', 0, 'com.oms.maleshape4', 1, 3, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:37:24'),
(5, 'shape4', '', 0, 'com.oms.maleshape5', 1, 3, 4, 1, '2017-10-06 10:33:36', '2017-10-13 04:37:30'),
(6, 'shape0', '', 0, 'com.oms.femaleshape1', 2, 3, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:37:37'),
(7, 'shape1', '', 0, 'com.oms.femaleshape2', 2, 3, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:37:53'),
(8, 'shape2', '', 0, 'com.oms.femaleshape3', 2, 3, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:39:11'),
(9, 'shape3', '', 0, 'com.oms.femaleshape4', 2, 3, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:39:19'),
(10, 'shape4', '', 0, 'com.oms.femaleshape5', 2, 3, 4, 1, '2017-10-06 10:33:36', '2017-10-13 04:39:27'),
(11, 'Eyebrow0', '', 0, 'com.oms.maleeyebrow1', 1, 4, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:39:59'),
(12, 'Eyebrow1', '', 0, 'com.oms.maleeyebrow2', 1, 4, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:40:15'),
(13, 'Eyebrow2', '', 0, 'com.oms.maleeyebrow3', 1, 4, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:40:18'),
(14, 'Eyebrow3', '', 0, 'com.oms.maleeyebrow4', 1, 4, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:40:22'),
(15, 'Eyebrow0', '', 0, 'com.oms.femaleeyebrow1', 2, 5, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:40:35'),
(16, 'Eyebrow1', '', 0, 'com.oms.femaleeyebrow2', 2, 5, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:40:44'),
(17, 'Eyebrow2', '', 0, 'com.oms.femaleeyebrow3', 2, 5, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:40:49'),
(18, 'Eyebrow3', '', 0, 'com.oms.femaleeyebrow4', 2, 5, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:40:55'),
(19, 'Eyes0', '', 0, 'com.oms.maleeyes1', 1, 6, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:41:22'),
(20, 'Eyes1', '', 0, 'com.oms.maleeyes2', 1, 6, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:41:40'),
(21, 'Eyes2', '', 0, 'com.oms.maleeyes3', 1, 6, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:41:35'),
(22, 'Eyes3', '', 0, 'com.oms.maleeyes4', 1, 6, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:41:47'),
(23, 'Eyes0', '', 0, 'com.oms.femaleeyes1', 2, 7, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:41:59'),
(24, 'Eyes1', '', 0, 'com.oms.femaleeyes2', 2, 7, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:42:05'),
(25, 'Eyes2', '', 0, 'com.oms.femaleeyes3', 2, 7, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:42:10'),
(26, 'Eyes3', '', 0, 'com.oms.femaleeyes4', 2, 7, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:42:18'),
(27, 'Eye color0', '', 0, 'com.oms.maleeyecolor1', 1, 8, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:42:40'),
(28, 'Eye color1', '', 0, 'com.oms.maleeyecolor2', 1, 8, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:42:54'),
(29, 'Eye color2', '', 0, 'com.oms.maleeyecolor3', 1, 8, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:43:02'),
(30, 'Eye color3', '', 0, 'com.oms.maleeyecolor4', 1, 8, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:43:08'),
(31, 'Eye color4', '', 0, 'com.oms.maleeyecolor5', 1, 8, 4, 1, '2017-10-06 10:33:36', '2017-10-13 04:43:15'),
(32, 'Eye color5', '', 0, 'com.oms.maleeyecolor6', 1, 8, 5, 1, '2017-10-06 10:33:36', '2017-10-13 04:43:19'),
(33, 'Eye color6', '', 0, 'com.oms.maleeyecolor7', 1, 8, 6, 1, '2017-10-06 10:33:36', '2017-10-13 04:43:24'),
(34, 'Eye color7', '', 0, 'com.oms.maleeyecolor8', 1, 8, 7, 1, '2017-10-06 10:33:36', '2017-10-13 04:43:32'),
(35, 'Eye color0', '', 0, 'com.oms.femaleeyecolor1', 2, 9, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:44:16'),
(36, 'Eye color1', '', 0, 'com.oms.femaleeyecolor2', 2, 9, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:44:37'),
(37, 'Eye color2', '', 0, 'com.oms.femaleeyecolor3', 2, 9, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:44:25'),
(38, 'Eye color3', '', 0, 'com.oms.femaleeyecolor4', 2, 9, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:44:42'),
(39, 'Eye color4', '', 0, 'com.oms.femaleeyecolor5', 2, 9, 4, 1, '2017-10-06 10:33:36', '2017-10-13 04:45:28'),
(40, 'Eye color5', '', 0, 'com.oms.femaleeyecolor6', 2, 9, 5, 1, '2017-10-06 10:33:36', '2017-10-13 04:45:37'),
(41, 'Eye color6', '', 0, 'com.oms.femaleeyecolor7', 2, 9, 6, 1, '2017-10-06 10:33:36', '2017-10-13 04:45:44'),
(42, 'Eye color7', '', 0, 'com.oms.femaleeyecolor8', 2, 9, 7, 1, '2017-10-06 10:33:36', '2017-10-13 04:45:52'),
(43, 'Skin Tone0', '', 0, 'com.oms.maleskintone1', 1, 10, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:47:04'),
(44, 'Skin Tone1', '', 0, 'com.oms.maleskintone2', 1, 10, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:47:20'),
(45, 'Skin Tone2', '', 0, 'com.oms.maleskintone3', 1, 10, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:47:32'),
(46, 'Skin Tone3', '', 0, 'com.oms.maleskintone4', 1, 10, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:47:40'),
(47, 'Skin Tone4', '', 0, 'com.oms.maleskintone5', 1, 10, 4, 1, '2017-10-06 10:33:36', '2017-10-13 04:47:45'),
(48, 'Skin Tone0', '', 0, 'com.oms.femaleskintone1', 2, 11, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:47:56'),
(49, 'Skin Tone1', '', 0, 'com.oms.femaleskintone2', 2, 11, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:48:11'),
(50, 'Skin Tone2', '', 0, 'com.oms.femaleskintone3', 2, 11, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:48:16'),
(51, 'Skin Tone3', '', 0, 'com.oms.femaleskintone4', 2, 11, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:48:21'),
(52, 'Skin Tone4', '', 0, 'com.oms.femaleskintone5', 2, 11, 4, 1, '2017-10-06 10:33:36', '2017-10-13 04:48:29'),
(53, 'Nose0', '', 0, 'com.oms.malenose1', 1, 12, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:48:57'),
(54, 'Nose1', '', 0, 'com.oms.malenose2', 1, 12, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:49:02'),
(55, 'Nose2', '', 0, 'com.oms.malenose3', 1, 12, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:49:09'),
(56, 'Nose3', '', 0, 'com.oms.malenose4', 1, 12, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:49:17'),
(57, 'Nose0', '', 0, 'com.oms.femalenose1', 2, 13, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:49:28'),
(58, 'Nose1', '', 0, 'com.oms.femalenose2', 2, 13, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:49:34'),
(59, 'Nose2', '', 0, 'com.oms.femalenose3', 2, 13, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:49:38'),
(60, 'Nose3', '', 0, 'com.oms.femalenose4', 2, 13, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:49:44'),
(61, 'Lips0', '', 0, 'com.oms.malelips1', 1, 14, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:49:59'),
(62, 'Lips1', '', 0, 'com.oms.malelips2', 1, 14, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:50:06'),
(63, 'Lips2', '', 0, 'com.oms.malelips3', 1, 14, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:50:16'),
(64, 'Lips0', '', 0, 'com.oms.femalelips1', 2, 15, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:50:29'),
(65, 'Lips1', '', 0, 'com.oms.femalelips2', 2, 15, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:50:36'),
(66, 'Lips2', '', 0, 'com.oms.femalelips3', 2, 15, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:50:43'),
(67, 'Facial feature0', '', 0, 'com.oms.malefacialfeature1', 1, 16, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:51:20'),
(68, 'Facial feature1', '', 0, 'com.oms.malefacialfeature2', 1, 16, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:51:28'),
(69, 'Facial feature2', '', 0, 'com.oms.malefacialfeature3', 1, 16, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:51:34'),
(70, 'Facial feature0', '', 0, 'com.oms.femalefacialfeature1', 2, 17, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:51:45'),
(71, 'Facial feature1', '', 0, 'com.oms.femalefacialfeature2', 2, 17, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:51:52'),
(72, 'Facial feature2', '', 0, 'com.oms.femalefacialfeature3', 2, 17, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:52:47'),
(73, 'Facial Hair0', '', 0, 'com.oms.malefacialhair1', 1, 18, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:53:49'),
(74, 'Facial Hair1', '', 0, 'com.oms.malefacialhair2', 1, 18, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:54:02'),
(75, 'Facial Hair2', '', 0, 'com.oms.malefacialhair3', 1, 18, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:54:05'),
(76, 'Facial Hair3', '', 0, 'com.oms.malefacialhair4', 1, 18, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:54:10'),
(77, 'Facial Hair4', '', 0, 'com.oms.malefacialhair5', 1, 18, 4, 1, '2017-10-06 10:33:36', '2017-10-13 04:54:17'),
(78, 'Facial Hair5', '', 0, 'com.oms.malefacialhair6', 1, 18, 5, 1, '2017-10-06 10:33:36', '2017-10-13 04:54:23'),
(79, 'Facial Hair6', '', 0, 'com.oms.malefacialhair7', 1, 18, 6, 1, '2017-10-06 10:33:36', '2017-10-13 04:54:30'),
(80, 'Facial Hair7', '', 0, 'com.oms.malefacialhair8', 1, 18, 7, 1, '2017-10-06 10:33:36', '2017-10-13 04:54:36'),
(81, 'Facial Hair8', '', 0, 'com.oms.malefacialhair9', 1, 18, 8, 1, '2017-10-06 10:33:36', '2017-10-13 04:54:43'),
(82, 'Facial Hair9', '', 0, 'com.oms.malefacialhair10', 1, 18, 9, 1, '2017-10-06 10:33:36', '2017-10-13 04:54:51'),
(83, 'Hair color0', '', 0, 'com.oms.malehaircolor1', 20, 22, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:55:10'),
(84, 'Hair color1', '', 0, 'com.oms.malehaircolor2', 20, 22, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:55:15'),
(85, 'Hair color2', '', 0, 'com.oms.malehaircolor3', 20, 22, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:55:20'),
(86, 'Hair color3', '', 0, 'com.oms.malehaircolor4', 20, 22, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:55:26'),
(87, 'Hair color4', '', 0, 'com.oms.malehaircolor5', 20, 22, 4, 1, '2017-10-06 10:33:36', '2017-10-13 04:55:31'),
(88, 'Hair color5', '', 0, 'com.oms.malehaircolor6', 20, 22, 5, 1, '2017-10-06 10:33:36', '2017-10-13 04:55:40'),
(89, 'Hair color6', '', 0, 'com.oms.malehaircolor7', 20, 22, 6, 1, '2017-10-06 10:33:36', '2017-10-13 04:55:46'),
(90, 'Hair color7', '', 0, 'com.oms.malehaircolor8', 20, 22, 7, 1, '2017-10-06 10:33:36', '2017-10-13 04:55:53'),
(91, 'Hair color8', '', 0, 'com.oms.malehaircolor9', 20, 22, 8, 1, '2017-10-06 10:33:36', '2017-10-13 04:55:59'),
(92, 'Hair color9', '', 0, 'com.oms.malehaircolor10', 20, 22, 9, 1, '2017-10-06 10:33:36', '2017-10-13 04:56:06'),
(93, 'Hair color0', '', 0, 'com.oms.femalehaircolor1', 21, 23, 0, 1, '2017-10-06 10:33:36', '2017-10-13 04:56:15'),
(94, 'Hair color1', '', 0, 'com.oms.femalehaircolor2', 21, 23, 1, 1, '2017-10-06 10:33:36', '2017-10-13 04:56:21'),
(95, 'Hair color2', '', 0, 'com.oms.femalehaircolor3', 21, 23, 2, 1, '2017-10-06 10:33:36', '2017-10-13 04:56:27'),
(96, 'Hair color3', '', 0, 'com.oms.femalehaircolor4', 21, 23, 3, 1, '2017-10-06 10:33:36', '2017-10-13 04:56:32'),
(97, 'Hair color4', '', 0, 'com.oms.femalehaircolor5', 21, 23, 4, 1, '2017-10-06 10:33:36', '2017-10-13 04:56:37'),
(98, 'Hair color5', '', 0, 'com.oms.femalehaircolor6', 21, 23, 5, 1, '2017-10-06 10:33:36', '2017-10-13 04:56:43'),
(99, 'Hair color6', '', 0, 'com.oms.femalehaircolor7', 21, 23, 6, 1, '2017-10-06 10:33:36', '2017-10-13 04:56:49'),
(100, 'Hair color7', '', 0, 'com.oms.femalehaircolor8', 21, 23, 7, 1, '2017-10-06 10:33:36', '2017-10-13 04:56:56'),
(101, 'Hair color8', '', 0, 'com.oms.femalehaircolor9', 21, 23, 8, 1, '2017-10-06 10:33:36', '2017-10-13 04:57:04'),
(102, 'Hair color9', '', 0, 'com.oms.femalehaircolor10', 21, 23, 9, 1, '2017-10-06 10:33:36', '2017-10-13 04:57:08'),
(103, 'Thin0', '', 0, 'com.oms.malethin1', 24, 26, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:00:13'),
(104, 'Muscular0', '', 0, 'com.oms.malemuscular1', 24, 27, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:00:35'),
(105, 'Stout0', '', 0, 'com.oms.malestout1', 24, 28, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:00:46'),
(106, 'Slim0', '', 0, 'com.oms.femaleslim1', 25, 29, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:01:10'),
(107, 'Average0', '', 0, 'com.oms.femaleaverage1', 25, 30, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:01:20'),
(108, 'Stout0', '', 0, 'com.oms.femalestout1', 25, 31, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:01:37'),
(109, 'Designer Shirts0', '', 1, 'com.oms.maledesignershirts1', 32, 34, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:04:05'),
(110, 'Designer Shirts1', '', 0, 'com.oms.maledesignershirts2', 32, 34, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:04:10'),
(111, 'Designer Shirts2', '', 1, 'com.oms.maledesignershirts3', 32, 34, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:04:15'),
(112, 'Designer Shirts3', '', 1, 'com.oms.maledesignershirts4', 32, 34, 3, 1, '2017-10-06 10:33:36', '2017-10-13 05:04:20'),
(113, 'Designer Shirts4', '', 1, 'com.oms.maledesignershirts5', 32, 34, 4, 1, '2017-10-06 10:33:36', '2017-10-13 05:04:27'),
(114, 'Designer Shirts5', '', 1, 'com.oms.maledesignershirts6', 32, 34, 5, 1, '2017-10-06 10:33:36', '2017-10-13 05:04:33'),
(115, 'Designer Shirts0', '', 1, 'com.oms.femaledesignertops1', 33, 35, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:10:31'),
(116, 'Designer Shirts1', '', 1, 'com.oms.femaledesignertops2', 33, 35, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:04:55'),
(117, 'Designer Shirts2', '', 0, 'com.oms.femaledesignertops3', 33, 35, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:38:20'),
(118, 'Designer Shirts3', '', 1, 'com.oms.femaledesignertops4', 33, 35, 3, 1, '2017-10-06 10:33:36', '2017-10-13 05:05:08'),
(119, 'Designer Shirts4', '', 0, 'com.oms.femaledesignertops5', 33, 35, 4, 1, '2017-10-06 10:33:36', '2017-10-13 05:05:13'),
(120, 'Designer Shirts5', '', 1, 'com.oms.femaledesignertops6', 33, 35, 5, 1, '2017-10-06 10:33:36', '2017-10-13 05:05:19'),
(121, 'Designer Dresses0', '', 1, 'com.oms.femaledesignerdresses1', 33, 36, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:39:09'),
(122, 'Designer Dresses1', '', 0, 'com.oms.femaledesignerdresses2', 33, 36, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:39:14'),
(123, 'Designer Dresses2', '', 1, 'com.oms.femaledesignerdresses3', 33, 36, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:39:19'),
(124, 'Jackets0', '', 1, 'com.oms.malejackets1', 32, 37, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:39:45'),
(125, 'Jackets1', '', 0, 'com.oms.malejackets2', 32, 37, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:39:49'),
(126, 'Jackets2', '', 1, 'com.oms.malejackets3', 32, 37, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:39:53'),
(127, 'Jackets3', '', 0, 'com.oms.malejackets4', 32, 37, 3, 1, '2017-10-06 10:33:36', '2017-10-13 05:39:58'),
(128, 'Jackets4', '', 1, 'com.oms.malejackets5', 32, 37, 4, 1, '2017-10-06 10:33:36', '2017-10-13 05:40:02'),
(129, 'Jackets0', '', 1, 'com.oms.femalejackets1', 33, 39, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:40:25'),
(130, 'Jackets1', '', 1, 'com.oms.femalejackets2', 33, 39, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:40:31'),
(131, 'Jackets2', '', 0, 'com.oms.femalejackets3', 33, 39, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:40:35'),
(132, 'Jackets3', '', 0, 'com.oms.femalejackets4', 33, 39, 3, 1, '2017-10-06 10:33:36', '2017-10-13 05:40:41'),
(133, 'Jackets4', '', 0, 'com.oms.femalejackets5', 33, 39, 4, 1, '2017-10-06 10:33:36', '2017-10-13 05:40:48'),
(134, 'Unisex Shirts/Tops0', '', 1, 'com.oms.maleunisexshirts1', 32, 38, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:41:55'),
(135, 'Unisex Shirts/Tops1', '', 0, 'com.oms.maleunisexshirts2', 32, 38, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:42:01'),
(136, 'Unisex Shirts/Tops2', '', 0, 'com.oms.maleunisexshirts3', 32, 38, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:42:06'),
(137, 'Unisex Shirts/Tops0', '', 1, 'com.oms.femaleunisexshirts1', 33, 40, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:42:20'),
(138, 'Unisex Shirts/Tops1', '', 0, 'com.oms.femaleunisexshirts2', 33, 40, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:42:24'),
(139, 'Unisex Shirts/Tops2', '', 0, 'com.oms.femaleunisexshirts3', 33, 40, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:42:31'),
(140, 'Shirts/Tops Color0', '', 0, 'com.oms.maleunisexshirtcolor1', 32, 41, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:47:35'),
(141, 'Shirts/Tops Color1', '', 0, 'com.oms.maleunisexshirtcolor2', 32, 41, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:47:58'),
(142, 'Shirts/Tops Color2', '', 0, 'com.oms.maleunisexshirtcolor3', 32, 41, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:48:03'),
(143, 'Shirts/Tops Color3', '', 0, 'com.oms.maleunisexshirtcolor4', 32, 41, 3, 1, '2017-10-06 10:33:36', '2017-10-13 05:48:08'),
(144, 'Shirts/Tops Color4', '', 0, 'com.oms.maleunisexshirtcolor5', 32, 41, 4, 1, '2017-10-06 10:33:36', '2017-10-13 05:48:14'),
(145, 'Shirts/Tops Color0', '', 0, 'com.oms.femaleunisexshirtcolor1', 33, 42, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:48:23'),
(146, 'Shirts/Tops Color1', '', 0, 'com.oms.femaleunisexshirtcolor2', 33, 42, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:48:27'),
(147, 'Shirts/Tops Color2', '', 0, 'com.oms.femaleunisexshirtcolor3', 33, 42, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:48:33'),
(148, 'Shirts/Tops Color3', '', 0, 'com.oms.femaleunisexshirtcolor4', 33, 42, 3, 1, '2017-10-06 10:33:36', '2017-10-13 05:48:38'),
(149, 'Shirts/Tops Color4', '', 0, 'com.oms.femaleunisexshirtcolor5', 33, 42, 4, 1, '2017-10-06 10:33:36', '2017-10-13 05:48:47'),
(150, 'Lowers0', '', 0, 'com.oms.malelower1', 32, 43, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:48:52'),
(151, 'Lowers1', '', 1, 'com.oms.malelower2', 32, 43, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:48:58'),
(152, 'Lowers2', '', 1, 'com.oms.malelower3', 32, 43, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:49:02'),
(153, 'Lowers3', '', 1, 'com.oms.malelower4', 32, 43, 3, 1, '2017-10-06 10:33:36', '2017-10-13 05:49:05'),
(154, 'Lowers4', '', 1, 'com.oms.malelower5', 32, 43, 4, 1, '2017-10-06 10:33:36', '2017-10-13 05:49:08'),
(155, 'Lowers5', '', 1, 'com.oms.malelower6', 32, 43, 5, 1, '2017-10-06 10:33:36', '2017-10-13 05:49:11'),
(156, 'Lowers6', '', 1, 'com.oms.malelower7', 32, 43, 6, 1, '2017-10-06 10:33:36', '2017-10-13 05:49:15'),
(157, 'Lowers7', '', 1, 'com.oms.malelower8', 32, 43, 7, 1, '2017-10-06 10:33:36', '2017-10-13 05:49:18'),
(158, 'Lowers8', '', 1, 'com.oms.malelower9', 32, 43, 8, 1, '2017-10-06 10:33:36', '2017-10-13 05:49:21'),
(159, 'Lowers0', '', 0, 'com.oms.femalelower1', 33, 44, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:49:25'),
(160, 'Lowers1', '', 0, 'com.oms.femalelower2', 33, 44, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:49:30'),
(161, 'Lowers2', '', 1, 'com.oms.femalelower3', 33, 44, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:49:33'),
(162, 'Lowers3', '', 0, 'com.oms.femalelower4', 33, 44, 3, 1, '2017-10-06 10:33:36', '2017-10-13 05:49:38'),
(163, 'Lowers4', '', 0, 'com.oms.femalelower5', 33, 44, 4, 1, '2017-10-06 10:33:36', '2017-10-13 05:49:42'),
(164, 'Lowers5', '', 0, 'com.oms.femalelower6', 33, 44, 5, 1, '2017-10-06 10:33:36', '2017-10-13 07:08:52'),
(165, 'Lowers6', '', 1, 'com.oms.femalelower7', 33, 44, 6, 1, '2017-10-06 10:33:36', '2017-10-13 07:08:55'),
(166, 'Lowers7', '', 0, 'com.oms.femalelower8', 33, 44, 7, 1, '2017-10-06 10:33:36', '2017-10-13 07:09:07'),
(167, 'Lowers8', '', 1, 'com.oms.femalelower9', 33, 44, 8, 1, '2017-10-06 10:33:36', '2017-10-13 05:50:03'),
(169, 'Shoes0', '', 1, 'com.oms.maleshoe1', 32, 45, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:50:29'),
(170, 'Shoes1', '', 1, 'com.oms.maleshoe2', 32, 45, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:50:33'),
(171, 'Shoes2', '', 1, 'com.oms.maleshoe3', 32, 45, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:50:47'),
(172, 'Shoes3', '', 0, 'com.oms.maleshoe4', 32, 45, 3, 1, '2017-10-06 10:33:36', '2017-10-13 05:50:51'),
(173, 'Shoes4', '', 0, 'com.oms.maleshoe5', 32, 45, 4, 1, '2017-10-06 10:33:36', '2017-10-13 05:50:56'),
(174, 'Shoes5', '', 1, 'com.oms.maleshoe6', 32, 45, 5, 1, '2017-10-06 10:33:36', '2017-10-13 05:51:00'),
(175, 'Shoes6', '', 0, 'com.oms.maleshoe7', 32, 45, 6, 1, '2017-10-06 10:33:36', '2017-10-13 05:51:05'),
(176, 'Shoes7', '', 1, 'com.oms.maleshoe8', 32, 45, 7, 1, '2017-10-06 10:33:36', '2017-10-13 05:51:09'),
(177, 'Shoes8', '', 0, 'com.oms.maleshoe9', 32, 45, 8, 1, '2017-10-06 10:33:36', '2017-10-13 05:51:14'),
(178, 'Shoes0', '', 0, 'com.oms.femaleshoe1', 33, 46, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:51:30'),
(179, 'Shoes1', '', 0, 'com.oms.femaleshoe2', 33, 46, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:51:34'),
(180, 'Shoes2', '', 1, 'com.oms.femaleshoe3', 33, 46, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:51:37'),
(181, 'Shoes3', '', 1, 'com.oms.femaleshoe4', 33, 46, 3, 1, '2017-10-06 10:33:36', '2017-10-13 05:51:42'),
(182, 'Shoes4', '', 0, 'com.oms.femaleshoe5', 33, 46, 4, 1, '2017-10-06 10:33:36', '2017-10-13 05:51:46'),
(183, 'Shoes5', '', 1, 'com.oms.femaleshoe6', 33, 46, 5, 1, '2017-10-06 10:33:36', '2017-10-13 05:51:49'),
(184, 'Shoes6', '', 1, 'com.oms.femaleshoe7', 33, 46, 6, 1, '2017-10-06 10:33:36', '2017-10-13 05:51:54'),
(185, 'Shoes7', '', 0, 'com.oms.femaleshoe8', 33, 46, 7, 1, '2017-10-06 10:33:36', '2017-10-13 05:52:00'),
(186, 'Shoes8', '', 1, 'com.oms.femaleshoe9', 33, 46, 8, 1, '2017-10-06 10:33:36', '2017-10-13 05:52:05'),
(187, 'Hats0', '', 1, 'com.oms.malehat1', 47, 49, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:55:08'),
(188, 'Hats1', '', 1, 'com.oms.malehat2', 47, 49, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:55:14'),
(189, 'Hats0', '', 1, 'com.oms.femalehat1', 48, 50, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:55:27'),
(190, 'Hats1', '', 1, 'com.oms.femalehat2', 48, 50, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:55:33'),
(191, 'Eyewear0', '', 0, 'com.oms.maleeyewear1', 47, 51, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:55:54'),
(192, 'Eyewear1', '', 0, 'com.oms.maleeyewear2', 47, 51, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:55:58'),
(193, 'Eyewear2', '', 1, 'com.oms.maleeyewear3', 47, 51, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:56:05'),
(194, 'Eyewear3', '', 1, 'com.oms.maleeyewear4', 47, 51, 3, 1, '2017-10-06 10:33:36', '2017-10-13 05:56:10'),
(195, 'Eyewear4', '', 1, 'com.oms.maleeyewear5', 47, 51, 4, 1, '2017-10-06 10:33:36', '2017-10-13 05:56:16'),
(196, 'Eyewear5', '', 0, 'com.oms.maleeyewear6', 47, 51, 5, 1, '2017-10-06 10:33:36', '2017-10-13 05:56:25'),
(197, 'Eyewear0', '', 0, 'com.oms.femaleeyewear1', 48, 52, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:56:38'),
(198, 'Eyewear1', '', 0, 'com.oms.femaleeyewear2', 48, 52, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:56:43'),
(199, 'Eyewear2', '', 1, 'com.oms.femaleeyewear3', 48, 52, 2, 1, '2017-10-06 10:33:36', '2017-10-13 05:56:49'),
(200, 'Eyewear3', '', 1, 'com.oms.femaleeyewear4', 48, 52, 3, 1, '2017-10-06 10:33:36', '2017-10-13 05:56:54'),
(201, 'Eyewear4', '', 1, 'com.oms.femaleeyewear5', 48, 52, 4, 1, '2017-10-06 10:33:36', '2017-10-13 05:57:01'),
(202, 'Eyewear5', '', 0, 'com.oms.femaleeyewear6', 48, 52, 5, 1, '2017-10-06 10:33:36', '2017-10-13 05:57:07'),
(203, 'Scarf0', '', 0, 'com.oms.malescarf1', 47, 53, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:57:40'),
(204, 'Scarf0', '', 0, 'com.oms.femalescarf1', 48, 54, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:57:46'),
(205, 'Necklace/Choker0', '', 1, 'com.oms.femalenecklace1', 48, 55, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:58:24'),
(206, 'Necklace/Choker1', '', 1, 'com.oms.femalenecklace2', 48, 55, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:58:32'),
(207, 'Gold Chain0', '', 1, 'com.oms.malegoldchain1', 47, 56, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:58:48'),
(208, 'Watches0', '', 1, 'com.oms.malewatch1', 47, 57, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:59:11'),
(209, 'Watches1', '', 1, 'com.oms.malewatch2', 47, 57, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:59:17'),
(210, 'Watches0', '', 1, 'com.oms.femalewatch1', 48, 58, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:59:26'),
(211, 'Earrings0', '', 0, 'com.oms.femaleearrings1', 48, 59, 0, 1, '2017-10-06 10:33:36', '2017-10-13 05:59:48'),
(212, 'Earrings1', '', 1, 'com.oms.femaleearrings2', 48, 59, 1, 1, '2017-10-06 10:33:36', '2017-10-13 05:59:55'),
(213, 'Bagpacks0', '', 1, 'com.oms.malebackpack1', 47, 62, 0, 1, '2017-10-06 10:33:36', '2017-10-13 06:00:18'),
(214, 'Bagpacks0', '', 1, 'com.oms.femalebackpack1', 48, 63, 0, 1, '2017-10-06 10:33:36', '2017-10-13 06:00:25'),
(215, 'Handbags0', '', 0, 'com.oms.femalehandbag1', 48, 60, 0, 1, '2017-10-06 10:33:36', '2017-10-13 06:00:40'),
(216, 'Handbags1', '', 1, 'com.oms.femalehandbag2', 48, 60, 1, 1, '2017-10-06 10:33:36', '2017-10-13 06:00:45'),
(217, 'Bracelets0', '', 0, 'com.oms.femalebracelet1', 48, 61, 0, 1, '2017-10-06 10:33:36', '2017-10-13 06:01:06'),
(218, 'Bracelets1', '', 0, 'com.oms.femalebracelet2', 48, 61, 1, 1, '2017-10-06 10:33:36', '2017-10-13 06:01:16'),
(219, 'Lowers9', '', 1, 'com.oms.femalelower10', 33, 44, 9, 1, '2017-10-06 10:33:36', '2017-10-13 07:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `asset_category`
--

CREATE TABLE `asset_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(110) NOT NULL,
  `parent_id` tinyint(3) NOT NULL COMMENT '0 for category otherwise id represent subcategory of categroy ',
  `gender_type` tinyint(2) DEFAULT NULL COMMENT '1=>male,2=>female',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_category`
--

INSERT INTO `asset_category` (`id`, `name`, `parent_id`, `gender_type`, `created_at`, `updated_at`) VALUES
(1, 'Face', 0, 1, 0, 0),
(2, 'Face', 0, 2, 0, 0),
(3, 'Shape', 1, 1, 0, 0),
(4, 'Eyebrow', 1, 1, 0, 0),
(5, 'Eyebrow', 2, 2, 0, 0),
(6, 'Eyes', 1, 1, 0, 0),
(7, 'Eyes', 2, 2, 0, 0),
(8, 'Eye color', 1, 1, 0, 0),
(9, 'Eye color', 2, 2, 0, 0),
(10, 'Skin Tone', 1, 1, 0, 0),
(11, 'Skin Tone', 2, 2, 0, 0),
(12, 'Nose', 1, 1, 0, 0),
(13, 'Nose', 2, 2, 0, 0),
(14, 'Lips', 1, 1, 0, 0),
(15, 'Lips', 2, 2, 0, 0),
(16, 'Facial feature', 1, 1, 0, 0),
(17, 'Facial feature', 2, 2, 0, 0),
(18, 'Facial Hair', 1, 1, 0, 0),
(19, 'Shape', 2, 2, 0, 0),
(20, 'Hairstyle', 0, 1, 0, 0),
(21, 'Hairstyle', 0, 2, 0, 0),
(22, 'Hair color', 20, 1, 0, 0),
(23, 'Hair color', 21, 2, 0, 0),
(24, 'Body', 0, 1, 0, 0),
(25, 'Body', 0, 2, 0, 0),
(26, 'thin', 24, 1, 0, 0),
(27, 'muscular', 24, 1, 0, 0),
(28, 'stout', 24, 1, 0, 0),
(29, 'slim', 25, 2, 0, 0),
(30, 'average', 25, 2, 0, 0),
(31, 'stout', 25, 2, 0, 0),
(32, 'clothes', 0, 1, 0, 0),
(33, 'clothes', 0, 2, 0, 0),
(34, 'Designer Shirts', 32, 1, 0, 0),
(35, 'Designer Shirts', 33, 2, 0, 0),
(36, 'Designer Dresses', 33, 2, 0, 0),
(37, 'Jackets', 32, 1, 0, 0),
(38, 'Unisex Shirts/Tops', 32, 1, 0, 0),
(39, 'Jackets', 33, 2, 0, 0),
(40, 'Unisex Shirts/Tops', 33, 2, 0, 0),
(41, 'Shirts/Tops Color', 32, 1, 0, 0),
(42, 'Shirts/Tops Color', 33, 2, 0, 0),
(43, 'Lowers', 32, 1, 0, 0),
(44, 'Lowers', 33, 2, 0, 0),
(45, 'Shoes', 32, 1, 0, 0),
(46, 'Shoes', 33, 2, 0, 0),
(47, 'Acessories', 0, 1, 0, 0),
(48, 'Acessories', 0, 2, 0, 0),
(49, 'Hats', 47, 1, 0, 0),
(50, 'Hats', 48, 2, 0, 0),
(51, 'Eyewear', 47, 1, 0, 0),
(52, 'Eyewear', 48, 2, 0, 0),
(53, 'Scarf', 47, 1, 0, 0),
(54, 'Scarf', 48, 2, 0, 0),
(55, 'Necklace/Choker', 48, 2, 0, 0),
(56, 'Gold Chain', 47, 1, 0, 0),
(57, 'Watches', 47, 1, 0, 0),
(58, 'Watches', 48, 2, 0, 0),
(59, 'Earrings', 48, 2, 0, 0),
(60, 'Handbags', 48, 2, 0, 0),
(61, 'Bracelets', 48, 2, 0, 0),
(62, 'Bagpacks', 48, 1, 0, 0),
(63, 'Bagpacks', 47, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blocked_users`
--

CREATE TABLE `blocked_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `blocked_user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `feedback_type` tinyint(1) UNSIGNED NOT NULL COMMENT '1=>good or 2=>bad',
  `status` tinyint(1) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL COMMENT '1=>question 2=>anwer',
  `type_id` int(10) UNSIGNED NOT NULL,
  `reasion_type` tinyint(1) UNSIGNED NOT NULL,
  `reason` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `friend_user_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '0=>request pending,1 =>request accepted ,2=>unfriend',
  `clear_status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_user_id`, `status`, `clear_status`, `created_at`, `updated_at`) VALUES
(1, 71, 72, 1, '0', '2017-10-05 09:44:39', '2017-10-05 09:44:49'),
(2, 72, 73, 1, '0', '2017-10-05 09:57:09', '0000-00-00 00:00:00'),
(3, 73, 71, 1, '0', '2017-10-06 06:54:53', '2017-10-06 07:16:48'),
(4, 72, 74, 1, '0', '2017-10-06 06:54:53', '2017-10-06 07:16:48'),
(5, 71, 74, 1, '0', '2017-10-06 06:54:53', '2017-10-06 08:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `is_approved` tinyint(1) UNSIGNED NOT NULL COMMENT 'admin approved or not default approved 1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `name`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 'amit', 1, '2017-06-28 08:48:19', '2017-06-28 08:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `action_id` int(10) UNSIGNED NOT NULL,
  `action_type` varchar(250) NOT NULL,
  `content` varchar(255) NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `answer_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_read` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0-unread, 1-read',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `receiver_id`, `user_id`, `action_id`, `action_type`, `content`, `question_id`, `answer_id`, `is_read`, `created_at`, `updated_at`) VALUES
(13, 72, 71, 0, 'chat', 'helo', 0, 0, 0, '2017-09-20 04:19:27', '2017-09-20 04:19:27'),
(14, 71, 72, 0, 'newquestion', '#user has asked you a question.', 11, 5, 0, '2017-09-25 23:57:24', '2017-10-04 05:24:53'),
(15, 72, 71, 0, 'newAnswer', '#user has answered your question', 11, 6, 0, '2017-10-04 00:25:15', '2017-10-04 00:25:15'),
(16, 72, 1, 0, 'newAnswer', '#user has answered your question', 1, 8, 0, '2017-10-25 23:58:47', '2017-10-25 23:58:47'),
(17, 72, 1, 0, 'newAnswer', '#user has answered your question', 1, 9, 0, '2017-10-26 23:44:23', '2017-10-26 23:44:23'),
(18, 72, 1, 0, 'newAnswer', '#user has answered your question', 1, 10, 0, '2017-10-26 23:49:56', '2017-10-26 23:49:56'),
(19, 72, 1, 0, 'newAnswer', '#user has answered your question', 1, 11, 0, '2017-10-26 23:50:56', '2017-10-26 23:50:56'),
(20, 72, 1, 0, 'newAnswer', '#user has answered your question', 1, 12, 0, '2017-10-26 23:51:16', '2017-10-26 23:51:16'),
(21, 72, 1, 0, 'newAnswer', '#user has answered your question', 1, 13, 0, '2017-10-29 23:14:46', '2017-10-29 23:14:46'),
(22, 72, 1, 0, 'newAnswer', '#user has answered your question', 1, 14, 0, '2017-10-29 23:32:50', '2017-10-29 23:32:50'),
(23, 72, 1, 0, 'newAnswer', '#user has answered your question', 1, 15, 0, '2017-10-29 23:33:00', '2017-10-29 23:33:00'),
(24, 72, 1, 0, 'newAnswer', '#user has answered your question', 1, 16, 0, '2017-10-30 00:13:50', '2017-10-30 00:13:50'),
(25, 72, 1, 0, 'newAnswer', '#user has answered your question', 1, 17, 0, '2017-10-30 00:20:20', '2017-10-30 00:20:20'),
(26, 72, 1, 0, 'newAnswer', '#user has answered your question', 1, 18, 0, '2017-10-30 00:37:32', '2017-10-30 00:37:32'),
(29, 74, 72, 0, 'newAnswer', '#user has answered your question', 12, 21, 0, '2017-10-30 00:55:03', '2017-10-30 00:55:03'),
(30, 75, 72, 0, 'accept_decline_newquestion', '#user has asked you a question.', 31, 0, 0, '2017-11-02 02:29:21', '2017-11-02 02:29:21'),
(31, 76, 72, 0, 'accept_decline_newquestion', '#user has asked you a question.', 32, 0, 0, '2017-11-02 03:11:00', '2017-11-02 03:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL COMMENT '1=>avatar,2=>public,3=>friend',
  `question_by` int(10) UNSIGNED NOT NULL COMMENT 'created by user_id',
  `question_for` int(10) UNSIGNED DEFAULT NULL COMMENT 'created for user_id',
  `status` tinyint(1) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `type`, `question_by`, `question_for`, `status`, `created_at`, `updated_at`) VALUES
(1, 'your best website ?', 2, 72, 0, 1, '2017-08-18 05:13:50', '2017-10-30 06:21:05'),
(2, 'About the star ....', 3, 72, 74, 1, '2017-08-29 09:01:20', '2017-08-29 09:01:43'),
(10, 'i have a new quesiton ', 3, 71, 72, 1, '2017-08-31 01:02:46', '2017-08-31 01:02:46'),
(11, 'My name is khan is it write', 2, 72, 71, 1, '2017-09-25 23:53:28', '2017-10-04 05:12:55'),
(12, 'new public question', 2, 74, 0, 1, '2017-10-30 00:52:05', '2017-10-30 00:52:05'),
(15, 'Thats my new question', 2, 72, 75, 1, '2017-11-01 14:38:33', '2017-11-01 14:38:33'),
(25, 'Thats my new question', 2, 72, 75, 1, '2017-11-02 02:07:01', '2017-11-02 02:07:01'),
(31, 'Thats my new question', 2, 72, 75, 1, '2017-11-02 02:29:21', '2017-11-02 02:29:21'),
(32, 'My work', 2, 72, 76, 1, '2017-11-02 03:11:00', '2017-11-02 03:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `report_for` int(10) UNSIGNED NOT NULL,
  `report_content` text NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL COMMENT '1=for active 2 not active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `report_for`, `report_content`, `status`, `created_at`, `updated_at`) VALUES
(1, 72, 73, 'no details', 0, '2017-08-30 06:55:42', '2017-09-14 07:07:35'),
(3, 72, 71, '', 0, '2017-09-14 07:06:09', '2017-09-14 07:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `report_questions`
--

CREATE TABLE `report_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `answer_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `report_content` varchar(250) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL COMMENT '1=for active 2 not active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report_questions`
--

INSERT INTO `report_questions` (`id`, `question_id`, `answer_id`, `user_id`, `report_content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 71, 'Bad content', 1, '2017-08-29 04:21:39', '2017-08-29 04:21:39'),
(2, 2, 2, 72, 'quesiton is wrong', 1, '2017-08-29 09:03:07', '2017-08-29 09:03:07'),
(3, 1, 1, 71, '1', 0, '2017-10-11 06:27:22', '2017-10-11 06:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `mobile_otp` varchar(10) NOT NULL,
  `otp_expiration_at` datetime NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `avatar_name` varchar(250) DEFAULT NULL,
  `avatar_data` text,
  `user_bio` text COMMENT 'short bio of user',
  `like` varchar(250) DEFAULT NULL,
  `dislike` varchar(250) DEFAULT NULL,
  `relationship_status` tinyint(1) UNSIGNED DEFAULT NULL,
  `gender` tinyint(1) UNSIGNED DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `country_name` varchar(80) DEFAULT NULL,
  `state_name` varchar(100) DEFAULT NULL,
  `average_ratting` float(2,1) DEFAULT NULL,
  `chat_status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0 for unavailable 1 available 2 busy ',
  `ejabberd_id` varchar(250) DEFAULT NULL,
  `ejabberd_password` varchar(250) DEFAULT NULL,
  `role` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1 for normal user and 2 for admin',
  `status` tinyint(1) UNSIGNED NOT NULL,
  `is_verified` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `total_like_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `remember_token` varchar(120) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `mobile_number`, `mobile_otp`, `otp_expiration_at`, `email`, `name`, `password`, `avatar_name`, `avatar_data`, `user_bio`, `like`, `dislike`, `relationship_status`, `gender`, `date_of_birth`, `country_name`, `state_name`, `average_ratting`, `chat_status`, `ejabberd_id`, `ejabberd_password`, `role`, `status`, `is_verified`, `total_like_count`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '', '', '2017-06-12 00:01:00', 'amit.kumar@appster.in', 'Chilled Amdin', '$2y$10$cNsgxNyOEoHZ5nxeBIJEU.PGXeTJl/L9cb3Vh4oW2tSTTuSMLBD16', '', '', '', '', '', 0, 0, '2017-06-03', '', '', 1.2, 2, '', '', 2, 2, 0, 0, 'bnkWZ4j6vrDH3XRfD4HaoQa06IXALoqCgLPjjw2fYYQ8eLMGzKyXDIJu9JQ6', NULL, '2017-04-25 04:04:54', '2017-08-28 04:09:21'),
(71, '+918010152565', '8063', '2017-07-14 04:27:05', 'amit.kumar@appster.in1', 'Amit kumar', NULL, 'Amitkumar', '', 'Its depend upon the lifestyle', 'cricket , football', 'Running , dancing', 1, 1, '1989-01-24', 'Delhi', '', NULL, 1, 'dev_272', 'eyJpdiI6IjhybGdycUFLT0tsQ05oS3lGYnVDSGc9PSIsInZhbHVlIjoibEFjU2ZMR2JBUE4xbXg3TTI1eHg1Zz09IiwibWFjIjoiNWI1ZTEwMDMyM2QyNDRiM2MxZjlmZDkwMmE0ZTdlZDZkODY1Yzc2Njg0NGY3MTMyMDBjODE3ZTJmZmFiMmMxYSJ9', 1, 2, 1, 7, NULL, NULL, '2017-07-13 22:55:05', '2017-10-23 04:31:38'),
(72, '+919560102566', '7568', '2017-07-21 05:24:07', 'shyam@gmail.com', 'surender', NULL, NULL, NULL, NULL, '', '', NULL, 1, NULL, NULL, NULL, NULL, 1, 'dev_354', 'eyJpdiI6InF6dzFmYTZNZEl4bXM5NnNMc280clE9PSIsInZhbHVlIjoiVVBGNWxOOTdvc2ZvMUExSEhnT2Y1QT09IiwibWFjIjoiOTM0ZTg4NGEzNmFmNjJlM2I3YjFjNGVmMjE3ZjBlM2Y0OGQ0OTcxNzM0Y2Q3MDQ5ZDc0ODVhM2Q5MzdkYjEzZCJ9', 1, 2, 1, 13, NULL, NULL, '2017-07-20 23:52:07', '2017-10-31 23:29:59'),
(73, '+919560102567', '1248', '2017-07-21 05:26:04', NULL, 'Saleman', NULL, '', NULL, '', 'ram,shyam,sita', 'gita,mohan', 0, 0, '0000-00-00', '', '', NULL, 1, 'dev_298', 'eyJpdiI6IklUeEdQXC92S0theWlcL0hMOENnMmpOUT09IiwidmFsdWUiOiJwenRPajdJWTlwT3pTRmw4TVwvaFBEUT09IiwibWFjIjoiMzZmOGZmZDA1YWEwN2ZiMTkwMzE2YTMwNDkwZmJlYTY4MDM3MmJiMTE3MDI2NTc4MjA2NTBiYjcxNzUyZmEyZSJ9', 1, 2, 1, 0, NULL, NULL, '2017-07-20 23:54:04', '2017-09-15 08:15:13'),
(74, '+919560102568', '3272', '2017-10-10 08:30:57', NULL, 'Amit kumar', '', 'suman', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'dev_345', NULL, 1, 1, 0, 0, NULL, NULL, '2017-07-24 08:43:13', '2017-10-10 02:58:57'),
(75, '+919560107569', '8577', '2017-07-24 14:15:13', NULL, 'shantanu', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'dev_392', NULL, 1, 2, 0, 0, NULL, NULL, '2017-07-24 08:43:13', '2017-09-15 08:18:21'),
(76, '+919330107510', '8577', '2017-07-24 14:15:13', NULL, 'shalini', NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'dev_393', NULL, 1, 2, 0, 0, NULL, NULL, '2017-07-24 08:43:13', '2017-09-15 08:18:24'),
(77, '+918010152586', '9586', '2017-09-20 04:56:02', NULL, 'charter accontant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'localhost_77', 'eyJpdiI6Inlvc0hmeHlDZUFHd204RTQyZjdVNlE9PSIsInZhbHVlIjoiOTB3SVlwQXNJNHlnZ0tydGVkMkZoZz09IiwibWFjIjoiZjQxNGM1Mzc2MjRhMjNhN2JjMjRhMjliMTU5MmYxMWU1OTg1NjllNzIyMzVhNTUxODQ3ODRhNDBhNDRhMmVlMCJ9', 1, 1, 0, 0, NULL, NULL, '2017-09-19 23:07:27', '2017-09-19 23:24:02'),
(78, '+919560102563', '8889', '2017-09-20 14:47:39', NULL, 'asfdasdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 2, 1, 0, NULL, NULL, '2017-09-20 09:02:30', '2017-09-20 09:15:47'),
(79, '+919560102533', '6994', '2017-09-20 14:48:33', NULL, 'sumt', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 1, 2, 1, 0, NULL, NULL, '2017-09-20 09:16:22', '2017-09-20 09:16:49'),
(80, '+919560102539', '6333', '2017-09-20 14:57:11', NULL, 'sumt', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'localhost_80', 'eyJpdiI6IjJ5ZjVRdmR1azhBM1wvNmhxbHZWdmF3PT0iLCJ2YWx1ZSI6Im1aaUdZUGo3MzZMV2tJaEdvSDBwM0E9PSIsIm1hYyI6ImNiM2Y1YjMwZjE4ZjM3OGQxMDI1Yzk1NTI5NTA5NTNmNWQyMzEzOTQ3N2NlNmM1ZjNiNzdkYWE1YzBjYzMwMGMifQ==', 1, 2, 1, 0, NULL, NULL, '2017-09-20 09:25:11', '2017-09-20 09:25:29'),
(82, '', '', '0000-00-00 00:00:00', 'amit.kumar@appster2.in1', 'amit', '$2y$10$sZ8pvCDRqlBimbxzbvUQ1OsrnzKdiI72GiyrhjysFg.v2cxk5ZuNG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'localhost_82', 'eyJpdiI6Im83WnljMitvTU04ekh6MzZsXC9XZkNRPT0iLCJ2YWx1ZSI6Ilo3Yk40ZGg0WVVQUzkrZ3hYdWZRTXc9PSIsIm1hYyI6IjA1MDY1OWI0YTFlZTQxZjhkZTMwMzU2NTY3Y2VhZDM4MWI3MTQ4MjIyZTk2MmEwMDQ3ODk1YTI5NTFkNTdmNWQifQ==', 1, 1, 0, 0, NULL, NULL, '2017-10-16 23:58:58', '2017-10-16 23:59:00'),
(83, '', '', '0000-00-00 00:00:00', 'amit.kumar@appster2.in', 'amit', '$2y$10$QldTcN3LHw/oj28CUHjur.h9c/BUcGa8E9uU0xpNxzcYCkBNJ7byC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'localhost_83', 'eyJpdiI6IlRSTHgwUGVXXC9PQTRocjFpaHdCa0ZBPT0iLCJ2YWx1ZSI6IjV3dER5bGtpamRQWFwvSkpIbzNYZlRBPT0iLCJtYWMiOiJjMGQ2YTM4MjQyMDcxZmE3YjhhZjhkYWFjZGIxZTU1MTQzYTc5ODZjNTE5ZjEzZTIyNTBkMTVjYzljMDNmMDQyIn0=', 1, 1, 0, 0, NULL, NULL, '2017-10-16 23:59:42', '2017-10-16 23:59:44'),
(84, '', '', '0000-00-00 00:00:00', 'amit.kumar@appster21.in', 'amit same', '$2y$10$4ajCpS/0skEg9gim89uHoeQ2PUsN4KSimQFq65kmJbJxJDOxscecG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'localhost_84', 'eyJpdiI6ImVKdE9IQmRWRGI1aUxsMVpteDdvaGc9PSIsInZhbHVlIjoiUTJmQ2RYRWM3bW5Ub1VXUTltNm1Rdz09IiwibWFjIjoiZjJkMmNmYTdmNmJhZGM0Y2MyOTZmMzc0OWIwNjIxZDRjNjQ1ZDQ0ODUwNmY2MjAyNGZjZjI4ODQ1NDhiYWUzZCJ9', 1, 2, 1, 0, NULL, NULL, '2017-10-17 00:03:26', '2017-10-17 00:03:29'),
(85, '', '', '0000-00-00 00:00:00', 'amit@y.com', 'amit', '$2y$10$TmldGPlrb/XOaWxaq0z78u3J3zU.LbSWLtj7W9BUY6eGeEnZs9UPq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'localhost_85', 'eyJpdiI6IjV0UTAwb2lYZXFDY21PZG5QSDNLQ2c9PSIsInZhbHVlIjoiVlpubHJXNjNpck9Ka0FpV0lmMFFvZz09IiwibWFjIjoiNzRjYzg1NGY1ZTY5M2NiODU3YTM2NTM2NzY5YTMwMWQ3ZWE0NDZhZmRjMjUwMDZjNTg4ODc2MmY1ZTVmMTY4YiJ9', 1, 2, 1, 0, NULL, NULL, '2017-10-18 04:32:14', '2017-10-18 04:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `users_dislike_keywords`
--

CREATE TABLE `users_dislike_keywords` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `keyword_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_like_keywords`
--

CREATE TABLE `users_like_keywords` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `keyword_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(9, 71, 'my name', '8ff17e714caae6ca92a113d6b1593a791501053948', 1, '2017-07-13 22:55:28', '2017-10-05 03:48:32'),
(10, 72, 'AFFC4FAC40C1D2FBFF9A66105DC11FE8269AA8EF2AB88E5D26D85188E5EC82F4', '5b831acd9a24ef17a0467814e5e3d29f1500614565', 1, '2017-07-20 23:52:45', '2017-09-29 09:59:00'),
(11, 74, '1', 'f73a1b7587af1b315e5f4eae05fd731c1500614660', 1, '2017-07-20 23:54:20', '2017-09-27 08:21:52'),
(12, 78, '1', '0fdb2b38576aa4c6c1f3ae2642e5febc1505918747', 1, '2017-09-20 09:12:45', '2017-09-20 09:15:47'),
(13, 79, '1', 'ff003de292746e849f85b35de710db0d1505918809', 1, '2017-09-20 09:16:49', '2017-09-20 09:16:49'),
(14, 82, '1', 'd2d2cc0e592f8020568aebb69226f0531508227789', 1, '2017-10-17 02:35:27', '2017-10-17 02:39:49'),
(15, 85, '1', 'dbf89690eb24f0412e13bba26cce7e111508320935', 1, '2017-10-18 04:32:15', '2017-10-18 04:32:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accept_public_question`
--
ALTER TABLE `accept_public_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `asked_for_user_id` (`asked_for_user_id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `answer_liked`
--
ALTER TABLE `answer_liked`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answer_id` (`answer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_type` (`asset_type`),
  ADD KEY `asset_category_id` (`asset_category_id`);

--
-- Indexes for table `asset_category`
--
ALTER TABLE `asset_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocked_users`
--
ALTER TABLE `blocked_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `blocked_user_id` (`blocked_user_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `friend_user_id` (`friend_user_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_by` (`question_by`),
  ADD KEY `status` (`status`),
  ADD KEY `question_for` (`question_for`);
ALTER TABLE `questions` ADD FULLTEXT KEY `question` (`question`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `report_for` (`report_for`);

--
-- Indexes for table `report_questions`
--
ALTER TABLE `report_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `name` (`name`),
  ADD KEY `status` (`status`),
  ADD KEY `user_type` (`role`),
  ADD KEY `mobile` (`mobile_number`) USING BTREE;
ALTER TABLE `users` ADD FULLTEXT KEY `avatar_name` (`avatar_name`);

--
-- Indexes for table `users_dislike_keywords`
--
ALTER TABLE `users_dislike_keywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_dislike_keys` (`keyword_id`);

--
-- Indexes for table `users_like_keywords`
--
ALTER TABLE `users_like_keywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `like_key_id` (`keyword_id`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `like_key_id_2` (`keyword_id`);

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
-- AUTO_INCREMENT for table `accept_public_question`
--
ALTER TABLE `accept_public_question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `answer_liked`
--
ALTER TABLE `answer_liked`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;
--
-- AUTO_INCREMENT for table `asset_category`
--
ALTER TABLE `asset_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `blocked_users`
--
ALTER TABLE `blocked_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `report_questions`
--
ALTER TABLE `report_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `users_dislike_keywords`
--
ALTER TABLE `users_dislike_keywords`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_like_keywords`
--
ALTER TABLE `users_like_keywords`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accept_public_question`
--
ALTER TABLE `accept_public_question`
  ADD CONSTRAINT `accept_public_question_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `accept_public_question_ibfk_2` FOREIGN KEY (`asked_for_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `answer_liked`
--
ALTER TABLE `answer_liked`
  ADD CONSTRAINT `answer_liked_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `answer_liked_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_ibfk_1` FOREIGN KEY (`asset_category_id`) REFERENCES `asset_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `blocked_users`
--
ALTER TABLE `blocked_users`
  ADD CONSTRAINT `blocked_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blocked_users_ibfk_2` FOREIGN KEY (`blocked_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `feedbacks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `flags`
--
ALTER TABLE `flags`
  ADD CONSTRAINT `flags_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`question_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`report_for`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_dislike_keywords`
--
ALTER TABLE `users_dislike_keywords`
  ADD CONSTRAINT `users_dislike_keywords_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_dislike_keywords_ibfk_2` FOREIGN KEY (`keyword_id`) REFERENCES `keywords` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_like_keywords`
--
ALTER TABLE `users_like_keywords`
  ADD CONSTRAINT `users_like_keywords_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_like_keywords_ibfk_2` FOREIGN KEY (`keyword_id`) REFERENCES `keywords` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
