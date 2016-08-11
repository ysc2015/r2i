<?php $sousprojet_drac = SousProjetDistributionRaccordement::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet))); ?>
<form class="form-horizontal push-10-t push-10"  id="dist_raccord_form" name="dist_raccord_form">
    <div class="row items-push">
        <?php if($sousprojet_drac !== NULL) {?>
            <input type="hidden" id="id_sous_projet_distribution_raccordements" name="id_sous_projet_distribution_raccordements" value="<?=$sousprojet_drac->id_sous_projet?>">
        <?php } else {?>
            <div class="row">
                <div id="id_sous_projet_distribution_raccordements_alert" class="col-md-3">
                    <span class="label label-warning">Aucune entrée distribution raccordement crée !</span>
                </div>
            </div>
        <?php }?>
        <div class="form-group">
            <div class="col-md-3">
                <label for="dr_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
                <select class="form-control " id="dr_intervenant_be" name="dr_intervenant_be">
                    <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_drac!==NULL && $sousprojet_drac->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dr_preparation_pds">Préparation PDS <span class="text-danger">*</span></label>
                <select class="form-control " id="dr_preparation_pds" name="dr_preparation_pds">
                    <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_drac!==NULL && $sousprojet_drac->preparation_pds==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dr_controle_plans">Contrôle des plans <span class="text-danger">*</span></label>
                <select class="form-control " id="dr_controle_plans" name="dr_controle_plans">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectControlePlan::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_controle_plan\" ". ($sousprojet_drac!==NULL && $sousprojet_drac->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dr_date_transmission_pds">Date Transmission PDS <span class="text-danger">*</span></label>
                <input class="form-control " type="date" id="dr_date_transmission_pds" name="dr_date_transmission_pds" value="<?=($sousprojet_drac !== NULL ? $sousprojet_drac->date_transmission_pds : "")?>">
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-3">
                <label for="dr_entreprise">Entreprise <span class="text-danger">*</span></label>
                <select class="form-control " id="dr_entreprise" name="dr_entreprise">
                    <option value="" selected="" disabled="">Sélectionnez une entreprise</option>
                    <?php
                    $results = SelectEntreprise::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_entreprise\" ". ($sousprojet_drac!==NULL && $sousprojet_drac->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->lib_entreprise</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dr_date_racco">Date Racco <span class="text-danger">*</span></label>
                <input class="form-control " type="date" id="dr_date_racco" name="dr_date_racco"  value="<?=($sousprojet_drac !== NULL ? $sousprojet_drac->date_racco : "")?>">
            </div>
            <div class="col-md-3">
                <label for="dr_duree">Durée <span class="text-danger">*</span></label>
                <input class="form-control " type="number" id="dr_duree" name="dr_duree" value="<?=($sousprojet_drac !== NULL ? $sousprojet_drac->duree : "")?>">
            </div>
            <div class="col-md-3">
                <label for="dr_controle_demarrage_effectif">Contrôle démarrage effectif <span class="text-danger">*</span></label>
                <select class="form-control " id="dr_controle_demarrage_effectif" name="dr_controle_demarrage_effectif">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectControleDemarrageEffectif::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_controle_demarrage_effectif\" ". ($sousprojet_drac!==NULL && $sousprojet_drac->controle_demarrage_effectif==$result->id_controle_demarrage_effectif ?"selected": "")." >$result->lib_controle_demarrage_effectif</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-3">
                <label for="dr_date_retour">Date Retour <span class="text-danger">*</span></label>
                <input class="form-control " type="date" id="dr_date_retour" name="dr_date_retour" value="<?=($sousprojet_drac !== NULL ? $sousprojet_drac->date_retour : "")?>">
            </div>
            <div class="col-md-3">
                <label for="dr_etat_retour">Etat Retour <span class="text-danger">*</span></label>
                <select class="form-control " id="dr_etat_retour" name="dr_etat_retour">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectEtatRetour::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_etat_retour\" ". ($sousprojet_drac!==NULL && $sousprojet_drac->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dr_ok">OK <span class="text-danger">*</span></label>
                <select class="form-control " id="dr_ok" name="dr_ok">
                    <option value="" selected="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectOk::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_ok\" ". ($sousprojet_drac!==NULL && $sousprojet_drac->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="alert alert-success" id="message_distribution_raccordements" role="alert" style="display: none;"></div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-8"><button id="id_sous_projet_distribution_raccordements_btn" class="btn btn-primary" type="button">Enregistrer</button>
                <?php
                if($sousprojet_drac!==NULL) {
                    $ot = OrdreDeTravail::first(
                        array('conditions' =>
                            array("id_entree = ? AND type_entree = ?", $sousprojet_drac->id_sous_projet_distribution_raccordements,"distribution_raccordements")
                        )
                    );
                    if($ot !== NULL) {

                        echo "  <a href=\"?page=ot&idot=$ot->id_ordre_de_travail&idsousprojet=$idsousprojet\" class=\"btn btn-info\">ouvrir ordre de travail</a>";
                    } else {
                        echo "  <button id=\"id_sous_projet_distribution_raccordements_create_ot_show\" class=\"btn btn-warning\" type=\"button\" data-toggle=\"modal\" data-target=\"#add-ot\" data-backdrop=\"static\" data-keyboard=\"false\">Créer ordre de travail</button>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</form>
