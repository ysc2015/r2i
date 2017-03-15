<?php
/**
 * file: get_equipe.php
 * User: rabii
 */

extract($_POST);
extract($_GET);

$table = array("equipe_stt as t1","entreprises_stt as t2");
$columns = array(
    array( "db" => "t1.id_equipe_stt", "dt" => 'id_equipe_stt' ),
    array( "db" => "t1.id_entreprise", "dt" => 'id_entreprise' ),
    array( "db" => "t1.id_equipe_types", "dt" => 'id_equipe_types' ),
    array( "db" => "t1.imei", "dt" => 'imei' ),
    array( "db" => "t1.nom", "dt" => 'nom' ),
    array( "db" => "t1.prenom", "dt" => 'prenom' ),
    array( "db" => "t1.tel", "dt" => 'tel' ),
    array( "db" => "t1.mail", "dt" => 'mail' ),
    array( "db" => "t2.id_entreprise as id_entreprise_ent", "dt" => 'id_entreprise_ent' ),
    array( "db" => "t2.nom as nom_ent", "dt" => 'nom_ent' ),
    array( "db" => "t2.code_entreprise", "dt" => 'code_entreprise' ),
    array( "db" => "t2.adresse_siege", "dt" => 'adresse_siege' ),
    array( "db" => "t2.adresse_livraison", "dt" => 'adresse_livraison' ),
    array( "db" => "t2.gerant_entreprise", "dt" => 'gerant_entreprise' ),
    array( "db" => "t2.contact_nom", "dt" => 'contact_nom' ),
    array( "db" => "t2.contact_prenom", "dt" => 'contact_prenom' ),
    array( "db" => "t2.contact_tel_mobile", "dt" => 'contact_tel_mobile' ),
    array( "db" => "t2.contact_tel_fixe", "dt" => 'contact_tel_fixe' ),
    array( "db" => "t2.contact_email", "dt" => 'contact_email' )
);

$condition = "t1.id_entreprise = t2.id_entreprise";
$condition .= " AND t1.id_equipe_types IN (SELECT id_equipe_types FROM equipe_types WHERE a2t = 1 AND id_equipe_types IS NOT NULL)";

if(isset($ide) && !empty($ide)) {
    $condition .= " AND t1.id_equipe_stt = $ide";
}


echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_equipe_stt",$columns,$condition,""));