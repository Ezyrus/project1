-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 11:32 AM
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
(1, 'cycycyruscantero123', 'super_admin', '', 'cyrus1', '$2y$10$XkiP4h3jZgygZ4gubPcNs.xralJntd7MU4dPwv4LlmUbkeaOG5L1u'),
(2, 'testfullname1', 'admin', '', 'test1', '$2y$10$Ga5ds.M1RHdU4AtQcKUKvuEQ31lf.wyROsHi/JTsYwD9M.MyIGGAq'),
(3, 'testfullname2', 'admin', '', 'test2', '$2y$10$RvA5UsYZ2w3Jvp40jmJ1qu.QWxp2dlrkpj235NgDFwgr.8MuYFXWi'),
(4, 'testfullname3', 'admin', '', 'test3', '$2y$10$2M2v2QTSne2sqNaKWR5Fgeh1TggkrykjOVTAGH92ELTWAaAgd7LJW'),
(5, 'testfullname4', 'admin', '', 'test4', '$2y$10$CZfeW4iY.L9FEpOFrCiaBuzrH5AuDAcQldLrngCr/50GYqC4XeFQK'),
(6, 'testfullname4', 'admin', '', 'test4', '$2y$10$GcnfhISPEu23mTvF4cMcA.3vKNB/N8gULfrqgYFpdfIdmQC1c8gLa'),
(7, 'testfullname5', 'admin', '', 'test5', '$2y$10$hslUd2RR9wK4OrZIy1reGeOi4h8pI9P0N3/AdRYk9xbqdIyofRYCC'),
(8, 'testfullname6', 'admin', '', 'test6', '$2y$10$YUZTehYmoyHX.URDzdyXZu4McR.sPPmReiRPDJf.B0d1XPF6kKq7q'),
(9, 'testfullname7', 'admin', '', 'test7', '$2y$10$y/1JCFtWGG/e5x27sBUuz.7ysYEfYZcSv9y5zEqEA5qFgACvSd6x6'),
(10, 'testfullname8', 'admin', '', 'test8', '$2y$10$MQAlWxMHv496v0kMAW.f/eSgaQfTpI55Y0Xll/63Y.F6FHhBq5H6u'),
(11, 'testfullname9', 'admin', '', 'test9', '$2y$10$di5DcUf5kWVviNPMWNU5JuQuj3BEXp7qcKWiUS7tHseROa0n2r48O'),
(12, 'new name ', 'admin', '', 'maxconsul', '$2y$10$dN3l2g3iLfxd47hqLZh4GeJKQRfgoxs86yEewppQDoJx3iSESTlDi');

-- --------------------------------------------------------

--
-- Table structure for table `dtr`
--

CREATE TABLE `dtr` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dtr`
--

INSERT INTO `dtr` (`id`, `admin_id`, `time_in`, `time_out`) VALUES
(43, 2, '2024-06-20 17:29:40', '0000-00-00 00:00:00'),
(44, 2, '2024-06-20 17:30:38', '2024-06-20 17:30:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dtr`
--
ALTER TABLE `dtr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin-to-dtr_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dtr`
--
ALTER TABLE `dtr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dtr`
--
ALTER TABLE `dtr`
  ADD CONSTRAINT `admin-to-dtr_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
