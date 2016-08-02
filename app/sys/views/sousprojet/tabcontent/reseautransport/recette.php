<?php $sousprojet_trecette = SousProjetTransportRecette::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));?>
<form class="js-validation-bootstrap form-horizontal">
    <?php if($sousprojet_trecette !== NULL) {?>
        <input type="hidden" id="id_sous_projet_transport_recette" name="id_sous_projet_transport_recette" value="<?=$sousprojet_trecette->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_transport_recette_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée transport recette crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="trec_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
            <select class="form-control" id="trec_intervenant_be" name="trec_intervenant_be">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_trecette!==NULL && $sousprojet_trecette->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="trec_doe">DOE <span class="text-danger">*</span></label>
            <select class="form-control" id="trec_doe" name="trec_doe">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_trecette!==NULL && $sousprojet_trecette->doe==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="trec_netgeo">Netgeo <span class="text-danger">*</span></label>
            <select class="form-control" id="trec_netgeo" name="trec_netgeo">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_trecette!==NULL && $sousprojet_trecette->netgeo==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="trec_intervenant_free">Intervenant FREE <span class="text-danger">*</span></label>
            <select class="form-control" id="trec_intervenant_free" name="trec_intervenant_free">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_trecette!==NULL && $sousprojet_trecette->intervenant_free==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="trec_entreprise">Entreprise <span class="text-danger">*</span></label>
            <select class="form-control" id="trec_entreprise" name="trec_entreprise">
                <option value="" selected="" disabled="">Sélectionnez une entreprise</option>
                <?php
                $results = SelectEntreprise::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_entreprise\" ". ($sousprojet_trecette!==NULL && $sousprojet_trecette->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->lib_entreprise</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="trec_date_recette">Date de Recette <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="trec_date_recette" name="trec_date_recette" value="<?=($sousprojet_trecette !== NULL ? $sousprojet_trecette->date_recette : "")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="trec_etat_recette">Etat Recette <span class="text-danger">*</span></label>
            <select class="form-control" id="trec_etat_recette" name="trec_etat_recette">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectEtatRecette::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_etat_recette\" ". ($sousprojet_trecette!==NULL && $sousprojet_trecette->etat_recette==$result->id_etat_recette ?"selected": "")." >$result->lib_etat_recette</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="alert alert-success" id="message_transport_recette" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8"><button id="id_sous_projet_transport_recette_btn" class="btn btn-primary" type="button">Enregistrer</button></div>
    </div>
</form>
