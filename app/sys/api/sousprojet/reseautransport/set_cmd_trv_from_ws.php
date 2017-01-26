<?php
/**
 * file: set_cmd_trv_from_ws.php
 * User: rabii
 */

extract($_POST);

$err = 0;
$message = array();
$etapes = array("transportcmcctr","transportcmdfintravaux","distributioncmdcdi","distributioncmdfintravaux");
$etapes_tbl = array(
    "transportcmcctr" =>"sous_projet_transport_commande_ctr",
    "transportcmdfintravaux" =>"sous_projet_transport_commande_fin_travaux",
    "distributioncmdcdi" =>"sous_projet_distribution_commande_cdi",
    "distributioncmdfintravaux" =>"sous_projet_distribution_commande_fin_travaux"
);

$fci_states_arr = array(
    "etat.annule" => 4,
    "etat.depose" => 2,
    "etat.encours" => 1,
    "etat.miseadispo" => 5,
    "etat.rejete" => 3,
);

$affected_rows = array(
    "form" => "",
    "dd" => "",
    "df" => "",
    "gf" => ""
);

$forms_to_tbl_arr = array(
    "transport_cmdctr_form" => "transportcmcctr",
    "transport_cmdfintrvx_form" => "transportcmdfintravaux",
    "dist_cmdcdi_form" => "distributioncmdcdi",
    "distribution_cmdfintrvx_form" => "distributioncmdfintravaux"
);

if(isset($tentree)) $tentree = $forms_to_tbl_arr[$tentree];

if(isset($idsp) && !empty($idsp)) {

    if(isset($tentree) && !empty($tentree) && in_array($tentree,$etapes)) {

        $sousProjet = SousProjet::first(
            array('conditions' =>
                array("id_sous_projet = ?", $idsp)
            )
        );

        if($sousProjet !== NULL) {

            if($tentree == "transportcmcctr" || $tentree == "transportcmdfintravaux") {

                $sousProjet_master = SousProjet::first(
                    array('conditions' =>
                        array("id_projet = ? AND is_master = 1", $sousProjet->id_projet)
                    )
                );

                if($sousProjet_master !== NULL) {
                    if($sousProjet_master->id_sous_projet != $sousProjet->id_sous_projet) {
                        $err++;
                        $message[] = "ce sous projet n'est pas maitre CTR !";
                    }
                }
            }

            if($err==0) {
                if($sousProjet->{$tentree} !== NULL) {

                    $stm = $db->prepare("update $etapes_tbl[$tentree] set date_depot_cmd=:date_depot_cmd,date_debut_travaux_ft=:date_debut_travaux_ft,date_fin_travaux_ft=:date_fin_travaux_ft,go_ft=:go_ft where id_sous_projet=:id_sous_projet");

                    $dd = explode('/',$dd)[2]."-".explode('/',$dd)[1]."-".explode('/',$dd)[0];
                    $df = explode('/',$df)[2]."-".explode('/',$df)[1]."-".explode('/',$df)[0];

                    $stm->bindParam(':id_sous_projet',$idsp);
                    $stm->bindParam(':date_depot_cmd',$de);
                    $stm->bindParam(':date_debut_travaux_ft',$dd);
                    $stm->bindParam(':date_fin_travaux_ft',$df);
                    $stm->bindParam(':go_ft',$fci_states_arr[$gf]);

                    if($stm->execute()) {

                        $affected_rows["de"] = $de;
                        $affected_rows["dd"] = $dd;
                        $affected_rows["df"] = $df;
                        $affected_rows["gf"] = $fci_states_arr[$gf];

                        $affected_rows["form"] = $tentree;

                        $message[] = "Paramétres commande cdi appliquée à l'étape avec succés !";

                    } else {

                        $message [] = $stm->errorInfo();
                    }

                } else {
                    $err++;
                    $message[] = "étape ".$lang[$tentree]." non enregistrée !";
                }
            }

        } else {
            $err++;
            $message[] = "sous projet inexistant ou supprimé !";
        }

    } else {
        $err++;
        $message[] = "erreur étape !";
    }

} else {
    $err++;
    $message[] = "réference sous projet manquante !";
}

echo json_encode(array("error" => $err , "message" => $message, "rows" => $affected_rows));