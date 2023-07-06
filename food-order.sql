-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 08:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(6, 'asrul septiawan ', 'admin', '6512bd43d9caa6e02c990b0a82652dca'),
(9, 'bebas', 'bebas', 'c4ca4238a0b923820dcc509a6f75849b'),
(10, 'herman', 'herman', 'c4ca4238a0b923820dcc509a6f75849b'),
(11, 'asrul ', 'asrul', '6512bd43d9caa6e02c990b0a82652dca'),
(12, 'asrul', 'asrul', '6512bd43d9caa6e02c990b0a82652dca'),
(13, 'valen', 'valen', 'c4ca4238a0b923820dcc509a6f75849b');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(14, 'NASI GORENG', 'Food_Category_310.jpg', 'Yes', 'Yes'),
(15, 'JUS', 'Food_Category_843.jpg', 'Yes', 'Yes'),
(16, 'NASI AYAM', 'Food_Category_724.jpg', 'Yes', 'Yes'),
(17, 'MINUMAN', 'Food_Category_31.jpg', 'Yes', 'Yes'),
(19, 'CUMI-CUMI', 'Food_Category_993.jpg', 'Yes', 'Yes'),
(20, 'ORAK ARIK', 'Food_Category_446.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(8, 'NASI GORENG + TELUR', 'NASI GORENG TAMBAH TELUR ENAK banget\r\n', 19000, 'Food-name-897.jpg', 14, 'Yes', 'Yes'),
(9, 'NASI ORAK ARIK', 'ORAK ARIK TEMPE', 10000, 'Food-name-1220.jpg', 14, 'Yes', 'Yes'),
(10, 'JUS SEMANGKA', 'JUS DARI SEMANGKA ASLI ', 12000, 'Food-name-5245.jpg', 15, 'Yes', 'Yes'),
(11, 'CAPPUCINO', 'KOPI CAPPUCINO', 10000, 'Food-name-2413.jpg', 17, 'Yes', 'Yes'),
(12, 'AIR MINERAL', 'AIR BIASA AJA', 2000, 'Food-name-7108.jpg', 17, 'Yes', 'Yes'),
(13, 'JUS TOMAT', 'DARI TOMAT ASLI', 7500, 'Food-name-7550.jpg', 15, 'Yes', 'Yes'),
(14, 'AYAM BAKAR + TELUR', 'AYAM BAKAR DITAMBAH TELUR', 20000, 'Food-name-8767.jpg', 16, 'Yes', 'Yes'),
(15, 'AYAM ORAK ARIK', 'ORAK ARIK AYAM', 17000, 'Food-name-4077.jpg', 16, 'Yes', 'Yes'),
(16, 'TELUR ORAK ARIK', 'TELUR ORAK ARIK ', 10000, 'Food-name-5393.jpg', 14, 'Yes', 'Yes'),
(17, 'OSENG CUMI TIRAM', 'CUMI DIOSENG', 20000, 'Food-name-7299.jpg', 19, 'Yes', 'Yes'),
(18, 'ORAK ARIK TELUR DADAR', 'DADAR TELUR DIORAK ARIIK', 7000, 'Food-name-8879.jpg', 20, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'JUS SEMANGKA', 12000, 3, 36000, '2023-06-28 02:51:06', 'Cancelled', 'asrul septiawan d', '082195430791', 'asrullah2002@gmail.com', 'bebas'),
(2, 'JUS SEMANGKA', 12000, 2, 24000, '2023-06-28 02:54:04', 'Delivered', 'asrul septiawan d', '082195430791', 'asrullah2002@gmail.com', 'amikom'),
(3, 'OSENG CUMI TIRAM', 20000, 1, 20000, '2023-06-28 02:59:38', 'Delivered', 'asrul septiawan d', '082195430791', 'asrullah2002@gmail.com', 'bebas'),
(4, 'NASI GORENG + TELUR', 19000, 2, 38000, '2023-07-01 08:31:19', 'Ordered', ' valen', '082195430791', 'jatimcorpo@gmail.com', ' bantul');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
