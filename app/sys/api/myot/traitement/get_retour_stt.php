<?php
/**
 * file: get_retour_stt.php
 * User: rabii
 */

extract($_POST);

$sousProjet = NULL;

$err = 0;
$message = array();

$retour = "";
$lien = array();
$etatretour = "";

if(isset($idsp) && !empty($idsp)){
    $sousProjet = SousProjet::find($idsp);
}

$tentree = array();

if($sousProjet !== NULL) {
    switch($idtot) {
        case "1" :
            $tentree[] = array("transportaiguillage","Lien vers les plans Aiguillage CTR","link_lien_plans_wrapper1","label_link_lien_plans1","link_lien_plans1");//(step,begin step date field):end field is the same for all steps
            break;
        case "2" :
            $tentree[] = array("transporttirage","Lien vers les plans Tirage CTR","link_lien_plans_wrapper1","label_link_lien_plans1","link_lien_plans1");
            break;
        case "3" :
            $tentree[] = array("transportraccordement","Lien vers les plans Raccordement CTR","link_lien_plans_wrapper1","label_link_lien_plans1","link_lien_plans1");
            break;
        case "4" :
            $tentree[] = array("transporttirage","Lien vers les plans Aiguillage CTR","link_lien_plans_wrapper1","label_link_lien_plans1","link_lien_plans1");
            $tentree[] = array("transportraccordement","Lien vers les plans Raccordement CTR","link_lien_plans_wrapper2","label_link_lien_plans2","link_lien_plans2");
            break;
        case "5" :
            $tentree[] = array("distributionaiguillage","Lien vers les plans Aiguillage CDI","link_lien_plans_wrapper1","label_link_lien_plans1","link_lien_plans1");
            break;
        case "6" :
            $tentree[] = array("distributiontirage","Lien vers les plans Tirage CDI","link_lien_plans_wrapper1","label_link_lien_plans1","link_lien_plans1");
            break;
        case "7" :
            $tentree[] = array("distributionraccordement","Lien vers les plans Raccordement CDI","link_lien_plans_wrapper1","label_link_lien_plans1","link_lien_plans1");
            break;
        case "8" :
            $tentree[] = array("distributiontirage","Lien vers les plans Tirage CDI","link_lien_plans_wrapper1","label_link_lien_plans1","link_lien_plans1");
            $tentree[] = array("distributionraccordement","Lien vers les plans CDI","link_lien_plans_wrapper2","label_link_lien_plans2","link_lien_plans2");
            break;
        case "9" :
            $tentree[] = array("transportrecette","Lien vers les plans Recette Optique CTR","link_lien_plans_wrapper1","label_link_lien_plans1","link_lien_plans1");
            break;
        case "10" :
            $tentree[] = array("distributionrecette","Lien vers les plans Recette Optique CDI","link_lien_plans_wrapper1","label_link_lien_plans1","link_lien_plans1");
        default :
            $err++;
            $message[] = "cet OT n'est pas natif ou erreur traitement !";
            break;
    }
} else {
    $err++;
    $message[] = "Erreur reférence sous projet";
}

if($err == 0) {
    $i=0;
    foreach($tentree as $key => $value) {
        if($sousProjet->{$value[0]} !== NULL) {

            if($i == 0) {
                if($idtot == 9 || $idtot == 10)
                    $etatretour = $sousProjet->{$value[0]}->etat_recette;
                else
                    $etatretour = $sousProjet->{$value[0]}->etat_retour;
            }

            $retour = $sousProjet->{$value[0]}->retour_presta;

            $lien[] = array(
                "label" => $value[1],
                "wrapper" => $value[2],
                "labelid" => $value[3],
                "selector" => $value[4],
                "value" => $sousProjet->{$value[0]}->lien_plans,
            );
        }
        $i++;
    }


}

echo json_encode(array("error" => $err, "retour" => $retour, "liens" => $lien, "etatretour" => $etatretour));

