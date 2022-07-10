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
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

INSERT INTO `aset` VALUES("1","1810000001","001","Gedung Pabrik","2016-01-01","0001","20","311183750.00","1.00","0","1","5.00","0.00","0.00","0000-00-00",""),
("2","1810000002","001","Gedung Kantor","2012-10-01","0002","20","75000000.00","1.00","0","1","5.00","0.00","0.00","0000-00-00",""),
("3","1810000003","001","Mesin Reverse Osmosis besar","2012-11-01","0003","12","85000000.00","1.00","0","1","8.30","0.00","0.00","0000-00-00",""),
("4","1810000004","001","Mesin Reverse Osmosis kecil","2011-05-01","0003","12","65000000.00","1.00","0","1","8.30","0.00","0.00","0000-00-00",""),
("5","1810000005","001","Mesin Cup 4 Line dan Kompresor","2012-02-01","0003","12","150000000.00","1.00","0","1","8.30","0.00","0.00","0000-00-00",""),
("6","1810000006","001","Mesin Cup 2 Line dan Kompresor","2011-09-01","0003","12","65000000.00","1.00","0","1","8.30","0.00","0.00","0000-00-00",""),
("7","1810000007","001","Ozon Kecil 1","2011-05-01","0003","8","1500000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("8","1810000008","001","Ozon Kecil 2","2012-03-01","0003","8","1500000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("9","1810000009","001","Kompresor","2011-05-01","0003","8","4500000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("10","1810000010","001","Kompresor","2012-03-01","0003","8","4500000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("11","1810000011","001","pompa jet 100 s","2011-05-01","0003","8","850000.00","3.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("12","1810000012","001","pompa YL (1) 8022","2012-03-01","0003","8","650000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("13","1810000013","001","pompa YL (2) 8022","2012-03-01","0003","8","650000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("14","1810000014","001","pompa DB 175","2013-03-01","0003","8","1200000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("15","1810000015","001","pompa PS 226 BT","2013-03-01","0003","8","3500000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("16","1810000016","001","Ultrafiltrasi (1)","2011-05-01","0003","8","25000000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("17","1810000017","001","Ultrafiltrasi (2)","2012-02-01","0003","8","52500000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("18","1810000018","001","Mesin Pompa Air (diesel-sanyo)","2014-04-04","0003","8","1225000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("19","1810000019","001","Carton Sealer ","2015-04-12","0003","4","14421500.00","2.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("20","1810000020","001","Carton Coder","2015-04-12","0003","4","4500000.00","2.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("21","1810000021","001","Kompresor 15 HP \"UNITED\"","2015-04-12","0003","4","24700000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("22","1810000022","001","Mesin Automatic Filling cup & Sealer 8L Cutter 16","2015-04-12","0003","4","322463000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("23","1810000023","001","Conveyor Belt + Conveyor Pembalik ","2015-04-12","0003","4","20000000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("24","1810000024","001","Mesin Automatic Filling cup & Sealer 8L Cutter 17","2015-04-30","0003","4","410800.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("25","1810000025","001","Pompa Bossco SW - 60 1phase","2015-05-07","0003","4","1900000.00","2.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("26","1810000026","001","Pompa CNP CHLF 4 - 60 3phase","2015-05-07","0003","4","3900000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("27","1810000027","001","Sensor Prox PR 12 - 2 DN ","2015-05-07","0003","4","118000.00","3.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("28","1810000028","001","SSL -03 Autotech ","2015-05-07","0003","4","10000.00","2.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("29","1810000029","001","CTD, lampu UV, Calfon manganise,dll","2015-06-06","0003","4","8560000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("30","1810000030","001","Heater","2015-06-13","0003","4","200000.00","4.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("31","1810000031","001","Ultrafiltrasi (3) 4 buah","2015-06-16","0003","4","2750000.00","4.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("34","1810000034","001","Meja Kantor ( 3 meja )","2012-10-01","0005","8","1000000.00","3.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("36","1810000036","001","Kursi Kantor busa kuning ","2012-10-01","0005","8","750000.00","3.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("38","1810000038","001","Mesin Money Detector Tisor ","2014-06-15","0005","8","375000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("40","1810000040","001","Kursi Kantor \"tiger\" hitam","2010-10-01","0005","8","200000.00","5.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("44","1810000044","001","Kursi dan meja tamu","2011-10-01","0005","8","725000.00","4.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("45","1810000045","001","Meja Gudang","2010-10-01","0005","8","185000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("46","1810000046","001","Modem Vodavone E 172","2010-10-01","0005","4","240000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("47","1810000047","001","Tangkir air stainless 1000 liter (1) merk \"TIRTA\"","2007-02-01","0004","8","2250000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("48","1810000048","001","Laptop \"Asus i 5\"","2010-10-01","0005","4","6470000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("49","1810000049","001","Komputer Dual Core (2 CPU)","2010-10-01","0005","4","3625000.00","2.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("50","1810000050","001","Tangkir air stainless 1050 liter (1) merk \"profil\"","2011-05-01","0004","8","2500000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("51","1810000051","001","Printer HP Laser Jet","2012-02-01","0005","4","895000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("52","1810000052","001","Almari Arsip ","2012-10-01","0005","4","1870000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("54","1810000054","001","Handphone \"Samsung gtc 3322\"","2012-10-01","0005","4","555000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("55","1810000055","001","Handphone \"Nokia 1200\"","2012-10-01","0005","4","220000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("56","1810000056","001","Kipas Angin \"Miyako\"","2012-10-01","0005","4","250000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("57","1810000057","001","HP Samsung CDMA B299","2012-10-01","0005","8","480000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("58","1810000058","001","Housing Bening 6 buah","2015-06-16","0003","4","160000.00","6.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("60","1810000060","001","Almari Pakaian","2013-06-29","0005","4","2700000.00","2.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("61","1810000061","001","TV Tabung 21\"","2013-06-11","0005","4","650000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("62","1810000053","001","Telephone \"Panasonic\"","2012-10-01","0005","4","125000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("63","1810000062","001","Tangkir air stainless 1050 liter (2) merk \"profil\"","2011-05-01","0004","8","2500000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("64","1810000063","001","AC Kantor Panasonic 1pk","2013-10-01","0005","8","3900000.00","3.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("65","1810000064","001","Tangkir air stainless 1050 liter (3) merk \"profil\"","2011-05-01","0004","8","2500000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("66","1810000065","001","Tangkir air stainless 1100 liter (1) merk \"profil\"","2012-02-01","0004","8","2500000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("67","1810000066","001","Almari Sudut Hias","2013-11-01","0005","8","1050000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("68","1810000067","001","Tangkir air stainless 2500 liter (1) merk \"profil\"","2012-02-01","0004","8","3750000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("69","1810000068","001","Camera Digital Panasonic SZ 1","2013-11-03","0005","8","2000000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("70","1810000069","001","Tangkir air plastik 5000 liter (1) merk \"PENGUIN\"","2012-02-01","0004","8","5600000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("71","1810000070","001","Notebook Sony VAIO","2013-11-13","0005","8","6000000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("72","1810000071","001","Tangkir air plastik 5000 liter (2) merk \"PENGUIN\"","2012-02-02","0004","8","5600000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("73","1810000072","001","Tangkir air plastik 5000 liter (3) merk \"PENGUIN\"","2012-02-03","0004","8","5600000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("74","1810000073","001","HP Nokia 206 GSM wrn Putih","2014-03-08","0005","8","650000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("75","1810000074","001","Mesin Filling Botol","2016-01-31","0003","8","245000000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("76","1810000075","001","Tangkir air plastik 5000 liter (4) merk \"PENGUIN\"","2011-05-01","0004","8","5600000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("77","1810000076","001","Mesin Fax Panasonic","2014-06-15","0005","8","2200000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("78","1810000077","001","Tangkir air plastik 1050 liter (1) merk \"PENGUIN\"","2011-05-01","0004","8","1300000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("79","1810000078","001","Pompa Air - FWP41ss ","2016-04-16","0003","4","950000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("80","1810000079","001","Tangkir air plastik 1050 liter (2) merk \"PENGUIN\"","2012-05-01","0004","8","1300000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("81","1810000080","001","Tangkir air plastik 1050 liter (3) merk \"PENGUIN\"","2011-05-10","0004","8","1300000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("82","1810000081","001","Almari Arsip-merk VIP","2014-09-24","0005","8","2300000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("83","1810000082","001","Mesin Galon 1 ","2016-05-01","0003","4","50000000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("84","1810000083","001","AC Panasonic 1/2 pk - Ruang Lab","2014-11-12","0005","8","3500000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("85","1810000084","001","Tangkir air plastik 1050 liter (4) merk \"PENGUIN\"","2011-05-10","0004","8","1300000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("86","1810000085","001","Komputer PC core i3","2015-11-18","0005","8","5500000.00","2.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("87","1810000086","001","Tangkir air plastik 520 liter (1) merk \"PENGUIN\"","2011-05-01","0004","8","750000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("88","1810000087","001","Tangkir air plastik 520 liter (2) merk \"PENGUIN\"","2011-05-02","0004","8","750000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("89","1810000088","001","Printer LX 310 EPSON","2015-11-18","0005","8","2000000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("90","1810000089","001","Tangkir air plastik 520 liter (3) merk \"PENGUIN\"","2011-05-03","0004","8","750000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("91","1810000090","001","HP LENOVO A6000 PLUS","2016-02-11","0005","2","1650000.00","1.00","0","1","50.00","0.00","0.00","0000-00-00",""),
("92","1810000091","001","Tangkir air plastik 520 liter (4) merk \"PENGUIN\"","2011-05-04","0004","8","750000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("93","1810000092","001","Troli ( alat angkut ) 1","2011-05-05","0004","8","320000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("94","1810000093","001","Meja Kayu Kantor","2016-02-28","0005","8","1750000.00","2.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("95","1810000094","001","Troli ( alat angkut ) 2","2012-02-01","0004","8","320000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("96","1810000095","001","Troli ( alat angkut ) 3","2012-02-01","0004","8","320000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("97","1810000096","001","Meja Bundar + Kursi Kayu (1+4)","2017-01-18","0005","8","1750000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("98","1810000097","001","Meja+Kursi (1set) Direktur","2017-04-30","0005","4","3250000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("99","1810000098","001","Finger Print Absen - Time Tech T66","2017-05-06","0005","4","2049000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("100","1810000099","001","Troli ( alat angkut ) 4","2013-02-01","0004","8","320000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("101","1810000100","001","Dryer","2011-06-01","0004","8","250000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("103","1810000102","001","Mobil Avanza Th 2014-K 9441 ZB","2015-06-22","0006","8","80000000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("104","1810000103","001","Kipas angin \"Miyako\" ( 1 buah )","2013-09-01","0004","8","235000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("105","1810000101","001","Motor \"Samson\"","2010-08-01","0006","16","0.00","1.00","0","1","6.30","0.00","0.00","0000-00-00",""),
("106","1810000104","001","Troli ( alat angkut ) 5","2013-08-01","0004","8","400000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("107","1810000105","001","Tangki Air 5000 Liter BESI","2013-09-01","0004","8","6500000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("108","1810000106","001","ISUZU / NKR 71 E2-2 NOPOL K 1930 GD","2014-01-15","0007","16","352056000.00","1.00","0","1","6.30","0.00","0.00","0000-00-00",""),
("109","1810000107","001","Dryer Makita","2012-06-01","0004","8","415000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("110","1810000108","001","Blok Heater 2 unit - Wirastri Engenering","2016-08-07","0003","4","15000000.00","2.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("111","1810000109","001","ISUZU / NKR 71 E2-2 NOPOL K 1952 GD","2015-01-15","0007","16","358716000.00","1.00","0","1","6.30","0.00","0.00","0000-00-00",""),
("112","1810000110","001","Carton Sealer (mesin lakban)","2016-10-23","0003","4","15500000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("113","1810000111","001","Dryer Einhill (1)","2013-06-01","0004","8","375000.00","2.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("114","1810000112","001","ISUZU NOPOL K 1979 EK","2015-01-24","0007","16","353500000.00","1.00","0","1","6.30","0.00","0.00","0000-00-00",""),
("115","1810000113","001","Mesin Automatic Filling cup & Sealer 8L Cutter 16 ","2016-10-23","0003","4","315000000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("116","1810000114","001","Conveyor Belt + Conveyor Pembalik (2)","2016-10-23","0003","4","20000000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("117","1810000115","001","ISUZU NOPOL K 1980 EK","2015-01-24","0007","16","353500000.00","1.00","0","1","6.30","0.00","0.00","0000-00-00",""),
("118","1810000116","001","Heater [20170129]","2017-01-29","0003","1","475000.00","1.00","0","1","100.00","0.00","0.00","0000-00-00",""),
("119","1810000117","001","ISUZU NOPOL K 1981 EK","2018-10-15","0007","16","353500000.00","1.00","0","1","6.30","0.00","0.00","0000-00-00",""),
("120","1810000118","001","ISUZU NOPOL K 1842 FK","2015-10-30","0007","16","332920000.00","1.00","0","1","6.30","0.00","0.00","0000-00-00",""),
("121","1810000119","001","Kompresor 15 HP \"SUPERCOM\"","2017-05-05","0003","4","28000000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("122","1810000120","001","ISUZU NOPOL K 1421 JK","2016-10-21","0007","16","242982000.00","1.00","0","1","6.30","0.00","0.00","0000-00-00",""),
("123","1810000121","001","Tangkir air plastik 5000 liter (5) merk \"PENGUIN\"","2017-05-05","0003","4","7040000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("124","1810000122","001","ISUZU NOPOL K 1422 JK","2016-10-21","0007","16","242982000.00","1.00","0","1","6.30","0.00","0.00","0000-00-00",""),
("125","1810000123","001","Travo las MMA 120 mp","2017-11-05","0003","3","1300000.00","1.00","0","1","33.30","0.00","0.00","0000-00-00",""),
("126","1810000124","001","Bak Truk Baru K 1421 JK","2016-12-16","0007","16","26250000.00","1.00","0","1","6.30","0.00","0.00","0000-00-00",""),
("127","1810000125","001","Bak Truk Baru K 1422 JK","2016-12-16","0007","16","26250000.00","1.00","0","1","6.30","0.00","0.00","0000-00-00",""),
("128","1810000126","001","Tangkir air stainless 2000 liter (1) merk \"TIRTA\"","2011-05-01","0004","8","3500000.00","2.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("129","1810000127","001","Rak / Bucket Mesin Tabung Temporari","2015-04-16","0004","4","1600000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("130","1810000128","001","meja gudang (2)","2013-11-01","0004","4","450000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("131","1810000129","001","AC Panasonic 1 PK -Ruang Produksi","2015-05-05","0004","4","3750000.00","2.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("132","1810000130","001","Meja Lipat Khataman ","2014-11-01","0004","4","50000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("133","1810000131","001","Pompa Air Panasonic ( Second)","2015-06-21","0004","4","349000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("134","1810000132","001","Kursi Plastik Dudukan (1)","2014-01-01","0004","4","30000.00","2.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("135","1810000133","001","Bucket / Rak","2015-06-06","0004","4","1100000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("136","1810000134","001","Dryer Einhill (2)","2014-02-14","0004","8","415000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("137","1810000135","001","Tabung Treatment","2015-06-06","0004","4","1200000.00","4.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("138","1810000136","001","Tangga Lipat (1 buah)","2014-10-19","0004","8","570000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("139","1810000137","001","Mesin cuci pembersih galon ","2014-10-20","0004","8","475000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("140","1810000138","001","Troli Besar","2015-07-07","0004","4","340000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("141","1810000139","001","Kursi Plastik Dudukan (2)","2014-10-29","0004","8","22500.00","2.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("142","1810000140","001","AC Panasonic 1 PK","2015-11-23","0004","8","3800000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("143","1810000141","001","Lampu Emergency ","2014-11-04","0004","8","54000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("144","1810000142","001","Troli (Alat Angkut) 5","2015-11-23","0004","4","400000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("145","1810000143","001","Kursi Plastik Dudukan (3)","2014-11-08","0004","8","15000.00","3.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("146","1810000144","001","Tangga BI 2,5 M [30-12-15]","2015-12-30","0004","4","700000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("147","1810000145","001","PH Meter Air (1)","2014-11-27","0004","8","375000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("148","1810000146","001","Pompa dan Dinamo","2015-09-03","0004","4","3570000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("149","1810000147","001","TDS Meter (2)","2014-11-13","0004","8","250000.00","2.00","0","1","12.50","0.00","0.00","0000-00-00",""),
("150","1810000148","001","Dryer Einhill (4)","2016-01-28","0004","4","801000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("151","1810000149","001","Elektrolisa (1)","2015-02-04","0004","4","125000.00","2.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("152","1810000150","001","Exhaws Dinding ruang produksi (1)","2015-02-07","0004","4","275000.00","2.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("153","1810000151","001","Kipas Angin Dinding 12\"Maspion\"","2016-09-01","0004","1","260000.00","1.00","0","1","100.00","0.00","0.00","0000-00-00",""),
("154","1810000152","001","Dryer Einhill (3)","2015-04-13","0004","4","465500.00","2.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("155","1810000153","001","Dryer Kun (5)","2017-04-29","0004","4","440000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("156","1810000154","001","Pompa Air CHLF","2017-10-26","0004","4","3900000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("157","1810000155","001","Silinder P 125x35","2017-10-28","0004","4","2155000.00","1.00","0","1","25.00","0.00","0.00","0000-00-00",""),
("158","1810000156","001","Tangkir air stainless 1000 liter (2) merk \"TIRTA\"","2012-05-01","0004","8","2250000.00","1.00","0","1","12.50","0.00","0.00","0000-00-00","");



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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `aset_golongan` VALUES("2","0001","Gedung Pabrik","1.20.020.01","5.19.014","A"),
("3","0002","Gedung Kantor","1.20.020.02","6.10.010.04","A"),
("4","0003","Mesin dan Peralatan","1.20.020.03","5.19.015","A"),
("5","0004","Inventaris Pabrik","1.20.020.04","5.19.016","A"),
("6","0005","Inventaris Kantor","1.20.020.05","6.10.010.05","A"),
("7","0006","Kendaraan Kantor","1.20.020.06","6.10.010.06","A"),
("8","0007","Kendaraan Pemasaran","1.20.020.06","6.10.020.02","A"),
("9","0008","AT Berwujud Lainnya","1.20.020.07","8.10.010","A");



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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO `bank` VALUES("2","0001","Kas di Tangan","1.10.010.01","0000-00-00 00:00:00","2018-10-15 14:14:30",""),
("3","0002","Kas Cheque","1.10.010.02","0000-00-00 00:00:00","2018-10-15 14:14:57",""),
("4","0003","Kas Lainnya","1.10.010.03","0000-00-00 00:00:00","2018-10-15 14:15:13",""),
("5","0004","BRI 003801000741302","1.10.010.04","0000-00-00 00:00:00","2018-10-15 14:17:56",""),
("6","0005","BRI NAS 003801502240153","1.10.010.05","0000-00-00 00:00:00","2018-10-15 14:18:55",""),
("7","0006","BNI 3330898982","1.10.010.06","0000-00-00 00:00:00","2018-10-15 14:19:29",""),
("8","0007","BCA 0312618000","1.10.010.07","0000-00-00 00:00:00","2018-10-15 14:20:02",""),
("9","0008","Giro Bank Jateng Syariah 6071000259","1.10.010.08","0000-00-00 00:00:00","2018-10-15 14:21:01",""),
("10","0009","Kas Pembangunan","1.10.010.09","0000-00-00 00:00:00","2018-10-15 14:21:27","");



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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

INSERT INTO `customer` VALUES("7","0001","GUS AZIZ","-","-","BLORA","0001"),
("8","0002","GUS SYAIFUL  ","-","--","JEPARA","0001"),
("9","0003","BP. HUMAM  ","-","-","PATI","0001"),
("10","0006","MUBAROKATAN AMDK ","-","-","KUDUS","0001"),
("11","0004","BU.ISTIQOMAH ","-","-","DEMAK","0001"),
("12","0007","BP. MANSURON","-","-"," PURWODADI","0001"),
("13","0005","CV. ABUYA  ","-","-","SEMARANG","0001"),
("14","0008","GUS MUHIB ","-","-","SEMARANG","0001"),
("15","0009","BP. MULAZIM ","-","-","KENDAL","0001"),
("16","0010","BP. SHOLAHUDDIN  ","-","-","BATANG","0001"),
("17","0011","USTADZ IZZUDIN ","-","-","BREBES","0002"),
("18","0012","BU. HALIMAH","-","-","JOMBANG","0002"),
("19","0013","USTADZ TAUFIQ","-","-"," SOLO","0002"),
("20","0015","PONPES \'AINUL YAQIN ","-","-","BANYUMAS","0002"),
("21","0014","BP. CHAIZUS SU\'AD (T","-","-","MAGETAN","0002"),
("22","0017","BU NUR HAYATI ","-","-","SALATIGA","0002"),
("23","0016","BP. ANAM","-","-","  JOMBANG","0002"),
("24","0018","BP. SINAR PRIYANTO ","-","-","KEDIRI","0002"),
("25","0019","BP. MUNAWIR  ","-","-","JOGJA","0002"),
("26","0020","GUS ZAKI / PONPES TI","-","-","MAGELANG","0002"),
("27","0021","BP. NUR SHODIQ A ","-","-","MALANG","0002"),
("28","0023","BP. HAMIM / SHODIQ ","-","-","MALANG","0002"),
("29","0022","YAI NOOR KHOLIS","-","-","KEBUMEN","0002"),
("30","0025","BP. MAHFUD ","-","-","KEBUMEN","0002"),
("31","0024","BP. AHID ","-","-","REMPOA JAKARTA","0002"),
("32","0027","BU. YAHYA","-","-","KROYA - CILACAP","0002"),
("36","0028","BP. JUNAIDI","-","-","JAKARTA","0002"),
("35","0026","PONPES ABU DZARRIN","-","-","BOJONEGORO","0002"),
("37","0029","PONPES AN NAHL / BP.","-","-","PURBALINGGA","0002");



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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

INSERT INTO `customer_golongan` VALUES("22","0001","PENJ_DIST_KARISIDENAN_PATI_DAN_SEMARANG","1.10.020.01","4.10.001","4.10.003"),
("23","0002","PENJ_DIST_LUAR_KAR_PATI_DAN_SEMARANG","1.10.020.01","4.10.004","4.10.006"),
("24","0003","PENJ_AGEN_KAR_PATI_DAN_SEMARANG","1.10.020.01","4.10.007","4.10.009"),
("25","0004","PENJ_AGEN_LUAR_KAR_PATI_DAN_SEMARANG","1.10.020.01","4.10.010","4.10.012");



DROP TABLE IF EXISTS `do_detail`;

CREATE TABLE `do_detail` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `stock` varchar(15) DEFAULT NULL,
  `qty` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `stock` (`stock`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `do_detail` VALUES("1","DO00118101700001","1810000002","10.00");



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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `do_total` VALUES("1","DO00118101700001","2018-10-17","001","0014","1","iniad","2018-10-17 13:18:02");



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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `hutang_kartu` VALUES("2","PB00118100900001","PB00118100900001","2018-10-09","001","K0002","Hut Pembelian [PB00118100900001] an Kerupuk Renyah","1000000.00","0.00","iniad","2018-10-09 09:28:25"),
("3","PB00118101000001","PB00118101000001","2018-10-10","001","K0002","Hut Pembelian [PB00118101000001] an Kerupuk Renyah","600000.00","0.00","iniad","2018-10-10 15:46:21"),
("4","PB00118101000002","PB00118101000002","2018-10-11","001","K0002","Hut Pembelian [PB00118101000002] an Kerupuk Renyah","1300000.00","0.00","iniad","2018-10-10 17:29:45"),
("5","PB00118101000003","PB00118101000003","2018-10-10","001","K0002","Hut Pembelian [PB00118101000003] an Kerupuk Renyah","67000.00","0.00","iniad","2018-10-10 18:24:41"),
("6","PB00118101600001","PB00118101600001","2018-10-16","001","0041","Hut Pembelian [PB00118101600001] an [H] CV FENINDO","500000.00","0.00","iniad","2018-10-16 22:02:53");



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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




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
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

INSERT INTO `keuangan_bukubesar` VALUES("54","RJ00118100900001","001","2018-10-09","3.90.011","Piutang Retur Penjualan Ashuika","0.00","800000.00","2018-10-09 18:27:45","iniad"),
("53","RJ00118100900001","001","2018-10-09","4.10.002","Retur Penjualan Ashuika","800000.00","0.00","2018-10-09 18:27:45","iniad"),
("52","CS00118100900003","001","2018-10-09","4.10.001","Penjualan Ashuika","0.00","800000.00","2018-10-09 18:20:38","iniad"),
("51","CS00118100900003","001","2018-10-09","3.90.011","Pitang Penjualan Ashuika","800000.00","0.00","2018-10-09 18:20:38","iniad"),
("50","PD00118100900003","001","2018-10-09","1.10.030.03","Hasil produksi [PR00118100900001]","0.00","10000.00","2018-10-09 09:35:47","iniad"),
("49","PD00118100900003","001","2018-10-09","1.10.030.04","Hasil produksi [PR00118100900001]","10000.00","0.00","2018-10-09 09:35:47","iniad"),
("48","PB00118100900001","001","2018-10-09","1.10.010.01","Hutang Pembelian Kerupuk Renyah","0.00","1000000.00","2018-10-09 09:28:25","iniad"),
("47","PB00118100900001","001","2018-10-09","1.10.030.01","Persd. Pembelian Bahan Bakuy","1000000.00","0.00","2018-10-09 09:28:25","iniad"),
("58","PB00118101000003","001","2018-10-10","1.10.010.01","Hutang Pembelian Kerupuk Renyah","0.00","67000.00","2018-10-10 18:24:41","iniad"),
("57","PB00118101000003","001","2018-10-10","1.10.030.01","Persd. Pembelian Bahan Bakuy","67000.00","0.00","2018-10-10 18:24:41","iniad"),
("46","PB00118101000002","001","2018-10-11","1.10.010.01","Hutang Pembelian Kerupuk Renyah","0.00","1300000.00","2018-10-10 17:29:45","iniad"),
("45","PB00118101000002","001","2018-10-11","1.10.010.01","Persd. Pembelian Bahan Bakuy","1300000.00","0.00","2018-10-10 17:29:45","iniad"),
("56","PB00118101000001","001","2018-10-10","1.10.010.01","Hutang Pembelian Kerupuk Renyah","0.00","600000.00","2018-10-10 15:46:21","iniad"),
("55","PB00118101000001","001","2018-10-10","1.10.030.01","Persd. Pembelian Bahan Bakuy","600000.00","0.00","2018-10-10 15:46:21","iniad"),
("59","PR00118101600006","001","2018-10-16","","Perintah Produksi BDP BTKL","55600.00","0.00","2018-10-16 21:40:09","iniad"),
("60","PR00118101600006","001","2018-10-16","","Perintah Produksi BDP BTKL","0.00","55600.00","2018-10-16 21:40:09","iniad"),
("61","PR00118101600006","001","2018-10-16","","Perintah Produksi BDP BOP","55000.00","0.00","2018-10-16 21:40:09","iniad"),
("62","PR00118101600006","001","2018-10-16","","Perintah Produksi BDP BOP","0.00","55000.00","2018-10-16 21:40:09","iniad"),
("63","PB00118101600001","001","2018-10-16","1.10.030.04","Persd. Pembelian Barang Jadi","500000.00","0.00","2018-10-16 22:02:53","iniad"),
("64","PB00118101600001","001","2018-10-16","1.10.010.01","Hutang Pembelian [H] CV FENINDO EKA J","0.00","500000.00","2018-10-16 22:02:53","iniad"),
("65","PR00118101600007","001","2018-10-16","1.10","Perintah Produksi BDP BTKL","2780.00","0.00","2018-10-16 22:05:17","iniad"),
("66","PR00118101600007","001","2018-10-16","1.10.010.01","Perintah Produksi BDP BTKL","0.00","2780.00","2018-10-16 22:05:17","iniad"),
("67","PR00118101600007","001","2018-10-16","1.10.010","Perintah Produksi BDP BOP","2750.00","0.00","2018-10-16 22:05:17","iniad"),
("68","PR00118101600007","001","2018-10-16","1.10.010.01","Perintah Produksi BDP BOP","0.00","2750.00","2018-10-16 22:05:17","iniad"),
("69","BB00118101600001","001","2018-10-16","1.10.010","Pengambilan unutk proses produksi [PR00118101600007]","5000.00","0.00","2018-10-16 22:07:54","iniad"),
("70","BB00118101600001","001","2018-10-16","1.10.030.04","Pengambilan unutk proses produksi [PR00118101600007]","0.00","5000.00","2018-10-16 22:07:54","iniad"),
("71","PR00118101600008","001","2018-10-16","1.10","Perintah Produksi BDP BTKL","2500.00","0.00","2018-10-16 22:33:16","iniad"),
("72","PR00118101600008","001","2018-10-16","1.10.010.01","Perintah Produksi BDP BTKL","0.00","2500.00","2018-10-16 22:33:16","iniad"),
("73","PR00118101600008","001","2018-10-16","1.10.010","Perintah Produksi BDP BOP","2500.00","0.00","2018-10-16 22:33:16","iniad"),
("74","PR00118101600008","001","2018-10-16","1.10.010.01","Perintah Produksi BDP BOP","0.00","2500.00","2018-10-16 22:33:16","iniad");



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
  `hp` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `stock` (`stock`),
  KEY `fktstock` (`faktur`,`stock`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `pembelian_detail` VALUES("2","PB00118100900001","1808000002","1000.00","1000.00","0.00","1000000.00","0.00","1000000.00","0000-00-00 00:00:00","0000-00-00 00:00:00","iniad","0.00"),
("3","PB00118101000001","1808000002","6000.00","100.00","0.00","600000.00","0.00","600000.00","0000-00-00 00:00:00","0000-00-00 00:00:00","iniad","0.00"),
("4","PB00118101000002","1808000002","6500.00","200.00","0.00","1300000.00","0.00","1300000.00","0000-00-00 00:00:00","0000-00-00 00:00:00","iniad","0.00"),
("5","PB00118101000003","1808000002","6700.00","10.00","0.00","67000.00","0.00","67000.00","0000-00-00 00:00:00","0000-00-00 00:00:00","iniad","0.00"),
("6","PB00118101600001","1810000007","500.00","1000.00","0.00","500000.00","0.00","500000.00","0000-00-00 00:00:00","0000-00-00 00:00:00","iniad","0.00");



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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `pembelian_total` VALUES("1","PB00118100900001","2018-10-09","","001","01","K0002","1000000.00","0.00","0.00","0.00","1000000.00","1000000.00","0.00","1","2018-10-09 09:28:25","2018-10-09 09:28:25","iniad"),
("2","PB00118101000001","2018-10-10","","001","01","K0002","600000.00","0.00","0.00","0.00","600000.00","600000.00","0.00","1","2018-10-10 15:46:21","2018-10-10 15:46:21","iniad"),
("3","PB00118101000002","2018-10-11","","001","01","K0002","1300000.00","0.00","0.00","0.00","1300000.00","1300000.00","0.00","1","2018-10-10 17:29:45","2018-10-10 17:29:45","iniad"),
("4","PB00118101000003","2018-10-10","","001","01","K0002","67000.00","0.00","0.00","0.00","67000.00","67000.00","0.00","1","2018-10-10 18:24:41","2018-10-10 18:24:41","iniad"),
("5","PB00118101600001","2018-10-16","","001","01","0041","500000.00","0.00","0.00","0.00","500000.00","500000.00","0.00","1","2018-10-16 22:02:53","2018-10-16 22:02:53","iniad"),
("6","PB00118102100001","2018-10-21","","001","01","0041","0.00","0.00","0.00","0.00","0.00","0.00","0.00","1","2018-10-21 11:51:56","2018-10-21 11:51:56","iniad");



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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `piutang_kartu` VALUES("1","CS00118100900001","CS00118100900001","2018-10-09","001","A001","Piutang Penjualan [CS00118100900001] an Ashuika","800000.00","0.00","iniad","2018-10-09 18:18:50"),
("2","CS00118100900002","CS00118100900002","2018-10-09","001","A001","Piutang Penjualan [CS00118100900002] an Ashuika","800000.00","0.00","iniad","2018-10-09 18:19:56"),
("3","CS00118100900003","CS00118100900003","2018-10-09","001","A001","Piutang Penjualan [CS00118100900003] an Ashuika","800000.00","0.00","iniad","2018-10-09 18:20:38"),
("4","RJ00118100900001","RJ00118100900001","2018-10-09","001","A001","Retur Penjualan [RJ00118100900001] an Ashuika","0.00","800000.00","iniad","2018-10-09 18:27:45");



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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `pr_detail`;

CREATE TABLE `pr_detail` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `stock` varchar(15) DEFAULT NULL,
  `qty` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `stock` (`stock`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `produksi_bb` VALUES("1","BB00118100900001","PR00118100900001","2018-10-09","001","01","1808000002","10.00","1","iniad","2018-10-09 09:33:00","0.00"),
("2","BB00118101200001","PR00118100900001","2018-10-12","001","null","1808000002","1.00","1","iniad","2018-10-12 13:47:51","0.00"),
("3","BB00118101600001","PR00118101600007","2018-10-16","001","01","1810000007","10.00","1","iniad","2018-10-16 22:07:54","500.00");



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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `produksi_bb_standart` VALUES("1","PR00118101600006","1810000007","100.00","97.00","9700.00"),
("2","PR00118101600006","1810000001","600.00","200.00","120000.00"),
("3","PR00118101600006","1810000010","100.00","550.00","55000.00"),
("4","PR00118101600007","1810000007","10.00","60.00","600.00"),
("5","PR00118101600008","1810000007","100.00","50.00","5000.00");



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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `produksi_hasil` VALUES("3","PD00118100900003","PR00118100900001","2018-10-09","001","01","1808000003","10.00","1000.00","1","iniad","2018-10-09 09:35:47");



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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `produksi_produk` VALUES("1","PR00118100900001","1808000003","10.00","0.00","0.00","0.00","1000.00","10000.00"),
("2","PR00118101100001","1808000001","10.00","5000.00","700.00","600.00","6300.00","63000.00"),
("3","PR00118101600001","1810000002","500.00","2500000.00","500.00","500.00","2501000.00","1250500000.00"),
("4","PR00118101600002","1810000002","500.00","2500000.00","500.00","500.00","2501000.00","1250500000.00"),
("5","PR00118101600003","1810000002","500.00","2500000.00","500.00","500.00","2501000.00","1250500000.00"),
("6","PR00118101600004","1810000002","500.00","2500000.00","500.00","500.00","2501000.00","1250500000.00"),
("7","PR00118101600005","1810000002","500.00","2500000.00","500.00","500.00","2501000.00","1250500000.00"),
("8","PR00118101600006","1810000002","100.00","184700.00","556.00","550.00","185806.00","18580600.00"),
("9","PR00118101600007","1810000002","5.00","600.00","556.00","550.00","1706.00","8530.00"),
("10","PR00118101600008","1810000002","25.00","5000.00","100.00","100.00","5200.00","130000.00");



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
  `tglclose` date DEFAULT '0000-00-00',
  PRIMARY KEY (`id`),
  KEY `fkt` (`faktur`),
  KEY `tglcab` (`tgl`,`cabang`),
  KEY `tgl` (`tgl`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `produksi_total` VALUES("1","PR00118100900001","001","2018-10-09","1","iniad","2018-10-09 09:32:37","0.00","0.00","0.00","10000.00","0000-00-00"),
("2","PR00118101100001","001","2018-10-11","1","iniad","2018-10-11 20:20:43","0.00","0.00","0.00","63000.00","0000-00-00"),
("3","PR00118101600006","001","2018-10-16","2","iniad","2018-10-16 21:40:09","18470000.00","55600.00","55000.00","18580600.00","0000-00-00"),
("4","PR00118101600007","001","2018-10-16","1","iniad","2018-10-16 22:05:17","3000.00","2780.00","2750.00","8530.00","0000-00-00"),
("5","PR00118101600008","001","2018-10-16","1","iniad","2018-10-16 22:33:16","125000.00","2500.00","2500.00","130000.00","0000-00-00");



DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `kode` varchar(16) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `datetime_insert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datetime_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `satuan` VALUES("5","ML","Mili Liter","0000-00-00 00:00:00","2018-10-14 13:51:35",""),
("6","PCS","Pieces","0000-00-00 00:00:00","2018-10-14 13:52:01",""),
("7","GLN","Galon","0000-00-00 00:00:00","2018-10-14 15:11:49",""),
("8","M","Meter","0000-00-00 00:00:00","2018-10-14 15:12:14","");



DROP TABLE IF EXISTS `sj_detail`;

CREATE TABLE `sj_detail` (
  `id` double NOT NULL AUTO_INCREMENT,
  `faktur` char(20) DEFAULT NULL,
  `stock` varchar(15) DEFAULT NULL,
  `qty` double(16,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `faktur` (`faktur`),
  KEY `stock` (`stock`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




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
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

INSERT INTO `stock` VALUES("6","1810000001","","Air Mineral","001","001","B","0.00","0000-00-00 00:00:00","2018-10-13 16:44:20","iniad"),
("7","1810000002","","BUYA Karton 120 ml","PCS","004","P","0.00","0000-00-00 00:00:00","2018-10-14 15:45:07","iniad"),
("12","1810000007","","BUYA Karton 220 ml","PCS","004","B","0.00","0000-00-00 00:00:00","2018-10-14 15:52:28","Otin"),
("13","1810000008","","BUYA Karton 600 ml","PCS","004","B","0.00","0000-00-00 00:00:00","2018-10-14 15:54:12","Otin"),
("14","1810000009","","BUYA Galon 19 liter","GLN","004","B","0.00","0000-00-00 00:00:00","2018-10-14 15:54:55","Otin"),
("15","1810000010","","Kh-Q Karton 120 ml","PCS","004","B","0.00","0000-00-00 00:00:00","2018-10-14 15:55:15","Otin"),
("16","1810000011","","Kh-Q Karton 220 ml","PCS","004","B","0.00","0000-00-00 00:00:00","2018-10-14 15:55:26","Otin"),
("17","1810000012","","Kh-Q Karton 330 ml","PCS","004","B","0.00","0000-00-00 00:00:00","2018-10-14 15:55:44","Otin"),
("18","1810000013","","Kh-Q Karton 600 ml","PCS","004","B","0.00","0000-00-00 00:00:00","2018-10-14 15:55:54","Otin"),
("19","1810000014","","Kh-Q Karton 1.500 ml","PCS","004","B","0.00","0000-00-00 00:00:00","2018-10-14 15:56:09","Otin"),
("20","1810000015","","Kh-Q Galon 19 liter","GLN","004","B","0.00","0000-00-00 00:00:00","2018-10-14 15:56:35","Otin"),
("21","1810000016","","CUP 220ML (2,5gr)","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 15:58:01","Fany"),
("22","1810000017","","CUP 220ML (2,7gr)","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 15:58:25","Fany"),
("26","1810000021","","CUP 120ML","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:00:23","Fany"),
("27","1810000022","","BOTOL 330ML","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:01:39","Fany"),
("28","1810000023","","BOTOL 600ML","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:02:01","Fany"),
("29","1810000024","","BOTOL 1500ML","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:02:18","Fany"),
("30","1810000025","","GALON BUYA 19L","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:03:55","Fany"),
("31","1810000026","","GALON KH-Q 20L","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:04:42","Fany"),
("32","1810000027","","LID CUP BUYA 4 Line >>120ml","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:05:22","Fany"),
("33","1810000028","","Lid Cup KH-Q 4 Line >>120ml","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:06:11","Fany"),
("34","1810000029","","Lid Cup BUYA 4 Line >> 220ml ","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:06:47","Fany"),
("35","1810000030","","Lid Cup KH-Q 4 Line >> 220ml","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:07:34","Fany"),
("39","1810000034","","LABEL BOTOL >> KH-Q 330ML ","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:10:30","Otin"),
("40","1810000035","","LABEL BOTOL >> KH-Q 600ML ","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:10:50","Otin"),
("41","1810000036","","LABEL BOTOL >> KH-Q 1500ML ","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:11:10","Otin"),
("42","1810000037","","LABEL GALON >> BUYA 19 liter","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:11:42","Otin"),
("43","1810000038","","LABEL GALON >> KH-Q 19 liter","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:12:05","Otin"),
("44","1810000039","","TUTUP BOTOL >> KH-Q","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:12:35","Otin"),
("45","1810000040","","TUTUP GALON >> BUYA ","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:12:52","Otin"),
("46","1810000041","","TUTUP GALON >> KH-Q","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:13:12","Otin"),
("47","1810000042","","SEGEL BOTOL >> KH-Q","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:14:05","Otin"),
("48","1810000043","","SEGEL GALON >> KH-Q","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:14:23","Otin"),
("50","1810000045","","STRAW RENTENG ","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:14:59","Otin"),
("53","1810000048","","STRAW PACK","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:16:03","Otin"),
("54","1810000049","","TISUE GALON >> KH-Q ","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:16:34","Otin"),
("55","1810000050","","KARTON >> BUYA 120ml","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:17:00","Fany"),
("56","1810000051","","KARTON >>  BUYA 220ml","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:17:17","Fany"),
("57","1810000052","","KARTON >> KH-Q 120ml","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:17:39","Fany"),
("58","1810000053","","KARTON >> KH-Q 220ml","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:17:59","Fany"),
("59","1810000054","","KARTON >> KH-Q 330ml","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:18:23","Fany"),
("60","1810000055","","KARTON >> KH-Q 600ml ","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:18:45","Fany"),
("61","1810000056","","KARTON >> KH-Q 1500ml","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:19:13","Fany"),
("67","1810000062","","LAYER","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:22:32","Fany"),
("68","1810000063","","LAKBAN","M","002","B","0.00","0000-00-00 00:00:00","2018-10-14 16:22:45","Fany"),
("69","1810000064","","BUYA Galon 19 liter BARU","GLN","004","B","0.00","0000-00-00 00:00:00","2018-10-15 13:48:20","Otin"),
("70","1810000065","","Kh-Q Galon 19 liter BARU","GLN","004","B","0.00","0000-00-00 00:00:00","2018-10-15 13:48:33","Otin"),
("71","1810000066","","TISUE GALON >> BUYA","PCS","002","B","0.00","0000-00-00 00:00:00","2018-10-15 14:10:14","Otin");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `stock_group` VALUES("1","001","Bahan Baku","1.10.030.01","3.90.011","3.90.010","0000-00-00 00:00:00","2018-08-10 21:39:38","iniad"),
("2","004","Barang Jadi","1.10.030.04","1.10.020.01","","0000-00-00 00:00:00","2018-10-09 09:45:16","iniad"),
("3","002","Bahan Penolong","1.10.030.02","","","0000-00-00 00:00:00","2018-10-14 14:59:19","iniad");



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
) ENGINE=MyISAM AUTO_INCREMENT=310 DEFAULT CHARSET=latin1;

INSERT INTO `stock_hp` VALUES("294","PB00118101000003","2018-10-10","1808000002","001","10.00","6700.00","2018-10-10 22:11:47"),
("290","PD00118100900003","2018-10-09","1808000003","001","10.00","1000.00","2018-10-10 22:11:43"),
("291","RJ00118100900001","2018-10-09","1808000003","001","1.00","800000.00","2018-10-10 22:11:43"),
("289","PB00118100900001","2018-10-09","1808000002","001","990.00","1000.00","2018-10-10 22:11:43"),
("306","PB00118101000002","2018-10-11","1808000002","001","200.00","6500.00","2018-10-10 18:32:42"),
("305","PB00118101000003","2018-10-11","1808000002","001","10.00","6700.00","2018-10-10 22:11:47"),
("293","PB00118101000001","2018-10-10","1808000002","001","100.00","6000.00","2018-10-10 22:11:47"),
("292","PB00118100900001","2018-10-10","1808000002","001","990.00","1000.00","2018-10-10 22:11:43"),
("304","PB00118101000001","2018-10-11","1808000002","001","100.00","6000.00","2018-10-10 22:11:47"),
("303","PB00118100900001","2018-10-11","1808000002","001","990.00","1000.00","2018-10-10 22:11:43"),
("309","PB00118101600001","2018-10-16","1810000007","001","990.00","500.00","2018-10-16 22:02:53");



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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

INSERT INTO `stock_kartu` VALUES("37","RJ00118100900001","1808000003","2018-10-09","001","01","retur penjualan stock Ashuika","1.00","0.00","800000.00","2018-10-10 22:11:43","2018-10-10 22:11:43","iniad"),
("36","CS00118100900003","1808000001","2018-10-09","001","01","Penjualan kasir fkt[CS00118100900003]","0.00","1.00","0.00","2018-10-10 22:11:43","2018-10-10 22:11:43","iniad"),
("35","PD00118100900003","1808000003","2018-10-09","001","01","Hasil produksi [PR00118100900001]","10.00","0.00","1000.00","2018-10-10 22:11:43","2018-10-10 22:11:43","iniad"),
("34","BB00118100900001","1808000002","2018-10-09","001","01","Pengambilan unutk proses produksi [PR00118100900001]","0.00","10.00","0.00","2018-10-10 22:11:43","2018-10-10 22:11:43","iniad"),
("33","PB00118100900001","1808000002","2018-10-09","001","01","pembelian stock fkt[PB00118100900001]","1000.00","0.00","1000.00","2018-10-10 22:11:43","2018-10-10 22:11:43","iniad"),
("39","PB00118101000003","1808000002","2018-10-10","001","01","pembelian stock fkt[PB00118101000003]","10.00","0.00","6700.00","2018-10-10 22:11:47","2018-10-10 22:11:47","iniad"),
("32","PB00118101000002","1808000002","2018-10-11","001","01","pembelian stock fkt[PB00118101000002]","200.00","0.00","6500.00","2018-10-10 18:32:42","2018-10-10 18:32:42","iniad"),
("38","PB00118101000001","1808000002","2018-10-10","001","01","pembelian stock fkt[PB00118101000001]","100.00","0.00","6000.00","2018-10-10 22:11:47","2018-10-10 22:11:47","iniad"),
("40","BB00118101200001","1808000002","2018-10-12","001","null","Pengambilan unutk proses produksi [PR00118100900001]","0.00","1.00","0.00","2018-10-12 13:47:52","2018-10-12 13:47:52","iniad"),
("41","PB00118101600001","1810000007","2018-10-16","001","01","pembelian stock fkt[PB00118101600001]","1000.00","0.00","500.00","2018-10-16 22:02:53","2018-10-16 22:02:53","iniad"),
("42","BB00118101600001","1810000007","2018-10-16","001","01","Pengambilan unutk proses produksi [PR00118101600007]","0.00","10.00","500.00","2018-10-16 22:07:54","2018-10-16 22:07:54","iniad");



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
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

INSERT INTO `supplier` VALUES("6","0001","[H] PT. PURINUSA EKA","-","-","-"),
("10","0003","[H] PT. SARI MULTI U","-","-","-"),
("11","0028","[H] CV.BUYA PERCETAK","-","-","KUDUS"),
("13","0029","[H] CV. INDAH JAYA P","-","-","-"),
("14","0005","[H] PT. NAMASINDO PL","-","-","-"),
("15","0030","[H] PT.SRIWAHANA ADI","-","-","BOYOLALI"),
("21","0033","[H] CIPTA MANDIRI AI","-","-","-"),
("22","0009","[H] CV. WIRAUSAHA SU","-","-","-"),
("27","0036","[H] PT KIEWELL PLAST","-","-","SUKOHARJO"),
("29","0037","[H] CV.WIRASTRI E","-","-","SIDOARJO"),
("30","0013","[H] CV. MUBAROKATAN ","-","-","-"),
("31","0038","[H] CV SERAYU MAS","-","-","SEMARANG"),
("35","0040","[H] PT. GUNUNG GILEA","-","-","-"),
("37","0041","[H] CV FENINDO EKA J","-","-","SEMARANG"),
("38","0017","[H] CV.COOL CLEAN","-","-","-"),
("40","0042","[H] PT. SURYA SUKSES","-","-","-"),
("42","0043","[H] PT DASA PLAST NU","-","-","SURABAYA"),
("44","0044","[H] TUNGGUL / TIRTA ","-","-","-"),
("46","0045","[H] PT. CIPLASINDO M","-","-","CIREBON"),
("49","0023","[H] PT. GLORI ANUGRA","-","-","-"),
("50","0047","[H] PT PUTRA NAGA IN","-","-","-"),
("52","0024","[H]PT. ADIGUNA LABEL","-","-","-"),
("53","0049","[H]PT. EURO PACK","-","-","-"),
("54","0025","[H] CV. KURNIA PLAST","-","-","KUDUS");



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
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

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
("13","app_title","TRIAL BUYA MANUFAKTUR - MDT","","",""),
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
("81","inc_stockkode1810","66","","",""),
("82","inc_aktivakode1810","156","","",""),
("83","inc_PR001181016","8","","",""),
("84","rekprbdpbbb","1.10.030.03","","",""),
("85","rekprbdpbtkl","1.10.030.03","","",""),
("86","rekprbdpbop","1.10.030.03","","",""),
("87","rekprbtkldibebankan","5.18.013","","",""),
("88","rekprbopdibebankan","5.19.025","","",""),
("89","inc_PB001181016","1","","",""),
("90","inc_BB001181016","1","","",""),
("91","inc_DO001181017","1","","",""),
("92","rekhppbjawal","1.10.030.04","","",""),
("93","rekhppbjakhir","1.10.030.04","","",""),
("94","rekselisih","","","",""),
("95","rekpbhutdisc","","","",""),
("96","rekpbhutpembulatan","","","",""),
("97","rekpjpiutangdisc","","","",""),
("98","rekpjpiutangpembulatan","","","",""),
("99","rekhppbbbawal","1.10.030.01","","",""),
("100","rekhppbbbakhir","1.10.030.01","","",""),
("101","rekhppbbpawal","1.10.030.02","","",""),
("102","rekhppbbpakhir","1.10.030.02","","",""),
("103","rekhppbtklawal","1.10.030.03","","",""),
("104","rekhppbtklakhir","1.10.030.03","","",""),
("105","rekhppbopawal","1.10.030.03","","",""),
("106","rekhppbopakhir","1.10.030.03","","",""),
("107","rekhppbdpawal","1.10.030.03","","",""),
("108","rekhppbdpakhir","1.10.030.03","","",""),
("109","inc_PB001181021","1","","","");



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

INSERT INTO `sys_username` VALUES("Fany","2d691e505dc2f9de43a198a4f1d6770c2424a8ec0004","Fany","0000-00-00 00:00:00","{\"ava\":\".\\/uploads\\/users\\/Fany.png\"}","","001","1.10.010.01"),
("iniad","d154c23962918b23239809a675ef3b8ad860bff50001","Administrator","2017-03-14 00:00:00","{\"ava\":\".\\/uploads\\/users\\/iniad.png\"}","2017-03-14 00:00:00","001","1.10.010.01"),
("Otin","ca73811a0f06db41258c68a040cc92598fbf346d0004","Otin","0000-00-00 00:00:00","{\"ava\":\".\\/uploads\\/users\\/Otin.png\"}","","001","1.10.010.01");



DROP TABLE IF EXISTS `sys_username_level`;

CREATE TABLE `sys_username_level` (
  `code` char(4) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL,
  `value` longtext NOT NULL,
  `dashboard` varchar(100) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sys_username_level` VALUES("0001","Admin","a88ad3a75f88bbe93b64a7c55ade7a5d,3280e54b9f55e4eabd6980d2dd2cd30a,77861cb7adb9cca48ff27ebbda5a9cc6,76d056d61b13d81eb1f17fe08bc47070,0fc941b72ee0405eddd7bf56aef25bcc,8fecbbdbad0bbb6b8e99d458b8627e24,20a0f2c64923f9a0e40926c8bc53b4bd,c50e309e5743d3ab9fbd06acb6109506,6f06d3adaa23e69fcaf6f346014073ce,749161f0021599851bd0e9a22cff7baf,361121339fe10efba4f21ab3a1cdf35e,17758b061935a007d7618bd1c27eb2e5,be6f3584b94ada7959cc0560565cbcf1,e7d707a26e7f7b6ff52c489c60e429b1,50243ec941690b233c71f156c698fc2a,dfa4d20f71010039c17396e4596fe496,1397c0adcf1a14baae8882ff12003824,87435b69a401a154853763d91c62af01,a7bd4586799ca05e992e9b998cdc4691,d5f2fbdb1e1d53ff71e07abaaaf24838,b61a6c6eacae94d4b732117142a28747,4a10ffb4fb27db3f356cd40b595f7e3b,01e811df47086a4855c4afca7ce45b1d,76e4273f6431751688c10b3593690e70,07fbbc9c620137178057da67987f9d2c,6790febd5ea3042ffbdf8b20eb862fa3,80633302f7014a61e917fc5da0bc7760,2dc6932fda56e9500878e4b52e4f9b2a,aab32ceb3dc8c9626864af8b5b7dc697,dcaaf5237b6c18f979b4383fb42d3be3,7140ba9098537397a880c1bef9e2adde,f54832b14054450823c186a6692c4b09,831cbfb7f0f19e694f976b33878da527,3ee756c8f1fcbcd94001ffc04ce93811,b46632c62363d75ee2f5343cab8864e8,449f1185c1c26cd5f2eaa071e154c4eb,e3c74077970c6a3effc8ae63f1ac59d7,b2d7f32c4fa793aca2b3ae9157cfa54a,3f9a0c5eb721cd22074f77c8e995cd65,a38bc4b1aa3c88b96de75d22ab6b69cc,985454ea1be7a22218259691886a1209,9f14591a76f0506ae5961899d94110ec,7028340d6fafa9df3426fbc2440715e2,f9106e99699f94f040cfe5447d6d8428,1a67ed69c1aa7a1216b7c3eacc13c563,c1cda1aff68bfc72cbbcba259d548774,ec0590f87e6519db84f5a88b38a739ff,e3bebb63443b66f4e8ee071203aea106,c5fc39cfa1c828831a10d1be37c3969f,7d42948bdc43bbdbc44658b177a3f681,ca0b0321e833ebd7419934fa74bfb2df,1d42860acfc2709b1d1bbebc0481d63d,e09968c06989388fa7d68f8a085cc051,496f9b5718d2dd4c7c387c5709c7acd0,af8ba16472d2f2ae8498063ebc9549db,5740fa26067e36fb6a3b53cc293581db,f9ac4bae63d55b4f98269e04a4bf0a02,fc5397c126724661a4ab1bbe81c8c922,5850c6024f87e46d9df25be3b9850169,011134986548f3458aa3e7e2a7fceb8d,1f7ebaed3cf55060c933283fd79ec0fd,30abca520c2b83a6d38c0481e4f964fd,935bc28ec6db10284bb3c9ab0c547720",""),
("0002","Staff 1 (Accountant)","",""),
("0003","Staff 2 (Transc)","",""),
("0004","Trial","a88ad3a75f88bbe93b64a7c55ade7a5d,3280e54b9f55e4eabd6980d2dd2cd30a,77861cb7adb9cca48ff27ebbda5a9cc6,76d056d61b13d81eb1f17fe08bc47070,0fc941b72ee0405eddd7bf56aef25bcc,8fecbbdbad0bbb6b8e99d458b8627e24,20a0f2c64923f9a0e40926c8bc53b4bd,c50e309e5743d3ab9fbd06acb6109506,6f06d3adaa23e69fcaf6f346014073ce,749161f0021599851bd0e9a22cff7baf,361121339fe10efba4f21ab3a1cdf35e,17758b061935a007d7618bd1c27eb2e5,be6f3584b94ada7959cc0560565cbcf1,e7d707a26e7f7b6ff52c489c60e429b1,dfa4d20f71010039c17396e4596fe496,1397c0adcf1a14baae8882ff12003824,87435b69a401a154853763d91c62af01,a7bd4586799ca05e992e9b998cdc4691,d5f2fbdb1e1d53ff71e07abaaaf24838,b61a6c6eacae94d4b732117142a28747,4a10ffb4fb27db3f356cd40b595f7e3b,01e811df47086a4855c4afca7ce45b1d,76e4273f6431751688c10b3593690e70,07fbbc9c620137178057da67987f9d2c,ff1886c2533135dc44dd4b87c566b7bd,6790febd5ea3042ffbdf8b20eb862fa3,80633302f7014a61e917fc5da0bc7760,2dc6932fda56e9500878e4b52e4f9b2a,aab32ceb3dc8c9626864af8b5b7dc697,dcaaf5237b6c18f979b4383fb42d3be3,f54832b14054450823c186a6692c4b09,831cbfb7f0f19e694f976b33878da527,3ee756c8f1fcbcd94001ffc04ce93811,449f1185c1c26cd5f2eaa071e154c4eb,b46632c62363d75ee2f5343cab8864e8,e3c74077970c6a3effc8ae63f1ac59d7,b2d7f32c4fa793aca2b3ae9157cfa54a,a38bc4b1aa3c88b96de75d22ab6b69cc,985454ea1be7a22218259691886a1209,9f14591a76f0506ae5961899d94110ec,78a9b47f81a6fff8e96b9c0de3cb5c39,7028340d6fafa9df3426fbc2440715e2,c1cda1aff68bfc72cbbcba259d548774,ec0590f87e6519db84f5a88b38a739ff,e3bebb63443b66f4e8ee071203aea106,c5fc39cfa1c828831a10d1be37c3969f,7d42948bdc43bbdbc44658b177a3f681,ca0b0321e833ebd7419934fa74bfb2df,e09968c06989388fa7d68f8a085cc051,5740fa26067e36fb6a3b53cc293581db,f9ac4bae63d55b4f98269e04a4bf0a02,fc5397c126724661a4ab1bbe81c8c922","");



