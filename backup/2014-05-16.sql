-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Machine: localhost:8889
-- Gegenereerd op: 16 mei 2014 om 15:26
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Contacts`
--

CREATE TABLE `Contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Questions`
--

CREATE TABLE `Questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `Question_Types_id` int(11) NOT NULL,
  `Enquetes_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Question_Attribute_Types`
--

CREATE TABLE `Question_Attribute_Types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Question_Types`
--

CREATE TABLE `Question_Types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;


INSERT INTO `questionmark`.`Users` (`id`, `name`, `password`, `email`, `admin`) 
VALUES (NULL, 'admin', 'db3ccd27b8cff3dd070e7e56ae33e7bcc83536118f1240af0a4688c4d7216474e01f3c3cc5f9b86df15c591120e4d43ffdf2bbf7b4e409c4d78dba20712daabc', 'admin@gmail.com', '1');