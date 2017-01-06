-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2017 at 03:54 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `nim` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `akses` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`nim`, `password`, `akses`) VALUES
('1415323061', '7eb832f5e44e61e4f3f7d6fa421a7fea', 'u'),
('1415323062', 'a54ff68bdca7c1d8111ab47cd021b573', 'u'),
('1415323063', '202cb962ac59075b964b07152d234b70', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `detail_user`
--

CREATE TABLE `detail_user` (
  `nim` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `angkatan` varchar(10) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_user`
--

INSERT INTO `detail_user` (`nim`, `nama`, `no_telp`, `jurusan`, `angkatan`, `status`) VALUES
('1415323061', 'Ananta Wijaya', 'null', 'Akuntansi', '2014', 'n'),
('1415323062', 'Made Ari ', 'null', 'null', '2014', 'n'),
('1415323063', 'Made Ari Sudarma', '0891122', 'Akuntansi', '2014', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_voting`
--

CREATE TABLE `hasil_voting` (
  `nim` varchar(50) NOT NULL,
  `no_pilihan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image_kadidat`
--

CREATE TABLE `image_kadidat` (
  `nim` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image_kadidat`
--

INSERT INTO `image_kadidat` (`nim`, `name`, `type`) VALUES
('1415323031', 'file_1482409312.jpg', 'image/jpeg'),
('1415323062', 'file_1482469245.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `image_user`
--

CREATE TABLE `image_user` (
  `nim` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image_user`
--

INSERT INTO `image_user` (`nim`, `name`, `type`) VALUES
('1415323061', '1.jpg', 'jpeg'),
('1415323062', 'file_1482498472.jpg', 'image/jpeg'),
('1415323063', 'file_1482498495.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE `kandidat` (
  `nim` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `no_kandidat` int(5) NOT NULL,
  `jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`nim`, `nama`, `jurusan`, `no_kandidat`, `jabatan`) VALUES
('1415323031', 'Ian Rizky', 'Teknik Elektro', 1, 'Presma'),
('1415323062', 'Ananta Wijaya', 'Pariwisata', 2, 'Presma');

-- --------------------------------------------------------

--
-- Table structure for table `keluhan`
--

CREATE TABLE `keluhan` (
  `nim` varchar(50) NOT NULL,
  `deskripsi` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_peng` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `deskripsi` varchar(20000) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_peng`, `judul`, `deskripsi`, `last_edited`) VALUES
(2, 'Vote Sudah dimulai', 'Tombol memilih sudah aktif silahkan lihat profil calon dan tekan tombol vote untuk memilih', '2016-12-21 12:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `tgl_voting`
--

CREATE TABLE `tgl_voting` (
  `id` int(11) NOT NULL,
  `start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tgl_voting`
--

INSERT INTO `tgl_voting` (`id`, `start`, `end`) VALUES
(1, '2016-12-22 22:27:00', '2016-12-23 22:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `visimisi`
--

CREATE TABLE `visimisi` (
  `no_kandidat` int(5) NOT NULL,
  `visi` varchar(500) NOT NULL,
  `misi` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visimisi`
--

INSERT INTO `visimisi` (`no_kandidat`, `visi`, `misi`) VALUES
(1, 'Menjadikan KBM PNB sebagai wadah untuk menampung semua inspirasi mahasiswa', 'Entahlah'),
(2, 'asd', ' asd'),
(3, 'Asd', ' asd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `detail_user`
--
ALTER TABLE `detail_user`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `image_user`
--
ALTER TABLE `image_user`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_peng`);

--
-- Indexes for table `tgl_voting`
--
ALTER TABLE `tgl_voting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visimisi`
--
ALTER TABLE `visimisi`
  ADD PRIMARY KEY (`no_kandidat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_peng` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tgl_voting`
--
ALTER TABLE `tgl_voting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
