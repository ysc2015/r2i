<?php
/**
 * Created by PhpStorm.
 * User: fadil
 * Date: 26/12/16
 * Time: 11:49 ص
 */
include_once "../../../inc/config.php";
include_once "../../../language/fr/default.php";

extract($_GET);
if(isset($contenthtml)){
    $stm_mail_content_notif = $db->prepare("update mail_notification_template set  template = :contenthtml, object = :object where type = :type");

    $stm_mail_content_notif->bindParam(':contenthtml',$contenthtml);
    $stm_mail_content_notif->bindParam(':object',$object);
    $stm_mail_content_notif->bindParam(':type',$type);
    if($stm_mail_content_notif->execute()) echo "OK";
    else echo "NOK";


}else{
    $stm_mail_content_notif = $db->prepare("select template,object from mail_notification_template where type = :type");

    $stm_mail_content_notif->bindParam(':type',$type);
    $stm_mail_content_notif->execute();
    $row = $stm_mail_content_notif->fetch();
        echo json_encode(array("template" => $row[0], "object" => $row[1], ))  ;

}
