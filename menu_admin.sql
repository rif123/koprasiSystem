-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2017 at 03:46 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koprasibaru`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_admin`
--

CREATE TABLE `menu_admin` (
  `id_menu` int(10) NOT NULL,
  `level_menu` smallint(6) NOT NULL,
  `parent_menu` int(10) NOT NULL,
  `posisition_menu` tinyint(4) NOT NULL,
  `url_menu` varchar(100) NOT NULL,
  `name_menu` varchar(100) NOT NULL,
  `icon_menu` varchar(50) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `creator` varchar(100) DEFAULT NULL,
  `edited` timestamp NULL DEFAULT NULL,
  `editor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_admin`
--

INSERT INTO `menu_admin` (`id_menu`, `level_menu`, `parent_menu`, `posisition_menu`, `url_menu`, `name_menu`, `icon_menu`, `created`, `creator`, `edited`, `editor`) VALUES
(201, 0, 0, 1, 'admin', 'Home', 'android', '2017-04-01 07:53:01', 'Admin DB', '2017-04-01 07:53:05', NULL),
(202, 0, 0, 1, 'admin/profile', 'Profile', NULL, '2017-04-01 07:54:17', 'Admin DB', '2017-04-01 07:54:32', NULL),
(205, 0, 0, 1, 'config/group', 'Config', 'book', '2017-04-01 16:54:59', 'Admin DB', '2017-04-01 16:55:07', NULL),
(206, 0, 205, 1, 'admin/config/menu', 'Menu', NULL, '2017-04-01 16:55:42', 'Admin DB', '2017-04-01 16:55:53', NULL),
(207, 0, 205, 1, 'admin/config/role', 'Role', NULL, '2017-04-01 16:56:34', 'Admin DB', '2017-04-01 16:56:42', NULL),
(208, 0, 205, 1, 'admin/config/group', 'Group', NULL, '2017-04-01 16:57:41', 'Admin DB', '2017-04-01 16:57:49', NULL),
(212, 0, 0, 0, 'admin/fe', 'Frontend Manager', NULL, '2017-04-08 15:23:49', NULL, NULL, NULL),
(213, 0, 0, 0, 'admin/guest_book', 'Guest Book', NULL, '2017-04-08 15:25:14', NULL, NULL, NULL),
(214, 0, 0, 0, 'admin/mediamanager', 'Media Manager', NULL, '2017-04-08 15:25:56', NULL, NULL, NULL),
(215, 0, 0, 0, 'admin/menu', 'Menu', NULL, '2017-04-08 15:26:17', NULL, NULL, NULL),
(216, 0, 0, 0, 'admin/form', 'Form', NULL, '2017-04-08 15:27:38', NULL, NULL, NULL),
(217, 0, 0, 0, 'admin/settting', 'Settings', NULL, '2017-04-08 15:29:57', NULL, NULL, NULL),
(218, 0, 0, 0, 'admin/user', 'User', NULL, '2017-04-08 15:30:43', NULL, NULL, NULL),
(219, 0, 218, 0, 'admin/user', 'User', NULL, '2017-04-08 15:31:10', NULL, NULL, NULL),
(220, 0, 218, 0, 'admin/user_level', 'User Group', NULL, '2017-04-08 15:32:49', NULL, NULL, NULL),
(221, 0, 216, 0, 'admin/carousel', 'Slide', NULL, '2017-04-08 15:33:53', NULL, NULL, NULL),
(222, 0, 216, 0, 'admin/post', 'Post', NULL, '2017-04-08 15:34:20', NULL, NULL, NULL),
(223, 0, 216, 0, 'admin/process_text', 'Process Text', NULL, '2017-04-08 15:34:48', NULL, NULL, NULL),
(224, 0, 216, 0, 'admin/prj', 'Project', NULL, '2017-04-08 15:35:16', NULL, NULL, NULL),
(225, 0, 224, 0, 'admin/project', 'Project', NULL, '2017-04-08 15:35:41', NULL, NULL, NULL),
(226, 0, 224, 0, 'admin/project/category', 'Project Category', NULL, '2017-04-08 15:36:17', NULL, NULL, NULL),
(227, 0, 216, 0, 'admin/skill', 'Skill', NULL, '2017-04-08 15:36:50', NULL, NULL, NULL),
(228, 0, 216, 0, 'admin/team', 'Team', NULL, '2017-04-08 15:37:10', NULL, NULL, NULL),
(229, 0, 216, 0, 'admin/testimonial', 'Testimonial', NULL, '2017-04-08 15:37:30', NULL, NULL, NULL),
(230, 0, 217, 0, 'admin/setting', 'General', NULL, '2017-04-08 15:39:07', NULL, NULL, NULL),
(231, 0, 217, 0, 'Footer', 'Footers', NULL, '2017-04-08 15:39:32', NULL, NULL, NULL),
(232, 0, 231, 0, 'admin/setting/footer', 'Footer Text', 'volume_down', '2017-04-08 15:39:58', NULL, NULL, NULL),
(233, 0, 231, 0, 'admin/setting/footer/social', 'Social Link', NULL, '2017-04-08 15:40:50', NULL, NULL, NULL),
(234, 0, 217, 0, 'admin/setting/location', 'Location', NULL, '2017-04-08 15:41:25', NULL, NULL, NULL),
(235, 0, 217, 0, 'admin/setting/profile', 'Profile', NULL, '2017-04-08 15:41:48', NULL, NULL, NULL),
(236, 0, 217, 0, 'admin/contact', 'Contact', 'favorite', '2017-04-08 15:42:28', NULL, NULL, NULL),
(237, 0, 0, 0, 'simpanan', 'Simpanan Anggota', 'save', '2017-04-09 05:29:11', NULL, NULL, NULL),
(238, 0, 237, 0, 'admin/simpanan/wajib', 'Wajib', 'card_giftcard', '2017-04-09 05:30:16', NULL, NULL, NULL),
(239, 0, 237, 0, 'admin/simpanan/pokok', 'Pokok', 'card_travel', '2017-04-09 05:31:20', NULL, NULL, NULL),
(241, 0, 0, 0, 'keuangan', 'Keuangan Koprasi', 'payment', '2017-04-15 02:25:30', NULL, NULL, NULL),
(242, 0, 0, 0, 'admin/keuangan', 'Koperasi', 'payment', '2017-04-15 02:26:15', NULL, NULL, NULL),
(243, 0, 259, 0, 'admin/anggota', 'Generate Token Anggota', 'fingerprint', '2017-04-15 03:44:59', NULL, NULL, NULL),
(244, 0, 237, 0, 'admin/simpan-wajib', 'Simpanan Wajib', 'description', '2017-04-19 07:59:25', NULL, NULL, NULL),
(245, 0, 237, 0, 'admin/simpan-pokok', 'Simpanan Pokok', 'description', '2017-04-20 16:11:28', NULL, NULL, NULL),
(246, 0, 259, 0, 'admin/config/controll-Pay', 'Pembayaran Simpanan', 'settings', '2017-04-22 14:23:52', NULL, NULL, NULL),
(248, 0, 259, 0, 'admin/management/income', 'Income', 'dns', '2017-04-28 15:40:54', NULL, NULL, NULL),
(249, 0, 259, 0, 'admin/management/outcome', 'Outcome', 'dns', '2017-04-28 15:41:31', NULL, NULL, NULL),
(250, 0, 259, 0, 'admin/management/report', 'Report Keuangan', 'assignment', '2017-04-29 05:17:51', NULL, NULL, NULL),
(251, 0, 237, 0, 'admin/simpan-wajib-read', 'User Only Simpan Wajib', 'save', '2017-04-30 13:19:17', NULL, NULL, NULL),
(252, 0, 241, 0, 'admin/keuangan/income', 'Income', 'payment', '2017-05-06 04:41:49', NULL, NULL, NULL),
(253, 0, 241, 0, 'admin/keuangan/outcome', 'Outcome', 'card_giftcard', '2017-05-06 04:42:49', NULL, NULL, NULL),
(254, 0, 259, 0, 'admin/config/anggota', 'Anggota', 'verified_user', '2017-05-06 16:30:12', NULL, NULL, NULL),
(255, 0, 259, 0, 'admin/management/view-income', 'View Income', 'assignment_return', '2017-05-08 13:46:11', NULL, NULL, NULL),
(256, 0, 259, 0, 'admin/management/view-outcome', 'View Outcome', 'exit_to_app', '2017-05-08 13:47:48', NULL, NULL, NULL),
(257, 0, 259, 0, 'admin/jenis-Usaha', 'Jenis Usaha', 'credit_card', '2017-05-09 07:34:24', NULL, NULL, NULL),
(258, 0, 259, 0, 'admin/config/news', 'Infomrmasi Internal', 'art_track', '2017-05-10 18:18:01', NULL, NULL, NULL),
(259, 0, 0, 0, '/', 'Manage WJS', 'content_paste', '2017-05-15 16:24:48', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_admin`
--
ALTER TABLE `menu_admin`
  ADD PRIMARY KEY (`id_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_admin`
--
ALTER TABLE `menu_admin`
  MODIFY `id_menu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
