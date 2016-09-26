<?php
/**
 * file: projet_cdp_update.php
 * User: rabii
 */

ini_set("display_errors",'1');

extract($_POST);

$cdp_fullname="";
$insert = false;
$err = 0;
$message = array();
$stm = $db->prepare("update projet set id_chef_projet = :id_chef_projet, date_attribution = :date_attribution where id_projet = :id_projet");


if(isset($idp) && !empty($idp)){
    $stm->bindParam(':id_projet',$idp);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence projet introuvable !";
}

if(isset($id_chef_projet) && !empty($id_chef_projet)){
    $stm->bindParam(':id_chef_projet',$id_chef_projet);
    $insert = true;

    //temp code , replace by local jquery selector option value

    //$stm->closeCursor();
    $stm2 = $db->prepare("select * from utilisateur where id_utilisateur = :id_chef_projet");
    $stm2->bindParam(':id_chef_projet',$id_chef_projet);
    $stm2->execute();

    $user = $stm2->fetchAll(PDO::FETCH_OBJ);

    $cdp_fullname = $user[0]->prenom_utilisateur." ".$user[0]->nom_utilisateur;


} else {
    $err++;
    $message[] = "Le champs chef de projet est obligatoire !";
}

$stm->bindParam(':date_attribution',date('Y-m-d'));

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Modification faite avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message , "cdp" => $cdp_fullname));