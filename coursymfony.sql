-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 19 déc. 2021 à 18:40
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `coursymfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `soiree`
--

CREATE TABLE `soiree` (
  `id` int(11) NOT NULL,
  `nbrparticipants` int(11) DEFAULT NULL,
  `total_soiree` double DEFAULT NULL,
  `moyenne_utilisateur` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `soiree`
--

INSERT INTO `soiree` (`id`, `nbrparticipants`, `total_soiree`, `moyenne_utilisateur`) VALUES
(1, 4, NULL, NULL),
(2, 3, NULL, NULL),
(3, 3, NULL, NULL),
(4, 3, NULL, NULL),
(5, 9, NULL, NULL),
(6, 3, NULL, NULL),
(7, 6, 1350, 225),
(8, 3, 127, 42.333333333333),
(9, 3, 60, 20),
(10, 3, 80, 27),
(11, 5, 804, 161),
(12, 3, 2107, 702),
(13, 3, 712, 237);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_soiree_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_organisateur` tinyint(1) DEFAULT NULL,
  `dettes` double DEFAULT NULL,
  `depenses` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `id_soiree_id`, `nom`, `is_organisateur`, `dettes`, `depenses`) VALUES
(1, NULL, 'thomas', 1, NULL, 15),
(2, NULL, 'elouan', NULL, NULL, 10),
(3, NULL, 'thomas gay', NULL, NULL, 5),
(4, 1, 'thomas', 1, NULL, 50),
(5, 1, 'elouan', NULL, NULL, 10),
(6, 1, 'clement', NULL, NULL, 15),
(7, 1, 'romain', NULL, NULL, 15),
(8, 2, 'thomas', 1, NULL, 5),
(9, 2, 'eloun', NULL, NULL, 4),
(10, 2, 'romin', NULL, NULL, 53),
(11, 3, 'thomas', 1, NULL, 16),
(12, 3, 'eluan', NULL, NULL, 416),
(13, 3, 'romain', NULL, NULL, 415),
(14, 3, 'thomas', 1, NULL, 16),
(15, 3, 'eluan', NULL, NULL, 416),
(16, 3, 'romain', NULL, NULL, 415),
(17, 4, 'thomas', 1, NULL, 156),
(18, 4, 'elouan', NULL, NULL, 16),
(19, 4, 'romain', NULL, NULL, 53),
(20, 6, 'gyu', 1, NULL, 596),
(21, 6, 'vyt', NULL, NULL, 56),
(22, 6, 'vty', NULL, NULL, 4146),
(23, 6, 'gyu', 1, NULL, 596),
(24, 6, 'vyt', NULL, NULL, 56),
(25, 6, 'vty', NULL, NULL, 4146),
(26, 7, 'byugui', 1, -241, 466),
(27, 7, 'gyu', NULL, 179, 46),
(28, 7, 'vyu', NULL, 62, 163),
(29, 7, 'byugui', 1, -241, 466),
(30, 7, 'gyu', NULL, 179, 46),
(31, 7, 'vyu', NULL, 62, 163),
(32, 8, 'bf', 1, -22.666666666667, 65),
(33, 8, 'gyuf', NULL, 26.333333333333, 16),
(34, 8, 'ftyf', NULL, -3.6666666666667, 46),
(35, 9, 'vtyf', 1, -20, 40),
(36, 9, 'gtf', NULL, 10, 10),
(37, 9, 'gèfè', NULL, 10, 10),
(38, 10, 'thomas', 1, 12, 15),
(39, 10, 'romain', NULL, 12, 15),
(40, 10, 'eloun', NULL, -23, 50),
(41, 11, 'toto', 1, 5, 156),
(42, 11, 'y-èg', NULL, 83, 78),
(43, 11, 'vyv', NULL, -307, 468),
(44, 11, 'hui', NULL, 115, 46),
(45, 11, 'hui', NULL, 105, 56),
(46, 12, 'toto', 1, 546, 156),
(47, 12, 'ygu', NULL, 216, 486),
(48, 12, 'g_', NULL, -763, 1465),
(49, 13, 'fty', 1, 72, 165),
(50, 13, 'gy', NULL, -261, 498),
(51, 13, 'gyu', NULL, 188, 49);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `soiree`
--
ALTER TABLE `soiree`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8D93D6493A37A35C` (`id_soiree_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `soiree`
--
ALTER TABLE `soiree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6493A37A35C` FOREIGN KEY (`id_soiree_id`) REFERENCES `soiree` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
