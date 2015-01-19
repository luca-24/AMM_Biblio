-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Gen 19, 2015 alle 13:38
-- Versione del server: 5.5.35
-- Versione PHP: 5.4.6-1ubuntu1.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `amm2014_pirasLuca`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizioni`
--

CREATE TABLE IF NOT EXISTS `iscrizioni` (
  `bibliotecarioId` int(11) DEFAULT NULL,
  `lettoreId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `iscrizioni`
--

INSERT INTO `iscrizioni` (`bibliotecarioId`, `lettoreId`) VALUES
(125, 124);

-- --------------------------------------------------------

--
-- Struttura della tabella `libri`
--

CREATE TABLE IF NOT EXISTS `libri` (
  `titolo` varchar(128) DEFAULT NULL,
  `autore` varchar(128) DEFAULT NULL,
  `casaEditrice` varchar(128) DEFAULT NULL,
  `genere` varchar(30) DEFAULT NULL,
  `nPagine` int(11) DEFAULT NULL,
  `bibliotecarioId` int(11) DEFAULT NULL,
  `lettoreId` int(11) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dataPrestito` date DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dump dei dati per la tabella `libri`
--

INSERT INTO `libri` (`titolo`, `autore`, `casaEditrice`, `genere`, `nPagine`, `bibliotecarioId`, `lettoreId`, `id`, `dataPrestito`) VALUES
('La Divina Commedia', 'Dante Alighieri', 'Einaudi', 'Poesia', 333, 125, 124, 81, '2015-01-18'),
('La Divina Commedia', 'Dante Alighieri', 'Einaudi', 'Poesia', 333, 125, NULL, 82, NULL),
('La Divina Commedia', 'Dante Alighieri', 'Einaudi', 'Poesia', 333, 125, NULL, 83, NULL),
('La Divina Commedia', 'Dante Alighieri', 'Einaudi', 'Poesia', 333, 125, NULL, 84, NULL),
('Il Canzoniere', 'Francesco Petrarca', 'Mondadori', 'Poesia', 240, 125, NULL, 85, NULL),
('Il Canzoniere', 'Francesco Petrarca', 'Mondadori', 'Poesia', 240, 125, NULL, 86, NULL),
('Il Canzoniere', 'Francesco Petrarca', 'Mondadori', 'Poesia', 240, 125, NULL, 87, NULL),
('Addio alle armi', 'Ernest Hemingway', 'Mondadori', 'Romanzo', 380, 125, NULL, 88, NULL),
('Addio alle armi', 'Ernest Hemingway', 'Mondadori', 'Romanzo', 380, 125, NULL, 89, NULL),
('Cent''anni di solitudine', 'Gabriel Garcia Marquez', 'Adelphi', 'Romanzo', 410, 125, NULL, 90, NULL),
('Cent''anni di solitudine', 'Gabriel Garcia Marquez', 'Adelphi', 'Romanzo', 410, 125, NULL, 91, NULL),
('L''origine delle specie', 'Charles Darwin', 'Adelphi', 'Saggio', 250, 125, NULL, 92, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `nome` varchar(128) DEFAULT NULL,
  `cognome` varchar(128) DEFAULT NULL,
  `citta` varchar(128) DEFAULT NULL,
  `indirizzo` varchar(128) DEFAULT NULL,
  `dataDiNascita` date DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `nomeBiblioteca` varchar(128) DEFAULT NULL,
  `nAmmonizioni` int(11) DEFAULT NULL,
  `ruolo` varchar(20) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=126 ;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`nome`, `cognome`, `citta`, `indirizzo`, `dataDiNascita`, `email`, `password`, `nomeBiblioteca`, `nAmmonizioni`, `ruolo`, `id`) VALUES
('Marco', 'Rossi', 'Roma', 'Via Leopardi, 23', '1954-08-20', 'lettore@biblio.it', 'lettore', NULL, 0, 'lettore', 124),
('Paolo', 'Bianchi', 'Cagliari', 'Via Dante, 44', '1965-01-08', 'bibliotecario@biblio.it', 'bibliotecario', 'Biblioteca Comunale Emilio Lussu', NULL, 'bibliotecario', 125);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
