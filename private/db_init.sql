-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 12 fév. 2018 à 21:30
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
-- Structure de la table `adn`
--

DROP TABLE IF EXISTS `adn`;
CREATE TABLE IF NOT EXISTS `adn` (
  `rfid` varchar(64) NOT NULL,
  `base_1` enum('A','T','G','C') NOT NULL DEFAULT 'A',
  `base_2` enum('A','T','G','C') NOT NULL DEFAULT 'A',
  `base_3` enum('A','T','G','C') NOT NULL DEFAULT 'A',
  `base_4` enum('A','T','G','C') NOT NULL DEFAULT 'A',
  `prelevement_effectue` enum('T','F') NOT NULL DEFAULT 'F',
  PRIMARY KEY (`rfid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adn`
--

INSERT INTO `adn` (`rfid`, `base_1`, `base_2`, `base_3`, `base_4`, `prelevement_effectue`) VALUES
('00000001', 'A', 'T', 'G', 'C', 'F'),
('00000002', 'A', 'T', 'A', 'C', 'F');

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `rfid` varchar(64) NOT NULL,
  `nom` text NOT NULL,
  `sexe` enum('H','F') NOT NULL,
  `a_utilise_hbm` enum('T','F') NOT NULL DEFAULT 'F',
  `groupe_sanguin` varchar(3) NOT NULL,
  `infos_sang` text,
  `etat_patient_calme` text NOT NULL,
  `etat_patient_agite` text NOT NULL,
  `etat_patient_tres_agite` text NOT NULL,
  `diagnostic_drogue` text NOT NULL,
  `diagnostic_maladie` text NOT NULL,
  `diagnostic_imagerie` text NOT NULL,
  `spermogramme` text NOT NULL,
  `test_grossesse` text NOT NULL,
  PRIMARY KEY (`rfid`),
  UNIQUE KEY `rfid` (`rfid`),
  KEY `rfid_2` (`rfid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`rfid`, `nom`, `sexe`, `a_utilise_hbm`, `groupe_sanguin`, `infos_sang`, `etat_patient_calme`, `etat_patient_agite`, `etat_patient_tres_agite`, `diagnostic_drogue`, `diagnostic_maladie`, `diagnostic_imagerie`, `spermogramme`, `test_grossesse`) VALUES
('00000001', 'John Doe', 'H', 'T', 'O+', 'Vert fluo', 'infos calme', 'info agité', 'info très agité', 'Rien à signaler', 'Rien à signaler', 'Rien à signaler', 'Fécondité normale', ''),
('00000002', 'Jane Doe', 'F', 'T', 'AB-', 'Rien de particulier', 'infos calme', 'info agité', 'info très agité', 'Camée à la novocaïne', 'Cancer du poumon, SIDA, Hépatites A-Z', 'Octuple fracture du tibia gauche, torsion des vertèbres.', '', 'Négatif');

-- --------------------------------------------------------

--
-- Structure de la table `vecteur`
--

DROP TABLE IF EXISTS `vecteur`;
CREATE TABLE IF NOT EXISTS `vecteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rfid` varchar(64) NOT NULL,
  `base_1` enum('A','T','G','C') NOT NULL DEFAULT 'A',
  `base_2` enum('A','T','G','C') NOT NULL DEFAULT 'A',
  `base_3` enum('A','T','G','C') NOT NULL DEFAULT 'A',
  `base_4` enum('A','T','G','C') NOT NULL DEFAULT 'A',
  `description` text NOT NULL,
  `statut` enum('CREE','VALIDE','ADMINISTRE') NOT NULL DEFAULT 'CREE',
  PRIMARY KEY (`id`),
  KEY `https://www.leroymerlin.fr/v3/p/produits/quincaillerie-securite/` (`rfid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vecteur`
--

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adn`
--
ALTER TABLE `adn`
  ADD CONSTRAINT `fk_adn_rfid` FOREIGN KEY (`rfid`) REFERENCES `patients` (`rfid`);

--
-- Contraintes pour la table `vecteur`
--
ALTER TABLE `vecteur`
  ADD CONSTRAINT `https://www.leroymerlin.fr/v3/p/produits/quincaillerie-securite/` FOREIGN KEY (`rfid`) REFERENCES `patients` (`rfid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
