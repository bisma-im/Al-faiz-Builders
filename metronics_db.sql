-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 09:12 PM
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
-- Table structure for table `acc_coa`
--

CREATE TABLE `acc_coa` (
  `HeadCode` varchar(50) NOT NULL,
  `HeadName` varchar(100) NOT NULL,
  `PHeadName` varchar(50) NOT NULL,
  `HeadLevel` int(11) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsTransaction` tinyint(1) NOT NULL,
  `IsGL` tinyint(1) NOT NULL,
  `HeadType` char(1) NOT NULL,
  `IsBudget` tinyint(1) NOT NULL,
  `IsDepreciation` tinyint(1) NOT NULL,
  `DepreciationRate` decimal(18,2) NOT NULL,
  `CreateBy` varchar(50) NOT NULL,
  `CreateDate` datetime NOT NULL,
  `UpdateBy` varchar(50) NOT NULL,
  `UpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_coa`
--

INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES
('4021403', 'AC', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:33:55', '', '2015-10-15 00:00:00'),
('50202', 'Account Payable', 'Current Liabilities', 2, 1, 0, 1, 'L', 0, 0, 0.00, 'admin', '2015-10-15 19:50:43', '', '2015-10-15 00:00:00'),
('10203', 'Account Receivable', 'Current Asset', 2, 1, 0, 0, 'A', 0, 0, 0.00, '', '2015-10-15 00:00:00', 'admin', '2013-09-18 15:29:35'),
('1020201', 'Advance', 'Advance, Deposit And Pre-payments', 3, 1, 0, 1, 'A', 0, 0, 0.00, 'Zoherul', '2015-05-31 13:29:12', 'admin', '2015-12-31 16:46:32'),
('102020103', 'Advance House Rent', 'Advance', 4, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-10-02 16:55:38', 'admin', '2016-10-02 16:57:32'),
('10202', 'Advance, Deposit And Pre-payments', 'Current Asset', 2, 1, 0, 0, 'A', 0, 0, 0.00, '', '2015-10-15 00:00:00', 'admin', '2015-12-31 16:46:24'),
('4020602', 'Advertisement and Publicity', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:51:44', '', '2015-10-15 00:00:00'),
('1010410', 'Air Cooler', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-05-23 12:13:55', '', '2015-10-15 00:00:00'),
('4020603', 'AIT Against Advertisement', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:52:09', '', '2015-10-15 00:00:00'),
('1', 'Assets', 'COA', 0, 1, 0, 0, 'A', 0, 0, 0.00, '', '2015-10-15 00:00:00', '', '2015-10-15 00:00:00'),
('1010204', 'Attendance Machine', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:49:31', '', '2015-10-15 00:00:00'),
('40216', 'Audit Fee', 'Other Expenses', 2, 1, 1, 1, 'E', 0, 0, 0.00, 'admin', '2017-07-18 12:54:30', '', '2015-10-15 00:00:00'),
('102010202', 'Bank AlFalah', 'Cash At Bank', 4, 1, 1, 1, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:32:37', 'admin', '2015-10-15 15:32:52'),
('4021002', 'Bank Charge', 'Financial Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:21:03', '', '2015-10-15 00:00:00'),
('30203', 'Bank Interest', 'Other Income', 2, 1, 1, 1, 'I', 0, 0, 0.00, 'Obaidul', '2015-01-03 14:49:54', 'admin', '2016-09-25 11:04:19'),
('1010104', 'Book Shelf', 'Furniture & Fixturers', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:46:11', '', '2015-10-15 00:00:00'),
('1010407', 'Books and Journal', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-03-27 10:45:37', '', '2015-10-15 00:00:00'),
('10201020301', 'Branch 1', 'Standard Bank', 5, 1, 1, 1, 'A', 0, 0, 0.00, '2', '2018-07-19 13:44:33', '', '2015-10-15 00:00:00'),
('4020604', 'Business Development Expenses', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:52:29', '', '2015-10-15 00:00:00'),
('4020606', 'Campaign Expenses', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:52:57', 'admin', '2016-09-19 14:52:48'),
('4020502', 'Campus Rent', 'House Rent', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:46:53', 'admin', '2017-04-27 17:02:39'),
('40212', 'Car Running Expenses', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:28:43', '', '2015-10-15 00:00:00'),
('10201', 'Cash & Cash Equivalent', 'Current Asset', 2, 1, 0, 0, 'A', 0, 0, 0.00, '', '2015-10-15 00:00:00', 'admin', '2015-10-15 15:57:55'),
('1020102', 'Cash At Bank', 'Cash & Cash Equivalent', 3, 1, 0, 0, 'A', 0, 0, 0.00, '2', '2018-07-19 13:43:59', 'admin', '2015-10-15 15:32:42'),
('1020101', 'Cash In Hand', 'Cash & Cash Equivalent', 3, 1, 1, 1, 'A', 0, 0, 0.00, '2', '2018-07-31 12:56:28', 'admin', '2016-05-23 12:05:43'),
('30101', 'Cash Sale', 'Store Income', 1, 1, 1, 1, 'I', 0, 0, 0.00, '2', '2018-07-08 07:51:26', '', '2015-10-15 00:00:00'),
('1010207', 'CCTV', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:51:24', '', '2015-10-15 00:00:00'),
('102020102', 'CEO Current A/C', 'Advance', 4, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-09-25 11:54:54', '', '2015-10-15 00:00:00'),
('1010101', 'Class Room Chair', 'Furniture & Fixturers', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:45:29', '', '2015-10-15 00:00:00'),
('4021407', 'Close Circuit Cemera', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:35:35', '', '2015-10-15 00:00:00'),
('4020601', 'Commision on Admission', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:51:21', 'admin', '2016-09-19 14:42:54'),
('1010206', 'Computer', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:51:09', '', '2015-10-15 00:00:00'),
('4021410', 'Computer (R)', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'Zoherul', '2016-03-24 12:38:52', 'Zoherul', '2016-03-24 12:41:40'),
('1010102', 'Computer Table', 'Furniture & Fixturers', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:45:44', '', '2015-10-15 00:00:00'),
('301020401', 'Continuing Registration fee - UoL (Income)', 'Registration Fee (UOL) Income', 4, 1, 1, 0, 'I', 0, 0, 0.00, 'admin', '2015-10-15 17:40:40', '', '2015-10-15 00:00:00'),
('4020904', 'Contratuall Staff Salary', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:12:34', '', '2015-10-15 00:00:00'),
('403', 'Cost of Sale', 'Expence', 0, 1, 1, 0, 'E', 0, 0, 0.00, '2', '2018-07-08 10:37:16', '', '2015-10-15 00:00:00'),
('4020709', 'Cultural Expense', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'nasmud', '2017-04-29 12:45:10', '', '2015-10-15 00:00:00'),
('102', 'Current Asset', 'Assets', 1, 1, 0, 0, 'A', 0, 0, 0.00, '', '2015-10-15 00:00:00', 'admin', '2018-07-07 11:23:00'),
('502', 'Current Liabilities', 'Liabilities', 1, 1, 0, 0, 'L', 0, 0, 0.00, 'anwarul', '2014-08-30 13:18:20', 'admin', '2015-10-15 19:49:21'),
('1020301', 'Customer Receivable', 'Account Receivable', 3, 1, 0, 1, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:34:31', 'admin', '2018-07-07 12:31:42'),
('40100002', 'cw-Chichawatni', 'Store Expenses', 2, 1, 1, 0, 'E', 0, 0, 0.00, '2', '2018-08-02 16:30:41', '', '2015-10-15 00:00:00'),
('1020202', 'Deposit', 'Advance, Deposit And Pre-payments', 3, 1, 0, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:40:42', '', '2015-10-15 00:00:00'),
('4020605', 'Design & Printing Expense', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:55:00', '', '2015-10-15 00:00:00'),
('4020404', 'Dish Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:58:21', '', '2015-10-15 00:00:00'),
('40215', 'Dividend', 'Other Expenses', 2, 1, 1, 1, 'E', 0, 0, 0.00, 'admin', '2016-09-25 14:07:55', '', '2015-10-15 00:00:00'),
('4020403', 'Drinking Water Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:58:10', '', '2015-10-15 00:00:00'),
('1010211', 'DSLR Camera', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:53:17', 'admin', '2016-01-02 16:23:25'),
('4020908', 'Earned Leave', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:13:38', '', '2015-10-15 00:00:00'),
('4020607', 'Education Fair Expenses', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:53:42', '', '2015-10-15 00:00:00'),
('1010602', 'Electric Equipment', 'Electrical Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-03-27 10:44:51', '', '2015-10-15 00:00:00'),
('1010203', 'Electric Kettle', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:49:07', '', '2015-10-15 00:00:00'),
('10106', 'Electrical Equipment', 'Non Current Assets', 2, 1, 0, 1, 'A', 0, 0, 0.00, 'admin', '2016-03-27 10:43:44', '', '2015-10-15 00:00:00'),
('4020407', 'Electricity Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:59:31', '', '2015-10-15 00:00:00'),
('10202010501', 'employ', 'Salary', 5, 1, 0, 0, 'A', 0, 0, 0.00, 'admin', '2018-07-05 11:47:10', '', '2015-10-15 00:00:00'),
('40201', 'Entertainment', 'Other Expenses', 2, 1, 1, 1, 'E', 0, 0, 0.00, 'admin', '2013-07-08 16:21:26', 'anwarul', '2013-07-17 14:21:47'),
('2', 'Equity', 'COA', 0, 1, 0, 0, 'L', 0, 0, 0.00, '', '2015-10-15 00:00:00', '', '2015-10-15 00:00:00'),
('4', 'Expence', 'COA', 0, 1, 0, 0, 'E', 0, 0, 0.00, '', '2015-10-15 00:00:00', '', '2015-10-15 00:00:00'),
('4020903', 'Faculty,Staff Salary & Allowances', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:12:21', '', '2015-10-15 00:00:00'),
('4021404', 'Fax Machine', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:34:15', '', '2015-10-15 00:00:00'),
('4020905', 'Festival & Incentive Bonus', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:12:48', '', '2015-10-15 00:00:00'),
('1010103', 'File Cabinet', 'Furniture & Fixturers', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:46:02', '', '2015-10-15 00:00:00'),
('40210', 'Financial Expenses', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, 0.00, 'anwarul', '2013-08-20 12:24:31', 'admin', '2015-10-15 19:20:36'),
('1010403', 'Fire Extingushier', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-03-27 10:39:32', '', '2015-10-15 00:00:00'),
('4021408', 'Furniture', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:35:47', '', '2015-10-15 00:00:00'),
('10101', 'Furniture & Fixturers', 'Non Current Assets', 2, 1, 0, 1, 'A', 0, 0, 0.00, 'anwarul', '2013-08-20 16:18:15', 'anwarul', '2013-08-21 13:35:40'),
('4020406', 'Gas Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:59:20', '', '2015-10-15 00:00:00'),
('20201', 'General Reserve', 'Reserve & Surplus', 2, 1, 1, 0, 'L', 0, 0, 0.00, 'admin', '2016-09-25 14:07:12', 'admin', '2016-10-02 17:48:49'),
('10105', 'Generator', 'Non Current Assets', 2, 1, 1, 1, 'A', 0, 0, 0.00, 'Zoherul', '2016-02-27 16:02:35', 'admin', '2016-05-23 12:05:18'),
('4021414', 'Generator Repair', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'Zoherul', '2016-06-16 10:21:05', '', '2015-10-15 00:00:00'),
('40213', 'Generator Running Expenses', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:29:29', '', '2015-10-15 00:00:00'),
('10103', 'Groceries and Cutleries', 'Non Current Assets', 2, 1, 1, 1, 'A', 0, 0, 0.00, '2', '2018-07-12 10:02:55', '', '2015-10-15 00:00:00'),
('1010408', 'Gym Equipment', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-03-27 10:46:03', '', '2015-10-15 00:00:00'),
('4020907', 'Honorarium', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:13:26', '', '2015-10-15 00:00:00'),
('40205', 'House Rent', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, 0.00, 'anwarul', '2013-08-24 10:26:56', '', '2015-10-15 00:00:00'),
('40100001', 'HP-Hasilpur', 'Academic Expenses', 2, 1, 1, 0, 'E', 0, 0, 0.00, '2', '2018-07-29 03:44:23', '', '2015-10-15 00:00:00'),
('4020702', 'HR Recruitment Expenses', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2016-09-25 12:55:49', '', '2015-10-15 00:00:00'),
('4020703', 'Incentive on Admission', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2016-09-25 12:56:09', '', '2015-10-15 00:00:00'),
('3', 'Income', 'COA', 0, 1, 0, 0, 'I', 0, 0, 0.00, '', '2015-10-15 00:00:00', '', '2015-10-15 00:00:00'),
('30204', 'Income from Photocopy & Printing', 'Other Income', 2, 1, 1, 1, 'I', 0, 0, 0.00, 'Zoherul', '2015-07-14 10:29:54', 'admin', '2016-09-25 11:04:28'),
('5020302', 'Income Tax Payable', 'Liabilities for Expenses', 3, 1, 0, 1, 'L', 0, 0, 0.00, 'admin', '2016-09-19 11:18:17', 'admin', '2016-09-28 13:18:35'),
('102020302', 'Insurance Premium', 'Prepayment', 4, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-09-19 13:10:57', '', '2015-10-15 00:00:00'),
('4021001', 'Interest on Loan', 'Financial Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:20:53', 'admin', '2016-09-19 14:53:34'),
('4020401', 'Internet Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:56:55', 'admin', '2015-10-15 18:57:32'),
('10107', 'Inventory', 'Non Current Assets', 1, 1, 0, 0, 'A', 0, 0, 0.00, '2', '2018-07-07 15:21:58', '', '2015-10-15 00:00:00'),
('10205010101', 'Jahangir', 'Hasan', 1, 1, 0, 0, 'A', 0, 0, 0.00, '2', '2018-07-07 10:40:56', '', '2015-10-15 00:00:00'),
('1010210', 'LCD TV', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:52:27', '', '2015-10-15 00:00:00'),
('30103', 'Lease Sale', 'Store Income', 1, 1, 1, 1, 'I', 0, 0, 0.00, '2', '2018-07-08 07:51:52', '', '2015-10-15 00:00:00'),
('5', 'Liabilities', 'COA', 0, 1, 0, 0, 'L', 0, 0, 0.00, 'admin', '2013-07-04 12:32:07', 'admin', '2015-10-15 19:46:54'),
('50203', 'Liabilities for Expenses', 'Current Liabilities', 2, 1, 0, 0, 'L', 0, 0, 0.00, 'admin', '2015-10-15 19:50:59', '', '2015-10-15 00:00:00'),
('4020707', 'Library Expenses', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2017-01-10 15:34:54', '', '2015-10-15 00:00:00'),
('4021409', 'Lift', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:36:12', '', '2015-10-15 00:00:00'),
('50101', 'Long Term Borrowing', 'Non Current Liabilities', 2, 1, 0, 1, 'L', 0, 0, 0.00, 'admin', '2013-07-04 12:32:26', 'admin', '2015-10-15 19:47:40'),
('4020608', 'Marketing & Promotion Exp.', 'Promonational Expence', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:53:59', '', '2015-10-15 00:00:00'),
('4020901', 'Medical Allowance', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:11:33', '', '2015-10-15 00:00:00'),
('1010411', 'Metal Ditector', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'Zoherul', '2016-08-22 10:55:22', '', '2015-10-15 00:00:00'),
('4021413', 'Micro Oven', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'Zoherul', '2016-05-12 14:53:51', '', '2015-10-15 00:00:00'),
('30202', 'Miscellaneous (Income)', 'Other Income', 2, 1, 1, 1, 'I', 0, 0, 0.00, 'anwarul', '2014-02-06 15:26:31', 'admin', '2016-09-25 11:04:35'),
('4020909', 'Miscellaneous Benifit', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:13:53', '', '2015-10-15 00:00:00'),
('4020701', 'Miscellaneous Exp', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2016-09-25 12:54:39', '', '2015-10-15 00:00:00'),
('40207', 'Miscellaneous Expenses', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, 0.00, 'anwarul', '2014-04-26 16:49:56', 'admin', '2016-09-25 12:54:19'),
('1010401', 'Mobile Phone', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-01-29 10:43:30', '', '2015-10-15 00:00:00'),
('102020101', 'Mr Ashiqur Rahman', 'Advance', 4, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-12-31 16:47:23', 'admin', '2016-09-25 11:55:13'),
('1010212', 'Network Accessories', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-01-02 16:23:32', '', '2015-10-15 00:00:00'),
('4020408', 'News Paper Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2016-01-02 15:55:57', '', '2015-10-15 00:00:00'),
('101', 'Non Current Assets', 'Assets', 1, 1, 0, 0, 'A', 0, 0, 0.00, '', '2015-10-15 00:00:00', 'admin', '2015-10-15 15:29:11'),
('501', 'Non Current Liabilities', 'Liabilities', 1, 1, 0, 0, 'L', 0, 0, 0.00, 'anwarul', '2014-08-30 13:18:20', 'admin', '2015-10-15 19:49:21'),
('1010404', 'Office Decoration', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-03-27 10:40:02', '', '2015-10-15 00:00:00'),
('10102', 'Office Equipment', 'Non Current Assets', 2, 1, 0, 1, 'A', 0, 0, 0.00, 'anwarul', '2013-12-06 18:08:00', 'admin', '2015-10-15 15:48:21'),
('4021401', 'Office Repair & Maintenance', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:33:15', '', '2015-10-15 00:00:00'),
('30201', 'Office Stationary (Income)', 'Other Income', 2, 1, 1, 1, 'I', 0, 0, 0.00, 'anwarul', '2013-07-17 15:21:06', 'admin', '2016-09-25 11:04:50'),
('402', 'Other Expenses', 'Expence', 1, 1, 0, 0, 'E', 0, 0, 0.00, '2', '2018-07-07 14:00:16', 'admin', '2015-10-15 18:37:42'),
('302', 'Other Income', 'Income', 1, 1, 0, 0, 'I', 0, 0, 0.00, '2', '2018-07-07 13:40:57', 'admin', '2016-09-25 11:04:09'),
('40211', 'Others (Non Academic Expenses)', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, 0.00, 'Obaidul', '2014-12-03 16:05:42', 'admin', '2015-10-15 19:22:09'),
('30205', 'Others (Non-Academic Income)', 'Other Income', 2, 1, 0, 1, 'I', 0, 0, 0.00, 'admin', '2015-10-15 17:23:49', 'admin', '2015-10-15 17:57:52'),
('10104', 'Others Assets', 'Non Current Assets', 2, 1, 0, 1, 'A', 0, 0, 0.00, 'admin', '2016-01-29 10:43:16', '', '2015-10-15 00:00:00'),
('4020910', 'Outstanding Salary', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'Zoherul', '2016-04-24 11:56:50', '', '2015-10-15 00:00:00'),
('4021405', 'Oven', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:34:31', '', '2015-10-15 00:00:00'),
('4021412', 'PABX-Repair', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'Zoherul', '2016-04-24 14:40:18', '', '2015-10-15 00:00:00'),
('4020902', 'Part-time Staff Salary', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:12:06', '', '2015-10-15 00:00:00'),
('1010202', 'Photocopy & Fax Machine', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:47:27', 'admin', '2016-05-23 12:14:40'),
('4021411', 'Photocopy Machine Repair', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'Zoherul', '2016-04-24 12:40:02', 'admin', '2017-04-27 17:03:17'),
('3020503', 'Practical Fee', 'Others (Non-Academic Income)', 3, 1, 1, 1, 'I', 0, 0, 0.00, 'admin', '2017-07-22 18:00:37', '', '2015-10-15 00:00:00'),
('1020203', 'Prepayment', 'Advance, Deposit And Pre-payments', 3, 1, 0, 1, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:40:51', 'admin', '2015-12-31 16:49:58'),
('1010201', 'Printer', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:47:15', '', '2015-10-15 00:00:00'),
('40202', 'Printing and Stationary', 'Other Expenses', 2, 1, 1, 1, 'E', 0, 0, 0.00, 'admin', '2013-07-08 16:21:45', 'admin', '2016-09-19 14:39:32'),
('3020502', 'Professional Training Course(Oracal-1)', 'Others (Non-Academic Income)', 3, 1, 1, 0, 'I', 0, 0, 0.00, 'nasim', '2017-06-22 13:28:05', '', '2015-10-15 00:00:00'),
('30207', 'Professional Training Course(Oracal)', 'Other Income', 2, 1, 0, 1, 'I', 0, 0, 0.00, 'nasim', '2017-06-22 13:24:16', 'nasim', '2017-06-22 13:25:56'),
('1010208', 'Projector', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:51:44', '', '2015-10-15 00:00:00'),
('40206', 'Promonational Expence', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, 0.00, 'anwarul', '2013-07-11 13:48:57', 'anwarul', '2013-07-17 14:23:03'),
('40214', 'Repair and Maintenance', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:32:46', '', '2015-10-15 00:00:00'),
('202', 'Reserve & Surplus', 'Equity', 1, 1, 0, 1, 'L', 0, 0, 0.00, 'admin', '2016-09-25 14:06:34', 'admin', '2016-10-02 17:48:57'),
('20102', 'Retained Earnings', 'Share Holders Equity', 2, 1, 1, 1, 'L', 0, 0, 0.00, 'admin', '2016-05-23 11:20:40', 'admin', '2016-09-25 14:05:06'),
('4020708', 'River Cruse', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2017-04-24 15:35:25', '', '2015-10-15 00:00:00'),
('102020105', 'Salary', 'Advance', 4, 1, 0, 0, 'A', 0, 0, 0.00, 'admin', '2018-07-05 11:46:44', '', '2015-10-15 00:00:00'),
('40209', 'Salary & Allowances', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, 0.00, 'anwarul', '2013-12-12 11:22:58', '', '2015-10-15 00:00:00'),
('404', 'Sale Discount', 'Expence', 1, 1, 1, 0, 'E', 0, 0, 0.00, '2', '2018-07-19 10:15:11', '', '2015-10-15 00:00:00'),
('1010406', 'Security Equipment', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-03-27 10:41:30', '', '2015-10-15 00:00:00'),
('20101', 'Share Capital', 'Share Holders Equity', 2, 1, 0, 1, 'L', 0, 0, 0.00, 'anwarul', '2013-12-08 19:37:32', 'admin', '2015-10-15 19:45:35'),
('201', 'Share Holders Equity', 'Equity', 1, 1, 0, 0, 'L', 0, 0, 0.00, '', '2015-10-15 00:00:00', 'admin', '2015-10-15 19:43:51'),
('50201', 'Short Term Borrowing', 'Current Liabilities', 2, 1, 0, 1, 'L', 0, 0, 0.00, 'admin', '2015-10-15 19:50:30', '', '2015-10-15 00:00:00'),
('5020200001', 'Smart Power & Techologies', 'Account Payable', 3, 1, 1, 0, 'L', 0, 0, 0.00, 'admin', '2016-09-25 11:45:12', '', '2015-10-15 00:00:00'),
('40208', 'Software Development Expenses', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, 0.00, 'anwarul', '2013-11-21 14:13:01', 'admin', '2015-10-15 19:02:51'),
('4020906', 'Special Allowances', 'Salary & Allowances', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:13:13', '', '2015-10-15 00:00:00'),
('50102', 'Sponsors Loan', 'Non Current Liabilities', 2, 1, 0, 1, 'L', 0, 0, 0.00, 'admin', '2015-10-15 19:48:02', '', '2015-10-15 00:00:00'),
('4020706', 'Sports Expense', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'nasmud', '2016-11-09 13:16:53', '', '2015-10-15 00:00:00'),
('102010203', 'Standard Bank', 'Cash At Bank', 4, 1, 1, 1, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:33:33', 'admin', '2015-10-15 15:33:48'),
('102010204', 'State Bank', 'Cash At Bank', 4, 1, 1, 1, 'A', 0, 0, 0.00, 'admin', '2015-12-31 16:44:14', '', '2015-10-15 00:00:00'),
('401', 'Store Expenses', 'Expence', 1, 1, 0, 0, 'E', 0, 0, 0.00, '2', '2018-07-07 13:38:59', 'admin', '2015-10-15 17:58:46'),
('301', 'Store Income', 'Income', 1, 1, 0, 0, 'I', 0, 0, 0.00, '2', '2018-07-07 13:40:37', 'admin', '2015-09-17 17:00:02'),
('3020501', 'Students Info. Correction Fee', 'Others (Non-Academic Income)', 3, 1, 1, 0, 'I', 0, 0, 0.00, 'admin', '2015-10-15 17:24:45', '', '2015-10-15 00:00:00'),
('1010601', 'Sub Station', 'Electrical Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-03-27 10:44:11', '', '2015-10-15 00:00:00'),
('5020200006', 'sup-4-Eco star', 'Account Payable', 3, 1, 1, 0, 'L', 0, 0, 0.00, '2', '2018-07-27 10:15:58', '', '2015-10-15 00:00:00'),
('5020200007', 'sup-5-New', 'Account Payable', 3, 1, 1, 0, 'L', 0, 0, 0.00, '2', '2018-08-02 16:23:42', '', '2015-10-15 00:00:00'),
('5020200002', 'sup-5-Sharif', 'Account Payable', 3, 1, 1, 0, 'L', 0, 0, 0.00, '2', '2018-07-12 10:04:21', '', '2015-10-15 00:00:00'),
('5020200003', 'sup-6-Talha', 'Account Payable', 3, 1, 1, 0, 'L', 0, 0, 0.00, '2', '2018-07-14 10:16:52', '', '2015-10-15 00:00:00'),
('5020200004', 'sup-7-MS. Tel&Co.', 'Account Payable', 3, 1, 1, 0, 'L', 0, 0, 0.00, '2', '2018-07-19 05:06:18', '', '2015-10-15 00:00:00'),
('5020200005', 'sup-8-july', 'Account Payable', 3, 1, 1, 0, 'L', 0, 0, 0.00, '2', '2018-07-27 09:41:53', '', '2015-10-15 00:00:00'),
('4020704', 'TB Care Expenses', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2016-10-08 13:03:04', '', '2015-10-15 00:00:00'),
('30206', 'TB Care Income', 'Other Income', 2, 1, 1, 1, 'I', 0, 0, 0.00, 'admin', '2016-10-08 13:00:56', '', '2015-10-15 00:00:00'),
('4020501', 'TDS on House Rent', 'House Rent', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:44:07', 'admin', '2016-09-19 14:40:16'),
('502030201', 'TDS Payable House Rent', 'Income Tax Payable', 4, 1, 1, 0, 'L', 0, 0, 0.00, 'admin', '2016-09-19 11:19:42', 'admin', '2016-09-28 13:19:37'),
('502030203', 'TDS Payable on Advertisement Bill', 'Income Tax Payable', 4, 1, 1, 0, 'L', 0, 0, 0.00, 'admin', '2016-09-28 13:20:51', '', '2015-10-15 00:00:00'),
('502030202', 'TDS Payable on Salary', 'Income Tax Payable', 4, 1, 1, 0, 'L', 0, 0, 0.00, 'admin', '2016-09-28 13:20:17', '', '2015-10-15 00:00:00'),
('4021402', 'Tea Kettle', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:33:45', '', '2015-10-15 00:00:00'),
('4020402', 'Telephone Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:57:59', '', '2015-10-15 00:00:00'),
('1010209', 'Telephone Set & PABX', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:51:57', 'admin', '2016-10-02 17:10:40'),
('102020104', 'Test', 'Advance', 4, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2018-07-05 11:42:48', '', '2015-10-15 00:00:00'),
('40203', 'Travelling & Conveyance', 'Other Expenses', 2, 1, 1, 1, 'E', 0, 0, 0.00, 'admin', '2013-07-08 16:22:06', 'admin', '2015-10-15 18:45:13'),
('4021406', 'TV', 'Repair and Maintenance', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 19:35:07', '', '2015-10-15 00:00:00'),
('1010205', 'UPS', 'Office Equipment', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:50:38', '', '2015-10-15 00:00:00'),
('40204', 'Utility Expenses', 'Other Expenses', 2, 1, 0, 1, 'E', 0, 0, 0.00, 'anwarul', '2013-07-11 16:20:24', 'admin', '2016-01-02 15:55:22'),
('4020503', 'VAT on House Rent Exp', 'House Rent', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:49:22', 'admin', '2016-09-25 14:00:52'),
('5020301', 'VAT Payable', 'Liabilities for Expenses', 3, 1, 0, 1, 'L', 0, 0, 0.00, 'admin', '2015-10-15 19:51:11', 'admin', '2016-09-28 13:23:53'),
('1010409', 'Vehicle A/C', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'Zoherul', '2016-05-12 12:13:21', '', '2015-10-15 00:00:00'),
('1010405', 'Voltage Stablizer', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-03-27 10:40:59', '', '2015-10-15 00:00:00'),
('1010105', 'Waiting Sofa - Steel', 'Furniture & Fixturers', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2015-10-15 15:46:29', '', '2015-10-15 00:00:00'),
('4020405', 'WASA Bill', 'Utility Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2015-10-15 18:58:51', '', '2015-10-15 00:00:00'),
('1010402', 'Water Purifier', 'Others Assets', 3, 1, 1, 0, 'A', 0, 0, 0.00, 'admin', '2016-01-29 11:14:11', '', '2015-10-15 00:00:00'),
('4020705', 'Website Development Expenses', 'Miscellaneous Expenses', 3, 1, 1, 0, 'E', 0, 0, 0.00, 'admin', '2016-10-15 12:42:47', '', '2015-10-15 00:00:00');

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
  `payment_plan` varchar(50) NOT NULL,
  `number_of_installments` int(11) NOT NULL,
  `installment_amount` decimal(10,0) NOT NULL,
  `discount_type` varchar(20) DEFAULT NULL,
  `discount_amount` decimal(10,0) DEFAULT NULL,
  `discount_percentage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `project_id`, `plot_id`, `customer_id`, `unit_cost`, `extra_charges`, `development_charges`, `total_amount`, `token_amount`, `advance_amount`, `isLocked`, `username`, `created_on`, `phase_id`, `payment_plan`, `number_of_installments`, `installment_amount`, `discount_type`, `discount_amount`, `discount_percentage`) VALUES
