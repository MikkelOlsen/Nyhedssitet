-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Vært: 127.0.0.1
-- Genereringstid: 19. 04 2017 kl. 14:26:21
-- Serverversion: 5.6.24
-- PHP-version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nyhedssitet`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `feed`
--

CREATE TABLE IF NOT EXISTS `feed` (
  `id` int(11) NOT NULL,
  `feedName` varchar(50) NOT NULL,
  `feedurl` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `feed`
--

INSERT INTO `feed` (`id`, `feedName`, `feedurl`) VALUES
(4, 'DR - Viden', 'http://www.dr.dk/nyheder/service/feeds/viden'),
(6, 'Børsen', 'http://borsen.dk/rss/'),
(7, 'Computerworld - Teknologi', 'https://www.computerworld.dk//rss/tag/teknologi'),
(8, 'Politiken - Danmark', 'http://politiken.dk/rss/indland.rss'),
(9, 'Forsvaret', 'http://www.fmn.dk/_layouts/Forsvaret_Rss.aspx?path=%2FNyheder&queryFileUrl=Style%20Library%2FSkins%2Ffsv%2FResources%2FXml%2FForsvaretPageQuery.xml&li'),
(11, 'Dr Dk', 'http://www.dr.dk/nyheder/service/feeds/penge'),
(12, 'Berlingske - Nationalt', 'https://www.b.dk/feeds/rss/Nationalt'),
(13, 'Business.dk', 'http://www.business.dk/seneste/rss');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `mynews`
--

CREATE TABLE IF NOT EXISTS `mynews` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `article` text,
  `fkPicture` int(11) DEFAULT NULL,
  `fkCreated` int(11) DEFAULT NULL,
  `fkEdited` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `mynews`
--

INSERT INTO `mynews` (`id`, `title`, `article`, `fkPicture`, `fkCreated`, `fkEdited`) VALUES
(4, 'Test', 'V2', 6, 3, 2);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL,
  `filename` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `pictures`
--

INSERT INTO `pictures` (`id`, `filename`) VALUES
(6, '7_fars_favorit.jpg');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `password`) VALUES
(2, 'Hr', 'Test', 'tester', '$2y$10$ekl7JkcSKex7RWavUEYNhuLZTOta4CSIqAg.yPE.OZUzwSvHBxcUq'),
(3, 'Mikkel', 'Olsen', 'Mikkel', '$2y$10$ZKo7Ck11HV3.aY0/U.aef.TsItYN..TO99CtjZEDpk5oTvcTSaZZK');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `feed`
--
ALTER TABLE `feed`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `mynews`
--
ALTER TABLE `mynews`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_picture_idx` (`fkPicture`), ADD KEY `fk_user_created_idx` (`fkCreated`), ADD KEY `fk_user_edited_idx` (`fkEdited`);

--
-- Indeks for tabel `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `feed`
--
ALTER TABLE `feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Tilføj AUTO_INCREMENT i tabel `mynews`
--
ALTER TABLE `mynews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Tilføj AUTO_INCREMENT i tabel `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `mynews`
--
ALTER TABLE `mynews`
ADD CONSTRAINT `fk_picture` FOREIGN KEY (`fkPicture`) REFERENCES `pictures` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_user_created` FOREIGN KEY (`fkCreated`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_user_edited` FOREIGN KEY (`fkEdited`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
