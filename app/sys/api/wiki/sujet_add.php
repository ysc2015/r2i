<?php
/**
 * file: ot_add.php
 * User: rabii
 */

require_once '../../../sys/libs/vendor/autoload.php';
require_once '../../../sys/inc/config.php';
require_once '../../../sys/language/fr/default.php';
require_once "../../../sys/inc/ssp.class.php";
require_once "../../../sys/libs/vendor/EditableGrid/EditableGrid.php";

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("insert into wiki_sujet (titre,contenu,id_categorie,date_creation,date_dernier_mod) values (:titre,:contenu,:id_categorie,'".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."')");

if(isset($titre) && !empty($titre)){
    $stm->bindParam(':titre',$titre);
    $insert = true;
} else {
    $err++;
    $message[] = "Titre du sujet invalide !";
}

if(isset($contenu) && !empty($contenu)){
    $stm->bindParam(':contenu',$contenu);
    $insert = true;
} else {
    $err++;
    $message[] = "Contenu du sujet invalide !";
}
if(isset($categorie) && !empty($categorie) && $categorie!='0'){
    $stm->bindParam(':id_categorie',$categorie);
    $insert = true;
} else {
    $err++;
    $message[] = "Catégorie du sujet invalide !";
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
        $sujet = Sujet::last();

                      }

                                else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}

if(isset($files) && !empty($files)){
        $tab = explode(";",$files);
        $temp='';
        foreach($tab as $url)
	$temp.="insert into wiki_piecejointe(url,date_creation,id_sujet) values('app/sys/api/uploads/wiki/".$url."','".date("Y-m-d H:i:s")."',".$sujet->id.");";
	$stm = $db->prepare($temp);
	$stm->execute();
}
else {
        $err++;
        $message [] = $stm->errorInfo();
    }


echo json_encode(array("error" => $err , "message" => $message, "id" => $sujet->id ));
?>
