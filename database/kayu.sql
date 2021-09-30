-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2021 at 04:28 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kayu`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(8) NOT NULL,
  `id_produk` int(8) NOT NULL,
  `id_ukuran` int(8) NOT NULL,
  `id_pelanggan` int(8) NOT NULL,
  `qty` int(8) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id` int(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `biaya` bigint(12) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id`, `nama`, `biaya`, `create_at`) VALUES
(1, 'Luar Kota Jepara', 50000, '2021-08-03 18:22:22'),
(2, 'Dalam Kota Jepara', 0, '2021-08-03 18:22:22'),
(3, 'Diambil ditempat', 0, '2021-08-04 08:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `no_hp`, `password`, `foto`, `create_at`) VALUES
(1, 'Rifki', '087721191226', 'e5e07532fea4754b873ba87f88e86aab', 'foto1.jpg', '2021-08-09 13:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(8) NOT NULL,
  `id_produk` int(8) NOT NULL,
  `id_ukuran` int(8) NOT NULL,
  `harga` int(8) NOT NULL,
  `qty` int(8) NOT NULL,
  `id_transaksi` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_produk`, `id_ukuran`, `harga`, `qty`, `id_transaksi`) VALUES
(12, 2, 2, 400000, 3, 1),
(13, 2, 2, 400000, 3, 2),
(14, 3, 3, 500000, 3, 3),
(15, 1, 1, 150000, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `kualitas` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `foto`, `kualitas`, `keterangan`, `create_at`) VALUES
(1, 'Kayu Jati', 'foto1.png', 'A1', 'asda', '2021-08-06 08:45:29'),
(2, 'Kayu Maoni', 'foto2.jpg', 'A2', 'asda', '2021-08-06 08:46:01'),
(3, 'Kayu Jambu', 'foto3.jpg', 'A6', 'sadgaskhd', '2021-08-09 13:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(8) NOT NULL,
  `ref` varchar(50) NOT NULL,
  `id_pelanggan` int(8) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `no_hp_penerima` varchar(15) NOT NULL,
  `wilayah` int(8) NOT NULL,
  `alamat` text NOT NULL,
  `metode` varchar(50) NOT NULL,
  `exp_pay` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `harga_akhir` bigint(15) NOT NULL,
  `status` enum('0','1','2','3','4','5','6','7','8') NOT NULL COMMENT '0 - Cancel\r\n1 - checkout\r\n2 - pay\r\n3 - send\r\n4 - done\r\n5 - return\r\n6 - Pay Expired\r\n7 - Failed\r\n8 - Refund',
  `checkout_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pay_at` timestamp NULL DEFAULT NULL,
  `send_at` timestamp NULL DEFAULT NULL,
  `done_at` timestamp NULL DEFAULT NULL,
  `return_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `ref`, `id_pelanggan`, `nama_penerima`, `no_hp_penerima`, `wilayah`, `alamat`, `metode`, `exp_pay`, `harga_akhir`, `status`, `checkout_at`, `pay_at`, `send_at`, `done_at`, `return_at`) VALUES
(1, 'DEV-T451217737MLWCA', 1, 'Rezal Wahyu Pratama', '087721191226', 3, 'Ds. Angkatan Lor, Rt002, Rw002, Tambakromo, Pati', 'BRIVA', '2021-08-08 13:57:25', 1204250, '4', '2021-08-08 13:57:25', '2021-08-06 06:38:03', '2021-08-08 08:56:29', '2021-08-08 08:57:25', NULL),
(2, 'DEV-T451217835JRUZ5', 1, 'Rezal Wahyu Pratama', '087721191226', 3, 'Ds. Angkata Lor, Kec. Tambakromo, Kab Pati', 'BRIVA', '2021-08-08 02:50:31', 1204250, '1', '2021-08-07 07:50:31', NULL, NULL, NULL, NULL),
(3, 'DEV-T451218170J25QG', 1, 'Rezal Wahyu Pratama', '087721191226', 2, 'asdadasf', 'BRIVA', '2021-08-09 13:48:18', 1504250, '2', '2021-08-09 13:48:18', '2021-08-09 08:48:18', NULL, NULL, NULL),
(4, 'DEV-T451218171AE3A4', 1, 'Rezal Wahyu Pratama', '087721191226', 3, 'asdas', 'BRIVA', '2021-08-09 13:51:28', 454250, '2', '2021-08-09 13:51:28', '2021-08-09 08:51:28', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

CREATE TABLE `ukuran` (
  `id` int(8) NOT NULL,
  `id_produk` int(8) NOT NULL,
  `ukuran` varchar(50) NOT NULL,
  `stock` int(7) NOT NULL,
  `harga` bigint(12) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`id`, `id_produk`, `ukuran`, `stock`, `harga`, `create_at`) VALUES
(1, 1, '20x60x155', 3, 150000, '2021-08-09 13:51:28'),
(2, 2, '23x33x223', 18, 400000, '2021-08-06 11:38:03'),
(3, 3, '23x82x93', 11, 500000, '2021-08-09 13:48:18'),
(4, 3, '12x213x1', 31, 3000, '2021-08-09 13:41:21');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(8) NOT NULL,
  `id_produk` int(8) NOT NULL,
  `rating` int(1) NOT NULL,
  `comment` text NOT NULL,
  `comment_by` int(8) NOT NULL,
  `comment_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `replay` text DEFAULT NULL,
  `replay_at` timestamp NULL DEFAULT NULL,
  `replay_by` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `id_produk`, `rating`, `comment`, `comment_by`, `comment_at`, `replay`, `replay_at`, `replay_by`) VALUES
