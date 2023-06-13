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

 Date: 23/03/2023 16:14:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id_kat` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `for_modul` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_by` varchar(18) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `update_by` varchar(18) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `isactive` int(11) NULL DEFAULT NULL,
  `note2` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `note3` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_kat`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (9, 'DEBIT', 'DEBIT', 'JENIS_PEMBAYARAN', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '');
INSERT INTO `kategori` VALUES (10, 'KREDIT', 'KREDIT', 'JENIS_PEMBAYARAN', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '');
INSERT INTO `kategori` VALUES (16, 'MANUAL', 'MANUAL', 'STATUS', 'Hidayat Chandra', '', '2023-01-01 15:12:45', '0000-00-00 00:00:00', 1, '', '');
INSERT INTO `kategori` VALUES (17, 'OTOMATIS', 'OTOMATIS', 'STATUS', 'Hidayat Chandra', '', '2023-01-01 15:12:59', '0000-00-00 00:00:00', 1, '', '');
INSERT INTO `kategori` VALUES (18, 'AKTIF', 'AKTIF', 'AKTIF', 'waringin1', '', '2023-03-16 08:57:41', '0000-00-00 00:00:00', 1, 'AKTIF', 'AKTIF');
INSERT INTO `kategori` VALUES (19, 'NON AKTIF', 'NON AKTIF', 'AKTIF', 'waringin1', '', '2023-03-16 08:57:58', '0000-00-00 00:00:00', 1, 'NON AKTIF', 'NON AKTIF');
INSERT INTO `kategori` VALUES (20, 'LAPORAN LABA_RUGI', 'LAPORAN LABA_RUGI', 'LAPORAN', 'waringin1', '', '2023-03-16 09:38:28', '0000-00-00 00:00:00', 1, 'LAPORAN LABA_RUGI', 'LAPORAN LABA_RUGI');
INSERT INTO `kategori` VALUES (21, 'NERACA LABA RUGI', 'NERACA LABA RUGI', 'LAPORAN', 'waringin1', '', '2023-03-16 09:38:44', '0000-00-00 00:00:00', 1, 'NERACA LABA RUGI', 'NERACA LABA RUGI');
INSERT INTO `kategori` VALUES (22, 'LAPORAN PENERIMAAN & PENGELUARAN', 'LAPORAN PENERIMAAN KAS', 'LAPORAN', 'waringin1', '', '2023-03-16 09:39:17', '0000-00-00 00:00:00', 1, 'LAPORAN PENERIMAAN KAS', 'LAPORAN PENERIMAAN KAS');
INSERT INTO `kategori` VALUES (23, 'N', 'NERACA', 'JENIS_LAPORAN', 'waringin1', '', '2023-03-22 10:50:26', '0000-00-00 00:00:00', 1, 'NERACA', 'NERACA');
INSERT INTO `kategori` VALUES (24, 'L/R', 'LABA RUGI', 'JENIS_LAPORAN', 'waringin1', '', '2023-03-22 10:50:56', '0000-00-00 00:00:00', 1, 'LABA RUGI', 'LABA RUGI');
INSERT INTO `kategori` VALUES (25, 'Akun', 'Akun', 'PENANDA', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `kategori` VALUES (26, 'Akun Lawan', 'Akun Lawan', 'PENANDA', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
