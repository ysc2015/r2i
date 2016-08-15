<?php
/**
 * file: dtirage_update.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$suffix = "dt";
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

$stm = $db->prepare("update sous_projet_distribution_tirage set $fieldslist where id_sous_projet=:id_sous_projet");

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

if(isset($dt_intervenant_be)){
    if(!empty($dt_intervenant_be)){
        $stm->bindParam(':intervenant_be',$dt_intervenant_be);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Intervenant BE est obligatoire !";
    }
}

if(isset($dt_date_previsionnelle)){
    if(!empty($dt_date_previsionnelle)){
        $stm->bindParam(':date_previsionnelle',$dt_date_previsionnelle);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date prévisionnelle est obligatoire !";
    }
}

if(isset($dt_prep_plans)){
    if(!empty($dt_prep_plans)){
        $stm->bindParam(':prep_plans',$dt_prep_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Prép. plans est obligatoire !";
    }
}

/*
 * lineaire debut
 */

if(isset($dt_lineaire1)){
    if(!empty($dt_lineaire1)){
        $stm->bindParam(':lineaire1',$dt_lineaire1);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 288FO est obligatoire !";
    }
}

if(isset($dt_lineaire2)){
    if(!empty($dt_lineaire2)){
        $stm->bindParam(':lineaire2',$dt_lineaire2);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 144FO est obligatoire !";
    }
}

if(isset($dt_lineaire3)){
    if(!empty($dt_lineaire3)){
        $stm->bindParam(':lineaire3',$dt_lineaire3);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 72FO est obligatoire !";
    }
}

if(isset($dt_lineaire4)){
    if(!empty($dt_lineaire4)){
        $stm->bindParam(':lineaire4',$dt_lineaire4);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 48FO est obligatoire !";
    }
}

if(isset($dt_lineaire5)){
    if(!empty($dt_lineaire5)){
        $stm->bindParam(':lineaire5',$dt_lineaire5);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 288FO est obligatoire !";
    }
}

if(isset($dt_lineaire6)){
    if(!empty($dt_lineaire6)){
        $stm->bindParam(':lineaire6',$dt_lineaire6);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 144FO est obligatoire !";
    }
}

if(isset($dt_lineaire7)){
    if(!empty($dt_lineaire7)){
        $stm->bindParam(':lineaire7',$dt_lineaire7);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 72FO est obligatoire !";
    }
}

if(isset($dt_lineaire8)){
    if(!empty($dt_lineaire8)){
        $stm->bindParam(':lineaire8',$dt_lineaire8);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 48FO est obligatoire !";
    }
}

/*
 * lineaire fin
 */

if(isset($dt_controle_plans)){
    if(!empty($dt_controle_plans)){
        $stm->bindParam(':controle_plans',$dt_controle_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Controle plans est obligatoire !";
    }
}

if(isset($dt_date_transmission_plans)){
    if(!empty($dt_date_transmission_plans)){
        $stm->bindParam(':date_transmission_plans',$dt_date_transmission_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date transmission plans est obligatoire !";
    }
}

if(isset($dt_id_entreprise)){
    if(!empty($dt_id_entreprise)){
        $stm->bindParam(':id_entreprise',$dt_id_entreprise);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Entreprise est obligatoire !";
    }
}

if(isset($dt_date_tirage)){
    if(!empty($dt_date_tirage)){
        $stm->bindParam(':date_tirage',$dt_date_tirage);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date de tirage est obligatoire !";
    }
}

if(isset($dt_duree)){
    if(!empty($dt_duree)){
        $stm->bindParam(':duree',$dt_duree);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Durée est obligatoire !";
    }
}

if(isset($dt_controle_demarrage_effectif)){
    if(!empty($dt_controle_demarrage_effectif)){
        $stm->bindParam(':controle_demarrage_effectif',$dt_controle_demarrage_effectif);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Controle démarrage effectif est obligatoire !";
    }
}

if(isset($dt_date_retour)){
    if(!empty($dt_date_retour)){
        $stm->bindParam(':date_retour',$dt_date_retour);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date de retour est obligatoire !";
    }
}

if(isset($dt_etat_retour)){
    if(!empty($dt_etat_retour)){
        $stm->bindParam(':etat_retour',$dt_etat_retour);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Etat retour est obligatoire !";
    }
}

if(isset($dt_ok)){
    $stm->bindParam(':ok',$dt_ok);
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