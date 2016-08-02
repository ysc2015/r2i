<?php $sousprojet_daiguillage = SousProjetDistributionAiguillage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));?>
<form class="form-horizontal push-10-t push-10">
    <?php if($sousprojet_daiguillage !== NULL) {?>
        <input type="hidden" id="id_sous_projet_distribution_aiguillage" name="id_sous_projet_distribution_aiguillage" value="<?=$sousprojet_daiguillage->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_distribution_aiguillage_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée distribution aiguillage crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="row">
        <div class="col-sm-12">
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
            <label for="ta_lineaire_reseau"><span class="label label-info">Linéaire de réseau </span></label>
            <div class="form-group">
                <div class="col-xs-6 col-md-3 col-lg-3">
                    <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                    <label for="ta_lineaire_reseau">720FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg" type="number" id="dlineaire1" name="dlineaire1" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->lineaire1:"")?>">
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3">
                    <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                    <label for="ta_lineaire_reseau">432FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg" type="number" id="dlineaire2" name="dlineaire2" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->lineaire2:"")?>">
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3">
                    <!--<label for="ta_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                    <label for="ta_lineaire_reseau">288FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg" type="number" id="dlineaire3" name="dlineaire3" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->lineaire3:"")?>">
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3">
                    <!--<label for="ta_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                    <label for="ta_lineaire_reseau">144FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg" type="number" id="dlineaire4" name="dlineaire4" value="<?=($sousprojet_daiguillage !== NULL?$sousprojet_daiguillage->lineaire4:"")?>">
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
                    <label for="da_duree">Durée <span class="text-danger">*</span></label>
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
                        <option value="" selected="" disabled="">Sélectionnez une valeur</option>
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
                    echo "  <button id=\"id_sous_projet_distribution_aiguillage_create_ot_show\" class=\"btn btn-success\" type=\"button\" data-toggle=\"modal\" data-target=\"#add-ot\" data-backdrop=\"static\" data-keyboard=\"false\">créer ordre de travail</button>";
                }
            }
            ?>
        </div>
    </div>
</form>