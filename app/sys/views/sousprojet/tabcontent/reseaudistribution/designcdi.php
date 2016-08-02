<?php $sousprojet_ddesign = SousProjetDistributionDesign::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));?>
<form class="js-validation-bootstrap form-horizontal">
    <?php if($sousprojet_ddesign !== NULL) {?>
        <input type="hidden" id="id_sous_projet_distribution_design" name="id_sous_projet_distribution_design" value="<?=$sousprojet_ddesign->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_distribution_design_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée distribution design cdi crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dd_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
            <select class="form-control" id="dd_intervenant_be" name="dd_intervenant_be">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_ddesign!==NULL && $sousprojet_ddesign->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dd_intervenant_bex">Intervenant BEX <span class="text-danger">*</span></label>
            <select class="form-control" id="dd_intervenant_bex" name="dd_intervenant_bex">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_ddesign!==NULL && $sousprojet_ddesign->intervenant_bex==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dd_date_debut">Date de Début <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="dd_date_debut" name="dd_date_debut" value="<?=($sousprojet_ddesign !== NULL ? $sousprojet_ddesign->date_debut : "")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dd_date_fin">Date de Fin <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="dd_date_fin" name="dd_date_fin" value="<?=($sousprojet_ddesign !== NULL ? $sousprojet_ddesign->date_fin : "")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dd_duree">Durée(jours) <span class="text-danger">*</span></label>
            <input readonly class="form-control" type="text" id="dd_duree" name="dd_duree" value="<?=($sousprojet_ddesign !== NULL?$sousprojet_ddesign->duree:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dd_lineaire_distribution">Linéaire Distribution <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="dd_lineaire_distribution" name="dd_lineaire_distribution" value="<?=($sousprojet_ddesign !== NULL ? $sousprojet_ddesign->lineaire_distribution : "")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dd_etat">Etat <span class="text-danger">*</span></label>
            <select class="form-control" id="dd_etat" name="dd_etat">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectEtatDesign::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_etat_design\" ". ($sousprojet_ddesign!==NULL && $sousprojet_ddesign->etat==$result->id_etat_design ?"selected": "")." >$result->lib_etat_design</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dd_date_envoi">Date envoi <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="dd_date_envoi" name="dd_date_envoi" value="<?=($sousprojet_ddesign !== NULL ? $sousprojet_ddesign->date_envoi : "")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dd_ok">OK <span class="text-danger">*</span></label>
            <select class="form-control" id="dd_ok" name="dd_ok">
                <option value="" selected="">Sélectionnez une valeur</option>
                <?php
                $results = SelectOk::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_ok\" ". ($sousprojet_ddesign!==NULL && $sousprojet_ddesign->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="alert alert-success" id="message_distribution_design" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8"><button id="id_sous_projet_distribution_design_btn" class="btn btn-primary" type="button">Enregistrer</button></div>
    </div>
</form>
