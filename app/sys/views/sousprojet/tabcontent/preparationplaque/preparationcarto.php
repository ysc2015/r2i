<form class="js-validation-bootstrap form-horizontal">
    <?php if($sousprojet_pcarto !== NULL) {?>
        <input type="hidden" id="id_sous_projet_plaque_carto" name="id_sous_projet_plaque_carto" value="<?=$sousprojet_pcarto->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_plaque_carto_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée préparation carto crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="pc_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
            <select class="form-control" id="pc_intervenant_be" name="pc_intervenant_be">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_pcarto!==NULL && $sousprojet_pcarto->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="pc_date_debut">Date de Début <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="pc_date_debut" name="pc_date_debut" value="<?=($sousprojet_pcarto !== NULL?$sousprojet_pcarto->date_debut:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="pc_date_ret_prevue">Date ret Prev <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="pc_date_ret_prevue" name="pc_date_ret_prevue" value="<?=($sousprojet_pcarto !== NULL?$sousprojet_pcarto->date_ret_prevue:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="pc_duree">Durée <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="pc_duree" name="pc_duree" value="<?=($sousprojet_pcarto !== NULL?$sousprojet_pcarto->duree:"")?>">
        </div>
    </div>
    <div class="alert alert-success" id="message_gestion_plaque_carto" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8"><button id="id_sous_projet_plaque_carto_btn" class="btn btn-primary" type="button">Enregistrer</button></div>
    </div>
</form>