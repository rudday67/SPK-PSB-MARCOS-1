-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2025 at 03:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_psb`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama`) VALUES
(76, 'Adetasya Maulidina'),
(77, 'Gede Adrian Putra Mastono'),
(78, 'Gede Eka Wibawa Putra'),
(79, 'Gede Erlan Subakti'),
(80, 'Gede Septia Pratama'),
(81, 'Gusti Ayu Pandan Harum Dani'),
(82, 'Hartik Puji Widayanti'),
(83, 'I Gede Astra Wiguna'),
(84, 'I Gede Nakula Putra Mahayasa'),
(85, 'I Gede Yoga Pratama Putra'),
(86, 'I Gusti Ayu Dinda Prameswari'),
(87, 'I Gusti Ayu Made Wirya Apsari'),
(88, 'I Luh Sugiantari'),
(89, 'I Made Dony Permana Putra'),
(90, 'I Putu Rizky Pramana Putra'),
(91, 'Kadek Dwi Antari'),
(92, 'Kadek Kendi Sugiantari'),
(93, 'Kadek Widiarta'),
(94, 'Ketut Agni Bunga Harum Dani'),
(95, 'Ketut Agus Ariadiasa'),
(96, 'Komang April Yani'),
(97, 'Komang Budi Harta Darma Yuda'),
(98, 'Ketut Sariasih'),
(99, 'Komang Devana Satya Pradinata'),
(100, 'Komang Resmawan'),
(101, 'Komang Uki Ista Jayanti'),
(102, 'Komang Widya Apriliani'),
(103, 'Luh Antari'),
(104, 'Luh Darpianing'),
(105, 'Luh Putu Aris Trisnawati'),
(106, 'Luh Putu Ditha Masayu Dewi'),
(107, 'Ni Luh Eka Putri Suari'),
(108, 'Ni Luh Sri Sulasmini'),
(109, 'Putu Bayu Aprianata'),
(110, 'Putu Budi Astawa'),
(111, 'Putu Bunga Carolina Sari'),
(112, 'Putu Dhrti Ayodhya Nugraha'),
(113, 'Putu Juwita Waringinsih'),
(114, 'Putu Onedy Asta'),
(115, 'Putu Palguna Adisantika'),
(116, 'Putu Rato Jinada'),
(117, 'Putu Riska Widiantari'),
(118, 'Putu Sujana Eka Nugraha'),
(119, 'Putu Sumiadi Ratnadi');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_alternatif`, `nilai`) VALUES
(483445, 76, 1.85296),
(483446, 77, 1.77177),
(483447, 78, 1.85048),
(483448, 79, 2.08207),
(483449, 80, 1.87528),
(483450, 81, 2.0787),
(483451, 82, 1.8888),
(483452, 83, 1.86873),
(483453, 84, 1.82928),
(483454, 85, 1.88054),
(483455, 86, 1.89707),
(483456, 87, 1.88692),
(483457, 88, 1.86648),
(483458, 89, 1.89896),
(483459, 90, 1.81913),
(483460, 91, 1.90233),
(483461, 92, 1.88993),
(483462, 93, 1.86761),
(483463, 94, 1.88993),
(483464, 95, 1.89482),
(483465, 96, 1.90084),
(483466, 97, 1.89181),
(483467, 98, 1.85745),
(483468, 99, 1.90722),
(483469, 100, 1.85745),
(483470, 101, 1.81026),
(483471, 102, 1.85821),
(483472, 103, 2.07983),
(483473, 104, 1.84694),
(483474, 105, 1.82214),
(483475, 106, 1.87363),
(483476, 107, 1.87415),
(483477, 108, 1.81985),
(483478, 109, 0.582567),
(483479, 110, 0.631409),
(483480, 111, 1.89181),
(483481, 112, 1.84882),
(483482, 113, 1.83229),
(483483, 114, 1.89482),
(483484, 115, 1.86347),
(483485, 116, 1.89896),
(483486, 117, 1.8516),
(483487, 118, 1.89896),
(483488, 119, 1.8898);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `kode_kriteria` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `jenis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `keterangan`, `kode_kriteria`, `bobot`, `jenis`) VALUES
(67, 'Nilai Rapot ', 'K1', 0.3, 'Benefit'),
(68, 'Nilai IPC', 'K2', 0.25, 'Benefit'),
(69, 'Prestasi', 'K3', 0.2, 'Benefit'),
(70, 'Absensi', 'K4', 0.15, 'Cost'),
(71, 'Ekstrakurikuler', 'K5', 0.1, 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(76, 63, 67, 90),
(77, 63, 68, 50),
(78, 63, 69, 30),
(79, 63, 70, 0.1),
(80, 63, 71, 4),
(86, 65, 67, 67),
(87, 65, 68, 69),
(88, 65, 69, 0.1),
(89, 65, 70, 0.1),
(90, 65, 71, 4),
(91, 67, 67, 79),
(92, 67, 68, 77),
(93, 67, 69, 0.1),
(94, 67, 70, 0.1),
(95, 67, 71, 2),
(106, 71, 67, 69),
(107, 71, 68, 40),
(108, 71, 69, 40),
(109, 71, 70, 0.1),
(110, 71, 71, 3),
(111, 64, 67, 90),
(112, 64, 68, 60),
(113, 64, 69, 51),
(114, 64, 70, 0.1),
(115, 64, 71, 4),
(116, 69, 67, 60),
(117, 69, 68, 40),
(118, 69, 69, 0.1),
(119, 69, 70, 0.1),
(120, 69, 71, 3),
(136, 72, 67, 70),
(137, 72, 68, 60),
(138, 72, 69, 5),
(139, 72, 70, 0.1),
(140, 72, 71, 4),
(141, 62, 67, 7),
(142, 62, 68, 77),
(143, 62, 69, 3),
(144, 62, 70, 0.1),
(145, 62, 71, 2),
(146, 76, 67, 85),
(147, 76, 68, 46),
(148, 76, 69, 0.1),
(149, 76, 70, 0.1),
(150, 76, 71, 3),
(151, 77, 67, 80),
(152, 77, 68, 30),
(153, 77, 69, 0.1),
(154, 77, 70, 0.1),
(155, 77, 71, 3),
(156, 78, 67, 85),
(157, 78, 68, 40),
(158, 78, 69, 0.1),
(159, 78, 70, 0.1),
(160, 78, 71, 4),
(161, 79, 67, 85),
(162, 79, 68, 53),
(163, 79, 69, 25),
(164, 79, 70, 0.1),
(165, 79, 71, 4),
(166, 80, 67, 85),
(167, 80, 68, 46),
(168, 80, 69, 0.1),
(169, 80, 70, 0.1),
(170, 80, 71, 4),
(171, 81, 67, 88),
(172, 81, 68, 50),
(173, 81, 69, 25),
(174, 81, 70, 0.1),
(175, 81, 71, 4),
(176, 82, 67, 84),
(177, 82, 68, 50),
(178, 82, 69, 0.1),
(179, 82, 70, 0.1),
(180, 82, 71, 4),
(181, 83, 67, 82),
(182, 83, 68, 52),
(183, 83, 69, 0.1),
(184, 83, 70, 0.1),
(185, 83, 71, 3),
(186, 84, 67, 84),
(187, 84, 68, 41),
(188, 84, 69, 0.1),
(189, 84, 70, 0.1),
(190, 84, 71, 3),
(191, 85, 67, 84),
(192, 85, 68, 48),
(193, 85, 69, 0.1),
(194, 85, 70, 0.1),
(195, 85, 71, 4),
(196, 86, 67, 84),
(197, 86, 68, 52),
(198, 86, 69, 0.1),
(199, 86, 70, 0.1),
(200, 86, 71, 4),
(201, 87, 67, 82),
(202, 87, 68, 51),
(203, 87, 69, 0.1),
(204, 87, 70, 0.1),
(205, 87, 71, 4),
(206, 88, 67, 84),
(207, 88, 68, 50),
(208, 88, 69, 0.1),
(209, 88, 70, 0.1),
(210, 88, 71, 3),
(211, 89, 67, 86),
(212, 89, 68, 51),
(213, 89, 69, 0.1),
(214, 89, 70, 0.1),
(215, 89, 71, 4),
(216, 90, 67, 82),
(217, 90, 68, 40),
(218, 90, 69, 0.1),
(219, 90, 70, 0.1),
(220, 90, 71, 3),
(221, 91, 67, 83),
(222, 91, 68, 54),
(223, 91, 69, 0.1),
(224, 91, 70, 0.1),
(225, 91, 71, 4),
(226, 92, 67, 83),
(227, 92, 68, 51),
(228, 92, 69, 0.1),
(229, 92, 70, 0.1),
(230, 92, 71, 4),
(231, 93, 67, 83),
(232, 93, 68, 51),
(233, 93, 69, 0.1),
(234, 93, 70, 0.1),
(235, 93, 71, 3),
(236, 94, 67, 83),
(237, 94, 68, 51),
(238, 94, 69, 0.1),
(239, 94, 70, 0.1),
(240, 94, 71, 4),
(241, 95, 67, 86),
(242, 95, 68, 50),
(243, 95, 69, 0.1),
(244, 95, 70, 0.1),
(245, 95, 71, 4),
(246, 96, 67, 88),
(247, 96, 68, 50),
(248, 96, 69, 0.1),
(249, 96, 70, 0.1),
(250, 96, 71, 4),
(251, 97, 67, 85),
(252, 97, 68, 50),
(253, 97, 69, 0.1),
(254, 97, 70, 0.1),
(255, 97, 71, 4),
(256, 98, 67, 81),
(257, 98, 68, 50),
(258, 98, 69, 0.1),
(259, 98, 70, 0.1),
(260, 98, 71, 3),
(261, 99, 67, 86),
(262, 99, 68, 53),
(263, 99, 69, 0.1),
(264, 99, 70, 0.1),
(265, 99, 71, 4),
(266, 100, 67, 81),
(267, 100, 68, 50),
(268, 100, 69, 0.1),
(269, 100, 70, 0.1),
(270, 100, 71, 3),
(271, 101, 67, 84),
(272, 101, 68, 31),
(273, 101, 69, 0.1),
(274, 101, 70, 0.1),
(275, 101, 71, 4),
(276, 102, 67, 84),
(277, 102, 68, 48),
(278, 102, 69, 0.1),
(279, 102, 70, 0.1),
(280, 102, 71, 3),
(281, 103, 67, 87),
(282, 103, 68, 51),
(283, 103, 69, 25),
(284, 103, 70, 0.1),
(285, 103, 71, 4),
(286, 104, 67, 83),
(287, 104, 68, 46),
(288, 104, 69, 0.1),
(289, 104, 70, 0.1),
(290, 104, 71, 3),
(291, 105, 67, 83),
(292, 105, 68, 40),
(293, 105, 69, 0.1),
(294, 105, 70, 0.1),
(295, 105, 71, 3),
(296, 106, 67, 85),
(297, 106, 68, 51),
(298, 106, 69, 0.1),
(299, 106, 70, 0.1),
(300, 106, 71, 3),
(301, 107, 67, 86),
(302, 107, 68, 45),
(303, 107, 69, 0.1),
(304, 107, 70, 0.1),
(305, 107, 71, 4),
(306, 108, 67, 74),
(307, 108, 68, 46),
(308, 108, 69, 0.1),
(309, 108, 70, 0.1),
(310, 108, 71, 3),
(311, 109, 67, 84),
(312, 109, 68, 31),
(313, 109, 69, 0.1),
(314, 109, 70, 1),
(315, 109, 71, 3),
(316, 110, 67, 81),
(317, 110, 68, 45),
(318, 110, 69, 0.1),
(319, 110, 70, 1),
(320, 110, 71, 3),
(321, 111, 67, 85),
(322, 111, 68, 50),
(323, 111, 69, 0.1),
(324, 111, 70, 0.1),
(325, 111, 71, 4),
(326, 112, 67, 85),
(327, 112, 68, 45),
(328, 112, 69, 0.1),
(329, 112, 70, 0.1),
(330, 112, 71, 3),
(331, 113, 67, 85),
(332, 113, 68, 41),
(333, 113, 69, 0.1),
(334, 113, 70, 0.1),
(335, 113, 71, 3),
(336, 114, 67, 86),
(337, 114, 68, 50),
(338, 114, 69, 0.1),
(339, 114, 70, 0.1),
(340, 114, 71, 4),
(341, 115, 67, 83),
(342, 115, 68, 50),
(343, 115, 69, 0.1),
(344, 115, 70, 0.1),
(345, 115, 71, 3),
(346, 116, 67, 86),
(347, 116, 68, 51),
(348, 116, 69, 0.1),
(349, 116, 70, 0.1),
(350, 116, 71, 4),
(351, 117, 67, 84),
(352, 117, 68, 41),
(353, 117, 69, 0.1),
(354, 117, 70, 0.1),
(355, 117, 71, 4),
(356, 118, 67, 86),
(357, 118, 68, 51),
(358, 118, 69, 0.1),
(359, 118, 70, 0.1),
(360, 118, 71, 4),
(361, 119, 67, 89),
(362, 119, 68, 52),
(363, 119, 69, 0.1),
(364, 119, 70, 0.1),
(365, 119, 71, 3);

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nama_prestasi` varchar(255) NOT NULL,
  `tingkat` varchar(50) NOT NULL,
  `juara` varchar(50) NOT NULL,
  `nilai_poin` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`id_prestasi`, `id_alternatif`, `nama_prestasi`, `tingkat`, `juara`, `nilai_poin`) VALUES
(17, 79, 'Lomba Wajah Plastik Tingkat Provinsi di SMA Negri 2 Tejakula', 'Provinsi', '2', 25),
(18, 81, 'Lomba GLM (Gema Lomba Matematika) SMK tingkat Nasional yang diselenggarakan oleh Universitas Pendidikan Ganesha Tahun 2025(Babak semi final dan final)', 'Nasional', 'Harapan 1', 25),
(19, 103, 'Lomba Wajah Plastik Tingkat Provinsi di SMA Negri 2 Tejakula', 'Provinsi', '2', 25);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_user_level`, `nama`, `email`, `username`, `password`) VALUES
(1, 1, 'Admin', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(10, 4, 'rudy satya ', 'rudy@gmail.com', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c'),
(11, 3, 'wira dharma', 'wira@gmail.com', 'pimpinan', '90973652b88fe07d05a4304f0a945de8');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id_user_level` int(11) NOT NULL,
  `user_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_user_level`, `user_level`) VALUES
(1, 'Administrator'),
(2, 'User'),
(3, 'Pimpinan'),
(4, 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user_level` (`id_user_level`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=483489;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=366;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_user_level`) REFERENCES `user_level` (`id_user_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