(3, 25, 79, 40, 123312, 231231, 12332, 2312323, 23123, 23123, 1, 'adminone', '2024-02-22 00:59:02', 10, 'installment', 5, 462465, NULL, NULL, NULL),
(4, 25, 80, 41, 432423, 23442542, 42343, 43243, 34234, 42432, 1, 'adminone', '2024-02-22 13:57:24', 10, 'installment', 5, 8649, NULL, NULL, NULL),
(5, 25, 81, 42, 13234, 24455, 555, 3313343, 1234234, 14324, 1, 'adminone', '2024-02-23 14:31:37', 10, 'installment', 5, 662669, NULL, NULL, NULL),
(9, 25, 82, 42, 4324, 23432, 342342, 234234, 234234, 342234, 1, 'adminone', '2024-02-23 23:26:20', 10, 'installment', 3, 78078, NULL, NULL, NULL),
(10, 25, 83, 42, 324, 32434, 34234, 342423, 3423, 3434, 1, 'adminone', '2024-02-23 23:28:59', 10, 'installment', 2, 171212, NULL, NULL, NULL),
(17, 25, 84, 42, 2434, 3434, 3434, 3434, 3434, 3434, 1, 'adminone', '2024-02-23 23:56:16', 10, 'installment', 3, 1145, NULL, NULL, NULL),
(18, 25, 85, 41, 123, 123231, 2123, 123123, 23123, 123123, 1, 'adminone', '2024-02-24 00:26:36', 10, 'installment', 3, 41041, NULL, NULL, NULL),
(19, 25, 86, 42, 123123, 231123, 123123, 231231, 213123, 123123, 1, 'adminone', '2024-02-24 01:00:35', 10, 'installment', 5, 46246, NULL, NULL, NULL),
(20, 25, 87, 42, 312231, 23123, 123123, 23123, 213123, 123123, 1, 'adminone', '2024-02-24 01:05:18', 10, 'installment', 3, 7708, NULL, NULL, NULL),
(21, 25, 88, 42, 4334, 341341, 341341, 341341, 34134, 3434, 1, 'adminone', '2024-02-24 01:06:16', 10, 'installment', 5, 68268, NULL, NULL, NULL),
(22, 25, 89, 42, 123241, 4114, 1414, 1414, 1414, 1414, 1, 'adminone', '2024-02-24 01:11:02', 11, 'installment', 3, 471, NULL, NULL, NULL),
(23, 25, 90, 42, 431413, 1431, 134413, 134134, 134134, 314134, 1, 'adminone', '2024-02-24 01:18:52', 11, 'installment', 5, 26827, NULL, NULL, NULL),
(24, 25, 91, 44, 431423, 43342, 342342, 234342, 234234, 234234, 1, 'adminone', '2024-02-24 01:20:11', 11, 'installment', 5, 46868, NULL, NULL, NULL),
(25, 25, 92, 44, 123321, 231123, 213312, 123123, 123123, 123123, 1, 'adminone', '2024-02-24 01:38:55', 11, 'full_cash', 1, 123123, NULL, NULL, NULL),
(26, 25, 93, 44, 21323, 2313, 32132, 32123, 12323, 23123, 1, 'adminone', '2024-02-24 14:01:48', 11, 'full_cash', 1, 32123, NULL, NULL, NULL),
(27, 25, 94, 45, 321412, 1233223, 232323, 32323232, 234, 434, 1, 'adminone', '2024-02-24 14:03:51', 11, 'installment', 38, 850611, NULL, NULL, NULL),
(28, 25, 95, 44, 234342, 342234, 234234, 234234, 423234, 423234, 1, 'adminone', '2024-02-24 14:39:39', 11, 'full_cash', 1, 234234, NULL, NULL, NULL),
(29, 25, 96, 44, 423423, 344334, 343434, 343434, 4334, 3434, 0, 'adminone', '2024-02-24 14:45:16', 11, 'full_cash', 1, 343434, NULL, NULL, NULL),
(30, 25, 97, 45, 2343424, 3423434, 342234, 23434, 34342, 34234, 1, 'adminone', '2024-02-24 14:51:27', 11, 'full_cash', 1, 23434, NULL, NULL, NULL),
(31, 26, 113, 45, 11, 11, 11, 11111111, 11, 11, 1, 'adminone', '2024-02-28 15:49:01', 13, 'full_cash', 1, 11111111, NULL, NULL, NULL),
(32, 26, 114, 45, 23132, 2332, 2323, 800000, 231123, 23123, 1, 'adminone', '2024-02-28 15:56:27', 13, 'part_payment', 5, 100000, 'discount_amount', 50000, NULL),
(33, 26, 115, 42, 34432, 342234, 234342, 90000, 1213, 2332, 1, 'adminone', '2024-02-28 16:00:28', 13, 'full_cash', 1, 90000, NULL, NULL, NULL),
(34, 26, 116, 44, 2123, 2323, 2323, 4555655, 231, 123, 1, 'adminone', '2024-02-28 16:01:10', 13, 'installment', 5, 911131, NULL, NULL, NULL),
(35, 26, 117, 44, 343, 3434, 3434, 800000, 33, 3434, 1, 'adminone', '2024-02-28 16:02:24', 13, 'part_payment', 5, 100000, 'discount_amount', 50000, NULL);

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
  `next_call_time` time DEFAULT NULL,
  `received_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `call_logs`
--

INSERT INTO `call_logs` (`id`, `lead_id`, `date_of_call`, `time_of_call`, `customer_response`, `next_call_date`, `next_call_time`, `received_by`) VALUES
(1, 3, '2024-01-10', '12:00:00', 'dcbHCDBAHD', '2024-01-10', '12:00:00', 'Bisma Imran'),
(2, 3, '2024-01-12', '09:00:00', 'dcbHCDBAHD', '2024-01-11', '14:00:00', 'Huzaifa'),
(3, 3, '2024-01-12', '09:00:00', 'dcbHCDBAHD', '2024-01-11', '14:00:00', ''),
(4, 3, '2024-01-03', '14:00:00', 'fvsdvgsf', '2024-01-05', '12:00:00', ''),
(5, 3, '2024-01-20', '12:00:00', 'dvadvadV', '2024-01-25', '12:00:00', ''),
(6, 3, '2024-01-24', '12:00:00', 'cascavc', '2024-01-25', '12:00:00', ''),
(7, 3, '2024-01-10', '12:00:00', 'vsvb bfd', '2024-01-31', '16:00:00', ''),
(8, 3, '2024-01-11', '12:00:00', 'vszv szd v', '2024-01-18', '12:00:00', ''),
(9, 3, '2024-01-17', '12:00:00', 'v sdv sdv', '2024-02-01', '12:00:00', ''),
(10, 3, '2024-01-03', '12:00:00', 'vbfgnfh n', '2024-01-26', '12:00:00', ''),
(11, 3, '2024-01-13', '12:00:00', 'vdx vsf b', '2024-02-09', '12:00:00', ''),
(12, 4, '2024-02-02', '12:00:00', 'njnjnjk', '2024-02-05', '12:00:00', ''),
(13, 3, '2024-01-13', '12:00:00', 'ffcvvsfb', '2024-02-03', '12:00:00', ''),
(14, 6, '2024-02-15', '09:00:00', 'afasgsdg', '2024-02-24', '12:00:00', ''),
(15, 3, '2024-02-13', '09:00:00', 'ffsafdf', '2024-02-14', '10:00:00', ''),
(16, 9, '2024-03-05', '14:00:00', 'fsfsdfds', '2024-03-06', '15:00:00', 'admin one');

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
  `next_of_kin_cnic` varchar(20) DEFAULT NULL,
  `customer_cnic_image` varchar(150) DEFAULT NULL,
  `thumb_impression` varchar(150) DEFAULT NULL,
  `nok_cnic_image` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_image`, `name`, `address`, `area`, `city`, `country`, `mobile_number_1`, `mobile_number_2`, `landline_number`, `office_phone`, `cnic_number`, `next_of_kin_name`, `next_of_kin_relation`, `next_of_kin_address`, `next_of_kin_area`, `next_of_kin_city`, `next_of_kin_country`, `next_of_kin_mobile_number_1`, `next_of_kin_mobile_number_2`, `next_of_kin_landline_number`, `next_of_kin_cnic`, `customer_cnic_image`, `thumb_impression`, `nok_cnic_image`) VALUES
