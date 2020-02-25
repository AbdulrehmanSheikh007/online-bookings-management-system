-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2020 at 08:43 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `hotel_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ntn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkin_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adults` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT NULL,
  `total` double NOT NULL DEFAULT 0,
  `advance` double NOT NULL DEFAULT 0,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `hotel_id`, `first_name`, `last_name`, `status`, `email`, `cnic`, `ntn`, `phone`, `checkin_at`, `checkout_at`, `adults`, `children`, `total`, `advance`, `notes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Abdulrehman', 'Sheikh', 1, 'sheikhabdulrehman8@gmail.com', '8787878787878787', '03464357146', '03464357146', '2020-01-15 00:00:00', '2020-02-21 23:59:00', 7, 5, 2000, 1500, 'notes for booking', NULL, '2020-01-30 06:26:41', '2020-01-30 06:26:41'),
(2, 1, 'Sheikh', 'Abdul', 1, 'sheikhabdulrehman8@gmail.com', '8787878787878787', '03464357146', '03464357146', '2020-01-15 00:00:00', '2020-02-21 23:59:00', 7, 5, 2000, 1500, 'notes for booking', NULL, '2020-01-30 06:27:53', '2020-01-30 10:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UAN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_uri` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `logo`, `status`, `email`, `UAN`, `folder_path`, `contact_first_name`, `contact_last_name`, `contact_number_1`, `contact_number_2`, `contact_email`, `address_line_1`, `address_line_2`, `city`, `state`, `postal_code`, `country`, `website_uri`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Pearl Continental (PC)', 'hotels//logo/FPD6Ij9k8zTbVJzFo7wTUErNicOiDV0VhvRW1cev.png', 1, 'sheikhabdulrehman8@gmail.com', '03464357146', NULL, 'Abdulrehman', 'Sheikh', '03464357146', '03464357146', 'sheikhabdulrehman8@gmail.com', 'Mian Mir', 'Upper Mall Road', 'Lahore', 'Punjab', '54000', 'Pakistan', 'https://facebook.com/computersworm', NULL, '2020-01-30 03:51:30', '2020-01-30 10:05:17'),
(2, 'Abdulrehman Sheikh', NULL, 1, 'sheikhabdulrehman8@gmail.com', '3235652648421841', 'abdulrehman_sheikh_WP1B7LomZj9ple', 'Abdulrehman', 'Sheikh', '03464357146', '03464357146', 'sheikhabdulrehman8@gmail.com', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', 'Lahore', 'Punjab', '54000', 'Pakistan', 'https://www.fedex.com/', NULL, '2020-01-30 10:19:00', '2020-01-30 10:19:02'),
(3, 'Hotel One', NULL, 1, 'sheikhabdulrehman8@gmail.com', '3235652648421841', 'hotel_one_QRnMp81dZd1JDP', 'Abdulrehman', 'Sheikh', '03464357146', '03464357146', 'sheikhabdulrehman8@gmail.com', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', 'Lahore', 'Punjab', '54000', 'Pakistan', 'https://www.fedex.com/', NULL, '2020-01-30 10:19:39', '2020-01-30 10:19:39'),
(4, 'Al-Nakhal', NULL, 1, 'sheikhabdulrehman8@gmail.com', '3235652648421841', 'hotel_one_3zp4kZGzXomNV7', 'Abdulrehman', 'Sheikh', '03464357146', '03464357146', 'sheikhabdulrehman8@gmail.com', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', 'Lahore', 'Punjab', '54000', 'Pakistan', 'https://www.fedex.com/', NULL, '2020-01-30 10:20:04', '2020-01-30 10:30:46'),
(5, 'Hotel One', NULL, 1, 'sheikhabdulrehman8@gmail.com', '3235652648421841', 'hotel_one_ObNEDZRYXGVkQr', 'Abdulrehman', 'Sheikh', '03464357146', '03464357146', 'sheikhabdulrehman8@gmail.com', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', 'Lahore', 'Punjab', '54000', 'Pakistan', 'https://www.fedex.com/', NULL, '2020-01-30 10:20:16', '2020-01-30 10:20:16'),
(6, 'Hotel One', NULL, 1, 'sheikhabdulrehman8@gmail.com', '3235652648421841', 'hotel_one_7gqBRZAV8MaJAP', 'Abdulrehman', 'Sheikh', '03464357146', '03464357146', 'sheikhabdulrehman8@gmail.com', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', 'Lahore', 'Punjab', '54000', 'Pakistan', 'https://www.fedex.com/', NULL, '2020-01-30 10:22:47', '2020-01-30 10:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `hotel_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(19, '2014_10_12_100000_create_password_resets_table', 1),
(20, '2019_01_01_000002_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `hotel_id` int(10) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ntn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `_token_expiry` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `hotel_id`, `first_name`, `last_name`, `username`, `email`, `cnic`, `ntn`, `profile_img`, `address_line_1`, `address_line_2`, `state`, `postal_code`, `phone`, `status`, `password`, `remember_token`, `email_verified_at`, `_token`, `_token_expiry`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Super', 'Admin', 'super_admin', 'sheikhabdulrehman8@gmail.com', '35202-34568529-9', 'ABC00753691', NULL, 'Lahore, Punjab Pakistan.', NULL, NULL, NULL, '+923111111111', 1, '$2y$10$A2ioHm.i6mqU6wRyB5jQd.POMAQJ0YjyO5pypo5itwmSUEiWrlcki', NULL, '2020-01-30 03:51:30', NULL, NULL, NULL, '2020-01-30 03:51:30', '2020-01-30 03:51:30'),
(2, NULL, 'Abdulrehman', 'Sheikh', 'haiderali', 'sheikhabdulrehman8@gmail.com', '8787878787878787', '654564654465', NULL, '33 F/A Sarwar Rd, Cantonment Board Staff Colony', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', 'Punjab', '54000', '03464357146', 0, '$2y$10$C0O57MSfe3ueyTYioZvcEeT1cSanjxF7pC1jJJMdMM04uVe5OvoTu', NULL, NULL, '3mPSAEuxYCqkhY', '2020-01-31 10:45:40', NULL, '2020-01-30 10:45:40', '2020-01-30 10:45:40'),
(3, NULL, 'Abdulrehman', 'Sheikh', 'haiderali', 'sheikhabdulrehman8@gmail.com', '8787878787878787', '654564654465', NULL, '33 F/A Sarwar Rd, Cantonment Board Staff Colony', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', 'Punjab', '54000', '03464357146', 0, '$2y$10$M2ChiCvY77i8ft1gVdF9gujIaL606ENn1b6aqhQe0cwkO901pFr4K', NULL, NULL, 'qgZavnzOgcn60A', '2020-01-31 10:49:27', NULL, '2020-01-30 10:49:27', '2020-01-30 10:49:27'),
(4, NULL, 'Abdulrehman', 'Sheikh', 'haiderali', 'sheikhabdulrehman8@gmail.com', '8787878787878787', '654564654465', NULL, '33 F/A Sarwar Rd, Cantonment Board Staff Colony', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', 'Punjab', '54000', '03464357146', 0, '$2y$10$uN7yGMTDZJreBqg5lsHZguTEbulUD/8ydpaZsZQ0zx1W7Pedpi54K', NULL, NULL, '96OKYFdCvJdCLu', '2020-01-31 11:05:05', NULL, '2020-01-30 11:05:04', '2020-01-30 11:05:05'),
(5, NULL, 'Abdulrehman', 'Sheikh', 'haiderali', 'sheikhabdulrehman8@gmail.com', '8787878787878787', '654564654465', NULL, '33 F/A Sarwar Rd, Cantonment Board Staff Colony', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', 'Punjab', '54000', '03464357146', 0, '$2y$10$aOz.w0KkPJZNo5ch4kjGUezu5UBL0s8atE3wMB5OSDk5HDNjnzJBW', NULL, NULL, 'dZvTUWMawd6fQL', '2020-01-31 11:05:12', NULL, '2020-01-30 11:05:12', '2020-01-30 11:05:12'),
(6, NULL, 'Sheikh', 'Sheikh', 'haideral44', 'sheikhabdulrehman8@gmail.com', '8787878787878787', '654564654465', NULL, '33 F/A Sarwar Rd, Cantonment Board Staff Colony', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', 'Punjab', '54000', '03464357146', 0, '$2y$10$bIhZF8gTDtopGLtb09sVi.w5covpcnYdSqWwkuTk0/sDGACmpJ3yi', NULL, NULL, 'hmHe1OM0KZcveC', '2020-01-31 11:10:27', NULL, '2020-01-30 11:10:20', '2020-01-30 11:12:04'),
(7, 1, 'Abdulrehman', 'Sheikh', '', 'sheikhabdulrehman8@gmail.com', '8787878787878787', '654564654465', NULL, '33 F/A Sarwar Rd, Cantonment Board Staff Colony', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', 'Punjab', '54000', '03464357146', 0, '$2y$10$HwG3TSwCjJYMG1TIdu1uXe3M1h17/embkuljtOGBkhwCtK6wldJwa', NULL, NULL, 'YIAzI8CdVA2e3T', '2020-01-31 11:15:16', NULL, '2020-01-30 11:15:08', '2020-01-30 11:15:44'),
(8, 1, 'Sheikh', 'Zayan', '', 'sheikhabdulrehman8@gmail.com', '8787878787878787', '654564654465', NULL, '33 F/A Sarwar Rd, Cantonment Board Staff Colony', '33 F/A Sarwar Rd, Cantonment Board Staff Colony', 'Punjab', '54000', '03464357146', 0, '$2y$10$deIgMlvh/dqQumlRQ.My4OercaelMSSjm8wzFc9l4xyiepomybYiy', NULL, NULL, 'Evryo7z8ChrH4l', '2020-01-31 11:17:04', NULL, '2020-01-30 11:16:56', '2020-01-30 11:17:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_hotel_id_foreign` (`hotel_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_hotel_id_foreign` (`hotel_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_hotel_id_foreign` (`hotel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
