-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2021 at 06:53 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `27062021_u`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_name` varchar(250) NOT NULL,
  `brand_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `category_id`, `brand_name`, `brand_status`) VALUES
(1, 1, 'Jayant', 'active'),
(2, 1, 'RE', 'active'),
(3, 1, 'BMW', 'active'),
(4, 2, 'DBI', 'active'),
(5, 3, 'MMC', 'active'),
(6, 3, 'Jugal', 'active'),
(7, 4, 'Elephant', 'active'),
(8, 5, 'Uxcell', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `category_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'Valve', 'active'),
(2, 'Cock', 'active'),
(3, 'Pipe', 'active'),
(4, 'Gun', 'active'),
(5, 'Elbow', 'active'),
(6, 'I.R Packing Set', 'active'),
(7, 'Unknown', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_contact` int(11) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`, `customer_status`) VALUES
(1, 'Margiv', 2147483647, 'margiv@gmail.com', 'B/375 Nandini Park Society, Link road', 'active'),
(2, 'Jay', 1234567890, 'jay@gmail.com', 'abc', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_order`
--

CREATE TABLE `inventory_order` (
  `inventory_order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `inventory_order_total` double(10,2) NOT NULL,
  `inventory_order_date` date NOT NULL,
  `inventory_order_name` varchar(255) NOT NULL,
  `inventory_order_address` text NOT NULL,
  `payment_status` enum('cash','credit') NOT NULL,
  `inventory_order_status` varchar(100) NOT NULL,
  `inventory_order_created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_order`
--

INSERT INTO `inventory_order` (`inventory_order_id`, `user_id`, `inventory_order_total`, `inventory_order_date`, `inventory_order_name`, `inventory_order_address`, `payment_status`, `inventory_order_status`, `inventory_order_created_date`) VALUES
(1, 1, 94.50, '2021-06-16', '1', 'B/375 Nandini Park Society, Link road', 'cash', 'active', '2021-07-06'),
(2, 1, 141.75, '2021-06-16', '1', 'B/375 Nandini Park Society, Link road', 'cash', 'active', '2021-07-06'),
(3, 1, 236.25, '2021-06-16', '1', 'B/375 Nandini Park Society, Link road', 'credit', 'active', '2021-07-07'),
(4, 1, 47.25, '2021-06-14', '1', 'B/375 Nandini Park Society, Link road', 'credit', 'active', '2021-07-07'),
(5, 1, 1407.00, '2021-06-16', '2', 'B/375 Nandini Park Society, Link road', 'cash', 'active', '2021-07-07'),
(8, 1, 47.25, '2021-06-16', 'Jay', 'dvx', 'cash', 'active', '2021-07-26'),
(9, 1, 94.50, '2021-06-14', 'Margiv', 'ABC', 'cash', 'active', '2021-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_order_product`
--

CREATE TABLE `inventory_order_product` (
  `inventory_order_product_id` int(11) NOT NULL,
  `inventory_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `tax` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_order_product`
--

INSERT INTO `inventory_order_product` (`inventory_order_product_id`, `inventory_order_id`, `product_id`, `quantity`, `price`, `tax`) VALUES
(1, 1, 1, 2, 45.00, 5.00),
(2, 2, 1, 3, 45.00, 5.00),
(3, 3, 1, 5, 45.00, 5.00),
(4, 4, 1, 1, 45.00, 5.00),
(5, 5, 9, 5, 250.00, 5.00),
(6, 5, 1, 2, 45.00, 5.00),
(7, 6, 1, 2, 45.00, 5.00),
(8, 7, 1, 1, 45.00, 5.00),
(9, 8, 1, 1, 45.00, 5.00),
(10, 9, 1, 2, 45.00, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `inward`
--

CREATE TABLE `inward` (
  `inward_id` int(100) NOT NULL,
  `inward_date` date NOT NULL,
  `inward_product_id` int(11) NOT NULL,
  `inward_vendor_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_item` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `total_tax` int(11) NOT NULL,
  `total_item_amount` int(11) NOT NULL,
  `peritem_transcost` int(11) NOT NULL,
  `total_transcost` int(11) NOT NULL,
  `total_bill_amount` int(11) NOT NULL,
  `stock_type` enum('Billing','Non Billing') CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inward`
--

INSERT INTO `inward` (`inward_id`, `inward_date`, `inward_product_id`, `inward_vendor_id`, `quantity`, `price_per_item`, `total_price`, `tax`, `total_tax`, `total_item_amount`, `peritem_transcost`, `total_transcost`, `total_bill_amount`, `stock_type`) VALUES
(1, '2021-07-06', 9, 1, 50, 100, 22, 2, 22, 2, 22, 2, 2, ''),
(2, '2021-07-06', 9, 1, 25, 5, 55, 5, 5, 55, 5, 5, 5, ''),
(3, '2021-07-06', 1, 1, 50, 11, 11, 1, 1, 11, 1, 1, 1, ''),
(4, '2021-07-07', 6, 1, 50, 1, 1, 1, 1, 1, 1, 1, 1, ''),
(5, '2021-07-07', 1, 1, 20, 6, 6, 6, 6, 66, 66, 6, 6, ''),
(6, '2021-07-10', 11, 1, 786, 2, 1572, 10, 157, 1729, 200, 200, 1929, ''),
(7, '2021-07-10', 12, 1, 100, 6, 600, 6, 36, 636, 5, 5, 641, ''),
(8, '2021-07-10', 7, 1, 100, 5, 500, 5, 25, 525, 20, 20, 545, ''),
(9, '2021-07-26', 7, 1, 786, 7, 5502, 5, 275, 5777, 22, 22, 5799, '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(300) NOT NULL,
  `product_description` text NOT NULL,
  `product_quantity` int(11) DEFAULT 0,
  `product_unit` varchar(150) NOT NULL,
  `product_base_price` double(10,2) NOT NULL,
  `product_tax` decimal(4,2) NOT NULL,
  `product_minimum_order` double(10,2) NOT NULL,
  `product_enter_by` int(11) NOT NULL,
  `product_status` enum('active','inactive') NOT NULL,
  `product_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `brand_id`, `product_name`, `product_description`, `product_quantity`, `product_unit`, `product_base_price`, `product_tax`, `product_minimum_order`, `product_enter_by`, `product_status`, `product_date`) VALUES
(1, 1, 3, 'BMW Safety Valve', 'BMW Safety Valve', 70, 'Nos', 45.00, '5.00', 0.00, 1, 'active', '2021-07-04'),
(2, 1, 1, 'Jayant Patti Valve', 'Jayant Patti Valve', NULL, 'Nos', 51.00, '7.00', 0.00, 1, 'active', '2021-07-04'),
(3, 1, 2, 'RE Safety Valve', 'RE Safety Valve', NULL, 'Nos', 45.00, '5.00', 0.00, 1, 'active', '2021-07-04'),
(4, 1, 1, 'Jayant Drainage Valve', 'Jayant Drainage Valve', NULL, 'Nos', 55.00, '10.00', 0.00, 1, 'active', '2021-07-04'),
(5, 2, 4, 'DBI 3/8 Cock', 'DBI 3/8 Cock', NULL, 'Nos', 25.00, '5.00', 0.00, 1, 'active', '2021-07-04'),
(6, 2, 4, 'DBI 1/2 Cock', 'DBI 3/8 Cock', 50, 'Nos', 33.00, '3.00', 0.00, 1, 'active', '2021-07-04'),
(7, 3, 6, 'Jugal Copper Pipe', 'Jugal Copper Pipe', 886, 'Meter', 100.00, '10.00', 0.00, 1, 'active', '2021-07-04'),
(8, 3, 5, 'MMC Air Pipe', 'MMC Air Pipe', NULL, 'Meter', 95.00, '5.00', 0.00, 1, 'active', '2021-07-04'),
(9, 4, 7, 'Elephant Air Gun', 'Elephant Air Gun', 75, 'Nos', 250.00, '5.00', 0.00, 1, 'active', '2021-07-04'),
(10, 4, 7, 'Elephant Foam Gun', 'Elephant Foam Gun', NULL, 'Nos', 500.00, '5.00', 0.00, 1, 'active', '2021-07-04'),
(11, 5, 8, 'Uxcell 3/8 Elbow', 'Uxcell 3/8 Elbow', 786, 'Nos', 65.00, '5.00', 0.00, 1, 'active', '2021-07-04'),
(12, 5, 8, 'Uxcell 3/4 Elbow', 'Uxcell 3/4 Elbow', 100, 'Nos', 45.00, '10.00', 0.00, 1, 'active', '2021-07-04');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_type` enum('master','user') NOT NULL,
  `user_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_email`, `user_password`, `user_name`, `user_type`, `user_status`) VALUES
(1, 'envinengg@gmail.com', '$2y$10$0Yo2F.EetL3yhB8l6MNvcOH8AYNS0SuXLOoAQr1qXJa3uPASWV0NC', 'Envin Engg', 'master', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_contact` int(10) NOT NULL,
  `vendor_address` varchar(255) NOT NULL,
  `vendor_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `vendor_name`, `vendor_contact`, `vendor_address`, `vendor_status`) VALUES
(1, 'Vendor1', 1231231239, 'ns l ; ;w kwn ldlkw', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `inventory_order`
--
ALTER TABLE `inventory_order`
  ADD PRIMARY KEY (`inventory_order_id`);

--
-- Indexes for table `inventory_order_product`
--
ALTER TABLE `inventory_order_product`
  ADD PRIMARY KEY (`inventory_order_product_id`);

--
-- Indexes for table `inward`
--
ALTER TABLE `inward`
  ADD PRIMARY KEY (`inward_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_order`
--
ALTER TABLE `inventory_order`
  MODIFY `inventory_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inventory_order_product`
--
ALTER TABLE `inventory_order_product`
  MODIFY `inventory_order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inward`
--
ALTER TABLE `inward`
  MODIFY `inward_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
