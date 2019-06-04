/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : 127.0.0.1:3306
 Source Schema         : car

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 04/06/2019 21:21:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `gid` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of account
-- ----------------------------
INSERT INTO `account` VALUES (1, 'admin', '9cbf8a4dcb8e30682b927f352d6559a0', 0, 1, 1559255123, 1559255123);
INSERT INTO `account` VALUES (5, 'jinbao', '9cbf8a4dcb8e30682b927f352d6559a0', 0, 2, 1559266237, 1559266237);

-- ----------------------------
-- Table structure for balance_list
-- ----------------------------
DROP TABLE IF EXISTS `balance_list`;
CREATE TABLE `balance_list`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `balance_item` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `balance` decimal(50, 2) NOT NULL DEFAULT 0.00,
  `create_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of balance_list
-- ----------------------------
INSERT INTO `balance_list` VALUES (5, 2, '喷漆', 10.00, 1559362786);
INSERT INTO `balance_list` VALUES (6, 6, '洗车,喷漆', 10.00, 1559362955);
INSERT INTO `balance_list` VALUES (7, 6, '洗车,喷漆', 100.00, 1559363820);
INSERT INTO `balance_list` VALUES (8, 6, '喷漆,打蜡', 1000.00, 1559652825);
INSERT INTO `balance_list` VALUES (10, 6, '洗车,喷漆,打蜡', 10000.00, 1559654426);

-- ----------------------------
-- Table structure for integral
-- ----------------------------
DROP TABLE IF EXISTS `integral`;
CREATE TABLE `integral`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `price` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order` int(10) NOT NULL DEFAULT 0,
  `create_time` int(10) NOT NULL DEFAULT 0,
  `update_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of integral
-- ----------------------------
INSERT INTO `integral` VALUES (2, '打蜡', 500, 0, 1559648005, 1559648005);
INSERT INTO `integral` VALUES (3, '洗车', 200, 0, 1559648546, 1559648546);

-- ----------------------------
-- Table structure for integral_list
-- ----------------------------
DROP TABLE IF EXISTS `integral_list`;
CREATE TABLE `integral_list`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT 0,
  `name` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `price` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of integral_list
-- ----------------------------
INSERT INTO `integral_list` VALUES (1, 6, '洗车', 1559653130, 200);
INSERT INTO `integral_list` VALUES (2, 6, '洗车', 1559653170, 0);
INSERT INTO `integral_list` VALUES (6, 6, '打蜡,洗车', 1559654437, 700);
INSERT INTO `integral_list` VALUES (5, 6, '洗车', 1559653845, 200);

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(10) NOT NULL DEFAULT 0,
  `update_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of item
-- ----------------------------
INSERT INTO `item` VALUES (1, '洗车', 2, 0, 1559357143);
INSERT INTO `item` VALUES (3, '喷漆', 0, 1559357201, 1559357201);
INSERT INTO `item` VALUES (4, '打蜡', 0, 1559357209, 1559357209);

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `controller` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `method` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `ishidden` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `update_time` int(10) UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 0, 0, '主页', 'layui-icon-auz', '', '', 0, 0, 0, 0);
INSERT INTO `menu` VALUES (2, 1, 0, '控制台', '', 'index', 'welcome', 0, 0, 0, 0);
INSERT INTO `menu` VALUES (9, 0, 1, '管理员管理', 'layui-icon-user', '', '', 0, 0, 1559278716, 1559278716);
INSERT INTO `menu` VALUES (5, 0, 2, '权限管理', 'layui-icon-auz', '', '', 0, 0, 0, 1559278852);
INSERT INTO `menu` VALUES (6, 5, 0, '菜单管理', '', 'menu', 'index', 0, 0, 0, 0);
INSERT INTO `menu` VALUES (7, 5, 0, '角色管理', '', 'roles', 'index', 0, 0, 1559268574, 1559268726);
INSERT INTO `menu` VALUES (10, 9, 0, '管理员列表', '', 'account', 'a_list', 0, 0, 1559278906, 1559284369);
INSERT INTO `menu` VALUES (11, 0, 3, '会员管理', 'layui-icon-username', '', '', 0, 0, 1559285079, 1559285102);
INSERT INTO `menu` VALUES (12, 11, 0, '会员列表', '', 'user', 'index', 0, 0, 1559285167, 1559285167);
INSERT INTO `menu` VALUES (13, 0, 4, '经营管理', 'layui-icon-engine', '', '', 0, 0, 1559356147, 1559356167);
INSERT INTO `menu` VALUES (14, 13, 0, '经营项目', '', 'item', 'index', 0, 0, 1559356219, 1559356219);
INSERT INTO `menu` VALUES (15, 0, 5, '积分管理', 'layui-icon-cart-simple', '', '', 0, 0, 1559646478, 1559646544);
INSERT INTO `menu` VALUES (17, 15, 0, '积分消费项目', '', 'integral', 'index', 0, 0, 1559646710, 1559646710);

-- ----------------------------
-- Table structure for recharge_list
-- ----------------------------
DROP TABLE IF EXISTS `recharge_list`;
CREATE TABLE `recharge_list`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `recharge` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `create_time` int(10) NOT NULL DEFAULT 0,
  `update_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of recharge_list
-- ----------------------------
INSERT INTO `recharge_list` VALUES (7, 6, 100.00, 1559362948, 0);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `right` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, '超级管理员', '15,13,11,5,9,1,2,6,7,10,12,14,17');
INSERT INTO `roles` VALUES (2, '系统管理员', '1,2');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mobile` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `card` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `car` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `recharge` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `balance` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `integral` int(10) NOT NULL DEFAULT 0,
  `money` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `create_time` int(10) NOT NULL DEFAULT 0,
  `update_time` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `mobile`(`mobile`, `card`, `car`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (6, '17095068600', '0000', '苏E3897n', 100.00, 10.00, 9410, 12100.00, 1559362936, 1559654437);
INSERT INTO `user` VALUES (3, '17095068660', '0003', '苏E38975', 0.00, 0.00, 0, 0.00, 1559290282, 1559290282);
INSERT INTO `user` VALUES (4, '17095068661', '0004', '苏E38976', 0.00, 0.00, 0, 0.00, 1559290317, 1559290317);

SET FOREIGN_KEY_CHECKS = 1;
