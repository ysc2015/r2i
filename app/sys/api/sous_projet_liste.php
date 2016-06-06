<?php
/**
 * file: sous_projet_liste.php
 * User: rabii
 */

include_once __DIR__."/../inc/config.php";

extract($_POST);

if(isset($id)) {
    $stm = $db->prepare("select * from sous_projet where id_projet=:id_projet");
    $stm->bindParam(":id_projet", $id);
    if ($stm->execute()) {
        echo json_encode(array("count" => $stm->rowCount(), "data" => $stm->fetchAll(PDO::FETCH_ASSOC)));
    }

    return;

}
 echo json_encode(array());


?>