(4, '1706826833.png', 'Shahrukh Ghaffar', 'Esolace Tech Office 4541 182-184 High Street North', NULL, 'East Ham', 'Pakistan', '+922032394343', NULL, NULL, NULL, '151514511', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'default.jpg', 'musadiq mustafa', 'gulshan e iqbal', NULL, 'karachi', 'Pakistan', '02032394343', NULL, NULL, NULL, '15165161', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '1706826888.png', 'bisma imran', 'Esolace Tech Office 4541 182-184 High Street North', NULL, 'Eastham', 'United Kingdom', '02032394343', NULL, NULL, NULL, '15154131', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, 'Bisma Imran', 'ahgfhdjh', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '24264534', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '1707488523.png', 'ali', 'ahgfhdjh', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '32435624679', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '1707502260.png', 'Bisma Imran', 'ahgfhdjh', NULL, NULL, NULL, '12445', NULL, NULL, NULL, '32435624679141242', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '1707503410.png', 'afdfsa', 'sFGFGf', NULL, NULL, NULL, '143423', NULL, NULL, NULL, '21434', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '1707747864.PNG', 'asfdfafd', 'affaf', NULL, NULL, NULL, '234423', NULL, NULL, NULL, '123124', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '1707747965.png', 'asfdfafd', 'affaf', NULL, NULL, NULL, '234423', NULL, NULL, NULL, '12312456334', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '1707750227.png', 'Bisma Imran', 'ahgfhdjh', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '2426453478', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '1707750257.png', 'Bisma Imran', 'ahgfhdjh', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '242645347834', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'default.jpg', 'Bisma Imran Kan', 'Nazimabad', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '5545454545', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, '1706826888.png', 'Ahmed', 'ahgfhdjh', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '24264534432', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'default.svg', 'Junaid', 'ahgfhdjh', NULL, NULL, NULL, '534543354', NULL, NULL, NULL, '4231423', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, '1706826888.png', 'Huzaifa', 'fdaffsf', NULL, NULL, NULL, '13746234', NULL, NULL, NULL, '24264534456', 'Yahya', 'brother', 'xyz street', NULL, NULL, NULL, '132413443', NULL, NULL, '664578698', 'undefined', 'undefined', 'undefined'),
(44, '1708737611.png', 'Marium', 'asbfhabfh', NULL, NULL, NULL, '498258', NULL, NULL, NULL, '345893457', 'Ali', 'brother', 'gsgsfgf', NULL, NULL, NULL, '431341341', NULL, NULL, '343413', 'undefined', 'undefined', 'undefined'),
(45, '1708783431.png', 'Vania', 'xyz street', NULL, NULL, NULL, '1241414', NULL, NULL, NULL, '3214124', 'Yahya', 'brother', 'xyz street', NULL, NULL, NULL, '234124', NULL, NULL, '343413434', 'undefined', 'undefined', 'undefined');

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
  `intimation_date` date NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_amount` decimal(10,0) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `installment`
--

INSERT INTO `installment` (`id`, `booking_id`, `project_id`, `phase_id`, `plot_id`, `customer_id`, `amount`, `due_date`, `installment_status`, `intimation_date`, `payment_date`, `payment_amount`, `created_at`, `updated_at`) VALUES
(1, 3, 25, 10, 79, 40, 462465, '2024-02-22', 'paid', '2024-02-27', NULL, NULL, '2024-02-22 00:59:02', '2024-02-22 00:59:02'),
(2, 3, 25, 10, 79, 40, 462465, '2024-03-22', 'pending', '2024-03-27', NULL, NULL, '2024-02-22 00:59:02', '2024-02-22 00:59:02'),
(3, 3, 25, 10, 79, 40, 462465, '2024-04-22', 'pending', '2024-04-27', NULL, NULL, '2024-02-22 00:59:02', '2024-02-22 00:59:02'),
(4, 3, 25, 10, 79, 40, 462465, '2024-05-22', 'pending', '2024-05-27', NULL, NULL, '2024-02-22 00:59:02', '2024-02-22 00:59:02'),
(5, 3, 25, 10, 79, 40, 462465, '2024-06-22', 'pending', '2024-06-27', NULL, NULL, '2024-02-22 00:59:02', '2024-02-22 00:59:02'),
(6, 4, 25, 10, 80, 41, 8649, '2024-02-22', 'paid', '2024-02-27', NULL, NULL, '2024-02-22 13:57:24', '2024-02-22 14:51:00'),
(7, 4, 25, 10, 80, 41, 8649, '2024-03-22', 'paid', '2024-03-27', NULL, NULL, '2024-02-22 13:57:24', '2024-02-22 14:51:00'),
(8, 4, 25, 10, 80, 41, 8649, '2024-04-22', 'pending', '2024-04-27', NULL, NULL, '2024-02-22 13:57:24', '2024-02-22 14:51:00'),
(9, 4, 25, 10, 80, 41, 8649, '2024-05-22', 'pending', '2024-05-27', NULL, NULL, '2024-02-22 13:57:24', '2024-02-22 14:51:00'),
(10, 4, 25, 10, 80, 41, 8649, '2024-06-22', 'pending', '2024-06-27', NULL, NULL, '2024-02-22 13:57:24', '2024-02-22 14:51:00'),
(11, 17, 25, 10, 84, 42, 1145, '2024-02-23', 'pending', '2024-02-28', NULL, NULL, '2024-02-23 23:56:16', '2024-02-23 23:56:16'),
(12, 17, 25, 10, 84, 42, 1145, '2024-03-23', 'pending', '2024-03-28', NULL, NULL, '2024-02-23 23:56:16', '2024-02-23 23:56:16'),
(13, 17, 25, 10, 84, 42, 1145, '2024-04-23', 'pending', '2024-04-28', NULL, NULL, '2024-02-23 23:56:16', '2024-02-23 23:56:16'),
(14, 18, 25, 10, 85, 41, 41041, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 00:26:36', '2024-02-24 00:26:36'),
(15, 18, 25, 10, 85, 41, 41041, '2024-03-24', 'pending', '2024-03-29', NULL, NULL, '2024-02-24 00:26:36', '2024-02-24 00:26:36'),
(16, 18, 25, 10, 85, 41, 41041, '2024-04-24', 'pending', '2024-04-29', NULL, NULL, '2024-02-24 00:26:36', '2024-02-24 00:26:36'),
(17, 19, 25, 10, 86, 42, 46246, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 01:00:35', '2024-02-24 01:00:35'),
(18, 19, 25, 10, 86, 42, 46246, '2024-03-24', 'pending', '2024-03-29', NULL, NULL, '2024-02-24 01:00:35', '2024-02-24 01:00:35'),
(19, 19, 25, 10, 86, 42, 46246, '2024-04-24', 'pending', '2024-04-29', NULL, NULL, '2024-02-24 01:00:35', '2024-02-24 01:00:35'),
(20, 19, 25, 10, 86, 42, 46246, '2024-05-24', 'pending', '2024-05-29', NULL, NULL, '2024-02-24 01:00:35', '2024-02-24 01:00:35'),
(22, 20, 25, 10, 87, 42, 7708, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 01:05:18', '2024-02-24 01:05:18'),
(23, 20, 25, 10, 87, 42, 7708, '2024-03-24', 'pending', '2024-03-29', NULL, NULL, '2024-02-24 01:05:18', '2024-02-24 01:05:18'),
(24, 20, 25, 10, 87, 42, 7708, '2024-04-24', 'pending', '2024-04-29', NULL, NULL, '2024-02-24 01:05:18', '2024-02-24 01:05:18'),
(25, 21, 25, 10, 88, 42, 68268, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 01:06:16', '2024-02-24 01:06:16'),
(26, 21, 25, 10, 88, 42, 68268, '2024-03-24', 'pending', '2024-03-29', NULL, NULL, '2024-02-24 01:06:16', '2024-02-24 01:06:16'),
(27, 21, 25, 10, 88, 42, 68268, '2024-04-24', 'pending', '2024-04-29', NULL, NULL, '2024-02-24 01:06:16', '2024-02-24 01:06:16'),
(28, 21, 25, 10, 88, 42, 68268, '2024-05-24', 'pending', '2024-05-29', NULL, NULL, '2024-02-24 01:06:16', '2024-02-24 01:06:16'),
(29, 21, 25, 10, 88, 42, 68268, '2024-06-24', 'pending', '2024-06-29', NULL, NULL, '2024-02-24 01:06:16', '2024-02-24 01:06:16'),
(30, 22, 25, 11, 89, 42, 471, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 01:11:02', '2024-02-24 01:11:02'),
(31, 22, 25, 11, 89, 42, 471, '2024-03-24', 'pending', '2024-03-29', NULL, NULL, '2024-02-24 01:11:02', '2024-02-24 01:11:02'),
(32, 22, 25, 11, 89, 42, 471, '2024-04-24', 'pending', '2024-04-29', NULL, NULL, '2024-02-24 01:11:02', '2024-02-24 01:11:02'),
(33, 23, 25, 11, 90, 42, 26827, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 01:18:52', '2024-02-24 01:18:52'),
(34, 23, 25, 11, 90, 42, 26827, '2024-03-24', 'pending', '2024-03-29', NULL, NULL, '2024-02-24 01:18:52', '2024-02-24 01:18:52'),
(35, 23, 25, 11, 90, 42, 26827, '2024-04-24', 'pending', '2024-04-29', NULL, NULL, '2024-02-24 01:18:52', '2024-02-24 01:18:52'),
(36, 23, 25, 11, 90, 42, 26827, '2024-05-24', 'pending', '2024-05-29', NULL, NULL, '2024-02-24 01:18:52', '2024-02-24 01:18:52'),
(37, 23, 25, 11, 90, 42, 26827, '2024-06-24', 'pending', '2024-06-29', NULL, NULL, '2024-02-24 01:18:52', '2024-02-24 01:18:52'),
(38, 24, 25, 11, 91, 44, 46868, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 01:20:11', '2024-02-24 01:20:11'),
(39, 24, 25, 11, 91, 44, 46868, '2024-03-24', 'pending', '2024-03-29', NULL, NULL, '2024-02-24 01:20:11', '2024-02-24 01:20:11'),
(40, 24, 25, 11, 91, 44, 46868, '2024-04-24', 'pending', '2024-04-29', NULL, NULL, '2024-02-24 01:20:11', '2024-02-24 01:20:11'),
(41, 24, 25, 11, 91, 44, 46868, '2024-05-24', 'pending', '2024-05-29', NULL, NULL, '2024-02-24 01:20:11', '2024-02-24 01:20:11'),
(42, 24, 25, 11, 91, 44, 46868, '2024-06-24', 'pending', '2024-06-29', NULL, NULL, '2024-02-24 01:20:11', '2024-02-24 01:20:11'),
(43, 25, 25, 11, 92, 44, 123123, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 01:38:55', '2024-02-24 01:38:55'),
(44, 26, 25, 11, 93, 44, 32123, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 14:01:48', '2024-02-24 14:01:48'),
(45, 27, 25, 11, 94, 45, 850611, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(46, 27, 25, 11, 94, 45, 850611, '2024-03-24', 'pending', '2024-03-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(47, 27, 25, 11, 94, 45, 850611, '2024-04-24', 'pending', '2024-04-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(48, 27, 25, 11, 94, 45, 850611, '2024-05-24', 'pending', '2024-05-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(49, 27, 25, 11, 94, 45, 850611, '2024-06-24', 'pending', '2024-06-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(50, 27, 25, 11, 94, 45, 850611, '2024-07-24', 'pending', '2024-07-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(51, 27, 25, 11, 94, 45, 850611, '2024-08-24', 'pending', '2024-08-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(52, 27, 25, 11, 94, 45, 850611, '2024-09-24', 'pending', '2024-09-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(53, 27, 25, 11, 94, 45, 850611, '2024-10-24', 'pending', '2024-10-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(54, 27, 25, 11, 94, 45, 850611, '2024-11-24', 'pending', '2024-11-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(55, 27, 25, 11, 94, 45, 850611, '2024-12-24', 'pending', '2024-12-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(56, 27, 25, 11, 94, 45, 850611, '2025-01-24', 'pending', '2025-01-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(57, 27, 25, 11, 94, 45, 850611, '2025-02-24', 'pending', '2025-03-01', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(58, 27, 25, 11, 94, 45, 850611, '2025-03-24', 'pending', '2025-03-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(59, 27, 25, 11, 94, 45, 850611, '2025-04-24', 'pending', '2025-04-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(60, 27, 25, 11, 94, 45, 850611, '2025-05-24', 'pending', '2025-05-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(61, 27, 25, 11, 94, 45, 850611, '2025-06-24', 'pending', '2025-06-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(62, 27, 25, 11, 94, 45, 850611, '2025-07-24', 'pending', '2025-07-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(63, 27, 25, 11, 94, 45, 850611, '2025-08-24', 'pending', '2025-08-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(64, 27, 25, 11, 94, 45, 850611, '2025-09-24', 'pending', '2025-09-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(65, 27, 25, 11, 94, 45, 850611, '2025-10-24', 'pending', '2025-10-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(66, 27, 25, 11, 94, 45, 850611, '2025-11-24', 'pending', '2025-11-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(67, 27, 25, 11, 94, 45, 850611, '2025-12-24', 'pending', '2025-12-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(68, 27, 25, 11, 94, 45, 850611, '2026-01-24', 'pending', '2026-01-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(69, 27, 25, 11, 94, 45, 850611, '2026-02-24', 'pending', '2026-03-01', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(70, 27, 25, 11, 94, 45, 850611, '2026-03-24', 'pending', '2026-03-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(71, 27, 25, 11, 94, 45, 850611, '2026-04-24', 'pending', '2026-04-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(72, 27, 25, 11, 94, 45, 850611, '2026-05-24', 'pending', '2026-05-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(73, 27, 25, 11, 94, 45, 850611, '2026-06-24', 'pending', '2026-06-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(74, 27, 25, 11, 94, 45, 850611, '2026-07-24', 'pending', '2026-07-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(75, 27, 25, 11, 94, 45, 850611, '2026-08-24', 'pending', '2026-08-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(76, 27, 25, 11, 94, 45, 850611, '2026-09-24', 'pending', '2026-09-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(77, 27, 25, 11, 94, 45, 850611, '2026-10-24', 'pending', '2026-10-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(78, 27, 25, 11, 94, 45, 850611, '2026-11-24', 'pending', '2026-11-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(79, 27, 25, 11, 94, 45, 850611, '2026-12-24', 'pending', '2026-12-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(80, 27, 25, 11, 94, 45, 850611, '2027-01-24', 'pending', '2027-01-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(81, 27, 25, 11, 94, 45, 850611, '2027-02-24', 'pending', '2027-03-01', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(82, 27, 25, 11, 94, 45, 850611, '2027-03-24', 'pending', '2027-03-29', NULL, NULL, '2024-02-24 14:03:51', '2024-02-24 14:03:51'),
(83, 28, 25, 11, 95, 44, 234234, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 14:39:39', '2024-02-24 14:39:39'),
(84, 29, 25, 11, 96, 44, 343434, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 14:45:16', '2024-02-24 14:45:16'),
(85, 30, 25, 11, 97, 45, 23434, '2024-02-24', 'pending', '2024-02-29', NULL, NULL, '2024-02-24 14:51:27', '2024-02-24 14:51:27'),
(86, 31, 26, 13, 113, 45, 11111111, '2024-02-28', 'pending', '2024-03-04', NULL, NULL, '2024-02-28 15:49:01', '2024-02-28 15:49:01'),
(87, 32, 26, 13, 114, 45, 300000, '2024-02-28', 'pending', '2024-03-04', NULL, NULL, '2024-02-28 15:56:27', '2024-02-28 15:56:27'),
(88, 32, 26, 13, 114, 45, 100000, '2024-03-28', 'pending', '2024-04-02', NULL, NULL, '2024-02-28 15:56:27', '2024-02-28 15:56:27'),
(89, 32, 26, 13, 114, 45, 100000, '2024-04-28', 'pending', '2024-05-03', NULL, NULL, '2024-02-28 15:56:27', '2024-02-28 15:56:27'),
(90, 32, 26, 13, 114, 45, 100000, '2024-05-28', 'pending', '2024-06-02', NULL, NULL, '2024-02-28 15:56:27', '2024-02-28 15:56:27'),
(91, 32, 26, 13, 114, 45, 100000, '2024-06-28', 'pending', '2024-07-03', NULL, NULL, '2024-02-28 15:56:27', '2024-02-28 15:56:27'),
(92, 32, 26, 13, 114, 45, 50000, '2024-07-28', 'pending', '2024-08-02', NULL, NULL, '2024-02-28 15:56:27', '2024-02-28 15:56:27'),
(93, 33, 26, 13, 115, 42, 90000, '2024-02-28', 'pending', '2024-03-04', NULL, NULL, '2024-02-28 16:00:28', '2024-02-28 16:00:28'),
(94, 34, 26, 13, 116, 44, 911131, '2024-02-28', 'pending', '2024-03-04', NULL, NULL, '2024-02-28 16:01:10', '2024-02-28 16:01:10'),
(95, 34, 26, 13, 116, 44, 911131, '2024-03-28', 'pending', '2024-04-02', NULL, NULL, '2024-02-28 16:01:10', '2024-02-28 16:01:10'),
(96, 34, 26, 13, 116, 44, 911131, '2024-04-28', 'pending', '2024-05-03', NULL, NULL, '2024-02-28 16:01:10', '2024-02-28 16:01:10'),
(97, 34, 26, 13, 116, 44, 911131, '2024-05-28', 'pending', '2024-06-02', NULL, NULL, '2024-02-28 16:01:10', '2024-02-28 16:01:10'),
(98, 34, 26, 13, 116, 44, 911131, '2024-06-28', 'pending', '2024-07-03', NULL, NULL, '2024-02-28 16:01:10', '2024-02-28 16:01:10'),
(99, 35, 26, 13, 117, 44, 300000, '2024-02-28', 'pending', '2024-03-04', NULL, NULL, '2024-02-28 16:02:24', '2024-02-28 16:02:24'),
(100, 35, 26, 13, 117, 44, 100000, '2024-03-28', 'pending', '2024-04-02', NULL, NULL, '2024-02-28 16:02:24', '2024-02-28 16:02:24'),
(101, 35, 26, 13, 117, 44, 100000, '2024-04-28', 'pending', '2024-05-03', NULL, NULL, '2024-02-28 16:02:24', '2024-02-28 16:02:24'),
(102, 35, 26, 13, 117, 44, 100000, '2024-05-28', 'pending', '2024-06-02', NULL, NULL, '2024-02-28 16:02:24', '2024-02-28 16:02:24'),
(103, 35, 26, 13, 117, 44, 100000, '2024-06-28', 'pending', '2024-07-03', NULL, NULL, '2024-02-28 16:02:24', '2024-02-28 16:02:24'),
(104, 35, 26, 13, 117, 44, 50000, '2024-07-28', 'pending', '2024-08-02', NULL, NULL, '2024-02-28 16:02:24', '2024-02-28 16:02:24');

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
  `username` varchar(255) NOT NULL,
  `mature` int(1) NOT NULL,
  `transferred_to_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `name`, `mobile_number_1`, `mobile_number_2`, `landline_number_1`, `landline_number_2`, `email`, `source_of_information`, `details`, `username`, `mature`, `transferred_to_user_id`) VALUES
