-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2019 at 11:05 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookings`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `building_id` int(10) UNSIGNED NOT NULL COMMENT 'อาคารห้องประชุม',
  `rooms_id` int(10) UNSIGNED NOT NULL COMMENT 'ห้องประชุม',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'ผู้จอง',
  `approve_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ผู้อนุมัติ',
  `booking_date` date NOT NULL COMMENT 'วันที่จอง',
  `booking_begin` time NOT NULL COMMENT 'เวลาเริ่ม',
  `booking_end` time NOT NULL COMMENT 'เวลาจบ',
  `booking_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'เรื่องประชุม',
  `booking_num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'จำนวนคน',
  `booking_detail` text COLLATE utf8mb4_unicode_ci COMMENT 'รายละเอียดเพิ่มเติม',
  `booking_status` int(11) NOT NULL DEFAULT '2' COMMENT 'สถานะ 0-ยกเลิก 1-อนุมัติ 2-รออนุมัติ',
  `booking_owner_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'การจอกหลัก',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `building_id`, `rooms_id`, `user_id`, `approve_name`, `booking_date`, `booking_begin`, `booking_end`, `booking_title`, `booking_num`, `booking_detail`, `booking_status`, `booking_owner_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'superadmin', '2019-05-06', '12:00:00', '15:00:00', 'ทอสอบ 1', '10', '-', 1, 1, '2019-05-02 13:16:24', '2019-05-02 14:01:37'),
