ALTER TABLE `detaildevis` ADD `RFO_01_23_qt_PEC` INT NOT NULL AFTER `RFO_01_13_PEC`;

ALTER TABLE `sous_projet_distribution_commande_fin_travaux` CHANGE `ok_ft` `go_ft` INT(11) NOT NULL;

ALTER TABLE `sous_projet_transport_commande_fin_travaux` CHANGE `ok_ft` `go_ft` INT(11) NOT NULL;

ALTER TABLE `sous_projet_distribution_commande_fin_travaux` ADD `date_depot_cmd` DATE NULL DEFAULT NULL AFTER `date_transmission_tfx`;

ALTER TABLE `sous_projet_transport_commande_fin_travaux` ADD `date_depot_cmd` DATE NULL DEFAULT NULL AFTER `date_transmission_tfx`;