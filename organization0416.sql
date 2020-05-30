/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : organization0406

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2017-04-16 18:02:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `activity`
-- ----------------------------
DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `actID` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `actname` varchar(255) NOT NULL,
  `sponsorID` int(3) unsigned NOT NULL,
  `actgrade` enum('院级','校级') NOT NULL DEFAULT '校级',
  `introduction` varchar(100) NOT NULL,
  `joinstartdate` date NOT NULL COMMENT '报名开始时间',
  `joinenddate` date NOT NULL COMMENT '报名结束时间',
  `campaignstartdate` date NOT NULL COMMENT '比赛开始时间',
  `campaignenddate` date NOT NULL COMMENT '比赛结束时间',
  PRIMARY KEY (`actID`),
  KEY `FK_activity_sponsorID` (`sponsorID`),
  CONSTRAINT `FK_activity_sponsorID` FOREIGN KEY (`sponsorID`) REFERENCES `organ` (`organID`)
) ENGINE=InnoDB AUTO_INCREMENT=30000013 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of activity
-- ----------------------------
INSERT INTO `activity` VALUES ('30000000', 'IT文化节', '101', '校级', '信科举办IT技能大赛', '2017-04-11', '2017-04-23', '2017-04-24', '2017-05-14');
INSERT INTO `activity` VALUES ('30000002', '仲恺杯', '101', '校级', '篮球赛', '2017-05-01', '2017-05-07', '2017-05-08', '2017-05-27');
INSERT INTO `activity` VALUES ('30000003', '广交会志愿者', '102', '校级', '广交会志愿者', '2017-04-24', '2017-04-29', '2017-05-02', '2017-05-07');
INSERT INTO `activity` VALUES ('30000004', '急救培训', '105', '校级', '急救培训', '2017-05-15', '2017-05-19', '2017-05-20', '2017-05-20');
INSERT INTO `activity` VALUES ('30000005', '社联周年庆典', '103', '校级', '社联周年庆典', '2017-03-13', '2017-03-18', '2017-03-27', '2017-03-27');
INSERT INTO `activity` VALUES ('30000006', '团务日志', '100', '校级', '团委下属班级活动', '2017-04-18', '2017-04-26', '2017-05-01', '2017-05-06');
INSERT INTO `activity` VALUES ('30000007', '职业生涯规划大赛', '103', '校级', '职业生涯规划', '2017-04-17', '2017-04-21', '2017-04-24', '2017-04-28');

-- ----------------------------
-- Table structure for `awards`
-- ----------------------------
DROP TABLE IF EXISTS `awards`;
CREATE TABLE `awards` (
  `awardsID` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `campaignID` int(8) unsigned NOT NULL,
  `awards` varchar(10) NOT NULL,
  PRIMARY KEY (`awardsID`),
  KEY `FK_campaignID` (`campaignID`),
  CONSTRAINT `FK_campaignID` FOREIGN KEY (`campaignID`) REFERENCES `campaign` (`campaignID`)
) ENGINE=InnoDB AUTO_INCREMENT=40012 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of awards
-- ----------------------------
INSERT INTO `awards` VALUES ('40005', '40000003', '三等奖');
INSERT INTO `awards` VALUES ('40006', '40000002', '优秀奖');
INSERT INTO `awards` VALUES ('40007', '40000004', '安慰奖');
INSERT INTO `awards` VALUES ('40008', '40000001', '人气奖');
INSERT INTO `awards` VALUES ('40009', '40000004', '人气奖');
INSERT INTO `awards` VALUES ('40011', '40000006', '二等奖');

