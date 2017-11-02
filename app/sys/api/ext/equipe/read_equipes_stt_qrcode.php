<?php
/**
 * file: equipes_stt_generate_qrcode.php
 * User: fadil
 */


extract($_POST);
extract($_GET);

$reponse = "N";

if(isset($ide) && !empty($ide)&& isset($email) && !empty($email) ) {
    $equipestt_stm = $db->prepare("SELECT t1.* from equipe_stt as t1
                        where t1.id_equipe_stt = $ide AND t1.mail = $email AND t1.id_equipe_types IN (SELECT equipe_types.id_equipe_types FROM equipe_types WHERE a2t = 1 AND equipe_types.id_equipe_types IS NOT NULL)");
    $equipestt_stm->execute();
echo "SELECT t1.* from equipe_stt as t1
                        where t1.id_equipe_stt = $ide AND t1.mail = $email AND t1.id_equipe_types IN (SELECT equipe_types.id_equipe_types FROM equipe_types WHERE a2t = 1 AND equipe_types.id_equipe_types IS NOT NULL)";

     if($equipestt_stm->rowCount() > 0) {
         echo "OUI";
     }else{
         echo "NO";
     }


}


echo json_encode(SSP::simpleJoin($_GET,$reponse));