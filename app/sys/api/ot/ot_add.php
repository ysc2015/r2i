<?php
/**
 * file: ot_add.php
 * User: rabii
 */

require_once __DIR__."/../../php-activerecord/ActiveRecord.php";
include_once __DIR__."/../../inc/config.php";

extract($_POST);

$idot = 0;
$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("insert into ordre_de_travail (id_entree,type_entree,type_ot,commentaire) values (:id_entree,:type_entree,:type_ot,:commentaire)");

if(isset($id_entree) && !empty($id_entree)){
    $stm->bindParam(':id_entree',$id_entree);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence entrée invalide !";
}

if(isset($type_entree) && !empty($type_entree)){
    $stm->bindParam(':type_entree',$type_entree);
    $insert = true;
} else {
    $err++;
    $message[] = "Type entrée invalide  !";
}

if(isset($type_ot) && !empty($type_ot)){
    $stm->bindParam(':type_ot',$type_ot);
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
    $ot = OrdreDeTravail::first(
        array('conditions' =>
            array("id_entree = ? AND type_entree = ?", $id_entree,$type_entree)
        )
    );

    if($ot!==NULL) {
        $err++;
        $message [] = "ordre de travail déjà crée !";
        $idot = $ot->id_ordre_de_travail;
    } else {
        if($stm->execute()){
            $idot = $db->lastInsertId();
            $message [] = "Enregistrement ajouté avec succès";
        } else {
            $message [] = $stm->errorInfo();
        }
    }
}
echo json_encode(array("error" => $err , "message" => $message, "idot" => $idot));
?>