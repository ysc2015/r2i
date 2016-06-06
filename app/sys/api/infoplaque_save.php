<?php
/**
 * file: infoplaque_save.php
 * User: rabii
 */

include_once __DIR__."/../inc/config.php";

extract($_POST);

$message = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h3 class="font-w300 push-15">Information</h3><p>Information <a class="alert-link" href="javascript:void(0)">message</a>!</p></div>';

die("$.fancybox('<div class=\"alert alert-info\"><h3 class=\"font-w300 push-15\">Information</h3><p>Information</p></div>',
{minWidth: 'auto',minHeight: 'auto',closeClick  : false,fitToView : false,
    helpers     : {
        overlay : {closeClick: false}
    }})");