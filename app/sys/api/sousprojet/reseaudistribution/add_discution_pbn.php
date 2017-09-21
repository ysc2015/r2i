<?php
/**
 * file: add_discution_pbn.php
 * User: fadil
 */

extract($_POST);

$err = 0;
$message = array();

$sql = "";
$stm = NULL;

 if(!isset($pbn_discution_texte) ||  $pbn_discution_texte =="") {
    $err++;
    $message[] = "texte vide !";
}elseif (!isset($id_pbn) || $id_pbn == 0 || $id_pbn ==""){
    $err++;
    $message[] = "Reference PBN Vide !";

} else {
    $sql = "INSERT INTO `pbn_discution` ( `texte_discution`, `id_pbn`, `id_createur`, `time_creation`) VALUES (:texte_discution, :id_pbn, :id_createur, :time_creation);";
    $stm = $db->prepare($sql);

    $stm->bindParam(":texte_discution",$pbn_discution_texte);
    $stm->bindParam(":id_pbn",$id_pbn);
    $stm->bindParam(':id_createur',$connectedProfil->profil->id_utilisateur);
    $stm->bindValue(':time_creation',date('Y-m-d H:i:s'));
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));