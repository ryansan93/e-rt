-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2024 at 09:31 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rt`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_khusus`
--

CREATE TABLE `akses_khusus` (
  `id` int(11) NOT NULL,
  `id_group` varchar(10) DEFAULT NULL,
  `id_detfitur` varchar(10) DEFAULT NULL,
  `akses_khusus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_fitur`
--

CREATE TABLE `detail_fitur` (
  `id_detfitur` varchar(12) NOT NULL,
  `nama_detfitur` varchar(50) DEFAULT NULL,
  `path_detfitur` varchar(50) DEFAULT NULL,
  `id_fitur` varchar(12) DEFAULT NULL,
  `no_urut` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_fitur`
--

INSERT INTO `detail_fitur` (`id_detfitur`, `nama_detfitur`, `path_detfitur`, `id_fitur`, `no_urut`, `status`) VALUES
('DFT1901001', 'User', 'master/User', 'FTR1901001', 3, 1),
('DFT1901002', 'Fitur', 'master/Fitur', 'FTR1901001', 1, 1),
('DFT1901003', 'Group', 'master/Group', 'FTR1901001', 2, 1),
('DFT2412001', 'Iuran', 'master/Iuran', 'FTR2412001', 2, 1),
('DFT2412002', 'Rumah', 'master/Rumah', 'FTR2412001', 3, 1),
('DFT2412003', 'Komponen Iuran', 'master/KomponenIuran', 'FTR2412001', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_group`
--

CREATE TABLE `detail_group` (
  `id_detgroup` varchar(12) NOT NULL,
  `id_group` varchar(12) DEFAULT NULL,
  `id_detfitur` varchar(12) DEFAULT NULL,
  `a_view` tinyint(4) DEFAULT NULL,
  `a_submit` tinyint(4) DEFAULT NULL,
  `a_edit` tinyint(4) DEFAULT NULL,
  `a_delete` tinyint(4) DEFAULT NULL,
  `a_ack` tinyint(4) DEFAULT NULL,
  `a_approve` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_group`
--

INSERT INTO `detail_group` (`id_detgroup`, `id_group`, `id_detfitur`, `a_view`, `a_submit`, `a_edit`, `a_delete`, `a_ack`, `a_approve`) VALUES
('DGR2201001', 'GRP1901001', 'DFT1901001', 1, 1, 1, 1, 0, 0),
('DGR2201002', 'GRP1901001', 'DFT1901002', 1, 1, 1, 1, 0, 0),
('DGR2201003', 'GRP1901001', 'DFT1901003', 1, 1, 1, 1, 0, 0),
('DGR2412001', 'GRP2412001', 'DFT1901003', 1, 1, 1, 1, 0, 0),
('DGR2412002', 'GRP2412001', 'DFT1901001', 1, 1, 1, 1, 0, 0),
('DGR2412003', 'GRP2412001', 'DFT2412003', 1, 1, 1, 1, 0, 0),
('DGR2412004', 'GRP2412001', 'DFT2412001', 1, 1, 1, 1, 0, 0),
('DGR2412005', 'GRP2412001', 'DFT2412002', 1, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_user`
--

CREATE TABLE `detail_user` (
  `id_detuser` varchar(12) NOT NULL,
  `id_user` varchar(12) DEFAULT NULL,
  `aktif_detuser` date DEFAULT NULL,
  `nonaktif_detuser` date DEFAULT NULL,
  `jk_detuser` varchar(2) DEFAULT NULL,
  `email_detuser` varchar(50) DEFAULT NULL,
  `nama_detuser` varchar(50) DEFAULT NULL,
  `username_detuser` varchar(25) DEFAULT NULL,
  `pass_detuser` varchar(150) DEFAULT NULL,
  `telp_detuser` varchar(12) DEFAULT NULL,
  `id_group` varchar(12) DEFAULT NULL,
  `avatar_detuser` varchar(50) DEFAULT NULL,
  `edit_detuser` datetime DEFAULT NULL,
  `useredit_detuser` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_user`
--

INSERT INTO `detail_user` (`id_detuser`, `id_user`, `aktif_detuser`, `nonaktif_detuser`, `jk_detuser`, `email_detuser`, `nama_detuser`, `username_detuser`, `pass_detuser`, `telp_detuser`, `id_group`, `avatar_detuser`, `edit_detuser`, `useredit_detuser`) VALUES
('DUR2311002', 'USR1901002', '2023-11-28', NULL, 'L', '-', 'ROOT', 'ROOT', '$2y$10$7H2SbtqTLxR7AqObydpAKOfuXG77O2OM755Ox3JualFgSPGxJWwqW', '-', 'GRP1901001', NULL, '2023-11-28 10:49:35', 'USR1901002'),
('DUR2412001', 'USR2412001', '2024-12-28', NULL, 'L', '-', 'ADMINISTRATOR', 'ADMINISTRATOR', '$2y$10$Q1Q642hDUUhB2afCap4w/eRR.xFd1f583pHPNq93MYxTvV2O2SvZW', '-', 'GRP2412001', NULL, '2024-12-28 10:52:38', 'USR1901002');

-- --------------------------------------------------------

--
-- Table structure for table `ms_fitur`
--

CREATE TABLE `ms_fitur` (
  `id_fitur` varchar(12) NOT NULL,
  `nama_fitur` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `urut` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_fitur`
--

INSERT INTO `ms_fitur` (`id_fitur`, `nama_fitur`, `status`, `urut`) VALUES
('FTR1901001', 'Root', 1, 1),
('FTR2412001', 'Master', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ms_group`
--

CREATE TABLE `ms_group` (
  `id_group` varchar(12) NOT NULL,
  `nama_group` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_group`
--

INSERT INTO `ms_group` (`id_group`, `nama_group`) VALUES
('GRP1901001', 'ROOT'),
('GRP2412001', 'ADMINISTRATOR');

-- --------------------------------------------------------

--
-- Table structure for table `ms_user`
--

CREATE TABLE `ms_user` (
  `id_user` varchar(12) NOT NULL,
  `username_user` varchar(25) DEFAULT NULL,
  `status_user` tinyint(4) DEFAULT NULL,
  `pass_user` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_user`
--

INSERT INTO `ms_user` (`id_user`, `username_user`, `status_user`, `pass_user`) VALUES
('USR1901002', 'ROOT', 1, '$2y$10$7H2SbtqTLxR7AqObydpAKOfuXG77O2OM755Ox3JualFgSPGxJWwqW'),
('USR2412001', 'ADMINISTRATOR', 1, '$2y$10$Q1Q642hDUUhB2afCap4w/eRR.xFd1f583pHPNq93MYxTvV2O2SvZW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_khusus`
--
ALTER TABLE `akses_khusus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_fitur`
--
ALTER TABLE `detail_fitur`
  ADD PRIMARY KEY (`id_detfitur`);

--
-- Indexes for table `detail_group`
--
ALTER TABLE `detail_group`
  ADD PRIMARY KEY (`id_detgroup`);

--
-- Indexes for table `detail_user`
--
ALTER TABLE `detail_user`
  ADD PRIMARY KEY (`id_detuser`);

--
-- Indexes for table `ms_fitur`
--
ALTER TABLE `ms_fitur`
  ADD PRIMARY KEY (`id_fitur`);

--
-- Indexes for table `ms_group`
--
ALTER TABLE `ms_group`
  ADD PRIMARY KEY (`id_group`);

--
-- Indexes for table `ms_user`
--
ALTER TABLE `ms_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_khusus`
--
ALTER TABLE `akses_khusus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
