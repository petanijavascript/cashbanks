/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : ctra_app

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-11-30 10:19:35
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `log_report_email`
-- ----------------------------
DROP TABLE IF EXISTS `log_report_email`;
CREATE TABLE `log_report_email` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `report_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of log_report_email
-- ----------------------------
INSERT INTO log_report_email VALUES ('68', '51', 'cashbank', '83', 'Report August 2016', '2016-08-30 02:37:33', '2016-08-30 02:37:33');
INSERT INTO log_report_email VALUES ('69', '51', 'cashbank', '83', 'Report August 2016', '2016-08-30 02:38:47', '2016-08-30 02:38:47');
INSERT INTO log_report_email VALUES ('70', '51', 'cashbank', '83', 'Report January 2016', '2016-08-30 02:41:12', '2016-08-30 02:41:12');
INSERT INTO log_report_email VALUES ('71', '1', 'escrow', '71', 'Report August 2016', '2016-08-30 02:48:42', '2016-08-30 02:48:42');
INSERT INTO log_report_email VALUES ('72', '1', 'cashbank', '88', 'Report June 2016', '2016-09-13 02:12:18', '2016-09-13 02:12:18');
INSERT INTO log_report_email VALUES ('73', '1', 'cashbank', '88', 'Report June 2016', '2016-09-13 02:14:31', '2016-09-13 02:14:31');
INSERT INTO log_report_email VALUES ('74', '50', 'cashbank', '88', 'Report June 2016', '2016-09-15 05:36:26', '2016-09-15 05:36:26');
INSERT INTO log_report_email VALUES ('75', '50', 'cashbank', '88', 'Report June 2016', '2016-09-15 05:40:22', '2016-09-15 05:40:22');
INSERT INTO log_report_email VALUES ('76', '1', 'cashbank', '71', 'Report September 2016', '2016-09-19 01:14:14', '2016-09-19 01:14:14');
INSERT INTO log_report_email VALUES ('77', '1', 'cashbank', '71', 'Report September 2016', '2016-09-19 01:21:14', '2016-09-19 01:21:14');
INSERT INTO log_report_email VALUES ('78', '1', 'cashbank', '71', 'Report September 2016', '2016-09-19 01:23:03', '2016-09-19 01:23:03');
INSERT INTO log_report_email VALUES ('79', '1', 'cashbank', '71', 'Report September 2016', '2016-09-19 01:23:51', '2016-09-19 01:23:51');
INSERT INTO log_report_email VALUES ('80', '1', 'cashbank', '71', 'Report January 2016', '2016-09-19 01:24:40', '2016-09-19 01:24:40');
INSERT INTO log_report_email VALUES ('81', '1', 'cashbank', '71', 'Report January 2016', '2016-09-19 01:25:08', '2016-09-19 01:25:08');
INSERT INTO log_report_email VALUES ('82', '1', 'cashbank', '71', 'Report September 2016', '2016-09-19 01:26:13', '2016-09-19 01:26:13');
INSERT INTO log_report_email VALUES ('83', '55', 'cashbank', '71', 'Report September 2016', '2016-09-20 03:14:31', '2016-09-20 03:14:31');
INSERT INTO log_report_email VALUES ('84', '55', 'deposit', '71', 'Report September 2016', '2016-09-20 03:16:38', '2016-09-20 03:16:38');
INSERT INTO log_report_email VALUES ('85', '1', 'cashbank', '88', 'Report July 2016', '2016-09-20 04:41:43', '2016-09-20 04:41:43');
INSERT INTO log_report_email VALUES ('86', '1', 'cashbank', '88', 'Report July 2016', '2016-09-20 04:41:43', '2016-09-20 04:41:43');
INSERT INTO log_report_email VALUES ('87', '1', 'cashbank', '71', 'Report June 2016', '2016-09-20 04:42:30', '2016-09-20 04:42:30');
INSERT INTO log_report_email VALUES ('88', '1', 'cashbank', '88', 'Report June 2016', '2016-09-20 04:43:00', '2016-09-20 04:43:00');
INSERT INTO log_report_email VALUES ('89', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 09:43:18', '2016-09-27 09:43:18');
INSERT INTO log_report_email VALUES ('90', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 09:45:00', '2016-09-27 09:45:00');
INSERT INTO log_report_email VALUES ('91', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 09:46:54', '2016-09-27 09:46:54');
INSERT INTO log_report_email VALUES ('92', '50', 'escrow', '88', 'Report January 2016', '2016-09-27 09:47:31', '2016-09-27 09:47:31');
INSERT INTO log_report_email VALUES ('93', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:00:45', '2016-09-27 10:00:45');
INSERT INTO log_report_email VALUES ('94', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:01:12', '2016-09-27 10:01:12');
INSERT INTO log_report_email VALUES ('95', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:01:32', '2016-09-27 10:01:32');
INSERT INTO log_report_email VALUES ('96', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:01:58', '2016-09-27 10:01:58');
INSERT INTO log_report_email VALUES ('97', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:02:34', '2016-09-27 10:02:34');
INSERT INTO log_report_email VALUES ('98', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:03:06', '2016-09-27 10:03:06');
INSERT INTO log_report_email VALUES ('99', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:03:35', '2016-09-27 10:03:35');
INSERT INTO log_report_email VALUES ('100', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:06:20', '2016-09-27 10:06:20');
INSERT INTO log_report_email VALUES ('101', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:09:12', '2016-09-27 10:09:12');
INSERT INTO log_report_email VALUES ('102', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:09:55', '2016-09-27 10:09:55');
INSERT INTO log_report_email VALUES ('103', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:16:39', '2016-09-27 10:16:39');
INSERT INTO log_report_email VALUES ('104', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:16:57', '2016-09-27 10:16:57');
INSERT INTO log_report_email VALUES ('105', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:18:18', '2016-09-27 10:18:18');
INSERT INTO log_report_email VALUES ('106', '50', 'escrow', '88', 'Report September 2016', '2016-09-27 10:19:57', '2016-09-27 10:19:57');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO migrations VALUES ('2016_06_22_082829_create_application_table', '1');
INSERT INTO migrations VALUES ('2016_06_22_083127_create_menu_table', '1');
INSERT INTO migrations VALUES ('2016_06_22_091454_create_menu_project', '1');
INSERT INTO migrations VALUES ('2016_06_22_092001_create_projects_table', '2');
INSERT INTO migrations VALUES ('2016_06_23_061743_create_user_table', '2');
INSERT INTO migrations VALUES ('2016_06_23_061746_create_user_table', '3');
INSERT INTO migrations VALUES ('2016_06_25_143649_create_user_table', '4');
INSERT INTO migrations VALUES ('2016_06_27_030634_create_role_table', '5');
INSERT INTO migrations VALUES ('2016_06_27_083857_create_group_user_table', '6');
INSERT INTO migrations VALUES ('2016_06_22_091454_create_project', '7');
INSERT INTO migrations VALUES ('2016_06_28_030615_create_pt_table', '7');
INSERT INTO migrations VALUES ('2016_06_30_040840_create_bank_table', '8');
INSERT INTO migrations VALUES ('2016_07_15_041842_create_cashbank_table', '9');
INSERT INTO migrations VALUES ('2016_07_15_060744_create_escrow_table', '9');
INSERT INTO migrations VALUES ('2016_07_15_060801_create_deposit_table', '9');
INSERT INTO migrations VALUES ('2016_07_15_073417_create_bank_account_table', '10');
INSERT INTO migrations VALUES ('2016_08_03_075235_create_t_user_projec_table', '11');
INSERT INTO migrations VALUES ('2016_08_10_090152_create_user_privileges_menu_table', '12');
INSERT INTO migrations VALUES ('2016_08_19_080907_create_log_report_email_table', '13');
INSERT INTO migrations VALUES ('2016_08_22_072959_create_items_table', '13');

-- ----------------------------
-- Table structure for `m_application`
-- ----------------------------
DROP TABLE IF EXISTS `m_application`;
CREATE TABLE `m_application` (
  `app_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_application
-- ----------------------------
INSERT INTO m_application VALUES ('1', 'Cash Bank', 'Aplikasi Laporan Cash Bank', 'admin@admin.com', 'admin@admin.com', '0000-00-00 00:00:00', '2016-06-28 08:21:06');
INSERT INTO m_application VALUES ('3', 'Application APA', 'tes aplication', 'admin@admin.com', 'admin@admin.com', '2016-06-28 08:56:08', '2016-08-29 08:44:41');
INSERT INTO m_application VALUES ('4', 'zx', '', 'admin@admin.com', null, '2016-09-15 06:15:28', '2016-09-15 06:15:28');

