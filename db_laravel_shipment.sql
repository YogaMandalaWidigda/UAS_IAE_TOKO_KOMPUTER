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
CREATE DATABASE IF NOT EXISTS `db_laravel_shipment`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE `db_laravel_shipment`;

-- --------------------------------------------------------

-- Tabel `orders`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_number` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  AUTO_INCREMENT=5;

INSERT INTO `orders` (`order_id`, `order_number`, `created_at`, `updated_at`) VALUES
  (1, 'ORD20250530001', NOW(), NOW()),
  (2, 'ORD20250530002', NOW(), NOW()),
  (3, 'ORD20250530003', NOW(), NOW()),
  (4, 'ORD20250530004', NOW(), NOW());

-- --------------------------------------------------------

-- Tabel `shipments`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `shipments` (
  `shipment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `carrier` varchar(255) NOT NULL,
  `estimated_delivery` datetime DEFAULT NULL,
  `shipping_address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`shipment_id`),
  KEY `shipments_order_id_foreign` (`order_id`),
  CONSTRAINT `shipments_order_id_foreign`
    FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  AUTO_INCREMENT=5;

INSERT INTO `shipments`
  (`order_id`, `status`, `carrier`, `estimated_delivery`, `shipping_address`, `created_at`, `updated_at`)
VALUES
  (1, 'pending',     'JNE',           '2025-06-05 10:00:00', 'Jl. Merdeka No.1, Jakarta Pusat',    '2025-05-30 08:00:00', '2025-05-30 08:00:00'),
  (2, 'in_transit',  'TIKI',          '2025-06-04 15:30:00', 'Jl. Sudirman No.45, Jakarta Selatan', '2025-05-30 09:15:00', '2025-05-30 09:15:00'),
  (3, 'shipped',     'POS Indonesia', '2025-06-03 18:00:00', 'Jl. Thamrin No.88, Jakarta Pusat',    '2025-05-30 10:20:00', '2025-05-30 10:20:00'),
  (4, 'delivered',   'J&T Express',   '2025-06-02 14:00:00', 'Jl. Kebon Sirih No.22, Jakarta Pusat','2025-05-30 11:30:00', '2025-05-30 11:30:00');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
