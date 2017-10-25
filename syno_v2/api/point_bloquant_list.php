<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

include_once __DIR__ . '/ssp.class.php';

$table = "point_bloquant";

$columns = array
(
    array( "db" => "id_point_bloquant", "dt" => 'id_point_bloquant' ),
    array( "db" => "date_controle", "dt" => 'date_controle' ),
    array( "db" => "id_utilisateur", "dt" => 'id_utilisateur' ),
    array( "db" => "id_entreprise", "dt" => 'id_entreprise' ),
    array( "db" => "id_equipe_stt", "dt" => 'id_equipe_stt' ),
    array( "db" => "adresse", "dt" => 'adresse' ),
    array( "db" => "ref_chantier", "dt" => 'ref_chantier' ),
    array( "db" => "nature_travaux", "dt" => 'nature_travaux' ),
    array( "db" => "environement", "dt" => 'environement' ),
    array( "db" => "synthese", "dt" => 'synthese' ),
    array( "db" => "id_chambre", "dt" => 'id_chambre')
);

echo json_encode(SSP::simple($_GET, Configuration::$db, $table, "id_point_bloquant", $columns));
