-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: 192.168.115.128    Database: lintasan_koprasi
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `harilibur`
--

DROP TABLE IF EXISTS `harilibur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `harilibur` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `tgl` date DEFAULT '0000-00-00',
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `harilibur`
--

LOCK TABLES `harilibur` WRITE;
/*!40000 ALTER TABLE `harilibur` DISABLE KEYS */;
INSERT INTO `harilibur` VALUES (19,'2019-01-01','tahun baru'),(39,'2019-06-08','cuti'),(21,'2019-02-05','imlek'),(22,'2019-03-07','nyepi'),(23,'2019-04-19','wafat isa al masih'),(24,'2019-04-17','pemilu'),(25,'2019-04-18','cuti bersama'),(26,'2019-04-20','special'),(27,'2019-05-01','hari buruh '),(38,'2019-06-07','cuti'),(37,'2019-06-04','cuti'),(30,'2019-06-05','idul fitri'),(31,'2019-06-06','idul fitri'),(32,'2019-11-09','maulid'),(33,'2019-12-25','natal'),(40,'2019-06-10','cuti'),(41,'2019-06-11','cuti'),(42,'2019-06-12','cuti'),(43,'2019-06-13','cuti'),(44,'2019-08-17','hari kemerdekaan'),(47,'2019-12-06','libur'),(48,'2020-01-01','tahun baru masehi'),(63,'2020-01-25','libur'),(50,'2020-03-25','hari suci nyepi'),(79,'2020-04-10',''),(52,'2020-05-01','hari buruh'),(53,'2020-05-07','waisak'),(54,'2020-05-21','kenaikan isa al masih'),(55,'2020-05-25','hari raya idul fitri'),(56,'2020-06-01','hari lahir pancasila'),(58,'2020-07-31','idul adha'),(59,'2020-08-17','hari kemerdekaan '),(60,'2020-08-20','tahun baru islam'),(61,'2020-10-29','maulid nabi muhammad'),(64,'2020-01-26','libur'),(66,'2020-03-27','libur darurat corona'),(67,'2020-03-28','libur darurat corona'),(68,'2020-03-30','libur darurat corona'),(69,'2020-03-31','libur darurat corona'),(70,'2020-04-01','libur darurat corona'),(71,'2020-04-02','libur darurat corona'),(72,'2020-04-03','libur darurat corona'),(73,'2020-04-04','libur darurat corona'),(75,'2020-04-17','libur CORONA'),(76,'2020-04-18','libur CORONA'),(77,'2020-04-19','libur CORONA'),(78,'2020-04-20','libur CORONA'),(80,'2020-04-21','libur CORONA'),(81,'2020-04-22','libur CORONA'),(82,'2020-04-23','libur CORONA'),(84,'2020-04-24','libur CORONA'),(85,'2020-04-25','libur CORONA'),(86,'2020-04-26','libur CORONA'),(96,'2021-01-03',''),(97,'2021-09-05','');
/*!40000 ALTER TABLE `harilibur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keuangan_bukubesar`
--

DROP TABLE IF EXISTS `keuangan_bukubesar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keuangan_bukubesar` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `rekening` char(20) DEFAULT NULL,
  `keterangan` char(100) DEFAULT NULL,
  `debet` double(16,2) DEFAULT '0.00',
  `kredit` double(16,2) DEFAULT '0.00',
  `datetime` datetime DEFAULT '0000-00-00 00:00:00',
  `username` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idfakturtgl` (`id`,`faktur`,`tgl`),
  KEY `idtglrekening` (`id`,`tgl`,`rekening`),
  KEY `fakturtglrekening` (`faktur`,`tgl`,`rekening`)
) ENGINE=MyISAM AUTO_INCREMENT=63932 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keuangan_bukubesar`
--

LOCK TABLES `keuangan_bukubesar` WRITE;
/*!40000 ALTER TABLE `keuangan_bukubesar` DISABLE KEYS */;
/*!40000 ALTER TABLE `keuangan_bukubesar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keuangan_jurnal`
--

DROP TABLE IF EXISTS `keuangan_jurnal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keuangan_jurnal` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `rekening` char(20) DEFAULT NULL,
  `keterangan` char(100) DEFAULT NULL,
  `debet` double(16,2) DEFAULT '0.00',
  `kredit` double(16,2) DEFAULT '0.00',
  `datetime` datetime DEFAULT NULL,
  `username` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rekening` (`rekening`),
  KEY `idfakturtgl` (`id`,`faktur`,`tgl`),
  KEY `idtglrekening` (`id`,`tgl`,`rekening`),
  KEY `fakturtglrekening` (`faktur`,`tgl`,`rekening`)
) ENGINE=MyISAM AUTO_INCREMENT=45777 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keuangan_jurnal`
--

LOCK TABLES `keuangan_jurnal` WRITE;
/*!40000 ALTER TABLE `keuangan_jurnal` DISABLE KEYS */;
/*!40000 ALTER TABLE `keuangan_jurnal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keuangan_jurnal_tmp`
--

DROP TABLE IF EXISTS `keuangan_jurnal_tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keuangan_jurnal_tmp` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `rekening` char(20) DEFAULT NULL,
  `keterangan` char(100) DEFAULT NULL,
  `debet` double(16,2) DEFAULT '0.00',
  `kredit` double(16,2) DEFAULT '0.00',
  `datetime` datetime DEFAULT NULL,
  `username` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idfakturtgl` (`id`,`faktur`,`tgl`),
  KEY `idtglrekening` (`id`,`tgl`,`rekening`),
  KEY `fakturtglrekening` (`faktur`,`tgl`,`rekening`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keuangan_jurnal_tmp`
--

LOCK TABLES `keuangan_jurnal_tmp` WRITE;
/*!40000 ALTER TABLE `keuangan_jurnal_tmp` DISABLE KEYS */;
INSERT INTO `keuangan_jurnal_tmp` VALUES (5,NULL,'2018-08-05','1.102','Total Belanja Kantor',0.00,100000.00,'2018-08-05 12:56:29','iniad'),(7,NULL,'2018-08-05','5.502','Total Belanja Negara',100000.00,0.00,'2018-08-05 12:59:08','iniad');
/*!40000 ALTER TABLE `keuangan_jurnal_tmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keuangan_rekening`
--

DROP TABLE IF EXISTS `keuangan_rekening`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keuangan_rekening` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `kode` char(10) DEFAULT NULL,
  `keterangan` char(50) DEFAULT NULL,
  `jenis` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kodeid` (`id`,`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keuangan_rekening`
--

LOCK TABLES `keuangan_rekening` WRITE;
/*!40000 ALTER TABLE `keuangan_rekening` DISABLE KEYS */;
INSERT INTO `keuangan_rekening` VALUES (3,'1','AKTIVA','I'),(4,'1.101','Kas','D'),(5,'2','PASIVA','I'),(6,'2.201','Hutang Dagang','D'),(7,'3','MODAL','I'),(8,'3.300','Modal','D'),(32,'3.301','Laba Ditahan','D'),(10,'4','PENDAPATAN','I'),(11,'4.401','Bulanan','D'),(12,'5','BIAYA','I'),(13,'5.501','Gaji Karyawan','D'),(49,'5.507','Cadangan THR','D'),(48,'4.407','Senam','I'),(47,'5.506','Cadangan kaos bonus','D'),(46,'5.505','Biaya Promosi','D'),(21,'4.402','Insidentil','D'),(45,'5.504','Cadangan B 2000','D'),(23,'4.403','B 2000','D'),(44,'5.503','Penyusutan Peralatan','D'),(43,'4.406','Privat Gym','D'),(26,'4.404','Pendaftaran bulanan','D'),(42,'4.405','Sewa Gedung','D'),(52,'5.510','Listrik dan Telepon','D'),(51,'5.509','Pemeliharaan Gedung','D'),(30,'2.202','Rupa-rupa Pasiva','I'),(50,'5.508','Pemeliharaan peralatan','D'),(33,'5.502','Gaji Instruktur Senam','D'),(34,'1.102','Kas Kecil','D'),(35,'1.103','Bank','D'),(36,'1.104','Piutang','D'),(37,'1.105','Persediaan','D'),(38,'1.106','Tanah','D'),(39,'1.107','Gedung','D'),(40,'1.108','Peralatan','D'),(41,'1.109','Akum Penyusutan Peralatan','D'),(53,'5.511','Rumah Tangga','D'),(54,'5.512','Air isi ulang','D'),(55,'2.201.01','Hutang Mba Alfi','D'),(56,'2.201.02','Hutang Mas Rengga','D'),(57,'2.202.01','Titipan Suplemen','D'),(58,'2.202.02','Titipan Minuman','D'),(59,'1.110','Aktiva lain-lain','I'),(60,'1.111','Program Fitness','D'),(61,'5.513','biaya operasional lainnya','I'),(62,'5.514','biaya non operasional','I'),(63,'4.408','pendapatan konsinyasi','D');
/*!40000 ALTER TABLE `keuangan_rekening` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_agama`
--

DROP TABLE IF EXISTS `mst_agama`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_agama` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `kode` char(2) NOT NULL,
  `keterangan` char(20) NOT NULL COMMENT 'jika join for meta value',
  PRIMARY KEY (`id`),
  KEY `Key` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_agama`
--

LOCK TABLES `mst_agama` WRITE;
/*!40000 ALTER TABLE `mst_agama` DISABLE KEYS */;
INSERT INTO `mst_agama` VALUES (32,'01','Islam'),(33,'02','Kristen'),(34,'03','Katolik'),(35,'04','Hindu'),(36,'05','Budha'),(37,'06','Konghuchu');
/*!40000 ALTER TABLE `mst_agama` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_dati2`
--

DROP TABLE IF EXISTS `mst_dati2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mst_dati2` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `provinsi` char(50) NOT NULL,
  `kota` char(50) NOT NULL,
  `kecamatan` char(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Key` (`provinsi`,`kota`),
  KEY `Key2` (`provinsi`,`kota`,`kecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_dati2`
--

LOCK TABLES `mst_dati2` WRITE;
/*!40000 ALTER TABLE `mst_dati2` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_dati2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_config`
--

DROP TABLE IF EXISTS `sys_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sys_config` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `val` text NOT NULL COMMENT 'jika join for meta value',
  `type` varchar(20) NOT NULL,
  `other_string` text NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Key` (`title`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=3032 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_config`
--

LOCK TABLES `sys_config` WRITE;
/*!40000 ALTER TABLE `sys_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_import`
--

DROP TABLE IF EXISTS `sys_import`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sys_import` (
  `id` bigint NOT NULL,
  `tablename` varchar(20) NOT NULL,
  `tableid` bigint NOT NULL,
  `importkey` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `itablename` (`tablename`,`tableid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_import`
--

LOCK TABLES `sys_import` WRITE;
/*!40000 ALTER TABLE `sys_import` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_import` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_module`
--

DROP TABLE IF EXISTS `sys_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sys_module` (
  `name` varchar(20) NOT NULL,
  `path` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `id` int NOT NULL,
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_module`
--

LOCK TABLES `sys_module` WRITE;
/*!40000 ALTER TABLE `sys_module` DISABLE KEYS */;
INSERT INTO `sys_module` VALUES ('Administrator','admin','',1,'2017-03-15 10:00:00','2017-03-15 10:00:00');
/*!40000 ALTER TABLE `sys_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_username`
--

DROP TABLE IF EXISTS `sys_username`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sys_username` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `data_var` longtext,
  `lastchangepass` datetime DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `UserPass` (`username`,`password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_username`
--

LOCK TABLES `sys_username` WRITE;
/*!40000 ALTER TABLE `sys_username` DISABLE KEYS */;
INSERT INTO `sys_username` VALUES ('iniad','d154c23962918b23239809a675ef3b8ad860bff50000','Administrator','2017-03-14 00:00:00','{\"ava\":\"./uploads/ava.png\"}','2017-03-14 00:00:00');
/*!40000 ALTER TABLE `sys_username` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_username_level`
--

DROP TABLE IF EXISTS `sys_username_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sys_username_level` (
  `code` char(4) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL,
  `value` longtext NOT NULL,
  `dashboard` varchar(100) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_username_level`
--

LOCK TABLES `sys_username_level` WRITE;
/*!40000 ALTER TABLE `sys_username_level` DISABLE KEYS */;
INSERT INTO `sys_username_level` VALUES ('0001','Kasir','a88ad3a75f88bbe93b64a7c55ade7a5d,e7d707a26e7f7b6ff52c489c60e429b1,c5422092276ea6c9b68e18f834710893,76a6d02ff49bc5cd36f5fd94ef89c824,b1c9ee1af4240f4fec204efb65b6fa92,dcaaf5237b6c18f979b4383fb42d3be3,50ac35e322c176664634f5e827adb35a,9c04a151bb95c0f9be7b9c8540725717,53a1ceef6f69e5086420bf1b352b2e27,7b83cbb12154ed6523415564ba588193,42ab0e4968db1e7ae90a4565736d3cc0,9f87b2194e05c86d21f104e1095185ae,011134986548f3458aa3e7e2a7fceb8d,316708c872ab14cb46e8ba3a96afd64f','{\"md5\":\"6793ab20b093fe614b86fd501893a924\",\"name\":\"Dashboard\"}');
/*!40000 ALTER TABLE `sys_username_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabungan_golongan`
--

DROP TABLE IF EXISTS `tabungan_golongan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabungan_golongan` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `kode` char(2) NOT NULL,
  `keterangan` char(20) NOT NULL COMMENT 'jika join for meta value',
  `rekening` char(20) NOT NULL,
  `rekening_bunga` char(20) NOT NULL,
  `rate` char(3) NOT NULL,
  `saldo_minimum` double(16,0) NOT NULL,
  `saldo_minimum_bunga` double(16,0) NOT NULL,
  `administrasi` double(16,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Key` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabungan_golongan`
--

LOCK TABLES `tabungan_golongan` WRITE;
/*!40000 ALTER TABLE `tabungan_golongan` DISABLE KEYS */;
INSERT INTO `tabungan_golongan` VALUES (2,'10','Tabungan Pelajar','1.102','5.501','10',10000,300000,0),(3,'11','Tabungan Umum','1.104','3.301','10',5000,150000,0);
/*!40000 ALTER TABLE `tabungan_golongan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabungan_kodetransaksi`
--

DROP TABLE IF EXISTS `tabungan_kodetransaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabungan_kodetransaksi` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `kode` char(2) NOT NULL,
  `keterangan` char(20) NOT NULL COMMENT 'jika join for meta value',
  `dk` char(1) NOT NULL,
  `rekening` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Key` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabungan_kodetransaksi`
--

LOCK TABLES `tabungan_kodetransaksi` WRITE;
/*!40000 ALTER TABLE `tabungan_kodetransaksi` DISABLE KEYS */;
INSERT INTO `tabungan_kodetransaksi` VALUES (1,'01','Setoran Tabungan','K','1.103'),(2,'02','Penarikan Tabungan','D','1.104');
/*!40000 ALTER TABLE `tabungan_kodetransaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabungan_mutasi`
--

DROP TABLE IF EXISTS `tabungan_mutasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabungan_mutasi` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `faktur` char(20) NOT NULL,
  `tgl` date NOT NULL,
  `rekening` char(20) NOT NULL,
  `kodetransaksi` char(2) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `debet` double NOT NULL,
  `kredit` double NOT NULL,
  `datetime` datetime NOT NULL,
  `username` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Key` (`faktur`,`tgl`),
  KEY `fakturrekening` (`faktur`,`rekening`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabungan_mutasi`
--

LOCK TABLES `tabungan_mutasi` WRITE;
/*!40000 ALTER TABLE `tabungan_mutasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tabungan_mutasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabungan_rate`
--

DROP TABLE IF EXISTS `tabungan_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabungan_rate` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `keterangan` char(50) NOT NULL,
  `golongan_tabungan` char(2) NOT NULL,
  `sukubunga` double NOT NULL,
  `datetime` datetime NOT NULL,
  `username` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Key` (`tgl`,`golongan_tabungan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabungan_rate`
--

LOCK TABLES `tabungan_rate` WRITE;
/*!40000 ALTER TABLE `tabungan_rate` DISABLE KEYS */;
INSERT INTO `tabungan_rate` VALUES (1,'2022-01-25','Perubahan suku bunga 11 persen','10',11,'0000-00-00 00:00:00','system'),(2,'2022-01-26','perubahan suku bunga 12 persen','10',12,'0000-00-00 00:00:00',''),(3,'2022-01-26','Perubahan suku bunga 9 persen','11',9,'0000-00-00 00:00:00',''),(4,'2022-01-26','Perubahan suku bunga 15 persen','11',15,'0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `tabungan_rate` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-11 14:56:28