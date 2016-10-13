<?php
/**
 * file: projet_liste.php
 * User: rabii
 */

ini_set("display_errors","1");

$table = array("projet as t1","select_site_origine_type as t2","select_site_origine_etat as t3","select_ville as t4","nro as t5");

$columns = array(
    array( "db" => "t1.id_projet", "dt" => 'id_projet' ),
    array( "db" => "t1.id_projet_osa", "dt" => 'id_projet_osa' ),
    array( "db" => "t1.id_chef_projet", "dt" => 'id_chef_projet' ),
    array( "db" => "t1.ville_nom", "dt" => 'ville_nom' ),
    array( "db" => "t1.ville", "dt" => 'ville' ),
    array( "db" => "t1.projet_nom", "dt" => 'projet_nom' ),
    array( "db" => "t4.nom_ville", "dt" => 'nom_ville' ),
    array( "db" => "t1.trigramme_dept", "dt" => 'trigramme_dept' ),
    array( "db" => "t1.code_site_origine", "dt" => 'code_site_origine' ),
    array( "db" => "t5.lib_nro", "dt" => 'lib_nro' ),
    array( "db" => "t1.type_site_origine", "dt" => 'type_site_origine' ),
    array( "db" => "t2.lib_site_origine_type", "dt" => 'lib_site_origine_type' ),
    array( "db" => "t1.taille", "dt" => 'taille' ),
    array( "db" => "t1.etat_site_origine", "dt" => 'etat_site_origine' ),
    array( "db" => "t3.lib_site_origine_etat", "dt" => 'lib_site_origine_etat' ),
    array( "db" => "t1.date_mad_site_origine", "dt" => 'date_mad_site_origine' ),
    array( "db" => "t1.date_creation", "dt" => 'date_creation' ),
    array( "db" => "t1.date_attribution", "dt" => 'date_attribution' )
);

$condition = "t1.type_site_origine=t2.id_site_origine_type AND t1.etat_site_origine=t3.id_site_origine_etat AND t1.ville = t4.code_ville AND t1.code_site_origine = t5.id_nro";


switch($connectedProfil->profil->profil->shortlib) {
    case "bei" :
        $table[] = "sous_projet as t6";
        $condition .=" AND t1.id_projet = t6.id_projet";
        $condition .=" AND t6.users_in  LIKE '%|".$connectedProfil->profil->id_utilisateur."|%'";
        break;

    case "cdp" :
        $condition .=" AND t1.id_chef_projet = ".$connectedProfil->profil->id_utilisateur;
        break;

    case "vpi" :
        $arr = array(-1);
        $stm = $db->prepare("select id_nro from nro where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
        $stm->execute();
        $nros = $stm->fetchAll();
        foreach($nros as $nro) {
            $arr[] = $nro['id_nro'];
        }

        $condition .=" AND t1.code_site_origine IN ( ".implode(",",$arr).")";
        break;

    default : break;
}



echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_projet",$columns,$condition));
?>