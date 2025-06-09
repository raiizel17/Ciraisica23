-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2025 at 09:35 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `latihan23cap`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `idberita` int(11) NOT NULL,
  `judul` varchar(20) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `headline` varchar(20) NOT NULL,
  `isi_berita` text NOT NULL,
  `pengirim` varchar(20) NOT NULL,
  `tanggal_publish` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`idberita`, `judul`, `kategori`, `headline`, `isi_berita`, `pengirim`, `tanggal_publish`) VALUES
(2, 'Kesulitan Liverpool', 'Sport', 'Struggle TIm Inggris', 'Liverpool baru saja menelan kekalahan dalam lawatannya ke markas Brighton &amp; Hove Albion. Bertanding di American Express Stadium, Selasa (20/5/2025) dini hari WIB, Liverpool yang sempat unggul dua kali akhirnya kalah 2-3.\r\n\r\nItu berarti Liverpool tidak pernah menang dalam tiga pertandingan setelah mengunci gelar juara Premier League. Setelah kemenangan atas Tottenham Hotspur yang memastikan gelar juara, Mohamed Salah dkk. cuma imbang satu kali dan kalah dua kali.\r\n\r\nBaca artikel sepakbola, \"Liverpool Belum Pernah Menang Usai Kunci Gelar Juara\" selengkapnya https://sport.detik.com/sepakbola/liga-inggris/d-7922264/liverpool-belum-pernah-menang-usai-kunci-gelar-juara.', 'Satya', '2025-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(255) NOT NULL,
  `spesialisasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `spesialisasi`) VALUES
(1, 'Dr. Budi Santoso', 'Umum'),
(2, 'Dr. Siti Aminah', 'Anak'),
(3, 'Dr. Agus Wijaya', 'Penyakit Dalam'),
(4, 'Dr. Rina Kartika', 'Kandungan'),
(5, 'Dr. Joko Susilo', 'Gigi');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nidn` int(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jeniskel` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama`, `alamat`, `jeniskel`, `email`, `telp`) VALUES
(234683082, 'lilis', 'kalimantan', 'Perempuan', 'lilis@gmail.com', '9287398722'),
(1111111111, 'wwwaa', 'semarangw', 'Laki-Laki', 'warn1i@gmail.com', '08936812839'),
(2147483647, 'warni', 'semarang', 'Laki-Laki', 'warni@gmail.com', '08936812839');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_berita`
--

CREATE TABLE `kategori_berita` (
  `idberita` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_berita`
--

INSERT INTO `kategori_berita` (`idberita`, `kategori`) VALUES
(1, 'Sport'),
(2, 'Lifestyle');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text,
  `no_telp` varchar(20) DEFAULT NULL,
  `tanggal_registrasi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `nik`, `tanggal_lahir`, `alamat`, `no_telp`, `tanggal_registrasi`) VALUES
(1, 'Raihan Badruzzaman', '3603212312313231', '2004-07-16', 'tangerang', '0894875939859', '2025-06-09 09:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_pasien`
--

CREATE TABLE `pendaftaran_pasien` (
  `id_pendaftaran` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_calon_pasien` varchar(255) NOT NULL,
  `nik_calon_pasien` varchar(16) NOT NULL,
  `tanggal_lahir_calon` date DEFAULT NULL,
  `alamat_calon` text,
  `no_telp_calon` varchar(20) DEFAULT NULL,
  `keluhan_penyakit` text,
  `id_dokter_pilihan` int(11) DEFAULT NULL,
  `tanggal_daftar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_rencana_kunjungan` date DEFAULT NULL,
  `jam_kunjungan_diinginkan` time DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak','diproses') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftaran_pasien`
--

INSERT INTO `pendaftaran_pasien` (`id_pendaftaran`, `id_user`, `nama_calon_pasien`, `nik_calon_pasien`, `tanggal_lahir_calon`, `alamat_calon`, `no_telp_calon`, `keluhan_penyakit`, `id_dokter_pilihan`, `tanggal_daftar`, `tanggal_rencana_kunjungan`, `jam_kunjungan_diinginkan`, `status`) VALUES
(1, 5, 'Raihan Badruzzaman', '3603212312313231', '2004-07-16', 'tangerang', '0894875939859', 'Sakit', 1, '2025-06-09 09:09:11', '2025-06-11', '18:07:00', 'disetujui'),
(2, 6, 'Hendra kurniawan', '2635719763962987', '2025-06-01', 'Sukamulya', '0865376569756', 'Sakit kaki', 1, '2025-06-09 09:28:44', '2025-06-19', '09:30:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','','') NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `create_at`) VALUES
(1, 'erinaki', '$2y$10$8xdFS9vM1SFrN3hCxAgUeO/RBy7pPMDdSTx2dVTHpYzrRT9otI97u', 'user', '2025-03-18 03:04:56'),
(2, 'alikalista', '$2y$10$V64x.Z/mufGUl0UEv5Zw2udMOVJDdEcRpIo5TeVCnp8i9knXtCstm', 'user', '2025-03-24 16:23:58'),
(3, 'karinasaya', '$2y$10$29ijeeGdGBsheB5D9CAlEe/6YOZd1Fa3tSvOSPiKS37xga1YedCei', 'user', '2025-04-29 02:34:43'),
(4, 'petugas', '$2y$10$KUfEevrPvu5OycnlaXWKaud442Uim2Wk7mzEk4gpmT8.RrqD2Vl1i', 'user', '2025-04-29 03:44:37'),
(5, 'raihan', '$2y$10$GAnzoeCSZX2p1plrk0THNOM5EMXcGS6hKt2ajpP7r4rC5sgKAYZFq', 'admin', '2025-05-06 01:01:33'),
(6, 'tungtungsahur', '$2y$10$3fA94BeQZWPeQ0qAaIIW7etAb5XDF9cPJOc5vdtdkT2i4l8lmzuDe', 'user', '2025-05-06 01:42:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`idberita`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nidn`);

--
-- Indexes for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  ADD PRIMARY KEY (`idberita`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `nik_pasien_unique` (`nik`);

--
-- Indexes for table `pendaftaran_pasien`
--
ALTER TABLE `pendaftaran_pasien`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD UNIQUE KEY `nik_calon_pasien_unique` (`nik_calon_pasien`),
  ADD KEY `fk_pendaftaran_user` (`id_user`),
  ADD KEY `fk_pendaftaran_dokter` (`id_dokter_pilihan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `idberita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `nidn` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

--
-- AUTO_INCREMENT for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  MODIFY `idberita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendaftaran_pasien`
--
ALTER TABLE `pendaftaran_pasien`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
