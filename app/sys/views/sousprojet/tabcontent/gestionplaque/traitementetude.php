<?php $sousprojet_tetude = SousProjetPlaqueTraitementEtude::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));?>
<form class="js-validation-bootstrap form-horizontal" id="gestionplaque_tetude_form" name="gestionplaque_tetude_form">
    <?php if($sousprojet_tetude !== NULL) {?>
        <input type="hidden" id="id_sous_projet_plaque_traitement_etude" name="id_sous_projet_plaque_traitement_etude" value="<?=$sousprojet_tetude->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_plaque_traitement_etude_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée traitement étude crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="te_site">Site <span class="text-danger">*</span></label>
            <select class="form-control" id="te_site" name="te_site">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectTraitementEtudeSite::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_traitement_etude_site\" ". ($sousprojet_tetude!==NULL && $sousprojet_tetude->site==$result->id_traitement_etude_site ?"selected": "")." >$result->lib_traitement_etude_site</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="te_charge_etude">Chargé d'étude <span class="text-danger">*</span></label>
            <select class="form-control" id="te_charge_etude" name="te_charge_etude">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_tetude!==NULL && $sousprojet_tetude->charge_etude==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="alert alert-success" id="message_gestion_plaque_traitement_etude" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8"><button id="id_sous_projet_plaque_traitement_etude_btn" class="btn btn-primary" type="button">Enregistrer</button></div>
    </div>
</form>