-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2019 at 03:22 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_proyek`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `nik` char(16) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `prodi` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`nik`, `nama`, `jenis_kelamin`, `no_telp`, `prodi`) VALUES
('3217061702990009', 'Luthfi Admin', 'L', '087738406127', '14'),
('3217061702990010', 'Luthfi D3', 'L', '087738406127', '13');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `user_add_admin` AFTER INSERT ON `admin` FOR EACH ROW BEGIN
INSERT INTO USER VALUES(new.nik, new.nik, 'A');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_delete_admin` AFTER DELETE ON `admin` FOR EACH ROW BEGIN
DELETE FROM USER WHERE id_user = old.nik;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan`
--

CREATE TABLE `bimbingan` (
  `id_bimbingan` int(24) NOT NULL,
  `tgl_bimbingan` date NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `catatan` varchar(300) NOT NULL,
  `status_bimbingan` int(1) NOT NULL,
  `id_proyek` int(16) NOT NULL,
  `nilai_bimbingan` int(100) NOT NULL DEFAULT '0',
  `id_kegiatan_progress` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan_progress`
--

CREATE TABLE `bimbingan_progress` (
  `id_bimbingan_progress` int(36) NOT NULL,
  `nama_progress` varchar(55) NOT NULL,
  `status_penyelesaian` int(1) NOT NULL,
  `id_bimbingan` int(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nik` char(16) NOT NULL,
  `nama` varchar(75) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(35) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `judul_jurnal` varchar(150) DEFAULT NULL,
  `link_jurnal` varchar(150) DEFAULT NULL,
  `research_interest` varchar(500) DEFAULT NULL,
  `prodi` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nik`, `nama`, `tgl_lahir`, `tempat_lahir`, `alamat`, `judul_jurnal`, `link_jurnal`, `research_interest`, `prodi`) VALUES
('3217061702990001', 'Luthfi 4', '2019-09-24', 'Bandung', 'b', 'Coba', 'google.com', 'Riset Doang', '13'),
('3217061702990002', 'Luthfi 5', '2019-09-24', 'Bandung', 'b', 'Coba', 'google.com', 'Riset Doang', '13'),
('3217061702990004', 'Luthfi', '2019-09-21', 'Bandung', 'bb', 'qwfwq', 'aa.com', 'Cpbaom', '14'),
('3217061702990005', 'Luthfi 2q', '2019-09-05', 'Bandung', 'cc', 'Cobain Aja Googl', 'google.com', 'Coba', '14'),
('3217061702990006', 'Luthfi 3', '2019-09-04', 'Bandung', 'AJbfuiqwfwq', 'qfqwwqf', 'abc.com', 'CCC', '14'),
('3217061702990007', 'Luthfi 5', '2019-09-04', 'Bandung', 'AJbfuiqwfwq', 'qfqwwqf', 'abc.com', 'CCC', '14');

--
-- Triggers `dosen`
--
DELIMITER $$
CREATE TRIGGER `user_add_dosen` AFTER INSERT ON `dosen` FOR EACH ROW BEGIN
INSERT INTO USER VALUES(new.nik, new.nik, 'D');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_delete_dosen` AFTER DELETE ON `dosen` FOR EACH ROW BEGIN
DELETE FROM USER WHERE id_user = old.nik;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(8) NOT NULL,
  `prodi` char(2) NOT NULL,
  `nama_kegiatan` varchar(40) NOT NULL,
  `jenis_kegiatan` int(2) DEFAULT NULL,
  `id_koordinator` char(16) NOT NULL,
  `status_mulai` int(1) NOT NULL,
  `angkatan` varchar(9) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `semester` char(1) NOT NULL,
  `min_bimbingan` int(2) NOT NULL,
  `persentase_sidang` int(3) NOT NULL,
  `persentase_bimbingan` int(3) NOT NULL,
  `persentase_progress` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `prodi`, `nama_kegiatan`, `jenis_kegiatan`, `id_koordinator`, `status_mulai`, `angkatan`, `tgl_mulai`, `tgl_selesai`, `semester`, `min_bimbingan`, `persentase_sidang`, `persentase_bimbingan`, `persentase_progress`) VALUES
(18, '14', 'Proyek I', NULL, '3217061702990004', 1, '2017/2018', '2019-10-01', '2019-10-09', '1', 10, 0, 0, 0),
(19, '14', 'Proyek II', NULL, '3217061702990005', 0, '2017/2018', '2019-10-01', '2019-10-09', '2', 22, 11, 0, 0),
(20, '13', 'Coba', NULL, '3217061702990001', 1, '2017/2018', '2019-10-09', '2019-10-24', '4', 10, 0, 0, 0),
(21, '14', 'qfqwf', NULL, '3217061702990005', 0, '2', '2019-10-17', '2019-10-31', '1', 8, 43, 57, 0),
(22, '13', 'proyekyej', NULL, '3217061702990001', 1, '2', '2019-10-29', '2019-10-29', '1', 9, 80, 20, 0),
(26, '14', 'saf', NULL, '3217061702990004', 1, '2', '0000-00-00', '0000-00-00', '1', 8, 50, 50, 0),
(27, '13', 'asfsa', NULL, '3217061702990001', 1, '2', '1970-01-23', '1970-01-15', '1', 8, 50, 50, 0),
(28, '13', 'Proyek Coba', NULL, '3217061702990002', 0, '2017/2018', '2019-11-09', '2019-11-22', '2', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_progress`
--

CREATE TABLE `kegiatan_progress` (
  `id_kegiatan_progress` int(11) NOT NULL,
  `judul_progress` varchar(55) NOT NULL,
  `id_kegiatan` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_progress`
--

INSERT INTO `kegiatan_progress` (`id_kegiatan_progress`, `judul_progress`, `id_kegiatan`) VALUES
(1, 'afsafa', 19),
(2, 'aazvsaf', 19),
(3, 'aazvsafwwq', 19),
(4, '1', 19),
(6, 'CC', 18),
(7, 'aaa', 18);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` char(7) NOT NULL,
  `nama` varchar(75) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `angkatan` varchar(9) DEFAULT NULL,
  `tempat_lahir` varchar(35) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `prodi` int(2) DEFAULT NULL,
  `semester` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama`, `alamat`, `angkatan`, `tempat_lahir`, `tgl_lahir`, `prodi`, `semester`) VALUES
('1173001', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173002', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173003', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173004', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173005', 'Anak De Tiga', '', '2017/2018', '', '0000-00-00', 13, 3),
('1173006', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173007', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173008', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173009', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173010', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173011', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173012', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173013', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173014', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173015', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173016', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173017', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173018', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173019', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173020', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173021', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173022', 'Anak Tiga De', 'asfasfafa', '2017/2018', '', '0000-00-00', 13, 5),
('1173023', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173024', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173025', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173026', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173027', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173028', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173029', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173030', 'Anak Tiga De', '', '2017/2018', '', '0000-00-00', 13, 5),
('1173031', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173032', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173033', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173034', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173035', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173036', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173037', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173038', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173039', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173040', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173041', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173042', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173043', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173044', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173045', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173046', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173047', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173048', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173049', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173050', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173051', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173052', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173053', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173054', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173055', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173056', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173057', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173058', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173059', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173060', 'Tiga Anak De', '', '2017/2018', '', '0000-00-00', 13, 4),
('1173061', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173062', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173063', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173064', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173065', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173066', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173067', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173068', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173069', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173070', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173071', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173072', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173073', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173074', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173075', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173076', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173077', 'Anak De Tiga', '', '2017/2018', '', '0000-00-00', 13, 1),
('1173078', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173079', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173080', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173081', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173082', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173083', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173084', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173085', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173086', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173087', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173088', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173089', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173090', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173091', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173092', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173093', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173094', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173095', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173096', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173097', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173098', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173099', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173100', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173101', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173102', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173103', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173104', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173105', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173106', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173107', 'Tiga De Anak', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173108', 'Tiga Anak De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173109', 'Anak De Tiga', NULL, '2017/2018', NULL, NULL, 13, 1),
('1173110', 'Anak Tiga De', NULL, '2017/2018', NULL, NULL, 13, 1),
('1174001', 'Luthfi', 'Bandung', '2', 'Bandung', '2019-10-15', 14, 1),
('1174002', 'Hagan', NULL, '2017/2018', NULL, NULL, 14, 1),
('1174003', 'Tia', NULL, '2017/2018', NULL, NULL, 14, 1),
('1174004', 'Luthfi', NULL, '2017/2018', NULL, NULL, 14, 1),
('1174005', 'Hagan', NULL, '2017/2018', NULL, NULL, 14, 1),
('1174006', 'Tia', NULL, '2017/2018', NULL, NULL, 14, 1),
('1174007', 'Luthfi', NULL, '2017/2018', NULL, NULL, 14, 1),
('1174008', 'Hagan', NULL, '2017/2018', NULL, NULL, 14, 1),
('1174009', 'Tia', NULL, '2017/2018', NULL, NULL, 14, 1),
('1174010', 'Luthfi', NULL, '2017/2018', NULL, NULL, 14, 1);

--
-- Triggers `mahasiswa`
--
DELIMITER $$
CREATE TRIGGER `user_add_mahasiswa` AFTER INSERT ON `mahasiswa` FOR EACH ROW begin
insert into user values(new.npm, new.npm, 'M');
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_delete_mahasiswa` AFTER DELETE ON `mahasiswa` FOR EACH ROW begin
delete from user where id_user = old.npm;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(50) NOT NULL,
  `pesan` varchar(50) NOT NULL,
  `tema_notifikasi` varchar(20) NOT NULL,
  `target` varchar(16) NOT NULL,
  `status_pesan` int(1) NOT NULL,
  `status_notifikasi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `obyek_penelitian`
--

CREATE TABLE `obyek_penelitian` (
  `id_penelitian` int(4) NOT NULL,
  `nama_penelitian` varchar(150) NOT NULL,
  `id_prodi` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obyek_penelitian`
--

INSERT INTO `obyek_penelitian` (`id_penelitian`, `nama_penelitian`, `id_prodi`) VALUES
(0, 'Gak Ada', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` char(2) NOT NULL,
  `nama_prodi` varchar(80) NOT NULL,
  `total_semester` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`, `total_semester`) VALUES
('13', 'D-III Teknik Informatika', 6),
('14', 'D-IV Teknik Informatika', 8);

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

CREATE TABLE `proyek` (
  `id_proyek` int(16) NOT NULL,
  `judul_proyek` text,
  `abstrak` text,
  `keyword_abstrak` text,
  `latar_belakang` text,
  `identifikasi_masalah` text,
  `daftar_pustaka` text,
  `id_penelitian` int(4) DEFAULT NULL,
  `id_kegiatan` int(8) NOT NULL,
  `id_dosen_pembimbing` char(16) DEFAULT NULL,
  `id_dosen_penguji` char(16) DEFAULT NULL,
  `tgl_sidang` date DEFAULT NULL,
  `tgl_sidang_ulang` date DEFAULT NULL,
  `nilai_pembimbing` decimal(5,0) DEFAULT NULL,
  `nilai_penguji` decimal(5,0) DEFAULT NULL,
  `ruangan` varchar(4) DEFAULT NULL,
  `npm_ketua` char(7) NOT NULL,
  `status_proyek` int(1) DEFAULT NULL,
  `npm_anggota` char(7) DEFAULT NULL,
  `alasan_approval` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(16) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `jabatan` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `pass`, `jabatan`) VALUES
('1173001', '1173001', 'M'),
('1173002', '1173002', 'M'),
('1173003', '1173003', 'M'),
('1173004', '1173004', 'M'),
('1173005', '1173005', 'M'),
('1173006', '1173006', 'M'),
('1173007', '1173007', 'M'),
('1173008', '1173008', 'M'),
('1173009', '1173009', 'M'),
('1173010', '1173010', 'M'),
('1173011', '1173011', 'M'),
('1173012', '1173012', 'M'),
('1173013', '1173013', 'M'),
('1173014', '1173014', 'M'),
('1173015', '1173015', 'M'),
('1173016', '1173016', 'M'),
('1173017', '1173017', 'M'),
('1173018', '1173018', 'M'),
('1173019', '1173019', 'M'),
('1173020', '1173020', 'M'),
('1173021', '1173021', 'M'),
('1173022', '1173022', 'M'),
('1173023', '1173023', 'M'),
('1173024', '1173024', 'M'),
('1173025', '1173025', 'M'),
('1173026', '1173026', 'M'),
('1173027', '1173027', 'M'),
('1173028', '1173028', 'M'),
('1173029', '1173029', 'M'),
('1173030', '1173030', 'M'),
('1173031', '1173031', 'M'),
('1173032', '1173032', 'M'),
('1173033', '1173033', 'M'),
('1173034', '1173034', 'M'),
('1173035', '1173035', 'M'),
('1173036', '1173036', 'M'),
('1173037', '1173037', 'M'),
('1173038', '1173038', 'M'),
('1173039', '1173039', 'M'),
('1173040', '1173040', 'M'),
('1173041', '1173041', 'M'),
('1173042', '1173042', 'M'),
('1173043', '1173043', 'M'),
('1173044', '1173044', 'M'),
('1173045', '1173045', 'M'),
('1173046', '1173046', 'M'),
('1173047', '1173047', 'M'),
('1173048', '1173048', 'M'),
('1173049', '1173049', 'M'),
('1173050', '1173050', 'M'),
('1173051', '1173051', 'M'),
('1173052', '1173052', 'M'),
('1173053', '1173053', 'M'),
('1173054', '1173054', 'M'),
('1173055', '1173055', 'M'),
('1173056', '1173056', 'M'),
('1173057', '1173057', 'M'),
('1173058', '1173058', 'M'),
('1173059', '1173059', 'M'),
('1173060', '1173060', 'M'),
('1173061', '1173061', 'M'),
('1173062', '1173062', 'M'),
('1173063', '1173063', 'M'),
('1173064', '1173064', 'M'),
('1173065', '1173065', 'M'),
('1173066', '1173066', 'M'),
('1173067', '1173067', 'M'),
('1173068', '1173068', 'M'),
('1173069', '1173069', 'M'),
('1173070', '1173070', 'M'),
('1173071', '1173071', 'M'),
('1173072', '1173072', 'M'),
('1173073', '1173073', 'M'),
('1173074', '1173074', 'M'),
('1173075', '1173075', 'M'),
('1173076', '1173076', 'M'),
('1173077', '1173077', 'M'),
('1173078', '1173078', 'M'),
('1173079', '1173079', 'M'),
('1173080', '1173080', 'M'),
('1173081', '1173081', 'M'),
('1173082', '1173082', 'M'),
('1173083', '1173083', 'M'),
('1173084', '1173084', 'M'),
('1173085', '1173085', 'M'),
('1173086', '1173086', 'M'),
('1173087', '1173087', 'M'),
('1173088', '1173088', 'M'),
('1173089', '1173089', 'M'),
('1173090', '1173090', 'M'),
('1173091', '1173091', 'M'),
('1173092', '1173092', 'M'),
('1173093', '1173093', 'M'),
('1173094', '1173094', 'M'),
('1173095', '1173095', 'M'),
('1173096', '1173096', 'M'),
('1173097', '1173097', 'M'),
('1173098', '1173098', 'M'),
('1173099', '1173099', 'M'),
('1173100', '1173100', 'M'),
('1173101', '1173101', 'M'),
('1173102', '1173102', 'M'),
('1173103', '1173103', 'M'),
('1173104', '1173104', 'M'),
('1173105', '1173105', 'M'),
('1173106', '1173106', 'M'),
('1173107', '1173107', 'M'),
('1173108', '1173108', 'M'),
('1173109', '1173109', 'M'),
('1173110', '1173110', 'M'),
('1174001', '1174001', 'M'),
('1174002', '1174002', 'M'),
('1174003', '1174003', 'M'),
('1174004', '1174004', 'M'),
('1174005', '1174005', 'M'),
('1174006', '1174006', 'M'),
('1174007', '1174007', 'M'),
('1174008', '1174008', 'M'),
('1174009', '1174009', 'M'),
('1174010', '1174010', 'M'),
('3217061702990001', '3217061702990001', 'D'),
('3217061702990002', '3217061702990002', 'D'),
('3217061702990004', '3217061702990004', 'D'),
('3217061702990005', '3217061702990005', 'D'),
('3217061702990006', '3217061702990006', 'D'),
('3217061702990007', '3217061702990007', 'D'),
('3217061702990009', '3217061702990009', 'A'),
('3217061702990010', '3217061702990010', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD PRIMARY KEY (`id_bimbingan`),
  ADD KEY `key_progress_tema` (`id_kegiatan_progress`),
  ADD KEY `key_proyek` (`id_proyek`);

--
-- Indexes for table `bimbingan_progress`
--
ALTER TABLE `bimbingan_progress`
  ADD PRIMARY KEY (`id_bimbingan_progress`),
  ADD KEY `key_progress` (`id_bimbingan`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `kegiatan_progress`
--
ALTER TABLE `kegiatan_progress`
  ADD PRIMARY KEY (`id_kegiatan_progress`),
  ADD KEY `key_kegiatan_progress` (`id_kegiatan`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `user_target` (`target`);

--
-- Indexes for table `obyek_penelitian`
--
ALTER TABLE `obyek_penelitian`
  ADD PRIMARY KEY (`id_penelitian`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id_proyek`),
  ADD KEY `key_dosen_penguji` (`id_dosen_penguji`),
  ADD KEY `key_dosen_pembimbing` (`id_dosen_pembimbing`),
  ADD KEY `key_kegiatan` (`id_kegiatan`),
  ADD KEY `key_mhs` (`npm_ketua`),
  ADD KEY `key_penelitian` (`id_penelitian`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bimbingan`
--
ALTER TABLE `bimbingan`
  MODIFY `id_bimbingan` int(24) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bimbingan_progress`
--
ALTER TABLE `bimbingan_progress`
  MODIFY `id_bimbingan_progress` int(36) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kegiatan_progress`
--
ALTER TABLE `kegiatan_progress`
  MODIFY `id_kegiatan_progress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obyek_penelitian`
--
ALTER TABLE `obyek_penelitian`
  MODIFY `id_penelitian` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id_proyek` int(16) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD CONSTRAINT `key_progress_tema` FOREIGN KEY (`id_kegiatan_progress`) REFERENCES `kegiatan_progress` (`id_kegiatan_progress`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `key_proyek` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `bimbingan_progress`
--
ALTER TABLE `bimbingan_progress`
  ADD CONSTRAINT `key_progress` FOREIGN KEY (`id_bimbingan`) REFERENCES `bimbingan` (`id_bimbingan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kegiatan_progress`
--
ALTER TABLE `kegiatan_progress`
  ADD CONSTRAINT `key_kegiatan_progress` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `user_target` FOREIGN KEY (`target`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proyek`
--
ALTER TABLE `proyek`
  ADD CONSTRAINT `key_dosen_pembimbing` FOREIGN KEY (`id_dosen_pembimbing`) REFERENCES `dosen` (`nik`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `key_dosen_penguji` FOREIGN KEY (`id_dosen_penguji`) REFERENCES `dosen` (`nik`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `key_kegiatan` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `key_mhs` FOREIGN KEY (`npm_ketua`) REFERENCES `mahasiswa` (`npm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `key_penelitian` FOREIGN KEY (`id_penelitian`) REFERENCES `obyek_penelitian` (`id_penelitian`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
