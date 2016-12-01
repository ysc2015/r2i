<?php

extract($_GET);

$templateFile = __DIR__."/../uploads/templates/Bordereaux de Prix FTTH_INT_HRZ_INDA.xlsx";

define('WP_USE_THEMES', true);

if(isset($id)) {
    parse_loadExcelDEF_CABLE($db,"",$templateFile,$id);
}