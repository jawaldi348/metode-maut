-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2021 at 02:29 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maut`
--

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `kode_kriteria` char(5) NOT NULL,
  `nama_kriteria` varchar(50) DEFAULT NULL,
  `bobot` double DEFAULT NULL,
  `nilai_min` double DEFAULT NULL,
  `nilai_max` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`kode_kriteria`, `nama_kriteria`, `bobot`, `nilai_min`, `nilai_max`) VALUES
('K-001', 'Permukaan Lahan', 0.2, 2, 2),
('K-002', 'Suhu', 0.2, 1, 2),
('K-003', 'Curah Hujan', 0.2, 2, 3),
('K-004', 'Kelembapan', 0.15, 1, 2),
('K-005', 'Drainase', 0.1, 1, 3),
('K-006', 'Salinitas', 0.15, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_tanaman`
--

CREATE TABLE `nilai_tanaman` (
  `kode_nilai` int(11) NOT NULL,
  `kode_tanaman` char(5) DEFAULT NULL,
  `kode_kriteria` char(5) DEFAULT NULL,
  `nilai_tanaman` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_tanaman`
--

INSERT INTO `nilai_tanaman` (`kode_nilai`, `kode_tanaman`, `kode_kriteria`, `nilai_tanaman`) VALUES
(1, 'TA-01', 'K-001', 2),
(2, 'TA-01', 'K-002', 2),
(4, 'TA-01', 'K-003', 3),
(5, 'TA-01', 'K-004', 2),
(6, 'TA-01', 'K-005', 3),
(7, 'TA-01', 'K-006', 3),
(8, 'TA-02', 'K-001', 2),
(9, 'TA-02', 'K-002', 1),
(10, 'TA-02', 'K-003', 2),
(11, 'TA-02', 'K-004', 1),
(12, 'TA-02', 'K-005', 1),
(13, 'TA-02', 'K-006', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tanaman`
--

CREATE TABLE `tanaman` (
  `kode_tanaman` char(5) NOT NULL,
  `nama_tanaman` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tanaman`
--

INSERT INTO `tanaman` (`kode_tanaman`, `nama_tanaman`) VALUES
('TA-01', 'Padi'),
('TA-02', 'Jagung');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level_user` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level_user`) VALUES
(1, 'admin', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `nilai_tanaman`
--
ALTER TABLE `nilai_tanaman`
  ADD PRIMARY KEY (`kode_nilai`),
  ADD KEY `tanaman_nilai` (`kode_tanaman`),
  ADD KEY `kriteria_nilai` (`kode_kriteria`);

--
-- Indexes for table `tanaman`
--
ALTER TABLE `tanaman`
  ADD PRIMARY KEY (`kode_tanaman`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nilai_tanaman`
--
ALTER TABLE `nilai_tanaman`
  MODIFY `kode_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai_tanaman`
--
ALTER TABLE `nilai_tanaman`
  ADD CONSTRAINT `nilai_tanaman_ibfk_1` FOREIGN KEY (`kode_tanaman`) REFERENCES `tanaman` (`kode_tanaman`),
  ADD CONSTRAINT `nilai_tanaman_ibfk_2` FOREIGN KEY (`kode_kriteria`) REFERENCES `kriteria` (`kode_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
