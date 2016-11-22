<?php
/**
 * file: ot_add.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("insert into ordre_de_travail (id_sous_projet,id_etat_ot,type_entree,id_type_ordre_travail,type_ot,commentaire) values (:id_sous_projet,1,:type_entree,:id_type_ordre_travail,:type_ot,:commentaire)");

if(isset($idsp) && !empty($idsp)){
    $stm->bindParam(':id_sous_projet',$idsp);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($tentree) && !empty($tentree)){
    if($tentree == "transportraccordement") $tentree = "transporttirage";
    if($tentree == "distributionraccordement") $tentree = "distributiontirage";
    $stm->bindParam(':type_entree',$tentree);
    $insert = true;
} else {
    $err++;
    $message[] = "Type entrée invalide  !";
}

if(isset($type_ot_text) && !empty($type_ot_text)){
    $stm->bindParam(':type_ot',$type_ot_text);
    $insert = true;
} else {
    $err++;
    $message[] = "Type entrée invalide  !";
}

if(isset($type_ot) && !empty($type_ot)){
    $stm->bindParam(':id_type_ordre_travail',$type_ot);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs type ot est obligatoire !";
}

if(isset($commentaire)){
    $stm->bindParam(':commentaire',$commentaire);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>