<?php
/**
 * file: get_entreprise.php
 * User: rabii
 */
extract($_POST);
extract($_GET);


$table = array("entreprises_stt as t1","equipe_stt as t2");
$columns = array(
    array( "db" => "t1.id_entreprise", "dt" => 'id_entreprise' ),
    array( "db" => "t1.nom", "dt" => 'nom' ),
    array( "db" => "t1.code_entreprise", "dt" => 'code_entreprise' ),
    array( "db" => "t1.adresse_siege", "dt" => 'adresse_siege' ),
    array( "db" => "t1.adresse_livraison", "dt" => 'adresse_livraison' ),
    array( "db" => "t1.gerant_entreprise", "dt" => 'gerant_entreprise' ),
    array( "db" => "t1.contact_nom", "dt" => 'contact_nom' ),
    array( "db" => "t1.contact_prenom", "dt" => 'contact_prenom' ),
    array( "db" => "t1.contact_tel_mobile", "dt" => 'contact_tel_mobile' ),
    array( "db" => "t1.contact_tel_fixe", "dt" => 'contact_tel_fixe' ),
    array( "db" => "t1.contact_email", "dt" => 'contact_email' ),
    array( "db" => "t2.id_equipe_stt as equipe_id_equipe_stt", "dt" => 'equipe_id_equipe_stt' ),
    array( "db" => "t2.id_entreprise as equipe_id_entreprise", "dt" => 'equipe_id_entreprise' ),
    array( "db" => "t2.id_equipe_types as equipe_id_equipe_types ", "dt" => 'equipe_id_equipe_types' ),
    array( "db" => "t2.imei as equipe_imei", "dt" => 'equipe_imei' ),
    array( "db" => "t2.nom as equipe_nom", "dt" => 'equipe_nom' ),
    array( "db" => "t2.prenom as equipe_prenom", "dt" => 'equipe_prenom' ),
    array( "db" => "t2.tel as equipe_tel", "dt" => 'equipe_tel' ),
    array( "db" => "t2.mail as equipe_mail", "dt" => 'equipe_mail' )
);

if(!isset($ide) || empty($ide)) {
    $ide = -1;
}

//$condition = "t1.id_entreprise IN (SELECT DISTINCT id_entreprise FROM equipe_stt et WHERE et.id_equipe_types IN (SELECT id_equipe_types FROM equipe_types WHERE a2t = 1 AND id_equipe_types IS NOT NULL) AND t1.id_entreprise IS NOT NULL)";
$condition = "t1.id_entreprise = t2.id_entreprise AND t1.id_entreprise = $ide AND t2.id_equipe_types IN (SELECT id_equipe_types FROM equipe_types WHERE a2t = 1 AND id_equipe_types IS NOT NULL)";


echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_entreprise",$columns,$condition,""));