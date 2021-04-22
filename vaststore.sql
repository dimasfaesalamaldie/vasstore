-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2020 at 07:40 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaststore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `role` int(1) NOT NULL,
  `aktif` int(1) NOT NULL,
  `access_token` varchar(123) DEFAULT NULL,
  `auth_key` varchar(123) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama`, `role`, `aktif`, `access_token`, `auth_key`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 2, 1, 'jKDGomSH1sCM3KRg2zooF97hI6MbsNHN', 'ZMPBhIf1t4eboEHRdLE2BIQVv-zgYkll'),
('Ical123', '25d55ad283aa400af464c76d713c07ad', 'Muhammad Ical', 2, 1, 'qDK6mwfqLsdWXYzEk9TBCjEBAV78oZ3s', 'CZLLeiJaLtbeB6sbP4B-hrncmyNJ9Z80'),
('Manager', '1d0258c2440a8d19e716292b231e3190', 'Kunto Haryo', 1, 1, 'Fx13NZCRxnM7IQ4ZvXTJ-TqboF0ftCf_', 'O7tzVT9LbEj2l5nksMyznyz9NUTVBOpb'),
('Rajab123', '25d55ad283aa400af464c76d713c07ad', 'Rajab Linta', 2, 0, 'DoanH7yZqy9UcUMj4J3mJVGhCvHMJ4ab', 'hgbT7_IKO3AnBkji69zLWdbaP5LmO6Sp');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `sku` varchar(50) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `warna` varchar(50) NOT NULL,
  `gender` varchar(16) NOT NULL,
  `harga` double NOT NULL,
  `stock` int(11) DEFAULT 0,
  `leadtime` int(11) DEFAULT 0,
  `biaya_penyimpanan` int(11) NOT NULL,
  `biaya_pemesanan` double DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `dibuat_oleh` varchar(16) NOT NULL,
  `diubah_oleh` varchar(16) DEFAULT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`sku`, `id_kriteria`, `nama`, `keterangan`, `warna`, `gender`, `harga`, `stock`, `leadtime`, `biaya_penyimpanan`, `biaya_pemesanan`, `harga_beli`, `status`, `dibuat_oleh`, `diubah_oleh`, `aktif`) VALUES
('VAN-QF002', 2, 'VANS SK8-HI BLACK/WHITE', '', 'BLACK/WHITE', 'M', 849000, 62, 3, 0, NULL, NULL, 1, 'Ical123', 'Ical123', 1),
('VAN-QJ002', 1, 'VANS AUTENTIC BLACK/BLACK', '', 'BLACK', 'U', 699000, 41, 3, 0, NULL, NULL, 1, 'Ical123', 'Ical123', 1),
('VAN-QL001', 1, 'VANS AUTENTIC BLACK/WHITE', '', 'BLACK & WHITE', 'U', 649000, 50, 3, 0, NULL, NULL, 1, 'Ical123', 'Ical123', 1),
('VAN-QL003', 4, 'VANS ERA NAVY', '', 'NAVY', 'U', 649000, 27, 3, 0, NULL, NULL, 1, 'Ical123', 'Ical123', 1),
('VAN-QM001', 1, 'VANS AUTENTIC NAVY ', '', 'NAVY', 'U', 699000, 27, 3, 0, NULL, NULL, 1, 'Ical123', 'Ical123', 1),
('VAN-RB005', 5, 'VANS SLIP ON BLACK/BLACK', '', 'BLACK', 'U', 699000, 41, 3, 20, 18750, 400000, 2, 'Rajab123', 'Rajab123', 1),
('VAN-RC016', 5, 'VANS SLIP ON BLACK/WHITE', '', 'BLACK/WHITE', 'M', 699000, 25, 3, 20, 18750, 410000, 2, 'Rajab123', 'Rajab123', 1),
('VAN-RF017', 3, 'VANS OLD SKOOL BLACK/WHITE', 'PALING LARIS MANIS', 'BLACK/WHITE', 'U', 749000, 82, 3, 0, NULL, NULL, 1, 'Rajab123', 'Ical123', 1),
('VAN-RL025', 2, 'VANS SK8-HI BLACK/BLACK', '', 'BLACK/BLACK', 'U', 849000, 26, 2, 20, 18750, 600000, 2, 'Rajab123', 'Rajab123', 1),
('VAN-RL028', 1, 'VANS AUTENTIC RED', '', 'RED', 'M', 699000, 46, 3, 0, NULL, NULL, 1, 'Rajab123', 'Rajab123', 1),
('VAN-SC002', 3, 'VANS OLD SKOOL V ', '', 'BLACK', 'U', 649000, 52, 3, 0, 100000, 500000, 1, 'Ical123', 'Ical123', 1),
('VAN-SC004', 5, 'VANS CLASSIC SLIP ON ', '', 'BLACK', 'U', 599000, 21, 3, 20, 18750, 300000, 2, 'Ical123', 'Ical123', 1),
('VAN-SC005', 5, 'CLASSIC SLIP ON CHECKERBOARD', '', 'CHECKERBOARD', 'U', 499000, 49, 1, 0, NULL, NULL, 1, 'Ical123', 'Ical123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_detail` int(11) NOT NULL,
  `no_pembelian` varchar(50) NOT NULL,
  `sku_barang` varchar(50) NOT NULL,
  `size` float NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_detail`, `no_pembelian`, `sku_barang`, `size`, `jumlah`, `harga_satuan`) VALUES
(35, 'BVS0000006', 'VAN-QL001', 11, 5, 549000),
(36, 'BVS0000006', 'VAN-QL001', 10, 7, 549000),
(37, 'BVS0000006', 'VAN-QL001', 9, 20, 549000),
(38, 'BVS0000006', 'VAN-QL001', 8, 18, 549000),
(39, 'BVS0000006', 'VAN-QL001', 7, 10, 549000),
(40, 'BVS0000006', 'VAN-QL001', 6, 7, 549000),
(41, 'BVS0000007', 'VAN-QL003', 11, 2, 549000),
(42, 'BVS0000007', 'VAN-QL003', 10, 3, 549000),
(43, 'BVS0000007', 'VAN-QL003', 9, 15, 549000),
(44, 'BVS0000007', 'VAN-QL003', 8, 9, 549000),
(45, 'BVS0000007', 'VAN-QL003', 7, 5, 549000),
(46, 'BVS0000008', 'VAN-QM001', 12, 3, 599000),
(47, 'BVS0000008', 'VAN-QM001', 10, 5, 599000),
(48, 'BVS0000008', 'VAN-QM001', 9, 15, 599000),
(49, 'BVS0000008', 'VAN-QM001', 8, 6, 599000),
(50, 'BVS0000008', 'VAN-QM001', 7, 3, 599000),
(51, 'BVS0000008', 'VAN-QM001', 6, 3, 599000),
(52, 'BVS0000009', 'VAN-SC002', 9, 25, 549000),
(53, 'BVS0000009', 'VAN-SC002', 10, 9, 549000),
(54, 'BVS0000009', 'VAN-SC002', 8, 14, 549000),
(55, 'BVS0000009', 'VAN-SC002', 7, 10, 549000),
(56, 'BVS0000010', 'VAN-SC004', 7, 4, 499000),
(57, 'BVS0000010', 'VAN-SC004', 8, 5, 499000),
(58, 'BVS0000010', 'VAN-SC004', 9, 12, 499000),
(59, 'BVS0000010', 'VAN-SC004', 10, 2, 499000),
(79, 'BVS0000012', 'VAN-QJ002', 7, 5, 549000),
(80, 'BVS0000012', 'VAN-QJ002', 8, 9, 549000),
(81, 'BVS0000012', 'VAN-QJ002', 9, 17, 549000),
(82, 'BVS0000012', 'VAN-QJ002', 10, 9, 549000),
(83, 'BVS0000012', 'VAN-QJ002', 11, 3, 549000),
(84, 'BVS0000012', 'VAN-QJ002', 12, 2, 549000),
(92, 'BVS0000011', 'VAN-SC005', 7, 8, 399000),
(93, 'BVS0000011', 'VAN-SC005', 8, 12, 399000),
(94, 'BVS0000011', 'VAN-SC005', 9, 26, 399000),
(95, 'BVS0000011', 'VAN-SC005', 10, 14, 399000),
(96, 'BVS0000011', 'VAN-SC005', 11, 8, 399000),
(97, 'BVS0000011', 'VAN-SC005', 12, 4, 399000),
(98, 'BVS0000011', 'VAN-SC005', 6, 5, 399000),
(145, 'BVS0000013', 'VAN-QF002', 7, 6, 749000),
(146, 'BVS0000013', 'VAN-QF002', 8, 10, 749000),
(147, 'BVS0000013', 'VAN-QF002', 9, 25, 749000),
(148, 'BVS0000013', 'VAN-QF002', 10, 15, 749000),
(149, 'BVS0000013', 'VAN-QF002', 6, 9, 749000),
(150, 'BVS0000013', 'VAN-QF002', 11, 7, 749000),
(151, 'BVS0000013', 'VAN-QF002', 12, 12, 749000),
(158, 'BVS0000015', 'VAN-RB005', 7, 5, 599000),
(159, 'BVS0000015', 'VAN-RB005', 8, 8, 599000),
(160, 'BVS0000015', 'VAN-QJ002', 9, 15, 599000),
(161, 'BVS0000014', 'VAN-RL028', 6, 4, 599000),
(162, 'BVS0000014', 'VAN-RL028', 7, 5, 599000),
(163, 'BVS0000014', 'VAN-RL028', 8, 10, 599000),
(164, 'BVS0000014', 'VAN-RL028', 9, 12, 599000),
(165, 'BVS0000014', 'VAN-RL028', 10, 7, 599000),
(166, 'BVS0000014', 'VAN-RL028', 11, 4, 599000),
(167, 'BVS0000016', 'VAN-RC016', 6, 4, 599000),
(168, 'BVS0000016', 'VAN-RC016', 7, 7, 599000),
(169, 'BVS0000016', 'VAN-RC016', 8, 9, 599000),
(170, 'BVS0000016', 'VAN-RC016', 9, 13, 599000),
(171, 'BVS0000016', 'VAN-RC016', 10, 7, 599000),
(172, 'BVS0000017', 'VAN-RF017', 6, 8, 649000),
(173, 'BVS0000017', 'VAN-RF017', 7, 10, 649000),
(174, 'BVS0000017', 'VAN-RF017', 8, 15, 649000),
(175, 'BVS0000017', 'VAN-RF017', 9, 30, 649000),
(176, 'BVS0000017', 'VAN-RF017', 10, 14, 649000),
(177, 'BVS0000017', 'VAN-RF017', 11, 7, 649000),
(178, 'BVS0000017', 'VAN-RF017', 12, 6, 649000),
(182, 'BVS0000018', 'VAN-RL025', 8, 14, 749000),
(183, 'BVS0000018', 'VAN-RL025', 9, 18, 749000),
(184, 'BVS0000018', 'VAN-RL025', 10, 9, 749000),
(186, 'BVS0000019', 'VAN-RF017', 10, 15, 649000),
(191, 'BVS0000020', 'VAN-RB005', 8, 7, 499000),
(192, 'BVS0000020', 'VAN-RB005', 7, 5, 499000),
(193, 'BVS0000020', 'VAN-RB005', 9, 10, 499000),
(202, 'BVS0000021', 'VAN-QM001', 9, 7, 599000),
(203, 'BVS0000021', 'VAN-QM001', 12, 5, 599000),
(204, 'BVS0000021', 'VAN-RF017', 8, 5, 649000),
(205, 'BVS0000021', 'VAN-RF017', 9, 10, 649000),
(206, 'BVS0000021', 'VAN-QL001', 9, 7, 549000),
(207, 'BVS0000022', 'VAN-RB005', 9, 7, 599000),
(208, 'BVS0000022', 'VAN-RB005', 10, 6, 599000),
(209, 'BVS0000022', 'VAN-RB005', 8, 5, 599000),
(210, 'BVS0000022', 'VAN-QF002', 6, 12, 749000),
(211, 'BVS0000022', 'VAN-RB005', 7, 2, 599000),
(212, 'BVS0000022', 'VAN-QF002', 12, 5, 749000),
(213, 'BVS0000023', 'VAN-QF002', 7, 6, 749000),
(214, 'BVS0000023', 'VAN-QF002', 9, 10, 749000),
(215, 'BVS0000023', 'VAN-SC002', 10, 15, 549000),
(216, 'BVS0000023', 'VAN-RL028', 6, 8, 599000),
(217, 'BVS0000023', 'VAN-RL028', 11, 11, 599000),
(218, 'BVS0000023', 'VAN-RF017', 12, 10, 649000),
(219, 'BVS0000024', 'VAN-SC002', 9, 10, 549000),
(220, 'BVS0000024', 'VAN-RL028', 7, 4, 599000),
(221, 'BVS0000024', 'VAN-RL028', 8, 5, 599000),
(222, 'BVS0000024', 'VAN-RF017', 6, 15, 649000),
(230, 'BVS0000025', 'VAN-RF017', 9, 11, 649000),
(231, 'BVS0000025', 'VAN-RF017', 11, 7, 649000),
(232, 'BVS0000025', 'VAN-RF017', 7, 2, 649000),
(233, 'BVS0000025', 'VAN-RC016', 10, 15, 599000),
(242, 'BVS0000026', 'VAN-QL003', 8, 8, 549000),
(243, 'BVS0000026', 'VAN-QL003', 10, 4, 549000),
(244, 'BVS0000026', 'VAN-RB005', 7, 12, 599000),
(245, 'BVS0000026', 'VAN-QL003', 11, 4, 549000),
(246, 'BVS0000027', 'VAN-SC004', 8, 5, 499000),
(247, 'BVS0000027', 'VAN-SC004', 9, 6, 499000),
(248, 'BVS0000027', 'VAN-SC004', 10, 5, 499000),
(249, 'BVS0000027', 'VAN-SC004', 7, 5, 499000),
(250, 'BVS0000028', 'VAN-SC004', 7, 4, 499000),
(251, 'BVS0000028', 'VAN-SC004', 10, 4, 499000),
(252, 'BVS0000029', 'VAN-SC002', 10, 2, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `no_penjualan` varchar(50) NOT NULL,
  `sku_barang` varchar(50) NOT NULL,
  `size` float NOT NULL,
  `jumlah` int(2) NOT NULL,
  `harga_satuan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `no_penjualan`, `sku_barang`, `size`, `jumlah`, `harga_satuan`) VALUES
