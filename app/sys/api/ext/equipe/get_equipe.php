<?php
/**
 * file: get_equipe.php
 * User: rabii
 */

extract($_POST);
extract($_GET);

$table = array("equipe_stt as t1","entreprises_stt as t2");
$columns = array(
    array( "db" => "t1.id_equipe_stt", "dt" => 'id_entreprise' ),
    array( "db" => "t1.id_entreprise", "dt" => 'id_entreprise' ),
    array( "db" => "t1.id_equipe_types", "dt" => 'id_equipe_types' ),
    array( "db" => "t1.imei", "dt" => 'imei' ),
    array( "db" => "t1.nom", "dt" => 'nom' ),
    array( "db" => "t1.prenom", "dt" => 'prenom' ),
    array( "db" => "t1.tel", "dt" => 'tel' ),
    array( "db" => "t1.mail", "dt" => 'mail' ),

    array( "db" => "t2.id_entreprise  as ent_id_entreprise", "dt" => 'ent_id_entreprise' ),
    array( "db" => "t2.nom  as ent_nom", "dt" => 'ent_nom' ),
    array( "db" => "t2.code_entreprise  as ent_code_entreprise", "dt" => 'ent_code_entreprise' ),
    array( "db" => "t2.adresse_siege  as ent_adresse_siege", "dt" => 'ent_adresse_siege' ),
    array( "db" => "t2.adresse_livraison  as ent_adresse_livraison", "dt" => 'ent_adresse_livraison' ),
    array( "db" => "t2.gerant_entreprise  as ent_gerant_entreprise", "dt" => 'ent_gerant_entreprise' ),
    array( "db" => "t2.contact_nom  as ent_contact_nom", "dt" => 'ent_contact_nom' ),
    array( "db" => "t2.contact_prenom  as ent_contact_prenom", "dt" => 'ent_contact_prenom' ),
    array( "db" => "t2.contact_tel_mobile  as ent_contact_tel_mobile", "dt" => 'ent_contact_tel_mobile' ),
    array( "db" => "t2.contact_tel_fixe  as ent_contact_tel_fixe", "dt" => 'ent_contact_tel_fixe' ),
    array( "db" => "t2.contact_email  as ent_contact_email", "dt" => 'ent_contact_email' ),
);

if(!isset($ide) || empty($ide)) {
    $ide = -1;
}

$condition = "t1.id_entreprise = t2.id_entreprise";
$condition .= " AND t1.id_equipe_stt = $ide AND t1.id_equipe_types IN (SELECT id_equipe_types FROM equipe_types WHERE a2t = 1 AND id_equipe_types IS NOT NULL)";

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_equipe_stt",$columns,$condition,""));