-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2015 at 05:50 AM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dinkes`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `tema`, `tema_slug`, `isi_agenda`, `tempat`, `pengirim`, `tgl_mulai`, `tgl_selesai`, `tgl_posting`, `jam`, `user_id`) VALUES
(2, 'Penyuluhan kesehatan', 'penyuluhan-kesehatan', 'Penyuluhan kesehatan Penyuluhan kesehatan Penyuluhan kesehatan Penyuluhan kesehatan Penyuluhan kesehatan Penyuluhan kesehatan Penyuluhan kesehatanPenyuluhan kesehatanPenyuluhan kesehatan Penyuluhan kesehatan Penyuluhan kesehatan', 'Dinkes', 'Kabid', '2015-11-01', '2015-11-01', '2015-11-01', '08:00:00', 6),
(3, 'Agendacontoh', 'agendacontoh', 'contoh', 'k', 'k', '2015-11-01', '2015-11-01', '2015-11-01', '09:00:00', 6),
(4, 'posyanduu', 'posyanduu', 'u', 'u', 'u', '2015-11-01', '2015-11-01', '2015-11-01', '09:00:00', 6);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `album_title`, `description`, `picture`, `pict_count`) VALUES
(2, 'Album 1', 'Album 1', '420989portfolio-06.jpg', 7),
(3, 'Album 2', 'Album 2', '460021portfolio-01.jpg', 3),
(4, 'Album 3', 'Album 3', '578674portfolio-03.jpg', 3),
(5, 'Album 4', 'Album 4', '793853portfolio-02.jpg', 3);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id_banner`, `judul`, `url`, `gambar`, `tgl_posting`) VALUES
(2, 'Bkd', 'sumedangkab.go.id', 'bkd.png', '2015-11-01'),
(3, 'bkpp', 'sumedangkab.go.id', 'bkbpp.png', '2015-11-01'),
(4, 'bpmpp', 'sumedangkab.go.id', 'bpmpp.png', '2015-11-01'),
(5, 'dprd', 'sumedangkab.go.id', 'dprd.png', '2015-11-01'),
(6, 'kpu', 'sumedangkab.go.id', 'kpu.png', '2015-11-01'),
(7, 'setda', 'sumedangkab.go.id', 'setdaaa.png', '2015-11-01');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_slug`, `category_status`) VALUES
(6, 'Kesehatan', 'kesehatan', 'Active'),
(7, 'Puskesmas', 'puskesmas', 'Active'),
(8, 'Promkes', 'promkes', 'Active'),
(9, 'PHBS', 'phbs', 'Active');

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
-- Table structure for table `desa`
--

CREATE TABLE IF NOT EXISTS `desa` (
  `kd_desa` varchar(10) NOT NULL,
  `kd_kecamatan` varchar(7) DEFAULT NULL,
  `desa` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`kd_desa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desa`
--

INSERT INTO `desa` (`kd_desa`, `kd_kecamatan`, `desa`) VALUES
('3211010001', '3211010', 'Cipacing'),
('3211010002', '3211010', 'Sayang'),
('3211010003', '3211010', 'Mekargalih'),
('3211010004', '3211010', 'Cinta Mulya'),
('3211010005', '3211010', 'Cisempur'),
('3211010006', '3211010', 'Jatimukti'),
('3211010007', '3211010', 'Jatiroke'),
('3211010008', '3211010', 'Hegarmanah'),
('3211010009', '3211010', 'Cikeruh'),
('3211010010', '3211010', 'Cibeusi'),
('3211010011', '3211010', 'Cileles'),
('3211010012', '3211010', 'Cilayung'),
('3211020001', '3211020', 'Mangunarga'),
('3211020002', '3211020', 'Sawahdadap'),
('3211020003', '3211020', 'Sukadana'),
('3211020004', '3211020', 'Cihanjuang'),
('3211020005', '3211020', 'Cikahuripan'),
('3211020006', '3211020', 'Sindanggalih'),
('3211020007', '3211020', 'Sindangpakuon'),
('3211020008', '3211020', 'Cimanggung'),
('3211020009', '3211020', 'Tegalmanggung'),
('3211020010', '3211020', 'Sindulang'),
('3211020011', '3211020', 'Pasirnanjung'),
('3211030001', '3211030', 'Cinanjung'),
('3211030002', '3211030', 'Raharja'),
('3211030008', '3211030', 'Gunungmanik'),
('3211030009', '3211030', 'Marga Jaya'),
('3211030010', '3211030', 'Tanjungsari'),
('3211030011', '3211030', 'Jatisari'),
('3211030012', '3211030', 'Kutamandiri'),
('3211030014', '3211030', 'Margaluyu'),
('3211030015', '3211030', 'Gudang'),
('3211030018', '3211030', 'Pasigaran'),
('3211030025', '3211030', 'Kadakajaya'),
('3211030027', '3211030', 'Cijambu'),
('3211031001', '3211031', 'Sukarapih'),
('3211031002', '3211031', 'Sukasari'),
('3211031003', '3211031', 'Mekarsari'),
('3211031004', '3211031', 'Sindangsari'),
('3211031005', '3211031', 'Nanggerang'),
('3211031006', '3211031', 'Banyuresmi'),
('3211031007', '3211031', 'Genteng'),
('3211032001', '3211032', 'Mekarbakti'),
('3211032002', '3211032', 'Cilembu'),
('3211032003', '3211032', 'Cimarias'),
('3211032004', '3211032', 'Cinanggerang'),
('3211032005', '3211032', 'Cijeruk'),
('3211032006', '3211032', 'Cigendel'),
('3211032007', '3211032', 'Haurngombong'),
('3211032008', '3211032', 'Ciptasari'),
('3211032009', '3211032', 'Citali'),
('3211032010', '3211032', 'Pamulihan'),
('3211032011', '3211032', 'Sukawangi'),
('3211040002', '3211040', 'Sukasirnarasa'),
('3211040006', '3211040', 'Pasir Biru'),
('3211040007', '3211040', 'Rancakalong'),
('3211040008', '3211040', 'Pamekaran'),
('3211040009', '3211040', 'Sukamaju'),
('3211040010', '3211040', 'Sukahayu'),
('3211040011', '3211040', 'Nagarawangi'),
('3211040012', '3211040', 'Cibunar'),
('3211040013', '3211040', 'Pangadegan'),
('3211040014', '3211040', 'Cibungur'),
('3211050001', '3211050', 'Sukajaya'),
('3211050002', '3211050', 'Margamekar'),
('3211050003', '3211050', 'Cipancar'),
('3211050004', '3211050', 'Citengah'),
('3211050007', '3211050', 'Gunasari'),
('3211050008', '3211050', 'Baginda'),
('3211050009', '3211050', 'Sukagalih'),
('3211050010', '3211050', 'Cipameungpeuk'),
('3211050011', '3211050', 'Regol Wetan'),
('3211050012', '3211050', 'Kotakulon'),
('3211050013', '3211050', 'Pasanggrahan Baru'),
('3211050014', '3211050', 'Ciherang'),
('3211050015', '3211050', 'Mekarrahayu'),
('3211050016', '3211050', 'Margalaksana'),
('3211060001', '3211060', 'Sirnamulya'),
('3211060002', '3211060', 'Girimukti'),
('3211060003', '3211060', 'Mulyasari'),
('3211060004', '3211060', 'Padasuka'),
('3211060005', '3211060', 'Margamukti'),
('3211060006', '3211060', 'Mekarjaya'),
('3211060007', '3211060', 'Jatimulya'),
('3211060008', '3211060', 'Jatihurip'),
('3211060009', '3211060', 'Kebonjati'),
('3211060010', '3211060', 'Situ'),
('3211060011', '3211060', 'Kotakaler'),
('3211060012', '3211060', 'Talun'),
('3211060013', '3211060', 'Rancamulya'),
('3211061001', '3211061', 'Cikondang'),
('3211061002', '3211061', 'Tanjunghurip'),
('3211061003', '3211061', 'Dayeuh Luhur'),
('3211061004', '3211061', 'Cikoneng'),
('3211061005', '3211061', 'Sukawening'),
('3211061006', '3211061', 'Ganeas'),
('3211061007', '3211061', 'Sukaluyu'),
('3211061008', '3211061', 'Cikoneng Kulon'),
('3211070001', '3211070', 'Bangbayang'),
('3211070002', '3211070', 'Kaduwulung'),
('3211070011', '3211070', 'Cijati'),
('3211070012', '3211070', 'Mekarmulya'),
('3211070013', '3211070', 'Cikadu'),
('3211070014', '3211070', 'Karangheuleut'),
('3211070015', '3211070', 'Cijeler'),
('3211070016', '3211070', 'Ambit'),
('3211070017', '3211070', 'Sukatali'),
('3211070018', '3211070', 'Situraja'),
('3211070019', '3211070', 'Jatimekar'),
('3211070020', '3211070', 'Situraja Utara'),
('3211070021', '3211070', 'Malaka'),
('3211070022', '3211070', 'Wanakerta'),
('3211071001', '3211071', 'Sundamekar'),
('3211071002', '3211071', 'Cimarga'),
('3211071003', '3211071', 'Cinangsi'),
('3211071004', '3211071', 'Linggajaya'),
('3211071005', '3211071', 'Situmekar'),
('3211071006', '3211071', 'Cisitu'),
('3211071007', '3211071', 'Cigintung'),
('3211071008', '3211071', 'Ranjeng'),
('3211071009', '3211071', 'Cilopang'),
('3211071010', '3211071', 'Pajagan'),
('3211080003', '3211080', 'Neglasari'),
('3211080004', '3211080', 'Sukamenak'),
('3211080005', '3211080', 'Jatibungur'),
('3211080006', '3211080', 'Darmajaya'),
('3211080007', '3211080', 'Darmaraja'),
('3211080008', '3211080', 'Cipeuteuy'),
('3211080011', '3211080', 'Cikeusi'),
('3211080012', '3211080', 'Cieunteung'),
('3211080013', '3211080', 'Tarunajaya'),
('3211080014', '3211080', 'Sukaratu'),
('3211080015', '3211080', 'Leuwihideung'),
('3211080016', '3211080', 'Cibogo'),
('3211080017', '3211080', 'Cipaku'),
('3211080018', '3211080', 'Karang Pakuan'),
('3211080019', '3211080', 'Paku Alam'),
('3211080020', '3211080', 'Ranggon'),
('3211090001', '3211090', 'Buana Mekar'),
('3211090002', '3211090', 'Jaya Mekar'),
('3211090003', '3211090', 'Cibugel'),
('3211090004', '3211090', 'Tamansari'),
('3211090005', '3211090', 'Sukaraja'),
('3211090006', '3211090', 'Cipasang'),
('3211090007', '3211090', 'Jayamandiri'),
('3211100001', '3211100', 'Cilengkrang'),
('3211100002', '3211100', 'Sukajadi'),
('3211100003', '3211100', 'Ganjaresik'),
('3211100004', '3211100', 'Cimungkal'),
('3211100011', '3211100', 'Mulyajaya'),
('3211100012', '3211100', 'Cikareo Selatan'),
('3211100013', '3211100', 'Cikareo Utara'),
('3211100014', '3211100', 'Wado'),
('3211100015', '3211100', 'Padajaya'),
('3211100016', '3211100', 'Sukapura'),
('3211100017', '3211100', 'Cisurat'),
('3211101001', '3211101', 'Kirisik'),
('3211101002', '3211101', 'Cipeundeuy'),
('3211101003', '3211101', 'Cimanintin'),
('3211101004', '3211101', 'Sukamanah'),
('3211101005', '3211101', 'Banjarsari'),
('3211101006', '3211101', 'Sarimekar'),
('3211101007', '3211101', 'Tarikolot'),
('3211101008', '3211101', 'Sirnasari'),
('3211101009', '3211101', 'Pawenang'),
('3211111001', '3211111', 'Sukakersa'),
('3211111002', '3211111', 'Mekarasih'),
('3211111003', '3211111', 'Ciranggem'),
('3211111004', '3211111', 'Cisampih'),
('3211111006', '3211111', 'Kadu'),
('3211111007', '3211111', 'Lebaksiuh'),
('3211111008', '3211111', 'Cintajaya'),
('3211111009', '3211111', 'Cipicung'),
('3211111010', '3211111', 'Jemah'),
('3211111011', '3211111', 'Cijeungjing'),
('3211111012', '3211111', 'Kadujaya'),
('3211111013', '3211111', 'Karedok'),
('3211120001', '3211120', 'Cicarimanah'),
('3211120003', '3211120', 'Cipeles'),
('3211120004', '3211120', 'Darmawangi'),
('3211120005', '3211120', 'Jembarwangi'),
('3211120006', '3211120', 'Marongge'),
('3211120007', '3211120', 'Tolengas'),
('3211120008', '3211120', 'Tomo'),
('3211120009', '3211120', 'Karyamukti'),
('3211120010', '3211120', 'Bugel'),
('3211120011', '3211120', 'Mekarwangi'),
('3211130001', '3211130', 'Cipelang'),
('3211130002', '3211130', 'Palabuan'),
('3211130003', '3211130', 'Kebon Cau'),
('3211130004', '3211130', 'Kudangwangi'),
('3211130005', '3211130', 'Sukamulya'),
('3211130006', '3211130', 'Palasari'),
('3211130007', '3211130', 'Ujungjaya'),
('3211130008', '3211130', 'Sakurjaya'),
('3211130009', '3211130', 'Cibuluh'),
('3211140001', '3211140', 'Narimbang'),
('3211140002', '3211140', 'Jambu'),
('3211140003', '3211140', 'Cipamekar'),
('3211140004', '3211140', 'Conggeang Kulon'),
('3211140005', '3211140', 'Conggeang Wetan'),
('3211140006', '3211140', 'Cibeureuyeuh'),
('3211140007', '3211140', 'Padaasih'),
('3211140008', '3211140', 'Babakan Asem'),
('3211140009', '3211140', 'Ungkal'),
('3211140010', '3211140', 'Cacaban'),
('3211140011', '3211140', 'Karanglayung'),
('3211140012', '3211140', 'Cibubuan'),
('3211150001', '3211150', 'Legok Kaler'),
('3211150002', '3211150', 'Legok Kidul'),
('3211150003', '3211150', 'Paseh Kidul'),
('3211150004', '3211150', 'Cijambe'),
('3211150005', '3211150', 'Pasireungit'),
('3211150006', '3211150', 'Padanaan'),
('3211150007', '3211150', 'Bongkok'),
('3211150008', '3211150', 'Paseh Kaler'),
('3211150009', '3211150', 'Haurkuning'),
('3211150010', '3211150', 'Citepok'),
('3211160001', '3211160', 'Cimuja'),
('3211160011', '3211160', 'Cibeureum Wetan'),
('3211160012', '3211160', 'Cibeureum Kulon'),
('3211160013', '3211160', 'Mandalaherang'),
('3211160014', '3211160', 'Cimalaka'),
('3211160015', '3211160', 'Serang'),
('3211160016', '3211160', 'Galudra'),
('3211160017', '3211160', 'Cikole'),
('3211160018', '3211160', 'Trunamanggala'),
('3211160019', '3211160', 'Nyalindung'),
('3211160020', '3211160', 'Naluk'),
('3211160021', '3211160', 'Citimun'),
('3211160022', '3211160', 'Licin'),
('3211160023', '3211160', 'Padasari'),
('3211161001', '3211161', 'Cisalak'),
('3211161002', '3211161', 'Kebonkalapa'),
('3211161003', '3211161', 'Cisarua'),
('3211161004', '3211161', 'Bantarmara'),
('3211161005', '3211161', 'Ciuyah'),
('3211161006', '3211161', 'Cimara'),
('3211161007', '3211161', 'Cipandanwangi'),
('3211170003', '3211170', 'Tanjungmekar'),
('3211170004', '3211170', 'Cigentur'),
('3211170005', '3211170', 'Gunturmekar'),
('3211170006', '3211170', 'Cipanas'),
('3211170007', '3211170', 'Banyuasih'),
('3211170008', '3211170', 'Mulyamekar'),
('3211170009', '3211170', 'Sukamantri'),
('3211170016', '3211170', 'Kertaharja'),
('3211170017', '3211170', 'Kertamekar'),
('3211170018', '3211170', 'Tanjungmulya'),
('3211170019', '3211170', 'Boros'),
('3211170020', '3211170', 'Awilega'),
('3211171001', '3211171', 'Wargaluyu'),
('3211171002', '3211171', 'Tanjungwangi'),
('3211171003', '3211171', 'Sukamukti'),
('3211171004', '3211171', 'Cikaramas'),
('3211171005', '3211171', 'Kertamukti'),
('3211171006', '3211171', 'Sukatani'),
('3211171007', '3211171', 'Kamal'),
('3211171008', '3211171', 'Jingkang'),
('3211171009', '3211171', 'Tanjungmedar'),
('3211180001', '3211180', 'Sekarwangi'),
('3211180002', '3211180', 'Cilangkap'),
('3211180003', '3211180', 'Cibitung'),
('3211180004', '3211180', 'Cikurubuk'),
('3211180005', '3211180', 'Bojongloa'),
('3211180006', '3211180', 'Nagrak'),
('3211180007', '3211180', 'Panyindangan'),
('3211180008', '3211180', 'Buahdua'),
('3211180009', '3211180', 'Gendereh'),
('3211180010', '3211180', 'Citaleus'),
('3211180011', '3211180', 'Mekarmukti'),
('3211180012', '3211180', 'Hariang'),
('3211180014', '3211180', 'Karangbungur'),
('3211180015', '3211180', 'Ciawitali'),
('3211181001', '3211181', 'Wanajaya'),
('3211181002', '3211181', 'Wanasari'),
('3211181003', '3211181', 'Pamekarsari'),
('3211181004', '3211181', 'Surian'),
('3211181005', '3211181', 'Tanjung'),
('3211181006', '3211181', 'Ranggasari'),
('3211181007', '3211181', 'Suriamedal'),
('3211181008', '3211181', 'Suriamukti'),
('3211181009', '3211181', 'Nanjungwangi');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`id_download`, `judul`, `nama_file`, `tgl_posting`, `hits`) VALUES
(3, 'Undang-Undang	419 Tahun 1949	Ordonansi Obat Keras', 'UU_No._419_Th_1949_ttg_Ordonansi_Obat_Keras.pdf', '2015-11-01', 0),
(4, 'Buku Panduan Hari Kesehatan Nasiona ke 48', 'buku-panduan-dbhcht.pdf', '2015-11-01', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `album_id`, `gallery_title`, `picture`) VALUES
(1, 2, '376525PIC-00001.jpg', '376525PIC-00001.jpg'),
(2, 2, '171661port-2.jpg', '171661port-2.jpg'),
(3, 2, '100952port-5.jpg', '100952port-5.jpg'),
(4, 3, '822204port-3.jpg', '822204port-3.jpg'),
(5, 3, '787109port-1.jpg', '787109port-1.jpg'),
(6, 3, '778289port-4.jpg', '778289port-4.jpg'),
(7, 4, '867187PIC-00003.jpg', '867187PIC-00003.jpg'),
(8, 4, '900177PIC-00004.jpg', '900177PIC-00004.jpg'),
(9, 4, '886810PIC-00002.jpg', '886810PIC-00002.jpg'),
(10, 5, '88555908082012008.jpg', '88555908082012008.jpg'),
(11, 5, '8237602012-08-17 08.10.01.jpg', '8237602012-08-17 08.10.01.jpg'),
(12, 5, '939849PIC-00002.jpg', '939849PIC-00002.jpg');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`id_header`, `judul`, `status`, `gbr_header`) VALUES
(3, 'CERDIK', 'Active', 'head-cerdik.jpg'),
(4, 'PHBS', 'Active', 'head-phbs.jpg'),
(5, 'NEW HEADER', 'Active', 'new-header-pis.jpg'),
(6, 'WEB SI', 'Active', 'new-web-ASI.jpg'),
(7, 'BANNER CERPEN', 'Active', 'web-banner-cerpen.jpg');

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
(1, 'Dinas Kesehatan Kab. Sumedang', 'Jl. Angkrek Situ No. 19 Sumedang 45323 Jawa Barat', 'dinkes2.png', 'stkipsassumedang@gmail.com', '', '@stkipsassumedang', '0261-202911', 'STKIP Sebelas April Sumedang', 'http://maps.google.com1', '<div align="center"><span style="font-family: times new roman,times; font-size: medium;"><strong>LEGALITAS PROGRAM STUDI</strong></span></div>\r\n<ol>\r\n<li><span style="font-size: small;">PENDIDIKAN BAHASA, SASTRA INDONESIA, DAN DAERAH (DIKBASASINDA) TERAKREDITASI BAN-PT - No. SK : 040/BAN-PT/Ak-XII/S1/I/2010 Tanggal 8 Januari 2010.</span></li>\r\n<li><span style="font-size: small;">PENDIDIKAN MATEMATIKA (PENMAT) TERAKREDITASI BAN-PT - No. SK : 036/BAN-PT/Ak-XII/S1/XI/2009 Tanggal 20 Nopember 2009.</span></li>\r\n<li><span style="font-size: small;">PENDIDIKAN JASMANI, KESEHATAN, DAN REKREASI (PJKR) TERAKREDITASI BAN-PT - &nbsp;No. SK : 013/BAN-PT/Ak-XIV/S1/VII/2011 Tanggal 14 Juli 2011.</span></li>\r\n<li><span style="font-size: small;">PENDIDIKAN GURU PAUD (IZIN DIRJEN DIKTI) -&nbsp;No. SK : 10499/D/T/K-IV/2012 Tanggal 16 Februari 2012</span></li>\r\n<li><span style="font-size: small;">PENDIDIKAN GURU SEKOLAH DASAR (IZIN PENYELENGGARAAN MENDIKNAS) -&nbsp;No. SK : 254/E/O/2011 Tanggal 10 Nopember 2011</span></li>\r\n<li><span style="font-size: small;">PENDIDIKAN TEKNIS MESIN (IZIN PENYELENGGARAAN MENDIKNAS) -&nbsp;No. SK : 254/E/O/2011 Tanggal 10 Nopember 2011</span></li>\r\n</ol>', 'STKIP Sas Sumedang');

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE IF NOT EXISTS `indikator` (
  `kd_indikator` int(11) NOT NULL AUTO_INCREMENT,
  `kd_kategori` int(11) NOT NULL,
  `indikator` varchar(100) NOT NULL,
  PRIMARY KEY (`kd_indikator`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`kd_indikator`, `kd_kategori`, `indikator`) VALUES
(1, 1, 'Menggunakan air bersih'),
(2, 1, 'Mencuci tangan dengan air bersih yang mengair dan sabun'),
(3, 1, 'Menggunakan jamban sehat'),
(4, 1, 'membuang sampah pada tempatnya'),
(5, 1, 'tidak merokok di institusi kesehatan'),
(6, 1, 'Tidak meludah sembarangan'),
(7, 1, 'memberantas jentik nyamuk'),
(8, 2, 'Menggunakan air bersih'),
(9, 2, 'Menggunakan jamban sehat'),
(10, 2, 'membuang sampah pada tempatnya'),
(11, 2, 'tidak merokok di terminal'),
(12, 2, 'Tidak meludah sembarangan'),
(13, 2, 'memberantas jentik nyamuk'),
(14, 3, 'Memelihara rambut agar bersih dan rapih'),
(15, 3, 'memakai pakaian bersih dan rapih'),
(16, 3, 'memelihara kuku agar selalu pendek dan bersih'),
(17, 3, 'memakai sepatu bersih dan rapih'),
(18, 3, 'berolahraga teratur dan terukur'),
(19, 3, 'tidak merorok disekolah'),
(20, 3, 'Tidak mengunakan napza'),
(21, 3, 'memberantas jentik nyamuk'),
(22, 3, 'mengunakan jamban yang bersih dan sehat'),
(23, 3, 'menggunakan air bersih'),
(24, 3, 'mencuci tangan dengan air yang mengalir dan sabun'),
(25, 3, 'membuang sampah ketempat sampah yang terpilah'),
(26, 3, 'mengkomsumsi jajanan sehat dari kantin sekolah'),
(27, 3, 'menimbang berat badan dan mengukur tinggi badan setiap bulan'),
(28, 4, 'Linakes'),
(29, 4, 'Asi Eksklusif'),
(30, 4, 'Menimbang  Bayi & Balita '),
(31, 4, 'Menggunakan air bersih'),
(32, 4, 'Mencuci tangan dengan air bersih dan sabun'),
(33, 4, 'Mengunakan Jamban Sehat'),
(34, 4, 'Memberantas jentik di rumah'),
(35, 4, 'makan sayur dan buah setiap hari'),
(36, 4, 'melakukan aktifitas fisik setiap hari'),
(37, 4, 'tidak merokok didalam rumah'),
(38, 5, 'Memelihara kebersihan dan kerapihan lingkungan tempat kerja'),
(39, 5, 'Mengunakan air bersih'),
(40, 5, 'Mengunakan jamban sehat'),
(41, 5, 'membuang sampah pada tempatnya'),
(42, 5, 'mencuci tangan dengan air bersih yang mengalir dan memakai sabun'),
(43, 5, 'Mengkonsumsi makanan dari kantin dilingkungan kantor'),
(44, 5, 'Memberantas jentik nyamuk'),
(45, 5, 'Melakukan olahraga secara teratur'),
(46, 5, 'tidak merokok didalam rumah');

-- --------------------------------------------------------

--
-- Table structure for table `indikator_tambahan`
--

CREATE TABLE IF NOT EXISTS `indikator_tambahan` (
  `kd_indikator_tambahan` int(11) NOT NULL AUTO_INCREMENT,
  `kd_kategori` int(11) NOT NULL,
  `indikator_tambahan` varchar(100) NOT NULL,
  PRIMARY KEY (`kd_indikator_tambahan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `indikator_tambahan`
