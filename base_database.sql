-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 05 sep. 2022 à 01:12
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `base`
--
CREATE DATABASE IF NOT EXISTS `base` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `base`;

-- --------------------------------------------------------

--
-- Structure de la table `arrivage_marché`
--

CREATE TABLE `arrivage_marché` (
  `id` int(10) UNSIGNED NOT NULL,
  `AM_arrivage` varchar(255) NOT NULL,
  `AM_marché` varchar(255) NOT NULL,
  `qte` bigint(20) NOT NULL,
  `date_stockage` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `arrivage_marché`
--

INSERT INTO `arrivage_marché` (`id`, `AM_arrivage`, `AM_marché`, `qte`, `date_stockage`) VALUES
(1, '01/2018', '2-1/2017/MEF/AC/INF', 59, '2018-07-25'),
(2, '01/2018', '1-1/2018/MEF/AC/INF', 9, '2018-07-25'),
(3, '01/2019', '1-1/2018/MEF/AC/INF', 35, '2019-07-01'),
(4, '01/2019', '2-1/2017/MEF/AC/INF', 4, '2019-07-01'),
(5, '05/2019', '2-1/2017/MEF/AC/INF', 4, '2019-11-19');

--
-- Déclencheurs `arrivage_marché`
--
DELIMITER $$
CREATE TRIGGER `before_delete_arrivage_marché` BEFORE DELETE ON `arrivage_marché` FOR EACH ROW BEGIN
 INSERT INTO `arrivage_marché_histo` (
  id,
  AM_arrivage,
  AM_marché,
  qte,
  date_stockage,
  event,
  date_event
        )
    VALUES (
 OLD.id,
  OLD.AM_arrivage,
  OLD.AM_marché,
  OLD.qte,
  OLD.date_stockage,
  'DELETE',
  NOW()

      );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_arrivage_marché` BEFORE UPDATE ON `arrivage_marché` FOR EACH ROW BEGIN
 INSERT INTO `arrivage_marché_histo` (
  id,
  AM_arrivage,
  AM_marché,
  qte,
  date_stockage,
  event,
  date_event
        )
    VALUES (
 OLD.id,
  OLD.AM_arrivage,
  OLD.AM_marché,
  OLD.qte,
  OLD.date_stockage,
  'UPDATE',
  NOW()
      );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `arrivage_marché_histo`
--

CREATE TABLE `arrivage_marché_histo` (
  `id_histo` int(10) UNSIGNED NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `AM_arrivage` varchar(255) NOT NULL,
  `AM_marché` varchar(255) NOT NULL,
  `qte` bigint(20) NOT NULL,
  `date_stockage` date NOT NULL,
  `event` varchar(30) NOT NULL,
  `date_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `arrivage_marché_histo`
--

INSERT INTO `arrivage_marché_histo` (`id_histo`, `id`, `AM_arrivage`, `AM_marché`, `qte`, `date_stockage`, `event`, `date_event`) VALUES
(19, 1, '01/2018', '2-1/2017/MEF/AC/INF', 67, '2018-07-25', 'UPDATE', '2019-10-08 09:22:57'),
(20, 4, '01/2019', '2-1/2017/MEF/AC/INF', 5, '2019-07-01', 'UPDATE', '2019-10-08 09:22:57'),
(21, 1, '01/2018', '2-1/2017/MEF/AC/INF', 66, '2018-07-25', 'UPDATE', '2019-10-08 15:10:49'),
(22, 2, '01/2018', '1-1/2018/MEF/AC/INF', 18, '2018-07-25', 'UPDATE', '2019-10-08 15:10:50'),
(23, 3, '01/2019', '1-1/2018/MEF/AC/INF', 38, '2019-07-01', 'UPDATE', '2019-10-08 19:31:34'),
(24, 2, '01/2018', '1-1/2018/MEF/AC/INF', 17, '2018-07-25', 'UPDATE', '2019-10-08 19:31:34'),
(25, 1, '01/2018', '2-1/2017/MEF/AC/INF', 65, '2018-07-25', 'UPDATE', '2019-10-08 19:50:27'),
(26, 2, '01/2018', '1-1/2018/MEF/AC/INF', 16, '2018-07-25', 'UPDATE', '2019-10-08 19:50:27'),
(27, 1, '01/2018', '2-1/2017/MEF/AC/INF', 64, '2018-07-25', 'UPDATE', '2019-10-09 16:28:27'),
(28, 1, '01/2018', '2-1/2017/MEF/AC/INF', 63, '2018-07-25', 'UPDATE', '2019-10-18 17:38:58'),
(29, 2, '01/2018', '1-1/2018/MEF/AC/INF', 15, '2018-07-25', 'UPDATE', '2019-10-18 17:38:58'),
(30, 1, '01/2018', '2-1/2017/MEF/AC/INF', 62, '2018-07-25', 'UPDATE', '2019-10-21 17:30:36'),
(31, 2, '01/2018', '1-1/2018/MEF/AC/INF', 14, '2018-07-25', 'UPDATE', '2019-10-21 17:30:36'),
(32, 1, '01/2018', '2-1/2017/MEF/AC/INF', 61, '2018-07-25', 'UPDATE', '2019-10-22 02:03:38'),
(33, 2, '01/2018', '1-1/2018/MEF/AC/INF', 13, '2018-07-25', 'UPDATE', '2019-10-22 02:03:38'),
(34, 1, '01/2018', '2-1/2017/MEF/AC/INF', 60, '2018-07-25', 'UPDATE', '2019-10-27 13:24:02'),
(35, 2, '01/2018', '1-1/2018/MEF/AC/INF', 12, '2018-07-25', 'UPDATE', '2019-10-27 13:24:02'),
(36, 1, '01/2018', '2-1/2017/MEF/AC/INF', 59, '2018-07-25', 'UPDATE', '2019-10-28 20:59:30'),
(37, 3, '01/2019', '1-1/2018/MEF/AC/INF', 37, '2019-07-01', 'UPDATE', '2019-10-29 21:42:00'),
(38, 1, '01/2018', '2-1/2017/MEF/AC/INF', 58, '2018-07-25', 'UPDATE', '2019-10-29 21:53:34'),
(39, 3, '01/2019', '1-1/2018/MEF/AC/INF', 38, '2019-07-01', 'UPDATE', '2019-10-29 21:53:34'),
(40, 1, '01/2018', '2-1/2017/MEF/AC/INF', 59, '2018-07-25', 'UPDATE', '2019-10-29 23:37:16'),
(41, 3, '01/2019', '1-1/2018/MEF/AC/INF', 37, '2019-07-01', 'UPDATE', '2019-10-30 13:10:21'),
(42, 3, '01/2019', '1-1/2018/MEF/AC/INF', 38, '2019-07-01', 'UPDATE', '2019-11-05 15:45:49'),
(43, 2, '01/2018', '1-1/2018/MEF/AC/INF', 11, '2018-07-25', 'UPDATE', '2019-11-05 15:45:50'),
(44, 6, '06/2019', '1-1/2018/MEF/AC/INF', 5, '2019-11-19', 'DELETE', '2019-11-19 18:17:01'),
(45, 5, '05/2019', '2-1/2017/MEF/AC/INF', 5, '2019-11-19', 'UPDATE', '2019-12-27 17:55:15'),
(46, 5, '05/2019', '2-1/2017/MEF/AC/INF', 4, '2019-11-19', 'UPDATE', '2019-12-27 18:01:34'),
(47, 5, '05/2019', '2-1/2017/MEF/AC/INF', 5, '2019-11-19', 'UPDATE', '2019-12-27 18:02:02'),
(48, 5, '05/2019', '2-1/2017/MEF/AC/INF', 6, '2019-11-19', 'UPDATE', '2019-12-27 18:02:39'),
(49, 3, '01/2019', '1-1/2018/MEF/AC/INF', 37, '2019-07-01', 'UPDATE', '2019-12-30 20:09:56'),
(50, 2, '01/2018', '1-1/2018/MEF/AC/INF', 10, '2018-07-25', 'UPDATE', '2019-12-30 20:09:56'),
(51, 1, '01/2018', '2-1/2017/MEF/AC/INF', 58, '2018-07-25', 'UPDATE', '2022-09-04 23:17:34'),
(52, 3, '01/2019', '1-1/2018/MEF/AC/INF', 36, '2019-07-01', 'UPDATE', '2022-09-04 23:17:34'),
(53, 5, '05/2019', '2-1/2017/MEF/AC/INF', 5, '2019-11-19', 'UPDATE', '2022-09-04 23:18:17'),
(54, 7, '06/2022', '2-1/2017/MEF/AC/INF', 230, '2022-09-04', 'DELETE', '2022-09-04 23:33:39');

-- --------------------------------------------------------

--
-- Structure de la table `bl_consommable`
--

CREATE TABLE `bl_consommable` (
  `id` int(10) UNSIGNED NOT NULL,
  `BL_réf` varchar(255) NOT NULL,
  `BL_ppr` varchar(255) NOT NULL,
  `BL_série` varchar(255) NOT NULL,
  `BL_date` datetime NOT NULL,
  `qte_livre` int(11) NOT NULL,
  `N_BL` int(11) NOT NULL,
  `compteur` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bl_consommable`
--

INSERT INTO `bl_consommable` (`id`, `BL_réf`, `BL_ppr`, `BL_série`, `BL_date`, `qte_livre`, `N_BL`, `compteur`) VALUES
(17, '50F0ZOO', 'DGIA2019101', '451431LM0LDY3', '2020-01-19 16:35:52', 1, 1, 300);

--
-- Déclencheurs `bl_consommable`
--
DELIMITER $$
CREATE TRIGGER `before_delete_bl_consommable` BEFORE DELETE ON `bl_consommable` FOR EACH ROW BEGIN
 INSERT INTO `bl_consommable_histo` (
  id,
  BL_réf,
  BL_ppr,
  BL_série,
  BL_date,
  qte_livre,
  N_BL,
  compteur,
  event,
  date_event
        )
    VALUES (
 
  OLD.id,
  OLD.BL_réf,
  OLD.BL_ppr,
  OLD.BL_série,
  OLD.BL_date,
  OLD.qte_livre,
  OLD.N_BL,
  OLD.compteur,
  'DELETE',
  NOW()

      );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_bl_consommable` BEFORE UPDATE ON `bl_consommable` FOR EACH ROW BEGIN
INSERT INTO `bl_consommable_histo` (
  id,
  BL_réf,
  BL_ppr,
  BL_série,
  BL_date,
  qte_livre,
  N_BL,
  compteur,
  event,
  date_event
        )
    VALUES (
 
  OLD.id,
  OLD.BL_réf,
  OLD.BL_ppr,
  OLD.BL_série,
  OLD.BL_date,
  OLD.qte_livre,
  OLD.N_BL,
  OLD.compteur,
  'UPDATE',
  NOW()

      );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `bl_consommable_histo`
--

CREATE TABLE `bl_consommable_histo` (
  `id_histo` int(10) UNSIGNED NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `BL_réf` varchar(255) NOT NULL,
  `BL_ppr` varchar(255) NOT NULL,
  `BL_série` varchar(255) NOT NULL,
  `BL_date` datetime NOT NULL,
  `qte_livre` int(11) NOT NULL,
  `N_BL` int(11) NOT NULL,
  `compteur` bigint(20) NOT NULL,
  `event` varchar(30) NOT NULL,
  `date_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bl_consommable_histo`
--

INSERT INTO `bl_consommable_histo` (`id_histo`, `id`, `BL_réf`, `BL_ppr`, `BL_série`, `BL_date`, `qte_livre`, `N_BL`, `compteur`, `event`, `date_event`) VALUES
(1, 16, '50F0ZOO', 'DGIA2019101', '451431LM0LDY3', '2019-12-27 00:00:00', 1, 1, 400, 'DELETE', '2019-12-27 17:19:07'),
(2, 18, '50F0ZOO', 'DGIA2019101', '451431LM0LDY3', '2022-09-04 23:32:59', 2, 2, 221, 'DELETE', '2022-09-04 23:33:06');

-- --------------------------------------------------------

--
-- Structure de la table `consommable`
--

CREATE TABLE `consommable` (
  `id` int(10) UNSIGNED NOT NULL,
  `réf` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `qte_min` bigint(20) NOT NULL,
  `qte_stock` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `consommable`
--

INSERT INTO `consommable` (`id`, `réf`, `marque`, `qte_min`, `qte_stock`) VALUES
(1, '56F5H00', 'MS421', 14, 18),
(2, 'NT-E460X11E', 'E460DN', 8, 12),
(3, '50F0ZOO', 'MS310', 6, 6),
(5, 'GFDSD76', 'ILY23', 10, 10);

--
-- Déclencheurs `consommable`
--
DELIMITER $$
CREATE TRIGGER `before_delete_consommable` BEFORE DELETE ON `consommable` FOR EACH ROW BEGIN
 INSERT INTO `consommable_histo` (
  id,
  réf,
  marque,
  qte_min,
  qte_stock,
  event,
  date_event
        )
    VALUES (
 
   OLD.id,
  OLD.réf,
   OLD.marque,
  OLD.qte_min,
  OLD.qte_stock,
  'DELETE',
  NOW()

      );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_consommable` BEFORE UPDATE ON `consommable` FOR EACH ROW BEGIN
 INSERT INTO `consommable_histo` (
  id,
  réf,
  marque,
  qte_min,
  qte_stock,
  event,
  date_event
        )
    VALUES (
 
   OLD.id,
  OLD.réf,
   OLD.marque,
  OLD.qte_min,
  OLD.qte_stock,
  'UPDATE',
  NOW()

      );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `consommable_histo`
--

CREATE TABLE `consommable_histo` (
  `id_histo` int(10) UNSIGNED NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `réf` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `qte_min` bigint(20) NOT NULL,
  `qte_stock` bigint(20) NOT NULL,
  `event` varchar(30) NOT NULL,
  `date_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `consommable_histo`
--

INSERT INTO `consommable_histo` (`id_histo`, `id`, `réf`, `marque`, `qte_min`, `qte_stock`, `event`, `date_event`) VALUES
(1, 3, '50F0ZOO', 'MS310', 6, 10, 'UPDATE', '2019-09-09 03:37:41'),
(2, 3, '50F0ZOO', 'MS310', 6, 9, 'UPDATE', '2019-09-09 03:53:59'),
(3, 4, 'GF54SDD', 'MFD543', 7, 12, 'DELETE', '2019-11-19 08:33:11'),
(4, 5, 'GFDSD76', 'JD543', 4, 5, 'UPDATE', '2019-11-19 09:16:17'),
(5, 5, 'GFDSD76', 'JD543', 10, 10, 'UPDATE', '2019-11-19 09:16:32'),
(6, 3, '50F0ZOO', 'MS310', 6, 8, 'UPDATE', '2019-11-19 11:47:28'),
(7, 3, '50F0ZOO', 'MS310', 6, 5, 'UPDATE', '2019-11-19 11:54:35'),
(8, 3, '50F0ZOO', 'MS310', 6, 10, 'UPDATE', '2019-11-19 11:56:29'),
(9, 3, '50F0ZOO', 'MS310', 6, 9, 'UPDATE', '2019-11-19 12:12:20'),
(10, 3, '50F0ZOO', 'MS310', 6, 12, 'UPDATE', '2019-11-19 12:12:44'),
(11, 3, '50F0ZOO', 'MS310', 6, 13, 'UPDATE', '2019-11-19 12:14:19'),
(12, 3, '50F0ZOO', 'MS310', 6, 12, 'UPDATE', '2019-11-19 13:25:41'),
(13, 3, '50F0ZOO', 'MS310', 6, 10, 'UPDATE', '2019-12-27 17:18:57'),
(14, 3, '50F0ZOO', 'MS310', 6, 9, 'UPDATE', '2020-01-19 16:35:52'),
(15, 1, '56F5H00', 'MS421', 10, 12, 'UPDATE', '2022-09-03 15:51:50'),
(16, 1, '56F5H00', 'MS421', 14, 12, 'UPDATE', '2022-09-03 15:52:06'),
(17, 3, '50F0ZOO', 'MS310', 6, 8, 'UPDATE', '2022-09-04 23:32:59'),
(18, 6, '67GH54RT', 'HP', 10, 22, 'UPDATE', '2022-09-04 23:34:27'),
(19, 6, '67GH54RT', 'HP', 10, 20, 'DELETE', '2022-09-04 23:34:33');

-- --------------------------------------------------------

--
-- Structure de la table `employé`
--

CREATE TABLE `employé` (
  `id` int(10) UNSIGNED NOT NULL,
  `chemin_image` varchar(255) DEFAULT NULL,
  `ppr` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prénom` varchar(255) NOT NULL,
  `sexe` char(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `téléphone` char(20) NOT NULL,
  `ville` int(11) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_entite` int(10) UNSIGNED NOT NULL,
  `etat` varchar(255) NOT NULL
) ;

--
-- Déchargement des données de la table `employé`
--

INSERT INTO `employé` (`id`, `chemin_image`, `ppr`, `nom`, `prénom`, `sexe`, `email`, `téléphone`, `ville`, `date_inscription`, `password`, `id_entite`, `etat`) VALUES
(69, 'Images/1662328718.png', 'DGIA2019101', 'ADMIN', 'ADMIN', 'F', 'contact@gmail.com', '+212 670143181', 2, '2019-10-18 17:38:38', '$2y$10$xphfK9V4hfu7VytIGJayxevMkS316KQbh5IwgmrOmMLiXKFWGJQQq', 1, 'admin'),
(90, 'Images/116.png', 'DGIA20191090', 'ABD SLAM', 'KJKJ', 'H', 'ilyas@gmail.com', '+212 765453423', 1, '2019-10-27 15:48:54', '$2y$10$ovkCYRM.g9Va8RovgQO/IOTVeLxiyAeasfzOPElyVyT5TLEExPhDa', 1, 'simple'),
(105, 'Images/117.png', 'DGIA201910105', 'ADKHKD', 'ADKJKD', 'H', 'contact2@gmail.com', '+212 666019059', 1, '2019-10-27 19:33:43', '$2y$10$ovkCYRM.g9Va8RovgQO/IOTVeLxiyAeasfzOPElyVyT5TLEExPhDa', 1, 'simple'),
(115, 'Images/106.jpg', 'DGIA201910106', 'SDFH', 'SDKJK', 'H', 'skdjkd@gmail.chdg', '+212 6545773', 1, '2019-10-27 21:44:27', '$2y$10$3vqFBl0KIh0Y0IK3sMb4u.McUbujKd4PV0MBCrC0uux8dKCBBC4N.', 1, 'simple');

--
-- Déclencheurs `employé`
--
DELIMITER $$
CREATE TRIGGER `before_delete_employe` BEFORE DELETE ON `employé` FOR EACH ROW BEGIN
 INSERT INTO `employé_histo` (
  id,
  chemin_image,
  ppr,
  nom,
  prénom,
  sexe,
  email,
  téléphone,
  ville,
  date_inscription,
  id_entite,
  etat,
  event,
  date_event
        )
    VALUES (
      OLD.id,
  OLD.chemin_image,
  OLD.ppr,
  OLD.nom,
  OLD.prénom,
  OLD.sexe,
  OLD.email,
  OLD.téléphone,
  OLD.ville,
  OLD.date_inscription,
  OLD.id_entite,
  OLD.etat,
  'DELETE',
  NOW()
      );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_employe` BEFORE UPDATE ON `employé` FOR EACH ROW BEGIN
 INSERT INTO `employé_histo` (
  id,
  chemin_image,
  ppr,
  nom,
  prénom,
  sexe,
  email,
  téléphone,
  ville,
  date_inscription,
  id_entite,
  etat,
  event,
  date_event
        )
    VALUES (
      OLD.id,
  OLD.chemin_image,
  OLD.ppr,
  OLD.nom,
  OLD.prénom,
  OLD.sexe,
  OLD.email,
  OLD.téléphone,
  OLD.ville,
  OLD.date_inscription,
  OLD.id_entite,
  OLD.etat,
  'UPDATE',
  NOW()


      );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `employé_histo`
--

CREATE TABLE `employé_histo` (
  `id_histo` int(10) UNSIGNED NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `chemin_image` varchar(255) DEFAULT NULL,
  `ppr` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prénom` varchar(255) NOT NULL,
  `sexe` char(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `téléphone` char(20) NOT NULL,
  `ville` int(11) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `id_entite` int(10) UNSIGNED NOT NULL,
  `etat` varchar(255) NOT NULL,
  `event` varchar(30) NOT NULL,
  `date_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employé_histo`
--

INSERT INTO `employé_histo` (`id_histo`, `id`, `chemin_image`, `ppr`, `nom`, `prénom`, `sexe`, `email`, `téléphone`, `ville`, `date_inscription`, `id_entite`, `etat`, `event`, `date_event`) VALUES
(235, 116, 'Images/116.jpg', 'DGIA201910116', 'ASDJHDS', 'DHSD', 'H', 'ilyas@hgd.dg', '+212 6554738', 2, '2019-10-27 21:46:10', 1, 'simple', 'UPDATE', '2019-11-19 22:47:40'),
(236, 105, 'Images/105.jpg', 'DGIA201910105', 'ADJHKD', 'ADKJKD', 'H', 'dshhd@hhdg.jgd', '+212 666019059', 1, '2019-10-27 19:33:43', 1, 'simple', 'UPDATE', '2019-11-19 23:16:50'),
(237, 115, 'Images/106.jpg', 'DGIA201910106', 'SDJH', 'SDKJK', 'H', 'skdjkd@gmail.chdg', '+212 6545773', 1, '2019-10-27 21:44:27', 1, 'simple', 'UPDATE', '2019-11-19 23:17:10'),
(238, 118, 'Images/117.png', 'DGIA201912117', 'ILYAS', 'KRITET', 'H', 'contact2@gmail.com', '+212 654345645', 1, '2019-12-30 20:09:46', 1, 'simple', 'DELETE', '2019-12-30 20:13:32'),
(239, 105, 'Images/105.jpg', 'DGIA201910105', 'ADKHKD', 'ADKJKD', 'H', 'dshhd@hhdg.jgd', '+212 666019059', 1, '2019-10-27 19:33:43', 1, 'simple', 'UPDATE', '2020-01-01 13:45:43'),
(240, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-01-02 23:58:29'),
(241, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-01-02 23:58:57'),
(242, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-01-02 23:58:59'),
(243, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-01-02 23:58:59'),
(244, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-01-02 23:59:00'),
(245, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-01-02 23:59:01'),
(246, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-01-02 23:59:02'),
(247, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-01-03 00:07:28'),
(248, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-01-03 00:17:25'),
(249, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-01-03 00:27:05'),
(250, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-01-03 00:31:55'),
(251, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-02-02 12:38:38'),
(252, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-02-02 12:40:18'),
(253, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-02-02 12:42:41'),
(254, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-02-02 12:45:29'),
(255, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-02-02 12:48:32'),
(256, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-02-02 12:52:16'),
(257, 69, 'Images/72.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-02-02 23:55:01'),
(258, 69, 'image-users/admin.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-02-02 23:57:46'),
(259, 69, 'image-users/admin.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-02-03 00:11:03'),
(260, 69, 'image-users/admin.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212- 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-02-03 00:11:15'),
(261, 69, 'image-users/admin.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-02-03 00:11:34'),
(262, 69, 'image-users/admin.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2020-02-03 22:29:58'),
(263, 105, 'Images/105.jpg', 'DGIA201910105', 'ADKHKD', 'ADKJKD', 'H', 'contact2@gmail.com', '+212 666019059', 1, '2019-10-27 19:33:43', 1, 'simple', 'UPDATE', '2022-01-25 18:50:42'),
(264, 69, 'image-users/admin.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-07-30 15:13:12'),
(265, 90, 'Images/90.jpg', 'DGIA20191090', 'ABD SLAM', 'KJKJ', 'H', 'ilyas@gmail.com', '+212 765453423', 1, '2019-10-27 15:48:54', 1, 'simple', 'UPDATE', '2022-07-30 15:34:14'),
(266, 105, 'Images/105.jpg', 'DGIA201910105', 'ADKHKD', 'ADKJKD', 'H', 'contact2@gmail.com', '+212 666019059', 1, '2019-10-27 19:33:43', 1, 'simple', 'UPDATE', '2022-08-31 12:55:40'),
(267, 69, 'image-users/admin.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-02 21:13:12'),
(268, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-02 21:13:12'),
(269, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-02 23:45:14'),
(270, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-02 23:45:14'),
(271, 105, 'Images/105.jpg', 'DGIA201910105', 'ADKHKD', 'ADKJKD', 'H', 'contact2@gmail.com', '+212 666019059', 1, '2019-10-27 19:33:43', 1, 'simple', 'UPDATE', '2022-09-02 23:55:27'),
(272, 105, 'Images/117.png', 'DGIA201910105', 'ADKHKD', 'ADKJKD', 'H', 'contact2@gmail.com', '+212 666019059', 1, '2019-10-27 19:33:43', 1, 'simple', 'UPDATE', '2022-09-02 23:55:27'),
(273, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 00:22:30'),
(274, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 00:22:30'),
(275, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 00:23:15'),
(276, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 00:23:15'),
(277, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 00:23:46'),
(278, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'F', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 11:57:27'),
(279, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'F', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 11:57:28'),
(280, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'F', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:02:28'),
(281, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'F', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:02:28'),
(282, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'F', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:03:23'),
(283, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:04:49'),
(284, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:04:50'),
(285, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:05:51'),
(286, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:06:29'),
(287, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:06:29'),
(288, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:07:48'),
(289, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:07:48'),
(290, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:09:29'),
(291, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:09:29'),
(292, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:09:55'),
(293, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:09:55'),
(294, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:11:55'),
(295, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:11:55'),
(296, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:12:55'),
(297, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:12:55'),
(298, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:13:12'),
(299, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:13:12'),
(300, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:15:16'),
(301, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:15:16'),
(302, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:16:06'),
(303, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:16:06'),
(304, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:21:29'),
(305, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:21:29'),
(306, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:22:18'),
(307, 69, 'Images/117.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:22:18'),
(308, 69, 'Images/117.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:24:18'),
(309, 69, 'Images/117.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:24:18'),
(310, 69, 'Images/117.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:27:10'),
(311, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:27:11'),
(312, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:27:33'),
(313, 69, 'Images/117.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:27:33'),
(314, 69, 'Images/117.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:27:46'),
(315, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:27:46'),
(316, 69, 'Images/117.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:29:00'),
(317, 69, 'Images/117.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:29:00'),
(318, 69, 'Images/117.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:33:43'),
(319, 69, 'Images/1662204823.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:33:43'),
(320, 69, 'Images/1662204823.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:34:47'),
(321, 69, 'Images/1662204887.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:34:47'),
(322, 69, 'Images/1662204887.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:40:21'),
(323, 69, 'Images/1662205221.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:40:21'),
(324, 69, 'Images/1662205221.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:40:40'),
(325, 69, 'Images/1662205240.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:40:40'),
(326, 69, 'Images/1662205240.jpg', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:45:18'),
(327, 69, 'Images/1662205518.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:45:18'),
(328, 69, 'Images/1662205518.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:45:32'),
(329, 69, 'Images/1662205532.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:45:32'),
(330, 69, 'Images/1662205532.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:45:54'),
(331, 69, 'Images/1662205554.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 12:45:54'),
(332, 69, 'Images/1662205554.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 16:09:21'),
(333, 69, 'Images/1662217761.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 16:09:21'),
(334, 69, 'Images/1662217761.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 16:48:03'),
(335, 69, 'Images/1662220083.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-03 16:48:04'),
(336, 69, 'Images/1662220083.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 16:16:45'),
(337, 69, 'Images/1662220083.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 20:54:23'),
(338, 69, 'Images/1662220083.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'F', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 20:54:42'),
(339, 69, 'Images/1662321282.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'F', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 20:54:42'),
(340, 69, 'Images/1662321282.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 20:57:08'),
(341, 69, './../Images/1662321428.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 20:57:08'),
(342, 69, './../Images/1662321428.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 20:58:47'),
(343, 69, 'Images/1662321527.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 20:58:47'),
(344, 69, 'Images/1662321527.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 20:59:42'),
(345, 69, 'Images/1662321582.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 20:59:42'),
(346, 69, 'Images/1662321582.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 21:01:01'),
(347, 69, 'Images/1662321661.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 21:01:01'),
(348, 69, 'Images/1662321661.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 21:04:35'),
(349, 69, 'Images/1662321661.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 22:05:28'),
(350, 69, 'Images/1662325528.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 22:05:28'),
(351, 69, 'Images/1662325528.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'H', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 22:05:36'),
(352, 69, 'Images/1662325528.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'F', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 22:58:38'),
(353, 69, 'Images/1662328718.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'F', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 22:58:38'),
(354, 69, 'Images/1662328718.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'F', 'contact@gmail.com', '+212 670143181', 1, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 22:58:50'),
(355, 69, 'Images/1662328718.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'F', 'contact@gmail.com', '+212 670143181', 2, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 23:02:56'),
(356, 116, 'Images/116.jpg', 'DGIA201910116', 'ASDJHDS', 'DHS', 'H', 'ilyas@hgd.dg', '+212 6554738', 2, '2019-10-27 21:46:10', 1, 'simple', 'DELETE', '2022-09-04 23:11:15'),
(357, 90, 'Images/90.jpg', 'DGIA20191090', 'ABD SLAM', 'KJKJ', 'H', 'ilyas@gmail.com', '+212 765453423', 1, '2019-10-27 15:48:54', 1, 'simple', 'UPDATE', '2022-09-04 23:17:07'),
(358, 90, 'Images/116.png', 'DGIA20191090', 'ABD SLAM', 'KJKJ', 'H', 'ilyas@gmail.com', '+212 765453423', 1, '2019-10-27 15:48:54', 1, 'simple', 'UPDATE', '2022-09-04 23:17:07'),
(359, 69, 'Images/1662328718.png', 'DGIA2019101', 'ILYAS', 'KRITET', 'F', 'contact@gmail.com', '+212 670143181', 2, '2019-10-18 17:38:38', 1, 'admin', 'UPDATE', '2022-09-04 23:38:30');

-- --------------------------------------------------------

--
-- Structure de la table `employé_matériel`
--

CREATE TABLE `employé_matériel` (
  `EM_ppr` varchar(255) NOT NULL,
  `EM_Série` varchar(255) NOT NULL,
  `date_activation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employé_matériel`
--

INSERT INTO `employé_matériel` (`EM_ppr`, `EM_Série`, `date_activation`) VALUES
('DGIA2019101', '451431LM0LDY3', '2019-10-18 17:38:58'),
('DGIA2019101', '4JHY35J', '2019-10-18 17:38:58'),
('DGIA201910105', 'CZC2071FRP', '2022-09-04 23:17:34'),
('DGIA201910106', '45K4HLDXVG', '2022-09-04 23:18:17');

--
-- Déclencheurs `employé_matériel`
--
DELIMITER $$
CREATE TRIGGER `before_delete_employé_matériel` BEFORE DELETE ON `employé_matériel` FOR EACH ROW BEGIN
 INSERT INTO `employé_matériel_histo` (
  EM_ppr,
  EM_Série,
  date_activation,
  event,
  date_event
        )
    VALUES (
 
    OLD.EM_ppr,
  OLD.EM_Série,
  OLD.date_activation,
  'DELETE',
  NOW()

      );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_employé_matériel` BEFORE UPDATE ON `employé_matériel` FOR EACH ROW BEGIN
INSERT INTO `employé_matériel_histo` (
  EM_ppr,
  EM_Série,
  date_activation,
  event,
  date_event
        )
    VALUES (
 
    OLD.EM_ppr,
  OLD.EM_Série,
  OLD.date_activation,
  'UPDATE',
  NOW()

      );
 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `employé_matériel_histo`
--

CREATE TABLE `employé_matériel_histo` (
  `id_histo` int(10) UNSIGNED NOT NULL,
  `EM_ppr` varchar(255) NOT NULL,
  `EM_Série` varchar(255) NOT NULL,
  `date_activation` date NOT NULL,
  `event` varchar(30) NOT NULL,
  `date_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employé_matériel_histo`
--

INSERT INTO `employé_matériel_histo` (`id_histo`, `EM_ppr`, `EM_Série`, `date_activation`, `event`, `date_event`) VALUES
(7, 'DGIA20191090', '3KHY35J', '2019-10-28', 'UPDATE', '2019-10-29 21:53:34'),
(8, 'DGIA201910106', '451431LM0LDY3', '2019-10-28', 'DELETE', '2019-10-30 13:10:08'),
(9, 'DGIA20191090', 'CZC2071FRP', '2019-10-29', 'DELETE', '2019-10-30 13:10:21'),
(10, 'DGIA201910106', 'PTCI2YRTEB', '2019-12-27', 'DELETE', '2019-12-27 18:01:34'),
(11, 'DGIA201910105', '3KHY35J', '2019-10-29', 'UPDATE', '2022-09-04 23:17:34');

-- --------------------------------------------------------

--
-- Structure de la table `entité`
--

CREATE TABLE `entité` (
  `id` int(10) UNSIGNED NOT NULL,
  `abr` char(10) DEFAULT NULL,
  `libellé` varchar(255) NOT NULL,
  `ville` int(255) NOT NULL,
  `entité_racine` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entité`
--

INSERT INTO `entité` (`id`, `abr`, `libellé`, `ville`, `entité_racine`) VALUES
(1, 'THA', 'ilyas', 2, 31),
(31, 'DGI', 'Diréction générae', 1, NULL);

--
-- Déclencheurs `entité`
--
DELIMITER $$
CREATE TRIGGER `before_delete_entité` BEFORE DELETE ON `entité` FOR EACH ROW BEGIN
 INSERT INTO `entité_histo` (
  id,
  abr,
  libellé,
  ville,
  entité_racine,
  event,
  date_event
        )
    VALUES (
 
   OLD.id,
   OLD.abr,
   OLD.libellé,
   OLD.ville,
   OLD.entité_racine,
   'DELETE',
   NOW()

      );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_entité` BEFORE UPDATE ON `entité` FOR EACH ROW BEGIN
 INSERT INTO `entité_histo` (
   id,
  abr,
  libellé,
  ville,
  entité_racine,
  event,
  date_event
        )
    VALUES (
    OLD.id,
   OLD.abr,
   OLD.libellé,
   OLD.ville,
   OLD.entité_racine,
   'UPDATE',
   NOW()
      );
 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `entité_histo`
--

CREATE TABLE `entité_histo` (
  `id_histo` int(10) UNSIGNED NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `abr` char(10) DEFAULT NULL,
  `libellé` varchar(255) NOT NULL,
  `ville` int(255) NOT NULL,
  `entité_racine` int(10) UNSIGNED DEFAULT NULL,
  `event` varchar(30) NOT NULL,
  `date_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entité_histo`
--

INSERT INTO `entité_histo` (`id_histo`, `id`, `abr`, `libellé`, `ville`, `entité_racine`, `event`, `date_event`) VALUES
(1, 31, 'DGI', 'Diréction générae', 1, NULL, 'UPDATE', '2019-12-27 18:22:33'),
(2, 31, 'DGI', 'Diréction générae', 1, 1, 'UPDATE', '2019-12-27 18:32:53'),
(6, 39, 'OGH', 'sara', 2, 31, 'DELETE', '2022-09-04 23:13:47'),
(7, 1, 'THA', 'ilyas', 2, 31, 'UPDATE', '2022-09-04 23:14:58'),
(8, 1, 'THA', 'ilyask', 2, 31, 'UPDATE', '2022-09-04 23:15:01'),
(9, 1, 'THA', 'ilyask', 2, 31, 'UPDATE', '2022-09-04 23:16:02'),
(10, 40, 'OGH', 'sara', 2, 0, 'UPDATE', '2022-09-04 23:19:57'),
(11, 40, 'OGH', 'sara', 1, 0, 'UPDATE', '2022-09-04 23:25:37'),
(12, 40, 'OGH', 'sara', 1, 0, 'UPDATE', '2022-09-04 23:25:51'),
(13, 40, 'OGH', 'sara', 2, 0, 'DELETE', '2022-09-04 23:25:59'),
(14, 41, 'GHR', 'sara', 1, 1, 'DELETE', '2022-09-04 23:26:43'),
(15, 42, 'GHR', 'ILYAS', 1, 1, 'UPDATE', '2022-09-04 23:30:12'),
(16, 42, 'GHR', 'ILYAS', 2, 1, 'UPDATE', '2022-09-04 23:31:00'),
(17, 42, 'GHR', 'ILYAS', 2, 1, 'UPDATE', '2022-09-04 23:31:12'),
(18, 42, 'GHR', 'ILYAS', 1, 1, 'DELETE', '2022-09-04 23:31:17');

-- --------------------------------------------------------

--
-- Structure de la table `forget_password`
--

CREATE TABLE `forget_password` (
  `id` int(11) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `forget_password`
--

INSERT INTO `forget_password` (`id`, `Email`, `code`) VALUES
(5, 'contact@gmail.com', '$2y$10$IU7LbrAVe.bp4amDfnzzjuYIP7TjhWaU7QLsVvTjAVgFN3sDHWq0S'),
(8, 'ilyas@gmail.com', '$2y$10$NCJxVFuatQPsirSgwJaMC.x9Uqp.0Ca3xyEbFg6OMDamzGPoAQKQO'),
(9, 'contact2@gmail.com', '$2y$10$YUuCASIOewIszvlBMXPLw.AAMiIvrKIPo9fOzD1/bVgabhGAE98tG');

-- --------------------------------------------------------

--
-- Structure de la table `marché`
--

CREATE TABLE `marché` (
  `numéro_marché` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL
) ;

--
-- Déchargement des données de la table `marché`
--

INSERT INTO `marché` (`numéro_marché`, `type`, `description`) VALUES
('1-1/2018/MEF/AC/INF', 'IMP', 'Imp Lexmark Ms 421dn'),
('2-1/2017/MEF/AC/INF', 'PC', 'HP ProDesk 400 G4');

--
-- Déclencheurs `marché`
--
DELIMITER $$
CREATE TRIGGER `before_delete_marché` BEFORE DELETE ON `marché` FOR EACH ROW BEGIN
 INSERT INTO `marché_histo` (
  numéro_marché,
  type,
  description,
  event,
  date_event
        )
    VALUES (
 
   OLD.numéro_marché,
   OLD.type,
   OLD.description,
   'DELETE',
   NOW()

      );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_marché` BEFORE UPDATE ON `marché` FOR EACH ROW BEGIN
 INSERT INTO `marché_histo` (
  numéro_marché,
  type,
  description,
  event,
  date_event
        )
    VALUES (
   OLD.numéro_marché,
   OLD.type,
   OLD.description,
   'UPDATE',
   NOW()
      );
 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `marché_histo`
--

CREATE TABLE `marché_histo` (
  `id_histo` int(10) UNSIGNED NOT NULL,
  `numéro_marché` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `event` varchar(30) NOT NULL,
  `date_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `marché_histo`
--

INSERT INTO `marché_histo` (`id_histo`, `numéro_marché`, `type`, `description`, `event`, `date_event`) VALUES
(1, '543/HGT34/HDGD', 'PC', 'PC DELL VOSTRO ', 'DELETE', '2019-10-30 22:55:53'),
(2, '2-2019/987/FGD/HGS', 'PC', 'PC hp DELL vosto', 'DELETE', '2019-10-30 23:31:40'),
(3, '3-2017/GDF/GHG/HG', 'IMP', 'DELL VOSTRO ', 'UPDATE', '2019-10-30 23:57:07'),
(4, '3-2017/GDF/GHG/HG', 'IMP', 'DELL ', 'UPDATE', '2019-10-30 23:57:15'),
(5, '4-2018/23/HDG/DHG', 'PC', 'LEXMARK ', 'DELETE', '2019-10-30 23:58:00'),
(6, '3-2017/GDF/GHG/HG', 'PC', 'DELL ', 'DELETE', '2019-10-30 23:58:25'),
(7, 'ASASC', 'PC', 'ascascasc', 'DELETE', '2022-07-30 15:16:51'),
(8, 'RGFRG8975', 'PC', 'PC and laptops', 'UPDATE', '2022-09-04 23:31:35'),
(9, 'RGFRG8975', 'IMP', 'PC and laptops', 'DELETE', '2022-09-04 23:31:46'),
(10, '1-2/2022/MEF/AC', 'PC', 'HP laptops and webcams', 'DELETE', '2022-09-04 23:32:34');

-- --------------------------------------------------------

--
-- Structure de la table `matériels`
--

CREATE TABLE `matériels` (
  `id` int(10) UNSIGNED NOT NULL,
  `N_Série` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `id_arrivage` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `matériels`
--

INSERT INTO `matériels` (`id`, `N_Série`, `marque`, `type`, `etat`, `id_arrivage`) VALUES
(1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'EN STOCK', 2),
(2, '451431LM0LDY3', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2),
(3, '451431LM0LGPG', 'LexMark MS310d', 'IMP', 'EN STOCK', 4),
(4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1),
(5, '4JHY35J', 'Dell Vostro V260', 'PC', 'NON RéFORME', 1),
(6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'NON RéFORME', 3),
(7, '2H8EX7NXNC', 'HP ProDesk 400 G4', 'PC', 'EN STOCK', 5),
(8, 'PTCI2YRTEB', 'HP ProDesk 400 G4', 'PC', 'EN STOCK', 5),
(9, 'Y2ASHUMG34', 'HP ProDesk 400 G4', 'PC', 'EN STOCK', 5),
(10, 'ESTEEX22ZC', 'HP ProDesk 400 G4', 'PC', 'EN STOCK', 5),
(11, '45K4HLDXVG', 'HP ProDesk 400 G4', 'PC', 'NON RéFORME', 5);

--
-- Déclencheurs `matériels`
--
DELIMITER $$
CREATE TRIGGER `before_delete_matériels` BEFORE DELETE ON `matériels` FOR EACH ROW BEGIN
 INSERT INTO `matériels_histo` (
   id,
   N_Série,
   marque,
   type,
   etat,
   id_arrivage,
   event,
   date_event
        )
    VALUES (
   OLD.id,
   OLD.N_Série,
   OLD.marque,
   OLD.type,
   OLD.etat,
   OLD.id_arrivage,
   'DELETE',
   NOW()
      );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_matériels` BEFORE UPDATE ON `matériels` FOR EACH ROW BEGIN
 INSERT INTO `matériels_histo` (
   id,
   N_Série,
   marque,
   type,
   etat,
   id_arrivage,
   event,
   date_event
        )
    VALUES (
   OLD.id,
   OLD.N_Série,
   OLD.marque,
   OLD.type,
   OLD.etat,
   OLD.id_arrivage,
   'UPDATE',
   NOW()
      );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `matériels_histo`
--

CREATE TABLE `matériels_histo` (
  `id_histo` int(10) UNSIGNED NOT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `N_Série` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `id_arrivage` int(10) UNSIGNED NOT NULL,
  `event` varchar(30) NOT NULL,
  `date_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `matériels_histo`
--

INSERT INTO `matériels_histo` (`id_histo`, `id`, `N_Série`, `marque`, `type`, `etat`, `id_arrivage`, `event`, `date_event`) VALUES
(26, 5, '4JHY35J', 'Dell Vostro V260', 'PC', 'NON RéFORME', 1, 'UPDATE', '2019-09-09 03:19:06'),
(27, 6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'NON RéFORME', 3, 'UPDATE', '2019-09-09 03:20:31'),
(28, 2, '451431LM0LDY3', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2, 'UPDATE', '2019-09-09 03:20:31'),
(29, 5, '4JHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-08 09:22:57'),
(30, 3, '451431LM0LGPG', 'LexMark MS310d', 'IMP', 'EN STOCK', 4, 'UPDATE', '2019-10-08 09:22:57'),
(31, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2, 'UPDATE', '2019-10-08 15:08:05'),
(32, 2, '451431LM0LDY3', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2, 'UPDATE', '2019-10-08 15:08:12'),
(33, 3, '451431LM0LGPG', 'LexMark MS310d', 'IMP', 'NON RéFORME', 4, 'UPDATE', '2019-10-08 15:08:18'),
(34, 5, '4JHY35J', 'Dell Vostro V260', 'PC', 'NON RéFORME', 1, 'UPDATE', '2019-10-08 15:08:24'),
(35, 6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'NON RéFORME', 3, 'UPDATE', '2019-10-08 15:08:30'),
(36, 5, '4JHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-08 15:10:49'),
(37, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'EN STOCK', 2, 'UPDATE', '2019-10-08 15:10:49'),
(38, 6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'EN STOCK', 3, 'UPDATE', '2019-10-08 19:31:34'),
(39, 2, '451431LM0LDY3', 'Lexmark MS310d', 'IMP', 'EN STOCK', 2, 'UPDATE', '2019-10-08 19:31:34'),
(40, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'NON RéFORME', 1, 'UPDATE', '2019-10-08 19:33:40'),
(41, 5, '4JHY35J', 'Dell Vostro V260', 'PC', 'NON RéFORME', 1, 'UPDATE', '2019-10-08 19:33:47'),
(42, 6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'NON RéFORME', 3, 'UPDATE', '2019-10-08 19:33:52'),
(43, 2, '451431LM0LDY3', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2, 'UPDATE', '2019-10-08 19:33:57'),
(44, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2, 'UPDATE', '2019-10-08 19:34:02'),
(45, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-08 19:50:27'),
(46, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'EN STOCK', 2, 'UPDATE', '2019-10-08 19:50:27'),
(47, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'NON RéFORME', 1, 'UPDATE', '2019-10-08 20:09:12'),
(48, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2, 'UPDATE', '2019-10-08 20:09:12'),
(49, 5, '4JHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-09 16:28:27'),
(50, 5, '4JHY35J', 'Dell Vostro V260', 'PC', 'NON RéFORME', 1, 'UPDATE', '2019-10-09 22:25:57'),
(51, 5, '4JHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-18 17:38:58'),
(52, 2, '451431LM0LDY3', 'Lexmark MS310d', 'IMP', 'EN STOCK', 2, 'UPDATE', '2019-10-18 17:38:58'),
(53, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:02'),
(54, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:04'),
(55, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:05'),
(56, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:06'),
(57, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:06'),
(58, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:06'),
(59, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:07'),
(60, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:07'),
(61, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:07'),
(62, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:08'),
(63, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:08'),
(64, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:08'),
(65, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:09'),
(66, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:11'),
(67, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:12'),
(68, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:12'),
(69, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:13'),
(70, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:13'),
(71, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:13'),
(72, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:14'),
(73, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:14'),
(74, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:14'),
(75, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:14'),
(76, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:14'),
(77, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:14'),
(78, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:14'),
(79, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:14'),
(80, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:14'),
(81, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:16'),
(82, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:17'),
(83, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:18'),
(84, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:19'),
(85, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:19'),
(86, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:19'),
(87, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:20'),
(88, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:21'),
(89, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:21'),
(90, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-20 12:08:21'),
(91, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'EN STOCK', 2, 'UPDATE', '2019-10-20 12:14:21'),
(92, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'EN STOCK', 2, 'UPDATE', '2019-10-20 12:14:24'),
(93, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-21 17:30:36'),
(94, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'EN STOCK', 2, 'UPDATE', '2019-10-21 17:30:36'),
(95, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'NON RéFORME', 1, 'UPDATE', '2019-10-21 17:34:51'),
(96, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2, 'UPDATE', '2019-10-21 17:34:51'),
(97, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-22 02:03:38'),
(98, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'EN STOCK', 2, 'UPDATE', '2019-10-22 02:03:38'),
(99, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'NON RéFORME', 1, 'UPDATE', '2019-10-22 02:04:19'),
(100, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2, 'UPDATE', '2019-10-22 02:04:19'),
(101, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-27 13:24:02'),
(102, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'EN STOCK', 2, 'UPDATE', '2019-10-27 13:24:02'),
(103, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'NON RéFORME', 1, 'UPDATE', '2019-10-27 15:22:25'),
(104, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2, 'UPDATE', '2019-10-27 15:22:25'),
(105, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-28 20:59:30'),
(106, 2, '451431LM0LDY3', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2, 'UPDATE', '2019-10-28 21:00:27'),
(107, 6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'EN STOCK', 3, 'UPDATE', '2019-10-29 21:42:00'),
(108, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'NON RéFORME', 1, 'UPDATE', '2019-10-29 21:53:34'),
(109, 6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'EN STOCK', 3, 'UPDATE', '2019-10-29 21:53:34'),
(110, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'EN STOCK', 1, 'UPDATE', '2019-10-29 23:37:16'),
(111, 6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'NON RéFORME', 3, 'UPDATE', '2019-10-30 13:10:21'),
(112, 6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'EN STOCK', 3, 'UPDATE', '2019-11-05 15:45:49'),
(113, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'EN STOCK', 2, 'UPDATE', '2019-11-05 15:45:50'),
(114, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2, 'UPDATE', '2019-11-05 15:46:09'),
(115, 6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'NON RéFORME', 3, 'UPDATE', '2019-11-05 15:46:09'),
(116, 8, 'PTCI2YRTEB', 'HP ProDesk 400 G4', 'PC', 'EN STOCK', 5, 'UPDATE', '2019-12-27 17:55:15'),
(117, 8, 'PTCI2YRTEB', 'HP ProDesk 400 G4', 'PC', 'NON RéFORME', 5, 'UPDATE', '2019-12-27 18:01:34'),
(118, 6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'EN STOCK', 3, 'UPDATE', '2019-12-30 20:09:56'),
(119, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'EN STOCK', 2, 'UPDATE', '2019-12-30 20:09:56'),
(120, 1, '451431LM0LGML', 'Lexmark MS310d', 'IMP', 'NON RéFORME', 2, 'UPDATE', '2019-12-30 20:13:32'),
(121, 6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'NON RéFORME', 3, 'UPDATE', '2019-12-30 20:13:32'),
(122, 4, '3KHY35J', 'Dell Vostro V260', 'PC', 'NON RéFORME', 1, 'UPDATE', '2022-09-04 23:17:34'),
(123, 6, 'CZC2071FRP', 'HP 6200 PRO ', 'PC ', 'EN STOCK', 3, 'UPDATE', '2022-09-04 23:17:34'),
(124, 11, '45K4HLDXVG', 'HP ProDesk 400 G4', 'PC', 'EN STOCK', 5, 'UPDATE', '2022-09-04 23:18:17');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id` int(11) NOT NULL,
  `ville` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `ville`) VALUES
(1, 'Agadir'),
(2, 'Rabat');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `arrivage_marché`
--
ALTER TABLE `arrivage_marché`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `AM_arrivage_marche` (`AM_arrivage`,`AM_marché`),
  ADD KEY `FK_AM_marché` (`AM_marché`);

--
-- Index pour la table `arrivage_marché_histo`
--
ALTER TABLE `arrivage_marché_histo`
  ADD PRIMARY KEY (`id_histo`);

--
-- Index pour la table `bl_consommable`
--
ALTER TABLE `bl_consommable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_BL_réf` (`BL_réf`),
  ADD KEY `FK_BL_série` (`BL_série`),
  ADD KEY `FK_BL_ppr` (`BL_ppr`);

--
-- Index pour la table `bl_consommable_histo`
--
ALTER TABLE `bl_consommable_histo`
  ADD PRIMARY KEY (`id_histo`);

--
-- Index pour la table `consommable`
--
ALTER TABLE `consommable`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `réf` (`réf`);

--
-- Index pour la table `consommable_histo`
--
ALTER TABLE `consommable_histo`
  ADD PRIMARY KEY (`id_histo`);

--
-- Index pour la table `employé`
--
ALTER TABLE `employé`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ppr` (`ppr`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_id_entite` (`id_entite`),
  ADD KEY `fk_ville` (`ville`);

--
-- Index pour la table `employé_histo`
--
ALTER TABLE `employé_histo`
  ADD PRIMARY KEY (`id_histo`);

--
-- Index pour la table `employé_matériel`
--
ALTER TABLE `employé_matériel`
  ADD PRIMARY KEY (`EM_ppr`,`EM_Série`),
  ADD KEY `FK_EM_Série` (`EM_Série`);

--
-- Index pour la table `employé_matériel_histo`
--
ALTER TABLE `employé_matériel_histo`
  ADD PRIMARY KEY (`id_histo`);

--
-- Index pour la table `entité`
--
ALTER TABLE `entité`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entité_histo`
--
ALTER TABLE `entité_histo`
  ADD PRIMARY KEY (`id_histo`);

--
-- Index pour la table `forget_password`
--
ALTER TABLE `forget_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_email_code` (`Email`);

--
-- Index pour la table `marché`
--
ALTER TABLE `marché`
  ADD PRIMARY KEY (`numéro_marché`);

--
-- Index pour la table `marché_histo`
--
ALTER TABLE `marché_histo`
  ADD PRIMARY KEY (`id_histo`);

--
-- Index pour la table `matériels`
--
ALTER TABLE `matériels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `N_Série` (`N_Série`),
  ADD KEY `FK_id_arrivage` (`id_arrivage`);

--
-- Index pour la table `matériels_histo`
--
ALTER TABLE `matériels_histo`
  ADD PRIMARY KEY (`id_histo`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `arrivage_marché`
--
ALTER TABLE `arrivage_marché`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `arrivage_marché_histo`
--
ALTER TABLE `arrivage_marché_histo`
  MODIFY `id_histo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `bl_consommable`
--
ALTER TABLE `bl_consommable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `bl_consommable_histo`
--
ALTER TABLE `bl_consommable_histo`
  MODIFY `id_histo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `consommable`
--
ALTER TABLE `consommable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `consommable_histo`
--
ALTER TABLE `consommable_histo`
  MODIFY `id_histo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `employé`
--
ALTER TABLE `employé`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `employé_histo`
--
ALTER TABLE `employé_histo`
  MODIFY `id_histo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT pour la table `employé_matériel_histo`
--
ALTER TABLE `employé_matériel_histo`
  MODIFY `id_histo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `entité`
--
ALTER TABLE `entité`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `entité_histo`
--
ALTER TABLE `entité_histo`
  MODIFY `id_histo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `forget_password`
--
ALTER TABLE `forget_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `marché_histo`
--
ALTER TABLE `marché_histo`
  MODIFY `id_histo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `matériels`
--
ALTER TABLE `matériels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT pour la table `matériels_histo`
--
ALTER TABLE `matériels_histo`
  MODIFY `id_histo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `arrivage_marché`
--
ALTER TABLE `arrivage_marché`
  ADD CONSTRAINT `FK_AM_marché` FOREIGN KEY (`AM_marché`) REFERENCES `marché` (`numéro_marché`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `bl_consommable`
--
ALTER TABLE `bl_consommable`
  ADD CONSTRAINT `FK_BL_ppr` FOREIGN KEY (`BL_ppr`) REFERENCES `employé` (`ppr`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_BL_réf` FOREIGN KEY (`BL_réf`) REFERENCES `consommable` (`réf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_BL_série` FOREIGN KEY (`BL_série`) REFERENCES `matériels` (`N_Série`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `employé`
--
ALTER TABLE `employé`
  ADD CONSTRAINT `fk_id_entite` FOREIGN KEY (`id_entite`) REFERENCES `entité` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ville` FOREIGN KEY (`ville`) REFERENCES `ville` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `employé_matériel`
--
ALTER TABLE `employé_matériel`
  ADD CONSTRAINT `FK_EM_Série` FOREIGN KEY (`EM_Série`) REFERENCES `matériels` (`N_Série`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EM_ppr` FOREIGN KEY (`EM_ppr`) REFERENCES `employé` (`ppr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `forget_password`
--
ALTER TABLE `forget_password`
  ADD CONSTRAINT `fk_email_code` FOREIGN KEY (`Email`) REFERENCES `employé` (`email`);

--
-- Contraintes pour la table `matériels`
--
ALTER TABLE `matériels`
  ADD CONSTRAINT `FK_id_arrivage` FOREIGN KEY (`id_arrivage`) REFERENCES `arrivage_marché` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
