<?php
/**
 * file: update_charge_be_prise_en_charge.php
 * User: fadil
 */

ini_set("display_errors",'1');
//sleep(2);

extract($_POST);



$err = 0;
$message = array();

$sousProjet = NULL;
$stm = NULL;
$insert = false;
$update = false;
if(isset($ids) && !empty($ids)){
    $sousProjet = SousProjet::find($ids);
}
$dt = null;
if($sousProjet !== NULL) {
    if(isset($tentree) && !empty($tentree)) {
        if($sousProjet->{$tentree} !== NULL) {
            switch($tentree) {
                case "transportdesign" :
                    $primary_key = "id_sous_projet_transport_design";
                    $table_name = "sous_projet_transport_design";
                    break;
                case "transportaiguillage" :
                    $primary_key = "id_sous_projet_transport_aiguillage";
                    $table_name = "sous_projet_transport_aiguillage";
                    break;
                case "transportcmcctr" :
                    $primary_key = "id_sous_projet_transport_commande_ctr";
                    $table_name = "sous_projet_transport_commande_ctr";
                    break;
                case "transporttirage" :
                    $primary_key = "id_sous_projet_transport_tirage";
                    $table_name = "sous_projet_transport_tirage";
                    break;
                case "transportraccordement" :
                    $primary_key = "id_sous_projet_transport_raccordements";
                    $table_name = "sous_projet_transport_raccordements";
                    break;
                case "transportrecette" :
                    $primary_key = "id_sous_projet_transport_recette";
                    $table_name = "sous_projet_transport_recette";
                    break;
                case "transportcmdfintravaux" :
                    $primary_key = "id_sous_projet_transport_commande_fin_travaux";
                    $table_name = "sous_projet_transport_commande_fin_travaux";
                    break;
                case "distributiondesign" :
                    $primary_key = "id_sous_projet_distribution_design";
                    $table_name = "sous_projet_distribution_design";
                    break;
                case "distributionaiguillage" :
                    $primary_key = "id_sous_projet_distribution_aiguillage";
                    $table_name = "sous_projet_distribution_aiguillage";
                    break;
                case "distributioncmdcdi" :
                    $primary_key = "id_sous_projet_distribution_commande_cdi";
                    $table_name = "sous_projet_distribution_commande_cdi";
                    break;
                case "distributiontirage" :
                    $primary_key = "id_sous_projet_distribution_tirage";
                    $table_name = "sous_projet_distribution_tirage";
                    break;
                case "distributionraccordement" :
                    $primary_key = "id_sous_projet_distribution_raccordements";
                    $table_name = "sous_projet_distribution_raccordements";
                    break;
                case "distributionrecette" :
                    $primary_key = "id_sous_projet_distribution_recette";
                    $table_name = "sous_projet_distribution_recette";
                    break;
                case "distributioncmdfintravaux" :
                    $primary_key = "id_sous_projet_distribution_commande_fin_travaux";
                    $table_name = "sous_projet_distribution_commande_fin_travaux";
                    break;
                default : break;
            }

            if($sousProjet !== NULL) {


                $stm = $db->prepare("update $table_name set date_charge_be = :date_charge_be where id_sous_projet =:id_sous_projet");
                if($actif==0) $dt = date('Y-m-d H:i:s:');else $dt = NULL;
                $stm->bindParam(':date_charge_be',$dt);
                $stm->bindParam(':id_sous_projet',$ids);

                if($stm->execute()){
                    $message [] = "Enregistrement Charge BE fait avec succès";
                }else{
                    $message[] = "Erreur requete non execute!";
                    $err++;
                }



            }
        } else {
            $err++;
            $message[] = "Etape ".$lang[$tentree]." non enregistrée, veuillez l'enregistrer svp!";
        }
    } else {
        $err++;
        $message[] = "Erreur reférence entrée";
    }
} else {
    $err++;
    $message[] = "Erreur reférence sous projet";
}


echo json_encode(array("error" => $err , "message" => $message ,"date_charge_be" => $dt ));
