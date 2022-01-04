-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u1
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 04 Janvier 2022 à 21:58
-- Version du serveur :  10.3.31-MariaDB-0+deb10u1
-- Version de PHP :  7.3.31-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbbamalvezin`
--

-- --------------------------------------------------------

--
-- Structure de la table `Liste`
--

CREATE TABLE `Liste` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `checked` int(11) NOT NULL DEFAULT 0,
  `idUtil` int(11) DEFAULT NULL,
  `dateL` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Liste`
--

INSERT INTO `Liste` (`id`, `nom`, `checked`, `idUtil`, `dateL`) VALUES
(43, 'Liste privée 2', 0, 1, '2021-12-22'),
(47, 'Test ', 0, 1, '2021-12-22'),
(48, 'Gérer les listes', 1, 4, '2021-12-22'),
(49, 'Gérer l&#39;inscription ', 1, 4, '2021-12-22'),
(50, 'gérer la connection', 1, 4, '2021-12-22'),
(56, 'Faire le site de TodoList', 1, NULL, '2022-01-04'),
(58, 'Faire le projet tuteuré', 0, 3, '2022-01-04');

-- --------------------------------------------------------

--
-- Structure de la table `Tache`
--

CREATE TABLE `Tache` (
  `title` varchar(50) NOT NULL,
  `descT` varchar(300) DEFAULT NULL,
  `dateT` date NOT NULL,
  `id` int(11) NOT NULL,
  `idListe` int(11) NOT NULL,
  `checked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Tache`
--

INSERT INTO `Tache` (`title`, `descT`, `dateT`, `id`, `idListe`, `checked`) VALUES
('Les vues', 'Vues de connection et de listes des tâches', '2022-01-04', 21, 56, 1),
('Faire les Modèles', 'ModelUtilisateur & ModelVisiteur', '2022-01-04', 22, 56, 1),
('Les controllers', 'FrontController, ControllerUtilisateur & ControllerVisiteur', '2022-01-04', 25, 56, 1),
('Faire les vues', 'Faire les vues de l\'application', '2022-01-04', 27, 58, 0),
('Inscrire en BDD', 'Faire en sorte que l\'inscription entre les données du nouvel utilisateur en BDD', '2022-01-04', 28, 50, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `mdp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`id`, `pseudo`, `mdp`) VALUES
(3, 'toto', '$2y$10$u3C5GzrnsrsNAVanfVnRgOhJ2QJKqSZK8SN6Oigs1r8tBVMfcSBZG'),
(4, 'vigaillard2', '$2y$10$8MQctyJRQ2JqnkeLg57dmOL5tvj51rbfltui0vR2aYrmXph/J70Xm');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Liste`
--
ALTER TABLE `Liste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Tache`
--
ALTER TABLE `Tache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ConstTacheListe` (`idListe`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Liste`
--
ALTER TABLE `Liste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT pour la table `Tache`
--
ALTER TABLE `Tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Tache`
--
ALTER TABLE `Tache`
  ADD CONSTRAINT `ConstTacheListe` FOREIGN KEY (`idListe`) REFERENCES `Liste` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
