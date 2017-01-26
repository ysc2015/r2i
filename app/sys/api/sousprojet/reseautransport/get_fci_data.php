<?php
/**
 * file: get_fci_data.php
 * User: rabii
 */

sleep(2);//test loader only

extract($_POST);
//extract($_GET);

if(isset($num_commande_fci) && !empty($num_commande_fci)) {
    try {
        $ch = curl_init();

        if (FALSE === $ch)
            throw new Exception('failed to initialize');

        curl_setopt($ch, CURLOPT_URL, CMD_STRUC_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "num_commande_fci=$num_commande_fci");

        $content = curl_exec($ch);

        if (FALSE === $content)
            throw new Exception(curl_error($ch), curl_errno($ch));

        // ...process $content now

        echo $content;
    } catch(Exception $e) {

        trigger_error(sprintf(
            'Curl failed with error #%d: %s',
            $e->getCode(), $e->getMessage()),
            E_USER_ERROR);

    }
} else {
    echo json_encode(array("statut" => "aucune commande fci envoyée !"));
}