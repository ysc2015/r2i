<?php
/**
 * file: sous_projet_add.php
 * User: rabii
 */

include_once __DIR__."/../inc/config.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into sous_projet (id_projet,dep,ville,plaque,zone) values (:id_projet,:dep,:ville,:plaque,:zone)");

if(isset($idp) && !empty($idp)){
    $stm->bindParam(':id_projet',$idp);
    $insert = true;
} else {
    $err++;
    $message[] = "Identifiant projet invalid !";
}

if(isset($dep) && !empty($dep)){
    $stm->bindParam(':dep',$dep);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs département est obligatoire !";
}

if(isset($ville) && !empty($ville)){
    $stm->bindParam(':ville',$ville);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs ville est obligatoire !";
}

if(isset($plaque) && !empty($plaque)){
    $stm->bindParam(':plaque',$plaque);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs plaque est obligatoire !";
}

if(isset($zone) && !empty($zone)){
    $stm->bindParam(':zone',$zone);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs zone est obligatoire !";
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