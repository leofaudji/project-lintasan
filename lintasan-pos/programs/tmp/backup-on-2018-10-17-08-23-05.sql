DROP TABLE IF EXISTS `aset`;

CREATE TABLE `aset` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `cabang` varchar(3) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tglperolehan` date NOT NULL DEFAULT '0000-00-00',
  `golongan` varchar(4) NOT NULL,
  `lama` double(16,0) NOT NULL DEFAULT '0',
  `hargaperolehan` double(16,2) NOT NULL DEFAULT '0.00',
  `unit` double(16,2) NOT NULL DEFAULT '0.00',
  `status` char(1) NOT NULL DEFAULT '0',
  `jenispenyusutan` char(1) NOT NULL DEFAULT '0',
  `tarifpenyusutan` double(5,2) NOT NULL DEFAULT '0.00',
  `residu` double(16,2) NOT NULL DEFAULT '0.00',
  `penyusutanperbulan` double(16,2) NOT NULL DEFAULT '0.00',
  `tglhabis` date NOT NULL DEFAULT '0000-00-00',
  `fakturhabis` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `aset_golongan`;

CREATE TABLE `aset_golongan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode` varchar(4) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `rekakmpeny` varchar(20) NOT NULL,
  `rekbypeny` varchar(20) NOT NULL,
  `jenis` char(1) DEFAULT 'A',
  PRIMARY KEY (`id`),
  KEY `kode` (`kode`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `kode` varchar(16) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `rekening` varchar(20) DEFAULT '',
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inik` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `bank` VALUES("1","001","Bank BRI","1.10.010.01","0000-00-00 00:00:00","2018-09-10 13:02:06",""),
("2","002","mlkdm","3.90.011","0000-00-00 00:00:00","2018-09-10 13:04:13","");



DROP TABLE IF EXISTS `cabang`;

