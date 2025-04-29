-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 19 avr. 2025 à 12:18
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_cahier_appel`
--
CREATE DATABASE IF NOT EXISTS if0_38850616_mytrack;
USE if0_38850616_mytrack;


-- --------------------------------------------------------

--
-- Structure de la table `cahier_texte`
--

CREATE TABLE `cahier_texte` (
  `id` int(11) NOT NULL,
  `enseignant_id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL,
  `matiere` varchar(100) NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `module_cours` varchar(100) NOT NULL,
  `titre_lecon` varchar(255) NOT NULL,
  `competences` text DEFAULT NULL,
  `support_path` varchar(255) DEFAULT NULL,
  `date_seance` date NOT NULL DEFAULT curdate(),
  `approuve` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cahier_texte`
--

INSERT INTO `cahier_texte` (`id`, `enseignant_id`, `classe_id`, `matiere`, `heure_debut`, `heure_fin`, `module_cours`, `titre_lecon`, `competences`, `support_path`, `date_seance`, `approuve`) VALUES
(1, 2, 1, 'INFORMATIQUE', '16:40:00', '18:40:00', 'Devel', 'php', 'hjklggsbjh', 'uploads/TCHAMY FRANCK.pdf', '2025-04-14', 1),
(2, 2, 1, 'INFORMATIQUE', '08:19:00', '08:20:00', 'Devel', 'php', 'fjkfl', 'uploads/besttech-removebg-preview (1).jpg', '2025-04-16', 1);

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `nom`) VALUES
(1, '6ème'),
(2, '4ème'),
(3, '5ème');

-- --------------------------------------------------------

--
-- Structure de la table `liens_parents`
--

CREATE TABLE `liens_parents` (
  `parent_id` int(11) NOT NULL,
  `enfant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `presences`
--

CREATE TABLE `presences` (
  `id` int(11) NOT NULL,
  `cahier_texte_id` int(11) NOT NULL,
  `eleve_id` int(11) NOT NULL,
  `present` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `presences`
--

INSERT INTO `presences` (`id`, `cahier_texte_id`, `eleve_id`, `present`) VALUES
(1, 1, 3, 1),
(2, 1, 3, 0),
(3, 1, 3, 0),
(4, 1, 3, 0),
(5, 1, 3, 0),
(6, 1, 3, 0),
(7, 1, 3, 0),
(8, 1, 3, 1),
(9, 2, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('enseignant','eleve','parent','censeur') NOT NULL,
  `classe_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `role`, `classe_id`) VALUES
(1, 'TCHAMY BATCHOU', 'Franck Beaurel', 'tchamyf@gmail.com', '$2y$10$em14SiACcJUwsydFeAhJwuNLsAg2sB.UrjAoJ/kfdeNvCUA2tlKg.', 'censeur', NULL),
(2, 'Keutchami', 'joseres', 'joresketchami96@gmail.com', '$2y$10$pirpgmc5p3gGhLawf702FO3IohwLKfqzMSbP4V4Za71EsZHuaCFum', 'enseignant', 1),
(3, 'tot', 'kdf', 't@gmail.com', '$2y$10$JgMk7ztiSOPR6l5F6YspM.LKTI5c4nwCWf3yYbx36yeEKXcrwIyBO', 'eleve', 1),
(4, 'p', 'ghze', 'p@gmail.com', '$2y$10$/3yaxkX5XQAXP8BR8KVwO.g34F3DUiakyA/xGjqE4lz6L/wMknqJ2', 'parent', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cahier_texte`
--
ALTER TABLE `cahier_texte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enseignant_id` (`enseignant_id`),
  ADD KEY `classe_id` (`classe_id`);

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `liens_parents`
--
ALTER TABLE `liens_parents`
  ADD PRIMARY KEY (`parent_id`,`enfant_id`),
  ADD KEY `enfant_id` (`enfant_id`);

--
-- Index pour la table `presences`
--
ALTER TABLE `presences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cahier_texte_id` (`cahier_texte_id`),
  ADD KEY `eleve_id` (`eleve_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `classe_id` (`classe_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cahier_texte`
--
ALTER TABLE `cahier_texte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `presences`
--
ALTER TABLE `presences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cahier_texte`
--
ALTER TABLE `cahier_texte`
  ADD CONSTRAINT `cahier_texte_ibfk_1` FOREIGN KEY (`enseignant_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cahier_texte_ibfk_2` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`);

--
-- Contraintes pour la table `liens_parents`
--
ALTER TABLE `liens_parents`
  ADD CONSTRAINT `liens_parents_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `liens_parents_ibfk_2` FOREIGN KEY (`enfant_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `presences`
--
ALTER TABLE `presences`
  ADD CONSTRAINT `presences_ibfk_1` FOREIGN KEY (`cahier_texte_id`) REFERENCES `cahier_texte` (`id`),
  ADD CONSTRAINT `presences_ibfk_2` FOREIGN KEY (`eleve_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
