<?php
/**
 * file: calendar_events.php
 * User: rabii
 */

extract($_GET);
extract($_POST);

try {
    $sql = "select ot.*,es.nom as societe,eq.imei,eq.prenom,eq.nom,tot.lib_type_ordre_travail as typeot,DATE_ADD(date_fin, INTERVAL 1 DAY) AS df  from ordre_de_travail as ot,entreprises_stt as es,equipe_stt as eq,select_type_ordre_travail as tot where date_debut >='$start' and date_fin<='$end'";

    $sql .= " AND  ot.id_entreprise=es.id_entreprise AND ot.id_equipe_stt=eq.id_equipe_stt AND ot.id_type_ordre_travail=tot.id_type_ordre_travail";

    if(isset($team_id) && !empty($team_id)) {
        $sql .= " and id_equipe_stt=$team_id";
    } else if(isset($soc_id) && !empty($soc_id)) {
        $sql .=  " and id_entreprise=$soc_id";
    }

    $stm = $db->prepare($sql);
    $stm->execute();

    $events = array();

    // Fetch results
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

        $sousProjet = SousProjet::first(
            array('conditions' =>
                array("id_sous_projet = ?", $row['id_sous_projet'])
            )
        );

        $e = array();
        $e['id'] = $row['id_ordre_de_travail'];
        $e['title'] = getObjectNameForEntry($row['type_entree'])." ".$sousProjet->projet->nro->lib_nro." - ".$sousProjet->zone;
        $e['start'] = $row['date_debut']." 00:00:00";
        $e['end'] = $row['df']." 00:00:00";
        $e['allDay'] = true;
        $e['color'] = '#faeab9';
        $e['textColor'] = '#000';
        $e['dd'] = $row['date_debut'];
        $e['df'] = $row['date_fin'];
        $e['socid'] = $row['id_entreprise'];
        $e['equipeid'] = $row['id_equipe_stt'];
        $e['societe'] = $row['societe'];
        $e['imei'] = $row['imei'];
        $e['equipe'] = $row['prenom']." ".$row['nom'];
        $e['etape'] = getObjectNameForEntry($row['type_entree']);
        $e['typeot'] = $row['typeot'];

        $sousProjet = SousProjet::first(
            array('conditions' =>
                array("id_sous_projet = ?", $row['id_sous_projet'])
            )
        );

        array_push($events, $e);

    }

    echo json_encode($events);
    exit();

} catch (PDOException $e){
    echo $e->getMessage();
}