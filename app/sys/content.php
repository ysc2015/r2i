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
<!--Gestion BLQ modal-->
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
                                            <th>question / reponse</th>
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
                                            <th>question / reponse</th>
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
                                            <th>information / ajustement</th>
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
                                            <th>information / ajustement</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <button id="add_pbc_show2" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter correction</button>
                                    <button id="mod_pbc_show2" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#mod-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier correction</button>
                                    <button id="delete_pbc_show2" class='btn btn-danger btn-sm' data-toggle="modal" data-target='#delete-correction' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-remove'>&nbsp;</span> Supprimer correction</button>
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
<!--end Gestion BLQ modal-->
<!-- ajouter info/question Modal -->
<div class="modal fade" id="add-info" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title" id="add-info-title"></h3>
                    </div>
                    <div class="block-content">
                        <form class="js-validation-bootstrap form-horizontal" id="add_info_form">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="snake">Snake <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="snake" name="snake">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="planche_a3">Planche A3 <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="planche_a3" name="planche_a3">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="chambre_amont">Chambre Amont <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="chambre_amont" name="chambre_amont">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="chambre_aval">Chambre Aval <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="chambre_aval" name="chambre_aval">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="question_information" id="add-info-type"></label>
                                    <textarea class="form-control" id="question_information" name="question_information" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="form-group" id="reponse_ajustement_block">
                                <div class="col-md-12">
                                    <label for="reponse_ajustement">Ajustement <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="reponse_ajustement" name="reponse_ajustement" rows="6"></textarea>
                                </div>
                            </div>
                            <div class='alert alert-success' id='message_info_add' role='alert' style="display: none;">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary" id="save_info" type="button"><i class="fa fa-check"></i> Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
<!-- END ajouter info/question Modal -->
<!-- modifier info/question Modal -->
<div class="modal fade" id="mod-info" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title" id="mod-info-title"></h3>
                    </div>
                    <div class="block-content">
                        <form class="js-validation-bootstrap form-horizontal" id="mod_info_form">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="snake_update">Snake <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="snake_update" name="snake_update">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="planche_a3_update">Planche A3 <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="planche_a3_update" name="planche_a3_update">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="chambre_amont_update">Chambre Amont <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="chambre_amont_update" name="chambre_amont_update">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="chambre_aval_update">Chambre Aval <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="chambre_aval_update" name="chambre_aval_update">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="question_information_update" id="mod-info-type"></label>
                                    <textarea class="form-control" id="question_information_update" name="question_information_update" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="form-group" id="reponse_ajustement_update_block">
                                <div class="col-md-12">
                                    <label for="reponse_ajustement_update" id="mod-info-type">Ajustement <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="reponse_ajustement_update" name="reponse_ajustement_update" rows="6"></textarea>
                                </div>
                            </div>
                            <div class='alert alert-success' id='message_info_mod' role='alert' style="display: none;">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary" id="mod_info" type="button"><i class="fa fa-check"></i> Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
<!-- END modifier info/question Modal -->
<!-- voir question/correction Modal -->
<div class="modal fade" id="question-correction" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title" id="question-correction-title"></h3>
                    </div>
                    <div class="block-content">
                        <form class="js-validation-bootstrap form-horizontal" id="question_correction_form">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="text1" id="label1"></label>
                                    <textarea readonly class="form-control" id="text1" name="text1" rows="6"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="text2" id="label2"></label>
                                    <textarea readonly class="form-control" id="text2" name="text2" rows="6"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
