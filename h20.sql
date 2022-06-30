-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2022 at 07:59 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `h20`
--

-- --------------------------------------------------------

--
-- Table structure for table `addressbook`
--

CREATE TABLE `addressbook` (
  `id` int(20) NOT NULL,
  `custid` bigint(10) NOT NULL,
  `tagName` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mNumber` bigint(10) NOT NULL,
  `pincode` int(6) NOT NULL,
  `gCode` varchar(10) DEFAULT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addressbook`
--

INSERT INTO `addressbook` (`id`, `custid`, `tagName`, `name`, `mNumber`, `pincode`, `gCode`, `address`) VALUES
(24, 9663494174, 'Home', 'Vikram Singh', 9663494174, 585403, '     ', ' Bidar'),
(42, 8050626051, 'House', 'Saad', 8050626051, 585401, '', ' Bidar');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mNumber` bigint(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `userid` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mNumber` bigint(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `addressId` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`userid`, `name`, `mNumber`, `email`, `password`, `addressId`) VALUES
(22, 'Vikram Singh', 9663494174, 'vikram@gmail.com', 'vikram', 24),
(24, 'Saad', 8050626051, 'saad@gamil.com', 'vikram', 42);

-- --------------------------------------------------------

--
-- Table structure for table `fillup`
--

CREATE TABLE `fillup` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` bigint(10) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `pincode` int(6) NOT NULL,
  `gCode` varchar(10) DEFAULT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fillup`
--

INSERT INTO `fillup` (`id`, `name`, `number`, `status`, `pincode`, `gCode`, `address`) VALUES
(1, 'Vikram', 9900278155, 'Active', 585403, 'VG+G45', 'Bidar Chidri'),
(2, 'Vivek Resorces', 8884563542, 'Active', 585401, NULL, 'Bidar Old City');

-- --------------------------------------------------------

--
-- Table structure for table `helpcart`
--

CREATE TABLE `helpcart` (
  `supplieid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `onboardsupply`
--

CREATE TABLE `onboardsupply` (
  `id` int(20) NOT NULL,
  `sellerid` bigint(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` bigint(10) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `pincode` int(6) NOT NULL,
  `capacity` int(10) NOT NULL,
  `multiOrderCount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `onboardsupply`
--

INSERT INTO `onboardsupply` (`id`, `sellerid`, `name`, `number`, `status`, `pincode`, `capacity`, `multiOrderCount`) VALUES
(1, 9972145655, 'Nazrul', 9972145655, 'Active', 585403, 1000, 1),
(2, 9972145655, 'Shaik', 9900278155, 'Deactive', 585403, 5000, 1),
(3, 9972145655, 'shaik', 9900278155, 'Active', 585403, 10000, 1),
(4, 9972145655, 'Rafi', 9663494175, 'Deactive', 585401, 1000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
  `custid` bigint(10) NOT NULL,
  `supid` bigint(10) NOT NULL,
  `supplyid` int(10) NOT NULL,
  `product` varchar(20) NOT NULL,
  `custName` varchar(20) NOT NULL,
  `custNumber` bigint(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `pincode` int(6) NOT NULL,
  `gCode` varchar(10) DEFAULT NULL,
  `amount` bigint(20) NOT NULL,
  `supName` varchar(20) NOT NULL,
  `supNumber` bigint(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `etd` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Placed',
  `rating` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `custid`, `supid`, `supplyid`, `product`, `custName`, `custNumber`, `address`, `pincode`, `gCode`, `amount`, `supName`, `supNumber`, `date`, `etd`, `status`, `rating`) VALUES
(35, 9663494174, 9972145655, 4, '1000', 'Vikram Singh', 9663494174, ' Bidar', 585401, '    ', 308, 'Rafi', 9663494175, '2022-06-29 12:55:21', '8:25 PM', 'Cancelled', 0),
(37, 9663494174, 9972145655, 4, '1000', 'Vikram Singh', 9663494174, ' Bidar', 585401, '    ', 308, 'Rafi', 9663494175, '2022-06-29 12:56:12', '8:26 PM', 'OnWay', 5);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supid` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `mNumber` bigint(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `companyName` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `pincode` int(6) NOT NULL,
  `gCode` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gstNumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supid`, `name`, `email`, `mNumber`, `password`, `companyName`, `status`, `pincode`, `gCode`, `address`, `gstNumber`) VALUES
(1, 'saad', 'saad@gamil.com', 9972145655, 'saad123', NULL, 'Approved', 585403, 'VG+G45', 'old City Bidar', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addressbook`
--
ALTER TABLE `addressbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addressbook_ibfk_1` (`custid`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `mNumber` (`mNumber`),
  ADD KEY `customer_ibfk_1` (`addressId`);

--
-- Indexes for table `fillup`
--
ALTER TABLE `fillup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Indexes for table `onboardsupply`
--
ALTER TABLE `onboardsupply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellerid` (`sellerid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ibfk_1` (`custid`),
  ADD KEY `orders_ibfk_2` (`supid`),
  ADD KEY `supplyid` (`supplyid`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supid`),
  ADD UNIQUE KEY `mNumber` (`mNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addressbook`
--
ALTER TABLE `addressbook`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `fillup`
--
ALTER TABLE `fillup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `onboardsupply`
--
ALTER TABLE `onboardsupply`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addressbook`
--
ALTER TABLE `addressbook`
  ADD CONSTRAINT `addressbook_ibfk_1` FOREIGN KEY (`custid`) REFERENCES `customer` (`mNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `addressbook` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `onboardsupply`
--
ALTER TABLE `onboardsupply`
  ADD CONSTRAINT `onboardsupply_ibfk_1` FOREIGN KEY (`sellerid`) REFERENCES `supplier` (`mNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`custid`) REFERENCES `customer` (`mNumber`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`supid`) REFERENCES `supplier` (`mNumber`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`supplyid`) REFERENCES `onboardsupply` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
