<?php
/**
 * file: aiguillage_save.php
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

$suffix = "da";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->distributionaiguillage !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_distribution_aiguillage set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_distribution_aiguillage ($fieldslist) values ($valueslist)");
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

if(isset($da_intervenant_be)){
    $stm->bindParam(':intervenant_be',$da_intervenant_be);
    $insert = true;
}

if(isset($da_plans)){
    $stm->bindParam(':plans',$da_plans);
    $insert = true;
}

/*
 * lineaire debut
 */

if(isset($da_lineaire1)){
    $stm->bindParam(':lineaire1',$da_lineaire1);
    $insert = true;
}

if(isset($da_lineaire2)){
    $stm->bindParam(':lineaire2',$da_lineaire2);
    $insert = true;
}

if(isset($da_lineaire3)){
    $stm->bindParam(':lineaire3',$da_lineaire3);
    $insert = true;
}

if(isset($da_lineaire4)){
    $stm->bindParam(':lineaire4',$da_lineaire4);
    $insert = true;
}

if(isset($da_lineaire5)){
    $stm->bindParam(':lineaire5',$da_lineaire5);
    $insert = true;
}

if(isset($da_lineaire6)){
    $stm->bindParam(':lineaire6',$da_lineaire6);
    $insert = true;
}

if(isset($da_lineaire7)){
    $stm->bindParam(':lineaire7',$da_lineaire7);
    $insert = true;
}

if(isset($da_lineaire8)){
    $stm->bindParam(':lineaire8',$da_lineaire8);
    $insert = true;
}

/*
 * lineaire fin
 */

if(isset($da_controle_plans)){
    $stm->bindParam(':controle_plans',$da_controle_plans);
    $insert = true;
}

if(isset($da_date_transmission_plans)){
    $stm->bindParam(':date_transmission_plans',$da_date_transmission_plans);
    $insert = true;
}

if(isset($da_id_entreprise)){
    $stm->bindParam(':id_entreprise',$da_id_entreprise);
    $insert = true;
}

if(isset($da_date_aiguillage)){
    $stm->bindParam(':date_aiguillage',$da_date_aiguillage);
    $insert = true;
}

if(isset($da_duree)){
    $stm->bindParam(':duree',$da_duree);
    $insert = true;
}

/*
 * dates début
 */

if(isset($da_date_aiguillage) && isset($da_date_ret_prevue)) {

    $dd = DateTime::createFromFormat('Y-m-d', $da_date_aiguillage);
    $df = DateTime::createFromFormat('Y-m-d', $da_date_ret_prevue);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la Date prévisionnelle de fin d’aiguillage doit étre superieure à la date de début !";
    } else  {

        if(isset($da_date_aiguillage)){
            $stm->bindParam(':date_aiguillage',$da_date_aiguillage);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs Date de début aiguillage est obligatoire !";
        }

        if(isset($da_date_ret_prevue)){
            $stm->bindParam(':date_ret_prevue',$da_date_ret_prevue);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs Date fin prévue aiguillage est obligatoire !";
        }
    }
}

/*
 * dates fin
 */

if(isset($da_controle_demarrage_effectif)){
    $stm->bindParam(':controle_demarrage_effectif',$da_controle_demarrage_effectif);
    $insert = true;
}

if(isset($da_date_retour)){
    $stm->bindParam(':date_retour',$da_date_retour);
    $insert = true;
}

if(isset($da_etat_retour)){
    $stm->bindParam(':etat_retour',$da_etat_retour);
    $insert = true;
}

if(isset($da_lien_plans)){
    $stm->bindParam(':lien_plans',$da_lien_plans);
    $insert = true;
}

if(isset($da_retour_presta)){
    $stm->bindParam(':retour_presta',$da_retour_presta);
    $insert = true;
}

if(isset($da_ok)){
    $stm->bindParam(':ok',$da_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    $duree = getDuree($da_date_aiguillage,$da_date_ret_prevue);
    $stm->bindParam(':duree',$duree);
    if($stm->execute()){
        setSousProjetUsers(SousProjet::find($ids));
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message , "duree" => $duree));
?>