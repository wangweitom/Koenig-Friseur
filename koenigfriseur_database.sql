-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2018 at 06:35 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koenigfriseur`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `imageID` int(45) NOT NULL,
  `sectionName` varchar(45) NOT NULL,
  `imgPath` varchar(256) NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `timeStamp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`imageID`, `sectionName`, `imgPath`, `imgName`, `timeStamp`) VALUES
(134, 'team', 'assets/images/team/team1.jpg', 'team1.jpg', '20.01.18 03:17:40'),
(135, 'team', 'assets/images/team/team2.jpg', 'team2.jpg', '20.01.18 03:17:49'),
(136, 'team', 'assets/images/team/team3.jpg', 'team3.jpg', '20.01.18 03:18:01'),
(137, 'service', 'assets/images/service/service1.jpg', 'service1.jpg', '20.01.18 03:23:30'),
(138, 'service', 'assets/images/service/service2.jpg', 'service2.jpg', '20.01.18 03:23:38'),
(139, 'service', 'assets/images/service/service3.jpg', 'service3.jpg', '20.01.18 03:23:57'),
(140, 'product', 'assets/images/product/product1.png', 'product1.png', '20.01.18 03:24:15'),
(141, 'product', 'assets/images/product/product2.png', 'product2.png', '20.01.18 03:24:25'),
(142, 'product', 'assets/images/product/product3.png', 'product3.png', '20.01.18 03:24:33'),
(143, 'product', 'assets/images/product/product4.png', 'product4.png', '20.01.18 03:24:41'),
(150, 'product', 'assets/images/product/product5.png', 'product5.png', '20.01.18 22:00:52'),
(151, 'product', 'assets/images/product/product6.png', 'product6.png', '20.01.18 22:01:38'),
(155, 'about', 'assets/images/about/IMG_2164.JPG', 'IMG_2164.JPG', '21.01.18 00:04:12'),
(156, 'team', 'assets/images/team/IMG_2090.JPG', 'IMG_2090.JPG', '21.01.18 00:06:29'),
(157, 'product', 'assets/images/product/IMG_1967.JPG', 'IMG_1967.JPG', '21.01.18 00:26:49'),
(158, 'product', 'assets/images/product/IMG_1987.JPG', 'IMG_1987.JPG', '21.01.18 00:27:51'),
(160, 'product', 'assets/images/product/IMG_1928.jpg', 'IMG_1928.jpg', '21.01.18 00:29:32'),
(161, 'product', 'assets/images/product/IMG_2010.jpg', 'IMG_2010.jpg', '21.01.18 00:30:34'),
(162, 'product', 'assets/images/product/IMG_2014.jpg', 'IMG_2014.jpg', '21.01.18 00:30:47'),
(163, 'product', 'assets/images/product/IMG_2016.jpg', 'IMG_2016.jpg', '21.01.18 00:30:58'),
(164, 'product', 'assets/images/product/product7.png', 'product7.png', '21.01.18 00:31:26'),
(165, 'product', 'assets/images/product/product8.png', 'product8.png', '21.01.18 00:31:35'),
(166, 'product', 'assets/images/product/product9.png', 'product9.png', '21.01.18 00:31:42'),
(167, 'home', 'assets/images/mainimage/mainimage.jpg', 'mainimage.jpg', '23.01.18 18:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `tabletext`
--

CREATE TABLE `tabletext` (
  `rowID` int(128) NOT NULL,
  `sectionName` varchar(45) NOT NULL,
  `col_0` varchar(45) NOT NULL,
  `col_1` varchar(45) NOT NULL,
  `col_2` varchar(45) NOT NULL,
  `col_3` varchar(45) NOT NULL,
  `col_4` varchar(45) NOT NULL,
  `col_5` varchar(45) NOT NULL,
  `timeStamp` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabletext`
--

INSERT INTO `tabletext` (`rowID`, `sectionName`, `col_0`, `col_1`, `col_2`, `col_3`, `col_4`, `col_5`, `timeStamp`) VALUES
(27, 'service', 'Haarschnitt', '12.50â‚¬', '', '', '', '', '20.01.18 03:23:05'),
(28, 'service', 'Bartrasur', '10.00â‚¬', '', '', '', '', '20.01.18 03:23:05'),
(29, 'service', 'Augenbrauen', '6.00â‚¬', '', '', '', '', '20.01.18 03:23:05'),
(30, 'service', 'Augenbrauen Pflege', '3.00â‚¬', '', '', '', '', '20.01.18 03:23:05'),
(31, 'service', 'Muster Rasur', 'ab 5.00â‚¬', '', '', '', '', '20.01.18 03:23:05'),
(32, 'service', 'Kinder bis 10 Jahred', '9.50â‚¬', '', '', '', '', '20.01.18 03:23:05'),
(33, 'service', '', '', '', '', '', '', '20.01.18 03:23:05'),
(34, 'service', 'Extras:', '', '', '', '', '', '20.01.18 03:23:05'),
(35, 'service', 'Seiten rasieren', '7.50â‚¬', '', '', '', '', '20.01.18 03:23:05'),
(36, 'service', 'American-Machine', '5.00â‚¬', '', '', '', '', '20.01.18 03:23:05'),
(37, 'service', 'Bart trimmen', '4.00â‚¬', '', '', '', '', '20.01.18 03:23:05'),
(38, 'service', 'Gesichtsmarke: Gold, Green, Black', '8.00â‚¬', '', '', '', '', '20.01.18 03:23:05'),
(39, 'service', 'Heisswachs,Haare entfernen', '', '', '', '', '', '20.01.18 03:23:06'),
(40, 'service', '- Nase', '6.00â‚¬', '', '', '', '', '20.01.18 03:23:06'),
(41, 'service', '- Ohren', '5.00â‚¬', '', '', '', '', '20.01.18 03:23:06'),
(42, 'service', '- Wangen', '5.00â‚¬', '', '', '', '', '20.01.18 03:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `text`
--

CREATE TABLE `text` (
  `sectionID` int(8) NOT NULL,
  `sectionName` varchar(45) NOT NULL,
  `sectionContent` varchar(3000) DEFAULT NULL,
  `location` varchar(256) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `text`
--

INSERT INTO `text` (`sectionID`, `sectionName`, `sectionContent`, `location`, `timeStamp`) VALUES
(1, 'home', 'This is default content.', '', '2018-01-15 17:57:35'),
(2, 'about', 'Seit 10 Jahren in der KÃ¶nigstraÃŸe 120 ansÃ¤ssig, betreibt Taib Akrawi seinen Friseursalon mit modischen Frisuren inklusive Styling-und Pflegeprodukten, Augenformzupfen mit Band, OhrhÃ¤rchenentfernung mit Flamme und Bartrasur ( Modellierung , Muster und Symbole nach Kundenwunsch und eingehender Beratung). Auf Wunsch nach der Rasur sind hautberuhigende MaÃŸnahmen mit Cremes oder Masken selbstverstÃ¤ndlich. Neben GetrÃ¤nken, im Service inklusive, ist Sport auf Sky HD zu sehen, z.B. Sport/Bundesliga am Wochenende und Ãœbertragungen zu allen anderen Ereignissen. Wer einmal kommt, kommt immer wieder. Deswegen wurde auf vielfachen Kundenwunsch die Bonuskarte eingefÃ¼hrt, der 11. Besuch ist frei. KÃ¶nig Friseur bedankt sich bei allen zufriedenen und wiederkehrenden Kunden. Ihr findet den KÃ¶nig Friseur in der KÃ¶nigstraÃŸe 120, in der LÃ¼becker Innenstadt.\r<br>\r<br>Tel.: 0451 - 707 33 71 \r<br>Ã–ffnungszeiten: Mo- Fr 09.00 - 19.00 Uhr und Sa. 09.00 - 18.00 Uhr                                                                                                                                                                                                                                                                                        ', '', '2018-01-09 21:07:57'),
(3, 'team', NULL, '', '2018-01-15 17:57:45'),
(4, 'service', NULL, '', '2018-01-15 17:58:08'),
(5, 'product', NULL, '', '2018-01-15 17:58:16'),
(6, 'contact', 'Since 2007\r<br>\r<br>WÃ¤hlen Sie KÃ¶ing Friseur, weil wir professionell und sachkundig sind.\r<br>\r<br>Facebook: @KoenigFriseur\r<br>Instagram: koenig_friseur\r<br>Google Map: KÃ¶nig-Friseur                                                                                                                                                                                                                                                                                          ', 'left', '2018-01-19 21:22:23'),
(7, 'contact', 'Ã–ffnungszeiten: \r<br>Mo. - Fr. 09.00 - 19.00 Uhr \r<br>Sa. 09.00 - 18.00 Uhr                                                                                                                                  ', 'rightUp', '2018-01-19 21:46:41'),
(8, 'contact', 'KÃ¶nigstraÃŸe 120 23552 LÃ¼beck', 'rightAddr', '2018-01-19 21:47:11'),
(9, 'contact', '0451 - 707 33 71                                                                  ', 'rightTel', '2018-01-19 21:47:32'),
(28, 'product', 'gummy matte', 'productNameassets/images/product/product1.png', '2020-01-18 19:52:54'),
(29, 'product', '5 euro', 'productPriceassets/images/product/product1.png', '2020-01-18 19:52:54'),
(30, 'product', 'cologne fresh', 'productNameassets/images/product/product7.png', '2020-01-18 19:56:02'),
(31, 'product', '3.99 euro', 'productPriceassets/images/product/product7.png', '2020-01-18 19:56:03'),
(32, 'product', 'AQUA HAIR WAX RED', 'productNameassets/images/product/product5.png', '2020-01-18 19:58:09'),
(33, 'product', '6 euro', 'productPriceassets/images/product/product5.png', '2020-01-18 19:58:09'),
(34, 'product', 'AQUA HAIR WAX BLUE', 'productNameassets/images/product/product4.png', '2020-01-18 19:58:59'),
(35, 'product', '6 euro', 'productPriceassets/images/product/product4.png', '2020-01-18 19:58:59'),
(36, 'product', 'gummy hard', 'productNameassets/images/product/product2.png', '2020-01-18 20:55:29'),
(37, 'product', '5 euro', 'productPriceassets/images/product/product2.png', '2020-01-18 20:55:29'),
(38, 'product', 'gummy ultra', 'productNameassets/images/product/product3.png', '2020-01-18 20:55:35'),
(39, 'product', '5 euro', 'productPriceassets/images/product/product3.png', '2020-01-18 20:55:35'),
(40, 'product', 'cologne extreme', 'productNameassets/images/product/product9.png', '2020-01-18 20:58:41'),
(41, 'product', '3.99 euro', 'productPriceassets/images/product/product9.png', '2020-01-18 20:58:41'),
(42, 'product', 'AQUA HAIR WAX BLACK', 'productNameassets/images/product/product6.png', '2020-01-18 20:58:59'),
(43, 'product', '6 euro', 'productPriceassets/images/product/product6.png', '2020-01-18 20:58:59'),
(44, 'product', 'cologne sport', 'productNameassets/images/product/product8.png', '2020-01-18 20:59:21'),
(45, 'product', '3.99 euro', 'productPriceassets/images/product/product8.png', '2020-01-18 20:59:21'),
(46, 'product', 'gummy extra', 'productNameassets/images/product/IMG_1967.JPG', '2021-01-17 23:37:33'),
(47, 'product', '5 euro', 'productPriceassets/images/product/IMG_1967.JPG', '2021-01-17 23:37:33'),
(48, 'product', 'gummy casual', 'productNameassets/images/product/IMG_1987.JPG', '2021-01-17 23:37:55'),
(49, 'product', '5 euro', 'productPriceassets/images/product/IMG_1987.JPG', '2021-01-17 23:37:55'),
(50, 'product', 'fonex', 'productNameassets/images/product/IMG_1928.jpg', '2021-01-17 23:38:20'),
(51, 'product', '4.5 euro', 'productPriceassets/images/product/IMG_1928.jpg', '2021-01-17 23:38:20'),
(52, 'product', 'zenix moss', 'productNameassets/images/product/IMG_2010.jpg', '2021-01-17 23:38:56'),
(53, 'product', '6.99 euro', 'productPriceassets/images/product/IMG_2010.jpg', '2021-01-17 23:38:56'),
(54, 'product', 'zenix black mask', 'productNameassets/images/product/IMG_2014.jpg', '2021-01-17 23:39:33'),
(55, 'product', '6.99 euro', 'productPriceassets/images/product/IMG_2014.jpg', '2021-01-17 23:39:33'),
(56, 'product', 'zenix gold', 'productNameassets/images/product/IMG_2016.jpg', '2021-01-17 23:40:00'),
(57, 'product', '7.49 euro', 'productPriceassets/images/product/IMG_2016.jpg', '2021-01-17 23:40:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`imageID`);

--
-- Indexes for table `tabletext`
--
ALTER TABLE `tabletext`
  ADD PRIMARY KEY (`rowID`);

--
-- Indexes for table `text`
--
ALTER TABLE `text`
  ADD PRIMARY KEY (`sectionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `imageID` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `tabletext`
--
ALTER TABLE `tabletext`
  MODIFY `rowID` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `text`
--
ALTER TABLE `text`
  MODIFY `sectionID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
