-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2025 at 06:36 AM
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
('DFT2412002', 'Rumah', 'master/Rumah', 'FTR2412001', 4, 1),
('DFT2412003', 'Komponen Iuran', 'master/KomponenIuran', 'FTR2412001', 1, 1),
('DFT2501001', 'Setting Komponen Iuran', 'master/SettingKomponenIuran', 'FTR2412001', 3, 1),
('DFT2501002', 'Kas Masuk', 'accounting/KasMasuk', 'FTR2501001', 1, 1),
('DFT2501003', 'Kas Keluar', 'accounting/KasKeluar', 'FTR2501001', 2, 1);

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
('DGR2501001', 'GRP2412001', 'DFT1901003', 1, 1, 1, 1, 0, 0),
('DGR2501002', 'GRP2412001', 'DFT1901001', 1, 1, 1, 1, 0, 0),
('DGR2501003', 'GRP2412001', 'DFT2412003', 1, 1, 1, 1, 0, 0),
('DGR2501004', 'GRP2412001', 'DFT2412001', 1, 1, 1, 1, 0, 0),
('DGR2501005', 'GRP2412001', 'DFT2501001', 1, 1, 1, 1, 0, 0),
('DGR2501006', 'GRP2412001', 'DFT2412002', 1, 1, 1, 1, 0, 0),
('DGR2501007', 'GRP2412001', 'DFT2501002', 1, 1, 1, 1, 0, 0),
('DGR2501008', 'GRP2412001', 'DFT2501003', 1, 1, 1, 1, 0, 0);

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
-- Table structure for table `iuran`
--

