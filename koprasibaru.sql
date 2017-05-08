/*
 Navicat Premium Data Transfer

 Source Server         : LocalAppache
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : koprasibaru

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 05/08/2017 23:45:02 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `carousel`
-- ----------------------------
DROP TABLE IF EXISTS `carousel`;
CREATE TABLE `carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `text_top` varchar(25) NOT NULL,
  `text_middle` varchar(25) NOT NULL,
  `button_text` varchar(25) NOT NULL,
  `button_link` varchar(50) NOT NULL DEFAULT '#',
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `carousel`
-- ----------------------------
BEGIN;
INSERT INTO `carousel` VALUES ('1', 'slide1', 'Ahli dalam menangani', 'Architecture Problem', 'Check Portofolio', '#section-portofolio', '11.jpg'), ('3', 'slide2', 'Test', 'Another Test', 'Test', '#wrapper', '18.jpg'), ('4', 'slide3', 'slide3', 'slide3', 'slide3', 'slide3', '12.jpg'), ('5', 'slide4', 'test', 'test', 'test', '/', '6.jpg');
COMMIT;

-- ----------------------------
--  Table structure for `contacts_info`
-- ----------------------------
DROP TABLE IF EXISTS `contacts_info`;
CREATE TABLE `contacts_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `web` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `contacts_info`
-- ----------------------------
BEGIN;
INSERT INTO `contacts_info` VALUES ('1', 'Jl. Citarip Raya no. 15 A  Kopo Bandung', '0821 1879 3999', '022 - 20564406', 'mitrasouvenir1@gmail.com', 'http://mitrasouvenir.com');
COMMIT;

-- ----------------------------
--  Table structure for `guest_book`
-- ----------------------------
DROP TABLE IF EXISTS `guest_book`;
CREATE TABLE `guest_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` text,
  `has_read` int(1) NOT NULL DEFAULT '0',
  `date` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `guest_book`
-- ----------------------------
BEGIN;
INSERT INTO `guest_book` VALUES ('1', 'hana', 'hana.siro6@gmail.com', '089638903697', 'Mba/mas ,saya mau tanya kalo cngkir tradisional harga.y brapa?ada min. Order?', '0', '1488908789');
COMMIT;

-- ----------------------------
--  Table structure for `m_anggota`
-- ----------------------------
DROP TABLE IF EXISTS `m_anggota`;
CREATE TABLE `m_anggota` (
  `kd_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` int(11) NOT NULL,
  `nm_anggota` varchar(100) DEFAULT NULL,
  `kd_jabatan` int(11) DEFAULT NULL,
  `pasPhoto_anggota` varchar(225) DEFAULT NULL,
  `pasPhotoProfile` varchar(225) DEFAULT NULL,
  `pasPhotoProduk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kd_anggota`),
  KEY `kd_jabatan` (`kd_jabatan`),
  KEY `key_anggota` (`id_users`),
  CONSTRAINT `key_anggota` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  CONSTRAINT `key_jabatan` FOREIGN KEY (`kd_jabatan`) REFERENCES `m_jabatan` (`kd_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `m_anggota`
-- ----------------------------
BEGIN;
INSERT INTO `m_anggota` VALUES ('82', '9', 'Rifky rachman', '1', null, '63014.jpeg', '75375.jpeg'), ('83', '35', 'masuk809', null, null, null, null), ('84', '36', 'huhuy080', null, null, null, null), ('85', '37', 'lolo231', null, null, null, null), ('86', '38', 'kodokkkfas', null, null, null, null), ('87', '39', 'asasf234', null, null, null, null), ('88', '40', 'asfas534', null, null, null, null), ('89', '41', 'aasdfasfda534', null, null, null, null), ('90', '42', 'ccca234', null, null, null, null), ('91', '43', 'asfasdfas222', null, null, null, null), ('92', '44', 'asdfa555', null, null, null, null), ('93', '45', 'ggg342', null, null, null, null), ('94', '46', 'asdfasfdatretertr231', null, null, null, null), ('95', '47', 'asfda342', null, null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `m_data_doclegal`
-- ----------------------------
DROP TABLE IF EXISTS `m_data_doclegal`;
CREATE TABLE `m_data_doclegal` (
  `kd_docLegal` int(11) NOT NULL AUTO_INCREMENT,
  `kd_anggota` int(11) DEFAULT NULL,
  `npwp_docLegal` varchar(100) DEFAULT NULL,
  `file_npwp_docLegal` varchar(255) DEFAULT NULL,
  `situ_docLegal` varchar(100) DEFAULT NULL,
  `file_situ_docLegal` varchar(255) DEFAULT NULL,
  `siup_docLegal` varchar(100) DEFAULT NULL,
  `file_siup_docLegal` varchar(255) DEFAULT NULL,
  `tdp_docLegal` varchar(100) DEFAULT NULL,
  `file_tdp_docLegal` varchar(255) DEFAULT NULL,
  `pirt_docLegal` varchar(100) DEFAULT NULL,
  `file_pirt_docLegal` varchar(255) DEFAULT NULL,
  `halal_docLegal` varchar(100) DEFAULT NULL,
  `file_halal_docLegal` varchar(255) DEFAULT NULL,
  `bpom_docLegal` varchar(100) DEFAULT NULL,
  `file_bpom_docLegal` varchar(255) DEFAULT NULL,
  `hki_docLegal` varchar(100) DEFAULT NULL,
  `file_hki_docLegal` varchar(255) DEFAULT NULL,
  `merk_docLegal` varchar(100) DEFAULT NULL,
  `file_merk_docLegal` varchar(255) DEFAULT NULL,
  `agreement_docLegal` varchar(100) DEFAULT NULL,
  `file_agreement_docLegal` varchar(255) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` varchar(255) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`kd_docLegal`),
  KEY `kd_anggota` (`kd_anggota`),
  CONSTRAINT `key_anggota_docLegal` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `m_data_doclegal`
-- ----------------------------
BEGIN;
INSERT INTO `m_data_doclegal` VALUES ('1', null, '', null, '', null, '', null, '', null, '', null, '', null, '', null, '', null, '', null, null, null, 'aku', '2017-04-15 20:08:37', null, null), ('2', null, '', null, '', null, '', null, '', null, '', null, '', null, '', null, '', null, '', null, null, null, 'aku', '2017-04-15 20:09:01', null, null), ('3', '82', 'asdfa', '85621.jpeg', '', '12077.jpeg', '', null, '', null, '', null, '', null, '', null, '', null, '', null, '', null, 'aku', '2017-04-15 20:55:36', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `m_data_pribadi`
-- ----------------------------
DROP TABLE IF EXISTS `m_data_pribadi`;
CREATE TABLE `m_data_pribadi` (
  `kd_data_pribadi` int(11) NOT NULL AUTO_INCREMENT,
  `kd_anggota` int(11) DEFAULT NULL,
  `tempat_lahir_pribadi` varchar(100) DEFAULT NULL,
  `npwp_pribadi` varchar(100) DEFAULT NULL,
  `noHp_pribadi` varchar(100) DEFAULT NULL,
  `email_pribadi` varchar(100) DEFAULT NULL,
  `alamat_pribadi` text,
  `rtRw_pribadi` varchar(20) DEFAULT NULL,
  `kec_pribadi` varchar(50) DEFAULT NULL,
  `desKel_pribadi` varchar(50) DEFAULT NULL,
  `kabkot_pribadi` varchar(100) DEFAULT NULL,
  `wubTahun_pribadi` varchar(10) DEFAULT NULL,
  `wubDinas_pribadi` varchar(50) DEFAULT NULL,
  `created` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` varchar(100) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  PRIMARY KEY (`kd_data_pribadi`),
  KEY `kd_anggota` (`kd_anggota`),
  CONSTRAINT `key_anggota_pribadi` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `m_data_pribadi`
-- ----------------------------
BEGIN;
INSERT INTO `m_data_pribadi` VALUES ('1', null, '', '', '', '', '', '', '', '', null, '', '', 'aku', '2017-04-15 20:08:37', null, null), ('2', null, '', '', '', '', '', '', '', '', null, '', '', 'aku', '2017-04-15 20:09:01', null, null), ('3', '82', 'garut ffff', '', '', '', 'asdfasdfas as dfas', '', '', '', null, '', '', 'aku', '2017-04-15 20:30:35', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `m_data_usaha`
-- ----------------------------
DROP TABLE IF EXISTS `m_data_usaha`;
CREATE TABLE `m_data_usaha` (
  `kd_usaha` int(11) NOT NULL AUTO_INCREMENT,
  `kd_anggota` int(11) DEFAULT NULL,
  `brand_usaha` varchar(100) DEFAULT NULL,
  `lama_usaha` int(11) DEFAULT NULL,
  `jenisProd_usaha` varchar(100) DEFAULT NULL,
  `alamat_usaha` text,
  `rtRw_usaha` varchar(20) DEFAULT NULL,
  `kec_usaha` varchar(50) DEFAULT NULL,
  `kabKot_usaha` varchar(50) DEFAULT NULL,
  `kapasitas_usaha` varchar(100) DEFAULT NULL,
  `harga_usaha` int(11) DEFAULT NULL,
  `wilayah_offline_usaha` varchar(100) DEFAULT NULL,
  `wilayah_online_usaha` varchar(100) DEFAULT NULL,
  `jumlahTenagaKerja_usaha` int(11) DEFAULT NULL,
  `omset_usaha` int(100) DEFAULT NULL,
  `fb_usaha` varchar(100) DEFAULT NULL,
  `insta_usaha` varchar(100) DEFAULT NULL,
  `twiiter_usaha` varchar(100) DEFAULT NULL,
  `created` varchar(100) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `edited` varchar(100) DEFAULT NULL,
  `edite_date` date DEFAULT NULL,
  PRIMARY KEY (`kd_usaha`),
  KEY `kd_anggota` (`kd_anggota`),
  CONSTRAINT `key_anggota_usaha` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `m_data_usaha`
-- ----------------------------
BEGIN;
INSERT INTO `m_data_usaha` VALUES ('1', '88', '', '0', 'Baju', '', '', '', 'Bandung', '', '0', '', '', '0', '9000', '', '', '', 'aku', null, null, null), ('2', '89', '', '0', 'Mobil', '', '', '', 'Jakarta', '', '0', '', '', '0', '10000', '', '', '', 'aku', null, null, null), ('3', '82', '', '0', '', '', '', '', 'Bandung', '', '0', 'Bandung', '', '0', '20000', '', '', '', 'aku', null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `m_jabatan`
-- ----------------------------
DROP TABLE IF EXISTS `m_jabatan`;
CREATE TABLE `m_jabatan` (
  `kd_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kd_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `m_jabatan`
-- ----------------------------
BEGIN;
INSERT INTO `m_jabatan` VALUES ('1', 'Programmer'), ('2', 'Sales');
COMMIT;

-- ----------------------------
--  Table structure for `m_jenis_pinjaman`
-- ----------------------------
DROP TABLE IF EXISTS `m_jenis_pinjaman`;
CREATE TABLE `m_jenis_pinjaman` (
  `kd_jpinjaman` int(11) NOT NULL,
  PRIMARY KEY (`kd_jpinjaman`),
  CONSTRAINT `j_pinjaman` FOREIGN KEY (`kd_jpinjaman`) REFERENCES `t_pinjaman` (`kd_jpinjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `m_jenis_simpanan`
-- ----------------------------
DROP TABLE IF EXISTS `m_jenis_simpanan`;
CREATE TABLE `m_jenis_simpanan` (
  `kd_jsimpanan` int(11) NOT NULL,
  PRIMARY KEY (`kd_jsimpanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `m_jenis_usaha`
-- ----------------------------
DROP TABLE IF EXISTS `m_jenis_usaha`;
CREATE TABLE `m_jenis_usaha` (
  `kd_jenis_usaha` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis_usaha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kd_jenis_usaha`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `m_jenis_usaha`
-- ----------------------------
BEGIN;
INSERT INTO `m_jenis_usaha` VALUES ('1', 'Konveksi'), ('2', 'Makanan'), ('3', 'Jasa'), ('4', 'Baju');
COMMIT;

-- ----------------------------
--  Table structure for `m_menu_dashboard`
-- ----------------------------
DROP TABLE IF EXISTS `m_menu_dashboard`;
CREATE TABLE `m_menu_dashboard` (
  `kd_menu_dashboard` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kd_menu_dashboard`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `m_nasabah`
-- ----------------------------
DROP TABLE IF EXISTS `m_nasabah`;
CREATE TABLE `m_nasabah` (
  `kd_nasabah` int(11) NOT NULL,
  `nm_nasabah` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kd_nasabah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `m_pegawai`
-- ----------------------------
DROP TABLE IF EXISTS `m_pegawai`;
CREATE TABLE `m_pegawai` (
  `kd_pegawai` int(11) NOT NULL,
  `nm_pegawai` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kd_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `m_pinjaman_anggunan`
-- ----------------------------
DROP TABLE IF EXISTS `m_pinjaman_anggunan`;
CREATE TABLE `m_pinjaman_anggunan` (
  `id_anggunan` int(11) NOT NULL,
  `no_pinjaman` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_anggunan`),
  KEY `no_pinjaman` (`no_pinjaman`),
  CONSTRAINT `key_anggunan` FOREIGN KEY (`no_pinjaman`) REFERENCES `t_pinjaman` (`no_pinjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `m_pinjaman_angsuran`
-- ----------------------------
DROP TABLE IF EXISTS `m_pinjaman_angsuran`;
CREATE TABLE `m_pinjaman_angsuran` (
  `no_angsuran` int(11) NOT NULL,
  `no_pinjaman` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_angsuran`),
  KEY `no_pinjaman` (`no_pinjaman`),
  CONSTRAINT `key_pinjaman_angsuran` FOREIGN KEY (`no_pinjaman`) REFERENCES `t_pinjaman` (`no_pinjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `link` text NOT NULL,
  `order_show` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `menu`
-- ----------------------------
BEGIN;
INSERT INTO `menu` VALUES ('1', 'OUR WORK', '#section-services', '2'), ('3', 'Home', '/', '1'), ('5', 'Team', '#section-team', '3'), ('6', 'Location', '/location', '4');
COMMIT;

-- ----------------------------
--  Table structure for `menu_admin`
-- ----------------------------
DROP TABLE IF EXISTS `menu_admin`;
CREATE TABLE `menu_admin` (
  `id_menu` int(10) NOT NULL AUTO_INCREMENT,
  `level_menu` smallint(6) NOT NULL,
  `parent_menu` int(10) NOT NULL,
  `posisition_menu` tinyint(4) NOT NULL,
  `url_menu` varchar(100) NOT NULL,
  `name_menu` varchar(100) NOT NULL,
  `icon_menu` varchar(50) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `creator` varchar(100) DEFAULT NULL,
  `edited` timestamp NULL DEFAULT NULL,
  `editor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `menu_admin`
-- ----------------------------
BEGIN;
INSERT INTO `menu_admin` VALUES ('201', '0', '0', '1', 'admin', 'Home', 'android', '2017-04-01 14:53:01', 'Admin DB', '2017-04-01 14:53:05', null), ('202', '0', '0', '1', 'admin/profile', 'Profile', null, '2017-04-01 14:54:17', 'Admin DB', '2017-04-01 14:54:32', null), ('205', '0', '0', '1', 'config/group', 'Config', 'book', '2017-04-01 23:54:59', 'Admin DB', '2017-04-01 23:55:07', null), ('206', '0', '205', '1', 'admin/config/menu', 'Menu', null, '2017-04-01 23:55:42', 'Admin DB', '2017-04-01 23:55:53', null), ('207', '0', '205', '1', 'admin/config/role', 'Role', null, '2017-04-01 23:56:34', 'Admin DB', '2017-04-01 23:56:42', null), ('208', '0', '205', '1', 'admin/config/group', 'Group', null, '2017-04-01 23:57:41', 'Admin DB', '2017-04-01 23:57:49', null), ('212', '0', '0', '0', 'admin/fe', 'Frontend Manager', null, '2017-04-08 22:23:49', null, null, null), ('213', '0', '0', '0', 'admin/guest_book', 'Guest Book', null, '2017-04-08 22:25:14', null, null, null), ('214', '0', '0', '0', 'admin/mediamanager', 'Media Manager', null, '2017-04-08 22:25:56', null, null, null), ('215', '0', '0', '0', 'admin/menu', 'Menu', null, '2017-04-08 22:26:17', null, null, null), ('216', '0', '0', '0', 'admin/form', 'Form', null, '2017-04-08 22:27:38', null, null, null), ('217', '0', '0', '0', 'admin/settting', 'Settings', null, '2017-04-08 22:29:57', null, null, null), ('218', '0', '0', '0', 'admin/user', 'User', null, '2017-04-08 22:30:43', null, null, null), ('219', '0', '218', '0', 'admin/user', 'User', null, '2017-04-08 22:31:10', null, null, null), ('220', '0', '218', '0', 'admin/user_level', 'User Group', null, '2017-04-08 22:32:49', null, null, null), ('221', '0', '216', '0', 'admin/carousel', 'Slide', null, '2017-04-08 22:33:53', null, null, null), ('222', '0', '216', '0', 'admin/post', 'Post', null, '2017-04-08 22:34:20', null, null, null), ('223', '0', '216', '0', 'admin/process_text', 'Process Text', null, '2017-04-08 22:34:48', null, null, null), ('224', '0', '216', '0', 'admin/prj', 'Project', null, '2017-04-08 22:35:16', null, null, null), ('225', '0', '224', '0', 'admin/project', 'Project', null, '2017-04-08 22:35:41', null, null, null), ('226', '0', '224', '0', 'admin/project/category', 'Project Category', null, '2017-04-08 22:36:17', null, null, null), ('227', '0', '216', '0', 'admin/skill', 'Skill', null, '2017-04-08 22:36:50', null, null, null), ('228', '0', '216', '0', 'admin/team', 'Team', null, '2017-04-08 22:37:10', null, null, null), ('229', '0', '216', '0', 'admin/testimonial', 'Testimonial', null, '2017-04-08 22:37:30', null, null, null), ('230', '0', '217', '0', 'admin/setting', 'General', null, '2017-04-08 22:39:07', null, null, null), ('231', '0', '217', '0', 'Footer', 'Footers', null, '2017-04-08 22:39:32', null, null, null), ('232', '0', '231', '0', 'admin/setting/footer', 'Footer Text', 'volume_down', '2017-04-08 22:39:58', null, null, null), ('233', '0', '231', '0', 'admin/setting/footer/social', 'Social Link', null, '2017-04-08 22:40:50', null, null, null), ('234', '0', '217', '0', 'admin/setting/location', 'Location', null, '2017-04-08 22:41:25', null, null, null), ('235', '0', '217', '0', 'admin/setting/profile', 'Profile', null, '2017-04-08 22:41:48', null, null, null), ('236', '0', '217', '0', 'admin/contact', 'Contact', 'favorite', '2017-04-08 22:42:28', null, null, null), ('237', '0', '0', '0', 'simpanan', 'Simpanan Anggota', 'save', '2017-04-09 12:29:11', null, null, null), ('238', '0', '237', '0', 'admin/simpanan/wajib', 'Wajib', 'card_giftcard', '2017-04-09 12:30:16', null, null, null), ('239', '0', '237', '0', 'admin/simpanan/pokok', 'Pokok', 'card_travel', '2017-04-09 12:31:20', null, null, null), ('241', '0', '0', '0', 'keuangan', 'Keuangan Koprasi', 'payment', '2017-04-15 09:25:30', null, null, null), ('242', '0', '0', '0', 'admin/keuangan', 'Koperasi', 'payment', '2017-04-15 09:26:15', null, null, null), ('243', '0', '205', '0', 'admin/anggota', 'Generate Token Anggota', 'code', '2017-04-15 10:44:59', null, null, null), ('244', '0', '237', '0', 'admin/simpan-wajib', 'Simpanan Wajib', 'description', '2017-04-19 14:59:25', null, null, null), ('245', '0', '237', '0', 'admin/simpan-pokok', 'Simpanan Pokok', 'description', '2017-04-20 23:11:28', null, null, null), ('246', '0', '205', '0', 'admin/config/controll-Pay', 'Controll Pay Admin', 'settings', '2017-04-22 21:23:52', null, null, null), ('247', '0', '0', '0', 'admin/management', 'Management', 'view_headline', '2017-04-28 22:39:38', null, null, null), ('248', '0', '247', '0', 'admin/management/income', 'Income', 'dns', '2017-04-28 22:40:54', null, null, null), ('249', '0', '247', '0', 'admin/management/outcome', 'Outcome', 'dns', '2017-04-28 22:41:31', null, null, null), ('250', '0', '247', '0', 'admin/management/report', 'Report Keuangan', 'assignment', '2017-04-29 12:17:51', null, null, null), ('251', '0', '237', '0', 'admin/simpan-wajib-read', 'User Only Simpan Wajib', 'save', '2017-04-30 20:19:17', null, null, null), ('252', '0', '241', '0', 'admin/keuangan/income', 'Income', 'payment', '2017-05-06 11:41:49', null, null, null), ('253', '0', '241', '0', 'admin/keuangan/outcome', 'Outcome', 'card_giftcard', '2017-05-06 11:42:49', null, null, null), ('254', '0', '205', '0', 'admin/config/anggota', 'Anggota', 'verified_user', '2017-05-06 23:30:12', null, null, null), ('255', '0', '247', '0', 'admin/management/view-income', 'View Income', 'assignment_return', '2017-05-08 20:46:11', null, null, null), ('256', '0', '247', '0', 'admin/management/view-outcome', 'View Outcome', 'exit_to_app', '2017-05-08 20:47:48', null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `menu_group`
-- ----------------------------
DROP TABLE IF EXISTS `menu_group`;
CREATE TABLE `menu_group` (
  `user_grp` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_grp`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `menu_group`
-- ----------------------------
BEGIN;
INSERT INTO `menu_group` VALUES ('1', 'ADMINISTRATOR'), ('2', 'TEACHER'), ('4', 'PARENT'), ('5', 'Anggota');
COMMIT;

-- ----------------------------
--  Table structure for `menu_role`
-- ----------------------------
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE `menu_role` (
  `kd_role` int(11) NOT NULL AUTO_INCREMENT,
  `user_grp` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  PRIMARY KEY (`kd_role`),
  KEY `id_group` (`user_grp`),
  KEY `user_grp` (`user_grp`),
  KEY `id_menu` (`id_menu`),
  KEY `id_menu_2` (`id_menu`),
  CONSTRAINT `ket_group` FOREIGN KEY (`user_grp`) REFERENCES `menu_group` (`user_grp`),
  CONSTRAINT `key_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu_admin` (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=2775 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `menu_role`
-- ----------------------------
BEGIN;
INSERT INTO `menu_role` VALUES ('168', '2', '201'), ('169', '2', '202'), ('171', '2', '205'), ('172', '2', '206'), ('173', '2', '207'), ('174', '2', '208'), ('182', '4', '205'), ('2676', '5', '202'), ('2677', '5', '205'), ('2678', '5', '206'), ('2679', '5', '207'), ('2680', '5', '208'), ('2681', '5', '243'), ('2682', '5', '246'), ('2714', '1', '218'), ('2715', '1', '201'), ('2716', '1', '219'), ('2717', '1', '202'), ('2718', '1', '220'), ('2719', '1', '205'), ('2720', '1', '237'), ('2721', '1', '206'), ('2722', '1', '244'), ('2723', '1', '207'), ('2724', '1', '245'), ('2725', '1', '208'), ('2726', '1', '241'), ('2727', '1', '252'), ('2728', '1', '243'), ('2729', '1', '253'), ('2730', '1', '246'), ('2731', '1', '247'), ('2732', '1', '254'), ('2733', '1', '248'), ('2734', '1', '212'), ('2735', '1', '249'), ('2736', '1', '213'), ('2737', '1', '250'), ('2738', '1', '214'), ('2739', '1', '255'), ('2740', '1', '215'), ('2741', '1', '256'), ('2742', '1', '216'), ('2743', '1', '221'), ('2744', '1', '222'), ('2745', '1', '223'), ('2746', '1', '224'), ('2747', '1', '225'), ('2748', '1', '226'), ('2749', '1', '227'), ('2750', '1', '228'), ('2751', '1', '229'), ('2752', '1', '217'), ('2753', '1', '230'), ('2754', '1', '231'), ('2755', '1', '232'), ('2756', '1', '233'), ('2757', '1', '234'), ('2758', '1', '235'), ('2759', '1', '236'), ('2760', '1', '218'), ('2761', '1', '219'), ('2762', '1', '220'), ('2763', '1', '237'), ('2764', '1', '244'), ('2765', '1', '245'), ('2766', '1', '241'), ('2767', '1', '252'), ('2768', '1', '253'), ('2769', '1', '247'), ('2770', '1', '248'), ('2771', '1', '249'), ('2772', '1', '250'), ('2773', '1', '255'), ('2774', '1', '256');
COMMIT;

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `migrations`
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1'), ('2014_10_12_100000_create_password_resets_table', '1'), ('2014_10_12_000000_create_users_table', '1'), ('2014_10_12_100000_create_password_resets_table', '1');
COMMIT;

-- ----------------------------
--  Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `post`
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `date` int(11) NOT NULL,
  `featured_image` varchar(25) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `post`
-- ----------------------------
BEGIN;
INSERT INTO `post` VALUES ('2', 'TEst', '<h1>Test</h1>\r\n', '1483116527', '14.jpg', '1'), ('3', 'Another Test', '<p>GAGAAGA</p>\r\n', '1483119844', '14.jpg', '1'), ('4', 'Commercial Design', '<p>jgjhgjghhghhjhb hhvhvhvh</p>\r\n', '1483122781', 'bbbbbbbbb.jpg', '1'), ('5', 'BUILD & INSTALL', '<p>bhfcgdrsheshgdfdhgf</p>\r\n', '1483122797', '13.jpg', '1'), ('6', 'Lorem Ipsum', '<h1>The standard Lorem Ipsum passage, used since the 1500s</h1>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>\r\n\r\n<p><img src=\"http://fh.dev/images/image-gallery/14.jpg\" style=\"height:346px; width:554px\" />&#39;</p>\r\n', '1483170029', '15.jpg', '1');
COMMIT;

-- ----------------------------
--  Table structure for `process_text`
-- ----------------------------
DROP TABLE IF EXISTS `process_text`;
CREATE TABLE `process_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `textbox` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `process_text`
-- ----------------------------
BEGIN;
INSERT INTO `process_text` VALUES ('1', 'MEET & AGREE', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam. '), ('2', 'IDEA & CONCEPT', ' Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam.\r\n'), ('3', 'DESIGN & CREATE', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam. '), ('4', 'BUILD & INSTALL', 'First we will build that thing... and that we will install in on your computer');
COMMIT;

-- ----------------------------
--  Table structure for `projects`
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `client` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured_image` varchar(25) NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `projects`
-- ----------------------------
BEGIN;
INSERT INTO `projects` VALUES ('10', 'Gelas Dove Tinggi', '<p>Gelas Dove di cetak dan di press sendiri menggunakan mesin canggih buatan germany</p>\r\n\r\n<p>Tinggi gelas 125mm</p>\r\n\r\n<p>Diameter gelas 140mm</p>\r\n', 'si fulan', '4', 'IMG20151221143824.jpg', 'a:2:{i:0;s:21:\"IMG20151120093313.jpg\";i:1;s:21:\"IMG20151221143824.jpg\";}'), ('11', 'Souvenir Nikah', '<p>Mitra souvenir juga dapat melayani pemesanan souvenir nikah, contoh nya gelas bening dengan cetakan foto pengantin dan tanggal menikah</p>\r\n\r\n<p>Jenis gelas boleh pilih sendiri ada banyak pilihan.</p>\r\n', 'andre tauladan', '3', 'IMG20151121101551.jpg', 'a:1:{i:0;s:21:\"IMG20151121101551.jpg\";}'), ('12', 'Mug Custom', '<p>Mitra souvenir juga dapat melayani pemesanan mug souvenir atau tanda kenang-kenangan untuk berbagai instansi dan perusahaan</p>\r\n\r\n<p>Mug tersedia dalam berbagai warna dan bentuk, serta dicantumkan logo dan gambar instansi atau perusahaan</p>\r\n', 'Kementerian kelawakan dan anti hukum', '1', 'IMG20150828135459.jpg', 'a:1:{i:0;s:21:\"IMG20151120102430.jpg\";}'), ('13', 'Cangkir Baheula', '<p>Produk terbaru dari mitra souvenir adalah cangkir tradisional yang dapat di print</p>\r\n\r\n<p>dan di cetak dengan tulisan sesuai keinginan pelanggan.</p>\r\n', 'noname', '2', 'IMG20151120092521.jpg', 'a:1:{i:0;s:21:\"IMG20151120092521.jpg\";}');
COMMIT;

-- ----------------------------
--  Table structure for `projects_category`
-- ----------------------------
DROP TABLE IF EXISTS `projects_category`;
CREATE TABLE `projects_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `projects_category`
-- ----------------------------
BEGIN;
INSERT INTO `projects_category` VALUES ('1', 'Mug Custom'), ('2', 'Cangkir Tradisional'), ('3', 'Gelas Bening'), ('4', 'Gelas Dove');
COMMIT;

-- ----------------------------
--  Table structure for `rules`
-- ----------------------------
DROP TABLE IF EXISTS `rules`;
CREATE TABLE `rules` (
  `id_rules` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url_slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rules`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `rules`
-- ----------------------------
BEGIN;
INSERT INTO `rules` VALUES ('1', 'frontend_manager', 'admin/fe'), ('2', 'guest_book_read', 'admin/guest_book_read'), ('3', 'guest_book_delete', 'admin/guest_book/delete'), ('4', 'media_delete', 'admin/mediamanager/delete'), ('5', 'user_add', 'admin/user/add'), ('6', 'user_edit', 'admin/user/edit'), ('7', 'user_delete', 'admin/user/delete'), ('8', 'user_group_add', 'admin/user_level/add'), ('9', 'user_group_edit', 'admin/user_level/edit'), ('10', 'user_group_delete', 'admin/user_level/delete'), ('11', 'menu_add', 'admin/menu/add'), ('12', 'menu_edit', 'admin/menu/edit'), ('13', 'menu_delete', 'admin/menu/delete'), ('14', 'slide_add', 'admin/carousel/add'), ('15', 'slide_edit', 'admin/carousel/edit'), ('16', 'slide_delete', 'admin/carousel/delete'), ('17', 'post_add', 'admin/post/add'), ('18', 'post_edit', 'admin/post/edit'), ('19', 'post_delete', 'admin/post/delete'), ('20', 'post_setting', 'admin/post/setting'), ('21', 'process_text_add', 'admin/process_text/add'), ('22', 'process_text_edit', 'admin/process_text/edit'), ('23', 'process_text_delete', 'admin/process_text/delete'), ('24', 'process_text_setting', 'admin/process_text/setting'), ('25', 'project_add', 'admin/project/add'), ('26', 'project_edit', 'admin/project/edit'), ('27', 'project_delete', 'admin/project/delete'), ('28', 'project_setting', 'admin/project/setting'), ('29', 'project_category_add', 'admin/project/category/add'), ('30', 'project_category_edit', 'admin/project/category/edit'), ('31', 'project_category_delete', 'admin/project/category/delete'), ('32', 'skill_add', 'admin/skill/add'), ('33', 'skill_edit', 'admin/skill/edit'), ('34', 'skill_delete', 'admin/skill/delete'), ('35', 'skill_setting', 'admin/skill/setting'), ('36', 'team_add', 'admin/team/add'), ('37', 'team_edit', 'admin/team/edit'), ('38', 'team_delete', 'admin/team/delete'), ('39', 'team_setting', 'admin/team/setting'), ('40', 'testimonial_add', 'admin/testimonial/add'), ('41', 'testimonial_edit', 'admin/testimonial/edit'), ('42', 'testimonial_delete', 'admin/testimonial/delete'), ('43', 'testimonial_setting', 'admin/testimonial/setting'), ('44', 'setting_general', 'admin/setting'), ('45', 'setting_footer_text', 'admin/setting/footer'), ('46', 'setting_footer_social', 'admin/setting/footer/social'), ('47', 'setting_location', 'admin/setting/location');
COMMIT;

-- ----------------------------
--  Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `settings`
-- ----------------------------
BEGIN;
INSERT INTO `settings` VALUES ('1', 'site_title', 'Mitra Souvenir | Bandung'), ('2', 'site_description', 'Mitra Souvenir | Bandung'), ('3', 'meta_description', 'Souvenir bandung, souvenir nikah, souvenir gelas, souvenir jawa barat, souvenir Indonesia'), ('4', 'meta_keyword', 'Souvenir bandung, souvenir nikah, souvenir gelas, souvenir jawa barat, souvenir Indonesia'), ('5', 'site_logo', 'logo.png'), ('6', 'footer_text', ' ©Copyright 2017'), ('8', 'social_link', 'a:3:{i:0;a:3:{s:4:\"name\";s:8:\"facebook\";s:7:\"fa-icon\";s:11:\"fa-facebook\";s:4:\"link\";s:34:\"http://facebook.com/mitra-souvenir\";}i:1;a:3:{s:4:\"name\";s:7:\"twitter\";s:7:\"fa-icon\";s:10:\"fa-twitter\";s:4:\"link\";s:33:\"http://twitter.com/mitra souvenir\";}i:2;a:3:{s:4:\"name\";s:9:\"instagram\";s:7:\"fa-icon\";s:12:\"fa-instagram\";s:4:\"link\";s:31:\"http://instagram.com/mitra souv\";}}'), ('9', 'latitude', '-6.936582022928908'), ('10', 'longitude', '107.5847339630127'), ('11', 'marker_text', 'My location'), ('12', 'section2_title', 'OUR WORK'), ('13', 'section3_title', 'OUR PROCESS'), ('14', 'section3_background', '10.jpg'), ('15', 'section4_title', 'hana'), ('16', 'section5_title', 'TESTIMONIAL'), ('17', 'section5_background', '6.jpg'), ('18', 'section6_title', 'LATEST NEWS'), ('19', 'section6_background', '10.jpg'), ('20', 'section7_title', 'CONTACT US'), ('21', 'project_title', 'OUR WORK'), ('22', 'project_category_title', 'ALL'), ('23', 'project_button_text', 'ALL WORK'), ('24', 'project_button_link', '/project'), ('25', 'project_button_text_full', 'GET QUOTATION'), ('26', 'project_button_link_full', '#');
COMMIT;

-- ----------------------------
--  Table structure for `skills`
-- ----------------------------
DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `skills`
-- ----------------------------
BEGIN;
INSERT INTO `skills` VALUES ('1', 'Cetak Gelas Custom', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia ', 'pic_1.jpg'), ('2', 'Souvenir Nikah', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia ', '11.jpg'), ('3', 'Souvenir Gelas', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia ', 'pic_2a.jpg');
COMMIT;

-- ----------------------------
--  Table structure for `t_income`
-- ----------------------------
DROP TABLE IF EXISTS `t_income`;
CREATE TABLE `t_income` (
  `id_income` int(11) NOT NULL AUTO_INCREMENT,
  `kd_anggota` int(11) DEFAULT NULL,
  `tgl_income` datetime DEFAULT NULL,
  `jml_income` int(11) DEFAULT NULL,
  `pic_income` text,
  `ket_income` text NOT NULL,
  PRIMARY KEY (`id_income`),
  KEY `kd_anggota` (`kd_anggota`),
  CONSTRAINT `key_income` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `t_income`
-- ----------------------------
BEGIN;
INSERT INTO `t_income` VALUES ('1', '82', '2017-04-29 00:00:00', '9090', 'yyy', 'Test 1'), ('2', '83', '2017-05-08 21:12:05', '1000', 'xxx', 'Test 2');
COMMIT;

-- ----------------------------
--  Table structure for `t_outcome`
-- ----------------------------
DROP TABLE IF EXISTS `t_outcome`;
CREATE TABLE `t_outcome` (
  `id_outcome` int(11) NOT NULL AUTO_INCREMENT,
  `kd_anggota` int(11) DEFAULT NULL,
  `tgl_outcome` datetime DEFAULT NULL,
  `jml_outcome` int(11) DEFAULT NULL,
  `ket_outcome` text,
  `pic_outcome` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_outcome`),
  KEY `key_outcome` (`kd_anggota`),
  CONSTRAINT `key_outcome` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `t_outcome`
-- ----------------------------
BEGIN;
INSERT INTO `t_outcome` VALUES ('1', '82', '2017-04-30 00:00:00', '121212', 'bbbbb', 'ssssssssssssss');
COMMIT;

-- ----------------------------
--  Table structure for `t_photo_produk`
-- ----------------------------
DROP TABLE IF EXISTS `t_photo_produk`;
CREATE TABLE `t_photo_produk` (
  `id_photo_produk` int(11) NOT NULL AUTO_INCREMENT,
  `kd_anggota` int(11) DEFAULT NULL,
  `name_photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_photo_produk`),
  KEY `kd_anggota` (`kd_anggota`),
  CONSTRAINT `key-photo` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `t_pinjaman`
-- ----------------------------
DROP TABLE IF EXISTS `t_pinjaman`;
CREATE TABLE `t_pinjaman` (
  `no_pinjaman` int(11) NOT NULL,
  `kd_jpinjaman` int(11) DEFAULT NULL,
  `kd_nasabah` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_pinjaman`),
  KEY `kd_jpinjaman` (`kd_jpinjaman`),
  KEY `kd_nasabah` (`kd_nasabah`),
  CONSTRAINT `key_jpinjaman` FOREIGN KEY (`kd_jpinjaman`) REFERENCES `m_jenis_pinjaman` (`kd_jpinjaman`),
  CONSTRAINT `key_nasabah` FOREIGN KEY (`kd_nasabah`) REFERENCES `m_nasabah` (`kd_nasabah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `t_simpan_pokok`
-- ----------------------------
DROP TABLE IF EXISTS `t_simpan_pokok`;
CREATE TABLE `t_simpan_pokok` (
  `kd_spokok` int(11) NOT NULL AUTO_INCREMENT,
  `no_spokok` int(11) DEFAULT NULL,
  `jml_bayar_spokok` varchar(255) DEFAULT NULL,
  `tgl_bayar_spokok` date DEFAULT NULL,
  `bukti_bayar_spokok` varchar(100) DEFAULT NULL,
  `kd_anggota` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`kd_spokok`),
  KEY `kd_anggota` (`kd_anggota`),
  CONSTRAINT `key_anggota_simpan_pokok` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `t_simpan_pokok`
-- ----------------------------
BEGIN;
INSERT INTO `t_simpan_pokok` VALUES ('19', null, '123', '2017-04-17', '41332.jpg', '82', '2'), ('21', null, '1', '2017-04-19', '14857.jpg', '82', '2'), ('23', null, '1231231', '2017-05-25', null, '82', '1');
COMMIT;

-- ----------------------------
--  Table structure for `t_simpan_sukarela`
-- ----------------------------
DROP TABLE IF EXISTS `t_simpan_sukarela`;
CREATE TABLE `t_simpan_sukarela` (
  `kd_ssukarela` int(11) NOT NULL AUTO_INCREMENT,
  `no_ssukarela` int(11) DEFAULT NULL,
  `kd_anggota` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_ssukarela`),
  KEY `kd_anggota` (`kd_anggota`),
  CONSTRAINT `key_anggota_sukarela` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `t_simpan_wajib`
-- ----------------------------
DROP TABLE IF EXISTS `t_simpan_wajib`;
CREATE TABLE `t_simpan_wajib` (
  `kd_swajib` int(11) NOT NULL AUTO_INCREMENT,
  `jml_bayar_wajib` varchar(100) DEFAULT NULL,
  `bkt_bayar_wajib` varchar(100) DEFAULT NULL,
  `tgl_bayar_wajib` date DEFAULT NULL,
  `no_swajib` int(11) DEFAULT NULL,
  `kd_anggota` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`kd_swajib`),
  KEY `kd_anggota` (`kd_anggota`),
  KEY `kd_anggota_2` (`kd_anggota`),
  KEY `kd_anggota_3` (`kd_anggota`),
  KEY `kd_anggota_4` (`kd_anggota`),
  CONSTRAINT `key_anggota_simpan_wajib` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `t_simpan_wajib`
-- ----------------------------
BEGIN;
INSERT INTO `t_simpan_wajib` VALUES ('18', '20', '98746.jpg', '2017-04-26', null, '82', '1'), ('20', '12', '38471.jpg', '2017-04-19', null, '82', '0');
COMMIT;

-- ----------------------------
--  Table structure for `t_simpanan`
-- ----------------------------
DROP TABLE IF EXISTS `t_simpanan`;
CREATE TABLE `t_simpanan` (
  `no_simpanan` int(11) NOT NULL,
  `kd_nasabah` int(11) DEFAULT NULL,
  `kd_jsimpanan` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_simpanan`),
  KEY `kd_nasabah` (`kd_nasabah`),
  KEY `kd_jsimpanan` (`kd_jsimpanan`),
  CONSTRAINT `key_kd_jsimpanan` FOREIGN KEY (`kd_jsimpanan`) REFERENCES `m_jenis_simpanan` (`kd_jsimpanan`),
  CONSTRAINT `key_kd_nasabah_simpanan` FOREIGN KEY (`kd_nasabah`) REFERENCES `m_nasabah` (`kd_nasabah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `t_simpanan_bunga`
-- ----------------------------
DROP TABLE IF EXISTS `t_simpanan_bunga`;
CREATE TABLE `t_simpanan_bunga` (
  `id` int(11) NOT NULL,
  `no_simpanan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `no_simpanan` (`no_simpanan`),
  CONSTRAINT `key_simpanan_bunga` FOREIGN KEY (`no_simpanan`) REFERENCES `t_simpanan` (`no_simpanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `t_simpanan_transaksi`
-- ----------------------------
DROP TABLE IF EXISTS `t_simpanan_transaksi`;
CREATE TABLE `t_simpanan_transaksi` (
  `kd_transaksi` int(11) NOT NULL,
  `no_simpanan` int(11) DEFAULT NULL,
  PRIMARY KEY (`kd_transaksi`),
  KEY `no_simpanan` (`no_simpanan`),
  CONSTRAINT `key_no_simpanan` FOREIGN KEY (`no_simpanan`) REFERENCES `t_simpanan` (`no_simpanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `team`
-- ----------------------------
DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `social` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `team`
-- ----------------------------
BEGIN;
INSERT INTO `team` VALUES ('3', 'Si Fulan', 'CEO', 'CEO', 'a:4:{s:2:\"fb\";s:0:\"\";s:2:\"tw\";s:0:\"\";s:2:\"ig\";s:0:\"\";s:2:\"gp\";s:0:\"\";}'), ('6', 'Test', 'test', 'test', 'a:4:{s:2:\"fb\";s:0:\"\";s:2:\"tw\";s:0:\"\";s:2:\"ig\";s:0:\"\";s:2:\"gp\";s:0:\"\";}'), ('8', 'Kenway', 'Captain', 'Black Flag Captain', 'a:4:{s:2:\"fb\";s:0:\"\";s:2:\"tw\";s:0:\"\";s:2:\"ig\";s:0:\"\";s:2:\"gp\";s:0:\"\";}'), ('9', 'test', 'TEst', 'test', 'a:4:{s:2:\"fb\";s:0:\"\";s:2:\"tw\";s:0:\"\";s:2:\"ig\";s:0:\"\";s:2:\"gp\";s:0:\"\";}');
COMMIT;

-- ----------------------------
--  Table structure for `testimonial`
-- ----------------------------
DROP TABLE IF EXISTS `testimonial`;
CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) NOT NULL,
  `customer_status` varchar(50) NOT NULL,
  `testimoni` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `testimonial`
-- ----------------------------
BEGIN;
INSERT INTO `testimonial` VALUES ('1', 'Patrick', 'Spongebob Actor', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam. ', '1'), ('2', 'Spongebob', 'Spongebob Actor', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam. ', '1'), ('4', 'Jokowi', 'President ', 'Good game well played... eazy peazy', '1'), ('5', 'Mark Zuckenberg', 'CEO of FB', 'Good game well played... eazy peazy', '1');
COMMIT;

-- ----------------------------
--  Table structure for `user_level`
-- ----------------------------
DROP TABLE IF EXISTS `user_level`;
CREATE TABLE `user_level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(50) NOT NULL,
  `rules` text NOT NULL,
  PRIMARY KEY (`id_level`),
  UNIQUE KEY `level_name` (`level_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `user_level`
-- ----------------------------
BEGIN;
INSERT INTO `user_level` VALUES ('1', 'Super Admin', '1'), ('2', 'Admin', 'a:31:{i:0;s:21:\"admin/guest_book_read\";i:1;s:23:\"admin/guest_book/delete\";i:2;s:25:\"admin/mediamanager/delete\";i:3;s:18:\"admin/carousel/add\";i:4;s:19:\"admin/carousel/edit\";i:5;s:21:\"admin/carousel/delete\";i:6;s:17:\"admin/project/add\";i:7;s:18:\"admin/project/edit\";i:8;s:20:\"admin/project/delete\";i:9;s:21:\"admin/project/setting\";i:10;s:26:\"admin/project/category/add\";i:11;s:27:\"admin/project/category/edit\";i:12;s:29:\"admin/project/category/delete\";i:13;s:15:\"admin/skill/add\";i:14;s:16:\"admin/skill/edit\";i:15;s:18:\"admin/skill/delete\";i:16;s:19:\"admin/skill/setting\";i:17;s:14:\"admin/team/add\";i:18;s:15:\"admin/team/edit\";i:19;s:17:\"admin/team/delete\";i:20;s:18:\"admin/team/setting\";i:21;s:13:\"admin/setting\";i:22;s:20:\"admin/setting/footer\";i:23;s:27:\"admin/setting/footer/social\";i:24;s:16:\"admin/guest_book\";i:25;s:18:\"admin/mediamanager\";i:26;s:14:\"admin/carousel\";i:27;s:13:\"admin/project\";i:28;s:22:\"admin/project/category\";i:29;s:11:\"admin/skill\";i:30;s:10:\"admin/team\";}'), ('3', 'poster', 'a:5:{i:0;s:14:\"admin/post/add\";i:1;s:15:\"admin/post/edit\";i:2;s:17:\"admin/post/delete\";i:3;s:18:\"admin/post/setting\";i:4;s:10:\"admin/post\";}'), ('4', 'Anggota', 'a:5:{i:0;s:14:\"admin/post/add\";i:1;s:15:\"admin/post/edit\";i:2;s:17:\"admin/post/delete\";i:3;s:18:\"admin/post/setting\";i:4;s:10:\"admin/post\";}');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_grp` int(11) DEFAULT NULL,
  `uname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_anggota` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `id_level` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`),
  KEY `user_grp` (`user_grp`),
  CONSTRAINT `user_group_menu` FOREIGN KEY (`user_grp`) REFERENCES `menu_group` (`user_grp`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('9', '1', 'admin', null, 'admin@admin.com', '$2y$10$PmcUVEJRgmmIEBQxKL/pzeHMsmjLZYEnUxvjFk5oosm1yskMtohVi', '1', 'irCsm1i2HubTYZ3LGpRsXsqEqYKpZKXagIEfAB67nID7rceVgnQNJ3GhodnW'), ('26', '5', 'Rifky000', null, '', '$2y$10$9mYNEXKrW4Pt.SkizYO6Tu9mlrod0ogK/ClBnTRgkY85AWvyptIle', '4', null), ('27', '5', 'Rifkyxxx', null, 'rifky@kudo.co.id', '$2y$10$T6W7T2jyzsdXBmYEOJTXQ.09TO4Oosyc97UwpbrqHjEPiLscHJxji', '5', null), ('28', '5', 'Rifky222', null, '', '$2y$10$ahPaJvALdLElOypkiMel8ONl55tNvU6ID0nkH3z2lUaNrgPq0tgFG', '4', null), ('29', '5', 'asdfasfda234', null, '', '$2y$10$BbFzgeZ62X0EQiTFc6qT/OxvQrDYnObFzWfxVIzHgUD/mC6CBQAq.', '4', 'gIqLz8Anep6HtHhPv33owfZALZTLPmAtKqmPuQ8Jy8exgsqPcsNR7IfY1mry'), ('30', '5', 'xxx098908090', null, '', '$2y$10$NLIHlUBjTFIOPcuSvO2HYeQXTwYQervxTQBSbhmQ2uO8k0ghgzIx.', '4', null), ('31', '5', 'rr979', null, '', '$2y$10$jRdxKi2ZA50QzyMyRHMX/.emVxz2cmsI7uRI58NGME2xZvduQHMHW', '4', null), ('32', '5', 'xxx000', null, '', '$2y$10$dyED.mEsAf0oL.dFqqg.yuk9TgePZ4o9i9imwTD/KNCblbpoDLPIS', '4', null), ('33', '5', 'kiki455', null, '', '$2y$10$kKC8mxb.9QcKiBUtdi/JeemoT8r0tBTTKKdZ2DxnXKLd4jvIPC2Ku', '4', '6Jz6wAAFKtKOmfRtaBwig85fZQK3jt3VyZ9MeyLrFuixXIca7GrdT9TO9tvH'), ('34', '5', 'dodolxxx', null, 'rifky@kudo.co.id', '$2y$10$W12OLbFykdMVdEtrQxHfSesxZg0NY1T6AlWLrUFWKk/uLbZ/yYd.i', '5', null), ('35', '5', 'masuk809', null, '', '$2y$10$ERlzKW4YMn0IfUyFNC/BfupItWc3j0XqWFlkSQAoXCloQHXuIRPhC', '4', null), ('36', '5', 'huhuy080', null, '', '$2y$10$eyn3vDoDGuhxrkYOvFhKQ.0FSWXIF9rWqJR0HCLJWE0KfQve3RFRC', '4', null), ('37', '5', 'lolo231', '1231231231', '', '$2y$10$geVwDAWTB5dpPBwcsi1jDObT0gVsE3E8nZNQ8xAymkQAHZiSmFElu', '4', null), ('38', '5', 'kodokkkfas', 'asdfasdfas', '', '$2y$10$OliurUlWFp3DNIMf4h0nceXo30mPT.kyJLjhFjcsuRejzjhH0Xkci', '4', null), ('39', '5', 'asasf234', '234234', '', '$2y$10$v1dNUoKWknuS8JO78d5ul.O6YtEMMFPTXi.97O2Nw3X1eVkcstkd2', '4', null), ('40', '5', 'asfas534', '4534534', '', '$2y$10$FtKENe4tY7Pa6H8VEZIPa.cqtLEKmO41EtX8FBJlQ1PWYq18XOatO', '4', null), ('41', '5', 'aasdfasfda534', '2334534', '', '$2y$10$uMa6Z25c4aLX/dAToGrKG.iKz0OWDBUhRyFy0I7bzmxYLUgQEF35W', '4', null), ('42', '5', 'ccca234', '234234234', '', '$2y$10$A994k.LREXkuvidSh357LespfpdOsfA9NoTh5CZLqrgvQiELOYBPu', '4', null), ('43', '5', 'asfasdfas222', '2222222', '', '$2y$10$yU.Mu9PgMDIiQzzyb8ilMuHBfA5.6WNn0a14NtDWUxVfjjy106fr.', '4', null), ('44', '5', 'asdfa555', '5555555', '', '$2y$10$H1GVsgkFdkzNu3sO3mu8uufEjwt9LvDMk0dIShfoA2xRY8ce1U29q', '4', null), ('45', '5', 'ggg342', '2342342', '', '$2y$10$wbjdAGZyWD8bj7DWiIFYM.ExugdA98C3RdN8oiRR7lFMHFTtLubsO', '4', null), ('46', '5', 'asdfasfdatretertr231', '1231231', '', '$2y$10$WAX9H7wUuAX3JoOeydFVr.L.7JpqmKOTVzV2xLtIN4TyFFXvIRl32', '4', null), ('47', '5', 'asfda342', '2342342342', '', '$2y$10$T5Ws.eocvm/DJdn6nqO9Cev4AGE654W9h6TEzFtrZ2qjmXc64YTze', '4', null);
COMMIT;

-- ----------------------------
--  Table structure for `widget`
-- ----------------------------
DROP TABLE IF EXISTS `widget`;
CREATE TABLE `widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `blade_name` varchar(50) NOT NULL,
  `order_show` int(11) NOT NULL DEFAULT '1',
  `active` int(1) NOT NULL DEFAULT '0',
  `parent` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `widget`
-- ----------------------------
BEGIN;
INSERT INTO `widget` VALUES ('1', 'slide', 'carousel', '1', '1', '1'), ('2', 'process_section', 'process', '3', '0', '1'), ('3', 'skill_section', 'skill', '2', '1', '1'), ('4', 'team_section', 'team', '4', '1', '1'), ('5', 'project_section', 'project', '5', '1', '1'), ('6', 'testimonial_section', 'testi', '6', '0', '1'), ('7', 'news_section', 'latest_news', '7', '0', '1'), ('8', 'contact_section', 'contact', '0', '1', '0'), ('9', 'contact_info_section', 'contact_info', '0', '1', '0'), ('10', 'location_section', 'map', '9', '1', '1'), ('11', 'site_desc_footer', 'site_description', '0', '1', '0'), ('12', 'latest_news_footer', 'latest_news_footer', '0', '0', '0'), ('13', 'contact_us_footer', 'contact_us', '0', '1', '0'), ('14', 'social', 'social', '0', '1', '0'), ('15', 'full_contact_section', 'contact', '8', '1', '1'), ('16', 'text_footer', 'social', '1', '0', '0'), ('17', 'menu', 'menu', '1', '1', '0');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