-- ----------------------------
-- Table structure for `booksite`
-- ----------------------------
DROP TABLE IF EXISTS `booksite`;
CREATE TABLE `booksite` (
  `bookID` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `siteID` int(6) unsigned NOT NULL,
  `borrower` varchar(12) NOT NULL,
  `number` int(11) NOT NULL,
  `borrowdate` date NOT NULL,
  `returndate` date NOT NULL,
  `state` enum('已驳回','通过','已归还','审理中') NOT NULL DEFAULT '审理中' COMMENT '状态',
  PRIMARY KEY (`bookID`),
  KEY `FK_siteID` (`siteID`),
  KEY `FK_booksite_borrower` (`borrower`),
  CONSTRAINT `FK_booksite_borrower` FOREIGN KEY (`borrower`) REFERENCES `member` (`stuID`),
  CONSTRAINT `FK_siteID` FOREIGN KEY (`siteID`) REFERENCES `site` (`siteID`)
) ENGINE=InnoDB AUTO_INCREMENT=80000004 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of booksite
-- ----------------------------
INSERT INTO `booksite` VALUES ('80000000', '700001', '201320254104', '1', '2017-04-18', '2017-04-27', '已归还');
INSERT INTO `booksite` VALUES ('80000001', '700001', '201320254104', '1', '2017-04-11', '2017-04-12', '通过');
INSERT INTO `booksite` VALUES ('80000002', '700001', '201320254104', '1', '2017-04-11', '2017-04-12', '已驳回');
INSERT INTO `booksite` VALUES ('80000003', '700003', '201320254104', '1', '2017-04-17', '2017-04-21', '通过');

-- ----------------------------
-- Table structure for `borrow`
-- ----------------------------
DROP TABLE IF EXISTS `borrow`;
CREATE TABLE `borrow` (
  `borrowID` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `materID` int(6) unsigned NOT NULL,
  `borrower` varchar(12) NOT NULL,
  `number` int(11) NOT NULL,
  `borrowdate` date NOT NULL,
  `returndate` date NOT NULL,
  `state` enum('已驳回','通过','已归还','审理中') NOT NULL DEFAULT '审理中' COMMENT '状态',
  PRIMARY KEY (`borrowID`),
  KEY `FK_materID` (`materID`),
  KEY `FK_borrower` (`borrower`),
  CONSTRAINT `FK_borrower` FOREIGN KEY (`borrower`) REFERENCES `member` (`stuID`),
  CONSTRAINT `FK_materID` FOREIGN KEY (`materID`) REFERENCES `materials` (`materID`)
) ENGINE=InnoDB AUTO_INCREMENT=60000004 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of borrow
-- ----------------------------
INSERT INTO `borrow` VALUES ('60000001', '500003', '201320254104', '10', '2017-04-11', '2017-04-13', '已归还');
INSERT INTO `borrow` VALUES ('60000002', '500002', '201320254102', '1', '2017-04-18', '2017-04-19', '审理中');
INSERT INTO `borrow` VALUES ('60000003', '500015', '201320254102', '1', '2017-04-05', '2017-04-07', '审理中');

