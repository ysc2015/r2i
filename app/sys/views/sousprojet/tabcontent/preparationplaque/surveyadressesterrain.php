<form class="js-validation-bootstrap form-horizontal">
    <div class="row">
        <div class="col-md-6">
            <?php if($sousprojet_suradresse !== NULL) {?>
                <input type="hidden" id="id_sous_projet_plaque_survey_adresse" name="id_sous_projet_plaque_survey_adresse" value="<?=$sousprojet_suradresse->id_sous_projet?>">
            <?php } else {?>
                <div class="row">
                    <div id="id_sous_projet_plaque_survey_adresse_alert" class="col-md-6">
                        <span class="label label-warning">Aucune entrée survey adresses terrain crée !</span>
                    </div>
                </div>
            <?php }?>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="sa_volume_adresse">Volumes Adresses <span class="text-danger">*</span></label>
                    <input class="form-control" type="number" id="sa_volume_adresse" name="sa_volume_adresse" value="<?=($sousprojet_suradresse !== NULL?$sousprojet_suradresse->volume_adresse:"")?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="sa_date_debut">Date de Début <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" id="sa_date_debut" name="sa_date_debut" value="<?=($sousprojet_suradresse !== NULL?$sousprojet_suradresse->date_debut:"")?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="sa_date_ret_prevue">Date ret Prev <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" id="sa_date_ret_prevue" name="sa_date_ret_prevue" value="<?=($sousprojet_suradresse !== NULL?$sousprojet_suradresse->date_ret_prevue:"")?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="sa_duree">Durée(jours) <span class="text-danger">*</span></label>
                    <input readonly class="form-control" type="text" id="sa_duree" name="sa_duree" value="<?=($sousprojet_suradresse !== NULL?$sousprojet_suradresse->duree:"")?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="sa_intervenant">Intervenant BE <span class="text-danger">*</span></label>
                    <select class="form-control" id="sa_intervenant" name="sa_intervenant">
                        <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                        <?php
                        $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_suradresse!==NULL && $sousprojet_suradresse->intervenant==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label for="sa_ok">OK <span class="text-danger">*</span></label>
                    <select class="form-control" id="sa_ok" name="sa_ok">
                        <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                        <?php
                        $results = SelectOk::all();
                        foreach($results as $result) {
                            echo "<option value=\"$result->id_ok\" ". ($sousprojet_suradresse!==NULL && $sousprojet_suradresse->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="alert alert-success" id="message_gestion_plaque_survey_adresse" role="alert" style="display: none;"></div>
            <div class="form-group">
                <div class="col-md-8"><button id="id_sous_projet_plaque_survey_adresse_btn" class="btn btn-primary" type="button">Enregistrer</button></div>
            </div>
        </div>
        <?php if($sousprojet_suradresse!==NULL) {?>
            <div class="col-md-6" style="border-left: dashed 1px #000;">
                <div class="row" style="padding-left: 10px;">
                    <label for="fileuploader_survey_bei">Fichier(s) adresses terrain (bei)</label>
                    <div id="fileuploader_survey_bei"></div>
                </div>
                <div class="row" id="survey_bei_files" style="padding-left: 10px;">
                </div>
                <div class="row" style="padding-left: 10px;">
                    <label for="fileuploader_survey_bei">Fichier(s) adresses terrain traité (retour vip)</label>
                    <div id="fileuploader_survey_vip"></div>
                </div>
                <div class="row" id="survey_vip_files" style="padding-left: 10px;">
                </div>
            </div>
        <?php } ?>
    </div>
</form>