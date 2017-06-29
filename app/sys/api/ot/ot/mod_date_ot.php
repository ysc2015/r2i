<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 29/06/2017
 * Time: 09:04
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("update ordre_de_travail set date_debut=:date_debut,date_fin=:date_fin where id_ordre_de_travail=:id_ordre_de_travail");

if(isset($idot) && !empty($idot)){
    $stm->bindParam(':id_ordre_de_travail',$idot);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence OT invalide !";
}

if(isset($date1) && !empty($date1)){
    $stm->bindParam(':date_debut',$date1);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs date début est obligatoire !";
}

if(isset($date2) && !empty($date2)){
    $stm->bindParam(':date_fin',$date2);
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs date fin est obligatoire !";
}

if(isset($date1) && !empty($date1) && isset($date2) && !empty($date2)) {
    $dd = DateTime::createFromFormat('Y-m-d', $date1);
    $df = DateTime::createFromFormat('Y-m-d', $date2);

    if($dd > $df) {
        $err++;
        $message[] = "La date de fin doit étre supérieure ou égale à la date de début !";
    } else {
        $stm2 = $db->prepare("select * from ordre_de_travail where (id_entreprise=:id_entreprise and id_equipe_stt=:id_equipe_stt and date_debut <= :date_debut and date_fin >= :date_debut) or (id_entreprise=:id_entreprise and id_equipe_stt=:id_equipe_stt and date_debut <= :date_fin and date_fin >= :date_fin) or (id_entreprise=:id_entreprise and id_equipe_stt=:id_equipe_stt and date_debut >= :date_debut and date_fin <= :date_fin)");
        $stm2->bindParam(':id_entreprise',$ide);
        $stm2->bindParam(':id_equipe_stt',$ideq);
        $stm2->bindParam(':date_fin',$date2);
        $stm2->bindParam(':date_debut',$date1);
        $stm2->execute();
        $results = $stm2->fetchAll();

        if($stm2->rowCount() > 0) {
            $err++;
            $message[] = "Cette équipe a été déjà programée un ou plusieurs jours de la période choisie !";
        }
    }
}

if($insert == true && $err == 0){
    if($stm->execute()){

        $message [] = "Modification faite avec succès";

    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message, "results" => $results));