-- ----------------------------
-- Table structure for `campaign`
-- ----------------------------
DROP TABLE IF EXISTS `campaign`;
CREATE TABLE `campaign` (
  `campaignID` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` varchar(12) NOT NULL,
  `actID` int(8) unsigned NOT NULL,
  PRIMARY KEY (`campaignID`),
  KEY `FK_campaign_stuID` (`stuID`),
  KEY `FK_campaign_actID` (`actID`),
  CONSTRAINT `FK_campaign_actID` FOREIGN KEY (`actID`) REFERENCES `activity` (`actID`),
  CONSTRAINT `FK_campaign_stuID` FOREIGN KEY (`stuID`) REFERENCES `member` (`stuID`)
) ENGINE=InnoDB AUTO_INCREMENT=40000011 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of campaign
-- ----------------------------
INSERT INTO `campaign` VALUES ('40000001', '201320254104', '30000000');
INSERT INTO `campaign` VALUES ('40000002', '201320254109', '30000000');
INSERT INTO `campaign` VALUES ('40000003', '201320254102', '30000002');
INSERT INTO `campaign` VALUES ('40000004', '201320254109', '30000004');
INSERT INTO `campaign` VALUES ('40000005', '201320254102', '30000005');
INSERT INTO `campaign` VALUES ('40000006', '201320254102', '30000006');
INSERT INTO `campaign` VALUES ('40000010', '201320254104', '30000004');

-- ----------------------------
-- Table structure for `club`
-- ----------------------------
DROP TABLE IF EXISTS `club`;
CREATE TABLE `club` (
  `clubID` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `clubname` varchar(10) NOT NULL,
  `introduction` varchar(100) NOT NULL,
  `PW` varchar(255) NOT NULL,
  PRIMARY KEY (`clubID`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of club
-- ----------------------------
INSERT INTO `club` VALUES ('201', '市场营销协会', '于 2005 年4 月22日成立，现属校级社团，是在学校党委的领导下，接受专业老师指导，并服从校团委及学生社团联合会的具体管理，是旨在倡导和传播市场文化、普及市场营销知识以及弘扬市场营销理念的非营利性', 'shiying');
INSERT INTO `club` VALUES ('202', '创新创业协会', '创协致力于为会员搭建一个广泛的交流平台和创造一个宽广的活动空间，激发会员的创造力和提高他们的活动组织能力，使会员不仅在学术上，在创新意识上，而且在组织，领导，策划和沟通能力上都能够有质的飞跃。通过全体', 'chuangxie');
INSERT INTO `club` VALUES ('203', '咏春拳协会', '协会是一个群众性学生社团组织，由喜爱中华武术的学生组织，直属院系团委、体育系部。针对广大师生，学习中国传统武术，继承民族文化，发展武道事业，发扬尚武精神，强身健体，磨练毅力，提高自身修养，让广大的学员', 'yongchun');
INSERT INTO `club` VALUES ('204', '职业发展协会', '成立于2004年3月12日，是在校团委领导、学生处就业指导中心指导下的一个校级协会。集学术性、专业性、指导性、服务性于一体，本着引导学生职业规划·服务学生就业成才的宗旨，开展各类提升职业竞争力的活动，', 'zhixie');
INSERT INTO `club` VALUES ('205', '仲恺电子商务协会', '主要职能是让校内同学与会员更清晰地了解电子商务的特点与流程。用最有创意最简洁的流程引起同学们对新型贸易方式的兴趣。仲恺电商协会是一个校级组织，成员招新面向全校，成员来自各个院系，各院系的成员的专业知识', 'dianshang');
INSERT INTO `club` VALUES ('206', '无线电协会', '协会成立12年多了，是仲恺历史最悠久、影响力最大的协会之一，协会以“丰富生活，务实进取，发挥个人潜能，为广大师生服务”为宗旨，在名誉会长校党委副书记高岳仑的领导下连续十一年获得“优秀社团”称号，成绩显', 'wuxiandian');
INSERT INTO `club` VALUES ('207', '环保协会', '环保协会成立于1996年5月4日，是我校宣传环保知识、进行社会实践唯一的环保社团，是在校团委及系办直接领导下的系级组织。协会根据内部性质和全院师生的要求，开展各种环保宣传活动，务求提高全院师生乃至社会', 'huanbao');
INSERT INTO `club` VALUES ('208', '跆拳道协会', '在训练中贯彻本社团的宗旨：礼仪廉耻，忍耐克己，百折不挠通过团结学校各阶层跆拳道运动爱好者，为发展跆拳道事业发挥积极作用，促进社团注意精神文明建设。在丰富学生业余生活，活跃学术气氛，锻炼和培养学生才干，', 'taixie');
INSERT INTO `club` VALUES ('209', '仲恺顽石音乐协会', '成立于2001年，宗旨是“给音乐生命”，协会定期组织了大大小小许多音乐会，为会员提供了许多展现才华的机会。以音乐会友，以吉他弹唱心声，平时开展许多各式各样的活动。', 'wanshi');
INSERT INTO `club` VALUES ('210', '英语俱乐部', '成立于1997年，由陈葆教授担任协会顾问。协会的宗旨是“服务仲园，做仲园学子们的助跑器”；它的目标是增强我院师生学习英语的积极性，提高大家英语口语水平，使同学们更好地掌握英语这种交流工具，提高自身的英', 'yingyu');

-- ----------------------------
-- Table structure for `department`
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `deID` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `organID` int(3) unsigned NOT NULL,
  `dename` varchar(10) NOT NULL,
  PRIMARY KEY (`deID`),
  KEY `FK_department_organID` (`organID`),
  CONSTRAINT `FK_department_organID` FOREIGN KEY (`organID`) REFERENCES `organ` (`organID`)
) ENGINE=InnoDB AUTO_INCREMENT=10504 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES ('10000', '100', '秘书部');
INSERT INTO `department` VALUES ('10001', '100', '档案部');
INSERT INTO `department` VALUES ('10002', '100', '编辑部');
INSERT INTO `department` VALUES ('10003', '100', '宣传部');
INSERT INTO `department` VALUES ('10004', '100', '组织部');
INSERT INTO `department` VALUES ('10005', '100', '实践部');
INSERT INTO `department` VALUES ('10006', '100', '调研部');
INSERT INTO `department` VALUES ('10007', '100', '学术科技部');
INSERT INTO `department` VALUES ('10008', '100', '网络部');
INSERT INTO `department` VALUES ('10009', '100', '外联部');
INSERT INTO `department` VALUES ('10100', '101', '办公室');
INSERT INTO `department` VALUES ('10101', '101', '外联部');
INSERT INTO `department` VALUES ('10102', '101', '档案部');
INSERT INTO `department` VALUES ('10103', '101', '文娱部');
INSERT INTO `department` VALUES ('10104', '101', '体育部');
INSERT INTO `department` VALUES ('10105', '101', '心理部');
INSERT INTO `department` VALUES ('10106', '101', '学术部');
INSERT INTO `department` VALUES ('10107', '101', '网信部');
INSERT INTO `department` VALUES ('10108', '101', '宣传部');
INSERT INTO `department` VALUES ('10109', '101', '权益与调研部');
INSERT INTO `department` VALUES ('10110', '101', '自律部');
INSERT INTO `department` VALUES ('10200', '102', '办公室');
INSERT INTO `department` VALUES ('10201', '102', '外联部');
INSERT INTO `department` VALUES ('10202', '102', '宣传部');
INSERT INTO `department` VALUES ('10300', '103', '办公室');
INSERT INTO `department` VALUES ('10301', '103', '外联部');
INSERT INTO `department` VALUES ('10302', '103', '宣传部');
INSERT INTO `department` VALUES ('10303', '103', '会员部');
INSERT INTO `department` VALUES ('10400', '104', '办公室');
INSERT INTO `department` VALUES ('10401', '104', '文艺部');
INSERT INTO `department` VALUES ('10402', '104', '宣传部');
INSERT INTO `department` VALUES ('10500', '105', '办公室');
INSERT INTO `department` VALUES ('10501', '105', '外联部');
INSERT INTO `department` VALUES ('10502', '105', '宣传部');
INSERT INTO `department` VALUES ('10503', '105', '医疗部');

-- ----------------------------
-- Table structure for `joinclub`
-- ----------------------------
DROP TABLE IF EXISTS `joinclub`;
CREATE TABLE `joinclub` (
  `joinID` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` varchar(12) NOT NULL,
  `clubID` int(3) unsigned NOT NULL,
  `position` enum('团长','副团长','部长','副部长','会员') NOT NULL DEFAULT '会员',
  `state` enum('通过','审理中','已驳回') NOT NULL DEFAULT '审理中' COMMENT '状态',
  PRIMARY KEY (`joinID`),
  KEY `FK_joinclub_stuID` (`stuID`),
  KEY `FK_joinclub_clubID` (`clubID`),
  CONSTRAINT `FK_joinclub_clubID` FOREIGN KEY (`clubID`) REFERENCES `club` (`clubID`),
  CONSTRAINT `FK_joinclub_stuID` FOREIGN KEY (`stuID`) REFERENCES `member` (`stuID`)
) ENGINE=InnoDB AUTO_INCREMENT=20000008 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of joinclub
-- ----------------------------
INSERT INTO `joinclub` VALUES ('20000001', '201320254104', '202', '会员', '审理中');
INSERT INTO `joinclub` VALUES ('20000002', '201320254104', '203', '会员', '审理中');
INSERT INTO `joinclub` VALUES ('20000003', '201320254104', '205', '会员', '审理中');
INSERT INTO `joinclub` VALUES ('20000004', '201320254109', '202', '会员', '审理中');
INSERT INTO `joinclub` VALUES ('20000005', '201320254109', '206', '会员', '审理中');
INSERT INTO `joinclub` VALUES ('20000006', '201320254102', '201', '会员', '通过');
INSERT INTO `joinclub` VALUES ('20000007', '201320254101', '201', '会员', '已驳回');

