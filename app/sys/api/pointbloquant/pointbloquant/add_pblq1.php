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
            if($key === $suffix."_synthese" /*|| $key === $suffix."_id_entreprise" || $key === $suffix."_id_equipe_stt"*/) {
                /*$v = (empty($_POST[$key]) ? NULL : $_POST[$key]);
                $stm->bindParam(":".implode("_",$arr),$v);*/

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

$dc = date('Y-m-d');
$stm->bindParam(':date_controle',$dc);

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
        //send mail add point bloquant
        $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'','',8,'',$ot->type_ot,$ot->sousprojet->ville);
        $message[] =  $mailaction_object = $mailaction_html[1];
        $message[] =  $mailaction_html =  $mailaction_html[0];
        $message[] =  $mailaction_cc =return_list_mail_cc_notif($db,"",8);
        $message[] =  $mailaction_to =return_list_vpi_pci_du_nro($db,$sousProjet->projet->nro->id_nro);

        if(count($mailaction_to)>0){
            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,array(),$mailaction_cc)) {
                $message[] = "Mail envoyé !";
            } else {
                $message[] = "Mail non envoyé !";
                $err++;
            }
        }else{
            $message[] = "Liste de destination vide Mail non envoyé !";
        }
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message , "id" => $lastInsertedId));

?>