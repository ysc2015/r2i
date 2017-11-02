<?php
/**
 * file: equipes_stt_generate_qrcode.php
 * User: fadil
 */


extract($_POST);
extract($_GET);

$reponse = "N";
$content = [];
if(isset($ide) && !empty($ide)&& isset($email) && !empty($email) ) {
    $equipestt_stm = $db->prepare("SELECT * from equipe_stt as t1 ,entreprises_stt t2
                        where t2.id_entreprise = t1.id_entreprise AND t1.id_equipe_stt = $ide AND t1.mail = '$email' AND t1.id_equipe_types IN (SELECT equipe_types.id_equipe_types FROM equipe_types WHERE a2t = 1 AND equipe_types.id_equipe_types IS NOT NULL)");
    $equipestt_stm->execute();

     if($equipestt_stm->rowCount() > 0) {

        /* $table_entreprise = array(
             id_equipe_stt =>  $equipestt_stm['id_entreprise'],
             id_equipe_stt => $equipestt_stm['nom'],
             id_equipe_stt => $equipestt_stm['code_entreprise'],
             id_equipe_stt => $equipestt_stm['adresse_siege']
         );
         $reponse = "OUI";

             $content =  array
                (  id_equipe_stt => $equipestt_stm['id_equipe_stt'],
                  entreprise => $table_entreprise,
                   nom =>  $equipestt_stm['nom'],
                  prenom =>  $equipestt_stm['prenom'],
                  mail =>  $equipestt_stm['mail'],
                  tel =>  $equipestt_stm['tel']
                );
        */




     }else{
         $reponse =  "NO";
     }


}

print_r($content);
echo json_encode($_GET,$reponse,$content);