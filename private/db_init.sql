-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 10 déc. 2017 à 18:29
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
-- Base de données :  `tlo`
--

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `rfid` varchar(64) NOT NULL,
  `nom` text NOT NULL,
  `a_utilise_hbm` tinyint(1) NOT NULL DEFAULT '0',
  `groupe_sanguin` varchar(3) NOT NULL,
  `infos_sang` text,
  `etat_patient_calme` text NOT NULL,
  `etat_patient_agite` text NOT NULL,
  `etat_patient_tres_agite` text NOT NULL,
  PRIMARY KEY (`rfid`),
  UNIQUE KEY `rfid` (`rfid`),
  KEY `rfid_2` (`rfid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`rfid`, `nom`, `a_utilise_hbm`, `groupe_sanguin`, `infos_sang`, `etat_patient_calme`, `etat_patient_agite`, `etat_patient_tres_agite`) VALUES
('00000001', 'John Doe', 1, 'O+', 'Vert fluo', 'infos calme', 'info agité', 'info très agité'),
('00000002', 'Jane Doe', 1, 'AB-', 'Rien de particulier', 'infos calme', 'info agité', 'info très agité');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
