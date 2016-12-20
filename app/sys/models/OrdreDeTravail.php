<?php
/**
 * file: OrdreDeTravail.php
 * User: rabii
 */

class OrdreDeTravail extends ActiveRecord\Model {
    static $table_name = 'ordre_de_travail';

    //liaison sousprojet
    static $belongs_to = array(
        array(
            'sousprojet',
            'class_name' => 'SousProjet',
            'foreign_key' => 'id_sous_projet'
        )
    );
}