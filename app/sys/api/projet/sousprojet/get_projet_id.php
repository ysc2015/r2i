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
                $primary_key = "SousProjetInfoPlaque";
                break;
            case "infozone" :
                $primary_key = "SousProjetZone";
                break;
            case "siteorigine" :
                $primary_key = "SousProjetSiteOrigine";
                break;
            case "plaquephase" :
                $primary_key = "SousProjetPlaquePhase";
                break;
            case "plaqueetude" :
                $primary_key = "SousProjetPlaqueTraitementEtude";
                break;
            case "plaquecarto" :
                $primary_key = "SousProjetPlaqueCarto";
                break;
            case "plaqueposadr" :
                $primary_key = "SousProjetPlaquePosAdresse";
                break;
            case "plaquesurvadr" :
                $primary_key = "SousProjetPlaqueSurveyAdresse";
                break;
            case "transportdesign" :
                $primary_key = "SousProjetTransportDesign";
                break;
            case "transportaiguillage" :
                $primary_key = "id_sous_projet_transport_aiguillage";
                break;
            case "transportcmcctr" :
                $primary_key = "SousProjetTransportCommandeCTR";
                break;
            case "transporttirage" :
                $primary_key = "SousProjetTransportTirage";
                break;
            case "transportraccordement" :
                $primary_key = "SousProjetTransportRaccordement";
                break;
            case "transportrecette" :
                $primary_key = "SousProjetTransportRecette";
                break;
            case "distributiondesign" :
                $primary_key = "SousProjetDistributionDesign";
                break;
            case "distributionaiguillage" :
                $primary_key = "SousProjetDistributionAiguillage";
                break;
            case "distributioncmdcdi" :
                $primary_key = "SousProjetDistributionCommandeCDI";
                break;
            case "distributiontirage" :
                $primary_key = "SousProjetDistributionTirage";
                break;
            case "distributionraccordement" :
                $primary_key = "SousProjetDistributionRaccordement";
                break;
            case "distributionrecette" :
                $primary_key = "SousProjetDistributionRecette";
                break;
            default : break;
        }

        if($sousProjet->{$tentre} !== NULL) {
            $idetape = $sousProjet->{$tentre}->$primary_key;
        }
    }

}

echo json_encode(array("id" => $id, "nom" => $sousProjet->projet->projet_nom, "idetape" => $idetape));
?>