(3, 'JVS0000001', 'VAN-QL001', 8, 1, 649000),
(4, 'JVS0000002', 'VAN-QL001', 8, 1, 649000),
(13, 'JVS0000003', 'VAN-RF017', 9, 1, 749000),
(14, 'JVS0000003', 'VAN-QF002', 8, 1, 849000),
(15, 'JVS0000004', 'VAN-QL003', 8, 1, 649000),
(16, 'JVS0000005', 'VAN-RL025', 8, 1, 849000),
(17, 'JVS0000005', 'VAN-QM001', 7, 1, 699000),
(18, 'JVS0000006', 'VAN-RL028', 7, 1, 699000),
(19, 'JVS0000006', 'VAN-QJ002', 9, 1, 699000),
(20, 'JVS0000007', 'VAN-RF017', 10, 3, 749000),
(21, 'JVS0000008', 'VAN-RB005', 8, 1, 699000),
(22, 'JVS0000009', 'VAN-QL001', 9, 2, 649000),
(23, 'JVS0000009', 'VAN-RF017', 6, 1, 749000),
(24, 'JVS0000010', 'VAN-RL028', 7, 1, 699000),
(25, 'JVS0000010', 'VAN-RC016', 8, 1, 699000),
(26, 'JVS0000011', 'VAN-QF002', 10, 1, 849000),
(27, 'JVS0000011', 'VAN-QJ002', 9, 2, 699000),
(28, 'JVS0000011', 'VAN-RF017', 7, 2, 749000),
(29, 'JVS0000012', 'VAN-RF017', 6, 1, 749000),
(30, 'JVS0000013', 'VAN-QM001', 9, 1, 699000),
(31, 'JVS0000014', 'VAN-RC016', 8, 2, 699000),
(32, 'JVS0000015', 'VAN-RB005', 7, 1, 699000),
(33, 'JVS0000015', 'VAN-RB005', 8, 1, 699000),
(34, 'JVS0000016', 'VAN-QM001', 8, 1, 699000),
(35, 'JVS0000017', 'VAN-QL003', 7, 2, 649000),
(36, 'JVS0000018', 'VAN-RL028', 8, 1, 699000),
(37, 'JVS0000018', 'VAN-QJ002', 9, 2, 699000),
(38, 'JVS0000019', 'VAN-QF002', 9, 2, 849000),
(39, 'JVS0000019', 'VAN-QM001', 8, 1, 699000),
(40, 'JVS0000019', 'VAN-RL028', 7, 1, 699000),
(41, 'JVS0000020', 'VAN-RL028', 8, 1, 699000),
(44, 'JVS0000022', 'VAN-RL025', 9, 2, 849000),
(45, 'JVS0000023', 'VAN-RF017', 9, 1, 749000),
(46, 'JVS0000024', 'VAN-RF017', 6, 1, 749000),
(47, 'JVS0000025', 'VAN-RL025', 9, 1, 849000),
(48, 'JVS0000026', 'VAN-QL003', 7, 1, 649000),
(49, 'JVS0000027', 'VAN-RF017', 9, 2, 749000),
(50, 'JVS0000028', 'VAN-QM001', 12, 1, 699000),
(51, 'JVS0000029', 'VAN-RL028', 9, 1, 699000),
(52, 'JVS0000029', 'VAN-QF002', 12, 2, 849000),
(53, 'JVS0000030', 'VAN-RF017', 9, 2, 749000),
(54, 'JVS0000030', 'VAN-QL001', 11, 1, 649000),
(55, 'JVS0000030', 'VAN-RF017', 8, 1, 749000),
(56, 'JVS0000031', 'VAN-QJ002', 9, 2, 699000),
(58, 'JVS0000033', 'VAN-RF017', 8, 2, 749000),
(59, 'JVS0000033', 'VAN-RF017', 9, 4, 749000),
(60, 'JVS0000034', 'VAN-QM001', 9, 3, 699000),
(61, 'JVS0000032', 'VAN-RF017', 9, 4, 749000),
(63, 'JVS0000035', 'VAN-QJ002', 9, 2, 699000),
(64, 'JVS0000036', 'VAN-RF017', 8, 2, 749000),
(65, 'JVS0000037', 'VAN-RB005', 8, 1, 699000),
(66, 'JVS0000037', 'VAN-QL001', 9, 1, 649000),
(68, 'JVS0000038', 'VAN-RF017', 9, 2, 749000),
(69, 'JVS0000039', 'VAN-RL028', 8, 2, 699000),
(70, 'JVS0000040', 'VAN-SC002', 9, 5, 649000),
(71, 'JVS0000041', 'VAN-SC004', 9, 6, 599000),
(72, 'JVS0000041', 'VAN-SC004', 8, 1, 599000),
(73, 'JVS0000042', 'VAN-SC005', 9, 4, 499000),
(74, 'JVS0000042', 'VAN-SC002', 7, 2, 649000),
(77, 'JVS0000044', 'VAN-QM001', 12, 1, 699000),
(78, 'JVS0000044', 'VAN-SC005', 9, 4, 499000),
(79, 'JVS0000044', 'VAN-SC004', 7, 1, 599000),
(80, 'JVS0000045', 'VAN-QL001', 9, 2, 649000),
(83, 'JVS0000043', 'VAN-SC002', 9, 2, 649000),
(84, 'JVS0000043', 'VAN-SC004', 10, 1, 599000),
(85, 'JVS0000046', 'VAN-QL001', 9, 2, 649000),
(86, 'JVS0000047', 'VAN-RF017', 8, 3, 749000),
(87, 'JVS0000047', 'VAN-RL028', 9, 2, 699000),
(88, 'JVS0000048', 'VAN-QM001', 12, 1, 699000),
(89, 'JVS0000048', 'VAN-RF017', 9, 5, 749000),
(90, 'JVS0000048', 'VAN-RL025', 8, 3, 849000),
(91, 'JVS0000049', 'VAN-QL003', 9, 4, 649000),
(92, 'JVS0000050', 'VAN-RB005', 8, 3, 699000),
(93, 'JVS0000051', 'VAN-RC016', 9, 3, 699000),
(94, 'JVS0000052', 'VAN-RF017', 8, 3, 749000),
(95, 'JVS0000052', 'VAN-RL028', 6, 2, 699000),
(96, 'JVS0000053', 'VAN-QF002', 9, 3, 849000),
(97, 'JVS0000054', 'VAN-RC016', 9, 1, 699000),
(98, 'JVS0000054', 'VAN-QL003', 10, 1, 649000),
(99, 'JVS0000055', 'VAN-SC002', 9, 2, 649000),
(100, 'JVS0000056', 'VAN-RL025', 8, 2, 849000),
(101, 'JVS0000057', 'VAN-RF017', 10, 2, 749000),
(102, 'JVS0000057', 'VAN-SC005', 8, 2, 499000),
(103, 'JVS0000058', 'VAN-SC002', 9, 1, 649000),
(104, 'JVS0000059', 'VAN-QM001', 9, 1, 699000),
(105, 'JVS0000059', 'VAN-QJ002', 12, 1, 699000),
(106, 'JVS0000060', 'VAN-RF017', 12, 2, 749000),
(107, 'JVS0000060', 'VAN-RF017', 8, 1, 749000),
(108, 'JVS0000061', 'VAN-RF017', 12, 1, 749000),
(109, 'JVS0000061', 'VAN-SC004', 8, 1, 599000),
(110, 'JVS0000062', 'VAN-RB005', 7, 1, 699000),
(111, 'JVS0000063', 'VAN-QF002', 9, 3, 849000),
(112, 'JVS0000063', 'VAN-QF002', 10, 3, 849000),
(113, 'JVS0000064', 'VAN-QF002', 9, 3, 849000),
(114, 'JVS0000065', 'VAN-RL025', 9, 2, 849000),
(115, 'JVS0000066', 'VAN-SC005', 9, 1, 499000),
(116, 'JVS0000066', 'VAN-SC005', 10, 1, 499000),
(117, 'JVS0000067', 'VAN-SC002', 10, 1, 649000),
(118, 'JVS0000068', 'VAN-RF017', 10, 3, 749000),
(119, 'JVS0000069', 'VAN-RF017', 10, 2, 749000),
(120, 'JVS0000069', 'VAN-SC002', 8, 2, 649000),
(121, 'JVS0000070', 'VAN-SC004', 9, 1, 599000),
(122, 'JVS0000071', 'VAN-QF002', 10, 1, 849000),
(123, 'JVS0000072', 'VAN-RL028', 9, 1, 699000),
(124, 'JVS0000073', 'VAN-QF002', 9, 1, 849000),
(125, 'JVS0000074', 'VAN-RF017', 6, 1, 749000),
(126, 'JVS0000075', 'VAN-QL001', 9, 1, 649000),
(127, 'JVS0000076', 'VAN-QF002', 9, 1, 849000),
(128, 'JVS0000077', 'VAN-SC004', 9, 2, 599000),
(131, 'JVS0000079', 'VAN-SC005', 7, 3, 499000),
(132, 'JVS0000078', 'VAN-QL001', 10, 1, 649000),
(133, 'JVS0000078', 'VAN-QL003', 9, 2, 649000),
(134, 'JVS0000080', 'VAN-QM001', 9, 2, 699000),
(135, 'JVS0000081', 'VAN-RF017', 11, 2, 749000),
(136, 'JVS0000081', 'VAN-QF002', 12, 1, 849000),
(138, 'JVS0000083', 'VAN-RF017', 10, 1, 749000),
(139, 'JVS0000083', 'VAN-SC005', 8, 2, 499000),
(140, 'JVS0000083', 'VAN-SC005', 7, 1, 499000),
(143, 'JVS0000082', 'VAN-QL003', 8, 2, 649000),
(144, 'JVS0000084', 'VAN-QF002', 9, 2, 849000),
(145, 'JVS0000085', 'VAN-QF002', 8, 2, 849000),
(146, 'JVS0000085', 'VAN-QL001', 10, 1, 649000),
(149, 'JVS0000086', 'VAN-QF002', 10, 1, 849000),
(150, 'JVS0000086', 'VAN-QF002', 7, 2, 849000),
(151, 'JVS0000087', 'VAN-RB005', 7, 2, 699000),
(152, 'JVS0000088', 'VAN-QJ002', 9, 5, 699000),
(153, 'JVS0000089', 'VAN-RL028', 9, 2, 699000),
(154, 'JVS0000090', 'VAN-RC016', 9, 2, 699000),
(155, 'JVS0000091', 'VAN-QL003', 11, 1, 649000),
(156, 'JVS0000091', 'VAN-RC016', 7, 2, 699000),
(157, 'JVS0000092', 'VAN-RB005', 8, 1, 699000),
(158, 'JVS0000093', 'VAN-RF017', 7, 2, 749000),
(160, 'JVS0000094', 'VAN-RC016', 10, 1, 699000),
(162, 'JVS0000095', 'VAN-QM001', 10, 1, 699000),
(165, 'JVS0000096', 'VAN-RF017', 10, 1, 749000),
(166, 'JVS0000097', 'VAN-QM001', 9, 2, 699000),
(167, 'JVS0000098', 'VAN-RL028', 9, 1, 699000),
(168, 'JVS0000099', 'VAN-QF002', 9, 2, 849000),
(169, 'JVS0000100', 'VAN-RB005', 8, 1, 699000),
(170, 'JVS0000101', 'VAN-QL001', 9, 2, 649000),
(171, 'JVS0000102', 'VAN-SC004', 8, 1, 599000),
(172, 'JVS0000102', 'VAN-SC005', 9, 2, 499000),
(174, 'JVS0000103', 'VAN-SC005', 10, 3, 499000),
(175, 'JVS0000104', 'VAN-QL001', 8, 3, 649000),
(176, 'JVS0000105', 'VAN-QF002', 9, 1, 849000),
(177, 'JVS0000106', 'VAN-RF017', 9, 1, 749000),
(178, 'JVS0000107', 'VAN-QL001', 9, 2, 649000),
(182, 'JVS0000108', 'VAN-RF017', 11, 1, 749000),
(185, 'JVS0000109', 'VAN-QF002', 6, 3, 849000),
(186, 'JVS0000109', 'VAN-QF002', 9, 1, 849000),
(187, 'JVS0000110', 'VAN-RF017', 7, 1, 749000),
(188, 'JVS0000111', 'VAN-QF002', 12, 1, 849000),
(189, 'JVS0000111', 'VAN-QL003', 10, 1, 649000),
(190, 'JVS0000112', 'VAN-QF002', 12, 2, 849000),
(191, 'JVS0000112', 'VAN-RF017', 11, 1, 749000),
(192, 'JVS0000113', 'VAN-RF017', 8, 1, 749000),
(193, 'JVS0000113', 'VAN-QJ002', 9, 2, 699000),
(194, 'JVS0000021', 'VAN-QL001', 9, 2, 649000),
(195, 'JVS0000021', 'VAN-RC016', 8, 1, 699000),
(196, 'JVS0000021', 'VAN-RC016', 6, 1, 699000),
(197, 'JVS0000115', 'VAN-QF002', 9, 1, 849000),
(198, 'JVS0000116', 'VAN-RC016', 10, 3, 699000),
(199, 'JVS0000116', 'VAN-SC002', 9, 3, 649000),
(200, 'JVS0000116', 'VAN-RL028', 8, 2, 699000),
(201, 'JVS0000117', 'VAN-RL025', 8, 3, 849000),
(202, 'JVS0000117', 'VAN-RC016', 9, 2, 699000),
(203, 'JVS0000117', 'VAN-RF017', 12, 2, 749000),
(204, 'JVS0000117', 'VAN-RF017', 6, 2, 749000),
(205, 'JVS0000118', 'VAN-RB005', 9, 1, 699000),
(206, 'JVS0000118', 'VAN-SC002', 10, 2, 649000),
(207, 'JVS0000118', 'VAN-RL028', 11, 2, 699000),
(208, 'JVS0000119', 'VAN-RL025', 9, 1, 849000),
(209, 'JVS0000119', 'VAN-RL025', 8, 2, 849000),
(210, 'JVS0000119', 'VAN-RC016', 6, 1, 699000),
(211, 'JVS0000120', 'VAN-RF017', 12, 1, 749000),
(212, 'JVS0000120', 'VAN-RF017', 6, 2, 749000),
(213, 'JVS0000121', 'VAN-SC002', 7, 2, 649000),
(214, 'JVS0000121', 'VAN-SC002', 9, 1, 649000),
(215, 'JVS0000121', 'VAN-RL028', 11, 1, 699000),
(216, 'JVS0000121', 'VAN-RL028', 6, 2, 699000),
(217, 'JVS0000122', 'VAN-RC016', 10, 2, 699000),
(218, 'JVS0000122', 'VAN-RC016', 7, 2, 699000),
(219, 'JVS0000123', 'VAN-RL025', 9, 3, 849000),
(220, 'JVS0000123', 'VAN-RL025', 8, 1, 849000),
(221, 'JVS0000123', 'VAN-RB005', 7, 4, 699000),
(222, 'JVS0000124', 'VAN-RF017', 9, 5, 749000),
(223, 'JVS0000124', 'VAN-SC002', 10, 3, 649000),
(224, 'JVS0000125', 'VAN-RL025', 10, 5, 849000),
(225, 'JVS0000126', 'VAN-RB005', 7, 2, 699000),
(226, 'JVS0000126', 'VAN-RB005', 8, 6, 699000),
(227, 'JVS0000127', 'VAN-SC002', 8, 1, 649000),
(228, 'JVS0000127', 'VAN-RB005', 9, 1, 699000),
(229, 'JVS0000127', 'VAN-RL028', 7, 1, 699000),
(230, 'JVS0000128', 'VAN-SC004', 7, 2, 599000),
(231, 'JVS0000128', 'VAN-SC004', 8, 2, 599000),
(232, 'JVS0000129', 'VAN-SC004', 10, 2, 599000),
(233, 'JVS0000129', 'VAN-SC004', 7, 3, 599000),
(234, 'JVS0000129', 'VAN-SC004', 8, 1, 599000),
(235, 'JVS0000130', 'VAN-SC004', 10, 2, 599000),
(236, 'JVS0000130', 'VAN-SC004', 7, 2, 599000),
(237, 'JVS0000131', 'VAN-RC016', 8, 3, 699000),
(238, 'JVS0000131', 'VAN-SC004', 10, 1, 599000),
(239, 'JVS0000131', 'VAN-SC004', 7, 1, 599000),
(240, 'JVS0000132', 'VAN-RC016', 10, 2, 699000);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama`) VALUES
(1, 'Autentic'),
(2, 'Sk8'),
(3, 'Oldskull'),
(4, 'Era'),
(5, 'Slip On');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `no_pembelian` varchar(50) NOT NULL,
  `no_faktur` varchar(50) DEFAULT NULL,
  `tanggal_pembelian` datetime NOT NULL,
  `total_harga` double NOT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `dibuat_oleh` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`no_pembelian`, `no_faktur`, `tanggal_pembelian`, `total_harga`, `keterangan`, `dibuat_oleh`) VALUES
('BVS0000006', '001', '2018-01-10 06:30:00', 36783000, '', 'Ical123'),
('BVS0000007', '002', '2018-01-20 01:50:00', 18666000, '', 'Ical123'),
('BVS0000008', '003', '2018-02-14 10:50:00', 20965000, '', 'Ical123'),
('BVS0000009', '004', '2018-02-22 18:45:00', 31842000, '', 'Ical123'),
('BVS0000010', '005', '2018-03-10 09:30:00', 11477000, '', 'Ical123'),
('BVS0000011', '006', '2018-03-23 19:45:00', 30723000, '', 'Ical123'),
('BVS0000012', '007', '2018-05-15 18:50:00', 24705000, '', 'Ical123'),
('BVS0000013', '008', '2018-05-30 21:05:00', 62916000, '', 'Ical123'),
('BVS0000014', '009', '2018-06-12 19:25:00', 25158000, '', 'Rajab123'),
('BVS0000015', '010', '2019-07-10 18:30:00', 16772000, '', 'Rajab123'),
('BVS0000016', '011', '2018-08-25 19:30:00', 23960000, '', 'Rajab123'),
('BVS0000017', '012', '2018-09-10 22:00:00', 58410000, '', 'Rajab123'),
('BVS0000018', '013', '2019-11-20 14:36:00', 30709000, '', 'Rajab123'),
('BVS0000019', '014', '2020-01-07 10:50:00', 9735000, '', 'Ical123'),
('BVS0000020', '015', '2020-01-23 03:22:00', 10978000, '', 'Ical123'),
('BVS0000021', '016', '2020-01-23 03:29:00', 20766000, '', 'Ical123'),
('BVS0000022', '017', '2020-01-12 09:00:00', 24713000, '', 'Ical123'),
('BVS0000023', '018', '2020-01-15 17:20:00', 38090000, '', 'Ical123'),
('BVS0000024', '019', '2020-01-20 12:00:00', 20616000, '', 'Ical123'),
('BVS0000025', '020', '2020-01-25 12:00:00', 21965000, '', 'Ical123'),
('BVS0000026', '021', '2020-01-27 18:00:00', 15972000, '', 'Ical123'),
('BVS0000027', '022', '2020-01-28 17:25:00', 10479000, '', 'Ical123'),
('BVS0000028', '023', '2020-02-03 04:43:00', 3992000, '', 'Ical123'),
('BVS0000029', '', '2020-02-19 07:36:00', 1000000, '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `no_penjualan` varchar(50) NOT NULL,
  `tanggal_penjualan` datetime NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(16) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `umur` int(3) NOT NULL,
  `total_harga` double NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `dibuat_oleh` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_penjualan`, `tanggal_penjualan`, `nama`, `jenis_kelamin`, `pekerjaan`, `umur`, `total_harga`, `keterangan`, `dibuat_oleh`) VALUES
