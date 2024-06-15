-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 05 fév. 2024 à 15:51
-- Version du serveur : 10.6.16-MariaDB-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pokemon`
--

-- --------------------------------------------------------

--
-- Structure de la table `pokemons`
--

CREATE TABLE `pokemons` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `primary_type` int(11) NOT NULL,
  `secondary_type` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pokemons`
--

INSERT INTO `pokemons` (`id`, `name`, `primary_type`, `secondary_type`) VALUES
(1, 'Smeargle', 1, NULL),
(2, 'Wailord', 2, NULL),
(3, 'Vileplume', 3, 7),
(4, 'Armaldo', 4, 8),
(5, 'Cradily', 4, 3),
(6, 'Carvanha', 2, 12),
(7, 'Numel', 5, 6),
(8, 'Sandslash', 6, NULL),
(9, 'Ninetales', 5, NULL),
(10, 'Weepinbell', 3, 7),
(11, 'Gloom', 3, 7),
(12, 'Ivysaur', 3, 7),
(13, 'Nidorino', 7, NULL),
(14, 'Nidoking', 7, 6),
(15, 'Dugtrio', 6, NULL),
(16, 'Rhyhorn', 6, 4),
(17, 'Persian', 1, NULL),
(18, 'Wartortle', 2, NULL),
(19, 'Charmeleon', 5, NULL),
(20, 'Charizard', 5, 18),
(21, 'Exeggutor', 3, 14),
(22, 'Cloyster', 2, 17),
(23, 'Arcanine', 5, NULL),
(24, 'Parasect', 8, 3),
(25, 'Dewgong', 2, 17),
(26, 'Chansey', 1, NULL),
(27, 'Kingler', 2, NULL),
(28, 'Tentacruel', 2, 7),
(29, 'Blastoise', 2, NULL),
(30, 'Bellsprout', 3, 7),
(31, 'Victreebel', 3, 7),
(32, 'Rapidash', 5, NULL),
(33, 'Magneton', 9, 11),
(34, 'Quagsire', 2, 6),
(35, 'Exeggcute', 3, 14),
(36, 'Horsea', 2, NULL),
(37, 'Electrode', 9, NULL),
(38, 'Starmie', 2, 14),
(39, 'Seadra', 2, NULL),
(40, 'Butterfree', 8, 18),
(41, 'Bellossom', 3, NULL),
(42, 'Dragonair', 10, NULL),
(43, 'Poliwhirl', 2, NULL),
(44, 'Flareon', 5, NULL),
(45, 'Eevee', 1, NULL),
(46, 'Vaporeon', 2, NULL),
(47, 'Jolteon', 9, NULL),
(48, 'Goldeen', 2, NULL),
(49, 'Seaking', 2, NULL),
(50, 'Golduck', 2, NULL),
(51, 'Staryu', 2, NULL),
(52, 'Pikachu', 9, NULL),
(53, 'Shellder', 2, NULL),
(54, 'Marill', 2, 16),
(55, 'Skiploom', 3, 18),
(56, 'Dratini', 10, NULL),
(57, 'Bulbasaur', 3, 7),
(58, 'Venusaur', 3, 7),
(59, 'Charmander', 5, NULL),
(60, 'Squirtle', 2, NULL),
(61, 'Nidoqueen', 7, 6),
(62, 'Pidgeot', 1, 18),
(63, 'Electabuzz', 9, NULL),
(64, 'Tangela', 3, NULL),
(65, 'Tauros', 1, NULL),
(66, 'Manectric', 9, NULL),
(67, 'Muk', 7, NULL),
(68, 'Azumarill', 2, 16),
(69, 'Zangoose', 1, NULL),
(70, 'Wingull', 2, 18),
(71, 'Roselia', 3, 7),
(72, 'Pelipper', 2, 18),
(73, 'Camerupt', 5, 6),
(74, 'Mawile', 11, 16),
(75, 'Sableye', 12, 15),
(76, 'Swellow', 1, 18),
(77, 'Trapinch', 6, NULL),
(78, 'Wailmer', 2, NULL),
(79, 'Shiftry', 3, 12),
(80, 'Cacturne', 3, 12),
(81, 'Lairon', 11, 4),
(82, 'Linoone', 1, NULL),
(83, 'Milotic', 2, NULL),
(84, 'Delcatty', 1, NULL),
(85, 'Nosepass', 4, NULL),
(86, 'Medicham', 13, 14),
(87, 'Ludicolo', 2, 3),
(88, 'Kecleon', 1, NULL),
(89, 'Graveler', 4, 6),
(90, 'Loudred', 1, NULL),
(91, 'Dodrio', 1, 18),
(92, 'Kadabra', 14, NULL),
(93, 'Claydol', 6, 14),
(94, 'Sharpedo', 2, 12),
(95, 'Magcargo', 5, 4),
(96, 'Electrike', 9, NULL),
(97, 'Makuhita', 13, NULL),
(98, 'Hariyama', 13, NULL),
(99, 'Wigglytuff', 1, 16),
(100, 'Vigoroth', 1, NULL),
(101, 'Skarmory', 11, 18),
(102, 'Spinda', 1, NULL),
(103, 'Exploud', 1, NULL),
(104, 'Slaking', 1, NULL),
(105, 'Lanturn', 2, 9),
(106, 'Slakoth', 1, NULL),
(107, 'Absol', 12, NULL),
(108, 'Tropius', 3, 18),
(109, 'Gardevoir', 14, 16),
(110, 'Torkoal', 5, NULL),
(111, 'Lunatone', 4, 14),
(112, 'Solrock', 4, 14),
(113, 'Dusclops', 15, NULL),
(114, 'Tyranitar', 4, 12),
(115, 'Clefairy', 16, NULL),
(116, 'Jigglypuff', 1, 16),
(117, 'Kingdra', 2, 10),
(118, 'Paras', 8, 3),
(119, 'Lapras', 2, 17),
(120, 'Rhydon', 6, 4),
(121, 'Slowbro', 2, 14),
(122, 'Ursaring', 1, NULL),
(123, 'Machoke', 13, NULL),
(124, 'Kangaskhan', 1, NULL),
(125, 'Machamp', 13, NULL),
(126, 'Oddish', 3, 7),
(127, 'Girafarig', 1, 14),
(128, 'Ponyta', 5, NULL),
(129, 'Vulpix', 5, NULL),
(130, 'Raticate', 1, NULL),
(131, 'Marowak', 6, NULL),
(132, 'Nidorina', 7, NULL),
(133, 'Onix', 4, 6),
(134, 'Aerodactyl', 4, 18),
(135, 'Sneasel', 12, 17),
(136, 'Gastly', 15, 7),
(137, 'Haunter', 15, 7),
(138, 'Gengar', 15, 7),
(139, 'Grotle', 3, NULL),
(140, 'Snover', 3, 17),
(141, 'Ambipom', 1, NULL),
(142, 'Raichu', 9, NULL),
(143, 'Gastrodon', 2, 6),
(144, 'Pachirisu', 9, NULL),
(145, 'Blissey', 1, NULL),
(146, 'Sudowoodo', 4, NULL),
(147, 'Misdreavus', 15, NULL),
(148, 'Drifblim', 15, 18),
(149, 'Skorupi', 7, 8),
(150, 'Steelix', 11, 6),
(151, 'Lopunny', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `pokemon_trainer`
--

CREATE TABLE `pokemon_trainer` (
  `trainer_id` int(11) DEFAULT NULL,
  `pokelevel` int(11) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `maxhp` int(11) DEFAULT NULL,
  `attack` int(11) DEFAULT NULL,
  `defense` int(11) DEFAULT NULL,
  `spatk` int(11) DEFAULT NULL,
  `spdef` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `pokemon_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'normal'),
(2, 'Water'),
(3, 'Grass'),
(4, 'Rock'),
(5, 'Fire'),
(6, 'Ground'),
(7, 'Poison'),
(8, 'Bug'),
(9, 'Electric'),
(10, 'Dragon'),
(11, 'Steel'),
(12, 'Dark'),
(13, 'Fighting'),
(14, 'Psychic'),
(15, 'Ghost'),
(16, 'Fairy'),
(17, 'Ice'),
(18, 'Flying');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pokemons`
--
ALTER TABLE `pokemons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pokemons`
--
ALTER TABLE `pokemons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT pour la table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
