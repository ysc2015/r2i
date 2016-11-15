<?php
/**
 * file: get_projet_id.php
 * User: rabii
 */

extract($_POST);

$id = 0;
$nom = "";
$idetape = 0;
$primary_key = "";

$sousProjet = NULL;

if(isset($idsp) && !empty($idsp)){
    $sousProjet = SousProjet::first(
        array('conditions' =>
            array("id_sous_projet = ?", $idsp)
        )
    );
}

if($sousProjet !== NULL) {
    $id = ($sousProjet->projet->id_projet_osa!==NULL?$sousProjet->projet->id_projet_osa:0);

    if(isset($tentre) && !empty($tentre)) {
        switch($tentre) {
            case "infoplaque" :
                $primary_key = "id_sous_projet_plaque";
                break;
            case "infozone" :
                $primary_key = "id_sous_projet_zone";
                break;
            case "siteorigine" :
                $primary_key = "id_sous_projet_site_origine";
                break;
            case "plaquephase" :
                $primary_key = "id_sous_projet_plaque_phase";
                break;
            case "plaqueetude" :
                $primary_key = "id_sous_projet_plaque_traitement_etude";
                break;
            case "plaquecarto" :
                $primary_key = "id_sous_projet_plaque_carto";
                break;
            case "plaqueposadr" :
                $primary_key = "id_sous_projet_plaque_pos_adresse";
                break;
            case "plaquesurvadr" :
                $primary_key = "id_sous_projet_plaque_survey_adresse";
                break;
            case "transportdesign" :
                $primary_key = "id_sous_projet_transport_design";
                break;
            case "transportaiguillage" :
                $primary_key = "id_sous_projet_transport_aiguillage";
                break;
            case "transportcmcctr" :
                $primary_key = "id_sous_projet_transport_commande_ctr";
                break;
            case "transporttirage" :
                $primary_key = "id_sous_projet_transport_tirage";
                break;
            case "transportraccordement" :
                $primary_key = "id_sous_projet_transport_raccordements";
                break;
            case "transportrecette" :
                $primary_key = "id_sous_projet_transport_recette";
                break;
            case "distributiondesign" :
                $primary_key = "id_sous_projet_distribution_design";
                break;
            case "distributionaiguillage" :
                $primary_key = "id_sous_projet_distribution_aiguillage";
                break;
            case "distributioncmdcdi" :
                $primary_key = "id_sous_projet_distribution_commande_cdi";
                break;
            case "distributiontirage" :
                $primary_key = "id_sous_projet_distribution_tirage";
                break;
            case "distributionraccordement" :
                $primary_key = "id_sous_projet_distribution_raccordements";
                break;
            case "distributionrecette" :
                $primary_key = "id_sous_projet_distribution_recette";
                break;
            default : break;
        }

        if($sousProjet->{$tentre} !== NULL) {
            $idetape = $sousProjet->{$tentre}->$primary_key;
        }
    }

}

echo json_encode(array("id" => $id, "nom" => "PON ".$sousProjet->projet->nro->lib_nro." ".$sousProjet->ville, "idetape" => $idetape));
?>