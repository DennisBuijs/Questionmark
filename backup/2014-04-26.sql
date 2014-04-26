-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Machine: localhost:8889
-- Gegenereerd op: 26 apr 2014 om 22:38
-- Serverversie: 5.5.34
-- PHP-versie: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databank: `questionmark`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`id`, `name`, `password`, `email`, `admin`) VALUES
(1, 'admin', 'db3ccd27b8cff3dd070e7e56ae33e7bcc83536118f1240af0a4688c4d7216474e01f3c3cc5f9b86df15c591120e4d43ffdf2bbf7b4e409c4d78dba20712daabc', 'admin@gmail.com', 1),
(2, 'Laura', 'db3ccd27b8cff3dd070e7e56ae33e7bcc83536118f1240af0a4688c4d7216474e01f3c3cc5f9b86df15c591120e4d43ffdf2bbf7b4e409c4d78dba20712daabc', 'lauara@gmail.com', 0),
(3, 'DvOtterloo', 'db3ccd27b8cff3dd070e7e56ae33e7bcc83536118f1240af0a4688c4d7216474e01f3c3cc5f9b86df15c591120e4d43ffdf2bbf7b4e409c4d78dba20712daabc', 'dvotterloo@gmail.com', 0),
(4, '076FissaBoy076', 'db3ccd27b8cff3dd070e7e56ae33e7bcc83536118f1240af0a4688c4d7216474e01f3c3cc5f9b86df15c591120e4d43ffdf2bbf7b4e409c4d78dba20712daabc', 'swek@gmail.com', 0),
(5, 'Piet', 'a5cfae95931215fdb510dda26011f1424e7b3b0035dfa2b6db6730e77f2d17715f14b05570dd0c3ce0e7069b50a29c2671b11a6a451b1229abe5fd6c89171d0d', 'piet@gmail.com', 0);
