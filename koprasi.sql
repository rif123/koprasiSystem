-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2017 at 03:04 AM
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
  `nm_anggota` varchar(100) DEFAULT NULL,
  `kd_jabatan` int(11) DEFAULT NULL,
  `pasPhoto_anggota` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_anggota`
--

INSERT INTO `m_anggota` (`kd_anggota`, `nm_anggota`, `kd_jabatan`, `pasPhoto_anggota`) VALUES
(1, 'Rifky', 1, 'Kosong');

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
  `hki_docLegal` varchar(100) DEFAULT NULL,
  `merk_docLegal` varchar(100) DEFAULT NULL,
  `lainnya_docLegal` varchar(100) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
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

--
-- Dumping data for table `m_data_pribadi`
--

INSERT INTO `m_data_pribadi` (`kd_data_pribadi`, `kd_anggota`, `tempat_lahir_pribadi`, `npwp_pribadi`, `noHp_pribadi`, `email_pribadi`, `alamat_pribadi`, `rtRw_pribadi`, `kec_pribadi`, `desKel_pribadi`, `wubTahun_pribadi`, `wubDinas_pribadi`, `created`, `create_date`, `updated`, `update_date`) VALUES
(2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-28 20:41:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_data_usaha`
--

CREATE TABLE `m_data_usaha` (
  `kd_usaha` int(11) NOT NULL,
  `kd_anggota` int(11) DEFAULT NULL,
  `brand_usaha` varchar(100) DEFAULT NULL,
  `jenisProd_usaha` varchar(100) DEFAULT NULL,
  `alamat_usaha` text,
  `rtRw_usaha` varchar(20) DEFAULT NULL,
  `kec_usaha` varchar(50) DEFAULT NULL,
  `kabKot_usaha` varchar(50) DEFAULT NULL,
  `kapasitas_usaha` varchar(100) DEFAULT NULL,
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
(1, 'Programmer');

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
  `tgl_spokok` varchar(50) DEFAULT NULL,
  `kd_anggota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `no_swajib` int(11) DEFAULT NULL,
  `kd_anggota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `uname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `id_level` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `email`, `password`, `id_level`, `remember_token`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$kTJwyteB13BiPx6zjARaFOh54Ps/GljcLez7xNWazYfODEa13GDZa', 1, 'PAt6zvWuj1eIvloUEvm6l8MDnrKaRR3LI9xs9w7VK9Vf0W3QiGKEErSITUZw'),
(7, 'admintoko', 'hatakeonez@gmail.com', '$2y$10$AqkLEdiU7mKcSNy0e49J6eDLOipzLijshcgvQu6/uk3youZ7QolQ2', 2, 'DUHvjdUZgYF9215pCqASVtb9UUuTjK3PgK8okd62ITNrPXIsXMjhZb6rXhEH'),
(8, 'test', 'test@test.com', '$2y$10$YYAIO8T21OiDSOezG4E3JOSPf.kngu6gSPOXWHE9.l0rmTXWqdlPK', 3, NULL);

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
-- Indexes for table `m_anggota`
--
ALTER TABLE `m_anggota`
  ADD PRIMARY KEY (`kd_anggota`),
  ADD KEY `kd_jabatan` (`kd_jabatan`);

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
  ADD KEY `id_level` (`id_level`);

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
-- AUTO_INCREMENT for table `m_anggota`
--
ALTER TABLE `m_anggota`
  MODIFY `kd_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `m_data_docLegal`
--
ALTER TABLE `m_data_docLegal`
  MODIFY `kd_docLegal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_data_pribadi`
--
ALTER TABLE `m_data_pribadi`
  MODIFY `kd_data_pribadi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_data_usaha`
--
ALTER TABLE `m_data_usaha`
  MODIFY `kd_usaha` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  MODIFY `kd_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `kd_spokok` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_simpan_sukarela`
--
ALTER TABLE `t_simpan_sukarela`
  MODIFY `kd_ssukarela` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_simpan_wajib`
--
ALTER TABLE `t_simpan_wajib`
  MODIFY `kd_swajib` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
-- Constraints for table `m_anggota`
--
ALTER TABLE `m_anggota`
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
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `user_level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
