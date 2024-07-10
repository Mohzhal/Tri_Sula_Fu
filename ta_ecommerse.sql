-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2024 at 05:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_ecommerse`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id_checkout` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `card_number` int(11) DEFAULT NULL,
  `card_expired` date DEFAULT NULL,
  `cvv` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id_checkout`, `id_user`, `nama`, `card_number`, `card_expired`, `cvv`, `total`) VALUES
(4, 2, 'Pembeli 1', 2147483647, '2024-07-10', 321, 600);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id_contact`, `nama`, `email`, `message`) VALUES
(1, 'Saka Devs', 'sakadevs@gmail.com', 'Semangat...');

-- --------------------------------------------------------

--
-- Table structure for table `detail_checkout`
--

CREATE TABLE `detail_checkout` (
  `id_checkout` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_checkout`
--

INSERT INTO `detail_checkout` (`id_checkout`, `id_produk`) VALUES
(4, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(1, 'Top Produk'),
(2, 'Cooking Set'),
(3, 'Sleeping Bag'),
(4, 'Tas Carier'),
(5, 'Sepatu'),
(6, 'Celana'),
(7, 'Tenda');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `bintang` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `gambar`, `nama`, `harga`, `bintang`) VALUES
(1, 1, 'produk1.jpg', 'Tas Carier', 600, 4),
(2, 1, 'produk2.jpg', 'Apple Watch', 300, 5),
(3, 5, 'sepatu1.png', 'Gray Hiking Boots', 700, 5),
(4, 5, 'sepatu2.png', 'White Hiking Boots', 800, 4),
(5, 5, 'sepatu3.png', 'Army Hiking Boots', 600, 4),
(6, 4, 'tas1.png', 'Yellow Carier', 900, 5),
(7, 4, 'tas2.png', 'Solid Metalic Carier', 800, 4),
(8, 4, 'tas3.png', 'Army Carier', 1000, 4),
(9, 4, 'tas4.png', 'Blue Sky Carier', 900, 3),
(10, 1, 'SB1.png', 'Green Sleeping Bag', 500, 5),
(11, 3, 'SB2.png', 'Portable Sleeping Bag', 700, 4),
(12, 3, 'SB3.png', 'Colorfull Sleeping Bag', 400, 3),
(13, 3, 'SB4.png', 'Metalic Sleeping Bag', 800, 2),
(14, 6, 'Celana2.png', 'Celana Pendakian', 900, 4),
(15, 6, 'Celana3.png', 'Celana Pendakian', 800, 4),
(16, 7, 'tenda1.png', 'Gray Dome Tent', 800, 4),
(17, 7, 'tenda2.png', 'Green Dome Tent', 600, 4),
(18, 7, 'tenda3.png', 'White Dome Tent', 700, 4),
(19, 7, 'tenda4.png', 'Blue Dome Tent', 800, 4),
(20, 2, 'Cooking1.png', 'Alat Masak 1', 500, 4),
(21, 2, 'Cooking2.png', 'Alat Masak 2', 600, 3),
(22, 2, 'Cooking3.png', 'Alat Masak 3', 700, 5),
(23, 2, 'Cooking4.png', 'Alat Masak 4', 600, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `nama`, `password`) VALUES
(1, 'user1@gmail.com', 'User 1', '72797cb37f9900545fcd58be1001d0f69af810cdc3d4006bc90674c32a21b27d'),
(2, 'userbaru@gmail.com', 'User Baru', '8e25728b9af13e14136b4ed9111c279875885ada4625afb28758c60e30bd0ecd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id_checkout`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `detail_checkout`
--
ALTER TABLE `detail_checkout`
  ADD KEY `id_checkout` (`id_checkout`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id_checkout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_checkout`
--
ALTER TABLE `detail_checkout`
  ADD CONSTRAINT `detail_checkout_ibfk_1` FOREIGN KEY (`id_checkout`) REFERENCES `checkout` (`id_checkout`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_checkout_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
