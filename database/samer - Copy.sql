-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2016 at 09:44 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `samer`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE IF NOT EXISTS `akun` (
`id_akun` int(11) NOT NULL,
  `username_akun` varchar(30) NOT NULL,
  `password_akun` varchar(30) NOT NULL,
  `hakakses_akun` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `username_akun`, `password_akun`, `hakakses_akun`) VALUES
(1, 'super', 'super', 'Super Administrator'),
(2, 'power', 'power', 'Administrator'),
(3, 'yes', 'yes', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE IF NOT EXISTS `bahan` (
`id_bahan` int(11) NOT NULL,
  `nama_bahan` varchar(30) NOT NULL,
  `harga_bahan` varchar(30) NOT NULL,
  `stockawal_bahan` varchar(19) NOT NULL,
  `stocksisa_bahan` varchar(19) NOT NULL,
  `stockjual_bahan` varchar(19) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=305 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `harga_bahan`, `stockawal_bahan`, `stocksisa_bahan`, `stockjual_bahan`) VALUES
(1, 'Sayur ijo ( caisin)', '1000', '10000', '10000', '0'),
(2, 'baby carrot', '2000', '11000', '11000', '0'),
(3, 'Zukini', '3000', '10002', '10002', '0'),
(4, 'Sawi putih', '4000', '12000', '12000', '0'),
(5, 'kol', '6000', '10000', '10000', '0'),
(6, 'bock choy ', '65000', '10000', '10000', '0'),
(7, 'English spinach', '2300', '10000', '10000', '0'),
(8, 'Spinach lokal ', '67800', '10000', '10000', '0'),
(9, 'Mix Letucce baby', '7600', '10000', '10000', '0'),
(10, 'Baby Romaince', '800', '10000', '9728', '272'),
(11, 'Baby String bean ( Buncis)', '9500', '10000', '10000', '0'),
(12, 'terong bulat ', '10000', '10000', '10000', '0'),
(13, 'green tomato', '300000', '10000', '10000', '0'),
(14, 'tomato cherry', '40000', '10000', '10000', '0'),
(15, 'tomato ', '55000', '10000', '10000', '0'),
(16, 'carrot import', '3000', '10000', '10000', '0'),
(17, 'japanese cucumber', '4500', '10000', '10000', '0'),
(18, 'lobak', '800', '10000', '10000', '0'),
(19, 'Leek', '9500', '10000', '10000', '0'),
(20, 'lemongrass', '10000', '10000', '10000', '0'),
(21, 'lombok besar', '300000', '10000', '10000', '0'),
(22, 'green chili ', '40000', '10000', '10000', '0'),
(23, 'hot chili', '55000', '10000', '10000', '0'),
(24, 'Onion bombay', '3000', '10000', '10000', '0'),
(25, 'bottom mushroom', '4500', '10000', '10000', '0'),
(26, 'shitake mushroom', '3000', '10000', '10000', '0'),
(27, 'broccoli', '4000', '10000', '10000', '0'),
(28, 'red shallot clean', '6000', '10000', '10000', '0'),
(29, 'garlic clean', '65000', '10000', '10000', '0'),
(30, 'green paprika', '2300', '10000', '10000', '0'),
(31, 'red paprika', '67800', '10000', '10000', '0'),
(32, 'daun bawang', '1000', '10000', '10000', '0'),
(33, 'kelapa whole', '2000', '10000', '10000', '0'),
(34, 'rosemary ', '3000', '10000', '10000', '0'),
(35, 'italian basil', '4000', '10000', '10000', '0'),
(36, 'daun kemangi', '6000', '10000', '10000', '0'),
(37, 'fresh coriander', '65000', '10000', '10000', '0'),
(38, 'fresh mint', '2300', '10000', '10000', '0'),
(39, 'celery ', '67800', '10000', '10000', '0'),
(40, 'parsly', '7600', '10000', '10000', '0'),
(41, 'daun jeruk', '800', '10000', '10000', '0'),
(42, 'lemo ', '9500', '10000', '10000', '0'),
(43, 'tahu', '10000', '10000', '10000', '0'),
(44, 'tempe', '300000', '10000', '10000', '0'),
(45, 'telor ayam', '40000', '10000', '10000', '0'),
(46, 'jahe', '55000', '10000', '10000', '0'),
(47, 'kunyit', '3000', '10000', '10000', '0'),
(48, 'kencur', '4500', '10000', '10000', '0'),
(49, 'galangal', '800', '10000', '10000', '0'),
(50, 'temu kunci', '9500', '10000', '10000', '0'),
(51, 'pisang kepok', '10000', '10000', '10000', '0'),
(52, 'potato', '300000', '10000', '10000', '0'),
(53, 'chiken knorr', '40000', '10000', '10000', '0'),
(54, 'vanilla essence', '55000', '10000', '10000', '0'),
(55, 'honey blosom 840 ml', '3000', '10000', '10000', '0'),
(56, 'maple syrup 710 ml', '4500', '10000', '10000', '0'),
(57, 'fish gravy ', '3000', '10000', '10000', '0'),
(58, 'arak masak 600ml', '4000', '10000', '10000', '0'),
(59, 'sesame oil 600ml', '6000', '10000', '10000', '0'),
(60, 'white vinegar 473 ml', '65000', '10000', '10000', '0'),
(61, 'balsamic vinegar 450 ml', '2300', '10000', '7700', '2300'),
(62, 'Lea and Perrin 284 ml', '67800', '10000', '10000', '0'),
(63, 'baking powder ', '800', '10000', '9864', '136'),
(64, 'Bay leaf ', '9500', '10000', '10000', '0'),
(65, 'oregano', '10000', '10000', '10000', '0'),
(66, 'baked bean', '300000', '10000', '-1500', '11500'),
(67, 'maezena', '40000', '10000', '10000', '0'),
(68, 'chinamon stick', '55000', '10000', '10000', '0'),
(69, 'olive oil', '3000', '10000', '10000', '0'),
(70, 'gula merah', '4500', '10000', '10000', '0'),
(71, 'terasi', '3000', '10000', '10000', '0'),
(72, 'knorr tom yum paste', '4000', '10000', '10000', '0'),
(73, 'asam jawa', '6000', '10000', '8850', '1150'),
(74, 'candlenut ( kemiri)', '65000', '10000', '10000', '0'),
(75, 'oyster sauce can', '2300', '10000', '10000', '0'),
(76, 'mix tepung pancake', '67800', '10000', '10000', '0'),
(77, 'icing sugar', '1000', '10000', '10000', '0'),
(78, 'tepung tempura', '2000', '10000', '10000', '0'),
(79, 'black pepper whole', '3000', '10000', '10000', '0'),
(80, 'ketan hitam', '4000', '10000', '10000', '0'),
(81, 'ketan', '6000', '10000', '10000', '0'),
(82, 'kacang tanah ', '65000', '10000', '10000', '0'),
(83, 'cengkeh', '2300', '10000', '10000', '0'),
(84, 'nutmeg (Pala)', '67800', '10000', '10000', '0'),
(85, 'coriander seed ( bubuk ketumba', '7600', '10000', '10000', '0'),
(86, 'bean sprout', '800', '10000', '10000', '0'),
(87, 'Pumpkin ( labu kuning)', '9500', '10000', '10000', '0'),
(88, 'tangerine super', '10000', '10000', '10000', '0'),
(89, 'nanas', '300000', '10000', '10000', '0'),
(90, 'kelapa muda', '40000', '10000', '10000', '0'),
(91, 'semangka', '55000', '10000', '10000', '0'),
(92, 'pepaya', '3000', '10000', '10000', '0'),
(93, 'honeydew', '4500', '10000', '10000', '0'),
(94, 'rock melon', '800', '10000', '10000', '0'),
(95, 'salak', '9500', '10000', '10000', '0'),
(96, 'rambutan', '10000', '10000', '10000', '0'),
(97, 'mangga', '300000', '10000', '10000', '0'),
(98, 'lemon ', '40000', '10000', '10000', '0'),
(99, 'sunkist', '55000', '10000', '10000', '0'),
(100, 'lime', '3000', '10000', '10000', '0'),
(101, 'strawberry', '4500', '10000', '10000', '0'),
(102, 'avocado', '3000', '10000', '10000', '0'),
(103, 'apel lokal', '4000', '10000', '8365', '1635'),
(104, 'pear hijau', '6000', '10000', '10000', '0'),
(105, 'markisa', '65000', '10000', '10000', '0'),
(106, 'pisang mas', '2300', '10000', '10000', '0'),
(107, 'fresh milk', '67800', '10000', '10000', '0'),
(108, 'yoghurt plain', '1000', '10000', '10000', '0'),
(109, 'Manggis', '2000', '10000', '10000', '0'),
(110, 'Strawberry gelato', '3000', '10000', '10000', '0'),
(111, 'coconut gelato', '4000', '10000', '10000', '0'),
(112, 'strawberry sorbet', '6000', '10000', '10000', '0'),
(113, 'green tea sorbet', '65000', '10000', '10000', '0'),
(114, 'Guava sorbet', '2300', '10000', '10000', '0'),
(115, 'mango sorbet', '67800', '10000', '10000', '0'),
(116, 'chocolato gelato', '7600', '10000', '10000', '0'),
(117, 'Rum raisin ice Cream', '800', '10000', '10000', '0'),
(118, 'lime sorbet', '9500', '10000', '10000', '0'),
(119, 'Vanilla gelato', '10000', '10000', '10000', '0'),
(120, 'lecci can', '300000', '10000', '10000', '0'),
(121, 'cherry red', '40000', '10000', '10000', '0'),
(122, 'ice crush', '55000', '10000', '10000', '0'),
(123, 'ice cube', '3000', '10000', '10000', '0'),
(124, 'Equil', '4500', '10000', '10000', '0'),
(125, 'san pelegrino', '800', '10000', '10000', '0'),
(126, 'coke', '9500', '10000', '10000', '0'),
(127, 'diet coke', '10000', '10000', '10000', '0'),
(128, 'sprite', '300000', '10000', '10000', '0'),
(129, 'soda water', '40000', '10000', '10000', '0'),
(130, 'tonic water', '55000', '10000', '10000', '0'),
(131, 'ginger ale', '3000', '10000', '10000', '0'),
(132, 'vodka smirnoff', '4500', '10000', '10000', '0'),
(133, 'rum brugal', '3000', '10000', '10000', '0'),
(134, 'Tequilla ( Jose cuervo)', '4000', '10000', '10000', '0'),
(135, 'Dry Gin ( gordon Dry Gin)', '6000', '10000', '10000', '0'),
(136, 'cointrau', '65000', '10000', '10000', '0'),
(137, 'lime cordial', '2300', '10000', '10000', '0'),
(138, 'kahlua', '67800', '10000', '10000', '0'),
(139, 'Jack Danniel', '800', '10000', '10000', '0'),
(140, 'blue Curacao', '9500', '10000', '10000', '0'),
(141, 'hatten tunjung', '10000', '10000', '10000', '0'),
(142, 'hatten Jepun', '300000', '10000', '10000', '0'),
(143, 'hatten aga red wine', '40000', '10000', '10000', '0'),
(144, 'hatten aga white wine', '55000', '10000', '10000', '0'),
(145, 'hatten rose', '3000', '10000', '10000', '0'),
(146, 'two island shiraz', '4500', '10000', '10000', '0'),
(147, 'two island chardonnay', '3000', '10000', '10000', '0'),
(148, 'beer bintang small ( Restauran', '4000', '10000', '10000', '0'),
(149, 'beer bintang small (Villa )', '6000', '10000', '10000', '0'),
(150, 'heineken small', '65000', '10000', '10000', '0'),
(151, 'syrup marjan strawberry', '2300', '10000', '10000', '0'),
(152, 'Illy coffe 250 gram', '67800', '10000', '10000', '0'),
(153, 'nescaffee 3 in 1 sachet', '1000', '10000', '10000', '0'),
(154, 'tropicana slim', '2000', '10000', '10000', '0'),
(155, 'brown sugar', '3000', '10000', '10000', '0'),
(156, 'Max Creamer', '4000', '10000', '10000', '0'),
(157, 'Creamer Without logo', '6000', '10000', '10000', '0'),
(158, 'Lipton yelow label', '65000', '10000', '10000', '0'),
(159, 'Sari Wangi ', '2300', '10000', '10000', '0'),
(160, 'Kopi Bali', '67800', '10000', '10000', '0'),
(161, 'Gula sachet', '7600', '10000', '10000', '0'),
(162, 'Vanilla bourbon', '800', '10000', '10000', '0'),
(163, 'Water fruit green tea', '9500', '10000', '10000', '0'),
(164, 'sencha', '10000', '10000', '10000', '0'),
(165, 'chamomile', '300000', '10000', '10000', '0'),
(166, 'English breakfast', '40000', '10000', '10000', '0'),
(167, 'Marocan mint', '55000', '10000', '10000', '0'),
(168, 'Beef Tenderloin', '3000', '10000', '9290', '710'),
(169, 'Pork ribs', '4500', '10000', '10000', '0'),
(170, 'Pork Loin', '800', '10000', '10000', '0'),
(171, 'Prawn', '9500', '10000', '10000', '0'),
(172, 'Chicken Leg', '10000', '10000', '10000', '0'),
(173, 'Baby Chicken', '300000', '10000', '10000', '0'),
(174, 'Chicken breast', '40000', '10000', '9968', '32'),
(175, 'Duck Breast', '55000', '10000', '10000', '0'),
(176, 'Lamb Rack', '3000', '10000', '10000', '0'),
(177, 'Squid', '4500', '10000', '10000', '0'),
(178, 'Tuna Loin', '3000', '10000', '10000', '0'),
(179, 'Snapper Filleted', '4000', '10000', '10000', '0'),
(180, 'Baramundi Filleted', '6000', '10000', '10000', '0'),
(181, 'Lobster ', '65000', '10000', '10000', '0'),
(182, 'Green Mussel', '2300', '10000', '10000', '0'),
(183, 'Minced Beef', '67800', '10000', '10000', '0'),
(184, 'Ham', '1000', '10000', '10000', '0'),
(185, 'Streaky Bacon', '2000', '10000', '10000', '0'),
(186, 'Smoked salmon', '3000', '10000', '10000', '0'),
(187, 'chicken sausage', '4000', '10000', '10000', '0'),
(188, 'Oxtail', '6000', '10000', '10000', '0'),
(189, 'Beef rump', '65000', '10000', '9866', '134'),
(190, 'Brown Toast whole', '2300', '10000', '10000', '0'),
(191, 'Brown Toast Slice', '67800', '10000', '10000', '0'),
(192, 'White toast slice', '7600', '10000', '10000', '0'),
(193, 'Danish', '800', '10000', '10000', '0'),
(194, 'Croisant', '9500', '10000', '10000', '0'),
(195, 'Breakfast  roll', '10000', '10000', '10000', '0'),
(196, 'Raisin bread', '300000', '10000', '10000', '0'),
(197, 'Grisini Stick', '40000', '10000', '10000', '0'),
(198, 'Sweet Tartlet', '55000', '10000', '10000', '0'),
(199, 'Salty tartlet', '3000', '10000', '10000', '0'),
(200, 'Pizza dough', '4500', '10000', '10000', '0'),
(201, 'Ciabatta', '800', '10000', '10000', '0'),
(202, 'Burger Bun', '9500', '10000', '10000', '0'),
(203, 'Chocolate Compound', '10000', '10000', '10000', '0'),
(204, 'Mascarpone cheese', '300000', '10000', '10000', '0'),
(205, 'White Chocolate compound ', '40000', '10000', '10000', '0'),
(206, 'Dried raisin', '55000', '10000', '10000', '0'),
(207, 'Craft single cheese', '3000', '10000', '10000', '0'),
(208, 'parmesan cheese', '4500', '10000', '10000', '0'),
(209, 'Mozzarella cheese', '3000', '10000', '10000', '0'),
(210, 'Kulit Lumpia', '4000', '10000', '10000', '0'),
(211, 'French fries', '6000', '10000', '10000', '0'),
(212, 'Mayonaise', '65000', '10000', '10000', '0'),
(213, 'Santan  kara', '2300', '10000', '10000', '0'),
(214, 'cooking cream', '67800', '10000', '10000', '0'),
(215, 'topping cream', '800', '10000', '10000', '0'),
(216, 'Cookies', '9500', '10000', '10000', '0'),
(217, 'yellow mustard french', '10000', '10000', '10000', '0'),
(218, 'Casava', '300000', '10000', '10000', '0'),
(219, 'Sambal bangkok', '40000', '10000', '10000', '0'),
(220, 'Tomato Ketchup', '55000', '10000', '10000', '0'),
(221, 'Sauce Sambal', '3000', '10000', '10000', '0'),
(222, 'Kecap Manis', '4500', '10000', '10000', '0'),
(223, 'Bimoli (1 galon 18 Liter)', '3000', '10000', '10000', '0'),
(224, 'Aqua Galon', '4000', '10000', '9360', '640'),
(225, 'Kecap Asin', '6000', '10000', '10000', '0'),
(226, 'Mie Telor atom Bulan', '65000', '10000', '10000', '0'),
(227, 'Moesly', '2300', '10000', '10000', '0'),
(228, 'Coco Crunch', '67800', '10000', '10000', '0'),
(229, 'Corn flake', '1000', '10000', '10000', '0'),
(230, 'Dried coconut', '2000', '10000', '10000', '0'),
(231, 'Green curry paste', '3000', '10000', '10000', '0'),
(232, 'Kwe tiaw kering', '4000', '10000', '10000', '0'),
(233, 'Bread crumb / panko', '6000', '10000', '10000', '0'),
(234, 'gelatin', '65000', '10000', '10000', '0'),
(235, 'Jelfix', '2300', '10000', '10000', '0'),
(236, 'Penne pasta', '67800', '10000', '10000', '0'),
(237, 'spaghetti', '7600', '10000', '10000', '0'),
(238, 'Fetuchini', '800', '10000', '10000', '0'),
(239, 'SO Hun', '9500', '10000', '10000', '0'),
(240, 'Black Ink Petuchini', '10000', '10000', '10000', '0'),
(241, 'Krupuk Udang', '300000', '10000', '10000', '0'),
(242, 'Cinamon stick', '40000', '10000', '10000', '0'),
(243, 'Vanilla stick', '55000', '10000', '10000', '0'),
(244, 'Tepung terigu', '3000', '10000', '10000', '0'),
(245, 'tepung Ketan', '4500', '10000', '10000', '0'),
(246, 'tepung Beras', '800', '10000', '10000', '0'),
(247, 'Tempat saus plastik', '9500', '10000', '10000', '0'),
(248, 'Tempat jus plastik', '10000', '10000', '10000', '0'),
(249, 'Plastik 2 kg', '300000', '10000', '10000', '0'),
(250, 'plastik 0.5 kg', '40000', '10000', '10000', '0'),
(251, 'tomato paste', '55000', '10000', '10000', '0'),
(252, 'jagung manis', '3000', '10000', '10000', '0'),
(253, 'tusuk sate', '4500', '10000', '10000', '0'),
(254, 'katik sate lilit', '3000', '10000', '10000', '0'),
(255, 'spon cuci piring', '4000', '10000', '10000', '0'),
(256, 'kawat cuci piring', '6000', '10000', '10000', '0'),
(257, 'Gula pasir import', '65000', '10000', '10000', '0'),
(258, 'Cocoa powder ( 90 gram)', '2300', '10000', '10000', '0'),
(259, 'syrup marjan melon', '67800', '10000', '10000', '0'),
(260, 'Daun SaLam', '1000', '10000', '10000', '0'),
(261, 'Rice paper', '2000', '10000', '10000', '0'),
(262, 'wasabi 50 gram', '3000', '10000', '10000', '0'),
(263, 'Beras pandan wangi', '4000', '10000', '10000', '0'),
(264, 'sake mirin 300 ml', '6000', '10000', '10000', '0'),
(265, 'pandan pasta', '65000', '10000', '10000', '0'),
(266, 'cuka dixi', '2300', '10000', '10000', '0'),
(267, 'Cashew nut', '67800', '10000', '10000', '0'),
(268, 'Green pea', '7600', '10000', '10000', '0'),
(269, 'Garam', '800', '10000', '10000', '0'),
(270, 'butter', '9500', '10000', '10000', '0'),
(271, 'Nangka matang', '10000', '10000', '10000', '0'),
(272, 'jungle juice orange', '300000', '10000', '10000', '0'),
(273, 'jungle juice nanas', '40000', '10000', '10000', '0'),
(274, 'breakfast box', '55000', '10000', '10000', '0'),
(275, 'Beef bones', '3000', '10000', '10000', '0'),
(276, 'Minyak tanusan bali', '4500', '10000', '10000', '0'),
(277, 'Sirup marjan delima', '800', '10000', '10000', '0'),
(278, 'Straw hitam isi 100 pcs', '9500', '10000', '10000', '0'),
(279, 'kikoman soy sauce', '10000', '10000', '10000', '0'),
(280, 'Telor ayam kampung', '300000', '10000', '10000', '0'),
(281, 'Pete Clean', '40000', '10000', '10000', '0'),
(282, 'Garpu plastik', '55000', '10000', '10000', '0'),
(283, 'susu dancow', '3000', '10000', '10000', '0'),
(284, 'Aji no moto', '4500', '10000', '9360', '640'),
(285, 'bento box', '3000', '10000', '10000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `detailpembelian`
--

CREATE TABLE IF NOT EXISTS `detailpembelian` (
  `id_detailpembelian` varchar(20) NOT NULL,
  `tgl_detailpembelian` date NOT NULL,
  `idbahan_detailpembelian` int(11) NOT NULL,
  `qty_detailpembelian` varchar(19) NOT NULL,
  `harga_detailpembelian` varchar(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailpembelian`
--

INSERT INTO `detailpembelian` (`id_detailpembelian`, `tgl_detailpembelian`, `idbahan_detailpembelian`, `qty_detailpembelian`, `harga_detailpembelian`) VALUES
('160626114341', '2016-06-25', 2, '1000', '2000'),
('160626114341', '2016-06-25', 4, '2000', '8000'),
('160627122044', '2016-06-25', 3, '2', '6');

-- --------------------------------------------------------

--
-- Table structure for table `detailpenjualan`
--

CREATE TABLE IF NOT EXISTS `detailpenjualan` (
  `id_detailpenjualan` varchar(20) NOT NULL,
  `tgl_detailpenjualan` date NOT NULL,
  `idmenu_detailpenjualan` int(11) NOT NULL,
  `qty_detailpenjualan` varchar(19) NOT NULL,
  `harga_detailpenjualan` varchar(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`id_detailpenjualan`, `tgl_detailpenjualan`, `idmenu_detailpenjualan`, `qty_detailpenjualan`, `harga_detailpenjualan`) VALUES
('160625061100', '2016-06-02', 1, '1', '65000'),
('160625061351', '2016-06-02', 1, '2', '130000'),
('160625061751', '2016-06-02', 2, '1', '65000'),
('160625062939', '2016-06-02', 1, '1', '65000'),
('160625062939', '2016-06-02', 2, '1', '65000'),
('160626053245', '2016-06-26', 7, '1', '52000'),
('160626054923', '2016-06-26', 1, '27', '1820000'),
('160626054923', '2016-06-26', 2, '114', '7410000'),
('160626054923', '2016-06-26', 3, '136', '7072000'),
('160626054923', '2016-06-26', 7, '15', '780000'),
('160626054923', '2016-06-26', 4, '142', '6461000'),
('160626054923', '2016-06-26', 5, '67', '3484000'),
('160626054923', '2016-06-26', 6, '35', '1592500');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
`id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Indonesian Appetizer'),
(2, 'Indonesia Maincourse'),
(3, 'Western Appetizer'),
(4, 'Western Maincourse'),
(5, 'Asian Appertizer'),
(6, 'Asian Maincourse');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id_menu` int(11) NOT NULL,
  `idkategori_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `rc_menu` varchar(19) NOT NULL,
  `gc_menu` varchar(19) NOT NULL,
  `sc_menu` varchar(19) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `idkategori_menu`, `nama_menu`, `rc_menu`, `gc_menu`, `sc_menu`) VALUES
(1, 1, 'Selada Udang Madu', '35000', '10000', '5000'),
(2, 1, 'Tuna Dabu - Dabu', '35000', '10000', '5000'),
(3, 1, 'Shitake Lumpia', '30000', '5000', '7300'),
(4, 1, 'Soto Ayam', '25000', '5000', '4610'),
(5, 1, 'Sop Sari Segara', '37300', '2500', '2500'),
(6, 1, 'Sayur Bening', '25000', '5000', '4610'),
(7, 1, 'Kerang Hijau Bakar', '25000', '10000', '7300');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `id_pembelian` varchar(30) NOT NULL,
  `iddetailpembelian_pembelian` varchar(20) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `totalqty_pembelian` varchar(19) NOT NULL,
  `totalharga_pembelian` varchar(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `iddetailpembelian_pembelian`, `tgl_pembelian`, `totalqty_pembelian`, `totalharga_pembelian`) VALUES
('sldjkasjdlasd', '160626114341', '2016-06-27', '3000', '10000'),
('sdsad', '160627122044', '2016-06-27', '2', '6');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` varchar(30) NOT NULL,
  `iddetailpenjualan_penjualan` varchar(20) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `totalqty_penjualan` varchar(19) NOT NULL,
  `totalharga_penjualan` varchar(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `iddetailpenjualan_penjualan`, `tgl_penjualan`, `totalqty_penjualan`, `totalharga_penjualan`) VALUES
('1asdasd', '160625061100', '2016-06-25', '1', '65000'),
('adasdsadqw', '160626053245', '2016-06-26', '1', '52000'),
('hgfgfghfgh', '160625062939', '2016-06-25', '2', '130000'),
('hgjhgjgjh', '160625061751', '2016-06-25', '1', '65000'),
('ljkljkljl', '160626054923', '2016-06-26', '536', '28619500'),
('sdasdadas', '160625061351', '2016-06-25', '2', '130000');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE IF NOT EXISTS `resep` (
`id_resep` int(11) NOT NULL,
  `idmenu_resep` int(11) NOT NULL,
  `idbahan_resep` int(11) NOT NULL,
  `banyakbahan_resep` varchar(19) NOT NULL,
  `statusbahan_resep` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id_resep`, `idmenu_resep`, `idbahan_resep`, `banyakbahan_resep`, `statusbahan_resep`) VALUES
(1, 1, 284, '20', 'Digunakan'),
(2, 1, 103, '50', 'Digunakan'),
(3, 1, 224, '20', 'Digunakan'),
(4, 2, 66, '100', 'Digunakan'),
(5, 2, 61, '20', 'Digunakan'),
(6, 2, 73, '10', 'Digunakan'),
(7, 3, 10, '2', 'Digunakan'),
(8, 3, 63, '1', 'Digunakan'),
(9, 4, 168, '5', 'Digunakan'),
(10, 5, 189, '2', 'Digunakan'),
(11, 6, 103, '1', 'Digunakan'),
(12, 7, 174, '2', 'Digunakan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
 ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
 ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
 ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
 ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
 ADD PRIMARY KEY (`id_resep`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=305;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
