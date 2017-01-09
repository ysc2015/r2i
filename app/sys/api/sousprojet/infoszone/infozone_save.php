<?php
/**
 * file: infozone_save.php
 * User: rabii
 */

extract($_POST);

$sousProjet = NULL;
$stm = NULL;

if(isset($ids) && !empty($ids)){
    $sousProjet = SousProjet::find($ids);
}

$insert = false;
$err = 0;
$message = array();

$suffix = "sz";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

if($sousProjet !== NULL) {
    if($sousProjet->infozone !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_zone set $fieldslist where id_sous_projet=:id_sous_projet");
    } else {
        $fieldslist = "id_sous_projet,";
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

        $stm = $db->prepare("insert into sous_projet_zone ($fieldslist) values ($valueslist)");
    }
} else {
    $err++;
    $message[] = "Erreur reférence sous projet";
}

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

if(isset($sz_nbr_zone)){
    $stm->bindParam(':nbr_zone',$sz_nbr_zone);
    $insert = true;
}

if(isset($sz_lr_sur_pm)){
    $stm->bindParam(':lr_sur_pm',$sz_lr_sur_pm);
    $insert = true;
}

if(isset($sz_lr)){
    $stm->bindParam(':lr',$sz_lr);
    $insert = true;
}

if(isset($sz_nbr_de_site)){
    $stm->bindParam(':nbr_de_site',$sz_nbr_de_site);
    $insert = true;
}

if(isset($sz_nb_fo_sur_pm)){
    $stm->bindParam(':nb_fo_sur_pm',$sz_nb_fo_sur_pm);
    $insert = true;
}

if(isset($sz_nb_fo_sur_pmz)){
    $stm->bindParam(':nb_fo_sur_pmz',$sz_nb_fo_sur_pmz);
    $insert = true;
}

if(isset($sz_tranche_cdi)){
    $stm->bindParam(':tranche_cdi',$sz_tranche_cdi);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>