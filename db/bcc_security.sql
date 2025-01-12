-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 05 jan. 2025 à 18:24
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bcc_security`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `prenom`, `nom`, `photo`, `created_on`) VALUES
(1, 'joe', '$2y$10$X08VTNU9JBRy50sM9IaB8eTU.cQYTQCfjzzynfE8Yy8QMofSTMRbK', 'joel', 'Nkiere', '585390023_MG_5996.JPG', '2018-04-30');

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) NOT NULL,
  `id_agent` varchar(15) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `adresse` text NOT NULL,
  `date_naissance` date NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `id_direction` int(11) NOT NULL,
  `id_horaire` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_poste` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id`, `id_agent`, `prenom`, `nom`, `adresse`, `date_naissance`, `telephone`, `sexe`, `id_direction`, `id_horaire`, `photo`, `created_on`, `id_service`, `id_poste`, `status`) VALUES
(2, 'UYD871293640', 'HERMANS', 'IMBALEVA', 'LEMBA', '2024-08-29', '08245886668', 'M', 2, 1, 'profile.jpg', '2024-08-14', 1, 1, 'actif'),
(3, 'NHM758209146', 'KEVIN', 'LINGONGA', 'LEMBA', '2024-08-30', '09444394', 'M', 2, 1, '290796365Snapchat-2053162802.jpg', '2024-08-16', 1, 1, 'actif'),
(4, 'JME473895261', 'LARRY', 'KATSHI', 'MATETE', '2024-08-28', '99666994', 'M', 2, 1, '1441366728WhatsApp Image 2024-06-02 à 06.28.42_79935158.jpg', '2024-08-16', 1, 3, 'actif'),
(6, 'NLD021647358', 'IDRISS', 'MBOLIASA', 'MOPNT-NGA\r\n', '2024-08-30', '9949339', 'M', 2, 1, '1508278849Capture d’écran 2024-07-28 180022.png', '2024-08-21', 1, 3, 'actif'),
(9, 'FGN235198746', 'NGINGO', 'NDONDO', 'AMRR.D', '2024-09-04', '99393', 'F', 2, 1, '297572511IMG_20210101_191707_719.jpg', '2024-08-29', 5, 0, 'actif'),
(10, 'VSJ942865371', 'JOEL', 'NKIERE', 'CMPU', '2025-01-02', '08322233495', 'M', 2, 1, '1388764205_MG_5995.JPG', '2024-12-05', 1, 1, 'actif');

-- --------------------------------------------------------

--
-- Structure de la table `avance_salaire`
--

CREATE TABLE `avance_salaire` (
  `id` int(11) NOT NULL,
  `date_avance` date NOT NULL,
  `id_agent` varchar(15) NOT NULL,
  `montant` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avance_salaire`
--

INSERT INTO `avance_salaire` (`id`, `date_avance`, `id_agent`, `montant`) VALUES
(4, '2025-01-05', '2', 1200),
(5, '2025-01-05', '3', 200);

-- --------------------------------------------------------

--
-- Structure de la table `deduction_salaire`
--

CREATE TABLE `deduction_salaire` (
  `id` int(11) NOT NULL,
  `motif` varchar(100) NOT NULL,
  `montant` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `deduction_salaire`
--

INSERT INTO `deduction_salaire` (`id`, `motif`, `montant`) VALUES
(2, 'TVA', 100),
(4, 'contriution Agent', 50);

-- --------------------------------------------------------

--
-- Structure de la table `direction`
--

CREATE TABLE `direction` (
  `id` int(11) NOT NULL,
  `libelle` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `direction`
--

INSERT INTO `direction` (`id`, `libelle`) VALUES
(2, 'INFORMATIQUE'),
(4, 'Commercial');

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

CREATE TABLE `horaire` (
  `id` int(11) NOT NULL,
  `heure_entree` time NOT NULL,
  `heure_sortie` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id`, `heure_entree`, `heure_sortie`) VALUES
(1, '08:00:00', '23:00:00'),
(2, '18:30:00', '00:45:00'),
(3, '08:30:00', '20:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `id_poste` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `id_direction` int(11) NOT NULL,
  `salaire_parHeure` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `poste`
--

INSERT INTO `poste` (`id_poste`, `titre`, `id_direction`, `salaire_parHeure`) VALUES
(1, 'Manager', 2, 200),
(3, 'chef de service', 4, 1000);

-- --------------------------------------------------------

--
-- Structure de la table `presence`
--

CREATE TABLE `presence` (
  `id` int(11) NOT NULL,
  `id_agent` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure_entree` time NOT NULL,
  `status` int(1) NOT NULL,
  `heure_sortie` time NOT NULL,
  `nombre_heure` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `presence`
--

INSERT INTO `presence` (`id`, `id_agent`, `date`, `heure_entree`, `status`, `heure_sortie`, `nombre_heure`) VALUES
(38, 2, '2024-12-21', '17:39:40', 0, '00:00:00', 0),
(39, 10, '2024-12-21', '06:44:18', 1, '00:00:00', 0),
(40, 4, '2024-12-22', '03:05:07', 1, '03:05:28', 4.4),
(41, 6, '2024-12-22', '03:21:01', 1, '03:21:24', 4.1333333333333),
(42, 6, '2025-01-04', '14:35:44', 0, '14:35:50', 0);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `nom_service` varchar(50) NOT NULL,
  `id_direction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id_service`, `nom_service`, `id_direction`) VALUES
(1, 'Application Economique et Monnetaire', 2),
(5, 'Application bancaires', 2),
(9, 'caisse d\'epargne', 3),
(10, 'Reseaux', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avance_salaire`
--
ALTER TABLE `avance_salaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `deduction_salaire`
--
ALTER TABLE `deduction_salaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `direction`
--
ALTER TABLE `direction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`id_poste`);

--
-- Index pour la table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `avance_salaire`
--
ALTER TABLE `avance_salaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `deduction_salaire`
--
ALTER TABLE `deduction_salaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `direction`
--
ALTER TABLE `direction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `horaire`
--
ALTER TABLE `horaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `poste`
--
ALTER TABLE `poste`
  MODIFY `id_poste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `presence`
--
ALTER TABLE `presence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
