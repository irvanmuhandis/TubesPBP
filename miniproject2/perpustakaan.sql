-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2021 at 04:40 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `nim` int(14) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`nim`, `nama`, `password`, `alamat`, `kota`, `email`, `no_telp`) VALUES
(9999444, 'Asem', '81dc9bdb52d04dc20036dbd8313ed055', 'Di hatimu', 'Lama', 'jujurrrrr@gmail.com', '080000000000'),
(240600001, 'Fahmi', '81dc9bdb52d04dc20036dbd8313ed055', 'Semarang', 'Semarang', 'fahmi@mail.com', '08123456'),
(240600002, 'Muhan', '81dc9bdb52d04dc20036dbd8313ed055', 'Semarang', 'Semarang', 'muhan@mail.com', '08123457'),
(240600003, 'Juan', '81dc9bdb52d04dc20036dbd8313ed055', 'Semarang', 'Semarang', 'juan@mail.com', '08123458'),
(240600004, 'Elsa', '81dc9bdb52d04dc20036dbd8313ed055', 'Semarang', 'Semarang', 'elsa@mail.com', '08123459'),
(240600005, 'Lintang', '81dc9bdb52d04dc20036dbd8313ed055', 'Semarang', 'Semarang', 'lintang@mail.com', '08123460'),
(240600006, 'Sutan', '81dc9bdb52d04dc20036dbd8313ed055', 'Semarang', 'Semarang', 'sutan@mail.com', '08123461'),
(2121112321, 'Budi', '81dc9bdb52d04dc20036dbd8313ed055', 'Di hatimu', 'Lama', 'satu@mail.com', '080000000000');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `idbuku` int(5) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `idkategori` int(5) NOT NULL,
  `pengarang` varchar(30) NOT NULL,
  `penerbit` varchar(30) NOT NULL,
  `kota_terbit` varchar(30) NOT NULL,
  `editor` varchar(30) NOT NULL,
  `file_gambar` varchar(255) DEFAULT NULL,
  `tgl_insert` date NOT NULL,
  `tgl_update` date NOT NULL,
  `stok` int(5) NOT NULL,
  `stok_tersedia` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`idbuku`, `isbn`, `judul`, `idkategori`, `pengarang`, `penerbit`, `kota_terbit`, `editor`, `file_gambar`, `tgl_insert`, `tgl_update`, `stok`, `stok_tersedia`) VALUES
(9, '111-A', 'Gundam', 1, 'Yoshiyuki Tomino', 'Yoshiyuki Tomino', 'Jepang', 'military fiction media franchi', '6Lix70H.png', '2021-10-22', '2021-10-22', 10, 32),
(10, '111-B', 'Light Of Darkness', 1, 'Gremine', 'Gree', 'Jepang', 'Fahmi Al Chaudy', 'chrome_LEjtu92cgr.png', '2021-10-22', '2021-10-22', 22, 31),
(11, '111-C', 'Kehampaan Dunia', 2, 'Josept Guardian', 'Josept G', 'Menchester', 'Fahmi Al Chaudy', 'imageedit_1_6023380469 (2).jpg', '2021-10-22', '2021-10-22', 33, 31),
(12, '111-D', 'Lord Of Earth', 2, 'Murayama', 'Murayama', 'Mexico', 'Fahmi Al Chaudy', 'red-five-ancient-apparition-fanart.jpg', '2021-10-22', '2021-10-22', 50, 50),
(13, '111-E', 'Langit dan Cahaya', 1, 'Juan  Audrica', 'Juan', 'Kota Semarang', 'Fahmi Al Chaudy', 'b6a1c7282fa9c77bc363b3fdd94c328f_l.jp_-600x400.jpg', '2021-10-22', '2021-10-22', 7, 50);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `idtransaksi` int(5) NOT NULL,
  `idbuku` int(5) NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `denda` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`idtransaksi`, `idbuku`, `tgl_kembali`, `denda`) VALUES
(85, 10, NULL, 0),
(85, 11, NULL, 0),
(86, 12, '2021-10-22', 0),
(86, 13, '2021-10-22', 81000),
(87, 9, '2021-10-22', 0),
(87, 11, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(5) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama`) VALUES
(1, 'Fantasi'),
(2, 'Horror');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `idtransaksi` int(5) NOT NULL,
  `nim` int(14) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `total_denda` int(10) NOT NULL,
  `idpetugas` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`idtransaksi`, `nim`, `tgl_pinjam`, `total_denda`, `idpetugas`) VALUES
(85, 240600002, '2014-10-21', 0, 1),
(86, 240600003, '2021-07-19', 81000, 1),
(87, 240600001, '2021-10-22', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `idpetugas` int(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`idpetugas`, `nama`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`idbuku`),
  ADD KEY `FK_Buku_Kategori` (`idkategori`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `FK_DetailT_Buku` (`idbuku`),
  ADD KEY `FK_DetailT_Peminjaman` (`idtransaksi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`idtransaksi`),
  ADD KEY `FK_Peminjaman_Anggota` (`nim`),
  ADD KEY `FK_Peminjaman_Petugas` (`idpetugas`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`idpetugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `idbuku` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `idtransaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `idpetugas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `FK_Buku_Kategori` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`);

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `FK_DetailT_Buku` FOREIGN KEY (`idbuku`) REFERENCES `buku` (`idbuku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DetailT_Peminjaman` FOREIGN KEY (`idtransaksi`) REFERENCES `peminjaman` (`idtransaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `FK_Peminjaman_Anggota` FOREIGN KEY (`nim`) REFERENCES `anggota` (`nim`),
  ADD CONSTRAINT `FK_Peminjaman_Petugas` FOREIGN KEY (`idpetugas`) REFERENCES `petugas` (`idpetugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
