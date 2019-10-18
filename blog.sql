/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : kaixin

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 18/10/2019 10:23:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ctime` int(10) NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1男 2为女',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0为可用 1为不可用',
  `login_ip` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `d_id` int(11) NOT NULL DEFAULT 0 COMMENT '部门id',
  `type` tinyint(1) NULL DEFAULT 1 COMMENT '1超级管理员2管理员（12可登陆前后台）3用户只能那个登陆前台',
  PRIMARY KEY (`a_id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 58 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台用户表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (57, 'admin', 'lulu', 'e10adc3949ba59abbe56e057f20f883e', 1557196798, 1, 0, '124.90.45.244', 1, 1);

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role`  (
  `r_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `a_id` int(11) NOT NULL COMMENT '用户id',
  `m_id` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '目录id集合',
  `create_time` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`r_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '项目名称',
  `introduction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '简介',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '用户预约说明',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0下架1上架',
  `create_time` int(11) NOT NULL DEFAULT 0,
  `update_time` int(11) NOT NULL DEFAULT 0,
  `delete_time` int(11) NOT NULL DEFAULT 0,
  `like_num` int(11) NOT NULL DEFAULT 0 COMMENT '点赞',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '项目信息' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES (1, 'heihei', '<p style=\"text-align: justify;\">哈哈哈哈哈哈哈哈粉红色的将开发客户和康师傅何时可掇还款方式疯狂很快会思考的会发生还款方式电话客服售后快递和访客方式快递费好</p>', '<p>6456</p>', 1, 1571292609, 0, 0, 108);
INSERT INTO `article` VALUES (2, '6546', '<p>65464</p>', '<p>6546</p>', 1, 1571279968, 0, 0, 18);

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department`  (
  `d_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `d_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '部门名称',
  `create_time` int(11) NOT NULL DEFAULT 0,
  `delete_time` int(11) NOT NULL DEFAULT 0 COMMENT '删除时间',
  `update_time` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`d_id`) USING BTREE,
  UNIQUE INDEX `d_name`(`d_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '部门表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES (1, '管理员', 1554962068, 0, 0);

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `m_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `m_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '目录名称',
  `level` tinyint(1) NOT NULL DEFAULT 1 COMMENT '层级',
  `url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '目录url',
  `pid` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0一级1二级3三级操作',
  `create_time` int(11) NOT NULL DEFAULT 0,
  `update_time` int(11) NOT NULL DEFAULT 0,
  `delete_time` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`m_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 54 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '栏目表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (44, '文章管理', 1, '', 0, 1556501788, 1556501833, 0);
INSERT INTO `menu` VALUES (2, '用户管理', 1, '', 0, 1554690236, 0, 0);
INSERT INTO `menu` VALUES (6, '系统设置', 1, '', 0, 1554691775, 0, 0);
INSERT INTO `menu` VALUES (9, '分组管理', 2, '/admin/department/departmentList', 2, 1554691859, 1571278170, 0);
INSERT INTO `menu` VALUES (10, '管理员列表', 2, '/admin/admin/adminList', 2, 1554691876, 1556514783, 0);
INSERT INTO `menu` VALUES (11, '栏目管理', 2, '/admin/menu/menuList', 6, 1554691895, 0, 0);
INSERT INTO `menu` VALUES (18, '添加分组', 3, '/admin/department/departmentAdd', 9, 1554692340, 0, 0);
INSERT INTO `menu` VALUES (19, '修改分组', 3, '/admin/department/departmentEdit', 9, 1554692357, 0, 0);
INSERT INTO `menu` VALUES (20, '删除分组', 3, '/admin/department/departmentDel', 9, 1554692373, 0, 0);
INSERT INTO `menu` VALUES (21, '添加用户', 3, '/admin/admin/adminAdd', 10, 1554692408, 0, 0);
INSERT INTO `menu` VALUES (22, '修改用户', 3, '/admin/admin/adminEdit', 10, 1554692423, 0, 0);
INSERT INTO `menu` VALUES (23, '删除用户', 3, '/admin/admin/adminDel', 10, 1554692440, 0, 0);
INSERT INTO `menu` VALUES (24, '添加栏目', 3, '/admin/menu/menuAdd', 11, 1554692502, 0, 0);
INSERT INTO `menu` VALUES (25, '修改栏目', 3, '/admin/menu/menuEdit', 11, 1554692518, 0, 0);
INSERT INTO `menu` VALUES (26, '删除栏目', 3, '/admin/menu/menuDel', 11, 1554692537, 0, 0);
INSERT INTO `menu` VALUES (46, '前台用户', 2, '/admin/user/userList', 2, 1556607567, 0, 1571278278);
INSERT INTO `menu` VALUES (47, '配置', 2, '/admin/admin/configList', 6, 1556611871, 0, 1571277841);
INSERT INTO `menu` VALUES (45, '文章列表', 2, '/admin/article/articleList', 44, 1556501870, 0, 0);
INSERT INTO `menu` VALUES (48, '删除', 3, '/admin/user/userDel', 46, 1556613691, 0, 0);
INSERT INTO `menu` VALUES (49, '社群打新', 3, '/admin/user/userEdit', 46, 1556613728, 0, 0);
INSERT INTO `menu` VALUES (50, '添加文章', 3, '/admin/article/articleAdd', 45, 1557197121, 0, 0);
INSERT INTO `menu` VALUES (52, '修改文章', 3, '/admin/article/articleEdit', 45, 1557197203, 0, 0);
INSERT INTO `menu` VALUES (53, '删除文章', 3, '/admin/article/articleDel', 45, 1557197250, 1557197294, 0);

SET FOREIGN_KEY_CHECKS = 1;
