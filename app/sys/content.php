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
                /*case "bei":
                    if(in_array($connectedProfil->profil->id_utilisateur,explode("|",trim($sousProjet->users_in,"|")))) {
                        $connectedProfil->sousprojet();
                    } else {
                        $connectedProfil->ressourceAccessDenied();
                    }
                    break;*/
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
                /*case "bei":
                    if(in_array($connectedProfil->profil->id_utilisateur,explode("|",trim($sousProjet->users_in,"|")))) {
                        $connectedProfil->ot();
                    } else {
                        $connectedProfil->ressourceAccessDenied();
                    }
                    break;*/
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
                        <h3 class="block-title">BLQ / PBC</h3>
                    </div>
                    <div class="block-content">
                        <div class="block" id="blq2_block_content">
                            <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">
                                <li class="active">
                                    <a href="#btabs-alt-static-justified-q1"><i class="fa fa-question-circle"></i> Infos complémentaires</a>
                                </li>
                                <li class="">
                                    <a href="#btabs-alt-static-justified-q2"><i class="fa fa-pencil"></i> Corrections</a>
                                </li>
                            </ul>
                            <div class="block-content tab-content">
                                <div class="tab-pane active" id="btabs-alt-static-justified-q1">
                                    <table id="blq_pbc_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>idot</th>
                                            <th>type</th>
                                            <th>snake</th>
                                            <th>planche a3</th>
                                            <th>chambre amont</th>
                                            <th>chambre aval</th>
                                            <th>question</th>
                                            <th>reponse</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>idot</th>
                                            <th>type</th>
                                            <th>snake</th>
                                            <th>planche a3</th>
                                            <th>chambre amont</th>
                                            <th>chambre aval</th>
                                            <th>question</th>
                                            <th>reponse</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <button id="add_pbc_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter info</button>
                                    <button id="mod_pbc_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#mod-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier info</button>
                                    <button id="delete_pbc_show" class='btn btn-danger btn-sm' data-toggle="modal" data-target='#delete-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-remove'>&nbsp;</span> Supprimer info</button>
                                </div>
                                <div class="tab-pane" id="btabs-alt-static-justified-q2">
                                    <table id="blq_pbc_table2" class="table table-bordered table-striped js-dataTable-full" width="100%">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>idot</th>
                                            <th>type</th>
                                            <th>snake</th>
                                            <th>planche a3</th>
                                            <th>chambre amont</th>
                                            <th>chambre aval</th>
                                            <th>information</th>
                                            <th>ajustement</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>idot</th>
                                            <th>type</th>
                                            <th>snake</th>
                                            <th>planche a3</th>
                                            <th>chambre amont</th>
                                            <th>chambre aval</th>
                                            <th>information</th>
                                            <th>ajustement</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <button id="add_pbc_show2" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter correction</button>
                                    <button id="mod_pbc_show2" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#mod-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier correction</button>
                                    <button id="delete_pbc_show2" class='btn btn-danger btn-sm' data-toggle="modal" data-target='#delete-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-remove'>&nbsp;</span> Supprimer correction</button>
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

    var blq_ot_dt;
    var blq_pbc_dt;
    var blq_pbc_dt2;
    var blq_pbc_btns = ["#mod_pbc_show", "#delete_pbc_show"];
    var blq_pbc_btns2 = ["#mod_pbc_show2", "#delete_pbc_show2"];

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

        $(blq_pbc_btns.join(',')).addClass('disabled');
        $(blq_pbc_btns2.join(',')).addClass('disabled');

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
        blq_pbc_dt = $('#blq_pbc_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/ot/ot/ot_blq_pbc_liste.php?idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1)
            },
            "columns": [
                { "data": "id_blq_pbc" },
                { "data": "id_ordre_de_travail" },
                { "data": "type" },
                { "data": "snake" },
                { "data": "planche_a3" },
                { "data": "chambre_amont" },
                { "data": "chambre_aval" },
                { "data": "question_information" },
                { "data": "reponse_ajustement" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2 ], "visible": false, "searchable": false }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
            }
        } );
        blq_pbc_dt2 = $('#blq_pbc_table2').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/ot/ot/ot_blq_pbc_liste.php?idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1)
            },
            "columns": [
                { "data": "id_blq_pbc" },
                { "data": "id_ordre_de_travail" },
                { "data": "type" },
                { "data": "snake" },
                { "data": "planche_a3" },
                { "data": "chambre_amont" },
                { "data": "chambre_aval" },
                { "data": "question_information" },
                { "data": "reponse_ajustement" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2 ], "visible": false, "searchable": false }
            ],
            "order": [[0, 'desc']]
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

        $('#blq_pbc_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                $(blq_pbc_btns.join(',')).addClass('disabled');
            }
            else {
                blq_pbc_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(blq_pbc_btns.join(',')).removeClass('disabled');
            }

        } );

        $('#blq_pbc_table2 tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
                $(blq_pbc_btns2.join(',')).addClass('disabled');
            }
            else {
                blq_pbc_dt2.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(blq_pbc_btns2.join(',')).removeClass('disabled');
            }

        } );

    } );
</script>
<?php } ?>
