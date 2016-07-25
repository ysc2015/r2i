<form class="js-validation-bootstrap form-horizontal">
    <?php if($sousprojet_dtirage !== NULL) {?>
        <input type="hidden" id="id_sous_projet_distribution_tirage" name="id_sous_projet_distribution_tirage" value="<?=$sousprojet_dtirage->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_distribution_tirage_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée distribution tirage crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dt_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
            <select class="form-control" id="dt_intervenant_be" name="dt_intervenant_be">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dt_date_previsionnelle">Date Previsionnelle <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="dt_date_previsionnelle" name="dt_date_previsionnelle" value="<?=$sousprojet_dtirage->date_previsionnelle?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dt_prep_plans">Préparation des plans <span class="text-danger">*</span></label>
            <select class="form-control" id="dt_prep_plans" name="dt_prep_plans">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->prep_plans==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dt_controle_plans">Contrôle des plans <span class="text-danger">*</span></label>
            <select class="form-control" id="dt_controle_plans" name="dt_controle_plans">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectControlePlan::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_controle_plan\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dt_date_transmission_plans">Date Transmission Plans <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="dt_date_transmission_plans" name="dt_date_transmission_plans" value="<?=$sousprojet_dtirage->date_transmission_plans?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dt_entreprise">Entreprise <span class="text-danger">*</span></label>
            <select class="form-control" id="dt_entreprise" name="dt_entreprise">
                <option value="" selected="" disabled="">Sélectionnez une entreprise</option>
                <?php
                $results = SelectEntreprise::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_entreprise\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->lib_entreprise</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dt_date_tirage">Date Tirage <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="dt_date_tirage" name="dt_date_tirage" value="<?=$sousprojet_dtirage->date_tirage?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dt_duree">Durée <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="dt_duree" name="dt_duree" value="<?=$sousprojet_dtirage->duree?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dt_controle_demarrage_effectif">Contrôle démarrage effectif <span class="text-danger">*</span></label>
            <select class="form-control" id="dt_controle_demarrage_effectif" name="dt_controle_demarrage_effectif">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectControleDemarrageEffectif::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_controle_demarrage_effectif\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->controle_demarrage_effectif==$result->id_controle_demarrage_effectif ?"selected": "")." >$result->lib_controle_demarrage_effectif</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dt_date_retour">Date Retour <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="dt_date_retour" name="dt_date_retour" value="<?=$sousprojet_dtirage->date_retour?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="dt_etat_retour">Etat Retour <span class="text-danger">*</span></label>
            <select class="form-control" id="dt_etat_retour" name="dt_etat_retour">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectEtatRetour::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_etat_retour\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="alert alert-success" id="message_distribution_tirage" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8"><button id="id_sous_projet_distribution_tirage_btn" class="btn btn-primary" type="button">Enregistrer</button>
            <?php
            $ot = OrdreDeTravail::first(
                array('conditions' =>
                    array("id_entree = ? AND type_entree = ?", $sousprojet_dtirage->id_sous_projet_distribution_tirage,"distribution_tirage")
                )
            );
            if($ot !== NULL) {

                echo "  <a href=\"?page=ot&idot=$ot->id_ordre_de_travail&idsousprojet=$idsousprojet\" class=\"btn btn-info\">ouvrir ordre de travail</a>";
            } else {
                echo "  <button id=\"id_sous_projet_distribution_tirage_create_ot_show\" class=\"btn btn-success\" type=\"button\" data-toggle=\"modal\" data-target=\"#add-ot\" data-backdrop=\"static\" data-keyboard=\"false\">créer ordre de travail</button>";
            }
            ?>
        </div>
    </div>
</form>
