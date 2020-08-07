-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2020 pada 10.05
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_academy`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `classes`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `classes` (
`ClassID` varchar(128)
,`ClassDesc` varchar(128)
,`ClassNumeric` int(10)
,`Type` varchar(16)
,`SchoolID` varchar(128)
,`RoomID` varchar(128)
,`RoomDesc` varchar(128)
,`Simplified` varchar(32)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_00_owner`
--

CREATE TABLE `tbl_00_owner` (
  `OwnerID` int(11) NOT NULL,
  `OwnerName` varchar(128) NOT NULL,
  `RegBy` varchar(128) NOT NULL,
  `RegDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_00_owner`
--

INSERT INTO `tbl_00_owner` (`OwnerID`, `OwnerName`, `RegBy`, `RegDate`) VALUES
(1, 'Adventist School', 'ABAse_SysAdmin', '2018-08-20'),
(2, 'Catholic School', 'ABase_SysAdmin', '2019-08-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_01_foundation`
--

CREATE TABLE `tbl_01_foundation` (
  `FoundID` int(11) NOT NULL,
  `FoundName` varchar(128) NOT NULL,
  `OwnerID` varchar(128) NOT NULL,
  `RegBy` varchar(128) NOT NULL,
  `RegDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_01_foundation`
--

INSERT INTO `tbl_01_foundation` (`FoundID`, `FoundName`, `OwnerID`, `RegBy`, `RegDate`) VALUES
(1, '-', '-', '', '0000-00-00'),
(2, 'Yayasan Pendidikan Advent Paal II', 'OWN01', 'ABase_SysAdmin', '2019-08-20'),
(3, 'Yayasan Pendidikan Advent Kairagi', 'OWN01', 'ABase_SysAdmin', '2019-08-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_02_school`
--

CREATE TABLE `tbl_02_school` (
  `CtrlNo` int(11) NOT NULL,
  `SchoolID` varchar(128) NOT NULL,
  `SchoolName` varchar(128) NOT NULL,
  `FoundID` varchar(128) NOT NULL,
  `School_Desc` varchar(128) NOT NULL,
  `RegBy` varchar(128) NOT NULL,
  `RegDate` date NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_02_school`
--

INSERT INTO `tbl_02_school` (`CtrlNo`, `SchoolID`, `SchoolName`, `FoundID`, `School_Desc`, `RegBy`, `RegDate`, `isActive`) VALUES
(2, 'FD1ES', 'SD Advent Paal 2', 'FD1', 'SD', 'ABase_SysAdmin', '2019-08-21', 0),
(3, 'FD1JS', 'SMP Advent Paal 2', 'FD1', 'SMP', 'ABase_SysAdmin', '2019-08-20', 0),
(4, 'FD1HS', 'SMA Advent Klabat Manado', 'FD1', 'SMA', 'ABase_SysAdmin', '2019-08-23', 1),
(7, 'FD1VH', 'SMK Advent Klabat', 'FD1', 'SMK', 'ABase_SysAdmin', '2019-11-22', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_03_a_mas_vocational`
--

CREATE TABLE `tbl_03_a_mas_vocational` (
  `CtrlNo` int(11) NOT NULL,
  `ProgramID` varchar(64) NOT NULL,
  `Program` varchar(256) NOT NULL,
  `SubProgramID` varchar(8) NOT NULL,
  `SubProgram` varchar(64) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `RegBy` varchar(64) NOT NULL,
  `RegDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_03_a_mas_vocational`
--

INSERT INTO `tbl_03_a_mas_vocational` (`CtrlNo`, `ProgramID`, `Program`, `SubProgramID`, `SubProgram`, `is_active`, `RegBy`, `RegDate`) VALUES
(1, 'AA', 'Agribisnis & Agroteknologi', 'AA-TAN', 'Agribisnis Tanaman', 1, '', '2020-07-27'),
(2, 'AA', 'Agribisnis & Agroteknologi', 'AA-TER', 'Agribisnis Ternak', 1, '', '2020-07-27'),
(3, 'AA', 'Agribisnis & Agroteknologi', 'AA-KH', 'Kesehatan Hewan', 1, '', '2020-07-27'),
(4, 'AA', 'Agribisnis & Agroteknologi', 'AA-APHP', 'Agribisnis Pengolahan Hasil Pertanian', 1, '', '2020-07-27'),
(5, 'AA', 'Agribisnis & Agroteknologi', 'AA-TK', 'Teknik Pertanian', 1, '', '2020-07-27'),
(6, 'AA', 'Agribisnis & Agroteknologi', 'AA-K', 'Kehutanan', 1, '', '2020-07-27'),
(7, 'BM', 'Business & Management', 'BM-BP', 'Bisnis dan Pemasaran', 1, '', '2020-07-27'),
(8, 'BM', 'Business & Management', 'BM-MP', 'Manajemen Perkantoran', 1, '', '2020-07-27'),
(9, 'BM', 'Business & Management', 'BM-AK', 'Akuntansi dan Keuangan', 1, '', '2020-07-27'),
(10, 'BM', 'Business & Management', 'BM-L', 'Logistik', 1, '', '2020-07-27'),
(11, 'EP', 'Energi & Pertambangan', 'EP-TP', 'Teknik Perminyakan', 1, '', '2020-07-27'),
(12, 'EP', 'Energi & Pertambangan', 'EP-GP', 'Geologi Pertambangan', 1, '', '2020-07-27'),
(13, 'EP', 'Energi & Pertambangan', 'EP-ET', 'Teknik Energi Terbarukan', 1, '', '2020-07-27'),
(14, 'K', 'Kemaritiman', 'K-PKPI', 'Pelayaran Kapal Perikanan', 1, '', '2020-07-27'),
(15, 'K', 'Kemaritiman', 'K-PKN', 'Pelayaran Kapal Niaga', 1, '', '2020-07-27'),
(16, 'K', 'Kemaritiman', 'K-P', 'Perikanan', 1, '', '2020-07-27'),
(17, 'K', 'Kemaritiman', 'K-PHP', 'Pengolahan Hasil Perikanan', 1, '', '2020-07-27'),
(18, 'KPS', 'Kesehatan & Pekerjaan Sosial', 'KPS-K', 'Keperawatan', 1, '', '2020-07-27'),
(19, 'KPS', 'Kesehatan & Pekerjaan Sosial', 'KPS-KG', 'Kesehatan Gigi', 1, '', '2020-07-27'),
(20, 'KPS', 'Kesehatan & Pekerjaan Sosial', 'KPS-TLM', 'Teknologi Laboratorium Medik', 1, '', '2020-07-27'),
(21, 'KPS', 'Kesehatan & Pekerjaan Sosial', 'KPS-F', 'Farmasi', 1, '', '2020-07-27'),
(22, 'KPS', 'Kesehatan & Pekerjaan Sosial', 'KPS-PS', 'Pekerjaan Sosial', 1, '', '2020-07-27'),
(23, 'P', 'Pariwisata', 'P-PJP', 'Perhotelan dan Jasa Pariwisata', 1, '', '2020-07-27'),
(24, 'P', 'Pariwisata', 'P-K', 'Kuliner', 1, '', '2020-07-27'),
(25, 'P', 'Pariwisata', 'P-TK', 'Tata Kecantikan', 1, '', '2020-07-27'),
(26, 'P', 'Pariwisata', 'P-TB', 'Tata Busana', 1, '', '2020-07-27'),
(27, 'SIK', 'Seni & Industri Kreatif', 'SIK-SR', 'Seni Rupa', 1, '', '2020-07-27'),
(28, 'SIK', 'Seni & Industri Kreatif', 'SIK-DPKK', 'Desain dan Produk Kreatif Kriya', 1, '', '2020-07-27'),
(29, 'SIK', 'Seni & Industri Kreatif', 'SIK-SM', 'Seni Musik', 1, '', '2020-07-27'),
(30, 'SIK', 'Seni & Industri Kreatif', 'SIK-STA', 'Seni Tari', 1, '', '2020-07-27'),
(31, 'SIK', 'Seni & Industri Kreatif', 'SIK-SK', 'Seni Karawitan', 1, '', '2020-07-27'),
(32, 'SIK', 'Seni & Industri Kreatif', 'SIK-SP', 'Seni Pedalangan', 1, '', '2020-07-27'),
(33, 'SIK', 'Seni & Industri Kreatif', 'SIK-STE', 'Seni Teater', 1, '', '2020-07-27'),
(34, 'SIK', 'Seni & Industri Kreatif', 'SIK-SBF', 'Seni Broadcasting dan Film', 1, '', '2020-07-27'),
(35, 'TIK', 'Tekonologi Informasi & Komunikasi', 'TIK-KI', 'Teknik Komputer dan Informatika', 1, '', '2020-07-27'),
(36, 'TIK', 'Tekonologi Informasi & Komunikasi', 'TIK-T', 'Teknik Telekomunikasi', 1, '', '2020-07-27'),
(37, 'TR', 'Teknologi & Rekayasa', 'TR-KP', 'Teknik Konstruksi dan Properti', 1, '', '2020-07-27'),
(38, 'TR', 'Teknologi & Rekayasa', 'TR-GG', 'Teknik Geomatika dan Geospasial', 1, '', '2020-07-27'),
(39, 'TR', 'Teknologi & Rekayasa', 'TR-KL', 'Teknik Ketenagalistrikan', 1, '', '2020-07-27'),
(40, 'TR', 'Teknologi & Rekayasa', 'TR-M', 'Teknik Mesin', 1, '', '2020-07-27'),
(41, 'TR', 'Teknologi & Rekayasa', 'TR-PU', 'Teknologi Pesawat Udara', 1, '', '2020-07-27'),
(42, 'TR', 'Teknologi & Rekayasa', 'TR-G', 'Teknik Grafika', 1, '', '2020-07-27'),
(43, 'TR', 'Teknologi & Rekayasa', 'TR-II', 'Teknik Instrumentasi Industri', 1, '', '2020-07-27'),
(44, 'TR', 'Teknologi & Rekayasa', 'TR-I', 'Teknik Industri', 1, '', '2020-07-27'),
(45, 'TR', 'Teknologi & Rekayasa', 'TR-T', 'Teknologi Teksti', 1, '', '2020-07-27'),
(46, 'TR', 'Teknologi & Rekayasa', 'TR-K', 'Teknik Kimia', 1, '', '2020-07-27'),
(47, 'TR', 'Teknologi & Rekayasa', 'TR-O', 'Teknik Otomotif', 1, '', '2020-07-27'),
(48, 'TR', 'Teknologi & Rekayasa', 'TR-P', 'Teknik Perkapalan', 1, '', '2020-07-27'),
(49, 'TR', 'Teknologi & Rekayasa', 'TR-E', 'Teknik Elektronika', 1, '', '2020-07-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_03_b_class_vocational`
--

CREATE TABLE `tbl_03_b_class_vocational` (
  `CtrlNo` int(11) NOT NULL,
  `ClassID` varchar(128) NOT NULL,
  `ClassDesc` varchar(128) NOT NULL,
  `ClassRomanic` varchar(16) NOT NULL,
  `ClassNumeric` int(10) NOT NULL,
  `Type` varchar(8) NOT NULL,
  `RegBy` varchar(128) NOT NULL,
  `RegDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_03_b_class_vocational`
--

INSERT INTO `tbl_03_b_class_vocational` (`CtrlNo`, `ClassID`, `ClassDesc`, `ClassRomanic`, `ClassNumeric`, `Type`, `RegBy`, `RegDate`) VALUES
(1, 'SMKC1', 'X KPS-K', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-07-27'),
(2, 'SMKC2', 'XI KPS-K', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-07-27'),
(3, 'SMKC3', 'XII KPS-K', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-07-27'),
(4, 'SMKC1', 'X AA-TAN', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-07-27'),
(5, 'SMKC1', 'XI AA-TAN', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-07-27'),
(6, 'SMKC1', 'XII AA-TAN', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-07-27'),
(7, 'SMKC1', 'X AA-TER', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-07-27'),
(8, 'SMKC1', 'XI AA-TER', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-07-27'),
(9, 'SMKC1', 'XII AA-TER', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-07-27'),
(10, 'SMKC1', 'X AA-KH', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-07-27'),
(11, 'SMKC1', 'XI AA-KH', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-07-27'),
(12, 'SMKC1', 'XII AA-KH', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-07-27'),
(13, 'SMKC1', 'X AA-APHP', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(14, 'SMKC2', 'XI AA-APHP', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(15, 'SMKC1', 'XII AA-APHP', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(16, 'SMKC1', 'X AA-TK', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(17, 'SMKC2', 'XI AA-TK', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(18, 'SMKC1', 'XII AA-TK', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(19, 'SMKC1', 'X AA-K', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(20, 'SMKC2', 'XI AA-K', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(21, 'SMKC1', 'XII AA-K', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(22, 'SMKC1', 'X BM-BP', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(23, 'SMKC2', 'XI BM-BP', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(24, 'SMKC1', 'XII BM-BP', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(25, 'SMKC1', 'X BM-MP', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(26, 'SMKC2', 'XI BM-MP', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(27, 'SMKC1', 'XII BM-MP', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(28, 'SMKC1', 'X BM-AK', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(29, 'SMKC2', 'XI BM-AK', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(30, 'SMKC1', 'XII BM-AK', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(31, 'SMKC1', 'X BM-L', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(32, 'SMKC2', 'XI BM-L', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(33, 'SMKC1', 'XII BM-L', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(34, 'SMKC1', 'X EP-TP', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(35, 'SMKC2', 'XI EP-TP', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(36, 'SMKC1', 'XII EP-TP', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(37, 'SMKC1', 'X EP-GP', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(38, 'SMKC2', 'XI EP-GP', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(39, 'SMKC1', 'XII EP-GP', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(40, 'SMKC1', 'X EP-ET', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(41, 'SMKC2', 'XI EP-ET', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(42, 'SMKC1', 'XII EP-ET', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(43, 'SMKC1', 'X K-PKPI', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(44, 'SMKC2', 'XI K-PKPI', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(45, 'SMKC1', 'XII K-PKPI', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(46, 'SMKC1', 'X K-PKN', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(47, 'SMKC2', 'XI K-PKN', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(48, 'SMKC1', 'XII K-PKN', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(49, 'SMKC1', 'X K-P', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(50, 'SMKC2', 'XI K-P', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(51, 'SMKC1', 'XII K-P', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(52, 'SMKC1', 'X K-PHP', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(53, 'SMKC2', 'XI K-PHP', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(54, 'SMKC1', 'XII K-PHP', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(55, 'SMKC1', 'X KPS-KG', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(56, 'SMKC2', 'XI KPS-KG', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(57, 'SMKC1', 'XII KPS-KG', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(58, 'SMKC1', 'X KPS-TLM', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(59, 'SMKC2', 'XI KPS-TLM', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(60, 'SMKC1', 'XII KPS-TLM', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(61, 'SMKC1', 'X KPS-F', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(62, 'SMKC2', 'XI KPS-F', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(63, 'SMKC1', 'XII KPS-F', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(64, 'SMKC1', 'X KPS-PS', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(65, 'SMKC2', 'XI KPS-PS', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(66, 'SMKC1', 'XII KPS-PS', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(67, 'SMKC1', 'X P-PJP', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(68, 'SMKC2', 'XI P-PJP', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(69, 'SMKC1', 'XII P-PJP', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(70, 'SMKC1', 'X P-K', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(71, 'SMKC2', 'XI P-K', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(72, 'SMKC1', 'XII P-K', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(73, 'SMKC1', 'X P-TK', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(74, 'SMKC2', 'XI P-TK', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(75, 'SMKC1', 'XII P-TK', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(76, 'SMKC1', 'X P-TB', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(77, 'SMKC2', 'XI P-TB', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(78, 'SMKC1', 'XII P-TB', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(79, 'SMKC1', 'X SIK-SR', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(80, 'SMKC2', 'XI SIK-SR', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(81, 'SMKC1', 'XII SIK-SR', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(82, 'SMKC1', 'X SIK-DPKK', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(83, 'SMKC2', 'XI SIK-DPKK', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(84, 'SMKC1', 'XII SIK-DPKK', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(85, 'SMKC1', 'X SIK-SM', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(86, 'SMKC2', 'XI SIK-SM', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(87, 'SMKC1', 'XII SIK-SM', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(88, 'SMKC1', 'X SIK-STA', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(89, 'SMKC2', 'XI SIK-STA', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(90, 'SMKC1', 'XII SIK-STA', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(91, 'SMKC1', 'X SIK-SK', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(92, 'SMKC2', 'XI SIK-SK', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(93, 'SMKC1', 'XII SIK-SK', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(94, 'SMKC1', 'X SIK-SP', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(95, 'SMKC2', 'XI SIK-SP', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(96, 'SMKC1', 'XII SIK-SP', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(97, 'SMKC1', 'X SIK-STE', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(98, 'SMKC2', 'XI SIK-STE', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(99, 'SMKC1', 'XII SIK-STE', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(100, 'SMKC1', 'X SIK-SBF', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(101, 'SMKC2', 'XI SIK-SBF', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(102, 'SMKC1', 'XII SIK-SBF', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(103, 'SMKC1', 'X TIK-KI', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(104, 'SMKC2', 'XI TIK-KI', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(105, 'SMKC1', 'XII TIK-KI', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(106, 'SMKC1', 'X TIK-T', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(107, 'SMKC2', 'XI TIK-T', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(108, 'SMKC1', 'XII TIK-T', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(109, 'SMKC1', 'X TR-KP', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(110, 'SMKC2', 'XI TR-KP', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(111, 'SMKC1', 'XII TR-KP', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(112, 'SMKC1', 'X TR-GG', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(113, 'SMKC2', 'XI TR-GG', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(114, 'SMKC1', 'XII TR-GG', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(115, 'SMKC1', 'X TR-KL', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(116, 'SMKC2', 'XI TR-KL', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(117, 'SMKC1', 'XII TR-KL', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(118, 'SMKC1', 'X TR-M', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(119, 'SMKC2', 'XI TR-M', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(120, 'SMKC1', 'XII TR-M', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(121, 'SMKC1', 'X TR-PU', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(122, 'SMKC2', 'XI TR-PU', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(123, 'SMKC1', 'XII TR-PU', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(124, 'SMKC1', 'X TR-G', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(125, 'SMKC2', 'XI TR-G', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(126, 'SMKC1', 'XII TR-G', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(127, 'SMKC1', 'X TR-II', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(128, 'SMKC2', 'XI TR-II', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(129, 'SMKC1', 'XII TR-II', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(130, 'SMKC1', 'X TR-I', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(131, 'SMKC2', 'XI TR-I', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(132, 'SMKC1', 'XII TR-I', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(133, 'SMKC1', 'X TR-T', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(134, 'SMKC2', 'XI TR-T', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(135, 'SMKC1', 'XII TR-T', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(136, 'SMKC1', 'X TR-K', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(137, 'SMKC2', 'XI TR-K', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(138, 'SMKC1', 'XII TR-K', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(139, 'SMKC1', 'X TR-O', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(140, 'SMKC2', 'XI TR-O', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(141, 'SMKC1', 'XII TR-O', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(142, 'SMKC1', 'X TR-P', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(143, 'SMKC2', 'XI TR-P', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(144, 'SMKC1', 'XII TR-P', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(145, 'SMKC1', 'X TR-E', 'X', 10, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(146, 'SMKC2', 'XI TR-E', 'XI', 11, 'SMK', 'ABase_SysAdmin', '2020-08-06'),
(147, 'SMKC1', 'XII TR-E', 'XII', 12, 'SMK', 'ABase_SysAdmin', '2020-08-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_03_class`
--

CREATE TABLE `tbl_03_class` (
  `CtrlNo` int(11) NOT NULL,
  `ClassID` varchar(128) NOT NULL,
  `ClassDesc` varchar(128) NOT NULL,
  `ClassRomanic` varchar(16) NOT NULL,
  `ClassNumeric` int(10) NOT NULL,
  `Type` varchar(16) NOT NULL,
  `SchoolID` varchar(128) NOT NULL,
  `RegBy` varchar(128) NOT NULL,
  `RegDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struktur dari tabel `tbl_04_class_rooms`
--

CREATE TABLE `tbl_04_class_rooms` (
  `CtrlNo` int(11) NOT NULL,
  `RoomID` varchar(128) NOT NULL,
  `RoomDesc` varchar(128) NOT NULL,
  `Simplified` varchar(32) NOT NULL,
  `Type` varchar(16) NOT NULL,
  `ClassID` varchar(128) NOT NULL,
  `RegBy` varchar(128) NOT NULL DEFAULT 'SysAdmin',
  `RegDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_04_class_rooms_vocational`
--

CREATE TABLE `tbl_04_class_rooms_vocational` (
  `CtrlNo` int(11) NOT NULL,
  `RoomID` varchar(128) NOT NULL,
  `RoomDesc` varchar(128) NOT NULL,
  `Simplified` varchar(32) NOT NULL,
  `SubProgramID` varchar(16) NOT NULL,
  `ClassID` varchar(128) NOT NULL,
  `RegBy` varchar(128) NOT NULL DEFAULT 'SysAdmin',
  `RegDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_05_subject`
--

CREATE TABLE `tbl_05_subject` (
  `CtrlNo` int(11) NOT NULL,
  `SubjID` varchar(128) NOT NULL,
  `SubjName` varchar(128) DEFAULT NULL,
  `SubjDesc` varchar(128) NOT NULL,
  `Type` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_05_subject_character_desc`
--

CREATE TABLE `tbl_05_subject_character_desc` (
  `CtrlNo` int(11) NOT NULL,
  `Type` varchar(18) NOT NULL,
  `Description` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_05_subject_character_desc`
--

INSERT INTO `tbl_05_subject_character_desc` (`CtrlNo`, `Type`, `Description`) VALUES
(1, 'Social', 'Jujur'),
(2, 'Social', 'Disiplin'),
(3, 'Social', 'Tanggung Jawab'),
(4, 'Social', 'Toleransi'),
(5, 'Social', 'Gotong Royong'),
(6, 'Social', 'Santun'),
(7, 'Social', 'Percaya Diri'),
(8, 'Spiritual', 'Berdoa sebelum melakukan kegiatan'),
(9, 'Spiritual', 'Bersyukur setelah beraktivitas'),
(10, 'Spiritual', 'Toleran pada agama yang berbeda'),
(11, 'Spiritual', 'Taat beribadah'),
(12, 'Spiritual', 'Memberi Salam dan bertegur sapa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_05_subject_kd`
--

CREATE TABLE `tbl_05_subject_kd` (
  `CtrlNo` int(64) NOT NULL,
  `Degree` varchar(64) DEFAULT NULL,
  `Classes` varchar(64) DEFAULT NULL,
  `Type` enum('cognitive','skills') NOT NULL,
  `SubjName` varchar(128) DEFAULT NULL,
  `Semester` int(10) DEFAULT NULL,
  `Code` varchar(32) DEFAULT NULL,
  `KD` varchar(256) DEFAULT NULL,
  `Adjust` varchar(256) DEFAULT NULL,
  `KKM` int(11) DEFAULT NULL,
  `Weight1` int(16) DEFAULT NULL,
  `Weight1_Desc` varchar(128) NOT NULL,
  `Weight2` int(16) DEFAULT NULL,
  `Weight2_Desc` varchar(128) NOT NULL,
  `Weight3` int(16) DEFAULT NULL,
  `Weight3_Desc` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Struktur dari tabel `tbl_05_subject_weight`
--

CREATE TABLE `tbl_05_subject_weight` (
  `CtrlNo` int(11) NOT NULL,
  `Degree` varchar(64) NOT NULL,
  `Class` varchar(128) NOT NULL,
  `SubjName` varchar(256) NOT NULL,
  `KDWeight` int(16) DEFAULT NULL,
  `KDWeight_SK` int(16) DEFAULT NULL,
  `MidWeight` int(16) DEFAULT NULL,
  `FinalWeight` int(16) DEFAULT NULL,
  `Absent` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Struktur dari tabel `tbl_06_schedule`
--

CREATE TABLE `tbl_06_schedule` (
  `CtrlNo` int(11) NOT NULL,
  `Degree` varchar(128) NOT NULL,
  `RoomID` varchar(128) NOT NULL,
  `RoomDesc` varchar(128) NOT NULL,
  `semester` int(10) DEFAULT 1,
  `schoolyear` varchar(32) DEFAULT NULL,
  `Hour` varchar(64) NOT NULL,
  `SubjName` varchar(128) DEFAULT NULL,
  `Days` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `IDNumber` varchar(64) DEFAULT NULL,
  `TeacherName` varchar(256) DEFAULT NULL,
  `Note` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struktur dari tabel `tbl_06_schedule_nonregular`
--

CREATE TABLE `tbl_06_schedule_nonregular` (
  `CtrlNo` int(11) NOT NULL,
  `Degree` varchar(128) NOT NULL,
  `RoomID` varchar(128) NOT NULL,
  `RoomDesc` varchar(128) NOT NULL,
  `semester` int(10) DEFAULT 1,
  `schoolyear` varchar(32) DEFAULT NULL,
  `Hour` varchar(64) NOT NULL,
  `Type` varchar(8) NOT NULL,
  `SubjName` varchar(128) DEFAULT NULL,
  `Days` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `IDNumber` varchar(64) DEFAULT NULL,
  `TeacherName` varchar(256) DEFAULT NULL,
  `Note` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_07_personal_bio`
--

CREATE TABLE `tbl_07_personal_bio` (
  `CtrlNo` int(11) NOT NULL,
  `IDNumber` varchar(64) NOT NULL,
  `PersonalID` varchar(128) NOT NULL DEFAULT '-',
  `FirstName` varchar(128) NOT NULL DEFAULT '-',
  `MiddleName` varchar(256) DEFAULT NULL,
  `LastName` varchar(128) NOT NULL DEFAULT '''-''',
  `NickName` varchar(256) DEFAULT NULL,
  `status` enum('admin','student','teacher','staff') DEFAULT NULL,
  `Gender` enum('Laki-Laki','Perempuan') NOT NULL,
  `DateofBirth` date DEFAULT NULL,
  `PointofBirth` varchar(128) NOT NULL DEFAULT '-',
  `KK` varchar(128) NOT NULL DEFAULT '-',
  `BirthCertificate` varchar(128) NOT NULL DEFAULT '-',
  `Race` varchar(64) NOT NULL DEFAULT '-',
  `Religion` enum('Budha','Hindu','Islam','Katolik','Kong Hu Cu','Kristen') NOT NULL,
  `Bloodtype` enum('A','B','AB','O','-') NOT NULL DEFAULT '-',
  `Disability` varchar(128) NOT NULL DEFAULT '-',
  `HeadDiameter` varchar(128) NOT NULL DEFAULT '-',
  `Height` varchar(16) NOT NULL DEFAULT '0',
  `Weight` varchar(16) DEFAULT '0',
  `Address` varchar(512) NOT NULL DEFAULT '-',
  `RT` varchar(128) NOT NULL DEFAULT '-',
  `RW` varchar(128) NOT NULL DEFAULT '-',
  `Village` varchar(128) NOT NULL DEFAULT '-',
  `Dusun` varchar(128) NOT NULL DEFAULT '-',
  `District` varchar(128) NOT NULL DEFAULT '-',
  `Region` varchar(64) NOT NULL DEFAULT '-',
  `City` varchar(64) NOT NULL DEFAULT '-',
  `Province` varchar(64) NOT NULL DEFAULT '-',
  `Country` varchar(64) NOT NULL DEFAULT '-',
  `Postal` varchar(32) NOT NULL DEFAULT '-',
  `Photo` varchar(128) NOT NULL DEFAULT 'default.png',
  `RegBy` varchar(128) DEFAULT 'ABase_SysAdmin',
  `RegDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struktur dari tabel `tbl_08_job_info`
--

CREATE TABLE `tbl_08_job_info` (
  `CtrlNo` int(11) NOT NULL,
  `IDNumber` varchar(64) NOT NULL,
  `Occupation` varchar(128) DEFAULT NULL,
  `JobDesc` varchar(128) DEFAULT NULL,
  `Honorer` varchar(128) DEFAULT NULL,
  `Emp_Type` varchar(64) DEFAULT NULL,
  `Homeroom` varchar(128) DEFAULT NULL,
  `SubjectTeach` varchar(128) DEFAULT NULL,
  `LastEducation` enum('SD','SMP','SMA','Diploma 1','Diploma 2','Diploma 3','Diploma 4','Strata 1','Strata 2','Strata 3') DEFAULT NULL,
  `StudyFocus` varchar(128) DEFAULT '-',
  `Govt_Cert` varchar(128) NOT NULL DEFAULT '-',
  `Institute_Cert` varchar(64) DEFAULT '-',
  `YearStarts` varchar(64) DEFAULT '-',
  `MaritalStatus` enum('Belum Menikah','Menikah','Duda/Janda') DEFAULT NULL,
  `Email` varchar(128) NOT NULL DEFAULT '-',
  `Phone` varchar(128) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_08_job_info_std`
--

CREATE TABLE `tbl_08_job_info_std` (
  `CtrlNo` int(11) NOT NULL,
  `NIS` varchar(64) NOT NULL DEFAULT '-',
  `NISN` varchar(128) NOT NULL DEFAULT 'NULL',
  `Kelas` varchar(128) NOT NULL DEFAULT '-',
  `Ruangan` varchar(128) DEFAULT NULL,
  `Position` varchar(128) NOT NULL DEFAULT '-',
  `Email` varchar(128) NOT NULL DEFAULT '-',
  `Phone` varchar(128) NOT NULL DEFAULT '-',
  `HousePhone` varchar(128) NOT NULL DEFAULT 'NULL',
  `LiveWith` varchar(128) DEFAULT 'Orang Tua',
  `AnakKe` varchar(18) DEFAULT NULL,
  `Saudara` varchar(18) DEFAULT NULL,
  `SdraTiri` varchar(18) DEFAULT NULL,
  `SdraAngkat` varchar(18) DEFAULT NULL,
  `Father` varchar(128) DEFAULT NULL,
  `FatherNIK` varchar(128) NOT NULL DEFAULT '-',
  `FatherBorn` varchar(128) DEFAULT NULL,
  `FatherDegree` varchar(128) DEFAULT NULL,
  `FatherJob` varchar(128) DEFAULT NULL,
  `FatherIncome` varchar(128) DEFAULT NULL,
  `FatherDisability` varchar(128) DEFAULT NULL,
  `Mother` varchar(128) DEFAULT NULL,
  `MotherNIK` varchar(128) NOT NULL DEFAULT '-',
  `MotherBorn` varchar(128) DEFAULT NULL,
  `MotherDegree` varchar(128) DEFAULT NULL,
  `MotherJob` varchar(128) DEFAULT NULL,
  `MotherIncome` varchar(128) DEFAULT NULL,
  `MotherDisability` varchar(128) NOT NULL DEFAULT 'NULL',
  `Guardian` varchar(128) DEFAULT NULL,
  `GuardianNIK` varchar(128) DEFAULT NULL,
  `GuardianBorn` varchar(128) DEFAULT NULL,
  `GuardianDegree` varchar(128) DEFAULT NULL,
  `GuardianJob` varchar(128) DEFAULT NULL,
  `GuardianIncome` varchar(128) DEFAULT NULL,
  `GuardianDisability` varchar(128) DEFAULT NULL,
  `Transportation` varchar(128) DEFAULT NULL,
  `Range` varchar(128) DEFAULT NULL,
  `ExactRange` varchar(128) DEFAULT NULL,
  `TimeRange` varchar(128) DEFAULT NULL,
  `Latitude` varchar(128) DEFAULT NULL,
  `Longitude` varchar(128) DEFAULT NULL,
  `KIP` varchar(128) DEFAULT NULL,
  `Stayed_KIP` varchar(128) DEFAULT NULL,
  `Refuse_PIP` varchar(128) DEFAULT NULL,
  `Achievement` varchar(128) DEFAULT NULL,
  `AchievementLVL` varchar(128) DEFAULT NULL,
  `AchievementName` varchar(128) DEFAULT NULL,
  `AchievementYear` varchar(128) DEFAULT NULL,
  `Sponsor` varchar(128) DEFAULT NULL,
  `AchievementRank` varchar(128) DEFAULT NULL,
  `Scholarship` varchar(128) DEFAULT NULL,
  `ScholarDesc` varchar(128) DEFAULT NULL,
  `ScholarStart` varchar(128) DEFAULT NULL,
  `ScholarFinish` varchar(128) DEFAULT NULL,
  `Prosperity` varchar(128) DEFAULT NULL,
  `ProsperNumber` varchar(128) DEFAULT NULL,
  `ProsperNameTag` varchar(128) DEFAULT NULL,
  `Competition` varchar(128) DEFAULT NULL,
  `Registration` varchar(128) DEFAULT NULL,
  `SchoolStarts` date DEFAULT NULL,
  `PreviousSchool` varchar(128) DEFAULT NULL,
  `UNNumber` varchar(128) DEFAULT NULL,
  `Diploma` varchar(128) DEFAULT NULL,
  `SKHUN` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struktur dari tabel `tbl_09_det_character`
--

CREATE TABLE `tbl_09_det_character` (
  `CtrlNo` int(11) NOT NULL,
  `NIS` varchar(64) NOT NULL,
  `FullName` varchar(512) NOT NULL,
  `Semester` int(10) NOT NULL,
  `schoolyear` varchar(16) NOT NULL,
  `Room` varchar(32) NOT NULL,
  `SubjName` varchar(256) NOT NULL,
  `Type` varchar(16) NOT NULL,
  `Description` varchar(256) NOT NULL,
  `Point` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Struktur dari tabel `tbl_09_det_grades`
--

CREATE TABLE `tbl_09_det_grades` (
  `CtrlNo` int(11) NOT NULL,
  `NIS` varchar(64) NOT NULL,
  `FullName` varchar(512) NOT NULL,
  `Semester` int(10) NOT NULL DEFAULT 1,
  `schoolyear` varchar(32) DEFAULT NULL,
  `Class` varchar(128) NOT NULL,
  `Room` varchar(128) NOT NULL,
  `SubjName` varchar(128) NOT NULL,
  `KDRecapAvg` int(10) DEFAULT NULL,
  `KDRecapAvg_SK` int(10) DEFAULT NULL,
  `MidTest` int(10) DEFAULT NULL,
  `MidRemedial` int(10) DEFAULT NULL,
  `MidRecap` int(10) DEFAULT NULL,
  `Final` int(10) DEFAULT NULL,
  `FinalRemedial` int(10) DEFAULT NULL,
  `FinalRecap` int(10) DEFAULT NULL,
  `Absent` int(10) DEFAULT 100,
  `Report` int(10) DEFAULT NULL,
  `Report_SK` int(10) DEFAULT NULL,
  `Report_SOC` float DEFAULT NULL,
  `Report_SPR` float DEFAULT NULL,
  `Predicate` varchar(10) DEFAULT NULL,
  `Predicate_SK` varchar(10) DEFAULT NULL,
  `Predicate_SOC` varchar(10) DEFAULT NULL,
  `Predicate_SPR` varchar(10) DEFAULT NULL,
  `Description` varchar(512) DEFAULT NULL,
  `Description_SK` varchar(512) DEFAULT NULL,
  `Description_SOC` varchar(512) DEFAULT NULL,
  `Description_SPR` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struktur dari tabel `tbl_09_det_kd`
--

CREATE TABLE `tbl_09_det_kd` (
  `CtrlNo` int(128) NOT NULL,
  `NIS` varchar(64) NOT NULL,
  `FullName` varchar(512) NOT NULL,
  `Semester` int(10) NOT NULL,
  `schoolyear` varchar(16) NOT NULL,
  `Class` varchar(32) NOT NULL,
  `Room` varchar(32) NOT NULL,
  `SubjName` varchar(256) NOT NULL,
  `Type` varchar(16) NOT NULL,
  `Code` varchar(32) NOT NULL,
  `Grade1` int(11) DEFAULT NULL,
  `Weight1_Desc` varchar(128) NOT NULL,
  `Grade2` int(11) DEFAULT NULL,
  `Weight2_Desc` varchar(128) NOT NULL,
  `Grade3` int(11) DEFAULT NULL,
  `Weight3_Desc` varchar(128) NOT NULL,
  `KDAvg` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_10_absent`
--

CREATE TABLE `tbl_10_absent` (
  `CtrlNo` int(11) NOT NULL,
  `IDNumber` varchar(64) NOT NULL,
  `FullName` varchar(128) NOT NULL,
  `Semester` int(10) NOT NULL,
  `schoolyear` varchar(18) NOT NULL,
  `status` varchar(128) NOT NULL DEFAULT 'teacher',
  `Absent` date NOT NULL,
  `Ket` enum('Absent','On Permit','Sick','') NOT NULL DEFAULT 'Absent'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_10_absent_std`
--

CREATE TABLE `tbl_10_absent_std` (
  `CtrlNo` int(11) NOT NULL,
  `NIS` varchar(64) NOT NULL,
  `FullName` varchar(128) NOT NULL,
  `Semester` int(10) NOT NULL,
  `schoolyear` varchar(18) NOT NULL,
  `Kelas` varchar(128) NOT NULL,
  `Ruang` varchar(128) NOT NULL,
  `SubjDesc` varchar(128) DEFAULT NULL,
  `Hour` varchar(18) DEFAULT NULL,
  `Absent` date NOT NULL,
  `Ket` enum('Absent','Sick','On Permit','Truant','Late') NOT NULL DEFAULT 'Absent'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struktur dari tabel `tbl_11_enrollment`
--

CREATE TABLE `tbl_11_enrollment` (
  `CtrlNo` int(128) NOT NULL,
  `FirstName` varchar(128) NOT NULL,
  `MiddleName` varchar(256) DEFAULT NULL,
  `NickName` varchar(256) DEFAULT NULL,
  `LastName` varchar(128) NOT NULL,
  `Gender` varchar(128) NOT NULL,
  `NISN` varchar(128) NOT NULL,
  `NIK` varchar(128) NOT NULL,
  `KK` varchar(128) NOT NULL,
  `DateofBirth` date DEFAULT NULL,
  `PointofBirth` varchar(128) NOT NULL,
  `BirthCertificate` varchar(128) NOT NULL,
  `Religion` varchar(128) NOT NULL,
  `Country` varchar(128) NOT NULL,
  `Disability` varchar(128) NOT NULL,
  `Address` varchar(128) NOT NULL,
  `RT` varchar(128) NOT NULL,
  `RW` varchar(128) NOT NULL,
  `Dusun` varchar(128) NOT NULL,
  `Village` varchar(128) NOT NULL,
  `District` varchar(128) NOT NULL,
  `Region` varchar(128) NOT NULL,
  `Postal` varchar(128) NOT NULL,
  `LiveWith` varchar(128) NOT NULL,
  `Transportation` varchar(128) NOT NULL,
  `Latitude` varchar(128) NOT NULL,
  `Longitude` varchar(128) NOT NULL,
  `Child` varchar(128) NOT NULL,
  `Siblings` varchar(16) NOT NULL,
  `KIP` varchar(128) NOT NULL,
  `Stayed_KIP` varchar(128) NOT NULL,
  `Refuse_PIP` varchar(128) NOT NULL,
  `Phone` varchar(128) NOT NULL,
  `HousePhone` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Father` varchar(128) NOT NULL,
  `FatherNIK` varchar(128) NOT NULL,
  `FatherBorn` varchar(128) NOT NULL,
  `FatherDegree` varchar(128) NOT NULL,
  `FatherJob` varchar(128) NOT NULL,
  `FatherIncome` varchar(128) NOT NULL,
  `FatherDisability` varchar(128) NOT NULL,
  `Mother` varchar(128) NOT NULL,
  `MotherNIK` varchar(128) NOT NULL,
  `MotherBorn` varchar(128) NOT NULL,
  `MotherDegree` varchar(128) NOT NULL,
  `MotherJob` varchar(128) NOT NULL,
  `MotherIncome` varchar(128) NOT NULL,
  `MotherDisability` varchar(128) NOT NULL,
  `Guardian` varchar(128) NOT NULL,
  `GuardianNIK` varchar(128) NOT NULL,
  `GuardianBorn` varchar(128) NOT NULL,
  `GuardianDegree` varchar(128) NOT NULL,
  `GuardianJob` varchar(128) NOT NULL,
  `GuardianIncome` varchar(128) NOT NULL,
  `GuardianDisability` varchar(128) NOT NULL,
  `Height` varchar(128) NOT NULL,
  `Weight` varchar(128) NOT NULL,
  `HeadDiameter` varchar(128) NOT NULL,
  `Range` varchar(128) NOT NULL,
  `ExactRange` varchar(128) NOT NULL,
  `TimeRange` varchar(128) NOT NULL,
  `Achievement` varchar(128) NOT NULL,
  `AchievementLVL` varchar(128) NOT NULL,
  `AchievementName` varchar(128) NOT NULL,
  `AchievementYear` varchar(128) NOT NULL,
  `Sponsor` varchar(128) NOT NULL,
  `AchievementRank` varchar(128) NOT NULL,
  `Scholarship` varchar(128) NOT NULL,
  `Scholardesc` varchar(128) NOT NULL,
  `Scholarstart` varchar(128) NOT NULL,
  `Scholarfinish` varchar(128) NOT NULL,
  `Prosperity` varchar(128) NOT NULL,
  `ProsperNumber` varchar(128) NOT NULL,
  `ProsperNameTag` varchar(128) NOT NULL,
  `Competition` varchar(128) NOT NULL,
  `Registration` varchar(128) NOT NULL,
  `NIS` varchar(128) NOT NULL,
  `SchoolStarts` date DEFAULT NULL,
  `PreviousSchool` varchar(128) NOT NULL,
  `UNNumber` varchar(128) NOT NULL,
  `Diploma` varchar(128) NOT NULL,
  `SKHUN` varchar(128) NOT NULL,
  `RegDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Struktur dari tabel `tbl_credentials`
--

CREATE TABLE `tbl_credentials` (
  `CtrlNo` int(11) NOT NULL,
  `IDNumber` varchar(64) NOT NULL,
  `status` enum('admin','student','teacher','staff') DEFAULT NULL,
  `password` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Struktur dari tabel `tbl_meta_absent`
--

CREATE TABLE `tbl_meta_absent` (
  `CtrlNo` int(11) NOT NULL,
  `Type` enum('Sick','On Permit','Absent','Truant','Late') NOT NULL DEFAULT 'Absent',
  `Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_meta_absent`
--

INSERT INTO `tbl_meta_absent` (`CtrlNo`, `Type`, `Value`) VALUES
(1, 'Sick', 10),
(2, 'On Permit', 3),
(3, 'Absent', 28),
(4, 'Truant', 0),
(5, 'Late', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meta_active_days`
--

CREATE TABLE `tbl_meta_active_days` (
  `CtrlNo` int(11) NOT NULL,
  `Degree` varchar(16) NOT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_meta_active_days`
--

INSERT INTO `tbl_meta_active_days` (`CtrlNo`, `Degree`, `Total`) VALUES
(1, 'SD', 50),
(2, 'SMP', 50),
(3, 'SMA', 22),
(4, 'SMK', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meta_character_weight`
--

CREATE TABLE `tbl_meta_character_weight` (
  `CtrlNo` int(11) NOT NULL,
  `Predicate` varchar(8) NOT NULL,
  `Minimum` float NOT NULL,
  `Maximum` float NOT NULL,
  `Char_Desc` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_meta_character_weight`
--

INSERT INTO `tbl_meta_character_weight` (`CtrlNo`, `Predicate`, `Minimum`, `Maximum`, `Char_Desc`) VALUES
(1, 'D', 0, 1.9, 'Tidak konsisten bersikap'),
(2, 'C', 2, 2.9, 'Perlu ditingkatkan bersikap'),
(3, 'B', 3, 3.9, 'Sudah berusaha maksimal bersikap'),
(4, 'A', 4, 4, 'Selalu konsisten bersikap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meta_grade_weight`
--

CREATE TABLE `tbl_meta_grade_weight` (
  `CtrlNo` int(11) NOT NULL,
  `Degree` varchar(16) NOT NULL,
  `KD_KKM` int(16) NOT NULL,
  `Mid_KKM` int(16) NOT NULL,
  `Final_KKM` int(16) NOT NULL,
  `Report_KKM` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_meta_grade_weight`
--

INSERT INTO `tbl_meta_grade_weight` (`CtrlNo`, `Degree`, `KD_KKM`, `Mid_KKM`, `Final_KKM`, `Report_KKM`) VALUES
(1, 'SD', 0, 75, 75, 75),
(2, 'SMP', 0, 75, 75, 75),
(3, 'SMA', 75, 75, 75, 75),
(4, 'SMK', 75, 75, 75, 75);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meta_grade_weight_nat`
--

CREATE TABLE `tbl_meta_grade_weight_nat` (
  `CtrlNo` int(11) NOT NULL,
  `Degree` varchar(64) NOT NULL,
  `Type` varchar(18) NOT NULL,
  `Absent` int(11) NOT NULL DEFAULT 0,
  `Daily` int(11) DEFAULT 0,
  `Mid` int(11) NOT NULL DEFAULT 0,
  `Final` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_meta_grade_weight_nat`
--

INSERT INTO `tbl_meta_grade_weight_nat` (`CtrlNo`, `Degree`, `Type`, `Absent`, `Daily`, `Mid`, `Final`) VALUES
(1, 'SD', 'Cognitive', 0, 0, 0, 0),
(2, 'SMP', 'Cognitive', 0, 0, 0, 0),
(3, 'SMA', 'Cognitive', 0, 0, 0, 0),
(4, 'SMK', 'Cognitive', 0, 0, 0, 0),
(5, 'SD', 'Skill', 0, 0, 0, 0),
(6, 'SMP', 'Skill', 0, 0, 0, 0),
(7, 'SMA', 'Skill', 0, 0, 0, 0),
(8, 'SMK', 'Skill', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meta_hour_elementary`
--

CREATE TABLE `tbl_meta_hour_elementary` (
  `CtrlNo` int(18) NOT NULL,
  `Remark` varchar(64) NOT NULL,
  `Hour` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_meta_hour_elementary`
--

INSERT INTO `tbl_meta_hour_elementary` (`CtrlNo`, `Remark`, `Hour`) VALUES
(1, '', '07:00:00'),
(2, '', '07:15:00'),
(3, '', '07:45:00'),
(4, '', '08:15:00'),
(5, '', '08:45:00'),
(6, '', '09:15:00'),
(7, '', '09:45:00'),
(8, '', '10:15:00'),
(9, '', '10:45:00'),
(10, '', '11:15:00'),
(11, '', '11:45:00'),
(12, '', '12:15:00'),
(13, '', '12:45:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meta_hour_high`
--

CREATE TABLE `tbl_meta_hour_high` (
  `CtrlNo` int(18) NOT NULL,
  `Remark` varchar(64) NOT NULL,
  `Hour` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_meta_hour_high`
--

INSERT INTO `tbl_meta_hour_high` (`CtrlNo`, `Remark`, `Hour`) VALUES
(1, '', '07:00:00'),
(2, '', '07:15:00'),
(3, '', '08:00:00'),
(4, '', '08:45:00'),
(5, '', '09:30:00'),
(6, '', '10:15:00'),
(7, '', '11:00:00'),
(8, '', '11:45:00'),
(9, '', '12:30:00'),
(10, '', '13:15:00'),
(11, '', '14:00:00'),
(12, '', '14:45:00'),
(13, '', '15:15:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meta_hour_junior`
--

CREATE TABLE `tbl_meta_hour_junior` (
  `CtrlNo` int(18) NOT NULL,
  `Remark` varchar(64) NOT NULL,
  `Hour` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meta_hour_vocational`
--

CREATE TABLE `tbl_meta_hour_vocational` (
  `CtrlNo` int(18) NOT NULL,
  `Remark` varchar(64) NOT NULL,
  `Hour` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_meta_hour_vocational`
--

INSERT INTO `tbl_meta_hour_vocational` (`CtrlNo`, `Remark`, `Hour`) VALUES
(1, '', '07:00:00'),
(2, '', '07:15:00'),
(3, '', '08:00:00'),
(4, '', '08:45:00'),
(5, '', '09:30:00'),
(6, '', '10:15:00'),
(7, '', '11:00:00'),
(8, '', '11:45:00'),
(9, '', '12:30:00'),
(10, '', '13:15:00'),
(11, '', '14:00:00'),
(12, '', '14:45:00'),
(13, '', '15:15:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meta_non_spp`
--

CREATE TABLE `tbl_meta_non_spp` (
  `CtrlNo` int(64) NOT NULL,
  `Level` enum('SD','SMP','SMA') NOT NULL,
  `Type` varchar(128) NOT NULL,
  `Desc` varchar(256) NOT NULL,
  `Price` int(128) NOT NULL,
  `isActive` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_meta_non_spp`
--

INSERT INTO `tbl_meta_non_spp` (`CtrlNo`, `Level`, `Type`, `Desc`, `Price`, `isActive`) VALUES
(3, 'SD', 'Class', 'Buku A', 70000, 'yes'),
(4, 'SD', 'Extra', 'Pembangunan', 500000, 'yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meta_predicate`
--

CREATE TABLE `tbl_meta_predicate` (
  `CtrlNo` int(11) NOT NULL,
  `Predicate` varchar(16) NOT NULL,
  `Maximum` int(11) NOT NULL,
  `Minimum` int(11) NOT NULL,
  `COGFirst` varchar(128) DEFAULT NULL,
  `COGLast` varchar(128) DEFAULT NULL,
  `SKFirst` varchar(128) DEFAULT NULL,
  `SKLast` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_meta_predicate`
--

INSERT INTO `tbl_meta_predicate` (`CtrlNo`, `Predicate`, `Maximum`, `Minimum`, `COGFirst`, `COGLast`, `SKFirst`, `SKLast`) VALUES
(1, 'A', 100, 85, 'Sangat Kompeten', 'Pertahankan Prestasi!', 'Sangat terampil', 'Tetap berlatih dan pertahankan keterampilan!'),
(2, 'B', 84, 70, 'Sudah Kompeten', 'Tingkatkan Prestasi!', 'Sudah terampil', 'Terus tingkatkan belajarmu!'),
(3, 'C', 69, 55, 'Cukup Kompeten', 'Terus semangat belajar!', 'Cukup terampil', 'Tingkatkan semangat belajar!'),
(4, 'D', 54, 0, 'Kurang Kompeten', 'Harus tingkatkan waktu belajar!', 'Tidak terampil', 'Lebih sering berlatih!');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meta_tuition`
--

CREATE TABLE `tbl_meta_tuition` (
  `CtrlNo` int(64) NOT NULL,
  `SchoolID` varchar(128) NOT NULL,
  `SchoolName` varchar(128) NOT NULL,
  `Level` enum('SD','SMP','SMA','') NOT NULL,
  `Category` varchar(16) NOT NULL,
  `Tuition` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_meta_tuition`
--

INSERT INTO `tbl_meta_tuition` (`CtrlNo`, `SchoolID`, `SchoolName`, `Level`, `Category`, `Tuition`) VALUES
(1, 'FD1ES', '', 'SD', 'A', 450000),
(2, 'FD1JS', '', 'SMP', 'A', 485000),
(3, 'FD1HS', '', 'SMA', 'A', 500000),
(4, 'FD1ES', '', 'SD', 'B', 350000),
(5, 'FD1JS', '', 'SMP', 'B', 385000),
(6, 'FD1HS', '', 'SMA', 'B', 400000),
(7, 'FD1ES', '', 'SD', 'C', 250000),
(8, 'FD1JS', '', 'SMP', 'C', 285000),
(9, 'FD1HS', '', 'SMA', 'C', 300000),
(10, 'FD1ES', '', 'SD', 'D', 150000),
(11, 'FD1JS', '', 'SMP', 'D', 185000),
(12, 'FD1HS', '', 'SMA', 'D', 200000),
(13, 'FD1ES', '', 'SD', 'E', 50000),
(14, 'FD1JS', '', 'SMP', 'E', 85000),
(15, 'FD1HS', '', 'SMA', 'E', 100000);

-- --------------------------------------------------------

--
-- Struktur untuk view `classes`
--
DROP TABLE IF EXISTS `classes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `classes`  AS  select `t1`.`ClassID` AS `ClassID`,`t1`.`ClassDesc` AS `ClassDesc`,`t1`.`ClassNumeric` AS `ClassNumeric`,`t1`.`Type` AS `Type`,`t1`.`SchoolID` AS `SchoolID`,`t2`.`RoomID` AS `RoomID`,`t2`.`RoomDesc` AS `RoomDesc`,`t2`.`Simplified` AS `Simplified` from (`tbl_03_class` `t1` join `tbl_04_class_rooms` `t2` on(`t2`.`ClassID` = `t1`.`ClassID`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_00_owner`
--
ALTER TABLE `tbl_00_owner`
  ADD PRIMARY KEY (`OwnerID`);

--
-- Indeks untuk tabel `tbl_01_foundation`
--
ALTER TABLE `tbl_01_foundation`
  ADD PRIMARY KEY (`FoundID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indeks untuk tabel `tbl_02_school`
--
ALTER TABLE `tbl_02_school`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `FoundID` (`FoundID`),
  ADD KEY `SchoolID` (`SchoolID`),
  ADD KEY `SchoolID_2` (`SchoolID`);

--
-- Indeks untuk tabel `tbl_03_a_mas_vocational`
--
ALTER TABLE `tbl_03_a_mas_vocational`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `SchoolID` (`ProgramID`),
  ADD KEY `SubProgramID` (`SubProgramID`),
  ADD KEY `Program` (`Program`,`SubProgram`,`is_active`);

--
-- Indeks untuk tabel `tbl_03_b_class_vocational`
--
ALTER TABLE `tbl_03_b_class_vocational`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `ClassID` (`ClassID`),
  ADD KEY `ClassDesc` (`ClassDesc`),
  ADD KEY `ClassNumeric` (`ClassNumeric`);

--
-- Indeks untuk tabel `tbl_03_class`
--
ALTER TABLE `tbl_03_class`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `ClassID` (`ClassID`),
  ADD KEY `ClassDesc` (`ClassDesc`),
  ADD KEY `tbl_03_class_ibfk_1` (`SchoolID`);

--
-- Indeks untuk tabel `tbl_04_class_rooms`
--
ALTER TABLE `tbl_04_class_rooms`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `RoomID` (`RoomID`),
  ADD KEY `RoomDesc` (`RoomDesc`),
  ADD KEY `tbl_04_class_rooms_ibfk_1` (`ClassID`);

--
-- Indeks untuk tabel `tbl_04_class_rooms_vocational`
--
ALTER TABLE `tbl_04_class_rooms_vocational`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `RoomID` (`RoomID`),
  ADD KEY `RoomDesc` (`RoomDesc`),
  ADD KEY `tbl_04_class_rooms_ibfk_1` (`ClassID`);

--
-- Indeks untuk tabel `tbl_05_subject`
--
ALTER TABLE `tbl_05_subject`
  ADD PRIMARY KEY (`CtrlNo`,`SubjID`),
  ADD KEY `SubjID` (`SubjID`);

--
-- Indeks untuk tabel `tbl_05_subject_character_desc`
--
ALTER TABLE `tbl_05_subject_character_desc`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_05_subject_kd`
--
ALTER TABLE `tbl_05_subject_kd`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_05_subject_weight`
--
ALTER TABLE `tbl_05_subject_weight`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_06_schedule`
--
ALTER TABLE `tbl_06_schedule`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `RoomDesc` (`RoomID`),
  ADD KEY `tbl_06_schedule_ibfk_2` (`RoomDesc`),
  ADD KEY `tbl_06_schedule_ibfk_5` (`IDNumber`),
  ADD KEY `Hour` (`Hour`(1)),
  ADD KEY `tbl_06_schedule_ibfk_6` (`Hour`),
  ADD KEY `semester` (`semester`,`schoolyear`,`Hour`),
  ADD KEY `schoolyear` (`schoolyear`),
  ADD KEY `Days` (`Days`);

--
-- Indeks untuk tabel `tbl_06_schedule_nonregular`
--
ALTER TABLE `tbl_06_schedule_nonregular`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `RoomDesc` (`RoomID`),
  ADD KEY `tbl_06_schedule_ibfk_2` (`RoomDesc`),
  ADD KEY `tbl_06_schedule_ibfk_5` (`IDNumber`),
  ADD KEY `Hour` (`Hour`(1)),
  ADD KEY `tbl_06_schedule_ibfk_6` (`Hour`),
  ADD KEY `semester` (`semester`,`schoolyear`,`Hour`),
  ADD KEY `schoolyear` (`schoolyear`),
  ADD KEY `Days` (`Days`),
  ADD KEY `Type` (`Type`);

--
-- Indeks untuk tabel `tbl_07_personal_bio`
--
ALTER TABLE `tbl_07_personal_bio`
  ADD PRIMARY KEY (`CtrlNo`,`IDNumber`),
  ADD KEY `IDNumber` (`IDNumber`),
  ADD KEY `status` (`status`),
  ADD KEY `PersonalID` (`PersonalID`);

--
-- Indeks untuk tabel `tbl_08_job_info`
--
ALTER TABLE `tbl_08_job_info`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `IDNumber` (`IDNumber`),
  ADD KEY `Occupation` (`Occupation`),
  ADD KEY `Homeroom` (`Homeroom`,`SubjectTeach`);

--
-- Indeks untuk tabel `tbl_08_job_info_std`
--
ALTER TABLE `tbl_08_job_info_std`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `NIS` (`NIS`);

--
-- Indeks untuk tabel `tbl_09_det_character`
--
ALTER TABLE `tbl_09_det_character`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `NIS` (`NIS`,`Semester`,`schoolyear`,`Room`,`SubjName`,`Type`);

--
-- Indeks untuk tabel `tbl_09_det_grades`
--
ALTER TABLE `tbl_09_det_grades`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `NIS` (`NIS`),
  ADD KEY `FullName` (`FullName`,`Semester`,`schoolyear`,`Class`,`Room`,`SubjName`);

--
-- Indeks untuk tabel `tbl_09_det_kd`
--
ALTER TABLE `tbl_09_det_kd`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `NIS` (`NIS`,`Semester`,`schoolyear`,`Room`,`SubjName`,`Type`,`Code`);

--
-- Indeks untuk tabel `tbl_10_absent`
--
ALTER TABLE `tbl_10_absent`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_10_absent_std`
--
ALTER TABLE `tbl_10_absent_std`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_11_enrollment`
--
ALTER TABLE `tbl_11_enrollment`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_credentials`
--
ALTER TABLE `tbl_credentials`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `ID_FK` (`IDNumber`),
  ADD KEY `Status_FK` (`status`);

--
-- Indeks untuk tabel `tbl_meta_absent`
--
ALTER TABLE `tbl_meta_absent`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_meta_active_days`
--
ALTER TABLE `tbl_meta_active_days`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_meta_character_weight`
--
ALTER TABLE `tbl_meta_character_weight`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_meta_grade_weight`
--
ALTER TABLE `tbl_meta_grade_weight`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_meta_grade_weight_nat`
--
ALTER TABLE `tbl_meta_grade_weight_nat`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_meta_hour_elementary`
--
ALTER TABLE `tbl_meta_hour_elementary`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_meta_hour_high`
--
ALTER TABLE `tbl_meta_hour_high`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_meta_hour_junior`
--
ALTER TABLE `tbl_meta_hour_junior`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_meta_hour_vocational`
--
ALTER TABLE `tbl_meta_hour_vocational`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_meta_non_spp`
--
ALTER TABLE `tbl_meta_non_spp`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_meta_predicate`
--
ALTER TABLE `tbl_meta_predicate`
  ADD PRIMARY KEY (`CtrlNo`);

--
-- Indeks untuk tabel `tbl_meta_tuition`
--
ALTER TABLE `tbl_meta_tuition`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `SchoolID_FK` (`SchoolID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_00_owner`
--
ALTER TABLE `tbl_00_owner`
  MODIFY `OwnerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_01_foundation`
--
ALTER TABLE `tbl_01_foundation`
  MODIFY `FoundID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_02_school`
--
ALTER TABLE `tbl_02_school`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_03_a_mas_vocational`
--
ALTER TABLE `tbl_03_a_mas_vocational`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `tbl_03_b_class_vocational`
--
ALTER TABLE `tbl_03_b_class_vocational`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT untuk tabel `tbl_03_class`
--
ALTER TABLE `tbl_03_class`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tbl_04_class_rooms`
--
ALTER TABLE `tbl_04_class_rooms`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `tbl_04_class_rooms_vocational`
--
ALTER TABLE `tbl_04_class_rooms_vocational`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_05_subject`
--
ALTER TABLE `tbl_05_subject`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `tbl_05_subject_character_desc`
--
ALTER TABLE `tbl_05_subject_character_desc`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_05_subject_kd`
--
ALTER TABLE `tbl_05_subject_kd`
  MODIFY `CtrlNo` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT untuk tabel `tbl_05_subject_weight`
--
ALTER TABLE `tbl_05_subject_weight`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT untuk tabel `tbl_06_schedule`
--
ALTER TABLE `tbl_06_schedule`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_06_schedule_nonregular`
--
ALTER TABLE `tbl_06_schedule_nonregular`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_07_personal_bio`
--
ALTER TABLE `tbl_07_personal_bio`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- AUTO_INCREMENT untuk tabel `tbl_08_job_info`
--
ALTER TABLE `tbl_08_job_info`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tbl_08_job_info_std`
--
ALTER TABLE `tbl_08_job_info_std`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT untuk tabel `tbl_09_det_character`
--
ALTER TABLE `tbl_09_det_character`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_09_det_grades`
--
ALTER TABLE `tbl_09_det_grades`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tbl_09_det_kd`
--
ALTER TABLE `tbl_09_det_kd`
  MODIFY `CtrlNo` int(128) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_10_absent`
--
ALTER TABLE `tbl_10_absent`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_10_absent_std`
--
ALTER TABLE `tbl_10_absent_std`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_11_enrollment`
--
ALTER TABLE `tbl_11_enrollment`
  MODIFY `CtrlNo` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `tbl_12_finance_std`
--
ALTER TABLE `tbl_12_finance_std`
  MODIFY `CtrlNo` int(64) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_credentials`
--
ALTER TABLE `tbl_credentials`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT untuk tabel `tbl_meta_absent`
--
ALTER TABLE `tbl_meta_absent`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_meta_active_days`
--
ALTER TABLE `tbl_meta_active_days`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_meta_character_weight`
--
ALTER TABLE `tbl_meta_character_weight`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_meta_grade_weight`
--
ALTER TABLE `tbl_meta_grade_weight`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_meta_grade_weight_nat`
--
ALTER TABLE `tbl_meta_grade_weight_nat`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_meta_hour_elementary`
--
ALTER TABLE `tbl_meta_hour_elementary`
  MODIFY `CtrlNo` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_meta_hour_high`
--
ALTER TABLE `tbl_meta_hour_high`
  MODIFY `CtrlNo` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_meta_hour_junior`
--
ALTER TABLE `tbl_meta_hour_junior`
  MODIFY `CtrlNo` int(18) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_meta_hour_vocational`
--
ALTER TABLE `tbl_meta_hour_vocational`
  MODIFY `CtrlNo` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_meta_non_spp`
--
ALTER TABLE `tbl_meta_non_spp`
  MODIFY `CtrlNo` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_meta_predicate`
--
ALTER TABLE `tbl_meta_predicate`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_meta_tuition`
--
ALTER TABLE `tbl_meta_tuition`
  MODIFY `CtrlNo` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_08_job_info`
--
ALTER TABLE `tbl_08_job_info`
  ADD CONSTRAINT `IDNumber` FOREIGN KEY (`IDNumber`) REFERENCES `tbl_07_personal_bio` (`IDNumber`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_08_job_info_std`
--
ALTER TABLE `tbl_08_job_info_std`
  ADD CONSTRAINT `NIS_FK` FOREIGN KEY (`NIS`) REFERENCES `tbl_07_personal_bio` (`IDNumber`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_09_det_grades`
--
ALTER TABLE `tbl_09_det_grades`
  ADD CONSTRAINT `NIS` FOREIGN KEY (`NIS`) REFERENCES `tbl_07_personal_bio` (`IDNumber`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_12_finance_std`
--
ALTER TABLE `tbl_12_finance_std`
  ADD CONSTRAINT `NIS_FINANCE_FK` FOREIGN KEY (`NIS`) REFERENCES `tbl_07_personal_bio` (`IDNumber`) ON DELETE CASCADE,
  ADD CONSTRAINT `Ruang_Finance_FK` FOREIGN KEY (`Kelas`) REFERENCES `tbl_08_job_info_std` (`Ruangan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_credentials`
--
ALTER TABLE `tbl_credentials`
  ADD CONSTRAINT `ID_FK` FOREIGN KEY (`IDNumber`) REFERENCES `tbl_07_personal_bio` (`IDNumber`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_meta_tuition`
--
ALTER TABLE `tbl_meta_tuition`
  ADD CONSTRAINT `SchoolID_FK` FOREIGN KEY (`SchoolID`) REFERENCES `tbl_02_school` (`SchoolID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
