<?php
/**
 * file: zone_update.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$suffix = "sz";
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

$stm = $db->prepare("update sous_projet_zone set $fieldslist where id_sous_projet=:id_sous_projet");

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

if(isset($sz_nbr_zone)){
    if(!empty($sz_nbr_zone)){
        $stm->bindParam(':nbr_zone',$sz_nbr_zone);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Nombre de zone est obligatoire !";
    }
}

if(isset($sz_lr_sur_pm)){
    if(!empty($sz_lr_sur_pm)){
        $stm->bindParam(':lr_sur_pm',$sz_lr_sur_pm);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs LR sur PM est obligatoire !";
    }
}

if(isset($sz_lr)){
    if(!empty($sz_lr)){
        $stm->bindParam(':lr',$sz_lr);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs LR est obligatoire !";
    }
}

if(isset($sz_nbr_de_site)){
    if(!empty($sz_nbr_de_site)){
        $stm->bindParam(':nbr_de_site',$sz_nbr_de_site);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Nombre de site est obligatoire !";
    }
}

if(isset($sz_nb_fo_sur_pm)){
    if(!empty($sz_nb_fo_sur_pm)){
        $stm->bindParam(':nb_fo_sur_pm',$sz_nb_fo_sur_pm);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs FO SUR PM est obligatoire !";
    }
}

if(isset($sz_nb_fo_sur_pmz)){
    if(!empty($sz_nb_fo_sur_pmz)){
        $stm->bindParam(':nb_fo_sur_pmz',$sz_nb_fo_sur_pmz);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs FO SUR PMZ est obligatoire !";
    }
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