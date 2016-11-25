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
        if(isset($idsousprojet) && isset($tentree) && in_array($tentree,array("transportaiguillage","transporttirage","distributionaiguillage","distributiontirage","transportraccordement","distributionraccordement","transportrecette","distributionrecette"))) {
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
    /*case "pointbloquant":
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
        break;*/
    case "myot":
        $connectedProfil->myot();
        echo "<br><br>";
        break;
    case "myotplanning":
        $connectedProfil->myotplanning();
        echo "<br><br>";
        break;
    case "planning":
        $connectedProfil->planning();
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

<?php if(isset($page) && $page == "sousprojet") {?>
<div class="modal fade" id="liste_tache_osa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" id="fermegestiontache" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Gestion Tâche</h3>
                </div>
                <div class="block-content">
                    <div class="block">
                        <div class="block-content table-responsive">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <table id="tache_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom Tache</th>
                                    <th>Statut</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom Tache</th>
                                    <th>Statut</th>
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
                <button class="btn btn-sm btn-primary" id="cloture_tache_osa" type="button"><i class="fa fa-check"></i> Cloturer</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="blq-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block-header bg-primary">
                <ul class="block-options">
                    <li>
                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Gestion BLQ</h3>
            </div>
            <div class="block-content">
                <div class="block block-themed block-opt-hidden" id="blq_block">
                    <div class="block-header bg-info">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                            </li>
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title">ordres de travail</h3>
                    </div>
                    <div class="block-content">
                        <div class="block" id="blq_block_content">
                            <div class="block-content table-responsive">
                                <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                                <table id="blq_ot_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
                                    <thead>
                                    <tr>
                                        <th>idot</th>
                                        <th>idsp</th>
                                        <th>tentree</th>
                                        <th>type</th>
                                        <th>commentaire</th>
                                        <th>état</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>idot</th>
                                        <th>idsp</th>
                                        <th>tentree</th>
                                        <th>type</th>
                                        <th>commentaire</th>
                                        <th>état</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content">
                <div class="block block-themed block-opt-hidden" id="blq2_block">
                    <div class="block-header bg-info">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                            </li>
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title">Questions</h3>
                    </div>
                    <div class="block-content">
                        <div class="block" id="blq2_block_content">
                            <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">
                                <li class="active">
                                    <a href="#btabs-alt-static-justified-q1"><i class="fa fa-question-circle"></i> Type1</a>
                                </li>
                                <li class="">
                                    <a href="#btabs-alt-static-justified-q2"><i class="fa fa-pencil"></i> Type2</a>
                                </li>
                            </ul>
                            <div class="block-content tab-content">
                                <div class="tab-pane active" id="btabs-alt-static-justified-q1">
                                    <h4 class="font-w300 push-15">Q1</h4>
                                    <p>...</p>
                                </div>
                                <div class="tab-pane" id="btabs-alt-static-justified-q2">
                                    <h4 class="font-w300 push-15">Q2</h4>
                                    <p>...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<script>

    var blq_ot_dt;//traitement blq rabii

    $(document).ready(function() {


        $('#tache_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                $('#tache_table tbody tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#traite_tache_osa').click(function(){

            idligne = (tache_dt.row('.selected').data()!=undefined?tache_dt.row('.selected').data()[0]:0);


            rc2k.osa.ui.tache.traiter({
                idt : idligne
            });
        });

        $('#affecte_tache_osa').click(function(){
            idligne = (tache_dt.row('.selected').data()!=undefined?tache_dt.row('.selected').data()[0]:0);
            rc2k.osa.ui.tache.affecter({
                idt : idligne
            });

        });

        $('#cloture_tache_osa').click(function (){
            rc2k.osa.ws.auth("NjQ1YjM1ZTAzMDVmMTg4YzBjMWMzNTAxY2FmZGI5OTM6Ojk3MGJkNjI3ZjQxNWUwYTEyNzIxMGQyY2VjZjIzMTFm",function(response) {
                console.log(response);
                idligne = (tache_dt.row('.selected').data()!=undefined?tache_dt.row('.selected').data()[0]:0);
                rc2k.osa.ws.tache.cloturer(idligne, function(){console.log(tache_dt.row('.selected'));  tache_dt.draw(false);});
            });

        })

        //traitement blq rabii

        blq_ot_dt = $('#blq_ot_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/ot/ot/ot_liste.php?idsp='+get('idsousprojet')+'&tentree='
            },
            "columns": [
                { "data": "id_ordre_de_travail" },
                { "data": "id_sous_projet" },
                { "data": "type_entree" },
                { "data": "type_ot" },/*lib_type_ordre_travail*/
                { "data": "commentaire" },
                { "data": "lib_etat_ot" },
                { "data": "id_type_ordre_travail" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2,4,6 ], "visible": false, "searchable": false }
            ],
            "order": [[6, 'asc']]
            ,
            "drawCallback": function( /*settings*/ ) {
            }
        } );

        $('#blq_ot_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                blq_ot_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }

        } );

    } );
<?php } ?>
