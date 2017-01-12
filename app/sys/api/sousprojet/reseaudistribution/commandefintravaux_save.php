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

$suffix = "dcftrvx";
$fieldslist = "";
$valueslist = ":id_sous_projet,";
$paramcount = 0;

$fields = array();

if($sousProjet !== NULL) {
    if($sousProjet->distributioncmdfintravaux !== NULL) {
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

        $stm = $db->prepare("update sous_projet_distribution_commande_fin_travaux set $fieldslist where id_sous_projet=:id_sous_projet");
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

        $stm = $db->prepare("insert into sous_projet_distribution_commande_fin_travaux ($fieldslist) values ($valueslist)");
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

if(isset($dcftrvx_intervenant_be)){
    $stm->bindParam(':intervenant_be',$dcftrvx_intervenant_be);
    $insert = true;
}

if(isset($dcftrvx_date_butoir)){
    $stm->bindParam(':date_butoir',$dcftrvx_date_butoir);
    $insert = true;
}

if(isset($dcftrvx_traitement_retour_terrain)){
    $stm->bindParam(':traitement_retour_terrain',$dcftrvx_traitement_retour_terrain);
    $insert = true;
}

if(isset($dcftrvx_modification_carto)){
    $stm->bindParam(':modification_carto',$dcftrvx_modification_carto);
    $insert = true;
}

if(isset($dcftrvx_commandes_fin_travaux)){
    $stm->bindParam(':commandes_fin_travaux',$dcftrvx_commandes_fin_travaux);
    $insert = true;
}

if(isset($dcftrvx_date_transmission_tfx)){
    $stm->bindParam(':date_transmission_tfx',$dcftrvx_date_transmission_tfx);
    $insert = true;
}

if(isset($dcftrvx_ref_commande_fin_travaux)){
    $stm->bindParam(':ref_commande_fin_travaux',$dcftrvx_ref_commande_fin_travaux);
    $insert = true;
}

if(isset($dcftrvx_ok_ft)){
    $stm->bindParam(':ok_ft',$dcftrvx_ok_ft);
    $insert = true;
}

if(isset($dcftrvx_ok)){
    $stm->bindParam(':ok',$dcftrvx_ok);
    $insert = true;
}

if(isset($dcftrvx_date_debut_travaux_ft)){
    $stm->bindParam(':date_debut_travaux_ft',$dcftrvx_date_debut_travaux_ft);
    $insert = true;
}

if(isset($dcftrvx_date_fin_travaux_ft)){
    $stm->bindParam(':date_fin_travaux_ft',$dcftrvx_date_fin_travaux_ft);
    $insert = true;
}

if($insert == true && $err == 0){
    if($stm->execute()){

        /*$sousProjet = SousProjet::find($ids);//re-fetch sp
        if($sousProjet->is_master == 1) {
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->distributioncmdfintravaux == NULL && $sp->id_sous_projet != $sousProjet->id_sous_projet) {
                    $stm_create = $db->prepare("insert into sous_projet_distribution_commande_fin_travaux (id_sous_projet) values ($sp->id_sous_projet)");
                    $stm_create->execute();
                }
            }
            $sousProjet = SousProjet::find($ids);//re-fetch sp
            foreach($sousProjet->projet->sousprojets as $sp) {
                if($sp->id_sous_projet !== $sousProjet->id_sous_projet) {
                    $sp->distributioncmdfintravaux->id_sous_projet = $sp->id_sous_projet;
                    foreach($fields as $field) {
                        $sp->distributioncmdfintravaux->{$field} = $sousProjet->distributioncmdfintravaux->{$field};
                    }
                    $sp->distributioncmdfintravaux->save();
                }
            }
        }*/
        
        $message [] = "Enregistrement fait avec succès";
    } else {
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));
?>