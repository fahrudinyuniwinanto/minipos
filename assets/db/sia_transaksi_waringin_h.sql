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

 Date: 23/03/2023 16:13:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sia_transaksi_waringin_h
-- ----------------------------
DROP TABLE IF EXISTS `sia_transaksi_waringin_h`;
CREATE TABLE `sia_transaksi_waringin_h`  (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_input` date NOT NULL,
  `no_ref` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ket` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_by` varchar(18) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `update_by` varchar(18) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  `isactive` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sia_transaksi_waringin_h
-- ----------------------------
INSERT INTO `sia_transaksi_waringin_h` VALUES (5, '2023-03-23', '566', '-', 'waringin1', '', '2023-03-23 11:20:49', '0000-00-00 00:00:00', 1);
INSERT INTO `sia_transaksi_waringin_h` VALUES (6, '2023-03-24', '12/09/ABD', '000', 'waringin1', '', '2023-03-23 11:28:48', '0000-00-00 00:00:00', 1);

SET FOREIGN_KEY_CHECKS = 1;
