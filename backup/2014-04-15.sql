-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Machine: localhost:8889
-- Gegenereerd op: 15 apr 2014 om 14:07
-- Serverversie: 5.5.34
-- PHP-versie: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databank: `questionmark`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Answers`
--

CREATE TABLE `Answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Questions_id` int(11) NOT NULL,
  `Sessions_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Enquetes`
--

CREATE TABLE `Enquetes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `introduction` text,
  `creation_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `Users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Gegevens worden geëxporteerd voor tabel `Enquetes`
--

INSERT INTO `Enquetes` (`id`, `name`, `introduction`, `creation_date`, `end_date`, `start_date`, `Users_id`) VALUES
(1, 'Tevredenheidsonderzoek', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis lacus ac est porta, sit amet lobortis turpis pharetra. Mauris ut turpis in arcu venenatis semper at sit amet purus. Duis consequat convallis purus a commodo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed lobortis mi a ante luctus, ac varius augue porttitor. Aenean nec justo lobortis, elementum mi ut, rhoncus eros. Vivamus porttitor interdum posuere. Sed lacinia vitae mauris et varius. Nullam facilisis turpis orci, facilisis lobortis nisi dictum non. Proin venenatis massa ligula, sit amet sagittis felis lacinia eu. Etiam vitae posuere nibh, ut elementum neque. Phasellus placerat magna at adipiscing venenatis.\r\n', '2014-04-15', '2014-06-30', '2014-04-13', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Questions`
--

CREATE TABLE `Questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  `Question_Types_id` int(11) NOT NULL,
  `Enquetes_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Gegevens worden geëxporteerd voor tabel `Questions`
--

INSERT INTO `Questions` (`id`, `question`, `Question_Types_id`, `Enquetes_id`) VALUES
(1, 'Wat is uw naam?', 1, 1),
(2, 'Wat vindt u van ons product?', 2, 1),
(3, 'Wat is uw geslacht?', 3, 1),
(4, 'Binnen welke leeftijdsgroep valt u?', 4, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Question_Attributes`
--

CREATE TABLE `Question_Attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute` varchar(255) DEFAULT NULL,
  `Questions_id` int(11) NOT NULL,
  `Question_Attribute_Types_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Gegevens worden geëxporteerd voor tabel `Question_Attributes`
--

INSERT INTO `Question_Attributes` (`id`, `attribute`, `Questions_id`, `Question_Attribute_Types_id`) VALUES
(1, 'Man', 3, 1),
(2, 'Vrouw', 3, 1),
(3, '12 - 18', 4, 1),
(4, '18 - 24', 4, 1),
(5, '24 - 32', 4, 1),
(6, '32+', 4, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Question_Attribute_Types`
--

CREATE TABLE `Question_Attribute_Types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Gegevens worden geëxporteerd voor tabel `Question_Attribute_Types`
--

INSERT INTO `Question_Attribute_Types` (`id`, `attribute_type`) VALUES
(1, 'option');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Question_Types`
--

CREATE TABLE `Question_Types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Gegevens worden geëxporteerd voor tabel `Question_Types`
--

INSERT INTO `Question_Types` (`id`, `type`) VALUES
(1, 'textfield'),
(2, 'textarea'),
(3, 'radio'),
(4, 'select');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Sessions`
--

CREATE TABLE `Sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`id`, `name`, `password`, `email`) VALUES
(1, 'admin', 'db3ccd27b8cff3dd070e7e56ae33e7bcc83536118f1240af0a4688c4d7216474e01f3c3cc5f9b86df15c591120e4d43ffdf2bbf7b4e409c4d78dba20712daabc', 'admin@gmail.com');
