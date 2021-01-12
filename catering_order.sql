-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2021 at 02:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catering_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat_pembeli`
--

CREATE TABLE `alamat_pembeli` (
  `IDpembeli` int(10) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alamat_pembeli`
--

INSERT INTO `alamat_pembeli` (`IDpembeli`, `alamat`) VALUES
(3, 'Margonda, Depok'),
(4, 'Tegal');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `menuID` int(11) DEFAULT NULL,
  `kodetransaksi` int(11) NOT NULL,
  `jmlmenu` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`menuID`, `kodetransaksi`, `jmlmenu`) VALUES
(3, 4, 2),
(4, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `IDKategori` int(11) NOT NULL,
  `namakategori` varchar(100) DEFAULT NULL,
  `menuID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`IDKategori`, `namakategori`, `menuID`) VALUES
(1, 'Makanan', 3),
(1, 'Makanan', 4),
(2, 'Minuman', 6),
(2, 'Minuman', 7),
(2, 'Minuman', 9);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuID` int(10) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `harga` int(7) DEFAULT NULL,
  `IDpenjual` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuID`, `deskripsi`, `nama`, `gambar`, `harga`, `IDpenjual`) VALUES
(3, 'Roti Bakar Keju Mantap', 'Grilled Cheese Sandwich', 'asnim-ansari-SqYmTDQYMjo-unsplash.jpg', 15000, 1),
(4, 'Cake with pistachio and raspberries', 'Berry Cake', 'anna-tukhfatullina-food-photographer-stylist-Mzy-OjtCI70-unsplash.jpg', 45000, 1),
(6, 'Es Teh Manis Anget dengan manis gula jawa tengah, Indonesia', 'Es Teh Manis Anget', 'food-photographer-jennifer-pallian-sSnCZlEWN5E-unsplash.jpg', 5000, 1),
(7, 'Espresso + Susu', 'Cappucino', 'william-moreland-eSzClaMXNkk-unsplash.jpg', 25000, 1),
(9, 'Jus lemon, air, dan madu', 'Lemonade', 'sigmund-7_sh64mY-v8-unsplash.jpg', 30000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `IDpembeli` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `telepon` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`IDpembeli`, `email`, `password`, `nama`, `telepon`) VALUES
(3, 'zul@gmail.com', '$2y$10$8TEHmzE2K/ARacbYgYOTie4DgncNiC4CA9htsW3IT2ztRLLI0/oXu', 'Zul', '0898123786');

-- --------------------------------------------------------

--
-- Table structure for table `penjual`
--

CREATE TABLE `penjual` (
  `IDpenjual` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `telepon` varchar(14) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjual`
--

INSERT INTO `penjual` (`IDpenjual`, `email`, `password`, `nama`, `telepon`, `alamat`, `deskripsi`, `foto`) VALUES
(1, 'henakatering@gmail.com', '$2y$10$sh1Vkfij.rk/jZKcwwTiBOsLxcSD.x9pG6CzqivB/EBWRq42zlY1G', 'Hena Katering', '0815423678', 'Margonda, Depok', 'Hena Katering adalah tempat yang menyediakan berbagai menu pilihan mulai dari nasi box hingga jajanan tradisional', 'Monas.png');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kodetransaksi` int(10) NOT NULL,
  `IDpembeli` int(10) NOT NULL,
  `IDpenjual` int(10) NOT NULL,
  `tanggal_transaksi` datetime DEFAULT current_timestamp(),
  `total_harga` int(7) DEFAULT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kodetransaksi`, `IDpembeli`, `IDpenjual`, `tanggal_transaksi`, `total_harga`, `status`) VALUES
(4, 3, 1, '2021-01-04 23:07:01', 120000, 'inChart');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat_pembeli`
--
ALTER TABLE `alamat_pembeli`
  ADD PRIMARY KEY (`alamat`),
  ADD KEY `IDpembeli` (`IDpembeli`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `menuID` (`menuID`),
  ADD KEY `kodetransaksi` (`kodetransaksi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`menuID`),
  ADD KEY `menuID` (`menuID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuID`),
  ADD KEY `IDpenjual` (`IDpenjual`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`IDpembeli`);

--
-- Indexes for table `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`IDpenjual`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kodetransaksi`),
  ADD KEY `IDpembeli` (`IDpembeli`),
  ADD KEY `IDpenjual` (`IDpenjual`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `IDpembeli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penjual`
--
ALTER TABLE `penjual`
  MODIFY `IDpenjual` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `kodetransaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat_pembeli`
--
ALTER TABLE `alamat_pembeli`
  ADD CONSTRAINT `alamat_pembeli_ibfk_1` FOREIGN KEY (`IDpembeli`) REFERENCES `pembeli` (`IDpembeli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`menuID`) REFERENCES `menu` (`menuID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kodetransaksi` FOREIGN KEY (`kodetransaksi`) REFERENCES `transaksi` (`kodetransaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori_ibfk_1` FOREIGN KEY (`menuID`) REFERENCES `menu` (`menuID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`IDpenjual`) REFERENCES `penjual` (`IDpenjual`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`IDpembeli`) REFERENCES `pembeli` (`IDpembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`IDpenjual`) REFERENCES `penjual` (`IDpenjual`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