--

INSERT INTO `indikator_tambahan` (`kd_indikator_tambahan`, `kd_kategori`, `indikator_tambahan`) VALUES
(1, 1, 'Jumah Seluruh Institusi Kesehatan'),
(2, 2, 'Jumah Seluruh Tempat Umum'),
(3, 3, 'Jumah Seluruh sekolah'),
(4, 4, 'Jumah Seluruh Rumah'),
(5, 4, 'Jumlah Seluruh Kepala Keluarga'),
(7, 5, 'Jumah Seluruh tempat kerja / kantor');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_tempat`
--

CREATE TABLE IF NOT EXISTS `kategori_tempat` (
  `kd_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kategori_tempat`
--

INSERT INTO `kategori_tempat` (`kd_kategori`, `kategori`) VALUES
(1, 'Institusi Kesehatan'),
(2, 'Tempat Umum'),
(3, 'Sekolah'),
(4, 'Rumah'),
(5, 'Tempat Kerja');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE IF NOT EXISTS `kecamatan` (
  `kd_kecamatan` varchar(7) NOT NULL,
  `kd_kabupaten` varchar(4) NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_kecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`kd_kecamatan`, `kd_kabupaten`, `kecamatan`) VALUES
('3211010', '3211', ' Jatinangor'),
('3211020', '3211', ' Cimanggung'),
('3211030', '3211', ' Tanjungsari'),
('3211031', '3211', ' Sukasari'),
('3211032', '3211', ' Pamulihan'),
('3211040', '3211', ' Rancakalong'),
('3211050', '3211', ' Sumedang Selatan'),
('3211060', '3211', ' Sumedang Utara'),
('3211061', '3211', ' Ganeas'),
('3211070', '3211', ' Situraja'),
('3211071', '3211', ' Cisitu'),
('3211080', '3211', ' Darmaraja'),
('3211090', '3211', ' Cibugel'),
('3211100', '3211', ' Wado'),
('3211101', '3211', ' Jatinunggal'),
('3211111', '3211', ' Jatigede'),
('3211120', '3211', ' Tomo'),
('3211130', '3211', ' Ujung Jaya'),
('3211140', '3211', ' Conggeang'),
('3211150', '3211', ' Paseh'),
('3211160', '3211', ' Cimalaka'),
('3211161', '3211', ' Cisarua'),
('3211170', '3211', ' Tanjungkerta'),
('3211171', '3211', ' Tanjungmedar'),
('3211180', '3211', ' Buahdua'),
('3211181', '3211', ' Surian');

-- --------------------------------------------------------

--
-- Table structure for table `pelaksana`
--

CREATE TABLE IF NOT EXISTS `pelaksana` (
  `kd_pelaksana` int(11) NOT NULL AUTO_INCREMENT,
  `pelaksana` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_pelaksana`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `pelaksana`
