<?php
/**
 * file: Projet.php
 * User: rabii
 */

class Projet extends ActiveRecord\Model {
    static $table_name = 'projet';

    static $has_many = array(
        array(
            'sous_projets',
            'class_name' => 'SousProjet',
            'foreign_key' => 'id_projet'
        )
    );
}