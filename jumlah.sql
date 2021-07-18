-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2021 at 06:35 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alatlab`
--

-- --------------------------------------------------------

--
-- Table structure for table `jumlah`
--

CREATE TABLE `jumlah` (
  `idalat` int(11) NOT NULL,
  `namaalat` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jumlah`
--

INSERT INTO `jumlah` (`idalat`, `namaalat`, `deskripsi`, `jumlah`) VALUES
(7, 'Monitor', 'Dell', 115),
(8, 'Keyboard', 'Alienware', 7),
(9, 'Laptop', 'lenovo legion 5 pro', 3),
(10, 'RAM', 'Kingston HyperX', 15),
(11, 'Router', 'Huawei', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jumlah`
--
ALTER TABLE `jumlah`
  ADD PRIMARY KEY (`idalat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jumlah`
--
ALTER TABLE `jumlah`
  MODIFY `idalat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
