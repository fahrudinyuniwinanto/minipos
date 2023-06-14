/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.7.33 : Database - minipos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`minipos` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `minipos`;

/*Table structure for table `jual_d` */

DROP TABLE IF EXISTS `jual_d`;

CREATE TABLE `jual_d` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `jual_d` */

insert  into `jual_d`(`id`,`id_penjualan`,`id_barang`,`harga`,`qty`,`total`,`created_at`,`created_by`) values 
(1,3,1,92000,2,NULL,NULL,NULL),
(2,3,2,68000,3,NULL,NULL,NULL),
(3,4,2,92000,1,92000,NULL,NULL),
(4,4,1,68000,1,68000,NULL,NULL);

/*Table structure for table `jual_h` */

DROP TABLE IF EXISTS `jual_h`;

CREATE TABLE `jual_h` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `cara_bayar` varchar(20) DEFAULT NULL COMMENT 'KAS, DEBIT,TRANSFER',
  `total` double DEFAULT NULL,
  `jumlah_bayar` double DEFAULT NULL,
  `jumlah_kembali` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `jual_h` */

insert  into `jual_h`(`id`,`customer`,`tanggal`,`cara_bayar`,`total`,`jumlah_bayar`,`jumlah_kembali`,`created_at`,`created_by`) values 
(1,'ASEPTIAN','2023-06-13','TUNAI',412000,500000,88000,'2023-06-13 22:13:22','ruri'),
(2,'RIO','2023-06-13','TUNAI',504000,600000,96000,'2023-06-13 22:15:11','ruri'),
(4,'BAEDOWY','2023-06-14','TUNAI',160000,200000,40000,'2023-06-14 07:45:21','ruri');

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kat` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) DEFAULT NULL,
  `note` text,
  `for_modul` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_kat`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `kategori` */

insert  into `kategori`(`id_kat`,`cat_name`,`note`,`for_modul`) values 
(1,'PAKAIAN',NULL,'KATEGORI'),
(2,'MAKANAN','','KATEGORI'),
(3,'PERABOT',NULL,'KATEGORI'),
(4,'GADGET',NULL,'KATEGORI');

/*Table structure for table `m_barang` */

DROP TABLE IF EXISTS `m_barang`;

CREATE TABLE `m_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(20) DEFAULT NULL COMMENT 'join ke tabel kategori',
  `nama` varchar(255) DEFAULT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `satuan` varchar(10) DEFAULT NULL COMMENT 'join ke tabel kategori',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `m_barang` */

insert  into `m_barang`(`id`,`kategori`,`nama`,`id_vendor`,`harga_jual`,`harga_beli`,`satuan`,`created_at`,`created_by`) values 
(1,'MAKANAN','NYUMIE - MIE INSTANT',1,68000,50000,'DUS','2023-06-13 20:35:58','ruri'),
(2,'PAKAIAN','SAJADAH APPLE',1,92000,78000,'PCS','2023-06-13 21:46:12','ruri');

/*Table structure for table `m_vendor` */

DROP TABLE IF EXISTS `m_vendor`;

CREATE TABLE `m_vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `m_vendor` */

insert  into `m_vendor`(`id`,`nama`,`alamat`,`telp`,`created_at`,`created_by`) values 
(1,'GADGETTOP','SEMARANG','089636555444','2022-05-11 08:11:13','dev'),
(2,'INDOMARCO','JL.LOWANU 20 93 SOLO','089636555445','2022-05-16 17:42:43','dev'),
(3,'MEBEL INDO','JL JANGLI NO 36 SEMARANG','089636555442','2022-05-16 17:42:43','dev'),
(4,'SUPER DUPER','JL.SOROWAJAN BARU NO.277 BANTUL','089636555442','2022-05-16 17:42:43','dev');

/*Table structure for table `master_access` */

DROP TABLE IF EXISTS `master_access`;

CREATE TABLE `master_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nm_access` varchar(255) DEFAULT NULL,
  `note` text,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `master_access` */

insert  into `master_access`(`id`,`nm_access`,`note`,`created_at`,`created_by`) values 
(1,'M_USERS','MENU USER',NULL,0),
(4,'M_LAPORAN','MENU LAPORAN',NULL,NULL),
(5,'M_SY_CONFIG','MENU SISTEM',NULL,0),
(103,'M_BERANDA','',NULL,1),
(104,'M_MASTER','',NULL,1),
(113,'M_JUAL','','2022-05-10 14:59:59',1),
(130,'M_BARANG','','2023-02-03 22:58:33',9),
(132,'M_SUPLIER','','2023-02-03 22:58:54',9);

/*Table structure for table `sy_config` */

DROP TABLE IF EXISTS `sy_config`;

CREATE TABLE `sy_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_name` varchar(50) DEFAULT NULL,
  `conf_val` text,
  `note` text,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `sy_config` */

