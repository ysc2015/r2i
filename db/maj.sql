ALTER TABLE  `utilisateur` ADD  `telephone_utilisateur` VARCHAR( 50 ) NOT NULL ;

ALTER TABLE `sous_projet_distribution_commande_cdi` CHANGE `date_butoir` `date_butoir` DATE NULL DEFAULT NULL, CHANGE `traitement_retour_terrain` `traitement_retour_terrain` DATE NULL DEFAULT NULL, CHANGE `date_transmission_ca` `date_transmission_ca` DATE NULL DEFAULT NULL;

ALTER TABLE `sous_projet_distribution_commande_cdi` ADD `date_depot_cmd` DATE NULL DEFAULT NULL AFTER `date_transmission_ca`;

ALTER TABLE `sous_projet_transport_commande_ctr` CHANGE `date_butoir` `date_butoir` DATE NULL DEFAULT NULL, CHANGE `traitement_retour_terrain` `traitement_retour_terrain` DATE NULL DEFAULT NULL, CHANGE `date_transmission_ca` `date_transmission_ca` DATE NULL DEFAULT NULL;

ALTER TABLE `sous_projet_transport_commande_ctr` ADD `date_depot_cmd` DATE NULL DEFAULT NULL AFTER `date_transmission_ca`;

ALTER TABLE `sous_projet_distribution_recette` ADD `ok` INT NOT NULL AFTER `retour_presta`;

ALTER TABLE `sous_projet_transport_recette` ADD `ok` INT NOT NULL AFTER `retour_presta`;

UPDATE `r2i`.`select_go_ft` SET `lib_go_ft` = 'Commande Deposée' WHERE `select_go_ft`.`id_go_ft` = 2;

UPDATE `r2i`.`select_go_ft` SET `lib_go_ft` = 'Commande Rejetée' WHERE `select_go_ft`.`id_go_ft` = 3;

INSERT INTO  `r2i`.`select_go_ft` (
`id_go_ft` ,
`lib_go_ft`
)
VALUES (
NULL ,  'Commande Annulée'
), (
NULL ,  'Commande Mise à dispo'
);



