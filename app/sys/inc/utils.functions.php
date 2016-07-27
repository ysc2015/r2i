<?php
/**
 * file: utils.functions.php
 * User: rabii
 */

function getDuree($date_debut,$date_ret) {
    $now = new DateTime();

    $dd = DateTime::createFromFormat('Y-m-d', $date_debut);
    $df = DateTime::createFromFormat('Y-m-d', $date_ret);

    if($dd && $df && $df < $dd) return "erreur";

    if($dd) {
        if($dd > $now) {
            return "plannifié";
        } else {
            if(!$df) {
                return "en cours";
            } else {
                return ($dd->diff($df)->format("%a") + 1);
            }
        }
    } else {
        return "non démarrée";
    }
}