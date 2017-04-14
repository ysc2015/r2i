ALTER TABLE `chambre` ADD `manchon_prevu` BOOLEAN NOT NULL AFTER `traite`;
ALTER TABLE `syno_alveole_diametre` DROP `id_alveole_diametre`;

DROP TABLE `syno_alveole_diametre`;
CREATE TABLE `syno_alveole_diametre` (
    `val_alveole_diametre` INT(11) PRIMARY KEY
) ENGINE=InnoDB;

INSERT INTO `syno_alveole_diametre` VALUES (60),(80),(100);

DROP TABLE `syno_diametre`;
CREATE TABLE `syno_diametre` (
    `valeur_diametre` INT(11) PRIMARY KEY
) ENGINE=InnoDB;

INSERT INTO `syno_diametre` VALUES (32),(45),(60),(80),(100),(150);

DROP TABLE `syno_diametre`;
CREATE TABLE `syno_diametre` (
    `valeur_diametre` INT(11) PRIMARY KEY
) ENGINE=InnoDB;

INSERT INTO `syno_diametre` VALUES (32),(45),(60),(80),(100),(150);

DROP TABLE `syno_masque`;
CREATE TABLE `syno_masque` (
  `nom` varchar(10) PRIMARY KEY
) ENGINE=InnoDB;

INSERT INTO `syno_masque` (`nom`) VALUES
('A'),
('B'),
('C'),
('D'),
('E'),
('F'),
('G'),
('H'),
('I'),
('J'),
('GV'),
('SE'),
('SS'),
('CF'),
('GC'),
('CA'),
('AP'),
('AE');


DROP TABLE `syno_type_chambre`;
CREATE TABLE `syno_type_chambre` (
  `lib_type_chambre` varchar(30) PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `syno_type_chambre` (`lib_type_chambre`) VALUES
( 'A1'),
( 'A2'),
( 'A3'),
( 'A4'),
('B1'),
('B2'),
('C1'),
('C2'),
('C3'),
('D2'),
('D3'),
('D4'),
('E1'),
('E2'),
('E3'),
('E4'),
('Façade'),
('IMB'),
('K1C'),
('K2C'),
('K3C'),
('L1T'),
('L2T'),
('L3T'),
('L4T'),
('L6T'),
('M1'),
('M2'),
('M3'),
('OHN'),
('P1'),
('P2'),
('P3'),
('P4'),
('P5'),
('P6'),
('Poteau'),
('Transition');

DROP TABLE `syno_type_infra`;

DROP TABLE `syno_type_reseau`;
CREATE TABLE `syno_type_reseau` (
  `lib_type_reseau` varchar(30) PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `syno_type_reseau` (`lib_type_reseau`) VALUES
('FT'),
('FREE'),
('Privé'),
('CG à Créer');

ALTER TABLE `chambre` ADD `manchon_prevu` BOOLEAN NOT NULL AFTER `traite`;
ALTER TABLE `syno_alveole_diametre` DROP `id_alveole_diametre`;

DROP TABLE `syno_alveole_diametre`;
CREATE TABLE `syno_alveole_diametre` (
    `val_alveole_diametre` INT(11) PRIMARY KEY
) ENGINE=InnoDB;

INSERT INTO `syno_alveole_diametre` VALUES (60),(80),(100);

DROP TABLE `syno_diametre`;
CREATE TABLE `syno_diametre` (
    `valeur_diametre` INT(11) PRIMARY KEY
) ENGINE=InnoDB;

INSERT INTO `syno_diametre` VALUES (32),(45),(60),(80),(100),(150);

DROP TABLE `syno_masque`;
CREATE TABLE `syno_masque` (
  `nom` varchar(10) PRIMARY KEY
) ENGINE=InnoDB;

INSERT INTO `syno_masque` (`nom`) VALUES
('A'),
('B'),
('C'),
('D'),
('E'),
('F'),
('G'),
('H'),
('I'),
('J'),
('GV'),
('SE'),
('SS'),
('CF'),
('GC'),
('CA'),
('AP'),
('AE');


DROP TABLE `syno_type_chambre`;
CREATE TABLE `syno_type_chambre` (
  `lib_type_chambre` varchar(30) PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `syno_type_chambre` (`lib_type_chambre`) VALUES
( 'A1'),
( 'A2'),
( 'A3'),
( 'A4'),
('B1'),
('B2'),
('C1'),
('C2'),
('C3'),
('D2'),
('D3'),
('D4'),
('E1'),
('E2'),
('E3'),
('E4'),
('Façade'),
('IMB'),
('K1C'),
('K2C'),
('K3C'),
('L1T'),
('L2T'),
('L3T'),
('L4T'),
('L6T'),
('M1'),
('M2'),
('M3'),
('OHN'),
('P1'),
('P2'),
('P3'),
('P4'),
('P5'),
('P6'),
('Poteau'),
('Transition');

DROP TABLE `syno_type_infra`;

DROP TABLE `syno_type_reseau`;
CREATE TABLE `syno_type_reseau` (
  `lib_type_reseau` varchar(30) PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `syno_type_reseau` (`lib_type_reseau`) VALUES
('FT'),
('FREE'),
('Privé'),
('CG à Créer');


CREATE TABLE IF NOT EXISTS `syno_alveole` (
  `id_alveole` int(11) NOT NULL,
  `masque` varchar(10) DEFAULT NULL,
  `taille` varchar(10) NOT NULL,
  `etat` varchar(10) NOT NULL,
  `position` int(11) NOT NULL,
  `couleur` int(11) NOT NULL,
  `tubage` int(11) NOT NULL,
  `tubage_taille` varchar(10) NOT NULL,
  `id_chambre_src` varchar(10) NOT NULL,
  `id_chambre_dst` varchar(10) NOT NULL,
  PRIMARY KEY (`id_alveole`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;