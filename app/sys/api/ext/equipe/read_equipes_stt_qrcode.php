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
         $equipestt_stm_liste = $equipestt_stm->fetchObject();

          $table_entreprise = array(
             "id_entreprise" =>  $equipestt_stm_liste->id_entreprise,
             "nom" => $equipestt_stm_liste->nom ,
             "code_entreprise" => $equipestt_stm_liste->code_entreprise,
             "adresse_siege" => $equipestt_stm_liste->adresse_siege
         );
          $reponse = "OUI";

             $content =  array
                (  "id_equipe_stt" => $equipestt_stm_liste->id_equipe_stt ,
                  "entreprise" => $table_entreprise,
                   "nom" =>  $equipestt_stm_liste->nom,
                  "prenom" =>  $equipestt_stm_liste->prenom,
                  "mail"  =>  $equipestt_stm_liste->mail,
                  "tel" =>  $equipestt_stm_liste->tel
                );





     }else{
         $reponse =  "NO";
     }


}

 echo json_encode(array("content" => $content));