<?php
/**
 * file: SousProjet.php
 * User: rabii
 */

class SousProjet extends ActiveRecord\Model {
    static $table_name = 'sous_projet';

    static $has_one = array(
        /**
         * infos zone de travaux
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
        )
    );
}