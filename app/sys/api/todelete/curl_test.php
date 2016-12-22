<?php
/**
 * file: curl_test.php
 * User: rabii
 */

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://gbts.free-infra.vlq16.iliad.fr/curl_dedibox/get_fci_data.php',
    //CURLOPT_USERAGENT => 'cURL Request',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        'num_commande_fci' => 'F99625190416'
    ),
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false
));

// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

print_r($resp);