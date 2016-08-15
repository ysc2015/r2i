<?php
/**
 * file: ddesign_add.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$suffix = "dd";
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

$stm = $db->prepare("insert into sous_projet_distribution_design ($fieldslist) values ($valueslist)");

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

if(isset($dd_intervenant_be)){
    if(!empty($dd_intervenant_be)){
        $stm->bindParam(':intervenant_be',$dd_intervenant_be);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Intervenant BE est obligatoire !";
    }
}

if(isset($dd_intervenant_bex)){
    if(!empty($dd_intervenant_bex)){
        $stm->bindParam(':intervenant_bex',$dd_intervenant_bex);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Intervenant BEX est obligatoire !";
    }
}

/*if(isset($dd_date_debut) && !empty($dd_date_debut)){
    $stm->bindParam(':date_debut',$dd_date_debut);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date début est obligatoire !";
}

if(isset($dd_date_fin) && !empty($dd_date_fin)){
    $stm->bindParam(':date_fin',$dd_date_fin);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date fin est obligatoire !";
}*/

/*
 * dates debut
 */

if(isset($dd_date_debut) && isset($dd_date_fin)) {
    $dd = DateTime::createFromFormat('Y-m-d', $dd_date_debut);
    $df = DateTime::createFromFormat('Y-m-d', $dd_date_fin);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la date de fin doit étre superieure à la date de début !";
    } else  {

        if(isset($dd_date_debut)){
            $stm->bindParam(':date_debut',$dd_date_debut);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs Date début est obligatoire !";
        }

        if(isset($dd_date_fin)){
            $stm->bindParam(':date_fin',$dd_date_fin);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs Date fin est obligatoire !";
        }
    }
}

/*
 * dates fin
 */

if(isset($dd_duree)){
    $stm->bindParam(':duree',$dd_duree);
    $insert = true;
}

if(isset($dd_lineaire_distribution)){
    if(!empty($dd_lineaire_distribution)){
        $stm->bindParam(':lineaire_distribution',$dd_lineaire_distribution);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Linéaire distribution est obligatoire !";
    }
}

if(isset($dd_etat)){
    if(!empty($dd_etat)){
        $stm->bindParam(':etat',$dd_etat);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Nombre Etat est obligatoire !";
    }
}

if(isset($dd_date_envoi)){
    if(!empty($dd_date_envoi)){
        $stm->bindParam(':date_envoi',$dd_date_envoi);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date envoi est obligatoire !";
    }
}

if(isset($dd_ok)){
    $stm->bindParam(':ok',$dd_ok);
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