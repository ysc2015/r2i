<?php
/**
 * file: zone_add.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet_zone (id_sous_projet,nbr_zone,lr_sur_pm,lr,nbr_de_site,nb_fo_sur_pm,nb_fo_sur_pmz) values (:id_sous_projet,:nbr_zone,:lr_sur_pm,:lr,:nbr_de_site,:nb_fo_sur_pm,:nb_fo_sur_pmz)");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($nbr_zone) && !empty($nbr_zone)){
    $stm->bindParam(':nbr_zone',$nbr_zone);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Nombre de zone est obligatoire !";
}

if(isset($lr_sur_pm) && !empty($lr_sur_pm)){
    $stm->bindParam(':lr_sur_pm',$lr_sur_pm);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs LR sur PM est obligatoire !";
}

if(isset($lr) && !empty($lr)){
    $stm->bindParam(':lr',$lr);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs LR est obligatoire !";
}

if(isset($nbr_de_site) && !empty($nbr_de_site)){
    $stm->bindParam(':nbr_de_site',$nbr_de_site);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Nombre de site est obligatoire !";
}

if(isset($nb_fo_sur_pm) && !empty($nb_fo_sur_pm)){
    $stm->bindParam(':nb_fo_sur_pm',$nb_fo_sur_pm);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs FO SUR PM est obligatoire !";
}

if(isset($nb_fo_sur_pmz) && !empty($nb_fo_sur_pmz)){
    $stm->bindParam(':nb_fo_sur_pmz',$nb_fo_sur_pmz);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs FO SUR PMZ est obligatoire !";
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