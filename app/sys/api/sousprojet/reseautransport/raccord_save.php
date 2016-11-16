<?php
/**
 * file: raccord_save.php
 * User: rabii
 */

extract($_POST);

$duree = "";

$sousProjet = NULL;
$stm = NULL;

if(isset($ids) && !empty($ids)){
    $sousProjet = SousProjet::find($ids);
}

$insert = false;
$err = 0;
$message = array();

$suffix = "tr";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->transportraccordement !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_transport_raccordements set $fieldslist where id_sous_projet=:id_sous_projet");
    } else {
        $fieldslist = "id_sous_projet,";
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr).",";
                $valueslist .= ":".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");
        $valueslist = rtrim($valueslist,",");

        $stm = $db->prepare("insert into sous_projet_transport_raccordements ($fieldslist) values ($valueslist)");
    }
} else {
    $err++;
    $message[] = "Erreur reférence sous projet";
}

if($paramcount < 1) {
    $err++;
    $message[] = "Vous n'avez pas le droit d'effectuer cette action !";
}

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($tr_intervenant_be)){
    $stm->bindParam(':intervenant_be',$tr_intervenant_be);
    $insert = true;
}

if(isset($tr_preparation_pds)){
    $stm->bindParam(':preparation_pds',$tr_preparation_pds);
    $insert = true;
}

if(isset($tr_controle_plans)){
    $stm->bindParam(':controle_plans',$tr_controle_plans);
    $insert = true;
}

if(isset($tr_date_transmission_pds)){
    $stm->bindParam(':date_transmission_pds',$tr_date_transmission_pds);
    $insert = true;
}

if(isset($tr_id_entreprise)){
    $stm->bindParam(':id_entreprise',$tr_id_entreprise);
    $insert = true;
}

if(isset($tr_date_racco)){
    $stm->bindParam(':date_racco',$tr_date_racco);
    $insert = true;
}

if(isset($tr_duree)){
    $stm->bindParam(':duree',$tr_duree);
    $insert = true;
}

/*
 * dates début
 */

if(isset($tr_date_racco) && isset($tr_date_ret_prevue)) {

    $dd = DateTime::createFromFormat('Y-m-d', $tr_date_racco);
    $df = DateTime::createFromFormat('Y-m-d', $tr_date_ret_prevue);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la Date prévisionnelle de fin du raccordement doit étre superieure à la date de début !";
    } else  {

        if(isset($tr_date_racco)){
            $stm->bindParam(':date_racco',$tr_date_racco);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs Date de début raccordement est obligatoire !";
        }

        if(isset($tr_date_ret_prevue)){
            $stm->bindParam(':date_ret_prevue',$tr_date_ret_prevue);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs Date retour prévue est obligatoire !";
        }
    }
}

/*
 * dates fin
 */

if(isset($tr_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$tr_controle_demarrage_effectif);
    $insert = true;
}

if(isset($tr_date_retour)){
    $stm->bindParam(':date_retour',$tr_date_retour);
    $insert = true;
}

if(isset($tr_etat_retour)){
    $stm->bindParam(':etat_retour',$tr_etat_retour);
    $insert = true;
}

if(isset($tr_lien_plans)){
    $stm->bindParam(':lien_plans',$tr_lien_plans);
    $insert = true;
}

if(isset($tr_retour_presta)){
    $stm->bindParam(':retour_presta',$tr_retour_presta);
    $insert = true;
}

if(isset($tr_ok)){
    $stm->bindParam(':ok',$tr_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    $duree = getDuree($tr_date_racco,$tr_date_ret_prevue);
    $stm->bindParam(':duree',$duree);
    if($stm->execute()){
        setSousProjetUsers(SousProjet::find($ids));
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message, "duree" => $duree));
?>