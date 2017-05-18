

ALTER TABLE  `blq_pbc` ADD  `date_action` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;
ALTER TABLE `blq_pbc` ADD `flag` INT NOT NULL DEFAULT '0' AFTER `date_action`;

ALTER TABLE  `ordre_de_travail` ADD  `date_creation` DATE NULL DEFAULT NULL ;


update `ordre_de_travail` set date_creation = date_debut WHERE 1;

ALTER TABLE `blq_pbc` ADD `id_createur` INT NULL AFTER `flag`, ADD `type_question` INT NOT NULL DEFAULT '1' AFTER `id_createur`;

ALTER TABLE `detaildevis`
  DROP `RFO_01_01_racc`,
  DROP `RFO_01_02_racc`,
  DROP `RFO_01_03_racc`,
  DROP `RFO_01_04_racc`,
  DROP `RFO_01_05_racc`,
  DROP `RFO_01_06_racc`,
  DROP `RFO_01_07_racc`,
  DROP `RFO_01_08_racc`,
  DROP `RFO_01_09_racc`,
  DROP `RFO_01_10_racc`,
  DROP `RFO_01_11_racc`,
  DROP `RFO_01_12_racc`,
  DROP `RFO_01_13_racc`,
  DROP `RFO_01_14_racc`,
  DROP `RFO_01_15_racc`,
  DROP `RFO_01_16_racc`,
  DROP `RFO_01_17_racc`,
  DROP `RFO_01_18_racc`,
  DROP `RFO_01_19_racc`,
  DROP `RFO_01_20_racc`,
  DROP `RFO_01_21_racc`,
  DROP `RFO_01_22_racc`,
  DROP `RFO_01_23_racc`,
  DROP `RFO_01_24_racc`;
ALTER TABLE `detaildevis`
  DROP `RFO_01_01_unit`,
  DROP `RFO_01_02_unit`,
  DROP `RFO_01_03_unit`,
  DROP `RFO_01_04_unit`,
  DROP `RFO_01_05_unit`,
  DROP `RFO_01_06_unit`,
  DROP `RFO_01_07_unit`,
  DROP `RFO_01_08_unit`,
  DROP `RFO_01_09_unit`,
  DROP `RFO_01_10_unit`,
  DROP `RFO_01_11_unit`,
  DROP `RFO_01_12_unit`,
  DROP `RFO_01_13_unit`,
  DROP `RFO_01_14_unit`,
  DROP `RFO_01_15_unit`,
  DROP `RFO_01_16_unit`,
  DROP `RFO_01_17_unit`,
  DROP `RFO_01_18_unit`,
  DROP `RFO_01_19_unit`,
  DROP `RFO_01_20_unit`,
  DROP `RFO_01_21_unit`,
  DROP `RFO_01_22_unit`,
  DROP `RFO_01_23_unit`,
  DROP `RFO_01_24_unit`;
