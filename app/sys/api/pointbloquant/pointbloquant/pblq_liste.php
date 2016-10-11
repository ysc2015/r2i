<?php
/**
 * file: pblq_liste.php
 * User: rabii
 */

extract($_GET);

$table = array("point_bloquant as t1","point_bloquant_type_de_blocage as t2","point_bloquant_moyens_mis_en_oeuvre as t3","point_bloquant_solutions_preconisees as t4");
if(isset($idot) && !empty($idot)) {
    $table[] = "chambre as t5";
    $table[] = "ressource as t6";
}
$columns = array(
    array( "db" => "t1.id_point_bloquant", "dt" => 'id_point_bloquant' ),
    array( "db" => "t1.id_chambre as pblq1_id_chambre", "dt" => 'pblq1_id_chambre' ),
    array( "db" => "t1.date_controle as pblq1_date_controle", "dt" => 'pblq1_date_controle' ),
    array( "db" => "t1.utilisateur as pblq1_utilisateur", "dt" => 'pblq1_utilisateur' ),
    array( "db" => "t1.entreprise as pblq1_entreprise", "dt" => 'pblq1_entreprise' ),
    array( "db" => "t1.responsable as pblq1_responsable", "dt" => 'pblq1_responsable' ),
    array( "db" => "t1.adresse as pblq1_adresse", "dt" => 'pblq1_adresse' ),
    array( "db" => "t1.ref_chantier as pblq1_ref_chantier", "dt" => 'pblq1_ref_chantier' ),
    array( "db" => "t1.nature_travaux as pblq1_nature_travaux", "dt" => 'pblq1_nature_travaux' ),
    array( "db" => "t1.environement as pblq1_environement", "dt" => 'pblq1_environement' ),
    array( "db" => "t1.synthese as pblq1_synthese", "dt" => 'pblq1_synthese' ),
    array( "db" => "t2.id_point_bloquant_type_de_blocage as pblq2_id_point_bloquant_type_de_blocage", "dt" => 'pblq2_id_point_bloquant_type_de_blocage' ),
    array( "db" => "t2.id_point_bloquant as pblq2_id_point_bloquant", "dt" => 'pblq2_id_point_bloquant' ),
    array( "db" => "t2.reseau_en_aerien as pblq2_reseau_en_aerien", "dt" => 'pblq2_reseau_en_aerien' ),
    array( "db" => "t2.observation_reseau_en_aerien as pblq2_observation_reseau_en_aerien", "dt" => 'pblq2_observation_reseau_en_aerien' ),
    array( "db" => "t2.conduites_saturees as pblq2_conduites_saturees", "dt" => 'pblq2_conduites_saturees' ),
    array( "db" => "t2.observation_conduites_saturees as pblq2_observation_conduites_saturees", "dt" => 'pblq2_observation_conduites_saturees' ),
    array( "db" => "t2.conduites_cassees_ou_ecrasees as pblq2_conduites_cassees_ou_ecrasees", "dt" => 'pblq2_conduites_cassees_ou_ecrasees' ),
    array( "db" => "t2.observation_conduites_cassees_ou_ecrasees as pblq2_observation_conduites_cassees_ou_ecrasees", "dt" => 'pblq2_observation_conduites_cassees_ou_ecrasees' ),
    array( "db" => "t2.tampon_de_chambre_impossible_a_ouvrir as pblq2_tampon_de_chambre_impossible_a_ouvrir", "dt" => 'pblq2_tampon_de_chambre_impossible_a_ouvrir' ),
    array( "db" => "t2.observation_tampon_de_chambre_impossible_a_ouvrir as pblq2_observation_tampon_de_chambre_impossible_a_ouvrir", "dt" => 'pblq2_observation_tampon_de_chambre_impossible_a_ouvrir' ),
    array( "db" => "t2.chambre_sous_enrobe_ou_recouverte as pblq2_chambre_sous_enrobe_ou_recouverte", "dt" => 'pblq2_chambre_sous_enrobe_ou_recouverte' ),
    array( "db" => "t2.observation_chambre_sous_enrobe_ou_recouverte as pblq2_observation_chambre_sous_enrobe_ou_recouverte", "dt" => 'pblq2_observation_chambre_sous_enrobe_ou_recouverte' ),
    array( "db" => "t2.reseau_emprise_privee as pblq2_reseau_emprise_privee", "dt" => 'pblq2_reseau_emprise_privee' ),
    array( "db" => "t2.observation_reseau_emprise_privee as pblq2_observation_reseau_emprise_privee", "dt" => 'pblq2_observation_reseau_emprise_privee' ),
    array( "db" => "t2.chambre_inexploitable as pblq2_chambre_inexploitable", "dt" => 'pblq2_chambre_inexploitable' ),
    array( "db" => "t2.observation_chambre_inexploitable as pblq2_observation_chambre_inexploitable", "dt" => 'pblq2_observation_chambre_inexploitable' ),
    array( "db" => "t2.probleme_d_acces as pblq2_probleme_d_acces", "dt" => 'pblq2_probleme_d_acces' ),
    array( "db" => "t2.observation_probleme_d_acces as pblq2_observation_probleme_d_acces", "dt" => 'pblq2_observation_probleme_d_acces' ),
    array( "db" => "t2.autre_point_de_blocage as pblq2_autre_point_de_blocage", "dt" => 'pblq2_autre_point_de_blocage' ),
    array( "db" => "t3.id_point_bloquant_moyens_mis_en_oeuvre as pblq3_id_point_bloquant_moyens_mis_en_oeuvre", "dt" => 'pblq3_id_point_bloquant_moyens_mis_en_oeuvre' ),
    array( "db" => "t3.id_point_bloquant as pblq3_id_point_bloquant", "dt" => 'pblq3_id_point_bloquant' ),
    array( "db" => "t3.aiguillage_au_compresseur as pblq3_aiguillage_au_compresseur", "dt" => 'pblq3_aiguillage_au_compresseur' ),
    array( "db" => "t3.observation_aiguillage_au_compresseur as pblq3_observation_aiguillage_au_compresseur", "dt" => 'pblq3_observation_aiguillage_au_compresseur' ),
    array( "db" => "t3.aiguillage_avec_aiguille_de_11_13mm as pblq3_aiguillage_avec_aiguille_de_11_13mm", "dt" => 'pblq3_aiguillage_avec_aiguille_de_11_13mm' ),
    array( "db" => "t3.observation_aiguillage_avec_aiguille_de_11_13mm as pblq3_observation_aiguillage_avec_aiguille_de_11_13mm", "dt" => 'pblq3_observation_aiguillage_avec_aiguille_de_11_13mm' ),
    array( "db" => "t3.aiguillage_aux_cannes as pblq3_aiguillage_aux_cannes", "dt" => 'pblq3_aiguillage_aux_cannes' ),
    array( "db" => "t3.observation_aiguillage_aux_cannes as pblq3_observation_aiguillage_aux_cannes", "dt" => 'pblq3_observation_aiguillage_aux_cannes' ),
    array( "db" => "t3.hydrocurage as pblq3_hydrocurage", "dt" => 'pblq3_hydrocurage' ),
    array( "db" => "t3.observation_hydrocurage as pblq3_observation_hydrocurage", "dt" => 'pblq3_observation_hydrocurage' ),
    array( "db" => "t3.identification_du_point_bloquant_au_metre as pblq3_identification_du_point_bloquant_au_metre", "dt" => 'pblq3_identification_du_point_bloquant_au_metre' ),
    array( "db" => "t3.observation_identification_du_point_bloquant_au_metre as pblq3_observation_identification_du_point_bloquant_au_metre", "dt" => 'pblq3_observation_identification_du_point_bloquant_au_metre' ),
    array( "db" => "t3.identification_a_la_sonde as pblq3_identification_a_la_sonde", "dt" => 'pblq3_identification_a_la_sonde' ),
    array( "db" => "t3.observation_identification_a_la_sonde as pblq3_observation_identification_a_la_sonde", "dt" => 'pblq3_observation_identification_a_la_sonde' ),
    array( "db" => "t3.tentative_de_contact_du_proprietaire_ou_gestionnaire as pblq3_tentative_de_contact_du_proprietaire_ou_gestionnaire", "dt" => 'pblq3_tentative_de_contact_du_proprietaire_ou_gestionnaire' ),
    array( "db" => "t3.observation_tentative_de_contact_du_proprietaire_ou_gestionnaire as pblq3_observation_tentative_de_contact_du_proprietaire_ou_gestionnaire", "dt" => 'pblq3_observation_tentative_de_contact_du_proprietaire_ou_gestionnaire' ),
    array( "db" => "t4.id_point_bloquant_solutions_preconisees as pblq4_id_point_bloquant_solutions_preconisees", "dt" => 'pblq4_id_point_bloquant_solutions_preconisees' ),
    array( "db" => "t4.id_point_bloquant as pblq4_id_point_bloquant", "dt" => 'pblq4_id_point_bloquant' ),
    array( "db" => "t4.aiguillage_au_compresseur as pblq4_aiguillage_au_compresseur", "dt" => 'pblq4_aiguillage_au_compresseur' ),
    array( "db" => "t4.observation_aiguillage_au_compresseur as pblq4_observation_aiguillage_au_compresseur", "dt" => 'pblq4_observation_aiguillage_au_compresseur' ),
    array( "db" => "t4.aiguillage_avec_aiguille as pblq4_aiguillage_avec_aiguille", "dt" => 'pblq4_aiguillage_avec_aiguille' ),
    array( "db" => "t4.observation_aiguillage_avec_aiguille_de_13mm as pblq4_observation_aiguillage_avec_aiguille_de_13mm", "dt" => 'pblq4_observation_aiguillage_avec_aiguille_de_13mm' ),
    array( "db" => "t4.aiguillage_aux_cannes as pblq4_aiguillage_aux_cannes", "dt" => 'pblq4_aiguillage_aux_cannes' ),
    array( "db" => "t4.observation_aiguillage_aux_cannes as pblq4_observation_aiguillage_aux_cannes", "dt" => 'pblq4_observation_aiguillage_aux_cannes' ),
    array( "db" => "t4.hydrocurage as pblq4_hydrocurage", "dt" => 'pblq4_hydrocurage' ),
    array( "db" => "t4.observation_hydrocurage as pblq4_observation_hydrocurage", "dt" => 'pblq4_observation_hydrocurage' ),
    array( "db" => "t4.changement_de_parcourt as pblq4_changement_de_parcourt", "dt" => 'pblq4_changement_de_parcourt' ),
    array( "db" => "t4.observation_changement_de_parcourt as pblq4_observation_changement_de_parcourt", "dt" => 'pblq4_observation_changement_de_parcourt' ),
    array( "db" => "t4.fouille_ponctuelle as pblq4_fouille_ponctuelle", "dt" => 'pblq4_fouille_ponctuelle' ),
    array( "db" => "t4.observation_fouille_ponctuelle as pblq4_observation_fouille_ponctuelle", "dt" => 'pblq4_observation_fouille_ponctuelle' ),
    array( "db" => "t4.genie_civil as pblq4_genie_civil", "dt" => 'pblq4_genie_civil' ),
    array( "db" => "t4.observation_genie_civil as pblq4_observation_genie_civil", "dt" => 'pblq4_observation_genie_civil' ),
    array( "db" => "t4.negociation_avec_le_gestionnaire_prive as pblq4_negociation_avec_le_gestionnaire_prive", "dt" => 'pblq4_negociation_avec_le_gestionnaire_prive' ),
    array( "db" => "t4.observation_negociation_avec_le_gestionnaire_prive as pblq4_observation_negociation_avec_le_gestionnaire_prive", "dt" => 'pblq4_observation_negociation_avec_le_gestionnaire_prive' ),
    array( "db" => "t4.accompagnement_FREE as pblq4_accompagnement_FREE", "dt" => 'pblq4_accompagnement_FREE' ),
    array( "db" => "t4.observation_accompagnement_FREE as pblq4_observation_accompagnement_FREE", "dt" => 'pblq4_observation_accompagnement_FREE' ),
    array( "db" => "t4.commentaires_supplementaire as pblq4_commentaires_supplementaire", "dt" => 'pblq4_commentaires_supplementaire' )

);

$condition = "t1.id_point_bloquant = t2.id_point_bloquant AND t1.id_point_bloquant = t3.id_point_bloquant AND t1.id_point_bloquant = t4.id_point_bloquant";

if(isset($idchambre) && !empty($idchambre)) {
    $condition .=" AND t1.id_chambre=$idchambre";
} else {
    if(isset($idot) && !empty($idot)) {
        $condition .=" AND t1.id_chambre=t5.id_chambre AND t5.id_ressource = t6.id_ressource AND t6.id_ordre_de_travail=$idot";
    }
}

echo json_encode(SSP::simpleJoin($_GET,$db,$table,"id_point_bloquant",$columns,$condition));
?>