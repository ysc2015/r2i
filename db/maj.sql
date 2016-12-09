--
-- Base de données: `r2i`maj
--

-- --------------------------------------------------------

--
-- Structure de la table `nro_utilisateur`
--

CREATE TABLE `nro_utilisateur` (
 `id_nro_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
 `id_nro` int(11) NOT NULL,
 `id_utilisateur` int(11) NOT NULL,
 PRIMARY KEY (`id_nro_utilisateur`),
 UNIQUE KEY `id_nro` (`id_nro`,`id_utilisateur`),
 KEY `fk_nro_utilisateur_utilisateur` (`id_utilisateur`),
 CONSTRAINT `fk_nro_utilisateur_nro` FOREIGN KEY (`id_nro`) REFERENCES `nro` (`id_nro`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `fk_nro_utilisateur_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1