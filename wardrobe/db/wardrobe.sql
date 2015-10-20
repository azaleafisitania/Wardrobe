-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2015 at 02:21 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wardrobe`
--
CREATE DATABASE IF NOT EXISTS `wardrobe` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `wardrobe`;

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE IF NOT EXISTS `accessories` (
  `id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `shape` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `type`, `shape`) VALUES
(51, 'Headband', 'Bow'),
(52, 'Hair tie', 'Cute'),
(53, 'Hair tie', ''),
(54, 'Necklace', ''),
(55, 'Brooch', ''),
(56, 'Hair tie', 'Rose'),
(57, 'Headband', ''),
(58, 'Hair clip', 'Bow'),
(59, 'Hair clip', ''),
(60, 'Necklace', 'Rose'),
(61, 'Necklace', 'Oval'),
(62, 'Hair tie', ''),
(63, 'Hair tie', 'Pearl'),
(64, 'Headband', 'Bow, Pearl'),
(65, 'Brooch', 'Bow'),
(66, 'Hair tie', 'Pearl'),
(67, 'Bow tie', ''),
(68, 'Hair clip', 'Bow'),
(69, 'Hair clip', 'Rose'),
(70, 'Collar', ''),
(71, 'Necklace', ''),
(72, 'Bracelet', ''),
(73, 'Headband', 'Bow'),
(74, 'Hair clip', 'Bow'),
(75, 'Headband', 'Bow'),
(76, 'Headband', 'Rose'),
(77, 'Headband', 'Chain'),
(78, 'Ring', 'Clover'),
(79, 'Necklace', 'Cat, Key, Pearl'),
(80, 'Brooch', 'Oval, Bird'),
(81, 'Headband', 'Bow'),
(82, 'Brooch', 'Oval, Paris'),
(83, 'Hair clip', 'Bow');

-- --------------------------------------------------------

--
-- Table structure for table `bags`
--

CREATE TABLE IF NOT EXISTS `bags` (
  `id` int(255) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `material` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bags`
--

INSERT INTO `bags` (`id`, `type`, `material`) VALUES
(91, 'Clutch', 'Suede'),
(92, 'Tote bag', 'Canvas'),
(93, 'Backpack', 'Real Leather'),
(94, 'Handbag', 'Canvas'),
(95, 'Handbag', 'Fabric'),
(96, 'Handbag', 'Fabric'),
(97, 'Backpack', 'Jeans'),
(98, 'Handbag', 'Faux Leather');

-- --------------------------------------------------------

--
-- Table structure for table `bottoms`
--

CREATE TABLE IF NOT EXISTS `bottoms` (
  `id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` varchar(4) DEFAULT NULL,
  `length` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bottoms`
--

INSERT INTO `bottoms` (`id`, `type`, `size`, `length`) VALUES
(1, 'Pants', 'L', 'Long'),
(2, 'Pants', 'XXXL', 'Long'),
(3, 'Pants', '', 'Long'),
(4, 'Pants', 'XL', 'Long'),
(5, 'Skirt', '', 'Long'),
(6, 'Pants', 'XXL', 'Long'),
(7, 'Pants', '', 'Long'),
(8, 'Pants', '', 'Long'),
(9, 'Skirt', '', 'Knee'),
(10, 'Skirt', '', 'Knee'),
(330, 'Span skirt', NULL, 'Knee');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `total`) VALUES
(1, 'accessories', 33),
(2, 'bags', 6),
(3, 'bottoms', 9),
(4, 'dresses', 3),
(5, 'hats', 2),
(6, 'outer', 14),
(7, 'scarfs', 11),
(8, 'shoes', 4),
(9, 'socks', 10),
(10, 'tops', 47),
(11, 'underwears', 19);

-- --------------------------------------------------------

--
-- Table structure for table `clothes`
--

