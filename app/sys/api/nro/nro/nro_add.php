<?php
/**
 * file: nro_add.php
 * User: rabii
 */

extract($_POST);

$null = NULL;

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("select * from nro where lib_nro=:lib_nro ");

if(isset($idn) && !empty($idn)){
    $stm->bindParam(':lib_nro',strtoupper($idn));
    $stm->execute();
    if($stm->rowCount() > 0) {
        $err++;
        $message[] = "cet nro existe déjà!";
    } else {
        $stm = $db->prepare("insert into nro (lib_nro,id_utilisateur) values (:lib_nro,:id_utilisateur)");
        $stm->bindParam(':lib_nro',strtoupper($idn));
        if(isset($idu)){
            if(empty($idu)) {
                $stm->bindParam(':id_utilisateur',$null);
                $insert = true;
            } else {
                $stm->bindParam(':id_utilisateur',$idu);
                $insert = true;
            }
        }

        if($insert == true && $err == 0){
            if($stm->execute()){
                $message [] = "Nro ajouté avec succès";
            } else {
                $message [] = $stm->errorInfo();
            }
        }
    }
    $insert = true;
} else {
    $err++;
    $message[] = "Le champs nro est obligatoire !";
}
echo json_encode(array("error" => $err , "message" => $message));
?>