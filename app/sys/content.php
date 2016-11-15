<?php
/**
 * file: content.php
 * User: rabii
 */
include_once "inc/config.php";
include_once "language/fr/default.php";

extract($_GET);

$sousProjet = NULL;


switch ($page) {

    case "dashboard":
        $connectedProfil->dashboard();
        echo "<br><br>";
        break;
    case "projet":
        $connectedProfil->projet();
        echo "<br><br>";
        break;
    case "sousprojet":
        if(isset($idsousprojet)) {
            $sousProjet = SousProjet::first(
                array('conditions' =>
                    array("id_sous_projet = ?", $idsousprojet)
                )
            );
        }
        if($sousProjet !== NULL) {
            switch($connectedProfil->profil->profil->shortlib) {
                case "bei":
                    if(in_array($connectedProfil->profil->id_utilisateur,explode("|",trim($sousProjet->users_in,"|")))) {
                        $connectedProfil->sousprojet();
                    } else {
                        $connectedProfil->ressourceAccessDenied();
                    }
                    break;
                case "cdp":
                    if($sousProjet->projet->id_chef_projet === $connectedProfil->profil->id_utilisateur ) {
                        $connectedProfil->sousprojet();
                    } else {
                        $connectedProfil->ressourceAccessDenied();
                    }
                    break;
                case "vpi":
                    $arr = array();
                    $stm = $db->prepare("select id_nro from nro where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
                    $stm->execute();
                    $nros = $stm->fetchAll();
                    foreach($nros as $nro) {
                        $arr[] = $nro['id_nro'];
                    }
                    if(in_array($sousProjet->projet->id_nro,$arr)) {
                        $connectedProfil->sousprojet();
                    } else {
                        $connectedProfil->ressourceAccessDenied();
                    }
                    break;
                default:
                    $connectedProfil->sousprojet();
                    break;
            }
        } else {
            $connectedProfil->ressourceNotFound();
        }
        echo "<br><br>";
        break;
    case "utilisateur":
        $connectedProfil->utilisateur();
        echo "<br><br>";
        break;
    case "ot":
        if(isset($idsousprojet) && isset($tentree) && in_array($tentree,array("transportaiguillage","transporttirage","distributionaiguillage","distributiontirage"))) {
            $sousProjet = SousProjet::first(
                array('conditions' =>
                    array("id_sous_projet = ?", $idsousprojet)
                )
            );
        }
        if($sousProjet !== NULL) {
            switch($connectedProfil->profil->profil->shortlib) {
                case "bei":
                    if(in_array($connectedProfil->profil->id_utilisateur,explode("|",trim($sousProjet->users_in,"|")))) {
                        $connectedProfil->ot();
                    } else {
                        $connectedProfil->ressourceAccessDenied();
                    }
                    break;
                case "cdp":
                    if($sousProjet->projet->id_chef_projet === $connectedProfil->profil->id_utilisateur ) {
                        $connectedProfil->ot();
                    } else {
                        $connectedProfil->ressourceAccessDenied();
                    }
                    break;
                case "vpi":
                    $arr = array();
                    $stm = $db->prepare("select id_nro from nro where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
                    $stm->execute();
                    $nros = $stm->fetchAll();
                    foreach($nros as $nro) {
                        $arr[] = $nro['id_nro'];
                    }
                    if(in_array($sousProjet->projet->id_nro,$arr)) {
                        $connectedProfil->ot();
                    } else {
                        $connectedProfil->ressourceAccessDenied();
                    }
                    break;
                default:
                    $connectedProfil->ot();
                    break;
            }
        } else {
            $connectedProfil->ressourceNotFound();
        }
        echo "<br><br>";
        break;
    case "pointbloquant":
        if(isset($idchambre)) {
            $ch = Chambre::first(
                array('conditions' =>
                    array("id_chambre = ?", $idchambre)
                )
            );
            if($ch !== NULL) {
                $sousProjet = SousProjet::first(
                    array('conditions' =>
                        array("id_sous_projet = ?", $ch->id_sous_projet)
                    )
                );
            }
        } else {
            if(isset($idot)) {
                $ot = OrdreDeTravail::first(
                    array('conditions' =>
                        array("id_ordre_de_travail = ?", $idot)
                    )
                );
                if($ot !== NULL) {
                    $sousProjet = SousProjet::first(
                        array('conditions' =>
                            array("id_sous_projet = ?", $ot->id_sous_projet)
                        )
                    );
                }
            } else {
                if(isset($idsousprojet) && isset($tentree)) {
                    if(in_array($tentree,array("transportaiguillage","transporttirage","distributionaiguillage","distributiontirage"))) {
                        $sousProjet = SousProjet::first(
                            array('conditions' =>
                                array("id_sous_projet = ?", $idsousprojet)
                            )
                        );
                    }
                }
            }
        }
        if($sousProjet !== NULL) {
            switch($connectedProfil->profil->profil->shortlib) {
                case "bei":
                    if(in_array($connectedProfil->profil->id_utilisateur,explode("|",trim($sousProjet->users_in,"|")))) {
                        $connectedProfil->pointbloquant();
                    } else {
                        $connectedProfil->ressourceAccessDenied();
                    }
                    break;
                case "cdp":
                    if($sousProjet->projet->id_chef_projet === $connectedProfil->profil->id_utilisateur ) {
                        $connectedProfil->pointbloquant();
                    } else {
                        $connectedProfil->ressourceAccessDenied();
                    }
                    break;
                case "vpi":
                    $arr = array();
                    $stm = $db->prepare("select id_nro from nro where id_utilisateur = ".$connectedProfil->profil->id_utilisateur);
                    $stm->execute();
                    $nros = $stm->fetchAll();
                    foreach($nros as $nro) {
                        $arr[] = $nro['id_nro'];
                    }
                    if(in_array($sousProjet->projet->id_nro,$arr)) {
                        $connectedProfil->pointbloquant();
                    } else {
                        $connectedProfil->ressourceAccessDenied();
                    }
                    break;
                default:
                    $connectedProfil->pointbloquant();
                    break;
            }
        } else {
            $connectedProfil->ressourceNotFound();
        }
        echo "<br><br>";
        break;
    case "myot":
        $connectedProfil->myot();
        echo "<br><br>";
        break;
    case "myotplanning":
        $connectedProfil->myotplanning();
        echo "<br><br>";
        break;
    case "entreprise":
        $connectedProfil->entreprise();
        echo "<br><br>";
        break;
    case "mailcreation":
        $connectedProfil->mail();
        echo "<br><br>";
        break;
    case "nro":
        $connectedProfil->nro();
        echo "<br><br>";
        break;
    case "nropci":
        $connectedProfil->nropci();
        echo "<br><br>";
        break;
    case "typeot":
        $connectedProfil->typeot();
        echo "<br><br>";
        break;
}

?>

<div class="modal fade" id="liste_tache_osa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter sous projet</h3>
                </div>
                <div class="block-content">
                    <div class="block">
                        <div class="block-content table-responsive">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <table id="projet_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
                                <thead>
                                <tr>
                                    <th>id Tache</th>
                                    <th>Nom Tache</th>
                                    <th>Statut</th>
                                    <th>Traiter</th>
                                    <th>Affecter</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>id Tache</th>
                                    <th>Nom Tache</th>
                                    <th>Statut</th>
                                    <th>Traiter</th>
                                    <th>Affecter</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="traite_tache_osa" type="button"><i class="fa fa-check"></i> Traiter</button>
                <button class="btn btn-sm btn-primary" id="affecte_tache_osa" type="button"><i class="fa fa-check"></i> Affecter</button>
            </div>
        </div>
    </div>
</div>
