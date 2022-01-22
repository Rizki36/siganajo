-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2022 at 04:07 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigampang`
--

-- --------------------------------------------------------

--
-- Table structure for table `penggeledahan`
--

CREATE TABLE `penggeledahan` (
  `id_penggeledahan` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama_penyidik` varchar(255) DEFAULT NULL,
  `nip_nrp` varchar(255) DEFAULT NULL,
  `nomor_telepon_wa` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `polres_polsek_pengaju` varchar(255) DEFAULT NULL,
  `jenis_permohonan` varchar(255) DEFAULT NULL,
  `files_json` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_dibaca` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penggeledahan`
--

-- --------------------------------------------------------

--
-- Table structure for table `penyitaan`
--

CREATE TABLE `penyitaan` (
  `id_penyitaan` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama_penyidik` varchar(255) DEFAULT NULL,
  `nip_nrp` varchar(255) DEFAULT NULL,
  `nomor_telepon_wa` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `polres_polsek_pengaju` varchar(255) DEFAULT NULL,
  `jenis_permohonan` varchar(255) DEFAULT NULL,
  `files_json` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_dibaca` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyitaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `perpanjangan`
--

CREATE TABLE `perpanjangan` (
  `id_perpanjangan` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tgl_surat` datetime NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `alasan_perpanjangan` varchar(255) NOT NULL,
  `nama_penyidik` varchar(255) NOT NULL,
  `nip_nrp` varchar(255) NOT NULL,
  `nomor_telepon_wa` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `polres_polsek_pengaju` varchar(255) NOT NULL,
  `tanggal_ba` date NOT NULL,
  `nama_pihak` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `tempat_tinggal` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `kebangsaan` varchar(255) NOT NULL,
  `files_json` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_dibaca` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perpanjangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `key` varchar(30) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`key`, `value`) VALUES
('images', '[{\"id\":1642399818,\"file_name\":\"1642399818_konten.png\"},{\"id\":1642399826,\"file_name\":\"1642399826_konten.jpg\"},{\"id\":1642399898,\"file_name\":\"1642399898_konten.png\"}]'),
('link_penggeledahan', ''),
('link_penyitaan', ''),
('link_perpanjangan_penahanan', ''),
('marquee', 'Mewujudkan peradilan yang sederhana, cepat, biaya ringan, dan transparan. Meningkatkan kualitas sumber daya aparatur peradilan dalam rangka peningkatan pelayanan pada masyarakat. Melaksanakan pengawasan dan pembinaan yang efektif dan efisien. Melaksanakan tertib administrasi dan manajemen peradilan yang efektif dan efisien. Mengupayakan tersedianya sarana dan prasarana peradilan sesuai dengan ketentuan yang berlaku.'),
('quotes', 'BERANI merupakan akronim dari BERdedikasi dalam melayANI'),
('redaksi_penggeledahan', 'Izin Penggeledahan adalah  Prosedur permintaan dari penyidik maupun penuntut umum kepada pengadilan untuk memasuki dan melakukan pemeriksaan menggeledah badan/pakaian, Rumah tinggal/tempat tertutup dalam keadaan perlu dan mendesak.'),
('redaksi_penyitaan', 'Izin Penyitaan Khusus adalah prosedur permintaan dari penyidik maupun penuntut umum kepada pengadilan untuk melakukan penyitaan benda yang diduga tersangkut dengan suatu Tindak pidana yang hanya dapat dilakukan dengan surat izin Ketua Pengadilan Negeri.\r\nIzin Penyitaan adalah prosedur permintaan dari penyidik atau penuntut umum kepada Pengadilan untuk menyita benda yang diduga tersangkut dengan suatu Tindakan pidana dalam keadaan yang sangat perlu ataupun mendesak. '),
('redaksi_perpanjangan_penahanan', 'Perpanjangan penahanan polisi atau jaksa penuntut umum yaitu Proses permintaan dari penyidik untuk memperpanjang masa penahanan tersangka ke pengadilan negeri  dikarenakan proses pemeriksaan belum selesai dan masa penahanan sudah hampir habis. '),
('redaksi_utama', 'Aplikasi ini dibuat dengan tujuan memudahkan penyidik untuk mengajukan izin atau persetujuan penyitaan dan penggeledahan, serta perpanjangan penahanan oleh Ketua Pengadilan Negeri Jombang. Penyidik tidak perlu datang ke Pengadilan guna memperoleh penetapan.\r\nCukup Mengisi data secara online kemudian setelah dikonfirmasi oleh petugas pengadilan, penyidik baru datang ke kantor Pengadilan Negeri Jombang dengan membawa berkas asli permohonan dan mengambil penetapan tidak perlu menunggu waktu lama karena  penetapan sudah jadi.'),
('sosmed_facebook', 'https://www.facebook.com/pages/Pengadilan-negeri-Jombang/102087756617819'),
('sosmed_instagram', 'https://www.instagram.com/pnjombang/'),
('sosmed_twitter', '#'),
('sosmed_whatsapp', '#');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `origin_unit` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_json` text NOT NULL,
  `is_verified` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penggeledahan`
--
ALTER TABLE `penggeledahan`
  ADD PRIMARY KEY (`id_penggeledahan`);

--
-- Indexes for table `penyitaan`
--
ALTER TABLE `penyitaan`
  ADD PRIMARY KEY (`id_penyitaan`);

--
-- Indexes for table `perpanjangan`
--
ALTER TABLE `perpanjangan`
  ADD PRIMARY KEY (`id_perpanjangan`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penggeledahan`
--
ALTER TABLE `penggeledahan`
  MODIFY `id_penggeledahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penyitaan`
--
ALTER TABLE `penyitaan`
  MODIFY `id_penyitaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `perpanjangan`
--
ALTER TABLE `perpanjangan`
  MODIFY `id_perpanjangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