ALTER TABLE `detaildevis`
  DROP `RFO_01_01_int`,
  DROP `RFO_01_01_total`,
  DROP `RFO_01_02_int`,
  DROP `RFO_01_02_total`,
  DROP `RFO_01_03_int`,
  DROP `RFO_01_03_total`,
  DROP `RFO_01_04_int`,
  DROP `RFO_01_04_total`,
  DROP `RFO_01_05_int`,
  DROP `RFO_01_05_total`,
  DROP `RFO_01_06_int`,
  DROP `RFO_01_06_total`,
  DROP `RFO_01_07_int`,
  DROP `RFO_01_07_total`,
  DROP `RFO_01_08_int`,
  DROP `RFO_01_08_total`,
  DROP `RFO_01_09_int`,
  DROP `RFO_01_09_total`,
  DROP `RFO_01_10_int`,
  DROP `RFO_01_10_total`,
  DROP `RFO_01_11_int`,
  DROP `RFO_01_11_total`,
  DROP `RFO_01_12_int`,
  DROP `RFO_01_12_total`,
  DROP `RFO_01_13_int`,
  DROP `RFO_01_13_total`,
  DROP `RFO_01_14_int`,
  DROP `RFO_01_14_total`,
  DROP `RFO_01_15_int`,
  DROP `RFO_01_15_total`,
  DROP `RFO_01_16_int`,
  DROP `RFO_01_16_total`,
  DROP `RFO_01_17_int`,
  DROP `RFO_01_17_total`,
  DROP `RFO_01_18_int`,
  DROP `RFO_01_18_total`,
  DROP `RFO_01_19_int`,
  DROP `RFO_01_19_total`,
  DROP `RFO_01_20_int`,
  DROP `RFO_01_20_total`,
  DROP `RFO_01_21_int`,
  DROP `RFO_01_21_total`,
  DROP `RFO_01_22_int`,
  DROP `RFO_01_22_total`,
  DROP `RFO_01_23_int`,
  DROP `RFO_01_23_total`,
  DROP `RFO_01_24_int`,
  DROP `RFO_01_24_total`;
ALTER TABLE `detaildevis`
  DROP `RFO_01_01`,
  DROP `RFO_01_02`,
  DROP `RFO_01_03`,
  DROP `RFO_01_04`,
  DROP `RFO_01_05`,
  DROP `RFO_01_06`,
  DROP `RFO_01_07`,
  DROP `RFO_01_08`,
  DROP `RFO_01_09`,
  DROP `RFO_01_10`,
  DROP `RFO_01_11`,
  DROP `RFO_01_12`,
  DROP `RFO_01_13`,
  DROP `RFO_01_14`,
  DROP `RFO_01_15`,
  DROP `RFO_01_16`,
  DROP `RFO_01_17`,
  DROP `RFO_01_18`,
  DROP `RFO_01_19`,
  DROP `RFO_01_20`,
  DROP `RFO_01_21`,
  DROP `RFO_01_22`,
  DROP `RFO_01_23`,
  DROP `RFO_01_24`;
  /**
  Changement de nom de colonne DetailsDevis
   */

