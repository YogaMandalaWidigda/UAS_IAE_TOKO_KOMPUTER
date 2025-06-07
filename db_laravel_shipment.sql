-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2025 at 1:15 PM
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
-- Database: `db_laravel_shipment`
--
-- ...existing code...

CREATE DATABASE IF NOT EXISTS `db_laravel_shipment` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db_laravel_shipment`;

-- Tabel orders
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`order_id`, `order_number`, `created_at`, `updated_at`) VALUES
  (101, 'ORD20250530001', NOW(), NOW()),
  (102, 'ORD20250530002', NOW(), NOW()),
  (103, 'ORD20250530003', NOW(), NOW()),
  (104, 'ORD20250530004', NOW(), NOW()),
  (105, 'ORD20250530005', NOW(), NOW());

-- Tabel shipments
CREATE TABLE `shipments` (
  `shipment_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `carrier` varchar(255) NOT NULL,
  `estimated_delivery` datetime DEFAULT NULL,
  `actual_delivery` datetime DEFAULT NULL,
  `shipping_address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `shipments`
  ADD PRIMARY KEY (`shipment_id`),
  ADD UNIQUE KEY `shipments_tracking_number_unique` (`tracking_number`),
  ADD KEY `shipments_order_id_foreign` (`order_id`);

ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

ALTER TABLE `shipments`
  MODIFY `shipment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO `shipments`
  (`order_id`, `tracking_number`, `status`, `carrier`, `estimated_delivery`, `actual_delivery`, `shipping_address`, `created_at`, `updated_at`)
VALUES
  (101, 'TRK20250530001', 'pending', 'JNE', '2025-06-05 10:00:00', NULL, 'Jl. Merdeka No.1, Jakarta Pusat', '2025-05-30 08:00:00','2025-05-30 08:00:00'),
  (102, 'TRK20250530002', 'in_transit', 'TIKI', '2025-06-04 15:30:00', NULL, 'Jl. Sudirman No.45, Jakarta Selatan', '2025-05-30 09:15:00','2025-05-30 09:15:00'),
  (103, 'TRK20250530003', 'shipped', 'POS Indonesia', '2025-06-03 18:00:00', NULL, 'Jl. Thamrin No.88, Jakarta Pusat', '2025-05-30 10:20:00','2025-05-30 10:20:00'),
  (104, 'TRK20250530004', 'delivered', 'J&T Express', '2025-06-02 14:00:00', '2025-06-02 13:45:00', 'Jl. Kebon Sirih No.22, Jakarta Pusat', '2025-05-30 11:30:00','2025-05-30 11:30:00'),
  (105, 'TRK20250530005', 'pending', 'SiCepat', '2025-06-06 09:00:00', NULL, 'Jl. Gatot Subroto No.10, Jakarta Selatan', '2025-05-30 12:45:00','2025-05-30 12:45:00');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
