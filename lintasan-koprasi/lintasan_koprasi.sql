-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 10, 2022 at 02:26 PM
-- Server version: 5.7.36-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lintasan_koprasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `harilibur`
--

CREATE TABLE `harilibur` (
  `id` bigint(20) NOT NULL,
  `tgl` date DEFAULT '0000-00-00',
  `keterangan` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harilibur`
--

INSERT INTO `harilibur` (`id`, `tgl`, `keterangan`) VALUES
(19, '2019-01-01', 'tahun baru'),
(39, '2019-06-08', 'cuti'),
(21, '2019-02-05', 'imlek'),
(22, '2019-03-07', 'nyepi'),
(23, '2019-04-19', 'wafat isa al masih'),
(24, '2019-04-17', 'pemilu'),
(25, '2019-04-18', 'cuti bersama'),
(26, '2019-04-20', 'special'),
(27, '2019-05-01', 'hari buruh '),
(38, '2019-06-07', 'cuti'),
(37, '2019-06-04', 'cuti'),
(30, '2019-06-05', 'idul fitri'),
(31, '2019-06-06', 'idul fitri'),
(32, '2019-11-09', 'maulid'),
(33, '2019-12-25', 'natal'),
(40, '2019-06-10', 'cuti'),
(41, '2019-06-11', 'cuti'),
(42, '2019-06-12', 'cuti'),
(43, '2019-06-13', 'cuti'),
(44, '2019-08-17', 'hari kemerdekaan'),
(47, '2019-12-06', 'libur'),
(48, '2020-01-01', 'tahun baru masehi'),
(63, '2020-01-25', 'libur'),
(50, '2020-03-25', 'hari suci nyepi'),
(79, '2020-04-10', ''),
(52, '2020-05-01', 'hari buruh'),
(53, '2020-05-07', 'waisak'),
(54, '2020-05-21', 'kenaikan isa al masih'),
(55, '2020-05-25', 'hari raya idul fitri'),
(56, '2020-06-01', 'hari lahir pancasila'),
(58, '2020-07-31', 'idul adha'),
(59, '2020-08-17', 'hari kemerdekaan '),
(60, '2020-08-20', 'tahun baru islam'),
(61, '2020-10-29', 'maulid nabi muhammad'),
(64, '2020-01-26', 'libur'),
(66, '2020-03-27', 'libur darurat corona'),
(67, '2020-03-28', 'libur darurat corona'),
(68, '2020-03-30', 'libur darurat corona'),
(69, '2020-03-31', 'libur darurat corona'),
(70, '2020-04-01', 'libur darurat corona'),
(71, '2020-04-02', 'libur darurat corona'),
(72, '2020-04-03', 'libur darurat corona'),
(73, '2020-04-04', 'libur darurat corona'),
(75, '2020-04-17', 'libur CORONA'),
(76, '2020-04-18', 'libur CORONA'),
(77, '2020-04-19', 'libur CORONA'),
(78, '2020-04-20', 'libur CORONA'),
(80, '2020-04-21', 'libur CORONA'),
(81, '2020-04-22', 'libur CORONA'),
(82, '2020-04-23', 'libur CORONA'),
(84, '2020-04-24', 'libur CORONA'),
(85, '2020-04-25', 'libur CORONA'),
(86, '2020-04-26', 'libur CORONA'),
(96, '2021-01-03', ''),
(97, '2021-09-05', '');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_bukubesar`
--

CREATE TABLE `keuangan_bukubesar` (
  `id` bigint(20) NOT NULL,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `rekening` char(20) DEFAULT NULL,
  `keterangan` char(100) DEFAULT NULL,
  `debet` double(16,2) DEFAULT '0.00',
  `kredit` double(16,2) DEFAULT '0.00',
  `datetime` datetime DEFAULT '0000-00-00 00:00:00',
  `username` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_jurnal`
--

CREATE TABLE `keuangan_jurnal` (
  `id` bigint(20) NOT NULL,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `rekening` char(20) DEFAULT NULL,
  `keterangan` char(100) DEFAULT NULL,
  `debet` double(16,2) DEFAULT '0.00',
  `kredit` double(16,2) DEFAULT '0.00',
  `datetime` datetime DEFAULT NULL,
  `username` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_jurnal_tmp`
--

CREATE TABLE `keuangan_jurnal_tmp` (
  `id` bigint(20) NOT NULL,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `rekening` char(20) DEFAULT NULL,
  `keterangan` char(100) DEFAULT NULL,
  `debet` double(16,2) DEFAULT '0.00',
  `kredit` double(16,2) DEFAULT '0.00',
  `datetime` datetime DEFAULT NULL,
  `username` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_jurnal_tmp`
--

INSERT INTO `keuangan_jurnal_tmp` (`id`, `faktur`, `tgl`, `rekening`, `keterangan`, `debet`, `kredit`, `datetime`, `username`) VALUES
(5, NULL, '2018-08-05', '1.102', 'Total Belanja Kantor', 0.00, 100000.00, '2018-08-05 12:56:29', 'iniad'),
(7, NULL, '2018-08-05', '5.502', 'Total Belanja Negara', 100000.00, 0.00, '2018-08-05 12:59:08', 'iniad');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_rekening`
--

CREATE TABLE `keuangan_rekening` (
  `id` bigint(20) NOT NULL,
  `kode` char(10) DEFAULT NULL,
  `keterangan` char(50) DEFAULT NULL,
  `jenis` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_rekening`
--

INSERT INTO `keuangan_rekening` (`id`, `kode`, `keterangan`, `jenis`) VALUES
(3, '1', 'AKTIVA', 'I'),
(4, '1.101', 'Kas', 'D'),
(5, '2', 'PASIVA', 'I'),
(6, '2.201', 'Hutang Dagang', 'D'),
(7, '3', 'MODAL', 'I'),
(8, '3.300', 'Modal', 'D'),
(32, '3.301', 'Laba Ditahan', 'D'),
(10, '4', 'PENDAPATAN', 'I'),
(11, '4.401', 'Bulanan', 'D'),
(12, '5', 'BIAYA', 'I'),
(13, '5.501', 'Gaji Karyawan', 'D'),
(49, '5.507', 'Cadangan THR', 'D'),
(48, '4.407', 'Senam', 'I'),
(47, '5.506', 'Cadangan kaos bonus', 'D'),
(46, '5.505', 'Biaya Promosi', 'D'),
(21, '4.402', 'Insidentil', 'D'),
(45, '5.504', 'Cadangan B 2000', 'D'),
(23, '4.403', 'B 2000', 'D'),
(44, '5.503', 'Penyusutan Peralatan', 'D'),
(43, '4.406', 'Privat Gym', 'D'),
(26, '4.404', 'Pendaftaran bulanan', 'D'),
(42, '4.405', 'Sewa Gedung', 'D'),
(52, '5.510', 'Listrik dan Telepon', 'D'),
(51, '5.509', 'Pemeliharaan Gedung', 'D'),
(30, '2.202', 'Rupa-rupa Pasiva', 'I'),
(50, '5.508', 'Pemeliharaan peralatan', 'D'),
(33, '5.502', 'Gaji Instruktur Senam', 'D'),
(34, '1.102', 'Kas Kecil', 'D'),
(35, '1.103', 'Bank', 'D'),
(36, '1.104', 'Piutang', 'D'),
(37, '1.105', 'Persediaan', 'D'),
(38, '1.106', 'Tanah', 'D'),
(39, '1.107', 'Gedung', 'D'),
(40, '1.108', 'Peralatan', 'D'),
(41, '1.109', 'Akum Penyusutan Peralatan', 'D'),
(53, '5.511', 'Rumah Tangga', 'D'),
(54, '5.512', 'Air isi ulang', 'D'),
(55, '2.201.01', 'Hutang Mba Alfi', 'D'),
(56, '2.201.02', 'Hutang Mas Rengga', 'D'),
(57, '2.202.01', 'Titipan Suplemen', 'D'),
(58, '2.202.02', 'Titipan Minuman', 'D'),
(59, '1.110', 'Aktiva lain-lain', 'I'),
(60, '1.111', 'Program Fitness', 'D'),
(61, '5.513', 'biaya operasional lainnya', 'I'),
(62, '5.514', 'biaya non operasional', 'I'),
(63, '4.408', 'pendapatan konsinyasi', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `mst_agama`
--

CREATE TABLE `mst_agama` (
  `id` bigint(11) NOT NULL,
  `kode` char(2) NOT NULL,
  `keterangan` char(20) NOT NULL COMMENT 'jika join for meta value'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_agama`
--

INSERT INTO `mst_agama` (`id`, `kode`, `keterangan`) VALUES
(32, '01', 'Islam'),
(33, '02', 'Kristen'),
(34, '03', 'Katolik'),
(35, '04', 'Hindu'),
(36, '05', 'Budha'),
(37, '06', 'Konghuchu');

-- --------------------------------------------------------

--
-- Table structure for table `mst_dati2`
--

CREATE TABLE `mst_dati2` (
  `id` bigint(11) NOT NULL,
  `provinsi` char(50) NOT NULL,
  `kota` char(50) NOT NULL,
  `kecamatan` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sys_config`
--

CREATE TABLE `sys_config` (
  `id` bigint(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `val` text NOT NULL COMMENT 'jika join for meta value',
  `type` varchar(20) NOT NULL,
  `other_string` text NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sys_import`
--

CREATE TABLE `sys_import` (
  `id` bigint(11) NOT NULL,
  `tablename` varchar(20) NOT NULL,
  `tableid` bigint(11) NOT NULL,
  `importkey` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sys_module`
--

CREATE TABLE `sys_module` (
  `name` varchar(20) NOT NULL,
  `path` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `id` int(10) NOT NULL,
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_module`
--

INSERT INTO `sys_module` (`name`, `path`, `description`, `id`, `datetime_insert`, `datetime_update`) VALUES
('Administrator', 'admin', '', 1, '2017-03-15 10:00:00', '2017-03-15 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sys_username`
--

CREATE TABLE `sys_username` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `data_var` longtext,
  `lastchangepass` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_username`
--

INSERT INTO `sys_username` (`username`, `password`, `fullname`, `lastlogin`, `data_var`, `lastchangepass`) VALUES
('iniad', 'd154c23962918b23239809a675ef3b8ad860bff50000', 'Administrator', '2017-03-14 00:00:00', '{\"ava\":\"./uploads/ava.png\"}', '2017-03-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sys_username_level`
--

CREATE TABLE `sys_username_level` (
  `code` char(4) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL,
  `value` longtext NOT NULL,
  `dashboard` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_username_level`
--

INSERT INTO `sys_username_level` (`code`, `name`, `value`, `dashboard`) VALUES
('0001', 'Kasir', 'a88ad3a75f88bbe93b64a7c55ade7a5d,e7d707a26e7f7b6ff52c489c60e429b1,c5422092276ea6c9b68e18f834710893,76a6d02ff49bc5cd36f5fd94ef89c824,b1c9ee1af4240f4fec204efb65b6fa92,dcaaf5237b6c18f979b4383fb42d3be3,50ac35e322c176664634f5e827adb35a,9c04a151bb95c0f9be7b9c8540725717,53a1ceef6f69e5086420bf1b352b2e27,7b83cbb12154ed6523415564ba588193,42ab0e4968db1e7ae90a4565736d3cc0,9f87b2194e05c86d21f104e1095185ae,011134986548f3458aa3e7e2a7fceb8d,316708c872ab14cb46e8ba3a96afd64f', '{\"md5\":\"6793ab20b093fe614b86fd501893a924\",\"name\":\"Dashboard\"}');

-- --------------------------------------------------------

--
-- Table structure for table `tabungan_golongan`
--

CREATE TABLE `tabungan_golongan` (
  `id` bigint(11) NOT NULL,
  `kode` char(2) NOT NULL,
  `keterangan` char(20) NOT NULL COMMENT 'jika join for meta value',
  `rekening` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tabungan_kodetransaksi`
--

CREATE TABLE `tabungan_kodetransaksi` (
  `id` bigint(11) NOT NULL,
  `kode` char(2) NOT NULL,
  `keterangan` char(20) NOT NULL COMMENT 'jika join for meta value',
  `dk` char(1) NOT NULL,
  `rekening` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tabungan_mutasi`
--

CREATE TABLE `tabungan_mutasi` (
  `id` bigint(11) NOT NULL,
  `faktur` char(20) NOT NULL,
  `tgl` date NOT NULL,
  `rekening` char(20) NOT NULL,
  `kodetransaksi` char(2) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `debet` double NOT NULL,
  `kredit` double NOT NULL,
  `datetime` datetime NOT NULL,
  `username` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tabungan_rate`
--

CREATE TABLE `tabungan_rate` (
  `id` bigint(11) NOT NULL,
  `tgl` date NOT NULL,
  `golongantabungan` char(2) NOT NULL,
  `sukubunga` double NOT NULL,
  `datetime` datetime NOT NULL,
  `username` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `harilibur`
--
ALTER TABLE `harilibur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keuangan_bukubesar`
--
ALTER TABLE `keuangan_bukubesar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faktur` (`faktur`),
  ADD KEY `tgl` (`tgl`),
  ADD KEY `rekening` (`rekening`),
  ADD KEY `idfakturtgl` (`id`,`faktur`,`tgl`),
  ADD KEY `idtglrekening` (`id`,`tgl`,`rekening`),
  ADD KEY `fakturtglrekening` (`faktur`,`tgl`,`rekening`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `keuangan_jurnal`
--
ALTER TABLE `keuangan_jurnal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faktur` (`faktur`),
  ADD KEY `tgl` (`tgl`),
  ADD KEY `rekening` (`rekening`),
  ADD KEY `idfakturtgl` (`id`,`faktur`,`tgl`),
  ADD KEY `idtglrekening` (`id`,`tgl`,`rekening`),
  ADD KEY `fakturtglrekening` (`faktur`,`tgl`,`rekening`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `keuangan_jurnal_tmp`
--
ALTER TABLE `keuangan_jurnal_tmp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faktur` (`faktur`),
  ADD KEY `tgl` (`tgl`),
  ADD KEY `rekening` (`rekening`),
  ADD KEY `idfakturtgl` (`id`,`faktur`,`tgl`),
  ADD KEY `idtglrekening` (`id`,`tgl`,`rekening`),
  ADD KEY `fakturtglrekening` (`faktur`,`tgl`,`rekening`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `keuangan_rekening`
--
ALTER TABLE `keuangan_rekening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode` (`kode`),
  ADD KEY `kodeid` (`id`,`kode`),
  ADD KEY `jenis` (`jenis`);

--
-- Indexes for table `mst_agama`
--
ALTER TABLE `mst_agama`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Key` (`kode`);

--
-- Indexes for table `mst_dati2`
--
ALTER TABLE `mst_dati2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Key` (`provinsi`);

--
-- Indexes for table `sys_config`
--
ALTER TABLE `sys_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Key` (`title`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `sys_import`
--
ALTER TABLE `sys_import`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itablename` (`tablename`,`tableid`);

--
-- Indexes for table `sys_module`
--
ALTER TABLE `sys_module`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `sys_username`
--
ALTER TABLE `sys_username`
  ADD PRIMARY KEY (`username`),
  ADD KEY `UserPass` (`username`,`password`);

--
-- Indexes for table `sys_username_level`
--
ALTER TABLE `sys_username_level`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `tabungan_golongan`
--
ALTER TABLE `tabungan_golongan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Key` (`kode`);

--
-- Indexes for table `tabungan_kodetransaksi`
--
ALTER TABLE `tabungan_kodetransaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Key` (`kode`);

--
-- Indexes for table `tabungan_mutasi`
--
ALTER TABLE `tabungan_mutasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Key` (`faktur`);

--
-- Indexes for table `tabungan_rate`
--
ALTER TABLE `tabungan_rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Key` (`tgl`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `harilibur`
--
ALTER TABLE `harilibur`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `keuangan_bukubesar`
--
ALTER TABLE `keuangan_bukubesar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63932;
--
-- AUTO_INCREMENT for table `keuangan_jurnal`
--
ALTER TABLE `keuangan_jurnal`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45777;
--
-- AUTO_INCREMENT for table `keuangan_jurnal_tmp`
--
ALTER TABLE `keuangan_jurnal_tmp`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `keuangan_rekening`
--
ALTER TABLE `keuangan_rekening`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `mst_agama`
--
ALTER TABLE `mst_agama`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `mst_dati2`
--
ALTER TABLE `mst_dati2`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_config`
--
ALTER TABLE `sys_config`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3032;
--
-- AUTO_INCREMENT for table `tabungan_golongan`
--
ALTER TABLE `tabungan_golongan`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tabungan_kodetransaksi`
--
ALTER TABLE `tabungan_kodetransaksi`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tabungan_mutasi`
--
ALTER TABLE `tabungan_mutasi`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tabungan_rate`
--
ALTER TABLE `tabungan_rate`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
