ALTER TABLE  `utilisateur` ADD  `telephone_utilisateur` VARCHAR( 50 ) NOT NULL ;

ALTER TABLE `sous_projet_distribution_commande_cdi` CHANGE `date_butoir` `date_butoir` DATE NULL DEFAULT NULL, CHANGE `traitement_retour_terrain` `traitement_retour_terrain` DATE NULL DEFAULT NULL, CHANGE `date_transmission_ca` `date_transmission_ca` DATE NULL DEFAULT NULL;

ALTER TABLE `sous_projet_distribution_commande_cdi` ADD `date_depot_cmd` DATE NULL DEFAULT NULL AFTER `date_transmission_ca`;

ALTER TABLE `sous_projet_transport_commande_ctr` CHANGE `date_butoir` `date_butoir` DATE NULL DEFAULT NULL, CHANGE `traitement_retour_terrain` `traitement_retour_terrain` DATE NULL DEFAULT NULL, CHANGE `date_transmission_ca` `date_transmission_ca` DATE NULL DEFAULT NULL;

ALTER TABLE `sous_projet_transport_commande_ctr` ADD `date_depot_cmd` DATE NULL DEFAULT NULL AFTER `date_transmission_ca`;

ALTER TABLE `sous_projet_distribution_recette` ADD `ok` INT NOT NULL AFTER `retour_presta`;

ALTER TABLE `sous_projet_transport_recette` ADD `ok` INT NOT NULL AFTER `retour_presta`;