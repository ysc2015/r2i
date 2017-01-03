--
-- Base de données: `r2i`maj
--

-- --------------------------------------------------------

UPDATE `chambre` SET `gps` = REPLACE(`gps`, ' ', '');

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

--
-- Structure de la table `mail_notification_template`
--


CREATE TABLE `mail_notification_template` (
  `id_mail_notification` int(11) NOT NULL,
  `template` text NOT NULL,
  `type` int(11) NOT NULL,
  `object` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `mail_notification_template`
--

INSERT INTO `mail_notification_template` (`id_mail_notification`, `template`, `type`, `object`) VALUES
(1, '<p>Bonjour,</p>\n\n<p>Le STT @nom_entreprise_stt&nbsp;vient de r&eacute;aliser le retour @etape_sous_projet&nbsp;du @CRT_CDI de&nbsp;:</p>\n\n<p>@code_sous_projet</p>\n\n<p>Les donn&eacute;es sont accessibles sous R2i.</p>\n', 2, '[R2i] Retour OT Aiguillage Réalisé par le STT @code_sous_projet'),
(2, '<p>Bonjour,&nbsp;<br />\n<br />\nIl vous a &eacute;t&eacute; attribu&eacute; un OT @nom_ot&nbsp;provenant de la zone NR@code_sous_projet&nbsp;@ville,<br />\n<br />\nInfos OT :</p>\n\n<p>&nbsp;</p>\n\n<p>Nombre de boitier</p>\n\n<p>@b_720 :&nbsp;</p>\n\n<p>@b_432 :&nbsp;</p>\n\n<p>@b_288 :&nbsp;</p>\n\n<p>@b_144 :</p>\n\n<p>@b_48 :&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>Lin&eacute;aire de C&acirc;ble :&nbsp;</p>\n\n<p>720 : @c_720 ml&nbsp;</p>\n\n<p>432 :&nbsp;@c_432 ml&nbsp;</p>\n\n<p>288 : @c_288&nbsp;ml</p>\n\n<p>144 : @c_144&nbsp;ml</p>\n\n<p>48 : &nbsp;@c_48&nbsp;ml</p>\n\n<p><br />\nNombre de chambres emprunt&eacute;es :@nombres_chambre<br />\nLin&eacute;aire des infrastructures emprunt&eacute;es : @total_lineaire ml</p>\n\n<p>&nbsp;</p>\n\n<p>pour retrouver ces informations connectez vous &agrave; R2i (https://r2i.free-infra.vlq16.iliad.fr).</p>\n\n<p><br />\n&nbsp;</p>\n', 3, '[R2i] Plan @etape_sous_projet disponible @code_sous_projet'),
(3, '<p>Bonjour,</p>\n\n<p>Un nouveau plan @etape_sous_projet @CDi_CTR est termin&eacute;&nbsp;:</p>\n\n<p>@code_sous_projet</p>\n\n<p>Les donn&eacute;es sont accessibles sous R2i.</p>\n', 4, '[R2i] Plan @etape_sous_projet disponible @code_sous_projet');

ALTER TABLE `mail_notification_template`
  ADD PRIMARY KEY (`id_mail_notification`);

ALTER TABLE `mail_notification_template`
  MODIFY `id_mail_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `utilisateur` CHANGE `email_utilisateur` `email_utilisateur` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `utilisateur` ADD UNIQUE(`email_utilisateur`);

ALTER TABLE `point_bloquant` ADD `id_sous_projet` INT NULL DEFAULT NULL AFTER `id_point_bloquant`;

ALTER TABLE point_bloquant ADD CONSTRAINT fk_point_bloquant_sous_projet FOREIGN KEY(id_sous_projet) REFERENCES sous_projet(id_sous_projet) ON DELETE SET NULL ON UPDATE CASCADE;



--
--Modification table devisdetail
--
ALTER TABLE `detaildevis` CHANGE `TABEXT_432` `RFO_01_01` INT(11) NOT NULL, CHANGE `TABEXT_288` `RFO_01_03` INT(11) NOT NULL, CHANGE `TABEXT_144` `RFO_01_05` INT(11) NOT NULL, CHANGE `TABEXT_72` `RFO_01_07` INT(11) NOT NULL, CHANGE `TABEXT_48` `RFO_01_09` INT(11) NOT NULL;
ALTER TABLE `detaildevis` CHANGE `TABEXT_24` `RFO_01_11` INT(11) NOT NULL, CHANGE `TABRAC_720` `RFO_01_13` INT(11) NOT NULL, CHANGE `TABRAC_432` `RFO_01_15` INT(11) NOT NULL, CHANGE `TABRAC_288` `RFO_01_16` INT(11) NOT NULL, CHANGE `TABRAC_144` `RFO_01_17` INT(11) NOT NULL, CHANGE `TABRAC_72` `RFO_01_18` INT(11) NOT NULL;
ALTER TABLE `detaildevis` CHANGE `TABRAC_48` `RFO_01_19` INT(11) NOT NULL, CHANGE `TABRAC_24` `RFO_01_20` INT(11) NOT NULL, CHANGE `TABFEN_432` `RFO_01_21` INT(11) NOT NULL, CHANGE `TABFEN_288` `RFO_01_23` INT(11) NOT NULL, CHANGE `TABFEN_144` `RFO_01_01_PEC` INT(11) NOT NULL, CHANGE `TABFEN_72` `RFO_01_03_PEC` INT(11) NOT NULL, CHANGE `TABFEN_48` `RFO_01_05_PEC` INT(11) NOT NULL, CHANGE `TABFEN_24` `RFO_01_07_PEC` INT(11) NOT NULL, CHANGE `NBTUB` `RFO_01_09_PEC` INT(11) NOT NULL, CHANGE `NBSOUD` `RFO_01_11_PEC` INT(11) NOT NULL;
ALTER TABLE `detaildevis` ADD `RFO_01_13_PEC` INT NOT NULL AFTER `RFO_01_11_PEC`;