insert  into `sy_config`(`id`,`conf_name`,`conf_val`,`note`) values 
(3,'APP_NAME','AKASIA MINIPOS',''),
(8,'OPD_NAME','PT. AKAL KARYA INDONESIA\r\n',''),
(9,'LEFT_FOOTER','<strong>Copyright</strong> <a href=\"akasia.id\" target=\"_blank\">akasia.id</a>  © 2023',''),
(10,'RIGHT_FOOTER','Akasia',''),
(11,'APP_DESC','Akasia','-'),
(12,'OPD_ADDR','Satrio Tower Lt.6 Unit 1,\r\nJl. Prof.Dr Satrio Kav.C4,\r\nKuningan – Setiabudi,\r\nJakarta Selatan',''),
(13,'VISI_MISI','Want to build start up?',''),
(14,'APP_TELP','089636555456',''),
(15,'APP_EMAIL','akasia@mail.com',''),
(16,'APP_FB','https://www.facebook.com',''),
(17,'APP_TWITTER','https://twitter.com',''),
(18,'APP_IG','https://instagram.com',''),
(19,'META_KEYWORDS','akasia, startup, application, php, codeigniter','-'),
(20,'META_AUTHOR','peternak kode','-'),
(21,'META_DESC','Aplikasi Penjualan Toko Akasia','-');

/*Table structure for table `user_access` */

DROP TABLE IF EXISTS `user_access`;