--

INSERT INTO `pelaksana` (`kd_pelaksana`, `pelaksana`) VALUES
(1, 'Promkes'),
(2, 'Sanitarian'),
(3, 'Perawat'),
(4, 'Bidan'),
(5, 'TPG / Nutrisionis'),
(6, 'Pengelola Prog. Jiwa'),
(7, 'Pengelola Prog. Lansia'),
(8, 'Pengelola Prog. Remaja'),
(9, 'Pengelola TB Paru'),
(10, 'Pengelola TB Kusta'),
(11, 'Pengelola TB Indra');

-- --------------------------------------------------------

--
-- Table structure for table `penyuluhan`
--

CREATE TABLE IF NOT EXISTS `penyuluhan` (
  `kd_penyuluhan` int(11) NOT NULL AUTO_INCREMENT,
  `kd_puskesmas` int(11) NOT NULL,
  `kd_pelaksana` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `materi` varchar(100) NOT NULL,
  `jumlah_penyuluhan` int(11) NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `approve` varchar(30) NOT NULL,
  `tanggal_post` date NOT NULL,
  PRIMARY KEY (`kd_penyuluhan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `penyuluhan`
--

INSERT INTO `penyuluhan` (`kd_penyuluhan`, `kd_puskesmas`, `kd_pelaksana`, `user_id`, `kategori`, `materi`, `jumlah_penyuluhan`, `jumlah_peserta`, `bulan`, `tahun`, `approve`, `tanggal_post`) VALUES
(4, 1, 1, 10, 'Luar gedung', 'materi promkes', 1, 10, 10, 2015, 'Ya', '0000-00-00'),
(2, 1, 5, 6, 'Luar gedung', 'Penyuluhan Gizi', 4, 40, 10, 2015, 'Ya', '0000-00-00'),
(3, 1, 4, 6, 'Dalam gedung', 'Ibu hamil', 1, 10, 10, 2015, 'Ya', '0000-00-00'),
(5, 1, 5, 6, 'Luar gedung', 'Penyuluhan', 1, 9, 1, 2015, 'Ya', '2015-10-27'),
(6, 1, 8, 10, 'Luar gedung', 'bahaya rokok dan narkoba', 2, 20, 10, 2015, 'Ya', '2015-10-28'),
(7, 1, 1, 10, 'Luar gedung', 'Penyulahn promkes', 4, 50, 10, 2015, 'Ya', '2015-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `phbs`
--

CREATE TABLE IF NOT EXISTS `phbs` (
  `kd_phbs` int(11) NOT NULL AUTO_INCREMENT,
  `kd_indikator` int(11) NOT NULL,
  `kd_tempat` varchar(50) NOT NULL,
  `nilai` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_phbs`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `phbs`
--

INSERT INTO `phbs` (`kd_phbs`, `kd_indikator`, `kd_tempat`, `nilai`) VALUES
(1, 14, '3.3211010011.10.1', 'Ya'),
(2, 15, '3.3211010011.10.1', 'Ya'),
(3, 16, '3.3211010011.10.1', 'Ya'),
(4, 17, '3.3211010011.10.1', 'Ya'),
(5, 18, '3.3211010011.10.1', 'Tidak'),
(6, 19, '3.3211010011.10.1', 'Tidak'),
(7, 20, '3.3211010011.10.1', 'Tidak'),
(8, 21, '3.3211010011.10.1', 'Ya'),
(9, 22, '3.3211010011.10.1', 'Ya'),
(10, 23, '3.3211010011.10.1', 'Ya'),
(11, 24, '3.3211010011.10.1', 'Ya'),
(12, 25, '3.3211010011.10.1', 'Ya'),
(13, 26, '3.3211010011.10.1', 'Ya'),
(14, 27, '3.3211010011.10.1', 'Tidak'),
(15, 28, '4.3211010001.10.1', 'Ya'),
(16, 29, '4.3211010001.10.1', 'Ya'),
(17, 30, '4.3211010001.10.1', 'Ya'),
(18, 31, '4.3211010001.10.1', 'Ya'),
(19, 32, '4.3211010001.10.1', 'Ya'),
(20, 33, '4.3211010001.10.1', 'Ya'),
(21, 34, '4.3211010001.10.1', 'Ya'),
(22, 35, '4.3211010001.10.1', 'Ya'),
(23, 36, '4.3211010001.10.1', 'Ya'),
(24, 37, '4.3211010001.10.1', 'Ya'),
(25, 28, '4.3211010001.10.2', 'Ya'),
(26, 29, '4.3211010001.10.2', 'Ya'),
(27, 30, '4.3211010001.10.2', 'Ya'),
(28, 31, '4.3211010001.10.2', 'Ya'),
(29, 32, '4.3211010001.10.2', 'Ya'),
(30, 33, '4.3211010001.10.2', 'Ya'),
(31, 34, '4.3211010001.10.2', 'Ya'),
(32, 35, '4.3211010001.10.2', 'Ya'),
(33, 36, '4.3211010001.10.2', 'Ya'),
(34, 37, '4.3211010001.10.2', 'Tidak');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `category_id`, `title`, `title_slug`, `content`, `tag`, `date`, `time`, `picture`, `hits`, `author`, `post_status`) VALUES
(3, 6, 'Program Indonesia Sehat untuk Atasi Masalah Kesehatan', 'program-indonesia-sehat-untuk-atasi-masalah-kesehatan', '<p>Jakarta, 3 Februari 2015<br /><br />Indeks Pembangunan Manusia Indonesia dari tahun ke tahun meningkat, walaupun saat ini Indonesia masih berada pada ranking 108 dari 187 negara di dunia. Pembangunan manusia pada dasarnya adalah upaya untuk memanusiakan manusia kembali. Adapun upaya yang dapat ditempuh harus dipusatkan pada seluruh proses kehidupan manusia itu sendiri, mulai dari bayi dengan pemberian ASI dan imunisasi hingga lanjut usia, dengan memberikan jaminan sosial. Kebutuhan-kebutuhan pada setiap tahap kehidupan harus terpenuhi agar dapat mencapai kehidupan yang lebih bermartabat.<br /><br />Seluruh proses ini harus ditunjang dengan ketersediaan pangan, air bersih, sanitasi, energi dan akses ke fasilitas kesehatan dan pendidikan, jelas Menkes Prof. Dr. dr. Nila F. Moeleok, Sp.M(K) saat Jumpa Pers Awal Tahun tentang program kerja Kemenkes, di Jakarta (3/2).<br /><br />Dalam rangka mendorong pembangunan manusia secara menyeluruh, perlu perhatian pada kesehatan sejak dini atau sejak Balita. Kita lihat bahwa sangat penting untuk melakukan investasi yang tepat waktu agar pertumbuhan otak anak sampai usia 5 tahun dapat berjalan dengan baik, untuk menghindari loss generation, terang Menkes. <br /><br />Ditegaskan, salah satu ancaman serius terhadap pembangunan kesehatan, khususnya pada kualitas generasi mendatang, adalah stunting. Dimana rata-rata angka stunting di Indonesia sebesar 37.2%. Menurut standar WHO, persentase ini termasuk kategori berat.<br /><br />Menkes juga mencermati angka kejadian pernikahan dini yang masih cukup tinggi dan kerentanan remaja pada perilaku seks berisiko serta HIV/AIDS khususnya pada kelompok usia produktif.<br /><br />Kematian ibu juga menjadi tantangan dari waktu ke waktu. Ada berbagai penyebab kematian ini baik penyebab langsung maupun tidak langsung, maupun faktor penyebab yang sebenarnya berada di luar bidang kesehatan itu sendiri, seperti infrastruktur, ketersedian air bersih, transportasi, dan nilai-nilai budaya. Faktor-faktor non-kesehatan inilah yang justru memberikan pengaruh besar karena dapat menentukan berhasil tidaknya&nbsp; upaya penurunan angka kematian ibu, ungkap Menkes.<br /><br />Guna mengurangi dampak kesehatan seperti contoh di atas, Kemenkes menyelenggarakan Program Indonesia Sehat sebagai upaya mewujudkan masyarakat Indonesia yang berperilaku sehat, hidup dalam lingkungan sehat, serta mampu menjangkau pelayanan kesehatan yang bermutu untuk mencapai derajat kesehatan yang setinggi-tingginya.<br /><br />Program Indonesia Sehat terdiri atas 1) Paradigma Sehat; 2) Penguatan Pelayanan Kesehatan Primer; dan 3) Jaminan Kesehatan Nasional. Ketiganya akan dilakukan dengan menerapkan pendekatan continuum of care dan intervensi berbasis risiko&nbsp; (health risk).<br /><br />Paradigma sehat menyasar pada 1) penentu kebijakan pada lintas sektor, untuk&nbsp; memperhatikan dampak kesehatan dari kebijakan yang diambil baik di hulu maupun di hilir, 2) Tenaga kesehatan, yang mengupayakan agar orang sehat tetap sehat atau tidak menjadi sakit, orang sakit menjadi sehat dan orang sakit tidak menjadi lebih sakit; 3) Institusi Kesehatan, yang diharapkan penerapan standar mutu dan standar tarif dalam pelayanan kepada masyarakat, serta 4) Masyarakat, yang merasa kesehatan adalah harta berharga yang harus dijaga. <br /><br />Kementerian Kesehatan akan melakukan penguatan pelayanan kesehatan untuk tahun 2015-2019. Penguatan dilakukan meliputi 1) Kesiapan 6.000 Puskesmas di 6 regional; 2) Terbentuknya 14 RS Rujukan Nasional; serta Terbentuknya 184 RS Rujukan regional.<br /><br />Khusus untuk daerah terpencil dan sangat terpencil, di bangun RS kelas D Pratama dengan kapasitas 50 Tempat Tidur untuk lebih mendekatkan pelayanan kesehatan rujukan. Pada regional Papua akan didirikan 13 Rumah Sakit Pratama. Sementara pada Regional Sumatera, Jawa, Bali-Nusa Tenggara, Kalimantan, Sulawesi akan didirikan 55 Rumah Sakit Pratama.<br /><br />Menkes menjelaskan, Kementerian Kesehatan telah melakukan implementasi e-catalogue pada pengadaan obat dan alat kesehatan di lingkup Satuan Kerja Pemerintah. Hal ini telah dimulai sejak tahun 2013 untuk obat, dan awal tahun 2014 untuk alkes. Ini merupakan wujud nyata tindak lanjut arahan Presiden RI agar pengadaan barang/jasa di lingkup Pemerintah dilakukan secara elektronik.<br /><br /><strong>Kartu Indonesia Sehat (KIS)</strong><br />KIS yang diluncurkan tanggal 3 November 2014 merupakan wujud program Indonesia Sehat di bawah Pemerintahan Presiden Jokowi. Program ini 1) menjamin dan memastikan masyarakat kurang mampu untuk mendapat manfaat pelayanan kesehatan seperti yang dilaksanakan melalui Jaminan Kesehatan Nasional (JKN) yang diselenggarakan oleh BPJS Kesehatan; 2) perluasan cakupan PBI termasuk Penyandang Masalah Kesejahteraan Sosial (PMKS) dan Bayi Baru Lahir dari peserta Penerima PBI; serta 3) Memberikan tambahan Manfaat berupa layanan preventif, promotif dan deteksi dini dilaksanakan lebih intensif dan terintegrasi. <br /><br /><strong>Pertemuan Antar Menteri </strong><br />Dalam mensinergikan program kesehatan dengan program pembangunan di kementerian lain, Menteri Kesehatan telah melakukan beberapa pertemuan dengan Menteri Kebinet Kerja. Pertemuan dilakukan sejak akhir tahun 2014 dan masih berlangsung hingga saat ini. <br /><br />Tanggal 23 Desember 2014 Menkes bertemu dengan Mendagri. Ini merupakan pertemuan pertama antar Menteri Kabinet Kerja. Hasil pertemuan kedua Menteri adalah Mensosialisasikan JKN melalui asosiasi kepala daerah; Memperkuat pembekalan teamwork Nakes yang akan ditempatkan di daerah untuk menyeimbangkan pelayanan promotif-preventif dan kuratif-rehabilitatif; Memperbanyak Puskesmas Bergerak untuk pelayanan kesehatan di daerah terpencil; Prioritas pembangunan Puskesmas di 50 wilayah; Membuat surat edaran kepada kepala daerah untuk mendukung peraturan pemerintah terkait Standar Pelayanan Mutu (SPM) bidang kesehatan; dan Integrasi data administrasi kependudukan. <br /><br />Tanggal 31 Desember 2014 Menkes bertemu dengan Menkominfo. Hasil pertemuan menyepakati Penguatan SPGDT dengan layanan satu nomor panggil 119 serta Pelaksanaan assessment oleh Kemenkominfo terhadap berbagai aplikasi yang ada di Kemenkes.<br /><br />Pada tanggal 2 Januari 2015 Menkes melakukan rapat koordinasi dengan Menteri Desa, Pembangunan Daerah Tertinggal, dan Transmigrasi. Hasil pertemuan adalah Menyiapkan infrastruktur pendukung (bangunan fisik, jalan, air bersih, sarana komunikasi); Sistem keamanan secara khusus untuk wilayah perbatasan terkait dengan pergerakan manusia, hewan, barang, penyakit; dan Khusus untuk wilayah transmigrasi baru mempertimbangkan juga bidang usaha kecil yang terjamin dan sehat.<br /><br />Tanggal 5 Januari 2015, Menkes bertemu dengan Menteri Perdagangan. Hasil pertemuan adalah Mempromosikan jamu sebagai warisan budaya Indonesia baik di dalam negeri maupun luar negeri; Mendukung perlindungan masyarakat untuk produk makanan import; Mendukung pengaturan bahan berbahaya untuk makanan dan minuman; Meningkatkan koordinasi&nbsp; perdagangan barang dan jasa dalam rangka menghadapi Masyarakat Ekonomi ASEAN (MEA).<br /><br />Pada tanggal 8 Januari 2015 Menkes melakukan Rapat Koordinasi dengan Menteri Pekerjaan Umum dan Perumahan Rakyat, dengan hasil yaitu Membangun akses masyarakat ke fasilitas pelayanan Kesehatan Primer; Meningkatkan pembangunan saranan air bersih dan sanitasi untuk masyarakat; Membangun perumahan untuk tenaga kesehatan; Mengintegrasikan&nbsp; pembangunan kawasan kumuh dengan program Kesehatan (Air bersih, STBM dan PHBS); dan Target kolaborasi dilaksanakan dalam 5 tahun ke depan,<br /><br />Tanggal 27 Januari 2015 Menkes&nbsp; bertemu dengan Menteri Pendidikan dan Kebudayaan. Adapun hasil pertemuan adalah Menyusun materi PHBS untuk guru sebagai agent of change; Merevitalisasi Usaha Kesehatan Sekolah (UKS); Menghidupkan kembali program Pemberian Makanan Tambahan Anak Sekolah (PMT-AS) melalui gerakan sarapan pagi; Membangun paket kegiatan rutin anak sekolah berupa Membaca, Olah raga, menyanyi lagu daerah dan piket membersihkan lingkungan sekolah; serta Kegiatan akan dimulai dengan tahun ajaran baru 2015/2016: Menyusun peraturan tentang pendirian SMK dan bidang penjurusannya.<br /><br /><strong>Nusantara Sehat (NS)</strong><br />Sebagai bagian dari penguatan pelayanan kesehatan primer untuk mewujudkan Indonesia Sehat Kemenkes membentuk program Nusantara Sehat (NS). Di dalam program ini dilakukan peningkatan jumlah, sebaran, komposisi dan mutu Nakes berbasis pada tim yang memiliki latar belakang berbeda mulai dari dokter, perawat dan Nakes lainnya (pendekatan Team Based). Program NS tidak hanya berfokus pada kegiatan kuratif tetapi juga pada promitif dan prefentif untuk mengamankan kesehatan masyarakatdan daerah yang paling membutuhkan sesuai dengan Nawa Cita membangun dari pinggiran.<br /><br />Berita ini disiarkan oleh Pusat Komunikasi Publik Sekretariat Jenderal Kementerian Kesehatan RI. Untuk informasi lebih lanjut dapat menghubungi Halo Kemkes melalui nomor hotline &lt;kode lokal&gt; 500-567; SMS 081281562620, faksimili: (021) 52921669, website www.depkes.go.id dan email <strong>kontak</strong>[at]<strong>depkes</strong>[dot]<strong>go</strong>[dot]<strong>id</strong>.<br />- See more at: http://www.depkes.go.id/article/view/15020400002/program-indonesia-sehat-untuk-atasi-masalah-kesehatan.html#sthash.UIRA3IfN.dpuf</p>', 'Alat Kesehatan;', '2015-11-01', '12:24:28', '16246941320_b170e7ae73_z.jpg', 3, 6, 'Publish'),
(2, 6, 'Pameran Alat Kesehatan Dalam Negeri Dibuka', 'pameran-alat-kesehatan-dalam-negeri-dibuka', '<p>Jakarta, 16 Oktober 2015<br /><br />Pagi ini Menteri Kesehatan RI, Prof. dr. Nila Farid Moeloek, Sp.M (K) membuka Pameran Alat Kesehatan dalam Negeri sekaligus mencanangkan Gerakan Cinta Alkes Indonesia di Hall B Jakarta Convention Center, Senayan Jakarta. Jumat (16/10). Hadir dalam acara tersebut: Darmin Nasution, Menko Perekonomian dan Ketua Lembaga Kebijakan Pengadaan Barang / Jasa Pemerintah, Agus Prabowo.<br /><br />Pameran yang berlangsung selama 2 hari tersebut (16&nbsp; - 17 Oktober 2015) diikuti 87 peserta industri Alat Kesehatan (Alkes) dan Perbekalan Kesehatan Rumah Tangga (PKRT) dalam negeri. Stand pameran didesain menyerupai rumah sakit yang berisi seluruh Alkes dalam negeri.&nbsp; Dari mulai ruang IGD, laboratorium, ruang operasi, kamar bersalin, ICU sampai ke ruang perawatan baik itu kelas 1, 2, 3 dan VIP. Terdapat juga ruang riset dan pengembangan yang berisi inovasi kreasi anak bangsa yang akan diproduksi di masa yang akan datang.<br /><br />Dalam pidatonya Menkes mengatakan saat ini Indonesia masih sangat bergantung pada penggunaan Alkes dari luar negeri (impor). Sebanyak 90% produk Alkes yang beredar di Indonesia berasal dari luar negeri, sisanya merupakan Alkes produksi dalam negeri dengan kategori Alkes teknologi rendah sampai menengah.<br /><br />Tingginya nilai tukar mata uang dolar berpengaruh pada tingginya biaya dalam belanja alat kesehatan di fasilitas pelayanan kesehatan. Dominasi alat kesehatan impor ini harus diantisipasi dengan penguatan daya saing industri alat kesehatan dalam negeri yang berbasis penelitian terapan dan pemanfaataan sumber daya yang ada.<br /><br />Jumlah populasi Indonesia merupakan potensi pasar dalam negeri yang dapat dimanfaatkan oleh industri alat kesehatan dalam negeri dalam rangka ketahanan komoditi alat kesehatan. Hal ini sejalan dengan agenda pemberdayaan masyarakat terhadap antisipasi pada ketergantungan pada produk luar negeri sekaligus merupakan proses terstruktur untuk agenda alih teknologi<br /><br />Kementerian Kesehatan bersama jajaran pemerintah, akademisi/peneliti dan masyarakat industri berupaya untuk meningkatkan produk alat kesehatan dalam negeri agar dapat bersaing di skala nasional dan global, terutama dalam mengantisipasi kesiapan menyambut ASEAN Economy Community (AEC) 2015, Imbuh Menkes.<br /><br />Menkes menyebutkan, bahwa saat ini produsen di dalam negeri sudah mampu untuk memproduksi berupa: hospital furniture, sphygmomanometer &amp; stethoscope, handschoen (hand gloves), alat kesehatan elektromedik (infant incubator, nebulizer, O2 concentrator, dental chair, EKG, fetal doppler, dll), alat kesehatan disposables (syringes, urine bags, infusion set, masker, dll), medical apparels (operating gown, bed sheets), dan produk-produk consumable (reagensia, antiseptic, band aid).<br /><br />Pada kesempatan ini, saya mengharapkan industri alat kesehatan dapat terus berkreasi dan berinovasi menciptakan produk-produk baru, serta meningkatkan kualitas dan kerja sama dengan akademisi untuk dapat menghasilkan produk produk inovasi yang memiliki daya saing. Semoga di masa mendatang dengan meningkatnya ketersediaan alat kesehatan dalam negeri dapat mengurangi ketergantungan terhadap produk impor yang saat ini masih mencapai lebih dari 90% dengan berbagai tekhnologi, ujar Menkes.<br /><br />Pameran tersebut merupakan sarana pengenalan kepada masyarakat luas terhadap ketersediaan alat kesehatan dalam negeri yang telah memiliki daya saing dan bahkan sebagian telah diekspor ke mancanegara serta berbagai produk alat kesehatan&nbsp; yang telah masuk ke dalam e-catalog alat kesehatan. Selain itu, pameran ini juga digunakan sebagai ajang informasi untuk investor terhadap alat kesehatan yang dibutuhkan di fasilitas layanan kesehatan dan belum mampu diproduksi.<br /><br />Berita ini disiarkan oleh Pusat Komunikasi Publik Sekretariat Jenderal Kementerian Kesehatan RI. Untuk informasi lebih lanjut dapat menghubungi Halo Kemkes melalui nomor hotline &lt;kode lokal&gt; 1500-567; SMS 081281562620, faksimili: (021)52921669, dan alamat email <strong>kontak</strong>[at]<strong>kemkes</strong>[dot]<strong>go</strong>[dot]<strong>id</strong>. - See more at: http://www.depkes.go.id/article/view/15101600002/pameran-alat-kesehatan-dalam-negeri-dibuka.html#sthash.EDksxcD8.dpuf</p>', 'PHBS;Alat Kesehatan;', '2015-11-01', '12:16:16', '', 1, 6, 'Publish'),
(4, 6, 'Indonesia Bebas Kaki Gajah 2010', 'indonesia-bebas-kaki-gajah-2010', '<p>Lymphatic filariasis, biasa disebut filariasis saja atau kaki gajah, masih menjadi momok di Indonesia. Kaki gajah penyakit infeksi yang disebabkan parasit yang dapat menyebabkan perubahan pada sistem limfatik, serta pembesaran tak normal pada bagian tubuh. Penyakit ini menyebabkan rasa sakit pada penderitanya, cacat berat, dan menyematkan stigma sosial.<br />Data Badan Kesehatan Dunia menunjukkan lebih dari 120 juta orang di seluruh dunia terinfeksi filariasis. Empat puluh juta di antaranya mengalami cacat dan lumpuh karenanya. Indonesia sendiri menjadi negara dengan jumlah penderita kaki gajah terbesar kedua di dunia setelah India. Kementerian Kesehatan mencatat 105 juta penduduk tanah air rentan terserang penyakit tersebut.<br />India telah melakukan tindakan eliminasi terhadap penyebaran kaki gajah sejak 2000 dan penderitanya terus berkurang. Kita di Indonesia pun bertekad mewujudkan negeri ini bebas kaki gajah pada 2020 lewat program Bulan Eliminasi Penyakit Kaki Gajah (BELKAGA). Program ini dicanangkan Presiden Joko Widodo pada 1 Oktober lalu di Cibinong, Jawa Barat.<br />BELKAGA digelar setiap dan sepanjang Oktober, selama 5 tahun berturut-turut, menyasar kelompok orang-orang yang rentan tertular penyakit kaki gajah. Dalam program ini, setiap penduduk kabupaten/kota endemi kaki gajah serentak minum obat pencegahan.<br />Bagaimana seseorang bisa tertular kaki gajah? Kaki gajah disebabkan oleh cacing filaria yang ditularkan melalui berbagai jenis nyamuk. Cacing berpindah ketika nyamuk menggigit orang yang telah tertular sebelumnya, kemudian ganti menggigit orang lainnya yang masih sehat.<br />Cacing dewasa hidup dalam sistem limfatik dan mengganggu kekebalan tubuh. Cacing dapat hidup hingga 6-8 tahun. Selama hidup, mereka menghasilkan jutaan mikrofilaria atau larva dewasa yang beredar dalam darah. Nyamuk terinfeksi mikrofilaria saat menelan darah ketika menggigit tubuh orang yang menjadi inangnya. Mikrofilaria kemudian tumbuh menjadi larva infektif dalam nyamuk. Saat nyamuk yang terinfeksi tadi menggigit orang, larva parasit dewasa yang diendapkan pada kulit orang tersebut masuk ke dalam tubuh. Larva kemudian bermigrasi ke pembuluh limfatik dan berkembang menjadi cacing dewasa. Siklus penularan pun berlanjut.<br />Apa yang bisa kita lakukan untuk mencegah penularan penyakit kaki gajah? Cara yang paling mudah adalah menjaga kebersihan lingkungan agar perkembangan nyamuk terhenti. Pemberantasan nyamuk, terutama di wilayah endemi kaki gajah, sangat penting untuk memutus mata rantai penularan penyakit ini.<br />Meminum obat pencegahan juga dapat dilakukan, yaitu dua kapsul sekali minum dalam setahun setiap Oktober. Obat ini tidak memiliki efek samping obat dan mampu menangkal penyebaran penyakit kaki gajah. (*)</p>', 'PHBS;', '2015-11-01', '12:26:40', 'news-filariasis.jpg', 0, 6, 'Publish'),
(5, 9, 'Melawan Asap Dengan Air Putih dan PHBS', 'melawan-asap-dengan-air-putih-dan-phbs', '<p>Kabut asap yang parah akibat kebakaran lahan terjadi tiap tahun di Sumatera dan Kalimantan. Tak hanya mengganggu mobilitas warga dan penerbangan, asap juga mengganggu kesehatan. Asap sisa kebakaran lahan ini mengandung particulate matter (PM-10) berlebih, sangat berbahaya bagi kesehatan paru-paru.</p>\r\n<p>Particulate matter adalah partikel padat atau cair yang ditemukan di udara. Partikel yang besar atau cukup gelap dapat kita lihat dalam bentuk jelaga atau asap. Sementara PM-10 adalah partikel kecil. Paparannya amat berbahaya karena dapat mencapai daerah yang lebih dalam pada saluran pernapasan.</p>\r\n<p>Apa yang dapat dilakukan warga untuk menjaga kesehatannya ketika kabut asap melanda?</p>\r\n<p>Kepala Badan Penelitian dan Pengembangan Kesehatan (Balitbangkes), Kementerian Kesehatan RI, Prof.dr.Tjandra Yoga Aditama mengatakan minum air putih lebih banyak dan lebih sering dapat membantu tubuh bertahan melawan bahaya yang dibawa asap. Air putih berfungsi sebagai penyeimbang sistem getah bening. Jika sistem getah bening bekerja optimal, tubuh memiliki daya tahan untuk melawan infeksi yang terjadi akibat paparan zat beracun.</p>\r\n<p>Minum air putih juga mampu mengatasi dehidrasi dan menambah kebugaran tubuh.</p>\r\n<p>Beberapa orang lebih rentan terganggu kesehatannya ketika terpapar asap. Mereka adalah orang-orang dengan kondisi kesehatan tertentu, seperti mengidap gangguan paru-paru dan jantung, berusia lanjut, atau masih kanak-kanak.</p>\r\n<p>Mereka yang mengidap asma atau penyakit paru-paru kronis lain, mengalami kerja paru-paru yang menurun. Akibatnya, penderita mudah lelah dan mengalami kesulitan bernapas.</p>\r\n<p>Oleh karena itu, menurut Tjandra, sangat penting untuk mencuci dulu buah-buahan atau sayuran sebelum diolah atau dikonsumsi untuk membersihkannya dari zat beracun yang menempel. Bahan-bahan makanan dan minuman pun perlu dimasak dengan baik.</p>\r\n<p>Penderita penyakit jantung dan gangguan pernapasan pun sebaiknya mengurangi kegiatan di luar rumah. Apabila terpaksa ke luar rumah, sebaiknya menggunakan masker yang layak. Disarankan mereka meminta petunjuk dokter untuk perlindungan tambahan dan segera memeriksakan diri jika mengalami kesulitan bernapas atau gangguan kesehatan lainnya.</p>\r\n<p>Perilaku Hidup Bersih dan Sehat (PHBS) juga perlu dilaksanakan lebih disiplin, yakni mengonsumsi makanan bergizi seimbang, melakukan aktivitas fisik minimal 30 menit setiap hari, dan tidak merokok.</p>\r\n<p>Tjanda juga menyarakan agar warga mengupayakan polusi di luar tidak masuk ke dalam rumah, sekolah, kantor, dan ruang tertutup lainnya. Penampungan air minum dan makanan pun harus terlindungi dengan baik. (*)</p>', 'PHBS;', '2015-11-01', '12:41:44', '', 0, 6, 'Publish'),
(6, 9, 'Pemerintah Serius Tangani Gizi Masyarakat', 'pemerintah-serius-tangani-gizi-masyarakat', '<p>Selama tahun 2015 Kementerian Kesehatan intensif mengirim makanan pendamping air susu ibu (MP-ASI), pemberian makanan tambahan ibu hamil (PMT-Bumil), dan pemberian makanan tambahan anak sekolah (PMT-ASI) di beberapa daerah di Indonesia. Makanan pendamping ini dikirimkan baik di tingkat provinsi maupun langsung ke Kabupaten. MP-ASI dan PMT Bumil dilakukan untuk mengantisipasi masalah gizi, sementara PMT-AS lebih mengarah kepada memperkenalkan atau membiasakan sarapan sebelum anak-anak beraktifitas di sekolah.</p>\r\n<p>Total bantuan yang sudah dikirimkan selama Januari Agustus 2015 sebanyak 18.391 karton MP-ASI, 587.971 karton PMT-Bumil, dan 652.800 karton PMT AS. Sementara masih ada cadangan lagi di Kemenkes sebanyak 184.550 karton MP-ASI, 266.659 karton PMT-ASI, 1.140 karton PMT-AS. Adapun satuannya adalah MP-ASI 6.72 kg/karton, PMT-Bumil 3 kg/karton, dan PMT-AS 2.16 kg/karton.</p>\r\n<p>Pengirman makanan tambahan dilakukan untuk mengantisipasi masalah gizi pada Balita, ibu hamil dan anak sekolah. Selain itu pengiriman juga dilakukan sebagai buffer stock (persediaan tambahan untuk pengamanan) khususnya dalam tanggap darurat bencana.</p>\r\n<p>Pemberian MP-ASI, PMT-Bumil, dan PMT-AS sebagai antisipasi masalah gizi kurang. Namun, bila ditemukan kasus gizi buruk, maka diberikan tata laksana kasus gizi buruk. Penderita akan dirawat di Puskesmas atau dirujuk ke rumah sakit atau ke traumatic feeding center (TFC) sampai kondisinya kembali ke status gizi baik.</p>\r\n<p>Masyarakat dapat berpartisipasi dalam mencegah terjadinya gizi buruk. Ini dilakukan dengan aktif pemantauan pertumbuhan anak dimulai dari Posyandu. Jika berat badan bayi/anak tidak naik 2 kali berturut-turut, maka anak tersebut dapat segera dirujuk ke Puskesmas untuk divalidasi apakah memerlukan perawatan lebih lanjut.</p>\r\n<p>Dalam mengendalikan masalah gizi, Kementerian Kesehatan melakukan pemantauan dan pemberian bantuan melalui Dinas Kesehatan. Kegiatan ini tidak hanya dilakukan Kemenkes dan Dinas kesehatan saja, namun juga melibatkan 12 kementerian, universitas, anggota legislatif, PKK, dan LSM. Sebagaimana diketahui bahwa keberhasilan status gizi masyarakat ditentukan oleh 30% sektor kesehatan dan 70% sektor non kesehatan seperti tingkat pendidikan, ekonomi dan kualitas lingkungan.</p>\r\n<p>Berita ini disiarkan oleh Pusat Komunikasi Publik Sekretariat Jenderal Kementerian Kesehatan RI. Untuk informasi lebih lanjut dapat menghubungi Halo Kemkes melalui nomor hotline &lt;kode lokal&gt; 1500-567; SMS 081281562620, faksimili: (021) 52921669, dan alamat email kontak@kemkes.go.id</p>', 'PHBS;', '2015-11-01', '12:42:52', '', 0, 6, 'Publish'),
(7, 9, 'Rajin Cek Kesehatan, Kebiasaan Cerdik Cegak Penyakit Tidak Menular', 'rajin-cek-kesehatan-kebiasaan-cerdik-cegak-penyakit-tidak-menular', '<p>Seringkali kita mendengar orang berkata penyakitnya akan lebih mudah disembuhkan, jika diketahui lebih awal. Tapi kadang-kadang gejala awal suatu penyakit tidak terasa atau tidak tampak oleh pengidapnya. Inilah pentingnya memeriksakan kesehatan secara rutin. Pengecekan kesehatan seperti ini akan sangat bermanfaat untuk mengingatkan kita akan kondisi kesehatan tubuh kita sendiri.</p>\r\n<p>Setidaknya ada tujuh hal paling umum dari tubuh kita yang perlu dicek kondisinya minimal satu tahun sekali. Ketujuh hal tersebut adalah mengecek tekanan darah, kadar gula darah, lingkar perut, kolesterol total, arus puncak ekspirasi, deteksi dini kanker leher rahim, dan periksa payudara sendiri.</p>\r\n<ul>\r\n<li>Memeriksa tekanan darah adalah salah satu cara mendeteksi secara dini risiko hipertensi, stroke, dan penyakit jantung. Angka hasil pemeriksaan terhitung normal, jika berada di bawah 140/90 mmHg.</li>\r\n<li>Pengecekan kadar gula darah dilakukan untuk membantu mendeteksi masalah diabetes. Pemeriksaan ini akan menunjukkan kadar glukosa dalam darah. Hasil tes normal, jika kadar gula dalam darah kurang dari 100.</li>\r\n<li>Mengukur lingkar perut secara rutin dapat menjaga kita dari lemak perut yang berlebihan, yang bisa memicu masalah kesehatan serius, misalnya serangan jantung, stroke, dan diabetes. Batas aman lingkar perut pria adalah 90 cm. Sementara pada wanita 80 cm.</li>\r\n<li>Pengecekan kolesterol total terdiri dari pemeriksaan kadar LDL (kolesterol buruk), HDL (kolesterol baik), dan trigliserida (lemak yang dibawa dalam darah, berasal dari makanan yang kita makan). Total hasil pengukuran yang disarankan adalah selalu di bawah angka 200.</li>\r\n<li>Arus puncak ekspirasi adalah salah satu upaya pengecekan kesehatan dalam uji fungsi paru. Biasanya, pengecekan ini dilakukan pada penderita asma atau berbagai penyakit yang mengganggu pernapasan lainnya untuk menilai kemampuan paru-paru.</li>\r\n<li>Tes <em>pap smear</em> dan tes IVA (Inspeksi Visual dengan Asam Asetat) adalah dua cara paling umum untuk mendetesi munculnya kanker leher rahim. Lakukan <em>pap smear</em> di rumah sakit, klinik dokter kandungan, maupun laboratorium dengan tenaga kesehatan terlatih. Sementara tes IVA dilakukan dengan cara mengoleskan larutan asam asetat (asam cuka 3-5 persen) pada leher rahim. Jika mengalami pra-kanker, hasilnya ditandai dengan perubahan warna agak keputihan. Metode ini sangat sederhana, sehingga Puskesmas pun dapat melakukannya.</li>\r\n<li>Pemeriksaan payudara sendiri bisa dilakukan sejak perempuan mencapai usia 20 tahun. Pengecekan ini akan lebih mudah dilakukan pada saat mandi, ketika masih ada sabun menempel di kulit. Pemeriksaan dilakukan dengan mengamati ukuran, bentuk, dan warna payudara untuk melihat adanya perubahan dan pembengkakan. Langkah berikutnya adalah menekan puting susu untuk melihat adanya cairan atau tidak, baik berupa air susu, cairan kekuningan, atau darah. Meraba payudara sambil berbaring akan memberikan petunjuk terjadinya perubahan pada payudara. <strong>(*)</strong></li>\r\n</ul>', 'PHBS;', '2015-11-01', '12:44:24', 'news-checkup.jpg', 0, 6, 'Publish');

-- --------------------------------------------------------

--
-- Table structure for table `puskesmas`
--

CREATE TABLE IF NOT EXISTS `puskesmas` (
  `kd_puskesmas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_puskesmas` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kd_desa` varchar(30) NOT NULL,
  `telp` varchar(20) NOT NULL,
  PRIMARY KEY (`kd_puskesmas`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `puskesmas`
--

INSERT INTO `puskesmas` (`kd_puskesmas`, `nama_puskesmas`, `alamat`, `kd_desa`, `telp`) VALUES
(1, 'Puskesmas contoh', 'Sumedang', '3211010001', '098'),
(3, 'Puskesmas 2', 'jl', '3211030027', '123'),
(4, 'Puskesmas Jatinangor', 'Jl raya jatinangor', '3211010006', '090');

-- --------------------------------------------------------

--
-- Table structure for table `ref_indikator_tambahan`
--

CREATE TABLE IF NOT EXISTS `ref_indikator_tambahan` (
  `kd_ref_indikator_tambahan` int(11) NOT NULL AUTO_INCREMENT,
  `kd_indikator_tambahan` int(11) NOT NULL,
  `kd_desa` varchar(50) NOT NULL,
  `nilai` varchar(50) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  PRIMARY KEY (`kd_ref_indikator_tambahan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ref_indikator_tambahan`
--

INSERT INTO `ref_indikator_tambahan` (`kd_ref_indikator_tambahan`, `kd_indikator_tambahan`, `kd_desa`, `nilai`, `bulan`, `tahun`) VALUES
(1, 3, '3211060004', '200', 10, 2015),
(2, 3, '3211060003', '', 10, 2015),
(3, 3, '3211060004', '', 11, 2015),
(4, 2, '3211010002', '', 9, 2015),
(5, 3, '3211050001', '', 11, 2015),
(6, 3, '3211010011', '20', 10, 2015),
(7, 4, '3211010001', '20', 10, 2015),
(8, 5, '3211010001', '30', 10, 2015);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sambutan`
--

INSERT INTO `sambutan` (`id_sambutan`, `nama`, `jabatan`, `foto`, `isi`) VALUES
(4, 'Prof. Dr. dr. Nila Farid Moeloek, Sp.M (K)', 'MENTERI KESEHATAN REPUBLIK INDONESIA', 'prof-dr-dr-nila-farid-moeloek-sp-m-k.jpg', '<p>Lahir di Jakarta pada11 April 1949, Prof. Dr. dr. Nila Farid Moeloek, Sp.M (K) diangkat menjadi Menteri Kesehatan RI Kabinet Kerja, 2014-sekarang. Sebelumnya beliau merupakan Utusan Khusus Presiden Republik Indonesia untuk Millenium Development Goals (MDGs), pada periode 2010?2014.</p>\r\n<p>Selain itu, Guru Besar pada Fakultas Kedokteran Universitas Indonesia, masih aktif memimpin sejumlah organisasi antara lain sebagai Ketua Umum Dharma Wanita Persatuan (2009-sekarang), Ketua Teknis Medis Bank Mata Indonesia (2007-sekarang), Ketua Perhimpunan Dokter Spesialis Mata Indonesia (2010-sekarang), Ketua Yayasan AINI (2011 - sekarang), dan Ketua Umum Yayasan Kanker Indonesia (2011-sekarang).</p>\r\n<p>&nbsp;</p>'),
(5, 'Drs. Purwadi, Apt, MM, ME', 'INSPEKTUR JENDERAL', 'drs_purwadi_apt_mm_me.png', '<p>Sebelum menjabat sebagai Inspektur Jenderal Kementerian Kesehatan, Pria kelahiran Pontianak peraih gelar Magister Management Kebijakan Publik dari Universitas Indonesia ini pernah menjabat sebagai Sekretaris Ditjen Bina Kefarmasian dan Alkes pada tahun 2011 sampai dengan februari 2015 dan Direktur Bina Obat Publik dan Perbekalan Kesehatan, Ditjen Binfar dan Alkes tahun 2008 serta Kepala Bagian Program dan Informasi Setditjen Binfar dan Alkes tahun 2006. - See more at:&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(50) NOT NULL,
  `tag_slug` varchar(50) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`, `tag_slug`) VALUES
(5, 'Alat Kesehatan', 'alat-kesehatan'),
(6, 'PHBS', 'phbs');

-- --------------------------------------------------------

--
-- Table structure for table `target_penyuluhan`
--

CREATE TABLE IF NOT EXISTS `target_penyuluhan` (
  `kd_target_penyuluhan` int(11) NOT NULL AUTO_INCREMENT,
  `kd_puskesmas` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `target_penyuluhan_dalam` int(11) NOT NULL,
  `target_penyuluhan_luar` int(11) NOT NULL,
  PRIMARY KEY (`kd_target_penyuluhan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `target_penyuluhan`
--

INSERT INTO `target_penyuluhan` (`kd_target_penyuluhan`, `kd_puskesmas`, `bulan`, `tahun`, `target_penyuluhan_dalam`, `target_penyuluhan_luar`) VALUES
(1, 1, 10, 2015, 8, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tempat`
--

CREATE TABLE IF NOT EXISTS `tempat` (
  `kd_tempat` varchar(50) NOT NULL,
  `kd_kategori` int(11) NOT NULL,
  `kd_desa` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_tempat` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `status_kesehatan` varchar(30) NOT NULL,
  `approve` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_tempat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempat`
--

INSERT INTO `tempat` (`kd_tempat`, `kd_kategori`, `kd_desa`, `user_id`, `nama_tempat`, `tanggal`, `status_kesehatan`, `approve`) VALUES
('3.3211010011.10.1', 3, '3211010011', 10, 'UNPAD JATINANGOR', '2015-10-31', 'Sehat', 'Ya'),
('4.3211010001.10.1', 4, '3211010001', 10, 'Rumah  kades', '2015-10-31', 'Sehat', 'Ya'),
('4.3211010001.10.2', 4, '3211010001', 10, 'rumah rt 1', '2015-10-31', 'Tidak Sehat', 'Ya');

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
  `kd_puskesmas` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `api_key` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `full_name`, `email`, `phone`, `bio`, `user_picture`, `user_level`, `reg_date`, `user_status`, `kd_puskesmas`, `nip`, `api_key`) VALUES
(6, 'admin', '202cb962ac59075b964b07152d234b70', 'Arif Nurdian', 'arif-letters@live.com', '085320165424', 'No god excepted Alloh.', 'member02.jpg', 1, '2015-07-14', 'Active', 0, '', '21232f297a57a5a743894a0e4a801fc3'),
(7, 'nandang', '202cb962ac59075b964b07152d234b70', 'Nandang Koswara', '', '', '', 'user_default.png', 2, '2015-07-28', 'Active', 0, '', ''),
(9, 'kapus', '202cb962ac59075b964b07152d234b70', 'KAPUS', '', '', '', 'user_default.png', 3, '2015-10-24', 'Active', 1, '123', ''),
(10, 'petugas1', 'e10adc3949ba59abbe56e057f20f883e', 'Petugas', '', '', 'here is my bio', 'user_default.png', 4, '2015-10-24', 'Active', 1, '123', ''),
(11, 'kapus2', 'e10adc3949ba59abbe56e057f20f883e', 'KAPUS', '', '', '', 'user_default.png', 3, '2015-10-26', 'Active', 3, '123', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(30) NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`level_id`, `level`) VALUES
(1, 'Administrator'),
(2, 'Admin Web'),
(3, 'Kepala Puskesmas'),
(4, 'Petugas Promkes');

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
(1, '<p>Masyarakat Sehat Yang Mandiri dan Berkeadilan</p>', '<p>&nbsp;</p>\r\n<ul>\r\n<li>Meningkatkan derajat kesehatan masyarakat, melalui pemberdayaan masyarakat, termasuk swasta dan masyarakat madani</li>\r\n<li>Melindungi kesehatan masyarakat dengan menjamin tersedianya upaya kesehatan yang paripurna, merata bermutu dan berkeadilan</li>\r\n<li>Menjamin ketersediaan dan pemerataan sumber daya kesehatan</li>\r\n<li>Menciptakan tata kelola kepemerintahan yang baik</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '<p>&nbsp;</p>\r\n<ul>\r\n<li>Meningkatkan pemberdayaan masyarakat, swasta dan masyarakat madani dalam pembangunan kesehatan melalui kerja sama nasional dan global.</li>\r\n<li>Meningkatkan pelayanan kesehatan yang merata, terjangkau, bermutu dan berkeadilan, serta berbasis bukti; dengan pengutamaan pada upaya promotif dan preventif.</li>\r\n<li>Meningkatkan pembiayaan pembangunan kesehatan, terutama untuk mewujudkan jaminan sosial kesehatan nasional.</li>\r\n<li>Meningkatkan pengembangan dan pendayagunaan SDM kesehatan yang merata dan bermutu.</li>\r\n<li>Meningkatkan ketersediaan, pemerataan, dan keterjangkauan obat dan alat kesehatan serta menjamin keamanan, khasiat, kemanfaatan, dan mutu sediaan farmasi, alat kesehatan, dan makanan.</li>\r\n<li>Meningkatkan manajemen kesehatan yang akuntabel, transparan berdayaguna dan berhasilguna untuk memantapkan desentralisasi kesehatan yang bertanggungjawab.</li>\r\n</ul>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE IF NOT EXISTS `visitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id`, `ip_address`, `date`) VALUES
(1, '127.0.0.1', '2015-10-19'),
(2, '127.0.0.1', '2015-10-24'),
(3, '127.0.0.1', '2015-11-01');