(3, 'bisma imran', '027384734', NULL, NULL, NULL, NULL, 'tv', NULL, 'smone', 1, 18),
(4, 'Shahrukh Ghaffar', '02032394343', NULL, NULL, NULL, 'business.esolacetech@gmail.com', 'pamphlet', NULL, 'smone', 1, 21),
(5, 'Shahrukh Ghaffar', '02032394343', NULL, NULL, NULL, 'business.esolace@gmail.com', 'pamphlet', NULL, 'maone', 0, 0),
(6, 'Bisma Imran 1', '2141243', NULL, NULL, NULL, 'bismaimran1@gmail.com', 'pamphlet', NULL, 'maone', 0, 0),
(7, 'Bisma Imran 1', '2141243', NULL, NULL, NULL, 'bisma@gmail.com', 'pamphlet', NULL, 'maone', 1, 18),
(8, 'Bisma Imran 1', '2141243', NULL, NULL, NULL, 'bisma1@gmail.com', 'word_of_mouth', NULL, 'maone', 1, 21),
(9, 'Bisma Imran 2', '2355', NULL, NULL, NULL, 'bisma2@gmail.com', 'word_of_mouth', NULL, 'maone', 1, 18),
(10, 'Bisma Imran 3', 'q343552', NULL, NULL, NULL, 'bisma3@gmail.com', 'pamphlet', NULL, 'maone', 1, 21);

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
(10, 25, 'Phase 1', '1709827096.png', 534345, 423423, 5345534, 453345345, 345453, 345534, '2026-03-31'),
(11, 25, 'Phase 2', '1709827116.png', 23123, 414133, 123231, 231123, 213123, 231231, '2027-05-31'),
(12, 25, 'Phase 3', '1708792042.png', 423452, 52552, 2312412, 1434, 3434, 1221, '2028-02-29'),
(13, 26, 'Phase 1', '1709826870.png', 34234212, 23423, 32432, 3423443, 342234, 234234, '2030-03-31'),
(14, 25, 'Phase 4', '1709508796.png', 3432443, 432423, 3423, 3244, 3423, 23434, '2029-03-30'),
(20, 26, 'Phase 2', '1709905357.jpg', 34234, 325345, 434, 34234, 3434, 3434, '2024-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `phase_media`
--

CREATE TABLE `phase_media` (
  `id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `media_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phase_media`
--

INSERT INTO `phase_media` (`id`, `phase_id`, `project_id`, `media_name`) VALUES
(6, 10, 25, '1708531149_Clearance Certificate.docx');

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
  `plot_or_shop` varchar(4) NOT NULL,
  `plot_attribute_3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plots_inventory`
--

INSERT INTO `plots_inventory` (`id`, `phase_id`, `project_id`, `plot_no`, `plot_size`, `category`, `amount`, `plot_or_shop`, `plot_attribute_3`) VALUES
(79, 10, 25, 'BR801', NULL, '80 Sq. Yds.', 1000000, '', NULL),
(80, 10, 25, 'BR1001', NULL, '100 Sq. Yds.', 1500000, '', NULL),
(81, 10, 25, 'BR1002', NULL, '100 Sq. Yds.', 1500000, '', NULL),
(82, 10, 25, 'BR1201', NULL, '120 Sq. Yds.', 2000000, '', NULL),
(83, 10, 25, 'BR1202', NULL, '120 Sq. Yds.', 2000000, '', NULL),
(84, 10, 25, 'BR1203', NULL, '120 Sq. Yds.', 2000000, '', NULL),
(85, 10, 25, 'BR2001', NULL, '200 Sq. Yds.', 4000000, '', NULL),
(86, 10, 25, 'BR2002', NULL, '200 Sq. Yds.', 4000000, '', NULL),
(87, 10, 25, 'BR2003', NULL, '200 Sq. Yds.', 4000000, '', NULL),
(88, 10, 25, 'BR2004', NULL, '200 Sq. Yds.', 4000000, '', NULL),
(89, 11, 25, 'BR2801', NULL, '80 Sq. Yds.', 142341, '', NULL),
(90, 11, 25, 'BR2802', NULL, '80 Sq. Yds.', 142341, '', NULL),
(91, 11, 25, 'BR2803', NULL, '80 Sq. Yds.', 142341, '', NULL),
(92, 11, 25, 'BR21001', NULL, '100 Sq. Yds.', 41413, '', NULL),
(93, 11, 25, 'BR21002', NULL, '100 Sq. Yds.', 41413, '', NULL),
(94, 11, 25, 'BR21003', NULL, '100 Sq. Yds.', 41413, '', NULL),
(95, 11, 25, 'BR21201', NULL, '120 Sq. Yds.', 44133, '', NULL),
(96, 11, 25, 'BR21202', NULL, '120 Sq. Yds.', 44133, '', NULL),
(97, 11, 25, 'BR21203', NULL, '120 Sq. Yds.', 44133, '', NULL),
(98, 11, 25, 'BR22001', NULL, '200 Sq. Yds.', 343434, '', NULL),
(99, 11, 25, 'BR22002', NULL, '200 Sq. Yds.', 343434, '', NULL),
(100, 11, 25, 'BR22003', NULL, '200 Sq. Yds.', 343434, '', NULL),
(101, 12, 25, 'BR3801', NULL, '80 Sq. Yds.', 3442, '', NULL),
(102, 12, 25, 'BR3802', NULL, '80 Sq. Yds.', 3442, '', NULL),
(103, 12, 25, 'BR3803', NULL, '80 Sq. Yds.', 3442, '', NULL),
(104, 12, 25, 'BR31001', NULL, '100 Sq. Yds.', 342342, '', NULL),
(105, 12, 25, 'BR31002', NULL, '100 Sq. Yds.', 342342, '', NULL),
(106, 12, 25, 'BR31003', NULL, '100 Sq. Yds.', 342342, '', NULL),
(107, 12, 25, 'BR31201', NULL, '120 Sq. Yds.', 234342, '', NULL),
(108, 12, 25, 'BR31202', NULL, '120 Sq. Yds.', 234342, '', NULL),
(109, 12, 25, 'BR31203', NULL, '120 Sq. Yds.', 234342, '', NULL),
(110, 12, 25, 'BR32001', NULL, '200 Sq. Yds.', 34234234, '', NULL),
(111, 12, 25, 'BR32002', NULL, '200 Sq. Yds.', 34234234, '', NULL),
(112, 12, 25, 'BR32003', NULL, '200 Sq. Yds.', 34234234, '', NULL),
(113, 13, 26, 'SP801', NULL, '80 Sq. Yds.', 34232, '', NULL),
(114, 13, 26, 'SP802', NULL, '80 Sq. Yds.', 34232, '', NULL),
(115, 13, 26, 'SP803', NULL, '80 Sq. Yds.', 34232, '', NULL),
(116, 13, 26, 'SP804', NULL, '80 Sq. Yds.', 34232, '', NULL),
(117, 13, 26, 'SP1001', NULL, '100 Sq. Yds.', 342434, '', NULL),
(129, 14, 25, 'BR4801', NULL, '80 Sq. Yds.', 24124, '', NULL),
(130, 14, 25, 'BR4802', NULL, '80 Sq. Yds.', 24124, '', NULL),
(131, 14, 25, 'BR4803', NULL, '80 Sq. Yds.', 24124, '', NULL),
(132, 14, 25, 'BR4804', NULL, '80 Sq. Yds.', 24124, '', NULL),
(133, 14, 25, 'BR4805', NULL, '80 Sq. Yds.', 24124, '', NULL),
(134, 14, 25, 'BR41001', NULL, '100 Sq. Yds.', 43434, '', NULL),
(135, 14, 25, 'BR41002', NULL, '100 Sq. Yds.', 43434, '', NULL),
(136, 14, 25, 'BR41003', NULL, '100 Sq. Yds.', 43434, '', NULL),
(137, 14, 25, 'BR41004', NULL, '100 Sq. Yds.', 43434, '', NULL),
(138, 14, 25, 'BR41201', NULL, '120 Sq. Yds.', 324334, '', NULL),
(139, 14, 25, 'BR41202', NULL, '120 Sq. Yds.', 324334, '', NULL),
(140, 14, 25, 'BR41203', NULL, '120 Sq. Yds.', 324334, '', NULL),
(141, 14, 25, 'BR42001', NULL, '200 Sq. Yds.', 23434432, '', NULL),
(142, 14, 25, 'BR42002', NULL, '200 Sq. Yds.', 23434432, '', NULL),
(194, 20, 26, 'SP21201', NULL, '120 Sq. Yds.', 423423, 'plot', NULL),
(195, 20, 26, 'SP21202', NULL, '120 Sq. Yds.', 423423, 'plot', NULL),
(199, 20, 26, 'SP22001', NULL, '200 Sq. Yds.', 425454545, 'plot', NULL),
(200, 20, 26, 'SP22002', NULL, '200 Sq. Yds.', 425454545, 'plot', NULL),
(201, 20, 26, 'SP22003', NULL, '200 Sq. Yds.', 425454545, 'plot', NULL);

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
  `project_logo` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_title`, `project_description`, `project_logo`, `status`) VALUES
(25, 'Bisma Residency', NULL, '1709510627.png', 'published'),
(26, 'Sunny Paradise', NULL, '1709826842.png', 'published');

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
(2, 'operations-manager', 'Operations Manager'),
(3, 'dealer', 'Dealer'),
(4, 'admin', 'Admin'),
(5, 'sales-manager', 'Sales Manager'),
(6, 'accounts-officer', 'Accounts Officer'),
(7, 'recovery-officer', 'Recovery Officer'),
(8, 'marketing-agent', 'Marketing Agent');

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
  `accounting` int(1) NOT NULL DEFAULT 0,
  `users` int(11) NOT NULL DEFAULT 0,
  `projects` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `username`, `email`, `password`, `mobile_no`, `user_image`, `user_access_level`, `invoicing`, `booking`, `leads`, `accounting`, `users`, `projects`) VALUES
