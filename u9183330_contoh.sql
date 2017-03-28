-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2017 at 02:41 PM
-- Server version: 5.5.54-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u9183330_contoh`
--

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE IF NOT EXISTS `carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `text_top` varchar(25) NOT NULL,
  `text_middle` varchar(25) NOT NULL,
  `button_text` varchar(25) NOT NULL,
  `button_link` varchar(50) NOT NULL DEFAULT '#',
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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

CREATE TABLE IF NOT EXISTS `contacts_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `web` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contacts_info`
--

INSERT INTO `contacts_info` (`id`, `location`, `phone`, `fax`, `email`, `web`) VALUES
(1, 'Jl. Citarip Raya no. 15 A  Kopo Bandung', '0821 1879 3999', '022 - 20564406', 'mitrasouvenir1@gmail.com', 'http://mitrasouvenir.com');

-- --------------------------------------------------------

--
-- Table structure for table `guest_book`
--

CREATE TABLE IF NOT EXISTS `guest_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `message` text,
  `has_read` int(1) NOT NULL DEFAULT '0',
  `date` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `guest_book`
--

INSERT INTO `guest_book` (`id`, `name`, `email`, `phone`, `message`, `has_read`, `date`) VALUES
(1, 'hana', 'hana.siro6@gmail.com', '089638903697', 'Mba/mas ,saya mau tanya kalo cngkir tradisional harga.y brapa?ada min. Order?', 0, '1488908789');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `link` text NOT NULL,
  `order_show` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `date` int(11) NOT NULL,
  `featured_image` varchar(25) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `text`, `date`, `featured_image`, `active`) VALUES
(2, 'TEst', '<h1>Test</h1>\r\n', 1483116527, '14.jpg', 1),
(3, 'Another Test', '<p>GAGAAGA</p>\r\n', 1483119844, '14.jpg', 1),
(4, 'Commercial Design', '<p>jgjhgjghhghhjhb hhvhvhvh</p>\r\n', 1483122781, 'bbbbbbbbb.jpg', 1),
(5, 'BUILD & INSTALL', '<p>bhfcgdrsheshgdfdhgf</p>\r\n', 1483122797, '13.jpg', 1),
(6, 'Lorem Ipsum', '<h1>The standard Lorem Ipsum passage, used since the 1500s</h1>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>\r\n\r\n<p><img src="http://fh.dev/images/image-gallery/14.jpg" style="height:346px; width:554px" />&#39;</p>\r\n', 1483170029, '15.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `process_text`
--

CREATE TABLE IF NOT EXISTS `process_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `textbox` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `client` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured_image` varchar(25) NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `client`, `category_id`, `featured_image`, `photo`) VALUES
(10, 'Gelas Dove Tinggi', '<p>Gelas Dove di cetak dan di press sendiri menggunakan mesin canggih buatan germany</p>\r\n\r\n<p>Tinggi gelas 125mm</p>\r\n\r\n<p>Diameter gelas 140mm</p>\r\n', 'si fulan', 4, 'IMG20151221143824.jpg', 'a:2:{i:0;s:21:"IMG20151120093313.jpg";i:1;s:21:"IMG20151221143824.jpg";}'),
(11, 'Souvenir Nikah', '<p>Mitra souvenir juga dapat melayani pemesanan souvenir nikah, contoh nya gelas bening dengan cetakan foto pengantin dan tanggal menikah</p>\r\n\r\n<p>Jenis gelas boleh pilih sendiri ada banyak pilihan.</p>\r\n', 'andre tauladan', 3, 'IMG20151121101551.jpg', 'a:1:{i:0;s:21:"IMG20151121101551.jpg";}'),
(12, 'Mug Custom', '<p>Mitra souvenir juga dapat melayani pemesanan mug souvenir atau tanda kenang-kenangan untuk berbagai instansi dan perusahaan</p>\r\n\r\n<p>Mug tersedia dalam berbagai warna dan bentuk, serta dicantumkan logo dan gambar instansi atau perusahaan</p>\r\n', 'Kementerian kelawakan dan anti hukum', 1, 'IMG20150828135459.jpg', 'a:1:{i:0;s:21:"IMG20151120102430.jpg";}'),
(13, 'Cangkir Baheula', '<p>Produk terbaru dari mitra souvenir adalah cangkir tradisional yang dapat di print</p>\r\n\r\n<p>dan di cetak dengan tulisan sesuai keinginan pelanggan.</p>\r\n', 'noname', 2, 'IMG20151120092521.jpg', 'a:1:{i:0;s:21:"IMG20151120092521.jpg";}');

-- --------------------------------------------------------

--
-- Table structure for table `projects_category`
--

CREATE TABLE IF NOT EXISTS `projects_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `rules` (
  `id_rules` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url_slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rules`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

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

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

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
(8, 'social_link', 'a:3:{i:0;a:3:{s:4:"name";s:8:"facebook";s:7:"fa-icon";s:11:"fa-facebook";s:4:"link";s:34:"http://facebook.com/mitra-souvenir";}i:1;a:3:{s:4:"name";s:7:"twitter";s:7:"fa-icon";s:10:"fa-twitter";s:4:"link";s:33:"http://twitter.com/mitra souvenir";}i:2;a:3:{s:4:"name";s:9:"instagram";s:7:"fa-icon";s:12:"fa-instagram";s:4:"link";s:31:"http://instagram.com/mitra souv";}}'),
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

CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `social` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `position`, `description`, `social`) VALUES
(3, 'Si Fulan', 'CEO', 'CEO', 'a:4:{s:2:"fb";s:0:"";s:2:"tw";s:0:"";s:2:"ig";s:0:"";s:2:"gp";s:0:"";}'),
(6, 'Test', 'test', 'test', 'a:4:{s:2:"fb";s:0:"";s:2:"tw";s:0:"";s:2:"ig";s:0:"";s:2:"gp";s:0:"";}'),
(8, 'Kenway', 'Captain', 'Black Flag Captain', 'a:4:{s:2:"fb";s:0:"";s:2:"tw";s:0:"";s:2:"ig";s:0:"";s:2:"gp";s:0:"";}'),
(9, 'test', 'TEst', 'test', 'a:4:{s:2:"fb";s:0:"";s:2:"tw";s:0:"";s:2:"ig";s:0:"";s:2:"gp";s:0:"";}');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE IF NOT EXISTS `testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) NOT NULL,
  `customer_status` varchar(50) NOT NULL,
  `testimoni` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `id_level` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `uname` (`uname`),
  KEY `id_level` (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

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

CREATE TABLE IF NOT EXISTS `user_level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(50) NOT NULL,
  `rules` text NOT NULL,
  PRIMARY KEY (`id_level`),
  UNIQUE KEY `level_name` (`level_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_level`, `level_name`, `rules`) VALUES
(1, 'Super Admin', '1'),
(2, 'Admin', 'a:31:{i:0;s:21:"admin/guest_book_read";i:1;s:23:"admin/guest_book/delete";i:2;s:25:"admin/mediamanager/delete";i:3;s:18:"admin/carousel/add";i:4;s:19:"admin/carousel/edit";i:5;s:21:"admin/carousel/delete";i:6;s:17:"admin/project/add";i:7;s:18:"admin/project/edit";i:8;s:20:"admin/project/delete";i:9;s:21:"admin/project/setting";i:10;s:26:"admin/project/category/add";i:11;s:27:"admin/project/category/edit";i:12;s:29:"admin/project/category/delete";i:13;s:15:"admin/skill/add";i:14;s:16:"admin/skill/edit";i:15;s:18:"admin/skill/delete";i:16;s:19:"admin/skill/setting";i:17;s:14:"admin/team/add";i:18;s:15:"admin/team/edit";i:19;s:17:"admin/team/delete";i:20;s:18:"admin/team/setting";i:21;s:13:"admin/setting";i:22;s:20:"admin/setting/footer";i:23;s:27:"admin/setting/footer/social";i:24;s:16:"admin/guest_book";i:25;s:18:"admin/mediamanager";i:26;s:14:"admin/carousel";i:27;s:13:"admin/project";i:28;s:22:"admin/project/category";i:29;s:11:"admin/skill";i:30;s:10:"admin/team";}'),
(3, 'poster', 'a:5:{i:0;s:14:"admin/post/add";i:1;s:15:"admin/post/edit";i:2;s:17:"admin/post/delete";i:3;s:18:"admin/post/setting";i:4;s:10:"admin/post";}');

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE IF NOT EXISTS `widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `blade_name` varchar(50) NOT NULL,
  `order_show` int(11) NOT NULL DEFAULT '1',
  `active` int(1) NOT NULL DEFAULT '0',
  `parent` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `user_level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
