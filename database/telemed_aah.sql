-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 19 avr. 2021 à 16:57
-- Version du serveur :  8.0.18
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `telemed_aah`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `profile_picture` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  UNIQUE KEY `admins_phone_number_unique` (`phone_number`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `name`, `firstname`, `email`, `username`, `phone_number`, `address`, `profile_picture`, `user_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'KOSSIGAN', 'Prodige', 'pkossigan@gmail.com', NULL, '22893343699', 'Lomé-Togo', 'avatar.jpg', 1, NULL, '$2y$10$SrQ7gvzk8FS5VI7aLldCre2TITgggxB9uezJRtzm6mFQ7PwxUrpU6', NULL, '2020-07-08 17:28:31', '2020-07-08 17:28:31'),
(2, 'EDORH', 'Christian', 'christianedorh@gmail.com', NULL, '+22890959953', 'Lomé-Togo', 'avatar_1597416399.jpg', 13, NULL, '$2y$10$IGiLaAp6/YCMYH9KfVIvP.8tG6m589wapYQA0ypQ2tjd0izkRRkHe', NULL, '2020-08-14 13:46:39', '2020-10-02 16:29:23');

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `review_id` int(11) NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `doctor_user_id` int(11) DEFAULT NULL,
  `answerable_id` int(10) UNSIGNED NOT NULL,
  `answerable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`id`, `review_id`, `body`, `user_id`, `parent_id`, `patient_id`, `doctor_id`, `doctor_user_id`, `answerable_id`, `answerable_type`, `created_at`, `updated_at`) VALUES
(2, 2, 'Merci beaucoup c\'est gentil. Vous savoir en bonne santé me fait le plus grand bien.', 9, NULL, 1, 1, 9, 2, 'App\\Review', '2020-12-15 17:32:05', '2020-12-15 17:32:05');

-- --------------------------------------------------------

--
-- Structure de la table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `begin_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `date_apt` date NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `apt_amount` double(8,2) DEFAULT NULL,
  `speciality_id` int(11) DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_user_id` int(11) NOT NULL,
  `patient_user_id` int(11) NOT NULL,
  `note` mediumtext COLLATE utf8mb4_unicode_ci,
  `confirm_date` date DEFAULT NULL,
  `identifier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentmode_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appointments`
--