(1, 'admin one', 'adminone', 'admin@gmail.com', 'admin', '1234456', '1707748630.png', 'admin', 1, 1, 1, 1, 1, 1),
(18, 'Bisma Imran', 'bismaim', 'bisma@gmail.com', 'bis123', '13746234', '1706889346.png', 'sales-agent', 0, 1, 1, 0, 0, 0),
(20, 'Ali Khan', 'alikhan', 'ali@gmail.com', 'ali123', '13746234', '1707151694.jpg', 'dealer', 0, 0, 0, 0, 0, 0),
(21, 'Huzaifa', 'huzaifa', 'huzaifa@gmail.com', 'huzaifa@786', '214314', '1707748630.png', 'sales-agent', 0, 1, 1, 0, 0, 0),
(22, 'sales manager one', 'smone', 'smone@gmail.com', 'smone@786', '1374623434', '1709596260.PNG', 'sales-manager', 0, 0, 1, 1, 0, 0),
(23, 'sales manager two', 'smtwo', 'smtwo@gmail.com', 'smtwo@786', '21423423', '1709596294.jpg', 'sales-manager', 0, 0, 1, 1, 0, 0),
(24, 'marketing agent', 'maone', 'ma@gmail.com', 'maone@786', '137462341', '1709604684.png', 'marketing-agent', 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `voucher_type` varchar(3) DEFAULT NULL,
  `voucher_id` varchar(255) DEFAULT NULL,
  `account_code` varchar(50) NOT NULL,
  `debit_amount` decimal(10,0) DEFAULT NULL,
  `credit_amount` decimal(10,0) DEFAULT NULL,
  `description` text NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `added_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `verified_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id`, `date`, `voucher_type`, `voucher_id`, `account_code`, `debit_amount`, `credit_amount`, `description`, `added_by`, `added_on`, `updated_on`, `verified_by`) VALUES
(9, '2024-03-14', 'CPV', '2024/3/9', '1010206', 150000, NULL, 'Computer', 'adminone', '2024-03-13 20:26:02', '2024-03-13 20:26:02', NULL),
(10, '2024-03-14', 'CPV', '2024/3/9', '1020102', NULL, 150000, 'Computer', 'adminone', '2024-03-13 20:26:02', '2024-03-13 20:26:02', NULL),
(11, '2024-08-08', 'CPV', '2024/3/11', '50202', 10000, NULL, 'test', 'adminone', '2024-03-20 18:06:20', '2024-03-20 18:06:20', NULL),
(12, '2024-08-08', 'CPV', '2024/3/11', '1020102', NULL, 10000, 'test', 'adminone', '2024-03-20 18:06:20', '2024-03-20 18:06:20', NULL),
(13, '2024-03-21', 'BPV', '2024/3/13', '4021002', 2000, NULL, 'bank charges testing', 'adminone', '2024-03-25 19:37:36', '2024-03-25 19:37:36', NULL),
(14, '2024-03-21', 'BPV', '2024/3/13', '1020102', NULL, 2000, 'bank charges testing', 'adminone', '2024-03-25 19:37:36', '2024-03-25 19:37:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_media`
--

CREATE TABLE `voucher_media` (
  `id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `media_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher_media`
--

INSERT INTO `voucher_media` (`id`, `voucher_id`, `media_name`) VALUES
(2, 4, '1710276209_NOS_ACCA5023_Component_2_CW_Final_24.pdf'),
(3, 5, '1710356102_Document.docx');

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
-- Indexes for table `acc_coa`
--
ALTER TABLE `acc_coa`
  ADD PRIMARY KEY (`HeadName`);

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
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_media`
--
ALTER TABLE `voucher_media`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `call_logs`
--
ALTER TABLE `call_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `dealer_commission`
--
ALTER TABLE `dealer_commission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `phase_media`
--
ALTER TABLE `phase_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plots_inventory`
--
ALTER TABLE `plots_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `voucher_media`
--
ALTER TABLE `voucher_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
