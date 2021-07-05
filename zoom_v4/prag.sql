-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 05 juil. 2021 à 18:06
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `prag`
--

-- --------------------------------------------------------

--
-- Structure de la table `creation`
--

CREATE TABLE `creation` (
  `register_user_id` int(11) NOT NULL,
  `reunion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `creation`
--

INSERT INTO `creation` (`register_user_id`, `reunion_id`) VALUES
(48, 16),
(48, 17),
(48, 18),
(48, 18),
(48, 18),
(48, 18),
(48, 19),
(48, 20),
(48, 21),
(48, 22);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `register_user_id` int(11) NOT NULL,
  `reunion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`register_user_id`, `reunion_id`) VALUES
(49, 17),
(49, 13),
(49, 20),
(49, 19),
(50, 20);

-- --------------------------------------------------------

--
-- Structure de la table `register_user`
--

CREATE TABLE `register_user` (
  `register_user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_activation_code` varchar(250) NOT NULL,
  `user_email_status` enum('not verified','verified') NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `register_user`
--

INSERT INTO `register_user` (`register_user_id`, `user_name`, `user_email`, `user_password`, `user_activation_code`, `user_email_status`, `role`) VALUES
(1, 'John Smith', 'web-tutorial@programmer.net', '$2y$10$vdMwAmoRJfep8Vl4BI0QDOXArOCTOMbFs6Ja15qq3NEkPUBBtffD2', 'c74c4bf0dad9cbae3d80faa054b7d8ca', 'verified', NULL),
(2, 'azeazea', 'qsdqdqdq@gmail.com', '$2y$10$3aj4VZvPBjfeLHTIE7Q8buDMlRSHBawAeEdnNocmauCBKLRat.Hcq', '398dfdeb1507e2dd3b4313652e5d8b7b', 'not verified', NULL),
(20, 'kifgjlfjg', 'jon@gmail.com', '$2y$10$lcOofpUBiZn2LJlzVCv8MeAuDMrBDpzzn4vJUjTQ6hK8a7m.P5Hk2', '402e8c3db7ec8062b04bb6ebf793abfa', 'not verified', NULL),
(21, 'hjfbfchfhf', 'jfogdfgd@gmail.com', '$2y$10$TO4/BPMvwR/jjGRsqtc0z.uUxHWECNsabgu1nQulNFE1u7cI5LUhO', '356f68badce2f13551fd0e8025ad4200', 'verified', NULL),
(22, 'hgkhkgk', 'ipioopdf@gmail.com', '$2y$10$L9HfhLeewvpaVgHTk9od9.vHJTnECblkWAozNEUOdVTERMZ0wTAry', 'a1cc96ae886d83e646db6e6a7bb4c9b5', 'verified', NULL),
(23, 'pofgpo', 'pofidpofd@gmail.com', '$2y$10$ti2ri3JvcL4YrPJh30Zj6e8vNyyEDa.VQkiSuuSC2fD0Bf8E.Bea2', '030c6a7a7e13bae60f8512b6067df614', 'not verified', NULL),
(24, 'oifdpofd', 'pppdosds@gmail.com', '$2y$10$ZxV8CtSFGMgUp5Tu8a.Yoeg9sfftEuamjDM7.3dyVgMK50eOIlsUG', 'fa749fd8d332d6c9b090b05bdfebbbe1', 'verified', NULL),
(39, 'ihsane', 'ihsane.khouani95@gmail.com', '$2y$10$ZA30Bv38K3wngQSo89HspOgeiXlAZ8pEi3dvCmugcs99g3r6CNEPO', '3a2a982903e09ebfd61c3ebe134eaa50', 'not verified', NULL),
(40, 'sqdqsdqs', 'qsqqd@gmail.com', '$2y$10$KSZSz21Q2kuqQCB8SeObX.D0LVl4H2N0GXvDCfdeAYpPtDabU0vMG', '706a323487f5c091db9e6290f68999e0', 'not verified', NULL),
(41, 'qsdqdqs', 'qsdqdqsdq@gmail.com', '$2y$10$vpT5bko72dQk9o63eFgu..ffExHC54gBdNHUNs6sCIrY2ShrG5l0u', '372dc23d1417b83678b4490e6d8c5fa7', 'not verified', NULL),
(42, 'sqdfqsfqsfq', 'qsdqsdqsdq@gmail.com', '$2y$10$KM1Rh8FJQXM0eRQW4Zc8Ze8oQfCh0HwILAi5VjHhGhVC8drYv2KhS', '46f24ef5a4688c37bd51ee17eb59810f', 'not verified', NULL),
(43, 'qsdqsdqsdq', 'qsdqdqsdqsdqs@gmail.com', '$2y$10$T9aT5bgXOXE4oSPfhASLmuVRqsiJEzXw5qn2T3MEQhLL2d38Xfr5u', '84e141af766760a66459ec79e2f23872', 'not verified', NULL),
(44, 'sqdqdq', 'qdsdqsqdqsdqsd@gmail.com', '$2y$10$CEmrFfCqafnI80a/VzvuS.RpkNhhKe8kBP76gQI7.T9wk81iGcaMq', 'b6202462615afb4a6b467034709ae5ce', 'not verified', NULL),
(45, 'wdqsdsqd', 'dqsdqdqdqd@gmail.com', '$2y$10$3eFM87iBctfer4xQBSGaJesPdKDDWr7n0Xc0gtq8btp57ccgrp5/K', '1f0bd12922de5bda76f4f2a0e1aa3d32', 'not verified', NULL),
(46, 'sqdqsd', 'opoikds@gmail.com', '$2y$10$3/RC7bDhcA7kP2HqUD95eeYLX5xTWJKqoxOyKVfBvsH2DZFv5KWom', 'a654a851fec245e8dbc2541a0ee71b4d', 'not verified', NULL),
(48, 'taha', 'taha92220@gmail.com', '$2y$10$sMTZZMJysCGHye3FByYQZOJuIue8xfgJdbLkmsQIPqwfDxFWlzriO', 'ccdf993dd804cbe05bbf6f281d28127a', 'verified', 'intervenant'),
(49, 'toot', 'azerty@gmail.com', '$2y$10$cPJNBLnuxoNRxt//QhWB7eTy5Yz0/peBFL2/jGorjuxaIvnFzrznW', '929d3c68d81dae623efb111673e76f0a', 'verified', 'candidat'),
(50, 'posiqd', 'ujnh@gmail.com', '$2y$10$2iLme.HJDe/RHZH5dP1d/uSdXIROkAErrPmx3KQbaB7uyJyqulD..', 'ee6784155dfb1a6b2abb421a59475ea8', 'verified', 'candidat');

-- --------------------------------------------------------

--
-- Structure de la table `reunion`
--

CREATE TABLE `reunion` (
  `id` int(11) NOT NULL,
  `id_zoom` varchar(100) NOT NULL,
  `sujet` varchar(50) NOT NULL,
  `theme` varchar(50) NOT NULL,
  `niveau` varchar(50) NOT NULL,
  `difficulte` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `duree` int(11) NOT NULL,
  `description` text NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `lien` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reunion`
--

INSERT INTO `reunion` (`id`, `id_zoom`, `sujet`, `theme`, `niveau`, `difficulte`, `date`, `duree`, `description`, `mdp`, `lien`) VALUES
(19, '79617694926', 'poa', 'toto', 'Post-BAC', 'intermÃ©diare', '05/07/2021 12:48', 45, 'sdsd', '', 'https://us04web.zoom.us/j/79617694926?pwd=VGowNllWMWJRTWw2UHNTMm9TRVVwdz09'),
(20, '77888552977', 'qsqs', 'qsqs', 'Bac+4+5', 'expert', '05/07/2021 12:48', 60, 'sq', '', 'https://us04web.zoom.us/j/77888552977?pwd=WUZPSFVOcFFkT1VNNllZNjVPOG5rUT09'),
(21, '76827903034', 'sdsd', 'sdqsdq', 'Bac+2+3', 'debutant', '22/07/2021 12:48', 60, 'sdsds', 'sdsd', 'https://us04web.zoom.us/j/76827903034?pwd=dnJBL0VDd0NLcklCTmZPNE1qTDVRUT09'),
(22, '73431807365', 'test cal', 'test calendri', 'Autre', 'debutant', '05/22/2021 12:48', 60, 'sqdqd', 'sdsd', 'https://us04web.zoom.us/j/73431807365?pwd=S29wamdPemVrTjF2b29tMDk5cXNndz09');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `register_user`
--
ALTER TABLE `register_user`
  ADD PRIMARY KEY (`register_user_id`);

--
-- Index pour la table `reunion`
--
ALTER TABLE `reunion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `register_user`
--
ALTER TABLE `register_user`
  MODIFY `register_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `reunion`
--
ALTER TABLE `reunion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