-- ----------------------------
-- Table structure for `joinorgan`
-- ----------------------------
DROP TABLE IF EXISTS `joinorgan`;
CREATE TABLE `joinorgan` (
  `joinID` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `stuID` varchar(12) NOT NULL,
  `deID` int(5) unsigned NOT NULL,
  `position` enum('主席','副主席','部长','副部长','助理') NOT NULL DEFAULT '助理',
  `state` enum('通过','审理中','已驳回') NOT NULL DEFAULT '审理中' COMMENT '状态',
  PRIMARY KEY (`joinID`),
  KEY `FK_joinorgan_stuID` (`stuID`),
  KEY `FK_joinorgan_deID` (`deID`),
  CONSTRAINT `FK_joinorgan_deID` FOREIGN KEY (`deID`) REFERENCES `department` (`deID`),
  CONSTRAINT `FK_joinorgan_stuID` FOREIGN KEY (`stuID`) REFERENCES `member` (`stuID`)
) ENGINE=InnoDB AUTO_INCREMENT=10000005 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of joinorgan
-- ----------------------------
INSERT INTO `joinorgan` VALUES ('10000000', '201320254104', '10101', '助理', '通过');
INSERT INTO `joinorgan` VALUES ('10000001', '201320254102', '10001', '助理', '通过');
INSERT INTO `joinorgan` VALUES ('10000002', '201320254109', '10004', '部长', '已驳回');
INSERT INTO `joinorgan` VALUES ('10000003', '201320254102', '10500', '助理', '审理中');
INSERT INTO `joinorgan` VALUES ('10000004', '201320254101', '10500', '副主席', '审理中');

