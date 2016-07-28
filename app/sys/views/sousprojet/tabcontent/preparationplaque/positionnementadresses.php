<form class="js-validation-bootstrap form-horizontal">
    <?php if($sousprojet_padresse !== NULL) {?>
        <input type="hidden" id="id_sous_projet_plaque_pos_adresse" name="id_sous_projet_plaque_pos_adresse" value="<?=$sousprojet_padresse->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_plaque_pos_adresse_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée positionemment adresses crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="pa_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
            <select class="form-control" id="pa_intervenant_be" name="pa_intervenant_be">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_padresse!==NULL && $sousprojet_padresse->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="pa_date_debut">Date de Début <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="pa_date_debut" name="pa_date_debut" value="<?=($sousprojet_padresse !== NULL?$sousprojet_padresse->date_debut:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="pa_date_ret_prevue">Date ret Prev <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="pa_date_ret_prevue" name="pa_date_ret_prevue" value="<?=($sousprojet_padresse !== NULL?$sousprojet_padresse->date_ret_prevue:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="pa_duree">Durée(jours) <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="pa_duree" name="pa_duree" value="<?=($sousprojet_padresse !== NULL?$sousprojet_padresse->duree:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="pa_intervenant">Intervenant BE <span class="text-danger">*</span></label>
            <select class="form-control" id="pa_intervenant" name="pa_intervenant">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_padresse!==NULL && $sousprojet_padresse->intervenant==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="pa_ok">OK <span class="text-danger">*</span></label>
            <select class="form-control" id="pa_ok" name="pa_ok">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectOk::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_ok\" ". ($sousprojet_padresse!==NULL && $sousprojet_padresse->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="alert alert-success" id="message_gestion_plaque_pos_adresse" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8"><button id="id_sous_projet_plaque_pos_adresse_btn" class="btn btn-primary" type="button">Enregistrer</button></div>
    </div>
</form>