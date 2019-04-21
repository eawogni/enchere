-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 01 avr. 2019 à 00:09
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `enchere`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `nomCategorie`) VALUES
(1, 'Jeux'),
(2, 'Automobile'),
(3, 'Smartphone');

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `idEnchere` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `coutMise` float NOT NULL,
  `prixIndicatif` float NOT NULL COMMENT 'c''est le prix que vaut réellement le produit associé à cet enchère. En effet ce produit peut évoluer d''une enchère à une autre',
  `idProduit` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEnchere`),
  KEY `Enchere_Produit_AK` (`idProduit`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`idEnchere`, `dateDebut`, `dateFin`, `coutMise`, `prixIndicatif`, `idProduit`) VALUES
(1, '2019-03-21', '2019-03-23', 2.5, 59, 43),
(2, '2019-03-27', '2019-09-15', 1, 15000, 44),
(4, '2019-03-04', '2019-05-24', 10, 350, 46),
(5, '2019-03-28', '2019-04-11', 2, 59, 43);

-- --------------------------------------------------------

--
-- Structure de la table `form`
--

DROP TABLE IF EXISTS `form`;
CREATE TABLE IF NOT EXISTS `form` (
  `idForm` int(11) NOT NULL AUTO_INCREMENT,
  `methode` varchar(4) DEFAULT NULL COMMENT 'la methode du formulaire (POST ou GET)',
  `actionForm` varchar(255) DEFAULT NULL COMMENT 'url de traitement du formulaire',
  `texteSubmit` varchar(45) DEFAULT NULL COMMENT 'le texte qui s affichera pour le boutton submit . il sera également la valeur des attriibuts name et id de ce objet',
  PRIMARY KEY (`idForm`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `form`
--

INSERT INTO `form` (`idForm`, `methode`, `actionForm`, `texteSubmit`) VALUES
(1, 'POST', 'index.php?p=addCategorie', 'Vallider'),
(2, 'POST', 'index.php?p=adminProduit&action=addProduit', 'Valider'),
(3, 'POST', 'index.php?p=adminEncheres&action=addEnchere', 'Valider');

-- --------------------------------------------------------

--
-- Structure de la table `imageproduit`
--

DROP TABLE IF EXISTS `imageproduit`;
CREATE TABLE IF NOT EXISTS `imageproduit` (
  `idImage` int(11) NOT NULL AUTO_INCREMENT,
  `pathImage` longtext NOT NULL,
  `firstImagine` tinyint(1) NOT NULL,
  `idProduit` int(11) NOT NULL,
  PRIMARY KEY (`idImage`),
  KEY `ImageProduit_Produit_FK` (`idProduit`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `imageproduit`
--

INSERT INTO `imageproduit` (`idImage`, `pathImage`, `firstImagine`, `idProduit`) VALUES
(2, 'fifaA.jpg', 1, 43),
(3, 'fifaB.jpg', 0, 43),
(4, 'fifaC.jpg', 0, 43),
(5, 'renaultZoe-1.jpg', 1, 44),
(6, 'fortnite-1.jpg', 1, 45),
(7, 'huaweiP20-1.jpg', 1, 46),
(8, 'huaweiP20-2.jpg', 0, 46),
(9, 'huaweiP20-3.png', 0, 46),
(10, 'renaultZoe-2.jpg', 0, 44);

-- --------------------------------------------------------

--
-- Structure de la table `mise`
--

DROP TABLE IF EXISTS `mise`;
CREATE TABLE IF NOT EXISTS `mise` (
  `idMise` int(11) NOT NULL AUTO_INCREMENT,
  `montantMise` float DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `idEnchere` int(11) NOT NULL,
  `dateMise` datetime DEFAULT NULL,
  PRIMARY KEY (`idMise`),
  KEY `Mise_Utilisateur_FK` (`login`),
  KEY `Mise_Enchere0_FK` (`idEnchere`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mise`
--

INSERT INTO `mise` (`idMise`, `montantMise`, `login`, `idEnchere`, `dateMise`) VALUES
(1, 1, 'jean55', 1, '2019-03-27 12:12:53'),
(2, 1, 'marcus145', 1, '2019-03-27 12:25:14'),
(3, 3, 'marcus145', 1, '2019-03-27 12:25:33'),
(4, 0.5, 'jean55', 1, '2019-03-27 12:44:10'),
(5, 15, 'jean55', 2, '2019-03-27 12:44:39'),
(6, 10, 'jean55', 2, '2019-03-27 12:44:47'),
(7, 121, 'jean55', 2, '2019-03-27 12:44:53'),
(8, 99, 'marcus145', 2, '2019-03-27 12:49:24'),
(9, 11, 'jean55', 2, '2019-03-28 00:47:00');

-- --------------------------------------------------------

--
-- Structure de la table `objetformulaire`
--

