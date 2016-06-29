<?php
/**
 * file: site_origine_update.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update sous_projet_site_origine set auto_adduction=:auto_adduction,travaux_adduction=:travaux_adduction,recette_adduction=:recette_adduction where id_sous_projet=:id_sous_projet");

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

/*if(isset($code_site) && !empty($code_site)){
    $stm->bindParam(':code_site',$code_site);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Code site est obligatoire !";
}

if(isset($type_so) && !empty($type_so)){
    $stm->bindParam(':type',$type_so);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Type est obligatoire !";
}*/

if(isset($auto_adduction) && !empty($auto_adduction)){
    $stm->bindParam(':auto_adduction',$auto_adduction);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Auto adduction est obligatoire !";
}

if(isset($travaux_adduction) && !empty($travaux_adduction)){
    $stm->bindParam(':travaux_adduction',$travaux_adduction);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Travaux adduction est obligatoire !";
}

if(isset($recette_adduction) && !empty($recette_adduction)){
    $stm->bindParam(':recette_adduction',$recette_adduction);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Recette adduction est obligatoire !";
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