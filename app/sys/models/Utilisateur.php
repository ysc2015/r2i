<?php
/**
 * file: Utilisateur.php
 * User: rabii
 */

class Utilisateur extends ActiveRecord\Model {
    static $table_name = 'utilisateur';

    static $belongs_to = array(
        array('profil',
            'class_name' => 'Profil',
            'primary_key' => 'id_profil_utilisateur',
            'foreign_key' => 'id_profil_utilisateur'
        )
    );
}