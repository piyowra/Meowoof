-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2022 at 05:41 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petshop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'adminvio', 'minone', 'Relvio K. M'),
(2, 'adminwung', 'mintwo', 'Prita I. W');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Solo', 9000),
(2, 'Pekalongan', 12000),
(3, 'Bogor', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`) VALUES
(1, 'wunge@gmail.com', 'wunge11', 'Wunge ', '082351779921'),
(2, 'dino02@gmail.com', 'nodino', 'Dino ', '080233010017'),
(3, 'iswunge@gmail.com', 'iswunge', 'Isworo W', '081771133115'),
(4, 'kattypatty@gmail.com', 'kattypass', 'Katty P', '087722123009');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`) VALUES
(1, 1, 1, '2022-04-30', 88000),
(2, 1, 2, '2022-04-30', 64975),
(3, 2, 3, '2022-04-30', 368000),
(4, 4, 1, '2022-04-30', 21000);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 4, 1),
(4, 2, 1, 2),
(5, 2, 4, 1),
(6, 2, 6, 1),
(7, 3, 5, 1),
(8, 3, 11, 1),
(9, 3, 14, 1),
(10, 4, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `berat`, `foto_produk`, `deskripsi_produk`) VALUES
(1, 'Felibite Makanan Kering Kucing 800gr', 17000, 800, 'felibite800.jpg', 'Makanan kucing dengan aroma yang mengguagah selera anabul anda    '),
(2, 'Kasur Donat Kucing', 50000, 840, 'kasurkdonat.jpg', 'Kasur nyaman unntuk kucing anda dengan desain yang menarik dan unik    '),
(3, 'Cat Choize1Kg Rasa Tuna & Salmon (Makanan Kucing)', 23000, 1000, 'catchoize1kg.jpg', 'Makanan kucing bergizi dengan rasa tuna dan salmon'),
(4, 'Kalung Kucing Costum Nama', 12000, 20, 'kalungkcostum.jpg', 'Kalung kucing lucu, bisa custom nama'),
(5, 'Kalung Dasi Kucing Pita Kupu-kupu Polkadot', 15000, 20, 'miawdasi.jpg', 'Kalung kucing lucu'),
(6, 'Fresh Parfum Anti Kutu Kucing', 6975, 60, 'freshparfum.jpg', 'Parfum anti kutu untuk kucing'),
(7, 'Kasur Kucing Bulu Motif SK', 40000, 990, 'kasurkmotif.jpg', 'Kasur nyaman untuk kucing anda dengan motif lucu'),
(8, 'Happy Katty Pasir Gumpal Kucing 10L', 38980, 10000, 'happykattypasir.jpg', 'Menghilangkan Bau Dari Kotoran Kucing Menggumpal Saat Terkena Cairan, Tetap wangi saat basah, Terbuat dari bahan yang berkualitas'),
(9, 'Baju Kucing Kecil Size S', 12000, 30, 'bajuks.jpg', 'Baju untuk kucing'),
(10, 'Kalung Anjing Lapis Bahan Nylon', 24000, 50, 'kalungan.jpeg', 'Kalung keren dengan bahan nylon untuk anjing '),
(11, 'Pedigree Makanan Anjing Kering 1.5Kg', 68000, 15000, 'pedigree.jpeg', 'Makanan Anjing bergizi '),
(12, 'Pet Cargo Anjing', 295000, 2000, 'petcargo_a.jpg', 'Pet cargo anjing kualitas bagus'),
(13, 'Baju Anjing Bahan Katun', 50000, 30, 'bajuakatun.jpg', 'Baju anjing lucu dengan bahan katun yang hangat'),
(14, 'Tempat Tidur Anjing Bulu', 270000, 1000, 'tempattidur_a.jpg', 'Tempat tidur anjing nyaman diselimuti bulu lembut dengan tampilan mewah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