ALTER TABLE `detaildevis` CHANGE `D33` `EFO_06_03_qt` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `detaildevis` CHANGE `D36` `EFO_06_06_qt` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `detaildevis` CHANGE `D43` `TFO_01_01_qt` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `detaildevis` CHANGE `D44` `TFO_01_02_qt` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `detaildevis` CHANGE `D46` `TFO_02_01_qt` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `detaildevis` CHANGE `D47` `TFO_02_02_qt` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
CHANGE `D48` `TFO_02_03_qt` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
CHANGE `D53` `TFO_03_01_qt` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
CHANGE `D54` `TFO_03_02_qt` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
CHANGE `D56` `TFO_04_01_qt` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `detaildevis`  ADD `EFO_01_01_qt` INT NOT NULL  AFTER `TFO_04_01_qt`,  ADD `EFO_01_02_qt` INT NOT NULL  AFTER `EFO_01_01_qt`,  ADD `EFO_01_03_qt` INT NOT NULL  AFTER `EFO_01_02_qt`,  ADD `EFO_01_04_qt` INT NOT NULL  AFTER `EFO_01_03_qt`,  ADD `EFO_02_01_qt` INT NOT NULL  AFTER `EFO_01_04_qt`,  ADD `EFO_02_02_qt` INT NOT NULL  AFTER `EFO_02_01_qt`,  ADD `EFO_02_03_qt` INT NOT NULL  AFTER `EFO_02_02_qt`,  ADD `EFO_02_04_qt` INT NOT NULL  AFTER `EFO_02_03_qt`,  ADD `EFO_02_05_qt` INT NOT NULL  AFTER `EFO_02_04_qt`,  ADD `EFO_02_06_qt` INT NOT NULL  AFTER `EFO_02_05_qt`,  ADD `EFO_03_01_qt` INT NOT NULL  AFTER `EFO_02_06_qt`,  ADD `EFO_03_02_qt` INT NOT NULL  AFTER `EFO_03_01_qt`,  ADD `EFO_03_04_qt` INT NOT NULL  AFTER `EFO_03_02_qt`,  ADD `EFO_04_01_qt` INT NOT NULL  AFTER `EFO_03_04_qt`,  ADD `EFO_04_02_qt` INT NOT NULL  AFTER `EFO_04_01_qt`,  ADD `EFO_04_03_qt` INT NOT NULL  AFTER `EFO_04_02_qt`,  ADD `EFO_04_04_qt` INT NOT NULL  AFTER `EFO_04_03_qt`,  ADD `EFO_05_01_qt` INT NOT NULL  AFTER `EFO_04_04_qt`,  ADD `EFO_05_02_qt` INT NOT NULL  AFTER `EFO_05_01_qt`,  ADD `EFO_05_03_qt` INT NOT NULL  AFTER `EFO_05_02_qt`,  ADD `EFO_05_04_qt` INT NOT NULL  AFTER `EFO_05_03_qt`,  ADD `EFO_06_01_qt` INT NOT NULL  AFTER `EFO_05_04_qt`,  ADD `EFO_06_02_qt` INT NOT NULL  AFTER `EFO_06_01_qt`,  ADD `EFO_06_04_qt` INT NOT NULL  AFTER `EFO_06_02_qt`,  ADD `EFO_06_05_qt` INT NOT NULL  AFTER `EFO_06_04_qt`,  ADD `EFO_06_07_qt` INT NOT NULL  AFTER `EFO_06_05_qt`;
ALTER TABLE `detaildevis` ADD `TFO_02_04_qt` INT NOT NULL AFTER `TFO_04_01_qt`, ADD `TFO_02_05_qt` INT NOT NULL , ADD `TFO_02_06_qt` INT NOT NULL , ADD `TFO_05_01_qt` INT NOT NULL ;
ALTER TABLE `detaildevis` ADD `ITF_01_01_qt` INT NOT NULL AFTER `EFO_06_07_qt`, ADD `ITF_01_02_qt` INT NOT NULL , ADD `ITF_02_01_qt` INT NOT NULL , ADD `ITF_02_02_qt` INT NOT NULL AFTER `ITF_02_01_qt`, ADD `ITF_02_03_qt` INT NOT NULL AFTER `ITF_02_02_qt`, ADD `ITF_02_04_qt` INT NOT NULL AFTER `ITF_02_03_qt`, ADD `ITF_02_05_qt` INT NOT NULL AFTER `ITF_02_04_qt`, ADD `ITF_02_06_qt` INT NOT NULL AFTER `ITF_02_05_qt`;


 ALTER TABLE `detaildevis`  ADD `EGC_01_01_qt` INT NOT NULL  AFTER `ITF_02_06_qt`,  ADD `EGC_01_02_qt` INT NOT NULL  AFTER `EGC_01_01_qt`,  ADD `EGC_01_03_qt` INT NOT NULL  AFTER `EGC_01_02_qt`,  ADD `EGC_02_01_qt` INT NOT NULL  AFTER `EGC_01_03_qt`,  ADD `EGC_02_02_qt` INT NOT NULL  AFTER `EGC_02_01_qt`,  ADD `EGC_02_03_qt` INT NOT NULL  AFTER `EGC_02_02_qt`,  ADD `EGC_02_04_qt` INT NOT NULL  AFTER `EGC_02_03_qt`,  ADD `EGC_02_05_qt` INT NOT NULL  AFTER `EGC_02_04_qt`,  ADD `EGC_02_06_qt` INT NOT NULL  AFTER `EGC_02_05_qt`,  ADD `EGC_02_07_qt` INT NOT NULL  AFTER `EGC_02_06_qt`,  ADD `EGC_02_08_qt` INT NOT NULL  AFTER `EGC_02_07_qt`,  ADD `EGC_02_09_qt` INT NOT NULL  AFTER `EGC_02_08_qt`,  ADD `EGC_02_10_qt` INT NOT NULL  AFTER `EGC_02_09_qt`,  ADD `EGC_02_11_qt` INT NOT NULL  AFTER `EGC_02_10_qt`,  ADD `EGC_02_12_qt` INT NOT NULL  AFTER `EGC_02_11_qt`,  ADD `EGC_02_13_qt` INT NOT NULL  AFTER `EGC_02_12_qt`,  ADD `EGC_02_14_qt` INT NOT NULL  AFTER `EGC_02_13_qt`,  ADD `EGC_02_15_qt` INT NOT NULL  AFTER `EGC_02_14_qt`,  ADD `EGC_02_16_qt` INT NOT NULL  AFTER `EGC_02_15_qt`;
