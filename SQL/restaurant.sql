-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2021 at 11:28 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `items_attr_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `rate` int(255) NOT NULL,
  `total` int(11) NOT NULL,
  `discount_val` int(11) NOT NULL,
  `discount_type` varchar(255) NOT NULL,
  `discount` int(11) NOT NULL,
  `discount_total` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `flavor` varchar(255) NOT NULL,
  `order_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_category_id` int(11) NOT NULL,
  `is_home` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `parent_category_id`, `is_home`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Burger', 'burger', 0, 1, 1, '2021-08-23 12:11:55', '2021-09-05 02:53:32'),
(2, 'Pizza', 'pizza', 0, 1, 1, '2021-08-23 12:12:16', '2021-08-23 12:12:16'),
(3, 'Soup', 'soup', 0, 1, 1, '2021-08-23 12:12:43', '2021-08-23 12:12:43'),
(4, 'Rice', 'rice', 0, 1, 1, '2021-08-23 12:12:58', '2021-08-23 12:13:24'),
(5, 'Wings', 'wings', 0, 1, 1, '2021-08-23 12:13:16', '2021-08-23 12:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `collect_orders`
--

CREATE TABLE `collect_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `discount_total` int(11) NOT NULL,
  `payable_amount` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collect_orders_attr`
--

CREATE TABLE `collect_orders_attr` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `items_attr_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `discount_val` int(11) NOT NULL,
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `discount_total` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `flavor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `counter_logins`
--

CREATE TABLE `counter_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `counter_logins`
--

INSERT INTO `counter_logins` (`id`, `username`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$u0N3KMLLWsitOPvXxuwZtOowS8KsSi5ZWpLBPiJhww4mfBwI5s/h2', '1', NULL, '2021-07-26 16:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('value','per') COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_ord_amt` int(11) NOT NULL,
  `is_one_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `slug`, `category_id`, `image`, `component`, `notes`, `desc`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Chicken Burger', 'ChickenBurger', '1', '1631090517.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, '2021-09-08 02:41:58', '2021-09-08 02:41:58'),
