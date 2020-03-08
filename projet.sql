-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3305
-- Généré le :  lun. 10 fév. 2020 à 22:52
-- Version du serveur :  5.7.17-log
-- Version de PHP :  7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bon_commande` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_commande` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `matricule`, `nom`, `adresse`, `bon_commande`, `date_commande`, `created_at`, `updated_at`) VALUES
(1, '55dsd222222', 'Ikram Hattab', 'Mahdia', 'dddab', '2019-07-25', NULL, NULL),
(2, '89894', 'islem', 'sousse', 'dbjee', '2019-07-25', NULL, NULL),
(3, 'ddc', 'ibtissem', 'sousse', 'dbjee', '2019-07-25', NULL, NULL),
(15, '55dsdez555,l', 'oumayma', 'nabeul', ',kk', '2019-08-24', NULL, NULL),
(16, 'lggmh,hm', 'ritej', 'Mahdia', 'gtrgztr', '2019-07-11', NULL, NULL),
(23, 'gg', 'test', 'tunis', '158', '1980-05-20', NULL, NULL),
(24, 'd', 'h', 'Mahdia', NULL, NULL, NULL, NULL),
(27, 'a', 'aa', 'Mahdia', NULL, NULL, NULL, NULL),
(28, '1234', 'bouth', 'mednin', NULL, NULL, NULL, NULL),
(29, '123456789', 'ikramm', 'Mahdia', 'SDQSD', '2020-02-09', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_HT` double DEFAULT NULL,
  `TVA` double NOT NULL DEFAULT '19',
  `timbre` double NOT NULL DEFAULT '0.6',
  `total_TTC` double DEFAULT NULL,
  `id_client` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`id`, `items`, `total_HT`, `TVA`, `timbre`, `total_TTC`, `id_client`, `created_at`, `updated_at`) VALUES
(2, '[{\"designation\":\"creation logo\",\"quantite\":\"118\",\"prix_unitaire\":\"123\",\"date_creation\":\"2019-08-07\"},{\"designation\":\"rfer\",\"quantite\":\"8\",\"prix_unitaire\":\"20\",\"date_creation\":\"2019-08-17\"}]', 4, 19, 0.6, 23.6, 3, '2019-08-24 14:08:16', NULL),
(3, '[{\"designation\":\"okeeeeeeeey\",\"quantite\":\"1000\",\"prix_unitaire\":\"123\",\"date_creation\":\"2019-08-07\"}]', 4, 19, 0.6, 23.6, 2, '2019-08-24 14:08:21', NULL),
(5, '[{\"designation\":\"b\",\"quantite\":null,\"prix_unitaire\":null,\"date_creation\":null}]', NULL, 19, 0.6, NULL, NULL, '2019-08-24 14:08:30', NULL),
(39, '[{\"designation\":\"creation logo\",\"quantite\":\"2000\",\"prix_unitaire\":\"1231\",\"date_creation\":\"2019-08-25\"}]', NULL, 19, 0.6, NULL, 15, '2019-08-25 01:14:21', NULL),
(40, '[{\"designation\":\"creation logo\",\"quantite\":\"2\",\"prix_unitaire\":\"12\"},{\"designation\":\"cr\\u00e9ation site web\",\"quantite\":\"12\",\"prix_unitaire\":\"12\"}]', NULL, 19, 0.6, NULL, 1, '2019-10-19 23:44:25', NULL),
(41, '[{\"designation\":\"creation logo\",\"quantite\":\"1\",\"prix_unitaire\":\"50\",\"date_creation\":\"2019-08-07\"},{\"designation\":\"site web\",\"quantite\":\"1\",\"prix_unitaire\":\"100\",\"date_creation\":\"2019-01-20\"}]', NULL, 19, 0.6, NULL, 23, '2019-08-26 14:56:16', NULL),
(43, '[{\"designation\":\"creation logo\",\"quantite\":\"10\",\"prix_unitaire\":\"12\"}]', NULL, 19, 0.6, NULL, 28, '2019-10-19 15:45:08', NULL),
(45, '[{\"designation\":\"creation logo\",\"quantite\":\"54\",\"prix_unitaire\":\"4444\"}]', NULL, 19, 0.6, NULL, 29, '2020-02-09 19:54:41', NULL),
(47, '[{\"designation\":\"site web\",\"quantite\":\"1223\",\"prix_unitaire\":\"1233\"}]', NULL, 19, 0.6, NULL, 2, '2020-02-09 20:02:35', NULL),
(48, '[{\"designation\":\"creation logo\",\"quantite\":\"12\",\"prix_unitaire\":\"400\"},{\"designation\":\"cr\\u00e9ation de site web\",\"quantite\":\"6\",\"prix_unitaire\":\"500\"}]', NULL, 19, 0.6, NULL, 29, '2020-02-09 20:18:31', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_07_25_110306_create_clients_table', 2),
(4, '2019_07_25_121110_create_factures_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('dlpro@gmail.com', '$2y$10$EVObIA9R4b3v4843/AiMKu6nQ97ADHD.oBk6racrTElaBCRdkJ21m', '2019-08-19 14:25:19'),
('ikramelhattab90@gmail.com', '$2y$10$RYvggGtg0h1Xjqxsjo4crOSce1lzJ99d8gx2lDIRkB.Y1fMx3UBay', '2019-10-17 11:44:21');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'dlpro', 'dlpro@gmail.com', NULL, '$2y$10$SPUR0ooQxuDuG35zGc/PE.fCwGlsrZu4xZ47/e9WOFFL30RaZDvaG', 'OO9dDr1MtocIflpIEqKGmbshFKYHqoR7IElM0oEfPswaMsmXUiYmfkvP3jpM', '2019-07-24 13:51:51', '2019-07-24 13:51:51'),
(2, 'islem', 'ikramelhattab90@gmail.com', NULL, '$2y$10$vDLXmrYPy7E12VMPhdwE7.Pm1QqQObUDKIrNTnn9X/uz/QIjoLdty', NULL, '2019-07-24 14:18:08', '2019-07-24 14:18:08');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricule` (`matricule`);

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factures_id_client_foreign` (`id_client`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `factures_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
