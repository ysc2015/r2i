<?php
/**
 * file: traitementetude_add.php
 * User: rabii
 */

extract($_POST);

$insert = false;
$err = 0;
$message = array();

$suffix = "te";
$paramcount = 0;

$fieldslist = "id_sous_projet,";
$valueslist = ":id_sous_projet,";

foreach( $_POST as $key => $value ) {

    if(strpos($key,$suffix) !== false) {
        $paramcount++;
        $arr = explode("_",$key);
        array_shift($arr);
        $fieldslist .= implode("_",$arr).",";
        $valueslist .= ":".implode("_",$arr).",";
    }
}

$fieldslist = rtrim($fieldslist,",");
$valueslist = rtrim($valueslist,",");

$stm = $db->prepare("insert into sous_projet_plaque_traitement_etude ($fieldslist) values ($valueslist)");

if($paramcount < 1) {
    $err++;
    $message[] = "Vous n'avez pas le droit d'effectuer cette action !";
}

if(isset($ids) && !empty($ids)){
    $stm->bindParam(':id_sous_projet',$ids);
    $insert = true;
} else {
    $err++;
    $message[] = "Référence sous projet invalide !";
}

if(isset($te_site)){
    if(!empty($te_site)) {
        $stm->bindParam(':site',$te_site);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Site est obligatoire !";
    }
}

if(isset($te_charge_etude)){
    if(!empty($te_charge_etude)) {
        $stm->bindParam(':charge_etude',$te_charge_etude);
        $insert = true;
    } else {
        $err++;
        $message[] = "Le champs Chargé d'étude est obligatoire !";
    }
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement ajouté avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}
echo json_encode(array("error" => $err , "message" => $message));
?>