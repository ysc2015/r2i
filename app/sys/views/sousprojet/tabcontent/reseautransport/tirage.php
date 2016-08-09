<?php $sousprojet_ttirage = SousProjetTransportTirage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));?>
<form class="form-horizontal push-10-t push-10">
    <?php if($sousprojet_ttirage !== NULL) {?>
        <input type="hidden" id="id_sous_projet_transport_tirage" name="id_sous_projet_transport_tirage" value="<?=$sousprojet_ttirage->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_transport_tirage_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée transport tirage crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-3">
                <label for="tt_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tt_intervenant_be" name="tt_intervenant_be">
                    <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->intervenant_be==$result->id_utilisateur ?"selected": "")." >".strtoupper($result->prenom_utilisateur." ".$result->nom_utilisateur)."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tt_plans">Plans <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tt_plans" name="tt_plans">
                    <option value="" selected="" disabled="">Sélectionnez état plans</option>
                    <?php
                    $results = SelectEtatPlan::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_etat_plan\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->plans==$result->id_etat_plan ?"selected": "")." >$result->lib_etat_plan</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tt_controle_plans">Contrôle des plans <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tt_controle_plans" name="tt_controle_plans">
                    <option value="" selected="" disabled="">Sélectionnez type controle</option>
                    <?php
                    $results = SelectControlePlan::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_controle_plan\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tt_date_transmission_plans">Date Transmission Plans <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="date" id="tt_date_transmission_plans" name="tt_date_transmission_plans" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->date_transmission_plans:"")?>">
            </div>
        </div>
    </div>
    <!--<div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-xs-3">
                    <label for="tt_lineaire_reseau">Linéaire de réseau <span class="text-danger">*</span></label>
                </div>
            </div>
        </div>
    </div>-->
    <div class="row items-push">
        <button id="id_lineaire_transport_tirage_btn" class="btn btn-danger" type="button"><i id="hdf04l54ff" class="fa fa-plus push-5-r"></i> Linéaire de réseau</button>
        <div id="tt_lineare_groupe" style="border-left: dashed 1px #000;border-right: dashed 1px #000;border-bottom: dashed 1px #000;margin-top: 5px;padding: 5px;display: none">
            <label><span class="label label-info">Câbles </span></label>
            <div class="form-group">
                <div class="col-md-3">
                    <!--<label for="tt_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                    <label for="tt_lineaire1">câble 720FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput2" type="number" id="tt_lineaire1" name="tt_lineaire1" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->lineaire1:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="tt_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                    <label for="tt_lineaire_reseau">câble 432FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput2" type="number" id="tt_lineaire2" name="tt_lineaire2" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->lineaire2:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="tt_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                    <label for="tt_lineaire_reseau">câble 288FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput2" type="number" id="tt_lineaire3" name="tt_lineaire3" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->lineaire3:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="tt_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                    <label for="tt_lineaire_reseau">câble 144FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput2" type="number" id="tt_lineaire4" name="tt_lineaire4" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->lineaire4:"")?>">
                </div>
            </div>
            <label><span class="label label-warning">Boites </span></label>
            <div class="form-group">
                <div class="col-md-3">
                    <!--<label for="tt_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                    <label for="tt_lineaire_reseau">BPE 720FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput2" type="number" id="tt_lineaire5" name="tt_lineaire1" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->lineaire1:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="tt_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                    <label for="tt_lineaire_reseau">BPE 432FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput2" type="number" id="tt_lineaire6" name="tt_lineaire2" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->lineaire2:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="tt_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                    <label for="tt_lineaire_reseau">BPE 288FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput2" type="number" id="tt_lineaire7" name="tt_lineaire3" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->lineaire3:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="tt_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                    <label for="tt_lineaire_reseau">BPE 144FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput2" type="number" id="tt_lineaire8" name="tt_lineaire4" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->lineaire4:"")?>">
                </div>
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-4">
                <label for="tt_date_tirage">Date de début tirage <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="date" id="tt_date_tirage" name="tt_date_tirage" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->date_tirage:"")?>">
            </div>
            <div class="col-md-4">
                <label for="tt_date_ret_prevue">Date prévisionnelle de fin tirage <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="date" id="tt_date_ret_prevue" name="tt_date_ret_prevue" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->date_ret_prevue:"")?>">
            </div>
            <div class="col-md-4">
                <label for="tt_duree">Durée(jours) <span class="text-danger">*</span></label>
                <input readonly class="form-control input-lg" type="text" id="tt_duree" name="tt_duree" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->duree:"")?>">
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-3">
                <label for="tt_entreprise">Entreprise <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tt_entreprise" name="tt_entreprise">
                    <option value="" selected="" disabled="">Sélectionnez une entreprise</option>
                    <?php
                    $results = SelectEntreprise::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_entreprise\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->lib_entreprise</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tt_controle_demarrage_effectif">Contrôle démarrage effectif <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tt_controle_demarrage_effectif" name="tt_controle_demarrage_effectif">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectControleDemarrageEffectif::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_controle_demarrage_effectif\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->controle_demarrage_effectif==$result->id_controle_demarrage_effectif ?"selected": "")." >$result->lib_controle_demarrage_effectif</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tt_date_retour">Date Retour <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="date" id="tt_date_retour" name="tt_date_retour" value="<?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->date_retour:"")?>">
            </div>
            <div class="col-md-3">
                <label for="tt_etat_retour">Etat Retour <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tt_etat_retour" name="tt_etat_retour">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectEtatRetour::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_etat_retour\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-4">
                <label for="tt_lien_plans">Lien vers les plans <span class="text-danger">*</span></label>
                <textarea class="form-control" id="tt_lien_plans" name="tt_lien_plans" rows="6" placeholder="Collez lien ici.."><?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->lien_plans:"")?></textarea>
            </div>
            <div class="col-md-4">
                <label for="tt_retour_presta">Retour presta <span class="text-danger">*</span></label>
                <textarea class="form-control" id="tt_retour_presta" name="tt_retour_presta" rows="6" placeholder="Collez lien ici.."><?=($sousprojet_ttirage !== NULL?$sousprojet_ttirage->retour_presta:"")?></textarea>
            </div>
            <div class="col-md-4">
                <label for="tt_ok">OK <span class="text-danger">*</span></label>
                <select class="form-control" id="tt_ok" name="tt_ok">
                    <option value="" selected="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectOk::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_ok\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="alert alert-success" id="message_transport_tirage" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-xs-12">
            <button id="id_sous_projet_transport_tirage_btn" class="btn btn-primary" type="button"><i class="fa fa-check push-5-r"></i> Enregistrer</button>
            <?php
            if($sousprojet_ttirage!==NULL) {
                $ot = OrdreDeTravail::first(
                    array('conditions' =>
                        array("id_entree = ? AND type_entree = ?", $sousprojet_ttirage->id_sous_projet_transport_tirage,"transport_tirage")
                    )
                );
                if($ot !== NULL) {

                    echo "  <a href=\"?page=ot&idot=$ot->id_ordre_de_travail&idsousprojet=$idsousprojet\" class=\"btn btn-info\">ouvrir ordre de travail</a>";
                } else {
                    echo "  <button id=\"id_sous_projet_transport_tirage_create_ot_show\" class=\"btn btn-warning\" type=\"button\" data-toggle=\"modal\" data-target=\"#add-ot\" data-backdrop=\"static\" data-keyboard=\"false\">Créer ordre de travail</button>";
                }
            }
            ?>
            <button id="transport_tirage_osa_btn" class="btn btn-warning" type="button"><i class="fa fa-tasks push-5-r"></i> Taches OSA</button>
        </div>
    </div>
</form>
