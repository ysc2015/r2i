<?php
/**
 * file: set_master_ctr.php
 * User: rabii
 */

extract($_POST);

$sousProjet = NULL;
$err = 0;
$message = array();
$stm_reset = NULL;

if(isset($idsp) && !empty($idsp)){
    $sousProjet = SousProjet::first(
        array('conditions' =>
            array("id_sous_projet = ?", $idsp)
        )
    );
} else {
    $err++;
    $message[] = "Erreur id sous projet !";
}

if($sousProjet !== NULL) {

    $stm_reset = $db->prepare("update sous_projet set is_master=NULL where id_projet=:id_projet");
    $stm_reset->bindParam(':id_projet',$sousProjet->id_projet);

    if($stm_reset->execute()) {
        $sousProjet->is_master = 1;
        $sousProjet->save();

        $message[] = "Maj réussite !";
    } else {
        $err++;
        $message[] = "Erreur lors de la maj !";
    }
} else {
    $err++;
    $message[] = "Erreur reférence sous projet";
}

echo json_encode(array("error" => $err , "message" => $message));
?>