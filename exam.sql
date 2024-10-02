-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2023 at 01:03 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `faculty_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `status1` varchar(255) NOT NULL,
  `hod_notes` varchar(255) NOT NULL,
  `coursename` varchar(255) NOT NULL,
  `coursecode` varchar(255) NOT NULL,
  `acyear` varchar(255) NOT NULL,
  `exam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `file_name`, `file_path`, `faculty_name`, `branch`, `status1`, `hod_notes`, `coursename`, `coursecode`, `acyear`, `exam`) VALUES
(19, 'ASP.NET.pdf', 'uploads/ASP.NET.pdf', 'Mrs. D. N. Bhoye', 'Information Technology', 'Approved', '-', 'ASP.Net', '6565', '2022-23', 'pt1'),
(21, 'PHP.pdf', 'uploads/PHP.pdf', 'Mrs. M. P. Wakchaure', 'Information Technology', 'Approved', '-', 'PHP', '6756', '2022-23', 'pt1'),
(22, 'IOM.pdf', 'uploads/IOM.pdf', 'Mrs P. R. Raut', 'Information Technology', 'Approved', '-', 'LOS', '6543', '2022-23', 'pt1'),
(23, 'Data analytics Task PDF.pdf', 'uploads/Data analytics Task PDF.pdf', 'Vedant', 'Mechanical Engineering', 'Approved', '-', 'SOM', '1234', '2022-23', 'pt2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
