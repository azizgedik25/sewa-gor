-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2019 at 04:11 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sewa-lapangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(10) NOT NULL,
  `nama` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `hp` varchar(300) NOT NULL,
  `jumlah_lap` int(10) NOT NULL,
  `tot` int(70) NOT NULL,
  `id_pengguna` int(10) NOT NULL,
  `id_lapangan` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` mediumtext NOT NULL,
  `status` enum('belum','sudah','batal') NOT NULL DEFAULT 'belum',
  `bank` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `jam_mulai` int(25) NOT NULL,
  `jam_selesai` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `nama`, `email`, `hp`, `jumlah_lap`, `tot`, `id_pengguna`, `id_lapangan`, `tanggal`, `keterangan`, `status`, `bank`, `file`, `tanggal_bayar`, `jam_mulai`, `jam_selesai`) VALUES
(1, 'Rohmatul Khawasitin', 'rohmatul@gmail.com', '085252676523', 1, 180000, 1, 1, '2017-12-16', '', 'belum', 'BRI', '', '2018-11-24', 8, 9),
(2, 'Rahmad Nasution', 'rahmad@gmail.com', '081256243211', 1, 360000, 2, 1, '2018-11-25', '', 'sudah', '', '', '0000-00-00', 8, 10);

-- --------------------------------------------------------

--
-- Table structure for table `jam`
--

CREATE TABLE `jam` (
  `id_jam` int(11) NOT NULL,
  `jam_mulai` int(25) NOT NULL,
  `jam_selesai` int(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jam`
--

INSERT INTO `jam` (`id_jam`, `jam_mulai`, `jam_selesai`) VALUES
(1, 8, 8),
(2, 9, 9),
(3, 10, 10),
(4, 11, 11),
(5, 12, 12),
(6, 13, 13),
(7, 14, 14),
(8, 15, 15),
(9, 16, 16),
(10, 17, 17),
(11, 18, 18),
(12, 19, 19),
(13, 20, 20),
(14, 21, 21);

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `lapangan_id` int(11) NOT NULL,
  `keterangan` varchar(900) NOT NULL DEFAULT '',
  `judul` varchar(50) DEFAULT NULL,
  `alamat` varchar(900) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` varchar(100) NOT NULL,
  `foto1` varchar(50) DEFAULT NULL,
  `foto2` varchar(50) DEFAULT NULL,
  `foto3` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`lapangan_id`, `keterangan`, `judul`, `alamat`, `jumlah`, `harga`, `foto1`, `foto2`, `foto3`) VALUES
(1, 'Lapangan dengan luas 1 Hektar, dipenuhi rumput hijau.', 'Lapangan Sepak Bola Arena 1', 'Jl. Imam Bonjol, Kediri, Jawa Timur', 1, '180000', 'heru1.jpg', 'heru2.jpg', 'heru3.jpg'),
(2, 'Luas Lapangan 300 Meter Persegi', 'Lapangan Sepak Bola Arena 2', 'Jl. Imam Bonjol, Kediri, Provinsi Jawa Timur', 1, '120000', 'heru4.jpg', 'heru5.jpg', 'heru6.jpg'),
(3, 'Luas lapangan 2 Hectare, Besar sekali bos Q', 'Lapangan Sepak Bola Arena 3', 'Jl. Imam Bonjol, Kediri, Provinsi Jawa Timur', 1, '220000', 'heru7.jpg', 'heru8.jpg', 'heru9.jpg'),
(4, 'Luas Lapangan 400 Meter Persegi cocok buat pemain basket.', 'Lapangan Basket', 'Jl. Imam Bonjol, Kediri, Provinsi Jawa Timur', 1, '70000', 'heru10.jpg', 'heru11.jpg', 'heru12.jpg'),
(5, 'Memiliki luas lapangan 900 Meter Persegi, dilengkapi dengan net dan lantai yang cocok buat para pemain bola voli.', 'Lapangan Bola Voli Arena 1', 'Jl. Imam Bonjol, Kediri, Provinsi Jawa Timur', 1, '70000', 'heru13.jpg', 'heruvoli.jpeg', 'heru15.jpg'),
(6, 'Luas Lebih dari 3 Hectare. Terdiri dari beberapa stage lapangan bermain', 'Lapangan Bulu Tangkis (LEBAR)', 'Jl.Imam Bonjol, Kediri, Provinsi Jawa Timur', 1, '70000', 'heru16.jpg', 'heru17.jpg', 'heru18.jpg'),
(7, 'Tersedia 4 Tenis Meja', 'Arena Olahraga Tenis Meja', 'Jl. Imam Bonjol, Kediri, Provinsi Jawa Timur', 1, '65000', 'user_id__IMG-20170728-WA0023.jpg', 'user_id__IMG-20170728-WA0026.jpg', 'user_id__venuetenis.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `email` varchar(19) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL,
  `status` enum('sudah','belum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `hp`, `email`, `username`, `password`, `level`, `status`) VALUES
(1, 'Rohmatul Khawasitin', '085252676523', 'rohmatul@gmail.com', 'rohmatul', '6347d7e54a553f2830589261b5b8ed76', 'pengguna', 'sudah'),
(2, 'Rahmad Nasution', '081256243211', 'rahmad@gmail.com', 'rahmad', '6878c309268c7bc852fb0f81c6419904', 'pengguna', 'sudah');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(50) NOT NULL,
  `nama` varchar(300) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `jam`
--
ALTER TABLE `jam`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`lapangan_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jam`
--
ALTER TABLE `jam`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `lapangan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
