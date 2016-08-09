<?php
/**
 * file: equipe_liste.php
 * User: rabii
 */

include_once __DIR__."/../../inc/config.php";

extract($_POST);

if(isset($id)) {
    $stm = $db->prepare("select * from equipe_stt where id_entreprise_stt=:id_entreprise_stt order by id_equipe_stt desc");
    $stm->bindParam(":id_entreprise_stt", $id);
    if ($stm->execute()) {
        echo json_encode(array("count" => $stm->rowCount(), "data" => $stm->fetchAll(PDO::FETCH_ASSOC)));
    }

    return;

}
echo json_encode(array());


?>