ALTER TABLE `detaildevis` ADD `CGC_01_01_qt` INT NOT NULL AFTER `EGC_02_16_qt`, ADD `CGC_01_02_qt` INT NOT NULL AFTER `CGC_01_01_qt`, ADD `CGC_02_01_qt` INT NOT NULL AFTER `CGC_01_02_qt`, ADD `CGC_02_02_qt` INT NOT NULL AFTER `CGC_02_01_qt`, ADD `CGC_02_03_qt` INT NOT NULL AFTER `CGC_02_02_qt`, ADD `CGC_02_04_qt` INT NOT NULL AFTER `CGC_02_03_qt`, ADD `CGC_02_05_qt` INT NOT NULL AFTER `CGC_02_04_qt`, ADD `CGC_02_06_qt` INT NOT NULL AFTER `CGC_02_05_qt`, ADD `CGC_02_07_qt` INT NOT NULL AFTER `CGC_02_06_qt`, ADD `CGC_02_08_qt` INT NOT NULL AFTER `CGC_02_07_qt`, ADD `CGC_03_01_qt` INT NOT NULL AFTER `CGC_02_08_qt`, ADD `CGC_03_02_qt` INT NOT NULL AFTER `CGC_03_01_qt`, ADD `CGC_03_03_qt` INT NOT NULL AFTER `CGC_03_02_qt`, ADD `CGC_03_04_qt` INT NOT NULL AFTER `CGC_03_03_qt`, ADD `CGC_03_05_qt` INT NOT NULL AFTER `CGC_03_04_qt`, ADD `CGC_04_01_qt` INT NOT NULL AFTER `CGC_03_05_qt`, ADD `CGC_04_02_qt` INT NOT NULL AFTER `CGC_04_01_qt`;
ALTER TABLE `detaildevis`  ADD `TGC_01_01_qt` INT NOT NULL  AFTER `CGC_04_02_qt`,  ADD `TGC_02_01_qt` INT NOT NULL  AFTER `TGC_01_01_qt`,  ADD `TGC_02_02_qt` INT NOT NULL  AFTER `TGC_02_01_qt`,  ADD `TGC_02_03_qt` INT NOT NULL  AFTER `TGC_02_02_qt`,  ADD `TGC_02_04_qt` INT NOT NULL  AFTER `TGC_02_03_qt`,  ADD `TGC_02_05_qt` INT NOT NULL  AFTER `TGC_02_04_qt`,  ADD `TGC_02_06_qt` INT NOT NULL  AFTER `TGC_02_05_qt`,  ADD `TGC_03_01_qt` INT NOT NULL  AFTER `TGC_02_06_qt`,  ADD `TGC_03_02_qt` INT NOT NULL  AFTER `TGC_03_01_qt`,  ADD `TGC_03_03_qt` INT NOT NULL  AFTER `TGC_03_02_qt`,  ADD `TGC_03_04_qt` INT NOT NULL  AFTER `TGC_03_03_qt`,  ADD `TGC_03_05_qt` INT NOT NULL  AFTER `TGC_03_04_qt`,  ADD `TGC_04_01_qt` INT NOT NULL  AFTER `TGC_03_05_qt`,  ADD `TGC_04_02_qt` INT NOT NULL  AFTER `TGC_04_01_qt`,  ADD `TGC_05_01_qt` INT NOT NULL  AFTER `TGC_04_02_qt`,  ADD `TGC_05_02_qt` INT NOT NULL  AFTER `TGC_05_01_qt`,  ADD `TGC_05_03_qt` INT NOT NULL  AFTER `TGC_05_02_qt`,  ADD `TGC_05_04_qt` INT NOT NULL  AFTER `TGC_05_03_qt`;
ALTER TABLE `detaildevis` ADD `ref_devis` VARCHAR(30) NOT NULL AFTER `TGC_05_04_qt`, ADD `date_devis` DATE NOT NULL AFTER `ref_devis`, ADD `date_livraison` DATE NOT NULL AFTER `date_devis`;


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

