ALTER TABLE `sous_projet_distribution_recette` ADD `fichier_flag` INT NOT NULL DEFAULT '0' AFTER `date_attribution_doe`, ADD `fichier_certification` INT NOT NULL DEFAULT '0' AFTER `fichier_flag`, ADD `fichier_coupleur` INT NOT NULL DEFAULT '0' AFTER `fichier_certification`, ADD `base_netgeo` INT NOT NULL DEFAULT '0' AFTER `fichier_coupleur`, ADD `dedoe` INT NOT NULL DEFAULT '0' AFTER `base_netgeo`, ADD `code_certification` TEXT NOT NULL AFTER `dedoe`, ADD `lien_zip_complet` TEXT NOT NULL AFTER `code_certification`;
INSERT INTO `type_notification` (`id_type_notification`, `lib_type_notification`) VALUES ('11', 'notification Avancement Netgeo ');