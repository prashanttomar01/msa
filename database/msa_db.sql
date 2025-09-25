-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 02:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `msa_form`
--

CREATE TABLE `msa_form` (
  `id` int(11) NOT NULL,
  `operators` int(11) DEFAULT NULL,
  `trials` int(11) DEFAULT NULL,
  `parts` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `msa_form`
--

INSERT INTO `msa_form` (`id`, `operators`, `trials`, `parts`, `status`, `created_at`, `updated_at`) VALUES
(1, 96, 64, 56, NULL, '2025-02-27 11:55:17', NULL),
(2, 70, 35, 45, NULL, '2025-02-27 12:00:14', NULL),
(3, 20, 51, 88, NULL, '2025-02-28 10:57:03', NULL),
(4, 31, 97, 14, NULL, '2025-02-28 11:00:27', NULL),
(5, 13, 40, 11, NULL, '2025-02-28 11:02:14', NULL),
(6, 0, 0, 0, NULL, '2025-02-28 11:03:34', NULL),
(7, 44, 42, 35, NULL, '2025-02-28 11:03:52', NULL),
(8, 38, 1, 39, NULL, '2025-02-28 11:04:35', NULL),
(9, 30, 31, 24, NULL, '2025-02-28 11:14:42', NULL),
(10, 86, 32, 1, NULL, '2025-02-28 11:51:23', NULL),
(11, 86, 32, 1, NULL, '2025-02-28 11:51:26', NULL),
(12, 85, 21, 37, NULL, '2025-02-28 12:02:34', NULL),
(13, 85, 21, 37, NULL, '2025-02-28 12:02:38', NULL),
(15, 85, 21, 37, NULL, '2025-02-28 12:02:38', NULL),
(16, 56, 34, 5, NULL, '2025-02-28 12:14:51', NULL),
(17, 56, 34, 5, NULL, '2025-02-28 12:14:52', NULL),
(18, 94, 73, 100, NULL, '2025-02-28 12:21:06', NULL),
(19, 94, 73, 100, NULL, '2025-02-28 12:21:08', NULL),
(20, 94, 73, 100, NULL, '2025-02-28 12:21:17', NULL),
(21, 94, 73, 100, NULL, '2025-02-28 12:21:17', NULL),
(22, 94, 73, 100, NULL, '2025-02-28 12:21:19', NULL),
(23, 54, 50, 82, NULL, '2025-02-28 12:21:57', NULL),
(24, 54, 50, 82, NULL, '2025-02-28 12:21:58', NULL),
(25, 54, 50, 82, NULL, '2025-02-28 12:21:59', NULL),
(26, 54, 50, 82, NULL, '2025-02-28 12:21:59', NULL),
(27, 54, 50, 82, NULL, '2025-02-28 12:22:10', NULL),
(28, 54, 50, 82, NULL, '2025-02-28 12:22:11', NULL),
(29, 77, 74, 57, NULL, '2025-02-28 12:23:26', NULL),
(30, 77, 74, 57, NULL, '2025-02-28 12:23:27', NULL),
(31, 77, 74, 57, NULL, '2025-02-28 12:23:28', NULL),
(32, 6, 41, 67, NULL, '2025-02-28 12:24:39', NULL),
(33, 52, 82, 59, NULL, '2025-02-28 12:25:43', NULL),
(34, 52, 82, 59, NULL, '2025-02-28 12:25:43', NULL),
(35, 52, 82, 59, NULL, '2025-02-28 12:25:44', NULL),
(36, 62, 55, 23, NULL, '2025-03-05 10:50:24', NULL),
(37, 57, 17, 75, NULL, '2025-03-05 22:55:03', NULL),
(38, 84, 20, 14, NULL, '2025-03-05 22:55:49', NULL),
(39, 71, 65, 28, NULL, '2025-03-05 22:56:40', NULL),
(40, 57, 43, 64, NULL, '2025-03-05 22:59:05', NULL),
(41, 97, 81, 59, NULL, '2025-03-06 16:23:39', NULL),
(42, 82, 92, 53, NULL, '2025-03-07 10:51:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `msa_form_new`
--

CREATE TABLE `msa_form_new` (
  `msa_id` int(11) NOT NULL,
  `gauge_name` varchar(255) DEFAULT NULL,
  `gauge_type` varchar(255) DEFAULT NULL,
  `gauge_number` int(11) DEFAULT NULL,
  `operators` int(11) DEFAULT NULL,
  `trials` int(11) DEFAULT NULL,
  `parts` int(11) DEFAULT NULL,
  `characteristic` varchar(255) DEFAULT NULL,
  `specification` varchar(255) DEFAULT NULL,
  `test_number` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `msa_form_new`
--

INSERT INTO `msa_form_new` (`msa_id`, `gauge_name`, `gauge_type`, `gauge_number`, `operators`, `trials`, `parts`, `characteristic`, `specification`, `test_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Chase Sanchez', 'Quis lorem et debiti', 5, 7, 4, 4, 'Et quia dolore delec', 'Consequatur et iste', 2, 'active', '2025-04-16 12:23:14', '2025-04-18 11:38:13'),
(2, 'Gauge name', 'Gauge type', 6, 7, 3, 5, 'Characteristics', 'Specifications', 3, 'active', '2025-04-18 11:42:46', NULL),
(3, 'Chase Sanchez', 'Quis lorem et debiti', 5, 9, 4, 4, 'Et quia dolore delec', 'Consequatur et iste', 2, 'active', '2025-04-16 12:23:14', '2025-04-18 11:50:23'),
(4, 'Gauge name', 'Gauge type', 6, 3, 3, 5, 'Characteristics', 'Specifications', 3, 'active', '2025-04-18 11:42:46', '2025-04-21 11:48:29'),
(5, 'Aquila Rivera', 'Praesentium possimus', 6, 2, 6, 10, 'Fugiat aute id dui', 'Magna sit porro volu', 8, 'active', '2025-04-20 08:34:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `part_data`
--

CREATE TABLE `part_data` (
  `id` int(11) NOT NULL,
  `msa_id` int(11) DEFAULT NULL,
  `operator` int(11) DEFAULT NULL,
  `trial` int(11) DEFAULT NULL,
  `part_data` float NOT NULL DEFAULT 0,
  `status` enum('yes','no') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password_hash` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password_hash`, `email`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Belle', 'Fox', 'qywatagyr', '$2y$10$HUm0bt2shpShIrNwvI2ZmuMjq8EpWdqe2TTy04uWbrUYb1SeCliZu', 'jywehi@mailinator.com', '+1 (362) 288-7672', 'active', '2025-04-09 11:37:44', NULL),
(4, 'Damian', 'York', 'zonidir', '$2y$10$OA3ByKLyd2WvrQj02zOMmOrfpqECOVlzmjW9FbOjOWkIAg9K3zATe', 'sijyqyh@mailinator.com', '+1 (308) 711-3649', 'active', '2025-04-09 11:37:50', NULL),
(5, 'Drake', 'Mack', 'faboquh', '$2y$10$I3gN8wSpqf9E0jWCYEwBdO6oQWzTVSKvUxQbBwV5Brx/l44zvYnge', 'mabadebuk@mailinator.com', '+1 (392) 516-2994', 'active', '2025-04-09 11:37:56', NULL),
(12, 'ayushi', 'tomar', 'admin', '$2y$10$ni97CVtFuo9Rx60C/EpZO.zBpmKT4CLWuUvoLqKJgjwzvEtQTA7m.', 'admin@gmail.com', '+1 (346) 135-2417', 'active', '2025-04-14 09:13:11', NULL),
(19, 'Abra', 'Larson', 'wekujebev', '$2y$10$nItq4lH6tiUFa181BUd/P.eU6825kcbKjFMcfWhSQ1BmcJT5q0Jfm', 'lafoh@mailinator.com', '+1 (633) 214-5401', 'active', '2025-04-14 09:34:06', NULL),
(22, 'Alan', 'Baird', 'juvulitefi', '$2y$10$nbKMJzF097yovj2xp5k/Lu2p0/9C.1JMK16N6Qq72JztAieic3NV2', 'gebasur@mailinator.com', '+1 (546) 996-6157', 'active', '2025-04-14 09:42:07', NULL),
(23, 'Slade', 'Hopper', 'buzovocu', '$2y$10$c5DNM1egjnC748.OXTXcBemHwJn85OYrX9G0zO01m0Lp.eKYjNXLu', 'kime@mailinator.com', '+1 (279) 869-3158', 'active', '2025-04-14 09:42:13', NULL),
(26, 'Lance', 'Koch', 'liwinezu', '$2y$10$sKNFxsV3OP4QeBI2Epoj9ezefRZyLYDEPMsw0w9FMVnNmPlYRcN5C', 'guxy@mailinator.com', '+1 (261) 929-5667', 'active', '2025-04-14 09:45:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_token` varchar(255) DEFAULT NULL,
  `auth_action` int(11) DEFAULT NULL COMMENT '1=login, 0=logout',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `user_token`, `auth_action`, `created_at`) VALUES
(1, 4, '4ad072099afe37107c8fa2abe020762c', 0, '2025-02-20 11:34:37'),
(2, 5, '87d7ca57443e0bd1af5bdcd7990076d8', 1, '2025-02-20 11:36:19'),
(3, 5, '5a95263bd694a0e3e88f11b26c39327a', 1, '2025-02-20 11:41:20'),
(4, 5, 'dd6fbd7646bfc6dc493db015b285dc67', 1, '2025-02-20 11:41:35'),
(5, 5, 'dd6fbd7646bfc6dc493db015b285dc67', 0, '2025-02-20 11:51:53'),
(6, 6, 'ce6494b5544781244d3748eab3d6dc1b', 1, '2025-02-20 22:14:18'),
(7, 6, 'ce6494b5544781244d3748eab3d6dc1b', 0, '2025-02-20 22:14:26'),
(8, 5, '0a1f716935bf7092d0a8a3290d35121b', 1, '2025-02-20 22:22:22'),
(9, 5, '0a1f716935bf7092d0a8a3290d35121b', 0, '2025-02-20 22:31:08'),
(10, 5, 'c30781164eb1ead08559710a8854cbe7', 1, '2025-02-20 22:31:17'),
(11, 5, 'c30781164eb1ead08559710a8854cbe7', 0, '2025-02-20 22:32:33'),
(12, 5, '22f0ae624cb02343a42b2f2a5f19f4c1', 1, '2025-02-21 10:36:07'),
(13, 5, '22f0ae624cb02343a42b2f2a5f19f4c1', 0, '2025-02-21 11:01:32'),
(14, 5, 'bcae4d2d595f34f8ff7463f6b1231b2b', 1, '2025-02-21 11:01:41'),
(15, 5, 'bcae4d2d595f34f8ff7463f6b1231b2b', 0, '2025-02-21 11:32:09'),
(16, 7, 'b181e4f0b200bb15c5b721b66cce6152', 1, '2025-02-21 11:36:49'),
(17, 7, 'b181e4f0b200bb15c5b721b66cce6152', 0, '2025-02-21 11:43:49'),
(18, 7, '2b053bfbe45237525cef844ece8f0be4', 1, '2025-02-21 11:50:26'),
(19, 7, '2b053bfbe45237525cef844ece8f0be4', 0, '2025-02-21 11:53:21'),
(20, 7, '40d3b85b6568ef0cb5a4b744f7e613ca', 1, '2025-02-21 11:53:33'),
(21, 7, '40d3b85b6568ef0cb5a4b744f7e613ca', 0, '2025-02-21 11:54:47'),
(22, 7, 'f0fde91cf2f3f3687889eccb6913ed96', 1, '2025-02-21 11:54:55'),
(23, 7, 'f0fde91cf2f3f3687889eccb6913ed96', 0, '2025-02-21 12:09:16'),
(24, 7, '99fb83211577a7e0db92b1be3403eace', 1, '2025-02-21 12:09:30'),
(25, 7, '99fb83211577a7e0db92b1be3403eace', 0, '2025-02-21 12:13:57'),
(26, 7, 'f973e2b4c7c91ac743a563cd37faa6d6', 1, '2025-02-21 12:14:06'),
(27, 7, '7a70e7522a807a4a6d02473ae3c06a9c', 1, '2025-02-21 12:14:40'),
(28, 7, '7a70e7522a807a4a6d02473ae3c06a9c', 0, '2025-02-21 12:15:26'),
(29, 7, 'fee0397f05ee3e692fcc79101d52961b', 1, '2025-02-21 12:15:34'),
(30, 5, '248f346b818dd7b331228aa0e569fdb1', 1, '2025-02-24 00:50:58'),
(31, 5, 'c076b7494dd0b467e73e6f9e2fc42fc1', 1, '2025-02-24 00:51:08'),
(32, 5, 'c076b7494dd0b467e73e6f9e2fc42fc1', 0, '2025-02-24 00:57:47'),
(33, 5, 'd159cd466982090228029ec927af5170', 1, '2025-02-24 00:57:57'),
(34, 5, '931cd08fee981a121f8165786880119c', 1, '2025-02-24 00:58:05'),
(35, 5, '931cd08fee981a121f8165786880119c', 0, '2025-02-24 01:05:53'),
(36, 5, '2aead82e08b0e0aa3c103c1b2ff5bddb', 1, '2025-02-24 01:06:03'),
(37, 5, 'eb66f516b54087107cc746ddb8d06bda', 1, '2025-02-24 08:07:14'),
(38, 5, 'eb66f516b54087107cc746ddb8d06bda', 0, '2025-02-24 08:07:36'),
(39, 5, 'fb1b8860e23637569c33aa5785ff94b3', 1, '2025-02-24 10:37:36'),
(40, 5, 'fb1b8860e23637569c33aa5785ff94b3', 0, '2025-02-24 10:40:12'),
(41, 5, '723b06a577e79da13a66de0039fc8242', 1, '2025-02-24 10:44:18'),
(42, 5, 'f167e66c76c91b38030133172e9769bc', 1, '2025-02-24 10:45:14'),
(43, 5, 'f167e66c76c91b38030133172e9769bc', 0, '2025-02-24 10:46:02'),
(44, 5, 'c4aa3d71ca9bc1fb194e5bdafefe18e9', 1, '2025-02-24 10:46:10'),
(45, 5, '15c6ebce9b67c22652f4e0045901fc53', 1, '2025-02-26 07:38:18'),
(46, 5, '15c6ebce9b67c22652f4e0045901fc53', 0, '2025-02-26 07:38:39'),
(47, 5, '15a824fb466cef2a34d99d3b6bf24d23', 1, '2025-02-26 07:38:49'),
(48, 5, '13afb91b2e61ddeb8ca1f1f548b94878', 1, '2025-02-27 10:35:16'),
(49, 5, '9bcf99a67febedd04c00be8e1836699f', 1, '2025-02-28 10:56:52'),
(50, 5, '9bcf99a67febedd04c00be8e1836699f', 0, '2025-02-28 11:24:13'),
(51, 5, '6779119d566902880f257e5a0e5d651b', 1, '2025-02-28 11:24:24'),
(52, 5, '53c37227213832c0c9662b940f85d3e8', 1, '2025-03-03 10:35:46'),
(53, 5, '0d4a3fca8c02b490f86c70ec3ef6c300', 1, '2025-03-04 06:06:30'),
(54, 5, 'c19448bc1d0c5b702e0b8f07e1775703', 1, '2025-03-05 10:47:38'),
(55, 5, '14c6a4e203e5784f9bcf86fe050ee82e', 1, '2025-03-05 22:49:02'),
(56, 5, '14c6a4e203e5784f9bcf86fe050ee82e', 0, '2025-03-05 22:58:07'),
(57, 8, 'fc25b0149cea7dfe01d73427379d5dad', 1, '2025-03-05 22:58:53'),
(58, 5, 'a0c03125279451a419e7ea02af341337', 1, '2025-03-06 16:23:28'),
(59, 5, '7a98c06b880c01a8f956623460c68725', 1, '2025-03-07 09:04:04'),
(60, 5, 'e72abdf7a0cfc81dd5377d6edf3a2c28', 1, '2025-03-07 10:51:02'),
(61, 5, '38d399e4229f1fe5a0298b53853d257b', 1, '2025-03-10 10:36:52'),
(62, 5, '8e0900248e4f49a9fa4b1b5c45edb945', 1, '2025-03-11 00:07:13'),
(63, 5, 'd37bc69aeb36c0b5bd19a361dcf38d41', 1, '2025-03-11 10:36:28'),
(64, 5, '8d9e378deb37faee8ca13344c0792c8d', 1, '2025-03-12 11:04:22'),
(65, 5, 'ff1007e8cfecba100a5dd87758bb26c8', 1, '2025-03-17 06:02:39'),
(66, 5, '83699721721fdb917325917372d11a86', 1, '2025-03-17 11:50:35'),
(67, 5, 'a243d94c9f09eaa4a80d8472ad0c269e', 1, '2025-03-18 11:55:24'),
(68, 5, '16774234cad0f7594b08f6624b479315', 1, '2025-03-19 11:50:36'),
(69, 5, '16774234cad0f7594b08f6624b479315', 0, '2025-03-19 12:52:27'),
(70, 5, 'e25f79d457c0b2250ffbf9434db84e1f', 1, '2025-03-19 12:52:37'),
(71, 5, '9d8e82a6db05da62e0ad56009f39d4b2', 1, '2025-03-20 12:08:44'),
(72, 5, 'dde183866c97a92cef902713a4dbed1a', 1, '2025-03-21 12:11:41'),
(73, 5, '1f392ceda9d5f0e0e2752e5ee833d84f', 1, '2025-03-24 11:21:49'),
(74, 5, '07d912a0a1ce3fa79d902f0b27ac7437', 1, '2025-03-25 11:38:10'),
(75, 5, '841133bb6aed437a761754452b3d73f0', 1, '2025-03-26 01:16:23'),
(76, 5, 'bbedd93914521f97e4f3949ad50460fc', 1, '2025-04-01 10:53:14'),
(77, 5, '3ee5f1776bdc74003ed9fef39069c7cb', 1, '2025-04-02 10:44:18'),
(78, 5, '6d9c7a49a25ab7ba13d0697f894e2ca0', 1, '2025-04-03 00:50:58'),
(79, 5, '6d9c7a49a25ab7ba13d0697f894e2ca0', 0, '2025-04-03 00:51:04'),
(80, 5, 'b900fc7aadd3208314aead7d96589989', 1, '2025-04-03 00:51:14'),
(81, 5, 'fe61a8124b288219aea85a347081baf5', 1, '2025-04-03 10:45:28'),
(82, 5, 'e7b86fb90283e570abbb7b23e1b76598', 1, '2025-04-03 23:44:53'),
(83, 5, 'e8ff20b88ea77c56815f5ed910ae2b2b', 1, '2025-04-06 23:40:33'),
(84, 18, '1b9b4810b1500eea824a5efa044197bc', 1, '2025-04-08 11:50:42'),
(85, 18, '4fc435d4ed69bafcc2460eaa3064ec09', 1, '2025-04-09 11:19:28'),
(86, 18, '4fc435d4ed69bafcc2460eaa3064ec09', 0, '2025-04-09 11:29:30'),
(87, 1, 'ed9766c73073ec77ed512f8f35c29bb4', 1, '2025-04-09 11:30:11'),
(88, 1, 'e120971a9397a08eec7fd59786c35b86', 1, '2025-04-10 11:42:48'),
(89, 1, 'c9550d54a6e489b5e17846f5296a8990', 1, '2025-04-10 11:58:07'),
(90, 1, 'e9ed3602d3dc06d9adabc164a7925df7', 1, '2025-04-11 08:04:13'),
(91, 1, '4a2e226992955ed71fad11456fb8d336', 1, '2025-04-12 08:27:14'),
(92, 1, '0e7ceb4aaa57ff2ffef4acc2babf115c', 1, '2025-04-14 09:12:10'),
(93, 12, 'ac517d6d69b257cc13dbb574fd63e3f5', 1, '2025-04-14 11:49:31'),
(94, 12, '727489d976529308b2d1a2ffd589040e', 1, '2025-04-16 11:38:46'),
(95, 12, '261481de7dbd75f71c106642011ebeb9', 1, '2025-04-17 11:43:36'),
(96, 12, 'b17157695ed9b764ab6bc4ec108b723a', 1, '2025-04-18 11:33:35'),
(97, 12, '50859819c0abddfbbc734398b9561906', 1, '2025-04-20 07:19:19'),
(98, 12, '5f767938253418edbc5af83c22807a56', 1, '2025-04-21 11:35:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `msa_form`
--
ALTER TABLE `msa_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msa_form_new`
--
ALTER TABLE `msa_form_new`
  ADD PRIMARY KEY (`msa_id`);

--
-- Indexes for table `part_data`
--
ALTER TABLE `part_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `msa_form`
--
ALTER TABLE `msa_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `msa_form_new`
--
ALTER TABLE `msa_form_new`
  MODIFY `msa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `part_data`
--
ALTER TABLE `part_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
