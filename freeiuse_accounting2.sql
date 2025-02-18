-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 10:10 AM
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
-- Database: `freeiuse_accounting2`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT 0,
  `brand_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`) VALUES
(6, 'kagoshima', 0, 1),
(7, 'miyazaki', 0, 1),
(8, 'satsuma', 0, 1),
(9, 'kobe', 0, 1),
(10, 'sendai', 0, 1),
(11, '', 0, 0),
(12, 'test', 0, 1),
(13, 'apple', 0, 1),
(14, 'pearson', 0, 1),
(15, 'zara', 0, 1),
(16, 'la mirabella', 0, 1),
(17, 'lasani bedsheet', 0, 1),
(18, 'New Brand', 0, 1),
(19, 'New Brand', 0, 1),
(20, 'New Brand', 0, 1),
(21, 'New Brand', 0, 1),
(22, '', 0, 1),
(23, '', 0, 1),
(24, 'sdcsa', 0, 1),
(25, 'manual', 0, 1),
(26, 'manual', 0, 1),
(27, 'hggggggg', 0, 1),
(28, 'New Test Brand', 0, 1),
(29, 'New Test Brand ', 0, 1),
(30, 'adhisa', 0, 1),
(31, 'vdvd', 0, 1),
(32, 'vdvd', 0, 1),
(33, 'vdvd', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brokers`
--

CREATE TABLE `brokers` (
  `broker_id` int(255) NOT NULL,
  `broker_name` text NOT NULL,
  `broker_phone` text NOT NULL,
  `broker_email` text NOT NULL,
  `broker_address` text NOT NULL,
  `broker_status` int(11) NOT NULL,
  `adddatetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `budget_id` int(11) NOT NULL,
  `budget_name` text NOT NULL,
  `budget_amount` double NOT NULL,
  `budget_type` varchar(300) NOT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `voucher_type` int(11) DEFAULT NULL,
  `budget_date` date NOT NULL,
  `budget_add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`budget_id`, `budget_name`, `budget_amount`, `budget_type`, `voucher_id`, `voucher_type`, `budget_date`, `budget_add_date`) VALUES
(1, 'expense added to ', 100, 'expense', 5, 1, '2023-02-22', '2023-02-22 13:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `budget_category`
--

CREATE TABLE `budget_category` (
  `budget_category_id` int(11) NOT NULL,
  `budget_category_name` text NOT NULL,
  `budget_category_type` varchar(400) NOT NULL,
  `budget_category_add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `category_price` varchar(100) NOT NULL DEFAULT '1',
  `category_purchase` varchar(100) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT 0,
  `categories_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `category_price`, `category_purchase`, `categories_active`, `categories_status`) VALUES
(5, 'a5 striploin', '70', '', 0, 1),
(7, 'electronics', '950', '950', 0, 0),
(8, 'sfb', '20', '17', 0, 1),
(9, 'srt1214ga', '48', '30', 0, 1),
(11, 'mens', '1500', '930', 0, 1),
(12, 'men shirt', '100', '50', 0, 1),
(13, 'men shirt', '0', '0', 0, 1),
(14, 'mens', '1300', '1000', 0, 1),
(15, 'konserven', '3,99', '2,99', 0, 1),
(16, 'bedsheet', '4200', '3600', 0, 1),
(17, 'rooma cotton', '1350', '1100', 0, 1),
(18, 'manual', '1', '', 0, 1),
(19, 'gggg', '1', '', 0, 1),
(20, 'New Test Category', '1', '', 0, 1),
(21, 'New Test Category', '1', '', 0, 1),
(22, 'cbsaj', '1', '', 0, 1),
(23, '565', '1', '', 0, 1),
(24, '565', '1', '', 0, 1),
(25, '565', '1', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `checks`
--

CREATE TABLE `checks` (
  `check_id` int(11) NOT NULL,
  `check_no` varchar(250) DEFAULT NULL,
  `check_bank_name` varchar(250) DEFAULT NULL,
  `check_expiry_date` varchar(100) DEFAULT NULL,
  `check_type` varchar(100) DEFAULT NULL,
  `check_amount` varchar(100) DEFAULT NULL,
  `voucher_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT 0,
  `check_status` int(11) NOT NULL DEFAULT 0,
  `check_location` text DEFAULT NULL,
  `check_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checks`
--

INSERT INTO `checks` (`check_id`, `check_no`, `check_bank_name`, `check_expiry_date`, `check_type`, `check_amount`, `voucher_id`, `customer_id`, `check_status`, `check_location`, `check_timestamp`) VALUES
(1, '1', '', '2022-12-13', '', '25', 0, 7, 0, '', '2022-11-30 07:35:46'),
(2, '123cvc12', 'meezan', '2024-07-10', '', NULL, 12, 0, 0, NULL, '2024-07-16 11:04:31');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` text NOT NULL,
  `address` text DEFAULT NULL,
  `company_phone` varchar(100) NOT NULL,
  `personal_phone` varchar(100) NOT NULL,
  `email` text DEFAULT NULL,
  `stock_manage` int(11) NOT NULL,
  `sale_interface` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `logo`, `address`, `company_phone`, `personal_phone`, `email`, `stock_manage`, `sale_interface`) VALUES
(5, 'Lasani Bedsheets', '1627588470675982bc641fe.png', 'Head Office : P#10 Central Mill Road , Ayub Colony Jhang road Faisalabad Pakistan  ', '123456897', '231546897', 'https://lasanibedsheets.com/', 1, 'barcode');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(2000) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `customer_phone` varchar(13) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_status` int(255) NOT NULL,
  `customer_type` varchar(250) DEFAULT NULL,
  `customer_limit` varchar(10) NOT NULL DEFAULT '0',
  `customer_add_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `customer_status`, `customer_type`, `customer_limit`, `customer_add_date`) VALUES
(1, 'rob teting', 'rob@jetfuelmeals.com', '19548041146', '1221 ns 112th', 1, 'supplier', '0', '2022-03-04 08:07:07'),
(2, 'cash in hand ', '', '0', '', 1, 'bank', '0', '2022-03-04 08:11:08'),
(3, 'test customer', '', '123', '', 1, 'customer', '0', '2022-03-04 08:21:45'),
(4, 'hafiz abdul-rehman', '', '03000552331', 'faisalabad\r\n', 1, 'customer', '0', '2022-03-07 10:13:44'),
(5, 'umar & umair', '', '023777777', 'faisalabad motor maket', 1, 'supplier', '0', '2022-03-07 10:48:50'),
(6, 'test', 'test@gmail.cpo', '1234567', '', 1, 'customer', '0', '2022-03-13 18:30:30'),
(7, 'selfmade', '', '03026005556', '', 1, 'customer', '25', '2022-11-30 07:32:16'),
(8, 'ahsan', '', '03026386238', '', 1, 'customer', '0', '2022-12-08 11:40:12'),
(9, 'ahsan malik', '', '03028926767', '', 1, 'customer', '0', '2022-12-08 11:52:38'),
(10, 'joe\'s welding', 'joe@gmail.com', '5125555555', '12345 walk street\r\nhouston tx, 77049', 1, 'customer', '0', '2023-03-02 21:22:14'),
(11, 'superman steel', 'superman@gmail.com', '123456789', '235 steel lane\r\nkingston jamaica', 1, 'supplier', '0', '2023-03-03 13:42:30'),
(12, 'park place steel', '', '5125555555', '12345 park place lane\r\nhouston texas\r\n', 1, 'supplier', '0', '2023-03-15 15:35:27'),
(13, 'signorama', '', '5555555555', '', 1, 'customer', '0', '2023-03-15 15:44:20'),
(14, 'sharif center', 'hh@gmail.com', '03219496650', 'ravi road', 1, 'supplier', '0', '2023-03-28 08:26:03'),
(15, 'awais sahib', '', '03006691935', 'nayab arts', 1, 'supplier', '0', '2023-08-29 12:32:36'),
(16, 'gus mendez', 'finalcoat2@bigpond.com', '45745745', '8 sash rd', 1, 'customer', '0', '2023-09-14 08:28:18'),
(17, 'ggjh', 'etre@dtr', '1234567', 'kgk', 1, 'supplier', '0', '2024-12-03 06:55:37'),
(18, 'noman ahmed', 'email@gmail.com', '03001234567', 'kohenoor', 1, 'supplier', '0', '2024-12-07 08:16:00'),
(19, 'm-arham waheed', 'arham@gmail.com', '123456789', 'khsjdhf', 1, 'customer', '0', '2024-12-07 09:38:07'),
(20, 'shafiq velvet jecquard bedsheet', '', '03007212759', 'faisalabad', 1, 'supplier', '0', '2024-12-07 11:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `expense_name` varchar(100) DEFAULT NULL,
  `expense_status` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `expense_name`, `expense_status`, `timestamp`) VALUES
(1, 'office expense', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `page` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `nav_edit` int(11) NOT NULL DEFAULT 0,
  `nav_delete` int(11) NOT NULL DEFAULT 0,
  `nav_add` int(11) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `page`, `parent_id`, `icon`, `sort_order`, `nav_edit`, `nav_delete`, `nav_add`, `timestamp`) VALUES
(97, 'accounts', '#', 0, 'fa fa-edit', 4, 1, 1, 1, '2024-08-06 06:28:41'),
(98, 'customers', 'customers.php?type=customer', 97, 'fa fa-edit', 4, 1, 1, 1, '2021-04-13 20:03:33'),
(99, 'banks', 'customers.php?type=bank', 97, 'fa fa-edit', 2, 1, 1, 1, '2021-04-13 20:03:33'),
(100, 'users', 'users.php', 97, 'fa fa-edit', 3, 1, 1, 1, '2021-04-13 20:03:33'),
(101, 'vouchers', '#', 0, 'fa fa-clipboard-list', 3, 0, 0, 0, '2024-08-06 06:29:01'),
(103, 'view vouchers', 'voucher.php?act=list', 101, 'fas fa-clipboard-list', 7, 1, 1, 1, '2021-04-13 20:03:33'),
(104, 'order', '#', 0, 'fas fa-cart-plus', 2, 0, 0, 0, '2024-08-06 06:29:01'),
(105, 'Cash Sale', 'cash_sale.php', 104, 'fas fa-cart-plus', 9, 1, 0, 1, '2021-04-13 20:03:33'),
(107, 'others', '#', 0, 'fa fa-edit', 8, 0, 0, 0, '2021-09-19 13:04:12'),
(108, 'Add Products', 'product.php?act=add', 148, 'fa fa-edit', 12, 1, 1, 1, '2021-09-19 13:01:26'),
(109, 'view products', 'product.php?act=list', 148, 'fa fa-edit', 13, 1, 1, 1, '2021-09-19 13:03:25'),
(110, 'brands', 'brands.php#', 107, 'fa fa-edit', 14, 1, 1, 1, '2021-04-13 20:03:34'),
(111, 'Credit Sale', 'credit_sale.php?credit_type=15days', 104, 'fa fa-edit', 15, 1, 1, 1, '2022-03-07 09:52:12'),
(112, 'purchase', '#', 0, 'fa fa-edit', 1, 0, 0, 0, '2024-08-06 06:29:01'),
(113, 'Cash Purchase', 'cash_purchase.php', 112, 'fa fa-edit', NULL, 1, 1, 1, '2021-04-13 22:33:37'),
(114, 'credit purchase', 'credit_purchase.php', 112, 'fa fa-edit', NULL, 1, 1, 1, '2021-04-13 22:34:31'),
(115, 'Reports', '#', 0, 'fa fa-edit', 6, 0, 0, 0, '2024-08-06 06:28:41'),
(116, 'bank ledger', 'reports.php?type=bank', 115, 'fa fa-edit', NULL, 1, 1, 1, '2021-04-14 21:03:11'),
(117, 'supplier ledger', 'reports.php?type=supplier', 115, 'fa fa-edit', NULL, 1, 0, 0, '2021-04-14 21:03:52'),
(118, 'customer ledger', 'reports.php?type=customer ', 115, 'fa-edit', NULL, 0, 0, 0, '2021-04-14 21:04:27'),
(119, 'view purchases', 'view_purchases.php', 112, 'add_to_queue', NULL, 1, 1, 1, '2021-04-15 21:17:07'),
(120, 'categories', 'categories.php', 107, 'fa fa-edit', NULL, 1, 1, 1, '2021-08-30 09:59:57'),
(121, 'supplier', 'customers.php?type=supplier', 97, 'fa fa-edit', NULL, 1, 1, 1, '2021-04-17 20:36:01'),
(122, 'expense ', 'customers.php?type=expense', 97, 'fa fa-edit', NULL, 1, 1, 1, '2021-04-17 20:41:42'),
(123, 'product purchase report', 'product_purchase_report.php', 115, 'fa fa-edit', NULL, 0, 0, 0, '2021-04-20 18:07:34'),
(125, 'product sale report', 'product_sale_report.php', 115, 'fa fa-edit', NULL, 0, 0, 0, '2021-04-21 19:48:47'),
(127, 'expense report', 'expence_report.php', 115, 'fa fa-edit', NULL, 0, 0, 0, '2021-04-21 20:11:51'),
(128, 'income report', 'income_report.php', 115, 'fa fa-edit', NULL, 0, 0, 0, '2021-04-21 20:12:23'),
(129, 'profit and loss', 'profit_loss.php', 115, 'fa fa-edit', NULL, 0, 0, 0, '2021-04-21 20:12:38'),
(130, 'profit summary', 'profit_summary.php', 115, 'fa fa-edit', NULL, 0, 0, 0, '2021-04-21 20:12:58'),
(131, 'trail balance', 'trail_balance.php#', 115, 'fa fa-edit', 6, 0, 0, 0, '2021-06-02 23:19:37'),
(133, 'expense type', 'expense_type.php', 107, 'local_shipping', NULL, 0, 0, 0, '2021-06-10 19:04:02'),
(134, 'analytics', 'analytics.php', 0, 'local_shipping', 7, 0, 0, 0, '2024-08-06 06:28:41'),
(135, 'Cash orders', 'view_orders.php#', 104, 'local_shipping', NULL, 0, 0, 0, '2021-06-12 16:43:17'),
(136, 'credit orders', 'credit_orders.php', 104, 'local_shipping', NULL, 0, 0, 0, '2021-06-12 16:44:41'),
(137, 'analytics', 'analytics.php', 115, 'local_shipping', NULL, 0, 0, 0, '2021-08-29 17:56:15'),
(138, 'sale reports', 'sale_report.php', 107, 'local_shipping', NULL, 0, 0, 0, '2021-06-15 17:40:17'),
(139, 'purchase reports', 'purchase_report.php', 107, 'local_shipping', NULL, 0, 0, 0, '2021-06-15 17:41:00'),
(140, 'general voucher', 'voucher.php?act=general_voucher', 101, 'local_shipping', NULL, 1, 0, 1, '2021-06-21 19:42:27'),
(141, 'expense voucher', 'voucher.php?act=expense_voucher', 101, 'local_shipping', NULL, 1, 0, 1, '2021-06-21 19:43:15'),
(142, 'single voucher', 'voucher.php?act=single_voucher#', 101, 'local_shipping', NULL, 1, 0, 1, '2021-06-21 19:44:55'),
(143, 'backup & restore', 'backup.php', 107, 'local_shipping', NULL, 1, 0, 1, '2021-06-26 20:36:25'),
(144, 'pending cash bills ', 'pending_bills.php?search_it=all', 115, '', NULL, 0, 0, 0, '2021-08-20 19:43:20'),
(145, 'pending report', 'customerpendingreport.php', 107, '', NULL, 0, 0, 0, '2021-08-20 19:58:40'),
(147, 'check list ', 'check_list.php', 101, '', NULL, 1, 1, 1, '2021-09-19 12:53:19'),
(148, 'products', '#', 0, '', 5, 0, 0, 0, '2024-08-06 06:28:41'),
(149, 'inventory products', 'inventory.php?act=add', 148, '', NULL, 1, 1, 1, '2021-09-19 12:58:26'),
(150, 'inventory p list ', 'inventory.php?act=list', 148, '', NULL, 1, 1, 1, '2021-09-19 12:59:06'),
(151, 'customer due report', 'reports3.php?type=customer#', 107, '', NULL, 0, 0, 0, '2021-11-15 11:47:04'),
(152, 'pos sale', 'cash_salegui.php', 104, '', NULL, 0, 0, 0, '2023-01-15 09:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `transaction_paid_id` int(11) DEFAULT NULL,
  `order_date` date NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `cod` varchar(200) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` varchar(30) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `customer_account` int(11) DEFAULT NULL,
  `payment_account` int(11) DEFAULT NULL,
  `order_status` varchar(20) NOT NULL DEFAULT '0',
  `address` varchar(500) NOT NULL,
  `charges` varchar(200) NOT NULL,
  `note` varchar(1000) NOT NULL,
  `pending_order` varchar(1000) NOT NULL,
  `tracking` varchar(200) NOT NULL,
  `customer_profit` varchar(255) NOT NULL,
  `transaction_id` int(11) NOT NULL DEFAULT 0,
  `broker_id` int(11) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `delaytime` text DEFAULT NULL,
  `freight` text DEFAULT NULL,
  `order_narration` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `credit_sale_type` varchar(20) NOT NULL DEFAULT 'none',
  `vehicle_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `transaction_paid_id`, `order_date`, `bill_no`, `client_name`, `client_contact`, `sub_total`, `vat`, `total_amount`, `discount`, `cod`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `customer_account`, `payment_account`, `order_status`, `address`, `charges`, `note`, `pending_order`, `tracking`, `customer_profit`, `transaction_id`, `broker_id`, `type`, `delaytime`, `freight`, `order_narration`, `timestamp`, `credit_sale_type`, `vehicle_no`) VALUES
(1, 0, '2024-12-12', '', 'm-arham waheed', '123456789', '', '', '5000', '0', '', '5000', '0', '5000', 'credit_sale', 0, 19, 2, '1', '', '', '', '', '', '', 2, NULL, NULL, NULL, '', '', '2024-12-12 10:17:53', '15days', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `product_detail` text DEFAULT NULL,
  `quantity` double NOT NULL,
  `rate` double NOT NULL,
  `total` double NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT 0,
  `discount` varchar(255) DEFAULT NULL,
  `gauge` text DEFAULT NULL,
  `width` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `product_detail`, `quantity`, `rate`, `total`, `order_item_status`, `discount`, `gauge`, `width`) VALUES
(1, 1, 12, 'sdwew', 100, 50, 5000, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `privileges_id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nav_id` int(11) NOT NULL,
  `nav_url` text NOT NULL,
  `addby` text NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nav_add` int(11) NOT NULL DEFAULT 0,
  `nav_edit` int(11) NOT NULL DEFAULT 0,
  `nav_delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`privileges_id`, `user_id`, `nav_id`, `nav_url`, `addby`, `date_time`, `nav_add`, `nav_edit`, `nav_delete`) VALUES
(332, 1, 98, 'customers.php?type=customer', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 1),
(333, 1, 99, 'customers.php?type=bank', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 1),
(334, 1, 100, 'users.php', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 1),
(335, 1, 102, 'voucher.php?act=add', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 0),
(336, 1, 103, 'voucher.php?act=list', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 1),
(337, 1, 105, 'cash_sale.php', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 0),
(338, 1, 106, 'view_orders.php', 'Added By: admin', '2021-04-15 21:26:49', 0, 0, 0),
(339, 1, 108, 'product.php?act=add#', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 0),
(340, 1, 109, 'product.php?act=list', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 1),
(341, 1, 110, 'brands.php#', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 1),
(342, 1, 111, 'credit_sale.php', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 0),
(343, 1, 113, 'cash_purchase.php', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 1),
(344, 1, 114, 'credit_purchase.php', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 1),
(345, 1, 116, 'reports.php?type=bank', 'Added By: admin', '2021-04-15 21:26:49', 1, 0, 1),
(346, 1, 117, 'reports.php?type=supplier', 'Added By: admin', '2021-04-15 21:26:49', 0, 0, 0),
(347, 1, 118, 'reports.php?type=customer ', 'Added By: admin', '2021-04-15 21:26:49', 0, 0, 0),
(348, 1, 119, 'view_purchases.php', 'Added By: admin', '2021-04-15 21:26:49', 0, 0, 0),
(349, 1, 0, '', 'Added By: admin', '2021-04-15 21:26:49', 0, 0, 0),
(386, 2, 98, 'customers.php?type=customer', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 1),
(387, 2, 99, 'customers.php?type=bank', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 1),
(388, 2, 100, 'users.php', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 1),
(389, 2, 102, 'voucher.php?act=add', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 0),
(390, 2, 103, 'voucher.php?act=list', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 1),
(391, 2, 105, 'cash_sale.php', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 0),
(392, 2, 106, 'view_orders.php', 'Added By: admin', '2021-06-04 21:43:16', 0, 0, 0),
(393, 2, 108, 'product.php?act=add#', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 0),
(394, 2, 109, 'product.php?act=list', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 1),
(395, 2, 110, 'brands.php#', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 1),
(396, 2, 111, 'credit_sale.php?credit_type=30days', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 1),
(397, 2, 113, 'cash_purchase.php', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 1),
(398, 2, 114, 'credit_purchase.php', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 0),
(399, 2, 116, 'reports.php?type=bank', 'Added By: admin', '2021-06-04 21:43:16', 0, 0, 0),
(400, 2, 117, 'reports.php?type=supplier', 'Added By: admin', '2021-06-04 21:43:16', 0, 0, 1),
(401, 2, 118, 'reports.php?type=customer ', 'Added By: admin', '2021-06-04 21:43:16', 1, 0, 0),
(402, 2, 119, 'view_purchases.php', 'Added By: admin', '2021-06-04 21:43:16', 0, 0, 0),
(403, 5, 0, 'voucher.php?act=general_voucher', 'Added By: admin', '2022-01-24 06:43:14', 1, 0, 0),
(1323, 5, 98, 'customers.php?type=customer', 'Added By: admin', '2022-01-23 13:40:10', 1, 1, 1),
(1324, 5, 99, 'customers.php?type=bank', 'Added By: admin', '2022-01-23 13:40:10', 1, 1, 1),
(1325, 5, 103, 'users.php', 'Added By: admin', '2022-01-23 13:40:10', 1, 1, 0),
(1326, 5, 105, 'voucher.php?act=list', 'Added By: admin', '2022-01-23 13:40:10', 1, 1, 0),
(1327, 5, 108, 'cash_sale.php', 'Added By: admin', '2022-01-23 13:40:10', 1, 1, 0),
(1328, 5, 109, 'product.php?act=add', 'Added By: admin', '2022-01-23 13:40:10', 1, 1, 0),
(1329, 5, 110, 'product.php?act=list', 'Added By: admin', '2022-01-23 13:40:10', 1, 1, 0),
(1330, 5, 111, 'brands.php#', 'Added By: admin', '2022-01-23 13:40:10', 1, 1, 0),
(1331, 5, 117, 'credit_sale.php?credit_type=15days', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1332, 5, 118, 'cash_purchase.php', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1333, 5, 119, 'credit_purchase.php', 'Added By: admin', '2022-01-23 13:40:10', 1, 0, 0),
(1334, 5, 120, 'reports.php?type=bank', 'Added By: admin', '2022-01-23 13:40:10', 1, 0, 0),
(1335, 5, 121, 'reports.php?type=supplier', 'Added By: admin', '2022-01-23 13:40:10', 1, 0, 0),
(1336, 5, 122, 'reports.php?type=customer ', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1337, 5, 123, 'view_purchases.php', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1338, 5, 125, 'categories.php', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1339, 5, 127, 'customers.php?type=supplier', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1340, 5, 132, 'customers.php?type=expense', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1341, 5, 133, 'product_purchase_report.php', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1342, 5, 135, 'product_sale_report.php', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1343, 5, 136, 'expence_report.php', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1344, 5, 138, 'income_report.php', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1345, 5, 139, 'profit_loss.php', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1346, 5, 140, 'profit_summary.php', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1347, 5, 141, 'trail_balance.php#', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1348, 5, 143, 'credit_sale.php?credit_type=30days', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1349, 5, 144, 'expense_type.php', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1350, 5, 146, 'analytics.php', 'Added By: admin', '2022-01-23 13:40:10', 1, 0, 0),
(1351, 5, 147, 'view_orders.php#', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1352, 5, 149, 'credit_orders.php', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1353, 5, 150, 'analytics.php', 'Added By: admin', '2022-01-23 13:40:10', 1, 0, 0),
(1354, 5, 151, 'sale_report.php', 'Added By: admin', '2022-01-23 13:40:10', 1, 0, 0),
(1355, 5, 0, 'purchase_report.php', 'Added By: admin', '2022-01-23 13:40:10', 0, 0, 0),
(1400, 6, 98, 'customers.php?type=customer', 'Added By: admin', '2024-12-11 12:09:26', 1, 0, 0),
(1401, 6, 99, 'customers.php?type=bank', 'Added By: admin', '2024-12-11 12:09:26', 1, 0, 0),
(1402, 6, 103, 'users.php', 'Added By: admin', '2024-12-11 12:09:26', 1, 0, 0),
(1403, 6, 105, 'voucher.php?act=list', 'Added By: admin', '2024-12-11 12:09:26', 1, 0, 0),
(1404, 6, 108, 'cash_sale.php', 'Added By: admin', '2024-12-11 12:09:26', 1, 0, 0),
(1405, 6, 109, 'product.php?act=add', 'Added By: admin', '2024-12-11 12:09:26', 1, 0, 0),
(1406, 6, 110, 'product.php?act=list', 'Added By: admin', '2024-12-11 12:09:26', 1, 0, 0),
(1407, 6, 111, 'brands.php#', 'Added By: admin', '2024-12-11 12:09:26', 1, 0, 0),
(1408, 6, 0, 'credit_sale.php?credit_type=15days', 'Added By: admin', '2024-12-11 12:09:26', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(200) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(250) DEFAULT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity_instock` double NOT NULL,
  `purchased` double NOT NULL,
  `current_rate` double NOT NULL,
  `f_days` text DEFAULT NULL,
  `t_days` text DEFAULT NULL,
  `purchase_rate` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `availability` int(11) DEFAULT 0,
  `alert_at` double DEFAULT 5,
  `weight` varchar(200) NOT NULL,
  `actual_rate` varchar(250) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `product_mm` varchar(100) NOT NULL DEFAULT '0',
  `product_inch` varchar(100) DEFAULT '0',
  `product_meter` varchar(100) NOT NULL DEFAULT '0',
  `adddatetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `inventory` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_code`, `product_image`, `brand_id`, `category_id`, `quantity_instock`, `purchased`, `current_rate`, `f_days`, `t_days`, `purchase_rate`, `status`, `availability`, `alert_at`, `weight`, `actual_rate`, `product_description`, `product_mm`, `product_inch`, `product_meter`, `adddatetime`, `inventory`) VALUES
