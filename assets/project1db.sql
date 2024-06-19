-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 11:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project1db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `access_type` varchar(50) NOT NULL,
  `picture` varchar(1000) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `access_type`, `picture`, `username`, `password`) VALUES
(1, 'cyruscantero1', 'super_admin', '', 'cyrus1', '$2y$10$XkiP4h3jZgygZ4gubPcNs.xralJntd7MU4dPwv4LlmUbkeaOG5L1u'),
(2, 'testfullname1', 'admin', '', 'test1', '$2y$10$Ga5ds.M1RHdU4AtQcKUKvuEQ31lf.wyROsHi/JTsYwD9M.MyIGGAq'),
(3, 'testfullname2', 'admin', '', 'test2', '$2y$10$RvA5UsYZ2w3Jvp40jmJ1qu.QWxp2dlrkpj235NgDFwgr.8MuYFXWi'),
(4, 'testfullname3', 'admin', '', 'test3', '$2y$10$2M2v2QTSne2sqNaKWR5Fgeh1TggkrykjOVTAGH92ELTWAaAgd7LJW'),
(5, 'testfullname4', 'admin', '', 'test4', '$2y$10$CZfeW4iY.L9FEpOFrCiaBuzrH5AuDAcQldLrngCr/50GYqC4XeFQK'),
(6, 'testfullname4', 'admin', '', 'test4', '$2y$10$GcnfhISPEu23mTvF4cMcA.3vKNB/N8gULfrqgYFpdfIdmQC1c8gLa'),
(7, 'testfullname5', 'admin', '', 'test5', '$2y$10$hslUd2RR9wK4OrZIy1reGeOi4h8pI9P0N3/AdRYk9xbqdIyofRYCC'),
(8, 'testfullname6', 'admin', '', 'test6', '$2y$10$YUZTehYmoyHX.URDzdyXZu4McR.sPPmReiRPDJf.B0d1XPF6kKq7q'),
(9, 'testfullname7', 'admin', '', 'test7', '$2y$10$y/1JCFtWGG/e5x27sBUuz.7ysYEfYZcSv9y5zEqEA5qFgACvSd6x6'),
(10, 'testfullname8', 'admin', '', 'test8', '$2y$10$MQAlWxMHv496v0kMAW.f/eSgaQfTpI55Y0Xll/63Y.F6FHhBq5H6u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
