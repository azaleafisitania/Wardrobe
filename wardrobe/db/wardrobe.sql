-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2015 at 01:07 PM
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
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bags`
--

INSERT INTO `bags` (`id`, `type`) VALUES
(91, 'Clutch'),
(92, 'Canvas bag'),
(93, 'Backpack'),
(94, 'Canvas bag'),
(95, 'Bag'),
(96, 'Bag');

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
(10, 'Skirt', '', 'Knee');

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
  `bought_at` varchar(25) DEFAULT NULL,
  `occasion` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clothes`
--

INSERT INTO `clothes` (`id`, `category`, `photo`, `brand`, `fav`, `color`, `pattern`, `bought_at`, `occasion`) VALUES
(1, 'tops', 'C360_2015-08-03-09-43-53-031.jpg', 'Dust', 1, 'Deep blue', 'Floral', 'Matahari Department Store', 'Casual'),
(2, 'tops', 'C360_2015-08-03-09-14-57-160.jpg', 'Triset', 0, 'Beige', 'Floral', 'Matahari Department Store', ''),
(3, 'tops', 'C360_2015-06-07-11-01-06-200.jpg', 'St. Yves', 1, 'Pink', 'Lace', 'Matahari Department Store', 'Formal'),
(4, 'tops', 'C360_2015-06-07-11-09-34-429.jpg', 'St. Yves', 1, 'Black, White', 'Plain', 'Matahari Department Store', 'Formal'),
(5, 'tops', 'C360_2015-04-07-01-39-30-831.jpg', '', 0, 'Deep Brown', 'Floral', 'Pasar Salman', ''),
(6, 'tops', 'C360_2015-06-07-09-49-18-833.jpg', '', 1, 'Deep Pink', 'Plain', 'Given', ''),
(7, 'tops', 'C360_2015-04-07-01-27-19-866.jpg', 'Corniche', 0, 'Green, Pink', 'Floral', 'Matahari Department Store', ''),
(8, 'tops', 'C360_2015-05-31-14-29-11-896.jpg', '', 1, 'Deep Brown', 'Plain, Floral', 'Given', ''),
(9, 'tops', 'C360_2015-07-19-08-41-03-441.jpg', 'Triset', 1, 'Red, Deep brown, Beige', 'Chevron', 'Matahari Department Store', ''),
(10, 'tops', 'C360_2015-07-18-08-14-01-683.jpg', 'Triset', 1, 'Deep brown', 'Plain', 'Matahari Department Store', ''),
(11, 'tops', 'C360_2015-03-22-16-36-38-422.jpg', 'Novel Mice', 1, 'White, Black', 'Plain', 'Matahari Department Store', ''),
(12, 'tops', 'C360_2015-06-07-09-19-43-922.jpg', 'Annissa', 0, 'Blue, Green, Orange', 'Batik', 'Matahari Department Store', ''),
(13, 'tops', 'C360_2015-07-11-15-34-14-042.jpg', 'Puricia', 0, 'Pink, Red', 'Floral', 'Matahari Department Store', ''),
(14, 'tops', 'C360_2015-06-07-10-55-48-041.jpg', '', 0, 'White, Cyan', 'Plain', 'Veritrans Indonesia', ''),
(15, 'tops', 'C360_2015-08-03-09-51-16-149.jpg', 'Country Fiesta', 0, 'White', 'Plain', 'Bandung Indah Plaza', ''),
(16, 'tops', 'C360_2015-08-03-09-53-56-157.jpg', 'Country Fiesta', 0, 'Black', 'Plain', 'Bandung Indah Plaza', ''),
(17, 'tops', 'C360_2015-03-22-21-55-26-775.jpg', '', 0, 'Black, Yellow', 'Plain', 'HMIF Merchandise', ''),
(18, 'tops', 'C360_2015-04-18-15-04-22-918.jpg', 'Lea', 1, 'Black', 'Plain', 'Matahari Department Store', ''),
(19, 'tops', 'C360_2015-04-18-17-53-40-922.jpg', 'Two Seventeen', 0, 'Blue, Brown', 'Polka dot', '', ''),
(20, 'tops', 'C360_2015-08-03-09-27-28-036.jpg', 'Flashy', 1, 'White, Orange', 'Print', 'HelloFest', ''),
(21, 'tops', 'C360_2015-04-18-15-01-50-043.jpg', 'Novel Mice', 1, 'Green', 'Plain, Floral', 'Matahari Department Store', ''),
(22, 'tops', 'C360_2015-08-03-09-20-18-062.jpg', '', 1, 'White', 'Plain', '', ''),
(23, 'tops', 'C360_2015-04-26-11-06-04-070.jpg', 'Hassenda', 1, 'Beige, Red', 'Tartan check', 'Matahari Department Store', ''),
(24, 'tops', 'C360_2015-04-07-01-30-36-092.jpg', 'Carina Swarovski', 0, 'Light blue, Light pink', 'Plain, Floral', 'Given', ''),
(25, 'tops', 'C360_2015-05-31-14-21-32-227.jpg', 'Novel Mice', 0, 'Pink, Blue', 'Floral', 'Matahari Department Store', ''),
(26, 'tops', 'C360_2015-04-26-12-15-09-237.jpg', 'Triset', 1, 'Beige', 'Tartan check', 'Matahari Department Store', ''),
(28, 'tops', 'C360_2015-04-07-01-29-32-415.jpg', 'St. Yves', 1, 'Orange, Red, White', 'Tartan check', 'Matahari Department Store', ''),
(29, 'tops', 'C360_2015-08-03-09-25-15-506.jpg', 'Triset', 1, 'Gray', 'Print', 'Matahari Department Store', ''),
(30, 'tops', 'C360_2015-08-02-15-57-33-642.jpg', 'Novel Mice', 1, 'Deep Brown', 'Plain', 'Matahari Department Store', ''),
(31, 'tops', 'C360_2015-06-07-12-20-00-779.jpg', '', 0, 'White, Blue navy', 'Plain', '', ''),
(32, 'tops', 'C360_2015-04-07-01-28-33-813.jpg', 'Rodeo', 1, 'Red, White', 'Tartan check', 'Matahari Department Store', ''),
(33, 'tops', 'C360_2015-04-18-16-52-38-874.jpg', '', 1, 'White, Purple', 'Floral', 'Given', ''),
(34, 'tops', 'C360_2015-06-07-12-08-04-986.jpg', 'Boy''s Room', 1, 'White', 'Plain', 'Pasar Salman', ''),
(35, 'tops', 'C360_2015-08-03-09-30-11-990.jpg', 'Dust', 1, 'Brown, White', 'Floral', 'Matahari Department Store', ''),
(36, 'tops', 'C360_2015-04-26-12-13-22-006.jpg', 'Graphis', 0, 'Beige', 'Plain', 'Matahari Department Store', ''),
(37, 'tops', 'C360_2015-03-22-16-15-57-495.jpg', 'Novel Mice', 1, 'Black', 'Plain, Floral', 'Matahari Department Store', ''),
(38, 'tops', 'C360_2015-08-03-09-31-37-518.jpg', 'Triset', 0, 'Brown', 'Stripes', 'Matahari Department Store', ''),
(39, 'tops', 'C360_2015-05-14-14-46-20-987.jpg', 'Triset', 1, 'Green, Orange', 'Tartan', 'Matahari Department Store', ''),
(40, 'tops', 'C360_2015-07-29-09-47-37-803.jpg', 'Corniche', 0, 'Pink', 'Plain', 'Matahari Department Store', ''),
(42, 'tops', 'C360_2015-04-18-16-51-11-002.jpg', 'Triset Ladies', 1, 'Deep red, Deep brown, White', 'Ornament', 'Matahari Department Store', ''),
(43, 'tops', 'C360_2015-05-31-14-06-23-028.jpg', 'Nevada', 1, 'Pink, Black', 'Plain', 'Matahari Department Store', ''),
(44, 'tops', 'C360_2015-04-26-12-10-16-738.jpg', 'Corniche', 1, 'Deep Pink', 'Floral', 'Matahari Department Store', ''),
(45, 'tops', 'C360_2015-08-22-08-18-47-035.jpg', '', 1, 'White', 'Crochet', 'Pasar Salman', ''),
(46, 'tops', 'C360_2015-08-02-15-43-12-012.jpg', 'Include', 1, 'White, Green', 'Stripes', 'Matahari Department Store', ''),
(47, 'tops', 'C360_2015-06-07-11-53-44-452.jpg', 'Calais Tea', 1, 'Black, Pink', 'Plain', 'Riau Junction', ''),
(48, 'tops', 'C360_2015-08-23-07-34-31-708.jpg', '', 1, 'Peach', 'Floral', 'Pasar Salman', 'Casual'),
(49, 'tops', 'C360_2015-08-30-08-16-04-765.jpg', 'Eclaire', 0, 'White', 'Plain', 'Pasar Salman', 'Formal'),
(51, 'accessories', 'C360_2015-04-21-09-07-41-062.jpg', 'n/a', 1, 'Deep green', 'Plain', 'Stroberi', ''),
(52, 'accessories', 'C360_2015-04-21-10-13-54-190.jpg', 'n/a', 0, 'Maroon red', 'Plain', 'Stroberi', 'Formal'),
(53, 'accessories', 'C360_2015-04-20-16-51-49-201.jpg', 'n/a', 1, 'White, Light blue', 'Diamond', 'Stroberi', 'Casual'),
(54, 'accessories', 'C360_2015-04-21-09-18-19-345.jpg', 'n/a', 0, 'Bronze, White', '', 'Pasar Seni ITB 2014', 'Formal'),
(55, 'accessories', 'C360_2015-04-20-17-31-52-465.jpg', 'n/a', 0, 'White, Light blue, Light pi', 'Abstract', 'Pasar Salman', 'Casual'),
(56, 'accessories', 'C360_2015-04-20-16-53-48-486.jpg', 'n/a', 1, 'Pink', 'Plain', 'n/a', ''),
(57, 'accessories', 'C360_2015-04-21-09-06-40-573.jpg', 'n/a', 0, 'Black', 'Plain', 'Matahari', ''),
(58, 'accessories', 'C360_2015-04-20-16-56-13-600.jpg', 'n/a', 1, 'Pink, White', 'Polka dot', 'n/a', ''),
(59, 'accessories', 'C360_2015-04-20-16-57-12-625.jpg', 'n/a', 0, 'Black, Gold', 'Plain', 'n/a', ''),
(60, 'accessories', 'C360_2015-04-21-09-16-41-631.jpg', 'n/a', 0, 'Pink, Silver', 'Plain', 'n/a', ''),
(61, 'accessories', 'C360_2015-04-21-09-20-43-655.jpg', 'n/a', 0, 'Red, Bronze', 'Print', 'Stroberi', ''),
(62, 'accessories', 'C360_2015-05-04-07-25-39-692.jpg', 'n/a', 1, 'Grey', 'Stripes', 'n/a', ''),
(63, 'accessories', 'C360_2015-04-20-17-34-22-695.jpg', 'n/a', 0, 'Orange', 'Plain', 'BIP', ''),
(64, 'accessories', 'C360_2015-04-21-09-05-47-842.jpg', 'n/a', 0, 'Pink, Beige', 'Plain', 'BIP', ''),
(65, 'accessories', 'C360_2015-04-20-17-05-56-932.jpg', 'n/a', 0, 'Deep gray, White', 'Polka dot', 'n/a', ''),
(66, 'accessories', 'C360_2015-04-20-17-37-28-949.jpg', 'n/a', 0, 'Blue', 'Plain', 'Naughty', ''),
(67, 'accessories', 'C360_2015-04-20-17-40-07-965.jpg', 'Bowsha', 0, 'Blue, White', 'Polka dot', 'Pasar Seni ITB 2014', ''),
(68, 'accessories', 'C360_2015-07-31-10-55-24-097.jpg', 'n/a', 1, 'Pink', 'Plain', 'Stroberi', ''),
(69, 'accessories', 'C360_2015-07-31-10-53-37-245.jpg', 'n/a', 1, 'Maroon red', 'Plain', 'Bunga', ''),
(70, 'accessories', 'C360_2015-06-14-10-45-37-811.jpg', 'n/a', 1, 'White', 'Crochet', 'Handmade', ''),
(71, 'accessories', 'C360_2015-04-27-06-57-25-322.jpg', 'n/a', 1, 'Bronze, White', 'Plain', 'Pasar Seni ITB 2014', ''),
(72, 'accessories', 'C360_2015-04-27-07-00-21-762.jpg', 'n/a', 1, 'Bronze, White, Pink, Blue', 'Plain', 'Pasar Seni ITB 2014', ''),
(73, 'accessories', 'C360_2015-06-14-10-46-16-536.jpg', 'n/a', 0, 'Gray', 'Plain', 'Stroberi', ''),
(74, 'accessories', 'C360_2015-06-14-11-05-12-837.jpg', 'n/a', 1, 'Red, Brown', 'Stripes', 'Stroberi', ''),
(75, 'accessories', 'C360_2015-08-14-07-54-19-181.jpg', 'n/a', 1, 'Deep blue', 'Plain', 'BIP', ''),
(76, 'accessories', 'C360_2015-08-14-07-55-29-946.jpg', 'n/a', 1, 'Maroon red', 'Plain', 'Bunga', ''),
(77, 'accessories', 'C360_2015-08-14-07-59-54-730.jpg', 'n/a', 1, 'Gold', 'Plain', 'BIP', ''),
(78, 'accessories', 'C360_2015-08-14-07-56-22-595.jpg', 'n/a', 1, 'Gold', 'Plain', 'BIP', ''),
(79, 'accessories', 'C360_2015-08-14-07-57-51-580.jpg', 'n/a', 1, 'Gold, Pink', 'Plain', 'BIP', ''),
(80, 'accessories', 'C360_2015-08-14-08-06-31-989.jpg', 'n/a', 1, 'Light blue', 'Print', 'BIP', ''),
(81, 'accessories', 'C360_2015-08-14-08-08-07-198.jpg', 'n/a', 1, 'Beige', 'Plain', 'BIP', ''),
(82, 'accessories', 'C360_2015-08-14-08-09-49-625.jpg', 'n/a', 1, 'Brown', 'Plain', 'BIP', ''),
(83, 'accessories', 'C360_2015-08-14-08-11-03-440.jpg', 'n/a', 1, 'Pink, Light pink, light ora', 'Polka dot', 'BIP', ''),
(91, 'bags', 'C360_2015-06-22-10-07-43-517.jpg', 'n/a', 1, 'Green, Bronze', 'Plain', 'BIP', 'Formal'),
(92, 'bags', 'C360_2015-06-18-11-57-18-455.jpg', 'Calais Tea', 1, 'White, Black, Brown', 'Print', 'Calais Tea', 'Casual'),
(93, 'bags', 'C360_2015-06-18-11-41-12-433.jpg', 'The Sac', 1, 'Brown', 'Plain', 'Cihampelas Walk', 'Formal'),
(94, 'bags', 'C360_2015-06-18-11-37-11-963.jpg', 'Cat''s Club', 0, 'White', 'Plain', 'Gramedia Merdeka', 'Casual'),
(95, 'bags', 'C360_2015-06-18-11-32-49-577.jpg', 'n/a', 1, 'Pink, Deep red', 'Stripes', 'Gasibu', 'Formal'),
(96, 'bags', 'C360_2015-06-18-11-26-10-144.jpg', 'n/a', 0, 'Pink, White', 'Print', 'n/a', 'Casual'),
(101, 'bottoms', 'C360_2015-04-18-15-51-03-110.jpg', 'Bandidas', 1, 'Deep blue', 'Jeans', 'Matahari', 'Casual'),
(102, 'bottoms', 'C360_2015-04-26-09-28-19-135.jpg', 'Free n Free', 1, 'Deep blue', 'Jeans', 'Matahari ', 'Casual'),
(103, 'bottoms', 'C360_2015-04-26-08-46-40-220.jpg', 'n/a', 0, '1', 'Jeans', 'n/a', 'Casual'),
(104, 'bottoms', 'C360_2015-05-31-14-00-47-373.jpg', 'D''naila', 0, 'Beige', 'Plain', 'n/a', 'Casual'),
(105, 'bottoms', 'C360_2015-04-18-15-03-26-642.jpg', 'n/a', 0, 'Brown', 'Batik', 'n/a', 'Casual'),
(106, 'bottoms', 'C360_2015-04-26-10-47-38-725.jpg', 'Dust', 0, 'Light gray', 'Plain', 'Matahari', 'Casual'),
(107, 'bottoms', 'C360_2015-04-18-16-16-16-750.jpg', 'n/a', 1, 'Deep blue', 'Plain', 'Matahari', 'Casual'),
(108, 'bottoms', 'C360_2015-04-26-10-41-24-777.jpg', 'Logo Jeans', 1, 'Deep blue', 'Plain', 'Matahari ', 'Casual'),
(109, 'bottoms', 'C360_2015-04-18-17-56-32-795.jpg', 'n/a', 1, 'Blue', 'Plain', 'Yogya Fashion', 'Casual'),
(110, 'bottoms', 'C360_2015-04-07-01-34-05-903.jpg', 'n/a', 1, 'Black', 'Stripes', 'Given', 'Casual'),
(121, 'dresses', 'C360_2015-08-23-07-50-31-514.jpg', 'Novel Mice', 0, 'Orange', 'Plain', 'Matahari', 'Formal'),
(122, 'dresses', 'C360_2015-08-30-08-36-18-633.jpg', 'Annissa Ladies', 0, 'Peach', 'Plain, Laced', 'Matahari ', 'Formal'),
(123, 'dresses', 'C360_2015-08-30-08-46-46-076.jpg', 'n/a', 0, 'White', 'Plain, Laced', 'Riau Junction', 'Formal'),
(131, 'scarfs', 'C360_2015-04-19-10-51-32-042.jpg', 'n/a', 0, 'Deep red, Beige, Brown', 'Floral', 'n/a', '{Casua'),
(132, 'scarfs', 'C360_2015-04-19-10-40-22-048.jpg', 'Q''back', 0, 'Orange, Pink, Yellow, Brown', 'Polka dot', 'Given', ''),
(133, 'scarfs', 'C360_2015-04-19-10-46-52-052.jpg', 'n/a', 1, 'Red, Black, Beige', 'Paisley, Flor', 'Pasar Salman', '{Casua'),
(134, 'scarfs', 'C360_2015-04-19-10-45-51-184.jpg', 'Zoya', 0, 'Orange, Cyan', 'Polka dot', 'Given', '{Casua'),
(135, 'scarfs', 'C360_2015-04-19-10-36-53-267.jpg', 'Zoya', 1, 'Pink, Brown, Yellow', 'Stripes, Flor', 'Festival Citylink', '{Casua'),
(136, 'scarfs', 'C360_2015-04-19-10-48-51-437.jpg', 'n/a', 0, 'Light pink', 'Plain, Fur', 'Pasar Gasibu', '{Casua'),
(137, 'scarfs', 'C360_2015-04-19-10-27-43-461.jpg', 'n/a', 0, 'Green, Beige', 'Ombre', 'Pasar Seni ITB 2014', '{Casua'),
(138, 'scarfs', 'C360_2015-04-19-10-43-55-465.jpg', 'Laiqa', 1, 'Purple, Yellow, Orange', 'Tartan check', 'Pasar Seni ITB 2014', '{Casua'),
(139, 'scarfs', 'C360_2015-04-19-10-42-13-749.jpg', 'Q''Back', 0, 'Gray, Pink, Black', 'Polka dot', 'Given', '{Casua'),
(140, 'scarfs', 'C360_2015-04-19-10-38-58-986.jpg', 'n/a', 0, 'Maroon red', 'Plain', 'Pasar Salman', '{Casua'),
(141, 'scarfs', 'C360_2015-04-19-10-35-02-995.jpg', 'Pashmina', 1, 'Deep brown', 'Animal print,', 'Riau Junction', '{Casua'),
(151, 'hats', 'C360_2015-07-31-10-46-51-176.jpg', 'n/a', 0, 'Blue, Green, White', 'Knit', 'Given', 'Casual'),
(152, 'hats', 'C360_2015-07-31-10-48-07-702.jpg', 'n/a', 0, 'White', 'Knit', 'Given', 'Casual'),
(161, 'jackets', 'C360_2015-03-22-21-56-52-727.jpg', 'Hassenda', 0, 'Deep gray, White', 'Floral', 'Matahari ', 'Formal'),
(162, 'jackets', 'C360_2015-04-26-08-43-27-260.jpg', 'n/a', 0, 'Black', 'Plain', 'Pasar Metro ', 'Casual'),
(163, 'jackets', 'C360_2015-04-26-08-17-40-343.jpg', 'Jennifer Adler', 1, 'Black', 'Plain', 'Pasar Metro ', 'Casual'),
(164, 'jackets', 'C360_2015-03-22-21-51-23-533.jpg', 'Etcetera', 0, 'Brown', 'Lace', 'Matahari ', 'Formal'),
(165, 'jackets', 'C360_2015-03-22-21-50-21-781.jpg', 'Etcetera', 0, 'Black', 'Lace', 'Matahari ', 'Formal'),
(166, 'jackets', 'C360_2015-04-07-01-26-02-312.jpg', 'Two Seventeen', 1, 'Pink', 'Plain', 'Yogya Fashion', 'Casual'),
(167, 'jackets', 'C360_2015-03-22-22-05-29-486.jpg', 'Hassenda', 0, 'Black', 'Plain', 'Matahari ', ''),
(168, 'jackets', 'C360_2015-04-18-15-55-31-656.jpg', 'n/a', 0, 'Black, Light blue', 'Plain, Polka ', 'Balubur Town Square', 'Casual'),
(169, 'jackets', 'C360_2015-03-22-22-04-26-818.jpg', 'STEI 2011', 0, 'Deep gray', 'Plain', 'STEI 2011', 'Casual'),
(170, 'jackets', 'C360_2015-03-22-21-48-03-895.jpg', 'ITB', 0, 'Light gray, Black', 'Plain', 'ITB', 'Casual'),
(171, 'jackets', 'C360_2015-03-22-22-02-14-929.jpg', 'n/a', 0, 'Blue', 'Plain', 'n/a', ''),
(172, 'jackets', 'C360_2015-04-26-08-21-43-941.jpg', 'HMIF', 1, 'Green, Orange, Black', 'Plain', 'HMIF', 'Casual'),
(173, 'jackets', 'C360_2015-03-22-17-00-09-331.jpg', 'n/a', 0, 'Red', 'Plain, Tartan', 'Balubur Town Square', ''),
(174, 'jackets', 'C360_2015-08-30-08-00-37-290.jpg', 'Cardigan Femme', 0, 'Light brown', 'Check', 'Matahari', 'Casual'),
(181, 'shoes', 'C360_2015-06-14-10-23-18-196.jpg', 'Connexion', 1, 'Brown', 'Laced', 'Matahari', '{Forma'),
(182, 'shoes', 'C360_2015-06-14-10-11-38-413.jpg', 'Crocs', 0, '{Casual}', 'Deep pink', 'Plain', 'n/a'),
(183, 'shoes', 'C360_2015-06-14-10-09-08-854.jpg', 'Connexion', 1, 'Red:Brick', 'Plain, Bow', 'Matahari', '{Casua'),
(184, 'shoes', 'C360_2015-06-14-10-10-14-192.jpg', 'St. Yves', 1, 'Black, Gray', 'Plain, Bow', 'Matahari', '{Casua'),
(191, 'socks', 'C360_2015-07-31-10-37-05-034.jpg', 'Sunafix', 1, 'Black', 'Plain', 'Matahari', 'Formal'),
(192, 'socks', 'C360_2015-06-14-10-23-18-196.jpg', 'n/a', 1, 'White, Pink:Light', 'Argyle', 'Pasar Salman', '{Casua'),
(193, 'socks', 'C360_2015-06-14-10-31-52-229.jpg', 'n/a', 1, 'Gray, Black', 'Totoro print', 'n/a', '{Casua'),
(194, 'socks', 'C360_2015-06-16-08-38-08-512.jpg', 'n/a', 1, 'White, Gray', 'Plain', 'Pasar Salman', '{Casua'),
(195, 'socks', 'C360_2015-06-14-10-26-26-714.jpg', 'Red Robin', 1, 'Red, White', 'Polka dot', 'n/a', '{Casua'),
(196, 'socks', 'C360_2015-06-16-08-40-33-751.jpg', 'n/a', 1, 'White, Gray:Deep, Red:Maroo', 'Argyle', 'Pasar Salman', '{Casua'),
(197, 'socks', 'C360_2015-06-16-08-44-04-764.jpg', 'n/a', 0, 'White', 'Polka dot', 'Pasar Salman', '{Casua'),
(198, 'socks', 'C360_2015-06-16-08-47-50-843.jpg', 'n/a', 0, 'White', 'Floral', 'Pasar Salman', '{Casua'),
(199, 'socks', 'C360_2015-06-14-10-29-19-872.jpg', 'n/a', 1, 'White, Green', 'Argyle', 'Pasar Salman', '{Casua'),
(200, 'socks', 'C360_2015-06-16-08-42-27-891.jpg', 'n/a', 0, 'White, Black', 'Polka dot', 'Pasar Salman', '{Casua'),
(301, 'underwears', 'C360_2015-04-18-16-47-33-326.jpg', 'Wacoal', 1, '{Formal,Casual} ', 'White', 'Plain, Laced', 'Mataha'),
(302, 'underwears', 'C360_2015-04-18-16-49-26-446.jpg', 'Wacoal', 0, '{Formal,Casual} ', 'Brown', 'Plain', 'Mataha'),
(303, 'underwears', 'C360_2015-04-18-17-57-27-743.jpg', 'Wacoal', 0, '{Formal,Casual} ', 'White', 'Plain', 'Mataha'),
(304, 'underwears', 'C360_2015-06-07-11-03-15-414.jpg', 'Sorella', 1, '{Formal,Casual} ', 'Salmon Pink', 'Plain', 'Mataha'),
(305, 'underwears', 'C360_2015-07-31-10-44-51-037.jpg', 'Venna', 1, '{Formal, Casual, Sport}', 'Brown', 'Plain', 'Ladies'),
(306, 'underwears', 'C360_2015-07-31-10-02-24-483.jpg', 'Venna', 0, '{Formal, Casual, Sport}', 'Maroon Red', 'Plain', 'Ladies'),
(307, 'underwears', 'C360_2015-07-31-10-15-43-474.jpg', 'Sorella', 1, '{Nightwear}', 'White, Brown', 'Floral', 'Mataha'),
(308, 'underwears', 'C360_2015-07-31-10-24-51-006.jpg', 'St Yves', 1, '{Nightwear}', 'Maroon Red', 'Laced', 'Mataha'),
(309, 'underwears', 'C360_2015-07-31-10-28-12-374.jpg', 'Amo''s Style', 1, '{Formal, Casual, Nightwear}', 'Pink', 'Laced', 'Ladies'),
(310, 'underwears', 'C360_2015-07-31-10-34-37-639.jpg', 'n/a', 0, '{Formal, Casual, Nightwear}', 'Brown', 'Plain', 'Ladies'),
(311, 'underwears', 'C360_2015-07-31-10-40-27-774.jpg', 'Sorella', 1, '{Nightwear}', 'White, Black', 'Floral, Laced', 'Mataha'),
(312, 'underwears', 'C360_2015-08-23-07-31-40-467.jpg', 'Wacoal', 0, '{Formal, Casual, Nightwear}', 'Black', 'Plain, Laced', 'Mataha'),
(313, 'underwears', 'C360_2015-07-31-10-12-09-528.jpg', 'Sorella', 1, '{Formal, Casual, Nightwear}', 'Black', 'Plain', 'Mataha'),
(314, 'underwears', 'C360_2015-04-18-16-45-36-387.jpg', 'Riena', 0, '{Formal, Casual}', 'Black, Deep g', 'Stripes', 'Pasar '),
(315, 'underwears', 'C360_2015-04-18-14-11-09-436.jpg', 'Riena', 0, '{Formal, Casual}', 'Brown', 'Plain', 'Pasar '),
(316, 'underwears', 'C360_2015-04-18-14-08-52-897.jpg', 'Riena', 1, '{Formal, Casual}', 'Purple', 'Plain', 'Pasar '),
(317, 'underwears', 'C360_2015-04-18-14-09-56-975.jpg', 'Riena', 0, '{Formal, Casual}', 'Black', 'Plain', 'Pasar '),
(318, 'underwears', 'C360_2015-08-23-07-30-26-596.jpg', 'Elena', 1, '{Formal, Casual, Nightwear}', 'White', 'Plain, Laced', 'Ladies'),
(319, 'underwears', 'C360_2015-08-23-07-38-09-003.jpg', 'n/a', 1, '{Formal, Casual}', 'White, Blue', 'Plain', 'n/a');

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
  `material` varchar(9) DEFAULT NULL,
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
(173, 'Jacket', '', '', ''),
(174, 'Blazer', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `outfits`
--

CREATE TABLE IF NOT EXISTS `outfits` (
  `id` int(255) NOT NULL
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
(141, 'Pashmina');

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
(48, 'Tank top', ''),
(49, 'Shirt', 'Mid');

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
(319, 'Tank top', 'All size');



--
-- Indexes for dumped tables
--

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
-- Constraints for dumped tables
--

--
-- Constraints for table `bags`
--
ALTER TABLE `bags`
  ADD CONSTRAINT `bags_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `tops`
--
ALTER TABLE `tops`
  ADD CONSTRAINT `tops_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `underwears`
--
ALTER TABLE `underwears`
  ADD CONSTRAINT `underwears_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bottoms`
--
ALTER TABLE `bottoms`
  ADD CONSTRAINT `bottoms_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `underwears`
--
ALTER TABLE `accessories`
  ADD CONSTRAINT `accessories_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `underwears`
--
ALTER TABLE `socks`
  ADD CONSTRAINT `socks_ibfk_1` FOREIGN KEY (`id`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `underwears`
--
ALTER TABLE `creates`
  ADD CONSTRAINT `creates_clothes_ibfk_1` FOREIGN KEY (`id_clothes`) REFERENCES `clothes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `creates`
  ADD CONSTRAINT `creates_outfit_ibfk_1` FOREIGN KEY (`id_outfit`) REFERENCES `outfits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
