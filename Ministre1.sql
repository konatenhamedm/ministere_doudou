-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ministere
CREATE DATABASE IF NOT EXISTS `ministere` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ministere`;

-- Dumping structure for table ministere.activite
CREATE TABLE IF NOT EXISTS `activite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.activite: ~0 rows (approximately)

-- Dumping structure for table ministere.article
CREATE TABLE IF NOT EXISTS `article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categorie_id` int DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seuil` int NOT NULL,
  `quantite` int NOT NULL,
  `lignedemandes_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_23A0E66BCF5E72D` (`categorie_id`),
  KEY `IDX_23A0E66747AD248` (`lignedemandes_id`),
  CONSTRAINT `FK_23A0E66747AD248` FOREIGN KEY (`lignedemandes_id`) REFERENCES `ligne_demande` (`id`),
  CONSTRAINT `FK_23A0E66BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.article: ~0 rows (approximately)
REPLACE INTO `article` (`id`, `categorie_id`, `libelle`, `seuil`, `quantite`, `lignedemandes_id`) VALUES
	(1, 1, 'Bracelets élastiques 150 mm (paquet 1kg)', 0, 48, NULL),
	(2, 1, 'Stylo bleu', 0, 100, NULL),
	(3, 1, 'Agrafes 24/6', 0, 25, NULL),
	(4, 1, 'Agrafes pour agrafeuse 8/4', 0, 150, NULL);

-- Dumping structure for table ministere.atelier
CREATE TABLE IF NOT EXISTS `atelier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.atelier: ~0 rows (approximately)

-- Dumping structure for table ministere.bailleur
CREATE TABLE IF NOT EXISTS `bailleur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_financement_id` int DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sigle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` decimal(10,0) NOT NULL,
  `pourcentage` smallint NOT NULL,
  `adresse_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7ABB27F3F1F4C4E0` (`type_financement_id`),
  CONSTRAINT `FK_7ABB27F3F1F4C4E0` FOREIGN KEY (`type_financement_id`) REFERENCES `type_financement` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.bailleur: ~0 rows (approximately)

-- Dumping structure for table ministere.categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.categorie: ~0 rows (approximately)
REPLACE INTO `categorie` (`id`, `libelle`) VALUES
	(1, 'Fournitures de bureau'),
	(2, 'Consommables informatiques'),
	(3, 'Matériels informatiques'),
	(4, 'Mobilier de bureau'),
	(5, 'Documentations'),
	(6, 'Matériels de bureau'),
	(7, 'Equipements de communication'),
	(8, 'Mobilier et matériel de bureau(autre qu\'informatique)'),
	(9, 'Fournitures technique'),
	(10, 'Aliments pour l\'UCP');

-- Dumping structure for table ministere.chef_lieu
CREATE TABLE IF NOT EXISTS `chef_lieu` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.chef_lieu: ~0 rows (approximately)

-- Dumping structure for table ministere.class_diligence
CREATE TABLE IF NOT EXISTS `class_diligence` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.class_diligence: ~0 rows (approximately)

-- Dumping structure for table ministere.compte_rendu
CREATE TABLE IF NOT EXISTS `compte_rendu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mission_id` int NOT NULL,
  `redacteur_id` int DEFAULT NULL,
  `introduction` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultat` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectif` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `conclusion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contexte` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_cr` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D39E69D2BE6CAE90` (`mission_id`),
  KEY `IDX_D39E69D2764D0490` (`redacteur_id`),
  CONSTRAINT `FK_D39E69D2764D0490` FOREIGN KEY (`redacteur_id`) REFERENCES `_admin_employe` (`id`),
  CONSTRAINT `FK_D39E69D2BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.compte_rendu: ~0 rows (approximately)

-- Dumping structure for table ministere.courier_arrive
CREATE TABLE IF NOT EXISTS `courier_arrive` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.courier_arrive: ~0 rows (approximately)

-- Dumping structure for table ministere.courrier_arrive
CREATE TABLE IF NOT EXISTS `courrier_arrive` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `entreprise_id` int DEFAULT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reception` datetime DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `objet` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` tinyint(1) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `existe` tinyint(1) DEFAULT NULL,
  `rangement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expediteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_15E474C1A76ED395` (`user_id`),
  KEY `IDX_15E474C1A4AEAFEA` (`entreprise_id`),
  CONSTRAINT `FK_15E474C1A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `_admin_param_entreprise` (`id`),
  CONSTRAINT `FK_15E474C1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `_admin_user_utilisateur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.courrier_arrive: ~0 rows (approximately)

-- Dumping structure for table ministere.date_historique
CREATE TABLE IF NOT EXISTS `date_historique` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.date_historique: ~0 rows (approximately)

-- Dumping structure for table ministere.date_livraison
CREATE TABLE IF NOT EXISTS `date_livraison` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.date_livraison: ~0 rows (approximately)

-- Dumping structure for table ministere.demande
CREATE TABLE IF NOT EXISTS `demande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_demande` datetime NOT NULL,
  `date_validation` datetime NOT NULL,
  `date_livraison` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.demande: ~0 rows (approximately)

-- Dumping structure for table ministere.departement
CREATE TABLE IF NOT EXISTS `departement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C1765B6398260155` (`region_id`),
  CONSTRAINT `FK_C1765B6398260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.departement: ~6 rows (approximately)
REPLACE INTO `departement` (`id`, `libelle`, `region_id`) VALUES
	(1, 'BOUNDIALI', 1),
	(2, 'DIKODOUGOU', 2),
	(3, 'FERKESSEDOUGOU', 3),
	(4, 'KONG', 3),
	(5, 'KORHOGO', 2),
	(6, 'KOUTO', 1);

-- Dumping structure for table ministere.diligence
CREATE TABLE IF NOT EXISTS `diligence` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reunion_id` int DEFAULT NULL,
  `date_traitement_diligence` datetime NOT NULL,
  `commentaire_diligence` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5D64E0604E9B7368` (`reunion_id`),
  CONSTRAINT `FK_5D64E0604E9B7368` FOREIGN KEY (`reunion_id`) REFERENCES `reunion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.diligence: ~0 rows (approximately)