CREATE TABLE IF NOT EXISTS `clothes` (
  `id` int(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `photo` varchar(32) DEFAULT NULL,
  `brand` varchar(16) DEFAULT NULL,
  `fav` int(1) DEFAULT NULL,
  `color` varchar(27) DEFAULT NULL,
  `pattern` varchar(13) DEFAULT NULL,
  `retailer` varchar(25) DEFAULT NULL,
  `occasion` varchar(100) DEFAULT NULL,
  `price` int(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clothes`
--

INSERT INTO `clothes` (`id`, `category`, `photo`, `brand`, `fav`, `color`, `pattern`, `retailer`, `occasion`, `price`, `comment`) VALUES
(1, 'tops', 'C360_2015-08-03-09-43-53-031.jpg', 'Dust', 1, 'Deep blue', 'Floral', 'Matahari Department Store', 'Casual', NULL, ''),
(2, 'tops', 'C360_2015-08-03-09-14-57-160.jpg', 'Triset', 0, 'Beige', 'Floral', 'Matahari Department Store', '', NULL, ''),
(3, 'tops', 'C360_2015-06-07-11-01-06-200.jpg', 'St. Yves', 1, 'Pink', 'Lace', 'Matahari Department Store', 'Formal', NULL, ''),
(4, 'tops', 'C360_2015-06-07-11-09-34-429.jpg', 'St. Yves', 1, 'Black, White', 'Plain', 'Matahari Department Store', 'Formal', NULL, ''),
(5, 'tops', 'C360_2015-04-07-01-39-30-831.jpg', '', 0, 'Deep Brown', 'Floral', 'Pasar Salman', '', NULL, ''),
(6, 'tops', 'C360_2015-06-07-09-49-18-833.jpg', '', 1, 'Deep Pink', 'Plain', 'Given', '', NULL, ''),
(7, 'tops', 'C360_2015-04-07-01-27-19-866.jpg', 'Corniche', 0, 'Green, Pink', 'Floral', 'Matahari Department Store', '', NULL, ''),
(8, 'tops', 'C360_2015-05-31-14-29-11-896.jpg', '', 1, 'Deep Brown', 'Plain, Floral', 'Given', '', NULL, ''),
(9, 'tops', 'C360_2015-07-19-08-41-03-441.jpg', 'Triset', 1, 'Red, Deep brown, Beige', 'Chevron', 'Matahari Department Store', '', NULL, ''),
(10, 'tops', 'C360_2015-07-18-08-14-01-683.jpg', 'Triset', 1, 'Deep brown', 'Plain', 'Matahari Department Store', '', NULL, ''),
(11, 'tops', 'C360_2015-03-22-16-36-38-422.jpg', 'Novel Mice', 1, 'White, Black', 'Plain', 'Matahari Department Store', '', NULL, ''),
(12, 'tops', 'C360_2015-06-07-09-19-43-922.jpg', 'Annissa', 0, 'Blue, Green, Orange', 'Batik', 'Matahari Department Store', '', NULL, ''),
(13, 'tops', 'C360_2015-07-11-15-34-14-042.jpg', 'Puricia', 0, 'Pink, Red', 'Floral', 'Matahari Department Store', '', NULL, ''),
(14, 'tops', 'C360_2015-06-07-10-55-48-041.jpg', '', 0, 'White, Cyan', 'Plain', 'Veritrans Indonesia', '', NULL, ''),
(15, 'tops', 'C360_2015-08-03-09-51-16-149.jpg', 'Country Fiesta', 0, 'White', 'Plain', 'Bandung Indah Plaza', '', NULL, ''),
(16, 'tops', 'C360_2015-08-03-09-53-56-157.jpg', 'Country Fiesta', 0, 'Black', 'Plain', 'Bandung Indah Plaza', '', NULL, ''),
(17, 'tops', 'C360_2015-03-22-21-55-26-775.jpg', '', 0, 'Black, Yellow', 'Plain', 'HMIF Merchandise', '', NULL, ''),
(18, 'tops', 'C360_2015-04-18-15-04-22-918.jpg', 'Lea', 1, 'Black', 'Plain', 'Matahari Department Store', '', NULL, ''),
(19, 'tops', 'C360_2015-04-18-17-53-40-922.jpg', 'Two Seventeen', 0, 'Blue, Brown', 'Polka dot', '', '', NULL, ''),
(20, 'tops', 'C360_2015-08-03-09-27-28-036.jpg', 'Flashy', 1, 'White, Orange', 'Print', 'HelloFest', '', NULL, ''),
(21, 'tops', 'C360_2015-04-18-15-01-50-043.jpg', 'Novel Mice', 1, 'Green', 'Plain, Floral', 'Matahari Department Store', '', NULL, ''),
(22, 'tops', 'C360_2015-08-03-09-20-18-062.jpg', '', 1, 'White', 'Plain', '', '', NULL, ''),
(23, 'Tops', 'C360_2015-04-26-11-06-04-070.jpg', 'Hassenda', 1, 'Beige, Red', 'Tartan Check', 'Matahari', 'Formal, Casual', 0, ''),
(24, 'tops', 'C360_2015-04-07-01-30-36-092.jpg', 'Carina Swarovski', 0, 'Light blue, Light pink', 'Plain, Floral', 'Given', '', NULL, ''),
(25, 'tops', 'C360_2015-05-31-14-21-32-227.jpg', 'Novel Mice', 0, 'Pink, Blue', 'Floral', 'Matahari Department Store', '', NULL, ''),
(26, 'tops', 'C360_2015-04-26-12-15-09-237.jpg', 'Triset', 1, 'Beige', 'Tartan check', 'Matahari Department Store', '', NULL, ''),
(28, 'tops', 'C360_2015-04-07-01-29-32-415.jpg', 'St. Yves', 1, 'Orange, Red, White', 'Tartan check', 'Matahari Department Store', '', NULL, ''),
(29, 'tops', 'C360_2015-08-03-09-25-15-506.jpg', 'Triset', 1, 'Gray', 'Print', 'Matahari Department Store', '', NULL, ''),
(30, 'tops', 'C360_2015-08-02-15-57-33-642.jpg', 'Novel Mice', 1, 'Deep Brown', 'Plain', 'Matahari Department Store', '', NULL, ''),
(31, 'tops', 'C360_2015-06-07-12-20-00-779.jpg', '', 0, 'White, Blue navy', 'Plain', '', '', NULL, ''),
(32, 'tops', 'C360_2015-04-07-01-28-33-813.jpg', 'Rodeo', 1, 'Red, White', 'Tartan check', 'Matahari Department Store', '', NULL, ''),
(33, 'tops', 'C360_2015-04-18-16-52-38-874.jpg', '', 1, 'White, Purple', 'Floral', 'Given', '', NULL, ''),
(34, 'tops', 'C360_2015-06-07-12-08-04-986.jpg', 'Boy''s Room', 1, 'White', 'Plain', 'Pasar Salman', '', NULL, ''),
(35, 'tops', 'C360_2015-08-03-09-30-11-990.jpg', 'Dust', 1, 'Brown, White', 'Floral', 'Matahari Department Store', '', NULL, ''),
(36, 'tops', 'C360_2015-04-26-12-13-22-006.jpg', 'Graphis', 0, 'Beige', 'Plain', 'Matahari Department Store', '', NULL, ''),
(37, 'tops', 'C360_2015-03-22-16-15-57-495.jpg', 'Novel Mice', 1, 'Black', 'Plain, Floral', 'Matahari Department Store', '', NULL, ''),
(38, 'tops', 'C360_2015-08-03-09-31-37-518.jpg', 'Triset', 0, 'Brown', 'Stripes', 'Matahari Department Store', '', NULL, ''),
(39, 'tops', 'C360_2015-05-14-14-46-20-987.jpg', 'Triset', 1, 'Green, Orange', 'Tartan', 'Matahari Department Store', '', NULL, ''),
(40, 'tops', 'C360_2015-07-29-09-47-37-803.jpg', 'Corniche', 0, 'Pink', 'Plain', 'Matahari Department Store', '', NULL, ''),
(42, 'tops', 'C360_2015-04-18-16-51-11-002.jpg', 'Triset Ladies', 1, 'Deep red, Deep brown, White', 'Ornament', 'Matahari Department Store', 'Casual, Formal', NULL, 'The most pretty sweater'),
(43, 'tops', 'C360_2015-05-31-14-06-23-028.jpg', 'Nevada', 1, 'Pink, Black', 'Plain', 'Matahari Department Store', '', NULL, ''),
(44, 'tops', 'C360_2015-04-26-12-10-16-738.jpg', 'Corniche', 1, 'Deep Pink', 'Floral', 'Matahari Department Store', '', NULL, ''),
(45, 'tops', 'C360_2015-08-22-08-18-47-035.jpg', '', 1, 'White', 'Crochet', 'Pasar Salman', '', NULL, ''),
(46, 'tops', 'C360_2015-08-02-15-43-12-012.jpg', 'Include', 1, 'White, Green', 'Stripes', 'Matahari Department Store', '', NULL, ''),
(47, 'tops', 'C360_2015-06-07-11-53-44-452.jpg', 'Calais Tea', 1, 'Black, Pink', 'Plain', 'Riau Junction', '', NULL, ''),
(49, 'tops', 'C360_2015-08-30-08-16-04-765.jpg', 'Eclaire', 0, 'White', 'Plain', 'Pasar Salman', 'Formal', NULL, ''),
(50, 'tops', 'C360_2015-09-29-09-21-04-347.jpg', 'Phenomenal', 1, 'Green tosca, White', 'Stripes', 'Matahari', 'Casual', 50000, ''),
(51, 'accessories', 'C360_2015-04-21-09-07-41-062.jpg', 'N/a', 1, 'Deep Green', 'Plain', 'Stroberi', 'Formal, Casual', 0, ''),
(52, 'accessories', 'C360_2015-04-21-10-13-54-190.jpg', 'n/a', 0, 'Maroon red', 'Plain', 'Stroberi', 'Formal', NULL, ''),
(53, 'accessories', 'C360_2015-04-20-16-51-49-201.jpg', 'n/a', 1, 'White, Light blue', 'Diamond', 'Stroberi', 'Casual', NULL, ''),
(54, 'accessories', 'C360_2015-04-21-09-18-19-345.jpg', 'n/a', 0, 'Bronze, White', '', 'Pasar Seni ITB 2014', 'Formal', NULL, ''),
(55, 'accessories', 'C360_2015-04-20-17-31-52-465.jpg', 'n/a', 0, 'White, Light blue, Light pi', 'Abstract', 'Pasar Salman', 'Casual', NULL, ''),
(56, 'accessories', 'C360_2015-04-20-16-53-48-486.jpg', 'n/a', 1, 'Pink', 'Plain', 'n/a', '', NULL, ''),
(57, 'accessories', 'C360_2015-04-21-09-06-40-573.jpg', 'n/a', 0, 'Black', 'Plain', 'Matahari', '', NULL, ''),
(58, 'accessories', 'C360_2015-04-20-16-56-13-600.jpg', 'n/a', 1, 'Pink, White', 'Polka dot', 'n/a', '', NULL, ''),
(59, 'accessories', 'C360_2015-04-20-16-57-12-625.jpg', 'n/a', 0, 'Black, Gold', 'Plain', 'n/a', '', NULL, ''),
(60, 'accessories', 'C360_2015-04-21-09-16-41-631.jpg', 'n/a', 0, 'Pink, Silver', 'Plain', 'n/a', '', NULL, ''),
(61, 'accessories', 'C360_2015-04-21-09-20-43-655.jpg', 'n/a', 0, 'Red, Bronze', 'Print', 'Stroberi', '', NULL, ''),
(62, 'accessories', 'C360_2015-05-04-07-25-39-692.jpg', 'n/a', 1, 'Grey', 'Stripes', 'n/a', '', NULL, ''),
(63, 'accessories', 'C360_2015-04-20-17-34-22-695.jpg', 'n/a', 0, 'Orange', 'Plain', 'BIP', '', NULL, ''),
(64, 'accessories', 'C360_2015-04-21-09-05-47-842.jpg', 'n/a', 0, 'Pink, Beige', 'Plain', 'BIP', '', NULL, ''),
(65, 'accessories', 'C360_2015-04-20-17-05-56-932.jpg', 'n/a', 0, 'Deep gray, White', 'Polka dot', 'n/a', '', NULL, ''),
(66, 'accessories', 'C360_2015-04-20-17-37-28-949.jpg', 'n/a', 0, 'Blue', 'Plain', 'Naughty', '', NULL, ''),
(67, 'accessories', 'C360_2015-04-20-17-40-07-965.jpg', 'Bowsha', 0, 'Blue, White', 'Polka dot', 'Pasar Seni ITB 2014', '', NULL, ''),
(68, 'accessories', 'C360_2015-07-31-10-55-24-097.jpg', 'n/a', 1, 'Pink', 'Plain', 'Stroberi', '', NULL, ''),
(69, 'accessories', 'C360_2015-07-31-10-53-37-245.jpg', 'n/a', 1, 'Maroon red', 'Plain', 'Bunga', '', NULL, ''),
(70, 'accessories', 'C360_2015-06-14-10-45-37-811.jpg', 'n/a', 1, 'White', 'Crochet', 'Handmade', '', NULL, ''),
(71, 'Accessories', 'C360_2015-04-27-06-57-25-322.jpg', 'N/a', 1, 'Bronze, White', 'Plain', 'Pasar Seni Itb 2014', 'Formal, Casual', 0, ''),
(72, 'accessories', 'C360_2015-04-27-07-00-21-762.jpg', 'n/a', 1, 'Bronze, White, Pink, Blue', 'Plain', 'Pasar Seni ITB 2014', '', NULL, ''),
(73, 'accessories', 'C360_2015-06-14-10-46-16-536.jpg', 'n/a', 0, 'Gray', 'Plain', 'Stroberi', '', NULL, ''),
(74, 'accessories', 'C360_2015-06-14-11-05-12-837.jpg', 'n/a', 1, 'Red, Brown', 'Stripes', 'Stroberi', '', NULL, ''),
(75, 'accessories', 'C360_2015-08-14-07-54-19-181.jpg', 'n/a', 1, 'Deep blue', 'Plain', 'BIP', '', NULL, ''),
(76, 'accessories', 'C360_2015-08-14-07-55-29-946.jpg', 'n/a', 1, 'Maroon red', 'Plain', 'Bunga', '', NULL, ''),
(77, 'accessories', 'C360_2015-08-14-07-59-54-730.jpg', 'N/a', 1, 'Gold', 'Plain', 'Bunga Bip', 'Formal, Casual', 0, ''),
(78, 'accessories', 'C360_2015-08-14-07-56-22-595.jpg', 'N/a', 1, 'Gold', 'Plain', 'Bunga Bip', 'Formal, Casual', 0, ''),
(79, 'accessories', 'C360_2015-08-14-07-57-51-580.jpg', 'N/a', 1, 'Gold, Pink', 'Plain', 'Bunga Bip', 'Formal, Casual', 0, ''),
(80, 'accessories', 'C360_2015-08-14-08-06-31-989.jpg', 'n/a', 1, 'Light blue', 'Print', 'BIP', '', NULL, ''),
(81, 'accessories', 'C360_2015-08-14-08-08-07-198.jpg', 'n/a', 1, 'Beige', 'Plain', 'BIP', '', NULL, ''),
(82, 'accessories', 'C360_2015-08-14-08-09-49-625.jpg', 'n/a', 1, 'Brown', 'Plain', 'BIP', '', NULL, ''),
(83, 'accessories', 'C360_2015-08-14-08-11-03-440.jpg', 'n/a', 1, 'Pink, Light pink, light ora', 'Polka dot', 'BIP', '', NULL, ''),
(91, 'bags', 'C360_2015-06-22-10-07-43-517.jpg', 'n/a', 1, 'Green, Bronze', 'Plain', 'BIP', 'Formal', NULL, ''),
(92, 'bags', 'C360_2015-06-18-11-57-18-455.jpg', 'Calais Tea', 1, 'White, Black, Brown', 'Print', 'Calais Tea', 'Casual', NULL, ''),
(93, 'Bags', 'C360_2015-06-18-11-41-12-433.jpg', 'The Sac', 1, 'Brown', 'Plain', 'Cihampelas Walk', 'Formal, Casual', 0, ''),
(94, 'bags', 'C360_2015-06-18-11-37-11-963.jpg', 'Cat''s Club', 0, 'White', 'Plain', 'Gramedia Merdeka', 'Casual', NULL, ''),
(95, 'bags', 'C360_2015-06-18-11-32-49-577.jpg', 'n/a', 1, 'Pink, Deep red', 'Stripes', 'Gasibu', 'Formal', NULL, ''),
(96, 'bags', 'C360_2015-06-18-11-26-10-144.jpg', 'n/a', 0, 'Pink, White', 'Print', 'n/a', 'Casual', NULL, ''),
(97, 'bags', 'C360_2015-10-10-10-11-58-286.jpg', NULL, 1, 'Blue, Brown', 'Plain', 'Given', 'Casual', NULL, 'My first jeans backpack. Cute!'),
(98, 'bags', 'DSC04036.JPG', 'Elizabeth', 1, 'Beige, Brown', 'Plain', 'Elizabeth Ciwalk', 'Casual, Formal', 340000, 'My first stylish handbag'),
(101, 'bottoms', 'C360_2015-04-18-15-51-03-110.jpg', 'Bandidas', 1, 'Deep blue', 'Jeans', 'Matahari', 'Casual', NULL, ''),
(102, 'bottoms', 'C360_2015-04-26-09-28-19-135.jpg', 'Free n Free', 1, 'Deep blue', 'Jeans', 'Matahari ', 'Casual', NULL, ''),
(103, 'bottoms', 'C360_2015-04-26-08-46-40-220.jpg', 'n/a', 0, '1', 'Jeans', 'n/a', 'Casual', NULL, ''),
(104, 'bottoms', 'C360_2015-05-31-14-00-47-373.jpg', 'D''naila', 0, 'Beige', 'Plain', 'n/a', 'Casual', NULL, ''),
(105, 'bottoms', 'C360_2015-04-18-15-03-26-642.jpg', 'n/a', 0, 'Brown', 'Batik', 'n/a', 'Casual', NULL, ''),
(106, 'bottoms', 'C360_2015-04-26-10-47-38-725.jpg', 'Dust', 0, 'Light gray', 'Plain', 'Matahari', 'Casual', NULL, ''),
(107, 'bottoms', 'C360_2015-04-18-16-16-16-750.jpg', 'N/a', 1, 'Deep Blue', 'Plain', 'Matahari', 'Formal, Casual', 0, ''),
(108, 'bottoms', 'C360_2015-04-26-10-41-24-777.jpg', 'Logo Jeans', 1, 'Deep blue', 'Plain', 'Matahari ', 'Casual', NULL, ''),
(109, 'bottoms', 'C360_2015-04-18-17-56-32-795.jpg', 'n/a', 1, 'Blue', 'Plain', 'Yogya Fashion', 'Casual', NULL, ''),
(110, 'bottoms', 'C360_2015-04-07-01-34-05-903.jpg', 'n/a', 1, 'Black', 'Stripes', 'Given', 'Casual', NULL, ''),
(121, 'dresses', 'C360_2015-08-23-07-50-31-514.jpg', 'Novel Mice', 0, 'Orange', 'Plain', 'Matahari', 'Formal', NULL, ''),
(122, 'dresses', 'C360_2015-08-30-08-36-18-633.jpg', 'Annissa Ladies', 0, 'Peach', 'Plain, Laced', 'Matahari ', 'Formal', NULL, ''),
(123, 'dresses', 'C360_2015-08-30-08-46-46-076.jpg', 'n/a', 0, 'White', 'Plain, Laced', 'Riau Junction', 'Formal', NULL, ''),
(131, 'scarfs', 'C360_2015-04-19-10-51-32-042.jpg', 'n/a', 0, 'Deep red, Beige, Brown', 'Floral', 'n/a', 'Casual', NULL, ''),
(132, 'scarfs', 'C360_2015-04-19-10-40-22-048.jpg', 'Q''back', 0, 'Orange, Pink, Yellow, Brown', 'Polka dot', 'Given', '', NULL, ''),
(133, 'scarfs', 'C360_2015-04-19-10-46-52-052.jpg', 'n/a', 1, 'Red, Black, Beige', 'Paisley, Flor', 'Pasar Salman', 'Casual', NULL, ''),
(134, 'scarfs', 'C360_2015-04-19-10-45-51-184.jpg', 'Zoya', 0, 'Orange, Cyan', 'Polka dot', 'Given', 'Casual', NULL, ''),
(135, 'scarfs', 'C360_2015-04-19-10-36-53-267.jpg', 'Zoya', 1, 'Pink, Brown, Yellow', 'Stripes, Flor', 'Festival Citylink', 'Casual', NULL, ''),
(136, 'scarfs', 'C360_2015-04-19-10-48-51-437.jpg', 'n/a', 0, 'Light pink', 'Plain, Fur', 'Pasar Gasibu', 'Casual', NULL, ''),
(137, 'scarfs', 'C360_2015-04-19-10-27-43-461.jpg', 'n/a', 0, 'Green, Beige', 'Ombre', 'Pasar Seni ITB 2014', 'Casual', NULL, ''),
(138, 'scarfs', 'C360_2015-04-19-10-43-55-465.jpg', 'Laiqa', 1, 'Purple, Yellow, Orange', 'Tartan check', 'Pasar Seni ITB 2014', 'Casual', NULL, ''),
(139, 'scarfs', 'C360_2015-04-19-10-42-13-749.jpg', 'Q''Back', 0, 'Gray, Pink, Black', 'Polka dot', 'Given', 'Casual', NULL, ''),
(140, 'scarfs', 'C360_2015-04-19-10-38-58-986.jpg', 'n/a', 0, 'Maroon red', 'Plain', 'Pasar Salman', 'Casual', NULL, ''),
(141, 'scarfs', 'C360_2015-04-19-10-35-02-995.jpg', 'Pashmina', 1, 'Deep brown', 'Animal print,', 'Riau Junction', 'Casual', NULL, ''),
(142, 'scarfs', 'C360_2015-10-11-14-44-16-883.jpg', NULL, 1, 'Deep Pink', 'Knit', 'Given', 'Casual', NULL, 'Souvenir from Japan!'),
(151, 'hats', 'C360_2015-07-31-10-46-51-176.jpg', 'n/a', 0, 'Blue, Green, White', 'Knit', 'Given', 'Casual', NULL, ''),
(152, 'hats', 'C360_2015-07-31-10-48-07-702.jpg', 'n/a', 0, 'White', 'Knit', 'Given', 'Casual', NULL, ''),
(161, 'jackets', 'C360_2015-03-22-21-56-52-727.jpg', 'Hassenda', 0, 'Deep gray, White', 'Floral', 'Matahari ', 'Formal', NULL, ''),
(162, 'jackets', 'C360_2015-04-26-08-43-27-260.jpg', 'n/a', 0, 'Black', 'Plain', 'Pasar Metro ', 'Casual', NULL, ''),
(163, 'jackets', 'C360_2015-04-26-08-17-40-343.jpg', 'Jennifer Adler', 1, 'Black', 'Plain', 'Pasar Metro ', 'Casual', NULL, ''),
(164, 'jackets', 'C360_2015-03-22-21-51-23-533.jpg', 'Etcetera', 0, 'Brown', 'Lace', 'Matahari ', 'Formal', NULL, ''),
(165, 'jackets', 'C360_2015-03-22-21-50-21-781.jpg', 'Etcetera', 0, 'Black', 'Lace', 'Matahari ', 'Formal', NULL, ''),
(166, 'jackets', 'C360_2015-04-07-01-26-02-312.jpg', 'Two Seventeen', 1, 'Pink', 'Plain', 'Yogya Fashion', 'Casual', NULL, ''),
(167, 'jackets', 'C360_2015-03-22-22-05-29-486.jpg', 'Hassenda', 0, 'Black', 'Plain', 'Matahari ', '', NULL, ''),
(168, 'jackets', 'C360_2015-04-18-15-55-31-656.jpg', 'n/a', 0, 'Black, Light blue', 'Plain, Polka ', 'Balubur Town Square', 'Casual', NULL, ''),
(169, 'jackets', 'C360_2015-03-22-22-04-26-818.jpg', 'STEI 2011', 0, 'Deep gray', 'Plain', 'STEI 2011', 'Casual', NULL, ''),
(170, 'jackets', 'C360_2015-03-22-21-48-03-895.jpg', 'ITB', 0, 'Light gray, Black', 'Plain', 'ITB', 'Casual', NULL, ''),
(171, 'jackets', 'C360_2015-03-22-22-02-14-929.jpg', 'n/a', 0, 'Blue', 'Plain', 'n/a', '', NULL, ''),
(172, 'jackets', 'C360_2015-04-26-08-21-43-941.jpg', 'HMIF', 1, 'Green, Orange, Black', 'Plain', 'HMIF', 'Casual', NULL, ''),
(174, 'jackets', 'C360_2015-08-30-08-00-37-290.jpg', 'Cardigan Femme', 0, 'Light brown', 'Check', 'Matahari', 'Casual', NULL, ''),
(175, 'jackets', 'C360_2015-09-29-09-17-57-881.jpg', 'Spirit', 1, 'Pink, Gray', 'Plain', 'Given', 'Casual', NULL, 'Like a cool girl''s jacket'),
(176, 'jackets', 'C360_2015-10-11-14-57-54-611.jpg', 'Zara Knit', 1, 'Red, White', 'Knit', 'Given', 'Casual, Formal', NULL, NULL),
(177, 'jackets', 'C360_2015-09-29-09-29-14-910.jpg', 'Cardinal Femme', 0, 'Beige', 'Plaid', 'Matahari', 'Formal, Casual', NULL, NULL),
(181, 'shoes', 'C360_2015-06-14-10-23-18-196.jpg', 'Connexion', 1, 'Brown', 'Laced', 'Matahari', 'Formal', NULL, ''),
(182, 'shoes', 'C360_2015-06-14-10-11-38-413.jpg', 'Crocs', 0, '{Casual}', 'Deep pink', 'Plain', 'n/a', NULL, ''),
(183, 'shoes', 'C360_2015-06-14-10-09-08-854.jpg', 'Connexion', 1, 'Red:Brick', 'Plain, Bow', 'Matahari', 'Casual', NULL, ''),
(184, 'shoes', 'C360_2015-06-14-10-10-14-192.jpg', 'St. Yves', 1, 'Black, Gray', 'Plain, Bow', 'Matahari', 'Casual', NULL, ''),
(191, 'socks', 'C360_2015-07-31-10-37-05-034.jpg', 'Sunafix', 1, 'Black', 'Plain', 'Matahari', 'Formal', NULL, ''),
(192, 'socks', 'C360_2015-06-14-10-23-18-196.jpg', 'n/a', 1, 'White, Pink:Light', 'Argyle', 'Pasar Salman', 'Casual', NULL, ''),
(193, 'socks', 'C360_2015-06-14-10-31-52-229.jpg', 'n/a', 1, 'Gray, Black', 'Totoro print', 'n/a', 'Casual', NULL, ''),
(194, 'socks', 'C360_2015-06-16-08-38-08-512.jpg', 'n/a', 1, 'White, Gray', 'Plain', 'Pasar Salman', 'Casual', NULL, ''),
(195, 'socks', 'C360_2015-06-14-10-26-26-714.jpg', 'Red Robin', 1, 'Red, White', 'Polka dot', 'n/a', 'Casual', NULL, ''),
(196, 'socks', 'C360_2015-06-16-08-40-33-751.jpg', 'n/a', 1, 'White, Gray:Deep, Red:Maroo', 'Argyle', 'Pasar Salman', 'Casual', NULL, ''),
(197, 'socks', 'C360_2015-06-16-08-44-04-764.jpg', 'n/a', 0, 'White', 'Polka dot', 'Pasar Salman', 'Casual', NULL, ''),
(198, 'socks', 'C360_2015-06-16-08-47-50-843.jpg', 'n/a', 0, 'White', 'Floral', 'Pasar Salman', 'Casual', NULL, ''),
(199, 'socks', 'C360_2015-06-14-10-29-19-872.jpg', 'n/a', 1, 'White, Green', 'Argyle', 'Pasar Salman', 'Casual', NULL, ''),
(200, 'socks', 'C360_2015-06-16-08-42-27-891.jpg', 'n/a', 0, 'White, Black', 'Polka dot', 'Pasar Salman', 'Casual', NULL, ''),
(301, 'underwears', 'C360_2015-04-18-16-47-33-326.jpg', 'Wacoal', 1, 'White', 'Plain, Laced', 'Matahari', 'Formal,Casual', NULL, ''),
(302, 'underwears', 'C360_2015-04-18-16-49-26-446.jpg', 'Wacoal', 0, 'Brown', 'Plain', 'Matahari', 'Formal,Casual', NULL, ''),
(303, 'underwears', 'C360_2015-04-18-17-57-27-743.jpg', 'Wacoal', 0, 'White', 'Plain', 'Matahari', 'Formal,Casual', NULL, ''),
(304, 'underwears', 'C360_2015-06-07-11-03-15-414.jpg', 'Sorella', 1, 'Salmon Pink', 'Plain', 'Matahari', 'Formal,Casual', NULL, ''),
(305, 'underwears', 'C360_2015-07-31-10-44-51-037.jpg', 'Venna', 1, 'Brown', 'Plain', 'Ladies Shop', 'Formal, Casual, Sport', NULL, ''),
(306, 'underwears', 'C360_2015-07-31-10-02-24-483.jpg', 'Venna', 0, 'Maroon Red', 'Plain', 'Ladies Shop', 'Formal, Casual, Sport', NULL, ''),
(307, 'underwears', 'C360_2015-07-31-10-15-43-474.jpg', 'Sorella', 1, 'White, Brown', 'Floral', 'Matahari', 'Nightwear', NULL, ''),
(308, 'underwears', 'C360_2015-07-31-10-24-51-006.jpg', 'St Yves', 1, 'Maroon Red', 'Laced', 'Matahari', 'Nightwear', NULL, ''),
(309, 'underwears', 'C360_2015-07-31-10-28-12-374.jpg', 'Amo''s Style', 1, 'Pink', 'Laced', 'Ladies Shop', 'Formal, Casual, Nightwear', NULL, ''),
(310, 'underwears', 'C360_2015-07-31-10-34-37-639.jpg', 'n/a', 0, 'Brown', 'Plain', 'Ladies Shop', 'Formal, Casual, Nightwear', NULL, ''),
(311, 'underwears', 'C360_2015-07-31-10-40-27-774.jpg', 'Sorella', 1, 'White, Black', 'Floral, Laced', 'Matahari', 'Nightwear', NULL, ''),
(312, 'underwears', 'C360_2015-08-23-07-31-40-467.jpg', 'Wacoal', 0, 'Black', 'Plain, Laced', 'Matahari', 'Formal, Casual, Nightwear', NULL, ''),
(313, 'underwears', 'C360_2015-07-31-10-12-09-528.jpg', 'Sorella', 1, 'Black', 'Plain', 'Matahari', 'Formal, Casual, Nightwear', NULL, ''),
(314, 'underwears', 'C360_2015-04-18-16-45-36-387.jpg', 'Riena', 0, 'Black, Deep gray', 'Stripes', 'Pasar Metro', 'Formal, Casual', NULL, ''),
(315, 'underwears', 'C360_2015-04-18-14-11-09-436.jpg', 'Riena', 0, 'Brown', 'Plain', 'Pasar Metro', 'Formal, Casual', NULL, ''),
(316, 'underwears', 'C360_2015-04-18-14-08-52-897.jpg', 'Riena', 1, 'Purple', 'Plain', 'Pasar Metro', 'Formal, Casual', NULL, ''),
(317, 'underwears', 'C360_2015-04-18-14-09-56-975.jpg', 'Riena', 0, 'Black', 'Plain', 'Pasar Metro', 'Formal, Casual', NULL, ''),
(318, 'underwears', 'C360_2015-08-23-07-30-26-596.jpg', 'Elena', 1, 'White', 'Plain, Laced', 'Ladies Shop', 'Formal, Casual, Nightwear', NULL, ''),
(319, 'underwears', 'C360_2015-08-23-07-38-09-003.jpg', 'n/a', 1, 'White, Blue', 'Plain', 'Given', 'Formal, Casual', NULL, ''),
(320, 'underwears', 'DSC03986.JPG', 'Nevada', 1, 'Green, White', 'Polka dot', 'Matahari', 'Nightwear', 35000, NULL),
(321, 'tops', 'C360_2015-09-29-09-24-48-832.jpg', 'Connexion', 1, 'Red, White', 'Stripes', 'Matahari', 'Casual', 70000, 'A Waldo shirt!'),
(322, 'tops', 'DSC03983.JPG', 'Connexion', 1, 'Red', 'Plain, Laced', 'Matahari', 'Formal, Casual', 100000, 'My best bold color blouse. Daring!'),
(323, 'tops', 'C360_2015-09-29-09-47-49-808.jpg', 'Mint', 1, 'Pink salmon', 'Plain', 'Matahari', 'Casual, Formal', NULL, 'A blouse with an interesting cut!'),
(324, 'tops', 'C360_2015-10-11-15-11-26-177.jpg', 'Arjuna Weda', 1, 'Brown', 'Batik', 'Matahari', 'Casual, Formal', 250000, 'My first stylish batik tops!'),
(330, 'bottoms', 'C360_2015-10-11-15-20-08-177.jpg', NULL, 1, 'Black', 'Plain', 'Pasar Salman', 'Formal', 7500, 'My first span skirt\r\n'),
(777, 'tops', NULL, '', NULL, '', '', '', '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `creates`
--

CREATE TABLE IF NOT EXISTS `creates` (
  `id_clothes` int(255) NOT NULL,
  `id_outfit` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dresses`
--

CREATE TABLE IF NOT EXISTS `dresses` (
  `id` int(255) NOT NULL,
  `size` varchar(3) DEFAULT NULL,
  `sleeve` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dresses`
--

INSERT INTO `dresses` (`id`, `size`, `sleeve`) VALUES
(121, 'L', 'Mid'),
(122, 'n/a', 'Long'),
(123, 'n/a', 'Sleeveless');

-- --------------------------------------------------------

--
-- Table structure for table `hats`
--

CREATE TABLE IF NOT EXISTS `hats` (
  `id` int(255) NOT NULL DEFAULT '0',
  `type` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hats`
--

INSERT INTO `hats` (`id`, `type`) VALUES
(151, 'Benie'),
(152, 'Benie');

-- --------------------------------------------------------

--
-- Table structure for table `jackets`
--

CREATE TABLE IF NOT EXISTS `jackets` (
  `id` int(255) NOT NULL,
  `type` varchar(8) DEFAULT NULL,
  `size` varchar(1) DEFAULT NULL,
  `material` varchar(25) DEFAULT NULL,
  `sleeve` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jackets`
--

INSERT INTO `jackets` (`id`, `type`, `size`, `material`, `sleeve`) VALUES
(161, 'Blazer', 'L', '', 'Mid'),
(162, 'Cardigan', '', '', 'Long'),
(163, 'Cardigan', '', '', 'Long'),
(164, 'Cardigan', '', '', 'Mid'),
(165, 'Cardigan', '', '', 'Mid'),
(166, 'Jacket', '', '', 'Long'),
(167, 'Jacket', 'L', '', ''),
(168, 'Jacket', '', '', 'Long'),
(169, 'Jacket', '', '', ''),
(170, 'Jacket', '', 'Parachute', ''),
(171, 'Jacket', '', 'Jeans', ''),
(172, 'Jacket', '', '', 'Long'),
(174, 'Blazer', '', '', ''),
(175, 'Jacket', NULL, 'Parachute', 'Mid'),
(176, 'Sweater', NULL, NULL, 'Mid'),
(177, 'Blazer', NULL, NULL, 'Long');

-- --------------------------------------------------------

--
-- Table structure for table `layers`
--

CREATE TABLE IF NOT EXISTS `layers` (
  `id_clothes1` int(100) NOT NULL,
  `id_clothes2` int(100) NOT NULL,
  `score` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layers`
--

INSERT INTO `layers` (`id_clothes1`, `id_clothes2`, `score`) VALUES
(77, 78, NULL),
(77, 79, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `id_clothes1` int(100) NOT NULL,
  `id_clothes2` int(100) NOT NULL,
  `score` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id_clothes1`, `id_clothes2`, `score`) VALUES
(23, 71, NULL),
(23, 107, NULL),
(23, 137, NULL),
(23, 93, NULL),
(23, 72, NULL),
(23, 183, NULL),
(23, 102, NULL),
(23, 81, NULL),
(30, 79, NULL),
(30, 78, NULL),
(30, 175, NULL),
(30, 77, NULL),
(30, 92, NULL),
(321, 98, NULL),
(321, 61, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `outfits`
--

CREATE TABLE IF NOT EXISTS `outfits` (
  `id` int(255) NOT NULL,
  `total_score` int(255) NOT NULL,
  `user_rating` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pattern`
--

CREATE TABLE IF NOT EXISTS `pattern` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pattern`
--

INSERT INTO `pattern` (`id`, `name`, `photo`) VALUES
(1, 'plain', '0'),
(2, 'polka dot', '0'),
(3, 'floral', '0'),
(4, 'argyle', '0'),
(5, 'chevron', '0'),
(6, 'stripes', '0'),
(7, 'tartan check', '0'),
(8, 'checkboard', '0'),
(9, 'print', '0');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE IF NOT EXISTS `quotes` (
  `id` int(1) NOT NULL DEFAULT '0',
  `quote` varchar(152) DEFAULT NULL,
  `author` varchar(73) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `quote`, `author`, `position`) VALUES
(1, 'The matchy-matchy look is too contrived for 2013. Nowadays being fashionable is all about being individual, quirky and eccentric - the Alexa Chung look.', 'Andrew Groves', 'Head of the University of Westminster''s Fashion Department');

-- --------------------------------------------------------

--
-- Table structure for table `scarfs`
--

CREATE TABLE IF NOT EXISTS `scarfs` (
  `id` int(255) NOT NULL,
  `type` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scarfs`
--

INSERT INTO `scarfs` (`id`, `type`) VALUES
(131, 'Square scarf'),
(132, 'Square scarf'),
(133, 'Pashmina'),
(134, 'Pashmina'),
(135, 'Pashmina'),
(136, 'Pashmina'),
(137, 'Pashmina'),
(138, 'Pashmina'),
(139, 'Square scarf'),
(140, 'Pashmina'),
(141, 'Pashmina'),
(142, 'Muffler');

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE IF NOT EXISTS `shoes` (
  `id` int(255) NOT NULL,
  `type` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shoes`
--

INSERT INTO `shoes` (`id`, `type`) VALUES
(181, 'Wedges'),
(182, 'Flats'),
(183, 'Wedges'),
(184, 'Flats');

-- --------------------------------------------------------

--
-- Table structure for table `socks`
--

CREATE TABLE IF NOT EXISTS `socks` (
  `id` int(255) NOT NULL,
  `type` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socks`
--

INSERT INTO `socks` (`id`, `type`) VALUES
(191, 'Stocking'),
(192, 'Short socks'),
(193, 'Short socks'),
(194, 'Anklet'),
(195, 'Short socks'),
(196, 'Anklet'),
(197, 'Anklet'),
(198, 'Anklet'),
(199, 'Short socks'),
(200, 'Anklet');

-- --------------------------------------------------------

--
-- Table structure for table `tops`
--

CREATE TABLE IF NOT EXISTS `tops` (
  `id` int(255) NOT NULL,
  `type` varchar(14) DEFAULT NULL,
  `sleeve` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tops`
--

INSERT INTO `tops` (`id`, `type`, `sleeve`) VALUES
(1, 'Blouse', 'Capped'),
(2, 'Blouse', 'Mid'),
(3, 'Blouse', 'Long'),
(4, 'Blouse', 'Long'),
(5, 'Blouse', 'Long'),
(6, 'Blouse', 'Long'),
(7, 'Blouse', 'Mid'),
(8, 'Blouse', 'Mid'),
(9, 'Blouse', 'Mid'),
(10, 'Blouse', 'Long'),
(11, 'Cardigan shirt', 'Mid'),
(12, 'Dress', 'Long'),
(13, 'Overall', 'Mid'),
(14, 'Polo Shirt', 'Short'),
(15, 'Polo shirt', 'Short'),
(16, 'Polo shirt', 'Short'),
(17, 'Polo shirt', ''),
(18, 'Polo shirt', 'Puffed'),
(19, 'Polo shirt', 'Short'),
(20, 'Shirt', 'Capped'),
(21, 'Shirt', 'Long'),
(22, 'Shirt', 'Capped'),
(23, 'Shirt', 'Mid'),
(24, 'Shirt', 'Mid'),
(25, 'Shirt', 'Long'),
(26, 'Shirt', 'Short'),
(28, 'Shirt', 'Short'),
(29, 'Shirt', 'Capped'),
(30, 'Shirt', 'Mid'),
(31, 'Shirt', 'Long'),
(32, 'Shirt', 'Short'),
(33, 'Shirt', 'Mid'),
(34, 'Shirt', 'Mid'),
(35, 'Shirt', 'Long'),
(36, 'Shirt dress', 'Short'),
(37, 'Shirt dress', 'Mid'),
(38, 'Shirt dress', 'Short'),
(39, 'Shirt dress', 'Long'),
(40, 'Shirt dress', 'Short'),
(42, 'Sweater', 'Long'),
(43, 'Sweater', 'Long'),
(44, 'Sweater', 'Long'),
(45, 'Blouse', 'Mid'),
(46, 'T-shirt', 'Short'),
(47, 'T-shirt', 'Short'),
(49, 'Shirt', 'Mid'),
(50, 'Shirt', 'Mid'),
(321, 'Shirt', 'Mid'),
(322, 'blouse', 'capped'),
(323, 'blouse', 'Mid'),
(324, 'peplum', 'short');

-- --------------------------------------------------------

--
-- Table structure for table `underwears`
--

CREATE TABLE IF NOT EXISTS `underwears` (
  `id` int(255) NOT NULL,
  `type` varchar(8) DEFAULT NULL,
  `size` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `underwears`
--

INSERT INTO `underwears` (`id`, `type`, `size`) VALUES
(301, 'Bra', '80B'),
(302, 'Bra', '75B'),
(303, 'Bra', '75B'),
(304, 'Bra', '80B'),
(305, 'Bra', '36'),
(306, 'Bra', '36'),
(307, 'Lingerie', 'L'),
(308, 'Lingerie', 'M'),
(309, 'Panty', 'M'),
(310, 'Boyshort', 'All size'),
(311, 'Lingerie', 'L'),
(312, 'Bra', '80B'),
(313, 'Bra', '80B'),
(314, 'Tank top', 'XL'),
(315, 'Tank top', ''),
(316, 'Tank top', ''),
(317, 'Tank top', 'L'),
(318, 'Tank top', 'All size'),
(319, 'Tank top', 'All size'),
(320, 'Boxer', 'L');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `bags`
--
ALTER TABLE `bags`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `bottoms`
--
ALTER TABLE `bottoms`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `clothes`
--
ALTER TABLE `clothes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creates`
--
ALTER TABLE `creates`
  ADD KEY `creates_clothes_ibfk_1` (`id_clothes`),
  ADD KEY `creates_outfit_ibfk_1` (`id_outfit`);

--
-- Indexes for table `dresses`
--
ALTER TABLE `dresses`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `hats`
--
ALTER TABLE `hats`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `jackets`
--
ALTER TABLE `jackets`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `layers`
--
ALTER TABLE `layers`
  ADD KEY `id_clothes1` (`id_clothes1`),
  ADD KEY `id_clothes2` (`id_clothes2`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD KEY `id_clothes1` (`id_clothes1`),
  ADD KEY `id_clothes2` (`id_clothes2`);

--
-- Indexes for table `outfits`
--
ALTER TABLE `outfits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pattern`
--
ALTER TABLE `pattern`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scarfs`
--
ALTER TABLE `scarfs`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `socks`
--
ALTER TABLE `socks`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tops`
--
ALTER TABLE `tops`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `underwears`
--
ALTER TABLE `underwears`
  ADD UNIQUE KEY `id` (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessories`
--
ALTER TABLE `accessories`
  ADD CONSTRAINT `accessories_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bags`
--
ALTER TABLE `bags`
  ADD CONSTRAINT `bags_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bottoms`
--
ALTER TABLE `bottoms`
  ADD CONSTRAINT `bottoms_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `creates`
--
ALTER TABLE `creates`
  ADD CONSTRAINT `creates_clothes_ibfk_1` FOREIGN KEY (`id_clothes`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `creates_outfit_ibfk_1` FOREIGN KEY (`id_outfit`) REFERENCES `outfits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dresses`
--
ALTER TABLE `dresses`
  ADD CONSTRAINT `dresses_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hats`
--
ALTER TABLE `hats`
  ADD CONSTRAINT `hats_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jackets`
--
ALTER TABLE `jackets`
  ADD CONSTRAINT `jackets_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `layers`
--
ALTER TABLE `layers`
  ADD CONSTRAINT `layers_ibfk_1` FOREIGN KEY (`id_clothes1`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `layers_ibfk_2` FOREIGN KEY (`id_clothes2`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`id_clothes1`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`id_clothes2`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scarfs`
--
ALTER TABLE `scarfs`
  ADD CONSTRAINT `scarfs_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shoes`
--
ALTER TABLE `shoes`
  ADD CONSTRAINT `shoes_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `socks`
--
ALTER TABLE `socks`
  ADD CONSTRAINT `socks_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tops`
--
ALTER TABLE `tops`
  ADD CONSTRAINT `tops_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `underwears`
--
ALTER TABLE `underwears`
  ADD CONSTRAINT `underwears_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