CREATE TABLE `iuran` (
  `kode` varchar(12) NOT NULL,
  `nominal` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iuran`
--

INSERT INTO `iuran` (`kode`, `nominal`) VALUES
('I2501001', '40000.00'),
('I2501002', '75000.00');

-- --------------------------------------------------------

--
-- Table structure for table `kas_keluar`
--

CREATE TABLE `kas_keluar` (
  `kode` varchar(12) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_bukti` varchar(100) DEFAULT NULL,
  `nominal` decimal(20,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `lampiran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kas_masuk`
--

CREATE TABLE `kas_masuk` (
  `kode` varchar(12) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_bukti` varchar(100) DEFAULT NULL,
  `nominal` decimal(20,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `lampiran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `komponen_iuran`
--

CREATE TABLE `komponen_iuran` (
  `kode` varchar(12) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komponen_iuran`
--

INSERT INTO `komponen_iuran` (`kode`, `nama`) VALUES
('KI2501001', 'Security'),
('KI2501002', 'Sampah'),
('KI2501003', 'Operasional Lain-Lain');

-- --------------------------------------------------------

--
-- Table structure for table `log_tables`
--

CREATE TABLE `log_tables` (
  `id` int(11) NOT NULL,
  `tbl_name` varchar(100) DEFAULT NULL,
  `tbl_id` varchar(20) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `deskripsi` varchar(150) DEFAULT NULL,
  `_action` varchar(30) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `verifikasi_id` varchar(10) DEFAULT NULL,
  `_json` text DEFAULT NULL,
  `kode_import_data` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_tables`
--

INSERT INTO `log_tables` (`id`, `tbl_name`, `tbl_id`, `user_id`, `waktu`, `deskripsi`, `_action`, `keterangan`, `verifikasi_id`, `_json`, `kode_import_data`) VALUES
(1, 'komponen_iuran', 'KI2501002', 'USR2412001', '2025-01-04 10:39:43', 'di-submit oleh ADMINISTRATOR', 'insert', NULL, NULL, NULL, NULL),
(2, 'komponen_iuran', 'KI2501003', 'USR2412001', '2025-01-04 10:39:55', 'di-submit oleh ADMINISTRATOR', 'insert', NULL, NULL, NULL, NULL),
(3, 'komponen_iuran', 'KI2501001', 'USR2412001', '2025-01-04 10:47:08', 'di-edit oleh ADMINISTRATOR', 'update', NULL, NULL, NULL, NULL),
(4, 'komponen_iuran', 'KI2501001', 'USR2412001', '2025-01-04 10:48:23', 'di-edit oleh ADMINISTRATOR', 'update', NULL, NULL, NULL, NULL),
(5, 'komponen_iuran', 'KI2501003', 'USR2412001', '2025-01-04 10:59:13', 'di-delet oleh ADMINISTRATOR', 'delete', NULL, NULL, NULL, NULL),
(6, 'komponen_iuran', 'KI2501003', 'USR2412001', '2025-01-04 10:59:26', 'di-submit oleh ADMINISTRATOR', 'insert', NULL, NULL, NULL, NULL),
(7, 'iuran', 'I2501001', 'USR2412001', '2025-01-04 13:06:02', 'di-submit oleh ADMINISTRATOR', 'insert', NULL, NULL, NULL, NULL),
(8, 'iuran', 'I2501002', 'USR2412001', '2025-01-04 13:06:13', 'di-submit oleh ADMINISTRATOR', 'insert', NULL, NULL, NULL, NULL),
(9, 'iuran', 'I2501001', 'USR2412001', '2025-01-04 13:06:36', 'di-edit oleh ADMINISTRATOR', 'update', NULL, NULL, NULL, NULL),
(10, 'iuran', 'I2501001', 'USR2412001', '2025-01-04 13:06:46', 'di-edit oleh ADMINISTRATOR', 'update', NULL, NULL, NULL, NULL),
(11, 'setting_komponen_iuran', 'I2501002-20250101', 'USR2412001', '2025-01-21 17:54:46', 'di-submit oleh ADMINISTRATOR', 'insert', NULL, NULL, NULL, NULL),
(14, 'setting_komponen_iuran', 'I2501002-20250101', 'USR2412001', '2025-01-22 12:30:30', 'di-delete oleh ADMINISTRATOR', 'delete', 'di-edit ke id I2501002-20250101', NULL, NULL, NULL),
(15, 'setting_komponen_iuran', 'I2501002-20250101', 'USR2412001', '2025-01-22 12:30:30', 'di-edit oleh ADMINISTRATOR', 'update', NULL, NULL, NULL, NULL),
(16, 'setting_komponen_iuran', 'I2501002-20250101', 'USR2412001', '2025-01-22 12:34:27', 'di-delete oleh ADMINISTRATOR', 'delete', 'di-edit ke id I2501002-20250101', NULL, NULL, NULL),
(17, 'setting_komponen_iuran', 'I2501002-20250101', 'USR2412001', '2025-01-22 12:34:27', 'di-edit oleh ADMINISTRATOR', 'update', NULL, NULL, NULL, NULL),
(18, 'setting_komponen_iuran', 'I2501002-20250101', 'USR2412001', '2025-01-22 12:35:29', 'di-delete oleh ADMINISTRATOR', 'delete', 'di-edit ke id I2501002-20250101', NULL, NULL, NULL),
(19, 'setting_komponen_iuran', 'I2501002-20250101', 'USR2412001', '2025-01-22 12:35:29', 'di-edit oleh ADMINISTRATOR', 'update', NULL, NULL, NULL, NULL),
(20, 'setting_komponen_iuran', 'I2501002-20250101', 'USR2412001', '2025-01-22 12:39:34', 'di-delete oleh ADMINISTRATOR', 'delete', NULL, NULL, NULL, NULL),
(21, 'setting_komponen_iuran', 'I2501002-20250101', 'USR2412001', '2025-01-23 11:38:50', 'di-submit oleh ADMINISTRATOR', 'insert', NULL, NULL, NULL, NULL),
(22, 'rumah', 'R2501001', 'USR2412001', '2025-01-23 16:51:45', 'di-submit oleh ADMINISTRATOR', 'insert', NULL, NULL, NULL, NULL),
(23, 'rumah', 'R2501001', 'USR2412001', '2025-01-23 18:18:12', 'di-edit oleh ADMINISTRATOR', 'update', NULL, NULL, NULL, NULL),
(24, 'rumah', 'R2501002', 'USR2412001', '2025-01-23 18:18:38', 'di-submit oleh ADMINISTRATOR', 'insert', NULL, NULL, NULL, NULL),
(25, 'rumah', 'R2501001', 'USR2412001', '2025-01-23 18:18:54', 'di-edit oleh ADMINISTRATOR', 'update', NULL, NULL, NULL, NULL),
(26, 'rumah', 'R2501002', 'USR2412001', '2025-01-23 18:19:12', 'di-delete oleh ADMINISTRATOR', 'delete', NULL, NULL, NULL, NULL),
(27, 'kas_masuk', 'KM2501001', 'USR2412001', '2025-01-24 12:26:09', 'di-submit oleh ADMINISTRATOR', 'insert', NULL, NULL, NULL, NULL),
(28, 'kas_masuk', 'KM2501001', 'USR2412001', '2025-01-24 12:50:39', 'di-edit oleh ADMINISTRATOR', 'update', NULL, NULL, NULL, NULL),
(29, 'kas_masuk', 'KM2501001', 'USR2412001', '2025-01-24 12:51:49', 'di-hapus oleh ADMINISTRATOR', 'delete', NULL, NULL, NULL, NULL),
(30, 'kas_keluar', 'KK2501001', 'USR2412001', '2025-01-24 12:58:40', 'di-submit oleh ADMINISTRATOR', 'insert', NULL, NULL, NULL, NULL),
(31, 'kas_keluar', 'KK2501001', 'USR2412001', '2025-01-24 12:58:54', 'di-edit oleh ADMINISTRATOR', 'update', NULL, NULL, NULL, NULL),
(32, 'kas_keluar', 'KK2501001', 'USR2412001', '2025-01-24 12:59:35', 'di-hapus oleh ADMINISTRATOR', 'delete', NULL, NULL, NULL, NULL);

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
('FTR2412001', 'Master', 1, 2),
('FTR2501001', 'Kas', 1, 3);

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

-- --------------------------------------------------------

--
-- Table structure for table `rumah`
--

CREATE TABLE `rumah` (
  `kode` varchar(12) NOT NULL,
  `no_rumah` varchar(10) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `kode_iuran` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rumah`
--

INSERT INTO `rumah` (`kode`, `no_rumah`, `pemilik`, `kode_iuran`) VALUES
('R2501001', 'I-10', 'RYAN SANTOSO', 'I2501002');

-- --------------------------------------------------------

--
-- Table structure for table `setting_komponen_iuran`
--

CREATE TABLE `setting_komponen_iuran` (
  `kode_iuran` varchar(12) DEFAULT NULL,
  `tgl_berlaku` date DEFAULT NULL,
  `kode_komponen_iuran` varchar(12) DEFAULT NULL,
  `nominal` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting_komponen_iuran`
--

INSERT INTO `setting_komponen_iuran` (`kode_iuran`, `tgl_berlaku`, `kode_komponen_iuran`, `nominal`) VALUES
('I2501002', '2025-01-01', 'KI2501001', '30000.00'),
('I2501002', '2025-01-01', 'KI2501002', '20000.00'),
('I2501002', '2025-01-01', 'KI2501003', '25000.00');

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
-- Indexes for table `iuran`
--
ALTER TABLE `iuran`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `kas_keluar`
--
ALTER TABLE `kas_keluar`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `kas_masuk`
--
ALTER TABLE `kas_masuk`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `komponen_iuran`
--
ALTER TABLE `komponen_iuran`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `log_tables`
--
ALTER TABLE `log_tables`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `rumah`
--
ALTER TABLE `rumah`
  ADD PRIMARY KEY (`kode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_khusus`
--
ALTER TABLE `akses_khusus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_tables`
--
ALTER TABLE `log_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
