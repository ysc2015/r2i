<?php
/**
 * file: unset_master_ctr.php
 * User: rabii
 */
extract($_POST);

$sousProjet = NULL;
$err = 0;
$message = array();

$stm = $db->prepare("update sous_projet set is_master=NULL where id_sous_projet=:id_sous_projet");

if(isset($idsp) && !empty($idsp)){

    $sousProjet = SousProjet::first(
        array('conditions' =>
            array("id_sous_projet = ?", $idsp)
        )
    );

    $stm->bindParam(':id_sous_projet',$idsp);

} else {
    $err++;
    $message[] = "Erreur id sous projet !";
}

if($err == 0){
    if($stm->execute()){
        $message [] = "Maj réussite !";

        $ustm = $db->prepare("update sous_projet set id_master_ctr = NULL where id_projet = $sousProjet->id_projet");

        $ustm->execute();

    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>
