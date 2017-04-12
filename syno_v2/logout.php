<?php
include_once 'config.php';

session_destroy();
unset($_SESSION['user']);

ResponseHelper::redirect('login.php');