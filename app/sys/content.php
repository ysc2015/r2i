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
    case "pointbloquant":
        $connectedProfil->pointbloquant();
        echo "<br><br>";
        break;
    /*  if(isset($idchambre)) {
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
    case "pcip":
        $connectedProfil->pcip();
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
    case "avancement":
        $connectedProfil->avancement();
        echo "<br><br>";
        break;
    case "lineaire":
        $connectedProfil->lineaire();//
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
    /*case "nropci":
        $connectedProfil->nropci();
        echo "<br><br>";
        break;*/
    case "typeot":
        $connectedProfil->typeot();
        echo "<br><br>";
        break;
    case "typeequipe":
        $connectedProfil->typeequipe();
        echo "<br><br>";
        break;
    case "wiki":
        $connectedProfil->wiki();
        echo "<br><br>";
        break;
    default : $connectedProfil->ressourceNotFound();break;
}

?>

<?php if(isset($page) && $page == "sousprojet") {?>
    <style>
        .reponse_pbc .ajax-upload-dragdrop {
            display: none;
        }
    </style>
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
                                                <th>ID Createur</th>
                                                <th>Statut</th>
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
                                                <th>ID Createur</th>
                                                <th>Statut</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <button id="add_pbc_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter info</button>
                                        <button id="mod_pbc_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#mod-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier info</button>
                                        <button id="delete_pbc_show" class='btn btn-danger btn-sm' data-toggle="modal" data-target='#delete-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-remove'>&nbsp;</span> Supprimer info</button>
                                        <button id="resolu_pbc_show" class='btn btn-danger btn-sm' data-toggle="modal" data-target='#resolu-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Question résolu</button>
                                        <div id="sp_question_pbc_upload" class="row">
                                            <div class="col-md-6">
                                                <label for="question_pbc_uploader" style="margin-top: 20px;">Attachments Question</label>
                                                <div id="question_pbc_uploader"></div>
                                            </div>
                                            <div class="col-md-6 reponse_pbc">
                                                <label for="reponse_pbc_uploader" style="margin-top: 20px;">Attachments Réponse</label>
                                                <div id="reponse_pbc_uploader"></div>
                                            </div>
                                        </div>
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
                                                <th>ID Createur</th>
                                                <th>Statut</th>
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
                                                <th>ID Createur</th>
                                                <th>Statut</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <button id="add_pbc_show2" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter correction</button>
                                        <button id="mod_pbc_show2" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#mod-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier correction</button>
                                        <button id="delete_pbc_show2" class='btn btn-danger btn-sm' data-toggle="modal" data-target='#delete-correction' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-remove'>&nbsp;</span> Supprimer correction</button>
                                        <button id="resolu_pbc_show2" class='btn btn-danger btn-sm' data-toggle="modal" data-target='#resolu-info' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Correction résolu</button>
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
    <!-- ajouter sous projet Modal -->
    <div class="modal fade" id="show-details-fci" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title" id="details-fci-title">Détails commande fci</h3>
                    </div>
                    <div class="block-content" id="show-details-fci-block">
                        <div class="progress" id="fci-progress">
                            <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">récupération infos commande fci ...</div>
                        </div>
                        <form class="js-validation-bootstrap form-horizontal" id="details_fci_form" style="display: none;">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="fci_statut">Statut</label>
                                    <input class="form-control" type="text" id="fci_statut" name="fci_statut" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="fci_raison">Raison</label>
                                    <input class="form-control" type="text" id="fci_raison" name="fci_raison" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="fci_num_commande_fci">Num commande fci</label>
                                    <input class="form-control" type="text" id="fci_num_commande_fci" name="fci_num_commande_fci" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="fci_etat_commande">Etat commande fci</label>
                                    <input class="form-control" type="text" id="fci_etat_commande" name="fci_etat_commande" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="fci_date_emission">Date émission</label>
                                    <input class="form-control" type="text" id="fci_date_emission" name="fci_date_emission" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="fci_type_commande">Type commande</label>
                                    <input class="form-control" type="text" id="fci_type_commande" name="fci_type_commande" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="fci_type_entite">Type entité</label>
                                    <input class="form-control" type="text" id="fci_type_entite" name="fci_type_entite" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="fci_date_deb_tvx">Date début travaux</label>
                                    <input class="form-control" type="text" id="fci_date_deb_tvx" name="fci_date_deb_tvx" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="fci_date_fin_tvx">Date fin travaux</label>
                                    <input class="form-control" type="text" id="fci_date_fin_tvx" name="fci_date_fin_tvx" disabled>
                                </div>
                            </div>
                            <div class='alert alert-success' id='message_details_fci' role='alert' style="display: none;">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                    <button class="btn btn-sm btn-primary disabled" id="apply_fci_commande" type="button"><i class="fa fa-check"></i> Appliquer à l'étape</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END ajouter sous projet Modal -->
    <div id="delete-blq-dialog-confirm" title="Supprimer cet élément?">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer ?</p>
    </div>
    <div id="resolu-blq-dialog-confirm" title="Question Résolu?">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer ?</p>
    </div>
    <script>

        var statutpbccheckbox = null;
        var idblq = 0;
        var type_info = 0;
        var statutpbc;
        var blq_ot_dt;
        var blq_pbc_dt;
        var blq_pbc_dt2;
        var blq_ot_btns = ["#add_pbc_show", "#add_pbc_show2"];
        var blq_pbc_btns = ["#mod_pbc_show", "#delete_pbc_show"];
        var blq_pbc_btns2 = ["#mod_pbc_show2", "#delete_pbc_show2"];
        var update_info = false;
        var update_info2 = false;
        var type_info = 0;
        var update_correction = false;

        var question_pbc_uploader_options = {
            url: "api/ot/ot/question_pbc_upload_retour.php",
            multiple:false,
            dragDrop:true,
            fileName: "myfile",
            autoSubmit: true,
            showDelete:true,
            showDownload:true,
            allowedTypes: "pdf,xls,xlsx,jpeg",
            onLoad:function(obj)
            {
                if(blq_pbc_dt != undefined && blq_pbc_dt.row('.selected').data() !== undefined) {
                    $.ajax({
                        cache: false,
                        url: "api/ot/ot/load_question_pbc.php",
                        method:"POST",
                        data: {idpbc: blq_pbc_dt.row('.selected').data().id_blq_pbc},
                        dataType: "json",
                        success: function(data)
                        {
                            for(var i=0;i<data.length;i++)
                            {
                                obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"],data[i]["id"]);
                            }
                        }
                    });
                }
            },
            dynamicFormData: function()
            {
                var data ={
                    idpbc: blq_pbc_dt.row('.selected').data().id_blq_pbc
                };
                return data;
            },
            afterUploadAll:function(obj) {
            },
            downloadCallback:function(data,pd)
            {
                var obj;
                var id;
                try {
                    obj = $.parseJSON(data);
                    id = obj[0].id;
                } catch (e) {
                    var arr = (data + '').split("_");
                    id = arr[0];
                }

                location.href="api/file/download.php?id="+id;
            },
            deleteCallback: function (data, pd) {
                var obj;
                var id;
                try {
                    obj = $.parseJSON(data);
                    id = obj[0].id;
                } catch (e) {
                    var arr = (data + '').split("_");
                    id = arr[0];
                }

                $.ajax({
                    method: "POST",
                    url: "api/file/delete.php",
                    data: {
                        id: id
                    }
                }).done(function (message) {
                    console.log(message);
                });

            }
        };
        var reponse_pbc_uploader_options = {
            multiple:false,
            dragDrop:true,
            fileName: "myfile",
            autoSubmit: false,
            showDelete:false,
            showDownload:true,
            onLoad:function(obj)
            {
                if(blq_pbc_dt != undefined && blq_pbc_dt.row('.selected').data() !== undefined) {
                    $.ajax({
                        cache: false,
                        url: "api/ot/ot/load_reponse_pbc.php",
                        method:"POST",
                        data: {idpbc: blq_pbc_dt.row('.selected').data().id_blq_pbc},
                        dataType: "json",
                        success: function(data)
                        {
                            for(var i=0;i<data.length;i++)
                            {
                                obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"],data[i]["id"]);
                            }
                        }
                    });
                }
            },
            downloadCallback:function(data,pd)
            {
                var obj;
                var id;
                try {
                    obj = $.parseJSON(data);
                    id = obj[0].id;
                } catch (e) {
                    var arr = (data + '').split("_");
                    id = arr[0];
                }

                location.href="api/file/download.php?id="+id;
            }
        };
        $(function () {
            // Init page plugins & helpers
            question_pbc_uploader_options = merge_options(defaultUploaderStrLocalisation,question_pbc_uploader_options);
            question_pbc_uploader = $("#question_pbc_uploader").uploadFile(question_pbc_uploader_options);

            reponse_pbc_uploader_options = merge_options(defaultUploaderStrLocalisation,reponse_pbc_uploader_options);
            reponse_pbc_uploader = $("#reponse_pbc_uploader").uploadFile(reponse_pbc_uploader_options);
        });

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
                rc2k.osa.ws.auth(window.token,function(response) {
                    console.log(response);
                    idligne = (tache_dt.row('.selected').data()!=undefined?tache_dt.row('.selected').data()[0]:0);
                    rc2k.osa.ws.tache.cloturer(idligne, function(){console.log(tache_dt.row('.selected').data()[2] = "TERMINEE");  tache_dt.draw(false);});
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
                    { "data": "question_information" },
                    { "data": "nom_utilisateur" },
                    { "data": "statut" }
                ],
                "columnDefs": [
                    { "targets": [ 0,1,2 ], "visible": false, "searchable": false },
                    {
                        "targets": 7,
                        "render": function ( data, type, full, meta ) {
                            return  '<button class="btn btn-info btn-sm view-question disabled">voir question / réponse</button>';
                        }
                    },
                    {
                        "targets": 8,
                        "render": function ( data, type, full, meta ) {
                            return full.nom_utilisateur + ' ' + full.prenom_utilisateur  ;
                        }
                    },
                    {
                        "targets": 9,
                        "render": function ( data, type, full, meta ) {
                            return '<label class="css-input switch switch-sm switch-success"> <input id="'+full.id_blq_pbc+'" class="pbcstatutcheckbox" type="checkbox" value="FALSE" '+(data == 1 ? 'checked=""' : '')+'><span></span></label>'

                        }
                    }

                ],
                "order": [[0, 'desc']]
                ,
                "drawCallback": function( /*settings*/ ) {
                    $(blq_pbc_btns.join(',')).addClass('disabled');
                    update_info = false;
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
                    { "data": "question_information" },
                    { "data": "nom_utilisateur" },
                    { "data": "statut" }
                ],
                "columnDefs": [
                    { "targets": [ 0,1,2 ], "visible": false, "searchable": false },
                    {
                        "targets": 7,
                        "render": function ( data, type, full, meta ) {
                            return  '<button class="btn btn-info btn-sm view-correction disabled">voir information / ajustement</button>';
                        }
                    },
                    {
                        "targets": 8,
                        "render": function ( data, type, full, meta ) {
                            return full.nom_utilisateur + ' ' + full.prenom_utilisateur  ;
                        }
                    },
                    {
                        "targets": 9,
                        "render": function ( data, type, full, meta ) {
                            return '<label class="css-input switch switch-sm switch-success"> <input id="'+full.id_blq_pbc+'" class="pbcstatutcorrectioncheckbox" type="checkbox" value="FALSE" '+(data == 1 ? 'checked=""' : '')+'><span></span></label>'

                        }
                    }
                ],
                "order": [[0, 'desc']]
                ,
                "drawCallback": function( /*settings*/ ) {
                    $(blq_pbc_btns2.join(',')).addClass('disabled');
                    update_info2 = false;
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

            $('#sp_question_pbc_upload').hide();
            $('body').on('change',".pbcstatutcheckbox",function (e){
                e.preventDefault();
                type_info = 1;
                idblq = $( this).attr('id');
                statutpbccheckbox =  this;
                if($(this).is(':checked')){
                    statutpbc = 1;
                }else{
                    statutpbc = 0;
                }
                $("#resolu-blq-dialog-confirm").dialog("open");

            });
            $('body').on('change',".pbcstatutcorrectioncheckbox",function (e){
                e.preventDefault();
                type_info = 2;
                idblq = $( this).attr('id');
                statutpbccheckbox =  this;

                if($(this).is(':checked')){
                    statutpbc = 1;
                }else{
                    statutpbc = 0;
                }
                $("#resolu-blq-dialog-confirm").dialog("open");

            });
            $('body').on('click',"#blq_pbc_table tbody tr",function () {
                if(true) { //TODO check if dt is not empty
                    if ( $(this).hasClass('selected') ) {
                        $(this).removeClass('selected');

                        $(blq_pbc_btns.join(',')).addClass('disabled');
                        //$('.view-question').addClass('disabled');
                        $(this).find('.view-question').addClass('disabled');

                        $('#sp_question_pbc_upload').hide();
                    }
                    else {
                        blq_pbc_dt.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                        $('.view-question').addClass('disabled');

                        $(blq_pbc_btns.join(',')).removeClass('disabled');
                        //$('.view-question').removeClass('disabled');
                        $(this).find('.view-question').removeClass('disabled');

                        question_pbc_uploader.reset();
                        question_pbc_uploader = $("#question_pbc_uploader").uploadFile(question_pbc_uploader_options);

                        reponse_pbc_uploader.reset();
                        reponse_pbc_uploader = $("#reponse_pbc_uploader").uploadFile(reponse_pbc_uploader_options);

                        $('#sp_question_pbc_upload').show();
                    }
                }
            });

            $('body').on('click',"#blq_pbc_table2 tbody tr",function (){
                if(true) { //TODO check if dt is not empty
                    if ( $(this).hasClass('selected') ) {
                        $(this).removeClass('selected');

                        $(blq_pbc_btns2.join(',')).addClass('disabled');
                        $(this).find('.view-correction').addClass('disabled');
                        //$('.view-correction').addClass('disabled');
                    }
                    else {
                        blq_pbc_dt2.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                        $('.view-correction').addClass('disabled');

                        $(blq_pbc_btns2.join(',')).removeClass('disabled');
                        //$('.view-correction').removeClass('disabled');
                        $(this).find('.view-correction').removeClass('disabled');
                    }
                }
            });

            $('body').on('click', '.view-question', function(e) {
                e.stopPropagation();
                console.log("view-question Clicked");
                $('#question-correction-title').html('Question / Réponse');
                $('#label1').html('Question');
                $('#label2').html('Réponse');
                $('#text1').val(blq_pbc_dt.row('.selected').data().question_information);
                $('#text2').val(blq_pbc_dt.row('.selected').data().reponse_ajustement);
                $('#question-correction').modal({backdrop: 'static', keyboard: false});
                $('#question-correction').modal('show');
            });

            $('body').on('click', '.view-correction', function(e) {
                e.stopPropagation();
                console.log("view-correction Clicked");
                $('#question-correction-title').html('Information / Ajustement');
                $('#label1').html('Information');
                $('#label2').html('Ajustement');
                $('#text1').val(blq_pbc_dt2.row('.selected').data().question_information);
                $('#text2').val(blq_pbc_dt2.row('.selected').data().reponse_ajustement);
                $('#question-correction').modal({backdrop: 'static', keyboard: false});
                $('#question-correction').modal('show');
            });

            $('#add_pbc_show').click(function (){
                type_info = 1;
                $("#add_info_form")[0].reset();
                $('#reponse_ajustement_block').hide();
                $('#add-info-title').html('Ajouter Question');
                $('#add-info-type').html('Question <span class="text-danger">*</span>');
            });

            $('#add_pbc_show2').click(function (){
                type_info = 2;
                $("#add_info_form")[0].reset();
                $('#reponse_ajustement_block').show();
                $('#add-info-title').html('Ajouter Information / Ajustement');
                $('#add-info-type').html('Information <span class="text-danger">*</span>');
            });

            $('#save_info').click(function (){
                console.log('save_info ' + type_info);
                $.ajax({
                    method: "POST",
                    url: "api/ot/ot/add_blq.php",
                    dataType: "json",
                    data: {
                        idot : blq_ot_dt.row('.selected').data().id_ordre_de_travail,
                        type : type_info,
                        snake : $('#snake').val(),
                        planche_a3 : $('#planche_a3').val(),
                        chambre_amont : $('#chambre_amont').val(),
                        chambre_aval : $('#chambre_aval').val(),
                        question_information : $('#question_information').val(),
                        reponse_ajustement : $('#reponse_ajustement').val()
                    }
                }).done(function (message) {
                    if(message.error == 0) {
                        switch (type_info) {
                            case 1 :
                                //blq_pbc_dt.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
                                blq_pbc_dt.draw(false);
                                break;
                            case 2 :
                                //blq_pbc_dt2.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=2&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
                                blq_pbc_dt2.draw(false);
                                break;
                            default : break;
                        }
                        $("#add_info_form")[0].reset();
                    }
                    App.showMessage(message,'#message_info_add');
                });
            });

            $('#mod_info').click(function (){
                console.log('mod_info');
                var idblq = 0;
                if(type_info == 1) {
                    idblq = blq_pbc_dt.row('.selected').data().id_blq_pbc;
                } else  if(type_info == 2) {
                    idblq = blq_pbc_dt2.row('.selected').data().id_blq_pbc;
                }
                $.ajax({
                    method: "POST",
                    url: "api/ot/ot/update_blq.php",
                    dataType: "json",
                    data: {
                        idblq : idblq,
                        type : type_info,
                        snake : $('#snake_update').val(),
                        planche_a3 : $('#planche_a3_update').val(),
                        chambre_amont : $('#chambre_amont_update').val(),
                        chambre_aval : $('#chambre_aval_update').val(),
                        question_information : $('#question_information_update').val(),
                        reponse_ajustement : $('#reponse_ajustement_update').val()
                    }
                }).done(function (message) {
                    if(message.error == 0) {
                        switch (type_info) {
                            case 1 :
                                update_info = true;
                                break;
                            case 2 :
                                update_info2 = true;
                                break;
                            default : break;
                        }
                    }
                    App.showMessage(message,'#message_info_mod');
                });
            });

            $('#mod_pbc_show').click(function (){
                update_info = false;
                type_info = 1;
                $('#snake_update').val(blq_pbc_dt.row('.selected').data().snake);
                $('#planche_a3_update').val(blq_pbc_dt.row('.selected').data().planche_a3);
                $('#chambre_amont_update').val(blq_pbc_dt.row('.selected').data().chambre_amont);
                $('#chambre_aval_update').val(blq_pbc_dt.row('.selected').data().chambre_aval);
                $('#question_information_update').val(blq_pbc_dt.row('.selected').data().question_information);
                $('#reponse_ajustement_update').val(blq_pbc_dt.row('.selected').data().reponse_ajustement);

                $('#reponse_ajustement_update_block').hide();
                $('#mod-info-title').html('Modifier Question');
                $('#mod-info-type').html('Question <span class="text-danger">*</span>');
            });

            $('#mod_pbc_show2').click(function (){
                update_info2 = false;
                type_info = 2;
                $('#snake_update').val(blq_pbc_dt2.row('.selected').data().snake);
                $('#planche_a3_update').val(blq_pbc_dt2.row('.selected').data().planche_a3);
                $('#chambre_amont_update').val(blq_pbc_dt2.row('.selected').data().chambre_amont);
                $('#chambre_aval_update').val(blq_pbc_dt2.row('.selected').data().chambre_aval);
                $('#question_information_update').val(blq_pbc_dt2.row('.selected').data().question_information);
                $('#reponse_ajustement_update').val(blq_pbc_dt2.row('.selected').data().reponse_ajustement);

                $('#reponse_ajustement_update_block').show();
                $('#mod-info-title').html('Modifier Information / Ajustement');
                $('#mod-info-type').html('Information <span class="text-danger">*</span>');
            });

            $( "#delete-blq-dialog-confirm" ).dialog({
                appendTo : '#blq-modal',
                autoOpen: false,
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "Oui": function() {
                        var idblq = 0;
                        if(type_info == 1) {
                            idblq = blq_pbc_dt.row('.selected').data().id_blq_pbc;
                        } else  if(type_info == 2) {
                            idblq = blq_pbc_dt2.row('.selected').data().id_blq_pbc;
                        }
                        $.ajax({
                            method: "POST",
                            url: "api/ot/ot/delete_blq.php",
                            dataType: "json",
                            data: {
                                idblq: idblq
                            }
                        }).done(function (message) {
                            if(message.error == 0) {
                                switch (type_info) {
                                    case 1 :
                                        //blq_pbc_dt.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
                                        blq_pbc_dt.draw(false);
                                        break;
                                    case 2 :
                                        //blq_pbc_dt2.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=2&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
                                        blq_pbc_dt2.draw(false);
                                        break;
                                    default : break;
                                }
                            }
                            $( "#delete-blq-dialog-confirm" ).dialog( "close" );
                        });
                    },
                    Non: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
            $( "#resolu-blq-dialog-confirm" ).dialog({
                appendTo : '#blq-modal',
                autoOpen: false,
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "Oui": function() {
                        $.ajax({
                            method: "POST",
                            url: "api/ot/ot/resolu_blq.php",
                            dataType: "json",
                            data: {
                                idblq: idblq,
                                statutpbc: statutpbc
                            }
                        }).done(function (message) {
                            if(message.error == 0) {
                                switch (type_info) {
                                    case 1 :
                                        //blq_pbc_dt.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
                                        blq_pbc_dt.draw(false);
                                        break;
                                    case 2 :
                                        //blq_pbc_dt2.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=2&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
                                        blq_pbc_dt2.draw(false);
                                        break;
                                    default : break;
                                }
                            }
                            $( "#resolu-blq-dialog-confirm" ).dialog( "close" );
                        });
                    },
                    Non: function() {
                        $( this ).dialog( "close" );

                        if($("#"+idblq).is(':checked')){
                            $( "#"+idblq ).prop('checked',false);
                        }else{
                            $( "#"+idblq ).prop('checked',true);
                        }
                    }
                }
            });



            $('#delete_pbc_show').click(function (e){
                            e.preventDefault();
                            type_info = 1;
                            $("#delete-blq-dialog-confirm").dialog("open");
                        });

            $('#delete_pbc_show2').click(function (e){
                e.preventDefault();
                type_info = 2;
                $("#delete-blq-dialog-confirm").dialog("open");
            });

            $('#add-info').on('hidden.bs.modal', function () {
                $('body').addClass('modal-open');
            });

            $('#mod-info').on('hidden.bs.modal', function () {
                $('body').addClass('modal-open');
                if(update_info) {

                    //blq_pbc_dt.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
                    blq_pbc_dt.draw(false);

                } else if(update_info2) {

                    //blq_pbc_dt2.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=2&idot='+(blq_ot_dt.row('.selected').data()!=undefined?blq_ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
                    blq_pbc_dt2.draw(false);
                }
            });

            $('#question-correction').on('hidden.bs.modal', function () {
                $('body').addClass('modal-open');
            });

            //commande structurante js
            $("#apply_fci_commande").click(function(e) {
                e.preventDefault();
                console.log('apply_fci_commande clk ' + tentree_cmd);

                $.ajax({
                    url: "api/sousprojet/reseautransport/set_cmd_trv_from_ws.php",
                    dataType: "json",
                    method: "POST",
                    data: {
                        idsp : get('idsousprojet'),
                        tentree : tentree_cmd,
                        dd : $('#fci_date_deb_tvx').val(),
                        df : $('#fci_date_fin_tvx').val(),
                        de : $('#fci_date_emission').val(),
                        gf : $('#fci_etat_commande').val()
                    }
                }).done(function (msg) {
                    if(App.showMessage(msg,'#message_details_fci')) {

                        switch(msg.rows.form) {

                            case 'transportcmcctr' :
                                $('#cctr_date_depot_cmd').val(msg.rows.de);
                                $('#cctr_date_debut_travaux_ft').val(msg.rows.dd);
                                $('#cctr_date_fin_travaux_ft').val(msg.rows.df);
                                $('#cctr_go_ft').val(msg.rows.gf);
                                break;
                            case 'transportcmdfintravaux' :
                                //$('#cftrvx_date_depot_cmd').val(msg.rows.de);
                                $('#cftrvx_date_debut_travaux_ft').val(msg.rows.dd);
                                $('#cftrvx_date_fin_travaux_ft').val(msg.rows.df);
                                $('#cftrvx_go_ft').val(msg.rows.gf);
                                break;
                            case 'distributioncmdcdi' :
                                $('#dcc_date_depot_cmd').val(msg.rows.de);
                                $('#dcc_date_debut_travaux_ft').val(msg.rows.dd);
                                $('#dcc_date_fin_travaux_ft').val(msg.rows.df);
                                $('#dcc_go_ft').val(msg.rows.gf);
                                break;
                            case 'distributioncmdfintravaux' :
                                //$('#dcftrvx_date_depot_cmd').val(msg.rows.de);
                                $('#dcftrvx_date_debut_travaux_ft').val(msg.rows.dd);
                                $('#dcftrvx_date_fin_travaux_ft').val(msg.rows.df);
                                $('#dcftrvx_go_ft').val(msg.rows.gf);
                                break;

                            default : break;
                        }
                    }

                });
            });

            $('#show-details-fci').on('shown.bs.modal', function () {
                $('#details_fci_form').hide();
                $('#apply_fci_commande').addClass('disabled');
                getCommandeInfos(num_commande_fci);
            });

            $('#show-details-fci').on('hidden.bs.modal', function () {
                $('#fci-progress').show();
                $('#details_fci_form').hide();
            });

            $('body').on('click', 'span.label-info', function(e) {
                e.preventDefault();

                //console.log($(this).closest('.bootstrap-tagsinput').find('input').closest('form').attr('id'));

                $('#details-fci-title').html('Détails commande fci : ' + $(this).text());

                $('#show-details-fci').modal({backdrop: 'static', keyboard: false});

                tentree_cmd = $(this).closest('.bootstrap-tagsinput').find('input').closest('form').attr('id');
                num_commande_fci = $(this).text();
            });

        } );
    </script>
<?php } ?>
<?php if($page == "sousprojet" && ($connectedProfil->profil->profil->shortlib == "adm" || $connectedProfil->profil->profil->shortlib == "pov")) {?>
    <div id="set-as-master-dialog-confirm" title="Définir comme sous projet maitre CTR?">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Tous les sous projets du méme projet y seront liés?</p>
    </div>
    <div id="set-as-master-success-dialog-confirm" title="Info">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Maj réussite !</p>
    </div>
    <div id="set-as-master-error-dialog-confirm" title="Info">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Erreur lors de la Maj !</p>
    </div>
    <div id="unset-master-dialog-confirm" title="Info">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Ce sous projet est déjà maitre ctr, voulez vous désactiver ce maitre ctr ?</p>
    </div>
    <script>
        $(document).ready(function() {
            $( "#set-as-master-dialog-confirm" ).dialog({
                autoOpen: false,
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "Oui": function() {
                        $.ajax({
                            method: "POST",
                            url: "api/projet/projet/set_master_ctr.php",
                            dataType: "json",
                            data: {
                                idsp: get('idsousprojet')
                            }
                        }).done(function (msg) {
                            $( "#set-as-master-dialog-confirm" ).dialog( "close" );

                            if(msg.error==0) {
                                $("#set-as-master-success-dialog-confirm").dialog("open");
                            } else {
                                $("#set-as-master-error-dialog-confirm").dialog("open");
                            }
                        });
                    },
                    Non: function() {
                        $( this ).dialog( "close" );

                    }
                }
            });
            $( "#unset-master-dialog-confirm" ).dialog({
                autoOpen: false,
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "Oui": function() {
                        $.ajax({
                            method: "POST",
                            url: "api/projet/projet/unset_master_ctr.php",
                            dataType: "json",
                            data: {
                                idsp: get('idsousprojet')
                            }
                        }).done(function (msg) {
                            $( "#unset-master-dialog-confirm" ).dialog( "close" );

                            if(msg.error==0) {
                                $("#set-as-master-success-dialog-confirm").dialog("open");
                            } else {
                                $("#set-as-master-error-dialog-confirm").dialog("open");
                            }
                        });
                    },
                    Non: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
            $( "#set-as-master-success-dialog-confirm" ).dialog({
                autoOpen: false,
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                        window.location.reload();
                    }
                }
            });
            $( "#set-as-master-error-dialog-confirm" ).dialog({
                autoOpen: false,
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
            $("#set_as_master").click(function(e) {
                e.preventDefault();
                $("#set-as-master-dialog-confirm").dialog("open");
            });
            $("#unset_master_ctr").click(function(e) {
                e.preventDefault();
                $("#unset-master-dialog-confirm").dialog("open");
            });

        } );
    </script>
<?php } ?>

<!-- ajouter catégorie Modal -->
<div class="modal fade" id="modal-add-cat0" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title" id="wiki-cat-root-add-title">Ajouter catégorie (racine)</h3>
                </div>
                <div class="block-content" id="wiki-cat-root-add-block">
                    <form class="js-validation-bootstrap form-horizontal" id="wiki_add_root_cat_form">
                        <div class="form-group">
                            <div class="col-md-9">
                                <label for="cat_name">Nom</label>
                                <input class="form-control" type="text" id="cat_name" name="cat_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                                <label for="cat_desc">Déscription</label>
                                <textarea class="form-control" id="cat_desc" name="cat_desc" rows="6" placeholder="Description.."></textarea>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_wiki_cat_add_root' role='alert' style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_root_cat" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter catégorie Modal -->

<script>
    //wiki global JS code
    $(document).ready(function() {

        $("#save_root_cat").click(function(e) {
            e.preventDefault();

            $.ajax({
                method: "POST",
                url: "api/wiki/add_root_cat.php",
                dataType: "json",
                data: {
                    nom: $('#cat_name').val(),
                    description: $('#cat_desc').val()
                }
            }).done(function (msg) {
                console.log(msg);
                if(msg.error == 0) {

                    str_pcats='';

                    get_categorie_menu();

                    str_pcats+='<li><a id="show_root_cat_add" href="#" data-toggle="modal" data-target="#modal-add-cat0" data-backdrop="static" data-keyboard="false"><i class="si si-plus"></i><span class="sidebar-mini-hide">Ajouter (Racine)</span></a></li>';
                    //str_pcats+='<li class=""><a href="" id="ajouter_categorie" data-toggle="modal" data-target="#modal-fromleft"><i class="fa fa-plus"></i> Ajouter</a></li>';

                    $('#menu_categorie').html(str_pcats);

                    alert('Catégorie ajoutée !');

                    window.location.reload();
                }

                //App.showMessage(msg,'#message_wiki_cat_add_root', null);

            });
        });

    } );
</script>


