<?php
/**
 * file: SousProjet.php
 * User: rabii
 */

class SousProjet extends ActiveRecord\Model {
    static $table_name = 'sous_projet';

    /*static $belongs_to = array(
        array('projet',
            'class_name' => 'Projet',
            'primary_key' => 'id_sous_projet',
            'foreign_key' => 'id_sous_projet'
        )
    );*/
}