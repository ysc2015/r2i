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

ALTER TABLE `detaildevis` ADD `RFO_01_02` INT NOT NULL AFTER `D56`, ADD `RFO_01_04` INT NOT NULL AFTER `RFO_01_02`, ADD `RFO_01_06` INT NOT NULL AFTER `RFO_01_04`, ADD `RFO_01_08` INT NOT NULL AFTER `RFO_01_06`, ADD `RFO_01_10` INT NOT NULL AFTER `RFO_01_08`, ADD `RFO_01_12` INT NOT NULL AFTER `RFO_01_10`, ADD `RFO_01_14` INT NOT NULL AFTER `RFO_01_12`, ADD `RFO_01_22` INT NOT NULL AFTER `RFO_01_14`, ADD `RFO_01_24` INT NOT NULL AFTER `RFO_01_14`;
ALTER TABLE `detaildevis` DROP `RFO_01_01_racc`, DROP `RFO_01_01_unit`, DROP `RFO_01_02_racc`, DROP `RFO_01_02_unit`, DROP `RFO_01_03_racc`, DROP `RFO_01_03_unit`, DROP `RFO_01_04_racc`, DROP `RFO_01_04_unit`, DROP `RFO_01_05_racc`, DROP `RFO_01_05_unit`, DROP `RFO_01_06_racc`, DROP `RFO_01_06_unit`, DROP `RFO_01_07_racc`, DROP `RFO_01_07_unit`, DROP `RFO_01_08_racc`, DROP `RFO_01_08_unit`, DROP `RFO_01_09_racc`, DROP `RFO_01_09_unit`, DROP `RFO_01_10_racc`, DROP `RFO_01_10_unit`, DROP `RFO_01_11_racc`, DROP `RFO_01_11_unit`, DROP `RFO_01_12_racc`, DROP `RFO_01_12_unit`, DROP `RFO_01_13_racc`, DROP `RFO_01_13_unit`, DROP `RFO_01_14_racc`, DROP `RFO_01_14_unit`, DROP `RFO_01_15_racc`, DROP `RFO_01_15_unit`, DROP `RFO_01_16_racc`, DROP `RFO_01_16_unit`, DROP `RFO_01_17_racc`, DROP `RFO_01_17_unit`, DROP `RFO_01_18_racc`, DROP `RFO_01_18_unit`, DROP `RFO_01_19_racc`, DROP `RFO_01_19_unit`, DROP `RFO_01_20_racc`, DROP `RFO_01_20_unit`, DROP `RFO_01_21_racc`, DROP `RFO_01_21_unit`, DROP `RFO_01_22_racc`, DROP `RFO_01_22_unit`, DROP `RFO_01_23_racc`, DROP `RFO_01_23_unit`, DROP `RFO_01_24_racc`, DROP `RFO_01_24_unit`;


ALTER TABLE `detaildevis` ADD UNIQUE(`id_ressource`);