CREATE TABLE `user_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) DEFAULT NULL,
  `kd_access` varchar(12) DEFAULT NULL,
  `nm_access` varbinary(100) DEFAULT NULL,
  `is_allow` int(1) DEFAULT NULL COMMENT '0=false,1=true',
  `note` text,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=400 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `user_access` */

insert  into `user_access`(`id`,`id_group`,`kd_access`,`nm_access`,`is_allow`,`note`) values 
(5,2,'1',NULL,1,NULL),
(8,1,'1',NULL,1,NULL),
(15,1,'4',NULL,1,NULL),
(16,1,'5',NULL,1,NULL),
(19,2,'5',NULL,1,NULL),
(79,2,'4',NULL,1,NULL),
(181,1,'104',NULL,0,NULL),
(182,1,'103',NULL,1,NULL),
(188,1,'113',NULL,0,NULL),
(189,1,'112',NULL,1,NULL),
(190,1,'114',NULL,1,NULL),
(191,2,'114',NULL,0,NULL),
(192,2,'113',NULL,1,NULL),
(193,2,'112',NULL,1,NULL),
(194,2,'104',NULL,1,NULL),
(195,2,'103',NULL,1,NULL),
(196,1,'115',NULL,1,NULL),
(201,2,'115',NULL,1,NULL),
(206,1,'120',NULL,1,NULL),
(211,2,'120',NULL,1,NULL),
(220,1,'125',NULL,1,NULL),
(221,2,'125',NULL,1,NULL),
(226,1,'130',NULL,0,NULL),
(227,1,'131',NULL,1,NULL),
(228,1,'132',NULL,0,NULL),
(229,1,'133',NULL,1,NULL),
(230,1,'134',NULL,1,NULL),
(233,1,'137',NULL,1,NULL),
(234,1,'139',NULL,1,NULL),
(235,1,'141',NULL,1,NULL),
(236,1,'142',NULL,1,NULL),
(237,1,'143',NULL,1,NULL),
(238,3,'4',NULL,1,NULL),
(239,3,'103',NULL,1,NULL),
(240,3,'104',NULL,1,NULL),
(241,3,'112',NULL,1,NULL),
(242,3,'113',NULL,1,NULL),
(243,3,'114',NULL,1,NULL),
(244,3,'115',NULL,1,NULL),
(249,3,'120',NULL,1,NULL),
(254,3,'125',NULL,1,NULL),
(259,3,'130',NULL,1,NULL),
(260,3,'131',NULL,1,NULL),
(261,3,'132',NULL,1,NULL),
(262,3,'133',NULL,1,NULL),
(263,3,'134',NULL,1,NULL),
(266,3,'137',NULL,1,NULL),
(267,3,'139',NULL,1,NULL),
(268,3,'141',NULL,1,NULL),
(269,3,'142',NULL,1,NULL),
(270,3,'143',NULL,1,NULL),
(271,4,'1',NULL,0,NULL),
(272,4,'4',NULL,1,NULL),
(273,4,'5',NULL,1,NULL),
(274,4,'103',NULL,1,NULL),
(275,4,'104',NULL,1,NULL),
(276,4,'112',NULL,1,NULL),
(277,4,'113',NULL,1,NULL),
(278,4,'114',NULL,1,NULL),
(279,4,'115',NULL,1,NULL),
(284,4,'120',NULL,1,NULL),
(289,4,'125',NULL,1,NULL),
(294,4,'130',NULL,1,NULL),
(295,4,'131',NULL,1,NULL),
(296,4,'132',NULL,1,NULL),
(297,4,'133',NULL,1,NULL),
(298,4,'134',NULL,1,NULL),
(301,4,'137',NULL,1,NULL),
(302,4,'139',NULL,1,NULL),
(303,4,'141',NULL,1,NULL),
(304,4,'142',NULL,1,NULL),
(305,4,'143',NULL,1,NULL),
(306,5,'4',NULL,1,NULL),
(307,5,'113',NULL,1,NULL),
(308,5,'133',NULL,1,NULL),
(310,5,'139',NULL,1,NULL),
(311,5,'142',NULL,1,NULL),
(312,6,'4',NULL,1,NULL),
(313,6,'113',NULL,1,NULL),
(314,6,'115',NULL,1,NULL),
(319,6,'142',NULL,1,NULL),
(320,7,'133',NULL,1,NULL),
(322,7,'139',NULL,1,NULL),
(323,7,'142',NULL,1,NULL),
(324,8,'4',NULL,1,NULL),
(325,8,'125',NULL,1,NULL),
(330,8,'142',NULL,1,NULL),
(331,8,'143',NULL,1,NULL),
(332,9,'113',NULL,1,NULL),
(333,9,'103',NULL,1,NULL),
(334,7,'103',NULL,1,NULL),
(335,5,'103',NULL,1,NULL),
(336,8,'103',NULL,1,NULL),
(338,10,'4',NULL,1,NULL),
(339,9,'142',NULL,1,NULL),
(340,10,'103',NULL,1,NULL),
(341,10,'104',NULL,1,NULL),
(342,10,'112',NULL,1,NULL),
(343,10,'130',NULL,1,NULL),
(344,10,'131',NULL,1,NULL),
(345,10,'132',NULL,1,NULL),
(347,10,'141',NULL,1,NULL),
(348,10,'142',NULL,1,NULL),
(349,13,'113',NULL,1,NULL),
(350,13,'142',NULL,1,NULL),
(351,13,'103',NULL,1,NULL),
(352,15,'4',NULL,1,NULL),
(353,15,'103',NULL,1,NULL),
(354,15,'112',NULL,1,NULL),
(355,15,'113',NULL,1,NULL),
(356,15,'114',NULL,1,NULL),
(357,15,'115',NULL,1,NULL),
(362,15,'125',NULL,1,NULL),
(367,15,'130',NULL,1,NULL),
(368,15,'131',NULL,1,NULL),
(369,15,'132',NULL,1,NULL),
(370,15,'133',NULL,1,NULL),
(371,15,'134',NULL,0,NULL),
(374,15,'141',NULL,1,NULL),
(375,15,'142',NULL,1,NULL),
(376,14,'103',NULL,1,NULL),
(377,14,'4',NULL,1,NULL),
(378,14,'113',NULL,1,NULL),
(379,14,'114',NULL,1,NULL),
(380,14,'120',NULL,1,NULL),
(386,14,'141',NULL,1,NULL),
(387,14,'142',NULL,1,NULL),
(388,14,'143',NULL,1,NULL),
(389,16,'104',NULL,1,NULL),
(390,16,'103',NULL,1,NULL),
(391,16,'113',NULL,1,NULL),
(392,16,'139',NULL,1,NULL),
(393,17,'113',NULL,1,NULL),
(394,18,'103',NULL,1,NULL),
(396,18,'142',NULL,1,NULL),
(397,10,'115',NULL,1,NULL),
(398,2,'130',NULL,1,NULL),
(399,2,'132',NULL,1,NULL);

/*Table structure for table `user_group` */

DROP TABLE IF EXISTS `user_group`;

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) DEFAULT NULL,
  `note` text,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `user_group` */

insert  into `user_group`(`id`,`group_name`,`note`,`created_by`,`created_at`,`updated_by`,`updated_at`) values 
(1,'Manager','-',0,NULL,0,NULL),
(2,'Kasir','-',0,NULL,0,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(250) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL COMMENT 'fk dari tabel user_group',
  `foto` varchar(250) DEFAULT NULL,
  `telp` varchar(250) DEFAULT NULL,
  `note` text,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `note_1` text,
  `ip` varchar(15) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `id_cabang` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `users` */

insert  into `users`(`id_user`,`fullname`,`username`,`password`,`email`,`id_group`,`foto`,`telp`,`note`,`created_by`,`updated_by`,`created_at`,`updated_at`,`note_1`,`ip`,`last_login`,`id_cabang`) values 
(1,'Nadia Aurelia','nadia','227edf7c86c02a44d17eec9aa5b30cd1','admin@mail.com',1,'','089636555456','',1,1,'2018-03-13 03:06:55','2018-03-13 03:06:55','','','2019-08-27 20:12:45',''),
(2,'Fahrudin Yuniwinanto','fahrudin','227edf7c86c02a44d17eec9aa5b30cd1','fahrudinyewe@gmail.com',2,'','089636555456','',1,0,'2018-03-13 03:06:55','2018-03-13 03:06:55','',NULL,NULL,'');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
