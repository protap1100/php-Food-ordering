-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 03:46 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `dbll_order`
--

CREATE TABLE `dbll_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL,
  `customer_name` varchar(140) NOT NULL,
  `customer_contact` varchar(30) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbll_order`
--

INSERT INTO `dbll_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(12, '  Cake', '550.00', 1, '550.00', '0000-00-00 00:00:00', 'Delivered', 'protap', '01952908424', 'admin@gmail.com', 'wqc'),
(13, ' Momo', '550.00', 1, '550.00', '0000-00-00 00:00:00', 'ordered', 'Protap', '01952908424', 'protapb23@gmail.com', 'xZASX'),
(14, ' Burger', '300.00', 1, '300.00', '0000-00-00 00:00:00', 'ordered', 'as', 'as', 'saidurrahman01953@gmail.com', 'sad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(11, 'adminstration', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(2, 'Buger', 'food_category_703.jpg', 'no', 'no'),
(3, 'Menu-Burger', 'food_category_448.jpg', 'yes', 'yes'),
(4, 'Menu-Momo', 'food_category_778.jpg', 'yes', 'yes'),
(5, 'Menu-Pizza', 'food_category_620.jpg', 'yes', 'yes'),
(6, 'Momo', 'food_category_206.jpg', 'yes', 'yes'),
(7, 'Pizza', 'food_category_359.jpg', 'yes', 'yes'),
(8, 'Cake', 'food_category_974.jpg', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(1, 'Burger', 'Chiken Burger With extra Cheeze', '300.00', 'food-name-352.jpg', 3, 'yes', 'yes'),
(3, 'Momo', 'Indian Momo', '550.00', 'food-name-322.jpg', 4, 'yes', 'yes'),
(4, 'Pizza', 'American Pizza with extra Cheeze', '750.00', 'food-name-939.jpg', 5, 'yes', 'yes'),
(5, ' Cake', 'Cake with extra chese', '550.00', 'Food-Name-2393.jpg', 3, 'yes', 'yes'),
(6, ' Banana cake ', 'Banana cake with cream cheese.', '650.00', 'food-name-333.jpg', 8, 'yes', 'yes'),
(7, ' Cheesecake', 'New York baked cheesecake', '950.00', 'Food-Name-8111.jpg', 8, 'yes', 'yes'),
(8, ' Vanella Cake', 'Vanella cake', '1050.00', 'Food-Name-7064.jpg', 8, 'yes', 'yes'),
(10, ' Strawberry cake', 'Strawberry and cream sponge cake', '1350.00', 'Food-Name-7725.jpg', 3, 'yes', 'yes'),
(11, ' Chocolate Bundt Cake', 'Chocolate Bundt Cake with Chocolate Ganache stock', '550.00', 'food-name-30.jpg', 8, 'yes', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbll_order`
--
ALTER TABLE `dbll_order`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbll_order`
--
ALTER TABLE `dbll_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