ALTER TABLE `sous_projet` ADD `id_master_ctr` INT NULL DEFAULT NULL AFTER `is_master`;

ALTER TABLE `sous_projet_distribution_aiguillage` ADD `date_retour_ok` DATETIME NULL DEFAULT NULL AFTER `date_controle_ok`;

ALTER TABLE `sous_projet_distribution_raccordements` ADD `date_retour_ok` DATETIME NULL DEFAULT NULL AFTER `date_controle_ok`;

ALTER TABLE `sous_projet_distribution_recette` ADD `date_retour_ok` DATETIME NULL DEFAULT NULL AFTER `date_controle_ok`;

ALTER TABLE `sous_projet_distribution_tirage` ADD `date_retour_ok` DATETIME NULL DEFAULT NULL AFTER `date_controle_ok`;

ALTER TABLE `sous_projet_transport_aiguillage` ADD `date_retour_ok` DATETIME NULL DEFAULT NULL AFTER `date_controle_ok`;

ALTER TABLE `sous_projet_transport_raccordements` ADD `date_retour_ok` DATETIME NULL DEFAULT NULL AFTER `date_controle_ok`;

ALTER TABLE `sous_projet_transport_recette` ADD `date_retour_ok` DATETIME NULL DEFAULT NULL AFTER `date_controle_ok`;

ALTER TABLE `sous_projet_transport_tirage` ADD `date_retour_ok` DATETIME NULL DEFAULT NULL AFTER `date_controle_ok`;

ALTER TABLE `sous_projet_distribution_design` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_distribution_aiguillage` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_distribution_commande_cdi` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_distribution_tirage` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_distribution_raccordements` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_distribution_recette` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_distribution_commande_fin_travaux` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_transport_design` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_transport_aiguillage` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_transport_commande_ctr` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_transport_tirage` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_transport_raccordements` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_transport_recette` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `sous_projet_transport_commande_fin_travaux` ADD `date_charge_be` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `sous_projet`
ADD `date_insertion` DATE NULL DEFAULT NULL AFTER `id_master_ctr`,
ADD `date_last_modify` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE NOW(),
ADD `id_createur` INT DEFAULT NULL  AFTER `date_last_modify`,
ADD `id_modificateur` INT DEFAULT NULL  AFTER `id_createur`;

