<?php
/**
 * file: design_save.php
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

$suffix = "dd";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->distributiondesign !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_distribution_design set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_distribution_design ($fieldslist) values ($valueslist)");
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
    $duree = getDuree($dd_date_debut,$dd_date_fin);
    $stm->bindParam(':duree',$duree);
    if($stm->execute()){
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message , "duree" => $duree));
?>