DROP TABLE IF EXISTS `objetformulaire`;
CREATE TABLE IF NOT EXISTS `objetformulaire` (
  `idObjet` int(11) NOT NULL AUTO_INCREMENT,
  `balise` varchar(45) DEFAULT NULL COMMENT 'la balise du champs (input | textarea)',
  `type` varchar(45) DEFAULT NULL COMMENT 'le type de de champs (text | number  |date | time, search) -> uniquement pour un champs input',
  `nom` varchar(45) DEFAULT NULL COMMENT 'le nom pour l attribut name du champ',
  `id` varchar(45) DEFAULT NULL COMMENT 'l''identifiant de ce champs',
  `label` varchar(45) DEFAULT NULL COMMENT 'le texte à afficher pour ce champs',
  `ordreAffichage` varchar(45) DEFAULT NULL COMMENT 'ordre d''affichage du champs',
  `idForm` int(11) DEFAULT NULL COMMENT 'id du formulaire associé a ce champs',
  PRIMARY KEY (`idObjet`),
  KEY `fk_idForm` (`idForm`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='table représentant un champ d''un formulaire';

--
-- Déchargement des données de la table `objetformulaire`
--

INSERT INTO `objetformulaire` (`idObjet`, `balise`, `type`, `nom`, `id`, `label`, `ordreAffichage`, `idForm`) VALUES
(2, 'input', 'text', 'nomCategorie', 'nomCategorie', 'Nom', '0', 1),
(3, 'input', 'text', 'nomProduit', 'nomProduit', 'Nom du Produit', '0', 2),
(4, 'textarea', 'text', 'descriptionProduit', 'descriptionProduit', 'description du produit', '1', 2),
(5, 'input', 'file', 'imageFirst', 'imageFirst', 'Image affiche', '2', 2),
(6, 'input', 'file', 'image2', 'image2', 'Image 2', '3', 2),
(7, 'input', 'file', 'image3', 'image3', 'Image 3', '4', 2),
(8, 'input', 'date', 'dateDebut', 'dateDebut', 'Date de début', '0', 3),
(9, 'input', 'date', 'dateFin', 'dateFin', 'Date de fin', '1', 3),
(10, 'input', 'number', 'coutMise', 'coutMise', 'Coût de la mise', '2', 3),
(13, 'input', 'number', 'prixIndicatif', 'prixIndicatif', 'Prix indicatif', '3', 3),
(14, 'select', ' ', 'categorie', 'categorie', 'Catégorie du produit', '0', 2),
(15, 'select', '   ', 'nomProduit', 'nomProduit', 'Nom du produit', '4', 3);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `idProduit` int(11) NOT NULL AUTO_INCREMENT,
  `nomProduit` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `Produit_Categorie_FK` (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `nomProduit`, `description`, `idCategorie`) VALUES
(43, 'FiFA-19', 'Doté du moteur Frostbite™, EA SPORTS™ FIFA 19 vous offre une expérience de jeu digne d\'un champion sur le terrain et en dehors. Avec la prestigieuse UEFA Champions League, FIFA 19 met à votre disposition tous les outils pour maîtriser le terrain à tous les instants avec des styles de jeu inégalables. Découvrez dans FIFA 19 le final intense de l\'épopée d\'Alex Hunter dans L\'Aventure : Champions* et un nouveau mode du célébrissime FIFA Ultimate Team™, entre autres. Les champions se révèlent dans FIFA 19. ', 1),
(44, 'Renault Zoé', 'Renault ZOE, la citadine 100% électrique qui réinvente la mobilité électrique. Profitez d\'une conduite fluide et zéro émission, sans bruit de moteur ni vitesse à passer.\r\n', 2),
(45, 'Fortnite', 'Fortnite est un jeu en ligne développé par Epic Games qui a été publié sous la forme de différents progiciels proposant différents modes de jeu qui partagent le même gameplay général et le même moteur de jeu.', 1),
(46, 'HUAWEI', 'Les Huawei P20 et P20 Pro succèdent respectivement aux Huawei P10 et P10 Plus en apportant leur lot de nouveautés. Les deux smartphones disposent d’un nouvel écran borderless frappé d’une encoche. Ils ont également une nouvelle configuration d’appareil photo qui diffère en fonction des deux smartphones. Ils tournent sous Android Oreo 8.1, la dernière version de l’OS de Google, avec l’interface EMUI du constructeur.', 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `login` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `dateNaissance` date NOT NULL,
  `m2p` longtext NOT NULL,
  `mail` varchar(50) NOT NULL,
  `estAdmin` tinyint(1) NOT NULL COMMENT 'un utilisateur peut être administrateur ou pas',
  `solde` float DEFAULT '0',
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`login`, `nom`, `prenom`, `dateNaissance`, `m2p`, `mail`, `estAdmin`, `solde`) VALUES
('admin', 'MonsieurAdmin', 'Administrateur', '2019-04-01', '$2y$10$d7UQpXOjCeEg6NNcfh1tXe0kycFDtOLjMwtoLjFV/qjFxAyqLv/V6', 'admin@mail.com', 1, 0),
('jean55', 'Dubois', 'Jean', '2019-03-04', '$2y$10$Wu3fwieqyDrgGwLxRUteaOPMN.H7WrTxkmfo8re1Yitk3.lgSN61C', 'jean@invalid.com', 0, 109),
('marcus145', 'Dubalcon', 'Marc', '1990-03-13', '$2y$10$/4Q8LJ64qU9tQS9eHwrR4uvaEicSLhLbYZPxL2xcSsbTwvB0jvJm.', 'marc@invalid.com', 0, 35);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_mises_users`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vue_mises_users`;
CREATE TABLE IF NOT EXISTS `vue_mises_users` (
`idMise` int(11)
,`montantMise` float
,`login` varchar(50)
,`idEnchere` int(11)
,`dateMise` datetime
,`nbMises` bigint(21)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_mises_users2`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vue_mises_users2`;
CREATE TABLE IF NOT EXISTS `vue_mises_users2` (
`idMise` int(11)
,`montantMise` float
,`login` varchar(50)
,`idEnchere` int(11)
,`dateMise` datetime
,`nbMises` bigint(21)
,`Gagnant` int(1)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_statut_mises`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vue_statut_mises`;
CREATE TABLE IF NOT EXISTS `vue_statut_mises` (
`idEnchere` int(11)
,`login` varchar(50)
,`montantMise` float
,`idMise` int(11)
,`statut` varchar(8)
);

-- --------------------------------------------------------

--
-- Structure de la vue `vue_mises_users`
--
DROP TABLE IF EXISTS `vue_mises_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_mises_users`  AS  select `mise`.`idMise` AS `idMise`,`mise`.`montantMise` AS `montantMise`,`mise`.`login` AS `login`,`mise`.`idEnchere` AS `idEnchere`,`mise`.`dateMise` AS `dateMise`,`r1`.`nbMises` AS `nbMises` from (`mise` join (select `mise`.`idEnchere` AS `idEnchere`,`mise`.`montantMise` AS `montantMise`,count(0) AS `nbMises` from `mise` group by `mise`.`idEnchere`,`mise`.`montantMise`) `r1` on(((`r1`.`idEnchere` = `mise`.`idEnchere`) and (`mise`.`montantMise` = `r1`.`montantMise`)))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_mises_users2`
--
DROP TABLE IF EXISTS `vue_mises_users2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_mises_users2`  AS  select `v1`.`idMise` AS `idMise`,`v1`.`montantMise` AS `montantMise`,`v1`.`login` AS `login`,`v1`.`idEnchere` AS `idEnchere`,`v1`.`dateMise` AS `dateMise`,`v1`.`nbMises` AS `nbMises`,`v2`.`Gagnant` AS `Gagnant` from (`vue_mises_users` `v1` left join (select `vue_mises_users`.`idEnchere` AS `idEnchere`,min(`vue_mises_users`.`montantMise`) AS `mt`,1 AS `Gagnant` from `vue_mises_users` where (`vue_mises_users`.`nbMises` = 1) group by `vue_mises_users`.`idEnchere`) `v2` on(((`v1`.`idEnchere` = `v2`.`idEnchere`) and (`v1`.`montantMise` = `v2`.`mt`)))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_statut_mises`
--
DROP TABLE IF EXISTS `vue_statut_mises`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_statut_mises`  AS  select `vue_mises_users2`.`idEnchere` AS `idEnchere`,`vue_mises_users2`.`login` AS `login`,`vue_mises_users2`.`montantMise` AS `montantMise`,`vue_mises_users2`.`idMise` AS `idMise`,(case when (`vue_mises_users2`.`nbMises` > 1) then 'Perdante' when ((`vue_mises_users2`.`nbMises` = 1) and (`vue_mises_users2`.`Gagnant` = 1)) then 'Gagnante' else 'Unique' end) AS `statut` from `vue_mises_users2` ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `fk_Enchere_Produit` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`) ON DELETE SET NULL;

--
-- Contraintes pour la table `imageproduit`
--
ALTER TABLE `imageproduit`
  ADD CONSTRAINT `ImageProduit_Produit_FK` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`) ON DELETE CASCADE;

--
-- Contraintes pour la table `mise`
--
ALTER TABLE `mise`
  ADD CONSTRAINT `Mise_Enchere0_FK` FOREIGN KEY (`idEnchere`) REFERENCES `enchere` (`idEnchere`),
  ADD CONSTRAINT `Mise_Utilisateur_FK` FOREIGN KEY (`login`) REFERENCES `utilisateur` (`login`);

--
-- Contraintes pour la table `objetformulaire`
--
ALTER TABLE `objetformulaire`
  ADD CONSTRAINT `fk_idForm` FOREIGN KEY (`idForm`) REFERENCES `form` (`idForm`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `Produit_Categorie_FK` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
