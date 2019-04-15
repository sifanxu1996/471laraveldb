-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2019 at 07:12 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transit`
--
DROP DATABASE IF EXISTS `transit`;
CREATE DATABASE IF NOT EXISTS `transit` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `transit`;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `account_balance` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`user_id`, `account_balance`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ssn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`user_id`, `ssn`) VALUES
(2, 222222222),
(3, 333333333),
(4, 444444444),
(5, 555555555),
(6, 666666666);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `req_message` text CHARACTER SET latin1 NOT NULL,
  `analyst_id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `req_message`, `analyst_id`, `route_id`) VALUES
(1, 'TEST REQUEST: RUN 3 reaches maximum capacity. Needs another run shortly before or shortly after RUN 3.', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `start_stop_id` bigint(20) UNSIGNED NOT NULL,
  `end_stop_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `start_stop_id`, `end_stop_id`) VALUES
(1, 'Elbow Drive', 1000, 1020),
(2, 'Fish Creek', 1020, 1040),
(3, 'Bridlewood', 1040, 1060);

-- --------------------------------------------------------

--
-- Table structure for table `route_legs`
--

CREATE TABLE `route_legs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `start_stop_id` bigint(20) UNSIGNED NOT NULL,
  `end_stop_id` bigint(20) UNSIGNED NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `route_legs`
--

INSERT INTO `route_legs` (`id`, `route_id`, `start_stop_id`, `end_stop_id`, `duration`) VALUES
(1, 1, 1000, 1010, 5),
(2, 1, 1010, 1020, 5),
(3, 2, 1020, 1030, 5),
(4, 2, 1030, 1040, 5),
(5, 3, 1040, 1050, 5),
(6, 3, 1050, 1060, 5);

-- --------------------------------------------------------

--
-- Table structure for table `runs`
--

CREATE TABLE `runs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `operator_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `max_ridership` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `runs`
--

INSERT INTO `runs` (`id`, `route_id`, `start_time`, `admin_id`, `operator_id`, `vehicle_id`, `max_ridership`) VALUES
(1, 1, '06:00:00', 2, 3, 1, 17),
(2, 1, '07:00:00', 2, 4, 2, 30),
(3, 1, '08:00:00', 2, 3, 3, 40),
(4, 2, '12:00:00', 2, 4, 4, 22),
(5, 3, '12:00:00', 2, 5, 5, 25);

-- --------------------------------------------------------

--
-- Table structure for table `stops`
--

CREATE TABLE `stops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stops`
--

INSERT INTO `stops` (`id`, `address`) VALUES
(1000, '0th Ave 1000'),
(1010, '1st Ave 1010'),
(1020, '2nd Ave 1020'),
(1030, '3rd Ave 1030'),
(1040, '4th Ave 1040'),
(1050, '5th Ave 1050'),
(1060, '6th Ave 1060');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abe', 'abe@gmail.com', 'client', NULL, '$2y$10$5zNbJsGHv8OYHAgEvqdpw.JukQDAio2KXznmz86oU0YoOW6/9OZfS', NULL, NULL, NULL),
(2, 'Bob', 'bob@gmail.com', 'admin', NULL, '$2y$10$d0G3408aNFxJC08vzC6NnOu189xPl0geWlAWKL9PDwt9V2tFEQOmi', NULL, NULL, NULL),
(3, 'Carl', 'carl@gmail.com', 'operator', NULL, '$2y$10$2FtzuPIZkZeS3ACkSjFA5OiWDkVsdke.k8b94GYU8SXnGp5P.74Va', NULL, NULL, NULL),
(4, 'Dave', 'dave@gmail.com', 'operator', NULL, '$2y$10$MBo7zedXcvDXvq1GRcSn/.50PDEHbuqGW685Aqgm05I7UMTkQIWM6', NULL, NULL, NULL),
(5, 'Eli', 'eli@gmail.com', 'operator', NULL, '$2y$10$kYTPN7uS0z24iMBmo3RbAexgkU.VfSNi7qBUqHE.rhanB5nA1VM3.', NULL, NULL, NULL),
(6, 'Fin', 'fin@gmail.com', 'analyst', NULL, '$2y$10$4.sbI0OOZYj/MVJSB11t4ecX8bF1y7b/tRyZ1sFoH0fbfqOx.QkFO', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `license` varchar(255) CHARACTER SET latin1 NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `license`, `capacity`) VALUES
(1, 'DD8-392A', 40),
(2, 'DD8-392B', 40),
(3, 'DD8-392C', 40),
(4, 'DD8-392D', 60),
(5, 'DD8-392E', 60),
(6, 'DD8-392F', 60);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `analyst_id` (`analyst_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `start_stop_id` (`start_stop_id`),
  ADD KEY `end_stop_id` (`end_stop_id`);

--
-- Indexes for table `route_legs`
--
ALTER TABLE `route_legs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_id` (`route_id`),
  ADD KEY `start_stop_id` (`start_stop_id`),
  ADD KEY `end_stop_id` (`end_stop_id`);

--
-- Indexes for table `runs`
--
ALTER TABLE `runs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_id` (`route_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `operator_id` (`operator_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `stops`
--
ALTER TABLE `stops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `address` (`address`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `route_legs`
--
ALTER TABLE `route_legs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `runs`
--
ALTER TABLE `runs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stops`
--
ALTER TABLE `stops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1061;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`analyst_id`) REFERENCES `employees` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `routes_ibfk_1` FOREIGN KEY (`start_stop_id`) REFERENCES `stops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `routes_ibfk_2` FOREIGN KEY (`end_stop_id`) REFERENCES `stops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `route_legs`
--
ALTER TABLE `route_legs`
  ADD CONSTRAINT `route_legs_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `route_legs_ibfk_2` FOREIGN KEY (`start_stop_id`) REFERENCES `stops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `route_legs_ibfk_3` FOREIGN KEY (`end_stop_id`) REFERENCES `stops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `runs`
--
ALTER TABLE `runs`
  ADD CONSTRAINT `runs_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `runs_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `employees` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `runs_ibfk_3` FOREIGN KEY (`operator_id`) REFERENCES `employees` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `runs_ibfk_4` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
