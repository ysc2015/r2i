<?php
/**
 * file: my_calendar_events.php
 * User: rabii
 */

extract($_GET);
extract($_POST);

try {
    $sql = "select ot.*,es.nom as societe,eq.imei,eq.prenom,eq.nom,tot.lib_type_ordre_travail as typeot,tot.system,DATE_ADD(date_fin, INTERVAL 1 DAY) AS df  from ordre_de_travail as ot,entreprises_stt as es,equipe_stt as eq,select_type_ordre_travail as tot where (date_debut between '$start' and '$end' or date_fin between '$start' and '$end' or '$start' between date_debut and date_fin)";

    $sql .= " AND  ot.id_entreprise=es.id_entreprise AND ot.id_equipe_stt=eq.id_equipe_stt AND ot.id_type_ordre_travail=tot.id_type_ordre_travail";

    $sql .=  " AND ot.id_entreprise=".$connectedProfil->profil->id_entreprise;

    /*if(isset($idot) && !empty($idot)) {
        $sql .= " AND ot.id_ordre_de_travail=$idot";
    }*/

    echo $sql;

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
        $e['title'] = getObjectNameForEntry($row['type_entree'])." ".($sousProjet->projet->nro !==NULL?$sousProjet->projet->nro->lib_nro:"n/d")." - ".$sousProjet->zone;
        //$e['title'] = $row['type_entree'];
        $e['start'] = $row['date_debut']." 00:00:00";
        $e['end'] = $row['df']." 00:00:00";
        $e['allDay'] = true;
        $e['color'] = getOTColorFromStatus($row['id_etat_ot']);
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
        $e['system'] = $row['system'];

        /*$sousProjet = SousProjet::first(
            array('conditions' =>
                array("id_sous_projet = ?", $row['id_sous_projet'])
            )
        );*/

        array_push($events, $e);

    }

    if(isset($date1) && !empty($date1) && isset($date2) && !empty($date2)) {
        $e = array();
        $e['id'] = '-1';
        $e['title'] = 'clicker ici pour valider l\'affectation';
        $e['start'] = $date1." 00:00:00";
        $e['end'] = date('Y-m-d',strtotime($date2." 00:00:00" . ' +1 day'));
        $e['allDay'] = true;
        $e['color'] = '#89D6AE';
        $e['textColor'] = '#000';
        $e['dd'] = $date1;
        $e['df'] = $date2;
        $e['socid'] = 0;
        $e['equipeid'] = 0;
        $e['societe'] = '';
        $e['imei'] = '';
        $e['equipe'] = '';
        $e['etape'] = '';
        $e['typeot'] = '';

        array_push($events, $e);
    }

    echo json_encode($events);
    exit();

} catch (PDOException $e){
    echo $e->getMessage();
}