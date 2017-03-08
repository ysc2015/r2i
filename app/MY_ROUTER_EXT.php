<?php
/**
 * file: MY_ROUTER_EXT.php
 * User: rabii
 */

require_once __DIR__ . '/sys/libs/vendor/autoload.php';
require_once __DIR__ . "/sys/inc/config.php";
require_once __DIR__."/sys/inc/user.roles.php";
require_once __DIR__."/sys/language/fr/default.php";
require_once __DIR__ . "/sys/inc/utils.functions.php";
require_once __DIR__."/sys/inc/mail.notifier.class.php";
require_once __DIR__."/sys/inc/ssp.class.php";
include __DIR__ . "/sys/api/" . $_GET['script'];
exit(0);