(2, 'Beef Burger', 'BeefBurger', '1', '1631090695.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, '2021-09-08 02:44:55', '2021-09-08 02:44:55'),
(3, 'LikeMeat Pizza', 'LikeMeatPizza', '2', '1631090926.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, '2021-09-08 02:48:46', '2021-09-08 02:48:46'),
(4, 'Sicilian Pizza', 'SicilianPizza', '2', '1631091072.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, '2021-09-08 02:51:12', '2021-09-08 02:51:12'),
(5, 'Shrimp Fried Rice', 'ShrimpFriedRice', '4', '1631091221.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, '2021-09-08 02:53:41', '2021-09-08 02:53:41'),
(6, 'Chicken Fried Rice', 'ChickenFriedRice', '4', '1631091269.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, '2021-09-08 02:54:29', '2021-09-08 02:54:29');

-- --------------------------------------------------------

--
-- Table structure for table `items_attr`
--

CREATE TABLE `items_attr` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `discount` int(11) NOT NULL,
  `discount_type` varchar(255) NOT NULL,
  `size_id` int(11) DEFAULT NULL,
  `attr_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items_attr`
--

INSERT INTO `items_attr` (`id`, `item_id`, `sku`, `price`, `type_id`, `discount`, `discount_type`, `size_id`, `attr_image`) VALUES
(1, 1, 'BURGER001', 320, 1, 20, 'val', 1, '1631090518654577929.jpg'),
(2, 1, 'BURGER002', 300, 1, 10, 'per', 1, '1631090518966196869.jpg'),
(3, 1, 'BURGER003', 280, 1, 0, 'val', 1, '1631090518320542797.jpg'),
(4, 2, 'BURGER004', 450, 1, 50, 'val', 1, '1631090695280228453.jpg'),
(5, 3, 'PIZZA001', 450, 1, 0, 'val', 2, '1631090926254766357.jpg'),
(6, 3, 'PIZZA002', 500, 1, 0, 'val', 3, '1631090926281404265.jpg'),
(7, 3, 'PIZZA003', 550, 1, 10, 'val', 5, '1631090926834515833.jpg'),
(8, 4, 'PIZZA004', 600, 1, 5, 'per', 5, '1631091073315099137.jpg'),
(9, 5, 'RICE001', 180, 1, 0, 'val', 1, '1631091221393249845.jpg'),
(10, 6, 'RICE002', 240, 1, 20, 'val', 1, '1631091269486984177.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kitchen_logins`
--

CREATE TABLE `kitchen_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kitchen_logins`
--

INSERT INTO `kitchen_logins` (`id`, `username`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '1234', '1', '2021-09-06 09:42:37', '2021-09-06 09:42:37');

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
(1, '2021_07_26_210316_create_counter_logins_table', 1),
(2, '2021_07_26_222412_create_categories_table', 2),
(3, '2021_08_01_052117_create_vats_table', 3),
(4, '2021_07_26_222436_create_items_table', 4),
(5, '2021_08_06_061306_create_types_table', 5),
(6, '2021_08_06_073921_create_sizes_table', 6),
(7, '2021_08_25_105702_create_total_tables_table', 7),
(8, '2021_08_25_122137_create_coupons_table', 8),
(10, '2021_08_01_083027_create_collect_orders_table', 9),
(11, '2021_09_06_085648_create_kitchen_logins_table', 10),
(12, '2021_09_07_074021_create_total_waiters_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Regular', 1, '2021-08-23 12:14:18', '2021-08-23 12:14:18'),
(2, 'Small', 1, '2021-08-23 12:14:58', '2021-08-23 12:14:58'),
(3, 'Medium', 1, '2021-08-23 12:15:06', '2021-08-23 12:15:06'),
(4, 'Semi Large', 1, '2021-08-23 12:15:44', '2021-08-23 12:15:44'),
(5, 'Large', 1, '2021-08-23 12:15:54', '2021-09-04 06:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `total_tables`
--

CREATE TABLE `total_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_no` int(11) NOT NULL,
  `table_users` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `total_tables`
--

INSERT INTO `total_tables` (`id`, `table_no`, `table_users`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'table1', '1234', 1, '2021-09-08 01:19:35', '2021-09-08 01:19:35'),
(2, 2, 'table2', '1234', 1, '2021-09-08 01:19:50', '2021-09-08 01:19:58'),
(3, 3, 'table3', '1234', 1, '2021-09-08 01:20:39', '2021-09-08 01:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `total_waiters`
--

CREATE TABLE `total_waiters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `total_waiters`
--

INSERT INTO `total_waiters` (`id`, `name`, `table_id`, `username`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, 'admin', '1234', 1, '2021-09-08 01:22:56', '2021-09-08 01:22:56'),
(2, 'admin2', 2, 'admin2', '1234', 1, '2021-09-08 01:23:20', '2021-09-08 01:52:02'),
(3, 'admin3', 3, 'admin3', '1234', 1, '2021-09-08 01:52:55', '2021-09-08 01:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_home` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `type_name`, `is_home`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Regular', 1, 1, '2021-08-23 12:16:05', '2021-08-23 12:16:05'),
(2, 'Offered', 1, 1, '2021-08-23 12:16:11', '2021-08-23 12:16:11'),
(3, 'Special', 1, 1, '2021-08-23 12:16:21', '2021-08-23 12:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `vats`
--

CREATE TABLE `vats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vat_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vats`
--

INSERT INTO `vats` (`id`, `vat_desc`, `vat_value`, `status`, `created_at`, `updated_at`) VALUES
(1, '15% VAT+TAX', '15', 1, '2021-08-23 12:32:57', '2021-08-23 12:33:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collect_orders`
--
ALTER TABLE `collect_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collect_orders_attr`
--
ALTER TABLE `collect_orders_attr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counter_logins`
--
ALTER TABLE `counter_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_attr`
--
ALTER TABLE `items_attr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kitchen_logins`
--
ALTER TABLE `kitchen_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_tables`
--
ALTER TABLE `total_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_waiters`
--
ALTER TABLE `total_waiters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vats`
--
ALTER TABLE `vats`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `collect_orders`
--
ALTER TABLE `collect_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collect_orders_attr`
--
ALTER TABLE `collect_orders_attr`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counter_logins`
--
ALTER TABLE `counter_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `items_attr`
--
ALTER TABLE `items_attr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kitchen_logins`
--
ALTER TABLE `kitchen_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `total_tables`
--
ALTER TABLE `total_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `total_waiters`
--
ALTER TABLE `total_waiters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vats`
--
ALTER TABLE `vats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
