<?php
/**
 * file: update_blq.php
 * User: rabii
 */

extract($_POST);

$err = 0;
$message = array();

$sql = "";
$stm = NULL;

$questionFieldName = "";

if(!isset($type) || empty($type) || !in_array($type,array(1,2))) {
    $err++;
    $message[] = "Type invalid !";
} else {
    switch($type) {
        case 1 :
            $sql = "update blq_pbc set snake=:snake,planche_a3=:planche_a3,chambre_amont=:chambre_amont,chambre_aval=:chambre_aval,question_information=:question_information, flag = :flag, date_action =:date_action, id_createur=:id_createur where id_blq_pbc=:id_blq_pbc";
            $questionFieldName = "question";
            break;
        case 2 :
            $sql = "update blq_pbc set snake=:snake,planche_a3=:planche_a3,chambre_amont=:chambre_amont,chambre_aval=:chambre_aval,question_information=:question_information,reponse_ajustement=:reponse_ajustement where id_blq_pbc=:id_blq_pbc";
            $questionFieldName = "information";
            break;
        default : break;
    }

    $stm = $db->prepare($sql);
}

if(isset($idblq) && !empty($idblq)){
    $stm->bindParam(':id_blq_pbc',$idblq);

} else {
    $err++;
    $message[] = "Identifiant ".$questionFieldName." invalid !";
}

if(isset($snake) && !empty($snake)){
    $stm->bindParam(':snake',$snake);
} else {
    $err++;
    $message[] = "Le champs snake est obligatoire !";
}

if(isset($planche_a3) && !empty($planche_a3)){
    $stm->bindParam(':planche_a3',$planche_a3);
} else {
    $err++;

    $message[] = "Le champs planche a3 est obligatoire !";
}

if(isset($chambre_amont) && !empty($chambre_amont)){
    $stm->bindParam(':chambre_amont',$chambre_amont);
} else {
    $err++;
    $message[] = "Le champs chambre amont est obligatoire !";
}

if(isset($chambre_aval) && !empty($chambre_aval)){
    $stm->bindParam(':chambre_aval',$chambre_aval);
} else {
    $err++;
    $message[] = "Le champs chambre aval est obligatoire !";
}

if(isset($question_information) && !empty($question_information)){
    $stm->bindParam(':question_information',$question_information);
} else {
    $err++;
    $message[] = "Le champs ".$questionFieldName." est obligatoire !";
}

if(isset($type) && $type == 2) {
    if(isset($reponse_ajustement) && !empty($reponse_ajustement)){
        $stm->bindParam(':reponse_ajustement',$reponse_ajustement);
    } else {
        $err++;
        $message[] = "Le champs ajustement est obligatoire !";
    }
}
if(isset($type) && $type == 1){
    $stm->bindValue(':id_createur',$connectedProfil->profil->id_utilisateur);
    $stm->bindValue(':flag',0);
    $stm->bindValue(':date_action',date('Y-m-d H:i:s'));


}

if($err == 0){
    if($stm->execute()){
        $message [] = "Modification faite avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));