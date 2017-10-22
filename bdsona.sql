-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 22 oct. 2017 à 17:58
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdsona`
--

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

DROP TABLE IF EXISTS `chauffeur`;
CREATE TABLE IF NOT EXISTS `chauffeur` (
  `id_chf` int(10) NOT NULL AUTO_INCREMENT,
  `nom_chf` varchar(50) NOT NULL,
  `prenom_chf` varchar(50) NOT NULL,
  `mat_chf` varchar(50) NOT NULL,
  `etat_chf` varchar(20) NOT NULL,
  PRIMARY KEY (`id_chf`),
  UNIQUE KEY `matricule` (`mat_chf`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id_dmd` int(10) NOT NULL AUTO_INCREMENT,
  `id_usr` int(10) NOT NULL,
  `chf` varchar(5) NOT NULL,
  `aller_dmd` datetime DEFAULT NULL,
  `retour_dmd` datetime DEFAULT NULL,
  `motif_dmd` varchar(400) NOT NULL,
  `etat_dmd` varchar(10) NOT NULL,
  PRIMARY KEY (`id_dmd`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_res` int(10) NOT NULL AUTO_INCREMENT,
  `id_dmd` int(10) NOT NULL,
  `id_veh` int(10) NOT NULL,
  `id_chf` int(10) DEFAULT NULL,
  `aller_res` datetime NOT NULL,
  `retour_res` datetime DEFAULT NULL,
  `kma_res` int(10) NOT NULL,
  `kmr_res` int(10) DEFAULT NULL,
  `dest_res` varchar(100) NOT NULL,
  PRIMARY KEY (`id_res`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_usr` int(10) NOT NULL AUTO_INCREMENT,
  `nomUtilisateur` varchar(50) NOT NULL,
  `motDePasse` varchar(100) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `direction` varchar(20) NOT NULL,
  `division` varchar(20) NOT NULL,
  `type_user` varchar(20) NOT NULL,
  PRIMARY KEY (`id_usr`),
  UNIQUE KEY `nomUtilisateur` (`nomUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=2003 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_usr`, `nomUtilisateur`, `motDePasse`, `nom`, `prenom`, `direction`, `division`, `type_user`) VALUES
(2002, 'user@user.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'Mister', 'User', 'prod', 'ISI', 'simple'),
(2001, 'super@super.com', '1b3231655cebb7a1f783eddf27d254ca', 'Mister', 'Supervisor', 'prod', 'ISI', 'superieur'),
(2000, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Mister', 'Administrator', 'prod', 'ACT', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `id_veh` int(10) NOT NULL AUTO_INCREMENT,
  `nom_veh` varchar(100) NOT NULL,
  `mrq_veh` varchar(100) NOT NULL,
  `mat_veh` varchar(50) NOT NULL,
  `etat_veh` varchar(20) NOT NULL,
  `km_veh` int(20) NOT NULL,
  PRIMARY KEY (`id_veh`),
  UNIQUE KEY `Mat` (`mat_veh`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
