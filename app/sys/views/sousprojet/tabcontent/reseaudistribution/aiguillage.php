<?php $sousprojet_daiguillage = SousProjetDistributionAiguillage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));?>
<form class="form-horizontal push-10-t push-10">
    <div class="row">
        <div class="col-sm-12">
            <?php if($sousprojet_daiguillage !== NULL) {?>
                <input type="hidden" id="id_sous_projet_distribution_aiguillage" name="id_sous_projet_distribution_aiguillage" value="<?=$sousprojet_daiguillage->id_sous_projet?>">
            <?php } else {?>
                <div class="row">
                    <div id="id_sous_projet_distribution_aiguillage_alert" class="col-md-3">
                        <span class="label label-warning">Aucune entrée distribution aiguillage crée !</span>
                    </div>
                </div>
            <?php }?>
            <div class="form-group">
                <div class="col-xs-3">
                    <label for="da_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
                    <select class="form-control input-lg" id="da_intervenant_be" name="da_intervenant_be">
                        <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_daiguillage!==NULL && $sousprojet_daiguillage->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-3">
                    <label for="da_plans">Plans <span class="text-danger">*</span></label>
                    <select class="form-control input-lg" id="da_plans" name="da_plans">
                        <option value="" selected="" disabled="">Sélectionnez état plans</option>
                        <?php
                        $results = SelectEtatPlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_plan\" ". ($sousprojet_daiguillage!==NULL && $sousprojet_daiguillage->plans==$result->id_etat_plan ?"selected": "")." >$result->lib_etat_plan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-3">
                    <label for="da_controle_plans">Contrôle des plans <span class="text-danger">*</span></label>
                    <select class="form-control input-lg" id="da_controle_plans" name="da_controle_plans">
                        <option value="" selected="" disabled="">Sélectionnez type controle</option>
                        <?php
                        $results = SelectControlePlan::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_plan\" ". ($sousprojet_daiguillage!==NULL && $sousprojet_daiguillage->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-3">
                    <label for="da_date_transmission_plans">Date Transmission Plans <span class="text-danger">*</span></label>
                    <input class="form-control input-lg" type="date" id="da_date_transmission_plans" name="da_date_transmission_plans" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->date_transmission_plans:"")?>">
                </div>
            </div>
        </div>
    </div>
    <!--<div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-xs-3">
                    <label for="ta_lineaire_reseau">Linéaire de réseau <span class="text-danger">*</span></label>
                </div>
            </div>
        </div>
    </div>-->
    <div class="row">
        <div class="col-sm-12">
            <button id="id_lineaire_distribution_aiguillage_btn" class="btn btn-danger" type="button"><i id="hdfd0454ff" class="fa fa-plus push-5-r"></i> Linéaire de réseau</button>
            <div id="da_lineare_groupe" style="border-left: dashed 1px #000;border-right: dashed 1px #000;border-bottom: dashed 1px #000;margin-top: 5px;padding: 5px;display: none">
                <label><span class="label label-info">Câbles </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="da_lineaire1">câble 288FO <span class="text-danger">*</span></label>
                        <input class="form-control input-lg lineareInput3" type="number" id="da_lineaire1" name="da_lineaire1" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->lineaire1:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="ta_lineaire_reseau">câble 144FO <span class="text-danger">*</span></label>
                        <input class="form-control input-lg lineareInput3" type="number" id="da_lineaire2" name="da_lineaire2" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->lineaire2:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                        <label for="ta_lineaire_reseau">câble 72FO <span class="text-danger">*</span></label>
                        <input class="form-control input-lg lineareInput3" type="number" id="da_lineaire3" name="da_lineaire3" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->lineaire3:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                        <label for="ta_lineaire_reseau">câble 48FO <span class="text-danger">*</span></label>
                        <input class="form-control input-lg lineareInput3" type="number" id="da_lineaire4" name="da_lineaire4" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->lineaire4:"")?>">
                    </div>
                </div>
                <label><span class="label label-warning">Boites </span></label>
                <div class="form-group">
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                        <label for="ta_lineaire_reseau">BPE 288FO <span class="text-danger">*</span></label>
                        <input class="form-control input-lg lineareInput3" type="number" id="da_lineaire5" name="da_lineaire5" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->lineaire5:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                        <label for="ta_lineaire_reseau">BPE 144FO <span class="text-danger">*</span></label>
                        <input class="form-control input-lg lineareInput3" type="number" id="da_lineaire6" name="da_lineaire6" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->lineaire6:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                        <label for="ta_lineaire_reseau">BPE 72FO <span class="text-danger">*</span></label>
                        <input class="form-control input-lg lineareInput3" type="number" id="da_lineaire7" name="da_lineaire7" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->lineaire7:"")?>">
                    </div>
                    <div class="col-md-3">
                        <!--<label for="ta_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                        <label for="ta_lineaire_reseau">BPE 48FO <span class="text-danger">*</span></label>
                        <input class="form-control input-lg lineareInput3" type="number" id="da_lineaire8" name="da_lineaire8" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->lineaire8:"")?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-xs-3">
                    <label for="da_entreprise">Entreprise <span class="text-danger">*</span></label>
                    <select class="form-control input-lg" id="da_entreprise" name="da_entreprise">
                        <option value="" selected="" disabled="">Sélectionnez une entreprise</option>
                        <?php
                        $results = SelectEntreprise::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_entreprise\" ". ($sousprojet_daiguillage!==NULL && $sousprojet_daiguillage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->lib_entreprise</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-3">
                    <label for="da_date_aiguillage">Date de début d’aiguillage <span class="text-danger">*</span></label>
                    <input class="form-control input-lg" type="date" id="da_date_aiguillage" name="da_date_aiguillage" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->date_aiguillage:"")?>">
                </div>
                <div class="col-xs-3">
                    <label for="da_duree">Durée(jours) <span class="text-danger">*</span></label>
                    <input class="form-control input-lg" type="number" id="da_duree" name="da_duree" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->duree:"")?>">
                </div>
                <div class="col-xs-3">
                    <label for="da_controle_demarrage_effectif">Contrôle démarrage effectif <span class="text-danger">*</span></label>
                    <select class="form-control input-lg" id="da_controle_demarrage_effectif" name="da_controle_demarrage_effectif">
                        <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectControleDemarrageEffectif::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_controle_demarrage_effectif\" ". ($sousprojet_daiguillage!==NULL && $sousprojet_daiguillage->controle_demarrage_effectif==$result->id_controle_demarrage_effectif ?"selected": "")." >$result->lib_controle_demarrage_effectif</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-xs-3">
                    <label for="da_date_retour">Date Retour <span class="text-danger">*</span></label>
                    <input class="form-control input-lg" type="date" id="da_date_retour" name="da_date_retour" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->date_retour:"")?>">
                </div>
                <div class="col-xs-3">
                    <label for="da_etat_retour">Etat Retour <span class="text-danger">*</span></label>
                    <select class="form-control input-lg" id="da_etat_retour" name="da_etat_retour">
                        <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectEtatRetour::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_etat_retour\" ". ($sousprojet_daiguillage!==NULL && $sousprojet_daiguillage->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-xs-3">
                    <label for="da_ok">OK <span class="text-danger">*</span></label>
                    <select class="form-control input-lg" id="da_ok" name="da_ok">
                        <option value="" selected="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousprojet_daiguillage!==NULL && $sousprojet_daiguillage->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-success" id="message_distribution_aiguillage" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-xs-12">
            <button id="id_sous_projet_distribution_aiguillage_btn" class="btn btn-primary" type="button"><i class="fa fa-check push-5-r"></i> Enregistrer</button>
            <?php
            if($sousprojet_daiguillage!==NULL) {
                $ot = OrdreDeTravail::first(
                    array('conditions' =>
                        array("id_entree = ? AND type_entree = ?", $sousprojet_daiguillage->id_sous_projet_distribution_aiguillage,"distribution_aiguillage")
                    )
                );
                if($ot !== NULL) {

                    echo "  <a href=\"?page=ot&idot=$ot->id_ordre_de_travail&idsousprojet=$idsousprojet\" class=\"btn btn-info\">ouvrir ordre de travail</a>";
                } else {
                    echo "  <button id=\"id_sous_projet_distribution_aiguillage_create_ot_show\" class=\"btn btn-info\" type=\"button\" data-toggle=\"modal\" data-target=\"#add-ot\" data-backdrop=\"static\" data-keyboard=\"false\">créer ordre de travail</button>";
                }
            }
            ?>
        </div>
    </div>
</form>