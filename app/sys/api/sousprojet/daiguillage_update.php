<?php
/**
 * file: daiguillage_update.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$suffix = "da";
$fieldslist = "";
$paramcount = 0;

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
    if(!empty($da_intervenant_be)){
        $stm->bindParam(':intervenant_be',$da_intervenant_be);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Intervenant BE est obligatoire !";
    }
}

if(isset($da_plans)){
    if(!empty($da_plans)){
        $stm->bindParam(':plans',$da_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Plans est obligatoire !";
    }
}

/*if(isset($da_lineaire_reseau) && !empty($da_lineaire_reseau)){
    $stm->bindParam(':lineaire_reseau',$da_lineaire_reseau);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Linéaire réseau est obligatoire !";
}*/

/*
 * lineaire debut
 */

if(isset($da_lineaire1)){
    if(!empty($da_lineaire1)){
        $stm->bindParam(':lineaire1',$da_lineaire1);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 288FO est obligatoire !";
    }
}

if(isset($da_lineaire2)){
    if(!empty($da_lineaire2)){
        $stm->bindParam(':lineaire2',$da_lineaire2);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 144FO est obligatoire !";
    }
}

if(isset($da_lineaire3)){
    if(!empty($da_lineaire3)){
        $stm->bindParam(':lineaire3',$da_lineaire3);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 72FO est obligatoire !";
    }
}

if(isset($da_lineaire4)){
    if(!empty($da_lineaire4)){
        $stm->bindParam(':lineaire4',$da_lineaire4);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 48FO est obligatoire !";
    }
}

if(isset($da_lineaire5)){
    if(!empty($da_lineaire5)){
        $stm->bindParam(':lineaire5',$da_lineaire5);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 288FO est obligatoire !";
    }
}

if(isset($da_lineaire6)){
    if(!empty($da_lineaire6)){
        $stm->bindParam(':lineaire6',$da_lineaire6);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 144FO est obligatoire !";
    }
}

if(isset($da_lineaire7)){
    if(!empty($da_lineaire7)){
        $stm->bindParam(':lineaire7',$da_lineaire7);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 72FO est obligatoire !";
    }
}

if(isset($da_lineaire8)){
    if(!empty($da_lineaire8)){
        $stm->bindParam(':lineaire8',$da_lineaire8);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 48FO est obligatoire !";
    }
}

/*
 * lineaire fin
 */

if(isset($da_controle_plans)){
    if(!empty($da_controle_plans)){
        $stm->bindParam(':controle_plans',$da_controle_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Controle plans est obligatoire !";
    }
}

if(isset($da_date_transmission_plans)){
    if(!empty($da_date_transmission_plans)){
        $stm->bindParam(':date_transmission_plans',$da_date_transmission_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date transmission plans est obligatoire !";
    }
}

if(isset($da_id_entreprise)){
    if(!empty($da_id_entreprise)){
        $stm->bindParam(':id_entreprise',$da_id_entreprise);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Entreprise est obligatoire !";
    }
}

if(isset($da_date_aiguillage)){
    if(!empty($da_date_aiguillage)){
        $stm->bindParam(':date_aiguillage',$da_date_aiguillage);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date aiguillage est obligatoire !";
    }
}

if(isset($da_duree)){
    if(!empty($da_duree)){
        $stm->bindParam(':duree',$da_duree);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Durée est obligatoire !";
    }
}

if(isset($da_controle_demarrage_effectif)){
    if(!empty($da_controle_demarrage_effectif)){
        $stm->bindParam(':controle_demarrage_effectif',$da_controle_demarrage_effectif);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Controle démarrage éffectif est obligatoire !";
    }
}

if(isset($da_date_retour)){
    if(!empty($da_date_retour)){
        $stm->bindParam(':date_retour',$da_date_retour);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date retour est obligatoire !";
    }
}

if(isset($da_etat_retour)){
    if(!empty($da_etat_retour)){
        $stm->bindParam(':etat_retour',$da_etat_retour);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Etat retour est obligatoire !";
    }
}

if(isset($da_ok)){
    $stm->bindParam(':ok',$da_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Modification faite avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>