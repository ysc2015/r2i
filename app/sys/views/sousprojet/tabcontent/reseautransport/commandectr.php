<form class="js-validation-bootstrap form-horizontal">
    <?php if($sousprojet_tcommandectr !== NULL) {?>
        <input type="hidden" id="id_sous_projet_transport_commande_ctr" name="id_sous_projet_transport_commande_ctr" value="<?=$sousprojet_tcommandectr->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_transport_commande_ctr_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée commande structurante ctr crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="cctr_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
            <select class="form-control" id="cctr_intervenant_be" name="cctr_intervenant_be">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_tcommandectr!==NULL && $sousprojet_tcommandectr->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="cctr_date_butoir">Date butoire traitement retour Aig <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="cctr_date_butoir" name="cctr_date_butoir" value="<?=$sousprojet_tcommandectr->date_butoir?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="cctr_traitement_retour_terrain">Traitement Retours terrain <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="cctr_traitement_retour_terrain" name="cctr_traitement_retour_terrain" value="<?=$sousprojet_tcommandectr->traitement_retour_terrain?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="cctr_modification_carto">Modification Carto <span class="text-danger">*</span></label>
            <select class="form-control" id="cctr_modification_carto" name="cctr_modification_carto">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectModificationCarto::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_modification_carto\" ". ($sousprojet_tcommandectr!==NULL && $sousprojet_tcommandectr->modification_carto==$result->id_modification_carto ?"selected": "")." >$result->lib_modification_carto</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="cctr_commandes_acces">Commande Accès <span class="text-danger">*</span></label>
            <select class="form-control" id="cctr_commandes_acces" name="cctr_commandes_acces">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectCommandeAcces::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_commande_acces\" ". ($sousprojet_tcommandectr!==NULL && $sousprojet_tcommandectr->commandes_acces==$result->id_commande_acces ?"selected": "")." >$result->lib_commande_acces</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="cctr_date_transmission_ca">Date Transmission CA <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="cctr_date_transmission_ca" name="cctr_date_transmission_ca" value="<?=$sousprojet_tcommandectr->date_transmission_ca?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="cctr_ref_commande_acces">Référence Commande Accès <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="cctr_ref_commande_acces" name="cctr_ref_commande_acces" value="<?=$sousprojet_tcommandectr->ref_commande_acces?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="cctr_go_ft">GO FT <span class="text-danger">*</span></label>
            <select class="form-control" id="cctr_go_ft" name="cctr_go_ft">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectGoFt::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_go_ft\" ". ($sousprojet_tcommandectr!==NULL && $sousprojet_tcommandectr->go_ft==$result->id_go_ft ?"selected": "")." >$result->lib_go_ft</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="alert alert-success" id="message_transport_commande_ctr" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8"><button id="id_sous_projet_transport_commande_ctr_btn" class="btn btn-primary" type="button">Enregistrer</button></div>
    </div>
</form>
