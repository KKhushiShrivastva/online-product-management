-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 12:26 PM
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
-- Database: `product_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` varchar(255) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `stock` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `product_image`, `stock`, `created_at`, `updated_at`) VALUES
(2, 'TV', 'For enterainment', '12000', '1721557379.jpg', '5', '2024-07-16 13:05:20', '2024-07-21 04:52:59'),
(4, 'Sofa', 'Solatio Sofa - Three Seater', '80000', '1721557440.avif', '8', '2024-07-18 23:29:26', '2024-07-21 04:54:00'),
(5, 'Camera', 'Camera', '5500', '1721557326.jpg', '7', '2024-07-19 14:14:35', '2024-07-21 04:52:06'),
(10, 'Fridge', 'Fridge - 3 BLOCK', '900', NULL, '88', '2024-07-20 10:50:39', '2024-07-20 11:40:49'),
(13, 'home decor', 'home decor', '333', '1721551907.jpg', '33', '2024-07-21 03:21:47', '2024-07-21 04:51:22'),
(16, 'AC', 'AIR CONDITION', '33000', '1721557254.jpg', '6', '2024-07-21 04:50:54', '2024-07-21 04:50:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
