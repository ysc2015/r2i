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

if (!isset($id_pbn) || $id_pbn == 0 || $id_pbn ==""){
    $err++;
    $message[] = "Reference PBN Vide !";

} else {
    $sql = "select * from `pbn_discution`,utilisateur  where id_pbn = :id_pbn and id_createur = id_utilisateur";
    $stm = $db->prepare($sql);
    $info_liste_disctution=[];
    $stm->bindParam(":id_pbn",$id_pbn);
    if($stm->execute()){

        $liste_disctution = [];

        $liste_disctution = $stm->fetchAll();
        $i = 0;
        foreach($liste_disctution as $text_liste_disctution){
            $info_liste_disctution[$i][0] = $text_liste_disctution['nom_utilisateur'].' '.$text_liste_disctution['prenom_utilisateur'];
            $info_liste_disctution[$i][1] = $text_liste_disctution['texte_discution'];
            $info_liste_disctution[$i][2] = $text_liste_disctution['time_creation'];
            $i++;
        }

    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message,"resultat" =>$info_liste_disctution));