(1, 'aurdino', '001', '', 3, 1, 784, 0, 450, '470', '470', 0, 0, 1, 5, '', NULL, '', '', '', '', '2022-08-09 13:44:55', 0),
(2, 'aurdino uno', '002', '', 3, 1, 985, 0, 500, '550', '550', 0, 0, 1, 5, '', NULL, '', '', '', '', '2022-08-09 13:44:57', 0),
(3, 'others', '1122', '', 3, 3, 1000000000006, 0, 0, '0', '0', 0, 0, 1, 5, '', NULL, '', '', '', '', '2022-08-09 13:45:00', 0),
(4, 'mitsobishi mr-j3-40a', 'sm400', '16217372866226235fb019b.jpg', 4, 1, 0, 0, 25000, '26000', '27000', 0, 0, 1, 10, '', NULL, '', '', '', '', '2022-08-09 13:44:52', 0),
(5, '25.7 lbs', '10001', '', 6, 5, 4, 0, 100, '0', '0', 0, 1, 1, 10, '', NULL, 'box 10', '0', '', '', '2024-11-28 11:40:33', 0),
(6, '25.7 lbs', '1615664660', '', 0, 0, 0, 0, 100, NULL, NULL, 100, 0, 1, 5, '', NULL, NULL, '0', '0', '0', '2022-08-09 14:07:53', 1),
(7, 'pizaa', '55', '', 9, 5, 5, 0, 0, '0', '0', 0, 1, 1, 5, '', NULL, '', '', '', '', '2024-12-09 15:59:47', 0),
(8, 'pizaa', '767739754', '', 0, 0, 99, 0, 50, NULL, NULL, 50, 1, 1, 5, '', NULL, NULL, '0', '0', '0', '2024-12-11 07:16:02', 1),
(9, 'tissue paper', '6923568302925', '', 6, 5, -3, 0, 500, '0', '0', 0, 1, 1, 5, '', NULL, '', '', '', '', '2023-03-27 11:21:17', 0),
(10, 'ferror room freshner', '5247889714573', '', 6, 5, -2, 0, 120, '120', '120', 0, 1, 1, 5, '', NULL, '', '', '', '', '2024-08-17 10:26:37', 0),
(11, 'maches', '817077998020', '', 6, 5, -2, 0, 5, '5', '5', 0, 1, 1, 5, '', NULL, '', '', '', '', '2023-02-27 17:02:14', 0),
(12, 'joher joshanda', '855434009675', '', 6, 5, 900, 0, 10, '15', '15', 0, 1, 1, 5, '', NULL, '', '', '', '', '2024-12-12 10:17:53', 0),
(13, 'coffee', '7545739575379', '', 6, 5, 1153, 0, 1000, '1500', '1500', 0, 1, 1, 5, '', NULL, 'good', '0302', '7', '3', '2024-12-11 10:55:20', 0),
(14, 'lays', '286436347', '', 7, 5, -1, 0, 0, '0', '0', 0, 1, 1, 5, '', NULL, '', '', '', '', '2023-02-27 17:07:04', 0),
(15, 'Ú©ÙˆÚ©', '67678787876', '', 6, 5, -2, 0, 0, '0', '0', 0, 1, 1, 5, '', NULL, '', '', '', '', '2023-02-27 17:07:04', 0),
(16, 'supreme', '8961014024036', '', 6, 5, 53, 0, 130, '130', '130', 0, 1, 1, 5, '', NULL, '', '', '', '', '2024-12-10 09:27:04', 0),
(17, 'lipton', '8961014030204', '', 7, 5, -8, 0, 20, '20', '20', 0, 1, 1, 12, '', NULL, '', '', '', '', '2023-02-27 17:07:04', 0),
(18, 'sooper', '8964002528011', '', 6, 5, -2, 0, 5, '', '', 0, 1, 1, 50, '', NULL, '', '', '', '', '2023-01-24 08:56:32', 0),
(19, 'macbook pro ', '01', '', 13, 5, -4, 0, 0, '0', '0', 0, 1, 1, 5, '', NULL, 'macbook pro 15\"', '', '', '', '2023-03-02 21:33:32', 0),
(20, 'coffee', '735764359', '', 0, 0, 0, 0, 495, NULL, NULL, 495, 1, 1, 5, '', NULL, NULL, '0', '0', '0', '2023-03-03 13:45:21', 1),
(21, 'electronic devices and circuit', '9789332542600', '199422434963f51dff0abb0.jpg', 14, 7, 0, 0, 950, 'Boylestad', 'Nashelsky', 0, 1, 1, 1, '', NULL, 'the eleventh edition of electronic devices and circuit theory offers students a complete, comprehensive coverage of the subject, focusing on all the essentials they will need to succeed on the job. setting the standard for nearly 30 years, this highly accurate text is supported by strong pedagogy and content that is ideal for new students of this rapidly changing field. this text is an excellent reference work for anyone involved with electronic devices and other circuitry applications, such as electrical and technical engineers.', '', '', '', '2023-02-21 19:41:32', 0),
(22, 'sfb', '821982730', '', 0, 0, 1, 0, 10, NULL, NULL, 10, 1, 1, 5, '', NULL, NULL, '0', '0', '0', '2023-03-03 13:43:33', 1),
(23, 'abc', '1204633536', '', 7, 5, 0, 0, 0, '0', '0', 0, 0, 1, 5, '', NULL, '', '0', '0', '0', '2023-06-20 09:12:51', 1),
(24, 'jeans', '112', '53408111564eca6d88fc77.jpg', 14, 11, -1, 0, 1500, '1500', '1500', 6200, 1, 1, 12, '', NULL, 'jeans for mens ', '15', '24', '1', '2024-02-18 14:42:12', 0),
(25, 'jeans', '113', '', 14, 11, 90, 0, 3000, '5000', '5000', 3100, 1, 1, 5, '', NULL, '', '3', '5', '12', '2023-08-29 07:19:35', 0),
(26, 't-shirt', '123', '139221554364ed891434570.png', 15, 12, 0, 0, 100, '1500', '3000', 28, 1, 1, 100, '', NULL, 'this is best for mens', '2', '3', '5', '2023-08-29 06:28:55', 0),
(27, 't-shirt', '122', '', 15, 13, 9, 0, 1000, '1000', '1000', 0, 1, 1, 5, '', NULL, '', '', '', '', '2024-02-18 14:42:12', 0),
(28, 'mens suiting', '1', '', 15, 14, 50, 0, 1300, '1300', '1300', 0, 1, 1, 5, '', NULL, 'this is for mens', '4', '0', '0', '2023-08-29 14:38:31', 0),
(29, 'fuente de poder msi', 'id001', '', 6, 5, -1, 0, 0, '0', '0', 0, 1, 1, 5, '', NULL, 'fuente de poder para pc ', '', '', '', '2024-08-17 10:26:37', 0),
(30, 'super', '111', '', 12, 8, -1, 0, 8.3, '8.4', '8.5', 0, 1, 1, 5, '', NULL, '', '', '', '', '2024-02-26 07:38:55', 0),
(31, 'geschälte tomaten ', 'gt2650', '171744302465fb5d966b743.png', 16, 15, 0, 0, 3, '', '', 0, 1, 1, 5, '', NULL, 'geschälte tomaten 2650ml dose', '', '', '', '2024-03-20 22:05:10', 0),
(32, 'sheh', 'shshd', '', 7, 12, 0, 0, 4789583, '4791978', '4794373', 2394792, 1, 1, 5, '', NULL, 'do xxx', '55', '55', '855', '2024-03-29 10:10:50', 0),
(33, 'velvet jecquard ', '786', '153093537167542bc14796d.jpg', 17, 16, 50, 0, 4200, '', '', 0, 1, 1, 5, '', NULL, 'smooth fabric pure velvet bedshet', '', '', '', '2024-12-07 11:16:04', 0),
(34, 'rooma cotton', '787', '181700022767542c7862492.jpg', 17, 17, 0, 0, 1350, '0', '0', 0, 1, 1, 5, '', NULL, 'xtra king size bedshet', '', '', '', '2024-12-07 11:07:36', 0),
(35, '454545', '54545', '179427274067580ebfcfa43.png', 18, 8, 0, 0, 45454, '', '', 0, 1, 0, 0, '', NULL, '455', '', '', '', '2024-12-10 09:49:51', 0),
(36, '454545', '54545', '128598147467580f3d8bf18.png', 19, 8, 0, 0, 45454, '', '', 0, 1, 0, 0, '', NULL, '455', '', '', '', '2024-12-10 09:51:57', 0),
(37, '454545', '54545', '5530381786758103182069.png', 20, 8, 0, 0, 45454, '', '', 0, 1, 0, 0, '', NULL, '455', '', '', '', '2024-12-10 09:56:01', 0),
(38, '454545', '54545', '48099447867581074abb14.png', 21, 8, 0, 0, 45454, '', '', 0, 1, 0, 0, '', NULL, '455', '', '', '', '2024-12-10 09:57:08', 0),
(39, '454545', '54545', '429169517675811c81a8c3.png', 22, 8, 0, 0, 45454, '', '', 0, 1, 0, 0, '', NULL, '455', '', '', '', '2024-12-10 10:02:48', 0),
(40, 'test', '545', '5460015956758121c1d997.png', 23, 7, 0, 0, 5454, '', '', 0, 1, 0, 0, '', NULL, '54', '', '', '', '2024-12-10 10:04:12', 0),
(41, 'test', '545', '205321709767581296b9659.png', 6, 7, 0, 0, 5454, '', '', 0, 1, 0, 0, '', NULL, '54', '', '', '', '2024-12-10 10:06:14', 0),
(42, 'test', '545', '1758980506675812ae87b9b.png', 6, 7, 0, 0, 5454, '', '', 0, 1, 0, 0, '', NULL, '54', '', '', '', '2024-12-10 10:06:38', 0),
(43, 'test', '545', '812674587675812c6a92df.png', 24, 7, 0, 0, 5454, '', '', 0, 1, 0, 0, '', NULL, '54', '', '', '', '2024-12-10 10:07:02', 0),
(44, 'test', '545', '684471866675812e292a09.png', 8, 7, 0, 0, 5454, '', '', 0, 1, 0, 0, '', NULL, '54', '', '', '', '2024-12-10 10:07:30', 0),
(45, 'lletst', '8878', '', 25, 18, 0, 0, 4545, '', '', 0, 1, 0, 0, '', NULL, '5445', '', '', '', '2024-12-10 10:24:43', 0),
(46, 'lletst', '8878', '', 26, 7, 0, 0, 4545, '', '', 0, 1, 0, 0, '', NULL, '5445', '', '', '', '2024-12-10 10:32:05', 0),
(47, 'dksjkfwe', '5454', '', 6, 5, 0, 0, 4500, '', '', 0, 1, 1, 5, '', NULL, '', '', '', '', '2024-12-10 11:50:00', 0),
(48, 'jshda', '4545', '', 27, 19, 0, 0, 4500, '', '', 0, 1, 1, 5, '', NULL, '', '', '', '', '2024-12-10 11:52:31', 0),
(49, 'new test product', '1515', '131018489967588fe12b180.png', 28, 20, 0, 0, 1500, '', '', 0, 1, 1, 5, '', NULL, 'dhfids', '', '', '', '2024-12-10 19:00:49', 0),
(50, 'new test brand ', '152152', '14897059726758909bda263.png', 29, 21, 0, 0, 1500, '', '', 0, 1, 1, 5, '', NULL, 'djas', '', '', '', '2024-12-10 19:03:55', 0),
(51, 'sdsadasdasda', '45545', '53880287675892c841bdc.png', 30, 22, 0, 0, 45400, '', '', 0, 1, 1, 5, '', NULL, 'ssd', '', '', '', '2024-12-10 19:13:12', 0),
(52, 'jhdfds', '45', '613890221675929a9ef80d.jpeg', 31, 23, 0, 0, 699999, '', '', 0, 1, 0, 0, '', NULL, 'dfsdfe', '', '', '', '2024-12-11 07:26:11', 0),
(53, 'jhdfds', '12121255', '1545105049675929ea79636.jpeg', 32, 24, 0, 0, 699999, '', '', 0, 1, 0, 0, '', NULL, 'dfsdfe', '', '', '', '2024-12-11 07:26:03', 0),
(54, 'hjhh', '121212', '126332371867593e0b051c3.jpeg', 33, 25, 0, 0, 2000, '', '', 0, 1, 0, 0, '', NULL, 'dfsdfe', '', '', '', '2024-12-11 07:23:55', 0),
(55, 'sfhje', '54', '', 6, 5, 0, 0, 545, '', '', 0, 1, 0, 0, '', NULL, '545', '', '', '', '2024-12-12 07:07:45', 0),
(56, 'sfhje', '54', '', 6, 5, 0, 0, 545, '', '', 0, 1, 0, 0, '', NULL, '545', '', '', '', '2024-12-12 07:08:08', 0),
(57, 'sfhje', '54', '', 6, 5, 0, 0, 545, '', '', 0, 1, 0, 0, '', NULL, '545', '', '', '', '2024-12-12 07:09:04', 0),
(58, 'sdsa', '4555', '', 7, 5, 0, 0, 54545, '', '', 0, 1, 0, 0, '', NULL, '5454', '', '', '', '2024-12-12 07:10:23', 0),
(59, 'dsjds', '454', '', 6, 5, 0, 0, 454, '', '', 0, 1, 0, 0, '', NULL, '45', '', '', '', '2024-12-12 07:10:57', 0),
(60, 'xash', '4555555555', '', 6, 5, 0, 0, 544, '', '', 0, 1, 0, 0, '', NULL, '5454', '', '', '', '2024-12-12 07:12:02', 0),
(61, 'sdgshdes', '4455', '', 6, 5, 0, 0, 45445, '', '', 0, 1, 0, 0, '', NULL, '5556', '', '', '', '2024-12-12 07:13:58', 0),
(62, 'ghsadgas', '5545', '', 6, 5, 0, 0, 4500, '', '', 0, 1, 1, 5455545, '', NULL, '45454', '', '', '', '2024-12-12 07:16:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` varchar(30) DEFAULT NULL,
  `payment_account` int(11) DEFAULT NULL,
  `customer_account` int(11) DEFAULT NULL,
  `payment_status` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `transaction_paid_id` int(11) NOT NULL,
  `purchase_narration` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `purchase_date`, `client_name`, `bill_no`, `client_contact`, `sub_total`, `vat`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_account`, `customer_account`, `payment_status`, `transaction_id`, `transaction_paid_id`, `purchase_narration`, `timestamp`) VALUES
(1, '2024-12-12', 'noman ahmed', '', '03001234567', '', '', '10000', '0', '10000', '0', '10000', 'credit_purchase', 0, 18, 1, 1, 0, '', '2024-12-12 10:03:15');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
  `purchase_item_id` int(255) NOT NULL,
  `purchase_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `product_detail` text DEFAULT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `sale_rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `purchase_item_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchase_item`
--

INSERT INTO `purchase_item` (`purchase_item_id`, `purchase_id`, `product_id`, `product_detail`, `quantity`, `rate`, `sale_rate`, `total`, `purchase_item_status`) VALUES
(1, 1, 12, '', '1000', '10', '10', '10000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `debit` varchar(100) NOT NULL,
  `credit` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `transaction_remarks` text NOT NULL,
  `transaction_add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `transaction_date` text DEFAULT NULL,
  `transaction_type` text DEFAULT NULL,
  `transaction_from` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `debit`, `credit`, `balance`, `customer_id`, `transaction_remarks`, `transaction_add_date`, `transaction_date`, `transaction_type`, `transaction_from`) VALUES
