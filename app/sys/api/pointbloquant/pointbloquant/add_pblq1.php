<?php
/**
 * file: add_pblq1.php
 * User: rabii
 */

extract($_POST);

$lastInsertedId=0;

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

$stm = $db->prepare("insert into point_bloquant ($fieldslist) values ($valueslist)");

foreach( $_POST as $key => $value ) {

    if(strpos($key,$suffix) !== false) {
        $arr = explode("_",$key);
        array_shift($arr);
        if($key !== $suffix."_date_controle") {
            if($key === $suffix."_synthese") {
                $stm->bindParam(":".implode("_",$arr),$_POST[$key]);
            } else {
                if(!empty($value)) $stm->bindParam(":".implode("_",$arr),$_POST[$key]);
                else {
                    $err++;
                    $message[] = "Le champs ".$lang[implode("_",$arr)]." est obligatoire!";
                }
            }
        }
    }
}

$stm->bindParam(':date_controle',date('Y-m-d'));

if($paramcount < 1) {
    $err++;
    $message[] = "Vous n'avez pas le droit d'effectuer cette action !";
}

if($err == 0){
    if($stm->execute()){
        $lastInsertedId = $db->lastInsertId();

        $stm1 = $db->prepare("insert into point_bloquant_type_de_blocage (id_point_bloquant) values ($lastInsertedId)");
        $stm2 = $db->prepare("insert into point_bloquant_moyens_mis_en_oeuvre (id_point_bloquant) values ($lastInsertedId)");
        $stm3 = $db->prepare("insert into point_bloquant_solutions_preconisees (id_point_bloquant) values ($lastInsertedId)");

        $stm1->execute();
        $stm2->execute();
        $stm3->execute();

        $message [] = "Infos point bloquant enregistré avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message , "id" => $lastInsertedId));

?>