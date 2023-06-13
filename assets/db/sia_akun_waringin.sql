/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : barang

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 23/03/2023 16:14:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sia_akun_waringin
-- ----------------------------
DROP TABLE IF EXISTS `sia_akun_waringin`;
CREATE TABLE `sia_akun_waringin`  (
  `id_akun` int(11) NOT NULL AUTO_INCREMENT,
  `no_coa` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_coa` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `parent` int(11) NULL DEFAULT NULL,
  `created_by` varchar(18) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `update_by` varchar(18) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `isactive` int(11) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `query` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `saldo_debit` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `saldo_kredit` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_saldo` int(1) NULL DEFAULT NULL,
  `jenis_laporan` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_akun`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 109 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sia_akun_waringin
-- ----------------------------
INSERT INTO `sia_akun_waringin` VALUES (1, '1.0.0', 'Aktiva', 'Asset', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (2, '1.1.0', 'Aktiva Lancar', 'Asset', 1, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (3, '1.1.1', 'Kas Kecil', 'Asset', 2, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, 16, 'KAS', '400000000', '', 9, 23);
INSERT INTO `sia_akun_waringin` VALUES (4, '1.1.2', 'Kas Besar', 'Asset', 2, NULL, NULL, NULL, NULL, 18, 16, 'KAS', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (5, '1.1.3', 'Bank BRI', 'Asset', 2, NULL, NULL, NULL, NULL, 18, 16, 'BANK', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (6, '1.1.4', 'Bank Jateng', 'Asset', 2, NULL, NULL, NULL, NULL, 18, 16, 'BANK', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (7, '1.1.5', 'Bank Pasar', 'Asset', 2, NULL, NULL, NULL, NULL, 18, 16, 'BANK', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (8, '1.1.1', 'Asuransi Dibayar Dimuka', 'Asset', 2, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (9, '1.1.1', 'Peralatan', 'Asset', 2, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (10, '1.2.0', 'Investasi Jangka Panjang', 'Asset', 1, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (11, '1.2.1', 'Investasi Saham', 'Asset', 10, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (12, '1.2.2', 'Investasi Obligasi', 'Asset', 10, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (13, '1.3.0', 'Aktiva Tetap', 'Asset', 1, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (14, '1.3.1', 'Peralatan', 'Asset', 13, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (15, '1.3.2', 'Inventaris Kantor', 'Asset', 13, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (16, '1.3.3', 'Kendaraan', 'Asset', 13, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (17, '1.3.4', 'Akum. Peny. Kendaraan', 'Asset', 13, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (18, '1.3.5', 'Gedung', 'Asset', 13, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (19, '1.3.6', 'Akum. Peny. Gedung', 'Asset', 13, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (20, '1.3.7', 'Tanah', 'Asset', 13, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (21, '1.4.0', 'Aktiva Lain - Lain', 'Asset', 1, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (22, '1.4.1', 'Beban Yang Ditangguhkan', 'Asset', 21, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (23, '1.4.2', 'Beban Emisi Saham', 'Asset', 21, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (24, '2.0.0', 'Kewajiban', 'Hutang', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (25, '2.1.0', 'Kewajiban Jangka Pendek', 'Hutang', 24, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (26, '2.1.1', 'Utang Dagang', 'Hutang', 25, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (27, '2.1.2', 'Utang Wesel', 'Hutang', 25, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (28, '2.1.3', 'Utang Gaji', 'Hutang', 25, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (29, '2.1.4', 'Utang Sewa Gedung', 'Hutang', 25, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (30, '2.1.5', 'Beban Yang Masih Harus Dibayar', 'Hutang', 25, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (31, '2.1.6', 'Utang Pajak', 'Hutang', 25, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (32, '2.2.0', 'Kewajiban Jangka Panjang', 'Hutang', 24, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (33, '2.2.1', 'Utang Hipotek', 'Hutang', 32, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (34, '2.2.3', 'Utang Obligasi', 'Hutang', 32, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (35, '3.0.0', 'Modal', 'Modal', NULL, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (36, '3.1.0', 'Modal Pemilik', 'Modal', 35, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (37, '3.2.0', 'Tambahan Modal', 'Modal', 35, NULL, NULL, NULL, NULL, 18, 16, 'TAMBAHAN_MODAL', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (38, '3.3.0', 'Laba Ditahan/ Deviden /Kas Daerah', 'Modal', 35, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (39, '3.1.1', 'Kas Daerah', 'Modal', 35, NULL, NULL, NULL, NULL, 18, 16, 'MODAL', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (40, '3.2.1', 'Jasa Produksi', 'Modal', 35, NULL, NULL, NULL, NULL, 18, 16, 'MODAL', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (41, '3.3.1', 'Tantiem', 'Modal', 35, NULL, NULL, NULL, NULL, 18, 16, 'MODAL', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (42, '3.1.2', 'CSR', 'Modal', 35, NULL, NULL, NULL, NULL, 18, 16, 'MODAL', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (43, '3.2.2', 'Dana Kesejahteraan', 'Modal', 35, NULL, NULL, NULL, NULL, 18, 16, 'MODAL', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (44, '4.0.0', 'Pendapatan', 'Pendapatan', NULL, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (45, '4.1.0', 'Penerimaan Penjualan Obat', 'Pendapatan', 44, NULL, NULL, NULL, NULL, 18, 17, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (46, '4.1.1', 'Penerimaan Penjualan Obat Umum', 'Pendapatan', 45, NULL, NULL, NULL, NULL, 18, 17, 'SELECT SUM(total) AS penjualan_umum FROM jual_h WHERE isactive=1 AND jenis=\'UMUM\' AND LEFT(tanggal,7)=\'2023-02\'', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (47, '4.1.2', 'Penerimaan MK', 'Pendapatan', 45, NULL, NULL, NULL, NULL, 18, 17, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (48, '4.1.3', 'Penerimaan BPJS', 'Pendapatan', 45, NULL, NULL, NULL, NULL, 18, 17, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (49, '4.2.0', 'Retur', 'Pendapatan', 44, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (50, '4.3.0', 'Fee Pyridam', 'Pendapatan', 44, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (51, '4.4.0', 'Pendapatan Bunga', 'Biaya', 44, NULL, NULL, NULL, NULL, 18, 17, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (52, '4.5.0', 'Pendapatan Lain- Lain', 'Biaya', 44, NULL, NULL, NULL, NULL, 18, 17, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (53, '4.6.0', 'Administrasi Bank', 'Biaya', 44, NULL, NULL, NULL, NULL, 18, 17, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (54, '5.0.0', 'Biaya Usaha', 'Biaya', NULL, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (55, '5.1.0', 'Beban Pemasaran', 'Biaya', 54, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (56, '5.1.1', 'Biaya Pemasaran', 'Biaya', 54, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (57, '5.1.2', 'Biaya Jamuan Tamu Dinas', 'Biaya', 54, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (58, '5.2.0', 'Pembelian obat-obatan pada PBF', 'Biaya', NULL, NULL, NULL, NULL, NULL, 18, 17, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (59, '5.3.0', 'Beban Administrasi dan Umum', 'Biaya', NULL, NULL, NULL, NULL, NULL, 18, 16, '', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (60, '5.3.1', 'Beban penghasilan', 'Biaya', 59, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (61, '5.3.1.1', 'Gaji Pegawai / Karyawan & THR', 'Biaya', 60, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (62, '5.3.1.2', 'Honorarium Badan Pengawas', 'Biaya', 60, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (63, '5.3.1.3', 'Uang Lembur', 'Biaya', 60, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (64, '5.3.1.4', 'Dana Kesehatan Pegawai', 'Biaya', 60, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (65, '5.3.2', 'Beban administrasi', 'Biaya', 59, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (66, '5.3.3', 'Beban pemeliharaan gedung&kantor', 'Biaya', 59, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (67, '5.3.3.1', 'Pemeliharaan Gedung/Kantor', 'Biaya', 66, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (68, '5.3.3.2', 'Pemeliharaan Alat-alat Kantor', 'Biaya', 66, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (69, '5.3.4', 'Beban pengembangan SDM', 'Biaya', 59, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (70, '5.3.5', 'Beban transport & SPPD', 'Biaya', 59, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (71, '5.3.6', 'Beban Listrik, Telpon dan Air', 'Biaya', 59, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (72, '5.3.7', 'Beban Pakaian Dinas', 'Biaya', 59, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (73, '5.3.8', 'Beban penyusutan AT', 'Biaya', 59, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (74, '5.3.9', 'Beban Pajak', 'Biaya', 59, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (75, '5.3.9.1', 'Pajak PPh Pasal 25', 'Biaya', 74, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (76, '5.3.9.2', 'Pajak PPn ', 'Biaya', 74, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (77, '5.3.10', 'Beban KAP dan Pihak Ketiga', 'Biaya', 59, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (78, '5.3.11', 'Beban Sewa', 'Biaya', 59, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);
INSERT INTO `sia_akun_waringin` VALUES (79, '5.3.12', 'Beban lain-lain/tak terduga', 'Biaya', 59, NULL, NULL, NULL, NULL, 18, 16, 'BEBAN', NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
