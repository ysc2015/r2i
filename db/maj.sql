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
 UNIQUE KEY `id_nro_id_utilisateur` (`id_nro`,`id_utilisateur`),
 KEY `fk_nro_utilisateur_utilisateur` (`id_utilisateur`),
 CONSTRAINT `fk_nro_utilisateur_nro` FOREIGN KEY (`id_nro`) REFERENCES `nro` (`id_nro`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `fk_nro_utilisateur_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1

update ordre_de_travail set id_etat_ot = NULL where id_etat_ot = 0;
ALTER TABLE `ordre_de_travail` CHANGE `id_etat_ot` `id_etat_ot` INT(11) NULL DEFAULT NULL;
ALTER TABLE ordre_de_travail ADD CONSTRAINT fk_ordre_de_travail_etat_ot FOREIGN KEY(id_etat_ot) REFERENCES etat_ot(id_etat_ot) ON DELETE SET NULL ON UPDATE CASCADE;


INSERT INTO `r2i`.`etat_ot` (`id_etat_ot`, `lib_etat_ot`) VALUES ('9', 'Indisponibilité Equipe');