-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 12:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jewellery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(2) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'prachi', '123456'),
(0, '', '123456'),
(1, 'prachi', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `jewellerys`
--

CREATE TABLE `jewellerys` (
  `Id` int(2) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_price` int(20) NOT NULL,
  `image` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jewellerys`
--

INSERT INTO `jewellerys` (`Id`, `product_name`, `product_price`, `image`) VALUES
(6, 'gold necklance', 2500, 0x75706c6f6164732f70312e706e67),
(7, 'gold chain necklance', 3500, 0x75706c6f6164732f70322e706e67),
(8, 'necklance', 3000, 0x75706c6f6164732f70332e706e67),
(9, 'ring', 1800, 0x75706c6f6164732f70342e706e67),
(10, 'diamond ring', 4000, 0x75706c6f6164732f70352e706e67),
(11, 'earnings', 1500, 0x75706c6f6164732f70362e706e67),
(12, 'earnings', 1500, 0x75706c6f6164732f70372e706e67),
(13, 'heart necklance', 2000, 0x75706c6f6164732f70382e706e67),
(14, 'pendal', 80000, 0x75706c6f6164732f6f322e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price_per_item` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_name`, `price_per_item`, `quantity`, `total`, `payment_method`, `created_at`) VALUES
(2, 'Gold Necklace', 3000.00, 1, 3000.00, 'Cash on Delivery', '2025-04-25 08:09:16'),
(3, 'Gold Necklace', 3000.00, 1, 3000.00, 'Cash on Delivery', '2025-04-25 08:09:21'),
(4, 'Gold Necklace', 3000.00, 1, 3000.00, 'Cash on Delivery', '2025-04-25 08:09:56'),
(5, 'pendal', 80000.00, 1, 80000.00, 'Cash on Delivery', '2025-04-25 08:23:13'),
(8, 'Gold Necklace', 3000.00, 4, 12000.00, 'Cash on Delivery', '2025-04-25 10:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price_per_item` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price_per_item`, `quantity`, `total_price`, `created_at`) VALUES
(1, 'Gold Necklace', 3000, 4, 12000, '2025-04-25 10:03:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(2) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(6) NOT NULL,
  `confirm password` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `confirm password`) VALUES
(1, 'prachi', 'py@gmail.com', '123456', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jewellerys`
--
ALTER TABLE `jewellerys`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jewellerys`
--
ALTER TABLE `jewellerys`
  MODIFY `Id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