-- Dumping structure for table ministere.district
CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.district: ~4 rows (approximately)
REPLACE INTO `district` (`id`, `libelle`) VALUES
	(1, 'SAVANE'),
	(2, 'ABIDJAN'),
	(3, 'COMOE'),
	(4, 'LACS');

-- Dumping structure for table ministere.document_atelier
CREATE TABLE IF NOT EXISTS `document_atelier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `atelier_id` int DEFAULT NULL,
  `fichier_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_45D4BEFF82E2CF35` (`atelier_id`),
  KEY `IDX_45D4BEFFF915CFE` (`fichier_id`),
  CONSTRAINT `FK_45D4BEFF82E2CF35` FOREIGN KEY (`atelier_id`) REFERENCES `atelier` (`id`),
  CONSTRAINT `FK_45D4BEFFF915CFE` FOREIGN KEY (`fichier_id`) REFERENCES `_admin_param_fichier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.document_atelier: ~0 rows (approximately)

-- Dumping structure for table ministere.document_courier
CREATE TABLE IF NOT EXISTS `document_courier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `courier_id` int DEFAULT NULL,
  `fichier_id` int DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6B7CEAA0E3D8151C` (`courier_id`),
  KEY `IDX_6B7CEAA0F915CFE` (`fichier_id`),
  CONSTRAINT `FK_6B7CEAA0E3D8151C` FOREIGN KEY (`courier_id`) REFERENCES `courrier_arrive` (`id`),
  CONSTRAINT `FK_6B7CEAA0F915CFE` FOREIGN KEY (`fichier_id`) REFERENCES `_admin_param_fichier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.document_courier: ~0 rows (approximately)

-- Dumping structure for table ministere.element
CREATE TABLE IF NOT EXISTS `element` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element_id` int DEFAULT NULL,
  `root_id` int DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pourcentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pourcentage_ex` smallint NOT NULL,
  `lft` int NOT NULL,
  `lvl` int NOT NULL,
  `rgt` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_41405E391F1F2A24` (`element_id`),
  KEY `IDX_41405E3979066886` (`root_id`),
  CONSTRAINT `FK_41405E391F1F2A24` FOREIGN KEY (`element_id`) REFERENCES `element` (`id`),
  CONSTRAINT `FK_41405E3979066886` FOREIGN KEY (`root_id`) REFERENCES `element` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.element: ~0 rows (approximately)

-- Dumping structure for table ministere.etat
CREATE TABLE IF NOT EXISTS `etat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.etat: ~0 rows (approximately)
REPLACE INTO `etat` (`id`, `libelle`) VALUES
	(1, 'En attente de validation'),
	(2, 'Validée'),
	(3, 'Livré');

-- Dumping structure for table ministere.fichier_accusse_reception
CREATE TABLE IF NOT EXISTS `fichier_accusse_reception` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fichier_id` int DEFAULT NULL,
  `courier_arrive_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6925DE25F915CFE` (`fichier_id`),
  KEY `IDX_6925DE25A52C6BFA` (`courier_arrive_id`),
  CONSTRAINT `FK_6925DE25A52C6BFA` FOREIGN KEY (`courier_arrive_id`) REFERENCES `courrier_arrive` (`id`),
  CONSTRAINT `FK_6925DE25F915CFE` FOREIGN KEY (`fichier_id`) REFERENCES `_admin_param_fichier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.fichier_accusse_reception: ~0 rows (approximately)

-- Dumping structure for table ministere.fichier_acte
CREATE TABLE IF NOT EXISTS `fichier_acte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.fichier_acte: ~0 rows (approximately)

-- Dumping structure for table ministere.historique_mission
CREATE TABLE IF NOT EXISTS `historique_mission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mission_id` int NOT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_historique` datetime NOT NULL,
  `missions_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F273AD43BE6CAE90` (`mission_id`),
  KEY `IDX_F273AD4317C042CF` (`missions_id`),
  CONSTRAINT `FK_F273AD4317C042CF` FOREIGN KEY (`missions_id`) REFERENCES `mission` (`id`),
  CONSTRAINT `FK_F273AD43BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.historique_mission: ~0 rows (approximately)

-- Dumping structure for table ministere.historique_reunion
CREATE TABLE IF NOT EXISTS `historique_reunion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reunion_id` int DEFAULT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_historique` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3914FBFD4E9B7368` (`reunion_id`),
  CONSTRAINT `FK_3914FBFD4E9B7368` FOREIGN KEY (`reunion_id`) REFERENCES `reunion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.historique_reunion: ~0 rows (approximately)

-- Dumping structure for table ministere.imputation
CREATE TABLE IF NOT EXISTS `imputation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employe_id` int DEFAULT NULL,
  `courier_arrive_id` int DEFAULT NULL,
  `commentaire` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AE81A25A1B65292` (`employe_id`),
  KEY `IDX_AE81A25AA52C6BFA` (`courier_arrive_id`),
  CONSTRAINT `FK_AE81A25A1B65292` FOREIGN KEY (`employe_id`) REFERENCES `_admin_employe` (`id`),
  CONSTRAINT `FK_AE81A25AA52C6BFA` FOREIGN KEY (`courier_arrive_id`) REFERENCES `courrier_arrive` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.imputation: ~0 rows (approximately)

