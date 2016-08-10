<?php $sousprojet_trac = SousProjetTransportRaccordement::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));?>
<form class="form-horizontal push-10-t push-10">
    <div class="row items-push">
        <?php if($sousprojet_trac !== NULL) {?>
            <input type="hidden" id="id_sous_projet_transport_raccordements" name="id_sous_projet_transport_raccordements" value="<?=$sousprojet_trac->id_sous_projet?>">
        <?php } else {?>
            <div class="row">
                <div id="id_sous_projet_transport_raccordements_alert" class="col-md-3">
                    <span class="label label-warning">Aucune entrée transport raccordement crée !</span>
                </div>
            </div>
        <?php }?>
        <div class="form-group">
            <div class="col-md-3">
                <label for="tr_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tr_intervenant_be" name="tr_intervenant_be">
                    <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_trac!==NULL && $sousprojet_trac->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tr_preparation_pds">Préparation PDS <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tr_preparation_pds" name="tr_preparation_pds">
                    <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_trac!==NULL && $sousprojet_trac->preparation_pds==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tr_controle_plans">Contrôle des plans <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tr_controle_plans" name="tr_controle_plans">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectControlePlan::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_controle_plan\" ". ($sousprojet_trac!==NULL && $sousprojet_trac->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tr_date_transmission_pds">Date Transmission PDS <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="date" id="tr_date_transmission_pds" name="tr_date_transmission_pds" value="<?=($sousprojet_trac !== NULL ? $sousprojet_trac->date_transmission_pds : "")?>">
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-3">
                <label for="tr_entreprise">Entreprise <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tr_entreprise" name="tr_entreprise">
                    <option value="" selected="" disabled="">Sélectionnez une entreprise</option>
                    <?php
                    $results = SelectEntreprise::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_entreprise\" ". ($sousprojet_trac!==NULL && $sousprojet_trac->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->lib_entreprise</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tr_date_racco">Date Racco <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="date" id="tr_date_racco" name="tr_date_racco" value="<?=($sousprojet_trac !== NULL ? $sousprojet_trac->date_racco : "")?>">
            </div>
            <div class="col-md-3">
                <label for="tr_duree">Durée <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="number" id="tr_duree" name="tr_duree" value="<?=($sousprojet_trac !== NULL ? $sousprojet_trac->duree : "")?>">
            </div>
            <div class="col-md-3">
                <label for="tr_controle_demarrage_effectif">Contrôle démarrage effectif <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tr_controle_demarrage_effectif" name="tr_controle_demarrage_effectif">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectControleDemarrageEffectif::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_controle_demarrage_effectif\" ". ($sousprojet_trac!==NULL && $sousprojet_trac->controle_demarrage_effectif==$result->id_controle_demarrage_effectif ?"selected": "")." >$result->lib_controle_demarrage_effectif</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-3">
                <label for="tr_date_retour">Date Retour <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="date" id="tr_date_retour" name="tr_date_retour" value="<?=($sousprojet_trac !== NULL ? $sousprojet_trac->date_retour : "")?>">
            </div>
            <div class="col-md-3">
                <label for="tr_etat_retour">Etat Retour <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tr_etat_retour" name="tr_etat_retour">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectEtatRetour::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_etat_retour\" ". ($sousprojet_trac!==NULL && $sousprojet_trac->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tr_ok">OK <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="tr_ok" name="tr_ok">
                    <option value="" selected="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectOk::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_ok\" ". ($sousprojet_trac!==NULL && $sousprojet_trac->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="alert alert-success" id="message_transport_raccordements" role="alert" style="display: none;"></div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-8"><button id="id_sous_projet_transport_raccordements_btn" class="btn btn-primary" type="button">Enregistrer</button>
                <?php
                if($sousprojet_trac!==NULL) {
                    $ot = OrdreDeTravail::first(
                        array('conditions' =>
                            array("id_entree = ? AND type_entree = ?", $sousprojet_trac->id_sous_projet_transport_raccordements,"transport_raccordements")
                        )
                    );
                    if($ot !== NULL) {

                        echo "  <a href=\"?page=ot&idot=$ot->id_ordre_de_travail&idsousprojet=$idsousprojet\" class=\"btn btn-info\">ouvrir ordre de travail</a>";
                    } else {
                        echo "  <button id=\"id_sous_projet_transport_raccordements_create_ot_show\" class=\"btn btn-warning\" type=\"button\" data-toggle=\"modal\" data-target=\"#add-ot\" data-backdrop=\"static\" data-keyboard=\"false\">Créer ordre de travail</button>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</form>
