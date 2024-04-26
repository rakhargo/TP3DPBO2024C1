/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_lamaran

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-04-27 00:11:57
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `jurusan`
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of jurusan
-- ----------------------------
INSERT INTO `jurusan` VALUES ('1', 'Ilmu Komputer');
INSERT INTO `jurusan` VALUES ('2', 'Matematika');
INSERT INTO `jurusan` VALUES ('3', 'Rekayasa Perangkat Lunak');
INSERT INTO `jurusan` VALUES ('4', 'Sistem Informasi');
INSERT INTO `jurusan` VALUES ('5', 'Teknik Informatika');
INSERT INTO `jurusan` VALUES ('6', 'Teknik Komputer');
INSERT INTO `jurusan` VALUES ('8', 'IPSE');

-- ----------------------------
-- Table structure for `lowongan`
-- ----------------------------
DROP TABLE IF EXISTS `lowongan`;
CREATE TABLE `lowongan` (
  `id_lowongan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lowongan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_lowongan`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of lowongan
-- ----------------------------
INSERT INTO `lowongan` VALUES ('2', 'Mobile Developer');
INSERT INTO `lowongan` VALUES ('3', 'Data Scientist');
INSERT INTO `lowongan` VALUES ('4', 'Machine Learning Engineer');
INSERT INTO `lowongan` VALUES ('5', 'Data Engineer');
INSERT INTO `lowongan` VALUES ('6', 'Data Analyst');
INSERT INTO `lowongan` VALUES ('7', 'Cyber Security');
INSERT INTO `lowongan` VALUES ('8', 'Back-End Developer');
INSERT INTO `lowongan` VALUES ('9', 'Front-End Developer');
INSERT INTO `lowongan` VALUES ('10', 'Fullstack Developer');
INSERT INTO `lowongan` VALUES ('12', 'Baristaaaa');

-- ----------------------------
-- Table structure for `pelamar`
-- ----------------------------
DROP TABLE IF EXISTS `pelamar`;
CREATE TABLE `pelamar` (
  `id_pelamar` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `domisili` varchar(255) NOT NULL,
  `pasfoto` varchar(255) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  PRIMARY KEY (`id_pelamar`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of pelamar
-- ----------------------------
INSERT INTO `pelamar` VALUES ('1', 'Rakha Dhifiargo', 'Bekasi', '1.jpg', '4', '1');
INSERT INTO `pelamar` VALUES ('7', 'rakha dpmb', 'jakarta', '7.png', '7', '2');
INSERT INTO `pelamar` VALUES ('10', 'rere', 'gaurt', '8.png', '2', '1');
