<?php
/**
 * file: projet_add.php
 * User: rabii
 */

ini_set("display_errors",'1');

$output_dir = __DIR__."/uploads/projets/";
set_time_limit(60);

extract($_POST);

if (isset($_FILES["myfile"])) {
    $ret = array();
    $error = $_FILES["myfile"]["error"];
    if (!is_array($_FILES["myfile"]["name"])) {
        $fileName = $_FILES["myfile"]["name"] . "_" . time();
        $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$fileName:[]);

    } else  {
        $fileCount = count($_FILES["myfile"]["name"]);
        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $_FILES["myfile"]["name"][$i] . "_" . time();
            $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName)?$fileName:[]);
        }
    }
    echo json_encode(array('files' => $ret, 'task' => $task));
} else json_encode(array('error' => true));

?>