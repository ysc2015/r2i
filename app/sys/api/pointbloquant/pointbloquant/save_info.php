<?php
/**
 * file: save_info.php
 * User: rabii
 */

extract($_POST);

$err = 0;
$message = array();

$fieldslist = "";
$valueslist = "";
$paramcount = 0;

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

$stm = $db->prepare("insert into traitement_pbt ($fieldslist) values ($valueslist)");

foreach( $_POST as $key => $value ) {

    if(strpos($key,$suffix) !== false) {
        $arr = explode("_",$key);
        array_shift($arr);
        if($key !== $suffix."_date_creation") {
            /*if($key === $suffix."_synthese") {
                $stm->bindParam(":".implode("_",$arr),$_POST[$key]);
            } else {
                if(!empty($value)) $stm->bindParam(":".implode("_",$arr),$_POST[$key]);
                else {
                    $err++;
                    $message[] = "Le champs ".$lang[implode("_",$arr)]." est obligatoire!";
                }
            }*/

            $stm->bindParam(":".implode("_",$arr),$_POST[$key]);
        }
    }
}

$dc = date('Y-m-d');
$stm->bindParam(':date_creation',$dc);

if($paramcount < 1) {
    $err++;
    $message[] = "Vous n'avez pas le droit d'effectuer cette action !";
}

if($err == 0){
    if($stm->execute()){

        $message [] = "Infos point bloquant enregistrée avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));

?>