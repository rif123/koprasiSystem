-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2017 at 11:51 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koprasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `text_top` varchar(25) NOT NULL,
  `text_middle` varchar(25) NOT NULL,
  `button_text` varchar(25) NOT NULL,
  `button_link` varchar(50) NOT NULL DEFAULT '#',
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `title`, `text_top`, `text_middle`, `button_text`, `button_link`, `image`) VALUES
(1, 'slide1', 'Ahli dalam menangani', 'Architecture Problem', 'Check Portofolio', '#section-portofolio', '11.jpg'),
(3, 'slide2', 'Test', 'Another Test', 'Test', '#wrapper', '18.jpg'),
(4, 'slide3', 'slide3', 'slide3', 'slide3', 'slide3', '12.jpg'),
(5, 'slide4', 'test', 'test', 'test', '/', '6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contacts_info`
--

CREATE TABLE `contacts_info` (
  `id` int(11) NOT NULL,
  `location` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `web` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts_info`
--

INSERT INTO `contacts_info` (`id`, `location`, `phone`, `fax`, `email`, `web`) VALUES
(1, 'Jl. Citarip Raya no. 15 A  Kopo Bandung', '0821 1879 3999', '022 - 20564406', 'mitrasouvenir1@gmail.com', 'http://mitrasouvenir.com');

-- --------------------------------------------------------

--
-- Table structure for table `guest_book`
--

CREATE TABLE `guest_book` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` text,
  `has_read` int(1) NOT NULL DEFAULT '0',
  `date` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest_book`
--

INSERT INTO `guest_book` (`id`, `name`, `email`, `phone`, `message`, `has_read`, `date`) VALUES
(1, 'hana', 'hana.siro6@gmail.com', '089638903697', 'Mba/mas ,saya mau tanya kalo cngkir tradisional harga.y brapa?ada min. Order?', 0, '1488908789');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `link` text NOT NULL,
  `order_show` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `link`, `order_show`) VALUES
(1, 'OUR WORK', '#section-services', 2),
(3, 'Home', '/', 1),
(5, 'Team', '#section-team', 3),
(6, 'Location', '/location', 4);

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
(237, 0, 0, 0, 'simpanan', 'Simpanan', 'save', '2017-04-09 05:29:11', NULL, NULL, NULL),
(238, 0, 237, 0, 'admin/simpanan/wajib', 'Wajib', 'card_giftcard', '2017-04-09 05:30:16', NULL, NULL, NULL),
(239, 0, 237, 0, 'admin/simpanan/pokok', 'Pokok', 'card_travel', '2017-04-09 05:31:20', NULL, NULL, NULL),
(241, 0, 0, 0, 'keuangan', 'Keuangan', 'payment', '2017-04-15 02:25:30', NULL, NULL, NULL),
(242, 0, 241, 0, 'admin/keuangan', 'Koperasi', 'payment', '2017-04-15 02:26:15', NULL, NULL, NULL),
(243, 0, 205, 0, 'admin/anggota', 'Generate Token Anggota', 'code', '2017-04-15 03:44:59', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE `menu_group` (
  `user_grp` int(11) NOT NULL,
  `group_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`user_grp`, `group_name`) VALUES
(1, 'ADMINISTRATOR'),
(2, 'TEACHER'),
(3, 'STUDENT'),
(4, 'PARENT');

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `kd_role` int(11) NOT NULL,
  `user_grp` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`kd_role`, `user_grp`, `id_menu`) VALUES
(168, 2, 201),
(169, 2, 202),
(171, 2, 205),
(172, 2, 206),
(173, 2, 207),
(174, 2, 208),
(182, 4, 205),
(586, 3, 201),
(737, 1, 201),
(738, 1, 201),
(741, 1, 202),
(742, 1, 202),
(743, 1, 205),
(744, 1, 205),
(745, 1, 206),
(746, 1, 206),
(747, 1, 207),
(748, 1, 207),
(749, 1, 208),
(750, 1, 208),
(751, 1, 243),
(752, 1, 243),
(753, 1, 212),
(754, 1, 212),
(755, 1, 213),
(756, 1, 213),
(757, 1, 214),
(758, 1, 214),
(759, 1, 215),
(760, 1, 215),
(761, 1, 216),
(762, 1, 216),
(763, 1, 221),
(764, 1, 221),
(765, 1, 222),
(766, 1, 222),
(767, 1, 223),
(768, 1, 224),
(769, 1, 223),
(770, 1, 224),
(771, 1, 225),
(772, 1, 226),
(773, 1, 225),
(774, 1, 227),
(775, 1, 226),
(776, 1, 228),
(777, 1, 227),
(778, 1, 228),
(779, 1, 229),
(780, 1, 217),
(781, 1, 229),
(782, 1, 230),
(783, 1, 217),
(784, 1, 231),
(785, 1, 230),
(786, 1, 231),
(787, 1, 232),
(788, 1, 232),
(789, 1, 233),
(790, 1, 233),
(791, 1, 234),
(792, 1, 235),
(793, 1, 234),
(794, 1, 235),
(795, 1, 236),
(796, 1, 236),
(797, 1, 218),
(798, 1, 218),
(799, 1, 219),
(800, 1, 219),
(801, 1, 220),
(802, 1, 220),
(803, 1, 237),
(804, 1, 237),
(805, 1, 238),
(806, 1, 239),
(807, 1, 238),
(808, 1, 239),
(809, 1, 241),
(810, 1, 242),
(811, 1, 241),
(812, 1, 242);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_anggota`
--

CREATE TABLE `m_anggota` (
  `kd_anggota` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nm_anggota` varchar(100) DEFAULT NULL,
  `kd_jabatan` int(11) DEFAULT NULL,
  `pasPhoto_anggota` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `m_anggota`