(1, '10000', '0', '', 18, 'purchased on  purchased id#1', '2024-12-12 10:03:15', '2024-12-12', 'credit_purchase', 'purchase'),
(2, '0', '5000', '', 19, 'credit_sale by order id#1', '2024-12-12 10:17:53', '2024-12-12', 'credit_sale', 'invoice');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `user_role` text NOT NULL,
  `status` text NOT NULL,
  `adddatetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `fullname`, `email`, `password`, `address`, `phone`, `user_role`, `status`, `adddatetime`) VALUES
(1, 'admin', 'Ahsan Malik ', 'a.ttraders909@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'fsd', '1234567', 'admin', '1', '2022-12-08 13:38:04'),
(5, 'test', '', 'ali@polybags.com', '81dc9bdb52d04dc20036dbd8313ed055', 'fsd', '03057442934', 'manager', '1', '2022-06-27 19:21:18'),
(6, 'arhamwaheed', '', 'info.arham.org@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'old summumndri road dijkot', '03035672559', 'manager', '1', '2024-12-11 12:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `voucher_id` int(11) NOT NULL,
  `customer_id1` varchar(250) DEFAULT NULL,
  `customer_id2` varchar(250) DEFAULT NULL,
  `addby_user_id` int(11) DEFAULT NULL,
  `editby_user_id` int(11) DEFAULT NULL,
  `voucher_amount` varchar(250) NOT NULL,
  `transaction_id1` varchar(250) DEFAULT NULL,
  `transaction_id2` varchar(250) DEFAULT NULL,
  `voucher_hint` text DEFAULT NULL,
  `voucher_date` varchar(100) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `voucher_type` varchar(100) DEFAULT NULL,
  `voucher_group` varchar(100) DEFAULT NULL,
  `td_check_no` text DEFAULT NULL,
  `voucher_bank_name` varchar(255) DEFAULT NULL,
  `td_check_date` varchar(100) DEFAULT NULL,
  `check_type` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `brokers`
--
ALTER TABLE `brokers`
  ADD PRIMARY KEY (`broker_id`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`budget_id`);

--
-- Indexes for table `budget_category`
--
ALTER TABLE `budget_category`
  ADD PRIMARY KEY (`budget_category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `checks`
--
ALTER TABLE `checks`
  ADD PRIMARY KEY (`check_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`privileges_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD PRIMARY KEY (`purchase_item_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `brokers`
--
ALTER TABLE `brokers`
  MODIFY `broker_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `budget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `budget_category`
--
ALTER TABLE `budget_category`
  MODIFY `budget_category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `checks`
--
ALTER TABLE `checks`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `privileges_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1409;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `purchase_item_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
