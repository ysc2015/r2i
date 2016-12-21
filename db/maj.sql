--
-- Base de données: `r2i`maj
--

-- --------------------------------------------------------

--
-- Structure de la table `nro_utilisateur`
--

CREATE TABLE IF NOT EXISTS `nro_utilisateur` (
 `id_nro_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
 `id_nro` int(11) NOT NULL,
 `id_utilisateur` int(11) NOT NULL,
 PRIMARY KEY (`id_nro_utilisateur`),
 UNIQUE KEY `id_nro_id_utilisateur` (`id_nro`,`id_utilisateur`),
 KEY `fk_nro_utilisateur_utilisateur` (`id_utilisateur`),
 CONSTRAINT `fk_nro_utilisateur_nro` FOREIGN KEY (`id_nro`) REFERENCES `nro` (`id_nro`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `fk_nro_utilisateur_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

update ordre_de_travail set id_etat_ot = NULL where id_etat_ot = 0;
ALTER TABLE `ordre_de_travail` CHANGE `id_etat_ot` `id_etat_ot` INT(11) NULL DEFAULT NULL;
ALTER TABLE ordre_de_travail ADD CONSTRAINT fk_ordre_de_travail_etat_ot FOREIGN KEY(id_etat_ot) REFERENCES etat_ot(id_etat_ot) ON DELETE SET NULL ON UPDATE CASCADE;


INSERT INTO `r2i`.`etat_ot` (`id_etat_ot`, `lib_etat_ot`) VALUES ('9', 'Indisponibilité Equipe');

--
-- Structure de la table `type_notification`
--

CREATE TABLE IF NOT EXISTS `type_notification` (
 `id_type_notification` int(11) NOT NULL AUTO_INCREMENT,
 `lib_type_notification` varchar(300) NOT NULL,
 PRIMARY KEY (`id_type_notification`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_notification`
--

INSERT INTO `type_notification` (`id_type_notification`, `lib_type_notification`) VALUES
(1, 'Création de projet'),
(2, 'Attribution de charge(bei)'),
(3, 'Attribution OT'),
(4, 'Contrôles des plans OK');

--
-- projet_mail_creation : suppress - creation
--

DROP TABLE IF EXISTS `projet_mail_creation`;

CREATE TABLE IF NOT EXISTS `projet_mail_creation` (
 `id_projet_mail_creation` int(11) NOT NULL AUTO_INCREMENT,
 `id_utilisateur` int(11) NOT NULL,
 `id_type_notification` int(11) DEFAULT NULL,
 PRIMARY KEY (`id_projet_mail_creation`),
 UNIQUE KEY `id_utilisateur_2` (`id_utilisateur`,`id_type_notification`),
 KEY `fk_projet_mail_creation_type_notification` (`id_type_notification`),
 CONSTRAINT `FK_projet_mail_creation_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `fk_projet_mail_creation_type_notification` FOREIGN KEY (`id_type_notification`) REFERENCES `type_notification` (`id_type_notification`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;



