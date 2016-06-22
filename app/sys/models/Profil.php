<?php
/**
 * file: Profil.php
 * User: rabii
 */

class Profil extends ActiveRecord\Model {
    static $table_name = 'profil_utilisateur';

    static $has_many = array(
        array(
            'utilisateurs',
            'class_name' => 'Utilisateur',
            'foreign_key' => 'id_profil_utilisateur'
        )
    );
}