<form class="js-validation-bootstrap form-horizontal">
    <?php if($sousprojet_dcmdcdi !== NULL) {?>
        <input type="hidden" id="id_sous_projet_distribution_commande_cdi" name="id_sous_projet_distribution_commande_cdi" value="<?=$sousprojet_dcmdcdi->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_distribution_commande_cdi_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée commande structurante cdi crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dcc_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
            <select class="form-control" id="dcc_intervenant_be" name="dcc_intervenant_be">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_dcmdcdi!==NULL && $sousprojet_dcmdcdi->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dcc_date_butoir">Date butoire traitement retour Aig <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="dcc_date_butoir" name="dcc_date_butoir" value="<?=($sousprojet_dcmdcdi !==NULL ? $sousprojet_dcmdcdi->date_butoir : "")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dcc_traitement_retour_terrain">Traitement Retours terrain <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="dcc_traitement_retour_terrain" name="dcc_traitement_retour_terrain" value="<?=($sousprojet_dcmdcdi !== NULL ? $sousprojet_dcmdcdi->traitement_retour_terrain : "")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dcc_modification_carto">Modification Carto <span class="text-danger">*</span></label>
            <select class="form-control" id="dcc_modification_carto" name="dcc_modification_carto">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectModificationCarto::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_modification_carto\" ". ($sousprojet_dcmdcdi!==NULL && $sousprojet_dcmdcdi->modification_carto==$result->id_modification_carto ?"selected": "")." >$result->lib_modification_carto</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dcc_commandes_acces">Commande Accès <span class="text-danger">*</span></label>
            <select class="form-control" id="dcc_commandes_acces" name="dcc_commandes_acces">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectCommandeAcces::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_commande_acces\" ". ($sousprojet_dcmdcdi!==NULL && $sousprojet_dcmdcdi->commandes_acces==$result->id_commande_acces ?"selected": "")." >$result->lib_commande_acces</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dcc_date_transmission_ca">Date Transmission CA <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="dcc_date_transmission_ca" name="dcc_date_transmission_ca" value="<?=($sousprojet_dcmdcdi !== NULL ? $sousprojet_dcmdcdi->date_transmission_ca : "")?>">
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dcc_ref_commande_acces">Référence Commande Accès <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="dcc_ref_commande_acces" name="dcc_ref_commande_acces" value="<?=($sousprojet_dcmdcdi !== NULL ? $sousprojet_dcmdcdi->ref_commande_acces : "")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dcc_go_ft">GO FT <span class="text-danger">*</span></label>
            <select class="form-control" id="dcc_go_ft" name="dcc_go_ft">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectGoFt::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_go_ft\" ". ($sousprojet_dcmdcdi!==NULL && $sousprojet_dcmdcdi->go_ft==$result->id_go_ft ?"selected": "")." >$result->lib_go_ft</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="alert alert-success" id="message_distribution_commande_cdi" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8"><button id="id_sous_projet_distribution_commande_cdi_btn" class="btn btn-primary" type="button">Enregistrer</button></div>
    </div>
</form>
