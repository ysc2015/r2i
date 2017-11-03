<?php
/**
 * file: equipes_stt_generate_qrcode.php
 * User: fadil
 */


extract($_POST);
extract($_GET);
$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'qrcode_equipe'.DIRECTORY_SEPARATOR;
$PNG_WEB_DIR = 'qrcode_equipe/';
require_once __DIR__."/../../../../sys/libs/vendor/qrcode/qrlib.php";

if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);
$matrixPointSize = 6;
$errorCorrectionLevel = 'L';

$reponse = "N";
$content = [];
if(isset($ide) && !empty($ide)&& isset($email) && !empty($email) ) {
    $equipestt_stm = $db->prepare("SELECT t1.id_equipe_stt,t1.prenom,t1.mail,t1.tel, t1.nom as nom_equipe,t2.nom as nom_entreprise,t2.id_entreprise,t2.code_entreprise,t2.adresse_siege from equipe_stt as t1 ,entreprises_stt t2
                        where t2.id_entreprise = t1.id_entreprise AND t1.id_equipe_stt = $ide AND t1.mail = '$email' AND t1.id_equipe_types IN (SELECT equipe_types.id_equipe_types FROM equipe_types WHERE a2t = 1 AND equipe_types.id_equipe_types IS NOT NULL)");
     $equipestt_stm->execute();

     if($equipestt_stm->rowCount() > 0) {
         $equipestt_stm_liste = $equipestt_stm->fetchObject();

         $filename = $PNG_TEMP_DIR.$equipestt_stm_liste->nom_equipe.'.png';

         QRcode::png($equipestt_stm_liste->id_equipe_stt.'|'.$equipestt_stm_liste->mail, $filename, $errorCorrectionLevel, $matrixPointSize, 2);


         echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><br />'.$filename.'<hr />';


         $table_entreprise = array(
             "id_entreprise" =>  $equipestt_stm_liste->id_entreprise,
             "nom" => $equipestt_stm_liste->nom_entreprise ,
             "code_entreprise" => $equipestt_stm_liste->code_entreprise,
             "adresse_siege" => $equipestt_stm_liste->adresse_siege
         );
          $reponse = "OUI";

             $content =  array
                (  "id_equipe_stt" => $equipestt_stm_liste->id_equipe_stt ,
                  "entreprise" => $table_entreprise,
                   "nom" =>  $equipestt_stm_liste->nom_equipe,
                  "prenom" =>  $equipestt_stm_liste->prenom,
                  "mail"  =>  $equipestt_stm_liste->mail,
                  "tel" =>  $equipestt_stm_liste->tel,
                  "qrcode" =>  $PNG_WEB_DIR.$filename
                );





     }else{
         $reponse =  "NO";
     }


}

 echo json_encode(array("content" => $content));