-- ----------------------------
-- Table structure for `m_bank`
-- ----------------------------
DROP TABLE IF EXISTS `m_bank`;
CREATE TABLE `m_bank` (
  `bank_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_bank
-- ----------------------------
INSERT INTO m_bank VALUES ('4', 'Bank BCA', '', 'admin@admin.com', 'admin@admin.com', '2016-07-15 08:07:25', '2016-08-29 08:49:54');
INSERT INTO m_bank VALUES ('5', 'Bank BRI', '', 'admin@admin.com', null, '2016-07-15 08:07:39', '2016-07-15 08:07:39');
INSERT INTO m_bank VALUES ('6', 'Bank BNI', '', 'admin@admin.com', null, '2016-07-15 08:07:44', '2016-07-15 08:07:44');
INSERT INTO m_bank VALUES ('7', 'Bank Mandiri', '', 'admin@admin.com', null, '2016-07-15 08:07:50', '2016-07-15 08:07:50');
INSERT INTO m_bank VALUES ('8', 'Bank Maybank', '', 'admin@admin.com', null, '2016-07-15 08:07:58', '2016-07-15 08:07:58');
INSERT INTO m_bank VALUES ('10', 'Bank Permata', '', 'admin@admin.com', null, '2016-07-15 08:08:04', '2016-07-15 08:08:04');
INSERT INTO m_bank VALUES ('11', 'Bank BTN', '', 'admin@admin.com', null, '2016-08-23 08:31:18', '2016-08-23 08:31:18');
INSERT INTO m_bank VALUES ('12', 'Bank MNC', '', 'admin@admin.com', null, '2016-08-23 08:32:45', '2016-08-23 08:32:45');
INSERT INTO m_bank VALUES ('13', 'Bank DKI', '', 'admin@admin.com', null, '2016-08-23 08:33:00', '2016-08-23 08:33:00');
INSERT INTO m_bank VALUES ('15', 'Bank Panin', '', 'admin@admin.com', null, '2016-08-23 08:34:48', '2016-08-23 08:34:48');
INSERT INTO m_bank VALUES ('16', 'Bank Niaga', '', 'admin@admin.com', null, '2016-08-23 08:35:00', '2016-08-23 08:35:00');
INSERT INTO m_bank VALUES ('17', 'Bank NISP', '', 'admin@admin.com', null, '2016-08-23 08:35:05', '2016-08-23 08:35:05');
INSERT INTO m_bank VALUES ('18', 'Bank Jabar', '', 'admin@admin.com', null, '2016-08-23 08:35:13', '2016-08-23 08:35:13');
INSERT INTO m_bank VALUES ('19', 'Bank UOB', '', 'admin@admin.com', null, '2016-08-23 08:35:32', '2016-08-23 08:35:32');
INSERT INTO m_bank VALUES ('20', 'Bank Bukopin', '', 'admin@admin.com', null, '2016-08-23 08:35:45', '2016-08-23 08:35:45');
INSERT INTO m_bank VALUES ('21', 'Bank Mayapada', '', 'admin@admin.com', null, '2016-08-23 08:35:58', '2016-08-23 08:35:58');
INSERT INTO m_bank VALUES ('22', 'Bank Victoria', '', 'admin@admin.com', null, '2016-08-23 08:36:05', '2016-08-23 08:36:05');
INSERT INTO m_bank VALUES ('24', 'Bank Nusantara Parahyangan', '', 'admin@admin.com', null, '2016-08-23 08:38:12', '2016-08-23 08:38:12');
INSERT INTO m_bank VALUES ('25', 'Bank Bumiputera', '', 'admin@admin.com', null, '2016-08-23 08:38:24', '2016-08-23 08:38:24');
INSERT INTO m_bank VALUES ('26', 'Bank Danamon', '', 'admin@admin.com', null, '2016-08-23 08:38:45', '2016-08-23 08:38:45');
INSERT INTO m_bank VALUES ('28', 'Bank BNP', '', 'admin@admin.com', 'admin@admin.com', '2016-08-23 08:45:39', '2016-08-23 08:46:07');
INSERT INTO m_bank VALUES ('29', 'Bank Kranggan', '', 'user@citraindah.com', null, '2016-08-25 08:36:10', '2016-08-25 08:36:10');
INSERT INTO m_bank VALUES ('31', 'Kas', '', 'admin@admin.com', null, '2016-09-15 02:47:53', '2016-09-15 02:47:53');
INSERT INTO m_bank VALUES ('32', 'Bank BRI Citra Indah', '', 'admin@admin.com', 'admin@admin.com', '2016-09-15 03:56:39', '2016-09-15 03:58:10');
INSERT INTO m_bank VALUES ('33', 'Bank Jabar Cibinong', '', 'admin@admin.com', null, '2016-09-15 03:57:01', '2016-09-15 03:57:01');
INSERT INTO m_bank VALUES ('34', 'Bank Jabar Jonggol', '', 'admin@admin.com', null, '2016-09-15 03:57:10', '2016-09-15 03:57:10');

-- ----------------------------
-- Table structure for `m_bank_account`
-- ----------------------------
DROP TABLE IF EXISTS `m_bank_account`;
CREATE TABLE `m_bank_account` (
  `bank_account_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bank_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `account_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bank_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_bank_account
-- ----------------------------
INSERT INTO m_bank_account VALUES ('7', '7', '88', '122-00-9905532-2', 'Titi', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:41:43', '2016-08-23 08:41:43');
INSERT INTO m_bank_account VALUES ('8', '4', '88', '198-303-080-1 ', 'Titi', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:42:03', '2016-08-23 08:42:03');
INSERT INTO m_bank_account VALUES ('9', '11', '88', '00122-01-30-000025-3', '', 'cashbank', 'admin@admin.com', 'admin@admin.com', '2016-08-23 08:42:16', '2016-08-23 08:42:21');
INSERT INTO m_bank_account VALUES ('10', '12', '88', '1000-1000000-4612', '', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:42:53', '2016-08-23 08:42:53');
INSERT INTO m_bank_account VALUES ('11', '5', '88', '0000384-01-000014-30-0', '', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:43:10', '2016-08-23 08:43:10');
INSERT INTO m_bank_account VALUES ('12', '13', '88', '201 - 08 - 11277 - 1', '', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:43:22', '2016-08-23 08:43:22');
INSERT INTO m_bank_account VALUES ('13', '6', '88', '00-18312466', '', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:43:35', '2016-08-23 08:43:35');
INSERT INTO m_bank_account VALUES ('14', '15', '88', '140-5012487', '', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:43:50', '2016-08-23 08:43:50');
INSERT INTO m_bank_account VALUES ('15', '8', '88', '2-206-003002', '', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:44:01', '2016-08-23 08:44:01');
INSERT INTO m_bank_account VALUES ('16', '16', '88', '754-01-00039007', '', 'cashbank', 'admin@admin.com', 'admin@admin.com', '2016-08-23 08:44:12', '2016-08-26 04:31:05');
INSERT INTO m_bank_account VALUES ('17', '17', '88', '02-001069083-2', '', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:44:25', '2016-08-23 08:44:25');
INSERT INTO m_bank_account VALUES ('18', '18', '88', '002-5880-420003', 'KPR', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:44:47', '2016-08-23 08:44:47');
INSERT INTO m_bank_account VALUES ('19', '7', '88', '122 - 00 - 0114534 - 4', 'Anita', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:45:04', '2016-08-23 08:45:04');
INSERT INTO m_bank_account VALUES ('20', '4', '88', '198 - 303 - 055 - 0', 'Anita', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:45:23', '2016-08-23 08:45:23');
INSERT INTO m_bank_account VALUES ('21', '28', '88', '070-0-8000020', '', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:46:21', '2016-08-23 08:46:21');
INSERT INTO m_bank_account VALUES ('22', '18', '88', '000-5167-604-001', '', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:46:32', '2016-08-23 08:46:32');
INSERT INTO m_bank_account VALUES ('23', '7', '88', '122- 00-0526336-6', 'Estate', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:46:54', '2016-08-23 08:46:54');
INSERT INTO m_bank_account VALUES ('24', '4', '88', '198- 2383280 ', 'Virtual Account Estate', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:47:14', '2016-08-23 08:47:14');
INSERT INTO m_bank_account VALUES ('25', '4', '88', '198-3208081', 'Estate', 'cashbank', 'admin@admin.com', null, '2016-08-23 08:47:26', '2016-08-23 08:47:26');
INSERT INTO m_bank_account VALUES ('110', '31', '88', '', '', 'cashbank', 'usercitraindah@ciputra.com', null, '2016-09-28 01:36:11', '2016-09-28 01:36:11');
INSERT INTO m_bank_account VALUES ('111', '35', '88', '123', '', 'escrow', 'usercitraindah@ciputra.com', null, '2016-09-28 03:04:07', '2016-09-28 03:04:07');
INSERT INTO m_bank_account VALUES ('112', '8', '88', '234', '', 'escrow', 'usercitraindah@ciputra.com', null, '2016-09-28 03:04:15', '2016-09-28 03:04:15');
INSERT INTO m_bank_account VALUES ('113', '16', '88', '777', '', 'deposit', 'usercitraindah@ciputra.com', null, '2016-09-28 03:04:58', '2016-09-28 03:04:58');
INSERT INTO m_bank_account VALUES ('114', '7', '88', '888', '', 'deposit', 'usercitraindah@ciputra.com', null, '2016-09-28 03:05:06', '2016-09-28 03:05:06');
INSERT INTO m_bank_account VALUES ('115', '13', '88', '56789', '', 'escrow', 'usercitraindah@ciputra.com', null, '2016-09-28 03:11:53', '2016-09-28 03:11:53');
INSERT INTO m_bank_account VALUES ('116', '35', '71', '', '', 'deposit', 'surabaya@ciputra.com', null, '2016-09-28 04:21:46', '2016-09-28 04:21:46');
INSERT INTO m_bank_account VALUES ('117', '4', '71', 'tes 1', '', 'cashbank', 'surabaya@ciputra.com', null, '2016-09-29 01:02:23', '2016-09-29 01:02:23');
INSERT INTO m_bank_account VALUES ('118', '4', '71', 'tes 2', '', 'cashbank', 'surabaya@ciputra.com', null, '2016-09-29 01:02:29', '2016-09-29 01:02:29');
INSERT INTO m_bank_account VALUES ('119', '4', '71', 'tes3', '', 'cashbank', 'surabaya@ciputra.com', null, '2016-09-29 01:16:11', '2016-09-29 01:16:11');
INSERT INTO m_bank_account VALUES ('120', '4', '71', 'asd', '', 'escrow', 'surabaya@ciputra.com', null, '2016-09-29 07:59:26', '2016-09-29 07:59:26');

-- ----------------------------
-- Table structure for `m_group_user`
-- ----------------------------
DROP TABLE IF EXISTS `m_group_user`;
CREATE TABLE `m_group_user` (
  `group_user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `is_active_record` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`group_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_group_user
-- ----------------------------
INSERT INTO m_group_user VALUES ('1', 'ADMIN', 'Administrasi', '1', '1', '1', '', 'admin@admin.com', null, '2016-08-22 01:32:52');
INSERT INTO m_group_user VALUES ('2', 'GM', 'General Manager', null, null, '1', '', '', null, null);
INSERT INTO m_group_user VALUES ('3', 'STAFF', 'Staff', null, null, '1', '', 'admin@admin.com', null, '2016-06-28 08:00:07');
INSERT INTO m_group_user VALUES ('4', 'DIR', 'Direksi', null, null, '1', '', '', null, null);
INSERT INTO m_group_user VALUES ('5', 'HR', 'Human Resource ', null, null, '1', 'admin@admin.com', null, '2016-07-29 03:20:49', '2016-07-29 03:20:49');
INSERT INTO m_group_user VALUES ('6', 'FC', 'Financial Controller', null, null, '1', 'admin@admin.com', null, '2016-08-23 07:41:27', '2016-08-23 07:41:27');

-- ----------------------------
-- Table structure for `m_menu`
-- ----------------------------
DROP TABLE IF EXISTS `m_menu`;
CREATE TABLE `m_menu` (
  `menu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_menu_id` int(11) DEFAULT NULL,
  `child_no` int(11) DEFAULT NULL,
  `app_id` int(11) NOT NULL,
  `link_to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_menu
-- ----------------------------
INSERT INTO m_menu VALUES ('0', 'Master Data', null, null, '0', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_menu VALUES ('1', 'User', '0', '1', '0', 'user', 'icon-user', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_menu VALUES ('3', 'Group User', '0', '2', '0', 'groupuser', 'icon-users', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_menu VALUES ('4', 'Project', '0', '3', '0', 'project', 'icon-globe', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_menu VALUES ('6', 'Menu', '0', '5', '0', 'menu', 'icon-notebook', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_menu VALUES ('7', 'Application', '0', '6', '0', 'application', 'icon-rocket', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_menu VALUES ('8', 'User Privileges', '0', '9', '0', 'userprivileges', 'icon-user', 'admin@admin.com', null, '2016-08-10 09:35:48', '2016-08-10 09:35:48');
INSERT INTO m_menu VALUES ('9', 'Cash & Bank', null, null, '1', 'cashbank', 'icon-calculator', '', 'admin@admin.com', '0000-00-00 00:00:00', '2016-07-15 07:23:17');
INSERT INTO m_menu VALUES ('10', 'Tr Cash And Bank', '9', '1', '1', 'cashbank', 'icon-rocket', '', 'admin@admin.com', '0000-00-00 00:00:00', '2016-07-09 09:08:58');
INSERT INTO m_menu VALUES ('11', 'Tr Deposit', '9', '2', '1', 'deposit', 'icon-rocket', '', 'admin@admin.com', '0000-00-00 00:00:00', '2016-07-09 09:09:36');
INSERT INTO m_menu VALUES ('12', 'Tr Escrow', '9', '3', '1', 'escrow', 'icon-rocket', 'admin@admin.com', 'admin@admin.com', '2016-06-28 09:11:59', '2016-07-09 09:09:57');
INSERT INTO m_menu VALUES ('13', 'Application ABCD', null, null, '3', 'qweqwe', 'icon-map', 'admin@admin.com', 'admin@admin.com', '2016-06-28 09:17:12', '2016-08-18 04:17:43');
INSERT INTO m_menu VALUES ('14', 'tes child menu', '13', '1', '3', 'asdasd', 'asdasd', 'admin@admin.com', 'admin@admin.com', '2016-06-28 09:21:13', '2016-09-15 06:29:46');
INSERT INTO m_menu VALUES ('15', 'Bank', '0', '7', '1', 'bank', 'icon-wallet', 'admin@admin.com', 'admin@admin.com', '2016-06-30 04:24:10', '2016-07-29 04:24:47');
INSERT INTO m_menu VALUES ('16', 'Bank Account', '0', '8', '1', 'bankaccount', 'icon-doc', 'admin@admin.com', null, '2016-07-15 07:43:32', '2016-07-15 07:43:32');
INSERT INTO m_menu VALUES ('19', 'Log Report Email', '9', '4', '1', 'logreportcashbank', 'icon-rocket', 'admin@admin.com', 'admin@admin.com', '2016-08-22 08:19:57', '2016-08-22 08:29:41');

-- ----------------------------
-- Table structure for `m_project`
-- ----------------------------
DROP TABLE IF EXISTS `m_project`;
CREATE TABLE `m_project` (
  `project_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pt_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `project_location_group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_project
-- ----------------------------
INSERT INTO m_project VALUES ('1', 'R01', 'PT. SINAR BAHANA MULYA', 'CITRAGRAN CIBUBUR', 'Jl.Gatot Subroto no.14, Jakarta ', 'Jakarta', null, 'admin@admin.com', '0000-00-00 00:00:00', '2016-08-06 12:42:04');
INSERT INTO m_project VALUES ('2', null, 'PT. SBM - PURI BRASALI JO', 'CITRAGRAN CIBUBUR', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('35', null, 'KONSOLIDASI SBM', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('36', '', 'PT. CHIKA', '', '', '', null, 'admin@admin.com', '0000-00-00 00:00:00', '2016-10-21 02:04:06');
INSERT INTO m_project VALUES ('38', null, 'PT. CIPTAULUNG ARTAJAYA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('39', null, 'PT. TUMBUH SEMANGAT NIAGA CMRL', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('40', null, 'PT. MAL CITRA GRAND', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('41', null, 'PT. ASENDABANGUN PERSADA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('42', null, 'PT. MAKMUR KARYA PERSADA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('43', null, 'PT. PATAL INDOMAHON', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('45', null, 'PT. CIPTA ASTAKA SURYA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('46', null, 'PT. SBM - PURI BRASALI', 'CITRAGRAN CIBUBUR', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('47', null, 'PT. MITRA MAKMUR BAGYA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('48', null, 'ESTATE BIZPARK 1 (PT.MKP)', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('49', null, 'ESTATE BIZPARK 2 (PT.PIM)', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('50', null, 'PT. CITRA GRAND KHATULISTIWA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('51', null, 'PT. PANASIA GRIYA MEKARASRI', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('52', null, 'KONSOLIDASI SBM', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('53', null, 'PT. CHIKA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('55', null, 'PT. CIPTAULUNG ARTAJAYA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('56', null, 'PT. TUMBUH SEMANGAT NIAGA CMRL', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('57', null, 'PT. MAL CITRA GRAND', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('58', null, 'PT. ASENDABANGUN PERSADA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('59', null, 'PT. MAKMUR KARYA PERSADA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('60', null, 'PT.PATAL INDOMAHON', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('61', null, 'PT SBM - PURI BRASALI JO', 'CITRAGRAN CIBUBUR', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('62', null, 'PT. CIPTA ASTAKA SURYA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('63', null, 'PT. SBM - PURI BRASALI', 'CITRAGRAN CIBUBUR', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('64', null, 'PT. MITRA MAKMUR BAGYA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('65', null, 'ESTATE BIZPARK 1 (PT.MKP)', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('66', null, 'ESTATE BIZPARK 2 (PT.PIM)', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('67', null, 'PT. CITRA GRAND KHATULISTIWA', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('68', null, 'PT. PANASIA GRIYA MEKARASRI', '', null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO m_project VALUES ('69', 'R22', 'PT ABC', 'bandung', 'bandung', 'bandung', 'admin@admin.com', null, '2016-08-09 03:33:01', '2016-08-09 03:33:01');
INSERT INTO m_project VALUES ('70', 'R23', 'PT ABC', 'surabaya', 'surabaya', 'surabaya', 'admin@admin.com', null, '2016-08-09 03:33:18', '2016-08-09 03:33:18');
INSERT INTO m_project VALUES ('71', '', 'Ciputra World Surabaya', 'Ciputra World Surabaya', 'Surabaya', 'Surabaya', 'admin@admin.com', null, '2016-08-23 07:48:38', '2016-08-23 07:48:38');
INSERT INTO m_project VALUES ('72', '', 'Citra Harmoni Sidoarjo', 'Citra Harmoni Sidoarjo', 'Sidoarjo', 'Sidoarjo', 'admin@admin.com', null, '2016-08-23 07:52:29', '2016-08-23 07:52:29');
INSERT INTO m_project VALUES ('73', '', 'Citra Indah Jonggol', 'Citra Indah Jonggol', 'Jonggol', 'Jakarta', 'admin@admin.com', null, '2016-08-23 07:54:46', '2016-08-23 07:54:46');
INSERT INTO m_project VALUES ('74', '', 'Citra Garden Pekan Baru', 'Citra Garden Pekan Baru', 'Pekan Baru', 'Riau', 'admin@admin.com', null, '2016-08-23 07:56:25', '2016-08-23 07:56:25');
INSERT INTO m_project VALUES ('75', '', 'Citra Grand Semarang', 'Citra Grand Semarang', 'Semarang', 'Jawa Tengah', 'admin@admin.com', null, '2016-08-23 07:58:31', '2016-08-23 07:58:31');
INSERT INTO m_project VALUES ('76', '', 'Citra Land Ambon', 'Citra Land Ambon', 'Ambon', 'Ambon', 'admin@admin.com', null, '2016-08-23 08:00:58', '2016-08-23 08:00:58');
INSERT INTO m_project VALUES ('77', '', 'Citra Land Bagya City Medan', 'Citra Land Bagya City Medan', 'Medan', 'Medan', 'admin@admin.com', null, '2016-08-23 08:02:03', '2016-08-23 08:02:03');
INSERT INTO m_project VALUES ('78', '', 'Citra Land Denpasar', 'Citra Land Denpasar', 'Bali', 'Bali', 'admin@admin.com', null, '2016-08-23 08:03:16', '2016-08-23 08:03:16');
INSERT INTO m_project VALUES ('79', '', 'Citra Land Kendari', 'Citra Land Kendari', 'Kendari', 'Kendari', 'admin@admin.com', null, '2016-08-23 08:04:35', '2016-08-23 08:04:35');
INSERT INTO m_project VALUES ('80', '', 'Citra Land Manado', 'Citra Land Manado', 'Manado', 'Manado', 'admin@admin.com', null, '2016-08-23 08:05:49', '2016-08-23 08:05:49');
INSERT INTO m_project VALUES ('81', '', 'Citra Land Pekan baru', 'Citra Land Pekan Baru', 'Pekan Baru', 'Pekan Baru', 'admin@admin.com', null, '2016-08-23 08:07:35', '2016-08-23 08:07:35');
INSERT INTO m_project VALUES ('82', '', 'CitraSun Garden Yogya', 'CitraSun Garden Yogya', 'Yogya', 'Yogya', 'admin@admin.com', null, '2016-08-23 08:09:24', '2016-08-23 08:09:24');
INSERT INTO m_project VALUES ('83', '', 'Kantor Pusat', 'Kantor Pusat', 'Jakarta', 'Jakarta', 'admin@admin.com', null, '2016-08-23 08:11:35', '2016-08-23 08:11:35');
INSERT INTO m_project VALUES ('84', '', 'Mall Ciputra Seraya Pekan Baru', 'Mall Ciputra Seraya Pekan Baru', 'Pekan Baru', 'Riau', 'admin@admin.com', null, '2016-08-23 08:13:22', '2016-08-23 08:13:22');
INSERT INTO m_project VALUES ('85', '', 'Mall Ciputra World Surabaya', 'Mall Ciputra World Surabaya', 'Surabaya', 'Surabaya', 'admin@admin.com', null, '2016-08-23 08:15:08', '2016-08-23 08:15:08');
INSERT INTO m_project VALUES ('86', '', 'Patmase', 'Patmase', 'Patmase', 'Patmase', 'admin@admin.com', null, '2016-08-23 08:17:36', '2016-08-23 08:17:36');
INSERT INTO m_project VALUES ('87', '', 'The Taman Dayu', 'The Taman Dayu', 'Surabaya', 'Surabaya', 'admin@admin.com', null, '2016-08-23 08:18:54', '2016-08-23 08:18:54');
INSERT INTO m_project VALUES ('88', '', 'Citra Indah', 'Citra Indah', 'Jakarta', 'Jakarta', 'admin@admin.com', null, '2016-08-23 08:39:51', '2016-08-23 08:39:51');

-- ----------------------------
-- Table structure for `m_user`
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_user_id` int(11) NOT NULL,
  `is_active_record` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO m_user VALUES ('1', 'admin', '$2y$10$66243mD/9h8AXXXu2sAveOBi8nszB3genhljVqtmwpOWoIYxXCbIu', 'super', 'admin super', 'admin@admin.com', '1', '1', 'ikFHuXocIjbssmopyyB0fYqBTMa4TPKq8r08YgH4bpxH1P0CrNcu0VdcpPLE', 'admin2@admin.com', 'admin@admin.com', '2016-06-25 14:38:47', '2016-10-27 08:15:13');
INSERT INTO m_user VALUES ('29', 'user', '$2y$10$cp26//j/hYTfFajxEJW.CeJe21ABcD3LTb7b/.9BUxP1XPD07m6aK', 'user tes', 'tes', 'user@user.com', '2', '1', 'sI2ov80MFRPCSqRIGqE0DjoqYqdjkkVHcY3xjxs7YWdgRZN2hFvYFSdmUjbT', 'admin@admin.com', 'admin@admin.com', '2016-08-08 06:54:33', '2016-08-23 08:48:57');
INSERT INTO m_user VALUES ('31', 'tinalwie', '$2y$10$Vz9cgPzi7rSFCGhjxrW3uOFoFmRxjrehmFd9ToUfxBo2BecKwsw0q', 'Titinawati', '', 'titinawati@ciputra.com', '6', '1', '', 'admin@admin.com', null, '2016-08-23 07:51:14', '2016-08-23 07:51:14');
INSERT INTO m_user VALUES ('32', 'yayuk68', '$2y$10$7..ljZjdtNNB9MIikjW.j.XC/HUoHVQmKnZnC3eDmuvTDwAb5XgUy', 'Yayuk', 'Sriatin', 'yayuk.sriatin@ciputra.co.id', '6', '1', '', 'admin@admin.com', null, '2016-08-23 07:53:54', '2016-08-23 07:53:54');
INSERT INTO m_user VALUES ('33', 'susierbadianti', '$2y$10$bi00vDh3OIxbyBm6YBIuPex56Oth03fba6Ekzo2Me/ryz69z3Jwza', 'Susi', 'Erbadianti', 'susi.erbadianti@ciputra.com', '6', '1', '', 'admin@admin.com', null, '2016-08-23 07:55:38', '2016-08-23 07:55:38');
INSERT INTO m_user VALUES ('34', 'regin_sinaga', '$2y$10$CroEyGteMMosqa7gTp./7OQWlvnvA6Yx185hQp1u12TAopC.k7bkq', 'Regina', 'Sinaga', 'regina_sinaga@ciputra.co.id', '6', '1', '', 'admin@admin.com', null, '2016-08-23 07:57:32', '2016-08-23 07:57:32');
INSERT INTO m_user VALUES ('35', 'lucks_889', '$2y$10$s/kDB85RJcqm.oqrA6knwulhL49DOhsR4RnRNI0sLwu9yPQ75piDO', 'Upita', 'Widiansi', 'upita.widiansi@ciputra.co.id', '6', '1', '', 'admin@admin.com', null, '2016-08-23 07:59:36', '2016-08-23 07:59:36');
INSERT INTO m_user VALUES ('36', 'yadi_pratama', '$2y$10$86h3E9zCrgdhRjGt7d9Hx.3Deeq1asPE4Ul5lfTlBmXkZRr6Sn6uq', 'Yadi', 'Pratama', 'yadi.pratama@ciputra.co.id', '6', '1', '9xLGeguK0Zt08MbcsjqGqp0FEZh0EarWSI8nioQbrFmReyWegNpAKcppXMM2', 'admin@admin.com', null, '2016-08-23 08:01:31', '2016-08-24 01:47:01');
INSERT INTO m_user VALUES ('37', 'sufia_rinda', '$2y$10$22UC4ssnC2T15lSoARsgWe1DHc/7rjKpFCocXD1laR0D8g45saQpe', 'Sufia', 'Rinda', 'sufia.rinda@ciputra.com', '6', '1', '', 'admin@admin.com', null, '2016-08-23 08:02:52', '2016-08-23 08:02:52');
INSERT INTO m_user VALUES ('38', 'tuti_handayani', '$2y$10$V9xTrUpi.L3dzMXGaNQy7uNvrF3/VSaIIlQ4qJ7SIRRCxmi2eXtWq', 'Tuti', 'Handayani', 'tuti.handayani@ciputra.com', '6', '1', '', 'admin@admin.com', null, '2016-08-23 08:04:09', '2016-08-23 08:04:09');
INSERT INTO m_user VALUES ('39', 'andri.yunianto', '$2y$10$wroLn/juobsX8Ildxh78XuF45QUKuVLohqFQ9R6zj/T44m1tw.zai', 'Andri', 'Yunianto', 'andri.yunianto@ciputra.com', '6', '1', '', 'admin@admin.com', null, '2016-08-23 08:05:22', '2016-08-23 08:05:22');
INSERT INTO m_user VALUES ('40', 'meigy_robot', '$2y$10$nOCR06aAfUtjiAiDgClfV.dUT8xxgnwkUJEitGrNF.wgXj8wBUxY6', 'Meigy', 'Robot', 'meigy.meike@ciputra.co.id', '6', '1', '', 'admin@admin.com', null, '2016-08-23 08:06:42', '2016-08-23 08:06:42');
INSERT INTO m_user VALUES ('41', 'weini_tandiyanti', '$2y$10$BsZvxcn0iF8unlQd.sm9feLt1p/n5pS9.pGXUo0FXmZwajk8ZiW.C', 'Weini', 'Tandiyanti', 'weini.tandiyanti@ciputra.com', '6', '1', '', 'admin@admin.com', null, '2016-08-23 08:08:29', '2016-08-23 08:08:29');
INSERT INTO m_user VALUES ('42', 'rina_christianti', '$2y$10$5ddAHuN/WfoGGYZITOanLu8KLVa0m3tzX1RKIhWQs3uC00ljBJ5Re', 'Rina', 'Christianti', 'rina.christianti@ciputra.co.id', '6', '1', '', 'admin@admin.com', null, '2016-08-23 08:11:02', '2016-08-23 08:11:02');
INSERT INTO m_user VALUES ('43', 'ijul_siregar', '$2y$10$twMcngs8BO0VwXjaNV7Pn.Gf1AGp.BQgDDVwN6iXN2wM63vU6IadC', 'Ijul', 'Siregar', 'ijul.siregar@ciputra.co.id', '6', '1', '', 'admin@admin.com', null, '2016-08-23 08:12:20', '2016-08-23 08:12:20');
INSERT INTO m_user VALUES ('44', 'andi_gunawan', '$2y$10$K9UluDWxJOtXASJNtE4oquAnx5ZbyhKsE7JeF4Uh.g44ghqcjWkBe', 'Andi', 'Gunawan', 'andig@malciputraseraya.com', '6', '1', '', 'admin@admin.com', 'admin@admin.com', '2016-08-23 08:14:42', '2016-08-29 08:13:42');
INSERT INTO m_user VALUES ('45', 'iswandono', '$2y$10$66.5F7KCX6mXEtiCjOlh0.jPmjximgji/SOL0STuEc1IbEesIyemi', 'Iswandono', '', 'iswandono@ciputra.com', '6', '1', '', 'admin@admin.com', null, '2016-08-23 08:15:44', '2016-08-23 08:15:44');
INSERT INTO m_user VALUES ('46', 'sony_irawan', '$2y$10$O0PuTlYtd7ja2XnEaGpXxe4nWQ/kq9N31HLZcMKomZEAhC.TMYWKq', 'Sony', 'Irawan', 'sony.irawan@ciputra.co.id', '6', '1', '', 'admin@admin.com', 'admin@admin.com', '2016-08-23 08:16:22', '2016-08-29 08:54:21');
INSERT INTO m_user VALUES ('47', 'wilis', '$2y$10$5qhPeHgmzGBB87qVU9Ker.6ZWCSs.w6vaxhqlKZQ5mc0NTUimjWJK', 'Wilis', '', 'wilis.devi@ciputra.com', '6', '1', '', 'admin@admin.com', 'admin@admin.com', '2016-08-23 08:17:06', '2016-08-29 08:54:27');
INSERT INTO m_user VALUES ('48', 'ananda_krismawan', '$2y$10$jhJQa2JUadk83DxAqRCkyOfO6EGMDDTWPxzFmda7PV1Ei2HhP2JIm', 'Ananda', 'Krismawan', 'ananda.krismawan@ciputra.co.id', '6', '1', '', 'admin@admin.com', 'admin@admin.com', '2016-08-23 08:19:33', '2016-08-29 08:58:02');
INSERT INTO m_user VALUES ('49', 'yuyun', '$2y$10$nfC3O9HLTtx1syBWhppo9uhgLcO1i.1nNsH40P6vzN.EeUmOsFo12', 'Yuyun', 'Perwitasari', 'yuyun.perwitasari@ciputra.com', '6', '1', '', 'admin@admin.com', 'admin@admin.com', '2016-08-23 08:20:11', '2016-08-29 08:57:07');
INSERT INTO m_user VALUES ('50', 'usercitraindah', '$2y$10$eXT9cx5538StSloPYmvqredOYi8qOzuH1Srt.16fQjSZcnH1c5k.C', 'user', 'citraindah tes', 'usercitraindah@ciputra.com', '6', '1', '4f5jWxKv9I7m3mLE9rr4Qdo0iGpJBcYA2HHm4Mkf5TQ1YY7YwVXQsiDXrY3T', 'admin@admin.com', 'admin@admin.com', '2016-08-23 08:50:17', '2016-10-27 08:16:13');
INSERT INTO m_user VALUES ('51', 'jimmy', '$2y$10$viCL3XpD5G6cdzGEW/JOp.BYCmyzThry4qaoV4dSBG.6nxsCVMeOG', 'Jimmy', 'Sulistio', 'jimmy@ciputra.com', '6', '1', '3glApQyUiMLNsb5mmusXxytN0BrXp9fUz3DOFBxClUi47iJCLY2IJeDnSRMR', 'admin@admin.com', null, '2016-08-25 04:32:22', '2016-08-30 02:42:16');
INSERT INTO m_user VALUES ('52', 'adminciputra', '$2y$10$SmpjrZdZTBDxNLD5o0tUluWM6kEpgdDotr0fbArNCctqZ38.bMMdC', 'admin', 'admin', 'admin@ciputra.com', '1', '1', '9ZvhzQBXls9uUYLIrSDbMBG9KeJE9qPdco2lnlB1FowoaCyyiO9dqKDmDJsi', 'admin@admin.com', null, '2016-08-26 01:10:23', '2016-08-26 02:15:54');
INSERT INTO m_user VALUES ('54', 'fc', '$2y$10$BCqRGEMzkBtKogirmmHWoO1i5uX0RlEirM1gqBngiOKl68NnWuYFe', 'fc ', 'test', 'fc@ciputra.co.id', '6', '1', 'nqrBIhcxNU7IAF60AhsUTy268UtejCBXfvdteOOGOBNselWx9XTVzq0eaPLq', 'admin@admin.com', null, '2016-09-15 06:34:17', '2016-09-15 07:03:09');
INSERT INTO m_user VALUES ('55', 'tes', '$2y$10$soHa5pOLzrG761lNpCpu5e3RaptCmLofIoYuiDEGhkUCVbW/DzPVe', 'user', 'surabaya', 'surabaya@ciputra.com', '6', '1', 'E6UUpLdzqEtJJA3dy3FG6xkUApkapbz49SBj2J36EIJbCcQNs3HRRAB4QrxG', 'admin@admin.com', null, '2016-09-20 01:04:26', '2016-09-30 08:30:32');

-- ----------------------------
-- Table structure for `m_user_privileges`
-- ----------------------------
DROP TABLE IF EXISTS `m_user_privileges`;
CREATE TABLE `m_user_privileges` (
  `user_privileges_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `group_user_id` int(11) NOT NULL,
  `view_data` tinyint(1) NOT NULL DEFAULT '1',
  `crud_access` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_privileges_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of m_user_privileges
-- ----------------------------
INSERT INTO m_user_privileges VALUES ('1', '0', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('2', '1', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('3', '3', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('4', '4', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('5', '6', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('6', '7', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('7', '8', '1', '1', '1', 'admin@admin.com', 'admin@admin.com', null, '2016-08-10 10:19:02');
INSERT INTO m_user_privileges VALUES ('8', '9', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('9', '10', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('10', '11', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('11', '12', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('12', '13', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('13', '14', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('14', '15', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('15', '16', '1', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('16', '17', '2', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('17', '18', '2', '1', '1', 'admin@admin.com', null, null, null);
INSERT INTO m_user_privileges VALUES ('18', '19', '1', '1', '1', 'admin@admin.com', null, '2016-08-22 08:20:33', '2016-08-22 08:20:33');
INSERT INTO m_user_privileges VALUES ('19', '16', '2', '1', '1', 'admin@admin.com', null, '2016-08-23 05:58:07', '2016-08-23 05:58:07');
INSERT INTO m_user_privileges VALUES ('20', '11', '2', '1', '1', 'admin@admin.com', null, '2016-08-23 05:59:43', '2016-08-23 05:59:43');
INSERT INTO m_user_privileges VALUES ('21', '12', '2', '1', '1', 'admin@admin.com', null, '2016-08-23 05:59:49', '2016-08-23 05:59:49');
INSERT INTO m_user_privileges VALUES ('23', '10', '2', '1', '1', 'admin@admin.com', null, '2016-08-23 06:18:16', '2016-08-23 06:18:16');
INSERT INTO m_user_privileges VALUES ('24', '9', '2', '1', '1', 'admin@admin.com', null, '2016-08-23 06:19:26', '2016-08-23 06:19:26');
INSERT INTO m_user_privileges VALUES ('25', '0', '6', '1', '1', 'admin@admin.com', null, '2016-08-23 08:22:17', '2016-08-23 08:22:17');
INSERT INTO m_user_privileges VALUES ('26', '16', '6', '1', '1', 'admin@admin.com', null, '2016-08-23 08:22:27', '2016-08-23 08:22:27');
INSERT INTO m_user_privileges VALUES ('27', '9', '6', '1', '1', 'admin@admin.com', null, '2016-08-23 08:22:43', '2016-08-23 08:22:43');
INSERT INTO m_user_privileges VALUES ('28', '10', '6', '1', '1', 'admin@admin.com', null, '2016-08-23 08:22:48', '2016-08-23 08:22:48');
INSERT INTO m_user_privileges VALUES ('29', '11', '6', '1', '1', 'admin@admin.com', null, '2016-08-23 08:22:54', '2016-08-23 08:22:54');
INSERT INTO m_user_privileges VALUES ('30', '12', '6', '1', '1', 'admin@admin.com', null, '2016-08-23 08:22:58', '2016-08-23 08:22:58');
INSERT INTO m_user_privileges VALUES ('31', '15', '6', '1', '1', 'admin@admin.com', null, '2016-08-25 08:35:50', '2016-08-25 08:35:50');

-- ----------------------------
-- Table structure for `tes`
-- ----------------------------
DROP TABLE IF EXISTS `tes`;
CREATE TABLE `tes` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tes
-- ----------------------------

-- ----------------------------
-- Table structure for `t_cashbank`
-- ----------------------------
DROP TABLE IF EXISTS `t_cashbank`;
CREATE TABLE `t_cashbank` (
  `cashbank_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `bank_account_id` int(11) NOT NULL,
  `in` decimal(20,2) DEFAULT '0.00',
  `out` decimal(20,2) DEFAULT '0.00',
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cashbank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=337 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_cashbank
-- ----------------------------
INSERT INTO t_cashbank VALUES ('24', '1', '2', '100000.00', '0.00', '2016', '7', '1', 'admin@admin.com', 'admin@admin.com', '2016-07-20 10:10:48', '2016-07-29 03:11:32', 'cash_in');
INSERT INTO t_cashbank VALUES ('30', '1', '2', '5000000.00', '0.00', '2016', '7', '2', 'admin@admin.com', 'admin@admin.com', '2016-07-20 10:35:33', '2016-07-29 03:11:17', 'cash_in');
INSERT INTO t_cashbank VALUES ('31', '1', '2', '0.00', '500000.00', '2016', '7', '3', 'admin@admin.com', 'admin@admin.com', '2016-07-20 10:35:51', '2016-07-29 03:11:52', 'cash_in');
INSERT INTO t_cashbank VALUES ('37', '1', '5', '8000000.00', '100000.00', '2016', '5', '1', 'admin@admin.com', 'admin@admin.com', '2016-07-29 08:38:06', '2016-08-09 01:13:37', 'cash_in');
INSERT INTO t_cashbank VALUES ('39', '1', '5', '0.00', '100000.00', '2016', '5', '3', 'admin@admin.com', 'admin@admin.com', '2016-07-29 10:02:57', '2016-07-29 10:03:08', 'cash_out');
INSERT INTO t_cashbank VALUES ('40', '1', '5', '100.00', '0.00', '2016', '4', '1', 'admin@admin.com', null, '2016-07-29 10:03:49', '2016-07-29 10:03:49', 'cash_in');
INSERT INTO t_cashbank VALUES ('41', '1', '3', '10000000.00', '0.00', '2016', '4', '1', 'admin@admin.com', null, '2016-07-29 10:05:05', '2016-07-29 10:05:05', 'cash_in');
INSERT INTO t_cashbank VALUES ('42', '1', '3', '10000000.00', '0.00', '2016', '8', '1', 'admin@admin.com', 'admin@admin.com', '2016-07-29 10:05:15', '2016-08-01 04:15:30', 'cash_in');
INSERT INTO t_cashbank VALUES ('46', '1', '3', '5000000.00', '0.00', '2016', '8', '2', 'admin@admin.com', null, '2016-08-01 04:27:59', '2016-08-01 04:27:59', 'cash_in');
INSERT INTO t_cashbank VALUES ('47', '1', '3', '1000000.00', '0.00', '2016', '3', '1', 'admin@admin.com', null, '2016-08-01 04:28:51', '2016-08-01 04:28:51', 'cash_in');
INSERT INTO t_cashbank VALUES ('48', '1', '3', '10000000.00', '3000000.00', '2016', '8', '3', 'admin@admin.com', 'admin@admin.com', '2016-08-01 07:14:38', '2016-08-15 10:03:32', 'cash_out');
INSERT INTO t_cashbank VALUES ('49', '1', '5', '10000000.00', '0.00', '2016', '8', '2', 'admin@admin.com', 'admin@admin.com', '2016-08-08 05:59:17', '2016-08-08 05:59:45', 'cash_in');
INSERT INTO t_cashbank VALUES ('50', '40', '2', '4000000.00', '0.00', '2016', '8', '1', 'admin@admin.com', 'admin@admin.com', '2016-08-08 07:17:07', '2016-08-09 03:36:55', 'cash_in');
INSERT INTO t_cashbank VALUES ('53', '40', '2', '3000000.00', '0.00', '2016', '8', '2', 'admin@admin.com', 'admin@admin.com', '2016-08-08 07:19:58', '2016-08-08 08:23:59', 'cash_in');
INSERT INTO t_cashbank VALUES ('55', '40', '2', '5000000.00', '0.00', '2016', '8', '3', 'admin@admin.com', null, '2016-08-08 08:22:52', '2016-08-08 08:22:52', 'cash_in');
INSERT INTO t_cashbank VALUES ('56', '40', '1', '456456.00', '0.00', '2016', '8', '1', 'admin@admin.com', null, '2016-08-09 03:34:53', '2016-08-09 03:34:53', 'cash_in');
INSERT INTO t_cashbank VALUES ('57', '1', '2', '1000000.00', '0.00', '2014', '2', '1', 'admin@admin.com', null, '2016-08-18 03:06:02', '2016-08-18 03:06:02', 'cash_in');
INSERT INTO t_cashbank VALUES ('93', '88', '7', '3209660173.00', '2569186246.00', '2016', '6', '2', 'user@citraindah.com', 'user@citraindah.com', '2016-08-24 03:37:32', '2016-08-24 03:38:06', 'cash_in');
INSERT INTO t_cashbank VALUES ('94', '88', '7', '5125835919.00', '6472782647.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 03:38:41', '2016-08-24 03:38:41', 'cash_in');
INSERT INTO t_cashbank VALUES ('95', '88', '8', '6060443755.00', '8760384596.00', '2016', '6', '2', 'user@citraindah.com', null, '2016-08-24 04:07:21', '2016-08-24 04:07:21', 'cash_in');
INSERT INTO t_cashbank VALUES ('96', '88', '8', '10905066912.00', '12061140624.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 04:07:51', '2016-08-24 04:07:51', 'cash_in');
INSERT INTO t_cashbank VALUES ('97', '88', '11', '184875576.00', '5656765.00', '2016', '6', '2', 'user@citraindah.com', null, '2016-08-24 07:22:04', '2016-08-24 07:22:04', 'cash_in');
INSERT INTO t_cashbank VALUES ('98', '88', '15', '1214337689.00', '1116196197.00', '2016', '6', '2', 'user@citraindah.com', null, '2016-08-24 07:22:27', '2016-08-24 07:22:27', 'cash_in');
INSERT INTO t_cashbank VALUES ('99', '88', '16', '2418433493.00', '4000030000.00', '2016', '6', '2', 'user@citraindah.com', null, '2016-08-24 07:22:50', '2016-08-24 07:22:50', 'cash_in');
INSERT INTO t_cashbank VALUES ('100', '88', '19', '28133157597.00', '25145463156.00', '2016', '6', '2', 'user@citraindah.com', null, '2016-08-24 07:23:46', '2016-08-24 07:23:46', 'cash_out');
INSERT INTO t_cashbank VALUES ('101', '88', '22', '1000000000.00', '461334874.00', '2016', '6', '2', 'user@citraindah.com', null, '2016-08-24 07:24:16', '2016-08-24 07:24:16', 'cash_out');
INSERT INTO t_cashbank VALUES ('102', '88', '23', '474660295.00', '532709590.00', '2016', '6', '2', 'user@citraindah.com', null, '2016-08-24 07:24:44', '2016-08-24 07:24:44', 'cash_out');
INSERT INTO t_cashbank VALUES ('103', '88', '24', '26312545.00', '300022500.00', '2016', '6', '2', 'user@citraindah.com', null, '2016-08-24 07:25:08', '2016-08-24 07:25:08', 'cash_out');
INSERT INTO t_cashbank VALUES ('104', '88', '25', '56970552.00', '0.00', '2016', '6', '2', 'user@citraindah.com', null, '2016-08-24 07:25:27', '2016-08-24 07:25:27', 'cash_out');
INSERT INTO t_cashbank VALUES ('105', '88', '9', '1174250907.00', '1527811102.00', '2016', '6', '3', 'user@citraindah.com', 'user@citraindah.com', '2016-08-24 07:27:19', '2016-08-24 07:27:42', 'cash_in');
INSERT INTO t_cashbank VALUES ('106', '88', '10', '339016.00', '113538.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:28:27', '2016-08-24 07:28:27', 'cash_in');
INSERT INTO t_cashbank VALUES ('107', '88', '11', '520411651.00', '219607643.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:28:45', '2016-08-24 07:28:45', 'cash_in');
INSERT INTO t_cashbank VALUES ('108', '88', '12', '431372.00', '33922.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:29:01', '2016-08-24 07:29:01', 'cash_in');
INSERT INTO t_cashbank VALUES ('109', '88', '13', '999501634.00', '2003428574.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:29:21', '2016-08-24 07:29:21', 'cash_in');
INSERT INTO t_cashbank VALUES ('110', '88', '14', '69739.00', '83162.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:29:37', '2016-08-24 07:29:37', 'cash_in');
INSERT INTO t_cashbank VALUES ('111', '88', '15', '845132610.00', '6444383.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:29:56', '2016-08-24 07:29:56', 'cash_in');
INSERT INTO t_cashbank VALUES ('112', '88', '16', '3998837084.00', '4302125973.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:30:13', '2016-08-24 07:30:13', 'cash_in');
INSERT INTO t_cashbank VALUES ('113', '88', '17', '14865.00', '114973.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:30:33', '2016-08-24 07:30:33', 'cash_in');
INSERT INTO t_cashbank VALUES ('114', '88', '22', '200885.00', '50177.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:30:50', '2016-08-24 07:30:50', 'cash_in');
INSERT INTO t_cashbank VALUES ('115', '88', '19', '5523076618.00', '9154842699.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:31:10', '2016-08-24 07:31:10', 'cash_out');
INSERT INTO t_cashbank VALUES ('116', '88', '21', '4461.00', '70901.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:31:48', '2016-08-24 07:31:48', 'cash_out');
INSERT INTO t_cashbank VALUES ('117', '88', '23', '1814192785.00', '1036411737.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:32:25', '2016-08-24 07:32:25', 'cash_out');
INSERT INTO t_cashbank VALUES ('118', '88', '24', '88730154.00', '6140275.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:32:40', '2016-08-24 07:32:40', 'cash_out');
INSERT INTO t_cashbank VALUES ('119', '88', '25', '97105628.00', '250165852.00', '2016', '6', '3', 'user@citraindah.com', null, '2016-08-24 07:32:55', '2016-08-24 07:32:55', 'cash_out');
INSERT INTO t_cashbank VALUES ('129', '88', '30', '21538922.00', '0.00', '2016', '5', '1', 'admin@admin.com', 'user@citraindah.com', '2016-09-15 02:48:23', '2016-09-15 04:35:44', '');
INSERT INTO t_cashbank VALUES ('130', '88', '30', '29800000.00', '45681950.00', '2016', '6', '1', 'admin@admin.com', 'user@citraindah.com', '2016-09-15 02:48:54', '2016-09-15 04:35:56', '');
INSERT INTO t_cashbank VALUES ('132', '88', '20', '18657323940.00', '20208750951.00', '2016', '6', '2', 'user@citraindah.com', null, '2016-09-15 04:32:54', '2016-09-15 04:32:54', '');
INSERT INTO t_cashbank VALUES ('133', '88', '30', '120549000.00', '126072353.00', '2016', '6', '2', 'user@citraindah.com', null, '2016-09-15 04:36:25', '2016-09-15 04:36:25', '');
INSERT INTO t_cashbank VALUES ('134', '83', '32', '500000.00', '0.00', '2016', '9', '1', 'fc@ciputra.co.id', null, '2016-09-15 06:38:49', '2016-09-15 06:38:49', '');
INSERT INTO t_cashbank VALUES ('135', '83', '32', '500000.00', '0.00', '2016', '9', '2', 'fc@ciputra.co.id', null, '2016-09-15 06:39:09', '2016-09-15 06:39:09', '');
INSERT INTO t_cashbank VALUES ('136', '83', '32', '1000000.00', '200000.00', '2016', '9', '3', 'fc@ciputra.co.id', null, '2016-09-15 06:39:32', '2016-09-15 06:39:32', '');
INSERT INTO t_cashbank VALUES ('268', '88', '7', '1586188717.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:31', null, '');
INSERT INTO t_cashbank VALUES ('269', '88', '8', '2054039964.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('270', '88', '9', '1636108905.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('271', '88', '10', '102984235.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('272', '88', '11', '2601435511.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('273', '88', '12', '104661667.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('274', '88', '13', '2767824285.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('275', '88', '14', '63431489.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('276', '88', '15', '1347583685.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('277', '88', '16', '1332378843.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('278', '88', '17', '60690489.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('279', '88', '18', '163387708.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('280', '88', '19', '141052984.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('281', '88', '20', '-125730162942.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('282', '88', '21', '10669381.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('283', '88', '22', '1039970284.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('284', '88', '23', '292056802.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('285', '88', '24', '245984602.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('286', '88', '25', '352959151.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('287', '88', '110', '21538922.00', '0.00', '2016', '5', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:41:32', null, '');
INSERT INTO t_cashbank VALUES ('308', '88', '7', '1710734960.00', '1385332929.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('309', '88', '8', '4728148870.00', '1031208650.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('310', '88', '9', '0.00', '0.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('311', '88', '10', '0.00', '0.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('312', '88', '11', '59694602.00', '2000005000.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('313', '88', '12', '0.00', '0.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('314', '88', '13', '450305000.00', '1004835068.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('315', '88', '14', '0.00', '0.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('316', '88', '15', '0.00', '0.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('317', '88', '16', '5804294464.00', '4326179765.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('318', '88', '17', '0.00', '0.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('319', '88', '18', '0.00', '0.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('320', '88', '19', '10717963104.00', '9255738899.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('321', '88', '20', '8000000000.00', '5857915477.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('322', '88', '21', '0.00', '0.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('323', '88', '22', '0.00', '463332495.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('324', '88', '23', '241411381.00', '240480584.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('325', '88', '24', '63827101.00', '6000.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('326', '88', '25', '32213250.00', '0.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('327', '88', '110', '29800000.00', '45681950.00', '2016', '6', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 02:58:05', null, '');
INSERT INTO t_cashbank VALUES ('331', '71', '117', '99.00', '0.00', '2016', '9', '1', 'surabaya@ciputra.com', null, '2016-09-30 03:37:45', null, '');
INSERT INTO t_cashbank VALUES ('332', '71', '118', '99.00', '0.00', '2016', '9', '1', 'surabaya@ciputra.com', null, '2016-09-30 03:37:45', null, '');
INSERT INTO t_cashbank VALUES ('333', '71', '119', '99.00', '0.00', '2016', '9', '1', 'surabaya@ciputra.com', null, '2016-09-30 03:37:45', null, '');
INSERT INTO t_cashbank VALUES ('334', '71', '117', '2.00', '1.00', '2016', '9', '2', 'surabaya@ciputra.com', null, '2016-09-30 08:24:47', null, '');
INSERT INTO t_cashbank VALUES ('335', '71', '118', '2.00', '1.00', '2016', '9', '2', 'surabaya@ciputra.com', null, '2016-09-30 08:24:47', null, '');
INSERT INTO t_cashbank VALUES ('336', '71', '119', '2.00', '1.00', '2016', '9', '2', 'surabaya@ciputra.com', null, '2016-09-30 08:24:47', null, '');

-- ----------------------------
-- Table structure for `t_deposit`
-- ----------------------------
DROP TABLE IF EXISTS `t_deposit`;
CREATE TABLE `t_deposit` (
  `deposit_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `bank_account_id` int(11) NOT NULL,
  `percent_deposit` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.00',
  `deposit_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `in` decimal(20,2) DEFAULT '0.00',
  `out` decimal(20,2) DEFAULT '0.00',
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`deposit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_deposit
-- ----------------------------
INSERT INTO t_deposit VALUES ('93', '71', '105', '2', null, '13.00', '2.00', '2016', '9', '1', 'surabaya@ciputra.com', null, null, null);
INSERT INTO t_deposit VALUES ('94', '71', '107', '1', null, '12.00', '1.00', '2016', '9', '1', 'surabaya@ciputra.com', null, null, null);
INSERT INTO t_deposit VALUES ('95', '71', '107', '12', 'DOC 123456', '1234.00', '0.00', '2016', '9', '1', '', null, '2016-09-26 08:45:17', '2016-09-26 08:45:17');
INSERT INTO t_deposit VALUES ('96', '71', '105', '0', null, '1.00', '1.00', '2016', '9', '2', 'surabaya@ciputra.com', null, null, null);
INSERT INTO t_deposit VALUES ('97', '71', '107', '0', null, '1.00', '1.00', '2016', '9', '2', 'surabaya@ciputra.com', null, null, null);
INSERT INTO t_deposit VALUES ('98', '71', '107', '12', 'DOC 123456', '0.00', '1234.00', '2016', '9', '2', '', null, '2016-09-26 08:45:43', '2016-09-26 08:45:43');
INSERT INTO t_deposit VALUES ('103', '88', '113', '    2 ', null, '45699.00', '1.00', '2016', '9', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 03:09:13', null);
INSERT INTO t_deposit VALUES ('104', '88', '114', '    12', '', '1235.00', '1.00', '2016', '9', '1', 'usercitraindah@ciputra.com', 'usercitraindah@ciputra.com', '2016-09-28 03:09:13', '2016-09-28 03:10:47');
INSERT INTO t_deposit VALUES ('107', '71', '116', '  1 ', null, '33.00', '0.00', '2016', '9', '1', 'surabaya@ciputra.com', null, '2016-09-28 04:22:56', null);

-- ----------------------------
-- Table structure for `t_escrow`
-- ----------------------------
DROP TABLE IF EXISTS `t_escrow`;
CREATE TABLE `t_escrow` (
  `escrow_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `bank_account_id` int(11) NOT NULL,
  `opening_balance` decimal(20,2) NOT NULL DEFAULT '0.00',
  `in` decimal(20,2) DEFAULT '0.00',
  `out` decimal(20,2) DEFAULT '0.00',
  `closing_balance` decimal(20,2) DEFAULT '0.00',
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`escrow_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_escrow
-- ----------------------------
INSERT INTO t_escrow VALUES ('30', '88', '109', '0.00', '1241324124.77', '12314.00', '0.00', '2016', '9', '1', 'usercitraindah@ciputra.com', 'usercitraindah@ciputra.com', '2016-09-27 09:42:18', '2016-09-27 09:53:32');
INSERT INTO t_escrow VALUES ('35', '88', '111', '0.00', '5678.00', '0.00', '0.00', '2016', '9', '2', 'usercitraindah@ciputra.com', null, '2016-09-28 03:12:09', null);
INSERT INTO t_escrow VALUES ('36', '88', '112', '0.00', '2334.00', '0.00', '0.00', '2016', '9', '2', 'usercitraindah@ciputra.com', null, '2016-09-28 03:12:09', null);
INSERT INTO t_escrow VALUES ('37', '88', '115', '0.00', '345235.00', '0.00', '0.00', '2016', '9', '2', 'usercitraindah@ciputra.com', null, '2016-09-28 03:12:09', null);
INSERT INTO t_escrow VALUES ('38', '88', '111', '0.00', null, null, '0.00', '2016', '9', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 10:18:51', null);
INSERT INTO t_escrow VALUES ('39', '88', '112', '0.00', '457.00', '1.00', '0.00', '2016', '9', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 10:18:51', null);
INSERT INTO t_escrow VALUES ('40', '88', '115', '0.00', '12345.00', '0.00', '0.00', '2016', '9', '1', 'usercitraindah@ciputra.com', null, '2016-09-28 10:18:51', null);

-- ----------------------------
-- Table structure for `t_user_project`
-- ----------------------------
DROP TABLE IF EXISTS `t_user_project`;
CREATE TABLE `t_user_project` (
  `user_project_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_user_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_user_project
-- ----------------------------
INSERT INTO t_user_project VALUES ('21', '27', '1', '42', 'admin@admin.com', null, '2016-08-08 03:15:59', '2016-08-08 03:15:59');
INSERT INTO t_user_project VALUES ('22', '27', '1', '45', 'admin@admin.com', null, '2016-08-08 03:15:59', '2016-08-08 03:15:59');
INSERT INTO t_user_project VALUES ('23', '27', '1', '47', 'admin@admin.com', null, '2016-08-08 03:15:59', '2016-08-08 03:15:59');
INSERT INTO t_user_project VALUES ('56', '1', '1', '1', '', 'admin@admin.com', '2016-08-08 06:18:47', '2016-08-08 06:18:47');
INSERT INTO t_user_project VALUES ('57', '1', '1', '2', '', 'admin@admin.com', '2016-08-08 06:18:48', '2016-08-08 06:18:48');
INSERT INTO t_user_project VALUES ('58', '1', '1', '43', '', 'admin@admin.com', '2016-08-08 06:18:48', '2016-08-08 06:18:48');
INSERT INTO t_user_project VALUES ('62', '29', '2', '1', '', 'admin@admin.com', '2016-08-08 06:55:52', '2016-08-08 06:55:52');
INSERT INTO t_user_project VALUES ('63', '29', '2', '45', '', 'admin@admin.com', '2016-08-08 06:55:52', '2016-08-08 06:55:52');
INSERT INTO t_user_project VALUES ('64', '29', '2', '47', '', 'admin@admin.com', '2016-08-08 06:55:52', '2016-08-08 06:55:52');
INSERT INTO t_user_project VALUES ('65', '30', '1', '45', 'admin@admin.com', null, '2016-08-22 01:45:08', '2016-08-22 01:45:08');
INSERT INTO t_user_project VALUES ('66', '30', '1', '47', 'admin@admin.com', null, '2016-08-22 01:45:08', '2016-08-22 01:45:08');
INSERT INTO t_user_project VALUES ('67', '31', '6', '71', 'admin@admin.com', null, '2016-08-23 07:51:14', '2016-08-23 07:51:14');
INSERT INTO t_user_project VALUES ('68', '32', '6', '72', 'admin@admin.com', null, '2016-08-23 07:53:54', '2016-08-23 07:53:54');
INSERT INTO t_user_project VALUES ('69', '33', '6', '73', 'admin@admin.com', null, '2016-08-23 07:55:38', '2016-08-23 07:55:38');
INSERT INTO t_user_project VALUES ('70', '34', '6', '74', 'admin@admin.com', null, '2016-08-23 07:57:33', '2016-08-23 07:57:33');
INSERT INTO t_user_project VALUES ('71', '35', '6', '75', 'admin@admin.com', null, '2016-08-23 07:59:36', '2016-08-23 07:59:36');
INSERT INTO t_user_project VALUES ('72', '36', '6', '76', 'admin@admin.com', null, '2016-08-23 08:01:31', '2016-08-23 08:01:31');
INSERT INTO t_user_project VALUES ('73', '37', '6', '77', 'admin@admin.com', null, '2016-08-23 08:02:52', '2016-08-23 08:02:52');
INSERT INTO t_user_project VALUES ('74', '38', '6', '78', 'admin@admin.com', null, '2016-08-23 08:04:09', '2016-08-23 08:04:09');
INSERT INTO t_user_project VALUES ('75', '39', '6', '79', 'admin@admin.com', null, '2016-08-23 08:05:22', '2016-08-23 08:05:22');
INSERT INTO t_user_project VALUES ('76', '40', '6', '80', 'admin@admin.com', null, '2016-08-23 08:06:42', '2016-08-23 08:06:42');
INSERT INTO t_user_project VALUES ('77', '41', '6', '81', 'admin@admin.com', null, '2016-08-23 08:08:30', '2016-08-23 08:08:30');
INSERT INTO t_user_project VALUES ('78', '42', '6', '82', 'admin@admin.com', null, '2016-08-23 08:11:02', '2016-08-23 08:11:02');
INSERT INTO t_user_project VALUES ('79', '43', '6', '83', 'admin@admin.com', null, '2016-08-23 08:12:20', '2016-08-23 08:12:20');
INSERT INTO t_user_project VALUES ('81', '45', '6', '85', 'admin@admin.com', null, '2016-08-23 08:15:44', '2016-08-23 08:15:44');
INSERT INTO t_user_project VALUES ('88', '51', '6', '83', 'admin@admin.com', null, '2016-08-25 04:32:22', '2016-08-25 04:32:22');
INSERT INTO t_user_project VALUES ('89', '52', '1', '0', 'admin@admin.com', null, '2016-08-26 01:10:23', '2016-08-26 01:10:23');
INSERT INTO t_user_project VALUES ('112', '44', '6', '84', '', 'admin@admin.com', '2016-08-29 08:13:42', '2016-08-29 08:13:42');
INSERT INTO t_user_project VALUES ('124', '46', '6', '85', '', 'admin@admin.com', '2016-08-29 08:54:21', '2016-08-29 08:54:21');
INSERT INTO t_user_project VALUES ('125', '47', '6', '85', '', 'admin@admin.com', '2016-08-29 08:54:27', '2016-08-29 08:54:27');
INSERT INTO t_user_project VALUES ('126', '49', '6', '87', '', 'admin@admin.com', '2016-08-29 08:57:07', '2016-08-29 08:57:07');
INSERT INTO t_user_project VALUES ('127', '48', '6', '87', '', 'admin@admin.com', '2016-08-29 08:58:02', '2016-08-29 08:58:02');
INSERT INTO t_user_project VALUES ('128', '50', '6', '88', '', 'admin@admin.com', '2016-09-15 05:39:47', '2016-09-15 05:39:47');
INSERT INTO t_user_project VALUES ('130', '54', '6', '83', 'admin@admin.com', null, '2016-09-15 06:34:17', '2016-09-15 06:34:17');
INSERT INTO t_user_project VALUES ('131', '55', '6', '71', 'admin@admin.com', null, '2016-09-20 01:04:26', '2016-09-20 01:04:26');