-- ----------------------------
-- Table structure for `materials`
-- ----------------------------
DROP TABLE IF EXISTS `materials`;
CREATE TABLE `materials` (
  `materID` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `organID` int(3) unsigned NOT NULL,
  `matername` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `nowhave` int(11) unsigned NOT NULL,
  PRIMARY KEY (`materID`),
  KEY `FK_organID` (`organID`),
  CONSTRAINT `FK_organID` FOREIGN KEY (`organID`) REFERENCES `organ` (`organID`)
) ENGINE=InnoDB AUTO_INCREMENT=500023 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of materials
-- ----------------------------
INSERT INTO `materials` VALUES ('500000', '100', '桌子', '20', '20');
INSERT INTO `materials` VALUES ('500001', '100', '帐篷', '20', '20');
INSERT INTO `materials` VALUES ('500002', '100', '椅子', '50', '50');
INSERT INTO `materials` VALUES ('500003', '101', '桌子', '20', '20');
INSERT INTO `materials` VALUES ('500004', '101', '帐篷', '20', '20');
INSERT INTO `materials` VALUES ('500005', '101', '椅子', '50', '50');
INSERT INTO `materials` VALUES ('500006', '102', '桌子', '10', '10');
INSERT INTO `materials` VALUES ('500007', '102', '帐篷', '10', '10');
INSERT INTO `materials` VALUES ('500008', '102', '椅子', '20', '20');
INSERT INTO `materials` VALUES ('500009', '103', '桌子', '5', '5');
INSERT INTO `materials` VALUES ('500010', '103', '帐篷', '5', '5');
INSERT INTO `materials` VALUES ('500011', '103', '椅子', '10', '10');
INSERT INTO `materials` VALUES ('500012', '104', '桌子', '5', '5');
INSERT INTO `materials` VALUES ('500013', '104', '帐篷', '5', '5');
INSERT INTO `materials` VALUES ('500014', '104', '椅子', '10', '10');
INSERT INTO `materials` VALUES ('500015', '105', '桌子', '5', '5');
INSERT INTO `materials` VALUES ('500016', '105', '帐篷', '5', '5');
INSERT INTO `materials` VALUES ('500017', '105', '椅子', '10', '10');
INSERT INTO `materials` VALUES ('500022', '100', '团旗', '2', '2');

