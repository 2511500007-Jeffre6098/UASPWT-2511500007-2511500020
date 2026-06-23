-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2026 at 04:01 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` varchar(5) NOT NULL,
  `nm_barang` varchar(30) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `kategori_barang` enum('Makanan','Minuman','Sembako','Perawatan pribadi','Kebutuhan rumah tangga','Lain lain') NOT NULL,
  `stok_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nm_barang`, `harga_barang`, `kategori_barang`, `stok_barang`) VALUES
('B-001', 'Chitato', 12000, 'Makanan', 98),
('B-002', 'Cimory', 7000, 'Minuman', 96),
('B-003', 'Ultramilk', 7000, 'Minuman', 98),
('B-004', 'Loreal Elseve Hair Conditioner', 43000, 'Perawatan pribadi', 39);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `no_pesanan` varchar(10) NOT NULL,
  `kd_barang` varchar(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`no_pesanan`, `kd_barang`, `jumlah`, `total`) VALUES
('P007', 'B-004', 1, 43000),
('P012', 'B-002', 2, 14000),
('P013', 'B-003', 2, 14000),
('P013', 'B-001', 2, 24000),
('P014', 'B-002', 1, 7000),
('P015', 'B-002', 1, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_bayar` varchar(11) NOT NULL,
  `no_pesanan` varchar(10) NOT NULL,
  `nominal` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`no_bayar`, `no_pesanan`, `nominal`, `kembalian`) VALUES
('PB007', 'P007', 50000, 7000),
('PB012', 'P012', 15000, 1000),
('PB013', 'P013', 50000, 12000),
('PB014', 'P014', 10000, 3000),
('PB015', 'P015', 10000, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `no_pesanan` varchar(10) NOT NULL,
  `waktu_pesanan` datetime NOT NULL,
  `total_pesanan` int(11) NOT NULL,
  `username` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`no_pesanan`, `waktu_pesanan`, `total_pesanan`, `username`) VALUES
('P007', '2026-06-20 13:41:58', 43000, 'admin'),
('P012', '2026-06-20 13:49:50', 14000, 'admin'),
('P013', '2026-06-20 14:01:55', 38000, 'admin'),
('P014', '2026-06-20 14:07:09', 7000, 'admin'),
('P015', '2026-06-20 14:10:51', 7000, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no_bayar`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
