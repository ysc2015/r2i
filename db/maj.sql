ALTER TABLE `detaildevis` ADD `RFO_01_23_qt_PEC` INT NOT NULL AFTER `RFO_01_13_PEC`;

ALTER TABLE `sous_projet_distribution_commande_fin_travaux` CHANGE `ok_ft` `go_ft` INT(11) NOT NULL;

ALTER TABLE `sous_projet_transport_commande_fin_travaux` CHANGE `ok_ft` `go_ft` INT(11) NOT NULL;

ALTER TABLE `sous_projet_distribution_commande_fin_travaux` ADD `date_depot_cmd` DATE NULL DEFAULT NULL AFTER `date_transmission_tfx`;

ALTER TABLE `sous_projet_transport_commande_fin_travaux` ADD `date_depot_cmd` DATE NULL DEFAULT NULL AFTER `date_transmission_tfx`;

INSERT INTO `type_notification` (`id_type_notification`, `lib_type_notification`) VALUES
(6, 'validation des retours STT dans l''OT'),
(7, 'validation d''une étape'),
(8, 'ajout d''un point bloquant'),
(9, 'Ajout d''un PBC (cron toutes les heures)'),
(10, 'Réponse à un PBC ');