INSERT INTO `appointments` (`id`, `begin_time`, `end_time`, `date_apt`, `schedule_id`, `apt_amount`, `speciality_id`, `patient_id`, `doctor_id`, `doctor_user_id`, `patient_user_id`, `note`, `confirm_date`, `identifier`, `paymentmode_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '07:00:00', '07:30:00', '2021-06-29', 2, 1.00, 2, 1, 1, 9, 6, '<p>Maux de dents</p>', NULL, 'nmnbjkgzf', 3, 1, '2021-03-19 15:22:37', '2021-03-19 15:27:55'),
(2, '07:00:00', '07:30:00', '2021-06-23', 4, 1.00, 2, 1, 1, 9, 6, '<p>maux de gencives</p>', NULL, 'c2i7f1fd3', 3, 1, '2021-03-19 15:52:31', '2021-03-19 15:56:45');

-- --------------------------------------------------------

--
-- Structure de la table `appointment_fees`
--

DROP TABLE IF EXISTS `appointment_fees`;
CREATE TABLE IF NOT EXISTS `appointment_fees` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appointment_fees`
--

INSERT INTO `appointment_fees` (`id`, `title`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Appointment Fees', 'Appointment Fees', 50.00, '2021-04-15 10:51:57', '2021-04-15 10:55:44');

-- --------------------------------------------------------

--
-- Structure de la table `awards`
--

DROP TABLE IF EXISTS `awards`;
CREATE TABLE IF NOT EXISTS `awards` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `awards` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Uncategorized', 'uncategorized', 'Uncategorized', '2020-08-14 09:23:10', '2020-08-14 09:23:10'),
(2, 'Cardiology', 'cardiology', 'Cardiology', '2020-08-14 09:23:39', '2020-08-14 09:23:39'),
(3, 'Health Care', 'health-care', 'Health Care', '2020-08-14 09:23:59', '2020-08-14 09:23:59'),
(4, 'Nutritions', 'nutritions', 'Nutritions', '2020-08-14 09:24:17', '2020-08-14 09:24:17'),
(5, 'Health Tips', 'health-tips', 'Health Tips', '2020-08-14 09:24:33', '2020-08-14 09:24:33'),
(6, 'Medical Research', 'medical-research', 'Medical Research', '2020-08-14 09:24:48', '2020-08-14 09:24:48'),
(7, 'Health Treatment', 'health-treatment', 'Health Treatment', '2020-08-14 09:25:13', '2020-08-14 09:25:13');

-- --------------------------------------------------------

--
-- Structure de la table `clinics`
--

DROP TABLE IF EXISTS `clinics`;
CREATE TABLE IF NOT EXISTS `clinics` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_userid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clinics`
--

INSERT INTO `clinics` (`id`, `name`, `doctor_id`, `doctor_userid`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Clinique Santé Pour Tous', '1', '9', 'Rue Benjamin Boukpeti, Carrefour Malou, Qt. Djidjolé, Lomé – Togo', '2020-10-02 16:14:47', '2020-10-02 16:19:02');

-- --------------------------------------------------------

--
-- Structure de la table `clinic_images`
--

DROP TABLE IF EXISTS `clinic_images`;
CREATE TABLE IF NOT EXISTS `clinic_images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `clinic_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_userid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `commentable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  KEY `comments_author_type_author_id_index` (`author_type`,`author_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `commentable_type`, `commentable_id`, `body`, `author_type`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'AgilePixels\\Rateable\\Rating', 3, 'Cool comme médecin', 'App\\User', 6, '2020-12-15 15:21:32', '2020-12-15 15:21:32'),
(2, 'AgilePixels\\Rateable\\Rating', 4, 'Je l\'apprécie bien ce médecin. Toujours au petit soin des patients.', 'App\\User', 6, '2020-12-15 15:22:49', '2020-12-15 15:22:49');

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_user_id` int(11) NOT NULL,
  `second_user_id` int(11) NOT NULL,
  `is_accepted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `countries`
--

INSERT INTO `countries` (`id`, `code`, `title`, `region_id`, `created_at`, `updated_at`) VALUES
(1, 'TG', 'Togo', 1, '2020-08-31 10:16:46', '2020-08-31 10:16:46'),
(2, 'GH', 'Ghana', 1, '2020-08-31 10:20:55', '2020-08-31 10:20:55'),
(3, 'BW', 'Botswana', 5, '2020-08-31 15:33:34', '2020-08-31 15:33:34'),
(4, 'LS', 'Lesotho', 5, '2020-08-31 15:34:11', '2020-08-31 15:34:11'),
(5, 'NA', 'Namibia', 5, '2020-08-31 15:34:57', '2020-08-31 15:34:57'),
(6, 'ZA', 'South Africa', 5, '2020-08-31 15:36:58', '2020-08-31 15:36:58'),
(7, 'AO', 'Angola', 4, '2020-08-31 15:37:45', '2020-08-31 15:37:45'),
(8, 'CM', 'Cameroon', 4, '2020-08-31 15:38:23', '2020-08-31 15:38:23'),
(9, 'GA', 'Gabon', 4, '2020-08-31 15:39:01', '2020-08-31 15:39:01'),
(10, 'ST', 'Sao Tome and Principe', 4, '2020-08-31 15:39:39', '2020-08-31 15:39:39'),
(11, 'GQ', 'Equatorial Guinea', 4, '2020-08-31 15:40:13', '2020-08-31 15:40:13'),
(12, 'CF', 'Central African Republic', 4, '2020-08-31 15:41:07', '2020-08-31 15:41:07'),
(13, 'TD', 'Chad', 4, '2020-08-31 15:42:07', '2020-08-31 15:42:07'),
(14, 'CG', 'Congo', 4, '2020-08-31 15:44:11', '2020-08-31 15:44:11'),
(15, 'CD', 'Congo, Democratic Republic of the', 4, '2020-08-31 15:44:45', '2020-08-31 15:44:45'),
(16, 'DZ', 'Algeria', 3, '2020-08-31 15:45:34', '2020-08-31 15:45:34'),
(17, 'EG', 'Egypt', 3, '2020-08-31 15:48:22', '2020-08-31 15:48:22'),
(18, 'MA', 'Morroco', 3, '2020-08-31 15:49:05', '2020-08-31 15:49:05'),
(19, 'TN', 'Tunisia', 3, '2020-08-31 15:51:20', '2020-08-31 15:51:20'),
(20, 'SS', 'South Sudan', 3, '2020-08-31 15:52:44', '2020-08-31 15:52:44'),
(21, 'SD', 'Sudan', 3, '2020-08-31 15:53:30', '2020-08-31 15:53:30'),
(22, 'LI', 'Libya', 3, '2020-08-31 15:54:09', '2020-08-31 15:54:09'),
(23, 'EH', 'Western Sahara', 3, '2020-08-31 15:55:35', '2020-08-31 15:55:35'),
(24, 'ZW', 'Zimbabwe', 2, '2020-08-31 15:56:19', '2020-08-31 15:56:19'),
(25, 'ZM', 'Zambia', 2, '2020-08-31 15:59:15', '2020-08-31 15:59:15');

-- --------------------------------------------------------

--
-- Structure de la table `diseases`
--

DROP TABLE IF EXISTS `diseases`;
CREATE TABLE IF NOT EXISTS `diseases` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scientific_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` mediumtext COLLATE utf8mb4_unicode_ci,
  `treatment` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `diseases`
--

INSERT INTO `diseases` (`id`, `title`, `scientific_name`, `slug`, `description`, `cover_image`, `attach_file`, `video_url`, `treatment`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paludisme', 'malaria', 'paludisme', '<p>Le parasite du paludisme est principalement transmis, la nuit, lors de la piq&ucirc;re par une femelle moustique du genre&nbsp;<em><a href=\"https://fr.wikipedia.org/wiki/Anopheles\" title=\"Anopheles\">Anopheles</a></em>, elle-m&ecirc;me contamin&eacute;e apr&egrave;s avoir piqu&eacute; un individu atteint du paludisme. Le parasite infecte les&nbsp;<a href=\"https://fr.wikipedia.org/wiki/H%C3%A9patocyte\" title=\"Hépatocyte\">cellules h&eacute;patiques</a>&nbsp;de la victime puis circule dans le&nbsp;<a href=\"https://fr.wikipedia.org/wiki/Sang\" title=\"Sang\">sang</a>, en colonisant les&nbsp;<a href=\"https://fr.wikipedia.org/wiki/H%C3%A9matie\" title=\"Hématie\">h&eacute;maties</a>&nbsp;et en les d&eacute;truisant.</p>', 'paludisme_1604670482.jpg', NULL, NULL, '<p>L&rsquo;<em>Artemisinin-based combination therapy</em>, en&nbsp;<a href=\"https://fr.wikipedia.org/wiki/Fran%C3%A7ais\" title=\"Français\">fran&ccedil;ais</a>&nbsp;Th&eacute;rapie combin&eacute;e &agrave; base d&#39;art&eacute;misinine et en&nbsp;<a href=\"https://fr.wikipedia.org/wiki/Sigle\" title=\"Sigle\">sigle</a>&nbsp;ACT, est une&nbsp;<a href=\"https://fr.wikipedia.org/wiki/Traitement_(m%C3%A9decine)\" title=\"Traitement (médecine)\">th&eacute;rapie</a>&nbsp;et une&nbsp;<a href=\"https://fr.wikipedia.org/wiki/Pr%C3%A9vention_tertiaire\" title=\"Prévention tertiaire\">pr&eacute;vention tertiaire</a>&nbsp;dans les cas de&nbsp;<a href=\"https://fr.wikipedia.org/wiki/Paludisme#Acc%C3%A8s_palustres_simples\">paludisme simple</a>. Elle est compos&eacute;e par l&#39;association de deux&nbsp;<a href=\"https://fr.wikipedia.org/wiki/Mol%C3%A9cule\" title=\"Molécule\">mol&eacute;cules</a>&nbsp;: une mol&eacute;cule semi-synth&eacute;tique d&eacute;riv&eacute;e de l&#39;<a href=\"https://fr.wikipedia.org/wiki/Art%C3%A9misinine\" title=\"Artémisinine\">art&eacute;misinine</a>&nbsp;et une&nbsp;<a href=\"https://fr.wikipedia.org/wiki/Mol%C3%A9cule_synth%C3%A9tique\" title=\"Molécule synthétique\">mol&eacute;cule synth&eacute;tique</a>&nbsp;ayant pour r&ocirc;le d&#39;augmenter l&#39;effet de la premi&egrave;re mol&eacute;cule mais aussi de retarder l&#39;apparition de r&eacute;sistances et, ainsi, de mieux soigner le paludisme.</p>', 9, 1, '2020-11-06 13:48:02', '2020-11-06 13:48:02');

-- --------------------------------------------------------

--
-- Structure de la table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `matricule` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci,
  `gender` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `place_birth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speciality_id` int(11) DEFAULT NULL,
  `biography` mediumtext COLLATE utf8mb4_unicode_ci,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exercice_place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `apt_fees` double(8,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `doctors`
--

INSERT INTO `doctors` (`id`, `matricule`, `name`, `firstname`, `email`, `phone_number`, `address`, `gender`, `birth_date`, `place_birth`, `marital_status`, `nationality`, `profession`, `speciality_id`, `biography`, `profile_picture`, `exercice_place`, `title`, `country`, `region`, `city`, `state`, `postal_code`, `status`, `apt_fees`, `user_id`, `create_user_id`, `created_at`, `updated_at`) VALUES
(1, 'TG-1978-8-12-ADA-K-2020', 'ADAMBOUNOU', 'Kokou', 'kokou@yahoo.fr', '22897856321', 'Adidogomé, Lomé', 'M', '1978-08-12', 'Agou', NULL, NULL, NULL, 2, NULL, '5fe0adc361196.png', 'Lomé', 'PR', 'Togo', 'WEST AFRICA', 'Lomé', NULL, NULL, 1, NULL, 9, NULL, '2020-08-12 12:47:50', '2021-01-22 14:22:13'),
(2, NULL, 'AMAH', 'Koudjo', 'koudjo@gmail.com', '+2297856321', NULL, 'M', '1980-08-12', NULL, NULL, NULL, NULL, 1, NULL, 'avatar_1597415273.jpg', 'Lomé', 'DR', 'Togo', 'WEST AFRICA', 'Kara', NULL, NULL, 1, NULL, 11, NULL, '2020-08-14 13:27:53', '2020-10-02 16:23:30'),
(3, NULL, 'SEWOU', 'Firmin', 'firmin@gmail.com', '+22898564120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.jpg', 'Clinque La GLOIRE', NULL, 'Togo', 'WEST AFRICA', NULL, NULL, NULL, 0, NULL, 18, NULL, '2020-10-08 17:06:01', '2020-10-08 17:46:42'),
(4, NULL, 'SOKEGBE', 'Romain', 'romain@gmail.com', '+197456321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.jpg', 'Bon Secours', NULL, 'Togo', 'WEST AFRICA', 'Bon Secours', NULL, NULL, 0, NULL, 26, NULL, '2020-12-04 11:32:05', '2020-12-04 11:32:05');

-- --------------------------------------------------------

--
-- Structure de la table `doctor_patient`
--

DROP TABLE IF EXISTS `doctor_patient`;
CREATE TABLE IF NOT EXISTS `doctor_patient` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `doctor_id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `doctor_patient`
--

INSERT INTO `doctor_patient` (`id`, `doctor_id`, `patient_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 1, '2020-10-01 16:51:30', '2020-10-01 16:51:30');

-- --------------------------------------------------------

--
-- Structure de la table `doctor_services`
--

DROP TABLE IF EXISTS `doctor_services`;
CREATE TABLE IF NOT EXISTS `doctor_services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `service_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `doctor_services`
--

INSERT INTO `doctor_services` (`id`, `doctor_id`, `user_id`, `service_id`, `service_title`, `created_at`, `updated_at`) VALUES
(14, 1, 9, NULL, '  Tooth cleaning', '2021-01-22 14:22:13', '2021-01-22 14:22:13'),
(13, 1, 9, NULL, 'Implants', '2021-01-22 14:22:13', '2021-01-22 14:22:13');

-- --------------------------------------------------------

--
-- Structure de la table `drugs`
--

DROP TABLE IF EXISTS `drugs`;
CREATE TABLE IF NOT EXISTS `drugs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `generic_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_note` mediumtext COLLATE utf8mb4_unicode_ci,
  `drug_type_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `generic_name`, `short_note`, `drug_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Metformine', 'Metformine', 'Metformine', 1, '2020-09-24 11:02:40', '2020-09-24 11:02:40'),
(2, 'Paracétamol', 'paracetamol', 'Produit prescris pour la fiévre', 1, '2021-02-26 13:46:41', '2021-02-26 13:46:41'),
(3, 'Litacold', 'litacold', 'Produit prescris  pour le rhume', 1, '2021-02-26 13:51:24', '2021-02-26 13:51:24');

-- --------------------------------------------------------

--
-- Structure de la table `drug_types`
--

DROP TABLE IF EXISTS `drug_types`;
CREATE TABLE IF NOT EXISTS `drug_types` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `drug_types`
--

INSERT INTO `drug_types` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Comprimé', 'Comprimé', '2020-09-24 08:59:47', '2020-09-24 08:59:47'),
(2, 'Gélule', 'Catégorie des Gélules', '2020-09-24 09:00:34', '2020-09-24 09:00:34'),
(3, 'Injectable Solution', 'Solution en ampoule ou en seringue préremplie ou en stylo prérempli', '2020-09-24 09:01:02', '2020-09-24 09:08:39'),
(4, 'Sirop', 'Sirop', '2020-09-24 09:01:13', '2020-09-24 09:01:13'),
(5, 'Suppositoire', 'Le suppositoire permet de traiter des personnes ayant des difficultés à avaler les médicaments ou de traiter localement certaines affections du rectum ou de l’anus. Il doit être conservé à l’abri de la chaleur.', '2020-09-24 09:02:56', '2020-09-24 09:02:56'),
(6, 'Pommade', 'Préparations grasses', '2020-09-24 09:04:12', '2020-09-24 09:05:10'),
(7, 'Crème', 'les crèmes sont  moins grasses', '2020-09-24 09:04:54', '2020-09-24 09:04:54'),
(8, 'Gel', 'Les gels (non gras, limpides)', '2020-09-24 09:07:30', '2020-09-24 09:07:30'),
(9, 'Injectable Poudre', 'Poudre (lyophilisat) en flacon à dissoudre au moment de l’emploi,', '2020-09-24 09:09:11', '2020-09-24 09:09:11'),
(10, 'Injectable Solution pour perfusion lente', 'Solution pour perfusion lente dans une veine.', '2020-09-24 09:09:51', '2020-09-24 09:09:51');

-- --------------------------------------------------------

--
-- Structure de la table `education`
--

DROP TABLE IF EXISTS `education`;
CREATE TABLE IF NOT EXISTS `education` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `degree` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `institute` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_completion` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `examination_files`
--

DROP TABLE IF EXISTS `examination_files`;
CREATE TABLE IF NOT EXISTS `examination_files` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `patient_userid` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_userid` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
CREATE TABLE IF NOT EXISTS `experiences` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `exercice_place` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` longtext COLLATE utf8mb4_unicode_ci,
  `answer` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, '<p>What is Telemedicine?</p>', '<p>Telemedicine can be defined as the use of technology (computers, video, phone, messaging) by a medical professional to diagnose and treat patients in a remote location.</p>', 0, '2021-02-05 12:46:27', '2021-02-05 13:34:13'),
(3, '<p>Is telemedicine safe?</p>', '<p>Yes. When used under the right conditions and for appropriate cases, telemedicine has been shown to be as safe and effective as in-person care. Of course, not every condition is conducive to treatment via video visits, so providers must use good judgement when leveraging this channel for healthcare delivery.</p>', 0, '2021-02-05 12:55:42', '2021-02-05 13:34:45'),
(4, '<p>What are telemedicine requirements?</p>', '<p>Telemedicine requires high speed internet (for video quality), a computer or smartphone, a secure HIPAA compliant medium, and a private quiet place for the appointments.</p>', 0, '2021-02-05 12:56:43', '2021-02-05 13:34:52'),
(5, '<p>What is the difference between telemedicine and telehealth?</p>', '<p>Telemedicine is the use of technology to assist in remote clinical services while telehealth includes telemedicine, and non-clinical services such as virtual physician to physician discussions, virtual provider referrals, training, CMEs, etc.</p>', 0, '2021-02-05 12:59:38', '2021-02-05 13:35:00');

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favourites`
--

DROP TABLE IF EXISTS `favourites`;
CREATE TABLE IF NOT EXISTS `favourites` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `doctor_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `doctor_id`, `created_at`, `updated_at`) VALUES
(23, 6, 1, '2020-12-22 13:27:09', '2020-12-22 13:27:09');

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `conversation_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `group_conversations`
--

DROP TABLE IF EXISTS `group_conversations`;
CREATE TABLE IF NOT EXISTS `group_conversations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `group_users`
--

DROP TABLE IF EXISTS `group_users`;
CREATE TABLE IF NOT EXISTS `group_users` (
  `group_conversation_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `histories`
--

DROP TABLE IF EXISTS `histories`;
CREATE TABLE IF NOT EXISTS `histories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `table` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `histories`
--

INSERT INTO `histories` (`id`, `action`, `table`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Update Patient Profile', 'User/Patient', 6, '2020-09-04 12:52:12', '2020-09-04 12:52:12'),
(2, 'Update Patient Profile', 'User/Patient', 6, '2020-09-04 12:57:42', '2020-09-04 12:57:42'),
(3, 'Create', 'Schedule', 9, '2020-09-10 17:25:12', '2020-09-10 17:25:12'),
(4, 'Create', 'Schedule', 9, '2020-09-10 17:47:40', '2020-09-10 17:47:40'),
(5, 'Create', 'Schedule', 9, '2020-09-10 17:49:10', '2020-09-10 17:49:10'),
(6, 'Create', 'Appointment', 6, '2020-09-16 12:00:46', '2020-09-16 12:00:46'),
(7, 'Create', 'Appointment', 6, '2020-09-16 12:08:17', '2020-09-16 12:08:17'),
(8, 'Create', 'Appointment', 6, '2020-09-16 12:11:21', '2020-09-16 12:11:21'),
(9, 'Create', 'Appointment', 6, '2020-09-16 12:13:05', '2020-09-16 12:13:05'),
(10, 'Create', 'Appointment', 6, '2020-09-16 12:29:38', '2020-09-16 12:29:38'),
(11, 'Create', 'Appointment', 6, '2020-09-16 17:37:44', '2020-09-16 17:37:44'),
(12, 'Create', 'Appointment', 6, '2020-10-01 16:51:02', '2020-10-01 16:51:02'),
(13, 'Create', 'Prescription', 9, '2020-10-01 18:14:19', '2020-10-01 18:14:19'),
(14, 'Create', 'Prescription', 9, '2020-10-01 18:20:21', '2020-10-01 18:20:21'),
(15, 'Create', 'Prescription', 9, '2020-10-02 09:39:18', '2020-10-02 09:39:18'),
(16, 'Create', 'Prescription', 9, '2020-10-02 09:40:03', '2020-10-02 09:40:03'),
(17, 'Update Doctor Profile', 'User/Doctor', 9, '2020-10-02 16:17:39', '2020-10-02 16:17:39'),
(18, 'Update Doctor Profile', 'User/Doctor', 9, '2020-10-02 16:19:02', '2020-10-02 16:19:02'),
(19, 'Update Doctor Profile', 'User/Doctor', 9, '2020-10-02 16:21:38', '2020-10-02 16:21:38'),
(20, 'Update Doctor Profile', 'User/Doctor', 9, '2020-10-02 16:21:48', '2020-10-02 16:21:48'),
(21, 'Create', 'Appointment', 6, '2020-11-03 15:34:51', '2020-11-03 15:34:51'),
(22, 'Create', 'Appointment', 6, '2020-11-11 13:21:38', '2020-11-11 13:21:38'),
(23, 'Create', 'Appointment', 6, '2020-11-11 13:22:41', '2020-11-11 13:22:41'),
(24, 'Create', 'Appointment', 6, '2020-11-11 13:27:18', '2020-11-11 13:27:18'),
(25, 'Create', 'Appointment', 6, '2020-11-11 13:28:22', '2020-11-11 13:28:22'),
(26, 'Create', 'Appointment', 6, '2020-11-11 15:03:21', '2020-11-11 15:03:21'),
(27, 'Create', 'Appointment', 6, '2020-11-11 15:08:33', '2020-11-11 15:08:33'),
(28, 'Create', 'Appointment', 6, '2020-11-11 16:17:31', '2020-11-11 16:17:31'),
(29, 'Create', 'Appointment', 6, '2020-11-11 16:18:34', '2020-11-11 16:18:34'),
(30, 'Create', 'Appointment', 6, '2020-11-11 16:19:34', '2020-11-11 16:19:34'),
(31, 'Create', 'Appointment', 6, '2020-11-11 16:20:08', '2020-11-11 16:20:08'),
(32, 'Create', 'Appointment', 6, '2020-11-11 16:21:09', '2020-11-11 16:21:09'),
(33, 'Create', 'Appointment', 6, '2020-11-11 16:26:47', '2020-11-11 16:26:47'),
(34, 'Create', 'Appointment', 6, '2020-11-12 16:30:24', '2020-11-12 16:30:24'),
(35, 'Create', 'Appointment', 6, '2020-11-12 16:37:35', '2020-11-12 16:37:35'),
(36, 'Create', 'Appointment', 6, '2020-11-12 16:38:46', '2020-11-12 16:38:46'),
(37, 'Create', 'Appointment', 6, '2020-11-12 16:39:58', '2020-11-12 16:39:58'),
(38, 'Create', 'Appointment', 6, '2020-11-12 16:52:54', '2020-11-12 16:52:54'),
(39, 'Create', 'Appointment', 6, '2020-11-12 16:58:16', '2020-11-12 16:58:16'),
(40, 'Create', 'Appointment', 6, '2020-11-18 17:39:27', '2020-11-18 17:39:27'),
(41, 'Create', 'Appointment', 6, '2020-11-19 20:17:23', '2020-11-19 20:17:23'),
(42, 'Create', 'Schedule', 9, '2020-12-11 19:49:37', '2020-12-11 19:49:37'),
(43, 'Create', 'Schedule', 9, '2020-12-11 19:53:53', '2020-12-11 19:53:53'),
(44, 'Create', 'Schedule', 9, '2020-12-11 19:53:53', '2020-12-11 19:53:53'),
(45, 'Create', 'Schedule', 9, '2020-12-11 19:53:53', '2020-12-11 19:53:53'),
(46, 'Create', 'Schedule', 9, '2020-12-11 20:20:08', '2020-12-11 20:20:08'),
(47, 'Create', 'Schedule', 9, '2020-12-11 20:20:08', '2020-12-11 20:20:08'),
(48, 'Create', 'Schedule', 9, '2020-12-11 20:20:08', '2020-12-11 20:20:08'),
(49, 'Create', 'Schedule', 9, '2020-12-11 20:20:08', '2020-12-11 20:20:08'),
(50, 'Create', 'Schedule', 9, '2020-12-11 20:23:01', '2020-12-11 20:23:01'),
(51, 'Create', 'Schedule', 9, '2020-12-11 20:23:01', '2020-12-11 20:23:01'),
(52, 'Create', 'Schedule', 9, '2020-12-11 20:25:40', '2020-12-11 20:25:40'),
(53, 'Create', 'Schedule', 9, '2020-12-11 20:26:51', '2020-12-11 20:26:51'),
(54, 'Create', 'Schedule', 9, '2020-12-11 20:26:51', '2020-12-11 20:26:51'),
(55, 'Create', 'Schedule', 9, '2020-12-11 20:26:51', '2020-12-11 20:26:51'),
(56, 'Create', 'Schedule', 9, '2020-12-11 20:26:51', '2020-12-11 20:26:51'),
(57, 'Create', 'Schedule', 9, '2020-12-11 20:26:51', '2020-12-11 20:26:51'),
(58, 'Create', 'Schedule', 9, '2020-12-14 19:05:23', '2020-12-14 19:05:23'),
(59, 'Create', 'Schedule', 9, '2020-12-15 11:50:02', '2020-12-15 11:50:02'),
(60, 'Create', 'Schedule', 9, '2020-12-15 11:51:04', '2020-12-15 11:51:04'),
(61, 'Create', 'Schedule', 9, '2020-12-15 11:51:04', '2020-12-15 11:51:04'),
(62, 'Create', 'Schedule', 9, '2020-12-15 11:52:00', '2020-12-15 11:52:00'),
(63, 'Create', 'Schedule', 9, '2020-12-15 11:53:13', '2020-12-15 11:53:13'),
(64, 'Create', 'Schedule', 9, '2020-12-15 11:53:13', '2020-12-15 11:53:13'),
(65, 'Create', 'Schedule', 9, '2020-12-15 11:53:13', '2020-12-15 11:53:13'),
(66, 'Create', 'Schedule', 9, '2020-12-15 11:53:13', '2020-12-15 11:53:13'),
(67, 'Create', 'Schedule', 9, '2020-12-15 11:53:13', '2020-12-15 11:53:13'),
(68, 'Update Doctor Profile', 'User/Doctor', 9, '2020-12-15 18:41:12', '2020-12-15 18:41:12'),
(69, 'Update Doctor Profile', 'User/Doctor', 9, '2020-12-16 09:41:18', '2020-12-16 09:41:18'),
(70, 'Update Doctor Profile', 'User/Doctor', 9, '2020-12-16 10:12:11', '2020-12-16 10:12:11'),
(71, 'Update Doctor Profile', 'User/Doctor', 9, '2020-12-16 10:19:24', '2020-12-16 10:19:24'),
(72, 'Update Doctor Profile', 'User/Doctor', 9, '2020-12-16 10:33:28', '2020-12-16 10:33:28'),
(73, 'Update Doctor Profile', 'User/Doctor', 9, '2020-12-17 15:58:32', '2020-12-17 15:58:32'),
(74, 'Update Doctor Profile', 'User/Doctor', 9, '2020-12-17 16:42:13', '2020-12-17 16:42:13'),
(75, 'Update Doctor Profile', 'User/Doctor', 9, '2020-12-17 16:42:31', '2020-12-17 16:42:31'),
(76, 'Update Doctor Profile', 'User/Doctor', 9, '2020-12-17 18:53:26', '2020-12-17 18:53:26'),
(77, 'Update Patient Profile', 'User/Patient', 6, '2020-12-17 19:41:34', '2020-12-17 19:41:34'),
(78, 'Update Patient Profile', 'User/Patient', 6, '2020-12-17 19:41:41', '2020-12-17 19:41:41'),
(79, 'Update Patient Profile', 'User/Patient', 6, '2020-12-17 19:44:19', '2020-12-17 19:44:19'),
(80, 'Update Patient Profile', 'User/Patient', 6, '2020-12-17 19:44:42', '2020-12-17 19:44:42'),
(81, 'Update Doctor Profile', 'User/Doctor', 9, '2020-12-17 19:45:17', '2020-12-17 19:45:17'),
(82, 'Update Patient Profile', 'User/Patient', 6, '2020-12-21 13:43:09', '2020-12-21 13:43:09'),
(83, 'Update Patient Profile', 'User/Patient', 6, '2020-12-21 13:43:24', '2020-12-21 13:43:24'),
(84, 'Update Patient Profile', 'User/Patient', 6, '2020-12-21 13:45:31', '2020-12-21 13:45:31'),
(85, 'Update Doctor Profile', 'User/Doctor', 9, '2020-12-21 14:14:40', '2020-12-21 14:14:40'),
(86, 'Create', 'Appointment', 6, '2020-12-23 10:58:48', '2020-12-23 10:58:48'),
(87, 'Update Patient Profile', 'User/Patient', 6, '2021-01-22 14:21:35', '2021-01-22 14:21:35'),
(88, 'Update Doctor Profile', 'User/Doctor', 9, '2021-01-22 14:22:13', '2021-01-22 14:22:13'),
(89, 'Create', 'User/Pharmacy', 1, '2021-02-04 12:33:25', '2021-02-04 12:33:25'),
(90, 'Update', 'User/Pharmacy', 1, '2021-02-04 12:48:27', '2021-02-04 12:48:27'),
(91, 'Update', 'User/Pharmacy', 1, '2021-02-04 13:14:31', '2021-02-04 13:14:31'),
(92, 'Update', 'User/Pharmacy', 1, '2021-02-04 13:20:06', '2021-02-04 13:20:06'),
(93, 'Create', 'Supplier', 2, '2021-02-25 19:49:30', '2021-02-25 19:49:30'),
(94, 'Update', 'Supplier', 2, '2021-02-25 19:50:51', '2021-02-25 19:50:51'),
(95, 'Create', 'Appointment', 6, '2021-03-19 15:22:37', '2021-03-19 15:22:37'),
(96, 'Create', 'Appointment', 6, '2021-03-19 15:52:31', '2021-03-19 15:52:31'),
(97, 'Create', 'Prescription', 9, '2021-03-19 17:15:44', '2021-03-19 17:15:44'),
(98, 'Create', 'Prescription', 9, '2021-03-19 17:16:50', '2021-03-19 17:16:50');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_id` bigint(20) DEFAULT NULL,
  `to_id` bigint(20) DEFAULT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `conversation_id` int(11) DEFAULT NULL,
  `conversation_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `type`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `conversation_id`, `conversation_type`, `user_id`, `text`, `created_at`, `updated_at`) VALUES
(2066335003, 'user', 9, 6, 'hi', NULL, 1, NULL, NULL, NULL, NULL, '2020-09-15 16:02:38', '2020-09-15 16:27:51'),
(2415242958, 'user', 6, 9, 'hi', NULL, 1, NULL, NULL, NULL, NULL, '2020-09-15 16:27:54', '2020-09-15 16:58:52'),
(2195467226, 'user', 6, 9, '', '5eb78332-ee2b-4a51-9a89-d0a3568c472a.jpg,blog-10.jpg', 1, NULL, NULL, NULL, NULL, '2020-09-15 16:28:05', '2020-09-15 16:58:52');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_admins_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(7, '2016_06_01_000004_create_oauth_clients_table', 1),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2020_07_08_000307_create_permission_tables', 1),
(11, '2020_07_29_142031_create_specialities_table', 2),
(12, '2019_04_09_192439_create_comments_table', 3),
(13, '2019_04_09_192440_create_ratings_table', 3),
(26, '2020_07_29_174724_create_categories_table', 8),
(15, '2020_07_29_174939_create_awards_table', 4),
(16, '2020_07_29_175257_create_experiences_table', 4),
(17, '2020_07_29_175922_create_education_table', 4),
(24, '2020_08_04_165150_create_posts_table', 6),
(19, '2020_07_29_180913_create_patients_table', 4),
(20, '2020_07_29_181514_create_histories_table', 4),
(23, '2020_07_29_180841_create_doctors_table', 6),
(55, '2019_09_22_192348_create_messages_table', 14),
(27, '2014_01_07_073615_create_tagged_table', 9),
(28, '2014_01_07_073615_create_tags_table', 9),
(29, '2016_06_29_073615_create_tag_groups_table', 9),
(30, '2016_06_29_073615_update_tags_table', 9),
(31, '2020_03_13_083515_add_description_to_tags_table', 9),
(43, '2019_10_20_211056_add_messenger_color_to_users', 13),
(33, '2020_08_19_120959_create_patient_records_table', 10),
(34, '2020_08_19_121046_create_timeslots_table', 10),
(42, '2019_10_18_223259_add_avatar_to_users', 13),
(36, '2020_08_28_175557_create_regions_table', 10),
(37, '2020_08_28_175656_create_countries_table', 10),
(41, '2019_10_16_211433_create_favorites_table', 13),
(39, '2020_09_10_153933_create_schedules_table', 11),
(44, '2019_10_22_000539_add_dark_mode_to_users', 13),
(45, '2019_10_25_214038_add_active_status_to_users', 13),
(46, '2020_08_19_120929_create_appointments_table', 13),
(47, '2020_08_19_122746_create_payments_table', 13),
(48, '2020_09_15_123016_create_drug_types_table', 13),
(64, '2020_09_15_123253_create_drugs_table', 19),
(68, '2020_09_15_125005_create_prescriptions_table', 21),
(51, '2020_09_15_125017_create_prescription_types_table', 13),
(69, '2020_09_15_125901_create_prescribed_drugs_table', 22),
(53, '2020_09_15_125929_create_examination_files_table', 13),
(54, '2020_09_15_142553_create_doctor_patient_table', 13),
(56, '2020_09_15_170705_create_favourites_table', 15),
(57, '2017_10_16_084042_create_conversations_table', 16),
(58, '2017_10_21_165446_create_group_conversations_table', 17),
(59, '2017_10_21_172616_create_group_users_table', 17),
(60, '2017_10_25_165610_add_is_accepted_column_to_conversation_table', 17),
(61, '2017_11_07_224816_create_files_table', 17),
(62, '2020_09_23_092502_create_services_table', 18),
(76, '2020_12_17_145922_create_doctor_services_table', 28),
(66, '2020_10_01_143441_create_clinics_table', 20),
(67, '2020_10_01_143601_create_clinic_images_table', 20),
(70, '2020_11_03_103744_create_diseases_table', 23),
(71, '2020_12_09_140237_create_signatures_table', 24),
(72, '2020_12_14_155006_create_notifications_table', 25),
(73, '2020_12_15_132035_create_reviews_table', 26),
(75, '2020_12_15_132058_create_answers_table', 27),
(78, '2021_01_29_163102_create_pharmacies_table', 29),
(79, '2021_02_03_155140_create_faqs_table', 30),
(80, '2021_02_25_174733_create_pharmacy_drugs_table', 31),
(86, '2021_02_25_181410_create_orders_table', 34),
(85, '2021_02_25_182949_create_suppliers_table', 33),
(87, '2021_02_25_192703_create_ordered_drugs_table', 34),
(88, '2021_04_15_105742_create_appointment_fees_table', 35);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 10),
(1, 'App\\User', 13),
(2, 'App\\User', 5),
(2, 'App\\User', 6),
(2, 'App\\User', 12),
(2, 'App\\User', 17),
(2, 'App\\User', 21),
(2, 'App\\User', 22),
(2, 'App\\User', 23),
(2, 'App\\User', 24),
(2, 'App\\User', 25),
(2, 'App\\User', 27),
(2, 'App\\User', 28),
(2, 'App\\User', 29),
(2, 'App\\User', 30),
(2, 'App\\User', 36),
(2, 'App\\User', 37),
(2, 'App\\User', 38),
(2, 'App\\User', 40),
(3, 'App\\User', 7),
(3, 'App\\User', 8),
(3, 'App\\User', 9),
(3, 'App\\User', 11),
(3, 'App\\User', 18),
(3, 'App\\User', 26),
(3, 'App\\User', 31),
(3, 'App\\User', 32),
(3, 'App\\User', 33),
(3, 'App\\User', 34),
(3, 'App\\User', 35),
(3, 'App\\User', 39),
(4, 'App\\User', 41),
(4, 'App\\User', 42),
(4, 'App\\User', 43);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` mediumtext COLLATE utf8mb4_unicode_ci,
  `reception_date` datetime DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `notif_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `object` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Telemed_AAH Personal Access Client', 'mnujbYMRWusrriZ5R75m0ymkkbruK13irx2UCYFL', NULL, 'http://localhost', 1, 0, 0, '2020-07-08 16:50:52', '2020-07-08 16:50:52'),
(2, NULL, 'Telemed_AAH Password Grant Client', 'rUWfUU28zgqz91pPVK9BDjeRlOlJGLLVQJ5Lyuvq', 'users', 'http://localhost', 0, 1, 0, '2020-07-08 16:50:52', '2020-07-08 16:50:52');

-- --------------------------------------------------------

--
-- Structure de la table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-07-08 16:50:52', '2020-07-08 16:50:52');

-- --------------------------------------------------------

--
-- Structure de la table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ordered_drugs`
--

DROP TABLE IF EXISTS `ordered_drugs`;
CREATE TABLE IF NOT EXISTS `ordered_drugs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `drug_id` int(11) DEFAULT NULL,
  `expire_at` date DEFAULT NULL,
  `pharmacy_id` int(11) DEFAULT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qte_stock` int(11) DEFAULT NULL,
  `ht` double(8,2) DEFAULT NULL,
  `tt` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pharmacy_id` int(11) DEFAULT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_status` tinyint(1) NOT NULL DEFAULT '0',
  `amount` double(8,2) DEFAULT NULL,
  `delivered_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `matricule` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gender` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `place_birth` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ethnic_group` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rhesus` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `doctor_user_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `last_visit` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`id`, `matricule`, `name`, `firstname`, `email`, `phone_number`, `address`, `gender`, `birth_date`, `place_birth`, `marital_status`, `nationality`, `ethnic_group`, `blood_group`, `rhesus`, `profession`, `profile_picture`, `status`, `city`, `state`, `region`, `country`, `postal_code`, `doctor_id`, `doctor_user_id`, `user_id`, `last_visit`, `created_at`, `updated_at`) VALUES
(1, 'TG1980512ABAK2020', 'ABALO', 'Koffi', 'koffi@gmail.com', '22897079384', 'Lomé-Togo', 'M', '1980-05-12', 'Agou', 'Célibataire', NULL, NULL, 'A', '-', NULL, '5fe0a6f981279.png', 1, 'Lomé', NULL, 'WEST AFRICA', 'Togo', NULL, NULL, NULL, 6, NULL, '2020-08-04 16:13:47', '2021-01-22 14:21:35'),
(2, NULL, 'SOSSOU', 'Franck', 'franck@gmail.com', '+22895631259', 'Lomé-Togo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, '2020-08-14 13:29:41', '2020-08-14 13:29:41'),
(3, NULL, 'ATCHOUNOUGLO', 'Kossi', 'kossi@gmail.com', '97123654', 'Lomé-Togo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, NULL, '2020-10-08 17:04:32', '2020-10-08 17:04:32'),
(16, 'TG19931229ROUF2021', 'ROUKIYA', 'Franck', 'prodigegraphics@gmail.com', '97856321', 'Lomé', NULL, '1993-12-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.jpg', 0, 'Lomé', NULL, NULL, 'Togo', NULL, NULL, NULL, 40, NULL, '2021-01-19 18:22:50', '2021-01-19 18:22:50');

-- --------------------------------------------------------

--
-- Structure de la table `patient_records`
--

DROP TABLE IF EXISTS `patient_records`;
CREATE TABLE IF NOT EXISTS `patient_records` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_user_id` int(11) NOT NULL,
  `patient_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `apt_id` int(11) NOT NULL,
  `paymentmode_id` int(11) DEFAULT NULL,
  `apt_amount` double(8,2) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_user_id` int(11) NOT NULL,
  `patient_user_id` int(11) NOT NULL,
  `tx_reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_payment` datetime DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  `identifier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `payments`
--

INSERT INTO `payments` (`id`, `apt_id`, `paymentmode_id`, `apt_amount`, `description`, `doctor_id`, `patient_id`, `doctor_user_id`, `patient_user_id`, `tx_reference`, `date_payment`, `telephone`, `identifier`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1.00, 'Patient ABALO Koffi Appointment Payment', 1, 1, 9, 6, NULL, '2021-03-19 15:25:51', NULL, 'nmnbjkgzf', 1, '2021-03-19 15:22:37', '2021-03-19 15:25:51'),
(2, 2, 3, 1.00, 'Patient ABALO Koffi Appointment Payment', 1, 1, 9, 6, NULL, '2021-03-19 15:53:07', NULL, 'c2i7f1fd3', 1, '2021-03-19 15:52:31', '2021-03-19 15:53:07');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin Permissions', 'web', '2020-07-08 17:28:30', '2020-07-08 17:28:30'),
(2, 'Patient Permissions', 'web', '2020-08-04 15:23:24', '2020-08-04 15:23:24'),
(3, 'Doctor Permissions', 'web', '2020-08-04 15:24:22', '2020-08-04 15:24:22'),
(4, 'Pharmacy Permissions', 'web', '2021-02-02 16:11:02', '2021-02-02 16:11:02');

-- --------------------------------------------------------

--
-- Structure de la table `pharmacies`
--

DROP TABLE IF EXISTS `pharmacies`;
CREATE TABLE IF NOT EXISTS `pharmacies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `registration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slogan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biography` mediumtext COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci,
  `creation_date` date DEFAULT NULL,
  `proof_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `director_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pharmacies_phone_number_unique` (`phone_number`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pharmacies`
--

INSERT INTO `pharmacies` (`id`, `registration`, `matricule`, `name`, `firstname`, `logo`, `profile_picture`, `slogan`, `biography`, `email`, `username`, `phone_number`, `address`, `creation_date`, `proof_file`, `open_time`, `end_time`, `country`, `region`, `city`, `state`, `postal_code`, `user_id`, `director_name`, `create_user_id`, `status`, `email_verified_at`, `is_activated`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'TFG214GB32', 'TG-2010-4-21-PHA', 'PHARMACIE BETHEL', NULL, 'dc325f448fdc8c3e268bd44ba0c36b70_1612442907.jpg', 'avatar.jpg', 'Chez nous le client est roi', 'Génériques et Contraceptifs', 'bethel@gmail.com', NULL, '+22898563512', 'Lomé', '2010-04-21', NULL, NULL, NULL, 'Togo', 'WEST AFRICA', 'Lomé', NULL, NULL, 42, 'Mr AMAH KWATCHA', NULL, 0, NULL, 0, '$2y$10$9yGRbi5jprDXJhbc7ZS46ej6S.SWh2IZDl7ppZXYjsvAV4vGzfYYq', NULL, '2021-02-02 18:52:33', '2021-02-04 13:20:06'),
(2, 'TR17AS2012', NULL, 'PHARMACIE NABIL', NULL, 'logos-pharmacie-mis_1198-60_1612442004.jpg', 'avatar.jpg', 'Votre satisfaction notre mission', 'Vente de génériques de tout genre', 'nabil@gmail.com', NULL, '98745632', 'Gaglé', '2014-12-14', NULL, NULL, NULL, 'Togo', 'WEST AFRICA', 'Tsévié', NULL, NULL, 43, 'Mr JOHN DOE', 1, 1, NULL, 1, '$2y$10$dpsnC2ScsAs/KrmhW6DalOJXyR3Stx8VZ1xv69KZlmunWFweFyQs.', NULL, '2021-02-04 12:33:25', '2021-02-05 14:01:47');

-- --------------------------------------------------------

--
-- Structure de la table `pharmacy_drugs`
--

DROP TABLE IF EXISTS `pharmacy_drugs`;
CREATE TABLE IF NOT EXISTS `pharmacy_drugs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `drug_id` int(11) DEFAULT NULL,
  `pharmacy_id` int(11) DEFAULT NULL,
  `q_stock` int(11) DEFAULT NULL,
  `q_minimum` int(11) DEFAULT NULL,
  `unit_ht` double(8,2) DEFAULT NULL,
  `unit_tt` double(8,2) DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pharmacy_drugs`
--

INSERT INTO `pharmacy_drugs` (`id`, `drug_id`, `pharmacy_id`, `q_stock`, `q_minimum`, `unit_ht`, `unit_tt`, `discount`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 0, 5, 100.00, 150.00, 0.00, 'Metformine pour diabètique', 1, '2021-02-26 16:24:24', '2021-02-26 16:24:24'),
(2, 2, 2, 0, 10, 20.00, 25.00, 0.00, 'Paracétamol', 1, '2021-02-26 16:58:26', '2021-02-26 16:58:26');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `description`, `body`, `cover_image`, `attach_file`, `video_url`, `category_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'What are the benefits of Online Doctor Booking?', 'what-are-the-benefits-of-online-doctor-booking', 'The benefits of Online Doctor Booking', '<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>', 'blog-02_1597426838.jpg', NULL, NULL, 3, 9, 1, '2020-08-14 16:40:38', '2020-12-02 18:23:13'),
(2, 'Doccure – Making your clinic painless visit?', 'doccure-making-your-clinic-painless-visit', 'Lorem ipsum dolor sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>', 'blog-01_1599732179.jpg', NULL, NULL, 1, 9, 1, '2020-09-10 09:02:14', '2020-09-10 09:03:29'),
(3, 'Benefits of consulting with an Online Doctor', 'benefits-of-consulting-with-an-online-doctor', 'Lorem ipsum dolor sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>', 'blog-03_1599732695.jpg', NULL, NULL, 1, 9, 1, '2020-09-10 09:11:35', '2020-09-10 09:11:46'),
(4, '5 Great reasons to use an Online Doctor', '5-great-reasons-to-use-an-online-doctor', 'Lorem ipsum dolor sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>', 'blog-04_1599732793.jpg', NULL, NULL, 1, 9, 1, '2020-09-10 09:13:13', '2020-09-10 09:13:13'),
(5, 'Online Doctor Appointment Scheduling', 'online-doctor-appointment-scheduling', 'Lorem ipsum dolor sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>', 'blog-05_1599732881.jpg', NULL, NULL, 1, 9, 1, '2020-09-10 09:14:22', '2020-09-10 09:14:41'),
(6, 'Simple steps to make your doctor visits exceptional!', 'simple-steps-to-make-your-doctor-visits-exceptional', 'Lorem ipsum dolor sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>', 'blog-06_1599732941.jpg', NULL, NULL, 5, 9, 1, '2020-09-10 09:15:41', '2020-09-10 09:15:41'),
(7, 'Choose your own Online Doctor Appointment', 'choose-your-own-online-doctor-appointment', 'Lorem ipsum dolor sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>', 'blog-07_1599733176.jpg', NULL, NULL, 1, 9, 1, '2020-09-10 09:19:36', '2020-09-10 09:19:36'),
(8, 'Simple steps to visit your doctor today', 'simple-steps-to-visit-your-doctor-today', 'Lorem ipsum dolor sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>', 'blog-08_1599733978.jpg', NULL, NULL, 1, 9, 0, '2020-09-10 09:32:58', '2020-09-10 09:35:17'),
(9, '5 Great reasons to use an Online Doctor', '5-great-reasons-to-use-an-online-doctor-1', 'Lorem ipsum dolor sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>', 'blog-09_1599734049.jpg', NULL, NULL, 1, 9, 1, '2020-09-10 09:33:53', '2020-09-10 09:34:09'),
(10, 'Online Doctoral Programs', 'online-doctoral-programs', 'Lorem ipsum dolor sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>', 'blog-10_1599734097.jpg', NULL, NULL, 1, 9, 1, '2020-09-10 09:34:57', '2020-09-10 09:34:57');

-- --------------------------------------------------------

--
-- Structure de la table `prescribed_drugs`
--

DROP TABLE IF EXISTS `prescribed_drugs`;
CREATE TABLE IF NOT EXISTS `prescribed_drugs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `patient_userid` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_userid` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `drugtype_id` int(11) DEFAULT NULL,
  `drug_id` int(11) NOT NULL,
  `drug_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `strength` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dose` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advice` mediumtext COLLATE utf8mb4_unicode_ci,
  `morning` tinyint(1) NOT NULL DEFAULT '0',
  `afternoon` tinyint(1) NOT NULL DEFAULT '0',
  `evening` tinyint(1) NOT NULL DEFAULT '0',
  `night` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prescribed_drugs`
--

INSERT INTO `prescribed_drugs` (`id`, `patient_id`, `patient_userid`, `doctor_id`, `doctor_userid`, `appointment_id`, `prescription_id`, `drugtype_id`, `drug_id`, `drug_name`, `quantity`, `strength`, `dose`, `duration`, `advice`, `morning`, `afternoon`, `evening`, `night`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, 9, 2, 1, NULL, 2, 'Paracétamol', 1, '500mg', NULL, '14', NULL, 1, 1, 1, 0, '2021-03-19 17:16:50', '2021-03-19 17:16:50');

-- --------------------------------------------------------

--
-- Structure de la table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE IF NOT EXISTS `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prescriptionType_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `patient_userid` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_userid` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `chief_complains` mediumtext COLLATE utf8mb4_unicode_ci,
  `on_examinations` mediumtext COLLATE utf8mb4_unicode_ci,
  `provisional_diagnosis` mediumtext COLLATE utf8mb4_unicode_ci,
  `differential_diagnosis` mediumtext COLLATE utf8mb4_unicode_ci,
  `lab_workup` mediumtext COLLATE utf8mb4_unicode_ci,
  `advices` mediumtext COLLATE utf8mb4_unicode_ci,
  `reason` mediumtext COLLATE utf8mb4_unicode_ci,
  `height` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pulse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_pressure` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity_med` int(11) DEFAULT NULL,
  `next_visit` date DEFAULT NULL,
  `identifier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `prescriptionType_id`, `patient_id`, `patient_userid`, `doctor_id`, `doctor_userid`, `appointment_id`, `chief_complains`, `on_examinations`, `provisional_diagnosis`, `differential_diagnosis`, `lab_workup`, `advices`, `reason`, `height`, `weight`, `pulse`, `blood_pressure`, `quantity_med`, `next_visit`, `identifier`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 6, 1, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'c2i7f1fd3', '2021-03-19 17:16:50', '2021-03-19 17:16:50');

-- --------------------------------------------------------

--
-- Structure de la table `prescription_types`
--

DROP TABLE IF EXISTS `prescription_types`;
CREATE TABLE IF NOT EXISTS `prescription_types` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prescription_types`
--

INSERT INTO `prescription_types` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Pharmacie', 'Ordonnance de pharmacie', '2020-10-05 11:14:10', '2020-10-05 11:14:10'),
(2, 'Biologie', 'Ordonnance de Biologie', '2020-10-05 11:14:47', '2020-10-05 11:14:47'),
(3, 'Radiologie', 'Ordonnance de Radiologie', '2020-10-05 11:15:03', '2020-10-05 11:15:13');

-- --------------------------------------------------------

--
-- Structure de la table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rating` int(11) NOT NULL,
  `rateable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rateable_id` bigint(20) UNSIGNED NOT NULL,
  `author_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_rateable_type_rateable_id_index` (`rateable_type`,`rateable_id`),
  KEY `ratings_author_type_author_id_index` (`author_type`,`author_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ratings`
--

INSERT INTO `ratings` (`id`, `rating`, `rateable_type`, `rateable_id`, `author_type`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 4, 'App\\Doctor', 1, 'App\\User', 6, '2020-09-23 08:54:21', '2020-09-23 08:54:21'),
(3, 4, 'App\\Doctor', 2, 'App\\User', 6, '2020-12-15 15:21:32', '2020-12-15 15:21:32'),
(4, 4, 'App\\Doctor', 1, 'App\\User', 6, '2020-12-15 15:22:49', '2020-12-15 15:22:49');

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'WEST AFRICA', 'West Africa Region', '2020-08-31 10:04:24', '2020-08-31 10:04:24'),
(2, 'EAST AFRICA', 'East Africa Region', '2020-08-31 10:05:05', '2020-08-31 10:05:05'),
(3, 'NORTHEN AFRICA', 'Northen Africa Region', '2020-08-31 10:05:52', '2020-08-31 10:05:52'),
(4, 'MIDDLE AFRICA', 'Middle Africa Region', '2020-08-31 10:06:19', '2020-08-31 10:06:19'),
(5, 'SOUTHERN AFRICA', 'Southern Africa Region', '2020-08-31 10:06:58', '2020-08-31 10:06:58');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci,
  `rating` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `doctor_user_id` int(11) DEFAULT NULL,
  `recommend` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approuved` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `title`, `body`, `rating`, `patient_id`, `user_id`, `doctor_id`, `doctor_user_id`, `recommend`, `approuved`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Cool comme médecin', 4, 1, 6, 2, 11, NULL, 1, '2020-12-15 15:21:32', '2020-12-15 15:21:32'),
(2, NULL, 'Je l\'apprécie bien ce médecin. Toujours au petit soin des patients.', 4, 1, 6, 1, 9, NULL, 1, '2020-12-15 15:22:49', '2020-12-15 15:22:49');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2020-07-08 17:28:29', '2020-07-08 17:28:29'),
(2, 'Patient', 'web', '2020-08-04 15:23:54', '2020-08-04 15:23:54'),
(3, 'Doctor', 'web', '2020-08-04 15:25:01', '2020-08-04 15:25:01'),
(4, 'Pharmacy', 'web', '2021-02-02 16:11:20', '2021-02-02 16:11:20');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `doctor_userid` int(11) NOT NULL,
  `day_num` int(11) NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `begin_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `schedules`
--

INSERT INTO `schedules` (`id`, `doctor_id`, `doctor_userid`, `day_num`, `day`, `begin_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(38, 1, 9, 1, NULL, '11:00:00', '11:30:00', 1, '2020-12-15 13:05:38', '2020-12-15 13:05:38'),
(2, 1, 9, 2, NULL, '07:00:00', '07:30:00', 1, '2020-09-10 17:47:40', '2020-09-10 17:47:40'),
(4, 1, 9, 3, NULL, '07:00:00', '07:30:00', 1, '2020-12-11 19:49:37', '2020-12-11 19:49:37'),
(5, 1, 9, 4, NULL, '07:00:00', '07:30:00', 1, '2020-12-11 19:53:53', '2020-12-11 19:53:53'),
(6, 1, 9, 4, NULL, '08:00:00', '08:30:00', 1, '2020-12-11 19:53:53', '2020-12-11 19:53:53'),
(7, 1, 9, 4, NULL, '09:00:00', '09:30:00', 1, '2020-12-11 19:53:53', '2020-12-11 19:53:53'),
(37, 1, 9, 1, NULL, '07:00:00', '07:30:00', 1, '2020-12-15 13:05:38', '2020-12-15 13:05:38'),
(36, 1, 9, 1, NULL, '10:00:00', '10:30:00', 1, '2020-12-15 13:05:38', '2020-12-15 13:05:38'),
(35, 1, 9, 1, NULL, '09:00:00', '09:30:00', 1, '2020-12-15 13:05:38', '2020-12-15 13:05:38'),
(14, 1, 9, 5, NULL, '07:00:00', '07:30:00', 1, '2020-12-11 20:25:40', '2020-12-11 20:25:40'),
(34, 1, 9, 1, NULL, '08:00:00', '08:30:00', 1, '2020-12-15 13:05:38', '2020-12-15 13:05:38'),
(22, 1, 9, 6, NULL, '07:00:00', '07:30:00', 1, '2020-12-15 11:51:04', '2020-12-15 11:51:04');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `speciality_id` int(11) DEFAULT NULL,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `title`, `speciality_id`, `cover_image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Tooth cleaning', 2, NULL, 'Tooth cleaning', '2020-09-23 10:47:36', '2020-09-29 16:57:46'),
(2, 'Root Canal Therapy', 3, NULL, 'Root Canal Therapy', '2020-11-19 18:28:20', '2020-11-19 18:28:20'),
(3, 'Composite Bonding', 5, NULL, 'Composite Bonding', '2020-11-19 18:29:16', '2020-11-19 18:29:16'),
(4, 'Surgical Extractions', 1, NULL, 'Surgical Extractions', '2020-11-19 18:29:49', '2020-11-19 18:29:49'),
(5, 'Fissure Sealants', 2, NULL, 'Fissure Sealants', '2020-11-19 18:31:08', '2020-11-19 18:31:08'),
(6, 'Implants', 5, NULL, 'Implants', '2020-11-19 18:33:48', '2020-11-19 18:33:48');

-- --------------------------------------------------------

--
-- Structure de la table `signatures`
--

DROP TABLE IF EXISTS `signatures`;
CREATE TABLE IF NOT EXISTS `signatures` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `signature_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `approuved_by` int(11) DEFAULT NULL,
  `approuved_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `signatures`
--

INSERT INTO `signatures` (`id`, `signature_file`, `title`, `doctor_id`, `user_id`, `approuved_by`, `approuved_by_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Signature_of_BTS\'_Jungkook_1607533351.png', NULL, 1, 9, NULL, NULL, 0, '2020-12-09 17:02:31', '2020-12-09 17:02:31');

-- --------------------------------------------------------

--
-- Structure de la table `specialities`
--

DROP TABLE IF EXISTS `specialities`;
CREATE TABLE IF NOT EXISTS `specialities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `specialities`
--

INSERT INTO `specialities` (`id`, `title`, `cover_image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Urology', 'urology_1597164441.png', 'Urology', '2020-08-11 15:42:00', '2020-08-11 15:47:21'),
(2, 'Dentist', 'dentist_1597164701.png', 'Dentist', '2020-08-11 15:51:41', '2020-08-11 15:51:41'),
(3, 'Neurology', 'neurology_1597165696.png', 'Neurology', '2020-08-11 16:08:16', '2020-08-11 16:08:16'),
(4, 'Cardiologist', 'cardiologist_1597165776.png', 'Cardiologist', '2020-08-11 16:09:36', '2020-08-11 16:09:36'),
(5, 'Orthopedic', 'orthopedic_1597165809.png', 'Orthopedic', '2020-08-11 16:10:09', '2020-08-11 16:10:09');

-- --------------------------------------------------------

--
-- Structure de la table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pharmacy_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci,
  `biography` mediumtext COLLATE utf8mb4_unicode_ci,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `suppliers_email_unique` (`email`),
  UNIQUE KEY `suppliers_phone_number_unique` (`phone_number`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `suppliers`
--

INSERT INTO `suppliers` (`id`, `pharmacy_id`, `name`, `firstname`, `email`, `username`, `phone_number`, `address`, `biography`, `profile_picture`, `region`, `city`, `state`, `postal_code`, `country`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'TOGO PHARMA', NULL, 'togopharma@gmail.com', NULL, '+22893343695', 'Lomé-Togo', 'Fournisseur principal des produits pharmaceutiques du Togo', 'avatar.jpg', NULL, 'Lomé', NULL, NULL, 'Togo', 1, '2021-02-25 19:49:30', '2021-02-25 19:49:30');

-- --------------------------------------------------------

--
-- Structure de la table `tagging_tagged`
--

DROP TABLE IF EXISTS `tagging_tagged`;
CREATE TABLE IF NOT EXISTS `tagging_tagged` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `taggable_id` int(10) UNSIGNED NOT NULL,
  `taggable_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tagging_tagged_taggable_id_index` (`taggable_id`),
  KEY `tagging_tagged_taggable_type_index` (`taggable_type`),
  KEY `tagging_tagged_tag_slug_index` (`tag_slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tagging_tags`
--

DROP TABLE IF EXISTS `tagging_tags`;
CREATE TABLE IF NOT EXISTS `tagging_tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suggest` tinyint(1) NOT NULL DEFAULT '0',
  `count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `tag_group_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `tagging_tags_slug_index` (`slug`),
  KEY `tagging_tags_tag_group_id_foreign` (`tag_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tagging_tag_groups`
--

DROP TABLE IF EXISTS `tagging_tag_groups`;
CREATE TABLE IF NOT EXISTS `tagging_tag_groups` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tagging_tag_groups_slug_index` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `timeslots`
--

DROP TABLE IF EXISTS `timeslots`;
CREATE TABLE IF NOT EXISTS `timeslots` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#2180f3',
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `profile_picture` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `google2fa_secret` text COLLATE utf8mb4_unicode_ci,
  `google2fa_enable` tinyint(4) NOT NULL DEFAULT '0',
  `firebase_token` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `lang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_number_unique` (`phone_number`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `email`, `active_status`, `dark_mode`, `messenger_color`, `avatar`, `username`, `phone_number`, `address`, `profile_picture`, `email_verified_at`, `password`, `role_id`, `google2fa_secret`, `google2fa_enable`, `firebase_token`, `code`, `is_activated`, `lang`, `provider`, `provider_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'KOSSIGAN', 'Prodige', 'pkossigan@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, '22893343699', 'Lomé-Togo', 'avatar.jpg', NULL, '$2y$10$EcK7ednYjPVlxI7Iayr6euJCFkUdM/MwD0AlD1AlNuqKn1qlWVyQK', 3, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, '2020-07-08 17:11:48', '2020-11-04 13:08:43'),
(6, 'ABALO', 'Koffi', 'koffi@gmail.com', 0, 0, '#2196F3', 'avatar.png', NULL, '22897079384', 'Lomé-Togo', '5fe0a6f981279.png', NULL, '$2y$10$Su95yczSuMk01o6MpaBLbOSvQnZVtaKzw/RTxIykxyIfdjqnOowv.', 1, 'eyJpdiI6Im55S1N5MERGUUdobHpEQWxsR2l4RVE9PSIsInZhbHVlIjoiZmtDbTdTeVA3MGRwRjJLK2U0ZmpqQW01NyswZlA3ak9hMC83NU9xcE1sYz0iLCJtYWMiOiIzODVmYjY1NGRiMDNkYWM5OTEwZTFlMmQxOGUwYjJiNzMwZTlmNThjODQ1MzU2Y2Y3MzI2NjJhNzc1OTJhZjRlIn0=', 1, NULL, NULL, 1, 'FR', NULL, NULL, NULL, '2020-08-04 16:13:47', '2020-12-21 13:45:29'),
(9, 'ADAMBOUNOU', 'Kokou', 'kokou@yahoo.fr', 0, 1, '#2180f3', 'avatar.png', NULL, '22897856321', 'Adidogomé, Lomé', '5fe0adc361196.png', NULL, '$2y$10$Uo2arKYyJEPr22rSA1Vwnu9IH29H4S2DbqVwi.C5N.sERZYvCp21O', 2, 'eyJpdiI6InJiY2laa0cyVHNYQ1IyWnFESkxBNmc9PSIsInZhbHVlIjoiSnBZWnA3VmZtazhJU0hWdGgzUGhYbzhIUXMyRkZPUXFGc1JBUUY2ajBrVT0iLCJtYWMiOiJjM2EyMWQ5NmMyMWQzNmMzYTFkZjcyZDE3N2Y0NjIzYzMyOGVlM2U2OWRkODhmNzlhNmZlODFhODhjMWMyYjg4In0=', 1, NULL, NULL, 1, 'FR', NULL, NULL, NULL, '2020-08-12 12:47:50', '2020-12-21 14:14:27'),
(13, 'EDORH', 'Christian', 'christianedorh@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, '+22890959953', 'Lomé-Togo', 'avatar_1597416399.jpg', NULL, '$2y$10$rr4Xnb7rxVrK9oGyfSIu/eJ4tMrIT2BLwYgPkIRrUolAKeVrOFsvK', 3, NULL, 0, NULL, NULL, 1, 'FR', NULL, NULL, NULL, '2020-08-14 13:46:39', '2020-10-02 16:29:23'),
(11, 'AMAH', 'Koudjo', 'koudjo@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, '+2297856321', NULL, 'avatar_1597415273.jpg', NULL, '$2y$10$uBQRB10JuA.X9QF/hJrZ9OwYvmj9QpbI7XB2wPUtpgjaMUUiNjhBO', 2, NULL, 0, NULL, NULL, 1, 'FR', NULL, NULL, NULL, '2020-08-14 13:27:53', '2020-10-02 16:23:30'),
(12, 'SOSSOU', 'Franck', 'franck@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, '+22895631259', 'Lomé-Togo', 'avatar.jpg', NULL, '$2y$10$ntpDB7BREqHtM07Stj6BXOLZwioc3uZISAlxAiygdtEWHrR769S4m', 1, NULL, 0, NULL, NULL, 1, 'FR', NULL, NULL, NULL, '2020-08-14 13:29:41', '2020-08-14 13:29:41'),
(26, 'SOKEGBE', 'Romain', 'romain@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, '+197456321', NULL, 'avatar.jpg', NULL, '$2y$10$9hvDRZ61uGxonBVgGsJfC.s2SjuvH7ouGsLyBeUSw299282aVb/rG', 2, NULL, 0, NULL, NULL, 0, 'FR', NULL, NULL, NULL, '2020-12-04 11:32:05', '2020-12-04 11:32:50'),
(17, 'ATCHOUNOUGLO', 'Kossi', 'kossi@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, '97123654', 'Lomé-Togo', 'avatar.jpg', NULL, '$2y$10$MV9q5X7eNk6DNG0I3y8GO.HogtnpPqDjQI5oQY2eEvjbG4YU8v5wK', 1, NULL, 0, NULL, NULL, 1, 'FR', NULL, NULL, NULL, '2020-10-08 17:04:32', '2020-10-08 17:04:32'),
(18, 'SEWOU', 'Firmin', 'firmin@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, '+22898564120', NULL, 'avatar.jpg', NULL, '$2y$10$5T0vKn6rvFIR2EbqY/T6auTktmoe59SBeO1mS3kp9ouYz/Iq9xjSa', 2, NULL, 0, NULL, NULL, 0, 'FR', NULL, NULL, NULL, '2020-10-08 17:06:01', '2020-10-08 17:46:42'),
(42, 'PHARMACIE BETHEL', NULL, 'bethel@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, '+22898563512', 'Lomé', 'avatar.jpg', NULL, '$2y$10$Im.TTBy3rM7Sb87yJV57XurcHqIdQIDKjMhwi.BEFfY5u3w0fIGKi', 4, NULL, 0, NULL, NULL, 0, 'FR', NULL, NULL, NULL, '2021-02-02 18:52:33', '2021-02-04 13:20:06'),
(43, 'PHARMACIE NABIL', NULL, 'nabil@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, '98745632', 'Gaglé', 'avatar.jpg', NULL, '$2y$10$j.fzoWPM0aCu5VEwMbT9JezA3B9ucimhPEdzcMogXU8jNylZXFoLq', 4, NULL, 0, NULL, NULL, 0, 'FR', NULL, NULL, NULL, '2021-02-04 12:33:25', '2021-02-05 14:01:47');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
