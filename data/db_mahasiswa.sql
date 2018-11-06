-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2018 at 03:41 AM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mahasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_acara`
--

CREATE TABLE `tb_acara` (
  `id` int(11) NOT NULL,
  `namaacara` varchar(100) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `waktumulai` datetime NOT NULL,
  `waktuselesai` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_daerah`
--

CREATE TABLE `tb_daerah` (
  `id` int(11) NOT NULL,
  `namadaerah` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_desa`
--

CREATE TABLE `tb_desa` (
  `id` int(11) NOT NULL,
  `namadesa` varchar(30) NOT NULL,
  `iddaerah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_infopeserta`
--

CREATE TABLE `tb_infopeserta` (
  `id` int(11) NOT NULL,
  `kampus` varchar(80) DEFAULT NULL,
  `fakultas` varchar(80) DEFAULT NULL,
  `jurusan` varchar(60) DEFAULT NULL,
  `angkatan` year(4) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `telepon` varchar(30) DEFAULT NULL,
  `teleponcadangan` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kehadiran`
--

CREATE TABLE `tb_kehadiran` (
  `id` int(11) NOT NULL,
  `idacara` int(11) NOT NULL,
  `idpeserta` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelompok`
--

CREATE TABLE `tb_kelompok` (
  `id` int(11) NOT NULL,
  `namakelompok` varchar(30) NOT NULL,
  `iddesa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_peserta`
--

CREATE TABLE `tb_peserta` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jeniskelamin` char(1) NOT NULL,
  `iddaerah` int(11) NOT NULL,
  `iddesa` int(11) NOT NULL,
  `idkelompok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `email`, `password`) VALUES
(1, 'Fadhil Imam Kurnia', 'fadhilimamk@gmail.com', 'ac43724f16e9241d990427ab7c8f4228'),
(2, 'Lifardi Muhammad', 'lifardi@gmail.com', 'ac43724f16e9241d990427ab7c8f4228'),
(3, 'Admin 3', 'admin3@jokam.com', 'ac43724f16e9241d990427ab7c8f4228'),
(4, 'ardi', 'ardi@sidara.com', '2ce8d7d5509d9b3623a3c0b8b10f7d11'),
(5, 'Mochamad Ridwan', 'tansa.dynasty@gmail.com', '5c62a485ae3c5c19a03ddde1e3215b84'),
(6, 'Novia Nur Annisa', 'novia.annisa@gmail.com', '27355a72dbda2dd931a2b15bd1b0a852'),
(7, 'Nadiyya Brigita Aiska', 'nadiyyabrigita@gmail.com', '7c5cf40044890550d20ac8bddfeb13ea'),
(8, 'Chomsaniarti Nur Utami Puteri', 'comocomsa@yahoo.com', 'fbfc60ce3a9423310d8d55865af0cf08'),
(9, 'Nurul Ezkanandyta', 'nurulezkanandyta@gmail.com', 'ef8918a206a9b57d8543c1d07ce8ecb1'),
(10, 'Aprilia Tri Dzuliani', 'apriliatridzuliani@gmail.com', 'efbb3f34b525947177a4697eca13290f'),
(11, 'Rizkya Dwi Utami', 'kyachia@gmail.com', 'e172dd95f4feb21412a692e73929961e'),
(12, 'Fadhila Prameswari', 'lalaprameswari098@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(13, 'Rizkya Dwi Utami', 'kyachia@gmail.com', 'c685bc02cc1fce8f709586e3312caef5'),
(14, 'Admin', 'admin@mmbr.com', 'ac43724f16e9241d990427ab7c8f4228');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_acara`
--
ALTER TABLE `tb_acara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_daerah`
--
ALTER TABLE `tb_daerah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_desa`
--
ALTER TABLE `tb_desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iddesa` (`iddaerah`);

--
-- Indexes for table `tb_infopeserta`
--
ALTER TABLE `tb_infopeserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kehadiran`
--
ALTER TABLE `tb_kehadiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kelompok`
--
ALTER TABLE `tb_kelompok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iddesa` (`iddesa`);

--
-- Indexes for table `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_acara`
--
ALTER TABLE `tb_acara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_daerah`
--
ALTER TABLE `tb_daerah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_desa`
--
ALTER TABLE `tb_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `tb_kehadiran`
--
ALTER TABLE `tb_kehadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=917;
--
-- AUTO_INCREMENT for table `tb_kelompok`
--
ALTER TABLE `tb_kelompok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;
--
-- AUTO_INCREMENT for table `tb_peserta`
--
ALTER TABLE `tb_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1450;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_desa`
--
ALTER TABLE `tb_desa`
  ADD CONSTRAINT `idx_desa_kelompok` FOREIGN KEY (`iddaerah`) REFERENCES `tb_daerah` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tb_infopeserta`
--
ALTER TABLE `tb_infopeserta`
  ADD CONSTRAINT `fk_infopeserta` FOREIGN KEY (`id`) REFERENCES `tb_peserta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kelompok`
--
ALTER TABLE `tb_kelompok`
  ADD CONSTRAINT `idx_kelompok_desa` FOREIGN KEY (`iddesa`) REFERENCES `tb_desa` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
