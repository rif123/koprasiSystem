-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2017 at 03:32 AM
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
(230, 0, 217, 0, 'admin/setting', 'General', NULL, '2017-04-08 15:39:07', NULL, NULL, NULL);

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
