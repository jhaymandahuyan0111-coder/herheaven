-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2026 at 08:34 PM
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
-- Database: `hivestay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addon_services`
--

CREATE TABLE `addon_services` (
  `addon_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `monthly_fee` decimal(10,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action_type` varchar(100) NOT NULL,
  `table_affected` varchar(100) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `action_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `bed_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `bed_number` varchar(20) NOT NULL,
  `status` enum('Available','Occupied','Maintenance') DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lease_addons`
--

CREATE TABLE `lease_addons` (
  `lease_addon_id` int(11) NOT NULL,
  `lease_id` int(11) NOT NULL,
  `addon_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('Active','Cancelled') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lease_agreements`
--

CREATE TABLE `lease_agreements` (
  `lease_id` int(11) NOT NULL,
  `resident_id` int(11) NOT NULL,
  `bed_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `lease_status` enum('Pending','Active','Terminated') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `room_number` varchar(20) NOT NULL,
  `floor_number` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `base_rent` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_categories`
--

CREATE TABLE `room_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('Property Admin','Front Desk Staff','Resident') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'HiveStay Administrator', 'admin@hivestay.com', '$2y$10$Qx7QEWjhEqOKGC2TVnZ/UO3eiFhkj7i.kZ1nN8A6ccAX413kMhqA.', 'Property Admin', '2026-09-05 14:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `utility_bills`
--

CREATE TABLE `utility_bills` (
  `bill_id` int(11) NOT NULL,
  `lease_id` int(11) NOT NULL,
  `billing_period` date NOT NULL,
  `electric_share` decimal(10,2) DEFAULT 0.00,
  `water_share` decimal(10,2) DEFAULT 0.00,
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `payment_status` enum('Unpaid','Paid','Overdue') DEFAULT 'Unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addon_services`
--
ALTER TABLE `addon_services`
  ADD PRIMARY KEY (`addon_id`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_audit_user` (`user_id`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`bed_id`),
  ADD KEY `fk_bed_room` (`room_id`);

--
-- Indexes for table `lease_addons`
--
ALTER TABLE `lease_addons`
  ADD PRIMARY KEY (`lease_addon_id`),
  ADD KEY `fk_leaseaddon_lease` (`lease_id`),
  ADD KEY `fk_leaseaddon_addon` (`addon_id`);

--
-- Indexes for table `lease_agreements`
--
ALTER TABLE `lease_agreements`
  ADD PRIMARY KEY (`lease_id`),
  ADD KEY `fk_lease_resident` (`resident_id`),
  ADD KEY `fk_lease_bed` (`bed_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `room_number` (`room_number`),
  ADD KEY `fk_room_category` (`category_id`);

--
-- Indexes for table `room_categories`
--
ALTER TABLE `room_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `fk_category_parent` (`parent_category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `utility_bills`
--
ALTER TABLE `utility_bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `fk_bill_lease` (`lease_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addon_services`
--
ALTER TABLE `addon_services`
  MODIFY `addon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `bed_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lease_addons`
--
ALTER TABLE `lease_addons`
  MODIFY `lease_addon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lease_agreements`
--
ALTER TABLE `lease_agreements`
  MODIFY `lease_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_categories`
--
ALTER TABLE `room_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `utility_bills`
--
ALTER TABLE `utility_bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `fk_audit_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `fk_bed_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lease_addons`
--
ALTER TABLE `lease_addons`
  ADD CONSTRAINT `fk_leaseaddon_addon` FOREIGN KEY (`addon_id`) REFERENCES `addon_services` (`addon_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_leaseaddon_lease` FOREIGN KEY (`lease_id`) REFERENCES `lease_agreements` (`lease_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lease_agreements`
--
ALTER TABLE `lease_agreements`
  ADD CONSTRAINT `fk_lease_bed` FOREIGN KEY (`bed_id`) REFERENCES `beds` (`bed_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lease_resident` FOREIGN KEY (`resident_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_room_category` FOREIGN KEY (`category_id`) REFERENCES `room_categories` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `room_categories`
--
ALTER TABLE `room_categories`
  ADD CONSTRAINT `fk_category_parent` FOREIGN KEY (`parent_category_id`) REFERENCES `room_categories` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `utility_bills`
--
ALTER TABLE `utility_bills`
  ADD CONSTRAINT `fk_bill_lease` FOREIGN KEY (`lease_id`) REFERENCES `lease_agreements` (`lease_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