UPDATE sous_projet AS sp
INNER JOIN projet AS p ON sp.id_projet = p.id_projet
SET sp.date_insertion = p.date_creation
WHERE  1;



    SELECT ot.* FROM ordre_de_travail ot
    INNER JOIN select_type_ordre_travail tot on ot.id_type_ordre_travail = tot.id_type_ordre_travail
    LEFT JOIN sous_projet_transport_aiguillage ta on ot.id_sous_projet = ta.id_sous_projet
    WHERE ot.id_type_ordre_travail = 1 AND ta.ok <> 1
    UNION
    SELECT ot.* FROM ordre_de_travail ot
    INNER JOIN select_type_ordre_travail tot on ot.id_type_ordre_travail = tot.id_type_ordre_travail
    LEFT JOIN sous_projet_transport_tirage tt on ot.id_sous_projet = tt.id_sous_projet
    WHERE ot.id_type_ordre_travail = 2 AND tt.ok <> 1
    UNION
    SELECT ot.* FROM ordre_de_travail ot
    INNER JOIN select_type_ordre_travail tot on ot.id_type_ordre_travail = tot.id_type_ordre_travail
    LEFT JOIN sous_projet_transport_raccordements tr on ot.id_sous_projet = tr.id_sous_projet
    WHERE ot.id_type_ordre_travail = 3 AND tr.ok <> 1
    UNION
    SELECT ot.* FROM ordre_de_travail ot
    INNER JOIN select_type_ordre_travail tot on ot.id_type_ordre_travail = tot.id_type_ordre_travail
    LEFT JOIN sous_projet_transport_tirage tt on ot.id_sous_projet = tt.id_sous_projet
    LEFT JOIN sous_projet_transport_raccordements tr on ot.id_sous_projet = tr.id_sous_projet
    WHERE ot.id_type_ordre_travail = 4 AND tt.ok <> 1 AND tr.ok <> 1
    UNION
    SELECT ot.* FROM ordre_de_travail ot
    INNER JOIN select_type_ordre_travail tot on ot.id_type_ordre_travail = tot.id_type_ordre_travail
    LEFT JOIN sous_projet_transport_recette trec on ot.id_sous_projet = trec.id_sous_projet
    WHERE ot.id_type_ordre_travail = 9 AND trec.ok <> 1

    UNION

    SELECT ot.* FROM ordre_de_travail ot
    INNER JOIN select_type_ordre_travail tot on ot.id_type_ordre_travail = tot.id_type_ordre_travail
    LEFT JOIN sous_projet_distribution_aiguillage da on ot.id_sous_projet = da.id_sous_projet
    WHERE ot.id_type_ordre_travail = 5 AND da.ok <> 1
    UNION
    SELECT ot.* FROM ordre_de_travail ot
    INNER JOIN select_type_ordre_travail tot on ot.id_type_ordre_travail = tot.id_type_ordre_travail
    LEFT JOIN sous_projet_distribution_tirage dt on ot.id_sous_projet = dt.id_sous_projet
    WHERE ot.id_type_ordre_travail = 6 AND dt.ok <> 1
    UNION
    SELECT ot.* FROM ordre_de_travail ot
    INNER JOIN select_type_ordre_travail tot on ot.id_type_ordre_travail = tot.id_type_ordre_travail
    LEFT JOIN sous_projet_distribution_raccordements dr on ot.id_sous_projet = dr.id_sous_projet
    WHERE ot.id_type_ordre_travail = 7 AND dr.ok <> 1
    UNION
    SELECT ot.* FROM ordre_de_travail ot
    INNER JOIN select_type_ordre_travail tot on ot.id_type_ordre_travail = tot.id_type_ordre_travail
    LEFT JOIN sous_projet_distribution_tirage dt on ot.id_sous_projet = dt.id_sous_projet
    LEFT JOIN sous_projet_distribution_raccordements dr on ot.id_sous_projet = dr.id_sous_projet
    WHERE ot.id_type_ordre_travail = 8 AND dt.ok <> 1 AND dr.ok <> 1
    UNION
    SELECT ot.* FROM ordre_de_travail ot
    INNER JOIN select_type_ordre_travail tot on ot.id_type_ordre_travail = tot.id_type_ordre_travail
    LEFT JOIN sous_projet_distribution_recette drec on ot.id_sous_projet = drec.id_sous_projet
    WHERE ot.id_type_ordre_travail = 10 AND drec.ok <> 1
