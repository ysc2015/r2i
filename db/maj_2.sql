

ALTER TABLE  `blq_pbc` ADD  `date_action` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;
ALTER TABLE `blq_pbc` ADD `flag` INT NOT NULL DEFAULT '0' AFTER `date_action`;

ALTER TABLE  `ordre_de_travail` ADD  `date_creation` DATE NULL DEFAULT NULL ;


UPDATE `ordre_de_travail` SET `date_creation` = '2017-02-06' WHERE 1;
