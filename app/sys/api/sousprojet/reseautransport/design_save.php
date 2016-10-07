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

$suffix = "td";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->transportdesign !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_transport_design set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_transport_design ($fieldslist) values ($valueslist)");
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

if(isset($td_intervenant_be)){
    if(!empty($td_intervenant_be)){
        if($td_intervenant_be !== $td_valideur_bei) {
            $stm->bindParam(':intervenant_be',$td_intervenant_be);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le valideur BEI doit étre différent de li'intervenant BE !";
        }
    } else {
        $stm->bindParam(':intervenant_be',$td_intervenant_be);
        $insert = true;
    }
}

if(isset($td_valideur_bei)){
    $stm->bindParam(':valideur_bei',$td_valideur_bei);
    $insert = true;
}

/*
 * dates debut
 */

if(isset($td_date_debut) && isset($td_date_ret_prevue)) {
    $dd = DateTime::createFromFormat('Y-m-d', $td_date_debut);
    $df = DateTime::createFromFormat('Y-m-d', $td_date_ret_prevue);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la date de retour prévue doit étre superieure à la date de début !";
    } else  {

        if(isset($td_date_debut)){
            $stm->bindParam(':date_debut',$td_date_debut);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs Date de début est obligatoire !";
        }

        if(isset($td_date_ret_prevue)){
            $stm->bindParam(':date_ret_prevue',$td_date_ret_prevue);
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

if(isset($td_lineaire_transport)){
    $stm->bindParam(':lineaire_transport',$td_lineaire_transport);
    $insert = true;
}

if(isset($td_nb_zones)){
    $stm->bindParam(':nb_zones',$td_nb_zones);
    $insert = true;
}

if(isset($td_ok)){
    $stm->bindParam(':ok',$td_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    $duree = getDuree($td_date_debut,$td_date_ret_prevue);
    $stm->bindParam(':duree',$duree);
    if($stm->execute()){
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message , "duree" => $duree));
?>