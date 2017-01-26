<?php
/**
 * file: commandefintravaux_save.php
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

$suffix = "cftrvx";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

$fields = array();

if($sousProjet !== NULL) {
    if($sousProjet->transportcmdfintravaux !== NULL) {
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr)."=:".implode("_",$arr).",";

                $fields[] = implode("_",$arr);
            }
        }

        $fieldslist = rtrim($fieldslist,",");

        $stm = $db->prepare("update sous_projet_transport_commande_fin_travaux set $fieldslist where id_sous_projet=:id_sous_projet");
    } else {
        $fieldslist = "id_sous_projet,";
        foreach( $_POST as $key => $value ) {

            if(strpos($key,$suffix) !== false) {
                $paramcount++;
                $arr = explode("_",$key);
                array_shift($arr);
                $fieldslist .= implode("_",$arr).",";
                $valueslist .= ":".implode("_",$arr).",";

                $fields[] = implode("_",$arr);
            }
        }

        $fieldslist = rtrim($fieldslist,",");
        $valueslist = rtrim($valueslist,",");

        $stm = $db->prepare("insert into sous_projet_transport_commande_fin_travaux ($fieldslist) values ($valueslist)");
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

if(isset($cftrvx_intervenant_be)){
    $stm->bindParam(':intervenant_be',$cftrvx_intervenant_be);
    $insert = true;
}

if(isset($cftrvx_date_butoir)){
    $stm->bindParam(':date_butoir',$cftrvx_date_butoir);
    $insert = true;
}

if(isset($cftrvx_traitement_retour_terrain)){
    $stm->bindParam(':traitement_retour_terrain',$cftrvx_traitement_retour_terrain);
    $insert = true;
}

if(isset($cftrvx_modification_carto)){
    $stm->bindParam(':modification_carto',$cftrvx_modification_carto);
    $insert = true;
}

if(isset($cftrvx_commandes_fin_travaux)){
    $stm->bindParam(':commandes_fin_travaux',$cftrvx_commandes_fin_travaux);
    $insert = true;
}

if(isset($cftrvx_date_transmission_tfx)){
    $stm->bindParam(':date_transmission_tfx',$cftrvx_date_transmission_tfx);
    $insert = true;
}

if(isset($cftrvx_ref_commande_fin_travaux)){
    $stm->bindParam(':ref_commande_fin_travaux',$cftrvx_ref_commande_fin_travaux);
    $insert = true;
}

if(isset($cftrvx_go_ft)){
    $stm->bindParam(':go_ft',$cftrvx_go_ft);
    $insert = true;
}

if(isset($cftrvx_ok)){
    $stm->bindParam(':ok',$cftrvx_ok);
    $insert = true;
}

if(isset($cftrvx_date_debut_travaux_ft)){
    $stm->bindParam(':date_debut_travaux_ft',$cftrvx_date_debut_travaux_ft);
    $insert = true;
}

if(isset($cftrvx_date_fin_travaux_ft)){
    $stm->bindParam(':date_fin_travaux_ft',$cftrvx_date_fin_travaux_ft);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){

        $sousProjet = SousProjet::find($ids);//re-fetch sp
        if($sousProjet->is_master == 1) {
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->transportcmdfintravaux == NULL && $sp->id_sous_projet != $sousProjet->id_sous_projet) {
                    $stm_create = $db->prepare("insert into sous_projet_transport_commande_fin_travaux (id_sous_projet) values ($sp->id_sous_projet)");
                    $stm_create->execute();
                }
            }
            $sousProjet = SousProjet::find($ids);//re-fetch sp
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->id_sous_projet !== $sousProjet->id_sous_projet) {
                    $sp->transportcmdfintravaux->id_sous_projet = $sp->id_sous_projet;
                    foreach($fields as $field) {
                        $sp->transportcmdfintravaux->{$field} = $sousProjet->transportcmdfintravaux->{$field};
                    }
                    $sp->transportcmdfintravaux->save();
                }
            }
        }
        
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>