<!-- END voir question/correction Modal -->
<script>

    var blq_ot_dt;
    var blq_pbc_dt;
    var blq_pbc_dt2;
    var blq_ot_btns = ["#add_pbc_show", "#add_pbc_show2"];
    var blq_pbc_btns = ["#mod_pbc_show", "#delete_pbc_show"];
    var blq_pbc_btns2 = ["#mod_pbc_show2", "#delete_pbc_show2"];
    var update_info = false;
    var update_correction = false;

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

        });

        //traitement blq rabii

        $(blq_ot_btns.join(',')).addClass('disabled');
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
                $(blq_ot_btns.join(',')).addClass('disabled');
                blq_pbc_dt.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
                blq_pbc_dt2.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=2&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
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
                "url": 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1)
            },
            "columns": [
                { "data": "id_blq_pbc" },
                { "data": "id_ordre_de_travail" },
                { "data": "type" },
                { "data": "snake" },
                { "data": "planche_a3" },
                { "data": "chambre_amont" },
                { "data": "chambre_aval" },
                { "data": "question_information" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2 ], "visible": false, "searchable": false },
                {
                    "targets": 7,
                    "render": function ( data, type, full, meta ) {
                        return  '<button class="btn btn-info btn-sm view-question disabled">voir question / réponse</button>';
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
                $(blq_pbc_btns.join(',')).addClass('disabled');
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
                "url": 'api/ot/ot/ot_blq_pbc_liste.php?type=2&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1)
            },
            "columns": [
                { "data": "id_blq_pbc" },
                { "data": "id_ordre_de_travail" },
                { "data": "type" },
                { "data": "snake" },
                { "data": "planche_a3" },
                { "data": "chambre_amont" },
                { "data": "chambre_aval" },
                { "data": "question_information" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2 ], "visible": false, "searchable": false },
                {
                    "targets": 7,
                    "render": function ( data, type, full, meta ) {
                        return  '<button class="btn btn-info btn-sm view-correction disabled">voir information / ajustement</button>';
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
                $(blq_pbc_btns2.join(',')).addClass('disabled');
            }
        } );

        $('#blq_ot_table tbody').on( 'click', 'tr', function () {
            if(true) { //TODO check if dt is not empty
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                    $(blq_ot_btns.join(',')).addClass('disabled');
                }
                else {
                    blq_ot_dt.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $(blq_ot_btns.join(',')).removeClass('disabled');
                    console.log(blq_ot_dt.row('.selected').data().id_ordre_de_travail);
                }

                blq_pbc_dt.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
                blq_pbc_dt2.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=2&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
            }

        } );

        $('body').on('click',"#blq_pbc_table tbody tr",function (){
            if(true) { //TODO check if dt is not empty
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');

                    $(blq_pbc_btns.join(',')).addClass('disabled');
                    $('.view-question').addClass('disabled');
                }
                else {
                    blq_pbc_dt.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');

                    $(blq_pbc_btns.join(',')).removeClass('disabled');
                    $('.view-question').removeClass('disabled');
                }
            }
        });

        $('body').on('click',"#blq_pbc_table2 tbody tr",function (){
            if(true) { //TODO check if dt is not empty
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');

                    $(blq_pbc_btns2.join(',')).addClass('disabled');
                    $('.view-correction').addClass('disabled');
                }
                else {
                    blq_pbc_dt2.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');

                    $(blq_pbc_btns2.join(',')).removeClass('disabled');
                    $('.view-correction').removeClass('disabled');
                }
            }
        });

        $('body').on('click', '.view-question', function(e) {
            e.stopPropagation();
            console.log("view-question Clicked");
            $('#question-correction-title').html('Question / Réponse');
            $('#label1').html('Question');
            $('#label2').html('Réponse');
            $('#text1').html(blq_pbc_dt.row('.selected').data().question_information);
            $('#text2').html(blq_pbc_dt.row('.selected').data().reponse_ajustement);
            $('#question-correction').modal({backdrop: 'static', keyboard: false});
            $('#question-correction').modal('show');
        });

        $('body').on('click', '.view-correction', function(e) {
            e.stopPropagation();
            console.log("view-correction Clicked");
            $('#question-correction-title').html('Information / Ajustement');
            $('#label1').html('Information');
            $('#label2').html('Ajustement');
            $('#text1').html(blq_pbc_dt2.row('.selected').data().question_information);
            $('#text2').html(blq_pbc_dt2.row('.selected').data().reponse_ajustement);
            $('#question-correction').modal({backdrop: 'static', keyboard: false});
            $('#question-correction').modal('show');
        });

        $('#add_pbc_show').click(function (){
            $("#add_info_form")[0].reset();
            $('#reponse_ajustement_block').hide();
            $('#add-info-title').html('Ajouter Question');
            $('#add-info-type').html('Question <span class="text-danger">*</span>');
        });

        $('#add_pbc_show2').click(function (){
            $("#add_info_form")[0].reset();
            $('#reponse_ajustement_block').show();
            $('#add-info-title').html('Ajouter Information / Ajustement');
            $('#add-info-type').html('Information <span class="text-danger">*</span>');
        });

        $('#save_info').click(function (){
            console.log('save_info');
        });

        $('#mod_info').click(function (){
            console.log('mod_info');
        });

        $('#mod_pbc_show').click(function (){
            update_info = false;
            $('#reponse_ajustement_update_block').hide();
            $('#mod-info-title').html('Modifier Question');
            $('#mod-info-type').html('Question <span class="text-danger">*</span>');
        });

        $('#mod_pbc_show2').click(function (){
            update_info = false;
            $('#reponse_ajustement_update_block').show();
            $('#mod-info-title').html('Modifier Information / Ajustement');
            $('#mod-info-type').html('Information <span class="text-danger">*</span>');
        });

        $('#delete_pbc_show').click(function (){
            console.log('delete_pbc_show');
        });

        $('#add-info').on('hidden.bs.modal', function () {
            $('body').addClass('modal-open');
            /*if(redraw_pblq) {
                console.log('hidden.bs.modal redraw');
                pblq_dt.ajax.url( 'api/pointbloquant/pointbloquant/pblq_liste.php?idchambre='+(chambre_ot_dt.row('.selected').data()!==undefined?chambre_ot_dt.row('.selected').data().id_chambre:0) ).load();
            }*/
        });

        $('#mod-info').on('hidden.bs.modal', function () {
            $('body').addClass('modal-open');
            /*if(redraw_pblq) {
             console.log('hidden.bs.modal redraw');
             pblq_dt.ajax.url( 'api/pointbloquant/pointbloquant/pblq_liste.php?idchambre='+(chambre_ot_dt.row('.selected').data()!==undefined?chambre_ot_dt.row('.selected').data().id_chambre:0) ).load();
             }*/
        });

        $('#question-correction').on('hidden.bs.modal', function () {
            $('body').addClass('modal-open');
        });

    } );
</script>
<?php } ?>
