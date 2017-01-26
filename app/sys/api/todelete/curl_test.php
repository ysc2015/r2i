<?php
/**
 * file: curl_test.php
 * User: rabii
 */

extract($_POST);

$data = array(
    "num_commande_fci" => $num_commande_fci,
    "etat_commande" => "etat.encours",
    "date_emission" => "2016-08-09 16:20:05",
    "date_ar" => "2016-08-10",
    "type_commande" => "Génie Civil Boucle Locale Optique - Accès FTTx : Commande d'accès structurant FTTx",
    "type_entite" => "Free Infra",
    "date_deb_tvx" => "07/09/2016",
    "date_fin_tvx" => "12/12/2016"
);


echo json_encode(array("statut" => "OK","raison" => "Commande FCI ".$num_commande_fci." trouvée", "data" => $data));
