-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 13, 2016 at 01:31 AM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homestead`
--

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

CREATE TABLE `entities` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` mediumint(9) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `location` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `entities`
--

INSERT INTO `entities` (`id`, `title`, `description`, `website`, `created_by`, `created_at`, `updated_at`, `published`, `location`) VALUES
(1, 'Datagonia Web', '', 'undefined', 0, '2016-08-13 15:30:09', '2016-08-13 15:30:09', '0000-00-00 00:00:00', NULL),
(2, 'Z Global Marketing', '', 'undefined', 0, '2016-08-13 15:30:19', '2016-08-13 15:30:19', '0000-00-00 00:00:00', NULL),
(3, 'Intuit', '', 'undefined', 0, '2016-08-13 15:30:28', '2016-08-13 15:30:28', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_01_07_034637_create_entities_table', 1),
('2016_01_07_040101_add_location_to_entities_table', 1),
('2016_02_18_041122_add_website_and_user_entities_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'reprehenderit', 'norval.welch@gmail.com', 'Y+wV#dl', NULL, '2016-08-13 13:40:39', '2016-08-13 13:40:39'),
(2, 'beatae', 'neha91@steuber.org', 'MN/5w28:8Jz#)', NULL, '2016-08-13 13:40:39', '2016-08-13 13:40:39'),
(3, 'amet', 'johnston.vivian@gmail.com', '[PU0G%1!B#&osSZm`7', NULL, '2016-08-13 13:40:39', '2016-08-13 13:40:39'),
(4, 'suscipit', 'torphy.lexie@walker.biz', 'qw6v(=F5dn$k|U>r4', NULL, '2016-08-13 13:40:39', '2016-08-13 13:40:39'),
(5, 'nisi', 'arnold.toy@haley.com', 'GDy_|],W99D2j', NULL, '2016-08-13 13:40:39', '2016-08-13 13:40:39'),
(6, 'aspernatur', 'wiegand.raheem@sawayn.org', 'qUY4\\w8}', NULL, '2016-08-13 13:40:39', '2016-08-13 13:40:39'),
(7, 'ut', 'zachary.carter@yahoo.com', 'bd8uE7m', NULL, '2016-08-13 13:40:39', '2016-08-13 13:40:39'),
(8, 'impedit', 'louisa.metz@mckenzie.net', '}kfq}7ep@v~{&)]%fs', NULL, '2016-08-13 13:40:39', '2016-08-13 13:40:39'),
(9, 'aperiam', 'jstiedemann@hotmail.com', ',AXxc7zeD]z;8m_{*#Z', NULL, '2016-08-13 13:40:39', '2016-08-13 13:40:39'),
(10, 'eius', 'lauriane49@halvorson.com', 'a)Mb")N~', NULL, '2016-08-13 13:40:39', '2016-08-13 13:40:39'),
(11, '', 'kylan.hurt@intuit.com1', '$2y$10$xjTBAUCBeimKgTqCWQIHkOjSkyDy0OwgJMkNm4mGu2lV1cVZ.Lm4C', NULL, '2016-08-13 13:40:53', '2016-08-13 13:40:53'),
(12, '', 'a@a.a', '$2y$10$.qp.0qWj2y7c6/Ay3ViEdeY53rnPe8EV2Ihc3uzjipQ3SL83p9M5u', NULL, '2016-08-13 13:44:23', '2016-08-13 13:44:23'),
(13, '', 'a@a.a1', '$2y$10$4/6WLBUpImFQQd7vf/AzzuaKWUrmOREaENCnepMG82z8bztBgt7fe', NULL, '2016-08-13 13:47:02', '2016-08-13 13:47:02'),
(14, '', 'a@a.a2', '$2y$10$pmP0wcmc0c4RZmAElg.qweMbgHKlnow/hYL28NtmomoUWKcPBpV4i', NULL, '2016-08-13 13:49:07', '2016-08-13 13:49:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entities`
--
ALTER TABLE `entities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entities`
--
ALTER TABLE `entities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
