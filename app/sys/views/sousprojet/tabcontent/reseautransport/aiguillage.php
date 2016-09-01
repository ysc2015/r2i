<?php $sousprojet_taiguillage = SousProjetTransportAiguillage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));?>
<form class="form-horizontal push-10-t push-10" id="transport_aiguillage_form" name="transport_aiguillage_form">
    <div class="row items-push">
        <?php if($sousprojet_taiguillage !== NULL) {?>
            <input type="hidden" id="id_sous_projet_transport_aiguillage" name="id_sous_projet_transport_aiguillage" value="<?=$sousprojet_taiguillage->id_sous_projet?>">
        <?php } else {?>
            <div class="row">
                <div id="id_sous_projet_transport_aiguillage_alert" class="col-md-3">
                    <span class="label label-warning">Aucune entrée transport aiguillage crée !</span>
                </div>
            </div>
        <?php }?>
        <div class="form-group">
            <div class="col-md-3">
                <label for="ta_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
                <select class="form-control " id="ta_intervenant_be" name="ta_intervenant_be">
                    <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->intervenant_be==$result->id_utilisateur ?"selected": "")." >".strtoupper($result->prenom_utilisateur." ".$result->nom_utilisateur)."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="ta_plans">Plans <span class="text-danger">*</span></label>
                <select class="form-control " id="ta_plans" name="ta_plans">
                    <option value="" selected="" disabled="">Sélectionnez état plans</option>
                    <?php
                    $results = SelectEtatPlan::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_etat_plan\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->plans==$result->id_etat_plan ?"selected": "")." >$result->lib_etat_plan</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="ta_controle_plans">Contrôle des plans <span class="text-danger">*</span></label>
                <select class="form-control " id="ta_controle_plans" name="ta_controle_plans">
                    <option value="" selected="" disabled="">Sélectionnez type controle</option>
                    <?php
                    $results = SelectControlePlan::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_controle_plan\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="ta_date_transmission_plans">Date Transmission Plans <span class="text-danger">*</span></label>
                <input class="form-control " type="date" id="ta_date_transmission_plans" name="ta_date_transmission_plans" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->date_transmission_plans:"")?>">
            </div>
        </div>
    </div>
    <div class="row items-push">
        <button id="id_lineaire_transport_aiguillage_btn" class="btn btn-danger" type="button"><i id="hdf0454ff" class="fa fa-plus push-5-r"></i> Linéaire de réseau</button>
        <div id="lineare_groupe" style="border-left: dashed 1px #000;border-right: dashed 1px #000;border-bottom: dashed 1px #000;margin-top: 5px;padding: 5px;display: none">
            <label><span class="label label-info">Câbles </span></label>
            <div class="form-group">
                <div class="col-md-3">
                    <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                    <label for="ta_lineaire1">câble 720FO <span class="text-danger">*</span></label>
                    <input class="form-control  lineareInput" type="number" id="ta_lineaire1" name="ta_lineaire1" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->lineaire1:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                    <label for="ta_lineaire_reseau">câble 432FO <span class="text-danger">*</span></label>
                    <input class="form-control  lineareInput" type="number" id="ta_lineaire2" name="ta_lineaire2" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->lineaire2:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="ta_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                    <label for="ta_lineaire_reseau">câble 288FO <span class="text-danger">*</span></label>
                    <input class="form-control  lineareInput" type="number" id="ta_lineaire3" name="ta_lineaire3" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->lineaire3:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="ta_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                    <label for="ta_lineaire_reseau">câble 144FO <span class="text-danger">*</span></label>
                    <input class="form-control  lineareInput" type="number" id="ta_lineaire4" name="ta_lineaire4" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->lineaire4:"")?>">
                </div>
            </div>
            <label><span class="label label-warning">Boites </span></label>
            <div class="form-group">
                <div class="col-md-3">
                    <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                    <label for="ta_lineaire_reseau">BPE 720FO <span class="text-danger">*</span></label>
                    <input class="form-control  lineareInput" type="number" id="ta_lineaire5" name="ta_lineaire5" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->lineaire5:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                    <label for="ta_lineaire_reseau">BPE 432FO <span class="text-danger">*</span></label>
                    <input class="form-control  lineareInput" type="number" id="ta_lineaire6" name="ta_lineaire6" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->lineaire6:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="ta_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                    <label for="ta_lineaire_reseau">BPE 288FO <span class="text-danger">*</span></label>
                    <input class="form-control  lineareInput" type="number" id="ta_lineaire7" name="ta_lineaire7" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->lineaire7:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="ta_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                    <label for="ta_lineaire_reseau">BPE 144FO <span class="text-danger">*</span></label>
                    <input class="form-control  lineareInput" type="number" id="ta_lineaire8" name="ta_lineaire8" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->lineaire8:"")?>">
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-4">
                <label for="ta_date_aiguillage">Date de début d’aiguillage <span class="text-danger">*</span></label>
                <input class="form-control " type="date" id="ta_date_aiguillage" name="ta_date_aiguillage" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->date_aiguillage:"")?>">
            </div>
            <div class="col-md-4">
                <label for="ta_date_ret_prevue">Date prévisionnelle de fin d’aiguillage <span class="text-danger">*</span></label>
                <input class="form-control " type="date" id="ta_date_ret_prevue" name="ta_date_ret_prevue" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->date_ret_prevue:"")?>">
            </div>
            <div class="col-md-4">
                <label for="ta_duree">Durée(jours) <span class="text-danger">*</span></label>
                <input readonly class="form-control " type="text" id="ta_duree" name="ta_duree" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->duree:"")?>">
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-3">
                <label for="ta_id_entreprise">Entreprise <span class="text-danger">*</span></label>
                <select class="form-control " id="ta_id_entreprise" name="ta_id_entreprise">
                    <option value="" selected="" disabled="">Sélectionnez une entreprise</option>
                    <?php
                    $results = SelectEntreprise::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_entreprise\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->lib_entreprise</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="ta_controle_demarrage_effectif">Contrôle démarrage effectif <span class="text-danger">*</span></label>
                <select class="form-control " id="ta_controle_demarrage_effectif" name="ta_controle_demarrage_effectif">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectControleDemarrageEffectif::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_controle_demarrage_effectif\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->controle_demarrage_effectif==$result->id_controle_demarrage_effectif ?"selected": "")." >$result->lib_controle_demarrage_effectif</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="ta_date_retour">Date Retour <span class="text-danger">*</span></label>
                <input class="form-control " type="date" id="ta_date_retour" name="ta_date_retour" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->date_retour:"")?>">
            </div>
            <div class="col-md-3">
                <label for="ta_etat_retour">Etat Retour <span class="text-danger">*</span></label>
                <select class="form-control " id="ta_etat_retour" name="ta_etat_retour">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectEtatRetour::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_etat_retour\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-4">
                <label for="ta_lien_plans">Lien vers les plans <span class="text-danger">*</span></label>
                <textarea class="form-control" id="ta_lien_plans" name="ta_lien_plans" rows="6" placeholder="Collez lien ici.."><?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->lien_plans:"")?></textarea>
            </div>
            <div class="col-md-4">
                <label for="ta_retour_presta">Retour presta <span class="text-danger">*</span></label>
                <textarea class="form-control" id="ta_retour_presta" name="ta_retour_presta" rows="6" placeholder="Collez lien ici.."><?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->retour_presta:"")?></textarea>
            </div>
            <div class="col-md-4">
                <label for="ta_ok">OK <span class="text-danger">*</span></label>
                <select class="form-control" id="ta_ok" name="ta_ok">
                    <option value="" selected="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectOk::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_ok\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-6">
                <div class="row" style="padding-left: 10px;">
                    <label for="ta_fileuploader_chambre">Fichier(s) chambres</label>
                    <div id="ta_fileuploader_chambre"></div>
                </div>
                <div class="row" id="ta_chambre_files" style="padding-left: 10px;">
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-success" id="message_transport_aiguillage" role="alert" style="display: none;"></div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-xs-12">
                <button id="id_sous_projet_transport_aiguillage_btn" class="btn btn-primary" type="button"><i class="fa fa-check push-5-r"></i> Enregistrer</button>
                <?php
                if($sousprojet_taiguillage!==NULL) {
                    $ot = OrdreDeTravail::first(
                        array('conditions' =>
                            array("id_entree = ? AND type_entree = ?", $sousprojet_taiguillage->id_sous_projet_transport_aiguillage,"transport_aiguillage")
                        )
                    );
                    if($ot !== NULL) {

                        echo "  <a href=\"?page=ot&idot=$ot->id_ordre_de_travail&idsousprojet=$idsousprojet\" class=\"btn btn-info\">ouvrir ordre de travail</a>";
                    } else {
                        echo "  <button id=\"id_sous_projet_transport_aiguillage_create_ot_show\" class=\"btn btn-info\" type=\"button\" data-toggle=\"modal\" data-target=\"#add-ot\" data-backdrop=\"static\" data-keyboard=\"false\">Créer ordre de travail</button>";
                    }
                }
                ?>
                <button id="transport_aiguillage_osa_btn" class="btn btn-warning" type="button"><i class="fa fa-tasks push-5-r"></i> Taches OSA</button>
            </div>
        </div>
    </div>
</form>