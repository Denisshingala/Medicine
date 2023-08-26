-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2023 at 05:03 PM
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
-- Database: `medicine`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '$2y$10$U04nOT4Ikwy59br.M93bNuySKup1.Wz5/LXxuG.Ev.dSUwrPX.7Ya');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sub_category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `sub_category`) VALUES
(1, 'cat1', NULL),
(2, 'cat2', NULL),
(3, 'cat11', 1),
(4, 'cat12', 1),
(5, 'cat3', NULL),
(11, 'New', 5);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `company_logo` varchar(200) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `owner_photo` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `company_email` varchar(200) NOT NULL,
  `mobile_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `admin_id`, `company_name`, `company_logo`, `owner_name`, `owner_photo`, `address`, `company_email`, `mobile_number`) VALUES
(1, 1, 'Google', '/img/company/1693061940.png', 'Denis Shingala', '/img/company/1692957668.png', 'dfsfsd', 'nouser@gmail.com', '987654321');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `mrp` int(11) NOT NULL,
  `packing_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiry_date` timestamp NULL DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `photo`, `description`, `mrp`, `packing_date`, `expiry_date`, `category_id`, `admin_id`) VALUES
(1, 'Medicine 1', '/img/medicine/1693028017.png', 'This is only test!', 100, '2023-08-25 13:03:12', '2023-08-30 18:30:00', 3, 1),
(3, 'Medicine 2', '/img/medicine/1693029503.png', 'This is medicine 2.', 1000, '2023-08-26 05:58:23', '2023-08-03 18:30:00', 3, 1),
(4, 'Medicine 3', '/img/medicine/1693029547.png', 'This is Medicine 3.', 800, '2023-08-26 05:59:07', '2023-08-22 18:30:00', 4, 1),
(5, 'Medicine 4', '/img/medicine/1693029574.jpeg', 'This is Medicine 4.', 700, '2023-08-26 05:59:34', '2023-08-21 18:30:00', 4, 1),
(6, 'Medicine 5', '/img/medicine/1693029597.jpeg', 'This is Medicine 5.', 1800, '2023-08-26 05:59:57', '2023-09-08 18:30:00', 2, 1),
(7, 'Medicine 6', '/img/medicine/1693029625.jpeg', 'This is medicine 6.', 1200, '2023-08-26 06:00:25', '2023-08-30 18:30:00', 2, 1),
(8, 'Medicine 7', '/img/medicine/1693029653.jpeg', 'This is Medicine 7.', 1654, '2023-08-26 06:00:53', '2023-09-06 18:30:00', 11, 1),
(9, 'Medicine 8', '/img/medicine/1693029693.jpeg', 'This is Medicine 8.', 9800, '2023-08-26 06:01:33', '2023-08-20 18:30:00', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subcategory` (`sub_category`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_email` (`company_email`),
  ADD KEY `fk_admin` (`admin_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_medicine_admin` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_subcategory` FOREIGN KEY (`sub_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `fk_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `fk_medicine_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
