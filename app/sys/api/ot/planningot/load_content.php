<?php
/**
 * file: load_content.php
 * User: rabii
 */

extract($_POST);

$views_folder = __DIR__."/../../../views/ot/planningot/views/";

if(isset($view)) {
    switch($view) {
        case "cal" :
            ob_start();
            include $views_folder.'/calendar.php';
            $content = ob_get_contents();
            ob_end_clean();
            echo $content;
            break;
        case "list" :
            ob_start();
            include $views_folder.'/datagrid.php';
            $content = ob_get_contents();
            ob_end_clean();
            echo $content;
            break;
        default :
            break;
    }
}

echo "";