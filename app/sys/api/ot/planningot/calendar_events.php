<?php
/**
 * file: calendar_events.php
 * User: rabii
 */

extract($_GET);
extract($_POST);

try {
    $sql = "select *,DATE_ADD(date_fin, INTERVAL 1 DAY) AS df  from ordre_de_travail where date_debut >='$start' and date_fin<='$end'";

    if(isset($team_id) && !empty($team_id)) {
        $sql .= " and id_equipe_stt=$team_id";
    } else if(isset($soc_id) && !empty($soc_id)) {
        $sql .=  " and id_entreprise=$soc_id";
    }

    $stm = $db->prepare($sql);
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
        $e['color'] = '#faeab9';
        $e['textColor'] = '#000';
        $e['team'] = $team_id;
        $e['societe'] = $soc_id;

        // Merge the event array into the return array
        array_push($events, $e);

    }

    // Output json for our calendar
    echo json_encode($events);
    exit();

} catch (PDOException $e){
    echo $e->getMessage();
}