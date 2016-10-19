<?php
/**
 * file: calendar_events.php
 * User: rabii
 */

try {

$stm = $db->prepare("select *,DATE_ADD(date_fin, INTERVAL 1 DAY) AS df  from ordre_de_travail");
$stm->execute();

// Returning array
$events = array();

// Fetch results
while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

    $e = array();
    $e['id'] = $row['id_ordre_de_travail'];
    $e['title'] = $row['type_entree'];
    $e['start'] = $row['date_debut']." 00:00:00";
    $e['end'] = $row['df']." 00:00:00";
    $e['allDay'] = true;
    $e['color'] = '#0915d7';

    // Merge the event array into the return array
    array_push($events, $e);

}

// Output json for our calendar
echo json_encode($events);
exit();

} catch (PDOException $e){
    echo $e->getMessage();
}