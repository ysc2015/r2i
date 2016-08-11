<?php $sousprojet_drecette = SousProjetDistributionRecette::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));?>
<form class="form-horizontal push-10-t push-10" id="dist_recette_form" name="dist_recette_form">
    <div class="row items-push">
        <?php if($sousprojet_drecette !== NULL) {?>
            <input type="hidden" id="id_sous_projet_distribution_recette" name="id_sous_projet_distribution_recette" value="<?=$sousprojet_drecette->id_sous_projet?>">
        <?php } else {?>
            <div class="row">
                <div id="id_sous_projet_distribution_recette_alert" class="col-md-3">
                    <span class="label label-warning">Aucune entrée distribution recette crée !</span>
                </div>
            </div>
        <?php }?>
        <div class="form-group">
            <div class="col-md-3">
                <label for="drec_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
                <select class="form-control " id="drec_intervenant_be" name="drec_intervenant_be">
                    <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_drecette!==NULL && $sousprojet_drecette->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="drec_doe">DOE <span class="text-danger">*</span></label>
                <select class="form-control " id="drec_doe" name="drec_doe">
                    <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_drecette!==NULL && $sousprojet_drecette->doe==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="drec_netgeo">Netgeo <span class="text-danger">*</span></label>
                <select class="form-control " id="drec_netgeo" name="drec_netgeo">
                    <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_drecette!==NULL && $sousprojet_drecette->netgeo==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="drec_intervenant_free">Intervenant FREE <span class="text-danger">*</span></label>
                <select class="form-control " id="drec_intervenant_free" name="drec_intervenant_free">
                    <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_drecette!==NULL && $sousprojet_drecette->intervenant_free==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-3">
                <label for="drec_entreprise">Entreprise <span class="text-danger">*</span></label>
                <select class="form-control " id="drec_entreprise" name="drec_entreprise">
                    <option value="" selected="" disabled="">Sélectionnez une entreprise</option>
                    <?php
                    $results = SelectEntreprise::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_entreprise\" ". ($sousprojet_drecette!==NULL && $sousprojet_drecette->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->lib_entreprise</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="drec_date_recette">Date de Recette <span class="text-danger">*</span></label>
                <input class="form-control " type="date" id="drec_date_recette" name="drec_date_recette" value="<?=($sousprojet_drecette !== NULL ? $sousprojet_drecette->date_recette : "")?>">
            </div>
            <div class="col-md-3">
                <label for="drec_etat_recette">Etat Recette <span class="text-danger">*</span></label>
                <select class="form-control " id="drec_etat_recette" name="drec_etat_recette">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectEtatRecette::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_etat_recette\" ". ($sousprojet_drecette!==NULL && $sousprojet_drecette->etat_recette==$result->id_etat_recette ?"selected": "")." >$result->lib_etat_recette</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="alert alert-success" id="message_distribution_recette" role="alert" style="display: none;"></div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-8"><button id="id_sous_projet_distribution_recette_btn" class="btn btn-primary" type="button">Enregistrer</button></div>
        </div>
    </div>
</form>
