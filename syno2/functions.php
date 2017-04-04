<?php

function isLogged() {
    global $_SESSION;
    if(isset($_SESSION['user']['syno']) && !empty($_SESSION['user']['syno'])) {
        return true;
    }
    return false;
}

function fetchAll(PDO $pdo,$query) {
    $stm = $pdo->prepare($query);
    $stm->execute();
    return $stm->fetchAll();
}

