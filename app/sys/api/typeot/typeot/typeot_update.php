<?php
/**
 * file: typeot_update.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("update select_type_ordre_travail set lib_type_ordre_travail=:lib_type_ordre_travail,type_entree=:type_entree where id_type_ordre_travail=:id_type_ordre_travail");

if(isset($idt) && !empty($idt)){
    $stm->bindParam(':id_type_ordre_travail',$idt);
    $insert = true;
} else {
    $err++;
    $message[] = "Réf ordre de travail est obligatoire !";
}

if(isset($lib) && !empty($lib)){
    $stm->bindParam(':lib_type_ordre_travail',$lib);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Lib ordre de travail est obligatoire !";
}

if(isset($type) && !empty($type)){
    $stm->bindParam(':type_entree',$type);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs Etape est obligatoire !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Modification faite avec succès";
    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>