('JVS0000001', '2018-01-20 09:00:00', 'Alpin A Saputra', 'Laki-laki', 'Pelajar/Mahasiswa', 22, 649000, '', 'Alpino'),
('JVS0000002', '2018-01-27 21:45:00', 'Dian Nurlailasari', 'Perempuan', 'Pegawai Swasta', 29, 649000, '', 'Alpino'),
('JVS0000003', '2018-01-30 15:45:00', 'Kukuh Priandoko', 'Laki-laki', 'Wiraswasta', 27, 1598000, 'Biar gaya makin kece', 'Alpino'),
('JVS0000004', '2018-02-05 10:45:00', 'Lizda Kurniawati', 'Laki-laki', 'Aparatur Sipil Negara', 25, 649000, '', 'Alpino'),
('JVS0000005', '2019-02-08 18:45:00', 'Wiwin Setiawati', 'Perempuan', 'Pegawai Swasta', 23, 1548000, '', 'Alpino'),
('JVS0000006', '2018-02-15 17:45:00', 'Karin Novilda', 'Perempuan', 'Pelajar/Mahasiswa', 21, 1398000, '', 'Alpino'),
('JVS0000007', '2018-02-24 18:45:00', 'Romi Chandra', 'Laki-laki', 'Tidak Bekerja', 25, 2247000, '', 'Alpino'),
('JVS0000008', '2018-02-27 22:00:00', 'Muhammad Faiz', 'Laki-laki', 'Wiraswasta', 26, 699000, '', 'Alpino'),
('JVS0000009', '2018-03-03 10:30:00', 'Agrian Persada Gama ', 'Laki-laki', 'Aparatur Sipil Negara', 27, 2047000, '', 'Alpino'),
('JVS0000010', '2018-03-05 15:25:00', 'Annisa K', 'Perempuan', 'Pegawai Swasta', 22, 1398000, '', 'Alpino'),
('JVS0000011', '2018-03-09 18:30:00', 'Suryatama Negara', 'Laki-laki', 'Pelajar/Mahasiswa', 19, 3745000, '', 'Alpino'),
('JVS0000012', '2018-03-15 13:20:00', 'Sri Latifa K', 'Perempuan', 'Tidak Bekerja', 13, 749000, '', 'Alpino'),
('JVS0000013', '2018-03-22 16:20:00', 'Pitra ', 'Laki-laki', 'Wiraswasta', 23, 699000, '', 'Alpino'),
('JVS0000014', '2018-03-26 19:40:00', 'Kurnia Putri Ramadhani', 'Perempuan', 'Aparatur Sipil Negara', 24, 1398000, '', 'Alpino'),
('JVS0000015', '2018-04-02 14:25:00', 'Deanda Putri', 'Perempuan', 'Pegawai Swasta', 24, 1398000, '', 'Alpino'),
('JVS0000016', '2018-04-08 10:00:00', 'Hedinar K', 'Perempuan', 'Pegawai Swasta', 24, 699000, '', 'Alpino'),
('JVS0000017', '2018-04-12 15:20:00', 'Raffi Priambudi', 'Laki-laki', 'Tidak Bekerja', 12, 1298000, '', 'Alpino'),
('JVS0000018', '2018-04-20 22:20:00', 'Lia Amanda', 'Perempuan', 'Pelajar/Mahasiswa', 23, 2097000, '', 'Alpino'),
('JVS0000019', '2018-04-25 14:25:00', 'Rizky Dillon', 'Laki-laki', 'Wiraswasta', 24, 3096000, '', 'Alpino'),
('JVS0000020', '2018-05-02 18:30:00', 'Ekky Hamzah', 'Laki-laki', 'Aparatur Sipil Negara', 26, 699000, '', 'Alpino'),
('JVS0000021', '2018-05-10 10:00:00', 'Salma ', 'Perempuan', 'Pegawai Swasta', 23, 2696000, '', 'Salli123'),
('JVS0000022', '2018-05-15 14:45:00', 'Fathan', 'Laki-laki', 'Pegawai Swasta', 35, 1698000, '', 'Salli123'),
('JVS0000023', '2018-05-18 15:25:00', 'Almed Hamzah', 'Laki-laki', 'Wiraswasta', 29, 749000, '', 'Salli123'),
('JVS0000024', '2018-05-19 17:45:00', 'Ikram Lalilasa', 'Laki-laki', 'Tidak Bekerja', 12, 749000, '', 'Salli123'),
('JVS0000025', '2018-05-22 18:30:00', 'Namia Kristiani Putri', 'Perempuan', 'Pelajar/Mahasiswa', 14, 849000, '', 'Salli123'),
('JVS0000026', '2018-05-30 19:35:00', 'Putra Rizki K', 'Laki-laki', 'Wiraswasta', 16, 649000, '', 'Salli123'),
('JVS0000027', '2018-06-01 09:05:00', 'Ahmad Tritama', 'Laki-laki', 'Pelajar/Mahasiswa', 21, 1498000, '', 'Salli123'),
('JVS0000028', '2018-06-05 12:00:00', 'Irwin Nandito', 'Laki-laki', 'Pelajar/Mahasiswa', 16, 699000, '', 'Salli123'),
('JVS0000029', '2018-06-08 10:25:00', 'Arieska Nur Wicaksono', 'Laki-laki', 'Wiraswasta', 27, 2397000, '', 'Salli123'),
('JVS0000030', '2018-06-14 16:40:00', 'Moulan Am ', 'Laki-laki', 'Aparatur Sipil Negara', 27, 2896000, '', 'Salli123'),
('JVS0000031', '2018-06-22 21:00:00', 'Nadia Puspa ', 'Perempuan', 'Pelajar/Mahasiswa', 17, 1398000, '', 'Salli123'),
('JVS0000032', '2018-06-26 14:50:00', 'Rani Utari', 'Perempuan', 'Tidak Bekerja', 26, 2996000, '', 'Salli123'),
('JVS0000033', '2018-06-29 18:45:00', 'Didit Pela', 'Laki-laki', 'Wiraswasta', 29, 4494000, '', 'Salli123'),
('JVS0000034', '2018-07-01 18:45:00', 'Dicky Anggara', 'Laki-laki', 'Pegawai Swasta', 21, 2097000, '', 'Salli123'),
('JVS0000035', '2018-07-03 14:50:00', 'Romeo ', 'Laki-laki', 'Wiraswasta', 25, 1398000, '', 'Salli123'),
('JVS0000036', '2018-07-15 20:40:00', 'Yenni Kristiani', 'Perempuan', 'Pelajar/Mahasiswa', 17, 1498000, '', 'Salli123'),
('JVS0000037', '2018-07-11 18:50:00', 'Shafira Aini', 'Perempuan', 'Tidak Bekerja', 21, 1348000, '', 'Salli123'),
('JVS0000038', '2018-07-11 19:45:00', 'Danni Rachmat', 'Laki-laki', 'Pegawai Swasta', 25, 1498000, '', 'Salli123'),
('JVS0000039', '2018-08-03 13:05:00', 'Mutia Alifah', 'Perempuan', 'Pelajar/Mahasiswa', 20, 1398000, '', 'Salli123'),
('JVS0000040', '2018-08-04 15:30:00', 'Alfin Kirana', 'Laki-laki', 'Pelajar/Mahasiswa', 18, 3245000, '', 'Salli123'),
('JVS0000041', '2018-08-09 17:00:00', 'Enabila Riani', 'Perempuan', 'Pegawai Swasta', 25, 4193000, '', 'Salli123'),
('JVS0000042', '2018-08-15 15:25:00', 'Vania Delicia', 'Perempuan', 'Tidak Bekerja', 29, 3294000, '', 'Salli123'),
('JVS0000043', '2018-08-18 18:25:00', 'Abu Tidar', 'Laki-laki', 'Wiraswasta', 26, 1897000, '', 'Salli123'),
('JVS0000044', '2018-08-18 18:45:00', 'Azamat Babaniyazov', 'Laki-laki', 'Aparatur Sipil Negara', 27, 3294000, '', 'Salli123'),
('JVS0000045', '2018-08-20 19:45:00', 'Pricillia Meyer', 'Perempuan', 'Pelajar/Mahasiswa', 17, 1298000, '', 'Salli123'),
('JVS0000046', '2018-09-09 14:30:00', 'Vrez Setia Mulia', 'Laki-laki', 'Wiraswasta', 23, 1298000, '', 'Salli123'),
('JVS0000047', '2018-09-11 18:50:00', 'Shahnaz P', 'Perempuan', 'Aparatur Sipil Negara', 25, 3645000, '', 'Salli123'),
('JVS0000048', '2018-09-15 18:25:00', 'Arindo', 'Laki-laki', 'Pegawai Swasta', 27, 6991000, '', 'Salli123'),
('JVS0000049', '2018-09-20 18:45:00', 'Leo Afandi', 'Laki-laki', 'Pelajar/Mahasiswa', 15, 2596000, '', 'Salli123'),
('JVS0000050', '2018-10-05 10:45:00', 'Yosua Siregar', 'Laki-laki', 'Pelajar/Mahasiswa', 24, 2097000, '', 'Salli123'),
('JVS0000051', '2018-10-10 10:45:00', 'Bagus Kurnia', 'Laki-laki', 'Pegawai Swasta', 23, 2097000, '', 'Salli123'),
('JVS0000052', '2018-10-26 10:30:00', 'Suci Dosi Eka Putri', 'Perempuan', 'Pelajar/Mahasiswa', 13, 3645000, '', 'Salli123'),
('JVS0000053', '2018-10-17 13:30:00', 'Muhammad Arif E', 'Laki-laki', 'Tidak Bekerja', 28, 2547000, '', 'Salli123'),
('JVS0000054', '2018-10-22 18:45:00', 'Tina Rani Prishadi Putri', 'Perempuan', 'Wiraswasta', 23, 1348000, '', 'Salli123'),
('JVS0000055', '2018-11-03 22:25:00', 'Tiwi ', 'Perempuan', 'Wiraswasta', 24, 1298000, '', 'Salli123'),
('JVS0000056', '2018-11-05 14:30:00', 'Ricky Andrianto Sitorus ', 'Laki-laki', 'Aparatur Sipil Negara', 38, 1698000, '', 'Salli123'),
('JVS0000057', '2018-11-14 16:40:00', 'Arum Maeliya Putri', 'Perempuan', 'Pegawai Swasta', 24, 2496000, '', 'Salli123'),
('JVS0000058', '2018-11-24 15:50:00', 'Ajeng ', 'Perempuan', 'Tidak Bekerja', 26, 649000, '', 'Salli123'),
('JVS0000059', '2018-11-08 15:50:00', 'Aditya Dewantara', 'Laki-laki', 'Wiraswasta', 24, 1398000, '', 'Salli123'),
('JVS0000060', '2018-11-20 18:45:00', 'Seno Prastio ', 'Laki-laki', 'Pegawai Swasta', 26, 2247000, '', 'Salli123'),
('JVS0000061', '2018-11-24 18:45:00', 'M Zaldi ', 'Laki-laki', 'Wiraswasta', 34, 1348000, '', 'Salli123'),
('JVS0000062', '2019-12-01 15:00:00', 'Selvia Himawan Soeharto', 'Perempuan', 'Wiraswasta', 26, 699000, '', 'Salli123'),
('JVS0000063', '2018-12-04 19:25:00', 'Virka ', 'Perempuan', 'Tidak Bekerja', 25, 5094000, '', 'Agil123'),
('JVS0000064', '2018-12-14 18:50:00', 'Sandi Rizki ', 'Laki-laki', 'Pegawai Swasta', 27, 2547000, '', 'Agil123'),
('JVS0000065', '2018-12-20 18:45:00', 'Ayatullah ', 'Laki-laki', 'Aparatur Sipil Negara', 25, 1698000, '', 'Agil123'),
('JVS0000066', '2018-12-15 19:50:00', 'Dyalika Winanda', 'Perempuan', 'Pegawai Swasta', 22, 998000, '', 'Agil123'),
('JVS0000067', '2019-01-02 19:30:00', 'Amirah ', 'Perempuan', 'Pelajar/Mahasiswa', 18, 649000, '', 'Agil123'),
('JVS0000068', '2019-01-10 19:30:00', 'Kunto Haryo', 'Laki-laki', 'Pegawai Swasta', 28, 2247000, '', 'Agil123'),
('JVS0000069', '2019-01-13 18:50:00', 'Jaclyn Angellica', 'Perempuan', 'Aparatur Sipil Negara', 25, 2796000, '', 'Agil123'),
('JVS0000070', '2019-01-20 18:25:00', 'Doddy Afriadi', 'Laki-laki', 'Pegawai Swasta', 33, 599000, '', 'Agil123'),
('JVS0000071', '2018-01-25 17:45:00', 'Reza ', 'Laki-laki', 'Pelajar/Mahasiswa', 21, 849000, '', 'Agil123'),
('JVS0000072', '2019-01-26 14:10:00', 'Wiwin K', 'Perempuan', 'Tidak Bekerja', 25, 699000, '', 'Agil123'),
('JVS0000073', '2019-01-27 19:50:00', 'Diany Nabilla Putri', 'Perempuan', 'Wiraswasta', 23, 849000, '', 'Agil123'),
('JVS0000074', '2019-01-28 22:00:00', 'Ayu Andira Rasyid', 'Perempuan', 'Pelajar/Mahasiswa', 14, 749000, '', 'Agil123'),
('JVS0000075', '2019-02-04 09:00:00', 'Anita Putri Kusumadewi', 'Perempuan', 'Aparatur Sipil Negara', 27, 649000, '', 'Agil123'),
('JVS0000076', '2019-02-06 15:00:00', 'Fauzan Iswara', 'Laki-laki', 'Pelajar/Mahasiswa', 20, 849000, '', 'Agil123'),
('JVS0000077', '2019-02-14 14:25:00', 'Yogi Da Putra', 'Laki-laki', 'Aparatur Sipil Negara', 29, 1198000, '', 'Agil123'),
('JVS0000078', '2019-02-18 17:45:00', 'Muliati Putri', 'Perempuan', 'Wiraswasta', 29, 1947000, '', 'Agil123'),
('JVS0000079', '2019-02-21 10:30:00', 'Olivia Cindy K', 'Perempuan', 'Tidak Bekerja', 24, 1497000, '', 'Agil123'),
('JVS0000080', '2019-03-04 14:30:00', 'Dyno Laksmana', 'Laki-laki', 'Aparatur Sipil Negara', 28, 1398000, '', 'Dyno123'),
('JVS0000081', '2019-03-06 13:25:00', 'Panji ', 'Laki-laki', 'Tidak Bekerja', 24, 2347000, '', 'Dyno123'),
('JVS0000082', '2019-03-14 14:30:00', 'Dewi Boediono', 'Perempuan', 'Aparatur Sipil Negara', 29, 1298000, '', 'Dyno123'),
('JVS0000083', '2019-03-20 17:20:00', 'Alpin A Saputra', 'Laki-laki', 'Pelajar/Mahasiswa', 22, 2246000, '', 'Dyno123'),
('JVS0000084', '2019-03-23 14:50:00', 'Andi Aprilia', 'Perempuan', 'Pelajar/Mahasiswa', 23, 1698000, '', 'Dyno123'),
('JVS0000085', '2019-04-01 10:30:00', 'Vina Priastika', 'Perempuan', 'Tidak Bekerja', 20, 2347000, '', 'Dyno123'),
('JVS0000086', '2019-04-11 09:25:00', 'Taufikurahman', 'Laki-laki', 'Wiraswasta', 23, 2547000, '', 'Dyno123'),
('JVS0000087', '2019-04-13 13:05:00', 'Olla Aprillia', 'Perempuan', 'Wiraswasta', 29, 1398000, '', 'Dyno123'),
('JVS0000088', '2019-04-17 19:45:00', 'Upi', 'Laki-laki', 'Aparatur Sipil Negara', 31, 3495000, '', 'Dyno123'),
('JVS0000089', '2019-04-23 13:45:00', 'Steven Mahardika', 'Laki-laki', 'Pelajar/Mahasiswa', 21, 1398000, '', 'Dyno123'),
('JVS0000090', '2019-05-01 10:25:00', 'Hariadi Aditama', 'Laki-laki', 'Aparatur Sipil Negara', 28, 1398000, '', 'Dyno123'),
('JVS0000091', '2019-05-08 10:30:00', 'Claudia ', 'Perempuan', 'Pegawai Swasta', 24, 2047000, '', 'Dyno123'),
('JVS0000092', '2019-05-23 14:45:00', 'Vivian Annisa ', 'Perempuan', 'Pelajar/Mahasiswa', 18, 699000, '', 'Dyno123'),
('JVS0000093', '2019-06-08 10:10:00', 'Bogal Astrian', 'Laki-laki', 'Tidak Bekerja', 29, 1498000, '', 'Dyno123'),
('JVS0000094', '2019-06-13 10:20:00', 'Akmal Dena', 'Laki-laki', 'Wiraswasta', 28, 699000, '', 'Dyno123'),
('JVS0000095', '2019-06-13 14:30:00', 'Alfienda', 'Laki-laki', 'Pelajar/Mahasiswa', 19, 699000, '', 'Dyno123'),
('JVS0000096', '2019-07-04 09:45:00', 'Rini Zubirda', 'Perempuan', 'Tidak Bekerja', 20, 749000, '', 'Dyno123'),
('JVS0000097', '2019-07-26 18:45:00', 'Mutiara Dewi', 'Perempuan', 'Tidak Bekerja', 21, 1398000, '', 'Dyno123'),
('JVS0000098', '2019-07-30 17:45:00', 'Fajar Anugraha', 'Laki-laki', 'Aparatur Sipil Negara', 26, 699000, '', 'Dyno123'),
('JVS0000099', '2019-08-02 22:50:00', 'Nurul Hidayati', 'Perempuan', 'Pelajar/Mahasiswa', 18, 1698000, '', 'Dyno123'),
('JVS0000100', '2019-08-17 14:45:00', 'Aviv Idris', 'Laki-laki', 'Pegawai Swasta', 24, 699000, '', 'Dyno123'),
('JVS0000101', '2019-08-20 13:45:00', 'Vinadiya Alaska ', 'Perempuan', 'Pelajar/Mahasiswa', 20, 1298000, '', 'Dyno123'),
('JVS0000102', '2019-09-02 09:25:00', 'Syah Al-Rasyid', 'Laki-laki', 'Wiraswasta', 23, 1597000, '', 'Dyno123'),
('JVS0000103', '2019-09-20 19:50:00', 'Evodie Leanishar', 'Laki-laki', 'Tidak Bekerja', 21, 1497000, '', 'Dyno123'),
('JVS0000104', '2019-09-24 21:45:00', 'Radian H', 'Laki-laki', 'Pegawai Swasta', 21, 1947000, '', 'Dyno123'),
('JVS0000105', '2019-10-02 13:45:00', 'Waode Kirana Putri', 'Perempuan', 'Pegawai Swasta', 25, 849000, '', 'Dyno123'),
('JVS0000106', '2019-10-16 13:45:00', 'Nicholas A', 'Laki-laki', 'Tidak Bekerja', 23, 749000, '', 'Dyno123'),
('JVS0000107', '2019-10-25 18:50:00', 'Asri Yuni Haseng', 'Perempuan', 'Aparatur Sipil Negara', 28, 1298000, '', 'Dyno123'),
('JVS0000108', '2019-11-01 14:45:00', 'Wa Sumaeni', 'Perempuan', 'Pegawai Swasta', 25, 749000, '', 'Dyno123'),
('JVS0000109', '2019-11-15 14:15:00', 'Pupe', 'Perempuan', 'Pelajar/Mahasiswa', 17, 3396000, '', 'Dyno123'),
('JVS0000110', '2019-11-22 19:05:00', 'Amak', 'Laki-laki', 'Aparatur Sipil Negara', 26, 749000, '', 'Alpino'),
('JVS0000111', '2020-01-04 17:30:00', 'Ikbal Kurniawan', 'Laki-laki', 'Pelajar/Mahasiswa	', 23, 1498000, '', 'Alpino'),
('JVS0000112', '2020-01-04 19:00:00', 'Panji Laksono', 'Laki-laki', 'Wiraswasta', 25, 2447000, '', 'Alpino'),
('JVS0000113', '2020-01-06 12:05:00', 'sri mulia', 'Perempuan', 'Pegawai Swasta', 29, 2147000, '', 'Alpino'),
('JVS0000114', '2020-01-06 13:28:00', 'Sari ', 'Perempuan', 'Pelajar/Mahasiswa	', 22, 849000, '', 'Alpino'),
('JVS0000115', '2020-01-06 13:30:00', 'Sari ', 'Perempuan', 'Pegawai Swasta', 22, 849000, '', 'Alpino'),
('JVS0000116', '2020-01-06 18:30:00', 'Fathur Fadhilla', 'Laki-laki', 'Pelajar/Mahasiswa	', 28, 5442000, '', 'Alpino'),
('JVS0000117', '2020-01-06 20:45:00', 'Bagas Lalu Kismana', 'Laki-laki', 'Aparatur Sipil Negara', 25, 6941000, '', 'Alpino'),
('JVS0000118', '2020-01-07 09:25:00', 'Sarah ', 'Perempuan', 'Tidak Bekerja', 22, 3395000, '', 'Alpino'),
('JVS0000119', '2020-01-07 10:25:00', 'Adam Radja', 'Laki-laki', 'Pelajar/Mahasiswa	', 21, 3246000, '', 'Alpino'),
('JVS0000120', '2020-01-07 14:25:00', 'Saras Putri Adista', 'Perempuan', 'Tidak Bekerja', 24, 2247000, '', 'Dyno123'),
('JVS0000121', '2020-01-08 09:25:00', 'Thiya Fiantika', 'Perempuan', 'Pelajar/Mahasiswa	', 23, 4044000, '', 'Dyno123'),
('JVS0000122', '2020-01-08 12:40:00', 'Akbar Prasetya', 'Laki-laki', 'Wiraswasta', 29, 2796000, '', 'Dyno123'),
('JVS0000123', '2020-01-10 10:40:00', 'Keenan Putra', 'Laki-laki', 'Pegawai Swasta', 28, 6192000, '', 'Dyno123'),
('JVS0000124', '2020-01-09 18:45:00', 'Larita Anjari P', 'Perempuan', 'Pegawai Swasta', 26, 5692000, '', 'Dyno123'),
('JVS0000125', '2020-01-10 13:45:00', 'Adit Acil', 'Laki-laki', 'Pelajar/Mahasiswa	', 23, 4245000, '', 'Dyno123'),
('JVS0000126', '2020-02-11 09:45:00', 'Ricky Hadi Santoso', 'Laki-laki', 'Aparatur Sipil Negara', 32, 5592000, '', 'Dyno123'),
('JVS0000127', '2020-01-11 10:45:00', 'Fajar Laliasa', 'Laki-laki', 'Wiraswasta', 25, 2047000, '', 'Dyno123'),
('JVS0000128', '2020-02-03 10:03:00', 'Siska Smith', 'Perempuan', 'Pegawai Swasta', 22, 2396000, '', 'Dyno123'),
('JVS0000129', '2020-02-03 17:40:00', 'Zain Alfi', 'Laki-laki', 'Pelajar/Mahasiswa	', 24, 3594000, '', 'Dyno123'),
('JVS0000130', '2020-02-03 18:00:00', 'Tama', 'Laki-laki', 'Tidak Bekerja', 20, 2396000, '', 'Dyno123'),
('JVS0000131', '2020-02-03 19:00:00', 'Aisya Laetetiya Santoso', 'Perempuan', 'Pegawai Swasta', 24, 3295000, '', 'Dyno123'),
('JVS0000132', '2020-02-17 19:51:00', 'Jojo', 'Laki-laki', 'Aparatur Sipil Negara', 22, 1398000, '', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `safety_stock`
--

CREATE TABLE `safety_stock` (
  `id_safety` int(11) NOT NULL,
  `sku_barang` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `terjual` int(11) NOT NULL,
  `max` int(11) DEFAULT NULL,
  `rerata` float DEFAULT NULL,
  `leadtime` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `safety_stock` int(11) DEFAULT NULL,
  `rop` int(11) NOT NULL,
  `eoq` double NOT NULL,
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `safety_stock`
--

INSERT INTO `safety_stock` (`id_safety`, `sku_barang`, `size`, `terjual`, `max`, `rerata`, `leadtime`, `stock`, `safety_stock`, `rop`, `eoq`, `status`) VALUES
(1, 'VAN-SC005', 7, 1, 1, 0.0833333, 1, 4, 0, 0, 0, 1),
(2, 'VAN-SC005', 6, 0, 0, 0, 1, 5, 0, 0, 0, 1),
(3, 'VAN-QL001', 6, 0, 0, 0, 3, 7, 0, 0, 0, 1),
(4, 'VAN-QL001', 7, 0, 0, 0, 3, 10, 0, 0, 0, 1),
(5, 'VAN-QL001', 8, 3, 3, 0.25, 3, 14, 8, 8, 0, 1),
(6, 'VAN-QL001', 9, 4, 2, 0.333333, 3, 11, 5, 5, 0, 1),
(7, 'VAN-QL001', 10, 1, 1, 0.0833333, 3, 4, 2, 2, 0, 1),
(8, 'VAN-QL001', 11, 0, 0, 0, 3, 4, 0, 0, 0, 1),
(9, 'VAN-QL003', 7, 0, 0, 0, 3, 2, 0, 0, 0, 1),
(10, 'VAN-QL003', 8, 2, 2, 0.166667, 3, 8, 5, 5, 0, 1),
(11, 'VAN-QL003', 9, 0, 0, 0, 3, 7, 0, 0, 0, 1),
(12, 'VAN-QL003', 10, 1, 1, 0.0833333, 3, 5, 2, 2, 0, 1),
(13, 'VAN-QL003', 11, 1, 1, 0.0833333, 3, 5, 2, 2, 0, 1),
(14, 'VAN-QM001', 6, 0, 0, 0, 3, 3, 0, 0, 0, 1),
(15, 'VAN-QM001', 7, 0, 0, 0, 3, 2, 0, 0, 0, 1),
(16, 'VAN-QM001', 8, 0, 0, 0, 3, 3, 0, 0, 0, 1),
(17, 'VAN-QM001', 9, 4, 2, 0.333333, 3, 11, 5, 5, 0, 1),
(18, 'VAN-QM001', 10, 1, 1, 0.0833333, 3, 3, 2, 2, 0, 1),
(19, 'VAN-QM001', 12, 0, 0, 0, 3, 5, 0, 0, 0, 1),
(20, 'VAN-SC002', 7, 2, 2, 0.166667, 3, 6, 5, 5, 0, 1),
(21, 'VAN-SC002', 8, 1, 1, 0.0833333, 3, 9, 2, 2, 0, 1),
(22, 'VAN-SC002', 9, 4, 4, 0.333333, 3, 17, 11, 11, 0, 1),
(23, 'VAN-SC002', 10, 5, 5, 0.416667, 3, 20, 13, 13, 0, 1),
(24, 'VAN-SC004', 7, 8, 8, 0.666667, 3, 4, 22, 22, 5, 2),
(25, 'VAN-SC004', 8, 4, 3, 0.333333, 3, 4, 8, 8, 0, 2),
(26, 'VAN-SC004', 9, 0, 0, 0, 3, 9, 0, 0, 0, 1),
(27, 'VAN-SC004', 10, 5, 5, 0.416667, 3, 4, 13, 13, 0, 2),
(28, 'VAN-SC005', 8, 2, 2, 0.166667, 1, 8, 1, 1, 0, 1),
(29, 'VAN-SC005', 9, 2, 2, 0.166667, 1, 13, 1, 1, 0, 1),
(30, 'VAN-SC005', 10, 3, 3, 0.25, 1, 7, 2, 2, 0, 1),
(31, 'VAN-SC005', 11, 0, 0, 0, 1, 8, 0, 0, 0, 1),
(32, 'VAN-SC005', 12, 0, 0, 0, 1, 4, 0, 0, 0, 1),
(33, 'VAN-QF002', 6, 3, 3, 0.25, 3, 12, 8, 8, 0, 1),
(34, 'VAN-QF002', 7, 2, 2, 0.166667, 3, 8, 5, 5, 0, 1),
(35, 'VAN-QF002', 8, 2, 2, 0.166667, 3, 6, 5, 5, 0, 1),
(36, 'VAN-QF002', 9, 7, 2, 0.583333, 3, 11, 4, 4, 0, 1),
(37, 'VAN-QF002', 10, 1, 1, 0.0833333, 3, 7, 2, 2, 0, 1),
(38, 'VAN-QF002', 11, 0, 0, 0, 3, 7, 0, 0, 0, 1),
(39, 'VAN-QF002', 12, 4, 3, 0.333333, 3, 11, 8, 8, 0, 1),
(40, 'VAN-QJ002', 7, 0, 0, 0, 3, 5, 0, 0, 0, 1),
(41, 'VAN-QJ002', 8, 0, 0, 0, 3, 9, 0, 0, 0, 1),
(42, 'VAN-QJ002', 9, 7, 5, 0.583333, 3, 14, 13, 13, 0, 1),
(43, 'VAN-QJ002', 10, 0, 0, 0, 3, 9, 0, 0, 0, 1),
(44, 'VAN-QJ002', 11, 0, 0, 0, 3, 3, 0, 0, 0, 1),
(45, 'VAN-QJ002', 12, 0, 0, 0, 3, 1, 0, 0, 0, 1),
(46, 'VAN-RL028', 6, 2, 2, 0.166667, 3, 8, 5, 5, 0, 1),
(47, 'VAN-RL028', 7, 1, 1, 0.0833333, 3, 5, 2, 2, 0, 1),
(48, 'VAN-RL028', 8, 2, 2, 0.166667, 3, 9, 5, 5, 0, 1),
(49, 'VAN-RL028', 9, 3, 2, 0.25, 3, 5, 5, 5, 0, 1),
(50, 'VAN-RL028', 10, 0, 0, 0, 3, 7, 0, 0, 0, 1),
(51, 'VAN-RL028', 11, 3, 3, 0.25, 3, 12, 8, 8, 0, 1),
(52, 'VAN-RB005', 7, 9, 4, 0.75, 3, 14, 9, 9, 0, 1),
(53, 'VAN-RB005', 8, 8, 6, 0.666667, 3, 6, 16, 16, 10, 2),
(54, 'VAN-RC016', 6, 1, 1, 0.0833333, 3, 2, 2, 2, 0, 1),
(55, 'VAN-RC016', 7, 4, 2, 0.333333, 3, 3, 5, 5, 0, 2),
(56, 'VAN-RC016', 8, 3, 3, 0.25, 3, 2, 8, 8, 0, 2),
(57, 'VAN-RC016', 9, 4, 2, 0.333333, 3, 5, 5, 5, 0, 1),
(58, 'VAN-RC016', 10, 8, 5, 0.666667, 3, 13, 13, 13, 0, 1),
(59, 'VAN-RF017', 6, 4, 4, 0.333333, 3, 15, 11, 11, 0, 1),
(60, 'VAN-RF017', 7, 3, 2, 0.25, 3, 7, 5, 5, 0, 1),
(61, 'VAN-RF017', 8, 1, 1, 0.0833333, 3, 7, 2, 2, 0, 1),
(62, 'VAN-RF017', 9, 6, 5, 0.5, 3, 18, 13, 13, 0, 1),
(63, 'VAN-RF017', 10, 2, 1, 0.166667, 3, 16, 2, 2, 0, 1),
(64, 'VAN-RF017', 11, 4, 2, 0.333333, 3, 9, 5, 5, 0, 1),
(65, 'VAN-RF017', 12, 3, 3, 0.25, 3, 10, 8, 8, 0, 1),
(66, 'VAN-RL025', 8, 6, 6, 0.5, 2, 8, 11, 11, 0, 2),
(67, 'VAN-RL025', 9, 4, 4, 0.333333, 2, 14, 7, 7, 0, 1),
(68, 'VAN-RL025', 10, 5, 5, 0.416667, 2, 4, 9, 9, 0, 2),
(69, 'VAN-RB005', 9, 2, 2, 0.166667, 3, 15, 5, 5, 0, 1),
(70, 'VAN-RB005', 10, 0, 0, 0, 3, 6, 0, 0, 0, 1),
(71, 'VAN-QM001', 11, 0, 0, 0, 3, 4, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `no_telp` varchar(16) NOT NULL,
  `aktif` int(1) NOT NULL,
  `access_token` varchar(123) DEFAULT NULL,
  `auth_key` varchar(123) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`username`, `password`, `nama`, `alamat`, `no_telp`, `aktif`, `access_token`, `auth_key`) VALUES
('Agil123', '25d55ad283aa400af464c76d713c07ad', 'Agrian Persada Gama', 'Jln.Jendral Sudirman,Daeng Imba,Makassar', '08126555479', 1, 'gvwRuZfJTyQkfxM-njTLcbXp_6ALSeRA', '1Qu3oIfZdM4OSp5w3LjXQ7dW-dTXkbkZ'),
('Alpino', '25d55ad283aa400af464c76d713c07ad', 'Alpin A Saputra ', 'Konawe Utara', '08126855532216', 1, 'hiLKWFA-G0f8Rqbr3w1aIaXHQRLIn7HV', 'lyBHh7ts8ok_InLPz_lCGTsjcsCevpzt'),
('Dyno123', '25d55ad283aa400af464c76d713c07ad', 'Dyno Laksana', 'Jln Soekarno Hatta , Malang , Jawa Timur', '08129875264', 1, 'm4Fp9M5xboi5u5r-Ojm9dSWFQOKGmeWk', 'YVzGNvo-ByYkwbWN--79CJLLTr3qNkua'),
('Salli123', '25d55ad283aa400af464c76d713c07ad', 'Muhammad Nursalli', 'Manokwari', '081268113767', 1, 'hd76QWc5CNxO1Qa7B7F5xz2cotxaO3KI', 'MXWtOSsne5DQTlpFFkYootKUa6lM8Dr1'),
('staff', '21232f297a57a5a743894a0e4a801fc3', 'sadasd', 'asdas', '123123123', 1, 'J8h4cbHApEUTkK63xFBoX-da2q7g2Zvm', 'mQROiu8HwLVL6zIz2Mtt0T-5t3fz61Iq');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `sku_barang` varchar(50) NOT NULL,
  `id_detail` int(11) NOT NULL,
  `size` float NOT NULL,
  `stock_awal` int(11) NOT NULL,
  `stock_real` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `sku_barang`, `id_detail`, `size`, `stock_awal`, `stock_real`) VALUES
(35, 'VAN-QL001', 35, 11, 5, 4),
(36, 'VAN-QL001', 36, 10, 7, 4),
(37, 'VAN-QL001', 37, 9, 20, 4),
(38, 'VAN-QL001', 38, 8, 18, 14),
(39, 'VAN-QL001', 39, 7, 10, 10),
(40, 'VAN-QL001', 40, 6, 7, 7),
(41, 'VAN-QL003', 41, 11, 2, 1),
(42, 'VAN-QL003', 42, 10, 3, 1),
(43, 'VAN-QL003', 43, 9, 15, 7),
(44, 'VAN-QL003', 44, 8, 9, 0),
(45, 'VAN-QL003', 45, 7, 5, 2),
(46, 'VAN-QM001', 46, 12, 3, 0),
(47, 'VAN-QM001', 47, 10, 5, 3),
(48, 'VAN-QM001', 48, 9, 15, 4),
(49, 'VAN-QM001', 49, 8, 6, 3),
(50, 'VAN-QM001', 50, 7, 3, 2),
(51, 'VAN-QM001', 51, 6, 3, 3),
(52, 'VAN-SC002', 52, 9, 25, 7),
(53, 'VAN-SC002', 53, 10, 9, 3),
(54, 'VAN-SC002', 54, 8, 14, 9),
(55, 'VAN-SC002', 55, 7, 10, 6),
(56, 'VAN-SC004', 56, 7, 4, 0),
(57, 'VAN-SC004', 57, 8, 5, 0),
(58, 'VAN-SC004', 58, 9, 12, 3),
(59, 'VAN-SC004', 59, 10, 2, 0),
(79, 'VAN-QJ002', 79, 7, 5, 5),
(80, 'VAN-QJ002', 80, 8, 9, 9),
(81, 'VAN-QJ002', 81, 9, 17, 0),
(82, 'VAN-QJ002', 82, 10, 9, 9),
(83, 'VAN-QJ002', 83, 11, 3, 3),
(84, 'VAN-QJ002', 84, 12, 2, 1),
(92, 'VAN-SC005', 92, 7, 8, 4),
(93, 'VAN-SC005', 93, 8, 12, 8),
(94, 'VAN-SC005', 94, 9, 26, 13),
(95, 'VAN-SC005', 95, 10, 14, 7),
(96, 'VAN-SC005', 96, 11, 8, 8),
(97, 'VAN-SC005', 97, 12, 4, 4),
(98, 'VAN-SC005', 98, 6, 5, 5),
(145, 'VAN-QF002', 145, 7, 6, 2),
(146, 'VAN-QF002', 146, 8, 10, 6),
(147, 'VAN-QF002', 147, 9, 25, 1),
(148, 'VAN-QF002', 148, 10, 15, 7),
(149, 'VAN-QF002', 149, 6, 9, 0),
(150, 'VAN-QF002', 150, 11, 7, 7),
(151, 'VAN-QF002', 151, 12, 12, 6),
(158, 'VAN-RB005', 158, 7, 5, 0),
(159, 'VAN-RB005', 159, 8, 8, 0),
(160, 'VAN-QJ002', 160, 9, 15, 14),
(161, 'VAN-RL028', 161, 6, 4, 0),
(162, 'VAN-RL028', 162, 7, 5, 1),
(163, 'VAN-RL028', 163, 8, 10, 4),
(164, 'VAN-RL028', 164, 9, 12, 5),
(165, 'VAN-RL028', 165, 10, 7, 7),
(166, 'VAN-RL028', 166, 11, 4, 1),
(167, 'VAN-RC016', 167, 6, 4, 2),
(168, 'VAN-RC016', 168, 7, 7, 3),
(169, 'VAN-RC016', 169, 8, 9, 2),
(170, 'VAN-RC016', 170, 9, 13, 5),
(171, 'VAN-RC016', 171, 10, 7, 0),
(172, 'VAN-RF017', 172, 6, 8, 0),
(173, 'VAN-RF017', 173, 7, 10, 5),
(174, 'VAN-RF017', 174, 8, 15, 2),
(175, 'VAN-RF017', 175, 9, 30, 0),
(176, 'VAN-RF017', 176, 10, 14, 1),
(177, 'VAN-RF017', 177, 11, 7, 2),
(178, 'VAN-RF017', 178, 12, 6, 0),
(182, 'VAN-RL025', 182, 8, 14, 8),
(183, 'VAN-RL025', 183, 9, 18, 14),
(184, 'VAN-RL025', 184, 10, 9, 4),
(186, 'VAN-RF017', 186, 10, 15, 15),
(191, 'VAN-RB005', 191, 8, 7, 1),
(192, 'VAN-RB005', 192, 7, 5, 0),
(193, 'VAN-RB005', 193, 9, 10, 8),
(202, 'VAN-QM001', 202, 9, 7, 7),
(203, 'VAN-QM001', 203, 12, 5, 5),
(204, 'VAN-RF017', 204, 8, 5, 5),
(205, 'VAN-RF017', 205, 9, 10, 7),
(206, 'VAN-QL001', 206, 9, 7, 7),
(207, 'VAN-RB005', 207, 9, 7, 7),
(208, 'VAN-RB005', 208, 10, 6, 6),
(209, 'VAN-RB005', 209, 8, 5, 5),
(210, 'VAN-QF002', 210, 6, 12, 12),
(211, 'VAN-RB005', 211, 7, 2, 2),
(212, 'VAN-QF002', 212, 12, 5, 5),
(213, 'VAN-QF002', 213, 7, 6, 6),
(214, 'VAN-QF002', 214, 9, 10, 10),
(215, 'VAN-SC002', 215, 10, 15, 15),
(216, 'VAN-RL028', 216, 6, 8, 8),
(217, 'VAN-RL028', 217, 11, 11, 11),
(218, 'VAN-RF017', 218, 12, 10, 10),
(219, 'VAN-SC002', 219, 9, 10, 10),
(220, 'VAN-RL028', 220, 7, 4, 4),
(221, 'VAN-RL028', 221, 8, 5, 5),
(222, 'VAN-RF017', 222, 6, 15, 15),
(230, 'VAN-RF017', 230, 9, 11, 11),
(231, 'VAN-RF017', 231, 11, 7, 7),
(232, 'VAN-RF017', 232, 7, 2, 2),
(233, 'VAN-RC016', 233, 10, 15, 13),
(242, 'VAN-QL003', 242, 8, 8, 8),
(243, 'VAN-QL003', 243, 10, 4, 4),
(244, 'VAN-RB005', 244, 7, 12, 12),
(245, 'VAN-QL003', 245, 11, 4, 4),
(246, 'VAN-SC004', 246, 8, 5, 4),
(247, 'VAN-SC004', 247, 9, 6, 6),
(248, 'VAN-SC004', 248, 10, 5, 0),
(249, 'VAN-SC004', 249, 7, 5, 0),
(250, 'VAN-SC004', 250, 7, 4, 4),
(251, 'VAN-SC004', 251, 10, 4, 4),
(252, 'VAN-SC002', 252, 10, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`sku`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `dibuat_oleh` (`dibuat_oleh`),
  ADD KEY `diubah_oleh` (`diubah_oleh`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `sku_barang` (`sku_barang`),
  ADD KEY `no_pembelian` (`no_pembelian`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `no_penjualan` (`no_penjualan`),
  ADD KEY `sku_barang` (`sku_barang`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no_pembelian`),
  ADD KEY `dibuat_oleh` (`dibuat_oleh`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no_penjualan`),
  ADD KEY `dibuat_oleh` (`dibuat_oleh`);

--
-- Indexes for table `safety_stock`
--
ALTER TABLE `safety_stock`
  ADD PRIMARY KEY (`id_safety`),
  ADD KEY `sku_barang` (`sku_barang`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `sku_barang` (`sku_barang`),
  ADD KEY `id_detail` (`id_detail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `safety_stock`
--
ALTER TABLE `safety_stock`
  MODIFY `id_safety` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`dibuat_oleh`) REFERENCES `admin` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`diubah_oleh`) REFERENCES `admin` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`sku_barang`) REFERENCES `barang` (`sku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`no_pembelian`) REFERENCES `pembelian` (`no_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`no_penjualan`) REFERENCES `penjualan` (`no_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualan_ibfk_3` FOREIGN KEY (`sku_barang`) REFERENCES `barang` (`sku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`dibuat_oleh`) REFERENCES `admin` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`dibuat_oleh`) REFERENCES `staff` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `safety_stock`
--
ALTER TABLE `safety_stock`
  ADD CONSTRAINT `safety_stock_ibfk_1` FOREIGN KEY (`sku_barang`) REFERENCES `barang` (`sku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_detail`) REFERENCES `detail_pembelian` (`id_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`sku_barang`) REFERENCES `barang` (`sku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
