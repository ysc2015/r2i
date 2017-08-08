
CREATE TABLE IF NOT EXISTS `etat_traitement_devis` (
  `id_etat_traitement_devis` int(11) NOT NULL AUTO_INCREMENT,
  `id_ressource` int(11) NOT NULL,
  `id_ordre_traivail` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '1',
  `nom_fichier` text NOT NULL,
  `date_action` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_etat_traitement_devis`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Structure de la table `cron_etat_traitement_devis`
--
CREATE TABLE IF NOT EXISTS `cron_etat_traitement_devis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etat` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `cron_etat_traitement_devis`
--

INSERT INTO `cron_etat_traitement_devis` (`id`, `etat`) VALUES
(1, 'OFF');