(2, 1, 1, 1, 'superadmin', '2019-05-06', '15:00:00', '18:00:00', 'ทอสอบ 2', '20', NULL, 1, 2, '2019-05-02 14:00:25', '2019-05-02 14:01:37'),
(3, 2, 13, 1, NULL, '2019-05-07', '15:00:00', '16:00:00', 'ทอสอบ 3', '60', NULL, 2, 3, '2019-05-02 14:01:14', '2019-05-02 14:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` int(10) UNSIGNED NOT NULL,
  `buildings_name` varchar(191) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่ออาคาร',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT 'สถานะ 0 ยกเลิก 1 ใช้งาน',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `buildings_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'อาคารจุฬาภรณ์', 1, '2019-04-21 01:36:38', '2019-04-21 01:36:38'),
(2, 'อาคารวิทยาศาสตร์', 1, '2019-04-21 01:36:58', '2019-04-21 01:36:58'),
(3, 'อาคารวุฒฑากาศ', 1, '2019-04-21 01:37:48', '2019-04-21 01:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_03_13_124154_create_roles_table', 1),
(4, '2019_03_13_124647_create_user_roles_table', 1),
(5, '2019_03_13_202107_create_buildings_table', 1),
(6, '2019_04_06_160251_create_rooms_table', 1),
(7, '2019_04_07_075447_create_bookings_table', 1),
(8, '2019_04_07_125838_create_user_room_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin', '2019-04-21 01:29:47', '2019-04-21 01:29:47'),
(2, 'admin', 'admin', '2019-04-21 01:29:47', '2019-04-21 01:29:47'),
(3, 'user', 'User', '2019-04-21 01:29:47', '2019-04-21 01:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `building_id` int(10) UNSIGNED NOT NULL COMMENT 'อาคาร',
  `building_floor` tinyint(2) NOT NULL,
  `rooms_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อห้องประชุม',
  `rooms_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ขนาดห้องประชุม',
  `rooms_equipment` text COLLATE utf8mb4_unicode_ci,
  `rooms_detail` text COLLATE utf8mb4_unicode_ci COMMENT 'รายละเอียด',
  `rooms_status` int(11) NOT NULL DEFAULT '1' COMMENT 'สถานะ 0 ยกเลิก 1 ใช้งาน',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `building_id`, `building_floor`, `rooms_name`, `rooms_size`, `rooms_equipment`, `rooms_detail`, `rooms_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'จภ 1101', '10', 'คอมพิวเตอร์ โปรเจคเตอร์', '-', 1, '2019-05-02 11:58:51', '2019-05-02 11:58:51'),
(2, 1, 2, 'จภ 1201', '20', 'คอมพิวเตอร์ โปรเจคเตอร์', '-', 1, '2019-05-02 12:10:12', '2019-05-02 12:12:24'),
(3, 1, 3, 'จภ 1301', '50', 'คอมพิวเตอร์ โปรเจคเตอร์', '-', 1, '2019-05-02 12:10:48', '2019-05-02 12:12:44'),
(12, 2, 1, 'วท 1101', '100', 'คอมพิวเตอร์ โปรเจคเตอร์', '-', 1, '2019-05-02 12:21:42', '2019-05-02 12:21:42'),
(13, 2, 2, 'วท 1201', '10', 'คอมพิวเตอร์ โปรเจคเตอร์', '-', 1, '2019-05-02 12:29:34', '2019-05-02 12:29:34'),
(14, 3, 1, 'วฒ 1101', '20', 'คอมพิวเตอร์ โปรเจคเตอร์', '-', 1, '2019-05-02 12:32:07', '2019-05-02 12:32:07'),
(15, 3, 2, 'วฒ 1201', '40', 'คอมพิวเตอร์ โปรเจคเตอร์', '-', 1, '2019-05-02 12:33:47', '2019-05-02 12:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `description`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin', 'superadmin@mail.com', NULL, '$2y$10$7kwcP67Mpg9H2QuvWYsCFuMUElUqNCbxwVWV/dkj.RvncwQtAVjvy', 'superadmin', 'FMmGEcspmQobzzLR8hyCdkjJEmgEPfm6ZzuI11YPuMrfzEPYvCj4m1tu9mc4', '2019-04-21 01:35:14', '2019-04-21 01:35:14'),
(2, 'admin', 'admin', 'admin@mail.com', NULL, '$2y$10$iY0xVmCQH1njOG1BWQGD0.1q3sT5F8vfJ3op5fLWGNboRXMV7E5dq', 'admin', 'hsu6fNtZy2ChKReuuH5Eb9fGeZU2ZhiVg1K7VMXJTxOF1Xw1oRia8EiTEnhH', '2019-04-21 01:35:14', '2019-04-21 01:35:14'),
(3, 'user', 'user', 'user@mail.com', NULL, '$2y$10$HVSKdvrADx7UK0gSye6XPOonQG39cxR5A8MKdr46VjBnayx6YKiD.', 'user', 'iApcHdvEgT5Ip3JQH2lWmUwJ0DWcU3BgO9NLFycZvjsAdT6W9jljTx3P7Qi3', '2019-04-21 01:35:15', '2019-04-21 01:35:15'),
(4, 'admin02', 'admin02', 'piyapoanac@hotmail.com', NULL, '$2y$10$9pCSyu.kI2AOcjm0bWMZ2OlXOvrg12bxgUAme8SIeYiU0BUrpsEPS', 'admin', 'AyrzV7lCRagb75L3WS1H3hQINZR7OAdCxIBA3NgZIh6FFTkytIycQEcHDby2', '2019-04-21 02:01:33', '2019-04-21 02:01:33'),
(5, 'admin03', 'admin03', 'piyapddonac@hotmail.com', NULL, '$2y$10$YTNjPYm/kDfWh7w1odraD.KrR0wpkBHBB43aPRucYwSIlmNs.IKbS', 'admin', NULL, '2019-04-21 02:08:50', '2019-04-21 02:08:50'),
(6, 'admin04', 'admin04', 'piayapoddnac@hotmail.com', NULL, '$2y$10$4uSrn9JD07ZgLFUvMst5HuJL6SJnIl1YZ.FhNYDmlqCKbaNBXlLDy', 'admin', NULL, '2019-04-21 02:10:46', '2019-04-21 02:10:46'),
(7, 'admin05', 'admin05', 'piyapaoanac@hotmail.com', NULL, '$2y$10$PEMBE81/zGBNnZ3ieDDzmuSwHCRuWFGf7p3.mxzyibObafi3NiWKW', 'admin', NULL, '2019-04-21 02:16:25', '2019-04-21 02:16:25'),
(8, 'admin007', 'admin007', 'piyaposddnac@hotmail.com', NULL, '$2y$10$uD8zYuAxrMs8VU047Qehdu.GaXslzkq1mwJ2epQ8TSfqt/fYE89by', 'admin', NULL, '2019-04-24 23:04:58', '2019-04-24 23:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 3, NULL, NULL),
(4, 4, 2, NULL, NULL),
(5, 5, 2, NULL, NULL),
(6, 6, 2, NULL, NULL),
(7, 7, 2, NULL, NULL),
(8, 8, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_room`
--

CREATE TABLE `user_room` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) NOT NULL,
  `rooms_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_room`
--

INSERT INTO `user_room` (`id`, `users_id`, `rooms_id`, `created_at`, `updated_at`) VALUES
(3, 2, 1, '2019-05-02 11:54:40', '2019-05-02 11:54:40'),
(4, 4, 1, '2019-05-02 11:54:40', '2019-05-02 11:54:40'),
(5, 5, 1, '2019-05-02 11:54:40', '2019-05-02 11:54:40'),
(9, 2, 2, '2019-05-02 12:07:40', '2019-05-02 12:07:40'),
(10, 4, 2, '2019-05-02 12:07:40', '2019-05-02 12:07:40'),
(11, 5, 2, '2019-05-02 12:07:40', '2019-05-02 12:07:40'),
(16, 2, 3, '2019-05-02 12:18:58', '2019-05-02 12:18:58'),
(17, 4, 3, '2019-05-02 12:18:58', '2019-05-02 12:18:58'),
(18, 5, 3, '2019-05-02 12:18:58', '2019-05-02 12:18:58'),
(20, 7, 13, '2019-05-02 12:29:34', '2019-05-02 12:29:34'),
(21, 8, 14, '2019-05-02 12:32:07', '2019-05-02 12:32:07'),
(25, 5, 15, '2019-05-02 12:56:39', '2019-05-02 12:56:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_building_id_foreign` (`building_id`),
  ADD KEY `bookings_rooms_id_foreign` (`rooms_id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_building_id_foreign` (`building_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_room`
--
ALTER TABLE `user_room`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_room`
--
ALTER TABLE `user_room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_booking_owner_id_foreign` FOREIGN KEY (`booking_owner_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `bookings_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`),
  ADD CONSTRAINT `bookings_rooms_id_foreign` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
