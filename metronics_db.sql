-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2024 at 11:35 AM
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
(2, 1, 'accounts receivable'),
(3, 2, 'arrears'),
(4, 2, 'accruals'),
(5, 5, 'stocks');

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
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `plot_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `unit_cost` decimal(10,0) NOT NULL,
  `extra_charges` decimal(10,0) NOT NULL,
  `development_charges` decimal(10,0) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `token_amount` decimal(10,0) NOT NULL,
  `advance_amount` decimal(10,0) NOT NULL,
  `isLocked` int(1) NOT NULL DEFAULT 1,
  `username` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `phase_id` int(11) NOT NULL,
  `payment_plan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `project_id`, `plot_id`, `customer_id`, `unit_cost`, `extra_charges`, `development_charges`, `total_amount`, `token_amount`, `advance_amount`, `isLocked`, `username`, `created_on`, `phase_id`, `payment_plan`) VALUES
(3, 25, 79, 40, 123312, 231231, 12332, 2312323, 23123, 23123, 1, 'admin', '2024-02-22 00:59:02', 10, 'installment');

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
(13, 3, '2024-01-13', '12:00:00', 'ffcvvsfb', '2024-02-03', '12:00:00'),
(14, 6, '2024-02-15', '09:00:00', 'afasgsdg', '2024-02-24', '12:00:00'),
(15, 3, '2024-02-13', '09:00:00', 'ffsafdf', '2024-02-14', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `id` int(11) NOT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(6, '1706826888.png', 'bisma imran', 'Esolace Tech Office 4541 182-184 High Street North', NULL, 'Eastham', 'United Kingdom', '02032394343', NULL, NULL, NULL, '15154131', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, 'Bisma Imran', 'ahgfhdjh', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '24264534', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '1707488523.png', 'ali', 'ahgfhdjh', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '32435624679', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '1707502260.png', 'Bisma Imran', 'ahgfhdjh', NULL, NULL, NULL, '12445', NULL, NULL, NULL, '32435624679141242', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '1707503410.png', 'afdfsa', 'sFGFGf', NULL, NULL, NULL, '143423', NULL, NULL, NULL, '21434', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '1707747864.PNG', 'asfdfafd', 'affaf', NULL, NULL, NULL, '234423', NULL, NULL, NULL, '123124', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '1707747965.png', 'asfdfafd', 'affaf', NULL, NULL, NULL, '234423', NULL, NULL, NULL, '12312456334', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '1707750227.png', 'Bisma Imran', 'ahgfhdjh', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '2426453478', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '1707750257.png', 'Bisma Imran', 'ahgfhdjh', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '242645347834', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'default.jpg', 'Bisma Imran Kan', 'Nazimabad', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '5545454545', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, '1708563542.png', 'Ahmed', 'ahgfhdjh', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '24264534432', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dealer_commission`
--

CREATE TABLE `dealer_commission` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `percentage` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `comission_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `plot_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `due_date` date NOT NULL,
  `installment_status` varchar(50) NOT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `intimation_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `installment`
--

INSERT INTO `installment` (`id`, `booking_id`, `project_id`, `phase_id`, `plot_id`, `customer_id`, `amount`, `due_date`, `installment_status`, `payment_mode`, `intimation_date`, `created_at`, `updated_at`) VALUES
(1, 3, 25, 10, 79, 40, 462465, '2024-02-22', 'paid', 'cash', '2024-02-27', '2024-02-22 00:59:02', '2024-02-22 00:59:02'),
(2, 3, 25, 10, 79, 40, 462465, '2024-03-22', 'pending', 'cash', '2024-03-27', '2024-02-22 00:59:02', '2024-02-22 00:59:02'),
(3, 3, 25, 10, 79, 40, 462465, '2024-04-22', 'pending', 'cash', '2024-04-27', '2024-02-22 00:59:02', '2024-02-22 00:59:02'),
(4, 3, 25, 10, 79, 40, 462465, '2024-05-22', 'pending', 'cash', '2024-05-27', '2024-02-22 00:59:02', '2024-02-22 00:59:02'),
(5, 3, 25, 10, 79, 40, 462465, '2024-06-22', 'pending', 'cash', '2024-06-27', '2024-02-22 00:59:02', '2024-02-22 00:59:02');

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
(5, 'Shahrukh Ghaffar', '02032394343', NULL, NULL, NULL, 'business.esolace@gmail.com', 'pamphlet', NULL, ''),
(6, 'Bisma Imran 1', '2141243', NULL, NULL, NULL, 'bismaimran1@gmail.com', 'pamphlet', NULL, 'huzaifa'),
(7, 'Bisma Imran 1', '2141243', NULL, NULL, NULL, 'bisma@gmail.com', 'pamphlet', NULL, 'huzaifa'),
(8, 'Bisma Imran 1', '2141243', NULL, NULL, NULL, 'bisma1@gmail.com', 'word_of_mouth', NULL, 'huzaifa'),
(9, 'Bisma Imran 2', '2355', NULL, NULL, NULL, 'bisma2@gmail.com', 'word_of_mouth', NULL, 'huzaifa'),
(10, 'Bisma Imran 3', 'q343552', NULL, NULL, NULL, 'bisma3@gmail.com', 'pamphlet', NULL, 'huzaifa');

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
-- Table structure for table `phase`
--

CREATE TABLE `phase` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `phase_title` text NOT NULL,
  `phase_logo` text NOT NULL,
  `phase_area` decimal(10,0) NOT NULL,
  `phase_cost` decimal(10,0) NOT NULL,
  `down_payment` decimal(10,0) NOT NULL,
  `development_charges` decimal(10,0) NOT NULL,
  `extra_charges` decimal(10,0) NOT NULL,
  `monthly_installment` decimal(10,0) NOT NULL,
  `completion_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phase`
--

INSERT INTO `phase` (`id`, `project_id`, `phase_title`, `phase_logo`, `phase_area`, `phase_cost`, `down_payment`, `development_charges`, `extra_charges`, `monthly_installment`, `completion_date`) VALUES
(10, 25, 'Phase 1', '1708531149.png', 534345, 423423, 5345534, 453345345, 345453, 345534, '2026-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `phase_media`
--

CREATE TABLE `phase_media` (
  `id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `media_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phase_media`
--

INSERT INTO `phase_media` (`id`, `phase_id`, `media_name`) VALUES
(6, 10, '1708531149_Clearance Certificate.docx');

-- --------------------------------------------------------

--
-- Table structure for table `plots_inventory`
--

CREATE TABLE `plots_inventory` (
  `id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `plot_no` varchar(10) NOT NULL,
  `plot_size` int(11) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `plot_attribute_2` int(11) DEFAULT NULL,
  `plot_attribute_3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plots_inventory`
--

INSERT INTO `plots_inventory` (`id`, `phase_id`, `project_id`, `plot_no`, `plot_size`, `category`, `amount`, `plot_attribute_2`, `plot_attribute_3`) VALUES
(79, 10, 25, 'BR801', NULL, '80 Sq. Yds.', 1000000, NULL, NULL),
(80, 10, 25, 'BR1001', NULL, '100 Sq. Yds.', 1500000, NULL, NULL),
(81, 10, 25, 'BR1002', NULL, '100 Sq. Yds.', 1500000, NULL, NULL),
(82, 10, 25, 'BR1201', NULL, '120 Sq. Yds.', 2000000, NULL, NULL),
(83, 10, 25, 'BR1202', NULL, '120 Sq. Yds.', 2000000, NULL, NULL),
(84, 10, 25, 'BR1203', NULL, '120 Sq. Yds.', 2000000, NULL, NULL),
(85, 10, 25, 'BR2001', NULL, '200 Sq. Yds.', 4000000, NULL, NULL),
(86, 10, 25, 'BR2002', NULL, '200 Sq. Yds.', 4000000, NULL, NULL),
(87, 10, 25, 'BR2003', NULL, '200 Sq. Yds.', 4000000, NULL, NULL),
(88, 10, 25, 'BR2004', NULL, '200 Sq. Yds.', 4000000, NULL, NULL);

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
  `project_title` varchar(255) NOT NULL,
  `project_description` text DEFAULT NULL,
  `project_logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_title`, `project_description`, `project_logo`) VALUES
(25, 'Bisma Residency', NULL, '1708530359.png');

-- --------------------------------------------------------

--
-- Table structure for table `project_media`
--

CREATE TABLE `project_media` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `media_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `role_name`) VALUES
(1, 'sales-agent', 'Sales Agent'),
(2, 'booking-agent', 'Booking Agent'),
(3, 'dealer', 'Dealer'),
(4, 'admin', 'Admin'),
(5, 'sales-manager', 'Sales Manager'),
(6, 'accounts-officer', 'Accounts Officer'),
(7, 'recovery-officer', 'Recovery Officer'),
(9, 'marketing-agent', 'Marketing Agent');

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
  `user_access_level` text NOT NULL,
  `invoicing` int(1) NOT NULL DEFAULT 0,
  `booking` int(1) NOT NULL DEFAULT 0,
  `leads` int(1) NOT NULL DEFAULT 0,
  `accounting` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `username`, `email`, `password`, `mobile_no`, `user_image`, `user_access_level`, `invoicing`, `booking`, `leads`, `accounting`) VALUES
(1, 'admin one', 'adminone', 'admin@gmail.com', 'admin', '1234456', 'default.jpg', 'admin', 1, 1, 1, 1),
(18, 'Bisma Imran', 'bismaim', 'bisma@gmail.com', 'bis123', '13746234', '1706889346.png', 'sales-agent', 1, 0, 0, 0),
(19, 'Junaid Qureshi', 'junaidqureshi', 'junaid@gmail.com', 'jd123', '13746234', '1707148292.png', 'booking-agent', 1, 0, 1, 0),
(20, 'Ali Khan', 'alikhan', 'ali@gmail.com', 'ali123', '13746234', '1707151694.jpg', 'dealer', 0, 0, 1, 0),
(21, 'Huzaifa', 'huzaifa', 'huzaifa@gmail.com', 'huzaifa@786', '214314', '1707748630.png', 'sales-agent', 1, 1, 0, 0);

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
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `plot_id` (`plot_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `phase_id` (`phase_id`);

--
-- Indexes for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_id` (`lead_id`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnic_number` (`cnic_number`);

--
-- Indexes for table `dealer_commission`
--
ALTER TABLE `dealer_commission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `plot_id` (`plot_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `phase_id` (`phase_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projectinvoice` (`project_id`),
  ADD KEY `FK_customerinvoice` (`customer_id`),
  ADD KEY `FK_plotinvoice` (`plot_id`);

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
-- Indexes for table `phase`
--
ALTER TABLE `phase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_phase_project_id` (`project_id`);

--
-- Indexes for table `phase_media`
--
ALTER TABLE `phase_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_phase_id_media` (`phase_id`);

--
-- Indexes for table `plots_inventory`
--
ALTER TABLE `plots_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_project_id` (`project_id`),
  ADD KEY `fk_phase_id` (`phase_id`);

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
  ADD KEY `fk_project_id_media` (`project_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `call_logs`
--
ALTER TABLE `call_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `dealer_commission`
--
ALTER TABLE `dealer_commission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `main_account_heads`
--
ALTER TABLE `main_account_heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `phase`
--
ALTER TABLE `phase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `phase_media`
--
ALTER TABLE `phase_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plots_inventory`
--
ALTER TABLE `plots_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `project_media`
--
ALTER TABLE `project_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`account_head_id`) REFERENCES `main_account_heads` (`id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`plot_id`) REFERENCES `plots_inventory` (`id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`phase_id`) REFERENCES `phase` (`id`);

--
-- Constraints for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD CONSTRAINT `call_logs_ibfk_1` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`);

--
-- Constraints for table `installment`
--
ALTER TABLE `installment`
  ADD CONSTRAINT `installment_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `installment_ibfk_2` FOREIGN KEY (`plot_id`) REFERENCES `plots_inventory` (`id`),
  ADD CONSTRAINT `installment_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `installment_ibfk_4` FOREIGN KEY (`phase_id`) REFERENCES `phase` (`id`),
  ADD CONSTRAINT `installment_ibfk_5` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `FK_customerinvoice` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `FK_plotinvoice` FOREIGN KEY (`plot_id`) REFERENCES `plots_inventory` (`id`),
  ADD CONSTRAINT `FK_projectinvoice` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `phase`
--
ALTER TABLE `phase`
  ADD CONSTRAINT `fk_phase_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `phase_media`
--
ALTER TABLE `phase_media`
  ADD CONSTRAINT `fk_phase_id_media` FOREIGN KEY (`phase_id`) REFERENCES `phase` (`id`);

--
-- Constraints for table `plots_inventory`
--
ALTER TABLE `plots_inventory`
  ADD CONSTRAINT `fk_phase_id` FOREIGN KEY (`phase_id`) REFERENCES `phase` (`id`),
  ADD CONSTRAINT `fk_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `project_media`
--
ALTER TABLE `project_media`
  ADD CONSTRAINT `fk_project_id_media` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