--

INSERT INTO `m_anggota` (`kd_anggota`, `id_users`, `nm_anggota`, `kd_jabatan`, `pasPhoto_anggota`) VALUES
(82, 9, 'Rifky', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_data_docLegal`
--

CREATE TABLE `m_data_docLegal` (
  `kd_docLegal` int(11) NOT NULL,
  `kd_anggota` int(11) DEFAULT NULL,
  `npwp_docLegal` varchar(100) DEFAULT NULL,
  `situ_docLegal` varchar(100) DEFAULT NULL,
  `siup_docLegal` varchar(100) DEFAULT NULL,
  `tdp_docLegal` varchar(100) DEFAULT NULL,
  `pirt_docLegal` varchar(100) DEFAULT NULL,
  `halal_docLegal` varchar(100) DEFAULT NULL,
  `bpom_docLegal` varchar(100) DEFAULT NULL,
  `hki_docLegal` varchar(100) DEFAULT NULL,
  `merk_docLegal` varchar(100) DEFAULT NULL,
  `lainnya_docLegal` varchar(100) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` varchar(255) DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_data_pribadi`
--

CREATE TABLE `m_data_pribadi` (
  `kd_data_pribadi` int(11) NOT NULL,
  `kd_anggota` int(11) DEFAULT NULL,
  `tempat_lahir_pribadi` varchar(100) DEFAULT NULL,
  `npwp_pribadi` varchar(100) DEFAULT NULL,
  `noHp_pribadi` varchar(100) DEFAULT NULL,
  `email_pribadi` varchar(100) DEFAULT NULL,
  `alamat_pribadi` text,
  `rtRw_pribadi` varchar(20) DEFAULT NULL,
  `kec_pribadi` varchar(50) DEFAULT NULL,
  `desKel_pribadi` varchar(50) DEFAULT NULL,
  `wubTahun_pribadi` varchar(10) DEFAULT NULL,
  `wubDinas_pribadi` varchar(50) DEFAULT NULL,
  `created` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` varchar(100) DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_data_usaha`
--

CREATE TABLE `m_data_usaha` (
  `kd_usaha` int(11) NOT NULL,
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
  `edite_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_jabatan`
--

CREATE TABLE `m_jabatan` (
  `kd_jabatan` int(11) NOT NULL,
  `nm_jabatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jabatan`
--

INSERT INTO `m_jabatan` (`kd_jabatan`, `nm_jabatan`) VALUES
(1, 'Programmer'),
(2, 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_pinjaman`
--

CREATE TABLE `m_jenis_pinjaman` (
  `kd_jpinjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_simpanan`
--

CREATE TABLE `m_jenis_simpanan` (
  `kd_jsimpanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_menu_dashboard`
--

CREATE TABLE `m_menu_dashboard` (
  `kd_menu_dashboard` int(11) NOT NULL,
  `nama_menu` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_nasabah`
--

CREATE TABLE `m_nasabah` (
  `kd_nasabah` int(11) NOT NULL,
  `nm_nasabah` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_pegawai`
--

CREATE TABLE `m_pegawai` (
  `kd_pegawai` int(11) NOT NULL,
  `nm_pegawai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_pinjaman_anggunan`
--

CREATE TABLE `m_pinjaman_anggunan` (
  `id_anggunan` int(11) NOT NULL,
  `no_pinjaman` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_pinjaman_angsuran`
--

CREATE TABLE `m_pinjaman_angsuran` (
  `no_angsuran` int(11) NOT NULL,
  `no_pinjaman` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `date` int(11) NOT NULL,
  `featured_image` varchar(25) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `text`, `date`, `featured_image`, `active`) VALUES
(2, 'TEst', '<h1>Test</h1>\r\n', 1483116527, '14.jpg', 1),
(3, 'Another Test', '<p>GAGAAGA</p>\r\n', 1483119844, '14.jpg', 1),
(4, 'Commercial Design', '<p>jgjhgjghhghhjhb hhvhvhvh</p>\r\n', 1483122781, 'bbbbbbbbb.jpg', 1),
(5, 'BUILD & INSTALL', '<p>bhfcgdrsheshgdfdhgf</p>\r\n', 1483122797, '13.jpg', 1),
(6, 'Lorem Ipsum', '<h1>The standard Lorem Ipsum passage, used since the 1500s</h1>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>\r\n\r\n<p><img src=\"http://fh.dev/images/image-gallery/14.jpg\" style=\"height:346px; width:554px\" />&#39;</p>\r\n', 1483170029, '15.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `process_text`
--

CREATE TABLE `process_text` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `textbox` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `process_text`
--

INSERT INTO `process_text` (`id`, `title`, `textbox`) VALUES
(1, 'MEET & AGREE', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam. '),
(2, 'IDEA & CONCEPT', ' Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam.\r\n'),
(3, 'DESIGN & CREATE', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam. '),
(4, 'BUILD & INSTALL', 'First we will build that thing... and that we will install in on your computer');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `client` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured_image` varchar(25) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `client`, `category_id`, `featured_image`, `photo`) VALUES
(10, 'Gelas Dove Tinggi', '<p>Gelas Dove di cetak dan di press sendiri menggunakan mesin canggih buatan germany</p>\r\n\r\n<p>Tinggi gelas 125mm</p>\r\n\r\n<p>Diameter gelas 140mm</p>\r\n', 'si fulan', 4, 'IMG20151221143824.jpg', 'a:2:{i:0;s:21:\"IMG20151120093313.jpg\";i:1;s:21:\"IMG20151221143824.jpg\";}'),
(11, 'Souvenir Nikah', '<p>Mitra souvenir juga dapat melayani pemesanan souvenir nikah, contoh nya gelas bening dengan cetakan foto pengantin dan tanggal menikah</p>\r\n\r\n<p>Jenis gelas boleh pilih sendiri ada banyak pilihan.</p>\r\n', 'andre tauladan', 3, 'IMG20151121101551.jpg', 'a:1:{i:0;s:21:\"IMG20151121101551.jpg\";}'),
(12, 'Mug Custom', '<p>Mitra souvenir juga dapat melayani pemesanan mug souvenir atau tanda kenang-kenangan untuk berbagai instansi dan perusahaan</p>\r\n\r\n<p>Mug tersedia dalam berbagai warna dan bentuk, serta dicantumkan logo dan gambar instansi atau perusahaan</p>\r\n', 'Kementerian kelawakan dan anti hukum', 1, 'IMG20150828135459.jpg', 'a:1:{i:0;s:21:\"IMG20151120102430.jpg\";}'),
(13, 'Cangkir Baheula', '<p>Produk terbaru dari mitra souvenir adalah cangkir tradisional yang dapat di print</p>\r\n\r\n<p>dan di cetak dengan tulisan sesuai keinginan pelanggan.</p>\r\n', 'noname', 2, 'IMG20151120092521.jpg', 'a:1:{i:0;s:21:\"IMG20151120092521.jpg\";}');

-- --------------------------------------------------------

--
-- Table structure for table `projects_category`
--

CREATE TABLE `projects_category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects_category`
--

INSERT INTO `projects_category` (`category_id`, `name`) VALUES
(1, 'Mug Custom'),
(2, 'Cangkir Tradisional'),
(3, 'Gelas Bening'),
(4, 'Gelas Dove');

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id_rules` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url_slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id_rules`, `name`, `url_slug`) VALUES
(1, 'frontend_manager', 'admin/fe'),
(2, 'guest_book_read', 'admin/guest_book_read'),
(3, 'guest_book_delete', 'admin/guest_book/delete'),
(4, 'media_delete', 'admin/mediamanager/delete'),
(5, 'user_add', 'admin/user/add'),
(6, 'user_edit', 'admin/user/edit'),
(7, 'user_delete', 'admin/user/delete'),
(8, 'user_group_add', 'admin/user_level/add'),
(9, 'user_group_edit', 'admin/user_level/edit'),
(10, 'user_group_delete', 'admin/user_level/delete'),
(11, 'menu_add', 'admin/menu/add'),
(12, 'menu_edit', 'admin/menu/edit'),
(13, 'menu_delete', 'admin/menu/delete'),
(14, 'slide_add', 'admin/carousel/add'),
(15, 'slide_edit', 'admin/carousel/edit'),
(16, 'slide_delete', 'admin/carousel/delete'),
(17, 'post_add', 'admin/post/add'),
(18, 'post_edit', 'admin/post/edit'),
(19, 'post_delete', 'admin/post/delete'),
(20, 'post_setting', 'admin/post/setting'),
(21, 'process_text_add', 'admin/process_text/add'),
(22, 'process_text_edit', 'admin/process_text/edit'),
(23, 'process_text_delete', 'admin/process_text/delete'),
(24, 'process_text_setting', 'admin/process_text/setting'),
(25, 'project_add', 'admin/project/add'),
(26, 'project_edit', 'admin/project/edit'),
(27, 'project_delete', 'admin/project/delete'),
(28, 'project_setting', 'admin/project/setting'),
(29, 'project_category_add', 'admin/project/category/add'),
(30, 'project_category_edit', 'admin/project/category/edit'),
(31, 'project_category_delete', 'admin/project/category/delete'),
(32, 'skill_add', 'admin/skill/add'),
(33, 'skill_edit', 'admin/skill/edit'),
(34, 'skill_delete', 'admin/skill/delete'),
(35, 'skill_setting', 'admin/skill/setting'),
(36, 'team_add', 'admin/team/add'),
(37, 'team_edit', 'admin/team/edit'),
(38, 'team_delete', 'admin/team/delete'),
(39, 'team_setting', 'admin/team/setting'),
(40, 'testimonial_add', 'admin/testimonial/add'),
(41, 'testimonial_edit', 'admin/testimonial/edit'),
(42, 'testimonial_delete', 'admin/testimonial/delete'),
(43, 'testimonial_setting', 'admin/testimonial/setting'),
(44, 'setting_general', 'admin/setting'),
(45, 'setting_footer_text', 'admin/setting/footer'),
(46, 'setting_footer_social', 'admin/setting/footer/social'),
(47, 'setting_location', 'admin/setting/location');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_name` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_name`, `value`) VALUES
(1, 'site_title', 'Mitra Souvenir | Bandung'),
(2, 'site_description', 'Mitra Souvenir | Bandung'),
(3, 'meta_description', 'Souvenir bandung, souvenir nikah, souvenir gelas, souvenir jawa barat, souvenir Indonesia'),
(4, 'meta_keyword', 'Souvenir bandung, souvenir nikah, souvenir gelas, souvenir jawa barat, souvenir Indonesia'),
(5, 'site_logo', 'logo.png'),
(6, 'footer_text', ' ©Copyright 2017'),
(8, 'social_link', 'a:3:{i:0;a:3:{s:4:\"name\";s:8:\"facebook\";s:7:\"fa-icon\";s:11:\"fa-facebook\";s:4:\"link\";s:34:\"http://facebook.com/mitra-souvenir\";}i:1;a:3:{s:4:\"name\";s:7:\"twitter\";s:7:\"fa-icon\";s:10:\"fa-twitter\";s:4:\"link\";s:33:\"http://twitter.com/mitra souvenir\";}i:2;a:3:{s:4:\"name\";s:9:\"instagram\";s:7:\"fa-icon\";s:12:\"fa-instagram\";s:4:\"link\";s:31:\"http://instagram.com/mitra souv\";}}'),
(9, 'latitude', '-6.936582022928908'),
(10, 'longitude', '107.5847339630127'),
(11, 'marker_text', 'My location'),
(12, 'section2_title', 'OUR WORK'),
(13, 'section3_title', 'OUR PROCESS'),
(14, 'section3_background', '10.jpg'),
(15, 'section4_title', 'hana'),
(16, 'section5_title', 'TESTIMONIAL'),
(17, 'section5_background', '6.jpg'),
(18, 'section6_title', 'LATEST NEWS'),
(19, 'section6_background', '10.jpg'),
(20, 'section7_title', 'CONTACT US'),
(21, 'project_title', 'OUR WORK'),
(22, 'project_category_title', 'ALL'),
(23, 'project_button_text', 'ALL WORK'),
(24, 'project_button_link', '/project'),
(25, 'project_button_text_full', 'GET QUOTATION'),
(26, 'project_button_link_full', '#');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `title`, `description`, `image`) VALUES
(1, 'Cetak Gelas Custom', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia ', 'pic_1.jpg'),
(2, 'Souvenir Nikah', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia ', '11.jpg'),
(3, 'Souvenir Gelas', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia ', 'pic_2a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `social` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `position`, `description`, `social`) VALUES
(3, 'Si Fulan', 'CEO', 'CEO', 'a:4:{s:2:\"fb\";s:0:\"\";s:2:\"tw\";s:0:\"\";s:2:\"ig\";s:0:\"\";s:2:\"gp\";s:0:\"\";}'),
(6, 'Test', 'test', 'test', 'a:4:{s:2:\"fb\";s:0:\"\";s:2:\"tw\";s:0:\"\";s:2:\"ig\";s:0:\"\";s:2:\"gp\";s:0:\"\";}'),
(8, 'Kenway', 'Captain', 'Black Flag Captain', 'a:4:{s:2:\"fb\";s:0:\"\";s:2:\"tw\";s:0:\"\";s:2:\"ig\";s:0:\"\";s:2:\"gp\";s:0:\"\";}'),
(9, 'test', 'TEst', 'test', 'a:4:{s:2:\"fb\";s:0:\"\";s:2:\"tw\";s:0:\"\";s:2:\"ig\";s:0:\"\";s:2:\"gp\";s:0:\"\";}');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_status` varchar(50) NOT NULL,
  `testimoni` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `customer_name`, `customer_status`, `testimoni`, `active`) VALUES
(1, 'Patrick', 'Spongebob Actor', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam. ', 1),
(2, 'Spongebob', 'Spongebob Actor', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam. ', 1),
(4, 'Jokowi', 'President ', 'Good game well played... eazy peazy', 1),
(5, 'Mark Zuckenberg', 'CEO of FB', 'Good game well played... eazy peazy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_pinjaman`
--

CREATE TABLE `t_pinjaman` (
  `no_pinjaman` int(11) NOT NULL,
  `kd_jpinjaman` int(11) DEFAULT NULL,
  `kd_nasabah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_simpanan`
--

CREATE TABLE `t_simpanan` (
  `no_simpanan` int(11) NOT NULL,
  `kd_nasabah` int(11) DEFAULT NULL,
  `kd_jsimpanan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_simpanan_bunga`
--

CREATE TABLE `t_simpanan_bunga` (
  `id` int(11) NOT NULL,
  `no_simpanan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_simpanan_transaksi`
--

CREATE TABLE `t_simpanan_transaksi` (
  `kd_transaksi` int(11) NOT NULL,
  `no_simpanan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_simpan_pokok`
--

CREATE TABLE `t_simpan_pokok` (
  `kd_spokok` int(11) NOT NULL,
  `no_spokok` int(11) DEFAULT NULL,
  `jml_bayar_spokok` varchar(255) DEFAULT NULL,
  `tgl_bayar_spokok` date DEFAULT NULL,
  `bukti_bayar_spokok` varchar(100) DEFAULT NULL,
  `kd_anggota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_simpan_pokok`
--

INSERT INTO `t_simpan_pokok` (`kd_spokok`, `no_spokok`, `jml_bayar_spokok`, `tgl_bayar_spokok`, `bukti_bayar_spokok`, `kd_anggota`) VALUES
(1, NULL, '7000', '2016-07-04', '78015.jpeg', 82),
(2, NULL, '1700', '2016-06-05', '90586.png', 82),
(3, NULL, '1700', '2016-04-01', '18877.png', 82),
(4, NULL, '1700', '2016-08-01', '88150.png', 82),
(5, NULL, '7000', '2016-01-01', '80367.jpeg', 82),
(6, NULL, '7000', '2016-01-01', '91494.png', 82),
(7, NULL, '7000', '2016-01-01', '53894.png', 82),
(8, NULL, 'asdf', '2016-05-01', '71235.png', 82),
(9, NULL, 'asdf', '2016-05-01', '82771.png', 82),
(10, NULL, '10000', '2016-05-01', '17515.png', 82);

-- --------------------------------------------------------

--
-- Table structure for table `t_simpan_sukarela`
--

CREATE TABLE `t_simpan_sukarela` (
  `kd_ssukarela` int(11) NOT NULL,
  `no_ssukarela` int(11) DEFAULT NULL,
  `kd_anggota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_simpan_wajib`
--

CREATE TABLE `t_simpan_wajib` (
  `kd_swajib` int(11) NOT NULL,
  `jml_bayar_wajib` varchar(100) DEFAULT NULL,
  `bkt_bayar_wajib` varchar(100) DEFAULT NULL,
  `tgl_bayar_wajib` date DEFAULT NULL,
  `no_swajib` int(11) DEFAULT NULL,
  `kd_anggota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_simpan_wajib`
--

INSERT INTO `t_simpan_wajib` (`kd_swajib`, `jml_bayar_wajib`, `bkt_bayar_wajib`, `tgl_bayar_wajib`, `no_swajib`, `kd_anggota`) VALUES
(4, '19000', '96704.png', '2016-04-07', NULL, 82),
(5, '19000', '26215.png', '2016-05-05', NULL, 82),
(6, '19000', '92610.png', '2016-06-01', NULL, 82),
(7, '19000', '23886.png', '2016-07-07', NULL, 82),
(8, '19000', '76901.zip', '2016-04-22', NULL, 82),
(9, '19000', '79413.zip', '2016-12-15', NULL, 82),
(10, '19000', '94674.jpeg', '2016-10-05', NULL, 82),
(12, '9000', '80143.png', '2016-09-10', NULL, 82),
(13, '123456', '68948.jpeg', '2016-05-10', NULL, 82),
(14, '123456', '72346.zip', '2016-05-10', NULL, 82);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_grp` int(11) DEFAULT NULL,
  `uname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `id_level` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_grp`, `uname`, `email`, `password`, `id_level`, `remember_token`) VALUES
(9, 1, 'admin', 'admin@admin.com', '$2y$10$kTJwyteB13BiPx6zjARaFOh54Ps/GljcLez7xNWazYfODEa13GDZa', 1, 'p82guw8ZoYusdqfXbKSpyhrx8inE9AVb4koQ5SzsF0FobOFnnT9XzGi2QCOr'),
(15, 2, 'Rifky', 'rifky.rachman@gmail.com', '$2y$10$yG6TzyHZpkaNWQVT6uuAtuxHaNt.BeYZAzS.jXNIE9k1FepOtw1oC', 1, 'BSOwGb2cbIcN4qPSgW9zLAXgstHPu08wpQdjRjSqG9zMQZGN6odtiPytab7z'),
(16, 3, 'akbar', 'akbar@gmail.com', '$2y$10$GDyKw0F.GFOfA7LX.L0O8e9KJ3hegeSE14guuFmh1/.lqolaJ1PTW', 1, 'xuoS5Ipqwqa8DRVCJ835vXrUTFNklLfpJUE7rFbuz6gEfp3Mv0SaFXf4m1I5');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id_level` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL,
  `rules` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_level`, `level_name`, `rules`) VALUES
(1, 'Super Admin', '1'),
(2, 'Admin', 'a:31:{i:0;s:21:\"admin/guest_book_read\";i:1;s:23:\"admin/guest_book/delete\";i:2;s:25:\"admin/mediamanager/delete\";i:3;s:18:\"admin/carousel/add\";i:4;s:19:\"admin/carousel/edit\";i:5;s:21:\"admin/carousel/delete\";i:6;s:17:\"admin/project/add\";i:7;s:18:\"admin/project/edit\";i:8;s:20:\"admin/project/delete\";i:9;s:21:\"admin/project/setting\";i:10;s:26:\"admin/project/category/add\";i:11;s:27:\"admin/project/category/edit\";i:12;s:29:\"admin/project/category/delete\";i:13;s:15:\"admin/skill/add\";i:14;s:16:\"admin/skill/edit\";i:15;s:18:\"admin/skill/delete\";i:16;s:19:\"admin/skill/setting\";i:17;s:14:\"admin/team/add\";i:18;s:15:\"admin/team/edit\";i:19;s:17:\"admin/team/delete\";i:20;s:18:\"admin/team/setting\";i:21;s:13:\"admin/setting\";i:22;s:20:\"admin/setting/footer\";i:23;s:27:\"admin/setting/footer/social\";i:24;s:16:\"admin/guest_book\";i:25;s:18:\"admin/mediamanager\";i:26;s:14:\"admin/carousel\";i:27;s:13:\"admin/project\";i:28;s:22:\"admin/project/category\";i:29;s:11:\"admin/skill\";i:30;s:10:\"admin/team\";}'),
(3, 'poster', 'a:5:{i:0;s:14:\"admin/post/add\";i:1;s:15:\"admin/post/edit\";i:2;s:17:\"admin/post/delete\";i:3;s:18:\"admin/post/setting\";i:4;s:10:\"admin/post\";}');

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE `widget` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `blade_name` varchar(50) NOT NULL,
  `order_show` int(11) NOT NULL DEFAULT '1',
  `active` int(1) NOT NULL DEFAULT '0',
  `parent` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`id`, `name`, `blade_name`, `order_show`, `active`, `parent`) VALUES
(1, 'slide', 'carousel', 1, 1, 1),
(2, 'process_section', 'process', 3, 0, 1),
(3, 'skill_section', 'skill', 2, 1, 1),
(4, 'team_section', 'team', 4, 1, 1),
(5, 'project_section', 'project', 5, 1, 1),
(6, 'testimonial_section', 'testi', 6, 0, 1),
(7, 'news_section', 'latest_news', 7, 0, 1),
(8, 'contact_section', 'contact', 0, 1, 0),
(9, 'contact_info_section', 'contact_info', 0, 1, 0),
(10, 'location_section', 'map', 9, 1, 1),
(11, 'site_desc_footer', 'site_description', 0, 1, 0),
(12, 'latest_news_footer', 'latest_news_footer', 0, 0, 0),
(13, 'contact_us_footer', 'contact_us', 0, 1, 0),
(14, 'social', 'social', 0, 1, 0),
(15, 'full_contact_section', 'contact', 8, 1, 1),
(16, 'text_footer', 'social', 1, 0, 0),
(17, 'menu', 'menu', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts_info`
--
ALTER TABLE `contacts_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_book`
--
ALTER TABLE `guest_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_admin`
--
ALTER TABLE `menu_admin`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`user_grp`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`kd_role`),
  ADD KEY `id_group` (`user_grp`),
  ADD KEY `user_grp` (`user_grp`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_menu_2` (`id_menu`);

--
-- Indexes for table `m_anggota`
--
ALTER TABLE `m_anggota`
  ADD PRIMARY KEY (`kd_anggota`),
  ADD KEY `kd_jabatan` (`kd_jabatan`),
  ADD KEY `key_anggota` (`id_users`);

--
-- Indexes for table `m_data_docLegal`
--
ALTER TABLE `m_data_docLegal`
  ADD PRIMARY KEY (`kd_docLegal`),
  ADD KEY `kd_anggota` (`kd_anggota`);

--
-- Indexes for table `m_data_pribadi`
--
ALTER TABLE `m_data_pribadi`
  ADD PRIMARY KEY (`kd_data_pribadi`),
  ADD KEY `kd_anggota` (`kd_anggota`);

--
-- Indexes for table `m_data_usaha`
--
ALTER TABLE `m_data_usaha`
  ADD PRIMARY KEY (`kd_usaha`),
  ADD KEY `kd_anggota` (`kd_anggota`);

--
-- Indexes for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  ADD PRIMARY KEY (`kd_jabatan`);

--
-- Indexes for table `m_jenis_pinjaman`
--
ALTER TABLE `m_jenis_pinjaman`
  ADD PRIMARY KEY (`kd_jpinjaman`);

--
-- Indexes for table `m_jenis_simpanan`
--
ALTER TABLE `m_jenis_simpanan`
  ADD PRIMARY KEY (`kd_jsimpanan`);

--
-- Indexes for table `m_menu_dashboard`
--
ALTER TABLE `m_menu_dashboard`
  ADD PRIMARY KEY (`kd_menu_dashboard`);

--
-- Indexes for table `m_nasabah`
--
ALTER TABLE `m_nasabah`
  ADD PRIMARY KEY (`kd_nasabah`);

--
-- Indexes for table `m_pegawai`
--
ALTER TABLE `m_pegawai`
  ADD PRIMARY KEY (`kd_pegawai`);

--
-- Indexes for table `m_pinjaman_anggunan`
--
ALTER TABLE `m_pinjaman_anggunan`
  ADD PRIMARY KEY (`id_anggunan`),
  ADD KEY `no_pinjaman` (`no_pinjaman`);

--
-- Indexes for table `m_pinjaman_angsuran`
--
ALTER TABLE `m_pinjaman_angsuran`
  ADD PRIMARY KEY (`no_angsuran`),
  ADD KEY `no_pinjaman` (`no_pinjaman`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process_text`
--
ALTER TABLE `process_text`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects_category`
--
ALTER TABLE `projects_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id_rules`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pinjaman`
--
ALTER TABLE `t_pinjaman`
  ADD PRIMARY KEY (`no_pinjaman`),
  ADD KEY `kd_jpinjaman` (`kd_jpinjaman`),
  ADD KEY `kd_nasabah` (`kd_nasabah`);

--
-- Indexes for table `t_simpanan`
--
ALTER TABLE `t_simpanan`
  ADD PRIMARY KEY (`no_simpanan`),
  ADD KEY `kd_nasabah` (`kd_nasabah`),
  ADD KEY `kd_jsimpanan` (`kd_jsimpanan`);

--
-- Indexes for table `t_simpanan_bunga`
--
ALTER TABLE `t_simpanan_bunga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_simpanan` (`no_simpanan`);

--
-- Indexes for table `t_simpanan_transaksi`
--
ALTER TABLE `t_simpanan_transaksi`
  ADD PRIMARY KEY (`kd_transaksi`),
  ADD KEY `no_simpanan` (`no_simpanan`);

--
-- Indexes for table `t_simpan_pokok`
--
ALTER TABLE `t_simpan_pokok`
  ADD PRIMARY KEY (`kd_spokok`),
  ADD KEY `kd_anggota` (`kd_anggota`);

--
-- Indexes for table `t_simpan_sukarela`
--
ALTER TABLE `t_simpan_sukarela`
  ADD PRIMARY KEY (`kd_ssukarela`),
  ADD KEY `kd_anggota` (`kd_anggota`);

--
-- Indexes for table `t_simpan_wajib`
--
ALTER TABLE `t_simpan_wajib`
  ADD PRIMARY KEY (`kd_swajib`),
  ADD KEY `kd_anggota` (`kd_anggota`),
  ADD KEY `kd_anggota_2` (`kd_anggota`),
  ADD KEY `kd_anggota_3` (`kd_anggota`),
  ADD KEY `kd_anggota_4` (`kd_anggota`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `uname` (`uname`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `user_grp` (`user_grp`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_level`),
  ADD UNIQUE KEY `level_name` (`level_name`);

--
-- Indexes for table `widget`
--
ALTER TABLE `widget`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `contacts_info`
--
ALTER TABLE `contacts_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `guest_book`
--
ALTER TABLE `guest_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `menu_admin`
--
ALTER TABLE `menu_admin`
  MODIFY `id_menu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;
--
-- AUTO_INCREMENT for table `menu_group`
--
ALTER TABLE `menu_group`
  MODIFY `user_grp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `kd_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=813;
--
-- AUTO_INCREMENT for table `m_anggota`
--
ALTER TABLE `m_anggota`
  MODIFY `kd_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `m_data_docLegal`
--
ALTER TABLE `m_data_docLegal`
  MODIFY `kd_docLegal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_data_pribadi`
--
ALTER TABLE `m_data_pribadi`
  MODIFY `kd_data_pribadi` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_data_usaha`
--
ALTER TABLE `m_data_usaha`
  MODIFY `kd_usaha` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  MODIFY `kd_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_menu_dashboard`
--
ALTER TABLE `m_menu_dashboard`
  MODIFY `kd_menu_dashboard` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `process_text`
--
ALTER TABLE `process_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `projects_category`
--
ALTER TABLE `projects_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id_rules` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_simpan_pokok`
--
ALTER TABLE `t_simpan_pokok`
  MODIFY `kd_spokok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `t_simpan_sukarela`
--
ALTER TABLE `t_simpan_sukarela`
  MODIFY `kd_ssukarela` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_simpan_wajib`
--
ALTER TABLE `t_simpan_wajib`
  MODIFY `kd_swajib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `widget`
--
ALTER TABLE `widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD CONSTRAINT `ket_group` FOREIGN KEY (`user_grp`) REFERENCES `menu_group` (`user_grp`),
  ADD CONSTRAINT `key_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu_admin` (`id_menu`);

--
-- Constraints for table `m_anggota`
--
ALTER TABLE `m_anggota`
  ADD CONSTRAINT `key_anggota` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `key_jabatan` FOREIGN KEY (`kd_jabatan`) REFERENCES `m_jabatan` (`kd_jabatan`);

--
-- Constraints for table `m_data_docLegal`
--
ALTER TABLE `m_data_docLegal`
  ADD CONSTRAINT `key_anggota_docLegal` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`);

--
-- Constraints for table `m_data_pribadi`
--
ALTER TABLE `m_data_pribadi`
  ADD CONSTRAINT `key_anggota_pribadi` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`);

--
-- Constraints for table `m_data_usaha`
--
ALTER TABLE `m_data_usaha`
  ADD CONSTRAINT `key_anggota_usaha` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`);

--
-- Constraints for table `m_jenis_pinjaman`
--
ALTER TABLE `m_jenis_pinjaman`
  ADD CONSTRAINT `j_pinjaman` FOREIGN KEY (`kd_jpinjaman`) REFERENCES `t_pinjaman` (`kd_jpinjaman`);

--
-- Constraints for table `m_pinjaman_anggunan`
--
ALTER TABLE `m_pinjaman_anggunan`
  ADD CONSTRAINT `key_anggunan` FOREIGN KEY (`no_pinjaman`) REFERENCES `t_pinjaman` (`no_pinjaman`);

--
-- Constraints for table `m_pinjaman_angsuran`
--
ALTER TABLE `m_pinjaman_angsuran`
  ADD CONSTRAINT `key_pinjaman_angsuran` FOREIGN KEY (`no_pinjaman`) REFERENCES `t_pinjaman` (`no_pinjaman`);

--
-- Constraints for table `t_pinjaman`
--
ALTER TABLE `t_pinjaman`
  ADD CONSTRAINT `key_jpinjaman` FOREIGN KEY (`kd_jpinjaman`) REFERENCES `m_jenis_pinjaman` (`kd_jpinjaman`),
  ADD CONSTRAINT `key_nasabah` FOREIGN KEY (`kd_nasabah`) REFERENCES `m_nasabah` (`kd_nasabah`);

--
-- Constraints for table `t_simpanan`
--
ALTER TABLE `t_simpanan`
  ADD CONSTRAINT `key_kd_jsimpanan` FOREIGN KEY (`kd_jsimpanan`) REFERENCES `m_jenis_simpanan` (`kd_jsimpanan`),
  ADD CONSTRAINT `key_kd_nasabah_simpanan` FOREIGN KEY (`kd_nasabah`) REFERENCES `m_nasabah` (`kd_nasabah`);

--
-- Constraints for table `t_simpanan_bunga`
--
ALTER TABLE `t_simpanan_bunga`
  ADD CONSTRAINT `key_simpanan_bunga` FOREIGN KEY (`no_simpanan`) REFERENCES `t_simpanan` (`no_simpanan`);

--
-- Constraints for table `t_simpanan_transaksi`
--
ALTER TABLE `t_simpanan_transaksi`
  ADD CONSTRAINT `key_no_simpanan` FOREIGN KEY (`no_simpanan`) REFERENCES `t_simpanan` (`no_simpanan`);

--
-- Constraints for table `t_simpan_pokok`
--
ALTER TABLE `t_simpan_pokok`
  ADD CONSTRAINT `key_anggota_simpan_pokok` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`);

--
-- Constraints for table `t_simpan_sukarela`
--
ALTER TABLE `t_simpan_sukarela`
  ADD CONSTRAINT `key_anggota_sukarela` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`);

--
-- Constraints for table `t_simpan_wajib`
--
ALTER TABLE `t_simpan_wajib`
  ADD CONSTRAINT `key_anggota_simpan_wajib` FOREIGN KEY (`kd_anggota`) REFERENCES `m_anggota` (`kd_anggota`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_group_menu` FOREIGN KEY (`user_grp`) REFERENCES `menu_group` (`user_grp`),
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `user_level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
