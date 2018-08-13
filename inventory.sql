-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2018 at 06:41 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(10) NOT NULL,
  `sn` varchar(15) NOT NULL,
  `barcode` varchar(10) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `kondisi` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `ket` text NOT NULL,
  `tempat` varchar(25) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `sn`, `barcode`, `nama_barang`, `kondisi`, `status`, `ket`, `tempat`, `foto`) VALUES
('B0001', '', 'B000100001', 'Camera', 'Baik', 'Tersedia', 'a', 'Ditempat', ''),
('B0001', '', 'B000100002', 'Camera', 'Baik', 'Tersedia', 'a', 'Ditempat', ''),
('B0001', '', 'B000100003', 'Camera', 'Baik', 'Tersedia', 'a', 'Ditempat', ''),
('B0001', '', 'B000100004', 'Camera', 'Baik', 'Tersedia', 'a', 'Ditempat', ''),
('B0001', '', 'B000100005', 'Camera', 'Baik', 'Tersedia', 'a', 'Ditempat', ''),
('B0002', '', 'B000200001', 'Mic', 'Baik', 'Tersedia', 'aa', 'Ditempat', ''),
('B0002', '', 'B000200002', 'Mic', 'Baik', 'Tersedia', 'aa', 'Ditempat', ''),
('B0002', '', 'B000200003', 'Mic', 'Baik', 'Tersedia', 'aa', 'Ditempat', ''),
('B0002', '', 'B000200004', 'Mic', 'Baik', 'Tersedia', 'aa', 'Ditempat', ''),
('B0002', '', 'B000200005', 'Mic', 'Baik', 'Tersedia', 'aa', 'Ditempat', '');

-- --------------------------------------------------------

--
-- Table structure for table `barangtmp`
--

CREATE TABLE `barangtmp` (
  `kode_pinjam` varchar(20) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `sn` varchar(15) NOT NULL,
  `barcode` varchar(10) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  `kondisi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `kode_pinjam` varchar(15) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `barcode` varchar(10) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  `w_pinjam` datetime NOT NULL,
  `w_kembali` datetime DEFAULT NULL,
  `kep` text NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`kode_pinjam`, `kode_barang`, `barcode`, `id_user`, `w_pinjam`, `w_kembali`, `kep`, `status`) VALUES
('080820180000001', 'B0001', '0001000001', 'K0001', '2018-08-08 15:50:19', '2018-08-09 22:45:56', 'aaa', 'Kembali'),
('080820180000001', 'B0001', '0001000002', 'K0001', '2018-08-08 15:50:19', '2018-08-09 22:45:56', 'aaa', 'Kembali'),
('130820180000002', 'B0001', 'B000100001', 'K0001', '2018-08-13 11:35:39', NULL, 'Liputan', 'Dipinjam'),
('130820180000002', 'B0001', 'B000100002', 'K0001', '2018-08-13 11:35:39', NULL, 'Liputan', 'Dipinjam'),
('130820180000002', 'B0001', 'B000100003', 'K0001', '2018-08-13 11:35:39', NULL, 'Liputan', 'Dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `foto` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `password`, `foto`, `no_hp`, `alamat`, `agama`, `jenis_kelamin`, `level`) VALUES
('admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'a.jpg', '1', 'a', 'Islam', 'Laki-laki', 'Admin'),
('cnn', 'CNN', 'ff7a4157153a8077212c8757fd39b8bd', 'cnn.png', '01293', 'Bandung', 'Islam', 'L', 'Admin'),
('K0001', 'Adnan', 'ee11cbb19052e40b07aac0ca060c23ee', 'K0001-my_last_gift_by_aenea_jones-das4298.jpg', '1029', 'a', 'katolik', 'Laki-laki', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`,`sn`,`barcode`);

--
-- Indexes for table `barangtmp`
--
ALTER TABLE `barangtmp`
  ADD PRIMARY KEY (`kode_pinjam`,`kode_barang`,`sn`,`barcode`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`kode_pinjam`,`kode_barang`,`barcode`,`id_user`),
  ADD KEY `id_kar` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
