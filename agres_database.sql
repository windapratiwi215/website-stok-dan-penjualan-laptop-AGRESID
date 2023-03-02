-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2022 at 07:31 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agres_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int(50) NOT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `no_nota` varchar(50) DEFAULT NULL,
  `item` varchar(200) DEFAULT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `cn` varchar(100) DEFAULT NULL,
  `spp` varchar(100) DEFAULT NULL,
  `ket` varchar(200) DEFAULT NULL,
  `modal` varchar(20) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `retur_barang`
--

CREATE TABLE `retur_barang` (
  `id_retur` int(11) NOT NULL,
  `tgl_retur` date DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `sku` varchar(200) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(20) NOT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `no_nota` varchar(100) DEFAULT NULL,
  `item` varchar(200) DEFAULT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `cn` varchar(100) DEFAULT NULL,
  `spp` varchar(100) DEFAULT NULL,
  `ket` varchar(200) DEFAULT NULL,
  `modal` varchar(20) DEFAULT NULL,
  `catatan` varchar(200) DEFAULT NULL,
  `pp1` varchar(50) DEFAULT NULL,
  `pp2` varchar(50) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `id_masuk` int(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_penjualan`
--

CREATE TABLE `tabel_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tgl_terjual` date DEFAULT NULL,
  `kode_toko` varchar(50) DEFAULT NULL,
  `nota_penjualan` varchar(100) DEFAULT NULL,
  `no_nota` varchar(100) DEFAULT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `ket` varchar(200) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_masuk` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_sku`
--

CREATE TABLE `tabel_sku` (
  `id_sku` int(6) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `item` varchar(200) NOT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(4) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `kode_toko` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `kode_toko`) VALUES
(1, 'Legend - Agres 2', 'L-AG2'),
(2, 'Agres', 'A-AG1'),
(3, 'Rhema - Agres 3', 'R-AG3'),
(4, 'Gamer - Gamer 1', 'G-GM1'),
(5, 'Gamer 2', 'GM2'),
(6, 'Rhema 2 - Gamer 3', 'R2-GM3'),
(7, 'Legend 2 - Cyber 2', 'LG2-C2'),
(8, 'Simanjuntak', 'SIMAN');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` enum('master','admin','sales') COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akses` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `jabatan`, `username`, `password`, `status`, `akses`) VALUES
(14, 'Jessica Juliani', 'jeje@gmail.com', 'master', 'jeje123', '123', '1', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `sku` (`sku`),
  ADD KEY `barang_masuk_ibfk_1` (`id_user`);

--
-- Indexes for table `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD PRIMARY KEY (`id_retur`),
  ADD KEY `FOREIGN KEY` (`id_user`,`id_stok`,`sku`),
  ADD KEY `sku` (`sku`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `FOREIGN KEY` (`id_user`) USING BTREE,
  ADD KEY `id_masuk` (`id_masuk`,`sku`),
  ADD KEY `sku` (`sku`);

--
-- Indexes for table `tabel_penjualan`
--
ALTER TABLE `tabel_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `FOREIGN KEY` (`id_user`,`sku`),
  ADD KEY `sku` (`sku`);

--
-- Indexes for table `tabel_sku`
--
ALTER TABLE `tabel_sku`
  ADD PRIMARY KEY (`id_sku`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3476;

--
-- AUTO_INCREMENT for table `retur_barang`
--
ALTER TABLE `retur_barang`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3787;

--
-- AUTO_INCREMENT for table `tabel_penjualan`
--
ALTER TABLE `tabel_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `tabel_sku`
--
ALTER TABLE `tabel_sku`
  MODIFY `id_sku` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5856;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