(1, 1, 4, 'Kayunya kuat', 1, '2021-08-06 09:34:15', 'Siap Terima kasih', '2021-08-06 04:34:15', 1),
(2, 1, 5, 'Bagus Kayunya', 1, '2021-08-06 11:19:18', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `create_at`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2021-08-06 04:11:37'),
(2, 'Kecank12312', 'kecank', 'e5e07532fea4754b873ba87f88e86aab', '2021-07-30 03:01:26');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(8) NOT NULL,
  `id_produk` int(8) NOT NULL,
  `id_pelanggan` int(8) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `id_produk`, `id_pelanggan`, `create_at`) VALUES
(1, 2, 1, '2021-08-06 04:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `wp_criterias`
--

CREATE TABLE `wp_criterias` (
  `id_criteria` tinyint(3) UNSIGNED NOT NULL,
  `criteria` varchar(100) NOT NULL,
  `weight` float NOT NULL,
  `attribute` set('benefit','cost') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wp_criterias`
--

INSERT INTO `wp_criterias` (`id_criteria`, `criteria`, `weight`, `attribute`) VALUES
(1, 'rating', 3, 'benefit'),
(2, 'coment', 1, 'benefit'),
(3, 'terjual', 6, 'benefit'),
(4, 'dilihat', 1, 'benefit'),
(5, 'disukai', 1, 'benefit');

-- --------------------------------------------------------

--
-- Table structure for table `wp_evaluations`
--

CREATE TABLE `wp_evaluations` (
  `id_alternative` smallint(5) UNSIGNED NOT NULL,
  `id_criteria` tinyint(3) UNSIGNED NOT NULL,
  `value` float NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wp_evaluations`
--

INSERT INTO `wp_evaluations` (`id_alternative`, `id_criteria`, `value`) VALUES
(3, 5, 19),
(3, 4, 3),
(3, 3, 3),
(3, 2, 0),
(3, 1, 0),
(2, 5, 1),
(2, 4, 4),
(2, 3, 4),
(2, 2, 1),
(2, 1, 1),
(1, 5, 1),
(1, 4, 8),
(1, 3, 10),
(1, 2, 2),
(1, 1, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_criterias`
--
ALTER TABLE `wp_criterias`
  ADD PRIMARY KEY (`id_criteria`);

--
-- Indexes for table `wp_evaluations`
--
ALTER TABLE `wp_evaluations`
  ADD PRIMARY KEY (`id_alternative`,`id_criteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ukuran`
--
ALTER TABLE `ukuran`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
