<?php

header('Content-Type: application/json');
$data = file_get_contents('miserables.json');

echo $data;?>
