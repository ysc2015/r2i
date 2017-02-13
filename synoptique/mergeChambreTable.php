<?php

require_once 'config.php';

//$pdo->exec('TRUNCATE ' . $table_prefix . 'chambre');

$type_chambre = fetchAll($pdo, 'SELECT * FROM  `'.$table_prefix.'type_chambre`');

$assoc = [];

foreach($type_chambre as $key => $value) {
    $assoc[$value['lib_type_chambre']] = $value['id_type_chambre'];
}

$stm_chambre = $pdo->prepare('SELECT * FROM  `chambre`');
$stm_chambre->execute();

$stm_merge = $pdo->prepare('INSERT INTO ' . $table_prefix .'chambre(ref_chambre,type_chambre,gps) VALUES (:ref_chambre, :type_chambre,:gps)');

while($row = $stm_chambre->fetch(PDO::FETCH_ASSOC)) {
    $ref = $row['code_ch1'] . '-' . $row['code_ch2'];
    $stm_merge->bindParam(':ref_chambre',$ref);
    $stm_merge->bindParam(':type_chambre',$assoc[$row['ref_chambre']]);
    $stm_merge->bindParam(':gps',$row['gps']);
    $stm_merge->execute();
}

?>