-- Dumping structure for table ministere.info_rapportage
CREATE TABLE IF NOT EXISTS `info_rapportage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reunion_id` int DEFAULT NULL,
  `rapporteur_id` int DEFAULT NULL,
  `numero_cr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_cr` smallint NOT NULL,
  `date_cr` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_824F25684E9B7368` (`reunion_id`),
  KEY `IDX_824F25682AF5D182` (`rapporteur_id`),
  CONSTRAINT `FK_824F25682AF5D182` FOREIGN KEY (`rapporteur_id`) REFERENCES `_admin_employe` (`id`),
  CONSTRAINT `FK_824F25684E9B7368` FOREIGN KEY (`reunion_id`) REFERENCES `reunion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.info_rapportage: ~0 rows (approximately)

-- Dumping structure for table ministere.interlocuteur
CREATE TABLE IF NOT EXISTS `interlocuteur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bailleur_id` int DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E3FB142457B5D0A2` (`bailleur_id`),
  CONSTRAINT `FK_E3FB142457B5D0A2` FOREIGN KEY (`bailleur_id`) REFERENCES `bailleur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.interlocuteur: ~0 rows (approximately)

-- Dumping structure for table ministere.ligne_demande
CREATE TABLE IF NOT EXISTS `ligne_demande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `demande_id` int NOT NULL,
  `quantite_demandee` int DEFAULT NULL,
  `quantite_validee` int DEFAULT NULL,
  `quantite_recue` int DEFAULT NULL,
  `article_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B90DE99C80E95E18` (`demande_id`),
  KEY `IDX_B90DE99C7294869C` (`article_id`),
  CONSTRAINT `FK_B90DE99C7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  CONSTRAINT `FK_B90DE99C80E95E18` FOREIGN KEY (`demande_id`) REFERENCES `demande` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.ligne_demande: ~0 rows (approximately)

-- Dumping structure for table ministere.ligne_mission
CREATE TABLE IF NOT EXISTS `ligne_mission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mission_id` int DEFAULT NULL,
  `detailsLocalite` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `nbre_jours` int NOT NULL,
  `village_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FFECC05BE6CAE90` (`mission_id`),
  KEY `IDX_FFECC055E0D5582` (`village_id`),
  CONSTRAINT `FK_FFECC055E0D5582` FOREIGN KEY (`village_id`) REFERENCES `village` (`id`),
  CONSTRAINT `FK_FFECC05BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.ligne_mission: ~0 rows (approximately)

-- Dumping structure for table ministere.messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.messenger_messages: ~0 rows (approximately)

-- Dumping structure for table ministere.mission
CREATE TABLE IF NOT EXISTS `mission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employe_id` int DEFAULT NULL,
  `moyen_transport_id` int DEFAULT NULL,
  `compte_rendu_id` int DEFAULT NULL,
  `objet_mission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_om` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut_pretuve` datetime NOT NULL,
  `date_fin_pretuve` datetime NOT NULL,
  `date_debut_effective` datetime NOT NULL,
  `date_fin_effective` datetime NOT NULL,
  `montant_participant_mission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pourcentage_avance_mission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initiateur_mission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imputation_budgetaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` json NOT NULL,
  `fichier_id` int DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9067F23C4BC44A10` (`compte_rendu_id`),
  KEY `IDX_9067F23C1B65292` (`employe_id`),
  KEY `IDX_9067F23C3ED8D53F` (`moyen_transport_id`),
  KEY `IDX_9067F23CF915CFE` (`fichier_id`),
  CONSTRAINT `FK_9067F23C1B65292` FOREIGN KEY (`employe_id`) REFERENCES `_admin_employe` (`id`),
  CONSTRAINT `FK_9067F23C3ED8D53F` FOREIGN KEY (`moyen_transport_id`) REFERENCES `moyen_transport` (`id`),
  CONSTRAINT `FK_9067F23C4BC44A10` FOREIGN KEY (`compte_rendu_id`) REFERENCES `compte_rendu` (`id`),
  CONSTRAINT `FK_9067F23CF915CFE` FOREIGN KEY (`fichier_id`) REFERENCES `_admin_param_fichier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.mission: ~0 rows (approximately)
REPLACE INTO `mission` (`id`, `employe_id`, `moyen_transport_id`, `compte_rendu_id`, `objet_mission`, `numero_om`, `date_debut_pretuve`, `date_fin_pretuve`, `date_debut_effective`, `date_fin_effective`, `montant_participant_mission`, `pourcentage_avance_mission`, `initiateur_mission`, `imputation_budgetaire`, `options`, `fichier_id`, `etat`) VALUES
	(1, 1, 2, NULL, 'demande', '10', '2025-01-20 00:00:00', '2025-01-26 18:47:29', '2025-01-31 00:00:00', '2025-01-20 00:00:00', '15', '10', '10', '15000', '[0]', 1, 'en_cours');

