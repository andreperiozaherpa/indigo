-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2015 at 12:57 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `master_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id_agenda` int(5) NOT NULL AUTO_INCREMENT,
  `tema` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tema_slug` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_agenda` text COLLATE latin1_general_ci NOT NULL,
  `tempat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pengirim` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tgl_posting` date NOT NULL,
  `jam` time NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_agenda`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `agenda`
--


-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `picture` text NOT NULL,
  `pict_count` int(11) NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `album`
--


-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id_banner` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`id_banner`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `banner`
--


-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `category_slug` varchar(50) NOT NULL,
  `category_status` varchar(20) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_slug`, `category_status`) VALUES
(1, 'Programming', 'programming', 'Active'),
(2, 'Music', 'music', 'Active'),
(3, 'College', 'college', 'Active'),
(4, 'Sport', 'sport', 'Active'),
(5, 'Lounge', 'lounge', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `date`, `status`) VALUES
(1, 'nurdin', 'nurdin@yahoo.co.id', 'Complant', 'Hi, this is my message.', '2015-07-28', 'unread'),
(2, 'voor ua', 'diansh@gmail.com', 'Contact you', 'Hello.', '2015-07-28', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE IF NOT EXISTS `download` (
  `id_download` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_file` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `hits` int(3) NOT NULL,
  PRIMARY KEY (`id_download`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `download`
--


-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `gallery_title` text NOT NULL,
  `picture` text NOT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `album_id`, `gallery_title`, `picture`) VALUES
(6, 3, 'School-Name-Tag.jpg', 'School-Name-Tag.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE IF NOT EXISTS `header` (
  `id_header` int(3) NOT NULL AUTO_INCREMENT,
  `judul` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL,
  `gbr_header` varchar(250) NOT NULL,
  PRIMARY KEY (`id_header`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `header`
--


-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE IF NOT EXISTS `identitas` (
  `id_identitas` int(3) NOT NULL AUTO_INCREMENT,
  `nama` char(100) NOT NULL,
  `alamat` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `youtube` varchar(100) NOT NULL,
  `gmap` varchar(400) NOT NULL,
  `tentang` text NOT NULL,
  `instagram` varchar(250) NOT NULL,
  PRIMARY KEY (`id_identitas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama`, `alamat`, `logo`, `email`, `facebook`, `twitter`, `telepon`, `youtube`, `gmap`, `tentang`, `instagram`) VALUES
(1, 'STKIP Sebelas April Sumedang', 'Jl. Angkrek Situ No. 19 Sumedang 45323 Jawa Barat', 'comp_logo.png', 'stkipsassumedang@gmail.com', '', '@stkipsassumedang', '0261-202911', 'STKIP Sebelas April Sumedang', 'http://maps.google.com1', '<div align="center"><span style="font-family: times new roman,times; font-size: medium;"><strong>LEGALITAS PROGRAM STUDI</strong></span></div>\r\n<ol>\r\n<li><span style="font-size: small;">PENDIDIKAN BAHASA, SASTRA INDONESIA, DAN DAERAH (DIKBASASINDA) TERAKREDITASI BAN-PT - No. SK : 040/BAN-PT/Ak-XII/S1/I/2010 Tanggal 8 Januari 2010.</span></li>\r\n<li><span style="font-size: small;">PENDIDIKAN MATEMATIKA (PENMAT) TERAKREDITASI BAN-PT - No. SK : 036/BAN-PT/Ak-XII/S1/XI/2009 Tanggal 20 Nopember 2009.</span></li>\r\n<li><span style="font-size: small;">PENDIDIKAN JASMANI, KESEHATAN, DAN REKREASI (PJKR) TERAKREDITASI BAN-PT - &nbsp;No. SK : 013/BAN-PT/Ak-XIV/S1/VII/2011 Tanggal 14 Juli 2011.</span></li>\r\n<li><span style="font-size: small;">PENDIDIKAN GURU PAUD (IZIN DIRJEN DIKTI) -&nbsp;No. SK : 10499/D/T/K-IV/2012 Tanggal 16 Februari 2012</span></li>\r\n<li><span style="font-size: small;">PENDIDIKAN GURU SEKOLAH DASAR (IZIN PENYELENGGARAAN MENDIKNAS) -&nbsp;No. SK : 254/E/O/2011 Tanggal 10 Nopember 2011</span></li>\r\n<li><span style="font-size: small;">PENDIDIKAN TEKNIS MESIN (IZIN PENYELENGGARAAN MENDIKNAS) -&nbsp;No. SK : 254/E/O/2011 Tanggal 10 Nopember 2011</span></li>\r\n</ol>', 'STKIP Sas Sumedang');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `title_slug` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `tag` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `picture` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `post_status` varchar(20) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `category_id`, `title`, `title_slug`, `content`, `tag`, `date`, `time`, `picture`, `hits`, `author`, `post_status`) VALUES
(1, 5, 'Personal Website Lounch', 'personal-website-lounch', '<p>Today, friday 16 oct 2015. I decide to&nbsp;upload my website to the Internet. I hope it can be my fisrt&nbsp;step in the real job.</p>', '', '2015-10-17', '04:30:27', 'launch.jpg', 2, 6, 'Publish');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(50) NOT NULL,
  `project_description` text NOT NULL,
  `project_status` varchar(30) NOT NULL,
  `project_category` text NOT NULL,
  `client` varchar(50) NOT NULL,
  `testimonials` text NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_description`, `project_status`, `project_category`, `client`, `testimonials`) VALUES
(3, 'Cluster Management System', 'Sistem informasi internal CV. Akar Daya Mandiri', 'Finished', 'Web;', '', ''),
(4, 'Nilai siswa SMA', 'Nilai siswa SMA', 'Finished', 'Desktop;', '', ''),
(5, 'Surat kelengkapan pendamping ijazah (SKPI)', 'Project skripsi mahasiswa Universitas Langlangbuana', 'Finished', 'Web;', '', ''),
(6, 'Sistem Informasi Perizinan IMB', 'Project skripsi mahasiswa STMIK Sumedang.', 'Finished', 'Web;', '', ''),
(7, 'Sistem Informasi Inventaris barang', 'Project skripsi mahasiswa STMIK Sumedang.', 'Finished', 'Web;', '', ''),
(8, 'Aplikasi Penggajian', 'Project work mahasiswa universitas Langlangbuana di CV. Akar Daya Mandiri', 'Finished', 'Desktop;', '', ''),
(9, 'Manajemen Arsip', 'Sistem Informasi Majajemen Arsip di Desa Mekarmukti Kec. Cihampelas Kab. Bandung Barat', 'Finished', 'Web;', 'Sekdes Mekarmukti', 'Saya mengucapkan terima kasih kepada kang Arif yang telah membuat SIMA (sistem manjemen arsip) di desa kami.'),
(10, 'Simple Measure', 'Aplikasi Pengukur Ketinggian Benda berbasis Android', 'Finished', 'Android;', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `project_category`
--

CREATE TABLE IF NOT EXISTS `project_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `project_category`
--

INSERT INTO `project_category` (`category_id`, `category`) VALUES
(1, 'Web'),
(2, 'Android'),
(3, 'Desktop');

-- --------------------------------------------------------

--
-- Table structure for table `project_picture`
--

CREATE TABLE IF NOT EXISTS `project_picture` (
  `pict_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `picture` varchar(50) NOT NULL,
  PRIMARY KEY (`pict_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `project_picture`
--

INSERT INTO `project_picture` (`pict_id`, `project_id`, `picture`) VALUES
(1, 3, 'cms-3.png'),
(2, 3, 'cms-1.png'),
(3, 3, 'cms-2.png'),
(4, 3, 'cms-4.png'),
(5, 3, 'cms-5.png'),
(6, 3, 'cms-6.png'),
(7, 10, 'Screenshot_2015-09-21-14-52-20.png'),
(8, 10, 'Screenshot_2015-08-11-14-02-05.png'),
(9, 10, 'Screenshot_2015-09-21-14-53-24.png'),
(10, 10, 'Screenshot_2015-08-11-14-03-31.png'),
(12, 8, 'gaji.png'),
(13, 8, 'rekap gaji adm.png'),
(14, 8, 'grafik bulanan.png'),
(15, 8, 'slip adm.png'),
(16, 9, 'sima-1.png'),
(17, 9, 'sima-2.png'),
(18, 9, 'sima-3.png'),
(19, 5, 'skpi-2.png'),
(20, 5, 'skpi-1.png'),
(21, 5, 'skpi-3.png'),
(22, 6, 'imb-4.png'),
(23, 6, 'imb-1.png'),
(24, 6, 'imb-2.png'),
(25, 6, 'imb-5.png'),
(26, 6, 'imb-3.png'),
(27, 7, 'sibi-3.png'),
(28, 7, 'sibi-2.png'),
(29, 7, 'sibi-1.png');

-- --------------------------------------------------------

--
-- Table structure for table `sambutan`
--

CREATE TABLE IF NOT EXISTS `sambutan` (
  `id_sambutan` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `foto` varchar(250) NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`id_sambutan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sambutan`
--

INSERT INTO `sambutan` (`id_sambutan`, `nama`, `jabatan`, `foto`, `isi`) VALUES
(1, 'Arif', 'Kabid', 'default.png', '<p>isi sambutan.</p>'),
(2, 'Nandang', 'Kadis', 'member02.jpg', '<p>isi sambutan nya disini. edit</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(50) NOT NULL,
  `tag_slug` varchar(50) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`, `tag_slug`) VALUES
(1, 'PHP', 'php'),
(2, 'Android', 'android'),
(3, 'Guitar', 'guitar'),
(4, 'Persib', 'persib');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `bio` text NOT NULL,
  `user_picture` varchar(50) NOT NULL,
  `user_level` int(11) NOT NULL,
  `reg_date` date NOT NULL,
  `user_status` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `full_name`, `email`, `phone`, `bio`, `user_picture`, `user_level`, `reg_date`, `user_status`) VALUES
(6, 'admin', '202cb962ac59075b964b07152d234b70', 'Arif Nurdian', 'arif-letters@live.com', '085320165424', 'No god excepted Alloh.', 'member02.jpg', 1, '2015-07-14', 'Active'),
(7, 'nandang', '202cb962ac59075b964b07152d234b70', 'Nandang Koswara', '', '', '', 'user_default.png', 2, '2015-07-28', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(30) NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`level_id`, `level`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `visimisi`
--

CREATE TABLE IF NOT EXISTS `visimisi` (
  `id_vm` int(1) NOT NULL AUTO_INCREMENT,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `tujuan` text NOT NULL,
  PRIMARY KEY (`id_vm`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `visimisi`
--

INSERT INTO `visimisi` (`id_vm`, `visi`, `misi`, `tujuan`) VALUES
(1, '<p>Pada tahun 2022 menjadi perguruan tinggi yang handal dan terdepan di tingkat nasional dalam penyelenggaraan Tri Dharma Perguruan Tinggi untuk menghasilkan lulusan tenaga pendidik yang kompeten, inovatif, dan profesional serta mampu mengamalkan ilmu pengetahuan yang dimilikinya untuk kepentingan masyarakat, bangsa, dan negara1.</p>', '<p>Menyelenggarakan pendidikan, penelitian, dan pengabdian kepada masyarakat dalam bidang keguruan dan ilmu pendidikan yang berorientasi pada perubahan dan kebutuhan masyarakat yang semakin maju, baik secara kualitatif maupun kuantitatif, menata dan mengembangkan iptek dan kehidupan akademik yang profesional, sehat, dinamis, dan inovatif dalam suasana kekeluargaan yang dilandasi oleh semangat dan ketulusan untuk membangun bangsa dan negara1.</p>', '<p>Membentuk tenaga pendidik yang kompeten, inovatif, dan profesional, berwawasan luas serta peduli terhadap pendidikan dan segala permasalahannya, memiliki penguasaan yang mendalam dalam bidang ilmu yang menjadi keahliannya, mampu mengelola dan meningkatkan pelaksanaan fungsi profesionalnya, terampil, dan mampu mengamalkan ilmu yang dimilikinya untuk kepentingan masyarakat, bangsa, dan negara1.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE IF NOT EXISTS `visitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id`, `ip_address`, `date`) VALUES
(1, '127.0.0.1', '2015-10-19');
