<?php
/**
 * file: tirage_save.php
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

$suffix = "tt";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->transporttirage !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_transport_tirage set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_transport_tirage ($fieldslist) values ($valueslist)");
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

if(isset($tt_intervenant_be)){
    if(!empty($tt_intervenant_be)){
        $stm->bindParam(':intervenant_be',$tt_intervenant_be);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Intervenant BE est obligatoire !";
    }
}

if(isset($tt_plans)){
    if(!empty($tt_plans)){
        $stm->bindParam(':plans',$tt_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Plans est obligatoire !";
    }
}

/*
 * lineaire debut
 */

if(isset($tt_lineaire1)){
    if(!empty($tt_lineaire1)){
        $stm->bindParam(':lineaire1',$tt_lineaire1);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 720FO est obligatoire !";
    }
}

if(isset($tt_lineaire2)){
    if(!empty($tt_lineaire2)){
        $stm->bindParam(':lineaire2',$tt_lineaire2);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 432FO est obligatoire !";
    }
}

if(isset($tt_lineaire3)){
    if(!empty($tt_lineaire3)){
        $stm->bindParam(':lineaire3',$tt_lineaire3);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 288FO est obligatoire !";
    }
}

if(isset($tt_lineaire4)){
    if(!empty($tt_lineaire4)){
        $stm->bindParam(':lineaire4',$tt_lineaire4);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs 144FO est obligatoire !";
    }
}

if(isset($tt_lineaire5)){
    if(!empty($tt_lineaire5)){
        $stm->bindParam(':lineaire5',$tt_lineaire5);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 720FO est obligatoire !";
    }
}

if(isset($tt_lineaire6)){
    if(!empty($tt_lineaire6)){
        $stm->bindParam(':lineaire6',$tt_lineaire6);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 432FO est obligatoire !";
    }
}

if(isset($tt_lineaire7)){
    if(!empty($tt_lineaire7)){
        $stm->bindParam(':lineaire7',$tt_lineaire7);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 288FO est obligatoire !";
    }
}

if(isset($tt_lineaire8)){
    if(!empty($tt_lineaire8)){
        $stm->bindParam(':lineaire8',$tt_lineaire8);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs BPE 144FO est obligatoire !";
    }
}

/*
 * lineaire fin
 */

if(isset($tt_controle_plans)){
    if(!empty($tt_controle_plans)){
        $stm->bindParam(':controle_plans',$tt_controle_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Controle plans est obligatoire !";
    }
}

if(isset($tt_date_transmission_plans)){
    if(!empty($tt_date_transmission_plans)){
        $stm->bindParam(':date_transmission_plans',$tt_date_transmission_plans);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date transmission plans est obligatoire !";
    }
}

if(isset($tt_id_entreprise)){
    if(!empty($tt_id_entreprise)){
        $stm->bindParam(':id_entreprise',$tt_id_entreprise);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Entreprise est obligatoire !";
    }
}

/*
 * dates debut
 */

if(isset($tt_date_tirage) && isset($tt_date_ret_prevue)) {
    $dd = DateTime::createFromFormat('Y-m-d', $tt_date_tirage);
    $df = DateTime::createFromFormat('Y-m-d', $tt_date_ret_prevue);


    if($dd && $df && $df < $dd) {
        $err++;
        $message[] = "la Date prévisionnelle de fin tirage doit étre superieure à la date de début !";
    } else  {

        if(isset($tt_date_tirage)){
            $stm->bindParam(':date_tirage',$tt_date_tirage);
            $insert = true;
        } else {
            $err++;
            $message[] = "Le champs Date de début tirage est obligatoire !";
        }

        if(isset($tt_date_ret_prevue)){
            $stm->bindParam(':date_ret_prevue',$tt_date_ret_prevue);
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

if(isset($tt_controle_demarrage_effectif)){
    if(!empty($tt_controle_demarrage_effectif)){
        $stm->bindParam(':controle_demarrage_effectif',$tt_controle_demarrage_effectif);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Controle démarrage effectif est obligatoire !";
    }
}

if(isset($tt_date_retour)){
    if(!empty($tt_date_retour)){
        $stm->bindParam(':date_retour',$tt_date_retour);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Date retour est obligatoire !";
    }
}

if(isset($tt_etat_retour)){
    if(!empty($tt_etat_retour)){
        $stm->bindParam(':etat_retour',$tt_etat_retour);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Etat retour est obligatoire !";
    }
}

if(isset($tt_lien_plans)){
    $stm->bindParam(':lien_plans',$tt_lien_plans);
    $insert = true;
}

if(isset($tt_retour_presta)){
    $stm->bindParam(':retour_presta',$tt_retour_presta);
    $insert = true;
}

if(isset($tt_ok)){
    $stm->bindParam(':ok',$tt_ok);
    $insert = true;
}

if($insert == true && $err == 0){
    $duree = getDuree($tt_date_tirage,$tt_date_ret_prevue);
    $stm->bindParam(':duree',$duree);
    if($stm->execute()){
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message , "duree" => $duree));
?>