<?php
/**
 * file: affecter_ot_team.php
 * User: rabii
 */

extract($_POST);

$results = NULL;

$insert = false;
$err = 0;
$message = array();

$ot = OrdreDeTravail::first(
    array('conditions' =>
        array("id_ordre_de_travail = ?", $idot)
    )
);

if($ot->date_debut == NULL || $ot->date_debut=="") {
    $stm = $db->prepare("update ordre_de_travail set id_entreprise=:id_entreprise,id_equipe_stt=:id_equipe_stt,date_debut=:date_debut,date_fin=:date_fin where id_ordre_de_travail=:id_ordre_de_travail");

    if(isset($idot) && !empty($idot)){
        $stm->bindParam(':id_ordre_de_travail',$idot);
        $insert = true;
    } else {
        $err++;
        $message[] = "Référence OT invalide !";
    }

    if(isset($ide) && !empty($ide)){
        $stm->bindParam(':id_entreprise',$ide);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs entreprise est obligatoire !";
    }

    if(isset($ideq) && !empty($ideq)){
        $stm->bindParam(':id_equipe_stt',$ideq);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs equipe est obligatoire !";
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
            $stm2 = $db->prepare("select * from ordre_de_travail where (date_debut <= :date_debut and date_fin >= :date_debut) or (date_debut <= :date_fin and date_fin >= :date_fin) or (date_debut >= :date_debut and date_fin <= :date_fin)");
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



} else {
    $err++;
    $message[] = "Cet OT est déjà affecté, supprimer son affectation pour le réaffecter !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Affectation faite avec succès";
    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message, "results" => $results));
