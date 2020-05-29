-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 29 mai 2020 à 15:17
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categorie_id`, `title`, `creation_date`) VALUES
(1, 'Air et Climat', '2020-05-12 10:08:53'),
(4, 'Déchets', '2020-05-12 10:13:04'),
(6, 'Développement durable', '2020-05-12 10:14:08'),
(7, 'L\'eau', '2020-05-12 10:14:41');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_date` datetime NOT NULL,
  `reported` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `comments` (`user_id`),
  KEY `comments_ibfk_1` (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`comment_id`, `topic_id`, `user_id`, `comment`, `comment_date`, `reported`) VALUES
(1, 8, 5, 'test', '2020-05-18 13:33:33', 1),
(4, 8, 7, 'L\'un des gestes les plus simples est de ne pas laisser le robinet couler quand on lave la vaisselle.', '2020-05-21 18:41:07', 0),
(5, 8, 3, 'Prendre une douche et non un bain ferait l\'affaire aussi', '2020-05-21 18:45:47', 0),
(6, 8, 5, 'Assure toi que tes robinets ne gouttent pas. Voila, avec ça t\'es servi', '2020-05-21 18:48:39', 0),
(7, 3, 5, 'Nous inspirons environ 20 m3 d\'air par jour', '2020-05-21 18:55:50', 0),
(8, 4, 5, 'Je pense qu\'elle est de 60%', '2020-05-21 18:59:34', 0),
(9, 4, 3, 'Non, la part recyclable est de 75%. Pour info, les emballages recyclables en verre, plastique, métal, papier carton représente 50% des déchets que nous produisons, et les déchets verts(tontede pelouse, feuille...) 25%. \r\nJ\'espère avoir répondu à ta question', '2020-05-21 19:03:47', 0),
(10, 5, 3, 'Parmi les mesures, il y a le fait de ne pas jeter ses ordures n\'importe où par exemple ', '2020-05-21 19:07:39', 0),
(11, 5, 7, 'Éteindre également la lumière en quittant de la pièce', '2020-05-21 19:10:24', 0),
(12, 3, 3, 'Ce qui montre que l\'air est vraiment indispensable à notre survie', '2020-05-23 14:56:12', 0),
(13, 3, 4, 'Alors là, imaginer inspirer 20 m3 d\'air pollué par jour...', '2020-05-23 14:59:01', 0),
(14, 3, 8, 'Changeons de comportement et pensons aux autres et à l\'avenir', '2020-05-23 15:00:45', 0),
(15, 11, 8, 'Une fois collectées, le mercure est régénéré et recyclé pour être utilisé comme tel', '2020-05-23 15:04:42', 0),
(16, 11, 3, 'Le fer, l\'aluminium composant le culot de la lampe sont recyclés dans la filière métaux', '2020-05-23 15:14:03', 0),
(17, 11, 4, 'Le verre ne reste pas en retrait, il est lui aussi recyclé', '2020-05-23 15:15:57', 0),
(18, 5, 4, 'Prendre son vélo', '2020-05-23 15:17:21', 0),
(19, 5, 6, 'commentaire 1\r\n', '2020-05-29 16:56:27', 0),
(20, 5, 6, 'commentaire 2', '2020-05-29 16:57:04', 0),
(21, 3, 6, 'commentaire 3', '2020-05-29 16:57:47', 0),
(22, 11, 6, 'commentaire 4', '2020-05-29 16:58:37', 0),
(23, 11, 6, 'commentaire 5', '2020-05-29 16:58:55', 0),
(24, 4, 6, 'commentaire 6', '2020-05-29 16:59:37', 0),
(25, 4, 6, 'commentaire 7', '2020-05-29 16:59:50', 0),
(26, 4, 6, 'commentaire 8', '2020-05-29 17:00:09', 0),
(27, 8, 6, 'commentaire 9', '2020-05-29 17:01:02', 0),
(28, 8, 6, 'commentaire 10', '2020-05-29 17:01:13', 0);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `topics` (`categorie_id`),
  KEY `topics_ibfk_2` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`topic_id`, `categorie_id`, `user_id`, `title`, `content`, `creation_date`) VALUES
(3, 1, 7, 'Quantité d\'air inspiré', 'L\'air est indispensable pour les êtres vivants. En effet, quelle est la quantité d\'air que nous inspirons chaque jour?', '2020-05-17 10:38:31'),
(4, 4, 7, 'Déchets recyclables', 'Quelle est la part de déchets recyclables sur l\'ensemble des déchets que nous produisons?', '2020-05-17 10:44:47'),
(5, 1, 8, 'Changement climatique', 'Quelles mesures sont en rapport avec le changement climatique?', '2020-05-17 14:20:14'),
(6, 4, 8, 'Ordures ménagères', 'J\'aimerais connaître les deux principales matières qui composent nos ordures ménagères en FRANCE?', '2020-05-17 14:23:12'),
(7, 6, 8, 'Notions et termes', 'C\'est quoi réellement le développement durable. En des termes simples?', '2020-05-17 14:26:53'),
(8, 7, 3, 'Economie d\'eau', 'Quelqu\'un pourrait m\'aider afin de mieux économiser l\'eau. C\'est à dire, avec des gestes simples et pas trop &quot;lourds&quot;?', '2020-05-17 14:30:25'),
(9, 6, 3, 'Panneaux photovoltaïques', 'Je voulais installer des panneaux photovoltaïques, mais je voulais vraiment savoir est ce que ça valait le coût?', '2020-05-17 14:35:11'),
(10, 7, 5, 'Pollution de l\'eau', 'On nous parle tout le temps de pollution de l\'eau, mais quelles sont les sources potentielles de cette dite pollution?', '2020-05-17 14:37:24'),
(11, 4, 5, 'Collecte d\'ampoules', 'J\'ai des tas d\'ampoules chez moi, mon but c\'est de les amener vers des points de collectes. Mais que deviennent elles, une fois collectées?', '2020-05-17 14:41:10');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `pseudo`, `mail`, `pass`, `avatar`, `admin`) VALUES
(2, 'taf', 'fatfa83@yahoo.fr', '$2y$10$KwpyUMjcWpzCtNZ3oJUA5OgEdKARJUq95sTirPjXoTUCIOurJ2h0.', '2.gif', 1),
(3, 'dibey', 'dibey13@gmail.com', '$2y$10$VLDkDCkzIux.EcPMEnUtxeQfg3o943f1dTAh.pnLk5vzj09OXWHpi', '3.png', 0),
(4, 'pispa', 'pispa13@gmail.com', '$2y$10$Uzvwzm40wQl4HnpOttJMY.xoso7lLGlWZwk793HdXlmyjc3g0k9kG', '4.gif', 0),
(5, 'eva', 'evataf@outlook.com', '$2y$10$vF86CZsVl4Vhjqq7Xt74k.WPScmlCGguG9WjzlsuK03.5GEtOBrgC', NULL, 0),
(6, 'iss13', 'iss13@gmail.com', '$2y$10$D72HDboic3KFlMZWkztXVOjENY5WgTCBfOxExoRPbGDxEdqwPb3P.', NULL, 0),
(7, 'stef', 'stef@gmail.com', '$2y$10$g68Z4al3Uqg.EF80R0E2TuzZlBASkL.TxQomkNtJzJBKadXcvFSsO', NULL, 0),
(8, 'moha', 'mohadia@yahoo.fr', '$2y$10$R/1JfTXbSYcDckf2/sy08u0yfp3Pt2S53J9aWicc3arhE7eo.Nvgi', NULL, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`);

--
-- Contraintes pour la table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`categorie_id`),
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
