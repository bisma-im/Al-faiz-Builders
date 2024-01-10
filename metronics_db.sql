-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 06:08 PM
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
-- Database: `metronics_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `phone_number` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `phone_number`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123', 3402317765);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `SKU` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `status` varchar(15) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `SKU`, `quantity`, `price`, `status`, `image`) VALUES
(1, 'HeadPhones', 12345, 12, 100, 'Published', 'N/A'),
(2, 'Mouse', 223344, 13, 20, 'Published', 'N/A'),
(3, 'Fan', 445566, 10, 500, 'Draft', 'N/A'),
(4, 'Hoodie', 19087, 20, 50, 'Deleted', 'N/A'),
(5, 'Airpods', 45678, 5, 150, 'Published', 'N/A'),
(6, 'Bag', 55712, 5, 70, 'Draft', 'N/A'),
(7, 'Mug', 47836, 50, 10, 'Published', 'N/A'),
(8, 'Table', 123456, 2, 700, 'Draft', 'N/A'),
(9, 'Necklace', 123453, 12, 20, 'Published', 'N/A'),
(10, 'Jeans', 2233442, 50, 50, 'Draft', 'N/A'),
(11, 'Stickers', 1908777, 100, 5, 'Published', 'N/A'),
(12, 'Socks', 4567812, 50, 15, 'Published', 'N/A'),
(13, 'Bottle', 987, 10, 30, 'scheduled', 'N/A'),
(14, 'Notebook', 98792, 10, 18, 'inactive', 'N/A'),
(15, 'Notebook', 123, 1, 12, 'published', 'N/A'),
(16, 'Notebook', 123, 1, 12, 'published', 'N/A'),
(17, 'Bottle', 123, 1, 12, 'published', 'N/A'),
(18, 'A', 123, 1, 30, 'published', 'N/A'),
(19, 'A', 123, 1, 30, 'published', 'N/A'),
(20, 'A', 123, 1, 30, 'published', 'N/A'),
(21, 'A', 123, 1, 30, 'published', 'N/A'),
(22, 'A', 123, 1, 30, 'published', 'N/A'),
(23, 'A', 123, 1, 30, 'published', 'N/A'),
(24, 'A', 123, 1, 30, 'published', 'N/A'),
(25, 'Keyboard', 12345, 11, 100, 'published', 'N/A'),
(26, 'Keyboard', 12345, 11, 100, 'published', 'N/A'),
(27, 'Keyboard', 12345, 11, 100, 'published', 'N/A'),
(28, 'Keyboard', 12345, 11, 100, 'published', 'N/A'),
(29, 'Keyboardsss', 12345, 11, 100, 'published', 'N/A'),
(30, 'Keyboardsss', 12345, 11, 100, 'published', 'N/A'),
(31, 'teabag', 1234567, 2, 12, 'published', 'N/A'),
(32, 'teabagss', 9, 1, 13, 'published', 'N/A'),
(33, 'Ball', 10, 50, 20, 'published', 'N/A'),
(34, 'Ball', 10, 50, 20, 'published', 'N/A'),
(35, 'Ball', 10, 50, 20, 'published', '1.png'),
(36, 'Ball', 10, 5, 20, 'published', 'N/A'),
(37, 'Ball', 9, 5, 20, 'published', 'N/A'),
(38, 'Ball', 10, 5, 20, 'published', 'N/A'),
(39, 'Ball', 9, 1, 20, 'published', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(5) NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'marketing'),
(3, 'recovery'),
(4, 'dealer'),
(5, 'accounts');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `mobile_no` int(20) NOT NULL,
  `user_image` text NOT NULL,
  `user_access_level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `username`, `email`, `password`, `mobile_no`, `user_image`, `user_access_level`) VALUES
(1, 'admin one', 'adminone', 'admin@gmail.com', 'admin123', 1234456, 'default.jpg', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
