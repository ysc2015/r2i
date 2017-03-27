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
$fieldslist .=",date_insertion,id_createur";
$valueslist .=",:date_insertion,:id_createur";

$stm = $db->prepare("insert into point_bloquant ($fieldslist) values ($valueslist)");

$date_insertion =  date('Y-m-d G:i:s');
$stm->bindParam(':date_insertion',$date_insertion);
$id_createur = intval($connectedProfil->profil->id_utilisateur);
$stm->bindParam(':id_createur',$id_createur);
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

        $stm1 = $db->prepare("insert into point_bloquant_type_de_blocage (id_point_bloquant,date_insertion,id_createur) values ($lastInsertedId,:date_insertion,:id_createur)");
        $stm2 = $db->prepare("insert into point_bloquant_moyens_mis_en_oeuvre (id_point_bloquant,date_insertion,id_createur) values ($lastInsertedId,:date_insertion,:id_createur)");
        $stm3 = $db->prepare("insert into point_bloquant_solutions_preconisees (id_point_bloquant,date_insertion,id_createur) values ($lastInsertedId,:date_insertion,:id_createur)");

        $date_insertion =  date('Y-m-d G:i:s');
        $stm1->bindParam(':date_insertion',$date_insertion);
        $id_createur = intval($connectedProfil->profil->id_utilisateur);
        $stm1->bindParam(':id_createur',$id_createur);

        $date_insertion =  date('Y-m-d G:i:s');
        $stm2->bindParam(':date_insertion',$date_insertion);
        $id_createur = intval($connectedProfil->profil->id_utilisateur);
        $stm2->bindParam(':id_createur',$id_createur);

        $date_insertion =  date('Y-m-d G:i:s');
        $stm3->bindParam(':date_insertion',$date_insertion);
        $id_createur = intval($connectedProfil->profil->id_utilisateur);
        $stm3->bindParam(':id_createur',$id_createur);

        $stm1->execute();
        $stm2->execute();
        $stm3->execute();

        $stm_detail_point_bloc = $db->prepare("SELECT * FROM `point_bloquant`,sous_projet,projet,`nro`, `ordre_de_travail` where `ordre_de_travail`.`id_sous_projet`=sous_projet.id_sous_projet and `nro`.`id_nro` = projet.id_nro and projet.id_projet =sous_projet.id_projet and id_point_bloquant = :id_point_bloquant and sous_projet.id_sous_projet = point_bloquant.id_sous_projet group by point_bloquant.id_point_bloquant");
        $stm_detail_point_bloc->bindValue(":id_point_bloquant",$lastInsertedId);
        $stm_detail_point_bloc->execute();
        $point_bloc_sous_proj = $stm_detail_point_bloc->fetch();
        $message [] = "Infos point bloquant enregistré avec succès";

        $mailaction_html = get_content_html_mail_by_type($db,$point_bloc_sous_proj['lib_nro']."-".$point_bloc_sous_proj['ville'],'','',8,'',$point_bloc_sous_proj['type_ot'],$point_bloc_sous_proj['ville']);
        $mailaction_object = $mailaction_html[1];
        $mailaction_html =  $mailaction_html[0];
        $mailaction_cc =array_merge(return_list_mail_cc_notif($db,"",8),return_list_bei_du_nro($db,$point_bloc_sous_proj['id_nro']));
        $mailaction_to =return_list_vpi_pci_du_nro($db,$point_bloc_sous_proj['id_nro']);

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