-- ----------------------------
-- Table structure for `member`
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `stuID` varchar(12) NOT NULL,
  `stuname` varchar(255) NOT NULL,
  `sex` enum('男','女') NOT NULL DEFAULT '男',
  `telenum` varchar(11) NOT NULL,
  `dome` varchar(8) NOT NULL,
  `classgroup` varchar(8) NOT NULL,
  `PW` varchar(255) NOT NULL,
  PRIMARY KEY (`stuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('201320224301', '林珍', '男', '15486489552', '1284', '2014', 'll');
INSERT INTO `member` VALUES ('201320254101', '陈琳', '女', '15485631574', '1231', '2015', 'chen');
INSERT INTO `member` VALUES ('201320254102', '秦焰', '男', '12345678912', '1234', '2016', 'qin');
INSERT INTO `member` VALUES ('201320254104', '何心蔚', '女', '18825070658', '1314', '2013', 'he');
INSERT INTO `member` VALUES ('201320254109', '王伟', '男', '15489654852', '1546', '2013', '123');

-- ----------------------------
-- Table structure for `organ`
-- ----------------------------
DROP TABLE IF EXISTS `organ`;
CREATE TABLE `organ` (
  `organID` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `organname` varchar(10) NOT NULL,
  `introduction` varchar(100) NOT NULL,
  `PW` varchar(255) NOT NULL,
  PRIMARY KEY (`organID`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of organ
-- ----------------------------
INSERT INTO `organ` VALUES ('100', '校学生团务中心', '团委及其下属沟通的桥梁，主要负责团委的日常事务，负责团委各部门宣传资料采购与保管，负责各部活动经费的报销及配合团委参与学校重要活动的协调，旨在帮助团委学生会各部门提高工作效率。', 'tuanzhong');
INSERT INTO `organ` VALUES ('101', '仲恺学生会', '我校规模最为庞大，历史最为悠久、影响力最为深厚的学生群众性组织。作为我校全体学生的代表，校学生会始终秉承着“团结、务实、进取、服务仲恺人”的宗旨，贯彻着“毋意、毋必、毋固、毋我”的精神', 'xueshenghui');
INSERT INTO `organ` VALUES ('102', '青年志愿者协会', '于1993年成立，是直属于校团委的一个校性组织，也是学校八大组织之一，至今已度过二十一个春夏秋冬。风雨二十一载，青协人用智慧和汗水还有一颗爱人的心浇灌着“青协”这颗幼苗，使之茁壮成长。仲恺农业工程学院', 'qingxie');
INSERT INTO `organ` VALUES ('103', '学生社团联合会', '全面主持全校学生社团的日常工作；负责学生社团的资格审查和登记注册工作；代表各学生社团的利益，对内协调各学生社团之间的关系，加强相互间的交流合作，对外与各兄弟院校学生社团广泛联系；规划学生社团发展与建设', 'shelian');
INSERT INTO `organ` VALUES ('104', '大学生艺术团', '在学校党委领导下，由学校团委直接管理的具有一定艺术专长和兴趣爱好的同学组成的，具有一定层次和特色的全校性学生艺术团体。根据日常工作和演出实际情况不定期聘请相关专业艺术指导老师负责指导、编排和培训等工作', 'yishutuan');
INSERT INTO `organ` VALUES ('105', '红十字学生理事会', '成立于2008年1月1日，于2013年成为仲恺农业工程学院的校级组织。仲恺农业工程学院红十字学生理事会以学生为主体，在校团委老师的指导下，参加的卫生救护社团组织，是仲恺农业工程学院开展精神文明建设，增', 'hongshizi');

-- ----------------------------
-- Table structure for `site`
-- ----------------------------
DROP TABLE IF EXISTS `site`;
CREATE TABLE `site` (
  `siteID` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `sitename` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `nowhave` int(11) NOT NULL,
  PRIMARY KEY (`siteID`)
) ENGINE=InnoDB AUTO_INCREMENT=700006 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of site
-- ----------------------------
INSERT INTO `site` VALUES ('700000', '北区篮球场', '4', '4');
INSERT INTO `site` VALUES ('700001', '南区篮球场', '8', '7');
INSERT INTO `site` VALUES ('700002', '北区羽毛球场', '4', '4');
INSERT INTO `site` VALUES ('700003', '北区足球场', '1', '1');
INSERT INTO `site` VALUES ('700004', '南区网球场', '4', '4');
INSERT INTO `site` VALUES ('700005', '室内运动场', '1', '1');

-- ----------------------------
-- View structure for `举办活动`
-- ----------------------------
DROP VIEW IF EXISTS `举办活动`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `举办活动` AS select `activity`.`actID` AS `actID`,`activity`.`actname` AS `actname`,`activity`.`actgrade` AS `actgrade`,`organ`.`organID` AS `organID`,`organ`.`organname` AS `organname`,`activity`.`joinstartdate` AS `joinstartdate`,`activity`.`joinenddate` AS `joinenddate`,`activity`.`campaignstartdate` AS `campaignstartdate`,`activity`.`campaignenddate` AS `campaignenddate` from (`activity` join `organ`) where (`activity`.`sponsorID` = `organ`.`organID`) ;

-- ----------------------------
-- View structure for `已参加活动`
-- ----------------------------
DROP VIEW IF EXISTS `已参加活动`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `已参加活动` AS select `campaign`.`campaignID` AS `campaignID`,`member`.`stuID` AS `stuID`,`member`.`stuname` AS `stuname`,`activity`.`actID` AS `actID`,`activity`.`actname` AS `actname`,`activity`.`actgrade` AS `actgrade`,`organ`.`organID` AS `organID`,`organ`.`organname` AS `organname`,`activity`.`joinstartdate` AS `joinstartdate`,`activity`.`joinenddate` AS `joinenddate`,`activity`.`campaignstartdate` AS `campaignstartdate`,`activity`.`campaignenddate` AS `campaignenddate` from (((`campaign` join `member`) join `activity`) join `organ`) where ((`campaign`.`actID` = `activity`.`actID`) and (`campaign`.`stuID` = `member`.`stuID`) and (`activity`.`sponsorID` = `organ`.`organID`)) ;

-- ----------------------------
-- View structure for `已申请参加社团信息`
-- ----------------------------
DROP VIEW IF EXISTS `已申请参加社团信息`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `已申请参加社团信息` AS select `joinclub`.`joinID` AS `joinID`,`member`.`stuID` AS `stuID`,`member`.`stuname` AS `stuname`,`joinclub`.`clubID` AS `clubID`,`club`.`clubname` AS `clubname`,`joinclub`.`position` AS `position`,`joinclub`.`state` AS `state` from ((`joinclub` join `member`) join `club`) where ((`joinclub`.`clubID` = `club`.`clubID`) and (`joinclub`.`stuID` = `member`.`stuID`)) ;

-- ----------------------------
-- View structure for `已申请组织信息`
-- ----------------------------
DROP VIEW IF EXISTS `已申请组织信息`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `已申请组织信息` AS select `joinorgan`.`joinID` AS `joinID`,`member`.`stuID` AS `stuID`,`member`.`stuname` AS `stuname`,`organ`.`organID` AS `organID`,`organ`.`organname` AS `organname`,`department`.`deID` AS `deID`,`department`.`dename` AS `dename`,`joinorgan`.`position` AS `position`,`joinorgan`.`state` AS `state` from (((`department` join `joinorgan`) join `organ`) join `member`) where ((`joinorgan`.`deID` = `department`.`deID`) and (`department`.`organID` = `organ`.`organID`) and (`joinorgan`.`stuID` = `member`.`stuID`)) ;

-- ----------------------------
-- View structure for `申请场地`
-- ----------------------------
DROP VIEW IF EXISTS `申请场地`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `申请场地` AS select `booksite`.`bookID` AS `bookID`,`site`.`sitename` AS `sitename`,`booksite`.`borrower` AS `borrower`,`member`.`stuname` AS `stuname`,`booksite`.`number` AS `number`,`booksite`.`borrowdate` AS `borrowdate`,`booksite`.`returndate` AS `returndate`,`booksite`.`state` AS `state` from ((`booksite` join `site`) join `member`) where ((`booksite`.`siteID` = `site`.`siteID`) and (`booksite`.`borrower` = `member`.`stuID`)) ;

-- ----------------------------
-- View structure for `申请物资`
-- ----------------------------
DROP VIEW IF EXISTS `申请物资`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `申请物资` AS select `borrow`.`borrowID` AS `borrowID`,`materials`.`matername` AS `matername`,`materials`.`organID` AS `organID`,`organ`.`organname` AS `organname`,`borrow`.`borrower` AS `borrower`,`member`.`stuname` AS `stuname`,`borrow`.`number` AS `number`,`borrow`.`borrowdate` AS `borrowdate`,`borrow`.`returndate` AS `returndate`,`borrow`.`state` AS `state` from (((`borrow` join `materials`) join `organ`) join `member`) where ((`borrow`.`materID` = `materials`.`materID`) and (`borrow`.`borrower` = `member`.`stuID`) and (`materials`.`organID` = `organ`.`organID`)) ;

-- ----------------------------
-- View structure for `获奖名单`
-- ----------------------------
DROP VIEW IF EXISTS `获奖名单`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `获奖名单` AS select `awards`.`awardsID` AS `awardsID`,`已参加活动`.`actID` AS `actID`,`已参加活动`.`actname` AS `actname`,`已参加活动`.`actgrade` AS `actgrade`,`已参加活动`.`organID` AS `organID`,`已参加活动`.`organname` AS `organname`,`已参加活动`.`stuID` AS `stuID`,`已参加活动`.`stuname` AS `stuname`,`awards`.`awards` AS `awards` from (`awards` join `已参加活动`) where (`awards`.`campaignID` = `已参加活动`.`campaignID`) ;
DROP TRIGGER IF EXISTS `update_site`;
DELIMITER ;;
CREATE TRIGGER `update_site` AFTER UPDATE ON `booksite` FOR EACH ROW BEGIN
IF(NEW.state = '通过')
THEN
UPDATE site SET nowhave = nowhave - (SELECT number FROM booksite WHERE booksite.bookID=NEW.bookID)
WHERE site.siteID = NEW.siteID;
ELSEIF(NEW.state = '已归还')
then
UPDATE site SET nowhave = nowhave + (SELECT number FROM booksite WHERE booksite.bookID=NEW.bookID)
WHERE site.siteID = NEW.siteID;
END IF;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `update_mater`;
DELIMITER ;;
CREATE TRIGGER `update_mater` AFTER UPDATE ON `borrow` FOR EACH ROW BEGIN
IF(NEW.state = '通过')
THEN
UPDATE materials SET nowhave = nowhave - (SELECT number FROM borrow WHERE borrow.borrowID=NEW.borrowID)
WHERE materials.materID = NEW.materID;
ELSEIF(NEW.state = '已归还')
then
UPDATE materials SET nowhave = nowhave + (SELECT number FROM borrow WHERE borrow.borrowID=NEW.borrowID)
WHERE materials.materID = NEW.materID;
END IF;
END
;;
DELIMITER ;
