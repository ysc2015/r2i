<?php
/**
 * file: surveyadr_add.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$suffix = "sa";
$fieldslist = "id_sous_projet,";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

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

$stm = $db->prepare("insert into sous_projet_plaque_survey_adresse ($fieldslist) values ($valueslist)");

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

if(isset($sa_volume_adresse)){
    if(!empty($sa_volume_adresse)){
        $stm->bindParam(':volume_adresse',$sa_volume_adresse);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Volume adresses est obligatoire !";
    }
}

/*if(isset($sa_date_debut) && !empty($sa_date_debut)){
    $stm->bindParam(':date_debut',$sa_date_debut);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date début est obligatoire !";
}

if(isset($sa_date_ret_prevue) && !empty($sa_date_ret_prevue)){
    $stm->bindParam(':date_ret_prevue',$sa_date_ret_prevue);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour prévue est obligatoire !";
}*/

/*
 * dates debut
 */

if(isset($sa_date_debut) && isset($sa_date_ret_prevue)) {
    $dd = DateTime::createFromFormat('Y-m-d', $sa_date_debut);
    $df = DateTime::createFromFormat('Y-m-d', $sa_date_ret_prevue);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la date de retour prévue doit étre superieure à la date de début !";
    } else  {

        if(isset($sa_date_debut)){
            $stm->bindParam(':date_debut',$sa_date_debut);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs Date de début est obligatoire !";
        }

        if(isset($sa_date_ret_prevue)){
            $stm->bindParam(':date_ret_prevue',$sa_date_ret_prevue);
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

if(isset($sa_intervenant)){
    if(!empty($sa_intervenant)){
        $stm->bindParam(':intervenant',$sa_intervenant);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Intervenant est obligatoire !";
    }
}

if(isset($sa_duree)){
    $stm->bindParam(':duree',$sa_duree);
    $insert = true;
}

if(isset($sa_ok)){
    $stm->bindParam(':ok',$sa_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>