-- Dumping structure for table ministere.mission_employe
CREATE TABLE IF NOT EXISTS `mission_employe` (
  `mission_id` int NOT NULL,
  `employe_id` int NOT NULL,
  PRIMARY KEY (`mission_id`,`employe_id`),
  KEY `IDX_693847F4BE6CAE90` (`mission_id`),
  KEY `IDX_693847F41B65292` (`employe_id`),
  CONSTRAINT `FK_693847F41B65292` FOREIGN KEY (`employe_id`) REFERENCES `_admin_employe` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_693847F4BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.mission_employe: ~0 rows (approximately)
REPLACE INTO `mission_employe` (`mission_id`, `employe_id`) VALUES
	(1, 1);

-- Dumping structure for table ministere.module_parent
CREATE TABLE IF NOT EXISTS `module_parent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordre` int NOT NULL,
  `active` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.module_parent: ~0 rows (approximately)

-- Dumping structure for table ministere.moyen_transport
CREATE TABLE IF NOT EXISTS `moyen_transport` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.moyen_transport: ~2 rows (approximately)
REPLACE INTO `moyen_transport` (`id`, `libelle`) VALUES
	(1, 'VOITURE'),
	(2, 'VELO'),
	(3, 'ANVION');

-- Dumping structure for table ministere.niveau
CREATE TABLE IF NOT EXISTS `niveau` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profondeur` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_couleur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.niveau: ~0 rows (approximately)

-- Dumping structure for table ministere.ordre_jour
CREATE TABLE IF NOT EXISTS `ordre_jour` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lib_ordre_jour` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_ordre_jour` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.ordre_jour: ~0 rows (approximately)

-- Dumping structure for table ministere.parametre
CREATE TABLE IF NOT EXISTS `parametre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur_header` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur_side` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.parametre: ~0 rows (approximately)

-- Dumping structure for table ministere.parametres
CREATE TABLE IF NOT EXISTS `parametres` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.parametres: ~0 rows (approximately)

-- Dumping structure for table ministere.pays
CREATE TABLE IF NOT EXISTS `pays` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.pays: ~0 rows (approximately)

-- Dumping structure for table ministere.piece_jointe_mission
CREATE TABLE IF NOT EXISTS `piece_jointe_mission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mission_id` int DEFAULT NULL,
  `type_fichier_id` int DEFAULT NULL,
  `date_fichier` date NOT NULL,
  `missions_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67F48908BE6CAE90` (`mission_id`),
  KEY `IDX_67F4890812928ADB` (`type_fichier_id`),
  KEY `IDX_67F4890817C042CF` (`missions_id`),
  CONSTRAINT `FK_67F4890812928ADB` FOREIGN KEY (`type_fichier_id`) REFERENCES `type_fichier` (`id`),
  CONSTRAINT `FK_67F4890817C042CF` FOREIGN KEY (`missions_id`) REFERENCES `mission` (`id`),
  CONSTRAINT `FK_67F48908BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.piece_jointe_mission: ~0 rows (approximately)

-- Dumping structure for table ministere.presence
CREATE TABLE IF NOT EXISTS `presence` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reunion_id` int DEFAULT NULL,
  `employe_id` int DEFAULT NULL,
  `etat_presence` tinyint(1) NOT NULL,
  `lib_presence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rapportage` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `point_aborde` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `recommendation_rapport` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6977C7A54E9B7368` (`reunion_id`),
  KEY `IDX_6977C7A51B65292` (`employe_id`),
  CONSTRAINT `FK_6977C7A51B65292` FOREIGN KEY (`employe_id`) REFERENCES `_admin_employe` (`id`),
  CONSTRAINT `FK_6977C7A54E9B7368` FOREIGN KEY (`reunion_id`) REFERENCES `reunion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.presence: ~0 rows (approximately)

-- Dumping structure for table ministere.projet
CREATE TABLE IF NOT EXISTS `projet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pays_id` int DEFAULT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sigle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_projet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut_projet` datetime NOT NULL,
  `date_fin_projet` datetime NOT NULL,
  `boite_postale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacts_projet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_web_projet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut_projet` tinyint(1) NOT NULL,
  `email_info_projet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `situation_geo_projet` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_50159CA9A6E44244` (`pays_id`),
  CONSTRAINT `FK_50159CA9A6E44244` FOREIGN KEY (`pays_id`) REFERENCES `pays` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.projet: ~0 rows (approximately)

-- Dumping structure for table ministere.rapportage
CREATE TABLE IF NOT EXISTS `rapportage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reunion_id` int DEFAULT NULL,
  `point_id` int DEFAULT NULL,
  `diligence_id` int DEFAULT NULL,
  `delai_rapport` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DA8A19C43A3758E0` (`diligence_id`),
  KEY `IDX_DA8A19C44E9B7368` (`reunion_id`),
  KEY `IDX_DA8A19C4C028CEA2` (`point_id`),
  CONSTRAINT `FK_DA8A19C43A3758E0` FOREIGN KEY (`diligence_id`) REFERENCES `diligence` (`id`),
  CONSTRAINT `FK_DA8A19C44E9B7368` FOREIGN KEY (`reunion_id`) REFERENCES `reunion` (`id`),
  CONSTRAINT `FK_DA8A19C4C028CEA2` FOREIGN KEY (`point_id`) REFERENCES `ordre_jour` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.rapportage: ~0 rows (approximately)

-- Dumping structure for table ministere.rapportage_employe
CREATE TABLE IF NOT EXISTS `rapportage_employe` (
  `rapportage_id` int NOT NULL,
  `employe_id` int NOT NULL,
  PRIMARY KEY (`rapportage_id`,`employe_id`),
  KEY `IDX_FC88F252668A3850` (`rapportage_id`),
  KEY `IDX_FC88F2521B65292` (`employe_id`),
  CONSTRAINT `FK_FC88F2521B65292` FOREIGN KEY (`employe_id`) REFERENCES `_admin_employe` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_FC88F252668A3850` FOREIGN KEY (`rapportage_id`) REFERENCES `rapportage` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.rapportage_employe: ~0 rows (approximately)

-- Dumping structure for table ministere.region
CREATE TABLE IF NOT EXISTS `region` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district_id` int DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F62F176B08FA272` (`district_id`),
  CONSTRAINT `FK_F62F176B08FA272` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.region: ~5 rows (approximately)
REPLACE INTO `region` (`id`, `district_id`, `libelle`) VALUES
	(1, 1, 'BAGOUE'),
	(2, 1, 'PORO'),
	(3, 1, 'TCHOLOGO'),
	(4, 3, 'INDENIE-DJUABLIN'),
	(5, 2, 'DISTRICT AUTONOME D\'ABIDJAN');

-- Dumping structure for table ministere.reset_password_request
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`),
  CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `_admin_user_utilisateur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.reset_password_request: ~0 rows (approximately)

-- Dumping structure for table ministere.reunion
CREATE TABLE IF NOT EXISTS `reunion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `salle_id` int DEFAULT NULL,
  `points_id` int DEFAULT NULL,
  `president_id` int DEFAULT NULL,
  `lib_reunion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reunion` datetime NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5B00A482DC304035` (`salle_id`),
  KEY `IDX_5B00A482DF69572F` (`points_id`),
  KEY `IDX_5B00A482B40A33C7` (`president_id`),
  CONSTRAINT `FK_5B00A482B40A33C7` FOREIGN KEY (`president_id`) REFERENCES `_admin_employe` (`id`),
  CONSTRAINT `FK_5B00A482DC304035` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`id`),
  CONSTRAINT `FK_5B00A482DF69572F` FOREIGN KEY (`points_id`) REFERENCES `ordre_jour` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.reunion: ~0 rows (approximately)

-- Dumping structure for table ministere.reunion_structure
CREATE TABLE IF NOT EXISTS `reunion_structure` (
  `id` int NOT NULL AUTO_INCREMENT,
  `structure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.reunion_structure: ~0 rows (approximately)

-- Dumping structure for table ministere.salle
CREATE TABLE IF NOT EXISTS `salle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.salle: ~0 rows (approximately)

-- Dumping structure for table ministere.sens
CREATE TABLE IF NOT EXISTS `sens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sens` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.sens: ~0 rows (approximately)
REPLACE INTO `sens` (`id`, `sens`, `libelle`) VALUES
	(1, 1, 'Entrée'),
	(2, 2, 'Sortie');

-- Dumping structure for table ministere.source_financement
CREATE TABLE IF NOT EXISTS `source_financement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pourcentage` smallint NOT NULL,
  `montant` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.source_financement: ~2 rows (approximately)
REPLACE INTO `source_financement` (`id`, `libelle`, `pourcentage`, `montant`) VALUES
	(1, 'AIDE', 10, 150000.00),
	(2, 'AIDE', 15, 150000.00);

-- Dumping structure for table ministere.sous_prefecture
CREATE TABLE IF NOT EXISTS `sous_prefecture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `departement_id` int DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4D9E04F0CCF9E01E` (`departement_id`),
  CONSTRAINT `FK_4D9E04F0CCF9E01E` FOREIGN KEY (`departement_id`) REFERENCES `departement` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.sous_prefecture: ~4 rows (approximately)
REPLACE INTO `sous_prefecture` (`id`, `departement_id`, `libelle`) VALUES
	(1, 1, 'BAYA'),
	(2, 4, 'BILIMONO'),
	(3, 6, 'BLESSEGUE'),
	(4, 2, 'BORON'),
	(5, 1, 'BOUNDIALI');

-- Dumping structure for table ministere.structure
CREATE TABLE IF NOT EXISTS `structure` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_membre` smallint NOT NULL,
  `date_creation` date NOT NULL,
  `etat_creation` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.structure: ~0 rows (approximately)

-- Dumping structure for table ministere.tarif
CREATE TABLE IF NOT EXISTS `tarif` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pourcentage_avance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant_participant` decimal(10,0) NOT NULL,
  `email_om` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.tarif: ~2 rows (approximately)
REPLACE INTO `tarif` (`id`, `pourcentage_avance`, `montant_participant`, `email_om`) VALUES
	(1, '10', 15000, 'sggd@gmail.com'),
	(2, '8', 15000, 'sgd@gmail.com');

-- Dumping structure for table ministere.type_fichier
CREATE TABLE IF NOT EXISTS `type_fichier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.type_fichier: ~0 rows (approximately)

-- Dumping structure for table ministere.type_financement
CREATE TABLE IF NOT EXISTS `type_financement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.type_financement: ~0 rows (approximately)

-- Dumping structure for table ministere.type_plan
CREATE TABLE IF NOT EXISTS `type_plan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lib_type_plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.type_plan: ~0 rows (approximately)

-- Dumping structure for table ministere.village
CREATE TABLE IF NOT EXISTS `village` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sous_prefecture_id` int DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4E6C7FAAA05ECDEA` (`sous_prefecture_id`),
  CONSTRAINT `FK_4E6C7FAAA05ECDEA` FOREIGN KEY (`sous_prefecture_id`) REFERENCES `sous_prefecture` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere.village: ~0 rows (approximately)
REPLACE INTO `village` (`id`, `sous_prefecture_id`, `libelle`) VALUES
	(1, 5, 'BOUNDIALI');

-- Dumping structure for table ministere._admin_employe
CREATE TABLE IF NOT EXISTS `_admin_employe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fonction_id` int DEFAULT NULL,
  `civilite_id` int DEFAULT NULL,
  `entreprise_id` int DEFAULT NULL,
  `piece_id` int DEFAULT NULL,
  `nom` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricule` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_piece` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contacts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reunion_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9368111E57889920` (`fonction_id`),
  KEY `IDX_9368111E39194ABF` (`civilite_id`),
  KEY `IDX_9368111EA4AEAFEA` (`entreprise_id`),
  KEY `IDX_9368111EC40FCFA8` (`piece_id`),
  KEY `IDX_9368111E4E9B7368` (`reunion_id`),
  CONSTRAINT `FK_9368111E39194ABF` FOREIGN KEY (`civilite_id`) REFERENCES `_admin_param_civilite` (`id`),
  CONSTRAINT `FK_9368111E4E9B7368` FOREIGN KEY (`reunion_id`) REFERENCES `reunion` (`id`),
  CONSTRAINT `FK_9368111E57889920` FOREIGN KEY (`fonction_id`) REFERENCES `_admin_param_fonction` (`id`),
  CONSTRAINT `FK_9368111EA4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `_admin_param_entreprise` (`id`),
  CONSTRAINT `FK_9368111EC40FCFA8` FOREIGN KEY (`piece_id`) REFERENCES `_admin_param_fichier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_employe: ~0 rows (approximately)
REPLACE INTO `_admin_employe` (`id`, `fonction_id`, `civilite_id`, `entreprise_id`, `piece_id`, `nom`, `prenom`, `contact`, `adresse_mail`, `matricule`, `num_piece`, `contacts`, `residence`, `reunion_id`) VALUES
	(1, 1, 2, 1, NULL, 'Admin', 'Admin', '00000000', 'admin@knh.com', '00000000', '555', NULL, 'admin@knh.com', NULL);

-- Dumping structure for table ministere._admin_param_civilite
CREATE TABLE IF NOT EXISTS `_admin_param_civilite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_param_civilite: ~0 rows (approximately)
REPLACE INTO `_admin_param_civilite` (`id`, `libelle`, `code`) VALUES
	(2, 'Monsieur', 'M.');

-- Dumping structure for table ministere._admin_param_config_app
CREATE TABLE IF NOT EXISTS `_admin_param_config_app` (
  `id` int NOT NULL AUTO_INCREMENT,
  `logo_id` int DEFAULT NULL,
  `favicon_id` int DEFAULT NULL,
  `image_login_id` int DEFAULT NULL,
  `logo_login_id` int DEFAULT NULL,
  `entreprise_id` int DEFAULT NULL,
  `main_color_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_color_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_color_login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_color_login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EE0159A1F98F144A` (`logo_id`),
  KEY `IDX_EE0159A1D78119FD` (`favicon_id`),
  KEY `IDX_EE0159A1D3426EF5` (`image_login_id`),
  KEY `IDX_EE0159A1C83BB8B` (`logo_login_id`),
  KEY `IDX_EE0159A1A4AEAFEA` (`entreprise_id`),
  CONSTRAINT `FK_EE0159A1A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `_admin_param_entreprise` (`id`),
  CONSTRAINT `FK_EE0159A1C83BB8B` FOREIGN KEY (`logo_login_id`) REFERENCES `_admin_param_fichier` (`id`),
  CONSTRAINT `FK_EE0159A1D3426EF5` FOREIGN KEY (`image_login_id`) REFERENCES `_admin_param_fichier` (`id`),
  CONSTRAINT `FK_EE0159A1D78119FD` FOREIGN KEY (`favicon_id`) REFERENCES `_admin_param_fichier` (`id`),
  CONSTRAINT `FK_EE0159A1F98F144A` FOREIGN KEY (`logo_id`) REFERENCES `_admin_param_fichier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_param_config_app: ~0 rows (approximately)

-- Dumping structure for table ministere._admin_param_entreprise
CREATE TABLE IF NOT EXISTS `_admin_param_entreprise` (
  `id` int NOT NULL AUTO_INCREMENT,
  `logo_id` int DEFAULT NULL,
  `denomination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sigle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agrements` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `situation_geo` longtext COLLATE utf8mb4_unicode_ci,
  `contacts` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_web` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `directeur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3537B201F98F144A` (`logo_id`),
  CONSTRAINT `FK_3537B201F98F144A` FOREIGN KEY (`logo_id`) REFERENCES `_admin_param_fichier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_param_entreprise: ~0 rows (approximately)
REPLACE INTO `_admin_param_entreprise` (`id`, `logo_id`, `denomination`, `code`, `sigle`, `agrements`, `situation_geo`, `contacts`, `adresse`, `mobile`, `fax`, `email`, `site_web`, `directeur`, `date_creation`) VALUES
	(1, NULL, 'Default', 'ENT1', 'ENT1', 'ENT1', 'ENT1', 'ENT1', 'ENT1', 'ENT1', 'ENT1', 'ENT1', 'ENT1', NULL, NULL);

-- Dumping structure for table ministere._admin_param_fichier
CREATE TABLE IF NOT EXISTS `_admin_param_fichier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `size` int DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  `url` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_param_fichier: ~0 rows (approximately)
REPLACE INTO `_admin_param_fichier` (`id`, `size`, `path`, `alt`, `date_creation`, `url`) VALUES
	(1, NULL, NULL, NULL, '2025-01-26 18:47:29', NULL);

-- Dumping structure for table ministere._admin_param_fonction
CREATE TABLE IF NOT EXISTS `_admin_param_fonction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entreprise_id` int DEFAULT NULL,
  `libelle` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3A832C6877153098` (`code`),
  KEY `IDX_3A832C68A4AEAFEA` (`entreprise_id`),
  CONSTRAINT `FK_3A832C68A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `_admin_param_entreprise` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_param_fonction: ~0 rows (approximately)
REPLACE INTO `_admin_param_fonction` (`id`, `entreprise_id`, `libelle`, `code`) VALUES
	(1, NULL, 'Administrateur', 'ADM');

-- Dumping structure for table ministere._admin_param_groupe_module
CREATE TABLE IF NOT EXISTS `_admin_param_groupe_module` (
  `id` int NOT NULL AUTO_INCREMENT,
  `icon_id` int DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordre` int NOT NULL,
  `lien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CA79B3FF54B9D732` (`icon_id`),
  CONSTRAINT `FK_CA79B3FF54B9D732` FOREIGN KEY (`icon_id`) REFERENCES `_admin_param_icon` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_param_groupe_module: ~27 rows (approximately)
REPLACE INTO `_admin_param_groupe_module` (`id`, `icon_id`, `titre`, `ordre`, `lien`) VALUES
	(1, 1, 'Les groupes & permissions', 2, 'app_utilisateur_groupe_index'),
	(2, 1, 'Paramétrqge', 2, 'app_config_parametre_index'),
	(3, 1, 'Config', 2, 'app_parametre_config_app_index'),
	(4, 1, 'Liste des fonctions', 2, 'app_parametre_fonction_index'),
	(5, 1, 'Liste des emplyés', 2, 'app_utilisateur_employe_index'),
	(6, 1, 'Permissions', 2, 'app_utilisateur_permition_index'),
	(7, 1, 'Compte utilisateurs', 2, 'app_utilisateur_utilisateur_index'),
	(8, 1, 'Configuration application', 2, 'app_parametre_config_app_index'),
	(9, 1, 'Courrier Arrivé', 2, 'app_courrier_courier_arrive_index'),
	(10, 1, 'Courrier depart', 2, 'app_courrier_courier_depart_index'),
	(11, 1, 'Courrier internes', 2, 'app_courrier_courier_interne_index'),
	(12, 1, 'District', 2, 'app_parametre_district_index'),
	(13, 1, 'Regions', 2, 'app_parametre_region_index'),
	(14, 1, 'Départements', 2, 'app_parametre_departement_index'),
	(15, 1, 'Sous-prefectures', 2, 'app_parametre_sous_prefecture_index'),
	(16, 1, 'Village', 2, 'app_parametre_village_index'),
	(17, 1, 'Misions', 2, 'app_config_missions_index'),
	(18, 1, 'Tarif', 2, 'app_mission_tarif_index'),
	(19, 1, 'Moyens de transport', 2, 'app_mission_moyen_transport_index'),
	(20, 1, 'Source de financement', 2, 'app_mission_source_financement_index'),
	(21, 1, 'Paremetrevalide', 2, 'app_config_mission_index'),
	(22, 1, 'Reunions', 2, 'app_config_reunions_index'),
	(23, 1, 'Salles', 2, 'app_reunion_salle_index'),
	(24, 1, 'liste des reunions', 2, 'app_reunion_reunion_index'),
	(25, 1, 'DILIGENCES', 2, 'app_reunion_diligence_index'),
	(26, 1, 'Attelier', 2, 'app_gestionatelier_atelier_index'),
	(27, 1, 'Stock administratif', 2, 'app_config_stocks_index'),
	(28, 1, 'Catégories', 2, 'app_gestionstock_categorie_index'),
	(29, 1, 'Articles', 2, 'app_gestionstock_article_index'),
	(30, 1, 'Sens', 2, 'app_gestionstock_sens_index'),
	(31, 1, 'Etat', 2, 'app_gestionstock_etat_index'),
	(32, 1, 'Demande Stock', 2, 'app_config_stock_index');

-- Dumping structure for table ministere._admin_param_icon
CREATE TABLE IF NOT EXISTS `_admin_param_icon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_param_icon: ~0 rows (approximately)
REPLACE INTO `_admin_param_icon` (`id`, `code`, `image`, `libelle`) VALUES
	(1, 'bi bi-arrow-up-right-circle', NULL, 'Icon fleche croissante');

-- Dumping structure for table ministere._admin_param_module
CREATE TABLE IF NOT EXISTS `_admin_param_module` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordre` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_param_module: ~7 rows (approximately)
REPLACE INTO `_admin_param_module` (`id`, `titre`, `ordre`) VALUES
	(1, 'Configuration', 1),
	(2, 'Gestion des courriers', 3),
	(3, 'Missions', 2),
	(4, 'Réunions', 4),
	(5, 'Gestion des atéliers', 5),
	(6, 'Gestion du stock', 6),
	(7, 'Logistique', 7),
	(8, 'Dossiers', 8);

-- Dumping structure for table ministere._admin_param_module_groupe_permition
CREATE TABLE IF NOT EXISTS `_admin_param_module_groupe_permition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `permition_id` int DEFAULT NULL,
  `module_id` int DEFAULT NULL,
  `groupe_module_id` int DEFAULT NULL,
  `groupe_user_id` int DEFAULT NULL,
  `ordre` int NOT NULL,
  `ordre_groupe` int NOT NULL,
  `menu_principal` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29EAEA2B806F2303` (`permition_id`),
  KEY `IDX_29EAEA2BAFC2B591` (`module_id`),
  KEY `IDX_29EAEA2BFF5666A6` (`groupe_module_id`),
  KEY `IDX_29EAEA2B610934DB` (`groupe_user_id`),
  CONSTRAINT `FK_29EAEA2B610934DB` FOREIGN KEY (`groupe_user_id`) REFERENCES `_admin_user_groupe` (`id`),
  CONSTRAINT `FK_29EAEA2B806F2303` FOREIGN KEY (`permition_id`) REFERENCES `_admin_param_permition` (`id`),
  CONSTRAINT `FK_29EAEA2BAFC2B591` FOREIGN KEY (`module_id`) REFERENCES `_admin_param_module` (`id`),
  CONSTRAINT `FK_29EAEA2BFF5666A6` FOREIGN KEY (`groupe_module_id`) REFERENCES `_admin_param_groupe_module` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_param_module_groupe_permition: ~25 rows (approximately)
REPLACE INTO `_admin_param_module_groupe_permition` (`id`, `permition_id`, `module_id`, `groupe_module_id`, `groupe_user_id`, `ordre`, `ordre_groupe`, `menu_principal`) VALUES
	(1, 1, 1, 2, 1, 1, 1, 1),
	(2, 1, 1, 1, 1, 1, 2, 0),
	(3, 1, 1, 4, 1, 2, 1, 0),
	(4, 1, 1, 5, 1, 2, 2, 0),
	(5, 1, 1, 6, 1, 2, 3, 0),
	(6, 1, 1, 7, 1, 2, 4, 0),
	(7, 1, 1, 8, 1, 2, 5, 0),
	(8, 1, 2, 9, 1, 2, 1, 1),
	(9, 1, 2, 10, 1, 2, 2, 1),
	(10, 1, 2, 11, 1, 2, 3, 1),
	(11, 1, 1, 12, 1, 2, 1, 0),
	(12, 1, 1, 13, 1, 2, 2, 0),
	(13, 1, 1, 14, 1, 2, 3, 0),
	(14, 1, 1, 15, 1, 2, 4, 0),
	(15, 1, 1, 16, 1, 2, 5, 0),
	(16, 1, 3, 17, 1, 3, 1, 1),
	(17, 1, 3, 18, 1, 3, 1, 0),
	(18, 1, 3, 19, 1, 3, 2, 0),
	(19, 1, 3, 20, 1, 3, 3, 0),
	(20, 1, 3, 21, 1, 3, 1, 0),
	(22, 1, 4, 22, 1, 4, 1, 1),
	(23, 1, 4, 23, 1, 4, 2, 0),
	(24, 1, 4, 24, 1, 4, 3, 0),
	(25, 1, 4, 25, 1, 4, 4, 0),
	(26, 1, 5, 26, 1, 5, 1, 1),
	(27, 1, 6, 27, 1, 6, 1, 1),
	(28, 1, 6, 28, 1, 6, 2, 0),
	(29, 1, 6, 29, 1, 6, 3, 0),
	(30, 1, 6, 30, 1, 6, 4, 0),
	(31, 1, 6, 31, 1, 6, 5, 0),
	(32, 1, 6, 32, 1, 6, 6, 0);

-- Dumping structure for table ministere._admin_param_permition
CREATE TABLE IF NOT EXISTS `_admin_param_permition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_param_permition: ~6 rows (approximately)
REPLACE INTO `_admin_param_permition` (`id`, `code`, `libelle`) VALUES
	(1, 'CRUD', 'Tous les droits'),
	(2, 'RD', 'Lecture et Delete'),
	(3, 'RUD', 'Lecture, écritureet delete'),
	(4, 'CRU', 'Lecture ecriture et update'),
	(5, 'CR', 'Créer et ecture'),
	(6, 'R', 'Lecture');

-- Dumping structure for table ministere._admin_param_service
CREATE TABLE IF NOT EXISTS `_admin_param_service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_param_service: ~0 rows (approximately)

-- Dumping structure for table ministere._admin_param_test
CREATE TABLE IF NOT EXISTS `_admin_param_test` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_param_test: ~0 rows (approximately)

-- Dumping structure for table ministere._admin_user_front_prestataire
CREATE TABLE IF NOT EXISTS `_admin_user_front_prestataire` (
  `id` int NOT NULL,
  `denomination_sociale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_principal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_60FED01CBF396750` FOREIGN KEY (`id`) REFERENCES `_admin_user_front_utilisateur` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_user_front_prestataire: ~0 rows (approximately)

-- Dumping structure for table ministere._admin_user_front_utilisateur
CREATE TABLE IF NOT EXISTS `_admin_user_front_utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1D40D72FF85E0677` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_user_front_utilisateur: ~0 rows (approximately)

-- Dumping structure for table ministere._admin_user_front_utilisateur_simple
CREATE TABLE IF NOT EXISTS `_admin_user_front_utilisateur_simple` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenoms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_F4066868BF396750` FOREIGN KEY (`id`) REFERENCES `_admin_user_front_utilisateur` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_user_front_utilisateur_simple: ~0 rows (approximately)

-- Dumping structure for table ministere._admin_user_groupe
CREATE TABLE IF NOT EXISTS `_admin_user_groupe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_user_groupe: ~1 rows (approximately)
REPLACE INTO `_admin_user_groupe` (`id`, `name`, `description`, `roles`, `code`) VALUES
	(1, 'Super Administrateur', '', '["ROLE_SUPER_ADMIN", "ROLE_ADMIN"]', 'uu');

-- Dumping structure for table ministere._admin_user_utilisateur
CREATE TABLE IF NOT EXISTS `_admin_user_utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employe_id` int NOT NULL,
  `groupe_id` int DEFAULT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2264DC41F85E0677` (`username`),
  UNIQUE KEY `UNIQ_2264DC411B65292` (`employe_id`),
  KEY `IDX_2264DC417A45358C` (`groupe_id`),
  CONSTRAINT `FK_2264DC411B65292` FOREIGN KEY (`employe_id`) REFERENCES `_admin_employe` (`id`),
  CONSTRAINT `FK_2264DC417A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `_admin_user_groupe` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ministere._admin_user_utilisateur: ~0 rows (approximately)
REPLACE INTO `_admin_user_utilisateur` (`id`, `employe_id`, `groupe_id`, `username`, `roles`, `password`) VALUES
	(1, 1, 1, 'admin', '[]', '$2y$13$xQSKpO6BtU/ASxH8j0/xcOjK0CDEVSHDEkcj3iaby5nHaacaRX9P2');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
