-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2016 at 08:10 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_ID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_ID`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(25, 'bearing'),
(26, 'headtractor'),
(27, 'fordtractor'),
(28, 'oil ring'),
(29, 'yanza');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(3) NOT NULL,
  `sold_to` varchar(50) NOT NULL,
  `TIN` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `business_style` varchar(20) NOT NULL,
  `terms` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_ID` int(10) NOT NULL,
  `delivery_date` varchar(10) NOT NULL,
  `total_price` int(10) NOT NULL,
  `supplier_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_list`
--

CREATE TABLE `delivery_list` (
  `del_id` int(3) NOT NULL,
  `item_category_id` int(3) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_quantity` int(5) NOT NULL,
  `unit_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_list`
--

INSERT INTO `delivery_list` (`del_id`, `item_category_id`, `item_name`, `item_quantity`, `unit_price`) VALUES
(229, 25, '607 zz', 10, 47),
(229, 25, '626 Nachi', 17, 60),
(229, 25, '627', 13, 60),
(229, 25, '609 NTN', 12, 52),
(229, 25, '629NTN', 12, 60),
(229, 25, '6900 EZO', 40, 12),
(229, 25, '1680 Thailand', 10, 10),
(229, 25, '69/2', 14, 120),
(229, 25, '600ZZNSK', 14, 70),
(229, 25, 'A Cleaner Stud', 13, 22),
(229, 25, 'A.C. Butterfly', 10, 60),
(241, 25, 'A.C. Cover', 10, 100),
(241, 25, 'A.C. Cap', 10, 120),
(241, 26, 'UN572', 3, 10000),
(245, 26, 'Isuzu c-190', 2, 5000),
(245, 26, 'Isuzu OH-100', 3, 10000),
(248, 25, 'A.C. Element', 10, 140),
(248, 28, 'Oil Filter Esso', 20, 120),
(248, 28, 'Per 3 esso', 15, 130);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(25) NOT NULL,
  `item_category_id` int(11) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_category_id`, `item_quantity`, `selling_price`) VALUES
(121, '607 zz', 25, 7, 50),
(122, '626 Nachi', 25, 12, 70),
(123, '627', 25, 11, 70),
(124, '609 NTN', 25, 10, 60),
(125, '629NTN', 25, 12, 70),
(126, '6900 EZO', 25, 40, 50),
(127, '1680 Thailand', 25, 1, 20),
(128, '69/2', 25, 9, 130),
(129, '600ZZNSK', 25, 14, 80),
(130, 'A Cleaner Stud', 25, 5, 30),
(131, 'A.C. Butterfly', 25, 6, 70),
(132, 'A.C. Cover', 25, 10, 120),
(133, 'A.C. Cap', 25, 10, 130),
(134, 'UN572', 26, 2, 11000),
(135, 'Isuzu c-190', 26, 2, 6000),
(136, 'Isuzu OH-100', 26, 3, 11000),
(137, 'A.C. Element', 25, 10, 150),
(138, 'Oil Filter Esso', 28, 20, 130),
(139, 'Per 3 esso', 28, 15, 140);

-- --------------------------------------------------------

--
-- Table structure for table `item_list_sold`
--

CREATE TABLE `item_list_sold` (
  `sales_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `item_category_id` int(10) NOT NULL,
  `item_sold_name` varchar(15) NOT NULL,
  `quantity_sold` int(5) NOT NULL,
  `selling_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_list_sold`
--

INSERT INTO `item_list_sold` (`sales_id`, `item_id`, `item_category_id`, `item_sold_name`, `quantity_sold`, `selling_price`) VALUES
(89, 142, 25, '607 zz', 2, 50),
(89, 151, 25, '6000 ZNSK', 3, 80),
(89, 160, 25, '6006 koyo', 1, 90),
(93, 151, 25, '6000 ZNSK', 2, 80),
(93, 156, 25, '6002 Nachi', 5, 40),
(96, 144, 25, '627', 5, 70),
(96, 148, 25, '6900 E20', 1, 50),
(96, 157, 25, '6003 zz Nachi', 2, 70),
(96, 159, 25, '6005', 1, 80),
(96, 149, 25, '1680 Thailand', 2, 40),
(96, 151, 25, '6000 ZNSK', 1, 80),
(103, 150, 25, '69 22', 4, 130),
(103, 145, 25, '609 NTN', 3, 60),
(103, 152, 25, '6001 ZZ Nachi', 1, 50),
(103, 151, 25, '6000 ZNSK', 2, 80),
(104, 143, 25, '262 Nachi', 2, 70),
(104, 148, 25, '6900 E20', 5, 50),
(104, 153, 25, '6001 1NKSE Nach', 1, 50),
(104, 162, 25, '6007 zz Nachi', 1, 130),
(104, 163, 25, '6008 NSK', 1, 180);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `sales_date` varchar(10) NOT NULL,
  `total` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `customer_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `sales_date`, `total`, `amount_paid`, `customer_id`) VALUES
(89, '2016-10-19', 430, 1000, 15),
(93, '2016-10-20', 360, 500, 16),
(96, '2016-10-22', 780, 800, 17),
(103, '2016-10-24', 910, 1000, 19),
(104, '2016-10-27', 750, 1000, 20),
(105, '2016-10-27', 0, 1000, 20),
(106, '2016-10-27', 0, 1000, 20),
(107, '2016-10-27', 0, 1000, 20),
(108, '2016-10-27', 0, 1000, 20),
(109, '2016-10-27', 0, 1000, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_ID`);

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
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_ID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