CREATE TABLE `cabang` (
  `id` int(8) NOT NULL,
  `kode` varchar(16) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inik` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cabang` VALUES("1","001","Buya Barokah Pusat","0000-00-00 00:00:00","2017-12-17 09:10:01","admin");



DROP TABLE IF EXISTS `coa`;

CREATE TABLE `coa` (
  `kode` varchar(11) DEFAULT NULL,
  `keterangan` varchar(58) DEFAULT NULL,
  `jenis` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `coa` VALUES("KODE","KETERANGAN","JENIS"),
("1","AKTIVA","I"),
("1.10","AKTIVA LANCAR","I"),
("1.10.010","KAS_ELEMEN_KAS","I"),
("1.10.010.01","Kas di Tangan","D"),
("1.10.010.02","Kas Cheque","D"),
("1.10.010.03","Kas Lainnya","D"),
("1.10.010.04","BRI 003801000741302","D"),
("1.10.010.05","BRI NAS 003801502240153","D"),
("1.10.010.06","BNI 3330898982","D"),
("1.10.010.07","BCA 0312618000","D"),
("1.10.010.08","Giro Bank Jateng Syariah 6071000259","D"),
("1.10.010.09","Kas Pembangunan","D"),
("1.10.020","PIUTANG","I"),
("1.10.020.01","Piutang_Dagang","D"),
("1.10.020.02","Piutang_Bilyet_Giro","D"),
("1.10.020.03","Cadangan_Kerugian_Piutang","D"),
("1.10.020.04","Piutang_Karyawan","D"),
("1.10.020.05","Kasbon_Karyawan","D"),
("1.10.020.06","Piutang_Antar_Divisi","D"),
("1.10.020.07","Piutang_Lainnya","D"),
("1.10.030","PERSEDIAAN","I"),
("1.10.030.01","Persediaan_Bahan_Baku","D"),
("1.10.030.02","Persediaan_Bahan_Penolong","D"),
("1.10.030.03","Persediaan_Barang_dlm_Proses","D"),
("1.10.030.04","Persediaan_Barang_Jadi","D"),
("1.10.030.05","Persediaan_Supplies_Pabrik","D"),
("1.10.030.06","Persediaan_Supplies_Kantor","D"),
("1.10.030.07","Persediaan_Sparepart_Mesin","D"),
("1.10.030.08","Persediaan_Sparepart_Kendaraan","D"),
("1.10.040","BIAYA_DIBAYAR_DI_MUKA","I"),
("1.10.040.01","Porsekot_Iklan","D"),
("1.10.040.02","Porsekot_Pembelian_Bahan_Baku","D"),
("1.10.040.03","Porsekot_Pembelian_Bahan_Penolong","D"),
("1.10.040.04","Porsekot_Pembelian_Mesin","D"),
("1.10.040.05","Porsekot_Pembelian_Kendaraan","D"),
("1.10.040.06","Porsekot_Pembelian_Tanah","D"),
("1.10.040.07","Porsekot_Pengiriman","D"),
("1.10.040.08","Porsekot_Perjalanan_Dinas","D"),
("1.10.040.09","Porsekot_Sewa","D"),
("1.10.040.10","Porsekot_Pajak","D"),
("1.10.040.11","Porsekot_Biaya_Lainnya","D"),
("1.20","AKTIVA TETAP","I"),
("1.20.010","AKTIVA_TETAP_BERWUJUD","I"),
("1.20.010.01","Tanah","D"),
("1.20.010.02","Gedung_Pabrik","D"),
("1.20.010.03","Gedung_Kantor","D"),
("1.20.010.04","Mesin_dan_Peralatan","D"),
("1.20.010.05","Inventaris_Pabrik","D"),
("1.20.010.06","Inventaris_Kantor","D"),
("1.20.010.07","Kendaraan","D"),
("1.20.010.08","Aktiva_Tetap_Berwujud_Lainnya","D"),
("1.20.020","AKUMULASI_PENYUSUTAN_AT_BERWUJUD","I"),
("1.20.020.01","Akumulasi_Penyusutan_Gedung_Pabrik","D"),
("1.20.020.02","Akumulasi_Penyusutan_Gedung_Kantor","D"),
("1.20.020.03","Akumulasi_Penyusutan_Mesin_dan_Peralatan","D"),
("1.20.020.04","Akumulasi_Penyusutan_Inv._Pabrik","D"),
("1.20.020.05","Akumulasi_Penyusutan_Inv._Kantor","D"),
("1.20.020.06","Akumulasi_Penyusutan_Kendaraan","D"),
("1.20.020.07","Akumulasi_Penyusutan_AT_Berwujud_Lainnya","D"),
("1.20.030","AKTIVA_TIDAK_BERWUJUD","I"),
("1.20.030.01","Patent_dan_Merk_Dagang","D"),
("1.20.030.02","Good_Will","D"),
("1.20.030.03","Royalty","D"),
("1.30","AKTIVA_LAIN_LAIN","I"),
("1.30.010","Biaya_Pendirian_Perusahaan","D"),
("1.30.020","Biaya_Resiko_Kecelakaan","D"),
("1.30.030","Jaminan_Kontrak_PLN","D"),
("1.30.040","Jaminan_Kontrak_Perumtel","D"),
("1.30.050","Bangunan_Dalam_Proses","D"),
("1.30.060","Piutang_Jangka_Panjang","D"),
("2","HUTANG","I"),
("2.10","HUTANG_JANGKA_PENDEK","I"),
("2.10.010","Hutang_Dagang","D"),
("2.10.011","Hutang_Cheque_dan_Bilyet_Giro","D"),
("2.10.012","Hutang_Gaji_dan_upah","D"),
("2.10.013","Iklan_Belum_Dibayar","D"),
("2.10.014","Hutang_Pajak","D"),
("2.10.015","Hutang_Komisi_Penjualan","D"),
("2.10.016","Uang_Muka_Penjualan","D"),
("2.10.017","Uang_Muka_Pengiriman","D"),
("2.10.018","Hutang_Royalty","D"),
("2.10.019","Hutang_Pembelian_Aset","D"),
("2.10.020","Hutang_Jangka_Pendek_Lainnya","D"),
("2.20","HUTANG_JANGKA_PANJANG","I"),
("2.20.020","Hutang_Jaminan_Distributor","D"),
("2.20.021","Hutang_Pihak_Ketiga","D"),
("2.20.022","Hutang_Bank_Jateng_Syariah","D"),
("2.20.023","Hipotik BNI KMK-RK","D"),
("2.20.024","Hipotik BNI KI","D"),
("2.20.025","Hutang_Pembelian_Mesin","D"),
("2.20.026","Hutang_Pembelian_Kendaraan","D"),
("2.20.027","Hipotik BRI KMK RK","D"),
("2.20.028","Hipotik BRI KMK Angsuran","D"),
("2.20.029","Hutang_Jangka_Panjang_Lainnya","D"),
("3","MODAL","I"),
("3.10","Modal_Persero","D"),
("3.11","Laba_Tahun_Lalu","D"),
("3.12","Laba_Ditahan","D"),
("3.13","Laba_Rugi_Bulan_Berjalan","D"),
("3.14","Cadangan_Modal_Kerja","D"),
("3.15","Cadangan_Ekspansi","D"),
("4","PENDAPATAN","I"),
("4.10","PENJUALAN","I"),
("4.10.001","Penjualan_Distributor_Kar_Pati_dan_semarang","D"),
("4.10.002","Retur_Penjualan_Distributor_Kar_Pati_dan_semarang","D"),
("4.10.003","Potongan_Penjualan_Distributor_Kar_Pati_dan_semarang","D"),
("4.10.004","Penjualan_Distributor_Luar_Kar_Pati_dan_semarang","D"),
("4.10.005","Retur_Penjualan_Distributor_Luar_Kar_Pati_dan_semarang","D"),
("4.10.006","Potongan_Penjualan_Distributor_Luar_Kar_Pati_dan_semarang","D"),
("4.10.007","Penjualan_Agen_Kar_Pati_dan_semarang","D"),
("4.10.008","Retur_Penjualan_Agen_Kar_Pati_dan_semarang","D"),
("4.10.009","Potongan_Agen_Kar_Pati_dan_semarang","D"),
("4.10.010","Penjualan_Agen_Luar_Kar_Pati_dan_semarang","D"),
("4.10.011","Retur_Penjualan_Agen_Luar_Kar_Pati_dan_semarang","D"),
("4.10.012","Potongan_Agen_Luar_Kar_Pati_dan_semarang","D"),
("4.10.013","Penjualan_Kepada_Karyawan","D"),
("5","HARGA_POKOK_PRODUKSI_DAN_PENJUALAN","I"),
("5.10","PEMBELIAN","I"),
("5.10.010","PEMBELIAN BB","I"),
("5.10.010.01","Pembelian_Bahan_Baku","D"),
("5.10.010.02","Potongan_Pembelian_Bahan_Baku","D"),
("5.10.010.03","Retur_Pembelian_Bahan_Baku","D"),
("5.10.010.04","Ongkos_Angkut_Pembelian_Bahan_Baku","D"),
("5.10.020","PEMBELIAN BP","I"),
("5.10.020.01","Pembelian_Bahan_Penolong","D"),
("5.10.020.02","Potongan_Pembelian_Bahan_Penolong","D"),
("5.10.020.03","Retur_Pembelian_Bahan_Penolong","D"),
("5.10.020.04","Ongkos_Angkut_Pembelian_Bahan_Penolong","D"),
("5.10.030","PEMBELIAN SUPPLIES PABRIK","I"),
("5.10.030.01","Pembelian_Supplies_Pabrik","D"),
("5.10.030.02","Potongan_Pembelian_Supplies_Pabrik","D"),
("5.10.030.03","Retur_Pembelian_Supplies_Pabrik","D"),
("5.10.030.04","Ongkos_Angkut_Pembelian_Supplies_Pabrik","D"),
("5.10.040","PEMBELIAN SUPPLIES KANTOR","I"),
("5.10.040.01","Pembelian_Supplies_Kantor","D"),
("5.10.040.02","Potongan_Pembelian_Supplies_Kantor","D"),
("5.10.040.03","Retur_Pembelian_Supplies_Kantor","D"),
("5.10.040.04","Ongkos_Angkut_Pembelian_Supplies_Kantor","D"),
("5.10.050","PEMBELIAN SPAREPART MESIN","I"),
("5.10.050.01","Pembelian_Sparepart_Mesin","D"),
("5.10.050.02","Potongan_Pembelian_Sparepart_Mesin","D"),
("5.10.050.03","Retur_Pembelian_Sparepart_Mesin","D"),
("5.10.050.04","Ongkos_Angkut_Pembelian_Sparepart_Mesin","D"),
("5.10.060","PEMBELIAN SPAREPART KENDARAAN","I"),
("5.10.060.01","Pembelian_Sparepart_Kendaraan","D"),
("5.10.060.02","Potongan_Pembelian_Sparepart_Kendaraan","D"),
("5.10.060.03","Retur_Pembelian_Sparepart_Kendaraan","D"),
("5.10.060.04","Ongkos_Angkut_Pembelian_Sparepart_Kendaraan","D"),
("5.10.075","Dipakai Sendiri","D"),
("5.10.076","Sample","D"),
("5.10.077","Rusak","D"),
("5.18","BIAYA_TENAGA_KERJA_LANGSUNG","I"),
("5.18.010","Biaya_Gaji_Reguler_Pabrik","D"),
("5.18.011","Biaya_Gaji_Lembur_Pabrik","D"),
("5.18.012","Biaya_Gaji_Borongan","D"),
("5.18.013","Biaya_Upah_di_Bebankan","D"),
("5.19","BIAYA_OVERHEAD_PABRIK","I"),
("5.19.010","Biaya_Pemakaian_Supplies_Pabrik","D"),
("5.19.011","Biaya_Pemakaian_Sparepart_Mesin","D"),
("5.19.012","Biaya_Pemakaian_BBM_&_Pelumas","D"),
("5.19.013","Biaya_Pemakaian_Listrik_Pabrik","D"),
("5.19.014","Biaya_Penyusutan_Gedung_Pabrik","D"),
("5.19.015","Biaya_Penyusutan_Mesin_dan_Peralatan","D"),
("5.19.016","Biaya_Penyusutan_Inventaris_Pabrik","D"),
("5.19.017","Biaya_Amortisasi_Jaminan Kontrak PLN","D"),
("5.19.018","Biaya_Pemeliharaan_Gedung_Pabrik","D"),
("5.19.019","Biaya_Pemeliharaan_Mesin_dan_Peralatan","D"),
("5.19.020","Biaya_Pemeliharaan_Inventaris_Pabrik","D"),
("5.19.021","Biaya_Sewa_mesin","D"),
("5.19.022","Biaya_QC_Produksi","D"),
("5.19.023","Biaya_Konsumsi Lembur Produksi","D"),
("5.19.024","Biaya_Bisyaroh_Khataman","D"),
("5.19.025","Biaya_Overhead_di_Bebankan","D"),
("5.19.026","Dipakai _Sendiri","D"),
("5.19.027","Biaya_Overhead_Lainnya","D"),
("6","BIAYA-BIAYA","I"),
("6.10","BIAYA USAHA","I"),
("6.10.010","BIAYA_ADMINISTRASI_DAN_UMUM","I"),
("6.10.010.01","Biaya_Pemakaian_Supplies_Kantor","D"),
("6.10.010.02","Biaya Pemakaian Sparepart Kendaraan Kantor","D"),
("6.10.010.03","Biaya BBM/Pelumas Kendaraan Kantor","D"),
("6.10.010.04","Biaya_Penyusutan_Gedung_Kantor","D"),
("6.10.010.05","Biaya_Penyusutan_Inventaris_Kantor","D"),
("6.10.010.06","Biaya_Penyusutan_Kendaraan_Kantor","D"),
("6.10.010.07","Biaya Amortisasi Jaminan Kontrak Perumtel","D"),
("6.10.010.08","Biaya_Pemeliharaan_Gedung_Kantor","D"),
("6.10.010.09","Biaya_Pemeliharaan_Inventaris_Kantor","D"),
("6.10.010.10","Biaya_Pemeliharaan_Kendaraan_Kantor","D"),
("6.10.010.11","Biaya Listrik, Telepon, Faximile Kantor, Internet","D"),
("6.10.010.12","Biaya_Gaji_dan_Upah_Administrasi","D"),
("6.10.010.13","Biaya Operasional Kantor Pusat","D"),
("6.10.010.14","Biaya Keamanan Lingkungan","D"),
("6.10.010.15","Biaya THR Karyawan","D"),
("6.10.010.16","Biaya Kerugian Piutang Dagang","D"),
("6.10.010.17","Biaya Jaminan Kesehatan","D"),
("6.10.010.18","Biaya Majalah, Koran, Buku dan Retribusi","D"),
("6.10.010.19","Biaya Paket, Pos, Telegram, Prangko, Meterai dan Foto Copy","D"),
("6.10.010.20","Biaya Sumbangan Sosial, Zakat, Infaq dan Shodaqoh","D"),
("6.10.010.21","Biaya Pendidikan/Kursus, Seminar, Work Shop dll.","D"),
("6.10.010.22","Biaya Makan dan Pertemuan","D"),
("6.10.010.23","Biaya Penelitian dan Pengembangan","D"),
("6.10.010.24","Biaya Perjalanan Dinas Kantor","D"),
("6.10.010.25","Biaya Pajak Bumi dan Bangunan (PBB)","D"),
("6.10.010.26","Biaya Pajak Penghasilan (PPh)","D"),
("6.10.010.27","Biaya Pajak Pertambahan Nilai (PPN)","D"),
("6.10.010.28","Biaya Amortisasi","D"),
("6.10.010.29","Biaya Kontribusi Yayasan","D"),
("6.10.010.30","Biaya Administrasi Umum lainnya","D"),
("6.10.020","BIAYA_PEMASARAN","I"),
("6.10.020.01","Biaya Pemakaian Sparepart Kendaraan Pemasaran","D"),
("6.10.020.02","Biaya_Penyusutan_Kendaraan_Pemasaran","D"),
("6.10.020.03","Biaya_Pemeliharaan_Kendaraan_Pemasaran","D"),
("6.10.020.04","Biaya BBM/Pelumas Kendaraan Pemasaran","D"),
("6.10.020.05","Biaya Pajak dan Kir Kendaraan Pemasaran","D"),
("6.10.020.06","Biaya Sewa Kendaraan Pemasaran","D"),
("6.10.020.07","Biaya_Gaji_dan_Upah_Pemasaran","D"),
("6.10.020.08","Biaya Komisi atas Penjualan","D"),
("6.10.020.09","Biaya Iklan Pemasaran","D"),
("6.10.020.10","Biaya Pengiriman","D"),
("6.10.020.11","Biaya Paket Barang Pemasaran","D"),
("6.10.020.12","Biaya Penginapan Pemasaran","D"),
("6.10.020.13","Biaya Jamuan Tamu","D"),
("6.10.020.14","Biaya THR Pemasaran","D"),
("6.10.020.15","Biaya Pemasaran Lainnya","D"),
("7","PENDAPATAN & BIAYA DI LUAR USAHA","I"),
("7.10","PENDAPATAN_DI_LUAR_USAHA","D"),
("7.010","Pendapatan Bunga Bank","D"),
("7.011","Pendapatan Bagi Hasil","D"),
("7.012","Laba Atas Penjualan Aktiva","D"),
("7.013","Pendapatan di Luar Usaha Lainnya","D"),
("8","BIAYA DILUAR USAHA","I"),
("8.10","BIAYA_DI_LUAR_USAHA","D"),
("8.10.010","Biaya Administrasi Bank","D"),
("8.10.011","Biaya Bunga Bank","D"),
("8.10.012","Biaya Bagi Hasil","D"),
("8.10.013","Rugi Atas Penjualan Aktiva","D"),
("8.10.014","Biaya di Luar Usaha Lainnya","D"),
("9","PAJAK","I"),
("9.10","Pajak Penghasilan (PPH)","D");



DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` double NOT NULL AUTO_INCREMENT,
  `kode` char(5) DEFAULT NULL,
  `nama` varchar(20) NOT NULL DEFAULT '',
  `notelepon` varchar(30) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `alamat` text,
  `golongan` char(5) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `kode` (`kode`),
  KEY `kodeid` (`kode`,`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `customer` VALUES("6","A001","Ashuika","cvn","ncols","lcnpol","001");



DROP TABLE IF EXISTS `customer_golongan`;

CREATE TABLE `customer_golongan` (
  `id` double NOT NULL AUTO_INCREMENT,
  `kode` char(5) NOT NULL DEFAULT '',
  `keterangan` varchar(50) NOT NULL DEFAULT '',
  `rekpj` varchar(50) NOT NULL DEFAULT '',
  `rekrj` varchar(50) NOT NULL DEFAULT '',
  `rekdisc` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `kode` (`kode`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `customer_golongan` VALUES("1","001","Distributor Kar Pati dan Semarang","4.10.001","4.10.002","4.10.003");



DROP TABLE IF EXISTS `do_detail`;

CREATE TABLE `do_detail` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `stock` varchar(15) DEFAULT NULL,
  `qty` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `stock` (`stock`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `do_total`;

CREATE TABLE `do_total` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT '0000-00-00',
  `cabang` char(4) DEFAULT NULL,
  `customer` char(10) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `username` varchar(50) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `tglstatus` (`tgl`,`status`),
  KEY `cabtglstatus` (`cabang`,`tgl`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `gudang`;

CREATE TABLE `gudang` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `kode` varchar(16) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `gudang` VALUES("3","01","Gudang 01","0000-00-00 00:00:00","2018-08-14 10:06:32","");



DROP TABLE IF EXISTS `hutang_kartu`;

CREATE TABLE `hutang_kartu` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `fkt` char(20) DEFAULT NULL,
  `tgl` date DEFAULT '0000-00-00',
  `cabang` varchar(15) DEFAULT NULL,
  `supplier` varchar(15) DEFAULT NULL,
  `keterangan` varchar(50) NOT NULL,
  `debet` double(16,2) DEFAULT '0.00',
  `kredit` double(16,2) DEFAULT '0.00',
  `username` varchar(50) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `fkttgl` (`fkt`,`tgl`),
  KEY `tglcabang` (`tgl`,`cabang`),
  KEY `tglcabangsupplier` (`tgl`,`cabang`,`supplier`),
  KEY `tglsupplier` (`tgl`,`supplier`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `hutang_kartu` VALUES("2","PB00118100900001","PB00118100900001","2018-10-09","001","K0002","Hut Pembelian [PB00118100900001] an Kerupuk Renyah","1000000.00","0.00","iniad","2018-10-09 09:28:25"),
("3","PB00118101000001","PB00118101000001","2018-10-10","001","K0002","Hut Pembelian [PB00118101000001] an Kerupuk Renyah","600000.00","0.00","iniad","2018-10-10 15:46:21"),
("4","PB00118101000002","PB00118101000002","2018-10-11","001","K0002","Hut Pembelian [PB00118101000002] an Kerupuk Renyah","1300000.00","0.00","iniad","2018-10-10 17:29:45"),
("5","PB00118101000003","PB00118101000003","2018-10-10","001","K0002","Hut Pembelian [PB00118101000003] an Kerupuk Renyah","67000.00","0.00","iniad","2018-10-10 18:24:41"),
("6","RB00118101400001","RB00118101400001","2018-10-14","001","K0002","Retur Pembelian [RB00118101400001] an Kerupuk Reny","0.00","6000.00","iniad","2018-10-14 20:59:14"),
("7","RB00118101400002","RB00118101400002","2018-10-14","001","K0002","Retur Pembelian [RB00118101400002] an Kerupuk Reny","0.00","6000.00","iniad","2018-10-14 20:59:36"),
("11","PH00118101600001","PB00118100900001","2018-10-16","001","K0002","Pelunasan Hutang [PH00118101600001] an Kerupuk Ren","0.00","79920.00","iniad","2018-10-16 17:26:11");



DROP TABLE IF EXISTS `hutang_pelunasan_detail`;

CREATE TABLE `hutang_pelunasan_detail` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `fkt` char(20) DEFAULT NULL,
  `jumlah` double(16,2) DEFAULT '0.00',
  `jenis` varchar(20) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `fkt` (`fkt`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `hutang_pelunasan_detail` VALUES("9","PH00118101600001","PB00118100900001","79920.00","Pembelian");



DROP TABLE IF EXISTS `hutang_pelunasan_total`;

CREATE TABLE `hutang_pelunasan_total` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT '0000-00-00',
  `cabang` varchar(15) DEFAULT NULL,
  `supplier` varchar(15) DEFAULT NULL,
  `pembelian` double(16,2) DEFAULT '0.00',
  `retur` double(16,2) DEFAULT '0.00',
  `subtotal` double(16,2) DEFAULT '0.00',
  `diskon` double(16,2) DEFAULT '0.00',
  `pembulatan` double(16,2) DEFAULT '0.00',
  `total` double(16,2) DEFAULT '0.00',
  `kasbank` double(16,2) DEFAULT '0.00',
  `rekkasbank` varchar(20) DEFAULT '',
  `status` char(1) NOT NULL DEFAULT '1',
  `username` varchar(50) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `tgl` (`tgl`),
  KEY `status` (`status`),
  KEY `tglstt` (`tgl`,`status`),
  KEY `tglcabang` (`tgl`,`cabang`),
  KEY `tglcabangsupplier` (`tgl`,`cabang`,`supplier`),
  KEY `tglsupplier` (`tgl`,`supplier`),
  KEY `tglcabangstatus` (`tgl`,`cabang`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `hutang_pelunasan_total` VALUES("1","PH00118101600001","2018-10-16","001","K0002","9990.00","0.00","9990.00","0.00","10.00","0.00","10000.00","001","1","iniad","2018-10-16 17:26:11");



DROP TABLE IF EXISTS `keuangan_bukubesar`;

CREATE TABLE `keuangan_bukubesar` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `cabang` char(3) NOT NULL,
  `tgl` date DEFAULT NULL,
  `rekening` char(20) DEFAULT NULL,
  `keterangan` char(100) DEFAULT NULL,
  `debet` double(16,2) DEFAULT '0.00',
  `kredit` double(16,2) DEFAULT '0.00',
  `datetime` datetime DEFAULT '0000-00-00 00:00:00',
  `username` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `tgl` (`tgl`),
  KEY `rekening` (`rekening`),
  KEY `idfakturtgl` (`id`,`faktur`,`tgl`),
  KEY `idtglrekening` (`id`,`tgl`,`rekening`),
  KEY `fakturtglrekening` (`faktur`,`tgl`,`rekening`),
  KEY `username` (`username`),
  KEY `tglrekcab` (`tgl`,`rekening`,`cabang`)
) ENGINE=MyISAM AUTO_INCREMENT=311 DEFAULT CHARSET=latin1;

INSERT INTO `keuangan_bukubesar` VALUES("258","CS00118100900003","001","2018-10-09","4.10.001","Penjualan Ashuika","0.00","800000.00","2018-10-09 18:20:38","iniad"),
("257","CS00118100900003","001","2018-10-09","3.90.011","Pitang Penjualan Ashuika","800000.00","0.00","2018-10-09 18:20:38","iniad"),
("256","PD00118100900003","001","2018-10-09","1.10","BBB Hasil produksi [PR00118100900001]","0.00","154000.00","2018-10-09 09:35:47","iniad"),
("255","PD00118100900003","001","2018-10-09","1.10.030.04","Hasil produksi [PR00118100900001]","154000.00","0.00","2018-10-09 09:35:47","iniad"),
("254","BB00118100900001","001","2018-10-09","1.10.030.01","Pengambilan unutk proses produksi [PR00118100900001]","0.00","10000.00","2018-10-09 09:33:00","iniad"),
("253","BB00118100900001","001","2018-10-09","1.10","Pengambilan unutk proses produksi [PR00118100900001]","10000.00","0.00","2018-10-09 09:33:00","iniad"),
("252","PB00118100900001","001","2018-10-09","1.10.010.01","Hutang Pembelian Kerupuk Renyah","0.00","1000000.00","2018-10-09 09:28:25","iniad"),
("251","PB00118100900001","001","2018-10-09","1.10.030.01","Persd. Pembelian Bahan Bakuy","1000000.00","0.00","2018-10-09 09:28:25","iniad"),
("162","PB00118101000003","001","2018-10-10","1.10.010.01","Hutang Pembelian Kerupuk Renyah","0.00","67000.00","2018-10-10 18:24:41","iniad"),
("161","PB00118101000003","001","2018-10-10","1.10.030.01","Persd. Pembelian Bahan Bakuy","67000.00","0.00","2018-10-10 18:24:41","iniad"),
("164","PB00118101000002","001","2018-10-11","1.10.010.01","Hutang Pembelian Kerupuk Renyah","0.00","1300000.00","2018-10-10 17:29:45","iniad"),
("163","PB00118101000002","001","2018-10-11","1.10.030.01","Persd. Pembelian Bahan Bakuy","1300000.00","0.00","2018-10-10 17:29:45","iniad"),
("160","PB00118101000001","001","2018-10-10","1.10.010.01","Hutang Pembelian Kerupuk Renyah","0.00","600000.00","2018-10-10 15:46:21","iniad"),
("159","PB00118101000001","001","2018-10-10","1.10.030.01","Persd. Pembelian Bahan Bakuy","600000.00","0.00","2018-10-10 15:46:21","iniad"),
("244","PR00118101400001","001","2018-10-14","1","Perintah Produksi BDP BOP","0.00","79900.00","2018-10-15 19:10:38","iniad"),
("243","PR00118101400001","001","2018-10-14","1.10.010.03","Perintah Produksi BDP BOP","79900.00","0.00","2018-10-15 19:10:38","iniad"),
("242","PR00118101400001","001","2018-10-14","1.10.010.04","Perintah Produksi BDP BTKL","0.00","900000.00","2018-10-15 19:10:38","iniad"),
("241","PR00118101400001","001","2018-10-14","1.10.010","Perintah Produksi BDP BTKL","900000.00","0.00","2018-10-15 19:10:38","iniad"),
("240","RB00118101400002","001","2018-10-14","1.10.010.01","Retur Pembelian Kerupuk Renyah","6000.00","0.00","0000-00-00 00:00:00","iniad"),
("239","RB00118101400002","001","2018-10-14","1.10.030.01","Persd. Retur Pembelian Bahan Bakuy","0.00","6000.00","0000-00-00 00:00:00","iniad"),
("238","RB00118101400001","001","2018-10-14","1.10.010.01","Retur Pembelian Kerupuk Renyah","6000.00","0.00","0000-00-00 00:00:00","iniad"),
("237","RB00118101400001","001","2018-10-14","1.10.030.01","Persd. Retur Pembelian Bahan Bakuy","0.00","6000.00","0000-00-00 00:00:00","iniad"),
("266","PD00118101500001","001","2018-10-15","1.10.010.03","BOP Hasil produksi [PR00118101400001]","0.00","79900.00","2018-10-15 20:11:54","iniad"),
("265","PD00118101500001","001","2018-10-15","1.10.010","BTKL Hasil produksi [PR00118101400001]","0.00","900000.00","2018-10-15 20:11:54","iniad"),
("264","PD00118101500001","001","2018-10-15","1.10","BBB Hasil produksi [PR00118101400001]","0.00","12000.00","2018-10-15 20:11:54","iniad"),
("263","PD00118101500001","001","2018-10-15","1.10.030.04","Hasil produksi [PR00118101400001]","991900.00","0.00","2018-10-15 20:11:54","iniad"),
("262","BB00118101500001","001","2018-10-15","1.10.030.01","Pengambilan unutk proses produksi [PR00118101400001]","0.00","12000.00","2018-10-15 19:18:00","iniad"),
("261","BB00118101500001","001","2018-10-15","1.10","Pengambilan unutk proses produksi [PR00118101400001]","12000.00","0.00","2018-10-15 19:18:00","iniad"),
("231","BB00118101300018","001","2018-10-13","1.10","Pengambilan unutk proses produksi [PR00118100900001]","10000.00","0.00","2018-10-13 11:59:27","iniad"),
("232","BB00118101300018","001","2018-10-13","1.10.030.01","Pengambilan unutk proses produksi [PR00118100900001]","0.00","10000.00","2018-10-13 11:59:27","iniad"),
("233","BB00118101300019","001","2018-10-13","1.10","Pengambilan unutk proses produksi [PR00118100900001]","1000.00","0.00","2018-10-13 12:10:38","iniad"),
("234","BB00118101300019","001","2018-10-13","1.10.030.01","Pengambilan unutk proses produksi [PR00118100900001]","0.00","1000.00","2018-10-13 12:10:38","iniad"),
("235","BB00118101300020","001","2018-10-13","1.10","Pengambilan unutk proses produksi [PR00118100900001]","132000.00","0.00","2018-10-13 13:49:19","iniad"),
("236","BB00118101300020","001","2018-10-13","1.10.030.01","Pengambilan unutk proses produksi [PR00118100900001]","0.00","132000.00","2018-10-13 13:49:19","iniad"),
("259","RJ00118100900001","001","2018-10-09","4.10.002","Retur Penjualan Ashuika","800000.00","0.00","2018-10-09 18:27:45","iniad"),
("260","RJ00118100900001","001","2018-10-09","3.90.011","Piutang Retur Penjualan Ashuika","0.00","800000.00","2018-10-09 18:27:45","iniad"),
("310","PP00118101600001","001","2018-10-16","1.10.010.04","Diskon Pelunasan Piutang an Ashuika","0.00","10.00","2018-10-16 18:55:32","iniad"),
("309","PP00118101600001","001","2018-10-16","3.90.011","Pelunasan Piutang an Ashuika","0.00","9990.00","2018-10-16 18:55:32","iniad"),
("308","PP00118101600001","001","2018-10-16","3.90.011","Pelunasan Piutang an Ashuika - mlkdm","10000.00","0.00","2018-10-16 18:55:32","iniad"),
("307","PH00118101600001","001","2018-10-16","1.10.010.01","Pelunasan Hutang an Kerupuk Renyah - Bank BRI","0.00","10000.00","2018-10-16 17:26:11","iniad"),
("306","PH00118101600001","001","2018-10-16","1.10.010.04","Pembulatan Pelunasan Hutang an Kerupuk Renyah","10.00","0.00","2018-10-16 17:26:11","iniad"),
("305","PH00118101600001","001","2018-10-16","1.10.010.01","Pelunasan Hutang an Kerupuk Renyah","9990.00","0.00","2018-10-16 17:26:11","iniad");



DROP TABLE IF EXISTS `keuangan_jurnal`;

CREATE TABLE `keuangan_jurnal` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `cabang` char(3) NOT NULL,
  `tgl` date DEFAULT NULL,
  `rekening` char(20) DEFAULT NULL,
  `keterangan` char(100) DEFAULT NULL,
  `debet` double(16,2) DEFAULT '0.00',
  `kredit` double(16,2) DEFAULT '0.00',
  `datetime` datetime DEFAULT '0000-00-00 00:00:00',
  `username` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `idfakturtgl` (`id`,`faktur`,`tgl`),
  KEY `idtglrekening` (`id`,`tgl`,`rekening`),
  KEY `fakturtglrekening` (`faktur`,`tgl`,`rekening`),
  KEY `username` (`username`),
  KEY `tgl` (`tgl`,`cabang`) USING BTREE,
  KEY `rekening` (`rekening`,`cabang`) USING BTREE,
  KEY `tglrekcab` (`tgl`,`rekening`,`cabang`),
  KEY `tglcabang` (`tgl`,`cabang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `keuangan_jurnal_tmp`;

CREATE TABLE `keuangan_jurnal_tmp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `rekening` char(20) DEFAULT NULL,
  `keterangan` char(100) DEFAULT NULL,
  `debet` double(16,2) DEFAULT '0.00',
  `kredit` double(16,2) DEFAULT '0.00',
  `datetime` datetime DEFAULT '0000-00-00 00:00:00',
  `username` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `tgl` (`tgl`),
  KEY `rekening` (`rekening`),
  KEY `idfakturtgl` (`id`,`faktur`,`tgl`),
  KEY `idtglrekening` (`id`,`tgl`,`rekening`),
  KEY `fakturtglrekening` (`faktur`,`tgl`,`rekening`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `keuangan_rekening`;

CREATE TABLE `keuangan_rekening` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode` char(20) DEFAULT NULL,
  `keterangan` char(50) DEFAULT NULL,
  `jenis` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kode` (`kode`),
  KEY `kodeid` (`id`,`kode`),
  KEY `jenis` (`jenis`)
) ENGINE=MyISAM AUTO_INCREMENT=268 DEFAULT CHARSET=latin1;

INSERT INTO `keuangan_rekening` VALUES("36","1.10.010.05","BRI NAS 003801502240153","D"),
("35","1.10.010.04","BRI 003801000741302","D"),
("34","1.10.010.03","Kas Lainnya","D"),
("33","1.10.010.02","Kas Cheque","D"),
("32","1.10.010.01","Kas di Tangan","D"),
("31","1.10.010","KAS_ELEMEN_KAS","I"),
("30","1.10","AKTIVA LANCAR","I"),
("29","1","AKTIVA","I"),
("37","1.10.010.06","BNI 3330898982","D"),
("38","1.10.010.07","BCA 0312618000","D"),
("39","1.10.010.08","Giro Bank Jateng Syariah 6071000259","D"),
("40","1.10.010.09","Kas Pembangunan","D"),
("41","1.10.020","PIUTANG","I"),
("42","1.10.020.01","Piutang_Dagang","D"),
("43","1.10.020.02","Piutang_Bilyet_Giro","D"),
("44","1.10.020.03","Cadangan_Kerugian_Piutang","D"),
("45","1.10.020.04","Piutang_Karyawan","D"),
("46","1.10.020.05","Kasbon_Karyawan","D"),
("47","1.10.020.06","Piutang_Antar_Divisi","D"),
("48","1.10.020.07","Piutang_Lainnya","D"),
("49","1.10.030","PERSEDIAAN","I"),
("50","1.10.030.01","Persediaan_Bahan_Baku","D"),
("51","1.10.030.02","Persediaan_Bahan_Penolong","D"),
("52","1.10.030.03","Persediaan_Barang_dlm_Proses","D"),
("53","1.10.030.04","Persediaan_Barang_Jadi","D"),
("54","1.10.030.05","Persediaan_Supplies_Pabrik","D"),
("55","1.10.030.06","Persediaan_Supplies_Kantor","D"),
("56","1.10.030.07","Persediaan_Sparepart_Mesin","D"),
("57","1.10.030.08","Persediaan_Sparepart_Kendaraan","D"),
("58","1.10.040","BIAYA_DIBAYAR_DI_MUKA","I"),
("59","1.10.040.01","Porsekot_Iklan","D"),
("60","1.10.040.02","Porsekot_Pembelian_Bahan_Baku","D"),
("61","1.10.040.03","Porsekot_Pembelian_Bahan_Penolong","D"),
("62","1.10.040.04","Porsekot_Pembelian_Mesin","D"),
("63","1.10.040.05","Porsekot_Pembelian_Kendaraan","D"),
("64","1.10.040.06","Porsekot_Pembelian_Tanah","D"),
("65","1.10.040.07","Porsekot_Pengiriman","D"),
("66","1.10.040.08","Porsekot_Perjalanan_Dinas","D"),
("67","1.10.040.09","Porsekot_Sewa","D"),
("68","1.10.040.10","Porsekot_Pajak","D"),
("69","1.10.040.11","Porsekot_Biaya_Lainnya","D"),
("70","1.20","AKTIVA TETAP","I"),
("71","1.20.010","AKTIVA_TETAP_BERWUJUD","I"),
("72","1.20.010.01","Tanah","D"),
("73","1.20.010.02","Gedung_Pabrik","D"),
("74","1.20.010.03","Gedung_Kantor","D"),
("75","1.20.010.04","Mesin_dan_Peralatan","D"),
("76","1.20.010.05","Inventaris_Pabrik","D"),
("77","1.20.010.06","Inventaris_Kantor","D"),
("78","1.20.010.07","Kendaraan","D"),
("79","1.20.010.08","Aktiva_Tetap_Berwujud_Lainnya","D"),
("80","1.20.020","AKUMULASI_PENYUSUTAN_AT_BERWUJUD","I"),
("81","1.20.020.01","Akumulasi_Penyusutan_Gedung_Pabrik","D"),
("82","1.20.020.02","Akumulasi_Penyusutan_Gedung_Kantor","D"),
("83","1.20.020.03","Akumulasi_Penyusutan_Mesin_dan_Peralatan","D"),
("84","1.20.020.04","Akumulasi_Penyusutan_Inv._Pabrik","D"),
("85","1.20.020.05","Akumulasi_Penyusutan_Inv._Kantor","D"),
("86","1.20.020.06","Akumulasi_Penyusutan_Kendaraan","D"),
("87","1.20.020.07","Akumulasi_Penyusutan_AT_Berwujud_Lainnya","D"),
("88","1.20.030","AKTIVA_TIDAK_BERWUJUD","I"),
("89","1.20.030.01","Patent_dan_Merk_Dagang","D"),
("90","1.20.030.02","Good_Will","D"),
("91","1.20.030.03","Royalty","D"),
("92","1.30","AKTIVA_LAIN_LAIN","I"),
("93","1.30.010","Biaya_Pendirian_Perusahaan","D"),
("94","1.30.020","Biaya_Resiko_Kecelakaan","D"),
("95","1.30.030","Jaminan_Kontrak_PLN","D"),
("96","1.30.040","Jaminan_Kontrak_Perumtel","D"),
("97","1.30.050","Bangunan_Dalam_Proses","D"),
("98","1.30.060","Piutang_Jangka_Panjang","D"),
("99","2","HUTANG","I"),
("100","2.10","HUTANG_JANGKA_PENDEK","I"),
("101","2.10.010","Hutang_Dagang","D"),
("102","2.10.011","Hutang_Cheque_dan_Bilyet_Giro","D"),
("103","2.10.012","Hutang_Gaji_dan_upah","D"),
("104","2.10.013","Iklan_Belum_Dibayar","D"),
("105","2.10.014","Hutang_Pajak","D"),
("106","2.10.015","Hutang_Komisi_Penjualan","D"),
("107","2.10.016","Uang_Muka_Penjualan","D"),
("108","2.10.017","Uang_Muka_Pengiriman","D"),
("109","2.10.018","Hutang_Royalty","D"),
("110","2.10.019","Hutang_Pembelian_Aset","D"),
("111","2.10.020","Hutang_Jangka_Pendek_Lainnya","D"),
("112","2.20","HUTANG_JANGKA_PANJANG","I"),
("113","2.20.020","Hutang_Jaminan_Distributor","D"),
("114","2.20.021","Hutang_Pihak_Ketiga","D"),
("115","2.20.022","Hutang_Bank_Jateng_Syariah","D"),
("116","2.20.023","Hipotik BNI KMK-RK","D"),
("117","2.20.024","Hipotik BNI KI","D"),
("118","2.20.025","Hutang_Pembelian_Mesin","D"),
("119","2.20.026","Hutang_Pembelian_Kendaraan","D"),
("120","2.20.027","Hipotik BRI KMK RK","D"),
("121","2.20.028","Hipotik BRI KMK Angsuran","D"),
("122","2.20.029","Hutang_Jangka_Panjang_Lainnya","D"),
("123","3","MODAL","I"),
("124","3.10","Modal_Persero","D"),
("125","3.11","Laba_Tahun_Lalu","D"),
("126","3.12","Laba_Ditahan","D"),
("127","3.13","Laba_Rugi_Bulan_Berjalan","D"),
("128","3.14","Cadangan_Modal_Kerja","D"),
("129","3.15","Cadangan_Ekspansi","D"),
("130","4","PENDAPATAN","I"),
("131","4.10","PENJUALAN","I"),
("132","4.10.001","Penjualan_Distributor_Kar_Pati_dan_semarang","D"),
("133","4.10.002","Retur_Penjualan_Distributor_Kar_Pati_dan_semarang","D"),
("134","4.10.003","Potongan_Penjualan_Distributor_Kar_Pati_dan_semara","D"),
("135","4.10.004","Penjualan_Distributor_Luar_Kar_Pati_dan_semarang","D"),
("136","4.10.005","Retur_Penjualan_Distributor_Luar_Kar_Pati_dan_sema","D"),
("137","4.10.006","Potongan_Penjualan_Distributor_Luar_Kar_Pati_dan_s","D"),
("138","4.10.007","Penjualan_Agen_Kar_Pati_dan_semarang","D"),
("139","4.10.008","Retur_Penjualan_Agen_Kar_Pati_dan_semarang","D"),
("140","4.10.009","Potongan_Agen_Kar_Pati_dan_semarang","D"),
("141","4.10.010","Penjualan_Agen_Luar_Kar_Pati_dan_semarang","D"),
("142","4.10.011","Retur_Penjualan_Agen_Luar_Kar_Pati_dan_semarang","D"),
("143","4.10.012","Potongan_Agen_Luar_Kar_Pati_dan_semarang","D"),
("144","4.10.013","Penjualan_Kepada_Karyawan","D"),
("145","5","HARGA_POKOK_PRODUKSI_DAN_PENJUALAN","I"),
("146","5.10","PEMBELIAN","I"),
("147","5.10.010","PEMBELIAN BB","I"),
("148","5.10.010.01","Pembelian_Bahan_Baku","D"),
("149","5.10.010.02","Potongan_Pembelian_Bahan_Baku","D"),
("150","5.10.010.03","Retur_Pembelian_Bahan_Baku","D"),
("151","5.10.010.04","Ongkos_Angkut_Pembelian_Bahan_Baku","D"),
("152","5.10.020","PEMBELIAN BP","I"),
("153","5.10.020.01","Pembelian_Bahan_Penolong","D"),
("154","5.10.020.02","Potongan_Pembelian_Bahan_Penolong","D"),
("155","5.10.020.03","Retur_Pembelian_Bahan_Penolong","D"),
("156","5.10.020.04","Ongkos_Angkut_Pembelian_Bahan_Penolong","D"),
("157","5.10.030","PEMBELIAN SUPPLIES PABRIK","I"),
("158","5.10.030.01","Pembelian_Supplies_Pabrik","D"),
("159","5.10.030.02","Potongan_Pembelian_Supplies_Pabrik","D"),
("160","5.10.030.03","Retur_Pembelian_Supplies_Pabrik","D"),
("161","5.10.030.04","Ongkos_Angkut_Pembelian_Supplies_Pabrik","D"),
("162","5.10.040","PEMBELIAN SUPPLIES KANTOR","I"),
("163","5.10.040.01","Pembelian_Supplies_Kantor","D"),
("164","5.10.040.02","Potongan_Pembelian_Supplies_Kantor","D"),
("165","5.10.040.03","Retur_Pembelian_Supplies_Kantor","D"),
("166","5.10.040.04","Ongkos_Angkut_Pembelian_Supplies_Kantor","D"),
("167","5.10.050","PEMBELIAN SPAREPART MESIN","I"),
("168","5.10.050.01","Pembelian_Sparepart_Mesin","D"),
("169","5.10.050.02","Potongan_Pembelian_Sparepart_Mesin","D"),
("170","5.10.050.03","Retur_Pembelian_Sparepart_Mesin","D"),
("171","5.10.050.04","Ongkos_Angkut_Pembelian_Sparepart_Mesin","D"),
("172","5.10.060","PEMBELIAN SPAREPART KENDARAAN","I"),
("173","5.10.060.01","Pembelian_Sparepart_Kendaraan","D"),
("174","5.10.060.02","Potongan_Pembelian_Sparepart_Kendaraan","D"),
("175","5.10.060.03","Retur_Pembelian_Sparepart_Kendaraan","D"),
("176","5.10.060.04","Ongkos_Angkut_Pembelian_Sparepart_Kendaraan","D"),
("177","5.10.075","Dipakai Sendiri","D"),
("178","5.10.076","Sample","D"),
("179","5.10.077","Rusak","D"),
("180","5.18","BIAYA_TENAGA_KERJA_LANGSUNG","I"),
("181","5.18.010","Biaya_Gaji_Reguler_Pabrik","D"),
("182","5.18.011","Biaya_Gaji_Lembur_Pabrik","D"),
("183","5.18.012","Biaya_Gaji_Borongan","D"),
("184","5.18.013","Biaya_Upah_di_Bebankan","D"),
("185","5.19","BIAYA_OVERHEAD_PABRIK","I"),
("186","5.19.010","Biaya_Pemakaian_Supplies_Pabrik","D"),
("187","5.19.011","Biaya_Pemakaian_Sparepart_Mesin","D"),
("188","5.19.012","Biaya_Pemakaian_BBM_&_Pelumas","D"),
("189","5.19.013","Biaya_Pemakaian_Listrik_Pabrik","D"),
("190","5.19.014","Biaya_Penyusutan_Gedung_Pabrik","D"),
("191","5.19.015","Biaya_Penyusutan_Mesin_dan_Peralatan","D"),
("192","5.19.016","Biaya_Penyusutan_Inventaris_Pabrik","D"),
("193","5.19.017","Biaya_Amortisasi_Jaminan Kontrak PLN","D"),
("194","5.19.018","Biaya_Pemeliharaan_Gedung_Pabrik","D"),
("195","5.19.019","Biaya_Pemeliharaan_Mesin_dan_Peralatan","D"),
("196","5.19.020","Biaya_Pemeliharaan_Inventaris_Pabrik","D"),
("197","5.19.021","Biaya_Sewa_mesin","D"),
("198","5.19.022","Biaya_QC_Produksi","D"),
("199","5.19.023","Biaya_Konsumsi Lembur Produksi","D"),
("200","5.19.024","Biaya_Bisyaroh_Khataman","D"),
("201","5.19.025","Biaya_Overhead_di_Bebankan","D"),
("202","5.19.026","Dipakai _Sendiri","D"),
("203","5.19.027","Biaya_Overhead_Lainnya","D"),
("204","6","BIAYA-BIAYA","I"),
("205","6.10","BIAYA USAHA","I"),
("206","6.10.010","BIAYA_ADMINISTRASI_DAN_UMUM","I"),
("207","6.10.010.01","Biaya_Pemakaian_Supplies_Kantor","D"),
("208","6.10.010.02","Biaya Pemakaian Sparepart Kendaraan Kantor","D"),
("209","6.10.010.03","Biaya BBM/Pelumas Kendaraan Kantor","D"),
("210","6.10.010.04","Biaya_Penyusutan_Gedung_Kantor","D"),
("211","6.10.010.05","Biaya_Penyusutan_Inventaris_Kantor","D"),
("212","6.10.010.06","Biaya_Penyusutan_Kendaraan_Kantor","D"),
("213","6.10.010.07","Biaya Amortisasi Jaminan Kontrak Perumtel","D"),
("214","6.10.010.08","Biaya_Pemeliharaan_Gedung_Kantor","D"),
("215","6.10.010.09","Biaya_Pemeliharaan_Inventaris_Kantor","D"),
("216","6.10.010.10","Biaya_Pemeliharaan_Kendaraan_Kantor","D"),
("217","6.10.010.11","Biaya Listrik, Telepon, Faximile Kantor, Internet","D"),
("218","6.10.010.12","Biaya_Gaji_dan_Upah_Administrasi","D"),
("219","6.10.010.13","Biaya Operasional Kantor Pusat","D"),
("220","6.10.010.14","Biaya Keamanan Lingkungan","D"),
("221","6.10.010.15","Biaya THR Karyawan","D"),
("222","6.10.010.16","Biaya Kerugian Piutang Dagang","D"),
("223","6.10.010.17","Biaya Jaminan Kesehatan","D"),
("224","6.10.010.18","Biaya Majalah, Koran, Buku dan Retribusi","D"),
("225","6.10.010.19","Biaya Paket, Pos, Telegram, Prangko, Meterai dan F","D"),
("226","6.10.010.20","Biaya Sumbangan Sosial, Zakat, Infaq dan Shodaqoh","D"),
("227","6.10.010.21","Biaya Pendidikan/Kursus, Seminar, Work Shop dll.","D"),
("228","6.10.010.22","Biaya Makan dan Pertemuan","D"),
("229","6.10.010.23","Biaya Penelitian dan Pengembangan","D"),
("230","6.10.010.24","Biaya Perjalanan Dinas Kantor","D"),
("231","6.10.010.25","Biaya Pajak Bumi dan Bangunan (PBB)","D"),
("232","6.10.010.26","Biaya Pajak Penghasilan (PPh)","D"),
("233","6.10.010.27","Biaya Pajak Pertambahan Nilai (PPN)","D"),
("234","6.10.010.28","Biaya Amortisasi","D"),
("235","6.10.010.29","Biaya Kontribusi Yayasan","D"),
("236","6.10.010.30","Biaya Administrasi Umum lainnya","D"),
("237","6.10.020","BIAYA_PEMASARAN","I"),
("238","6.10.020.01","Biaya Pemakaian Sparepart Kendaraan Pemasaran","D"),
("239","6.10.020.02","Biaya_Penyusutan_Kendaraan_Pemasaran","D"),
("240","6.10.020.03","Biaya_Pemeliharaan_Kendaraan_Pemasaran","D"),
("241","6.10.020.04","Biaya BBM/Pelumas Kendaraan Pemasaran","D"),
("242","6.10.020.05","Biaya Pajak dan Kir Kendaraan Pemasaran","D"),
("243","6.10.020.06","Biaya Sewa Kendaraan Pemasaran","D"),
("244","6.10.020.07","Biaya_Gaji_dan_Upah_Pemasaran","D"),
("245","6.10.020.08","Biaya Komisi atas Penjualan","D"),
("246","6.10.020.09","Biaya Iklan Pemasaran","D"),
("247","6.10.020.10","Biaya Pengiriman","D"),
("248","6.10.020.11","Biaya Paket Barang Pemasaran","D"),
("249","6.10.020.12","Biaya Penginapan Pemasaran","D"),
("250","6.10.020.13","Biaya Jamuan Tamu","D"),
("251","6.10.020.14","Biaya THR Pemasaran","D"),
("252","6.10.020.15","Biaya Pemasaran Lainnya","D"),
("253","7","PENDAPATAN & BIAYA DI LUAR USAHA","I"),
("254","7.10","PENDAPATAN_DI_LUAR_USAHA","I"),
("255","7.10.010","Pendapatan Bunga Bank","D"),
("256","7.10.011","Pendapatan Bagi Hasil","D"),
("257","7.10.012","Laba Atas Penjualan Aktiva","D"),
("258","7.10.013","Pendapatan di Luar Usaha Lainnya","D"),
("259","8","BIAYA DILUAR USAHA","I"),
("260","8.10","BIAYA_DI_LUAR_USAHA","I"),
("261","8.10.010","Biaya Administrasi Bank","D"),
("262","8.10.011","Biaya Bunga Bank","D"),
("263","8.10.012","Biaya Bagi Hasil","D"),
("264","8.10.013","Rugi Atas Penjualan Aktiva","D"),
("265","8.10.014","Biaya di Luar Usaha Lainnya","D"),
("266","9","PAJAK","I"),
("267","9.10","Pajak Penghasilan (PPH)","D");



DROP TABLE IF EXISTS `pembelian_detail`;

CREATE TABLE `pembelian_detail` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(20) NOT NULL,
  `stock` varchar(20) NOT NULL,
  `harga` double(16,2) NOT NULL DEFAULT '0.00',
  `qty` double(16,2) NOT NULL DEFAULT '0.00',
  `diskonqty` double(16,2) NOT NULL DEFAULT '0.00',
  `jumlah` double(16,2) NOT NULL DEFAULT '0.00',
  `diskonitem` double(16,2) NOT NULL DEFAULT '0.00',
  `totalitem` double(16,2) NOT NULL DEFAULT '0.00',
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `stock` (`stock`),
  KEY `fktstock` (`faktur`,`stock`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `pembelian_detail` VALUES("2","PB00118100900001","1808000002","1000.00","1000.00","0.00","1000000.00","0.00","1000000.00","0000-00-00 00:00:00","0000-00-00 00:00:00","iniad"),
("3","PB00118101000001","1808000002","6000.00","100.00","0.00","600000.00","0.00","600000.00","0000-00-00 00:00:00","0000-00-00 00:00:00","iniad"),
("4","PB00118101000002","1808000002","6500.00","200.00","0.00","1300000.00","0.00","1300000.00","0000-00-00 00:00:00","0000-00-00 00:00:00","iniad"),
("5","PB00118101000003","1808000002","6700.00","10.00","0.00","67000.00","0.00","67000.00","0000-00-00 00:00:00","0000-00-00 00:00:00","iniad");



DROP TABLE IF EXISTS `pembelian_retur_detail`;

CREATE TABLE `pembelian_retur_detail` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `stock` char(10) DEFAULT NULL,
  `harga` double(16,2) DEFAULT '0.00',
  `qty` double(16,2) DEFAULT '0.00',
  `jumlah` double(16,2) DEFAULT '0.00',
  `totalitem` double(16,2) DEFAULT '0.00',
  `hp` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `stock` (`stock`),
  KEY `faktur` (`faktur`),
  KEY `fktstock` (`faktur`,`stock`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `pembelian_retur_detail` VALUES("1","RB00118101400001","1808000002","3000.00","2.00","6000.00","6000.00","6000.00"),
("2","RB00118101400002","1808000002","3000.00","2.00","6000.00","6000.00","6000.00");



DROP TABLE IF EXISTS `pembelian_retur_total`;

CREATE TABLE `pembelian_retur_total` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT '0000-00-00',
  `cabang` char(3) DEFAULT NULL,
  `gudang` char(3) DEFAULT NULL,
  `supplier` char(10) DEFAULT NULL,
  `subtotal` double(16,2) DEFAULT '0.00',
  `total` double(16,2) DEFAULT '0.00',
  `kas` double(16,2) NOT NULL DEFAULT '0.00',
  `status` char(1) DEFAULT '0',
  `username` varchar(50) DEFAULT '',
  `datetime` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tgl` (`tgl`),
  KEY `faktur` (`faktur`),
  KEY `cabang` (`cabang`),
  KEY `gudang` (`gudang`),
  KEY `supplier` (`supplier`),
  KEY `fkttgl` (`faktur`,`tgl`),
  KEY `fktsupplier` (`faktur`,`supplier`),
  KEY `tglcabangstatus` (`tgl`,`cabang`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `pembelian_retur_total` VALUES("1","RB00118101400001","2018-10-14","001","01","K0002","6000.00","6000.00","0.00","1","iniad","0000-00-00 00:00:00"),
("2","RB00118101400002","2018-10-14","001","01","K0002","6000.00","6000.00","0.00","1","iniad","0000-00-00 00:00:00");



DROP TABLE IF EXISTS `pembelian_total`;

CREATE TABLE `pembelian_total` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(20) NOT NULL,
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  `fktpo` varchar(20) DEFAULT '',
  `cabang` varchar(10) NOT NULL,
  `gudang` varchar(10) NOT NULL,
  `supplier` varchar(5) DEFAULT '',
  `subtotal` double(16,2) NOT NULL DEFAULT '0.00',
  `diskon` double(16,2) NOT NULL DEFAULT '0.00',
  `persppn` double(10,2) DEFAULT '0.00',
  `ppn` double(16,2) NOT NULL DEFAULT '0.00',
  `total` double(16,2) NOT NULL DEFAULT '0.00',
  `hutang` double(16,2) NOT NULL DEFAULT '0.00',
  `kas` double(16,2) NOT NULL DEFAULT '0.00',
  `status` varchar(2) NOT NULL DEFAULT '0',
  `datetime_insert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datetime_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`) USING BTREE,
  KEY `tgl` (`tgl`),
  KEY `tglcabangstatus` (`tgl`,`cabang`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `pembelian_total` VALUES("1","PB00118100900001","2018-10-09","","001","01","K0002","1000000.00","0.00","0.00","0.00","1000000.00","1000000.00","0.00","1","2018-10-09 09:28:25","2018-10-09 09:28:25","iniad"),
("2","PB00118101000001","2018-10-10","","001","01","K0002","600000.00","0.00","0.00","0.00","600000.00","600000.00","0.00","1","2018-10-10 15:46:21","2018-10-10 15:46:21","iniad"),
("3","PB00118101000002","2018-10-11","","001","01","K0002","1300000.00","0.00","0.00","0.00","1300000.00","1300000.00","0.00","1","2018-10-10 17:29:45","2018-10-10 17:29:45","iniad"),
("4","PB00118101000003","2018-10-10","","001","01","K0002","67000.00","0.00","0.00","0.00","67000.00","67000.00","0.00","1","2018-10-10 18:24:41","2018-10-10 18:24:41","iniad");



DROP TABLE IF EXISTS `penjualan_detail`;

CREATE TABLE `penjualan_detail` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(20) NOT NULL,
  `stock` varchar(20) NOT NULL,
  `harga` double(16,2) NOT NULL DEFAULT '0.00',
  `diskonqty` double(16,2) NOT NULL DEFAULT '0.00',
  `qty` double(16,2) NOT NULL DEFAULT '0.00',
  `jumlah` double(16,2) NOT NULL DEFAULT '0.00',
  `diskonitem` double(16,2) NOT NULL DEFAULT '0.00',
  `totalitem` double(16,2) NOT NULL DEFAULT '0.00',
  `hp` double(16,2) DEFAULT '0.00',
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `stock` (`stock`),
  KEY `fktstock` (`faktur`,`stock`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `penjualan_detail` VALUES("3","CS00118100900003","1808000001","800000.00","0.00","1.00","800000.00","0.00","800000.00","0.00","0000-00-00 00:00:00","0000-00-00 00:00:00","iniad");



DROP TABLE IF EXISTS `penjualan_retur_detail`;

CREATE TABLE `penjualan_retur_detail` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `stock` varchar(15) DEFAULT NULL,
  `harga` double(16,2) DEFAULT '0.00',
  `qty` double(16,2) DEFAULT '0.00',
  `jumlah` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `stock` (`stock`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `penjualan_retur_detail` VALUES("1","RJ00118100900001","1808000003","800000.00","1.00","800000.00");



DROP TABLE IF EXISTS `penjualan_retur_total`;

CREATE TABLE `penjualan_retur_total` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT '0000-00-00',
  `cabang` char(4) DEFAULT NULL,
  `gudang` char(4) DEFAULT NULL,
  `customer` char(10) DEFAULT NULL,
  `subtotal` double(16,2) DEFAULT '0.00',
  `total` double(16,2) DEFAULT '0.00',
  `status` char(1) DEFAULT '1',
  `username` varchar(50) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `tglstatus` (`tgl`,`status`),
  KEY `cabtglstatus` (`cabang`,`tgl`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `penjualan_retur_total` VALUES("1","RJ00118100900001","2018-10-09","001","01","A001","800000.00","800000.00","1","iniad","2018-10-09 18:27:45");



DROP TABLE IF EXISTS `penjualan_total`;

CREATE TABLE `penjualan_total` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(20) NOT NULL,
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  `sj` varchar(20) DEFAULT '',
  `cabang` varchar(20) NOT NULL,
  `gudang` varchar(20) NOT NULL,
  `customer` varchar(20) NOT NULL,
  `subtotal` double(16,2) NOT NULL DEFAULT '0.00',
  `diskon` double(16,2) NOT NULL DEFAULT '0.00',
  `komplimen` double(16,2) DEFAULT '0.00',
  `ppn` double(16,2) NOT NULL DEFAULT '0.00',
  `total` double(16,2) NOT NULL DEFAULT '0.00',
  `piutang` double(16,2) NOT NULL DEFAULT '0.00',
  `kas` double(16,2) NOT NULL DEFAULT '0.00',
  `status` varchar(2) NOT NULL,
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `tgl` (`tgl`),
  KEY `fkttgl` (`faktur`,`tgl`),
  KEY `tglcabangstatus` (`tgl`,`cabang`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `penjualan_total` VALUES("3","CS00118100900003","2018-10-09","","001","01","A001","800000.00","0.00","0.00","0.00","800000.00","800000.00","0.00","1","0000-00-00 00:00:00","2018-10-09 18:20:38","iniad");



DROP TABLE IF EXISTS `piutang_kartu`;

CREATE TABLE `piutang_kartu` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `fkt` char(20) DEFAULT NULL,
  `tgl` date DEFAULT '0000-00-00',
  `cabang` varchar(15) DEFAULT NULL,
  `customer` varchar(15) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `debet` double(16,2) DEFAULT '0.00',
  `kredit` double(16,2) DEFAULT '0.00',
  `username` varchar(50) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `fkttgl` (`fkt`,`tgl`),
  KEY `tglcabang` (`tgl`,`cabang`),
  KEY `tglcabangcustomer` (`tgl`,`cabang`,`customer`),
  KEY `tglcustomer` (`tgl`,`customer`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `piutang_kartu` VALUES("1","CS00118100900001","CS00118100900001","2018-10-09","001","A001","Piutang Penjualan [CS00118100900001] an Ashuika","800000.00","0.00","iniad","2018-10-09 18:18:50"),
("2","CS00118100900002","CS00118100900002","2018-10-09","001","A001","Piutang Penjualan [CS00118100900002] an Ashuika","800000.00","0.00","iniad","2018-10-09 18:19:56"),
("3","CS00118100900003","CS00118100900003","2018-10-09","001","A001","Piutang Penjualan [CS00118100900003] an Ashuika","800000.00","0.00","iniad","2018-10-09 18:20:38"),
("4","RJ00118100900001","RJ00118100900001","2018-10-09","001","A001","Retur Penjualan [RJ00118100900001] an Ashuika","0.00","800000.00","iniad","2018-10-09 18:27:45"),
("5","PP00118101600001","CS00118100900003","2018-10-16","001","A001","Pelunasan Piutang [PP00118101600001] an Ashuika","0.00","9990.00","iniad","2018-10-16 18:55:12"),
("6","PP00118101600001","CS00118100900003","2018-10-16","001","A001","Pelunasan Piutang [PP00118101600001] an Ashuika","0.00","19980.00","iniad","2018-10-16 18:55:32");



DROP TABLE IF EXISTS `piutang_pelunasan_detail`;

CREATE TABLE `piutang_pelunasan_detail` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `fkt` char(20) DEFAULT NULL,
  `jumlah` double(16,2) DEFAULT '0.00',
  `jenis` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `fkt` (`fkt`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `piutang_pelunasan_detail` VALUES("2","PP00118101600001","CS00118100900003","19980.00","Penjualan");



DROP TABLE IF EXISTS `piutang_pelunasan_total`;

CREATE TABLE `piutang_pelunasan_total` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT '0000-00-00',
  `cabang` varchar(15) DEFAULT NULL,
  `customer` varchar(15) DEFAULT NULL,
  `penjualan` double(16,2) DEFAULT '0.00',
  `retur` double(16,2) DEFAULT '0.00',
  `subtotal` double(16,2) DEFAULT '0.00',
  `kasbank` double(16,2) DEFAULT '0.00',
  `rekkasbank` varchar(50) NOT NULL DEFAULT '',
  `diskon` double(16,2) DEFAULT '0.00',
  `pembulatan` double(16,2) DEFAULT '0.00',
  `status` char(1) NOT NULL DEFAULT '1',
  `username` varchar(50) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `tgl` (`tgl`),
  KEY `status` (`status`),
  KEY `tglstt` (`tgl`,`status`),
  KEY `tglcabang` (`tgl`,`cabang`),
  KEY `tglcabangcustomer` (`tgl`,`cabang`,`customer`),
  KEY `tglcustomer` (`tgl`,`customer`),
  KEY `tglcabangstatus` (`tgl`,`cabang`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `piutang_pelunasan_total` VALUES("1","PP00118101600001","2018-10-16","001","A001","9990.00","0.00","9990.00","10000.00","002","10.00","0.00","1","iniad","2018-10-16 18:55:32");



DROP TABLE IF EXISTS `po_detail`;

CREATE TABLE `po_detail` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `stock` varchar(15) DEFAULT NULL,
  `harga` double(16,2) DEFAULT '0.00',
  `qty` double(16,2) DEFAULT '0.00',
  `jumlah` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `stock` (`stock`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `po_detail` VALUES("1","PO00118101600001","1808000002","500.00","91.00","45500.00"),
("2","PO00118101600001","1808000002","400.00","91.00","36400.00");



DROP TABLE IF EXISTS `po_total`;

CREATE TABLE `po_total` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `fktpr` varchar(100) DEFAULT '',
  `tgl` date DEFAULT '0000-00-00',
  `cabang` char(4) DEFAULT NULL,
  `gudang` char(4) DEFAULT NULL,
  `supplier` char(10) DEFAULT NULL,
  `total` double(16,2) DEFAULT '0.00',
  `status` char(1) DEFAULT '1',
  `username` varchar(50) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `tglstatus` (`tgl`,`status`),
  KEY `cabtglstatus` (`cabang`,`tgl`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `po_total` VALUES("1","PO00118101600001","RQ00118101600004","2018-10-16","001","01","K0002","81900.00","1","iniad","2018-10-16 22:37:58");



DROP TABLE IF EXISTS `pr_detail`;

CREATE TABLE `pr_detail` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `stock` varchar(15) DEFAULT NULL,
  `qty` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `stock` (`stock`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO `pr_detail` VALUES("1","RQ00118101600001","1808000002","91.00"),
("2","RQ00118101600001","1808000002","91.00"),
("3","RQ00118101600002","1808000002","91.00"),
("4","RQ00118101600002","1808000002","91.00"),
("5","RQ00118101600003","1808000002","91.00"),
("6","RQ00118101600003","1808000002","91.00"),
("7","RQ00118101600004","1808000002","91.00"),
("8","RQ00118101600004","1808000002","91.00"),
("9","RQ00118101600005","1808000002","91.00"),
("10","RQ00118101600005","1808000002","91.00"),
("11","RQ00118101600006","1808000002","91.00"),
("12","RQ00118101600006","1808000002","91.00"),
("13","RQ00118101600007","1808000002","91.00"),
("14","RQ00118101600007","1808000002","91.00"),
("15","RQ00118101600008","1808000002","91.00"),
("16","RQ00118101600008","1808000002","91.00"),
("17","RQ00118101600009","1808000002","91.00"),
("18","RQ00118101600009","1808000002","91.00");



DROP TABLE IF EXISTS `pr_total`;

CREATE TABLE `pr_total` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT '0000-00-00',
  `cabang` char(4) DEFAULT NULL,
  `gudang` char(4) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `username` varchar(50) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `tglstatus` (`tgl`,`status`),
  KEY `cabtglstatus` (`cabang`,`tgl`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `pr_total` VALUES("1","RQ00118101600001","2018-10-16","001","01","2","iniad","2018-10-16 20:39:47"),
("2","RQ00118101600002","2018-10-16","001","01","2","iniad","2018-10-16 20:39:52"),
("3","RQ00118101600003","2018-10-16","001","01","1","iniad","2018-10-16 20:39:53"),
("4","RQ00118101600004","2018-10-16","001","01","1","iniad","2018-10-16 20:39:53"),
("5","RQ00118101600005","2018-10-16","001","01","1","iniad","2018-10-16 20:39:53"),
("6","RQ00118101600006","2018-10-16","001","01","2","iniad","2018-10-16 20:39:53"),
("7","RQ00118101600007","2018-10-16","001","01","1","iniad","2018-10-16 20:39:53"),
("8","RQ00118101600008","2018-10-16","001","01","1","iniad","2018-10-16 20:39:53"),
("9","RQ00118101600009","2018-10-16","001","01","2","iniad","2018-10-16 20:39:54");



DROP TABLE IF EXISTS `produksi_bb`;

CREATE TABLE `produksi_bb` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(30) NOT NULL,
  `fakturproduksi` varchar(30) NOT NULL,
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  `cabang` varchar(3) NOT NULL,
  `gudang` varchar(4) NOT NULL,
  `stock` varchar(20) NOT NULL,
  `qty` double(16,2) NOT NULL DEFAULT '0.00',
  `status` char(1) DEFAULT '1',
  `username` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hp` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `fkt` (`fakturproduksi`),
  KEY `tgl` (`tgl`),
  KEY `tglcab` (`tgl`,`cabang`),
  KEY `stocktglcab` (`stock`,`tgl`,`cabang`),
  KEY `stocktgl` (`stock`,`tgl`),
  KEY `tglcabangstatus` (`tgl`,`cabang`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

INSERT INTO `produksi_bb` VALUES("1","BB00118100900001","PR00118100900001","2018-10-09","001","01","1808000002","10.00","1","iniad","2018-10-09 09:33:00","1000.00"),
("2","BB00118101200001","PR00118100900001","2018-10-12","001","null","1808000002","1.00","1","iniad","2018-10-12 13:47:51","1000.00"),
("16","BB00118101300014","PR00118100900001","2018-10-13","001","01","1808000002","10.00","2","iniad","2018-10-13 11:30:36","0.00"),
("17","BB00118101300015","PR00118100900001","2018-10-13","001","01","1808000002","11.00","2","iniad","2018-10-13 11:32:55","11000.00"),
("18","BB00118101300016","PR00118100900001","2018-10-13","001","01","1808000002","1.00","2","iniad","2018-10-13 11:51:28","1000.00"),
("19","BB00118101300017","PR00118100900001","2018-10-13","001","01","1808000002","2.00","2","iniad","2018-10-13 11:53:51","0.00"),
("20","BB00118101300018","PR00118100900001","2018-10-13","001","01","1808000002","10.00","1","iniad","2018-10-13 11:59:27","1000.00"),
("21","BB00118101300019","PR00118100900001","2018-10-13","001","01","1808000002","1.00","1","iniad","2018-10-13 12:10:38","1000.00"),
("22","BB00118101300020","PR00118100900001","2018-10-13","001","01","1808000002","1000.00","1","iniad","2018-10-13 13:49:19","132.00"),
("23","BB00118101500001","PR00118101400001","2018-10-15","001","01","1808000002","2.00","1","iniad","2018-10-15 19:18:00","6000.00");



DROP TABLE IF EXISTS `produksi_bb_standart`;

CREATE TABLE `produksi_bb_standart` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) NOT NULL DEFAULT '',
  `stock` varchar(20) NOT NULL DEFAULT '',
  `qty` double(16,2) DEFAULT '0.00',
  `hp` double(16,2) DEFAULT '0.00',
  `jmlhp` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `stock` (`stock`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `produksi_bb_standart` VALUES("3","PR00118101400001","1808000002","10.00","800.00","8000.00");



DROP TABLE IF EXISTS `produksi_hasil`;

CREATE TABLE `produksi_hasil` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `fakturproduksi` char(20) DEFAULT NULL,
  `tgl` date DEFAULT '0000-00-00',
  `cabang` char(4) DEFAULT NULL,
  `gudang` char(4) DEFAULT NULL,
  `stock` char(10) DEFAULT NULL,
  `qty` double(16,2) DEFAULT '0.00',
  `hp` double(16,2) DEFAULT '0.00',
  `status` char(1) DEFAULT '1',
  `username` varchar(50) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `fakturproduksistatus` (`fakturproduksi`,`status`),
  KEY `tglstatus` (`tgl`,`status`),
  KEY `cabtglstatus` (`cabang`,`tgl`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `produksi_hasil` VALUES("4","PD00118101500001","PR00118101400001","2018-10-15","001","01","1808000003","100.00","9919.00","1","iniad","2018-10-15 20:11:54"),
("3","PD00118100900003","PR00118100900001","2018-10-09","001","01","1808000003","10.00","15400.00","1","iniad","2018-10-09 09:35:47");



DROP TABLE IF EXISTS `produksi_produk`;

CREATE TABLE `produksi_produk` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fakturproduksi` varchar(30) NOT NULL,
  `stock` varchar(20) NOT NULL,
  `qty` double(16,2) NOT NULL DEFAULT '0.00',
  `bb` double(16,2) DEFAULT '0.00',
  `btkl` double(16,2) DEFAULT '0.00',
  `bop` double(16,2) DEFAULT '0.00',
  `hargapokok` double(16,2) DEFAULT '0.00',
  `jumlah` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `fkt` (`fakturproduksi`),
  KEY `stocktglcab` (`stock`),
  KEY `stocktgl` (`stock`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `produksi_produk` VALUES("1","PR00118100900001","1808000003","10.00","0.00","0.00","0.00","1000.00","10000.00"),
("2","PR00118101100001","1808000001","10.00","5000.00","700.00","600.00","6300.00","63000.00"),
("3","PR00118101400001","1808000001","100.00","8000.00","9000.00","799.00","17799.00","1779900.00");



DROP TABLE IF EXISTS `produksi_total`;

CREATE TABLE `produksi_total` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(30) NOT NULL,
  `cabang` varchar(3) NOT NULL,
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  `status` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bb` double(16,2) DEFAULT '0.00',
  `btkl` double(16,2) DEFAULT '0.00',
  `bop` double(16,2) DEFAULT '0.00',
  `hargapokok` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `fkt` (`faktur`),
  KEY `tglcab` (`tgl`,`cabang`),
  KEY `tgl` (`tgl`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `produksi_total` VALUES("1","PR00118100900001","001","2018-10-09","1","iniad","2018-10-09 09:32:37","0.00","0.00","0.00","10000.00"),
("2","PR00118101100001","001","2018-10-11","1","iniad","2018-10-11 20:20:43","0.00","0.00","0.00","63000.00"),
("3","PR00118101400001","001","2018-10-14","1","iniad","2018-10-15 19:10:38","800000.00","900000.00","79900.00","1779900.00");



DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `kode` varchar(16) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `satuan` VALUES("1","PCS","PCS","0000-00-00 00:00:00","2018-08-12 16:39:56",""),
("2","KLG","KALENG","0000-00-00 00:00:00","2018-08-12 16:40:02","");



DROP TABLE IF EXISTS `sj_detail`;

CREATE TABLE `sj_detail` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `stock` varchar(15) DEFAULT NULL,
  `qty` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `stock` (`stock`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `sj_detail` VALUES("4","SJ00118101500001","1808000003","81.00"),
("3","SJ00118101500001","1808000001","91.00");



DROP TABLE IF EXISTS `sj_total`;

CREATE TABLE `sj_total` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `tgl` date DEFAULT '0000-00-00',
  `do` char(20) DEFAULT NULL,
  `cabang` char(4) DEFAULT NULL,
  `customer` char(10) DEFAULT NULL,
  `petugaspengirim` varchar(100) DEFAULT '',
  `nopol` varchar(100) DEFAULT '',
  `status` char(1) DEFAULT '1',
  `username` varchar(50) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `tglstatus` (`tgl`,`status`),
  KEY `cabtglstatus` (`cabang`,`tgl`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `sj_total` VALUES("1","SJ00118101500001","2018-10-15","","001","A001","kj","N ujei 90","1","iniad","2018-10-15 20:58:48");



DROP TABLE IF EXISTS `stock`;

CREATE TABLE `stock` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `kode` varchar(16) NOT NULL,
  `barcode` varchar(30) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `satuan` varchar(20) NOT NULL DEFAULT '',
  `stock_group` varchar(16) NOT NULL,
  `jenis` char(1) DEFAULT 'B',
  `hargajual` double(16,2) NOT NULL DEFAULT '0.00',
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `stock` VALUES("3","1808000001","375839678900000","fjeofjfowfjkii68687","PCS","004","P","800000.00","0000-00-00 00:00:00","2018-08-12 17:10:32","iniad"),
("4","1808000002","nskdnfks","jnk","KLG","001","B","0.00","0000-00-00 00:00:00","2018-08-29 21:38:42","iniad"),
("5","1808000003","hjgj","bub","PCS","004","P","78.00","0000-00-00 00:00:00","2018-08-29 21:38:57","iniad"),
("6","1810000001","nkvj","jdsbvk","KLG","001","P","0.00","0000-00-00 00:00:00","2018-10-16 15:03:21","iniad");



DROP TABLE IF EXISTS `stock_group`;

CREATE TABLE `stock_group` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `kode` varchar(16) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `rekpersd` varchar(30) NOT NULL,
  `rekpj` varchar(30) NOT NULL,
  `rekhpp` varchar(30) NOT NULL,
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `stock_group` VALUES("1","001","Bahan Bakuy","1.10.030.01","3.90.011","3.90.010","0000-00-00 00:00:00","2018-08-10 21:39:38","iniad"),
("2","004","Barang Jadi","1.10.030.04","4.10.007","","0000-00-00 00:00:00","2018-10-09 09:45:16","iniad");



DROP TABLE IF EXISTS `stock_hj`;

CREATE TABLE `stock_hj` (
  `id` double NOT NULL AUTO_INCREMENT,
  `kode` char(10) DEFAULT NULL,
  `cabang` char(3) DEFAULT NULL,
  `qty` double(16,2) DEFAULT '0.00',
  `hj` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `kode` (`kode`),
  KEY `cabang` (`cabang`),
  KEY `kodecabang` (`kode`,`cabang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `stock_hp`;

CREATE TABLE `stock_hp` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` varchar(20) NOT NULL DEFAULT '',
  `tgl` date DEFAULT '0000-00-00',
  `kode` char(10) DEFAULT NULL,
  `cabang` char(3) DEFAULT NULL,
  `qty` double(16,2) NOT NULL DEFAULT '0.00',
  `hp` double(16,2) DEFAULT '0.00',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `kode` (`kode`),
  KEY `cabang` (`cabang`),
  KEY `kodecabang` (`kode`,`cabang`),
  KEY `kodetgl` (`kode`,`tgl`)
) ENGINE=MyISAM AUTO_INCREMENT=724 DEFAULT CHARSET=latin1;

INSERT INTO `stock_hp` VALUES("715","PB00118100900001","2018-10-09","1808000002","001","990.00","1000.00","2018-10-09 09:28:25"),
("536","PB00118100900001","2018-10-12","1808000002","001","989.00","1000.00","2018-10-13 13:38:33"),
("718","PB00118101000001","2018-10-15","1808000002","001","72.00","6000.00","2018-10-10 15:46:21"),
("723","PD00118101500001","2018-10-15","1808000003","001","100.00","9919.00","2018-10-15 20:11:54"),
("660","PB00118101000002","2018-10-14","1808000002","001","200.00","6500.00","2018-10-10 17:29:45"),
("659","PB00118101000003","2018-10-14","1808000002","001","10.00","6700.00","2018-10-10 18:24:41"),
("654","PB00118101000002","2018-10-13","1808000002","001","200.00","6500.00","2018-10-10 17:29:45"),
("529","PB00118100900001","2018-10-10","1808000002","001","990.00","1000.00","2018-10-13 13:38:33"),
("530","PB00118101000001","2018-10-10","1808000002","001","100.00","6000.00","2018-10-10 15:46:21"),
("531","PB00118101000003","2018-10-10","1808000002","001","10.00","6700.00","2018-10-10 18:24:41"),
("532","PB00118100900001","2018-10-11","1808000002","001","990.00","1000.00","2018-10-13 13:38:33"),
("533","PB00118101000001","2018-10-11","1808000002","001","100.00","6000.00","2018-10-10 15:46:21"),
("534","PB00118101000003","2018-10-11","1808000002","001","10.00","6700.00","2018-10-10 18:24:41"),
("535","PB00118101000002","2018-10-11","1808000002","001","200.00","6500.00","2018-10-10 17:29:45"),
("537","PB00118101000001","2018-10-12","1808000002","001","100.00","6000.00","2018-10-10 15:46:21"),
("538","PB00118101000003","2018-10-12","1808000002","001","10.00","6700.00","2018-10-10 18:24:41"),
("539","PB00118101000002","2018-10-12","1808000002","001","200.00","6500.00","2018-10-10 17:29:45"),
("658","PB00118101000001","2018-10-14","1808000002","001","74.00","6000.00","2018-10-10 15:46:21"),
("653","PB00118101000003","2018-10-13","1808000002","001","10.00","6700.00","2018-10-10 18:24:41"),
("720","PB00118101000002","2018-10-15","1808000002","001","200.00","6500.00","2018-10-10 17:29:45"),
("719","PB00118101000003","2018-10-15","1808000002","001","10.00","6700.00","2018-10-10 18:24:41"),
("652","PB00118101000001","2018-10-13","1808000002","001","78.00","6000.00","2018-10-10 15:46:21"),
("717","RJ00118100900001","2018-10-09","1808000003","001","1.00","800000.00","2018-10-09 18:27:45"),
("716","PD00118100900003","2018-10-09","1808000003","001","10.00","15400.00","2018-10-09 09:35:47"),
("722","RJ00118100900001","2018-10-15","1808000003","001","1.00","800000.00","2018-10-09 18:27:45"),
("721","PD00118100900003","2018-10-15","1808000003","001","10.00","15400.00","2018-10-09 09:35:47");



DROP TABLE IF EXISTS `stock_kartu`;

CREATE TABLE `stock_kartu` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(20) NOT NULL,
  `stock` varchar(20) NOT NULL,
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  `cabang` varchar(10) NOT NULL,
  `gudang` varchar(10) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `debet` double(16,2) NOT NULL DEFAULT '0.00',
  `kredit` double(16,2) NOT NULL DEFAULT '0.00',
  `hp` double(16,2) NOT NULL DEFAULT '0.00',
  `datetime_insert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datetime_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkt` (`faktur`),
  KEY `stock` (`stock`) USING BTREE,
  KEY `tgl` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=218 DEFAULT CHARSET=latin1;

INSERT INTO `stock_kartu` VALUES("215","RJ00118100900001","1808000003","2018-10-09","001","01","retur penjualan stock Ashuika","1.00","0.00","800000.00","2018-10-09 18:27:45","2018-10-15 20:37:03","iniad"),
("214","CS00118100900003","1808000001","2018-10-09","001","01","Penjualan kasir fkt[CS00118100900003]","0.00","1.00","0.00","0000-00-00 00:00:00","2018-10-15 20:37:03","iniad"),
("213","PD00118100900003","1808000003","2018-10-09","001","01","Hasil produksi [PR00118100900001]","10.00","0.00","15400.00","2018-10-09 09:35:47","2018-10-15 20:37:03","iniad"),
("212","BB00118100900001","1808000002","2018-10-09","001","01","Pengambilan unutk proses produksi [PR00118100900001]","0.00","10.00","1000.00","2018-10-09 09:33:00","2018-10-15 20:37:03","iniad"),
("211","PB00118100900001","1808000002","2018-10-09","001","01","pembelian stock fkt[PB00118100900001]","1000.00","0.00","1000.00","2018-10-09 09:28:25","2018-10-15 20:37:03","iniad"),
("157","PB00118101000003","1808000002","2018-10-10","001","01","pembelian stock fkt[PB00118101000003]","10.00","0.00","6700.00","2018-10-10 18:24:41","2018-10-13 13:45:57","iniad"),
("158","PB00118101000002","1808000002","2018-10-11","001","01","pembelian stock fkt[PB00118101000002]","200.00","0.00","6500.00","2018-10-10 17:29:45","2018-10-13 13:46:53","iniad"),
("156","PB00118101000001","1808000002","2018-10-10","001","01","pembelian stock fkt[PB00118101000001]","100.00","0.00","6000.00","2018-10-10 15:46:21","2018-10-13 13:45:57","iniad"),
("206","BB00118101300020","1808000002","2018-10-13","001","01","Pengambilan unutk proses produksi [PR00118100900001]","0.00","1000.00","132.00","2018-10-13 13:49:19","2018-10-15 20:36:15","iniad"),
("205","BB00118101300019","1808000002","2018-10-13","001","01","Pengambilan unutk proses produksi [PR00118100900001]","0.00","1.00","1000.00","2018-10-13 12:10:38","2018-10-15 20:36:15","iniad"),
("159","BB00118101200001","1808000002","2018-10-12","001","null","Pengambilan unutk proses produksi [PR00118100900001]","0.00","1.00","1000.00","0000-00-00 00:00:00","2018-10-13 13:47:16","iniad"),
("204","BB00118101300018","1808000002","2018-10-13","001","01","Pengambilan unutk proses produksi [PR00118100900001]","0.00","10.00","1000.00","2018-10-13 11:59:27","2018-10-15 20:36:15","iniad"),
("208","RB00118101400002","1808000002","2018-10-14","001","01","Retur pembelian stock Kerupuk Renyah","0.00","2.00","3000.00","0000-00-00 00:00:00","2018-10-15 20:36:22","iniad"),
("207","RB00118101400001","1808000002","2018-10-14","001","01","Retur pembelian stock Kerupuk Renyah","0.00","2.00","3000.00","0000-00-00 00:00:00","2018-10-15 20:36:22","iniad"),
("217","PD00118101500001","1808000003","2018-10-15","001","01","Hasil produksi [PR00118101400001]","100.00","0.00","9919.00","2018-10-15 20:11:54","2018-10-15 20:37:08","iniad"),
("216","BB00118101500001","1808000002","2018-10-15","001","01","Pengambilan unutk proses produksi [PR00118101400001]","0.00","2.00","6000.00","2018-10-15 19:18:00","2018-10-15 20:37:08","iniad");



DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id` double NOT NULL AUTO_INCREMENT,
  `kode` char(5) DEFAULT NULL,
  `nama` varchar(20) NOT NULL DEFAULT '',
  `notelepon` varchar(30) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `alamat` text,
  PRIMARY KEY (`id`),
  KEY `kode` (`kode`),
  KEY `kodeid` (`kode`,`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `supplier` VALUES("5","K0002","Kerupuk Renyah","uio","uki","uik"),
("4","K0001","Kitchen Lek jo","676","6j6j","6767");



DROP TABLE IF EXISTS `sys_config`;

CREATE TABLE `sys_config` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `val` text NOT NULL COMMENT 'jika join for meta value',
  `type` varchar(20) NOT NULL,
  `other_string` text NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Key` (`title`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

INSERT INTO `sys_config` VALUES("1","inc_K180321","4","","",""),
("2","inc_KS180322","4","","",""),
("3","inc_K180322","2","","",""),
("4","inc_KM180324","6","","",""),
("5","inc_KK180324","1","","",""),
("6","inc_PA991231","15","","",""),
("7","inc_PA001991231","1","","",""),
("8","inc_PA001180831","5","","",""),
("9","inc_JR180806","1","","",""),
("10","inc_JR001700101","1","","",""),
("11","inc_JR001180806","1","","",""),
("12","inc_KM180806","2","","",""),
("13","app_title","MDT SOLUTION","","",""),
("14","kota","Malang","","",""),
("15","app_logo","./uploads/iniad.png","","",""),
("16","app_login_image","./uploads/login.jpg","","",""),
("17","reklrthlalu","3.11","","",""),
("18","reklrthberjalan","3.13","","",""),
("19","rekpendoprawal","4","","",""),
("20","rekpendoprakhir","4.10.013","","",""),
("21","rekbyoprawal","5","","",""),
("22","rekbyoprakhir","6.10.020.15","","",""),
("23","rekpendnonoprawal","7","","",""),
("24","rekpendnonoprakhir","7.10.013","","",""),
("25","rekbynonoprawal","8","","",""),
("26","rekbynonoprakhir","8.10.014","","",""),
("27","inc_stockkode1808","3","","",""),
("28","inc_PB001180816","2","","",""),
("29","rekpbdisc","3.90.010","","",""),
("30","rekpbppn","1.10.010.01","","",""),
("31","inc_PB001180817","5","","",""),
("32","inc_RB001180817","3","","",""),
("33","inc_CS001180818","8","","",""),
("34","pjgudang","01","","",""),
("35","inc_CS001180819","2","","",""),
("36","inc_PR001180821","2","","",""),
("37","inc_PR001180831","1","","",""),
("38","inc_BB001180904","4","","",""),
("39","inc_BB001180905","3","","",""),
("40","inc_PR001180905","1","","",""),
("41","inc_PD001180906","1","","",""),
("42","inc_PO001180907","1","","",""),
("43","inc_RJ001180907","4","","",""),
("44","inc_PB001180910","4","","",""),
("45","rekpbhut","1.10.010.01","","",""),
("46","inc_PB001180912","7","","",""),
("47","inc_RB001180917","3","","",""),
("48","inc_PH001180919","7","","",""),
("49","inc_CS001180921","1","","",""),
("50","rekpjpiutang","3.90.011","","",""),
("51","inc_CS001180922","5","","",""),
("52","inc_RJ001180922","3","","",""),
("53","inc_PP001180922","2","","",""),
("54","inc_DO001180923","1","","",""),
("55","inc_SJ001180923","2","","",""),
("56","inc_CS001180923","1","","",""),
("57","inc_aktivakode1809","1","","",""),
("58","inc_PR001180928","4","","",""),
("59","inc_PB001180929","2","","",""),
("60","inc_PR001180930","3","","",""),
("61","rekprproduksi","1.10.030.03","","",""),
("62","inc_BB001180930","5","","",""),
("63","inc_PD001180930","6","","",""),
("64","inc_JR001181001","1","","",""),
("65","rekpajakawal","9","","",""),
("66","rekpajakakhir","9.10","","",""),
("67","inc_KM181005","1","","",""),
("68","inc_KM001700101","1","","",""),
("69","inc_KM001181005","4","","",""),
("70","inc_KK001181005","4","","",""),
("71","inc_PB001181008","2","","",""),
("72","inc_PB001181009","1","","",""),
("73","inc_PR001181009","1","","",""),
("74","inc_BB001181009","1","","",""),
("75","inc_PD001181009","3","","",""),
("76","inc_CS001181009","3","","",""),
("77","inc_RJ001181009","1","","",""),
("78","inc_PB001181010","3","","",""),
("79","inc_PR001181011","1","","",""),
("80","inc_BB001181012","1","","",""),
("81","inc_BB001181013","20","","",""),
("82","inc_PR001181014","1","","",""),
("83","inc_RB001181014","2","","",""),
("84","rekprbdpbbb","1.10","","",""),
("85","rekprbdpbtkl","1.10.010","","",""),
("86","rekprbdpbop","1.10.010.03","","",""),
("87","rekprbtkldibebankan","1.10.010.04","","",""),
("88","rekprbopdibebankan","1","","",""),
("89","inc_BB001181015","1","","",""),
("90","inc_PD001181015","1","","",""),
("91","inc_SJ001181015","1","","",""),
("92","inc_stockkode1810","1","","",""),
("93","rekpbhutdisc","1.10.010.02","","",""),
("94","rekpbhutpembulatan","1.10.010.04","","",""),
("95","rekpjpiutangdisc","1.10.010.04","","",""),
("96","rekpjpiutangpembulatan","1.10.010.03","","",""),
("97","inc_PH001181016","1","","",""),
("98","inc_PP001181016","1","","",""),
("99","inc_RQ001181016","9","","",""),
("100","inc_PO001181016","1","","","");



DROP TABLE IF EXISTS `sys_config_hpp`;

CREATE TABLE `sys_config_hpp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  `caraperhitungan` varchar(10) NOT NULL,
  `periode` varchar(10) NOT NULL,
  `bdp` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tgl` (`tgl`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `sys_config_hpp` VALUES("1","2018-10-01","F","Hari","SC");



DROP TABLE IF EXISTS `sys_import`;

CREATE TABLE `sys_import` (
  `id` bigint(11) NOT NULL,
  `tablename` varchar(20) NOT NULL,
  `tableid` bigint(11) NOT NULL,
  `importkey` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `itablename` (`tablename`,`tableid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS `sys_module`;

CREATE TABLE `sys_module` (
  `name` varchar(20) NOT NULL,
  `path` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `id` int(10) NOT NULL,
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sys_module` VALUES("Administrator","admin","","1","2017-03-15 17:00:00","2017-03-15 17:00:00");



DROP TABLE IF EXISTS `sys_username`;

CREATE TABLE `sys_username` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `data_var` longtext,
  `lastchangepass` datetime DEFAULT NULL,
  `cabang` char(3) NOT NULL,
  `rekkas` varchar(20) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `UserPass` (`username`,`password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sys_username` VALUES("iniad","d154c23962918b23239809a675ef3b8ad860bff50000","Administrator","2017-03-14 00:00:00","{\"ava\":\".\\/uploads\\/users\\/iniad.png\"}","2017-03-14 00:00:00","001","1.10.010.01");



DROP TABLE IF EXISTS `sys_username_level`;

CREATE TABLE `sys_username_level` (
  `code` char(4) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL,
  `value` longtext NOT NULL,
  `dashboard` varchar(100) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sys_username_level` VALUES("0001","Kasir","5bdb1422b2a318d656ae0bfd2fae9608,a88ad3a75f88bbe93b64a7c55ade7a5d,db9f5e82523bdec53a2a5d6cd4d174d1,e7d707a26e7f7b6ff52c489c60e429b1,4e3b6d3bab6dfd4124f9cf3b244d1147,f28ae48c707f7bcb30723d1fe9c9991f,dcaaf5237b6c18f979b4383fb42d3be3,774222ee0a004d1dc1ef62aacb2555aa,f5a5d30b97534a07dfcab5a5a2769b53","{\"md5\":\"6793ab20b093fe614b86fd501893a924\",\"name\":\"Dashboard\"}");



