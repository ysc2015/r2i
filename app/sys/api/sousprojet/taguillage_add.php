<?php
/**
 * file: taguillage_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insertedId = 0;
$insert = false;
$err = 0;
$message = array();

$suffix = "ta";
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

$stm = $db->prepare("insert into sous_projet_transport_aiguillage ($fieldslist) values ($valueslist)");

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

if(isset($ta_intervenant_be)){
    if(!empty($ta_intervenant_be)){
        $stm->bindParam(':intervenant_be',$ta_intervenant_be);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Intervenant BE est obligatoire !";
    }
}

if(isset($ta_plans)){
    if(!empty($ta_plans)){
        $stm->bindParam(':plans',$ta_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Plans est obligatoire !";
    }
}

/*
 * lineaire debut
 */

if(isset($ta_lineaire1)){
    if(!empty($ta_lineaire1)){
        $stm->bindParam(':lineaire1',$ta_lineaire1);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 720FO est obligatoire !";
    }
}

if(isset($ta_lineaire2)){
    if(!empty($ta_lineaire2)){
        $stm->bindParam(':lineaire2',$ta_lineaire2);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 432FO est obligatoire !";
    }
}

if(isset($ta_lineaire3)){
    if(!empty($ta_lineaire3)){
        $stm->bindParam(':lineaire3',$ta_lineaire3);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 288FO est obligatoire !";
    }
}

if(isset($ta_lineaire4)){
    if(!empty($ta_lineaire4)){
        $stm->bindParam(':lineaire4',$ta_lineaire4);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 144FO est obligatoire !";
    }
}

if(isset($ta_lineaire5)){
    if(!empty($ta_lineaire5)){
        $stm->bindParam(':lineaire5',$ta_lineaire5);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 720FO est obligatoire !";
    }
}

if(isset($ta_lineaire6)){
    if(!empty($ta_lineaire6)){
        $stm->bindParam(':lineaire6',$ta_lineaire6);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 432FO est obligatoire !";
    }
}

if(isset($ta_lineaire7)){
    if(!empty($ta_lineaire7)){
        $stm->bindParam(':lineaire7',$ta_lineaire7);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 288FO est obligatoire !";
    }
}

if(isset($ta_lineaire8)){
    if(!empty($ta_lineaire8)){
        $stm->bindParam(':lineaire8',$ta_lineaire8);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 144FO est obligatoire !";
    }
}

/*
 * lineaire fin
 */

if(isset($ta_controle_plans)){
    if(!empty($ta_controle_plans)){
        $stm->bindParam(':controle_plans',$ta_controle_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Controle plans est obligatoire !";
    }
}

if(isset($ta_date_transmission_plans)){
    if(!empty($ta_date_transmission_plans)){
        $stm->bindParam(':date_transmission_plans',$ta_date_transmission_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date transmission plans est obligatoire !";
    }
}

/*if(isset($) && !empty($)){
    $stm->bindParam(':entreprise',$);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Entreprise est obligatoire !";
}*/

if(isset($ta_id_entreprise)){
    if(!empty($ta_id_entreprise)){
        $stm->bindParam(':id_entreprise',$ta_id_entreprise);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Entreprise est obligatoire !";
    }
}

/*if(isset($ta_date_aiguillage) && !empty($ta_date_aiguillage)){
    $stm->bindParam(':date_aiguillage',$ta_date_aiguillage);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date aiguillage est obligatoire !";
}

if(isset($ta_date_ret_prevue) && !empty($ta_date_ret_prevue)){
    $stm->bindParam(':date_ret_prevue',$ta_date_ret_prevue);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Date retour prévue est obligatoire !";
}*/

/*
 * dates debut
 */

if(isset($ta_date_aiguillage) && isset($ta_date_ret_prevue)) {

    $dd = DateTime::createFromFormat('Y-m-d', $ta_date_aiguillage);
    $df = DateTime::createFromFormat('Y-m-d', $ta_date_ret_prevue);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la Date prévisionnelle de fin d’aiguillage doit étre superieure à la date de début !";
    } else  {

        if(isset($ta_date_aiguillage)){
            $stm->bindParam(':date_aiguillage',$ta_date_aiguillage);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs Date de début aiguillage est obligatoire !";
        }

        if(isset($ta_date_ret_prevue)){
            $stm->bindParam(':date_ret_prevue',$ta_date_ret_prevue);
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

if(isset($ta_duree)){
    $stm->bindParam(':duree',$ta_duree);
    $insert = true;
}

if(isset($ta_controle_demarrage_effectif)){
    if(!empty($ta_controle_demarrage_effectif)){
        $stm->bindParam(':controle_demarrage_effectif',$ta_controle_demarrage_effectif);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Controle démarrage effectif est obligatoire !";
    }
}

if(isset($ta_date_retour)){
    if(!empty($ta_date_retour)){
        $stm->bindParam(':date_retour',$ta_date_retour);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date retour est obligatoire !";
    }
}

if(isset($ta_etat_retour)){
    if(!empty($ta_etat_retour)){
        $stm->bindParam(':etat_retour',$ta_etat_retour);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Etat retour est obligatoire !";
    }
}

if(isset($ta_lien_plans)){
    $stm->bindParam(':lien_plans',$ta_lien_plans);
    $insert = true;
}

if(isset($ta_retour_presta)){
    $stm->bindParam(':retour_presta',$ta_retour_presta);
    $insert = true;
}

if(isset($ta_ok)){
    $stm->bindParam(':ok',$ta_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $insertedId = $db->lastInsertId();
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message , "id" => $insertedId));
?>