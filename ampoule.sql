-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 09 fév. 2021 à 15:53
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ampoule`
--

-- --------------------------------------------------------

--
-- Structure de la table `ampoule`
--

DROP TABLE IF EXISTS `ampoule`;
CREATE TABLE IF NOT EXISTS `ampoule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_changement` date NOT NULL,
  `etage` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ampoule`
--

INSERT INTO `ampoule` (`id`, `date_changement`, `etage`, `position`, `prix`) VALUES
(68, '2017-08-22', 'etage 7', 'droit', '2.24'),
(32, '2016-09-24', 'etage 6', 'droit', '2.54'),
(66, '2018-06-23', 'etage 8', 'fond', '1.98'),
(58, '2020-04-17', 'etage 8', 'gauche', '2.58'),
(39, '2015-11-10', 'etage 9', 'fond', '3.57'),
(67, '2016-11-29', 'rez-de-chaussee', 'droit', '2.23'),
(62, '2020-06-20', 'etage 9', 'droit', '2.54'),
(63, '2020-07-23', 'etage 9', 'droit', '3.84'),
(64, '2019-08-02', 'etage 9', 'fond', '1.98'),
(65, '2019-10-05', 'etage 8', 'droit', '2.52'),
(61, '2015-11-12', 'etage 2', 'droit', '2.58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
