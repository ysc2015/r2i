<?php

extract($_GET);

$templateFile = __DIR__."/../uploads/templates/EBM_PON_HRZ_indice_E.xlsx";

define('WP_USE_THEMES', true);

if(isset($id)) {
    parse_DEF_BPE_EBM($db,"",$templateFile,$id);
}