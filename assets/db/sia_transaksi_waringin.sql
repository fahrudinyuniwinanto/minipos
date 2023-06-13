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

 Date: 23/03/2023 16:13:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sia_transaksi_waringin
-- ----------------------------
DROP TABLE IF EXISTS `sia_transaksi_waringin`;
CREATE TABLE `sia_transaksi_waringin`  (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi_h` int(11) NULL DEFAULT NULL,
  `penanda` int(1) NULL DEFAULT NULL,
  `id_akun` int(11) NOT NULL,
  `tgl_input` date NOT NULL,
  `jenis_saldo` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `saldo` int(11) NOT NULL,
  `ket` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_by` varchar(18) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `update_by` varchar(18) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `isactive` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sia_transaksi_waringin
-- ----------------------------
INSERT INTO `sia_transaksi_waringin` VALUES (9, 5, 26, 57, '0000-00-00', '10', 90000, '', 'waringin1', '', '2023-03-23 11:20:49', '0000-00-00 00:00:00', 1);
INSERT INTO `sia_transaksi_waringin` VALUES (10, 5, 25, 3, '0000-00-00', '9', 90000, '', 'waringin1', '', '2023-03-23 11:20:49', '0000-00-00 00:00:00', 1);
INSERT INTO `sia_transaksi_waringin` VALUES (11, 6, 26, 29, '0000-00-00', '10', 80000, '', 'waringin1', '', '2023-03-23 11:28:48', '0000-00-00 00:00:00', 1);
INSERT INTO `sia_transaksi_waringin` VALUES (12, 6, 25, 3, '0000-00-00', '9', 80000, '', 'waringin1', '', '2023-03-23 11:28:48', '0000-00-00 00:00:00', 1);

SET FOREIGN_KEY_CHECKS = 1;
