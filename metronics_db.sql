-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 06:37 PM
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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `account_head_id` int(11) NOT NULL,
  `account_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_head_id`, `account_title`) VALUES
(1, 2, 'accounts payable'),
(2, 1, 'accounts receivable');

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
-- Table structure for table `call_logs`
--

CREATE TABLE `call_logs` (
  `id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `date_of_call` date NOT NULL,
  `time_of_call` time NOT NULL,
  `customer_response` text NOT NULL,
  `next_call_date` date DEFAULT NULL,
  `next_call_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `call_logs`
--

INSERT INTO `call_logs` (`id`, `lead_id`, `date_of_call`, `time_of_call`, `customer_response`, `next_call_date`, `next_call_time`) VALUES
(1, 3, '2024-01-10', '12:00:00', 'dcbHCDBAHD', '2024-01-10', '12:00:00'),
(2, 3, '2024-01-12', '09:00:00', 'dcbHCDBAHD', '2024-01-11', '14:00:00'),
(3, 3, '2024-01-12', '09:00:00', 'dcbHCDBAHD', '2024-01-11', '14:00:00'),
(4, 3, '2024-01-03', '14:00:00', 'fvsdvgsf', '2024-01-05', '12:00:00'),
(5, 3, '2024-01-20', '12:00:00', 'dvadvadV', '2024-01-25', '12:00:00'),
(6, 3, '2024-01-24', '12:00:00', 'cascavc', '2024-01-25', '12:00:00'),
(7, 3, '2024-01-10', '12:00:00', 'vsvb bfd', '2024-01-31', '16:00:00'),
(8, 3, '2024-01-11', '12:00:00', 'vszv szd v', '2024-01-18', '12:00:00'),
(9, 3, '2024-01-17', '12:00:00', 'v sdv sdv', '2024-02-01', '12:00:00'),
(10, 3, '2024-01-03', '12:00:00', 'vbfgnfh n', '2024-01-26', '12:00:00'),
(11, 3, '2024-01-13', '12:00:00', 'vdx vsf b', '2024-02-09', '12:00:00'),
(12, 4, '2024-02-02', '12:00:00', 'njnjnjk', '2024-02-05', '12:00:00'),
(13, 3, '2024-01-13', '12:00:00', 'ffcvvsfb', '2024-02-03', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_image` text DEFAULT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `area` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `country` text DEFAULT NULL,
  `mobile_number_1` varchar(20) NOT NULL,
  `mobile_number_2` varchar(20) DEFAULT NULL,
  `landline_number` varchar(20) DEFAULT NULL,
  `office_phone` varchar(20) DEFAULT NULL,
  `cnic_number` varchar(20) NOT NULL,
  `next_of_kin_name` text DEFAULT NULL,
  `next_of_kin_relation` text DEFAULT NULL,
  `next_of_kin_address` text DEFAULT NULL,
  `next_of_kin_area` text DEFAULT NULL,
  `next_of_kin_city` text DEFAULT NULL,
  `next_of_kin_country` text DEFAULT NULL,
  `next_of_kin_mobile_number_1` varchar(20) DEFAULT NULL,
  `next_of_kin_mobile_number_2` varchar(20) DEFAULT NULL,
  `next_of_kin_landline_number` varchar(20) DEFAULT NULL,
  `next_of_kin_cnic` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_image`, `name`, `address`, `area`, `city`, `country`, `mobile_number_1`, `mobile_number_2`, `landline_number`, `office_phone`, `cnic_number`, `next_of_kin_name`, `next_of_kin_relation`, `next_of_kin_address`, `next_of_kin_area`, `next_of_kin_city`, `next_of_kin_country`, `next_of_kin_mobile_number_1`, `next_of_kin_mobile_number_2`, `next_of_kin_landline_number`, `next_of_kin_cnic`) VALUES
(4, '1706826833.png', 'Shahrukh Ghaffar', 'Esolace Tech Office 4541 182-184 High Street North', NULL, 'East Ham', 'Pakistan', '+922032394343', NULL, NULL, NULL, '151514511', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'default.jpg', 'musadiq mustafa', 'gulshan e iqbal', NULL, 'karachi', 'Pakistan', '02032394343', NULL, NULL, NULL, '15165161', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '1706826888.png', 'bisma imran', 'Esolace Tech Office 4541 182-184 High Street North', NULL, 'Eastham', 'United Kingdom', '02032394343', NULL, NULL, NULL, '15154131', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `plot_id` int(11) NOT NULL,
  `invoice_date` date DEFAULT NULL,
  `invoice_time` time DEFAULT NULL,
  `created_by` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `total_amount` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `customer_id`, `project_id`, `plot_id`, `invoice_date`, `invoice_time`, `created_by`, `description`, `total_amount`) VALUES
(1, 4, 15, 12, '2024-02-07', '17:00:00', 'bvvjbh', 'j k  kbkbuib', 15615);

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mobile_number_1` varchar(20) NOT NULL,
  `mobile_number_2` varchar(20) DEFAULT NULL,
  `landline_number_1` varchar(20) DEFAULT NULL,
  `landline_number_2` varchar(20) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `source_of_information` varchar(50) NOT NULL,
  `details` text DEFAULT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `name`, `mobile_number_1`, `mobile_number_2`, `landline_number_1`, `landline_number_2`, `email`, `source_of_information`, `details`, `username`) VALUES
(3, 'bisma imran', '027384734', NULL, NULL, NULL, NULL, 'tv', NULL, 'bismaim'),
(4, 'Shahrukh Ghaffar', '02032394343', NULL, NULL, NULL, 'business.esolacetech@gmail.com', 'pamphlet', NULL, ''),
(5, 'Shahrukh Ghaffar', '02032394343', NULL, NULL, NULL, 'business.esolace@gmail.com', 'pamphlet', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `main_account_heads`
--

CREATE TABLE `main_account_heads` (
  `id` int(11) NOT NULL,
  `account_head_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_account_heads`
--

INSERT INTO `main_account_heads` (`id`, `account_head_name`) VALUES
(1, 'Assets'),
(2, 'Liabilities'),
(3, 'Revenue'),
(4, 'Expenses'),
(5, 'Equity');

-- --------------------------------------------------------

--
-- Table structure for table `plots_inventory`
--

CREATE TABLE `plots_inventory` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `plot_no` varchar(10) NOT NULL,
  `plot_size` int(11) DEFAULT NULL,
  `plot_attribute_1` int(11) DEFAULT NULL,
  `plot_attribute_2` int(11) DEFAULT NULL,
  `plot_attribute_3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plots_inventory`
--

INSERT INTO `plots_inventory` (`id`, `project_id`, `plot_no`, `plot_size`, `plot_attribute_1`, `plot_attribute_2`, `plot_attribute_3`) VALUES
(11, 15, 'B1', NULL, NULL, NULL, NULL),
(12, 15, 'B2', NULL, NULL, NULL, NULL),
(13, 15, 'B3', NULL, NULL, NULL, NULL),
(14, 15, 'B4', NULL, NULL, NULL, NULL),
(15, 15, 'B5', NULL, NULL, NULL, NULL),
(16, 16, 'C1', NULL, NULL, NULL, NULL),
(17, 16, 'C2', NULL, NULL, NULL, NULL),
(18, 16, 'C3', NULL, NULL, NULL, NULL);

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
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_title` varchar(200) NOT NULL,
  `project_description` text DEFAULT NULL,
  `project_phase` varchar(5) NOT NULL,
  `project_logo` text NOT NULL,
  `project_area` int(11) NOT NULL,
  `project_cost` int(11) NOT NULL,
  `no_of_plots` int(11) NOT NULL,
  `plot_prefix` varchar(5) NOT NULL,
  `down_payment` decimal(10,0) NOT NULL,
  `development_charges` decimal(10,0) NOT NULL,
  `extra_charges` decimal(10,0) NOT NULL,
  `monthly_installment` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_title`, `project_description`, `project_phase`, `project_logo`, `project_area`, `project_cost`, `no_of_plots`, `plot_prefix`, `down_payment`, `development_charges`, `extra_charges`, `monthly_installment`) VALUES
(15, 'Saima Residency', NULL, 'B', '1706826703.png', 23454, 25475565, 5, 'B', 12233, 323, 333, 111111),
(16, 'Ali Residency', NULL, 'C', '1706826787.png', 14515, 1512135151, 3, 'C', 21551, 11, 44, 44);

-- --------------------------------------------------------

--
-- Table structure for table `project_media`
--

CREATE TABLE `project_media` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `media_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 'sales'),
(3, 'recovery'),
(4, 'dealer'),
(5, 'accounts'),
(6, 'marketing');

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
  `mobile_no` varchar(20) NOT NULL,
  `user_image` text NOT NULL,
  `user_access_level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `username`, `email`, `password`, `mobile_no`, `user_image`, `user_access_level`) VALUES
(1, 'admin one', 'adminone', 'admin@gmail.com', 'admin123@', '1234456', 'default.jpg', 'admin'),
(18, 'Bisma Imran', 'bismaim', 'bisma@gmail.com', 'bis123', '13746234', '1706889346.png', 'sales');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_head_id` (`account_head_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_id` (`lead_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnic_number` (`cnic_number`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_account_heads`
--
ALTER TABLE `main_account_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plots_inventory`
--
ALTER TABLE `plots_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_media`
--
ALTER TABLE `project_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING HASH,
  ADD UNIQUE KEY `email` (`email`,`mobile_no`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `call_logs`
--
ALTER TABLE `call_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `main_account_heads`
--
ALTER TABLE `main_account_heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plots_inventory`
--
ALTER TABLE `plots_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `project_media`
--
ALTER TABLE `project_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`account_head_id`) REFERENCES `main_account_heads` (`id`);

--
-- Constraints for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD CONSTRAINT `call_logs_ibfk_1` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`);

--
-- Constraints for table `plots_inventory`
--
ALTER TABLE `plots_inventory`
  ADD CONSTRAINT `plots_inventory_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `project_media`
--
ALTER TABLE `project_media`
  ADD CONSTRAINT `project_media_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
