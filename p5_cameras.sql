-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 25 juil. 2018 à 16:03
-- Version du serveur :  5.5.59
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `p5_cameras`
--

-- --------------------------------------------------------

--
-- Structure de la table `camera`
--

DROP TABLE IF EXISTS `camera`;
CREATE TABLE IF NOT EXISTS `camera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `camera_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sensor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `length` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3B1CEE0559027487` (`theme_id`),
  KEY `IDX_3B1CEE0512469DE2` (`category_id`),
  KEY `IDX_3B1CEE05A23B42D` (`manufacturer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `camera`
--

INSERT INTO `camera` (`id`, `category_id`, `manufacturer_id`, `theme_id`, `camera_name`, `sensor`, `length`, `width`, `height`, `weight`, `description`, `time`, `image`) VALUES
(1, 1, 1, 2, 'EOS 750D', 'APS-C 24Mp 6000X4000', 132, 78, 101, 555, 'Un appareil pour les débutants/amateurs de Canon.', '1/4000s', NULL),
(2, 1, 1, 6, 'EOS 760D', 'APS-C 24Mp 6000X4000', 132, 78, 101, 555, 'Une modification de l\'EOS 750D.', '1/4000s', NULL),
(3, 2, 2, 10, 'A7R III', 'FF 42,4Mpx 7952x5304', 130, 60, 96, 470, 'Un hybride haute résolution de Sony', '1/8000s', NULL),
(4, 1, 3, 12, 'K-1 II', 'FF 36Mpx 7360x4912', 146, 78, 124, 925, 'Le meilleur appareil pour les paysages.', '1/8000s', NULL),
(5, 2, 1, 14, 'M50', 'APS-C 24Mp 6000X4000', 130, 78, 96, 500, 'Test', '1/4000s', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `camera_comment`
--

DROP TABLE IF EXISTS `camera_comment`;
CREATE TABLE IF NOT EXISTS `camera_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `camera_id_id` int(11) NOT NULL,
  `user_id_id` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_59A62B48A47890` (`camera_id_id`),
  KEY `IDX_59A62B489D86650F` (`user_id_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `camera_comment`
--

INSERT INTO `camera_comment` (`id`, `camera_id_id`, `user_id_id`, `comment`, `added`) VALUES
(1, 4, 2, 'Le meilleur appareil à mon avis.', '2018-07-19 15:16:28'),
(2, 4, 4, 'Magnifique !!!', '2018-07-19 16:38:39');

-- --------------------------------------------------------

--
-- Structure de la table `camera_monture`
--

DROP TABLE IF EXISTS `camera_monture`;
CREATE TABLE IF NOT EXISTS `camera_monture` (
  `camera_id` int(11) NOT NULL,
  `monture_id` int(11) NOT NULL,
  PRIMARY KEY (`camera_id`,`monture_id`),
  KEY `IDX_F3C9EC0FB47685CD` (`camera_id`),
  KEY `IDX_F3C9EC0FD40ADBBC` (`monture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `camera_monture`
--

INSERT INTO `camera_monture` (`camera_id`, `monture_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 1),
(5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `cam_category`
--

DROP TABLE IF EXISTS `cam_category`;
CREATE TABLE IF NOT EXISTS `cam_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cam_category`
--

INSERT INTO `cam_category` (`id`, `category`) VALUES
(1, 'Reflex'),
(2, 'Hybride'),
(3, 'Compact'),
(4, 'Bridge');

-- --------------------------------------------------------

--
-- Structure de la table `cam_manufacturer`
--

DROP TABLE IF EXISTS `cam_manufacturer`;
CREATE TABLE IF NOT EXISTS `cam_manufacturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_id` int(11) NOT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_54F5D1AE59027487` (`theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cam_manufacturer`
--

INSERT INTO `cam_manufacturer` (`id`, `theme_id`, `manufacturer`) VALUES
(1, 1, 'Canon'),
(2, 9, 'Sony'),
(3, 11, 'Pentax');

-- --------------------------------------------------------

--
-- Structure de la table `forum_message`
--

DROP TABLE IF EXISTS `forum_message`;
CREATE TABLE IF NOT EXISTS `forum_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_47717D0E59027487` (`theme_id`),
  KEY `IDX_47717D0EA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `forum_message`
--

INSERT INTO `forum_message` (`id`, `theme_id`, `user_id`, `message`, `added`) VALUES
(1, 2, 2, 'La plage dynamique de cet appareil est très faible donc il n\'est pas bon pour les paysages.', '2018-07-19 10:09:56'),
(2, 2, 3, 'Il est quand même possible de photographier les paysages avec cet appareil.', '2018-07-19 10:12:25'),
(3, 2, 2, 'Oui, mais c\'est plus gênant qu\'avec Pentax K1.', '2018-07-19 10:14:49'),
(4, 2, 3, 'K-1 est 3 fois plus cher.', '2018-07-19 10:26:07'),
(5, 15, 4, 'Le piqué est excellent', '2018-07-19 16:41:44'),
(6, 15, 4, '<strong>Test</strong>', '2018-07-19 16:48:11');

-- --------------------------------------------------------

--
-- Structure de la table `forum_theme`
--

DROP TABLE IF EXISTS `forum_theme`;
CREATE TABLE IF NOT EXISTS `forum_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `forum_theme`
--

INSERT INTO `forum_theme` (`id`, `theme`, `parent_id`) VALUES
(1, 'Canon', 4),
(2, 'EOS 750D', 1),
(3, 'Forum', 0),
(4, 'Appareils photo', 3),
(5, 'Objectifs', 3),
(6, 'EOS 760D', 1),
(7, 'Canon', 5),
(8, 'EF-S 18-200 f/3.5-5.6 IS', 7),
(9, 'Sony', 4),
(10, 'A7R III', 9),
(11, 'Pentax', 4),
(12, 'K-1 II', 11),
(13, 'La plage dynamique', 2),
(14, 'M50', 1),
(15, 'Le piqué', 14);

-- --------------------------------------------------------

--
-- Structure de la table `lens`
--

DROP TABLE IF EXISTS `lens`;
CREATE TABLE IF NOT EXISTS `lens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `monture_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `length` int(11) NOT NULL,
  `diameter` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `focal_length_min` int(11) NOT NULL,
  `focal_length_max` int(11) NOT NULL,
  `focuse` int(11) NOT NULL,
  `aperture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diameter_of_filter` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2CDAF8C359027487` (`theme_id`),
  KEY `IDX_2CDAF8C3A23B42D` (`manufacturer_id`),
  KEY `IDX_2CDAF8C3D40ADBBC` (`monture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `lens`
--

INSERT INTO `lens` (`id`, `manufacturer_id`, `monture_id`, `theme_id`, `name`, `length`, `diameter`, `weight`, `focal_length_min`, `focal_length_max`, `focuse`, `aperture`, `diameter_of_filter`, `description`, `image`) VALUES
(1, 1, 2, 8, 'EF-S 18-200 f/3.5-5.6 IS', 205, 79, 595, 18, 200, 45, 'f/3.5-5.6', 72, 'Un polyvalent pour le capteur APS-C de Canon.', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `lens_cam_manufacturer`
--

DROP TABLE IF EXISTS `lens_cam_manufacturer`;
CREATE TABLE IF NOT EXISTS `lens_cam_manufacturer` (
  `lens_id` int(11) NOT NULL,
  `cam_manufacturer_id` int(11) NOT NULL,
  PRIMARY KEY (`lens_id`,`cam_manufacturer_id`),
  KEY `IDX_F96C104A4FCBBD7A` (`lens_id`),
  KEY `IDX_F96C104AE05347C3` (`cam_manufacturer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `lens_cam_manufacturer`
--

INSERT INTO `lens_cam_manufacturer` (`lens_id`, `cam_manufacturer_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `lens_comment`
--

DROP TABLE IF EXISTS `lens_comment`;
CREATE TABLE IF NOT EXISTS `lens_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lens_id_id` int(11) NOT NULL,
  `user_id_id` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F4107A3762FAE334` (`lens_id_id`),
  KEY `IDX_F4107A379D86650F` (`user_id_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lens_manufacturer`
--

DROP TABLE IF EXISTS `lens_manufacturer`;
CREATE TABLE IF NOT EXISTS `lens_manufacturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_id` int(11) NOT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3D6C978C59027487` (`theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `lens_manufacturer`
--

INSERT INTO `lens_manufacturer` (`id`, `theme_id`, `manufacturer`) VALUES
(1, 7, 'Canon');

-- --------------------------------------------------------

--
-- Structure de la table `message_admin`
--

DROP TABLE IF EXISTS `message_admin`;
CREATE TABLE IF NOT EXISTS `message_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `theme` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_77A8F29DA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message_private`
--

DROP TABLE IF EXISTS `message_private`;
CREATE TABLE IF NOT EXISTS `message_private` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_428EFBDD2130303A` (`from_user_id`),
  UNIQUE KEY `UNIQ_428EFBDD29F6EE60` (`to_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20180722161238');

-- --------------------------------------------------------

--
-- Structure de la table `monture`
--

DROP TABLE IF EXISTS `monture`;
CREATE TABLE IF NOT EXISTS `monture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `monture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3E1B952BA23B42D` (`manufacturer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `monture`
--

INSERT INTO `monture` (`id`, `manufacturer_id`, `monture`) VALUES
(1, 1, 'EF'),
(2, 1, 'EF-S'),
(3, 2, 'Sony E'),
(4, 3, 'Pentax K');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `privacy` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `roles`, `email`, `avatar`, `privacy`) VALUES
(1, 'admin', '$2y$12$Ehg1L9oFQDE28O3cMzu/4.KpbdY6r.8TUKhHRCLVL1bYpc7ZyIlr6', '', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'admin@test.fr', NULL, 0),
(2, 'Thomas', '$2y$12$XwwbQuP6v/ak3tKoMnCvwumsdc3J3K/DxbnXvmzzGEO7uIkTeimoW', '', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 'thomas@orange.fr', NULL, 0),
(3, 'Anne', '$2y$12$jhszhVT2neK6RW/BjK57BuHDfzafm0dhNGfo77t7ukpKlKVPdDqVu', '', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 'anne@gmail.com', NULL, 0),
(4, 'Nik', '$2y$12$Wge4VtnmpNKZ9VNV0U2mYOoc3Po6xqvO7SYRvR3efNcN/pXwV7Kb2', '', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 'nik@gmail.com', NULL, 0),
(5, 'Test', '$2y$12$UzGKjjxRPvjbMRVhot3WbOmu.Zk30IE5npZWpmzgdqnqVh91TP9oK', '', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 'test@gmail.com', NULL, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `camera`
--
ALTER TABLE `camera`
  ADD CONSTRAINT `FK_3B1CEE0512469DE2` FOREIGN KEY (`category_id`) REFERENCES `cam_category` (`id`),
  ADD CONSTRAINT `FK_3B1CEE0559027487` FOREIGN KEY (`theme_id`) REFERENCES `forum_theme` (`id`),
  ADD CONSTRAINT `FK_3B1CEE05A23B42D` FOREIGN KEY (`manufacturer_id`) REFERENCES `cam_manufacturer` (`id`);

--
-- Contraintes pour la table `camera_comment`
--
ALTER TABLE `camera_comment`
  ADD CONSTRAINT `FK_59A62B489D86650F` FOREIGN KEY (`user_id_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_59A62B48A47890` FOREIGN KEY (`camera_id_id`) REFERENCES `camera` (`id`);

--
-- Contraintes pour la table `camera_monture`
--
ALTER TABLE `camera_monture`
  ADD CONSTRAINT `FK_F3C9EC0FB47685CD` FOREIGN KEY (`camera_id`) REFERENCES `camera` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F3C9EC0FD40ADBBC` FOREIGN KEY (`monture_id`) REFERENCES `monture` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cam_manufacturer`
--
ALTER TABLE `cam_manufacturer`
  ADD CONSTRAINT `FK_54F5D1AE59027487` FOREIGN KEY (`theme_id`) REFERENCES `forum_theme` (`id`);

--
-- Contraintes pour la table `forum_message`
--
ALTER TABLE `forum_message`
  ADD CONSTRAINT `FK_47717D0E59027487` FOREIGN KEY (`theme_id`) REFERENCES `forum_theme` (`id`),
  ADD CONSTRAINT `FK_47717D0EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `lens`
--
ALTER TABLE `lens`
  ADD CONSTRAINT `FK_2CDAF8C359027487` FOREIGN KEY (`theme_id`) REFERENCES `forum_theme` (`id`),
  ADD CONSTRAINT `FK_2CDAF8C3A23B42D` FOREIGN KEY (`manufacturer_id`) REFERENCES `lens_manufacturer` (`id`),
  ADD CONSTRAINT `FK_2CDAF8C3D40ADBBC` FOREIGN KEY (`monture_id`) REFERENCES `monture` (`id`);

--
-- Contraintes pour la table `lens_cam_manufacturer`
--
ALTER TABLE `lens_cam_manufacturer`
  ADD CONSTRAINT `FK_F96C104A4FCBBD7A` FOREIGN KEY (`lens_id`) REFERENCES `lens` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F96C104AE05347C3` FOREIGN KEY (`cam_manufacturer_id`) REFERENCES `cam_manufacturer` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `lens_comment`
--
ALTER TABLE `lens_comment`
  ADD CONSTRAINT `FK_F4107A3762FAE334` FOREIGN KEY (`lens_id_id`) REFERENCES `lens` (`id`),
  ADD CONSTRAINT `FK_F4107A379D86650F` FOREIGN KEY (`user_id_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `lens_manufacturer`
--
ALTER TABLE `lens_manufacturer`
  ADD CONSTRAINT `FK_3D6C978C59027487` FOREIGN KEY (`theme_id`) REFERENCES `forum_theme` (`id`);

--
-- Contraintes pour la table `message_admin`
--
ALTER TABLE `message_admin`
  ADD CONSTRAINT `FK_77A8F29DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `message_private`
--
ALTER TABLE `message_private`
  ADD CONSTRAINT `FK_428EFBDD2130303A` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_428EFBDD29F6EE60` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `monture`
--
ALTER TABLE `monture`
  ADD CONSTRAINT `FK_3E1B952BA23B42D` FOREIGN KEY (`manufacturer_id`) REFERENCES `cam_manufacturer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
