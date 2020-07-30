-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jul 2020 pada 12.09
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
(7, 'FD1VH', 'SMK Advent Klaat', 'FD1', 'SMK', 'ABase_SysAdmin', '2019-11-22', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_03_a_mas_vocational`
--

CREATE TABLE `tbl_03_a_mas_vocational` (
  `CtrlNo` int(11) NOT NULL,
  `ProgramID` varchar(64) NOT NULL,
  `Program` varchar(256) NOT NULL,
  `SubProgramID` varchar(8) NOT NULL,
  `SubProgram` varchar(16) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `RegBy` varchar(64) NOT NULL,
  `RegDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_03_a_mas_vocational`
--

INSERT INTO `tbl_03_a_mas_vocational` (`CtrlNo`, `ProgramID`, `Program`, `SubProgramID`, `SubProgram`, `is_active`, `RegBy`, `RegDate`) VALUES
(1, 'AA', 'Agribisnis & Agroteknologi', 'AA-TAN', 'Agribisnis Tanam', 0, '', '2020-07-27'),
(2, 'AA', 'Agribisnis & Agroteknologi', 'AA-TER', 'Agribisnis Terna', 0, '', '2020-07-27'),
(3, 'AA', 'Agribisnis & Agroteknologi', 'AA-KH', 'Kesehatan Hewan', 0, '', '2020-07-27'),
(4, 'AA', 'Agribisnis & Agroteknologi', 'AA-APHP', 'Agribisnis Pengo', 0, '', '2020-07-27'),
(5, 'AA', 'Agribisnis & Agroteknologi', 'AA-TK', 'Teknik Pertanian', 0, '', '2020-07-27'),
(6, 'AA', 'Agribisnis & Agroteknologi', 'AA-K', 'Kehutanan', 0, '', '2020-07-27'),
(7, 'BM', 'Business & Management', 'BM-BP', 'Bisnis dan Pemas', 0, '', '2020-07-27'),
(8, 'BM', 'Business & Management', 'BM-MP', 'Manajemen Perkan', 0, '', '2020-07-27'),
(9, 'BM', 'Business & Management', 'BM-AK', 'Akuntansi dan Ke', 0, '', '2020-07-27'),
(10, 'BM', 'Business & Management', 'BM-L', 'Logistik', 0, '', '2020-07-27'),
(11, 'EP', 'Energi & Pertambangan', 'EP-TP', 'Teknik Perminyak', 0, '', '2020-07-27'),
(12, 'EP', 'Energi & Pertambangan', 'EP-GP', 'Geologi Pertamba', 0, '', '2020-07-27'),
(13, 'EP', 'Energi & Pertambangan', 'EP-ET', 'Teknik Energi Te', 0, '', '2020-07-27'),
(14, 'K', 'Kemaritiman', 'K-PKPI', 'Pelayaran Kapal ', 0, '', '2020-07-27'),
(15, 'K', 'Kemaritiman', 'K-PKN', 'Pelayaran Kapal ', 0, '', '2020-07-27'),
(16, 'K', 'Kemaritiman', 'K-P', 'Perikanan', 0, '', '2020-07-27'),
(17, 'K', 'Kemaritiman', 'K-PHP', 'Pengolahan Hasil', 0, '', '2020-07-27'),
(18, 'KPS', 'Kesehatan & Pekerjaan Sosial', 'KPS-K', 'Keperawatan', 0, '', '2020-07-27'),
(19, 'KPS', 'Kesehatan & Pekerjaan Sosial', 'KPS-KG', 'Kesehatan Gigi', 0, '', '2020-07-27'),
(20, 'KPS', 'Kesehatan & Pekerjaan Sosial', 'KPS-TLM', 'Teknologi Labora', 0, '', '2020-07-27'),
(21, 'KPS', 'Kesehatan & Pekerjaan Sosial', 'KPS-F', 'Farmasi', 0, '', '2020-07-27'),
(22, 'KPS', 'Kesehatan & Pekerjaan Sosial', 'KPS-PS', 'Pekerjaan Sosial', 0, '', '2020-07-27'),
(23, 'P', 'Pariwisata', 'P-PJP', 'Perhotelan dan J', 0, '', '2020-07-27'),
(24, 'P', 'Pariwisata', 'P-K', 'Kuliner', 0, '', '2020-07-27'),
(25, 'P', 'Pariwisata', 'P-TK', 'Tata Kecantikan', 0, '', '2020-07-27'),
(26, 'P', 'Pariwisata', 'P-TB', 'Tata Busana', 0, '', '2020-07-27'),
(27, 'SIK', 'Seni & Industri Kreatif', 'SIK-SR', 'Seni Rupa', 0, '', '2020-07-27'),
(28, 'SIK', 'Seni & Industri Kreatif', 'SIK-DPKK', 'Desain dan Produ', 0, '', '2020-07-27'),
(29, 'SIK', 'Seni & Industri Kreatif', 'SIK-SM', 'Seni Musik', 0, '', '2020-07-27'),
(30, 'SIK', 'Seni & Industri Kreatif', 'SIK-STA', 'Seni Tari', 0, '', '2020-07-27'),
(31, 'SIK', 'Seni & Industri Kreatif', 'SIK-SK', 'Seni Karawitan', 0, '', '2020-07-27'),
(32, 'SIK', 'Seni & Industri Kreatif', 'SIK-SP', 'Seni Pedalangan', 0, '', '2020-07-27'),
(33, 'SIK', 'Seni & Industri Kreatif', 'SIK-STE', 'Seni Teater', 0, '', '2020-07-27'),
(34, 'SIK', 'Seni & Industri Kreatif', 'SIK-SBF', 'Seni Broadcastin', 0, '', '2020-07-27'),
(35, 'TIK', 'Tekonologi Informasi & Komunikasi', 'TIK-KI', 'Teknik Komputer ', 0, '', '2020-07-27'),
(36, 'TIK', 'Tekonologi Informasi & Komunikasi', 'TIK-T', 'Teknik Telekomun', 0, '', '2020-07-27'),
(37, 'TR', 'Teknologi & Rekayasa', 'TR-KP', 'Teknik Konstruks', 0, '', '2020-07-27'),
(38, 'TR', 'Teknologi & Rekayasa', 'TR-GG', 'Teknik Geomatika', 0, '', '2020-07-27'),
(39, 'TR', 'Teknologi & Rekayasa', 'TR', 'Teknik Ketenagal', 0, '', '2020-07-27'),
(40, 'TR', 'Teknologi & Rekayasa', 'TR-M', 'Teknik Mesin', 0, '', '2020-07-27'),
(41, 'TR', 'Teknologi & Rekayasa', 'TR-PU', 'Teknologi Pesawa', 0, '', '2020-07-27'),
(42, 'TR', 'Teknologi & Rekayasa', 'TR-G', 'Teknik Grafika', 0, '', '2020-07-27'),
(43, 'TR', 'Teknologi & Rekayasa', 'TR-II', 'Teknik Instrumen', 0, '', '2020-07-27'),
(44, 'TR', 'Teknologi & Rekayasa', 'TR-I', 'Teknik Industri', 0, '', '2020-07-27'),
(45, 'TR', 'Teknologi & Rekayasa', 'TR-T', 'Teknologi Teksti', 0, '', '2020-07-27'),
(46, 'TR', 'Teknologi & Rekayasa', 'TR-K', 'Teknik Kimia', 0, '', '2020-07-27'),
(47, 'TR', 'Teknologi & Rekayasa', 'TR-O', 'Teknik Otomotif', 0, '', '2020-07-27'),
(48, 'TR', 'Teknologi & Rekayasa', 'TR-P', 'Teknik Perkapala', 0, '', '2020-07-27'),
(49, 'TR', 'Teknologi & Rekayasa', 'TR-E', 'Teknik Elektroni', 0, '', '2020-07-27');

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
  `RegBy` varchar(128) NOT NULL,
  `RegDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_03_b_class_vocational`
--

INSERT INTO `tbl_03_b_class_vocational` (`CtrlNo`, `ClassID`, `ClassDesc`, `ClassRomanic`, `ClassNumeric`, `RegBy`, `RegDate`) VALUES
(1, 'SMKC1', 'X KPS-K', 'X', 10, 'ABase_SysAdmin', '2020-07-27'),
(2, 'SMKC2', 'XI KPS-K', 'XI', 11, 'ABase_SysAdmin', '2020-07-27'),
(3, 'SMKC3', 'XII KPS-K', 'XII', 12, 'ABase_SysAdmin', '2020-07-27');

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
-- Dumping data untuk tabel `tbl_03_class`
--

INSERT INTO `tbl_03_class` (`CtrlNo`, `ClassID`, `ClassDesc`, `ClassRomanic`, `ClassNumeric`, `Type`, `SchoolID`, `RegBy`, `RegDate`) VALUES
(2, 'SDC1', 'I', 'I', 1, 'SD', 'FD1ES', 'ABase_SysAdmin', '2018-08-20'),
(3, 'SDC2', 'II', 'II', 2, 'SD', 'FD1ES', 'ABase_SysAdmin', '2019-08-19'),
(4, 'SDC3', 'III', 'III', 3, 'SD', 'FD1ES', 'ABase_SysAdmin', '2019-08-19'),
(5, 'SDC4', 'IV', 'IV', 4, 'SD', 'FD1ES', 'ABase_SysAdmin', '2019-08-19'),
(6, 'SDC5', 'V', 'V', 5, 'SD', 'FD1ES', 'ABase_SysAdmin', '2019-08-19'),
(7, 'SDC6', 'VI', 'VI', 6, 'SD', 'FD1ES', 'ABase_SysAdmin', '2019-08-19'),
(10, 'SMAC2BHS', 'XI Bahasa', 'XI', 11, 'SMA', 'FD1HS', 'ABase_SysAdmin', '2019-09-04'),
(11, 'SMAC2IPA', 'XI IPA', 'XI', 11, 'SMA', 'FD1HS', 'ABase_SysAdmin', '2019-09-04'),
(12, 'SMAC2IPS', 'XI IPS', 'XI', 11, 'SMA', 'FD1HS', 'ABase_SysAdmin', '2019-09-04'),
(14, 'SMAC3BHS', 'XII Bahasa', 'XII', 12, 'SMA', 'FD1HS', 'ABase_SysAdmin', '2019-09-04'),
(15, 'SMAC3IPA', 'XII IPA', 'XII', 12, 'SMA', 'FD1HS', 'ABase_SysAdmin', '2019-09-04'),
(16, 'SMAC3IPS', 'XII IPS', 'XII', 12, 'SMA', 'FD1HS', 'ABase_SysAdmin', '2019-09-04'),
(17, 'SMPC1', 'VII', 'VII', 7, 'SMP', 'FD1JS', 'ABase_SysAdmin', '2019-08-19'),
(18, 'SMPC2', 'VIII', 'VIII', 8, 'SMP', 'FD1JS', 'ABase_SysAdmin', '2019-08-19'),
(19, 'SMPC3', 'IX', 'IX', 9, 'SMP', 'FD1JS', 'ABase_SysAdmin', '2019-08-19'),
(20, 'SMAC1BHS', 'X Bahasa', 'X', 10, 'SMA', 'FD1HS', '', '0000-00-00'),
(21, 'SMAC1IPA', 'X IPA', 'X', 10, 'SMA', 'FD1HS', '', '0000-00-00'),
(22, 'SMAC1IPS', 'X IPS', 'X', 10, 'SMA', 'FD1HS', '', '0000-00-00'),
(23, 'SMKC1', 'X KPS-K', 'X', 10, '', '', 'ABase_SysAdmin', '2020-07-27'),
(24, 'SMKC2', 'XI KPS-K', 'XI', 11, '', '', 'ABase_SysAdmin', '2020-07-27'),
(25, 'SMKC3', 'XII KPS-K', 'XII', 12, '', '', 'ABase_SysAdmin', '2020-07-27'),
(26, 'SMKC1', 'X KPS-K', 'X', 10, '', '', 'ABase_SysAdmin', '2020-07-27'),
(27, 'SMKC2', 'XI KPS-K', 'XI', 11, '', '', 'ABase_SysAdmin', '2020-07-27'),
(28, 'SMKC3', 'XII KPS-K', 'XII', 12, '', '', 'ABase_SysAdmin', '2020-07-27');

-- --------------------------------------------------------

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

--
-- Dumping data untuk tabel `tbl_04_class_rooms`
--

INSERT INTO `tbl_04_class_rooms` (`CtrlNo`, `RoomID`, `RoomDesc`, `Simplified`, `Type`, `ClassID`, `RegBy`, `RegDate`) VALUES
(1, 'SDR1A', 'I (A)', '', 'SD', 'SDC1', 'ABase_SysAdmin', '2019-08-21'),
(4, 'SDR2A', 'II (A)', '', 'SD', 'SDC2', 'ABase_SysAdmin', '2019-08-19'),
(5, 'SDR3A', 'III (A)', '', 'SD', 'SDC3', 'ABase_SysAdmin', '2019-08-19'),
(6, 'SDR4A', 'IV (A)', '', 'SD', 'SDC4', 'ABase_SysAdmin', '2019-08-21'),
(7, 'SDR5A', 'V (A)', '', 'SD', 'SDC5', 'ABase_SysAdmin', '2019-08-21'),
(8, 'SDR6A', 'VI (A)', '', 'SD', 'SDC6', 'ABase_SysAdmin', '2019-08-21'),
(13, 'SMAR2IPAA', 'XI IPA (A)', 'XI (A)', 'SMA', 'SMAC2IPA', '', '2019-11-26'),
(20, 'SMPR2A', 'VIII (A)', '', 'SMP', 'SMPC2', 'ABase_SysAdmin', '2019-08-21'),
(21, 'SMPR3A', 'IX (A)', '', 'SMP', 'SMPC3', 'ABase_SysAdmin', '2019-08-21'),
(58, 'SMPR1A', 'VII (A)', '', 'SMP', 'SMPC1', 'SysAdmin', '2019-11-26'),
(60, 'SMAR1IPAA', 'X IPA (A)', 'X (A)', 'SMA', 'SMAC1IPA', 'SysAdmin', '2019-11-26'),
(61, 'SMAR1IPSA', 'X IPS (A)', 'X (A)', 'SMA', 'SMAC1IPS', 'SysAdmin', '2019-11-26'),
(65, 'SMAR3IPAA', 'XII IPA (A)', 'XII (A)', 'SMA', 'SMAC3IPA', 'SysAdmin', '2019-11-26'),
(66, 'SMAR3IPSA', 'XII IPS (A)', 'XII (A)', 'SMA', 'SMAC3IPS', 'SysAdmin', '2019-11-26'),
(68, 'SMAR2IPSA', 'XI IPS (A)', 'XI (A)', 'SMA', 'SMAC2IPS', 'SysAdmin', '2019-12-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_04_class_rooms_vocational`
--

CREATE TABLE `tbl_04_class_rooms_vocational` (
  `CtrlNo` int(11) NOT NULL,
  `RoomID` varchar(128) NOT NULL,
  `RoomDesc` varchar(128) NOT NULL,
  `Simplified` varchar(32) NOT NULL,
  `ClassID` varchar(128) NOT NULL,
  `RegBy` varchar(128) NOT NULL DEFAULT 'SysAdmin',
  `RegDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_04_class_rooms_vocational`
--

INSERT INTO `tbl_04_class_rooms_vocational` (`CtrlNo`, `RoomID`, `RoomDesc`, `Simplified`, `ClassID`, `RegBy`, `RegDate`) VALUES
(1, 'SMAR1KPS-K', 'X KPS-K (A)', 'X KPS-K', 'SMKC1', 'SysAdmin', '2019-11-26'),
(2, 'SMAR1KPS-K', 'XI KPS-K (A)', 'XI KPS-K', 'SMKC2', 'SysAdmin', '2019-11-26'),
(3, 'SMAR1KPS-K', 'XII KPS-K (A)', 'XII KPS-K', 'SMKC3', 'SysAdmin', '2019-11-26');

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

--
-- Dumping data untuk tabel `tbl_05_subject`
--

INSERT INTO `tbl_05_subject` (`CtrlNo`, `SubjID`, `SubjName`, `SubjDesc`, `Type`) VALUES
(1, 'MATH', 'Matematika', 'Matematika Dasar', 'Regular'),
(2, 'SCN', 'IPA', 'Ilmu Pengetahuan Alam', 'Regular'),
(3, 'SOC', 'IPS', 'Ilmu Pengetahuan Sosial', 'Regular'),
(4, 'COM', 'Komputer', 'Ilmu Komputer', 'Regular'),
(5, 'PHY', 'Penjas', 'Pendidikan Jasmani', 'Regular'),
(6, 'AGM', 'Pendidikan Agama', 'Pendidikan Agama Kristen', 'Regular'),
(7, 'FIS', 'Fisika', 'Ilmu Fisika', 'Regular'),
(8, 'BIO', 'Biologi', 'Pendidikan Agama Kristen', 'Regular'),
(9, 'CHE', 'Kimia', 'Pendidikan Agama Kristen', 'Regular'),
(10, 'SOCS', 'Sosiologi', 'Pendidikan Agama Kristen', 'Regular'),
(11, 'ECO', 'Ekonomi', 'Ilmu Ekonomi', 'Regular'),
(12, 'HIST', 'Sejarah', 'Ilmu Sejarah', 'Regular'),
(13, 'CIV', 'PKN', 'Pendidikan Kewarganegaraan', 'Regular'),
(14, 'LOC', 'Mulok', 'Muatan Lokal', 'Regular'),
(15, '0', 'None', 'None', '-'),
(16, 'LIT', 'Bahasa dan Sastra Indonesia', 'Sastra Indonesia', 'Regular'),
(17, 'ENG', 'Bahasa Inggris', 'Bahasa Inggris', 'Regular'),
(18, 'BUD', 'Seni Budaya', 'Seni Budaya', 'Regular'),
(19, 'ANTH', 'Anthropologi', 'Anthropologi', 'Regular'),
(20, 'GEO', 'Geografi', 'Geografi', 'Regular'),
(37, '-', '-', '-', '-'),
(38, 'SIGN', 'Sign Language', '', 'Excul'),
(39, 'CARP', 'Carpentry', '', 'Excul'),
(40, 'BB', 'Basketball', '', 'Excul'),
(41, 'FLOWER', 'Flower Culture', '', 'Excul'),
(42, 'CHOIR', 'Choir', '', 'Excul'),
(43, 'OFFICEMACH', 'Office Machine', '', 'Excul'),
(44, 'ANGKLUNG', 'Angklung', '', 'Excul'),
(45, 'CHRDRAMA', 'Christian Drama', '', 'Excul'),
(46, 'CULTDANCE', 'Cultural Dance', '', 'Excul'),
(47, 'MARCH', 'Marching & Drilling', '', 'Excul'),
(48, 'KEYBOARD', 'Keyboarding', '', 'Excul'),
(49, 'GARDEN', 'Gardening', '', 'Excul'),
(50, 'SPEECH', 'Speech', '', 'Excul'),
(51, 'FUTSAL', 'Futsal', '', 'Excul'),
(52, 'GATE', 'Gate Ministry', '', 'Excul'),
(53, 'ENGCLUB', 'English Club', '', 'Excul'),
(54, 'SCNCLUB', 'Science Club', '', 'Excul'),
(55, 'UPC', 'Upacara', '', 'Non-Subject'),
(56, 'CHPL', 'Chapel', '', 'Non-Subject'),
(58, 'U1', 'Bahasa & Sastra Arab', '', 'Regular'),
(59, 'EXCUL', 'EXCUL', '', 'Excul'),
(60, 'ELECTIVE', 'ELECTIVE', '', 'Elective'),
(64, 'BREAK', 'Istirahat', '', 'Non-Subject'),
(66, 'JPN', 'Bahasa Jepang', '', 'Elective');

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
-- Dumping data untuk tabel `tbl_05_subject_kd`
--

INSERT INTO `tbl_05_subject_kd` (`CtrlNo`, `Degree`, `Classes`, `Type`, `SubjName`, `Semester`, `Code`, `KD`, `Adjust`, `KKM`, `Weight1`, `Weight1_Desc`, `Weight2`, `Weight2_Desc`, `Weight3`, `Weight3_Desc`) VALUES
(8, NULL, 'X', 'cognitive', 'Komputer', 1, '10.3.1', 'Integrasi antar aplikasi office', '', 75, 50, 'Tugas', 50, 'Tugas2', NULL, ''),
(9, NULL, 'X', 'cognitive', 'Komputer', 1, '10.3.2.1', 'Perangkat keras, lunak dan pengguna', 'Perangkat keras, lunak dan pengguna', 75, 100, '', NULL, '', NULL, ''),
(10, NULL, 'X', 'cognitive', 'Komputer', 1, '10.3.2.2', 'Persoalan terkait penggunaan komputer', '', 75, 100, '', NULL, '', NULL, ''),
(11, NULL, 'X', 'cognitive', 'Komputer', 1, '10.3.2.3', 'Jaringan komputer lebih teknis', '', 75, 100, '', NULL, '', NULL, ''),
(12, NULL, 'X', 'cognitive', 'Komputer', 1, '10.3.4', 'Data dapat dikoleksi kontinyu dan otomatis', '', 75, 100, '', NULL, '', NULL, ''),
(13, NULL, 'X', 'cognitive', 'Komputer', 1, '10.3.5', 'Aspek privasi pengumpulan data', '', 75, 100, '', NULL, '', NULL, ''),
(15, NULL, 'X', 'cognitive', 'Komputer', 2, '10.3.7', ' Cara visualisasi data', '', 75, 100, 'Test1', NULL, 'Test2', NULL, ''),
(16, NULL, 'X', 'cognitive', 'Komputer', 2, '10.3.8.1', ' Notasi algoritma', '', 75, 100, '', NULL, '', NULL, ''),
(17, NULL, 'X', 'cognitive', 'Komputer', 2, '10.3.8.3', 'Variable, Value, Konstanta & Instruksi', 'Variable, Value, Konstanta & Instruksi  ', 75, 100, '', NULL, '', NULL, ''),
(18, NULL, 'X', 'cognitive', 'Komputer', 2, '10.3.8.4', 'Eksekusi konditional dan loop', '', 75, 100, '', NULL, '', NULL, ''),
(19, NULL, 'X', 'cognitive', 'Komputer', 2, '10.3.8.2', 'Struktur/ Templates Program', '  ', 75, 100, '', NULL, '', NULL, ''),
(20, NULL, 'X', 'cognitive', 'Komputer', 2, '10.3.8.5', 'Struktur Data Dasar', '', 75, 100, '', NULL, '', NULL, ''),
(21, NULL, 'X', 'cognitive', 'Komputer', 2, '10.3.10.1', 'Aspek sosial penggunaan komputer', '', 75, 100, '', NULL, '', NULL, ''),
(22, NULL, 'X', 'cognitive', 'Komputer', 2, '10.3.10.2', 'Teknologi memperbaiki kualitas hidup', 'Teknologi memperbaiki kualitas hidup  ', 75, 100, '', NULL, '', NULL, ''),
(23, NULL, 'X', 'cognitive', 'Komputer', 2, '10.3.11', 'Computational Thinking', '', 75, 100, '', NULL, '', NULL, ''),
(24, NULL, 'X', 'cognitive', 'Komputer', 2, '10.3.12', 'Cross-cut Component, Capstone', '', 75, 100, '', NULL, '', NULL, ''),
(26, NULL, 'X', 'skills', 'Komputer', 1, '10.4.1.1', 'Membuat laporan integrasi objek', 'Membuat laporan integrasi objek', 75, 100, 'Testing', NULL, '', NULL, ''),
(32, NULL, 'X', 'skills', 'Komputer', 1, '10.4.1.2', 'Fitur lanjut aplikasi office', '', 75, 100, '', NULL, '', NULL, ''),
(33, NULL, 'X', 'skills', 'Komputer', 1, '10.4.2', 'Interaksi (transfer data, thetering)', '', 75, 100, '', NULL, '', NULL, ''),
(34, NULL, 'X', 'skills', 'Komputer', 1, '10.4.3.1', 'Komponen Jaringan dan Mekanismenya', '', 75, 100, '', NULL, '', NULL, ''),
(35, NULL, 'X', 'skills', 'Komputer', 1, '10.4.3.2', 'Menjelaskan jaringan komputer', ' Menjelaskan jaringan Komputer', 75, 100, '', NULL, '', NULL, ''),
(36, NULL, 'X', 'skills', 'Komputer', 1, '10.4.4', 'Cara pengumpulan data', '', 75, 100, '', NULL, '', NULL, ''),
(37, NULL, 'X', 'skills', 'Komputer', 1, '10.4.5', 'Mempublikasi data dengan aspek privasi', '', 75, 100, '', NULL, '', NULL, ''),
(39, NULL, 'X', 'skills', 'Komputer', 1, '10.4.6', 'Memproses data dengan pemroses angka', '', 75, 100, '', NULL, '', NULL, ''),
(40, NULL, 'X', 'skills', 'Komputer', 2, '10.4.7', 'Memvisualisasikan data besar', '', 75, 10, '', 10, '', NULL, ''),
(41, NULL, 'X', 'skills', 'Komputer', 2, '10.4.8.1', 'Menulis program sederhana', '', 75, 10, '', 10, '', NULL, ''),
(42, NULL, 'X', 'skills', 'Komputer', 2, '10.4.8.2', 'Mengkombinasikan struktur kontrol', '', 75, 10, '', 10, '', NULL, ''),
(43, NULL, 'X', 'skills', 'Komputer', 2, '10.4.10', 'Menjelaskan kasus2 sosial & TIK', '', 75, 10, '', 10, '', NULL, ''),
(44, NULL, 'X', 'skills', 'Komputer', 2, '10.4.11', 'Memecahkan persoalan agak kompleks', '', 75, 10, '', 10, '', NULL, ''),
(45, NULL, 'X', 'skills', 'Komputer', 2, '10.4.12.1', 'Membina Budaya kerja tim', '', 75, 10, '', 10, '', NULL, ''),
(46, NULL, 'X', 'skills', 'Komputer', 2, '10.4.12.2', 'Berkolaborasi dengan tema komputing', '', 75, 10, '', 10, '', NULL, ''),
(47, NULL, 'X', 'skills', 'Komputer', 2, '10.4.12.3', 'Mengenali pemecahan dengan komputer', '', 75, 10, '', 10, '', NULL, ''),
(48, NULL, 'X', 'skills', 'Komputer', 2, '10.4.12.4', 'Mengembangkan abstraksi', '', 75, 10, '', 10, '', NULL, ''),
(49, NULL, 'X', 'skills', 'Komputer', 2, '10.4.12.5', 'Mengembangkan Artefak komputasional', '', 75, 10, '', 10, '', NULL, ''),
(50, NULL, 'X', 'skills', 'Komputer', 2, '10.4.12.6', 'Menguji uji artefak Komputasional', '', 75, 10, '', 10, '', NULL, ''),
(51, NULL, 'X', 'skills', 'Komputer', 2, '10.4.12.7', 'Mengkomunikasikan HAKI', '', 75, 10, '', 10, '', NULL, ''),
(52, NULL, 'X', 'cognitive', 'Komputer', 1, '10.3.6', 'Data jumlah besar dapat disederhanakan', '', 75, 100, '', NULL, '', NULL, ''),
(54, NULL, 'X', 'cognitive', 'Matematika', 1, '10.3.1', 'Fungsi eksponensial dan fungsi logaritma', NULL, 75, NULL, '', NULL, '', NULL, ''),
(55, NULL, 'X', 'cognitive', 'Bahasa Inggris', 1, '10.3.1', 'Formulir isian perusahaan/ bank/ instansi', NULL, 75, NULL, '', NULL, '', NULL, ''),
(56, NULL, 'X', 'cognitive', 'Bahasa Inggris', 2, '10.3.6', 'Kecukupan untuk dapat melakukan sesuatu', NULL, 75, NULL, '', NULL, '', NULL, ''),
(57, NULL, 'X', 'skills', 'Bahasa Inggris', 1, '10.4.1', 'Menangkap makna Formulir isian perusahaan/ bank', '', 75, NULL, '', NULL, '', NULL, ''),
(58, NULL, 'X', 'skills', 'Bahasa Inggris', 2, '10.4.6', 'Menyusun teks Kecukupan untuk melakukan sesuatu', NULL, 75, NULL, '', NULL, '', NULL, ''),
(59, NULL, 'X', 'cognitive', 'Bahasa Inggris', 1, '10.3.2', 'Melakukan tindakan waktu akan datang', NULL, 75, NULL, '', NULL, '', NULL, ''),
(60, NULL, 'X', 'cognitive', 'Bahasa Inggris', 1, '10.3.3', 'Kejadian akan, sedang & telah dilakukan di waktu akan datang', NULL, 75, NULL, '', NULL, '', NULL, ''),
(61, NULL, 'X', 'cognitive', 'Bahasa Inggris', 1, '10.3.4', 'Hubungan setara dua benda/ tindakan', NULL, 75, NULL, '', NULL, '', NULL, ''),
(62, NULL, 'X', 'cognitive', 'Bahasa Inggris', 1, '10.3.5', 'Biografi tokoh terkenal', NULL, 75, NULL, '', NULL, '', NULL, ''),
(63, NULL, 'X', 'skills', 'Bahasa Inggris', 1, '10.4.2', 'Menyusun teks Melakukan tindakan waktu akan datang', NULL, 75, NULL, '', NULL, '', NULL, ''),
(64, NULL, 'X', 'skills', 'Bahasa Inggris', 1, '10.4.3', 'Menyusun teks Kejadian akan, sedang & telah dilakukan akan datang', NULL, 75, NULL, '', NULL, '', NULL, ''),
(65, NULL, 'X', 'skills', 'Bahasa Inggris', 1, '10.4.4', 'Menyusun teks Hubungan setara dua benda/ tindakan', NULL, 75, NULL, '', NULL, '', NULL, ''),
(66, NULL, 'X', 'skills', 'Bahasa Inggris', 1, '10.4.5.2', 'Menyusun teks Biografi tokoh terkenal', NULL, 75, NULL, '', NULL, '', NULL, ''),
(67, NULL, 'X', 'cognitive', 'Bahasa Inggris', 2, '10.3.7', 'Kegiatan (event)', NULL, 75, NULL, '', NULL, '', NULL, ''),
(68, NULL, 'X', 'cognitive', 'Bahasa Inggris', 2, '10.3.8', 'Terkait teknologi dalam mapel lain', NULL, 75, NULL, '', NULL, '', NULL, ''),
(69, NULL, 'X', 'cognitive', 'Bahasa Inggris', 2, '10.3.9', 'Kehidupan remaja', NULL, 75, NULL, '', NULL, '', NULL, ''),
(70, NULL, 'X', 'cognitive', 'Bahasa Inggris', 2, '10.3.10', 'Lirik lagu kehidupan remaja', NULL, 75, NULL, '', NULL, '', NULL, ''),
(71, NULL, 'X', 'skills', 'Bahasa Inggris', 2, '10.4.7.2', 'Menyusun teks Kegiatan (event)', NULL, 75, NULL, '', NULL, '', NULL, ''),
(72, NULL, 'X', 'skills', 'Bahasa Inggris', 2, '10.4.8.2', 'Menyusun teks Terkait teknologi', NULL, 75, NULL, '', NULL, '', NULL, ''),
(73, NULL, 'X', 'skills', 'Bahasa Inggris', 2, '10.4.9', 'Menangkap makna Kehidupan remaja', NULL, 75, NULL, '', NULL, '', NULL, ''),
(74, NULL, 'X', 'skills', 'Bahasa Inggris', 2, '10.4.10', 'Menangkap makna Lirik lagu', NULL, 75, NULL, '', NULL, '', NULL, ''),
(75, NULL, 'XI', 'cognitive', 'Bahasa Inggris', 1, '11.3.1', 'Menyarankan melakukan sesuatu', '\n  Menyarankan\n  melakukan sesuatu  ', 75, NULL, '', NULL, '', NULL, ''),
(76, NULL, 'XI', 'cognitive', 'Bahasa Inggris', 1, '11.3.2', 'Kejadian yang telah terjadi', NULL, 75, NULL, '', NULL, '', NULL, ''),
(77, NULL, 'XI', 'cognitive', 'Bahasa Inggris', 1, '11.3.3', 'Rencana yang akan datang', NULL, 75, NULL, '', NULL, '', NULL, ''),
(78, NULL, 'XI', 'cognitive', 'Bahasa Inggris', 1, '11.3.4', 'Poem', NULL, 75, NULL, '', NULL, '', NULL, ''),
(79, NULL, 'XI', 'cognitive', 'Bahasa Inggris', 1, '11.3.5', 'Cerita pendek', NULL, 75, NULL, '', NULL, '', NULL, ''),
(80, NULL, 'XI', 'cognitive', 'Bahasa Inggris', 2, '11.3.6', 'Acara, tawaran, janji & reservasi', NULL, 75, NULL, '', NULL, '', NULL, ''),
(81, NULL, 'XI', 'cognitive', 'Bahasa Inggris', 2, '11.3.7', 'Promosi barang/ jasa/ kegiatan', NULL, 75, NULL, '', NULL, '', NULL, ''),
(82, NULL, 'XI', 'cognitive', 'Bahasa Inggris', 2, '11.3.8', 'Pemberian contoh', NULL, 75, NULL, '', NULL, '', NULL, ''),
(83, NULL, 'XI', 'cognitive', 'Bahasa Inggris', 2, '11.3.9', 'Pendapat mengenai topik hangat', 'Menyusun Pendapat mengenai topik hangat  ', 75, NULL, '', NULL, '', NULL, ''),
(84, NULL, 'XI', 'cognitive', 'Bahasa Inggris', 2, '11.3.10', 'Lirik lagu kehidupan remaja', NULL, 75, NULL, '', NULL, '', NULL, ''),
(85, NULL, 'XI', 'skills', 'Bahasa Inggris', 1, '11.4.1', 'Menyusun teks Menyarankan melakukan sesuatu', NULL, 75, NULL, '', NULL, '', NULL, ''),
(86, NULL, 'XI', 'skills', 'Bahasa Inggris', 1, '11.4.2', 'Menyusun teks Kejadian yang telah terjadi', NULL, 75, NULL, '', NULL, '', NULL, ''),
(87, NULL, 'XI', 'skills', 'Bahasa Inggris', 1, '11.4.3', 'Menyusun teks Rencana yang akan datang', NULL, 75, NULL, '', NULL, '', NULL, ''),
(88, NULL, 'XI', 'skills', 'Bahasa Inggris', 1, '11.4.4', 'Menangkap makna Poem', NULL, 75, NULL, '', NULL, '', NULL, ''),
(89, NULL, 'XI', 'skills', 'Bahasa Inggris', 1, '11.4.5', 'Menangkap makna Cerita pendek', NULL, 75, NULL, '', NULL, '', NULL, ''),
(90, NULL, 'XI', 'skills', 'Bahasa Inggris', 2, '11.4.6', 'Menyusun teks Acara, tawaran, janji & reservasi', NULL, 75, NULL, '', NULL, '', NULL, ''),
(91, NULL, 'XI', 'skills', 'Bahasa Inggris', 2, '11.4.7.2', 'Menyusun teks Acara, tawaran, janji & reservasi', NULL, 75, NULL, '', NULL, '', NULL, ''),
(92, NULL, 'XI', 'skills', 'Bahasa Inggris', 2, '11.4.8', 'Menyusun teks Pemberian contoh', NULL, 75, NULL, '', NULL, '', NULL, ''),
(93, NULL, 'XI', 'skills', 'Bahasa Inggris', 2, '11.4.9.2', 'Menyusun Pendapat mengenai topik hangat', '\n  Menyusun\n  Pendapat mengenai topik hangat  ', 75, NULL, '', NULL, '', NULL, ''),
(94, NULL, 'XI', 'skills', 'Bahasa Inggris', 2, '11.4.10', 'Menangkap makna Lirik lagu', NULL, 75, NULL, '', NULL, '', NULL, ''),
(106, NULL, 'XII', 'cognitive', 'Bahasa Inggris', 1, '12.3.1', 'Hubungan sebab akibat', NULL, 75, NULL, '', NULL, '', NULL, ''),
(107, NULL, 'XII', 'cognitive', 'Bahasa Inggris', 1, '12.3.2', 'Benda dengan pewatas keadaan/ kejadian', NULL, 75, NULL, '', NULL, '', NULL, ''),
(108, NULL, 'XII', 'cognitive', 'Bahasa Inggris', 1, '12.3.3', 'Keterangan (circumstance)', NULL, 75, NULL, '', NULL, '', NULL, ''),
(109, NULL, 'XII', 'cognitive', 'Bahasa Inggris', 1, '12.3.4', 'Pengandaian terjadinya sesuatu tidak nyata', NULL, 75, NULL, '', NULL, '', NULL, ''),
(110, NULL, 'XII', 'cognitive', 'Bahasa Inggris', 1, '12.3.5', 'Hubungan pertentangan & kebalikan', NULL, 75, NULL, '', NULL, '', NULL, ''),
(111, NULL, 'XII', 'cognitive', 'Bahasa Inggris', 2, '12.3.6', 'Pembahasan isu kontrovesial & aktual', NULL, 75, NULL, '', NULL, '', NULL, ''),
(112, NULL, 'XII', 'cognitive', 'Bahasa Inggris', 2, '12.3.7', 'Konsesi', NULL, 75, NULL, '', NULL, '', NULL, ''),
(113, NULL, 'XII', 'cognitive', 'Bahasa Inggris', 2, '12.3.8', 'Penilaian terkait film/ buku/ cerita', NULL, 75, NULL, '', NULL, '', NULL, ''),
(114, NULL, 'XII', 'cognitive', 'Bahasa Inggris', 2, '12.3.9', 'Lirik lagu kehidupan remaja', NULL, 75, NULL, '', NULL, '', NULL, ''),
(115, NULL, 'XII', 'skills', 'Bahasa Inggris', 1, '12.4.1', 'Menyusun teks Hubungan sebab akibat', NULL, 75, NULL, '', NULL, '', NULL, ''),
(116, NULL, 'XII', 'skills', 'Bahasa Inggris', 1, '12.4.2', 'Menyusun teks Benda dengan pewatas', NULL, 75, NULL, '', NULL, '', NULL, ''),
(117, NULL, 'XII', 'skills', 'Bahasa Inggris', 1, '12.4.3', 'Menyusun teks Keterangan (circumstance)', NULL, 75, NULL, '', NULL, '', NULL, ''),
(118, NULL, 'XII', 'skills', 'Bahasa Inggris', 1, '12.4.4', 'Menyusun Pengandaian sesuatu tidak nyata', '\n  Menyusun\n  Pengandaian sesuatu tidak nyata  ', 75, NULL, '', NULL, '', NULL, ''),
(119, NULL, 'XII', 'skills', 'Bahasa Inggris', 1, '12.4.5', 'Menyusun Hubungan pertentangan & kebalikan', '\n  Menyusun\n  Hubungan pertentangan & kebalikan  ', 75, NULL, '', NULL, '', NULL, ''),
(120, NULL, 'XII', 'skills', 'Bahasa Inggris', 2, '12.4.6.2', 'Menyusun Pembahasan isu aktual', '\n  Menyusun\n  Pembahasan isu aktual  ', 75, NULL, '', NULL, '', NULL, ''),
(121, NULL, 'XII', 'skills', 'Bahasa Inggris', 2, '12.4.7', 'Menyusun teks Konsesi', NULL, 75, NULL, '', NULL, '', NULL, ''),
(122, NULL, 'XII', 'skills', 'Bahasa Inggris', 2, '12.4.8', 'Menangkap makna Penilaian terkait cerita', '\n  Menangkap\n  makna Penilaian terkait cerita  ', 75, NULL, '', NULL, '', NULL, ''),
(123, NULL, 'XII', 'skills', 'Bahasa Inggris', 2, '12.4.9', 'Menangkap makna Lirik lagu', NULL, 75, NULL, '', NULL, '', NULL, ''),
(124, NULL, 'X', 'cognitive', 'Bahasa dan Sastra Indonesia', 1, '10.3.1', 'Informasi suatu tabel atau grafik', '', 75, NULL, '', NULL, '', NULL, ''),
(125, NULL, 'X', 'cognitive', 'Bahasa dan Sastra Indonesia', 1, '10.3.2', 'Teks naratif objektif tentang riwayat tokoh', '', 75, NULL, '', NULL, '', NULL, ''),
(126, NULL, 'X', 'cognitive', 'Bahasa dan Sastra Indonesia', 1, '10.3.3', 'Kategori kata', '', 75, NULL, '', NULL, '', NULL, ''),
(127, NULL, 'X', 'cognitive', 'Bahasa dan Sastra Indonesia', 1, '10.3.4', 'Proses morfologis dalam kalimat', '', 75, NULL, '', NULL, '', NULL, ''),
(128, NULL, 'X', 'cognitive', 'Bahasa dan Sastra Indonesia', 2, '10.3.5', 'Frasa dan konstruksi frasa', '', 75, NULL, '', NULL, '', NULL, ''),
(129, NULL, 'X', 'cognitive', 'Bahasa dan Sastra Indonesia', 2, '10.3.6', 'Jenis-jenis makna', '', 75, NULL, '', NULL, '', NULL, ''),
(130, NULL, 'X', 'cognitive', 'Bahasa dan Sastra Indonesia', 2, '10.3.7', 'Jenis-jenis makna', '', 75, NULL, '', NULL, '', NULL, ''),
(131, NULL, 'X', 'cognitive', 'Bahasa dan Sastra Indonesia', 2, '10.3.8', 'Puisi bertema sosial, budaya, dan kemanusian', '', 75, NULL, '', NULL, '', NULL, ''),
(141, NULL, 'XI', 'cognitive', 'Bahasa dan Sastra Indonesia', 1, '11.3.1', 'Pendapat narasumber dalam suatu debat', '', 75, NULL, '', NULL, '', NULL, ''),
(142, NULL, 'XI', 'cognitive', 'Bahasa dan Sastra Indonesia', 1, '11.3.2', 'Makalah', '', 75, NULL, '', NULL, '', NULL, ''),
(143, NULL, 'XI', 'cognitive', 'Bahasa dan Sastra Indonesia', 1, '11.3.3', 'Makalah', '', 75, NULL, '', NULL, '', NULL, ''),
(144, NULL, 'XI', 'cognitive', 'Bahasa dan Sastra Indonesia', 1, '11.3.4', 'Berbagai jenis kalimat dalam novel', '', 75, NULL, '', NULL, '', NULL, ''),
(145, NULL, 'XI', 'cognitive', 'Bahasa dan Sastra Indonesia', 2, '11.3.5', 'Berbagai genre sastra berdasarkan periodisasi', '', 75, NULL, '', NULL, '', NULL, ''),
(146, NULL, 'XI', 'cognitive', 'Bahasa dan Sastra Indonesia', 2, '11.3.6', 'Nilai-nilai dalam cerita pendek', '', 75, NULL, '', NULL, '', NULL, ''),
(147, NULL, 'XI', 'cognitive', 'Bahasa dan Sastra Indonesia', 2, '11.3.7', 'Nilai-nilai dalam novel', '', 75, NULL, '', NULL, '', NULL, ''),
(148, NULL, 'XI', 'cognitive', 'Bahasa dan Sastra Indonesia', 2, '11.3.8', 'Pementasan drama', '', 75, NULL, '', NULL, '', NULL, ''),
(149, NULL, 'XI', 'skills', 'Bahasa dan Sastra Indonesia', 1, '11.4.1', 'Praktik Berdebat', '', 75, NULL, '', NULL, '', NULL, ''),
(150, NULL, 'XI', 'skills', 'Bahasa dan Sastra Indonesia', 1, '11.4.2', 'Menyajikan makalah', '', 75, NULL, '', NULL, '', NULL, ''),
(151, NULL, 'XI', 'skills', 'Bahasa dan Sastra Indonesia', 1, '11.4.3', 'Menyajikan laporan analisis jenis2 klausa', '', 75, NULL, '', NULL, '', NULL, ''),
(152, NULL, 'XI', 'skills', 'Bahasa dan Sastra Indonesia', 1, '11.4.4', 'Meringkas isi novel', '\n  Meringkas\n  isi novel  ', 75, NULL, '', NULL, '', NULL, ''),
(153, NULL, 'XI', 'skills', 'Bahasa dan Sastra Indonesia', 2, '11.4.5', 'Menyajikan identifikasi genre sastra', '\n  Menyajikan\n  identifikasi genre sastra  ', 75, NULL, '', NULL, '', NULL, ''),
(154, NULL, 'XI', 'skills', 'Bahasa dan Sastra Indonesia', 2, '11.4.6', 'Menyusun teks Acara, tawaran, janji & reservasi', '', 75, NULL, '', NULL, '', NULL, ''),
(155, NULL, 'XI', 'skills', 'Bahasa dan Sastra Indonesia', 2, '11.4.7', 'Mengungkapkan nilai2 dalam novel', '', 75, NULL, '', NULL, '', NULL, ''),
(156, NULL, 'XI', 'skills', 'Bahasa dan Sastra Indonesia', 2, '11.4.8', 'Mementaskan naskah drama', '', 75, NULL, '', NULL, '', NULL, ''),
(158, NULL, 'XII', 'cognitive', 'Bahasa dan Sastra Indonesia', 1, '12.3.1', 'Seminar dan atau diskusi panel', '', 75, NULL, '', NULL, '', NULL, ''),
(159, NULL, 'XII', 'cognitive', 'Bahasa dan Sastra Indonesia', 1, '12.3.2', 'Laporan pelaksanaan kegiatan sekolah', '', 75, NULL, '', NULL, '', NULL, ''),
(160, NULL, 'XII', 'cognitive', 'Bahasa dan Sastra Indonesia', 1, '12.3.3', 'Kohesi & koherensi dalam artikel ilmiah', '', 75, NULL, '', NULL, '', NULL, ''),
(161, NULL, 'XII', 'cognitive', 'Bahasa dan Sastra Indonesia', 1, '12.3.4', 'Unsur kebahasaan novel', '', 75, NULL, '', NULL, '', NULL, ''),
(162, NULL, 'XII', 'cognitive', 'Bahasa dan Sastra Indonesia', 2, '12.3.5', 'Kalimat dalam ragam bahasa', '', 75, NULL, '', NULL, '', NULL, ''),
(163, NULL, 'XII', 'cognitive', 'Bahasa dan Sastra Indonesia', 2, '12.3.6', 'Unsur fisik & batin puisi terjemahan', '', 75, NULL, '', NULL, '', NULL, ''),
(164, NULL, 'XII', 'cognitive', 'Bahasa dan Sastra Indonesia', 2, '12.3.7', 'Naskah sastra Melayu Klasik', '', 75, NULL, '', NULL, '', NULL, ''),
(165, NULL, 'XII', 'cognitive', 'Bahasa dan Sastra Indonesia', 2, '12.3.8', 'Isi & unsur buku nonfiksi', '', 75, NULL, '', NULL, '', NULL, ''),
(166, NULL, 'XII', 'skills', 'Bahasa dan Sastra Indonesia', 1, '12.4.1', 'Mempresentasikan makalah', '', 75, NULL, '', NULL, '', NULL, ''),
(167, NULL, 'XII', 'skills', 'Bahasa dan Sastra Indonesia', 1, '12.4.2', 'Menyusun laporan kegiatan sekolah', '\n  Menyusun\n  laporan kegiatan sekolah  ', 75, NULL, '', NULL, '', NULL, ''),
(168, NULL, 'XII', 'skills', 'Bahasa dan Sastra Indonesia', 1, '12.4.3', 'Menyusun artikel ilmiah', '', 75, NULL, '', NULL, '', NULL, ''),
(169, NULL, 'XII', 'skills', 'Bahasa dan Sastra Indonesia', 1, '12.4.4', 'Menyajikan ulasan kebahasaan novel', '', 75, NULL, '', NULL, '', NULL, ''),
(170, NULL, 'XII', 'skills', 'Bahasa dan Sastra Indonesia', 2, '12.4.5', 'Menyajikan teks dengan ragam bahasa', '', 75, NULL, '', NULL, '', NULL, ''),
(171, NULL, 'XII', 'skills', 'Bahasa dan Sastra Indonesia', 2, '12.4.6', 'Mengalihwahanakan puisi terjemahan ke prosa', '', 75, NULL, '', NULL, '', NULL, ''),
(172, NULL, 'XII', 'skills', 'Bahasa dan Sastra Indonesia', 2, '12.4.7', 'Mengalihwahanakan puisi terjemahan ke prosa', '', 75, NULL, '', NULL, '', NULL, ''),
(173, NULL, 'XII', 'skills', 'Bahasa dan Sastra Indonesia', 2, '12.4.8', 'Menulis laporan tentang buku nonfiksi', '', 75, NULL, '', NULL, '', NULL, ''),
(174, NULL, 'X', 'cognitive', 'Biologi', 1, '10.3.1', 'Ruang Lingkup Biologi', '', 75, NULL, '', NULL, '', NULL, ''),
(175, NULL, 'X', 'cognitive', 'Biologi', 1, '10.3.2', 'Keanekaragaman Hayati', '', 75, NULL, '', NULL, '', NULL, ''),
(176, NULL, 'X', 'cognitive', 'Biologi', 1, '10.3.3', 'Klasifikasi Makhluk Hidup', '', 75, NULL, '', NULL, '', NULL, ''),
(177, NULL, 'X', 'cognitive', 'Biologi', 1, '10.3.4', 'Klasifikasi Makhluk Hidup', '', 75, NULL, '', NULL, '', NULL, ''),
(178, NULL, 'X', 'cognitive', 'Biologi', 1, '10.3.5', 'Kingdom Monera', '', 75, NULL, '', NULL, '', NULL, ''),
(179, NULL, 'X', 'cognitive', 'Biologi', 1, '10.3.6', 'Kingdom Protista', '', 75, NULL, '', NULL, '', NULL, ''),
(180, NULL, 'X', 'cognitive', 'Biologi', 2, '10.3.7', 'Fungi/Jamur', '', 75, NULL, '', NULL, '', NULL, ''),
(181, NULL, 'X', 'cognitive', 'Biologi', 2, '10.3.8', 'Plantae', '', 75, NULL, '', NULL, '', NULL, ''),
(182, NULL, 'X', 'cognitive', 'Biologi', 2, '10.3.9', 'Plantae', '', 75, NULL, '', NULL, '', NULL, ''),
(183, NULL, 'X', 'cognitive', 'Biologi', 2, '10.3.10', 'Ekologi', '', 75, NULL, '', NULL, '', NULL, ''),
(184, NULL, 'X', 'cognitive', 'Biologi', 2, '10.3.11', 'Perubahan Lingkungan', '', 75, NULL, '', NULL, '', NULL, ''),
(185, NULL, 'X', 'skills', 'Biologi', 1, '10.4.1', 'Menyajikan penerapan metode ilmiah', '', 75, NULL, '', NULL, '', NULL, ''),
(186, NULL, 'X', 'skills', 'Biologi', 1, '10.4.2', 'Menyajikan observasi keanekaragaman hayati', '', 75, NULL, '', NULL, '', NULL, ''),
(187, NULL, 'X', 'skills', 'Biologi', 1, '10.4.3', 'Menyusun kladogram', '', 75, NULL, '', NULL, '', NULL, ''),
(188, NULL, 'X', 'skills', 'Biologi', 1, '10.4.4', 'Melakukan kampanye tentang bahaya virus', '', 75, NULL, '', NULL, '', NULL, ''),
(189, NULL, 'X', 'skills', 'Biologi', 1, '10.4.5', 'Menyajikan data tentang bakteri', '', 75, NULL, '', NULL, '', NULL, ''),
(190, NULL, 'X', 'skills', 'Biologi', 1, '10.4.6', 'Menyajikan laporan peran protista', '', 75, NULL, '', NULL, '', NULL, ''),
(191, NULL, 'X', 'skills', 'Biologi', 2, '10.4.7', 'Menyajikan laporan tentang jamur', '', 75, NULL, '', NULL, '', NULL, ''),
(192, NULL, 'X', 'skills', 'Biologi', 2, '10.4.8', 'Menyajikan pengamatan fenetik & filogenetik', '\n  Menyajikan\n  pengamatan fenetik & filogenetik  ', 75, NULL, '', NULL, '', NULL, ''),
(193, NULL, 'X', 'skills', 'Biologi', 2, '10.4.9', 'Menyajikan laporan penyusun tubuh hewan', '', 75, NULL, '', NULL, '', NULL, ''),
(194, NULL, 'X', 'skills', 'Biologi', 2, '10.4.10', 'Mengungkapkan naskah sastra Melayu Klasik', '', 75, NULL, '', NULL, '', NULL, ''),
(195, NULL, 'X', 'skills', 'Biologi', 2, '10.4.11', 'Merumuskan gagasan perubahan lingkungan', '\n  Merumuskan\n  gagasan perubahan lingkungan  ', 75, NULL, '', NULL, '', NULL, ''),
(203, NULL, 'XI', 'skills', 'Biologi', 2, '11.3.8', 'Struktur dan Fungsi Sel pada Sistem Pernapasan', '', 75, NULL, '', NULL, '', NULL, ''),
(204, NULL, 'XI', 'skills', 'Biologi', 2, '11.3.9', 'Struktur Sel pada Sistem  Ekskresi Manusia', '', 75, NULL, '', NULL, '', NULL, ''),
(205, NULL, 'XI', 'skills', 'Biologi', 2, '11.3.10', 'Struktur dan Fungsi Sel pada Sistem Regulasi', '', 75, NULL, '', NULL, '', NULL, ''),
(206, NULL, 'XI', 'skills', 'Biologi', 2, '11.3.11', 'Bahan psikotropika', '', 75, NULL, '', NULL, '', NULL, ''),
(207, NULL, 'XI', 'skills', 'Biologi', 2, '11.3.12', 'Struktur dan Fungsi Sel pada Sistem Reproduksi', '', 75, NULL, '', NULL, '', NULL, ''),
(208, NULL, 'XI', 'skills', 'Biologi', 2, '11.3.13', 'ASI eksklusif dalam program KB', '', 75, NULL, '', NULL, '', NULL, ''),
(209, NULL, 'XI', 'skills', 'Biologi', 2, '11.3.14', 'Struktur Sel pada Sistem Pertahanan Tubuh', '\n  Struktur\n  Sel pada Sistem Pertahanan Tubuh  ', 75, NULL, '', NULL, '', NULL, ''),
(210, NULL, 'XI', 'cognitive', 'Biologi', 1, '11.3.1', 'Sel', '', 75, NULL, '', NULL, '', NULL, ''),
(211, NULL, 'XI', 'cognitive', 'Biologi', 1, '11.3.2', 'Bioproses pada sel', '', 75, NULL, '', NULL, '', NULL, ''),
(212, NULL, 'XI', 'cognitive', 'Biologi', 1, '11.3.3', 'Makalah', '', 75, NULL, '', NULL, '', NULL, ''),
(213, NULL, 'XI', 'cognitive', 'Biologi', 1, '11.3.4', 'Struktur dan Fungsi Jaringan pada Hewan', '', 75, NULL, '', NULL, '', NULL, ''),
(214, NULL, 'XI', 'cognitive', 'Biologi', 1, '11.3.5', 'Struktur dan Fungsi Tulang, Otot, dan Sendi', '', 75, NULL, '', NULL, '', NULL, ''),
(215, NULL, 'XI', 'cognitive', 'Biologi', 1, '11.3.6', 'Struktur dan Fungsi  Sistem Peredaran Darah', '', 75, NULL, '', NULL, '', NULL, ''),
(216, NULL, 'XI', 'cognitive', 'Biologi', 1, '11.3.7', 'Struktur dan Fungsi Sel pada Sistem Pencernaan', '', 75, NULL, '', NULL, '', NULL, ''),
(217, NULL, 'XI', 'cognitive', 'Biologi', 2, '11.3.8', 'Struktur dan Fungsi Sel pada Sistem Pernapasan', '', 75, NULL, '', NULL, '', NULL, ''),
(218, NULL, 'XI', 'cognitive', 'Biologi', 2, '11.3.9', 'Struktur Sel pada Sistem  Ekskresi Manusia', '\n  Struktur\n  Sel pada Sistem  Ekskresi Manusia  ', 75, NULL, '', NULL, '', NULL, ''),
(219, NULL, 'XI', 'cognitive', 'Biologi', 2, '11.3.10', 'Struktur dan Fungsi Sel pada Sistem Regulasi', '', 75, NULL, '', NULL, '', NULL, ''),
(220, NULL, 'XI', 'cognitive', 'Biologi', 2, '11.3.11', 'Bahan psikotropika', '', 75, NULL, '', NULL, '', NULL, ''),
(221, NULL, 'XI', 'cognitive', 'Biologi', 2, '11.3.12', 'Struktur dan Fungsi Sel pada Sistem Reproduksi', '', 75, NULL, '', NULL, '', NULL, ''),
(222, NULL, 'XI', 'cognitive', 'Biologi', 2, '11.3.13', 'ASI eksklusif dalam program KB', '', 75, NULL, '', NULL, '', NULL, ''),
(223, NULL, 'XI', 'cognitive', 'Biologi', 2, '11.3.14', 'Struktur Sel pada Sistem Pertahanan Tubuh', '\n  Struktur\n  Sel pada Sistem Pertahanan Tubuh  ', 75, NULL, '', NULL, '', NULL, ''),
(224, NULL, 'XI', 'skills', 'Biologi', 1, '11.4.1', 'Menyajikan pengamatan mikroskopik sel', '', 75, NULL, '', NULL, '', NULL, ''),
(225, NULL, 'XI', 'skills', 'Biologi', 1, '11.4.2', 'Membuat model bioproses sel', '', 75, NULL, '', NULL, '', NULL, ''),
(226, NULL, 'XI', 'skills', 'Biologi', 2, '11.4.2', 'Membuat model bioproses sel', '', 75, NULL, '', NULL, '', NULL, ''),
(227, NULL, 'XI', 'skills', 'Biologi', 1, '11.4.3', 'Menyajikan pengamatan jaringan tumbuhan', '', 75, NULL, '', NULL, '', NULL, ''),
(228, NULL, 'XI', 'skills', 'Biologi', 1, '11.4.4', 'Menyajikan pengamatan jaringan hewan', '', 75, NULL, '', NULL, '', NULL, ''),
(229, NULL, 'XI', 'skills', 'Biologi', 1, '11.4.5', 'Menyajikan karya pemanfaatan teknologi', '', 75, NULL, '', NULL, '', NULL, ''),
(239, NULL, 'XI', 'cognitive', 'Komputer', 1, '12.3.1', 'Merakit/memrogram piranti sederhana', 'Merakit/memrogram piranti sederhana', 75, NULL, '', NULL, '', NULL, ''),
(240, NULL, 'XI', 'cognitive', 'Komputer', 1, '11.3.2.1', 'Topologi jaringan', '', 75, NULL, '', NULL, '', NULL, ''),
(241, NULL, 'XI', 'cognitive', 'Komputer', 1, '11.3.2.2', 'Keamanan jaringan & perangkat', 'Keamanan jaringan & perangkat', 75, NULL, '', NULL, '', NULL, ''),
(242, NULL, 'XI', 'cognitive', 'Komputer', 1, '12.3.3', 'Data kompleks & dapat didekomposisi', '\n  Data\n  kompleks & dapat didekomposisi  ', 75, NULL, '', NULL, '', NULL, ''),
(243, NULL, 'XI', 'cognitive', 'Komputer', 1, '12.3.4', 'Organisasi & penyimpanannya', 'Organisasi & penyimpanannya', 75, NULL, '', NULL, '', NULL, ''),
(244, NULL, 'XI', 'cognitive', 'Komputer', 1, '11.3.5', 'Prediksi data tergantung pada model', '', 75, NULL, '', NULL, '', NULL, ''),
(245, NULL, 'XI', 'cognitive', 'Komputer', 1, '11.3.6.1', 'Modularisasi dalam penulisan program', '', 75, NULL, '', NULL, '', NULL, ''),
(246, NULL, 'XI', 'cognitive', 'Komputer', 1, '11.3.6.2', 'Proses standard (search, sort)', '', 75, NULL, '', NULL, '', NULL, ''),
(247, NULL, 'XI', 'cognitive', 'Komputer', 2, '12.3.7', 'Algoritma2 standar berdasar konsep AI', 'Algoritma2 standar berdasar konsep AI', 75, NULL, '', NULL, '', NULL, ''),
(248, NULL, 'XI', 'cognitive', 'Komputer', 2, '11.3.8.1', 'Mengetahui HaKI perangkat TIK', '', 75, NULL, '', NULL, '', NULL, ''),
(249, NULL, 'XI', 'cognitive', 'Komputer', 2, '11.3.8.2', 'Berbagai lisensi komponen perangkat', '\n  Berbagai\n  lisensi komponen perangkat  ', 75, NULL, '', NULL, '', NULL, ''),
(250, NULL, 'XI', 'cognitive', 'Komputer', 2, '11.3.9', 'Aspek ekonomi & bisnis dari Haki', '', 75, NULL, '', NULL, '', NULL, ''),
(251, NULL, 'XI', 'cognitive', 'Komputer', 2, '11.3.10', 'Computational Thinking', '', 75, NULL, '', NULL, '', NULL, ''),
(252, NULL, 'XI', 'cognitive', 'Komputer', 2, '11.3.11', 'Cross-Cut Component, Capstone', '', 75, NULL, '', NULL, '', NULL, ''),
(253, NULL, 'XI', 'skills', 'Komputer', 1, '11.4.1', 'Cross-Cut Component, Capstone', '', 75, NULL, '', NULL, '', NULL, ''),
(254, NULL, 'XI', 'skills', 'Komputer', 1, '11.4.2', 'Melakukan setting koneksi ke jaringan', '', 75, NULL, '', NULL, '', NULL, ''),
(255, NULL, 'XI', 'skills', 'Komputer', 1, '11.4.3', 'Mengumpulkan data besar', 'Mengumpulkan data besar', 75, NULL, '', NULL, '', NULL, ''),
(256, NULL, 'XI', 'skills', 'Komputer', 1, '11.4.4', 'Mengolah data yang kompleks', '', 75, NULL, '', NULL, '', NULL, ''),
(257, NULL, 'XI', 'skills', 'Komputer', 1, '11.4.5', 'Memeriksa kesesuaian model & data', '', 75, NULL, '', NULL, '', NULL, ''),
(258, NULL, 'XI', 'skills', 'Komputer', 1, '11.4.6', 'Menulis program dengan fungsi & array', '', 75, NULL, '', NULL, '', NULL, ''),
(259, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.7.1', 'Melakukan pemecahan persoalan', 'Melakukan pemecahan persoalan', 75, NULL, '', NULL, '', NULL, ''),
(260, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.7.2', 'Melakukan pemecahan persoalan advance', 'Melakukan pemecahan persoalan advance', 75, NULL, '', NULL, '', NULL, ''),
(261, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.7.3', 'Mengevaluasi dan memilih algoritma', '', 75, NULL, '', NULL, '', NULL, ''),
(262, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.7.4', 'Mengenal beberapa algoritma software', 'Mengenal beberapa algoritma software', 75, NULL, '', NULL, '', NULL, ''),
(263, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.8', 'Mengidentifikasi lisensi perangkat lunak', '', 75, NULL, '', NULL, '', NULL, ''),
(264, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.9', 'Menjelaskan aspek ekonomi TIK', 'Menjelaskan aspek ekonomi TIK', 75, NULL, '', NULL, '', NULL, ''),
(265, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.10', 'Memecahkan persoalan kompleks', '', 75, NULL, '', NULL, '', NULL, ''),
(266, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.11.1', 'Membina budaya kerja tim inklusif', 'Membina budaya kerja tim inklusif', 75, NULL, '', NULL, '', NULL, ''),
(267, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.11.2', 'Mampu berkolaborasi dengan komputing', '', 75, NULL, '', NULL, '', NULL, ''),
(268, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.11.3', 'Mengenali pemecahan dengan komputer', 'Mengenali pemecahan dengan komputer', 75, NULL, '', NULL, '', NULL, ''),
(269, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.11.4', 'Menggunakan abstraksi', '', 75, NULL, '', NULL, '', NULL, ''),
(270, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.11.5', 'Mengembangkan program komputasi', '', 75, NULL, '', NULL, '', NULL, ''),
(271, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.11.6', 'Mengembangkan pengujian produk TIK', '', 75, NULL, '', NULL, '', NULL, ''),
(272, NULL, 'XI', 'skills', 'Komputer', 2, '11.4.11.7', 'Mempresentasikan solusi TIK', 'Mempresentasikan solusi TIK', 75, NULL, '', NULL, '', NULL, ''),
(273, NULL, 'XII', 'cognitive', 'Komputer', 1, '12.3.1', 'Kualitas program/source code', '', 75, NULL, '', NULL, '', NULL, ''),
(274, NULL, 'XII', 'cognitive', 'Komputer', 1, '12.3.2', 'Test case & pengujian program', '', 75, NULL, '', NULL, '', NULL, ''),
(275, NULL, 'XII', 'cognitive', 'Komputer', 1, '12.3.3', 'Aspek legal dari TIK', '', 75, NULL, '', NULL, '', NULL, ''),
(276, NULL, 'XII', 'cognitive', 'Komputer', 1, '12.3.4', 'Hukum dan etik internasional', '', 75, NULL, '', NULL, '', NULL, ''),
(277, NULL, 'XII', 'cognitive', 'Komputer', 2, '12.3.5', 'Manfaat TIK & Informatika', '', 75, NULL, '', NULL, '', NULL, ''),
(278, NULL, 'XII', 'cognitive', 'Komputer', 2, '12.3.6', 'Computational Thinking menyelesaikan persoalan', '', 75, NULL, '', NULL, '', NULL, ''),
(279, NULL, 'XII', 'cognitive', 'Komputer', 2, '12.3.7', 'Cross-Cut Component, Capstone', '', 75, NULL, '', NULL, '', NULL, ''),
(280, NULL, 'XII', 'skills', 'Komputer', 2, '12.4.5', 'Menjelaskan manfaat TIK & Informatika', 'Menjelaskan manfaat TIK & Informatika', 75, NULL, '', NULL, '', NULL, ''),
(281, NULL, 'XII', 'skills', 'Komputer', 2, '12.4.6', 'Memecahkan soal kompleks & solusinya', 'Memecahkan soal kompleks & solusinya', 75, NULL, '', NULL, '', NULL, ''),
(282, NULL, 'XII', 'skills', 'Komputer', 2, '12.4.7.1', 'Membina budaya kerja tim inklusif', '', 75, NULL, '', NULL, '', NULL, ''),
(283, NULL, 'XII', 'skills', 'Komputer', 2, '12.4.7.2', 'Mampu berkolaborasi dalam file sharing', '', 75, NULL, '', NULL, '', NULL, ''),
(284, NULL, 'XII', 'skills', 'Komputer', 2, '12.4.7.3', 'Mengenali pemecahan soal dengan komputer', 'Mengenali pemecahan soal dengan komputer', 75, NULL, '', NULL, '', NULL, ''),
(285, NULL, 'XII', 'skills', 'Komputer', 2, '12.4.7.4', 'Mengembangkan abstraksi', '', 75, NULL, '', NULL, '', NULL, ''),
(286, NULL, 'XII', 'skills', 'Komputer', 2, '12.4.7.5', 'Melakukan tailoring/aplikasi', '', 75, NULL, '', NULL, '', NULL, ''),
(287, NULL, 'XII', 'skills', 'Komputer', 2, '12.4.7.6', 'Menguji artefak Komputasional', 'Menguji artefak Komputasional', 75, NULL, '', NULL, '', NULL, ''),
(288, NULL, 'XII', 'skills', 'Komputer', 2, '12.4.7.7', 'Mempresentasikan solusi TIK', 'Mempresentasikan solusi TIK', 75, NULL, '', NULL, '', NULL, ''),
(289, NULL, 'XII', 'skills', 'Komputer', 1, '12.4.1', 'Melakukan modifikasi program', '', 75, NULL, '', NULL, '', NULL, ''),
(290, NULL, 'XII', 'skills', 'Komputer', 1, '12.4.2', 'Bekerja dalam tim menguji program', '', 75, NULL, '', NULL, '', NULL, ''),
(291, NULL, 'XII', 'skills', 'Komputer', 1, '12.4.3', 'Menjelaskan aspek legal TIK', '', 75, NULL, '', NULL, '', NULL, ''),
(292, NULL, 'XII', 'skills', 'Komputer', 1, '12.4.4', 'Menjelaskan hukum dan etik internasional', '', 75, NULL, '', NULL, '', NULL, '');

-- --------------------------------------------------------

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
-- Dumping data untuk tabel `tbl_05_subject_weight`
--

INSERT INTO `tbl_05_subject_weight` (`CtrlNo`, `Degree`, `Class`, `SubjName`, `KDWeight`, `KDWeight_SK`, `MidWeight`, `FinalWeight`, `Absent`) VALUES
(1, 'SMA', 'XI IPA (A)', 'Matematika', 40, 100, 20, 30, 10),
(2, 'SMA', 'X IPA (A)', 'Matematika', 40, 100, 20, 30, 10),
(3, 'SMA', 'X IPS (A)', 'Matematika', 40, 100, 20, 30, 10),
(4, 'SMA', 'XII IPA (A)', 'Matematika', 40, 100, 20, 30, 10),
(5, 'SMA', 'XII IPS (A)', 'Matematika', 40, 100, 20, 30, 10),
(6, 'SMA', 'XI IPS (A)', 'Matematika', 40, 100, 20, 30, 10),
(7, 'SMA', 'XI IPA (A)', 'IPA', 40, 100, 20, 30, 10),
(8, 'SMA', 'X IPA (A)', 'IPA', 40, 100, 20, 30, 10),
(9, 'SMA', 'X IPS (A)', 'IPA', 40, 100, 20, 30, 10),
(10, 'SMA', 'XII IPA (A)', 'IPA', 40, 100, 20, 30, 10),
(11, 'SMA', 'XII IPS (A)', 'IPA', 40, 100, 20, 30, 10),
(12, 'SMA', 'XI IPS (A)', 'IPA', 40, 100, 20, 30, 10),
(13, 'SMA', 'XI IPA (A)', 'IPS', 40, 100, 20, 30, 10),
(14, 'SMA', 'X IPA (A)', 'IPS', 40, 100, 20, 30, 10),
(15, 'SMA', 'X IPS (A)', 'IPS', 40, 100, 20, 30, 10),
(16, 'SMA', 'XII IPA (A)', 'IPS', 40, 100, 20, 30, 10),
(17, 'SMA', 'XII IPS (A)', 'IPS', 40, 100, 20, 30, 10),
(18, 'SMA', 'XI IPS (A)', 'IPS', 40, 100, 20, 30, 10),
(19, 'SMA', 'XI IPA (A)', 'Komputer', 40, 100, 20, 30, 10),
(20, 'SMA', 'X IPA (A)', 'Komputer', 40, 100, 20, 30, 10),
(21, 'SMA', 'X IPS (A)', 'Komputer', 40, 100, 20, 30, 10),
(22, 'SMA', 'XII IPA (A)', 'Komputer', 40, 100, 20, 30, 10),
(23, 'SMA', 'XII IPS (A)', 'Komputer', 40, 100, 20, 30, 10),
(24, 'SMA', 'XI IPS (A)', 'Komputer', 40, 100, 20, 30, 10),
(25, 'SMA', 'XI IPA (A)', 'Penjas', 40, 100, 20, 30, 10),
(26, 'SMA', 'X IPA (A)', 'Penjas', 40, 100, 20, 30, 10),
(27, 'SMA', 'X IPS (A)', 'Penjas', 40, 100, 20, 30, 10),
(28, 'SMA', 'XII IPA (A)', 'Penjas', 40, 100, 20, 30, 10),
(29, 'SMA', 'XII IPS (A)', 'Penjas', 40, 100, 20, 30, 10),
(30, 'SMA', 'XI IPS (A)', 'Penjas', 40, 100, 20, 30, 10),
(31, 'SMA', 'XI IPA (A)', 'Pendidikan Agama', 40, 100, 20, 30, 10),
(32, 'SMA', 'X IPA (A)', 'Pendidikan Agama', 40, 100, 20, 30, 10),
(33, 'SMA', 'X IPS (A)', 'Pendidikan Agama', 40, 100, 20, 30, 10),
(34, 'SMA', 'XII IPA (A)', 'Pendidikan Agama', 40, 100, 20, 30, 10),
(35, 'SMA', 'XII IPS (A)', 'Pendidikan Agama', 40, 100, 20, 30, 10),
(36, 'SMA', 'XI IPS (A)', 'Pendidikan Agama', 40, 100, 20, 30, 10),
(37, 'SMA', 'XI IPA (A)', 'Fisika', 40, 100, 20, 30, 10),
(38, 'SMA', 'X IPA (A)', 'Fisika', 40, 100, 20, 30, 10),
(39, 'SMA', 'X IPS (A)', 'Fisika', 40, 100, 20, 30, 10),
(40, 'SMA', 'XII IPA (A)', 'Fisika', 40, 100, 20, 30, 10),
(41, 'SMA', 'XII IPS (A)', 'Fisika', 40, 100, 20, 30, 10),
(42, 'SMA', 'XI IPS (A)', 'Fisika', 40, 100, 20, 30, 10),
(43, 'SMA', 'XI IPA (A)', 'Biologi', 40, 100, 20, 30, 10),
(44, 'SMA', 'X IPA (A)', 'Biologi', 40, 100, 20, 30, 10),
(45, 'SMA', 'X IPS (A)', 'Biologi', 40, 100, 20, 30, 10),
(46, 'SMA', 'XII IPA (A)', 'Biologi', 40, 100, 20, 30, 10),
(47, 'SMA', 'XII IPS (A)', 'Biologi', 40, 100, 20, 30, 10),
(48, 'SMA', 'XI IPS (A)', 'Biologi', 40, 100, 20, 30, 10),
(49, 'SMA', 'XI IPA (A)', 'Kimia', 40, 100, 20, 30, 10),
(50, 'SMA', 'X IPA (A)', 'Kimia', 40, 100, 20, 30, 10),
(51, 'SMA', 'X IPS (A)', 'Kimia', 40, 100, 20, 30, 10),
(52, 'SMA', 'XII IPA (A)', 'Kimia', 40, 100, 20, 30, 10),
(53, 'SMA', 'XII IPS (A)', 'Kimia', 40, 100, 20, 30, 10),
(54, 'SMA', 'XI IPS (A)', 'Kimia', 40, 100, 20, 30, 10),
(55, 'SMA', 'XI IPA (A)', 'Sosiologi', 40, 100, 20, 30, 10),
(56, 'SMA', 'X IPA (A)', 'Sosiologi', 40, 100, 20, 30, 10),
(57, 'SMA', 'X IPS (A)', 'Sosiologi', 40, 100, 20, 30, 10),
(58, 'SMA', 'XII IPA (A)', 'Sosiologi', 40, 100, 20, 30, 10),
(59, 'SMA', 'XII IPS (A)', 'Sosiologi', 40, 100, 20, 30, 10),
(60, 'SMA', 'XI IPS (A)', 'Sosiologi', 40, 100, 20, 30, 10),
(61, 'SMA', 'XI IPA (A)', 'Ekonomi', 40, 100, 20, 30, 10),
(62, 'SMA', 'X IPA (A)', 'Ekonomi', 40, 100, 20, 30, 10),
(63, 'SMA', 'X IPS (A)', 'Ekonomi', 40, 100, 20, 30, 10),
(64, 'SMA', 'XII IPA (A)', 'Ekonomi', 40, 100, 20, 30, 10),
(65, 'SMA', 'XII IPS (A)', 'Ekonomi', 40, 100, 20, 30, 10),
(66, 'SMA', 'XI IPS (A)', 'Ekonomi', 40, 100, 20, 30, 10),
(67, 'SMA', 'XI IPA (A)', 'Sejarah', 40, 100, 20, 30, 10),
(68, 'SMA', 'X IPA (A)', 'Sejarah', 40, 100, 20, 30, 10),
(69, 'SMA', 'X IPS (A)', 'Sejarah', 40, 100, 20, 30, 10),
(70, 'SMA', 'XII IPA (A)', 'Sejarah', 40, 100, 20, 30, 10),
(71, 'SMA', 'XII IPS (A)', 'Sejarah', 40, 100, 20, 30, 10),
(72, 'SMA', 'XI IPS (A)', 'Sejarah', 40, 100, 20, 30, 10),
(73, 'SMA', 'XI IPA (A)', 'PKN', 40, 100, 20, 30, 10),
(74, 'SMA', 'X IPA (A)', 'PKN', 40, 100, 20, 30, 10),
(75, 'SMA', 'X IPS (A)', 'PKN', 40, 100, 20, 30, 10),
(76, 'SMA', 'XII IPA (A)', 'PKN', 40, 100, 20, 30, 10),
(77, 'SMA', 'XII IPS (A)', 'PKN', 40, 100, 20, 30, 10),
(78, 'SMA', 'XI IPS (A)', 'PKN', 40, 100, 20, 30, 10),
(79, 'SMA', 'XI IPA (A)', 'Mulok', 40, 100, 20, 30, 10),
(80, 'SMA', 'X IPA (A)', 'Mulok', 40, 100, 20, 30, 10),
(81, 'SMA', 'X IPS (A)', 'Mulok', 40, 100, 20, 30, 10),
(82, 'SMA', 'XII IPA (A)', 'Mulok', 40, 100, 20, 30, 10),
(83, 'SMA', 'XII IPS (A)', 'Mulok', 40, 100, 20, 30, 10),
(84, 'SMA', 'XI IPS (A)', 'Mulok', 40, 100, 20, 30, 10),
(85, 'SMA', 'XI IPA (A)', 'Bahasa dan Sastra Indonesia', 40, 100, 20, 30, 10),
(86, 'SMA', 'X IPA (A)', 'Bahasa dan Sastra Indonesia', 40, 100, 20, 30, 10),
(87, 'SMA', 'X IPS (A)', 'Bahasa dan Sastra Indonesia', 40, 100, 20, 30, 10),
(88, 'SMA', 'XII IPA (A)', 'Bahasa dan Sastra Indonesia', 40, 100, 20, 30, 10),
(89, 'SMA', 'XII IPS (A)', 'Bahasa dan Sastra Indonesia', 40, 100, 20, 30, 10),
(90, 'SMA', 'XI IPS (A)', 'Bahasa dan Sastra Indonesia', 40, 100, 20, 30, 10),
(91, 'SMA', 'XI IPA (A)', 'Bahasa Inggris', 40, 100, 20, 30, 10),
(92, 'SMA', 'X IPA (A)', 'Bahasa Inggris', 40, 100, 20, 30, 10),
(93, 'SMA', 'X IPS (A)', 'Bahasa Inggris', 40, 100, 20, 30, 10),
(94, 'SMA', 'XII IPA (A)', 'Bahasa Inggris', 40, 100, 20, 30, 10),
(95, 'SMA', 'XII IPS (A)', 'Bahasa Inggris', 40, 100, 20, 30, 10),
(96, 'SMA', 'XI IPS (A)', 'Bahasa Inggris', 40, 100, 20, 30, 10),
(97, 'SMA', 'XI IPA (A)', 'Seni Budaya', 40, 100, 20, 30, 10),
(98, 'SMA', 'X IPA (A)', 'Seni Budaya', 40, 100, 20, 30, 10),
(99, 'SMA', 'X IPS (A)', 'Seni Budaya', 40, 100, 20, 30, 10),
(100, 'SMA', 'XII IPA (A)', 'Seni Budaya', 40, 100, 20, 30, 10),
(101, 'SMA', 'XII IPS (A)', 'Seni Budaya', 40, 100, 20, 30, 10),
(102, 'SMA', 'XI IPS (A)', 'Seni Budaya', 40, 100, 20, 30, 10),
(103, 'SMA', 'XI IPA (A)', 'Anthropologi', 40, 100, 20, 30, 10),
(104, 'SMA', 'X IPA (A)', 'Anthropologi', 40, 100, 20, 30, 10),
(105, 'SMA', 'X IPS (A)', 'Anthropologi', 40, 100, 20, 30, 10),
(106, 'SMA', 'XII IPA (A)', 'Anthropologi', 40, 100, 20, 30, 10),
(107, 'SMA', 'XII IPS (A)', 'Anthropologi', 40, 100, 20, 30, 10),
(108, 'SMA', 'XI IPS (A)', 'Anthropologi', 40, 100, 20, 30, 10),
(109, 'SMA', 'XI IPA (A)', 'Geografi', 40, 100, 20, 30, 10),
(110, 'SMA', 'X IPA (A)', 'Geografi', 40, 100, 20, 30, 10),
(111, 'SMA', 'X IPS (A)', 'Geografi', 40, 100, 20, 30, 10),
(112, 'SMA', 'XII IPA (A)', 'Geografi', 40, 100, 20, 30, 10),
(113, 'SMA', 'XII IPS (A)', 'Geografi', 40, 100, 20, 30, 10),
(114, 'SMA', 'XI IPS (A)', 'Geografi', 40, 100, 20, 30, 10),
(115, 'SMA', 'XI IPA (A)', 'Sign Language', 40, 100, 20, 30, 10),
(116, 'SMA', 'X IPA (A)', 'Sign Language', 40, 100, 20, 30, 10),
(117, 'SMA', 'X IPS (A)', 'Sign Language', 40, 100, 20, 30, 10),
(118, 'SMA', 'XII IPA (A)', 'Sign Language', 40, 100, 20, 30, 10),
(119, 'SMA', 'XII IPS (A)', 'Sign Language', 40, 100, 20, 30, 10),
(120, 'SMA', 'XI IPS (A)', 'Sign Language', 40, 100, 20, 30, 10),
(121, 'SMA', 'XI IPA (A)', 'Carpentry', 40, 100, 20, 30, 10),
(122, 'SMA', 'X IPA (A)', 'Carpentry', 40, 100, 20, 30, 10),
(123, 'SMA', 'X IPS (A)', 'Carpentry', 40, 100, 20, 30, 10),
(124, 'SMA', 'XII IPA (A)', 'Carpentry', 40, 100, 20, 30, 10),
(125, 'SMA', 'XII IPS (A)', 'Carpentry', 40, 100, 20, 30, 10),
(126, 'SMA', 'XI IPS (A)', 'Carpentry', 40, 100, 20, 30, 10),
(127, 'SMA', 'XI IPA (A)', 'Basketball', 40, 100, 20, 30, 10),
(128, 'SMA', 'X IPA (A)', 'Basketball', 40, 100, 20, 30, 10),
(129, 'SMA', 'X IPS (A)', 'Basketball', 40, 100, 20, 30, 10),
(130, 'SMA', 'XII IPA (A)', 'Basketball', 40, 100, 20, 30, 10),
(131, 'SMA', 'XII IPS (A)', 'Basketball', 40, 100, 20, 30, 10),
(132, 'SMA', 'XI IPS (A)', 'Basketball', 40, 100, 20, 30, 10),
(133, 'SMA', 'XI IPA (A)', 'Flower Culture', 40, 100, 20, 30, 10),
(134, 'SMA', 'X IPA (A)', 'Flower Culture', 40, 100, 20, 30, 10),
(135, 'SMA', 'X IPS (A)', 'Flower Culture', 40, 100, 20, 30, 10),
(136, 'SMA', 'XII IPA (A)', 'Flower Culture', 40, 100, 20, 30, 10),
(137, 'SMA', 'XII IPS (A)', 'Flower Culture', 40, 100, 20, 30, 10),
(138, 'SMA', 'XI IPS (A)', 'Flower Culture', 40, 100, 20, 30, 10),
(139, 'SMA', 'XI IPA (A)', 'Choir', 40, 100, 20, 30, 10),
(140, 'SMA', 'X IPA (A)', 'Choir', 40, 100, 20, 30, 10),
(141, 'SMA', 'X IPS (A)', 'Choir', 40, 100, 20, 30, 10),
(142, 'SMA', 'XII IPA (A)', 'Choir', 40, 100, 20, 30, 10),
(143, 'SMA', 'XII IPS (A)', 'Choir', 40, 100, 20, 30, 10),
(144, 'SMA', 'XI IPS (A)', 'Choir', 40, 100, 20, 30, 10),
(145, 'SMA', 'XI IPA (A)', 'Office Machine', 40, 100, 20, 30, 10),
(146, 'SMA', 'X IPA (A)', 'Office Machine', 40, 100, 20, 30, 10),
(147, 'SMA', 'X IPS (A)', 'Office Machine', 40, 100, 20, 30, 10),
(148, 'SMA', 'XII IPA (A)', 'Office Machine', 40, 100, 20, 30, 10),
(149, 'SMA', 'XII IPS (A)', 'Office Machine', 40, 100, 20, 30, 10),
(150, 'SMA', 'XI IPS (A)', 'Office Machine', 40, 100, 20, 30, 10),
(151, 'SMA', 'XI IPA (A)', 'Angklung', 40, 100, 20, 30, 10),
(152, 'SMA', 'X IPA (A)', 'Angklung', 40, 100, 20, 30, 10),
(153, 'SMA', 'X IPS (A)', 'Angklung', 40, 100, 20, 30, 10),
(154, 'SMA', 'XII IPA (A)', 'Angklung', 40, 100, 20, 30, 10),
(155, 'SMA', 'XII IPS (A)', 'Angklung', 40, 100, 20, 30, 10),
(156, 'SMA', 'XI IPS (A)', 'Angklung', 40, 100, 20, 30, 10),
(157, 'SMA', 'XI IPA (A)', 'Christian Drama', 40, 100, 20, 30, 10),
(158, 'SMA', 'X IPA (A)', 'Christian Drama', 40, 100, 20, 30, 10),
(159, 'SMA', 'X IPS (A)', 'Christian Drama', 40, 100, 20, 30, 10),
(160, 'SMA', 'XII IPA (A)', 'Christian Drama', 40, 100, 20, 30, 10),
(161, 'SMA', 'XII IPS (A)', 'Christian Drama', 40, 100, 20, 30, 10),
(162, 'SMA', 'XI IPS (A)', 'Christian Drama', 40, 100, 20, 30, 10),
(163, 'SMA', 'XI IPA (A)', 'Cultural Dance', 40, 100, 20, 30, 10),
(164, 'SMA', 'X IPA (A)', 'Cultural Dance', 40, 100, 20, 30, 10),
(165, 'SMA', 'X IPS (A)', 'Cultural Dance', 40, 100, 20, 30, 10),
(166, 'SMA', 'XII IPA (A)', 'Cultural Dance', 40, 100, 20, 30, 10),
(167, 'SMA', 'XII IPS (A)', 'Cultural Dance', 40, 100, 20, 30, 10),
(168, 'SMA', 'XI IPS (A)', 'Cultural Dance', 40, 100, 20, 30, 10),
(169, 'SMA', 'XI IPA (A)', 'Marching & Drilling', 40, 100, 20, 30, 10),
(170, 'SMA', 'X IPA (A)', 'Marching & Drilling', 40, 100, 20, 30, 10),
(171, 'SMA', 'X IPS (A)', 'Marching & Drilling', 40, 100, 20, 30, 10),
(172, 'SMA', 'XII IPA (A)', 'Marching & Drilling', 40, 100, 20, 30, 10),
(173, 'SMA', 'XII IPS (A)', 'Marching & Drilling', 40, 100, 20, 30, 10),
(174, 'SMA', 'XI IPS (A)', 'Marching & Drilling', 40, 100, 20, 30, 10),
(175, 'SMA', 'XI IPA (A)', 'Keyboarding', 40, 100, 20, 30, 10),
(176, 'SMA', 'X IPA (A)', 'Keyboarding', 40, 100, 20, 30, 10),
(177, 'SMA', 'X IPS (A)', 'Keyboarding', 40, 100, 20, 30, 10),
(178, 'SMA', 'XII IPA (A)', 'Keyboarding', 40, 100, 20, 30, 10),
(179, 'SMA', 'XII IPS (A)', 'Keyboarding', 40, 100, 20, 30, 10),
(180, 'SMA', 'XI IPS (A)', 'Keyboarding', 40, 100, 20, 30, 10),
(181, 'SMA', 'XI IPA (A)', 'Gardening', 40, 100, 20, 30, 10),
(182, 'SMA', 'X IPA (A)', 'Gardening', 40, 100, 20, 30, 10),
(183, 'SMA', 'X IPS (A)', 'Gardening', 40, 100, 20, 30, 10),
(184, 'SMA', 'XII IPA (A)', 'Gardening', 40, 100, 20, 30, 10),
(185, 'SMA', 'XII IPS (A)', 'Gardening', 40, 100, 20, 30, 10),
(186, 'SMA', 'XI IPS (A)', 'Gardening', 40, 100, 20, 30, 10),
(187, 'SMA', 'XI IPA (A)', 'Speech', 40, 100, 20, 30, 10),
(188, 'SMA', 'X IPA (A)', 'Speech', 40, 100, 20, 30, 10),
(189, 'SMA', 'X IPS (A)', 'Speech', 40, 100, 20, 30, 10),
(190, 'SMA', 'XII IPA (A)', 'Speech', 40, 100, 20, 30, 10),
(191, 'SMA', 'XII IPS (A)', 'Speech', 40, 100, 20, 30, 10),
(192, 'SMA', 'XI IPS (A)', 'Speech', 40, 100, 20, 30, 10),
(193, 'SMA', 'XI IPA (A)', 'Futsal', 40, 100, 20, 30, 10),
(194, 'SMA', 'X IPA (A)', 'Futsal', 40, 100, 20, 30, 10),
(195, 'SMA', 'X IPS (A)', 'Futsal', 40, 100, 20, 30, 10),
(196, 'SMA', 'XII IPA (A)', 'Futsal', 40, 100, 20, 30, 10),
(197, 'SMA', 'XII IPS (A)', 'Futsal', 40, 100, 20, 30, 10),
(198, 'SMA', 'XI IPS (A)', 'Futsal', 40, 100, 20, 30, 10),
(199, 'SMA', 'XI IPA (A)', 'Gate Ministry', 40, 100, 20, 30, 10),
(200, 'SMA', 'X IPA (A)', 'Gate Ministry', 40, 100, 20, 30, 10),
(201, 'SMA', 'X IPS (A)', 'Gate Ministry', 40, 100, 20, 30, 10),
(202, 'SMA', 'XII IPA (A)', 'Gate Ministry', 40, 100, 20, 30, 10),
(203, 'SMA', 'XII IPS (A)', 'Gate Ministry', 40, 100, 20, 30, 10),
(204, 'SMA', 'XI IPS (A)', 'Gate Ministry', 40, 100, 20, 30, 10),
(205, 'SMA', 'XI IPA (A)', 'English Club', 40, 100, 20, 30, 10),
(206, 'SMA', 'X IPA (A)', 'English Club', 40, 100, 20, 30, 10),
(207, 'SMA', 'X IPS (A)', 'English Club', 40, 100, 20, 30, 10),
(208, 'SMA', 'XII IPA (A)', 'English Club', 40, 100, 20, 30, 10),
(209, 'SMA', 'XII IPS (A)', 'English Club', 40, 100, 20, 30, 10),
(210, 'SMA', 'XI IPS (A)', 'English Club', 40, 100, 20, 30, 10),
(211, 'SMA', 'XI IPA (A)', 'Science Club', 40, 100, 20, 30, 10),
(212, 'SMA', 'X IPA (A)', 'Science Club', 40, 100, 20, 30, 10),
(213, 'SMA', 'X IPS (A)', 'Science Club', 40, 100, 20, 30, 10),
(214, 'SMA', 'XII IPA (A)', 'Science Club', 40, 100, 20, 30, 10),
(215, 'SMA', 'XII IPS (A)', 'Science Club', 40, 100, 20, 30, 10),
(216, 'SMA', 'XI IPS (A)', 'Science Club', 40, 100, 20, 30, 10),
(217, 'SMA', 'XI IPA (A)', 'Upacara', 40, 100, 20, 30, 10),
(218, 'SMA', 'X IPA (A)', 'Upacara', 40, 100, 20, 30, 10),
(219, 'SMA', 'X IPS (A)', 'Upacara', 40, 100, 20, 30, 10),
(220, 'SMA', 'XII IPA (A)', 'Upacara', 40, 100, 20, 30, 10),
(221, 'SMA', 'XII IPS (A)', 'Upacara', 40, 100, 20, 30, 10),
(222, 'SMA', 'XI IPS (A)', 'Upacara', 40, 100, 20, 30, 10),
(223, 'SMA', 'XI IPA (A)', 'Chapel', 40, 100, 20, 30, 10),
(224, 'SMA', 'X IPA (A)', 'Chapel', 40, 100, 20, 30, 10),
(225, 'SMA', 'X IPS (A)', 'Chapel', 40, 100, 20, 30, 10),
(226, 'SMA', 'XII IPA (A)', 'Chapel', 40, 100, 20, 30, 10),
(227, 'SMA', 'XII IPS (A)', 'Chapel', 40, 100, 20, 30, 10),
(228, 'SMA', 'XI IPS (A)', 'Chapel', 40, 100, 20, 30, 10),
(229, 'SMA', 'XI IPA (A)', 'Bahasa & Sastra Arab', 40, 100, 20, 30, 10),
(230, 'SMA', 'X IPA (A)', 'Bahasa & Sastra Arab', 40, 100, 20, 30, 10),
(231, 'SMA', 'X IPS (A)', 'Bahasa & Sastra Arab', 40, 100, 20, 30, 10),
(232, 'SMA', 'XII IPA (A)', 'Bahasa & Sastra Arab', 40, 100, 20, 30, 10),
(233, 'SMA', 'XII IPS (A)', 'Bahasa & Sastra Arab', 40, 100, 20, 30, 10),
(234, 'SMA', 'XI IPS (A)', 'Bahasa & Sastra Arab', 40, 100, 20, 30, 10),
(235, 'SMA', 'XI IPA (A)', 'Istirahat', 40, 100, 20, 30, 10),
(236, 'SMA', 'X IPA (A)', 'Istirahat', 40, 100, 20, 30, 10),
(237, 'SMA', 'X IPS (A)', 'Istirahat', 40, 100, 20, 30, 10),
(238, 'SMA', 'XII IPA (A)', 'Istirahat', 40, 100, 20, 30, 10),
(239, 'SMA', 'XII IPS (A)', 'Istirahat', 40, 100, 20, 30, 10),
(240, 'SMA', 'XI IPS (A)', 'Istirahat', 40, 100, 20, 30, 10);

-- --------------------------------------------------------

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
-- Dumping data untuk tabel `tbl_06_schedule`
--

INSERT INTO `tbl_06_schedule` (`CtrlNo`, `Degree`, `RoomID`, `RoomDesc`, `semester`, `schoolyear`, `Hour`, `SubjName`, `Days`, `IDNumber`, `TeacherName`, `Note`) VALUES
(1, 'SMA', 'SMAR1IPAA', 'X IPA (A)', 1, '2020/2021', '07:15:00', 'Komputer', 'Senin', '0000003', 'Harley  Manoppo', ''),
(2, 'SMA', 'SMAR1IPAA', 'X IPA (A)', 1, '2020/2021', '12:30:00', 'ELECTIVE', 'Senin', '-', '-', ''),
(3, 'SMA', 'SMAR1IPAA', 'X IPA (A)', 1, '2020/2021', '14:45:00', 'EXCUL', 'Senin', '-', '-', '');

-- --------------------------------------------------------

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

--
-- Dumping data untuk tabel `tbl_06_schedule_nonregular`
--

INSERT INTO `tbl_06_schedule_nonregular` (`CtrlNo`, `Degree`, `RoomID`, `RoomDesc`, `semester`, `schoolyear`, `Hour`, `Type`, `SubjName`, `Days`, `IDNumber`, `TeacherName`, `Note`) VALUES
(5, 'SMA', 'SMAR1IPAA', 'X IPA (A)', 1, '2020/2021', '14:45', 'EXCUL', 'Sign Language', 'Senin', '0000003', 'Harley  Manoppo', NULL),
(6, 'SMA', 'SMAR1IPAA', 'X IPA (A)', 1, '2020/2021', '14:45', 'EXCUL', 'Gardening', 'Senin', '0000021', 'Elsje chrestina  Karesung', NULL);

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
-- Dumping data untuk tabel `tbl_07_personal_bio`
--

INSERT INTO `tbl_07_personal_bio` (`CtrlNo`, `IDNumber`, `PersonalID`, `FirstName`, `MiddleName`, `LastName`, `NickName`, `status`, `Gender`, `DateofBirth`, `PointofBirth`, `KK`, `BirthCertificate`, `Race`, `Religion`, `Bloodtype`, `Disability`, `HeadDiameter`, `Height`, `Weight`, `Address`, `RT`, `RW`, `Village`, `Dusun`, `District`, `Region`, `City`, `Province`, `Country`, `Postal`, `Photo`, `RegBy`, `RegDate`) VALUES
(1, 'abase', '-', 'Sys_Admin', '', 'ABase.com', 'ADM', 'admin', 'Laki-Laki', '1994-05-15', 'Jakarta', '', '', 'Minahasa', 'Katolik', 'B', '', '', '145', '50', 'Tumumpa satu lingkungan tiga', '', '', '', '', 'Mapanget', '-', 'Manado', 'Sulawesi Utara', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-08-27'),
(266, '0000001', '', 'Evins N', '', 'Kumendong', '', 'staff', 'Perempuan', '1973-11-27', 'Tomohon', '-', '-', '-', 'Budha', '-', '-', '-', '0', '0', 'Puri Kelapa Gading,Paniki Atas', '-', '-', '-', '-', '', '', 'Manado', 'Sulawesi Utara', 'Indonesia', '-', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(267, '0000002', '', 'Deker ', '', 'Muaja', '', 'staff', 'Laki-Laki', '1970-04-20', 'Talaitad', '-', '-', '-', 'Budha', '-', '-', '-', '0', '0', 'Jln. Daan Mogot No. 11 Tikala Baru', '-', '-', '-', '-', '', '', 'Manado', 'Sulawesi Utara', 'Indonesia', '-', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(268, '0000003', '', 'Harley ', '', 'Manoppo', '', 'teacher', 'Laki-Laki', '1975-06-11', 'Minahasa', '-', '-', '-', 'Budha', '-', '-', '-', '0', '0', 'Ranomuut Lingk. V Kec. Paal 2', '-', '-', '-', '-', '', '', 'Manado', 'Sulawesi Utara', 'Indonesia', '-', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(269, '0000004', '', 'Meisye ', '', 'Massie', '', 'staff', 'Perempuan', '1973-05-27', 'Manado', '-', '-', '-', 'Budha', '-', '-', '-', '0', '0', 'Wenang Selatan Lingk. III', '-', '-', '-', '-', '', '', 'Manado', 'Sulawesi Utara', 'Indonesia', '-', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(271, '220194', '7171094604050001', 'Aurily ', ' Livia', 'Petiunaung', '', 'student', 'Perempuan', '2005-06-04', 'MANADO', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '', '', 'LINGKUNGAN VI', '0', '0', 'MALALAYANG SATU BARAT', '', 'Kec. Malalayang', '', '-', '-', 'Indonesia', '95262', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(272, '320196', '7108050702040001', 'Brayen ', '', 'Tindatu', '', 'student', 'Laki-Laki', '2005-07-02', 'Inomunga', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '', '', 'Jln Raya sarawet- Likupang', '0', '0', 'SARAWET', '', 'Kec. Likupang Timur', '', '-', '-', 'Indonesia', '95375', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(273, '420198', '6471024109040002', 'Celiana ', ' Rebecca', 'Tambaani', '', 'student', 'Perempuan', '2004-01-09', 'BALIKPAPAN', '', '124?Kcs/Hb/2006', '-', 'Kristen', '-', 'Tidak Ada', '', '167', '555', 'Martadinata', '0', '0', 'Dendengan Luar', '', 'Kec. Paal Dua', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(274, '5201910', '7171050501050003', 'Charles ', ' Yordan', 'Ingkiriwang', '', 'student', 'Laki-Laki', '2005-05-01', 'MANADO', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '168', '62', 'Martadinata VIII', '0', '0', 'Dendengan Luar', '', 'Paal Dua', '', '-', '-', 'Indonesia', '95128', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(275, '6201912', '7171042211070011', 'Christy  ', 'Veronika', 'Mangari', '', 'student', 'Perempuan', '2004-07-21', 'Manado', '7173031801080008', '04/27/111/2004', '-', 'Kristen', '-', 'Tidak Ada', '', '147', '60', 'Kombos Timur Ling III', '0', '0', 'Kombos', '', 'Kec. Mapanget', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(276, '7201914', '9271052208040004', 'David ', '', 'Legi', '', 'student', 'Laki-Laki', '2004-02-08', 'Makassar', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '', '', 'Jln. F. Kalasuat', '2', '3', 'Malanu', '', 'Sorong Utara', '', '-', '-', 'Indonesia', '98419', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(277, '8201916', '7102152810040001', 'Ethan  ', 'Mark Rowland', 'Thomas', '', 'student', 'Laki-Laki', '2004-10-18', '', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '', '', '', '0', '0', 'Malalayang', 'Lingkungan 2', 'Malalayang', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(278, '9201918', '7171081410030001', 'Fernando', ' Scriven ', 'Saluy', '', 'student', 'Laki-Laki', '2003-10-14', 'Jakarta', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '', '', 'Tikala', '0', '0', 'Tikala', '', 'Wenang', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(280, '11201922', '7173035407040002', 'Intan', 'Vanya Restika', 'Kesso', '', 'student', 'Perempuan', '2004-07-14', 'TINOOR', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '160', '39', 'KANA', '0', '0', 'TINOOR II LINGKUNGAN IV', '', 'Tomohon Utara', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(281, '12201924', '7171050807050002', 'Jennifer', 'Shania', 'Mona', '', 'student', 'Perempuan', '2004-01-08', 'Manado', '7105122804170002', '474.1/389/Ist/2002', '-', 'Kristen', '-', 'Tidak Ada', '', '165', '55', 'Taas', '0', '0', 'Taas', '', 'Kec. Tikala', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(282, '14201928', '7172033009040001', 'Jeril ', '', 'Tanomonota', '', 'student', 'Laki-Laki', '2004-09-30', 'Batuputih', '', '1302/Dispensasi/2007', '-', 'Kristen', '-', 'Tidak Ada', '', '155', '45', 'Batuputih Atas', '3', '1', 'Batuputih Atas', 'Batuputih Atas', 'Ranowulu', '', '-', '-', 'Indonesia', '95535', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(283, '15201930', '7171020501050023', 'Leonard ', ' Izacson', 'Umar', '', 'student', 'Laki-Laki', '2005-05-01', 'Manado', '', '1281/2003', '-', 'Kristen', '-', 'Tidak Ada', '', '', '', 'KEL. ISLAM LK. IV', '0', '0', 'ISLAM', '', 'Tuminting', '', '-', '-', 'Indonesia', '95239', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(284, '16201932', '9206010212020001', 'Leuchen ', ' Youven', 'Pinangkaan', '', 'student', 'Laki-Laki', '2002-02-12', 'MANADO', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '', '', 'TUASAY', '1', '1', 'TUASAY', 'TUASAY', 'Bintuni', '', '-', '-', 'Indonesia', '98551', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(285, '17201934', '5104025509040001', 'Liana ', ' Tina', 'Fambrene', '', 'student', 'Perempuan', '2004-09-15', 'Gianyar', '', 'AL. 786.0001185', '-', 'Kristen', '-', 'Tidak Ada', '', '', '', 'Lingkungan IV', '0', '0', 'Tikala Baru', '', 'Tikala', '', '-', '-', 'Indonesia', '95126', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(286, '18201936', '7105096606040001', 'Liony Prisilia ', '', 'Mamangkey', '', 'student', 'Perempuan', '2004-06-26', 'Amurang', '', '173/2003.-', '-', 'Kristen', '-', 'Tidak Ada', '', '169', '169', 'jl ', '0', '0', 'PAKUURE SATU', '', 'Tenga', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(287, '19201938', '7171082807040001', 'Margareth ', ' Serensia Carmelia', 'Rantung', '', 'student', 'Perempuan', '2004-07-28', 'Manado', '', 'AL.783.0049166', '-', 'Kristen', '-', 'Tidak Ada', '', '145', '45', 'Malalayang', '0', '0', 'Malalayang', '', 'Malalayang', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(288, '20201940', '7171082804030002', 'Matthew', 'Hanthey Peter', ' Lumantouw', '', 'student', 'Laki-Laki', '2003-04-28', 'Manado', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '145', '50', 'LINGKUNGAN X', '0', '0', 'KAIRAGI DUA', '', 'Mapanget', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(289, '21201942', '7171061006040001', 'Melody  ', 'Gloryanie', 'Latuni', '', 'student', 'Perempuan', '2004-10-06', 'Manado', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '161', '51', 'Tumumpa I Ling II', '0', '0', 'Tumumpa', '', 'Tuminting', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(290, '22201944', '7106044605040001', 'Michelle', ' Cathy ', 'Sindua', '', 'student', 'Perempuan', '2004-06-05', 'Lansa', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '170', '65', 'wori likupang', '0', '0', 'Lansa', 'IV', 'Wori', '', '-', '-', 'Indonesia', '95376', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(291, '23201946', '7171052302100002', 'Miracle ', 'Christenia Putri ', 'Daroel', '', 'student', 'Perempuan', '2005-07-15', 'Manado', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '', '', 'Ranomuut Ling 5', '0', '0', 'Perkamil', '', 'Paal Dua', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(292, '24201948', '7171022705010002', 'Mylene ', ' Pricilla', 'Melope', '', 'student', 'Perempuan', '2005-06-18', 'Jakarta', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '161', '54', 'Tumumpa I Ling III', '0', '0', 'Tumumpa', '', 'Tuminting', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(293, '25201950', '7172030206040000', 'Refanly ', 'Gilliant', ' Nusa', '', 'student', 'Laki-Laki', '2004-06-02', 'Kotabunan', '', '437/2003', '-', 'Kristen', '-', 'Tidak Ada', '', '166', '51', 'Lingkungan III', '9', '3', 'Batuputih Atas', 'Batuputih Atas', 'Ranowulu', '', '-', '-', 'Indonesia', '95535', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(294, '26201952', '6473022070300003', 'Reivly', ' Eudry Yustin', ' Wuisan', '', 'student', 'Laki-Laki', '2003-07-22', 'Tarakan', '', '', '-', 'Kristen', '-', '', '', '', '', '', '', '', '', '', '', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(295, '27201954', '7171054705040023', 'Riana ', '', 'Keni', '', 'student', 'Perempuan', '2004-05-07', 'MANADO', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '', '', 'LINGKUNGAN II', '0', '0', 'PANIKI BAWAH', '', 'Mapanget', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(296, '28201956', '7171070405050002', 'Steve J. ', '', 'Megawe', '', 'student', 'Laki-Laki', '2005-05-04', 'Manado', '', '', '-', 'Kristen', '-', 'Tidak Ada ', '', '', '', 'Sawangan', '0', '0', 'sawangan', '', 'Tombulu', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(297, '29201958', '7171036604050001', 'Triana Virenza ', '', 'Madil', '', 'student', 'Perempuan', '2005-04-26', 'MANADO', '', '', '-', 'Kristen', '-', 'Tidak Ada', '', '', '', 'LINGKUNGAN II', '0', '0', 'KOMBOS BARAT', '', 'Wanea', '', '-', '-', 'Indonesia', '95233', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(300, '0000021', '', 'Elsje chrestina ', '', 'Karesung', '', 'teacher', 'Perempuan', '1960-09-08', 'Tumaluntung', '-', '-', '-', 'Budha', '-', '-', '-', '0', '0', 'Pineleng', '-', '-', '-', '-', '', '', 'Manado', 'Sulawesi Utara', 'Indonesia', '-', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(301, '0000022', '', 'Inggrid O.', '', 'Melope', '', 'teacher', 'Laki-Laki', '1990-04-12', 'Karatung', '-', '-', '-', 'Budha', '-', '-', '-', '0', '0', 'Bitung Karangria Lingk. IV Kec. Tuminting', '-', '-', '-', '-', '', '', 'Manado', 'Sulawesi Utara', 'Indonesia', '-', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(302, '0000023', '', 'Devni , SPd', '', 'Resitj', '', 'teacher', 'Perempuan', '1991-12-21', 'Koreng', '-', '-', '-', 'Budha', '-', '-', '-', '0', '0', 'Malalayang II Lingk. 1', '-', '-', '-', '-', '', '', 'Manado', 'Sulawesi Utara', 'Indonesia', '-', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(303, '0000029', '', 'Yuliana A. ', '', 'Assa', '', 'staff', 'Perempuan', '1974-06-20', 'Minahasa', '-', '-', '-', 'Budha', '-', '-', '-', '0', '0', 'Jln. Daan Mogot No 11 Tikala Baru', '-', '-', '-', '-', '', '', 'Manado', 'Sulawesi Utara', 'Indonesia', '-', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(304, '0000030', '', 'Rine ', '', 'Rumegang', '', 'staff', 'Perempuan', '1966-06-24', 'Bolmong', '-', '-', '-', 'Budha', '-', '-', '-', '0', '0', 'Jln. Daan Mogot No 11 Tikala Baru', '-', '-', '-', '-', '', '', '', '', '', '-', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(305, '0000031', '', 'Juil ', '', 'Rumegang', '', 'staff', 'Laki-Laki', '1964-05-31', 'Talaud', '-', '-', '-', 'Budha', '-', '-', '-', '0', '0', 'Jln. Daan Mogot No 11 Tikala Baru', '-', '-', '-', '-', '', '', 'Manado', 'Sulawesi Utara', 'Indonesia', '-', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(306, '0000005', '', 'Y', '', 'Sandag-Salindeho', '', 'staff', 'Perempuan', '1962-01-12', 'Airmadidi', '-', '-', '-', 'Budha', '-', '-', '-', '0', '0', 'Lingk 6 Kairagi 2 Kec. Mapanget', '-', '-', '-', '-', '', '', 'Manado', 'Sulawesi Utara', 'Indonesia', '-', 'default.png', 'ABase_SysAdmin', '2019-11-27'),
(307, '0119160', '', 'Adam ', 'Marselino', 'Rumambi', 'Adam', 'student', 'Laki-Laki', '2005-07-03', 'MANADO', '', '75.Jo.S.1936.No.607 di manado 1444/2004', '-', 'Kristen', '-', '', '', '170', '55', 'Griya lllb Indah', '0', '0', 'Mapanget', '', 'Talawaan', 'Minahasa Utara', '-', '-', 'Indonesia', '95373', 'default.png', 'ABase_SysAdmin', '2019-11-28'),
(339, '3680', '', 'Given ', 'Azarya ', 'Pantouw', 'Given ', 'student', 'Laki-Laki', '2004-12-07', 'Manado', '7171051702080052', '51/IST/IBU/HB/2010', '-', 'Kristen', '-', '', '', '155', '45', 'Perum Agape Griya', '0', '0', 'Airmadidii', '', 'Kec. Airmadidi', '', '-', '-', 'Indonesia', '', 'default.png', 'ABase_SysAdmin', '2020-01-14');

-- --------------------------------------------------------

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

--
-- Dumping data untuk tabel `tbl_08_job_info`
--

INSERT INTO `tbl_08_job_info` (`CtrlNo`, `IDNumber`, `Occupation`, `JobDesc`, `Honorer`, `Emp_Type`, `Homeroom`, `SubjectTeach`, `LastEducation`, `StudyFocus`, `Govt_Cert`, `Institute_Cert`, `YearStarts`, `MaritalStatus`, `Email`, `Phone`) VALUES
(25, 'abase', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', '-', '-', '-', NULL, '-', '-'),
(28, '0000001', 'staff', 'Kepala Perguruan SMA', 'no', 'GTY', '-', '-', 'Diploma 2', 'MAEd', '', 'no', '1997', 'Menikah', '', ''),
(29, '0000002', 'staff', 'Kepala SMK', 'no', 'GTY', '-', '-', 'Diploma 1', 'S.pd', '2013', 'no', '1995', 'Menikah', '', ''),
(30, '0000003', 'teacher', 'Bendahara ', 'no', 'PTY', 'X IPA (A)', '-', 'Diploma 1', 'SE', '', 'no', '2001', 'Menikah', '', ''),
(31, '0000004', 'staff', 'Wakasek SMA', 'no', 'GTY', '-', '-', 'Diploma 1', 'S.pd', '2008', 'no', '1998', 'Menikah', '', ''),
(34, '0000021', 'teacher', '', 'yes', 'GTT', '-', '-', 'Diploma 1', 'Dra', '', 'no', '2008', 'Menikah', '', ''),
(35, '0000022', 'teacher', '', 'yes', 'GTT', '-', '-', 'Diploma 1', 'S.Kep', '', 'no', '2012', 'Belum Menikah', '', ''),
(36, '0000023', 'teacher', '', 'yes', 'GTT', '-', '-', 'Diploma 1', 'S.pd', '', 'no', '2015', 'Belum Menikah', '', ''),
(37, '0000029', 'staff', 'Kepala Asrama', 'no', 'PTT', '-', '-', '', '', '', 'no', '2004', 'Menikah', '', ''),
(38, '0000030', 'staff', 'Metron', 'no', 'PTT', '-', '-', '', '', '', 'no', '2001', 'Menikah', '', ''),
(39, '0000031', 'staff', 'Custodian', 'no', 'PTT', '-', '-', '', '', '', 'no', '2001', 'Menikah', '', ''),
(40, '0000005', 'staff', 'Wakasek SMK', 'no', 'GTY', '-', '-', 'Diploma 2', 'MAEd', '2008', 'no', '1987', 'Menikah', '', '');

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
-- Dumping data untuk tabel `tbl_08_job_info_std`
--

INSERT INTO `tbl_08_job_info_std` (`CtrlNo`, `NIS`, `NISN`, `Kelas`, `Ruangan`, `Position`, `Email`, `Phone`, `HousePhone`, `LiveWith`, `AnakKe`, `Saudara`, `SdraTiri`, `SdraAngkat`, `Father`, `FatherNIK`, `FatherBorn`, `FatherDegree`, `FatherJob`, `FatherIncome`, `FatherDisability`, `Mother`, `MotherNIK`, `MotherBorn`, `MotherDegree`, `MotherJob`, `MotherIncome`, `MotherDisability`, `Guardian`, `GuardianNIK`, `GuardianBorn`, `GuardianDegree`, `GuardianJob`, `GuardianIncome`, `GuardianDisability`, `Transportation`, `Range`, `ExactRange`, `TimeRange`, `Latitude`, `Longitude`, `KIP`, `Stayed_KIP`, `Refuse_PIP`, `Achievement`, `AchievementLVL`, `AchievementName`, `AchievementYear`, `Sponsor`, `AchievementRank`, `Scholarship`, `ScholarDesc`, `ScholarStart`, `ScholarFinish`, `Prosperity`, `ProsperNumber`, `ProsperNameTag`, `Competition`, `Registration`, `SchoolStarts`, `PreviousSchool`, `UNNumber`, `Diploma`, `SKHUN`) VALUES
(86, '220194', '0050471858', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '2', '0', NULL, NULL, 'STEVENSON PETIUNAUNG', '7171091902830002', '1983', 'SMA Sederajat', 'PNS/TNI/POLRI', 'Rp. 2.0000.0000 - Rp. 4.999.999', 'Tidak Ada', 'VERONICA SUPRAPTO', '7171094408840022', '1984', 'SMA Sederajat', 'Tidak Bekerja', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'Public Transportation', '< 1 KM', '100', '5', '1.4949', '124.8755', 'no', '-', '-', 'Sains', 'Sekolah', NULL, '0', '', '0', 'Berprestasi', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(87, '320196', '0045686571', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '0', NULL, NULL, 'PITSON TINDATU', '', '1972', 'Putus SD', 'Petani', 'Rp. 500.000', 'Tidak Ada', 'Meriam Nesar', '', '1976', 'Putus SD', 'Tidak Bekerja', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'On Foot', '> 1 KM', '', '', '1.4335', '124.991', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(88, '420198', '0041252462', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Guardian', '2', '0', NULL, NULL, 'Jantje Tambaani', '', '1961', 'SMA Sederajat', 'Buruh', 'Rp. 1.0000.0000 - Rp. 1.999.9999', 'Tidak Ada', 'LENDA SATIGI', '', '1962', 'SMA Sederajat', 'Tidak Bekerja', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'On Foot', '< 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(89, '5201910', '0054067472', 'X IPA', 'X IPA (A)', '-', '', '(+62) 852-9839-695_', '', 'With Parent', '2', '1', NULL, NULL, 'Feky Acang Ingkiriwang', '', '1970', 'SMA Sederajat', 'Wiraswasta', 'Rp. 500.000 - Rp. 999.999', 'Tidak Ada', 'ANITA MANABUNG', '7171054804710003', '1971', 'SMA Sederajat', '-', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'On Foot', '< 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(90, '6201912', '0042264011', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '1', NULL, NULL, 'Andres E. Mangari', '', '', 'SMA Sederajat', 'Pedagang Kecil', 'Rp. 1.0000.0000 - Rp. 1.999.9999', 'Tidak Ada', 'Yuliana T. Kawuwung', '', '', 'SMP Sederajat', 'Tidak Bekerja', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'Public Transportation', '< 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', 'SMP ADVENT TOMOHON', '2-17-17-03-022-003-6', 'DN-17 DI/06 0008377', ''),
(91, '7201914', '0034010157', 'X IPA', 'X IPA (A)', '-', '', '(+62) 821-9815-628_', '', 'With Parent', '2', '2', NULL, NULL, 'Stenly Legi', '9271051210750002', '1975', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', 'Tidak Ada', 'Vera Piter', '9271055111780008', '1978', 'SMP Sederajat', 'Tidak Bekerja', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'On Foot', '< 1 KM', '', '', '1.4752', '124.8738', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(92, '8201916', '0046843909', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '0', NULL, NULL, 'Michael Thomas', '9102151905790001', '1979', 'SMA Sederajat', 'Buruh', '-', 'Tidak Ada', 'Liza T B Saptenno', '7102155511810001', '1981', 'D3', 'Tidak Bekerja', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'Private Vehicle', '> 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(93, '9201918', '0035410896', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '0', NULL, NULL, 'Marskal Saluy', '', '', 'D4/S1', 'Wirausaha', 'Rp. 1.0000.0000 - Rp. 1.999.9999', 'Tidak Ada', 'Fizayanti Mala', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'Public Transportation', '> 1 KM', '', '', '1.473893661', '124.8445988', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(95, '11201922', '0037769003', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '1', NULL, NULL, 'MEYER MAX KESSO', '', '', 'SMA Sederajat', 'Petani', 'Rp. 500.000', 'Tidak Ada', 'MEYTI SYANE RAPAR', '', '', 'SMA Sederajat', '-', 'Rp. 500.000', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'On Foot', '> 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(96, '12201924', '0046395170', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '1', NULL, NULL, 'Salmon E. Mona', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', 'Tidak Ada', '', '', '', '-', '-', '-', '', '', '', '', '-', '-', '-', '', 'Public Transportation', '< 1 KM', '1', '', '1.1906', '124.7948', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', 'SMP AVENT MALUKU HATIVE BESAR', '2-17-21-01-030-001-8', '', ''),
(97, '14201928', '0044317421', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '', '2', NULL, NULL, 'Fredi Tanomonota', '7172031502770001', '1977', 'SD Sederajat', 'Nelayan', 'Rp. 500.000 - Rp. 999.999', 'Tidak Ada', 'Nelli Taghulihi', '7172034104840001', '1984', 'SMP Sederajat', 'Tidak Bekerja', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'On Foot', '> 1 KM', '', '', '', '', 'yes', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', 'SMP Kristen Kembes', '2-17-17-07-062-023-2', 'DN-17 DI/13 0004917', ''),
(98, '15201930', '0051241851', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '', '0', NULL, NULL, 'BENHARD UMAR', '', '', 'SMP Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', 'Tidak Ada', 'Ulva Katiandagho', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 500.000 - Rp. 999.999', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'On Foot', '< 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(99, '16201932', '0028405534', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '', '0', NULL, NULL, 'Jhoni Panamon', '', '1987', 'SMA Sederajat', 'Wiraswasta', 'Rp. 500.000 - Rp. 999.999', 'Tidak Ada', 'YUNITA MASENGI', '', '1989', 'SMP Sederajat', 'Wiraswasta', 'Rp. 500.000 - Rp. 999.999', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'On Foot', '> 1 KM', '', '', '1.4949', '124.8755', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(100, '17201934', '0044271575', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '0', NULL, NULL, 'Nolly Rudy Fambrene', '', '1968', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', 'Tidak Ada', 'Ni Nyoman Rini', '', '0', 'Tidak Sekolah', 'Tidak Bekerja', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'On Foot', '< 1 KM', '', '', '1.4949', '124.8755', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(101, '18201936', '0049060267', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '0', NULL, NULL, 'JOLLY J.R. MAMANGKEY', '', '', '-', '-', 'Rp. 500.000', 'Tidak Ada', '', '', '', '-', '-', '-', '', '', '', '', '-', '-', '-', '', 'On Foot', '< 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', 'SMP Advent 4 Paal Dua', '', '', ''),
(102, '19201938', '0043680133', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '0', NULL, NULL, '', '', '', '-', '-', '-', 'Tidak Ada', 'Livia F. Tatuya', '', '', 'SMA Sederajat', 'Wirausaha', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', '', '', '', '-', '-', '-', '', 'Public Transportation', '> 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', 'SMP NEGERI 3 MANGANITU', '2-17-17-06-009-027-6', 'DN-17 DI/06 0012567', ''),
(103, '20201940', '0037849405', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '0', NULL, NULL, 'HANNY JERRY LUMANTOUW', '7171083001720002', '1972', 'D4/S1', '-', '-', 'Tidak Ada', 'THEYNELY EUNICE VERNETTE HAVELAAR', '7171085104750002', '1975', 'D4/S1', 'Tidak Bekerja', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'Public Transportation', '> 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(104, '21201942', '0054717565', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '0', NULL, NULL, 'Glenie Latuni', '', '', 'S2', 'PNS/TNI/POLRI', 'Rp. 2.0000.0000 - Rp. 4.999.999', 'Tidak Ada', 'Pola Philip', '', '', 'D4/S1', '-', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'Public Transportation', '> 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', 'SMP Advent 5 Kairagi', '2-17-17-01-059-004-5', '', ''),
(105, '22201944', '0049597375', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '2', '2', NULL, NULL, 'Ferdinand Sindua', '', '', 'SD Sederajat', '-', '-', '', 'Afridel Salenda', '', '1965', 'SD Sederajat', 'Tidak Bekerja', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'Public Transportation', '> 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', 'SMP Advent 4 Manado', '', '', ''),
(106, '23201946', '0059026071', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '2', '0', NULL, NULL, 'Michael Kanisius Daroel', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', 'Tidak Ada', 'Susanti Sentinwo', '', '', 'SMA Sederajat', 'Tidak Bekerja', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'Public Transportation', '< 1 KM', '', '', '1.472520824', '124.872365', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(107, '24201948', '0053251738', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '0', NULL, NULL, 'Yusak N Melope', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', 'Tidak Ada', 'Olvi Rambi', '', '', 'SMA Sederajat', '-', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'Public Transportation', '> 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(108, '25201950', '0044317429', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '0', NULL, NULL, 'Fany Felix Nusa', '7172030702810001', '1981', 'SD Sederajat', '-', 'Rp. 2.0000.0000 - Rp. 4.999.999', 'Tidak Ada', 'Lidia Simbage', '7172035601840001', '1984', 'SMA Sederajat', '-', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'On Foot', '> 1 KM', '', '', '', '', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', 'SMP Advent 5 Kairagi', '', '', ''),
(109, '26201952', '0033436590', 'X IPA', 'X IPA (A)', '-', 'reivlyeudry@gmail.com', '(+62) 852-4717-878_', '', 'With Parent', '1', '0', NULL, NULL, 'Noldy Hendry Wuisan', '6473020311640001', '1964', 'SMA Sederajat', 'Buruh', 'Rp. 500.000 - Rp. 999.999', 'Tidak Ada', 'Deivy Rondonuwu', '6473024412700004', '1970', 'SMA Sederajat', '-', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'On Foot', '> 1 KM', '', '', '1.676463235', '125.0762558', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(110, '27201954', '0049675273', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '2', '3', NULL, NULL, 'RITUS EGBERTH KENI', '7171050902720022', '1972', 'D4/S1', '-', '-', 'Tidak Ada', 'OLIVIA SORAYA IMELDA UMBOH', '7171056707760005', '1976', 'D4/S1', 'PNS/TNI/POLRI', 'Rp. 5.000.0000 - Rp. 20.000.000', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'Public Transportation', '> 1 KM', '', '', '1.459', '124.8547', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', 'SMP Advent 5 Kairagi', '', '', ''),
(111, '28201956', '0056283908', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '3', '0', NULL, NULL, 'Elvis Megawe', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', 'Tidak Ada', 'Sherly Mokia', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'Public Transportation', '> 1 KM', '', '', '1.485852324', '124.8586857', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(112, '29201958', '0052922704', 'X IPA', 'X IPA (A)', '-', '', '', '', 'With Parent', '1', '0', NULL, NULL, 'JAMES YAN MADIL', '7171032006710001', '1971', 'SMP Sederajat', 'Buruh', 'Rp. 500.000', 'Tidak Ada', 'ANDRIANI BAKARI', '7171035004800001', '1980', 'SMP Sederajat', '-', '-', 'Tidak Ada', '', '', '', '-', '-', '-', '', 'Public Transportation', '> 1 KM', '', '', '1.487793589', '124.857645', 'no', '-', '-', 'None', 'None', NULL, '0', '', '0', 'None', NULL, NULL, NULL, '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(113, '0119160', '0053271320', 'X IPA', 'X IPA (A)', '-', '', '(+62) 813-4000-1498', '(____) ___-___', 'With Parent', '1', '0', NULL, NULL, '', '', '1974', 'SMA Sederajat', 'Wirausaha', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', NULL, '', '1980', 'SMA Sederajat', '-', 'Rp. 500.000 - Rp. 999.999', '', NULL, '', '1974', 'SMA Sederajat', 'Wiraswasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', 'Private Vehicle', '< 1 KM', '1', '', '1', '', 'no', '-', '-', '-', '-', NULL, '0', '', '0', '-', '', '', '', '-', '', '', '', 'Siswa Baru', '1970-01-01', '', '', '', ''),
(140, '3680', '0049281905', 'X IPA', 'X IPA (A)', '-', '', '(+62) ___-____-____', '(____) ___-___', 'With Parent', '3', '0', NULL, NULL, 'Tommy J. Pantouw', '', '', 'D4/S1', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', 'Sherly Assa', '', '', 'D3', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', '', '', '', '-', '-', '-', '', 'Public Transportation', '< 1 KM', '', '', '', '', 'yes', 'yes', '-', '-', '-', NULL, '0', '', '0', '-', '', '', '', '-', '', '', '', 'Siswa Baru', NULL, '', '', '', '');

-- --------------------------------------------------------

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
-- Dumping data untuk tabel `tbl_09_det_character`
--

INSERT INTO `tbl_09_det_character` (`CtrlNo`, `NIS`, `FullName`, `Semester`, `schoolyear`, `Room`, `SubjName`, `Type`, `Description`, `Point`) VALUES
(1, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA (A)', 'Komputer', 'Social', 'Jujur', 4),
(2, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA (A)', 'Komputer', 'Social', 'Disiplin', 4),
(3, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA (A)', 'Komputer', 'Social', 'Tanggung Jawab', 4),
(4, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA (A)', 'Komputer', 'Social', 'Toleransi', 4),
(5, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA (A)', 'Komputer', 'Social', 'Gotong Royong', 4),
(6, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA (A)', 'Komputer', 'Social', 'Santun', 4),
(7, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA (A)', 'Komputer', 'Social', 'Percaya Diri', 4),
(8, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA (A)', 'Komputer', 'Spiritual', 'Berdoa sebelum melakukan kegiatan', 4),
(9, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA (A)', 'Komputer', 'Spiritual', 'Bersyukur setelah beraktivitas', 4),
(10, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA (A)', 'Komputer', 'Spiritual', 'Toleran pada agama yang berbeda', 4),
(11, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA (A)', 'Komputer', 'Spiritual', 'Taat beribadah', 4),
(12, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA (A)', 'Komputer', 'Spiritual', 'Memberi Salam dan bertegur sapa', 4);

-- --------------------------------------------------------

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
-- Dumping data untuk tabel `tbl_09_det_grades`
--

INSERT INTO `tbl_09_det_grades` (`CtrlNo`, `NIS`, `FullName`, `Semester`, `schoolyear`, `Class`, `Room`, `SubjName`, `KDRecapAvg`, `KDRecapAvg_SK`, `MidTest`, `MidRemedial`, `MidRecap`, `Final`, `FinalRemedial`, `FinalRecap`, `Absent`, `Report`, `Report_SK`, `Report_SOC`, `Report_SPR`, `Predicate`, `Predicate_SK`, `Predicate_SOC`, `Predicate_SPR`, `Description`, `Description_SK`, `Description_SOC`, `Description_SPR`) VALUES
(1, '220194', 'Aurily  Petiunaung', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '320196', 'Brayen  Tindatu', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '420198', 'Celiana  Tambaani', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '5201910', 'Charles  Ingkiriwang', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '6201912', 'Christy   Mangari', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '7201914', 'David  Legi', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '8201916', 'Ethan   Thomas', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '9201918', 'Fernando Saluy', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '11201922', 'Intan Kesso', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '12201924', 'Jennifer Mona', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '14201928', 'Jeril  Tanomonota', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '15201930', 'Leonard  Umar', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '16201932', 'Leuchen  Pinangkaan', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '17201934', 'Liana  Fambrene', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '18201936', 'Liony Prisilia  Mamangkey', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '19201938', 'Margareth  Rantung', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '20201940', 'Matthew  Lumantouw', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '21201942', 'Melody   Latuni', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '22201944', 'Michelle Sindua', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '23201946', 'Miracle  Daroel', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, '24201948', 'Mylene  Melope', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '25201950', 'Refanly   Nusa', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '26201952', 'Reivly  Wuisan', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '27201954', 'Riana  Keni', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '28201956', 'Steve J.  Megawe', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '29201958', 'Triana Virenza  Madil', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '0119160', 'Adam  Rumambi', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, 4, 4, NULL, NULL, 'A', 'A', NULL, NULL, 'Selalu konsisten bersikap', 'Selalu konsisten bersikap'),
(28, '3680', 'Given  Pantouw', 1, '2020/2021', 'X IPA', 'X IPA (A)', 'Komputer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

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
-- Dumping data untuk tabel `tbl_10_absent_std`
--

INSERT INTO `tbl_10_absent_std` (`CtrlNo`, `NIS`, `FullName`, `Semester`, `schoolyear`, `Kelas`, `Ruang`, `SubjDesc`, `Hour`, `Absent`, `Ket`) VALUES
(14, '220194', 'Aurily  Petiunaung', 2, '2019/2020', 'X IPA', 'X IPA (A)', NULL, NULL, '2020-03-05', 'Sick');

-- --------------------------------------------------------

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
-- Dumping data untuk tabel `tbl_11_enrollment`
--

INSERT INTO `tbl_11_enrollment` (`CtrlNo`, `FirstName`, `MiddleName`, `NickName`, `LastName`, `Gender`, `NISN`, `NIK`, `KK`, `DateofBirth`, `PointofBirth`, `BirthCertificate`, `Religion`, `Country`, `Disability`, `Address`, `RT`, `RW`, `Dusun`, `Village`, `District`, `Region`, `Postal`, `LiveWith`, `Transportation`, `Latitude`, `Longitude`, `Child`, `Siblings`, `KIP`, `Stayed_KIP`, `Refuse_PIP`, `Phone`, `HousePhone`, `Email`, `Father`, `FatherNIK`, `FatherBorn`, `FatherDegree`, `FatherJob`, `FatherIncome`, `FatherDisability`, `Mother`, `MotherNIK`, `MotherBorn`, `MotherDegree`, `MotherJob`, `MotherIncome`, `MotherDisability`, `Guardian`, `GuardianNIK`, `GuardianBorn`, `GuardianDegree`, `GuardianJob`, `GuardianIncome`, `GuardianDisability`, `Height`, `Weight`, `HeadDiameter`, `Range`, `ExactRange`, `TimeRange`, `Achievement`, `AchievementLVL`, `AchievementName`, `AchievementYear`, `Sponsor`, `AchievementRank`, `Scholarship`, `Scholardesc`, `Scholarstart`, `Scholarfinish`, `Prosperity`, `ProsperNumber`, `ProsperNameTag`, `Competition`, `Registration`, `NIS`, `SchoolStarts`, `PreviousSchool`, `UNNumber`, `Diploma`, `SKHUN`, `RegDate`) VALUES
(35, 'Abdul', '', '', 'Hafid', 'Perempuan', '0045630949', '', '', '1970-01-01', 'Manado', '', 'Kristen', 'Indonesia', '', 'LINGK I', '0', '0', '', 'LAPANGAN', 'Kec. Mapanget', '', '95258', 'With Parent', 'Public Transportation', '-0.9024', '119.8686', '2', '0', 'yes', '-', 'Menolak', '', '', '', 'ABD. HALID ALI', '', '', 'Tidak Sekolah', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', 'MARVINS FARIDA TENDA', '', '', 'Tidak Sekolah', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(36, 'Allen', 'Febryan Fandy', '', 'Salipada', 'Laki-Laki', '0059509490', '', '7172203040308000', '1970-01-01', 'Manado', '', 'Kristen', 'Indonesia', '', 'Lingkungan VI', '0', '0', '', 'Dendengan Dalam', 'Kec. Paal Dua', '', '', 'With Parent', 'Public Transportation', '', '', '1', '2', 'no', '-', '-', '', '', '', 'Agustinus Salipada', '', '1980', 'SMP Sederajat', '-', 'Rp. 500.000 - Rp. 999.999', '', 'MARLENI  TAKAWALUDE', '', '1986', 'SD Sederajat', 'Buruh', 'Rp. 500.000', '', '', '', '', '-', '-', '-', '', '145', '40', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', 'SMP NEGERI 5 BITUNG', '', '', '', '0000-00-00'),
(37, 'Anastasya', 'Cicilia', '', 'Willem', 'Perempuan', '0049044346', '', '', '2004-12-08', 'Tanawangko', '', 'Kristen', 'Indonesia', '', 'Aspol Paal 4', '0', '0', '', 'Paal 4', 'Kec. Paal Dua', '', '', 'With Parent', 'Public Transportation', '', '', '', '2', 'no', '-', '-', '', '', '', 'Sonny Willem', '', '1977', 'SMA Sederajat', 'PNS/TNI/POLRI', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'Yulita Lumantak', '', '1981', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '145', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', 'SMP ADVENT MAKALISUNG', '', '', '', '0000-00-00'),
(38, 'Aprianto', 'Rofly', '', 'Karame', 'Laki-Laki', '0044093092', '', '', '2004-11-04', 'MANADO', '', 'Kristen', 'Indonesia', '', 'LINGKUNGAN V', '0', '0', '', 'PANIKI SATU', 'Kec. Mapanget', '', '', 'With Parent', 'Public Transportation', '1.481336998', '124.8496413', '1', '0', 'no', '-', 'Menolak', '', '', '', 'FRANGKY KARAME', '', '', 'SMP Sederajat', 'Buruh', 'Rp. 500.000', '', 'ROSNA LUNGKANG', '', '', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(39, 'Aprianto', 'Rofly', '', 'Karame', 'Laki-Laki', '0044093092', '', '', '2004-11-04', 'MANADO', '', 'Kristen', 'Indonesia', '', 'LINGKUNGAN V', '0', '0', '', 'PANIKI SATU', 'Kec. Mapanget', '', '', 'With Parent', 'Public Transportation', '1.481336998', '124.8496413', '1', '0', 'no', '-', 'Menolak', '', '', '', 'FRANGKY KARAME', '', '', 'SMP Sederajat', 'Buruh', 'Rp. 500.000', '', 'ROSNA LUNGKANG', '', '', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(40, 'Brainy', 'Jewelry ', '', 'Suwuh', 'Perempuan', '0037165120', '', '', '2003-06-12', 'MANADO', '', 'Kristen', 'Indonesia', '', 'Manguni 8', '0', '0', '', 'Perkamil', 'Kec. Paal Dua', '', '95128', 'With Parent', 'Private Vehicle', '1.520290762', '124.8877287', '2', '0', 'no', '-', '-', '', '', '', 'Lendy Donald Winny Suwuh', '7171052206680021', '1968', 'D4/S1', 'Wiraswasta', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'WENDA MERRY CHRIST OROH', '', '1974', 'S2', 'PNS/TNI/POLRI', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(41, 'Christian', 'Mustamin', '', 'Azis', 'Laki-Laki', '0048821036', '', '', '1970-01-01', 'Manado', 'CSL 1667/2004', 'Kristen', 'Indonesia', '', 'Banjer Ling II', '0', '0', '', 'Banjer', 'Kec. Tikala', '', '', 'With Parent', 'Public Transportation', '', '', '1', '0', 'no', '-', '-', '', '', '', 'Mustakim B Abd Azis', '', '', 'D3', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', 'Noflin Kalangkahan', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', '', '', '', '-', '-', '-', '', '150', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(42, 'David', '', '', 'Pintunaung', 'Laki-Laki', '0049131755', '', '', '1970-01-01', 'Manado', '', 'Kristen', 'Indonesia', '', 'Kalasey', '', '', '', 'Kalasey', 'Kec. Mandolang', '', '95661', 'With Parent', 'Public Transportation', '', '', '1', '0', 'no', '-', '-', '', '', '', 'Hans Repli Pintunaung', '7102131105690001', '1969', 'SMA Sederajat', 'Wiraswasta', 'Rp. 500.000', '', 'Forni Pontowulaeng', '7102136704720001', '', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '150', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(43, 'Denada', 'Grace Cheren', '', 'Uring', 'Perempuan', '0069995449', '', '', '1970-01-01', 'Manado', '', 'Kristen', 'Indonesia', '', 'Tumumpa Dua Lingkungan I', '0', '0', 'Lingkungan I', 'Tumumpa Dua', 'Kec. Tuminting', '', '95238', 'With Parent', 'On Foot', '', '', '1', '0', 'yes', '-', 'Menolak', '', '', '', 'Reinald Uring', '7171020207700002', '1970', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'Wineke Tatebale', '', '1970', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '161', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', 'SMP Advent 5 Kairagi Weru', '', '', '', '0000-00-00'),
(44, 'Fransesco', 'Figo', '', 'Repu', 'Laki-Laki', '0048618487', '7171095109090039', '', '2004-11-11', 'Manado', '', 'Kristen', 'Indonesia', '', 'Perum Wenwin', '', '', '', 'Sea', 'Kec. Pineleng', '', '', 'With Parent', 'Public Transportation', '', '', '1', '0', 'no', '-', '-', '', '', '', 'Meidi Repu', '', '1977', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', 'Deybi Bawuka', '', '1978', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', '', '', '', '-', '-', '-', '', '166', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', 'SMP Advent 1 Tikala', '', '', '', '0000-00-00'),
(45, 'Gallant', 'Joshep', '', 'Kapondo', 'Laki-Laki', '0041001858', '7171706430604001', '', '1970-01-01', 'Amurang', '9271-LT-18072016-0002', 'Kristen', 'Indonesia', '', 'Perum Rizky Blok E. 26 Kalawat', '0', '0', '', 'Kalawat', 'Kec. Kalawat', '', '', 'With Parent', 'Public Transportation', '1.191', '124.7948', '1', '0', 'no', '-', '-', '', '', '', 'Moody Kapondo', '', '', 'D4/S1', '-', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'Welnike Mewar', '', '', 'D4/S1', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(46, 'Injilly', 'Rahel', '', 'Nayoan', 'Perempuan', '0046073276', '7171072405040001', '', '1970-01-01', 'Manado', '', 'Kristen', 'Indonesia', '', 'Teling', '0', '0', '', 'Teling', 'Kec. Wanea', '', '', 'With Parent', 'Public Transportation', '', '', '', '3', 'no', '-', '-', '', '', '', 'Billy Nayoan', '', '', 'Tidak Sekolah', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', 'Julia Masawet', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', '', '', '', '-', '-', '-', '', '155', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(47, 'Jennifer', '', '', 'Dotulong', 'Perempuan', '0050519679', '7102146803050001', '', '1970-01-01', 'Bontang', '1302/Disp/Mhs/2014', 'Kristen', 'Indonesia', '', 'Sawangan', '0', '0', '', 'Sawangan', 'Kec. Tombulu', '', '', 'With Parent', 'Public Transportation', '1.4634', '124.8286', '1', '0', 'no', '-', '-', '', '', '', 'James Dotulong', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'Mahda Koloay', '', '', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(48, 'Jerifel', 'Johan Rolan', '', 'Item', 'Laki-Laki', '0054536365', '7106031705050001', '', '1970-01-01', 'AIRMADIDI', '', 'Kristen', 'Indonesia', '', 'Sawangan', '0', '0', '', 'Sawangan', 'Kec. Airmadidi', '', '95371', 'With Parent', 'Public Transportation', '', '', '1', '0', 'no', '-', '-', '', '', '', 'Rolly Item', '', '1976', 'Tidak Sekolah', '-', 'Rp. 500.000', '', 'ANEKE MAWUNTU', '', '1970', 'SMP Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '153', '47', '', '> 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(49, 'Junius', '', '', 'Iren', 'Laki-Laki', '0008960235', '9202051905000001', '', '1970-01-01', 'KEMBES', '490/T/2005', 'Kristen', 'Indonesia', '', 'JL. DESA KEMBES 1', '', '', '7', 'KEMBES 1', 'Kec. Tombulu', '', '', 'With Guardian', 'On Foot', '1.520367', '124.845087', '2', '0', 'no', '-', 'Menolak', '', '', '', '', '', '', '-', '-', '-', '', '', '', '', '-', '-', '-', '', 'YOSEP MAYLANGKAI', '', '1951', 'SMP Sederajat', 'Petani', 'Rp. 500.000', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(50, 'Kevin', '', '', 'Kaseger', 'Laki-Laki', '0037898839', '7102063012030001', '', '1970-01-01', 'LANGOWAN', '', 'Kristen', 'Indonesia', '', 'KAWENG', '', '', 'JAGA VI', 'KAWENG', 'Kec. Kakas', '', '95682', 'With Parent', 'On Foot', '', '', '', '0', 'no', '-', 'Menolak', '', '', '', 'APRI KASEGER', '', '1977', 'SMA Sederajat', 'Petani', 'Rp. 500.000 - Rp. 999.999', '', 'LIVI TAMPUNG', '', '1984', 'SMA Sederajat', '-', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', '', '', '', '-', '-', '-', '', '150', '50', '', '> 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(51, 'Kivi', 'Jeno Johanes', '', 'Panda', 'Laki-Laki', '0047691849', '7171080806040002', '', '2004-08-06', 'MANADO', '7171LT2011001216', 'Kristen', 'Indonesia', '', 'LINGK. I', '0', '0', '', 'KAIRAGI SATU', 'Kec. Mapanget', '', '95253', 'With Parent', 'Public Transportation', '', '', '', '0', 'no', '-', '-', '', '', '', 'FRANGKY O. PANDA', '7171080110820002', '1982', 'SMA Sederajat', 'Buruh', 'Rp. 500.000', '', 'VIVI HAMBALI', '', '1984', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '155', '50', '', '> 1 KM', '4', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(52, 'Mumtaz', 'Mahal Pratiwi', '', 'Koyongian', 'Laki-Laki', '0048782547', '7171041908080001', '', '2004-11-04', 'Manado', '', 'Kristen', 'Indonesia', '', 'Teling Bawah Ling V', '0', '0', '', 'Teling', 'Kec. Wanea', '', '', 'With Parent', 'On Foot', '', '', '', '0', 'no', '-', '-', '', '', '', 'Temmy Koyongian', '', '', 'SMA Sederajat', 'Buruh', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', 'Yulin Yoseph', '', '', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '150', '45', '', '> 1 KM', '10', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(53, 'Pierre', 'Hizkia', '', 'Maengkom', 'Laki-Laki', '0035104988', '7171051004030004', '', '2003-10-04', 'Manado', '', 'Kristen', 'Indonesia', '', 'Taas Ling I No. 64', '0', '0', '', 'Taas', 'Kec. Tikala', '', '', 'With Parent', 'Public Transportation', '', '', '2', '2', 'no', '-', '-', '', '', '', 'Denny Maengkom', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', 'Maya Baraguna', '', '', 'SMA Sederajat', 'PNS/TNI/POLRI', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', '', '', '', '-', '-', '-', '', '158', '55', '', '> 1 KM', '5', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(54, 'Rayen', '', '', 'Supit', 'Laki-Laki', '0042778294', '7105161704040001', '', '1970-01-01', 'Kinamang', '', 'Kristen', 'Indonesia', '', 'Kinamang', '', '', '', 'Kinamang Satu', 'Kec. Maesaan', '', '95357', 'With Parent', 'On Foot', '', '', '', '1', 'no', '-', 'Menolak', '', '', '', 'Joseph Supit', '', '', 'Tidak Sekolah', '-', '-', '', 'Fike Masengi', '', '', 'Tidak Sekolah', '-', 'Rp. 500.000', '', '', '', '', '-', '-', '-', '', '167', '55', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', 'SMP PROVIDENSIA MANADO', '', '', '', '0000-00-00'),
(55, 'Ruben', 'Samuel', '', 'Ingkiriwang', 'Laki-Laki', '0040035735', '7171020602040003', '', '2004-06-02', 'Manado', '', 'Kristen', 'Indonesia', '', 'Sindulang Raya', '0', '0', '', 'Sindulang', 'Kec. Tuminting', '', '95235', 'With Parent', 'On Foot', '', '', '1', '1', 'no', '-', '-', '', '', '', 'Daniel Inkiriwang', '', '1966', 'SMA Sederajat', 'Wirausaha', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'MARTHA THEO', '', '1969', 'SMP Sederajat', '-', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', '', '', '', '-', '-', '-', '', '145', '47', '', '> 1 KM', '16', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(56, 'Shelomita', 'Priscila', '', 'Siging', 'Perempuan', '0055007760', '7171086806050001', '', '1970-01-01', 'TAHUNA', '1022/U/JU/2004', 'Kristen', 'Indonesia', '', 'LINGKUNGAN V', '0', '0', '', 'KAIRAGI SATU', 'Kec. Mapanget', '', '95253', 'With Parent', 'Public Transportation', '1.4949', '124.8755', '', '0', 'no', '-', '-', '', '', '', 'FREDRICK SIGING', '7171082507690001', '1969', 'SD Sederajat', 'Buruh', 'Rp. 500.000', '', 'SYANET BARAHAMA', '', '1971', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(57, 'Vanesa', 'M', '', 'Madellu', 'Perempuan', '0030066428', '7106075207030001', '', '2003-12-07', 'Wineru', '', 'Kristen', 'Indonesia', '', 'Jl. Raya Likupang Wineru', '0', '0', 'Wineru', 'Wineru', 'Kec. Likupang Timur', '', '95375', 'With Parent', 'On Foot', '', '', '2', '0', 'no', '-', '-', '', '', '', 'Dwight Madelu', '', '1984', 'SMA Sederajat', 'Wiraswasta', 'Rp. 500.000 - Rp. 999.999', '', 'Sentya  Tahulending', '', '1980', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '153', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(58, 'Virgilio ', '', '', 'Tambun', 'Laki-Laki', '0041385016', '7110041711040001', '', '1970-01-01', 'Kotamobagu', '', 'Kristen', 'Indonesia', '', 'Bongkudai Baru', '', '', '', 'Bongkudai Baru', 'Kec. Modayag', '', '', 'With Parent', 'On Foot', '', '', '1', '1', 'yes', '-', '-', '', '', '', 'Ari Tambun', '', '', 'Tidak Sekolah', '-', '-', '', 'Meiske Rori', '', '', 'Tidak Sekolah', '-', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', '', '', '', '-', '-', '-', '', '155', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(59, 'William ', 'Jonathan Ronald', '', 'Manueke', 'Laki-Laki', '0054032911', '7171050509040021', '', '2004-05-09', 'Manado', '', 'Kristen', 'Indonesia', '', 'Jl. Lengkong Wuaya Paal 2', '0', '0', '', 'Paal 2', 'Kec. Paal Dua', '', '', 'With Parent', 'Public Transportation', '', '', '1', '0', 'no', '-', '-', '', '', '', 'Teddy Manueke', '', '', 'S2', 'Wirausaha', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'Susan Palilingan', '', '', 'D4/S1', 'Wirausaha', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', '', '', '', '-', '-', '-', '', '166', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', 'SMP Prisma Manado', '', '', '', '0000-00-00'),
(61, 'Aaron', 'Artha Sastra Jeheskiel', '', 'Rawung', 'Laki-Laki', '0049036008', '7171040405040001', '', '2004-05-04', 'MANADO', '', 'Kristen', 'Indonesia', '', 'PERUMAHAN GRIYA PANIKI INDAH JL. ANGGREK C. NO. 18', '0', '0', '', 'BUHA', 'Kec. Mapanget', '', '', 'With Parent', 'Public Transportation', '', '', '1', '2', 'no', '-', '-', '', '', '', 'EVERLY RAWUNG', '7171041202790001', '1979', 'D4/S1', 'PNS/TNI/POLRI', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'ALNY O. ROMPAS', '', '1972', 'D3', 'PNS/TNI/POLRI', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', '', '', '', '-', '-', '-', '', '150', '42', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(62, 'Alexandra', 'Jennifer Angelica', '', 'Tompunu', 'Perempuan', '0037825020', '7171075108030002', '', '2003-08-11', 'MEDAN', '', 'Kristen', 'Indonesia', '', 'Karombasan Lk.3 No 13', '0', '0', '', 'Karombasan Lk.3 No 13', 'Kec. Wanea', '', '', 'With Parent', 'Public Transportation', '1.460851675', '124.8522377', '1', '0', 'no', '-', 'Menolak', '', '', '', 'Charles Thessy Tompunu', '7171072703780026', '1978', 'D4/S1', 'Karyawan Swasta', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'Debby Pondaag', '7171074101780002', '', 'D4/S1', 'Karyawan Swasta', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(63, 'Calvin', 'George', '', 'Najoan', 'Laki-Laki', '0032317728', '', '', '2003-06-23', 'Kumersot', '7210-LT-26092017-0017', 'Kristen', 'Indonesia', '', 'Teling Bawah', '', '', '', 'Teling', 'Kec. Wanea', '', '', 'With Parent', 'Public Transportation', '', '', '1', '3', 'no', '-', '-', '', '', '', 'Hard Najoan', '', '', 'SMA Sederajat', 'Buruh', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', 'Yuliana Kalimpoti', '', '', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '152', '55', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(64, 'David', 'Patrick', '', 'Lengkong', 'Laki-Laki', '0037772872', '7171070812030001', '', '2003-12-08', 'Manado', '', 'Kristen', 'Indonesia', '', 'Tanjung Batu', '', '', 'Lima', 'Tanjung batu', 'Kec. Wanea', '', '', 'With Parent', 'Public Transportation', '', '', '1', '1', 'yes', '-', 'Menolak', '', '', '', 'Djainfri Lengkong', '', '1971', 'SMA Sederajat', '-', '-', '', 'Mieske Kaumpungan', '', '1981', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '145', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(65, 'Drew', '', '', 'Kyoko', 'Perempuan', '0049884225', '7171092107040001', '', '2004-07-21', 'Manado', '', 'Kristen', 'Indonesia', '', 'Malalayang 1 Timur', '', '', '', 'Malalayang 1', 'Kec. Malalayang', '', '95163', 'With Parent', 'Public Transportation', '1.4549', '124.8125', '1', '0', 'no', '-', 'Menolak', '', '', '', 'Bobby Manawan', '7171092604760001', '1976', 'D3', 'Wiraswasta', 'Rp. 500.000', '', 'Conny Lalogirot', '', '1980', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(66, 'Endhita', 'Zefanya', '', 'Rifai', 'Perempuan', '0034518253', '', '', '2003-07-15', '', '', 'Kristen', 'Indonesia', '', 'Maumbi', '', '', '', 'Maumbi', 'Kec. Kalawat', '', '', 'With Parent', 'Private Vehicle', '1.1906', '124.7948', '1', '0', 'no', '-', '-', '', '', '', 'Henrif Rifai', '', '', 'D4/S1', 'Karyawan Swasta', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'Denia Sinta', '', '', 'D4/S1', 'Tidak Bekerja', '-', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(67, 'Enrico', 'Hendrik Henokh', '', 'Rumambi', 'Laki-Laki', '0036162620', '7171080609030001', '', '2003-08-06', 'Manado', '', 'Kristen', 'Indonesia', '', 'Bengkol', '0', '0', 'Lingkungan I', 'Bengkol', 'Kec. Mapanget', '', '', 'With Parent', 'Public Transportation', '', '', '4', '0', 'no', '-', '-', '', '', '', 'Dolphy B Rumambi', '7171082004630001', '1963', 'SMA Sederajat', 'Buruh', 'Rp. 500.000', '', 'Yeany Mamengko', '7171086911690042', '1969', 'SMA Sederajat', '-', 'Rp. 500.000', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(68, 'Falentino', 'Marky', '', 'Tombeng', 'Laki-Laki', '0044390324', '7171070702040001', '', '2004-02-07', 'MANADO', '', 'Kristen', 'Indonesia', '', 'PERUM PUSKOPAD B LING 6', '', '', '', 'PANIKI BAWAH', 'Kec. Mapanget', '', '', 'With Parent', 'Public Transportation', '1.459393027', '124.9251938', '', '0', 'no', '-', 'Menolak', '', '', '', 'NICSON TOMBENG', '', '1978', 'SMA Sederajat', '-', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'PRICILLIA KALOH', '', '1982', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(69, 'Febiola', 'Lois', '', 'Nalangtiho', 'Perempuan', '0025950770', '7103106807020001', '', '2002-07-28', 'Lapango', '', 'Kristen', 'Indonesia', '', 'Mahena', '', '', '', 'Mahena', 'Kec. Tahuna', '', '', 'With Guardian', 'On Foot', '', '', '', '1', 'no', '-', '-', '', '', '', 'Darlin Nalantiho', '', '1974', 'SMA Sederajat', 'Petani', 'Rp. 500.000', '', 'Martince Andris', '', '1979', 'SMP Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '157', '54', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(70, 'Federicho', 'Daniel', '', 'Sunardiyanta', 'Laki-Laki', '0039728989', '3174123456000016', '', '2003-04-08', 'MANADO', '', 'Kristen', 'Indonesia', '', 'JL. HARSONO RM KOMPLEK GOR RAGUNAN', '9', '7', '', 'RAGUNAN', 'Kec. Pasar Minggu', '', '12550', 'Dormitory', 'On Foot', '', '', '', '0', 'no', '-', 'Menolak', '', '', '', 'SURNARDIYANTA', '', '1979', 'SMA Sederajat', 'PNS/TNI/POLRI', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'LIDIA ROMPAS', '', '1984', 'Tidak Sekolah', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '2003-04-08', '', '', '', '', '0000-00-00'),
(71, 'Fredlen', 'Christo Sampouw', '', 'Lumintang', 'Laki-Laki', '0048845287', '', '', '2004-01-13', 'MANADO', '001/Disp/Mhs/2014', 'Kristen', 'Indonesia', '', 'Kampus SLA Tompaso', '', '', '', 'Tompaso 2', 'Kec. Tompaso Barat', '', '95693', 'With Parent', 'On Foot', '', '', '', '0', 'no', '-', '-', '', '', '', 'MICHAEL LUMINTANG', '', '1970', 'D4/S1', '-', '-', '', 'FRANSINA SAMPOUW', '', '1975', 'D4/S1', '-', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', '', '', '', '-', '-', '-', '', '156', '53', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', 'SMP Advent 2 Sario', '', '', '', '0000-00-00'),
(72, 'Giftny', 'Charity', '', 'Mahingkalo', 'Perempuan', '0020408908', '7171034112020002', '', '2002-12-01', 'MANADO', '', 'Kristen', 'Indonesia', '', 'LINGKUNGAN 1', '', '', '', 'SINGKIL', 'Kec. Singkil', '', '', 'With Parent', 'Public Transportation', '', '', '1', '0', 'yes', '-', 'Menolak', '', '', '', 'WILSON MAHINGKALO', '', '1969', 'SMA Sederajat', '-', 'Rp. 500.000 - Rp. 999.999', '', 'NOVA PAPONA', '', '1972', '-', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '145', '45', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(73, 'Johanis', 'Fabio Marcello', '', 'Rachman', 'Laki-Laki', '0038743218', '7171042308030001', '', '2003-08-23', 'MANADO', '', 'Kristen', 'Indonesia', '', 'Perum Griya 4', '', '', '', 'Lapangan', 'Kec. Talawaan', '', '', 'With Parent', 'Public Transportation', '', '', '1', '0', 'yes', '-', 'Menolak', '', '', '', 'Robby Abidin Rachman', '', '1967', 'D4/S1', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', 'BETTY ADRIANA MELLY LAPIAN', '', '1972', 'SMA Sederajat', '-', '-', '', '', '', '', '-', '-', '-', '', '156', '60', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(74, 'Joshua', 'Leonardo', '', 'Tengker', 'Laki-Laki', '0033728693', '7171042512030003', '', '2003-12-25', 'Manado', '', 'Kristen', 'Indonesia', '', 'Mahakeret Timur Ling IV', '', '', '', 'Teling', 'Kec. Wenang', '', '', 'With Parent', 'Public Transportation', '', '', '2', '1', 'no', '-', '-', '', '', '', 'Novie Tengker', '', '', 'D3', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', 'Etni Gogani', '', '', 'D3', 'PNS/TNI/POLRI', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', '', '', '', '-', '-', '-', '', '165', '55', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', 'SMP Dapena 1 Kota Surabaya', '', '', '', '0000-00-00'),
(75, 'Juan', 'Michael', '', 'Salainti', 'Laki-Laki', '0037790972', '7106082110030001', '', '2003-10-20', 'PEMUTERAN', '', 'Kristen', 'Indonesia', '', 'WATUTUMOUW III', '', '', '', 'WATUTUMOU', 'Kec. Kalawat', '', '', 'With Parent', 'Public Transportation', '', '', '1', '0', 'no', '-', '-', '', '', '', 'RICKY SALAINTI', '', '1972', 'SMA Sederajat', '-', 'Rp. 500.000 - Rp. 999.999', '', 'KOMANG YUDIARSIH', '', '1978', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(76, 'Matius', 'Alexander Sandy', '', 'Mataputung', 'Laki-Laki', '0044093093', '7171081205040061', '', '2004-05-12', 'MANADO', '', 'Kristen', 'Indonesia', '', 'LINGKUNGAN IV', '', '', '', 'LAPANGAN', 'Kec. Mapanget', '', '', 'With Guardian', 'On Foot', '1.412018637', '124.998976', '1', '0', 'no', '-', 'Menolak', '', '', '', 'JULIANUS MATAPUTUNG', '', '1965', 'SMA Sederajat', '-', '-', '', 'NONTJE N. ALIA', '', '1967', '-', '-', '-', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(77, 'Mikhael', 'Mathew Eifflel', '', 'Tamuntuan', 'Laki-Laki', '0047299482', '', '', '2004-05-05', 'Manado', '', 'Kristen', 'Indonesia', '', 'Taas Ling III', '', '', '', 'Taas', 'Kec. Wenang', '', '', 'With Parent', 'Private Vehicle', '', '', '2', '1', 'no', '-', 'Menolak', '', '', '', 'Jefry Tamuntuan', '', '', 'SMA Sederajat', 'Wiraswasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', 'Judy Loupahy', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', '', '', '', '-', '-', '-', '', '160', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(78, 'Milka', 'Florensia', '', 'Antou', 'Perempuan', '0038674601', '7110045510030002', '', '2003-10-15', 'Modayag', '', 'Kristen', 'Indonesia', '', 'Tikala', '0', '0', '', 'Perkamil', 'Kec. Tikala', '', '95695', 'With Guardian', 'On Foot', '1.1906', '124.7948', '2', '0', 'no', '-', '-', '', '', '', 'Grace Antou', '7110041905780002', '1978', 'SMA Sederajat', '-', 'Rp. 500.000 - Rp. 999.999', '', 'Sefia Jeane Kolondam', '7171056609830022', '', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '168', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', 'SMP NEGERI 1 POIGAR', '', '', '', '0000-00-00'),
(79, 'Monalisa', 'Monica Muntu', '', 'Untu', 'Perempuan', '0035484688', '', '', '2003-06-12', 'MANADO', '', 'Kristen', 'Indonesia', '', 'KAIRAGI DUA', '', '', '', 'KAIRAGI DUA', 'Kec. Mapanget', '', '', 'With Parent', 'On Foot', '', '', '1', '2', 'no', '-', 'Menolak', '', '', '', 'SAMUEL MUNTUUNTU', '', '', '-', '-', '-', '', 'NUR\'AIN MUSTAFA', '', '', '-', '-', '-', '', '', '', '', '-', '-', '-', '', '130', '28', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(80, 'Putri', 'I. A', '', 'Wagiu', 'Perempuan', '0033824223', '7106056307030003', '', '2003-06-23', 'Tatelu', '', 'Kristen', 'Indonesia', '', 'Desa Tinongko', '', '', '', 'Mantehage Tinongko', 'Kec. Wori', '', '', 'With Guardian', 'On Foot', '', '', '1', '1', 'no', '-', '-', '', '', '', 'Novi Wagiu', '7106051711700003', '1970', 'SMP Sederajat', 'Petani', 'Rp. 500.000 - Rp. 999.999', '', 'Yorina Timbalau', '7106056401760001', '1976', 'SMP Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '152', '50', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(81, 'Ribka', 'Puteri', '', 'Kalaseran', 'Laki-Laki', '0034420963', '', '', '2003-06-06', 'MANADO', '', 'Kristen', 'Indonesia', '', 'Jl Diponegoro No.103 Kel. Makeret', '0', '0', '', 'Jl Diponegoro No.103 Kel. Makeret', 'Kec. Wenang', '', '', 'With Parent', 'Public Transportation', '', '', '1', '0', 'yes', '-', '-', '', '', '', 'Manongka Jeffry Kalesaran', '', '', 'SMA Sederajat', '-', '-', '', 'Steavie Y Sondak', '', '', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '155', '45', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', 'SMP ADVENT LEMOSIRANINDI', '', '', '', '0000-00-00'),
(82, 'Riedel', 'Koos', '', 'Warikkie', 'Laki-Laki', '0039318544', '', '', '2003-08-23', 'Matungkas', '', 'Kristen', 'Indonesia', '', 'Mapanget', '0', '0', 'Mapanget', 'Tetey', 'Kec. Talawaan', '', '', 'With Parent', 'On Foot', '', '', '1', '0', 'no', '-', '-', '', '', '', 'Marlon Warikkie', '', '1973', '-', '-', '-', '', 'Novita K Mamelas', '', '1983', '-', '-', '-', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(83, 'Shellyn', 'Natasha', '', 'Salainti', 'Laki-Laki', '0031981190', '', '', '2003-08-17', 'SORONG', '', 'Kristen', 'Indonesia', '', 'Mapanget', '', '', '', 'Mapanget', 'Kec. Mapanget', '', '', 'With Parent', 'Public Transportation', '', '', '1', '0', 'no', '-', 'Menolak', '', '', '', 'Paul Harry Salainty', '', '', 'SMA Sederajat', '-', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'Leidy E. Weol', '', '', 'Tidak Sekolah', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '166', '52', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', 'SMP ADVENT 4 PAAL DUA', '', '', '', '0000-00-00'),
(84, 'Tesalonika', '', '', 'Emor', 'Perempuan', '0032666311', '', '', '2003-06-20', 'Palu', '', 'Kristen', 'Indonesia', '', 'Jl. Suprapto', '0', '0', '', 'Tikala', 'Kec. Wenang', '', '95124', 'With Parent', 'On Foot', '', '', '', '0', 'no', '-', 'Menolak', '', '', '', 'Rudy Emor', '', '', 'SMA Sederajat', 'Petani', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', 'Gladys Kembuan', '', '', 'SMA Sederajat', 'Karyawan Swasta', 'Rp. 2.0000.0000 - Rp. 4.999.999', '', '', '', '', '-', '-', '-', '', '', '', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00'),
(85, 'Amelia', 'Kimberli', '', 'Sanusi', 'Perempuan', '0040310161', '7171054503040002', '', '2004-03-05', 'TOMOHON', '9271.LT.24022014.0014', 'Kristen', 'Indonesia', '', 'Perum Liwas Permai', '0', '0', '', 'Paal Dua', 'Kec. Paal Dua', '', '', 'With Parent', 'Public Transportation', '1.4159', '124.7193', '1', '2', 'no', '-', 'Menolak', '', '', '', 'David Sanusi', '', '1974', 'SMA Sederajat', 'Wiraswasta', 'Rp. 1.0000.0000 - Rp. 1.999.9999', '', 'SHINTA GRACE SEPANG', '', '1976', 'SMA Sederajat', 'Tidak Bekerja', 'Tidak Berpenghasilan', '', '', '', '', '-', '-', '-', '', '152', '60', '', '< 1 KM', '', '', 'None', 'None', '', '0', '', '0', 'None', '', '', '', '-', '', '', '', 'Siswa Baru', '', '1970-01-01', '', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_12_finance_std`
--

CREATE TABLE `tbl_12_finance_std` (
  `CtrlNo` int(64) NOT NULL,
  `NIS` varchar(64) NOT NULL,
  `Name` varchar(512) NOT NULL,
  `Kelas` varchar(128) NOT NULL,
  `Semester` int(10) NOT NULL,
  `SchoolYear` varchar(32) NOT NULL,
  `TuitionCat` enum('A','B','C','D','E') NOT NULL,
  `Amount` int(128) NOT NULL,
  `Month1` enum('paid','notpaid') NOT NULL DEFAULT 'notpaid',
  `Month1_Paid` date DEFAULT NULL,
  `Month2` enum('paid','notpaid') NOT NULL DEFAULT 'notpaid',
  `Month2_Paid` date DEFAULT NULL,
  `Month3` enum('paid','notpaid') NOT NULL DEFAULT 'notpaid',
  `Month3_Paid` date DEFAULT NULL,
  `Month4` enum('paid','notpaid') NOT NULL DEFAULT 'notpaid',
  `Month4_Paid` date DEFAULT NULL,
  `Month5` enum('paid','notpaid') NOT NULL DEFAULT 'notpaid',
  `Month5_Paid` date DEFAULT NULL,
  `Month6` enum('paid','notpaid') NOT NULL DEFAULT 'notpaid',
  `Month6_Paid` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

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
-- Dumping data untuk tabel `tbl_credentials`
--

INSERT INTO `tbl_credentials` (`CtrlNo`, `IDNumber`, `status`, `password`) VALUES
(150, 'abase', 'admin', 'e10adc3949ba59abbe56e057f20f883e'),
(209, '0000001', 'teacher', 'e10adc3949ba59abbe56e057f20f883e'),
(210, '0000002', 'staff', 'e10adc3949ba59abbe56e057f20f883e'),
(211, '0000003', 'teacher', 'e10adc3949ba59abbe56e057f20f883e'),
(212, '0000004', 'teacher', 'e10adc3949ba59abbe56e057f20f883e'),
(214, '220194', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(215, '320196', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(216, '420198', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(217, '5201910', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(218, '6201912', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(219, '7201914', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(220, '8201916', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(221, '9201918', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(223, '11201922', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(224, '12201924', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(225, '14201928', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(226, '15201930', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(227, '16201932', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(228, '17201934', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(229, '18201936', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(230, '19201938', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(231, '20201940', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(232, '21201942', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(233, '22201944', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(234, '23201946', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(235, '24201948', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(236, '25201950', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(237, '26201952', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(238, '27201954', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(239, '28201956', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(240, '29201958', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(243, '0000021', 'teacher', 'e10adc3949ba59abbe56e057f20f883e'),
(244, '0000022', 'teacher', 'e10adc3949ba59abbe56e057f20f883e'),
(245, '0000023', 'teacher', 'e10adc3949ba59abbe56e057f20f883e'),
(246, '0000029', 'staff', 'e10adc3949ba59abbe56e057f20f883e'),
(247, '0000030', 'staff', 'e10adc3949ba59abbe56e057f20f883e'),
(248, '0000031', 'staff', 'e10adc3949ba59abbe56e057f20f883e'),
(249, '0000005', 'staff', 'e10adc3949ba59abbe56e057f20f883e'),
(250, '0119160', 'student', 'e10adc3949ba59abbe56e057f20f883e'),
(268, '3680', 'student', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

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
(1, 'SD', 0, 0, 0, 0),
(2, 'SMP', 0, 0, 0, 0),
(3, 'SMA', 75, 75, 75, 75),
(4, 'SMK', 0, 0, 0, 0);

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
(1, 'SD', 'Cognitive', 0, 100, 50, 50),
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
  ADD KEY `NIS` (`NIS`),
  ADD KEY `Kelas` (`Kelas`),
  ADD KEY `Ruangan` (`Ruangan`),
  ADD KEY `NIS_2` (`NIS`),
  ADD KEY `Kelas_2` (`Kelas`,`Ruangan`);

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
-- Indeks untuk tabel `tbl_12_finance_std`
--
ALTER TABLE `tbl_12_finance_std`
  ADD PRIMARY KEY (`CtrlNo`),
  ADD KEY `NIS_FINANCE_FK` (`NIS`),
  ADD KEY `Ruang_Finance_FK` (`Kelas`);

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
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_03_class`
--
ALTER TABLE `tbl_03_class`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `tbl_04_class_rooms`
--
ALTER TABLE `tbl_04_class_rooms`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_06_schedule_nonregular`
--
ALTER TABLE `tbl_06_schedule_nonregular`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_07_personal_bio`
--
ALTER TABLE `tbl_07_personal_bio`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

--
-- AUTO_INCREMENT untuk tabel `tbl_08_job_info`
--
ALTER TABLE `tbl_08_job_info`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `tbl_08_job_info_std`
--
ALTER TABLE `tbl_08_job_info_std`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT untuk tabel `tbl_09_det_character`
--
ALTER TABLE `tbl_09_det_character`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_09_det_grades`
--
ALTER TABLE `tbl_09_det_grades`
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `CtrlNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

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
-- Ketidakleluasaan untuk tabel `tbl_06_schedule`
--
ALTER TABLE `tbl_06_schedule`
  ADD CONSTRAINT `RoomDesc` FOREIGN KEY (`RoomDesc`) REFERENCES `tbl_04_class_rooms` (`RoomDesc`) ON UPDATE CASCADE,
  ADD CONSTRAINT `RoomID` FOREIGN KEY (`RoomID`) REFERENCES `tbl_04_class_rooms` (`RoomID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_08_job_info`
--
ALTER TABLE `tbl_08_job_info`
  ADD CONSTRAINT `IDNumber` FOREIGN KEY (`IDNumber`) REFERENCES `tbl_07_personal_bio` (`IDNumber`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_08_job_info_std`
--
ALTER TABLE `tbl_08_job_info_std`
  ADD CONSTRAINT `Kelas` FOREIGN KEY (`Kelas`) REFERENCES `tbl_03_class` (`ClassDesc`) ON UPDATE CASCADE,
  ADD CONSTRAINT `NIS_FK` FOREIGN KEY (`NIS`) REFERENCES `tbl_07_personal_bio` (`IDNumber`) ON DELETE CASCADE,
  ADD CONSTRAINT `Ruangan` FOREIGN KEY (`Ruangan`) REFERENCES `tbl_04_class_rooms` (`RoomDesc`) ON UPDATE CASCADE;

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
