<?php
/**
 * file: SousProjet.php
 * User: rabii
 */

class SousProjet extends ActiveRecord\Model {
    static $table_name = 'sous_projet';

    static $belongs_to = array(
        array(
            'projet',
            'class_name' => 'Projet',
            'foreign_key' => 'id_projet'
        )
    );

    static $has_one = array(
        /**
         * INFO ZONE DE TRAVAUX (SOUS-PROJET)
         */
        array(
            'infoplaque',
            'class_name' => 'SousProjetInfoPlaque',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'infozone',
            'class_name' => 'SousProjetZone',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'siteorigine',
            'class_name' => 'SousProjetSiteOrigine',
            'foreign_key' => 'id_sous_projet'
        ),
        /**
         * GESTION PLAQUE
         */
        array(
            'plaquephase',
            'class_name' => 'SousProjetPlaquePhase',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'plaqueetude',
            'class_name' => 'SousProjetPlaqueTraitementEtude',
            'foreign_key' => 'id_sous_projet'
        ),
        /**
         * PRÉPARATION PLAQUE
         */
        array(
            'plaquecarto',
            'class_name' => 'SousProjetPlaqueCarto',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'plaqueposadr',
            'class_name' => 'SousProjetPlaquePosAdresse',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'plaquesurvadr',
            'class_name' => 'SousProjetPlaqueSurveyAdresse',
            'foreign_key' => 'id_sous_projet'
        ),
        /**
         * RÉSEAU DE TRANSPORT
         */
        array(
            'transportdesign',
            'class_name' => 'SousProjetTransportDesign',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'transportaiguillage',
            'class_name' => 'SousProjetTransportAiguillage',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'transportcmcctr',
            'class_name' => 'SousProjetTransportCommandeCTR',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'transporttirage',
            'class_name' => 'SousProjetTransportTirage',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'transportraccordement',
            'class_name' => 'SousProjetTransportRaccordement',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'transportrecette',
            'class_name' => 'SousProjetTransportRecette',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'transportcmdfintravaux',
            'class_name' => 'SousProjetTransportCommandeFinTravaux',
            'foreign_key' => 'id_sous_projet'
        ),
        /**
         * RÉSEAU DE DISTRIBUTION
         */
        array(
            'distributiondesign',
            'class_name' => 'SousProjetDistributionDesign',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'distributionaiguillage',
            'class_name' => 'SousProjetDistributionAiguillage',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'distributioncmdcdi',
            'class_name' => 'SousProjetDistributionCommandeCDI',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'distributiontirage',
            'class_name' => 'SousProjetDistributionTirage',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'distributionraccordement',
            'class_name' => 'SousProjetDistributionRaccordement',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'distributionrecette',
            'class_name' => 'SousProjetDistributionRecette',
            'foreign_key' => 'id_sous_projet'
        ),
        array(
            'distributioncmdfintravaux',
            'class_name' => 'SousProjetDistributionCommandeFinTravaux',
            'foreign_key' => 'id_sous_projet'
        )
    );
}