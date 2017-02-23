<?php
/**
 * file: ot_update.php
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
$stm = $db->prepare("update wiki_sujet set titre=:titre,contenu=:contenu,id_categorie=:id_categorie where id=:id");

if(isset($id) && !empty($id)){
    $stm->bindParam(':id',$id);
    $insert = true;
} else {
    $err++;
    $message[] = "Identifiant du sujet invalide !";
}
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
        $message [] = "Modification faite avec succès";
    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}

if(isset($files) && !empty($files)){
    $stm = $db->prepare("delete from wiki_piecejointe where id_sujet=".$id."");
    /*echo "delete from piecejoint where id_sujet=".$id."         ";
    echo '';*/
    if($stm->execute()){
	//echo $files;
        $tab = explode(";",$files);
        $temp='';
        foreach($tab as $url){
	$temp.="insert into wiki_piecejointe(url,date_creation,id_sujet) values('app/sys/api/uploads/wiki/".$url."','".date("Y-m-d H:i:s")."',".$id.");";
	//echo $url;
}
	//echo $temp."             ";
	$stm = $db->prepare($temp);
	$stm->execute();
	//echo $stm->errorInfo();
}
else {
        $err++;
        $message [] = $stm->errorInfo();
    }

} 
echo json_encode(array("error" => $err , "message" => $message));
?>
