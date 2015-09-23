/*
Navicat MySQL Data Transfer

Source Server         : web
Source Server Version : 50154
Source Host           : 210.51.23.71:3306
Source Database       : weixinqiang

Target Server Type    : MYSQL
Target Server Version : 50154
File Encoding         : 65001

Date: 2014-02-21 13:52:34
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `zd_admin`
-- ----------------------------
DROP TABLE IF EXISTS `zd_admin`;
CREATE TABLE `zd_admin` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zd_admin
-- ----------------------------

-- ----------------------------
-- Table structure for `zd_draw`
-- ----------------------------
DROP TABLE IF EXISTS `zd_draw`;
CREATE TABLE `zd_draw` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `function` int(3) NOT NULL,
  `type` int(3) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zd_draw
-- ----------------------------
INSERT INTO `zd_draw` VALUES ('1', '', '2', '1');

-- ----------------------------
-- Table structure for `zd_fans`
-- ----------------------------
DROP TABLE IF EXISTS `zd_fans`;
CREATE TABLE `zd_fans` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imgurl` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fromusername` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fake_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(3) NOT NULL,
  `sex` int(3) NOT NULL,
  `province` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zd_fans
-- ----------------------------
INSERT INTO `zd_fans` VALUES ('24', 'http://wxq.08k.cn/upload/oi1tYt9dddVxPvdL3fR-P0UPrsY4.jpg', '', 'DNweixin.com', 'oi1tYt9dddVxPvdL3fR-P0UPrsY4', '2856116008', '0', '0', '', '', '');

-- ----------------------------
-- Table structure for `zd_fanvote`
-- ----------------------------
DROP TABLE IF EXISTS `zd_fanvote`;
CREATE TABLE `zd_fanvote` (
  `Id` int(11) NOT NULL,
  `fromusername` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zd_fanvote
-- ----------------------------

-- ----------------------------
-- Table structure for `zd_list`
-- ----------------------------
DROP TABLE IF EXISTS `zd_list`;
CREATE TABLE `zd_list` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `examine` int(3) NOT NULL DEFAULT '0',
  `type` int(3) NOT NULL,
  `choose` int(3) NOT NULL DEFAULT '0',
  `fromusername` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fake_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `newsid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sex` int(3) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zd_list
-- ----------------------------

-- ----------------------------
-- Table structure for `zd_project`
-- ----------------------------
DROP TABLE IF EXISTS `zd_project`;
CREATE TABLE `zd_project` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `num` int(11) NOT NULL,
  `order` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zd_project
-- ----------------------------
INSERT INTO `zd_project` VALUES ('247', '', '0', '0');

-- ----------------------------
-- Table structure for `zd_publicnum`
-- ----------------------------
DROP TABLE IF EXISTS `zd_publicnum`;
CREATE TABLE `zd_publicnum` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `pnum` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `original` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `signal` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(4) NOT NULL,
  `appid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `appsecret` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `accesstoken` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zd_publicnum
-- ----------------------------
INSERT INTO `zd_publicnum` VALUES ('1', '支点科技', '', '', '1', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for `zd_state`
-- ----------------------------
DROP TABLE IF EXISTS `zd_state`;
CREATE TABLE `zd_state` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `fromusername` varchar(255) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zd_state
-- ----------------------------
INSERT INTO `zd_state` VALUES ('4', 'oTMR5jnCkUPU0ALiTi_HlENUd9Pw', '2');
INSERT INTO `zd_state` VALUES ('6', 'oi1tYt8s6-AWlRcMEcXbUXkfWsjo', '0');
INSERT INTO `zd_state` VALUES ('8', 'oi1tYtzAEhR7PainDag4Y8QzSDtk', '0');
INSERT INTO `zd_state` VALUES ('9', 'oi1tYtw3Q_BDqMIhTECQmxbIBwUk', '0');
INSERT INTO `zd_state` VALUES ('10', 'oi1tYt-qFAaReYKfEGoMJ3KRBY74', '1');
INSERT INTO `zd_state` VALUES ('11', 'oi1tYt9dddVxPvdL3fR-P0UPrsY4', '1');
INSERT INTO `zd_state` VALUES ('12', 'oi1tYt4aRmQtupPQ0VVXTGSUNp8U', '2');
INSERT INTO `zd_state` VALUES ('14', 'oi1tYt-k1_HijCTiLJYqVP_ac9Uo', '1');
INSERT INTO `zd_state` VALUES ('15', 'oTMR5jr_yVKP7d4BF08gOgetaeZA', '1');
INSERT INTO `zd_state` VALUES ('16', 'oTMR5jkmTh70e5AT1Yj3xsEssIpI', '1');

-- ----------------------------
-- Table structure for `zd_vote`
-- ----------------------------
DROP TABLE IF EXISTS `zd_vote`;
CREATE TABLE `zd_vote` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `function` int(3) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zd_vote
-- ----------------------------
INSERT INTO `zd_vote` VALUES ('1', '', '1');

-- ----------------------------
-- Table structure for `zd_wall`
-- ----------------------------
DROP TABLE IF EXISTS `zd_wall`;
CREATE TABLE `zd_wall` (
  `Id` int(5) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `preface` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `examine` int(3) NOT NULL,
  `function` int(3) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zd_wall
-- ----------------------------
INSERT INTO `zd_wall` VALUES ('1', '/Public/kindeditor/attached/image/20140221/20140221104731_23340.jpg', '欢迎参与微信墙活动！！！', '2', '1');
