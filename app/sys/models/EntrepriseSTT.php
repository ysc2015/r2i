<?php
/**
 * file: EntrepriseSTT.php
 * User: rabii
 */

class EntrepriseSTT extends ActiveRecord\Model {
    static $table_name = 'entreprises_stt';

    static $has_many = array(
        array(
            'equipes',
            'class_name' => 'EquipeSTT',
            'foreign_key' => 'id_entreprise'
        ),
        array(
            'users',
            'class_name' => 'Utilisateur',
            'foreign_key' => 'id_entreprise'
        )
    );
}